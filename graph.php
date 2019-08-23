<?php include 'config.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>CHARTS & GRAPH</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



	<script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js"></script>
	<script type = "text/javascript">
		google.charts.load('current', {packages: ['corechart','bar','line']});      
	</script>
	<style type="text/css">
		chart {
			width: 100%; 
			min-height: 450px;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<h2 align="center" style="font-family: sans-serif;">STUDENT TEST ANALYSIS REPORT</h2>
		<?php
		echo "
		<table class='table table-responsive'>
		<thead class='table-info'>
		<tr>
		<td>S.No</td>
		<td>Test Name</td>
		<td>Test type</td>
		<td>Maximum Marks</td>
		<td>Physics</td>
		<td>Chemistry</td>
		<td>Maths</td>
		<td>Total</td>
		<td>Correct Attempt</td>
		<td>Incorrect Attempt</td>
		<td>Not Attempt</td>
		<td>Average</td>
		<td>Maximum</td>
		<td>Percentile</td>
		<td>Students Appeared</td>
		</tr>
		</thead>
		<tbody>
		";



		$query = "SELECT * from test WHERE 1";

		$exec = mysqli_query($db,$query);
		while($row = mysqli_fetch_array($exec)){
			echo "
			<tr>
			<td>".$row['sno']."</td>
			<td>".$row['test_name']."</td>
			<td>".$row['test_type']."</td>
			<td>".$row['mm']."</td>
			<td>".$row['physics']."</td>
			<td>".$row['chemistry']."</td>
			<td>".$row['maths']."</td>
			<td>".$row['total']."</td>
			<td>".$row['CA']."</td>
			<td>".$row['IA']."</td>
			<td>".$row['NA']."</td>
			<td>".$row['average']."</td>
			<td>".$row['maximum']."</td>
			<td>".$row['percentile']."</td>
			<td>".$row['total_students']."</td>
			</tr>
			";

		}

		?>
		<div class="row">
			<div class="col-md-6">
				<div id = "graph" class="chart">
				</div>
			</div>
			<div class="col-md-6">
				<div id = "graph2" class="chart"></div>
			</div>
		</div>
		<div id = "container2" class="chart">
			
		</div>
		<script language = "JavaScript">
			function drawChart() {
            // Define the chart to be drawn.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Attempt');
            data.addColumn('number', 'Percentage');
            data.addRows([
            	// ['Correct Attempt',10],
            	// ['Incorrect Attempt',15],
            	// ['Not Attempt',25]
            	<?php
            	$query = "SELECT * from test WHERE sno=2";

            	$exec = mysqli_query($db,$query);
            	while($row = mysqli_fetch_array($exec)){

            		echo "['Correct Attempt',".$row['CA']."],";
            		echo "['InCorrect Attempt',".$row['IA']."],";
            		echo "['Not Attempt',".$row['NA']."]";
            	}

            	?>
            	]);

            // Set chart options
            var options = {
            	'legend':'left',
            	'title':'Test 2 Analysis Report',
            	'titlePosition':'bottom',
            	// 'width':550,
            	// 'height':400,
            	is3D:true};

            // Instantiate and draw the chart.
            var chart = new google.visualization.PieChart(document.getElementById ('graph'));
            chart.draw(data, options);
        }
        google.charts.setOnLoadCallback(drawChart);
    </script>
    <script language = "JavaScript">
    	function drawChart2() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
            	['TEST NAME','You','Average', 'Maximum'],
            	<?php

            	$query = "SELECT * from test WHERE 1";

            	$exec = mysqli_query($db,$query);
            	$temp=0;
            	while($row = mysqli_fetch_array($exec)){
            		if($temp!=0){echo ",";}
            		echo "['".$row['test_name']."',".$row['total'].",".$row['average'].",".$row['maximum']."]";
            		$temp++;
            	}

            	?>
            	]);

            var options = {
            	chart: {
            		title: 'Test Performance Report',
            		subtitle: 'Report of August Test',
            	},
            	bars: 'vertical'};  

            // Instantiate and draw the chart.
            var chart = new google.charts.Bar(document.getElementById('graph2'));
            chart.draw(data, options);
        }
        google.charts.setOnLoadCallback(drawChart2);
    </script>
    <script language = "JavaScript">
    	function drawChart3() {
            // Define the chart to be drawn.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Test');
            data.addColumn('number', 'MAX');
            data.addColumn('number', 'YOU');
            data.addColumn('number', 'AVERAGE');
            data.addRows([
            	<?php
            	$query = "SELECT * from test WHERE 1";

            	$exec = mysqli_query($db,$query);
            	$temp=0;
            	while($row = mysqli_fetch_array($exec)){
            		if($temp!=0){echo ",";}
            		echo "['".$row['test_name']."',".$row['maximum'].",".$row['total'].",".$row['average']."]";
            		$temp++;
            	}

            	?>
            	]);

            // Set chart options
            var options = {'title' : 'TEST REPORT GRAPHICAL',

            hAxis: {
            	title: 'TEST'
            },
            vAxis: {
            	title: 'MARKS'
            },   
            // 'width':550,
            // 'height':400,
            pointsVisible: true    
        };

            // Instantiate and draw the chart.
            var chart = new google.visualization.LineChart(document.getElementById('container2'));
            chart.draw(data, options);
        }
        google.charts.setOnLoadCallback(drawChart3);
    </script>
</body>
</html>