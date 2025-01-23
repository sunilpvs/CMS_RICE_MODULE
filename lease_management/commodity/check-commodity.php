<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/commodity/Commodity.php');
$commodity_name = trim($_POST['commodity_name']);
$brand = trim($_POST['brand']);
$marking =trim( $_POST['marking']);
 $blank= FALSE;
    if($commodity_name == "" || $brand == "" || $marking == "" ||)
    {
        $blank = TRUE;
    }
$commodity = new Commodity();
$result = $commodity->validateCommodity($commodity_name, $brand, $marking);
    if(!$result)
    {
        echo "<span style='color:red'> *combination already exists.</span>";
        echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
    }
    else if($blank == TRUE)
    {
        echo "<span style='color:red'> *blank record.</span>";
      
    else
    {
        echo "<span style='color:green'></span>";
        echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
    }

?> 



