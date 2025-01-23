<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/country/Country.php');
    $countryid = trim($_POST['id']);
    $country = trim($_POST['country']);
    $code = trim($_POST['code']);
    $currency = trim($_POST['currency']);
    $result = FALSE;
    $blank= FALSE;
    if( $country == "" || $code == "" || $currency == "")
    {
        $blank = TRUE;
    }
    
    $cou = new Countri();
    $result = $cou->validateDuplicates_Edit($country, $code, $currency, $countryid);
    if(!$result)
    {
        echo "<span style='color:red'> *duplicate record.</span>";
        echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
    }
    else if ($blank == TRUE)
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