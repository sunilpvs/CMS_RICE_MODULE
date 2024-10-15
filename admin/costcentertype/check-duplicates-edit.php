<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/designation/Designation.php');
    $desid = $_POST['id'];
    $desname = $_POST['name'];
    $descode = $_POST['code'];
    
    $des = new Designation();
    $result = $des->validateDuplicates_Edit($desid, $desname, $descode);
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