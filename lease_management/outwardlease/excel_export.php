<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/lease_management/outwardlease/Outwardlease.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    $olease = new Outwardlease();
    $result = $olease ->getAllOutwardlease();
    
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