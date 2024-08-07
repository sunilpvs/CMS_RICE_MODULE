<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/designation/Designation.php');
$code = $_POST['code'];
$des = new Designation();
$result = $des->validateCode($code);
if(!$result)
{
    echo "<span style='color:red'> * already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }
?>  

