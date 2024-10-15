<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/userroles/Userroles.php");
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
    case "userroles-add":
        if (isset($_POST['add'])) {
           
            $state = $_POST['state'];
            $country = $_POST['country'];
            
            $id = $_SESSION['id'];
            $userroles = new Userroles();
            $insertId = $userroles->addUserroles($state, $country, $id);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../admin/userroles/cUserroles.php");
            }
        }
        require_once "../../admin/userroles/userroles-add.php";
        break;
    
    case "userroles-edit":
        $state_id = $_GET["id"];
        $userroles = new Userroles();
        if (isset($_POST['add'])){
        
            $state = $_POST['state'];
            $country = $_POST['country'];
        $userroles->editUserrolese($state,  $country, $state_id);
        header("Location: ../../admin/userroles/cUserroles.php");
        }
        $result = $userroles->getUserrolesById($userroles_id);
        require_once "../../admin/userroles/userroles-edit.php";
        break;
    
    case "userroles-delete":
        $userroles_id = $_GET["id"];
        $userroles = new Userroles();
        $userroles->deleteUserroles($userroles_id);
        $result = $userroles->getAllUserroles();
        require_once "../../admin/userroles/vUserroles.php";
        break;
    
    default:
        $userroles = new Userroles();
        $result = $userroles->getAllUserroles();
        require_once "../../admin/userroles/vUserroles.php";
        break;
}
?>