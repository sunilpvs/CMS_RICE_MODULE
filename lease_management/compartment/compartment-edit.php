<?php 
    date_default_timezone_set('Asia/Kolkata');
    #require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
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
    <h3 class="m-0 font-weight-bold text-primary">Edit Compartment Details </h3>
  </div>

<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">

  <div class="container">
  <div class="form-row">  
  <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Warehouse</label><span id="warehouse_id-info" class="info"></span>
      <select id="warehouse_id" name="warehouse_id" class="form-control demoInputBox" onchange="myLoadFunction()">
        <option value = -1>Select Warehouse</option>
          <?php
              $gen = new Generic();
              $result = $gen->getOutwardleaseCombo();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option   data-customer_name= <?php echo $row['customer_name']; ?> data-lease_model= <?php echo $row['lease_model']; ?> 
                    data-lease_start= <?php echo $row['lease_start']; ?> data-lease_end= <?php echo $row['lease_end']; ?>
                    data-lease_capacity_sqft= <?php echo $row['lease_capacity_sqft']; ?> data-daily_rate_sqft= <?php echo $row['daily_rate_sqft']; ?>
                    data-cost_sqft= <?php echo $row['cost_sqft']; ?> data-lease_capacity_mton= <?php echo $row['lease_capacity_mton']; ?>
                    data-daily_rate_mton= <?php echo $row['daily_rate_mton']; ?> data-cost_mton= <?php echo $row['cost_mton']; ?> 
                    data-lease_days= <?php echo $row['lease_days'];  ?> data-total_cost= <?php echo $row['total_cost']; ?> 
                    value=<?php echo $row['id']; ?>> <?php echo $row["warehouse_name"];?></option>
          <?php   } 
              }                
          ?>         
      </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Customer Name</label><span id="customer_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="customer_name" name= "customer_name" placeholder="Customer Name" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Lease Model</label><span id="lease_model-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="lease_model" name= "lease_model" placeholder="Lease Model" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Lease Start</label><span id="lease_start-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="lease_start" name= "lease_start" placeholder="lease_start" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Lease End</label><span id="lease_end-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="lease_end" name= "lease_end" placeholder="lease_end" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Lease Capacity Sqft</label><span id="lease_capacity_sqft-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="lease_capacity_sqft" name= "lease_capacity_sqft" placeholder="contract_id" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Daily Rate Sqft</label><span id="daily_rate_sqft-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="daily_rate_sqft" name= "daily_rate_sqft" placeholder="daily_rate_sqft" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">cost Sqft</label><span id="cost_sqft-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="cost_sqft" name= "cost_sqft" placeholder="cost_sqft" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Lease Capacity Mton</label><span id="lease_capacity_mton-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="lease_capacity_mton" name= "lease_capacity_mton" placeholder="lease_capacity_mton" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Daily Rate Mton</label><span id="daily_rate_mton-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="daily_rate_mton" name= "daily_rate_mton" placeholder="daily_rate_mtonState" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">cost Mton</label><span id="cost-mton-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="cost_mton" name= "cost_mton" placeholder="cost_mton" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">lease_days</label><span id="lease_days-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="lease_days" name= "lease_days" placeholder="lease_days" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Total Cost</label><span id="total_cost-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="total_cost" name= "total_cost" placeholder="total-cost" disabled>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

      function myLoadFunction()
      {
        //id,warehouse_name,code,lessor_name,ltype,capacity_sqft,capacity_mton,contract_id,start_date,expiry_date,city,state,contact,email,mobile
        var index = document.getElementById("outwardlease_id").selectedIndex;
        var customer_name = document.getElementById("outwardlease_id").options[index].getAttribute("data-customer_name");
        var lease_start = document.getElementById("outwardlease_id").options[index].getAttribute("data-lease_start");
        var lease_end = document.getElementById("outwardlease_id").options[index].getAttribute("data-lease_end");
        var lease_capacity_sqft = document.getElementById("outwardlease_id").options[index].getAttribute("data-lease_capacity_sqft");
        var daily_rate_sqft = document.getElementById("outwardlease_id").options[index].getAttribute("data-daily_rate_sqft");
        var cost_sqft = document.getElementById("outwardlease_id").options[index].getAttribute("data-cost_sqft");
        var lease_capacity_mton = document.getElementById("outwardlease_id").options[index].getAttribute("data-lease_capacity_mton");
        var daily_rate_mton = document.getElementById("outwardlease_id").options[index].getAttribute("data-daily_rate_mton");
        var cost_mton = document.getElementById("outwardlease_id").options[index].getAttribute("data-cost_mton");
        var lease_days = document.getElementById("outwardlease_id").options[index].getAttribute("data-lease_days");
        var total_cost = document.getElementById("outwardlease_id").options[index].getAttribute("data-total_cost");

        document.getElementsByName("customer_name ")[0].value = customer_name;
        document.getElementsByName("lease_start")[0].value = lease_start;
        document.getElementsByName("lease_end")[0].value = lease_end;
        document.getElementsByName("lease_capacity_sqft ")[0].value = lease_capacity_sqft ;
        document.getElementsByName("daily_rate_sqft")[0].value = daily_rate_sqft;
        document.getElementsByName("cost_sqft")[0].value = cost_sqft;
        document.getElementsByName("lease_capacity_mton")[0].value = lease_capacity_mton;       
        document.getElementsByName("daily_rate_mton")[0].value = daily_rate_mton;
        document.getElementsByName("cost_mton")[0].value = cost_mton;
        document.getElementsByName("lease_days")[0].value = lease_days;
        document.getElementsByName("total_cost")[0].value = total_cost;
        
      }
    </script>

  </div>
  
  
  
  <div class="form-row">
    <div class="col-md-3 mb-3">
      <label for="validationDefault03" class="info">Compartment Name</label><span id="capacity_sqft-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="compartment_id" name= "compartment_id" placeholder="Compartment Name" value="<?php echo $row1["compartment_id"];?>" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationDefault03" class="info">Capacity Sqft</label><span id="capacity_sqft-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="capacity_sqft" name= "capacity_sqft" placeholder="Capacity Sqft" value="<?php echo $row1["capacity_sqft"];?>" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationDefault03" class="info">Capacity Mton</label><span id="capacity_mton-info" class="info"></span>
       <input type="number" class="form-control demoInputBox" id="capacity_mton" name= "capacity_mton" placeholder="Capacity Mton" value="<?php echo $row1["capacity_mton"];?>" required>
    </div>
    <div class="col-md-3 mb-3">
                <label for="validationDefault10" class="info">Status</label><span id="status-info" class="info"></span>
                <select id="status" name="status" class="form-control demoInputBox">
                    <option value="A" <?php if($row1["status"] == "A"){ echo "Selected";} ?> >Active</option>    
                    <option value="D" <?php if($row1["status"] == "D"){ echo "Selected";} ?>>De-Active</option>   
                </select>
     </div>
   
</div>
</div>
</div>
    
       <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../lease_management/compartment/cCompartment.php">Cancel</a></button> 
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
    if(!$("#compartment_id").val()) {
        $("#compartment_id-info").html("(required)");
        $("#compartment_id").css('background-color','#FFFFDF');
        valid = false;
    } 
    						
    if(!$("#warehouse_id").val()) {
        $("#warehouse_id-info").html("(required)");
        $("#warehouse_id").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#capacity_sqft").val()) {
        $("#capacity_sqft-info").html("(required)");
        $("#capacity_sqft").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#capacity_mton").val()) {
        $("#capacity_mton-info").html("(required)");
        $("#capacity_mton").css('background-color','#FFFFDF');
        valid = false;
    }
    
    if(!$("#status").val()) {
        $("#status-info").html("(required)");
        $("#status_type").css('background-color','#FFFFDF');
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
 