<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/vendor/Vendor.php');
$vendor_id = trim($_POST['vendor_id']);
$vendor_name = trim($_POST['vendor_name']);
$result = FALSE;
    $blank= FALSE;
    if($vendor_name == "")
    {
        $blank = TRUE;
    }
$vendor = new Vendor();
$result = $vendor->validateVendornameEdit($vendor_id,$vendor_name);
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



