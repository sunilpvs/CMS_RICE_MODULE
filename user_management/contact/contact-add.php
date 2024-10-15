<?php 
    date_default_timezone_set('Asia/Kolkata');
 include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
?>
  <div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">New Contact Details
            
    </h3>
  </div>

<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">

  <div class="container">
  <div class="form-row">
  
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">First Name</label><span
            id="f_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="f_name" name= "f_name" placeholder="First Name" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Last Name</label><span
            id="l_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="l_name" name= "l_name" placeholder="Last Name"  required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Date of Birth</label><span
            id="dob-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="dob" name= "dob" placeholder="Date of Birth"  value="<?= date('Y-m-d') ?>">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Email</label><span
            id="email-info" class="info"></span>
      <input type="email" class="form-control demoInputBox" id="email" name= "email" placeholder="Email" required>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
	    $(document).ready(function()
	    {
        $("#email").on("focusout",function()
        {
		      var conemail = $("#email").val();
		      $.ajax(
		      {
			      url:"check-email.php",
			      type:"POST",
			      data:{email:conemail},
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
      <label for="validationDefault03" class="info">Mobile</label><span
            id="mobile-info" class="info"></span>
       <input type="text" class="form-control demoInputBox" id="mobile" name= "mobile" placeholder="Mobile" required>
    </div>
   <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Address1</label><span
            id="add1-info" class="info"></span>
      <input type="message" class="form-control demoInputBox" id="add1" name= "add1" placeholder="Address1" required>
    </div> 
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Address2</label><span
            id="add2-info" class="info"></span>
      <input type="message" class="form-control demoInputBox" id="add2" name= "add2" placeholder="Address2" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">City</label><span id="city-info" class="info"></span>
       <select id="city" name="city" class="form-control demoInputBox">
            <?php
                $gen = new Generic();
                $result = $gen->getCityList();
                if (!empty($result)) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row['id']; ?>> <?php echo $row["city"]; ?></option>
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
                $result = $gen->getStateList();
                if (!empty($result)) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row['id']; ?>> <?php echo $row["state"]; ?></option>
            <?php   } 
                }
            ?>  
        </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">pin</label><span
            id="pin-info" class="info"></span>
       <input type="text" class="form-control demoInputBox" id="pin" name= "pin" placeholder="Pin" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Country</label><span id="country-info" class="info"></span>
       <select id="country" name="country" class="form-control demoInputBox">
            <?php
                $gen = new Generic();
                $result = $gen->getCountryList();
                if (!empty($result)) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row['id']; ?>> <?php echo $row["country"]; ?></option>
            <?php   } 
                }
            ?>  
        </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Contact Type</label><span id="ctype-info-info" class="info"></span>
        <select id="ctype" name="ctype" class="form-control demoInputBox">
            <?php
                $gen = new Generic();
                $result = $gen->getContactTypeList();
                if (!empty($result)) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row['id']; ?>> <?php echo $row["ctype"]; ?></option>
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
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../user_management/contact/cContact.php">Cancel</a></button> 
            </div>
        </div>
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
include($_SERVER['DOCUMENT_ROOT'] .'/includes/scripts.php');
include($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.php');
?>