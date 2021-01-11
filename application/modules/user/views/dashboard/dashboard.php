<style>
.align-card {
background:#f8f8fa;	
}
.align-card > .card-body {
padding:0;	
}
.mini-stat .mini-stat-img img {
    max-width: 32px;
    max-height: 42px !important;
    padding-top: 13px;
}
</style>
<?php 
$complete_form = 0;
$inprogress_form = 0;
if(isset($applicantstatus_list)){ 
    foreach ($applicantstatus_list as $k=>$v) {
    $appln_form_name = $v['appln_form_name'];
    $completion_percent = $v['completion_percent'];
    if($completion_percent == 100) {
        $complete_form++;}
    if($completion_percent > 5 && $completion_percent != 100){
        $inprogress_form++;}
    }
} ?>
<div class="row">
    <div class="col-md-4">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <img src="<?php echo base_url(); ?>assets/common/images/ap-inprog.png" alt="">
                    </div>
                    <h5 class="font-size-16 text-uppercase mt-0 text-white-50 text-nowrap">APPLICATION(S) IN PROGRESS</h5>
                    <h4 class="font-weight-medium font-size-24"><?php echo $inprogress_form;?></h4>

                </div>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <img src="<?php echo base_url(); ?>assets/common/images/app-com.png" alt="">
                    </div>
                    <h5 class="font-size-16 text-uppercase mt-0 text-white-50 text-nowrap">APPLICATION(S) COMPLETED</h5>
                    <h4 class="font-weight-medium font-size-24"><?php echo $complete_form;?></h4>

                </div>

            </div>
        </div>
    </div>
     <div class="col-md-4">
        <div class="card mini-stat bg-primary text-white">
            <div class="card-body">
                <div class="mb-4">
                    <div class="float-left mini-stat-img mr-4">
                        <img src="<?php echo base_url(); ?>assets/common/images/query.png" alt="">
                    </div>
                    <h5 class="font-size-16 text-uppercase mt-0 text-white-50 text-nowrap">QUERY RAISED</h5>
                    <h4 class="font-weight-medium font-size-24">-</h4>

                </div>

            </div>
        </div>
    </div>
</div>
<div class="row targetDiv mt-3" id="div1">
    <div class="col-12">
        <div class="card ">
            <div class="card-body">
                <h5 class="card-title">Form Status</h5>
                <div class="table-responsive">
                    <table class="table table_dashboard">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 300px;">Application Form</th>
                                <th scope="col">Application No.</th>
                                <th scope="col">Application Submitted On</th>
                                <th scope="col">Application Fees</th>
                                <th scope="col" style="width:125px;" >Status</th>
                                <th scope="col" style="width: 10px;">%&nbsp;Completed    </th>
                            </tr>
                        </thead>
                        <tbody>
				<?php if(isset($applicantstatus_list)){ 
						foreach ($applicantstatus_list as $k=>$v) {
							$appln_form_name = $v['appln_form_name'];
							$completion_percentage = $v['completion_percent'];
							$pending_txt ='-';
							$completion_percent = ((isset($v['completion_percent']))?$completion_percentage:'-');
							$appln_form_fee = $v['appln_form_fee'];
							$app_status = $v['application_status'];                                        
							if ($completion_percent=='-')
							{
								$application_status = 'Apply Now';										
							} 
							else if ($completion_percent!='' && $completion_percent!='100')
							{
								$application_status = 'In progress';
							}
							else if ($completion_percent!='' && $completion_percent=='100')
							{
								$application_status = 'Completed';
							}
							$link ="#";
							if($appln_form_name == "M.Tech [Research] - July session"){
								$link = 'mtechresearch';
							} 
							else if($appln_form_name == "Distance Education (July Session)"){
								$link = 'dis-education';
							} 
							else if($appln_form_name == "Ph.D (July Session)"){
								$link = 'phd';
							}
							else if($appln_form_name == "B.Arch/ B.Design"){
								$link = 'barch';
							}
							else if($appln_form_name == "Hotel & Catering Management"){
								$link = 'hcma';
							}
							else if($appln_form_name == "B.Tech"){
								$link = 'btech';
							}
							else if($appln_form_name == "M.Tech"){
								$link = 'mtech';
							}
							else if($appln_form_name == "BBA"){
								$link = 'bba';
							}
							else if($appln_form_name == "MBA"){
								$link = 'mba';
							}
							else if($appln_form_name == "B.Sc. Aircraft Maintenance"){
								$link = 'bsc-am';
							}
							else if($appln_form_name == "B.Ed / M.Ed / M.Phil"){
								$link = 'b-ed-m-ed-m-phil';
							}
							else if($appln_form_name == "Science and Humanities (UG, PG, Diploma, PG Diploma)"){
								$link = 'shug';
							}
							else if($appln_form_name == "Advanced PG Diploma Life Science"){
								$link = 'pgdplifescience';
							}
							else if($appln_form_name == "M.Arch/ M.Des"){
								$link = 'march';
							}
							else if($appln_form_name == "Law"){
								$link = 'law';
							}
							else if($appln_form_name == "Agri Sciences"){
								$link = 'agrisci';
							}
							else if($appln_form_name == "Health Science Non Entrance [UG, PG, Diploma, PG Diploma, Certificate]"){
								$link = 'hspg_diploma';
							}
							else if($appln_form_name == "Health Science [UG]Entrance"){
								$link = 'hsug';
							}
							else if($appln_form_name == "Health Science [PG] Entrance"){
								$link = 'hspg_ee';
							}
							else if($appln_form_name == "Part-time Programmes"){
								$link = 'part-time-ug-pg-courses';
							}							
							else if($appln_form_name == "Tamil Perayam Programmes"){
								$link = 'tamilperayam';
							}
							else if($appln_form_name == "Medical Fellowship Programmes"){
								$link = 'fellowship';
							}
							else if($appln_form_name == "AFIH"){
								$link = 'afih';
							}
							else if($appln_form_name == "Part-time Programmes"){
								$link = 'part-time-ug-pg-courses';
							}
							else if($appln_form_name == "Ph.D - (Jan session)"){
								$link = 'phd-jan';
							}
							else if($appln_form_name == "Distance Education (Jan Session)"){
								$link = 'dis-education-jan';
							}
							else if($appln_form_name == "M.Tech [Research] - Jan session"){
								$link = 'mtechresearch-jan';
							}
							else if($appln_form_name == "International"){
								$link = 'international_form';
							}
							
							
					?>
					<tr> 
					<td><?php echo $appln_form_name;?></td>
					<td>-</td>
					<td>-</td>
					<td><?php echo $appln_form_fee;?> </td>
					<td>
					<?php if ($completion_percent==100) { ?>
					<button class="btn btn-primary" style="pointer-events: none;"><?php echo $application_status;?></button>					
					<?php } else { ?>
					<a href="<?php echo base_url().$link;?>"><button class="btn btn-primary">
					<?php echo $application_status;?></button>
					</a>
					<?php } ?>
					</td>
					<td><?php echo $completion_percent;?></td>
					</tr>
				<?php $application_status = ''; $completion_percent=''; } } else {
					echo "No Record Found"; } ?>
                        </tbody>
                    </table>
                </div>      
            </div>
        </div>
    </div>
</div>