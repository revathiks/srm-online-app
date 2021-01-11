<?php 
$parent_type_id_father = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
$country_value_default = COUNTRY_VALUE_DEFAULT;

$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_tenth_marksheet = DOCUMENT_ID_TENTH_MARKSHEET;
$document_id_twelvfth_marksheet = DOCUMENT_ID_TWELVFTH_MARKSHEET;
$document_id_provsional_certicate = DOCUMENT_ID_PROVISIONAL_CERTICATE;
$document_id_graduation_marksheet = DOCUMENT_ID_GRADUATION_MARKSHEET;


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
      $applicant_parent_title_id[$parent_type_id] = $v['title_id'];
      $applicant_parent_title_name[$parent_type_id] = $v['title_name'];
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
  		$file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_tenth_marksheet == $document_id)?'tenth_marksheet':(($document_id_twelvfth_marksheet == $document_id)?'twelvfth_marksheet':(($document_id_provsional_certicate == $document_id)?'provisional_certificate':(($document_id_graduation_marksheet == $document_id)?'graduation_marksheet':''))))));
  		$parsley_required = (($document_id_photograph == $document_id)?'true':(($document_id_signature == $document_id)?'true':(($document_id_tenth_marksheet == $document_id)?'true':(($document_id_twelvfth_marksheet == $document_id)?'true':(($document_id_provsional_certicate == $document_id)?'true':(($document_id_graduation_marksheet == $document_id)?'true':''))))));
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
$check_provisional_certificate_uploaded = $docs[$document_id_provsional_certicate];

$docs['file_count'] = $file_count;
$applicant_name=isset($applicant_appln_details_list['applicant_name_declaration'])?$applicant_appln_details_list['applicant_name_declaration']:'';
$parent_name=isset($applicant_appln_details_list['applicant_parentname_declaration'])?$applicant_appln_details_list['applicant_parentname_declaration']:'';
$current_wizard=$applicant_appln_details_list['wizard_id'];
$payment_mode_id = $payment_details_list['payment_mode_id'];
$startIndex = $this->input->get('startIndex',true);
//restrict previous section
$is_allow_previous=$this->config->item('is_allow_previous');

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
	if($start_wizard_next >=0)
	{
		$start_wizard_next_allow = $start_wizard_next + 1;
	}

	if($next_step_allowed !="" && $current_wizard<FORM_WIZARD_PAYMENT_ID)
	{
		$startIndex = $next_step_allowed;
	}
	else if($startIndex <= $start_wizard_next && $start_wizard_next >=0 && $current_wizard<FORM_WIZARD_PAYMENT_ID)
	{
		$startIndex = $startIndex;
	}
	else if($startIndex == $start_wizard_next_allow && $start_wizard_next >=0 && $current_wizard<FORM_WIZARD_PAYMENT_ID)
	{
		$startIndex = $startIndex;
	}
	else if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0)) {
			$startIndex=6; //upload and declaration
	}
	else if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==1) && $startIndex <= $start_wizard_next_allow) {
			$startIndex = $startIndex;
	}
	else
	{
		$startIndex = 0;
	}
}
$grad_id=$applicant_application_details_list[0]['grad_id'];
$ug=UG_GRAD;
$grad_id=!empty($grad_id) ? $grad_id :'';

?>
<script>
var country_value_default = '<?php echo COUNTRY_VALUE_DEFAULT; ?>';
var logged_applicant_id = '<?php echo $logged_applicant_id; ?>';
var logged_applicant_login_id = '<?php echo $logged_applicant_login_id; ?>';
var app_form_id = '<?php echo APP_FORM_ID_DE_JAN; ?>';
var tmp_app_form_id='<?php echo APP_FORM_ID_DE; ?>';
var payment_wizard_id = '<?php echo FORM_WIZARD_PAYMENT_ID; ?>';	
/*CRM ADMIN Edit form start*/
var crm_applicant_personal_det_id = '<?php echo $crm_applicant_personal_det_id ; ?>';
var crm_applicant_login_id = '<?php echo $crm_applicant_login_id ; ?>';
var mode_edit_val = '<?php echo ADMIN_MODE_EDIT ; ?>';
var mode_edit_url = '<?php echo $mode_edit; ?>';

<?php if($mode_edit) { ?>
   var url_edit = '&mode=edit'+'&applicant_personal_det_id='+crm_applicant_personal_det_id+'&applicant_login_id='+crm_applicant_login_id;
   var url = "<?php echo base_url(); ?>dis-education-jan/"+mode_edit_val+"/"+crm_applicant_login_id+"/"+crm_applicant_personal_det_id;
   var payment_url = '<?php echo base_url(); ?>user/payment_details?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;
   var save_exit_redirect_url = '<?php echo base_url(); ?>crm-admin/dashboard';
<?php } else { ?>
   var url_edit = '&applicant_personal_det_id='+logged_applicant_id+'&applicant_login_id='+logged_applicant_login_id;
   var url = "<?php echo base_url(); ?>dis-education-jan";
   var payment_url = '<?php echo base_url(); ?>user/payment_details';
   var save_exit_redirect_url = '<?php echo base_url(); ?>';
<?php } ?>
/*CRM ADMIN Edit form end*/

var redirect = '<?php echo base_url()."thank_you"; ?>?app_form_id='+app_form_id;
var get_percentage_url = '<?php echo base_url(); ?>/user/get_percentage_w_tab?app_form_id='+app_form_id+url_edit;
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
				enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>dde_jan_form_preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
			}else{			
				enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>dde_jan_form_preview');
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
        enableContentCache: false,
        enableCancelButton: false,
        enableFinishButton: true,
        preloadContent: true,
        showFinishButtonAlways: false,
        forceMoveForward: false,
        saveState: true,
        startIndex:<?php echo ($startIndex)?$startIndex:0; ?>,
        /* Transition Effects */
        transitionEffect: 'slide', 
        transitionEffectSpeed: 200,		
		/* Events */
        onStepChanging: function (event, currentIndex, newIndex) { 
			if(currentIndex < newIndex) {
				// Step 1 form validation
				 if(currentIndex === 0) {
					var current_resident_tn = $('#current_resident_tn').parsley();
					if(current_resident_tn.isValid()) {
						var current_resident_tn = $('#current_resident_tn').val();
						var appln_status = $('#appln_status').val();
						var user_data = 'current_resident_tn='+current_resident_tn+'&'+csrfName+'='+csrfHash+'&appln_status='+appln_status;
						var moveNxt=0;
						$.ajax({
							type: 'POST',
							url: url,
							data: user_data+'&currentIndex='+currentIndex,
							dataType: 'json',
							cache: false,
							async: false,
							beforeSend: function() { $('.loader').show(); },					success: function(returndata) {
								if(returndata) {									
									console.log(returndata);
									if(returndata.status == 'true') {
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
						current_resident_tn.validate();
						return false;						
					}
				} 
				
				// Step 2 form validation
				if(currentIndex === 1) {
					var pd_program = $('#pd_program').parsley();
					var pd_course = $('#pd_course').parsley();
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
					var pd_social_status = $('#pd_social_status').parsley();
					var pd_aadhaar_no = $('#pd_aadhaar_no').parsley();
					var pd_diffrently_abled = $('#pd_diffrently_abled').parsley();
					var pd_nature_deformity = $('#pd_nature_deformity').parsley();
					var pd_percent_of_deformity = $('#pd_percent_of_deformity').parsley();
					var pd_nationality = $('#pd_nationality').parsley();
					
					// Make Validation false
					if($('#pd_lastname').val()=='.'){
						$('#pd_lastname').removeAttr('data-parsley-nameonly', 'true');
						$('#pd_lastname').removeAttr('data-parsley-nameonly-message', 'Name must be alphabetic only.');
					}
					
					if($('#pd_nationality').val()!=country_value_default){
						$('#pd_aadhaar_no').attr('data-parsley-required', 'false');
					}
					
					check_visible_input_validation('main_div_course','pd_course','<?php echo REQD_CHOOSE_COURSE_MSG; ?>',false);
					
					check_visible_input_validation('main_div_ndeformity','pd_nature_deformity','<?php echo REQD_NATURE_DEFORMITY_MSG; ?>',false);	
					
					check_visible_input_validation('main_div_pdeformity','pd_percent_of_deformity','<?php echo REQD_PERCENT_NATURE_DEFORMITY_MSG; ?>',false);
						
					check_visible_input_validation('main_div_social_status','pd_social_status','<?php echo REQD_SOCIAL_STATUS_MSG; ?>',false);
					
					if(pd_program.isValid() && pd_course.isValid() && pd_title.isValid() && pd_firstname.isValid() && pd_middlename.isValid() && pd_lastname.isValid() && pd_mobile_no.isValid() && pd_email.isValid() && pd_dob.isValid() && pd_gender.isValid() && pd_alt_email.isValid() && pd_social_status.isValid() && pd_aadhaar_no.isValid() && pd_diffrently_abled.isValid() && pd_nature_deformity.isValid() && pd_percent_of_deformity.isValid() && pd_nationality.isValid()) {
					var pd_program_val = $('#pd_program').val();
					var pd_course_val = $('#pd_course').val();
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
					var pd_aadhaar_no_val = $('#pd_aadhaar_no').val();
					var pd_social_status_val = $('#pd_social_status').val();
					var pd_diffrently_abled_val = $('#pd_diffrently_abled').val();
					var pd_nature_deformity_val = $('#pd_nature_deformity').val();
					var pd_percent_of_deformity_val = $('#pd_percent_of_deformity').val();
					var pd_eco_weaker_val = $('#pd_economically_weaker').val();
					var pd_nationality_val = $('#pd_nationality').val();
									
					// Set Applicant Name
					<?php if(empty($applicant_name) || $applicant_name=="")  { ?>
						$("#applicant_name").val(pd_firstname_val);
					<?php } ?>	
					
					var user_data = 'pd_program='+pd_program_val+'&pd_course='+pd_course_val+'&pd_campus='+pd_campus_val+'&pd_title='+pd_title_val+'&pd_firstname='+pd_firstname_val+'&pd_middlename='+pd_middlename_val+'&pd_lastname='+pd_lastname_val+'&phone_no_code='+pd_mobile_no_code_val+'&pd_mobile_no='+pd_mobile_no_val+'&pd_email='+pd_email_val+'&pd_dob='+pd_dob_val+'&pd_gender='+pd_gender_val+'&pd_alt_email='+pd_alt_email_val+'&pd_blood_group='+pd_blood_group_val+'&pd_aadhaar_no='+pd_aadhaar_no_val+'&pd_social_status='+pd_social_status_val+'&pd_diffrently_abled='+pd_diffrently_abled_val+'&pd_nature_deformity='+pd_nature_deformity_val+'&pd_percent_of_deformity='+pd_percent_of_deformity_val+'&pd_eco_weaker_val='+pd_eco_weaker_val+'&pd_nationality='+pd_nationality_val+'&'+csrfName+'='+csrfHash;
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
									if(returndata.status == 'true') {
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
						pd_program.validate();
						pd_course.validate();
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
						pd_social_status.validate();
						pd_aadhaar_no.validate();
						pd_diffrently_abled.validate();
						pd_nature_deformity.validate();
						pd_percent_of_deformity.validate();
						pd_nationality.validate();
						return false;						
					}					
				}
				
				// Step 3 form validation
				if(currentIndex === 2) {
					var pd_father_title = $('#pd_father_title').parsley();
					var pd_father_name = $('#pd_father_name').parsley();
					var pd_father_email = $('#pd_father_email').parsley();
					var pd_father_phone = $('#pd_father_phone').parsley();
					var pd_mother_title = $('#pd_mother_title').parsley();
					var pd_mother_name = $('#pd_mother_name').parsley();
					var pd_mother_phone = $('#pd_mother_phone').parsley();
					var pd_mother_email = $('#pd_mother_email').parsley();
					var pd_guardian_name = $('#pd_guardian_name').parsley();
					var pd_guardian_phone = $('#pd_guardian_phone').parsley();
					var pd_guardian_email = $('#pd_guardian_email').parsley();
					var other_occupation_guardian = $('#other_occupation_guardian').parsley();
					var other_occupation_father = $('#other_occupation_father').parsley();
					var other_occupation_mother = $('#other_occupation_mother').parsley();
					
					check_visible_input_validation('other_occupation_guardian_div','other_occupation_guardian','<?php echo REQD_GUARDIAN_OTHER_OCCUPATION_MSG; ?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');
					
					check_visible_input_nameonly_validation('other_occupation_father_div','other_occupation_father','<?php echo REQD_ALPHA_ONLY_MSG;?>');
					
					check_visible_input_nameonly_validation('other_occupation_mother_div','other_occupation_mother','<?php echo REQD_ALPHA_ONLY_MSG;?>');

					
					if(pd_father_title.isValid() && pd_father_name.isValid() && pd_mother_title.isValid() && pd_mother_name.isValid() && pd_father_email.isValid() && pd_mother_email.isValid() && pd_guardian_name.isValid() && pd_guardian_phone.isValid() && pd_guardian_email.isValid() && pd_father_phone.isValid() && pd_mother_phone.isValid() && other_occupation_guardian.isValid() && other_occupation_father.isValid() && other_occupation_mother.isValid()){
					var pd_father_title = $('#pd_father_title').val();
					var pd_father_name = $('#pd_father_name').val();
					var pd_father_phone_no_code = $('#pd_father_phone_no_code').val();
					var pd_father_phone = $('#pd_father_phone').val();
					var pd_father_email = $('#pd_father_email').val();
					var pd_father_occupation = $('#pd_father_occupation').val();
					var pd_mother_title = $('#pd_mother_title').val();
					var pd_mother_name = $('#pd_mother_name').val();
					var pd_mother_phone_no_code = $('#pd_mother_phone_no_code').val();
					var pd_mother_phone = $('#pd_mother_phone').val();
					var pd_mother_email = $('#pd_mother_email').val();
					var pd_mother_occupation = $('#pd_mother_occupation').val();
					var add_guardian_checkbox = $('#add_guardian_checkbox').val();
					var pd_guardian_name = $('#pd_guardian_name').val();
					var pd_guardian_phone_no_code = $('#pd_guardian_phone_no_code').val();
					var pd_guardian_phone = $('#pd_guardian_phone').val();
					var pd_guardian_email = $('#pd_guardian_email').val();
					var pd_guardian_occupation = $('#pd_guardian_occupation').val();
					var other_occupation_father = $('#other_occupation_father').val();
					var other_occupation_mother = $('#other_occupation_mother').val();
					var other_occupation_guardian = $('#other_occupation_guardian').val();	
					
					// Unique Validation
					if(pd_guardian_phone!=''){
						if(pd_mother_phone==pd_guardian_phone || pd_father_phone==pd_guardian_phone){
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
					
					// Set Father Name at Declaration
					<?php if(empty($parent_name) || $parent_name=="")  { ?>
						$("#parent_name").val(pd_father_name);
					<?php } ?>
					
					var user_data = 'pd_father_title='+pd_father_title+'&pd_father_name='+pd_father_name+'&pd_father_phone_no_code='+pd_father_phone_no_code+'&pd_father_phone='+pd_father_phone+'&pd_father_email='+pd_father_email+'&pd_father_occupation='+pd_father_occupation+'&pd_mother_title='+pd_mother_title+'&pd_mother_name='+pd_mother_name+'&pd_mother_phone_no_code='+pd_mother_phone_no_code+'&pd_mother_email='+pd_mother_email+'&pd_mother_occupation='+pd_mother_occupation+'&add_guardian_checkbox='+add_guardian_checkbox+'&pd_guardian_name='+pd_guardian_name+'&pd_guardian_phone_no_code='+pd_guardian_phone_no_code+'&pd_guardian_phone='+pd_guardian_phone+'&pd_guardian_email='+pd_guardian_email+'&pd_guardian_occupation='+pd_guardian_occupation+'&pd_mother_phone='+pd_mother_phone+'&other_occupation_father='+other_occupation_father+'&other_occupation_mother='+other_occupation_mother+'&other_occupation_guardian='+other_occupation_guardian+'&'+csrfName+'='+csrfHash;
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
									if(returndata.status == 'true' || returndata.status == '3') {
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
						other_occupation_guardian.validate();
						other_occupation_father.validate();
						other_occupation_mother.validate();						
						return false;						
					}
				}
				
				// Step 4 form validation
				if(currentIndex === 3) {
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
								if(returndata.status == 'true') {
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
					country_phd.validate();
					state_phd.validate();
					district_phd.validate();
					city_phd.validate();
					address1.validate();
					pincode.validate();
					return false;
				  }
				}
				
				// Academic Details
				if(currentIndex === 4) {
				  //return true;
				  var candidate_name = $('#candidate_name').parsley();
				  var current_qualification_status = $('#current_qualification_status').parsley();
				  var academic_tenth_inst = $('#academic_tenth_inst').parsley();
				  var academic_board = $('#academic_board').parsley();
				  var academic_mode_of_study = $('#academic_mode_of_study').parsley();
				  var academic_marking_scheme = $('#academic_marking_scheme').parsley();
				  var academic_obtain_cgpa = $('#academic_obtain_cgpa').parsley();
				  var academic_yr_passing = $('#academic_yr_passing').parsley();
				  var academic_reg_no = $('#academic_reg_no').parsley();
				  var academic_board_other = $('#other_board_tenth').parsley();
				  
				  
					  var academic_twelfth_inst = $('#academic_twelfth_inst').parsley();
					  var academic_twelfth_board = $('#academic_twelfth_board').parsley();
					  var academic_mode_of_study_twelfth = $('#academic_mode_of_study_twelfth').parsley();
					  var academic_marking_scheme_twelfth = $('#academic_marking_scheme_twelfth').parsley();
					  var academic_obtain_cgpa_twelfth = $('#academic_obtain_cgpa_twelfth').parsley();
					  var academic_yr_passing_twelfth = $('#academic_yr_passing_twelfth').parsley();
					  var academic_reg_no_twelfth = $('#academic_reg_no_twelfth').parsley();
					  var academic_stream = $('#academic_stream').parsley();
					  var academic_twelfth_board_other = $('#other_board_twelfth').parsley();
					  
					  var academic_graduation_inst = $('#academic_graduation_inst').parsley();
					  var academic_graduation_university = $('#academic_graduation_university').parsley();
					  var academic_marking_scheme_graduation = $('#academic_marking_scheme_graduation').parsley();
					  var academic_obtain_cgpa_graduation = $('#academic_obtain_cgpa_graduation').parsley();
					  var academic_yr_passing_graduation = $('#academic_yr_passing_graduation').parsley();
					  var academic_reg_no_graduation = $('#academic_reg_no_graduation').parsley();
					  var graduation_degree = $('#graduation_degree').parsley();
					  var academic_graduation_board_other = $('#other_univ_grad').parsley();
					  
					    var organisation_name_0_0 = $('#organisation_name_0').parsley();
					    var designation_0_0 = $('#designation_0').parsley();
					    var nature_of_job_0_0 = $('#nature_of_job_0').parsley();
					    var total_salary_month_0_0 = $('#total_salary_month_0').parsley();
					    var total_salary_month_1_1 = $('#total_salary_month_1').parsley();
					    var total_salary_month_2_2 = $('#total_salary_month_2').parsley();
					    var from_year_0_0 = $('#from_year_0').parsley();
					    var to_year_0_0 = $('#to_year_0').parsley();
					    var work_experience_0_0 = $('#work_experience_0').parsley();	
					    var other_stream_name = $('#other_stream_name').parsley();
						var organisation_name_1 = $('#organisation_name_1').parsley();
						var designation_1 = $('#designation_1').parsley();
						var nature_of_job_1 = $('#nature_of_job_1').parsley();
						var from_year_1 = $('#from_year_1').parsley();
						var to_year_1 = $('#to_year_1').parsley();
						var work_experience_1 = $('#work_experience_1').parsley();		
						var organisation_name_2 = $('#organisation_name_2').parsley();
						var designation_2 = $('#designation_2').parsley();
						var nature_of_job_2 = $('#nature_of_job_2').parsley();
						var from_year_2 = $('#from_year_2').parsley();
						var to_year_2 = $('#to_year_2').parsley();
						var work_experience_2 = $('#work_experience_2').parsley();							
				  
					check_visible_input_validation('dde_graduation_details','academic_graduation_inst','<?php echo REQD_INSTITUTE_NAME_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');
					
					check_visible_input_validation('dde_graduation_details','academic_graduation_university','<?php echo REQD_UNIVERSITY_MSG;?>',false);
					
					check_visible_input_validation('dde_graduation_details','academic_marking_scheme_graduation','<?php echo REQD_MARK_SCHEME_MSG;?>',false);
					
					check_visible_input_validation('dde_graduation_details','academic_obtain_cgpa_graduation','<?php echo REQD_PERCENT_CGPA_MSG;?>',false);
					
					check_visible_input_validation('dde_graduation_details','academic_yr_passing_graduation','<?php echo REQD_YEAR_OF_PASSING_MSG;?>',false);
					
					check_visible_input_validation('dde_graduation_details','academic_reg_no_graduation','<?php echo REQD_REG_NO_MSG;?>',false);
					
					check_visible_input_validation('dde_graduation_details','graduation_degree','<?php echo REQD_CHOOSE_DEGREE_MSG;?>',false);	
					
					check_visible_input_validation('ob_tenth','other_board_tenth','<?php echo REQD_OTHER_BOARD_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');
					
					check_visible_input_validation('ob_twelfth','other_board_twelfth','<?php echo REQD_OTHER_BOARD_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');
					
					check_visible_input_validation('obstream','other_stream_name','<?php echo REQD_OTHER_STREAM_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');
					
					check_visible_input_validation('obstream','other_stream_name','<?php echo REQD_OTHER_STREAM_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');
					
					check_visible_input_validation('ob_univ','other_univ_grad','<?php echo REQD_OTHER_UNIVERSITY_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');
					
					check_visible_input_validation('pro_exp','organisation_name_0','<?php echo REQD_ORG_NAME_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');
					
					check_visible_input_validation('pro_exp','designation_0','<?php echo REQD_DESIGNATION_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');
					
					check_visible_input_validation('pro_exp','nature_of_job_0','<?php echo REQD_NATURE_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');
					
					check_visible_input_validation('pro_exp','nature_of_job_0','<?php echo REQD_NATURE_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');
					
					check_visible_input_validation('pro_exp','total_salary_month_0','<?php echo REQD_TOT_SALARY_MSG;?>',false);	
					
					check_visible_input_validation('pro_exp','from_year_0','<?php echo REQD_FROM_YEAR_MSG;?>',false);	
					
					check_visible_input_validation('pro_exp','to_year_0','<?php echo REQD_TO_YEAR_MSG;?>',false);
					
					check_visible_input_validation('pro_exp','work_experience_0','<?php echo REQD_WORK_EXP_MSG;?>',false);					
				  
				  if(current_qualification_status.isValid() && candidate_name.isValid() && academic_tenth_inst.isValid() && academic_board.isValid() && academic_mode_of_study.isValid() && academic_marking_scheme.isValid() && academic_obtain_cgpa.isValid() && academic_yr_passing.isValid() && academic_reg_no.isValid() && academic_twelfth_inst.isValid() && academic_twelfth_board.isValid() && academic_mode_of_study_twelfth.isValid() && academic_marking_scheme_twelfth.isValid() && academic_obtain_cgpa_twelfth.isValid() && academic_yr_passing_twelfth.isValid() && academic_reg_no_twelfth.isValid() && academic_graduation_inst.isValid() && academic_graduation_university.isValid() && academic_marking_scheme_graduation.isValid() && academic_obtain_cgpa_graduation.isValid() && academic_yr_passing_graduation.isValid() && academic_reg_no_graduation.isValid() && academic_stream.isValid() && graduation_degree.isValid() && academic_board_other.isValid() && academic_twelfth_board_other.isValid() && academic_graduation_board_other.isValid() && organisation_name_0_0.isValid() && designation_0_0.isValid() && nature_of_job_0_0.isValid() && total_salary_month_0_0.isValid() && total_salary_month_1_1.isValid() && total_salary_month_2_2.isValid() && from_year_0_0.isValid() && to_year_0_0.isValid() && work_experience_0_0.isValid() && other_stream_name.isValid() && organisation_name_1.isValid() && designation_1.isValid() && nature_of_job_1.isValid() && from_year_1.isValid() && to_year_1.isValid() && work_experience_1.isValid() && organisation_name_2.isValid() && designation_2.isValid() && nature_of_job_2.isValid() && from_year_2.isValid() && to_year_2.isValid() && work_experience_2.isValid()) {
						var current_qualification_status_val	= 	$('#current_qualification_status').val();
						var candidate_name_val 	= 	$('#candidate_name').val();
						var academic_tenth_inst_val 	= 	$('#academic_tenth_inst').val();
						var academic_board_val 	= 	$('#academic_board').val();
						var academic_mode_of_study_val = $('#academic_mode_of_study').val();
						var academic_marking_scheme_val = $('#academic_marking_scheme').val();
						var academic_obtain_cgpa_val = $('#academic_obtain_cgpa').val();
						var academic_yr_passing_val = $('#academic_yr_passing').val();
						var academic_reg_no_val = $('#academic_reg_no').val();
						var academic_board_other_val = $('#other_board_tenth').val();
						
						var academic_twelfth_inst_val 	= 	$('#academic_twelfth_inst').val();
						var academic_twelfth_board_val 	= 	$('#academic_twelfth_board').val();
						var academic_twelfth_mode_of_study_val = $('#academic_mode_of_study_twelfth').val();
						var academic_twelfth_marking_scheme_val = $('#academic_marking_scheme_twelfth').val();
						var academic_twelfth_obtain_cgpa_val = $('#academic_obtain_cgpa_twelfth').val();
						var academic_twelfth_yr_passing_val = $('#academic_yr_passing_twelfth').val();
						var academic_twelfth_reg_no_val = $('#academic_reg_no_twelfth').val();
						var academic_twelfth_stream_val = $('#academic_stream').val();
						var academic_twelfth_board_other_val = $('#other_board_twelfth').val();
						var other_stream_name = $('#other_stream_name').val();
						
						var academic_graduation_inst_val 	= 	$('#academic_graduation_inst').val();
						var academic_graduation_university_val 	= 	$('#academic_graduation_university').val();
						var academic_marking_scheme_graduation_val = $('#academic_marking_scheme_graduation').val();
						var academic_obtain_cgpa_graduation_val = $('#academic_obtain_cgpa_graduation').val();
						var academic_yr_passing_graduation_val = $('#academic_yr_passing_graduation').val();
						var academic_reg_no_graduation_val = $('#academic_reg_no_graduation').val();
						var graduation_degree_val = $('#graduation_degree').val();
						var other_univ_grad_val = $('#other_univ_grad').val();
						
						var part_lang_prefer_val = $('#part_lang_prefer').val();
						var learning_support_center_val = $('#learning_support_center').val();						
						
						if($('#is_work_experience_yes').is(':checked')){
							var is_work_experience = 'yes';
						}else if($('#is_work_experience_no').is(':checked')){
							var is_work_experience = 'no';
						}
						
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
						
						var user_data = 'current_qualification_status='+current_qualification_status_val+'&candidate_name='+candidate_name_val+'&academic_tenth_inst='+academic_tenth_inst_val+'&academic_tenth_board='+academic_board_val+'&academic_tenth_mos='+academic_mode_of_study_val+'&academic_tenth_msv='+academic_marking_scheme_val+'&academic_tenth_cgpa='+academic_obtain_cgpa_val+'&academic_tenth_yrp='+academic_yr_passing_val+'&academic_tenth_regno='+academic_reg_no_val+'&academic_twelfth_inst='+academic_twelfth_inst_val+'&academic_twelfth_board='+academic_twelfth_board_val+'&academic_twelfth_mos='+academic_twelfth_mode_of_study_val+'&academic_twelfth_msv='+academic_twelfth_marking_scheme_val+'&academic_twelfth_cgpa='+academic_twelfth_obtain_cgpa_val+'&academic_twelfth_yrp='+academic_twelfth_yr_passing_val+'&academic_twelfth_regno='+academic_twelfth_reg_no_val+'&academic_twelfth_stream='+academic_twelfth_stream_val+'&academic_graduation_inst='+academic_graduation_inst_val+'&academic_graduation_university='+academic_graduation_university_val+'&academic_marking_scheme_graduation='+academic_marking_scheme_graduation_val+'&academic_obtain_cgpa_graduation='+academic_obtain_cgpa_graduation_val+'&academic_yr_passing_graduation='+academic_yr_passing_graduation_val+'&academic_reg_no_graduation='+academic_reg_no_graduation_val+'&graduation_degree='+graduation_degree_val+'&academic_board_other='+academic_board_other_val+'&academic_twelfth_board_other='+academic_twelfth_board_other_val+'&academic_univ_other='+other_univ_grad_val+'&is_work_experience='+is_work_experience+'&prof_exp_id_0='+prof_exp_id_0+'&organisation_name_0='+organisation_name_0+'&designation_0='+designation_0+'&nature_of_job_0='+nature_of_job_0+'&total_salary_month_0='+total_salary_month_0+'&from_year_0='+from_year_0+'&to_year_0='+to_year_0+'&work_experience_0='+work_experience_0+'&prof_exp_id_1='+prof_exp_id_1+'&organisation_name_1='+organisation_name_1+'&designation_1='+designation_1+'&nature_of_job_1='+nature_of_job_1+'&total_salary_month_1='+total_salary_month_1+'&from_year_1='+from_year_1+'&to_year_1='+to_year_1+'&work_experience_1='+work_experience_1+'&prof_exp_id_2='+prof_exp_id_2+'&organisation_name_2='+organisation_name_2+'&designation_2='+designation_2+'&nature_of_job_2='+nature_of_job_2+'&total_salary_month_2='+total_salary_month_2+'&from_year_2='+from_year_2+'&to_year_2='+to_year_2+'&work_experience_2='+work_experience_2+'&total_work_experience='+total_work_experience+'&second_lang='+part_lang_prefer_val+'&learning_center='+learning_support_center_val+'&other_stream_name='+other_stream_name+'&'+csrfName+'='+csrfHash;
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
									if(returndata.status == 'true' || returndata.status == '5' || returndata.status == '3') {
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
						candidate_name.validate();
						current_qualification_status.validate();
						academic_tenth_inst.validate();
						academic_board.validate();
						academic_mode_of_study.validate();
						academic_marking_scheme.validate();
						academic_obtain_cgpa.validate();
						academic_yr_passing.validate();
						academic_reg_no.validate();
						academic_board_other.validate();
						
						academic_twelfth_inst.validate();
						academic_twelfth_board.validate();
						academic_mode_of_study_twelfth.validate();
						academic_marking_scheme_twelfth.validate();
						academic_obtain_cgpa_twelfth.validate();
						academic_yr_passing_twelfth.validate();
						academic_reg_no_twelfth.validate();
						academic_stream.validate();
						academic_twelfth_board_other.validate();
						other_stream_name.validate();
						
						academic_graduation_inst.validate();
						academic_graduation_university.validate();
						academic_marking_scheme_graduation.validate();
						academic_obtain_cgpa_graduation.validate();
						academic_yr_passing_graduation.validate();
						academic_reg_no_graduation.validate();
						graduation_degree.validate();
						academic_graduation_board_other.validate();
						
						organisation_name_0_0.validate();
						designation_0_0.validate();
						nature_of_job_0_0.validate();
						total_salary_month_0_0.validate();
						total_salary_month_1_1.validate();
						total_salary_month_2_2.validate();
						from_year_0_0.validate();
						to_year_0_0.validate();
						work_experience_0_0.validate();			
						organisation_name_1.validate();
						designation_1.validate();
						nature_of_job_1.validate();
						from_year_1.validate();
						to_year_1.validate();
						work_experience_1.validate();	
						organisation_name_2.validate();
						designation_2.validate();
						nature_of_job_2.validate();
						from_year_2.validate();
						to_year_2.validate();
						work_experience_2.validate();						
						return false;
					}
				}
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
					{	
						<?php if(empty($payment_details_list)) { ?>
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
					enable_preview_btn(currentIndex,'<?php echo base_url();?>dde_jan_form_preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
				}else{				
					enable_preview_btn(currentIndex,'<?php echo base_url();?>dde_jan_form_preview');
				}
			}else{
				$("#previewbtn").remove();
			}
		}, 
        onCanceled: function (event) { },
        onFinishing: function (event, currentIndex) {return true;}, 
        onFinished: function (event, currentIndex) { 
			var photograph = $('#photograph').parsley();
			var signature = $('#signature').parsley();
			var tenth_marksheet = $('#tenth_marksheet').parsley();
			var twelvfth_marksheet = $('#twelvfth_marksheet').parsley();
			var provisional_certificate = $('#provisional_certificate').parsley();
			var applicant_name = $('#applicant_name').parsley();
			var parent_name = $('#parent_name').parsley();
			var graduation_marksheet = $('#graduation_marksheet').parsley();

			if(photograph.isValid() && signature.isValid() && tenth_marksheet.isValid() && twelvfth_marksheet.isValid() && applicant_name.isValid() && parent_name.isValid() && provisional_certificate.isValid() && graduation_marksheet.isValid()) {
				var applicant_name = $('#applicant_name').val();
				var parent_name = $('#parent_name').val();
				var ddate = $('#ddate').val();
				// Get Regenerated CSRF Dynamically
				var csrfHashRegenerateonDec = $("input[name='"+csrfName+"']").val();
				//var currentIndex = 'final';
				var user_data = 'applicant_name='+applicant_name+'&parent_name='+parent_name+'&ddate='+ddate+'&currentIndex='+currentIndex+'&'+csrfName+'='+csrfHashRegenerateonDec;;		
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
						if(returndata) {									
							console.log(returndata);
							if(returndata.status == true || returndata.status == 'true' || returndata.status == '5' || returndata.status == '3' || returndata.status == '6') {
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
					setTimeout(function() { window.location.href = redirect+url_edit; }, 100);
					return true;
				}	
				       
			} else {
				photograph.validate();
				signature.validate();
				tenth_marksheet.validate();
				twelvfth_marksheet.validate();
				provisional_certificate.validate();
				applicant_name.validate();
				parent_name.validate();	
				graduation_marksheet.validate();
				return false;
			}		
			
            //return true;
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
	
	$("#dist_edu_jan_form").steps(settings);
	//setsave exit attr	
    $(document).on("click", "#save_btn" , function() {
    	 $("#dist_edu_jan_form").attr('isexit',1);
         $("#dist_edu_jan_form").steps('next');
    });
    
    $('.actions a').click(function(){        	 
      $("#dist_edu_jan_form").attr('isexit','');
    }); 
//end set attr
	//to remove links from previous tabs a
    <?php if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) && ($mode_edit == '')) { ?>
     $( ".steps li" ).each(function( index ) { 
      if(index<6){       	 
   	  $("#dist_edu_jan_form-t-"+index).removeAttr("href");
     }			   
   	});
    <?php } ?>
	light_box_init();
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
		
		var no_current_resident_tn_msg =  "<?php echo NO_STUDY_RESIDENT_IN_MSG; ?>";
		var no_program_msg = "<?php echo NO_PROGRAM_MSG; ?>";
		var no_campus_msg =  "<?php echo NO_CAMPUS_MSG; ?>";
		var no_gender_title_msg = "<?php echo NO_GENDER_TITLE_MSG; ?>";
		var no_gender_msg = "<?php echo NO_GENDER_MSG; ?>";
		var no_blood_group_msg = "<?php echo NO_BLOOD_GROUP_MSG; ?>";
		var no_social_status_msg = "<?php echo NO_SOCIAL_STATUS_MSG; ?>";
		var no_differently_abled_msg = "<?php echo NO_DIFFRENTLY_ABLED_MSG; ?>";
		var no_nature_deformity_msg = "<?php echo NO_ND_MSG; ?>";
		var no_percent_deformity_msg = "<?php echo NO_PD_MSG; ?>";
		var no_economically_weaker_section = "<?php echo NO_EWS_MSG; ?>";
		var no_mobile_code_msg = "<?php echo NO_MOBILE_CODE_MSG; ?>";
		var no_title_msg = "<?php echo NO_TITLE_MSG; ?>";
		var no_occupation_msg = "<?php echo NO_OCCUPATION_MSG; ?>";
		var no_country_msg = "<?php echo NO_COUNTRY_MSG; ?>";
		var no_state_msg =  "<?php echo NO_STATE_MSG; ?>";
		var no_city_msg =  "<?php echo NO_CITY_MSG; ?>";
		var no_board_msg = "<?php echo NO_BOARD_MSG; ?>";
		var no_mode_of_study =  "<?php echo NO_MODE_STUDY_MSG; ?>";
		var no_user_marking_scheme_msg =  "<?php echo NO_USER_MARKING_SCHEME_MSG; ?>";
		var no_current_qualification_status = '<?php echo NO_CURRENT_QUALIFICATION_STATUS; ?>';
		var no_university_status = '<?php echo NO_UNIVERSITY_MSG; ?>';
		var no_yop_status = '<?php echo NO_YOP_STATUS; ?>';
		var no_stream_msg = '<?php echo NO_STREAM_MSG; ?>';
		var no_degree_msg = '<?php echo NO_DEGREE_MSG; ?>';
		var no_mt_msg = '<?php echo NO_MOTHER_TONGUES_MSG; ?>';
		var no_support_center_msg = '<?php echo NO_SC_MSG; ?>';
		var no_course_msg = '<?php echo NO_COURSE_MSG; ?>';
		var no_nationality_msg = '<?php echo NO_NATIONALITY_MSG; ?>';
		var no_banks_msg = '<?php echo NO_BANKS_MSG; ?>';
		var no_district_msg = '<?php echo NO_DISTRICT_MSG; ?>';
		
		getSelect2('BankName','<?php echo base_url("get_banks"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Bank', formatRepoCommon,no_banks_msg, false, formatRepoSelection);
		
		getSelect2('part_lang_prefer','<?php echo base_url("get_mtechremothertong"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Mother Tongue', formatRepoCommon,no_mt_msg, false, formatRepoSelection);
		
		getSelect2('learning_support_center','<?php echo base_url("get_campuses"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Support Center', formatRepoCommon,no_support_center_msg, false, formatRepoSelection);

		getSelect2('graduation_degree','<?php echo base_url("get_qualifying_degree"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose', formatRepoCommon,no_degree_msg, false, formatRepoSelection);
		
		getSelect2('academic_stream','<?php echo base_url("get_streams"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose', formatRepoCommon,no_stream_msg, false, formatRepoSelection);		
		
		getSelect2('academic_graduation_university','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose', formatRepoCommon,no_university_status, false, formatRepoSelection);
		
		getSelect2('current_qualification_status','<?php echo base_url("get_current_qualification_status"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Current Qualification Status', formatRepoCommon,no_current_qualification_status, false, formatRepoSelection);		
			
		getSelect2('academic_board','<?php echo base_url("get_board"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose', formatRepoCommon,no_board_msg, false, formatRepoSelection);
		
		getSelect2('academic_mode_of_study','<?php echo base_url("get_mode_of_study"); ?>?is_lookup_master=1'+url_edit,'Choose', formatRepoCommon,no_mode_of_study, false, formatRepoSelection);
		
		getSelect2('academic_marking_scheme','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

		getSelect2('academic_twelfth_board','<?php echo base_url("get_board"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose', formatRepoCommon,no_board_msg, false, formatRepoSelection);
		
		getSelect2('academic_mode_of_study_twelfth','<?php echo base_url("get_mode_of_study"); ?>?is_lookup_master=1'+url_edit,'Choose', formatRepoCommon,no_mode_of_study, false, formatRepoSelection);
		
		getSelect2('academic_marking_scheme_twelfth','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
		
		getSelect2('academic_marking_scheme_graduation','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
		
		getSelect2('current_resident_tn','<?php echo base_url("get_current_resident"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Curent Resident', formatRepoCommon,no_current_resident_tn_msg, false, formatRepoSelection);

		getSelect2('pd_program','<?php echo base_url("course_preference"); ?>?is_lookup_master=1&is_program=1&form_id='+tmp_app_form_id+'&sort_by=name&sort_order=asc'+url_edit,'Select Program', formatRepoCommon,no_program_msg, false, formatRepoSelection);

		getSelect2('pd_title','<?php echo base_url("get_gender_title"); ?>?is_lookup_master=1'+url_edit,'Choose Gender Title', formatRepoCommon,no_gender_title_msg, false, formatRepoSelection);
		
		getSelect2('pd_gender','<?php echo base_url("get_gender"); ?>?is_lookup_master=1'+url_edit,'Choose Gender', formatRepoCommon,no_gender_msg, false, formatRepoSelection);
		
		getSelect2('pd_blood_group','<?php echo base_url("get_bloodgroups"); ?>?sort_by=blood_grp_id&sort_order=asc'+url_edit,'Choose Blood Groups', formatRepoCommon,no_blood_group_msg, false, formatRepoSelection);
		
		getSelect2('pd_social_status','<?php echo base_url("get_social_status"); ?>?is_lookup_master=1'+url_edit,'Choose Social Status', formatRepoCommon,no_social_status_msg, false, formatRepoSelection);
		
		getSelect2('pd_diffrently_abled','<?php echo base_url("get_are_you_differently_abled"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Differently Abled', formatRepoCommon,no_differently_abled_msg, false, formatRepoSelection);
		
		getSelect2('pd_economically_weaker','<?php echo base_url("get_eco_weaker_section"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Economically Weaker Section', formatRepoCommon,no_economically_weaker_section, false, formatRepoSelection);
			
		getSelect2('pd_nature_deformity','<?php echo base_url("get_nature_of_deformity"); ?>?is_lookup_master=1'+url_edit,'Choose Nature Of Deformity', formatRepoCommon,no_nature_deformity_msg, false, formatRepoSelection);
		
		getSelect2('pd_percent_of_deformity','<?php echo base_url("get_percentage_of_deformity"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Percentage Of Deformity', formatRepoCommon,no_percent_deformity_msg, false, formatRepoSelection);

		getSelect2('phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);

		getSelect2('pd_father_title','<?php echo base_url("get_parent_title"); ?>?is_lookup_master=1&is_father=1'+url_edit,'Choose Title', formatRepoCommon,no_title_msg, false, formatRepoSelection);
		
		getSelect2('pd_father_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);		
		
		getSelect2('pd_father_occupation','<?php echo base_url("parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Father Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);

		getSelect2('pd_mother_title','<?php echo base_url("get_mother_title"); ?>?is_lookup_master=1&is_mother=1'+url_edit,'Choose Title', formatRepoCommon,no_title_msg, false, formatRepoSelection);
		
		getSelect2('pd_mother_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>	?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
		
		getSelect2('pd_mother_occupation','<?php echo base_url("parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Mother Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);
		
		getSelect2('pd_guardian_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>	?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
		
		getSelect2('pd_guardian_occupation','<?php echo base_url("parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Mother Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);
		
		getSelect2('country_phd','<?php echo base_url("get_countries"); ?>?sort_by=country_id&sort_order=asc'+url_edit,'Choose Country', formatRepoCommon,no_country_msg, false, formatRepoSelection);	
		
		getSelect2('pd_nationality','<?php echo base_url("get_nationalities"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Nationality', formatRepoCommon,no_nationality_msg, false, formatRepoSelection);


		// Onchange country_phd
		$('#country_phd').on('change',function() {
			setEmptyOnChangeSelect2('state_phd'); 
			// when no values return in json, add empty option value 
			if ($('#state_phd').data('select2')) {$('#state_phd').select2('destroy');}
			// make empty
			$('#state_phd').html('');
			var country_phd_val = $(this).val();
			var url = '<?php echo base_url("get_states"); ?>?country_id='+country_phd_val+	'&sort_by=id&sort_order=asc'+url_edit;
			onchange_country('main_div_state','main_div_district','main_div_city','state_phd','city_phd','district_phd',url,no_state_msg,country_value_default,country_phd_val)
		});	
		
		// Onchange state_phd
		$('#state_phd').on('change',function() {
			setEmptyOnChangeSelect2('district_phd');
			// when no values return in json, add empty option value 
			if ($('#district_phd').data('select2')) {
				$('#district_phd').select2('destroy');
				// make empty
				$('#district_phd,#city_phd').html(''); 	
			}			
			
			var state_phd_val = $(this).val();
			var country_phd_val = $('#country_phd').val();
			var url = '<?php echo base_url("get_district"); ?>?state_id='+state_phd_val+'&sort_by=id&sort_order=asc'+url_edit;
			if(country_value_default==country_phd_val){	
				$('#main_div_district').show();
				getSelect2('district_phd',url,'Select district_phd', formatRepoCommon,no_district_msg, false, formatRepoSelection);
			}
		});			
	
		// Onchange district_phd
		$('#district_phd').on('change',function() {
			setEmptyOnChangeSelect2('city_phd');
			// when no values return in json, add empty option value 
			if ($('#city_phd').data('select2')) {$('#city_phd').select2('destroy');}			
			// make empty
			$('#city_phd').html(''); 			
			var state_phd_val = $('#state_phd').val();
			var country_phd_val = $('#country_phd').val();
			if(country_value_default==country_phd_val){	
				$('#main_div_city').show();
				getSelect2('city_phd','<?php echo base_url("get_cities"); ?>?state_id='+state_phd_val+'&sort_by=id&sort_order=asc'+url_edit,'Select city_phd', formatRepoCommon,no_city_msg, false, formatRepoSelection);
			}
		});				
		
		
		// Show Father & Mother Input
		show_parents_detail('pd_father_title','father_mbleno_div','father_email_div','father_occupation_div');
		
		show_parents_detail('pd_mother_title','mother_mbleno_div','mother_email_div','mother_occupation_div');
		
		$('#pd_father_title').on('change',function(){
			var late = $(this).val();
			if(late==276){
				$("#pd_father_phone").val('');
				$("#pd_father_alt_phone").val('');
			}
		});
		
		$('#pd_mother_title').on('change',function(){
			var late = $(this).val();
			if(late==276){
				$("#pd_mother_phone").val('');
				$("#pd_mother_alt_phone").val('');
			}
		});	
		
		// DOB Datepicker
		$("#pd_dob").datepicker( {
			format:"mm/dd/yyyy" ,autoclose: true,todayHighlight: true,endDate: endDob
		}).on('changeDate', function(e) {
				$("#pd_dob").parsley().validate();
		});

		$("#academic_yr_passing").datepicker( {
			format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy'),startDate: '-40y',endDate: '+0d' 
        }).on('changeDate', function(e) {
			$("#academic_yr_passing").parsley().validate();		
			var Yr=$("#academic_yr_passing").val();
			if(Yr!="" && Yr!="YYYY"){                
			var addYr=2;
			var setYr=parseInt(Yr)+addYr;
			 $("#academic_yr_passing_twelfth").attr("max",setYr);
			}			
		});	
		
		$("#academic_yr_passing_twelfth").datepicker( {
			format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy'),startDate: '-40y',endDate: '+0d' 
        }).on('changeDate', function(e) {
			$("#academic_yr_passing_twelfth").parsley().validate();		
			var Yr=$("#academic_yr_passing_twelfth").val();
			if(Yr!="" && Yr!="YYYY"){                
			var addYr=2;
			var setYr=parseInt(Yr)-addYr;
				$("#academic_yr_passing").attr("max",setYr);
			}			
		});	

		$("#academic_yr_passing_graduation").datepicker( {
			format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy'),startDate: '-40y',endDate: '+0d' 
        }).on('changeDate', function(e) {
			$("#academic_yr_passing_graduation").parsley().validate();	
		});	
		
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

		if($('#is_work_experience_yes').is(':checked')) {
			$('#pro_exp').show();
			$('#emp_total_exp').show();
			$('.hide_present').show();
		} else {
			$('#pro_exp').hide();
			$('#emp_total_exp').hide();
			$('.hide_present').hide();
		}
		
		$('#is_work_experience_no').on('change',function(){
			if($('#is_work_experience_no').is(':checked')) {
				$('#pro_exp').hide();
				$('#emp_total_exp').hide();
				$('.hide_present').hide();
			}else{
				$('#pro_exp').show();
				$('#emp_total_exp').show();
				$('.hide_present').show();
			}
		});	

		$('#is_work_experience_yes').on('change',function(){
			if($('#is_work_experience_yes').is(':checked')) {
				$('#pro_exp').show();
				$('#emp_total_exp').show();
				$('.hide_present').show();
			}else{
				$('#pro_exp').hide();
				$('#emp_total_exp').hide();
				$('.hide_present').hide();
			}
		});			
		
		$('#pd_diffrently_abled').on('change',function() {
			var pd_diffrently_abled = $("#pd_diffrently_abled").val();
			if(pd_diffrently_abled=='yes'){
				$("#main_div_pdeformity").show();
				$("#main_div_ndeformity").show();
			}else{					
				$("#main_div_pdeformity").hide();
				$("#main_div_ndeformity").hide();
			}
		}); 
		
		$('.academic_board').on('change',function() {
			var academic_board = $("#academic_board").val();
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
			// $('#other_board_twelfth').val('');
			if(academic_twelfth_board==26){
				$("#ob_twelfth").show();
			}else{
				$("#ob_twelfth").hide();
				$('#other_board_twelfth').val('');
			} 
		});

		$('#academic_graduation_university').on('change',function() {
			var academic_graduation_university = $("#academic_graduation_university").val();
			console.log("academic_graduation_university "+academic_graduation_university);
			
			if(academic_graduation_university==36){
				$("#ob_univ").show();
			}else{
				$("#ob_univ").hide();
				$('#other_univ_grad').val('');
			}  
		});
		
		$('#academic_stream').on('change',function() {
			var academic_stream = $("#academic_stream").val();
			console.log("academic_stream "+academic_stream);
			
			if(academic_stream==8){
				$("#obstream").show();
			}else{
				$("#obstream").hide();
				$('#other_stream_name').val('');
			}  
		});		

		$('#current_qualification_status').on('change',function() {
			var current_qualification_status = $("#current_qualification_status").val();
			console.log("current_qualification_status "+current_qualification_status);
			
			if(current_qualification_status=='graduation'){
				$("#dde_graduation_details").show();
			}else{
				$("#dde_graduation_details").hide();
			}
		}); 
		
		$('#pd_program').on('change',function() {
			if ($('#pd_course').data('select2')) {
				$('#pd_course').select2('destroy');
				$('#pd_course,#pd_campus').html('');
				$('#custom-pd_course-parsley-error').show();
			}			
			$('#main_div_course').show();
			var pd_program_val = $(this).val();
			getSelect2('pd_course','<?php echo base_url("get_course_preference"); ?>?is_lookup_master=1&prog_id='+pd_program_val+'&sort_by=id&sort_order=asc'+url_edit,'Select Course Preference', formatRepoCommon,no_course_msg, false, formatRepoSelection);
		});

		$('#pd_course').on('change',function() {
			if ($('#pd_campus').data('select2')) {
				$('#pd_campus').select2('destroy');
				$('#pd_campus').html('');
			}			
			$('#main_div_campus').show();
			var pd_course_val = $(this).val();
			var pd_program_val = $('#pd_program').val();
			getSelect2('pd_campus','<?php echo base_url("get_campus_preference"); ?>?is_lookup_master=1&prog_id='+pd_program_val+'&branch_id='+pd_course_val+'&sort_by=id&sort_order=asc'+url_edit,'Select Course Preference', formatRepoCommon,no_campus_msg, false, formatRepoSelection);
		});		
		
		var is_resident_tn = "current_resident_tn";
		var dbgis_resident_tnId = '<?php if($applicant_basic_details_list['resid_tamilnadu']!='f'){echo $applicant_basic_details_list['resid_tamilnadu'];}else{ echo $applicant_basic_details_list['resid_tamilnadu'];} ?>';
		console.log('dbgis_resident_tnId'+dbgis_resident_tnId);
		
		if(dbgis_resident_tnId=='f'){
			var dbis_resident_tnVal = 'No';
		}else{
			var dbis_resident_tnVal = 'Yes';			
		}

		if(dbgis_resident_tnId){
			setTimeout(function(){ 
				select2Set(is_resident_tn,dbgis_resident_tnId,dbis_resident_tnVal);
			}, 1);
		}
		
		// Personal Detail Select2Load 
		
		select2load('BankName','<?php echo $payment_details_list['bank_id']; ?>','<?php echo $payment_details_list['bank_name']; ?>');
		
		select2load('pd_nationality','<?php echo $applicant_basic_details_list['nation_id']; ?>','<?php echo $applicant_basic_details_list['nationality']; ?>');
		
		select2load('pd_title','<?php echo $applicant_basic_details_list['tittle_id']; ?>','<?php echo $applicant_basic_details_list['tittle_name']; ?>');	

		select2load('pd_gender','<?php echo $applicant_basic_details_list['gender_id']; ?>','<?php echo $applicant_basic_details_list['gender']; ?>');		
		
		select2load('pd_blood_group','<?php echo $applicant_basic_details_list['blood_id']; ?>','<?php echo $applicant_basic_details_list['blood_group']; ?>');	

		select2load('pd_social_status','<?php echo $applicant_basic_details_list['social_status_id']; ?>','<?php echo $applicant_basic_details_list['social_status']; ?>');
		
		select2loadbyMatch('pd_economically_weaker','<?php echo $applicant_basic_details_list['econo_weaker_sec']; ?>',false);

		select2loadbyMatch('pd_diffrently_abled','<?php echo $applicant_basic_details_list['dif_abled']; ?>','.main_div_deformity');		
		
		select2load('pd_nature_deformity','<?php echo $applicant_basic_details_list['deformity_type_id']; ?>','<?php echo $applicant_basic_details_list['deformity_type']; ?>');
		
		select2load('phone_no_code','<?php echo $applicant_basic_details_list['applicant_mob_country_code_id']; ?>','<?php echo $applicant_basic_details_list['applicant_mob_country_code_name']; ?>');
		
		select2loadDeformityPercentage('pd_percent_of_deformity','<?php echo $applicant_basic_details_list['deformity_percentage']; ?>');
		
		select2load('pd_course','<?php echo $applicant_course_details_list['course_id']; ?>','<?php echo $applicant_course_details_list['course_name']; ?>');
		
		<?php if(!empty($applicant_campus_details_list)) { ?>
			select2load('pd_campus','<?php echo $applicant_campus_details_list['campus_id']; ?>','<?php echo $applicant_campus_details_list['campus_name']; ?>');
		<?php } ?>
		
		select2load('pd_program','<?php echo $applicant_appln_details_list['grad_id']; ?>','<?php echo $applicant_appln_details_list['grad_name']; ?>');		
		
		// Parent Detail Select2Load
		
		select2load('pd_father_title','<?php echo $applicant_parent_title_id[$parent_type_id_father]; ?>','<?php echo $applicant_parent_title_name[$parent_type_id_father];  ?>');
		
		select2load('pd_father_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_father]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_father]; ?>');

		select2load('pd_mother_title','<?php echo $applicant_parent_title_id[$parent_type_id_mother]; ?>','<?php echo $applicant_parent_title_name[$parent_type_id_mother]; ?>');	

		select2load('pd_mother_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_mother]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_mother]; ?>');
		
		select2load('pd_guardian_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_guardian]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_guardian]; ?>');
		
		// Occupation Parent Select2Load
		
		<?php if($applicant_parent_occupation_id[$parent_type_id_father]) { ?>
		select2loadParentOccupation('pd_father_occupation','<?php echo $applicant_parent_occupation_id[$parent_type_id_father]; ?>');
		<?php } ?>
		
		<?php if($applicant_parent_occupation_id[$parent_type_id_mother]) { ?>
		select2loadParentOccupation('pd_mother_occupation','<?php echo $applicant_parent_occupation_id[$parent_type_id_mother]; ?>');
		<?php } ?>
		
		<?php if($applicant_parent_occupation_id[$parent_type_id_guardian]) { ?>
			select2loadParentOccupation('pd_guardian_occupation','<?php echo $applicant_parent_occupation_id[$parent_type_id_guardian]; ?>');	
		<?php } ?>
		
		$('#pd_nationality').on('change',function(){
			var country_val = $(this).val();
			if(country_value_default==country_val){
				$('#aadhar_no_mandatory').show();
				$("#pd_social_status").prepend("<option value=''>Choose Social Status</option>").val('');
				getSelect2('pd_social_status','<?php echo base_url("get_social_status"); ?>?is_lookup_master=1'+url_edit,'Choose Social Status', formatRepoCommon,no_social_status_msg, false, formatRepoSelection);
				$('#main_div_social_status').show();
			}else{
				$('#aadhar_no_mandatory').hide();
				$('#main_div_social_status').hide();
			}
		});	

		$('#current_resident_tn').on('change',function(){
			var thisvalue = $(this).val();
			if(thisvalue=='f' || thisvalue=='no'){
				$('#guidelines').show();
			}else{
				$('#guidelines').hide();
			}
		});		
		
		// Address Detail Select2Load
		select2load('country_phd','<?php echo $applicant_address_details_list[0]['country_id']; ?>','<?php echo $applicant_address_details_list[0]['country_name']; ?>');
		select2load('state_phd','<?php echo $applicant_address_details_list[0]['state_id']; ?>','<?php echo $applicant_address_details_list[0]['state_name']; ?>');
		select2load('district_phd','<?php echo $applicant_address_details_list[0]['district_id']; ?>','<?php echo $applicant_address_details_list[0]['district_name']; ?>');
		select2load('city_phd','<?php echo $applicant_address_details_list[0]['city_id']; ?>','<?php echo $applicant_address_details_list[0]['city_name']; ?>');
		
 		var cqs_id = "current_qualification_status";
		var dbcqs_val = 'twelfth';
		var dbcgsVal = 'Twelfth / 3 year Diploma Passed';
		<?php if($applicant_schooling_list[1]['result_declared']=='t' && empty($applicant_graduations_list)) { ?>
			if(dbcqs_val){
				setTimeout(function(){ select2Set(cqs_id,dbcqs_val,dbcgsVal);
				}, 1);
			}		
		<?php } ?>

		var dbcgs_val = 'graduation';
		var dbcgradsVal = 'Graduation Passed';
		<?php if($applicant_graduations_list[0]['is_curr_qualify']=='t' && !empty($applicant_graduations_list)){ ?>
			if(dbcqs_val){
				setTimeout(function(){ select2Set(cqs_id,dbcgs_val,dbcgradsVal);
				}, 1);
			}		
		<?php } ?>
					
		
		select2load('academic_board','<?php echo $applicant_schooling_list[0]['board_id']; ?>','<?php echo $applicant_schooling_list[0]['board_name']; ?>');
		
		select2load('academic_twelfth_board','<?php echo $applicant_schooling_list[1]['board_id']; ?>','<?php echo $applicant_schooling_list[1]['board_name']; ?>');

		select2load('academic_mode_of_study','<?php echo $applicant_schooling_list[0]['mode_of_study_id']; ?>','<?php echo $applicant_schooling_list[0]['mode_of_study_name']; ?>');
		
		select2load('academic_mode_of_study_twelfth','<?php echo $applicant_schooling_list[1]['mode_of_study_id']; ?>','<?php echo $applicant_schooling_list[1]['mode_of_study_name']; ?>');

		select2load('academic_marking_scheme','<?php echo $applicant_schooling_list[0]['marking_scheme_id']; ?>','<?php echo $applicant_schooling_list[0]['marking_scheme_name']; ?>');
		
		select2load('academic_marking_scheme_twelfth','<?php echo $applicant_schooling_list[1]['marking_scheme_id']; ?>','<?php echo $applicant_schooling_list[1]['marking_scheme_name']; ?>');
		
		select2load('academic_stream','<?php echo $applicant_schooling_list[1]['stream_id']; ?>','<?php echo $applicant_schooling_list[1]['stream_name']; ?>');
		
		select2load('academic_graduation_university','<?php echo $applicant_graduations_list[0]['univ_id']; ?>','<?php echo $applicant_graduations_list[0]['univ_name']; ?>');
		
		select2load('academic_marking_scheme_graduation','<?php echo $applicant_graduations_list[0]['mark_scheme_id']; ?>','<?php echo $applicant_graduations_list[0]['mark_scheme_name']; ?>');

		select2load('graduation_degree','<?php echo $applicant_graduations_list[0]['deg_id']; ?>','<?php echo $applicant_graduations_list[0]['deg_name']; ?>');
		
		select2load('part_lang_prefer','<?php echo $get_second_lang['second_lang_id']; ?>','<?php echo $get_second_lang['mothertongue_name']; ?>');
		
		select2load('learning_support_center','<?php echo $get_second_lang['support_center_id']; ?>','<?php echo $get_second_lang['campus_name']; ?>');	
		
		$("#from_year_0, #from_year_1, #from_year_2, #to_year_0, #to_year_1, #to_year_2").datepicker( {
			format:"mm/yyyy" , autoclose: !0, minViewMode: 'months', endDate: moment().format('dd-mm-yyyy')
		});			
		
		$("#DDDate").datepicker({
			format:"dd/mm/yyyy" , autoclose: !0, todayHighlight: true,todaybtn:true,endDate: todaydate }).on('changeDate', function(e) {$("#DDDate").parsley().validate();
		});

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
		
		
		calculate_months('work_experience_0','from_year_0','to_year_0','months');
		calculate_months('work_experience_1','from_year_1','to_year_1','months');
		calculate_months('work_experience_2','from_year_2','to_year_2','months');
		calculate_total_exp('months');		
		
		// Parent Other Occupation Enable	
		parent_other_occupation_enable('pd_father_occupation','other_occupation_father_div',7,true,'other_occupation_father');
		parent_other_occupation_enable('pd_mother_occupation','other_occupation_mother_div',7,true,'other_occupation_mother');
		parent_other_occupation_enable('pd_guardian_occupation','other_occupation_guardian_div',7,true,'other_occupation_guardian');	

		validate_cgpa('academic_marking_scheme','academic_obtain_cgpa');
		validate_cgpa('academic_marking_scheme_twelfth','academic_obtain_cgpa_twelfth');	
		validate_cgpa('academic_marking_scheme_graduation','academic_obtain_cgpa_graduation');
		
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
			<?php
		      if($upload_scripts) {
		        foreach($upload_scripts as $k=>$v) {
		          echo $v."\n";
		        }
		      }
		      ?>
		// Onchange Label Hide
		onchangeLableHide('current_resident_tn');
		onchangeLableHide('pd_program');
		onchangeLableHide('pd_course');
		onchangeLableHide('pd_campus');
		onchangeLableHide('pd_title');
		onchangeLableHide('pd_gender');
		onchangeLableHide('pd_blood_group');
		onchangeLableHide('pd_diffrently_abled');
		onchangeLableHide('pd_nature_deformity');
		onchangeLableHide('pd_percent_of_deformity');
		onchangeLableHide('pd_nationality');
		onchangeLableHide('pd_father_title');
		onchangeLableHide('pd_mother_title');	
		onchangeLableHide('country_phd');
		onchangeLableHide('state_phd');
		onchangeLableHide('district_phd');
		onchangeLableHide('city_phd');
		onchangeLableHide('current_qualification_status');
		onchangeLableHide('academic_board');
		onchangeLableHide('academic_mode_of_study');
		onchangeLableHide('academic_marking_scheme');
		onchangeLableHide('academic_twelfth_board');
		onchangeLableHide('academic_mode_of_study_twelfth');
		onchangeLableHide('academic_marking_scheme_twelfth');
		onchangeLableHide('academic_graduation_university');
		onchangeLableHide('academic_marking_scheme_graduation');
		onchangeLableHide('graduation_degree');
		onchangeLableHide('BankName');
		onchangeLableHide('pd_dob','date');
		
		// Alternate Email & Father,Mother,Guardian Email Suggestion Goes Here
		email_suggestion("pd_alt_email","suggestion_alt_email");
		email_suggestion("pd_father_email","suggestion_father_email");
		email_suggestion("pd_mother_email","suggestion_mother_email");
		email_suggestion("pd_guardian_email","suggestion_guardian_email");		
	});	
	
	//$('#dd').attr('checked',true);
	// This Function for Payment option selection
	$("#online").click(function(){
		$("#payment_details").hide();
	});
	$("#dd").click(function(){
		 $("#payment_details").show();
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
	
	if(typeof $('#'+file_doc_type).attr('data-file-count') != 'undefined') {
		$($('#'+file_doc_type)[0].files).each(function(k,v) {
			formData.append(file_doc_type+'[]', v);     
		});
	} else {
		formData.append(file_doc_type, $('#'+file_doc_type)[0].files[0]); 
	}
	
	// CRM Edit Mode
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
                          upload_file_set_download_delete_options(file_doc_type, file_name, file_path, doc_id, id, parsley_required, mode_edit_url);
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
<?php 
	if($applicant_graduations_list[0]['is_curr_qualify']=='t' && !empty($applicant_graduations_list)){
		$graduation_passed ="true";
   }else{
		$graduation_passed ="false";
	}
?> 		
function removeAttachedFile(dataThis) {
	var data_del_file_id = $(dataThis).attr('data-del-file-id');
	var doc_id = $(dataThis).attr('data-doc-id');
	var required = $(dataThis).attr('data-required');
	var field = $(dataThis).attr('data-field');
	var graduation_passed = '<?php echo $graduation_passed; ?>';
	// Get Regenerated CSRF Dynamically
	var csrfHashRegenerate = $("input[name='"+csrfName+"']").val();
	if(graduation_passed=="true"){
		required=true;
	}
	if(graduation_passed=='false'){
		required=true;
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



//initialization options for the progress bar
/* var progress = $("#progress").shieldProgressBar({
    min: 0,
    max: 100,
    value: 20,
    layout: "circular",
    layoutOptions: {
        circular: {
            borderColor: "#eee",
            width: 10,
            borderWidth: 1,
            color: "#5CB85C",

        }
    },
    text: {
        enabled: true,
        //  template: '<span style="font-size:20px; color: #5CB85C;">{0:n0}%</span>'
        template: '<span style="font-size:20px; color: #5CB85C;">20%</span>'
    },
}).swidget(); */

</script>