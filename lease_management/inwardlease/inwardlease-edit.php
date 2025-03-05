<?php 
    date_default_timezone_set('Asia/Kolkata');
    #require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/inwardlease/Inwardlease.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');

    if (!empty($result))
    {
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Inward Lease Extension            
    </h3>
  </div>
<div class="card-body">

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
<div class="container">
  <div class="form-row">    
       
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Warehouse</label><span id="warehouse-info" class="info"></span>
      <input type="hidden" class="form-control demoInputBox" id="lease_id" name= "lease_id" value="<?php echo $row1["id"]; ?>" >
      <input type="hidden" class="form-control demoInputBox" id="warehouse_id" name= "warehouse_id" value="<?php echo $row1["warehouse_id"]; ?>" >
      <input type="hidden" class="form-control demoInputBox" id="status" name= "status" value="5">
      <input type="hidden" class="form-control demoInputBox" id="lease_type" name= "lease_type" value="2">
      <input type="text" class="form-control demoInputBox" id="warehouse" name= "warehouse" placeholder="Warehouse" value="<?php echo $row1["warehouse_name"]; ?>" disabled>
    </div>
    
   <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Extension Start Date</label><span id="start_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="start_date" name= "start_date" placeholder="dd-mmm-yyyy" value="<?php echo $row1["start_date"]; ?>" required>
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Extension Expiry Date</label><span id="expiry_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="expiry_date" name= "expiry_date" placeholder="Lease Expiry Date" value="<?php echo $row1["end_date"]; ?>" required>
    </div>    

  </div>
</div>

<div class="container">
  <div class="col-md-4 mb-3">
      <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Update Record</button>
      <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../lease_management/inwardlease/cInwardlease.php">Cancel</a></button> 
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