<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTTNU61INGd0WsLzcBe7X3Jzs7eOAvO5kDTA&s">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Login</title>
    <style>
        *{
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }
        body{
            background-image: url('https://img.freepik.com/free-photo/natural-cosmetics-frame_23-2148574907.jpg?semt=ais_hybrid&w=740');
            background-repeat: no-repeat;
            background-size: cover;
            height: 86vh;
        }
        form{
            width: 400px;
            padding: 40px;
            border-radius: 10px;
            margin: 170px auto;
            background-color:84AE92;
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
</head>
<body>
    <form action="" method="post">
        <h2 class="text-center">Login </h2>
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group d-flex justify-content-center mt-2">
            <a href="register.php">Create an account?</a>
        </div>
        <div class="form-group d-flex justify-content-center mt-3">
            <button class="w-100">Login</button>
        </div>
    </form>
</body>
</html>
<?php
    include 'connection.php';
    session_start();
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $select="SELECT `email`, `password` FROM `users` WHERE `email`='$email' AND `password`='$password'";
        global $con;
        $result=$con->query($select);
        if($result->num_rows<=0){
            echo '
                <div id="myAlert" class="alert alert-danger alert-dismissible fade show " role="alert" style="position:absolute; top: 30px; right:40%;">
                    Incorrect email or password!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            ';
        }else{
            $_SESSION['login']=$email;
            header('location: index.php');
        }
    }
?>
<script>
    document.addEventListener('DOMContentLoaded',function(){
        setTimeout(function(){
            const alert = bootstrap.Alert.getOrCreateInstance(document.getElementById('myAlert'));
            alert.close();
        },5000); //5000 milliseconds = 5 seconds
    });
</script>