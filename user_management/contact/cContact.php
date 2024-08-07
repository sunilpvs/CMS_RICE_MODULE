<?php
session_start();
   require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/user_management/contact/Contact.php");

//$db_handle = new DBController();
//$action = "";
//$action = preg_replace('#[^0-9a-Z_-]#i','',$_GET['action']);  


if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";
}
switch ($action) 
{    
    case "contact-add":
        if (isset($_POST['add'])) {
            $f_name = $_POST['f_name'];
            $l_name = $_POST['l_name'];
            $dob = $_POST['dob'];;
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $add1 = $_POST['add1'];
            $add2 = $_POST['add2'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $pin = $_POST['pin'];
            $country = $_POST['country'];
            $ctype = $_POST['ctype'];
            $id = $_SESSION['id'];
            $contact = new Contact();
            $insertId = $contact->addContact($f_name, $l_name, $dob, $email, $mobile, $add1, $add2, $city, $state, $pin, $country, $ctype, $id);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../user_management/contact/cContact.php");
            }
        }
        require_once "../../user_management/contact/contact-add.php";
        break;
    
    case "contact-edit":
        $id = preg_replace('#[^0-9]#i','',$_GET['id']);
        $contact_id = $_GET["id"];
        //$id = preg_replace('#[^0-9a-Z]#i','',$_GET['id']);
        $contact = new Contact();
        if (isset($_POST['add'])){
            $f_name = $_POST['f_name'];
            $l_name = $_POST['l_name'];
            $dob = $_POST['dob'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $add1 = $_POST['add1'];
            $add2 = $_POST['add2'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $pin = $_POST['pin'];
            $country = $_POST['country'];
            $ctype = $_POST['ctype'];
            $contact->editContact($f_name, $l_name, $dob, $email, $mobile, $add1, $add2, $city, $state, $pin, $country, $ctype, $contact_id);
            header("Location: ../../user_management/contact/cContact.php");
        }
        $result = $contact->getContactById($contact_id);
        require_once "../../user_management/contact/contact-edit.php";
        break;
    
    case "contact-delete":
        $contact_id = $_GET["id"];
        $contact = new Contact();
        $contact->deleteContact($contact_id);
        $result = $contact->getAllContact();
        require_once "../../user_management/contact/vContact.php";
        break;
    
    default:
        $contact = new Contact();
        $result = $contact->getAllContact();
        require_once "../../user_management/contact/vContact.php";
        break;
}
?>