<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/userroles/Userroles.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    $userroles = new Userroles();
    $result = $userroles->getAlluserroles();
    
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