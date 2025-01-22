<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/status/Status.php');
    $descode = trim($_POST['code']);
    $desstatus = trim($_POST['status']);
    $desmod = trim($_POST['module']);
    $blank= FALSE;
    if($descode == "" || $desstatus == "" || $desmod == "")
    {
        $blank = TRUE;
    }
    
    $des = new Status();
    $result = $des->validateDuplicates_Add($descode, $desstatus, $desmod);
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