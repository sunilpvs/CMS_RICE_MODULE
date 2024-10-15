<?php
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
 ?>
  <div class="container-fluid">
  <div class="card shadow mb-4">

  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Commodity Master           
      <a href="/lease_management/commodity/cCommodity.php?action=commodity-add" class="btn btn-primary btn-md float-right" role="button">Add Commodity</a>
    </h3>
  </div>

  <div class="card-body">
    <div class="table-responsive">
    <table id="datatableid" class="table table-bordered table-dark" style="width:100%;">
    <thead style="background-color:#4e73df;">           
      <tr style="font-size:15px;">  
        <th><strong>Commodity</strong></th>
        <th><strong>Name</strong></th>
        <th><strong>Cargo Type</strong></th>
        <th><strong>Brand</strong></th>
        <th><strong>Marking</strong></th>
        <th><strong>Bag Wt.</strong></th>
        <th><strong>Empty Bag Wt.</strong></th>
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
        <td><?php echo $row["commodity"]; ?></td>
        <td><?php echo $row["commodity_name"]; ?></td>
        <td><?php echo $row["cargo_type"]; ?></td>
        <td><?php echo $row["brand"]; ?></td>
        <td><?php echo $row["marking"]; ?></td>
        <td><?php echo $row["bag_wt"]; ?></td>
        <td><?php echo $row["empty_bag_wt"]; ?></td>
        <td><?php if($row["status"] == "A"){echo "Active";} else {echo "De-Active";} ?></td>
        <td>
            <a class="btnEditAction" href="/lease_management/commodity/cCommodity.php?action=commodity-edit&id=<?php echo $row["id"]; ?>">
            <img src="../../assests/img/icon-edit.png" /> </a>
            <a class="btnDeleteAction" href="/lease_management/commodity/cCommodity.php?action=commodity-delete&id=<?php echo $row["id"]; ?>">
            <img src="../../assests/img/icon-delete.png" /> </a>
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
            <a href="/lease_management/commodity/excel_export.php" class="btn btn-primary btn-md float-center" role="button" target="_blank"> Export Excel</a>
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