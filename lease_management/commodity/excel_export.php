<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/bulk_ops/commodity/Commodity.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    $comm = new Commodity();
    $result = $comm ->getAllCommodity();
    
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