<?php
session_start();

	include("../php/connection.php");
	//include("functions.php");
	
  $sql ="SELECT quant_consumida FROM consumo_mensal ORDER BY mes";
  $result = mysqli_query($con,$sql);
  $chart_data="";
  while ($row = mysqli_fetch_array($result)) { 
    $quant_consumida[]  = $row['quant_consumida'];
	}
  //echo json_encode($quant_consumida);
  //criamos o arquivo 
  $arquivo = fopen('meuarquivo.txt','w');
  //verificamos se foi criado
  if ($arquivo == false)
    die('Não foi possível criar o arquivo.');
  //escrevemos no arquivo
  $string = implode(",", $quant_consumida)
  fwrite($arquivo, $quant_consumida); 
  //Fechamos o arquivo após escrever nele 
  fclose($arquivo);	 	
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>SCADA</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

    

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

    
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
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
      <a class="nav-link px-3" href="#" style="color: azure;">Sign out</a>
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
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.html">
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
          <!--<li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>-->
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Painel</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <!--<button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>-->
        </div>
      </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

      <h2>Datalhes</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Mes</th>
              <th scope="col">Quantidade consumida</th>
              <th scope="col">Valor pago</th>
              <th scope="col">Numero do contador</th>
              <!--<th scope="col">Header</th>-->
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
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <!--<script src="dashboard.js"></script>
    --><script>
      /* globals Chart:false, feather:false */

(function () {
  'use strict'
  feather.replace({ 'aria-hidden': 'true' })

  // Graphs
  var ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        'Janeiro',
        'Fevereiro',
        'Marco',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro',
      ],
      datasets: [{
        data:
        
      [1]
        ,
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      title:{
        display:true,
        text: 'Metros cubicos / Mes'
      },
      scales: {
        yAxes: [{
          ticks:{
            beginAtZero: true
          }
        }]
      },
      legend: {
        display: false,
      }
    }
  })
})()
    </script>
  </body>
</html>
