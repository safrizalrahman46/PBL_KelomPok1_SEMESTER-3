<?php
include('Model.php');
class PelanggaranMahasiswaModel extends Model
{
    protected $db;
    protected $table = 'pelanggaran_mahasiswa';
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
            // prepare statement untuk query insert
            $query = $this->db->prepare("insert into {$this->table} (mahasiswa_id, violation_type_id, reported_by, dpa_verification_status, report_date, sanction_status, sanction_start_date, sanction_end_date, comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            // binding parameter ke query, "s" berarti string, "ss" berarti dua string
            $query->bind_param('iiisssssss', $data['mahasiswa_id'], $data['violation_type_id'], $data['reported_by'], $data['dpa_verification_status'], $data['report_date'], $data['sanction_status'], $data['sanction_start_date'], $data['sanction_end_date'], $data['comments']);
            // eksekusi query untuk menyimpan ke database
            $query->execute();
        } else {
            // eksekusi query untuk menyimpan ke database
            sqlsrv_query($this->db, "insert into {$this->table} (mahasiswa_id, violation_type_id, reported_by, dpa_verification_status, report_date, sanction_status, sanction_start_date, sanction_end_date, comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", array($data['mahasiswa_id'], $data['violation_type_id'], $data['reported_by'], $data['dpa_verification_status'], $data['report_date'], $data['sanction_status'], $data['sanction_start_date'], $data['sanction_end_date'], $data['comments']));
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
            $query = $this->db->prepare("select * from {$this->table} where id_pelanggaran = ?");
            // binding parameter ke query "i" berarti integer. Biar tidak kena SQL Injection
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
            // ambil hasil query
            return $query->get_result()->fetch_assoc();
        } else {
            // query untuk mengambil data berdasarkan id
            $query = sqlsrv_query($this->db, "select * from {$this->table} where id_pelanggaran = ?", [$id]);
            // ambil hasil query
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        }
    }
    public function updateData($id, $data)
    {
        if ($this->driver == 'mysql') {
            // query untuk update data
            $query = $this->db->prepare("update {$this->table} set mahasiswa_id = ?, violation_type_id = ?, reported_by = ?, dpa_verification_status = ?, report_date = ?, sanction_status = ?, sanction_start_date = ?, sanction_end_date = ?, comments = ?   where id_pelanggaran = ?");
            // binding parameter ke query
            $query->bind_param('iiissssssi', $data['mahasiswa_id'], $data['violation_type_id'], $data['reported_by'], $data['dpa_verification_status'], $data['report_date'], $data['sanction_status'], $data['sanction_start_date'], $data['sanction_end_date'], $data['comments'], $id);
            // eksekusi query
            $query->execute();
        } else {
            // query untuk update data
            sqlsrv_query($this->db, "update {$this->table} set mahasiswa_id = ?, violation_type_id = ?, reported_by = ?, dpa_verification_status = ?, report_date = ?, sanction_status = ?, sanction_start_date = ?, sanction_end_date = ?, comments = ?  where id_pelanggaran = ?", [
                $data['mahasiswa_id'],
                $data['violation_type_id'],
                $data['reported_by'],
                $data['dpa_verification_status'],
                $data['report_date'],
                $data['sanction _status'],
                $data['sanction_start_date'],
                $data['sanction_end_date'],
                $data['comments'],
                $id
            ]);
        }
    }
    public function deleteData($id)
    {
        if ($this->driver == 'mysql') {
            // query untuk delete data
            $query = $this->db->prepare("delete from {$this->table} where id_pelanggaran = ?");
            // binding parameter ke query
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
        } else {
            // query untuk delete data
            sqlsrv_query(
                $this->db,
                "delete from {$this->table} where id_pelanggaran = ?",
                [$id]
            );
        }
    }
}
