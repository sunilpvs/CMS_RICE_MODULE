<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/masters/contact/Contact.php");
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
    case "contact-add":
        if (isset($_POST['add'])) {
            $f_name = $_POST['f_name'];
            $l_name = $_POST['l_name'];
            $dob = $_POST['dob'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $add_ref1 = $_POST['add_ref1'];
            $add_ref2 = $_POST['add_ref2'];

            $contact = new Contact();
            $insertId = $contact->addContact($f_name, $l_name, $dob, $email, $mobile, $add_ref1, $add_ref2, $_SESSION['uid']);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../masters/contact/cContact.php");
            }
        }
        require_once "../../masters/contact/contact-add.php";
        break;
    
    case "contact-edit":
        $contact_id = $_GET["id"];
        $contact = new Contact();
        if (isset($_POST['add'])){
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $dob = $_POST['dob'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $add_ref1 = $_POST['add_ref1'];
        $add_ref2 = $_POST['add_ref2'];
        $contacts->editContact($f_name, $l_name, $dob, $email, $mobile, $add_ref1, $add_ref2, $contact_id);
        header("Location: ../../masters/contact/cContact.php");
        }
        $result = $contact->getContactById($contact_id);
        require_once "../../masters/contact/contact-edit.php";
        break;
    
    case "contact-delete":
        $contact_id = $_GET["id"];
        $contact = new Contact();
        $contact->deleteContact($contact_id);
        $result = $contact->getAllContact();
        require_once "../../masters/contact/vContact.php";
        break;
    
    default:
        $contact = new Contact();
        $result = $contact->getAllContact();
        require_once "../../masters/contact/vContact.php";
        break;
}
?>