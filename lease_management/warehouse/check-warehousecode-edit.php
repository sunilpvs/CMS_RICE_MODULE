<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/warehouse/Warehouse.php');
$warehouse_id = $_POST['warehouse_id'];
$code = $_POST['code'];
$warehousecode = new Warehouse();
$result = $warehousecode->validateWarehousecodeEdit($code,$warehouse_id);
if(!$result)
{
    echo "<span style='color:red'> * already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }

?> 



