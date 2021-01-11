<?php
$app_form_id_afih= APP_FORM_ID_AFIH;
$parent_type_id_father = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_tenth_marksheet = DOCUMENT_ID_TENTH_MARKSHEET;
$document_id_mbbs_marksheet = DOCUMENT_ID_MBBS_MARKSHEET;
$document_id_mci_reg_certificate = DOCUMENT_ID_MCI_REG_CERTIFICATE;
$document_id_work_exp_certificate = DOCUMENT_ID_WORK_EXP_CERTIFICATE;
$document_id_crri_certificate = DOCUMENT_ID_CRRI_CERTIFICATE;
$document_id_twelvfth_marksheet = DOCUMENT_ID_TWELVFTH_MARKSHEET;

if($applicant_application_details_list) {
    foreach($applicant_application_details_list as $k=>$v) {
        $appln_form_id = $v['appln_form_id'];
        if($app_form_id_afih == $appln_form_id) {
            $applicant_appln_id = $v['applicant_appln_id'];
            $qualifyingexamfromindia = $v['qualifyingexamfromindia'];
            $i_confirmChecked=$v['is_agree'];
        }
    }
}

$qualifyingexamfromindia=isset($qualifyingexamfromindia)?$qualifyingexamfromindia:'';
$i_confirmChecked=isset($i_confirmChecked) ? $i_confirmChecked:'';

$add_gardian=isset($applicant_other_details_list['add_gardian'])?$applicant_other_details_list['add_gardian']:'';
$tenthList=$this->config->item('tenth_status');

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
//is employed
$is_employed = $applicant_other_details_list['iscurrentlyemployed'];
$is_employed=strtolower($is_employed);
$is_employed_select = '';
$is_employed_select_name = '';
if($is_employed == 't' || $is_employed=='yes') {
    $is_employed_select = 'yes';
    $is_employed_select_name = 'Yes';
} else if($is_employed == 'f'|| $is_employed=='no') {
    $is_employed_select = 'no';
    $is_employed_select_name = 'No';
}else{
    $is_employed_select = '';
    $is_employed_select_name = 'Select';
}
/*is emplyed*/
/**work experience**/
$is_work_experience = $applicant_other_details_list['is_work_experience'];
$is_work_experience_select = '';
$is_work_experience_select_name = '';
if($is_work_experience == 't') {
    $is_work_experience_select = 'yes';
    $is_work_experience_select_name = 'Yes';
} else if($is_work_experience == 'f') {
    $is_work_experience_select = 'no';
    $is_work_experience_select_name = 'No';
}

/** end work exp **/

if(!empty($applicant_application_details_list))
{
    $applicant_appln_id=$applicant_application_details_list[0]['applicant_appln_id'];
    $after_tenth_quali_id=$applicant_application_details_list[0]['after_tenth_quali_id'];
    $current_wizard=$applicant_application_details_list[0]['wizard_id'];
}

$applicant_appln_id=!empty($applicant_appln_id) ? $applicant_appln_id :false;
$after_tenth_quali_id=!empty($after_tenth_quali_id) ? $after_tenth_quali_id :'';
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
        $file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_tenth_marksheet == $document_id)?'tenth_marksheet':(($document_id_mbbs_marksheet == $document_id)?'mbbs_marksheet':(($document_id_mci_reg_certificate == $document_id)?'mci_reg_certificate' :(($document_id_work_exp_certificate == $document_id)?'work_exp_certificate' :(($document_id_crri_certificate == $document_id)?'crri_certificate' :(($document_id_twelvfth_marksheet == $document_id)?'twelvfth_marksheet':''))))))));
        $parsley_required = (($document_id_photograph == $document_id)?'true':(($document_id_signature == $document_id)?'true':(($document_id_tenth_marksheet == $document_id)?'true':(($document_id_mbbs_marksheet == $document_id)?'false':(($document_id_mci_reg_certificate == $document_id)?'false':(($document_id_work_exp_certificate == $document_id)?'false':(($document_id_crri_certificate == $document_id)?'false':(($document_id_twelvfth_marksheet == $document_id)?'false':''))))))));
        
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
$applicant_name=isset($applicant_application_details_list[0]['applicant_name_declaration'])?$applicant_application_details_list[0]['applicant_name_declaration']:'';
$parent_name=isset($applicant_application_details_list[0]['applicant_parentname_declaration'])?$applicant_application_details_list[0]['applicant_parentname_declaration']:'';
$payment_mode_id = $applicant_payment_details_list['payment_mode_id'];
$startIndex = $this->input->get('startIndex',true);
//restrict previous section
$is_allow_previous=$this->config->item('is_allow_previous');
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
?>
<script>
/*CRM ADMIN Edit form start*/
var crm_applicant_personal_det_id = '<?php echo $crm_applicant_personal_det_id ; ?>';
var crm_applicant_login_id = '<?php echo $crm_applicant_login_id ; ?>';
var mode_edit_val = '<?php echo ADMIN_MODE_EDIT ; ?>';
var mode_edit_url = '<?php echo $mode_edit; ?>';
<?php if($mode_edit) { ?>
  var url_edit = '&mode=edit'+'&applicant_personal_det_id='+crm_applicant_personal_det_id+'&applicant_login_id='+crm_applicant_login_id;
  var url = "<?php echo base_url(); ?>afih/"+mode_edit_val+"/"+crm_applicant_login_id+"/"+crm_applicant_personal_det_id;
  var payment_url = '<?php echo base_url(); ?>user/payment_details?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;
  var save_exit_redirect_url = '<?php echo base_url(); ?>crm-admin/dashboard';
  //var upload_url = '<?php echo base_url(); ?>upload-file?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;     
<?php } else { ?>
  var url_edit =  '';
  var url = "<?php echo base_url(); ?>afih";
  var payment_url = '<?php echo base_url(); ?>user/payment_details';
   var save_exit_redirect_url = '<?php echo base_url(); ?>';
   //var upload_url = "<?php echo base_url(); ?>upload-file";
<?php } ?>
/*CRM ADMIN Edit form end*/

var country_value_default = '<?php echo COUNTRY_VALUE_DEFAULT; ?>';
var otherboard='<?php echo OTHER_BOARD;?>';
var logged_applicant_id = '<?php echo $logged_applicant_id; ?>';
var logged_applicant_login_id = '<?php echo $logged_applicant_login_id; ?>';

var app_form_id = '<?php echo $app_form_id_afih; ?>';
var redirect = '<?php echo base_url()."thank_you"; ?>?app_form_id='+app_form_id+url_edit;
var applicant_appln_id = '<?php echo $applicant_appln_id;?>';
var otheroccupation='<?php echo OTHER_OCCUPATION;?>';
var otheruniversity='<?php echo OTHER_UNIVERSITY;?>';
var get_percentage_url = '<?php echo base_url(); ?>user/get_percentage_w_tab?app_form_id='+app_form_id+url_edit;
var redirect_payment_thank_you = '<?php echo base_url(); ?>user/payment_thank_you?app_form_id='+app_form_id+'&url='+encodeURIComponent(url);
var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
$(document).ready(function () {	
    'use strict'; 
 // Dynamically Get Total Wizard Steps
	var total_wizard_Step = $('.wizard_head_tag').length;
	$("#show_currentindex").html('1 of '+total_wizard_Step);	
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
									if(returndata.appln_status.status == 'true') {
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
					  var pd_title = $('#pd_title').parsley();
					  var pd_firstname = $('#pd_firstname').parsley();
					  var pd_lastname = $('#pd_lastname').parsley();
					  var pd_middlename = $('#pd_middlename').parsley();
					  var pd_mobile_no = $('#pd_mobile_no').parsley();
					  var pd_email = $('#pd_email').parsley();
					  var pd_dob = $('#pd_dob').parsley();
					  var pd_gender = $('#pd_gender').parsley();
					  var pd_alt_email = $('#pd_alt_email').parsley();
                      var pd_blood_group = $('#pd_blood_group').parsley();
					  var pd_diffrently_abled = $('#pd_diffrently_abled').parsley();
					  var pd_nationality = $('#pd_nationality').parsley();
					  var pd_social_status = $('#pd_social_status').parsley();
                      if($('#main_div_social_status').is(':visible')){
							$('#pd_social_status').attr('data-parsley-required', 'true');
							$('#pd_social_status').attr('data-parsley-required-message', 'Please Select Social Status');
					  }else{
							$('#pd_social_status').attr('data-parsley-required', 'false');
					  }	
					  
        			  		// Make Validation false
        					if($('#pd_lastname').val()=='.'){
        						$('#pd_lastname').removeAttr('data-parsley-nameonly', 'true');
        						$('#pd_lastname').removeAttr('data-parsley-nameonly-message', 'Name must be alphabetic only.');
        					}
					         if(pd_title.isValid()
							  && pd_firstname.isValid() && pd_lastname.isValid() 
							  && pd_mobile_no.isValid() && pd_email.isValid()
							  && pd_alt_email.isValid()
							  && pd_dob.isValid() && pd_gender.isValid() 
							  && pd_blood_group.isValid() 
							  && pd_diffrently_abled.isValid()
							  && pd_nationality.isValid() 
							  && pd_social_status.isValid()
							  && pd_middlename.isValid()) {

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
							var user_data = 'pd_title='+pd_title_val+'&pd_firstname='+pd_firstname_val+'&pd_middlename='+pd_middlename_val+'&pd_lastname='+pd_lastname_val+'&phone_no_code='+pd_mobile_no_code_val+'&pd_mobile_no='+pd_mobile_no_val+'&pd_email='+pd_email_val+'&pd_dob='+pd_dob_val+'&pd_gender='+pd_gender_val+'&pd_alt_email='+pd_alt_email_val+'&pd_blood_group='+pd_blood_group_val+'&pd_social_status='+pd_social_status_val+'&pd_diffrently_abled='+pd_diffrently_abled_val+'&pd_religion='+pd_religion_val+'&pd_medium_of_instruction='+pd_medium_of_instruction_val+'&pd_hostel_accommodation='+pd_hostel_accommodation_val+'&pd_mother_tongue='+pd_mother_tongue_val+'&pd_advertisment_source='+pd_advertisment_source_val+'&pd_nationality='+pd_nationality_val+'&'+csrfName+'='+csrfHash;
                            //console.log(user_data);
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
										if(returndata.status == 'true') {
											if(isexit==1){
				                                  window.location.href = save_exit_redirect_url;
				                                  return false;
				                            }else{
    											var startIndex = currentIndex+1
    											window.location.href = url+'?startIndex='+startIndex; 
    											$("#formerr").hide();
				                            }
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
					  	} else {				
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
							pd_alt_email.validate();
							pd_middlename.validate();													
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
					var pd_father_alt_phone = $('#pd_father_alt_phone').parsley();
					var pd_mother_title = $('#pd_mother_title').parsley();
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
					var guardian_relationship_1=$('#guardian_relationship_1').parsley();
					
					/*secondary guardian*/
				    var pd_guardian_name2 = $('#pd_guardian_name2').parsley();
					var pd_guardian_phone2 = $('#pd_guardian_phone2').parsley();
					var pd_guardian_email2 = $('#pd_guardian_email2').parsley();
					var pd_guardian_occupation2 = $('#pd_guardian_occupation2').parsley();
					var guardian_other_occupation2=$('#guardian_other_occupation2').parsley();
					var guardian_relationship_2=$('#guardian_relationship_2').parsley();
					
                    if(pd_father_title.isValid() && pd_father_name.isValid() && pd_mother_title.isValid() && pd_mother_name.isValid() && pd_father_email.isValid() && pd_mother_email.isValid() && pd_guardian_name.isValid() && pd_guardian_phone.isValid() && pd_guardian_email.isValid() && pd_father_phone.isValid() && pd_mother_phone.isValid() && pd_guardian_occupation.isValid() && pd_father_other_occupation.isValid()
                            && pd_mother_other_occupation.isValid()
                            && guardian_other_occupation.isValid()
                            && pd_mother_alt_phone.isValid()
                            && pd_father_alt_phone.isValid() && pd_guardian_name2.isValid() && pd_guardian_phone2.isValid() && pd_guardian_email2.isValid() && pd_guardian_occupation2.isValid() && guardian_other_occupation2.isValid()){
                    var pd_father_id = $('#pd_father_id').val();
                    var pd_mother_id = $('#pd_mother_id').val();
                    var pd_guardian_id = $('#pd_guardian_id').val();
                    var pd_guardian2_id = $('#pd_guardian2_id').val();
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
					//var add_guardian_checkbox = $('#add_guardian_checkbox').val();
					var add_guardian_checkbox ='';
					var add_guardian2_checkbox = $('#add_guardian2_checkbox').val();
					var pd_guardian_name = $('#pd_guardian_name').val();
					var pd_guardian_phone_no_code = $('#pd_guardian_phone_no_code').val();
					var pd_guardian_phone = $('#pd_guardian_phone').val();
					var pd_guardian_email = $('#pd_guardian_email').val();
					var pd_guardian_occupation = $('#pd_guardian_occupation').val();
                      
					var father_other_occupation_val='';
					var mother_other_occupation_val='';
					var guardian_other_occupation_val='';
					father_other_occupation_val=$('#pd_father_other_occupation').val();
					mother_other_occupation_val=$('#pd_mother_other_occupation').val();
					guardian_other_occupation_val=$('#guardian_other_occupation').val();
					var guardian_relationship_1_val=$('#guardian_relationship_1').val();

					//secondary guardian
                    var pd_guardian_name2 = $('#pd_guardian_name2').val();
					var pd_guardian_phone_no_code2 = $('#pd_guardian_phone_no_code2').val();
					var pd_guardian_phone2 = $('#pd_guardian_phone2').val();
					var pd_guardian_email2 = $('#pd_guardian_email2').val();
					var pd_guardian_occupation2 = $('#pd_guardian_occupation2').val();
					var guardian_other_occupation2_val=''
					guardian_other_occupation2_val=$('#guardian_other_occupation2').val();
					var guardian_relationship_2_val=$('#guardian_relationship_2').val();
                    //set father name at declaration
                    <?php if(empty($parent_name) || $parent_name=="")  { ?>
                    $("#parent_name").val(pd_father_name);
                    <?php } ?>
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
					//secondary guardian
					if(pd_guardian_email2!=''){
						if(pd_mother_email==pd_guardian_email2 || pd_father_email==pd_guardian_email2 || pd_guardian_email==pd_guardian_email2){
							$('#pd_guardian_email2').addClass('parsley-error');
							$('#custom-pd_guardian_email2-parsley-error').show();
							$('#custom-pd_guardian_email2-parsley-error').css('color','#ec4561');
							$('#custom-pd_guardian_email2-parsley-error').html('<?php echo EMAIL_MATCH_SEC_GUARDIAN; ?>');	
							setTimeout(function(){
								$('#pd_guardian_email2').toggleClass('parsley-error');
								$('#custom-pd_guardian_email2-parsley-error').hide();
							}, 3000);
							return false;
						}	
					}
					//end new
                    var user_data = 'pd_father_id='+pd_father_id+'&pd_mother_id='+pd_mother_id+'&pd_guardian_id='+pd_guardian_id+'&pd_father_title='+pd_father_title+'&pd_father_name='+pd_father_name+'&pd_father_phone_no_code='+pd_father_phone_no_code+'&pd_father_phone='+pd_father_phone+'&pd_father_alt_phone_no_code='+pd_father_alt_phone_no_code+'&pd_father_alt_phone='+pd_father_alt_phone+'&pd_father_email='+pd_father_email+'&pd_father_occupation='+pd_father_occupation+'&father_other_occupation='+father_other_occupation_val+'&pd_mother_title='+pd_mother_title+'&pd_mother_name='+pd_mother_name+'&pd_mother_phone_no_code='+pd_mother_phone_no_code+'&pd_mother_alt_phone_no_code='+pd_mother_alt_phone_no_code+'&pd_mother_email='+pd_mother_email+'&pd_mother_occupation='+pd_mother_occupation+'&mother_other_occupation='+mother_other_occupation_val+'&add_guardian_checkbox='+add_guardian_checkbox+'&pd_guardian_name='+pd_guardian_name+'&pd_guardian_phone_no_code='+pd_guardian_phone_no_code+'&pd_guardian_phone='+pd_guardian_phone+'&pd_guardian_email='+pd_guardian_email+'&pd_guardian_occupation='+pd_guardian_occupation+'&guardian_other_occupation='+guardian_other_occupation_val+'&pd_mother_phone='+pd_mother_phone+'&pd_mother_alt_phone='+pd_mother_alt_phone+'&add_guardian2_checkbox='+add_guardian2_checkbox+'&pd_guardian_name2='+pd_guardian_name2+'&pd_guardian_phone_no_code2='+pd_guardian_phone_no_code2+'&pd_guardian_phone2='+pd_guardian_phone2+'&pd_guardian_email2='+pd_guardian_email2+'&pd_guardian_occupation2='+pd_guardian_occupation2+'&guardian_other_occupation2='+guardian_other_occupation2_val+'&guardian_relation1='+guardian_relationship_1_val+'&guardian_relation2='+guardian_relationship_2_val+'&pd_guardian2_id='+pd_guardian2_id+'&'+csrfName+'='+csrfHash;
                   
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
									if(returndata[0].status == 'true') {	
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
						if($("#add_guardian2_checkbox").is(':checked')){
    						pd_guardian_name2.validate();
    						pd_guardian_phone2.validate();
    						pd_guardian_email2.validate();
    						pd_guardian_occupation2.validate();
    						guardian_other_occupation2.validate();
						}
						return false;						
					}
				}
				//end step3

					// Step 4 address form validation
					if(currentIndex === 3) {
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
				var edu_twelfth = $('#edu_twelfth').parsley();
				var edu_diploma = $('#edu_diploma').parsley();
				var edu_both = $('#edu_both').parsley();
                var candidate_name = $('#candidate_name').parsley();
               
                  var academic_tenth_inst = $('#academic_tenth_inst').parsley();
                  var academic_board = $('#academic_board').parsley();
                  var academic_marking_scheme = $('#academic_marking_scheme').parsley();
                  var academic_obtain_cgpa = $('#academic_obtain_cgpa').parsley();
                  var academic_yr_passing = $('#academic_yr_passing').parsley();
                  var academic_reg_no = $('#academic_reg_no').parsley();

                  var academic_twelfth_inst = $('#academic_twelfth_inst').parsley();
                  var academic_twelfth_board = $('#academic_twelfth_board').parsley();
                  var academic_marking_scheme_twelfth = $('#academic_marking_scheme_twelfth').parsley();
                  var academic_obtain_cgpa_twelfth = $('#academic_obtain_cgpa_twelfth').parsley();
                  var academic_yr_passing_twelfth = $('#academic_yr_passing_twelfth').parsley();
                  var academic_reg_no_twelfth = $('#academic_reg_no_twelfth').parsley();
                  
                  var institute_name_ug = $('#institute_name_ug').parsley();
                  var university_ug = $('#university_ug').parsley();
                  var crri_comp_date = $('#crri_comp_date').parsley();
                  var yr_passing_ug = $('#yr_passing_ug').parsley();
                  var register_no_ug = $('#register_no_ug').parsley();
                  var reg_date = $('#reg_date').parsley();
                  
                  var digilocker_id = $('#digilocker_id').parsley();
                  
                  var organisation_name_0 = $('#organisation_name_0').parsley();
                  var designation_0 = $('#designation_0').parsley();
                  var job_nature_0 = $('#job_nature_0').parsley();
                  var total_salary_month_0 = $('#total_salary_month_0').parsley();
                  var from_year_0 = $('#from_year_0').parsley();
                  var to_year_0 = $('#to_year_0').parsley();
                  var work_experience_0 = $('#work_experience_0').parsley();
                  var is_work_experience = $('#is_work_experience').parsley();
                  var is_employed = $('#is_employed').parsley();
                  
                  var is_work_experience_checked = false;
                  if($('#is_work_experience').val() == 'yes') {
                      if(organisation_name_0.isValid() && designation_0.isValid() && total_salary_month_0.isValid() && job_nature_0.isValid() && from_year_0.isValid() && to_year_0.isValid() && work_experience_0.isValid()) {
                          is_work_experience_checked = true;    
                      }
                  } else {
                      is_work_experience_checked = true;
                  }

                var organisation_name_1 = $('#organisation_name_1').parsley();
  				var designation_1 = $('#designation_1').parsley();
  				var job_nature_1 = $('#job_nature_1').parsley();
  				var total_salary_month_1  = $('#total_salary_month_1').parsley();
  				var from_year_1  = $('#from_year_1').parsley();
  				var to_year_1  = $('#to_year_1').parsley();
  				var work_experience_1  = $('#work_experience_1').parsley();	 
  				var organisation_name_2 = $('#organisation_name_2').parsley();
  				var designation_2 = $('#designation_2').parsley();
  				var job_nature_2 = $('#job_nature_2').parsley();
  				var total_salary_month_2  = $('#total_salary_month_2').parsley();
  				var from_year_2  = $('#from_year_2').parsley();
  				var to_year_2  = $('#to_year_2').parsley();
  				var work_experience_2  = $('#work_experience_2').parsley();
  			
                 
	                if($('#ob_univ').is(':visible')){
	                  $('#other_univ_grad').attr('data-parsley-required', 'true');
	                  $('#other_univ_grad').attr('data-parsley-required-message', 'Please Enter Other University'); 
	                  $('#other_univ_grad').attr('data-parsley-nameonly', 'true');
	                  $('#other_univ_grad').attr('data-parsley-nameonly-message', 'Name must be alphabetic only.');           
	                }else{
	                  $('#other_univ_grad').attr('data-parsley-required', 'false');
	                  $('#other_univ_grad').attr('data-parsley-nameonly', 'false');
	                }	              
            	    
	              if(is_work_experience_checked == true && edu_twelfth.isValid() && edu_diploma.isValid() && edu_both.isValid() && candidate_name.isValid() && academic_tenth_inst.isValid() && academic_board.isValid()  && academic_marking_scheme.isValid() && academic_obtain_cgpa.isValid() && academic_yr_passing.isValid() && academic_reg_no.isValid() && academic_twelfth_inst.isValid() && academic_twelfth_board.isValid() && academic_marking_scheme_twelfth.isValid() && academic_obtain_cgpa_twelfth.isValid() && academic_yr_passing_twelfth.isValid() && academic_reg_no_twelfth.isValid() && institute_name_ug.isValid() && university_ug.isValid() && crri_comp_date.isValid() && yr_passing_ug.isValid() && register_no_ug.isValid() && reg_date.isValid() && is_work_experience.isValid()  && designation_1.isValid() && organisation_name_1.isValid() && job_nature_1.isValid() && total_salary_month_1.isValid() && from_year_1.isValid() && to_year_1.isValid() && work_experience_1.isValid() && designation_2.isValid() && organisation_name_2.isValid() && job_nature_2.isValid() && total_salary_month_2.isValid() && from_year_2.isValid() && to_year_2.isValid() && work_experience_2.isValid() && is_employed.isValid()) {
	                	var education_qual_status  = $('input[name=education_qual_status]:checked').val();
	                	var candidate_name = $("#candidate_name").val();
                      	var academic_tenth_inst_val 	= 	$('#academic_tenth_inst').val();
						var academic_board_val 	= 	$('#academic_board').val();
						var other_tenth_board_val="";
						var other_tenth_board_val=$('#other_tenth_board').val();
						var academic_marking_scheme_val = $('#academic_marking_scheme').val();
						var academic_obtain_cgpa_val = $('#academic_obtain_cgpa').val();
						var academic_yr_passing_val = $('#academic_yr_passing').val();
						var academic_reg_no_val = $('#academic_reg_no').val();
						
						var academic_twelfth_inst_val 	= 	$('#academic_twelfth_inst').val();
						var academic_twelfth_board_val 	= 	$('#academic_twelfth_board').val();
						var other_twelfth_board_val="";
						var other_twelfth_board_val=$('#other_twelfth_board').val();
						
						var academic_twelfth_marking_scheme_val = $('#academic_marking_scheme_twelfth').val();
						var academic_twelfth_obtain_cgpa_val = $('#academic_obtain_cgpa_twelfth').val();
						var academic_twelfth_yr_passing_val = $('#academic_yr_passing_twelfth').val();
						var academic_twelfth_reg_no_val = $('#academic_reg_no_twelfth').val();

						var grad_id_ug = $("#grad_id_ug").val();
	                    var institute_name_ug_val = $("#institute_name_ug").val();
	                	var university_ug_val = $("#university_ug").val();
	                    var university_other_ug_val = $("#university_other_ug").val();
	                    var yr_passing_ug_val = $("#yr_passing_ug").val();
	                	var register_no_ug_val = $("#register_no_ug").val();
	                	var crri_comp_date_val = $("#crri_comp_date").val();
	                	var reg_date_val = $("#reg_date").val();
		                
            			
						var digilocker_id_val= $('#digilocker_id').val();
	                    var schooling_id_tenth_val="";
	                    schooling_id_tenth_val = $('#schooling_id_tenth').val();

	                    var schooling_id_twelfth_val="";
						schooling_id_twelfth_val = $('#schooling_id_twelfth').val();

						var is_work_experience = $("#is_work_experience").val();                	
	                    var organisation_name_0 = $("#organisation_name_0").val();
	                    var designation_0 = $("#designation_0").val();
	                    var job_nature_0 = $("#job_nature_0").val();
	                    var other_job_nature_0 = $("#other_job_nature_0").val();
	                    var total_salary_month_0 = $("#total_salary_month_0").val();
	                    var from_year_0 = $("#from_year_0").val();
	                    var to_year_0 = $("#to_year_0").val();
	                    var work_experience_0 = $("#work_experience_0").val();
	                    var organisation_name_1 = $("#organisation_name_1").val();
	                    var designation_1 = $("#designation_1").val();
	                    var job_nature_1 = $("#job_nature_1").val();
	                    var other_job_nature_1 = $("#other_job_nature_1").val();
	                    var total_salary_month_1 = $("#total_salary_month_1").val();
	                    var from_year_1 = $("#from_year_1").val();                    	
	                    var to_year_1 = $("#to_year_1").val();
	                    var work_experience_1 = $("#work_experience_1").val();
	                    var organisation_name_2 = $("#organisation_name_2").val();
	                    var designation_2 = $("#designation_2").val();
	                    var job_nature_2 = $("#job_nature_2").val();
	                    var other_job_nature_2 = $("#other_job_nature_2").val();
	                    var total_salary_month_2 = $("#total_salary_month_2").val();
	                    var from_year_2 = $("#from_year_2").val();
	                    var to_year_2 = $("#to_year_2").val();
	                    var work_experience_2 = $("#work_experience_2").val();
	                    var total_work_experience = $("#total_work_experience").val();
	                    var prof_exp_id_0 = $("#prof_exp_id_0").val();
	                    var prof_exp_id_1 = $("#prof_exp_id_1").val();
	                    var prof_exp_id_2 = $("#prof_exp_id_2").val();

						var is_employed_val=$('#is_employed').val();
						var moveNxt=0;   
	                    var user_data = 'education_qual_status='+education_qual_status+'&candidate_name='+candidate_name+'&academic_tenth_inst='+academic_tenth_inst_val+'&academic_tenth_board='+academic_board_val+'&other_tenth_board='+other_tenth_board_val+'&academic_tenth_msv='+academic_marking_scheme_val+'&academic_tenth_cgpa='+academic_obtain_cgpa_val+'&academic_tenth_yrp='+academic_yr_passing_val+'&academic_tenth_regno='+academic_reg_no_val+'&schooling_id_tenth='+schooling_id_tenth_val+'&academic_twelfth_inst='+academic_twelfth_inst_val+'&academic_twelfth_board='+academic_twelfth_board_val+'&other_twelfth_board='+other_twelfth_board_val+'&academic_twelfth_msv='+academic_twelfth_marking_scheme_val+'&academic_twelfth_cgpa='+academic_twelfth_obtain_cgpa_val+'&academic_twelfth_yrp='+academic_twelfth_yr_passing_val+'&academic_twelfth_regno='+academic_twelfth_reg_no_val+'&schooling_id_twelfth='+schooling_id_twelfth_val+'&digilocker_id='+digilocker_id_val+'&graduation_id_ug='+grad_id_ug+'&institute_name_ug='+institute_name_ug_val+'&university_ug='+university_ug_val+'&institute_university_other='+university_other_ug_val+'&yr_passing_ug='+yr_passing_ug_val+'&register_no_ug='+register_no_ug_val+'&crri_comp_date='+crri_comp_date_val+'&reg_date='+reg_date_val+'&is_work_experience='+is_work_experience+'&organisation_name_0='+organisation_name_0+'&designation_0='+designation_0+'&job_nature_0='+job_nature_0+'&total_salary_month_0='+total_salary_month_0+'&from_year_0='+from_year_0+'&to_year_0='+to_year_0+'&work_experience_0='+work_experience_0+'&organisation_name_1='+organisation_name_1+'&designation_1='+designation_1+'&job_nature_1='+job_nature_1+'&total_salary_month_1='+total_salary_month_1+'&from_year_1='+from_year_1+'&to_year_1='+to_year_1+'&work_experience_1='+work_experience_1+'&organisation_name_2='+organisation_name_2+'&designation_2='+designation_2+'&job_nature_2='+job_nature_2+'&total_salary_month_2='+total_salary_month_2+'&from_year_2='+from_year_2+'&to_year_2='+to_year_2+'&work_experience_2='+work_experience_2+'&total_work_experience='+total_work_experience+'&prof_exp_id_0='+prof_exp_id_0+'&prof_exp_id_1='+prof_exp_id_1+'&prof_exp_id_2='+prof_exp_id_2+'&other_job_nature_0='+other_job_nature_0+'&other_job_nature_1='+other_job_nature_1+'&other_job_nature_2='+other_job_nature_2+'&is_employed='+is_employed_val+'&'+csrfName+'='+csrfHash;
                       // console.log(user_data);
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
	        								if(returndata.status == 'true') {
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
	                  	candidate_name.validate();	                  	
	                  	academic_tenth_inst.validate();
						academic_board.validate();						
						academic_marking_scheme.validate();
						academic_obtain_cgpa.validate();
						academic_yr_passing.validate();
						academic_reg_no.validate();

						edu_twelfth.validate();
						edu_diploma.validate();
						edu_both.validate();
						
						 //12th
						academic_twelfth_inst.validate();
						academic_twelfth_board.validate();						
						academic_marking_scheme_twelfth.validate();
						academic_obtain_cgpa_twelfth.validate();
						academic_yr_passing_twelfth.validate();
						academic_reg_no_twelfth.validate();
						//degree
	                  	institute_name_ug.validate();
						university_ug.validate();	
						yr_passing_ug.validate();
						register_no_ug.validate();					
						crri_comp_date.validate();
						reg_date.validate();						
	                  	//work experience 
	                  	is_work_experience.validate(); 
	                  	if(is_work_experience.isValid())
		                {              
	                  	organisation_name_0.validate();
	                  	designation_0.validate();
	                    job_nature_0.validate();
	                    total_salary_month_0.validate();
	                  	from_year_0.validate();
	                  	to_year_0.validate();
	                  	work_experience_0.validate();                  	
						organisation_name_1.validate();
						designation_1.validate();
						job_nature_1.validate();
						total_salary_month_1.validate();
						from_year_1.validate();
						to_year_1.validate();
						work_experience_1.validate();
						organisation_name_2.validate();
						designation_2.validate();
						job_nature_2.validate();
						total_salary_month_2.validate();
						from_year_2.validate();
						to_year_2.validate();
						work_experience_2.validate();
		                }
						is_employed.validate();	                  	                 											
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
										setTimeout(function() { window.location.href = redirect_payment_thank_you+'&payment_mode='+payment_mode+'&currentIndex='+currentIndex+url_edit; }, 200);
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
						<?php 
                        } else { ?>				
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
				//step 6 -payment end
				/* if(currentIndex == 6) {					
				} */
		            
			}
			else { 
				return true; 
			}				
		},
		saveState: true,
        onStepChanged: function (event, currentIndex, priorIndex)
        { 
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
        	if(currentIndex == 5) {
				// applicant info in payment page
				set_application_payment_info();                
			}
        	// form preview button displayed
			if(currentIndex == parseInt(total_wizard_Step - 1)){
				$("#save_exit").remove();
				if(mode_edit_url !='')
		        {
		         	enable_preview_btn(currentIndex,'<?php echo base_url();?>afih_preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
		        }else{
				enable_preview_btn(currentIndex,'<?php echo base_url();?>afih_preview');
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
        	var photograph=$('#photograph').parsley();
            var signature=$('#signature').parsley();
            var tenth_marksheet=$('#tenth_marksheet').parsley();
            var mbbs_marksheet=$('#mbbs_marksheet').parsley();
            var mci_reg_certificate=$('#mci_reg_certificate').parsley();
            var work_exp_certificate=$('#work_exp_certificate').parsley();
            var crri_certificate=$('#crri_certificate').parsley();
            var twelvfth_marksheet=$('#twelvfth_marksheet').parsley();
        	
            
           	var applicant_name=$('#applicant_name').parsley();
            var parent_name=$('#parent_name').parsley();
            var date_dec=$('#date_dec').parsley();
                
           	var applicant_name_val = $('#applicant_name').val();
            var parent_name_val = $('#parent_name').val();          
            var declaration_date = $('#date_dec').val();
         	// Get Regenerated CSRF Dynamically
			var csrfHashRegenerateonDec = $("input[name='"+csrfName+"']").val();
			
            var user_data = 'applicant_name='+applicant_name_val+'&parent_name='+parent_name_val+'&declaration_date='+declaration_date+'&'+csrfName+'='+csrfHashRegenerateonDec;

           if(photograph.isValid() && signature.isValid() && tenth_marksheet.isValid() && mbbs_marksheet.isValid() && mci_reg_certificate.isValid() && work_exp_certificate.isValid() && crri_certificate.isValid()  && applicant_name.isValid() && parent_name.isValid() && date_dec.isValid() && twelvfth_marksheet.isValid())
               {
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
    					if(returndata.status == 'true') {
    					$("#formerr").hide();
    					 setTimeout(function() { window.location.href = redirect; }, 100);
    					}
    				  }
    				},
    				error: function(returndata) {
    				  //console.log(returndata);				  							
    				  $("#formerr").show();
    				 // setTimeout(function() { window.location.href = redirect; }, 100);
    					 
    				},
    			});
               }else{
               	photograph.validate();
               	signature.validate();						
               	tenth_marksheet.validate();               
               	mbbs_marksheet.validate();
               	mci_reg_certificate.validate();
               	work_exp_certificate.validate();
                crri_certificate.validate();
               	applicant_name.validate();
               	parent_name.validate();
               	date_dec.validate();
               	twelvfth_marksheet.validate();
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
	
	$("#afih_form").steps(settings);
  //setsave exit attr	
        $(document).on("click", "#save_btn" , function() {
        	 $("#afih_form").attr('isexit',1);
             $("#afih_form").steps('next');
        });
        
        $('.actions a').click(function(){        	 
          $("#afih_form").attr('isexit','');
        }); 
    //end set attr
   //to remove links from previous tabs a
    <?php if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) && ($mode_edit == '')) { ?>
     $( ".steps li" ).each(function( index ) { 
      if(index<6){       	 
   	  $("#afih_form-t-"+index).removeAttr("href");
     }			   
   	});
    <?php } ?>
    light_box_init();
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
		
		// This Function for Payment option selection
		$("#online").click(function(){		
		$("#payment_details").hide();
		});
		$("#dd").click(function(){
		$("#payment_details").show();
		}); 
		// End of  Function for Payment option selection 
		 
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
		var no_stream_msg = 'Sorry, Stream not available.';
		var no_institute_university_msg = "Sorry, Institute/University not available.";
		var no_banks_msg = "Sorry, Banks not available.";
		var no_is_work_experience_msg = "Sorry, Work Experience Status not available.";
		var no_relationship="Sorry, Relationship not available." ; 

		getSelect2('studied_from_india','<?php echo base_url("get_hcma_studied_from_india"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Status - Yes or No', formatRepoCommon,no_study_resident_in_msg, false, formatRepoSelection);
		getSelect2('non_indian_resident','<?php echo base_url("get_resident_status"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Resident Status', formatRepoCommon,no_resident_status_msg, false, formatRepoSelection);
		getSelect2('pd_nationality','<?php echo base_url("get_nationalities"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Nationality', formatRepoCommon,no_nationality_msg, false, formatRepoSelection);
        getSelect2('bloodgroups','<?php echo base_url("get_bloodgroups"); ?>?sort_by=blood_grp_id&sort_order=asc'+url_edit,'Select Blood Groups', formatRepoCommon,no_blood_grp_msg, false, formatRepoSelection);
   		getSelect2('phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);

   		getSelect2('pd_title','<?php echo base_url("get_gender_title"); ?>?is_lookup_master=1'+url_edit,'Select Gender Title', formatRepoCommon,no_gender_title_msg, false, formatRepoSelection);
		
		getSelect2('pd_gender','<?php echo base_url("get_gender"); ?>?is_lookup_master=1'+url_edit,'Select Gender', formatRepoCommon,no_gender_msg, false, formatRepoSelection);
		
		getSelect2('pd_blood_group','<?php echo base_url("get_bloodgroups"); ?>?sort_by=blood_grp_id&sort_order=asc'+url_edit,'Select Blood Groups', formatRepoCommon,no_blood_group_msg, false, formatRepoSelection);

		getSelect2('pd_religion','<?php echo base_url("get_religions"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Religions', formatRepoCommon,no_religions_msg, false, formatRepoSelection);
		
		getSelect2('pd_medium_of_instruction','<?php echo base_url("get_mother_tongues"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Medium Of Instruction', formatRepoCommon,no_medium_of_instruction_msg, false, formatRepoSelection);

		getSelect2('pd_hostel_accommodation','<?php echo base_url("get_hostel_accommodation"); ?>?sort_by=name&sort_order=asc+url_edit','Select Hostel Accommodation', formatRepoCommon,no_hostel_accommodation_msg, false, formatRepoSelection);

		getSelect2('pd_mother_tongue','<?php echo base_url("get_mother_tongues"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Mother Tongues', formatRepoCommon,no_mother_tongues_msg, false, formatRepoSelection);
		
		getSelect2('pd_advertisement_source','<?php echo base_url("get_advertisement_source"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Advertisement Source', formatRepoCommon,no_advertisement_source_msg, false, formatRepoSelection);

		getSelect2('pd_social_status','<?php echo base_url("get_social_status"); ?>?is_lookup_master=1'+url_edit,'Select Social Status', formatRepoCommon,no_social_status_msg, false, formatRepoSelection);

		getSelect2('pd_diffrently_abled','<?php echo base_url("get_are_you_differently_abled"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Differently Abled', formatRepoCommon,no_differently_abled_msg, false, formatRepoSelection);

        getSelect2('pd_father_title','<?php echo base_url("get_parent_title"); ?>?is_lookup_master=1&is_father=1'+url_edit,'Select Title', formatRepoCommon,no_title_msg, false, formatRepoSelection);
		
		getSelect2('pd_father_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);		
		
		getSelect2('pd_father_occupation','<?php echo base_url("parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Father Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);

		getSelect2('pd_mother_title','<?php echo base_url("get_mother_title"); ?>?is_lookup_master=1&is_mother=1'+url_edit,'Select Title', formatRepoCommon,no_title_msg, false, formatRepoSelection);
		
		getSelect2('pd_mother_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc+url_edit','Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);

		getSelect2('pd_mother_alt_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
		
		getSelect2('pd_father_alt_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);	
		
		getSelect2('pd_mother_occupation','<?php echo base_url("parent_occupation"); ?>?sort_by=name&sort_order=asc','Select Mother Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);
		
		getSelect2('pd_guardian_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>	?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
		getSelect2('pd_guardian_phone_no_code2','<?php echo base_url("get_mobile_codes"); ?>	?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
		
		getSelect2('pd_guardian_occupation','<?php echo base_url("parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Guardian Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);
		getSelect2('pd_guardian_occupation2','<?php echo base_url("parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Guardian Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);
		getSelect2('guardian_relationship_1','<?php echo base_url("relationships"); ?>?is_lookup_master=29'+url_edit,'Select', formatRepoCommon,no_relationship, false, formatRepoSelection);
		getSelect2('guardian_relationship_2','<?php echo base_url("relationships"); ?>?is_lookup_master=29'+url_edit,'Select', formatRepoCommon,no_relationship, false, formatRepoSelection);
			
		getSelect2('country_addr','<?php echo base_url("get_countries"); ?>?sort_by=country_id&sort_order=asc'+url_edit,'Select Country', formatRepoCommon,no_country_msg, false, formatRepoSelection);	
	
		getSelect2('academic_board','<?php echo base_url("get_board"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Board', formatRepoCommon,no_board_msg, false, formatRepoSelection);
		
	    getSelect2('academic_marking_scheme','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Select Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
		getSelect2('academic_twelfth_board','<?php echo base_url("get_board"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Board', formatRepoCommon,no_board_msg, false, formatRepoSelection);
		getSelect2('academic_marking_scheme_twelfth','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Select Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
		getSelect2('academic_stream','<?php echo base_url("get_streams"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select', formatRepoCommon,no_stream_msg, false, formatRepoSelection);		

	   //ug
      	getSelect2('university_ug','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select University', formatRepoCommon,no_institute_university_msg, false, formatRepoSelection);
		getSelect2('BankName','<?php echo base_url("get_banks"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Bank', formatRepoCommon,no_banks_msg, false, formatRepoSelection);

	   getSelect2('is_work_experience','<?php echo base_url("get_is_work_experience_status"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select', formatRepoCommon,no_is_work_experience_msg, false, formatRepoSelection);
	   getSelect2('is_employed','<?php echo base_url("get_is_work_experience_status"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select', formatRepoCommon,no_is_work_experience_msg, false, formatRepoSelection);
  
		//fetch education from india
		var edu_from_india = "studied_from_india";
   		var db_edu_from_india = '<?php echo $qualifyingexamfromindia;?>';

   		if(db_edu_from_india=='f'){
   			var db_edu_from_indiaVal = 'Select Status Yes or No';
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
		//fetch parent detail
		<?php
		if($applicant_parent_details_list) {
               foreach($applicant_parent_details_list as $k=>$v) {
                   $parent_type_id = $v['parent_type_id'];
                   if($parent_type_id==PARENT_TYPE_ID_GUARDIAN){
                       $level=$v['parent_type_level_id'];
                       $gard_occupation[$level] = $v['occupation_id'];
                       $gard_occupation_name[$level] = $v['occupation_name'];
                       $gard_mob_country_code_id[$level] = $v['mob_country_code_id'];
                       $gard_country_mob_code[$level] = $v['country_mob_code'];
                       $gard_alt_mob_countrycode_id[$level] = $v['alt_mob_countrycode_id'];
                       $gard_alt_mob_country_code[$level] = $v['alt_mob_country_code'];
                       $gard_alt_mobile_no[$level]= $v['alt_mobile_no'];
                       $gard_relationship_id[$level]= $v['relationship_id'];
                       $gard_relationship_name[$level]= $v['relationship_name'];
                   }
                   else
                   {
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
                    if($gard_occupation) {
                        foreach($gard_occupation as $k=>$v) {
                       	if($k == 1) {
                       		$input_name = 'pd_guardian_occupation';
                       	} else if ($k == 2) {
                       		$input_name = 'pd_guardian_occupation2';
                       	} else {
                       		$input_name = 'pd_guardian_occupation3';
                       	}
                   ?>          
                           var occupation<?php echo $k; ?> = '<?php echo $input_name; ?>';
                           var occupation_id<?php echo $k; ?> = '<?php echo $v; ?>';
                           var occupation_name<?php echo $k; ?> = '<?php echo $gard_occupation_name[$k]; ?>';
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
               if($gard_relationship_id) {
                   foreach($gard_relationship_id as $k=>$v) {
                  	if($k == 1) {
                  		$input_name = 'guardian_relationship_1';
                  	} else if ($k == 2) {
                  		$input_name = 'guardian_relationship_2';
                  	} else {
                  		$input_name = 'guardian_relationship_3';
                  	}
              ?>          
              var relationship<?php echo $k; ?> = '<?php echo $input_name; ?>';
              var relationship_id<?php echo $k; ?> = '<?php echo $v; ?>';
              var relationship_name<?php echo $k; ?> = '<?php echo $gard_relationship_name[$k]; ?>';
              if(relationship_id<?php echo $k; ?>){
                  setTimeout(function(){ select2Set(relationship<?php echo $k; ?>,relationship_id<?php echo $k; ?>,relationship_name<?php echo $k; ?>);
                  	$('#'+relationship<?php echo $k; ?>).trigger('change');
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
            $('#add_guardian2_checkbox').prop('checked', true);
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
    			var dbstate_val = '<?php echo $applicant_address_details_list['state_name']; ?>';
    			if(dbstate_id){
    				setTimeout(function(){ select2Set(state_id,dbstate_id,dbstate_val);
    				}, 1);
    			}
    
    			var district_id = "district_addr";
    			var dbdistrict_id = '<?php echo $applicant_address_details_list['district_id']; ?>';
    			var dbdistrict_val = '<?php echo $applicant_address_details_list['district_name']; ?>';
    			if(dbdistrict_id){
    				setTimeout(function(){ select2Set(district_id,dbdistrict_id,dbdistrict_val);
    				}, 1);
    			}
    
    			var city_id = "city_addr";
    			var dbcity_id = '<?php echo $applicant_address_details_list['city_id']; ?>';
    			var dbcity_val = '<?php echo $applicant_address_details_list['city_name']; ?>';
    			
    			 if(dbcity_id){
    				setTimeout(function(){ select2Set(city_id,dbcity_id,dbcity_val);
    				}, 1);
    			}
			}
		//end fetch address
		
           
		//fetch academic detail
         <?php		
		//fetch school detail
		if(isset($applicant_schooling_list)){
		    foreach($applicant_schooling_list as $school){
		        $schooltype="";
		        if($school['schooling_id']==SCHOOLING_ID_TENTH || SCHOOLING_ID_EIGHTH || SCHOOLING_ID_NINTH){
		            $schooltype="tenth";
		        }
		        if($school['schooling_id']==SCHOOLING_ID_ELEVENTH){
		            $schooltype="eleven";
		        }
		        if($school['schooling_id']==SCHOOLING_ID_TWELFTH){
		            $schooltype="twelfth";
		        }
		        
		        $schooltypename=strtolower($schooltype);
		        ${ "board_id_".$schooltypename}=$school['board_id'];
		        ${ "board_name_".$schooltypename}=$school['board_name'];
		        ${ "marking_scheme_id_".$schooltypename}=$school['marking_scheme_id'];
		        ${ "marking_scheme_name_".$schooltypename}=$school['marking_scheme_name'];
		        ${ "completion_year_".$schooltypename}=$school['completion_year'];
		        ${ "high_edu_".$schooltypename}=$school['schooling_id'];
		        
		    }
		}
		$board_id_tenth = isset($board_id_tenth) ? $board_id_tenth:'';
		$board_name_tenth = isset($board_name_tenth) ? $board_name_tenth:'Select';
		$marking_scheme_id_tenth = isset($marking_scheme_id_tenth)? $marking_scheme_id_tenth : '';
		$marking_scheme_name_tenth = isset($marking_scheme_name_tenth) ? $marking_scheme_name_tenth : 'Select';
		$completion_year_tenth = isset($completion_year_tenth) ? $completion_year_tenth : '';
		$high_edu_tenth = isset($high_edu_tenth) ? $high_edu_tenth : '';
		
		// Schooling Detail Get Twelfth
		$board_id_twelfth = isset($board_id_twelfth) ? $board_id_twelfth:'';
		$board_name_twelfth = isset($board_name_twelfth) ? $board_name_twelfth:'Select';
		$marking_scheme_id_twelfth = isset($marking_scheme_id_twelfth)? $marking_scheme_id_twelfth : '';
		$marking_scheme_name_twelfth = isset($marking_scheme_name_twelfth) ? $marking_scheme_name_twelfth : 'Select';
		$completion_year_twelfth = isset($completion_year_twelfth) ? $completion_year_twelfth : '';
		$high_edu_twelfth = isset($high_edu_twelfth) ? $high_edu_twelfth : '';
		
		
		//fetch graduation details
		if($applicant_graduations_list) {
		    foreach($applicant_graduations_list as $k=>$v) {
		        $graduation_type_id = $v['graduation_type_id'];
		        if($graduation_type_id==GRADUATION_UG_ID){
		            $graduationtype="ug";
		        }
		        if($graduation_type_id==GRADUATION_PG_ID){
		            $graduationtype="pg";
		        }
		        
		        $graduatioName=strtolower($graduationtype);
		        ${ "mark_scheme_id_".$graduatioName}=$v['mark_scheme_id'];
		        ${ "mark_scheme_name_".$graduatioName}=$v['mark_scheme_name'];
		        ${ "univ_id_".$graduatioName}=$v['univ_id'];
		        ${ "univ_name_".$graduatioName}=$v['univ_name'];
		        ${ "result_declared_".$graduatioName}=$v['result_declared'];
		        ${ "is_curr_qualify_".$graduatioName}=$v['is_curr_qualify'];
		    }
		}
		$mark_scheme_id_ug = isset($mark_scheme_id_ug) ? $mark_scheme_id_ug : '';
		$mark_scheme_name_ug=isset($mark_scheme_name_ug) ? $mark_scheme_name_ug : 'Select';
		$univ_id_ug=isset($univ_id_ug) ? $univ_id_ug : '';
		$univ_name_ug=isset($univ_name_ug) ? $univ_name_ug : 'Select';
		$result_declared_ug = isset($result_declared_ug) ? $result_declared_ug : '';
		$is_curr_qualify_ug=isset($is_curr_qualify_ug) ? $is_curr_qualify_ug : '';
		?>

		<?php			
    	 if(!empty($after_tenth_quali_id)){			    
    	     if($after_tenth_quali_id == QUAL_TWELFTH) {
    	         ?>
	            $('.twelfthsheet').show();
				$('#twelvfth_marksheet').attr('data-parsley-required',"true");
      		   <?php 
      		   if(isset($docs[$document_id_twelvfth_marksheet])) { ?>
      		   $('#twelvfth_marksheet').attr('data-parsley-required',"false");
               <?php } ?>
                $("#edu_twelfth").trigger('click');
               <?php
    	     } else if($after_tenth_quali_id == QUAL_DIPLOMA) {
            	?>
            	$('.twelfthsheet').hide();
            	$("#edu_diploma").trigger('click');
            	<?php
    	     }else{
    	         ?>
    	         $("#edu_both").trigger('click');
    	         <?php
    	     }
    	} 
    	?>

		var board_id = "academic_board";
		var dbboard_id = '<?php echo $board_id_tenth ?>';		
		var dbboard_val = '<?php echo $board_name_tenth ?>';		
		 if(dbboard_id){
			setTimeout(function(){ select2Set(board_id,dbboard_id,dbboard_val);
			}, 1);
		}

		var boardtth_id = "academic_twelfth_board";
		var dbboardtth_id = '<?php echo $board_id_twelfth; ?>';		
		var dbboardtth_val = '<?php echo $board_name_twelfth; ?>';		
		 if(dbboardtth_id){
			setTimeout(function(){ select2Set(boardtth_id,dbboardtth_id,dbboardtth_val);
			}, 1);
		}
		
		
		var mscheme_id = "academic_marking_scheme";
		var dbmscheme_id = '<?php echo $marking_scheme_id_tenth; ?>';
		var dbmscheme_val = '<?php echo $marking_scheme_name_tenth; ?>';
		if(dbmscheme_id){
			setTimeout(function(){ select2Set(mscheme_id,dbmscheme_id,dbmscheme_val);
			}, 1);
		}
		
		var mschemetwfth_id = "academic_marking_scheme_twelfth";
		var dbmschemetwfth_id = '<?php echo $marking_scheme_id_twelfth ?>';
		var dbmschemetwfth_val = '<?php echo $marking_scheme_name_twelfth; ?>';
		if(dbmschemetwfth_id){
			setTimeout(function(){ select2Set(mschemetwfth_id,dbmschemetwfth_id,dbmschemetwfth_val);
			}, 1);
		}

		
 		//ug univ
        var univ_ug_id = "university_ug";
        var dbuniv_ug_id  = '<?php echo $univ_id_ug; ?>';
        var dbuniv_ug_val = '<?php echo $univ_name_ug; ?>';	
        if(dbuniv_ug_id){
        setTimeout(function(){ select2Set(univ_ug_id,dbuniv_ug_id,dbuniv_ug_val);
        }, 1);
        }
 		
		//end fetch academic detail
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
		$('#is_work_experience').on('change',function(){
			var is_work_experience = $('#is_work_experience').val();
			var val = (is_work_experience == 'yes')?true:false;
			chk_work_experience(val);
		});	
		
	    //general functions
	    function chk_work_experience(val) {    	
    	if(val) {
			$('#organisation_name_0').attr('data-parsley-required','true');
			$('#designation_0').attr('data-parsley-required','true');
			$('#job_nature_0').attr('data-parsley-required','true');
			$('#total_salary_month_0').attr('data-parsley-required','true');
			$('#from_year_0').attr('data-parsley-required','true');
			$('#to_year_0').attr('data-parsley-required','true');
			$('#work_experience_0').attr('data-parsley-required','true');
			$('#emp_exp').show();
			$('#emp_total_exp').show();
		} else {
			$('#organisation_name_0').attr('data-parsley-required','false');
			$('#designation_0').attr('data-parsley-required','false');
			$('#job_nature_0').attr('data-parsley-required','false');
			$('#total_salary_month_0').attr('data-parsley-required','false');
			$('#from_year_0').attr('data-parsley-required','false');
			$('#to_year_0').attr('data-parsley-required','false');
			$('#work_experience_0').attr('data-parsley-required','false');
			$('#emp_exp').hide();
			$('#emp_total_exp').hide();
		}
    }
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
				$("#pd_social_status").prepend("<option value=''>Select Community</option>").val('');
				getSelect2('pd_social_status','<?php echo base_url("get_social_status"); ?>?is_lookup_master=1'+url_edit,'Select Community', formatRepoCommon,no_social_status_msg, false, formatRepoSelection);
				$("#main_div_social_status").show();
			}else{
				setEmptyOnChangeSelect2('pd_social_status');
				if ($('#pd_social_status').data('select2')) {
					$('#pd_social_status').select2('destroy');
				}
				$('#pd_social_status').html('');
				$("#main_div_social_status").hide();
			}
		});	

        // Show Father & Mother Input
		show_parents_detail('pd_father_title','father_mbleno_div','father_email_div','father_occupation_div','father_alt_mbleno_div',);
		show_parents_detail('pd_mother_title','mother_mbleno_div','mother_email_div','mother_occupation_div','mother_alt_mbleno_div');
		
		show_other_element('pd_father_occupation','father_other_occupation_div',otheroccupation);
		show_other_element('pd_mother_occupation','mother_other_occupation_div',otheroccupation);
		show_other_element('pd_guardian_occupation','guardian_other_occupation_div',otheroccupation);
		show_other_element('pd_guardian_occupation2','guardian_other_occupation_div2',otheroccupation);
		
		$('#add_guardian2_checkbox').on('change',function(){
			chk_guardian($(this).is(':checked'));
		});
		
		//new
		validate_cgpa('academic_marking_scheme','academic_obtain_cgpa');
		validate_cgpa('academic_marking_scheme_eleven','academic_obtain_cgpa_eleven');
		validate_cgpa('academic_marking_scheme_twelfth','academic_obtain_cgpa_twelfth');
		validate_cgpa('user_marking_scheme_ug','obtained_percentage_cgpa_ug');
		validate_cgpa('user_marking_scheme_pg','obtained_percentage_cgpa_pg');
		
		//end new

		// Onchange COuntry
		$('#country_addr').on('change',function() {
			setEmptyOnChangeSelect2('state'); 
			// when no values return in json, add empty option value 
			if ($('#state_addr').data('select2')) {$('#state_addr').select2('destroy');}
			// make empty
			$('#state_addr').html('');
			var country_val = $(this).val();
			var url = '<?php echo base_url("get_states"); ?>?country_id='+country_val+	'&sort_by=id&sort_order=asc'+url_edit;
			onchange_country('main_div_state','main_div_district','main_div_city','state_addr','city_addr','district_addr',url,no_state_msg,country_value_default,country_val)
		});	
			
		// Onchange State
		$('#state_addr').on('change',function() {
			setEmptyOnChangeSelect2('district');
			// when no values return in json, add empty option value 
			if ($('#district_addr').data('select2')) {
				$('#district_addr').select2('destroy');
				$('#district_addr,#city_addr').html(''); 	
			}			
			// make empty
					
			var state_val = $(this).val();
			var country_val = $('#country_addr').val();
			var url = '<?php echo base_url("get_district"); ?>?state_id='+state_val+'&sort_by=id&sort_order=asc'+url_edit;
			if(country_value_default==country_val){	
				$('#main_div_district').show();
				getSelect2('district_addr',url,'Select District', formatRepoCommon,no_district_msg, false, formatRepoSelection);
			}
		});	
		
		// Onchange District
		$('#district_addr').on('change',function() {
			setEmptyOnChangeSelect2('city');
			// when no values return in json, add empty option value 
			if ($('#city_addr').data('select2')) {$('#city_addr').select2('destroy');}			
			// make empty
			$('#city_addr').html(''); 			
			var state_val = $('#state_addr').val();
			var country_val = $('#country_addr').val();
			if(country_value_default==country_val){	
				$('#main_div_city').show();
				getSelect2('city_addr','<?php echo base_url("get_cities"); ?>?state_id='+state_val+'&sort_by=id&sort_order=asc'+url_edit,'Select City', formatRepoCommon,no_city_msg, false, formatRepoSelection);
			}
		});	
		
		
		$('#academic_board').on('change',function() {
			var academic_boardid = $("#academic_board").val();			
			if(academic_boardid==otherboard){
				$("#other_board1").show();
			}else{
				$("#other_board1").hide();
			}
		});
		$('#academic_twelfth_board').on('change',function() {
			var academic_twelfth_boardid = $("#academic_twelfth_board").val();
			if(academic_twelfth_boardid==otherboard){
				$("#other_board2").show();
			}else{
				$("#other_board2").hide();
			}
		});
		$('#university_ug').on('change',function() {
			var university_ugid = $("#university_ug").val();
			
			 if(university_ugid==otheruniversity){
				$("#other_univ_ug").show();
			}else{
				$("#other_univ_ug").hide();
			} 
		});
		
		var is_work_experience = "is_work_experience";
		var is_work_experience_select = '<?php echo $is_work_experience_select; ?>';
		var is_work_experience_select_name = '<?php echo $is_work_experience_select_name; ?>';
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

    	var is_employed = "is_employed";
		var is_employed_select = '<?php echo $is_employed_select; ?>';
		var is_employed_select_name = '<?php echo $is_employed_select_name; ?>';
		if(is_employed_select != ''){
			setTimeout(function(){ select2Set(is_employed,is_employed_select,is_employed_select_name);
				$('#'+is_work_experience).trigger('change');
			}, 1);
		}
		 
		$("#academic_yr_passing").datepicker( {
			format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy'),startDate: '-40y',endDate: '+0d' 
        }).on('changeDate', function(e) {
			$("#academic_yr_passing").parsley().validate();			
    			var Yr=$("#academic_yr_passing").val();
                if(Yr!="" && Yr!="YYYY"){                
             	var addYr=2;
             	var setYr=parseInt(Yr)+addYr;
             	$("#academic_yr_passing_twelfth").attr("min",setYr);
             	$("#yr_passing_ug").attr("min",setYr);
         	}
        
		}); 

		$("#academic_yr_passing_twelfth").datepicker( {
			format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy'),startDate: '-40y',endDate: '+0d' 
        }).on('changeDate', function(e) {
			$("#academic_yr_passing_twelfth").parsley().validate();
		}); 

		$("#yr_passing_ug").datepicker( {
			format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy'),startDate: '-40y',endDate: '+0d' 
        }).on('changeDate', function(e) {
			$("#yr_passing_ug").parsley().validate();
		});	
		
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
			enable_saveExit_btn('<?php echo $startIndex;?>',5);
			<?php
			 // on load preview button
			if($startIndex) {
			?>
			setTimeout(function() { 
				if(parseInt(total_wizard_Step-1) == <?php echo $startIndex; ?>) {
					$("#save_exit").remove();
					 if(mode_edit_url !='')
				        {
				          enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>afih_preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
				        }else{
					    enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>afih_preview');
				        }
				}
			},1);
			//check payment button
			var curIndex='<?php echo $startIndex;?>';
			if(curIndex==4){
				$(".actions ul > li:nth-child(2) a").text('<?php echo MAKE_PAYMENT; ?>');
			}else{
				$(".actions ul > li:nth-child(2) a").text('<?php echo NEXT_STEP; ?>');
			}
			<?php
			}
			?>
			select2load('BankName','<?php echo $applicant_payment_details_list['bank_id']; ?>','<?php echo $applicant_payment_details_list['bank_name']; ?>');
			 $("#from_year_0, #from_year_1, #from_year_2,#from_year_3, #from_year_4, #from_year_5, #to_year_0, #to_year_1, #to_year_2,#to_year_3, #to_year_4, #to_year_5").datepicker( {
		            format:"mm/yyyy" , autoclose: !0, minViewMode: 'months', endDate: moment().format('dd-mm-yyyy')
		        }).on('changeDate', function(e) {
						$(this).parsley().validate();
				});	;
		        

		        calculate_months('work_experience_0','from_year_0','to_year_0','months');
		        calculate_months('work_experience_1','from_year_1','to_year_1','months');
		        calculate_months('work_experience_2','from_year_2','to_year_2','months');
		        calculate_months('work_experience_3','from_year_3','to_year_3','months');
		        calculate_months('work_experience_4','from_year_4','to_year_4','months');
		        calculate_months('work_experience_5','from_year_5','to_year_5','months');
				
				calculate_total_exp('months');
		//end functions
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
			format:"dd/mm/yyyy" ,autoclose: true,todayHighlight: true,endDate: endDob
		}).on('changeDate', function(e) {
				$("#pd_dob").parsley().validate();
		});
		$("#crri_comp_date").datepicker( {
			format:"dd/mm/yyyy" ,autoclose: true,todayHighlight: true,endDate: todaydate,
		}).on('changeDate', function(e) {
				$("#crri_comp_date").parsley().validate();
		});
		$("#reg_date").datepicker( {
			format:"dd/mm/yyyy" ,autoclose: true,todayHighlight: true,endDate: todaydate,
		}).on('changeDate', function(e) {
				$("#reg_date").parsley().validate();
		});
		$("#DDDate").datepicker( {
			format:"dd/mm/yyyy" ,autoclose: true,todayHighlight: true,endDate: todaydate, 
		}).on('changeDate', function(e) {
				$("#DDDate").parsley().validate();
		});	
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
	
      set_application_payment_info();
});

function chk_guardian(val) {	
	   if($("#add_guardian2_checkbox").is(':checked')){
		$('#add_guardian2_checkbox').val('true');
		$('#guardian_details2').show();
		$('#pd_guardian_name2').attr('data-parsley-required',"true");
		$('#pd_guardian_phone2').attr('data-parsley-required',"true");
		$('#pd_guardian_phone_no_code2').attr('data-parsley-required',"true");
		$('#pd_guardian_email2').attr('data-parsley-required',"true");
		$('#pd_guardian_occupation2').attr('data-parsley-required',"true");
		$("#pd_guardian_phone2").attr('data-parsley-mobileonly','true');
		} else {
		$('#add_guardian2_checkbox').val('false');
		$('#guardian_details2').hide();
		$('#pd_guardian_name2').attr('data-parsley-required',"false");
		$('#pd_guardian_phone2').attr('data-parsley-required',"false");
		$('#pd_guardian_phone_no_code2').attr('data-parsley-required',"false");
		$('#pd_guardian_email2').attr('data-parsley-required',"false");
		$('#pd_guardian_occupation2').attr('data-parsley-required',"false");
		$("#pd_guardian_phone2").removeAttr('data-parsley-mobileonly');
	}
}
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
		var parsley_required=false;
		if(file_doc_type=="photograph" || file_doc_type=="signature" || file_doc_type=="tenth_marksheet"){
			parsley_required=true;
		}
		<?php 
		if($after_tenth_quali_id == QUAL_TWELFTH) {	
	    ?>
	    if(file_doc_type=="twelvfth_marksheet"){
	      parsley_required=true;
	    }
	    <?php } ?>
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
			  //console.log(returndata);
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
	if(required=="" && required!="true" && required!=true)
	{
		required="false";
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
		  console.log(returndata); 
		},
	});                 

	return AjaxRequest; 
}

//end upload
</script>