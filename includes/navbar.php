<?php
    date_default_timezone_set('Asia/Kolkata');
    require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/DBController.php');

    $myrole = $_SESSION['user_role_id'];
    //$myrole
        //1	SUPER USER
        //2	IT ADMIN
        //3	MOD_RICE_ADMIN
        //4	MOD_RICE_USER
        //5	BASE_EMPLOYEE
?>
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
          <center> <a href="../../home" class="navbar-brand">
              <img src="../../assests/img/logo.png" height="70" alt="PVS_Consultancy" align="center"> </a>
          </center>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="../../home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
<?php
  //$myrole SUPER USER IT ADMIN MOD_RICE_ADMIN MOD_RICE_USER BASE_EMPLOYEE
    if($myrole == 1 || $myrole == 2 || $myrole == 3 || $myrole == 4)
    {
?>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
          Bulk Operations
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Stock Management</span>
          </a>

          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="../../inward-stock">Inward Stock</a>
              <a class="collapse-item" href="../../outward-stock">Outward Stock</a>
            </div>
          </div>
        </li>         
  <?php
    }
    //$myrole SUPER USER IT ADMIN MOD_RICE_ADMIN MOD_RICE_USER BASE_EMPLOYEE
    if($myrole == 1 || $myrole == 2 || $myrole == 3)
    {
  ?>

          <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapselease" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Lease Management</span>
          </a>

          <div id="collapselease" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="../../manage-compartment">Manage Compartment</a>
              <a class="collapse-item" href="../../outward-lease">Outward lease</a>      
              <a class="collapse-item" href="../../inward-lease">Inward Lease</a>
              <a class="collapse-item" href="../../warehouse">Warehouse Master</a>
              <a class="collapse-item" href="../../lessor">Lessor Master</a>
              <!-- Divider -->
              <hr class="sidebar-divider"><hr>
              <a class="collapse-item" href="../../delivery">Delivery Master</a>
              <a class="collapse-item" href="../../commodity">Commodity Master</a>
              <a class="collapse-item" href="../../miller">Miller Master</a>

            </div>
          </div>
        </li>

  <?php
    }
  ?>     
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsereports" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Reports</span>
          </a>
            <div id="collapsereports" data-target="#collapsecreports" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded"> 
            <h6 class="collapse-header">Stock Reports</h6>    

              <a class="collapse-item" href="../../stock-rpt">Stock Report</a>
              <!--
                <a class="collapse-item" href="../../currentstock-rpt">Curent Stock</a>
                <a class="collapse-item" href="../../outwardstock-rpt">Outward Stock</a>
                <a class="collapse-item" href="../../inwardstock-rpt">Inward Stock</a>
              -->
              <a class="collapse-item" href="../../outwardleases-rpt">Outward Lease</a>
              <a class="collapse-item" href="../../inwardleases-rpt">Inward Lease</a>
            </div>
          </div>           
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsesecurity" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Security</span>
          </a>
            <div id="collapsesecurity" data-target="#collapsecsecurity" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded"> 
              <a class="collapse-item" href="../../user-roles">User Roles</a>
              <a class="collapse-item" href="../../user-permissions">User Permissions</a>                
            </div>
          </div>           
        </li>


        <!-- Nav Item - Charts 
        <li class="nav-item">
          <a class="nav-link" href="../../charts/cCharts.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
        </li>
        -->

        <!-- Divider -->
        <hr class="sidebar-divider">

  <?php
    //$myrole SUPER USER IT ADMIN MOD_RICE_ADMIN MOD_RICE_USER BASE_EMPLOYEE
    if($myrole == 1 || $myrole == 2 )
    {
  ?>
        <!-- Heading -->
        <div class="sidebar-heading">
          System Administration
        </div>

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Configurations</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Master Data Entries:</h6>
              <a class="collapse-item" href="../../entity">Entity Master</a>
              <a class="collapse-item" href="../../costcenter">Branch Master</a>
              <a class="collapse-item" href="../../departments">Department Master</a>
              <a class="collapse-item" href="../../Designations">Designation Master</a>
              <a class="collapse-item" href="../../customer">Customer Master</a>
              <a class="collapse-item" href="../../vendor">Vendor/Supplier Master</a>
            </div>
          </div>
        </li>
        <?php
              }
              if($myrole == 1 || $myrole == 2 || $myrole == 3)
              {
        ?>        
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
          User Administration
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>User Management</span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <?php
                if($myrole == 1 || $myrole == 2 || $myrole == 3)
                {
              ?>
                  <a class="collapse-item" href="../../contact">Create/Edit Contact</a>
              <?php
                }
                if($myrole == 1 || $myrole == 2)
                {
              ?>

                  <a class="collapse-item" href="../../employ">Employee Master</a>
                  <a class="collapse-item" href="../../users">User Master</a>
                  <div class="collapse-divider"></div>
              <?php
                }
              }
              ?>
            </div>
          </div>
        </li>

  <?php
    
  ?>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

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