<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/department/Department.php');
  $name = $_POST['name'];
  $code = $_POST['code'];
  if($name == "" || $code == "")
  {
    echo "<span style='color:red'> *no data.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }
  $dep = new Department();
  $result = $dep->validateDuplicates($name , $code);
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



