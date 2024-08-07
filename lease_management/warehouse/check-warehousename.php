<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/warehouse/Warehouse.php');
$warehouse_name = $_POST['warehouse_name'];
$warehouse = new Warehouse();
$result = $warehouse->validateWarehousename($warehouse_name);
if(!$result)
{
    echo "<span style='color:red'> * already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }

?> 



