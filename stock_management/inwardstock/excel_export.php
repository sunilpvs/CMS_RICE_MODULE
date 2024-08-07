<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/stock_management/inwardstock/Inwardstock.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");
  
    $istock = new Inwardstock();
    $result = $istock ->getAllInwardstock();  
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