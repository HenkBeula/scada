<?php
include('database.php');
$database = new Database();
$result = $database->runQuery("SELECT * FROM `cliente`, consumo_mensal");
$header = $database->runQuery("SELECT * FROM `cliente`, consumo_mensal");

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

<?php
//include pdf_mc_table.php, not fpdf17/fpdf.php
include('pdf_mc_table.php');

//make new object
$pdf = new PDF_MC_Table();

//add page, set font
$pdf->AddPage();
$pdf->SetFont('Arial','',14);

//set width for each column (6 columns)
$pdf->SetWidths(Array(20,40,40,30,20,40));

//set alignment
//$pdf->SetAligns(Array('','R','C','','',''));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);

//load json data
$json = file_get_contents('MOCK_DATA.json');
$data = json_decode($json,true);

//add table heading using standard cells
//set font to bold
$pdf->SetFont('Arial','B',14);
$pdf->Cell(20,5,"ID",1,0);
$pdf->Cell(40,5,"First Name",1,0);
$pdf->Cell(40,5,"Last Name",1,0);
$pdf->Cell(30,5,"Email",1,0);
$pdf->Cell(20,5,"Gender",1,0);
$pdf->Cell(40,5,"Address",1,0);

$pdf->Ln();

//reset font
$pdf->SetFont('Arial','',14);
//loop the data
foreach($data as $item){
	//write data using Row() method containing array of values.
	$pdf->Row(Array(
		$item['id'],
		$item['first_name'],
		$item['last_name'],
		$item['email'],
		$item['gender'],
		$item['address'],
	));
	
}

//output the pdf
$pdf->Output();
?>