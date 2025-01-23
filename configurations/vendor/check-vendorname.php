<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/vendor/Vendor.php');
$vendor_name = trim($_POST['vendor_name']);
 $blank= FALSE;
    if($vendor_name == "")
    {
        $blank = TRUE;
    }
$vendor = new Vendor();
$result = $vendor->validateVendorname($vendor_name);
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



