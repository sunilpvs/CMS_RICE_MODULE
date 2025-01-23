<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/delivery/Delivery.php');
$delivery_name = trim($_POST['delivery_name']);
$delivery = new Delivery();
 $blank= FALSE;
    if($delivery_name == "")
    {
        $blank = TRUE;
    }

$result = $delivery->validateDeliveryname($delivery_name);
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



