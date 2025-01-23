<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] ."/user_management/request/Request.php");
    
    $req_id = trim($_POST['user']);
    $uname = trim($_POST['uname']);
    $role = trim($_POST['role']);
    $email = trim($_POST['email']);
    $entity_id = trim($_POST['entity']);
    $app_status = trim($_POST['app_status']);
 
    $req_access = new Request();
    $insertId = $req_access->updateAccessRequest($req_id, $uname, $role, $app_status, $email, $entity_id);
    if (empty($insertId)) {
        $response = array(
            "message" => "Problem in Adding New Record",
            "type" => "error"
        );
        header("Location:../../home");            
    } 
    else 
    {
        header("Location:../../user_management/request/approve_request.php");
    }

?>