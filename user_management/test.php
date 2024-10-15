<?php 
    date_default_timezone_set('Asia/Kolkata');
    include('../../includes/header.php'); 
    include('../../includes/navbar.php'); 
    include('../../includes/Generic.php'); 
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">New Employee/Consultant Details            
    </h3>
  </div>

<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">

<div class="container">
  <div class="form-row">
  
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Upload Image</label><span id="emp_image-info-info" class="info"></span>
      <input type="file" class="form-control demoInputBox" id="emp_image" name= "emp_image">
    </div>
 
    
</div>
</div>
    
<div class="container">
        <div class="col-md-4 mb-3">
            <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
            
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
    
    if(!$("#emp_image").val()) {
        $("#emp_image--info-info").html("(required)");
        $("#emp_image").css('background-color','#FFFFDF');
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