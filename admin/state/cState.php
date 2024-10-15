<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/state/State.php");
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
    case "state-add":
        if (isset($_POST['add'])) {
           
            $state = $_POST['state'];
            $country = $_POST['country'];
            
            $id = $_SESSION['id'];
            $status = new State();
            $insertId = $state->addState($state, $country, $id);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../admin/state/cState.php");
            }
        }
        require_once "../../admin/state/state-add.php";
        break;
    
    case "state-edit":
        $state_id = $_GET["id"];
        $status = new State();
        if (isset($_POST['add'])){
        
            $state = $_POST['state'];
            $country = $_POST['country'];
        $status->editState($state,  $country, $state_id);
        header("Location: ../../admin/state/cState.php");
        }
        $result = $state->getStateById($State_id);
        require_once "../../admin/state/state-edit.php";
        break;
    
    case "state-delete":
        $state_id = $_GET["id"];
        $state = new State();
        $status->deleteState($state_id);
        $result = $state->getAllState();
        require_once "../../admin/state/vState.php";
        break;
    
    default:
        $state = new State();
        $result = $state->getAllState();
        require_once "../../admin/state/vState.php";
        break;
}
?>