<?php    
 include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
 ?>
<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Employee List           
            <a href="/user_management/employee/cEmployee.php?action=emp-add" class="btn btn-primary btn-md float-right" role="button">Add Employee/Consultant</a>
    </h3>
  </div>

  <div class="card-body">
    <div class="table-responsive">
    <table id="datatableid" class="table table-bordered table-dark" style="width:100%;" >
    <thead style="background-color:#4e73df;">
        <tr style="font-size:14px">  
            <th><strong>First Name</strong></th>
            <th><strong>Last Name</strong></th>
            <th><strong>Department</strong></th>
            <th><strong>Designation</strong></th>
            <th><strong>Joining Date</strong></th>
            <th><strong>Email</strong></th> 
            <th><strong>Mobile</strong></th>
            <th><strong>Employee Type</strong></th>
            <th><strong>Status</strong></th>
            <th><strong>Actions</strong></th>
        </tr>
    </thead>
    <tbody style="background-color:#ffffff; color: #000000;">
            <?php
            if (! empty($result)) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {    
            ?>
            
            <tr style="font-size:12px">                   
                <td><?php echo $row["f_name"]; ?></td>
                <td><?php echo $row["l_name"]; ?></td>
                <td><?php echo $row["dept"]; ?></td>  
                <td><?php echo $row["designation"]; ?></td> 
                <td><?php echo $row["join_date"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["mobile"]; ?></td>
                <td><?php echo $row["ctype"]; ?></td> 
                <td><?php echo $row["emp_status"]; ?></td> 
                <td><a class="btnEditAction"
                    href="../../user_management/employee/cEmployee.php?action=emp-edit&id=<?php echo $row["id"]; ?>">
                    <img src="../../assests/img/icon-edit.png" />
                    </a>
                   
                </td>
            </tr>
            <?php
                }
            }
            ?>
    </tbody>        
   </table>
   <h3 class="m-0 font-weight-bold text-primary"  >
            <!--<a href="department_generate_pdf.php" class="btn btn-primary btn-md float-center" style="margin-left: 20px;" role="button" target="_blank">Generate PDF</a>-->
            <a href="../../user_management/employee/excel_export.php" class="btn btn-primary btn-md float-center" role="button" target="_blank"> Export Excel</a>
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
<!-- /.container-fluid -->
<?php
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/scripts.php');
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.php');
?>