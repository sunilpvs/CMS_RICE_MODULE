<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/delivery/Delivery.php');
$delivery_id = $_POST['delivery_id'];
$delivery_name = $_POST['delivery_name'];
$delivery = new Delivery();
$result = $delivery->validateDeliverynameEdit($delivery_name,$delivery_id);
if(!$result)
{
    echo "<span style='color:red'>* already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'> </span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }

?> 



