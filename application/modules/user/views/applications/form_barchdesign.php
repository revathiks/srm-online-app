<?php
/*Constants*/
$parent_type_id_father = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
$country_value_default = COUNTRY_VALUE_DEFAULT;
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
$app_form_id_barch=APP_FORM_ID_BARCH;

$form_wizard_basic_id = FORM_WIZARD_BASIC_ID;
$form_wizard_preference_personal_id = FORM_WIZARD_PERSONAL_ID;
$form_wizard_parent_id = FORM_WIZARD_PARENT_ID; 
$form_wizard_address_id = FORM_WIZARD_ADDRESS_ID; 
$form_wizard_academic_id = FORM_WIZARD_ACADEMIC_ID;
$form_wizard_payment_id = FORM_WIZARD_PAYMENT_ID;
$form_wizard_upload_declaration_id = FORM_WIZARD_UPLOAD_DECLARATION_ID;
/*Constants*/

/*File Upload Start*/
$docs=array();
$file_count = 0;

if($upload_filelist){
foreach($upload_filelist as $doc){
   if($doc['document_id'] == $document_id_tentative_topic) {
      $docs[$doc['document_id']][]=array(
        'id'=>$doc['id'],
        'file_name'=>$doc['name'],
        'file_name_user'=>remove_file_separator($doc['name']),
        'file_name_truncate'=>remove_file_separator($doc['name'], true),
        'file_path'=>$doc['path'],
      );
      $file_count++;
   } else {
      $docs[$doc['document_id']]=array(
        'id'=>$doc['id'],
        'file_name'=>$doc['name'],
        'file_name_user'=>remove_file_separator($doc['name']),
        'file_name_truncate'=>remove_file_separator($doc['name'], true),
        'file_path'=>$doc['path'],
      );
   }
}
}
$docs['file_count'] = $file_count;
/*File Upload End*/

/*Basic Details Start*/
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

/*Parent Details Start*/
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
$parent_name = $applicant_basic_details_list['parent_name'];
$father_name = $applicant_parent_parent_name[$parent_type_id_father];
$mother_name = $applicant_parent_parent_name[$parent_type_id_mother];
$guardian_name = $applicant_parent_parent_name[$parent_type_id_guardian];
$parent_name = (($parent_name)?$parent_name:(($father_name)?$father_name:(($mother_name)?$mother_name:(($guardian_name)?$guardian_name:''))));
/*Parent Details End*/


/*Address Details Start*/
//print_r($applicant_address_details_list);
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
/*Address Details End*/

/*Other Details Start*/
$cur_qual_completed = $applicant_other_details_list['cur_qual_completed'];
$is_competitive_exam = $applicant_other_details_list['is_competitive_exam'];
/*Other Details End*/

$applicant_schooling_id  = $applicant_schooling_name = $applicant_institute_name = $applicant_board_id = $applicant_board_name = $applicant_marking_scheme_id = $applicant_marking_scheme_name = $applicant_obtained_percentage_cgpa = $applicant_year_of_passing = $applicant_registration_no =  $applicant_tenth_name = $applicant_mode_of_study_id = $applicant_mode_of_study_name = $applicant_address_of_school_college = $applicant_scl_det_id = $applicant_result_declared = $app_comp_exam_id = $app_comp_exam_name = $app_comp_registration_no =  $app_comp_score_obtained = $app_comp_max_score = $app_comp_exam_year = $app_comp_all_india_rank = $app_comp_qualified = $applicant_entr_exam_det_id = array();

//print_r($applicant_competitive_details_list);


/*Competitive Exam Start*/
if($applicant_competitive_details_list)
{
  foreach($applicant_competitive_details_list as $k=>$v)
  {
      $app_comp_exam_id[] = $v['comp_exam_id'];
      $app_comp_exam_name[] = $v['comp_exam_name'];
      $app_comp_registration_no[] = $v['registration_no'];
      $app_comp_score_obtained[] = $v['score_obtained'];
      $app_comp_max_score[] = $v['max_score'];
      $app_comp_exam_year[] = $v['exam_year'];
      $app_comp_all_india_rank[] = $v['all_india_rank'];
      $app_comp_qualified[] = $v['qualified'];
      $applicant_entr_exam_det_id[]=$v['applicant_entr_exam_det_id'];
  }
}

/*Competitive Exam End*/

//print_r($applicant_schooling_details_list);
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
  }
}
/*Schooling Details End*/
//print_r($applicant_appln_details_list);

// $is_qualify = $applicant_appln_details_list['is_qualify'];
// $appln_form_id = $applicant_appln_details_list['appln_form_id'];
// $applicant_appln_id = $applicant_appln_details_list['applicant_appln_id'];
// echo '<pre>';
// print_r($applicant_appln_details_list);
// print_r($applicant_course_prefer_details_list);
// print_r($applicant_campus_prefer_details_list);
// print_r($applicant_city_prefer_details_list);
// print_r($applicant_parent_details_list);
// print_r($applicant_address_details_list);
// echo '</pre>';
//$is_agree = $applicant_appln_details_list[0]['is_agree'];
//echo $is_agree."is_agress";

//print_r($applicant_appln_details_list);
if($applicant_appln_details_list) {
   foreach($applicant_appln_details_list as $k=>$v) {
      $appln_form_id = $v['appln_form_id'];
      if($app_form_id_barch == $appln_form_id) {
        $applicant_appln_id = $v['applicant_appln_id'];
        $is_qualify = $v['qualifyingexamfromindia'];
        $is_agree =$v['is_agree'];
      }
   }
}

$application_status_id =$applicant_appln_details_list[0]['application_status_id'];

//print_r($applicant_course_details_list);die;
//Course Prefer
if($applicant_course_details_list) {
  foreach($applicant_course_details_list as $k=>$v) {
      $applicant_course_prefer_id = $v['applicant_course_id'];
      //$course_prefer_id = $v['course_id'];
      $course_prefer_id = $v['branch_id'];
      $course_prefer_name=$v['course_name'];
   }
}

//print_r($applicant_address_details_list);

$applicant_campus_prefer_id = $campus_prefer_id = $campus_prefer_name = array();
//Campus Prefer
if($applicant_campus_details_list) {
  foreach($applicant_campus_details_list as $k=>$v) {
      $applicant_campus_prefer_id[] = $v['applicant_campus_prefer_id'];
      $campus_prefer_id[] = $v['campus_id'];
      $campus_prefer_name[]=$v['campus_name'];
   }
}


$applicant_name = $applicant_appln_details_list[0]['applicant_name_declaration'];
$applicant_name_declaration = ($applicant_name)?$applicant_name:$first_name;
$applicant_parentname_declaration = $applicant_appln_details_list[0]['applicant_parentname_declaration'];
$declaration_date = $applicant_appln_details_list[0]['applicant_declaration_date'];
$applicant_declaration_date = ($declaration_date)?date('d/m/Y',strtotime($declaration_date)):date('d/m/Y');

/* form wizard instruction detail start */
$applicant_basic_wizard_id = $applicant_instructions_list[$form_wizard_basic_id][0]['form_w_wizard_id'];
$applicant_basic_wizard_instructions = $applicant_instructions_list[$form_wizard_basic_id][0]['instruction'];
if($applicant_basic_wizard_instructions) {
  $applicant_basic_wizard_instructions = nl2br($applicant_basic_wizard_instructions);
} else {
  $applicant_basic_wizard_instructions = ' - ';
}
$applicant_basic_wizard_percent = $applicant_instructions_list[$form_wizard_basic_id][0]['completion_percent'];
$applicant_basic_wizard_message = $applicant_instructions_list[$form_wizard_basic_id][0]['message'];

$applicant_pref_per_wizard_id = $applicant_instructions_list[$form_wizard_preference_personal_id][0]['form_w_wizard_id'];
$applicant_pref_per_wizard_instructions = $applicant_instructions_list[$form_wizard_preference_personal_id][0]['instruction'];
if($applicant_pref_per_wizard_instructions) {
  $applicant_pref_per_wizard_instructions = nl2br($applicant_pref_per_wizard_instructions);
} else {
  $applicant_pref_per_wizard_instructions = ' - ';
}
$applicant_pref_per_wizard_percent = $applicant_instructions_list[$form_wizard_preference_personal_id][0]['completion_percent'];
$applicant_pref_per_wizard_message = $applicant_instructions_list[$form_wizard_preference_personal_id][0]['message'];

$applicant_parent_wizard_id = $applicant_instructions_list[$form_wizard_parent_id][0]['form_w_wizard_id'];
$applicant_parent_wizard_instructions = $applicant_instructions_list[$form_wizard_parent_id][0]['instruction'];
if($applicant_parent_wizard_instructions) {
  $applicant_parent_wizard_instructions = nl2br($applicant_parent_wizard_instructions);
} else {
  $applicant_parent_wizard_instructions = ' - ';
}
$applicant_parent_wizard_percent = $applicant_instructions_list[$form_wizard_parent_id][0]['completion_percent'];
$applicant_parent_wizard_message = $applicant_instructions_list[$form_wizard_parent_id][0]['message'];


$applicant_address_wizard_id = $applicant_instructions_list[$form_wizard_address_id][0]['form_w_wizard_id'];
$applicant_address_wizard_instructions = $applicant_instructions_list[$form_wizard_address_id][0]['instruction'];
if($applicant_address_wizard_instructions) {
  $applicant_address_wizard_instructions = nl2br($applicant_address_wizard_instructions);
} else {
  $applicant_address_wizard_instructions = ' - ';
}
$applicant_address_wizard_percent = $applicant_instructions_list[$form_wizard_address_id][0]['completion_percent'];
$applicant_address_wizard_message = $applicant_instructions_list[$form_wizard_address_id][0]['message'];

$applicant_academic_wizard_id = $applicant_instructions_list[$form_wizard_academic_id][0]['form_w_wizard_id'];
$applicant_academic_wizard_instructions = $applicant_instructions_list[$form_wizard_academic_id][0]['instruction'];
if($applicant_academic_wizard_instructions) {
  $applicant_academic_wizard_instructions = nl2br($applicant_academic_wizard_instructions);
} else {
  $applicant_academic_wizard_instructions = ' - ';
}
$applicant_academic_wizard_percent = $applicant_instructions_list[$form_wizard_academic_id][0]['completion_percent'];
$applicant_academic_wizard_message = $applicant_instructions_list[$form_wizard_academic_id][0]['message'];

$applicant_payment_wizard_id = $applicant_instructions_list[$form_wizard_payment_id][0]['form_w_wizard_id'];
$applicant_payment_wizard_instructions = $applicant_instructions_list[$form_wizard_payment_id][0]['instruction'];
if($applicant_payment_wizard_instructions) {
  $applicant_payment_wizard_instructions = nl2br($applicant_payment_wizard_instructions);
} else {
  $applicant_payment_wizard_instructions = ' - ';
}
$applicant_payment_wizard_percent = $applicant_instructions_list[$form_wizard_payment_id][0]['completion_percent'];
$applicant_payment_wizard_message = $applicant_instructions_list[$form_wizard_payment_id][0]['message'];


$applicant_upload_declaration_wizard_id = $applicant_instructions_list[$form_wizard_upload_declaration_id][0]['form_w_wizard_id'];
$applicant_upload_declaration_wizard_instructions = $applicant_instructions_list[$form_wizard_upload_declaration_id][0]['instruction'];

if($applicant_upload_declaration_wizard_instructions) {
  $applicant_upload_declaration_wizard_instructions = nl2br($applicant_upload_declaration_wizard_instructions);
} else {
  $applicant_upload_declaration_wizard_instructions = ' - ';
}
$applicant_upload_declaration_wizard_percent = $applicant_instructions_list[$form_wizard_upload_declaration_id][0]['completion_percent'];
$applicant_upload_declaration_wizard_message = $applicant_instructions_list[$form_wizard_upload_declaration_id][0]['message'];

// Form Wizard End

$appln_form_fee = $applicant_appln_details_list[0]['appln_form_fee'];

/* Payment Details Start */
$branch_name = $payment_details_list['branch_name'];
$dd_cheque_no = $payment_details_list['dd_cheque_no'];
$dd_cheque_date = $payment_details_list['dd_cheque_date'];
if($dd_cheque_date) {
  $dd_cheque_date = date('d/m/Y',strtotime($dd_cheque_date));
}
$payment_mode_id = $payment_details_list['payment_mode_id'];
/* Payment Details End */

?>


<?php
$attributes = array('class' => 'form-horizontal form-wizard-wrapper .custom-validation', 
  'id' => 'barchdesign_form', 'name' => 'barchdesign_form', 'enctype' => 'multipart/form-data', 'data-parsley-validate data-toggle'=>"validator");

echo form_open('', $attributes);
?>
<div>
	<div id="formerr" style="display:none;color:red">Something went to wrong.Please try again later.</div>
</div>
<div class="loader" style="display:none;">

</div>
<div class="mb-3">
      <div class="progress">
<div class="progress-bar" id="percentage_bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
</div>
</div>
<h3 class="wizard_head_tag">Basic Details</h3>
<div class="text-right w-100">
    <button class="btn btn-primary" type="button">Step <span id='show_currentindex'>1</span></button>
  </div>
       <fieldset>
          <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
             <div class="card ">
                <div class="card-header p-0 " role="tab" id="headingOne">
                   <h6 class="p-2 ml-3">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed instruction_accordion">
                      <i class="fas fa-info-circle"></i>
                      Instructions</a>
                   </h6>
                </div>
                <!-- card-header -->
                <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                   <div class="card-body" style="font-size: 13px;"><?php echo $applicant_basic_wizard_instructions; ?>
                   </div>
                </div>
             </div>
             <!-- card -->
          </div>
          <div class="card w-100 pd-20 pd-sm-40">
             <!-- <h3 class="card-body-title mt-4">Basic Details</h3> -->
             <div class="form-layout">
                <div class="row mg-b-25 mt-3">
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Have you studied 10+2 from India?
                         	<span class="tx-danger">*</span></label>
                         <select class="form-control custom-select study" id="graduation_india" 
                         name="graduation_india" data-placeholder="Select Status - Yes or No" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_GRAD_STATUS_MSG; ?>" data-parsley-errors-container="custom-studied_from_india-parsley-error" data-parsley-trigger="change">
                         <option value="">Select Status - Yes or No</option>
                         </select>
                      </div>
                      <span id="custom-studied_from_india-parsley-error"></span>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force" id="resident">
                         <label class="form-control-label">Resident Status
                         <span class="tx-danger">*</span></label>
                         <select class="form-control custom-select " id="resident_info" title="Select Resident Status" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_RESIDENT_STATUS_MSG;?>" data-parsley-errors-container="#custom-non_indian_resident-parsley-error" name="resident_info">
                         </select>
                        <span id="custom-non_indian_resident-parsley-error"></span>
                        <span id="halterror" style="display:none;"><?php echo NO_OPTION_PROCEED_MSG;?></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-12" id="study_info">
                      <p class="checkbox_instructions">Please note that you have selected 'YES' for the above which implies you are eligible
                         to seek admission under domestic category. It is the sole responsibility of the candidate to ensure that he/she is
                         applying under the right category.
                      </p>
                      <label class="rdiobox">
                      <input name="qualifyingexamfromindia" type="checkbox" id="qualifyingexamfromindia" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_CHECK_CONFIRM_MSG; ?>" <?php echo ($is_agree == 't')?'checked':0; ?>> 
                      <span>I Confirm</span>
                      <!-- data-parsley-errors-container="#custom-qualifyingexamfromindia-parsley-error"<span id="custom-qualifyingexamfromindia-parsley-error"></span> -->
                      </label>
                   </div>
                   <div class="form-group formAreaCols col-lg-12" id="resident_info_message" style="display:none;"> 
                    <p><?php echo NRI_FOREIGN;?></p>
                   <a target="_blank"
                   href="<?php echo NRI_FOREIGN_URL;?>"><b><?php echo NRI_FOREIGN_URL;?></b></a>
                   </div>
                </div>
                <!-- row -->
                <input type="hidden" name="appln_status" id="appln_status" value="<?php echo $application_status_id; ?>">
             </div>
             <!-- form-layout -->
          </div>
       </fieldset>
       <h3 class="wizard_head_tag">Personal Details</h3>
       <fieldset>
          <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
             <div class="card ">
                <div class="card-header p-0 " role="tab" id="headingOne">
                   <h6 class="p-2 ml-3">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed instruction_accordion">
                      <i class="fas fa-info-circle"></i>
                      Instructions</a>
                   </h6>
                </div>
                <!-- card-header -->
                <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                   <div class="card-body" style="font-size: 13px;"><?php echo $applicant_pref_per_wizard_instructions; ?>
                   </div>
                </div>
             </div>
             <!-- card -->
          </div>
          <div class="card w-100 pd-20 pd-sm-40">
             <!-- <h6 class="card-body-title mt-4">Course Perference</h6> -->
             <h5 class="text-primary mb-3">Select Course Preferences</h5>
             <div class="form-layout">
                <div class="row mg-b-25 mt-3">
                    <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Course Perference 1 
                         	<span class="tx-danger">*</span></label>
                         <select class="form-control custom-select study" data-placeholder="Choose Course Preference 1" tabindex="-1" aria-hidden="true" name="course_pref_1" id="course_pref_1" title="Choose Course Preference 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_COURSE_PREFERENCE1_MSG; ?>" data-parsley-errors-container="#custom-course_pref_1-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Course Preference 1</option>
                            </select>
                            <span id="custom-course_pref_1-parsley-error"></span>
                        <input type="hidden" name="course_choice_no_1" id="course_choice_no_1" value="1" />
                        <input type="hidden" name="course_prefer_id_1" id="course_prefer_id_1" value="<?php echo $applicant_course_prefer_id;?>" />
                      </div>
                   </div>
                   <!-- col-4 -->

                   <div class="col-lg-4" id="main_div_camp_pref_1" style="display:none">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Campus Perference 1
                         <span class="tx-danger">*</span></label>
                         <select class="form-control custom-select study test_campus" data-placeholder="Choose Campus Preference 1" tabindex="-1" aria-hidden="true" name="campus_pref_1" id="campus_pref_1" title="Choose Campus Preference 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_CAMPUS_PREFERENCE1_MSG; ?>" data-parsley-errors-container="#custom-campus_pref_1-parsley-error" data-parsley-trigger="change" onchange="campus_pref_change('course_pref_1','campus_pref_2')">
                                <option value="">Choose Campus Preference 1</option>
                         </select>
                            <span id="custom-campus_pref_1-parsley-error"></span>
                        <input type="hidden" name="campus_choice_no_1" id="campus_choice_no_1" value="1" />
                        <input type="hidden" name="campus_prefer_id_1" id="campus_prefer_id_1" value="<?php echo $applicant_campus_prefer_id[0];?>" />
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4" id="main_div_camp_pref_2" style="display:none">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Campus Perference 2 
                         	<!-- <span class="tx-danger">*</span> --></label>
                     <select class="form-control custom-select test_campus" id="campus_pref_2" name="campus_pref_2"
                     data-placeholder="Choose Campus Preference 2" tabindex="-1" aria-hidden="true" name="campus_pref_2" id="campus_pref_2" title="Choose Campus Preference 2" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_CAMPUS_PREFERENCE2_MSG; ?>" data-parsley-errors-container="#custom-campus_pref_2-parsley-error" data-parsley-trigger="change" 
                     onchange="campus_pref_change('course_pref_1','campus_pref_1')">
                         </select>
                      </div>
                       <input type="hidden" name="campus_choice_no_2" id="campus_choice_no_2" value="1" />
                      <input type="hidden" name="campus_prefer_id_2" id="campus_prefer_id_2" value="<?php echo $applicant_campus_prefer_id[1];?>" />
                   </div>
                   <!-- col-4 -->
                </div>
                <!-- row -->
             </div>
             <!-- form-layout -->
          </div>
          <div class="card w-100 pd-20 pd-sm-40">
             <h5 class="text-primary mb-3">Personal Details</h5>
             <div class="form-layout">
                <div class="row mg-b-25">
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Title<span class="tx-danger">*</span></label>
                         <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_title" id="pd_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG; ?>" data-parsley-errors-container="#custom-title_id-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Title</option>
                            </select>
                            <span id="custom-title_id-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group">
                         <label class="form-control-label">FirstName 
                         	<span class="tx-danger">*</span></label>
                         <input class="form-control" type="text" name="pd_firstname" id="pd_firstname" placeholder="Your First Name" maxlength="<?php echo APLCT_FIRST_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_FIRST_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_FIRST_NAME_MINLENGTH; ?>, <?php echo APLCT_FIRST_NAME_MAXLENGTH; ?>]" value="<?php echo $first_name; ?>" data-parsley-trigger="change">
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group">
                         <label class="form-control-label">Middle Name </label>
                         <input class="form-control" type="text" name="pd_middlename" id="pd_middlename" placeholder="Your Middle Name" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_MIDDLE_NAME_MINLENGTH; ?>, <?php echo APLCT_MIDDLE_NAME_MAXLENGTH; ?>]" value="<?php echo $m_name; ?>" maxlength="<?php echo APLCT_MIDDLE_NAME_MAXLENGTH; ?>" data-parsley-trigger="change">
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group">   
                         <label class="form-control-label">LastName 
                         	<span class="tx-danger">*</span></label>
                         <input class="form-control" type="text" name="pd_lastname" id="pd_lastname" placeholder="Your Last Name" maxlength="<?php echo APLCT_LAST_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_LAST_NAME_MSG; ?>"  data-parsley-pattern="/^[a-zA-Z.]*$/" value="<?php echo $last_name; ?>" data-parsley-trigger="change">
                         <span>Use . (dot), if you have no last name.</span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <label class="form-control-label">Mobile NO <span
                         class="tx-danger">*</span></label>
                      <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                         <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
  								        <select class="form-control form_control custom-select Mobile_number" id="phone_no_code" name="phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                  <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                              </select>
                         </span>
                         <input type="text" name="pd_mobile_no" id="pd_mobile_no" maxlength="<?php echo APLCT_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Mobile No" class="form-control" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOBILE_MSG; ?>" data-parsley-mobileonly="true" data-parsley-errors-container="#custom-pd_mobile_no-parsley-error" value="<?php echo $mob_no; ?>" data-parsley-trigger="change">
                      </div>
                      <span id="custom-pd_mobile_no-parsley-error"></span>
                   </div>
                   <div class="col-lg-4">
                      <div class="form-group">
                         <label class="form-control-label">Email ID 
                         	<span class="tx-danger">*</span></label>
                         <input class="form-control" type="email" name="pd_email" id="pd_email" placeholder="Your email id." data-parsley-required="true" data-parsley-required-message="<?php echo REQD_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_email-parsley-error" value="<?php echo $email_id; ?>" data-parsley-trigger="change" readonly maxlength="<?php echo APLCT_EMAIL_MAXLENGTH; ?>">
                            <span id="custom-pd_email-parsley-error"></span>
                      </div>
                   </div>
                   <div class="col-lg-4">
                      <div class="wd-200 w-100">
                         <label class="form-control-label">Date of Birth<span class="tx-danger">*</span></label>
                         <div class="input-group">
                            <span class="input-group-addon"><i  class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                            <input type="text" class="form-control hasDatepicker" name="pd_dob" id="pd_dob" placeholder="DD/MM/YYYY" value="<?php echo  $dob; ?>" readonly data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DOB_MSG; ?>" data-parsley-errors-container="#custom-pd_dob-parsley-error" data-parsley-trigger="change focusout">
                            </div>
                            <span id="custom-pd_dob-parsley-error"></span>
                      </div>
                   </div>
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Gender <span class="tx-danger">*</span></label>
                         <select class="form-control select2" data-placeholder="Choose Gender" tabindex="-1" aria-hidden="true" name="pd_gender" id="pd_gender" title="Choose Gender" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_GENDER_MSG; ?>" data-parsley-errors-container="#custom-pd_gender-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Gender</option>
                            </select>
                            <span id="custom-pd_gender-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group">
                         <label class="form-control-label">Alternate Email ID </label>
                         <input class="form-control" type="email" name="pd_alt_email" id="pd_alt_email" placeholder="Alternate Email" data-parsley-required="false" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_ALT_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_alt_email-parsley-error" data-parsley-trigger="change" value="<?php echo $sec_e_mail; ?>" maxlength="<?php echo APLCT_ALT_EMAIL_MAXLENGTH; ?>">
                            <span id="custom-pd_alt_email-parsley-error"></span>
                      </div>
                   </div>
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Blood Group 
                          <span class="tx-danger">*</span></label>
                         <select class="form-control select2" data-placeholder="Choose Blood Group" tabindex="-1" aria-hidden="true" name="pd_blood_group" id="pd_blood_group" title="Choose Blood Group" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BLOOD_GRP_MSG; ?>" data-parsley-errors-container="#custom-pd_blood_group-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Blood Group</option>
                            </select>
                            <span id="custom-pd_blood_group-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Religion</label>
                         <select class="form-control select2" data-placeholder="Choose Religion" tabindex="-1" aria-hidden="true" name="pd_religion" id="pd_religion" title="Choose Religion" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_RELIGION_MSG; ?>" data-parsley-errors-container="#custom-pd_religion-parsley-error" data-parsley-trigger="change">
                            </select>
                            <span id="custom-pd_religion-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Mother Tongue</label>
                         <select class="form-control select2" data-placeholder="Choose Mother Tongue" tabindex="-1" aria-hidden="true" name="pd_mother_tongue" id="pd_mother_tongue" title="Choose Mother Tongue" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_TONGUE_MSG; ?>" data-parsley-errors-container="#custom-pd_mother_tongue-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Mother Tongue</option>
                            </select>
                            <span id="custom-pd_mother_tongue-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Medium of Instruction</label>
                         <select class="form-control select2" data-placeholder="Choose Medium of Instruction" tabindex="-1" aria-hidden="true" name="pd_medium_of_instruction" id="pd_medium_of_instruction" title="Choose Medium of Instruction" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MEDIUM_INSTR_MSG; ?>" data-parsley-errors-container="#custom-pd_medium_of_instruction-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Medium of Instruction</option>
                            </select>
                            <span id="custom-pd_medium_of_instruction-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Hostel Accommodation</label>
                         <select class="form-control select2" data-placeholder="Choose Hostel Accommodation" tabindex="-1" aria-hidden="true" name="pd_hostel_accommodation" id="pd_hostel_accommodation" title="Choose Hostel Accommodation" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_HOSTEL_ACCOM_MSG; ?>" data-parsley-errors-container="#custom-pd_hostel_accommodation-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Hostel Accommodation</option>
                            </select>
                            <span id="custom-pd_hostel_accommodation-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Are you a differently
                         Abled?<span class="tx-danger">*</span></label>
                         <select class="form-control select2" data-placeholder="Choose Differently Abled" tabindex="-1" aria-hidden="true" name="pd_diffrently_abled" id="pd_diffrently_abled" title="Choose Differently Abled" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DIFF_ABLED_MSG; ?>" data-parsley-errors-container="#custom-pd_diffrently_abled-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Differently Abled</option>
                                <option value="yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                            <span id="custom-pd_diffrently_abled-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Where do you see admission
                         advertisment?</label>
                         <select class="form-control select2" data-placeholder="Choose Advertisement Source" tabindex="-1" aria-hidden="true" name="pd_advertisement_source" id="pd_advertisement_source" title="Choose Advertisement Source " data-parsley-required="false" data-parsley-required-message="<?php echo REQD_ADVERTISE_MSG; ?>" data-parsley-errors-container="#custom-pd_advertisement_source-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Advertisement Source</option>
                            </select>
                            <span id="custom-pd_advertisement_source-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Nationality <span class="tx-danger">*</span></label>
                        <select class="form-control select2" data-placeholder="Choose Nationality" tabindex="-1" aria-hidden="true" name="pd_nationality" id="pd_nationality" title="Choose Nationality" data-parsley-validate-if-empty="true" data-parsley-errors-container="#custom-pd_nationality-parsley-error" data-parsley-btech-basic-check="studied_from_india,<?php echo $country_value_default; ?>,no,1" data-parsley-trigger="change" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_NATION_MSG; ?>">
                      <option value="">Choose Nationality</option>
                      </select>
                      <span id="custom-pd_nationality-parsley-error"></span>  
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force" id="Community">
                         <label class="form-control-label">Community <span class="tx-danger">*</span></label>
                         <select class="form-control select2" data-placeholder="Choose Community" tabindex="-1" aria-hidden="true" name="pd_social_status" id="pd_social_status" title="Choose Community" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_COMMUNITY_MSG; ?>" data-parsley-errors-container="#custom-pd_social_status-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Community</option>
                            </select>
                            <span id="custom-pd_social_status-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->     
                </div>
                <!-- row -->
             </div>
             <!-- form-layout -->
          </div>
       </fieldset>
       <h3 class="wizard_head_tag">Parent's Details</h3>
  <fieldset>
        <div id="accordion" class="accordion w-100" role="tablist"
            aria-multiselectable="true">
            <div class="card ">
                <div class="card-header p-0 " role="tab" id="headingOne">
                    <h6 class="p-2 ml-3">
                        <a data-toggle="collapse" data-parent="#accordion"
                            href="#collapseOne" aria-expanded="false"
                            aria-controls="collapseOne"
                            class="tx-gray-800 transition collapsed instruction_accordion">

                            <i class="fas fa-info-circle"></i>
                            Instructions</a>
                    </h6>
                </div><!-- card-header -->

                <div id="collapseOne" class="collapse bg-light" role="tabpanel"
                    aria-labelledby="headingOne" style="">
                    <div class="card-body" style="font-size: 13px;"><?php echo $applicant_parent_wizard_instructions; ?></div>
                </div>
            </div>

            <!-- card -->
        </div>
            <h5 class="text-primary mb-3">Father's Details</h5>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Title<span class="tx-danger">*</span></label>
                            <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_father_title" id="pd_father_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG; ?>" data-parsley-errors-container="#custom-pd_father_title-parsley-error" data-parsley-trigger="change">
                              <option value="">Choose Title</option>
                            </select>
                            <span id="custom-pd_father_title-parsley-error"></span>
                            <input type="hidden" name="pd_father_id" id="pd_father_id" value="<?php echo $app_parent_det_id[$parent_type_id_father]; ?>" />
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Father's Name <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="pd_father_name" id="pd_father_name" placeholder="Enter Your Father Name" maxlength="<?php echo APLCT_FATHER_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_FATHER_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_FATHER_NAME_MINLENGTH; ?>, <?php echo APLCT_FATHER_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_father]; ?>" />
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4" id="father_mbleno_div" style="display:none;">
                        <label class="form-control-label">Father's Mobile Number</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="pd_father_phone_no_code" name="pd_father_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                            <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                          </select>
                        </span>
                        <input type="text" class="form-control" name="pd_father_phone" id="pd_father_phone" maxlength="<?php echo APLCT_FATHER_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_FATHER_MOBILE_MSG; ?>" data-parsley-mobileonly="true"  data-parsley-maxlength-message="<?php echo VALID_FATHER_MOBILE_MSG; ?>" data-parsley-errors-container="#custom-pd_father_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no[$parent_type_id_father]; ?>" data-parsley-notequalto="#pd_mother_phone" data-parsley-notequalto-message="<?php echo PHONE_MATCH_FATHER; ?>">
                      </div>
                      <span id="custom-pd_father_phone-parsley-error"></span>
                    </div>
                    <div class="col-lg-4" id="father_alt_mbleno_div" style="display:none;">
                      <label class="form-control-label">Father's Alternate Mobile Number</label>
                      <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="pd_father_alt_phone_no_code" name="pd_father_alt_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                            <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                          </select>
                        </span>
                        <input type="text" class="form-control" name="pd_father_alt_phone" id="pd_father_alt_phone" maxlength="<?php echo APLCT_FATHER_ALT_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Alternate Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_ALT_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_FATHER_MOBILE_MSG; ?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="<?php echo VALID_FATHER_MOBILE_MSG; ?>" data-parsley-errors-container="#custom-pd_father_alt_phone-parsley-error" value="<?php echo $applicant_parent_alt_mobile_no[$parent_type_id_father]; ?>">
                      </div>
                      <span id="custom-pd_father_alt_phone-parsley-error"></span>
                    </div>
                    <div class="col-lg-4" id="father_email_div" style="display:none;">
                      <div class="form-group">
                        <label class="form-control-label">Father's Email ID </label>
                        <input class="form-control" type="email" name="pd_father_email" id="pd_father_email"  placeholder="Enter Your Father's Email ID" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_FATHER_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_father_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_father]; ?>" maxlength="<?php echo APLCT_FATHER_EMAIL_MAXLENGTH; ?>" data-parsley-notequalto="#pd_mother_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_FATHER; ?>">
                        <span id="custom-pd_father_email-parsley-error"></span>
                      </div>
                    </div>
                    <div class="col-lg-4"  id="father_occupation_div" style="display:none;">
                      <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Father's Occupation</label>
                        <select class="form-control select2" data-placeholder="Choose Occupation" tabindex="-1" aria-hidden="true" name="pd_father_occupation" id="pd_father_occupation">
                          <option value="">Select Father's Occupation</option>
                        </select>
                      </div>
                      <div id="father_other_occupation_div" style="display:none;" class="form-group">
                            <input class="form-control" type="text" name="pd_father_other_occupation" id="pd_father_other_occupation"  placeholder="If Other, please enter here..."data-parsley-required="false"   data-parsley-errors-container="#custom-pd_father_other_occupation-parsley-error" value="<?php echo $applicant_parent_occupation_other_name[$parent_type_id_father];?>">
                            <span id="custom-pd_father_other_occupation-parsley-error"></span>
                      </div>
                    </div><!-- col-4 -->
                </div><!-- row -->
            <h5 class="text-primary mt-4 mb-3">Mother's Details</h5>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Title <span class="tx-danger">*</span></label>
                          <select class="form-control select2" name="pd_mother_title" id="pd_mother_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG; ?>" data-parsley-errors-container="#custom-pd_mother_title-parsley-error" data-parsley-trigger="change">
                            <option value="">Choose Title</option>
                          </select>
                          <span id="custom-pd_mother_title-parsley-error"></span>
                          <input type="hidden" name="pd_mother_id" id="pd_mother_id"  value="<?php echo $app_parent_det_id[$parent_type_id_mother]; ?>" />
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Mother's Name <span class="tx-danger">*</span></label>
                          <input type="text" class="form-control" name="pd_mother_name" id="pd_mother_name" placeholder="Enter Your Mother's Name" maxlength="<?php echo APLCT_MOTHER_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MOTHER_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_MOTHER_NAME_MINLENGTH; ?>, <?php echo APLCT_MOTHER_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_mother]; ?>">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4" id="mother_mbleno_div" style="display:none;">
                        <label class="form-control-label">Mother's Mobile Number</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="pd_mother_phone_no_code" name="pd_mother_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                            <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                          </select>
                        </span>
                        <input type="text" class="form-control" name="pd_mother_phone" id="pd_mother_phone" maxlength="<?php echo APLCT_MOTHER_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOTHER_MOBILE_MSG; ?>" data-parsley-mobileonly="true"  data-parsley-maxlength-message="<?php echo VALID_MOTHER_MOBILE_MSG; ?>" data-parsley-errors-container="#custom-pd_mother_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no[$parent_type_id_mother]; ?>" data-parsley-notequalto="#pd_father_phone" data-parsley-notequalto-message="<?php echo PHONE_MATCH_MOTHER; ?>">
                        <span id="custom-pd_mother_phone-parsley-error"></span>
                        </div>
                    </div>
                    <div class="col-lg-4" id="mother_alt_mbleno_div" style="display:none;">
                        <label class="form-control-label">Mother's Alternative Mobile Number</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="pd_mother_alt_phone_no_code" name="pd_mother_alt_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                            <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                          </select>
                        </span>
                        <input type="text" class="form-control" name="pd_mother_alt_phone" id="pd_mother_alt_phone" maxlength="<?php echo APLCT_MOTHER_ALT_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOTHER_MOBILE_MSG; ?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="<?php echo VALID_MOTHER_MOBILE_MSG; ?>" data-parsley-errors-container="#custom-pd_mother_alt_phone-parsley-error" value="<?php echo $applicant_parent_alt_mobile_no[$parent_type_id_mother]; ?>">
                        <span id="custom-pd_mother_alt_phone-parsley-error"></span>
                        </div>
                    </div>
                    <div class="col-lg-4" id="mother_email_div" style="display:none;">
                        <div class="form-group">
                            <label class="form-control-label">Mother's Email ID </label>
                            <input class="form-control" type="email" name="pd_mother_email" id="pd_mother_email"  placeholder="Enter Your Mother's Email ID"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_MOTHER_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_mother_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_mother]; ?>" maxlength="<?php echo APLCT_MOTHER_EMAIL_MAXLENGTH; ?>" data-parsley-notequalto="#pd_father_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_MOTHER; ?>">
                            <span id="custom-pd_mother_email-parsley-error"></span>
                        </div>
                    </div>
                    <div class="col-lg-4" id="mother_occupation_div" style="display:none;">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Mother's Occupation</label>
                            <select class="form-control select2" data-placeholder="Choose Occupation" tabindex="-1" aria-hidden="true" name="pd_mother_occupation" id="pd_mother_occupation">
                              <option value="">Select Mother's Occupation</option>
                            </select>
                        </div>
                        <div id="mother_other_occupation_div" style="display:none;" class="form-group">
                        <input class="form-control" type="text" name="pd_mother_other_occupation" id="pd_mother_other_occupation"  placeholder="If Other, please enter here..." data-parsley-required="false"   data-parsley-errors-container="#custom-pd_mother_other_occupation-parsley-error" value="<?php echo $applicant_parent_occupation_other_name[$parent_type_id_mother];?>">
                        <span id="custom-pd_mother_other_occupation-parsley-error"></span>
                      </div>
                    </div><!-- col-4 -->
                </div><!-- row -->
            
                <div>
                  <label class="ckbox add_guardian_checkbox">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" name="add_guardian_checkbox" id="add_guardian_checkbox" value="<?php echo ($add_gardian == 't')?'true':'false'; ?>" <?php echo ($add_gardian == 't')?'checked':''; ?>><label class="custom-control-label" for="add_guardian_checkbox"> Add Guardian Detail </label>
                    </div>
                  </label>
                </div>
              <div id="guardian_details" style="display:none">
                <h5 class="text-primary mt-4 mb-3">Guardian's Details</h5>
           
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Guardian's Name <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="pd_guardian_name" id="pd_guardian_name" placeholder="Enter Your Guardian Name" maxlength="<?php echo APLCT_GUARDIAN_NAME_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_GUARDIAN_NAME_MINLENGTH; ?>, <?php echo APLCT_GUARDIAN_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_guardian]; ?>">
                          <input type="hidden" name="pd_guardian_id" id="pd_guardian_id" value="<?php echo $app_parent_det_id[$parent_type_id_guardian]; ?>" />
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <label class="form-control-label">Guardian's Mobile NO <span class="tx-danger">*</span></label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                        <select class="form-control form_control custom-select Mobile_number" id="pd_guardian_phone_no_code" name="pd_guardian_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                          <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                        </select>
                        </span>
                        <input type="text" class="form-control" name="pd_guardian_phone" id="pd_guardian_phone" maxlength="<?php echo APLCT_GUARDIAN_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Guardian's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_GUARDIAN_MOBILE_MSG; ?>" data-parsley-mobileonly="true"  data-parsley-maxlength-message="<?php echo VALID_GUARDIAN_MOBILE_MSG; ?>" data-parsley-errors-container="#custom-pd_guardian_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no[$parent_type_id_guardian]; ?>">
                      </div>
                      <span id="custom-pd_guardian_phone-parsley-error"></span>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Guardian's Email ID <span class="tx-danger">*</span></label>
                            <input class="form-control" type="email" name="pd_guardian_email" id="pd_guardian_email"  placeholder="Enter Your Guardian's Email ID"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_GUARDIAN_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_guardian_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_guardian]; ?>" maxlength="<?php echo APLCT_GUARDIAN_EMAIL_MAXLENGTH; ?>" onkeypress="remove_guardainvaidationmsg('pd_guardian_email','custom-pd_guardian_email-parsley-error');">
                            <span id="custom-pd_guardian_email-parsley-error"></span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Guardian's Occupation <span class="tx-danger">*</span></label>
                            <select class="form-control select2" data-placeholder="Choose Guardian Occupation" tabindex="-1" aria-hidden="true" name="pd_guardian_occupation" id="pd_guardian_occupation" title="Select Guardian Occupation" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_OCCUPATION_MSG; ?>" data-parsley-errors-container="#custom-pd_guardian_occupation-parsley-error">
                              <option value="">Select Guardian's Occupation</option>
                            </select>
                            <span id="custom-pd_guardian_occupation-parsley-error"></span>
                        </div>
                        <div id="guardian_other_occupation_div" style="display:none;" class="form-group">
                            <input class="form-control" type="text" name="guardian_other_occupation" id="guardian_other_occupation"  placeholder="If Other, please enter here..."data-parsley-required="false"   data-parsley-errors-container="#custom-guardian_other_occupation-parsley-error" value="<?php echo $applicant_parent_occupation_other_name[$parent_type_id_guardian];?>" maxlength="<?php echo APLCT_GUARDIAN_OCCP_MAXLENGTH; ?>">
                            <span id="custom-guardian_other_occupation-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                </div><!-- row -->
              </div>
  </fieldset>
    <h3 class="wizard_head_tag">Address Details</h3>
  <fieldset>
        <div id="accordion" class="accordion w-100" role="tablist"
            aria-multiselectable="true">
            <div class="card ">
                <div class="card-header p-0 " role="tab" id="headingOne">
                    <h6 class="p-2 ml-3">
                        <a data-toggle="collapse" data-parent="#accordion"
                            href="#collapseOne" aria-expanded="false"
                            aria-controls="collapseOne"
                            class="tx-gray-800 transition collapsed">

                            <i class="fas fa-info-circle"></i>
                            Instructions</a>
                    </h6>
                </div><!-- card-header -->

                <div id="collapseOne" class="collapse bg-light" role="tabpanel"
                    aria-labelledby="headingOne" style="">
                    <div class="card-body" style="font-size: 13px;"><?php echo $applicant_address_wizard_instructions;?></div>
                </div>
            </div>

            <!-- card -->
        </div>
            <h5 class="text-primary mt-4 mb-3">Address for Communication</h5>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Country<span class="tx-danger"> *</span></label>
                            <select class="form-control select2" data-placeholder="Choose country" tabindex="-1" aria-hidden="true" name="country" id="country" title="Choose Country" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_COUNTRY_MSG; ?>" data-parsley-errors-container="#custom-country-parsley-error" data-parsley-trigger="change">
                              <option value="">Select Country</option>
                            </select>
                            <span id="custom-country-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-3" id="main_div_state">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">State<span class="tx-danger"> *</span></label>
                            <select class="form-control select2" data-placeholder="Choose State" tabindex="-1" aria-hidden="true" name="state" id="state" title="Choose State" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_STATE_MSG; ?>" data-parsley-errors-container="#custom-state-parsley-error" data-parsley-trigger="change">
                              <option value="">Select State</option>
                            </select>
                            <span id="custom-state-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-3" id="main_div_district">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">District<span class="tx-danger"> *</span></label>
                            <select class="form-control select2" data-placeholder="Choose District" tabindex="-1" aria-hidden="true" name="district" id="district" title="Choose District" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DISTRICT_MSG; ?>" data-parsley-errors-container="#custom-district-parsley-error" data-parsley-trigger="change">
                              <option value="">Select District</option>
                            </select>
                            <span id="custom-district-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-3" id="main_div_city">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">City<span class="tx-danger"> *</span></label>
                            <select class="form-control select2" data-placeholder="Choose City" tabindex="-1" aria-hidden="false" name="city" id="city" title="Choose City" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CITY_MSG; ?>" data-parsley-errors-container="#custom-city-parsley-error" data-parsley-trigger="change">
                              <option value="">Select City</option>
                            </select>
                            <span id="custom-city-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Address Line 1 <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="address_line1" id="address_line1" placeholder="Enter Address Line 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_ADDRESS_MSG; ?>" value="<?php if($add_line_1[0]) {echo $add_line_1[0];} ?>" data-parsley-maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH; ?>" maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH; ?>">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Address Line 2 <!--<span class="tx-danger">*</span>--></label>
                            <input class="form-control" type="text" name="address_line2" id="address_line2" placeholder="Enter Address Line 2" value="<?php if($add_line_2[0]) {echo $add_line_2[0];} ?>" data-parsley-maxlength="<?php echo APLCT_ADDRESS2_MAXLENGTH; ?>" maxlength="<?php echo APLCT_ADDRESS2_MAXLENGTH; ?>">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Pincode <span class="tx-danger">*</span></label>
                            <!-- <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Pincode" data-parsley-required="true" data-parsley-required-message="Please Enter Pincode" value="<?php if($pin_code[0]) {echo $pin_code[0];} ?>" data-parsley-maxlength="10" maxlength="10"> -->
                            <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Pincode" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PINCODE_MSG; ?>" value="<?php if($pin_code[0]) {echo $pin_code[0];} ?>" data-parsley-maxlength="<?php echo APLCT_PINCODE_MAXLENGTH; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_PINCODE_MSG; ?>" maxlength="<?php echo APLCT_PINCODE_MAXLENGTH; ?>">
                        </div>
                    </div><!-- col-4 -->

                </div><!-- row -->

  </fieldset>
       <h3 class="text-primary mb-3 wizard_head_tag">Academic Detail</h3>
       <fieldset>
          <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
             <div class="card ">
                <div class="card-header p-0 " role="tab" id="headingOne">
                   <h6 class="p-2 ml-3">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed instruction_accordion">
                      <i class="fas fa-info-circle"></i>
                      Instructions</a>
                   </h6>
                </div>
                <!-- card-header -->
                <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                   <div class="card-body" style="font-size: 13px;"><?php echo $applicant_academic_wizard_instructions;?>
                   </div>
                </div>
             </div>
             <!-- card -->
          </div>
          <!-- <h5 class="card-body-title mt-4">Academic Details</h4> -->
          <h5 class="text-primary mb-3">Academic Details</h5>
          <div action="form-validation.html" id="selectForm" class="w-100">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group mr-5">
                  <label class="form-control-label">Current Education Qualification Status <span class="tx-danger">*</span></label>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="appering" name="current_education_qual_status" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="<?php echo REQD_EDU_QUAL_MSG; ?>" data-parsley-errors-container="#custom-current_education_qual_status-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($applicant_result_declared[0] == 'f')?'checked':''; ?>>
                        <label class="custom-control-label" for="appering">12th Appearing</label>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="completed" name="current_education_qual_status" class="custom-control-input" value="2" <?php echo ($applicant_result_declared[0] == 't')?'checked':''; ?>>
                        <label class="custom-control-label" for="completed">12th Completed</label>
                      </div>
                    </div>
                    <span id="custom-current_education_qual_status-parsley-error"></span>
                  </div>
                </div><!-- form-group -->
              </div>
              <div class="col-lg-6 ">
                <div class="form-group wd-xs-300 mr-5 w-100">
                  <label class="form-control-label">Candidate Name as in 10th Certificate <span class="tx-danger">*</span></label>
                  <div class="form-group mg-b-10-force">
                    <input class="form-control" type="text" name="tenth_name" id="tenth_name" placeholder="Enter Name" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_CANDIDATE_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_CAND_NAME_MINLENGTH; ?>, <?php echo APLCT_CAND_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_tenth_name[0]; ?>" maxlength="<?php echo APLCT_CAND_NAME_MAXLENGTH; ?>" data-parsley-trigger="change">
                    <small id="emailHelp" class="form-text text-muted">Kindly type "NA" in case 10th Certificate is not available with you.</small>
                  </div>
                </div><!-- form-group -->
              </div>
            </div>
          </div>
          <div class="table-responsive">
          <table class="table table-bordered mt-0">
             <thead class="thead-light">
                <tr>
                   <th>Course</th>
                   <th> Institute Name  <span class="tx-danger">*</span></th>
                   <th> Board <span class="tx-danger">*</span></th>
                   <th> Mode of Study <span class="tx-danger">*</span></th>
                   <th> Marking Scheme <span class="tx-danger">*</span></th>
                   <th> Obtained Percentage/CGPA <span class="tx-danger">*</span></th>
                   <th> Year of Passing <span class="tx-danger">*</span></th>
                   <th>  Roll No. / Registration No. <span class="tx-danger">*</span>
                   </th>
                </tr>
             </thead>
             <tbody>
              <tr>
                <td><p>X</p><input type="hidden" name="schooling_id_0" id="schooling_id_0" value="<?php echo $applicant_scl_det_id[0]; ?>" ></td>
                <td><input class="form-control" type="text" name="institute_name_0" id="institute_name_0" placeholder="Enter Institute Name" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_INSTITUTE_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_INSTITUTE_NAME_MINLENGTH; ?>, <?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_institute_name[0]; ?>" maxlength="<?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>" data-parsley-trigger="change"></td>
                <td>
                  <div class="form-group mg-b-10-force">
                    <select class="form-control custom-select" name="board_0" id="board_0" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BOARD_MSG; ?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-board0-parsley-error">
                      <option value="">Select</option>
                    </select>
                    <span id="custom-board0-parsley-error"></span>
                  </div>
                </td>
                <td>
                  <div class="form-group mg-b-10-force">
                    <select class="form-control custom-select" name="mode_of_study_0" id="mode_of_study_0" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MODE_STUDY_MSG; ?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-mode_study0-parsley-error">
                      <option value="">Select</option>
                    </select>
                    <span id="custom-mode_study0-parsley-error"></span>
                  </div>
                </td>
                <td>
                  <div class="form-group mg-b-10-force" id="appering_info_0">
                    <select class="form-control custom-select" name="marking_scheme_0" id="marking_scheme_0" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MARK_SCHEME_MSG; ?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-marking_scheme0-parsley-error">
                      <option value="">Select</option>
                    </select>
                    <span id="custom-marking_scheme0-parsley-error"></span>
                  </div>
                </td>                
                <td>
                    <input class="form-control" type="text" name="obtained_percentage_cgpa_0" placeholder="Obtained Percentage/CGPA" id="obtained_percentage_cgpa_0" maxlength="<?php echo APLCT_PERCENT_CGPA_MAXLENGTH; ?>" data-parsley-required="true" 
                    data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG; ?>" min="<?php echo APLCT_MARK_MINLENGTH; ?>" max="<?php echo APLCT_MARK_MAXLENGTH; ?>" data-parsley-trigger="keyup" data-parsley-errors-container="#custom-obtained_percentage_cgpa0-parsley-error" value="<?php echo $applicant_obtained_percentage_cgpa[0]; ?>"> 
                    <span id="custom-obtained_percentage_cgpa0-parsley-error"></span>
                </td>
                <td>
                    <input class="form-control" type="text" name="year_of_passing_0" id="year_of_passing_0" placeholder="YYYY" maxlength="<?php echo APLCT_YEAR_OF_PASSING_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-trigger="change" data-parsley-required-message="<?php echo REQD_YEAR_OF_PASSING_MSG; ?>"   data-parsley-errors-container="#custom-year_of_passing_0-parsley-error" value="<?php echo $applicant_year_of_passing[0]; ?>" readonly>
                    <span id="custom-year_of_passing_0-parsley-error"></span>
                </td>
                <td>
                    <input class="form-control" type="text" name="registration_no_0" id="registration_no_0" placeholder="Roll No" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_REG_NO_MSG; ?>"  data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_REG_NO_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_registration_no[0]; ?>">
                </td>
              </tr>
              <tr>
                <td><p>XII</p><input type="hidden" name="schooling_id_1" id="schooling_id_1" value="<?php echo $applicant_scl_det_id[1]; ?>" ></td>
                <td><input class="form-control" type="text" name="institute_name_1" id="institute_name_1" placeholder="Enter Institute Name" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_INSTITUTE_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_INSTITUTE_NAME_MINLENGTH; ?>, <?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_institute_name[1]; ?>" maxlength="<?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>" data-parsley-trigger="change"></td>
                <td>
                  <div class="form-group mg-b-10-force">
                    <select class="form-control custom-select" name="board_1" id="board_1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BOARD_MSG; ?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-board1-parsley-error">
                      <option value="">Select</option>
                    </select>
                    <span id="custom-board1-parsley-error"></span>
                  </div>
                </td>
                <td>
                  <div class="form-group mg-b-10-force">
                    <select class="form-control custom-select" name="mode_of_study_1" id="mode_of_study_1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MODE_STUDY_MSG; ?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-mode_study_1-parsley-error">
                      <option value="">Select</option>
                    </select>
                    <span id="custom-mode_study_1-parsley-error"></span>
                  </div>
                </td>
                <td>
                  <div class="form-group mg-b-10-force" id="appering_info_1">
                    <select class="form-control custom-select" name="marking_scheme_1" id="marking_scheme_1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MARK_SCHEME_MSG; ?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-marking_scheme1-parsley-error">
                      <option value="">Select</option>
                    </select>
                    <span id="custom-marking_scheme1-parsley-error"></span>
                  </div>
                </td>
                <td>
                    <input class="form-control" type="text" name="obtained_percentage_cgpa_1" placeholder="Obtained Percentage/CGPA" id="obtained_percentage_cgpa_1" maxlength="<?php echo APLCT_PERCENT_CGPA_MAXLENGTH; ?>" data-parsley-required="true" 
                    data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG; ?>"  data-parsley-type-message="<?php echo REQD_PERCENT_CGPA_VALID_MSG; ?>" min="<?php echo APLCT_MARK_MINLENGTH; ?>" max="<?php echo APLCT_MARK_MAXLENGTH; ?>" data-parsley-trigger="keyup" value="<?php echo $applicant_obtained_percentage_cgpa[1]; ?>" data-parsley-errors-container="#custom-obtained_percentage_cgpa1-parsley-error"> 
                    <span id="custom-obtained_percentage_cgpa1-parsley-error"></span>
                </td>
                <td>
                    <input class="form-control" type="text" name="year_of_passing_1" id="year_of_passing_1" placeholder="YYYY" maxlength="<?php echo APLCT_YEAR_OF_PASSING_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-trigger="change" data-parsley-required-message="<?php echo REQD_YEAR_OF_PASSING_MSG; ?>"  data-parsley-errors-container="#custom-year_of_passing_1-parsley-error" value="<?php echo $applicant_year_of_passing[1]; ?>" readonly>
                    <span id="custom-year_of_passing_1-parsley-error"></span>
                </td>
                <td>
                    <input class="form-control" type="text" name="registration_no_1" id="registration_no_1" placeholder="Roll No" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" data-parsley-required="false
                    " data-parsley-required-message="<?php echo REQD_REG_NO_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_registration_no[1]; ?>" 
                    data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_REG_NO_MSG; ?>"data-parsley-errors-container="#custom-registration_no_1-parsley-error">
                    <span id="custom-registration_no_1-parsley-error"></span>
                </td>
              </tr>
          </tbody>
          </table>
        </div>
          <div class="mt-3 w-100">
             <div class="row">
                <div class="col-lg-6">
                   <div class="form-group">
                      <label class="form-control-label">NAD ID / Digilocker ID 
                        <!-- <span class="tx-danger">*</span> --></label>
                      <input class="form-control" type="text" name="digilocker_id"
                         id="digilocker_id" placeholder="Enter NAD ID / Digilocker ID " value="<?php echo $nad_id_digilocker_id;?>" maxlength="<?php echo APLCT_NADID_MAXLENGTH; ?>" data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_NADID_MSG; ?>">
                   </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label class="control-label" for="radios" >Have you
                          taken any competitive exam? <span class="tx-danger">*</span></label>
                      <select class="form-control custom-select study" id="taken_any_competitive_exam" name="taken_any_competitive_exam" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_COMP_STATUS_MSG; ?>" onchange="is_competitive_exam_func(this.value)" data-parsley-errors-container="#custom-taken_any_competitive_exam-parsley-error" data-parsley-trigger="change">
                          <option value="">Select Status - Yes or No</option>
                          <option value="yes">Yes</option>
                          <option value="no">No</option>
                      </select>
                      <span id="custom-taken_any_competitive_exam-parsley-error"></span>
                      <div class="form-group" style="display: none;" id="taken_any_competitive_exam_info"><small>You have to write
                              SRM ENTRANCE to qualify.</small></div>

                  </div>
                </div>
             </div>
             <div class="row" id="competitive_dtl" style="display: none;">
                <div class="col-md-12">
                   <div class="form-group">
                      <!-- <label class="control-label" for="radios">Competitive Exam</label> -->
                      <h5 class="text-primary mb-3">Competitive Exam</h5>
                      <div class="table-responsive pretbl">
                         <table class="table table-bordered mt-0" id="table5">
                            <thead class="thead-light">
                               <tr>
                                   <th>
                                   </th>
                                   <th>Name of the exam</th>
                                   <th>Registration No /Roll No</th>
                                   <th>Score Obtained</th>
                                   <th>Max Score</th>
                                   <th>Year Appeared</th>
                                   <th>AIR/Overall Rank </th>
                                   <th>Qualified/Not Qualified</th>
                               </tr>
                            </thead>
                            <tbody>
                               <tr>
                                  <td nowrap="">1.</td>
                                  <td>
                                     <input class="form-control" type="hidden" placeholder="" id="comp_exam_id_0" name="comp_exam_id_0" value="<?php echo $applicant_entr_exam_det_id[0]; ?>">
                                     <div class="form-group">
                                      <select class="form-control custom-select study" id="competitive_exam_0" name="competitive_exam_0" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_COMP_EXAM_MSG; ?>" data-parsley-errors-container="#custom-competitive_exam_0-parsley-error" data-parsley-trigger="change"></select>
                                    </div>
                                     <span class="tx-danger required_asterisk">*</span>
                                     <span id="custom-competitive_exam_0-parsley-error"></span>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="rollno_0" id="rollno_0" class="form-control" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_REG_NO_MSG; ?>" data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_REG_NO_MSG; ?>"data-parsley-trigger="change" value="<?php echo $app_comp_registration_no[0]; ?>" data-parsley-errors-container="#custom-rollno_0-parsley-error"></div>
                                     <span class="tx-danger required_asterisk">*</span>
                                     <span id="custom-rollno_0-parsley-error"></span>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="score_obtained_0" id="score_obtained_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_SCORE_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SCORE_MSG; ?>" data-parsley-trigger="keyup"  value="<?php echo $app_comp_score_obtained[0]; ?>" data-parsley-type="number" data-parsley-errors-container="#custom-score_obtained_0-parsley-error" data-parsley-type-message="<?php echo VALID_SCORE_MSG; ?>"></div>
                                     <span class="tx-danger required_asterisk">*</span>
                                     <span id="custom-score_obtained_0-parsley-error"></span>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="max_score_0" id="max_score_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_MAX_SCORE_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MAX_SCORE_MSG; ?>" data-parsley-type="number" data-parsley-type-message="<?php echo VALID_MAX_SCORE_MSG; ?>"data-parsley-trigger="change" value="<?php echo $app_comp_max_score[0]; ?>" data-parsley-errors-container="#custom-max_score_0-parsley-error"></div>
                                     <span class="tx-danger required_asterisk">*</span>
                                     <span id="custom-max_score_0-parsley-error"></span>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="year_appered_0" id="year_appered_0" class="form-control datepicker" placeholder="YYYY" maxlength="<?php echo APLCT_YEAR_APPEAR_MAXLENGTH; ?>"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_YEAR_APPEAR_MSG; ?>" data-parsley-trigger="change" value="<?php echo $app_comp_exam_year[0]; ?>" data-parsley-errors-container="#custom-year_appered_0-parsley-error" readonly></div>
                                     <span class="tx-danger required_asterisk">*</span>
                                     <span id="custom-year_appered_0-parsley-error"></span>
                                  </td>
                                  <td>
                                     <div class="form-group"><input  type="text" name="overall_rank_0" id="overall_rank_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_OVERALL_RANK_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_AIR_RANK_MSG; ?>" data-parsley-trigger="change" data-parsley-type="number" data-parsley-type-message="<?php echo VALID_AIR_RANK_MSG; ?>" value="<?php echo $app_comp_all_india_rank[0]; ?>" data-parsley-errors-container="#custom-overall_rank_0-parsley-error"></div>
                                     <span class="tx-danger required_asterisk">*</span>
                                     <span id="custom-overall_rank_0-parsley-error"></span>
                                  </td>                                  
                                  <td>
                                     <div class="form-group"><select class="form-control custom-select study" id="qualify_0" name="qualify_0" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_QUALIFY_STATUS_MSG; ?>" data-parsley-errors-container="#custom-qualify_0-parsley-error" data-parsley-trigger="change"></select>
                                    </div>
                                     <span class="tx-danger required_asterisk">*</span>
                                     <span id="custom-qualify_0-parsley-error"></span>
                                  </td>
                               </tr>
                               <tr>
                                  <td nowrap="">2.</td>
                                  <td>
                                     <input class="form-control" type="hidden" placeholder="" id="comp_exam_id_1" name="comp_exam_id_1" value="<?php echo $applicant_entr_exam_det_id[1]; ?>">
                                     <div class="form-group">
                                      <select class="form-control custom-select study" id="competitive_exam_1" name="competitive_exam_1" data-parsley-errors-container="#custom-competitive_exam_1-parsley-error" data-parsley-trigger="change"></select>
                                    </div>
                                    <span id="custom-competitive_exam_1-parsley-error"></span>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="rollno_1" id="rollno_1" class="form-control" placeholder="" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_REG_NO_MSG; ?>" value="<?php echo $app_comp_registration_no[1]; ?>"></div>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="score_obtained_1" id="score_obtained_1" class="form-control" placeholder="" maxlength="<?php echo APLCT_SCORE_MAXLENGTH; ?>" value="<?php echo $app_comp_score_obtained[1]; ?>" data-parsley-trigger="keyup" data-parsley-type="number" data-parsley-type-message="<?php echo VALID_SCORE_MSG; ?>"></div>                                     
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="max_score_1" id="max_score_1" class="form-control" placeholder="" maxlength="<?php echo APLCT_MAX_SCORE_MAXLENGTH; ?>" data-parsley-type="number" data-parsley-type-message="<?php echo VALID_MAX_SCORE_MSG; ?>" value="<?php echo $app_comp_max_score[1]; ?>"></div>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="year_appered_1" id="year_appered_1" class="form-control" placeholder="YYYY" maxlength="<?php echo APLCT_YEAR_APPEAR_MAXLENGTH; ?>" value="<?php echo $app_comp_exam_year[1];?>" readonly></div>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="overall_rank_1" id="overall_rank_1" class="form-control" placeholder="" maxlength="<?php echo APLCT_OVERALL_RANK_MAXLENGTH; ?>" data-parsley-type="number" data-parsley-type-message="<?php echo VALID_AIR_RANK_MSG; ?>" value="<?php echo $app_comp_all_india_rank[1];?>">
                                     </div>
                                  </td>                                  
                                  <td>
                                     <div class="form-group"><select class="form-control custom-select study" id="qualify_1" name="qualify_1" data-parsley-errors-container="#custom-qualify_1-parsley-error" data-parsley-trigger="change"></select>
                                      <span id="custom-qualify_1-parsley-error"></span>
                                      </div>
                                  </td>
                               </tr>
                               <tr>
                                  <td nowrap="">3.</td>
                                  <td>
                                     <div class="form-group mg-b-10-force">
                                      <select class="form-control custom-select study" id="competitive_exam_2" name="competitive_exam_2" data-parsley-errors-container="#custom-competitive_exam_2-parsley-error" 
                                      data-parsley-trigger="change"></select>
                                    <span id="custom-competitive_exam_2-parsley-error"></span>
                                    <input class="form-control" type="hidden" placeholder="" id="comp_exam_id_2" name="comp_exam_id_2" value="<?php echo $applicant_entr_exam_det_id[2]; ?>">
                                    </div>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="rollno_2" id="rollno_2" class="form-control" placeholder="" data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_REG_NO_MSG; ?>" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" value="<?php echo $app_comp_registration_no[2];?>"></div>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="score_obtained_2" id="score_obtained_2" class="form-control" placeholder="" maxlength="<?php echo APLCT_SCORE_MAXLENGTH; ?>" data-parsley-trigger="keyup" data-parsley-type="number" data-parsley-type-message="<?php echo VALID_SCORE_MSG; ?>" value="<?php echo $app_comp_score_obtained[2]?>"></div>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="max_score_2" id="max_score_2" class="form-control" placeholder="" maxlength="<?php echo APLCT_MAX_SCORE_MAXLENGTH; ?>" data-parsley-type="number" data-parsley-type-message="<?php echo VALID_MAX_SCORE_MSG; ?>" value="<?php echo $app_comp_max_score[2]?>"></div>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="year_appered_2" id="year_appered_2" class="form-control" placeholder="YYYY" maxlength="<?php echo APLCT_YEAR_APPEAR_MAXLENGTH; ?>" value="<?php echo $app_comp_exam_year[2];?>"  readonly data-parsley-trigger="keyup" ></div>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="overall_rank_2" id="overall_rank_2" class="form-control" placeholder="" maxlength="<?php echo APLCT_OVERALL_RANK_MAXLENGTH; ?>" data-parsley-type="number" data-parsley-type-message="<?php echo VALID_AIR_RANK_MSG; ?>" value="<?php echo $app_comp_all_india_rank[2];?>"></div>
                                  </td>                                  
                                  <td>
                                     <div class="form-group">
                                      <select class="form-control custom-select study" id="qualify_2" name="qualify_2" data-parsley-errors-container="#custom-qualify_2-parsley-error"></select>
                                      <span id="custom-qualify_2-parsley-error"></span>
                                     </div>
                                  </td>
                               </tr>
                            </tbody>
                         </table>
                      </div>
                   </div>
                </div>
            </div>
          </div>
          <!--<div class="w-100 mt-5">
             <div class="Payment_align">
                <a href="#" class="btn btn-primary active float-right" role="button" aria-pressed="true">MAKE PAYMENT</a>
             </div>
          </div>-->
       </fieldset>
       <h3 class="wizard_head_tag">Payment Details</h3>
     <fieldset>
        <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
            <div class="card ">
                <div class="card-header p-0 " role="tab" id="headingOne">
                    <h6 class="p-2 ml-3">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed">

                            <i class="fas fa-info-circle"></i>
                            Instructions</a>
                    </h6>
                </div><!-- card-header -->

                <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                    <div class="card-body" style="font-size: 13px;"><?php echo $applicant_payment_wizard_instructions; ?></div>
                </div>
            </div>

            <!-- card -->
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-3 base_details_card">
                    <div class="card-body">
                       <?php $applicant_mob_country_code_name = $applicant_basic_details_list['applicant_mob_country_code_name']; ?>
                        <h5 class="card-title card_title">Personal Details</h5>
                        <p class="card-subtitle mb-3">Name : <?php echo $first_name." ".$last_name; ?> </p>
                        <p class="card-subtitle mb-3">E-Mail : <?php echo $email_id;?></p>
                        <p class="card-subtitle">Phone Number : <?php echo $applicant_mob_country_code_name."-".$mob_no; ?></p>
                    </div>
                </div><!-- card -->
                <div class="card base_details_card">
                    <div class="card-body">
                        <h5 class="card-title card_title">Order Details</h5>
                        <p class="card-subtitle">Application Fee <span class="float-right"><?php echo $appln_form_fee; ?></span>
                        </p>
                    </div>
                </div><!-- card -->

            </div>
        <div class="col-lg-6">
                <div class="card mb-3 base_details_card">
                    <div class="card-body">
                        <h5 class="card-title card_title">Payment Details</h5>
                        <div class="row mb-3">
                          	<div class="col-lg-2">
                          		<!-- <label class="rdiobox">
                          			<input name="rdio" type="radio" id="online">
                          			<span>Online</span>
                          		</label> -->
                                  <div class="custom-control custom-radio custom-control-inline">
                                  <input type="radio" id="online" name="payment_mode" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PAYMENT_MODE_MSG; ?>" data-parsley-errors-container="#custom-payment_mode-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($payment_mode_id == PAYMENT_MODE_ONLINE_ID)?'checked':''; ?>>
                                  <label class="custom-control-label" for="online">Online</label>
                                </div>
                          	</div>
                          	<div class="col-lg-2">
                          		<!-- <label class="rdiobox">
                          			<input name="rdio" type="radio" <?php echo ($payment_mode_id == PAYMENT_MODE_DEMAND_DRAFT_ID)?'checked':''; ?> id="dd">
                          			<span>DD</span>
                          		</label> -->
                              <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="dd" name="payment_mode" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PAYMENT_MODE_MSG; ?>" data-parsley-errors-container="#custom-payment_mode-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($payment_mode_id == PAYMENT_MODE_DEMAND_DRAFT_ID)?'checked':''; ?>>
                              <label class="custom-control-label" for="dd">DD</label>
                              </div>
                          	</div>
                         </div>
                         <p><span id="custom-payment_mode-parsley-error"></span></p>
                        <p class="card-subtitle mb-3 mt-3">Sub Total <span class="float-right"><?php echo $appln_form_fee; ?></span>
                        </p>
                        <p class="card-subtitle">Total<span class="float-right"><?php echo $appln_form_fee; ?></span>
                        </p>
                        <div id="payment_details" style="display: none;">
                          <div class="col-md-12 mt-3">
                            <div class="row">
                              <div class="col-md-6">
                                <!--<input class="form-control" type="text" name="BankName" id="BankName" placeholder="Bank Name" data-parsley-required="true" data-parsley-required-message="Required">-->
                                <select class="form-control select2" name="BankName" id="BankName" title="Choose Bank Name" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHOOSE_BANK_MSG; ?>" data-parsley-errors-container="#custom-BankName-parsley-error">
                                  <option value=""  selected="selected">Select Bank Name</option>
                                </select>
                                <span id="custom-BankName-parsley-error"></span>                  
                              </div>
                              <div class="col-md-6">
                                <input class="form-control" type="text" name="BranchName" placeholder="Branch Name" id="BranchName" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BANK_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo VALID_BANK_NAME_MSG; ?>"  maxlength="<?php echo APLCT_BRANCH_NAME_MAXLENGTH; ?>" value="<?php echo $branch_name; ?>">
                              </div>
                            </div>

                          </div>
                          <div class="col-md-12 mt-3">
                              <div class="row">
                                <div class="col-md-6">
                                  <input class="form-control" type="text" name="DDNumber" id="DDNumber" placeholder="DD Number" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DD_NO_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_DD_NO_MSG; ?>"  maxlength="<?php echo APLCT_DD_NO_MAXLENGTH; ?>" value="<?php echo $dd_cheque_no; ?>">
                                </div>
                                <div class="col-md-6">
                                  <input class="form-control" type="text" name="DDDate" id="DDDate" placeholder="DD Date" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DD_DATE_MSG; ?>" value="<?php echo $dd_cheque_date; ?>" autocomplete="off">
                                </div>
                              </div>
                          </div>
                          <div class="row mt-3">
                            <div class="col-sm-12 customIcon">
                              <div class="flexbox flex-start"><?php echo DD_INFAVOUR; ?></div>
                            </div>
                          </div>
                      </div> 
                        <!-- <a href="payment_success.html" class="btn btn-primary active w-100 mt-3" role="button"
                            aria-pressed="true">MAKE PAYMENT</a> -->

                    </div>

                </div><!-- card -->
            </div>      
        </div>
        <div class="row  w-100">
        </div>
    </fieldset>
       

  <h3 class="wizard_head_tag">Upload & Declaration</h3>
   <fieldset>
  <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
    <div class="card ">
      <div class="card-header p-0 " role="tab" id="headingOne">
        <h6 class="p-2 ml-3">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed">
          <i class="fas fa-info-circle"></i> Instructions</a>
        </h6>
      </div><!-- card-header -->

      <div id="collapseOne7" class="collapse bg-light show" role="tabpanel" aria-labelledby="headingOne" style="">
        <div class="card-body" style="font-size: 13px;"><?php echo $applicant_upload_declaration_wizard_instructions;?></div>
      </div>
    </div>
    <!-- card -->
  </div>
  <div class="col-md-12">
    <?php
            $file_allowed_type = FILE_ALLOWED_TYPE;
            ?>
    <div class="form-layout">
      <div class="row mg-b-25 mt-3">
        <div class="row w-100">
          <div class="form-group col-md-6 ">
                           <label for="exampleFormControlTextarea1">Upload Your Recent Passport Size Photograph <span class="tx-danger">*</span></label>
                           <input type="file" class="filestyle" name="photograph" id="photograph" data-parsley-required="<?php echo ((isset($docs[$document_id_photograph]))?'false':'true'); ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_PHOTO_MSG; ?>" data-parsley-errors-container="#custom-photograph-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>"  data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                           <?php if(isset($docs[$document_id_photograph])){ ?>
                              <!-- <span class='file_name  mt-3' ><a class="image-popup-vertical-fit" href="<?php echo base_url().$docs[$document_id_photograph]['file_path'];?>" target="_blank" title="<?php echo $docs[$document_id_photograph]['file_name_user']; ?>"><?php echo $docs[$document_id_photograph]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                              <a href="javascript:void(0)" data-del-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>" data-doc-id="<?php echo $document_id_photograph; ?>" data-toggle="modal" data-target="#contentDeletePop" data-field="photograph" data-required="true" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_photograph; ?>">
                                 <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_photograph; ?>')">&times;</a>
                                 <strong id="deleteMessageStatus_<?php echo $document_id_photograph; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_photograph; ?>"></span> 
                             </div>
                           <?php } ?>
                           <span id="custom-photograph-parsley-error"></span>
                    </div>
          <div class="form-group col-md-6">
            <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Signature</label>
              <input type="file" class="filestyle" name="signature" id="signature" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_UPLOAD_SIGN_MSG; ?>" data-parsley-errors-container="#custom-signature-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                           <?php if(isset($docs[$document_id_signature])){ ?>
                              <!-- <span class='file_name  mt-3' ><a class="image-popup-vertical-fit" href="<?php echo base_url().$docs[$document_id_signature]['file_path'];?>" target="_blank" title="<?php echo $docs[$document_id_signature]['file_name_user']; ?>"><?php echo $docs[$document_id_signature]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                              <a href="javascript:void(0)" data-del-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>" data-doc-id="<?php echo $document_id_signature; ?>" data-toggle="modal" data-target="#contentDeletePop" onclick="removeClick(this)" data-field="signature" data-required="true"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_signature; ?>">
                                 <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_signature; ?>')">&times;</a>
                                 <strong id="deleteMessageStatus_<?php echo $document_id_signature; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_signature; ?>"></span>
                             </div>
                           <?php } ?>
                           <span id="custom-signature-parsley-error"></span>
              </div>
        </div>
        <?php
                  
                  ?>
                  <div class="row w-100">
                      <div class="form-group col-md-6">
                          <label for="exampleFormControlTextarea1">Upload Your 10th Marksheet </label>

                          <input type="file" class="filestyle" name="tenth_marksheet" id="tenth_marksheet" data-parsley-required="<?php echo ((isset($docs[$document_id_tenth_marksheet]))?'false':'true'); ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_10_MARKSHEET_MSG; ?>" data-parsley-errors-container="#custom-tenth_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_tenth_marksheet])){ echo $docs[$document_id_tenth_marksheet]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                           <?php if(isset($docs[$document_id_tenth_marksheet])){ ?>
                              <!-- <span class='file_name  mt-3' ><a class="image-popup-vertical-fit" href="<?php echo base_url().$docs[$document_id_tenth_marksheet]['file_path'].$docs[$document_id_tenth_marksheet]['file_name'];?>" target="_blank" title="<?php echo $docs[$document_id_tenth_marksheet]['file_name_user']; ?>"><?php echo $docs[$document_id_tenth_marksheet]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                <a href="javascript:void(0)" data-del-file-id="<?php if(isset($docs[$document_id_tenth_marksheet])){ echo $docs[$document_id_tenth_marksheet]['id']; } ?>" data-doc-id="<?php echo $document_id_tenth_marksheet; ?>" data-toggle="modal" data-target="#contentDeletePop" onclick="removeClick(this)" data-field="tenth_marksheet" data-required="true"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_tenth_marksheet; ?>">
                                 <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_tenth_marksheet; ?>')">&times;</a>
                                 <strong id="deleteMessageStatus_<?php echo $document_id_tenth_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_tenth_marksheet; ?>"></span>
                             </div>               
                           <?php } ?>
                           <span id="custom-tenth_marksheet-parsley-error"></span>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="exampleFormControlTextarea1">Upload Your 12th Marksheet </label>

                          <input type="file" class="filestyle" name="twelvfth_marksheet" id="twelvfth_marksheet" data-parsley-required="<?php echo ((isset($docs[$document_id_twelvfth_marksheet]))?'false':'true'); ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_12_MARKSHEET_MSG; ?>" data-parsley-errors-container="#custom-twelvfth_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>"  data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_twelvfth_marksheet])){ echo $docs[$document_id_twelvfth_marksheet]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                           <?php if(isset($docs[$document_id_twelvfth_marksheet])){ ?>
                              <!-- <span class='file_name  mt-3' ><a class="image-popup-vertical-fit" href="<?php echo base_url().$docs[$document_id_twelvfth_marksheet]['file_path'].$docs[$document_id_twelvfth_marksheet]['file_name'];?>" target="_blank" title="<?php echo $docs[$document_id_twelvfth_marksheet]['file_name_user']; ?>"><?php echo $docs[$document_id_twelvfth_marksheet]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
               <a href="javascript:void(0)" data-del-file-id="<?php if(isset($docs[$document_id_twelvfth_marksheet])){ echo $docs[$document_id_twelvfth_marksheet]['id']; } ?>" data-doc-id="<?php echo $document_id_twelvfth_marksheet; ?>" data-toggle="modal" data-target="#contentDeletePop" onclick="removeClick(this)" data-field="twelvfth_marksheet" data-required="true"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_twelvfth_marksheet; ?>">
                                 <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_twelvfth_marksheet; ?>')">&times;</a>
                                 <strong id="deleteMessageStatus_<?php echo $document_id_twelvfth_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_twelvfth_marksheet; ?>"></span>
                             </div>                 
                           <?php } ?>
                           <span id="custom-twelvfth_marksheet-parsley-error"></span>
                      </div>
                  </div>

                  <div class="row w-100">
    <div class="form-group col-md-6">
    <label for="exampleFormControlTextarea1">Additional Qualification, if any</label>
    <input type="file" class="filestyle" name="additional_qualification" id="additional_qualification" data-parsley-required="false" data-parsley-validate-if-empty="true" data-parsley-required-message="<?php echo REQD_UPLOAD_ADD_QUALIFY_MSG; ?>" data-parsley-errors-container="#custom-additional_qualification-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_500_KB; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_additional_qualification])){ echo $docs[$document_id_additional_qualification]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
    <?php if(isset($docs[$document_id_additional_qualification])){ ?>
    <!-- <span class='file_name  mt-3' ><a class="image-popup-vertical-fit" href="<?php echo base_url().$docs[$document_id_additional_qualification]['file_path'];?>" target="_blank" title="<?php echo $docs[$document_id_additional_qualification]['file_name_user']; ?>"><?php echo $docs[$document_id_additional_qualification]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
    <a href="javascript:void(0)" data-del-file-id="<?php if(isset($docs[$document_id_additional_qualification])){ echo $docs[$document_id_additional_qualification]['id']; } ?>" data-doc-id="<?php echo $document_id_additional_qualification; ?>" data-toggle="modal" data-target="#contentDeletePop" onclick="removeClick(this)" data-field="additional_qualification" data-required="true"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
    <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_additional_qualification; ?>">
    <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_additional_qualification; ?>')">&times;</a>
    <strong id="deleteMessageStatus_<?php echo $document_id_additional_qualification; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_additional_qualification; ?>"></span>
    </div>
    <?php } ?>
    <span id="custom-additional_qualification-parsley-error"></span>
    </div>
</div>
                  <?php
                 
                  ?>        
        <div class="row w-100">
          <div class="col-md-12">
            <h5 class="card-body-title">Declaration</h5>
            <p><?php echo DECLARATION; ?></p>
          </div>  
        </div>
        <div class="row w-100">
          <div class="col-md-6">
            <label class="form-control-label">Applicant Name <span class="tx-danger">*</span></label>
            <input class="form-control" type="text" name="applicant_name" id="applicant_name" placeholder="Applicant Name" value="<?php echo $applicant_name_declaration ;?>" maxlength="<?php echo APLCT_DECLR_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_APPLT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_DECLR_NAME_MINLENGTH; ?>, <?php echo APLCT_DECLR_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_name; ?>" data-parsley-trigger="change">
          </div>
          <div class="col-md-6">
            <label class="form-control-label">Parent Name <span class="tx-danger">*</span></label>
            <input class="form-control" type="text" name="parent_name" id="parent_name" placeholder="Parent Name"  maxlength="<?php echo APLCT_DECLR_FATHER_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_PARENT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_DECLR_FATHER_NAME_MINLENGTH; ?>, <?php echo APLCT_DECLR_FATHER_NAME_MAXLENGTH; ?>]" value="<?php echo $parent_name; ?>" data-parsley-trigger="change">
          </div>  
        </div>
        <div class="row w-100 mt-3">
          <div class="col-md-6">
            <label class="form-control-label">Date <span class="tx-danger">*</span></label>
            <input class="form-control" type="text" name="ddate" id="ddate" value="<?php if(isset($applicant_declaration_date)){echo $applicant_declaration_date;}else{echo date('d/m/Y');} ?>" readonly>
          </div>
        </div>  
        <div class="row w-100 mt-3">
        <div class="col-md-6">
                        <!-- <a href="<?php echo base_url();?>barch_form_preview">
                      <input type="button"  id="form_preview_btn" class="btn btn-primary" value="Form Preview"> </a> -->
                </div></div>
      </div><!-- row -->
    </div>
  </div>
</fieldset> 

       <?php form_close(); ?><!-- form -->