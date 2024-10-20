<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/costcentertype/Costcentertype.php');
    $costid = $_POST['id'];
    $cc_type = $_POST['cc_type'];
    
    $des = new Costcentertype();
    $result = $des->validateDuplicates_Edit( $cc_type, $costid,);
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