<?php
    session_start();
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] ."/class/DBController.php");
    require_once($_SERVER['DOCUMENT_ROOT'] ."/security/userpermissions/Userpermissions.php");

    // $action = "";
    if (! empty($_GET["action"])) {
        $action = $_GET["action"];
    }
    else
    {
    $action = "default";}
    switch ($action) {    
        case "userpermissions-add":
            if (isset($_POST['add'])) {
                $user_id = $_POST['user_id'];
                $page_id = $_POST['page_id'];
                $access_type = $_POST['access_type'];
                $created_by = $_SESSION['id'];
                $userpermissions = new Userpermissions(); 
                $insertId = $userpermissions->addUserpermissions($user_id, $page_id,$access_type, $created_by);
                if (empty($insertId)) {
                    $response = array(
                        "message" => "Problem in Adding New Record",
                        "type" => "error"
                    );
                } 
                else 
                {
                    header("Location:../../security/Userpermissions/cUserpermissions.php");
                }
            }
            require_once "../../security/userpermissions/userpermissions-add.php";
            break;
    
                        
        case "userpermissions-edit":
            $delivery_id = $_GET["id"];
            $delivery = new Userpermissions();
            if (isset($_POST['add'])){
                $user_id = $_POST['user_id'];
                $page_id = $_POST['page_id'];
                $access_type = $_POST['access_type'];
                 
                $userpermissions->editUserpermissions($user_id, $page_id,$access_type, $created_by, $delivery_id); 
                header("Location: ../../security/userpermissions/cUserpermissions.php");
            }
            $result = $userpermissions->getUserpermissionsById($userpermissions_id);
            require_once "../../security/userpermissions/userpermissions-edit.php";
            break;
        
        case "userpermissions-delete":

            $userpermissions_id = $_GET["id"];
            $userpermissions = new Userpermissions();
            $userpermissions->deleteUserpermissions($userpermissions_id);
            $result = $userpermissions->getAllUserpermissions();
            require_once "../../security/userpermissions/vUserpermissions.php";
            break;
        
        default:
            $userpermissions = new Userpermissions();
            $result = $userpermissions->getAllUserpermissions();
            require_once "../../security/userpermissions/vUserpermissions.php";
            break;
        
}
?>