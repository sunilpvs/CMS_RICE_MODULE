<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/outwardlease/Outwardlease.php');
  $lease_start = $_POST['lease_start']; 
  $warehouse_id = $_POST['warehouse_id']; 
  
  $lease = new Outwardlease();
  $result = $lease->validateClientstartdate($lease_start,$warehouse_id);
  if(!$result)
  {
      echo "<span style='color:red'>* Invalid start date.</span>";
      echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
    }else{
      echo "<span style='color:green'> </span>";
      echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
    }
?> 



