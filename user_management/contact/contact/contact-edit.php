<?php 
    require_once($_SERVER['DOCUMENT_ROOT'] .'\web\header.php');
?>

<center>
<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">
    <div id="mail-status"></div>
    <div>
        <label style="padding-top: 20px;">Name</label> <span
            id="name-info" class="info"></span><br /> <input type="text"
            name="name" id="name" class="demoInputBox"
            value="<?php echo $result[0]["name"]; ?>">
    </div>
    <div>
        <label>Code</label> <span id="code-info"
            class="info"></span><br /> <input type="text"
            name="code" id="code" class="demoInputBox"
            value="<?php echo $result[0]["code"]; ?>">
    </div>
    <div>
        <label>Status</label> <span id="code-info"
            class="info"></span><br /> <input type="text"
            name="status" id="status" class="demoInputBox"
            value="<?php echo $result[0]["status"]; ?>">
    </div>
   
    <div>
        <input type="submit" name="add" id="btnSubmit" value="Save" />
    </div>
    </div>
</form>
</center>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"
        type="text/javascript"></script>
    <script>
function validate() {
    var valid = true;   
    $(".demoInputBox").css('background-color','');
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
    
    return valid;
}
</script>
    </body>
    </html>