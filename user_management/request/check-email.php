<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .'/user_management/request/Request.php');
  $email = $_POST['email'];
  $req = new Request();
  $result = $req->validateEMail($email);
  if(!$result)
  {
    echo "<span style='color:red'> * user already exists .</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else
  {
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }

?>