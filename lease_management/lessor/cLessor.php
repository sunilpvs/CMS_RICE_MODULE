<?php
    session_start();
    date_default_timezone_set('Asia/Kolkata');
       require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
    require_once($_SERVER['DOCUMENT_ROOT'] ."/lease_management/lessor/Lessor.php");

    // $action = "";
    if (! empty($_GET["action"])) {
        $action = $_GET["action"];
    }
    else
    {
    $action = "default";}
    switch ($action) {    
        case "lessor-add":
            if (isset($_POST['add'])) {
                $lessor_name = $_POST['lessor_name'];
                $ltype = $_POST['ltype'];
                $add1 = $_POST['add1'];
                $add2 = $_POST['add2'];
                $city = $_POST['city'];
                $state = $_POST['state'];
                $pin = $_POST['pin'];
                $country = $_POST['country'];
                $primary_contact = $_POST['primary_contact'];
                $status = $_POST['status'];
                $created_by = $_SESSION['id'];
    
                $less = new Lessor(); 
                $insertId = $less->addLessor($lessor_name, $ltype, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status, $created_by);
                if (empty($insertId)) {
                    $response = array(
                        "message" => "Problem in Adding New Record",
                        "type" => "error"
                    );
                } 
                else 
                {
                    header("Location:../../lease_management/lessor/cLessor.php");
                }
            }
            require_once "../../lease_management/lessor/lessor-add.php";
            break;
    
                        
        case "lessor-edit":
            $lessor_id = $_GET["id"];
            $less = new Lessor();
            if (isset($_POST['add'])){
                $lessor_name = $_POST['lessor_name'];
                $ltype = $_POST['ltype'];
                $add1 = $_POST['add1'];
                $add2 = $_POST['add2'];
                $city = $_POST['city'];
                $state = $_POST['state'];
                $pin = $_POST['pin'];
                $country = $_POST['country'];
                $primary_contact = $_POST['primary_contact'];
                $status = $_POST['status'];
                 
                $less->editLessor($lessor_name, $ltype, $add1, $add2, $city, $state, $pin, $country, $primary_contact, $status, $lessor_id); 
                header("Location: ../../lease_management/lessor/cLessor.php");
            }
            $result = $less->getLessorById($lessor_id);
            require_once "../../lease_management/lessor/lessor-edit.php";
            break;
        
        case "lessor-delete":

            $lessor_id = $_GET["id"];
            $less = new Lessor();
            $less->deleteLessor($lessor_id);
            $result = $less->getAllLessor();
            require_once "../../lease_management/lessor/vLessor.php";
            break;
        
        default:
            $less = new Lessor();
            $result = $less->getAllLessor();
            require_once "../../lease_management/lessor/vLessor.php";
            break;
        
}
?>