<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] ."/user_management/request/Request.php");
    
    $req_id = $_POST['user'];
    $uname = $_POST['uname'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $entity_id = $_POST['entity'];
    $app_status = $_POST['app_status'];
 
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