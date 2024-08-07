<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/designation/Designation.php');
$name = $_POST['name'];
$des = new Designation();
$result = $des->validateName($name);
if(!$result)
{
  echo "<span style='color:red'> * already exists.</span>";
  echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
}else{
  echo "<span style='color:green'> </span>";
  echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
}

?> 



