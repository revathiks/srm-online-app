<style>
canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
</style>
<div class="container">   
    <!-- doughnut chart -->
        <div id="canvas-holder" style="width:80%">
		 <canvas id="chart-area"></canvas>
	    </div>
     <!-- end doughnut chart -->
</div>
<?php
$resultData=array(
    'tamilNadu' => array( 'statename'=>'TamilNadu' ,'leads'=>1000,'applications'=>'2000'),
    'andhra' => array( 'statename'=>'Andhra' ,'leads'=>800,'applications'=>'1000'),
    'pudhucherry' => array( 'statename'=>'Pudhucherry' ,'leads'=>700,'applications'=>'200'),
    'tamilNadu' => array( 'statename'=>'TamilNadu' ,'leads'=>600,'applications'=>'80'),
    'kerala' => array( 'statename'=>'Kerala' ,'leads'=>700,'applications'=>'100'),
    'karnataka' => array( 'statename'=>'Karnataka' ,'leads'=>500,'applications'=>'300'),
    'delhi' => array( 'statename'=>'Delhi' ,'leads'=>300,'applications'=>'200'),
    'mumbai' => array( 'statename'=>'Mumbai' ,'leads'=>200,'applications'=>'100'),
    'mp' => array( 'statename'=>'MP' ,'leads'=>100,'applications'=>'200'),
    'odisa' => array( 'statename'=>'Odisa' ,'leads'=>50,'applications'=>'500'),
    'up' => array( 'statename'=>'UP' ,'leads'=>20,'applications'=>'600'),
 );
//print_r($formVsApp);die;
$color=array(
'tamilNadu'=> 'rgb(0,128,0)',
'andhra'=> 'rgb(0,0,255)',
'pudhucherry'=> 'rgb(255,0,255)',
'kerala'=>'rgb(128,0,0)',
'karnataka'=> 'rgb(0,0,128)',
'delhi'=> 'rgb(0,255,255)',
'mumbai'=> 'rgb(128,128,0)',
'mp'=> 'rgb(0,128,128)',
'odisa'=>'rgb(0,255,0)',
'up'=> 'rgb(255,0,0)'
);

$label=$leaddata=$appData=$chartcolor=array();
if(!empty($resultData)){
    foreach ($resultData as $key => $result){
        $label[]=$result['statename'];
        $leaddata[]=$result['leads'];
        $appData[]=$result['applications'];
        $chartcolor[]=$color[$key];           
    }
}
$labelResult=json_encode($label);
$leaddataResult=json_encode($leaddata);
$appDataResult=json_encode($appData);
$chartcolorResult=json_encode($chartcolor);
?>
<script>
var randomScalingFactor = function() {
	return Math.round(Math.random() * 100);
};

var config = {
	type: 'doughnut',
	data: {
		datasets: [{
			data: <?php echo $leaddataResult;?>,
			backgroundColor: <?php echo $chartcolorResult;?>,
			label: 'Dataset 1'
		}],
		labels: <?php echo $labelResult;?>
	},
	options: {
		responsive: true,
		legend: {
			position: 'right',
		},
		title: {
			display: true,
			text: 'State Wise Leads'
		},
		animation: {
			animateScale: true,
			animateRotate: true
		},
		plugins: {
				  labels: {
				    render: 'percentage',
				    fontColor: ['white','white','white','white','white','white','white','white','white','white'],
				    precision: 2
				  }
		}
	}
};

window.onload = function() {
	var ctx = document.getElementById('chart-area').getContext('2d');
	window.myDoughnut = new Chart(
			ctx, 
			config
	);
};
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/common/libs/chartjs/chartjs-plugin-labels.js"></script>