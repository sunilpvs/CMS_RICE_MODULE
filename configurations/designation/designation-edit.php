<?php 
    date_default_timezone_set('Asia/Kolkata');
    #require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/configurations/entity/Entity.php');
       include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    if (!empty($result)){
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>
<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Edit Designation Details
            
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
      <input type="text" class="form-control demoInputBox" id="name" name= "name" placeholder="Designation Name" value="<?php echo $row1["name"]; ?>" required>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
	    $(document).ready(function()
	    {
        $("#name").on("focusout",function()
        {
              var designation_id = $("#designation_id").val();
              var desname = $("#name").val();
		      $.ajax(
		      {
			      url:"check-name-edit.php",
			      type:"POST",
			      data:{designation_id:designation_id,name:desname},
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
      <label for="validationDefault02" class="info">Code</label><span
            id="code-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="code" name= "code" placeholder="Code" value="<?php echo $row1["code"]; ?>" required>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
	    $(document).ready(function()
	    {
        $("#code").on("focusout",function()
        {
              var designation_id = $("#designation_id").val(); 
              var descode = $("#code").val();
		      $.ajax(
		      {
			      url:"check-code-edit.php",
			      type:"POST",
			      data:{designation_id:designation_id,code:descode},
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
        <label for="validationDefault10" class="info">Status</label><span id="Status-info" class="info"></span>
        <select id="status" name="status" class="form-control demoInputBox">
            <option value="A" <?php if($row1["status"] == "A"){ echo "Selected";} ?> >Active</option>    
            <option value="D" <?php if($row1["status"] == "D"){ echo "Selected";} ?>>De-Active</option>   
        </select>
    </div>

    <div class="col-md-4 mb-3">
          <input type="hidden" class="form-control demoInputBox" id="designation_id" name= "designation_id" placeholder="Commodity" value="<?php echo $row1["id"]; ?>">
    </div>

</div>
</div>

    
 <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../configurations/designation/cDesignation.php">Cancel</a></button> 
            </div>
        </div>
</form>
</div>
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
        $("#code").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#designation_id").val()) {
        $("#designation_id-info").html("(required)");
        $("#designation_id").css('background-color','#FFFFDF');
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