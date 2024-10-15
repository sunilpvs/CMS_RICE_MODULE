<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/customer/Customer.php');
$customer_name = $_POST['customer_name'];
$customer = new Customer();
$result = $customer->validateCustomername($customer_name);
if(!$result)
{
    echo "<span style='color:red'> * already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }

?> 



