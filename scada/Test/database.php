<?php
require('../fpdf184/fpdf.php');
include('../php/database.php');
$database = new Database();


class PDF extends FPDF {
	function Header(){
		$this->SetFont('Arial','B',15);
		
		//dummy cell to put logo
		//$this->Cell(12,0,'',0,0);
		//is equivalent to:
		$this->Cell(12);
		
		//put logo
		$this->Image('../images/scada.png',10,10,10);
		
		$this->Cell(100,10,'Client List',0,1);
		
		//dummy cell to give line spacing
		//$this->Cell(0,5,'',0,1);
		//is equivalent to:
		$this->Ln(5);
		
		$this->SetFont('Arial','B',11);
		
		$this->SetFillColor(180,180,255);
		$this->SetDrawColor(180,180,255);
		$this->Cell(40,5,'Mes',1,0,'',true);
		$this->Cell(25,5,'Quantidade consumida',1,0,'',true);
		$this->Cell(65,5,'Valor pago',1,0,'',true);
		$this->Cell(60,5,'Numero do conador',1,1,'',true);
		$this->Cell(60,5,'Ano',1,1,'',true);
		
	}
	function Footer(){
		//add table's bottom line
		$this->Cell(190,0,'','T',1,'',true);
		
		//Go to 1.5 cm from bottom
		$this->SetY(-15);
				
		$this->SetFont('Arial','',8);
		
		//width = 0 means the cell is extended up to the right margin
		$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
	}
}


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new PDF('P','mm','A4'); //use new class

//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');

$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage();

$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(180,180,255);

//$query=mysqli_query($con,"select * from clients");
$result = $database->runQuery("SELECT * FROM `casa`");
$header = $database->runQuery("SELECT * FROM `casa`");
while($data=mysqli_fetch_array($query)){
	$pdf->Cell(40,5,$data['name'],'LR',0);
	$pdf->Cell(25,5,$data['phone'],'LR',0);
	
	if($pdf->GetStringWidth($data['email']) > 65){
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(65,5,$data['email'],'LR',0);
		$pdf->SetFont('Arial','',9);
	}else{
		$pdf->Cell(65,5,$data['email'],'LR',0);
	}
	$pdf->Cell(60,5,$data['address'],'LR',1);
}
$pdf->Output();
?>
