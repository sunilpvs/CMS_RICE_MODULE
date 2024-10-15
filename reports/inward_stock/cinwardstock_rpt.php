<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");
    require_once($_SERVER['DOCUMENT_ROOT'] ."/reports/inward_stock/Inwardstock_Report.php");

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
    case "inward-filter":
        if (isset($_POST['btnSubmit'])) {
            $customer_id = $_POST['customer']; 
            $warehouse_id = $_POST['warehouse'];
            $compartment_id = $_POST['compartment'];
            $miller_id = $_POST['miller'];
            $commodity_id = $_POST['commodity'];
            $transport_id = $_POST['transport'];
            $mycheck_id=null;
            if (isset($_POST['myCheck'])){$mycheck_id = $_POST['myCheck'];}
            $dt=null;
            if (isset($_POST['yourDateField'])){$dt = $_POST['yourDateField'];}
            $rpt = new Inwardstock_Report();
            $report = $rpt->getInwardStockReport($customer_id,$warehouse_id,$compartment_id,$miller_id,$commodity_id,$transport_id,$mycheck_id,$dt);
            require_once "../../reports/inwardstock/vreport_view.php";
        }
        break;

    default:
        $pro = new Generic();
        $result = $pro->getOutwardStockStock();
        require_once "../../reports/inward_stock/vinwardstock_rpt.php";
        break;
}
?>