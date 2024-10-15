<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/department/Department.php');
    $depid = $_POST['id'];
    $depname = $_POST['name'];
    $depcode = $_POST['code'];
    
    $dep = new Department();
    $result = $dep->validateDuplicates_Edit($depid, $depname, $depcode);
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