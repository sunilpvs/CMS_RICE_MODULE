<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .'/user_management/request/Request.php');
  $email = $_POST['personal_email'];
  $req = new Request();
  $result = $req->validatePEMail($email);
  if(!$result)
  {
    echo "<span style='color:red'> * email already exists .</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else
  {
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }

?>