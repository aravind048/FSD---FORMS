<?php
// Database connection
$host = 'localhost';
$db = 'user_db';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt password
    $username = $_POST['username'];

    // Insert data into the users table
    $stmt = $conn->prepare("INSERT INTO users (email, password, username) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $password, $username);

    if ($stmt->execute()) {
        // Redirect to login page after successful signup
        header("Location: 2login.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
