<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/vendor/Vendor.php');
$vendor_id = $_POST['vendor_id'];
$vendor_name = $_POST['vendor_name'];
$vendor = new Vendor();
$result = $vendor->validateVendornameEdit($vendor_id,$vendor_name);
if(!$result)
{
    echo "<span style='color:red'> * already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }

?> 



