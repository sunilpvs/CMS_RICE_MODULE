<?php
session_start();
 require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/city/City.php");

// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";}
switch ($action) {    
    case "citi-add":
        if (isset($_POST['add'])) {
            
            $city = $_POST['city'];
            $state = $_POST['state'];
            $country = $_POST['country'];
            $id = $_SESSION['id'];
            $citi = new Citi();
            $insertId = $citi->addCiti($city, $state, $country,$id);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../admin/city/cCity.php");
            }
        }
        require_once "../../admin/city/city-add.php";
        break;
    
    case "citi-edit":
        $citi_id = $_GET["id"];
        $citi = new Citi();
        if (isset($_POST['add'])){
            $city = $_POST['city'];
            $state = $_POST['state'];
            $country = $_POST['country'];
            
        $citi->editCiti($city, $state, $country, $citi_id);
        header("Location: ../../admin/city/cCity.php");
        }
        $result = $citi->getCitiById($citi_id);
        require_once "../../admin/city/city-edit.php";
        break;
    
    case "citi-delete":
        $citi_id = $_GET["id"];
        $citi = new Citi();
        $citi->deleteCiti($citi_id);
        $result = $department->getAllCiti();
        require_once "../../admin/city/vCity.php";
        break;
    
    default:
        $citi = new Citi();
        $result = $citi->getAllCiti();
        require_once "../../admin/city/vCity.php";
        break;
}
?>