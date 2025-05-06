<?php
    session_start();
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
    require_once($_SERVER['DOCUMENT_ROOT'] ."/stock_management/inwardstock/Inwardstock.php");
 
    $db_handle = new DBController();
    // $action = "";
    if (!empty($_GET["action"])) 
    {
        $action = $_GET["action"];
    }
    else
    {
        $action = "default";
    }
        switch ($action) {    
            case "inwardstock-add":
                if (isset($_POST['add'])) {
                    $customer_id = trim($_POST['customer']);
                    $warehouse_id = trim($_POST['warehouse']);
                    $compartment_id = trim($_POST['compartment']);
                    $commodity_id  = trim($_POST['commodity_id']);
                    $mod_transport = trim($_POST['mod_transport']);
                    $trans_date = $_POST['received_date'];

                    $invoice_no = trim($_POST['invoice_no']);
                    $invoice_date = $_POST['invoice_date'];   
                    $miller_id = trim($_POST['miller_id']);
                    $vehicle_no = trim($_POST['vehicle_no']);

                    $bags_stock = trim($_POST['inward_bags_stock']);
                    $wb_gross_wt = trim(trim($_POST['inward_wb_gross_wt']));
                    $gross_wt = trim(trim($_POST['inward_gross_wt']));
                    $gross_diff = trim($_POST['inward_diff_gross']);
                    $wb_net_wt = trim($_POST['inward_wb_net_wt']);
                    $net_wt = trim($_POST['inward_net_wt']);
                    $net_diff = trim($_POST['inward_diff_net']);

                    $remarks = trim($_POST['remarks']);
                    $entity_id = $_SESSION['entity_id'];
                    $created_by = $_SESSION['id'];

                    $inwardstock = new Inwardstock();
                    $insertId = $inwardstock->addInwardstock($customer_id, $warehouse_id, $compartment_id, $commodity_id, $mod_transport, $trans_date, 
                                                    $invoice_no, $invoice_date, $miller_id, $vehicle_no, $bags_stock, $wb_gross_wt, $gross_wt, $gross_diff,
                                                    $wb_net_wt, $net_wt, $net_diff, $remarks, $entity_id, $created_by);
                    if (empty($insertId)) {
                        $response = array(
                            "message" => "Problem in Adding New Record",
                            "type" => "error"
                        );
                    } 
                    else 
                    {
                        header("Location:../../stock_management/inwardstock/cInwardstock.php");
                    }
                }
                require_once "../../stock_management/inwardstock/inwardstock-add.php";
                break;
            
            case "inwardstock-edit":
                $inwardstock_id = $_GET["id"];
                $inwardstock = new Inwardstock();
                if (isset($_POST['add']))
                {
                    $customer_id = trim($_POST['customer']);
                    $warehouse_id = trim($_POST['warehouse']);
                    $compartment_id = trim($_POST['compartment']);
                    $commodity_id  = trim($_POST['commodity_id']);
                    $mod_transport = trim($_POST['mod_transport']);
                    $bags_stock = trim($_POST['inward_bags_stock']);
                    $trans_date = $_POST['received_date'];
                    $invoice_no = trim($_POST['invoice_no']);
                    $invoice_date = $_POST['invoice_date'];   
                    $vehicle_no = trim($_POST['vehicle_no']);
                    $miller_id = trim($_POST['miller_id']);
                    $wb_gross_wt = trim(trim($_POST['inward_wb_gross_wt']));
                    $gross_wt = trim(trim($_POST['inward_gross_wt']));
                    $gross_diff = trim($_POST['inward_diff_gross']);
                    $wb_net_wt = trim($_POST['inward_wb_net_wt']);
                    $net_wt = trim($_POST['inward_net_wt']);
                    $net_diff = trim($_POST['inward_diff_net']);                    
                    $remarks = trim($_POST['remarks']);

                    $inwardstock->editInwardstock($customer_id, $warehouse_id, $compartment_id, $commodity_id, $mod_transport, $bags_stock, 
                                    $trans_date, $invoice_no, $invoice_date, $vehicle_no, $miller_id, $wb_gross_wt, $gross_wt, $gross_diff,
                                    $wb_net_wt, $net_wt, $net_diff, $remarks, $inwardstock_id);
                    header("Location: ../../stock_management/inwardstock/cInwardstock.php");
                }
                $result = $inwardstock->getInwardstockById($inwardstock_id);
                require_once "../../stock_management/inwardstock/inwardstock-edit.php";
                break;
            
            case "inwardstock-delete":
                $inwardstock_id = $_GET["id"];
                $inwardstock = new Inwardstock();
                $inwardstock->deleteInwardstock($inwardstock_id);
                $result = $inwardstock->getAllInwardstock();
                require_once "../../stock_management/inwardstock/vInwardstock.php";
                break;

            case "inward-filter":
                $date_pic = $_POST['date_picker'];
                $newDate = date("d-M-Y", strtotime($date_pic));
        
                $inwardstock = new Inwardstock();
                $result = $inwardstock->getAllInwardstock($newDate);
                require_once "../../stock_management/inwardstock/vInwardstock.php";
                break;

                
            default:
                $inwardstock = new Inwardstock();
                $dt =  date("d-M-Y");
                $result = $inwardstock->getAllInwardstock($dt);
                require_once "../../stock_management/inwardstock/vInwardstock.php";
                break;
            
}
?>