<?php
    session_start();
   require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
    require_once($_SERVER['DOCUMENT_ROOT'] ."/lease_management/warehouse/Warehouse.php");
    
    
    // $action = "";
    if (! empty($_GET["action"])) {
        $action = $_GET["action"];
    }
    else
    {
    $action = "default";}
    switch ($action) {    
        case "warehouse-add":
            if (isset($_POST['add'])) {
                $warehouse_name = $_POST['warehouse_name'];
                $code = $_POST['code'];
                $lessor_id = $_POST['lessor_id'];
                $add1 = $_POST['add1'];
                $add2 = $_POST['add2'];
                $city = $_POST['city'];
                $state = $_POST['state'];
                $pin = $_POST['pin'];
                $country = $_POST['country'];
                $capacity_sqft = $_POST['capacity_sqft'];
                $capacity_mton = $_POST['capacity_mton'];
                $primary_contact = $_POST['primary_contact'];
                $status = $_POST['status'];
                $created_by = $_SESSION['id'];
                $wh = new Warehouse();
                $insertId = $wh->addWarehouse($warehouse_name, $code, $lessor_id, $add1, $add2, $city, $state, $pin, $country, $capacity_sqft, $capacity_mton, $primary_contact, $status, $created_by);
                if (empty($insertId)) {
                    $response = array(
                        "message" => "Problem in Adding New Record",
                        "type" => "error"
                    );
                } 
                else 
                {
                    header("Location:../../lease_management/warehouse/cWarehouse.php");
                }
            }
            require_once "../../lease_management/warehouse/warehouse-add.php";
            break;
        
        case "warehouse-edit":
            $warehouse_id = $_GET["id"];
            $wh = new Warehouse();
            if (isset($_POST['add'])){
                $warehouse_name = $_POST['warehouse_name'];
                $code = $_POST['code'];
                $lessor_id = $_POST['lessor_id'];
                $add1 = $_POST['add1'];
                $add2 = $_POST['add2'];
                $city = $_POST['city'];
                $state = $_POST['state'];
                $pin = $_POST['pin'];
                $country = $_POST['country'];
                $capacity_sqft = $_POST['capacity_sqft'];
                $capacity_mton = $_POST['capacity_mton'];
                $primary_contact = $_POST['primary_contact'];
                $status = $_POST['status'];            
            
                $wh->editWarehouse($warehouse_name, $code, $lessor_id, $add1, $add2, $city, $state, $pin, $country, $capacity_sqft, $capacity_mton, $primary_contact, $status, $warehouse_id);
                header("Location: ../../lease_management/warehouse/cWarehouse.php");
            }
            $result = $wh->getWarehousById($warehouse_id);
            require_once "../../lease_management/warehouse/warehouse-edit.php";
            break;
        
        case "warehouse-delete":
            $warehouse_id = $_GET["id"];
            $wh = new Warehouse();
            $wh->deleteWarehouse($warehouse_id);
            $result = $wh->getAllWarehouse();
            require_once "../../lease_management/warehouse/vWarehouse.php";
            break;
        
        default:
            $wh = new Warehouse();
            $result = $wh->getAllWarehouse();
            require_once "../../lease_management/warehouse/vWarehouse.php";
            break;
    }
?>