<?php 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/adm-navbar.php');
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Contact Type</h3>
  </div>

<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
 <div class="container">
   <div class="form-row">
 

    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Name</label><span id="name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="name" name= "name" placeholder="Name"  required>
    </div>

     
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Status</label><span id="status-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="status" name= "status" placeholder="Status"  required>
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
    </script> -->
    
   

 </div>
</div>
   
    <div class="container">
      <div class="col-md-4 mb-3">
        <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
        <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../admin/contacttype/cContacttype.php">Cancel</a></button> 
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
      
     
     
      if(!$("#name").val()) {
          $("#name-info").html("(required)");
          $("#name").css('background-color','#FFFFDF');
          valid = false;
      }
      if(!$("#status").val()) {
          $("#status-info").html("(required)");
          $("status").css('background-color','#FFFFDF');
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