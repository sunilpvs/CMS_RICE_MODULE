<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/user_management/contact/Contact.php');
$contact_id = trim($_POST['contact_id']);
$email = trim($_POST['email']);
$result = FALSE;
$blank= FALSE;
if($email == "")
    {
        $blank = TRUE;
    }
$con = new Contact();
$result = $con->validateEmailEdit($email,$contact_id);
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







