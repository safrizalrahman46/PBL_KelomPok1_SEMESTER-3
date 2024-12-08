<?php
include_once('Model.php');
include_once('Database.php');

class DosenModel extends Model
{
    protected $db;
    protected $table = 'tb_dosen';
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
        $columns = ['email', 'username', 'nama', 'alamat', 'no_telepon'];

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
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'nip';

        // SQL query for fetching data with search and pagination
        $query = "SELECT * FROM {$this->table}";

        $queryParams = [];
        if (!empty($searchValue)) {
            $query .= " WHERE 
                        tb_dosen.email LIKE ? OR 
                         tb_dosen.id_users LIKE ? OR 
                        tb_dosen.nama LIKE ? OR 
                        tb_dosen.alamat LIKE ? OR 
                        tb_dosen.no_telepon LIKE ? OR 
                        ";
            $queryParams[] = $searchTerm;
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
        $queryFiltered = "SELECT COUNT(*) as count FROM tb_dosen
                          INNER JOIN tb_users ON tb_dosen.id_users = tb_users.id_users";
        $filteredParams = [];
        if (!empty($searchValue)) {
            $queryFiltered .= " WHERE 
                               tb_dosen.email LIKE ? OR
                                tb_dosen.id_users LIKE ? OR  
                               tb_dosen.nama LIKE ? OR 
                               tb_dosen.alamat LIKE ? OR 
                               tb_dosen.no_telepon LIKE ? OR 
                               ";
            $filteredParams[] = $searchTerm;
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
        $queryTotal = "SELECT COUNT(*) as count FROM tb_dosen
                       INNER JOIN tb_users ON tb_dosen.id_users = tb_users.id_users";
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
        $check = sqlsrv_query($this->db, "insert into {$this->table} ( email, id_users, nama, alamat, no_telepon) values(?,?,?,?,?)", 
        array(
            $data['email'], 
            $data['id_users'], 
            $data['nama'], 
            $data['alamat'], 
            $data['no_telepon']
        ));

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
        $query = sqlsrv_query($this->db, "select * from {$this->table} where nip = ?", [$id]);
        // ambil hasil query
        return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    }
    public function updateData($id, $data)
    {

        // query untuk update data
        sqlsrv_query($this->db, "UPDATE {$this->table} SET email = ?, id_users = ?, nama = ?, alamat = ?, no_telepon = ? WHERE nip = ?", [
            $data['email'],
            $data['id_users'],
            $data['nama'],
            $data['alamat'],
            $data['no_telepon'],
            $id
        ]);
    }
    public function deleteData($id)
    {

        // query untuk delete data
        sqlsrv_query(
            $this->db,
            "delete from {$this->table} where nip = ?",
            [$id]
        );
    }
}
