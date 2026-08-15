<?php
$servername = "localhost";
$username = "root";
$userpassword = "";
$databasename = "Employee";

$connection = mysqli_connect($servername, $username, $userpassword);

$dataquery = "CREATE DATABASE IF NOT EXISTS Employee";
mysqli_query($connection, $dataquery);

mysqli_select_db($connection, $databasename);

$tablequery = "CREATE TABLE IF NOT EXISTS employeesystem(
    emp_id INT PRIMARY KEY AUTO_INCREMENT,
    emp_name VARCHAR(50) NOT NULL,
    emp_email VARCHAR(50) UNIQUE,
    emp_position VARCHAR(50) NOT NULL,
    emp_image VARCHAR(100) NOT NULL
)";
mysqli_query($connection, $tablequery);

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Form Section -->
        <div class="form-container">
            <h1><?php echo isset($_GET['edit']) ? 'Edit Employee' : 'Add Employee'; ?></h1>

            <?php 
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $name = $_POST['emp_name'];
                $email = $_POST['emp_email'];
                $position = $_POST['emp_position'];

                $image = $_FILES['emp_image']['name'];
                $tmp_image = $_FILES['emp_image']['tmp_name'];
                $address = 'images/';
                
                if (!is_dir('images')) {
                    mkdir('images', 0777, true);
                }

                $Uniquename = time() . "_" . basename($image);
                if(!empty($image)){
                    move_uploaded_file($tmp_image, $address . $Uniquename);
                }

                if($name != "" && $email != "" && $position != ""){
                    if(isset($_GET['edit'])){
                        $id = $_GET['edit'];
                        if(empty($image)){
                            $selectOld = "SELECT emp_image FROM employeesystem WHERE emp_id = $id";
                            $oldRes = mysqli_query($connection, $selectOld);
                            $oldRow = mysqli_fetch_assoc($oldRes);
                            $Uniquename = $oldRow['emp_image'];
                        }
                        
                        $updatewithid = "UPDATE employeesystem SET emp_name = '$name', emp_email = '$email', emp_position = '$position', emp_image = '$Uniquename' WHERE emp_id = '$id'";
                        $result = mysqli_query($connection, $updatewithid);
                    } else {
                        $insert = "INSERT INTO employeesystem(emp_name, emp_email, emp_position, emp_image) VALUES('$name', '$email', '$position', '$Uniquename')";
                        $result = mysqli_query($connection, $insert);
                    }

                    if($result){
                        echo "<div class='alert alert-success'>Data saved successfully!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Data not inserted!</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Please fill all fields!</div>";
                }
            }

            /* Edit logic */
            $row = [];
            if(isset($_GET['edit'])){
                $id = $_GET['edit'];
                $selectwithid = "SELECT * FROM employeesystem WHERE emp_id = $id";
                $result = mysqli_query($connection, $selectwithid);
                $row = mysqli_fetch_assoc($result);
            }
            
            /* delete logic */
            if(isset($_GET['delete'])){
                $id = $_GET['delete'];
                $deletewithid = "DELETE FROM employeesystem WHERE emp_id = $id";
                mysqli_query($connection, $deletewithid);
                echo "<script>window.location.href='form.php';</script>";
            }
            ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="name">Name:</label>
                    <input type="text" name="emp_name" value="<?php echo $row["emp_name"] ?? "";?>" required>
                </div>

                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" name="emp_email" value="<?php echo $row["emp_email"] ?? "";?>" required>
                </div>

                <div class="input-group">
                    <label for="position">Position:</label>
                    <input type="text" name="emp_position" value="<?php echo $row["emp_position"] ?? "";?>" required>
                </div>

                <div class="input-group">
                    <label for="photo">Profile Photo:</label>
                    <input type="file" name="emp_image" accept="image/jpeg, image/png" <?php echo isset($_GET['edit']) ? '' : 'required'; ?>>
                </div>

                <?php
                if(isset($_GET['edit'])){
                    echo "<button type='submit' class='btn btn-primary'>Update</button>";
                    echo "<a href='form.php' class='btn btn-secondary' style='text-decoration:none; display:block; text-align:center; margin-top:10px;'>Cancel</a>";
                } else {
                    echo "<button type='submit' class='btn btn-primary'>Submit</button>";
                }
                ?>
            </form>
        </div>

        <!-- Table Section -->
        <div class="table-container">
            <h2>Employee List</h2>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $select = "SELECT * FROM employeesystem";
                $query = mysqli_query($connection, $select);
                while($emp = mysqli_fetch_assoc($query)){
                    echo "<tr>
                        <td>".$emp['emp_id']."</td>
                        <td><img src='images/".$emp['emp_image']."' width='45' height='45' style='width: 45px; height: 45px; object-fit: cover; border-radius: 50%; border: 2px solid #38bdf8;'></td>
                        <td>".$emp['emp_name']."</td>
                        <td>".$emp['emp_email']."</td>
                        <td>".$emp['emp_position']."</td>
                        <td class='action-btns'>
                            <a href='?edit=".$emp["emp_id"]."' class='btn-edit'>Edit</a>
                            <a href='?delete=".$emp["emp_id"]."' class='btn-delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>