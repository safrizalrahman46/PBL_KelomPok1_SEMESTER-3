<?php
include('Model.php');
class BukuModel extends Model
{
    protected $db;
    protected $table = 'm_buku';
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
            $query = $this->db->prepare("insert into {$this->table} (kategori_id, buku_kode, buku_nama, jumlah, deskripsi, gambar) values(?, ?, ?, ?, ?, ?)");
            // binding parameter ke query, "s" berarti string, "ss" berarti dua string
            $query->bind_param('ss',   
             $data['kategori_id'],
            $data['buku_kode'],
            $data['buku_nama'],
            $data['jumlah'],
            $data['deskripsi'],
            $data['gambar']);
            // eksekusi query untuk menyimpan ke database
            $query->execute();
        } else {
            // eksekusi query untuk menyimpan ke database
            sqlsrv_query($this->db, "insert into {$this->table} (kategori_id, buku_kode, buku_nama, jumlah, deskripsi, gambar) values(?, ?, ?, ?, ?, ?)", array(
                $data['kategori_id'],
                $data['buku_kode'],
                $data['buku_nama'],
                $data['jumlah'],
                $data['deskripsi'],
                $data['gambar']
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
            $query = $this->db->prepare("select * from {$this->table} where buku_id = ?");
            // binding parameter ke query "i" berarti integer. Biar tidak kena SQL Injection
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
            // ambil hasil query
            return $query->get_result()->fetch_assoc();
        } else {
            // query untuk mengambil data berdasarkan id
            $query = sqlsrv_query($this->db, "select * from {$this->table} where buku_id = ?", [$id]);
            // ambil hasil query
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        }
    }
    public function updateData($id, $data)
    {
        if ($this->driver == 'mysql') {
            // query untuk update data
            $query = $this->db->prepare("update {$this->table} set   kategori_id = ?, 
                buku_kode = ?, 
                buku_nama = ?, 
                jumlah = ?, 
                deskripsi = ?, 
                gambar = ? 
                 WHERE buku_id = ?");
            // binding parameter ke query
            $query->bind_param( 'ississi',
            $data['kategori_id'],
            $data['buku_kode'],
            $data['buku_nama'],
            $data['jumlah'],
            $data['deskripsi'],
            $data['gambar'], $id);
            // eksekusi query
            $query->execute();
        } else {
            // query untuk update data
            sqlsrv_query($this->db, "update {$this->table} set     kategori_id = ?, 
                buku_kode = ?, 
                buku_nama = ?, 
                jumlah = ?, 
                deskripsi = ?, 
                gambar = ? 
                 WHERE buku_id = ?", [
                    $data['kategori_id'],
                    $data['buku_kode'],
                    $data['buku_nama'],
                    $data['jumlah'],
                    $data['deskripsi'],
                    $data['gambar'],
                $id
            ]);
        }
    }
    public function deleteData($id)
    {
        if ($this->driver == 'mysql') {
            // query untuk delete data
            $query = $this->db->prepare("delete from {$this->table} where buku_id = ?");
            // binding parameter ke query
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
        } else {
            // query untuk delete data
            sqlsrv_query(
                $this->db,
                "delete from {$this->table} where buku_id = ?",
                [$id]
            );
        }
    }
}
