<?php
require 'includes/database.php';

?>

<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
</head>
<style>
    .table{
        display: none;
    }
    .add{
                color: white;
                text-decoration: none;
            }
            .add:hover{
                color:white;
            }
</style>

<body>
<div class="container">
        <div class="card">
            <div class="row mx-2 my-2 py-2 d-flex justify-content-end gap-2">
                
            <a class="add btn btn-success col-3" href='index.php'><button  class="btn btn-success col-3">Home</button></a>
            <a class="add btn btn-danger col-3" href='delete.php?id=<?php echo $_GET['id']; ?>'><button  class="btn btn-danger col-3">
                    Delete</button></a>
        
                <button onclick="show()" class="btn btn-primary col-3">Edit</button>
            </div>
            <table class="table1 w-100">
                <?php

                $student_id = $_GET['id'];
                $data = "SELECT * from students WHERE id =$student_id";
                $result = mysqli_query($conn, $data);
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                    <tr>
                        <td><strong>Name : </strong>
                            <?php echo $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'] ?>
                        </td>
                        <td><strong>Gender : </strong>
                            <?php echo $row['gender'] ?>
                        </td>
                        <td class="text-center box" colspan="2" rowspan="3"><img src="photos/<?php echo $row['photo'] ?>"
                                width="100"></td>
                    </tr>
                    <tr>
                        <td><strong>D.O.B : </strong>
                            <?php echo $row['dob'] ?>
                        </td>
                        <td><strong>Course : </strong>
                            <?php echo $row['course'] ?>
                        </td>

                    </tr>
                    <tr>
                        <td><strong>Batch : </strong>
                            <?php echo $row['from_year'] . "-" . $row['to_year'] ?>
                        </td>
                        <td><strong>Mode : </strong>
                            <?php echo $row['mode'] ?>
                        </td>

                    </tr>
                    <tr>
                        <td><strong>Conve : </strong>
                            <?php echo $row['conve'] ?>
                        </td>
                    </tr>


                <?php } ?>

            </table>
        </div>
    </div>


    <?php
    $studentId = $_GET['id'];

    $sql = "SELECT * FROM students WHERE id = $studentId";
    $result = mysqli_query($conn, $sql);
    $student = mysqli_fetch_assoc($result);
    
    if ($_SERVER['REQUEST_METHOD']== 'POST') {

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
            
            $uid = $student['student_id']; 
            $fileName = $_FILES['photo']['name'];
            $fileSize = $_FILES['photo']['size'];
            $file_temp_name = $_FILES['photo']['tmp_name'];

            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));

            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($file_temp_name, 'photos/' . $newImageName);
            $sql = "UPDATE students SET student_id = '$uid', first_name = '$firstName', middle_name = '$middleName', last_name  = '$lastName', dob = '$dob', course = '$course', from_year = '$fromYear', to_year = '$toYear', mode = '$mode', conve = '$conve', photo = '$newImageName', gender = '$gender' WHERE id= $studentId";


            if (mysqli_query($conn, $sql)) {
                echo "<script> alert('Update Success');</script>";
            } else {
                echo "<script> alert('error');</script>";
            }
        }
        header("Location: student.php?id= $studentId");
    }
    ?>

    <div class="container table" id="table">
        <div class="my-4">
            <h1 class="text-center">Detail</h1>
        </div>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="first_name">First Name:</label>
                    <input class="form-control" type="text" name="first_name" value="<?php echo $student['first_name']; ?>">
                </div>
                <div class="col-md-4 form-group">
                    <label for="middle_name">Middle Name:</label>
                    <input class="form-control" type="text" name="middle_name" value="<?php echo $student['middle_name']; ?>">
                </div>
                <div class="col-md-4 form-group">
                    <label for="last_name">Last Name:</label>
                    <input class="form-control" type="text" name="last_name" value="<?php echo $student['last_name']; ?>">
                </div>
                <div class="col-md-4 form-group">
                    <label for="dob">D.O.B:</label>
                    <input class="form-control" type="date" name="dob" value="<?php echo $student['dob']; ?>">
                </div>
                <div class="col-md-4 form-group">
                    <label for="course">Course:</label>
                    <select name="course" id="" class="form-control" >
                        <option value="<?php echo $student['course']; ?>"><?php echo $student['course']; ?></option>
                        <option value="B.C.A">B.C.A</option>
                        <option value="B.B.A">B.B.A</option>
                        <option value="B-TECH">B-TECH</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="batch">Batch:</label>
                    <input class="form-control col-1" type="month" name="from_year" value="<?php echo $student['from_year']; ?>">
                    <input class="form-control col-1" type="month" name="to_year" value="<?php echo $student['to_year']; ?>">
                </div>
                <div class="col-md-4 form-group">
                    <label for="mode">Mode:</label>
                    <select name="mode" id="" class="form-control">
                        <option value="<?php echo $student['mode']; ?>"><?php echo $student['mode']; ?></option>
                        <option value="Regular">Regular</option>
                        <option value="Private">Private</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="conve">Convence:</label>
                    <select name="conve" id="" class="form-control">
                        <option value="<?php echo $student['conve']; ?>"><?php echo $student['conve']; ?></option>
                        <option value="Hostel">Hostel</option>
                        <option value="Outsider">Outsider</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <label for="photo">Photo:</label>
                    <input class="form-control" type="file" accept=".jpg, .jpeg, .png" name="photo" value="photos/<?php echo $student['photo']; ?>">
                </div>
                <div class="col-md-4 form-group">
                    <label for="gender">Gender:</label>
                    <input class="" type="radio" value="male" name="gender" <?php if ($student['gender'] == 'male') echo 'checked'; ?>>Male</input>
                    <input class="" type="radio" value="female" name="gender" <?php if ($student['gender'] == 'female') echo 'checked'; ?>>Female</input>
                </div>
            </div>
            <div class="row form-group my-3">
                <div class="col-md-5">
                    <button onclick="hide()" type="submit" class="btn btn-block btn-danger form-control">Cancel</button>
                </div>
                <div class="col-md-5">
                    <button type="submit" class="btn btn-block btn-primary form-control">Update</button>
                </div>
            </div>

        </form>
    </div>



    <!-- scripts -->
    <script>
        function show(){
            const table = document.getElementById("table");
            table.style.display = "block";
        }
        function hide(){
            const table = document.getElementById("table");
            table.style.display = "none";
        }
    </script>
</body>