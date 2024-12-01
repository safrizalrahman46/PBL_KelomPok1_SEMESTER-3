<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "tatib3";

// $koneksi = new mysqli($servername, $username, $password, $dbname);
$koneksi = mysqli_connect('localhost', 'root', '', 'tatib3');

// Fetch departments from the database
$departments = [];
$sql = "SELECT id, name FROM department";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $departments[] = $row;
    }
}

// if ($koneksi->connect_error) {
//     die("Connection failed: " . $koneksi->connect_error);
// }
// else{
//     echo "Koneksi Sukses";
// }

// $sql = "SELECT * FROM users


?>
