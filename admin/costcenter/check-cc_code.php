<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/costcenter/Costcenter.php');  
$cc_code = trim($_POST['cc_code']);
 $blank= FALSE;
    if($cc_code == "")
    {
        $blank = TRUE;
    }
$costcenter = new Costcenter();
$result = $costcenter->validateCCCode($cc_code);
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

