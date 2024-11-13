<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/userpermissions/Userpermissions.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

//$db_handle = new DBController();
// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";}   //test
switch ($action) {    
    case "userpermissions-add":
        if (isset($_POST['add'])) {
           
            $user_id = $_POST['user_id'];
            $page_id= $_POST['page_id'];
            $access_type = $_POST['access_type'];
            $id = $_SESSION['id'];
            $userpermissions = new Userpermissions();
            $insertId = $userpermissions->addUserpermissions($user_id, $access_type, $id);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../admin/userpermissions/cUserpermissions.php");
            }
        }
        require_once "../../admin/userpermissions/userpermissions-add.php";
        break;
    
    case "userpermissions-edit":
        $userpermissions_id = $_GET["id"];
        $userpermissions = new Userpermissions();
        if (isset($_POST['add'])){
            $user_id = $_POST['user_id'];
            $page_id= $_POST['page_id'];
            $access_type = $_POST['access_type'];
        $userpermissions->editUserpermissions( $user_id ,  $page_id, $access_type);
        header("Location: ../../admin/userpermissions/cUserpermissions.php");
        }
        $result = $userpermissions->getUserpermissionsById($userpermissions_id);
        require_once "../../admin/userpermissions/userpermissions-edit.php";
        break;
    
    case "userpermissions-delete":
        $userpermissions_id = $_GET["id"];
        $userpermissions = new Userpermissions();
        $userpermissions->deleteUserpermissions($userpermissions_id);
        $result = $userpermissions->getAllUserpermissions();
        require_once "../../admin/userpermissions/vUserpermissions.php";
        break;
    
    default:
        $userpermissions = new Userpermissions();
        $result = $userpermissions->getAllUserpermissions();
        require_once "../../admin/userpermissions/vUserpermissions.php";
        break;
}
?>