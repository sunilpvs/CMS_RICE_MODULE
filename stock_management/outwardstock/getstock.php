<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .'/stock_management/outwardstock/Outwardstock.php');
  $customer_id= $_POST['customer_id']; 
  $warehouse_id= $_POST['warehouse_id']; 
  $compartment_id = $_POST['compartment_id'];
  $commodity_id= $_POST['commodity_id']; 
  $transport_id = $_POST['transport_id'];

  $outs = new Outwardstock();
  $result = $outs->getStockList($customer_id,$warehouse_id,$compartment_id,$commodity_id,$transport_id);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC); // assoc arrays in rows
  echo json_encode($rows);  
  //echo $result;
?>