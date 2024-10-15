<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/lease_management/outwardlease/Outwardlease.php");
$db_handle = new DBController();
// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";}
switch ($action) {    
    case "outwardlease-add":
        if (isset($_POST['add'])) {
            $warehouse_id = $_POST['warehouse_id'];
            $customer_id = $_POST['customer_id']; 
            //$lease_contract_id = $_POST['lease_contract_id']; 
            $lease_model = $_POST['lease_model']; 
            if($lease_model==2){
                $lease_capacity_mton = $_POST['lease_capacity_mton'];
                $daily_rate_mton = $_POST['daily_rate_mton']; 
                 $cost_mton = $_POST['cost_mton'];
                 $lease_capacity_sqft=0;
                 $daily_rate_sqft=0;
                 $cost_sqft = 0;
                 
            }
            else if($lease_model==1){
                 $lease_capacity_sqft = $_POST['lease_capacity_sqft'];
                 $daily_rate_sqft = $_POST['daily_rate_sqft']; 
                 $cost_sqft = $_POST['cost_sqft']; 
                 $lease_capacity_mton = 0;
                 $daily_rate_mton = 0;
                 $cost_mton = 0;
            }
            //$compartment_code = $_POST['compartment_code'];
            $lease_start = $_POST['lease_start']; 
            $lease_end = $_POST['lease_end']; 
            $lease_status =  $_POST['lease_status']; 
            $lease_days = $_POST['lease_days']; 
            $total_cost =  $_POST['total_cost'];
            $user_id = $_SESSION['id'];

            $outwardlease = new Outwardlease();
            $insertId = $outwardlease->addOutwardlease($warehouse_id, $customer_id, $lease_model, $lease_start, $lease_end, 
            $lease_capacity_sqft, $lease_capacity_mton, $daily_rate_sqft, $daily_rate_mton, $lease_status,$lease_days,$cost_sqft, $cost_mton,$total_cost, $user_id);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../lease_management/outwardlease/cOutwardlease.php");
            }
        }
        require_once "../../lease_management/outwardlease/outwardlease-add.php";
        break;
    
    case "outwardlease-edit":
        $outwardlease_id = $_GET["id"];
        $outwardlease = new Outwardlease();
        if (isset($_POST['add'])){
            $warehouse_id = $_POST['warehouse_id'];
            $customer_id = $_POST['customer_id']; 
            $lease_contract_id = $_POST['lease_contract_id']; 
            $lease_model = $_POST['lease_model']; 
            //$compartment_code = $_POST['compartment_code']; 
            $lease_start = $_POST['lease_start']; 
            $lease_end = $_POST['lease_end']; 
            $lease_capacity_sqft = $_POST['lease_capacity_sqft']; 
            $lease_capacity_mton = $_POST['lease_capacity_mton']; 
            $daily_rate_sqft = $_POST['daily_rate_sqft']; 
            $daily_rate_mton = $_POST['daily_rate_mton']; 
            $lease_status =  $_POST['lease_status']; 
            $lease_days = $_POST['lease_days']; 
            $cost_sqft = $_POST['cost_sqft']; 
            $cost_mton = $_POST['cost_mton']; 
            $total_cost =  $_POST['total_cost']; 
            
        $outwardlease->editOutwardlease($warehouse_id, $customer_id, $lease_contract_id, $lease_model, $lease_start, $lease_end, 
        $lease_capacity_sqft, $lease_capacity_mton, $daily_rate_sqft, $daily_rate_mton, $lease_status,$lease_days,$cost_sqft,  $cost_mton,$total_cost, $leases_id); 
        header("Location: ../../lease_management/outwardlease/cOutwardlease.php");
        }
        $result = $outwardlease->getOutwardleaseById($outwardlease_id);
        require_once "../../lease_management/outwardlease/outwardlease-edit.php";
        break;
    
    case "outwardlease-delete":
        $outwardlease_id = $_GET["id"];
        $outwardlease = new Outwardlease();
        $outwardlease->deleteOutwardlease($leases_id);
        $result = $outwardlease->getAllOutwardlease();
        require_once "../../lease_management/loutwardlease/vOutwardlease.php";
        break;
    
    default:
        $outwardlease = new Outwardlease();
        $result = $outwardlease->getAllOutwardlease();
        require_once "../../lease_management/outwardlease/vOutwardlease.php";
        break;
       
}
?>