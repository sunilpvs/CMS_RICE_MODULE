<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/state/State.php");


//$db_handle = new DBController();
// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";}   //test
switch ($action) {    
    case "states-add":
        if (isset($_POST['add'])) {
           
            $state = trim($_POST['state']);
            $country = trim($_POST['country']);
            $id = $_SESSION['id'];
            $states = new States();
            $insertId = $states->addStates($state, $country, $id);
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
    
    case "states-edit":
        $id = $_GET["id"];
        $states = new States();
        if (isset($_POST['add'])){
        
            $state = trim($_POST['state']);
            $country = trim($_POST['country']);
        $states->editStates($state,  $country, $id);
        header("Location: ../../admin/state/cState.php");
        }
        $result = $states->getStatesById($id);
        require_once "../../admin/state/state-edit.php";
        break;
    
    case "state-delete":
        //$state_id = $_GET["id"];
        //$state = new States();
        //$status->deleteState($state_id);
        //$result = $state->getAllState();
        //require_once "../../admin/state/vState.php";
        //break;
    
    default:
        $state = new States();
        $result = $state->getAllStates();
        require_once "../../admin/state/vState.php";
        break;
}
?>