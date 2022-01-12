<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$contact = $_POST['contact'];
		$passwords = $_POST['password'];

		if(!empty($contact) && !empty($passwords) && is_numeric($contact))
		{

			//read from database
			$query = "select * from cliente where cliente_login = '$contact' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['cliente_pass'] == MD5($passwords))
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: ../dashboard.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>