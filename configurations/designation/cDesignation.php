<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/configurations/designation/Designation.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

//$db_handle = new DBController();
// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";}
switch ($action) {    
    case "designation-add":
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $code = $_POST['code'];
            $status = $_POST['status'];
            $id = $_SESSION['id'];
            $designation = new Designation();
            $insertId = $designation->addDesignation($name, $code, $status,$id);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../configurations/designation/cDesignation.php");
            }
        }
        require_once "../../configurations/designation/designation-add.php";
        break;
    
    case "designation-edit":
        $designation_id = $_GET["id"];
        $designation = new Designation();
        if (isset($_POST['add'])){
        $name = $_POST['name'];
        $code = $_POST['code'];
        $status = $_POST['status'];
        $designation->editDesignation($name, $code, $status, $designation_id);
        header("Location: ../../configurations/designation/cDesignation.php");
        }
        $result = $designation->getDesignationById($designation_id);
        require_once "../../configurations/designation/designation-edit.php";
        break;
    
    case "designation-delete":
        $designation_id = $_GET["id"];
        $designation = new Designation();
        $designation->deleteDesignation($designation_id);
        $result = $designation->getAllDesignation();
        require_once "../../configurations/designation/vDesignation.php";
        break;
    
    default:
        $designation = new Designation();
        $result = $designation->getAllDesignation();
        require_once "../../configurations/designation/vDesignation.php";
        break;
}
?>