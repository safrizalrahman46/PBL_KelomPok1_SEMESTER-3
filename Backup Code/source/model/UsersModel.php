<?php
include('Model.php');
class UsersModel extends Model
{
    protected $db;
    protected $table = 'users';
    protected $driver;
    public function __construct()
    {
        include('../lib/Connection.php');
        $this->db = $db;
        $this->driver = $use_driver;
    }
    public function insertData($data)
    {
        if ($this->driver == 'mysql') {
            // prepare statement untuk query insert
            $query = $this->db->prepare("insert into {$this->table} (nama, username, password,
            level) values(?,?,?,?)");
            // binding parameter ke query, "s" berarti string, "ss" berarti dua string
            $query->bind_param(
                'ssss',
                $data['nama'],
                $data['username'],
                $data['level'],
                password_hash($data['password'], PASSWORD_DEFAULT)
            );
            // eksekusi query untuk menyimpan ke database
            $query->execute();
        } else {
            // eksekusi query untuk menyimpan ke database
            sqlsrv_query($this->db, "insert into {$this->table} (nama, username, password,
            level) values(?,?,?,?)", array(
                $data['nama'],
                $data['username'],
                $data['level'],
                password_hash($data['password'], PASSWORD_DEFAULT)
            ));
        }
    }
    public function getData()
    {
        if ($this->driver == 'mysql') {
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
        if ($this->driver == 'mysql') {
            // query untuk mengambil data berdasarkan id
            $query = $this->db->prepare("select * from {$this->table} where user_id = ?");
            // binding parameter ke query "i" berarti integer. Biar tidak kena SQL Injection
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
            // ambil hasil query
            return $query->get_result()->fetch_assoc();
        } else {
            // query untuk mengambil data berdasarkan id
            $query = sqlsrv_query($this->db, "select * from {$this->table} where user_id =
    ?", [$id]);
            // ambil hasil query
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        }
    }
    public function updateData($id, $data)
    {
        if ($this->driver == 'mysql') {
            // query untuk update data
            $query = $this->db->prepare("update {$this->table} set nama = ?, username = ?,
            password = ?, level = ? where user_id = ?");
            // binding parameter ke query
            $query->bind_param(
                'ssssi',
                $data['nama'],
                $data['username'],
                $data['level'],
                password_hash($data['password'], PASSWORD_DEFAULT),
                $id
            );
            // eksekusi query
            $query->execute();
        } else {
            // query untuk update data
            sqlsrv_query($this->db, "update {$this->table} set nama = ?, username = ?, password
            = ?, level = ? where user_id = ?", [
                $data['nama'],
                $data['username'],
                $data['level'],
                password_hash($data['password'], PASSWORD_DEFAULT),
                $id
            ]);
        }
    }
    public function deleteData($id)
    {
        if ($this->driver == 'mysql') {
            // query untuk delete data
            $query = $this->db->prepare("delete from {$this->table} where user_id = ?");
            // binding parameter ke query
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
        } else {
            // query untuk delete data
            sqlsrv_query($this->db, "delete from {$this->table} where user_id = ?", [$id]);
        }
    }
//     public function getSingleDataByKeyword($column, $keyword)
// {
//     if ($this->driver == 'mysql') {
//         // query untuk mengambil data berdasarkan kolom tertentu
//         $query = sqlsrv_query(
//             $this->db,
//             "SELECT * FROM {$this->table} WHERE {$column} = ?",
//             [$keyword]
//         );
        
//         // Periksa apakah query berhasil
//         if ($query === false) {
//             die(print_r(sqlsrv_errors(), true));
//         }
        
//         // Ambil hasil query
//         return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
//     } else {
//         // query untuk driver lain (contohnya MySQLi)
//         $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$column} = ?");
//         $query->bind_param('s', $keyword);
//         $query->execute();
//         return $query->get_result()->fetch_assoc();
//     }
// }

public function getTotalRecords()
{
    if ($this->driver == 'mysql') {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM {$this->table}");
        return $query->fetch_assoc()['total'];
    } else {
        $query = sqlsrv_query($this->db, "SELECT COUNT(*) AS total FROM {$this->table}");
        $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        return $result['total'];
    }
}

// /**
//  * Get filtered records with pagination and search.
//  *
//  * @param int    $start        Starting record index
//  * @param int    $length       Number of records to fetch
//  * @param string $searchValue  Search value for filtering
//  */
public function getFilteredRecords($start, $length, $searchValue)
{
    if ($this->driver == 'mysql') {
        // Build query with search filter
        $searchQuery = '';
        if (!empty($searchValue)) {
            $searchQuery = " WHERE nama LIKE ? OR username LIKE ? OR level LIKE ?";
        }

        // Prepare statement with LIMIT for pagination
        $query = $this->db->prepare(
            "SELECT * FROM {$this->table}{$searchQuery} LIMIT ?, ?"
        );

        if (!empty($searchValue)) {
            $searchValue = '%' . $searchValue . '%';
            $query->bind_param('sssii', $searchValue, $searchValue, $searchValue, $start, $length);
        } else {
            $query->bind_param('ii', $start, $length);
        }

        $query->execute();
        return $query->get_result()->fetch_all(MYSQLI_ASSOC);
    } else {
        // For SQL Server, use OFFSET-FETCH for pagination
        $searchQuery = '';
        $params = [];
        if (!empty($searchValue)) {
            $searchQuery = " WHERE nama LIKE ? OR username LIKE ? OR level LIKE ?";
            $searchValue = '%' . $searchValue . '%';
            $params = [$searchValue, $searchValue, $searchValue];
        }

        $query = sqlsrv_query(
            $this->db,
            "SELECT * FROM {$this->table}{$searchQuery} ORDER BY user_id OFFSET ? ROWS FETCH NEXT ? ROWS ONLY",
            array_merge($params, [$start, $length])
        );

        $data = [];
        while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
}


    public function getSingleDataByKeyword($column, $keyword)
    {
        if ($this->driver == 'mysql') {
            // query untuk mengambil data berdasarkan id
            $query = $this->db->prepare("select * from {$this->table} where {$column} = ?");
            
            // binding parameter ke query "i" berarti integer. Biar tidak kena SQL Injection
            $query->bind_param('s', $keyword);
            // eksekusi query
            $query->execute();
            return $query->get_result()->fetch_assoc();
        } else {
            // query untuk mengambil data berdasarkan id
            $query = sqlsrv_query($this->db, "select * from {$this->table} where {$column} =
            ?", [$keyword]);
            // ambil hasil query
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        }
    }
}
