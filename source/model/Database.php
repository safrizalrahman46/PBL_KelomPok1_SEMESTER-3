<?php
class Database
{
    private static $instance = null;
    private $db;
    private $driver;

    private function __construct()
    {
        include_once(__DIR__ . '/../lib/NewConnection.php');
        $this->db = $db;
        $this->driver = $use_driver; // Assume this is coming from the connection file
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getDriver()
    {
        return $this->driver;
    }

  
    public function getConnection()
    {
        if (!$this->db || gettype($this->db) !== 'resource') {
            throw new Exception("Database connection is not initialized or is invalid.");
        }
        return $this->db;
    }
}