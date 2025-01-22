<?php 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/adm-navbar.php');
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
?>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">City</h3>
  </div>

<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">
 <div class="container">
   <div class="form-row">
 

    <div class="col-md-4 mb-3">
      <label for="validationDefault02">City</label><span id="city-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="city" name= "city" placeholder="City" onchange="validateDuplicates()" onKeyDown="return/[a-z0-9.⌦←→⌫HT]/i.test(event.key)" required>
    </div>

     
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">State</label><span id="state-info" class="info"></span>
      
      <select id="state" name="state" class="form-control demoInputBox" onchange="validateDuplicates()">
            <?php
                $emp = new Generic();
                $result2 = $emp->getStateList();
                if (!empty($result2)) {
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?> > <?php echo $row2["state"]; ?></option>
            <?php   } 
                }
            ?>
            ?>   
        </select>
    </div>

    
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Country</label><span id="country-info" class="info"></span>
      <select id="country" name="country" class="form-control demoInputBox" onchange="validateDuplicates()">
            <?php
                $emp = new Generic();
                $result2 = $emp->getCountryList();
                if (!empty($result2)) {
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?> > <?php echo $row2["country"]; ?></option>
            <?php   } 
                }
            ?>
            ?>   
        </select>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>      
        function validateDuplicates()
        {
            var city = $("#city").val();
            var state = $("#state").val();  
            var country = $("#country").val();
            if(city != "" && state != "" && country!= "")
            {
                //alert("Name and Code entered for validation");
                $.ajax(
                {
                    url:"check-duplicates.php",
                    type:"POST",
                    data:{city:city,state:state,country:country},
                    success:function(mydata)
                    {
                        $("#city-info").html(mydata);
                        $("#state-info").html(mydata);
                        $("#country-info").html(mydata);
                    } 
                }
                )
            }
        }
    </script>
    
   

 </div>
</div>
   
    <div class="container">
      <div class="col-md-4 mb-3">
        <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Create Record</button>
        <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../admin/city/cCity.php">Cancel</a></button> 
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
      
      if(!$("#city").val()) {
          $("#city-info").html("(required)");
          $("#city").css('background-color','#FFFFDF');
          valid = false;
      }
      if(!$("#state").val()) {
          $("#state-info").html("(required)");
          $("state").css('background-color','#FFFFDF');
          valid = false;
      }
      if(!$("#country").val()) {
          $("#country-info").html("(required)");
          $("#country").css('background-color','#FFFFDF');
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