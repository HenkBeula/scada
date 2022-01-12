<?Php
      require "config.php";// Database connectio
	  include "functions.php";
	  $contacto = $user_data["cliente_login"];
	  $user_id = $user_data["user_id"];
      if($stmt = $connection->query("SELECT casa.id FROM cliente,casa WHERE idCliente LIKE $user_id limit 1")){
		  echo $stmt;
      //echo "No of records : ".$stmt->num_rows."<br>";
      $php_data_array = Array(); // create PHP array
	  return $stmt;
      }else{
        echo $connection->error;
      }
?>