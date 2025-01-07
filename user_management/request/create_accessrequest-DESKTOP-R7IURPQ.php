<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] ."/user_management/request/Request.php");
    
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $personal_email = $_POST['personal_email'];
    $mobile = $_POST['mobile'];
    $add1 = $_POST['add1'];
    $add2 = $_POST['add2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pin = $_POST['pin'];
    $country = $_POST['country'];
    $contacttype_id = $_POST['ctype'];
    $join_date = $_POST['doj'];
    $exit_date = $_POST['exit_date'];
    if($exit_date == ""){ $exit_date = "1900-01-01";}
    $entity_id = $_POST['entity'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $emp_status = 1;
    $approver_id = $_POST['approver_id'];
    $approver_name = $_POST['approver_name'];
    $approver_email = $_POST['approver_email'];
    $message = $_POST['message'];
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
        header("Location:../../user_management/employee/cEmployee.php");
    }

?>