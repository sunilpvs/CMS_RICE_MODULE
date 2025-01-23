<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/customer/Customer.php');
$customer_name = trim($_POST['customer_name']);
 $blank= FALSE;
    if($customer_name == "")
    {
        $blank = TRUE;
    }
$customer = new Customer();
$result = $customer->validateCustomername($customer_name);
if(!$result)
{
    echo "<span style='color:red'> * already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }
else if($blank == TRUE)
    {
        echo "<span style='color:red'> *blank record.</span>";
        echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
    }
  else{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }

?> 



