<?php
include('Model.php');
class MahasiswaModel extends Model
{
    protected $db;
    protected $table = 'mahasiswa';
    protected $driver;
    public function __construct()
    {
       include_once('lib/Connection.php');
        $this->db = $db;
        $this->driver = $use_driver;
    }
    public function insertData($data)
    {
        if ($this->driver == 'mysql') {
            // prepare statement untuk query insert
            $query = $this->db->prepare("insert into {$this->table} (name, department_id, email, NIM, username, password, total_violation_points, total_reward_points, semester, tingkat, foto, status, jurusan, prodi) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            // binding parameter ke query, "s" berarti string, "ss" berarti dua string
            $query->bind_param('sissssiiisssss', $data['name'], $data['department_id'], $data['email'], $data['NIM'], $data['username'], $data['password'], $data['total_violation_points'], $data['total_reward_points'], $data['semester'], $data['tingkat'], $data['foto'], $data['status'], $data['jurusan'], $data['prodi']);
            // eksekusi query untuk menyimpan ke database
            $query->execute();
        } else {
            // eksekusi query untuk menyimpan ke database
            sqlsrv_query($this->db, "insert into {$this->table} (name, department_id, email, NIM, username, password, total_violation_points, total_reward_points, semester, tingkat, foto, status, jurusan, prodi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array($data['name'], $data['department_id'], $data['email'], $data['NIM'], $data['username'], $data['password'], $data['total_violation_points'], $data['total_reward_points'], $data['semester'], $data['tingkat'], $data['foto'], $data['status'], $data['jurusan'], $data['prodi']));
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
            $query = $this->db->prepare("select * from {$this->table} where id = ?");
            // binding parameter ke query "i" berarti integer. Biar tidak kena SQL Injection
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
            // ambil hasil query
            return $query->get_result()->fetch_assoc();
        } else {
            // query untuk mengambil data berdasarkan id
            $query = sqlsrv_query($this->db, "select * from {$this->table} where id = ?", [$id]);
            // ambil hasil query
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        }
    }
    public function updateData($id, $data)
    {
        if ($this->driver == 'mysql') {
            // query untuk update data
            $query = $this->db->prepare("update {$this->table} set  name = ?, department_id = ?, email = ?, NIM = ?, username = ?, password = ?, total_violation_points = ?, total_reward_points = ?, semester = ?, tingkat = ?, foto = ?, status = ?, jurusan = ?, prodi = ?  where id = ?");
            // binding parameter ke query
            $query->bind_param('sissssiiisssssi', $data['name'], $data['department_id'], $data['email'], $data['NIM'], $data['username'], $data['password'], $data['total_violation_points'], $data['total_reward_points'], $data['semester'], $data['tingkat'], $data['foto'], $data['status'], $data['jurusan'], $data['prodi'], $id);
            // eksekusi query
            $query->execute();
        } else {
            // query untuk update data
            sqlsrv_query($this->db, "update {$this->table} set  name = ?, department_id = ?, email = ?, NIM = ?, username = ?, password = ?, total_violation_points = ?, total_reward_points = ?, semester = ?, tingkat = ?, foto = ?, status = ?, jurusan = ?, prodi = ?  where id = ?", [
                $data['name'],
                $data['department_id'],
                $data['email'],
                $data['NIM'],
                $data['username'],
                $data['password'],
                $data['total_violation_points'],
                $data['total_reward_points'],
                $data['semester'],
                $data['tingkat'],
                $data['foto'],
                $data['status'],
                $data['jurusan'],
                $data['prodi'],
                $id
            ]);
        }
    }
    public function deleteData($id)
    {
        if ($this->driver == 'mysql') {
            // query untuk delete data
            $query = $this->db->prepare("delete from {$this->table} where id = ?");
            // binding parameter ke query
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
        } else {
            // query untuk delete data
            sqlsrv_query(
                $this->db,
                "delete from {$this->table} where id = ?",
                [$id]
            );
        }
    }
}
