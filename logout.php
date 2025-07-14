<?php
    setcookie('login',$name_email,time()-60,'/');
    header('Location: login.php');
?>