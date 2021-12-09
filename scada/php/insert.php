<!DOCTYPE html>
<html lang="pt">
<body>
<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
        $prov = $_POST['provedor'];
        $provedor=1;
        if($prov=="1"){
            $provedor=1;
        }else if($prov=="2"){
            $provedor=2;
        }else if($prov=="3"){
            $provedor=3;
        }
        $cash =$_POST['cash'];
		$contador = $_POST['counter'];
		$pay = $_POST['payment'];
		$consumo = $_POST['consumed_water'];
		$contacto = $_POST['contacto'];
		$id_user=user_id($con);

		if(!empty($provedor) && !empty($contador) && !empty($pay) && !empty($consumo) && !empty($contacto) && !empty($cash))
		{
			//save to database
			$id = random_num(15);
			$query = "insert into report (id,provedor,contador,pagamento,consumo,cash,contacto) values ('$id','$provedor','$contador','$pay','$consumo','$cash','$contacto')";
			$cur_month = date('M');
			mysqli_query($con, $query);

			$query = "INSERT INTO consumo_mensal (consumo_mensal.mes,consumo_mensal.quant_consumida,consumo_mensal.user_id) VALUES ('$cur_month','$consumo','$id_user')";

			mysqli_query($con, $query);

			header("Location: ../pos_payment.html");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}

	function user_id($con){
        if(isset($_SESSION['user_id'])){
          $id = $_SESSION['user_id'];
          return $id;
        }
          return null;
      }
?>
</body>
</html>