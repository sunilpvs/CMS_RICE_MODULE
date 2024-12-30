<?php
  date_default_timezone_set('Asia/Kolkata'); 
  if(session_status() === PHP_SESSION_NONE) 
  { 
    session_start(); 
    if(isset($_SESSION['user_role_id'])){
      $myrole = $_SESSION['user_role_id'];
    }
  }
  if (isset($_SESSION['id'])) 
  {
    $myrole = $_SESSION['user_role_id'];
  }    
  #session_start();
   //$myrole
        //1	SUPER USER
        //2	IT ADMIN
        //3	MOD_RICE_ADMIN
        //4	MOD_RICE_USER
        //5	BASE_EMPLOYEE
  
  //Check if session already there....
  if (isset($_SESSION['id'])) 
  {
    // Already logged in with active Session.
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/DBController.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/admin/AdminLogin.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/adm-navbar.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid" style="background-color:white;">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4" style="background-color:white;">
    <h1 class="h3 mb-0 text-gray-800">Admin - Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>
  <!-- Content Row -->
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
  </div>
</div>

<?php
    #echo "<h2> Home Page</h2>";
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/scripts.php');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.php');
  }
  else
  { //Fresh Visit
    echo "<script>location.href='../admlogin'</script>";
    exit;
  }  
?>