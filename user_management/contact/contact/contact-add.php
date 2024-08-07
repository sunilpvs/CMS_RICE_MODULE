<?php 
    require_once($_SERVER['DOCUMENT_ROOT'] .'\web\header.php');
?>
<Center>
<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">
    <div id="mail-status"></div>
    <div>
        <label style="padding-top: 20px;">First Name</label> <span
            id="f_name-info" class="info"></span><br /> <input type="text"
            name="f_name" id="f_name" class="demoInputBox">
    </div>
    <div>
        <label>Last Name</label> <span
            id="l_name-info" class="info"></span><br /> <input type="text"
            name="l_name" id="l_name" class="demoInputBox">
    </div>
    <div>
        <label>Dob</label> <span id="dob-info"
            class="info"></span><br /> <input type="text"
            name="dob" id="dob" class="demoInputBox">
    </div>
    <div>
        <label>Email</label> <span id="email-info"
            class="info"></span><br /> <input type="text"
            name="email" id="email" class="demoInputBox">
    </div>
   
    <div>
        <input type="submit" name="add" id="btnSubmit" value="Add" />
    </div>
    </div>
</form>
</Center>
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
        $("code").css('background-color','#FFFFDF');
        valid = false;
    }
   
     
    return valid;
}
</script>
</body>
</html>