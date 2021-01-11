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

$applicant_appln_details_list_qual = $applicant_appln_details_list[0]['qual_status_id'];

if($applicant_appln_details_list_qual==1){
	$applicant_appln_details_list_qual = 1;
}else{
	$applicant_appln_details_list_qual = 2;
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
/*
$document_id_graduation_marksheet = DOCUMENT_ID_GRADUATION_MARKSHEET;
$document_id_post_graduation_marksheet = DOCUMENT_ID_POST_GRADUATION_MARKSHEET;
*/

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
  		$file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_tenth_marksheet == $document_id)?'tenth_marksheet':'')));
  		$parsley_required = (($document_id_photograph == $document_id)?'true':(($document_id_signature == $document_id)?'true':(($document_id_tenth_marksheet == $document_id)?'true':'')));
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

if($mode_edit == '') //Admin Means No restriction start
{
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
} //Admin Means No restriction end
/*Form Index Restriction End*/

if($applicant_course_prefer_details_list) {
   foreach($applicant_course_prefer_details_list as $k=>$v) {
      $applicant_course_id = $v['applicant_course_id'];
      $applicant_course_course_id = $v['branch_id'];
      $applicant_course_course_name = $v['course_name'];
      $applicant_course_choice_no = $v['choice_no'];
      $applicant_course_is_active = $v['is_active'];
      $applicant_deg_id = $v['deg_id'];
      $applicant_deg_short_name = $v['deg_short_name'];
   }
}

?>
<script>
/*CRM ADMIN Edit form start*/
var crm_applicant_personal_det_id = '<?php echo $crm_applicant_personal_det_id ; ?>';
var crm_applicant_login_id = '<?php echo $crm_applicant_login_id ; ?>';
var mode_edit_val = '<?php echo ADMIN_MODE_EDIT ; ?>';
var mode_edit_url = '<?php echo $mode_edit; ?>';
<?php if($mode_edit) { ?>
  var url_edit = '&mode=edit'+'&applicant_personal_det_id='+crm_applicant_personal_det_id+'&applicant_login_id='+crm_applicant_login_id;
  var url = "<?php echo base_url(); ?>tamilperayam/"+mode_edit_val+"/"+crm_applicant_login_id+"/"+crm_applicant_personal_det_id;
  var payment_url = '<?php echo base_url(); ?>user/payment_details?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;
  var save_exit_redirect_url = '<?php echo base_url(); ?>crm-admin/dashboard';
  //var upload_url = '<?php echo base_url(); ?>upload-file?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;     
<?php } else { ?>
  var url_edit =  '';
  var url = "<?php echo base_url(); ?>tamilperayam";
  var payment_url = '<?php echo base_url(); ?>user/payment_details';
   var save_exit_redirect_url = '<?php echo base_url(); ?>';
   //var upload_url = "<?php echo base_url(); ?>upload-file";
<?php } ?>
/*CRM ADMIN Edit form end*/

var country_value_default 	   = '<?php echo COUNTRY_VALUE_DEFAULT; ?>';
var logged_applicant_id   	   = '<?php echo $logged_applicant_id; ?>';
var logged_applicant_login_id  = '<?php echo $logged_applicant_login_id; ?>';
var app_form_id 			   = '<?php echo APP_FORM_ID_TAMIL_PERAYAM; ?>';
var redirect 				   = '<?php echo base_url()."thank_you"; ?>?app_form_id='+app_form_id;
var get_percentage_url 		   = '<?php echo base_url(); ?>user/get_percentage_w_tab?app_form_id='+app_form_id+url_edit;
var pg_diploma_grad 		   = '<?php echo PG_DIPLOMA_GRAD; ?>';
var redirect_payment_thank_you = '<?php echo base_url(); ?>user/payment_thank_you?app_form_id='+app_form_id+'&url='+encodeURIComponent(url);
var curIndex				   = '<?php echo $startIndex;?>';
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
			if(mode_edit_url !='')
	        {
	          enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>tamilperayam_form_preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
	        }else{
			enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>tamilperayam_form_preview');
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
				var isexit = ($(this).attr('isexit'));
				// Step 1 form validation
				if(currentIndex === 0) {
					
					//'pd_course_preference='+pd_course_preference_val+'&pd_campus='+pd_campus_val+
					
					
					var tamilparayram_degree_id = $('#tamilperayam_degree_list').parsley();
					var tamil_course_preference = $('#tamil_course_preference').parsley();
					
					//check_visible_input_validation('main_resident_status','resident_status','Please Choose Resident Status',false);
					
					if(tamilparayram_degree_id.isValid() && tamil_course_preference.isValid()) {
						var tamilperayam_degree_list_val = $('#tamilperayam_degree_list').val();
						var tamil_course_preference_val = $('#tamil_course_preference').val();
						var course_choice_no_1 = $('#course_choice_no_1').val();
						var course_prefer_id_1 = $('#course_prefer_id_1').val();
						var degree_prefer_id_1 = $('#degree_prefer_id_1').val();
						var appln_status = $('#appln_status').val();
						var user_data = 'tamilperayam_degree_list='+tamilperayam_degree_list_val+'&tamil_course_preference='+tamil_course_preference_val+'&course_prefer_id_1='+course_prefer_id_1+'&course_choice_no_1='+course_choice_no_1+'&'+csrfName+'='+csrfHash+'&appln_status='+appln_status;
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
									if(returndata) {
										if(isexit==1){
			                                  window.location.href = save_exit_redirect_url;
			                                  return false;
			                            }else{
										var startIndex = currentIndex+1
										window.location.href = url+'?startIndex='+startIndex;
										$("#formerr").hide();
										moveNxt=1;
			                            }
									}									
								}								
							},
							error: function(returndata) {
								moveNxt=0;
								$("#formerr").show(); 							  
								return false; 
							},
						});
						if(moveNxt){
							return true;
						}
					}else{
						tamilparayram_degree_id.validate();
						tamil_course_preference.validate();
						return false;
					}
				} 
				
				// Step 2 form validation
				if(currentIndex === 1) {
					//alert(currentIndex);
					var pd_course_preference 	 = $('#pd_course_preference').parsley();
					var pd_campus 		     	 = $('#pd_campus').parsley();
					var pd_title             	 = $('#pd_title').parsley();
					var pd_firstname 		 	 = $('#pd_firstname').parsley();
					var pd_middlename 		 	 = $('#pd_middlename').parsley();
					var pd_lastname 		 	 = $('#pd_lastname').parsley();
					var pd_mobile_no 		 	 = $('#pd_mobile_no').parsley();
					var pd_email 			 	 = $('#pd_email').parsley();
					var pd_dob 				 	 = $('#pd_dob').parsley();
					var pd_gender 			 	 = $('#pd_gender').parsley();
					var pd_alt_email 		 	 = $('#pd_alt_email').parsley();
					var pd_blood_group 		 	 = $('#pd_blood_group').parsley();
					var pd_religion 		 	 = $('#pd_religion').parsley();
					var pd_mother_tongue 	 	 = $('#pd_mother_tongue').parsley();
					var pd_medium_of_instruction = $('#pd_medium_of_instruction').parsley();
					var pd_hostel_accommodation  = $('#pd_hostel_accommodation').parsley();
					var pd_diffrently_abled      = $('#pd_diffrently_abled').parsley();
					var pd_advertisement_source  = $('#pd_advertisement_source').parsley();
					var pd_nationality 			 = $('#pd_nationality').parsley();
					var pd_social_status         = $('#pd_social_status').parsley();
					
					// Make Validation false
					if($('#pd_lastname').val()=='.'){
						$('#pd_lastname').removeAttr('data-parsley-nameonly', 'true');
						$('#pd_lastname').removeAttr('data-parsley-nameonly-message', '<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');
					}					
					
					check_visible_input_validation('apg_course','pd_course_preference','<?php echo REQD_CHOOSE_COURSE_MSG; ?>',false);
					
					check_visible_input_validation('main_div_social_status','pd_social_status','<?php echo REQD_SOCIAL_STATUS_MSG; ?>',false);
					
					//pd_course_preference.isValid() && pd_campus.isValid() && 
					if(pd_title.isValid() && pd_firstname.isValid() && pd_middlename.isValid() && pd_lastname.isValid() && pd_mobile_no.isValid() && pd_email.isValid() && pd_dob.isValid() && pd_gender.isValid() && pd_alt_email.isValid() && pd_blood_group.isValid() && pd_diffrently_abled.isValid() && pd_nationality.isValid() && pd_social_status.isValid())
					{
						//var pd_course_preference_val	 = $('#pd_course_preference').val();
						//var pd_campus_val	 			 = $('#pd_campus').val();
						var pd_title_val				 = $('#pd_title').val();
						var pd_firstname_val			 = $('#pd_firstname').val();
						var pd_middlename_val			 = $('#pd_middlename').val();
						var pd_lastname_val				 = $('#pd_lastname').val();
						var pd_mobile_no_code_val		 = $('#phone_no_code').val();
						var pd_mobile_no_val			 = $('#pd_mobile_no').val();
						var pd_email_val				 = $('#pd_email').val();
						var pd_dob_val					 = $('#pd_dob').val();
						var pd_gender_val				 = $('#pd_gender').val();
						var pd_alt_email_val			 = $('#pd_alt_email').val();
						var pd_blood_group_val			 = $('#pd_blood_group').val();
						var pd_religion_val				 = $('#pd_religion').val();
						var pd_mother_tongue_val		 = $('#pd_mother_tongue').val();
						var pd_medium_of_instruction_val = $('#pd_medium_of_instruction').val();
						var pd_hostel_accommodation_val  = $('#pd_hostel_accommodation').val();
						var pd_advertisement_source_val  = $('#pd_advertisement_source').val();
						var pd_diffrently_abled_val 	 = $('#pd_diffrently_abled').val();
						var pd_nationality_val			 = $('#pd_nationality').val();
						var pd_social_status_val		 = $('#pd_social_status').val();
						
						// Set Applicant Name
						// $("#applicant_name").val(pd_firstname_val);
						<?php if(empty($applicant_name) || $applicant_name=="")  { ?>
							$("#applicant_name").val(pd_firstname_val);
						<?php } ?>		
						//'pd_course_preference='+pd_course_preference_val+'&pd_campus='+pd_campus_val+
						var user_data = 'pd_title='+pd_title_val+'&pd_firstname='+pd_firstname_val+'&pd_middlename='+pd_middlename_val+'&pd_lastname='+pd_lastname_val+'&phone_no_code='+pd_mobile_no_code_val+'&pd_mobile_no='+pd_mobile_no_val+'&pd_email='+pd_email_val+'&pd_dob='+pd_dob_val+'&pd_gender='+pd_gender_val+'&pd_alt_email='+pd_alt_email_val+'&pd_mother_tongue='+pd_mother_tongue_val+'&pd_medium_of_instruction='+pd_medium_of_instruction_val+'&pd_hostel_accommodation='+pd_hostel_accommodation_val+'&pd_advertisement_source='+pd_advertisement_source_val+'&pd_diffrently_abled='+pd_diffrently_abled_val+'&pd_nationality='+pd_nationality_val+'&pd_social_status='+pd_social_status_val+'&pd_blood_group='+pd_blood_group_val+'&pd_religion='+pd_religion_val+'&'+csrfName+'='+csrfHash;
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
									if(isexit==1){
		                                  window.location.href = save_exit_redirect_url;
		                                  return false;
		                            }else{									
										var startIndex = currentIndex+1
										window.location.href = url+'?startIndex='+startIndex; 
										$("#formerr").hide();
										moveNxt=1;
		                            }
																
								}
							},
							error: function(returndata) {
							  moveNxt=0;
							  $("#formerr").show(); 							  
							  return false;
							},
						});
						if(moveNxt){
							return true;
						}
					}else{
						//pd_course_preference.validate();
						//pd_campus.validate();
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
					//alert(currentIndex);
					var pd_father_title 	    = $('#pd_father_title').parsley();
					var pd_father_name  		= $('#pd_father_name').parsley();
					var pd_father_email 		= $('#pd_father_email').parsley();
					var pd_father_phone 		= $('#pd_father_phone').parsley();
					var pd_alt_father_phone 	= $('#pd_alt_father_phone').parsley();
					var pd_mother_title 		= $('#pd_mother_title').parsley();
					var pd_mother_name 			= $('#pd_mother_name').parsley();
					var pd_mother_phone 		= $('#pd_mother_phone').parsley();
					var pd_alt_mother_phone 	= $('#pd_alt_mother_phone').parsley();
					var pd_mother_email 		= $('#pd_mother_email').parsley();
					var pd_guardian_name 		= $('#pd_guardian_name').parsley();
					var pd_guardian_phone 		= $('#pd_guardian_phone').parsley();
					var pd_guardian_email 		= $('#pd_guardian_email').parsley();
					var pd_guardian_occupation  = $('#pd_guardian_occupation').parsley();
					var other_occupation_guardian = $('#other_occupation_guardian').parsley();
					var other_occupation_father = $('#other_occupation_father').parsley();
					var other_occupation_mother = $('#other_occupation_mother').parsley();
					
					check_visible_input_validation('guardian_details','pd_guardian_name','<?php echo REQD_GUARDIAN_NAME_MSG; ?>',true,'<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');
					
					check_visible_input_validation('guardian_details','pd_guardian_phone','<?php echo REQD_GUARDIAN_MOBILE_MSG; ?>',false);
					
					check_visible_input_validation('guardian_details','pd_guardian_email','<?php echo REQD_GUARDIAN_EMAIL_MSG; ?>',false);
					
					check_visible_input_validation('guardian_details','pd_guardian_occupation','<?php echo REQD_GUARDIAN_OCCUPATION_MSG; ?>',false);
					
					check_visible_input_validation('other_occupation_guardian_div','other_occupation_guardian','<?php echo REQD_GUARDIAN_OTHER_OCCUPATION_MSG; ?>',true,'<?php echo REQD_ALPHA_ONLY_MSG; ?>');
					
					check_visible_input_nameonly_validation('other_occupation_father_div','other_occupation_father','<?php echo REQD_ALPHA_ONLY_MSG; ?>');
					
					check_visible_input_nameonly_validation('other_occupation_mother_div','other_occupation_mother','<?php echo REQD_ALPHA_ONLY_MSG; ?>');
					
					check_visible_input_validation('main_div_state','state','<?php echo REQD_STATE_MSG; ?>',false);
					
					check_visible_input_validation('main_div_district','district','<?php echo REQD_DISTRICT_MSG; ?>',false);
					
					check_visible_input_validation('main_div_city','city','<?php echo REQD_CITY_MSG; ?>',false);
					
					if(pd_father_title.isValid() && pd_father_name.isValid() && pd_mother_title.isValid() && pd_mother_name.isValid() && pd_father_email.isValid() && pd_mother_email.isValid() && pd_guardian_name.isValid() && pd_guardian_phone.isValid() && pd_guardian_email.isValid() && pd_father_phone.isValid() && pd_mother_phone.isValid() && pd_alt_father_phone.isValid() && pd_alt_mother_phone.isValid() && pd_guardian_occupation.isValid() && other_occupation_guardian.isValid() && other_occupation_father.isValid() && other_occupation_mother.isValid()) {
							var pd_father_id 			= $('#pd_father_id').val();
					  		var pd_father_title 		= $('#pd_father_title').val();
							var pd_father_name 			= $('#pd_father_name').val();
							var pd_father_phone_no_code = $('#pd_father_phone_no_code').val();
							var pd_father_phone 		= $('#pd_father_phone').val();
							var pd_father_alt_phone_no_code = $('#pd_father_alt_phone_no_code').val();
							var pd_father_alt_phone 	= $('#pd_alt_father_phone').val();
							var pd_father_email 		= $('#pd_father_email').val();
							var pd_father_occupation 	= $('#pd_father_occupation').val();
							var pd_mother_id 			= $('#pd_mother_id').val();
							var pd_mother_title 		= $('#pd_mother_title').val();
							var pd_mother_name 			= $('#pd_mother_name').val();
							var pd_mother_phone_no_code = $('#pd_mother_phone_no_code').val();
							var pd_mother_phone 		= $('#pd_mother_phone').val();
							var pd_mother_alt_phone_no_code = $('#pd_mother_alt_phone_no_code').val();
							var pd_mother_alt_phone 	= $('#pd_alt_mother_phone').val();
							var pd_mother_email 		= $('#pd_mother_email').val();
							var pd_mother_occupation 	= $('#pd_mother_occupation').val();
							var add_guardian_checkbox   = $('#add_guardian_checkbox').val();
							var pd_guardian_id 			= $('#pd_guardian_id').val();
							var pd_guardian_name 		= $('#pd_guardian_name').val();
							var pd_guardian_phone_no_code = $('#pd_guardian_phone_no_code').val();
							var pd_guardian_alt_phone_no_code = $('#pd_guardian_alt_phone_no_code').val();
							var pd_guardian_phone 		= $('#pd_guardian_phone').val();
							var pd_guardian_alt_phone 	= $('#pd_guardian_alt_phone').val();
							var pd_guardian_email 		= $('#pd_guardian_email').val();
							var pd_guardian_occupation  = $('#pd_guardian_occupation').val();
							
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
							// $("#parent_name").val(pd_father_name);
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
								beforeSend: function() { $('.loader').show(); },	
								success: function(returndata) {
									if(returndata) {									
										if(isexit==1){
			                                  window.location.href = save_exit_redirect_url;
			                                  return false;
			                            }else{
										var startIndex = currentIndex+1
										window.location.href = url+'?startIndex='+startIndex; 
										$("#formerr").hide();
										moveNxt=1;
			                            }
									}									
								},
								error: function(returndata) {
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
				  
				  if(country.isValid() && state.isValid() && district.isValid() 
				  	&& city.isValid() && address1.isValid() && pincode.isValid()) {
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
								if(returndata) {
									if(isexit==1){
		                                  window.location.href = save_exit_redirect_url;
		                                  return false;
		                            }else{
									var startIndex = currentIndex+1
									window.location.href = url+'?startIndex='+startIndex; 
									$("#formerr").hide();
									moveNxt=1;	
		                            }
								}									
							}
						},
						error: function(returndata) {
							moveNxt=0;
							 
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
					
					var candidate_name 				= $('#candidate_name').parsley();
					var academic_tenth_inst 		= $('#academic_tenth_inst').parsley();
					var academic_board 				= $('#academic_board').parsley();
					var academic_marking_scheme 	= $('#academic_marking_scheme').parsley();
					var academic_obtain_cgpa 		= $('#academic_obtain_cgpa').parsley();
					var academic_yr_passing 		= $('#academic_yr_passing').parsley();
					var academic_reg_no 			= $('#academic_reg_no').parsley();
					var academic_board_other 		= $('#other_board_tenth').parsley();
					
					
					check_visible_input_validation('ob_tenth','other_board_tenth','<?php echo REQD_OTHER_BOARD_MSG; ?>',true,'<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');
					
					
					if(candidate_name.isValid() && academic_tenth_inst.isValid() && academic_board.isValid() &&  academic_marking_scheme.isValid() && academic_obtain_cgpa.isValid() && academic_yr_passing.isValid() && academic_reg_no.isValid() && academic_board_other.isValid()){
						
						
						var candidate_name_val 			= $('#candidate_name').val();
						var academic_tenth_inst_val 	= $('#academic_tenth_inst').val();
						var academic_board_val 			= $('#academic_board').val();
						var academic_marking_scheme_val = $('#academic_marking_scheme').val();
						var academic_obtain_cgpa_val 	= $('#academic_obtain_cgpa').val();
						var academic_yr_passing_val 	= $('#academic_yr_passing').val();
						var academic_reg_no_val 		= $('#academic_reg_no').val();
						var academic_board_other_val 	= $('#other_board_tenth').val();
						
						var digilocker_val 					 = $('#nad_id_digilocker_id').val();
						
						var user_data = 'candidate_name='+candidate_name_val+'&academic_tenth_inst='+academic_tenth_inst_val+'&academic_tenth_board='+academic_board_val+'&academic_tenth_msv='+academic_marking_scheme_val+'&academic_tenth_cgpa='+academic_obtain_cgpa_val+'&academic_tenth_yrp='+academic_yr_passing_val+'&academic_tenth_regno='+academic_reg_no_val+'&digilocker_id='+digilocker_val+'&academic_board_other='+academic_board_other_val+'&'+csrfName+'='+csrfHash;
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
									if(returndata) {
										if(isexit==1){
			                                  window.location.href = save_exit_redirect_url;
			                                  return false;
			                            }else{
										var startIndex = currentIndex+1
										window.location.href = url+'?startIndex='+startIndex; 
										$("#formerr").hide();
										moveNxt=1;	
			                            }
									}									
								}
							},
							error: function(returndata) {
								moveNxt=0;
								$("#formerr").show(); 							  
								return false;
							},	
						});							
						if(moveNxt){
							return true;
						}
					}else{
						//appering.validate();
						//completed.validate();						
						candidate_name.validate();
						academic_tenth_inst.validate();
						academic_board.validate();
						academic_marking_scheme.validate();
						academic_obtain_cgpa.validate();
						academic_yr_passing.validate();
						academic_reg_no.validate();
						academic_board_other.validate();						
						
						return false; 						
					}
				}
				
				// Academic Details End
				
				// Payment Start
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
				if(mode_edit_url !='')
		        {
		         	enable_preview_btn(currentIndex,'<?php echo base_url();?>tamilperayam_form_preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
		        }else{
				enable_preview_btn(currentIndex,'<?php echo base_url();?>tamilperayam_form_preview');
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
			var tenth_marksheet = $('#tenth_marksheet').parsley();
			
			<?php if($applicant_appln_details_list_qual==1){ ?>
				$('#graduation_marksheet').attr('data-parsley-required','false');
			<?php } ?>		
			// Get Regenerated CSRF Dynamically
			var csrfHashRegenerateonDec = $("input[name='"+csrfName+"']").val();
			
			if(photograph.isValid() && signature.isValid() && tenth_marksheet.isValid() && applicant_name.isValid() && parent_name.isValid()) {
				var applicant_name = $('#applicant_name').val();
				var parent_name = $('#parent_name').val();
				var ddate = $('#ddate').val();
				var user_data = 'applicant_name='+applicant_name+'&parent_name='+parent_name+'&ddate='+ddate+'&currentIndex='+currentIndex+'&'+csrfName+'='+csrfHashRegenerateonDec;		
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
					  if(returndata){
						  $("#formerr").hide();
						  moveNxt=1;
					  }
					},
					error: function(returndata) {
						moveNxt=0;
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
				tenth_marksheet.validate();
				return false;
			}		
			return true;
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
	
	$("#tamil_form").steps(settings);
	//setsave exit attr	
    $(document).on("click", "#save_btn" , function() {
    	 $("#tamil_form").attr('isexit',1);
         $("#tamil_form").steps('next');
    });
    
    $('.actions a').click(function(){        	 
      $("#tamil_form").attr('isexit','');
    }); 
//end set attr
	//to remove links from previous tabs a
    <?php if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) && ($mode_edit == '')) { ?>
     $( ".steps li" ).each(function( index ) { 
      if(index<6){       	 
   	  $("#tamil_form-t-"+index).removeAttr("href");
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
		
		var no_study_resident_in_msg = "Sorry, Studied Resident not available.";
		var no_resident_status_msg = "Sorry,  Resident status/category not available.";
		var no_gender_title_msg = "Sorry, Gender Title not available.";
		var no_mobile_code_msg = "Sorry, Mobile code not available.";
		var no_gender_msg = "Sorry, Gender not available.";
		var no_blood_group_msg = "Sorry, Blood Group not available.";
		var no_religions_msg = "Sorry, Religion not available.";
		var no_mother_tongues_msg = "Sorry, Mother Tongue not available.";
		var no_medium_of_instruction_msg = "Sorry, Medium Of Instruction not available.";
		var no_hostel_accommodation_msg = "Sorry, Hostel Accommodation not available.";
		var no_differently_abled_msg = "Sorry, Differently Abled not available.";
		var no_advertisement_source_msg = "Sorry, Advertisement Source not available.";
		var no_nationality_msg = "Sorry, Nationality not available.";
		var no_social_status_msg = "Sorry, Social Status not available.";
		var no_title_msg = "Sorry, Title not available.";
		var no_occupation_msg = "Sorry, Occupation not available.";
		var no_country_msg = "Sorry, Country not available.";
		var no_state_msg = "Sorry, State not available.";
		var no_city_msg = "Sorry, City not available.";
		var no_district_msg = "Sorry, District not available.";
		var no_board_msg = "Sorry, Board not available";
		var no_user_marking_scheme_msg = "Sorry, Marking Scheme not available.";
		var no_yop_status = 'Sorry, Year of passing not available.';
		var no_campus_msg = 'Sorry, Campus not available';
		var no_course_msg = 'Sorry, Course not available';
		var no_university_status = 'Sorry, University not available.';
		var no_banks_msg = "Sorry, Banks not available.";
		var no_degree_msg = 'Sorry, Degree not available';
		
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
		
		
		// Degree based Course Preferences Load
		var tamil_degree_id = $('#tamilperayam_degree_list').val();
		var no_course_msg   = "No Course";
		

		getSelect2('tamilperayam_degree_list','<?php echo base_url("get_tamilperayam_degree_list"); ?>+url_edit','Choose', formatRepoCommon,no_degree_msg, false, formatRepoSelection);
		
		
		//course_preference
		
		$('#tamilperayam_degree_list').on('change',function() {
			setEmptyOnChangeSelect2('tamil_course_preference'); 
			// when no values return in json, add empty option value 
			if ($('#tamil_course_preference').data('select2')) {$('#tamil_course_preference').select2('destroy');}
			// make empty
			$('#tamil_course_preference').html('');			
			$("#tamil_course").show();
			var tamilperayam_degree_list = $(this).val();
			var grad_mode_id = 1;
			if(tamilperayam_degree_list == 43)
			{
				grad_mode_id = 2;
			}
				
			getSelect2('tamil_course_preference','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_course=1&is_distinct=1&grad_mode_id='+grad_mode_id+'&form_id='+app_form_id+'&deg_id='+tamilperayam_degree_list+'&sort_by=name&sort_order=asc'+url_edit,'Choose Course Perferences 1', formatRepoCommon,no_course_msg, false, formatRepoSelection);
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
		
		$("#DDDate").datepicker({
			format:"dd/mm/yyyy" , autoclose: !0, todayHighlight: true,todaybtn:true,endDate: todaydate }).on('changeDate', function(e) {$("#DDDate").parsley().validate();
		});

		// Basic Details Tab 1
		
		// Basic Detail Select2Load
		<?php if(!empty($applicant_appln_details_list[0]['qualifyingexamfromindia']=='t')) { ?>
			var value = 'yes';	
		<?php }elseif($applicant_appln_details_list[0]['qualifyingexamfromindia']=='f')  {  ?>
			var value = 'no';	
		<?php } ?>
	
		//select2loadbyMatch('studied_in_india',value,false);
		
		// Get the Tamil Perayam degree detail
		var no_tamilperayam_degree_msg = "No Degree Found";
		getSelect2('tamilperayam_degree_list','<?php echo base_url("get_tamilperayam_degree_list"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Degree', formatRepoCommon,no_tamilperayam_degree_msg, false, formatRepoSelection);
		
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
				$('#td_graduation_ms').show();
				$('#td_graduation_cgpa').show();
				$('#td_graduation_yop').show();
				$('#td_graduation_reg_no').show();
				$('#academic_marking_scheme_graduation').html('');
				$('#academic_obtain_cgpa_graduation').val('');
				$('#academic_yr_passing_graduation').val('');
				$('#academic_reg_no_graduation').val('');
			} else {
				$('#td_graduation_ms').hide();
				$('#td_graduation_cgpa').hide();
				$('#td_graduation_yop').hide();
				$('#td_graduation_reg_no').hide();
			}
		});	
		<?php 
		
		?>
		$('#appering').on('change',function(){
			if($(this).is(':checked')) {
				$('#td_graduation_ms').hide();
				$('#td_graduation_cgpa').hide();
				$('#td_graduation_yop').hide();
				$('#td_graduation_reg_no').hide();
			}
		});			
		
		<?php
			if($applicant_appln_details_list[0]['qual_status_id']==1){
				$current_education_qual_status = 'a';
			}else{
				$current_education_qual_status = 'c';
			}
		?>
		var current_education_qual_status = '<?php echo $current_education_qual_status; ?>';
		if(current_education_qual_status=="c"){
			$('#td_graduation_ms').show();
			$('#td_graduation_cgpa').show();
			$('#td_graduation_yop').show();
			$('#td_graduation_reg_no').show();
		}else if(current_education_qual_status=="a"){
			$('#td_graduation_ms').hide();
			$('#td_graduation_cgpa').hide();
			$('#td_graduation_yop').hide();
			$('#td_graduation_reg_no').hide();			
		}
		
		// Check if the user is non resident 
		// Basic Details Tab 1
		$('#resident_status').on('change',function(){
			var resident_status = $(this).val();
			if(resident_status) {
				$('.actions ul li:nth-child(2) a').css('pointer-events','none');
				$('.actions ul li:nth-child(2)').addClass('disabled');
				$('#custom-resident_status-parsley-error').css('color','#ff0000');
				$('#custom-resident_status-parsley-error').text('Cannot Proceed. Please read instruction below.');
			}
		});
		
		// Parent Other Occupation Enable	
		parent_other_occupation_enable('pd_father_occupation','other_occupation_father_div',7,true,'other_occupation_father');
		parent_other_occupation_enable('pd_mother_occupation','other_occupation_mother_div',7,true,'other_occupation_mother');
		parent_other_occupation_enable('pd_guardian_occupation','other_occupation_guardian_div',7,true,'other_occupation_guardian');
		
		validate_cgpa('academic_marking_scheme','academic_obtain_cgpa');
		//validate_cgpa('academic_marking_scheme_twelfth','academic_obtain_cgpa_twelfth');
		//validate_cgpa('academic_marking_scheme_graduation','academic_obtain_cgpa_graduation');
		//validate_cgpa('academic_marking_scheme_pg_graduation','academic_obtain_cgpa_pg_graduation');
		
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

		select2load('tamilperayam_degree_list','<?php echo $applicant_deg_id; ?>','<?php echo $applicant_deg_short_name ?>');

		select2load('tamil_course_preference','<?php echo $applicant_course_course_id; ?>','<?php echo $applicant_course_course_name ?>');

		
		// Address Detail Select2Load
		select2load('country','<?php echo $country_id[0]; ?>','<?php echo $country_name[0]; ?>');
		select2load('state','<?php echo $state_id[0]; ?>','<?php echo $state_name[0]; ?>');
		select2load('district','<?php echo $district_id[0]; ?>','<?php echo $district_name[0]; ?>');
		select2load('city','<?php echo $city_id[0]; ?>','<?php echo $city_name[0]; ?>');	
		
		// Tenth Academic Detail Select2Load
		select2load('academic_board','<?php echo $board_id[$tenth_schooling_id]; ?>','<?php echo $board_name[$tenth_schooling_id]; ?>');
		
		select2load('academic_marking_scheme','<?php echo $marking_scheme_id[$tenth_schooling_id]; ?>','<?php echo $marking_scheme_name[$tenth_schooling_id]; ?>');	
		
		
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
		
		/*		onkeyValidationp('academic_pg_graduation_inst','academic_pg_graduation_board','academic_marking_scheme_pg_graduation','academic_obtain_cgpa_pg_graduation','academic_yr_passing_pg_graduation','academic_reg_no_pg_graduation');
		onkeyValidationp('academic_pg_graduation_board','academic_pg_graduation_inst','academic_marking_scheme_pg_graduation','academic_obtain_cgpa_pg_graduation','academic_yr_passing_pg_graduation','academic_reg_no_pg_graduation');
		onkeyValidationp('academic_marking_scheme_pg_graduation','academic_pg_graduation_inst','academic_pg_graduation_board','academic_obtain_cgpa_pg_graduation','academic_yr_passing_pg_graduation','academic_reg_no_pg_graduation');
		onkeyValidationp('academic_obtain_cgpa_pg_graduation','academic_pg_graduation_inst','academic_pg_graduation_board','academic_marking_scheme_pg_graduation','academic_yr_passing_pg_graduation','academic_reg_no_pg_graduation');
		onkeyValidationp('academic_yr_passing_pg_graduation','academic_pg_graduation_inst','academic_pg_graduation_board','academic_marking_scheme_pg_graduation','academic_obtain_cgpa_pg_graduation','academic_reg_no_pg_graduation');
		onkeyValidationp('academic_reg_no_pg_graduation','academic_pg_graduation_inst','academic_pg_graduation_board','academic_marking_scheme_pg_graduation','academic_obtain_cgpa_pg_graduation','academic_yr_passing_pg_graduation');
		*/
	});
});

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
	if(typeof $('#'+file_doc_type).attr('data-file-count') != 'undefined') {
		$($('#'+file_doc_type)[0].files).each(function(k,v) {
			formData.append(file_doc_type+'[]', v);     
		});
	} else {
		formData.append(file_doc_type, $('#'+file_doc_type)[0].files[0]); 
	}
	if(mode_edit_url !='')
	  {
	    formData.append('mode',mode_edit_val);
	    formData.append('applicant_personal_det_id',crm_applicant_personal_det_id);
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
	if(doc_id=="<?php echo DOCUMENT_ID_GRADUATION_MARKSHEET; ?>" || doc_id=="<?php echo DOCUMENT_ID_POST_GRADUATION_MARKSHEET; ?>"){
		required=false;
	}
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
		  
		},
	});                 

	return AjaxRequest; 
}
</script>