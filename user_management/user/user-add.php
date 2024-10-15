<?php 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
  require_once($_SERVER['DOCUMENT_ROOT'] .'/user_management/user/User.php');
?>
<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Create User</h3>
  </div>
<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
<div class="container">
  <div class="form-row"> 
    <div class="col-md-4 mb-3">
        <label for="validationDefault01" class="info">Select Contact to Create User:</label><span id="ContactId-info" class="info"></span>
        <select id="ContactId" name="ContactId" class="form-control demoInputBox" onchange="myFunction()">
            <option value = -1>Select Contact</option>
            <?php
                $usr = new User();
                $result = $usr->getContactList();
                if (!empty($result)) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option   data-fname=<?php echo $row['f_name']; ?> data-lname=<?php echo $row['l_name']; ?> 
                      data-email=<?php echo $row['email']; ?> data-mobile=<?php echo $row['mobile']; ?> data-ctype=<?php echo $row['ctype']; ?>
                    value=<?php echo $row['id']; ?>> <?php echo $row["f_name"]." ".$row["l_name"]; ?></option>
            <?php   } 
                }
            ?>          
        </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">First Name</label><span
            id="fname-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="fname" name= "fname" placeholder="First Name" disabled>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Last Name</label><span
            id="lname-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="lname" name= "lname" placeholder="Last Name"  readonly>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">EMail</label><span
            id="email-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="email" name= "email" placeholder="Email" readonly>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Mobile</label><span
            id="mobile-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="mobile" name= "mobile" placeholder="Mobile" readonly>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Contact Type</label><span
            id="ctype-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="ctype" name= "ctype" placeholder="ctype" readonly>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
      function myFunction()
      {
        var index = document.getElementById("ContactId").selectedIndex;
        var fname = document.getElementById("ContactId").options[index].getAttribute("data-fname");
        var lname = document.getElementById("ContactId").options[index].getAttribute("data-lname");
        var email = document.getElementById("ContactId").options[index].getAttribute("data-email");
        var mobile = document.getElementById("ContactId").options[index].getAttribute("data-mobile");
        var ctype = document.getElementById("ContactId").options[index].getAttribute("data-ctype");

        document.getElementsByName("fname")[0].value = fname;
        document.getElementsByName("lname")[0].value = lname;
        document.getElementsByName("email")[0].value = email;
        document.getElementsByName("mobile")[0].value = mobile;
        document.getElementsByName("ctype")[0].value = ctype;
      }
    </script>

   <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">User Name</label><span id="uname-info" class="info" style="color:red;"></span>
      <input type="text" maxlength = "12" class="form-control demoInputBox" id="uname" name= "uname" placeholder="User Name"  onInput="checkUname()" required>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
	    $(document).ready(function()
	    {
        $("#uname").on("focusout",function()
        {
		      var username = $("#uname").val();
		      $.ajax(
		      {
			      url:"check-uname.php",
			      type:"POST",
			      data:{user_name:username},
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
      <label for="validationDefault03" class="info">User Role</label><span id="role-info" class="info"></span>
        <select id="role" name="role" class="form-control demoInputBox">
            <?php
            $gen = new Generic();
                $result1 = $gen->getUserRoleList();
                if (!empty($result1)) {
                    while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC))
                    {   
            ?> 
            <option SELECTED value=<?php echo $row1['id']; ?>> <?php echo $row1["user_role"]; ?></option>
            <?php   } 
                }
            ?>
        </select>
    </div>

</div>
</div>

   <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../user_management/user/cUser.php">Cancel</a></button> 
            </div>
    </div>
  </div>
</div>
</form>
</div>
</div>

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
  function validate() {
      var valid = true;   
      $(".form control demoInputBox").css('background-color','');
      $(".info").html('');
      
      if(!$("#ContactId").val()) {
          $("#ContactId-info").html("(required)");
          $("#ContactId").css('background-color','#FFFFDF');
          valid = false;
      }   
      if(!$("#email").val()) {
          $("#email-info").html("(required)");
          $("#email").css('background-color','#FFFFDF');
          valid = false;
      }
      if(!$("#uname").val()) {
          $("#uname-info").html("(required)");
          $("#uname").css('background-color','#FFFFDF');
          valid = false;
      }
      if(!$("#role").val()) {
          $("#role-info").html("(required)");
          $("#role").css('background-color','#FFFFDF');
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
  //include('../../includes/scripts.php');
  //include('../../includes/footer.php');
?>