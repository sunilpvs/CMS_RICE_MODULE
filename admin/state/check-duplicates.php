<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/state/State.php');
    $state = trim($_POST['state']);
    $country = trim($_POST['country']);
    
    $blank= FALSE;
    if($state == "" ||  $country == "")
    {
        $blank = TRUE;
    }
    
    $des = new States();
    $result = $des->validateDuplicates_Add($state,$country);
    if(!$result)
    {
        echo "<span style='color:red'> *duplicate record.</span>";
        echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
    }
      else if($blank == TRUE)
    {
        echo "<span style='color:red'> *blank record.</span>";
        echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
    }
    else
    {
        echo "<span style='color:green'></span>";
        echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
    }
?>