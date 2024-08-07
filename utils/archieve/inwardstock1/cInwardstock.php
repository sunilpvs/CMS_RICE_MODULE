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

            $inwardstock = new Inwardstock();
            $insertId = $inwardstock->addInwardstock($Lease_obj, $Contract_id, $Customer_id,$Commenced_Date, $Complete_Date, $Capacity_Mton, $RateDay, $Commodity_Type, $Contact_Days, $Total_Cost, $id);
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
        $inwardstock->editInwardstock($Lease_obj, $Contract_id, $Customer_id,$Commenced_Date, $Complete_Date, $Capacity_Mton, $RateDay, $Commodity_Type, $Contact_Days, $Total_Cost,  $inwardstock_id); 
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