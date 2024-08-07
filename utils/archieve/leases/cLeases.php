<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
require_once($_SERVER['DOCUMENT_ROOT'] ."/class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/rice_module/leases/Leases.php");
$db_handle = new DBController();
// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";}
switch ($action) {    
    case "leases-add":
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

            $leases = new Leases();
            $insertId = $leases->addLeases($Lease_obj, $Contract_id, $Customer_id,$Commenced_Date, $Complete_Date, $Capacity_Mton, $RateDay, $Commodity_Type, $Contact_Days, $Total_Cost, $id);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../rice_module/leases/cLeases.php");
            }
        }
        require_once "../../rice_module/leases/leases-add.php";
        break;
    
    case "leases-edit":
        $leases_id = $_GET["id"];
        $leases = new Leases();
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
        $leases->editLeases($Lease_obj, $Contract_id, $Customer_id,$Commenced_Date, $Complete_Date, $Capacity_Mton, $RateDay, $Commodity_Type, $Contact_Days, $Total_Cost,  $leases_id); 
        header("Location: ../../rice_module/leases/cLeases.php");
        }
        $result = $leases->getLeasesById($leases_id);
        require_once "../../rice_module/leases/leases-edit.php";
        break;
    
    case "leases-delete":
        $leases_id = $_GET["id"];
        $leases = new Leases();
        $leases->deleteLeases($leases_id);
        $result = $leases->getAllLeases();
        require_once "../../rice_module/leases/vLeases.php";
        break;
    
    default:
        $leases = new Leases();
        $result = $leases->getAllLeases();
        require_once "../../rice_module/leases/vLeases.php";
        break;
       
}
?>