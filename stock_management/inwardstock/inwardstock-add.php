<?php 
    date_default_timezone_set('Asia/Kolkata');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
?>
<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h3 class="m-0 font-weight-bold text-primary">New InwardStock Details</h3>
    </div>

<div class="card-body">
  <form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
  <div class="container">
  <div class="form-row">

    <div class="col-md-3 mb-3">
      <label for="validationDefault05" class="info">Customer</label><span id="customer-info" class="info"></span>
      <select id="customer" name="customer" class="form-control demoInputBox" onchange="getWarehouse(this.value);" required>
        <option value ="0" >Select Customer</option>
      <?php
            $gen = new Generic();
            $result = $gen->getCustomerList();
            foreach ($result as $customer) 
            {
      ?>
        <option value="<?php echo $customer["id"]; ?>"><?php echo $customer["customer_name"]; ?></option>
      <?php
            }
      ?>
      </select>
    </div> 

    <div class="col-md-3 mb-3">
      <label for="validationDefault05" class="info">Warehouse</label><span id="warehouse-info" class="info"></span>
      <select id="warehouse" name="warehouse" class="form-control demoInputBox" onchange="getCompartment();" required>
        <option value="0">Select Warehouse</option>    
      </select>
    </div>

    <div class="col-md-3 mb-3">
      <label for="validationDefault05" class="info">Compartment</label><span id="compartment-info" class="info"></span>
      <select id="compartment" name="compartment" class="form-control demoInputBox" required>
        <option value="0">Select Compartment</option>    
      </select>
    </div>

    <script src="../../assests/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script>
        function getWarehouse(val) {
            $.ajax({
                type: "POST",
                url: "../../stock_management/outwardstock/get_warehouse_outward.php",
                data:'customer='+val,
            success: function(data){
                $("#warehouse").html(data);
            }
            });
        }

        function getCompartment() {
            val=$("#warehouse").val();
            cval=$("#customer").val();
            $.ajax({
                type: "POST",
                url: "../../stock_management/outwardstock/get_compartment_outward.php",
                data:{customer:cval,warehouse:val},
            success: function(data){
                $("#compartment").html(data);
            }
            });
        }
    </script> 

    <div class="col-md-3 mb-3">
        <label for="validationDefault03" class="info">Commodity</label><span id="commodity_id-info" class="info"></span>
        <select id="commodity_id" name="commodity_id" class="form-control demoInputBox">
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
                      
                  value=<?php echo $row['id']; ?>> <?php echo $row["commodity"];?></option>
            <?php   } 
                }                
            ?>         
        </select>
    </div>

    <div class="col-md-4 mb-3">
        <label for="validationDefault03" class="info">Transportation Mode</label><span id="mod_transport-info" class="info"></span>
        <select id="mod_transport" name="mod_transport" class="form-control demoInputBox">
          <?php
              $gen = new Generic();
              $result = $gen->getTransportModeList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option value=<?php echo $row['id']; ?>> <?php echo $row["transport_mode"] ?></option>
          <?php   } 
              }
          ?>         
      </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Current Bags Stock</label><span id="current_bags_stock-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="current_bags_stock" name= "current_bags_stock" placeholder="0.00" readonly>
    </div> 
  
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Vehicle Number</label><span
            id="vehicle_no-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="vehicle_no" name= "vehicle_no" placeholder="Vehicle Number" required>
    </div> 


    <div class="form-row">

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Received date</label><span id="received_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="received_date" name= "received_date" placeholder="dd-mmm-yyyy" value="<?= date('Y-m-d') ?>" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Invoice Date</label><span id="invoice_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="invoice_date" name= "invoice_date" placeholder="dd-mmm-yyyy" value="<?= date('Y-m-d') ?>"  required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Invoice Number</label><span id="invoice_no-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="invoice_no" name= "invoice_no" placeholder="Invoice Number"  required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Miller Name</label><span id="miller_id-info" class="info"></span>
      <select id="miller_id" name="miller_id" class="form-control demoInputBox" onchange="myLoadMillerFunction()">
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
                    
                value=<?php echo $row['id']; ?>> <?php echo $row["miller_name"];?></option>
          <?php   } 
              }                
          ?>         
      </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">GST Number</label><span id="gst_num-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="gst_num" name= "gst_num" placeholder="GST Number" disabled>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Place</label><span id="ltype-info" class="place"></span>
      <input type="text" class="form-control demoInputBox" id="place" name= "place" placeholder="Place" disabled>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
      function myLoadMillerFunction()
      {
        //id,miller-name,gst_num,place
        var index = document.getElementById("miller_id").selectedIndex;
        var gst_num = document.getElementById("miller_id").options[index].getAttribute("data-gst_num");
        var place = document.getElementById("miller_id").options[index].getAttribute("data-place");

        document.getElementsByName("gst_num")[0].value = gst_num;
        document.getElementsByName("place")[0].value = place;  
      }

	    $(document).ready(function()
	    {
        $("#mod_transport").on("click",function()
        {
          var customer_id = $("#customer").val();
          var warehouse_id = $("#warehouse").val();
		      var compartment_id = $("#compartment").val();
          var commodity_id = $("#commodity_id").val();
          var trans_mod = $("#mod_transport").val();
		      $.ajax(
		      {
			      url:"getCurrentBagsStock.php",
			      type:"POST",
			      data:{customer_id:customer_id,warehouse_id:warehouse_id,compartment_id:compartment_id,commodity_id:commodity_id,mod_transport:trans_mod},
			      success:function(mydata)
			      {
              
              $("#current_bags_stock").val(mydata);  
			      } 
		      }
		      )
        }
  
        )})
    </script>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Inward Stock Received</label><span id="inward_bags_stock-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="inward_bags_stock" name= "inward_bags_stock" placeholder="No.of bags Stock" onchange="calculatecost()" required>
    </div>  

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Bag Gross Weight</label><span id="inward_gross_wt-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="inward_gross_wt" name= "inward_gross_wt" min="0" max="99999999" placeholder="0.00" step="0.001" value="00.00" onchange="calculatebagdifference()">
    </div> 
  
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Weightbridge Gross Weight</label><span id="inward_wb_gross_wt-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="inward_wb_gross_wt" name= "inward_wb_gross_wt" min="0" max="99999999" placeholder="0.00" step="0.001" value="00.00" onchange="calculatebridgedifference()">
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Gross Weight Difference</label><span id="inward_diff_gross-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="inward_diff_gross" name= "inward_diff_gross" min="0" max="99999999" placeholder="0.00" step="0.001" value="00.00"  readonly>
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Bag Net Weight</label><span id="inward_net_wt-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="inward_net_wt" name= "inward_net_wt" min="0" max="99999999" placeholder="0.00" step="0.001" value="00.00" onchange="calculatebagdifference()">
    </div> 

    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Weightbridge Net Weight</label><span id="inward_wb_net_wt-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="inward_wb_net_wt" name= "inward_wb_net_wt" min="0" max="99999999" placeholder="0.00" step="0.001" value="00.00" onchange="calculatebridgedifference()">
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Net Weight Difference</label><span id="	inward_diff_net-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="inward_diff_net" name= "inward_diff_net" min="0" max="99999999" placeholder="0.00" step="0.001" value="00.00"  readonly>
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
        document.getElementsByName("inward_diff_gross")[0].value = inward_diff_gross;
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
        document.getElementsByName("net_wtg")[0].value = netweight;
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
        document.getElementsByName("inward_diff_net")[0].value = inward_diff_net;
      } 
    </script>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Remarks</label><span
            id="remarks-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="remarks" name= "remarks" placeholder="Remarks">
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
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/scripts.php');
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.php');
?>