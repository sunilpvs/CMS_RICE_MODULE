<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/lease_management/miller/Miller.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    $miller = new Miller();
    $result = $miller ->getAllMiller();
    
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