<?php
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/reports/reports.php");

    $rep = new AllReports();
    $result = $rep->getStockReport();
    
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