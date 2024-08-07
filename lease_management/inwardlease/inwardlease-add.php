<?php 
    date_default_timezone_set('Asia/Kolkata');
include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Add Inward-Lease Details            
    </h3>
  </div>

<div class="card-body">

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">

<div class="container">
  <div class="form-row">   
       
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Warehouse</label><span id="warehouse_id-info" class="info"></span>
      <select id="warehouse_id" name="warehouse_id" class="form-control demoInputBox">
          <?php
              $gen = new Generic();
              $result = $gen->getWarehouseList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option value=<?php echo $row['id']; ?>> <?php echo $row["warehouse_name"];?></option>
          <?php   } 
              }
          ?>         
      </select>
    </div>

    <div class="col-md-4 mb-3"> 
      <label for="validationDefault03" class="info">Lease Type</label><span id="lease_type-info" class="info"></span>
      <select id="lease_type" name="lease_type" class="form-control demoInputBox">
          <?php
              $gen = new Generic();
              $result = $gen->getLeaseTypeList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option value=<?php echo $row['id']; ?>> <?php echo $row["ltype"];?></option>
          <?php   } 
              }
          ?>         
      </select>
    </div>
    
   <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Inward Lease Start Date</label><span id="start_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="start_date" name= "start_date" placeholder="dd-mmm-yyyy" value="<?= date('Y-m-d') ?>" required>
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Inward Lease Expiry Date</label><span id="expiry_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="expiry_date" name= "expiry_date" placeholder="dd-mmm-yyyy" value="<?= date('Y-m-d') ?>" required>
    </div>    
   
    <div class="col-md-4 mb-3"> 
      <label for="validationDefault03" class="info">Status</label><span id="status-info" class="info"></span>
      <select id="status" name="status" class="form-control demoInputBox">
          <?php
              $gen = new Generic();
              $result = $gen->getModStatusList("Lease");
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option value=<?php echo $row['id']; ?>> <?php echo $row["status"];?></option>
          <?php   } 
              }
          ?>         
      </select>
    </div>

</div>
</div>

    
  <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="/lease_management/inwardlease/cInwardlease.php">Cancel</a></button> 
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
       
    if(!$("#warehouse_id").val()) {
        $("#warehouse_id-info").html("(required)");
        $("#warehouse_id").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#lease_type").val()) {
        $("#lease_type-info").html("(required)");
        $("#lease_type").css('background-color','#FFFFDF');
        valid = false;
    }
   
    if(!$("#start_date").val()) {
        $("#start_date-info").html("(required)");
        $("#start_date").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#expiry_date").val()) {
        $("#expiry_date-info").html("(required)");
        $("#expiry_date").css('background-color','#FFFFDF');
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