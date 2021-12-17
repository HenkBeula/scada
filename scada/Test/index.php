


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
<link href="../css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
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
    <link href="../css/dashboard.css" rel="stylesheet">
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
            <a class="nav-link" href="#">
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
       </button>
        </div>
      </div>

      <?Php
require "config.php";// Database connection

if($stmt = $connection->query("SELECT mes,quant_consumida FROM consumo_mensal")){

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

// Transfor PHP array to JavaScript two dimensional array 
echo "<script>
        var my_2d = ".json_encode($php_data_array)."
</script>";
?>

<div id="chart_div"></div>
<br><br>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
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
          hAxis: {title: 'Mes',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0},
		  width:1200,
		  height:600,isStacked:false
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
       }
	///////////////////////////////
////////////////////////////////////	
</script>
      <h2>Datalhes</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Mes</th>
              <th scope="col">Quantidade consumida</th>
              <th scope="col">Valor pago</th>
              <th scope="col">Numero do contador</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Janeiro</td>
              <td>random</td>
              <td>data</td>
              <td>placeholder</td>
            </tr>
            <tr>
              <td>Fevereiro</td>
              <td>placeholder</td>
              <td>irrelevant</td>
              <td>visual</td>
            </tr>
            <tr>
              <td>Marco</td>
              <td>data</td>
              <td>rich</td>
              <td>dashboard</td>
            </tr>
            <tr>
              <td>Abril</td>
              <td>text</td>
              <td>random</td>
              <td>layout</td>
            </tr>
            <tr>
              <td>Maio</td>
              <td>dashboard</td>
              <td>irrelevant</td>
              <td>text</td>
            </tr>
            <tr>
              <td>Junho</td>
              <td>dashboard</td>
              <td>illustrative</td>
              <td>rich</td>
            </tr>
            <tr>
              <td>Julho</td>
              <td>placeholder</td>
              <td>tabular</td>
              <td>information</td>
            </tr>
            <tr>
              <td>Agosto</td>
              <td>random</td>
              <td>data</td>
              <td>placeholder</td>
            </tr>
            <tr>
              <td>Setembro</td>
              <td>placeholder</td>
              <td>irrelevant</td>
              <td>visual</td>
            </tr>
            <tr>
              <td>Outubro</td>
              <td>data</td>
              <td>rich</td>
              <td>dashboard</td>
            </tr>
            <tr>
              <td>Novembro</td>
              <td>information</td>
              <td>placeholder</td>
              <td>illustrative</td>
            </tr>
            <tr>
              <td>Dezembro</td>
              <td>text</td>
              <td>placeholder</td>
              <td>layout</td>
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






