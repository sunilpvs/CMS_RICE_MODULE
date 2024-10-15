<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/outwardlease/Outwardlease.php');

$lease_capacity_sqft = $_POST['lease_capacity_sqft']; 
$warehouse_id = $_POST["warehouse_id"];
$lease = new Outwardlease();
$result = $lease->validateLeasecapacitysqft($lease_capacity_sqft,$warehouse_id );
if(!$result)
{
    echo "<span style='color:red'>* Invalid capacity(Sqft).</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'> </span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }
?> 