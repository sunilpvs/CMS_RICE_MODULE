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
            $add1 = $_POST['add1'];
            $add2 = $_POST['add2'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $pin = $_POST['pin'];
            $country = $_POST['country'];
            $primary_contact = $_POST['primary_contact'];
            $status = $_POST['status'];
            $created_by = $_SESSION['id'];
            $cust = new Customer();
            $insertId = $cust->addCustomer($customer_name, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status, $created_by);
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
            $add1 = $_POST['add1'];
            $add2 = $_POST['add2'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $pin = $_POST['pin'];
            $country = $_POST['country'];
            $primary_contact = $_POST['primary_contact'];
            $status = $_POST['status'];
            
            $cust->editCustomer($customer_name, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status, $customer_id);
            header("Location: ../../configurations/customer/cCustomer.php");
        }
        $result = $cust->getCustomerById($customer_id);
        require_once "../../configurations/customer/customer-edit.php";
        break;
    
    case "customer-delete":
        $customer_id = $_GET["id"];
        $cust = new Customer();
        $cust->deleteCustomer($customer_id);
        $result = $cust->getAllCustomer();
        require_once "../../configurations/customer/vCustomer.php";
        break;
    
    default:
        $cust = new Customer();
        $result = $cust->getAllCustomer();
        require_once "../../configurations/customer/vCustomer.php";
        break;
}
?>