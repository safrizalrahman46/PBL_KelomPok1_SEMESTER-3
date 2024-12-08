<?php
include_once('Model.php');
include_once('Database.php');

class ProdiModel extends Model
{
    protected $db;
    protected $table = 'tb_prodi';
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
        $columns = ['nama_prodi'];
    
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
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'id_prodi';
    
        // SQL query for fetching data with search and pagination
        $query = "SELECT * FROM {$this->table} WHERE 1=1";
    
        $queryParams = [];
        if (!empty($searchValue)) {
            $query .= " AND nama_prodi LIKE ?";
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
        $queryFiltered = "SELECT COUNT(*) as count FROM {$this->table} WHERE 1=1";
        $filteredParams = [];
        if (!empty($searchValue)) {
            $queryFiltered .= " AND nama_prodi LIKE ?";
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
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("INSERT INTO {$this->table} (nama_prodi) VALUES (?)");
            $query->bind_param('si', $data['nama_prodi']);
            $query->execute();
        } else {
            sqlsrv_query($this->db, "INSERT INTO {$this->table} (nama_prodi) VALUES (?)", [
                $data['nama_prodi']
            ]);
        }
    }

    public function getData()
    {
        if ($this->driver == 'mysql') {
            return $this->db->query("SELECT * FROM {$this->table}")->fetch_all(MYSQLI_ASSOC);
        } else {
            $query = sqlsrv_query($this->db, "SELECT * FROM {$this->table}");
            $data = [];
            while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getDataById($id)
    {
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE id_prodi = ?");
            $query->bind_param('i', $id);
            $query->execute();
            return $query->get_result()->fetch_assoc();
        } else {
            $query = sqlsrv_query($this->db, "SELECT * FROM {$this->table} WHERE id_prodi = ?", [$id]);
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        }
    }

    public function updateData($id, $data)
    {
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("UPDATE {$this->table} SET nama_prodi = ? WHERE id_prodi = ?");
            $query->bind_param('sii', $data['nama_prodi'], $id);
            $query->execute();
        } else {
            sqlsrv_query($this->db, "UPDATE {$this->table} SET nama_prodi = ? WHERE id_prodi = ?", [
                $data['nama_prodi'],

                $id
            ]);
        }
    }

    public function deleteData($id)
    {
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("DELETE FROM {$this->table} WHERE id_prodi = ?");
            $query->bind_param('i', $id);
            $query->execute();
        } else {
            sqlsrv_query($this->db, "DELETE FROM {$this->table} WHERE id_prodi = ?", [$id]);
        }
    }
}
