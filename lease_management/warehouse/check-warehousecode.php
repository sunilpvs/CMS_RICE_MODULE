<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/warehouse/Warehouse.php');
$code = $_POST['code'];
$warehousecode = new Warehouse();
$result = $warehousecode->validateWarehousecode($code);
if(!$result)
{
    echo "<span style='color:red'> * already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }

?> 



