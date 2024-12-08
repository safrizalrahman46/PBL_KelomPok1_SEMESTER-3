<?php
include_once('Model.php');
include_once('Database.php');

class TipeNotikasiModel extends Model
{
    protected $db;
    protected $table = 'tb_tipe_notifikasi';
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
        $columns = ['notif_template'];
    
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
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'notif_template';
    
        // SQL query for fetching data with search and pagination
        $query = "SELECT * FROM {$this->table}";
        $queryParams = [];
    
        // Apply search filter if search term is present
        if (!empty($searchValue)) {
            $query .= " WHERE notif_template LIKE ?";
            $queryParams[] = $searchTerm;
        }
    
        // Add pagination and ordering
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
    
        // Count total filtered records (without pagination)
        $queryFiltered = "SELECT COUNT(*) as count FROM {$this->table}";
        $filteredParams = [];
        if (!empty($searchValue)) {
            $queryFiltered .= " WHERE notif_template LIKE ?";
            $filteredParams[] = $searchTerm;
        }
    
        // Execute the count query for filtered records
        $stmtFiltered = sqlsrv_query($this->db, $queryFiltered, $filteredParams);
        $totalFiltered = 0;
        if ($stmtFiltered) {
            $rowFiltered = sqlsrv_fetch_array($stmtFiltered, SQLSRV_FETCH_ASSOC);
            $totalFiltered = $rowFiltered ? $rowFiltered['count'] : 0;
        }
    
        // Count total records (unfiltered)
        $queryTotal = "SELECT COUNT(*) as count FROM {$this->table}";
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

        // eksekusi query untuk menyimpan ke database
        sqlsrv_query($this->db, "insert into {$this->table} (notif_template) values(?)", array($data['notif_template']));
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
        $query = sqlsrv_query($this->db, "select * from {$this->table} where id_tipe_notifikasi = ?", [$id]);
        // ambil hasil query
        return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    }
    public function updateData($id, $data)
    {

        // query untuk update data
        $update = sqlsrv_query($this->db, "update {$this->table} set notif_template = ? where id_tipe_notifikasi = ?", [
            $data['notif_template'],
            $id
        ]);
    }
    public function deleteData($id)
    {

        // query untuk delete data
        $delete = sqlsrv_query(
            $this->db,
            "delete from {$this->table} where id_tipe_notifikasi = ?",
            [$id]
        );

    }
}
