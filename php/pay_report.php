<?php
	require("session.php");
	require("config.php");
	include('database.php');
	function user_id($con){//returns user_id
		if(isset($_SESSION['user_id'])){
			$id = $_SESSION['user_id'];
			return $id;
		}
		return null;
	}

	function user_tel($con){//returns user_login(phone number)
		if(isset($_SESSION['cliente_login'])){
			$tel = $_SESSION['cliente_login'];
			return $tel;
		}
		return null;
	}

	$tel=user_tel($con);
	$id=user_id($con);
	$database = new Database();
	$result = $database->runQuery("SELECT DISTINCT cliente.cliente_login, report.pagamento, cliente.cliente_email, report.consumo, report.cash,report.id FROM report, cliente where 876983630 like cliente.cliente_login AND (select cliente.cliente_login from cliente where 466946 like cliente.user_id)  ORDER BY latest DESC limit 1
	");
	//$header = $database->runQuery("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME IN('contacto', 'pagamento','consumo','cash', id) AND TABLE_SCHEMA = 'scada' AND TABLE_NAME = 'report'");
	//$header = $database->runQuery("SELECT * FROM `casa`");

	require('../fpdf184/fpdf.php');
	$pdf = new FPDF();
	$pdf->AddPage($orientation='',$size='A3');
	$pdf->Image('../images/scada.png',10,2,50);
	$pdf->SetFont('Arial','B',12); 
	$pdf->Cell(115,15,"","",0,1);
	$pdf->Cell(20,20,"Impresso aos: ". date("d-m-Y h:i:sa"),0,1);
	$pdf->SetFont('Arial','B',16);
	$descrip = array("Contacot", "Metodo de pagamento", "Email", 'Consumo', 'valor pago', 'referencia');

	$pdf->Cell(60,80,"","",0,1);
	$pdf->Cell(20,20,"Eu",0);
	$pdf->SetFont('Arial','',16);
	foreach($result as $row) {
		$pdf->Ln();
		foreach($row as $column){
			$pdf->Cell(180,15,"e","",0,1);
			$pdf->Cell(48,22,$column,0,1);
		}
	}
	$pdf->Cell(60,30,"",0,1);
	$pdf->Cell(60,30,"Tel: (+258) 21 111 222 \n   Fax: (+258) 21 333 444",0,1);

	$pdf->Output();
?>