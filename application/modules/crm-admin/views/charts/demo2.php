<style>
canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
</style>
<div class="container">
   <!-- line chart -->
    <div style="width:75%;">
    		<canvas id=line_chart></canvas>
    </div>
     <!-- end line chart -->
    <!-- pie chart -->
        <div>
        <canvas id="pie_chart"></canvas>
        </div>
     <!-- end pie chart -->
</div>
<?php


$formVsApp=array(
    '05-09-2019' => array( 'TamilNadu'=>10 ,'Andhra'=>20,'Pudhucherry'=>30,'Kerala'=>20,'Karnataka'=>15),
    '06-09-2019' => array( 'TamilNadu'=>20 ,'Andhra'=>30,'Pudhucherry'=>20,'Kerala'=>30,'Karnataka'=>25),
    '07-09-2019' => array( 'TamilNadu'=>30 ,'Andhra'=>40,'Pudhucherry'=>30,'Kerala'=>40,'Karnataka'=>10),
    '08-09-2019' => array( 'TamilNadu'=>40 ,'Andhra'=>50,'Pudhucherry'=>20,'Kerala'=>20,'Karnataka'=>30),
    '09-09-2019' => array( 'TamilNadu'=>20 ,'Andhra'=>10,'Pudhucherry'=>30,'Kerala'=>10,'Karnataka'=>20),
    '10-09-2019' => array( 'TamilNadu'=>50 ,'Andhra'=>30,'Pudhucherry'=>20,'Kerala'=>25,'Karnataka'=>50),
);
//print_r($formVsApp);die;
$color=array(
'TamilNadu'=> 'rgb(0,128,0)',
'Andhra'=> 'rgb(0,0,255)',
'Pudhucherry'=> 'rgb(255,0,255)',
'Kerala'=>'rgb(128,0,0)',
'Karnataka'=> 'rgb(0,0,128)'
);

$label=$data=array();
$pieData=array();
if(!empty($formVsApp)){
    foreach ($formVsApp as $key => $result){        
        if($key){
            $label[]=date("M jS Y",strtotime ($key));
        } 
        if($result){
            
            foreach($result as $key2 => $value){               
                $data[$key2]['label']=$key2;
                $data[$key2]['backgroundColor']=$color[$key2];
                $data[$key2]['borderColor']=$color[$key2];
                $data[$key2]['fill']='false'; 
                $data[$key2]['data'][]=$value;
                //pie chart                
                $pieData[$key2]['data'][]=$value;
                $pieData[$key2]['color']=$color[$key2];
            }
        }
    }
}

$labelResult=json_encode($label);
//remove key for chart
$dataResults=array();
foreach($data as $fianldata){
    $dataResults[]=$fianldata;
}
$linechartdata=json_encode($dataResults);

//structure  pie chart data
$piechartLabel=$pieChartResults=$piechartcolor=array();
if($pieData){
    foreach($pieData as $key => $pieResult){
        $piechartLabel[]=$key;
        $piechartcolor[]=$pieResult['color'];
        $pieChartResults[]=array_sum($pieResult['data']);
    }
}
$piechartLabelResult=json_encode($piechartLabel);
$piechartdata=json_encode($pieChartResults);
$piechartcolorResult=json_encode($piechartcolor);
?>
<script>
<!-- line chart-->
var config = {
	type: 'line',
	data: {
		labels: <?php echo $labelResult ;?>,
		datasets: <?php echo $linechartdata;?>
	},
	options: {
		responsive: true,
		title: {
			display: true,
			text: 'State Vs Applications'
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
<!-- end line chart-->

<!-- pie chart -->
var pieconfig = {
	type: 'pie',
	data: {
		datasets: [{
			data: <?php echo $piechartdata;?>,
			backgroundColor: <?php echo $piechartcolorResult;?>,
			label: 'Dataset 1'
		}],
		labels:<?php echo $piechartLabelResult;?>
	},
	options: {
		responsive: true,
		title: {
			display: true,
			text: 'Applications Based on State'
		},
	}
};

window.onload = function() {

	var ctx = document.getElementById('line_chart').getContext('2d');
	window.myLine = new Chart(ctx, config);
	
	var ctx = document.getElementById('pie_chart').getContext('2d');
	window.myPie = new Chart(ctx, pieconfig);
};

<!-- end pie chart -->

</script>