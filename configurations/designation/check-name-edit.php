<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/designation/Designation.php');
$designation_id = $_POST['designation_id'];
$name = $_POST['name'];
$des = new Designation();
$result = $des->validateNameEdit($name,$designation_id);
if(!$result)
{
  echo "<span style='color:red'> * already exists.</span>";
  echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
}else{
  echo "<span style='color:green'> </span>";
  echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
}

?> 



