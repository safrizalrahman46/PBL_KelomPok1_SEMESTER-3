<?php
include('Model.php');
class AdminModel extends Model
{
    protected $db;
    protected $table = 'tb_admin';
    protected $driver;
    public function __construct()
    {
       include_once('../lib/Connection.php');
        $this->db = $db;
        $this->driver = $use_driver;
    }

    public function getDataForDataTables($request)
{
    // Columns available for ordering and searching
    $columns = ['id_admin', 'nama_admin', 'email_admin', 'id_kelas', 'nama_kelas']; 

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
    $query = "SELECT a.id_admin, a.nama_admin, a.email_admin, k.nama_kelas
              FROM {$this->table} a
              LEFT JOIN tb_kelas k ON a.id_kelas = k.id_kelas
              WHERE a.nama_admin LIKE ? OR a.email_admin LIKE ? OR k.nama_kelas LIKE ?
              ORDER BY {$orderColumn} {$orderDir}
              OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";

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
    $queryFiltered = "SELECT COUNT(*) as count
                      FROM {$this->table} a
                      LEFT JOIN tb_kelas k ON a.id_kelas = k.id_kelas
                      WHERE a.nama_admin LIKE ? OR a.email_admin LIKE ? OR k.nama_kelas LIKE ?";
    
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
        if ($this->driver == 'sqlsrv') {
            // prepare statement untuk query insert
            $query = $this->db->prepare("insert into {$this->table} (nama_admin, email_admin, password_admin, id_kelas) values(?,?,?,?)");
            // binding parameter ke query, "s" berarti string, "ss" berarti dua string
            $query->bind_param('sssi', $data['nama_admin'], $data['email_admin'], $data['password_admin'], $data['id_kelas']);
            // eksekusi query untuk menyimpan ke database
            $query->execute();
        } else {
            // eksekusi query untuk menyimpan ke database
            sqlsrv_query($this->db, "insert into {$this->table} (nama_admin, email_admin, password_admin, id_kelas) values(?,?,?,?)", array($data['nama_admin'], $data['email_admin'], $data['password_admin'], $data['id_kelas']));
        }
    }
    public function getData()
    {
        if ($this->driver == 'sqlsrv') {
            // query untuk mengambil data dari tabel
            return $this->db->query("select * from {$this->table} ")->fetch_all(MYSQLI_ASSOC);
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
        if ($this->driver == 'sqlsrv') {
            // query untuk mengambil data berdasarkan id
            $query = $this->db->prepare("select * from {$this->table} where id_admin =
?");
            // binding parameter ke query "i" berarti integer. Biar tidak kena SQL Injection
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
            // ambil hasil query
            return $query->get_result()->fetch_assoc();
        } else {
            // query untuk mengambil data berdasarkan id
            $query = sqlsrv_query($this->db, "select * from {$this->table} where id_admin
= ?", [$id]);
            // ambil hasil query
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        }
    }
    public function updateData($id, $data)
    {
        if ($this->driver == 'mysql') {
            // query untuk update data
            $query = $this->db->prepare("update {$this->table} set nama_admin = ?, email_admin = ?, password_admin = ?, id_kelas = ? where id_admin = ?");
            // binding parameter ke query
            $query->bind_param('sssii',  $data['nama_admin'], $data['email_admin'], $data['password_admin'], $data['id_kelas'], $id);
            // eksekusi query
            $query->execute();
        } else {
            // query untuk update data
            sqlsrv_query($this->db, "update {$this->table} set nama_admin = ?, email_admin = ?, password_admin = ?, id_kelas = ? where id_admin = ?", [
                $data['nama_admin'],
                $data['email_admin'],
                $data['password_admin'],
                $data['id_kelas'],
                $id
            ]);
        }
    }
    public function deleteData($id)
    {
        if ($this->driver == 'mysql') {
            // query untuk delete data
            $query = $this->db->prepare("delete from {$this->table} where id_admin = ?");
            // binding parameter ke query
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
        } else {
            // query untuk delete data
            sqlsrv_query(
                $this->db,
                "delete from {$this->table} where id_admin = ?",
                [$id]
            );
        }
    }
}
