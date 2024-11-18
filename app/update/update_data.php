<?php

include("../../conf/config.php");

$id = $_POST['id'];
$name = $_POST['name'];
$department_id = $_POST['department_id'];
$email = $_POST['email'];
$NIM = $_POST['NIM'];
$username = $_POST['username'];
$password = $_POST['password'];
$total_violation_points = $_POST['total_violation_points'];
$total_reward_points = $_POST['total_reward_points'];
$semester = $_POST['semester'];
$tingkat = $_POST['tingkat'];
// $foto = $_POST['foto'];

//nama foto
$nama_file = $_FILES['foto']['name'];
// echo $nama_file;

// Lokasi Foto
$file_tmp = $_FILES['foto']['tmp_name'];
move_uploaded_file($file_tmp, '../foto/' . $nama_file);



// Query update
$query = "UPDATE mahasiswa SET name = '$name', department_id = '$department_id', email = '$email', NIM = '$NIM', username = '$username', password = '$password', total_violation_points = '$total_violation_points', total_reward_points = '$total_reward_points', semester = '$semester', tingkat = '$tingkat', foto='$nama_file' WHERE id = '$id'";

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
// echo "foto: " . $foto . "<br>";
?>
