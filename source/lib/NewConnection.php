<?php

// Set your database connection details here
$host = 'MSI';  // Example: 'localhost' or IP address
$dbname = 'tatib';  // Database name
$username = '';     // Database username
$password = '';     // Database password
$charset = 'utf8';               // Character set

// Set the driver type for PDO connection
$use_driver = 'sqlsrv'; // For SQL Server

$credential = [
    'Database' => $dbname,
    'UID' => $username,
    'PWD' => $password
];
try {

      $sql = "
    CREATE TRIGGER trgAfterUpdate 
    ON dbo.tb_lapor 
    AFTER UPDATE 
    AS 
    BEGIN 
        INSERT INTO dbo.AuditLog (Action, ID_Pelanggaran, Komentar, Tanggal_Laporan, Tempat, LogDate) 
        SELECT 'UPDATE', ID_Pelanggaran, Komentar, Tanggal_Laporan, Tempat, GETDATE() 
        FROM inserted; 
    END";
    // echo"<br>mencoba koneksi<br>";
    $db = sqlsrv_connect($host, $credential);
    if (!$db) {
        // echo"<br>Koneksi DB Tidak ada/server mati<br>";
        $msg = sqlsrv_errors();
        die($msg[0]['message']);
    } else {
        // echo"<br>Koneksi Berhasil<br>";
    }
} catch (Exception $e) {
    die($e->getMessage());
}
