<?php
    session_start();
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
    require_once($_SERVER['DOCUMENT_ROOT'] ."/lease_management/delivery/Delivery.php");

    // $action = "";
    if (! empty($_GET["action"])) {
        $action = $_GET["action"];
    }
    else
    {
    $action = "default";}
    switch ($action) {    
        case "delivery-add":
            if (isset($_POST['add'])) {
                $delivery_name = trim($_POST['delivery_name']);
                $created_by = $_SESSION['id'];
                $delivery = new Delivery(); 
                $insertId = $delivery->addDelivery($delivery_name, $created_by);
                if (empty($insertId)) {
                    $response = array(
                        "message" => "Problem in Adding New Record",
                        "type" => "error"
                    );
                } 
                else 
                {
                    header("Location:../../lease_management/Delivery/cDelivery.php");
                }
            }
            require_once "../../lease_management/delivery/delivery-add.php";
            break;
    
                        
        case "delivery-edit":
            $delivery_id = $_GET["id"];
            $delivery = new Delivery();
            if (isset($_POST['add'])){
                $delivery_name = trim($_POST['delivery_name']);                
                $delivery->editDelivery($delivery_name, $delivery_id); 
                header("Location: ../../lease_management/delivery/cDelivery.php");
            }
            $result = $delivery->getDeliveryById($delivery_id);
            require_once "../../lease_management/delivery/delivery-edit.php";
            break;
        
        case "delivery-delete":

        default:
            $delivery = new Delivery();
            $result = $delivery->getAllDelivery();
            require_once "../../lease_management/delivery/vDelivery.php";
            break;
        
}
?>