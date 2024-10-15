<?php 
    date_default_timezone_set('Asia/Kolkata');
   # require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
        require_once($_SERVER['DOCUMENT_ROOT'] .'/lease_management/outwardlease/Outwardlease.php');
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
    <h3 class="m-0 font-weight-bold text-primary">View OutwardLease Details
            
    </h3>
  </div>

<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
  <div class="container">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Warehouse</label><span id="warehouse_id-info" class="info"></span>
            <input type="Text" maxlength = "10" class="form-control demoInputBox" id="warehouse_id" name= "warehouse_id" placeholder="warehouse_id" value="<?php echo $row1['warehouse_id']; ?>" readonly>
      
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Lessor Name</label><span id="lessor_name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="lessor_name" name= "lessor_name" placeholder="Lessor Name" value="<?php echo $row["lessor_name"]; ?>" readonly>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Lessor Type</label><span id="ltype-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="ltype" name= "ltype" placeholder="Lessor Type" value="<?php echo $row["ltype"]; ?>" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Capacity Sqft</label><span id="capacity_sqft-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="capacity_sqft" name= "capacity_sqft" placeholder="capacity_sqft" value="<?php echo $row["capacity_sqft"]; ?>" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Capacity Mton</label><span id="capacity_mton-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="capacity_mton" name= "capacity_mton" placeholder="capacity_mton" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Inward Lease - Contract Ref</label><span id="contract_id-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="contract_id" name= "contract_id" placeholder="contract_id" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Inward Lease - Start Date</label><span id="start_date-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="start_date" name= "start_date" placeholder="start_date" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Inward Lease - End Date</label><span id="expiry_date-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="expiry_date" name= "expiry_date" placeholder="expiry_date" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">City</label><span id="city-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="city" name= "city" placeholder="City" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">State</label><span id="state-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="state" name= "state" placeholder="State" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Primary Contact</label><span id="contact-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="contact" name= "contact" placeholder="Primary Contact" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Email</label><span id="email-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="email" name= "email" placeholder="Email" disabled>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Mobile</label><span id="mobile-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="mobile" name= "mobile" placeholder="Mobile" disabled>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Available Capacity(sqft)</label><span id="avl_sqft-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="avl_sqft" name= "avl_sqft" placeholder="0.00" readonly>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Available Capacity(mton)</label><span id="avl_mton-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="avl_mton" name= "avl_mton" placeholder="0.00" readonly>
    </div> 
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

      function myLoadFunction()
      {
        //id,warehouse_name,code,lessor_name,ltype,capacity_sqft,capacity_mton,contract_id,start_date,expiry_date,city,state,contact,email,mobile
        var index = document.getElementById("warehouse_id").selectedIndex;
        var lessor_name = document.getElementById("warehouse_id").options[index].getAttribute("data-lessor_name");
        var ltype = document.getElementById("warehouse_id").options[index].getAttribute("data-ltype");
        var capacity_sqft = document.getElementById("warehouse_id").options[index].getAttribute("data-capacity_sqft");
        var capacity_mton = document.getElementById("warehouse_id").options[index].getAttribute("data-capacity_mton");
        var contract_id = document.getElementById("warehouse_id").options[index].getAttribute("data-contract_id");
        var start_date = document.getElementById("warehouse_id").options[index].getAttribute("data-start_date");
        var expiry_date = document.getElementById("warehouse_id").options[index].getAttribute("data-expiry_date");
        var city = document.getElementById("warehouse_id").options[index].getAttribute("data-city");
        var state = document.getElementById("warehouse_id").options[index].getAttribute("data-state");
        var contact = document.getElementById("warehouse_id").options[index].getAttribute("data-contact");
        var email = document.getElementById("warehouse_id").options[index].getAttribute("data-email");
        var mobile = document.getElementById("warehouse_id").options[index].getAttribute("data-mobile");
        var avl_sqft = document.getElementById("warehouse_id").options[index].getAttribute("data-avl_sqft");
        var avl_mton = document.getElementById("warehouse_id").options[index].getAttribute("data-avl_mton");

        document.getElementsByName("lessor_name")[0].value = lessor_name;
        document.getElementsByName("ltype")[0].value = ltype;
        document.getElementsByName("capacity_sqft")[0].value = capacity_sqft;
        document.getElementsByName("capacity_mton")[0].value = capacity_mton;
        document.getElementsByName("contract_id")[0].value = contract_id;
        document.getElementsByName("start_date")[0].value = start_date;
        document.getElementsByName("expiry_date")[0].value = expiry_date;       
        document.getElementsByName("city")[0].value = city;
        document.getElementsByName("state")[0].value = state;
        document.getElementsByName("contact")[0].value = contact;
        document.getElementsByName("email")[0].value = email;
        document.getElementsByName("mobile")[0].value = mobile;
        document.getElementsByName("avl_sqft")[0].value = avl_sqft;
        document.getElementsByName("avl_mton")[0].value = avl_mton;
        
      }
    </script>

  </div>

  <div class="form-row">    
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Customer</label><span id="customer_id-info" class="info"></span>
      <input type="Text" maxlength = "10" class="form-control demoInputBox" id="customer_id" name= "customer_id" placeholder="Lease Contract" value="<?php echo $row['id']; ?> > <?php echo $row["customer_name"]; ?>" readonly>
      <select id="customer_id" name="customer_id" class="form-control demoInputBox">
          <?php
              $gen = new Generic();
              $result = $gen->getCustomerList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option value=<?php echo $row['id']; ?> > <?php echo $row["customer_name"]; ?></option>
          <?php   } 
              }
          ?>         
      </select>
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Lease Agreement Ref</label><span id="lease_contract_id-info" class="info"></span>
      <input type="Text" maxlength = "10" class="form-control demoInputBox" id="lease_contract_id" name= "lease_contract_id" placeholder="Lease Agreement Ref." value="<?php echo $row1["lease_contract_id"]; ?>" readonly>
    </div>

    <div class="col-md-4 mb-3" id="lease_model">
      <label for="validationDefault01" class="info">Lease Model</label><span id="lease_model-info" class="info"></span>
      <select id="lease_model" name="lease_model" class="form-control demoInputBox" onchange="disablefunction()">
          <option value = "-1" >Select lease Model</option>    
          <?php
              $gen = new Generic();
              $result = $gen->getLeaseModelList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option data-lmodel= <?php echo $row['lease_model']; ?> value=<?php echo $row['id']; ?> > <?php echo $row["lease_model"]; ?></option>
          <?php   } 
              }
          ?>         
      </select>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Compartment Code</label><span id="compartment_code-info" class="info"></span>
      <input type="Text" maxlength = "10" class="form-control demoInputBox" id="compartment_code" name= "compartment_code" placeholder="Compartment Code" value="<?php echo $row1["compartment_code"]; ?>" readonly>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Client Lease Start</label><span id="lease_start-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="lease_start" name= "lease_start" placeholder="mm/dd/yyyy" required onchange="calculateDateDiff()" onchange="CompareDate()" value="<?= date('Y-m-d') ?>" value="<?php echo $row1["lease_start"]; ?>" readonly>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Client Lease End</label><span id="lease_end-info" class="info"></span>
      <input type="date" class="form-control demoInputBox" id="lease_end" name= "lease_end" placeholder="mm/dd/yyyy" required onchange="calculateDateDiff()" value="<?= date('Y-m-d') ?>" value="<?php echo $row1["lease_end"]; ?>" readonly>    
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
      function calculateDateDiff()
      {
        var dat1 = document.getElementById('lease_start').value;
        var lease_start = new Date(dat1)//converts string to date object
        var dat2 = document.getElementById('lease_end').value;
        var lease_end = new Date(dat2)
        var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
        var diffDays = Math.abs((lease_start.getTime() - lease_end.getTime()) / (oneDay));       
        document.getElementsByName("lease_days")[0].value = diffDays;
      }    

      function disablefunction()
      {
          
        var index = document.getElementsByName("lease_model")[0].selectedIndex;
        var lmodel = document.getElementsByName("lease_model")[0].options[index].getAttribute("data-lmodel");
        
        switch (lmodel)
        {
          case ("Dedicated"):
            document.getElementsByName("lease_capacity_mton")[0].style.visibility="hidden";
            document.getElementsByName("daily_rate_mton")[0].style.visibility="hidden";
            document.getElementsByName("cost_mton")[0].style.visibility="hidden";
            document.getElementsByName("lease_capacity_sqft")[0].style.visibility="visible";
            document.getElementsByName("daily_rate_sqft")[0].style.visibility="visible";
            document.getElementsByName("cost_sqft")[0].style.visibility="visible";
            break;
            
          case "Common/Shared":
            document.getElementById("lease_capacity_sqft").style.visibility="hidden";
            document.getElementById("daily_rate_sqft").style.visibility="hidden";
            document.getElementById("cost_sqft").style.visibility="hidden";
            document.getElementById("lease_capacity_mton").style.visibility="visible";
            document.getElementById("daily_rate_mton").style.visibility="visible";
            document.getElementById("cost_mton").style.visibility="visible";
            break;

          default:
            document.getElementById("lease_capacity_mton").style.visibility="visible";
            document.getElementById("daily_rate_mton").style.visibility="visible";
            document.getElementById("lease_capacity_sqft").style.visibility="visible";
            document.getElementById("daily_rate_sqft").style.visibility="visible";
            document.getElementById("cost_mton").style.visibility="visible";
            document.getElementById("cost_sqft").style.visibility="visible";
          }
      }
    </script>

    <div class="col-md-4 mb-3" >
      <label for="validationDefault01" class="info">Leased Capacity (Sqft)</label><span id="lease_capacity_sqft-info" class="info"></span> 
      <input type="text" min="0" max="99999999" step="0.01" class="form-control demoInputBox" id="lease_capacity_sqft" name= "lease_capacity_sqft" placeholder="0.00" minlength="0" maxlength="12" value="0.00" value="<?php echo $row1["lease_capacity_sqft"]; ?>" readonly>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
	    $(document).ready(function()
	    {
        $("#lease_capacity_sqft").on("focusout",function()
        {
		      var outwardlease = $("#lease_capacity_sqft").val();
		      $.ajax(
		      {
			      url:"aailable-capacity_sqft.php",
			      type:"POST",
			      data:{lease_capacity_sqft:outwardlease},
			      success:function(mydata)
			      {
                $("#lease_capacity_sqft-info").html(mydata);
			      } 
		      }
		      )
        }
  
        )})
    </script>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Daily Rate (Sqft)</label><span id="daily_rate_sqft-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="daily_rate_sqft" name= "daily_rate_sqft" placeholder="0.00" min="0" value="0.00" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'"  onchange="calculatecost()" onfocusout="calculatecost()" value="<?php echo $row1["daily_rate_sqft"]; ?>" readonly>
    </div>

    <div class="col-md-4 mb-3" >
      <label for="validationDefault03" class="info">Cost (Sqft)</label><span id="cost_sqft-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="cost_sqft" name= "cost_sqft" placeholder="0.00" value ="0.00" value="<?php echo $row1["cost_sqft"]; ?>" readonly>
    </div> 

    <div class="col-md-4 mb-3" >
      <label for="validationDefault01" class="info">Leased Capacity (Mton)</label><span id="lease_capacity_mton-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="lease_capacity_mton" name= "lease_capacity_mton" placeholder="0.00" minlength="0" maxlength="12" value="0.00" value="<?php echo $row1["Tlease_capacity_mton"]; ?>" readonly>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
	    $(document).ready(function()
	    {
        $("#lease_capacity_mton").on("focusout",function()
        {
		      var outwardlease = $("#lease_capacity_mton").val();
		      $.ajax(
		      {
			      url:"aailable-capacity_mton.php",
			      type:"POST",
			      data:{lease_capacity_mton:outwardlease},
			      success:function(mydata)
			      {
                $("#lease_capacity_mton-info").html(mydata);
			      } 
		      }
		      )
        }
  
        )})
    </script>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Daily Rate (Mton)</label><span id="daily_rate_mton-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="daily_rate_mton" name= "daily_rate_mton" placeholder="0.00" min="0" value="0.00" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'" onchange="calculatecost()" onfocusout="calculatecost()" value="<?php echo $row1["daily_rate_mton"]; ?>" readonly>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Cost (Mton)</label><span id="cost_mton-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="cost_mton" name= "cost_mton" placeholder="0.00" value ="0.00" step="0.01" value="<?php echo $row1["cost_mton"]; ?>" readonly>
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Lease Days</label><span id="lease_days-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="lease_days" name= "lease_days" placeholder="Lease Days" value="0" value="<?php echo $row1["lease_days"]; ?>" readonly>
    </div> 

    <div class="col-md-4 mb-3">
      <label for="validationDefault03" class="info">Total Cost</label><span id="total_cost-info" class="info"></span>
      <input type="number" class="form-control demoInputBox" id="total_cost" name= "total_cost" placeholder="0.00" step="0.01" value="0.00" min="0" readonly value="<?php echo $row1["total_Cost"]; ?>">
    </div> 

    

  <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Lease Status</label><span id="lease_status-info" class="info"></span>
      <select id="lease_status" name="lease_status" class="form-control demoInputBox">
          <?php
              $gen = new Generic();
              $result = $gen->getStatusList();
              if (!empty($result)) {
                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                  {   
          ?> 
          <option value=<?php echo $row['ID']; ?> > <?php echo $row["Status"]; ?></option>
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
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../lease_management/outwardlease/cOutwardlease.php">Cancel</a></button> 
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
    
    if(!$("#warehouse_id").val()) {
        $("#warehouse_id-info").html("(required)");
        $("#warehouse_id").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#customer_id").val()) {
        $("#customer_id-info").html("(required)");
        $("#customer_id").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#lease_contract_id").val()) {
        $("#lease_contract_id-info").html("(required)");
        $("#lease_contract_id").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#compartment_code").val()) {
        $("#compartment_code-info").html("(required)");
        $("#compartment_code").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#lease_start").val()) {
        $("#lease_start-info").html("(required)");
        $("#lease_start").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#lease_end").val()) {
        $("#lease_end-info").html("(required)");
        $("#lease_end").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#lease_capacity_sqft").val()) {
        $("#lease_capacity_sqft-info").html("(required)");
        $("#lease_capacity_sqft").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#daily_rate_sqft").val()) {
        $("#daily_rate_sqft-info").html("(required)");
        $("#daily_rate_sqft").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#cost_sqft").val()) {
        $("#cost_sqft-info").html("(required)");
        $("#cost_sqft").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#lease_capacity_mton").val()) {
        $("#lease_capacity_mton-info").html("(required)");
        $("#lease_capacity_mton").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#daily_rate_mton").val()) {
        $("#daily_rate_mton-info").html("(required)");
        $("#daily_rate_mton").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#cost_mton").val()) {
        $("#cost_mton-info").html("(required)");
        $("#cost_mton").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#lease_days").val()) {
        $("#lease_days-info").html("(required)");
        $("#lease_days").css('background-color','#FFFFDF');
        valid = false;
    }

    if(!$("#total_cost").val()) {
        $("#total_cost-info").html("(required)");
        $("#total_cost").css('background-color','#FFFFDF');
        valid = false;
    }
    
    if(!$("#lease_status").val()) {
        $("#lease_status-info").html("(required)");
        $("#lease_status").css('background-color','#FFFFDF');
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