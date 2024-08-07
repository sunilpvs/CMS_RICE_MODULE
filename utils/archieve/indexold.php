<?php
// # Executed below code first time when the page is launched.
// if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 900)) {
//     // last request was more than 15 minutes ago
//     session_unset();     // unset $_SESSION variable for the run-time 
//     session_destroy();   // destroy session data in storage
// }
// $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
#require_once ("class/Users.php");

require_once ("ControllerUserData.php");

//Check if session already there....
if(session_status() === PHP_SESSION_NONE) session_start();

// if(isset($_POST["uname"]) & isset($_POST["password"]))
// {
//     $user = new Users();
//     $validate=$login->validateLogin($_POST["uname"],$_POST["password"]);
// 	if($validate)
//     {
//         $staus = $_SESSION['status'];
//         $code = $_SESSION['code'];
//         if($status == "verified" && $code != 0)
//         {    
//             header('Location: reset-code.php');
//         }
//         else if($status == "notverified")
//         {
//             header('Location: user-otp.php');
//         }
//         else {
// 			//	//Login Successful
// 			require_once "web/header.php";
// 			echo "<center> <h2> Welcome,".$_SESSION['l_name']." ".$_SESSION['f_name']."</h2>";
// 			#echo $_SESSION['uid']." <br> ". $_SESSION['email'] . " <br> ";
// 			require_once "web/footer.php";	
// 			exit;
//         }
// 	}
// 	else{ //Invalid Login
// 		session_abort();
// 		echo "<script>alert('username or password incorrect!')</script>";
//         echo "<script>location.href='login.php'</script>";
// 	}
// }
if (isset($_SESSION['id'])) 
{
	// Already logged in with active Session.
	require_once "includes/header.php";
	require_once "includes/navbar.php";
    #echo "<h2> Home Page</h2>";
    require_once "includes/footer.php";
}
else
{ //Fresh Visit
		#echo "<script>alert('username or password incorrect!')</script>";
		echo "<script>location.href='login.php'</script>";
}
?>