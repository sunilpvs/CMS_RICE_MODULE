<?php 
    date_default_timezone_set('Asia/Kolkata');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/adm-navbar.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/userpermissions/Userpermissions.php');
    if (!empty($result))
    {
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">State</h3>
  </div>
<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
 <div class="container">
   <div class="form-row">

    

    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">User Id</label><span id="user_id-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="user_id" name= "user_id" placeholder="State" value="<?php echo $row1["user_id"]; ?>"  required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Page Id</label><span id="page_id-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="page_id" name= "page_id" placeholder="Page Id" value="<?php echo $row1["page_id"]; ?>"  required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Access Type</label><span id="access_type-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="access_type" name= "access_type" placeholder="Access Type" value="<?php echo $row1["access_type"]; ?>"  required>
    </div>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>      
        function validateDuplicates()
        {
            var desid = $("#designation_id").val();
            var desname = $("#name").val();
            var descode = $("#code").val();  
            if(desname != "" && descode != "")
            {
                //alert("Name and Code entered for validation");
                $.ajax(
                {
                    url:"check-duplicates-edit.php",
                    type:"POST",
                    data:{id:desid,name:desname,code:descode},
                    success:function(mydata)
                    {
                        $("#name-info").html(mydata);
                        $("#code-info").html(mydata);
                    } 
                }
                )
            }
        }
    </script> -->


    <div class="col-md-4 mb-3">
          <input type="hidden" class="form-control demoInputBox" id="designation_id" name= "designation_id" placeholder="Commodity" value="<?php echo $row1["id"]; ?>">
    </div>

  </div>
 </div>
 
 <div class="container">  
    <div class="col-md-4 mb-3">
        <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Update</button>
        <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../admin/userpermissions/cUserpermissions.php">Cancel</a></button> 
    </div>
  </div>
</form>
</div>
</div>
</div>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script>
        function validate() 
        {
            var valid = true;   
            $(".form-control demoInputBox").css('background-color','');
            $(".info").html('');
            
           
            if(!$("#user_id").val()) {
                $("#user_id-info").html("(required)");
                $("#user_id").css('background-color','#FFFFDF');
                valid = false;
            }
            if(!$("#page_id").val()) {
                $("#page_id-info").html("(required)");
                $("#page_id").css('background-color','#FFFFDF');
                valid = false;
            }   
            if(!$("#access_type").val()) {
                $("#access_type-info").html("(required)");
                $("#access_type").css('background-color','#FFFFDF');
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