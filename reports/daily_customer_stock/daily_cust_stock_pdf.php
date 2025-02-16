<?php
    require('./fpdf/fpdf.php');
    require_once($_SERVER['DOCUMENT_ROOT'] ."/reports/reports.php");

    if (isset($_POST)) 
    {
        $customer_id = $_POST['cust_id'];
        $commodity_id = $_POST['comm_id'];
        $rpt_date = date("Y-m-d",strtotime($_POST['pdf_dt']));
    }

    if($customer_id > 0 )
    {
        $report = new AllReports();
        $openstock_result = $report->getCustomerOpeningStock($customer_id, $commodity_id, $rpt_date);
        $inward_result = $report->getCustomerInwardStock($customer_id, $commodity_id, $rpt_date);
        $inward_wagon_result = $report->getCustomerWagonInwardStock($customer_id, $commodity_id, $rpt_date);
        $outward_result = $report->getCustomerOutwardStock($customer_id, $commodity_id,  $rpt_date);
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

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(10,10,'',0,0);
    $pdf->Cell(30,5,'SHRI CHANDRA BULK CARGO SERVICES PRIVATE LIMITED',0,0);
    $pdf->Cell(10,10,'',0,1);
    $pdf->Cell(55,10,'',0,0);
    $pdf->Cell(50,0,'SHIPPING AND LOGISTICS',0,0);
    $pdf->Cell(30,10,'',0,1);

    $pdf->SetFont('Arial','B',10);
    $pdf->Image('logo-scbc.png', 5, 24, -120);
    $pdf->Cell(20,5,'',0,0);
    $pdf->Cell(40,0,'Head Office : D:No, 70-7-62/A,1st Floor, Ramya Royale, Revenue Ward No. 30, Ramanayyapeta, Kakinada',0,0);
    $pdf->Cell(30,5,'',0,1);
    $pdf->Cell(25,5,'',0,0);
    $pdf->Cell(50,0,'533 033. A.P., lndia, Contact : 9l-884-2361567, 9l-884-4s61569, E-mail scbc@shrichandrabulk.com',0,0);
    $pdf->Cell(30,5,'',0,1);

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(30,5,'',0,0);
    $pdf->Cell(50,0,'CIN : U74900AP2009PTC064815 GSTIN : 37AAECR9430I-1ZX PAN : AAECRS4SoI-533 033.',0,0);
    $pdf->Cell(30,5,'',0,1);
    $pdf->SetLineWidth(1);

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(71,20,$customer,0,0);
    $pdf->Cell(59,20,'',0,0);
    $pdf->Cell(59,20,'',0,1);


    $pdf->SetFont('Arial','',10);
    $pdf->Cell(130,-10,'',0,0); //$pdf->Cell(130,-10,'Cust_Contact',0,0);
    $pdf->Cell(25,-10,'Report Date',0,0);
    $pdf->Cell(34,-10,$rpt_date,0,1);

    $pdf->SetFont('Arial','',10);
    $pdf->Cell(130,20,'',0,0); //$pdf->Cell(130,20,'Cust_Contact',0,0);
    $pdf->Cell(25,20,'Report No',0,0);
    $pdf->Cell(34,20,12,0,1);

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(130,20,'ARRIVAL OF '.$commodity,0,0);
    $pdf->Cell(59,5,'',0,0);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(189,10,'',0,1);


    $pdf->Cell(50,10,'',0,1);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(80,6,'Particulars',1,0,'C');
    $pdf->Cell(20,6,'',1,0,'C');
    $pdf->Cell(30,6,'Bags',1,0,'C');
    $pdf->Cell(30,6,'Gross Weight',1,0,'C');
    $pdf->Cell(30,6,'Net Weight',1,1,'C');

    if($open_count > 0)
    {
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(80,6,'Opening Stock',1,0,'L');
        $pdf->Cell(20,6,'',1,0,'C');
        $pdf->Cell(30,6,round($open_bags,3),1,0,'C');
        $pdf->Cell(30,6,round($open_gross,3),1,0,'C');
        $pdf->Cell(30,6,round($open_net,3),1,1,'C');

        $tot_bags = round($tot_bags + $open_bags,3);
        $tot_gross_wt = round($tot_gross_wt + $open_gross,3);
        $tot_net_wt = round($tot_net_wt + $open_net,3);
    }
    // Blank Row Start
    $pdf->Cell(190,6,'',1,1,'C');
    // Blank Row End 

    //Inward Stock except for Wagon
    if($in_count >0)
    {
        foreach ($inward_result as $in)
        {
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(190,6,'Received From'.$in["transport_mode"].' '.$commodity,1,1,'L');

            $pdf->Cell(100,6,'',1,0,'C');
            $pdf->Cell(30,6,round($in['bags'],3),1,0,'C');
            $pdf->Cell(30,6,round($in['gross_wt'],3),1,0,'C');
            $pdf->Cell(30,6,round($in['net_wt'],3),1,1,'C');

            $tot_bags = round($tot_bags + $in['bags'],3);
            $tot_gross_wt = round($tot_gross_wt + $in['gross_wt'],3);
            $tot_net_wt = round($tot_net_wt + $in['net_wt'],3);

        }
        // Blank Row Start
        $pdf->Cell(190,6,'',1,1,'C');
        // Blank Row End 
    }

    
    if($in_wagon_count >0)
    {
        // Code for printing Wagon based inward stock.
        foreach ($inward_wagon_result as $wg) 
        {
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(190,6,'Received From'.$wg["transport_mode"].' '.$commodity,1,1,'L');

            $pdf->Cell(100,6,'',1,0,'C');
            $pdf->Cell(30,6,round($wg['bags'],3),1,0,'C');
            $pdf->Cell(30,6,round($wg['gross_wt'],3),1,0,'C');
            $pdf->Cell(30,6,round($wg['net_wt'],3),1,1,'C');

            $tot_bags = round($tot_bags + $wg['bags'],3);
            $tot_gross_wt = round($tot_gross_wt + $wg['gross_wt'],3);
            $tot_net_wt = round($tot_net_wt + $wg['net_wt'],3);
        }
    }

    $pdf->Cell(80,6,'Total Stock',1,0,'L');
    $pdf->Cell(20,6,'',1,0,'C');
    $pdf->Cell(30,6,$tot_bags,1,0,'C');
    $pdf->Cell(30,6,$tot_gross_wt,1,0,'C');
    $pdf->Cell(30,6,$tot_net_wt,1,1,'C');


    $pdf->Cell(100,6,'Paraboiled Rejection Sale',1,0,'L');
    $pdf->Cell(30,6,'',1,0,'C');
    $pdf->Cell(30,6,'',1,0,'C');
    $pdf->Cell(30,6,'',1,1,'C');

    $pdf->Cell(80,6,'',1,0,'C');
    $pdf->Cell(20,6,'',1,0,'C');
    $pdf->Cell(30,6,'',1,0,'C');
    $pdf->Cell(30,6,'',1,0,'C');
    $pdf->Cell(30,6,'',1,1,'C');

    $pdf->Cell(80,6,'Balance',1,0,'L');
    $pdf->Cell(20,6,'',1,0,'C');
    $pdf->Cell(30,6,$tot_bags,1,0,'C');
    $pdf->Cell(30,6,$tot_gross_wt,1,0,'C');
    $pdf->Cell(30,6,$tot_net_wt,1,1,'C');

    //Incoming Finished

    //Outgoing Stock Details
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(130,20,'SUB :DELIVERY DETAILS OF BoILED RICE, BRoKEN & REJECTION',0,0);
    $pdf->Cell(59,5,'',0,0);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(189,10,'',0,1);

    $pdf->Cell(50,10,'',0,1);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(80,6,'Particulars',1,0,'C');
    $pdf->Cell(20,6,'',1,0,'C');
    $pdf->Cell(30,6,'Bags',1,0,'C');
    $pdf->Cell(30,6,'Gross Weight',1,0,'C');
    $pdf->Cell(30,6,'Net Weight',1,1,'C');

    $pdf->SetFont('Arial','',10);
    $pdf->Cell(80,6,'Opening Stock',1,0,'L');
    $pdf->Cell(20,6,'',1,0,'C');
    $pdf->Cell(30,6,'',1,0,'C');
    $pdf->Cell(30,6,'',1,0,'C');
    $pdf->Cell(30,6,'',1,1,'C');

    // Blank Row Start
    $pdf->Cell(190,6,'',1,1,'C');
    // Blank Row End 


    if($out_count >0)
    {
        $out_bags = 0;
        $out_gross_wt = 0;
        $out_net_wt =0;

        foreach ($outward_result as $og) 
        {
            $pdf->Cell(190,6,'DELIVERY OF '.$og['delivery'].' '.$commodity,1,1,'L');

            $pdf->Cell(100,6,'',1,0,'C');
            $pdf->Cell(30,6,round($og['bags'],3),1,0,'C');
            $pdf->Cell(30,6,round($og['gross_wt'],3),1,0,'C');
            $pdf->Cell(30,6,round($og['net_wt'],3),1,1,'C');

            $out_bags = round($out_bags+$og["bags"],3);
            $out_gross_wt = round($out_gross_wt+$og["gross_wt"],3);
            $out_net_wt = round($out_net_wt+$og["net_wt"],3);
        }
        // Blank Row Start
        $pdf->Cell(190,6,'',1,1,'C');
        // Blank Row End 
    }
    //Delivery Details
    $pdf->Cell(80,6,'Closing Stock',1,0,'L');
    $pdf->Cell(20,6,'',1,0,'C');
    if($tot_bags>0) 
    {
        $pdf->Cell(30,6,round(($tot_bags-$out_bags),3),1,0,'C');
    } 
    else
    {
        $pdf->Cell(30,6,round($out_bags,3),1,0,'C');
    }
    
    if($tot_gross_wt>0) 
    {
        $pdf->Cell(30,6,($tot_gross_wt-$out_gross),1,0,'C');
    } 
    else
    {
        $pdf->Cell(30,6,$out_gross,1,0,'C');
    }
  
    if($tot_net_wt>0) 
    {
        $pdf->Cell(30,6,($tot_net_wt-$out_net),1,1,'C');
    } 
    else
    {
        $pdf->Cell(30,6,$out_net,1,1,'C');
    }
  
$pdf->Output();
?>