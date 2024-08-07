<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
require_once($_SERVER['DOCUMENT_ROOT'] ."/class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/bulk_ops/outwardstock/Outwardstock.php");
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
            $Lease_obj = $_POST['Lease_obj'];
            $Contract_id = $_POST['Contract_id'];     
            $Customer_id = $_POST['Customer_id'];
            $Commenced_Date = $_POST['Commenced_Date'];
            $Complete_Date = $_POST['Complete_Date'];  
            $Capacity_Mton = $_POST['Capacity_Mton'];
            $RateDay= $_POST['RateDay'];
            $Commodity_Type = $_POST['Commodity_Type'];
            $Contact_Days = $_POST['Contact_Days'];
            $Total_Cost = $_POST['Total_Cost'];
            $id = $_SESSION['id'];

            $outwardstock = new Outwardstock();
            $insertId = $outwardstock->addOutwardstock($Lease_obj, $Contract_id, $Customer_id,$Commenced_Date, $Complete_Date, $Capacity_Mton, $RateDay, $Commodity_Type, $Contact_Days, $Total_Cost, $id);
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
            $Lease_obj = $_POST['Lease_obj'];
            $Contract_id = $_POST['Contract_id'];     
            $Customer_id = $_POST['Customer_id'];
            $Commenced_Date = $_POST['Commenced_Date'];
            $Complete_Date = $_POST['Complete_Date'];  
            $Capacity_Mton = $_POST['Capacity_Mton'];
            $RateDay= $_POST['RateDay'];
            $Commodity_Type = $_POST['Commodity_Type'];
            $Contact_Days = $_POST['Contact_Days'];
            $Total_Cost = $_POST['Total_Cost'];
        $outwardstock->editOutwardstock($Lease_obj, $Contract_id, $Customer_id,$Commenced_Date, $Complete_Date, $Capacity_Mton, $RateDay, $Commodity_Type, $Contact_Days, $Total_Cost,  $leases_id); 
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