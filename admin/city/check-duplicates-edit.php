<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/city/City.php');
    $cityid = $_POST['id'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    
    $des = new Citi();
    $result = $des->validateDuplicates_Edit($city, $state, $country, $cityid);
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