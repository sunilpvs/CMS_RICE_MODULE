<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/status/Status.php");
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
    case "status-add":
        if (isset($_POST['add'])) 
        {
            $code = $_POST['code'];
            $status = $_POST['status'];
            $module = $_POST['module'];
            $id = $_SESSION['id'];
            $sta = new Status();
            $bool = $sta->validateDuplicates_Add($code, $status, $module);
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
                $insertId = $sta->addStatus($code, $status, $module, $id);
                if (empty($insertId)) 
                {
                    $response = array(
                        "message" => "Problem in Adding New Record",
                        "type" => "error"
                    );
                } 
                else 
                {
                    header("Location:../../admin/status/cStatus.php");
                }
            }
        }
        require_once "../../admin/status/status-add.php";
        break;
    
    case "status-edit":
        $status_id = $_GET["id"];
        $sta = new Status();
        if (isset($_POST['add']))
        {
            $code = $_POST['code'];
            $status = $_POST['status'];
            $module = $_POST['module'];
            $sta->editStatus($code, $status, $module, $module_id);
            header("Location: ../../admin/status/cStatus.php");
        }
        $result = $status->getStatusById($status_id);
        require_once "../../admin/status/status-edit.php";
        break;
    
    case "status-delete":
        $status_id = $_GET["id"];
        $status = new Status();
        $status->deleteStatus($status_id);
        $result = $status->getAllStatus();
        require_once "../../admin/status/vStatus.php";
        break;
    
    default:
        $status = new Status();
        $result = $status->getAllStatus();
        require_once "../../admin/status/vStatus.php";
        break;
}
?>