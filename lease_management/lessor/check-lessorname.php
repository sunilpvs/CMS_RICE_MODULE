<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/lessor/Lessor.php');
$lessor_name = $_POST['lessor_name'];
$lessor = new Lessor();
$result = $lessor->validateLessorname($lessor_name);
if(!$result)
{
    echo "<span style='color:red'>* already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'> </span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }

?> 



