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

switch ($action) {    
    case "contacttype-add":
        if (isset($_POST['add'])) 
        {
            $name = $_POST['name'];
            $status = $_POST['status'];
            $id = $_SESSION['id'];
            $contacttype = new Contacttype();
            $bool = $contacttype->validateDuplicates_Add($name, $status);
            if($bool == FALSE)
            {
                // Duplicate Record Existis.
                $response = array(
                    "message" => "Duplicate record. Problem in Adding New Record",
                    "type" => "error"
                );
            }
            else
            {
                $insertId = $contacttype->addContacttype($name, $status, $id);
                if (empty($insertId)) 
                {
                    $response = array(
                        "message" => "Problem in Adding New Record",
                        "type" => "error"
                    );
                } 
                else 
                {
                    header("Location:../../admin/contacttype/cContacttype.php");
                }
            }
        }
    require_once "../../admin/contacttype/contacttype-add.php";
    break;

    case "contacttype-edit":
        $id = $_GET["id"];
        $contacttype = new Contacttype();
        if (isset($_POST['add']))
        {
            $name = $_POST['name'];
            $status = $_POST['status'];
            $bool = $contacttype->validateDuplicates_Edit($name, $status, $id);
            if($bool == FALSE)
            {
                // Duplicate Record Existis.
                $response = array(
                    "message" => "Duplicate record. Problem in Adding New Record",
                    "type" => "error"
                );                
            }
            else 
            {
                $contacttype->editContacttype($name, $status,  $id);
                header("Location: ../../admin/contacttype/cContacttype.php");    
            }
        }
        $result = $contacttype->getContacttypeById($id);
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