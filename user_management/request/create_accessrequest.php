<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] ."/user_management/request/Request.php");
    
    $f_name = trim($_POST['f_name']);
    $l_name = trim($_POST['l_name']);
    $dob = $_POST['dob'];
    $email = trim($_POST['email']);
    $personal_email = trim($_POST['personal_email']);
    $mobile = trim($_POST['mobile']);
    $add1 = trim($_POST['add1']);
    $add2 = trim($_POST['add2']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $pin = trim($_POST['pin']);
    $country = trim($_POST['country']);
    $contacttype_id = trim($_POST['ctype']);
    $join_date = $_POST['doj'];
    $exit_date = $_POST['exit_date'];
    if($exit_date == ""){ $exit_date = "1900-01-01";}
    $entity_id = trim($_POST['entity']);
    $department = trim($_POST['department']);
    $designation = trim($_POST['designation']);
    $emp_status = 1;
    $approver_id = trim($_POST['approver_id']);
    $approver_name = trim($_POST['approver_name']);
    $approver_email = trim($_POST['approver_email']);
    $message = trim($_POST['message']);
    $status = "Requested";

    $req_access = new Request();
    $insertId = $req_access->addAccessRequest($f_name, $l_name, $dob, $email, $personal_email, $mobile, $add1, $add2, $city, $state, $pin, $country, $contacttype_id, $join_date, 
                        $exit_date, $entity_id, $department, $designation, $emp_status, $approver_id, $approver_name, $approver_email, $message, $status);
    if (empty($insertId)) {
        $response = array(
            "message" => "Problem in Adding New Record",
            "type" => "error"
        );
    } 
    else 
    {
        header("Location:../../home");
    }

?>