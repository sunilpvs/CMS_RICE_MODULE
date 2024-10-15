<?php 
    date_default_timezone_set('Asia/Kolkata');
   # require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/bulk_ops/inwardstock/Inwardstock.php');
        include('../../includes/header.php'); 
include('../../includes/navbar.php');
    if (!empty($result)){
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Edit Lease Details
            
    </h3>
  </div>

<div class="card-body">

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">

    <div class="container">
    <div class="form-row">
 
        <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Lease_obj</label><span
            id="Lease_obj-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="Lease_obj" name= "Lease_obj" placeholder="Lease_obj" value="<?php echo $row1["Lease_obj"]; ?>" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Contract_id</label><span
            id="Contract_id-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="Contract_id" name= "Contract_id" placeholder="Contract_id" value="<?php echo $row1["Contract_id"]; ?>" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Customer_id</label><span
            id="Customer_id-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="Customer_id" name= "Customer_id" placeholder="Customer_id" value="<?php echo $row1["Customer_id"]; ?>" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Commenced_Date</label><span
            id="Commenced_Date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="Commenced_Date" name= "Commenced_Date" placeholder="Commenced_Date" value="<?php echo $row1["Commenced_Date"]; ?>" required>
    </div>
    
    
   <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Complete_Date</label><span
            id="Complete_Date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="Complete_Date" name= "Complete_Date" placeholder="Complete_Date" value="<?php echo $row1["Complete_Date"]; ?>" required>
    </div> 
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Capacity_Mton</label><span
            id="Capacity_Mton-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="Capacity_Mton" name= "Capacity_Mton" placeholder="Capacity_Mton" value="<?php echo $row1["Capacity_Mton"]; ?>" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Rate/Day</label><span
            id="RateDay-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="RateDay" name= "RateDay" placeholder="RateDay" value="<?php echo $row1["RateDay"]; ?>" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Commodity_Type</label><span
            id="Commodity_Type-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="Commodity_Type" name= "Commodity_Type" placeholder="Commodity_Type" value="<?php echo $row1["Commodity_Type"]; ?>" required>
    </div>
   
   <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Contact_Days</label><span
            id="Contact_Days-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="Contact_Days" name= "Contact_Days" placeholder="Contact_Days" value="<?php echo $row1["Contact_Days"]; ?>" required>
    </div> 
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Total_Cost</label><span
            id="Total_Cost-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="Total_Cost" name= "Total_Cost" placeholder="Total_Cost" value="<?php echo $row1["Total_Cost"]; ?>" required>
    </div> 
   
</div>
</div>

    
  <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Update Record</button>
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
        $("#RateDay_Sft").css('background-color','#FFFFDF');
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