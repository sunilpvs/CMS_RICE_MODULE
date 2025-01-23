<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/department/Department.php');
    $depid = trim($_POST['id']);
    $depname = trim($_POST['name']);
    $depcode = trim($_POST['code']);
    $result = FALSE;
    $blank= FALSE;
    if($depname == "" || $depcode == "")
    {
        $blank = TRUE;
    }
    
    $dep = new Department();
    $result = $dep->validateDuplicates_Edit($depid, $depname, $depcode);
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