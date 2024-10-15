<?php
    //require_once($_SERVER['DOCUMENT_ROOT'] ."/reports/stock/Ccurrent_stock.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/reports/reports.php");

    $rep = new AllReports();
    $result = $rep->getOutwardLeaseReport();
    
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