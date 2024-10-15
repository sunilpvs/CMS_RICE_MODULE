<?php
    session_start();
    date_default_timezone_set('Asia/Kolkata');
       require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
    require_once($_SERVER['DOCUMENT_ROOT'] ."/lease_management/miller/Miller.php");

    // $action = "";
    if (! empty($_GET["action"])) {
        $action = $_GET["action"];
    }
    else
    {
    $action = "default";}
    switch ($action) {    
        case "miller-add":
            if (isset($_POST['add'])) {
                $miller_name = $_POST['miller_name'];
                $gst_num = $_POST['gst_num'];
                $place = $_POST['place'];
                $add1 = $_POST['add1'];
                $status = $_POST['status'];
                $created_by = $_SESSION['id'];
                $miller = new Miller(); 
                $insertId = $miller->addMiller($miller_name, $gst_num, $place, $add1, $status, $created_by);
                if (empty($insertId)) {
                    $response = array(
                        "message" => "Problem in Adding New Record",
                        "type" => "error"
                    );
                } 
                else 
                {
                    header("Location:../../lease_management/miller/cMiller.php");
                }
            }
            require_once "../../lease_management/miller/miller-add.php";
            break;
    
                        
        case "miller-edit":
            $miller_id = $_GET["id"];
            $miller = new Miller();
            if (isset($_POST['add'])){
                $miller_name = $_POST['miller_name'];
                $gst_num = $_POST['gst_num'];
                $place = $_POST['place'];
                $add1 = $_POST['add1'];
                $status = $_POST['status'];
                 
                $miller->editMiller($miller_name, $gst_num, $place, $add1,$status, $miller_id); 
                header("Location: ../../lease_management/miller/cMiller.php");
            }
            $result = $miller->getMillerById($miller_id);
            require_once "../../lease_management/miller/miller-edit.php";
            break;
        
        case "miller-delete":

            $miller_id = $_GET["id"];
            $miller = new Miller();
            $miller->deleteMiller($miller_id);
            $result = $miller->getAllMiller();
            require_once "../../lease_management/miller/vMiller.php";
            break;
        
        default:
            $miller = new Miller();
            $result = $miller->getAllMiller();
            require_once "../../lease_management/miller/vMiller.php";
            break;
        
}
?>