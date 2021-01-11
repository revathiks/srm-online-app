<?php
//Constant Value
$country_value_default = COUNTRY_VALUE_DEFAULT;
$parent_type_id_father = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
$form_wizard_payment_id = FORM_WIZARD_PAYMENT_ID;

$startIndex = $this->input->get('startIndex',true);

$form_id = APP_FORM_ID_INTERNATIONAL;
$occupation_other_id = OCCUPATION_OTHER_ID;

$applicant_schooling_id  = $applicant_schooling_name = $applicant_institute_name = $applicant_board_id = $applicant_board_name = $applicant_marking_scheme_id = $applicant_marking_scheme_name = $applicant_obtained_percentage_cgpa = $applicant_year_of_passing = $applicant_registration_no =  $applicant_tenth_name = $applicant_mode_of_study_id = $applicant_mode_of_study_name = $applicant_address_of_school_college = $applicant_scl_det_id = $applicant_result_declared = $app_comp_exam_id = $app_comp_exam_name = $app_comp_registration_no =  $app_comp_score_obtained = $app_comp_max_score = $app_comp_exam_year = $app_comp_all_india_rank = $app_comp_qualified = $applicant_entr_exam_det_id = $applicant_scl_country_id = $applicant_scl_country_name = $applicant_scl_exam_id = $applicant_scl_exam_name = $applicant_scl_subject_id = $applicant_scl_subject_name= array();

/*Appln details Start*/
$is_agree = $applicant_appln_details_list['is_agree'];
$db_grade_id = $applicant_appln_details_list['grad_id'];
$db_grade_name = $applicant_appln_details_list['grad_name'];
/*Appln details End*/

/*Basic Details Start*/
$db_residing_country_id = $applicant_basic_details_list['residing_country_id'];
$db_residing_country_name = $applicant_basic_details_list['residing_country_name'];
$resident_category_id = $applicant_basic_details_list['resident_category_id'];
$resident_category_name = $applicant_basic_details_list['resident_category_name'];
$relation_sponser_id = $applicant_basic_details_list['sponsor_relationship_id'];
$relation_sponser_name = $applicant_basic_details_list['sponsor_relationship_name'];
$sponsor_name = $applicant_basic_details_list['sponsor_name'];

$nationality_id = $applicant_basic_details_list['nation_id'];
$nationality_name = $applicant_basic_details_list['nationality'];
$user_id = $applicant_basic_details_list['user_id'];
$tittle_id = $applicant_basic_details_list['tittle_id'];
$tittle_name = $applicant_basic_details_list['tittle_name'];
$first_name = $applicant_basic_details_list['f_name'];
$m_name = $applicant_basic_details_list['m_name'];
$last_name = $applicant_basic_details_list['l_name'];
$dob = $applicant_basic_details_list['dob'];
$dob=isset($dob)? date('d/m/Y',strtotime($dob)):'';
$blood_id = $applicant_basic_details_list['blood_id'];
$blood_group = $applicant_basic_details_list['blood_group'];
$mob_no = $applicant_basic_details_list['mob_no'];
$applicant_mob_country_code_id = $applicant_basic_details_list['applicant_mob_country_code_id'];
$reg_mob_country_code_id = $applicant_basic_details_list['reg_mob_country_code_id'];
$email_id = $applicant_basic_details_list['e_mail'];
$sec_mob_no = $applicant_basic_details_list['sec_mob_no'];
$sec_e_mail = $applicant_basic_details_list['sec_e_mail'];
$gender_id = $applicant_basic_details_list['gender_id'];
$gender = $applicant_basic_details_list['gender'];
$social_status_id = $applicant_basic_details_list['social_status_id'];
$social_status = $applicant_basic_details_list['social_status'];
$dif_abled = $applicant_basic_details_list['dif_abled'];

$religion_id = $applicant_basic_details_list['religion_id'];
$religion = $applicant_basic_details_list['religion_name'];
$medium_of_instruction_id = $applicant_other_details_list['medofinst'];
$medium_of_instruction = $applicant_other_details_list['medium_of_study_name'];
$add_gardian = $applicant_other_details_list['add_gardian'];
$hostel_accommodation_id = $applicant_basic_details_list['hostel_accommodation_id'];
$hostel_accommodation = $applicant_basic_details_list['hostel_accommodation'];

$mother_tongue_id = $applicant_basic_details_list['mothertongue_id'];
$mother_tongue = $applicant_basic_details_list['mothertongue_name'];

$advertisement_source_id = $applicant_basic_details_list['advertisement_source_id'];
$advertisement_source = $applicant_basic_details_list['source_name'];

$nad_id_digilocker_id = $applicant_basic_details_list['digilocker_id'];
/*Basic Details End*/

// Address Details Communication / Permanent
if($applicant_address_details_list) {
   foreach($applicant_address_details_list as $k=>$v) {
	  $addr_type_id = $v['addr_type_id'];
      $country_id[$addr_type_id] = $v['country_id'];
      $country_name[$addr_type_id] = $v['country_name'];
      $state_id[$addr_type_id] = $v['state_id'];
      $state_name[$addr_type_id] = $v['state_name'];
      $city_id[$addr_type_id] = $v['city_id'];
      $city_name[$addr_type_id] = $v['city_name'];
   }
}
$communication_look_up_value = LOOKUP_VALUE_ADDRESS_COMMUNICATION;
$communication_look_up_value_permanent = LOOKUP_VALUE_PERMANENT_ADDRESS_COMMUNICATION;


if($applicant_address_details_list){
	if(count($applicant_address_details_list)>1){
		$is_permanent_addr_same = 'f';
	}	
}
else{
	$is_permanent_addr_same = 't';
}

$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_tenth_grade = DOCUMENT_ID_TENTH_GRADE;
$document_id_twelvfth_grade = DOCUMENT_ID_TWELVFTH_GRADE;
$document_id_bachelors_marksheet = DOCUMENT_ID_BACHELORS_MARKSHEET;
$document_id_masters_marks_card = DOCUMENT_ID_MASTERS_MARKS_CARD;
$document_id_transcripts = DOCUMENT_ID_TRANSCRIPTS;
$document_id_other_document1 = DOCUMENT_ID_ADDITIONAL_QUALIFICATION;
$document_id_other_document2 = DOCUMENT_ID_OTHER_DOCUMENTS;

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
  		// $file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_tenth_grade == $document_id)?'tenth_grade':(($document_id_twelvfth_grade == $document_id)?'twelvfth_grade':''))));
  		$file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_tenth_grade == $document_id)?'tenth_grade':(($document_id_twelvfth_grade == $document_id)?'twelvfth_grade':(($document_id_bachelors_marksheet == $document_id)?'bachelors_marksheet':(($document_id_masters_marks_card == $document_id)?'masters_marks_card':(($document_id_transcripts == $document_id)?'transcripts':(($document_id_other_document1 == $document_id)?'other_document1':(($document_id_other_document2 == $document_id)?'other_document2':'')))))))));		
  		$parsley_required = (($document_id_photograph == $document_id)?'false':(($document_id_signature == $document_id)?'false':(($document_id_tenth_grade == $document_id)?'true':(($document_id_twelvfth_grade == $document_id)?'true':(($document_id_bachelors_marksheet == $document_id)?'true':(($document_id_masters_marks_card == $document_id)?'true':(($document_id_transcripts == $document_id)?'true':(($document_id_other_document1 == $document_id)?'true':(($document_id_other_document2 == $document_id)?'true':'')))))))));
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


if($applicant_course_prefer_details_list) {
   foreach($applicant_course_prefer_details_list as $k=>$v) {
      $applicant_course_id[] = $v['applicant_course_id'];
      //$applicant_course_course_id[] = $v['course_id'];
      $applicant_course_course_id[] = $v['branch_id'];
      $applicant_course_course_name[] = $v['course_name'];
      $applicant_course_choice_no[] = $v['choice_no'];
      $applicant_course_deg_id[] = $v['deg_id'];
      $applicant_course_deg_name[] = $v['deg_short_name'];
      $applicant_course_stream_id[] = $v['stream_id'];
      $applicant_course_stream_name[] = $v['stream_name'];
      $applicant_course_is_active[] = $v['is_active'];
   }
}

if($applicant_parent_details_list) {
   foreach($applicant_parent_details_list as $k=>$v) {
      $parent_type_id = $v['parent_type_id'];
      $app_parent_det_id[$parent_type_id] = $v['app_parent_det_id'];
      $applicant_parent_parent_type_name[$parent_type_id] = $v['parent_type_name'];
      $applicant_parent_parent_name[$parent_type_id] = $v['parent_name'];
      $applicant_parent_mobile_no[$parent_type_id] = $v['mobile_no'];
      $applicant_parent_email_id[$parent_type_id] = $v['email_id'];
      $applicant_parent_occupation[$parent_type_id] = $v['occupation'];
      $applicant_parent_mob_country_code_id[$parent_type_id] = $v['mob_country_code_id'];
      $applicant_parent_country_mob_code[$parent_type_id] = $v['country_mob_code'];
      $applicant_parent_alt_mob_countrycode_id[$parent_type_id] = $v['alt_mob_countrycode_id'];
      $applicant_parent_alt_mob_country_code[$parent_type_id] = $v['alt_mob_country_code'];
      $applicant_parent_alt_mobile_no[$parent_type_id] = $v['alt_mobile_no'];
      $applicant_parent_title[$parent_type_id] = $v['title'];
      $applicant_parent_other_occupation_name[$parent_type_id] = $v['other_occupation_name'];
      $applicant_parent_relationship_name[$parent_type_id] = $v['relationship_name'];
      $applicant_parent_relationship_id[$parent_type_id] = $v['relationship_id'];
      $applicant_parent_occupation_id[$parent_type_id] = $v['occupation_id'];
      $applicant_parent_occupation_name[$parent_type_id] = $v['occupation_name'];
   }
}

/*Schooling Details Start*/
if($applicant_schooling_details_list)
{
  foreach($applicant_schooling_details_list as $k=>$v)
  {
  $applicant_result_declared=$v['result_declared'];
  $applicant_schooling_id[] = $v['schooling_id'];
  $applicant_schooling_name[] = $v['schooling_name'];
  $applicant_institute_name[] = $v['inst_name'];
  $applicant_board_id[] = $v['board_id'];
  $applicant_board_name[] = $v['board_name'];
  $applicant_marking_scheme_id[] = $v['marking_scheme_id'];
  $applicant_marking_scheme_name[] = $v['marking_scheme_name'];
  $applicant_obtained_percentage_cgpa[] = $v['mark_percentage'];
  $applicant_year_of_passing[] = $v['completion_year'];
  $applicant_registration_no[] = $v['registration_no'];
  $applicant_tenth_name[] = $v['name_as_in_marksheet'];
  $applicant_mode_of_study_id[] = $v['mode_of_study_id'];
  $applicant_mode_of_study_name[] = $v['mode_of_study_name'];
  $applicant_address_of_school_college[] = $v['address'];
  $applicant_scl_det_id[]=$v['applicant_scl_det_id'];
  $applicant_scl_country_id[]=$v['country_id'];
  $applicant_scl_country_name[]=$v['country_name'];
  $applicant_scl_exam_id[]=$v['examination_id'];
  $applicant_scl_exam_name[]=$v['examination_name'];
  $applicant_scl_subject_id[]=$v['subject_id'];
  $applicant_scl_subject_name[]=$v['subject_name'];
  }
}

/* Payment Details Start */
$branch_name = $applicant_payment_details_list['branch_name'];
$dd_cheque_no = $applicant_payment_details_list['dd_cheque_no'];
$dd_cheque_date = $applicant_payment_details_list['dd_cheque_date'];
if($dd_cheque_date) {
  $dd_cheque_date = date('d/m/Y',strtotime($dd_cheque_date));
}
$payment_mode_id = $applicant_payment_details_list['payment_mode_id'];

/* Payment Details End */

/*Form Index Restriction Start*/
$start_wizard = 0;
$start_wizard_next = -1;
$next_step_allowed = '';
$start_wizard_next_allow='';
$appln_form_w_wizard_id = $applicant_appln_details_list['form_w_wizard_id'];
$current_wizard=$applicant_appln_details_list['wizard_id'];
$is_allow_previous=$this->config->item('is_allow_previous');
if($appln_form_w_wizard_id !='')
{
  $wizard_dt_complete_percentage = $appln_wizard_dt[0]['completion_percent'];
  //echo $wizard_dt_complete_percentage;die;
  foreach ($wizard_dt as $key => $value) {
    $w_wizard_id = $value['form_w_wizard_id'];
    $completion_percent = $value['completion_percent'];

    //echo $completion_percent;
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
if($next_step_allowed !="" && $current_wizard != FORM_WIZARD_PAYMENT_ID){ //Without StartIndex
  $startIndex = $next_step_allowed;
}
else if($startIndex <= $start_wizard_next && $start_wizard_next >=0 && $current_wizard !=FORM_WIZARD_PAYMENT_ID){ // StartIndex Lesser than Submit Form allow
  $startIndex = $startIndex;
}
else if($startIndex == $start_wizard_next_allow && $start_wizard_next >=0 && $current_wizard !=FORM_WIZARD_PAYMENT_ID){ // StartIndex next step once complete Current Tab
  $startIndex = $startIndex;
}
else if($current_wizard==FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) && $startIndex == 5) {
        $startIndex=$startIndex; //upload
}
else if($current_wizard==FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) && $startIndex == 6) {
        $startIndex=$startIndex; //upload
}
else if($current_wizard==FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) ) {
        $startIndex=5; //upload
}
else if($current_wizard==FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==1) && $startIndex <= $start_wizard_next_allow) {
        $startIndex = $startIndex;
}
else{
  $startIndex = 0;
}
} //Admin Means No restriction end
/*Form Index Restriction End*/

?>
<script type="text/javascript">
	var logged_applicant_id = '<?php echo $logged_applicant_id; ?>';
	var logged_applicant_login_id = '<?php echo $logged_applicant_login_id; ?>';
  var app_form_id = '<?php echo $form_id ;?>';	
  var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
    csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
  var crm_applicant_personal_det_id = '<?php echo $crm_applicant_personal_det_id ; ?>';
  var crm_applicant_login_id = '<?php echo $crm_applicant_login_id ; ?>';
  var mode_edit_val = '<?php echo ADMIN_MODE_EDIT ; ?>';
  var mode_edit_url = '<?php echo $mode_edit; ?>';
  /*CRM ADMIN Edit form start*/    
    <?php if($mode_edit) { ?>
      var url_edit = '&mode=edit'+'&applicant_personal_det_id='+crm_applicant_personal_det_id+'&applicant_login_id='+crm_applicant_login_id;
      var url = "<?php echo base_url(); ?>international_form/"+mode_edit_val+"/"+crm_applicant_login_id+"/"+crm_applicant_personal_det_id;
      var payment_url = '<?php echo base_url(); ?>user/payment_details?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;
      var save_exit_redirect_url = '<?php echo base_url(); ?>crm-admin/dashboard';
      //var upload_url = '<?php echo base_url(); ?>upload-file?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;     
    <?php } else { ?>
      var url_edit =  '';
      var url = "<?php echo base_url(); ?>international_form";
      var payment_url = '<?php echo base_url(); ?>user/payment_details';
       var save_exit_redirect_url = '<?php echo base_url(); ?>international_dashboard';
       //var upload_url = "<?php echo base_url(); ?>upload-file";
    <?php } ?>
    /*CRM ADMIN Edit form end*/
	$(document).ready(function () {
            'use strict';

      // Variable Defined start
    var no_gender_title_msg = "Sorry, Title not available.";
    var no_mobile_code_msg = "Sorry, Mobile code not available.";
    var no_gender_msg = "Sorry, Gender not available.";	
    var no_nationality_msg = "Sorry, Nationality not available.";
    var no_country_msg = "Sorry, Country not available.";    
    var no_resident_category = "Sorry, Resident Category not available.";
    var no_relationship_sponsor = "Sorry, Relationship Sponsor not available.";
    var no_program_level_msg = "Sorry , Program Level not available.";
    var no_stream_msg = "Sorry , Stream not available.";
    var no_degree_msg = "Sorry , Degree not available.";
    var no_course_msg = "Sorry , Course not available.";
    var no_spec_msg = "Sorry , Specialization not available.";
	var no_country_msg = "<?php echo NO_COUNTRY_MSG; ?>";
	var no_state_msg = "<?php echo NO_STATE_MSG; ?>";
	var no_city_msg = "<?php echo NO_CITY_MSG; ?>";	
	var no_occupation_msg = "Sorry, Occupation not available.";
    var occupation_other_id = '<?php echo $occupation_other_id; ?>';
    var no_examination_msg = "Sorry, Examination not available.";
    var no_user_marking_scheme_msg = "Sorry, Marking Scheme not available.";
    var no_subject_msg = "Sorry, Subject not available.";
    var no_banks_msg = "Sorry, Banks not available.";
    var redirect_thank = '<?php echo base_url()."thank_you"; ?>?app_form_id='+app_form_id;
    var payment_wizard_id = '<?php echo $form_wizard_payment_id; ?>';
    
    var redirect_payment_thank_you = '<?php echo base_url(); ?>user/payment_thank_you?app_form_id='+app_form_id+'&wizard_id='+payment_wizard_id+'&url='+encodeURIComponent(url);
    var get_percentage_url = '<?php echo base_url(); ?>get_international_percentage_w_tab?app_form_id='+app_form_id+url_edit;
   
    // Variable Defined End

    // Dynamically Get Total Wizard Steps
      var total_wizard_Step = $('.wizard_head_tag').length;
      $("#show_currentindex").html('<?php echo ($startIndex)?($startIndex+1):1; ?> of '+total_wizard_Step);
      setTimeout(function() {
  		enable_saveExit_btn('<?php echo $startIndex;?>',6);
  	 },1);
      <?php
       // on load preview button
      if($startIndex) {
      ?>
      setTimeout(function() { 
        if(parseInt(total_wizard_Step-1) == <?php echo $startIndex; ?>) {
        	$("#save_exit").remove();
        	//enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>international-form-preview');
          if(mode_edit_url != '')
          {
            enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>international-form-preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
          }else{
            enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>international-form-preview');
          }
        }
		var curIndex='<?php echo $startIndex;?>';
		if(curIndex==3){
			//$(".actions ul > li:nth-child(2) a").text('<?php echo MAKE_PAYMENT; ?>');
		}else{
			$(".actions ul > li:nth-child(2) a").text('<?php echo NEXT_STEP; ?>');
		} 
      },1);
      <?php
      }
      ?>

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
        //startIndex: 0,
        startIndex: <?php echo ($startIndex)?$startIndex:0; ?>,

        /* Transition Effects */
        transitionEffect: 'slide', //$.fn.steps.transitionEffect.none,
        transitionEffectSpeed: 200,

        /* Events */
        onStepChanging: function (event, currentIndex, newIndex) {
	        if(currentIndex < newIndex) {
					// Step 1 form validation
					if(currentIndex === 0) {
						var resident_category = $('#resident_category').parsley();
						var nrisponser_name = $('#nrisponser_name').parsley();
						var relation_sponser = $('#relation_sponser').parsley();
						var is_agree = $('#is_agree').parsley();
						if(resident_category.isValid() && nrisponser_name.isValid() && relation_sponser.isValid() && is_agree.isValid())
						{
							var resident_category_id_val = $('#resident_category').val();
							var sponsor_name_val = $('#nrisponser_name').val();
							var sponsor_relationship_id_val = $('#relation_sponser').val();
							var is_agree_val = $('#is_agree').val();
              var appln_status = $('#appln_status').val();
              var isexit = ($(this).attr('isexit'));
							var user_data = 'resident_category_id='+resident_category_id_val+'&sponsor_name='+sponsor_name_val+'&sponsor_relationship='+sponsor_relationship_id_val+'&is_agree='+is_agree_val+'&'+csrfName+'='+csrfHash+'&appln_status='+appln_status;
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
                    if(isexit==1){
                                  window.location.href = save_exit_redirect_url;
                                  return false;
                            }else {
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
                  $('.loader').hide();					  
								  return false; 
							},
						});	
						if(moveNxt){
								return true;
							}

						}
						else
						{
							resident_category.validate();
							nrisponser_name.validate();
							relation_sponser.validate();
							is_agree.validate();
              $(this).attr('isexit','');
						}
					}
					// Step 2 form validation
					if(currentIndex === 1) 
					{
						// Course Prefer
						var program_level = $('#program_level').parsley();
						var stream_id_pref1 = $('#stream_id_pref1').parsley();
						var deg_id_pref1 = $('#deg_id_pref1').parsley();
						var course_id_pref1 = $('#course_id_pref1').parsley();
						var spec_id_pref1 = $('#spec_id_pref1').parsley();

						/*var stream_id_pref2 = $('#stream_id_pref2').parsley();
						var deg_id_pref2 = $('#deg_id_pref2').parsley();
						var course_id_pref2 = $('#course_id_pref2').parsley();
						var spec_id_pref2 = $('#spec_id_pref2').parsley();

						var stream_id_pref3 = $('#stream_id_pref3').parsley();
						var deg_id_pref3 = $('#deg_id_pref3').parsley();
						var course_id_pref3 = $('#course_id_pref3').parsley();
						var spec_id_pref3 = $('#spec_id_pref3').parsley();*/

						//personal
						var pd_title = $('#pd_title').parsley();
						var pd_firstname = $('#pd_firstname').parsley();
						var pd_middlename = $('#pd_middlename').parsley();
						var pd_lastname = $('#pd_lastname').parsley();
						var pd_mobile_no =$('#pd_mobile_no').parsley();
						var pd_email = $('#pd_email').parsley();
						var pd_dob = $('#pd_dob').parsley();
						var pd_gender = $('#pd_gender').parsley();
						var pd_nationality=$('#pd_nationality').parsley();
						var residing_country_id =$('#residing_country_id').parsley();
						if(pd_title.isValid() && pd_firstname.isValid() && pd_middlename.isValid() && pd_lastname.isValid() && pd_mobile_no.isValid() && pd_email.isValid() && pd_dob.isValid() && pd_gender.isValid() && pd_nationality.isValid() && residing_country_id.isValid() && program_level.isValid() && stream_id_pref1.isValid() && deg_id_pref1.isValid() && course_id_pref1.isValid() && spec_id_pref1.isValid() ){

							/*&& stream_id_pref2.isValid() && deg_id_pref2.isValid() && course_id_pref2.isValid() && spec_id_pref2.isValid() && stream_id_pref3.isValid() && deg_id_pref3.isValid() && course_id_pref3.isValid() && spec_id_pref3.isValid()*/
									
							//Course prefer
							var program_level_val = $('#program_level').val();
							var stream_id_pref1_val = $('#stream_id_pref1').val();
							var deg_id_pref1_val = $('#deg_id_pref1').val();
							var course_id_pref1_val = $('#course_id_pref1').val();
							var spec_id_pref1_val = $('#spec_id_pref1').val();

							var stream_id_pref2_val = $('#stream_id_pref2').val();
							var deg_id_pref2_val = $('#deg_id_pref2').val();
							var course_id_pref2_val = $('#course_id_pref2').val();
							var spec_id_pref2_val = $('#spec_id_pref2').val();

							var stream_id_pref3_val = $('#stream_id_pref3').val();
							var deg_id_pref3_val = $('#deg_id_pref3').val();
							var course_id_pref3_val = $('#course_id_pref3').val();
							var spec_id_pref3_val = $('#spec_id_pref3').val();

							var course_choice_no_1 = $('#course_choice_no_1').val();
							var course_prefer_id_1 = $('#course_prefer_id_1').val();
							var course_choice_no_2 = $('#course_choice_no_2').val();
							var course_prefer_id_2 = $('#course_prefer_id_2').val();
							var course_choice_no_3 = $('#course_choice_no_3').val();
							var course_prefer_id_3 = $('#course_prefer_id_3').val();


							var title_id_val = $('#pd_title').val();
							var first_name_val = $('#pd_firstname').val();
							var middle_name_val = $('#pd_middlename').val();
							var last_name_val = $('#pd_lastname').val();
							var mobile_no_val = $('#pd_mobile_no').val();
							var email_id_val = $('#pd_email').val();
							var dob_val = $('#pd_dob').val();
							var gender_id_val= $('#pd_gender').val();
							var nationality_id_val= $('#pd_nationality').val();
							var residing_country_id = $('#residing_country_id').val();
							var phone_no_code = $('#phone_no_code').val();
              var isexit = ($(this).attr('isexit'));
							var user_data ='title_id='+title_id_val+'&first_name='+first_name_val+'&middle_name='+middle_name_val+'&last_name='+last_name_val+'&mobile_no='+mobile_no_val+'&email_id='+email_id_val+'&pd_dob='+dob_val+'&gender_id='+gender_id_val+'&nationality_id='+nationality_id_val+'&phone_no_code='+phone_no_code+'&program_level='+program_level_val+'&stream_id_pref1='+stream_id_pref1_val+'&deg_id_pref1='+deg_id_pref1_val+'&course_id_pref1='+course_id_pref1_val+'&spec_id_pref1='+spec_id_pref1_val+'&stream_id_pref2='+stream_id_pref2_val+'&deg_id_pref2='+deg_id_pref2_val+'&course_id_pref2='+course_id_pref2_val+'&spec_id_pref2='+spec_id_pref2_val+'&stream_id_pref3='+stream_id_pref3_val+'&deg_id_pref3='+deg_id_pref3_val+'&course_id_pref3='+course_id_pref3_val+'&spec_id_pref3='+spec_id_pref3_val+'&course_prefer_id_1='+course_prefer_id_1+'&course_prefer_id_2='+course_prefer_id_2+'&course_prefer_id_3='+course_prefer_id_3+'&course_choice_no_1='+course_choice_no_1+'&course_choice_no_2='+course_choice_no_2+'&course_choice_no_3='+course_choice_no_3+'&residing_country_id='+residing_country_id+'&'+csrfName+'='+csrfHash;
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
                  $('.loader').hide();						  
								  return false; 
							},
						});	
										
						 if(moveNxt){
								return true;
							}
						}
						else {
							pd_title.validate();
							pd_firstname.validate();
							pd_middlename.validate();
							pd_lastname.validate();
							pd_mobile_no.validate();
							pd_email.validate();
							pd_dob.validate();
							pd_gender.validate();
							pd_nationality.validate();
							residing_country_id.validate();
							//Course
							program_level.validate();
							stream_id_pref1.validate();
							deg_id_pref1.validate();
							course_id_pref1.validate();
							spec_id_pref1.validate();
              $(this).attr('isexit','');

							/*stream_id_pref2.validate();
							deg_id_pref2.validate();
							course_id_pref2.validate();
							spec_id_pref2.validate();

							stream_id_pref3.validate();
							deg_id_pref3.validate();
							course_id_pref3.validate();
							spec_id_pref3.validate();*/
							return false;
				 		 }
					}
					// Step 3 form validation
					if(currentIndex === 2) 
					{
						var pd_father_name = $('#pd_father_name').parsley();
      					var pd_father_email = $('#pd_father_email').parsley();
      					var pd_father_phone = $('#pd_father_phone').parsley();
      					var pd_mother_name = $('#pd_mother_name').parsley();
      					var pd_mother_phone = $('#pd_mother_phone').parsley();
      					var pd_mother_email = $('#pd_mother_email').parsley();
      					var pd_guardian_name = $('#pd_guardian_name').parsley();
      					var pd_guardian_phone = $('#pd_guardian_phone').parsley();
      					var pd_guardian_email = $('#pd_guardian_email').parsley();
                  		var other_occupation_guardian = $('#other_occupation_guardian').parsley();
                  		var other_occupation_father = $('#other_occupation_father').parsley();
                  		var other_occupation_mother = $('#other_occupation_mother').parsley();
                  		var parent_relation_applicant = $('#parent_relation_applicant').parsley();
                  		check_visible_input_validation('other_occupation_guardian_div','other_occupation_guardian','<?php echo REQD_GUARDIAN_OTHER_OCCUPATION_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');
                  
                  		check_visible_input_nameonly_validation('other_occupation_father_div','other_occupation_father','<?php echo REQD_ALPHA_ONLY_MSG;?>');
                  
                  		check_visible_input_nameonly_validation('other_occupation_mother_div','other_occupation_mother','<?php echo REQD_ALPHA_ONLY_MSG;?>');
                  		 var is_parent_checked = false;
                  		 if($('#add_parent_checkbox').is(':checked')) {
                      		if(pd_father_name.isValid() && pd_father_phone.isValid() && pd_father_email.isValid() && pd_mother_name.isValid() && pd_mother_phone.isValid() && pd_mother_email.isValid()) {
                          	is_parent_checked = true;    
                     		 }
                  			} else {
                      		is_parent_checked = true;}

                      	if(is_parent_checked == true && pd_guardian_name.isValid() && pd_guardian_phone.isValid() && pd_guardian_email.isValid() && other_occupation_guardian.isValid() && other_occupation_father.isValid() && other_occupation_mother.isValid()) 
                      	{
                      		var pd_father_id = $('#pd_father_id').val();
        					var pd_father_name = $('#pd_father_name').val();
        					var pd_father_phone_no_code = $('#pd_father_phone_no_code').val();
        					var pd_father_phone = $('#pd_father_phone').val();
        					var pd_father_email = $('#pd_father_email').val();
        					var pd_father_occupation = $('#pd_father_occupation').val();
        					var pd_mother_id = $('#pd_mother_id').val();
        					var pd_mother_name = $('#pd_mother_name').val();
        					var pd_mother_phone_no_code = $('#pd_mother_phone_no_code').val();
        					var pd_mother_phone = $('#pd_mother_phone').val();
        				    var pd_mother_email = $('#pd_mother_email').val();
        					var pd_mother_occupation = $('#pd_mother_occupation').val();
        					var add_parent_checkbox = $('#add_parent_checkbox').val();
        					var pd_guardian_id = $('#pd_guardian_id').val();
        					var pd_guardian_name = $('#pd_guardian_name').val();
        					var pd_guardian_phone_no_code = $('#pd_guardian_phone_no_code').val();
        					var pd_guardian_phone = $('#pd_guardian_phone').val();
        					var pd_guardian_email = $('#pd_guardian_email').val();
        					var pd_guardian_occupation = $('#pd_guardian_occupation').val();
                      		var other_occupation_father = $('#other_occupation_father').val();
                      		var other_occupation_mother = $('#other_occupation_mother').val();
                      		var other_occupation_guardian = $('#other_occupation_guardian').val();
                      		var parent_relation_applicant = $('#parent_relation_applicant').val();

                      		if(pd_guardian_phone!=''){
					              if(pd_mother_phone==pd_guardian_phone || pd_father_phone==pd_guardian_phone){
					                $('#pd_guardian_phone').addClass('parsley-error');
					                $('#custom-pd_guardian_phone-parsley-error').show();
					                $('#custom-pd_guardian_phone-parsley-error').css('color','#ec4561');
					                $('#custom-pd_guardian_phone-parsley-error').html('<?php echo PHONE_MATCH_GUARDIAN; ?>');
					                setTimeout(function(){
					                  $('#pd_guardian_phone').toggleClass('parsley-error');
					                  $('#custom-pd_guardian_phone-parsley-error').hide();
					                }, 5000);
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
					                }, 5000);             
					              return false;
					            } 
					       } 

                 var isexit = ($(this).attr('isexit'));
					       var user_data = 'pd_father_id='+pd_father_id+'&pd_father_name='+pd_father_name+'&pd_father_phone_no_code='+pd_father_phone_no_code+'&pd_father_phone='+pd_father_phone+'&pd_father_email='+pd_father_email+'&pd_father_occupation='+pd_father_occupation+'&pd_mother_id='+pd_mother_id+'&pd_mother_name='+pd_mother_name+'&pd_mother_phone_no_code='+pd_mother_phone_no_code+'&pd_mother_email='+pd_mother_email+'&pd_mother_occupation='+pd_mother_occupation+'&add_parent_checkbox='+add_parent_checkbox+'&pd_guardian_id='+pd_guardian_id+'&pd_guardian_name='+pd_guardian_name+'&pd_guardian_phone_no_code='+pd_guardian_phone_no_code+'&pd_guardian_phone='+pd_guardian_phone+'&pd_guardian_email='+pd_guardian_email+'&pd_guardian_occupation='+pd_guardian_occupation+'&pd_mother_phone='+pd_mother_phone+'&other_occupation_father='+other_occupation_father+'&other_occupation_mother='+other_occupation_mother+'&other_occupation_guardian='+other_occupation_guardian+'&relationship_id='+parent_relation_applicant+'&'+csrfName+'='+csrfHash;
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
									var status = returndata.parent_response[0].status;
									if(returndata) {												
										if(status == 'true' || status == true) {
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
                    $('.loader').hide();							  
									  return false; 
								},
							});	
										
						 	if(moveNxt){
								return true;}

                      	}
                      	else
                      	{
      						pd_father_name.validate();
      						pd_father_phone.validate();
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
							parent_relation_applicant.validate();
              $(this).attr('isexit','');
                      	}
					}

					
					// Step 4 form validation
					if(currentIndex === 3) {
					  //return true;
					  var country = $('#country').parsley();
					  var state = $('#state').parsley();
					  var city = $('#city').parsley();
					  var address1 = $('#address_line1').parsley();
					  var pincode = $('#pincode').parsley();
					  
					  var country_pa = $('#country_pa').parsley();
					  var state_pa = $('#state_pa').parsley();
					  var city_pa = $('#city_pa').parsley();
					  var address1_pa = $('#address_line1_pa').parsley();
					  var pincode_pa = $('#pincode_pa').parsley();		
					  
					  check_visible_input_validation('permanent_address','country_pa','<?php echo REQD_COUNTRY_MSG;?>',false);
					  check_visible_input_validation('permanent_address','state_pa','<?php echo REQD_STATE_MSG;?>',false);
					  check_visible_input_validation('permanent_address','city_pa','<?php echo REQD_CITY_MSG;?>',false);
					  check_visible_input_validation('permanent_address','address_line1_pa','<?php echo REQD_ADDRESS_MSG;?>',false);
					  check_visible_input_validation('permanent_address','pincode_pa','<?php echo REQD_PINCODE_MSG;?>',false);
					  
					  if(country.isValid() && state.isValid() && city.isValid() && address1.isValid() && pincode.isValid() && country_pa.isValid() && state_pa.isValid() && city_pa.isValid() && address1_pa.isValid() && pincode_pa.isValid()) {
					  	var country_id 	= 	$('#country').val();
					  	var state_id 	= 	$('#state').val();
					  	var city_id     = 	$('#city').val();
					  	var address1    =  	$('#address_line1').val();
					  	var address2    =  	$('#address_line2').val();
					  	var pincode 	=	$('#pincode').val();
						
					  	var country_id_pa 	= 	$('#country_pa').val();
					  	var state_id_pa 	= 	$('#state_pa').val();
					  	var city_id_pa     = 	$('#city_pa').val();
					  	var address1_pa    =  	$('#address_line1_pa').val();
					  	var address2_pa    =  	$('#address_line2_pa').val();
					  	var pincode_pa 	=	$('#pincode_pa').val();
              var isexit = ($(this).attr('isexit'));
						
						if($('#is_permanent_addr_same_yes').is(':checked')) {
							var is_permanent_addr_same = 'yes';
						}else{
							var is_permanent_addr_same = 'no';
						}
						
					  	var userData = 'country_id='+country_id+'&state_id='+state_id+'&city_id='+city_id+'&address_line_1='+address1+'&address_line_2='+address2+'&pincode='+pincode+'&is_permanent_addr_same='+is_permanent_addr_same+'&country_id_pa='+country_id_pa+'&state_id_pa='+state_id_pa+'&city_id_pa='+city_id_pa+'&address_line_1_pa='+address1_pa+'&address_line_2_pa='+address2_pa+'&pincode_pa='+pincode_pa+'&'+csrfName+'='+csrfHash;
						
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
										if(returndata.status == 'true') {
                      if(isexit==1){
                                  window.location.href = save_exit_redirect_url;
                                  return false;
                            }
                      else{
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
                    $('.loader').hide();                
                    return false;
								},
							});
              if(moveNxt){
                return true;
              }
					  } else { 
						country.validate();
						state.validate();
						city.validate();
						address1.validate();
						pincode.validate();
						country_pa.validate();
						state_pa.validate();
						city_pa.validate();
						address1_pa.validate();
						pincode_pa.validate();
            $(this).attr('isexit','');					
						return false;
					  }
					}	

					if(currentIndex === 4)
					{
						var canditate_name = $('#canditate_name').parsley();
						var academic_country = $('#academic_country').parsley();
						var academic_school_name = $('#academic_school_name').parsley();
						var academic_exam = $('#academic_exam').parsley();
						var academic_month_year_pass = $('#academic_month_year_pass').parsley();

						var academic_subject1 = $('#academic_subject1').parsley();
						var marking_scheme1 = $('#marking_scheme1').parsley();
						var obtained_percentage_cgpa1 = $('#obtained_percentage_cgpa1').parsley();

						var academic_subject2 = $('#academic_subject2').parsley();
						var marking_scheme2 = $('#marking_scheme2').parsley();
						var obtained_percentage_cgpa2 = $('#obtained_percentage_cgpa2').parsley();

						var academic_subject3 = $('#academic_subject3').parsley();
						var marking_scheme3 = $('#marking_scheme3').parsley();
						var obtained_percentage_cgpa3 = $('#obtained_percentage_cgpa3').parsley();

						var academic_subject4 = $('#academic_subject4').parsley();
						var marking_scheme4 = $('#marking_scheme4').parsley();
						var obtained_percentage_cgpa4 = $('#obtained_percentage_cgpa4').parsley();

						var academic_subject5 = $('#academic_subject5').parsley();
						var marking_scheme5 = $('#marking_scheme5').parsley();
						var obtained_percentage_cgpa5 = $('#obtained_percentage_cgpa5').parsley();

						var academic_subject6 = $('#academic_subject6').parsley();
						var marking_scheme6 = $('#marking_scheme6').parsley();
						var obtained_percentage_cgpa6 = $('#obtained_percentage_cgpa6').parsley();

						var academic_subject7 = $('#academic_subject7').parsley();
						var marking_scheme7 = $('#marking_scheme7').parsley();
						var obtained_percentage_cgpa7 = $('#obtained_percentage_cgpa7').parsley();

						var academic_subject8 = $('#academic_subject8').parsley();
						var marking_scheme8 = $('#marking_scheme8').parsley();
						var obtained_percentage_cgpa8 = $('#obtained_percentage_cgpa8').parsley();

						var academic_subject9 = $('#academic_subject9').parsley();
						var marking_scheme9 = $('#marking_scheme9').parsley();
						var obtained_percentage_cgpa9 = $('#obtained_percentage_cgpa9').parsley();

						if(canditate_name.isValid() && academic_country.isValid() && academic_school_name.isValid() && academic_exam.isValid() && academic_month_year_pass.isValid() && academic_subject1.isValid() && marking_scheme1.isValid() && obtained_percentage_cgpa1.isValid() && academic_subject2.isValid() && marking_scheme2.isValid() && obtained_percentage_cgpa2.isValid() && academic_subject3.isValid() && marking_scheme3.isValid() && obtained_percentage_cgpa3.isValid() && academic_subject4.isValid() && marking_scheme4.isValid() && obtained_percentage_cgpa4.isValid() && academic_subject5.isValid() && marking_scheme5.isValid() && obtained_percentage_cgpa5.isValid() && academic_subject6.isValid() && marking_scheme6.isValid() && obtained_percentage_cgpa6.isValid() && academic_subject7.isValid() && marking_scheme7.isValid() && obtained_percentage_cgpa7.isValid() && academic_subject8.isValid() && marking_scheme8.isValid() && obtained_percentage_cgpa8.isValid() && academic_subject9.isValid() && marking_scheme9.isValid() && obtained_percentage_cgpa9.isValid() )
						{
							var canditate_name_val = $('#canditate_name').val();
							var academic_country_val = $('#academic_country').val();
							var academic_school_name_val = $('#academic_school_name').val();
							var academic_exam_val = $('#academic_exam').val();
							var academic_month_year_pass_val = $('#academic_month_year_pass').val();

							var academic_subject1_val = $('#academic_subject1').val();
							var marking_scheme1_val = $('#marking_scheme1').val();
							var obtained_percentage_cgpa1_val = $('#obtained_percentage_cgpa1').val();

							var academic_subject2_val = $('#academic_subject2').val();
							var marking_scheme2_val = $('#marking_scheme2').val();
							var obtained_percentage_cgpa2_val = $('#obtained_percentage_cgpa2').val();

							var academic_subject3_val = $('#academic_subject3').val();
							var marking_scheme3_val = $('#marking_scheme3').val();
							var obtained_percentage_cgpa3_val = $('#obtained_percentage_cgpa3').val();

							var academic_subject4_val = $('#academic_subject4').val();
							var marking_scheme4_val = $('#marking_scheme4').val();
							var obtained_percentage_cgpa4_val = $('#obtained_percentage_cgpa4').val();

							var academic_subject5_val = $('#academic_subject5').val();
							var marking_scheme5_val = $('#marking_scheme5').val();
							var obtained_percentage_cgpa5_val = $('#obtained_percentage_cgpa5').val();

							var academic_subject6_val = $('#academic_subject6').val();
							var marking_scheme6_val = $('#marking_scheme6').val();
							var obtained_percentage_cgpa6_val = $('#obtained_percentage_cgpa6').val();

							var academic_subject7_val = $('#academic_subject7').val();
							var marking_scheme7_val = $('#marking_scheme7').val();
							var obtained_percentage_cgpa7_val = $('#obtained_percentage_cgpa7').val();

							var academic_subject8_val = $('#academic_subject8').val();
							var marking_scheme8_val = $('#marking_scheme8').val();
							var obtained_percentage_cgpa8_val = $('#obtained_percentage_cgpa8').val();


							var academic_subject9_val = $('#academic_subject9').val();
							var marking_scheme9_val = $('#marking_scheme9').val();
							var obtained_percentage_cgpa9_val = $('#obtained_percentage_cgpa9').val();

							var schooling_id_1_val = $('#schooling_id_1').val();
							var schooling_id_2_val = $('#schooling_id_2').val();
							var schooling_id_3_val = $('#schooling_id_3').val();
							var schooling_id_4_val = $('#schooling_id_4').val();
							var schooling_id_5_val = $('#schooling_id_5').val();
							var schooling_id_6_val = $('#schooling_id_6').val();
							var schooling_id_7_val = $('#schooling_id_7').val();
							var schooling_id_8_val = $('#schooling_id_8').val();
							var schooling_id_9_val = $('#schooling_id_9').val();
              var isexit = ($(this).attr('isexit'));

							var user_data ='name_as_in_marksheet='+canditate_name_val+'&country_id='+academic_country_val+'&institute_name='+academic_school_name_val+'&completion_year='+academic_month_year_pass_val+'&examination_id='+academic_exam_val+'&academic_subject1='+academic_subject1_val+'&marking_scheme1='+marking_scheme1_val+'&obtained_percentage_cgpa1='+obtained_percentage_cgpa1_val+'&academic_subject2='+academic_subject2_val+'&marking_scheme2='+marking_scheme2_val+'&obtained_percentage_cgpa2='+obtained_percentage_cgpa2_val+'&academic_subject3='+academic_subject3_val+'&marking_scheme3='+marking_scheme3_val+'&obtained_percentage_cgpa3='+obtained_percentage_cgpa3_val+'&academic_subject4='+academic_subject4_val+'&marking_scheme4='+marking_scheme4_val+'&obtained_percentage_cgpa4='+obtained_percentage_cgpa4_val+'&academic_subject5='+academic_subject5_val+'&marking_scheme5='+marking_scheme5_val+'&obtained_percentage_cgpa5='+obtained_percentage_cgpa5_val+'&academic_subject6='+academic_subject6_val+'&marking_scheme6='+marking_scheme6_val+'&obtained_percentage_cgpa6='+obtained_percentage_cgpa6_val+'&academic_subject7='+academic_subject7_val+'&marking_scheme7='+marking_scheme7_val+'&obtained_percentage_cgpa7='+obtained_percentage_cgpa7_val+'&academic_subject8='+academic_subject8_val+'&marking_scheme8='+marking_scheme8_val+'&obtained_percentage_cgpa8='+obtained_percentage_cgpa8_val+'&academic_subject9='+academic_subject9_val+'&marking_scheme9='+marking_scheme9_val+'&obtained_percentage_cgpa9='+obtained_percentage_cgpa9_val+'&schooling_id_1='+schooling_id_1_val+'&schooling_id_2='+schooling_id_2_val+'&schooling_id_3='+schooling_id_3_val+'&schooling_id_4='+schooling_id_4_val+'&schooling_id_5='+schooling_id_5_val+'&schooling_id_6='+schooling_id_6_val+'&schooling_id_7='+schooling_id_7_val+'&schooling_id_8='+schooling_id_8_val+'&schooling_id_9='+schooling_id_9_val+'&'+csrfName+'='+csrfHash;

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
									//console.log(returndata);
									//var status = returndata.parent_response[0].status;
									if(returndata) {												
										if(returndata[0].status == 'true' || returndata[0].status == true) {
                      if(isexit==1){
                                  window.location.href = save_exit_redirect_url;
                                  return false;
                            }
                            else
                            {
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
									  $('.loader').hioe();
									  $("#formerr").show(); 							  
									  return false; 
								},
							});	
										
						 	if(moveNxt){
								return true;}
						}
						else
						{
							canditate_name.validate();
							academic_country.validate();
							academic_school_name.validate();
              $(this).attr('isexit','');
						}
					}	

					if(currentIndex == 5)
					{
						var photograph = $('#photograph').parsley();
						var signature = $('#signature').parsley();
						var applicant_name = $('#applicant_name').parsley();
						var parent_name = $('#parent_name').parsley();	
						
						if(photograph.isValid() && signature.isValid() && applicant_name.isValid() && parent_name.isValid()) {
							var applicant_name = $('#applicant_name').val();
							var parent_name = $('#parent_name').val();
							var ddate = $('#ddate').val();
              var isexit = ($(this).attr('isexit'));
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
								  	if(returndata.status == 'true' || returndata.status == true) {
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
									console.log(returndata);
									$("#formerr").show(); 
                  $('.loader').hide();							  
									return false; 
								},
							});		
							if(moveNxt){
								//setTimeout(function() { window.location.href = redirect; }, 100);
								return true;
							}	      
						} else {
							photograph.validate();
							signature.validate();
							applicant_name.validate();
							parent_name.validate();
              $(this).attr('isexit','');
							return false;
						}	
					}

						
			}
			else
			{
				return true;
			} 
        	
        }, //Onstep changed end
        saveState: true,
        onStepChanged: function (event, currentIndex, priorIndex) {
        	var isexit=($(this).attr('isexit'));
        	if(isexit!='undefined' &&  isexit==1)
        	{
        	   setTimeout(function() {   
             window.location.href = save_exit_redirect_url;
             },1);
        	}
        	enable_saveExit_btn(currentIndex,6);
        	// form preview button displayed
        	var total_wizard_Step = $('.wizard_head_tag').length;
        	console.log(parseInt(total_wizard_Step - 1)+"total_wizard_Step");
      		if(currentIndex == parseInt(total_wizard_Step - 1)){
      			$("#save_exit").remove();
      			//enable_preview_btn(currentIndex,'<?php echo base_url();?>international-form-preview');
            if(mode_edit_url !='')
        {
          enable_preview_btn(currentIndex,'<?php echo base_url();?>international-form-preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
        }else{
          enable_preview_btn(currentIndex,'<?php echo base_url();?>international-form-preview');
        }
      }else{
        $("#previewbtn").remove();
      }


            // This code for step count display in view part like STEPS 1 OF 7
            $("#show_currentindex").text(currentIndex+1+' Of '+total_wizard_Step);

            // Percentage Show Tab Wise
            tab_wise_percentage_show(get_percentage_url,'percentage_bar');  
        },
        onCanceled: function (event) { },
        onFinishing: function (event, currentIndex) { return true; }, 
        onFinished: function (event, currentIndex) { 
				payment_finishfn();
        },
        /* Labels */
        labels: {
            cancel: "Cancel",
            current: "current step:",
            pagination: "Pagination",
            finish: "Finish",
            next: "Next",
            previous: "Previous",
            loading: "Loading ..."
        }
    }
    $("#international_form").steps(settings);
          //setsave exit attr	
            $(document).on("click", "#save_btn" , function() {
            	 $("#international_form").attr('isexit',1);
                 $("#international_form").steps('next');
            });
            
            $('.actions a').click(function(){        	 
              $("#international_form").attr('isexit','');
            }); 
        //end set attr
    <?php if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) && ($mode_edit == '')) { ?>
     $( ".steps li" ).each(function( index ) { 
      if(index<6){       	 
   	  $("#international_form-t-"+index).removeAttr("href");
     }			   
   	});
    <?php } ?>

    //getselect2 function

    getSelect2('resident_category','<?php echo base_url("get_resident_international_category"); ?>?is_lookup_master=92'+url_edit,'Select Category - NRI OR Foreign', formatRepoCommon,no_resident_category, false, formatRepoSelection);

     getSelect2('relation_sponser','<?php echo base_url("get_relation_international_sponsor"); ?>?is_lookup_master=29'+url_edit,'Select', formatRepoCommon,no_relationship_sponsor, false, formatRepoSelection);

     getSelect2('program_level','<?php echo base_url("get_choice_dropdown_international"); ?>?is_lookup_master=1&is_program=1&is_distinct=1&form_id='+app_form_id+'&sort_by=name&sort_order=asc'+url_edit,'Choose Program Level', formatRepoCommon,no_program_level_msg, false, formatRepoSelection);

    getSelect2('pd_title','<?php echo base_url("get_international_title"); ?>?is_lookup_master=1'+url_edit,'Choose  Title', formatRepoCommon,no_gender_title_msg, false, formatRepoSelection);

    getSelect2('phone_no_code','<?php echo base_url("get_international_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);

    getSelect2('pd_gender','<?php echo base_url("get_international_gender"); ?>?is_lookup_master=1'+url_edit,'Choose Gender', formatRepoCommon,no_gender_msg, false, formatRepoSelection);

    getSelect2('pd_nationality','<?php echo base_url("get_international_nationality"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Nationality', formatRepoCommon,no_nationality_msg, false, formatRepoSelection);

    getSelect2('pd_country','<?php echo base_url("get_international_countries"); ?>?sort_by=country_id&sort_order=asc'+url_edit,'Choose Country', formatRepoCommon,no_country_msg, false, formatRepoSelection);
	
	getSelect2('country','<?php echo base_url("get_international_countries"); ?>?sort_by=country_id&sort_order=asc'+url_edit,'Choose Country', formatRepoCommon,no_country_msg, false, formatRepoSelection);
	
	getSelect2('country_pa','<?php echo base_url("get_international_countries"); ?>?sort_by=country_id&sort_order=asc'+url_edit,'Choose Country', formatRepoCommon,no_country_msg, false, formatRepoSelection);

	getSelect2('residing_country_id','<?php echo base_url("get_international_countries"); ?>?sort_by=country_id&sort_order=asc'+url_edit,'Choose Country', formatRepoCommon,no_country_msg, false, formatRepoSelection);

    getSelect2('pd_guardian_occupation','<?php echo base_url("get_international_parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Guardian Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);

    getSelect2('pd_guardian_phone_no_code','<?php echo base_url("get_international_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);

    getSelect2('parent_relation_applicant','<?php echo base_url("get_relation_international_sponsor"); ?>?is_lookup_master=29'+url_edit,'Select', formatRepoCommon,no_relationship_sponsor, false, formatRepoSelection);

	getSelect2('pd_father_occupation','<?php echo base_url("get_parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Father Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);

	getSelect2('pd_father_phone_no_code','<?php echo base_url("get_international_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);	

	getSelect2('pd_mother_occupation','<?php echo base_url("get_parent_occupation"); ?>?sort_by=name&sort_order=asc','Choose Mother Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);

	 getSelect2('pd_mother_phone_no_code','<?php echo base_url("get_international_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);

	  getSelect2('academic_country','<?php echo base_url("get_international_countries"); ?>?sort_by=country_id&sort_order=asc'+url_edit,'Choose Country', formatRepoCommon,no_country_msg, false, formatRepoSelection);

	  getSelect2('academic_exam','<?php echo base_url("get_examination_list"); ?>?sort_by=examination_id&sort_order=asc'+url_edit,'Choose Examination', formatRepoCommon,no_examination_msg, false, formatRepoSelection);

	   getSelect2('academic_subject1','<?php echo base_url("get_subject_list"); ?>?sort_by=subject_id&sort_order=asc'+url_edit,'Choose Subject', formatRepoCommon,no_subject_msg, false, formatRepoSelection);

	    getSelect2('marking_scheme1','<?php echo base_url("get_international_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

	    getSelect2('academic_subject2','<?php echo base_url("get_subject_list"); ?>?sort_by=subject_id&sort_order=asc'+url_edit,'Choose Subject', formatRepoCommon,no_subject_msg, false, formatRepoSelection);

	    getSelect2('marking_scheme2','<?php echo base_url("get_international_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

	    getSelect2('academic_subject3','<?php echo base_url("get_subject_list"); ?>?sort_by=subject_id&sort_order=asc'+url_edit,'Choose Subject', formatRepoCommon,no_subject_msg, false, formatRepoSelection);

	    getSelect2('marking_scheme3','<?php echo base_url("get_international_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

	    getSelect2('academic_subject4','<?php echo base_url("get_subject_list"); ?>?sort_by=subject_id&sort_order=asc'+url_edit,'Choose Subject', formatRepoCommon,no_subject_msg, false, formatRepoSelection);

	    getSelect2('marking_scheme4','<?php echo base_url("get_international_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

	    getSelect2('academic_subject5','<?php echo base_url("get_subject_list"); ?>?sort_by=subject_id&sort_order=asc'+url_edit,'Choose Subject', formatRepoCommon,no_subject_msg, false, formatRepoSelection);

	    getSelect2('marking_scheme5','<?php echo base_url("get_international_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

	    getSelect2('academic_subject6','<?php echo base_url("get_subject_list"); ?>?sort_by=subject_id&sort_order=asc'+url_edit,'Choose Subject', formatRepoCommon,no_subject_msg, false, formatRepoSelection);

	    getSelect2('marking_scheme6','<?php echo base_url("get_international_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

	    getSelect2('academic_subject7','<?php echo base_url("get_subject_list"); ?>?sort_by=subject_id&sort_order=asc'+url_edit,'Choose Subject', formatRepoCommon,no_subject_msg, false, formatRepoSelection);

	    getSelect2('marking_scheme7','<?php echo base_url("get_international_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

	    getSelect2('academic_subject8','<?php echo base_url("get_subject_list"); ?>?sort_by=subject_id&sort_order=asc'+url_edit,'Choose Subject', formatRepoCommon,no_subject_msg, false, formatRepoSelection);

	    getSelect2('marking_scheme8','<?php echo base_url("get_international_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

	    getSelect2('academic_subject9','<?php echo base_url("get_subject_list"); ?>?sort_by=subject_id&sort_order=asc'+url_edit,'Choose Subject', formatRepoCommon,no_subject_msg, false, formatRepoSelection);

	    getSelect2('marking_scheme9','<?php echo base_url("get_international_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

	    getSelect2('BankName','<?php echo base_url("get_international_banks"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Bank', formatRepoCommon,no_banks_msg, false, formatRepoSelection);

    //Set select2
    var title_id = "pd_title";
	var dbtitle_id = '<?php echo $tittle_id;?>';			
	var dbtitle_val = '<?php echo $tittle_name;?>';
	//alert(dbcountry_val);
	 if(dbtitle_id){
		setTimeout(function(){ select2Set(title_id,dbtitle_id,dbtitle_val);
					}, 1);
	}

	var gender = "pd_gender";
	var dbgender_id = '<?php echo $gender_id;?>';			
	var dbgender_val = '<?php echo $gender;?>';
	//alert(dbcountry_val);
	 if(dbgender_id){
		setTimeout(function(){ select2Set(gender,dbgender_id,dbgender_val);
					}, 1);
	}

	var nationality = "pd_nationality";
	var dbnationality_id = '<?php echo $nationality_id;?>';			
	var dbnationality_val = '<?php echo $nationality_name;?>';
	//alert(dbcountry_val);
	 if(dbnationality_id){
		setTimeout(function(){ select2Set(nationality,dbnationality_id,dbnationality_val);
					}, 1);
	}

	var residing_id = "residing_country_id";
	var db_residing_country_id = '<?php echo $db_residing_country_id;?>';			
	var db_residing_country_name = '<?php echo $db_residing_country_name;?>';
	//alert(dbcountry_val);
	 if(residing_id){
		setTimeout(function(){ select2Set(residing_id,db_residing_country_id,db_residing_country_name);
					}, 1);
	}

	var res_category_id = "resident_category";
	var db_resident_category_id ='<?php echo $resident_category_id;?>';
	var db_resident_category_name ='<?php echo $resident_category_name;?>';
	if(db_resident_category_id){
		setTimeout(function(){ select2Set(res_category_id,db_resident_category_id,db_resident_category_name);
					}, 1);
	}

	var relation_sponser = "relation_sponser";
	var db_relation_sponser_id ='<?php echo $relation_sponser_id;?>';
	var db_relation_sponser_name ='<?php echo $relation_sponser_name;?>';
	if(db_relation_sponser_id){
		setTimeout(function(){ select2Set(relation_sponser,db_relation_sponser_id,db_relation_sponser_name);}, 1);
	}

	var pgm_level = "program_level";
	var db_grade_id ='<?php echo $db_grade_id;?>';
	var db_grade_name ='<?php echo $db_grade_name;?>';
	if(db_grade_id){
		setTimeout(function(){ select2Set(pgm_level,db_grade_id,db_grade_name);
					}, 1);
	}

	var stream_id_pref1 = "stream_id_pref1";
	var db_stream_id ='<?php echo $applicant_course_stream_id[0];?>';
	var db_stream_name ='<?php echo $applicant_course_stream_name[0];?>';
	if(db_stream_id){
		setTimeout(function(){ select2Set(stream_id_pref1,db_stream_id,db_stream_name);
					}, 1);
	}

	var deg_id_pref1 = "deg_id_pref1";
	var db_deg_id1 ='<?php echo $applicant_course_deg_id[0];?>';
	var db_deg_name1 ='<?php echo $applicant_course_deg_name[0];?>';
	if(db_deg_id1){
		setTimeout(function(){ select2Set(deg_id_pref1,db_deg_id1,db_deg_name1);
					}, 1);
	}

	var course_id_pref1 = "course_id_pref1";
	var db_course_id1 ='<?php echo $applicant_course_course_id[0];?>';
	var db_course_name1 ='<?php echo $applicant_course_course_name[0];?>';
	if(db_course_id1){
		setTimeout(function(){ select2Set(course_id_pref1,db_course_id1,db_course_name1);
					}, 1);
	}

	var spec_id_pref1 = "spec_id_pref1";
	var db_spec_id1 ='<?php echo $applicant_course_spec_id[0];?>';
	var db_spec_name1 ='<?php echo $applicant_course_spec_name[0];?>';
	if(db_spec_id1){
		setTimeout(function(){ select2Set(spec_id_pref1,db_spec_id1,db_spec_name1);
					}, 1);
	}

 	/*Preference 2*/
	var stream_id_pref2 = "stream_id_pref2";
	var db_stream_id2 ='<?php echo $applicant_course_stream_id[1];?>';
	var db_stream_name2 ='<?php echo $applicant_course_stream_name[1];?>';
	if(db_stream_id2){
		setTimeout(function(){ select2Set(stream_id_pref2,db_stream_id2,db_stream_name2);
					}, 1);
	}

	var deg_id_pref2 = "deg_id_pref2";
	var db_deg_id2 ='<?php echo $applicant_course_deg_id[1];?>';
	var db_deg_name2 ='<?php echo $applicant_course_deg_name[1];?>';
	if(db_deg_id2){
		setTimeout(function(){ select2Set(deg_id_pref2,db_deg_id2,db_deg_name2);
					}, 1);
	}

	var course_id_pref2 = "course_id_pref2";
	var db_course_id2 ='<?php echo $applicant_course_course_id[1];?>';
	var db_course_name2 ='<?php echo $applicant_course_course_name[1];?>';
	if(db_course_id2){
		setTimeout(function(){ select2Set(course_id_pref2,db_course_id2,db_course_name2);
					}, 1);
	}

	var spec_id_pref2 = "spec_id_pref2";
	var db_spec_id2 ='<?php echo $applicant_course_spec_id[1];?>';
	var db_spec_name2 ='<?php echo $applicant_course_spec_name[1];?>';
	if(db_spec_id2){
		setTimeout(function(){ select2Set(spec_id_pref2,db_spec_id2,db_spec_name2);
					}, 1);
	}


	/*Preference 3*/	
	var stream_id_pref3 = "stream_id_pref3";
	var db_stream_id3 ='<?php echo $applicant_course_stream_id[2];?>';
	var db_stream_name3 ='<?php echo $applicant_course_stream_name[2];?>';
	if(db_stream_id3){
		setTimeout(function(){ select2Set(stream_id_pref3,db_stream_id3,db_stream_name3);
					}, 1);
	}

	var deg_id_pref3 = "deg_id_pref3";
	var db_deg_id3 ='<?php echo $applicant_course_deg_id[2];?>';
	var db_deg_name3 ='<?php echo $applicant_course_deg_name[2];?>';
	if(db_deg_id3){
		setTimeout(function(){ select2Set(deg_id_pref3,db_deg_id3,db_deg_name3);
					}, 1);
	}

	var course_id_pref3 = "course_id_pref3";
	var db_course_id3 ='<?php echo $applicant_course_course_id[2];?>';
	var db_course_name3 ='<?php echo $applicant_course_course_name[2];?>';
	if(db_course_id3){
		setTimeout(function(){ select2Set(course_id_pref3,db_course_id3,db_course_name3);
					}, 1);
	}

	var spec_id_pref3 = "spec_id_pref3";
	var db_spec_id3 ='<?php echo $applicant_course_spec_id[2];?>';
	var db_spec_name3 ='<?php echo $applicant_course_spec_name[2];?>';
	if(db_spec_id3){
		setTimeout(function(){ select2Set(spec_id_pref3,db_spec_id3,db_spec_name3);
					}, 1);
	}


	select2load('pd_guardian_occupation','<?php echo $applicant_parent_occupation_id[$parent_type_id_guardian]; ?>','<?php echo $applicant_parent_occupation_name[$parent_type_id_guardian]; ?>');

	select2load('parent_relation_applicant','<?php echo $applicant_parent_relationship_id[$parent_type_id_guardian]; ?>','<?php echo $applicant_parent_relationship_name[$parent_type_id_guardian]; ?>');

	select2load('pd_father_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_father]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_father]; ?>');

	select2load('pd_father_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_father]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_father]; ?>');
    
    select2load('pd_father_alt_phone_no_code','<?php echo $applicant_parent_alt_mob_countrycode_id[$parent_type_id_father]; ?>','<?php echo $applicant_parent_alt_mob_country_code[$parent_type_id_father]; ?>');

    select2load('pd_mother_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_mother]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_mother]; ?>');

    select2load('pd_mother_alt_phone_no_code','<?php echo $applicant_parent_alt_mob_countrycode_id[$parent_type_id_mother]; ?>','<?php echo $applicant_parent_alt_mob_country_code[$parent_type_id_mother]; ?>');
    
    select2load('pd_guardian_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_guardian]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_guardian]; ?>');


    select2load('phone_no_code','<?php echo $applicant_basic_details_list['applicant_mob_country_code_id']; ?>','<?php echo $applicant_basic_details_list['applicant_mob_country_code_name']; ?>'); 

    select2load('academic_country','<?php echo $applicant_scl_country_id[0]; ?>','<?php echo $applicant_scl_country_name[0]; ?>');

     select2load('academic_exam','<?php echo $applicant_scl_exam_id[0]; ?>','<?php echo $applicant_scl_exam_name[0]; ?>');

     select2load('academic_subject1','<?php echo $applicant_scl_subject_id[0]; ?>','<?php echo $applicant_scl_subject_name[0]; ?>');

     select2load('marking_scheme1','<?php echo $applicant_marking_scheme_id[0]; ?>','<?php echo $applicant_marking_scheme_name[0]; ?>');

     select2load('obtained_percentage_cgpa1','<?php echo $applicant_obtained_percentage_cgpa[0]; ?>','<?php echo $applicant_obtained_percentage_cgpa[0]; ?>');

     select2load('academic_subject2','<?php echo $applicant_scl_subject_id[1]; ?>','<?php echo $applicant_scl_subject_name[1]; ?>');

     select2load('marking_scheme2','<?php echo $applicant_marking_scheme_id[1]; ?>','<?php echo $applicant_marking_scheme_name[1]; ?>');

     select2load('obtained_percentage_cgpa2','<?php echo $applicant_obtained_percentage_cgpa[1]; ?>','<?php echo $applicant_obtained_percentage_cgpa[1]; ?>');

     select2load('academic_subject3','<?php echo $applicant_scl_subject_id[2]; ?>','<?php echo $applicant_scl_subject_name[2]; ?>');

     select2load('marking_scheme3','<?php echo $applicant_marking_scheme_id[2]; ?>','<?php echo $applicant_marking_scheme_name[2]; ?>');

     select2load('obtained_percentage_cgpa3','<?php echo $applicant_obtained_percentage_cgpa[2]; ?>','<?php echo $applicant_obtained_percentage_cgpa[2]; ?>');


     select2load('academic_subject4','<?php echo $applicant_scl_subject_id[3]; ?>','<?php echo $applicant_scl_subject_name[3]; ?>');

     select2load('marking_scheme4','<?php echo $applicant_marking_scheme_id[3]; ?>','<?php echo $applicant_marking_scheme_name[3]; ?>');

     select2load('obtained_percentage_cgpa4','<?php echo $applicant_obtained_percentage_cgpa[3]; ?>','<?php echo $applicant_obtained_percentage_cgpa[3]; ?>');

     select2load('academic_subject5','<?php echo $applicant_scl_subject_id[4]; ?>','<?php echo $applicant_scl_subject_name[4]; ?>');

     select2load('marking_scheme5','<?php echo $applicant_marking_scheme_id[4]; ?>','<?php echo $applicant_marking_scheme_name[4]; ?>');

     select2load('obtained_percentage_cgpa5','<?php echo $applicant_obtained_percentage_cgpa[4]; ?>','<?php echo $applicant_obtained_percentage_cgpa[4]; ?>');

     select2load('academic_subject6','<?php echo $applicant_scl_subject_id[5]; ?>','<?php echo $applicant_scl_subject_name[5]; ?>');

     select2load('marking_scheme6','<?php echo $applicant_marking_scheme_id[5]; ?>','<?php echo $applicant_marking_scheme_name[5]; ?>');

     select2load('obtained_percentage_cgpa6','<?php echo $applicant_obtained_percentage_cgpa[5]; ?>','<?php echo $applicant_obtained_percentage_cgpa[5]; ?>');

     select2load('academic_subject7','<?php echo $applicant_scl_subject_id[6]; ?>','<?php echo $applicant_scl_subject_name[6]; ?>');

     select2load('marking_scheme7','<?php echo $applicant_marking_scheme_id[6]; ?>','<?php echo $applicant_marking_scheme_name[6]; ?>');

     select2load('obtained_percentage_cgpa7','<?php echo $applicant_obtained_percentage_cgpa[6]; ?>','<?php echo $applicant_obtained_percentage_cgpa[6]; ?>');


     select2load('academic_subject8','<?php echo $applicant_scl_subject_id[7]; ?>','<?php echo $applicant_scl_subject_name[7]; ?>');

     select2load('marking_scheme8','<?php echo $applicant_marking_scheme_id[7]; ?>','<?php echo $applicant_marking_scheme_name[7]; ?>');

     select2load('obtained_percentage_cgpa8','<?php echo $applicant_obtained_percentage_cgpa[7]; ?>','<?php echo $applicant_obtained_percentage_cgpa[7]; ?>');

     select2load('academic_subject9','<?php echo $applicant_scl_subject_id[8]; ?>','<?php echo $applicant_scl_subject_name[0]; ?>');

     select2load('marking_scheme9','<?php echo $applicant_marking_scheme_id[8]; ?>','<?php echo $applicant_marking_scheme_name[0]; ?>');

     select2load('obtained_percentage_cgpa9','<?php echo $applicant_obtained_percentage_cgpa[8]; ?>','<?php echo $applicant_obtained_percentage_cgpa[8]; ?>');

     select2load('BankName','<?php echo $applicant_payment_details_list['bank_id']; ?>','<?php echo $applicant_payment_details_list['bank_name']; ?>');
	
	// Show Address Details Communication
	select2load('country','<?php echo $country_id[$communication_look_up_value]; ?>','<?php echo $country_name[$communication_look_up_value]; ?>');
	select2load('state','<?php echo $state_id[$communication_look_up_value]; ?>','<?php echo $state_name[$communication_look_up_value]; ?>');
	select2load('city','<?php echo $city_id[$communication_look_up_value]; ?>','<?php echo $city_name[$communication_look_up_value]; ?>');	
	
	<?php if($is_permanent_addr_same=='f') { ?>
	select2load('country_pa','<?php echo $country_id[$communication_look_up_value_permanent]; ?>','<?php echo $country_name[$communication_look_up_value_permanent]; ?>');
	select2load('state_pa','<?php echo $state_id[$communication_look_up_value_permanent]; ?>','<?php echo $state_name[$communication_look_up_value_permanent]; ?>');
	select2load('city_pa','<?php echo $city_id[$communication_look_up_value_permanent]; ?>','<?php echo $city_name[$communication_look_up_value_permanent]; ?>');		
	<?php } ?>
	
	// Onchange COuntry
	$('#country').on('change',function() {
		setEmptyOnChangeSelect2('state'); 
		// when no values return in json, add empty option value 
		if ($('#state').data('select2')) {
			$('#state').select2('destroy');
		}
		// make empty
		$('#state').html('');
    $('#main_div_state').show();
		var country_val = $(this).val();
		var url = '<?php echo base_url("get_international_states"); ?>?country_id='+country_val+	'&sort_by=id&sort_order=asc'+url_edit;
		onchange_intl_country('main_div_state','state',url,no_state_msg,country_val)
	});
	
	$('#state').on('change',function() {
		setEmptyOnChangeSelect2('city'); 
		// when no values return in json, add empty option value 
		if ($('#city').data('select2')) {$('#city').select2('destroy');}
		// make empty
		$('#city').html('');
		var country_val = $('#country').val();
		var state_val = $('#state').val();
    $('#main_div_city').show();
		
		var url = '<?php echo base_url("get_international_cities"); ?>?state_id='+state_val+'&sort_by=id&sort_order=asc'+url_edit;
		onchange_intl_country('main_div_city','city',url,no_city_msg,state_val)
	});	


	// Permanent Address Change
	
	// Onchange COuntry
	$('#country_pa').on('change',function() {
		setEmptyOnChangeSelect2('state_pa'); 
		// when no values return in json, add empty option value 
		if ($('#state_pa').data('select2')) {$('#state_pa').select2('destroy');}
		// make empty
		$('#state_pa').html('');
    $('#main_div_state_pa').show();
		var country_val = $(this).val();
		var url = '<?php echo base_url("get_international_states"); ?>?country_id='+country_val+	'&sort_by=id&sort_order=asc';
		onchange_intl_country('main_div_state_pa','state_pa',url,no_state_msg,country_val)
	});
	
	$('#state_pa').on('change',function() {
		setEmptyOnChangeSelect2('city_pa'); 
		// when no values return in json, add empty option value 
		if ($('#city_pa').data('select2')) {$('#city_pa').select2('destroy');}
		// make empty
		$('#city_pa').html('');
    $('#main_div_city_pa').show();
		var country_val = $('#country_pa').val();
		var state_val = $('#state_pa').val();
		
		var url = '<?php echo base_url("get_international_cities"); ?>?state_id='+state_val+'&sort_by=id&sort_order=asc'+url_edit;
		onchange_intl_country('main_div_city_pa','city_pa',url,no_city_msg,state_val)
	});		
	
	// On change to permanent addres `no`
	$('input[name=is_permanent_addr_same]').on('change',function(){
		if($('#is_permanent_addr_same_yes').is(':checked')) {
			$('#permanent_address').hide();
		}else{
			$('#permanent_address').show();
		}
	});

	//Onchange 

	$("#resident_category").change(function()
	{
			var val_res = $(this).val();
			basic_resident_cat(val_res);
	});

	function basic_resident_cat(val)
	{
			if(val == <?php echo NRI_SPONSERED_VAL ;?> ){
				$('#nrisponser_name').attr('data-parsley-required', 'true');
				$('#relation_sponser').attr('data-parsley-required', 'true');
				$('#nri_sponser_name').show();
				$('#nri_relation_sponsor').show();
					
			}
			else {				
				$('#nri_sponser_name').hide();
				$('#nri_relation_sponsor').hide();
				$('#nrisponser_name').attr('data-parsley-required', 'false');
				$('#relation_sponser').attr('data-parsley-required', 'false');
			}
	}

	$('#is_agree').change(function() {
            if($(this).is(':checked')) {
                  $(this).val(1);
                } else {
                  $(this).val(0);
                }
     });

	$('#program_level').change(function() {
			$("#pref1").html('Preference 1');
			$("#pref2").html('Preference 2');
			$("#pref3").html('Preference 3');
      		setEmptyOnChangeSelect2('stream_id_pref1'); 
      		setEmptyOnChangeSelect2('stream_id_pref2');
      		setEmptyOnChangeSelect2('stream_id_pref3');
      		// when no values return in json, add empty option value 
      		if ($('#stream_id_pref1').data('select2')) {$('#stream_id_pref1').select2('destroy');}
      		if ($('#stream_id_pref2').data('select2')) {$('#stream_id_pref2').select2('destroy');}
      		if ($('#stream_id_pref3').data('select2')) {$('#stream_id_pref3').select2('destroy');}
      		// make empty
      		$('#stream_id_pref1').html('');
      		$('#stream_id_pref2').html('');
      		$('#stream_id_pref3').html('');
      		$('#main_stream_div1').show();
      		$('#main_stream_div2').show();
      		$('#main_stream_div3').show();
      		var pgm_level_val = $(this).val();
      		getSelect2('stream_id_pref1','<?php echo base_url("get_choice_dropdown_international"); ?>?is_lookup_master=1&is_stream=1&is_distinct=1&form_id='+app_form_id+'&grad_id='+pgm_level_val+'&sort_by=name&sort_order=asc'+url_edit,'Select Stream Preference 1', formatRepoCommon,no_stream_msg, false, formatRepoSelection);

      		getSelect2('stream_id_pref2','<?php echo base_url("get_choice_dropdown_international"); ?>?is_lookup_master=1&is_stream=1&is_distinct=1&form_id='+app_form_id+'&grad_id='+pgm_level_val+'&sort_by=name&sort_order=asc'+url_edit,'Select Stream Preference 2', formatRepoCommon,no_stream_msg, false, formatRepoSelection);

      		getSelect2('stream_id_pref3','<?php echo base_url("get_choice_dropdown_international"); ?>?is_lookup_master=1&is_stream=1&is_distinct=1&form_id='+app_form_id+'&grad_id='+pgm_level_val+'&sort_by=name&sort_order=asc'+url_edit,'Select Stream Preference 3', formatRepoCommon,no_stream_msg, false, formatRepoSelection);
      		
     });

	$('#stream_id_pref1').change(function() {
      		setEmptyOnChangeSelect2('deg_id_pref1'); 
      		// when no values return in json, add empty option value 
      		if ($('#deg_id_pref1').data('select2')) {$('#deg_id_pref1').select2('destroy');}
      		// make empty
      		$('#deg_id_pref1').html('');
      		$('#main_degree_div1').show();
      		var pgm_level_val = $('#program_level').val();
      		var stream_val = $('#stream_id_pref1').val();
      		getSelect2('deg_id_pref1','<?php echo base_url("get_choice_dropdown_international"); ?>?is_lookup_master=1&is_regcourse=1&is_distinct=1&form_id='+app_form_id+'&grad_id='+pgm_level_val+'&stream_id='+stream_val+'&sort_by=name&sort_order=asc'+url_edit,'Select Degree', formatRepoCommon,no_degree_msg, false, formatRepoSelection);
      		
     });


	$('#stream_id_pref2').change(function() {
      		setEmptyOnChangeSelect2('deg_id_pref2'); 
      		// when no values return in json, add empty option value 
      		if ($('#deg_id_pref2').data('select2')) {$('#deg_id_pref2').select2('destroy');}
      		// make empty
      		$('#deg_id_pref2').html('');
      		$('#main_degree_div2').show();
      		var pgm_level_val = $('#program_level').val();
      		var stream_val = $('#stream_id_pref2').val();
      		getSelect2('deg_id_pref2','<?php echo base_url("get_choice_dropdown_international"); ?>?is_lookup_master=1&is_regcourse=1&is_distinct=1&form_id='+app_form_id+'&grad_id='+pgm_level_val+'&stream_id='+stream_val+'&sort_by=name&sort_order=asc'+url_edit,'Select Degree', formatRepoCommon,no_degree_msg, false, formatRepoSelection);
      		
     });

	$('#stream_id_pref3').change(function() {
      		setEmptyOnChangeSelect2('deg_id_pref3'); 
      		// when no values return in json, add empty option value 
      		if ($('#deg_id_pref3').data('select2')) {$('#deg_id_pref3').select2('destroy');}
      		// make empty
      		$('#deg_id_pref3').html('');
      		$('#main_degree_div3').show();
      		var pgm_level_val = $('#program_level').val();
      		var stream_val = $('#stream_id_pref3').val();
      		getSelect2('deg_id_pref3','<?php echo base_url("get_choice_dropdown_international"); ?>?is_lookup_master=1&is_regcourse=1&is_distinct=1&form_id='+app_form_id+'&grad_id='+pgm_level_val+'&stream_id='+stream_val+'&sort_by=name&sort_order=asc'+url_edit,'Select Degree', formatRepoCommon,no_degree_msg, false, formatRepoSelection);
      		
     });



	$('#deg_id_pref1').change(function() {
      		setEmptyOnChangeSelect2('course_id_pref1'); 
      		// when no values return in json, add empty option value 
      		if ($('#course_id_pref1').data('select2')) {$('#course_id_pref1').select2('destroy');}
      		// make empty
      		$('#course_id_pref1').html('');
      		$('#main_course_div1').show();
      		var pgm_level_val = $('#program_level').val();
      		var stream_val = $('#stream_id_pref1').val();
      		var deg_val = $('#deg_id_pref1').val();
      		getSelect2('course_id_pref1','<?php echo base_url("get_choice_dropdown_international"); ?>?is_lookup_master=1&is_course=1&is_distinct=1&form_id='+app_form_id+'&grad_id='+pgm_level_val+'&stream_id='+stream_val+'&deg_id='+deg_val+'&sort_by=name&sort_order=asc'+url_edit,'Select Course', formatRepoCommon,no_course_msg, false, formatRepoSelection);
      		
     });

	$('#deg_id_pref2').change(function() {
      		setEmptyOnChangeSelect2('course_id_pref2'); 
      		// when no values return in json, add empty option value 
      		if ($('#course_id_pref2').data('select2')) {$('#course_id_pref2').select2('destroy');}
      		// make empty
      		$('#course_id_pref2').html('');
      		$('#main_course_div2').show();
      		var pgm_level_val = $('#program_level').val();
      		var stream_val = $('#stream_id_pref2').val();
      		var deg_val = $('#deg_id_pref2').val();
      		getSelect2('course_id_pref2','<?php echo base_url("get_choice_dropdown_international"); ?>?is_lookup_master=1&is_course=1&is_distinct=1&form_id='+app_form_id+'&grad_id='+pgm_level_val+'&stream_id='+stream_val+'&deg_id='+deg_val+'&sort_by=name&sort_order=asc'+url_edit,'Select Course', formatRepoCommon,no_course_msg, false, formatRepoSelection);
      		
     });

	$('#deg_id_pref3').change(function() {
      		setEmptyOnChangeSelect2('course_id_pref3'); 
      		// when no values return in json, add empty option value 
      		if ($('#course_id_pref3').data('select2')) {$('#course_id_pref3').select2('destroy');}
      		// make empty
      		$('#course_id_pref3').html('');
      		$('#main_course_div3').show();
      		var pgm_level_val = $('#program_level').val();
      		var stream_val = $('#stream_id_pref3').val();
      		var deg_val = $('#deg_id_pref3').val();
      		getSelect2('course_id_pref3','<?php echo base_url("get_choice_dropdown_international"); ?>?is_lookup_master=1&is_course=1&is_distinct=1&form_id='+app_form_id+'&grad_id='+pgm_level_val+'&stream_id='+stream_val+'&deg_id='+deg_val+'&sort_by=name&sort_order=asc'+url_edit,'Select Course', formatRepoCommon,no_course_msg, false, formatRepoSelection);
      		
     });


	$('#course_id_pref1').change(function() {
      		setEmptyOnChangeSelect2('spec_id_pref1'); 
      		// when no values return in json, add empty option value 
      		if ($('#spec_id_pref1').data('select2')) {$('#spec_id_pref1').select2('destroy');}
      		// make empty
      		$('#spec_id_pref1').html('');
      		$('#main_spec_div1').show();
      		var pgm_level_val = $('#program_level').val();
      		var stream_val = $('#stream_id_pref1').val();
      		var deg_val = $('#deg_id_pref1').val();
      		var course_val = $('#course_id_pref1').val();
      		getSelect2('spec_id_pref1','<?php echo base_url("get_choice_dropdown_international"); ?>?is_lookup_master=1&is_spec=1&is_distinct=1&form_id='+app_form_id+'&grad_id='+pgm_level_val+'&stream_id='+stream_val+'&deg_id='+deg_val+'&branch_id='+course_val+'&sort_by=name&sort_order=asc'+url_edit,'Select Specialization', formatRepoCommon,no_spec_msg, false, formatRepoSelection);
      		
     });


	$('#course_id_pref2').change(function() {
      		setEmptyOnChangeSelect2('spec_id_pref2'); 
      		// when no values return in json, add empty option value 
      		if ($('#spec_id_pref2').data('select2')) {$('#spec_id_pref2').select2('destroy');}
      		// make empty
      		$('#spec_id_pref2').html('');
      		$('#main_spec_div2').show();
      		var pgm_level_val = $('#program_level').val();
      		var stream_val = $('#stream_id_pref2').val();
      		var deg_val = $('#deg_id_pref2').val();
      		var course_val = $('#course_id_pref2').val();
      		getSelect2('spec_id_pref2','<?php echo base_url("get_choice_dropdown_international"); ?>?is_lookup_master=1&is_spec=1&is_distinct=1&form_id='+app_form_id+'&grad_id='+pgm_level_val+'&stream_id='+stream_val+'&deg_id='+deg_val+'&branch_id='+course_val+'&sort_by=name&sort_order=asc'+url_edit,'Select Specialization', formatRepoCommon,no_spec_msg, false, formatRepoSelection);
      		
     });


	$('#course_id_pref3').change(function() {
      		setEmptyOnChangeSelect2('spec_id_pref3'); 
      		// when no values return in json, add empty option value 
      		if ($('#spec_id_pref3').data('select2')) {$('#spec_id_pref3').select2('destroy');}
      		// make empty
      		$('#spec_id_pref3').html('');
      		$('#main_spec_div3').show();
      		var pgm_level_val = $('#program_level').val();
      		var stream_val = $('#stream_id_pref3').val();
      		var deg_val = $('#deg_id_pref3').val();
      		var course_val = $('#course_id_pref3').val();
      		getSelect2('spec_id_pref3','<?php echo base_url("get_choice_dropdown_international"); ?>?is_lookup_master=1&is_spec=1&is_distinct=1&form_id='+app_form_id+'&grad_id='+pgm_level_val+'&stream_id='+stream_val+'&deg_id='+deg_val+'&branch_id='+course_val+'&sort_by=name&sort_order=asc'+url_edit,'Select Specialization', formatRepoCommon,no_spec_msg, false, formatRepoSelection);
      		
     });


	<?php
     $chk_guardian = ($add_gardian == 't')?1:0;
      if($chk_guardian) {
       ?>
      chk_guardian(<?php echo $chk_guardian; ?>);
      <?php } ?>

     $('#add_parent_checkbox').on('change',function(){
				chk_guardian($(this).is(':checked'));
			});


     function chk_guardian(val) {
    	// if($(this).is(':checked')) {
    	if(val) {
		$('#add_parent_checkbox').val('true');
		$('#parent_details').show();
      
		} else {
	$('#add_parent_checkbox').val('false');
	$('#parent_details').hide();
     
    }
}


// This Function for Payment option selection
		$("#online").click(function(){
		$("#payment_details").hide();
		});
		$("#dd").click(function(){
		 $("#payment_details").show();
		}); 
		// End of  Function for Payment option selection

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

     tab_wise_percentage_show(get_percentage_url,'percentage_bar');


    // Datepicker 

    // DOB Datepicker
	$("#pd_dob").datepicker( {
				format:"dd/mm/yyyy" ,autoclose: true,todayHighlight: true,endDate: endDob
			}).on('changeDate', function(e) {
          $("#pd_dob").parsley().validate();
    }); 

	$("#academic_month_year_pass").datepicker( {
				format:"yyyy" ,autoclose: true,todayHighlight: true
			}).on('changeDate', function(e) {
          $("#academic_month_year_pass").parsley().validate();
    }); 

	$("#DDDate").datepicker( {
        format:"dd/mm/yyyy" ,autoclose: true,todayHighlight: true,todaybtn:true,endDate: todaydate 
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

// Enable
$('.instruction_accordion').click();
	parent_other_occupation_enable('pd_father_occupation','other_occupation_father_div',occupation_other_id);
   parent_other_occupation_enable('pd_mother_occupation','other_occupation_mother_div',occupation_other_id);
 	parent_other_occupation_enable('pd_guardian_occupation','other_occupation_guardian_div',occupation_other_id);

 	validate_cgpa('marking_scheme1','obtained_percentage_cgpa1');

}); //end ready

function upload_file(file_doc_type, upload_type) {
  var mode_edit_url = '<?php echo $mode_edit; ?>';
  var mode_edit_val = '<?php echo ADMIN_MODE_EDIT ; ?>';
  console.log(mode_edit_url+"mode_edit_url");
	upload_type = upload_type || false;
	
	var parsley_required = $('#'+file_doc_type).attr('data-parsley-required');
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

	var formData = new FormData();
	formData.append('applicant_login_id', logged_applicant_login_id);
	formData.append('applicant_id', logged_applicant_id);
	formData.append('file_doc_type', file_doc_type);
	formData.append('app_form_id', app_form_id);
	formData.append('chk_max_file_size', max_file_size);
	formData.append('max_file_size_js', max_file_size_js);
	formData.append('file_extension', file_extension);	
	formData.append('id', id);
  formData.append('is_international', 1);
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
		if(file_doc_type=="graduation_marksheet"){
			parsley_required=false;
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
  // Get Regenerated CSRF Dynamically
  var csrfHashRegenerate = $("input[name='"+csrfName+"']").val();
	var url = "<?php echo base_url(); ?>del-uploaded-file";
	if(doc_id=="<?php echo DOCUMENT_ID_SIGNATURE; ?>" || doc_id=="<?php echo DOCUMENT_ID_PHOTOGRAPH; ?>"){
		required=true;
	}else{
		required=false;
	}		
	var AjaxRequest = $.ajax({
		type: 'POST',
		url: url,
		data: 'data_del_file_id='+data_del_file_id+'&doc_id='+doc_id+'&logged_applicant_id='+logged_applicant_id+'&logged_applicant_login_id='+logged_applicant_login_id+'&app_form_id='+app_form_id+'&'+csrfName+'='+csrfHashRegenerate+'&is_international=1'+url_edit,
		dataType: 'json',
		cache: false,
		success: function(returndata) {
			var json = returndata;
			$('#contentDeletePop').find('.close').trigger('click');
				var divId = 'deleteMessage_'+doc_id+data_del_file_id;
				var strongId = 'deleteMessageStatus_'+doc_id+data_del_file_id;
				var spanId = 'deleteMessageSpan_'+doc_id+data_del_file_id;
				var divId = 'deleteMessage_'+doc_id;
				var strongId = 'deleteMessageStatus_'+doc_id;
				var spanId = 'deleteMessageSpan_'+doc_id;   
			$('#' + divId).parent().find('[data-del-file-id="'+data_del_file_id+'"]').prev('span.file_name').remove();
			$('#' + divId).parent().find('[data-del-file-id="'+data_del_file_id+'"]').remove();
			
			
			$('#' + divId).show('slow');
			if (json) {
				var msg = json.message;
        // Set Regenerated CSRF Dynamically
        var csrfHash = $("input[name='"+csrfName+"']").val(json.token);

				if (json.status == true || json.status == 'true') {
					$('#' + divId).addClass('alert-success');
					$('#' + divId).removeClass('alert-danger');
				} else {
					$('#' + divId).addClass('alert-danger');
					$('#' + divId).removeClass('alert-success');
				}
                $('#'+field).attr('data-parsley-required',required);
				$('#'+field).parsley().validate();
				$('#'+field).removeClass('parsley-success');				
				$('#' + spanId).text(msg);
				upload_file_unset_download_delete_options(field);
				setTimeout(function () {
					$('#' + divId).hide('slow');
				}, 2000);
			}
		},
		error: function(returndata) {
		  console.log(returndata); 
		},
	});                 

	return AjaxRequest; 
}

function payment_finishfn()
{
	var app_form_id = '<?php echo $form_id ;?>';	
	var redirect_thank = '<?php echo base_url()."thank_you"; ?>?app_form_id='+app_form_id;
    var payment_wizard_id = '<?php echo $form_wizard_payment_id; ?>';
    //var url = "<?php echo base_url(); ?>international_form";
    var redirect_payment_thank_you = '<?php echo base_url(); ?>user/payment_thank_you?app_form_id='+app_form_id+'&wizard_id='+payment_wizard_id+'&url='+encodeURIComponent(url);
    var currentIndex = 5;
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
	                  var user_data = 'bank_name='+bank_name+'&branch_name='+branch_name+'&dd_cheque_no='+dd_cheque_no+'&dd_cheque_date='+dd_cheque_date+'&payment_mode='+payment_mode+'&app_form_id='+app_form_id+'&is_international=1&'+csrfName+'='+csrfHash;
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
									setTimeout(function() { window.location.href = redirect_payment_thank_you+'&payment_mode='+payment_mode+'&currentIndex='+currentIndex+'&is_international=1'+url_edit; }, 200);
									$("#formerr").hide();
									moveNxt=1;										
								}								
							}
						},
						error: function(returndata) {
						  //console.log(returndata);
						  moveNxt=0;							
						  $("#formerr").show();
						  $('.loader').hide(); 							  
						  return false; 
						},
	                  }); 
	              <?php } else { ?>			
						$("#formerr").hide();
						setTimeout(function() {  $('.loader').hide(); window.location.href = redirect_payment_thank_you+'&payment_mode='+payment_mode+'&currentIndex='+currentIndex+'&is_international=1'+url_edit; }, 200);
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


</script>