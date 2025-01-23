<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/contacttype/Contacttype.php');
    $conid = trim($_POST['id']);
    $name = trim($_POST['name']);
    $status = trim($_POST['status']);
     $result = FALSE;
     $blank= FALSE;
     if($name  == "" || $status == "")
    {
        $blank = TRUE;
    }
    $des = new Contacttype();
    $result = $des->validateDuplicates_Edit($name, $status ,$conid);
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