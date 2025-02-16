<?php
require('./fpdf/fpdf.php');
require_once($_SERVER['DOCUMENT_ROOT'] ."/reports/reports.php");
  $in_count=mysqli_num_rows($inward_result);
    $out_count=mysqli_num_rows($outward_result);
    
    if($in_count > 0 || $out_count > 0)
    { 
        $inward_row = mysqli_fetch_array($inward_result, MYSQLI_ASSOC);
        $outward_row = mysqli_fetch_array($outward_result, MYSQLI_ASSOC);
    }
    else
    {
        header("location: ../../daily_customer_stock-rpt");
        exit;
    }


    $currentDateTime = new DateTime('now'); 
    $currentDate = $currentDateTime->format('d-M-Y'); 
    $in_bags = 0;
    $in_gross_wt = 0;
    $in_net_wt = 0;
    $out_bags = 0;
    $out_gross_wt = 0;
    $out_net_wt = 0;

    $in_commodity="";
    $in_delivery = "";
    $in_date="";
    $out_commodity="";
    $out_delivery = "";
    $out_date="";

    if($in_count >0)
    {
        $in_commodity= $inward_row["commodity"];
        $in_delivery = $inward_row["transport_mode"];
        $in_date=$inward_row["received_date"];
        $in_bags = $inward_row["bags"];
        $in_gross_wt = $inward_row["gross_wt"];
        $in_net_wt = $inward_row["net_wt"];
    }

    if($out_count >0)
    {
        $out_commodity=$outward_row["commodity"];
        $out_delivery = $outward_row["delivery"];
        $out_date=$outward_row["outward_date"];
        $out_bags = $outward_row["bags"];
        $out_gross_wt = $outward_row["gross_wt"];
        $out_net_wt = $outward_row["net_wt"];
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
$pdf->Cell(71,20,'WET',0,0);
$pdf->Cell(59,20,'',0,0);
$pdf->Cell(59,20,'Detalis',0,1);


$pdf->SetFont('Arial','',10);
$pdf->Cell(130,-10,'Near Dev',0,0);
$pdf->Cell(25,-10,'Customer ID',0,0);
$pdf->Cell(34,-10,'0012',0,1);

$pdf->SetFont('Arial','',10);
$pdf->Cell(130,20,'City, 751001',0,0);
$pdf->Cell(25,20,'Invoice Date',0,0);
$pdf->Cell(34,20,'28-01-2025',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(130,20,'ARRIVAL OF SORTEX BOILED RICE CARNAVAL ORANGE 5OKGS',0,0);
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
$pdf->Cell(80,6,'Opening Stock',1,0,'C');
$pdf->Cell(20,6,'',1,0,'C');
$pdf->Cell(30,6,'Bags',1,0,'C');
$pdf->Cell(30,6,'Gross Weight',1,0,'C');
$pdf->Cell(30,6,'Net Weight',1,1,'C');


$pdf->Cell(100,6,'Received From',1,0,'C');
$pdf->Cell(30,6,'Bags',1,0,'C');
$pdf->Cell(30,6,'Gross Weight',1,0,'C');
$pdf->Cell(30,6,'Net Weight',1,1,'C');


$pdf->Cell(100,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,1,'C');


$pdf->Cell(80,6,'Total Stock',1,0,'C');
$pdf->Cell(20,6,'',1,0,'C');
$pdf->Cell(30,6,'Bags',1,0,'C');
$pdf->Cell(30,6,'Gross Weight',1,0,'C');
$pdf->Cell(30,6,'Net Weight',1,1,'C');


$pdf->Cell(80,6,'',1,0,'C');
$pdf->Cell(20,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,1,'C');


$pdf->Cell(100,6,'Paraboiled Rejection Sale',1,0,'C');
$pdf->Cell(30,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,1,'C');


$pdf->Cell(80,6,'',1,0,'C');
$pdf->Cell(20,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,1,'C');


$pdf->Cell(80,6,'Balance',1,0,'C');
$pdf->Cell(20,6,'',1,0,'C');
$pdf->Cell(30,6,'Bags',1,0,'C');
$pdf->Cell(30,6,'Gross Weight',1,0,'C');
$pdf->Cell(30,6,'Net Weight',1,1,'C');


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
$pdf->Cell(80,6,'Opening Stock',1,0,'C');
$pdf->Cell(20,6,'',1,0,'C');
$pdf->Cell(30,6,'Bags',1,0,'C');
$pdf->Cell(30,6,'Gross Weight',1,0,'C');
$pdf->Cell(30,6,'Net Weight',1,1,'C');

$pdf->Cell(100,6,'Received From',1,0,'C');
$pdf->Cell(30,6,'Bags',1,0,'C');
$pdf->Cell(30,6,'Gross Weight',1,0,'C');
$pdf->Cell(30,6,'Net Weight',1,1,'C');

$pdf->Cell(100,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,1,'C');

$pdf->Cell(80,6,'',1,0,'C');
$pdf->Cell(20,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,0,'C');
$pdf->Cell(30,6,'',1,1,'C');


$pdf->Cell(80,6,'Closing Stock',1,0,'C');
$pdf->Cell(20,6,'',1,0,'C');
$pdf->Cell(30,6,'Bags',1,0,'C');
$pdf->Cell(30,6,'Gross Weight',1,0,'C');
$pdf->Cell(30,6,'Net Weight',1,1,'C');


$pdf->Output();
?>