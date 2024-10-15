<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/designation/Designation.php');
    $desname = $_POST['name'];
    $descode = $_POST['code'];
    
    $des = new Designation();
    $result = $des->validateDuplicates_Add($desname,$descode);
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