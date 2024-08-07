<?php 
    #require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
  
?>
<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">New Designation Details
            
    </h3>
  </div>

<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">

  <div class="container">
  <div class="form-row">
  
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Designation Name</label><span
            id="name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="name" name= "name" placeholder="Designation Name" required>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
	    $(document).ready(function()
	    {
        $("#name").on("focusout",function()
        {
		      var desname = $("#name").val();
		      $.ajax(
		      {
			      url:"check-name.php",
			      type:"POST",
			      data:{name:desname},
			      success:function(mydata)
			      {
                $("#name-info").html(mydata);
			      } 
		      }
		      )
        }
  
        )})
    </script> 
     
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Code</label><span id="code-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="code" name= "code" placeholder="Code"  required>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
	    $(document).ready(function()
	    {
        $("#code").on("focusout",function()
        {
		      var depcode = $("#code").val();
		      $.ajax(
		      {
			      url:"check-code.php",
			      type:"POST",
			      data:{code:depcode},
			      success:function(mydata)
			      {
                $("#code-info").html(mydata);
			      } 
		      }
		      )
        }
  
        )})
    </script> 
    
    <div class="col-md-4 mb-3">
        <label for="validationDefault05" class="info">Status</label><span id="status-info" class="info"></span>
        <select id="status" name="status" class="form-control demoInputBox">       
            <option value = "A">Active </option>
            <option value = "D">De-Active </option>
        </select>
        </div>
</div>
</div>

    
  <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../configurations/designation/cDesignation.php">Cancel</a></button> 
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
    $(".form-control demoInputBox").css('background-color','');
    $(".info").html('');
    
    if(!$("#name").val()) {
        $("#name-info").html("(required)");
        $("#name").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#code").val()) {
        $("#code-info").html("(required)");
        $("code").css('background-color','#FFFFDF');
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