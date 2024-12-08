<?php
include_once('Model.php');
include_once('Database.php');
class AdminTaskLogModel extends Model
{
    protected $db;
    protected $table = 'admin_task_log';
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
            $query = $this->db->prepare("insert into {$this->table} (admin_id, task_description, task_date) values(?,?,?)");
            // binding parameter ke query, "s" berarti string, "ss" berarti dua string
            $query->bind_param('sssi',  $data['admin_id'], $data['task_description'], $data['task_date']);
            // eksekusi query untuk menyimpan ke database
            $query->execute();
        } else {
            // eksekusi query untuk menyimpan ke database
            sqlsrv_query($this->db, "insert into {$this->table} (admin_id, task_description, task_date) values(?,?,?)", array($data['admin_id'], $data['task_description'], $data['task_date']));
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
            $query = $this->db->prepare("select * from {$this->table} where id_log = ?");
            // binding parameter ke query "i" berarti integer. Biar tidak kena SQL Injection
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
            // ambil hasil query
            return $query->get_result()->fetch_assoc();
        } else {
            // query untuk mengambil data berdasarkan id
            $query = sqlsrv_query($this->db, "select * from {$this->table} where id_log = ?", [$id]);
            // ambil hasil query
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        }
    }
    public function updateData($id, $data)
    {
        if ($this->driver == 'mysql') {
            // query untuk update data
            $query = $this->db->prepare("update {$this->table} set admin_id = ?, task_description = ?, task_date = ? where id_log = ?");
            // binding parameter ke query
            $query->bind_param('issi', $data['admin_id'], $data['task_description'], $data['task_date'], $id);
            // eksekusi query
            $query->execute();
        } else {
            // query untuk update data
            sqlsrv_query($this->db, "update {$this->table} set admin_id = ?, task_description = ?, task_date = ? where id_log = ?", [
                $data['admin_id'],
                $data['task_description'],
                $data['task_date'],
                $id
            ]);
        }
    }
    public function deleteData($id)
    {
        if ($this->driver == 'mysql') {
            // query untuk delete data
            $query = $this->db->prepare("delete from {$this->table} where id_log = ?");
            // binding parameter ke query
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
        } else {
            // query untuk delete data
            sqlsrv_query(
                $this->db,
                "delete from {$this->table} where id_log = ?",
                [$id]
            );
        }
    }
}
