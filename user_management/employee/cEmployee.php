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
                $contacttype_Id = $_POST['ctype'];
                $join_date = $_POST['doj'];
                $exit_date = $_POST['exit_date'];
                if($exit_date == ""){ $exit_date = "1900-01-01";}
                $emp_status = $_POST['emp_status'];
                $Department = $_POST['department'];
                $Designation = $_POST['designation'];
                $img_name = $_FILES['image']['name'];
                $img_loc = $_FILES['image']['tmp_name'];
                $img_des = "uploadImage/".$img_name;
                move_uploaded_file($img_loc,"uploadImage/$img_name");
                $id = $_SESSION['id'];

                $emp = new Employee();
                $insertId = $emp->addEmployee($f_name, $l_name, $dob, $email, $personal_email,$mobile, $add1, $add2, $city, $state, $pin, $country, $contacttype_Id, $join_date,
                $exit_date, $emp_status,$Department,$Designation,$img_des,$id);
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
                $ctype = $_POST['ctype'];
                $join_date = $_POST['doj'];
                $exit_date = $_POST['exit_date'];
                if($exit_date == ""){ $exit_date = "1900-01-01";}
                $emp_status = $_POST['emp_status'];
                $Department = $_POST['department'];
                $Designation = $_POST['designation'];
                $image = $_FILES['image'];
                $img_name = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
                $img_loc = $_FILES['image']['tmp_name'];
                $target_dir = 'uploadImage/';
                $img_des = "$target_dir$emp_id'-emp'.$img_name";
                move_uploaded_file($img_loc,$img_des);
                
                $emp->editEmployee($f_name, $l_name, $dob, $email, $personal_email, $mobile, $add1, $add2, $city, $state, $pin, $country, $ctype, 
                        $join_date, $exit_date, $emp_status, $Department, $Designation, $img_des, $emp_id);
                header("Location: ../../user_management/employee/cEmployee.php");
            }
            $result = $emp->getEmployeeById($emp_id);
            require_once "../../user_management/employee/emp-edit.php";
            break;
        
        case "emp-delete":
            $emp_id = $_GET["id"];
            $emp = new Employee();
            $emp->disableEmployee($emp_id);
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