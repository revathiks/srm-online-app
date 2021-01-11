<style>
canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
</style>
<div class="container">
    <div style="width:75%;">
    		<canvas id="canvas"></canvas>
    </div>
</div>
<?php

$resultData=array(
   'A2304' => array( 'name'=>'Revathi S','leads'=>2000,'applications'=>6000),
   'A2305' => array( 'name'=>'Durga M','leads'=>2500,'applications'=>5000),
   'A2306' => array( 'name'=>'Maya K','leads'=>4000,'applications'=>3000),
   'A2307' => array( 'name'=>'Raja N','leads'=>5000,'applications'=>7000),
   'A2308' => array( 'name'=>'Shalukumari S','leads'=>4000,'applications'=>10000),
);
$label=$leaddata=$appdata=array();
if(!empty($resultData)){
    foreach ($resultData as $result){
       $label[]=$result['name'];              
       $leaddata[]=$result['leads'];
       $appdata[]=$result['applications'];
    }
}
$labelResult=json_encode($label);
$leadDataResult=json_encode($leaddata);
$appDataResult=json_encode($appdata);
?>
<script>
		var color = Chart.helpers.color;
		var barChartData = {
			labels: <?php echo $labelResult;?>,
			datasets: [{
				label: 'Leads',
				backgroundColor: '#23c7d8',
				borderColor: '#23c7d8',
				borderWidth: 1,
				data: <?php echo $leadDataResult;?>
			}, {
				label: 'Applications',
				backgroundColor: '#FFD454',
				borderColor: '#FFD454',
				borderWidth: 1,
				data: <?php echo $appDataResult;?>
			}]

		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: false,
						text: 'Chart.js Bar Chart'
					},
					scales: {
			            yAxes: [{
			                ticks: {
			                    beginAtZero: true
			                }
			            }]
			        }
				},
				plugins: {
			          
		            afterDatasetsDraw: function (context, easing) {
		              var ctx = context.chart.ctx;
		              context.data.datasets.forEach(function (dataset) {
		                for (var i = 0; i < dataset.data.length; i++) {
		                  if (dataset.data[i] != 0) {
		                    var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model;
		                    var textY = model.y + (dataset.type == "line" ? -3 : 15);

		                    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, 'normal', Chart.defaults.global.defaultFontFamily);
		                    ctx.textAlign = 'start';
		                    ctx.textBaseline = 'middle';
		                    ctx.fillStyle = dataset.type == "line" ? "black" : "black";
		                    ctx.save();
		                    ctx.translate(model.x, textY-15);
		                    ctx.rotate(4.7);
		                    ctx.fillText(dataset.data[i], 0, 0);
		                    ctx.restore();
		                  }
		                }
		              });
		            }
		          
		        }
			});

		};
		var colorNames = Object.keys(window.chartColors);

	</script>