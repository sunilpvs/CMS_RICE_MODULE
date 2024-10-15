<?php
    //require_once($_SERVER['DOCUMENT_ROOT'] ."/reports/stock/Ccurrent_stock.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    //$contact = new Generic();
    //$result = $contact->getOutwardStockStock();
    
    $data_records = array();
    if (!$export_report) 
    {  
      while( $rows = mysqli_fetch_assoc($export_report) ) 
      {
        $data_records[] = $rows;
      } 
      $gen = new Generic();
      $gen->exportExcel($data_records);
  }
  
?>