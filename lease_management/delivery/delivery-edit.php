<?php 
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/delivery/Delivery.php');
   include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');

    if (!empty($result))
    {
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Edit Delivery Details
            
    </h3>
  </div>

<div class="card-body">

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">

<div class="container">
    <div class="form-row">

        
       <div class="col-md-4 mb-3">
          <label for="validationDefault03" class="info">Delivery</label><span id="delivery_name-info" class="info"></span>
          <input type="text" class="form-control demoInputBox" id="delivery_name" name= "delivery_name" placeholder="Delivery Name"  value="<?php echo $row1["delivery_name"]; ?>"  required>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
                <script>
      
	                $(document).ready(function()
	                {
                        $("#delivery_name").on("focusout",function()
                        {
                        var delivery_id = $("#delivery_id").val();    
		                var deliveryname = $("#delivery_name").val();
		                $.ajax(
		                {
			            url:"check-deliveryname-edit.php",
			            type:"POST",
			            data:{delivery_id:delivery_id,delivery_name:deliveryname},
			            success:function(mydata)
			             {
                        $("#delivery_name-info").html(mydata);
			             } 
		                }
		                )
                        }
  
                        )})
                </script>

        <div class="col-md-4 mb-3">
          <label for="validationDefault02" class="info">Particulars</label><span id="particulars-info" class="info"></span>
          <input type="text" class="form-control demoInputBox" id="particulars" name= "particulars" placeholder="Particulars" value="<?php echo $row1["particulars"]; ?>">
        </div>
           


        <div class="col-md-4 mb-3">
                <label for="validationDefault10" class="info">Status</label><span id="status-info" class="info"></span>
                <select id="status" name="status" class="form-control demoInputBox">
                    <option value="A" <?php if($row1["status"] == "A"){ echo "Selected";} ?> >Active</option>    
                    <option value="D" <?php if($row1["status"] == "D"){ echo "Selected";} ?>>De-Active</option>   
                </select>
        </div>
        
        <div class="col-md-4 mb-3">
                <input type="hidden" class="form-control demoInputBox" id="delivery_id" name= "delivery_id" placeholder="Delivery" value="<?php echo $row1["id"]; ?>">
        </div>

        </div>
    </div>
 
    <div class="container">
        <div class="col-md-4 mb-3">
            <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Update Record</button>
            <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../lease_management/delivery/cDelivery.php">Cancel</a></button> 
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

    if(!$("#delivery_name").val()) {
        $("#delivery_name-info").html("(required)");
        $("#delivery_name").css('background-color','#FFFFDF');
        valid = false;
    }
    
    if(!$("#particulars").val()) {
        $("#particulars-info").html("(required)");
        $("#particulars").css('background-color','#FFFFDF');
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