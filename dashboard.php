<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.88.1">
    <title>SCADA</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125em;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <!-- Custom styles-->
    <link href="css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow" style="background-color: #00488d !important;">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#" style="color: white; font-weight: bolder; font-size:large">SCADA</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          <a class="nav-link px-3" href="php/logout.php" style="color: azure;">Sign out</a>
        </div>
      </div>
    </header>

    <div class="container-fluid">
      <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="position-sticky pt-3">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">
                  <span data-feather="home"></span>
                  Estatisticas
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index_payment.html">
                  <span data-feather="file"></span>
                  Pagar agua
                </a>
              </li>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports</span>
              <a class="link-secondary" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="php/report.php" target="blank">
                  <span data-feather="file-text"></span>
                  Presente mês
                </a>
              </li>
            </ul>
          </div>
        </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Estatisticas</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
              <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
      </div>
    </div>

    <?Php
      require("php/session.php");
      require("php/session_timeout.php");
      require "php/config.php";

      //para retornar o id do utilizador
      function user_id($con){
        if(isset($_SESSION['user_id'])){
          $id = $_SESSION['user_id'];
          return $id;
        }
          return null;
      }
      $id=user_id($con);
      if($stmt = $connection->query("SELECT DISTINCT consumo_mensal.mes, consumo_mensal.quant_consumida FROM consumo_mensal,cliente WHERE $id LIKE consumo_mensal.user_id limit 12")){
        
      //echo "No of records : ".$stmt->num_rows."<br>";
      $php_data_array = Array(); // create PHP array


        while ($row = $stmt->fetch_row()) {
          $php_data_array[] = $row; // Adding to array
        }
      }else{
        echo $connection->error;
      }
      if($st = $connection->query("SELECT DISTINCT report.cash FROM report,consumo_mensal WHERE $id LIKE consumo_mensal.user_id limit 12")){
        $data_array = Array(); // create PHP array
          while ($rw = $st->fetch_row()) {
            $data_array[] = $rw; // Adding to array
          }
      }else{
          echo $connection->error;
      }
      if($sm = $connection->query("SELECT DISTINCT report.contador FROM report,consumo_mensal WHERE $id LIKE consumo_mensal.user_id limit 12")){
        $data_ar = Array(); // create PHP array
          while ($r = $sm->fetch_row()) {
            $data_ar[] = $r; // Adding to array
          }
      }else{
          echo $connection->error;
      }
      //Transfor PHP array to JavaScript two dimensional array 
      echo "<script>
        var my_ar = ".json_encode($data_ar)."
      </script>";
      //Transfor PHP array to JavaScript two dimensional array 
      echo "<script>
        var my_array = ".json_encode($data_array)."
      </script>";
      echo "<script>
        var my_2d = ".json_encode($php_data_array)."
      </script>";
    ?>

    <div id="chart_div"></div>
    <br><br>
  <div class="chart">
    <script type="text/javascript" src="js/loader.js"></script>
    <script type="text/javascript" >
          google.charts.load('current', {packages: ['corechart', 'bar']});
          google.charts.setOnLoadCallback(drawChart);
          
          function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'mes');
            data.addColumn('number', 'Consumo');
            for(i = 0; i < my_2d.length; i++)
        data.addRow([my_2d[i][0], parseInt(my_2d[i][1])]);
          var options = {
              title: 'Consumo mensal',
              hAxis: {title: '',  titleTextStyle: {color: '#333'}},
              vAxis: {minValue: 0},
          width:1100,
          height:600,isStacked:false
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
          }
    </script>
  </div>
      <h2>Detalhes</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Mes</th>
              <th scope="col">Quantidade consumida (em m<sup>3</sup> )</th>
              <th scope="col">Valor pago (MZN)</th>
              <th scope="col">Numero do contador</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Janeiro</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[0][1],1))</script></td>
              <td><script type="text/javascript" >document.write(Math.round(my_array[1],1))</script> MT</td>
              <td><script type="text/javascript" >document.write(Math.round(my_ar[1],1))</script></td>
            </tr>
            <tr>
              <td>Fevereiro</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[1][1],1))</script></td>
              <td><script type="text/javascript" >document.write(Math.round(my_array[2],1))</script> MT</td>
              <td><script type="text/javascript" >document.write(Math.round(my_ar[2],1))</script></td>
            </tr>
            <tr>
              <td>Marco</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[2][1],1))</script></td>
              <td><script type="text/javascript" >document.write(Math.round(my_array[3],1))</script> MT</td>
              <td><script type="text/javascript" >document.write(Math.round(my_ar[3],1))</script></td>
            </tr>
            <tr>
              <td>Abril</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[3][1],1))</script></td>
              <td><script type="text/javascript" >document.write(Math.round(my_array[4],1))</script> MT</td>
              <td><script type="text/javascript" >document.write(Math.round(my_ar[4],1))</script></td>
            </tr>
            <tr>
              <td>Maio</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[4][1],1))</script></td>
              <td><script type="text/javascript" >document.write(Math.round(my_array[5],1))</script> MT</td>
              <td><script type="text/javascript" >document.write(Math.round(my_ar[5],1))</script></td>
            </tr>
            <tr>
              <td>Junho</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[5][1],1))</script></td>
              <td><script type="text/javascript" >document.write(Math.round(my_array[6],1))</script> MT</td>
              <td><script type="text/javascript" >document.write(Math.round(my_ar[6],1))</script></td>
            </tr>
            <tr>
              <td>Julho</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[6][1],1))</script></td>
              <td><script type="text/javascript" >document.write(Math.round(my_array[7],1))</script> MT</td>
              <td><script type="text/javascript" >document.write(Math.round(my_ar[7],1))</script></td>
            </tr>
            <tr>
              <td>Agosto</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[7][1],1))</script></td>
              <td><script type="text/javascript" >document.write(Math.round(my_array[8],1))</script> MT</td>
              <td><script type="text/javascript" >document.write(Math.round(my_ar[8],1))</script></td>
            </tr>
            <tr>
              <td>Setembro</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[8][1],1))</script></td>
              <td><script type="text/javascript" >document.write(Math.round(my_array[9],1))</script> MT</td>
              <td><script type="text/javascript" >document.write(Math.round(my_ar[9],1))</script></td>
            </tr>
            <tr>
              <td>Outubro</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[9][1],1))</script></td>
              <td><script type="text/javascript" >document.write(Math.round(my_array[10],1))</script> MT</td>
              <td><script type="text/javascript" >document.write(Math.round(my_ar[10],1))</script></td>
            </tr>
            <tr>
              <td>Novembro</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[10][1],1))</script></td>
              <td><script type="text/javascript" >document.write(Math.round(my_array[11],1))</script> MT</td>
              <td><script type="text/javascript" >document.write(Math.round(my_ar[11],1))</script></td>
            </tr>
            <tr>
              <td>Dezembro</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[11][1],1))</script></td>
              <td><script type="text/javascript" >document.write(Math.round(my_array[12],1))</script> MT</td>
              <td><script type="text/javascript" >document.write(Math.round(my_ar[12],1))</script></td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  <script src="js/dashboard.js"></script>
  </body>
</html>






