<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .'/user_management/request/Request.php');
  $mobile = $_POST['mobile'];
  $req = new Request();
  $result = $req->validateMobile($mobile);
  if(!$result)
  {
    echo "<span style='color:red'> * mobile already exists .</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else
  {
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }

?>