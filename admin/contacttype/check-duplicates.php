<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/contacttype/Contacttype.php');
    $name = trim($_POST['name']);
    $status = trim($_POST['status']);
    $blank= FALSE;
     if($name  == "" || $status == "")
    {
        $blank = TRUE;
    }
    
    $des = new Contacttype();
    $result = $des->validateDuplicates_Add($name,$status);
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