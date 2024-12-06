<?php
include('Model.php');
include('Database.php');

class LaporModel extends Model
{
    protected $db;
    protected $table = 'tb_laporpelanggranmahasiswa';
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
        $columns = [ 'mahasiswa_id', 'id_jenis_pelanggaran', 'status', 'komentar', 'id_admin', 'id_dosen', 'status_verifikasi_admin', 'nim', 'foto', 'tanggal_laporan', 'nama'];

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

        // SQL Server query preparation for fetching data
        $query = "SELECT * FROM {$this->table} WHERE 1=1 ";


        // Prepare parameters for SQL Server
        $params = [$searchTerm, $searchTerm, $searchTerm, $start, $length];

        // Execute the query
        $stmt = sqlsrv_query($this->db, $query, $params);

        $data = [];
        if ($stmt) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
        }

        // Count total filtered records for SQL Server
        $queryFiltered = "SELECT *, COUNT(*) OVER() AS total_count FROM {$this->table} 
WHERE mahasiswa_id LIKE ? OR id_jenis_pelanggaran LIKE ? OR status LIKE ? OR komentar LIKE ? 
OR id_admin LIKE ? OR id_dosen LIKE ? OR status_verifikasi_admin LIKE ? OR nim LIKE ? 
OR foto LIKE ? OR tanggal_laporan LIKE ? OR nama LIKE ? 
ORDER BY {$orderColumn} {$orderDir} 
OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";


        $stmtFiltered = sqlsrv_query($this->db, $queryFiltered, [$searchTerm, $searchTerm, $searchTerm]);
        $totalFiltered = 0;
        if ($stmtFiltered) {
            $rowFiltered = sqlsrv_fetch_array($stmtFiltered, SQLSRV_FETCH_ASSOC);
            $totalFiltered = $rowFiltered['count'];
        }

        // Count total records for SQL Server
        $queryTotal = "SELECT COUNT(*) as count FROM {$this->table}";
        $stmtTotal = sqlsrv_query($this->db, $queryTotal);
        $totalRecords = 0;
        if ($stmtTotal) {
            $rowTotal = sqlsrv_fetch_array($stmtTotal, SQLSRV_FETCH_ASSOC);
            $totalRecords = $rowTotal['count'];
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
 
            // eksekusi query untuk menyimpan ke database
            sqlsrv_query($this->db, "INSERT INTO {$this->table} (mahasiswa_id, id_jenis_pelanggaran, status, komentar, id_admin, id_dosen, status_verifikasi_admin, nim, foto, tanggal_laporan, nama) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 
            array($data['mahasiswa_id'], $data['id_jenis_pelanggaran'], $data['status'], $data['komentar'], $data['id_admin'], $data['id_dosen'], $data['status_verifikasi_admin'], $data['nim'], $data['foto'], $data['tanggal_laporan'], $data['nama']));
                    
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
            $query = sqlsrv_query($this->db, "select * from {$this->table} where id_admin
= ?", [$id]);
            // ambil hasil query
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        
    }
    public function updateData($id, $data)
    {
     
            // query untuk update data
            sqlsrv_query($this->db, "UPDATE {$this->table} SET mahasiswa_id = ?, id_jenis_pelanggaran = ?, status = ?, komentar = ?, id_admin = ?, id_dosen = ?, status_verifikasi_admin = ?, nim = ?, foto = ?, tanggal_laporan = ?, nama = ? WHERE id_admin = ?", [
                $data['mahasiswa_id'],
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
                "delete from {$this->table} where id_admin = ?",
                [$id]
            );
        
    }
}
