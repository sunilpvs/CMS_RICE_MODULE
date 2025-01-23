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

switch ($action) {    
    case "countri-add":
        if (isset($_POST['add'])) 
        {
            $country = trim($_POST['country']);
            $code = trim($_POST['code']);
            $currency = trim($_POST['currency']);
            $id = $_SESSION['id'];
            $countri = new Countri();
            $bool = $countri->validateDuplicates_Add($country, $code, $currency);
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
                $insertId = $countri->addCountri($country, $code, $currency, $id);
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

    case "countri-edit":
        $id = $_GET["id"];
        $countri = new Countri();
        if (isset($_POST['add']))
        {
            $country = trim($_POST['country']);
            $code = trim($_POST['code']);
            $currency = trim($_POST['currency']);
            $bool = $countri->validateDuplicates_Edit($country, $code, $currency, $id);
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
                $countri->editCountri($country, $code, $currency, $id);
                header("Location: ../../admin/country/cCountry.php");    
            }
        }
        $result = $countri->getCountriById($id);
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
        $countri = new Countri();
        $result = $countri->getAllCountri();
        require_once "../../admin/country/vCountry.php";
        break;
}
?>