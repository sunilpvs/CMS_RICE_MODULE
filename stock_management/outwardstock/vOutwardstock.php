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

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Outward Stock
                <a href="/stock_management/outwardstock/cOutwardstock.php?action=outwardstock-add" class="btn btn-primary btn-md float-right" role="button">Add Outward Stock</a>
            </h3>   
    </div>

        <div class="card-body">
        <form name="frmAdd" method="post" action="/stock_management/outwardstock/cOutwardstock.php?action=outward-filter" id="frmAdd" onSubmit="return validate();">
                <!--<div class="container">
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
                        <a href="../../stock_management/outwardstock/excel_export.php" class="btn btn-primary btn-md" role="button" target="_blank"> Export Excel</a>
                        </div>
                    </div>
                </div>-->
                <div class="container">
                    <div class="form-row">
                       <!-- <div class="col-md-4">
                          Day Wise: <input type="checkbox" id="myCheck" onclick="myFunction()">
                          <div id="text" style="display:none">
                            <label>The date field</label>
                            <input id="yourDateField" type="date" />
                        </div>
                        </div>
                        
                        <script>
                           function myFunction() {
                           // Get the checkbox
                            var checkBox = document.getElementById("myCheck");
                           // Get the output text
                           var text = document.getElementById("text");

                             // If the checkbox is checked, display the output text
                            if (checkBox.checked == true){
                                text.style.display = "block";
                            } else {
                                text.style.display = "none";
                            }
                            }

                            
                        </script> -->
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault05" class="info">Customer</label><span id="customer-info" class="info"></span>
                            <select id="customer-list" name="customer" class="form-control demoInputBox" onchange="getWarehouse(this.value);" required>
                            <option value ="" >Select Customer</option>
                            <?php
                                $gen = new Generic();
                                $result = $gen->getCustomerList();
                                foreach ($result as $customer) 
                                {
                            ?>
                            <option value="<?php echo $customer["id"]; ?>"><?php echo $customer["customer_name"]; ?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div> 
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault05" class="info">Warehouse</label><span id="warehouse-info" class="info"></span>
                            <select id="warehouse-list" name="warehouse" class="form-control demoInputBox" onchange="getCompartment();" required>
                            <option value="">Select Warehouse</option>    
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="validationDefault05" class="info">Compartment</label><span id="compartment-info" class="info"></span>
                            <select id="compartment-list" name="compartment" class="form-control demoInputBox" required>
                            <option value="">Select Compartment</option>    
                            </select>
                        </div>

                        <script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>
                        <script>
                            function getWarehouse(val) {
                                //$("#loader").show();
                                $.ajax({
                                    type: "POST",
                                    url: "/stock_management/outwardwardstock/get_warehouse_outward.php",
                                    data:'customer='+val,
                                success: function(data){
                                    $("#warehouse-list").html(data);
                                    //$("#loader").hide();
                                }
                                });
                            }

                            function getCompartment() {
                                //$("#loader").show();
                                //$(compartment-list).empty();
                                val=$("#warehouse-list").val();
                                cval=$("#customer-list").val();
                                $.ajax({
                                    type: "POST",
                                    url: "/stock_management/outwardstock/get_compartment_outward.php",
                                    data:{customer:cval,warehouse:val},
                                success: function(data){
                                    $("#compartment-list").html(data);
                                    //$("#loader").hide();
                                }
                                });
                            }
                        </script> 

                          <div class="col-md-3 mb-3">
                            <label for="validationDefault05" class="info">Outward Transport</label><span id="transport-info" class="info"></span>
                            <select id="transport-list" name="transport" class="form-control demoInputBox">
                            <option value="0">All</option>    
                            <?php
                              $gen = new Generic();
                              $result = $gen->getTransportModeList();
                                 if (!empty($result)) {
                                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                                    {   
                            ?> 
                             <option value=<?php echo $row['id']; ?>> <?php echo $row["transport_mode"]; ?></option>
                            <?php   } 
                              }
                            ?>
                            </select>
                        </div>        
                         <div class="col-md-8 mb-3">
                            <div class="container">
                                <div class="form-row">
                                    <div class="col-md-3" style="margin-left:10px;padding-top: 32px;">
                                        <button class="btn btn-primary" type="submit" name="btnSubmit" id="btnSubmit" value="Fetch Data">Fetch Data</button>
                                    </div>
                                    <div class="col-md-3" style="padding-top: 32px;">
                                        <a href="/stock_management/outwardstock/excel_export.php" class="btn btn-primary btn-md" role="button" target="_blank"> Export Excel</a>
                                    </div>
                                </div>
                            </div>                               
                        </div> 
                    </div>
                </div>
          </form>
          </div>

    <div class="card-body">
        <!--<div class="row">
        <div class="col-md-5 ">
            <input type="text" name="date_picker" id="date_picker" class = "form-control" value="<?= date('m/d/Y') ?>"/>
        </div>
        <div class="col-md-2 mb-3">
            <input type="button" name="filter" id="filter" value="Filter" class = "btn btn-dark" >
        </div>
        <div class="col-md-3" style="margin-left:-100px;">
                    <a href="../../stock_management/outwardstock/excel_export.php" class="btn btn-primary btn-md" role="button" target="_blank"> Export Excel</a>
        </div> 
        </div> -->
    <div class="table-responsive" id="get_data">
        <table id="datatableid" class="table table-bordered table-dark" style="width:100%" >
        <thead style="background-color:#4e73df;">
            <tr style="font-size:14px;">
                <th><strong>Id</strong></th> 
                <th><strong>Transaction Date</strong></th> 
                <th ><strong>Commodity</strong></th>
                <th><strong>Warehouse</strong></th>
                <th><strong>Compartment</strong></th>
                <th><strong>Vehicle Number</strong></th>
                <th><strong>No.of bags out</strong></th>
                <th><strong>Net Weight</strong></th>
                <th><strong>Delivery Details</strong></th>
                <!--<th><strong>Actions</strong></th>-->    
            </tr>
        </thead>
        <tbody style="background-color:#ffffff; color: #000000;">
        <?php
        if (! empty($result)) 
        {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {    
        ?>
            <tr style="font-size:12px;">  
                <td><?php echo $row["id"]; ?></td>              
                <td><?php echo $row["transaction_date"]; ?></td>
                <td><?php echo $row["commodity"]; ?></td>
                <td><?php echo $row["warehouse_name"]; ?></td>
                <td><?php echo $row["compartment_name"]; ?></td>
                <td><?php echo $row["vehicle_no"]; ?></td>
                <td><?php echo $row["bags_out"]; ?></td>
                <td><?php echo $row["outward_net_wt"]; ?></td>
                <td><?php echo $row["delivery_name"] ?></td>
                <!--<td><a class="btnEditAction" href="../../stock_management/outwardstock/cOutwardstock.php?action=outwardstock-edit&id=<?php #echo $row["id"]; ?>">
                    <img src="../../img/icon-edit.png" />
                </a>
               <a class="btnDeleteAction" href="../../stock_management/outwardstock/cOutwardstock.php?action=outwardstock-delete&id=<?php #echo $row["id"]; ?>">
                    <img src="../../img/icon-delete.png" />
                </a> 
                </td>-->
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
<!--<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" rel="stylesheet"></script>
<script>
    $(document).ready(function(){
        $.datepicker.setDefaults({
            dateformat: 'd-M-Y'
        });
        $("#date_picker").datepicker();
        $('#filter').click(function(){
            var date_picker = $('#date_picker').val();
            if (date_picker != ''){
                $.ajax({
                    url:"filter.php",
                    method: "POST",
                    data:{date_picker:date_picker},
                    success:function(data)
                    {
                        $('#get_data').html(data);
                    }
                });
            }
            else
            {
                alret("please select Date");
            }
        });
    });
</script>-->
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