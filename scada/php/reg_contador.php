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
		$contador = $_POST['counter'];

		if(!empty($contador))
		{
			//save to database
			$query = "insert into conrtador (id) values ('$contador')";

			mysqli_query($con, $query);

			header("Location: ../pos_payment.html");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>
</body>
</html>