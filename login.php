
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
    <style>
        form{
            width: 400px;
            padding: 30px;
            margin: 100px auto;
            border: 1px solid #333;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h3 class="text-center">Login</h3>
        <div class="form-group">
            <label for="" class="form-label">Email/Username</label>
            <input type="text" name="name_email" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="" class="form-label">Password</label>
            <input type="password" name="password" id="" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-primary mt-3 w-100">Login</button>
        </div>
    </form>
</body>
</html>
<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name_email=$_POST['name_email'];
        $password=$_POST['password'];
        if($name_email=='admin@gmail.com' || $name_email=='Admin'){
            if($password=='admin123'){
                setcookie('login',$name_email,time()+60,'/');
                header('Location: index.php');
            }
        }
    }
?>