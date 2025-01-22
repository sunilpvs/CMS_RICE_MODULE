<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/admin/entity/Entity.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    $entity = new Entity();
    $result = $entity->getAllentity();
    
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