<?php
require 'includes/database.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php
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
                echo "<script> alert('Success');</script>";
                header("Location: index.php"); // Redirect to the home page
            } else {
                echo "<script> alert('no add');</script>";
                header("Location: add_details.php");
            }
        }
    }


    ?>

    <div class="container ">
        <div class="my-4">
            <h1 class="text-center">My College</h1>
        </div>
        <div>
        <a href="javascript:history.go(-1)"><button class="btn btn-success col-3 mb-4">Go Back</button></a>

        </div>
        <!-- <a href="students_details.php">all details</a> -->
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="first_name">First Name:</label>
                    <input class="form-control" type="text" name="first_name">
                </div>
                <div class="col-md-4 form-group">
                    <label for="middle_name">Middle Name:</label>
                    <input class="form-control" type="text" name="middle_name">
                </div>
                <div class="col-md-4 form-group">
                    <label for="last_name">Last Name:</label>
                    <input class="form-control" type="text" name="last_name">
                </div>
                <div class="col-md-4 form-group">
                    <label for="dob">D.O.B:</label>
                    <input class="form-control" type="date" name="dob">
                </div>
                <div class="col-md-4 form-group">
                    <label for="course">Course:</label>
                    <select name="course" id="" class="form-control">
                        <option value="">-- --</option>
                        <option value="B.C.A">B.C.A</option>
                        <option value="B.B.A">B.B.A</option>
                        <option value="B-TECH">B-TECH</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="batch">Batch:</label>
                    <input class="form-control col-1" type="month" name="from_year">
                    <input class="form-control col-1" type="month" name="to_year">
                </div>
                <div class="col-md-4 form-group">
                    <label for="mode">Mode:</label>
                    <select name="mode" id="" class="form-control">
                        <option value="">-- --</option>
                        <option value="Regular">Regular</option>
                        <option value="Private">Private</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="conve">Convence:</label>
                    <select name="conve" id="" class="form-control">
                        <option value="">-- --</option>
                        <option value="Hostel">Hostel</option>
                        <option value="Outsider">Outsider</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="photo">Photo:</label>
                    <input class="form-control" type="file" accept=".jpg, .jpeg, .png" name="photo">
                </div>
                <div class="col-md-4 form-group">
                    <label for="gender">Gender:</label>
                    <input class="" type="radio" value="male" name="gender">Male</input>
                    <input class="" type="radio" value="female" name="gender">Female</input>
                </div>
            </div>
            <div class="row form-group my-3">
                <div class="col-md-12">
                    <button type="submit" name="submit" class="btn btn-block btn-primary form-control">Submit</button>
                </div>
            </div>

        </form>
    </div>
    
</body>

</html>