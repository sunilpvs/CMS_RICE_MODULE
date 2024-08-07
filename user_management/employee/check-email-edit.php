<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/user_management/employee/Employee.php');
$employee_id = $_POST['employee_id'];
$email = $_POST['email'];
$emp = new Employee();
$result = $emp->validateEmailEdit($email,$employee_id);
if(!$result)
{
  echo "<span style='color:red'> * already exists.</span>";
  echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
}else{
  echo "<span style='color:green'></span>";
  echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
}  
?> 



