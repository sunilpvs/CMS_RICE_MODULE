<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/lessor/Lessor.php');
$lessor_name = trim($_POST['lessor_name']);
 $blank= FALSE;
    if($lessor_name == "")
    {
        $blank = TRUE;
    }
$lessor = new Lessor();
$result = $lessor->validateLessorname($lessor_name);
if(!$result)
{
    echo "<span style='color:red'>* already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }
 else if($blank == TRUE)
    {
        echo "<span style='color:red'> *blank record.</span>";
        echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
    }
  else{
    echo "<span style='color:green'> </span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }

?> 



