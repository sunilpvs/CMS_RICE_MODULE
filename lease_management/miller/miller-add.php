<?php 
  date_default_timezone_set('Asia/Kolkata');
include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">New Miller Details
    </h3>
  </div>

<div class="card-body">

<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">

<div class="container">
  <div class="form-row">
  
    <div class="col-md-4 mb-3"> 
        <label for="validationDefault01" class="info">Miller Name</label><span id="miller_name-info" class="info"></span>
        <input type="text" class="form-control demoInputBox" id="miller_name" name= "miller_name" placeholder="Miller Name" required>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
	    $(document).ready(function()
	    {
        $("#miller_name").on("focusout",function()
        {
		      var millername = $("#miller_name").val();
		      $.ajax(
		      {
			      url:"check-millername.php",
			      type:"POST",
			      data:{miller_name:millername},
			      success:function(mydata)
			      {
                $("#miller_name-info").html(mydata);
			      } 
		      }
		      )
        }
  
        )})
    </script>

    <div class="col-md-4 mb-3">
        <label for="validationDefault02" class="info">GST Number</label><span id="gst_num-info" class="info"></span>
        <input type="text" class="form-control demoInputBox" id="gst_num" name= "gst_num" placeholder="GST Number"  required>
    </div>

    <div class="col-md-4 mb-3">
        <label for="validationDefault02" class="info">Place</label><span id="place-info" class="info"></span>
        <input type="text" class="form-control demoInputBox" id="place" name= "place" placeholder="Place"  required>
    </div>
      
    <div class="col-md-4 mb-3">
        <label for="validationDefault03" class="info">Address</label><span id="add1-info" class="info"></span>
        <input type="text" class="form-control demoInputBox" id="add1" name= "add1" placeholder="Address" required>
    </div>


      
      <div class="col-md-4 mb-12">
          <label for="validationDefault05" class="info">Status</label><span id="status-info" class="info"></span>
          <select id="status" name="status" class="form-control demoInputBox">       
              <option value = "A">Active </option>
              <!-- <option value = "D">De-Active </option> -->
          </select>
       </div>
  </div> <br>
</div>    
        <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="/lease_management/miller/cMiller.php">Cancel</a></button> 
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
    
    if(!$("#miller_name").val()) {
        $("#miller_name-info").html("(required)");
        $("#miller_name").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#gst_num").val()) {
        $("#gst_num-info").html("(required)");
        $("#gst_num").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#place").val()) {
        $("#place-info").html("(required)");
        $("#place").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#add1").val()) {
        $("#add1-info").html("(required)");
        $("#add1").css('background-color','#FFFFDF');
        valid = false;
    }
  
    if(!$("#status").val()) {
        $("#status-info").html("(required)");
        $("#status").css('background-color','#FFFFDF');
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