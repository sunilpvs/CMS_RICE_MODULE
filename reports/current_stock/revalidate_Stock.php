<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/reports/reports.php');

    $customer_id = trim($_POST['customer_id']);
    $warehouse_id = trim($_POST['warehouse_id']);
    $compartment_id = trim($_POST['compartment_id']);
    $commodity_id = trim($_POST['commodity_id']);
    $mod_transport = trim($_POST['mod_transport']);
    
    $result = FALSE;
    $blank= FALSE;
    if($customer_id == "" && $warehouse_id == "" && $compartment_id == "" && $commodity_id == "" && $mod_transport == "")
    {
        $blank = TRUE;
    }
    else
    {
        $rep = new AllReports();
        $result = $rep->revalidateStock($customer_id, $warehouse_id, $commodity_id, $compartment_id, $mod_transport);
    }
        
    if($blank == TRUE)
    {
        echo "<span style='color:red'> *blank record.</span>";
    }  
    else
    {
        echo "header('Location:../../stock-rpt')";
    }
?> 



