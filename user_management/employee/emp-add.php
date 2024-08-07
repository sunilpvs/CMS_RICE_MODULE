<?php 
    date_default_timezone_set('Asia/Kolkata');
include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">New Employee/Consultant Details            
    </h3>
  </div>

<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();" accept="image/png, image/gif, image/jpeg" enctype="multipart/form-data">

<div class="container">
  <div class="form-row">
  
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">First Name</label><span id="f_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="f_name" name= "f_name" placeholder="First Name" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Last Name</label><span id="l_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="l_name" name= "l_name" placeholder="Last Name"  required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Date of Birth</label><span id="dob-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="dob" name= "dob" placeholder="Date of Birth" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Email</label><span id="email-info" class="info"></span>
      <input type="email" class="form-control demoInputBox" id="email" name= "email" placeholder="Email" required>
    </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
	    $(document).ready(function()
	    {
        $("#email").on("focusout",function()
        {
		      var empemail = $("#email").val();
		      $.ajax(
		      {
			      url:"check-email.php",
			      type:"POST",
			      data:{email:empemail},
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
      <label for="validationDefault03" class="info">Personal Email</label><span id="personal_email-info" class="info"></span>
      <input type="email" class="form-control demoInputBox" id="personal_email" name= "personal_email" placeholder="Personal Email" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Mobile</label><span id="mobile-info" class="info"></span>
       <input type="text" class="form-control demoInputBox" id="mobile" name= "mobile" placeholder="Mobile" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Address1</label><span id="add1-info" class="info"></span>
      <input type="message" class="form-control demoInputBox" id="add1" name= "add1" placeholder="Address1" required>
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Address2</label><span id="add2-info" class="info"></span>
      <input type="message" class="form-control demoInputBox" id="add2" name= "add2" placeholder="Address2" >
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
      <label for="validationDefault03" class="info">pin</label><span id="pin-info" class="info"></span>
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
      <label for="validationDefault03" class="info">Employee Type</label><span id="ctype-info-info" class="info"></span>
        <select id="ctype" name="ctype" class="form-control demoInputBox">
            <?php
                $gen = new Generic();
                $result = $gen->getEmployeeTypeList();
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

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Date of Joining</label><span id="doj-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="doj" name= "doj" placeholder="Date of Joining" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Exit date</label><span id="exit_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="exit_date" name= "exit_date" placeholder="Exit Date" value="31-Dec-2050" >
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Employee Status</label><span id="emp_status-info" class="info"></span>
        <select id="emp_status" name="emp_status" class="form-control demoInputBox">
            <option value="A" SELECTED> Active </option>
            <!-- <option value="S"> Suspended </option>
            <option value="D"> De-Active </option> -->
        </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Department</label><span id="department-info-info" class="info"></span>
        <select id="department" name="department" class="form-control demoInputBox">
        <option value="-1">Select Department</option>
            <?php
                $result = $gen->getDeptartmentList();
                if (!empty($result)) 
                {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row['id']; ?>> <?php echo $row["dept"]; ?></option>
            <?php   } 
                }
            ?>  
        </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Designation</label><span id="designation-info-info" class="info"></span>
        <select id="designation" name="designation" class="form-control demoInputBox">
        <option value="-1">Select Designation</option>
            <?php
                $result = $gen->getDesignationList();
                if (!empty($result)) 
                {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row['id']; ?>> <?php echo $row["desig"]; ?></option>
            <?php   } 
                }
            ?>  
        </select>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Upload Image</label><span id="image-info" class="info"></span>
      <input type="file" class="form-control demoInputBox" id="image" name= "image">
    </div>
 
    
</div>
</div>
    
<div class="container">
        <div classs="col-md-4 mb-3">
            <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
            <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../user_management/employee/cEmployee.php">Cancel</a></button> 
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
    if(!$("#personal_email").val()) {
        $("#personal_email-info").html("(required)");
        $("#personal_email").css('background-color','#FFFFDF');
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
    if(!$("#doj").val()) {
        $("#doj-info").html("(required)");
        $("#doj").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#emp_status").val()) {
        $("#emp_status-info").html("(required)");
        $("#emp_status").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#department").val()) {
        $("#department-info").html("(required)");
        $("#department").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#designation").val()) {
        $("#designation-info").html("(required)");
        $("#designation").css('background-color','#FFFFDF');
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