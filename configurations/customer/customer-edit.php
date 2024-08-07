<?php 
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/customer/Customer.php');
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
    <h3 class="m-0 font-weight-bold text-primary">Edit Customer Details
    </h3>
  </div>

<div class="card-body">

<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">

  <div class="container">
  <div class="form-row">
  
    <div class="col-md-4 mb-3"> 
      <label for="validationDefault01" class="info">Customer Name</label><span id="customer_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="customer_name" name= "customer_name" placeholder="Customer Name" value="<?php echo $row1["customer_name"]; ?>" required>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
	    $(document).ready(function()
	    {
        $("#customer_name").on("focusout",function()
        {
              var customer_id = $("#customer_id").val();  
              var customername = $("#customer_name").val();
		      $.ajax(
		      {
			      url:"check-customername-edit.php",
			      type:"POST",
			      data:{customer_id:customer_id,customer_name:customername},
			      success:function(mydata)
			      {
                $("#customer_name-info").html(mydata);
			      } 
		      }
		      )
        }
  
        )})
    </script> 
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Address1</label><span id="add1-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="add1" name= "add1" placeholder="Address1" value="<?php echo $row1["add1"]; ?>" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Address2</label><span id="add2-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="add2" name= "add2" placeholder="Address2" value="<?php echo $row1["add2"]; ?>" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">City</label><span id="city-info" class="info"></span>
      <select id="city" name="city" class="form-control demoInputBox">
        <?php
            $gen = new Generic();
            $result2 = $gen->getCityList();
            if (!empty($result2)) {
                while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                {   
        ?> 
        <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1['city']) { echo "Selected"; } ?> > <?php echo $row2["city"]; ?></option>
        <?php   } 
            }
        ?>         
    </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">State</label><span id="state-info" class="info"></span>
      <select id="state" name="state" class="form-control demoInputBox">
        <?php
            $gen = new Generic();
            $result2 = $gen->getStateList();
            if (!empty($result2)) {
                while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                {   
        ?> 
        <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1['state']) { echo "Selected"; } ?> > <?php echo $row2["state"]; ?></option>
        <?php   } 
            }
        ?>         
    </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Pincode</label><span id="pin-info" class="info"></span>
       <input type="text" class="form-control demoInputBox" id="pin" name= "pin" placeholder="Pincode" value="<?php echo $row1["pin"]; ?>" required>
    </div>
    
   <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Country</label><span id="country-info" class="info"></span>
      <select id="country" name="country" class="form-control demoInputBox">
        <?php
            $gen = new Generic();
            $result2 = $gen->getCountryList();
            if (!empty($result2)) {
                while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                {   
        ?> 
        <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1['country']) { echo "Selected"; } ?> > <?php echo $row2["country"]; ?></option>
        <?php   } 
            }
        ?>         
    </select>
    </div> 
    
    <div class="col-md-4 mb-3">
    <label for="validationDefault03" class="info">Primary Contact</label><span id="primary_contact-info" class="info"></span>
    <select id="primary_contact" name="primary_contact" class="form-control demoInputBox">
        <option value="-1">Select Contact</option>    
        <?php
            $gen = new Generic();
            $result2 = $gen->getCustomerContactList();
            if (!empty($result2)) {
                while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                {   
        ?> 
        <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1['primary_contact']) { echo "Selected"; } ?> > <?php echo $row2["contact"]; ?></option>
        <?php   } 
            }
        ?>         
    </select>
    </div>

    <div class="col-md-4 mb-3">
        <label for="validationDefault10" class="info">Status</label><span id="status-info" class="info"></span>
        <select id="status" name="status" class="form-control demoInputBox">
            <option value="A" <?php if($row1["status"] == "A"){ echo "Selected";} ?> >Active</option>    
            <option value="D" <?php if($row1["status"] == "D"){ echo "Selected";} ?>>De-Active</option>   
        </select>
    </div>

    <div class="col-md-4 mb-3">
         
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info"></label><span id="customer_id-info" class="info"></span>
      <input type="hidden" class="form-control demoInputBox" id="customer_id" name= "customer_id" placeholder="Commodity" value="<?php echo $row1["id"]; ?>">
    </div>
</div>
</div>
    
 <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Update Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../configurations/customer/cCustomer.php">Cancel</a></button> 
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

    if(!$("#customer_name").val()) {
        $("#customer_name-info").html("(required)");
        $("#customer_name").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#add1").val()) {
        $("#add1-info").html("(required)");
        $("#add1").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#add2").val()) {
        $("#add2-info").html("(required)");
        $("#add2").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#city").val()) {
        $("#city-info").html("(required)");
        $("#city").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#state").val()) {
        $("#state-info").html("(required)");
        $("#state").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#pin	").val()) {
        $("#pin-info").html("(required)");
        $("#pin	").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#country").val()) {
        $("#country-info").html("(required)");
        $("#country").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#primary_contact").val()) {
        $("#primary_contact-info").html("(required)");
        $("#primary_contact").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#status").val()) {
        $("#status-info").html("(required)");
        $("#status").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#customet_id").val()) {
        $("#customet_id-info").html("(required)");
        $("#customet_id").css('background-color','#FFFFDF');
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