<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTTNU61INGd0WsLzcBe7X3Jzs7eOAvO5kDTA&s">
    <title>Register</title>
</head>
<style>
    *{
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }
        body{
            background-image: url('https://img.freepik.com/premium-photo/top-view-hand-cream-jar-essential-oil-skin-lotion-eucalyptus-leaves-natural-organic-beauty-product-concept_199953-2018.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            height: 86vh;
        }
        form{
            width: 500px;
            padding: 30px;
            border-radius: 10px;
            margin: 100px auto;
            background-color:rgb(185, 212, 170);
            box-shadow: rgba(0,0,0,0.2)0px 5px 15px;
        }
        button{
            padding: 7px 20px;
            border: none;
            border-radius: 5px;
            background-color: rgb(225, 238, 188);
            box-shadow: rgba(0,0,0,0.2)0px 5px 15px;
            color: #000;
        }
        button:hover{
            background-color: rgb(144, 198, 124);
        }
</style>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <h2 class="text-center">Register</h2>
        <div class="form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="sex" class="form-label">Sex</label>
            <select name="sex" id="sex" class="form-select">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="profile" class="form-label">Profile</label>
            <input type="file" name="profile" id="profile" class="form-control">
        </div>
        <div class="form-group d-flex justify-content-center mt-2">
            <a href="login.php">Already have account?</a>
        </div>
        <div class="form-group d-flex justify-content-center mt-3">
            <button type="submit" class="w-100">Register</button>
        </div>
    </form>
</body>
</html>
<?php
include 'movefile.php';
include 'connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    global $con;

    $name = $_POST['username'];
    $email = $_POST['email'];
    $sex = $_POST['sex'];
    $password = $_POST['password'];

    if (empty($_FILES['profile']['name'])) {
        $insert = "INSERT INTO `users`(`username`, `sex`, `email`, `password`) 
                   VALUES ('$name','$sex','$email','$password')";
    } else {
        $profile = moveFile('profile'); // Make sure moveFile() returns a valid path
        $insert = "INSERT INTO `users`(`username`, `sex`, `email`, `password`, `profile`) 
                   VALUES ('$name','$sex','$email','$password','$profile')";
    }

    // Run the query and check for errors
    if ($con->query($insert)) {
        header('location: login.php');
    } else {
        echo "Error: " . $con->error;
    }
}
?>


