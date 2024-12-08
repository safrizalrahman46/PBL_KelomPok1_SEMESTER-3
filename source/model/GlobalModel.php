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


    public function insertData($id) {}
    public function getData() {}
    public function getDataById($id) {}
    public function updateData($id, $data) {}
    public function deleteData($id) {}

    public function getCountData($table)
    {
        $stmtTotal = sqlsrv_query($this->db, "SELECT count(*) as count from {$table}");
        $totalRecords = 0;
        if ($stmtTotal) {
            $rowTotal = sqlsrv_fetch_array($stmtTotal, SQLSRV_FETCH_ASSOC);
            $totalRecords = $rowTotal ? $rowTotal['count'] : 0;
        }
        return $totalRecords;
    }


    public function getCountDynamicData($table, $conditions = [])
    {
        // Validate the table name (only alphanumeric and underscores allowed)
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            throw new InvalidArgumentException("Invalid table name.");
        }

        // Start building the query
        $query = "SELECT COUNT(*) as count FROM {$table}";

        // Add conditions if provided
        $params = [];
        if (!empty($conditions)) {
            $query .= " WHERE ";
            $clauses = [];
            foreach ($conditions as $column => $value) {
                $clauses[] = "{$column} = ?";
                $params[] = $value; // Add the value to the parameters array
            }
            $query .= implode(' AND ', $clauses); // Combine all conditions with AND
        }

        // Execute the query
        $stmtTotal = sqlsrv_query($this->db, $query, $params);
        if ($stmtTotal === false) {
            throw new Exception("Query failed: " . print_r(sqlsrv_errors(), true));
        }

        // Fetch and return the count
        $totalRecords = 0;
        $rowTotal = sqlsrv_fetch_array($stmtTotal, SQLSRV_FETCH_ASSOC);
        $totalRecords = $rowTotal ? $rowTotal['count'] : 0;

        return $totalRecords;
    }

    public function getSingleData($table, $conditions = [])
    {
        // Validate the table name (only alphanumeric and underscores allowed)
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $table)) {
            throw new InvalidArgumentException("Invalid table name.");
        }

        // Start building the query
        $query = "SELECT * FROM {$table}";

        // Add conditions if provided
        $params = [];
        if (!empty($conditions)) {
            $query .= " WHERE ";
            $clauses = [];
            foreach ($conditions as $column => $value) {
                $clauses[] = "{$column} = ?";
                $params[] = $value; // Add the value to the parameters array
            }
            $query .= implode(' AND ', $clauses); // Combine all conditions with AND
        }

        // Limit the result to one record
        // $query .= " FETCH NEXT 1 ROWS ONLY";

        // Execute the query
        $stmt = sqlsrv_query($this->db, $query, $params);
        if ($stmt === false) {
            throw new Exception("Query failed: " . print_r(sqlsrv_errors(), true));
        }

        // Fetch and return the single record as an associative array
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        return $row ?: []; // Return the record or an empty array if none found
    }

}
