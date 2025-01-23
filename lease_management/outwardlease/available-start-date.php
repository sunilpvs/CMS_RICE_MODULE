<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/outwardlease/Outwardlease.php');
  $lease_start = trim($_POST['lease_start']); 
  $warehouse_id = trim($_POST['warehouse_id']); 
   $blank= FALSE;
    if($lease_start == "")
    {
        $blank = TRUE;
    } 
  
  $lease = new Outwardlease();
  $result = $lease->validateClientstartdate($lease_start,$warehouse_id);
  if(!$result)
  {
      echo "<span style='color:red'>* Invalid start date.</span>";
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



