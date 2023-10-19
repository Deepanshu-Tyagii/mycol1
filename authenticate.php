<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'includes/database.php';

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // User is authenticated, store a session variable
        $_SESSION['username'] = $username;
        header("Location: index.php"); // Redirect to the home page
    } else {
       
    echo '<script type="text/javascript">alert("Username and password incorrect");</script>';


        header("Location: login.php");
    }

    $conn->close();
}
?>


