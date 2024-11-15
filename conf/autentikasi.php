<?php
session_abort();
include ('config.php');
$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");

if (mysqli_num_rows($query) == 1) {
    // Redirect to login page with success parameter
    header('Location:../index.php?success=1');
    $_SESSION['nama'] = 'admin';
    $_SESSION['levle'] = 'superadmin';

} else if ($username == '' || $password == '') {
    header('Location: ../index.php?error=2');
} else {
    header('Location:../index.php?error=1');
}
?>

<!-- tatib 3 -->