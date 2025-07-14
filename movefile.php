<?php
function moveFile($name){
     $image=date('ymd_his').'_'.$_FILES[$name]['name'];
     $tmp_name=$_FILES[$name]['tmp_name'];
     $path='uploads/'.$image;
     move_uploaded_file($tmp_name,$path);
     return $image;
}
?>