<?php
session_start();

 require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/configurations/vendor/Vendor.php");
#require_once "../../class/DBController.php";
#require_once "../../configurations/department/Department.php";
$db_handle = new DBController();
// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";}
switch ($action) {    
    case "vendor-add":
        if (isset($_POST['add'])) {
            $vendor_name = $_POST['vendor_name'];
            $add1 = trim($_POST['add1']);
            $add2 = trim($_POST['add2']);
            $city = trim($_POST['city']);
            $state = trim($_POST['state']);
            $pin = trim(trim($_POST['pin']);
            $country = trim($_POST['country']);
            $primary_contact = trim($_POST['primary_contact']);
            $status =trim( $_POST['status']);
            $entity_id = $_SESSION['entity_id'];
            $created_by = $_SESSION['id'];

            $ven = new Vendor(); 
            $insertId = $ven->addVendor($vendor_name, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status, $entity_id, $created_by);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../configurations/vendor/cVendor.php");
            }
        }
        require_once "../../configurations/vendor/vendor-add.php";
        break;
    
    case "vendor-edit":
        $vendor_id = $_GET["id"];
        $ven = new Vendor();
        if (isset($_POST['add'])){
            $vendor_name = trim($_POST['vendor_name']);
            $add1 = trim($_POST['add1']);
            $add2 = trim($_POST['add2']);
            $city = trim($_POST['city']);
            $state = trim($_POST['state']);
            $pin = trim($_POST['pin']);
            $country = trim($_POST['country']);
            $primary_contact =trim($_POST['primary_contact']);
            $status = trim($_POST['status']);         

            $ven->editVendor($vendor_name, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status, $vendor_id);
            header("Location: ../../configurations/vendor/cVendor.php");
        }
        $result = $ven->getVendorById($vendor_id);
        require_once "../../configurations/vendor/vendor-edit.php";
        break;
    
    case "vendor-delete":
        $vendor_id = $_GET["id"];
        $vendor = new Vendor();
        $vendor->deleteVendor($vendor_id);
        $result = $vendor->getAllVendor();
        require_once "../../configurations/vendor/vVendor.php";
        break;
    
    default:
        $vendor = new Vendor();
        $result = $vendor->getAllVendor();
        require_once "../../configurations/vendor/vVendor.php";
        break;
}
?>