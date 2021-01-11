<?php
if($applicant_address_details_list) {
   foreach($applicant_address_details_list as $k=>$v) {
      $country_id[] = $v['country_id'];
      $country_name[] = $v['country_name'];
      $state_id[] = $v['state_id'];
      $state_name[] = $v['state_name'];
      $district_id[] = $v['district_id'];
      $district_name[] = $v['district_name'];
      $city_id[] = $v['city_id'];
      $city_name[] = $v['city_name'];
      $add_line_1[] = $v['add_line_1'];
      $add_line_2[] = $v['add_line_2'];
      $pin_code[] = $v['pin_code'];
   }
}

$curr_edu_quali_status = $applicant_appln_details_list[0]['qual_status_id'];
	
if($curr_edu_quali_status==1){
	$curr_edu_quali_status = 'aug';
}elseif($curr_edu_quali_status==2){
	$curr_edu_quali_status = 'apg';	
}elseif($curr_edu_quali_status==3){
	$curr_edu_quali_status = 'cug';	
}elseif($curr_edu_quali_status==4){
	$curr_edu_quali_status = 'cpg';	
}

$tenth_schooling_id = SCHOOLING_ID_TENTH;
$twelfth_schooling_id = SCHOOLING_ID_TWELFTH;

if($applicant_schooling_list) {
   foreach($applicant_schooling_list as $k=>$v) {
      $schooling_id = $v['schooling_id'];
      $applicant_scl_det_id[$schooling_id] = $v['applicant_scl_det_id'];
	  $board_id[$schooling_id] = $v['board_id'];
	  $board_name[$schooling_id] = $v['board_name'];
	  $marking_scheme_id[$schooling_id] = $v['marking_scheme_id'];
	  $marking_scheme_name[$schooling_id] = $v['marking_scheme_name']; 
	  $result_declared[$schooling_id] = $v['result_declared'];
   }
}

$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_tenth_marksheet = DOCUMENT_ID_TENTH_MARKSHEET;
$document_id_twelvfth_marksheet = DOCUMENT_ID_TWELVFTH_MARKSHEET;
$document_id_graduation_marksheet = DOCUMENT_ID_GRADUATION_MARKSHEET;
$document_id_post_graduation_marksheet = DOCUMENT_ID_POST_GRADUATION_MARKSHEET;

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
  		$file_doc_type = (($document_id_photograph == $document_id)?'photograph':($document_id_tenth_marksheet == $document_id?'tenth_marksheet':($document_id_twelvfth_marksheet == $document_id?'twelvfth_marksheet':(($document_id_signature == $document_id)?'signature':(($document_id_graduation_marksheet == $document_id)?'graduation_marksheet':(($document_id_post_graduation_marksheet == $document_id)?'post_graduation_marksheet':''))))));
  		$parsley_required = (($document_id_photograph == $document_id)?'true':(($document_id_signature == $document_id)?'true':(($document_id_graduation_marksheet == $document_id)?'true':(($document_id_post_graduation_marksheet == $document_id)?'true':''))));
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

// print_r($docs[$document_id_graduation_marksheet]);
// exit;

$applicant_name=isset($applicant_appln_details_list[0]['applicant_name_declaration'])?$applicant_appln_details_list[0]['applicant_name_declaration']:'';
$parent_name=isset($applicant_appln_details_list[0]['applicant_parentname_declaration'])?$applicant_appln_details_list[0]['applicant_parentname_declaration']:'';
$current_wizard=$applicant_appln_details_list[0]['wizard_id'];
$payment_mode_id = $payment_details_list['payment_mode_id'];

// Get Current Index
$startIndex = $this->input->get('startIndex',true);
//restrict previous section
$is_allow_previous=$this->config->item('is_allow_previous');
/*Form Index Restriction Start*/
$start_wizard = 0;
$start_wizard_next = -1;
$next_step_allowed = '';
$start_wizard_next_allow='';
$appln_form_w_wizard_id = $applicant_appln_details_list[0]['form_w_wizard_id'];
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


if($mode_edit==''){
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
		$startIndex=6; //upload
	}
	else if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==1) && $startIndex <= $start_wizard_next_allow) {
		$startIndex = $startIndex;
	}
	else{
		$startIndex = 0;
	}
}
/* Admin Means No restriction end / Form Index Restriction End */

if($applicant_graduations_list) {
   foreach($applicant_graduations_list as $k=>$v) {
	  if($v['is_addi_qualification']!='t'){
		  $noaqdata = array();
		  $noaqdata['univ_name'] = $v['univ_name'];
		  $noaqdata['univ_id'] = $v['univ_id'];	
		  $noaqdata['mark_scheme_name'] = $v['mark_scheme_name'];
		  $noaqdata['mark_scheme_id'] = $v['mark_scheme_id'];		  
	  }else{
		   $noaqdata = array();
		   $noaqdata[] = $v;
	  }
   }
}

?>
<script>
var country_value_default = '<?php echo COUNTRY_VALUE_DEFAULT; ?>';
var logged_applicant_id = '<?php echo $logged_applicant_id; ?>';
var logged_applicant_login_id = '<?php echo $logged_applicant_login_id; ?>';
var app_form_id = '<?php echo APP_FORM_ID_FELLOWSHIP; ?>';
var payment_wizard_id = '<?php echo FORM_WIZARD_PAYMENT_ID; ?>';	
/*CRM ADMIN Edit form start*/
var crm_applicant_personal_det_id = '<?php echo $crm_applicant_personal_det_id ; ?>';
var crm_applicant_login_id = '<?php echo $crm_applicant_login_id ; ?>';
var mode_edit_val = '<?php echo ADMIN_MODE_EDIT ; ?>';
var mode_edit_url = '<?php echo $mode_edit; ?>';

<?php if($mode_edit) { ?>
   var url_edit = '&mode=edit'+'&applicant_personal_det_id='+crm_applicant_personal_det_id+'&applicant_login_id='+crm_applicant_login_id;
   var url = "<?php echo base_url(); ?>fellowship/"+mode_edit_val+"/"+crm_applicant_login_id+"/"+crm_applicant_personal_det_id;
   var payment_url = '<?php echo base_url(); ?>user/payment_details?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;
   var save_exit_redirect_url = '<?php echo base_url(); ?>crm-admin/dashboard';
<?php } else { ?>
   var url_edit =  '&applicant_personal_det_id='+logged_applicant_id+'&applicant_login_id='+logged_applicant_login_id;
   var url = "<?php echo base_url(); ?>fellowship";
   var payment_url = '<?php echo base_url(); ?>user/payment_details';
   var save_exit_redirect_url = '<?php echo base_url(); ?>';
<?php } ?>
/*CRM ADMIN Edit form end*/
var redirect = '<?php echo base_url()."thank_you"; ?>?app_form_id='+app_form_id;
var get_percentage_url = '<?php echo base_url(); ?>/user/get_percentage_w_tab?app_form_id='+app_form_id+url_edit;
var srm_fellowship = '<?php echo SRM_FELLOWSHIP_ID; ?>';
var redirect_payment_thank_you = '<?php echo base_url(); ?>user/payment_thank_you?app_form_id='+app_form_id+'&wizard_id='+payment_wizard_id+'&url='+encodeURIComponent(url);
var curIndex='<?php echo $startIndex;?>';
var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
    csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
	
$(document).ready(function () {
    'use strict'; 

	<?php if($payment_mode_id == PAYMENT_MODE_DEMAND_DRAFT_ID) {
		?>
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
		},1);
		<?php
	}
	if($payment_mode_id == PAYMENT_MODE_ONLINE_ID) {
	    ?>
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
	
	$("#show_currentindex").html('<?php echo ($startIndex)?($startIndex+1):1; ?> of '+total_wizard_Step);	
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
				enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>fellowship_preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);				
			}else{
				enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>fellowship_preview');
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
		startIndex:<?php echo ($startIndex)?$startIndex:0; ?>,
        /* Transition Effects */
        transitionEffect: 'slide', //$.fn.steps.transitionEffect.none,
        transitionEffectSpeed: 200,
		/* Events */
        onStepChanging: function (event, currentIndex, newIndex) { 
		
			if(currentIndex < newIndex) {
				// Step 1 form validation
				if(currentIndex === 0) {
					var studied_in_india = $('#studied_in_india').parsley();
					var resident_status = $('#resident_status').parsley();
					var i_confirm = $('#i_confirm').parsley();
					
					check_visible_input_validation('main_resident_status','resident_status','<?php echo REQD_SELECT_RESIDENT_STATUS_MSG; ?>',false);
					
					if(studied_in_india.isValid() && resident_status.isValid() && i_confirm.isValid()) {
						var studied_in_india_val = $('#studied_in_india').val();
						var i_confirm_val = $('#i_confirm').val();
						var appln_status = $('#appln_status').val();
						var user_data = 'studied_in_india='+studied_in_india_val+'&i_confirm='+i_confirm_val+'&'+csrfName+'='+csrfHash+'&appln_status='+appln_status;;
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
									console.log(returndata);
									if(returndata) {
										var startIndex = currentIndex+1
										window.location.href = url+'?startIndex='+startIndex;
										$("#formerr").hide();
										moveNxt=1;
									}									
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
					}else{
						studied_in_india.validate();
						resident_status.validate();
						i_confirm.validate();
						return false;
					}
				} 
				
				// Step 2 form validation
				if(currentIndex === 1) {
					var pd_course_preference = $('#pd_course_preference').parsley();
					var pd_campus = $('#pd_campus').parsley();
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
					var pd_religion = $('#pd_religion').parsley();
					var pd_mother_tongue = $('#pd_mother_tongue').parsley();
					var pd_medium_of_instruction = $('#pd_medium_of_instruction').parsley();
					var pd_hostel_accommodation = $('#pd_hostel_accommodation').parsley();
					var pd_diffrently_abled = $('#pd_diffrently_abled').parsley();
					var pd_advertisement_source = $('#pd_advertisement_source').parsley();
					var pd_nationality = $('#pd_nationality').parsley();
					var pd_social_status = $('#pd_social_status').parsley();
					
					// Make Validation false
					if($('#pd_lastname').val()=='.'){
						$('#pd_lastname').removeAttr('data-parsley-nameonly', 'true');
						$('#pd_lastname').removeAttr('data-parsley-nameonly-message', '<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>');
					}					
					
					check_visible_input_validation('apg_course','pd_course_preference','<?php echo REQD_SELECT_COURSE_PREFERENCE1_MSG; ?>',false);
					
					check_visible_input_validation('main_div_social_status','pd_social_status','<?php echo REQD_COMMUNITY_MSG; ?>',false);

					if(pd_course_preference.isValid() && pd_campus.isValid() && pd_title.isValid() && pd_firstname.isValid() && pd_middlename.isValid() && pd_lastname.isValid() && pd_mobile_no.isValid() && pd_email.isValid() && pd_dob.isValid() && pd_gender.isValid() && pd_alt_email.isValid() && pd_blood_group.isValid() && pd_diffrently_abled.isValid() && pd_nationality.isValid() && pd_social_status.isValid()){
						var pd_course_preference_val = $('#pd_course_preference').val();
						var pd_campus_val = $('#pd_campus').val();
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
						var pd_religion_val = $('#pd_religion').val();
						var pd_mother_tongue_val = $('#pd_mother_tongue').val();
						var pd_medium_of_instruction_val = $('#pd_medium_of_instruction').val();
						var pd_hostel_accommodation_val = $('#pd_hostel_accommodation').val();
						var pd_advertisement_source_val = $('#pd_advertisement_source').val();
						var pd_diffrently_abled_val = $('#pd_diffrently_abled').val();
						var pd_nationality_val = $('#pd_nationality').val();
						var pd_social_status_val = $('#pd_social_status').val();
						
						// Set Applicant Name
						<?php if(empty($applicant_name) || $applicant_name=="")  { ?>
							$("#applicant_name").val(pd_firstname_val);
						<?php } ?>						
						var user_data = 'pd_course_preference='+pd_course_preference_val+'&pd_campus='+pd_campus_val+'&pd_title='+pd_title_val+'&pd_firstname='+pd_firstname_val+'&pd_middlename='+pd_middlename_val+'&pd_lastname='+pd_lastname_val+'&phone_no_code='+pd_mobile_no_code_val+'&pd_mobile_no='+pd_mobile_no_val+'&pd_email='+pd_email_val+'&pd_dob='+pd_dob_val+'&pd_gender='+pd_gender_val+'&pd_alt_email='+pd_alt_email_val+'&pd_mother_tongue='+pd_mother_tongue_val+'&pd_medium_of_instruction='+pd_medium_of_instruction_val+'&pd_hostel_accommodation='+pd_hostel_accommodation_val+'&pd_advertisement_source='+pd_advertisement_source_val+'&pd_diffrently_abled='+pd_diffrently_abled_val+'&pd_nationality='+pd_nationality_val+'&pd_social_status='+pd_social_status_val+'&pd_blood_group='+pd_blood_group_val+'&pd_religion='+pd_religion_val+'&'+csrfName+'='+csrfHash;
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
									console.log(returndata);
									//if(returndata.status == 'true') {
										var startIndex = currentIndex+1
										window.location.href = url+'?startIndex='+startIndex; 
										//}, 100);									
										$("#formerr").hide();
										moveNxt=1;
									//}									
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
					}else{
						pd_course_preference.validate();
						pd_campus.validate();
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
						//pd_religion.validate();
						//pd_mother_tongue.validate();
						//pd_medium_of_instruction.validate();
						//pd_hostel_accommodation.validate();
						pd_diffrently_abled.validate();
						//pd_advertisement_source.validate();
						pd_nationality.validate();
						pd_social_status.validate();
						return false;
					}				
				}
				
				// Step 3 form validation
				if(currentIndex === 2) {
					var pd_father_title = $('#pd_father_title').parsley();
					var pd_father_name = $('#pd_father_name').parsley();
					var pd_father_email = $('#pd_father_email').parsley();
					var pd_father_phone = $('#pd_father_phone').parsley();
					var pd_alt_father_phone = $('#pd_alt_father_phone').parsley();
					var pd_mother_title = $('#pd_mother_title').parsley();
					var pd_mother_name = $('#pd_mother_name').parsley();
					var pd_mother_phone = $('#pd_mother_phone').parsley();
					var pd_alt_mother_phone = $('#pd_alt_mother_phone').parsley();
					var pd_mother_email = $('#pd_mother_email').parsley();
					var pd_guardian_name = $('#pd_guardian_name').parsley();
					var pd_guardian_phone = $('#pd_guardian_phone').parsley();
					var pd_guardian_email = $('#pd_guardian_email').parsley();
					var pd_guardian_occupation = $('#pd_guardian_occupation').parsley();
					var other_occupation_guardian = $('#other_occupation_guardian').parsley();
					var other_occupation_father = $('#other_occupation_father').parsley();
					var other_occupation_mother = $('#other_occupation_mother').parsley();
					
					check_visible_input_validation('guardian_details','pd_guardian_name','<?php echo REQD_GUARDIAN_NAME_MSG; ?>',true,'<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');
					
					check_visible_input_validation('guardian_details','pd_guardian_phone','<?php echo REQD_GUARDIAN_MOBILE_MSG; ?>',false);
					
					check_visible_input_validation('guardian_details','pd_guardian_email','<?php echo REQD_GUARDIAN_EMAIL_MSG;?>',false);
					
					check_visible_input_validation('guardian_details','pd_guardian_occupation','<?php echo REQD_GUARDIAN_OCCUPATION_MSG;?>',false);
					
					check_visible_input_validation('other_occupation_guardian_div','other_occupation_guardian','<?php echo REQD_GUARDIAN_OTHER_OCCUPATION_MSG; ?>',true,'<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');
					
					check_visible_input_nameonly_validation('other_occupation_father_div','other_occupation_father','<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');
					
					check_visible_input_nameonly_validation('other_occupation_mother_div','other_occupation_mother','<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');
					
					if(pd_father_title.isValid() && pd_father_name.isValid() && pd_mother_title.isValid() && pd_mother_name.isValid() && pd_father_email.isValid() && pd_mother_email.isValid() && pd_guardian_name.isValid() && pd_guardian_phone.isValid() && pd_guardian_email.isValid() && pd_father_phone.isValid() && pd_mother_phone.isValid() && pd_alt_father_phone.isValid() && pd_alt_mother_phone.isValid() && pd_guardian_occupation.isValid() && other_occupation_guardian.isValid() && other_occupation_father.isValid() && other_occupation_mother.isValid()) {
							var pd_father_id = $('#pd_father_id').val();
					  		var pd_father_title = $('#pd_father_title').val();
							var pd_father_name = $('#pd_father_name').val();
							var pd_father_phone_no_code = $('#pd_father_phone_no_code').val();
							var pd_father_phone = $('#pd_father_phone').val();
							var pd_father_alt_phone_no_code = $('#pd_father_alt_phone_no_code').val();
							var pd_father_alt_phone = $('#pd_alt_father_phone').val();
							var pd_father_email = $('#pd_father_email').val();
							var pd_father_occupation = $('#pd_father_occupation').val();
							var pd_mother_id = $('#pd_mother_id').val();
							var pd_mother_title = $('#pd_mother_title').val();
							var pd_mother_name = $('#pd_mother_name').val();
							var pd_mother_phone_no_code = $('#pd_mother_phone_no_code').val();
							var pd_mother_phone = $('#pd_mother_phone').val();
							var pd_mother_alt_phone_no_code = $('#pd_mother_alt_phone_no_code').val();
							var pd_mother_alt_phone = $('#pd_alt_mother_phone').val();
							var pd_mother_email = $('#pd_mother_email').val();
							var pd_mother_occupation = $('#pd_mother_occupation').val();
							var add_guardian_checkbox = $('#add_guardian_checkbox').val();
							var pd_guardian_id = $('#pd_guardian_id').val();
							var pd_guardian_name = $('#pd_guardian_name').val();
							var pd_guardian_phone_no_code = $('#pd_guardian_phone_no_code').val();
							var pd_guardian_alt_phone_no_code = $('#pd_guardian_alt_phone_no_code').val();
							var pd_guardian_phone = $('#pd_guardian_phone').val();
							var pd_guardian_alt_phone = $('#pd_guardian_alt_phone').val();
							var pd_guardian_email = $('#pd_guardian_email').val();
							var pd_guardian_occupation = $('#pd_guardian_occupation').val();
							
							if(pd_father_alt_phone!='' || pd_father_phone!=''){
								if(pd_father_phone==pd_father_alt_phone){
									unique_msg('pd_father_phone','#ec4561','<?php echo PHONE_ALT_UNIQUE; ?>');
									return false;
								}
							}
							
							if(pd_father_phone!='' || pd_mother_alt_phone!=''){
								if(pd_father_phone==pd_mother_alt_phone){
									unique_msg('pd_alt_mother_phone','#ec4561','<?php echo PHONE_ALT_UNIQUE; ?>');
									return false;
								}
							}
							
							if(pd_mother_phone!='' && pd_mother_alt_phone!=''){
								if(pd_mother_phone==pd_mother_alt_phone || pd_mother_phone==pd_father_alt_phone){
									unique_msg('pd_alt_mother_phone','#ec4561','<?php echo PHONE_ALT_UNIQUE; ?>');
									return false;
								}			
							}
							if(pd_mother_phone!='' && pd_father_alt_phone!=''){
								if(pd_mother_phone==pd_mother_alt_phone || pd_mother_phone==pd_father_alt_phone){
									unique_msg('pd_alt_father_phone','#ec4561','<?php echo PHONE_ALT_UNIQUE; ?>');
									return false;
								}			
							}
							// Unique Validation
							if(pd_guardian_phone!=''){
								if(pd_mother_phone==pd_guardian_phone || pd_father_phone==pd_guardian_phone || pd_father_alt_phone==pd_guardian_phone || pd_mother_alt_phone==pd_guardian_phone){
									unique_msg('pd_guardian_phone','#ec4561','<?php echo PHONE_MATCH_GUARDIAN; ?>');
									return false;
								}	
							}

							if(pd_guardian_email!=''){
								if(pd_mother_email==pd_guardian_email || pd_father_email==pd_guardian_email){
									unique_msg('pd_guardian_email','#ec4561','<?php echo EMAIL_MATCH_GUARDIAN; ?>');
									return false;
								}	
							}
							
							var other_occupation_father = $('#other_occupation_father').val();
							var other_occupation_mother = $('#other_occupation_mother').val();
							var other_occupation_guardian = $('#other_occupation_guardian').val();
							
							//Set Father Name at Declaration
							<?php if(empty($parent_name) || $parent_name=="")  { ?>
								$("#parent_name").val(pd_father_name);
							<?php } ?>							
							var userData = 'pd_father_id='+pd_father_id+'&pd_father_title='+pd_father_title+'&pd_father_name='+pd_father_name+'&pd_father_phone_no_code='+pd_father_phone_no_code+'&pd_father_phone='+pd_father_phone+'&pd_father_alt_phone_no_code='+pd_father_alt_phone_no_code+'&pd_father_alt_phone='+pd_father_alt_phone+'&pd_father_email='+pd_father_email+'&pd_father_occupation='+pd_father_occupation+'&pd_mother_id='+pd_mother_id+'&pd_mother_title='+pd_mother_title+'&pd_mother_name='+pd_mother_name+'&pd_mother_phone_no_code='+pd_mother_phone_no_code+'&pd_mother_alt_phone_no_code='+pd_mother_alt_phone_no_code+'&pd_mother_email='+pd_mother_email+'&pd_mother_occupation='+pd_mother_occupation+'&add_guardian_checkbox='+add_guardian_checkbox+'&pd_guardian_id='+pd_guardian_id+'&pd_guardian_name='+pd_guardian_name+'&pd_guardian_phone_no_code='+pd_guardian_phone_no_code+'&pd_guardian_phone='+pd_guardian_phone+'&pd_guardian_email='+pd_guardian_email+'&pd_guardian_occupation='+pd_guardian_occupation+'&pd_mother_phone='+pd_mother_phone+'&pd_mother_alt_phone='+pd_mother_alt_phone+'&other_occupation_father='+other_occupation_father+'&other_occupation_mother='+other_occupation_mother+'&other_occupation_guardian='+other_occupation_guardian+'&'+csrfName+'='+csrfHash;
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
										console.log(returndata);
										var startIndex = currentIndex+1
										window.location.href = url+'?startIndex='+startIndex; 
										//}, 100);
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
						}else{
					  	pd_father_title.validate();
						pd_father_name.validate();
						pd_father_phone.validate();
						pd_alt_father_phone.validate();
						pd_mother_title.validate();
						pd_mother_name.validate();
						pd_father_email.validate();
						pd_mother_email.validate();
						pd_mother_phone.validate();
						pd_alt_mother_phone.validate();
						pd_guardian_name.validate();
						pd_guardian_phone.validate();
						pd_guardian_email.validate();	
						pd_guardian_occupation.validate();
						other_occupation_guardian.validate();
						other_occupation_father.validate();
						other_occupation_mother.validate();						
						return false;
					}
				}
				
				if(currentIndex === 3) {
				  //return true;
				  var country = $('#country').parsley();
				  var state = $('#state').parsley();
				  var district = $('#district').parsley();
				  var city = $('#city').parsley();
				  var address1 = $('#address_line1').parsley();
				  var pincode = $('#pincode').parsley();			  
				  
				  if(country.isValid() && state.isValid() && district.isValid() && city.isValid() && address1.isValid() && pincode.isValid()) {
				  	var country_id 	= 	$('#country').val();
				  	var state_id 	= 	$('#state').val();
				  	var district_id = 	$('#district').val();
				  	var city_id     = 	$('#city').val();
				  	var address1    =  	$('#address_line1').val();
				  	var address2    =  	$('#address_line2').val();
				  	var pincode 	=	$('#pincode').val();
				  	var user_data = 'country_id='+country_id+'&state_id='+state_id+'&district_id='+district_id+'&city_id='+city_id+'&address_line_1='+address1+'&address_line_2='+address2+'&pincode='+pincode+'&'+csrfName+'='+csrfHash;
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
								console.log(returndata);
								if(returndata) {
									var startIndex = currentIndex+1
									window.location.href = url+'?startIndex='+startIndex; 
									//}, 100);
									$("#formerr").hide();
									moveNxt=1;	
								}									
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
					country.validate();
					state.validate();
					district.validate();
					city.validate();
					address1.validate();
					pincode.validate();
					return false;
				  }
				}				
				
				// Step 4 form validation
				if(currentIndex === 4) {
					var appering = $('#appering').parsley();
					var completed = $('#completed').parsley();
					var candidate_name = $('#candidate_name').parsley();
					var academic_tenth_inst = $('#academic_tenth_inst').parsley();
					var academic_board = $('#academic_board').parsley();
					var academic_marking_scheme = $('#academic_marking_scheme').parsley();
					var academic_obtain_cgpa = $('#academic_obtain_cgpa').parsley();
					var academic_yr_passing = $('#academic_yr_passing').parsley();
					var academic_reg_no = $('#academic_reg_no').parsley();
					var academic_board_other = $('#other_board_tenth').parsley();
					
					var academic_graduation_inst = $('#academic_graduation_inst').parsley();
					var academic_graduation_board = $('#academic_graduation_board').parsley();
					var other_board_graduation = $('#other_board_graduation').parsley();
					var academic_marking_scheme_graduation = $('#academic_marking_scheme_graduation').parsley();
					var academic_obtain_cgpa_graduation = $('#academic_obtain_cgpa_graduation').parsley();
					var academic_yr_passing_graduation = $('#academic_yr_passing_graduation').parsley();
					var academic_reg_no_graduation = $('#academic_reg_no_graduation').parsley();

					var academic_pg_graduation_inst = $('#academic_pg_graduation_inst').parsley();
					var academic_pg_graduation_board = $('#academic_pg_graduation_board').parsley();
					var other_board_pg_graduation = $('#other_board_pg_graduation').parsley();
					var academic_marking_scheme_pg_graduation = $('#academic_marking_scheme_pg_graduation').parsley();
					var academic_obtain_cgpa_pg_graduation = $('#academic_obtain_cgpa_pg_graduation').parsley();
					var academic_yr_passing_pg_graduation = $('#academic_yr_passing_pg_graduation').parsley();
					var academic_reg_no_pg_graduation = $('#academic_reg_no_pg_graduation').parsley();

					
					check_visible_input_validation('ob_tenth','other_board_tenth','<?php echo REQD_OTHER_BOARD_MSG; ?>',true,'<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');
					
					check_visible_input_validation('ob_twelfth','other_board_twelfth','<?php echo REQD_OTHER_BOARD_MSG; ?>',true,'<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');

					check_visible_input_validation('ob_graduation','other_board_graduation','<?php echo REQD_OTHER_UNIVERSITY_MSG; ?>',true,'<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');
					
					check_visible_input_validation('td_graduation_ms','academic_marking_scheme_graduation','<?php echo REQD_MARK_SCHEME_MSG; ?>',false);
					
					check_visible_input_validation('td_graduation_cgpa','academic_obtain_cgpa_graduation','<?php echo REQD_PERCENT_CGPA_MSG; ?>',false);
					
					check_visible_input_validation('td_graduation_yop','academic_yr_passing_graduation','<?php echo REQD_YEAR_OF_PASSING_MSG; ?>',false);
					
					check_visible_input_validation('td_graduation_reg_no','academic_reg_no_graduation','<?php echo REQD_REG_NO_MSG; ?>',false);
					
					check_visible_input_validation('td_pg_graduation_ms','academic_marking_scheme_pg_graduation','<?php echo REQD_MARK_SCHEME_MSG; ?>',false);

					check_visible_input_validation('td_pg_graduation_cgpa','academic_obtain_cgpa_pg_graduation','<?php echo REQD_PERCENT_CGPA_MSG; ?>',false);

					check_visible_input_validation('td_pg_graduation_yop','academic_yr_passing_pg_graduation','<?php echo REQD_YEAR_OF_PASSING_MSG; ?>',false);

					check_visible_input_validation('td_pg_graduation_reg_no','academic_reg_no_pg_graduation','<?php echo REQD_REG_NO_MSG; ?>',false);				
					
					check_visible_input_validation('row_pg','academic_pg_graduation_inst','<?php echo REQD_INSTITUTE_NAME_MSG; ?>',true,'<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');

					check_visible_input_validation('row_pg','academic_pg_graduation_board','<?php echo REQD_UNIVERSITY_MSG; ?>',false);
					
					
					var academic_twelfth_inst = $('#academic_twelfth_inst').parsley();
					var academic_twelfth_board = $('#academic_twelfth_board').parsley();
					var academic_marking_scheme_twelfth = $('#academic_marking_scheme_twelfth').parsley();
					var academic_obtain_cgpa_twelfth = $('#academic_obtain_cgpa_twelfth').parsley();
					var academic_yr_passing_twelfth = $('#academic_yr_passing_twelfth').parsley();
					var academic_reg_no_twelfth = $('#academic_reg_no_twelfth').parsley();
					var academic_stream = $('#academic_stream').parsley();
					var academic_twelfth_board_other = $('#other_board_twelfth').parsley();
					var name_of_the_program_0 = $('#name_of_the_program_0').parsley();
					var name_of_the_program_1 = $('#name_of_the_program_1').parsley();
					var name_of_the_program_2 = $('#name_of_the_program_2').parsley();
					var program_cy_0 = $('#program_cy_0').parsley();
					var program_cy_1 = $('#program_cy_1').parsley();
					var program_cy_2 = $('#program_cy_2').parsley();
					
					if(appering.isValid() && completed.isValid() && candidate_name.isValid() && academic_tenth_inst.isValid() && academic_board.isValid() &&  academic_marking_scheme.isValid() && academic_obtain_cgpa.isValid() && academic_yr_passing.isValid() && academic_reg_no.isValid() && academic_twelfth_inst.isValid() && academic_twelfth_board.isValid() && academic_marking_scheme_twelfth.isValid() && academic_obtain_cgpa_twelfth.isValid() && academic_yr_passing_twelfth.isValid() && academic_reg_no_twelfth.isValid() && academic_board_other.isValid() && academic_twelfth_board_other.isValid() && academic_graduation_inst.isValid() && academic_graduation_board.isValid() && academic_marking_scheme_graduation.isValid() && academic_obtain_cgpa_graduation.isValid() && academic_yr_passing_graduation.isValid() && academic_reg_no_graduation.isValid() && other_board_graduation.isValid() && academic_pg_graduation_inst.isValid() && academic_pg_graduation_board.isValid() && academic_marking_scheme_pg_graduation.isValid() && academic_obtain_cgpa_pg_graduation.isValid() && academic_yr_passing_pg_graduation.isValid() && academic_reg_no_pg_graduation.isValid() && other_board_pg_graduation.isValid() && name_of_the_program_0.isValid() && name_of_the_program_1.isValid() && name_of_the_program_2.isValid() && program_cy_0.isValid() && program_cy_1.isValid() && program_cy_2.isValid()){
						if($('#appering').is(':checked')) {
							var current_qualification_status_val = 'aug';
						}else if($('#completed').is(':checked')){
							var current_qualification_status_val = 	'cug';	
						}else if($('#apperingpg').is(':checked')) {
							var current_qualification_status_val = 'apg';
						}else if($('#completedpg').is(':checked')){
							var current_qualification_status_val = 	'cpg';	
						}						
						var candidate_name_val 	= 	$('#candidate_name').val();
						var academic_tenth_inst_val 	= 	$('#academic_tenth_inst').val();
						var academic_board_val 	= 	$('#academic_board').val();
						var academic_marking_scheme_val = $('#academic_marking_scheme').val();
						var academic_obtain_cgpa_val = $('#academic_obtain_cgpa').val();
						var academic_yr_passing_val = $('#academic_yr_passing').val();
						var academic_reg_no_val = $('#academic_reg_no').val();
						var academic_board_other_val = $('#other_board_tenth').val();

						var academic_twelfth_inst_val 	= 	$('#academic_twelfth_inst').val();
						var academic_twelfth_board_val 	= 	$('#academic_twelfth_board').val();
						var academic_twelfth_marking_scheme_val = $('#academic_marking_scheme_twelfth').val();
						var academic_twelfth_obtain_cgpa_val = $('#academic_obtain_cgpa_twelfth').val();
						var academic_twelfth_yr_passing_val = $('#academic_yr_passing_twelfth').val();
						var academic_twelfth_reg_no_val = $('#academic_reg_no_twelfth').val();
						
						var digilocker_val = $('#nad_id_digilocker_id').val();
						var academic_twelfth_board_other_val = $('#other_board_twelfth').val();
						
						var academic_graduation_inst_val = $('#academic_graduation_inst').val();
						var academic_graduation_board_val = $('#academic_graduation_board').val();
						var academic_marking_scheme_graduation_val = $('#academic_marking_scheme_graduation').val();
						var academic_obtain_cgpa_graduation_val = $('#academic_obtain_cgpa_graduation').val();
						var academic_yr_passing_graduation_val = $('#academic_yr_passing_graduation').val();
						var academic_reg_no_graduation_val = $('#academic_reg_no_graduation').val();
						var other_board_graduation_val = $('#other_board_graduation').val();
						var is_graduation = $('#is_graduation').val();
												
						var academic_pg_graduation_inst_val = $('#academic_pg_graduation_inst').val();
						var academic_pg_graduation_board_val = $('#academic_pg_graduation_board').val();
						var academic_marking_scheme_pg_graduation_val = $('#academic_marking_scheme_pg_graduation').val();
						var academic_obtain_cgpa_pg_graduation_val = $('#academic_obtain_cgpa_pg_graduation').val();
						var academic_yr_passing_pg_graduation_val = $('#academic_yr_passing_pg_graduation').val();
						var academic_reg_no_pg_graduation_val = $('#academic_reg_no_pg_graduation').val();
						var other_board_pg_graduation_val = $('#other_board_pg_graduation').val();

						var name_of_the_program_0 = $('#name_of_the_program_0').val();
						var name_of_the_program_1 = $('#name_of_the_program_1').val();
						var name_of_the_program_2 = $('#name_of_the_program_2').val();
						var program_cy_0 = $('#program_cy_0').val();
						var program_cy_1 = $('#program_cy_1').val();
						var program_cy_2 = $('#program_cy_2').val();
						var publn_det_id_0 = $('#publn_det_id_0').val();
						var publn_det_id_1 = $('#publn_det_id_1').val();
						var publn_det_id_2 = $('#publn_det_id_2').val();
						
						
						var user_data = 'current_qualification_status='+current_qualification_status_val+'&candidate_name='+candidate_name_val+'&academic_tenth_inst='+academic_tenth_inst_val+'&academic_tenth_board='+academic_board_val+'&academic_tenth_msv='+academic_marking_scheme_val+'&academic_tenth_cgpa='+academic_obtain_cgpa_val+'&academic_tenth_yrp='+academic_yr_passing_val+'&academic_tenth_regno='+academic_reg_no_val+'&academic_twelfth_inst='+academic_twelfth_inst_val+'&academic_twelfth_board='+academic_twelfth_board_val+'&academic_twelfth_msv='+academic_twelfth_marking_scheme_val+'&academic_twelfth_cgpa='+academic_twelfth_obtain_cgpa_val+'&academic_twelfth_yrp='+academic_twelfth_yr_passing_val+'&academic_twelfth_regno='+academic_twelfth_reg_no_val+'&digilocker_id='+digilocker_val+'&academic_board_other='+academic_board_other_val+'&academic_twelfth_board_other='+academic_twelfth_board_other_val+'&other_board_graduation='+other_board_graduation_val+'&is_graduation='+is_graduation+'&academic_graduation_inst='+academic_graduation_inst_val+'&academic_graduation_board='+academic_graduation_board_val+'&academic_marking_scheme_graduation='+academic_marking_scheme_graduation_val+'&academic_obtain_cgpa_graduation='+academic_obtain_cgpa_graduation_val+'&academic_yr_passing_graduation='+academic_yr_passing_graduation_val+'&academic_reg_no_graduation='+academic_reg_no_graduation_val+'&academic_pg_graduation_inst='+academic_pg_graduation_inst_val+'&academic_pg_graduation_board='+academic_pg_graduation_board_val+'&academic_marking_scheme_pg_graduation='+academic_marking_scheme_pg_graduation_val+'&academic_obtain_cgpa_pg_graduation='+academic_obtain_cgpa_pg_graduation_val+'&academic_yr_passing_pg_graduation='+academic_yr_passing_pg_graduation_val+'&academic_reg_no_pg_graduation='+academic_reg_no_pg_graduation_val+'&other_board_pg_graduation='+other_board_pg_graduation_val+'&name_of_the_program_0='+name_of_the_program_0+'&name_of_the_program_1='+name_of_the_program_1+'&name_of_the_program_2='+name_of_the_program_2+'&program_cy_0='+program_cy_0+'&program_cy_1='+program_cy_1+'&program_cy_2='+program_cy_2+'&publn_det_id_0='+publn_det_id_0+'&publn_det_id_1='+publn_det_id_1+'&publn_det_id_2='+publn_det_id_2+'&'+csrfName+'='+csrfHash;
						var moveNxt=0;
						$.ajax({
							type: 'POST',
							url: url,
							data: user_data+'&currentIndex='+currentIndex,
							dataType: 'json',
							async: false,
							beforeSend: function() { $('.loader').show(); },
							success: function(returndata) {
								if(returndata) {									
									console.log(returndata);
									if(returndata) {
										var startIndex = currentIndex+1
										window.location.href = url+'?startIndex='+startIndex; 
										//}, 100);
										$("#formerr").hide();
										moveNxt=1;	
									}									
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
					}else{
						appering.validate();
						completed.validate();	
						candidate_name.validate();
						academic_tenth_inst.validate();
						academic_board.validate();
						academic_marking_scheme.validate();
						academic_obtain_cgpa.validate();
						academic_yr_passing.validate();
						academic_reg_no.validate();
						academic_board_other.validate();
						academic_twelfth_inst.validate();
						academic_twelfth_board.validate();
						academic_marking_scheme_twelfth.validate();
						academic_obtain_cgpa_twelfth.validate();
						academic_yr_passing_twelfth.validate();
						academic_reg_no_twelfth.validate();
						academic_twelfth_board_other.validate();
						academic_graduation_inst.validate();
						academic_graduation_board.validate();
						academic_marking_scheme_graduation.validate();
						academic_obtain_cgpa_graduation.validate();
						academic_yr_passing_graduation.validate();
						academic_reg_no_graduation.validate();
						academic_pg_graduation_inst.validate();
						academic_pg_graduation_board.validate();
						academic_marking_scheme_pg_graduation.validate();
						academic_obtain_cgpa_pg_graduation.validate();
						academic_yr_passing_pg_graduation.validate();
						academic_reg_no_pg_graduation.validate();
						name_of_the_program_0.validate();
						name_of_the_program_1.validate();
						name_of_the_program_2.validate();
						program_cy_0.validate();
						program_cy_1.validate();
						program_cy_2.validate();
						return false; 						
					}
				}
				
				// Academic Details End
				
				// Payment Start
				if(currentIndex === 5) {
					check_visible_input_validation('payment_details','BankName','<?php echo REQD_CHOOSE_BANK_MSG; ?>',false);
					check_visible_input_validation('payment_details','BranchName','<?php echo REQD_BANK_NAME_MSG; ?>',false);
					check_visible_input_validation('payment_details','DDNumber','<?php echo REQD_DD_NO_MSG; ?>',false);		check_visible_input_validation('payment_details','DDDate','<?php echo REQD_DD_DATE_MSG; ?>',false);
					
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
								console.log(returndata);
									if(returndata.status == 'true') {
										setTimeout(function() { 
											window.location.href = redirect_payment_thank_you+'&payment_mode='+payment_mode+'&currentIndex='+currentIndex+url_edit; 
										}, 200);
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

				if(currentIndex === 6) {
					return true;
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
				
			// form preview button displayed
			if(currentIndex == parseInt(total_wizard_Step - 1)){
				$("#save_exit").remove();
				if(mode_edit_url !=''){
					enable_preview_btn(currentIndex,'<?php echo base_url();?>fellowship_preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
				}else{
					enable_preview_btn(currentIndex,'<?php echo base_url();?>fellowship_preview');
				}				
			}else{
				$("#previewbtn").remove();
			}
		}, 
        onCanceled: function (event) { },
        onFinishing: function (event, currentIndex) { return true; }, 
        onFinished: function (event, currentIndex) { 	
			var photograph = $('#photograph').parsley();
			var signature = $('#signature').parsley();
			var applicant_name = $('#applicant_name').parsley();
			var parent_name = $('#parent_name').parsley();
			var graduation_marksheet = $('#graduation_marksheet').parsley();
			var pg_graduation_marksheet = $('#post_graduation_marksheet').parsley();
			
			<?php if($curr_edu_quali_status=='cug') { ?>
				$('#post_graduation_marksheet').attr('data-parsley-required','false');
			<?php } ?>
			
			if(photograph.isValid() && signature.isValid() && applicant_name.isValid() && parent_name.isValid() && graduation_marksheet.isValid() && pg_graduation_marksheet.isValid()) {
				var applicant_name = $('#applicant_name').val();
				var parent_name = $('#parent_name').val();
				var ddate = $('#ddate').val();
				// Get Regenerated CSRF Dynamically
				var csrfHashRegenerateonDec = $("input[name='"+csrfName+"']").val();
				
				var user_data = 'applicant_name='+applicant_name+'&parent_name='+parent_name+'&ddate='+ddate+'&currentIndex='+currentIndex+'&'+csrfName+'='+csrfHashRegenerateonDec;		
				console.log('fas'+user_data);
				var moveNxt=0;
				$.ajax({
					type: 'POST',
					url: url,
					data: user_data,
					dataType: 'json',
					cache: false,
					async: false,
					beforeSend: function() { $('.loader').show(); },
					success: function(returndata) {
					  console.log(returndata);
					  if(returndata){
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
					setTimeout(function() { window.location.href = redirect+url_edit; }, 100);
					return true;
				}	      
			} else {
				photograph.validate();
				signature.validate();
				applicant_name.validate();
				parent_name.validate();
				graduation_marksheet.validate();
				pg_graduation_marksheet.validate();
				return false;
			}		
			return true;
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
	
	$("#fellowship_form").steps(settings);
	//setsave exit attr	
    $(document).on("click", "#save_btn" , function() {
    	 $("#fellowship_form").attr('isexit',1);
         $("#fellowship_form").steps('next');
    });
    
    $('.actions a').click(function(){        	 
      $("#fellowship_form").attr('isexit','');
    }); 
//end set attr
	//to remove links from previous tabs a
    <?php if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) && ($mode_edit == '')) { ?>
     $( ".steps li" ).each(function( index ) { 
      if(index<6){       	 
   	  $("#fellowship_form-t-"+index).removeAttr("href");
     }			   
   	});
    <?php } ?>
	light_box_init();
	$(document).ready(function () {	
		// This Function for Payment option selection
		$("#online").click(function(){
			$("#payment_details").hide();
		});
		$("#dd").click(function(){
			 $("#payment_details").show();
		});
	
		// Accept Dot Last Name
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
		
		var no_study_resident_in_msg = "<?php echo NO_STUDY_RESIDENT_IN_MSG; ?>";
		var no_resident_status_msg = "<?php echo NO_RESIDENT_STATUS_MSG; ?>";
		var no_gender_title_msg = "<?php echo NO_GENDER_TITLE_MSG; ?>";
		var no_mobile_code_msg = "<?php echo NO_MOBILE_CODE_MSG; ?>";
		var no_gender_msg = "<?php echo NO_GENDER_MSG; ?>";
		var no_blood_group_msg = "<?php echo NO_BLOOD_GROUP_MSG; ?>";
		var no_religions_msg = "<?php echo NO_RELIGIONS_MSG; ?>";
		var no_mother_tongues_msg = "<?php echo NO_MOTHER_TONGUES_MSG; ?>";
		var no_medium_of_instruction_msg = "<?php echo NO_MEDIUM_OF_INSTRUCTION_MSG; ?>";
		var no_hostel_accommodation_msg = "<?php echo NO_HOSTEL_ACCOMMODATION_MSG; ?>";
		var no_differently_abled_msg = "<?php echo NO_DIFFRENTLY_ABLED_MSG; ?>";
		var no_advertisement_source_msg = "<?php echo NO_ADVERTISEMENT_SOURCE_MSG; ?>";
		var no_nationality_msg = "<?php echo NO_NATIONALITY_MSG; ?>";
		var no_social_status_msg = "<?php echo NO_SOCIAL_STATUS_MSG; ?>";
		var no_title_msg = "<?php echo NO_TITLE_MSG; ?>";
		var no_occupation_msg = "<?php echo NO_OCCUPATION_MSG; ?>";
		var no_country_msg = "<?php echo NO_COUNTRY_MSG; ?>";
		var no_state_msg = "<?php echo NO_STATE_MSG; ?>";
		var no_city_msg = "<?php echo NO_CITY_MSG; ?>";
		var no_district_msg = "<?php echo NO_DISTRICT_MSG; ?>";
		var no_board_msg = "<?php echo NO_BOARD_MSG; ?>";
		var no_user_marking_scheme_msg = "<?php echo NO_USER_MARKING_SCHEME_MSG; ?>";
		var no_yop_status = '<?php echo NO_YOP_STATUS; ?>';
		var no_campus_msg = '<?php echo NO_CAMPUS_MSG; ?>';
		var no_course_msg = '<?php echo NO_COURSE_MSG; ?>';
		var no_university_status = '<?php echo NO_UNIVERSITY_MSG; ?>';
		var no_banks_msg = "<?php echo NO_BANKS_MSG; ?>";
		
		getSelect2('BankName','<?php echo base_url("get_banks"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Bank', formatRepoCommon,no_banks_msg, false, formatRepoSelection);
		
		getSelect2('academic_graduation_board','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose University', formatRepoCommon,no_university_status, false, formatRepoSelection);
		
		getSelect2('academic_pg_graduation_board','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose University', formatRepoCommon,no_university_status, false, formatRepoSelection);
		
		getSelect2('studied_in_india','<?php echo base_url("get_bsc_hons_am_studied_from_india"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Status - Yes or No', formatRepoCommon,no_study_resident_in_msg, false, formatRepoSelection);		
		
		getSelect2('resident_status','<?php echo base_url("get_resident_status"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Resident Status', formatRepoCommon,no_resident_status_msg, false, formatRepoSelection);
		
		getSelect2('pd_title','<?php echo base_url("get_gender_title"); ?>?is_lookup_master=1'+url_edit,'Choose Gender Title', formatRepoCommon,no_gender_title_msg, false, formatRepoSelection);
		
		getSelect2('phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
		
		getSelect2('pd_gender','<?php echo base_url("get_gender"); ?>?is_lookup_master=1'+url_edit,'Choose Gender', formatRepoCommon,no_gender_msg, false, formatRepoSelection);
		
		getSelect2('pd_blood_group','<?php echo base_url("get_bloodgroups"); ?>?sort_by=blood_grp_id&sort_order=asc'+url_edit,'Choose Blood Groups', formatRepoCommon,no_blood_group_msg, false, formatRepoSelection);
		
		getSelect2('pd_religion','<?php echo base_url("get_religions"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Religions', formatRepoCommon,no_religions_msg, false, formatRepoSelection);
		
		getSelect2('pd_mother_tongue','<?php echo base_url("get_mother_tongues"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Mother Tongues', formatRepoCommon,no_mother_tongues_msg, false, formatRepoSelection);
		
		getSelect2('pd_medium_of_instruction','<?php echo base_url("get_mother_tongues"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Medium Of Instruction', formatRepoCommon,no_medium_of_instruction_msg, false, formatRepoSelection);

		getSelect2('pd_hostel_accommodation','<?php echo base_url("get_hostel_accommodation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Hostel Accommodation', formatRepoCommon,no_hostel_accommodation_msg, false, formatRepoSelection);
		
		getSelect2('pd_diffrently_abled','<?php echo base_url("get_are_you_differently_abled"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Differently Abled', formatRepoCommon,no_differently_abled_msg, false, formatRepoSelection);
		
		getSelect2('pd_advertisement_source','<?php echo base_url("get_advertisement_source"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Advertisement Source', formatRepoCommon,no_advertisement_source_msg, false, formatRepoSelection);
		
		getSelect2('pd_nationality','<?php echo base_url("get_nationalities"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Nationality', formatRepoCommon,no_nationality_msg, false, formatRepoSelection);
		
		getSelect2('pd_social_status','<?php echo base_url("get_social_status"); ?>?is_lookup_master=1'+url_edit,'Choose Social Status', formatRepoCommon,no_social_status_msg, false, formatRepoSelection);
		
		getSelect2('pd_father_title','<?php echo base_url("get_parent_title"); ?>?is_lookup_master=1&is_father=1'+url_edit,'Choose Title', formatRepoCommon,no_title_msg, false, formatRepoSelection);
		
		getSelect2('pd_father_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
		
		getSelect2('pd_father_alt_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);		
		
		getSelect2('pd_father_occupation','<?php echo base_url("get_parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Father Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);

		getSelect2('pd_mother_title','<?php echo base_url("get_mother_title"); ?>?is_lookup_master=1&is_mother=1'+url_edit,'Choose Title', formatRepoCommon,no_title_msg, false, formatRepoSelection);
		
		getSelect2('pd_mother_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
		
		getSelect2('pd_mother_alt_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
		
		getSelect2('pd_mother_occupation','<?php echo base_url("get_parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Mother Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);
		
		getSelect2('pd_guardian_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
		
		getSelect2('pd_guardian_occupation','<?php echo base_url("get_parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Mother Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);	

		getSelect2('country','<?php echo base_url("get_countries"); ?>?sort_by=country_id&sort_order=asc'+url_edit,'Choose Country', formatRepoCommon,no_country_msg, false, formatRepoSelection);

		getSelect2('academic_board','<?php echo base_url("get_board"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Board', formatRepoCommon,no_board_msg, false, formatRepoSelection);
		
		getSelect2('academic_marking_scheme','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
		
		getSelect2('academic_twelfth_board','<?php echo base_url("get_board"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Board', formatRepoCommon,no_board_msg, false, formatRepoSelection);
		
		getSelect2('academic_marking_scheme_twelfth','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
		
		getSelect2('academic_marking_scheme_graduation','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
		
		getSelect2('academic_marking_scheme_pg_graduation','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
		
		// Course Preferences Load Based On Campus Preferences
		
		getSelect2('pd_campus','<?php echo base_url("get_fellowship_campus_preference"); ?>?prog_id='+srm_fellowship+url_edit,'Choose', formatRepoCommon,no_campus_msg, false, formatRepoSelection);
		
		$('#pd_campus').on('change',function() {
			setEmptyOnChangeSelect2('pd_course_preference'); 
			// when no values return in json, add empty option value 
			if ($('#pd_course_preference').data('select2')) {$('#pd_course_preference').select2('destroy');}
			// make empty
			$('#pd_course_preference').html('');			
			$("#apg_course").show();
			var pd_campus = $(this).val();
			console.log("pd_campus"+pd_campus);
			getSelect2('pd_course_preference','<?php echo base_url("get_fellowship_course_preference"); ?>?pd_campus='+pd_campus+'&sort_by=id&sort_order=asc&prog_id='+srm_fellowship+url_edit,'Select Course Preferences', formatRepoCommon,no_course_msg, false, formatRepoSelection);			
		});

		// Onchange COuntry
		$('#country').on('change',function() {
			setEmptyOnChangeSelect2('state'); 
			// when no values return in json, add empty option value 
			if ($('#state').data('select2')) {$('#state').select2('destroy');}
			// make empty
			$('#state').html('');
			var country_val = $(this).val();
			var url = '<?php echo base_url("get_states"); ?>?country_id='+country_val+	'&sort_by=id&sort_order=asc'+url_edit;
			onchange_country('main_div_state','main_div_district','main_div_city','state','city','district',url,no_state_msg,country_value_default,country_val)
		});	
		
		// Onchange State
		$('#state').on('change',function() {
			setEmptyOnChangeSelect2('district');
			// when no values return in json, add empty option value 
			if ($('#district').data('select2')) {
				$('#district').select2('destroy');
				$('#district,#city').html(''); 	
			}			
			// make empty
					
			var state_val = $(this).val();
			var country_val = $('#country').val();
			var url = '<?php echo base_url("get_district"); ?>?state_id='+state_val+'&sort_by=id&sort_order=asc'+url_edit;
			if(country_value_default==country_val){	
				$('#main_div_district').show();
				getSelect2('district',url,'Select District', formatRepoCommon,no_district_msg, false, formatRepoSelection);
			}
		});			
	
		// Onchange District
		$('#district').on('change',function() {
			setEmptyOnChangeSelect2('city');
			// when no values return in json, add empty option value 
			if ($('#city').data('select2')) {$('#city').select2('destroy');}			
			// make empty
			$('#city').html(''); 			
			var state_val = $('#state').val();
			var country_val = $('#country').val();
			if(country_value_default==country_val){	
				$('#main_div_city').show();
				getSelect2('city','<?php echo base_url("get_cities"); ?>?state_id='+state_val+'&sort_by=id&sort_order=asc'+url_edit,'Select City', formatRepoCommon,no_city_msg, false, formatRepoSelection);
			}
		});		
		
		// Show Father & Mother Input
		show_parents_detail('pd_father_title','father_mbleno_div','father_email_div','father_occupation_div','father_ambleno_div');
		
		show_parents_detail('pd_mother_title','mother_mbleno_div','mother_email_div','mother_occupation_div','mother_ambleno_div');
		
		// DOB Datepicker		
		$("#pd_dob").datepicker( {
			format:"mm/dd/yyyy" ,autoclose: true,todayHighlight: true,endDate: endDob
		}).on('changeDate', function(e) {
				$("#pd_dob").parsley().validate();
		});
		// year of passing tenth & twelfth
		$("#academic_yr_passing").datepicker( {
			format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy'),startDate: '-40y',endDate: '+0d' 
        }).on('changeDate', function(e) {
			$("#academic_yr_passing").parsley().validate();
			var Yr=$("#academic_yr_passing").val();
            if(Yr!="" && Yr!="YYYY"){                
         	var addYr=2;
         	var setYr=parseInt(Yr)+addYr;
             $("#academic_yr_passing_twelfth").attr("min",setYr);
            }	
		});	
		
		$("#academic_yr_passing_twelfth").datepicker( {
			format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy'),startDate: '-40y',endDate: '+0d' 
        }).on('changeDate', function(e) {
			$("#academic_yr_passing_twelfth").parsley().validate();
			var Yrt=$("#academic_yr_passing_twelfth").val();
            if(Yrt!="" && Yrt!="YYYY"){                
         	var addYr=2;
         	var setYr=parseInt(Yrt)-addYr;
             $("#academic_yr_passing").attr("min",setYr);
            }	
		});
		
		$("#academic_yr_passing_graduation").datepicker( {
			format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy'),startDate: '-40y',endDate: '+0d' 
        }).on('changeDate', function(e) {
			$("#academic_yr_passing_graduation").parsley().validate();
		});

		$("#academic_yr_passing_pg_graduation").datepicker( {
			format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy'),startDate: '-40y',endDate: '+0d' 
        }).on('changeDate', function(e) {
			$("#academic_yr_passing_pg_graduation").parsley().validate();
		});		
		
		$("#DDDate").datepicker({
			format:"dd/mm/yyyy" , autoclose: !0, todayHighlight: true,todaybtn:true,endDate: todaydate}).on('changeDate', function(e) {$("#DDDate").parsley().validate();
		});
	
		datepicker_yop('program_cy_0','yyyy','years','-40y','+0d');
		datepicker_yop('program_cy_1','yyyy','years','-40y','+0d');
		datepicker_yop('program_cy_2','yyyy','years','-40y','+0d');

		// Basic Details Tab 1
		$('#studied_in_india').on('change',function(){
			var studied_in_india = $(this).val();
			if(studied_in_india=='yes') {
				$('#guidelines').show();
				$('#international_bsc_hons_am').hide();
				$('#main_resident_status').hide();
				$('.actions ul li:nth-child(2) a').css('pointer-events','auto');
				$('.actions ul li:nth-child(2)').removeClass('disabled');
			} else {
				$('#guidelines').hide();
				$('#international_bsc_hons_am').show();
				$('#main_resident_status').show();
			}
		});	
		

		
		// Basic Detail Select2Load
		<?php if(!empty($applicant_appln_details_list[0]['qualifyingexamfromindia']=='t')) { ?>
			var value = 'yes';	
		<?php }elseif($applicant_appln_details_list[0]['qualifyingexamfromindia']=='f')  {  ?>
			var value = 'no';	
		<?php }else { ?> 
			var value = '';
		<?php } ?>
	
		select2loadbyMatch('studied_in_india',value,false);
		
		// Personal Detail Select2Load 
		select2load('BankName','<?php echo $payment_details_list['bank_id']; ?>','<?php echo $payment_details_list['bank_name']; ?>');
		
		select2load('pd_campus','<?php echo $applicant_campus_details_list[0]['campus_id']; ?>','<?php echo $applicant_campus_details_list[0]['campus_name']; ?>');
		
		select2load('phone_no_code','<?php echo $applicant_basic_details_list['applicant_mob_country_code_id']; ?>','<?php echo $applicant_basic_details_list['applicant_mob_country_code_name']; ?>');
		
		select2load('pd_course_preference','<?php echo $applicant_course_details_list[0]['course_id']; ?>','<?php echo $applicant_course_details_list[0]['course_name']; ?>');
		
		select2load('pd_title','<?php echo $applicant_basic_details_list['tittle_id']; ?>','<?php echo $applicant_basic_details_list['tittle_name']; ?>');
		
		select2load('pd_gender','<?php echo $applicant_basic_details_list['gender_id']; ?>','<?php echo $applicant_basic_details_list['gender']; ?>');

		select2load('pd_blood_group','<?php echo $applicant_basic_details_list['blood_id']; ?>','<?php echo $applicant_basic_details_list['blood_group']; ?>');
		
		select2load('pd_religion','<?php echo $applicant_basic_details_list['religion_id']; ?>','<?php echo $applicant_basic_details_list['religion_name']; ?>');
		
		select2load('pd_mother_tongue','<?php echo $applicant_basic_details_list['mothertongue_id']; ?>','<?php echo $applicant_basic_details_list['mothertongue_name']; ?>');
		
		select2loadbyMatch('pd_hostel_accommodation','<?php echo $applicant_basic_details_list['prefer_hostel']; ?>');

		select2load('pd_advertisement_source','<?php echo $applicant_basic_details_list['advertisement_source_id']; ?>','<?php echo $applicant_basic_details_list['source_name']; ?>');
		
		select2load('pd_nationality','<?php echo $applicant_basic_details_list['nation_id']; ?>','<?php echo $applicant_basic_details_list['nationality']; ?>');
		
		select2load('pd_social_status','<?php echo $applicant_basic_details_list['social_status_id']; ?>','<?php echo $applicant_basic_details_list['social_status']; ?>');
		
		select2load('pd_medium_of_instruction','<?php echo $applicant_other_details_list[0]['medofinst']; ?>','<?php echo $applicant_other_details_list[0]['medium_of_study_name']; ?>');
		
		select2loadbyMatch('pd_diffrently_abled','<?php echo $applicant_basic_details_list['dif_abled']; ?>');		
		
		$('#add_guardian_checkbox').on('change',function(){
			if($(this).is(':checked')) {
				$('#add_guardian_checkbox').val('true');
				$('#guardian_details').show();
			} else {
				$('#add_guardian_checkbox').val('false');
				$('#guardian_details').hide();
				$('#pd_guardian_email,#pd_guardian_phone,#other_occupation_guardian,#pd_guardian_name').val('');
				$('#other_occupation_guardian_div').hide();
				$('#pd_guardian_occupation').html('');
				$('#pd_guardian_phone_no_code').html('');
			}
		});
		
		$("#i_confirm").on('change',function(){
			if($(this).is(':checked')) {
				$("#i_confirm").val('true');
			}
		})
		
		$('#completed').on('change',function(){
			if($(this).is(':checked')) {
				$('#row_pg').hide();
				$('#td_graduation_ms,#td_graduation_cgpa,#td_graduation_yop,#td_graduation_reg_no').show();
			} else {
				$('#td_graduation_ms,#td_graduation_cgpa,#td_graduation_yop,#td_graduation_reg_no').hide();
			}
		});	
		<?php 
		
		?>
		$('#appering').on('change',function(){
			if($(this).is(':checked')) {
				$('#row_pg,#td_graduation_ms,#td_graduation_cgpa,#td_graduation_yop,#td_graduation_reg_no').hide();
			}
		});

		$('#apperingpg').on('change',function(){
			if($(this).is(':checked')) {
				$('#td_pg_graduation_ms,#td_pg_graduation_cgpa,#td_pg_graduation_yop,#td_pg_graduation_reg_no').hide();
				$('#row_pg,#td_graduation_ms,#td_graduation_cgpa,#td_graduation_yop,#td_graduation_reg_no').show();
			}
		});		
		
		$('#completedpg').on('change',function(){
			if($(this).is(':checked')) {
				$('#row_pg,#td_pg_graduation_ms,#td_pg_graduation_cgpa,#td_pg_graduation_yop,#td_pg_graduation_reg_no,#td_graduation_ms,#td_graduation_cgpa,#td_graduation_yop,#td_graduation_reg_no').show();
			}
		});				
		
		<?php
			// print_r($current_education_qual_status);
			// exit;
		?>
		var current_education_qual_status = '<?php echo $curr_edu_quali_status; ?>';
		if(current_education_qual_status=="aug"){
			$('#td_graduation_ms,#td_graduation_cgpa,#td_graduation_yop,#td_graduation_reg_no').hide();
		}else if(current_education_qual_status=="cug"){
			$('#td_graduation_ms,#td_graduation_cgpa,#td_graduation_yop,#td_graduation_reg_no').show();		
		}else if(current_education_qual_status=="apg"){
			$('#row_ug,#row_pg,#td_graduation_ms,#td_graduation_cgpa,#td_graduation_yop,#td_graduation_reg_no').show();		
			$('#td_pg_graduation_ms,#td_pg_graduation_cgpa,#td_pg_graduation_yop,#td_pg_graduation_reg_no').hide();		
		}else if(current_education_qual_status=="cpg"){
			$('#row_pg,#td_graduation_ms,#td_graduation_cgpa,#td_graduation_yop,#td_graduation_reg_no').show();		
		}
		
		// Check if the user is non resident 
		// Basic Details Tab 1
		$('#resident_status').on('change',function(){
			var resident_status = $(this).val();
			if(resident_status) {
				$('.actions ul li:nth-child(2) a').css('pointer-events','none');
				$('.actions ul li:nth-child(2)').addClass('disabled');
				$('#custom-resident_status-parsley-error').css('color','#ff0000');
				$('#custom-resident_status-parsley-error').text('<?php echo NO_OPTION_PROCEED_MSG; ?>');
			}
		});
		
		// Parent Other Occupation Enable	
		parent_other_occupation_enable('pd_father_occupation','other_occupation_father_div',7,true,'other_occupation_father');
		parent_other_occupation_enable('pd_mother_occupation','other_occupation_mother_div',7,true,'other_occupation_mother');
		parent_other_occupation_enable('pd_guardian_occupation','other_occupation_guardian_div',7,true,'other_occupation_guardian');
		
		validate_cgpa('academic_marking_scheme','academic_obtain_cgpa');
		validate_cgpa('academic_marking_scheme_twelfth','academic_obtain_cgpa_twelfth');
		validate_cgpa('academic_marking_scheme_graduation','academic_obtain_cgpa_graduation');
		validate_cgpa('academic_marking_scheme_pg_graduation','academic_obtain_cgpa_pg_graduation');
		
		$('#pd_nationality').on('change',function(){
			var country_val = $(this).val();
			if(country_value_default==country_val){
				$("#pd_social_status").prepend("<option value=''>Choose Social Status</option>").val('');
				getSelect2('pd_social_status','<?php echo base_url("get_social_status"); ?>?is_lookup_master=1'+url_edit,'Choose Social Status', formatRepoCommon,no_social_status_msg, false, formatRepoSelection);
				$('#main_div_social_status').show();
			}else{
				setEmptyOnChangeSelect2('pd_social_status');
				if ($('#pd_social_status').data('select2')) {
					$('#pd_social_status').select2('destroy');
				}
				$('#pd_social_status').html('');
				$('#main_div_social_status').hide();
			}
		});
		
		// Address Detail Select2Load
		select2load('country','<?php echo $country_id[0]; ?>','<?php echo $country_name[0]; ?>');
		select2load('state','<?php echo $state_id[0]; ?>','<?php echo $state_name[0]; ?>');
		select2load('district','<?php echo $district_id[0]; ?>','<?php echo $district_name[0]; ?>');
		select2load('city','<?php echo $city_id[0]; ?>','<?php echo $city_name[0]; ?>');	
		
		// Tenth Academic Detail Select2Load
		select2load('academic_board','<?php echo $board_id[$tenth_schooling_id]; ?>','<?php echo $board_name[$tenth_schooling_id]; ?>');
		
		select2load('academic_marking_scheme','<?php echo $marking_scheme_id[$tenth_schooling_id]; ?>','<?php echo $marking_scheme_name[$tenth_schooling_id]; ?>');	
		
		// Twelfth Academic Detail Select2Load
		select2load('academic_twelfth_board','<?php echo $board_id[$twelfth_schooling_id]; ?>','<?php echo $board_name[$twelfth_schooling_id]; ?>');

		select2load('academic_marking_scheme_twelfth','<?php echo $marking_scheme_id[$twelfth_schooling_id]; ?>','<?php echo $marking_scheme_name[$twelfth_schooling_id]; ?>');
		
		select2load('academic_graduation_board','<?php echo $applicant_graduations_list[0]['univ_id']; ?>','<?php echo $applicant_graduations_list[0]['univ_name']; ?>');
		
		select2load('academic_pg_graduation_board','<?php echo $noaqdata['univ_id']; ?>','<?php echo $noaqdata['univ_name']; ?>');
		
		select2load('academic_marking_scheme_graduation','<?php echo $applicant_graduations_list[0]['mark_scheme_id']; ?>','<?php echo $applicant_graduations_list[0]['mark_scheme_name']; ?>');
		
		select2load('academic_marking_scheme_pg_graduation','<?php echo $noaqdata['mark_scheme_id']; ?>','<?php echo $noaqdata['mark_scheme_name']; ?>');

		// Parent Detail Select2Load
		
		select2load('pd_father_title','<?php echo $applicant_parent_details_list[0]['title_id']; ?>','<?php echo $applicant_parent_details_list[0]['title_name']; ?>');
		
		select2load('pd_father_phone_no_code','<?php echo $applicant_parent_details_list[0]['mob_country_code_id']; ?>','<?php echo $applicant_parent_details_list[0]['country_mob_code']; ?>');

		select2load('pd_father_alt_phone_no_code','<?php echo $applicant_parent_details_list[0]['alt_mob_countrycode_id']; ?>','<?php echo $applicant_parent_details_list[0]['alt_mob_country_code']; ?>');	
		
		select2load('pd_mother_title','<?php echo $applicant_parent_details_list[1]['title_id']; ?>','<?php echo $applicant_parent_details_list[1]['title_name']; ?>');	

		select2load('pd_mother_phone_no_code','<?php echo $applicant_parent_details_list[1]['mob_country_code_id']; ?>','<?php echo $applicant_parent_details_list[1]['country_mob_code']; ?>');
		
		select2load('pd_mother_alt_phone_no_code','<?php echo $applicant_parent_details_list[1]['alt_mob_countrycode_id']; ?>','<?php echo $applicant_parent_details_list[1]['alt_mob_country_code']; ?>');		
		
		select2load('pd_guardian_phone_no_code','<?php echo $applicant_parent_details_list[2]['mob_country_code_id']; ?>','<?php echo $applicant_parent_details_list[2]['country_mob_code']; ?>');		
		
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
		
		// Check Resident TN
		// $("#indian").hide();
		$("#guidelines").hide();
		$("#current_resident_tn").change(function () {
			if ($("#current_resident_tn").val() == "yes") {
				//$("#indian").show();
				$("#guidelines").hide();
				$('.actions ul li:nth-child(2)').removeClass('disabled')
				$('.actions ul li:nth-child(2) a').css('pointer-events','auto');
			}
			else {
				//$("#indian").hide();
				$("#guidelines").show();
				$('.actions ul li:nth-child(2)').addClass('disabled');
				$('.actions ul li:nth-child(2) a').css('pointer-events','none');
			}
		});
		
		// Show other input board
		$('.academic_board').on('change',function() {
			var academic_board = $("#academic_board").val();
			console.log("academic_board "+academic_board);
			
			if(academic_board==26){
				$("#ob_tenth").show();
			}else{
				$("#ob_tenth").hide();
				$('#other_board_tenth').val('');
			} 
		}); 

		$('.academic_twelfth_board').on('change',function() {
			var academic_twelfth_board = $("#academic_twelfth_board").val();
			console.log("academic_board "+academic_board);
			
			if(academic_twelfth_board==26){
				$("#ob_twelfth").show();
			}else{
				$("#ob_twelfth").hide();
				$('#other_board_twelfth').val('');
			} 
		});
		
		$('#academic_graduation_board').on('change',function() {
			var academic_graduation_board = $("#academic_graduation_board").val();
			console.log("academic_graduation_board "+academic_graduation_board);
			
			if(academic_graduation_board==36){
				$("#ob_graduation").show();
			}else{
				$("#ob_graduation").hide();
				$('#other_board_graduation').val('');
			} 
		});		
		
		$('#academic_pg_graduation_board').on('change',function() {
			var academic_pg_graduation_board = $("#academic_pg_graduation_board").val();
			console.log("academic_pg_graduation_board "+academic_pg_graduation_board);
			
			if(academic_pg_graduation_board==36){
				$("#ob_pg_graduation").show();
			}else{
				$("#ob_pg_graduation").hide();
				//$('#other_board_pg_graduation').val('');
			} 
		});
		// Occupation Parent Select2Load
		
		<?php if($applicant_parent_details_list[0]) { ?>
			select2loadParentOccupation('pd_father_occupation','<?php echo $applicant_parent_details_list[0]['occupation_id']; ?>');
		<?php } ?>
		
		<?php if($applicant_parent_details_list[1]) { ?>
			select2loadParentOccupation('pd_mother_occupation','<?php echo $applicant_parent_details_list[1]['occupation_id']; ?>');
		<?php } ?>
		
		<?php if($applicant_parent_details_list[2]) { ?>
			select2loadParentOccupation('pd_guardian_occupation','<?php echo $applicant_parent_details_list[2]['occupation_id']; ?>');	
		<?php } ?>
		
		<?php
		  if($upload_scripts) {
			foreach($upload_scripts as $k=>$v) {
			  echo $v."\n";
			}
		  }
		?>	
		
		// Alternate Email & Father,Mother,Guardian Email Suggestion Goes Here
		email_suggestion("pd_alt_email","suggestion_alt_email");
		email_suggestion("pd_father_email","suggestion_father_email");
		email_suggestion("pd_mother_email","suggestion_mother_email");
		email_suggestion("pd_guardian_email","suggestion_guardian_email");
		

		onkeyValidationp('academic_pg_graduation_inst','academic_pg_graduation_board','academic_marking_scheme_pg_graduation','academic_obtain_cgpa_pg_graduation','academic_yr_passing_pg_graduation','academic_reg_no_pg_graduation');
		onkeyValidationp('academic_pg_graduation_board','academic_pg_graduation_inst','academic_marking_scheme_pg_graduation','academic_obtain_cgpa_pg_graduation','academic_yr_passing_pg_graduation','academic_reg_no_pg_graduation');
		onkeyValidationp('academic_marking_scheme_pg_graduation','academic_pg_graduation_inst','academic_pg_graduation_board','academic_obtain_cgpa_pg_graduation','academic_yr_passing_pg_graduation','academic_reg_no_pg_graduation');
		onkeyValidationp('academic_obtain_cgpa_pg_graduation','academic_pg_graduation_inst','academic_pg_graduation_board','academic_marking_scheme_pg_graduation','academic_yr_passing_pg_graduation','academic_reg_no_pg_graduation');
		onkeyValidationp('academic_yr_passing_pg_graduation','academic_pg_graduation_inst','academic_pg_graduation_board','academic_marking_scheme_pg_graduation','academic_obtain_cgpa_pg_graduation','academic_reg_no_pg_graduation');
		onkeyValidationp('academic_reg_no_pg_graduation','academic_pg_graduation_inst','academic_pg_graduation_board','academic_marking_scheme_pg_graduation','academic_obtain_cgpa_pg_graduation','academic_yr_passing_pg_graduation');
		
		onkeyValidationadditionalQualification('name_of_the_program_0','program_cy_0');
		onkeyValidationadditionalQualification('name_of_the_program_1','program_cy_1');
		onkeyValidationadditionalQualification('name_of_the_program_2','program_cy_2');
		onkeyValidationadditionalQualification('program_cy_0','name_of_the_program_0');
		onkeyValidationadditionalQualification('program_cy_1','name_of_the_program_1');
		onkeyValidationadditionalQualification('program_cy_2','name_of_the_program_2');		
	});
});

function upload_file(file_doc_type, upload_type) {
	upload_type = upload_type || false;

	var parsley_required = $('#'+file_doc_type).attr('data-parsley-required');
	var max_file_size = $('#'+file_doc_type).attr('data-parsley-max-file-size');
	var max_file_size_js = $('#'+file_doc_type).attr('data-max-file-size-js');
	var file_extension = $('#'+file_doc_type).attr('data-parsley-file-extension');
	// Get Regenerated CSRF Dynamically
	var csrfHashRegenerate = $("input[name='"+csrfName+"']").val();
	
	var id = $('#'+file_doc_type).attr('data-file-id');
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
		var parsley_required = $('#'+file_doc_type).attr('data-parsley-required','false');
		
		if($('#main_graduation_sheets').is(':visible')){
			if(file_doc_type=='graduation_marksheet'){
				var parsley_required = $('#'+file_doc_type).attr('data-parsley-required','false');
			}
		}
		if($('#main_pg_graduation_sheets').is(':visible')){
			if(file_doc_type=='graduation_marksheet'){
				var parsley_required = $('#'+file_doc_type).attr('data-parsley-required','false');
			}
			if(file_doc_type=='post_graduation_marksheet'){
				var parsley_required = $('#'+file_doc_type).attr('data-parsley-required','false');
			}		
		}				
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
	if($('#main_graduation_sheets').is(':visible')){
		if(doc_id=='<?php echo $document_id_graduation_marksheet; ?>'){
			var required = true;
		}
	}	
	if($('#main_pg_graduation_sheets').is(':visible')){
		if(doc_id=='<?php echo $document_id_graduation_marksheet; ?>'){
			var required = true;
		}
		if(doc_id=='<?php echo $document_id_post_graduation_marksheet; ?>'){
			var required = true;
		}		
	}		
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
</script>