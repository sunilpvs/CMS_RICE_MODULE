<?php
   # require_once($_SERVER['DOCUMENT_ROOT'] .'/web/header.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
 ?>
<script>
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <link href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui-css" rel="stylesheet"/>
</script>
<!-- /.container-fluid -->
<div class="container-fluid">
 <div class="card shadow mb-4">
  <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Inward Stock Entries
            <a href="/stock_management/inwardstock/cInwardstock.php?action=inwardstock-add" class="btn btn-primary btn-md float-right" role="button">Add Inward Stock</a>
        </h3>
   </div>

<div class="card-body">
<form name="frmAdd" method="post" action="/stock_management/inwardstock/cInwardstock.php?action=inward-filter" id="frmAdd" onSubmit="return validate();">
        <div class="container">
            <div class="form-row">
                <div class="col-md-5">
                  <label for="validationDefault01" class="info">Select Date</label><span id="date_picker-info" class="info"></span>
                  <input type="date" class="form-control demoInputBox" id="date_picker" name= "date_picker" placeholder="mm/dd/yyyy" required>
                </div>

                <div class="col-md-2" style="padding-top: 32px;">
                  <label for="validationDefault01" class="info"></label><span id="btnfilter-info" class="info"></span>
                  <input type="submit" id="btnfilter" name= "btnfilter" value="Filter" class ="btn btn-dark" required>
                </div>
                <div class="col-md-3" style="margin-left:-100px;padding-top: 32px;">
                <a href="stock_management/inwardstock/excel_export.php" class="btn btn-primary btn-md" role="button" target="_blank"> Export Excel</a>
                </div>
            </div>
        </div>
  </form>
  </div>


<!--
    <div class="row">
        <div class="col-md-5 ">
            <input type="date" name="date_picker" id="date_picker" class = "form-control" />
        </div>
        <div class="col-md-2 mb-3">
            <input type="button" name="btnfilter" id="btnfilter" value="Filter" class = "btn btn-dark" onclick="fetchData()"/>
        </div>
        <div class="col-md-3" style="margin-left:-100px;">
                <a href="../../stock_management/inwardstock/excel_export.php" class="btn btn-primary btn-md" role="button" target="_blank"> Export Excel</a>
        </div>
    </div> 
-->


<div class="card-body">
<div class="table-responsive" id="get_data">
  <table id="datatableid" class="table table-bordered table-dark" style="width:100%" >
    <thead style="background-color:#4e73df;">
        <tr style="font-size:14px;">
            <th><strong>Id</strong></th> 
            <th><strong>Date</strong></th> 
            <th><strong>Inv.Number</strong></th>
            <th><strong>Inv.Date</strong></th>
            <th><strong>Miller</strong></th> 
            <th><strong>Commodity</strong></th>
            <th><strong>TransMode</strong></th>
            <th><strong>Warehouse</strong></th>
            <th><strong>Compartment</strong></th>
            <th><strong>Vehicle</strong></th>
            <th><strong>Bags.Revd(No's)</strong></th>
            <th><strong>Inward Gross.Wt</strong></th>
            <th><strong>Inward Net.Wt</strong></th>
            <th><strong>Weighbridge.Gross.Wt</strong></th>
            <th><strong>Weighbridge.Net.Wt</strong></th>
            <th><strong>Inward.Difference</strong></th>
            <th><strong>Wt.Difference</strong></th>
            <th><strong>Current Bags Stock</strong></th>
            <th><strong>Remarks</strong></th>
              
        </tr>
    </thead>
    <tbody style="background-color:#ffffff; color: #000000;">
        <?php
        if (! empty($result)) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {    
        ?>
        <tr style="font-size:12px;">                
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["received_date"]; ?></td>
            <td><?php echo $row["invoice_no"]; ?></td>
            <td><?php echo $row["invoice_date"]; ?></td>
            <td><?php echo $row["miller_name"]; ?></td>
            <td><?php echo $row["commodity"]; ?></td>
            <td><?php echo $row["source_transport"]; ?></td>
            <td><?php echo $row["warehouse_name"]; ?></td>
            <td><?php echo $row["compartment_name"]; ?></td>
            <td><?php echo $row["vehicle_no"]; ?></td>
            <td><?php echo $row["inward_bags_stock"]; ?></td>
            <td><?php echo $row["inward_gross_wt"]; ?></td>
            <td><?php echo $row["inward_net_wt"]; ?></td>
            <td><?php echo $row["inward_wb_gross_wt"]; ?></td>
            <td><?php echo $row["inward_wb_net_wt"]; ?></td>
            <td><?php echo $row["inward_diff_gross"]; ?></td>
            <td><?php echo $row["inward_diff_net"]; ?></td>
            <td><?php echo $row["current_bags_stock"]; ?></td>
            <td><?php echo $row["remarks"]; ?></td>
          
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
<script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
<script>
function validate() {
    var valid = true;   
    $(".form control demoInputBox").css('background-color','');
    $(".info").html('');

    if(!$("#date_picker").val()) {
        $("#date_picker-info").html("(required)");
        $("#date_picker").css('background-color','#FFFFDF');
        valid = false;
    }
}

<?php
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/scripts.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.php');
?>