<?php
session_start();

	include("../php/connection.php");
	include("functions.php");
	
         $sql ="SELECT quant_consumida FROM consumo_mensal ORDER BY mes";
         $result = mysqli_query($con,$sql);
         $chart_data="";
         while ($row = mysqli_fetch_array($result)) { 
 
            $data[]  = $row['quant_consumida']  ;
		 }
		 echo json_encode($data);	
?>