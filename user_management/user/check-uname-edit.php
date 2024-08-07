<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/user_management/user/User.php');
$u_id = $_POST['user_id'];
$uname = $_POST['user_name'];
$usr = new User();
$result = $usr->validateUNameEdit($uname);
if(!$result)
{
    echo "<span style='color:red'> * already exists .</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }    
?> 



