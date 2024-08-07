<?php
    # require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
   include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
 ?>
<div class="container-fluid">
  <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Inward Leases
        <a href="/lease_management/inwardlease/cInwardlease.php?action=inwardlease-add" class="btn btn-primary btn-md float-right" role="button">Add Inward-Lease</a>
    </h3>
  </div>

  <div class="card-body">
    <div class="table-responsive">
        <table id="datatableid" class="table table-bordered table-dark" style="width:100%" >
        <thead style="background-color:#4e73df;">
        <tr style="font-size:14px;">
            <th><strong>Contract ID</strong></th>
            <th><strong>Warehouse Name</strong></th>
            <th><strong>Lease Type</strong></th> 
            <th><strong>Commencement Date</strong></th> 
            <th><strong>Expiry Date</strong></th>
            <th><strong>Status</strong></th>
            <!-- <th><strong>Actions</strong></th>    -->
        </tr>
    </thead>
    <tbody style="background-color:#ffffff; color: #000000;">
        <?php
        $dt_now = date("d-M-Y");
        if (! empty($result)) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {    
        ?>
        <tr style="font-size:12px;">                
            <td><?php echo $row["contract_id"]; ?></td>
            <td><?php echo $row["warehouse_name"]; ?></td>
            <td><?php echo $row["ltype"]; ?></td>
            <td><?php echo $row["start_date"]; ?></td>
            <td><?php echo $row["expiry_date"]; ?></td>
            <td><?php 
                   if(strtotime($row["expiry_date"]) >= strtotime(date("d-M-Y")))
                    {
                        echo "Active";
                    } 
                    else
                    { 
                        echo "Expired";
                    } 
                ?>
            </td> 
            <!--
            <td><a class="btnEditAction" href="../../bulk_ops/inwardlease/cInwardlease.php?action=inwardlease-edit&id=<?php //echo $row["id"]; ?>">
                    <img src="../../img/icon-edit.png" />
                </a>
                <a class="btnDeleteAction" href="../../buk_ops/inwardlease/cInwardlease.php?action=inwardlease-delete&id=<?php //echo $row["id"]; ?>">
                    <img src="../../img/icon-delete.png" />
                </a> 
            </td>
            -->
        </tr>
        <?php
            
            }
        }
        ?>
    </tbody>        
</table>

<h3 class="m-0 font-weight-bold text-primary"  >
            <!--<a href="department_generate_pdf.php" class="btn btn-primary btn-md float-center" style="margin-left: 20px;" role="button" target="_blank">Generate PDF</a>-->
            <a href="/lease_management/inwardlease/excel_export.php" class="btn btn-primary btn-md float-center" role="button" target="_blank"> Export Excel</a>
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