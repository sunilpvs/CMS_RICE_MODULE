<?php
    session_start();
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
    require_once($_SERVER['DOCUMENT_ROOT'] ."/security/userroles/Userroles.php");

    // $action = "";
    if (! empty($_GET["action"])) {
        $action = $_GET["action"];
    }
    else
    {
    $action = "default";}
    switch ($action) {    
        case "userroles-add":
            if (isset($_POST['add'])) {
                $role_id = $_POST['role_id'];
                $page_id = $_POST['page_id'];
                $access_type = $_POST['access_type'];
                $created_by = $_SESSION['id'];
                $userroles = new Userroles(); 
                $insertId = $userroles->addUserroles($role_id, $page_id,$access_type, $created_by);
                if (empty($insertId)) {
                    $response = array(
                        "message" => "Problem in Adding New Record",
                        "type" => "error"
                    );
                } 
                else 
                {
                    header("Location:../../security/Userroles/cUserroles.php");
                }
            }
            require_once "../../security/userroles/userroles-add.php";
            break;
    
                        
        case "userroles-edit":
            $delivery_id = $_GET["id"];
            $delivery = new Userroles();
            if (isset($_POST['add'])){
                $role_id = $_POST['role_id'];
                $page_id = $_POST['page_id'];
                $access_type = $_POST['access_type'];
                 
                $userroles->editUserroles($role_id, $page_id,$access_type, $created_by, $delivery_id); 
                header("Location: ../../security/userroles/cUserroles.php");
            }
            $result = $userroles->getUserrolesById($userroles_id);
            require_once "../../security/userroles/userroles-edit.php";
            break;
        
        case "userroles-delete":

            $userroles_id = $_GET["id"];
            $userroles = new Userroles();
            $userroles->deleteUserroles($userroles_id);
            $result = $userroles->getAllUserroles();
            require_once "../../security/userroles/vUserroles.php";
            break;
        
        default:
            $user_roles = new Userroles();
            $result = $user_roles->getAllUserroles();
            require_once "../../security/userroles/vUserroles.php";
            break;
        
}
?>