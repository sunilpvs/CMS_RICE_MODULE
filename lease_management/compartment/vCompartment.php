<?php
    #require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
    #require_once "header.php"; 
 include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
   require_once($_SERVER['DOCUMENT_ROOT'] ."/lease_management/compartment/vCompartment.php");
 ?>
<div class="container-fluid">
<div class="card shadow mb-4">
<div class="card-header py-3">
  <h3 class="m-0 font-weight-bold text-primary">Manage Warehouse Compartments
    <a href="/lease_management/compartment/cCompartment.php?action=compartment-add" class="btn btn-primary btn-md float-right" role="button">Add Compartment</a>
  </h3>
</div>

  <div class="card-body">
    <table id="datatableid" class="table table-bordered table-dark" style="width:100%;" >
    <thead style="background-color:#4e73df;">
    <tr>							        					
        <tr style="font-size:14px">
            <th><strong>Outward Lease</strong></th>
            <th><strong>Outward Lease End</strong></th>
            <th><strong>Customer Name</strong></th>
            <th><strong>Warehouse Name</strong></th>
            <th><strong>Compartment Id</strong></th>
            <th><strong>Compartment Name</strong></th>
            <th><strong>Capacity(Sq.ft)</strong></th>
            <th><strong>Capacity(Metric Ton)</strong></th>                                            
            <th><strong>Status</strong></th>                 
            <!-- <th><strong>Actions</strong></th> -->
        </tr>
    </thead>
    <tbody style="background-color:#ffffff; color: #000000;">
        <?php
        if (! empty($result)) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {    
        ?>
        <tr style="font-size:12px">   
            <td><?php echo $row["outward_lease"]; ?></td> 
            <td><?php echo $row["lease_end"]; ?></td> 
            <td><?php echo $row["customer_name"]; ?></td> 
            <td><?php echo $row["warehouse_name"]; ?></td> 
            <td><?php echo $row["compartment_id"]; ?></td> 
            <td><?php echo $row["compartment_name"]; ?></td> 
            <td><?php echo $row["comp_capacity_sqft"]; ?></td>
            <td><?php echo $row["comp_capacity_mton"]; ?></td>
            <td><?php if ($row["status"] == "A") echo 'Active'; else echo 'Expired' ?></td>                
            <!--
            <td>
                <a class="btnEditAction" href="../../bulk_ops/compartment/cCompartment.php?action=compartment-edit&id=<?php //echo $row["id"]; ?>">
                  <img src="../../img/icon-edit.png" />
                </a>
                 <a class="btnDeleteAction" href="../../bulk_ops/compartment/cCompartment.php?action=compartment-delete&id=<?php //echo $row["id"]; ?>">
                  <img src="../../img/icon-delete.png" />
                </a> 
            </td>
            -->
        </tr>
        <?php
            }
        }
        ?>
    <tbody>        
  </table>
  <h3 class="m-0 font-weight-bold text-primary"  >
            <!--<a href="department_generate_pdf.php" class="btn btn-primary btn-md float-center" style="margin-left: 20px;" role="button" target="_blank">Generate PDF</a>-->
            <a href="../../lease_management/compartment/excel_export.php" class="btn btn-primary btn-md float-center" role="button" target="_blank"> Export Excel</a>
    </h3>

  </div>

 </div>
</div>
</div>

<?php
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/scripts.php');
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.php');
?>