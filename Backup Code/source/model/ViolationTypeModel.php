<?php
include('Model.php');

class ViolationTypeModel extends Model
{
    protected $db;
    protected $table = 'violation_type'; // Change to violation_type
    protected $driver;

    public function __construct()
    {
        include_once('../lib/Connection.php');
        $this->db = $db;
        $this->driver = $use_driver;
    }

    public function insertData($data)
    {
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("INSERT INTO {$this->table} (description, level_id, penalty_points, sanction) VALUES (?, ?, ?, ?)");
            $query->bind_param('siis', $data['description'], $data['level_id'], $data['penalty_points'], $data['sanction']);
            $query->execute();
        } else {
            sqlsrv_query($this->db, "INSERT INTO {$this->table} (description, level_id, penalty_points, sanction) VALUES (?, ?, ?, ?)", array($data['description'], $data['level_id'], $data['penalty_points'], $data['sanction']));
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
            $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $query->bind_param('i', $id);
            $query->execute();
            return $query->get_result()->fetch_assoc();
        } else {
            $query = sqlsrv_query($this->db, "SELECT * FROM {$this->table} WHERE id = ?", [$id]);
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        }
    }

    public function updateData($id, $data)
    {
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("UPDATE {$this->table} SET description = ?, level_id = ?, penalty_points = ?, sanction = ? WHERE id = ?");
            $query->bind_param('siisi', $data['description'], $data['level_id'], $data['penalty_points'], $data['sanction'], $id);
            $query->execute();
        } else {
            sqlsrv_query($this->db, "UPDATE {$this->table} SET description = ?, level_id = ?, penalty_points = ?, sanction = ? WHERE id = ?", [
                $data['description'],
                $data['level_id'],
                $data['penalty_points'],
                $data['sanction'],
                $id
            ]);
        }
    }

    public function deleteData($id)
    {
        if ($this->driver == 'mysql') {
            $query = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
            $query->bind_param('i', $id);
            $query->execute();
        } else {
            sqlsrv_query($this->db, "DELETE FROM {$this->table} WHERE id = ?", [$id]);
        }
    }
}