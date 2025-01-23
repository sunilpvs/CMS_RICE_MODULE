<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/user_management/contact/Contact.php');
$email = trim($_POST['email']);
$con = new Contact();
 $blank= FALSE;
if($email == "")
    {
        $blank = TRUE;
    }

$result = $con->validateEmail($email);
if(!$result)
{
    echo "<span style='color:red'> * already exists .</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }
 else if($blank == TRUE)
    {
        echo "<span style='color:red'> *blank record.</span>";
        echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
    }
  else{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }    
?> 



