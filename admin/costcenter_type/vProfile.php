<?php 
  date_default_timezone_set('Asia/Kolkata');
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');

  if (!empty($result))
  {
    $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
  }
  if (!empty($result2)) 
  {
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);  
  } 
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">View Profile  
    </h3>
  </div>

<div class="card-body">
<form name="frmAdd">
  <div class="container" style="width: 30%; float:left">
  <div class="form-row">
      <div class="col-md-5 mb-3">
            <img class="img-profile " src="../../assests/img/boss.png"><br><br>
            <a href="#" style="text-align:center;">
            <?php $disp_name = $_SESSION['f_name']." ".$_SESSION['l_name']; ?>
            <span class="mr-2 d-none d-lg-inline text-darkblue-900 large"><b><?php echo $disp_name; ?></b></span>
          </a>
      </div>            
  </div>
  </div>
 

  <div class="container" style="width: 70%; float:right">
  <div class="form-row">
  
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">User Name</label><span id="user_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="user_name" name= "user_name" placeholder="User Name" value="<?php echo $row1["user_name"]; ?>" readonly>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">User Role</label><span id="user_role-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="user_role" name= "user_role" placeholder="User Role" value="<?php echo $row1["user_role"]; ?>" readonly>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Status</label><span id="status-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="status" name= "status" placeholder="Status"  value="<?php echo $row1["status"]; ?>" readonly>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">First Name</label><span id="f_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="f_name" name= "f_name" placeholder="First Name"  value="<?php echo $row1["f_name"]; ?>" readonly>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Last Name</label><span id="l_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="l_name" name= "l_name" placeholder="Last Name"  value="<?php echo $row1["l_name"]; ?>" readonly>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Date of Birth</label><span id="dob-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="dob" name= "dob" placeholder="Date of Birth" value="<?php echo $row1["dob"]; ?>" readonly>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault04" class="info">Email</label><span id="email-info" class="info"></span>
      <input type="email" class="form-control demoInputBox" id="email" name= "email" placeholder="Email" value="<?php echo $row1["email"]; ?>" readonly>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Personal Email</label><span id="personal_email-info" class="info"></span>
      <input type="email" class="form-control demoInputBox" id="personal_email" name= "personal_email" value="<?php echo $row1["personal_email"]; ?>" placeholder="Personal Email" readonly>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault05" class="info">Mobile</label><span id="mobile-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="mobile" name= "mobile" placeholder="Mobile" value="<?php echo $row1["mobile"]; ?>" readonly>
    </div>

   <div class="col-md-4 mb-3">
      <label for="validationDefault06" class="info">Address1</label><span id="add1-info" class="info"></span>
      <input type="message" class="form-control demoInputBox" id="add1" name= "add1" placeholder="Add Ref1" value="<?php echo $row1["add1"]; ?>" readonly>
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault07" class="info">Address2</label><span id="add2-info" class="info"></span>
      <input type="message" class="form-control demoInputBox" id="add2" name= "add2" placeholder="Add2" value="<?php echo $row1["add2"]; ?>" readonly>
    </div>

    <div class="col-md-4 mb-3">
    <label for="validationDefault05" class="info">City</label><span id="city-info" class="info"></span>
    <input type="text" class="form-control demoInputBox" id="city" name= "city" placeholder="city" value="<?php echo $row1["city"]; ?>" readonly>    
      </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">State</label><span id="state-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="state" name= "state" placeholder="state" value="<?php echo $row1["state"]; ?>" readonly>    
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Country</label><span id="country-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="country" name= "ountry" placeholder="ountry" value="<?php echo $row1["country"]; ?>" readonly>    
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Date of Joining</label><span id="doj-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="doj" name= "doj" placeholder="Date of Joining" value="<?php echo $row1["join_date"]; ?>" readonly>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Exit date</label><span id="exit_date-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="exit_date" name= "exit_date" placeholder="Exit Date" value="<?php echo $row1["exit_date"]; ?>" readonly>
    </div>
      
    <div class="col-md-4 mb-3">
      <label for="validationDefault05" class="info">Department</label><span id="dept-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="dept" name= "dept" placeholder="dept" value="<?php echo $row1["dept"]; ?>" readonly>
    </div>

    <div class="col-md-4 mb-3">
        <label for="validationDefault05" class="info">Designation</label><span id="desig-info" class="info"></span>
        <input type="text" class="form-control demoInputBox" id="desig" name= "desig" placeholder="desig" value="<?php echo $row1["desig"]; ?>" readonly>
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
    if(!$("#dept").val()) {
        $("#dept-info").html("(required)");
        $("#dept").css('background-color','#FFFFDF');
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