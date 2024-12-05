<?php
include('Model.php');
include('Database.php');

class UserModel extends Model
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
            $query = $this->db->prepare("select * from {$this->table} where id_users = ?");
            // binding parameter ke query "i" berarti integer. Biar tidak kena SQL Injection
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
            // ambil hasil query
            return $query->get_result()->fetch_assoc();
        } else {
            // query untuk mengambil data berdasarkan id
            $query = sqlsrv_query($this->db, "select * from {$this->table} where id_users =
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
            password = ?, level = ? where id_users = ?");
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
            = ?, level = ? where id_users = ?", [
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
            $query = $this->db->prepare("delete from {$this->table} where id_users = ?");
            // binding parameter ke query
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
        } else {
            // query untuk delete data
            sqlsrv_query($this->db, "delete from {$this->table} where id_users = ?", [$id]);
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
