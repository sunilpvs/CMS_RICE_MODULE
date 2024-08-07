<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/configurations/designation/Designation.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    $designation = new Designation();
    $result = $designation->getAllDesignation();
    
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