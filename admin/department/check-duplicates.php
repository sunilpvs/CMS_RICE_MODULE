<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/department/Department.php');
    $depname = $_POST['name'];
    $depcode = $_POST['code'];
    
    $dep = new Department();
    $result = $dep->validateDuplicates_Add($depname,$depcode);
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