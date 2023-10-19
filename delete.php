<?php
// Include the database connection script
require 'includes/database.php';

// Check if the student ID is provided in the URL
if (isset($_GET['id'])) {
    $studentId = $_GET['id'];

    // Prepare and execute the SQL DELETE query
    $sql = "DELETE FROM students WHERE id = $studentId";
    if (mysqli_query($conn, $sql)) {
        // Deletion successful
        echo "<script> alert('Student record has been deleted.'); </script>";
    } else {
        // Deletion failed
        echo "<script> alert('Error deleting student record: " . mysqli_error($conn) . "'); </script>";
    }

    // Close the database connection
    mysqli_close($conn);

    header("Location: index.php"); 
}
?>
