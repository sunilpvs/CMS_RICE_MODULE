<!DOCTYPE html>
<html lang="en">
<?php  
  date_default_timezone_set('Asia/Kolkata'); 
  //Check if session already there....
  if(session_status() === PHP_SESSION_NONE) session_start();
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="900;url=../../user_management/logout.php" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Customer Management Portal (CMS)</title>
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
</head>
<body id="page-top"> 
  <!-- Page Wrapper -->
  <div id="wrapper">