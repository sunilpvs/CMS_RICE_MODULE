<?php 
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/user_management/user/User.php');
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
    <h3 class="m-0 font-weight-bold text-primary">Edit User Details</h3>
  </div>

<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">

  <div class="container">
  <div class="form-row">  
  
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">User Name</label><span id="user_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="user_name" name= "user_name" placeholder="User Name" value="<?php echo $row1["user_name"]; ?>" readonly>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
	    $(document).ready(function()
	    {
        $("#uname").on("focusout",function()
        {
          var user_id = $("#user_id").val();
		      var username = $("#uname").val();
		      $.ajax(
		      {
			      url:"check-uname.php",
			      type:"POST",
			      data:{user_id:user_id,user_name:username},
			      success:function(mydata)
			      {
                $("#uname-info").html(mydata);
			      } 
		      }
		      )
        }
  
        )})
    </script> 
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">First Name</label><span id="f_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="f_name" name= "f_name" placeholder="First Name" value="<?php echo $row1["f_name"]; ?>" readonly>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Last Name</label><span id="l_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="l_name" name= "l_name" placeholder="Last Name"  value="<?php echo $row1["l_name"]; ?>" readonly>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Email</label><span id="email-info" class="info"></span>
      <input type="email" class="form-control demoInputBox" id="email" name= "email" placeholder="Email" value="<?php echo $row1["email"]; ?>" readonly>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Mobile</label><span id="mobile-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="mobile" name= "mobile" placeholder="Mobile" value="<?php echo $row1["mobile"]; ?>" readonly>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Contact Type</label><span id="ctype-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="ctype" name= "ctype" placeholder="Contact Type" value="<?php echo $row1["ContactType"]; ?>" readonly>
    </div>

    <div class="col-md-4 mb-3">
        <label for="validationDefault05" class="info">User Status</label><span id="user_status-info" class="info"></span>
        <select id="user_status" name="user_status" class="form-control demoInputBox">
            <?php
                $gen = new Generic();
                $resultgen1 = $gen->getStatusList();
                if (!empty($resultgen1)) {
                    while ($row2 = mysqli_fetch_array($resultgen1, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['ID']; ?> <?php if($row2['ID'] == $row1["user_status"] ){ echo "Selected"; } ?> > <?php echo $row2["Status"]; ?></option>
            <?php   } 
                }
            ?>
            ?>   
        </select>
        </div>

        <div class="col-md-4 mb-3">
          <label for="validationDefault05" class="info">User Role</label><span id="user_role-info" class="info"></span>
          <select id="user_role" name="user_role" class="form-control demoInputBox">
            <?php
                $resultgen2 = $gen->getUserRoleList();
                if (!empty($resultgen2)) {
                    while ($row3 = mysqli_fetch_array($resultgen2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row3['id']; ?> <?php if($row3['user_role'] == $row1["user_role"] ){ echo "Selected"; } ?> > <?php echo $row3["user_role"]; ?></option>
            <?php   } 
                }
            ?>
            ?>   
          </select>
        </div>
        <div class="col-md-4 mb-3">
           <input type="hidden" class="form-control demoInputBox" id="user_id" name= "user_id" placeholder="Commodity" value="<?php echo $row1["id"]; ?>">
        </div>

</div>
</div>

  <div class="container">
   <div class="container">
    <div class="col-md-4 mb-3">
        <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Update Record</button>
        <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../user_management/user/cUser.php">Cancel</a></button> 
    </div>
  </div>
  </div>

</form>
</div>
</div>

<script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
<script>

  function validate() 
  {
      var valid = true;   
      $(".form control demoInputBox").css('background-color','');
      $(".info").html('');
      
      if(!$("#user_status").val()) {
          $("#user_status-info").html("(required)");
          $("#user_status").css('background-color','#FFFFDF');
          valid = false;
      }
      if(!$("#user_role").val()) {
          $("#user_role-info").html("(required)");
          $("#user_role").css('background-color','#FFFFDF');
          valid = false;
      }
      if(!$("#user_id").val()) {
          $("#user_id-info").html("(required)");
          $("#user_id").css('background-color','#FFFFDF');
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