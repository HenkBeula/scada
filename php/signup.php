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
		$username = $_POST['username'];
		$address = $_POST['address'];
		$contact = $_POST['contact'];
		$password = $_POST['password'];
		$contador = $_POST['contador'];
		$tipoContador = $_POST['tipoContador'];

		if(!empty($username) && !empty($password) && is_numeric($contact) && !empty($contact) && !empty($address))
		{

			//save to database
			$user_id = random_num(5);
			$query = "insert into cliente (user_id,Nome,cliente_login,cliente_pass) values ('$user_id','$username','$contact',MD5('$password'))";

			mysqli_query($con, $query);
			
			$casa_id = random_num(10);
			$query = "insert into casa (id,Bairro,idCliente) values ('$casa_id','$address','$user_id')";

			mysqli_query($con, $query);

			$query = "insert into contador (id,idCasa,tipo) values ('$contador','$casa_id','$tipoContador')";
			mysqli_query($con, $query);

			header("Location: ../login.html");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>
</body>
</html>