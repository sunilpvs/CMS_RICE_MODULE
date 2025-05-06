<?php 
  date_default_timezone_set('Asia/Kolkata');
  require_once($_SERVER['DOCUMENT_ROOT'] .'/stock_management/outwardstock/Outwardstock.php');
  include('../../includes/header.php'); 
  include('../../includes/navbar.php');
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
  
  if (!empty($result)){
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Edit Outward Stock</h3>
  </div>
<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
<div class="container">
  <div class="form-row">
 
    <div class="col-md-4 mb-4">
      <label for="validationDefault01" class="info">Customer</label><span id="customer-info" class="info"></span>
      <select id="customer" name="customer" class="form-control demoInputBox" onchange="getWarehouse(this.value);" required>
        <option value ="-1" >Select Customer</option>
      <?php
            $gen = new Generic();
            $result = $gen->getCustomerList();
            if (!empty($result)) {
                        while ($row2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
                        { 
      ?>
        <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1['customer_id']) { echo "Selected"; } ?>> <?php echo $row2["customer_name"] ?></option>
      <?php
                        }
            }
      ?>
      </select>
    </div>

    <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script>
      //global vars go here
      window.onload = function() {
        val=$("#customer").val();
        //alert("page load"+val);
        getWarehouse(val);
      }
    //rest of your logic and methods
      function getWarehouse(val) {
            var wval = 0;
            wval=<?php echo $row1['warehouse_id']; ?>;
            $.ajax({
                type: "POST",
                url: "../../stock_management/outwardstock/get_warehouse_outward.php",
                data:{customer:val,w_id:wval},
            success: function(data){
                $("#warehouse").html(data);
            }
            });
            getCompartment();
          }
    </script>

    <div class="col-md-4 mb-4">
      <label for="validationDefault05" class="info">Warehouse</label><span id="warehouse-info" class="info"></span>
      <select id="warehouse" name="warehouse" class="form-control demoInputBox" onchange="getCompartment();" required>
        <option value="-1">Select Warehouse</option>    
      </select>
    </div>

    <div class="col-md-4 mb-4">
      <label for="validationDefault05" class="info">Compartment</label><span id="compartment-info" class="info"></span>
      <select id="compartment" name="compartment" class="form-control demoInputBox" required>
        <option value="-1">Select Compartment</option>    
      </select>
    </div>

    <script>
        function getCompartment() {
            val=<?php echo $row1['warehouse_id']; ?>;
            cval=$("#customer").val();
            var wval = 0;
            wval=<?php echo $row1['compartment_id']; ?>;

            $.ajax({
                type: "POST",
                url: "../../stock_management/outwardstock/get_compartment_outward.php",
                data:{customer:cval,warehouse:val,compartment:wval},
                success: function(data){
                $("#compartment").html(data);
            }
            });
        }
    </script> 

    <div class="col-md-4 mb-4">
      <label for="validationDefault01" class="info">Transport Mode</label><span id="transport-info" class="info"></span>
      <select id="mod_transport" name="mod_transport" class="form-control demoInputBox">
        <option value = -1>Select Inward Transport</option>
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


    <div class="col-md-4 mb-4">
      <label for="validationDefault02" class="info">Commodity</label><span id="commodity-info" class="info"></span>
      <select id="commodity_id" name="commodity_id" class="form-control demoInputBox" onchange="getLatestStockFunction();" required>
        <option value = -1>Select Commodity</option>
        <?php
            $gen = new Outwardstock();
            $result = $gen->getOutwardstockcommodityList();
            if (!empty($result)) {
              while ($row2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
              {   
        ?> 
        <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1['commodity_id']) { echo "Selected"; } ?>> <?php echo $row2["commodity"] ?></option>   
        <?php } 
            }                
        ?>         
        </select> 
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
      function getLatestStockFunction()
      {
        //Check if Customer/Warehouse/Compartment/Inward Transport are selected if not raise alert.
          var customer_id = document.getElementById("customer").value;
          var warehouse_id = document.getElementById("warehouse").value;
          var compartment_id = document.getElementById("compartment").value;
          var transport_id = document.getElementById("mod_transport").value;
          var commodity_id = document.getElementById("commodity_id").value;

          //alert(customer_id+" "+warehouse_id+" "+compartment_id+" "+transport_id+" "+commodity_id);

          if(customer_id == -1 || warehouse_id == -1 || compartment_id == -1 || transport_id == -1 || commodity_id == -1)
          {
            alert("Please ensure to select customer, warehouse, compartment, transport.");
            $('#btnSubmit').prop('disabled',true);
          }
          else
          {
              $('#btnSubmit').prop('disabled',false);
              $.ajax({
                url: "getstock.php",
                method: "POST",
                data: {
                  customer_id:customer_id,
                  warehouse_id:warehouse_id,
                  compartment_id:compartment_id,
                  commodity_id:commodity_id,
                  transport_id:transport_id
                },
                success: function(response){
                  //alert(response);
                  response = JSON.parse(response);
                  //$('#inward_bags_count').val(response[0].bags_count);
                  $('#current_bags_stock').val(response[0].bags_count);
                  //$('#outward_bags_count').val(response[0].outward_bags_count);
                }
              })

          }

      }

    </script>    
    
    <div class="col-md-4 mb-4">
      <label for="validationDefault01" class="info">Transaction Date</label><span id="outward_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="outward_date" name= "outward_date" placeholder="dd-mmm-yyyy"  value="<?php echo $row1["trans_date"]; ?>" required>
    </div>

    <div class="col-md-4 mb-4">
      <label for="validationDefault02" class="info">DC Date</label><span id="dc_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="dc_date" name= "dc_date" placeholder="dd-mmm-yyyy" value="<?php echo $row1["dc_date"]; ?>"required>
    </div>
    
    <div class="col-md-4 mb-4">
      <label for="validationDefault02" class="info">DC Number</label><span id="dc_no-info" class="info"></span>
      <input type="text" onKeyDown="return/[a-z0-9.⌦←→⌫-]/i.test(event.key)" class="form-control demoInputBox" id="dc_no" name= "dc_no" placeholder="DC Number" value="<?php echo $row1["dc_no"]; ?>" required>
    </div>

    <div class="col-md-4 mb-4">
      <label for="validationDefault03" class="info">Vehicle Number</label><span
            id="vehicle_no-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="vehicle_no" name= "vehicle_no" placeholder="Vehicle Number" value="<?php echo $row1["vehicle_no"]; ?>" required>
    </div>

     <div class="col-md-4 mb-4">
      <label for="validationDefault03" class="info">Delivery-particulars</label><span
            id="delivery_dtl-info" class="info"></span>
       <select id="delivery_dtl" name="delivery_dtl" class="form-control demoInputBox">
          
      <option value = -1>Select Delivery Particulars</option>
          <?php
              $ins = new Outwardstock();
              $result = $ins->getDeliveryList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option value=<?php echo $row['id']; ?> <?php if($row['id'] == $row1['delivery_to']) { echo "Selected"; } ?>> <?php echo $row["name"] ?></option>
          <?php   } 
              }                
          ?>         
      </select>
    </div>

    <div class="col-md-3 mb-3">
      <label for="validationDefault01" class="info">Latest Bags Stock</label><span id="current_bags_stock-info" class="info"></span>
      <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="current_bags_stock" name= "current_bags_stock" placeholder="00.00" readonly>
    </div>

    <div class="col-md-4 mb-4">
     <label for="validationDefault03" class="info">Outward Bags Stock</label><span id="bags_out-info" class="info"></span>
     <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="bags_out" name="bags_out" placeholder="00" onchange="validateOutwardBagsCount()" value="<?php echo $row1["bags_stock"]; ?>" required>
     <input type="hidden" class="form-control demoInputBox" id="bags_out_ori" name="bags_out_ori" placeholder="00" value="<?php echo $row1["bags_stock"]; ?>">
    </div>

    <script>
      function validateOutwardBagsCount()
      {
        //var current_bags_stock = $("#current_bags_stock").val();
        //var bags_out= $("#bags_out").val();
        var current_bags_stock = Number.parseInt(document.getElementById("current_bags_stock").value,10);
        var bags_out_ori = Number.parseInt(document.getElementById("bags_out_ori").value,10);
        var bags_out = Number.parseInt(document.getElementById("bags_out").value,10);
        var allowed_count = current_bags_stock + bags_out_ori;
        //alert ("Entered Stock: "+bags_out);
        //alert ("Current Stock: "+current_bags_stock);
        
        if(bags_out>allowed_count)
        {
          alert("*Bags stock limit exceeded. Max allowed: "+allowed_count);
          document.getElementById("bags_out").value=0;
          $('#btnSubmit').prop('disabled',true);
        }
        else
        {
          $('#btnSubmit').prop('disabled',false);
        }
      }
    </script>
  </div>

   <div class="form-row">
    
    <div class="col-md-4 mb-4">
      <label for="validationDefault03" class="info">Gross Weight</label><span id="outward_gross_wt-info" class="info"></span>
      <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="outward_gross_wt" name= "outward_gross_wt" min="0" max="99999999" placeholder="0.00" step="0.001" onchange="calcGrossDiff()" value="<?php echo $row1["gross_wt"]; ?>">
    </div> 
    
    <div class="col-md-4 mb-4">
      <label for="validationDefault03" class="info">Weightbridge Gross Weight</label><span id="outward_wb_gross_wt-info" class="info"></span>
      <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="outward_wb_gross_wt" name= "outward_wb_gross_wt" min="0" max="99999999" placeholder="0.00" step="0.001" onchange="calcGrossDiff()" value="<?php echo $row1["wb_gross_wt"]; ?>">
    </div>

    <div class="col-md-4 mb-4">
      <label for="validationDefault03" class="info">Gross Weight Difference</label><span id="outward_diff_gross-info" class="info"></span>
      <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="outward_diff_gross" name= "outward_diff_gross" min="0" max="99999999" placeholder="0.00" step="0.001" value="<?php echo $row1["gross_diff"]; ?>" readonly>
    </div> 

    <script>
      function calcGrossDiff()
      {  
        var gross_wt = document.getElementById('outward_gross_wt').value;     
        var wb_gross_wt = document.getElementById('outward_wb_gross_wt').value;
        var gross_diff = Math.abs((wb_gross_wt) - (gross_wt)); 
        document.getElementsByName("outward_diff_gross")[0].value = gross_diff.toFixed(3);
      } 
    </script>

    <div class="col-md-4 mb-4">
      <label for="validationDefault03" class="info">Bag Net Weight</label><span id="outward_net_wt-info" class="info"></span>
      <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="outward_net_wt" name= "outward_net_wt" min="0" max="99999999" placeholder="0.00" step="0.001"  value="<?php echo $row1["net_wt"]; ?>" onchange="calcNetDiff()">
    </div> 

    <div class="col-md-4 mb-4">
      <label for="validationDefault03" class="info">Weightbridge Net Weight</label><span id="outward_wb_net_wt-info" class="info"></span>
      <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="outward_wb_net_wt" name= "outward_wb_net_wt" min="0" max="99999999" placeholder="0.00" step="0.001" value="<?php echo $row1["wb_net_wt"]; ?>" onchange="calcNetDiff()">
    </div> 

    <div class="col-md-4 mb-4">
      <label for="validationDefault03" class="info">Net Weight Difference</label><span id=" outward_diff_net-info" class="info"></span>
      <input type="number" onKeyDown="return/[a-z0-9.⌦←→⌫]/i.test(event.key)" class="form-control demoInputBox" id="outward_diff_net" name= "outward_diff_net" min="0" max="99999999" placeholder="0.00" step="0.001"  value="<?php echo $row1["net_diff"]; ?>" readonly>
    </div>

    <script>
        function calcNetDiff()
        {  
          var net_wt = document.getElementById('outward_net_wt').value;     
          var wb_net_wt = document.getElementById('outward_wb_net_wt').value;
          var net_diff = Math.abs((wb_net_wt) - (net_wt)); 
          document.getElementsByName("outward_diff_net")[0].value = net_diff.toFixed(3);
        } 
    </script>
  
    <div class="col-md-4 mb-4">
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