<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/stock_management/outwardstock/Outwardstock.php");

$db_handle = new DBController();
// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{

 $action = "default";}
switch ($action) {    
    case "outwardstock-add":
        if (isset($_POST['add'])) {
            $customer_id = $_POST['customer'];
            $warehouse_id = $_POST['warehouse'];
            $compartment_id = $_POST['compartment'];
            $transport_id = $_POST['transport'];
            $commodity_id = $_POST['commodity_id'];

            $outward_date = $_POST['outward_date']; 
            $dc_no = $_POST['dc_no'];
            $dc_date = $_POST['dc_date'];     
            $bags_out = $_POST['bags_out'];
            $vehicle_no = $_POST['vehicle_no'];
            $delivery_dtl = $_POST['delivery_dtl'];            
            $current_bags_stock = $_POST['current_bags_stock'];
            //$net_wtg = $_POST['net_wtg'];
            //$wbridge_wtg = $_POST['wbridge_wtg'];
            //$wbridge_diff = $_POST['wbridge_diff'];
            $outward_gross_wt = $_POST['outward_gross_wt'];
            $outward_net_wt= $_POST['outward_net_wt'];
            $outward_wb_gross_wt= $_POST['outward_wb_gross_wt']; 
            $outward_wb_net_wt= $_POST['outward_wb_net_wt']; 
            $outward_diff_gross= $_POST['outward_diff_gross']; 
            $outward_diff_net= $_POST['outward_diff_net'];
            $remarks = $_POST['remarks'];
            $id = $_SESSION['id'];
            $outwardstock = new Outwardstock();
            $insertId = $outwardstock->addOutwardstock($customer_id, $warehouse_id, $compartment_id, $commodity_id, $transport_id, $outward_date, $dc_no, $dc_date, 
                                    $bags_out, $vehicle_no, $current_bags_stock, $delivery_dtl, $outward_gross_wt, $outward_net_wt, $outward_wb_gross_wt, 
                                    $outward_wb_net_wt, $outward_diff_gross, $outward_diff_net,$remarks,$id);

            //$insertId = $outwardstock->addOutwardstock($outward_date, $dc_no, $dc_date, $commodity_id, $comp_id, $vehicle_no, $current_bags_stock, $bags_out, $delivery_dtl,$outward_gross_wt,$outward_net_wt,$outward_wb_gross_wt, $outward_wb_net_wt, $outward_diff_gross, $outward_diff_net,$remarks,$id);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../stock_management/outwardstock/cOutwardstock.php");
            }
        }
        require_once ($_SERVER['DOCUMENT_ROOT'] ."/stock_management/outwardstock/outwardstock-add.php");
        break;
    
    case "outwardstock-edit":
        $outwardstock_id = $_GET["id"];
        $outwardstock = new Outwardstock();
        if (isset($_POST['add'])){
            $outward_date = $_POST['outward_date']; 
            $dc_no = $_POST['dc_no'];
            $dc_date = $_POST['dc_date'];     
            $commodity_id = $_POST['commodity_id'];
            $comp_id = $_POST['comp_id'];
            $vehicle_no = $_POST['vehicle_no'];
            $bags_out = $_POST['bags_out'];
            $net_wtg = $_POST['net_wtg'];
            $wbridge_wtg = $_POST['wbridge_wtg'];
            $wbridge_diff = $_POST['wbridge_diff'];
            $delivery_dtl = $_POST['delivery_dtl'];
            $remarks = $_POST['remarks'];
            
        $outwardstock->editOutwardstock($outward_date, $dc_no, $dc_date, $commodity_id, $comp_id, $vehicle_no,$bags_out, $net_wtg,$wbridge_wtg,$wbridge_diff,$delivery_dtl,$remarks,$outwardstock_id); 
        header("Location: ../../stock_management/outwardstock/cOutwardstock.php");
        }
        $result = $outwardstock->getOutwardstockById($outwardstock_id);
        require_once "../../stock_management/outwardstock/outwardstock-edit.php";
        break;
    
    case "outwardstock-delete":
        $outwardstock_id = $_GET["id"];
        $outwardstock = new Outwardstock();
        $outwardstock->deleteOutwardstock($outwardstock_id);
        $result = $outwardstock->getAllOutwardstock();
        require_once "../../stock_management/outwardstock/vOutwardstock.php";
        break;

    case "outward-filter":
                $date_pic = $_POST['date_picker'];
                $newDate = date("d-M-Y", strtotime($date_pic));
        
                $inwardstock = new Outwardstock();
                $result = $inwardstock->getAllOutwardstock($newDate);
                require_once "../../stock_management/outwardstock/vOutwardstock.php";
                break;    
    
    default:
        $outwardstock = new Outwardstock();
        $dt =  date("d-m-Y");
        $result = $outwardstock->getAllOutwardstock($dt);
        require_once "../../stock_management/outwardstock/vOutwardstock.php";
        break;
       
}
?>