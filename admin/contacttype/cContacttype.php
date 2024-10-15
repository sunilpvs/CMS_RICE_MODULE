<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
    require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/contacttype/Contacttype.php");
    require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");
    //$db_handle = new DBController();
    // $action = "";
if (! empty($_GET["action"])) 
{
    $action = $_GET["action"];
}
else
{
 $action = "default";
}

switch ($action) 
{
    case "contacttype-add":
        if (isset($_POST['add'])) 
        {   
            $name = $_POST['name'];
            $status = $_POST['status']; 
            $id = $_SESSION['id'];
            $contacttype = new Contacttype();
            $insertId = $city->addContacttype($name, $status, $id);
            if (empty($insertId)) 
            {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location: ../../admin/contacttype/cContacttype.php");
            }
        }
        require_once "../../admin/contacttype/contacttype-add.php";
        break;

    case "contacttype-edit":
        $contacttype_id = $_GET["id"];
        $contacttype  = new Contacttype ();
        if (isset($_POST['add']))
        {
            $name = $_POST['name'];
            $status = $_POST['status'];
            $contact_type->editContacttype($name, $status,  $module_id);
            header("Location: ../../admin/contacttype/cContacttype.php");
        }
        $result = $contacttype->getcontacttypeById($contacttype_id);
        require_once "../../admin/contacttype/contacttype-edit.php";
        break;
    
    case "contacttype-delete":
        $ccontacttype = $_GET["id"];
        $contacttype = new Contacttype();
        $contacttype->deleteContacttype($contacttype_id);
        $result = $contacttype->getAllContacttype();
        require_once "../../admin/contacttype/vContacttype.php";
        break;
    
    default:
        $contacttype = new Contacttype();
        $result = $contacttype->getAllContacttype();
        require_once "../../admin/contacttype/vContacttype.php";
        break;
}
?>