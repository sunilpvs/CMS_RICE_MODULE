<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/designation/Designation.php');
    $desname = trim($_POST['name']);
    $descode = trim($_POST['code']);
    $blank= FALSE;
    if($desname  == "" || $descode == "")
    {
        $blank = TRUE;
    }
    
    
    $des = new Designation();
    $result = $des->validateDuplicates_Add($desname,$descode);
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