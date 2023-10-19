<?php
require ('includes/database.php');

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
<style>
    .card{
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
    <div class="container my-5 resposive" style="overflow-x: auto">
    <div>
            <button class="btn btn-primary offset-10 col-2 mb-4"><a class="add" href="index.php">HOME</a></button>
        </div>
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