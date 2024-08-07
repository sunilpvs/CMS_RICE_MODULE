<?php
//require_once($_SERVER['DOCUMENT_ROOT'] .'/class/DBController.php');
include_once('fpdf/fpdf.php'); 
include_once('index1.php'); 

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo.jpg',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(80,10,'Department List',1,0,'C');
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
        // Instanciation of inherited class
        $db = new dbObj();
        $connString =  $db->getConnstring();
        $display_heading = array('id'=>'id', 'name'=> 'name', 'code'=> 'code','status'=> 'status' , 'createdBy'=>'createdBy','created_datetime'=>'created_datetime','last_updated'=>'last_updated','last_updatedDatetime'=>'last_updatedDatetime');

        $result = mysqli_query($connString, "SELECT * FROM tbl_department") or die("database error:". mysqli_error($connString));
        $header = mysqli_query($connString, "SHOW columns FROM tbl_department");
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',12);

        foreach($header as $heading) {
        $pdf->Cell(50,12,$display_heading[$heading['Field']],1);
        }
        foreach($result as $row) {
        $pdf->Ln();
        foreach($row as $column)
        $pdf->Cell(50,12,$column,1);
        }
?>