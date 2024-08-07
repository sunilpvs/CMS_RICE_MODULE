<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] ."/reports/reports.php");
    
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
            $rep = new AllReports();
            $result = $rep->getStockReport();
            require_once "../../reports/stock_report/vStock_Report.php";
            break;
    }
?>