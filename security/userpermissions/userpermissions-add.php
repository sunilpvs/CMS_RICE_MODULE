<?php 
  date_default_timezone_set('Asia/Kolkata');
  include('../../includes/header.php'); 
  include('../../includes/navbar.php'); 
  include('../../includes/Generic.php'); 
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">New User Permissions</h3>
  </div>
<div class="card-body">

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
<div class="container">
  <div class="form-row">

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">user_id</label><span id="user_id-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="user_id" name= "user_id" placeholder="user_id"  required>
    </div>

    
   

    <div class="col-md-4 mb-3">
        <label for="validationDefault02" class="info">page_id</label><span id="page_id-info" class="info"></span>
        <input type="text" class="form-control demoInputBox" id="page_id" name= "page_id" placeholder="page_id" required>
    </div>
       
    <div class="col-md-4 mb-12">
          <label for="validationDefault05" class="info">access_type</label><span id="access_type-info" class="info"></span>
          <input type="text" class="form-control demoInputBox" id="access_type" name= "access_type" placeholder="access_type" required>
       </div>
  </div> 
</div>    
        <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../security/userpermissions/cUserpermissions.php">Cancel</a></button> 
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

    if(!$("#user_id").val()) {
        $("#user_id-info").html("(required)");
        $("#user_id").css('background-color','#FFFFDF');
        valid = false;
    }
    
    if(!$("#page_id").val()) {
        $("#page_id-info").html("(required)");
        $("#page_id").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#access_type").val()) {
        $("#access_type-info").html("(required)");
        $("#access_type").css('background-color','#FFFFDF');
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