<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/configurations/vendor/Vendor.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    $vendor = new Vendor();
    $result = $vendor->getAllVendor();
    
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