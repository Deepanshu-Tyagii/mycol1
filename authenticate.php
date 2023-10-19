<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace these values with your database credentials
    require 'includes/database.php';

    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query the database to check if the user exists
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // User is authenticated, store a session variable
        $_SESSION['username'] = $username;
        // $_SESSION['password'] = $password;
        header("Location: index.php"); // Redirect to the home page
    } else {
        // Authentication failed, redirect back to the login page
        header("Location: login.php");
    }

    $conn->close();
}
?>
