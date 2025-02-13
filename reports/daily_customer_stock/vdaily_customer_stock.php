<?php
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/Generic.php');
 ?>
  <div class="container-fluid">
  <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">Customer Stock Report</h3>
  </div>
  <div class="card-body">
    <form name="frmAdd" method="post" action="../reports/daily_customer_stock/cdaily_customer_stock.php?action=generate_report" id="frmAdd" onSubmit="return validate();">
    <div class="container">
    <div class="form-row">

        <div class="col-md-3 mb-3">
            <label for="validationDefault05" class="info">Customer</label><span id="customer-info" class="info"></span>
            <select id="customer" name="customer" class="form-control demoInputBox" required>
            <option value ="-1" >Select Customer</option>
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
            <label for="validationDefault05" class="info">Commodity</label><span id="commodity-info" class="info"></span>
            <select id="commodity" name="commodity" class="form-control demoInputBox" required>
            <option value ="-1" >Select Commodity</option>
            <?php
                $gen = new Generic();
                $result = $gen->getCommodityList();
                foreach ($result as $commodity) 
                {
            ?>
            <option value="<?php echo $commodity["id"]; ?>"><?php echo $commodity["commodity"]; ?></option>
            <?php
                }
            ?>
            </select>
        </div> 

        <div class="col-md-4 mb-3">
            <label for="validationDefault01" class="info">Report Date</label><span style="color:red" id="rptdate-info" class="info"></span>
            <input type="date" class="form-control demoInputBox" id="rptdate" name= "rptdate" placeholder="YYYY-mm-dd" value="<?= date('Y-m-d') ?>" onchange="TDate()" required>
        </div>
        
        <script>
            function TDate() 
            {
                let span = document.getElementById("rptdate-info");
                var UserDate = document.getElementById("rptdate").value;
                var ToDate = new Date();
                if (new Date(UserDate).getTime() >= ToDate.getTime()) {
                    span.textContent = "** Date greater than today.";
                    document.getElementById("btnSubmit").disabled = true;
                    return false;
                }
                else
                {
                    span.textContent = "";
                    document.getElementById("btnSubmit").disabled = false;
                    return true;
                }   
            }
        </script>

        <div class="col-md-8 mb-3">
            <div class="container">
                <div class="form-row">
                    <div class="col-md-3" style="margin-left:10px;padding-top: 32px;">
                        <button class="btn btn-primary" type="submit" name="btnSubmit" id="btnSubmit" value="Fetch Data" >Generate Report</button>
                    </div>
                </div>
            </div>                               
        </div> 
   </div>
 </div>
</form>
</div>

    </div>
  </div>
</div>
<!-- /.container-fluid -->

<?php
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/scripts.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.php');
?>