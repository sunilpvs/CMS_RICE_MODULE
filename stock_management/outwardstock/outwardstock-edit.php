<?php 
    date_default_timezone_set('Asia/Kolkata');
   # require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/stock_management/outwardstock/Outwardstock.php');
        include('../../includes/header.php'); 
include('../../includes/navbar.php');
    if (!empty($result)){
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Edit Outward Stock
            
    </h3>
  </div>

<div class="card-body">

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">

    <div class="container">
    <div class="form-row">
 
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Outward date</label><span
            id="outward_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="outward_date" name= "outward_date" placeholder="outward_date" value="<?php echo $row1["outward_date"]; ?>" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">DC Number</label><span
            id="dc_no-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="dc_no" name= "dc_no" placeholder="DC Number" value="<?php echo $row1["dc_no"]; ?>" required>
    </div>
        <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">DC Date</label><span
            id="dc_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="dc_date" name= "dc_date" placeholder="DC date" value="<?php echo $row1["dc_date"]; ?>" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Commodity</label><span id="commodity_id-info" class="info"></span>
      <select id="commodity_id" name="commodity_id" class="form-control demoInputBox" onchange="myLoadComodityFunction()">
        <option value = -1>Select Commodity</option>
          <?php
              $gen = new Outwardstock();
              $result = $gen->getOutwardstockcommodityList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option  data-empty_bag_wt= <?php echo $row['empty_bag_wt']; ?> 
                    data-bag_wt= <?php echo $row['bag_wt']; ?> 
                    
                value=<?php echo $row['id']; ?>> <?php echo $row["commodity"];?></option>
          <?php   } 
              }                
          ?>         
      </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Empty Bag Weight</label><span id="empty_bag_wt-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="empty_bag_wt" name= "empty_bag_wt" min="0" max="1000" step="0.001" placeholder="00.00" readonly>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Bag Weight</label><span id="bag_wt-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="bag_wt" name= "bag_wt" placeholder="Bag Weight" disabled>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
      function myLoadComodityFunction()
      {
        //id,miller-name,gst_num,place
        var index = document.getElementById("commodity_id").selectedIndex;
        var empty_bag_wt = document.getElementById("commodity_id").options[index].getAttribute("data-empty_bag_wt");
        var bag_wt = document.getElementById("commodity_id").options[index].getAttribute("data-bag_wt"); 

        document.getElementsByName("empty_bag_wt")[0].value = empty_bag_wt;
        document.getElementsByName("bag_wt")[0].value = bag_wt;  
      }
    </script>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Destination - Warehouse-Compartment</label><span id="comp_id-info" class="info"></span>
      <select id="comp_id" name="comp_id" class="form-control demoInputBox" onchange="myLoadFunction2()">
        <option value = -1>Select Warehouse-Compartment</option>
          <?php
              $ins = new Outwardstock();
              $result = $ins->getCompartmentList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option value=<?php echo $row['comp_id']; ?>><?php echo $row["godown"];?></option>
          <?php   } 
              }                
          ?>         
      </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Vehicle Number</label><span
            id="vehicle_no-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="vehicle_no" name= "vehicle_no" placeholder="Vehicle Number" value="<?php echo $row1["vehicle_no"]; ?>" required>
    </div>
     
       
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">No.of bags out</label><span
            id="bags_out-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="bags_out" name= "bags_out" placeholder="No.of bags out" value="<?php echo $row1["bags_out"]; ?>" required>
    </div>
      
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Weighbridge weight</label><span
            id="wbridge_wtg-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="wbridge_wtg" name= "wbridge_wtg" placeholder="Weighbridge weight" value="<?php echo $row1["wbridge_wtg"]; ?>" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Net weight</label><span
            id="net_wtg-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="net_wtg" name= "net_wtg" placeholder="Net Weight" value="<?php echo $row1["net_wtg"]; ?>" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Remarks</label><span
            id="remarks-info" class="info"></span>
      <p><input type="text" class="form-control demoInputBox" id="remarks" name= "remarks" placeholder="Remarks" value="<?php echo $row1["remarks"]; ?>" required></p>
    </div>
   
</div>
</div>

    
  <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Update Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../stock_management/outwardstock/cOutwardstock.php">Cancel</a></button> 
            </div>
        </div>

</form>
</div>
</div>


    <script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
<script>
function validate() {
    var valid = true;   
    $(".form control demoInputBox").css('background-color','');
    $(".info").html('');
 
            
    if(!$("#outward_date").val()) {
        $("#outward_date-info").html("(required)");
        $("#outward_date").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#dc_no").val()) {
        $("#dc_no-info").html("(required)");
        $("#dc_no").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#dc_date").val()) {
        $("#dc_date-info").html("(required)");
        $("#dc_date").css('background-color','#FFFFDF');
        valid = false;
    }

    if(!$("#commodity_id").val()) {
        $("#commodity_id-info").html("(required)");
        $("#commodity_id").css('background-color','#FFFFDF');
        valid = false;
    }
  
    if(!$("#comp_id").val()) {
        $("#comp_id-info").html("(required)");
        $("#comp_id").css('background-color','#FFFFDF');
        valid = false;
    }

    if(!$("#vehicle_no").val()) {
        $("#vehicle_no-info").html("(required)");
        $("#vehicle_no").css('background-color','#FFFFDF');
        valid = false;
    }


    if(!$("#bags_out").val()) {
        $("#bags_out-info").html("(required)");
        $("#bags_out").css('background-color','#FFFFDF');
        valid = false;
    }

    if(!$("#wbridge_wtg").val()) {
        $("#wbridge_wtg-info").html("(required)");
        $("#wbridge_wtg").css('background-color','#FFFFDF');
        valid = false;
    }
    
    if(!$("#net_wtg").val()) {
        $("#net_wtg-info").html("(required)");
        $("#net_wtg").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#delivery_dtl").val()) {
        $("#delivery_dtl-info").html("(required)");
        $("#delivery_dtl").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#remarks").val()) {
        $("#remarks-info").html("(required)");
        $("#remarks").css('background-color','#FFFFDF');
        valid = false;
    }
    return valid;
}
</script>
</body>
</html>
<?php 

include('../../includes/scripts.php'); 
include('../../includes/footer.php'); 

?>