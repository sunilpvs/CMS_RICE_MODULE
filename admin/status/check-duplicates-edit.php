<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/status/Status.php');
    $desid = $_POST['id'];
    $descode = $_POST['code'];
    $desstatus = $_POST['status'];
    $desmod = $_POST['module'];
    
    $des = new Status();
    $result = $des->validateDuplicates_Edit($descode, $desstatus, $desmod, $desid);
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