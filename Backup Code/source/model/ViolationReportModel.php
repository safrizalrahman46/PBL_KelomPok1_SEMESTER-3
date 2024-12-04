<?php
include('Model.php');

class ViolationReportModel extends Model
{
    protected $db;
    protected $table = 'violation_report'; // Sesuaikan dengan nama tabel
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
            $query = $this->db->prepare("INSERT INTO {$this->table} (submitted_by, violation_type, report_date, status, reviewed_by, resolution_date, comments, dpa_verification_status, faculty_involved_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $query->bind_param('iississbi', $data['submitted_by'], $data['violation_type'], $data['report_date'], $data['status'], $data['reviewed_by'], $data['resolution_date'], $data['comments'], $data['dpa_verification_status'], $data['faculty_involved_id']);
            $query->execute();
        } else {
            sqlsrv_query($this->db, "INSERT INTO {$this->table} (submitted_by, violation_type, report_date, status, reviewed_by, resolution_date, comments, dpa_verification_status, faculty_involved_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", array($data['submitted_by'], $data['violation_type'], $data['report_date'], $data['status'], $data['reviewed_by'], $data['resolution_date'], $data['comments'], $data['dpa_verification_status'], $data['faculty_involved_id']));
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
            $query = $this->db->prepare("UPDATE {$this->table} SET submitted_by = ?, violation_type = ?, report_date = ?, status = ?, reviewed_by = ?, resolution_date = ?, comments = ?, dpa_verification_status = ?, faculty_involved_id = ? WHERE id = ?");
            $query->bind_param('iississbii', $data['submitted_by'], $data['violation_type'], $data['report_date'], $data['status'], $data['reviewed_by'], $data['resolution_date'], $data['comments'], $data['dpa_verification_status'], $data['faculty_involved_id'], $id);
            $query->execute();
        } else {
            sqlsrv_query($this->db, "UPDATE {$this->table} SET submitted_by = ?, violation_type = ?, report_date = ?, status = ?, reviewed_by = ?, resolution_date = ?, comments = ?, dpa_verification_status = ?, faculty_involved_id = ? WHERE id = ?", [
                $data['submitted_by'],
                $data['violation_type'],
                $data['report_date'],
                $data['status'],
                $data['reviewed_by'],
                $data['resolution_date'],
                $data['comments'],
                $data['dpa_verification_status'],
                $data['faculty_involved_id'],
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