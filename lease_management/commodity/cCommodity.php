<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once ($_SERVER['DOCUMENT_ROOT'] ."/lease_management/commodity/cCommodity.php"); 
require_once ($_SERVER['DOCUMENT_ROOT'] ."/lease_management/commodity/Commodity.php"); 
#require_once "../../class/DBController.php";
#require_once "../../masters/department/Department.php";
$db_handle = new DBController();
// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";}
switch ($action) {    
    case "commodity-add":
        if (isset($_POST['add'])) {
            $commodity_name = $_POST['commodity_name'];
            $cargo_type = $_POST['cargo_type'];
            $brand = $_POST['brand'];
            $marking = $_POST['marking'];
            $empty_bag_wt = $_POST['empty_bag_wt'];
            $inwardmode = $_POST['inwardmode'];
            $bag_wt = $_POST['bag_wt'];
            //$status = $_POST['status'];
            $id = $_SESSION['id'];
            $commodity = new Commodity();
            $insertId = $commodity->addCommodity($commodity_name,$cargo_type,$brand,$marking,$empty_bag_wt,$inwardmode,$bag_wt,$id);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:/lease_management/commodity/cCommodity.php");
            }
        }
    
        require_once ($_SERVER['DOCUMENT_ROOT'] ."/lease_management/commodity/commodity-add.php");
        break;
    
    case "commodity-edit":
        $commodity_id = $_GET["id"];
        $commodity = new Commodity();
        if (isset($_POST['add']))
        {
            $commodity_name = $_POST['commodity_name'];
            $cargo_type = $_POST['cargo_type'];
            $brand = $_POST['brand'];
            $marking = $_POST['marking'];
            $empty_bag_wt = $_POST['empty_bag_wt'];
            $bag_wt = $_POST['bag_wt'];
            $status = $_POST['status'];
            
            $commodity->editCommodity($commodity_name,$cargo_type,$brand,$marking,$empty_bag_wt,$bag_wt,$status,$commodity_id);
            header("Location: /lease_management/commodity/cCommodity.php");
        }
        $result = $commodity->getCommodityById($commodity_id);
        require_once($_SERVER['DOCUMENT_ROOT'] . "/lease_management/commodity/commodity-edit.php");
        break;
    case "commodity-delete":
        $commodity_id = $_GET["id"];
        $commodity = new Commodity();
        $commodity->deleteCommodity($commodity_id);
        $result = $commodity->getAllCommodity();
        require_once ($_SERVER['DOCUMENT_ROOT'] ."/lease_management/commodity/vCommodity.php");
        break;
    
    default:
        $commodity = new Commodity();
        $result = $commodity->getAllCommodity();
        require_once($_SERVER['DOCUMENT_ROOT'] . "/lease_management/commodity/vCommodity.php");
        break;
}
?>