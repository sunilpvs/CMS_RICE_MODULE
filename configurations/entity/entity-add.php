<?php 
    date_default_timezone_set('Asia/Kolkata');
 include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">New Entity Details
            
    </h3
    >
  </div>

<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">

    <div class="container">
    <div class="form-row">
  
        <div class="col-md-4 mb-3">
        <label for="validationDefault01" class="info">Company Name:</label><span id="entity_name-info" class="info"></span>
        <input type="text" class="form-control demoInputBox" id="entity_name" name= "entity_name" placeholder="Company Name" required>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
	    $(document).ready(function()
	    {
        $("#entity_name").on("focusout",function()
        {
		      var entityname = $("#entity_name").val();
		      $.ajax(
		      {
			      url:"check-entityname.php",
			      type:"POST",
			      data:{entity_name:entityname},
			      success:function(mydata)
			      {
                $("#entity_name-info").html(mydata);
			      } 
		      }
		      )
        }
  
        )})
    </script> 
      
        <div class="col-md-4 mb-3">
        <label for="validationDefault02" class="info">Cin No:</label><span id="cin-info" class="info"></span>
        <input type="text" class="form-control demoInputBox" id="cin" name= "cin" placeholder="CIN NO"  required>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
	    $(document).ready(function()
	    {
        $("#cin").on("focusout",function()
        {
		      var entitycin = $("#cin").val();
		      $.ajax(
		      {
			      url:"check-cin.php",
			      type:"POST",
			      data:{cin:entitycin },
			      success:function(mydata)
			      {
                $("#cin-info").html(mydata);
			      } 
		      }
		      )
        }
  
        )})
    </script> 
        
        <div class="col-md-4 mb-3">
        <label for="validationDefault03" class="info">Incorporation Date:</label><span id="incorp_date-info" class="info"></span>
        <input type="date" class="form-control demoInputBox" id="incorp_date" name= "incorp_date" placeholder="Incorporation Date" required>
        </div>              

        <div class="col-md-4 mb-3">
        <label for="validationDefault05" class="info">Address1</label><span id="add1-info" class="info"></span>
        <input type="text" maxlength="100"  class="form-control demoInputBox" id="add1" name= "add1" placeholder="Address1" required>
        </div>

        <div class="col-md-4 mb-3">
        <label for="validationDefault06" class="info">Address2</label><span id="add2-info" class="info"></span>
        <input type="text" maxlength="100"  class="form-control demoInputBox" id="add2" name= "add2" placeholder="Address2" required>        
        </div>

        <div class="col-md-4 mb-3">
        <label for="validationDefault06" class="info">City</label><span id="city-info" class="info"></span>
        <select id="city" name="city" class="form-control demoInputBox">
            <?php
                $emp = new Generic();
                $result2 = $emp->getCityList();
                if (!empty($result2)) {
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?> > <?php echo $row2["city"]; ?></option>
            <?php   } 
                }
            ?>
            ?>   
        </select>        
        </div>

        <div class="col-md-4 mb-3">
        <label for="validationDefault05" class="info">State:</label><span id="state-info" class="info"></span>
        <select id="state" name="state" class="form-control demoInputBox">
            <?php
                $emp = new Generic();
                $result2 = $emp->getStateList();
                if (!empty($result2)) {
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?> > <?php echo $row2["state"]; ?></option>
            <?php   } 
                }
            ?>
            ?>   
        </select>        
        </div>

        <div class="col-md-4 mb-3">
        <label for="validationDefault05" class="info">Pincode:</label><span id="pin-info" class="info"></span>
        <input type="text" maxlength="10"  class="form-control demoInputBox" id="pin" name= "pin" placeholder="Pincode" required>
        </div>

        <div class="col-md-4 mb-3">
        <label for="validationDefault05" class="info">Country:</label><span id="country-info" class="info"></span>
        <select id="country" name="country" class="form-control demoInputBox">
            <?php
                $emp = new Generic();
                $result2 = $emp->getCountryList();
                if (!empty($result2)) {
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?> > <?php echo $row2["country"]; ?></option>
            <?php   } 
                }
            ?>
            ?>   
        </select>
        </div>

        <div class="col-md-4 mb-3">
        <label for="validationDefault05" class="info">Status</label><span id="status-info" class="info"></span>
        <select id="status" name="status" class="form-control demoInputBox">       
            <option value = "A">Active </option>
            <option value = "D">De-Active </option>
        </select>
        </div>

        <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../configurations/entity/cEntity.php">Cancel</a></button> 
            </div>
        </div>

    </div>
    </div>
</form>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>

    function validate() {
        var valid = true;   
        $(".form control demoInputBox").css('background-color','');
        $(".info").html('');
        
        if(!$("#entity_name").val()) {
            $("#entity_name-info").html("(required)");
            $("#entity_name").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!$("#cin").val()) {
            $("#cin-info").html("(required)");
            $("#cin").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!$("#incorp_date").val()) {
            $("#incorp_date-info").html("(required)");
            $("#incorp_date").css('background-color','#FFFFDF');
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
