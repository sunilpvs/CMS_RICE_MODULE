<?php
   # require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
 ?>
  <div class="container-fluid">
    <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Outward Leases
           
            <a href="/lease_management/outwardlease/cOutwardlease.php?action=outwardlease-add" class="btn btn-primary btn-md float-right" role="button">Add Outwardlease</a>
    </h3>
  </div>

  <div class="card-body">

    <div class="table-responsive">
    <table id="datatableid" class="table table-bordered table-dark" style="width:100%" >
    <thead style="background-color:#4e73df;">
        
        <tr style="font-size:14px;">
        <!--id  warehouse  compartment_code capacity_sqft capacity_mton  inward_lstart inward_lexpiry customer_name lease_model  lease_start
        lease_end lease_status-->
            <th><strong>ContractId</strong></th>
            <th><strong>Warehouse</strong></th>
            <th><strong>Customer Name</strong></th>
            <th><strong>Lease Model</strong></th>          
            <th><strong>Lease Start</strong></th>
            <th><strong>Lease End</strong></th>
            <th><strong>Leased Capacity(sqft)</strong></th>
            <th><strong>Leased Capacity(mton)</strong></th>            
            <th><strong>Lease Status</strong></th>                  
            <!--<th><strong>Actions</strong></th>-->
        </tr>
    </thead>
    <tbody style="background-color:#ffffff; color: #000000;">
        <?php
        if (! empty($result)) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {    
        ?>
        <tr style="font-size:12px;">                
            <td><?php echo $row["lease_contract_id"]; ?></td>
            <td><?php echo $row["warehouse"]; ?></td>
            <td><?php echo $row["customer_name"]; ?></td>
            <td><?php echo $row["lease_model"]; ?></td>
            <td><?php echo $row["lease_start"]; ?></td>
            <td><?php echo $row["lease_end"]; ?></td>
            <td><?php echo $row["lease_capacity_sqft"]; ?></td>
            <td><?php echo $row["lease_capacity_mton"]; ?></td>
            <td><?php
                    if(strtotime($row["lease_end"]) >= strtotime(date("d-M-Y")))
                    {
                        echo "Active";
                    } 
                    else
                    { 
                        echo "Expired";
                    } 
                ?>
            </td> 
            <!-- <td><a class="btnEditAction"
                href="./lease_management/outwardlease/cOutwardlease.php?action=outwardlease-edit&id=<?php echo $row["id"]; ?>">
                <img src="../../img/icon-edit.png" />
                </a>
                
                    <a class="btnDeleteAction" 
                    href="./lease_management/outwardlease/cOutwardlease.php?action=outwardlease-delete&id=<?php //echo $row["id"]; ?>">
                    <img src="../../img/icon-delete.png" />
                    </a> 
                -->
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
            <a href="./lease_management/outwardlease/excel_export.php" class="btn btn-primary btn-md float-center" role="button" target="_blank"> Export Excel</a>
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