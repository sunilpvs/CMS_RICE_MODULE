<?php
    session_start();
       require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
    require_once($_SERVER['DOCUMENT_ROOT'] ."/user_management/employee/Employee.php");
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
        case "emp-add":
            if (isset($_POST['add'])) {
                $f_name = trim($_POST['f_name']);
                $l_name = trim($_POST['l_name']);
                $dob = trim($_POST['dob']);
                $email = trim($_POST['email']);
                $personal_email = trim($_POST['personal_email']);
                $mobile = trim(trim(_POST['mobile']);
                $add1 =trim($_POST['add1']);
                $add2 = trim($_POST['add2']);
                $city = trim($_POST['city']);
                $state = trim($_POST['state']);
                $pin = trim($_POST['pin']);
                $country = trim($_POST['country']);
                $contacttype_Id = trim($_POST['ctype']);
                $join_date = trim($_POST['doj']);
                $exit_date = trim($_POST['exit_date']);
                if($exit_date == ""){ $exit_date = "1900-01-01";}
                $emp_status = 1;
                $entity_id = trim($_POST['entity']);
                $department = trim($_POST['department']);
                $designation = trim($_POST['designation']);
                $img_name = $_FILES['image']['name'];
                $img_loc = $_FILES['image']['tmp_name'];
                $img_des = "uploadImage/".$img_name;
                move_uploaded_file($img_loc,"uploadImage/$img_name");
                $id = $_SESSION['id'];

                $emp = new Employee();
                $insertId = $emp->addEmployee($f_name, $l_name, $dob, $email, $personal_email,$mobile, $add1, $add2, $city, $state, $pin, $country, $contacttype_Id, $join_date,
                $exit_date, $emp_status,$entity_id,$department,$designation,$img_des,$id);
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
            }
            require_once "../../user_management/employee/emp-add.php";
            break;
        
        case "emp-edit":

            $emp_id = $_GET["id"];
            $emp = new Employee();

            if (isset($_POST['add'])){

                $f_name = trim($_POST['f_name']);
                $l_name = trim($_POST['l_name']);
                $dob = trim($_POST['dob']);
                $email = trim($_POST['email']);
                $personal_email = trim($_POST['personal_email']);
                $mobile = trim($_POST['mobile']);
                $add1 = trim($_POST['add1']);
                $add2 = trim($_POST['add2']);
                $city = trim($_POST['city']);
                $state = trim($_POST['state']);
                $pin = trim($_POST['pin']);
                $country = trim($_POST['country']);
                $ctype = trim($_POST['ctype']);
                $join_date = trim($_POST['doj']);
                $exit_date = trim($_POST['exit_date']);
                if($exit_date == ""){ $exit_date = "1900-01-01";}
                $emp_status = trim($_POST['emp_status']);
                $entity_id = trim($_POST['entity']);
                $department = trim($_POST['department']);
                $designation = trim($_POST['designation']);
                $image = $_FILES['image'];
                $img_name = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
                $img_loc = $_FILES['image']['tmp_name'];
                $target_dir = 'uploadImage/';
                $img_des = "$target_dir$emp_id'-emp'.$img_name";
                move_uploaded_file($img_loc,$img_des);
                
                $emp->editEmployee($f_name, $l_name, $dob, $email, $personal_email, $mobile, $add1, $add2, $city, $state, $pin, $country, $ctype, 
                        $join_date, $exit_date, $emp_status, $entity_id, $department, $designation, $img_des, $emp_id);
                header("Location: ../../user_management/employee/cEmployee.php");
            }
            $result = $emp->getEmployeeById($emp_id);
            require_once "../../user_management/employee/emp-edit.php";
            break;
        
        case "emp-delete":
            $emp_id = $_GET["id"];
            //$emp = new Employee();
            //$emp->disableEmployee($emp_id);
            $result = $emp->getAllEmployee();
            require_once "../../user_management/employee/vEmployee.php";
            break;
        
        default:
            $emp = new Employee();
            $result = $emp->getAllEmployee();
            require_once "../../user_management/employee/vEmployee.php";
            break;
    }
?>