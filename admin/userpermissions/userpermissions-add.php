<?php 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/adm-navbar.php');
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">user_id</h3>
  </div>

<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
 <div class="container">
   <div class="form-row">
  
   

    <div class="col-md-4 mb-3">
      <label for="validationDefault02">User Id</label><span id="user_id-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="user_id" name= "user_id" placeholder="user Id"  required>
    </div>
    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Page Id</label><span id="page_id-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="page_id" name= "page_id" placeholder="Page Id"  required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Access Type</label><span id="access_type-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="access_type" name= "access_type" placeholder="access_type"  required>
    </div>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>      
        function validateDuplicates()
        {
            var desname = $("#name").val();
            var descode = $("#code").val();  
            if(desname != "" && descode != "")
            {
                //alert("Name and Code entered for validation");
                $.ajax(
                {
                    url:"check-duplicates.php",
                    type:"POST",
                    data:{name:desname,code:descode},
                    success:function(mydata)
                    {
                        $("#name-info").html(mydata);
                        $("#code-info").html(mydata);
                    } 
                }
                )
            }
        }
    </script>--> 
    
   

 </div>
</div>
   
    <div class="container">
      <div class="col-md-4 mb-3">
        <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
        <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../admin/userpermissions/cUserpermissions.php">Cancel</a></button> 
      </div>
    </div>
 </div>
</div>
</form>
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
      if(!$("#Page_id").val()) {
          $("#Page_id-info").html("(required)");
          $("#Page_id").css('background-color','#FFFFDF');
          valid = false;
      }
      if(!$("#access_type").val()) {
          $("# access_type-info").html("(required)");
          $("# access_type").css('background-color','#FFFFDF');
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