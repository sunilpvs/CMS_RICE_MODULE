<?php 
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/stock_management/inwardstock/Inwardstock.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
    
    if (!empty($result)){
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>
<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Edit Inwardstock Details</h3>
  </div>
<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
<div class="container">
  <div class="form-row">

    <div class="col-md-3 mb-3">
    <label for="validationDefault01" class="info">Customer</label><span id="customer-info" class="info"></span>
      <select id="customer" name="customer" class="form-control demoInputBox" required>
        <option value ="0" >Select Customer</option>
        <?php
            $gen = new Generic();
            $result = $gen->getCustomerList();
            if (!empty($result)) {
                        while ($row2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
                        { 
        ?>
        <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1['customer_id']) { $id = $row1['customer_id']; echo "Selected"; } ?>> <?php echo $row2["customer_name"] ?></option>
      <?php
                        }
            }
      ?>
      </select>
    </div>

    <div class="col-md-3 mb-3">
    <label for="validationDefault01" class="info">Warehouse</label><span id="warehouse-info" class="info"></span>
      <select id="warehouse" name="warehouse" class="form-control demoInputBox" required>
        <option value ="0" >Select warehouse</option>
        <?php
            $gen = new Generic();
            $result = $gen->getWarehouseByCustomer($id);
            if (!empty($result)) {
                        while ($row2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
                        { 
        ?>
        <option value=<?php echo $row2['warehouse_id']; ?> <?php if($row2['warehouse_id'] == $row1['warehouse_id']) {$id2=$row2['warehouse_id']; echo "Selected"; } ?>> <?php echo $row2["warehouse_name"] ?></option>
      <?php
                        }
            }
      ?>
      </select>
    </div>

    <div class="col-md-3 mb-3">
    <label for="validationDefault01" class="info">Compartment</label><span id="compartment-info" class="info"></span>
      <select id="compartment" name="compartment" class="form-control demoInputBox" required>
        <option value ="0" >Select Compartment</option>
        <?php
            $gen = new Generic();
            $result = $gen->getCompartmentByCustomerWarehouse($id, $id2);
            if (!empty($result)) {
                        while ($row2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
                        { 
        ?>
        <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1['compartment_id']) { echo "Selected"; } ?>> <?php echo $row2["compartment_name"] ?></option>
      <?php
                        }
            }
      ?>
      </select>
    </div>
   
    <div class="col-md-3 mb-3">
      <label for="validationDefault02" class="info">Commodity</label><span id="commodity-info" class="info"></span>
      <select id="commodity_id" name="commodity_id" class="form-control demoInputBox">
          <option value = -1>Select Commodity</option>
            <?php
                $gen = new Inwardstock();
                $result = $gen->getInwardstockcommodityList();
                if (!empty($result)) {
                    while ($row2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1['commodity_id']) { echo "Selected"; } ?>> <?php echo $row2["commodity"] ?></option>          
            <?php   } 
                }                
            ?>         
      </select>
    </div>

    <div class="col-md-3 mb-3">
      <label for="validationDefault02" class="info">Transportation Mode</label><span id="mod_transport-info" class="info"></span>
      <select id="mod_transport" name="mod_transport" class="form-control demoInputBox">
          <option value = -1>Select Transport Mode</option>
            <?php
                $gen = new Generic();
                $result = $gen->getTransportModeList();
                if (!empty($result)) {
                    while ($row2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
             <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1['mod_transport']) { echo "Selected"; } ?>> <?php echo $row2["transport_mode"] ?></option>                
            <?php   } 
                }                
            ?>         
      </select>
    </div>

    <div class="col-md-3 mb-3">
      <label for="validationDefault03" class="info">Vehicle Number</label><span id="vehicle_no-info" class="info"></span>
      <input type="text"  maxlength="10" onKeyDown="return/[a-z0-9⌦←→⌫-]/i.test(event.key)" class="form-control demoInputBox" id="vehicle_no" name= "vehicle_no" placeholder="Vehicle Number" value="<?php echo $row1['vehicle_no']; ?>" required>
    </div> 

    <div class="col-md-3 mb-3">
      <label for="validationDefault01" class="info">Received date</label><span id="received_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="received_date" name= "received_date" placeholder="dd-mmm-yyyy" value="<?php echo $row1['received_date']; ?>" required>
    </div>
    
    <div class="col-md-3 mb-3">
      <label for="validationDefault02" class="info">Invoice Date</label><span id="invoice_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="invoice_date" name= "invoice_date" placeholder="dd-mmm-yyyy" value="<?php echo $row1['invoice_date']; ?>" required>
    </div>

    <div class="col-md-3 mb-3">
      <label for="validationDefault02" class="info">Invoice Number</label><span id="invoice_no-info" class="info"></span>
      <input type="text"  maxlength="15" onKeyDown="return/[a-z0-9⌦←→⌫-]/i.test(event.key)"  class="form-control demoInputBox" id="invoice_no" name= "invoice_no" placeholder="Invoice Number" value="<?php echo $row1['invoice_no']; ?>" required>
    </div>

    <div class="col-md-3 mb-3">
      <label for="validationDefault01" class="info">Miller Name</label><span id="miller_id-info" class="miller_id"></span>
      <select id="miller_id" name="miller_id" class="form-control demoInputBox" onchange="myLoadMillerFunction()">
        <option value = -1>Select Miller</option>
          <?php
              $gen = new Inwardstock();
              $result = $gen->getInwardstockmillerList();
              if (!empty($result)) {
                  while ($row2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
        <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1['miller_id']) { echo "Selected"; } ?>> <?php echo $row2["miller_name"] ?></option>
          <?php   } 
              }                
          ?>         
      </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Inward Stock Received</label><span id="inward_bags_stock-info" class="info"></span>
      <input type="text" onkeypress="return validateNumberOnly(event);" class="form-control demoInputBox" id="inward_bags_stock" name= "inward_bags_stock"  min="0" max="99999999" placeholder="0.00" step="0.001" onchange="calculatecost()" value="<?php echo $row1['inward_bags_stock']; ?>" required>
    </div>  

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Inward Gross Weight</label><span id="inward_gross_wt-info" class="info"></span>
      <input type="text" onkeypress="return validateNumberOnly(event);" class="form-control demoInputBox" id="inward_gross_wt" name= "inward_gross_wt" min="0" max="99999999" placeholder="0.00" step="0.001"  value="<?php echo $row1['inward_gross_wt']; ?>">
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Inward Net Weight</label><span id="inward_net_wt-info" class="info"></span>
      <input type="text" onkeypress="return validateNumberOnly(event);" class="form-control demoInputBox" id="inward_net_wt" name= "inward_net_wt" min="0" max="99999999" placeholder="0.00" step="0.001" onchange="calculatebagdifference()" value="<?php echo $row1['inward_net_wt']; ?>">
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Inward Wt. Difference</label><span id="inward_diff_gross-info" class="info"></span>
      <input type="text" onkeypress="return validateNumberOnly(event);"  class="form-control demoInputBox" id="inward_diff_gross" name= "inward_diff_gross" min="0" max="99999999" placeholder="0.00" step="0.001" onchange="calculatebridgedifference()" value="<?php echo $row1['inward_diff_gross']; ?>" readonly>
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Weightbridge Gross Weight</label><span id="inward_wb_gross_wt-info" class="info"></span>
      <input type="text" onkeypress="return validateNumberOnly(event);" class="form-control demoInputBox" id="inward_wb_gross_wt" name= "inward_wb_gross_wt" min="0" max="99999999" placeholder="0.00" step="0.001" onchange="calculatebagdifference()" value="<?php echo $row1['inward_wb_gross_wt']; ?>">
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Weightbridge Net Weight</label><span id="inward_wb_net_wt-info" class="info"></span>
      <input type="text" onkeypress="return validateNumberOnly(event);" class="form-control demoInputBox" id="inward_wb_net_wt" name= "inward_wb_net_wt" min="0" max="99999999" placeholder="0.00" step="0.001" onchange="calculatebridgedifference()" value="<?php echo $row1['inward_wb_net_wt']; ?>" >
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">WB Weight Difference</label><span id=" inward_diff_net-info" class="info"></span>
      <input type="text" onkeypress="return validateNumberOnly(event);" class="form-control demoInputBox" id="inward_diff_net" name= "inward_diff_net" min="0" max="99999999" placeholder="0.00" step="0.001"  value="<?php echo $row1['inward_diff_net']; ?>" readonly>
    </div>
    
    <script>
      function calculatebagdifference()
      {  
        var inward_gross_wt = document.getElementById('inward_gross_wt').value;     
        var inward_net_wt = document.getElementById('inward_net_wt').value;
       
        //no.of bags (empty)
        //var bags_empty = Math.ceil((bags_rec * empty_bag_wt)).valueOf(); 
        //no.of bags (bag_wtg)
        //var bags_weight = Math.ceil((bags_rec * bag_wt)); 
        //document.getElementById('bags_weight').value = bags_weight;
        var inward_diff_gross = Math.abs((inward_gross_wt) - (inward_net_wt)); 
        document.getElementsByName("inward_diff_gross")[0].value = inward_diff_gross.toFixed(3);
      } 
    </script>


    <script>
      function calculatecost()
      { 
        var inward_bags_stock = document.getElementById('inward_bags_stock').value;
        var empty_bag_wt  = document.getElementById('empty_bag_wt').value;
        var bag_wt = document.getElementById('bag_wt').value;
        //no.of bags (empty)
        var bags_empty = Math.ceil((inward_bags_stock * empty_bag_wt)).valueOf(); 
        //no.of bags (bag_wtg)
        var bags_weight = Math.ceil((inward_bags_stock * bag_wt)); 
        //document.getElementById('bags_weight').value = bags_weight;
        var netweight = Math.abs((bags_empty) + (bags_weight)).valueOf(); 
        document.getElementsByName("net_wtg")[0].value = netweight.toFixed(3);
      }               
    </script>


    <script>
      function calculatebridgedifference()
      {       
        var inward_wb_gross_wt = document.getElementById('inward_wb_gross_wt').value;
        var inward_wb_net_wt = document.getElementById('inward_wb_net_wt').value;
        
        //no.of bags (empty)
        //var bags_empty = Math.ceil((bags_rec * empty_bag_wt)).valueOf(); 
        //no.of bags (bag_wtg)
        //var bags_weight = Math.ceil((bags_rec * bag_wt)); 
        //document.getElementById('bags_weight').value = bags_weight;
        var inward_diff_net = Math.abs((inward_wb_gross_wt) - (inward_wb_net_wt)); 
        document.getElementsByName("inward_diff_net")[0].value = inward_diff_net.toFixed(3);
      } 
    </script>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Remarks</label><span id="remarks-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="remarks" name= "remarks" placeholder="Remarks" value="<?php echo $row1['remarks']; ?>">
    </div>

    <div class="col-md-4 mb-3">
      <input type="hidden" class="form-control demoInputBox" id="inwardstock_id" name= "inwardstock_id" placeholder="inwardstock_id" value="<?php echo $row1["id"]; ?>">
      
      <input type="hidden" class="form-control demoInputBox" id="inward_bags_stock_ori" name= "inward_bags_stock_ori" placeholder="inward_bags_stock_ori" value="<?php echo $row1['inward_bags_stock']; ?>">
      <input type="hidden" class="form-control demoInputBox" id="inward_gross_wt_ori" name= "inward_gross_wt_ori" placeholder="inward_gross_wt_ori" value="<?php echo $row1["inward_gross_wt"]; ?>">
      <input type="hidden" class="form-control demoInputBox" id="inward_net_wt_ori" name= "inward_net_wt_ori" placeholder="inward_net_wt_ori" value="<?php echo $row1["inward_net_wt"]; ?>">
      <input type="hidden" class="form-control demoInputBox" id="inward_diff_gross_ori" name= "inward_diff_gross_ori" placeholder="inward_diff_gross_ori" value="<?php echo $row1["inward_diff_gross"]; ?>">
      <input type="hidden" class="form-control demoInputBox" id="inward_wb_gross_wt_ori" name= "inward_wb_gross_wt_ori" placeholder="inward_wb_gross_wt_ori" value="<?php echo $row1["inward_wb_gross_wt"]; ?>">
      <input type="hidden" class="form-control demoInputBox" id="inward_wb_net_wt_ori" name= "inward_wb_net_wt_ori" placeholder="inward_wb_net_wt_ori" value="<?php echo $row1["inward_wb_net_wt"]; ?>">
      <input type="hidden" class="form-control demoInputBox" id="inward_diff_net_ori" name= "inward_diff_net_ori" placeholder="inward_diff_net_ori" value="<?php echo $row1["inward_diff_net"]; ?>">      
    </div>

    </div>
  </div>    
  <div class="container">
    <div class="col-md-4 mb-3">
        <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Update Stock</button>
        <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../inwardstock/cInwardstock.php">Cancel</a></button> 
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
      if(!$("#compartment").val()) {
          $("#compartment-info").html("(required)");
          $("#compartment").css('background-color','#FFFFDF');
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

      if(!$("#inward_gross_wt").val()) {
          $("#inward_gross_wt-info").html("(required)");
          $("#inward_gross_wt").css('background-color','#FFFFDF');
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
      if(!$("#remarks").val()) {
          $("#remarks-info").html("(required)");
          $("#remarks").css('background-color','#FFFFDF');
          valid = false;
      }
       if(!$("#inwardstock_id").val()) {
        $("#inwardstock_id-info").html("(required)");
        $("#inwardstock_id").css('background-color','#FFFFDF');
        valid = false;
    }
    return valid;
}
</script>
</body>
</html>

<?php
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/scripts.php');
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.php');
?>