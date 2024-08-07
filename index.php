<?php
  ## Testing Github Sync
  ##Testing updates   Tessting Githhub
  if(session_status() === PHP_SESSION_NONE) 
  { 
    session_start(); 
  }
  else
  {
    $myrole = $_SESSION['user_role_id'];
  }  
  date_default_timezone_set('Asia/Kolkata'); 
  
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
    require_once "includes/DBController.php";
    require_once "includes/UserLogin.php";
    require_once "includes/header.php";
    require_once "includes/navbar.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
      <?php
    //$myrole SUPER USER IT ADMIN MOD_RICE_ADMIN MOD_RICE_USER BASE_EMPLOYEE
    if($myrole == 1 || $myrole == 2 )
    {
  ?>
      <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <?php
                $usr = new UserLogin();
                $result = $usr->getContactCount();
                      echo'<h3>'.$result.'</h3>';
            ?>
              
              <div class="h5 mb-2 font-weight-bold text-gray-800">Contact List</div>
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1" ><a class="collapse-item" href="../../masters_data/entity/cEntity.php"> <a class="collapse-item" href="../../contact">Go To---></a></a></div>           
              </div>

              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
          </div>
        </div>
      </div>
    </div>
        <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-secondary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <?php
                $usr = new UserLogin();
                $result = $usr->getEmployeeCount();
                      echo'<h3>'.$result.'</h3>';
            ?>
              
              <div class="h5 mb-2 font-weight-bold text-gray-800">Employee List</div>
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a class="collapse-item" href="../../employ">Go To---></a></div>           
              </div>

              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
          </div>
        </div>
      </div>
    </div>
        <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <?php
                $usr = new UserLogin();
                $result = $usr->getUsersCount();
                      echo'<h3>'.$result.'</h3>';
            ?>
              
              <div class="h5 mb-2 font-weight-bold text-gray-800">Users List</div>
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> <a class="collapse-item" href="../../user">Go To---></a></div>           
              </div>

              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
          </div>
        </div>
      </div>
    </div>
    
   
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <?php
                $usr = new UserLogin();
                $result = $usr->getEntityCount();
                      echo'<h3>'.$result.'</h3>';
            ?>
              
              <div class="h5 mb-2 font-weight-bold text-gray-800">Entity List</div>
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a class="collapse-item" href="../../masters_data/entity/cEntity.php">Go To---></a></div>           
              </div>

              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                 <?php
                $usr = new UserLogin();
                $result = $usr->getCostcenterCount();
                      echo'<h3>'.$result.'</h3>';
            ?>
              
              <div class="h5 mb-2 font-weight-bold text-gray-800">Costcenter List</div>
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a class="collapse-item" href="../../masters_data/costcenter/cCostcenter.php">Go To---></a></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                 <?php
                $usr = new UserLogin();
                $result = $usr->getDepartmentCount();
                      echo'<h3>'.$result.'</h3>';
            ?>
              
              <div class="h5 mb-2 font-weight-bold text-gray-800">Department List</div>
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a class="collapse-item" href="../../masters_data/department/cDepartment.php">Go To---></a></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    
     <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-light shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                 <?php
                $usr = new UserLogin();
                $result = $usr->getDesignationCount();
                      echo'<h3>'.$result.'</h3>';
            ?>
              
              <div class="h5 mb-2 font-weight-bold text-gray-800">Designation List</div>
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a class="collapse-item" href="../../masters_data/designation/cDesignation.php">Go To---></a></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

 <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-dark shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                 <?php
                $usr = new UserLogin();
                $result = $usr->getCustomerCount();
                      echo'<h3>'.$result.'</h3>';
            ?>
              
              <div class="h5 mb-2 font-weight-bold text-gray-800">Customer List</div>
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a class="collapse-item" href="../../masters_data/customer/cCustomer.php">Go To---></a></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    
     <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                 <?php
                $usr = new UserLogin();
                $result = $usr->getVendorCount();
                      echo'<h3>'.$result.'</h3>';
            ?>
              
              <div class="h5 mb-2 font-weight-bold text-gray-800">Vendor List</div>
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a class="collapse-item" href="../../masters_data/vendor/cVendor.php">Go To---></a></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    }
      //$myrole SUPER USER IT ADMIN MOD_RICE_ADMIN MOD_RICE_USER BASE_EMPLOYEE
    if($myrole == 1 || $myrole == 2 || $myrole == 3 || $myrole == 4)
    {
    ?>
    
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-secondary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                 <?php
                $usr = new UserLogin();
                $result = $usr->getWarehouseCount();
                      echo'<h3>'.$result.'</h3>';
            ?>
                  <div class="h5 mb-2 font-weight-bold text-gray-800">Warehouse List</div>
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a class="collapse-item" href="../../bulk_ops/warehouse/cWarehouse.php">Go To---></a></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    
        <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                 <?php
                $usr = new UserLogin();
                $result = $usr->getLessorCount();
                      echo'<h3>'.$result.'</h3>';
            ?>
             <div class="h5 mb-2 font-weight-bold text-gray-800">Lessor List</div>
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a class="collapse-item" href="../../bulk_ops/lessor/cLessor.php">Go To---></a></div>
              
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    
        <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                 <?php
                $usr = new UserLogin();
                $result = $usr->getInwardLeaseCount();
                      echo'<h3>'.$result.'</h3>';
            ?>
             <div class="h5 mb-2 font-weight-bold text-gray-800">Inward Lease List</div>
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a class="collapse-item" href="../../bulk_ops/inwardlease/cInwardlease.php">Go To---></a></div>
              
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                 <?php
                $usr = new UserLogin();
                $result = $usr->getCommoditiesCount();
                      echo'<h3>'.$result.'</h3>';
            ?>
              <div class="h5 mb-2 font-weight-bold text-gray-800">Commodity List</div>
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">  <a class="collapse-item" href="../../bulk_ops/commodity/cCommodity.php">Go To---></a></div>
             
           </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                 <?php
                $usr = new UserLogin();
                $result = $usr->getOutwardleaseCount();
                      echo'<h3>'.$result.'</h3>';
            ?>
              <div class="h5 mb-2 font-weight-bold text-gray-800">Commodity List</div>
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">  <a class="collapse-item" href="../../bulk_ops/commodity/cCommodity.php">Go To---></a></div>
             
           </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    }
    ?>

  <!-- Content Row -->

<?php
    #echo "<h2> Home Page</h2>";
    require_once "includes/scripts.php";
    require_once "includes/footer.php";
  }
  else
  { //Fresh Visit
    #echo "<script>alert('username or password incorrect!')</script>";
    echo "<script>location.href='login'</script>";
  }
?>
