<?php
    if (isset($_POST['Report'])) 
    {
        $customer_id = $_POST['customer'];
        $commodity_id = $_POST['commodity'];
        $rpt_date = date("Y-m-d",strtotime($_POST['rptdate']));
    }
    $open_count = mysqli_num_rows($openstock_result);
    $in_count=mysqli_num_rows($inward_result);
    $in_wagon_count=mysqli_num_rows($inward_wagon_result);
    $out_count=mysqli_num_rows($outward_result);
    
    if($open_count >0 || $in_count > 0 || $out_count > 0 || $in_wagon_count > 0)
    { 
        $open_row = mysqli_fetch_array($openstock_result, MYSQLI_ASSOC);
        $inward_row = mysqli_fetch_array($inward_result, MYSQLI_ASSOC);
        $inward_wagon_row = mysqli_fetch_array($inward_wagon_result, MYSQLI_ASSOC);
        $outward_row = mysqli_fetch_array($outward_result, MYSQLI_ASSOC);
    }
    else
    {
        header("location: ../../daily_customer_stock-rpt");
        exit;
    }

    include($_SERVER['DOCUMENT_ROOT'] .'/includes/header.php'); 
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php');  
    //$currentDateTime = new DateTime('now'); 
    //$currentDate = $currentDateTime->format('d-M-Y'); 
    $customer = "";
    $commodity = "";
        
    $open_bags = 0.000;
    $open_gross = 0.000;
    $open_net = 0.000;

    $in_bags = 0.000;
    $in_gross = 0.000;
    $in_net = 0.000;

    $wg_bags = 0.000;
    $wg_gross = 0.000;
    $wg_net = 0.000;

    $out_bags = 0.000;
    $out_gross = 0.000;
    $out_net = 0.000;

    $in_transport = "";
    $wg_transport = "";
    $out_delivery = "";
    
    $tot_bags = 0.000;
    $tot_gross_wt = 0.000;
    $tot_net_wt = 0.000;

    if($open_count>0)
    {
        $customer = $open_row["customer_name"];
        $commodity = $open_row["commodity"];
        $rpt_date = $open_row["stock_date"];
        $open_bags = round($open_row["bags"],3);
        $open_gross = round($open_row["gross_wt"],3);
        $open_net = round($open_row["net_wt"],3);
    }

    if($in_count >0)
    {
        if ($customer == "")
        {
            $customer = $inward_row["customer_name"];
            $commodity = $inward_row["commodity"];
            $rpt_date = $inward_row["received_date"];    
        }
        $in_transport = $inward_row["transport_mode"];
        $in_bags = round($inward_row["bags"],3);
        $in_gross = round($inward_row["gross_wt"],3);
        $in_net = round($inward_row["net_wt"],3);

    }

    if($in_wagon_count >0)
    {
        if($customer == "")
        {
            $customer = $inward_wagon_row["customer_name"];
            $commodity = $inward_wagon_row["commodity"];
            $rpt_date = $inward_wagon_row["received_date"];
        }
        $wg_transport = $inward_wagon_row["transport_mode"];
        $wg_bags = round($inward_wagon_row["bags"],3);
        $wg_gross = round($inward_wagon_row["gross_wt"],3);
        $wg_net = round($inward_wagon_row["net_wt"],3);
    
    }

    if($out_count >0)
    {
        if($customer == "")
        {
            $customer = $outward_row["customer_name"];
            $commodity = $outward_row["commodity"];
            $rpt_date = $outward_row["outward_date"];
        }
        $out_delivery = $outward_row["delivery"];
        $out_bags = round($outward_row["bags"],3);
        $out_gross_wt = round($outward_row["gross_wt"],3);
        $out_net_wt = round($outward_row["net_wt"],3);
    }

 ?>
<div class="container-fluid" >
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h3 class="m-0 font-weight-bold text-primary">       
    </h3>
  </div>

<div class="card-body" style="border: 3px solid var(--primary);">
    <div class="header">
        <div class="col-lg-12">
            <center><h2>SHRI CHANDRA BULK CARGO SERVICES PRIVATE LIMITED</h2>
            <h3>Shipping and Logistics</h3></center>
        </div>
        
    <div class="row">
        <div class="col-lg-2">
            <center><div class="logo_sec"> <img src="../../assests/img/logo-scbc.png" alt="code logo">
        </div></center>
    </div>
          
    <div class="col-lg-8">
        <div class="title_wrap">
            <center><p class="sub_title" style="font-size:13px;line-height:20px;">Head Office ; D:No. 7g-7-62/A,1st Floor, Ramya Royale, Revenue Ward No. 30, Ramanayyapeta, Kakinada<br>
533 003. A.P., lndia, Contact : 9l-884-2361567, 9l-884-2361569, E-mail : scbc@shrichandrabulk.com</p>
<h6>CIN : U74900AP2009PTC064815 GSTIN : 37AAECR9430I1ZX PAN : AAECR9403L</h6></center>
        </div>
    </div>
</div>

<hr>
    <div class="row">
        <div class="col-lg-6">
            <div class="title_wrap">
                <h4 class="sub_title" style="font-size:16px;line-height:20px;"><?php echo $customer; ?></h4>
            </div>
        </div>
       
        <div class="col-lg-6">
            <div class="title_wrap" style="float:right;"> <h4 class="sub_title" style="font-size:16px;line-height:20px;">Date:<?php echo $rpt_date; ?></h4>
                <h4 class="sub_title" style="font-size:16px;line-height:20px; ">Report No:36</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <h4 class="sub_title" style="font-size:16px;line-height:20px;"><?php if($commodity!=""){ echo "ARRIVAL OF ".$commodity; } ?></h4> 
            <br><br>
        </div>

        <div class="col-lg-6"></div>
    </div>

    <div class="table-responsive">
        <div class="body" >
            <div class="main_table" style="border:1px; border-style: solid;">

                <div class="table_header" style="border:1px; border-style: solid;">
                    <div class="row" style="border:1px; border-style: solid;">
                        <div class="col col_des" style="border:1px; border-style: solid;"><b>PARTICULARS</b></div>
                        <div class="col col_des" style="border:1px; border-style: solid;"><b></b></div>
                        <div class="col col_price" style="border:1px; border-style: solid;"><b>BAGS</b></div>
                        <div class="col col_qty" style="border:1px; border-style: solid;"><b>GROSS_WT</b></div>
                        <div class="col col_total" style="border:1px; border-style: solid;"><b>NET_WT</b></div>
                    </div>
                </div>

                <div class="table_body" style="border:1px; border-style: solid;">
                <?php
                    $htm = "";
                    if($open_count > 0)
                    {                       
                        $htm .= "<div class='row' style='border:1px; border-style: solid;'>";
                        $htm .= " <div class='col col_des' style='border:1px; border-style: solid;''>";
                        $htm .= "  <p class='bold'>OPENING STOCK</p>";
                        $htm .= " </div>";
                        $htm .= " <div class='col col_des' style='border:1px; border-style: solid;'>";
                        $htm .= "  <p class='bold'></p>";
                        $htm .= " </div>";
                        $htm .= " <div class='col col_price' style='border:1px; border-style: solid;'>";
                        $htm .= "  <p>".round($open_bags,3)."</p>";
                        $htm .= " </div>";
                        $htm .= " <div class='col col_qty' style='border:1px; border-style: solid;'>";
                        $htm .= "  <p>".round($open_gross,3)."</p>";
                        $htm .= " </div>";
                        $htm .= " <div class='col col_total' style='border:1px; border-style: solid;'>";
                        $htm .= "  <p>".round($open_net,3)."</p>";
                        $htm .= " </div>";
                        $htm .= "</div>";
                        $htm .= "</div>"; //

                        $htm .= "<div class='row' style='border:1px; border-style: solid;'>";
                        $htm .= " <div class='col col_des' style='border:1px;'>";
                        $htm .= "  <p></p>";
                        $htm .= " </div>";
                        $htm .= "</div>";
                        echo $htm;
                        $tot_bags = round($tot_bags + $open_bags,3);
                        $tot_gross_wt = round($tot_gross_wt + $open_gross,3);
                        $tot_net_wt = round($tot_net_wt + $open_net,3);
                    }
                    $htm = "";
                    //Inward Stock except for Wagon
                    if($in_count >0)
                    {
                        // Code for printing inward stock all except Wagon.
                        $htm = "";
                        foreach ($inward_result as $in)
                        {
                            $htm .= "<div class='row' style='border:1px; border-style: solid;'>";
                            $htm .= " <div class='col col_des' style='border:1px; border-style: solid;'>";
                            $htm .= "  <p class='bold'>RECEIVED FROM ".$in["transport_mode"]." ".$commodity."</p>";
                            $htm .= " </div>";
                            $htm .= "</div>";

                            $htm .= "<div class='row' style='border:1px; border-style: solid;'>";
                            $htm .= " <div class='col col_des' style='border:1px; border-style: solid;'>";
                            $htm .= "  <p class='bold'></p>";
                            $htm .= " </div>";
                            $htm .= " <div class='col col_des' style='border:1px; border-style: solid;'>";
                            $htm .= "  <p class='bold'></p>";
                            $htm .= " </div>";
                            $htm .= " <div class='col col_price' style='border:1px; border-style: solid;'>";
                            $htm .= "  <p>".round($in['bags'],3)."</p>";
                            $htm .= " </div>";
                            $htm .= " <div class='col col_qty' style='border:1px; border-style: solid;'>";
                            $htm .= "  <p>".round($in['gross_wt'],3)."</p>";
                            $htm .= " </div>";
                            $htm .= " <div class='col col_total' style='border:1px; border-style: solid;'>";
                            $htm .= "  <p>".round($in['net_wt'],3)."</p>";
                            $htm .= " </div>";
                            $htm .= "</div>";

                            $htm .= "<div class='row' style='border:1px; border-style: solid;'>";
                            $htm .= " <div class='col col_des' style='border:1px;'><p></p>";
                            $htm .= " </div>";
                            $htm .= "</div>"; 
                            
                            $tot_bags = round($tot_bags + $in['bags'],3);
                            $tot_gross_wt = round($tot_gross_wt + $in['gross_wt'],3);
                            $tot_net_wt = round($tot_net_wt + $in['net_wt'],3);
                        }
                        echo $htm;
                    }
                    
                ?>

                <?php
                    if($in_wagon_count >0)
                    {
                        // Code for printing Wagon based inward stock.
                        $htm = "";                   
                        foreach ($inward_wagon_result as $wg) 
                        {

                            $htm .= "<div class='row' style='border:1px; border-style: solid;'>";
                            $htm .= " <div class='col col_des' style='border:1px; border-style: solid;'>";
                            $htm .= "  <p class='bold'>RECEIVED FROM ".$wg["transport_mode"]." ".$commodity."</p>";
                            $htm .= " </div>";
                            $htm .= "</div>";

                            $htm .= "<div class='row' style='border:1px; border-style: solid;'>";
                            $htm .= " <div class='col col_des' style='border:1px; border-style: solid;'>";
                            $htm .= "  <p class='bold'></p>";
                            $htm .= " </div>";
                            $htm .= " <div class='col col_des' style='border:1px; border-style: solid;'>";
                            $htm .= "  <p class='bold'></p>";
                            $htm .= " </div>";
                            $htm .= " <div class='col col_price' style='border:1px; border-style: solid;'>";
                            $htm .= "  <p>".round($wg['bags'],3)."</p>";
                            $htm .= " </div>";
                            $htm .= " <div class='col col_qty' style='border:1px; border-style: solid;'>";
                            $htm .= "  <p>".round($wg['gross_wt'],3)."</p>";
                            $htm .= " </div>";
                            $htm .= " <div class='col col_total' style='border:1px; border-style: solid;'>";
                            $htm .= "  <p>".round($wg['net_wt'],3)."</p>";
                            $htm .= " </div>";
                            $htm .= "</div>";
    
                            $htm .= "<div class='row' style='border:1px; border-style: solid;'>";
                            $htm .= " <div class='col col_des' style='border:1px;'><p></p>";
                            $htm .= " </div>";
                            $htm .= "</div>";   

                            $tot_bags = round($tot_bags + $wg['bags'],3);
                            $tot_gross_wt = round($tot_gross_wt + $wg['gross_wt'],3);
                            $tot_net_wt = round($tot_net_wt + $wg['net_wt'],3);
                        }
                        echo $htm;
                    }
                ?>
                    <div class="row" style="border:1px; border-style: solid;">                   
                        <div class="col col_des" style="border:1px; border-style: solid;">
                            <p class="bold"><b>TOTAL STOCK</b></p>
                        </div>
                        <div class="col col_des" style="border:1px; border-style: solid;">
                            <p class="bold"></p>                            
                        </div>
                        <div class="col col_price" style="border:1px; border-style: solid;">
                            <p><?php echo round($tot_bags,3); ?></p>
                        </div>
                        <div class="col col_qty" style="border:1px; border-style: solid;">
                            <p><?php echo round($tot_gross_wt,3); ?></p>
                        </div>
                        <div class="col col_total" style="border:1px; border-style: solid;">
                            <p><?php echo round($tot_net_wt,3); ?></p>
                        </div>
                    </div>

                    <div class="row" style="border:1px; border-style: solid;">
                        <div class="col col_des" style="border:1px;">
                            <p></p>
                        </div>
                    </div>
                    <div class="row" style="border:1px; border-style: solid;">
                        <div class="col col_des" style="border:1px;">
                            <p></p>
                        </div>
                    </div>
                    
                    <div class="row" style="border:1px; border-style: solid;">                        
                        <div class="col col_des" style="border:1px; border-style: solid;">
                            <p class="bold"><b>BALANCE</b></p>
                        </div>
                        <div class="col col_des" style="border:1px; border-style: solid;">
                            <p class="bold"></p>                            
                        </div>
                        <div class="col col_price" style="border:1px; border-style: solid;">
                            <p><?php echo round($tot_bags,3); ?></p>
                        </div>
                        <div class="col col_qty" style="border:1px; border-style: solid;">
                            <p><?php echo round($tot_gross_wt,3); ?></p>
                        </div>
                        <div class="col col_total" style="border:1px; border-style: solid;">
                            <p><?php echo round($tot_net_wt,3); ?></p>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
        <div class="row" style="margin-top:20px;">
                <div class="col-lg-6">
                    <h4 class="sub_title" style="font-size:16px;line-height:20px;">
SUB :DELIVERY DETAILS OF BOILED RICE, BROKEN & REJECTION</h4> <br>
                </div>
                <div class="col-lg-6">
                    
                </div>
            </div>
    
        <div class="body" >
            <div class="main_table" style="border:1px; border-style: solid;">
                <div class="table_header" style="border:1px; border-style: solid;">
                    <div class="row" style="border:1px; border-style: solid;">
                    <div class="col col_des" style="border:1px; border-style: solid;"><b>PARTICULARS</b></div>
                        <div class="col col_des" style="border:1px; border-style: solid;"><b></b></div>
                        <div class="col col_price" style="border:1px; border-style: solid;"><b>BAGS</b></div>
                        <div class="col col_qty" style="border:1px; border-style: solid;"><b>GROSS_WT</b></div>
                        <div class="col col_total" style="border:1px; border-style: solid;"><b>NET_WT</b></div>
                    </div>
                </div>

                <div class="table_body" style="border:1px; border-style: solid;">
                    <div class="row" style="border:1px; border-style: solid;">        
                        <div class="col col_des" style="border:1px; border-style: solid;">
                            <p class="bold">OPENING STOCK</p>                            
                        </div>
                        <div class="col col_des" style="border:1px; border-style: solid;">
                            <p class="bold"></p>                            
                        </div>
                        <div class="col col_price" style="border:1px; border-style: solid;">
                            <p></p>
                        </div>
                        <div class="col col_qty" style="border:1px; border-style: solid;">
                            <p></p>
                        </div>
                        <div class="col col_total" style="border:1px; border-style: solid;">
                            <p></p>
                        </div>                        
                    </div>

                    <div class="row" style="border:1px; border-style: solid;">
                        <div class="col col_des" style="border:1px;">
                            <p class="bold">DELIVERY OF <?php echo $commodity; echo "  TO ".$out_delivery." ON ".$rpt_date; ?></p>
                        </div>
                    </div>

                    <div class="row" style="border:1px; border-style: solid;">
                        <div class="col col_des" style="border:1px; border-style: solid;">
                            <p></p>
                        </div>
                        <div class="col col_des" style="border:1px; border-style: solid;">
                            <p class="bold"></p>                            
                        </div>
                        <div class="col col_price" style="border:1px; border-style: solid;">
                            <p><?php echo $out_bags; ?></p>
                        </div>
                        <div class="col col_qty" style="border:1px; border-style: solid;">
                            <p><?php echo $out_gross; ?></p>
                        </div>
                        <div class="col col_total" style="border:1px; border-style: solid;">
                            <p><?php echo $out_net; ?></p>
                        </div>
                    </div> 

                    <div class="row" style="border:1px; border-style: solid;">
                        <div class="col col_des" style="border:1px;">
                            <p></p>
                        </div>
                    </div>

                    <div class="row" style="border:1px; border-style: solid;">                   
                        <div class="col col_des" style="border:1px; border-style: solid;">
                            <p class="bold"><b>CLOSING STOCK</b></p>
                        </div>
                        <div class="col col_des" style="border:1px; border-style: solid;">
                            <p class="bold"></p>                            
                        </div>
                        <div class="col col_price" style="border:1px; border-style: solid;">
                            <p><?php if($tot_bags>0) {echo ($tot_bags-$out_bags);} else{echo $out_bags;}?></p>
                        </div>
                        <div class="col col_qty" style="border:1px; border-style: solid;">
                            <p><?php if($tot_gross_wt>0) {echo ($tot_gross_wt-$out_gross);} else{echo $out_gross;}?></p>
                        </div>
                        <div class="col col_total" style="border:1px; border-style: solid;">
                            <p><?php if($tot_net_wt>0) {echo ($tot_net_wt-$out_net);} else{echo $out_net;}?></p>
                        </div>
                    </div>
                </div>             
            </div>  
          </div>
        </div> 
    </div> 
    </div> 
<br>
    <form name="frmAdd" method="post" action="../../reports/daily_customer_stock/daily_cust_stock_pdf.php" id="frmAdd">
        <h3 class="m-0 font-weight-bold text-primary">
        <input type="hidden" id="cust_id" name="cust_id" value=<?php echo $customer_id;?>>
        <input type="hidden" id="comm_id" name="comm_id" value=<?php echo $commodity_id;?>>
        <input type="hidden" id="pdf_dt" name="pdf_dt" value=<?php echo $rpt_date;?>>
        <button class="btn btn-primary" type="submit" name="btnSubmit" id="btnSubmit" value="GeneratePDF" target="__blank">Generate PDF</button>
            <!-- 
                <a href="daily_cust_stock_pdf.php" class="btn btn-primary btn-md float-center" style="margin-left: 20px;" role="button" target="_blank">Generate PDF</a>
                <a href="../../reports/current_stock/excel_export.php" class="btn btn-primary btn-md float-center" role="button" target="_blank"> Export Excel</a>
            -->
    </h3>
    </form>
  </div>
</div>
<!-- /.container-fluid -->
<?php
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/scripts.php');
    include($_SERVER['DOCUMENT_ROOT'] .'/includes/footer.php');
?>