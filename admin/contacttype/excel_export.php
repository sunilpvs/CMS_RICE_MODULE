<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/contacttype/Contacttype.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    $contacttype = new Contacttype();
    $result = $contacttype->getAllContacttype();
    
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