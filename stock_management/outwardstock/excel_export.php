<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/stock_mgmt/outwardstock/Outwardstock.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    $ostock = new Outwardstock();
    $result = $ostock ->getAllOutwardstock();
    
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