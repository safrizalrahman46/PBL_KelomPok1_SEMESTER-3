
<?php
// Database connection
$serverName = "your_server_name";
$connectionOptions = array(
    "Database" => "your_database_name",
    "Uid" => "your_username",
    "PWD" => "your_password"
);
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Fetch all users
$sql = "SELECT user_id, username, password FROM users";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $userId = $row['user_id'];
    $password = $row['password'];

    // Check if the password is already hashed
    if (password_get_info($password)['algo'] === 0) { // Password is not hashed
        // Generate a new hashed password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Update the password in the database
        $updateSql = "UPDATE users SET password = ? WHERE user_id = ?";
        $params = array($hashedPassword, $userId);

        $updateStmt = sqlsrv_query($conn, $updateSql, $params);

        if ($updateStmt === false) {
            echo "Failed to update password for user_id: $userId<br>";
            print_r(sqlsrv_errors());
        } else {
            echo "Password updated for user_id: $userId<br>";
        }
    } else {
        echo "Password already hashed for user_id: $userId<br>";
    }
}

// Close the connection
sqlsrv_close($conn);
?>








<!-- Iki script kanggo update data password ke hash -->