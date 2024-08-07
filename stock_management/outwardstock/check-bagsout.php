h<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .'/stock_management/outwardstock/Outwardstock.php');
  //Get POST Values
  $comp_id = $_POST["comp_id"];
  $commodity_id = $_POST["commodity_id"];
  $bags_out = ($_POST['bags_out']); 

  //Checking if Compartment and Commodity already existing in Commodity Stock Table
  $outwardstock = new Outwardstock();
  $result = $outwardstock->getBagsStockInfo($comp_id,$commodity_id);
  $count=mysqli_num_rows($result);
  if($count > 0)
  {
      $rows = mysqli_fetch_array($result,MYSQLI_ASSOC); 
      $bags = $rows['bags'];  
  }
  else
  {
    $bags = 0;
  }
  if($bags_out > $bags)
  {
    //ERROR: Outward Bags are entered greater than stock.
    $str="* max stock ($bags) bags only.";
    echo "<span style='color:red'>".$str."</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }
  else
  {
    echo "<span style='color:green'> </span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }
?> 