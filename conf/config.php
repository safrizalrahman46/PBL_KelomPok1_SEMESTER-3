<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tatib3";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    echo "Koneksi Sukses";
}

// $sql = "SELECT * FROM users"; 
?>
