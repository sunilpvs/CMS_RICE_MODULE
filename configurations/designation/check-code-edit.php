<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/designation/Designation.php');
$designation_id = $_POST['designation_id'];
$code = $_POST['code'];
$des = new Designation();
$result = $des->validateCodeEdit($code,$designation_id);
if(!$result)
{
  echo "<span style='color:red'> * already exists.</span>";
  echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
}else{
  echo "<span style='color:green'> </span>";
  echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
}

?> 