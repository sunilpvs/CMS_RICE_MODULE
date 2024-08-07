<?php
    require_once($_SERVER['DOCUMENT_ROOT'] ."/user_management/customer/Customer.php");
    include($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

    $contact = new Contact();
    $result = $contact->getAllContact();
    
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