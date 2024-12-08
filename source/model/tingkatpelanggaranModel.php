<?php
include_once('Model.php');
include_once('Database.php');

class TingkatpelanggaranModel extends Model
{
    protected $db;
    protected $table = 'tb_tingkat_pelanggaran';
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
        $columns = ['id_tingkat_pelanggaran', 'nama_tingkat', 'deskripsi'];
    
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
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id_kelas';
    
        // SQL query for fetching data with search and pagination
        $query = "SELECT * FROM {$this->table}";
    
        $queryParams = [];
        if (!empty($searchValue)) {
            $query .= " WHERE nama_tingkat LIKE ? OR deskripsi LIKE ?";
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
        $queryFiltered = "SELECT COUNT(*) as count FROM {$this->table}";
        $filteredParams = [];
        if (!empty($searchValue)) {
            $queryFiltered .= " WHERE nama_tingkat LIKE ? OR deskripsi LIKE ?";
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
        $queryTotal = "SELECT COUNT(*) as count FROM {$this->table}";
        $filteredParams = [];

        // if (!empty($searchValue)) {
        //     $queryTotal .= " WHERE nama_tingkat LIKE ? OR deskripsi LIKE ?";
        //     $filteredParams[] = $searchTerm;
        //     $filteredParams[] = $searchTerm;
        // }


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



    // public function getDataForDataTables($request)
    // {
    //     // Columns available for ordering and searching
    //     $columns = ['id_tingkat_pelanggaran', 'nama_tingkat', 'deskripsi'];

    //     // Extract search and pagination parameters
    //     $searchValue = isset($request['search']['value']) ? $request['search']['value'] : '';
    //     $searchTerm = "%{$searchValue}%";

    //     $orderColumnIndex = isset($request['order'][0]['column']) ? (int)$request['order'][0]['column'] : 0;
    //     $orderDir = isset($request['order'][0]['dir']) && in_array(strtolower($request['order'][0]['dir']), ['asc', 'desc'])
    //         ? $request['order'][0]['dir']
    //         : 'asc';

    //     $start = isset($request['start']) ? (int)$request['start'] : 0;
    //     $length = isset($request['length']) ? (int)$request['length'] : 10;

    //     // Ensure column index is valid
    //     $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id_tingkat_pelanggaran';

    //     // SQL Server query preparation for fetching data
    //     $query = "SELECT * from {$this->table} WHERE nama_tingkat LIKE ? OR deskripsi LIKE ? ORDER BY {$orderColumn} {$orderDir} OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";

    //     // Prepare parameters for SQL Server
    //     $params = [$searchTerm, $searchTerm, $start, $length];

    //     // Execute the query
    //     $stmt = sqlsrv_query($this->db, $query, $params);

    //     $data = [];
    //     if ($stmt) {
    //         while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    //             $data[] = $row;
    //         }
    //     }

    //     // Count total filtered records for SQL Server
    //     $queryFiltered = "SELECT COUNT(*) as count FROM {$this->table} WHERE nama_tingkat LIKE ? OR deskripsi LIKE ?";
    //     $stmtFiltered = sqlsrv_query($this->db, $queryFiltered, [$searchTerm, $searchTerm]);
    //     $totalFiltered = 0;
    //     if ($stmtFiltered) {
    //         $rowFiltered = sqlsrv_fetch_array($stmtFiltered, SQLSRV_FETCH_ASSOC);
    //         if ($rowFiltered) {
    //             $totalFiltered = $rowFiltered['count'];
    //         }
    //     }

    //     // Count total records for SQL Server
    //     $queryTotal = "SELECT COUNT(*) as count FROM {$this->table}";
    //     $stmtTotal = sqlsrv_query($this->db, $queryTotal);
    //     $totalRecords = 0;
    //     if ($stmtTotal) {
    //         $rowTotal = sqlsrv_fetch_array($stmtTotal, SQLSRV_FETCH_ASSOC);
    //         if ($rowTotal) {
    //             $totalRecords = $rowTotal['count'];
    //         }
    //     }

    //     // Return data in DataTables format
    //     return [
    //         "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
    //         "recordsTotal" => $totalRecords,
    //         "recordsFiltered" => $totalFiltered,
    //         "data" => $data
    //     ];
    // }




    public function insertData($data)
    {

        // eksekusi query untuk menyimpan ke database
        sqlsrv_query($this->db, "insert into {$this->table} (nama_tingkat, deskripsi) values(?,?)", array($data['nama_tingkat'], $data['deskripsi']));
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
        $query = sqlsrv_query($this->db, "select * from {$this->table} where id_tingkat_pelanggaran
= ?", [$id]);
        // ambil hasil query
        return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    }
    public function updateData($id, $data)
    {

        // query untuk update data
        sqlsrv_query($this->db, "update {$this->table} set nama_tingkat = ?, deskripsi = ? where id_tingkat_pelanggaran = ?", [
            $data['nama_tingkat'],
            $data['deskripsi'],

            $id
        ]);
    }
    public function deleteData($id)
    {

        // query untuk delete data
        sqlsrv_query(
            $this->db,
            "delete from {$this->table} where id_tingkat_pelanggaran = ?",
            [$id]
        );
    }
}
