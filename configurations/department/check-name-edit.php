<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/department/Department.php');
$department_id = $_POST['department_id'];
$name = $_POST['name'];
$dep = new Department();
$result = $dep->validateNameEdit($name,$department_id);
if(!$result)
{
    echo "<span style='color:red'> * already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
}
else
{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
}

?> 



