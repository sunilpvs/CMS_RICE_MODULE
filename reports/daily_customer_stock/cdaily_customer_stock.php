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
    case "generate_report":
        if(isset($_POST))
        {
            $customer = $_POST['customer'];
            $commodity = $_POST['commodity'];
            $rpt_date = date("Y-m-d",strtotime($_POST['rptdate']));
            if($customer > 0 )
            {
                $report = new AllReports();
                $openstock_result = $report->getCustomerOpeningStock($customer, $commodity, $rpt_date);
                $inward_result = $report->getCustomerInwardStock($customer, $commodity, $rpt_date);
                $inward_wagon_result = $report->getCustomerWagonInwardStock($customer, $commodity, $rpt_date);
                $outward_result = $report->getCustomerOutwardStock($customer, $commodity,  $rpt_date);
                require_once ($_SERVER['DOCUMENT_ROOT'] ."/reports/daily_customer_stock/daily_cust_stock.php");    
            }
            else{
                header("Location: ../../daily_customer_stock-rpt");
                exit;    
            }
        }
        else
        {
            header("Location: ../daily_customer_stock-rpt");
            exit;
        }    
        break;
    default:
        //$report = new AllReports();
        //$result = $report->getCustomerStock();
        require_once ($_SERVER['DOCUMENT_ROOT'] ."/reports/daily_customer_stock/vdaily_customer_stock.php");
        break;
}
?>