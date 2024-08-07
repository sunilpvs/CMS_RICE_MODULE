<?php 
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'\web\header.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'\masters\entity\Entity.php');
    if (!empty($result)){
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>


<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">

  <div class="container">
  <div class="form-row">
  
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">First Name</label><span
            id="f_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="f_name" name= "f_name" placeholder="irst Name" value="<?php echo $row1["f_name"]; ?>" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Last Name</label><span
            id="l_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="l_name" name= "l_name" placeholder="Last Name"  value="<?php echo $$row1["l_name"]; ?>" required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Date of Birth</label><span
            id="dob-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="dob" name= "dob" placeholder="Date of Birth" value="<?php echo $row1["dob"]; ?>" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Email</label><span
            id="email-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="email" name= "email" placeholder="Email" value="<?php echo $row1["email"]; ?>" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Mobile</label><span
            id="mobile-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="mobile" name= "mobile" placeholder="Mobile" value="<?php echo $row1["mobile"]; ?>" required>
    </div>
   <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Add Ref1</label><span
            id="add_ref1-info" class="info"></span>
      <input type="message" class="form-control demoInputBox" id="add_ref1" name= "add_ref1" placeholder="Add Ref1" value="<?php echo $row1["add_ref1"]; ?>" required>
    </div> 
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Add Ref2</label><span
            id="add_ref2-info" class="info"></span>
      <input type="message" class="form-control demoInputBox" id="add_ref2" name= "add_ref2" placeholder="Add Ref2" value="<?php echo $row1["add_ref2"]; ?>" required>
    </div>
</div>
</div>

    
  <div class="container">
  <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Add</button>
     
</div>

</form>
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
    if(!$("#add_ref1").val()) {
        $("#add_ref1-info").html("(required)");
        $("#add_ref1").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#add_ref2").val()) {
        $("#add_ref2-info").html("(required)");
        $("#add_ref2").css('background-color','#FFFFDF');
        valid = false;
    }
   
     
    return valid;
}
</script>
    </body>
    </html>