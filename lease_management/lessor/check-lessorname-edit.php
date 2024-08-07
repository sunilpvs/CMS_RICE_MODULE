<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/lessor/Lessor.php');
$lessor_id = $_POST['lessor_id'];
$lessor_name = $_POST['lessor_name'];
$lessor = new Lessor();
$result = $lessor->validateLessornameEdit($lessor_name,$lessor_id);
if(!$result)
{
    echo "<span style='color:red'>* already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'> </span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }

?> 



