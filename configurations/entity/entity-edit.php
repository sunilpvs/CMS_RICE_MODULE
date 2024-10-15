<?php 
    date_default_timezone_set('Asia/Kolkata');
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
    <h3 class="m-0 font-weight-bold text-primary">Edit Entity Details    
    </h3>
  </div>

<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">

    <div class="container">
    <div class="form-row">      
        <div class="col-md-4 mb-3">
        <label for="validationDefault05" class="info">Address1</label><span id="add1-info" class="info"></span>
        <input type="text" maxlength="100"  class="form-control demoInputBox" id="add1" name= "add1" placeholder="Address1" value="<?php echo $row1["add1"]; ?>" required>
        </div>

        <div class="col-md-4 mb-3">
        <label for="validationDefault06" class="info">Address2</label><span id="add2-info" class="info"></span>
        <input type="text" maxlength="100"  class="form-control demoInputBox" id="add2" name= "add2" placeholder="Address2" value="<?php echo $row1["add2"]; ?>" required>        
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
            <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1["city"] ){ echo "Selected"; } ?> > <?php echo $row2["city"]; ?></option>
            <?php   } 
                }
            ?>
            ?>   
        </select>        
        </div>

        <div class="col-md-4 mb-3">
        <label for="validationDefault07" class="info">State</label><span id="state-info" class="info"></span>
        <select id="state" name="state" class="form-control demoInputBox">
            <?php
                $emp = new Generic();
                $result2 = $emp->getStateList();
                if (!empty($result2)) {
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1["state"] ){ echo "Selected"; } ?> > <?php echo $row2["state"]; ?></option>
            <?php   } 
                }
            ?>
            ?>   
        </select>
        </div>

        <div class="col-md-4 mb-3">
        <label for="validationDefault08" class="info">Pincode</label><span id="pin-info" class="info"></span>
        <input type="text" maxlength="10"  class="form-control demoInputBox" id="pin" name= "pin" placeholder="Pincode"value="<?php echo $row1["pin"]; ?>" required>
        </div>

        <div class="col-md-4 mb-3">
        <label for="validationDefault09" class="info">Country</label><span id="country-info" class="info"></span>
        <select id="country" name="country" class="form-control demoInputBox">
            <?php
                $emp = new Generic();
                $result2 = $emp->getCountryList();
                if (!empty($result2)) {
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1["country"] ){ echo "Selected"; } ?> > <?php echo $row2["country"]; ?></option>
            <?php   } 
                }
            ?>
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
           <input type="hidden" class="form-control demoInputBox" id="entity_id" name= "entity_id" placeholder="Commodity" value="<?php echo $row1["id"]; ?>">
        </div>

        <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Update Record</button>
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
        if(!$("#entity_id").val()) {
        $("#entity_id-info").html("(required)");
        $("#entity_id").css('background-color','#FFFFDF');
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