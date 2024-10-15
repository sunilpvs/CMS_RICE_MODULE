<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
require_once($_SERVER['DOCUMENT_ROOT'] ."/class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/configurations/costcenter/Costcenter.php");

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
            $cc_code = $_POST['cc_code'];
            $cc_type = $_POST['cc_type'];     
            $entity_id = $_POST['entity_id'];
            $incorp_date = $_POST['incorp_date'];
            $gst_no = $_POST['gst_no'];   
            $add1 = $_POST['add1'];
            $add2 = $_POST['add2'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $pin = $_POST['pin'];
            $country = $_POST['country'];
            $primary_contact = $_POST['primary_contact'];
            $status = $_POST['status'];
            $createdBy = $_SESSION['id'];

            $cc = new Costcenter();
            $insertId = $cc->addCostcenter($cc_code, $cc_type, $entity_id, $incorp_date, $gst_no, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status, $createdBy);
            if(empty($insertId)) 
            {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else
            {
                header("Location:../../congigurations/costcenter/cCostcenter.php");
            }
        }
        require_once "../../congigurations/costcenter/costcenter-add.php";
        break;
    
    case "costcenter-edit":
        $costcenter_id = $_GET["id"];
        $costcenter = new Costcenter();
        if (isset($_POST['add']))
        {
            $cc_code = $_POST['cc_code'];
            $cc_type = $_POST['cc_type'];     
            $entity_id = $_POST['entity_id'];
            $incorp_date = $_POST['incorp_date'];
            $gst_no = $_POST['gst_no'];   
            $add1 = $_POST['add1'];
            $add2 = $_POST['add2'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $pin = $_POST['pin'];
            $country = $_POST['country'];
            $primary_contact = $_POST['primary_contact'];
            $status = $_POST['status'];

            $cc = new Costcenter();
            $insertId = $cc->editCostcenter($cc_code, $cc_type, $entity_id, $incorp_date, $gst_no, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status);
            header("Location: ../../congigurations/costcenter/cCostcenter.php");
        }
        $result = $costcenter->getCostcenterById($costcenter_id);
        require_once "../../congigurations/costcenter/costcenter-edit.php";
        break;
    
    case "costcenter-delete":
        $cc_code = $_GET["cc_code"];
        $cc = new Costcenter();
        $cc->deleteCostcenter($cc_code);
        $result = $cc->getAllCostcenter();
        require_once "../../congigurations/costcenter/vCostcenter.php";
        break;
    
    default:
        $costcenter = new Costcenter();
        $result = $costcenter->getAllCostcenter();
        require_once "../../congigurations/costcenter/vCostcenter.php";
        break;
}
?>