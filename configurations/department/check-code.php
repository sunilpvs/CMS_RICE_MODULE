<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/department/Department.php');  
  
  $code = $_POST['code'];
  $dep = new Department();
  $result = $dep->validateCode($code);
  if(!$result)
  {
      echo "<span style='color:red'> * already exists.</span>";
      echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }
  else
  {
      echo "<span style='color:green'></span>";
      echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }
?>  

