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
    '05-09-2019' => array( 'day_engaged'=>20 ,'total_engaged'=>20,'total_allocated'=>30),
    '06-09-2019' => array( 'day_engaged'=>30 ,'total_engaged'=>50,'total_allocated'=>70),
    '07-09-2019' => array( 'day_engaged'=>40 ,'total_engaged'=>90,'total_allocated'=>180),
    '08-09-2019' => array( 'day_engaged'=>20 ,'total_engaged'=>110,'total_allocated'=>290),
    '09-09-2019' => array( 'day_engaged'=>10 ,'total_engaged'=>120,'total_allocated'=>410),
    '10-09-2019' => array( 'day_engaged'=>50 ,'total_engaged'=>170,'total_allocated'=>580),
    '11-09-2019' => array( 'day_engaged'=>60 ,'total_engaged'=>230,'total_allocated'=>810),
    '12-09-2019' => array( 'day_engaged'=>10 ,'total_engaged'=>240,'total_allocated'=>1050)
);

$label=$dayEngagedData=$totalEngagedData=$totalAllocatedData=array();
if(!empty($resultData)){
    foreach ($resultData as $key => $result){
        if($key){
            $label[]=date("M jS Y",strtotime ($key));
        }         
       $dayEngagedData[]=$result['day_engaged'];
       $totalEngagedData[]=$result['total_engaged'];
       $totalAllocatedData[]=$result['total_allocated'];
    }
}
$labelResult=json_encode($label);
$dayEngagedDataResult=json_encode($dayEngagedData);
$totalEngagedDataResult=json_encode($totalEngagedData);
$totalAllocatedResult=json_encode($totalAllocatedData);
?>
<script>
var chartData = {
labels: <?php echo $labelResult;?>,
datasets: [{
	type: 'line',
	label: 'Day Wise Lead Engaged',
	borderColor: '#e21f1f',
	borderWidth: 2,
	fill: false,
	data: <?php echo $dayEngagedDataResult;?>
},
{
	type: 'line',
	label: 'Total Lead Engaged',
	borderColor: '#dece13e6',
	borderWidth: 2,
	fill: false,
	data: <?php echo $totalEngagedDataResult;?>
},
{
	type: 'bar',
	label: 'Total Leads Allocated',
	backgroundColor: '#23c7d8',
	data: <?php echo $totalAllocatedResult;?>,
	borderColor: 'white',
	borderWidth: 2
}]

};
window.onload = function() {
var ctx = document.getElementById('canvas').getContext('2d');
window.myMixedChart = new Chart(ctx, {
	type: 'bar',
	data: chartData,
	options: {
		responsive: true,
		title: {
			display: true,
			text: 'Lead Engagement Chart'
		},
		tooltips: {
			mode: 'index',
			intersect: true
		},
		scales: {
			xAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					labelString: 'Lead Allocation Date'
				}
			}],
			yAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					labelString: 'Lead Allocated'
				}
			}]
		}
	}
});
};

document.getElementById('randomizeData').addEventListener('click', function() {
chartData.datasets.forEach(function(dataset) {
	dataset.data = dataset.data.map(function() {
		return randomScalingFactor();
	});
});
window.myMixedChart.update();
});

	</script>