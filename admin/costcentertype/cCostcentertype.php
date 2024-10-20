<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/costcentertype/Costcentertype.php");
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
    case "costcentertype-add":
        if (isset($_POST['add'])) 
        {
            $cc_type = $_POST['cc_type'];
            $id = $_SESSION['id'];
            $costcentertype = new Costcentertype();
            $bool = $costcentertype->validateDuplicates_Add($cc_type);
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
                $insertId = $costcentertype->addCostcentertype($cc_type, $id);
                if (empty($insertId)) 
                {
                    $response = array(
                        "message" => "Problem in Adding New Record",
                        "type" => "error"
                    );
                } 
                else 
                {
                    header("Location:../../admin/costcentertype/cCostcentertype.php");
                }
            }
        }
    require_once "../../admin/costcentertype/costcentertype-add.php";
    break;
    
    
    case "costcentertype-edit":
        $id = $_GET["id"];
        $costcentertype = new Costcentertype();
        if (isset($_POST['add']))
        {
            $cc_type = $_POST['cc_type'];
           
            $bool = $costcentertype->validateDuplicates_Edit($cc_type, $id);
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
                $costcentertype ->editCostcentertype($cc_type, $id);
                header("Location: ../../admin/costcentertype/cCostcentertype.php");    
            }
        }
        $result = $costcentertype ->getCostcentertypeById($id);
    require_once "../../admin/costcentertype/costcentertype-edit.php";
    break;
    
    case "costcentertype-delete":
        //$costcentertype = $_GET["id"];
        //$costcentertype = new Costcentertype();
        //$costcentertype->deleteCostcentertype($costcentertype_id);
        //$result = $costcentertype->getAllCostcentertype();
        //require_once "../../admin/costcentertype/vCostcentertype.php";
        //break;
    
    default:
        $costcentertype = new Costcentertype();
        $result = $costcentertype->getAllCostcentertype();
        require_once "../../admin/costcentertype/vCostcentertype.php";
        break;
}
?>