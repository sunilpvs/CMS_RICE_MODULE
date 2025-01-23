<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/inwardlease/Inwardlease.php');
  $contract_id = trim($_POST['contract_id']); 
  $blank= FALSE;
    if($contract_id == "")
    {
        $blank = TRUE;
    } 
  $lease = new Inwardlease();
  $result = $lease->validateLeasecontact($contract_id);
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



