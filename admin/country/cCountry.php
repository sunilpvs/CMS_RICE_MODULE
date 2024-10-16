<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/country/Country.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

//$db_handle = new DBController();
// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
else
{
 $action = "default";
}

switch ($action) 
{
    case "country-add":
        if (isset($_POST['add'])) 
        {            
            $country = $_POST['country'];
            $code = $_POST['code'];
            $currency = $_POST['currency'];
            $id = $_SESSION['id'];
            $c = new Country();
            $bool = $c->validateDuplicates_Add($country, $code, $currency);
            if($bool == FALSE)
            {
                // Duplicate Record Existis.
                $response = array(
                    "message" => "Duplicate record. Problem in Adding New Record",
                    "type" => "error"
                );
            }
            else
            {
                $insertId = $c->addCountry($country, $code, $currency, $id);
                if (empty($insertId)) 
                {
                    $response = array(
                        "message" => "Problem in Adding New Record",
                        "type" => "error"
                    );
                } 
                else 
                {
                    header("Location:../../admin/country/cCountry.php");
                }
            }
        }
        require_once "../../admin/country/country-add.php";
        break;

    case "country-edit":
        $country_id = $_GET["id"];
        $c = new country();
        if (isset($_POST['add']))
        {      
            $country = $_POST['country'];
            $code = $_POST['code'];
            $currency = $_POST['currency'];
            
            $c->editcountry($country, $code, $currency, $country_id);
            header("Location: ../../admin/country/ccountry.php");
        }
        $result = $country->getcountryById($country_id);
        require_once "../../admin/country/country-edit.php";
        break;
    
    case "country-delete":
        // $country_id = $_GET["id"];
        // $country = new country();
        // $country->deletecountry($country_id);
        // $result = $country->getAllcountry();
        // require_once "../../admin/country/vcountry.php";
        // break;
    
    default:
        $country = new Country();
        $result = $country->getAllCountry();
        require_once "../../admin/country/vCountry.php";
        break;
}
?>