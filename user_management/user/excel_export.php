<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/user_management/designation/Designation.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");
    $user = new User();
    $result = $user->getAllUserList();
    
    $data_records = array();
    if (!empty($result)) 
    {  
      while( $rows = mysqli_fetch_assoc($result) ) 
      {
        $data_records[] = $rows;
      } 
      $gen = new Generic();
      $gen->exportExcel($data_records);
  }
  
?>