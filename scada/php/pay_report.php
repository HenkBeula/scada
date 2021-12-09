<?php
include('database.php');
$database = new Database();
$result = $database->runQuery("SELECT * FROM `casa`");
$header = $database->runQuery("SELECT * FROM `casa`");

require('../fpdf184/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

foreach($header as $heading) {
	foreach($heading as $column_heading)
		$pdf->Cell(95,12,$column_heading,1);
}
foreach($result as $row) {
	$pdf->Ln();
	foreach($row as $column)
		$pdf->Cell(95,12,$column,1);
}
$pdf->Output();
?>
