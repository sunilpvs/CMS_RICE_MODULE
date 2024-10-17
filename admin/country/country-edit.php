<?php 
    date_default_timezone_set('Asia/Kolkata');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/adm-navbar.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/country/country.php');
    if (!empty($result))
    {
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">country</h3>
  </div>
<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
 <div class="container">
   <div class="form-row">

  

    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">country</label><span id="country-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="country" name= "country" placeholder="Country" value="<?php echo $row1["country"]; ?>" onchange="validateDuplicates()" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Code</label><span id="code-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="code" name= "code" placeholder="Code" value="<?php echo $row1["code"]; ?>" onchange="validateDuplicates()" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Currency</label><span id="currency-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="currency" name= "currency" placeholder="Currency" value="<?php echo $row1["currency"]; ?>" onchange="validateDuplicates()" required>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>      
        function validateDuplicates()
        {
            var countryid = $("#id").val();
            var country = $("#country").val();
            var code = $("#code").val(); 
            var currency = $("#currency").val();  
            if(country != "" && code != "" && currency !="")
            {
                //alert("Name and Code entered for validation");
                $.ajax(
                {
                    url:"check-duplicates-edit.php",
                    type:"POST",
                    data:{id:cityid,country:country,code:code,currency:currency},
                    success:function(mydata)
                    {
                        $("#country-info").html(mydata);
                        $("#code-info").html(mydata);
                        $("#currency-info").html(mydata);
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
        <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../admin/country/ccountry.php">Cancel</a></button> 
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
            
          
            if(!$("#country").val()) {
                $("#country-info").html("(required)");
                $("#country").css('background-color','#FFFFDF');
                valid = false;
            }
            if(!$("#code").val()) {
                $("#code-info").html("(required)");
                $("#code").css('background-color','#FFFFDF');
                valid = false;
            }
            if(!$("#currency").val()) {
                $("#currency-info").html("(required)");
                $("#currency").css('background-color','#FFFFDF');
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