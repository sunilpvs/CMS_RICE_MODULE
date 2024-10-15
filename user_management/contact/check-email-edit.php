<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/user_management/contact/Contact.php');
$contact_id = $_POST['contact_id'];
$email = $_POST['email'];
$con = new Contact();
$result = $con->validateEmailEdit($email,$contact_id);
if(!$result)
{
    echo "<span style='color:red'> * already exists .</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }    
?> 







