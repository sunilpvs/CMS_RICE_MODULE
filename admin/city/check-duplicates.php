<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/city/City.php');
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $country = trim($_POST['country']);
    $blank= FALSE;
    if($city == "" || $state == "" || $country == "")
    {
        $blank = TRUE;
    }
    
    $des = new Citi();
    $result = $des->validateDuplicates_Add($city, $state, $country);
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