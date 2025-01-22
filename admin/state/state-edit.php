<?php 
    date_default_timezone_set('Asia/Kolkata');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/adm-navbar.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/state/State.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php'); 
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
      <label for="validationDefault02" class="info">State</label><span id="state-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="state" name= "state" placeholder="State" value="<?php echo $row1["state"]; ?>"  onchange="validateDuplicates()" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Country</label><span id="country-info" class="info"></span>
      <select id="country" name="country" class="form-control demoInputBox" onchange="validateDuplicates()">
            <?php
                $emp = new Generic();
                $result2 = $emp->getCountryList();
                if (!empty($result2)) {
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1["country"] ){ echo "Selected"; } ?> > <?php echo $row2["country"]; ?></option>
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
            var stateid = $("#id").val();
            var state = $("#state").val();
            var country = $("#country").val();  
            if(state != "" && country != "")
            {
                //alert("Name and Code entered for validation");
                $.ajax(
                {
                    url:"check-duplicates-edit.php",
                    type:"POST",
                    data:{id:stateid,state:state,country:country},
                    success:function(mydata)
                    {
                        $("#state-info").html(mydata);
                        $("#country-info").html(mydata);
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
        <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../admin/state
        /cState.php">Cancel</a></button> 
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
            
           
            if(!$("#state").val()) {
                $("#state-info").html("(required)");
                $("#state").css('background-color','#FFFFDF');
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