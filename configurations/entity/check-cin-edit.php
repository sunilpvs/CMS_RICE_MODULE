<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/entity/Entity.php');  
$entity_id = $_POST['entity_id'];
$cin = $_POST['cin'];
$entity = new Entity();
$result = $entity->validateCinEdit($cin);
if(!$result)
{
    echo "<span style='color:red'> * already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }
?>  

