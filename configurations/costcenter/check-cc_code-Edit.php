<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/costcenter/Costcenter.php'); 
  $costcenter_id = $_POST['costcenter_id']; 
  $cc_code = $_POST['cc_code'];
  $costcenter = new Costcenter();
  $result = $costcenter->validateCCCodeEdit($cc_code,$costcenter_id);
  if(!$result)
  {
      echo "<span style='color:red'> * already exists.</span>";
      echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else
  {
      echo "<span style='color:green'></span>";
      echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }
?>  

