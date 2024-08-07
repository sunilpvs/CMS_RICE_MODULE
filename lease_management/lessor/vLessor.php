<?php
   # require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
 ?>
  <div class="container-fluid">
    <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Add/Edit Lessor Details
           
            <a href="/lease_management/lessor/cLessor.php?action=lessor-add" class="btn btn-primary btn-md float-right" role="button">Add Lessor</a>
    </h3>
  </div>

  <div class="card-body">

    <div class="table-responsive">
    <table id="datatableid" class="table table-bordered table-dark" style="width:100%" >
    <thead style="background-color:#4e73df;">
        
        <tr style="font-size:14px;">  
            <th><strong>Lessor Name</strong></th> 
            <th ><strong>Lessor Type</strong></th>
            <th><strong>City</strong></th>
            <th><strong>State</strong></th> 
            <th><strong>Primary Contact</strong></th> 
            <th><strong>Email</strong></th>
            <th><strong>Mobile</strong></th>
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
        <tr style="font-size:12px;">                
            <td><?php echo $row["lessor_name"]; ?></td>
            <td><?php echo $row["ltype"]; ?></td>
            <td><?php echo $row["city"]; ?></td>
            <td><?php echo $row["state"]; ?></td>
            <td><?php echo $row["contact"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["mobile"]; ?></td>
            <td><?php if($row["status"]=="A") { echo "Active";} else { echo "De-Active";} ?></td>
            <td><a class="btnEditAction"
                href="../../lease_management/lessor/cLessor.php?action=lessor-edit&id=<?php echo $row["id"]; ?>">
                <img src="../../assests/img/icon-edit.png" />
                </a>
               <a class="btnDeleteAction" 
                href="../../lease_management/lessor/cLessor.php?action=lessor-delete&id=<?php echo $row["id"]; ?>">
                <img src="../../assests/img/icon-delete.png" />
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
            <a href="/lease_management/lessor/excel_export.php" class="btn btn-primary btn-md float-center" role="button" target="_blank"> Export Excel</a>
    </h3>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/scripts.php');
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.php');
?>