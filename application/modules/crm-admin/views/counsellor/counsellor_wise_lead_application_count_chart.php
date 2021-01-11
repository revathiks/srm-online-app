<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
</style>
<div class="row">
	<div class="col-md-5">
		<h5 class="info-title">Counsellor Wise Lead and Application Count</h5>
	</div>
	<div class="col-md-2">
		<label>Assigned / Application</label>
		<select class="form-control" id="lead_application">
			<option selected disabled>Select Options</option>
			<option value="lead_assigned">Lead Assigned</option>
			<option value="application_assigned">Lead Application</option>
		</select>
	</div>	
	<div class="col-md-2">
		<label>Lead Stages</label>
		<select class="form-control" id="lead_application">
			<option selected disabled>Select Options</option>
			<option value="0">COLD</option>
			<option value="20">WARM</option>
			<option value="40">HOT</option>
			<option value="60">NOT ANSWERED</option>
			<option value="80">SUBMITTED</option>
		</select>
	</div>	
	<div class="col-md-3">
		<label>Search</label>
		<input type="text" class="form-control" id="search_assigned" placeholder="Search"/>
	</div>		
</div>
<hr/>
<div class="container">
    <div>
		<canvas id="canvas"></canvas>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-6">
		<canvas id="lead_segregation"></canvas>
    </div>
	<div class="col-md-6">
		<canvas id="allocation_snap_shot"></canvas>
	</div>
</div>
<hr/>
<div class="row">
	<div class="col-md-12">
		<canvas id="application_stage_segregation"></canvas>
	</div>
</div>
<?php

$resultData=array(
   'A2304' => array( 'name'=>'Sunokkiya.S','leads'=>15460,'applications'=>109394),
   'A2305' => array( 'name'=>'Arathy A','leads'=>17693,'applications'=>6412),
   'A2306' => array( 'name'=>'Bharathy S','leads'=>20370,'applications'=>8305),
   'A2307' => array( 'name'=>'Priyanka M R','leads'=>38163,'applications'=>17098),
   'A2308' => array( 'name'=>'Priya D','leads'=>31452,'applications'=>13093),
   'A2309' => array( 'name'=>'Nithya K','leads'=>19137,'applications'=>7218),
   'A2310' => array( 'name'=>'Varalakshmi','leads'=>11416,'applications'=>4815),
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

// Lead Stage Segregation
$lead_stage_segragation =array(
   'A2304' => array( 'name'=>'HOT','count'=>4523),
   'A2305' => array( 'name'=>'COLD','count'=>10417),
   'A2306' => array( 'name'=>'WARM','count'=>11315),
   'A2307' => array( 'name'=>'NOT ANSWERED','count'=>36718),
   'A2308' => array( 'name'=>'SUBMITTED','count'=>32021),
   'A2309' => array( 'name'=>'UNTOUCHED','count'=>220238),
);
$labelname=$count=array();
if(!empty($lead_stage_segragation)){
    foreach ($lead_stage_segragation as $result){
       $labelname[]=$result['name'];              
       $count[]=$result['count'];
    }
}
$labelResultname =json_encode($labelname);
$leadDataResultcount=json_encode($count);

// Allocation Snapshot
$allocation_snap_shot =array(
   'Applications' => array( 'name'=>'applications','count'=>515815),
   'Leads' => array( 'name'=>'leads','count'=>630055),
);
$labelname=$count=array();
if(!empty($allocation_snap_shot)){
    foreach ($allocation_snap_shot as $result){
       $labelname_ss[]=$result['name'];              
       $count_ss[]=$result['count'];
    }
}
$labelResultname_ss =json_encode($labelname_ss);
$leadDataResultcount_ss=json_encode($count_ss);

// Application Stage Segregation
$application_stage_segregation =array(
   'Untouched' => array( 'name'=>'Untouched','count'=>109395),
);
$labelname_ass=$count_ass=array();
if(!empty($application_stage_segregation)){
    foreach ($application_stage_segregation as $result){
       $labelname_ass[]=$result['name'];              
       $count_ass[]=$result['count'];
    }
}
$labelResultname_ass =json_encode($labelname_ass);
$leadDataResultcount_ass=json_encode($count_ass);
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
		                    ctx.textAlign = 'center';
		                    ctx.textBaseline = 'middle';
		                    ctx.fillStyle = dataset.type == "line" ? "black" : "black";
		                    ctx.save();
		                    ctx.translate(model.x, textY-30);
		                    ctx.rotate(6.3);
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
		
		// Lead Segregation Chart
		var ctx2 = document.getElementById('lead_segregation').getContext('2d');
		common_bar_line_chart(ctx2,<?php echo $labelResultname;?>,<?php echo $leadDataResultcount;?>,10,'Lead Segregation Stage');
		
		// Allocation Snapshot Chart
		var ctx3 = document.getElementById('allocation_snap_shot').getContext('2d');
		common_bar_line_chart(ctx3,<?php echo $labelResultname_ss;?>,<?php echo $leadDataResultcount_ss;?>,50,'Allocation Snapshot');

		// Application Stage Segregation Chart
		var ctx4 = document.getElementById('application_stage_segregation').getContext('2d');
		common_bar_line_chart(ctx4,<?php echo $labelResultname_ass;?>,<?php echo $leadDataResultcount_ass;?>,100,'Application Stage Segregation');
	</script>