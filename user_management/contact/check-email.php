<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/masters/contact/Contact.php');
$email = $_POST['email'];
$con = new Contact();
$result = $con->validateEmail($email);
if(!$result)
{
    echo "<span style='color:red'> * already exists .</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }    
?> 



