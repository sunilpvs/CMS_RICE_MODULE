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
        if (isset($_POST['Report'])) 
        {
            $customer_id = $_POST['customer'];
            $commodity_id = $_POST['commodity'];
            $rpt_date = date("Y-m-d",strtotime($_POST['rptdate']));
            if($customer_id > 0 )
            {
                $report = new AllReports();
                $openstock_result = $report->getCustomerOpeningStock($customer_id, $commodity_id, $rpt_date);
                $inward_result = $report->getCustomerInwardStock($customer_id, $commodity_id, $rpt_date);
                $inward_wagon_result = $report->getCustomerWagonInwardStock($customer_id, $commodity_id, $rpt_date);
                $outward_result = $report->getCustomerOutwardStock($customer_id, $commodity_id,  $rpt_date);
                require_once ($_SERVER['DOCUMENT_ROOT'] ."/reports/daily_customer_stock/daily_cust_stock.php");    
            }
            else{
                header("Location: ../../daily_customer_stock-rpt");
                exit;    
            }
        }
        // else if (isset($_POST['Stock'])) 
        // {
        //     $customer_id = $_POST['customer'];
        //     $commodity_id = $_POST['commodity'];
        //     $rpt_date = date("Y-m-d",strtotime($_POST['rptdate']));
        //     if($customer_id > 0 )
        //     {
        //         $report = new AllReports();
        //         $openstock_result = $report->updateCustomerOpeningStock($customer_id, $commodity_id, $rpt_date);
        //         if($openstock_result == -1)
        //         {
        //             $info_message = "No stock available for Customer/Commodity for update.";
        //             header("Location: ../../daily_customer_stock-rpt");
        //             exit;
        //         }
        //         else if($openstock_result >= 0)
        //         {
        //             $info_message = "Opening Stock details for Customer/Commodity re-validated.";
        //             header("Location: ../../daily_customer_stock-rpt");
        //             exit;
        //         }

        //     }
        // }
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