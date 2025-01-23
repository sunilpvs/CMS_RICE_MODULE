<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/costcentertype/Costcentertype.php');
    $costid = trim($_POST['id']);
    $cc_type = trim($_POST['cc_type']);
    $result = FALSE;
     $blank= FALSE;
    if($cc_type == "")
    {
        $blank = TRUE;
    }
    
    
    $des = new Costcentertype();
    $result = $des->validateDuplicates_Edit( $cc_type, $costid,);
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