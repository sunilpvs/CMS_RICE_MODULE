<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
require_once($_SERVER['DOCUMENT_ROOT'] ."/class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/bulk_ops/inwardstock/Inwardstock.php");
$db_handle = new DBController();
// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{

 $action = "default";}
switch ($action) {    
    case "inwardstock-add":
        if (isset($_POST['add'])) {
            $received_date = $_POST['received_date'];  
            $invoice_no = $_POST['invoice_no'];
            $invoice_date = $_POST['invoice_date'];     
            $miller_name = $_POST['miller_name'];
            $gst_no = $_POST['gst_no'];
            $place = $_POST['place'];  
            $mode_transport = $_POST['mode_transport'];
            $godown_name= $_POST['godown_name'];
            $compartment_name = $_POST['compartment_name'];
            $cargo_details = $_POST['cargo_details '];
            $vehicle_no = $_POST['vehicle_no'];
            $bag_mark = $_POST['bag_mark'];
            $bag_wtg = $_POST['bag_wtg'];
            $bags_rec = $_POST['bags_rec'];
            $wbridge_wtg = $_POST['wbridge_wtg'];
            $net_wtg = $_POST['net_wtg'];
            $remarks = $_POST['remarks'];
            $id = $_SESSION['id'];

            $inwardstock = new Inwardstock();
            $insertId = $inwardstock->addInwardstock($received_date, $invoice_no, $invoice_date,$miller_name,  $gst_no, $place, $mode_transport, $godown_name, $compartment_name, $cargo_details,$vehicle_no,$bag_mark ,$bag_wtg,$bags_rec, $wbridge_wtg,$net_wtg ,$remarks,$id);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../bulk_ops/inwardstock/cInwardstock.php");
            }
        }
        require_once "../../bulk_ops/inwardstock/inwardstock-add.php";
        break;
    
    case "inwardstock-edit":
        $inwardstock_id = $_GET["id"];
        $inwardstock = new Inwardstock();
        if (isset($_POST['add'])){
            $received_date = $_POST['received_date']; 
            $invoice_no = $_POST['invoice_no'];
            $invoice_date = $_POST['invoice_date'];     
            $miller_name = $_POST['miller_name'];
            $gst_no = $_POST['gst_no'];
            $place = $_POST['place'];  
            $mode_transport = $_POST['mode_transport'];
            $godown_name= $_POST['godown_name'];
            $compartment_name = $_POST['compartment_name'];
            $cargo_details = $_POST['cargo_details '];
            $vehicle_no = $_POST['vehicle_no'];
            $bag_mark = $_POST['bag_mark'];
            $bag_wtg = $_POST['bag_wtg'];
            $bags_rec = $_POST['bags_rec'];
            $wbridge_wtg = $_POST['wbridge_wtg'];
            $net_wtg = $_POST['net_wtg'];
            $remarks = $_POST['remarks'];
        $inwardstock->editInwardstock($received_date, $invoice_no, $invoice_date,$miller_name,  $gst_no, $place, $mode_transport, $godown_name, $compartment_name, $cargo_details,$vehicle_no,$bag_mark ,$bag_wtg,$bags_rec, $wbridge_wtg,$net_wtg,$remarks,$inwardstock_id); 
        header("Location: ../../bulk_ops/inwardstock/cInwardstock.php");
        }
        $result = $inwardstock->getInwardstockById($inwardstock_id);
        require_once "../../bulk_ops/inwardstock/inwardstock-edit.php";
        break;
    
    case "inwardstock-delete":
        $inwardstock_id = $_GET["id"];
        $inwardstock = new Inwardstock();
        $inwardstock->deleteInwardstock($inwardstock_id);
        $result = $inwardstock->getAllInwardstock();
        require_once "../../bulk_ops/inwardstock/vInwardstock.php";
        break;
    
    default:
        $inwardstock = new Inwardstock();
        $result = $inwardstock->getAllInwardstock();
        require_once "../../bulk_ops/inwardstock/vInwardstock.php";
        break;
       
}
?>