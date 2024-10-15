<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/inwardlease/Inwardlease.php');
  $contract_id = $_POST['contract_id']; 
  $lease = new Inwardlease();
  $result = $lease->validateLeasecontact($contract_id);
  if(!$result)
  {
      echo "<span style='color:red'>* already exists.</span>";
      echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
    }else{
      echo "<span style='color:green'> </span>";
      echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
    }
?> 



