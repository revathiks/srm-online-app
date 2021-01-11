<?php
	if($appln_no && $trans_no){

		// Appplication Number
		$message = str_replace('####@@@@####', $appln_no, $form_message);
		// Transaction Number
		$message = str_replace('##@@@@##', $trans_no, $message);
		if($mode) // If Print is true
		$form_path_preview = $form_path_preview.'/'.$mode.'/'.$applicant_login_id.'/'.$applicant_id."?".PRINT_IS_TRUE;
		else
		$form_path_preview = $form_path_preview."?".PRINT_IS_TRUE;
		
		// Replace Preview URL
		$message = str_replace('#####', $form_path_preview, $message);
		// HTML Encode Entity Decode
		echo html_entity_decode($message);
	}else{
		echo '<nav class="navbar navbar-expand-md navbar-default bg-default ">
		</nav><main role="main" >
			<div class="position-relative overflow-hidden text-center bg-light">  
				<div class="product-device shadow-sm d-none d-md-block"></div>
				<div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
			</div>
			<div class="">		
				<div class="col-sm">
				  <div class="Register_align">
					<div class="">		   
						<h6 class="w-100 thank_info pt-3" style="font-size:16px;text-align:center">You have not completed yet pls complete the steps</h6>
					</div>
				  </div>
				</div>
			  </div>
		</main>';		
	}
?>