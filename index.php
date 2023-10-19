<?php
require 'includes/database.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My College</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <style>
            .add{
                color: white;
                text-decoration: none;
            }
            .add:hover{
                color:white;
            }

            header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 1rem;
}
        </style>
</head>

<body>
    <?php

session_start();


if (!isset($_SESSION['username'])) {
    // If the user is not authenticated, redirect to the login page
    header("Location: login.php");
}


    if (isset($_POST['submit'])) {

        $firstName = $_POST['first_name'];
        $middleName = $_POST['middle_name'];
        $lastName = $_POST['last_name'];
        $dob = $_POST['dob'];
        $course = $_POST['course'];
        $fromYear = $_POST['from_year'];
        $toYear = $_POST['to_year'];
        $mode = $_POST['mode'];
        $conve = $_POST['conve'];
        $gender = $_POST['gender'];

        if ($_FILES['photo']['error'] === 4) {
            echo "<srcipt> alert('image does not exist'); </script>";
        } else {
            $checkuid = "SELECT * FROM students ORDER BY id Desc LIMIT 1";

            $checkresult = mysqli_query($conn, $checkuid);
            if( mysqli_num_rows($checkresult)>0){
                if($row = mysqli_fetch_assoc($checkresult)){
                    $uid = $row['student_id'];
                    $get_number = str_replace("MCL", "", $uid);
                    $id_increase = $get_number +1;
                    $get_string = str_pad($id_increase, 5, 0, STR_PAD_LEFT);
                    $student_id = "MCL".$get_string; 
                    
                }
            }else {
                $student_id = "MCL00001";
            
            }
            $fileName = $_FILES['photo']['name'];
            $fileSize = $_FILES['photo']['size'];
            $file_temp_name = $_FILES['photo']['tmp_name'];

            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));

            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($file_temp_name, 'photos/' . $newImageName);
            $sql = "INSERT into students (student_id, first_name, middle_name, last_name, dob, course, from_year, to_year, mode, conve, photo, gender) value('$student_id', '$firstName', '$middleName', '$lastName', '$dob', '$course', '$fromYear','$toYear', '$mode', '$conve', '$newImageName', '$gender')";

            if (mysqli_query($conn, $sql)) {
                echo "add success";
            } else {
                echo "no added";
            }
        }
    }


    ?>

    <div class="container ">
    
        <header class="mb-4">
        <div class="my-4">
            <h1 class="text-center">My College</h1>
        </div>
</header>
        <div>
        <a href="logout.php" class="btn btn-danger col-4">Log Out</a>
        <a class="add" href="add_details.php"><button class="btn btn-primary col-4">Add New Student</button></a>
        </div>
        
    <div class="container my-5 resposive" style="overflow-x: auto">
        <table class="table table-bordered resposive">
            <thead class=" text-center">
                <tr>
                    <th>Sr No.</th>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>D.O.B</th>
                    <th>Course</th>
                    <th colspan="2">Batch</th>
                    <th>Mode</th>
                    <th>Convence</th>
                    <th>Photo</th>
                    <!-- <th></th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                $sr = 1;
                
                $data = "SELECT * from students";
                $result = mysqli_query($conn, $data);
                while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                    <tr>
                        <td>
                            <?php echo $sr++; ?>
                        </td>
                        <td><a class="text-decoration-none" href="student.php?id=<?= $row['id'] ?>">
                                <?php echo $row['student_id'] ?>
                            </a></td>
                        <td>
                            <?php echo $row['first_name'] ?>
                        </td>
                        <td>
                            <?php echo $row['middle_name'] ?>
                        </td>
                        <td>
                            <?php echo $row['last_name'] ?>
                        </td>
                        <td>
                            <?php echo $row['gender'] ?>
                        </td>
                        <td>
                            <?php echo $row['dob'] ?>
                        </td>
                        <td>
                            <?php echo $row['course'] ?>
                        </td>
                        <td>
                            <?php echo $row['from_year'] ?>
                        </td>
                        <td>
                            <?php echo $row['to_year'] ?>
                        </td>
                        <td>
                            <?php echo $row['mode'] ?>
                        </td>
                        <td>
                            <?php echo $row['conve'] ?>
                        </td>
                        <td>
                            <?php echo $row['photo'] ?>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>

        </table>
    </div>
</body>

</html>