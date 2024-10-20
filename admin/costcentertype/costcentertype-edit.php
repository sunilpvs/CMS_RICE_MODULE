<?php 
    date_default_timezone_set('Asia/Kolkata');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/adm-navbar.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/costcentertype/Costcentertype.php');
    if (!empty($result))
    {
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">CostCenter Type</h3>
  </div>
<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
 <div class="container">
   <div class="form-row">

   

    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Costcenter Type</label><span id="cc_type-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="cc_type" name= "cc_type" placeholder="Costcenter Type" value="<?php echo $row1["cc_type"]; ?>"  onchange="validateDuplicates()" required>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>      
        function validateDuplicates()
        {
            var costid = $("#id").val();
            var cc_type = $("#cc_type").val();  
            if(cc_type != "" )
            {
                //alert("Name and Code entered for validation");
                $.ajax(
                {
                    url:"check-duplicates-edit.php",
                    type:"POST",
                    data:{id:costid,cc_type:cc_type},
                    success:function(mydata)
                    {
                        $("#cc_type-info").html(mydata);
                    } 
                }
                )
            }
        }
    </script>


    <div class="col-md-4 mb-3">
          <input type="hidden" class="form-control demoInputBox" id="id" name= "id" placeholder="id" value="<?php echo $row1["id"]; ?>">
    </div>

  </div>
 </div>
 
 <div class="container">  
    <div class="col-md-4 mb-3">
        <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Update</button>
        <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../admin/costcentertype/cCostcentertype.php">Cancel</a></button> 
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
            
            if(!$("#cc_type").val()) {
                $("#cc_type-info").html("(required)");
                $("#cc_type").css('background-color','#FFFFDF');
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