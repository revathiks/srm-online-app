<?php
$app_form_id_phd = APP_FORM_ID_PHD_JAN;
$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_tenth_marksheet = DOCUMENT_ID_TENTH_MARKSHEET;
$document_id_twelvfth_marksheet = DOCUMENT_ID_TWELVFTH_MARKSHEET;
$document_id_aadhar_card = DOCUMENT_ID_AADHAR_CARD;
$document_id_post_graduation_marksheet = DOCUMENT_ID_POST_GRADUATION_MARKSHEET;
$document_id_gate_score_card = DOCUMENT_ID_GATE_SCORE_CARD;
$document_id_ugc_score_card = DOCUMENT_ID_UGC_SCORE_CARD;
$document_id_slet_score_card = DOCUMENT_ID_SLET_SCORE_CARD;
$document_id_net_score_card = DOCUMENT_ID_NET_SCORE_CARD;
$document_id_score_card = DOCUMENT_ID_SCORE_CARD;
$document_id_tentative_topic = DOCUMENT_ID_TENTATIVE_TOPIC;
$document_id_additional_qualification = DOCUMENT_ID_ADDITIONAL_QUALIFICATION;
$form_wizard_payment_id = FORM_WIZARD_PAYMENT_ID;

$is_work_experience_select = '';
$is_work_experience = $applicant_other_details_list['is_work_experience'];
if($is_work_experience == 't') {
    $is_work_experience_select = 'yes';
} else if($is_work_experience == 'f') {
    $is_work_experience_select = 'no';
}

$is_competitive_exam_select = '';
$is_competitive_exam_select_name = '';
$is_competitive_exam = $applicant_other_details_list['is_competitive_exam'];
if($is_competitive_exam == 't') {
    $is_competitive_exam_select = 'yes';
    $is_competitive_exam_select_name = 'Yes';
} else if($is_competitive_exam == 'f') {
    $is_competitive_exam_select = 'no';
    $is_competitive_exam_select_name = 'No';
}
$comp_exam_id = $applicant_other_details_list['comp_exam_id'];
$comp_exam_name = $applicant_other_details_list['comp_exam_name'];

if($applicant_graduations_list) {
   foreach($applicant_graduations_list as $k=>$v) {
      $is_curr_qualify = $v['is_curr_qualify'];
      // echo 'is_curr_qualify => '.$is_curr_qualify."\n";
      if($is_curr_qualify != 't') {
         $applicant_grad_det_id[] = $v['applicant_grad_det_id'];
         // $applicant_grad_det_other_degree_name[] = $v['other_degree_name'];
         $applicant_grad_det_other_degree_name[] = $v['other_deg_name'];
         $applicant_grad_det_univ_id[] = $v['univ_id'];                             
         $applicant_grad_det_univ_name[] = $v['univ_name'];
         $applicant_grad_det_mark_scheme_id[] = $v['mark_scheme_id'];
         $applicant_grad_det_mark_scheme_name[] = $v['mark_scheme_name'];
         // $applicant_grad_det_mark_percent[] = $v['mark_percent'];
         $applicant_grad_det_mark_percent[] = $v['mark_percentage'];
         // $applicant_grad_det_completion_year[] = $v['completion_year'];
         $applicant_grad_det_completion_year[] = $v['yr_of_pass'];   
      }
   }
}

$docs = $upload_scripts = array();
$file_count = 0;
if($upload_filelist) {
  foreach($upload_filelist as $doc){
  		$document_id = $doc['document_id'];
  		$id = $doc['id'];
  		$file_name = $doc['name'];
  		$file_path = $doc['path'];
  		$file_name_user = remove_file_separator($file_name);
  		$file_name_truncate = remove_file_separator($file_name, true);
  		$file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_score_card == $document_id)?'score_card':(($document_id_aadhar_card == $document_id)?'aadhar_card':(($document_id_additional_qualification == $document_id)?'additional_qualification':(($document_id_post_graduation_marksheet == $document_id)?'post_graduation_marksheet':''))))));
  		$parsley_required = (($document_id_photograph == $document_id)?'true':(($document_id_signature == $document_id)?'true':(($document_id_score_card == $document_id)?'true':(($document_id_post_graduation_marksheet == $document_id)?'true':'false'))));
     if($document_id == $document_id_tentative_topic) {
        $docs[$document_id][]=array(
          'id'=>$id,
          'file_name'=>$file_name,
          'file_name_user'=>$file_name_user,
          'file_name_truncate'=>$file_name_truncate,
          'file_path'=>$file_path,
        );
        $file_count++;
     } else {
        $docs[$document_id]=array(
          'id'=>$id,
          'file_name'=>$file_name,
          'file_name_user'=>$file_name_user,
          'file_name_truncate'=>$file_name_truncate,
          'file_path'=>$file_path,
        );
        $upload_scripts[] = 'upload_file_set_download_delete_options("'.$file_doc_type.'", "'.$file_name.'", "'.$file_path.'", "'.$document_id.'", "'.$id.'", "'.$parsley_required.'", "'.$mode_edit.'")';
     }
  }
}
$docs['file_count'] = $file_count;

$payment_mode_id = $applicant_payment_details_list['payment_mode_id'];

$current_wizard=$applicant_appln_details_list['wizard_id'];
$startIndex = $this->input->get('startIndex',true);
//restrict previous section
$is_allow_previous=$this->config->item('is_allow_previous');
/*Form Index Restriction Start*/
$start_wizard = 0;
$start_wizard_next = -1;
$next_step_allowed = '';
$start_wizard_next_allow='';
$appln_form_w_wizard_id = $applicant_appln_details_list['form_w_wizard_id'];
if($appln_form_w_wizard_id !='')
{
    $wizard_dt_complete_percentage = $appln_wizard_dt[0]['completion_percent'];
    foreach ($wizard_dt as $key => $value) {
        $w_wizard_id = $value['form_w_wizard_id'];
        $completion_percent = $value['completion_percent'];
        if(!empty($appln_form_w_wizard_id) && $completion_percent != 100 && $w_wizard_id == $appln_form_w_wizard_id && $startIndex == '')
        {
            $next_step_allowed = $start_wizard +1;
        }
        else if(!empty($appln_form_w_wizard_id) && $startIndex != '' && $completion_percent <= $wizard_dt_complete_percentage)
        {
            $start_wizard_next++;
        }
        $start_wizard++;
    }
}

if($mode_edit == ''){
	if($start_wizard_next >=0){ //Once Next allow greater than Zero we add to allow next steps
		$start_wizard_next_allow = $start_wizard_next + 1;
	}
	if($next_step_allowed !="" && $current_wizard<FORM_WIZARD_PAYMENT_ID){ //Without StartIndex
		$startIndex = $next_step_allowed;
	}
	else if($startIndex <= $start_wizard_next && $start_wizard_next >=0 && $current_wizard<FORM_WIZARD_PAYMENT_ID){ // StartIndex Lesser than Submit Form allow
		$startIndex = $startIndex;
	}
	else if($startIndex == $start_wizard_next_allow && $start_wizard_next >=0 && $current_wizard<FORM_WIZARD_PAYMENT_ID){ // StartIndex next step once complete Current Tab
		$startIndex = $startIndex;
	}
	else if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0)) {
		if(isset($startIndex) && $startIndex >= 5){
			$startIndex=$startIndex;
		}else{
			$startIndex=5;
		}
	}
	else if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==1) && $startIndex <= $start_wizard_next_allow) {
		$startIndex = $startIndex;
	}
	else{
		$startIndex = 0;
	}
}
/* Admin Means No restriction end / Form Index Restriction End */
?>
<script>
	var part_time_external = '<?php echo PART_TIME_EXTERNAL; ?>';
	var country_value_default = '<?php echo COUNTRY_VALUE_DEFAULT; ?>';
	var logged_applicant_id = '<?php echo $logged_applicant_id; ?>';
    var logged_applicant_login_id = '<?php echo $logged_applicant_login_id; ?>';
    var comp_exam_ugc_net = '<?php echo COMP_EXAM_UGC_NET; ?>';
    var comp_exam_ugc_csir_net = '<?php echo COMP_EXAM_UGC_CSIR_NET; ?>';
    var comp_exam_slet = '<?php echo COMP_EXAM_SLET; ?>';
    var comp_exam_gate = '<?php echo COMP_EXAM_GATE; ?>';
    var comp_exam_teacher_fellowship_holder = '<?php echo COMP_EXAM_TEACHER_FELLOWSHIP_HOLDER; ?>';
    var document_id_tentative_topic = '<?php echo DOCUMENT_ID_TENTATIVE_TOPIC; ?>';
    var app_form_id = '<?php echo APP_FORM_ID_PHD_JAN; ?>';
    var payment_wizard_id = '<?php echo FORM_WIZARD_PAYMENT_ID; ?>';
	/*CRM ADMIN Edit form start*/
	var crm_applicant_personal_det_id = '<?php echo $crm_applicant_personal_det_id ; ?>';
	var crm_applicant_login_id = '<?php echo $crm_applicant_login_id ; ?>';
	var mode_edit_val = '<?php echo ADMIN_MODE_EDIT ; ?>';
	var mode_edit_url = '<?php echo $mode_edit; ?>';
	<?php if($mode_edit) { ?>
	   var url_edit = '&mode=edit'+'&applicant_personal_det_id='+crm_applicant_personal_det_id+'&applicant_login_id='+crm_applicant_login_id;
	   var url = "<?php echo base_url(); ?>phd-jan/"+mode_edit_val+"/"+crm_applicant_login_id+"/"+crm_applicant_personal_det_id;
	   var payment_url = '<?php echo base_url(); ?>user/payment_details?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;
	   var save_exit_redirect_url = '<?php echo base_url(); ?>crm-admin/dashboard';
	<?php } else { ?>
	   var url_edit =  '';
	   var url = "<?php echo base_url(); ?>phd-jan";
	   var payment_url = '<?php echo base_url(); ?>user/payment_details';
	   var save_exit_redirect_url = '<?php echo base_url(); ?>';
	<?php } ?>
	/*CRM ADMIN Edit form end*/		
    var get_percentage_url = '<?php echo base_url(); ?>/user/get_percentage_w_tab?app_form_id='+app_form_id+url_edit;
	var redirect = '<?php echo base_url()."thank_you"; ?>?app_form_id='+app_form_id;
	
    var redirect_payment_thank_you = '<?php echo base_url(); ?>user/payment_thank_you?app_form_id='+app_form_id+'&wizard_id='+payment_wizard_id+'&url='+encodeURIComponent(url);
	var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
		csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
		
        $(document).ready(function () {
            'use strict';
						
			// This Function for Payment option selection
			$("#online").click(function(){
				$("#payment_details").hide();
				});
				$("#dd").click(function(){

				 $("#payment_details").show();
			});
			<?php if($payment_mode_id == PAYMENT_MODE_DEMAND_DRAFT_ID) {
				?>
				setTimeout(function() {
					$("#dd").trigger('click');
					<?php if(!empty($applicant_payment_details_list)){ ?>
					 $("#dd").attr("disabled","disabled");
					 $("#online").attr("disabled","disabled");
					 $("#BankName").attr("disabled","disabled");
					 $("#DDNumber").attr("disabled","disabled");					
					 $("#DDDate").attr("disabled","disabled");
					 $("#BranchName").attr("disabled","disabled");
					 <?php } ?>
					
				},1);
				<?php
			}
			if($payment_mode_id == PAYMENT_MODE_ONLINE_ID) {
			    ?>
		setTimeout(function() {
			$("#online").trigger('click');
			<?php if(!empty($applicant_payment_details_list)){ ?> 
			 $("#dd").attr("disabled","disabled");
			 $("#online").attr("disabled","disabled");
			<?php } ?>
			
		},1);
		<?php
	}
				?>

            // Dynamically Get Total Wizard Steps
			var total_wizard_Step = $('.wizard_head_tag').length;
			$("#show_currentindex").html('<?php echo ($startIndex)?($startIndex+1):1; ?> of '+total_wizard_Step);
			setTimeout(function() {
				enable_saveExit_btn('<?php echo $startIndex;?>',4);
			 },1);
		 <?php
		  // on load preview button
		  if($startIndex) {
		  ?>
		  setTimeout(function() { 
			if(parseInt(total_wizard_Step-1) == <?php echo $startIndex; ?>) {
				$("#save_exit").remove();
				if(mode_edit_url != ''){
					enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>phd-jan-preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
				}else{				
					enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>phd-jan-preview');
				}
			}
			var curIndex='<?php echo $startIndex;?>';
			if(curIndex==3){
				$(".actions ul > li:nth-child(2) a").text('<?php echo MAKE_PAYMENT; ?>');
			}else{
				$(".actions ul > li:nth-child(2) a").text('<?php echo NEXT_STEP; ?>');
			} 			
		  },1);
		  <?php
		  }
		  ?>			
			

		// Percentage Show Tab Wise
		tab_wise_percentage_show(get_percentage_url,'percentage_bar');
			
		var is_employed_category_hidden = $('#category_check').val();
		var settings = {
	        /* Appearance */
	        headerTag: "h3",
	        bodyTag: "fieldset",
	        contentContainerTag: "div",
	        actionContainerTag: "div",
	        stepsContainerTag: "div",
	        cssClass: "wizard",
	        // stepsOrientation: $.fn.steps.stepsOrientation.horizontal,
	        /* Templates */
	        titleTemplate: '<span class="number"></span> <br> <span class="title-head">#title#</span>   ',
	        loadingTemplate: '<span class="spinner"></span> #text#',

	        /* Behaviour */
	        autoFocus: true,
	        enableAllSteps: false,
	        enableKeyNavigation: true,
	        enablePagination: true,
	        suppressPaginationOnFocus: true,
	        enableContentCache: true,
	        enableCancelButton: false,
	        enableFinishButton: true,
	        preloadContent: true,
	        showFinishButtonAlways: false,
	        forceMoveForward: false,
	        saveState: true,
	        startIndex: <?php echo ($startIndex)?$startIndex:0; ?>,

	        /* Transition Effects */
	        transitionEffect: 'slide', //$.fn.steps.transitionEffect.none,
	        transitionEffectSpeed: 200,

	        /* Events */
	        onStepChanging: function (event, currentIndex, newIndex) { 
	            // if(currentIndex > newIndex)
	            // {
					// return true;
	            // }
				
				// return $(this).parsley().validate();
				if(currentIndex < newIndex) {
					// Step 1 form validation
					if(currentIndex === 0) {
	                   // return true;
					  var qualifying_degree = $('#qualifying_degree').parsley();
					  var specialization_qualifying_degree = $('#specialization_qualifying_degree').parsley();
					  var working_dsc = $('#working_dsc').parsley();
					  var faculty = $('#faculty').parsley();
					  var category = $('#category').parsley();
					  var is_employed = $('#is_employed').parsley();
					  var working_place = $('#working_place').parsley();
					  var qualifying_degree_other = $('#qualifying_degree_other').parsley();
					  var spec_qualifying_degree_other = $('#spec_qualifying_degree_other').parsley();
					  var dept_other = $('#dept_other').parsley();
					  var faculty_other  = $('#faculty_other').parsley();
					  var work_place_other = $('#work_place_other').parsley();
					  
					  if($('#other_qd').is(':visible')){
							$('#qualifying_degree_other').attr('data-parsley-required', 'true');
							$('#qualifying_degree_other').attr('data-parsley-required-message', '<?php echo REQD_QUALIFY_DEGREE_OTHER_MSG; ?>');
							$('#qualifying_degree_other').attr('data-parsley-nameonly', 'true');
							$('#qualifying_degree_other').attr('data-parsley-nameonly-message', '<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');
					  }else{
							$('#qualifying_degree_other').attr('data-parsley-required', 'false');
							$('#qualifying_degree_other').attr('data-parsley-nameonly', 'false');
					  }
					  
					  if($('#other_sqd').is(':visible')){
							$('#spec_qualifying_degree_other').attr('data-parsley-required', 'true');
							$('#spec_qualifying_degree_other').attr('data-parsley-required-message', '<?php echo REQD_SPL_QUALIFY_DEGREE_OTHER_MSG; ?>');
							$('#spec_qualifying_degree_other').attr('data-parsley-nameonly', 'true');
							$('#spec_qualifying_degree_other').attr('data-parsley-nameonly-message', '<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');
					  }else{
							$('#spec_qualifying_degree_other').attr('data-parsley-required', 'false');
							$('#spec_qualifying_degree_other').attr('data-parsley-nameonly', 'false');
					  }	

					  if($('#other_dept').is(':visible')){
							$('#dept_other').attr('data-parsley-required', 'true');
							$('#dept_other').attr('data-parsley-required-message', '<?php echo REQD_OTHER_DEP_SCH_COL_MSG; ?>');
							$('#dept_other').attr('data-parsley-nameonly', 'true');
							$('#dept_other').attr('data-parsley-nameonly-message', '<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');
					  }else{
							$('#dept_other').attr('data-parsley-required', 'false');
							$('#dept_other').attr('data-parsley-nameonly', 'false');
					  }

					  if($('#other_faculty').is(':visible')){
							$('#faculty_other').attr('data-parsley-required', 'true');
							$('#faculty_other').attr('data-parsley-required-message', '<?php echo REQD_FACULTY_OTHER_MSG; ?>');
							$('#faculty_other').attr('data-parsley-nameonly', 'true');
							$('#faculty_other').attr('data-parsley-nameonly-message', '<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');
					  }else{
							$('#faculty_other').attr('data-parsley-required', 'false');
							$('#faculty_other').attr('data-parsley-nameonly', 'false');
					  }	

					  if($('#main_div_is_employed').is(':visible')){
							$('#is_employed').attr('data-parsley-required', 'true');
							$('#is_employed').attr('data-parsley-required-message', '<?php echo REQD_ARE_YOU_EMPLOYED; ?>');
					  }else{
							$('#is_employed').attr('data-parsley-required', 'false');
					  }

					 if($('#main_div_working_place').is(':visible')){
							$('#working_place').attr('data-parsley-required', 'true');
							$('#working_place').attr('data-parsley-required-message', '<?php echo REQD_WORKING_PLACE; ?>');
					  }else{
							$('#working_place').attr('data-parsley-required', 'false');
					  }	

					  if($('#other_working_place').is(':visible')){
							$('#work_place_other').attr('data-parsley-required', 'true');
							$('#work_place_other').attr('data-parsley-required-message', '<?php echo REQD_OTHER_WORKING_PLACE; ?>');
							$('#work_place_other').attr('data-parsley-nameonly', 'true');
							$('#work_place_other').attr('data-parsley-nameonly-message', '<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');
					  }else{
							$('#work_place_other').attr('data-parsley-required', 'false');
							$('#work_place_other').attr('data-parsley-nameonly', 'false');
					  }					  
						
					 
					  if(qualifying_degree.isValid() && specialization_qualifying_degree.isValid() && working_dsc.isValid() && faculty.isValid() && category.isValid() && qualifying_degree_other.isValid() && spec_qualifying_degree_other.isValid() && dept_other.isValid() && faculty_other.isValid() && is_employed.isValid() && working_place.isValid() && work_place_other.isValid()) {
						var qualifying_degree_val = $('#qualifying_degree').val();
						var specialization_qualifying_degree_val = $('#specialization_qualifying_degree').val();
						var working_dsc_val = $('#working_dsc').val();
						var faculty_val = $('#faculty').val();
						var category_val = $('#category').val();
						var is_employed = $('#is_employed').val();
						var working_place = $('#working_place').val();
						var qualifying_degree_val_other = $('#qualifying_degree_other').val();
						var specialization_qualifying_degree_val_other = $("#spec_qualifying_degree_other").val();
						var dept_val_other = $("#dept_other").val();
						var faculty_val_other = $("#faculty_other").val();
						var work_place_other = $("#work_place_other").val();
						var appln_status = $("#appln_status").val();
						
						var user_data = 'qualifying_degree='+qualifying_degree_val+'&specialization_qualifying_degree='+specialization_qualifying_degree_val+'&working_dsc='+working_dsc_val+'&faculty='+faculty_val+'&category='+category_val+'&is_employed='+is_employed+'&working_place='+working_place+'&qualifying_degree_val_other='+qualifying_degree_val_other+'&specialization_qualifying_degree_val_other='+specialization_qualifying_degree_val_other+'&dept_val_other='+dept_val_other+'&faculty_val_other='+faculty_val_other+'&work_place_other='+work_place_other+'&'+csrfName+'='+csrfHash+'&appln_status='+appln_status;
						var moveNxt=0;
						$.ajax({
							type: 'POST',
							url: url,
							data: user_data+'&currentIndex='+currentIndex,
							dataType: 'json',
							cache: false,
							async:false,
							beforeSend: function() { $('.loader').show(); },
							success: function(returndata) {
								if(returndata) {									
									console.log(returndata);
									var startIndex = currentIndex+1
									window.location.href = url+'?startIndex='+startIndex;
									$("#formerr").hide();
									moveNxt=1;									
								}
							},
							error: function(returndata) {
							  moveNxt=0;
							  console.log(returndata);
							  $("#formerr").show(); 							  
							  return false;
							},
						});						
						if(moveNxt){
							return true;
						}
					  } else {
						qualifying_degree.validate();
						qualifying_degree_other.validate();
						specialization_qualifying_degree.validate();
						spec_qualifying_degree_other.validate();
						working_dsc.validate();
						dept_other.validate();
						faculty.validate();
						faculty_other.validate();
						category.validate();
						is_employed.validate();
						working_place.validate();
						work_place_other.validate();
						return false;
					  }
					}					
					
					// Step 2 form validation
					if(currentIndex === 1) {
	                  //return true;
					  var pd_title = $('#pd_title').parsley();
					  var pd_firstname = $('#pd_firstname').parsley();
					  var pd_middlename = $('#pd_middlename').parsley(); 
					  var pd_lastname = $('#pd_lastname').parsley();
					  var pd_mobile_no = $('#pd_mobile_no').parsley();
					  var pd_email = $('#pd_email').parsley();
					  var pd_dob = $('#pd_dob').parsley();
					  var pd_gender = $('#pd_gender').parsley();
					  var pd_alt_email = $('#pd_alt_email').parsley();
					  var pd_blood_group = $('#pd_blood_group').parsley();
					  var pd_nationality = $('#pd_nationality').parsley(); 
					  var pd_social_status = $('#pd_social_status').parsley();
					  var pd_diffrently_abled = $('#pd_diffrently_abled').parsley();
					  var pd_nature_deformity = $('#pd_nature_deformity').parsley();
					  var pd_percent_of_deformity = $('#pd_percent_of_deformity').parsley();
					  
						// Make Validation false
						if($('#pd_lastname').val()=='.'){
							$('#pd_lastname').removeAttr('data-parsley-nameonly', 'true');
							$('#pd_lastname').removeAttr('data-parsley-nameonly-message', '<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');
						}			

						if($('#mnd').is(':visible')){
							$('#pd_nature_deformity').attr('data-parsley-required', 'true');
							$('#pd_nature_deformity').attr('data-parsley-required-message', '<?php echo REQD_NATURE_DEFORMITY_MSG; ?>');
					  }else{
							$('#pd_nature_deformity').attr('data-parsley-required', 'false');
					  }

						if($('#mpd').is(':visible')){
							$('#pd_percent_of_deformity').attr('data-parsley-required', 'true');
							$('#pd_percent_of_deformity').attr('data-parsley-required-message', '<?php echo REQD_PERCENT_NATURE_DEFORMITY_MSG; ?>');
					  }else{
							$('#pd_percent_of_deformity').attr('data-parsley-required', 'false');
					  }

					  if($('#main_div_social_status').is(':visible')){
							$('#pd_social_status').attr('data-parsley-required', 'true');
							$('#pd_social_status').attr('data-parsley-required-message', '<?php echo REQD_SOCIAL_STATUS_MSG; ?>');
					  }else{
							$('#pd_social_status').attr('data-parsley-required', 'false');
					  }					  
					  
					  if(pd_title.isValid() && pd_firstname.isValid() && pd_lastname.isValid() && pd_mobile_no.isValid() && pd_email.isValid() && pd_dob.isValid() && pd_gender.isValid() && pd_alt_email.isValid() && pd_blood_group.isValid() && pd_nationality.isValid() && pd_diffrently_abled.isValid() && pd_nature_deformity.isValid() && pd_percent_of_deformity.isValid() && pd_social_status.isValid() && pd_middlename.isValid()) {
						var pd_title_val = $('#pd_title').val();
						var pd_firstname_val = $('#pd_firstname').val();
						var pd_middlename_val = $('#pd_middlename').val();
						var pd_lastname_val = $('#pd_lastname').val();
						var pd_mobile_no_code_val = $('#phone_no_code').val();
						var pd_mobile_no_val = $('#pd_mobile_no').val();
						var pd_email_val = $('#pd_email').val();
						var pd_dob_val = $('#pd_dob').val();
						var pd_gender_val = $('#pd_gender').val();
						var pd_alt_email_val = $('#pd_alt_email').val();
						var pd_blood_group_val = $('#pd_blood_group').val();
						var pd_nationality_val = $('#pd_nationality').val();
						var pd_social_status_val = $('#pd_social_status').val();
						var pd_diffrently_abled_val = $('#pd_diffrently_abled').val();
						var pd_nature_deformity_val = $('#pd_nature_deformity').val();
						var pd_percent_of_deformity_val = $('#pd_percent_of_deformity').val();

						
						var user_data = 'pd_title='+pd_title_val+'&pd_firstname='+pd_firstname_val+'&pd_middlename='+pd_middlename_val+'&pd_lastname='+pd_lastname_val+'&phone_no_code='+pd_mobile_no_code_val+'&pd_mobile_no='+pd_mobile_no_val+'&pd_email='+pd_email_val+'&pd_dob='+pd_dob_val+'&pd_gender='+pd_gender_val+'&pd_alt_email='+pd_alt_email_val+'&pd_blood_group='+pd_blood_group_val+'&pd_nationality='+pd_nationality_val+'&pd_social_status='+pd_social_status_val+'&pd_diffrently_abled='+pd_diffrently_abled_val+'&pd_nature_deformity='+pd_nature_deformity_val+'&pd_percent_of_deformity='+pd_percent_of_deformity_val+'&'+csrfName+'='+csrfHash;
						var moveNxt=0;
						$.ajax({
							type: 'POST',
							url: url,
							data: user_data+'&currentIndex='+currentIndex,
							dataType: 'json',
							cache: false,
							async:false,
							beforeSend: function() { $('.loader').show(); },
							success: function(returndata) {
								console.log(returndata);
								if(returndata) {									
									console.log(returndata);
									var startIndex = currentIndex+1
									window.location.href = url+'?startIndex='+startIndex;
									$("#formerr").hide();
									moveNxt=1;										
								}															  
							},
							error: function(returndata) {
							  moveNxt=0;
							  console.log(returndata);
							  $("#formerr").show(); 							  
							  return false;
							},
						});						  
						if(moveNxt){
							return true;
						}
					  } else { 
						pd_title.validate();
						pd_firstname.validate();
						pd_middlename.validate();
						pd_lastname.validate();
						pd_mobile_no.validate();
						pd_email.validate();
						pd_dob.validate();
						pd_gender.validate();
						pd_alt_email.validate();
						pd_blood_group.validate();
						pd_nationality.validate();
						pd_social_status.validate();
						pd_diffrently_abled.validate();
						pd_nature_deformity.validate();
						pd_percent_of_deformity.validate();
						return false;
					  }
					}

					// Step 3 form validation
					if(currentIndex === 2) {
					  //return true;
					  var country_phd = $('#country_phd').parsley();
					  var state_phd = $('#state_phd').parsley();
					  var district_phd = $('#district_phd').parsley();
					  var city_phd = $('#city_phd').parsley();
					  var address1 = $('#address_line1').parsley();
					  var pincode = $('#pincode').parsley();
					  
					  if(country_phd.isValid() && state_phd.isValid() && district_phd.isValid() 
					  	&& city_phd.isValid() && address1.isValid() && pincode.isValid()) {
					  	var country_id 	= 	$('#country_phd').val();
					  	var state_id 	= 	$('#state_phd').val();
					  	var district_id = 	$('#district_phd').val();
					  	var city_id     = 	$('#city_phd').val();
					  	var address1    =  	$('#address_line1').val();
					  	var address2    =  	$('#address_line2').val();
					  	var pincode 	=	$('#pincode').val();
						var isexit = ($(this).attr('isexit'));
					  	var userData = 'country_id='+country_id+'&state_id='+state_id+'&district_id='+district_id+'&city_id='+city_id+'&address_line_1='+address1+'&address_line_2='+address2+'&pincode='+pincode+'&'+csrfName+'='+csrfHash;
						var moveNxt=0;
							$.ajax({
								type: 'POST',
								url: url,
								data: userData+'&currentIndex='+currentIndex,
								dataType: 'json',
								cache: false,
								async: false,
								beforeSend: function() { $('.loader').show(); },
								success: function(returndata) {
									if(returndata) {
										if(isexit==1){
											window.location.href = save_exit_redirect_url;
											return false;
										}										
										console.log(returndata);
										if(returndata.status == 'true') {
											var startIndex = currentIndex+1
											window.location.href = url+'?startIndex='+startIndex; 
										}	
										$("#formerr").hide();
										moveNxt=1;										
									}
								},
								error: function(returndata) {							  
								  moveNxt=0;
								  console.log(returndata);
								  $("#formerr").show(); 							  
								  return false;
								},
							});
							if(moveNxt){
								return true;
							}							
					  } else { 
						country_phd.validate();
						state_phd.validate();
						district_phd.validate();
						city_phd.validate();
						address1.validate();
						pincode.validate();
						$(this).attr('isexit','');
						return false;
					  }
					}

	                if(currentIndex === 3) {
	                    // return true;
						//return true;
	                    // var valid = $(this).parsley().validate();
	                    var post_graduation_marksheet = $('#post_graduation_marksheet').parsley();
	                    var taken_any_competitive_exam = $('#taken_any_competitive_exam').parsley();
	                    var competitive_exam = $('#competitive_exam').parsley();
	                    var score_card = $('#score_card').parsley();
	                    var name_of_employee = $('#name_of_employee').parsley();
	                    var address_of_employee = $('#address_of_employee').parsley();
	                    var salary_per_month = $('#salary_per_month').parsley();
	                    var organisation_name_0 = $('#organisation_name_0').parsley();
	                    var designation_0 = $('#designation_0').parsley();
	                    var nature_of_job_0 = $('#nature_of_job_0').parsley();
	                    var total_salary_month_0 = $('#total_salary_month_0').parsley();
	                    var from_year_0 = $('#from_year_0').parsley();
	                    var to_year_0 = $('#to_year_0').parsley();
	                    var work_experience_0 = $('#work_experience_0').parsley();
						var organisation_name_1 = $('#organisation_name_1').parsley();
						var designation_1 = $('#designation_1').parsley();
						var nature_of_job_1 = $('#nature_of_job_1').parsley();
						var total_salary_month_1 = $('#total_salary_month_1').parsley();
						var from_year_1 = $('#from_year_1').parsley();
						var to_year_1 = $('#to_year_1').parsley();
						var work_experience_1 = $('#work_experience_1').parsley();
						var organisation_name_2 = $('#organisation_name_2').parsley();
						var designation_2 = $('#designation_2').parsley();
						var nature_of_job_2 = $('#nature_of_job_2').parsley();
						var total_salary_month_2 = $('#total_salary_month_2').parsley();
						var from_year_2 = $('#from_year_2').parsley();
						var to_year_2 = $('#to_year_2').parsley();
						var work_experience_2 = $('#work_experience_2').parsley();					
						
						var obtained_percentage_cgpa_1 = $('#obtained_percentage_cgpa_1').parsley();
						var obtained_percentage_cgpa_2 = $('#obtained_percentage_cgpa_2').parsley();
						var obtained_percentage_cgpa_3 = $('#obtained_percentage_cgpa_3').parsley();
						var degree_diploma_3 = $('#degree_diploma_3').parsley();
						var institute_university_3 = $('#institute_university_3').parsley();
						var user_marking_scheme_3 = $('#user_marking_scheme_3').parsley();
						var year_of_passing_3 = $('#year_of_passing_3').parsley();
						
						var obtained_percentage_cgpa_2 = $('#obtained_percentage_cgpa_2').parsley();
						var degree_diploma_2 = $('#degree_diploma_2').parsley();
						var institute_university_2 = $('#institute_university_2').parsley();
						var user_marking_scheme_2 = $('#user_marking_scheme_2').parsley();
						var year_of_passing_2 = $('#year_of_passing_2').parsley();

						var obtained_percentage_cgpa_1 = $('#obtained_percentage_cgpa_1').parsley();
						var degree_diploma_1 = $('#degree_diploma_1').parsley();
						var institute_university_1 = $('#institute_university_1').parsley();
						var user_marking_scheme_1 = $('#user_marking_scheme_1').parsley();
						var year_of_passing_1 = $('#year_of_passing_1').parsley();
						var major_discipline_1 = $('#major_discipline_1').parsley();
						var major_discipline_2 = $('#major_discipline_2').parsley();
						var major_discipline_3 = $('#major_discipline_3').parsley();
						var tentative_topic_name = $('#tentative_topic_name').parsley();
						var choice_supervisor = $('#choice_supervisor').parsley();

	                    var choice_supervisor = $('#choice_supervisor').parsley();
	                    var tentative_topic_files = $('#tentative_topic_files').parsley();
						
						var publications_title_0 = $('#publications_title_0').parsley();
						var publications_name_of_the_journal_0 = $('#publications_name_of_the_journal_0').parsley();
						var publications_year_0 = $('#publications_year_0').parsley();
						var publications_title_1 = $('#publications_title_1').parsley();
						var publications_name_of_the_journal_1 = $('#publications_name_of_the_journal_1').parsley();
						var publications_year_1 = $('#publications_year_1').parsley();						
						var publications_title_2 = $('#publications_title_2').parsley();
						var publications_name_of_the_journal_2 = $('#publications_name_of_the_journal_2').parsley();
						var publications_year_2 = $('#publications_year_2').parsley();

						var publications_title_3 = $('#publications_title_3').parsley();
						var publications_name_of_the_journal_3 = $('#publications_name_of_the_journal_3').parsley();
						var publications_year_3 = $('#publications_year_3').parsley();
						var phd_major = $('#phd_major').parsley();						
						
	                    var is_work_experience_checked = false;
	                    if($('#is_work_experience_yes').is(':checked')) {
	                        if(name_of_employee.isValid() && address_of_employee.isValid() && salary_per_month.isValid() && organisation_name_0.isValid() && designation_0.isValid() && nature_of_job_0.isValid() && total_salary_month_0.isValid() && from_year_0.isValid() && to_year_0.isValid() && work_experience_0.isValid() && organisation_name_1.isValid() && designation_1.isValid() && nature_of_job_1.isValid() && total_salary_month_1.isValid() && from_year_1.isValid() && to_year_1.isValid() && work_experience_1.isValid() && organisation_name_2.isValid() && designation_2.isValid() && nature_of_job_2.isValid() && total_salary_month_2.isValid() && from_year_2.isValid() && to_year_2.isValid() && work_experience_2.isValid()) {
	                            is_work_experience_checked = true;    
	                        }
	                    } else {
	                        is_work_experience_checked = true;
	                    }
						
						if($('#table5').is(':visible')){
						$('#organisation_name_0').attr('data-parsley-required', 'true');
						$('#organisation_name_0').attr('data-parsley-required-message', '<?php echo REQD_ORG_NAME_MSG;?>');	
						$('#designation_0').attr('data-parsley-required', 'true');
						$('#designation_0').attr('data-parsley-required-message', '<?php echo REQD_DESIGNATION_MSG; ?>');
						$('#nature_of_job_0').attr('data-parsley-required', 'true');
						$('#nature_of_job_0').attr('data-parsley-required-message', '<?php echo REQD_NATURE_JOB_MSG; ?>');
						$('#total_salary_month_0').attr('data-parsley-required', 'true');
						$('#total_salary_month_0').attr('data-parsley-required-message', '<?php echo REQD_TOTAL_SALARY_MONTH_MSG; ?>');
						$('#from_year_0').attr('data-parsley-required', 'true');
						$('#from_year_0').attr('data-parsley-required-message', '<?php echo REQD_FROM_YEAR_MSG; ?>');
						$('#to_year_0').attr('data-parsley-required', 'true');
						$('#to_year_0').attr('data-parsley-required-message', '<?php echo REQD_TO_YEAR_MSG; ?>');
						$('#work_experience_0').attr('data-parsley-required', 'true');
						$('#work_experience_0').attr('data-parsley-required-message', '<?php echo REQD_WORK_EXP_MSG; ?>');
				   }else{
					  $('#organisation_name_0').attr('data-parsley-required', 'false');
					  $('#designation_0').attr('data-parsley-required', 'false');
					  $('#nature_of_job_0').attr('data-parsley-required', 'false');
					  $('#total_salary_month_0').attr('data-parsley-required', 'false');
					  $('#from_year_0').attr('data-parsley-required', 'false');
					  $('#to_year_0').attr('data-parsley-required', 'false');
					  $('#work_experience_0').attr('data-parsley-required', 'false');
					}
			
	                    if(is_work_experience_checked == true && post_graduation_marksheet.isValid() && taken_any_competitive_exam.isValid() && competitive_exam.isValid() && score_card.isValid() && choice_supervisor.isValid() && tentative_topic_files.isValid() && obtained_percentage_cgpa_3.isValid() && obtained_percentage_cgpa_2.isValid() && obtained_percentage_cgpa_1.isValid() && degree_diploma_3.isValid() && institute_university_3.isValid() && user_marking_scheme_3.isValid() && year_of_passing_3.isValid() && degree_diploma_2.isValid() && institute_university_2.isValid() && user_marking_scheme_2.isValid() && year_of_passing_2.isValid() && degree_diploma_1.isValid() && institute_university_1.isValid() && user_marking_scheme_1.isValid() && year_of_passing_1.isValid() && major_discipline_3.isValid() && major_discipline_2.isValid() && major_discipline_1.isValid() && publications_title_0.isValid() && publications_name_of_the_journal_0.isValid() && publications_year_0.isValid() && publications_title_1.isValid() && publications_name_of_the_journal_1.isValid() && publications_year_1.isValid() && publications_title_2.isValid() && publications_name_of_the_journal_2.isValid() && publications_year_2.isValid() && publications_title_3.isValid() && publications_name_of_the_journal_3.isValid() && publications_year_3.isValid() && phd_major.isValid() && tentative_topic_name.isValid() && choice_supervisor.isValid()) {
	                        
	                        var grad_id_1 = $('#grad_id_1').val();
	                        var degree_diploma_1 = $('#degree_diploma_1').val();
	                        var institute_university_1 = $('#institute_university_1').val();
	                        var major_discipline_1 = $('#major_discipline_1').val();
	                        var user_marking_scheme_1 = $('#user_marking_scheme_1').val();
	                        var obtained_percentage_cgpa_1 = $('#obtained_percentage_cgpa_1').val();
	                        var year_of_passing_1 = $('#year_of_passing_1').val();
	                        var grad_id_2 = $('#grad_id_2').val();
	                        var degree_diploma_2 = $('#degree_diploma_2').val();
	                        var institute_university_2 = $('#institute_university_2').val();
	                        var major_discipline_2 = $('#major_discipline_2').val();
	                        var user_marking_scheme_2 = $('#user_marking_scheme_2').val();
	                        var obtained_percentage_cgpa_2 = $('#obtained_percentage_cgpa_2').val();
	                        var year_of_passing_2 = $('#year_of_passing_2').val();
	                        var grad_id_3 = $('#grad_id_3').val();
	                        var degree_diploma_3 = $('#degree_diploma_3').val();
	                        var institute_university_3 = $('#institute_university_3').val();
	                        var major_discipline_3 = $('#major_discipline_3').val();
	                        var user_marking_scheme_3 = $('#user_marking_scheme_3').val();
	                        var obtained_percentage_cgpa_3 = $('#obtained_percentage_cgpa_3').val();
	                        var year_of_passing_3 = $('#year_of_passing_3').val();
							
	                        //var is_work_experience = $('input[name=is_work_experience]').val();
							if($('#is_work_experience_yes').is(':checked')){
								var is_work_experience = 'yes';
							}else if($('#is_work_experience_no').is(':checked')){
								var is_work_experience = 'no';
							}							
	                        var name_of_employee = $('#name_of_employee').val();
	                        var address_of_employee = $('#address_of_employee').val();
	                        var salary_per_month = $('#salary_per_month').val();

	                        var prof_exp_id_0 = $('#prof_exp_id_0').val();
	                        var organisation_name_0 = $('#organisation_name_0').val();
	                        var designation_0 = $('#designation_0').val();
	                        var nature_of_job_0 = $('#nature_of_job_0').val();
	                        var total_salary_month_0 = $('#total_salary_month_0').val();
	                        var from_year_0 = $('#from_year_0').val();
	                        var to_year_0 = $('#to_year_0').val();
	                        var work_experience_0 = $('#work_experience_0').val();
	                        var prof_exp_id_1 = $('#prof_exp_id_1').val();
	                        var organisation_name_1 = $('#organisation_name_1').val();
	                        var designation_1 = $('#designation_1').val();
	                        var nature_of_job_1 = $('#nature_of_job_1').val();
	                        var total_salary_month_1 = $('#total_salary_month_1').val();
	                        var from_year_1 = $('#from_year_1').val();
	                        var to_year_1 = $('#to_year_1').val();
	                        var work_experience_1 = $('#work_experience_1').val();
	                        var prof_exp_id_2 = $('#prof_exp_id_2').val();
	                        var organisation_name_2 = $('#organisation_name_2').val();
	                        var designation_2 = $('#designation_2').val();
	                        var nature_of_job_2 = $('#nature_of_job_2').val();
	                        var total_salary_month_2 = $('#total_salary_month_2').val();
	                        var from_year_2 = $('#from_year_2').val();
	                        var to_year_2 = $('#to_year_2').val();
	                        var work_experience_2 = $('#work_experience_2').val();

	                        var total_work_experience = $('#total_work_experience').val();


	                        var taken_any_competitive_exam = $('#taken_any_competitive_exam').val();
	                        var competitive_exam = $('#competitive_exam').val();
	                        
	                        var publn_det_id_0 = $('#publn_det_id_0').val();
	                        var publications_title_0 = $('#publications_title_0').val();
	                        var publications_name_of_the_journal_0 = $('#publications_name_of_the_journal_0').val();
	                        var publications_year_0 = $('#publications_year_0').val();
	                        var publn_det_id_1 = $('#publn_det_id_1').val();
	                        var publications_title_1 = $('#publications_title_1').val();
	                        var publications_name_of_the_journal_1 = $('#publications_name_of_the_journal_1').val();
	                        var publications_year_1 = $('#publications_year_1').val();
	                        var publn_det_id_2 = $('#publn_det_id_2').val();
	                        var publications_title_2 = $('#publications_title_2').val();
	                        var publications_name_of_the_journal_2 = $('#publications_name_of_the_journal_2').val();
	                        var publications_year_2 = $('#publications_year_2').val();
	                        var publn_det_id_3 = $('#publn_det_id_3').val();
	                        var publications_title_3 = $('#publications_title_3').val();
	                        var publications_name_of_the_journal_3 = $('#publications_name_of_the_journal_3').val();
	                        var publications_year_3 = $('#publications_year_3').val();
	                        
	                        var phd_major = $('#phd_major').val();
	                        var tentative_topic_name = $('#tentative_topic_name').val();
	                        var choice_supervisor = $('#choice_supervisor').val();
							var isexit = $(this).attr('isexit');
							// Get Regenerated CSRF Dynamically
							var csrfHashRegenerateAD = $("input[name='"+csrfName+"']").val();

	                        var user_data = 'grad_id_1='+grad_id_1+'&degree_diploma_1='+degree_diploma_1+'&institute_university_1='+institute_university_1+'&major_discipline_1='+major_discipline_1+'&user_marking_scheme_1='+user_marking_scheme_1+'&obtained_percentage_cgpa_1='+obtained_percentage_cgpa_1+'&year_of_passing_1='+year_of_passing_1+'&grad_id_2='+grad_id_2+'&degree_diploma_2='+degree_diploma_2+'&institute_university_2='+institute_university_2+'&major_discipline_2='+major_discipline_2+'&user_marking_scheme_2='+user_marking_scheme_2+'&obtained_percentage_cgpa_2='+obtained_percentage_cgpa_2+'&year_of_passing_2='+year_of_passing_2+'&grad_id_3='+grad_id_3+'&degree_diploma_3='+degree_diploma_3+'&institute_university_3='+institute_university_3+'&major_discipline_3='+major_discipline_3+'&user_marking_scheme_3='+user_marking_scheme_3+'&obtained_percentage_cgpa_3='+obtained_percentage_cgpa_3+'&year_of_passing_3='+year_of_passing_3+'&is_work_experience='+is_work_experience+'&name_of_employee='+name_of_employee+'&address_of_employee='+address_of_employee+'&salary_per_month='+salary_per_month+'&prof_exp_id_0='+prof_exp_id_0+'&organisation_name_0='+organisation_name_0+'&designation_0='+designation_0+'&nature_of_job_0='+nature_of_job_0+'&total_salary_month_0='+total_salary_month_0+'&from_year_0='+from_year_0+'&to_year_0='+to_year_0+'&work_experience_0='+work_experience_0+'&prof_exp_id_1='+prof_exp_id_1+'&organisation_name_1='+organisation_name_1+'&designation_1='+designation_1+'&nature_of_job_1='+nature_of_job_1+'&total_salary_month_1='+total_salary_month_1+'&from_year_1='+from_year_1+'&to_year_1='+to_year_1+'&work_experience_1='+work_experience_1+'&prof_exp_id_2='+prof_exp_id_2+'&organisation_name_2='+organisation_name_2+'&designation_2='+designation_2+'&nature_of_job_2='+nature_of_job_2+'&total_salary_month_2='+total_salary_month_2+'&from_year_2='+from_year_2+'&to_year_2='+to_year_2+'&work_experience_2='+work_experience_2+'&total_work_experience='+total_work_experience+'&taken_any_competitive_exam='+taken_any_competitive_exam+'&competitive_exam='+competitive_exam+'&publn_det_id_0='+publn_det_id_0+'&publications_title_0='+publications_title_0+'&publications_name_of_the_journal_0='+publications_name_of_the_journal_0+'&publications_year_0='+publications_year_0+'&publn_det_id_1='+publn_det_id_1+'&publications_title_1='+publications_title_1+'&publications_name_of_the_journal_1='+publications_name_of_the_journal_1+'&publications_year_1='+publications_year_1+'&publn_det_id_2='+publn_det_id_2+'&publications_title_2='+publications_title_2+'&publications_name_of_the_journal_2='+publications_name_of_the_journal_2+'&publications_year_2='+publications_year_2+'&publn_det_id_3='+publn_det_id_3+'&publications_title_3='+publications_title_3+'&publications_name_of_the_journal_3='+publications_name_of_the_journal_3+'&publications_year_3='+publications_year_3+'&phd_major='+phd_major+'&tentative_topic_name='+tentative_topic_name+'&choice_supervisor='+choice_supervisor+'&'+csrfName+'='+csrfHashRegenerateAD;
							var moveNxt=0;
	                        $.ajax({
	                            type: 'POST',
	                            url: url,
	                            data: user_data+'&currentIndex='+currentIndex,
	                            dataType: 'json',
	                            cache: false,
								beforeSend: function() { $('.loader').show(); },
	                            success: function(returndata) {
									if(returndata) {				
										if(isexit==1){
											window.location.href = save_exit_redirect_url;
											return false;
										}									
										console.log(returndata);
										var startIndex = currentIndex+1
										window.location.href = url+'?startIndex='+startIndex;
										$("#formerr").hide();
										moveNxt=1;											
									}
	                            },
	                            error: function(returndata) {
								  moveNxt=0;
								  console.log(returndata);
								  $("#formerr").show(); 							  
								  return false;
	                            },
	                        }); 
							if(moveNxt){
								return true;
							}     
	                    } else {
	                    	post_graduation_marksheet.validate();
	                    	name_of_employee.validate();
	                    	address_of_employee.validate();
	                    	salary_per_month.validate();
	                    	organisation_name_0.validate();
	                    	designation_0.validate();
	                    	nature_of_job_0.validate();
	                    	total_salary_month_0.validate();
	                    	from_year_0.validate();
	                    	to_year_0.validate();
	                    	work_experience_0.validate();
							organisation_name_1.validate();
							designation_1.validate();
							nature_of_job_1.validate();
							total_salary_month_1.validate();
							from_year_1.validate();
							to_year_1.validate();
							work_experience_1.validate();	
							organisation_name_2.validate();
							designation_2.validate();
							nature_of_job_2.validate();
							total_salary_month_2.validate();
							from_year_2.validate();
							to_year_2.validate();
							work_experience_2.validate();							
	                    	taken_any_competitive_exam.validate();
	                    	competitive_exam.validate();
	                    	score_card.validate();
	                    	choice_supervisor.validate();
	                    	tentative_topic_files.validate();
							obtained_percentage_cgpa_1.validate();
							obtained_percentage_cgpa_2.validate();
							obtained_percentage_cgpa_3.validate();
							degree_diploma_3.validate();
							institute_university_3.validate();
							user_marking_scheme_3.validate();
							year_of_passing_3.validate();
							degree_diploma_2.validate();
							institute_university_2.validate();
							user_marking_scheme_2.validate();
							year_of_passing_2.validate();
							degree_diploma_1.validate();
							institute_university_1.validate();
							user_marking_scheme_1.validate();
							year_of_passing_1.validate();
							major_discipline_1.validate();
							major_discipline_2.validate();
							major_discipline_3.validate();
							publications_title_0.validate();
							publications_name_of_the_journal_0.validate();
							publications_year_0.validate();
							publications_title_1.validate();
							publications_name_of_the_journal_1.validate();
							publications_year_1.validate();
							publications_title_2.validate();
							publications_name_of_the_journal_2.validate();
							publications_year_2.validate();
							publications_title_3.validate();
							publications_name_of_the_journal_3.validate();
							publications_year_3.validate();
							phd_major.validate();
							tentative_topic_name.validate();
							choice_supervisor.validate();
							$(this).attr('isexit','');
	                        return false;
	                    }
	                }
					
					if(currentIndex == 5) {
						
						var applicant_name = $('#applicant_name').parsley();
						
						if(applicant_name.isValid()) {
							var applicant_name = $('#applicant_name').val();
							var declaration_date = $('#date_dec').val();
					
							var user_data = 'applicant_name='+applicant_name+'&declaration_date='+declaration_date+'&'+csrfName+'='+csrfHash;
							$.ajax({
								type: 'POST',
								url: url,
								data: user_data+'&currentIndex='+currentIndex,
								dataType: 'json',
								cache: false,
								beforeSend: function() { $('.loader').show(); },
								success: function(returndata) {
									if(returndata) {									
										console.log(returndata);
										var startIndex = currentIndex+1
										window.location.href = url+'?startIndex='+startIndex;setTimeout(function() { 
											$('.loader').hide();
										},100);											
										$("#formerr").hide();
										moveNxt=1;	
									}
								},
								error: function(returndata) {
								  moveNxt=0;
								  console.log(returndata);
								  $("#formerr").show(); 							  
								  return false;
								},
							});
							if(moveNxt){
								return true;
							}							
						}else {
							applicant_name.validate();
							return false;
						}
					}
	                if(currentIndex === 4) {
	                	check_visible_input_validation('payment_details','BankName','<?php echo REQD_CHOOSE_BANK_MSG; ?>',false);
						
						check_visible_input_validation('payment_details','BranchName','<?php echo REQD_BANK_NAME_MSG; ?>',false);
						
						check_visible_input_validation('payment_details','DDNumber','<?php echo REQD_DD_NO_MSG; ?>',false);
						
						check_visible_input_validation('payment_details','DDDate','<?php echo REQD_DD_DATE_MSG; ?>',false);
						var bank_name = $('#BankName').parsley();
						var branch_name = $('#BranchName').parsley();
						var ddnumber = $('#DDNumber').parsley();
						var ddate = $('#DDDate').parsley();
						var online = $('#online').parsley();
						var dd = $('#dd').parsley();
						// check the payment type selection
						if($('#online').is(':checked')){
								var payment_mode = 'online';
						}else if($('#dd').is(':checked')){
								var payment_mode = 'dd';
						}
						if(bank_name.isValid() && branch_name.isValid() && ddnumber.isValid() && ddate.isValid() && online.isValid() && dd.isValid()){
                            if(payment_mode=="dd"){
								var bank_name = $('#BankName').val();
								var branch_name = $('#BranchName').val();
								var dd_cheque_no = $('#DDNumber').val();
								var dd_cheque_date = $('#DDDate').val();
								var user_data = 'bank_name='+bank_name+'&branch_name='+branch_name+'&dd_cheque_no='+dd_cheque_no+'&dd_cheque_date='+dd_cheque_date+'&payment_mode='+payment_mode+'&app_form_id='+app_form_id+'&'+csrfName+'='+csrfHash;
								var moveNxt=0;
								<?php if(empty($applicant_payment_details_list)) { ?> 
								$.ajax({
									type: 'POST',
									url: payment_url,
									data: user_data,
									dataType: 'json',
									cache: false,
									async: false,
									beforeSend: function() { $('.loader').show(); },
									success: function(returndata) {
										if(returndata) {	
											if(returndata.status == 'true') {
												setTimeout(function() { window.location.href = redirect_payment_thank_you+'&payment_mode='+payment_mode+'&currentIndex='+currentIndex+url_edit; }, 500);
												$("#formerr").hide();
												moveNxt=1;
											}								
										}
									},
									error: function(returndata) { 
										  console.log(returndata);
										  moveNxt=0;							
										  $("#formerr").show();
										  $('.loader').hide(); 							   
										return false;
									},									
								});			
								<?php }else{ ?>
									setTimeout(function() { 
										$('.loader').hide();
									},100);			
									$("#formerr").hide();
									moveNxt=1;						
									return true;									
								<?php } ?>
                            }
                            if (payment_mode=='online')	
    						{		<?php if(empty($applicant_payment_details_list)) { ?>
    								  window.location.href = '<?php echo base_url(); ?>user/payment_process?app_form_id='+app_form_id+'&index='+currentIndex+url_edit;
    			                     <?php } else { ?>
    			                     return true;
    			                     <?php }?>
    						}
							
						}else{
							bank_name.validate();
							branch_name.validate();
							ddnumber.validate();
							ddate.validate();
							dd.validate();
							online.validate();
							return false;
						}
	                }

	                if(currentIndex === 6) {
	                }
				}
				else { 
					return true; 
				}	
	        },
	        onStepChanged: function (event, currentIndex, priorIndex) {
	        	var isexit=($(this).attr('isexit'));        	
	        	if(isexit!='undefined' &&  isexit==1)
	        	{
					window.location.href = save_exit_redirect_url; 
	        	}
	        	if(currentIndex==3){
					$(".actions ul > li:nth-child(2) a").text('<?php echo MAKE_PAYMENT; ?>');
				}else{
					$(".actions ul > li:nth-child(2) a").text('<?php echo NEXT_STEP; ?>');
				}

				if(currentIndex == 4) {
					// applicant info in payment page
					set_application_payment_info();     
				}
				enable_saveExit_btn(currentIndex,4);
				// form preview button displayed
				if(currentIndex == parseInt(total_wizard_Step - 1)){
					$("#save_exit").remove();
					if(mode_edit_url !=''){
						enable_preview_btn(currentIndex,'<?php echo base_url();?>phd-jan-preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
					}else{
						enable_preview_btn(currentIndex,'<?php echo base_url();?>phd-jan-preview');
					}					
				}else{
					$("#previewbtn").remove();
				}
				// This code for step count display in view part like STEPS 1 OF 7
				$("#show_currentindex").text(currentIndex+1+' Of '+total_wizard_Step);			
			}, 
	        onCanceled: function (event) { },
	        onFinishing: function (event, currentIndex) { return true; }, 
	        onFinished: function (event, currentIndex) { 
	            wizard_final_step(url,currentIndex,redirect);
	        },

	        /* Labels */
	        labels: {
	            cancel: "Cancel",
	            current: "current step:",
	            pagination: "Pagination",
				finish: "<?php echo FORM_SUBMIT_VALUE; ?>",
				next: "<?php echo WIZARD_NEXT; ?>",
				previous: "<?php echo WIZARD_PREVIOUS; ?>",
	            loading: "Loading ..."
	        }
	    }

    	$("#phd_jan_form").steps(settings);
		//setsave exit attr	
	    $(document).on("click", "#save_btn" , function() {
	    	 $("#phd_jan_form").attr('isexit',1);
	         $("#phd_jan_form").steps('next');
        });
        
        $('.actions a').click(function(){        	 
          $("#phd_jan_form").attr('isexit','');
        }); 
       //end set attr
		//to remove links from previous tabs a
	    <?php if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) && ($mode_edit == '')) { ?>
	     $( ".steps li" ).each(function( index ) { 
	      if(index<=4){       	 
	   	  $("#phd_jan_form-t-"+index).removeAttr("href");
	     }			   
	   	});
	    <?php } ?>
		light_box_init();
        // $(document).ready(function () {
            // 'use strict';
            $('#academic_accordion').click();

			
			var no_qualifying_degree_msg = "<?php echo NO_QUALIFYING_DEGREE_MSG; ?>";
			var no_spec_qualifying_degree_msg = "<?php echo NO_QUALIFYING_SPL_DEGREE_MSG; ?>";
			var no_nationality_msg = "<?php echo NO_NATIONALITY_MSG; ?>";
			var no_blood_grp_msg = "<?php echo NO_BLOOD_GROUP_MSG; ?>";
			var no_country_msg = "<?php echo NO_COUNTRY_MSG; ?>";
			var no_state_msg = "<?php echo NO_STATE_MSG; ?>";
			var no_city_msg = "<?php echo NO_CITY_MSG; ?>";
			var no_mobile_code_msg = "<?php echo NO_MOBILE_CODE_MSG; ?>";
			var no_working_dsc_msg = "<?php echo NO_WORKING_DSC_MSG; ?>";
			var no_faculty_msg =  "<?php echo NO_FACULTY_MSG; ?>";
			var no_category_msg = "<?php echo NO_CATEGORY_MSG; ?>";
			var no_work_experience_msg = "<?php echo NO_WE_MSG; ?>";
			var no_working_place_msg = "<?php echo NO_WORKING_PLACE_MSG; ?>";
			var no_gender_title_msg = "<?php echo NO_TITLE_MSG; ?>";
			var no_gender_msg = "<?php echo NO_GENDER_MSG; ?>";
			var no_blood_group_msg = "<?php echo NO_BLOOD_GROUP_MSG; ?>";
			var no_social_status_msg = "<?php echo NO_SOCIAL_STATUS_MSG; ?>";
			var no_differently_abled_msg = "<?php echo NO_DIFFRENTLY_ABLED_MSG; ?>";
			var no_nature_deformity_msg = "<?php echo NO_ND_MSG; ?>";
			var no_percent_deformity_msg = "<?php echo NO_PD_MSG; ?>";
            var no_institute_university_msg = "<?php echo NO_IU_MSG; ?>";
            var no_user_marking_scheme_msg = "<?php echo NO_USER_MARKING_SCHEME_MSG; ?>";
            var no_taken_any_competitive_exam_msg = "<?php echo NO_COMP_EXAM_MSG; ?>";
            var no_competitive_exam_msg = "<?php echo NO_COMP_EXAM_MSG; ?>";
			var no_banks_msg =  "<?php echo NO_BANKS_MSG; ?>";
			var no_district_msg = "<?php echo NO_DISTRICT_MSG; ?>";
			

			getSelect2('pd_nationality','<?php echo base_url("get_nationalities"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Nationality', formatRepoCommon,no_nationality_msg, false, formatRepoSelection);
			
			getSelect2('bloodgroups','<?php echo base_url("get_bloodgroups"); ?>?sort_by=blood_grp_id&sort_order=asc'+url_edit,'Choose Blood Groups', formatRepoCommon,no_blood_grp_msg, false, formatRepoSelection);
			
			getSelect2('country_phd','<?php echo base_url("get_countries"); ?>?sort_by=country_id&sort_order=asc'+url_edit,'Choose Country', formatRepoCommon,no_country_msg, false, formatRepoSelection);	

			getSelect2('phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);

			getSelect2('qualifying_degree','<?php echo base_url("get_qualifying_degree"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Qualifying Degree', formatRepoCommon,no_qualifying_degree_msg, false, formatRepoSelection);
			
			getSelect2('specialization_qualifying_degree','<?php echo base_url("get_spec_qualifying_degree"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Specialization Qualifying Degree', formatRepoCommon,no_spec_qualifying_degree_msg, false, formatRepoSelection);

			getSelect2('working_dsc','<?php echo base_url("get_working_dsc"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Department / College / School', formatRepoCommon,no_working_dsc_msg, false, formatRepoSelection);
			
			getSelect2('faculty','<?php echo base_url("get_faculty"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Faculty', formatRepoCommon,no_faculty_msg, false, formatRepoSelection);

			getSelect2('category','<?php echo base_url("get_work_category"); ?>?is_lookup_master=1'+url_edit,'Choose Category', formatRepoCommon,no_category_msg, false, formatRepoSelection);
			
			getSelect2('is_employed','<?php echo base_url("get_are_you_employed"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Working Type', formatRepoCommon,no_work_experience_msg, false, formatRepoSelection);			

			getSelect2('working_place','<?php echo base_url("get_working_place"); ?>?is_lookup_master=1'+url_edit,'Choose Working Place', formatRepoCommon,no_working_place_msg, false, formatRepoSelection);

			getSelect2('pd_title','<?php echo base_url("get_gender_title"); ?>?is_lookup_master=1'+url_edit,'Choose Title', formatRepoCommon,no_gender_title_msg, false, formatRepoSelection);
			
			getSelect2('pd_gender','<?php echo base_url("get_gender"); ?>?is_lookup_master=1'+url_edit,'Choose Gender', formatRepoCommon,no_gender_msg, false, formatRepoSelection);
			
			getSelect2('pd_blood_group','<?php echo base_url("get_bloodgroups"); ?>?sort_by=blood_grp_id&sort_order=asc'+url_edit,'Choose Blood Groups', formatRepoCommon,no_blood_group_msg, false, formatRepoSelection);
			
			getSelect2('pd_social_status','<?php echo base_url("get_social_status"); ?>?is_lookup_master=1'+url_edit,'Choose Social Status', formatRepoCommon,no_social_status_msg, false, formatRepoSelection);
	
			getSelect2('pd_diffrently_abled','<?php echo base_url("get_are_you_differently_abled"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Differently Abled', formatRepoCommon,no_differently_abled_msg, false, formatRepoSelection);
			
			getSelect2('pd_nature_deformity','<?php echo base_url("get_nature_of_deformity"); ?>?is_lookup_master=1'+url_edit,'Choose Nature Of Deformity', formatRepoCommon,no_nature_deformity_msg, false, formatRepoSelection);
			
			getSelect2('pd_percent_of_deformity','<?php echo base_url("get_percentage_of_deformity"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Percentage Of Deformity', formatRepoCommon,no_percent_deformity_msg, false, formatRepoSelection);

            getSelect2('institute_university_1','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Institute/University', formatRepoCommon,no_institute_university_msg, false, formatRepoSelection);
            getSelect2('institute_university_2','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Institute/University', formatRepoCommon,no_institute_university_msg, false, formatRepoSelection);
            getSelect2('institute_university_3','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Institute/University', formatRepoCommon,no_institute_university_msg, false, formatRepoSelection);            

            getSelect2('user_marking_scheme_1','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
            getSelect2('user_marking_scheme_2','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
            getSelect2('user_marking_scheme_3','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

            getSelect2('taken_any_competitive_exam','<?php echo base_url("get_have_you_taken_any_competitive_exam"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Status', formatRepoCommon,no_taken_any_competitive_exam_msg, false, formatRepoSelection);

            getSelect2('competitive_exam','<?php echo base_url("get_competitive_exams"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Competitive Exam', formatRepoCommon,no_competitive_exam_msg, false, formatRepoSelection);

            getSelect2('BankName','<?php echo base_url("get_banks"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Bank', formatRepoCommon,no_banks_msg, false, formatRepoSelection);

            select2load('BankName','<?php echo $applicant_payment_details_list['bank_id']; ?>','<?php echo $applicant_payment_details_list['bank_name']; ?>');
			
			// Onchange COuntry
			$('#country_phd').on('change',function() {
				setEmptyOnChangeSelect2('state_phd'); 
				// when no values return in json, add empty option value 
				if ($('#state_phd').data('select2')) {$('#state_phd').select2('destroy');}
				$('#custom-state_phd-parsley-error').show();
				// make empty
				$('#state_phd').html('');
				var country_val = $(this).val();
				var url = '<?php echo base_url("get_states"); ?>?country_id='+country_val+	'&sort_by=id&sort_order=asc'+url_edit;
				onchange_country('main_div_state','main_div_district','main_div_city','state_phd','city_phd','district_phd',url,no_state_msg,country_value_default,country_val)
			});	
		
		 	// Onchange State
			$('#state_phd').on('change',function() {
				setEmptyOnChangeSelect2('district');
				// when no values return in json, add empty option value 
				if ($('#district_phd').data('select2')) {$('#district_phd').select2('destroy');
					// make empty
					$('#district_phd,#city_phd').html(''); 
				}		
				$('#custom-district_phd-parsley-error').show();
			
				var state_val = $(this).val();
				var country_val = $('#country_phd').val();
				var url = '<?php echo base_url("get_district"); ?>?state_id='+state_val+'&sort_by=id&sort_order=asc'+url_edit;
				if(country_value_default==country_val){	
					$('#main_div_district').show();
					getSelect2('district_phd',url,'Select District', formatRepoCommon,no_district_msg, false, formatRepoSelection);
				}
			});
			
			// Onchange District
			$('#district_phd').on('change',function() {
				setEmptyOnChangeSelect2('city_phd');
				// when no values return in json, add empty option value 
				if ($('#city_phd').data('select2')) {$('#city_phd').select2('destroy');}		
				$('#custom-city_phd-parsley-error').show();
				// make empty
				$('#city_phd').html(''); 			
				var state_val = $('#state_phd').val();
				var country_val = $('#country_phd').val();
				if(country_value_default==country_val){	
					$('#main_div_city').show();
					getSelect2('city_phd','<?php echo base_url("get_cities"); ?>?state_id='+state_val+'&sort_by=id&sort_order=asc'+url_edit,'Select City', formatRepoCommon,no_city_msg, false, formatRepoSelection);
				}
			});				

			// Basic Details On Change Start
			$('#category').on('change',function() {
				var category = $("#category").val();
				setEmptyOnChangeSelect2('is_employed');
				if ($('#is_employed').data('select2')) {
					$('#is_employed').select2('destroy');
				}				
				
				$('#is_employed').html(''); // reset select values for, if user selected the value then change the country code, then select same value, and value will be null, that so we reset the select values
				
				getSelect2('is_employed','<?php echo base_url("get_are_you_employed"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Working Type', formatRepoCommon,no_work_experience_msg, false, formatRepoSelection);	
				
				if(part_time_external==category){
					$("#main_div_is_employed").show();
					$('#category_check').val('1')
				}else{
					$("#main_div_is_employed").hide();
					$("#main_div_working_place").hide();
				}
			});
						
			$('#is_employed').on('change',function() {
				var is_employed = $("#is_employed").val();
				console.log("is_employed "+is_employed);
				
				if(is_employed=='yes'){
					$("#main_div_working_place").show();
				}else{
					$("#main_div_working_place").hide();
				}
			});	
			
			// Other Input Enable
			$('#qualifying_degree').on('change',function() {
				var qualifying_degree = $("#qualifying_degree").val();
				// console.log("qualifying_degree "+qualifying_degree);
				// if(qualifying_degree=='22'){
				// 	$("#other_qd").show();
				// }else{
				// 	$("#other_qd").hide();
				// 	$("#qualifying_degree_other").val('');
				// }
			});

			$('#specialization_qualifying_degree').on('change',function() {
				var specialization_qualifying_degree = $("#specialization_qualifying_degree").val();
				// console.log("specialization_qualifying_degree "+specialization_qualifying_degree);
				// if(specialization_qualifying_degree=='23'){
				// 	$("#other_sqd").show();
				// }else{
				// 	$("#other_sqd").hide();
				// 	$("#spec_qualifying_degree_other").val('');
				// }
			});	

			$('#working_dsc').on('change',function() {
				var working_dsc = $("#working_dsc").val();
				// console.log("working_dsc "+working_dsc);
				// if(working_dsc=='1'){
				// 	$("#other_dept").show();
				// }else{
				// 	$("#other_dept").hide();
				// 	$("#dept_other").val('');
				// }
			});	

			$('#faculty').on('change',function() {
				var faculty = $("#faculty").val();
				// console.log("faculty "+faculty);
				// if(faculty=='2'){
				// 	$("#other_faculty").show();
				// }else{
				// 	$("#other_faculty").hide();
				// 	$("#faculty_other").val('');
				// }
			});

			$('#working_place').on('change',function() {
				var working_place = $("#working_place").val();
				console.log("working_place "+working_place);
				if(working_place=='260'){
					$("#other_working_place").show();
				}else{
					$("#other_working_place").hide();
					$("#work_place_other").val('');
				}
			});			
			
			
			// Basic Details On Change End
			
			// Personal Details On Change Start
			
			$('#pd_nationality').on('change',function() {
				var pd_nationality = $("#pd_nationality").val();
				console.log("pd_nationality "+pd_nationality);
	
				if(pd_nationality==country_value_default){
					$("#main_div_social_status").show();
					$("#pd_social_status").prepend("<option value=''>Choose Social Status</option>").val('');
				}else{
					$("#main_div_social_status").hide();
				}
			});

			
			onkeyValidation('degree_diploma_2','major_discipline_2','institute_university_2','user_marking_scheme_2','year_of_passing_2','obtained_percentage_cgpa_2');
			onkeyValidation('institute_university_2','major_discipline_2','degree_diploma_2','user_marking_scheme_2','year_of_passing_2','obtained_percentage_cgpa_2');
			onkeyValidation('major_discipline_2','institute_university_2','degree_diploma_2','user_marking_scheme_2','year_of_passing_2','obtained_percentage_cgpa_2');
			onkeyValidation('user_marking_scheme_2','institute_university_2','degree_diploma_2','major_discipline_2','year_of_passing_2','obtained_percentage_cgpa_2');
			onkeyValidation('obtained_percentage_cgpa_2','institute_university_2','degree_diploma_2','major_discipline_2','year_of_passing_2','user_marking_scheme_2');
			onkeyValidation('year_of_passing_2','institute_university_2','degree_diploma_2','major_discipline_2','obtained_percentage_cgpa_2','user_marking_scheme_2');			
	

			onkeyValidation('degree_diploma_3','major_discipline_3','institute_university_3','user_marking_scheme_3','year_of_passing_3','obtained_percentage_cgpa_3');
			onkeyValidation('institute_university_3','major_discipline_3','degree_diploma_3','user_marking_scheme_3','year_of_passing_3','obtained_percentage_cgpa_3');
			onkeyValidation('major_discipline_3','institute_university_3','degree_diploma_3','user_marking_scheme_3','year_of_passing_3','obtained_percentage_cgpa_3');
			onkeyValidation('user_marking_scheme_3','institute_university_3','degree_diploma_3','major_discipline_3','year_of_passing_3','obtained_percentage_cgpa_3');
			onkeyValidation('obtained_percentage_cgpa_3','institute_university_3','degree_diploma_3','major_discipline_3','year_of_passing_3','user_marking_scheme_3');
			onkeyValidation('year_of_passing_3','institute_university_3','degree_diploma_3','major_discipline_3','obtained_percentage_cgpa_3','user_marking_scheme_3');

			onkeyValidationPexp('organisation_name_1','designation_1','nature_of_job_1','total_salary_month_1','from_year_1','to_year_1');
			onkeyValidationPexp('designation_1','organisation_name_1','nature_of_job_1','total_salary_month_1','from_year_1','to_year_1');
			onkeyValidationPexp('nature_of_job_1','organisation_name_1','designation_1','total_salary_month_1','from_year_1','to_year_1');
			onkeyValidationPexp('total_salary_month_1','organisation_name_1','designation_1','nature_of_job_1','from_year_1','to_year_1');
			onkeyValidationPexp('from_year_1','organisation_name_1','designation_1','nature_of_job_1','total_salary_month_1','to_year_1');
			onkeyValidationPexp('to_year_1','organisation_name_1','designation_1','nature_of_job_1','total_salary_month_1','from_year_1');
			

			onkeyValidationPexp('organisation_name_2','designation_2','nature_of_job_2','total_salary_month_2','from_year_2','to_year_2');
			onkeyValidationPexp('designation_2','organisation_name_2','nature_of_job_2','total_salary_month_2','from_year_2','to_year_2');
			onkeyValidationPexp('nature_of_job_2','organisation_name_2','designation_2','total_salary_month_2','from_year_2','to_year_2');
			onkeyValidationPexp('total_salary_month_2','organisation_name_2','designation_2','nature_of_job_2','from_year_2','to_year_2');
			onkeyValidationPexp('from_year_2','organisation_name_2','designation_2','nature_of_job_2','total_salary_month_2','to_year_2');
			onkeyValidationPexp('to_year_2','organisation_name_2','designation_2','nature_of_job_2','total_salary_month_2','from_year_2');
			
			onkeyValidationPub('publications_title_0','publications_name_of_the_journal_0','publications_year_0');
			onkeyValidationPub('publications_name_of_the_journal_0','publications_title_0','publications_year_0');
			onkeyValidationPub('publications_year_0','publications_title_0','publications_name_of_the_journal_0');
			onkeyValidationPub('publications_title_1','publications_name_of_the_journal_1','publications_year_1');
			onkeyValidationPub('publications_name_of_the_journal_1','publications_title_1','publications_year_1');
			onkeyValidationPub('publications_year_1','publications_title_1','publications_name_of_the_journal_1');
			onkeyValidationPub('publications_title_2','publications_name_of_the_journal_2','publications_year_2');
			onkeyValidationPub('publications_name_of_the_journal_2','publications_title_2','publications_year_2');
			onkeyValidationPub('publications_year_2','publications_title_2','publications_name_of_the_journal_2');	
			onkeyValidationPub('publications_title_3','publications_name_of_the_journal_3','publications_year_3');
			onkeyValidationPub('publications_name_of_the_journal_3','publications_title_3','publications_year_3');
			onkeyValidationPub('publications_year_3','publications_title_3','publications_name_of_the_journal_3');			

			
			

			
			$('#pd_diffrently_abled').on('change',function() {
				var pd_diffrently_abled = $("#pd_diffrently_abled").val();
				console.log("pd_diffrently_abled "+pd_diffrently_abled);
				
				if(pd_diffrently_abled=='yes'){
					setTimeout(function(){ 
						$(".main_div_deformity").css('display','block');
					}, 1);
				}else{
					setTimeout(function(){ 
						$(".main_div_deformity").css('display','none');
					}, 1);
				}
			}); 
			
			$('#phone_no_code').on('change',function() {
				var phone_no_code = $("#phone_no_code").val();
				console.log("phone_no_code "+phone_no_code);
			});				
			
			// Personal Details On Change End
			
			// DOB Datepicker
			/*
			$("#pd_dob").datepicker( {
				format:"mm/dd/yyyy" ,autoclose: true,todayHighlight: true
			}); */
			$("#pd_dob").datepicker( {
				format:"mm/dd/yyyy" ,autoclose: true,todayHighlight: true, endDate: endDob
			}).on('changeDate', function(e) {
					$("#pd_dob").parsley().validate();
			});

			$("#DDDate").datepicker({
				format:"dd/mm/yyyy" , autoclose: !0, todayHighlight: true,todaybtn:true,endDate: todaydate}).on('changeDate', function(e) {$("#DDDate").parsley().validate();
			});			

            $("#year_of_passing_1, #year_of_passing_2, #year_of_passing_3").datepicker( {
                format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy')
            });

            $("#from_year_0, #from_year_1, #from_year_2, #to_year_0, #to_year_1, #to_year_2").datepicker( {
                format:"mm/yyyy" , autoclose: !0, minViewMode: 'months', endDate: moment().format('dd-mm-yyyy')
            });

            calculate_months('work_experience_0','from_year_0','to_year_0','months');
            calculate_months('work_experience_1','from_year_1','to_year_1','months');
            calculate_months('work_experience_2','from_year_2','to_year_2','months');
			calculate_total_exp('months');

            $("#publications_year_0, #publications_year_1, #publications_year_2, #publications_year_3").datepicker( {
                format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy')
            });
			
			validate_cgpa('user_marking_scheme_1','obtained_percentage_cgpa_1');
			validate_cgpa('user_marking_scheme_2','obtained_percentage_cgpa_2');	
			validate_cgpa('user_marking_scheme_3','obtained_percentage_cgpa_3');			

			// $("#pd_title").select2();
			
            $(".next").click(function () {
                var percent = $('.prog').val();
                progress.value(percent);

                $(".progress-bar").css("width", percent + "%").attr("aria-valuenow", percent);
                $(".progress-completed").text(percent + "%");

                $("li").each(function () {
                    if ($(this).hasClass("activestep")) {
                        $(this).removeClass("activestep");
                    }
                });

                if (event.target.className == "col-md-2") {
                    $(event.target).addClass("activestep");
                }
                else {
                    $(event.target.parentNode).addClass("activestep");
                }

                /*hideSteps();
                showCurrentStepInfo(step); */
            });
            $("#resident").hide();
            $("#study_info").hide();
            $(".study").change(function () {
                if ($(".study").val() == "yes") {
                    $("#study_info").show();
                    $("#resident").hide();
                    $("#resident_info_message").hide();
                }
                else {
                    $("#study_info").hide();
                    $("#resident_info_message").hide();
                    $("#resident").show();
                }
            });
            $(".nationality").change(function () {
                if ($(".nationality").val() == "") {
                    $("#indian").hide();
                    $("#indian2").hide();
                }

            });
            $("#resident_info_message").hide();
            $("#resident_info").change(function () {
                if ($("#resident_info").val() == 'NonResident' || $("#resident_info").val() == 'Foreign') {
                    $("#resident_info_message").show();
                }
                else {
                    $("#resident_info_message").hide();
                }
            });
            $("#appering").click(function () {
                $("#appering_info_1").hide();
                $("#appering_info_2").hide();
                $("#appering_info_3").hide();
                $("#appering_info_4").hide();
            })
            $("#completed").click(function () {
                $("#appering_info_1").show();
                $("#appering_info_2").show();
                $("#appering_info_3").show();
                $("#appering_info_4").show();
            })
            $("#payment_details").hide();
            $("#online").click(function () {
                $("#payment_details").hide();
            })
            $("#dd").click(function () {
                $("#payment_details").show();
            })
            $("#Community").hide();
            $("#nationality_indian").change(function () {
                if ($("#nationality_indian").val() == "Indian") {
                    $("#Community").show();
                }
                else {
                    $("#Community").hide();

                }
            });

            $("#Qualification").change(function () {
                if ($("#Qualification").val() == "GraduationPursuing") {
                    $("#table4").hide();
                    $("#appering_info_1").hide();
                    $("#appering_info_2").hide();
                    $("#appering_info_3").hide();
                    $("#appering_info_4").hide();
                }
                else if ($("#Qualification").val() == "GraduationPassed") {
                    $("#table4").hide();
                    $("#appering_info_1").show();
                    $("#appering_info_2").show();
                    $("#appering_info_3").show();
                    $("#appering_info_4").show();
                } else if ($("#Qualification").val() == "Post-GraduationPursuing") {
                    $("#table4").show();
                    $("#appering_infopg_1").hide();
                    $("#appering_infopg_2").hide();
                    $("#appering_infopg_3").hide();
                    $("#appering_infopg_4").hide();
                } else if ($("#Qualification").val() == "Post-GraduationPassed") {
                    $("#table4").show();
                    $("#appering_infopg_1").show();
                    $("#appering_infopg_2").show();
                    $("#appering_infopg_3").show();
                    $("#appering_infopg_4").show();
                }
            });
            $('.finish').click(function(){
                window.location.replace("thank_you.html")
            })

            <?php
            if($is_work_experience) {
            ?>
        		is_work_experience_func('<?php echo $is_work_experience_select; ?>');
        	<?php

        	}
        	?>
        // });

			// Address Detail Select2Load
			select2load('country_phd','<?php echo $applicant_address_details_list['country_id']; ?>','<?php echo $applicant_address_details_list['country_name']; ?>');
			select2load('state_phd','<?php echo $applicant_address_details_list['state_id']; ?>','<?php echo $applicant_address_details_list['state_name']; ?>');
			select2load('district_phd','<?php echo $applicant_address_details_list['district_id']; ?>','<?php echo $applicant_address_details_list['district_name']; ?>');
			select2load('city_phd','<?php echo $applicant_address_details_list['city_id']; ?>','<?php echo $applicant_address_details_list['city_name']; ?>');

            var taken_any_competitive_exam = "taken_any_competitive_exam";
            var is_competitive_exam_select = '<?php echo $is_competitive_exam_select; ?>';
            //alert(dbcountry_id);
            var is_competitive_exam_select_name = '<?php echo $is_competitive_exam_select_name; ?>';
            //alert(dbcountry_val);
             if(is_competitive_exam_select){
                setTimeout(function(){ select2Set(taken_any_competitive_exam,is_competitive_exam_select,is_competitive_exam_select_name);
                }, 1);
            }

            var competitive_exam = "competitive_exam";
            var comp_exam_id = '<?php echo $comp_exam_id; ?>';
            //alert(dbcountry_id);
            var comp_exam_name = '<?php echo $comp_exam_name; ?>';
            //alert(dbcountry_val);
             if(comp_exam_id){
                setTimeout(function(){ select2Set(competitive_exam,comp_exam_id,comp_exam_name);
                }, 1);
            }
			
			if($('#is_work_experience_yes').is(':checked')) {
				$('#emp_dtl').show();
				$('#emp_exp').show();
				$('#emp_total_exp').show();
			}else{
				$('#emp_dtl').hide();
				$('#emp_exp').hide();
				$('#emp_total_exp').hide();				
			}		

			
			// Basic Details Data Fetch
			
			select2load('phone_no_code','<?php echo $applicant_basic_details_list['applicant_mob_country_code_id']; ?>','<?php echo $applicant_basic_details_list['applicant_mob_country_code_name']; ?>');
			
			var qd_id = "qualifying_degree";
			var dbqdId = '<?php echo $applicant_graduations_list[0]['deg_id']; ?>';
			var dbqdVal = '<?php echo $applicant_graduations_list[0]['deg_name']; ?>';

			if(dbqdId){
				setTimeout(function(){ select2Set(qd_id,dbqdId,dbqdVal);}, 1);
			}

			var sqd_id = "specialization_qualifying_degree";
			var dbsqdId = '<?php echo $applicant_graduations_list[0]['spec_id']; ?>';
			var dbsqdVal = '<?php echo $applicant_graduations_list[0]['spec_name']; ?>';

			if(dbsqdId){
				setTimeout(function(){ select2Set(sqd_id,dbsqdId,dbsqdVal);}, 1);
			}
			
			var dept_id = "working_dsc";
			var dbdptId = '<?php echo $applicant_graduations_list[0]['dpt_id']; ?>';
			var dbdptVal = '<?php echo $applicant_graduations_list[0]['dpt_name']; ?>';

			if(dbdptId){
				setTimeout(function(){ select2Set(dept_id,dbdptId,dbdptVal);}, 1);
			}

			var faculty_id = "faculty";
			var dbfacId = '<?php echo $applicant_graduations_list[0]['fac_id']; ?>';
			var dbfacVal = '<?php echo $applicant_graduations_list[0]['fac_name']; ?>';

			if(dbfacId){
				setTimeout(function(){ select2Set(faculty_id,dbfacId,dbfacVal);}, 1);
			}	

			var category_id = "category";
			var dbcatId = '<?php echo $applicant_graduations_list[0]['emp_cat_id']; ?>';
			var dbcatVal = '<?php echo $applicant_graduations_list[0]['emp_cat_name']; ?>';

			if(dbcatId){
				setTimeout(function(){ select2Set(category_id,dbcatId,dbcatVal);}, 1);
			}

			var gender_id = "pd_gender";
			var dbgenId = '<?php echo $applicant_basic_details_list['gender_id']; ?>';
			var dbgenVal = '<?php echo $applicant_basic_details_list['gender']; ?>';

			if(dbgenId){
				setTimeout(function(){ select2Set(gender_id,dbgenId,dbgenVal);}, 1);
			}

			var bld_grp_id = "pd_blood_group";
			var dbbldgrpId = '<?php echo $applicant_basic_details_list['blood_id']; ?>';
			var dbbldVal = '<?php echo $applicant_basic_details_list['blood_group']; ?>';

			if(dbbldgrpId){
				setTimeout(function(){ select2Set(bld_grp_id,dbbldgrpId,dbbldVal);}, 1);
			}

			var nationality_id = "pd_nationality";
			var dbnatId = '<?php echo $applicant_basic_details_list['nation_id']; ?>';
			var dbnatVal = '<?php echo $applicant_basic_details_list['nationality']; ?>';

			if(dbnatId){
				setTimeout(function(){ select2Set(nationality_id,dbnatId,dbnatVal);}, 1);
			}

			var social_status_id = "pd_social_status";
			var dbsocId = '<?php echo $applicant_basic_details_list['social_status_id']; ?>';
			var dbsocVal = '<?php echo $applicant_basic_details_list['social_status']; ?>';

			if(dbsocId){
				setTimeout(function(){ select2Set(social_status_id,dbsocId,dbsocVal);}, 1);
			}			

			var gender_title_id = "pd_title";
			var dbgtitleId = '<?php echo $applicant_basic_details_list['tittle_id']; ?>';
			var dbgtitleVal = '<?php echo $applicant_basic_details_list['tittle_name']; ?>';

			if(dbgtitleId){
				setTimeout(function(){ select2Set(gender_title_id,dbgtitleId,dbgtitleVal);}, 1);
			}

			var diff_abled_id = "pd_diffrently_abled";
			var dbgdiff_abledId = '<?php echo $applicant_basic_details_list['dif_abled']; ?>';
						
			if(dbgdiff_abledId=='yes'){
				var dbdiff_abledVal = 'Yes';
			}else{
				var dbdiff_abledVal = 'No';
			}

			if(dbgdiff_abledId){
				setTimeout(function(){ select2Set(diff_abled_id,dbgdiff_abledId,dbdiff_abledVal);
					if(dbgdiff_abledId=='true'){
						$('.main_div_deformity').show();
					}else{
						$('.main_div_deformity').hide();
					}
				}, 1);
			}

			var is_employed_id = "is_employed";
			var dbgis_employedId = '<?php echo $applicant_graduations_list[0]['is_emp']; ?>';
			console.log('dbgis_employedId'+dbgis_employedId);
			
			if(dbgis_employedId=='t'){
				var dbis_employeVal = 'Yes';
			}else{
				var dbis_employeVal = 'No';
			}

			if(dbgis_employedId){
				setTimeout(function(){ 
					select2Set(is_employed_id,dbgis_employedId,dbis_employeVal);
					if(dbgis_employedId=='t'){
						$('#main_div_working_place').show();
					}else{
						$('#main_div_working_place').hide();
					}
				}, 1);
			}	

			var deformity_type_id = "pd_nature_deformity";
			var dbgtdeformity_typeId = '<?php echo $applicant_basic_details_list['deformity_type_id']; ?>';
			var dbgdeformity_typeVal = '<?php echo $applicant_basic_details_list['deformity_type']; ?>';

			if(dbgtdeformity_typeId){
				setTimeout(function(){ select2Set(deformity_type_id,dbgtdeformity_typeId,dbgdeformity_typeVal);}, 1);
			}		

			var percent_deformity_id = "pd_percent_of_deformity";
			var dbgpercent_deformityId = '<?php echo $applicant_basic_details_list['deformity_percentage']; ?>';
			console.log('dbgis_employedId'+dbgis_employedId);
			
			if(dbgpercent_deformityId=='1'){
				var dbpercent_deformityVal = '10%';
			}

            <?php
            if($applicant_grad_det_univ_id) {
                foreach($applicant_grad_det_univ_id as $k=>$v) {
                    $institute_university = $k+1;
            ?>
                    var institute_university<?php echo $institute_university; ?> = "institute_university_<?php echo $institute_university; ?>";
                    var institute_university_id<?php echo $institute_university; ?> = '<?php echo $v; ?>';
                    var institute_university_name<?php echo $institute_university; ?> = '<?php echo $applicant_grad_det_univ_name[$k]; ?>';
                     if(institute_university_id<?php echo $institute_university; ?>){
                        setTimeout(function(){ select2Set(institute_university<?php echo $institute_university; ?>,institute_university_id<?php echo $institute_university; ?>,institute_university_name<?php echo $institute_university; ?>);
                        	$('#'+institute_university<?php echo $institute_university; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
            ?>

            <?php
            if($applicant_grad_det_mark_scheme_id) {
                foreach($applicant_grad_det_mark_scheme_id as $k=>$v) {
                    $user_marking_scheme = $k+1;
            ?>
                    var user_marking_scheme<?php echo $user_marking_scheme; ?> = "user_marking_scheme_<?php echo $user_marking_scheme; ?>";
                    var user_marking_scheme_id<?php echo $user_marking_scheme; ?> = '<?php echo $v; ?>';
                    var user_marking_scheme_name<?php echo $user_marking_scheme; ?> = '<?php echo $applicant_grad_det_mark_scheme_name[$k]; ?>';
                     if(user_marking_scheme_id<?php echo $user_marking_scheme; ?>){
                        setTimeout(function(){ select2Set(user_marking_scheme<?php echo $user_marking_scheme; ?>,user_marking_scheme_id<?php echo $user_marking_scheme; ?>,user_marking_scheme_name<?php echo $user_marking_scheme; ?>);
                        	$('#'+user_marking_scheme<?php echo $user_marking_scheme; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
            ?>			
			if(dbgpercent_deformityId=='2'){
				var dbpercent_deformityVal = '20%';
			}
			if(dbgpercent_deformityId=='3'){
				var dbpercent_deformityVal = '30%';
			}
			if(dbgpercent_deformityId=='4'){
				var dbpercent_deformityVal = '40%';
			}
			if(dbgpercent_deformityId=='5'){
				var dbpercent_deformityVal = '50%';
			}
			if(dbgpercent_deformityId=='6'){
				var dbpercent_deformityVal = '60%';
			}
			if(dbgpercent_deformityId=='7'){
				var dbpercent_deformityVal = '70%';
			}
			if(dbgpercent_deformityId=='8'){
				var dbpercent_deformityVal = '80%';
			}
			if(dbgpercent_deformityId=='9'){
				var dbpercent_deformityVal = '90%';
			}
			if(dbgpercent_deformityId=='10'){
				var dbpercent_deformityVal = '100%';
			}			

			if(dbgpercent_deformityId){
				setTimeout(function(){ 
					select2Set(percent_deformity_id,dbgpercent_deformityId,dbpercent_deformityVal);
				}, 1);
			}

			var working_place_id = "working_place";
			var dbgworking_placeId = '<?php echo $applicant_graduations_list[0]['work_place']; ?>';
			console.log('dbgworking_placeId'+dbgworking_placeId);
		
			if(dbgworking_placeId=='257'){
				var dbworking_placeVal = 'Industry';
			}
			if(dbgworking_placeId=='260'){
				var dbworking_placeVal = 'Others';
			}	
			if(dbgworking_placeId=='259'){
				var dbworking_placeVal = 'Organization';
			}	
			if(dbgworking_placeId=='258'){
				var dbworking_placeVal = 'College';
			} 				

			if(dbgworking_placeId){
				setTimeout(function(){ 
					select2Set(working_place_id,dbgworking_placeId,dbworking_placeVal);
				}, 1);
			}
			
			<?php
		      if($upload_scripts) {
		        foreach($upload_scripts as $k=>$v) {
		          echo $v."\n";
		        }
		      }
		      ?>

		    set_application_payment_info();

		    onchangeLableHide('qualifying_degree');
		    onchangeLableHide('specialization_qualifying_degree');
		    onchangeLableHide('working_dsc');
		    onchangeLableHide('faculty');
		    onchangeLableHide('category');
		    onchangeLableHide('is_employed');
		    onchangeLableHide('working_place');

		    onchangeLableHide('pd_title');
		    onchangeLableHide('pd_dob','date');
		    onchangeLableHide('pd_gender');
		    onchangeLableHide('pd_blood_group');
		    onchangeLableHide('pd_nationality');
		    onchangeLableHide('pd_social_status');
		    onchangeLableHide('pd_diffrently_abled');
		    onchangeLableHide('pd_nature_deformity');
		    onchangeLableHide('pd_percent_of_deformity');

		    onchangeLableHide('country_phd');
		    onchangeLableHide('state_phd');
		    onchangeLableHide('district_phd');
		    onchangeLableHide('city_phd');

		    onchangeLableHide('institute_university_1');
		    onchangeLableHide('institute_university_2');
		    onchangeLableHide('institute_university_3');
		    onchangeLableHide('user_marking_scheme_1');
		    onchangeLableHide('user_marking_scheme_2');
		    onchangeLableHide('user_marking_scheme_3');
		    onchangeLableHide('year_of_passing_1','date');
		    onchangeLableHide('year_of_passing_2','date');
		    onchangeLableHide('year_of_passing_3','date');
		    onchangeLableHide('taken_any_competitive_exam');
		    onchangeLableHide('competitive_exam');
		    onchangeLableHide('from_year_0','date');
		    onchangeLableHide('from_year_1','date');
		    onchangeLableHide('from_year_2','date');
		    onchangeLableHide('to_year_0','date');
		    onchangeLableHide('to_year_1','date');
		    onchangeLableHide('to_year_2','date');
		    
		    onchangeLableHide('BankName');
		    onchangeLableHide('DDDate','date');
		
			// Alternate Email & Father,Mother,Guardian Email Suggestion Goes Here
			email_suggestion("pd_alt_email","suggestion_alt_email");			
		});

    function is_work_experience_func(val) {
        if(val == 'yes') {
            $('#emp_dtl').show();
            $('#emp_exp').show();
            $('#emp_total_exp').show();
            enable_validate_for_emp('emp_dtl');
            enable_validate_for_emp('emp_exp');
        } else {
            $('#emp_dtl').hide();
            $('#emp_exp').hide();
            $('#emp_total_exp').hide();
            disable_validate_for_emp('emp_dtl');
            disable_validate_for_emp('emp_exp');
        }
    }

    function enable_validate_for_emp(id) {
        $('#'+id).find('[data-parsley-required=false]').each(function() {
            $(this).attr('data-parsley-required','true');
        });
    }

    function disable_validate_for_emp(id) {
        $('#'+id).find('[data-parsley-required=true]').each(function() {
            $(this).attr('data-parsley-required','false');
        });   
    }

    function upload_file(file_doc_type, upload_type) {
        upload_type = upload_type || false;
		// var parsley_required = $('#'+file_doc_type).attr('data-parsley-required');
		var parsley_required = $('#'+file_doc_type).attr('data-required');
		var max_file_size = $('#'+file_doc_type).attr('data-parsley-max-file-size');
		var max_file_size_js = $('#'+file_doc_type).attr('data-max-file-size-js');
		var file_extension = $('#'+file_doc_type).attr('data-parsley-file-extension');
        var id = $('#'+file_doc_type).attr('data-file-id');
		// Get Regenerated CSRF Dynamically
		var csrfHashRegenerate = $("input[name='"+csrfName+"']").val();
        var file_count = 'false';
        if(typeof $('#'+file_doc_type).attr('data-file-count') != 'undefined') {
            file_count = $('#'+file_doc_type).attr('data-file-count');    
        }
        
        // console.log(file_count);
        // console.log($('#'+file_doc_type)[0].files[0]);
        // return false;

        var formData = new FormData();
        formData.append('applicant_login_id', logged_applicant_login_id);
        formData.append('applicant_id', logged_applicant_id);
        formData.append('file_doc_type', file_doc_type);
		formData.append('app_form_id', app_form_id);
		formData.append('chk_max_file_size', max_file_size);
		formData.append('max_file_size_js', max_file_size_js);
		formData.append('file_extension', file_extension);		
        formData.append('id', id);
		formData.append(csrfName,csrfHashRegenerate);
		// CRM Edit Mode
		if(mode_edit_url !='')
		{
			formData.append('mode',mode_edit_val);
			formData.append('applicant_personal_det_id',crm_applicant_personal_det_id);
		}			
        if(typeof $('#'+file_doc_type).attr('data-file-count') != 'undefined') {
            $($('#'+file_doc_type)[0].files).each(function(k,v) {
                formData.append(file_doc_type+'[]', v);     
            });
        } else {
            formData.append(file_doc_type, $('#'+file_doc_type)[0].files[0]); 
        }
        // validation check
        var valid = false;
        valid = $('#'+file_doc_type).parsley().isValid();
        if(valid) {
			// var parsley_required = $('#'+file_doc_type).attr('data-parsley-required','false');
            var url = "<?php echo base_url(); ?>upload-file";
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
				beforeSend: function(xhr,settings) {
					upload_file_loading(file_doc_type);
				},					
                success: function(returndata) {
                    console.log(returndata);
                    console.log(returndata.data.data);
					upload_file_remove_loading(file_doc_type);
                    
                    if(file_count != 'false') {
                        var db_file_count = returndata.data.file_count;
                        var filename_html = '';
                        var filename_ids = [];
                        $.each(returndata.data.data, function(k, v) {
                            var id = v.id;
                            var doc_id = v.document_id;
                            var file_name_user = v.filename_user;
                            var file_name_truncate = v.filename_truncate;
                            var file_path = v.path;
                            var file_name = v.file_name;
							// Set Regenerated CSRF Dynamically
							var csrfHash = $("input[name='"+csrfName+"']").val(returndata.token);
                            filename_html += '<span class="file_name  mt-3"><a class="image-popup-vertical-fit" href="<?php echo base_url(); ?>'+file_path+'" target="_blank" title="'+file_name_user+'">'+file_name_truncate+' <i class="fa fa-eye" aria-hidden="true"></i></a></span><a href="javascript:void(0)" data-del-file-id="'+id+'" data-doc-id="'+doc_id+'" data-toggle="modal" data-target="#contentDeletePop" data-field="tentative_topic_files" data-required="false" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a><div style="display:none" class="alert col-sm-12 alert-success appendj" id="deleteMessage_'+doc_id+id+'"><a href="#" class="close" onclick="hideAlert(\'deleteMessage_'+doc_id+'\')">&times;</a><strong id="deleteMessageStatus_'+doc_id+id+'"></strong> <span id="deleteMessageSpan_'+doc_id+id+'"></span></div>';
                            filename_ids.push(id);
                        });
                        $('#'+file_doc_type).parent().find('span.file_name').remove();
                        $('#'+file_doc_type).parent().find('[data-del-file-id]').remove();
                        $('#'+file_doc_type).parent().find('.alert').remove();
                        $('#'+file_doc_type).parent().append(filename_html);
                        $('#'+file_doc_type).attr('data-file-count',db_file_count);
                        $('#'+file_doc_type).attr('data-file-id',filename_ids.join(','));
                    } else {
                        v = returndata.data.data;
                        var id = v.id;
                        var doc_id = v.document_id;
                        var file_name_user = v.filename_user;
                        var file_name_truncate = v.filename_truncate;
                        var file_path = v.path;
                        var file_name = v.file_name;
						// Set Regenerated CSRF Dynamically
						var csrfHash = $("input[name='"+csrfName+"']").val(returndata.token);
                        $('#'+file_doc_type).parent().find('span.file_name').remove();
                        $('#'+file_doc_type).parent().find('[data-del-file-id]').remove();
                        $('#'+file_doc_type).parent().find('.alert').remove();
                        $('#'+file_doc_type).parent().append('<!-- <span class="file_name  mt-3"><a class="image-popup-vertical-fit" href="<?php echo base_url(); ?>'+file_path+'" target="_blank" title="'+file_name_user+'">'+file_name_truncate+' <i class="fa fa-eye" aria-hidden="true"></i></a></span><a href="javascript:void(0)" data-del-file-id="'+id+'" data-doc-id="'+doc_id+'" data-toggle="modal" data-target="#contentDeletePop" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>--><div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_'+doc_id+'"><a href="#" class="close" onclick="hideAlert(\'deleteMessage_'+doc_id+'\')">&times;</a><strong id="deleteMessageStatus_'+doc_id+'"></strong> <span id="deleteMessageSpan_'+doc_id+'"></span></div>');
                        setTimeout(function() { 
                          upload_file_set_download_delete_options(file_doc_type, file_name, file_path, doc_id, id, parsley_required,mode_edit_url);
                        }, 100);

                        $('#'+file_doc_type).attr('data-file-id',id);
                        $('#'+file_doc_type).attr('data-parsley-required','false');

						light_box_init();
                    }
                },
                error: function(returndata) {
                  console.log(returndata);
                },
            });
        }else {
          $('#'+file_doc_type).parsley().validate();
		}
    }

    function changeFileName(val) {
        var filename = '';
        switch(val) {
            case comp_exam_ugc_net:
                filename = 'ugc_score_card';
            break;
            case comp_exam_ugc_csir_net:
                filename = 'ugc_score_card';
            break;
            case comp_exam_slet:
                filename = 'slet_score_card';
            break;
            case comp_exam_gate:
                filename = 'gate_score_card';
            break;
            case comp_exam_teacher_fellowship_holder:
                filename = 'net_score_card';
            break;
        }
        $('#score_card').attr('name',filename);
        $('#score_card').attr('id',filename);
        return filename;
    }

    function removeClick(dataThis) {
        var id = $(dataThis).attr('data-del-file-id');
        var doc_id = $(dataThis).attr('data-doc-id');
		var required = $(dataThis).attr('data-required');
		var field = $(dataThis).attr('data-field');			
        console.log('id => '+id);
        $('#contentDeletePop').on('shown.bs.modal', function (e) {
          $(this).find('#yesbulk_btn').attr('data-del-file-id',id);
          $(this).find('#yesbulk_btn').attr('data-doc-id',doc_id);
		  $(this).find('#yesbulk_btn').attr('data-required',required);
		  $(this).find('#yesbulk_btn').attr('data-field',field);		  
        });
    }
    function removeAttachedFile(dataThis) {
        var data_del_file_id = $(dataThis).attr('data-del-file-id');
        var doc_id = $(dataThis).attr('data-doc-id');
		var required = $(dataThis).attr('data-required');
		var field = $(dataThis).attr('data-field');		
        console.log('data_del_file_id => '+data_del_file_id);
		// Get Regenerated CSRF Dynamically
		var csrfHashRegenerate = $("input[name='"+csrfName+"']").val();
		
        var url = "<?php echo base_url(); ?>del-uploaded-file";
        var AjaxRequest = $.ajax({
            type: 'POST',
            url: url,
            data: 'data_del_file_id='+data_del_file_id+'&doc_id='+doc_id+'&logged_applicant_id='+logged_applicant_id+'&logged_applicant_login_id='+logged_applicant_login_id+'&app_form_id='+app_form_id+'&'+csrfName+'='+csrfHashRegenerate+url_edit,
            dataType: 'json',
            cache: false,
            success: function(returndata) {
                var json = returndata;
                $('#contentDeletePop').find('.close').trigger('click');
                if(doc_id == document_id_tentative_topic) {
                    var divId = 'deleteMessage_'+doc_id+data_del_file_id;
                    var strongId = 'deleteMessageStatus_'+doc_id+data_del_file_id;
                    var spanId = 'deleteMessageSpan_'+doc_id+data_del_file_id;
                } else {
                    var divId = 'deleteMessage_'+doc_id;
                    var strongId = 'deleteMessageStatus_'+doc_id;
                    var spanId = 'deleteMessageSpan_'+doc_id;   
                }
                $('#' + divId).parent().find('[data-del-file-id="'+data_del_file_id+'"]').prev('span.file_name').remove();
                $('#' + divId).parent().find('[data-del-file-id="'+data_del_file_id+'"]').remove();
                
                
                $('#' + divId).show('slow');
                if (json) {
                    // var arrJson = JSON.parse(json);
                    var msg = json.message;
					// Set Regenerated CSRF Dynamically
					var csrfHash = $("input[name='"+csrfName+"']").val(json.token);					
                    if (json.status == true || json.status == 'true') {
                        $('#' + divId).addClass('alert-success');
                        $('#' + divId).removeClass('alert-danger');
                        // $('#' + strongId).text('<?php echo $this->lang->line ( 'success' );?>');
                    } else {
                        $('#' + divId).addClass('alert-danger');
                        $('#' + divId).removeClass('alert-success');
                        // $('#' + strongId).text('<?php echo $this->lang->line ( 'error' );?>');
                    }
					$('#' + spanId).text(msg);
                    upload_file_unset_download_delete_options(field);
                    setTimeout(function () {
                        $('#' + divId).hide('slow');
                        if(doc_id != document_id_tentative_topic) {
                        $('#'+field).attr('data-parsley-required',required);
						$('#'+field).parsley().validate();
						$('#'+field).parsley().isValid();
						$('#'+field).removeClass('parsley-success');
						}				
	                    
                    //     window.location.reload();
                    }, 2000);
                    // $('.loading').fadeOut("slow");
                }
            },
            error: function(returndata) {
              console.log(returndata); 
            },
        });                 

        return AjaxRequest; 
    }

    function check_competitive_exam(value, select_div_competitive_exam, upload_div_competitive_exam,taken_any_competitive_exam_info,doc_valid) {
        if(value == 'yes') {
            $('#'+select_div_competitive_exam).show();
            $('#'+upload_div_competitive_exam).show();
            $('#'+taken_any_competitive_exam_info).hide();
            $('#competitive_exam').attr('data-parsley-required','true');
            $('#score_card').attr('data-parsley-required',doc_valid);
        } else {
            $('#'+select_div_competitive_exam).hide();
            $('#'+upload_div_competitive_exam).hide();
            $('#'+taken_any_competitive_exam_info).show();
            $('#competitive_exam').attr('data-parsley-required','false');
            $('#score_card').attr('data-parsley-required','false');
        }
    }

    function fetch_preview_btn(currentIndex) {
    	var preview_button = $("<a style='float:left;background:unset;'><input type='button' id='form_preview_btn' class='btn btn-primary' value='Form Preview'></a>").attr("href","<?php echo base_url();?>phd-preview?startIndex="+currentIndex);
		$(document).find(".actions").prepend(preview_button);
    }

    function wizard_final_step(url,currentIndex, redirect) {
    	var photograph = $('#photograph').parsley();
        var signature = $('#signature').parsley();
		
        var aadhar_card = $('#aadhar_card').parsley();
        var additional_qualification = $('#additional_qualification').parsley();
		// Get Regenerated CSRF Dynamically
		var csrfHashRegenerateonDec = $("input[name='"+csrfName+"']").val();
        if(photograph.isValid() && signature.isValid() && aadhar_card.isValid() && additional_qualification.isValid()) {
        	$.ajax({
                type: 'POST',
                url: url,
                data: 'currentIndex='+currentIndex+'&'+csrfName+'='+csrfHashRegenerateonDec,
                dataType: 'json',
                cache: false,
				beforeSend: function() { $('.loader').show(); },
                success: function(returndata) {
                  console.log(returndata);
					if(returndata || returndata==null) {									
						console.log(returndata);
						if(url_edit==''){
							var append_url_edit = '';
						}else{
							var append_url_edit = '&'+url_edit;
						}
						setTimeout(function() { window.location.href = redirect+append_url_edit; }, 100);
					}
                },
                error: function(returndata) {
                  console.log(returndata); 
                },
            }); 
            return true;       
        } else {
        	photograph.validate();
        	signature.validate();
        	aadhar_card.validate();
        	additional_qualification.validate();
            return false;
        }
    }
</script>