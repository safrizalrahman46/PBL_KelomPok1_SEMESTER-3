<?php
$use_driver = 'sqlsrv'; // mysql atau sqlsrv
$host = 'MSI'; // 'localhost';
$username = ''; //'sa';
$password = '';
$database = 'tatib'; // 'master'
$db;

if ($use_driver == 'mysql') {
    try {
        $db = new mysqli('localhost', $username, $password, $database);
        if ($db->connect_error) {
            die('Connection DB failed: ' . $db->connect_error);
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }
} else if ($use_driver == 'sqlsrv') {
    $credential = [
        'Database' => $database,
        'UID' => $username,
        'PWD' => $password
    ];
    try {
        // echo"<br>mencoba koneksi<br>";
        $db = sqlsrv_connect($host, $credential);
        if (!$db) {
            echo"<br>Koneksi DB Tidak ada/server mati<br>";
            
            $msg = sqlsrv_errors();
            die($msg[0]['message']);
        } else {
            echo"<br>Koneksi Berhasil<br>";
        }

    } catch (Exception $e) {
        die($e->getMessage());
    }
}
