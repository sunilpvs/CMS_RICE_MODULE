<?php 
    date_default_timezone_set('Asia/Kolkata');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/adm-navbar.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/pages/Pages.php');
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
      <label for="validationDefault02" class="info">Module</label><span id="module-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="module" name= "module" placeholder="Module" value="<?php echo $row1["module"]; ?>"  required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Country</label><span id="page-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="page" name= "page" placeholder="Page" value="<?php echo $row1["page"]; ?>"  required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Path</label><span id="path-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="path" name= "path" placeholder="Path" value="<?php echo $row1["path"]; ?>"  required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Status</label><span id="status-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="status" name= "status" placeholder="Status" value="<?php echo $row1["status"]; ?>"  required>
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
        <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../admin/pages/cPages.php">Cancel</a></button> 
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
            
           
            if(!$("#module").val()) {
                $("#module-info").html("(required)");
                $("#module").css('background-color','#FFFFDF');
                valid = false;
            }
            if(!$("#state").val()) {
                $("#state-info").html("(required)");
                $("#state").css('background-color','#FFFFDF');
                valid = false;
            }
            if(!$("#path").val()) {
                $("#path-info").html("(required)");
                $("#path").css('background-color','#FFFFDF');
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