<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/costcentertype/Costcentertype.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    $costcentertype = new Costcentertype();
    $result = $costcentertype->getAllCostcentertype();
    
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