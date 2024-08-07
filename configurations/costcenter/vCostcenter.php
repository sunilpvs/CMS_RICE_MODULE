<?php
   include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
  
 ?>
    <div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Branches/CostCenter Master
            <a href="/configurations/costcenter/cCostcenter.php?action=costcenter-add" class="btn btn-primary btn-md float-right" role="button">Add Costcenter</a>
    </h3>
</div>

<div class="card-body">
    <div class="table-responsive">
    <table id="datatableid" class="table table-bordered table-dark" style="width:100%" >
    <thead style="background-color:#4e73df;">
        <tr style="font-size:12px;">
            <th><strong>Entity</strong></th> 
            <th ><strong>Cost Center</strong></th>
            <th><strong>Cost Center Type</strong></th>
            <th><strong>Incorporation Date</strong></th> 
            <th><strong>GST No</strong></th> 
            <th><strong>City</strong></th>
            <th><strong>State</strong></th>
            <th><strong>Primary Contact</strong></th>
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
        <tr style="font-size:14px;">                
            <td><?php echo $row["entity_name"]; ?></td>
            <td><?php echo $row["cc_code"]; ?></td>
            <td><?php echo $row["cc_type"]; ?></td>
            <td><?php echo $row["incorp_date"]; ?></td>
            <td><?php echo $row["gst_no"]; ?></td>
            <td><?php echo $row["city"]; ?></td>
            <td><?php echo $row["state"]; ?></td>
            <td><?php echo $row["f_name"]." ".$row['l_name']; ?></td>
            <td><?php if($row["status"] == "A"){echo "Active";} else {echo "De-Active";} ?></td>
            <td><a class="btnEditAction"
                href="../../configurations/costcenter/cCostcenter.php?action=costcenter-edit&id=<?php echo $row["id"]; ?>">
                <img src="../../assests/img/icon-edit.png" />
                </a>
                
             <!--   <a class="btnDeleteAction" 
                href="../../masters/costcenter/cCostcenter.php?action=costcenter-delete&id=<?php //echo $row["id"]; ?>">
                <img src="../../web/image/icon-delete.png" />
                </a> -->
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
            <a href="/configurations/costcenter/excel_export.php" class="btn btn-primary btn-md float-center" role="button" target="_blank"> Export Excel</a>
    </h3>
    <div class="well-sm col-sm-12">
		<div class="btn-group pull-right">	
			<!-- <form action="../../masters/designation/excel_export.php" method="post">					
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