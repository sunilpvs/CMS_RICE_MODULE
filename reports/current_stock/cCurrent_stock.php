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
    $report = new AllReports();
    $result = $report->getCurrentStock();
    require_once ($_SERVER['DOCUMENT_ROOT'] ."/reports/current_stock/vcurrent_stock.php");
    break;
}
?>