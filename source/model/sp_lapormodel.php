<?php
include_once('Model.php');
include_once('GlobalModel.php');
include_once('Database.php');

class sp_lapormodel extends Model
{
    protected $db;
    protected $table = 'tb_lapor';
    protected $driver;

    public function __construct()
    {
        // Mendapatkan instance database
        $database = Database::getInstance();
        $this->db = $database->getConnection(); // Mengatur koneksi database
        $this->driver = $database->getDriver(); // Mengatur driver yang digunakan
    }

    public function getDataForDataTables($request)
    {
        // Kolom yang dapat digunakan untuk ordering dan pencarian
        $columns = ['id_pelanggaran', 'dosen_nama', 'mahasiswa_nama', 'pelanggaran_deskripsi', 'tanggal_laporan', 'tempat'];

        // Menyaring parameter pencarian dan paginasi
        $searchValue = isset($request['search']['value']) ? $request['search']['value'] : '';
        $searchTerm = "%{$searchValue}%";

        $orderColumnIndex = isset($request['order'][0]['column']) ? (int)$request['order'][0]['column'] : 0;
        $orderDir = isset($request['order'][0]['dir']) && in_array(strtolower($request['order'][0]['dir']), ['asc', 'desc']) ? $request['order'][0]['dir'] : 'asc';

        $start = isset($request['start']) ? (int)$request['start'] : 0;
        $length = isset($request['length']) ? (int)$request['length'] : 10;

        // Menentukan kolom untuk diurutkan
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id_pelanggaran';

        $idUsers = $_SESSION['id_users'];
        $level = $_SESSION['level'];

        $global = new GlobalModel();
        $user = null;

        if ($level == 'dosen') {
            $conditions = ['id_users' => $idUsers];
            $user = $global->getSingleData('tb_dosen', $conditions);
        }

        if ($level == 'mahasiswa') {
            $conditions = ['id_users' => $idUsers];
            $user = $global->getSingleData('tb_mahasiswa', $conditions);
        }

     
        $queryParams = [];
        if ($level == 'dosen') {
            // Memanggil stored procedure untuk dosen
            $query = "EXEC sp_GetReportsByStudent ?";  // Memanggil stored procedure
            $queryParams[] = $user['nip']; // Memberikan parameter nip dosen
        } else if ($level == 'mahasiswa') {
            // Memanggil stored procedure untuk mahasiswa
            $query = "EXEC sp_GetReportsByStudent ?";  // Memanggil stored procedure
            $queryParams[] = $user['nim']; // Memberikan parameter nim mahasiswa
        } else {
            // Untuk level lain, query yang lebih umum
            $query = "SELECT 
                tb_lapor.id_pelanggaran, 
                tb_mahasiswa.nama AS mahasiswa_nama, 
                tb_jenis_pelanggaran.deskripsi AS pelanggaran_deskripsi, 
                tb_lapor.tanggal_laporan,
                tb_lapor.tempat,
                tb_lapor.status_verifikasi_admin,
                tb_dosen.nama AS dosen_nama
            FROM 
                tb_lapor
            INNER JOIN 
                tb_mahasiswa ON tb_lapor.id_mahasiswa = tb_mahasiswa.nim
            INNER JOIN 
                tb_jenis_pelanggaran ON tb_lapor.id_jenis_pelanggaran = tb_jenis_pelanggaran.id_jenis_pelanggaran
            INNER JOIN 
                tb_dosen ON tb_lapor.id_dosen = tb_dosen.nip";
            $queryParams = []; // Tidak ada parameter khusus
        }

        if (!empty($searchValue)) {
            $query .= " WHERE dosen_nama LIKE ? OR 
                        mahasiswa_nama LIKE ? OR 
                        pelanggaran_deskripsi LIKE ? OR 
                        tanggal_laporan LIKE ?
                        tempat LIKE ?";
            $queryParams[] = $searchTerm;
            $queryParams[] = $searchTerm;
            $queryParams[] = $searchTerm;
            $queryParams[] = $searchTerm;
            $queryParams[] = $searchTerm;
        }

        // Menambahkan urutan dan batasan paginasi
        $query .= " ORDER BY {$orderColumn} {$orderDir} OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";
        $queryParams[] = $start;
        $queryParams[] = $length;

        // Menjalankan query
        $stmt = sqlsrv_query($this->db, $query, $queryParams);
        $data = [];
        if ($stmt) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
        }

        // Menghitung total data yang difilter
        $queryFiltered = "SELECT COUNT(*) as count FROM {$this->table}"; // Menghitung jumlah data
        $filteredParams = [];
        if (!empty($searchValue)) {
            $queryFiltered .= " WHERE dosen_nama LIKE ? OR 
                mahasiswa_nama LIKE ? OR 
                pelanggaran_deskripsi LIKE ? OR 
                tanggal_laporan LIKE ?
                tempat LIKE ?";
            $filteredParams[] = $searchTerm;
            $filteredParams[] = $searchTerm;
            $filteredParams[] = $searchTerm;
            $filteredParams[] = $searchTerm;
            $filteredParams[] = $searchTerm;
        }

        // Menjalankan query untuk menghitung data yang difilter
        $stmtFiltered = sqlsrv_query($this->db, $queryFiltered, $filteredParams);
        $totalFiltered = 0;
        if ($stmtFiltered) {
            $rowFiltered = sqlsrv_fetch_array($stmtFiltered, SQLSRV_FETCH_ASSOC);
            $totalFiltered = $rowFiltered ? $rowFiltered['count'] : 0;
        }

        // Menghitung total data
        $queryTotal = "SELECT COUNT(*) as count FROM {$this->table}";
        $stmtTotal = sqlsrv_query($this->db, $queryTotal);
        $totalRecords = 0;
        if ($stmtTotal) {
            $rowTotal = sqlsrv_fetch_array($stmtTotal, SQLSRV_FETCH_ASSOC);
            $totalRecords = $rowTotal ? $rowTotal['count'] : 0;
        }

        // Mengembalikan data dalam format DataTables
        return [
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        ];
    }

    public function insertData($data)
    {
        // Menyisipkan data
        $query = "INSERT INTO {$this->table} 
                  (id_mahasiswa, id_jenis_pelanggaran, komentar, id_dosen, status_verifikasi_admin, foto, tempat, tanggal_laporan) 
                  VALUES (?, ?, ?, ?, ?, ?,?, ?)";

        // Menjalankan query dengan parameter
        $stmt = sqlsrv_query($this->db, $query, [
            $data['id_mahasiswa'],
            $data['id_jenis_pelanggaran'],
            $data['komentar'],
            $data['id_dosen'],
            $data['status_verifikasi_admin'],
            $data['foto'],
            $data['tempat'],
            $data['tanggal_laporan']
        ]);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true)); // Menampilkan error SQL Server
        } else {
            return "Data inserted successfully!";
        }
    }

    public function getData()
    {
        // Mengambil data dari tabel
        $query = sqlsrv_query($this->db, "select * from {$this->table}");
        $data = [];
        while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getDataById($id)
    {
        // Mengambil data berdasarkan id
        $query = sqlsrv_query($this->db, "select * from {$this->table} where id_pelanggaran = ?", [$id]);
        return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    }

    public function updateData($id, $data)
    {
        // Mengupdate data
        sqlsrv_query($this->db, "UPDATE {$this->table} SET id_mahasiswa = ?, id_jenis_pelanggaran = ?, komentar = ?, id_dosen = ?, status_verifikasi_admin = ?, foto = ?, tempat = ?, tanggal_laporan = ? WHERE id_pelanggaran = ?", [
            $data['id_mahasiswa'],
            $data['id_jenis_pelanggaran'],
            $data['komentar'],
            $data['id_dosen'],
            $data['status_verifikasi_admin'],
            $data['foto'],
            $data['tempat'],
            $data['tanggal_laporan'],
            $id
        ]);
    }

    public function updateStatusData($id, $data)
    {
        // Mengupdate status data
        sqlsrv_query($this->db, "UPDATE {$this->table} SET  status_verifikasi_admin = ? WHERE id_pelanggaran = ?", [
            $data['status'],
            $id
        ]);
    }

    public function deleteData($id)
    {
        // Menghapus data
        sqlsrv_query($this->db, "DELETE FROM {$this->table} WHERE id_pelanggaran = ?", [$id]);
    }
}
