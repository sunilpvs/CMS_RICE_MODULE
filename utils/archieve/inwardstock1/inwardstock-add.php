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
            id="gst_number-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="gst_number" name= "gst_number" placeholder="gst_number" required>
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
      <label for="validationDefault03" class="info">Compartment Name</label><span id="warehouse_id-info" class="info"></span>
      <select id="compartment_id" name="compartment_id" class="form-control demoInputBox">
          <?php
              $gen = new Generic();
              $result = $gen->getCompartmentList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option value=<?php echo $row['id']; ?>> <?php echo $row["compartment_name"];?></option>
          <?php   } 
              }
          ?>         
      </select>
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
     
    <!--<div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Bag Mark</label><span id="bag_mark-info" class="info"></span>
        <select id="bag_mark" name="bag_mark" class="form-control demoInputBox">
          <?php
              $gen = new Generic();
              $result = $gen->getBagMarkList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option value=<?php echo $row['id']; ?>> <?php echo $row["name"] ?></option>
          <?php   } 
              }
          ?>         
      </select>
    </div> -->
    
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
      <label for="validationDefault03" class="info">Bag weight</label><span
            id="bag_wtg-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="bag_wtg" name= "bag_wtg" placeholder="Bag weight" required>
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
      <input type="text" class="form-control demoInputBox" id="net_wtg" name= "net_wtg" placeholder="Weighbridge weight" required>
    </div>
   
</div>
</div>

    
  <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../rice_module/inwardstock/cInwardstock.php">Cancel</a></button> 
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
    
    if(!$("#Lease_obj").val()) {
        $("#Lease_obj-info").html("(required)");
        $("#Lease_obj").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#Contract_id").val()) {
        $("#Contract_id-info").html("(required)");
        $("#Contract_id").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#Customer_id").val()) {
        $("#Customer_id-info").html("(required)");
        $("#Customer_id").css('background-color','#FFFFDF');
        valid = false;
    }
   
    if(!$("#Commenced_Date").val()) {
        $("#Commenced_Date-info").html("(required)");
        $("#Commenced_Date").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#Complete_Date").val()) {
        $("#Complete_Date-info").html("(required)");
        $("#Complete_Date").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#Capacity_Mton").val()) {
        $("#Capacity_Mton-info").html("(required)");
        $("#Capacity_Mton").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#RateDay").val()) {
        $("#RateDay-info").html("(required)");
        $("#RateDay").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#Commodity_Type").val()) {
        $("#Commodity_Type-info").html("(required)");
        $("#Commodity_Type").css('background-color','#FFFFDF');
        valid = false;
    }
  
    if(!$("#Contact_Days").val()) {
        $("#Contact_Days-info").html("(required)");
        $("#Contact_Days").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#Total_Cost").val()) {
        $("#Total_Cost-info").html("(required)");
        $("#Total_Cost").css('background-color','#FFFFDF');
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