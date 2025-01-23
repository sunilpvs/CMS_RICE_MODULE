<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/lessor/Lessor.php');
$lessor_id = trim($_POST['lessor_id']);
$lessor_name = trim($_POST['lessor_name']);
$result = FALSE;
 $blank= FALSE;
    if($lessor_name == "")
    {
        $blank = TRUE;
    }
$lessor = new Lessor();
$result = $lessor->validateLessornameEdit($lessor_name,$lessor_id);
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



