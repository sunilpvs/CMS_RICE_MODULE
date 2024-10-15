<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/entity/Entity.php');  
$cin = $_POST['cin'];
$entity = new Entity();
$result = $entity->validateCin($cin);
if(!$result)
{
    echo "<span style='color:red'> * already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }
?>  

