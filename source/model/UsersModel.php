<?php
include('Model.php');
include('Database.php');

class UsersModel extends Model
{
    protected $db;
    protected $table = 'tb_users';
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
        $columns = ['username','password','level'];


        // Extract search and pagination parameters
        $searchValue = isset($request['search']['value']) ? $request['search']['value'] : '';
        $searchTerm = "%{$searchValue}%";

        $orderColumnIndex = isset($request['order'][0]['column']) ? (int) $request['order'][0]['column'] : 0;
        $orderDir = isset($request['order'][0]['dir']) && in_array(strtolower($request['order'][0]['dir']), ['asc', 'desc'])
            ? $request['order'][0]['dir']
            : 'asc';

        $start = isset($request['start']) ? (int) $request['start'] : 0;
        $length = isset($request['length']) ? (int) $request['length'] : 10;

        // Ensure column index is valid
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id_users';

        // SQL Server query preparation for fetching data
        $query = "SELECT * FROM {$this->table} ";

        // Prepare parameters for SQL Server
        $params = [$searchTerm, $searchTerm, $start, $length];

        // Execute the query
        $stmt = sqlsrv_query($this->db, $query, $params);

        $data = [];
        if ($stmt) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
        }

        // Count total filtered records for SQL Server
        $queryFiltered = "SELECT COUNT(*) as count FROM {$this->table} WHERE username LIKE ? password LIKE ? level LIKE ?";
        $stmtFiltered = sqlsrv_query($this->db, $queryFiltered, [$searchTerm, $searchTerm]);
        $totalFiltered = 0;
        if ($stmtFiltered) {
            $rowFiltered = sqlsrv_fetch_array($stmtFiltered, SQLSRV_FETCH_ASSOC);
            if ($rowFiltered) {
                $totalFiltered = $rowFiltered['count'];
            }
        }

        // Count total records for SQL Server
        $queryTotal = "SELECT COUNT(*) as count FROM {$this->table}";
        $stmtTotal = sqlsrv_query($this->db, $queryTotal);
        $totalRecords = 0;
        if ($stmtTotal) {
            $rowTotal = sqlsrv_fetch_array($stmtTotal, SQLSRV_FETCH_ASSOC);
            if ($rowTotal) {
                $totalRecords = $rowTotal['count'];
            }
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
        sqlsrv_query($this->db, "insert into {$this->table} (username, password, level) values(?,?,?)", array($data['username'], $data['password'], $data['level']));
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
        $query = sqlsrv_query($this->db, "select * from {$this->table} where id_users = ?", [$id]);
        // ambil hasil query
        return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    }
    public function updateData($id, $data)
    {

        // query untuk update data
        $update = sqlsrv_query($this->db, "update {$this->table} set username = ?, password = ?, level = ? where id_users = ?", [
            $data['username'],
            $data['password'],
            $data['level'],

            $id
        ]);
    }
    public function deleteData($id)
    {

        // query untuk delete data
        sqlsrv_query(
            $this->db,
            "delete from {$this->table} where id_users = ?",
            [$id]
        );
    }
}
