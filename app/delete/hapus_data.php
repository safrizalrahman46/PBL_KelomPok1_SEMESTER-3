<?php

// echo "Name: " . $name . "<br>";
// echo "Department ID: " . $department_id . "<br>";
// echo "Email: " . $email . "<br>";
// echo "NIM: " . $NIM . "<br>";
// echo "Username: " . $username . "<br>";
// echo "Password: " . $password . "<br>";
// echo "Total Violation Points: " . $total_violation_points . "<br>";
// echo "Total Reward Points: " . $total_reward_points . "<br>";
// echo "Semester: " . $semester . "<br>";
// echo "Tingkat: " . $tingkat . "<br>";

include("../../conf/config.php");
$id = $_GET['id'];
// $name = $_GET['name'];
// $department_id = $_GET['department_id'];
// $email = $_GET['email'];
// $NIM = $_GET['NIM'];
// $username = $_GET['username'];
// $password = $_GET['password'];
// $total_violation_points = $_GET['total_violation_points'];
// $total_reward_points = $_GET['total_reward_points'];
// $semester = $_GET['semester'];
// $tingkat = $_GET['tingkat'];

$query = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id='$id'");
header('Location: ../index.php?page=data-mahasiswa');
// echo  $_GET['name'];
// echo  $_GET['department_id'];
// echo  $_GET['email'];
// echo  $_GET['NIM'];
// echo  $_GET['username'];
// echo  $_GET['password'];
// echo  $_GET['total_violation_points'];
// echo  $_GET['total_reward_points'];
// echo  $_GET['semester'];
// echo  $_GET['tingkat'];



?>
