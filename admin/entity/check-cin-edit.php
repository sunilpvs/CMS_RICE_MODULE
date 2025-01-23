<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/entity/Entity.php');  
$entity_id = trim($_POST['entity_id'];
$cin = trim($_POST['cin'];
$result = FALSE;
    $blank= FALSE;
    if($cin == "")
    {
        $blank = TRUE;
    }
$entity = new Entity();
$result = $entity->validateCinEdit($cin);
if(!$result)
{
    echo "<span style='color:red'> * already exists.</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }
    else if($blank == TRUE)
    {
        echo "<span style='color:red'> *blank record.</span>";
        echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
    }
    else{
    echo "<span style='color:green'></span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }
?>  

