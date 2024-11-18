<?php

include("../../conf/config.php");

$id = $_GET['id'];
$name = $_GET['name'];
$department_id = $_GET['department_id'];
$email = $_GET['email'];
$NIM = $_GET['NIM'];
$username = $_GET['username'];
$password = $_GET['password'];
$total_violation_points = $_GET['total_violation_points'];
$total_reward_points = $_GET['total_reward_points'];
$semester = $_GET['semester'];
$tingkat = $_GET['tingkat'];

// Debugging output to check the received values
// echo "ID: " . $id . "<br>";
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

// Query update
$query = "UPDATE mahasiswa SET name = '$name', department_id = '$department_id', email = '$email', NIM = '$NIM', username = '$username', password = '$password', total_violation_points = '$total_violation_points', total_reward_points = '$total_reward_points', semester = '$semester', tingkat = '$tingkat' WHERE id = '$id'";

// Execute the query and check for errors
if (mysqli_query($koneksi, $query)) {
    echo "Data updated successfully!";
    // Redirect to data-mahasiswa page
    header('Location: ../index.php?page=data-mahasiswa');
} else {
    echo "Error updating record: " . mysqli_error($koneksi);
}

// Close the database connection
mysqli_close($koneksi);

?>
