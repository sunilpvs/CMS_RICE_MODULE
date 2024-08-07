<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] ."/reports/reports.php");

    if (! empty($_GET["action"])) 
    {
        $action = $_GET["action"];
    }
    else
    {
        $action = "default";
    }
    switch ($action) 
    {        
        default:
        $pro = new AllReports();
        $result = $pro->getOutwardLeaseReport();
        require_once "../../reports/outward_leases/voutwardlease_stock.php";
        break;
    }
?>