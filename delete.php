<?php
include 'connection.php';
    if($_SERVER['REQUEST_METHOD']=="POST"){
        global $con;
        $delete_id=$_POST['delete_id'];
        $delete="DELETE FROM `skincare` WHERE `id`='$delete_id'";
        $res=$con->query($delete);
        if($res){
            echo '<script>window.location.href="index.php"</script>';
        }
    }
?>