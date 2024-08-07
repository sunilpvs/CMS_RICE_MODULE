<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/warehouse/Warehouse.php');
$warehouse_id = $_POST['warehouse_id'];
$warehouse_name = $_POST['warehouse_name'];
$warehouse = new Warehouse();
$result = $warehouse->validateWarehousenameEdit($warehouse_name,$warehouse_id );
if($result ===  true)
{
    echo "<span style='color:red'> * already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
}
else
{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
}

?> 



