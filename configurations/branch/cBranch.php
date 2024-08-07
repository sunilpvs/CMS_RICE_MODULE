<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/configurations/branch/Branch.php");
#require_once "../../class/DBController.php";
#require_once "../../masters/department/Department.php";
$db_handle = new DBController();
// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";}
switch ($action) {    
    case "branch-add":
        if (isset($_POST['add'])) {
            $f_name = $_POST['f_name'];
            $l_name = $_POST['l_name'];
            $dob = $_POST['dob'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $add_ref1 = $_POST['add_ref1'];
            $add_ref2 = $_POST['add_ref2'];
            $id = $_SESSION['id'];
            $branch = new Branch();
            $insertId = $branch->addBranch($f_name, $l_name, $dob, $email, $mobile, $add_ref1, $add_ref2, $id);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../masters/branch/cBranch.php");
            }
        }
        require_once "../../masters/branch/branch-add.php";
        break;
    
    case "branch-edit":
        $branch_id = $_GET["id"];
        $branch = new Branch();
        if (isset($_POST['add'])){
            $f_name = $_POST['f_name'];
            $l_name = $_POST['l_name'];
            $dob = $_POST['dob'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $add_ref1 = $_POST['add_ref1'];
            $add_ref2 = $_POST['add_ref2'];
        
        $branch->editBranch($f_name, $l_name, $dob, $email, $mobile, $add_ref1, $add_ref2, $contact_id);
        header("Location: ../../masters/branch/cBranch.php");
        }
        $result = $branch->getBranchById($branch_id);
        require_once "../../masters/branch/branch-edit.php";
        break;
    
    case "branch-delete":
        $branch_id = $_GET["id"];
        $branch = new Branch();
        $branch->deleteBranch($branch_id);
        $result = $branch->getAllBranch();
        require_once "../../masters/branch/vBranch.php";
        break;
    
    default:
        $branch = new Branch();
        $result = $branch->getAllBranch();
        require_once "../../masters/branch/vBranch.php";
        break;
}
?>