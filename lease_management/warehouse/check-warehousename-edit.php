<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/warehouse/Warehouse.php');
$warehouse_id = trim($_POST['warehouse_id']);
$warehouse_name = trim($_POST['warehouse_name']);
$result = FALSE;
 $blank= FALSE;
    if($warehouse_name == "")
    {
        $blank = TRUE;
    }
$warehouse = new Warehouse();
$result = $warehouse->validateWarehousenameEdit($warehouse_name,$warehouse_id );
if($result ===  true)
{
    echo "<span style='color:red'> * already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
}

else if($blank == TRUE)
    {
        echo "<span style='color:red'> *blank record.</span>";
        echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
    }
else
{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
}

?> 



