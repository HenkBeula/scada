<?Php
      require "php/config.php";
      require ("connection.php");
      //para retornar o id do utilizador
      function user_id($con){
        if(isset($_SESSION['user_id'])){
          $id = $_SESSION['user_id'];
          return $id;
        }
          return null;
      }
      $id=user_id($con);
      if($stmt = $connection->query("select * from `report` where `id` like $id order by `latest` desc limit 1")){

      $php_data_array = Array(); // create PHP array


        while ($row = $stmt->fetch_row()) {
          $php_data_array[] = $row; // Adding to array
        }
      }else{
        echo $connection->error;
      }

      //Transfor PHP array to JavaScript two dimensional array 
     /* echo "<script>
        var my_2d = ".json_encode($php_data_array)."
      </script>";*/
?>