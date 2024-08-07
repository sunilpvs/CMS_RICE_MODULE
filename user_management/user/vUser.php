<?php
    #require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
    #require_once "header.php"; 
include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
 ?>
   <div class="container-fluid">
   <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">User Master
           
            <a href="/user_management/user/cUser.php?action=user-add" class="btn btn-primary btn-md float-right" role="button">Add User</a>
    </h3>
  </div>

  <div class="card-body">

    <div class="table-responsive">
    
    <table id="datatableid" class="table table-bordered table-dark" >
    <thead style="background-color:#4e73df;">
         
                <tr style="font-size:14px;">  
                    <th><strong>User Name</strong></th>
                    <th><strong>First Name</strong></th>
                    <th><strong>Last Name</strong></th>
                    <th><strong>Email</strong></th> 
                    <th><strong>Mobile</strong></th>
                    <th><strong>Contact Type</strong></th>
                    <th><strong>User Status</strong></th>    
                    <th><strong>User Role</strong></th>    
                    <th><strong>Actions</strong></th>                  
                </tr>
            </thead>
            <tbody style="background-color:#ffffff; color: #000000;">
                    <?php
                    if (! empty($result)) {
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                        {    
                    ?>
          <tr style="font-size:12px;">        
                    <td><?php echo $row["user_name"]; ?></td>
                    <td><?php echo $row["f_name"]; ?></td>
                    <td><?php echo $row["l_name"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["mobile"]; ?></td>
                    <td><?php echo $row["ContactType"]; ?></td>
                    <td><?php 
                        if ($row["user_status"] == 'A') 
                        {
                                echo "Active";
                        }
                        else if ($row["user_status"] == 'D') 
                        {
                            echo "De-Active";
                        }
                        else if ($row["user_status"] == 'D') 
                        {
                            echo "Suspended";
                        }
                        ?>
                    </td>
                    <td><?php echo $row["user_role"]; ?></td>
                    <td><a class="btnEditAction"
                        href="../../user_management/user/cUser.php?action=user-edit&id=<?php echo $row["id"]; ?>">
                        <img src="../../assests/img/icon-edit.png" />
                        </a>
                        <a class="btnResetAction" 
                        href="../../user_management/user/cUser.php?action=initiate-pwd-reset&id=<?php echo $row["id"]; ?>">
                        Pwd Reset
                        </a>
                    </td>
                </tr>
                    <?php
                        
                        }
                    }
                    ?>
            <tbody>        
        </table>
        <h3 class="m-0 font-weight-bold text-primary"  >
            <!--<a href="department_generate_pdf.php" class="btn btn-primary btn-md float-center" style="margin-left: 20px;" role="button" target="_blank">Generate PDF</a>-->
            <a href="../../user_management/user/excel_export.php" class="btn btn-primary btn-md float-center" role="button" target="_blank"> Export Excel</a>
    </h3>
    <div class="well-sm col-sm-12">
		<div class="btn-group pull-right">	
			<!-- <form action="../../user_management/designation/excel_export.php" method="post">					
				<button type="submit" id="export_data" name='export_data' value="Export to excel" class="btn btn-info">Export to excel</button>
			</form> -->
		</div>
	</div>
    </div>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include($_SERVER['DOCUMENT_ROOT'] .'/includes/scripts.php');
include($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.php');
?>