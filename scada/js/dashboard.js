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
        data: [
          1,
          2,
          0.5,
          1,
          1.2,
          0.8,
          0.7,
          1.5,
          0.8,
          2.1,
          1,
          2.8
        ],
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
