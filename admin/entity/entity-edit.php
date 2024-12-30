<?php 
    date_default_timezone_set('Asia/Kolkata');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/adm-navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');

    if (!empty($result))
    {
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>
<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Edit Entity Details</h3>
</div>
<div class="card-body">
<form name="frmAdd" method="post" action="" id="frmAdd" onSubmit="return validate();">

<div class="container">
    <div class="form-row">

        <div class="col-md-4 mb-3">
            <label for="validationDefault01" class="info">Entity Name:</label><span id="entity_name-info" class="info"></span>
            <input type="text" maxlength ="50"  onKeyDown="return/[a-z0-9. ⌦←→⌫HT]/i.test(event.key)" class="form-control demoInputBox" id="entity_name" name= "entity_name" placeholder="Entity Name" value="<?php echo $row1["entity_name"]; ?>" required>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script>
            $(document).ready(function()
            {
            $("#entity_name").on("focusout",function()
            {
                var entityname = $("#entity_name").val();
                $.ajax(
                {
                    url:"check-entityname.php",
                    type:"POST",
                    data:{entity_name:entityname},
                    success:function(mydata)
                    {
                    $("#entity_name-info").html(mydata);
                    } 
                }
                )
            }
            )})
        </script> 

        <div class="col-md-4 mb-3">
            <label for="validationDefault02" class="info">Cin No:</label><span id="cin-info" class="info"></span>
            <input type="text" maxlength = "22" onKeyDown="return/[a-z0-9.⌦←→⌫HT]/i.test(event.key)" class="form-control demoInputBox" id="cin" name= "cin" placeholder="CIN NO" value="<?php echo $row1["cin"]; ?>"  required>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script>
            $(document).ready(function()
            {
            $("#cin").on("focusout",function()
            {
                var entitycin = $("#cin").val();
                $.ajax(
                {
                    url:"check-cin.php",
                    type:"POST",
                    data:{cin:entitycin },
                    success:function(mydata)
                    {
                    $("#cin-info").html(mydata);
                    } 
                }
                )
            }
            )})
        </script> 

        <div class="col-md-4 mb-3">
            <label for="validationDefault03" class="info">Incorporation Date:</label><span id="incorp_date-info" class="info"></span>
            <input type="date" class="form-control demoInputBox" id="incorp_date" name= "incorp_date" placeholder="Incorporation Date" value="<?php echo $row1["incorp_date"]; ?>" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="validationDefault01" class="info">Status</label><span id="status-info" class="info"></span>
            <select id="status" name="status" class="form-control demoInputBox">
            <option value=-1>Select Status</>
            <?php
                $gen = new Generic();
                $result2 = $gen->getModStatusList("GEN");
                if (!empty($result2)) {
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC))
                    {   
            ?> 
            <option value=<?php echo $row2['id']; ?> <?php if($row2['id'] == $row1["status"] ){ echo "Selected"; } ?> > <?php echo $row2["status"]; ?></option>
            <?php   } 
                }
            ?>               
            </select>
        </div>         

        <div class="col-md-4 mb-3">
           <input type="hidden" class="form-control demoInputBox" id="entity_id" name= "entity_id" placeholder="entity_id" value="<?php echo $row1["id"]; ?>">
        </div>

        <div class="container">
            <div class="col-md-4 mb-3">
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Update Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../admin/entity/cEntity.php">Cancel</a></button> 
            </div>
        </div>
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
        $(".form control demoInputBox").css('background-color','');
        $(".info").html('');
              
        if(!$("#entity_name").val()) {
        $("#entity_name-info").html("(required)");
        $("#entity_name").css('background-color','#FFFFDF');
        valid = false;
        } 
        if(!$("#cin").val()) {
        $("#cin-info").html("(required)");
        $("#cin").css('background-color','#FFFFDF');
        valid = false;
        } 
        if(!$("#incorp_date").val()) {
        $("#incorp_date-info").html("(required)");
        $("#incorp_date").css('background-color','#FFFFDF');
        valid = false;
        } 
        if($("#status").val() == -1) {
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