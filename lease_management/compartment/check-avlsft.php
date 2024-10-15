<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/compartment/Compartment.php');
  //Get POST Values
  $str= $_POST['warehouse_id'];
  list($outwardlease_id,$w_id) = explode(',', $str);
  $val_sqft = (int)trim($_POST['val_sqft']); 
  $lease_sqft = $_POST['lease_sqft']; 
  $used_sft = 0;
  $comp = new Compartment();
  $result = $comp->getCompartInfo($outwardlease_id,$w_id);
  $count=mysqli_num_rows($result);
  if($count>0)
  { //Compartments Exists
    while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {    
      $used_sft = $used_sft + $rows["capacity_sqft"];
    }
  }
  // Used_SQFT + Val_SQFT > lease_sqf
  $max_avl = $lease_sqft - $used_sft;
if($val_sqft > $max_avl)
{ 
    //Total capacity entered with existing used is greater than leased capacity.
    $str="* max available ($max_avl)sqft only.";
    echo "<span style='color:red'>".$str."</span>";
    echo "<script>$('#btnSubmit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'> </span>";
    echo "<script>$('#btnSubmit').prop('disabled',false);</script>";
  }
?> 