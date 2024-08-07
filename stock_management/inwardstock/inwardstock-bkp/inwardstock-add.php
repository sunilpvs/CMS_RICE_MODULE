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
      <label for="validationDefault01" class="info">Received date</label><span
            id="Received_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="Received_date" name= "Received_date" placeholder="Received_date" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Invoice Number</label><span
            id="invoice_number-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="invoice_number" name= "invoice_number" placeholder="invoice_number"  required>
    </div>
        <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Invoice Date</label><span
            id="invoice_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="invoice_date" name= "invoice_date" placeholder="invoice_date"  required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Miller Name</label><span
            id="miller_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="miller_name" name="miller_name" placeholder="miller_name" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Gst Number</label><span
            id="gst_no-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="gst_no" name= "gst_no" placeholder="Gst Number" required>
    </div>
    
    
   <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Place</label><span
            id="place-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="place" name= "place" placeholder="place" required>
    </div> 
  
    <div class="col-md-4 mb-3">
        <label for="validationDefault03" class="info">Mode of Transportation</label><span id="mod_transport-info" class="info"></span>
        <select id="mod_transport" name="mod_transport" class="form-control demoInputBox">
          <?php
              $gen = new Generic();
              $result = $gen->getTransportTypeList();
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
      <label for="validationDefault03" class="info">Vehicle Number</label><span
            id="vehicle_no-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="vehicle_no" name= "vehicle_no" placeholder="Vehicle Number" required>
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
      <label for="validationDefault03" class="info">No.of bags received</label><span
            id="bags_rec-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="bags_rec" name= "bags_rec" placeholder="No.of bags received" required>
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
      <label for="validationDefault03" class="info">Remarks</label><span
            id="remarks-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="remarks" name= "remarks" placeholder="Remarks" required>
    </div>
   
</div>
</div>

    
  <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../bulk_ops/inwardstock/cInwardstock.php">Cancel</a></button> 
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
   
    if(!$("#miller_name").val()) {
        $("#miller_name-info").html("(required)");
        $("#miller_name").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#gst_no").val()) {
        $("#gst_no-info").html("(required)");
        $("#gst_no").css('background-color','#FFFFDF');
        valid = false;
    }

    if(!$("#place").val()) {
        $("#place-info").html("(required)");
        $("#place").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#mode_transport").val()) {
        $("#mode_transport-info").html("(required)");
        $("#mode_transport").css('background-color','#FFFFDF');
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
    if(!$("#bags_rec").val()) {
        $("#bags_rec-info").html("(required)");
        $("#bags_rec").css('background-color','#FFFFDF');
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