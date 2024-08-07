<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/entity/Entity.php');
$entity_id = $_POST['entity_id'];
$entity_name = $_POST['entity_name'];
$entity = new Entity();
$result = $entity->validateEntitynameEdit($entity_name);
if(!$result)
{
    echo "<span style='color:red'> * already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }

?> 



