<?php 
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/warehouse/Warehouse.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
    if (!empty($result)){
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
    ?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Edit Warehouse Details
    </h3>
  </div>

<div class="card-body">
 
    <form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">

    <div class="container">
    <div class="form-row">

        <div class="col-md-4 m
        -3"> 
            <label for="validationDefault01" class="info">Warehouse Name</label><span id="warehouse_name-info" class="info"></span>
            <input type="text" class="form-control demoInputBox" id="warehouse_name" name= "warehouse_name" placeholder="Warehouse Name" value="<?php echo $row1["warehouse_name"]; ?>" required>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
            <script>
      
	        $(document).ready(function()
	        {
                $("#warehouse_name").on("focusout",function()
            {
                var warehouse_id = $("#warehouse_id").val();
		        var warehousename = $("#warehouse_name").val();
		        $.ajax(
		        {
			      url:"check-warehousename.php",
			      type:"POST",
			      data:{wearehouse_id:warehouse_id,warehouse_name:warehousename},
			      success:function(mydata)
			      {
                $("#warehouse_name-info").html(mydata);
			      } 
		        }
		        )
            }
            )})
            </script>

        <div class="col-md-4 mb-3"> 
            <label for="validationDefault01" class="info">Warehouse Code</label><span id="code-info" class="info"></span>
            <input type="text" class="form-control demoInputBox" id="code" name= "code" placeholder="Warehouse Name" value="<?php echo $row1["code"]; ?>" required>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
	    $(document).ready(function()
	    {
        $("#code").on("focusout",function()
        {
              var warehouse_id = $("#warehouse_id").val();
		      var warehousecode = $("#code").val();
		      $.ajax(
		      {
			      url:"check-warehousecode.php",
			      type:"POST",
			      data:{warehouse_id:warehouse_id,code:warehousecode},
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
            <label for="validationDefault03" class="info">Lessor</label><span id="lessor_id-info" class="info"></span>
            <select id="lessor_id" name="lessor_id" class="form-control demoInputBox">
                <?php
                    $gen = new Generic();
                    $result = $gen->getLessorList();
                    if (!empty($result)) {
                        while ($row2 = mysqli_fetch_array($result, MYSQLI_ASSOC))
                        {   
                ?> 
                <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1['lessor_id']) { echo "Selected"; } ?>> <?php echo $row2["lessor_name"] ?></option>
                <?php   } 
                }
                ?>         
            </select>
            </div>
            
            <div class="col-md-4 mb-3">
            <label for="validationDefault02" class="info">Address1</label><span id="add1-info" class="info"></span>
            <input type="text" class="form-control demoInputBox" id="add1" name= "add1" placeholder="Address1" value="<?php echo $row1["add1"]; ?>" required>
            </div>
    
            <div class="col-md-4 mb-3">
            <label for="validationDefault03" class="info">Address2</label><span id="add2-info" class="info"></span>
            <input type="text" class="form-control demoInputBox" id="add2" name= "add2" placeholder="Address2" value="<?php echo $row1["add2"]; ?>" required>
            </div>

            <div class="col-md-4 mb-3">
            <label for="validationDefault02" class="info">City</label><span id="city-info" class="info"></span>
            <select id="city" name="city" class="form-control demoInputBox">
                <?php
                    $gen = new Generic();
                    $result2 = $gen->getCityList();
                    if (!empty($result2)) {
                        while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                        {   
                ?> 
                <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1['city']) { echo "Selected"; } ?> > <?php echo $row2["city"]; ?></option>
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
                    $result2 = $gen->getStateList();
                    if (!empty($result2)) {
                        while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                        {   
                ?> 
                <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1['state']) { echo "Selected"; } ?> > <?php echo $row2["state"]; ?></option>
                <?php   } 
                    }
                ?>         
            </select>
            </div>

            <div class="col-md-4 mb-3">
            <label for="validationDefault03" class="info">Pincode</label><span id="pin-info" class="info"></span>
            <input type="text" class="form-control demoInputBox" id="pin" name= "pin" placeholder="Pincode" value="<?php echo $row1["pin"]; ?>" required>
            </div>
    
            <div class="col-md-4 mb-3">
                <label for="validationDefault03" class="info">Country</label><span id="country-info" class="info"></span>
                <select id="country" name="country" class="form-control demoInputBox">
                    <?php
                        $gen = new Generic();
                        $result2 = $gen->getCountryList();
                        if (!empty($result2)) {
                            while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                            {   
                    ?> 
                    <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1['country']) { echo "Selected"; } ?> > <?php echo $row2["country"]; ?></option>
                    <?php   } 
                        }
                    ?>         
                </select>
            </div> 
    
            <div class="col-md-4 mb-3">
              <label for="validationDefault03" class="info">Capacity (Sq.ft)</label><span id="capacity_sqft-info" class="info"></span>
              <input type="number" class="form-control demoInputBox" id="capacity_sqft" name= "capacity_sqft" placeholder="0.00" min="0" step="0.01" value="<?php echo $row1["capacity_sqft"]; ?>" onchange="derivemton()" onfocusout="derivemton()" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="validationDefault03" class="info">Capacity (Metric Ton)</label><span id="capacity_mton-info" class="info"></span>
              <input type="number" class="form-control demoInputBox" id="capacity_mton" name= "capacity_mton" placeholder="0.00" min="0" step="0.01" value="<?php echo $row1["capacity_mton"]; ?>" readonly>
            </div>

            <script>
                function derivemton()
                {    
                var capacity_sqft = document.getElementById('capacity_sqft').value;
                var capacity_mton = Math.abs((capacity_sqft /= 4));
                document.getElementById('capacity_mton').value = capacity_mton;
                } 
            </script>


            <div class="col-md-4 mb-3">
            <label for="validationDefault03" class="info">Primary Contact</label><span id="primary_contact-info" class="info"></span>
            <select id="primary_contact" name="primary_contact" class="form-control demoInputBox">
                <option value="-1">Select Contact</option>    
                <?php
                    $gen = new Generic();
                    $result2 = $gen->getEmployeeContactList();
                    if (!empty($result2)) {
                        while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                        {   
                ?> 
                <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1['primary_contact']) { echo "Selected"; } ?> > <?php echo $row2["contact"]; ?></option>
                <?php   } 
                    }
                ?>         
            </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="validationDefault10" class="info">Status</label><span id="status-info" class="info"></span>
                <select id="status" name="status" class="form-control demoInputBox">
                    <option value="A" <?php if($row1["status"] == "A"){ echo "Selected";} ?> >Active</option>    
                    <option value="D" <?php if($row1["status"] == "D"){ echo "Selected";} ?>>De-Active</option>   
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <input type="hidden" class="form-control demoInputBox" id="warehouse_id" name= "warehouse_id" placeholder="Commodity" value="<?php echo $row1["id"]; ?>">
            </div>
    </div>
</div>

  <div class="container">
      <div class="col-md-4 mb-3">
          <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Update Record</button>
          <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../lease_management/warehouse/cWarehouse.php">Cancel</a></button> 
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
    
    if(!$("#warehouse_name").val()) {
        $("#warehouse_name-info").html("(required)");
        $("#warehouse_name").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#code").val()) {
        $("#code-info").html("(required)");
        $("#code").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#lessor_id").val()) {
        $("#lessor_id-info").html("(required)");
        $("#lessor_id").css('background-color','#FFFFDF');
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
    if(!$("#capacity_sqft").val()) {
        $("#capacity_sqft-info").html("(required)");
        $("#capacity_sqft").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#capacity_mton").val()) {
        $("#capacity_mton-info").html("(required)");
        $("#capacity_mton").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#primary_contact").val()) {
        $("#primary_contact-info").html("(required)");
        $("#primary_contact").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#status").val()) {
        $("#status-info").html("(required)");
        $("#status").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#warehouse_id").val()) {
        $("#warehouse_id-info").html("(required)");
        $("#warehouse_id").css('background-color','#FFFFDF');
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