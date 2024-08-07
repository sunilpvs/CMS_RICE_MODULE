<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

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
    $pro = new Generic();
    $result = $pro->getOutwardLeaseStock();
    require_once ($_SERVER['DOCUMENT_ROOT'] ."/reports/outward_stock/voutwardstock_rpt.php");
    break;
}
?>