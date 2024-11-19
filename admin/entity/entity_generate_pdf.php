<?php
require_once($_SERVER['DOCUMENT_ROOT'] .'/includes/DBController.php');
include_once('fpdf/fpdf.php'); 
include_once('index1.php'); 

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo.jpg',10,6,30);
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(80,10,'Entity List',1,0,'C');
    // Line break
    $this->Ln(20);
}
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$db = new dbObj();
$connString =  $db->getConnstring();
$display_heading = array('id'=>'id', 'entity_name'=> 'entity_name', 'cin'=> 'cin','incorp_date'=> 'incorp_date','city'=> 'city','state'=> 'state','status'=> 'status');
$result = mysqli_query($connString, "SELECT id, entity_name, cin, incorp_date,city,state,status FROM vw_entity") or die("database error:". mysqli_error($connString));
$header = mysqli_query($connString, "SHOW columns FROM vw_entity");
$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',8);
foreach($header as $heading) {
$pdf->Cell(27,12,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
    $pdf->SetFont('Arial','B',8);
    $pdf->Ln();
foreach($row as $column)

$pdf->Cell(27,12,$column,1);
}
$pdf->Output();
?>

