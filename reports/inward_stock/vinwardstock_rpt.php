<?php
   require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php');
   require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
 ?>
<div class="container-fluid">
  <div class="card shadow mb-4">
        <div class="card-body">
        <form name="frmAdd" method="post"
             action="../../reports/inwardstock/cinwardstock_rpt.php?action=inward-filter" id="frmAdd" onSubmit="return validate();">

                <div class="container">
                    <div class="form-row">
                        <div class="col-md-3">
                              <div>
                                   <label>Day Wise:</label>
                                   <input id="myCheck" type="checkbox" />
                               </div>
                                <div>
                                    <label>Select Date</label>
                                    <input id="yourDateField" type="date" />
                                </div>
                        </div>
                        
                        <script>
                            var yourCheckbox = document.querySelector('#myCheck');
                            var yourDateField = document.querySelector('#yourDateField');
                            // This function will update the date field's enabled/disabled
                            // attribute, depending on if the yourCheckbox is checked
                            function updateYourDateField() 
                            {
                                if(yourCheckbox.checked) 
                                {
                                    yourDateField.disabled = false;
                                }
                                else 
                                {
                                    yourDateField.disabled = true;
                                }
                            }
   
                            // Add an event listener to the change event, that causes
                            // the date field to be enabled/disabled when ever the checkbox
                            // is clicked and the value changes
                            yourCheckbox.addEventListener('change', function() {
                                updateYourDateField();
                            })
                            // Call this to ensure your date field is in correct state
                            // when the script is first run
                            updateYourDateField();
                        </script> 

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
                                    url: "../reports/inwardstock/get_warehouse.php",
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
                                    url: "../reports/inwardstock/get_compartment.php",
                                    data:{customer:cval,warehouse:val},
                                success: function(data){
                                    $("#compartment-list").html(data);
                                    //$("#loader").hide();
                                }
                                });
                            }
                        </script>

                        <div class="col-md-3 mb-3">
                            <label for="validationDefault05" class="info">Miller</label><span id="miller-info" class="info"></span>
                            <select id="miller-list" name="miller" class="form-control demoInputBox">
                            <option value="0">All</option>    
                            <?php
                              $gen = new Generic();
                              $result = $gen->getMillerList();
                                 if (!empty($result)) {
                                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                                    {   
                            ?> 
                             <option value=<?php echo $row['id']; ?>> <?php echo $row["miller_name"]; ?></option>
                            <?php   } 
                              }
                            ?>  
                            </select>
                        </div>  

                        <div class="col-md-3 mb-3">
                            <label for="validationDefault05" class="info">Commodity</label><span id="commodity-info" class="info"></span>
                            <select id="commodity-list" name="commodity" class="form-control demoInputBox">
                            <option value="0">All</option>    
                            <?php
                              $gen = new Generic();
                              $result = $gen->getCommodityList();
                                 if (!empty($result)) {
                                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                                    {   
                            ?> 
                             <option value=<?php echo $row['id']; ?>> <?php echo $row["commodity"]; ?></option>
                            <?php   } 
                              }
                            ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="validationDefault05" class="info">Inward Transport</label><span id="transport-info" class="info"></span>
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
                        <div class="col-md-3 mb-3">
                            <div class="container">
                                <div class="form-row">
                                    <div class="col-md-3" style="margin-left:10px;padding-top: 32px;">
                                        <button class="btn btn-primary" type="submit" name="btnSubmit" id="btnSubmit" value="Fetch Data">Fetch Data</button>
                                    </div>
                                    <div class="col-md-3" style="margin-left:50px;padding-top: 32px;">
                                        <a href="../../stock_mgmt/outwardstock/excel_export.php" class="btn btn-primary btn-md" role="button" target="_blank"> Export Excel</a>
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

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" rel="stylesheet"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
    function validate() 
    {
        var valid = true;   
        $(".form control demoInputBox").css('background-color','');
        $(".info").html('');

        if(!$("#date_picker").val()) 
        {
            $("#date_picker-info").html("(required)");
            $("#date_picker").css('background-color','#FFFFDF');
            valid = false;
        }

        if(!$("#customer").val()) 
        {
            $("#customer-info").html("(required)");
            $("#customer").css('background-color','#FFFFDF');
            valid = false;
        }

        if(!$("#warehouse").val()) 
        {
            $("#warehouse-info").html("(required)");
            $("#warehouse").css('background-color','#FFFFDF');
            valid = false;
        }

        if(!$("#compartment").val()) 
        {
            $("#compartment-info").html("(required)");
            $("#compartment").css('background-color','#FFFFDF');
            valid = false;
        }

        if(!$("#miller").val()) 
        {
            $("#miller-info").html("(required)");
            $("#miller").css('background-color','#FFFFDF');
            valid = false;
        }

        if(!$("#commodity").val()) 
        {
            $("#commodity-info").html("(required)");
            $("#commodity").css('background-color','#FFFFDF');
            valid = false;
        }

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
