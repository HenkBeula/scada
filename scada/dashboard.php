<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
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
                  Current month
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
      require "php/config.php";// Database connection
      if($stmt = $connection->query("SELECT mes,quant_consumida FROM consumo_mensal limit 12")){

      //echo "No of records : ".$stmt->num_rows."<br>";
      $php_data_array = Array(); // create PHP array


        while ($row = $stmt->fetch_row()) {
          $php_data_array[] = $row; // Adding to array
        }
      }else{
        echo $connection->error;
      }
      //print_r( $php_data_array);
      // You can display the json_encode output here. 
      //echo json_encode($php_data_array); 

      //Transfor PHP array to JavaScript two dimensional array 
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
      <h2>Datalhes</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Mes</th>
              <th scope="col">Quantidade consumida (em m3)</th>
              <th scope="col">Valor pago (em MT)</th>
              <th scope="col">Numero do contador</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Janeiro</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[0][1],1))</script></td>
              <td>100</td>
              <td>11243123</td>
            </tr>
            <tr>
              <td>Fevereiro</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[1][1],1))</script></td>
              <td>320</td>
              <td>11123123</td>
            </tr>
            <tr>
              <td>Marco</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[2][1],1))</script></td>
              <td>520</td>
              <td>11123123</td>
            </tr>
            <tr>
              <td>Abril</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[3][1],1))</script></td>
              <td>210</td>
              <td>11123123</td>
            </tr>
            <tr>
              <td>Maio</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[4][1],1))</script></td>
              <td>600</td>
              <td>11123123</td>
            </tr>
            <tr>
              <td>Junho</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[5][1],1))</script></td>
              <td>150</td>
              <td>11231231</td>
            </tr>
            <tr>
              <td>Julho</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[6][1],1))</script></td>
              <td>780</td>
              <td>11231231</td>
            </tr>
            <tr>
              <td>Agosto</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[7][1],1))</script></td>
              <td>156</td>
              <td>11231231</td>
            </tr>
            <tr>
              <td>Setembro</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[8][1],1))</script></td>
              <td>560</td>
              <td>11123123</td>
            </tr>
            <tr>
              <td>Outubro</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[9][1],1))</script></td>
              <td>260</td>
              <td>11231231</td>
            </tr>
            <tr>
              <td>Novembro</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[10][1],1))</script></td>
              <td>600</td>
              <td>11231231</td>
            </tr>
            <tr>
              <td>Dezembro</td>
              <td><script type="text/javascript" >document.write(Math.round(my_2d[11][1],1))</script></td>
              <td>260</td>
              <td>11231231</td>
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






