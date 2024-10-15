<?php 
    date_default_timezone_set('Asia/Kolkata');
    #require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
    include('../../includes/header.php'); 
    include('../../includes/navbar.php'); 
    include('../../includes/Generic.php');

?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">New InwardStock Details
            
    </h3>
  </div>

<div class="card-body">

<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">

  <div class="container">
  <div class="form-row">
  
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Outward date</label><span
            id="outward_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="outward_date" name= "outward_date" placeholder="outward_date" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">DC Number</label><span
            id="dc_number-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="dc_number" name= "dc_number" placeholder="DC Number"  required>
    </div>
        <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">DC Date</label><span
            id="dc_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="dc_date" name= "dc_date" placeholder="DC date"  required>
    </div>
    
    
   
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Godown Name</label><span
            id="godown_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="godown_name" name= "godown_name" placeholder="Godown Name" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Compartment Name</label><span
            id="compartment_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="compartment_name" name= "compartment_name" placeholder="Compartment Name" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Vehicle Number</label><span
            id="vehicle_no-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="vehicle_no" name= "vehicle_no" placeholder="Vehicle Number" required>
    </div>
   
   <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Cargo Details</label><span id="cargo_details-info" class="info"></span>
        <select id="cargo_details" name="cargo_details" class="form-control demoInputBox">
          <?php
              $gen = new Generic();
              $result = $gen->getCargoDetailsList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option value=<?php echo $row['id']; ?>> <?php echo $row["name"] ?></option>
          <?php   } 
              }
          ?>         
      </select>
    </div>
     
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Bag Mark</label><span
            id="bag_mark-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="bag_mark" name= "bag_mark" placeholder="Bag Mark" required>
    </div> 

    <div class="col-md-4 mb-3">
      
      <label for="validationDefault03" class="info">Bag Weight</label><span id="bag_wtg-info" class="info"></span>
        <select id="bag_wtg" name="bag_wtg" class="form-control demoInputBox">
          <?php
              $gen = new Generic();
              $result = $gen->getBagWeightList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option value=<?php echo $row['id']; ?>> <?php echo $row["weight"] ?></option>
          <?php   } 
              }
          ?>         
      </select>
    </div>
       
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">No.of bags out</label><span
            id="bags_out-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="bags_out" name= "bags_out" placeholder="No.of bags out" required>
    </div>
      
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Weighbridge weight</label><span
            id="wbridge_wtg-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="wbridge_wtg" name= "wbridge_wtg" placeholder="Weighbridge weight" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Net weight</label><span
            id="net_wtg-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="net_wtg" name= "net_wtg" placeholder="Net Weight" required>
    </div>
    <div class="col-md-4 mb-3">
      
      <label for="validationDefault03" class="info">Delivery Details</label><span id="deliveru_dtl-info" class="info"></span>
        <select id="deliveru_dtl" name="deliveru_dtl" class="form-control demoInputBox">
          <?php
              $gen = new Generic();
              $result = $gen->getDeliveryDetailsList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option value=<?php echo $row['id']; ?>> <?php echo $row["name"] ?></option>
          <?php   } 
              }
          ?>         
      </select>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Remarks</label><span
            id="remarks-info" class="info"></span>
      <p><input type="text" class="form-control demoInputBox" id="remarks" name= "remarks" placeholder="Remarks" required></p>
    </div>
   
</div>
</div>

    
  <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../bulk_ops/outwardstock/cOutwardstock.php">Cancel</a></button> 
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
    if(!$("#godown_name").val()) {
        $("#godown_name-info").html("(required)");
        $("#godown_name").css('background-color','#FFFFDF');
        valid = false;
    }
  
    if(!$("#compartment_name").val()) {
        $("#compartment_name-info").html("(required)");
        $("#compartment_name").css('background-color','#FFFFDF');
        valid = false;
    }

    if(!$("#vehicle_no").val()) {
        $("#vehicle_no-info").html("(required)");
        $("#vehicle_no").css('background-color','#FFFFDF');
        valid = false;
    }
    
    if(!$("#cargo_details").val()) {
        $("#cargo_details-info").html("(required)");
        $("#cargo_details").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#bag_mark").val()) {
        $("#bag_mark-info").html("(required)");
        $("#bag_mark").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#bag_wtg").val()) {
        $("#bag_wtg-info").html("(required)");
        $("#bag_wtg").css('background-color','#FFFFDF');
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