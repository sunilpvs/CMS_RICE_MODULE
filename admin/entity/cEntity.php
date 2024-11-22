<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
   require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/entity/Entity.php");

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
            $cc_code = $_POST['cc_code'];
            $cin = $_POST['cin'];
            $incorp_date = $_POST['incorp_date'];
            $gst_no = $_POST['gst_no'];
            $add1 = $_POST['add1'];
            $add2 = $_POST['add2'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $country = $_POST['country'];
            $pin = $_POST['pin'];
            $primary_contact = $_POST['primary_contact'];
            $status = $_POST['status'];
            $created_by = $_SESSION['id'];

            $entity = new Entity();
            $insertId = $entity->addEntity($entity_name, $cc_code, $cin, $incorp_date, $gst_no, $add1, $add2, $city, $state, $country, $pin, $primary_contact, $status, $created_by);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../admin/entity/cEntity.php");
            }
        }
        require_once "../../admin/entity/entity-add.php";
        break;
    
    case "entity-edit":
        $entity_id = $_GET["id"];
        $entity = new Entity();
        if (isset($_POST['add'])){
            $entity_name = $_POST['entity_name'];
            $cin = $_POST['cin'];
            $incorp_date = $_POST['incorp_date'];
            $entity_id = $_POST['entity_id'];
            $status = $_POST['status'];
        $entity->editEntity($entity_name, $cin, $incorp_date, $status, $entity_id); 
        header("Location: ../../admin/entity/cEntity.php");
        }
        $result = $entity->getEntityById($entity_id);
        require_once "../../admin/entity/entity-edit.php";
        break;
    
    case "entity-delete":
        $entity_id = $_GET["id"];
        $entity = new Entity();
        $entity->deleteEntity($entity_id);
        $result = $entity->getAllEntity();
        require_once "../../admin/entity/vEntity.php";
        break;
    
    default:
        $entity = new Entity();
        $result = $entity->getAllEntity();
        require_once "../../admin/entity/vEntity.php";
        break;
}
?>
