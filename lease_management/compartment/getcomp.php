<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/compartment/Compartment.php');
  $str= $_POST['id'];
  list($outwardlease_id,$w_id) = explode(',', $str);


  $comp = new Compartment();
  $result = $comp->getCompartInfo($outwardlease_id, $w_id);
  $count=mysqli_num_rows($result);
  $used_sft=0;
  $used_mton=0;
  if($count>0)
  { //Compartments Exists
    while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {    
      $used_sft = $used_sft + $rows["capacity_sqft"];
      $used_mton = $used_mton + $rows["capacity_mton"]; 
?>
    <tr style="font-size:12px"> 
        <td><?php echo $rows["compartment_name"]; ?></td>  								               
        <td><?php echo $rows["capacity_sqft"]; ?></td>
        <td><?php echo $rows["capacity_mton"]; ?></td>
        <td><?php echo $rows["status"]; ?></td>                
    </tr>
<?php
    }
    echo $result;
  }
?>
 <div>
    <input type = "hidden" id="used_sft" value = "<?php echo $used_sft; ?>">
    <input type = "hidden" id="used_mton" value = "<?php echo $used_mton; ?>">
 </div> 