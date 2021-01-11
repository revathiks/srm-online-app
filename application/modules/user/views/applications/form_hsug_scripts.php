<?php 
/* Get the Form Value */
$app_form_id_hsug 	       = APP_FORM_ID_HSUG;
$parent_type_id_father     = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother     = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian   = PARENT_TYPE_ID_GUARDIAN;
//$institute_university_other_id = INSTITUTE_UNIVERSITY_OTHER_ID;
$other_board_id = OTHER_BOARD;

if($applicant_application_details_list) {
    foreach($applicant_application_details_list as $k=>$v) {
        $appln_form_id = $v['appln_form_id'];
        if($app_form_id_hsug == $appln_form_id) {
            $applicant_appln_id = $v['applicant_appln_id'];
            $qualifyingexamfromindia = $v['qualifyingexamfromindia'];
            $i_confirmChecked=$v['is_agree'];
            $current_wizard=$v['wizard_id'];
        }
    }
}
$qualifyingexamfromindia=isset($qualifyingexamfromindia)?$qualifyingexamfromindia:'';
$i_confirmChecked=isset($i_confirmChecked) ? $i_confirmChecked:'';

$add_gardian=isset($applicant_other_details_list['add_gardian'])?$applicant_other_details_list['add_gardian']:'';

$qualificationList=$this->config->item('hsug_qualifications');
if($applicant_parent_details_list) {
    foreach($applicant_parent_details_list as $k=>$v) {
        $parent_type_id = $v['parent_type_id'];
        $app_parent_det_id[$parent_type_id] = $v['app_parent_det_id'];
        $applicant_parent_parent_type_name[$parent_type_id] = $v['parent_type_name'];
        $applicant_parent_parent_name[$parent_type_id] = $v['parent_name'];
        $applicant_parent_mobile_no[$parent_type_id] = $v['mobile_no'];
        $applicant_parent_email_id[$parent_type_id] = $v['email_id'];
        $applicant_parent_occupation_id[$parent_type_id] = $v['occupation_id'];
        $applicant_parent_occupation_name[$parent_type_id] = $v['occupation_name'];
        $applicant_parent_mob_country_code_id[$parent_type_id] = $v['mob_country_code_id'];
        $applicant_parent_country_mob_code[$parent_type_id] = $v['country_mob_code'];
        $applicant_parent_alt_mob_countrycode_id[$parent_type_id] = $v['alt_mob_countrycode_id'];
        $applicant_parent_alt_mob_country_code[$parent_type_id] = $v['alt_mob_country_code'];
        $applicant_parent_alt_mobile_no[$parent_type_id] = $v['alt_mobile_no'];
        $applicant_parent_title_id[$parent_type_id] = $v['title_id'];
        $applicant_parent_title_name[$parent_type_id] = $v['title_name'];
    }
}

$course_id   = isset($applicant_course_details_list['course_id']) ? $applicant_course_details_list['course_id'] :'';
$course_name = isset($applicant_course_details_list['course_name']) ? $applicant_course_details_list['course_name'] :'';

if(!empty($applicant_application_details_list))
{
    $applicant_appln_id=$applicant_application_details_list[0]['applicant_appln_id'];
}
$applicant_appln_id=!empty($applicant_appln_id) ? $applicant_appln_id :false;


// For Schooling Details
$applicant_schooling_board_id           = $applicant_schooling_list['board_id'];
$applicant_schooling_board_name         = $applicant_schooling_list['board_name'];
$applicant_schooling_mark_scheme_id     = $applicant_schooling_list['marking_scheme_id'];
$applicant_schooling_mark_scheme_name   = $applicant_schooling_list['marking_scheme_name'];
$applicant_schooling_mode_of_study_id   = $applicant_schooling_list['mode_of_study_id'];
$applicant_schooling_mode_of_study_name = $applicant_schooling_list['mode_of_study_name'];

// For Upload Section
$document_id_photograph  = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature   = DOCUMENT_ID_SIGNATURE;
$document_id_graduation_marksheet = DOCUMENT_ID_GRADUATION_MARKSHEET;

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
        $file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_graduation_marksheet == $document_id)?'graduation_marksheet' :'')));
        $parsley_required = (($document_id_photograph == $document_id)?'true':(($document_id_signature == $document_id)?'true':(($document_id_graduation_marksheet == $document_id)?'true':'')));
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
$docs['file_count']   = $file_count;
$applicant_name       = isset($applicant_application_details_list[0]['applicant_name_declaration'])?$applicant_application_details_list[0]['applicant_name_declaration']:'';
$parent_name          = isset($applicant_application_details_list[0]['applicant_parentname_declaration'])?$applicant_application_details_list[0]['applicant_parentname_declaration']:'';

// Payment Details
$payment_mode_id   = $payment_details_list['payment_mode_id'];
$startIndex 	   = $this->input->get('startIndex',true);

// Restrict previous section
$is_allow_previous = $this->config->item('is_allow_previous');
/*Form Index Restriction Start*/
$start_wizard = 0;
$start_wizard_next = -1;
$next_step_allowed = '';
$start_wizard_next_allow='';
$appln_form_w_wizard_id = $applicant_application_details_list[0]['form_w_wizard_id'];
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
		if(isset($startIndex) && $startIndex >= 6){
			$startIndex=$startIndex;
		}else{
			$startIndex=6;
		}
	}
	else if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==1) && $startIndex <= $start_wizard_next_allow) {
		$startIndex = $startIndex;
	}
	else{
		$startIndex = 0;
	}
	/* Admin Means No restriction end / Form Index Restriction End */
}
?>
<script>
var country_value_default     = '<?php echo COUNTRY_VALUE_DEFAULT; ?>';
var otherboard                = '<?php echo OTHER_BOARD;?>';
var logged_applicant_id   	  = '<?php echo $logged_applicant_id; ?>';
var logged_applicant_login_id = '<?php echo $logged_applicant_login_id; ?>';
var app_form_id 			  = '<?php echo $app_form_id_hsug; ?>';
var payment_wizard_id = '<?php echo FORM_WIZARD_PAYMENT_ID; ?>';
/*CRM ADMIN Edit form start*/
var crm_applicant_personal_det_id = '<?php echo $crm_applicant_personal_det_id ; ?>';
var crm_applicant_login_id = '<?php echo $crm_applicant_login_id ; ?>';
var mode_edit_val = '<?php echo ADMIN_MODE_EDIT ; ?>';
var mode_edit_url = '<?php echo $mode_edit; ?>';

<?php if($mode_edit) { ?>
var url_edit 				  = '&mode=edit'+'&applicant_personal_det_id='+crm_applicant_personal_det_id+'&applicant_login_id='+crm_applicant_login_id;
var url                       = "<?php echo base_url(); ?>hsug/"+mode_edit_val+"/"+crm_applicant_login_id+"/"+crm_applicant_personal_det_id;
var payment_url               = '<?php echo base_url(); ?>user/payment_details?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;
var save_exit_redirect_url    = '<?php echo base_url(); ?>crm-admin/dashboard';
<?php } else { ?>
var url_edit                  =  '&applicant_personal_det_id='+logged_applicant_id+'&applicant_login_id='+logged_applicant_login_id;
var url                       = "<?php echo base_url(); ?>hsug";
var payment_url               = '<?php echo base_url(); ?>user/payment_details';
var save_exit_redirect_url    = '<?php echo base_url(); ?>';
<?php } ?>
/*CRM ADMIN Edit form end*/
var redirect 				  = '<?php echo base_url()."thank_you"; ?>?app_form_id='+app_form_id;
var applicant_appln_id 		  = '<?php echo $applicant_appln_id;?>';
var otherstream				  = '<?php echo OTHER_STREAM;?>';
var otheroccupation			  = '<?php echo OTHER_OCCUPATION;?>';
var otheruniversity			  = '<?php echo OTHER_UNIVERSITY;?>';
var othersector				  = '<?php echo OTHER_SECTOR;?>';
var other_board_id 			  = '<?php echo $other_board_id; ?>';
var get_percentage_url 		  = '<?php echo base_url(); ?>/user/get_percentage_w_tab?app_form_id='+app_form_id+url_edit;
var redirect_payment_thank_you= '<?php echo base_url(); ?>user/payment_thank_you?app_form_id='+app_form_id+'&url='+encodeURIComponent(url);
var grad_id					  = '<?php echo UG_GRAD;?>';
var curIndex 				  = '<?php echo $startIndex;?>';
var csrfName				  = '<?php echo $this->security->get_csrf_token_name(); ?>',
csrfHash					  = '<?php echo $this->security->get_csrf_hash(); ?>';
// Document Ready Function Start
$(document).ready(function () {
    'use strict'; 
	
	// This Part For Payment Part of DD Based condition
	<?php if($payment_mode_id == PAYMENT_MODE_DEMAND_DRAFT_ID) { ?>
		setTimeout(function() {
			$("#dd").trigger('click');
			<?php if(!empty($payment_details_list)){ ?> 
			 $("#dd").attr("disabled","disabled");
			 $("#online").attr("disabled","disabled");
			 $("#BankName").attr("disabled","disabled");
			 $("#DDNumber").attr("disabled","disabled");					
			 $("#DDDate").attr("disabled","disabled");
			 $("#BranchName").attr("disabled","disabled");
			<?php } ?>
		},2);
	<?php
	}
	
	// This Part For Payment Part of Online Based condition
	if($payment_mode_id == PAYMENT_MODE_ONLINE_ID) { ?>
		setTimeout(function() {
			$("#online").trigger('click');			
			<?php if(!empty($payment_details_list)){ ?> 
			 $("#dd").attr("disabled","disabled");
			 $("#online").attr("disabled","disabled");
			<?php } ?>
		},1);
		<?php
	}
	?>	
	
    // Dynamically Get Total Wizard Steps
	var total_wizard_Step = $('.wizard_head_tag').length;
	$("#show_currentindex").html('1 of '+total_wizard_Step);
	setTimeout(function() {
		enable_saveExit_btn('<?php echo $startIndex;?>',5);
	},1);	
	
	<?php
	  // on load preview button
	  if($startIndex) {
	  ?>
	  setTimeout(function() { 
		if(parseInt(total_wizard_Step-1) == <?php echo $startIndex; ?>) {
			$("#save_exit").remove();
			if(mode_edit_url != ''){
				enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>hsug_preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
			}else{
				enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>hsug_preview');	
			}
		}
		if(curIndex==4){
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
		
			if(currentIndex < newIndex) {
				// Step 1 form validation
				 if(currentIndex === 0) {
					 	                 
					  var non_indian_resident = $('#non_indian_resident').parsley();
					  var i_confirm = $('#i_confirm').parsley();
					  var studied_from_india = $('#studied_from_india').parsley();
					  var i_confirm_val = $('#i_confirm').val();
    				  var studied_from_india_val = $('#studied_from_india').val();
    				  var non_indian_resident_val = $('#non_indian_resident').val();
					  var appln_status = $('#appln_status').val();
					 
					  if(studied_from_india.isValid() && i_confirm.isValid() && non_indian_resident.isValid() && (studied_from_india_val=="yes" ||studied_from_india_val=="t")) 
					  {	
						 var user_data ='i_confirm='+i_confirm_val+
						'&studied_from_india='+studied_from_india_val+
						'&applicant_appln_id='+applicant_appln_id+'&'+csrfName+'='+csrfHash+'&appln_status='+appln_status;						
						 var moveNxt=0;
						 $.ajax({
							type: 'POST',
							url: url,
							data: user_data+'&currentIndex='+currentIndex,
							dataType: 'json',
							cache: false,
							async: false,
							beforeSend: function() { $('.loader').show(); },
							success: function(returndata) {
								if(returndata) {			
									//console.log(returndata);		
									if(returndata.appln_status.status == 'true') {
										var startIndex = currentIndex+1
										window.location.href = url+'?startIndex='+startIndex; 
									    $("#formerr").hide();
										moveNxt=1;
									}									
								}	
							},
							error: function(returndata) {
								  moveNxt=0;
								 // console.log(returndata);
								  $("#formerr").show(); 							  
								  return false; 
							},
						});	
										
						 if(moveNxt){
								return true;
							}
					  } else {
						non_indian_resident.validate();
					  	i_confirm.validate();
					  	studied_from_india.validate();
					  	if(non_indian_resident.isValid() && non_indian_resident_val!=""){
					  	 $("#halterror").show();
					  	}
						return false;
					  }
					  
					}

					//preference  and personal details
					// Step 2 form validation
					if(currentIndex === 1) {						
					var pd_campus_pref_1 = $('#campus_pref_1').parsley();
					var pd_course_pref_1 = $('#course_pref_1').parsley();
					var state_pref_1 	 = $('#state_pref_1').parsley();
	                var city_pref_1 	 = $('#city_pref_1').parsley();					 	  
					var pd_title 		 = $('#pd_title').parsley();
					var pd_firstname     = $('#pd_firstname').parsley();
					var pd_lastname 	 = $('#pd_lastname').parsley();
					var pd_mobile_no 	 = $('#pd_mobile_no').parsley();
					var pd_email 		 = $('#pd_email').parsley();
					var pd_dob			 = $('#pd_dob').parsley();
					var pd_gender 		 = $('#pd_gender').parsley();					 
					var pd_blood_group   = $('#pd_blood_group').parsley();
					var pd_diffrently_abled = $('#pd_diffrently_abled').parsley();
					var pd_nationality 	 = $('#pd_nationality').parsley();
					var pd_social_status = $('#pd_social_status').parsley();
					var pd_alt_email 	 = $('#pd_alt_email').parsley();
					var pd_middlename 	 = $('#pd_middlename').parsley();
					  
					if($('#main_div_social_status').is(':visible')){
						$('#pd_social_status').attr('data-parsley-required', 'true');
						$('#pd_social_status').attr('data-parsley-required-message', '<?php echo REQD_SOCIAL_STATUS_MSG; ?>');
					}else{
						$('#pd_social_status').attr('data-parsley-required', 'false');
					}
					
					// Make Validation false
					if($('#pd_lastname').val()=='.'){
						$('#pd_lastname').removeAttr('data-parsley-nameonly', 'true');
						$('#pd_lastname').removeAttr('data-parsley-nameonly-message', '<?php echo REQD_ALPHA_ONLY_MSG; ?>');
					}
							
					if(pd_campus_pref_1.isValid() && pd_course_pref_1.isValid()	&& state_pref_1.isValid() && city_pref_1.isValid()	&& pd_title.isValid() && pd_firstname.isValid() && pd_lastname.isValid() &&
				    pd_mobile_no.isValid() && pd_email.isValid() && pd_dob.isValid() && pd_gender.isValid() &&  
				    pd_blood_group.isValid() && pd_diffrently_abled.isValid() && pd_nationality.isValid() && pd_social_status.isValid() && pd_alt_email.isValid() && pd_middlename.isValid()) {
						
					var course_pref_1_val = $('#course_pref_1').val();							
					var course_choice_no_1_val = $('#course_choice_no_1').val();
					var course_prefer_id_1_val = $('#course_prefer_id_1').val();

					var course_pref_2_val = $('#course_pref_2').val();							
					var course_choice_no_2_val = $('#course_choice_no_2').val();
					var course_prefer_id_2_val = $('#course_prefer_id_2').val();

					var course_pref_3_val = $('#course_pref_3').val();							
					var course_choice_no_3_val = $('#course_choice_no_3').val();
					var course_prefer_id_3_val = $('#course_prefer_id_3').val();
					
					var campus_pref_1_val = $('#campus_pref_1').val();
					var campus_choice_no_1_val = $('#campus_choice_no_1').val();
					var campus_prefer_id_1_val = $('#campus_prefer_id_1').val();

					var campus_pref_2_val = $('#campus_pref_2').val();
					var campus_choice_no_2_val = $('#campus_choice_no_2').val();
					var campus_prefer_id_2_val = $('#campus_prefer_id_2').val();

					var campus_pref_3_val = $('#campus_pref_3').val();
					var campus_choice_no_3_val = $('#campus_choice_no_3').val();
					var campus_prefer_id_3_val = $('#campus_prefer_id_3').val();

					var state_pref_1_val = $('#state_pref_1').val();
					var city_pref_1_val = $('#city_pref_1').val();
					var city_prefer_id_1_val = $('#city_prefer_id_1').val();
					var city_choice_no_1_val = $('#city_choice_no_1').val();
					var state_pref_2_val = $('#state_pref_2').val();
					var city_pref_2_val = $('#city_pref_2').val();
					var city_prefer_id_2_val = $('#city_prefer_id_2').val();
					var city_choice_no_2_val = $('#city_choice_no_2').val();
							
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
					var pd_social_status_val = $('#pd_social_status').val();
					var pd_diffrently_abled_val = $('#pd_diffrently_abled').val();
					var pd_religion_val = $('#pd_religion').val();
					var pd_medium_of_instruction_val = $('#pd_medium_of_instruction').val();
					var pd_hostel_accommodation_val = $('#pd_hostel_accommodation').val();
					var pd_mother_tongue_val = $('#pd_mother_tongue').val();
					var pd_advertisment_source_val = $('#pd_advertisement_source').val();
					var pd_nationality_val = $('#pd_nationality').val();
					
					// parent name at declaration 
					<?php if(empty($applicant_name) || $applicant_name=="")  { ?>
					$("#applicant_name").val(pd_firstname_val);
					<?php } ?>
					var user_data = 'course_pref_1='+course_pref_1_val+'&course_prefer_id_1='+course_prefer_id_1_val+'&course_choice_no_1='+course_choice_no_1_val+'&course_pref_2='+course_pref_2_val+'&course_prefer_id_2='+course_prefer_id_2_val+'&course_choice_no_2='+course_choice_no_2_val+'&course_pref_3='+course_pref_3_val+'&course_prefer_id_3='+course_prefer_id_3_val+'&course_choice_no_3='+course_choice_no_3_val+'&campus_pref_1='+campus_pref_1_val+'&campus_choice_no_1='+campus_choice_no_1_val+'&campus_prefer_id_1='+campus_prefer_id_1_val+'&campus_pref_2='+campus_pref_2_val+'&campus_choice_no_2='+campus_choice_no_2_val+'&campus_prefer_id_2='+campus_prefer_id_2_val+'&campus_pref_3='+campus_pref_3_val+'&campus_choice_no_3='+campus_choice_no_3_val+'&campus_prefer_id_3='+campus_prefer_id_3_val+'&state_pref_1='+state_pref_1_val+'&city_pref_1='+city_pref_1_val+'&city_prefer_id_1='+city_prefer_id_1_val+'&city_choice_no_1='+city_choice_no_1_val+'&state_pref_2='+state_pref_2_val+'&city_pref_2='+city_pref_2_val+'&city_prefer_id_2='+city_prefer_id_2_val+'&city_choice_no_2='+city_choice_no_2_val+'&pd_title='+pd_title_val+'&pd_firstname='+pd_firstname_val+'&pd_middlename='+pd_middlename_val+'&pd_lastname='+pd_lastname_val+'&phone_no_code='+pd_mobile_no_code_val+'&pd_mobile_no='+pd_mobile_no_val+'&pd_email='+pd_email_val+'&pd_dob='+pd_dob_val+'&pd_gender='+pd_gender_val+'&pd_alt_email='+pd_alt_email_val+'&pd_blood_group='+pd_blood_group_val+'&pd_social_status='+pd_social_status_val+'&pd_diffrently_abled='+pd_diffrently_abled_val+'&pd_religion='+pd_religion_val+'&pd_medium_of_instruction='+pd_medium_of_instruction_val+'&pd_hostel_accommodation='+pd_hostel_accommodation_val+'&pd_mother_tongue='+pd_mother_tongue_val+'&pd_advertisment_source='+pd_advertisment_source_val+'&pd_nationality='+pd_nationality_val+'&'+csrfName+'='+csrfHash;
					var moveNxt=0;
					$.ajax({
						type: 'POST',
						url: url,
						data: user_data+'&currentIndex='+currentIndex,
						dataType: 'json',
						cache: false,
						async: false,
						beforeSend: function() { $('.loader').show(); },
						success: function(returndata) {
							if(returndata) {
								if(returndata.status == 'true') {
									var startIndex = currentIndex+1
									window.location.href = url+'?startIndex='+startIndex; 
									$("#formerr").hide();
									moveNxt=1;											
								}									
							}
						},
						error: function(returndata) {								
						  console.log(returndata); 
						  moveNxt=0;							
						  $("#formerr").show(); 							  
						  return false;
						},
					});						  
						if(moveNxt){
							return true;
						}
					} else { 					  								
					pd_campus_pref_1.validate();					  		
					pd_course_pref_1.validate();
					state_pref_1.validate();
					city_pref_1.validate();													
					pd_title.validate();
					pd_firstname.validate();
					pd_lastname.validate();
					pd_mobile_no.validate();
					pd_email.validate();
					pd_dob.validate();
					pd_gender.validate();							
					pd_blood_group.validate();
					pd_social_status.validate();
					pd_diffrently_abled.validate();
					pd_nationality.validate();
					pd_middlename.validate();
					pd_alt_email.validate();													
					return false;
				}
			}
					//end step2
                   //parent detail step3
					if(currentIndex === 2) {
					var pd_father_title = $('#pd_father_title').parsley();
					var pd_father_name = $('#pd_father_name').parsley();
					var pd_father_email = $('#pd_father_email').parsley();
					var pd_father_phone = $('#pd_father_phone').parsley();
					var pd_father_alt_phone = $('#pd_father_alt_phone').parsley();var pd_mother_title = $('#pd_mother_title').parsley();
					var pd_mother_name = $('#pd_mother_name').parsley();
					var pd_mother_phone = $('#pd_mother_phone').parsley();
					var pd_mother_alt_phone = $('#pd_mother_alt_phone').parsley();
					var pd_mother_email = $('#pd_mother_email').parsley();
					var pd_guardian_name = $('#pd_guardian_name').parsley();
					var pd_guardian_phone = $('#pd_guardian_phone').parsley();
					var pd_guardian_email = $('#pd_guardian_email').parsley();
					var pd_guardian_occupation = $('#pd_guardian_occupation').parsley();
					var pd_father_other_occupation=$('#pd_father_other_occupation').parsley();
					var pd_mother_other_occupation=$('#pd_mother_other_occupation').parsley();
					var guardian_other_occupation=$('#guardian_other_occupation').parsley();
					
					///check_visible_input_nameonly_validation('father_other_occupation_div','pd_father_other_occupation','Please Enter Alphabet Only');
					
					///check_visible_input_nameonly_validation('other_occupation_mother_div','pd_mother_other_occupation','Please Enter Alphabet Only');					
					
                    if(pd_father_title.isValid() && pd_father_name.isValid() && pd_mother_title.isValid() && pd_mother_name.isValid() && pd_father_email.isValid() && pd_mother_email.isValid() && pd_guardian_name.isValid() && pd_guardian_phone.isValid() && pd_guardian_email.isValid() && pd_father_phone.isValid() && pd_mother_phone.isValid() && pd_guardian_occupation.isValid() && pd_father_other_occupation.isValid() && pd_mother_other_occupation.isValid() && guardian_other_occupation.isValid() && pd_mother_alt_phone.isValid() && pd_father_alt_phone.isValid()){
                    var pd_father_id = $('#pd_father_id').val();
                    var pd_mother_id = $('#pd_mother_id').val();
                    var pd_guardian_id = $('#pd_guardian_id').val();
    				var pd_father_title = $('#pd_father_title').val();
					var pd_father_name = $('#pd_father_name').val();
					var pd_father_phone_no_code = $('#pd_father_phone_no_code').val();
					var pd_father_phone = $('#pd_father_phone').val();
					var pd_father_alt_phone_no_code = $('#pd_father_alt_phone_no_code').val();
					var pd_father_alt_phone = $('#pd_father_alt_phone').val();
					var pd_father_email = $('#pd_father_email').val();
					var pd_father_occupation = $('#pd_father_occupation').val();
					var pd_mother_title = $('#pd_mother_title').val();
					var pd_mother_name = $('#pd_mother_name').val();
					var pd_mother_phone_no_code = $('#pd_mother_phone_no_code').val();
					var pd_mother_phone = $('#pd_mother_phone').val();
					var pd_mother_alt_phone_no_code = $('#pd_mother_alt_phone_no_code').val();
					var pd_mother_alt_phone = $('#pd_mother_alt_phone').val();
					var pd_mother_email = $('#pd_mother_email').val();
					var pd_mother_occupation = $('#pd_mother_occupation').val();
					var add_guardian_checkbox = $('#add_guardian_checkbox').val();
					var pd_guardian_name = $('#pd_guardian_name').val();
					var pd_guardian_phone_no_code = $('#pd_guardian_phone_no_code').val();
					var pd_guardian_phone = $('#pd_guardian_phone').val();
					var pd_guardian_email = $('#pd_guardian_email').val();
					var pd_guardian_occupation = $('#pd_guardian_occupation').val();
					var father_other_occupation_val='';
					var mother_other_occupation_val='';
					var guardian_other_occupation_val='';
					<?php if(empty($parent_name) || $parent_name=="")  { ?>
                    $("#parent_name").val(pd_father_name);
                    <?php } ?>
					father_other_occupation_val=$('#pd_father_other_occupation').val();
					mother_other_occupation_val=$('#pd_mother_other_occupation').val();
					guardian_other_occupation_val=$('#guardian_other_occupation').val();
					//new
					if(pd_guardian_phone!=''){
						if(pd_mother_phone==pd_guardian_phone || pd_father_phone==pd_guardian_phone){
							$('#pd_guardian_phone').addClass('parsley-error');
							$('#custom-pd_guardian_phone-parsley-error').show();
							$('#custom-pd_guardian_phone-parsley-error').css('color','#ec4561');
							$('#custom-pd_guardian_phone-parsley-error').html('<?php echo PHONE_MATCH_GUARDIAN; ?>');		
							setTimeout(function(){
								$('#pd_guardian_phone').toggleClass('parsley-error');
								$('#custom-pd_guardian_phone-parsley-error').hide();
							}, 3000);							
							return false;
						}	
					}

					if(pd_guardian_email!=''){
						if(pd_mother_email==pd_guardian_email || pd_father_email==pd_guardian_email){
							$('#pd_guardian_email').addClass('parsley-error');
							$('#custom-pd_guardian_email-parsley-error').show();
							$('#custom-pd_guardian_email-parsley-error').css('color','#ec4561');
							$('#custom-pd_guardian_email-parsley-error').html('<?php echo EMAIL_MATCH_GUARDIAN; ?>');	
							setTimeout(function(){
								$('#pd_guardian_email').toggleClass('parsley-error');
								$('#custom-pd_guardian_email-parsley-error').hide();
							}, 3000);
							return false;
						}	
					}
					//end new
                    var user_data = 'pd_father_id='+pd_father_id+'&pd_mother_id='+pd_mother_id+'&pd_guardian_id='+pd_guardian_id+'&pd_father_title='+pd_father_title+'&pd_father_name='+pd_father_name+'&pd_father_phone_no_code='+pd_father_phone_no_code+'&pd_father_phone='+pd_father_phone+'&pd_father_alt_phone_no_code='+pd_father_alt_phone_no_code+'&pd_father_alt_phone='+pd_father_alt_phone+'&pd_father_email='+pd_father_email+'&pd_father_occupation='+pd_father_occupation+'&father_other_occupation='+father_other_occupation_val+'&pd_mother_title='+pd_mother_title+'&pd_mother_name='+pd_mother_name+'&pd_mother_phone_no_code='+pd_mother_phone_no_code+'&pd_mother_alt_phone_no_code='+pd_mother_alt_phone_no_code+'&pd_mother_email='+pd_mother_email+'&pd_mother_occupation='+pd_mother_occupation+'&mother_other_occupation='+mother_other_occupation_val+'&add_guardian_checkbox='+add_guardian_checkbox+'&pd_guardian_name='+pd_guardian_name+'&pd_guardian_phone_no_code='+pd_guardian_phone_no_code+'&pd_guardian_phone='+pd_guardian_phone+'&pd_guardian_email='+pd_guardian_email+'&pd_guardian_occupation='+pd_guardian_occupation+'&guardian_other_occupation='+guardian_other_occupation_val+'&pd_mother_phone='+pd_mother_phone+'&pd_mother_alt_phone='+pd_mother_alt_phone+'&'+csrfName+'='+csrfHash;
                    var moveNxt=0;
                    $.ajax({
							type: 'POST',
							url: url,
							data: user_data+'&currentIndex='+currentIndex,
							dataType: 'json',
							cache: false,
							async: false,
							beforeSend: function() { $('.loader').show(); },
							success: function(returndata) {
								if(returndata) {
									$("#formerr").hide();
									console.log(returndata);																	
									if(returndata[0].status == 'true') {
										var startIndex = currentIndex+1
										window.location.href = url+'?startIndex='+startIndex; 
									    moveNxt=1;										
									}									
								}	
							},
							error: function(returndata) {
								  console.log(returndata);
								  moveNxt=0;							
								  $("#formerr").show(); 							  
								  return false;  
							},
						});							
                    if(moveNxt){
						return true;
					}
					}else{
						pd_father_title.validate();
						pd_father_name.validate();
						pd_father_phone.validate();
						pd_mother_title.validate();
						pd_mother_name.validate();
						pd_father_email.validate();
						pd_mother_email.validate();
						pd_mother_phone.validate();
						pd_guardian_name.validate();
						pd_guardian_phone.validate();
						pd_guardian_email.validate();
						pd_guardian_occupation.validate();
						pd_father_other_occupation.validate();
						pd_mother_other_occupation.validate();
						guardian_other_occupation.validate();
						pd_mother_alt_phone.validate();
						pd_father_alt_phone.validate();
						return false;						
					}
				}
				//end step3

					// Step 4 address form validation
					if(currentIndex === 3) {
					  //return true;
					  var country_addr = $('#country_addr').parsley();
					  var state_addr = $('#state_addr').parsley();
					  var district_addr = $('#district_addr').parsley();
					  var city_addr = $('#city_addr').parsley();
					  var address1 = $('#address_line1').parsley();
					  var pincode = $('#pincode').parsley();
					  if(country_addr.isValid() && state_addr.isValid() && district_addr.isValid() 
					  	&& city_addr.isValid() && address1.isValid() && pincode.isValid()) {
					  	var country_id 	= 	$('#country_addr').val();
					  	var state_id 	= 	$('#state_addr').val();
					  	var district_id = 	$('#district_addr').val();
					  	var city_id     = 	$('#city_addr').val();
					  	var address1    =  	$('#address_line1').val();
					  	var address2    =  	$('#address_line2').val();
					  	var pincode 	=	$('#pincode').val();
					 
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
								if(returndata){									
    								if(returndata.status == 'true') {
    									var startIndex = currentIndex+1
										window.location.href = url+'?startIndex='+startIndex; 
									   
    									$("#formerr").hide();
    									moveNxt=1;										
    								}
								}
							},
							error: function(returndata) {
							console.log(returndata); 
							  moveNxt=0;							
							  $("#formerr").show(); 							  
							  return false; 
							},
						});							
						if(moveNxt){
							return true;
						}
					  } else { 
						country_addr.validate();
						state_addr.validate();
						district_addr.validate();
						city_addr.validate();
						address1.validate();
						pincode.validate();
						return false;
					  }
					}
					//end step 4

				//step 5- academics
				if(currentIndex === 4) {
                var appering 		 = $('#appering').parsley();
                var completed 		 = $('#completed').parsley();
                var canditate_name 	 = $('#canditate_name').parsley();               
				var institute_name 	 = $('#institute_name').parsley();
				var academic_board 	 = $('#academic_board').parsley();
                var other_board_name = $('#other_board_name').parsley();
                var registration_no  = $('#registration_no').parsley();
                var mode_of_study    = $('#mode_of_study').parsley();                
                var marking_scheme   = $('#marking_scheme').parsley();
                var obtained_percentage_cgpa = $('#obtained_percentage_cgpa').parsley();
                var year_of_passing  = $('#year_of_passing').parsley();
				var address_school_college = $('#address_school_college').parsley();
				
                
                // Other Board Name Validation Checking condition Start
				if($('#ob_board').is(':visible')){
                  $('#other_board_name').attr('data-parsley-required', 'true');
                  $('#other_board_name').attr('data-parsley-required-message', '<?php echo REQD_OTHER_BOARD_MSG; ?>'); 
                  $('#other_board_name').attr('data-parsley-nameonly', 'true');
                  $('#other_board_name').attr('data-parsley-nameonly-message', '<?php echo REQD_ALPHA_ONLY_MSG; ?>');           
                }else{
                  $('#other_board_name').attr('data-parsley-required', 'false');
                  $('#other_board_name').attr('data-parsley-nameonly', 'false');
                }
				// Other Board Name Validation Checking condition End
				
				// COndition for Digi locker
                var digilocker_id = $('#nad_id_digilocker_id').parsley();
				
				
                if(appering.isValid() && completed.isValid() && institute_name.isValid() && academic_board.isValid() && other_board_name.isValid() && registration_no.isValid() && mode_of_study.isValid() && marking_scheme.isValid() && obtained_percentage_cgpa.isValid() && year_of_passing.isValid() && digilocker_id.isValid() && address_school_college.isValid()) 
				{
					
				var current_education_qual_status  = $('input[name=current_education_qual_status]:checked').val();
				var canditate_name 				   = $("#canditate_name").val();
				var appering 					   = $("#appering").val();
				var completed 					   = $("#completed").val();
				var institute_name 				   = $("#institute_name").val();
				var academic_board 				   = $("#academic_board").val();					
				var other_board_name 			   = $("#other_board_name").val();
				var registration_no 			   = $("#registration_no").val();
				var mode_of_study 				   = $("#mode_of_study").val();
				var marking_scheme 				   = $("#marking_scheme").val();
				var obtained_percentage_cgpa 	   = $("#obtained_percentage_cgpa").val();
				var year_of_passing 			   = $("#year_of_passing").val();  
				var nad_id_digilocker_id 		   = $("#nad_id_digilocker_id").val();
				var address_school_college 		   = $("#address_school_college").val();
					
                	
				var moveNxt=0;   
				var user_data = 'current_education_qual_status='+current_education_qual_status+'&appering='+appering+'&completed='+completed+'&canditate_name='+canditate_name+'&institute_name='+institute_name+'&academic_board='+academic_board+'&other_board_name='+other_board_name+'&registration_no='+registration_no+'&mode_of_study='+mode_of_study+'&marking_scheme='+marking_scheme+'&obtained_percentage_cgpa='+obtained_percentage_cgpa+'&year_of_passing='+year_of_passing+'&nad_id_digilocker_id='+nad_id_digilocker_id+'&address_school_college='+address_school_college+'&'+csrfName+'='+csrfHash;
				//alert(user_data);
				//alert(url);
				  $.ajax({
							type: 'POST',
							url: url,
							data: user_data+'&currentIndex='+currentIndex,
							dataType: 'json',
							cache: false,
							async: false,
						//	beforeSend: function() { $('.loader').show(); },
							success: function(returndata) {
								if(returndata){									
									if(returndata.twelfth && returndata.applicant_personal_det) {
										var startIndex = currentIndex+1
										//window.location.href = url+'?startIndex='+startIndex; 
										$("#formerr").hide();
										moveNxt=1;										
									}
								}
							},
							error: function(returndata) {
							  console.log(returndata);
							  moveNxt=0;							
							  $("#formerr").show(); 							  
							  return false; 
							},
						});
                      if(moveNxt){
						return true;
					  }    
                  } else {
					  
                  	appering.validate();
                  	completed.validate();
                  	canditate_name.validate();
                  	other_board_name.validate();
                  	institute_name.validate();
                  	academic_board.validate();
                  	registration_no.validate();
                  	mode_of_study.validate();
                  	year_of_passing.validate();
                  	marking_scheme.validate();
                  	obtained_percentage_cgpa.validate();
                  	digilocker_id.validate();
					address_school_college.validate();
					return false;
                  }
                }
        		//end step5 academics
                //step 6 -payment
				if(currentIndex === 5) {
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
					
					if(bank_name.isValid() && branch_name.isValid() && ddnumber.isValid() && ddate.isValid() && online.isValid() && dd.isValid()){
						if($('#online').is(':checked')){
							var payment_mode = 'online';
						}else if($('#dd').is(':checked')){
							var payment_mode = 'dd';
						}						
						if(payment_mode=="dd"){
						var bank_name = $('#BankName').val();
						var branch_name = $('#BranchName').val();
						var dd_cheque_no = $('#DDNumber').val();
						var dd_cheque_date = $('#DDDate').val();
						var user_data = 'bank_name='+bank_name+'&branch_name='+branch_name+'&dd_cheque_no='+dd_cheque_no+'&dd_cheque_date='+dd_cheque_date+'&payment_mode='+payment_mode+'&app_form_id='+app_form_id+'&'+csrfName+'='+csrfHash;		
                        var moveNxt=0;
                        <?php if(empty($payment_details_list)) { ?> 
						
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
										setTimeout(function() { window.location.href = redirect_payment_thank_you+'&payment_mode='+payment_mode+'&currentIndex='+currentIndex+url_edit; }, 200);
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
						<?php                      
						} else { ?>						
						return true;
						<?php } ?>
						}
						if (payment_mode=='online')	
						{		<?php if(empty($payment_details_list)) { ?>
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
				//step 6 -payment end

				if(currentIndex == 6) {
				 var photograph=$('#photograph').parsley();
	        	 var signature=$('#signature').parsley();
	        	 var graduation_marksheet=$('#graduation_marksheet').parsley();
	        	// Get Regenerated CSRF Dynamically
				 var csrfHashRegenerateonDec = $("input[name='"+csrfName+"']").val();
				
				 var user_data = ''+csrfName+'='+csrfHashRegenerateonDec;
		        	if(photograph.isValid() && signature.isValid() && graduation_marksheet.isValid() ) 
					{	
						var moveNxt = 0;  
						$.ajax({
								type: 'POST',
								url: url,
								data: user_data+'&currentIndex='+currentIndex,
								dataType: 'json',
								cache: false,
								async: false,
								beforeSend: function() { $('.loader').show(); },
								success: function(returndata) {
									if(returndata){									
										if(returndata.status=true) {
											var startIndex = currentIndex+1
											window.location.href = url+'?startIndex='+startIndex; 
											$("#formerr").hide();
											moveNxt=1;										
										}
									}
								},
								error: function(returndata) {
								  console.log(returndata);
								  moveNxt=0;							
								  $("#formerr").show(); 							  
								  return false; 
								},
							});
						  if(moveNxt){
							return true;
						  }    
					  } else {						 	
							photograph.validate();
							signature.validate();
							graduation_marksheet.validate();
							return false;
					  }
						
					}
			}
			else { 
				return true; 
			}				
		},
		saveState: true,
        onStepChanged: function (event, currentIndex, priorIndex) { 
        	var isexit=($(this).attr('isexit'));        	
        	if(isexit!='undefined' &&  isexit==1)
        	{
        	   window.location.href = save_exit_redirect_url;
        	}
        	if(currentIndex==4){
				$(".actions ul > li:nth-child(2) a").text('<?php echo MAKE_PAYMENT; ?>');
			}else{
				$(".actions ul > li:nth-child(2) a").text('<?php echo NEXT_STEP; ?>');
			}
        	enable_saveExit_btn(currentIndex,5);
        	// This code for step count display in view part like STEPS 1 OF 7
			$("#show_currentindex").text(currentIndex+1+' Of '+total_wizard_Step);

            if(currentIndex == parseInt(total_wizard_Step - 1)){
				if(mode_edit_url !=''){
					enable_preview_btn(currentIndex,'<?php echo base_url();?>hsug_preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
				}else{
					enable_preview_btn(currentIndex,'<?php echo base_url();?>hsug_preview');
				}				
				$("#save_exit").remove();
			}else{
				$("#previewbtn").remove();
			}
		}, 
        onCanceled: function (event) { },
        onFinishing: function (event, currentIndex) { return true; }, 
        onFinished: function (event, currentIndex) {            
        	var applicant_name=$('#applicant_name').parsley();
            var parent_name=$('#parent_name').parsley();
             
        	var applicant_name_val = $('#applicant_name').val();
            var parent_name_val = $('#parent_name').val();
           
            var declaration_date = $('#date_dec').val();
            var user_data = 'applicant_name='+applicant_name_val+'&parent_name='+parent_name_val+'&declaration_date='+declaration_date+'&'+csrfName+'='+csrfHash;
            if(applicant_name.isValid() && parent_name.isValid())
            {
            var moveNxt=0;
			$.ajax({
				type: 'POST',
				url: url,
				data: user_data+'&currentIndex='+currentIndex,
				dataType: 'json',
				cache: false,
				async: false,
				beforeSend: function() { $('.loader').show(); },
				success: function(returndata) {
					if(returndata.status == 'true') {
						$("#formerr").hide();
						 setTimeout(function() { window.location.href = redirect+url_edit; }, 100);
					 }
				},
				error: function(returndata) {
					console.log(returndata);
					moveNxt=0;							
					$("#formerr").show();;	 
				},
			});
            }else{            	
            	applicant_name.validate();
            	parent_name.validate();
            }
				
        },

        /* Labels */
        labels: {
            cancel: "Cancel",
            current: "current step:",
            pagination: "Pagination",
            finish: "Submit",
            next: "Next",
            previous: "Previous",
            loading: "Loading ..."
        }		
	}
	
	$("#hsug_form").steps(settings);
  //setsave exit attr	
    $(document).on("click", "#save_btn" , function() {
    	 $("#hsug_form").attr('isexit',1);
         $("#hsug_form").steps('next');
    });
    
    $('.actions a').click(function(){        	 
      $("#hsug_form").attr('isexit','');
    }); 
//end set attr
    //to remove links from previous tabs a
    <?php if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) && ($mode_edit == '')) { ?>
     $( ".steps li" ).each(function( index ) { 
      if(index<6){       	 
   	  $("#hsug_form-t-"+index).removeAttr("href");
     }			   
   	});
    <?php } ?>
	 $(document).ready(function () {
		$( "#pd_lastname" ).keyup(function() {
			if($(this).val()=='.'){
				$("#pd_lastname").removeClass('parsley-error');
				$(".parsley-nameonly").hide();
			}else{
				$("#pd_lastname").addClass('parsley-error');
				$(".parsley-nameonly").show();				
			}
			$("#pd_lastname").removeClass('parsley-error');
			$(".parsley-nameonly").hide();			
		});		

		$("#DDDate").datepicker({
			format:"dd/mm/yyyy" , autoclose: !0, todayHighlight: true,todaybtn:true,endDate: todaydate}).on('changeDate', function(e) {$("#DDDate").parsley().validate();
		});	
		
		$('#academic_accordion').click();
		var no_study_resident_in_msg = "Sorry, Studied Resident not available.";
		var no_resident_status_msg = "Sorry,  Resident status/category not available.";
		var no_nationality_msg = "Sorry, Nationality not available.";
		var no_blood_grp_msg = "Sorry, Campus not available.";
		var no_country_msg = "Sorry, Country not available.";
		var no_state_msg = "Sorry, State not available.";
		var no_city_msg = "Sorry, City not available.";
		var no_district_msg = "Sorry, District not available.";
		var no_mobile_code_msg = "Sorry, Mobile code not available.";
		var no_course_msg = "Sorry, Course not available.";		
		var no_branch_msg = "Sorry, Branch not available.";
		var no_specialization_msg = "Sorry, Specialization not available.";
		var no_campus_msg = "Sorry, Campus not available.";
		var no_gender_title_msg = "Sorry, Gender Title not available.";	
		var no_gender_msg = "Sorry, Gender not available.";	
		var no_blood_group_msg = "Sorry, Blood Group not available.";
		var no_religions_msg = "Sorry, Religion not available.";
		var no_medium_of_instruction_msg = "Sorry, Medium Of Instruction not available.";
		var no_hostel_accommodation_msg = "Sorry, Hostel Accommodation not available.";
		var no_mother_tongues_msg = "Sorry, Mother Tongue not available.";
		var no_advertisement_source_msg = "Sorry, Advertisement Source not available.";
		var no_social_status_msg = "Sorry, Social Status not available.";
		var no_differently_abled_msg = "Sorry, Differently Abled not available.";
		var no_title_msg = "Sorry, Title not available.";
		var no_occupation_msg = "Sorry, Occupation not available.";
		var no_mobile_code_msg = "Sorry, Mobile code not available.";
		var no_result_status_msg = "Sorry, Status not available.";
		var no_current_qualification_status = 'Sorry, Qualification Status not available.';
		var no_board_msg = "Sorry, Board not available";
		var no_user_marking_scheme_msg = "Sorry, Marking Scheme not available.";
		var no_yop_status = 'Sorry, Year of passing not available.';
	
		var no_institute_university_msg = "Sorry, Institute/University not available.";
		var no_state_msg = "Sorry, State not available.";
		var no_mode_of_study ="Sorry, Mode of Study not available.";
		var no_qualified_not_qualified_msg ="Sorry, Competitive Exam Qualified Status not available.";
		var no_taken_any_competitive_exam_msg = "Sorry, Competitive Exam Taken Status not available.";
		var no_is_work_experience_msg = "Sorry, Work Experience Status not available.";
	    var no_competitive_exam_msg = "Sorry, Competitive Exams not available.";
		
		var no_banks_msg = "Sorry, Banks not available.";
		
		var no_board_msg = "Sorry, Board not available.";
		
		getSelect2('BankName','<?php echo base_url("get_banks"); ?>?sort_by=name&sort_order=asc','Choose Bank', formatRepoCommon,no_banks_msg, false, formatRepoSelection);
		
		getSelect2('academic_board','<?php echo base_url("get_board"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Board', formatRepoCommon,no_board_msg, false, formatRepoSelection);
		
		
		//getSelect2('studied_from_india','<?php echo base_url("studied_from_india"); ?>?sort_by=name&sort_order=asc','Select Status - Yes or No', formatRepoCommon,no_study_resident_in_msg, false, formatRepoSelection);
		
		// Basic Details Drop Down
		getSelect2('studied_from_india','<?php echo base_url("studied_from_india"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Status - Yes or No', formatRepoCommon,no_study_resident_in_msg, false, formatRepoSelection);
		
		getSelect2('non_indian_resident','<?php echo base_url("resident_status"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Resident Status', formatRepoCommon,no_resident_status_msg, false, formatRepoSelection);
		
		
		//preference &basic detail
		
		var course_id = "course_pref_1";
		var dbcourse_id = '<?php echo $course_id; ?>';
		var dbcourse_val = '<?php echo $course_name; ?>';
		if(dbcourse_id){
			setTimeout(function(){ select2Set(course_id,dbcourse_id,dbcourse_val);
			}, 1);
		}

		
		getSelect2('campus_pref_1','<?php echo base_url("course_preference"); ?>?is_lookup_master=1&is_campus=1&grade_id='+grad_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc'+url_edit,'Select Campus Perferences 1', formatRepoCommon,no_campus_msg, false, formatRepoSelection);
        enable_course_by_campus('campus_pref_1','course_pref_1','main_div_course_prefer_1','Select Course Perferences 1',grad_id);
		enable_course_by_campus('campus_pref_1','course_pref_2','main_div_course_prefer_2','Select Course Perferences 2',grad_id);
		enable_course_by_campus('campus_pref_1','course_pref_3','main_div_course_prefer_3','Select Course Perferences 3',grad_id);
		
		//course_pref_change1('course_pref_1','course_pref_2','course_pref_3','Select Course Perferences 2','Select Course Perferences 3');
		//course_pref_change1('course_pref_2','course_pref_1','course_pref_3','Select Course Perferences 1','Select Course Perferences 3');
		//course_pref_change1('course_pref_3','course_pref_1','course_pref_2','Select Course Perferences 1','Select Course Perferences 2');
		
	    /*
		getSelect2('campus_pref_2','<?php echo base_url("course_preference"); ?>?is_lookup_master=1&is_campus=1&grade_id='+grad_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Select Campus Perferences 2', formatRepoCommon,no_campus_msg, false, formatRepoSelection);
	    enable_course_by_campus('campus_pref_2','course_pref_2','main_div_course_prefer_2','Select Course Perferences 2',grad_id);
		
		getSelect2('campus_pref_3','<?php echo base_url("course_preference"); ?>?is_lookup_master=1&is_campus=1&grade_id='+grad_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Select Campus Perferences 3', formatRepoCommon,no_campus_msg, false, formatRepoSelection);
		enable_course_by_campus('campus_pref_3','course_pref_3','main_div_course_prefer_3','Select Course Perferences 3',grad_id);
		*/

		test_state_pref('state_pref_1','Select Test State Perferences 1');
		test_state_pref('state_pref_2','Select Test State Perferences 2');
		test_state_pref('state_pref_3','Select Test State Perferences 3');

		test_state_pref_change('state_pref_1','city_pref_1','main_div_city_pref_1','Select Test City Perferences 1');
		test_state_pref_change('state_pref_2','city_pref_2','main_div_city_pref_2','Select Test City Perferences 2');
		test_state_pref_change('state_pref_3','city_pref_3','main_div_city_pref_3','Select Test City Perferences 3');
		
		getSelect2('pd_nationality','<?php echo base_url("get_nationalities"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Nationality', formatRepoCommon,no_nationality_msg, false, formatRepoSelection);
        getSelect2('bloodgroups','<?php echo base_url("get_bloodgroups"); ?>?sort_by=blood_grp_id&sort_order=asc'+url_edit,'Select Blood Groups', formatRepoCommon,no_blood_grp_msg, false, formatRepoSelection);
   		getSelect2('phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);

   		getSelect2('pd_title','<?php echo base_url("get_gender_title"); ?>?is_lookup_master=1'+url_edit,'Select Gender Title', formatRepoCommon,no_gender_title_msg, false, formatRepoSelection);
		
		getSelect2('pd_gender','<?php echo base_url("get_gender"); ?>?is_lookup_master=1'+url_edit,'Select Gender', formatRepoCommon,no_gender_msg, false, formatRepoSelection);
		
		getSelect2('pd_blood_group','<?php echo base_url("get_bloodgroups"); ?>?sort_by=blood_grp_id&sort_order=asc'+url_edit,'Select Blood Groups', formatRepoCommon,no_blood_group_msg, false, formatRepoSelection);

		getSelect2('pd_religion','<?php echo base_url("get_religions"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Religions', formatRepoCommon,no_religions_msg, false, formatRepoSelection);
		
		getSelect2('pd_medium_of_instruction','<?php echo base_url("get_mother_tongues"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Medium Of Instruction', formatRepoCommon,no_medium_of_instruction_msg, false, formatRepoSelection);

		getSelect2('pd_hostel_accommodation','<?php echo base_url("get_hostel_accommodation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Hostel Accommodation', formatRepoCommon,no_hostel_accommodation_msg, false, formatRepoSelection);

		getSelect2('pd_mother_tongue','<?php echo base_url("get_mother_tongues"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Mother Tongues', formatRepoCommon,no_mother_tongues_msg, false, formatRepoSelection);
		
		getSelect2('pd_advertisement_source','<?php echo base_url("get_advertisement_source"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Advertisement Source', formatRepoCommon,no_advertisement_source_msg, false, formatRepoSelection);

		getSelect2('pd_social_status','<?php echo base_url("get_social_status"); ?>?is_lookup_master=1'+url_edit,'Select Social Status', formatRepoCommon,no_social_status_msg, false, formatRepoSelection);

		getSelect2('pd_diffrently_abled','<?php echo base_url("get_are_you_differently_abled"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Differently Abled', formatRepoCommon,no_differently_abled_msg, false, formatRepoSelection);

        getSelect2('pd_father_title','<?php echo base_url("get_parent_title"); ?>?is_lookup_master=1&is_father=1'+url_edit,'Select Title', formatRepoCommon,no_title_msg, false, formatRepoSelection);
		
		getSelect2('pd_father_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);		
		getSelect2('pd_mother_alt_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
		getSelect2('pd_father_alt_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);	
		
		getSelect2('pd_father_occupation','<?php echo base_url("parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Father Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);

		getSelect2('pd_mother_title','<?php echo base_url("get_mother_title"); ?>?is_lookup_master=1&is_mother=1'+url_edit,'Select Title', formatRepoCommon,no_title_msg, false, formatRepoSelection);
		
		getSelect2('pd_mother_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
		
		getSelect2('pd_mother_occupation','<?php echo base_url("parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Mother Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);
		
		getSelect2('pd_guardian_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>	?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
		
		getSelect2('pd_guardian_occupation','<?php echo base_url("parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Guardian Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);
		
		getSelect2('country_addr','<?php echo base_url("get_countries"); ?>?sort_by=country_id&sort_order=asc'+url_edit,'Select Country', formatRepoCommon,no_country_msg, false, formatRepoSelection);	

		 getSelect2('institute_university','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select University', formatRepoCommon,no_institute_university_msg, false, formatRepoSelection);

         getSelect2('mode_of_study','<?php echo base_url("get_mode_of_study"); ?>?is_lookup_master=1'+url_edit,'Select Mode Of Study', formatRepoCommon,no_mode_of_study, false, formatRepoSelection);

         getSelect2('marking_scheme','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Select Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
		
		//course_pref_change_new('course_pref_1','Select Course Preference 1');
         
	    $('#campus_pref_1').on('change',function() {		   
	    	if($(this).val()==null || $(this).val()==""){
				 $("#main_div_course_prefer_1").hide();
			 }
			campus_pref_change ('campus_pref_1','campus_pref_2','campus_pref_3','Select Campus Perferences',1);
        });
		
		

		 $('#campus_pref_2').on('change',function() {
			 if($(this).val()==null  || $(this).val()==""){
				 $("#main_div_course_prefer_2").hide();
			 }
			 $("#custom-field-campus-error").html('');
			 campus_pref_change('campus_pref_2','campus_pref_3','campus_pref_1','Select Campus Perferences',2);
        });

		 $('#campus_pref_3').on('change',function() {
			 if($(this).val()==null  || $(this).val()==""){
				 $("#main_div_course_prefer_3").hide();
			 }
			 var campus2val=$("#campus_pref_2").val();
			 var campus3val=$("#campus_pref_3").val();			
			 if(campus2val=="null" || campus2val==null  || campus2val=="")
			 {
                $("#custom-field-campus-error").html("<?php echo REQD_SELECT_CAMPUS_PREFERENCE2_MSG; ?>");
                $("#campus_pref_3").val('');
                $("#main_div_course_prefer_3").hide();
                 
			 }else{
				 
				 $("#custom-field-campus-error").html('');
			 }
			// campus_pref_change('campus_pref_3','campus_pref_1','campus_pref_2','Select Campus Perferences');
        });
		
		//fetch education from india
		var edu_from_india = "studied_from_india";
   		var db_edu_from_india = '<?php echo $qualifyingexamfromindia;?>';

   		if(db_edu_from_india=='f'){
   			var db_edu_from_indiaVal = '<?php echo REQD_SELECT_GRAD_STATUS_MSG; ?>';
   			$("#studied_from_india").prepend("<option value=''>"+db_edu_from_indiaVal+"</option>");
   		}else{
   			if(db_edu_from_india=='t'){
   				var db_edu_from_indiaVal = 'Yes';
   			}else{
   				var db_edu_from_indiaVal = 'No';
   			}			
   		}
   		if(db_edu_from_india){
   	   		setTimeout(function(){ 
   	   			select2Set(edu_from_india,db_edu_from_india,db_edu_from_indiaVal);
   	   		}, 1);
   	   	}	

   	      <?php
             if($i_confirmChecked == 't') {
             ?>
             $('#i_confirm').prop('checked', true);            
             <?php
         	}
             ?>
	   
	    //fetch campus dropdown
	    <?php if($applicant_campus_details_list) {	      
           foreach($applicant_campus_details_list as $k=>$v) {
               $choice_no=$v['choice_no'];
               $applicant_campus_prefer_id[$choice_no] = $v['applicant_campus_prefer_id'];
               $applicant_campus_campus_id[$choice_no] = $v['campus_id'];
               $applicant_campus_campus_name[$choice_no] = $v['campus_name'];
               $applicant_campus_choice_no[$choice_no] = $v['choice_no'];
               $applicant_campus_is_active[$choice_no] = $v['is_active'];
           }
        }
      
        if($applicant_campus_campus_id) {
            foreach($applicant_campus_campus_id as $k=>$v) {
                //$campus_prefer_k = $k+1;
                $campus_prefer_k = $k;
        ?>
                var campus_pref_<?php echo $campus_prefer_k; ?> = "campus_pref_<?php echo $campus_prefer_k; ?>";
                var campus_pref_id<?php echo $campus_prefer_k; ?> = '<?php echo $v; ?>';
                var campus_pref_name<?php echo $campus_prefer_k; ?> = '<?php echo $applicant_campus_campus_name[$k]; ?>';
                 if(campus_pref_id<?php echo $campus_prefer_k; ?>){
                    setTimeout(function(){ select2Set(campus_pref_<?php echo $campus_prefer_k; ?>,campus_pref_id<?php echo $campus_prefer_k; ?>,campus_pref_name<?php echo $campus_prefer_k; ?>);
                    	$('#'+campus_pref_<?php echo $campus_prefer_k; ?>).trigger('change');
                    }, 1);
                }   
        <?php
            }
        }
        ?>
	    //end fetch campus dropdown
	    
	    //fetch course
        <?php
        if($applicant_course_details_list) {
            foreach($applicant_course_details_list as $k=>$v) {
                $choice_no=$v['choice_no'];
                $applicant_course_id[$choice_no] = $v['applicant_course_id'];
                $applicant_course_course_id[$choice_no] = $v['course_id'];
                $applicant_course_course_name[$choice_no] = $v['course_name'];
                $applicant_course_choice_no[$choice_no] = $v['choice_no'];
                $applicant_course_is_active[$choice_no] = $v['is_active'];
               
            }
        }
            if($applicant_course_course_id) {
                foreach($applicant_course_course_id as $k=>$v) {
                    //$course_prefer_k = $k+1;
                    $course_prefer_k = $k;
            ?>
                    var course_pref_<?php echo $course_prefer_k; ?> = "course_pref_<?php echo $course_prefer_k; ?>";
                    var course_pref_id<?php echo $course_prefer_k; ?> = '<?php echo $v; ?>';
                    var course_pref_name<?php echo $course_prefer_k; ?> = '<?php echo $applicant_course_course_name[$k]; ?>';
                     if(course_pref_id<?php echo $course_prefer_k; ?> != ''){
                        setTimeout(function(){ select2Set(course_pref_<?php echo $course_prefer_k; ?>,course_pref_id<?php echo $course_prefer_k; ?>,course_pref_name<?php echo $course_prefer_k; ?>);
                        	$('#'+course_pref_<?php echo $course_prefer_k; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
          ?>
          //end fetch course
          //fetch city
            <?php
            if($applicant_city_prefer_details_list) {
                foreach($applicant_city_prefer_details_list as $k=>$v) {
                    $applicant_city_id[] = $v['applicant_city_id'];
                    $applicant_city_city_id[] = $v['city_id'];
                    $applicant_city_city_name[] = $v['city_name'];
                    $applicant_city_choice_no[] = $v['choice_no'];
                    $applicant_city_state_id[] = $v['state_id'];
                    $applicant_city_state_name[] = $v['state_name'];
                }
            }
            
          
            if($applicant_city_state_id) {
                foreach($applicant_city_state_id as $k=>$v) {
                    $state_k = $k+1;
                    ?>
                    var state_pref_<?php echo $state_k; ?> = "state_pref_<?php echo $state_k; ?>";
                    var state_pref_id<?php echo $state_k; ?> = '<?php echo $v; ?>';
                    var state_pref_name<?php echo $state_k; ?> = '<?php echo $applicant_city_state_name[$k]; ?>';
                     if(state_pref_id<?php echo $state_k; ?> != ''){
                        setTimeout(function(){ select2Set(state_pref_<?php echo $state_k; ?>,state_pref_id<?php echo $state_k; ?>,state_pref_name<?php echo $state_k; ?>);
                        	$('#'+state_pref_<?php echo $state_k; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
           
            if($applicant_city_city_id) {
                foreach($applicant_city_city_id as $k=>$v) {
                    $city_k = $k+1;
            ?>
          
                    var city_pref_<?php echo $city_k; ?> = "city_pref_<?php echo $city_k; ?>";
                    var city_pref_id<?php echo $city_k; ?> = '<?php echo $v; ?>';
                    var city_pref_name<?php echo $city_k; ?> = '<?php echo $applicant_city_city_name[$k]; ?>';
                    if(city_pref_id<?php echo $city_k; ?> != ''){
                        setTimeout(function(){ select2Set(city_pref_<?php echo $city_k; ?>,city_pref_id<?php echo $city_k; ?>,city_pref_name<?php echo $city_k; ?>);
                        	$('#'+city_pref_<?php echo $city_k; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
            ?>
          //end fetch city
        //fetch dropdown-personal detail
        <?php
        $nationality_id = $applicant_basic_details_list['nation_id'];
        $nationality_name = $applicant_basic_details_list['nationality'];
        
        $tittle_id = $applicant_basic_details_list['tittle_id'];
        $tittle_name = $applicant_basic_details_list['tittle_name'];
        $blood_id = $applicant_basic_details_list['blood_id'];
        $blood_group = $applicant_basic_details_list['blood_group'];
        $gender_id = $applicant_basic_details_list['gender_id'];
        $gender = $applicant_basic_details_list['gender'];
        $social_status_id = $applicant_basic_details_list['social_status_id'];
        $social_status = $applicant_basic_details_list['social_status'];
        $dif_abled = $applicant_basic_details_list['dif_abled'];
        
        $dif_abled=strtolower($dif_abled);
        if($dif_abled == 't' || $dif_abled=="yes") {
            $dif_abled_select = 'yes';
            $dif_abled_select_name = 'Yes';
        } else {
            if($dif_abled=="no" || $dif_abled=="f")
            {
                $dif_abled_select = 'no';
                $dif_abled_select_name = 'No';
            }
        }
        $religion_id = $applicant_basic_details_list['religion_id'];
        $religion = $applicant_basic_details_list['religion_name'];
        $medium_of_instruction_id = $applicant_basic_details_list['medium_of_instruction_id'];
        $medium_of_instruction = $applicant_basic_details_list['medium_of_instruction'];
        // $hostel_accommodation_id = $applicant_basic_details_list['hostel_accommodation_id'];
        // $hostel_accommodation = $applicant_basic_details_list['hostel_accommodation'];
        $hostel_accommodation = $applicant_basic_details_list['prefer_hostel'];
        
        $hostel_accommodation=strtolower($hostel_accommodation);
        if($hostel_accommodation == 't' || $hostel_accommodation=="yes") {
            $hostel_accommodation_select = 'yes';
            $hostel_accommodation_select_name = 'Yes';
        } else {
            if($hostel_accommodation == 'f' || $hostel_accommodation=="no")
            {
                $hostel_accommodation_select = 'no';
                $hostel_accommodation_select_name = 'No';
            }
        }
        
        $mother_tongue_id = $applicant_basic_details_list['mothertongue_id'];
        $mother_tongue = $applicant_basic_details_list['mothertongue_name'];
        
        $advertisement_source_id = $applicant_basic_details_list['advertisement_source_id'];
        $advertisement_source = $applicant_basic_details_list['source_name'];
        $medium_of_instruction_id = $applicant_other_details_list['medofinst'];
        $medium_of_instruction_name = $applicant_other_details_list['medium_of_study_name'];
        $phone_no_code = $applicant_basic_details_list['applicant_mob_country_code_id'];
        $phone_no_code_name = $applicant_basic_details_list['applicant_mob_country_code_name'];
        ?>
        var phone_no_code = "phone_no_code";
		var phone_no_code_id = '<?php echo $phone_no_code; ?>';
		var phone_no_code_name_val = '<?php echo $phone_no_code_name; ?>';
		if(phone_no_code_id){
			setTimeout(function(){ 
				select2Set(phone_no_code,phone_no_code_id,phone_no_code_name_val);
				$('#'+phone_no_code).trigger('change');
			}, 1);
		}
        var pd_nationality = "pd_nationality";
		var dbnationality_id = '<?php echo $nationality_id; ?>';
		var dbnationality_name_val = '<?php echo $nationality_name; ?>';
		if(dbnationality_id){
			setTimeout(function(){ 
				select2Set(pd_nationality,dbnationality_id,dbnationality_name_val);
				$('#'+pd_nationality).trigger('change');
			}, 1);
		}

		var pd_title = "pd_title";
		var dbtitle_id = '<?php echo $tittle_id; ?>';
		var dbtitle_name_val = '<?php echo $tittle_name; ?>';
		if(dbtitle_id){
			setTimeout(function(){ 
				select2Set(pd_title,dbtitle_id,dbtitle_name_val);
				$('#'+pd_title).trigger('change');
			}, 1);
		}

		var pd_blood_group = "pd_blood_group";
		var dbblood_group_id = '<?php echo $blood_id; ?>';
		var dbblood_group_name_val = '<?php echo $blood_group; ?>';
		if(dbblood_group_id){
			setTimeout(function(){ 
				select2Set(pd_blood_group,dbblood_group_id,dbblood_group_name_val);
				$('#'+pd_blood_group).trigger('change');
			}, 1);
		}

		var pd_gender = "pd_gender";
		var dbgender_id = '<?php echo $gender_id; ?>';
		var dbgender_name_val = '<?php echo $gender; ?>';
		if(dbgender_id){
			setTimeout(function(){ 
				select2Set(pd_gender,dbgender_id,dbgender_name_val);
				$('#'+pd_gender).trigger('change');
			}, 1);
		}

		var pd_social_status = "pd_social_status";
		var dbsocial_status_id = '<?php echo $social_status_id; ?>';
		var dbsocial_status_name_val = '<?php echo $social_status; ?>';
		if(dbsocial_status_id){
			setTimeout(function(){ 
				select2Set(pd_social_status,dbsocial_status_id,dbsocial_status_name_val);
				$('#'+pd_social_status).trigger('change');
			}, 1);
		}

		var pd_religion = "pd_religion";
		var dbreligion_id = '<?php echo $religion_id; ?>';
		var dbreligion_name_val = '<?php echo $religion; ?>';
		if(dbreligion_id){
			setTimeout(function(){ 
				select2Set(pd_religion,dbreligion_id,dbreligion_name_val);
				$('#'+pd_religion).trigger('change');
			}, 1);
		}

		var pd_medium_of_instruction = "pd_medium_of_instruction";
		var dbmedium_of_instruction_id = '<?php echo $medium_of_instruction_id; ?>';
		var dbmedium_of_instruction_name_val = '<?php echo $medium_of_instruction_name; ?>';
		if(dbmedium_of_instruction_id){
			setTimeout(function(){ 
				select2Set(pd_medium_of_instruction,dbmedium_of_instruction_id,dbmedium_of_instruction_name_val);
				$('#'+pd_medium_of_instruction).trigger('change');
			}, 1);
		}

		var pd_hostel_accommodation = "pd_hostel_accommodation";
		var dbhostel_accommodation_id = '<?php echo $hostel_accommodation_select; ?>';
		var dbhostel_accommodation_name_val = '<?php echo $hostel_accommodation_select_name; ?>';
		if(dbhostel_accommodation_id){
			setTimeout(function(){ 
				select2Set(pd_hostel_accommodation,dbhostel_accommodation_id,dbhostel_accommodation_name_val);
				$('#'+pd_hostel_accommodation).trigger('change');
			}, 1);
		}

		var pd_mother_tongue = "pd_mother_tongue";
		var dbmother_tongue_id = '<?php echo $mother_tongue_id; ?>';
		var dbmother_tongue_name_val = '<?php echo $mother_tongue; ?>';
		if(dbmother_tongue_id){
			setTimeout(function(){ 
				select2Set(pd_mother_tongue,dbmother_tongue_id,dbmother_tongue_name_val);
				$('#'+pd_mother_tongue).trigger('change');
			}, 1);
		}

		var pd_advertisement_source = "pd_advertisement_source";
		var dbadvertisement_source_id = '<?php echo $advertisement_source_id; ?>';
		var dbadvertisement_source_name_val = '<?php echo $advertisement_source; ?>';
		if(dbadvertisement_source_id){
			setTimeout(function(){ 
				select2Set(pd_advertisement_source,dbadvertisement_source_id,dbadvertisement_source_name_val);
				$('#'+pd_advertisement_source).trigger('change');
			}, 1);
		}

		var pd_diffrently_abled = "pd_diffrently_abled";
		var dif_abled_select = '<?php echo $dif_abled_select; ?>';
		var dif_abled_select_name = '<?php echo $dif_abled_select_name; ?>';
		if(dif_abled_select){
			setTimeout(function(){ 
				select2Set(pd_diffrently_abled,dif_abled_select,dif_abled_select_name);
				$('#'+pd_diffrently_abled).trigger('change');
			}, 1);
		}
        //personal data fetch end
       // alert('<?php echo $add_gardian;?>');
		//fetch parent detail
		<?php
		
            
            if($applicant_parent_details_list) {
               foreach($applicant_parent_details_list as $k=>$v) {
                  $parent_type_id = $v['parent_type_id'];
                  $app_parent_det_id[$parent_type_id] = $v['app_parent_det_id'];
                  $applicant_parent_parent_type_name[$parent_type_id] = $v['parent_type_name'];
                  $applicant_parent_parent_name[$parent_type_id] = $v['parent_name'];
                  $applicant_parent_mobile_no[$parent_type_id] = $v['mobile_no'];
                  $applicant_parent_email_id[$parent_type_id] = $v['email_id'];
                  $applicant_parent_occupation[$parent_type_id] = $v['occupation_id'];
                  $applicant_parent_occupation_name[$parent_type_id] = $v['occupation_name'];
                  $applicant_parent_mob_country_code_id[$parent_type_id] = $v['mob_country_code_id'];
                  $applicant_parent_country_mob_code[$parent_type_id] = $v['country_mob_code'];
                  $applicant_parent_alt_mob_countrycode_id[$parent_type_id] = $v['alt_mob_countrycode_id'];
                  $applicant_parent_alt_mob_country_code[$parent_type_id] = $v['alt_mob_country_code'];
                  $applicant_parent_alt_mobile_no[$parent_type_id] = $v['alt_mobile_no'];
                  $applicant_parent_title[$parent_type_id] = $v['title'];
               }
            }
           ?>
          
           <?php
                   if($applicant_parent_title_id) {
                       foreach($applicant_parent_title_id as $k=>$v) {
                       	if($k == $parent_type_id_father) {
                       		$input_name = 'pd_father_title';
                       	} else if ($k == $parent_type_id_mother) {
                       		$input_name = 'pd_mother_title';
                       	}
                   ?>
                           var parent_title<?php echo $k; ?> = '<?php echo $input_name; ?>';
                           var parent_id<?php echo $k; ?> = '<?php echo $v; ?>';
                           var parent_name<?php echo $k; ?> = '<?php echo $applicant_parent_title_name[$k]; ?>';
                            if(parent_id<?php echo $k; ?>){
                               setTimeout(function(){ select2Set(parent_title<?php echo $k; ?>,parent_id<?php echo $k; ?>,parent_name<?php echo $k; ?>);
                               	$('#'+parent_title<?php echo $k; ?>).trigger('change');
                               }, 1);
                           }   
                   <?php
                       }
                   }
                   ?>

            <?php
            if($applicant_parent_mob_country_code_id) {
                foreach($applicant_parent_mob_country_code_id as $k=>$v) {
                	if($k == $parent_type_id_father) {
                		$input_name = 'pd_father_phone_no_code';
                	} else if ($k == $parent_type_id_mother) {
                		$input_name = 'pd_mother_phone_no_code';
                	} else {
                		$input_name = 'pd_guardian_phone_no_code';
                	}
            ?>
                    var phone_no_code<?php echo $k; ?> = '<?php echo $input_name; ?>';
                    var phone_no_code_id<?php echo $k; ?> = '<?php echo $v; ?>';
                    var phone_no_code_name<?php echo $k; ?> = '<?php echo $applicant_parent_country_mob_code[$k]; ?>';
                     if(phone_no_code_id<?php echo $k; ?>){
                        setTimeout(function(){ select2Set(phone_no_code<?php echo $k; ?>,phone_no_code_id<?php echo $k; ?>,phone_no_code_name<?php echo $k; ?>);
                        	$('#'+phone_no_code<?php echo $k; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
            ?>

            <?php
            if($applicant_parent_alt_mob_countrycode_id) {
                foreach($applicant_parent_alt_mob_countrycode_id as $k=>$v) {
                	if($k == $parent_type_id_father) {
                		$input_name = 'pd_father_alt_phone_no_code';
                	} else if ($k == $parent_type_id_mother) {
                		$input_name = 'pd_mother_alt_phone_no_code';
                	} else {
                		$input_name = 'pd_guardian_alt_phone_no_code';
                	}
            ?>
            var alt_phone_no_code<?php echo $k; ?> = '<?php echo $input_name; ?>';
            var alt_phone_no_code_id<?php echo $k; ?> = '<?php echo $v; ?>';
            var alt_phone_no_code_name<?php echo $k; ?> = '<?php echo $applicant_parent_alt_mob_country_code[$k]; ?>';
             if(alt_phone_no_code_id<?php echo $k; ?>){
                setTimeout(function(){ select2Set(alt_phone_no_code<?php echo $k; ?>,alt_phone_no_code_id<?php echo $k; ?>,alt_phone_no_code_name<?php echo $k; ?>);
                	$('#'+alt_phone_no_code<?php echo $k; ?>).trigger('change');
                }, 1);
            }   
            <?php
                }
            } else {
            	?>
            	/* fuction for select default country code on registration page */
				var id = "pd_father_alt_phone_no_code";
				var dbId = '<?php echo DEFAULT_MOBILE_CODE_ID; ?>';
				var dbVal = '<?php echo DEFAULT_MOBILE_CODE; ?>';
				select2Set(id,dbId,dbVal);
				$('#'+id).trigger('change');

				var id = "pd_mother_alt_phone_no_code";
				var dbId = '<?php echo DEFAULT_MOBILE_CODE_ID; ?>';
				var dbVal = '<?php echo DEFAULT_MOBILE_CODE; ?>';
				select2Set(id,dbId,dbVal);
				$('#'+id).trigger('change');
				/* End of Code */
            	<?php
            }
            ?>
             
            <?php
            if($applicant_parent_occupation) {
                foreach($applicant_parent_occupation as $k=>$v) {
                	if($k == $parent_type_id_father) {
                		$input_name = 'pd_father_occupation';
                	} else if ($k == $parent_type_id_mother) {
                		$input_name = 'pd_mother_occupation';
                	} else {
                		$input_name = 'pd_guardian_occupation';
                	}
            ?>
                    var occupation<?php echo $k; ?> = '<?php echo $input_name; ?>';
                    var occupation_id<?php echo $k; ?> = '<?php echo $v; ?>';
                    var occupation_name<?php echo $k; ?> = '<?php echo $applicant_parent_occupation_name[$k]; ?>';
                     if(occupation_id<?php echo $k; ?>){
                        setTimeout(function(){ select2Set(occupation<?php echo $k; ?>,occupation_id<?php echo $k; ?>,occupation_name<?php echo $k; ?>);
                        	$('#'+occupation<?php echo $k; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
            ?>

            <?php
            $chk_guardian = ($add_gardian == 't')?true:false;
            if($add_gardian == 't') {
            ?>
            $('#add_guardian_checkbox').prop('checked', true);
            chk_guardian(<?php echo $chk_guardian; ?>);
            <?php
        	}
            ?>
		//end parent detail fetch
		
		//fetch address
            var country_id = "country_addr";
			var dbcountry_id = '<?php echo $applicant_address_details_list['country_id']; ?>';
			var dbcountry_val = '<?php echo $applicant_address_details_list['country_name']; ?>';
			if(dbcountry_id){
				setTimeout(function(){ select2Set(country_id,dbcountry_id,dbcountry_val);
				}, 1);
			}
			if(country_value_default==dbcountry_id)
			{
			var state_id = "state_addr";
			var dbstate_id = '<?php echo $applicant_address_details_list['state_id']; ?>';
			//alert(dbcountry_id);
			var dbstate_val = '<?php echo $applicant_address_details_list['state_name']; ?>';
			//alert(dbcountry_val);
			 if(dbstate_id){
				setTimeout(function(){ select2Set(state_id,dbstate_id,dbstate_val);
				}, 1);
			}

			var district_id = "district_addr";
			var dbdistrict_id = '<?php echo $applicant_address_details_list['district_id']; ?>';
			//alert(dbcountry_id);
			var dbdistrict_val = '<?php echo $applicant_address_details_list['district_name']; ?>';
			//alert(dbcountry_val);
			 if(dbdistrict_id){
				setTimeout(function(){ select2Set(district_id,dbdistrict_id,dbdistrict_val);
				}, 1);
			}

			var city_id = "city_addr";
			var dbcity_id = '<?php echo $applicant_address_details_list['city_id']; ?>';
			//alert(dbcountry_id);
			var dbcity_val = '<?php echo $applicant_address_details_list['city_name']; ?>';
			//alert(dbcountry_val);
			 if(dbcity_id){
				setTimeout(function(){ select2Set(city_id,dbcity_id,dbcity_val);
				}, 1);
			}
		}
		//end fetch address
		
		//show hid  12 mark detail
       $("#appering").click(function () {
                $("#appering_info_1").hide();
                $("#appering_info_2").hide();
                $("#appering_info_3").hide();
				$("#obtained_percentage_cgpa").val('');
                $("#marking_scheme").attr('data-parsley-required','false');
                $("#obtained_percentage_cgpa").attr('data-parsley-required','false');
                $("#registration_no").attr('data-parsley-required','false');
                //$("#exp_year").show();
        })
        $("#completed").click(function () {
                $("#appering_info_1").show();
                $("#appering_info_2").show();
                $("#appering_info_3").show();
                $("#marking_scheme").attr('data-parsley-required','true');
                $("#obtained_percentage_cgpa").attr('data-parsley-required','true');
                $("#registration_no").attr('data-parsley-required','true');
               // $("#exp_year").hide();
        })
           
            
            $('#taken_any_competitive_exam').on('change',function(){
				var taken_any_competitive_exam = $('#taken_any_competitive_exam').val();
				var val = (taken_any_competitive_exam == 'yes')?true:false;
				chk_competitive_exam(val);
			});

			$('#is_work_experience').on('change',function(){
				var is_work_experience = $('#is_work_experience').val();
				var val = (is_work_experience == 'yes')?true:false;
				chk_work_experience(val);
			});	

          $('#academic_board').on('change',function() {
            var academic_board = $("#academic_board").val();
            console.log("academic_board "+academic_board);
            
            if(academic_board==<?php echo OTHER_BOARD ?>){
              $("#ob_board").show();
            }else{
              $("#ob_board").hide();
             // $('#ob_board').val('');
            }  
          });
		//fetch academic detail
			 <?php			
			 if(!empty($applicant_schooling_list)){
			    $cur_qual_completed='f';
			    if(!empty($applicant_schooling_list['result_declared'])){
			        $cur_qual_completed=$applicant_schooling_list['result_declared'];
			    }
			     
			     if($cur_qual_completed == 't') {
			         ?>
		            	$("#completed").trigger('click');
		            	<?php
		            } else if($cur_qual_completed == 'f') {
		            	?>
		            	$("#appering").trigger('click');
		            	<?php
		            }
			} 
		?>
		


		var mode_of_study = "mode_of_study";
		var mode_of_study_id = '<?php echo $applicant_schooling_mode_of_study_id; ?>';
		var mode_of_study_name = '<?php echo $applicant_schooling_mode_of_study_name; ?>';
		//alert(mode_of_study_id);
		//alert(mode_of_study_name);
		 if(mode_of_study_id != ''){
			setTimeout(function(){ select2Set(mode_of_study,mode_of_study_id,mode_of_study_name);
      $('#'+mode_of_study).trigger('change');
			}, 1);
		}


		/*var university_id = "institute_university";
		var db_univ_id = '<?php echo $applicant_grad_det_univ_id; ?>';
		var db_univ_name = '<?php echo $applicant_grad_det_univ_name; ?>';
		//alert(dbcountry_val);
		 if(db_univ_id != ''){
			setTimeout(function(){ select2Set(university_id,db_univ_id,db_univ_name);
				$('#'+university_id).trigger('change');
			}, 1);
		}*/
		<?php
		//print_r($applicant_schooling_list); exit;
		?>
		var acdemic_board_id = "academic_board";
		var db_board_id = '<?php echo $applicant_schooling_board_id; ?>';
		var db_board_name = '<?php echo $applicant_schooling_board_name; ?>';
		//alert(dbcountry_val);
		 if(db_board_id != ''){
			setTimeout(function(){ select2Set(acdemic_board_id,db_board_id,db_board_name);
				$('#'+acdemic_board_id).trigger('change');
			}, 1);
		}
		
		


		var marking_scheme = "marking_scheme";
		var db_marking_schema_id = '<?php echo $applicant_schooling_mark_scheme_id; ?>';
		var db_marking_schema_name = '<?php echo $applicant_schooling_mark_scheme_name; ?>';
		
		 if(db_marking_schema_id != ''){
			setTimeout(function(){ select2Set(marking_scheme,db_marking_schema_id,db_marking_schema_name);
				$('#'+marking_scheme).trigger('change');
			}, 1);
		}

		 var taken_any_competitive_exam = "taken_any_competitive_exam";
	      var is_competitive_exam_select = '<?php echo $is_competitive_exam_select; ?>';
	      //alert(dbcountry_id);
	      var is_competitive_exam_select_name = '<?php echo $is_competitive_exam_select_name; ?>';
	      //alert(dbcountry_val);
	       if(is_competitive_exam_select){
	          setTimeout(function(){ select2Set(taken_any_competitive_exam,is_competitive_exam_select,is_competitive_exam_select_name);
	            $('#'+taken_any_competitive_exam).trigger('change');
	          }, 1);
	      }

				var is_work_experience = "is_work_experience";
				var is_work_experience_select = '<?php echo $is_work_experience_select; ?>';
				//alert(dbcountry_id);
				var is_work_experience_select_name = '<?php echo $is_work_experience_select_name; ?>';
				//alert(dbcountry_val);
				 if(is_work_experience_select != ''){
					setTimeout(function(){ select2Set(is_work_experience,is_work_experience_select,is_work_experience_select_name);
						$('#'+is_work_experience).trigger('change');
					}, 1);
				}
	      
				<?php
	            if($is_work_experience) {
	            	$input_val = ($is_work_experience_select == 'yes')?1:0;
	            ?>
	        		chk_work_experience(<?php echo $input_val; ?>);
	        	<?php

	        	}
	        	?>
	        	<?php
			 // on load preview button
			if($startIndex) {
			?>
			<?php
			}
			?>				
select2load('BankName','<?php echo $payment_details_list['bank_id']; ?>','<?php echo $payment_details_list['bank_name']; ?>');		
		//end fetch academic detail
	$("#online").click(function(){
		$("#payment_details").hide();
	});
	$("#dd").click(function(){	
	 $("#payment_details").show();
	}); 
		$("#studied_from_india").change(function () {			
	        basic_change();
	    });
		$('#i_confirm').change(function() {
	    	if($(this).is(':checked')) {
	    		$(this).val(1);
	    	} else {
	    		$(this).val(0);
	    	}
	    });	
	    
   
	  
	 function basic_change() {
		$("#halterror").hide();
    	var study_india_id = $("#studied_from_india").val();
        var resident_status_val = $("#resident_status").val(); 
        //if(study_india_id=='t'){  study_india_id='yes';}    
        if (study_india_id == 'yes' || study_india_id=='t') {
            $("#indian").show();
            $("#non-indian").hide();
            $("#resident_status").hide();
            $('#non_indian_resident').attr('data-parsley-required',"false");
            if(study_india_id) {
            	$('#i_confirm').attr('data-parsley-required',"true");
            }
        }
        else if (study_india_id == 'no' || study_india_id == 'f') {
            $("#indian").hide();
            $("#non-indian").show();
            $("#resident_status").show();
            $('#i_confirm').attr('data-parsley-required',"false");
          	$('#non_indian_resident').attr('data-parsley-required',"true");
            
        } else {        	
        	$("#indian").hide();
            $("#indian-none").hide();
            $('#i_confirm').attr('data-parsley-required',"false");
            $('#non_indian_resident').attr('data-parsley-required',"false");
        }
    }  

	  $('#pd_nationality').on('change',function() {
			var pd_nationality = $("#pd_nationality").val();
			if(pd_nationality==country_value_default){
				$("#main_div_social_status").show();
			}else{
				$("#main_div_social_status").hide();
			}
		});	

	 

	    // Show Father & Mother Input
		show_parents_detail('pd_father_title','father_mbleno_div','father_email_div','father_occupation_div','father_alt_mbleno_div',);
		show_parents_detail('pd_mother_title','mother_mbleno_div','mother_email_div','mother_occupation_div','mother_alt_mbleno_div');
		
		show_other_element('pd_father_occupation','father_other_occupation_div',otheroccupation);
		show_other_element('pd_mother_occupation','mother_other_occupation_div',otheroccupation);
		show_other_element('pd_guardian_occupation','guardian_other_occupation_div',otheroccupation);
		show_other_element('sector_0','othersector_0',othersector);
		show_other_element('sector_1','othersector_1',othersector);
		show_other_element('sector_2','othersector_2',othersector);
		validate_cgpa('marking_scheme','obtained_percentage_cgpa');
		validate_score('score_obtained_1','max_score_1');
		validate_score('score_obtained_2','max_score_2');
		validate_score('score_obtained_3','max_score_3');
		validate_score('score_obtained_4','max_score_4');
		validate_score('score_obtained_5','max_score_5');
		validate_score('score_obtained_6','max_score_6');
		
		$('#add_guardian_checkbox').on('change',function(){
			chk_guardian($(this).is(':checked'));
		});

		validate_cgpa('academic_marking_scheme','academic_obtain_cgpa');
		validate_cgpa('academic_marking_scheme_twelfth','academic_obtain_cgpa_twelfth');
		validate_yop('academic_yr_passing','academic_yr_passing_twelfth');

		$('#country_addr').on('change',function() {
			setEmptyOnChangeSelect2('state_addr'); // when no values return in json, add empty option value 
			if ($('#state_addr').data('select2')) {
				$('#state_addr').select2('destroy');
			}
			$('#state_addr').html(''); // reset select values for, if user selected the value then change the country code, then select same value, and value will be null, that so we reset the select values
	
			var country_addr_val = $(this).val();
			
		if(country_value_default==country_addr_val){
				$('#main_div_state').show();
				getSelect2('state_addr','<?php echo base_url("get_states"); ?>?country_id='+country_addr_val+	'&sort_by=id&sort_order=asc'+url_edit,'Select State', formatRepoCommon,no_state_msg, false, formatRepoSelection);
				$('#state_addr').attr('data-parsley-required',"true");
				$('#city_addr').attr('data-parsley-required',"true");
				$('#district_addr').attr('data-parsley-required',"true");
				
				}else{
				$('#main_div_state').hide();
				$('#main_div_district').hide();
				$('#main_div_city').hide();	
				$('#state_addr').attr('data-parsley-required',"false");
				$('#city_addr').attr('data-parsley-required',"false");
				$('#district_addr').attr('data-parsley-required',"false"); 	
								
			}
		});
		
		
		$('#state_addr').on('change',function() {
			setEmptyOnChangeSelect2('city_addr');
			if ($('#city_addr').data('select2')) {
				$('#city_addr').select2('destroy');
			}				
			$('#city_addr').html(''); // reset select values for, if user selected the value then change the country code, then select same value, and value will be null, that so we reset the select values				
			var state_addr_val = $(this).val();
			//  console.log("country_addr_val "+country_addr_val);
			$('#main_div_district').show();
			$('#main_div_city').show();
			getSelect2('city_addr','<?php echo base_url("get_cities"); ?>?state_id='+state_addr_val+'&sort_by=id&sort_order=asc'+url_edit,'Select City', formatRepoCommon,no_city_msg, false, formatRepoSelection);
			
			getSelect2('district_addr','<?php echo base_url("get_district"); ?>?state_id='+state_addr_val+'&sort_by=id&sort_order=asc'+url_edit,'Select District', formatRepoCommon,no_district_msg, false, formatRepoSelection);
		});	  
		
		
	     
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
		
		$(function () {
			$("#datepicker").datepicker();
		});
		// DOB Datepicker
		$("#pd_dob").datepicker( {
			format:"mm/dd/yyyy" ,autoclose: true,todayHighlight: true,endDate: endDob
		}).on('changeDate', function(e) {
				$("#pd_dob").parsley().validate();
		});
		<?php
	      if($upload_scripts) {
	        foreach($upload_scripts as $k=>$v) {
	          echo $v."\n";
	        }
	      }
       ?>
			
			
	});

	// This Function for Payment option selection
	$("#online").click(function(){
		$("#payment_details").hide();
	});
	$("#dd").click(function(){
		$("#payment_details").show();
	});	
	
});

function campus_pref_change(currentcampus,reset1,reset2,campus_placeholder,choice) {
    var e1_val=$("#"+currentcampus).val();		
    var e2_val=$("#"+reset1).val();
    var e3_val=$("#"+reset2).val();
    //for reset1 
	var notcampus2 = [];
	if(e1_val !== null  && e1_val !== ""){
     notcampus2.push(e1_val);
    }
	if(e3_val !== null && e3_val !== ""){
         notcampus2.push(e3_val);
    }
    if(notcampus2.length>0);
    {
		/*var arrStr = JSON.stringify(notcampus1);
		console.log($.param(arrStr)); */
		var notcampusval2=notcampus2.join(",");
		setEmptyOnChangeSelect2(reset1);
		if ($('#'+reset1).data('select2')) {
			$('#'+reset1).select2('destroy');
		}				
		$('#'+reset1).html(''); 
		//$('#'+spec_div).show();		
		var no_campus_msg = "Sorry, Campus not available.";
		getSelect2(reset1,'<?php echo base_url("course_preference"); ?>?is_lookup_master=1&ecamp='+notcampusval2+'&is_campus=1&grade_id='+grad_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc'+url_edit,'Select Campus Perferences 2', formatRepoCommon,no_campus_msg, false, formatRepoSelection); 
	}
	if(choice==1){
		setEmptyOnChangeSelect2(reset2);
		if ($('#'+reset2).data('select2')) {
			$('#'+reset2).select2('destroy');
		}				
		$('#'+reset2).html(''); 
		//$('#'+spec_div).show();		
		var no_campus_msg = "Sorry, Campus not available.";		
		getSelect2(reset2,'<?php echo base_url("course_preference"); ?>?is_lookup_master=1&ecamp='+notcampusval2+'&is_campus=1&grade_id='+grad_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc'+url_edit,'Select Campus Perferences 3', formatRepoCommon,no_campus_msg, false, formatRepoSelection); 
	}
	 
}
function enable_course_by_campus(campus,course,course_div,course_placeholder,grad_id) {
	$('#'+campus).on('change',function() {		
		setEmptyOnChangeSelect2(course);
		if ($('#'+course).data('select2')) {
			$('#'+course).select2('destroy');
		}				
		$('#'+course).html(''); 			
		var campus_val = $(this).val();		
		$('#'+course_div).show();
		var no_course_msg = "Sorry, Course not available.";
		getSelect2(course,'<?php echo base_url("course_preference"); ?>?is_lookup_master=1&is_course=1&grade_id='+grad_id+'&campus_id='+campus_val+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc'+url_edit,course_placeholder, formatRepoCommon,no_course_msg, false, formatRepoSelection);
		});
}

/* function course_pref_change(currentcourse,reset1,reset2,course_placeholder,current_campus,reset_campus,other_campus) {
	var e1_val=$("#"+currentcourse).val();		
    var e2_val=$("#"+reset1).val();
    var e3_val=$("#"+reset2).val();
    //for reset1 
	var notcourse2 = [];
	if(e1_val !== null  && e1_val !== ""){
		notcourse2.push(e1_val);
    }
	if(e3_val !== null && e3_val !== ""){
		notcourse2.push(e3_val);
    }
    if(notcourse2.length>0);
    {
		var notcourseval2=notcourse2.join(",");
		setEmptyOnChangeSelect2(reset1);
		if ($('#'+reset1).data('select2')) {
			$('#'+reset1).select2('destroy');
		}				
		$('#'+reset1).html('');		
		var no_course_msg = "Sorry, Course not available.";
		if(reset_campus!=current_campus && reset_campus!=other_campus)
		{
			notcourseval2="";
		}
		var programid=$("#pd_program").val();
		if(programid!="")
		{
		  grad_id=programid;
		}
	    getSelect2(reset1,'<?php echo base_url("course_preference"); ?>?is_lookup_master=1&is_course=1&grade_id='+grad_id+'&campus_id='+reset_campus+'&ecourse='+notcourseval2+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc',course_placeholder, formatRepoCommon,no_course_msg, false, formatRepoSelection);
    }
	 
} */

function test_state_pref(state,state_placeholder) {
	var no_state_msg = "Sorry, State not available.";
	getSelect2(state,'<?php echo base_url("get_states"); ?>?country_id='+country_value_default+	'&sort_by=id&sort_order=asc'+url_edit,state_placeholder, formatRepoCommon,no_state_msg, false, formatRepoSelection);
}

function test_state_pref_change(state,city,city_div,city_placeholder) {
	var no_city_msg = "Sorry, City not available.";
	$('#'+state).on('change',function() {
		setEmptyOnChangeSelect2(city);
		if ($('#'+city).data('select2')) {
			$('#'+city).select2('destroy');
		}				
		$('#'+city).html(''); // reset select values for, if user selected the value then change the country code, then select same value, and value will be null, that so we reset the select values				
		var state_val = $(this).val();
		//  console.log("state_val "+state_val);
		$('#'+city_div).show();
		var exclude_city_ids = [];
		$('.test_city').each(function() {
			var this_id = $(this).attr('id');
			// console.log('this_id => '+this_id);
			// console.log('city => '+city);
			
			if(this_id != city) {
				var val = $(this).val();
				// console.log('val => '+val);
				if(val) {
					exclude_city_ids.push(val);	
				}
			}
		})
		if($(exclude_city_ids).length > 0) {
			exclude_city_ids = exclude_city_ids.join(',');
		}
		getSelect2(city,'<?php echo base_url("get_cities"); ?>?state_id='+state_val+'&sort_by=id&sort_order=asc&exclude_city_ids='+exclude_city_ids+url_edit,city_placeholder, formatRepoCommon,no_city_msg, false, formatRepoSelection);
	});
}

function test_city_pref_change(state,city) {
	$('#'+city).on('change',function() {
		var cur_city_val = $(this).val();
		var test_state_i = 0;
		$('.test_state').each(function() {
			var this_id = $(this).attr('id');
			if(this_id != state) {
				// $('.test_city').eq(test_state_i).trigger('change');
				var other_city_val = $('.test_city').eq(test_state_i).val();
				if(other_city_val == cur_city_val) {
					$(this).trigger('change');	
				}
			}
			test_state_i++
		});
	});
}

function course_pref_change1(course1,course2,course3,course_placeholder,course_placeholder1)
{
	//console.log(course_placeholder);
	var course1_val = $('#'+course1).val();
	var course2_val = $('#'+course2).val();
	var course3_val = $('#'+course3).val();
	console.log(course1_val+"course1_val");
	console.log(course2_val+"course2_val");
	console.log(course3_val+"course3_val");
	$('#'+course1).on('change',function() {
		var campus_id =  $('#campus_pref_1').val();
		var no_course_msg = "Sorry Course not avaliable";
		var exclude_course_ids = [];
		var test_spec_i = 0;
	$('.course_sel').each(function() {
		var this_id = $(this).attr('id');
		//if(this_id != course1){
			var val = $(this).val();
			var other_campus_val = $('.course_sel').eq(test_spec_i).val();
			//console.log(other_campus_val+"other_campus_val");
			//console.log(val+"curreval");
			if(val) { exclude_course_ids.push(val); }
			
		//}
		test_spec_i ++;
	});
	if($(exclude_course_ids).length > 0) {
				exclude_course_ids = exclude_course_ids.join(',');
			}
		if(course2_val == null || course2_val == '')
		{
			getSelect2(course2,'<?php echo base_url("course_preference"); ?>?is_lookup_master=1&is_course=1&grade_id='+grad_id+'&campus_id='+campus_id+'&ecourse='+exclude_course_ids+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc'+url_edit,course_placeholder, formatRepoCommon,no_course_msg, false, formatRepoSelection);
		}			
		if(course3_val == null || course3_val == '')
		{
		getSelect2(course3,'<?php echo base_url("course_preference"); ?>?is_lookup_master=1&is_course=1&grade_id='+grad_id+'&campus_id='+campus_id+'&ecourse='+exclude_course_ids+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc'+url_edit,course_placeholder1, formatRepoCommon,no_course_msg, false, formatRepoSelection);
		}	
			
	});
}

function course_pref_change(course_sel_id,course_placeholder) {
	var course_val = $('#'+course_sel_id).val();
	 //$('#'+course_sel_id).on('change',function() {
	var campus_id =  $('#campus_pref_1').val();
	console.log(course_val+"course_currentval");
	var no_course_msg = "Sorry Course not avaliable";
	var exclude_course_ids = [];
	var reset_data = '';
	$('.course_sel').each(function() {
		var this_id = $(this).attr('id');
		if(this_id != course_sel_id){
			var lastchar = this_id.substr(-1);
			var course_other_val = $("#course_pref_"+lastchar).val();
			var same_course_val = ("course_pref_"+lastchar);
			if(course_other_val == course_val) { 
				reset_data = same_course_val; 
				exclude_course_ids.push(course_other_val); }
			
		}
	});
		if($(exclude_course_ids).length > 0) {
			setEmptyOnChangeSelect2(reset_data);
	if ($('#'+reset_data).data('select2')) { $('#'+reset_data).select2('destroy');}	
	$('#'+reset_data).html(''); 
		exclude_course_ids = exclude_course_ids.join(',');
		getSelect2(reset_data,'<?php echo base_url("course_preference"); ?>?is_lookup_master=1&is_course=1&grade_id='+grad_id+'&campus_id='+campus_id+'&ecourse='+exclude_course_ids+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc'+url_edit,course_placeholder, formatRepoCommon,no_course_msg, false, formatRepoSelection);
	}
	// }); 	

}

function chk_guardian(val) {	
	   if($("#add_guardian_checkbox").is(':checked')){
		$('#add_guardian_checkbox').val('true');
		$('#guardian_details').show();
		$('#pd_guardian_name').attr('data-parsley-required',"true");
		$('#pd_guardian_phone').attr('data-parsley-required',"true");
		$('#pd_guardian_phone_no_code').attr('data-parsley-required',"true");
		$('#pd_guardian_email').attr('data-parsley-required',"true");
		$('#pd_guardian_occupation').attr('data-parsley-required',"true");
		$("#pd_guardian_phone").attr('data-parsley-mobileonly','true');			    
		} else {
		$('#add_guardian_checkbox').val('false');
		$('#guardian_details').hide();
		$('#pd_guardian_name').attr('data-parsley-required',"false");
		$('#pd_guardian_phone').attr('data-parsley-required',"false");
		$('#pd_guardian_phone_no_code').attr('data-parsley-required',"false");
		$('#pd_guardian_email').attr('data-parsley-required',"false");
		$('#pd_guardian_occupation').attr('data-parsley-required',"false");
		$("#pd_guardian_phone").removeAttr('data-parsley-mobileonly');
	}
}
//file upload
function upload_file(file_doc_type, upload_type) {
	upload_type = upload_type || false;
	
	var parsley_required = $('#'+file_doc_type).attr('data-parsley-required');
	var max_file_size = $('#'+file_doc_type).attr('data-parsley-max-file-size');
	var max_file_size_js = $('#'+file_doc_type).attr('data-max-file-size-js');
	var file_extension = $('#'+file_doc_type).attr('data-parsley-file-extension');
	var id = $('#'+file_doc_type).attr('data-file-id');
	var file_count = 'false';
	if(typeof $('#'+file_doc_type).attr('data-file-count') != 'undefined') {
		file_count = $('#'+file_doc_type).attr('data-file-count');    
	}
	// Get Regenerated CSRF Dynamically
	var csrfHashRegenerate = $("input[name='"+csrfName+"']").val();
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
		var parsley_required = $('#'+file_doc_type).attr('data-parsley-required','false');
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
						filename_html += '<span class="file_name  mt-3"><a class="image-popup-vertical-fit" href="<?php echo base_url(); ?>'+file_path+'" target="_blank" title="'+file_name_user+'">'+file_name_truncate+' <i class="fa fa-eye" aria-hidden="true"></i></a></span><a href="javascript:void(0)" data-del-file-id="'+id+'" data-doc-id="'+doc_id+'" data-toggle="modal" data-target="#contentDeletePop" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a><div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_'+doc_id+'"><a href="#" class="close" onclick="hideAlert(\'deleteMessage_'+doc_id+'\')">&times;</a><strong id="deleteMessageStatus_'+doc_id+'"></strong> <span id="deleteMessageSpan_'+doc_id+'"></span></div>';
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
			//if(doc_id == document_id_tentative_topic) {
				var divId = 'deleteMessage_'+doc_id+data_del_file_id;
				var strongId = 'deleteMessageStatus_'+doc_id+data_del_file_id;
				var spanId = 'deleteMessageSpan_'+doc_id+data_del_file_id;
			//} else {
				var divId = 'deleteMessage_'+doc_id;
				var strongId = 'deleteMessageStatus_'+doc_id;
				var spanId = 'deleteMessageSpan_'+doc_id;   
			//}
			$('#' + divId).parent().find('[data-del-file-id="'+data_del_file_id+'"]').prev('span.file_name').remove();
			$('#' + divId).parent().find('[data-del-file-id="'+data_del_file_id+'"]').remove();
			
			
			$('#' + divId).show('slow');
			if (json) {
				// var arrJson = JSON.parse(json);
				// Set Regenerated CSRF Dynamically
				var csrfHash = $("input[name='"+csrfName+"']").val(json.token);
				var msg = json.message;
				if (json.status == true || json.status == 'true') {
					$('#' + divId).addClass('alert-success');
					$('#' + divId).removeClass('alert-danger');
					// $('#' + strongId).text('<?php echo $this->lang->line ( 'success' );?>');
				} else {
					$('#' + divId).addClass('alert-danger');
					$('#' + divId).removeClass('alert-success');
					// $('#' + strongId).text('<?php echo $this->lang->line ( 'error' );?>');
				}
                $('#'+field).attr('data-parsley-required',required);
				$('#'+field).parsley().validate();
				$('#'+field).removeClass('parsley-success');				
				$('#' + spanId).text(msg);
				upload_file_unset_download_delete_options(field);
				setTimeout(function () {
					$('#' + divId).hide('slow');
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
//end upload
</script>