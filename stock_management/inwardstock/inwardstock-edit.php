<?php 
    date_default_timezone_set('Asia/Kolkata');
   # require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/stock_mgmt/inwardstock/Inwardstock.php');
    include('../../includes/header.php'); 
    include('../../includes/navbar.php');
    if (!empty($result)){
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Edit Inwardstock Details
            
    </h3>
  </div>

<div class="card-body">

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">

    <div class="container">
    <div class="form-row">
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Received date</label><span
            id="received_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="received_date" name= "received_date" placeholder="received_date" value="<?php echo $row1["received_date"]; ?>" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Invoice Number</label><span
            id="invoice_number-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="invoice_no" name= "invoice_no" placeholder="Invoice Number" value="<?php echo $row1["invoice_no"]; ?>" required>
    </div>
        <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Invoice Date</label><span
            id="invoice_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="invoice_date" name= "invoice_date" placeholder="Invoice Date" value="<?php echo $row1["invoice_date"]; ?>" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Miller Name</label><span id="miller_id-info" class="info"></span>
      <select id="miller_id" name="miller_id" class="form-control demoInputBox" onchange="myLoadFunction()">
        <option value = -1>Select Miller</option>
          <?php
              $gen = new Inwardstock();
              $result = $gen->getInwardstockmillerList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option  data-gst_num= <?php echo $row['gst_num']; ?> 
                   data-place= <?php echo $row['place']; ?> 
                    
                value=<?php echo $row['id']; ?> <?php if($row['id'] == $row1['miller_id']) { echo "Selected"; } ?>> <?php echo $row["miller_name"] ?></option>
          <?php   } 
              }                
          ?>         
      </select>
      
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">GST Number</label><span id="gst_num-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="gst_num" name= "gst_num" placeholder="GST Number" value="<?php echo $row['gst_num']; ?>" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Place</label><span id="ltype-info" class="place"></span>
      <input type="text" class="form-control demoInput
      Box" id="place" name= "place" placeholder="Place" value="<?php echo $row['place']; ?>" disabled>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

      function myLoadFunction()
      {
        //id,miller-name,gst_num,place
        var index = document.getElementById("miller_id").selectedIndex;
        var gst_num = document.getElementById("miller_id").options[index].getAttribute("data-gst_num");
        var place = document.getElementById("miller_id").options[index].getAttribute("data-place");

        document.getElementsByName("gst_num")[0].value = gst_num;
        document.getElementsByName("place")[0].value = place;  
      }
    </script>

<div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Commodity</label><span id="commodity_id-info" class="info"></span>
      <select id="commodity_id" name="commodity_id" class="form-control demoInputBox" onchange="myLoadFunction1()">
        <option value = -1>Select Commodity</option>
          <?php
              $gen = new Inwardstock();
              $result = $gen->getInwardstockcommodityList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option  data-empty_bag_wt= <?php echo $row['empty_bag_wt']; ?> 
                   data-bag_wt= <?php echo $row['bag_wt']; ?> 
                    
                value=<?php echo $row['id']; ?> <?php if($row['id'] == $row1['commodity_id']) { echo "Selected"; } ?>> <?php echo $row["commodity"] ?></option>
          <?php   } 
              }                
          ?>         
      </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Empty Bag Weight</label><span id="empty_bag_wt-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="empty_bag_wt" name= "empty_bag_wt" min="0" max="1000" step="0.001" placeholder="00.00" value="<?php echo $row['empty_bag_wt']; ?>" readonly>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Bag Weight</label><span id="bag_wt-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="bag_wt" name= "bag_wt" placeholder="Bag Weight" value="<?php echo $row['bag_wtg']; ?>" readonly>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

      function myLoadFunction1()
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
        <label for="validationDefault03" class="info">Mode of Transportation</label><span id="mod_transport-info" class="info"></span>
        <select id="mod_transport" name="mod_transport" class="form-control demoInputBox">
          <?php
              $gen = new Inwardstock();
              $result = $gen->getTransportTypeList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option 
          value=<?php echo $row['id']; ?> <?php if($row['id'] == $row1['mod_transport']) { echo "Selected"; } ?>> <?php echo $row["name"] ?></option> 
          <?php   } 
              }
          ?>         
      </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Godown Name</label><span id="warehouse_id-info" class="info"></span>
      <select id="warehouse_id" name="warehouse_id" class="form-control demoInputBox" onchange="myLoadFunction2()">
        <option value = -1>Select Godown</option>
          <?php
              $gen = new Inwardstock();
              $result = $gen->getInwardstockarehouseList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option  data-compartment_code= <?php echo $row['compartment_code']; ?> 
                value=<?php echo $row['warehouse_id']; ?><?php if($row['warehouse_id'] == $row1['warehouse_id']) { echo "Selected"; } ?>> <?php echo $row["warehouse_name"] ?></option>
          <?php   } 
              }                
          ?>         
      </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Compartment Name</label><span id="compartment_code-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="compartment_code" name= "compartment_code" placeholder="Compartment Code" value="<?php echo $row['compartment_code']; ?>" readonly>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

      function myLoadFunction2()
      {
        //id,miller-name,gst_num,place
        var index = document.getElementById("warehouse_id").selectedIndex;
        var compartment_code = document.getElementById("warehouse_id").options[index].getAttribute("data-compartment_code");
        
        document.getElementsByName("compartment_code")[0].value = compartment_code;  
      }
    </script>
     
      <div class="col-md-4 mb-3">
        <label for="validationDefault03" class="info">Vehicle Number</label><span
              id="vehicle_no-info" class="info"></span>
        <input type="text" class="form-control demoInputBox" id="vehicle_no" name= "vehicle_no" placeholder="Vehicle Number" value="<?php echo $row1['vehicle_no']; ?>" required>
      </div> 
     
      <div class="col-md-4 mb-3">
        <label for="validationDefault03" class="info">No.of bags received</label><span
              id="bags_rec-info" class="info"></span>
        <input type="text" class="form-control demoInputBox" id="bags_rec" name= "bags_rec" placeholder="No.of bags received" onchange="calculatecost()" value="<?php echo $row1['bags_rec']; ?>" required>
      </div>
    
      
  
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Net Weight</label><span id="net_wtg-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="net_wtg" name= "net_wtg" min="0" max="1000" placeholder="0.00" step="0.001" value="00.00" onchange="calculatedifference()" value="<?php echo $row1['net_wtg']; ?>" readonly>
    </div> 

     <script>
        function calculatecost()
        { 
          
          var bags_rec = document.getElementById('bags_rec').value;
          var empty_bag_wt  = document.getElementById('empty_bag_wt').value;
          var bag_wt = document.getElementById('bag_wt').value;
          //no.of bags (empty)
          var bags_empty = Math.ceil((bags_rec * empty_bag_wt)).valueOf(); 
          //no.of bags (bag_wtg)
          var bags_weight = Math.ceil((bags_rec * bag_wt)); 
          //document.getElementById('bags_weight').value = bags_weight;
      
          var netweight = Math.abs((bags_empty) + (bags_weight)).valueOf(); 
          document.getElementsByName("net_wtg")[0].value = netweight;
        } 
                
    </script>

    <div class="col-md-4 mb-3">
        <label for="validationDefault03" class="info">Weighbridge weight</label><span
              id="wbridge_wtg-info" class="info"></span>
        <input type="text" class="form-control demoInputBox" id="wbridge_wtg" name= "wbridge_wtg" placeholder="Weighbridge weight" onchange="calculatedifference()" value="<?php echo $row1['wbridge_wtg']; ?>" required>
    </div>


    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Weight Bridge Difference</label><span id="wbridge_diff-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="wbridge_diff" name= "wbridge_diff" min="0" max="1000" placeholder="0.00" step="0.001" value="00.00"  value="<?php echo $row1['wbridge_diff']; ?>" readonly>
    </div> 

     <script>
        function calculatedifference()
        { 
          
          var net_wtg = document.getElementById('net_wtg').value;
          var wbridge_wtg = document.getElementById('wbridge_wtg').value;
          
          //no.of bags (empty)
          //var bags_empty = Math.ceil((bags_rec * empty_bag_wt)).valueOf(); 
          //no.of bags (bag_wtg)
          //var bags_weight = Math.ceil((bags_rec * bag_wt)); 
          //document.getElementById('bags_weight').value = bags_weight;
      
          var wbridge_diff = Math.abs((net_wtg) - (wbridge_wtg)); 
          document.getElementsByName("wbridge_diff")[0].value = wbridge_diff;
        } 
                
    </script>

    

      <div class="col-md-4 mb-3">
        <label for="validationDefault03" class="info">Remarks</label><span
              id="remarks-info" class="info"></span>
        <input type="text" class="form-control demoInputBox" id="remarks" name= "remarks" placeholder="Remarks" value="<?php echo $row1['remarks']; ?>">
      </div> 
    </div>
  </div>    
  <div class="container">
    <div class="col-md-4 mb-3">
        <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Update Stock</button>
        <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../stock_mgmt/inwardstock/cInwardstock.php">Cancel</a></button> 
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

    if(!$("#received_date").val()) {
        $("#received_date-info").html("(required)");
        $("#received_date").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#invoice_no").val()) {
        $("#invoice_no-info").html("(required)");
        $("#invoice_no").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#invoice_date").val()) {
        $("#invoice_date-info").html("(required)");
        $("#invoice_date").css('background-color','#FFFFDF');
        valid = false;
    }
   
    if(!$("#miller_id").val()) {
          $("#miller_id-info").html("(required)");
          $("#miller_id").css('background-color','#FFFFDF');
          valid = false;
      }
      if(!$("#commodity_id").val()) {
          $("#commodity_id-info").html("(required)");
          $("#commodity_id").css('background-color','#FFFFDF');
          valid = false;
      }

      if(!$("#mod_transport").val()) {
          $("#mod_transport-info").html("(required)");
          $("#mod_transport").css('background-color','#FFFFDF');
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


      if(!$("#inward_bags_stock").val()) {
          $("#inward_bags_stock-info").html("(required)");
          $("#inward_bags_stock").css('background-color','#FFFFDF');
          valid = false;
      }

      if(!$("#inward_net_wt").val()) {
          $("#inward_net_wt-info").html("(required)");
          $("#inward_net_wt").css('background-color','#FFFFDF');
          valid = false;
      }

      if(!$("#inward_wb_gross_wt").val()) {
          $("#inward_wb_gross_wt-info").html("(required)");
          $("#inward_wb_gross_wt").css('background-color','#FFFFDF');
          valid = false;
      }

      if(!$("#inward_wb_net_wt").val()) {
          $("#inward_wb_net_wt-info").html("(required)");
          $("#inward_wb_net_wt").css('background-color','#FFFFDF');
          valid = false;
      }
    
      if(!$("#inward_diff_gross").val()) {
          $("#inward_diff_gross-info").html("(required)");
          $("#inward_diff_gross").css('background-color','#FFFFDF');
          valid = false;
      }


      if(!$("#inward_diff_net").val()) {
          $("#inward_diff_net-info").html("(required)");
          $("#inward_diff_net").css('background-color','#FFFFDF');
          valid = false;
      }

      if(!$("#current_bags_stock").val()) {
          $("#current_bags_stock-info").html("(required)");
          $("#current_bags_stock").css('background-color','#FFFFDF');
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