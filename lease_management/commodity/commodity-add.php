<?php 
    #require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
?>
<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">New Commodity Details
    </h3>
  </div>

<div class="card-body">

<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
<div class="container">
<div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Commodity</label><span id="commodity_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="commodity_name" name= "commodity_name" placeholder="Commodity Name" required>
    </div>
    
    <div class="col-md-4 mb-3">
        <label for="validationDefault03" class="info">Cargo Type</label><span id="cargo_type-info" class="info"></span>
        <select id="cargo_type" name="cargo_type" class="form-control demoInputBox">
          <?php
              $gen = new Generic();
              $result = $gen->getCargoTypeList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option value=<?php echo $row['id']; ?>> <?php echo $row["name"] ?></option>
          <?php   } 
              }
          ?>         
      </select>
      </div>
   
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Brand</label><span
            id="brand-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="brand" name= "brand" placeholder="Brand" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Marking</label><span id="marking-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="marking" name= "marking" placeholder="Marking" required>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>  
	    $(document).ready(function()
	    {
        $("#marking").on("focusout",function()
        {
          var commodityname = $("#commodity_name").val();
          var brand = $("#brand").val();
          var marking = $("#marking").val();

		      $.ajax(
		      {
			      url:"check-commodity.php",
			      type:"POST",
			      data:{commodity_name:commodityname,brand:brand,marking:marking},
			      success:function(mydata)
			      {
                $("#commodity_name-info").html(mydata);
                $("#brand-info").html(mydata);
                $("#marking-info").html(mydata);
			      } 
		      }
		      )
        }
        )
      })
    </script>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Bag Weight</label><span id="bag_wt-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="bag_wt" name= "bag_wt" min="0" max="1000" step="0.001" placeholder="00.00" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Empty Bag Weight</label><span id="empty_bag_wt-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="empty_bag_wt" name= "empty_bag_wt" min="0" max="1000" step="0.001" placeholder="00.00" required>
    </div>

    <!-- <div class="col-md-4 mb-3">
        <label for="validationDefault03" class="info">Inward Mode</label><span id="inwardmode-info" class="info"></span>
        <select id="inwardmode" name="inwardmode" class="form-control demoInputBox">
          <?php
              //$gen = new Generic();
              //$result = $gen->getInwardmodeTypeList();
              //if (!empty($result)) {
              //    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  //{   
          ?> 
          <option value=<?php //echo $row['id']; ?>> <?php //echo $row["name"] ?></option>
          <?php   //} 
              //}
          ?>         
       </select>
    </div> -->
</div>
</div><br>
    
<div class="container">
  <div class="col-md-4 mb-3">
      <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Commodity</button>
      <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="/lease_management/commodity/cCommodity.php">Cancel</a></button> 
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
    
     if(!$("#commodity_name").val()) {
        $("#commodity_name-info").html("(required)");
        $("#commodity_name").css('background-color','#FFFFDF');
        valid = false;
    }
    
    if(!$("#cargo_type").val()) {
        $("#cargo_type-info").html("(required)");
        $("#cargo_type").css('background-color','#FFFFDF');
        valid = false;
    }
   
    if(!$("#brand").val()) {
        $("#brand-info").html("(required)");
        $("#brand").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#marking").val()) {
        $("#marking-info").html("(required)");
        $("#marking").css('background-color','#FFFFDF');
        valid = false;
    }  
    if(!$("#bag_wt").val()) {
        $("#bag_wt-info").html("(required)");
        $("#bag_wt").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#empty_bag_wt").val()) {
        $("#empty_bag_wt-info").html("(required)");
        $("#empty_bag_wt").css('background-color','#FFFFDF');
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