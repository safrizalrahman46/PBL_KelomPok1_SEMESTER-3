<?php
include_once('Model.php');
include_once('Database.php');

class GlobalModel extends Model
{
    protected $db;
    protected $table = '';
    protected $driver;
    public function __construct()
    {
        // Get the database instance
        $database = Database::getInstance();
        $this->db = $database->getConnection(); // Set the connection resource
        $this->driver = $database->getDriver(); // Set the driver being used
    }


    public function insertData($id){

    }
    public function getData(){

    }
    public function getDataById($id){

    }
    public function updateData($id, $data){

    }
    public function deleteData($id){

    }

    public function getCountData($table){
        $stmtTotal = sqlsrv_query($this->db, "SELECT count(*) as count from {$table}");
        $totalRecords = 0;
        if ($stmtTotal) {
            $rowTotal = sqlsrv_fetch_array($stmtTotal, SQLSRV_FETCH_ASSOC);
            $totalRecords = $rowTotal ? $rowTotal['count'] : 0;
        }
        return $totalRecords;
    }
   
}
