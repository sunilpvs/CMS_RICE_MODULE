<?php 
    date_default_timezone_set('Asia/Kolkata');
    include('../../includes/header.php'); 
    include('../../includes/navbar.php');
    include('../../includes/Generic.php'); 

    if (!empty($result)){
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>
  <div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Edit Contact Details
            
    </h3>
  </div>

<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">

  <div class="container">
  <div class="form-row">
  
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">First Name</label><span id="f_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="f_name" name= "f_name" placeholder="First Name" value="<?php echo $row1["f_name"]; ?>" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Last Name</label><span id="l_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="l_name" name= "l_name" placeholder="Last Name"  value="<?php echo $row1["l_name"]; ?>" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Date of Birth</label><span id="dob-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="dob" name= "dob" placeholder="Date of Birth" value="<?php echo $row1["dob"]; ?>">
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault04" class="info">Email</label><span id="email-info" class="info"></span>
      <input type="email" class="form-control demoInputBox" id="email" name= "email" placeholder="Email" value="<?php echo $row1["email"]; ?>" required>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
	    $(document).ready(function()
	    {
        $("#email").on("focusout",function()
        {
		    var contact_id = $("#contact_id").val();  
            var conemail = $("#email").val();
		      $.ajax(
		      {
			      url:"check-email-edit.php",
			      type:"POST",
			      data:{contact_id:contact_id,email:conemail},
			      success:function(mydata)
			      {
                $("#email-info").html(mydata);
			      } 
		      }
		      )
        }
  
        )})
    </script> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault05" class="info">Mobile</label><span id="mobile-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="mobile" name= "mobile" placeholder="Mobile" value="<?php echo $row1["mobile"]; ?>" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault06" class="info">Address1</label><span id="add1-info" class="info"></span>
      <input type="message" class="form-control demoInputBox" id="add1" name= "add1" placeholder="Add Ref1" value="<?php echo $row1["add1"]; ?>" required>
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault07" class="info">Address2</label><span id="add2-info" class="info"></span>
      <input type="message" class="form-control demoInputBox" id="add2" name= "add2" placeholder="Add2" value="<?php echo $row1["add2"]; ?>" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">City</label><span id="city-info" class="info"></span>
       <select id="city" name="city" class="form-control demoInputBox">
            <?php
                $gen = new Generic();
                $result2 = $gen->getCityList();
                if (!empty($result2)) {
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1["city"] ){ echo "Selected"; } ?> > <?php echo $row2["city"]; ?></option>
            <?php   } 
                }
            ?>
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
            <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1["state"] ){ echo "Selected"; } ?> > <?php echo $row2["state"]; ?></option>
            <?php   } 
                }
            ?>
            ?>   
        </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">pincode</label><span id="pin-info" class="info"></span>
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
            <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1["country"] ){ echo "Selected"; } ?> > <?php echo $row2["country"]; ?></option>
            <?php   } 
                }
            ?>
            ?>   
        </select>
    </div>
   
    <div class="col-md-4 mb-3">
    <label for="validationDefault05" class="info">Contact Type</label><span id="ctype-info" class="info"></span>
        <select id="ctype" name="ctype" class="form-control demoInputBox">
            <?php
                $gen = new Generic();
                $result2 = $gen->getContactTypeList();
                if (!empty($result2)) {
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1["ContactType_Id"] ){ echo "Selected"; } ?> > <?php echo $row2["ctype"]; ?></option>
            <?php   } 
                }
            ?>
            ?>   
        </select>
      </div>  
    <div class="col-md-4 mb-3">
      <input type="hidden" class="form-control demoInputBox" id="contact_id" name= "contact_id" placeholder="Contact_id" value="<?php echo $row1["id"]; ?>">
    </div>

</div>
</div>

    
   <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Update Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../user_management/contact/cContact.php">Cancel</a></button> 
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
    
    if(!$("#f_name").val()) {
        $("#f_name-info").html("(required)");
        $("#f_name").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#l_name").val()) {
        $("#l_name-info").html("(required)");
        $("#l_name").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#dob").val()) {
        $("#dob-info").html("(required)");
        $("#dob").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#email").val()) {
        $("#email-info").html("(required)");
        $("#email").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#mobile").val()) {
        $("#mobile-info").html("(required)");
        $("#mobile").css('background-color','#FFFFDF');
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
    if(!$("#pin").val()) {
        $("#pin-info").html("(required)");
        $("#pin").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#country").val()) {
        $("#country-info").html("(required)");
        $("#country").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#ctype").val()) {
        $("#ctype-info").html("(required)");
        $("#ctype").css('background-color','#FFFFDF');
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