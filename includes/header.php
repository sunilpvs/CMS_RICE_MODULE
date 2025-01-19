<!DOCTYPE html>
<html lang="en">
<?php  
  include($_SERVER['DOCUMENT_ROOT'] .'/config.php'); 

  date_default_timezone_set('Asia/Kolkata'); 
  # Start a new session, regenerate a session id if needed.
  if(!isset($_SESSION)) 
  { 
    session_start(); 
  }
  //Check if session already there....
  if (isset($_SESSION['logged']) && $_SESSION['logged'] = FALSE) 
  {
    $_SESSION = []; //_SESSION is now an empty array
    header('Location: ../login');
  }

  // Check if System Maintenance Mode
  $myrole = 0;
  if(isset($_SESSION['user_role_id']))
  {
    $myrole = $_SESSION['user_role_id'];
  }
  
  if($myrole !=1 && $maintenance == 1) 
  {
    header('Location: ../sysmaint');
  }
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="900;url=../../user_management/logout.php" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Customer Management Portal (CMS)</title>
  <script language="javascript" type="text/javascript">
    window.history.forward();
  </script>
  <!-- Custom fonts for this template-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link href="../../assests/sidebar/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../../assests/css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <link href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui-css" rel="stylesheet"/>

    <script type="text/javascript">
      document.oncontextmenu = new Function("return false");
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
    $('body').bind('cut copy paste', function(event) {
    event.preventDefault();
        });
    });

    document.addEventListener('keydown', function(event) {
    // Check for Ctrl + Shift + I
    if (event.ctrlKey && event.shiftKey && event.key === 'I') {
        event.preventDefault();
        alert('The Ctrl + Shift + I shortcut is disabled.');
    }
    // Check for Ctrl + Shift + J (another Developer Tools shortcut)
    if (event.ctrlKey && event.shiftKey && event.key === 'J') {
        event.preventDefault();
        alert('The Ctrl + Shift + J shortcut is disabled.');
    }
    // Check for F12 (F12 key opens Developer Tools)
    if (event.key === 'F12') {
        event.preventDefault();
        alert('The F12 key is disabled.');
    }
    });
    
  </script>
</head>
<body id="page-top"> 
  <!-- Page Wrapper -->
  <div id="wrapper">