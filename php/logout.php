<!DOCTYPE html>
<html lang="pt">
<body>
	hey
<?php

session_start();

if(isset($_SESSION['user_id']))
{
	unset($_SESSION['user_id']);

}

header("Location: ../login.html");
die;
?>
</body>
</html>