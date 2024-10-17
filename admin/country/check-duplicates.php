<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/country/Country.php');
    $country = $_POST['country'];
    $code = $_POST['code'];
    $currency = $_POST['currency'];
    
    $cou = new Countri();
    $result = $cou->validateDuplicates_Add($country,$code, $currency);
    if(!$result)
    {
        echo "<span style='color:red'> *duplicate record.</span>";
        echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
    }
    else
    {
        echo "<span style='color:green'></span>";
        echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
    }
?>