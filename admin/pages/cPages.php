<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/pages/Pages.php");
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
    case "pages-add":
        if (isset($_POST['add'])) {
           
            $state = $_POST['state'];
            $country = $_POST['country'];
            
            $id = $_SESSION['id'];
            $pages = new Pages();
            $insertId = $pages->addPages($state, $country, $id);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../admin/pages/cPages.php");
            }
        }
        require_once "../../admin/pages/pages-add.php";
        break;
    
    case "pages-edit":
        $pages_id = $_GET["id"];
        $pages = new Pages();
        if (isset($_POST['add'])){
        
            $state = $_POST['state'];
            $country = $_POST['country'];
        $pages->editPages($state,  $country, $state_id);
        header("Location: ../../admin/pages/cPages.php");
        }
        $result = $pages->getPagesById($pages_id);
        require_once "../../admin/pages/pages-edit.php";
        break;
    
    case "pages-delete":
        $pages_id = $_GET["id"];
        $pages = new Pages();
        $pages->deletePages($pages_id);
        $result = $pages->getAllPages();
        require_once "../../admin/pages/vPages.php";
        break;
    
    default:
        $pages = new Pages();
        $result = $pages->getAllPages();
        require_once "../../admin/spages/vPages.php";
        break;
}
?>