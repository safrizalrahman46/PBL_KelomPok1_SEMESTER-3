<?php
include('Model.php');
include('Database.php');

class KelasModel extends Model
{
    protected $db;
    protected $table = 'tb_kelas';
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
        $columns = ['id_kelas', 'nama_kelas', 'nama_dpa'];
    
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
            $query .= " WHERE nama_kelas LIKE ? OR nama_dpa LIKE ?";
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
            $queryFiltered .= " WHERE nama_kelas LIKE ? OR nama_dpa LIKE ?";
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

        if (!empty($searchValue)) {
            $queryTotal .= " WHERE nama_kelas LIKE ? OR nama_dpa LIKE ?";
            $filteredParams[] = $searchTerm;
            $filteredParams[] = $searchTerm;
        }


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
        if ($this->driver == 'mysql') {
            // prepare statement untuk query insert
            $query = $this->db->prepare("insert into {$this->table} (nama_kelas, nama_dpa, password_admin, tanggal_tugas) values(?,?,?,?)");
            // binding parameter ke query, "s" berarti string, "ss" berarti dua string
            $query->bind_param('sssi', $data['nama_kelas'], $data['nama_dpa'], $data['password_admin'], $data['tanggal_tugas']);
            // eksekusi query untuk menyimpan ke database
            $query->execute();
        } else {
            // eksekusi query untuk menyimpan ke database
            sqlsrv_query($this->db, "insert into {$this->table} (nama_kelas, nama_dpa) values(?,?)", array($data['nama_kelas'], $data['nama_dpa']));
        }
    }
    public function getData()
    {
        if ($this->driver == 'mysql') {
            // query untuk mengambil data dari tabel
            // return $this->db->query("select * from {$this->table} ")->fetch_all(MYSQLI_ASSOC);
        } else {

            // query untuk mengambil data dari tabel
            $query = sqlsrv_query($this->db, "select * from {$this->table}");
            $data = [];
            while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }
    public function getDataById($id)
    {
        // query untuk mengambil data berdasarkan id
        $query = sqlsrv_query($this->db, "select * from {$this->table} where id_kelas = ?", [$id]);
        // ambil hasil query
        return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    }
    public function updateData($id, $data)
    {
        if ($this->driver == 'mysql') {
            // query untuk update data
            $query = $this->db->prepare("update {$this->table} set nama_kelas = ?, nama_dpa = ?, password_admin = ?, tanggal_tugas = ? where id_kelas = ?");
            // binding parameter ke query
            $query->bind_param('sssii', $data['nama_kelas'], $data['nama_dpa'], $data['password_admin'], $data['tanggal_tugas'], $id);
            // eksekusi query
            $query->execute();
        } else {
           
            // query untuk update data
            $update = sqlsrv_query($this->db, "update {$this->table} set nama_kelas = ?, nama_dpa = ? where id_kelas = ?", [
                $data['nama_kelas'],
                $data['nama_dpa'],
                $id
            ]);

        }
    }
    public function deleteData($id)
    {
        if ($this->driver == 'mysql') {
            // query untuk delete data
            $query = $this->db->prepare("delete from {$this->table} where id_kelas = ?");
            // binding parameter ke query
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
        } else {
            // query untuk delete data
            sqlsrv_query(
                $this->db,
                "delete from {$this->table} where id_kelas = ?",
                [$id]
            );
        }
    }
}
