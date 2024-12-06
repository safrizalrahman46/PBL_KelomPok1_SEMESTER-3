<?php
include('Model.php');
include('Database.php');

class AdminModel extends Model
{
    protected $db;
    protected $table = 'tb_admin';
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
    $columns = ['id_admin', 'email_admin', 'nama', 'username']; 

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
    
    // SQL Server query preparation for fetching data
    $query = "SELECT id_admin,email_admin, nama, username FROM {$this->table} INNER JOIN tb_users 
                ON {$this->table}.id_users = tb_users.id_users";

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
    $queryFiltered = "SELECT COUNT(*) as count FROM {$this->table} INNER JOIN tb_users 
                ON {$this->table}.id_users = tb_users.id_users";
    
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
            sqlsrv_query($this->db, "insert into {$this->table} ( email_admin, nama , id_users) values(?,?,?)", array( $data['email_admin'], $data['nama'], $data['id_users']));
        
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
            $query = sqlsrv_query($this->db, "select * from {$this->table} where id_admin = ?", [$id]);
            // ambil hasil query
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        
    }
    public function updateData($id, $data)
    {
       
            // query untuk update data
            sqlsrv_query($this->db, "update {$this->table} set  email_admin = ?, nama = ?, id_users = ? where id_admin = ?", [
                $data['email_admin'],
                $data['nama'],
                $data['id_users'],
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
