<?php 
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/department/Department.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/adm-navbar.php');

    if (!empty($result)){
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
?>
<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Edit Department Details
            
    </h3>
  </div>

<div class="card-body">

<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">

  <div class="container">
  <div class="form-row">
  
    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Department Name</label><span
            id="name-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="name" name= "name" placeholder="Department Name" value="<?php echo $row1["name"]; ?>" onChange="validateDuplicates()" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault02" class="info">Code</label><span
            id="code-info" class="info"></span>
      <input type="text" class="form-control demoInputBox" id="code" name= "code" placeholder="Code" value="<?php echo $row1["code"]; ?>" onChange="validateDuplicates()" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="validationDefault01" class="info">Status</label><span id="status-info" class="info"></span>
      <select id="status" name="status" class="form-control demoInputBox">
            <?php
                $emp = new Generic();
                $result2 = $emp->getModStatusList("GEN");
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
           <input type="hidden" class="form-control demoInputBox" id="department_id" name= "department_id" placeholder="" value="<?php echo $row1["id"]; ?>">
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      
        function validateDuplicates()
        {
            var depid = $("#department_id").val();
            var depname = $("#name").val();
            var depcode = $("#code").val();

            if(depname != "" && depcode != "")
            {
                //alert("Name and Code entered for validation");
                $.ajax(
                {
                    url:"check-duplicates-edit.php",
                    type:"POST",
                    data:{id:depid,name:depname,code:depcode},
                    success:function(mydata)
                    {
                        $("#name-info").html(mydata);
                        $("#code-info").html(mydata);
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
                <button class="btn btn-primary" type="submit" name="add" id="btnSubmit" value="Add">Update Record</button>
                <button class="btn btn-primary" type="cancel" name="cancel" id="btnCancel" value="Cancel" ><a style="color:white;" href ="../../admin/department/cDepartment.php">Cancel</a></button> 
            </div>
        </div>

</form>
</div>
</div>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"
        type="text/javascript"></script>
    <script>
function validate() {
    var valid = true;   
    $(".form-control demoInputBox").css('background-color','');
    $(".info").html('');
    
    if(!$("#name").val()) {
        $("#name-info").html("(required)");
        $("#name").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#code").val()) {
        $("#code-info").html("(required)");
        $("#code").css('background-color','#FFFFDF');
        valid = false;
    }

    if(!$("#department_id").val()) {
        $("#department_id-info").html("(required)");
        $("#department_id").css('background-color','#FFFFDF');
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