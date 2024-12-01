<?php

include("../../conf/config.php");

// Get form data
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

// Handle file upload
$foto = $_FILES['foto']['name'];  // Get the file name
$file_tmp = $_FILES['foto']['tmp_name'];  // Temporary file location

// Check if a file is uploaded
if($foto) {
    $target_dir = "../foto/";  // Directory to store the uploaded file
    $target_file = $target_dir . basename($foto);
    
    // Move the uploaded file to the target directory
    if(move_uploaded_file($file_tmp, $target_file)) {
        echo "Foto uploaded successfully!";
    } else {
        echo "Error uploading foto!";
    }
} else {
    // If no file is uploaded, use a default value or handle the case
    $foto = NULL;
}

// Query to insert data into database
$query = "INSERT INTO mahasiswa (id, name, department_id, email, NIM, username, password, total_violation_points, total_reward_points, semester, tingkat, foto)
          VALUES('$id', '$name', '$department_id', '$email', '$NIM', '$username', '$password', '$total_violation_points', '$total_reward_points', '$semester', '$tingkat', '$foto')";

// Execute the query
if (mysqli_query($koneksi, $query)) {
    echo "Data added successfully!";
    header('Location: ../index.php?page=data-mahasiswa');  // Redirect to data-mahasiswa page
} else {
    echo "Error adding record: " . mysqli_error($koneksi);
}

// Close the database connection
mysqli_close($koneksi);

?>
