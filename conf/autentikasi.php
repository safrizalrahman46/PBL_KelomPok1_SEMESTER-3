<?php

include ('config.php');
$username =$_POST['username' ];
$password =$_POST['password' ];

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");

if (mysqli_num_rows($query) == 1) {
    echo "Login Berhasil";
    // echo $username;
    // echo $password;
} else {
    echo "Login Tidak berhasil";
}
?>