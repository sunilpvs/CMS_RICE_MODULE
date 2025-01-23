<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .'/user_management/request/Request.php');
  $uname = trim($_POST['user_name']);
  $blank= FALSE;
    if($uname == "")
    {
        $balnk = TRUE;
    }
  $usr = new Request();
  $result = $usr->validateUName($uname);
  if(!$result)
  {
    echo "<span style='color:red'> * email already exists .</span>";
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