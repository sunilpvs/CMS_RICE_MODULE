<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/bulk_ops/delivery/Delivery.php');
$delivery_name = $_POST['delivery_name'];
$delivery = new Delivery();
$result = $delivery->validateDeliveryname($delivery_name);
if(!$result)
{
    echo "<span style='color:red'>* already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'> </span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }

?> 



