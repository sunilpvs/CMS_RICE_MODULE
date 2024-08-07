<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");
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
    $rep = new AllReports();
    $result = $rep->getInwardLeaseReport();
    require_once ($_SERVER['DOCUMENT_ROOT'] ."/reports/inward_leases/vinwardlease_stock.php");
    break;
}
?>