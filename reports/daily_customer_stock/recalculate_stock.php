<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/reports/reports.php');
    $customer_id = trim($_POST['customer_id']);
    $commodity_id = trim($_POST['commodity_id']);
    $rpt_date = date("Y-m-d",strtotime($_POST['stk_date']));
    
    if($customer_id > 0 )
    {
        $report = new AllReports();
        $openstock_result = $report->updateCustomerOpeningStock($customer_id, $commodity_id, $rpt_date);
        if($openstock_result != true)
        {
            echo "<span style='color:green'> *No stock available for Customer/Commodity for update.</span>";
        }
        else if( $openstock_result == true)
        {
            echo "<span style='color:green'> *Opening Stock details for Customer/Commodity re-validated.</span>";
        }
    }
?>