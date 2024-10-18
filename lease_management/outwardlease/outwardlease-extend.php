<?php 
    date_default_timezone_set('Asia/Kolkata');
    #require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/outwardlease/Outwardlease.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
    if (!empty($result))
    {
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Outward Lease Extension            
    </h3>
  </div>
<div class="card-body">

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
<div class="container">
  <div class="form-row">    

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Lease Contract</label><span id="contract_id-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="contract_id" name= "contract_id" placeholder="contract_id" value="<?php echo $row1["lease_contract_id"]; ?>" disabled>
    </div>
  
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Warehouse</label><span id="warehouse-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="warehouse" name= "warehouse" placeholder="Warehouse" value="<?php echo $row1["warehouse_name"]; ?>" disabled>
    </div>
   
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Customer</label><span id="customer-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="customer" name= "customer" placeholder="Warehouse" value="<?php echo $row1["customer_name"]; ?>" disabled>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Lease Model</label><span id="lease_model-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="lease_model" name= "lease_model" placeholder="lease_model" value="<?php echo $row1["lease_model"]; ?>" disabled>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Lease Capacity(sqft)</label><span id="cap_sqft-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="cap_sqft" name= "cap_sqft" placeholder="cap_sqft" value="<?php echo $row1["lease_capacity_sqft"]; ?>" disabled>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Lease Capacity(Mton)</label><span id="cap_mton-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="cap_mton" name= "cap_mton" placeholder="cap_mton" value="<?php echo $row1["lease_capacity_mton"]; ?>" disabled>
    </div>

    <input type="hidden" class="form-control demoInputBox" id="lease_status" name= "lease_status" value="5">
    <input type="hidden" class="form-control demoInputBox" id="lease_type" name= "lease_type" value="2">      
    <input type="hidden" class="form-control demoInputBox" id="id" name= "id" value="<?php echo $row1["id"]; ?>" >
    <input type="hidden" class="form-control demoInputBox" id="warehouse_id" name= "warehouse_id" value="<?php echo $row1["warehouse_id"]; ?>" >

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Current Start Date</label><span id="prev_start-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="prev_start" name= "prev_start" placeholder="dd-mmm-yyyy" value="<?php echo $row1["start_date"]; ?>" disabled>
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Current End Date</label><span id="prev_end-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="prev_end" name= "prev_end" placeholder="dd-mmm-yyyy" value="<?php echo $row1["end_date"]; ?>" disabled>
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Lease Status</label><span id="status-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="status" name= "status" placeholder="status" value="<?php echo $row1["status"]; ?>" disabled>
    </div>

    <?php
        //$dt = new DateTime($row1["end_date"]); 
        //$dt->modify('+1 day');
        //$st_date = $dt->format('Y-m-d');
        
        //$original_date = $row1["end_date"];
        //$time_original = strtotime($original_date);
        //$time_add      = $time_original + (3600*24); //add seconds of one day
        //$st_date       = date("Y-m-d", $time_add);
        $dt = $row1["end_date"];
        $st_date = date('Y-m-d', strtotime("+1 day", strtotime($dt)))
    ?>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Extension Start Date</label><span id="start_date-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="start_date" name= "start_date" placeholder="dd-mmm-yyyy" min="<?php echo $dt; ?>" value="<?php echo $st_date; ?>">
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Extension Expiry Date</label><span id="expiry_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="end_date" name= "end_date" placeholder="dd-mmm-yyyy" value="<?= date('Y-m-d') ?>" required>
    </div>    

  </div>
</div>

<div class="container">
  <div class="col-md-4 mb-3">
      <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Extend Lease</button>
      <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../lease_management/outwardlease/cOutwardlease.php">Cancel</a></button> 
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
    
    if(!$("#end_date").val()) {
        $("#end_date-info").html("(required)");
        $("#end_date").css('background-color','#FFFFDF');
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