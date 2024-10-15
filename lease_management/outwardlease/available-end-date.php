<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/outwardlease/Outwardlease.php');
  $lease_end = $_POST['lease_end']; 
  $warehouse_id = $_POST['warehouse_id']; 

  $lease = new Outwardlease();
  $result = $lease->validateClientenddate($lease_end,$warehouse_id);
  if(!$result)
  {
    echo "<span style='color:red'>* Invalid end date.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'> </span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }
?> 
