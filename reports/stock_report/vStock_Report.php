<?php
   # require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
 ?>
  <div class="container-fluid">
    <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Stock Report
            <!--<a href="../../bulk_ops/outwardlease/cOutwardlease.php?action=outwardlease-add" class="btn btn-primary btn-md float-right" role="button">Add Outwardlease</a>-->
    </h3>
  </div>

  <div class="card-body">
    <div class="table-responsive">
    <table id="datatableid" class="table table-bordered table-dark" style="width:100%" >
    <thead style="background-color:#4e73df;">
        
        <tr style="font-size:14px;">
        <!--id  warehouse  compartment_code capacity_sqft capacity_mton  inward_lstart inward_lexpiry customer_name lease_model  lease_start
        lease_end lease_status-->
            <th><strong>Customer Name</strong></th>
            <th><strong>Warehouse Name</strong></th>
            <th><strong>Compartment  Name</strong></th>
            <th><strong>Commodity</strong></th>          
            <th><strong>Mode Of Transport</strong></th>
            <th><strong>Inward Stock</strong></th>
            <th><strong>Outward Stock</strong></th>
            <th><strong>Current Stock</strong></th> 
        </tr>
    </thead>
    <tbody style="background-color:#ffffff; color: #000000;">
        <?php
        if (! empty($result)) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {    
        ?>
        <tr style="font-size:12px;">                
            <td><?php echo $row["customer_name"]; ?></td>
            <td><?php echo $row["warehouse_name"]; ?></td>
            <td><?php echo $row["compartment_name"]; ?></td>
            <td><?php echo $row["commodity"]; ?></td>
            <td><?php echo $row["transport_mode"]; ?></td>
            <td><?php echo $row["inward_bags_count"]; ?></td>
            <td><?php echo $row["outward_bags_count"]; ?></td>
            <td><?php echo $row["current_bags_count"]; ?></td>
        </tr>
        <?php
            
            }
        }
        ?>
    </tbody>        
</table>
    <h3 class="m-0 font-weight-bold text-primary"  >
            <!--<a href="department_generate_pdf.php" class="btn btn-primary btn-md float-center" style="margin-left: 20px;" role="button" target="_blank">Generate PDF</a>-->
            <a href="../../reports/stock_report/excel_export.php" class="btn btn-primary btn-md float-center" role="button" target="_blank"> Export Excel</a>
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