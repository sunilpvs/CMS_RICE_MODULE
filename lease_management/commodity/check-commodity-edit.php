<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/commodity/Commodity.php');
$commodity_id = $_POST['commodity_id'];
$commodity_name = $_POST['commodity_name'];
$brand = $_POST['brand'];
$marking = $_POST['marking'];
$commodity = new Commodity();
$result = $commodity->validateCommodityEdit($commodity_id, $commodity_name, $brand, $marking);
    if(!$result)
    {
        echo "<span style='color:red'> *combination already exists.</span>";
        echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
    }
    else
    {
        echo "<span style='color:green'></span>";
        echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
    }

?> 



