<?php
    //require_once($_SERVER['DOCUMENT_ROOT'] ."/reports/current_stock/Ccurrent_stock.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");
    

    $contact = new Generic();
    $result = $contact->getCurrentStock();
    
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