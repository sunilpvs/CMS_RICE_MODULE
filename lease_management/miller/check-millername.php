<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/miller/Miller.php');
$miller_name = $_POST['miller_name'];
$miller = new Miller();
$result = $miller->validateMillername($miller_name);
if(!$result)
{
    echo "<span style='color:red'>* already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'> </span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }

?> 



