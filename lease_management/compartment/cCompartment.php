<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/lease_management/compartment/Compartment.php");

$db_handle = new DBController();
// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";}
switch ($action) {    
    
    case "compartment-add":
        if (isset($_POST['add'])) {	
            $str= $_POST['warehouse_id'];
            list($outwardlease_id,$warehouse_id) = explode(',', $str);
            //$warehouse_id= $_POST['warehouse_id'];
            //$outwardlease_id= $_POST['data-id'];
            $compartment_name= $_POST['compartment_name'];
            $capacity_sqft = $_POST['capacity_sqft'];
            $capacity_mton = $_POST['capacity_mton'];
            $id = $_SESSION['id'];
            $compartment = new Compartment();
            $insertId = $compartment->addCompartment($outwardlease_id, $compartment_name,$warehouse_id, $capacity_sqft, $capacity_mton,$id);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../lease_management/compartment/cCompartment.php");
            }
        }
        require_once "../../lease_management/compartment/compartment-add.php";
        break;
    
    case "compartment-edit":
        $compartments_id = $_GET["id"];
        $compartment = new Compartment();
        if (isset($_POST['add'])){
            $compartment_id= $_POST['compartment_id'];
            $warehouse_id= $_POST['warehouse_id'];				
            $capacity_sqft = $_POST['capacity_sqft'];
            $capacity_mton = $_POST['capacity_mton'];
            $status = $_POST['status'];

            $compartment->editCompartment($compartment_id,$warehouse_id,  $capacity_sqft,  $capacity_mton,$status,$compartments_id);
            header("Location: ../../lease_management/compartment/cCompartment.php");
        }
        $result = $compartment->getCompartmentById($compartments_id);
        require_once "../../lease_management/compartment/compartment-edit.php";
        break;
    
    case "compartment-delete":
        $compartments_id = $_GET["id"];
        $compartment = new Compartment();
        $compartment->deleteCompartment($compartments_id);
        $result = $compartment->getAllCompartment();
        require_once "../../lease_management/compartment/vCompartment.php";
        break;
    
    default:
        $compartment = new Compartment();
        $result = $compartment->getAllCompartment();
        require_once "../../lease_management/compartment/vCompartment.php";
        break;
}
?>