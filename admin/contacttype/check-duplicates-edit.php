<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/contacttype/Contacttype.php');
    $conid = $_POST['id'];
    $name = $_POST['name'];
    $status = $_POST['status'];
    
    $des = new Contacttype();
    $result = $des->validateDuplicates_Edit($name, $status ,$conid);
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