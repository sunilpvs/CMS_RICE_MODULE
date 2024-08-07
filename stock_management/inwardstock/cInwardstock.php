<?php
    session_start();
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
    require_once($_SERVER['DOCUMENT_ROOT'] ."/stock_management/inwardstock/Inwardstock.php");
 
    $db_handle = new DBController();
    // $action = "";
    if (! empty($_GET["action"])) 
    {
        $action = $_GET["action"];
    }
    else
    {
        $action = "default";}
        switch ($action) {    
            case "inwardstock-add":
                if (isset($_POST['add'])) {
                    $customer = $_POST['customer'];
                    $warehouse = $_POST['warehouse'];
                    $compartment_id = $_POST['compartment'];
                    $commodity_id  = $_POST['commodity_id'];
                    $mod_transport = $_POST['mod_transport'];
                    $vehicle_no = $_POST['vehicle_no'];
                    $current_bags_stock = $_POST['current_bags_stock'];
                    $received_date = $_POST['received_date'];
                    $invoice_date = $_POST['invoice_date'];   
                    $invoice_no = $_POST['invoice_no'];
                    $miller_id = $_POST['miller_id'];
                    $inward_bags_stock = $_POST['inward_bags_stock'];
                    $inward_gross_wt = $_POST['inward_gross_wt'];
                    $inward_net_wt = $_POST['inward_net_wt'];
                    $inward_wb_gross_wt = $_POST['inward_wb_gross_wt'];
                    $inward_wb_net_wt = $_POST['inward_wb_net_wt'];
                    $inward_diff_gross = $_POST['inward_diff_gross'];
                    $inward_diff_net = $_POST['inward_diff_net'];
                    $remarks = $_POST['remarks'];
                    $created_by = $_SESSION['id'];



                    $inwardstock = new Inwardstock();
                    //$insertId = $inwardstock->addInwardstock($received_date, $invoice_date, $invoice_no,  $miller_id, $commodity_id, $mod_transport, $compartment_id, $vehicle_no, $inward_bags_stock, $inward_gross_wt, $inward_net_wt, $inward_wb_gross_wt, $inward_wb_net_wt, $inward_diff_gross, $inward_diff_net, $current_bags_stock, $remarks, $created_by);
                    $insertId = $inwardstock->addInwardstock($customer, $warehouse, $compartment_id, $commodity_id, $mod_transport,
                    $vehicle_no, $received_date, $invoice_date, $invoice_no, $miller_id, $inward_bags_stock,
                    $inward_gross_wt, $inward_net_wt, $inward_wb_gross_wt, $inward_wb_net_wt, $inward_diff_gross,  
                    $inward_diff_net, $current_bags_stock, $remarks, $created_by);                    
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
                if (isset($_POST['add'])){
                    $received_date = $_POST['received_date'];
                    $invoice_date = $_POST['invoice_date'];  
                    $invoice_no = $_POST['invoice_no'];
                    $miller_id = $_POST['miller_id'];
                    $commodity_id = $_POST['commodity_id'];
                    $mod_transport= $_POST['mod_transport'];
                    $warehouse_id = $_POST['warehouse_id'];
                    $vehicle_no = $_POST['vehicle_no'];
                    $inward_bags_stock = $_POST['inward_bags_stock'];
                    $inward_gross_wt = $_POST['inward_gross_wt'];
                    $inward_net_wt = $_POST['inward_net_wt'];
                    $inward_wb_gross_wt = $_POST['inward_wb_gross_wt'];
                    $inward_wb_net_wt = $_POST['inward_wb_net_wt'];
                    $inward_diff_gross = $_POST['inward_diff_gross'];
                    $inward_diff_net = $_POST['inward_diff_net'];
                    $current_bags_stock = $_POST['current_bags_stock'];
                    $remarks = $_POST['remarks'];
                $inwardstock->editInwardstock($received_date, $invoice_no, $invoice_date, $miller_id,  $commodity_id, $mod_transport, $comp_id, $vehicle_no, $inward_bags_stock, $inward_net_wt, $inward_wb_gross_wt, $inward_wb_net_wt, $inward_diff_gross, $inward_diff_net, $current_bags_stock, $remarks, $inwardstock_id); 
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
                $dt =  date("d-m-Y");
                $result = $inwardstock->getAllInwardstock($dt);
                require_once "../../stock_management/inwardstock/vInwardstock.php";
                break;
            
}
?>