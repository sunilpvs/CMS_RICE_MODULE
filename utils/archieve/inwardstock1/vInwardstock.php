<?php
   # require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
   include('../../includes/header.php'); 
   include('../../includes/navbar.php');
 ?>
  <div class="container-fluid">
    <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Lease
           
            <a href="../../bulk_ops/inwardstock/cInwardstock.php?action=inwardstock-add" class="btn btn-primary btn-md float-right" role="button">Add Inward Stock</a>
    </h3>
  </div>

  <div class="card-body">

    <div class="table-responsive">
    <table id="datatableid" class="table table-bordered table-dark" style="width:100%" >
    <thead style="background-color:#4e73df;">
        
        <tr style="font-size:14px;">
            <th><strong>Lease_obj</strong></th> 
            <th ><strong>Contract_id</strong></th>
            <th><strong>Customer_id</strong></th>
            <th><strong>Commenced_Date</strong></th> 
            <th><strong>Complete_Date</strong></th> 
            <th><strong>Capacity_Mton</strong></th>
            <th><strong>Rate/Day</strong></th>
            <th><strong>Commodity_Type</strong></th>
            <th><strong>Contact_Days</strong></th>
            <th><strong>Total_Cost</strong></th>
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
            <td><?php echo $row["Lease_obj"]; ?></td>
            <td><?php echo $row["Contract_id"]; ?></td>
            <td><?php echo $row["Customer_id"]; ?></td>
            <td><?php echo $row["Commenced_Date"]; ?></td>
            <td><?php echo $row["Commenced_Date"]; ?></td>
            <td><?php echo $row["Capacity_Mton"]; ?></td>
            <td><?php echo $row["RateDay"]; ?></td>
            <td><?php echo $row["Commodity_Type"]; ?></td>
            <td><?php echo $row["Contact_Days"]; ?></td>
            <td><?php echo $row["Total_Cost"]; ?></td>
            
            <td><a class="btnEditAction"
                href="../../bulk_ops/inwardstock/cInwardstock.php?action=inwardstock-edit&id=<?php echo $row["id"]; ?>">
                <img src="../../img/icon-edit.png" />
                </a>
               <a class="btnDeleteAction" 
                href="../../bulk_ops/inwardstock/cInwardstock.php?action=inwardstock-delete&id=<?php echo $row["id"]; ?>">
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