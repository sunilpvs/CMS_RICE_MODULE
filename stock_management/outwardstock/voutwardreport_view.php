<?php
   require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php');
   require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
 ?>
<div class="container-fluid">
  <div class="card shadow mb-4">
        <div class="card-body">
        <form name="frmAdd" method="post"
             action="" id="frmAdd" onSubmit="return validate();">
                <div class="container">
                    <div class="form-row">
                        <div class="col-md-12">

                        <div class="col-md-12 mb-3">
                            <div class="container">
                                <div class="form-row">
                                    <div class="col-md-3" style="margin-left:10px;padding-top: 32px;">                                        
                                        <a href="../../inwardstock-rpt" class="btn btn-primary btn-md" role="button">Back</a>
                                    </div>
                                    <div class="col-md-3" style="margin-left: -150px;padding-top: 32px;">
                                        <a href="../../stock_management/outwardstock/excel_export.php" class="btn btn-primary btn-md" role="button" target="_blank"> Export Excel</a>
                                    </div>
                                </div>
                            </div>                               
                        </div> 
                    </div>
                </div>
          </form>
          </div>

    <div class="card-body">
    <div class="table-responsive" id="get_data">
        <table id="datatableid" class="table table-bordered table-dark" style="width:100%" >
        <thead style="background-color:#4e73df;">
            <tr style="font-size:14px;">
                <th><strong>Customer Name</strong></th> 
                <th><strong>Warehouse Name</strong></th> 
                <th ><strong>Compartment</strong></th>
                <th><strong>Miller</strong></th>
                <th><strong>Commodity</strong></th>
                <th><strong>Inward Transport</strong></th>
                <th><strong>Inward Stock</strong></th>
                <th><strong>Current Stock</strong></th>
                <th><strong>Outward Stock</strong></th>
            </tr>
        </thead>
        <tbody style="background-color:#ffffff; color: #000000;">
        <?php
        if (! empty($report)) 
        {
            while ($report_view = mysqli_fetch_array($report, MYSQLI_ASSOC))
            {    
        ?>
            <tr style="font-size:12px;">  
                <td><?php echo $report_view["customer_name"]; ?></td>              
                <td><?php echo $report_view["warehouse_name"]; ?></td>
                <td><?php echo $report_view["compartment_name"]; ?></td>
                <td><?php echo $report_view["miller_name"]; ?></td>
                <td><?php echo $report_view["commodity"]; ?></td>
                <td><?php echo $report_view["source_transport"]; ?></td>
                <td><?php echo $report_view["inward_bags_count"]; ?></td>
                <td><?php echo $report_view["current_bags_stock"]; ?></td>
                <td><?php echo $report_view["outward_bags_count"]; ?></td>
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

<script>
    function validate() 
    {
        var valid = true;   
        $(".form control demoInputBox").css('background-color','');
        $(".info").html('');

        if(!$("#transport").val()) 
        {
            $("#transport-info").html("(required)");
            $("#transport").css('background-color','#FFFFDF');
            valid = false;
        }
    }
</Script>
<?php
    include('../../includes/scripts.php');
    include('../../includes/footer.php');
?>