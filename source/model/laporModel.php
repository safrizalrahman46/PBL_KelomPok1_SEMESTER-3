<?php
include_once('Model.php');
include_once('GlobalModel.php');
include_once('Database.php');

class LaporModel extends Model
{
    protected $db;
    protected $table = 'tb_lapor';
    protected $driver;
    public function __construct()
    {
        // Get the database instance
        $database = Database::getInstance();
        $this->db = $database->getConnection(); // Set the connection resource
        $this->driver = $database->getDriver(); // Set the driver being used
    }

    public function getDataForDataTables($request)
    {
        // Columns available for ordering and searching
        $columns = ['id_pelanggaran', 'dosen_nama', 'mahasiswa_nama', 'pelanggaran_deskripsi', 'tanggal_laporan', 'tempat'];
        // var_dump($columns);
        //         exit();
        // Extract search and pagination parameters
        $searchValue = isset($request['search']['value']) ? $request['search']['value'] : '';
        $searchTerm = "%{$searchValue}%";

        $orderColumnIndex = isset($request['order'][0]['column']) ? (int)$request['order'][0]['column'] : 0;
        $orderDir = isset($request['order'][0]['dir']) && in_array(strtolower($request['order'][0]['dir']), ['asc', 'desc'])
            ? $request['order'][0]['dir']
            : 'asc';

        $start = isset($request['start']) ? (int)$request['start'] : 0;
        $length = isset($request['length']) ? (int)$request['length'] : 10;

        // Ensure column index is valid
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

        // SQL query for fetching data with search and pagination


        if ($level == 'dosen') {
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
            tb_dosen ON tb_lapor.id_dosen = tb_dosen.nip
        where tb_lapor.id_dosen = " . $user['nip'];


            $queryParams = [];
            if (!empty($searchValue)) {
                $query .= " and (dosen_nama LIKE ? OR 
                    mahasiswa_nama LIKE ? OR 
                    pelanggaran_deskripsi LIKE ? OR 
                    tanggal_laporan LIKE ?
                    tempat LIKE ?)";
                $queryParams[] = $searchTerm;
                $queryParams[] = $searchTerm;
                $queryParams[] = $searchTerm;
                $queryParams[] = $searchTerm;
                $queryParams[] = $searchTerm;
            }
        } else if ($level == 'mahasiswa') {
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
            tb_dosen ON tb_lapor.id_dosen = tb_dosen.nip
        where tb_lapor.id_mahasiswa = " . $user['nim'];


            $queryParams = [];
            if (!empty($searchValue)) {
                $query .= " and (dosen_nama LIKE ? OR 
                        mahasiswa_nama LIKE ? OR 
                        pelanggaran_deskripsi LIKE ? OR 
                        tanggal_laporan LIKE ?
                        tempat LIKE ?)";
                $queryParams[] = $searchTerm;
                $queryParams[] = $searchTerm;
                $queryParams[] = $searchTerm;
                $queryParams[] = $searchTerm;
                $queryParams[] = $searchTerm;
            }
        } else {

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
                    tb_dosen ON tb_lapor.id_dosen = tb_dosen.nip
            ";


            $queryParams = [];
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
        }


        $query .= " ORDER BY {$orderColumn} {$orderDir} OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";
        $queryParams[] = $start;
        $queryParams[] = $length;



        // Execute the query
        $stmt = sqlsrv_query($this->db, $query, $queryParams);
        $data = [];
        if ($stmt) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
        }

        // Count total filtered records

        if ($level == 'dosen') {
            $queryFiltered = "SELECT COUNT(*) as count FROM {$this->table} where tb_lapor.id_dosen = " . $user['nip'];
            $filteredParams = [];

            
            if (!empty($searchValue)) {
                $queryFiltered .= " and ( tb_mahasiswa.nama LIKE ? OR 
                    tb_jenis_pelanggaran.deskripsi LIKE ? OR 
                    tb_dosen.nama LIKE ? OR 
                    tb_lapor.tempat LIKE ?)";
                $filteredParams[] = $searchTerm;
                $filteredParams[] = $searchTerm;
                $filteredParams[] = $searchTerm;
                $filteredParams[] = $searchTerm;
            }
    
    
        } else if($level == 'mahasiswa') {
            $queryFiltered = "SELECT COUNT(*) as count FROM {$this->table} where tb_lapor.id_mahasiswa = " . $user['nim'];
            $filteredParams = [];


            if (!empty($searchValue)) {
                $queryFiltered .= " and ( tb_mahasiswa.nama LIKE ? OR 
                    tb_jenis_pelanggaran.deskripsi LIKE ? OR 
                    tb_dosen.nama LIKE ? OR 
                    tb_lapor.tempat LIKE ?)";
                $filteredParams[] = $searchTerm;
                $filteredParams[] = $searchTerm;
                $filteredParams[] = $searchTerm;
                $filteredParams[] = $searchTerm;
            }
    
    
        } else {
            $queryFiltered = "SELECT COUNT(*) as count FROM {$this->table}";
            $filteredParams = [];

            if (!empty($searchValue)) {
                $queryFiltered .= " WHERE  tb_mahasiswa.nama LIKE ? OR 
                    tb_jenis_pelanggaran.deskripsi LIKE ? OR 
                    tb_dosen.nama LIKE ? OR 
                    tb_lapor.tempat LIKE ?";
                $filteredParams[] = $searchTerm;
                $filteredParams[] = $searchTerm;
                $filteredParams[] = $searchTerm;
                $filteredParams[] = $searchTerm;
            }
    
        }
   

        $stmtFiltered = sqlsrv_query($this->db, $queryFiltered, $filteredParams);
        $totalFiltered = 0;
        if ($stmtFiltered) {
            $rowFiltered = sqlsrv_fetch_array($stmtFiltered, SQLSRV_FETCH_ASSOC);
            $totalFiltered = $rowFiltered ? $rowFiltered['count'] : 0;
        }

        // Count total records

        if ($level == 'dosen') {
            $queryTotal = "SELECT COUNT(*) as count FROM {$this->table} where tb_lapor.id_dosen = " . $user['nip'];
            $filteredParams = [];
        } else if($level == 'mahasiswa') {
            $queryTotal = "SELECT COUNT(*) as count FROM {$this->table} where tb_lapor.id_mahasiswa = " . $user['nim'];
            $filteredParams = [];
        } else {
            $queryTotal = "SELECT COUNT(*) as count FROM {$this->table}";
            $filteredParams = [];
        }


  

        $stmtTotal = sqlsrv_query($this->db, $queryTotal);
        $totalRecords = 0;
        if ($stmtTotal) {
            $rowTotal = sqlsrv_fetch_array($stmtTotal, SQLSRV_FETCH_ASSOC);
            $totalRecords = $rowTotal ? $rowTotal['count'] : 0;
        }

        // Return data in DataTables format
        return [
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        ];
    }


    public function insertData($data)
    {
        // Define the query
        $query = "INSERT INTO {$this->table} 
                  (id_mahasiswa, id_jenis_pelanggaran, komentar, id_dosen, status_verifikasi_admin, foto, tempat, tanggal_laporan) 
                  VALUES (?, ?, ?, ?, ?, ?,?, ?)";

        // Execute the query with parameters
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

        // Check for errors
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true)); // Display SQL Server error details
        } else {
            return "Data inserted successfully!";
        }
    }

    public function getData()
    {

        // query untuk mengambil data dari tabel
        $query = sqlsrv_query($this->db, "select * from {$this->table}");
        $data = [];
        while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
    public function getDataById($id)
    {

        // query untuk mengambil data berdasarkan id
        $query = sqlsrv_query($this->db, "select * from {$this->table} where id_pelanggaran = ?", [$id]);
        // ambil hasil query
        return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    }
    public function updateData($id, $data)
    {

        // query untuk update data
        sqlsrv_query($this->db, "UPDATE {$this->table} SET id_mahasiswa = ?, id_jenis_pelanggaran = ?, status = ?, komentar = ?, id_admin = ?, id_dosen = ?, status_verifikasi_admin = ?, nim = ?, foto = ?, tanggal_laporan = ?, nama = ? WHERE id_admin = ?", [
            $data['id_mahasiswa'],
            $data['id_jenis_pelanggaran'],
            $data['status'],
            $data['komentar'],
            $data['id_admin'],
            $data['id_dosen'],
            $data['status_verifikasi_admin'],
            $data['nim'],
            $data['foto'],
            $data['tanggal_laporan'],
            $data['nama'],
            $id
        ]);
    }
    public function deleteData($id)
    {

        // query untuk delete data
        sqlsrv_query(
            $this->db,
            "delete from {$this->table} where id_pelanggaran = ?",
            [$id]
        );
    }
}
