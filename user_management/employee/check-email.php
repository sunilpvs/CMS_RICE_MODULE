<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/user_management/employee/Employee.php');
$email = trim($_POST['email']);
$blank= FALSE;
if($email == "")
    {
        $blank = TRUE;
    }
$emp = new Employee();
$result = $emp->validateEmail($email);
if(!$result)
{
  echo "<span style='color:red'> * already exists.</span>";
  echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
}
 else if ($blank == TRUE)
    {
        echo "<span style='color:red'> *duplicate record.</span>";
        echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
    }
else{
  echo "<span style='color:green'></span>";
  echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
}  
?> 



