<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/lease_management/inwardlease/Inwardlease.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    $ilease = new Inwardlease();
    $result = $ilease ->getAllInwardlease();
    
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