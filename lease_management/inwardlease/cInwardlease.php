<?php
    session_start();
    date_default_timezone_set('Asia/Kolkata');
   require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
    require_once($_SERVER['DOCUMENT_ROOT'] ."/lease_management/inwardlease/Inwardlease.php");

    if (!empty($_GET["action"])) {
        $action = $_GET["action"];
    }
    else
    {
    $action = "default";}
    switch ($action) 
    {    
        case "inwardlease-add":
            if (isset($_POST['add'])) {            
                $warehouse_id = $_POST['warehouse_id'];
                $lease_type = $_POST['lease_type'];
                $start_date = $_POST['start_date'];  
                $expiry_date = $_POST['expiry_date'];
                $status = $_POST['status'];
                $created_by = $_SESSION['id'];
                $in = new Inwardlease();
                $insertId = $in->addInwardlease($warehouse_id, $lease_type, $start_date, $expiry_date, $status, $created_by);
                if (empty($insertId)) {
                    $response = array(
                        "message" => "Problem in Adding New Record",
                        "type" => "error"
                    );
                } 
                else 
                {
                    header("Location:../../lease_management/inwardlease/cInwardlease.php");
                }
            }
            require_once "../../lease_management/inwardlease/inwardlease-add.php";
            break;
        
        case "inwardlease-edit":
            $inwardlease_id = $_GET["id"];
            $in = new Inwardlease();
            if (isset($_POST['add'])){    
                $warehouse_id = $_POST['warehouse_id'];
                $lease_type = $_POST['lease_type'];
                $start_date = $_POST['start_date'];  
                $expiry_date = $_POST['expiry_date'];
                $status = $_POST['status'];
                $in->editInwardlease($warehouse_id, $lease_type, $start_date, $expiry_date, $status, $inwardlease_id);
                header("Location: ../../lease_management/inwardlease/cInwardlease.php");
            }
            $result = $in->getinwardleaseById($inwardlease_id);
            require_once "../../lease_management/inwardlease/inwardlease-edit.php";
            break;
        
        case "inwardlease-delete":
            $inwardlease_id = $_GET["id"];
            $inwardlease = new Inwardlease();
            $inwardlease->deleteInwardlease($inwardlease_id);
            $result = $inwardlease->getAllInwardlease();
            require_once "../../lease_management/inwardlease/vInwardlease.php";
            break;
        
        default:
            $inwardlease = new Inwardlease();
            $result = $inwardlease->getAllInwardlease();
            require_once "../../lease_management/inwardlease/vInwardlease.php";
            break;
        
    }
    ?>