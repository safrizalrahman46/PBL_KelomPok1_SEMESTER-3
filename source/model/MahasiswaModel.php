<?php
include_once('Model.php');
include_once('Database.php');

class MahasiswaModel extends Model
{
    protected $db;
    protected $table = 'tb_mahasiswa';
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
            $columns = [ 'email', 'semester', 'tingkat', 'foto', 'status', 'prodi', 'id_pelanggaran', 'id_prodi', 'NIM', 'id_users', 'nama'];
        
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
            $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id_admin';
        
            // SQL query for fetching data with search and pagination
            $query = "SELECT * FROM {$this->table}  
            INNER JOIN tb_users ON {$this->table}.id_users = tb_users.id_users";
        
            $queryParams = [];
            if (!empty($searchValue)) {
                $query .= " WHERE {$this->table}.nama LIKE ? OR {$this->table}.email LIKE ? OR tb_users.username LIKE ?";
                $queryParams[] = $searchTerm;
                $queryParams[] = $searchTerm;
                $queryParams[] = $searchTerm;
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
            $queryFiltered = "SELECT COUNT(*) as count FROM tb_admin";
            $filteredParams = [];
            if (!empty($searchValue)) {
                $queryFiltered ." WHERE {$this->table}.nama LIKE ? OR {$this->table}.email LIKE ? OR tb_users.username LIKE ?";
                $filteredParams[] = $searchTerm;
                $filteredParams[] = $searchTerm;
                $filteredParams[] = $searchTerm;
            }
        
            $stmtFiltered = sqlsrv_query($this->db, $queryFiltered, $filteredParams);
            $totalFiltered = 0;
            if ($stmtFiltered) {
                $rowFiltered = sqlsrv_fetch_array($stmtFiltered, SQLSRV_FETCH_ASSOC);
                $totalFiltered = $rowFiltered ? $rowFiltered['count'] : 0;
            }
        
            // Count total records
            $queryTotal = "SELECT COUNT(*) as count FROM tb_admin";
            $stmtTotal = sqlsrv_query($this->db, $queryTotal, $filteredParams);
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

        // eksekusi query untuk menyimpan ke database
        sqlsrv_query($this->db, "INSERT INTO {$this->table} (email, semester, tingkat, foto, status , id_prodi, id_kelas, id_users, nama) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", array($data['email'], $data['semester'], $data['tingkat'], $data['foto'], $data['status'], $data['id_prodi'], $data['id_kelas'], $data['id_users'], $data['nama']));
   
        // $stmt = sqlsrv_query(conn: $this->db, $query, $params);
    
        // if ($stmt === false) {
        //     die(print_r(sqlsrv_errors(), true)); // Output error if the query fails
        // }
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
        $query = sqlsrv_query($this->db, "select {$this->table}.*,tb_users.username,tb_users.password from {$this->table} INNER JOIN tb_users ON {$this->table}.id_users = tb_users.id_users where {$this->table}.nim = ? ", [$id]);
        // ambil hasil query
        return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    }
    public function updateData($id, $data)
    {
        if(!empty($data['foto'])) {

            $update = sqlsrv_query($this->db, "UPDATE {$this->table} SET email = ?, semester = ?, tingkat = ?, foto = ?, status = ?,   id_prodi = ?, id_kelas = ?,  nama = ? WHERE nim = ?", [
                $data['email'],
                $data['semester'],
                $data['tingkat'],
                $data['foto'],
                $data['status'],
                $data['id_prodi'],
                $data['id_kelas'],
                $data['nama'],
                $id
            ]);
        } else {
            $update = sqlsrv_query($this->db, "UPDATE {$this->table} SET email = ?, semester = ?, tingkat = ?,  status = ?,   id_prodi = ?, id_kelas = ?,  nama = ? WHERE nim = ?", [
                $data['email'],
                $data['semester'],
                $data['tingkat'],
                $data['status'],
                $data['id_prodi'],
                $data['id_kelas'],
                $data['nama'],
                $id
            ]);
        }
    }
    public function deleteData($id)
    {

        // query untuk delete data
        sqlsrv_query(
            $this->db,
            "delete from {$this->table} where nim = ?",
            [$id]
        );
    }
}
