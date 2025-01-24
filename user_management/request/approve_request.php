<?php 
    session_start();
    date_default_timezone_set('Asia/Kolkata');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
    include($_SERVER['DOCUMENT_ROOT'] ."/user_management/request/Request.php");
?>

<div class="container-fluid" style="background:#6665ee; padding:75px;">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <center><h3 class="m-0 font-weight-bold text-primary">Approve Access Request</h3></center>
  </div>

<div class="card-body">
<form name="frmAdd" method="post" action="../../user_management/request/update_accessrequest.php" id="frmAdd" onSubmit="return validate();" accept="image/png, image/gif, image/jpeg" enctype="multipart/form-data">

<div class="container">
  <div class="form-row">

  <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Select User</label><span id="user-info" class="info"></span>
        <select id="user" name="user" class="form-control demoInputBox" onchange="myLoadRequest()">
            <option value=-1>Select User </option>
            <?php
                $req = new Request();
                $result = $req->getPendingRequests();
                if (!empty($result)) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option 
                    data-f_name= <?php echo $row['f_name']; ?> 
                    data-f_name= <?php echo $row['f_name']; ?> data-l_name= <?php echo $row['l_name']; ?> 
                    data-dob= <?php echo $row['dob']; ?>  data-email= <?php echo $row['email']; ?> 
                    data-personal_email= <?php echo $row['personal_email']; ?>  data-mobile= <?php echo $row['mobile']; ?> 
                    data-add1= <?php echo $row['add1']; ?> data-add2= <?php echo $row['add2']; ?> 
                    data-city= <?php echo $row['city']; ?> data-state= <?php echo $row['state']; ?> 
                    data-pin= <?php echo $row['pin']; ?> data-country= <?php echo $row['country']; ?> 
                    data-contacttype_id= <?php echo $row['contacttype_id']; ?> data-join_date= <?php echo $row['join_date']; ?> 
                    data-exit_date= <?php echo $row['exit_date']; ?> data-entity_id= <?php echo $row['entity_id']; ?> 
                    data-department= <?php echo $row['department']; ?> data-designation= <?php echo $row['designation']; ?> 
                    data-emp_status= <?php echo $row['emp_status']; ?> data-app_name= <?php echo $row['approver_name']; ?> 
                    data-app_email= <?php echo $row['approver_email']; ?> data-message= <?php echo $row['message']; ?> 
                    data-status= <?php echo $row['status']; ?> data-created_datetime= <?php echo $row['created_datetime']; ?> 
                    data-request_expiry= <?php echo $row['request_expiry']; ?> 
                    value=<?php echo $row['id']; ?>> <?php echo $row["f_name"].' '.$row["l_name"]; ?></option>
            <?php   } 
                }
            ?>  
        </select>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

      function myLoadRequest()
      {
        //id,warehouse_name,code,lessor_name,ltype,capacity_sqft,capacity_mton,contract_id,start_date,expiry_date,city,state,contact,email,mobile
        var index = document.getElementById("user").selectedIndex;       
        document.getElementsByName("f_name")[0].value = document.getElementById("user").options[index].getAttribute("data-f_name");
        document.getElementsByName("l_name")[0].value = document.getElementById("user").options[index].getAttribute("data-l_name");
        document.getElementsByName("dob")[0].value = document.getElementById("user").options[index].getAttribute("data-dob");
        document.getElementsByName("email")[0].value = document.getElementById("user").options[index].getAttribute("data-email");
        document.getElementsByName("personal_email")[0].value = document.getElementById("user").options[index].getAttribute("data-personal_email");
        document.getElementsByName("mobile")[0].value = document.getElementById("user").options[index].getAttribute("data-mobile");
        document.getElementsByName("add1")[0].value = document.getElementById("user").options[index].getAttribute("data-add1");
        document.getElementsByName("add2")[0].value = document.getElementById("user").options[index].getAttribute("data-add2");
        document.getElementsByName("city")[0].value = document.getElementById("user").options[index].getAttribute("data-city");
        document.getElementsByName("state")[0].value = document.getElementById("user").options[index].getAttribute("data-state");
        document.getElementsByName("pin")[0].value = document.getElementById("user").options[index].getAttribute("data-pin");
        document.getElementsByName("country")[0].value = document.getElementById("user").options[index].getAttribute("data-country");
        document.getElementsByName("ctype")[0].value = document.getElementById("user").options[index].getAttribute("data-contacttype_id");
        document.getElementsByName("doj")[0].value = document.getElementById("user").options[index].getAttribute("data-join_date");
        document.getElementsByName("exit_date")[0].value = document.getElementById("user").options[index].getAttribute("data-exit_date");
        document.getElementsByName("entity")[0].value = document.getElementById("user").options[index].getAttribute("data-entity_id");
        document.getElementsByName("department")[0].value = document.getElementById("user").options[index].getAttribute("data-department");
        document.getElementsByName("designation")[0].value = document.getElementById("user").options[index].getAttribute("data-designation");
        document.getElementsByName("approver_name")[0].value = document.getElementById("user").options[index].getAttribute("data-app_name");
        document.getElementsByName("approver_email")[0].value = document.getElementById("user").options[index].getAttribute("data-app_email");
        //var mess = document.getElementById("user").options[index].getAttribute("data-message");
        document.getElementsByName("message")[0].value = document.getElementById("user").options[index].getAttribute("data-message");
        document.getElementsByName("req_status")[0].value = document.getElementById("user").options[index].getAttribute("data-status"); 
      }

    </script>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">First Name</label><span id="f_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="f_name" name= "f_name" placeholder="First Name" readonly>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Last Name</label><span id="l_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="l_name" name= "l_name" placeholder="Last Name"  disabled>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Date of Birth</label><span id="dob-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="dob" name= "dob" placeholder="Date of Birth" disabled>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Email</label><span id="email-info" class="info"></span>
      <input type="email" class="form-control demoInputBox" id="email" name= "email" placeholder="Email" readonly>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Personal Email</label><span id="personal_email-info" class="info"></span>
      <input type="email" class="form-control demoInputBox" id="personal_email" name= "personal_email" placeholder="Personal Email" disabled>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Mobile</label><span id="mobile-info" class="info"></span>
       <input type="text" maxlength="12" onKeyDown="return/[0-9.⌦←→⌫HT]/i.test(event.key)" class="form-control demoInputBox" id="mobile" name= "mobile" placeholder="Mobile" disabled>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Address1</label><span id="add1-info" class="info"></span>
      <input type="message" class="form-control demoInputBox" id="add1" name= "add1" placeholder="Address1" disabled>
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Address2</label><span id="add2-info" class="info"></span>
      <input type="message" class="form-control demoInputBox" id="add2" name= "add2" placeholder="Address2" disabled>
    </div>
 
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">City</label><span id="city-info" class="info"></span>
        <select id="city" name="city" class="form-control demoInputBox" disabled>
            <?php
                $gen = new Generic();
                $result = $gen->getCityList();
                if (!empty($result)) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row['id']; ?>> <?php echo $row["city"]; ?></option>
            <?php   } 
                }
            ?>  
        </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">State</label><span id="state-info" class="info"></span>
       <select id="state" name="state" class="form-control demoInputBox" disabled>
            <?php
                $gen = new Generic();
                $result = $gen->getStateList();
                if (!empty($result)) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row['id']; ?>> <?php echo $row["state"]; ?></option>
            <?php   } 
                }
            ?>  
        </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">PinCode</label><span id="pin-info" class="info"></span>
       <input type="number" maxlength="7" onKeyDown="return/[0-9.⌦←→⌫HT]/i.test(event.key)" class="form-control demoInputBox" id="pin" name= "pin" placeholder="Pin" disabled>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Country</label><span id="country-info" class="info"></span>
         <select id="country" name="country" class="form-control demoInputBox" disabled>
            <?php
                $gen = new Generic();
                $result = $gen->getCountryList();
                if (!empty($result)) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row['id']; ?>> <?php echo $row["country"]; ?></option>
            <?php   } 
                }
            ?>  
        </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Employee Type</label><span id="ctype-info-info" class="info"></span>
        <select id="ctype" name="ctype" class="form-control demoInputBox" disabled>
            <?php
                $gen = new Generic();
                $result = $gen->getEmployeeTypeList();
                if (!empty($result)) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row['id']; ?>> <?php echo $row["ctype"]; ?></option>
            <?php   } 
                }
            ?>  
        </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info" >Date of Joining</label><span id="doj-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="doj" name= "doj" placeholder="Date of Joining" value = "<?= date('Y-m-d') ?>" disabled>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Exit date</label><span id="exit_date-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="exit_date" name= "exit_date" placeholder="Exit Date" value="<?= date("Y-m-d", strtotime("+730 days", strtotime(date("Y-m-d")))); ?>" disabled>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Entity</label><span id="entity-info-info" class="info"></span>
        <select id="entity" name="entity" class="form-control demoInputBox" readonly>
        <option value="-1">Select Entity</option>
            <?php
                $result = $gen->getEntityList();
                if (!empty($result)) 
                {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row['id']; ?>> <?php echo $row["entity_name"]; ?></option>
            <?php   } 
                }
            ?>  
        </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Department</label><span id="department-info-info" class="info"></span>
        <select id="department" name="department" class="form-control demoInputBox" disabled>
        <option value="-1">Select Department</option>
            <?php
                $result = $gen->getDeptartmentList();
                if (!empty($result)) 
                {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row['id']; ?>> <?php echo $row["dept"]; ?></option>
            <?php   } 
                }
            ?>  
        </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Designation</label><span id="designation-info-info" class="info"></span>
        <select id="designation" name="designation" class="form-control demoInputBox" disabled>
        <option value="-1">Select Designation</option>
            <?php
                $result = $gen->getDesignationList();
                if (!empty($result)) 
                {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row['id']; ?>> <?php echo $row["desig"]; ?></option>
            <?php   } 
                }
            ?>  
        </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Approver Name</label><span id="approver_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="approver_name" name= "approver_name" placeholder="Approver Name" disabled>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Approver Email</label><span id="approver_email-info" class="info"></span>
       <input type="text" class="form-control demoInputBox" id="approver_email" name= "approver_email" placeholder="approver_email" disabled>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Request Message:</label><span id="message-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="message" name= "message" placeholder="message" disabled>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Request Status</label><span id="req_status-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="req_status" name= "req_status" placeholder="Request Status" disabled>
    </div>
    
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
			      url:"../..//user_management/request/check-uname.php",
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
      <label for="validationDefault03" class="info">Assigned Role</label><span id="role-info-info" class="info"></span>
        <select id="role" name="role" class="form-control demoInputBox" required>
        <option value="-1">Select Role</option>
            <?php
                $result = $gen->getUserRoleList();
                if (!empty($result)) 
                {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row['id']; ?>> <?php echo $row["user_role"]; ?></option>
            <?php   } 
                }
            ?>  
        </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Approve Status</label><span id="app_status-info-info" class="info"></span>
        <select id="app_status" name="app_status" class="form-control demoInputBox" required>
        <option value="-1">Select Approval Status</option>
        <option value="Approved">Approve</option>
        <option value="Rejected">Reject</option>
        </select>
    </div>

    
</div>
</div>
    
<div class="container">
        <div classs="col-md-4 mb-3">
            <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add" >Create Record</button>
            <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:#fff;" href="../../user_management/request/approve_request.php">Cancel</a></button> 
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
    $(".form control demoInputBox").css('background-color','');
    $(".info").html('');
    
    if(!$("#f_name").val()) {
        $("#f_name-info").html("(required)");
        $("#f_name").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#l_name").val()) {
        $("#l_name-info").html("(required)");
        $("#l_name").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#dob").val()) {
        $("#dob-info").html("(required)");
        $("#dob").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#email").val()) {
        $("#email-info").html("(required)");
        $("#email").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#personal_email").val()) {
        $("#personal_email-info").html("(required)");
        $("#personal_email").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#mobile").val()) {
        $("#mobile-info").html("(required)");
        $("#mobile").css('background-color','#FFFFDF');
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
    if(!$("#ctype").val()) {
        $("#ctype-info").html("(required)");
        $("#ctype").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#doj").val()) {
        $("#doj-info").html("(required)");
        $("#doj").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#exit_date").val()) {
        $("#exit_date-info").html("(required)");
        $("#exit_date").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#entity").val()) {
        $("#entity-info").html("(required)");
        $("#entity").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#department").val()) {
        $("#department-info").html("(required)");
        $("#department").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#designation").val()) {
        $("#designation-info").html("(required)");
        $("#designation").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#req_status").val()) {
        $("#req_status-info").html("(required)");
        $("#req_status").css('background-color','#FFFFDF');
        valid = false;
    }
    return valid;
}
</script>
</body>
</html>
<?php
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/scripts.php');
?>