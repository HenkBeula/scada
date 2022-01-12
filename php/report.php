<?php
	require("session.php");
	include('database.php');
	function user_id($con){//returns user_id
		if(isset($_SESSION['user_id'])){
			$id = $_SESSION['user_id'];
			return $id;
		}
		return null;
	}

	//put logo
	//$this->cell(12);
	//

	$id=user_id($con);
	$database = new Database();
	$result = $database->runQuery("SELECT DISTINCT consumo_mensal.mes, consumo_mensal.quant_consumida, YEAR(consumo_mensal.ano) FROM consumo_mensal where $id like user_id");
	$header = $database->runQuery("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME IN('mes', 'quant_consumida','ano') AND TABLE_SCHEMA = 'scada' AND TABLE_NAME = 'consumo_mensal'");

	date_default_timezone_set("Africa/Harare");
	require('../fpdf184/fpdf.php');
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->Image('../images/scada.png',10,2,50);
	$pdf->SetFont('Arial','B',12); 
	$pdf->Cell(115,15,"","",0,1);
	$pdf->Cell(20,20,"Impresso aos: ". date("d.m.Y h:i:sa"),0,1);
	$pdf->SetFont('Arial','',15);
	
	$pdf->Cell(60,25,"Av. Scada, nr 1111 R/C Maputo - Mocambique P.O. Box 007 ",0,1);
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(60,12,"Mes",1);
	$pdf->Cell(60,12,"Concumo ( em m3)",1);
	$pdf->Cell(60,12,"Ano",1);
	$pdf->SetFont('Arial','',13);
	foreach($result as $row) {
		$pdf->Ln();
		foreach($row as $column)
			$pdf->Cell(60,12,$column,1);

	}
	$pdf->Cell(60,30,"",0,1);
	$pdf->Cell(60,30,"Tel: (+258) 21 111 222 \n   Fax: (+258) 21 333 444",0,1);

	$pdf->Output();
?>