<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
require_once($_SERVER['DOCUMENT_ROOT'] ."/class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/bulk_ops/outwardstock/outwardstock.php");
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
            $outward_date = $_POST['outward_date']; 
            $dc_no = $_POST['dc_no'];
            $dc_date = $_POST['dc_date'];     
            $godown_name= $_POST['godown_name'];
            $compartment_name = $_POST['compartment_name'];
            $vehicle_no = $_POST['vehicle_no'];
            $cargo_details = $_POST['cargo_details'];
            $bag_mark = $_POST['bag_mark'];
            $bag_wtg = $_POST['bag_wtg'];
            $bags_out = $_POST['bags_out'];
            $wbridge_wtg = $_POST['wbridge_wtg'];
            $net_wtg = $_POST['net_wtg'];
            $delivery_dtl = $_POST['delivery_dtl'];
            $remarks = $_POST['remarks'];
            $id = $_SESSION['id'];

            $outwardstock = new Outwardstock();
            $insertId = $outwardstock->addOutwardstock($outward_date, $dc_no, $dc_date, $godown_name, $compartment_name, $vehicle_no,$cargo_details,$bag_mark ,$bag_wtg,$bags_out, $wbridge_wtg,$net_wtg,$delivery_dtl,$remarks,$id);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../bulk_ops/outwardstock/cOutwardstock.php");
            }
        }
        require_once "../../bulk_ops/outwardstock/outwardstock-add.php";
        break;
    
    case "outwardstock-edit":
        $outwardstock_id = $_GET["id"];
        $outwardstock = new Outwardstock();
        if (isset($_POST['add'])){
            $outward_date = $_POST['outward_date']; 
            $dc_no = $_POST['dc_no'];
            $dc_date = $_POST['dc_date'];     
            $godown_name= $_POST['godown_name'];
            $compartment_name = $_POST['compartment_name'];
            $vehicle_no = $_POST['vehicle_no'];
            $cargo_details = $_POST['cargo_details'];
            $bag_mark = $_POST['bag_mark'];
            $bag_wtg = $_POST['bag_wtg'];
            $bags_out = $_POST['bags_out'];
            $wbridge_wtg = $_POST['wbridge_wtg'];
            $net_wtg = $_POST['net_wtg'];
            $delivery_dtl = $_POST['delivery_dtl'];
            $remarks = $_POST['remarks'];
            
        $outwardstock->editOutwardstock($outward_date, $dc_no, $dc_date, $godown_name, $compartment_name, $vehicle_no,$cargo_details,$bag_mark ,$bag_wtg,$bags_out, $wbridge_wtg,$net_wtg,$delivery_dtl,$remarks,$outwardstock_id); 
        header("Location: ../../bulk_ops/outwardstock/cOutwardstock.php");
        }
        $result = $outwardstock->getOutwardstockById($outwardstock_id);
        require_once "../../bulk_ops/outwardstock/outwardstock-edit.php";
        break;
    
    case "outwardstock-delete":
        $outwardstock_id = $_GET["id"];
        $outwardstock = new Outwardstock();
        $outwardstock->deleteOutwardstock($outwardstock_id);
        $result = $outwardstock->getAllOutwardstock();
        require_once "../../bulk_ops/outwardstock/vOutwardstock.php";
        break;
    
    default:
        $outwardstock = new Outwardstock();
        $result = $outwardstock->getAllOutwardstock();
        require_once "../../bulk_ops/outwardstock/vOutwardstock.php";
        break;
       
}
?>