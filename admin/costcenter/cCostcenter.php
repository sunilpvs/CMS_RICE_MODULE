<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
 require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/costcenter/Costcenter.php");

// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";}
switch ($action) {    
    case "costcenter-add":
        if (isset($_POST['add'])) {
            $cc_code = trim($_POST['cc_code']);
            $cc_type = trim($_POST['cc_type']);     
            $entity_id = trim($_POST['entity_id']);
            $incorp_date = trim($_POST['incorp_date']);
            $gst_no = trim($_POST['gst_no']);   
            $add1 = trim($_POST['add1']);
            $add2 = trim($_POST['add2']);
            $city = trim($_POST['city']);
            $state = trim($_POST['state']);
            $country = trim($_POST['country']);
            $pin = trim($_POST['pin']);
            $primary_contact = trim($_POST['primary_contact']);
            $status = trim($_POST['status']);
            $id = $_SESSION['id'];

            $cc = new Costcenter();
            $insertId = $cc->addCostcenter($cc_code, $cc_type, $entity_id, $incorp_date, $gst_no, $add1, $add2, $city, $state, $country, $pin, $primary_contact, $status, $id);
            if(empty($insertId)) 
            {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else
            {
                header("Location:../../admin/costcenter/cCostcenter.php");
            }
        }
        require_once "../../admin/costcenter/costcenter-add.php";
        break;
    
    case "costcenter-edit":
        $costcenter_id = $_GET["id"];
        $costcenter = new Costcenter();
        if (isset($_POST['add']))
        {
            $cc_code = trim($_POST['cc_code']);
            $cc_type = trim($_POST['cc_type']);     
            $entity_id = trim($_POST['entity_id']);
            $incorp_date = trim($_POST['incorp_date']);
            $gst_no = trim($_POST['gst_no']);   
            $add1 = trim($_POST['add1']);
            $add2 = trim($_POST['add2']);
            $city = trim($_POST['city']);
            $state = trim($_POST['state']);
            $pin = trim($_POST['pin']);
            $country = trim($_POST['country']);
            $primary_contact = trim($_POST['primary_contact']);
            $status = trim($_POST['status']);

            $cc = new Costcenter();
            $insertId = $cc->editCostcenter($costcenter_id, $cc_code, $cc_type, $entity_id, $incorp_date, $gst_no, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status);
            header("Location: ../../admin/costcenter/cCostcenter.php");
        }
        $result = $costcenter->getCostcenterById($costcenter_id);
        require_once "../../admin/costcenter/costcenter-edit.php";
        break;
    
    case "costcenter-delete":
        //$cc_code = $_GET["cc_code"];
        //$cc = new Costcenter();
        //$cc->deleteCostcenter($cc_code);
        //$result = $cc->getAllCostcenter();
        require_once "../../admin/costcenter/vCostcenter.php";
        break;
    
    default:
        $costcenter = new Costcenter();
        $result = $costcenter->getAllCostcenter();
        require_once "../../admin/costcenter/vCostcenter.php";
        break;
}
?>