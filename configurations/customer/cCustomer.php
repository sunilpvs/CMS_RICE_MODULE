<?php
session_start();
#require_once($_SERVER['DOCUMENT_ROOT'] ."/class/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/configurations/customer/Customer.php");

if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";}
switch ($action) {    
    
    case "customer-add":
        if (isset($_POST['add'])) {
            $customer_name = $_POST['customer_name'];
            $add1 = trim($_POST['add1']);
            $add2 = trim($_POST['add2']);
            $city = trim($_POST['city']);
            $state = trim($_POST['state']);
            $pin = trim($_POST['pin']);
            $country = trim($_POST['country']);
            $primary_contact = trim($_POST['primary_contact']);
            $status = trim($_POST['status']);
            $entity_id = $_SESSION['entity_id'];
            $created_by = $_SESSION['id'];
            $cust = new Customer();
            $insertId = $cust->addCustomer($customer_name, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status, $entity_id , $created_by);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } 
            else 
            {
                header("Location:../../configurations/customer/cCustomer.php");
            }
        }
        require_once "../../configurations/customer/customer-add.php";
        break;
    
    case "customer-edit":
        $customer_id = $_GET["id"];
        $cust = new Customer();
        if (isset($_POST['add']))
        {
            $customer_name = $_POST['customer_name'];
            $add1 = trim($_POST['add1']);
            $add2 = trim($_POST['add2']);
            $city = trim($_POST['city']);
            $state = trim($_POST['state']);
            $pin = trim($_POST['pin']);
            $country = trim($_POST['country']);
            $primary_contact = trim($_POST['primary_contact']);
            $status = trim($_POST['status']);
            
            $cust->editCustomer($customer_name, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status, $customer_id);
            header("Location: ../../configurations/customer/cCustomer.php");
        }
        $result = $cust->getCustomerById($customer_id);
        require_once "../../configurations/customer/customer-edit.php";
        break;
    
    case "customer-delete":
        //$customer_id = $_GET["id"];
        //$cust = new Customer();
        //$cust->deleteCustomer($customer_id);
        //$result = $cust->getAllCustomer();
        require_once "../../configurations/customer/vCustomer.php";
        break;
    default:
        $cust = new Customer();
        $result = $cust->getAllCustomer();
        require_once "../../configurations/customer/vCustomer.php";
        break;
}
?>