<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/reports/currrent_stock/reports.php');

    $customer_id = trim($_POST['cust_id']);
    $warehouse_id = trim($_POST['w_id']);
    $compartment_id = trim($_POST['comp_id']);
    $commodity_id = trim($_POST['comm_id']);
    $mod_transport = trim($_POST['trans_id']);
    
    $result = FALSE;
    $blank= FALSE;
    if($customer_id == "" && $warehouse_id == "" && $compartment_id == "" && $commodity_id == "" && $mod_transport = "")
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
        echo "header('Location:../../reports/current_stock/vcurrent_stock.php')";
    }
?> 



