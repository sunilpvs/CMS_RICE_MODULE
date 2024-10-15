<?php
   # require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
    include('../../includes/header.php'); 
    include('../../includes/navbar.php');
    include('../../includes/Generic.php');
 ?>
  <div class="container-fluid">
    <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">User Roles
           
            <a href="../../security/userroles/cUserroles.php?action=userroles-add" class="btn btn-primary btn-md float-right" role="button">Add User Role</a>
    </h3>
  </div>

  <div class="card-body">

    <div class="table-responsive">
    <table id="datatableid" class="table table-bordered table-dark" style="width:100%" >
    <thead style="background-color:#4e73df;">
        
        <tr style="font-size:14px;">  
            <th><strong>Role Id</strong></th> 
            <th ><strong>Page Id</strong></th>
            <th><strong>Access Type</strong></th>
            <th><strong>Actions</strong></th>  
        </tr>
    </thead>
    <tbody style="background-color:#ffffff; color: #000000;">
        <?php
        if (! empty($result)) 
        {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {    
        ?>
                <tr style="font-size:12px;">                
                <td><?php echo $row["role_id"]; ?></td>
                <td><?php echo $row["page_id"]; ?></td>
                <td><?php echo $row["access_type"]; ?></td>            
                <td><a class="btnEditAction" href="../../security/userroles/cUserroles.php?action=userroles-edit&id=<?php echo $row["id"]; ?>">
                    <img src="../../img/icon-edit.png" />
                    </a>
                    <a class="btnDeleteAction" href="../../security/userroles/cUserroles.php?action=userroles-delete&id=<?php echo $row["id"]; ?>">
                    <img src="../../img/icon-delete.png" />
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
            <a href="../../security/userroles/excel_export.php" class="btn btn-primary btn-md float-center" role="button" target="_blank"> Export Excel</a>
    </h3>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('../../includes/scripts.php');
include('../../includes/footer.php');
?>