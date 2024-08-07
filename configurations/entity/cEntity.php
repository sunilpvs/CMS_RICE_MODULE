<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
   require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/configurations/entity/Entity.php");

$db_handle = new DBController();
// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";}
switch ($action) {    
    case "entity-add":
        if (isset($_POST['add'])) {
            $entity_name = $_POST['entity_name'];
            $cin = $_POST['cin'];
            $incorp_date = $_POST['incorp_date'];  
            $add1 = $_POST['add1'];
            $add2 = $_POST['add2'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $pin = $_POST['pin'];
            $country = $_POST['country'];
            $status = $_POST['status'];
            $created_by = $_SESSION['id'];
            $entity = new Entity();
            $insertId = $entity->addEntity($entity_name, $cin, $incorp_date, $add1, $add2, $city, $state, $pin, $country, $status, $created_by);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../configurations/entity/cEntity.php");
            }
        }
        require_once "../../configurations/entity/entity-add.php";
        break;
    
    case "entity-edit":
        $entity_id = $_GET["id"];
        $entity = new Entity();
        if (isset($_POST['add'])){
            $add1 = $_POST['add1'];
            $add2 = $_POST['add2'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $pin = $_POST['pin'];
            $country = $_POST['country'];
            $status = $_POST['status'];
        $entity->editEntity($add1, $add2, $city, $state, $pin, $country, $status,$entity_id); 
        header("Location: ../../configurations/entity/cEntity.php");
        }
        $result = $entity->getEntityById($entity_id);
        require_once "../../configurations/entity/entity-edit.php";
        break;
    
    case "entity-delete":
        $entity_id = $_GET["id"];
        $entity = new Entity();
        $entity->deleteEntity($entity_id);
        $result = $entity->getAllEntity();
        require_once "../../configurations/entity/vEntity.php";
        break;
    
    default:
        $entity = new Entity();
        $result = $entity->getAllEntity();
        require_once "../../configurations/entity/vEntity.php";
        break;
}
?>
