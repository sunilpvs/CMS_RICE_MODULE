<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/outwardlease/Outwardlease.php');
$lease_capacity_mton = trim($_POST['lease_capacity_mton']); 
$warehouse_id = trim($_POST["warehouse_id"]);
 $blank= FALSE;
    if($lease_capacity_mton == "")
    {
        $blank = TRUE;
    } 
$lease = new Outwardlease();
$result = $lease->validateLeasecapacitymton($lease_capacity_mton,$warehouse_id);
if(!$result)
{
    echo "<span style='color:red'>* Invalid capacity(Mton).</span>";
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
