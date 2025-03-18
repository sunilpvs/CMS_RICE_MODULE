<?php
    #require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
    #require_once "header.php"; 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
  include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
 ?>
<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Current Stock          
            
    </h3>
  </div>

  <div class="card-body">

    <div class="table-responsive">
   
    <table id="datatableid" class="table table-bordered table-dark" style="width:100%;" >
      <thead style="background-color:#4e73df;">
        <tr style="font-size:14px">
            <th><strong>Customer Name</strong></th>
            <th><strong>Warehouse Name</strong></th>
            <th><strong>Compartment</strong></th>
            <th><strong>Commodity</strong></th>
            <th><strong>Transport Mode</strong></th> 
            <th><strong>Bags Stock</strong></th>
            <th><strong>Gross Wt</strong></th>
            <th><strong>Net Weight</strong></th>
            <th><strong>Re-Validate</strong></th>
        </tr>
      </thead>
      <tbody style="background-color:#ffffff; color: #000000;">
        <?php
        if (! empty($result)) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {    
        ?>
        <tr style="font-size:12px" id = "row"
              data-cust_id=<?php echo $row["customer_id"]; ?>  data-w_id= <?php echo $row["warehouse_id"]; ?>
              data-comm_id=<?php echo $row["commodity_id"]; ?>  data-comp_id= <?php echo $row["compartment_id"]; ?>
              data-trans_id=<?php echo $row["mod_transport"]; ?> 

        >     
                     
          <td><?php echo $row["customer_name"]; ?></td>
          <td><?php echo $row["warehouse_name"]; ?></td>
          <td><?php echo $row["compartment_name"]; ?></td>
          <td><?php echo $row["commodity"]; ?></td>
          <td><?php echo $row["transport_mode"]; ?></td>
          <td><?php echo $row["bags_stock"]; ?></td>
          <td><?php echo $row["gross_wt"]; ?></td>
          <td><?php echo $row["net_wt"]; ?></td>
          <td>
            <?php
           
              //$myrole
              //1:SUPER USER::2:IT ADMIN::3:MOD_RICE_ADMIN::4:MOD_RICE_USER::5:BASE_EMPLOYEE
              // Check if System Maintenance Mode
              $myrole = 0;
              if(isset($_SESSION['user_role_id']))
              {
                $myrole = $_SESSION['user_role_id'];
              }
              if ($myrole == 1 || $myrole == 2 || $myrole == 3)
              {
                //$eTxt = "<a class='btnEditAction' href='../../user_management/contact/cContact.php?action=contact-edit&id=".$row['customer_name']."'>";
                //$eTxt .= "<img src='../../assests/img/icon-edit.png'/> </a>";
                //echo $eTxt;
                echo"<button onclick='revalidateStock(this)'><img src='../../assests/img/icon-edit.png'></button>";
                //echo "<input type='image' src='../../assests/img/icon-edit.png' name='Release' onclick='revalidateStock();' value='Click to Re-Validate'>";
                //echo"<button>Alert the value of each list item</button>";
                //$eTxt = "<a class='btnEditAction' onclick='setSelectedTestPlan(this);' href='#'>";
                //$eTxt .= "<img src='../../assests/img/icon-edit.png'/> </a>";
                //echo $eTxt;
              }
            ?>
          </td>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
           <script type="application/javascript">

              function revalidateStock(button)
              {    
                const cust_id = button.parentNode.parentNode.dataset.cust_id;
                const w_id = button.parentNode.parentNode.dataset.w_id;
                const comm_id = button.parentNode.parentNode.dataset.comm_id;
                const comp_id = button.parentNode.parentNode.dataset.comp_id;
                const trans_id = button.parentNode.parentNode.dataset.trans_id;
                
                alert(cust_id);
                //alert(w_id);
                //alert(comm_id);
                //alert(comp_id );
                //alert(trans_id);
                $.ajax(
                {
                  type:"POST",
                  url:"../../reports/current_stock/revalidate_Stock.php",
                  data:{customer_id:cust_id,warehouse_id:w_id,compartment_id:comp_id,commodity_id:comm_id,mod_transport:trans_id},
                  success:function(mydata)
                  {
                    //$("#current_bags_stock").val(mydata);
                  } 
                });

                //var cell = document.getElementsByTagName("td");
                //const trow = document.getElementById("row");  
                //const row = trow.getAttribute("data-cust_id");
                //alert(row); 
                //var cell = document.getElementsByTagName("td");               
                //while(cell[i] != undefined)
                //{ 
                //  alert(cell[i].innerHTML); //do some alert for test 
                //  i++; 
               // }
              }
           </script>
        </tr>
        <?php
            }
        }
        ?>
      </tbody>        
   </table>
   <h3 class="m-0 font-weight-bold text-primary"  >
            <!--<a href="department_generate_pdf.php" class="btn btn-primary btn-md float-center" style="margin-left: 20px;" role="button" target="_blank">Generate PDF</a>-->
            <a href="../../reports/current_stock/excel_export.php" class="btn btn-primary btn-md float-center" role="button" target="_blank"> Export Excel</a>
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