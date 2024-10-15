<?php
   include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
  
    //include_once('export_data.php');

 ?>
 <div class="container-fluid">
 <div class="card shadow mb-4">
 <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Designation Master           
            <a href="/configurations/designation/cDesignation.php?action=designation-add" class="btn btn-primary btn-md float-right" role="button">Add Designation</a>
    </h3>
  </div>

  <div class="card-body">
    <div class="table-responsive">
    <table id="datatableid" class="table table-bordered table-dark" style="width:100%;">
            <thead style="background-color:#4e73df;">
                <tr style="font-size:12px;">
                    <th><strong>Designation Name</strong></th>
                    <th><strong>Code</strong></th>
                    <th><strong>Status</strong></th>
                    <th><strong>Actions</strong></th>
                </tr>
            </thead>
            <tbody style="background-color:#ffffff; color: #000000;">
            <?php
                        if (! empty($result)) {
                          while ($row = mysqli_fetch_assoc($result))
                          {  
                            $data_records[] = $row;
                            ?>
                              <tr style="font-size:14px;">                  
                              <td><?php echo $row["name"]; ?></td>
                              <td><?php echo $row["code"]; ?></td>
                              <td><?php if($row["status"] == "A"){echo "Active";} else {echo "De-Active";} ?></td>
                              <td><a class="btnEditAction"
                                  href="../../configurations/designation/cDesignation.php?action=designation-edit&id=<?php echo $row["id"]; ?>">
                                  <img src="/assests/img/icon-edit.png" />
                                  </a>
                                  <a class="btnDeleteAction" 
                                  href="../../configurations/designation/cDesignation.php?action=designation-delete&id=<?php echo $row["id"]; ?>">
                                  <img src="/assests/img/icon-delete.png" />
                                  </a>
                              </td>
                              </tr>
                    <?php  } 
                        } 
                      ?>           
            </tbody>
       </table>
    </div>
  </div>
  <h3 class="m-0 font-weight-bold text-primary"  >
            <!--<a href="designation_generate_pdf.php" class="btn btn-primary btn-md float-center" style="margin-left: 20px;" role="button" target="_blank">Generate PDF</a>-->
            <a href="/configurations/designation/excel_export.php" class="btn btn-primary btn-md float-center" role="button" target="_blank"> Export Excel</a>
    </h3>
    <div class="well-sm col-sm-12">
		<div class="btn-group pull-right">	
			<!-- <form action="../../configurations/designation/excel_export.php" method="post">					
				<button type="submit" id="export_data" name='export_data' value="Export to excel" class="btn btn-info">Export to excel</button>
			</form> -->
		</div>
	</div>
      
</div>
</div>
<!-- /.container-fluid -->
<?php
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/scripts.php');
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.php');
?>