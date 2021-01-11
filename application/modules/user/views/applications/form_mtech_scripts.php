<?php
$app_form_id_mtech = APP_FORM_ID_MTECH;
$parent_type_id_father = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
$const_grad_id = MTECH_GRADUATION_ID;
$const_deg_id = MTECH_DEGREE_ID;
$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_graduation_marksheet = DOCUMENT_ID_GRADUATION_MARKSHEET;
$document_id_competitive_exam_marksheet = DOCUMENT_ID_COMPETITIVE_EXAM_MARKSHEET;
$occupation_other_id = OCCUPATION_OTHER_ID;
$institute_university_other_id = INSTITUTE_UNIVERSITY_OTHER_ID;
$cur_qual_completed = $applicant_other_details_list['cur_qual_completed'];
$db_prefer_hostel_id= $applicant_basic_details_list['prefer_hostel'];
$db_dif_abled_id= $applicant_basic_details_list['dif_abled'];
$form_wizard_payment_id = FORM_WIZARD_PAYMENT_ID;

$dif_abled_select = '';
$dif_abled_select_name = '';
if($db_dif_abled_id == 't') {
    $dif_abled_select = 'yes';
    $dif_abled_select_name = 'Yes';
} else if($db_dif_abled_id == 'f') {
    $dif_abled_select = 'no';
    $dif_abled_select_name = 'No';
}
$prefer_hostel_select = '';
$prefer_hostel_select_name = '';
if($db_prefer_hostel_id == 't') {
    $prefer_hostel_select = 'yes';
    $prefer_hostel_select_name = 'Yes';
} else if($db_prefer_hostel_id == 'f') {
    $prefer_hostel_select = 'no';
    $prefer_hostel_select_name = 'No';
}

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
$is_competitive_exam = $applicant_other_details_list['is_competitive_exam'];
$is_competitive_exam_select = '';
$is_competitive_exam_select_name = '';
if($is_competitive_exam == 't') {
    $is_competitive_exam_select = 'yes';
    $is_competitive_exam_select_name = 'Yes';
} else if($is_competitive_exam == 'f') {
    $is_competitive_exam_select = 'no';
    $is_competitive_exam_select_name = 'No';
}

$add_gardian = $applicant_other_details_list['add_gardian'];
$applicant_publn_det_id = $applicant_publn_det_title = $applicant_publn_det_journal_conf_name = $applicant_publn_det_year = $applicant_prof_exp_id = $applicant_prof_exp_org_name = $applicant_prof_exp_designation = $applicant_prof_exp_job_nature = $applicant_prof_exp_salary = $applicant_prof_exp_from_date = $applicant_prof_exp_to_date = $applicant_prof_exp_work_exp_in_months = $applicant_grad_det_id = $applicant_grad_det_other_degree_name = $applicant_grad_det_univ_id = $applicant_grad_det_univ_name = $applicant_grad_det_mark_scheme_id = $applicant_grad_det_mark_percent = $applicant_grad_det_completion_year = $applicant_grad_det_reg_no = $applicant_grad_det_mode_of_study_id = $applicant_grad_det_mode_of_study_name = array();

//print_r($applicant_course_prefer_details_list);die;

if($applicant_course_prefer_details_list) {
   foreach($applicant_course_prefer_details_list as $k=>$v) {
      $applicant_course_id[] = $v['applicant_course_id'];
      //$applicant_course_course_id[] = $v['course_id'];
      $applicant_course_course_id[] = $v['branch_id'];
      $applicant_course_course_name[] = $v['course_name'];
      $applicant_course_choice_no[] = $v['choice_no'];
      $applicant_course_is_active[] = $v['is_active'];
   }
}

//print_r($applicant_course_course_id);print_r($applicant_course_course_name);die;

if($applicant_campus_prefer_details_list) {
   foreach($applicant_campus_prefer_details_list as $k=>$v) {
      $applicant_campus_prefer_id[] = $v['applicant_campus_prefer_id'];
      $applicant_campus_campus_id[] = $v['campus_id'];
      $applicant_campus_campus_name[] = $v['campus_name'];
      $applicant_campus_choice_no[] = $v['choice_no'];
      $applicant_campus_is_active[] = $v['is_active'];
   }
}

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

$applicant_grad_det_univ_id = $applicant_graduations_list['univ_id'];                             
$applicant_grad_det_univ_name = $applicant_graduations_list['univ_name'];
$applicant_grad_det_mark_scheme_id = $applicant_graduations_list['mark_scheme_id'];
$applicant_grad_det_mark_scheme_name = $applicant_graduations_list['mark_scheme_name']; 
$applicant_grad_det_mode_of_study_id = $applicant_graduations_list['mode_of_study_id'];
$applicant_grad_det_mode_of_study_name = $applicant_graduations_list['mode_of_study'];

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
      $applicant_parent_occupation_other_name[$parent_type_id] = $v['other_occupation_name'];
   }
}

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

$qualifyexamfromindia = $applicant_appln_details_list[0]['qualifyingexamfromindia'];

if($applicant_appln_details_list)
{
  $applicant_appln_id = $applicant_appln_details_list['applicant_appln_id'];
  $qualifyexamfromindia = $applicant_appln_details_list['qualifyingexamfromindia'];
  $current_wizard=$applicant_appln_details_list['wizard_id'];
  // foreach($applicant_appln_details_list as $k=>$v) {
  //     $appln_form_id = $v['appln_form_id'];
  //     if($app_form_id_mtech == $appln_form_id) {
  //       $applicant_appln_id = $v['applicant_appln_id'];
  //       $qualifyexamfromindia = $v['qualifyingexamfromindia'];
  //       // $is_qualify = $v['is_qualify'];
  //     }
  //  }
}
$studied_from_india_id = '';
$studied_from_india_name = '';
if($qualifyexamfromindia == 't') {
    $studied_from_india_id = 'yes';
    $studied_from_india_name = 'Yes';
} else if($qualifyexamfromindia == 'f') {
    $studied_from_india_id = 'no';
    $studied_from_india_name = 'No';
}

$comp_exam_qualified_status = $this->config->item('comp_exam_qualified_status');
if($applicant_competitive_details_list) {
   foreach($applicant_competitive_details_list as $k=>$v) {
      $applicant_comp_exam_pk_id[] = $v['applicant_entr_exam_det_id'];
      $applicant_comp_exam_id[] = $v['comp_exam_id'];
      $applicant_comp_exam_name[] = $v['comp_exam_name'];
      $applicant_comp_exam_registration_no[] = $v['registration_no'];
      $applicant_comp_exam_score_obtained[] = $v['score_obtained'];
      $applicant_comp_exam_max_score[] = $v['max_score'];
      $applicant_comp_exam_exam_year[] = $v['exam_year'];
      $applicant_comp_exam_all_india_rank[] = $v['all_india_rank'];
      // $applicant_comp_exam_qualified[] = $v['qualified'];

      $applicant_comp_exam_qualified = $v['qualified'];
      if($applicant_comp_exam_qualified == 't') {
          $applicant_comp_exam_qualified_select[] = 1;
          $applicant_comp_exam_qualified_select_name[] = $comp_exam_qualified_status[1];
      } else {
          $applicant_comp_exam_qualified_select[] = 0;
          $applicant_comp_exam_qualified_select_name[] = $comp_exam_qualified_status[0];
      }
   }
}
// echo '<pre>applicant_comp_exam_qualified_select';
// print_r($applicant_comp_exam_qualified_select);
// print_r($applicant_comp_exam_qualified_select_name);
// echo '</pre>';


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
      $file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_graduation_marksheet == $document_id)?'graduation_marksheet':(($document_id_competitive_exam_marksheet == $document_id)?'competitive_exam_marksheet':''))));
      $parsley_required = (($document_id_photograph == $document_id)?'true':(($document_id_signature == $document_id)?'true':''));;
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
$startIndex = $this->input->get('startIndex',true);
//restrict previous section
$is_allow_previous=$this->config->item('is_allow_previous');
/*if($current_wizard){
    if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0)) {
       if(isset($startIndex) && $startIndex >= 5){
            $startIndex=$startIndex;
        }else{
            $startIndex=5;
        }
    }
}*/

/*Form Index Restriction Start*/
$start_wizard = 0;
$start_wizard_next = -1;
$next_step_allowed = '';
$start_wizard_next_allow='';
$appln_form_w_wizard_id = $applicant_appln_details_list['form_w_wizard_id'];
$count_wizard_dt = count($wizard_dt) - 1;
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
else if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) && ($startIndex==5 || $startIndex==6)) {
        $startIndex=$startIndex; //upload
}
else if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0)) {
        $startIndex=5; //upload
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
    var const_grad_id = '<?php echo $const_grad_id; ?>';
    var const_deg_id = '<?php echo $const_deg_id; ?>';
    var app_form_id = '<?php echo $app_form_id_mtech; ?>';
    var occupation_other_id = '<?php echo $occupation_other_id; ?>';
    var institute_university_other_id = '<?php echo $institute_university_other_id; ?>';
	var redirect_thank = '<?php echo base_url()."thank_you"; ?>?app_form_id='+app_form_id;

    var db_title_id = '<?php echo $applicant_basic_details_list['tittle_id'];?>';
    var db_title_name = '<?php echo $applicant_basic_details_list['tittle_name'];?>';
    var db_phone_no_code_id  = '<?php echo $applicant_basic_details_list['applicant_mob_country_code_id'];?>';
    var db_phone_no_code_name  = '<?php echo $applicant_basic_details_list['applicant_mob_country_code_name'];?>';
    var db_gender_id = '<?php echo $applicant_basic_details_list['gender_id'];?>';
    var db_gender_name = '<?php echo $applicant_basic_details_list['gender'];?>';
    var db_religion_id = '<?php echo $applicant_basic_details_list['religion_id'];?>';
    var db_religion_name = '<?php echo $applicant_basic_details_list['religion_name'];?>';
    var db_blood_grp_id = '<?php echo $applicant_basic_details_list['blood_id'];?>';
    var db_blood_grp_name = '<?php echo $applicant_basic_details_list['blood_group'];?>';
    var db_mothertongue_id = '<?php echo $applicant_basic_details_list['mothertongue_id'];?>';
    var db_mothertongue_name = '<?php echo $applicant_basic_details_list['mothertongue_name'];?>';   
    var db_med_of_inst_id= '<?php echo $applicant_other_details_list['medofinst'];?>';
    var db_med_of_inst_name= '<?php echo $applicant_other_details_list['medium_of_study_name'];?>';
    // var db_prefer_hostel_id= '<?php echo $applicant_basic_details_list['prefer_hostel'];?>';
    // var db_dif_abled_id= '<?php echo $applicant_basic_details_list['dif_abled'];?>';
    var db_adv_source_id ='<?php echo $applicant_basic_details_list['advertisement_source_id'];?>';
    var db_adv_source_name ='<?php echo $applicant_basic_details_list['source_name'];?>';
    var db_nationality_id ='<?php echo $applicant_basic_details_list['nation_id'];?>';    
    var db_nationality_name ='<?php echo $applicant_basic_details_list['nationality'];?>';
    var db_country_id='<?php echo $applicant_address_details_list['country_id'];?>';
    var db_country_name='<?php echo $applicant_address_details_list['country_name'];?>';
    var db_state_id='<?php echo $applicant_address_details_list['state_id'];?>';
    var db_state_name='<?php echo $applicant_address_details_list['state_name'];?>';
    var db_district_id='<?php echo $applicant_address_details_list['district_id'];?>';
    var db_district_name='<?php echo $applicant_address_details_list['district_name'];?>';
    var db_city_id ='<?php echo $applicant_address_details_list['city_id'];?>';
    var db_city_name='<?php echo $applicant_address_details_list['city_name'];?>';
    var db_social_status_id ='<?php echo $applicant_basic_details_list['social_status_id'];?>';
    var db_social_status_name ='<?php echo $applicant_basic_details_list['social_status'];?>';
    var db_mode_study_id='<?php echo $applicant_address_details_list['city_name'];?>';
    var db_mode_study_name='<?php echo $applicant_address_details_list['city_name'];?>';
    
    var no_qualify_degree_msg = "Sorry, Qualifying Degree not available.";
	var no_spec_qualify_degree_msg = "Sorry, Specialization In Qualifying Degree not available.";
	var no_nationality_msg = "Sorry, Nationality not available.";
	var no_studied_from_india_msg = "Sorry, Graduation from India not available.";
	var no_course_msg = "Sorry, Course not available.";
	var no_campus_msg = "Sorry, Campus not available.";
	var no_blood_grp_msg = "Sorry, Campus not available.";
	var no_religions_msg = "Sorry, Religion not available.";
	var no_medium_of_instruction_msg = "Sorry, Medium Of Instruction not available.";
	var no_country_msg = "Sorry, Country not available.";
	var no_state_msg = "Sorry, State not available.";
	var no_city_msg = "Sorry, City not available.";
	var no_district_msg="Sorry, District not available.";
	var no_mobile_code_msg = "Sorry, Mobile code not available.";
	var no_qualifying_degree_msg = "Sorry, Qualifying Degree not available.";
	var no_spec_qualifying_degree_msg = "Sorry, Qualifying Specialization Degree not available.";
	var no_working_dsc_msg = "Sorry, Department / College / School not available.";
	var no_faculty_msg = "Sorry, Faculty not available.";
	var no_category_msg = "Sorry, Category not available.";
	var no_work_experience_msg = "Sorry, Work Experience not available.";
	var no_working_place_msg = "Sorry, Working Place not available.";
	var no_gender_title_msg = "Sorry, Title not available.";	
	var no_gender_msg = "Sorry, Gender not available.";	
	var no_blood_group_msg = "Sorry, Blood Group not available.";
	var no_social_status_msg = "Sorry, Social Status not available.";
	var no_differently_abled_msg = "Sorry, Differently Abled not available.";
	
	var no_institute_university_msg = "Sorry, University not available.";
    var no_user_marking_scheme_msg = "Sorry, Marking Scheme not available.";
    var no_competitive_exam_msg = "Sorry, Competitive Exams not available.";
    var no_campus_prefer_msg = "Sorry, Campus Preference not available.";
    var no_specialization_prefer_msg = "Sorry, Specialization Preference not available.";
	var no_mother_tongues_msg = "Sorry, Mother Tongue not available.";
	var no_hostel_accommodation_msg = "Sorry, Hostel Accommodation not available.";
	var no_advertisement_source_msg = "Sorry, Advertisement Source not available.";
	var no_differently_abled_msg = "Sorry, Differently Abled not available.";
	var no_mobile_code_msg = "Sorry, Mobile code not available.";
	var no_title_msg = "Sorry, Title not available.";
	var no_occupation_msg = "Sorry, Occupation not available.";
	var no_mode_of_study ="Sorry, Mode of Study not available.";
	var no_qualified_not_qualified_msg ="Sorry, Competitive Exam Qualified Status not available.";
	var no_taken_any_competitive_exam_msg = "Sorry, Competitive Exam Taken Status not available.";
	var no_is_work_experience_msg = "Sorry, Work Experience Status not available.";
  var no_competitive_exam_msg = "Sorry, Competitive Exams not available.";
  var no_banks_msg = "Sorry, Banks not available.";
  var payment_wizard_id = '<?php echo $form_wizard_payment_id; ?>';

  /*CRM ADMIN Edit form start*/
    var crm_applicant_personal_det_id = '<?php echo $crm_applicant_personal_det_id ; ?>';
    var crm_applicant_login_id = '<?php echo $crm_applicant_login_id ; ?>';
    var mode_edit_val = '<?php echo ADMIN_MODE_EDIT ; ?>';
    var mode_edit_url = '<?php echo $mode_edit; ?>';
    
    <?php if($mode_edit) { ?>
      var url_edit = '&mode=edit'+'&applicant_personal_det_id='+crm_applicant_personal_det_id+'&applicant_login_id='+crm_applicant_login_id;
      var url = "<?php echo base_url(); ?>mtech/"+mode_edit_val+"/"+crm_applicant_login_id+"/"+crm_applicant_personal_det_id;
      var payment_url = '<?php echo base_url(); ?>user/payment_details?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;
      var save_exit_redirect_url = '<?php echo base_url(); ?>crm-admin/dashboard';
      //var upload_url = '<?php echo base_url(); ?>upload-file?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;     
    <?php } else { ?>
      var url_edit =  '';
      var url = "<?php echo base_url(); ?>mtech";
      var payment_url = '<?php echo base_url(); ?>user/payment_details';
       var save_exit_redirect_url = '<?php echo base_url(); ?>';
       //var upload_url = "<?php echo base_url(); ?>upload-file";
    <?php } ?>
    /*CRM ADMIN Edit form end*/

	
  var get_percentage_url = '<?php echo base_url(); ?>/user/get_percentage_w_tab?app_form_id='+app_form_id+url_edit;
  var redirect_payment_thank_you = '<?php echo base_url(); ?>user/payment_thank_you?app_form_id='+app_form_id+'&wizard_id='+payment_wizard_id+'&url='+encodeURIComponent(url);
  var curIndex='<?php echo $startIndex;?>';
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
        	//enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>mtech-preview');
           if(mode_edit_url != '')
          {
            enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>mtech-preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
          }else{
            enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>mtech-preview');
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
        //startIndex: 3,

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
      				  var graduation_india = $('#graduation_india').parsley();
      				  var qualifyingexamfromindia = $('#qualifyingexamfromindia').parsley();
                var appln_status =$('#appln_status').val();
                var graduation_india_val = $('#graduation_india').val();
      				  // var is_employed = $('#is_employed').parsley();
      				  // var working_place = $('#working_place').parsley();				 
      				  if(graduation_india.isValid() && qualifyingexamfromindia.isValid() && (graduation_india_val=="yes" || graduation_india_val=="t")) {
        					var qualifyingexamfromindia_val = $('#qualifyingexamfromindia').val();
                  var isexit = ($(this).attr('isexit'));
        					var user_data = 'qualifyingexamfromindia='+qualifyingexamfromindia_val+'&'+csrfName+'='+csrfHash+'&appln_status='+appln_status;
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
        					graduation_india.validate();
        					qualifyingexamfromindia.validate();
                  $(this).attr('isexit','');
        					return false;
      				  }
      				}
      				
      				
      				
      				// Step 2 form validation
      				if(currentIndex === 1) {
                        //return true;
                var course_pref_1 = $('#course_pref_1').parsley();
                var campus_pref_1 = $('#campus_pref_1').parsley();
                var state_pref_1 = $('#state_pref_1').parsley();
                var city_pref_1 = $('#city_pref_1').parsley();                
      				  
      				  var pd_title = $('#pd_title').parsley();
      				  var pd_firstname = $('#pd_firstname').parsley();
      				  var pd_lastname = $('#pd_lastname').parsley();
      				  var phone_no_code = $('#phone_no_code').parsley();
      				  var pd_mobile_no = $('#pd_mobile_no').parsley();
      				  var pd_email = $('#pd_email').parsley();
      				  var pd_dob = $('#pd_dob').parsley();
      				  var pd_gender = $('#pd_gender').parsley();
      				  var pd_alt_email = $('#pd_alt_email').parsley();
      				  var pd_blood_group = $('#pd_blood_group').parsley();
      				  var pd_social_status = $('#pd_social_status').parsley();
      				  var pd_diffrently_abled = $('#pd_diffrently_abled').parsley();
      				  var pd_nationality = $('#pd_nationality').parsley();
                var pd_middlename = $('#pd_middlename').parsley();

      				  if(course_pref_1.isValid() && campus_pref_1.isValid() && state_pref_1.isValid() && city_pref_1.isValid() && pd_title.isValid() && pd_firstname.isValid() && pd_lastname.isValid() && phone_no_code.isValid() && pd_mobile_no.isValid() && pd_email.isValid() && pd_dob.isValid() && pd_gender.isValid() && pd_alt_email.isValid()  && pd_blood_group.isValid()  && pd_social_status.isValid()  && pd_diffrently_abled.isValid() && pd_nationality.isValid() && 
                  pd_middlename.isValid()) {
                  var course_pref_1_val=$('#course_pref_1').val();
                  var course_choice_no_1_val = $('#course_choice_no_1').val();
                  var course_prefer_id_1_val = $('#course_prefer_id_1').val();
                  var campus_pref_1_val = $('#campus_pref_1').val();
                  var campus_choice_no_1_val = $('#campus_choice_no_1').val();
                  var campus_prefer_id_1_val = $('#campus_prefer_id_1').val();
                  var course_pref_2_val=$('#course_pref_2').val();
                  var course_choice_no_2_val = $('#course_choice_no_2').val();
                  var course_prefer_id_2_val = $('#course_prefer_id_2').val();
                  var campus_pref_2_val = $('#campus_pref_2').val();
                  var campus_choice_no_2_val = $('#campus_choice_no_2').val();
                  var campus_prefer_id_2_val = $('#campus_prefer_id_2').val();
                  var course_pref_3_val=$('#course_pref_3').val();
                  var course_choice_no_3_val = $('#course_choice_no_3').val();
                  var course_prefer_id_3_val = $('#course_prefer_id_3').val();
                  var campus_pref_3_val = $('#campus_pref_3').val();
                  var campus_choice_no_3_val = $('#campus_choice_no_3').val();
                  var campus_prefer_id_3_val = $('#campus_prefer_id_3').val();
                  var state_pref_1_val=$('#state_pref_1').val();
                  var city_pref_1_val = $('#city_pref_1').val();
                  var city_prefer_id_1_val = $('#city_prefer_id_1').val();
                  var city_choice_no_1_val = $('#city_choice_no_1').val();
                  var state_pref_2_val=$('#state_pref_2').val();
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
        					var pd_religion_val = $('#pd_religion').val();
        					var pd_mother_tongue_val = $('#pd_mother_tongue').val();
        					var pd_medium_of_instruction_val = $('#pd_medium_of_instruction').val();
        					var pd_hostel_accommodation_val = $('#pd_hostel_accommodation').val();
        					var pd_diffrently_abled_val = $('#pd_diffrently_abled').val();
        					var pd_advertisement_source_val = $('#pd_advertisement_source').val();
        					var pd_nationality_val = $('#pd_nationality').val();
        					var pd_social_status_val = $('#pd_social_status').val();
                  var isexit = ($(this).attr('isexit'));

        					var user_data = 'course_pref_1='+course_pref_1_val+'&course_prefer_id_1='+course_prefer_id_1_val+'&course_choice_no_1='+course_choice_no_1_val+'&campus_pref_1='+campus_pref_1_val+'&campus_choice_no_1='+campus_choice_no_1_val+'&campus_prefer_id_1='+campus_prefer_id_1_val+'&course_pref_2='+course_pref_2_val+'&course_prefer_id_2='+course_prefer_id_2_val+'&course_choice_no_2='+course_choice_no_2_val+'&campus_pref_2='+campus_pref_2_val+'&campus_choice_no_2='+campus_choice_no_2_val+'&campus_prefer_id_2='+campus_prefer_id_2_val+'&course_pref_3='+course_pref_3_val+'&course_prefer_id_3='+course_prefer_id_3_val+'&course_choice_no_3='+course_choice_no_3_val+'&campus_pref_3='+campus_pref_3_val+'&campus_choice_no_3='+campus_choice_no_3_val+'&campus_prefer_id_3='+campus_prefer_id_3_val+'&state_pref_1='+state_pref_1_val+'&city_pref_1='+city_pref_1_val+'&city_prefer_id_1='+city_prefer_id_1_val+'&city_choice_no_1='+city_choice_no_1_val+'&state_pref_2='+state_pref_2_val+'&city_pref_2='+city_pref_2_val+'&city_prefer_id_2='+city_prefer_id_2_val+'&city_choice_no_2='+city_choice_no_2_val+'&pd_title='+pd_title_val+'&pd_firstname='+pd_firstname_val+'&pd_middlename='+pd_middlename_val+'&pd_lastname='+pd_lastname_val+'&phone_no_code='+pd_mobile_no_code_val+'&pd_mobile_no='+pd_mobile_no_val+'&pd_email='+pd_email_val+'&pd_dob='+pd_dob_val+'&pd_gender='+pd_gender_val+'&pd_alt_email='+pd_alt_email_val+'&pd_blood_group='+pd_blood_group_val+'&pd_social_status='+pd_social_status_val+'&pd_diffrently_abled='+pd_diffrently_abled_val+'&pd_religion='+pd_religion_val+'&pd_medium_of_instruction='+pd_medium_of_instruction_val+'&pd_hostel_accommodation='+pd_hostel_accommodation_val+'&pd_mother_tongue='+pd_mother_tongue_val+'&pd_advertisement_source='+pd_advertisement_source_val+'&pd_nationality='+pd_nationality_val+'&'+csrfName+'='+csrfHash;
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
      				  } else { 
                    course_pref_1.validate();
                    campus_pref_1.validate();
                    state_pref_1.validate();
                    city_pref_1.validate();
                    pd_title.validate();
                    pd_firstname.validate();
                    pd_lastname.validate();
                    phone_no_code.validate();
                    pd_mobile_no.validate();
                    pd_email.validate();
                    pd_dob.validate();
                    pd_gender.validate();
                    pd_alt_email.validate();
                    pd_blood_group.validate();
                    pd_social_status.validate();
                    pd_diffrently_abled.validate();
                    pd_nationality.validate();
                    pd_middlename.validate();
                    $(this).attr('isexit','');
                    return false;
      				  }
      				}

      				// Step 3 form validation
      				if(currentIndex === 2) {
      					  //return true;

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
                  var other_occupation_guardian = $('#other_occupation_guardian').parsley();
                  var other_occupation_father = $('#other_occupation_father').parsley();
                  var other_occupation_mother = $('#other_occupation_mother').parsley();
                  
                  check_visible_input_validation('other_occupation_guardian_div','other_occupation_guardian','<?php echo REQD_GUARDIAN_OTHER_OCCUPATION_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');

                  check_visible_input_validation('other_occupation_father_div','other_occupation_father','<?php echo REQD_FATHER_OTHER_OCCUPATION_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');

                  check_visible_input_validation('other_occupation_mother_div','other_occupation_mother','<?php echo REQD_MOTHER_OTHER_OCCUPATION_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');
                  
                  
      						var country = $('#country').parsley();
      						var state = $('#state').parsley();
      						var district = $('#district').parsley();
      						var city = $('#city').parsley();
      						var address1 = $('#address_line1').parsley();
      						var pincode = $('#pincode').parsley();

                  var is_guardian_checked = false;
                  if($('#add_guardian_checkbox').is(':checked')) {
                      if(pd_guardian_name.isValid() && pd_guardian_phone.isValid() && pd_guardian_email.isValid()) {
                          is_guardian_checked = true;    
                      }
                  } else {
                      is_guardian_checked = true;
                  }
      					  
      					  	if(is_guardian_checked == true && pd_father_title.isValid() && pd_father_name.isValid() && pd_mother_title.isValid() && pd_mother_name.isValid() && pd_father_email.isValid() && pd_mother_email.isValid() && pd_father_phone.isValid() && pd_mother_phone.isValid() && pd_father_alt_phone.isValid() && pd_mother_alt_phone.isValid() && country.isValid() && state.isValid() && district.isValid() && city.isValid() && address1.isValid() && pincode.isValid() && other_occupation_guardian.isValid() && other_occupation_father.isValid() && other_occupation_mother.isValid()) {

      					  		var pd_father_id = $('#pd_father_id').val();
      					  		var pd_father_title = $('#pd_father_title').val();
        							var pd_father_name = $('#pd_father_name').val();
        							var pd_father_phone_no_code = $('#pd_father_phone_no_code').val();
        							var pd_father_phone = $('#pd_father_phone').val();
        							var pd_father_alt_phone_no_code = $('#pd_father_alt_phone_no_code').val();
        							var pd_father_alt_phone = $('#pd_father_alt_phone').val();
        							var pd_father_email = $('#pd_father_email').val();
        							var pd_father_occupation = $('#pd_father_occupation').val();
        							var pd_mother_id = $('#pd_mother_id').val();
        							var pd_mother_title = $('#pd_mother_title').val();
        							var pd_mother_name = $('#pd_mother_name').val();
        							var pd_mother_phone_no_code = $('#pd_mother_phone_no_code').val();
        							var pd_mother_phone = $('#pd_mother_phone').val();
        							var pd_mother_alt_phone_no_code = $('#pd_mother_alt_phone_no_code').val();
        							var pd_mother_alt_phone = $('#pd_mother_alt_phone').val();
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
                      var other_occupation_father = $('#other_occupation_father').val();
                      var other_occupation_mother = $('#other_occupation_mother').val();
                      var other_occupation_guardian = $('#other_occupation_guardian').val();
      						  	var country_id 	= 	$('#country').val();
      						  	var state_id 	= 	$('#state').val();
      						  	var district_id = 	$('#district').val();
      						  	var city_id     = 	$('#city').val();
      						  	var address1    =  	$('#address_line1').val();
      						  	var address2    =  	$('#address_line2').val();
      						  	var pincode 	=	$('#pincode').val();
                      var isexit = ($(this).attr('isexit'));

                      // Guardian Mobile / Email ID Unique Validation
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

      						  	var userData = 'pd_father_id='+pd_father_id+'&pd_father_title='+pd_father_title+'&pd_father_name='+pd_father_name+'&pd_father_phone_no_code='+pd_father_phone_no_code+'&pd_father_phone='+pd_father_phone+'&pd_father_alt_phone_no_code='+pd_father_alt_phone_no_code+'&pd_father_alt_phone='+pd_father_alt_phone+'&pd_father_email='+pd_father_email+'&pd_father_occupation='+pd_father_occupation+'&pd_mother_id='+pd_mother_id+'&pd_mother_title='+pd_mother_title+'&pd_mother_name='+pd_mother_name+'&pd_mother_phone_no_code='+pd_mother_phone_no_code+'&pd_mother_alt_phone_no_code='+pd_mother_alt_phone_no_code+'&pd_mother_email='+pd_mother_email+'&pd_mother_occupation='+pd_mother_occupation+'&add_guardian_checkbox='+add_guardian_checkbox+'&pd_guardian_id='+pd_guardian_id+'&pd_guardian_name='+pd_guardian_name+'&pd_guardian_phone_no_code='+pd_guardian_phone_no_code+'&pd_guardian_phone='+pd_guardian_phone+'&pd_guardian_email='+pd_guardian_email+'&pd_guardian_occupation='+pd_guardian_occupation+'&pd_mother_phone='+pd_mother_phone+'&pd_mother_alt_phone='+pd_mother_alt_phone+'&country_id='+country_id+'&state_id='+state_id+'&district_id='+district_id+'&city_id='+city_id+'&address_line_1='+address1+'&address_line_2='+address2+'&pincode='+pincode+'&other_occupation_father='+other_occupation_father+'&other_occupation_mother='+other_occupation_mother+'&other_occupation_guardian='+other_occupation_guardian+'&'+csrfName+'='+csrfHash;
                      var moveNxt=0;
      						  	$.ajax({
      								type: 'POST',
      								url: url,
      								data: userData+'&currentIndex='+currentIndex,
      								dataType: 'json',
      								cache: false,
      								beforeSend: function() { $('.loader').show(); },
                      success: function(returndata) {
                      if(returndata.parent_response[0]) {
                        var status = returndata.parent_response[0].status;
                        if(status == 'true' || status == true) {
                          if(isexit==1){
                                  window.location.href = save_exit_redirect_url;
                                  return false;
                            }else {
                              var startIndex = currentIndex+1
                             window.location.href = url+'?startIndex='+startIndex;$("#formerr").hide();
                          moveNxt=1;
                            }
                          
                  //}, 100);                    
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
      							if(moveNxt){
                      return true;
                    }
      					  } else { 
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
							pd_mother_alt_phone.validate();
							pd_father_alt_phone.validate();
							other_occupation_guardian.validate();
							other_occupation_father.validate();
							other_occupation_mother.validate(); 
      						country.validate();
      						state.validate();
      						district.validate();
      						city.validate();
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
                var appering = $('#appering').parsley();
                var completed = $('#completed').parsley();
                var canditate_name = $('#canditate_name').parsley();
                var result_declare_date = $('#result_declare_date').parsley();
                var institute_name = $('#institute_name').parsley();
                var institute_university = $('#institute_university').parsley();
                var institute_university_other = $('#other_univ_grad').parsley();
                var registration_no = $('#registration_no').parsley();
                var mode_of_study = $('#mode_of_study').parsley();
                // if($('#competitive_exam').val()) {
                //     var score_card_filename = changeFileName($('#competitive_exam').val());
                //     score_card = $('#'+score_card_filename).parsley();
                // }
                

                var marking_scheme = $('#marking_scheme').parsley();
                var obtained_percentage_cgpa = $('#obtained_percentage_cgpa').parsley();
                var year_of_passing = $('#year_of_passing').parsley();

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

                var competitive_exam_1 = $('#competitive_exam_1').parsley();
                var registration_no_1 = $('#registration_no_1').parsley();
                var score_obtained_1 = $('#score_obtained_1').parsley();
                var max_score_1 = $('#max_score_1').parsley();
                var year_appeared_1 = $('#year_appeared_1').parsley();
                var air_overall_rank_1 = $('#air_overall_rank_1').parsley();
                var qualified_not_qualified_1 = $('#qualified_not_qualified_1').parsley();

                var competitive_exam_2 = $('#competitive_exam_2').parsley();
                var registration_no_2 = $('#registration_no_2').parsley();
                var score_obtained_2 = $('#score_obtained_2').parsley();
                var max_score_2 = $('#max_score_2').parsley();
                var year_appeared_2 = $('#year_appeared_2').parsley();
                var air_overall_rank_2 = $('#air_overall_rank_2').parsley();
                var qualified_not_qualified_2 = $('#qualified_not_qualified_2').parsley();

                var competitive_exam_3 = $('#competitive_exam_3').parsley();
                var registration_no_3 = $('#registration_no_3').parsley();
                var score_obtained_3 = $('#score_obtained_3').parsley();
                var max_score_3 = $('#max_score_3').parsley();
                var year_appeared_3 = $('#year_appeared_3').parsley();
                var air_overall_rank_3 = $('#air_overall_rank_3').parsley();
                var qualified_not_qualified_3 = $('#qualified_not_qualified_3').parsley();

                var is_work_experience = $('#is_work_experience').parsley();
                var taken_any_competitive_exam = $('#taken_any_competitive_exam').parsley();
                var is_work_experience_checked = false;
                if($('#is_work_experience').val() == 'yes') {
                    if(organisation_name_0.isValid() && designation_0.isValid() && total_salary_month_0.isValid() && nature_of_job_0.isValid() && from_year_0.isValid() && to_year_0.isValid() && work_experience_0.isValid()) {
                        is_work_experience_checked = true;    
                    }
                } else {
                    is_work_experience_checked = true;
                }

                var taken_any_competitive_exam_checked = false;
                if($('#taken_any_competitive_exam').val() == 'yes') {
                    if(competitive_exam_1.isValid() && registration_no_1.isValid() && score_obtained_1.isValid() && max_score_1.isValid() && year_appeared_1.isValid() && air_overall_rank_1.isValid() && qualified_not_qualified_1.isValid() &&competitive_exam_2.isValid() && registration_no_2.isValid() && score_obtained_2.isValid() && max_score_2.isValid() && year_appeared_2.isValid() && air_overall_rank_2.isValid() && qualified_not_qualified_2.isValid() &&competitive_exam_3.isValid() && registration_no_3.isValid() && score_obtained_3.isValid() && max_score_3.isValid() && year_appeared_3.isValid() && air_overall_rank_3.isValid() && qualified_not_qualified_3.isValid()) {
                        taken_any_competitive_exam_checked = true;    
                    }
                } else {
                    taken_any_competitive_exam_checked = true;
                }

                if($('#ob_univ').is(':visible')){
                  $('#other_univ_grad').attr('data-parsley-required', 'true');
                  $('#other_univ_grad').attr('data-parsley-required-message', '<?php echo REQD_OTHER_UNIVERSITY_MSG;?>'); 
                  $('#other_univ_grad').attr('data-parsley-nameonly', 'true');
                  $('#other_univ_grad').attr('data-parsley-nameonly-message', '<?php echo REQD_ALPHA_ONLY_MSG;?>');           
                }else{
                  $('#other_univ_grad').attr('data-parsley-required', 'false');
                  $('#other_univ_grad').attr('data-parsley-nameonly', 'false');
                }

                if(is_work_experience_checked == true && taken_any_competitive_exam_checked == true && appering.isValid() && completed.isValid() && canditate_name.isValid() && result_declare_date.isValid() && institute_name.isValid() && institute_university.isValid() && institute_university_other.isValid() && registration_no.isValid() && mode_of_study.isValid() && marking_scheme.isValid() && obtained_percentage_cgpa.isValid() && year_of_passing.isValid() && is_work_experience.isValid() && taken_any_competitive_exam.isValid() && organisation_name_1.isValid() && designation_1.isValid() && nature_of_job_1.isValid() && total_salary_month_1.isValid() && from_year_1.isValid() && to_year_1.isValid() && work_experience_1.isValid() && organisation_name_2.isValid() && designation_2.isValid() && nature_of_job_2.isValid() && total_salary_month_2.isValid() && from_year_2.isValid() && to_year_2.isValid() && work_experience_2.isValid()) {
                	var current_education_qual_status  = $('input[name=current_education_qual_status]:checked').val();
                	var canditate_name = $("#canditate_name").val();
                	var result_declare_date = $("#result_declare_date").val();
                	var grad_id = $("#grad_id").val();
                  var institute_name = $("#institute_name").val();
                	var institute_university = $("#institute_university").val();
                  var institute_university_other = $("#other_univ_grad").val();
                	var registration_no = $("#registration_no").val();
                	var mode_of_study = $("#mode_of_study").val();
                	var marking_scheme = $("#marking_scheme").val();
                	var obtained_percentage_cgpa = $("#obtained_percentage_cgpa").val();
                	var year_of_passing = $("#year_of_passing").val();
                	
                	var taken_any_competitive_exam = $("#taken_any_competitive_exam").val();
                	var comp_exam_pk_id_1 = $("#comp_exam_pk_id_1").val();
                  var competitive_exam_1 = $("#competitive_exam_1").val();
                	var registration_no_1 = $("#registration_no_1").val();
                	var score_obtained_1 = $("#score_obtained_1").val();
                	var max_score_1 = $("#max_score_1").val();
                	var year_appeared_1 = $("#year_appeared_1").val();
                	var air_overall_rank_1 = $("#air_overall_rank_1").val();
                	var qualified_not_qualified_1 = $("#qualified_not_qualified_1").val();
                  var comp_exam_pk_id_2 = $("#comp_exam_pk_id_2").val();
                	var competitive_exam_2 = $("#competitive_exam_2").val();
                	var registration_no_2 = $("#registration_no_2").val();
                	var score_obtained_2 = $("#score_obtained_2").val();
                	var max_score_2 = $("#max_score_2").val();
                	var year_appeared_2 = $("#year_appeared_2").val();
                	var air_overall_rank_2 = $("#air_overall_rank_2").val();
                	var qualified_not_qualified_2 = $("#qualified_not_qualified_2").val();
                  var comp_exam_pk_id_3 = $("#comp_exam_pk_id_3").val();
                	var competitive_exam_3 = $("#competitive_exam_3").val();
                	var registration_no_3 = $("#registration_no_3").val();
                	var score_obtained_3 = $("#score_obtained_3").val();
                	var max_score_3 = $("#max_score_3").val();
                	var year_appeared_3 = $("#year_appeared_3").val();
                	var air_overall_rank_3 = $("#air_overall_rank_3").val();
                	var qualified_not_qualified_3 = $("#qualified_not_qualified_3").val();

                	var is_work_experience = $("#is_work_experience").val();
                	var nad_id_digilocker_id = $("#nad_id_digilocker_id").val();

                	var organisation_name_0 = $("#organisation_name_0").val();
                	var designation_0 = $("#designation_0").val();
                  var nature_of_job_0 = $("#nature_of_job_0").val();
                  var total_salary_month_0 = $("#total_salary_month_0").val();
                	var from_year_0 = $("#from_year_0").val();
                	var to_year_0 = $("#to_year_0").val();
                	var work_experience_0 = $("#work_experience_0").val();
                	var organisation_name_1 = $("#organisation_name_1").val();
                	var designation_1 = $("#designation_1").val();
                  var nature_of_job_1 = $("#nature_of_job_1").val();
                  var total_salary_month_1 = $("#total_salary_month_1").val();
                	var from_year_1 = $("#from_year_1").val();                    	
                	var to_year_1 = $("#to_year_1").val();
                	var work_experience_1 = $("#work_experience_1").val();
                	var organisation_name_2 = $("#organisation_name_2").val();
                	var designation_2 = $("#designation_2").val();
                  var nature_of_job_2 = $("#nature_of_job_2").val();
                  var total_salary_month_2 = $("#total_salary_month_2").val();
                	var from_year_2 = $("#from_year_2").val();
                	var to_year_2 = $("#to_year_2").val();
                	var work_experience_2 = $("#work_experience_2").val();
                	var total_work_experience = $("#total_work_experience").val();
                	var prof_exp_id_0 = $("#prof_exp_id_0").val();
                	var prof_exp_id_1 = $("#prof_exp_id_1").val();
                	var prof_exp_id_2 = $("#prof_exp_id_2").val();

                  var isexit = ($(this).attr('isexit'));
                	
                    //return true;   
                    var user_data = 'current_education_qual_status='+current_education_qual_status+'&canditate_name='+canditate_name+'&result_declare_date='+result_declare_date+'&grad_id='+grad_id+'&institute_name='+institute_name+'&institute_university='+institute_university+'&institute_university_other='+institute_university_other+'&registration_no='+registration_no+'&mode_of_study='+mode_of_study+'&marking_scheme='+marking_scheme+'&obtained_percentage_cgpa='+obtained_percentage_cgpa+'&year_of_passing='+year_of_passing+'&is_work_experience='+is_work_experience+'&nad_id_digilocker_id='+nad_id_digilocker_id+'&organisation_name_0='+organisation_name_0+'&designation_0='+designation_0+'&nature_of_job_0='+nature_of_job_0+'&total_salary_month_0='+total_salary_month_0+'&from_year_0='+from_year_0+'&to_year_0='+to_year_0+'&work_experience_0='+work_experience_0+'&organisation_name_1='+organisation_name_1+'&designation_1='+designation_1+'&nature_of_job_1='+nature_of_job_1+'&total_salary_month_1='+total_salary_month_1+'&from_year_1='+from_year_1+'&to_year_1='+to_year_1+'&work_experience_1='+work_experience_1+'&organisation_name_2='+organisation_name_2+'&designation_2='+designation_2+'&nature_of_job_2='+nature_of_job_2+'&total_salary_month_2='+total_salary_month_2+'&from_year_2='+from_year_2+'&to_year_2='+to_year_2+'&work_experience_2='+work_experience_2+'&total_work_experience='+total_work_experience+'&prof_exp_id_0='+prof_exp_id_0+'&prof_exp_id_1='+prof_exp_id_1+'&prof_exp_id_2='+prof_exp_id_2+'&taken_any_competitive_exam='+taken_any_competitive_exam+'&comp_exam_pk_id_1='+comp_exam_pk_id_1+'&competitive_exam_1='+competitive_exam_1+'&registration_no_1='+registration_no_1+'&score_obtained_1='+score_obtained_1+'&max_score_1='+max_score_1+'&year_appeared_1='+year_appeared_1+'&air_overall_rank_1='+air_overall_rank_1+'&qualified_not_qualified_1='+qualified_not_qualified_1+'&comp_exam_pk_id_2='+comp_exam_pk_id_2+'&competitive_exam_2='+competitive_exam_2+'&registration_no_2='+registration_no_2+'&score_obtained_2='+score_obtained_2+'&max_score_2='+max_score_2+'&year_appeared_2='+year_appeared_2+'&air_overall_rank_2='+air_overall_rank_2+'&qualified_not_qualified_2='+qualified_not_qualified_2+'&comp_exam_pk_id_3='+comp_exam_pk_id_3+'&competitive_exam_3='+competitive_exam_3+'&registration_no_3='+registration_no_3+'&score_obtained_3='+score_obtained_3+'&max_score_3='+max_score_3+'&year_appeared_3='+year_appeared_3+'&air_overall_rank_3='+air_overall_rank_3+'&qualified_not_qualified_3='+qualified_not_qualified_3+'&'+csrfName+'='+csrfHash;
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
                  
                  //}, 100);                    
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
                    if(moveNxt){
                      return true;
                    }     
                  } else {
                  	appering.validate();
                  	completed.validate();
                  	canditate_name.validate();
                  	result_declare_date.validate();
                  	institute_name.validate();
                  	institute_university.validate();
                  	registration_no.validate();
                  	mode_of_study.validate();
                  	year_of_passing.validate();
                  	marking_scheme.validate();
                  	obtained_percentage_cgpa.validate();
                  	competitive_exam_1.validate();
                  	registration_no_1.validate();
                  	score_obtained_1.validate();
                  	max_score_1.validate();
                  	year_appeared_1.validate();
                  	air_overall_rank_1.validate();
                  	qualified_not_qualified_1.validate();
                  	organisation_name_0.validate();
                  	designation_0.validate();
                    nature_of_job_0.validate();
                    total_salary_month_0.validate();
                  	from_year_0.validate();
                  	to_year_0.validate();
                  	work_experience_0.validate();
                  	is_work_experience.validate();
                  	taken_any_competitive_exam.validate();
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
                    competitive_exam_2.validate();
                    registration_no_2.validate();
                    score_obtained_2.validate();
                    max_score_2.validate();
                    year_appeared_2.validate();
                    air_overall_rank_2.validate();
                    qualified_not_qualified_2.validate();
                    competitive_exam_3.validate();
                    registration_no_3.validate();
                    score_obtained_3.validate();
                    max_score_3.validate();
                    year_appeared_3.validate();
                    air_overall_rank_3.validate();
                    qualified_not_qualified_3.validate();
                    $(this).attr('isexit','');
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
					  //console.log(returndata);
					  moveNxt=0;							
					  $("#formerr").show();
					  $('.loader').hide(); 							  
					  return false; 
					},
                  }); 
              <?php } else { ?>
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

              if(currentIndex == 5) {
    						// return true;
                // var valid = $(this).parsley().validate();
                var photograph = $('#photograph').parsley();
                var signature = $('#signature').parsley();
                var graduation_marksheet = $('#graduation_marksheet').parsley();
                var competitive_exam_marksheet = $('#competitive_exam_marksheet').parsley();
                if(photograph.isValid() && signature.isValid() && graduation_marksheet.isValid() && competitive_exam_marksheet.isValid()) {
                var csrfHashRegenerateonDec = $("input[name='"+csrfName+"']").val();
                var isexit = ($(this).attr('isexit'));
                var moveNxt=0;
            $.ajax({
              type: 'POST',
              url: url,
              data: 'currentIndex='+currentIndex+'&'+csrfName+'='+csrfHashRegenerateonDec,
              dataType: 'json',
              cache: false,
              async: false,
              success: function(returndata) {
                if(returndata.status == 'true' || returndata.status == true) {
                  if(isexit==1){
                    window.location.href = save_exit_redirect_url;
                    return false; }
                  $("#formerr").hide();
                  moveNxt=1;                    
                }
              },
              error: function(returndata) {
                 $("#formerr").show();
                 moveNxt=0;
              },
            });
            
             if(moveNxt){
              var startIndex = currentIndex+1
              window.location.href = url+'?startIndex='+startIndex; 
              //return true;
            }
                } else {
                  photograph.validate();
                  signature.validate();
                  graduation_marksheet.validate();
                  competitive_exam_marksheet.validate();
                  $(this).attr('isexit','');
                    return false;
                }
    					}

              if(currentIndex === 6) {
                  
                  //declaration_func(currentIndex);
              }

              /* var url = "<?php echo base_url(); ?>mtech";	
              var AjaxRequest = $.ajax({
      						type: 'POST',
      						url: url,
      						// data: userData+'&currentIndex='+currentIndex+'&<?php //echo $this->security->get_csrf_token_name(); ?>=<?php //echo $this->security->get_csrf_hash(); ?>',
      						data: userData+'&currentIndex='+currentIndex,
      						dataType: 'json',
      						cache: false,
      						success: function(returndata) {
      						  console.log(returndata);
      						},
      						error: function(returndata) {
      						  console.log(returndata); 
      						},
      					});					

      					return AjaxRequest; */	
      			}
      			else { 
      				return true; 
      			}	
        },
        onStepChanged: function (event, currentIndex, priorIndex) { 
        	var isexit=($(this).attr('isexit'));        	
        	if(isexit!='undefined' &&  isexit==1)
        	{
        	   setTimeout(function() {   
             window.location.href = save_exit_redirect_url;
             },1);
        	}
          if(currentIndex==3){
            $(".actions ul > li:nth-child(2) a").text('<?php echo MAKE_PAYMENT; ?>');
          }else{
            $(".actions ul > li:nth-child(2) a").text('<?php echo NEXT_STEP; ?>');
          }

          // form preview button displayed
        /*if(currentIndex == 6){
          var preview_button = $("<li id='preview_li' style='list-style:none;'><a href='<?php echo base_url();?>mtech-preview' style='float:left;background:unset;'><input type='button' id='form_preview_btn' class='btn btn-primary' value='Form Preview'></a></li>");
          $(document).find(".actions").prepend(preview_button);
        }else{
        $('#preview_li').remove();
      }*/
      enable_saveExit_btn(currentIndex,4);
      // form preview button displayed
      if(currentIndex == parseInt(total_wizard_Step - 1)){
    	  $("#save_exit").remove();
    	  //enable_preview_btn(currentIndex,'<?php echo base_url();?>mtech-preview');
        if(mode_edit_url !='')
        {
          enable_preview_btn(currentIndex,'<?php echo base_url();?>mtech-preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
        }else{
          enable_preview_btn(currentIndex,'<?php echo base_url();?>mtech-preview');
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
            declaration_func(currentIndex);
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

    $("#mtech_form").steps(settings);
  //setsave exit attr	
    $(document).on("click", "#save_btn" , function() {
    	 $("#mtech_form").attr('isexit',1);
         $("#mtech_form").steps('next');
    });
    
    $('.actions a').click(function(){        	 
      $("#mtech_form").attr('isexit','');
    }); 
//end set attr
  //to remove links from previous tabs a
    <?php if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) && ($mode_edit == '')) { ?>
     $( ".steps li" ).each(function( index ) { 
      if(index<5){       	 
   	  $("#mtech_form-t-"+index).removeAttr("href");
     }			   
   	});
    <?php } ?>
        // $(document).ready(function () {
            // 'use strict';

            $('#academic_accordion').click();
            $('.instruction_accordion').click();
            basic_change();
            light_box_init();
			getSelect2('pd_nationality','<?php echo base_url("get_nationalities"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Nationality', formatRepoCommon,no_nationality_msg, false, formatRepoSelection);

			getSelect2('graduation_india','<?php echo base_url("get_studied_from_india"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Status', formatRepoCommon,no_studied_from_india_msg, false, formatRepoSelection);

			/*getSelect2('course_pref_1','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_course=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Choose Course Perferences 1', formatRepoCommon,no_course_msg, false, formatRepoSelection);*/      
			//course_pref_change('course_pref_1','campus_pref_1','main_div_camp_pref_1','Choose Campus Perferences 1');
      getSelect2('campus_pref_1','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_campus=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc'+url_edit,'Choose Campus Perferences 1', formatRepoCommon,no_campus_msg, false, formatRepoSelection);
      campus_pref_change('course_pref_1','campus_pref_1','main_div_camp_pref_1','main_div_course_pref_1','Choose Course Perferences 1');

			/*getSelect2('course_pref_2','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_course=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Choose Course Perferences 2', formatRepoCommon,no_course_msg, false, formatRepoSelection);*/      
			//course_pref_change('course_pref_2','campus_pref_2','main_div_camp_pref_2','Choose Campus Perferences 2');
      getSelect2('campus_pref_2','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_campus=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc'+url_edit,'Choose Campus Perferences 2', formatRepoCommon,no_campus_msg, false, formatRepoSelection);
      campus_pref_change('course_pref_2','campus_pref_2','main_div_camp_pref_2','main_div_course_pref_2','Choose Course Perferences 2');

			/*getSelect2('course_pref_3','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_course=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Choose Course Perferences 1', formatRepoCommon,no_course_msg, false, formatRepoSelection);*/
			//course_pref_change('course_pref_3','campus_pref_3','main_div_camp_pref_3','Choose Campus Perferences 3');
      getSelect2('campus_pref_3','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_campus=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc'+url_edit,'Choose Campus Perferences 3', formatRepoCommon,no_campus_msg, false, formatRepoSelection);
      campus_pref_change('course_pref_3','campus_pref_3','main_div_camp_pref_3','main_div_course_pref_3','Choose Course Perferences 3');

			test_state_pref('state_pref_1','Choose Test State Perferences 1');
			test_state_pref('state_pref_2','Choose Test State Perferences 2');

			test_state_pref_change('state_pref_1','city_pref_1','main_div_city_pref_1','Choose Test City Perferences 1');
			test_state_pref_change('state_pref_2','city_pref_2','main_div_city_pref_2','Choose Test City Perferences 2');

			getSelect2('pd_title','<?php echo base_url("get_gender_title"); ?>?is_lookup_master=1'+url_edit,'Choose Gender Title', formatRepoCommon,no_gender_title_msg, false, formatRepoSelection);
			
			getSelect2('phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);

			getSelect2('pd_gender','<?php echo base_url("get_gender"); ?>?is_lookup_master=1'+url_edit,'Choose Gender', formatRepoCommon,no_gender_msg, false, formatRepoSelection);
			
			getSelect2('pd_blood_group','<?php echo base_url("get_bloodgroups"); ?>?sort_by=blood_grp_id&sort_order=asc'+url_edit,'Choose Blood Groups', formatRepoCommon,no_blood_group_msg, false, formatRepoSelection);

			getSelect2('pd_religion','<?php echo base_url("get_religions"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Religions', formatRepoCommon,no_religions_msg, false, formatRepoSelection);
			
			getSelect2('pd_medium_of_instruction','<?php echo base_url("get_mother_tongues"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Medium Of Instruction', formatRepoCommon,no_medium_of_instruction_msg, false, formatRepoSelection);

			getSelect2('pd_hostel_accommodation','<?php echo base_url("get_hostel_accommodation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Hostel Accommodation', formatRepoCommon,no_hostel_accommodation_msg, false, formatRepoSelection);

			getSelect2('pd_mother_tongue','<?php echo base_url("get_mother_tongues"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Mother Tongues', formatRepoCommon,no_mother_tongues_msg, false, formatRepoSelection);
			
			getSelect2('pd_advertisement_source','<?php echo base_url("get_advertisement_source"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Advertisement Source', formatRepoCommon,no_advertisement_source_msg, false, formatRepoSelection);

			getSelect2('pd_social_status','<?php echo base_url("get_social_status"); ?>?is_lookup_master=1'+url_edit,'Choose Social Status', formatRepoCommon,no_social_status_msg, false, formatRepoSelection);
	
			getSelect2('pd_diffrently_abled','<?php echo base_url("get_are_you_differently_abled"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Differently Abled', formatRepoCommon,no_differently_abled_msg, false, formatRepoSelection);

			getSelect2('country','<?php echo base_url("get_countries"); ?>?sort_by=country_id&sort_order=asc'+url_edit,'Choose Country', formatRepoCommon,no_country_msg, false, formatRepoSelection);	

			getSelect2('phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);

			getSelect2('qualifying_degree','<?php echo base_url("get_qualifying_degree"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Qualifying Degree', formatRepoCommon,no_qualifying_degree_msg, false, formatRepoSelection);
			
			getSelect2('specialization_qualifying_degree','<?php echo base_url("get_spec_qualifying_degree"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Specialization Qualifying Degree', formatRepoCommon,no_spec_qualifying_degree_msg, false, formatRepoSelection);

			getSelect2('working_dsc','<?php echo base_url("get_working_dsc"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Department / College / School', formatRepoCommon,no_working_dsc_msg, false, formatRepoSelection);
			
			getSelect2('faculty','<?php echo base_url("get_faculty"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Faculty', formatRepoCommon,no_faculty_msg, false, formatRepoSelection);

			getSelect2('category','<?php echo base_url("get_work_category"); ?>?is_lookup_master=1'+url_edit,'Choose Category', formatRepoCommon,no_category_msg, false, formatRepoSelection);
			
			getSelect2('is_employed','<?php echo base_url("get_are_you_employed"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Working Type', formatRepoCommon,no_work_experience_msg, false, formatRepoSelection);			

			getSelect2('working_place','<?php echo base_url("get_working_place"); ?>?is_lookup_master=1'+url_edit,'Choose Working Place', formatRepoCommon,no_working_place_msg, false, formatRepoSelection);

			getSelect2('pd_father_title','<?php echo base_url("get_parent_title"); ?>?is_lookup_master=1&is_father=1'+url_edit,'Choose Title', formatRepoCommon,no_title_msg, false, formatRepoSelection);

			getSelect2('pd_father_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);		
			getSelect2('pd_father_alt_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);		
			
			getSelect2('pd_father_occupation','<?php echo base_url("get_parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Father Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);

			getSelect2('pd_mother_title','<?php echo base_url("get_parent_title"); ?>?is_lookup_master=1&is_mother=1'+url_edit,'Choose Title', formatRepoCommon,no_title_msg, false, formatRepoSelection);

			getSelect2('pd_mother_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
			getSelect2('pd_mother_alt_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
			
			getSelect2('pd_mother_occupation','<?php echo base_url("get_parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Mother Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);


			// Show Father & Mother Input
			show_parents_detail('pd_father_title','father_mbleno_div','father_email_div','father_occupation_div','father_alt_mbleno_div');
			
			show_parents_detail('pd_mother_title','mother_mbleno_div','mother_email_div','mother_occupation_div','mother_alt_mbleno_div');

			$('#add_guardian_checkbox').on('change',function(){
				chk_guardian($(this).is(':checked'));
			});
			
			getSelect2('pd_guardian_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
			
			getSelect2('pd_guardian_occupation','<?php echo base_url("get_parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Mother Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);

      getSelect2('institute_university','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose University', formatRepoCommon,no_institute_university_msg, false, formatRepoSelection);

     getSelect2('mode_of_study','<?php echo base_url("get_mode_of_study"); ?>?is_lookup_master=1'+url_edit,'Choose Mode Of Study', formatRepoCommon,no_mode_of_study, false, formatRepoSelection);

      getSelect2('marking_scheme','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

      getSelect2('competitive_exam_1','<?php echo base_url("get_competitive_exams"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Competitive Examination', formatRepoCommon,no_competitive_exam_msg, false, formatRepoSelection);

      getSelect2('competitive_exam_2','<?php echo base_url("get_competitive_exams"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Competitive Examination', formatRepoCommon,no_competitive_exam_msg, false, formatRepoSelection);

      getSelect2('competitive_exam_3','<?php echo base_url("get_competitive_exams"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Competitive Examination', formatRepoCommon,no_competitive_exam_msg, false, formatRepoSelection);
      getSelect2('qualified_not_qualified_1','<?php echo base_url("get_comp_exam_qualified_status"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Qualified / Not Qualified', formatRepoCommon,no_qualified_not_qualified_msg, false, formatRepoSelection);
       getSelect2('qualified_not_qualified_2','<?php echo base_url("get_comp_exam_qualified_status"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Qualified / Not Qualified', formatRepoCommon,no_qualified_not_qualified_msg, false, formatRepoSelection);
       getSelect2('qualified_not_qualified_3','<?php echo base_url("get_comp_exam_qualified_status"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Qualified / Not Qualified', formatRepoCommon,no_qualified_not_qualified_msg, false, formatRepoSelection);
       getSelect2('taken_any_competitive_exam','<?php echo base_url("get_have_you_taken_any_competitive_exam"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Status', formatRepoCommon,no_taken_any_competitive_exam_msg, false, formatRepoSelection);
       getSelect2('is_work_experience','<?php echo base_url("get_is_work_experience_status"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Work Experience Status', formatRepoCommon,no_is_work_experience_msg, false, formatRepoSelection);

       getSelect2('BankName','<?php echo base_url("get_banks"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Bank', formatRepoCommon,no_banks_msg, false, formatRepoSelection);

       select2load('BankName','<?php echo $applicant_payment_details_list['bank_id']; ?>','<?php echo $applicant_payment_details_list['bank_name']; ?>');

            //Show phone code

       select2load('pd_father_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_father]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_father]; ?>');
    
       select2load('pd_father_alt_phone_no_code','<?php echo $applicant_parent_alt_mob_countrycode_id[$parent_type_id_father]; ?>','<?php echo $applicant_parent_alt_mob_country_code[$parent_type_id_father]; ?>');

       select2load('pd_mother_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_mother]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_mother]; ?>');

       select2load('pd_mother_alt_phone_no_code','<?php echo $applicant_parent_alt_mob_countrycode_id[$parent_type_id_mother]; ?>','<?php echo $applicant_parent_alt_mob_country_code[$parent_type_id_mother]; ?>');
    
        select2load('pd_guardian_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_guardian]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_guardian]; ?>');


         select2load('phone_no_code','<?php echo $applicant_basic_details_list['applicant_mob_country_code_id']; ?>','<?php echo $applicant_basic_details_list['applicant_mob_country_code_name']; ?>');  


  			$("#graduation_india").change(function()
        {
          basic_change();       
        });

        $('#qualifyingexamfromindia').change(function() {
          if($(this).is(':checked')) {
            $(this).val(1);
          } else {
            $(this).val(0);
          }
        }); 
				
			// Onchange COuntry
    $('#country').on('change',function() {
      setEmptyOnChangeSelect2('state'); 
      // when no values return in json, add empty option value 
      if ($('#state').data('select2')) {$('#state').select2('destroy');}
      // make empty
      $('#state').html('');
      var country_val = $(this).val();
      var url = '<?php echo base_url("get_states"); ?>?country_id='+country_val+'&sort_by=id&sort_order=asc'+url_edit;
      onchange_country('main_div_state','main_div_district','main_div_city','state','city','district',url,no_state_msg,country_value_default,country_val)
    }); 
    
    // Onchange State
    $('#state').on('change',function() {
      setEmptyOnChangeSelect2('district');
      // when no values return in json, add empty option value 
      if ($('#district').data('select2')) {
        $('#district').select2('destroy');
        // make empty
        $('#district,#city').html('');  
      }         
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
				//console.log("is_employed "+is_employed);
				
				if(is_employed=='yes'){
					$("#main_div_working_place").show();
				}else{
					$("#main_div_working_place").hide();
				}
			});	
			
			// Other Input Enable
			$('#qualifying_degree').on('change',function() {
				var qualifying_degree = $("#qualifying_degree").val();
				//console.log("qualifying_degree "+qualifying_degree);
				if(qualifying_degree==country_value_default){
					$("#other_qd").show();
				}else{
					$("#other_qd").hide();
				}
			});				
			
			
			// Basic Details On Change End
			
			// Personal Details On Change Start
			
			// $('#pd_nationality').on('change',function() {
			// 	var pd_nationality = $("#pd_nationality").val();
			// 	console.log("pd_nationality "+pd_nationality);
	
			// 	if(pd_nationality==country_value_default){
			// 		$("#main_div_social_status").show();
			// 	}else{
			// 		$("#main_div_social_status").hide();
			// 	}
			// });		

			$('#pd_nationality').on('change',function(){
				var pd_nationality = $('#pd_nationality').val();
				var val = (country_value_default == pd_nationality)?true:false;
				chk_social_status(val);
			});	


      onkeyValidationPexp('organisation_name_1','designation_1','nature_of_job_1','total_salary_month_1','from_year_1','to_year_1','work_experience_1');
      onkeyValidationPexp('designation_1','organisation_name_1','nature_of_job_1','total_salary_month_1','from_year_1','to_year_1','work_experience_1');
      onkeyValidationPexp('nature_of_job_1','organisation_name_1','designation_1','total_salary_month_1','from_year_1','to_year_1','work_experience_1');
      onkeyValidationPexp('total_salary_month_1','organisation_name_1','designation_1','nature_of_job_1','from_year_1','to_year_1','work_experience_1');
      onkeyValidationPexp('from_year_1','organisation_name_1','designation_1','nature_of_job_1','total_salary_month_1','to_year_1','work_experience_1');
      onkeyValidationPexp('to_year_1','organisation_name_1','designation_1','nature_of_job_1','total_salary_month_1','from_year_1','work_experience_1');

      onkeyValidationPexp('organisation_name_2','designation_2','nature_of_job_2','total_salary_month_2','from_year_2','to_year_2','work_experience_2');
      onkeyValidationPexp('designation_2','organisation_name_2','nature_of_job_2','total_salary_month_2','from_year_2','to_year_2','work_experience_2');
      onkeyValidationPexp('nature_of_job_2','organisation_name_2','designation_2','total_salary_month_2','from_year_2','to_year_2','work_experience_2');
      onkeyValidationPexp('total_salary_month_2','organisation_name_2','designation_2','nature_of_job_2','from_year_2','to_year_2','work_experience_2');
      onkeyValidationPexp('from_year_2','organisation_name_2','designation_2','nature_of_job_2','total_salary_month_2','to_year_2','work_experience_2');
      onkeyValidationPexp('to_year_2','organisation_name_2','designation_2','nature_of_job_2','total_salary_month_2','from_year_2','work_experience_2');


  onkeyValidationCEXAM('competitive_exam_2','registration_no_2','score_obtained_2','max_score_2','year_appeared_2','air_overall_rank_2','qualified_not_qualified_2');
  onkeyValidationCEXAM('registration_no_2','competitive_exam_2','score_obtained_2','max_score_2','year_appeared_2','air_overall_rank_2','qualified_not_qualified_2');
  onkeyValidationCEXAM('score_obtained_2','competitive_exam_2','registration_no_2','max_score_2','year_appeared_2','air_overall_rank_2','qualified_not_qualified_2');
  onkeyValidationCEXAM('max_score_2','registration_no_2','competitive_exam_2','score_obtained_2','year_appeared_2','air_overall_rank_2','qualified_not_qualified_2');
  onkeyValidationCEXAM('year_appeared_2','registration_no_2','score_obtained_2','max_score_2','competitive_exam_2','air_overall_rank_2','qualified_not_qualified_2');
  onkeyValidationCEXAM('air_overall_rank_2','registration_no_2','score_obtained_2','max_score_2','year_appeared_2','competitive_exam_2','qualified_not_qualified_2');
  onkeyValidationCEXAM('qualified_not_qualified_2','registration_no_2','score_obtained_2','max_score_2','year_appeared_2','air_overall_rank_2','competitive_exam_2');

  onkeyValidationCEXAM('competitive_exam_3','registration_no_3','score_obtained_3','max_score_3','year_appeared_3','air_overall_rank_3','qualified_not_qualified_3');
  onkeyValidationCEXAM('registration_no_3','competitive_exam_3','score_obtained_3','max_score_3','year_appeared_3','air_overall_rank_3','qualified_not_qualified_3');
  onkeyValidationCEXAM('score_obtained_3','competitive_exam_3','registration_no_3','max_score_3','year_appeared_3','air_overall_rank_3','qualified_not_qualified_3');
  onkeyValidationCEXAM('max_score_3','registration_no_3','competitive_exam_3','score_obtained_3','year_appeared_3','air_overall_rank_3','qualified_not_qualified_3');
  onkeyValidationCEXAM('year_appeared_3','registration_no_3','score_obtained_3','max_score_3','competitive_exam_3','air_overall_rank_3','qualified_not_qualified_3');
  onkeyValidationCEXAM('air_overall_rank_3','registration_no_3','score_obtained_3','max_score_3','year_appeared_3','competitive_exam_3','qualified_not_qualified_3');
  onkeyValidationCEXAM('qualified_not_qualified_3','registration_no_3','score_obtained_3','max_score_3','year_appeared_3','air_overall_rank_3','competitive_exam_3'); 
      


			$('#pd_diffrently_abled').on('change',function() {
				var pd_diffrently_abled = $("#pd_diffrently_abled").val();
				console.log("pd_diffrently_abled "+pd_diffrently_abled);
				
				if(pd_diffrently_abled=='yes'){
					$(".main_div_deformity").show();
				}else{
					$(".main_div_deformity").hide();
				}
			});
			
			$('#phone_no_code').on('change',function() {
				var phone_no_code = $("#phone_no_code").val();
				//console.log("phone_no_code "+phone_no_code);
			});	

      var id = "phone_no_code";
        var dbId = '<?php echo DEFAULT_MOBILE_CODE_ID; ?>';
        var dbVal = '<?php echo DEFAULT_MOBILE_CODE; ?>';
        select2Set(id,dbId,dbVal);
        $('#'+id).trigger('change');			
			
			// Personal Details On Change End
			
      // DOB Datepicker
      $("#pd_dob").datepicker( {
        format:"dd/mm/yyyy" ,autoclose: true,todayHighlight: true, endDate: endDob
      }).on('changeDate', function(e) {
              $("#pd_dob").parsley().validate();
      });

      $("#DDDate").datepicker( {
        format:"dd/mm/yyyy" ,autoclose: true,todayHighlight: true,todaybtn:true,endDate: todaydate
      }).on('changeDate', function(e) {
          $("#DDDate").parsley().validate();
      });

            $("#year_of_passing, #year_appeared_1, #year_appeared_2, #year_appeared_3").datepicker( {
                format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy')
            }).on('changeDate', function(e) {            
                var id=($(this).attr('id'));
              $("#"+id).parsley().validate();
            });


            $("#from_year_0, #from_year_1, #from_year_2, #to_year_0, #to_year_1, #to_year_2").datepicker( {
                format:"mm/yyyy" , autoclose: !0, minViewMode: 'months', endDate: moment().format('dd-mm-yyyy')
            }).on('changeDate', function(e) {            
                var id=($(this).attr('id'));
              $("#"+id).parsley().validate();
            });
            
            $("#result_declare_date").datepicker( {
                format:"mm/yyyy" , autoclose: !0, minViewMode: 'months', startDate: moment().format('dd-mm-yyyy')
            }).on('changeDate', function(e) {
          $("#result_declare_date").parsley().validate();
      });

            calculate_months('work_experience_0','from_year_0','to_year_0','months');
            calculate_months('work_experience_1','from_year_1','to_year_1','months');
            calculate_months('work_experience_2','from_year_2','to_year_2','months');
			calculate_total_exp('months');
			
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
                $("#marking_scheme").attr('data-parsley-required','false');
                $("#obtained_percentage_cgpa").attr('data-parsley-required','false');
                $("#result_declare_date").attr('data-parsley-required','true');
                $("#exp_year").show();
                $("#graduation_exam_marksheet_div").hide();
            })
            $("#completed").click(function () {
                $("#appering_info_1").show();
                $("#appering_info_2").show();
                $("#appering_info_3").show();
                $("#appering_info_4").show();
                $("#marking_scheme").attr('data-parsley-required','true');
                $("#obtained_percentage_cgpa").attr('data-parsley-required','true');
                $("#result_declare_date").attr('data-parsley-required','false');
                $("#exp_year").hide();
                $("#graduation_exam_marksheet_div").show();
            })

            <?php
            // db val check and trigger click for 12 appering
            if($cur_qual_completed == 't') {
              ?>
              $("#completed").trigger('click');
              <?php
            } else if($cur_qual_completed == 'f') {
              ?>
              $("#appering").trigger('click');
              <?php
            }
            ?>
            //$("#payment_details").hide();
            $("#online").click(function () {
                $("#payment_details").hide();
            })
            $("#dd").click(function () {
                $("#payment_details").show();
            })
            // $("#Community").hide();
            // $("#nationality_indian").change(function () {
            //     if ($("#nationality_indian").val() == "Indian") {
            //         $("#Community").show();
            //     }
            //     else {
            //         $("#Community").hide();

            //     }
            // });

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

      $('#institute_university').on('change',function() {
        var institute_university = $("#institute_university").val();
        //console.log("institute_university "+institute_university);
        
        if(institute_university==institute_university_other_id){
          $("#ob_univ").show();
        }else{
          $("#ob_univ").hide();
          $('#other_univ_grad').val('');
        }  
      });
        
			
			<?php
            if($applicant_course_course_id) {
                foreach($applicant_course_course_id as $k=>$v) {
                    $course_prefer_k = $k+1;
            ?>
                    var course_pref_<?php echo $course_prefer_k; ?> = "course_pref_<?php echo $course_prefer_k; ?>";
                    var course_pref_id<?php echo $course_prefer_k; ?> = '<?php echo $v; ?>';
                    var course_pref_name<?php echo $course_prefer_k; ?> = '<?php echo $applicant_course_course_name[$k]; ?>';
                     if(course_pref_name<?php echo $course_prefer_k; ?> != ''){

                        setTimeout(function(){ select2Set(course_pref_<?php echo $course_prefer_k; ?>,course_pref_id<?php echo $course_prefer_k; ?>,course_pref_name<?php echo $course_prefer_k; ?>);
                        	$('#'+course_pref_<?php echo $course_prefer_k; ?>).trigger('change');
                        }, 10);
                    }   
            <?php
                }
            }
            ?>
            <?php
            if($applicant_campus_campus_id) {
                foreach($applicant_campus_campus_id as $k=>$v) {
                    $campus_prefer_k = $k+1;
            ?>
                    var campus_pref_<?php echo $campus_prefer_k; ?> = "campus_pref_<?php echo $campus_prefer_k; ?>";
                    var campus_pref_id<?php echo $campus_prefer_k; ?> = '<?php echo $v; ?>';
                    var campus_pref_name<?php echo $campus_prefer_k; ?> = '<?php echo $applicant_campus_campus_name[$k]; ?>';
                     if(campus_pref_id<?php echo $campus_prefer_k; ?> != ''){
                        setTimeout(function(){ select2Set(campus_pref_<?php echo $campus_prefer_k; ?>,campus_pref_id<?php echo $campus_prefer_k; ?>,campus_pref_name<?php echo $campus_prefer_k; ?>);
                        	$('#'+campus_pref_<?php echo $campus_prefer_k; ?>).trigger('change');
                        }, 1);
                        //$('#'+campus_pref_<?php echo $campus_prefer_k; ?>).trigger('change');
                    }   
            <?php
                }
            }
            ?>

            <?php
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
            ?>

            <?php
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

      var graduation_india = "graduation_india";
      var studied_from_india_id = '<?php echo $studied_from_india_id; ?>';
      var studied_from_india_name = '<?php echo $studied_from_india_name; ?>';

      if(studied_from_india_id != ''){
        setTimeout(function(){ 
          select2Set(graduation_india,studied_from_india_id,studied_from_india_name);
          $('#'+graduation_india).trigger('change');
        }, 1);
      }

			var title_id = "pd_title";
			var dbtitle_id = db_title_id;			
			var dbtitle_val = db_title_name;
			//alert(dbcountry_val);
			 if(dbtitle_id != ''){
				setTimeout(function(){ select2Set(title_id,dbtitle_id,dbtitle_val);
          $('#'+title_id).trigger('change');
				}, 1);
			}

      var phone_no_code = "phone_no_code";
      var phone_no_code_id = db_phone_no_code_id;
      var phone_no_code_name_val = db_phone_no_code_name;
      if(phone_no_code_id != ''){
        setTimeout(function(){ 
          select2Set(phone_no_code,phone_no_code_id,phone_no_code_name_val);
          $('#'+phone_no_code).trigger('change');
        }, 1);
      }

			var gender_id = "pd_gender";
			var dbgender_id = db_gender_id;			
			var dbgender_val = db_gender_name;
			//alert(dbcountry_val);
			 if(dbgender_id != ''){
				setTimeout(function(){ select2Set(gender_id,dbgender_id,dbgender_val);
          $('#'+gender_id).trigger('change');
				}, 1);
			}

      var pd_social_status = "pd_social_status";
      var dbsocial_status_id = db_social_status_id;
      var dbsocial_status_name_val = db_social_status_name;
      if(dbsocial_status_id != ''){
        setTimeout(function(){ 
          select2Set(pd_social_status,dbsocial_status_id,dbsocial_status_name_val);
          $('#'+pd_social_status).trigger('change');
        }, 1);
      }

			var religion_id = "pd_religion";
			var dbreligion_id = db_religion_id;			
			var dbreligion_val = db_religion_name;
			//alert(dbcountry_val);
			 if(dbreligion_id != ''){
				setTimeout(function(){ select2Set(religion_id,dbreligion_id,dbreligion_val);
          $('#'+religion_id).trigger('change');
				}, 1);
			}

			var blood_grp_id = "pd_blood_group";			
			//alert(dbcountry_val);
			 if(db_blood_grp_id != ''){
				setTimeout(function(){ select2Set(blood_grp_id,db_blood_grp_id,db_blood_grp_name);
          $('#'+blood_grp_id).trigger('change');
				}, 1);
			}


			var mothertongue_id = "pd_mother_tongue";
			//alert(dbcountry_val);
			 if(db_mothertongue_id != ''){
				setTimeout(function(){ select2Set(mothertongue_id,db_mothertongue_id,db_mothertongue_name);
          $('#'+mothertongue_id).trigger('change');
				}, 1);
			}

			var medofinst_id = "pd_medium_of_instruction";
			//alert(db_med_of_inst_id);
			 if(db_med_of_inst_id != ''){
				setTimeout(function(){ select2Set(medofinst_id,db_med_of_inst_id,db_med_of_inst_name);
          $('#'+medofinst_id).trigger('change');
				}, 1);
			}

      var prefer_hostel_id = "pd_hostel_accommodation";
      var prefer_hostel_select = '<?php echo $prefer_hostel_select; ?>';
      var prefer_hostel_select_name = '<?php echo $prefer_hostel_select_name; ?>';
       if(prefer_hostel_select != ''){
        setTimeout(function(){ select2Set(prefer_hostel_id,prefer_hostel_select,prefer_hostel_select_name);
          $('#'+prefer_hostel_id).trigger('change');
        }, 1);
      }

      var diff_abled_id = "pd_diffrently_abled";
      var diff_abled_select = '<?php echo $dif_abled_select; ?>';
      var diff_abled_select_name = '<?php echo $dif_abled_select_name; ?>';
       if(diff_abled_select != ''){
        setTimeout(function(){ select2Set(diff_abled_id,diff_abled_select,diff_abled_select_name);
          $('#'+diff_abled_id).trigger('change');
        }, 1);
      }

			var advertisement_source_id = "pd_advertisement_source";
			//alert(dbcountry_val);
			 if(db_adv_source_id != ''){
				setTimeout(function(){ select2Set(advertisement_source_id,db_adv_source_id,db_adv_source_name);
          $('#'+advertisement_source_id).trigger('change');
				}, 1);
			}

			var nationality_id = "pd_nationality";
			//alert(dbcountry_val);
			 if(db_nationality_id != ''){
				setTimeout(function(){ select2Set(nationality_id,db_nationality_id,db_nationality_name);
          $('#'+nationality_id).trigger('change');
				var val = (db_nationality_id == country_value_default)?1:0;
	            chk_social_status(val);

				}, 1);
			}

			var mode_of_study = "mode_of_study";
			var mode_of_study_id = '<?php echo $applicant_grad_det_mode_of_study_id; ?>';
			var mode_of_study_name = '<?php echo $applicant_grad_det_mode_of_study_name; ?>';
			//alert(dbcountry_val);
			 if(mode_of_study_id != ''){
				setTimeout(function(){ select2Set(mode_of_study,mode_of_study_id,mode_of_study_name);
          $('#'+mode_of_study).trigger('change');
				}, 1);
			}


			var university_id = "institute_university";
			var db_univ_id = '<?php echo $applicant_grad_det_univ_id; ?>';
			var db_univ_name = '<?php echo $applicant_grad_det_univ_name; ?>';
			//alert(dbcountry_val);
			 if(db_univ_id != ''){
				setTimeout(function(){ select2Set(university_id,db_univ_id,db_univ_name);
					$('#'+university_id).trigger('change');
				}, 1);
			}


			var marking_scheme = "marking_scheme";
			var db_marking_schema_id = '<?php echo $applicant_grad_det_mark_scheme_id; ?>';
			var db_marking_schema_name = '<?php echo $applicant_grad_det_mark_scheme_name; ?>';
			//alert(dbcountry_val);
			 if(db_marking_schema_id != ''){
				setTimeout(function(){ select2Set(marking_scheme,db_marking_schema_id,db_marking_schema_name);
					$('#'+marking_scheme).trigger('change');
				}, 1);
			}

			var country_id = "country";
			var dbcountry_id = '<?php echo $country_id[0]; ?>';
			//alert(dbcountry_id);
			var dbcountry_val = '<?php echo $country_name[0]; ?>';
			//alert(dbcountry_val);
			 if(dbcountry_id != ''){
				setTimeout(function(){ 
					select2Set(country_id,dbcountry_id,dbcountry_val);
					$('#'+country_id).trigger('change');
				}, 1);
			}

			var state_id = "state";
			var dbstate_id = '<?php echo $state_id[0]; ?>';
			//alert(dbcountry_id);
			var dbstate_val = '<?php echo $state_name[0]; ?>';
			//alert(dbcountry_val);
			 if(dbstate_id != ''){
				setTimeout(function(){ 
					select2Set(state_id,dbstate_id,dbstate_val);
					$('#'+state_id).trigger('change');
				}, 1);
			}

			var district_id = "district";
			var dbdistrict_id = '<?php echo $district_id[0]; ?>';
			//alert(dbcountry_id);
			var dbdistrict_val = '<?php echo $district_name[0]; ?>';
			//alert(dbcountry_val);
			 if(dbdistrict_id != ''){
				setTimeout(function(){ select2Set(district_id,dbdistrict_id,dbdistrict_val);
					$('#'+district_id).trigger('change');
				}, 1);
			}

			var city_id = "city";
			var dbcity_id = '<?php echo $city_id[0]; ?>';
			//alert(dbcountry_id);
			var dbcity_val = '<?php echo $city_name[0]; ?>';
			//alert(dbcountry_val);
			 if(dbcity_id != ''){
				setTimeout(function(){ select2Set(city_id,dbcity_id,dbcity_val);
					$('#'+city_id).trigger('change');
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

        	/*Parents Details*/

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
                     if(parent_id<?php echo $k; ?> != ''){
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
                     if(phone_no_code_id<?php echo $k; ?> != ''){
                        // setTimeout(function(){ 
                          select2Set(phone_no_code<?php echo $k; ?>,phone_no_code_id<?php echo $k; ?>,phone_no_code_name<?php echo $k; ?>);
                        	$('#'+phone_no_code<?php echo $k; ?>).trigger('change');
                        // }, 1);
                    } else {
                      var dbId = '<?php echo DEFAULT_MOBILE_CODE_ID; ?>';
                      var dbVal = '<?php echo DEFAULT_MOBILE_CODE; ?>';
                      select2Set(phone_no_code<?php echo $k; ?>,dbId,dbVal);
                      $('#'+phone_no_code<?php echo $k; ?>).trigger('change');
                    }  
            <?php
                }
            } else {
              ?>
              /* fuction for select default country code on registration page */
        var id = "pd_father_phone_no_code";
        var dbId = '<?php echo DEFAULT_MOBILE_CODE_ID; ?>';
        var dbVal = '<?php echo DEFAULT_MOBILE_CODE; ?>';
        select2Set(id,dbId,dbVal);
        $('#'+id).trigger('change');

        var id = "pd_mother_phone_no_code";
        var dbId = '<?php echo DEFAULT_MOBILE_CODE_ID; ?>';
        var dbVal = '<?php echo DEFAULT_MOBILE_CODE; ?>';
        select2Set(id,dbId,dbVal);
        $('#'+id).trigger('change');

        var id = "pd_guardian_phone_no_code";
        var dbId = '<?php echo DEFAULT_MOBILE_CODE_ID; ?>';
        var dbVal = '<?php echo DEFAULT_MOBILE_CODE; ?>';
        select2Set(id,dbId,dbVal);
        $('#'+id).trigger('change');
        /* End of Code */
              <?php
            }
            ?>

            <?php
            if($applicant_parent_alt_mob_countrycode_id) {
                foreach($applicant_parent_alt_mob_countrycode_id as $k=>$v) {
                	if($k == $parent_type_id_father) {
                		$input_name = 'pd_father_alt_phone_no_code';
                	} else if ($k == $parent_type_id_mother) {
                		$input_name = 'pd_mother_alt_phone_no_code';
                	}/* else {
                		$input_name = 'pd_guardian_alt_phone_no_code';
                	}*/
            ?>
                    var phone_no_code<?php echo $k; ?> = '<?php echo $input_name; ?>';
                    var phone_no_code_id<?php echo $k; ?> = '<?php echo $v; ?>';
                    var phone_no_code_name<?php echo $k; ?> = '<?php echo $applicant_parent_alt_mob_country_code[$k]; ?>';
                     if(phone_no_code_id<?php echo $k; ?> != ''){
                        setTimeout(function(){ 
                          select2Set(phone_no_code<?php echo $k; ?>,phone_no_code_id<?php echo $k; ?>,phone_no_code_name<?php echo $k; ?>);
                        	$('#'+phone_no_code<?php echo $k; ?>).trigger('change');
                        }, 1);
                      } else {
                        var phone_no_code_id<?php echo $k; ?> = '<?php echo DEFAULT_MOBILE_CODE_ID; ?>';
                        var phone_no_code_name<?php echo $k; ?> = '<?php echo DEFAULT_MOBILE_CODE; ?>';
                        select2Set(phone_no_code<?php echo $k; ?>,phone_no_code_id<?php echo $k; ?>,phone_no_code_name<?php echo $k; ?>);
                        $('#'+phone_no_code<?php echo $k; ?>).trigger('change');
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
            if($applicant_parent_occupation_id) {
                foreach($applicant_parent_occupation_id as $k=>$v) {
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
                     if(occupation_id<?php echo $k; ?> != ''){
                        setTimeout(function(){ select2Set(occupation<?php echo $k; ?>,occupation_id<?php echo $k; ?>,occupation_name<?php echo $k; ?>);
                        	$('#'+occupation<?php echo $k; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
            ?>

            <?php
            $chk_guardian = ($add_gardian == 't')?1:0;
            if($chk_guardian) {
            ?>
            chk_guardian(<?php echo $chk_guardian; ?>);
            <?php
        	}
            ?>

    <?php
      if($applicant_comp_exam_id) {
        foreach($applicant_comp_exam_id as $k=>$v) {
          $applicant_comp_exam_id_k = ($k+1);
          ?>
          var competitive_exam_<?php echo $applicant_comp_exam_id_k; ?> = "competitive_exam_<?php echo $applicant_comp_exam_id_k; ?>";
          var applicant_comp_exam_id<?php echo $applicant_comp_exam_id_k; ?> = '<?php echo $v; ?>';
          //alert(dbcountry_id);
          var applicant_comp_exam_name<?php echo $applicant_comp_exam_id_k; ?> = '<?php echo $applicant_comp_exam_name[$k]; ?>';
          //alert(dbcountry_val);
           if(applicant_comp_exam_id<?php echo $applicant_comp_exam_id_k; ?> != ''){
            setTimeout(function(){ select2Set(competitive_exam_<?php echo $applicant_comp_exam_id_k; ?>,applicant_comp_exam_id<?php echo $applicant_comp_exam_id_k; ?>,applicant_comp_exam_name<?php echo $applicant_comp_exam_id_k; ?>);
              $('#'+competitive_exam_<?php echo $applicant_comp_exam_id_k; ?>).trigger('change');
            }, 1);
          }
          <?php
        }
      }
      ?>

      <?php
      if($applicant_comp_exam_qualified_select) {
        foreach($applicant_comp_exam_qualified_select as $k=>$v) {
          $applicant_comp_exam_qualified_k = ($k+1);
          ?>
          var qualified_not_qualified_<?php echo $applicant_comp_exam_qualified_k; ?> = "qualified_not_qualified_<?php echo $applicant_comp_exam_qualified_k; ?>";
          var applicant_comp_exam_qualified_select<?php echo $applicant_comp_exam_qualified_k; ?> = '<?php echo $v; ?>';
          //alert(dbcountry_id);
          var applicant_comp_exam_qualified_select_name<?php echo $applicant_comp_exam_qualified_k; ?> = '<?php echo $applicant_comp_exam_qualified_select_name[$k]; ?>';
          //alert(dbcountry_val);
           if(applicant_comp_exam_qualified_select<?php echo $applicant_comp_exam_qualified_k; ?> != ''){
            setTimeout(function(){ select2Set(qualified_not_qualified_<?php echo $applicant_comp_exam_qualified_k; ?>,applicant_comp_exam_qualified_select<?php echo $applicant_comp_exam_qualified_k; ?>,applicant_comp_exam_qualified_select_name<?php echo $applicant_comp_exam_qualified_k; ?>);
              $('#'+qualified_not_qualified_<?php echo $applicant_comp_exam_qualified_k; ?>).trigger('change');
            }, 1);
          }
          <?php
        }
      }
      ?>
	  
			validate_cgpa('marking_scheme','obtained_percentage_cgpa');

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

      //onchangeLableHide('course_pref_1');
      onchangeLableHide('campus_pref_1');
      onchangeLableHide('institute_university');
      onchangeLableHide('mode_of_study');
      onchangeLableHide('year_of_passing','date');
      onchangeLableHide('marking_scheme');
      onchangeLableHide('taken_any_competitive_exam');
      onchangeLableHide('competitive_exam_1');
      onchangeLableHide('year_appeared_1','date');
      onchangeLableHide('qualified_not_qualified_1');
      onchangeLableHide('is_work_experience');
      onchangeLableHide('from_year_0','date');
      onchangeLableHide('to_year_0','date');
      onchangeLableHide('from_year_1','date');
      onchangeLableHide('to_year_1','date');
      onchangeLableHide('from_year_2','date');
      onchangeLableHide('to_year_2','date');

      // Parent Other Occupation Enable 
      parent_other_occupation_enable('pd_father_occupation','other_occupation_father_div',occupation_other_id);
      parent_other_occupation_enable('pd_mother_occupation','other_occupation_mother_div',occupation_other_id);
      parent_other_occupation_enable('pd_guardian_occupation','other_occupation_guardian_div',occupation_other_id);

		});
		
	//initialization options for the progress bar
	// var progress = $("#progress").shieldProgressBar({
	// 	min: 0,
	// 	max: 100,
	// 	value: 20,
	// 	layout: "circular",
	// 	layoutOptions: {
	// 		circular: {
	// 			borderColor: "#eee",
	// 			width: 10,
	// 			borderWidth: 1,
	// 			color: "#5CB85C",

	// 		}
	// 	},
	// 	text: {
	// 		enabled: true,
	// 		//  template: '<span style="font-size:20px; color: #5CB85C;">{0:n0}%</span>'
	// 		template: '<span style="font-size:20px; color: #5CB85C;">20%</span>'
	// 	},
	// }).swidget();

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
        formData.append('file_extension', file_extension);
        formData.append('max_file_size_js', max_file_size_js);
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
        // console.log('valid => '+valid);
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
                  // $('#'+file_doc_type).filestyle({icon: true, input: true, htmlIcon: '<i class="spinner-grow spinner-grow-sm" aria-hidden="true"></i>&nbsp;',text:'Loading...'});
                },
                success: function(returndata) {
                    // console.log(returndata);
                    // console.log(returndata.data.data);
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
                            filename_html += '<span class="file_name  mt-3"><a class="image-popup-vertical-fit" href="<?php echo base_url(); ?>'+file_path+'" target="_blank" title="'+file_name_user+'">'+file_name_truncate+' <i class="fa fa-eye" aria-hidden="true"></i></a></span><a href="javascript:void(0)" data-del-file-id="'+id+'" data-doc-id="'+doc_id+'" data-toggle="modal" data-target="#contentDeletePop" data-field="'+file_doc_type+'" data-required="'+parsley_required+'" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a><div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_'+doc_id+'"><a href="#" class="close" onclick="hideAlert(\'deleteMessage_'+doc_id+'\')">&times;</a><strong id="deleteMessageStatus_'+doc_id+'"></strong> <span id="deleteMessageSpan_'+doc_id+'"></span></div>';
                            filename_ids.push(id);
                        });
                        $('#'+file_doc_type).parent().find('span.file_name').remove();
                        $('#'+file_doc_type).parent().find('[data-del-file-id]').remove();
                        $('#'+file_doc_type).parent().find('.alert').remove();
                        $('#'+file_doc_type).parent().append(filename_html);
                        $('#'+file_doc_type).attr('data-file-count',db_file_count);
                        $('#'+file_doc_type).attr('data-file-id',filename_ids.join(','));
                        $('#'+file_doc_type).attr('data-parsley-required','false');
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
                        $('#'+file_doc_type).parent().append('<!-- <span class="file_name  mt-3"><a class="image-popup-vertical-fit" href="<?php echo base_url(); ?>'+file_path+'" target="_blank" title="'+file_name_user+'">'+file_name_truncate+' <i class="fa fa-eye" aria-hidden="true"></i></a></span><a href="javascript:void(0)" data-del-file-id="'+id+'" data-doc-id="'+doc_id+'" data-toggle="modal" data-target="#contentDeletePop" data-field="'+file_doc_type+'" data-required="'+parsley_required+'" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a> --><div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_'+doc_id+'"><a href="#" class="close" onclick="hideAlert(\'deleteMessage_'+doc_id+'\')">&times;</a><strong id="deleteMessageStatus_'+doc_id+'"></strong> <span id="deleteMessageSpan_'+doc_id+'"></span></div>');
                        setTimeout(function() { 
                          upload_file_set_download_delete_options(file_doc_type, file_name, file_path, doc_id, id, parsley_required,mode_edit_url);
                        }, 100);
                        $('#'+file_doc_type).attr('data-parsley-required','false');
                        $('#'+file_doc_type).attr('data-file-id',id);

                    }
                    light_box_init();
                },
                error: function(returndata) {
                  //console.log(returndata);
                },
            });
        } else {
          $('#'+file_doc_type).parsley().validate();
        }
    }

    function removeClick(dataThis) {
        var id = $(dataThis).attr('data-del-file-id');
        var doc_id = $(dataThis).attr('data-doc-id');
        var required = $(dataThis).attr('data-required');
        var field = $(dataThis).attr('data-field');
        //console.log('id => '+id);
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
        //console.log('data_del_file_id => '+data_del_file_id);
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
                    
                    upload_file_unset_download_delete_options(field);
                    $('#' + spanId).text(msg);
                    setTimeout(function () {
                        $('#' + divId).hide('slow');
                    //     window.location.reload();
                      if(required == 'true' || required == true) {
                        $('#'+field).attr('data-parsley-required',required);
                        $('#'+field).parsley().validate();
                        $('#'+field).parsley().isValid();
                        $('#'+field).removeClass('parsley-success');
                      }
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

    function course_pref_change(course,campus,campus_div,campus_placeholder) {
    	$('#'+course).on('change',function() {
			setEmptyOnChangeSelect2(campus);
			if ($('#'+campus).data('select2')) {
				$('#'+campus).select2('destroy');
			}				
			$('#'+campus).html(''); 			
			var course_val = $(this).val();
			//  console.log("course_val "+course_val);
			$('#'+campus_div).show();
			getSelect2(campus,'<?php echo base_url("get_choice_dropdown"); ?>?branch_id='+course_val+'&is_lookup_master=1&is_campus=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc'+url_edit,campus_placeholder, formatRepoCommon,no_campus_msg, false, formatRepoSelection);
		});
    }

    function campus_pref_change(course,campus,campus_div,course_div,course_placeholder) {
      $('#'+campus).on('change',function() {
      setEmptyOnChangeSelect2(course);
      if ($('#'+course).data('select2')) {
        $('#'+course).select2('destroy');
      }       
      $('#'+course).html('');       
      var campus_val = $(this).val();
      //  console.log("course_val "+course_val);
      $('#'+course_div).show();
      var exclude_coursepref_ids = [];
      $('.test_course').each(function() {
        var this_id = $(this).attr('id');
        if(this_id != course) {
          var val = $(this).val();
            if(val) { exclude_coursepref_ids.push(val); }
      }
      });
      /*getSelect2(campus,'<?php echo base_url("get_choice_dropdown"); ?>?branch_id='+course_val+'&is_lookup_master=1&is_campus=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc',campus_placeholder, formatRepoCommon,no_campus_msg, false, formatRepoSelection);*/
      getSelect2(course,'<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_course=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&campus_id='+campus_val+'&sort_by=name&sort_order=asc&exclude_coursepref_ids='+exclude_coursepref_ids+url_edit,course_placeholder, formatRepoCommon,no_course_msg, false, formatRepoSelection);
    });
    }

    function test_state_pref(state,state_placeholder) {
		getSelect2(state,'<?php echo base_url("get_states"); ?>?country_id='+country_value_default+	'&sort_by=id&sort_order=asc'+url_edit,state_placeholder, formatRepoCommon,no_state_msg, false, formatRepoSelection);
    }

    function test_state_pref_change(state,city,city_div,city_placeholder) {
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

    function chk_guardian(val) {
    	// if($(this).is(':checked')) {
    	if(val) {
			$('#add_guardian_checkbox').val('true');
			$('#guardian_details').show();
      $('#pd_guardian_name').attr('data-parsley-required',"true"); 
      $('#pd_guardian_phone').attr('data-parsley-required',"true");
      //$('#pd_guardian_email').attr('data-parsley-required',"true"); 
      //$('#pd_guardian_occupation').attr('data-parsley-required',"true"); 
      //$("#custom-pd_guardian_occupation-parsley-error").show();
      $("#custom-pd_guardian_phone-parsley-error").show();
	   $("#pd_guardian_phone").attr('data-parsley-mobileonly','true');	
      //$("#custom-pd_guardian_email-parsley-error").show();
		} else {
			$('#add_guardian_checkbox').val('false');
			$('#guardian_details').hide();
      $("#pd_guardian_phone").val('');
      $("#pd_guardian_name").val('');
      $("#pd_guardian_email").val('');
      setTimeout(function(){ select2Set("pd_guardian_occupation",'','');
        }, 1);
      $('#pd_guardian_name').attr('data-parsley-required',"false"); 
      $('#pd_guardian_phone').attr('data-parsley-required',"false");
	   $("#pd_guardian_phone").attr('data-parsley-mobileonly','true');	
      //$('#pd_guardian_email').attr('data-parsley-required',"false"); 
      //$('#pd_guardian_occupation').attr('data-parsley-required',"false"); 
      //$("#custom-pd_guardian_occupation-parsley-error").hide();
      $("#custom-pd_guardian_phone-parsley-error").hide();
      //$("#custom-pd_guardian_email-parsley-error").hide();

      $("input[name=pd_guardian_email]").parsley().reset();
      $("input[name=pd_guardian_name]").parsley().reset();
      $("select[name=pd_guardian_occupation]").parsley().reset();
      $("input[name=pd_guardian_phone]").parsley().reset();
		}
    }

    function chk_social_status(val) {
    	// if($(this).is(':checked')) {
    	if(val) {
			$('#pd_social_status').attr('data-parsley-required','true');
			$('#main_div_community').show();
		} else {
			$('#pd_social_status').attr('data-parsley-required','false');
			$('#main_div_community').hide();
		}
    }

    function chk_competitive_exam(val) {
    	// if($(this).is(':checked')) {
    	if(val) {
			$('#competitive_exam_1').attr('data-parsley-required','true');
			$('#registration_no_1').attr('data-parsley-required','true');
			$('#score_obtained_1').attr('data-parsley-required','true');
			$('#max_score_1').attr('data-parsley-required','true');
			$('#year_appeared_1').attr('data-parsley-required','true');
			$('#air_overall_rank_1').attr('data-parsley-required','true');
			$('#qualified_not_qualified_1').attr('data-parsley-required','true');
			$('#competitive_exam_dtl').show();
      $('#competitive_exam_marksheet_div').show();      
		} else {
			$('#competitive_exam_1').attr('data-parsley-required','false');
			$('#registration_no_1').attr('data-parsley-required','false');
			$('#score_obtained_1').attr('data-parsley-required','false');
			$('#max_score_1').attr('data-parsley-required','false');
			$('#year_appeared_1').attr('data-parsley-required','false');
			$('#air_overall_rank_1').attr('data-parsley-required','false');
			$('#qualified_not_qualified_1').attr('data-parsley-required','false');
			$('#competitive_exam_dtl').hide();
      $('#competitive_exam_marksheet_div').hide();
      setTimeout(function(){ select2Set("competitive_exam_1",'','');
        }, 1);
      $('#registration_no_1').val('');
      $('#score_obtained_1').val('');
      $('#max_score_1').val('');
      $('#year_appeared_1').val('');
      $('#air_overall_rank_1').val('');
      setTimeout(function(){ select2Set("qualified_not_qualified_1",'','');
        }, 1);

      setTimeout(function(){ select2Set("competitive_exam_2",'','');
        }, 1);
      $('#registration_no_2').val('');
      $('#score_obtained_2').val('');
      $('#max_score_2').val('');
      $('#year_appeared_2').val('');
      $('#air_overall_rank_2').val('');
      setTimeout(function(){ select2Set("qualified_not_qualified_2",'','');
        }, 1);

      setTimeout(function(){ select2Set("competitive_exam_3",'','');
        }, 1);
      $('#registration_no_3').val('');
      $('#score_obtained_3').val('');
      $('#max_score_3').val('');
      $('#year_appeared_3').val('');
      $('#air_overall_rank_3').val('');
      setTimeout(function(){ select2Set("qualified_not_qualified_3",'','');
        }, 1);

		}
    }

    function chk_work_experience(val) {
    	// if($(this).is(':checked')) {
    	if(val) {
			$('#organisation_name_0').attr('data-parsley-required','true');
			$('#designation_0').attr('data-parsley-required','true');
			$('#nature_of_job_0').attr('data-parsley-required','true');
			$('#total_salary_month_0').attr('data-parsley-required','true');
			$('#from_year_0').attr('data-parsley-required','true');
			$('#to_year_0').attr('data-parsley-required','true');
			$('#work_experience_0').attr('data-parsley-required','true');
			$('#emp_exp').show();
			$('#emp_total_exp').show();
		} else {
			$('#organisation_name_0').attr('data-parsley-required','false');
			$('#designation_0').attr('data-parsley-required','false');
			$('#nature_of_job_0').attr('data-parsley-required','false');
			$('#total_salary_month_0').attr('data-parsley-required','false');
			$('#from_year_0').attr('data-parsley-required','false');
			$('#to_year_0').attr('data-parsley-required','false');
			$('#work_experience_0').attr('data-parsley-required','false');
			$('#emp_exp').hide();
			$('#emp_total_exp').hide();

      $("#organisation_name_0").val('');
      $('#designation_0').val('');
      $('#nature_of_job_0').val('');
      $('#total_salary_month_0').val('');
      $('#from_year_0').val('');
      $('#to_year_0').val('');
      $('#work_experience_0').val('');
      $('#total_work_experience').val('');

      $("#organisation_name_1").val('');
      $('#designation_1').val('');
      $('#nature_of_job_1').val('');
      $('#total_salary_month_1').val('');
      $('#from_year_1').val('');
      $('#to_year_1').val('');
      $('#work_experience_1').val('');
      

      $("#organisation_name_2").val('');
      $('#designation_2').val('');
      $('#nature_of_job_2').val('');
      $('#total_salary_month_2').val('');
      $('#from_year_2').val('');
      $('#to_year_2').val('');
      $('#work_experience_2').val('');
      

		}
    }

    function basic_change() {
      $("#halterror").hide();
      $("li a").css("pointer-events", "unset"); 
      var study_india_id = $("#graduation_india").val();        

        if (study_india_id == 'yes') {
            $("#confirm_indian").show(); 
            $("#confirm_notindian").hide();           
            $('#qualifyingexamfromindia').attr('data-parsley-required',"true");           
        }
        else if (study_india_id == 'no') {
          $("li a").css("pointer-events", "none");
            $("#confirm_indian").hide();
            $("#confirm_notindian").show();        
            $('#qualifyingexamfromindia').attr('data-parsley-required',"false");
            $("#halterror").show();
        } else {
          $("#confirm_indian").hide();  
          $("#confirm_notindian").hide();          
            $('#qualifyingexamfromindia').attr('data-parsley-required',"false");
        }
    }

    function declaration_func(currentIndex) {
        var applicant_name = $('#applicant_name').parsley();
        var parent_name = $('#parent_name').parsley();
        var declaration_date = $('#declaration_date').parsley();
        if(applicant_name.isValid() && parent_name.isValid() && declaration_date.isValid()) {
          var applicant_name  = $('#applicant_name').val();
          var parent_name   = $('#parent_name').val();
          var declaration_date  = $('#declaration_date').val();
          var csrfHashRegenerateonDec = $("input[name='"+csrfName+"']").val();
          var userData = 'applicant_name='+applicant_name+'&parent_name='+parent_name+'&declaration_date='+declaration_date+'&'+csrfName+'='+csrfHash;
          var AjaxRequest = $.ajax({
        type: 'POST',
        url: url,
        // data: userData+'&currentIndex='+currentIndex+'&<?php //echo $this->security->get_csrf_token_name(); ?>=<?php //echo $this->security->get_csrf_hash(); ?>',
        data: userData+'&currentIndex='+currentIndex,
        dataType: 'json',
        cache: false,
        success: function(returndata) {
          if(returndata.status == true || returndata.status == 'true'){
            setTimeout(function() { window.location.href = redirect_thank+url_edit; }, 100);
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

      return AjaxRequest;
            // return true;       
        } else {
          applicant_name.validate();
          parent_name.validate();
          declaration_date.validate();
            return false;
        }
    }
</script>