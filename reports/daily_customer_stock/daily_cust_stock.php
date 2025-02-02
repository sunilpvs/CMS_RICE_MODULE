<?php
    $in_count=mysqli_num_rows($inward_result);
    $in_wagon_count=mysqli_num_rows($inward_wagon_result);
    $out_count=mysqli_num_rows($outward_result);
    
    if($in_count > 0 || $out_count > 0 || $in_wagon_count > 0)
    { 
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
    $currentDateTime = new DateTime('now'); 
    $currentDate = $currentDateTime->format('d-M-Y'); 
    
    $customer = "";
    $rpt_date="";
    $in_commodity = "";
    $wg_commodity = "";
    $out_commodity = "";
    $in_transport = "";
    $wg_transport = "";
    $out_delivery = "";
    
    $in_bags = 0;
    $in_gross_wt = 0;
    $in_net_wt = 0;

    $in_wg_bags = 0;
    $in_wg_gross_wt = 0;
    $in_wg_net_wt = 0; 

    $out_bags = 0;
    $out_gross_wt = 0;
    $out_net_wt = 0;

    $tot_bags = 0;
    $tot_gross_wt = 0;
    $tot_net_wt = 0;


    if($in_count >0)
    {
        $customer = $inward_row["customer_name"];
        $rpt_date = $inward_row["received_date"];
        $in_commodity= $inward_row["commodity"];
        $in_transport = $inward_row["transport_mode"];
        $in_bags = round($inward_row["bags"],3);
        $in_gross_wt = round($inward_row["gross_wt"],3);
        $in_net_wt = round($inward_row["net_wt"],3);

        $tot_bags = $in_bags;
        $tot_gross_wt = $in_gross_wt;
        $tot_net_wt = $in_net_wt;
    }

    if($in_wagon_count >0 && $customer == "")
    {
        $customer = $inward_wagon_row["customer_name"];
        $rpt_date = $inward_wagon_row["received_date"];
        $wg_transport = $inward_wagon_row["transport_mode"];
        //$in_commodity= $inward_wagon_row["commodity"];
        // $in_date=$inward_row["received_date"];
        // $in_bags = $inward_row["bags"];
        // $in_gross_wt = $inward_row["gross_wt"];
        // $in_net_wt = $inward_row["net_wt"];
    }

    if($out_count >0)
    {
        if($customer == "")
        {
            $customer = $outward_row["customer_name"];
            $rpt_date = $outward_row["outward_date"];
        }
        $out_commodity=$outward_row["commodity"];
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
            <h4 class="sub_title" style="font-size:16px;line-height:20px;"><?php if($in_count>0){ echo "ARRIVAL OF ".$in_commodity; } ?></h4> 
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
                    //Inward Stock except for Wagon
                    if($in_count >0)
                    {
                        // Code for printing inward stock all except Wagon.
                        $htm = "";
                        foreach ($inward_result as $in)
                        {

                            $htm .= "<div class='row' style='border:1px; border-style: solid;'>";
                            $htm .= "<div class='col col_des' style='border:1px; border-style: solid;'>";
                            $htm .= "<p class='bold'>RECEIVED FROM ".$in['transport_mode']." ".$in['commodity']."</p>";
                            $htm .= "</div>";
                            $htm .= "</div>";

                            $htm .= "<div class='row' style='border:1px; border-style: solid;'>";
                            $htm .= "<div class='col col_des' style='border:1px; border-style: solid;''>";
                            $htm .= "<p class='bold'>OPENING STOCK</p>";
                            $htm .= "</div>";
                            $htm .= "<div class='col col_des' style='border:1px; border-style: solid;'>";
                            $htm .= "<p class='bold'></p>";
                            $htm .= "</div>";
                            $htm .= "<div class='col col_price' style='border:1px; border-style: solid;'>";
                            $htm .= "<p>".round($in['bags'],3)."</p>";
                            $htm .= "</div>";
                            $htm .= "<div class='col col_qty' style='border:1px; border-style: solid;'>";
                            $htm .= "<p>".round($in['gross_wt'],3)."</p>";
                            $htm .= "</div>";
                            $htm .= "<div class='col col_total' style='border:1px; border-style: solid;'>";
                            $htm .= "<p>".round($in['net_wt'],3)."</p>";
                            $htm .= "</div>";
                            $htm .= "</div>";

                            $htm .= "<div class='row' style='border:1px; border-style: solid;'>";
                            $htm .= "<div class='col col_des' style='border:1px;'>";
                            $htm .= "<p></p>";
                            $htm .= "</div>";
                            $htm .= "</div>";

                            $htm .= "<div class='row' style='border:1px; border-style: solid;'>";
                            $htm .= "<div class='col col_des' style='border:1px;'>";
                            $htm .= "<p></p>";
                            $htm .= "</div>";
                            $htm .= "</div>";

                            $tot_bags = round($tot_bags + $in['bags'],3);
                            $tot_gross_wt = round($tot_gross_wt + $in['gross_wt'],3);
                            $tot_net_wt = round($tot_net_wt + $in['net_wt'],3);
                        }
                    }
                    echo $htm;
                ?>
                


                    <?php
                        if($in_wagon_count >0)
                        {
                            // Code for printing Wagon based inward stock.
                            $htm = "";                   
                            foreach ($inward_wagon_result as $wg) 
                            {

                                $htm .= "<div class='row' style='border:1px; border-style: solid;'>";
                                $htm .= "<div class='col col_des' style='border:1px; border-style: solid;'>";
                                $htm .= "<p class='bold'>RECEIVED FROM ".$wg["transport_mode"]." ".$wg['commodity']."</p>";
                                $htm .= "</div>";
                                $htm .= "</div>";

                                $htm .= "<div class='row' style='border:1px; border-style: solid;'>";
                                $htm .= "<div class='col col_des' style='border:1px; border-style: solid;'>";
                                $htm .= "<p class='bold'>OPENING STOCK</p>";
                                $htm .= "</div>";
                                $htm .= "<div class='col col_des' style='border:1px; border-style: solid;'>";
                                $htm .= "<p class='bold'></p>";
                                $htm .= "</div>";
                                $htm .= "<div class='col col_price' style='border:1px; border-style: solid;'>";
                                $htm .= "<p>".round($wg['bags'],3)."</p>";
                                $htm .= "</div>";
                                $htm .= "<div class='col col_qty' style='border:1px; border-style: solid;'>";
                                $htm .= "<p>".round($wg['gross_wt'],3)."</p>";
                                $htm .= "</div>";
                                $htm .= "<div class='col col_total' style='border:1px; border-style: solid;'>";
                                $htm .= "<p>".round($wg['net_wt'],3)."</p>";
                                $htm .= "</div>";
                                $htm .= "</div>";
        
                                $htm .= "<div class='row' style='border:1px; border-style: solid;'>";
                                $htm .= "<div class='col col_des' style='border:1px;'><p></p>";
                                $htm .= "</div>";
                                $htm .= "</div>";
        
    
                                // $htm .= "<div class='row' style='border:1px; border-style: solid;'>";
                                // $htm .= "<div class='col col_des' style='border:1px; border-style: solid;'>";
                                // $htm .= "<p class='bold'></p>";
                                // $htm .= "</div>";
                                // $htm .= "<div class='col col_des' style='border:1px; border-style: solid;'>";
                                // $htm .= "<p class='bold'></p>";
                                // $htm .= "</div>";
                                // $htm .= "<div class='col col_price' style='border:1px; border-style: solid;'>";
                                // $htm .= "<p>".round($wg['bags'],3)."</p>";
                                // $htm .= "</div>";
                                // $htm .= "<div class='col col_qty' style='border:1px; border-style: solid;'>";
                                // $htm .= "<p>".round($wg['gross_wt'],3)."</p>";
                                // $htm .= "</div>";
                                // $htm .= "<div class='col col_total' style='border:1px; border-style: solid;'>";
                                // $htm .= "<p>".round($wg['net_wt'],3)."</p>";
                                // $htm .= "</div>";
                                // $htm .= "</div>";    

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
                            <p><?php echo $tot_bags; ?></p>
                        </div>
                        <div class="col col_qty" style="border:1px; border-style: solid;">
                            <p><?php echo $tot_gross_wt; ?></p>
                        </div>
                        <div class="col col_total" style="border:1px; border-style: solid;">
                            <p><?php echo $tot_net_wt; ?></p>
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
                            <p><?php echo $tot_bags; ?></p>
                        </div>
                        <div class="col col_qty" style="border:1px; border-style: solid;">
                            <p><?php echo $tot_gross_wt; ?></p>
                        </div>
                        <div class="col col_total" style="border:1px; border-style: solid;">
                            <p><?php echo $tot_net_wt; ?></p>
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
                            <p><?php echo $out_bags; ?></p>
                        </div>
                        <div class="col col_qty" style="border:1px; border-style: solid;">
                            <p><?php echo $out_gross_wt; ?></p>
                        </div>
                        <div class="col col_total" style="border:1px; border-style: solid;">
                            <p><?php echo $out_net_wt; ?></p>
                        </div>
                    </div>

                    <div class="row" style="border:1px; border-style: solid;">
                        <div class="col col_des" style="border:1px; border-style: solid;">
                            <p class="bold">DELIVERY OF <?php echo $out_commodity; echo "  TO ".$out_delivery." ON ".$rpt_date; ?></p>
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
                            <p class="bold"><b>CLOSING STOCK</b></p>
                        </div>
                        <div class="col col_des" style="border:1px; border-style: solid;">
                            <p class="bold"></p>                            
                        </div>
                        <div class="col col_price" style="border:1px; border-style: solid;">
                            <p><?php if($tot_bags>0) {echo ($tot_bags-$out_bags);} else{echo $out_bags;}?></p>
                        </div>
                        <div class="col col_qty" style="border:1px; border-style: solid;">
                            <p><?php if($tot_gross_wt>0) {echo ($tot_gross_wt-$out_gross_wt);} else{echo $out_gross_wt;}?></p>
                        </div>
                        <div class="col col_total" style="border:1px; border-style: solid;">
                            <p><?php if($tot_net_wt>0) {echo ($tot_net_wt-$out_net_wt);} else{echo $out_net_wt;}?></p>
                        </div>
                    </div>
                </div>
            </div>  
          </div>
        </div>   
<br>
   <h3 class="m-0 font-weight-bold text-primary"  >
            <!--<a href="department_generate_pdf.php" class="btn btn-primary btn-md float-center" style="margin-left: 20px;" role="button" target="_blank">Generate PDF</a>-->
            <a href="../../reports/current_stock/excel_export.php" class="btn btn-primary btn-md float-center" role="button" target="_blank"> Export Excel</a>
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