<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>plus2net.com : Column chart using data from CSV file </title>
</head>
<body >
<?Php
$f_pointer=fopen("chart_data_column.csv","r"); // file pointer
$php_data_array = Array(); // create PHP array
while(! feof($f_pointer)){
$ar=fgetcsv($f_pointer);
//echo print_r($ar); // print the array 
$php_data_array[] = $ar; // Adding to array
}
print_r($php_data_array);
echo "<script>
var my_2d=".json_encode($php_data_array)."
</script>";

?>
<div id='chart_div'></div>
<script type="text/javascript"
  src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current',{packages:['corechart','bar']});
google.charts.setOnLoadCallback(draw_my_chart)
function draw_my_chart(){
var data=new google.visualization.DataTable();
data.addColumn('string','Month');
data.addColumn('number','Sale');
data.addColumn('number','Profit');
for(i=0;i<my_2d.length;i++)
data.addRow([my_2d[i][0],parseInt(my_2d[i][1]),parseInt(my_2d[i][2])]);
var options = {
   title: 'plus2net.com Sale Profit',
   hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
   vAxis: {minValue: 0},
height:400,
width:880,
isStacked:false,
legend:{position:'top'},
  animation:{
	   'startup':true,
        duration: 1000,
        easing: 'out',
      },
};
var chart= new  google.visualization.BarChart(document.getElementById('chart_div'));
chart.draw(data,options)
}
</script>












</body></html>
