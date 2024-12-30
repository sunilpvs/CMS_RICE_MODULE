<?php 
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/costcenter/Costcenter.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/adm-navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
?>
<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">New Costcenter Details</h3>
</div>
<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
    <div class="container">
        <div class="form-row">

        <div class="col-md-4 mb-3">
            <label for="validationDefault01" class="info">CostCenter Code</label><span id="cc_code-info" class="info"></span>
            <input type="text" maxlength= "4" onKeyDown="return/[a-z0-9.⌦←→⌫HT]/i.test(event.key)" class="form-control demoInputBox" id="cc_code" name= "cc_code" placeholder="CC_CODE" required>
            <input type="hidden" class="form-control demoInputBox" id="cc_type" name= "cc_type" placeholder="cc_type" value="2">
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script>
            $(document).ready(function()
            {
            $("#cc_code").on("focusout",function()
            {
                var costcenter = $("#cc_code").val();
                $.ajax(
                {
                    url:"check-cc_code.php",
                    type:"POST",
                    data:{cc_code:costcenter},
                    success:function(mydata)
                    {
                    $("#cc_code-info").html(mydata);
                    } 
                }
                )
            }
            )})
        </script> 

        <div class="col-md-4 mb-3">
            <label for="validationDefault05" class="info">Entity</label><span id="entity_id-info" class="info"></span>
            <select id="entity_id" name="entity_id" class="form-control demoInputBox">
            <option value="-1">Select Parent</option>    
            <?php
                $gen = new Generic();
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
            <label for="validationDefault03" class="info">Incorporation Date</label><span id="incorp_date-info" class="info"></span>
            <input type="date" class="form-control demoInputBox" id="incorp_date" name= "incorp_date" placeholder="Incorporation Date" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="validationDefault04" class="info">GST No</label><span id="gst_no-info" class="info"></span>
            <input type="text" maxlength="16" type="number" onKeyDown="return/[a-z0-9. ⌦←→⌫HT]/i.test(event.key)" class="form-control demoInputBox" id="gst_no" name= "gst_no" placeholder="GST No" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="validationDefault05" class="info">Address1</label><span id="add1-info" class="info"></span>
            <input type="text" maxlength="50" class="form-control demoInputBox" id="add1" name= "add1" placeholder="Address1" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="validationDefault05" class="info">Address2</label><span id="add2-info" class="info"></span>
            <input type="text"  maxlength="50" class="form-control demoInputBox" id="add2" name= "add2" placeholder="Address2" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="validationDefault05" class="info">City</label><span id="city-info" class="info"></span>
            <select id="city" name="city" class="form-control demoInputBox">
            <Option value =-1>Select City</>
            <?php
                $gen = new Generic();
                $result2 = $gen->getCityList();
                if (!empty($result2)) 
                {
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?>> <?php echo $row2["city"]; ?></option>
            <?php   } 
                }
            ?> 
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label for="validationDefault05" class="info">State</label><span id="state-info" class="info"></span>
            <select id="state" name="state" class="form-control demoInputBox">
            <Option value =-1>Select State</>
            <?php
                $gen = new Generic();
                $result2 = $gen->getStateList();
                if (!empty($result2)) 
                {
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?>> <?php echo $row2["state"]; ?></option>
            <?php   } 
                }
            ?> 
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label for="validationDefault05" class="info">Country</label><span id="country-info" class="info"></span>
            <select id="country" name="country" class="form-control demoInputBox">
            <Option value =-1>Select Country</>
            <?php
                $gen = new Generic();
                $result2 = $gen->getCountryList();
                if (!empty($result2)) 
                {
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?>> <?php echo $row2["country"]; ?></option>
            <?php   } 
                }
            ?> 
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label for="validationDefault05" class="info">Pin Code</label><span id="pin-info" class="info"></span>
            <input type="text" maxlength="6" onKeyDown="return/[0-9. ⌦←→⌫HT]/i.test(event.key)" class="form-control demoInputBox" id="pin" name= "pin" placeholder="Pincode" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="validationDefault05" class="info">Primary Contact</label><span id="primary_contact-info" class="info"></span>
            <select id="primary_contact" name="primary_contact" class="form-control demoInputBox">
            <Option value =-1>Select Contact</>
            <?php
                $gen = new Generic();
                $result2 = $gen->getEmpList();
                if (!empty($result2)) 
                {
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?>><?php echo $row2["employee"]; ?></option>
            <?php   } 
                }
            ?> 
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label for="validationDefault05" class="info">Status</label><span id="status-info" class="info"></span>
            <select id="status" name="status" class="form-control demoInputBox">
            <Option value =-1>Select Status</>
            <?php
                $gen = new Generic();
                $result2 = $gen->getModStatusList("GEN");
                if (!empty($result2)) 
                {
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?> > <?php echo $row2["status"]; ?></option>
            <?php   } 
                }
            ?> 
            </select>
        </div>

        <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../admin/costcenter/cCostcenter.php">Cancel</a></button> 
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
        
        if(!$("#cc_code").val()) {
            $("#cc_code-info").html("(required)");
            $("#cc_code").css('background-color','#FFFFDF');
            valid = false;
        }
        if($("#entity_id").val() == -1) {
            $("#entity_id-info").html("(required)");
            $("#entity_id").css('background-color','#FFFFDF');
            valid = false;
        } 
        if(!$("#incorp_date").val()) {
            $("#incorp_date-info").html("(required)");
            $("#incorp_date").css('background-color','#FFFFDF');
            valid = false;
        }
        if(!$("#gst_no").val()) {
            $("#gst_no-info").html("required");
            $("#gst_no").css('background-color','#FFFFDF');
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
        if($("#city").val()==-1) {
            $("#city-info").html("(required)");
            $("#city").css('background-color','#FFFFDF');
        valid = false;
        } 
        if($("#state").val()==-1) {
            $("#state-info").html("(required)");
            $("#state").css('background-color','#FFFFDF');
            valid = false;
        } 
        if($("#country").val()==-1) {
            $("#country-info").html("(required)");
            $("#country").css('background-color','#FFFFDF');
            valid = false;
        } 
        if(!$("#pin").val()) {
            $("#pin-info").html("(required)");
            $("#pin").css('background-color','#FFFFDF');
            valid = false;
        } 
        if($("#primary_contact").val()==-1) {
            $("#primary_contact-info").html("(required)");
            $("#primary_contact").css('background-color','#FFFFDF');
            valid = false;
        } 
        if($("#status").val()==-1) {
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