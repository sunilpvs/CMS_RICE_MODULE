<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/warehouse/Warehouse.php');
$warehouse_id = trim($_POST['warehouse_id']);
$code = trim($_POST['code']);
$result = FALSE;
 $blank= FALSE;
    if($code == "")
    {
        $blank = TRUE;
    }
$warehousecode = new Warehouse();
$result = $warehousecode->validateWarehousecodeEdit($code,$warehouse_id);
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



