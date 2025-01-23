<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/costcentertype/Costcentertype.php');
    $cc_type = trim($_POST['cc_type']);
     $blank= FALSE;
    if($cc_type == "")
    {
        $blank = TRUE;
    }
    
    
    $des = new Costcentertype();
    $result = $des->validateDuplicates_Add($cc_type);
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