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
            $cust = $_POST['customer'];
            $rpt_date = date("d-M-y",strtotime($_POST['rptdate']));
            if($cust > 0 )
            {
                $report = new AllReports();
                $inward_result = $report->getCustomerInwardStock($cust, $rpt_date);
                $outward_result = $report->getCustomerOutwardStock($cust, $rpt_date);
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