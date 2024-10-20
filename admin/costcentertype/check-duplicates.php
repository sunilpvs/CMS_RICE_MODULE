<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/costcentertype/Costcentertype.php');
    $cc_type = $_POST['cc_type'];
    
    
    $des = new Costcentertype();
    $result = $des->validateDuplicates_Add($cc_type);
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