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
      <label for="validationDefault01" class="info">Customer</label><span
            id="customer-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="customer" name= "customer" placeholder="Customer" value="<?php echo $row1["customer"]; ?>" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Warehouse</label><span
            id="warehouse-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="warehouse" name= "warehouse" placeholder="Warehouse" value="<?php echo $row1["warehouse"]; ?>" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Compartment</label><span
            id="compartment-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="compartment" name= "compartment" placeholder="Compartment" value="<?php echo $row1["compartment"]; ?>" required>
    </div>
       <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Commodity</label><span
            id="commodity-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="commodity" name= "commodity" placeholder="Commodity" value="<?php echo $row1["commodity"]; ?>" required>
    </div>
  <div class="col-md-3 mb-3">
    <label for="validationDefault01" class="info">Inward Transport</label><span id="transport-info" class="info"></span>
    <input type="text" class="form-control demoInputBox" id="transport" name= "transport" placeholder="Transport" readonly>
  </div>

    <div class="col-md-3 mb-3">
    <label for="validationDefault01" class="info">Empty Bag Weight</label><span id="empty_bag_wt-info" class="info"></span>
    <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="empty_bag_wt" name= "empty_bag_wt" min="0" max="1000" step="0.001" placeholder="00.00" value="<?php echo $row1["empty_bag_wt"]; ?>" required>
  </div>

  <div class="col-md-3 mb-3">
    <label for="validationDefault01" class="info">Bag Weight</label><span id="bag_wt-info" class="info"></span>
    <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="bag_wt" name= "bag_wt" placeholder="Bag Weight" value="<?php echo $row1["bag_wt"]; ?>" required>
  </div>

  <div class="col-md-3 mb-3">
      <label for="validationDefault01" class="info">Inward Bags Count</label><span id="inward_bags_count-info" class="info"></span>
      <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="inward_bags_count" name= "inward_bags_count" min="0" max="1000" step="0.01" placeholder="00.00" value="<?php echo $row1["inward_bags_count"]; ?>" required>
  </div>

  <div class="col-md-3 mb-3">
    <label for="validationDefault01" class="info">Current Bags Stock</label><span id="current_bags_stock-info" class="info"></span>
    <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="current_bags_stock" name= "current_bags_stock" placeholder="00.00" value="<?php echo $row1["current_bags_stock"]; ?>" required>
  </div>

  <div class="col-md-3 mb-3">
    <label for="validationDefault01" class="info">Outward Bags Count</label><span id="outward_bags_count-info" class="info"></span>
    <input type="number" onKeyDown="return/[0-9]/i.test(event.key)"  class="form-control demoInputBox" id="outward_bags_count" name= "outward_bags_count" min="0" max="1000" step="0.01" placeholder="00.00" value="<?php echo $row1["outward_bags_count"]; ?>" required>
  </div>

  <div class="col-md-3 mb-3">
      <label for="validationDefault01" class="info">Outward Date</label><span id="outward_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="outward_date" name= "outward_date" placeholder="dd-mmm-yyyy" value="<?= date('Y-m-d') ?>" value="<?php echo $row1["outward_date"]; ?>" required>
    </div>
    
    <div class="col-md-3 mb-3">
      <label for="validationDefault02" class="info">DC Number</label><span id="dc_no-info" class="info"></span>
      <input type="text" onKeyDown="return/[a-z0-9.⌦←→⌫-]/i.test(event.key)" class="form-control demoInputBox" id="dc_no" name= "dc_no" placeholder="DC Number" value="<?php echo $row1["dc_no"]; ?>" required>
    </div>

    <div class="col-md-3 mb-3">
      <label for="validationDefault02" class="info">DC Date</label><span id="dc_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="dc_date" name= "dc_date" placeholder="dd-mmm-yyyy" value="<?= date('Y-m-d') ?>" value="<?php echo $row1["dc_date"]; ?>"required>
    </div>

    <div class="col-md-3 mb-3">
     <label for="validationDefault03" class="info">Outward Bags Stock</label><span id="bags_out-info" class="info"></span>
     <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="bags_out" name="bags_out" placeholder="00" value="<?php echo $row1["bags_out"]; ?>" required>
    </div>



    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Vehicle Number</label><span
            id="vehicle_no-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="vehicle_no" name= "vehicle_no" placeholder="Vehicle Number" value="<?php echo $row1["vehicle_no"]; ?>" required>
    </div>

     <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Delivery-particulars</label><span
            id="delivery_dtl-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="delivery_dtl" name= "delivery_dtl" placeholder="Delivery Details" value="<?php echo $row1["delivery_dtl"]; ?>" required>
    </div>
     
       
   <div class="col-md-3 mb-3">

    <label for="validationDefault03" class="info">Bag Gross Weight</label><span id="outward_gross_wt-info" class="info"></span>
      <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="outward_gross_wt" name= "outward_gross_wt" min="0" max="99999999" placeholder="0.00" step="0.001" value="00.00" value="<?php echo $row1["outward_gross_wt"]; ?>">
    </div> 
  
    <div class="col-md-3 mb-3">
      <label for="validationDefault03" class="info">Weightbridge Gross Weight</label><span id="outward_wb_gross_wt-info" class="info"></span>
      <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="outward_wb_gross_wt" name= "outward_wb_gross_wt" min="0" max="99999999" placeholder="0.00" step="0.001" value="00.00" value="<?php echo $row1["outward_wb_gross_wt"]; ?>">
    </div>

    <div class="col-md-3 mb-3">
      <label for="validationDefault03" class="info">Gross Weight Difference</label><span id="outward_diff_gross-info" class="info"></span>
      <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="outward_diff_gross" name= "outward_diff_gross" min="0" max="99999999" placeholder="0.00" step="0.001" value="00.00"  value="<?php echo $row1["outward_diff_gross"]; ?>">
    </div> 

    <div class="col-md-3 mb-3">
      <label for="validationDefault03" class="info">Bag Net Weight</label><span id="outward_net_wt-info" class="info"></span>
      <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="outward_net_wt" name= "outward_net_wt" min="0" max="99999999" placeholder="0.00" step="0.001" value="00.00" value="<?php echo $row1["outward_net_wt"]; ?>">
    </div> 

    
    <div class="col-md-3 mb-3">
      <label for="validationDefault03" class="info">Weightbridge Net Weight</label><span id="outward_wb_net_wt-info" class="info"></span>
      <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="outward_wb_net_wt" name= "outward_wb_net_wt" min="0" max="99999999" placeholder="0.00" step="0.001" value="00.00" value="<?php echo $row1["outward_wb_net_wt"]; ?>">
    </div> 

    <div class="col-md-3 mb-3">
      <label for="validationDefault03" class="info">Net Weight Difference</label><span id=" outward_diff_net-info" class="info"></span>
      <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="outward_diff_net" name= "outward_diff_net" min="0" max="99999999" placeholder="0.00" step="0.001" value="00.00" value="<?php echo $row1["outward_diff_net"]; ?>">
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
    if($("#bags_out").val()<=0) {
        $("#bags_out-info").html("(required)");
        $("#bags_out").css('background-color','#FFFFDF');
        valid = false;
    }
   
    if(!$("#delivery_dtl").val()) {
        $("#delivery_dtl-info").html("(required)");
        $("#delivery_dtl").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#outward_gross_wt").val()) {
          $("#outward_gross_wt-info").html("(required)");
          $("#outward_gross_wt").css('background-color','#FFFFDF');
          valid = false;
      }

      if(!$("#outward_net_wt").val()) {
          $("#outward_net_wt-info").html("(required)");
          $("#outward_net_wt").css('background-color','#FFFFDF');
          valid = false;
      }

      if(!$("#outward_wb_gross_wt").val()) {
          $("#outward_wb_gross_wt-info").html("(required)");
          $("#outward_wb_gross_wt").css('background-color','#FFFFDF');
          valid = false;
      }

      if(!$("#outward_wb_net_wt").val()) {
          $("#outward_wb_net_wt-info").html("(required)");
          $("#outward_wb_net_wt").css('background-color','#FFFFDF');
          valid = false;
      }
    
      if(!$("#outward_diff_gross").val()) {
          $("#outward_diff_gross-info").html("(required)");
          $("#outward_diff_gross").css('background-color','#FFFFDF');
          valid = false;
      }

      if(!$("#outward_diff_net").val()) {
          $("#outward_diff_net-info").html("(required)");
          $("#outward_diff_net").css('background-color','#FFFFDF');
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
//include($_SERVER['DOCUMENT_ROOT'] .'/includes/scripts.php');
//include($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.php');
include('../../includes/scripts.php');
include('../../includes/footer.php');
?>