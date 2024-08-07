<?php
session_start();
 require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/configurations/department/Department.php");

// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";}
switch ($action) {    
    case "department-add":
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $code = $_POST['code'];
            $status = $_POST['status'];
            $id = $_SESSION['id'];
            $department = new Department();
            $insertId = $department->addDepartment($name, $code, $status,$id);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../configurations/department/cDepartment.php");
            }
        }
        require_once "../../configurations/department/department-add.php";
        break;
    
    case "department-edit":
        $department_id = $_GET["id"];
        $department = new Department();
        if (isset($_POST['add'])){
        $name = $_POST['name'];
        $code = $_POST['code'];
        $status = $_POST['status'];
        $department->editDepartment($name, $code, $status, $department_id);
        header("Location: ../../configurations/department/cDepartment.php");
        }
        $result = $department->getDepartmentById($department_id);
        require_once "../../configurations/department/department-edit.php";
        break;
    
    case "department-delete":
        $department_id = $_GET["id"];
        $department = new Department();
        $department->deleteDepartment($department_id);
        $result = $department->getAllDepartment();
        require_once "../../configurations/department/vDepartment.php";
        break;
    
    default:
        $department = new Department();
        $result = $department->getAllDepartment();
        require_once "../../configurations/department/vDepartment.php";
        break;
}
?>