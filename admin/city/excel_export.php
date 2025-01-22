<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/city/City.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    $city = new Citi();
    $result = $city->getAllCiti();
    
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