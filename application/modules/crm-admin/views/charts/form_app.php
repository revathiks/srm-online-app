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
$label1=array('10 march 2020','11 march 2020','12 march 2020','13 march 2020','14 march 2020','15 march 2020','16 march 2020');
$formVsApp=array(
   0 => array( 'date'=>'05-09-2019','applications'=>100),
   1 => array( 'date'=>'06-09-2019','applications'=>300),
   2 => array( 'date'=>'07-09-2019','applications'=>150),
   3 => array( 'date'=>'08-09-2019','applications'=>200),
   4 => array( 'date'=>'09-09-2019','applications'=>200),
   5 => array( 'date'=>'10-09-2019','applications'=>150),
   6 => array( 'date'=>'11-09-2019','applications'=>500)
);
$label=$data=array();
if(!empty($formVsApp)){
    foreach ($formVsApp as $result){
        if($result['date']){
            $label[]=date("M jS Y",strtotime ($result['date']));
        }       
        $data[]=$result['applications'];
    }
}
$labelResult=json_encode($label);
$dataResult=json_encode($data);
?>
<script>
var config = {
	type: 'line',
	data: {
		labels: <?php echo $labelResult ;?>,
		datasets: [{
			label: 'Application Count',
			backgroundColor: window.chartColors.red,
			borderColor: window.chartColors.red,
			data: <?php echo $dataResult;?>,
			fill: false,
		}]
	},
	options: {
		responsive: true,
		title: {
			display: true,
			text: 'Form Vs Applications'
		},
		tooltips: {
			mode: 'index',
			intersect: false,
		},
		hover: {
			mode: 'nearest',
			intersect: true
		},
		scales: {
			xAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					labelString: 'Application Date'
				}
			}],
			yAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					labelString: 'Applications'
				}
			}]
		}
	}
};

window.onload = function() {
	var ctx = document.getElementById('canvas').getContext('2d');
	window.myLine = new Chart(ctx, config);
};
var colorNames = Object.keys(window.chartColors);
</script>