<?php
    session_start();
    if(empty($_SESSION['login'])){
        header('location: login.php');
    }
    include 'connection.php';
    global $con;
            $email=$_SESSION['login'];
            $get_user_id="SELECT `user_id` FROM `users` WHERE `email`='$email'";
            $res=$con->query($get_user_id);
            $user_id=$res->fetch_assoc()['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="container mt-5 shadow-lg p-3 rounded">
        <h3>Skin Care Stock</h3>
        <button class="btn btn-primary rounded-pill py-2 float-end" id="btnAdd" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-circle me-1"></i>Add Skin Care</button>
        <table class="table text-center align-middle mt-5" style="table-layout: fixed;">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>User</th>
                    <th>Action</th>
                </tr>            
            </thead>
            <tbody>
                <?php
                    global $con;
                    $select="SELECT * ,`profile` FROM `skincare` INNER JOIN `users` ON `userID`=`user_id`";
                    $result=$con->query($select);
                    while($row=$result->fetch_assoc()){
                        echo '
                            <tr>
                                <td>'.$row['id'].'</td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['price'].'</td>
                                <td>'.$row['stock'].'</td>
                                <td><img width="80" src="./uploads/'.$row['image'].'" alt=""></td>
                                <td><img width="80" src="./uploads/'.$row['profile'].'" alt=""></td>
                                <td>
                                    <button class="btn btn-warning me-1" id="btnEdit" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                                    <button class="btn btn-danger" data-id="'.$row['id'].'" data-bs-toggle="modal" id="btnDelete" data-bs-target="#exampleModal1">Delete</button>
                                </td>
                            </tr>
                        ';
                    }
                ?>
            </tbody>
        </table>
        <a href="logout.php">Logout</a>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="hide_id" id="hide_id">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" min="1" name="stock" id="stock" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" name="price" id="price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="expire" class="form-label">Expire</label>
                            <input type="date" name="expire" id="expire" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <input type="hidden" name="hide_image" id="hide_image">
                        </div>
                        <div class="form-group mt-3 d-flex justify-content-end">
                            <button type="button" class="btn-danger me-1" data-bs-dismiss="modal" >Cancel</button>
                            <input type="submit" value="Save" id="save" name="btn" class="btn btn-primary">
                            <input type="submit" value="Edit" id="edit" name="btn" class="btn btn-success" >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="#exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this product?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="delete.php" method="post">
                        <div class="form-group d-flex justify-content-end gap-2">
                            <input type="hidden" name="delete_id" id="delete_id">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes,delete it.</button>
                        </div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#btnAdd').click(function(){
            $('#exampleModalLabel').html('Add Skin Care');
            $('#save').show();
            $('#edit').hide();
        });
        $(document).on('click','#btnEdit',function(){
            $('#exampleModalLabel').html('Edit Skin Care');
            $('#save').hide();
            $('#edit').show();
            //get data form table
            const tr=$(this).parents('tr');
            const t_code=tr.find('td').eq(0).text();
            const t_name=tr.find('td').eq(1).text();
            const t_price=tr.find('td').eq(2).text();
            const t_stock=tr.find('td').eq(3).text();
            const t_expire=tr.find('td').eq(4).text();
            const t_image=tr.find('img').eq(0).attr('src').split('/').pop();
            //input data into form
            $('#hide_id').val(t_code);
            $('#name').val(t_name);
            $('#price').val(t_price);
            $('#stock').val(t_stock);
            $('#expire').val(t_expire);
            $('#hide_image').val(t_image);
        });
        $(document).on('click','#btnDelete',function(){
            $('#delete_id').val($(this).attr('data-id'));
        })
        
    });
</script>
<?php
    include 'movefile.php';
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name=$_POST['name'];
        $stock=$_POST['stock'];
        $price=$_POST['price'];
        $expire=$_POST['expire'];
        if(!empty($_FILES['image']['name'])){
            $image=moveFile('image');
        }else{
            $image=$_POST['hide_image'];
        }        
        global $con;
        global $user_id;
        $btn=$_POST['btn'];
        if($btn=="Save"){
            $insert="INSERT INTO `skincare`(`name`,`price`,`stock`,`image`,`userID`,`expire`)
            VALUES ('$name','$price','$stock','$image','$user_id','$expire')";
            $res=$con->query($insert);
            if($res){
                echo '<script>window.location.href="index.php"</script>';
            }
        }else if($btn=='Edit'){
            $code=$_POST['hide_id'];
            global $user_id;
            $update_at=date('y-m-d H:i:s');
            $update="UPDATE `skincare` SET`name`='$name',`price`='$price',`stock`='$stock',`image`='$image',
            `userID`='$user_id',`expire`='$expire',`update_ad`='$update_at' WHERE `id`='$code'";
            $res=$con->query($update);
            
            if($res){
                echo '<script>window.location.href="index.php"</script>';
            }
        }
    }
    
?>