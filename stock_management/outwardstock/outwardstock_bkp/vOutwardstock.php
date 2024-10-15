<?php
   # require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
include('../../includes/header.php'); 
include('../../includes/navbar.php');
 ?>
  <div class="container-fluid">
    <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Outward Stock
           
            <a href="../../bulk_ops/outwardstock/cOutwardstock.php?action=outwardstock-add" class="btn btn-primary btn-md float-right" role="button">Add Outward Stock</a>
    </h3>
  </div>

  <div class="card-body">

    <div class="table-responsive">
    <table id="datatableid" class="table table-bordered table-dark" style="width:100%" >
    <thead style="background-color:#4e73df;">

        <tr style="font-size:14px;">
            <th><strong>Outward date</strong></th> 
            <th ><strong>DC number</strong></th>
            <th><strong>Dc date</strong></th>
            <th><strong>Godown Name</strong></th>
            <th><strong>Compartment Name</strong></th>
            <th><strong>Vehicle Number</strong></th>
            <th><strong>Cargo Details</strong></th>
            <th><strong>Bag Mark</strong></th>
            <th><strong>Bag weight</strong></th>
            <th><strong>No.of bags out</strong></th>
            <th><strong>Weighbridge weight</strong></th>
            <th><strong>Net weight</strong></th>
            <th><strong>Delivery  details</strong></th>
            <th><strong>Remarks</strong></th>
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
            <td><?php echo $row["outward_date"]; ?></td>
            <td><?php echo $row["dc_no"]; ?></td>
            <td><?php echo $row["dc_date"]; ?></td>
            <td><?php echo $row["godown_name"]; ?></td>
            <td><?php echo $row["compartment_name"]; ?></td>
            <td><?php echo $row["vehicle_no"]; ?></td>
            <td><?php echo $row["cargo_details"]; ?></td>
            <td><?php echo $row["bag_mark"]; ?></td>
            <td><?php echo $row["bag_wtg"]; ?></td>
            <td><?php echo $row["bags_out"]; ?></td>
            <td><?php echo $row["wbridge_wtg"]; ?></td>
            <td><?php echo $row["net_wtg"]; ?></td>
            <td><?php echo $row["delivery_dtl"]; ?></td>
            <td><?php echo $row["remarks"]; ?></td>
           

            
            <td><a class="btnEditAction"
                href="../../bulk_ops/outwardstock/cOutwardstock.php?action=outwardstock-edit&id=<?php echo $row["id"]; ?>">
                <img src="../../img/icon-edit.png" />
                </a>
               <a class="btnDeleteAction" 
                href="../../bulk_ops/outwardstock/cOutwardstock.php?action=outwardstock-delete&id=<?php echo $row["id"]; ?>">
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

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('../../includes/scripts.php');
include('../../includes/footer.php');
?>