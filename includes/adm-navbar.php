<?php
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/DBController.php');

    $myrole = $_SESSION['user_role_id'];
      //$myrole
        //1	System/SUPER USER
        //2	IT ADMIN
        //3	MOD_RICE_ADMIN
        //4	MOD_RICE_USER
        //5	BASE_EMPLOYEE
?>
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-light sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
          <center> <a href="../../admin/adm_index.php" class="navbar-brand">
              <img src="../../assests/img/logo.png" height="70" alt="PVS_Consultancy" align="center"> </a>
          </center>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="../../admhome">
            <i class="fas fa-fw fa-tachometer-alt" style="color:grey"></i>
            <span style="color:grey">Dashboard</span></a>
        </li>
<?php
  //$myrole SUPER USER IT ADMIN MOD_RICE_ADMIN MOD_RICE_USER BASE_EMPLOYEE
    if($myrole == 1 || $myrole == 2)
    {
?>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading" style="color:grey">
          Configuration Data
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog" style="color:grey"></i>
            <span style="color:grey">Master Data</span>
          </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="../../admstatus">Status</a>
                <a class="collapse-item" href="../../admctype">Contact Type</a>
                <a class="collapse-item" href="../../admcctype">Cost Center Type</a>
                <a class="collapse-item" href="../../admcountry">Country</a>
                <a class="collapse-item" href="../../admstate">State</a>
                <a class="collapse-item" href="../../admcity">City</a>
                <a class="collapse-item" href="../../admdept">Department</a>
                <a class="collapse-item" href="../../admdesig">Designation</a>
              </div>
            </div>
        </li>         
  <?php
    }
    //$myrole SUPER USER IT ADMIN MOD_RICE_ADMIN MOD_RICE_USER BASE_EMPLOYEE
    if($myrole == 1 || $myrole == 2 )
    {
  ?>
          <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapselease" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog" style="color:grey"></i>
            <span style="color:grey">User Management</span>
          </a>
          <div id="collapselease" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="../../admpages">Pages</a>
              <a class="collapse-item" href="../../admroles">Roles</a>      
              <a class="collapse-item" href="../../admperm">Permissions</a>
            </div>
          </div>
        </li>

  <?php
    }
  ?>     
        <!-- Divider -->
        <hr class="sidebar-divider">
 
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column" style="background-color:white;">

      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

           

          <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php $disp_name = $_SESSION['f_name']." ".$_SESSION['l_name']; ?>
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $disp_name;?></span>
                <img class="img-profile rounded-circle" src="../../assests/img/profile-icon.jpg">
                <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
                
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../../profile">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>

                <a class="dropdown-item" href="../../activity">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>       

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form action="../../user_management/logout.php" method="POST"> 
            <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>