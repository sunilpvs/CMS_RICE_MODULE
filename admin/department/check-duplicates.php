<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/department/Department.php');
    $depname = trim($_POST['name']);
    $depcode = trim($_POST['code']);
    $blank= FALSE;
    if($depname == "" || $depcode == "")
    {
        $blank = TRUE;
    }
    
    $dep = new Department();
    $result = $dep->validateDuplicates_Add($depname,$depcode);
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