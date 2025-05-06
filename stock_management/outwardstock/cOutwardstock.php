<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/stock_management/outwardstock/Outwardstock.php");

$db_handle = new DBController();
// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{

 $action = "default";
}

switch ($action) 
{    
    case "outwardstock-add":

        if (isset($_POST['add'])) {
            $customer_id = trim($_POST['customer']);
            $warehouse_id = trim($_POST['warehouse']);
            $compartment_id =trim($_POST['compartment']);
            $commodity_id = trim($_POST['commodity_id']);
            $mod_transport = trim(trim($_POST['transport']));
            $bags_stock = trim($_POST['bags_out']);
            $trans_date = $_POST['outward_date']; 
            $dc_no = trim($_POST['dc_no']);
            $dc_date = $_POST['dc_date'];     
            $vehicle_no = trim(trim($_POST['vehicle_no']));
            $delivery_to = trim($_POST['delivery_dtl']);            
            $wb_gross_wt= trim($_POST['outward_wb_gross_wt']); 
            $gross_wt = trim($_POST['outward_gross_wt']);
            $gross_diff= trim($_POST['outward_diff_gross']); 
            $wb_net_wt= trim(trim($_POST['outward_wb_net_wt'])); 
            $net_wt= trim($_POST['outward_net_wt']);
            $net_diff= trim($_POST['outward_diff_net']);
            $remarks = trim($_POST['remarks']);
            $entity_id = $_SESSION['entity_id'];
            $created_by = $_SESSION['id'];

            $outwardstock = new Outwardstock();
            $insertId = $outwardstock->addOutwardstock($customer_id, $warehouse_id, $compartment_id, $commodity_id, $mod_transport, $bags_stock, $trans_date, $dc_no, $dc_date, 
            $vehicle_no, $delivery_to, $wb_gross_wt, $gross_wt, $gross_diff, $wb_net_wt, $net_wt, $net_diff, $remarks, $entity_id, $created_by);    
            if (empty($insertId) || $insertId == -1) 
            {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../stock_management/outwardstock/cOutwardstock.php");
            }
        }
        require_once ($_SERVER['DOCUMENT_ROOT'] ."/stock_management/outwardstock/outwardstock-add.php");
        break;
    
    case "outwardstock-edit":
        
        $outwardstock_id = $_GET["id"];
        $outwardstock = new Outwardstock();

        if (isset($_POST['add']))
        {
            $customer_id = trim($_POST['customer']);
            $warehouse_id = trim($_POST['warehouse']);
            $compartment_id =trim($_POST['compartment']);
            $commodity_id = trim($_POST['commodity_id']);
            $mod_transport = trim(trim($_POST['mod_transport']));
            $bags_stock = trim($_POST['bags_out']);
            $trans_date = $_POST['outward_date']; 
            $dc_no = trim($_POST['dc_no']);
            $dc_date = $_POST['dc_date'];     
            $vehicle_no = trim(trim($_POST['vehicle_no']));
            $delivery_to = trim($_POST['delivery_dtl']);            

            $wb_gross_wt= trim($_POST['outward_wb_gross_wt']); 
            $gross_wt = trim($_POST['outward_gross_wt']);            
            $gross_diff= trim($_POST['outward_diff_gross']); 
            $wb_net_wt= trim($_POST['outward_wb_net_wt']); 
            $net_wt= trim($_POST['outward_net_wt']);
            $net_diff= trim($_POST['outward_diff_net']);
            $remarks = trim($_POST['remarks']);
            $entity_id = $_SESSION["entity_id"];
            
            $editId = $outwardstock->editOutwardstock($customer_id, $warehouse_id, $compartment_id, $commodity_id, $mod_transport, $bags_stock, $trans_date, $dc_no, $dc_date, 
                                        $vehicle_no, $delivery_to, $wb_gross_wt, $gross_wt, $gross_diff, $wb_net_wt, $net_wt, $net_diff, $remarks, $entity_id, 
                                        $outwardstock_id);
            header("Location: ../../stock_management/outwardstock/cOutwardstock.php");
        }
        $result = $outwardstock->getOutwardstockById($outwardstock_id);
        require_once "../../stock_management/outwardstock/outwardstock-edit.php";
        break;
    
    case "outwardstock-delete":
        $outwardstock_id = $_GET["id"];
        $outwardstock = new Outwardstock();
        $outwardstock->deleteOutwardstock($outwardstock_id);
        $result = $outwardstock->getAllOutwardstock();
        require_once "../../stock_management/outwardstock/vOutwardstock.php";
        break;

    case "outward-filter":
                //$date_pic = $_POST['date_picker'];
                //$newDate = date("d-M-Y", strtotime($date_pic));
                $customer_id = $_POST['customer'];
                $warehouse_id = $_POST['warehouse'];
                $compartment_id = $_POST['compartment'];
                $transport_id = $_POST['transport'];
                $outwardstock = new Outwardstock();
                $vw_result = $outwardstock->getAllOutwardstock($customer_id,$warehouse_id,$compartment_id,$transport_id);
                require_once "../../stock_management/outwardstock/vOutwardstock.php";
                break;    
    
    default:
        //$outwardstock = new Outwardstock();
        //$dt =  date("d-m-Y");
        //$result = $outwardstock->getAllOutwardstock($dt);
        require_once "../../stock_management/outwardstock/vOutwardstock.php";
        break;
       
}
?>