<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/miller/Miller.php');
$miller_name = trim($_POST['miller_name']);
 $blank= FALSE;
    if($miller_name == "")
    {
        $blank = TRUE;
    }

$miller = new Miller();
$result = $miller->validateMillername($miller_name);
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



