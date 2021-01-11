<?php 
$this->load->helper('common');
$app_form_id_mtech = APP_FORM_ID_MTECH;
$parent_type_id_father = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
//print_r($applicant_other_details_list);
/*$first_name = $result_appicant['first_name'];
$middle_name = $result_appicant['middle_name'];
$last_name = $result_appicant['last_name'];
$mobile_no = $result_appicant['mobile_no'];
$email_id = $result_appicant['email_id'];
$dob = $result_appicant['dob'];
$alt_email_id = $result_appicant['second_email_id'];
$employee = $result_appicant['employee'];
$user_id = $personal_detail_list['data']['user_id'];*/
$first_name=$applicant_basic_details_list['f_name'];
$middle_name=$applicant_basic_details_list['m_name'];
$last_name=$applicant_basic_details_list['l_name'];
$dob = $applicant_basic_details_list['dob'];
if($dob) {
  //$dob = date('m/d/Y',strtotime($dob));  
  $dob=isset($dob)? date('d/m/Y',strtotime($dob)):'';
}
$mobile_no=$applicant_basic_details_list['mob_no'];
$sec_mob_no=$applicant_basic_details_list['sec_mob_no'];
$sec_e_mail=$applicant_basic_details_list['sec_e_mail'];
$add_line_1=$applicant_address_details_list['add_line_1'];
$add_line_2=$applicant_address_details_list['add_line_2'];
$pin_code=$applicant_address_details_list['pin_code'];
$email_id = $applicant_basic_details_list['e_mail'];
$cur_qual_completed = $applicant_other_details_list['cur_qual_completed'];
$is_work_experience = $applicant_other_details_list['is_work_experience'];
$canditate_name = $applicant_basic_details_list['name_in_marksheet'];
$nad_id_digilocker_id = $applicant_basic_details_list['digilocker_id'];

$result_declare_date = $applicant_other_details_list['expectedmonthyearresult'];
$result_declare_date=isset($result_declare_date)? date('m/Y',strtotime($result_declare_date)):'';
$total_work_exp = $applicant_other_details_list['total_work_exp'];
$add_gardian = $applicant_other_details_list['add_gardian'];
//$total_work_exp = $applicant_other_details_list['total_work_exp'];

$applicant_publn_det_id = $applicant_publn_det_title = $applicant_publn_det_journal_conf_name = $applicant_publn_det_year = $applicant_prof_exp_id = $applicant_prof_exp_org_name = $applicant_prof_exp_designation = $applicant_prof_exp_job_nature = $applicant_prof_exp_salary = $applicant_prof_exp_from_date = $applicant_prof_exp_to_date = $applicant_prof_exp_work_exp_in_months = $applicant_grad_det_id = $applicant_grad_det_other_degree_name = $applicant_grad_det_univ_id = $applicant_grad_det_univ_name = $applicant_grad_det_mark_scheme_id = $applicant_grad_det_mark_percent = $applicant_grad_det_completion_year = $applicant_grad_det_reg_no = $applicant_comp_exam_pk_id = $applicant_comp_exam_name = $applicant_comp_exam_registration_no = $applicant_comp_exam_score_obtained = $applicant_comp_exam_max_score = $applicant_comp_exam_exam_year = $applicant_comp_exam_all_india_rank = $applicant_comp_exam_qualified = array();

//print_r($applicant_prof_exps_list);
if($applicant_prof_exps_list) {
   foreach($applicant_prof_exps_list as $k=>$v) {
      // $applicant_prof_exp_id[] = $v['applicant_prof_exp_id'];
      $applicant_prof_exp_id[] = $v['exp_id'];
      $applicant_prof_exp_org_name[] = $v['org_name'];
      $applicant_prof_exp_designation[] = $v['designation'];
      $applicant_prof_exp_job_nature[] = $v['job_nature'];
      $applicant_prof_exp_salary[] = $v['salary'];
      $applicant_prof_exp_from_date[] = $v['from_date'];
      $applicant_prof_exp_to_date[] = $v['to_date'];
      // $applicant_prof_exp_work_exp_in_months[] = $v['work_exp_in_months'];
      // $applicant_prof_exp_work_exp_in_months[] = $v['work_exp_month'];
      $applicant_prof_exp_work_exp_in_months[] = $v['work_exp_month'];
   }
}

if($applicant_competitive_details_list) {
   foreach($applicant_competitive_details_list as $k=>$v) {
      $applicant_comp_exam_pk_id[] = $v['applicant_entr_exam_det_id'];
      $applicant_comp_exam_name[] = $v['comp_exam_name'];
      $applicant_comp_exam_registration_no[] = $v['registration_no'];
      $applicant_comp_exam_score_obtained[] = $v['score_obtained'];
      $applicant_comp_exam_max_score[] = $v['max_score'];
      $applicant_comp_exam_exam_year[] = $v['exam_year'];
      $applicant_comp_exam_all_india_rank[] = $v['all_india_rank'];
      $applicant_comp_exam_qualified[] = $v['qualified'];
   }
}


//print_r($applicant_graduations_list);



$applicant_grad_det_id = $applicant_graduations_list['applicant_grad_det_id'];
$applicant_grad_det_other_degree_name = $applicant_graduations_list['other_deg_name'];
$applicant_grad_det_univ_id = $applicant_graduations_list['univ_id'];                             
$applicant_grad_det_univ_name = $applicant_graduations_list['univ_name'];
$applicant_grad_det_mark_scheme_id = $applicant_graduations_list['mark_scheme_id'];
$applicant_grad_det_mark_scheme = $applicant_graduations_list['mark_scheme_name'];
$applicant_grad_det_mark_percent = $applicant_graduations_list['mark_percentage'];
$applicant_grad_det_completion_year = $applicant_graduations_list['yr_of_pass']; 
$applicant_grad_det_insti_name = $applicant_graduations_list['insti_name'];
$applicant_grad_det_insti_other_name = $applicant_graduations_list['other_university_name'];
$applicant_grad_det_reg_no = $applicant_graduations_list['reg_no']; 
         
          


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
$document_id_graduation_marksheet = DOCUMENT_ID_GRADUATION_MARKSHEET;
$document_id_competitive_exam_marksheet = DOCUMENT_ID_COMPETITIVE_EXAM_MARKSHEET;

$form_wizard_basic_id = FORM_WIZARD_BASIC_ID;
$form_wizard_preference_personal_id = FORM_WIZARD_PERSONAL_ID;
$form_wizard_parent_address_id = FORM_WIZARD_PARENT_ADDRESS_ID; 
$form_wizard_academic_id = FORM_WIZARD_ACADEMIC_ID;
$form_wizard_payment_id = FORM_WIZARD_PAYMENT_ID;
$form_wizard_declaration_id = FORM_WIZARD_DECLARATION_ID;
$form_wizard_upload_id = FORM_WIZARD_UPLOAD_ID;

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
   }
}

$father_name = $applicant_parent_parent_name[$parent_type_id_father];
$mother_name = $applicant_parent_parent_name[$parent_type_id_mother];
$guardian_name = $applicant_parent_parent_name[$parent_type_id_guardian];


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

// $qualifyexamfromindia = $applicant_appln_details_list[0]['qualifyingexamfromindia'];

if($applicant_appln_details_list)
{
  $applicant_appln_id = $applicant_appln_details_list['applicant_appln_id'];
  $qualifyexamfromindia = $applicant_appln_details_list['qualifyingexamfromindia'];
  // foreach($applicant_appln_details_list as $k=>$v) {
  //     $appln_form_id = $v['appln_form_id'];
  //     if($app_form_id_mtech == $appln_form_id) {
  //       $applicant_appln_id = $v['applicant_appln_id'];
  //       $qualifyexamfromindia = $v['qualifyingexamfromindia'];
  //       // $is_qualify = $v['is_qualify'];
  //     }
  //  }
}

if($qualifyexamfromindia == 't') {
    $studied_from_india_id = 'yes';
    $studied_from_india_name = 'Yes';
} else {
    $studied_from_india_id = 'no';
    $studied_from_india_name = 'No';
}

$applicant_name = $applicant_appln_details_list['applicant_name_declaration'];
$application_status_id =$applicant_appln_details_list['application_status_id'];
$applicant_name = ($applicant_name)?$applicant_name:$first_name;

$parent_name = $applicant_appln_details_list['applicant_parentname_declaration'];
$parent_name = (($parent_name)?$parent_name:(($father_name)?$father_name:(($mother_name)?$mother_name:(($guardian_name)?$guardian_name:''))));

$declaration_date = $applicant_appln_details_list['applicant_declaration_date'];
$declaration_date = ($declaration_date)?date('d/m/Y',strtotime($declaration_date)):date('d/m/Y');

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

$applicant_parent_address_wizard_id = $applicant_instructions_list[$form_wizard_parent_address_id][0]['form_w_wizard_id'];
$applicant_parent_address_wizard_instructions = $applicant_instructions_list[$form_wizard_parent_address_id][0]['instruction'];
if($applicant_parent_address_wizard_instructions) {
  $applicant_parent_address_wizard_instructions = nl2br($applicant_parent_address_wizard_instructions);
} else {
  $applicant_parent_address_wizard_instructions = ' - ';
}
$applicant_parent_address_wizard_percent = $applicant_instructions_list[$form_wizard_parent_address_id][0]['completion_percent'];
$applicant_parent_address_wizard_message = $applicant_instructions_list[$form_wizard_parent_address_id][0]['message'];


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

$applicant_declaration_wizard_id = $applicant_instructions_list[$form_wizard_declaration_id][0]['form_w_wizard_id'];
$applicant_declaration_wizard_instructions = $applicant_instructions_list[$form_wizard_declaration_id][0]['instruction'];
if($applicant_declaration_wizard_instructions) {
  $applicant_declaration_wizard_instructions = nl2br($applicant_declaration_wizard_instructions);
} else {
  $applicant_declaration_wizard_instructions = ' - ';
}
$applicant_declaration_wizard_percent = $applicant_instructions_list[$form_wizard_declaration_id][0]['completion_percent'];
$applicant_declaration_wizard_message = $applicant_instructions_list[$form_wizard_declaration_id][0]['message'];

$applicant_upload_wizard_id = $applicant_instructions_list[$form_wizard_upload_id][0]['form_w_wizard_id'];
$applicant_upload_wizard_instructions = $applicant_instructions_list[$form_wizard_upload_id][0]['instruction'];
if($applicant_upload_wizard_instructions) {
  $applicant_upload_wizard_instructions = nl2br($applicant_upload_wizard_instructions);
} else {
  $applicant_upload_wizard_instructions = ' - ';
}
$applicant_upload_wizard_percent = $applicant_instructions_list[$form_wizard_upload_id][0]['completion_percent'];
$applicant_upload_wizard_message = $applicant_instructions_list[$form_wizard_upload_id][0]['message'];
/* form wizard instruction detail End */

$appln_form_fee = $applicant_appln_details_list['appln_form_fee'];

/* Payment Details Start */
$branch_name = $applicant_payment_details_list['branch_name'];
$dd_cheque_no = $applicant_payment_details_list['dd_cheque_no'];
$dd_cheque_date = $applicant_payment_details_list['dd_cheque_date'];
if($dd_cheque_date) {
  $dd_cheque_date = date('d/m/Y',strtotime($dd_cheque_date));
}
$payment_mode_id = $applicant_payment_details_list['payment_mode_id'];

/* Payment Details End */

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

$docs=array();
$file_count = 0;
if(isset($upload_filelist))
{
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
// echo '<pre>';
// print_r($upload_filelist); 
// echo '</pre>';
$attributes = array('class' => 'form-horizontal form-wizard-wrapper .custom-validation', 'id' => 'mtech_form', 'name' => 'mtech_form', 'enctype' => 'multipart/form-data', 'data-parsley-validate data-toggle'=>"validator");

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
      <button class="btn btn-primary">Step <span id='show_currentindex'>1</span></button>
  </div>
  <fieldset>
      <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true">
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
                      <div class="card-body" style="font-size: 13px;"><?php echo $applicant_basic_wizard_instructions; ?></div>
                  </div>
            </div> 
        <!-- card -->
      </div>
                                           
      <div class="row">
          <div class="col-md-5">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Graduation from India?
                      <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select nationality" 
                        id="graduation_india" name="graduation_india" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_GRAD_STATUS_MSG;?>" data-parsley-errors-container="#custom-graduation_india-parsley-error" data-parsley-trigger="change">
                            <option value="">Select Status - Yes or No</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        <span id="custom-graduation_india-parsley-error"></span>
                        <span id="halterror" style="display:none;"><?php echo NO_OPTION_PROCEED_MSG;?></span>
                  
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group formAreaCols" id="confirm_indian" style="display: none;">
                <p>
                    Please note that you have selected 'YES' for the
                    above which implies you are eligible to seek
                    admission under domestic category. It is the
                    sole responsibility of the candidate to ensure
                    that he/she is applying under the right
                    category.</p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="qualifyingexamfromindia" id="qualifyingexamfromindia" data-parsley-mincheck="1" value="<?php echo ($qualifyexamfromindia == 't')?1:0; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHECK_CONFIRM_MSG;?>" <?php echo ($qualifyexamfromindia == 't')?'checked':''; ?>  data-parsley-trigger="change"><label class="custom-control-label" for="qualifyingexamfromindia"> I Confirm </label>
                </div>
            </div>
            <div class="form-group formAreaCols" id="confirm_notindian" style="display: none;">
                SRMJEEE is not applicable for international
                students. Go to the below link to
                proceed further.<br><br><a
                    href="https://intlapplications.srmist.edu.in/international-application-form-2020"><b>https://intlapplications.srmist.edu.in/international-application-form-2020</b></a>
            </div>
          </div>
          <input type="hidden" name="appln_status" id="appln_status" value="<?php echo $application_status_id; ?>">
        </div>
  </fieldset>
  <h3 class="wizard_head_tag">Personal Details</h3>
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
            <div class="card-body" style="font-size: 13px;"><?php echo $applicant_pref_per_wizard_instructions;?></div>
            </div>
        </div>
      <!-- card -->
      </div>
      <div class="w-100">
        <h5 class="text-primary mb-3">Select Course and Campus Preference </h5>
          <div class="form-layout">
              <div class="row mg-b-25 mt-3">                  
                  <div class="col-lg-6" id="main_div_camp_pref_1">
                      <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Campus Preference 1 <span class="tx-danger">*</span></label>
                          <select class="form-control custom-select study test_campus" data-placeholder="Choose Campus Preference 1" tabindex="-1" aria-hidden="true" name="campus_pref_1" id="campus_pref_1" title="Choose Campus Preference 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_CAMPUS_PREFERENCE1_MSG;?>" data-parsley-errors-container="#custom-campus_pref_1-parsley-error" data-parsley-trigger="change">
                              <option value="">Choose Campus Preference 1</option>
                          </select>
                          <span id="custom-campus_pref_1-parsley-error"></span>
                      </div>
                      <input type="hidden" name="campus_choice_no_1" id="campus_choice_no_1" value="<?php echo (isset($applicant_campus_choice_no[0]))?$applicant_campus_choice_no[0]:'1'; ?>" />
                      <input type="hidden" name="campus_prefer_id_1" id="campus_prefer_id_1" value="<?php echo (isset($applicant_campus_prefer_id[0]))?$applicant_campus_prefer_id[0]:''; ?>" />
                  </div>
                  <div class="col-lg-6" id="main_div_course_pref_1" style="display:none">
                      <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Course Preference 1
                              <span class="tx-danger">*</span></label>
                          <select class="form-control custom-select study test_course" data-placeholder="Choose Course Preference 1" aria-hidden="true" name="course_pref_1" id="course_pref_1" title="Choose Course Preference 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_COURSE_PREFERENCE1_MSG;?>" data-parsley-errors-container="#custom-course_pref_1-parsley-error" data-parsley-trigger="change">
                              <option value="">Choose Course Preference 1</option>
                          </select>
                          <span id="custom-course_pref_1-parsley-error"></span>
                      </div>
                      <input type="hidden" name="course_choice_no_1" id="course_choice_no_1" value="<?php echo (isset($applicant_course_choice_no[0]))?$applicant_course_choice_no[0]:'1'; ?>" />
                        <input type="hidden" name="course_prefer_id_1" id="course_prefer_id_1" value="<?php echo (isset($applicant_course_id[0]))?$applicant_course_id[0]:''; ?>" />
                  </div><!-- col-4 -->
              </div>
              <div class="row mg-b-25 mt-3">
                  <div class="col-lg-6" id="main_div_camp_pref_2">
                      <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Campus Preference 2</label>
                          <select class="form-control custom-select study test_campus" data-placeholder="Choose Campus Preference 2" tabindex="-1" aria-hidden="true" name="campus_pref_2" id="campus_pref_2" title="Choose Campus Preference 2" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_CAMPUS_PREFERENCE2_MSG;?>" data-parsley-errors-container="#custom-campus_pref_2-parsley-error" data-parsley-trigger="change">
                              <option value="">Choose Campus Preference 2</option>
                          </select>
                          <span id="custom-campus_pref_2-parsley-error"></span>
                      </div>
                      <input type="hidden" name="campus_choice_no_2" id="campus_choice_no_2" value="<?php echo (isset($applicant_campus_choice_no[1]))?$applicant_campus_choice_no[1]:'2'; ?>" />
                      <input type="hidden" name="campus_prefer_id_2" id="campus_prefer_id_2" value="<?php echo (isset($applicant_campus_prefer_id[1]))?$applicant_campus_prefer_id[1]:''; ?>" />
                  </div><!-- col-4 -->
                  <div class="col-lg-6" id="main_div_course_pref_2" style="display:none">
                      <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Course Preference 2</label>
                          <select class="form-control custom-select study test_course" data-placeholder="Choose Course Preference 2" tabindex="-1" aria-hidden="true" name="course_pref_2" id="course_pref_2" title="Choose Course Preference 2" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_COURSE_PREFERENCE2_MSG;?>" data-parsley-errors-container="#custom-course_pref_2-parsley-error" data-parsley-trigger="change">
                              <option value="">Choose Course Preference 2</option>
                          </select>
                          <span id="custom-course_pref_2-parsley-error"></span>
                      </div>
                      <input type="hidden" name="course_choice_no_2" id="course_choice_no_2" value="<?php echo (isset($applicant_course_choice_no[1]))?$applicant_course_choice_no[1]:'2'; ?>" />
                      <input type="hidden" name="course_prefer_id_2" id="course_prefer_id_2" value="<?php echo (isset($applicant_course_id[1]))?$applicant_course_id[1]:''; ?>" />
                  </div><!-- col-4 -->
              </div>
              <div class="row mg-b-25 mt-3">
                  <div class="col-lg-6" id="main_div_camp_pref_3">
                      <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Campus Preference 3</label>
                          <select class="form-control custom-select study test_campus" data-placeholder="Choose Campus Preference 3" tabindex="-1" aria-hidden="true" name="campus_pref_3" id="campus_pref_3" title="Choose Campus Preference 3" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_CAMPUS_PREFERENCE3_MSG;?>" data-parsley-errors-container="#custom-campus_pref_3-parsley-error" data-parsley-trigger="change">
                              <option value="">Choose Campus Preference 3</option>
                          </select>
                          <span id="custom-campus_pref_3-parsley-error"></span>
                      </div>
                      <input type="hidden" name="campus_choice_no_3" id="campus_choice_no_3" value="<?php echo (isset($applicant_campus_choice_no[2]))?$applicant_campus_choice_no[2]:'3'; ?>" />
                      <input type="hidden" name="campus_prefer_id_3" id="campus_prefer_id_3" value="<?php echo (isset($applicant_campus_prefer_id[2]))?$applicant_campus_prefer_id[2]:''; ?>" />
                  </div><!-- col-4 -->
                  <div class="col-lg-6" id="main_div_course_pref_3" style="display:none">
                      <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Course Preference 3</label>
                          <select class="form-control custom-select study test_course" data-placeholder="Choose Course Preference 3" tabindex="-1" aria-hidden="true" name="course_pref_3" id="course_pref_3" title="Choose Course Preference 3" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_COURSE_PREFERENCE3_MSG;?>" data-parsley-errors-container="#custom-course_pref_3-parsley-error" data-parsley-trigger="change">
                              <option value="">Choose Course Preference 3</option>
                          </select>
                          <span id="custom-course_pref_3-parsley-error"></span>
                      </div>
                      <input type="hidden" name="course_choice_no_3" id="course_choice_no_3" value="<?php echo (isset($applicant_course_choice_no[2]))?$applicant_course_choice_no[2]:'3'; ?>" />
                      <input type="hidden" name="course_prefer_id_3" id="course_prefer_id_3" value="<?php echo (isset($applicant_course_id[2]))?$applicant_course_id[2]:''; ?>" />
                  </div><!-- col-4 -->
              </div><!-- row -->
          </div><!-- form-layout -->
      </div>
      <h5 class="text-primary mt-4 mb-3">Test City Perferences</h5>
      <div class="row">
          <div class="col-lg-6">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Test State Perferences 1 <span class="tx-danger">*</span></label>
                  <select class="form-control select2 test_state" data-placeholder="Choose Test State Perferences 1" tabindex="-1" aria-hidden="false" name="state_pref_1" id="state_pref_1" title="Choose Test State Perferences 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_STATE_PREFERENCE1_MSG;?>" data-parsley-errors-container="#custom-state_pref_1-parsley-error" data-parsley-trigger="change">
                    <option value="">Choose Test State Perferences 1</option>
                  </select>
                  <span id="custom-state_pref_1-parsley-error"></span>
              </div>
          </div><!-- col-6 -->
          <div class="col-lg-6" id="main_div_city_pref_1" style="display:none">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Test City Perferences 1<span class="tx-danger">*</span></label>
                  <select class="form-control select2 test_city" data-placeholder="Choose Test City Perferences 1" tabindex="-1" aria-hidden="true" name="city_pref_1" id="city_pref_1" title="Choose Test City Perferences 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_CITY_PREFERENCE1_MSG;?>" data-parsley-errors-container="#custom-city_pref_1-parsley-error" onchange="test_city_pref_change('state_pref_1','city_pref_1')">
                    <option value="">Choose Test City Perferences 1</option>
                  </select>
                  <span id="custom-city_pref_1-parsley-error"></span>
              </div>
              <input type="hidden" name="city_choice_no_1" id="city_choice_no_1" value="<?php echo (isset($applicant_city_choice_no[0]))?$applicant_city_choice_no[0]:'1'; ?>" />
              <input type="hidden" name="city_prefer_id_1" id="city_prefer_id_1" value="<?php echo (isset($applicant_city_id[0]))?$applicant_city_id[0]:''; ?>" />
          </div><!-- col-6 -->
      </div>
      <div class="row">
          <div class="col-lg-6">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Test State Perferences 2</label>
                  <select class="form-control select2 test_state" data-placeholder="Choose Test State Perferences 2" tabindex="-1" aria-hidden="true" name="state_pref_2" id="state_pref_2" title="Choose Test State Perferences 2" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_STATE_PREFERENCE2_MSG;?>" data-parsley-errors-container="#custom-state_pref_2-parsley-error" data-parsley-trigger="change">
                    <option value="">Choose Test State Perferences 2</option>
                  </select>
                  <span id="custom-state_pref_2-parsley-error"></span>
              </div>
          </div><!-- col-6 -->
          <div class="col-lg-6" id="main_div_city_pref_2" style="display:none">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Test City Perferences 2</label>
                  <select class="form-control select2 test_city" data-placeholder="Choose Test City Perferences 2" tabindex="-1" aria-hidden="true" name="city_pref_2" id="city_pref_2" title="Choose Test City Perferences 2" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_CITY_PREFERENCE2_MSG;?>" data-parsley-errors-container="#custom-city_pref_2-parsley-error" data-parsley-trigger="change" onchange="test_city_pref_change('state_pref_2','city_pref_2')">
                    <option value="">Choose Test City Perferences 2</option>
                  </select>
                  <span id="custom-city_pref_2-parsley-error"></span>
              </div>
              <input type="hidden" name="city_choice_no_2" id="city_choice_no_2" value="<?php echo (isset($applicant_city_choice_no[1]))?$applicant_city_choice_no[1]:'2'; ?>" />
              <input type="hidden" name="city_prefer_id_2" id="city_prefer_id_2" value="<?php echo (isset($applicant_city_id[1]))?$applicant_city_id[1]:''; ?>" />
          </div><!-- col-6 -->
      </div>

      <h5 class="text-primary mt-4 mb-3">Personal Details</h5>
      <div class="row mg-b-25">
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Title <span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_title" id="pd_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG;?>" data-parsley-errors-container="#custom-pd_title-parsley-error" data-parsley-trigger="change">
                  <option value="">Choose Title</option>
                  </select>
                  <span id="custom-pd_title-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group">
                  <label class="form-control-label">First Name <span class="tx-danger"> *</span></label>
                  <input class="form-control" type="text" name="pd_firstname" id="pd_firstname" placeholder="Your First Name" maxlength="<?php echo APLCT_FIRST_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_FIRST_NAME_MSG;?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_FIRST_NAME_MINLENGTH; ?>, <?php echo APLCT_FIRST_NAME_MAXLENGTH; ?>]" value="<?php echo $first_name; ?>" data-parsley-trigger="change">
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group">
                  <label class="form-control-label">Middle Name </label>
                  <input class="form-control" type="text" name="pd_middlename" id="pd_middlename" placeholder="Your Middle Name" value="<?php echo $m_name; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_MIDDLE_NAME_MINLENGTH; ?>, <?php echo APLCT_MIDDLE_NAME_MAXLENGTH; ?>]" maxlength="<?php echo APLCT_MIDDLE_NAME_MAXLENGTH; ?>" data-parsley-trigger="change">
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group">
                  <label class="form-control-label">Last Name <span class="tx-danger"> *</span></label>
                  <input class="form-control" type="text" name="pd_lastname" id="pd_lastname" placeholder="Your Last Name" maxlength="<?php echo APLCT_LAST_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_LAST_NAME_MSG;?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_LAST_NAME_MINLENGTH; ?>, <?php echo APLCT_LAST_NAME_MAXLENGTH; ?>]" value="<?php echo $last_name; ?>" data-parsley-trigger="change">
              </div>
          </div><!-- col-4 -->
          <div class="col-md-4">
              <label class="form-control-label">Mobile No <span class="tx-danger"> *</span></label>
              <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                    <select class="form-control form_control custom-select Mobile_number" id="phone_no_code" name="phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                        <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                    </select>
                </span>
                <input type="text" name="pd_mobile_no" id="pd_mobile_no" maxlength="<?php echo APLCT_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Mobile No" class="form-control" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOBILE_MSG;?>"  data-parsley-errors-container="#custom-pd_mobile_no-parsley-error" value="<?php echo $mobile_no; ?>" data-parsley-trigger="change" data-parsley-mobileonly="true">
              </div>
              <span id="custom-pd_mobile_no-parsley-error"></span>
          </div>
          <div class="col-lg-4">
              <div class="form-group">
                  <label class="form-control-label">Email ID <span class="tx-danger"> *</span></label>
                  <input class="form-control" type="email" name="pd_email" id="pd_email" placeholder="Your email id." data-parsley-required="true" data-parsley-required-message="<?php echo REQD_EMAIL_MSG;?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_email-parsley-error" value="<?php echo $email_id; ?>" data-parsley-trigger="change" maxlength="<?php echo APLCT_EMAIL_MAXLENGTH; ?>">
                  <span id="custom-pd_email-parsley-error"></span>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="wd-200 w-100">
                  <label class="form-control-label">Date of Birth <span class="tx-danger"> *</span></label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                      <input type="text" class="form-control hasDatepicker" name="pd_dob" id="pd_dob" placeholder="DD/MM/YYYY" value="<?php echo  $dob; ?>" readonly data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DOB_MSG;?>" data-parsley-errors-container="#custom-pd_dob-parsley-error" data-parsley-trigger="change focusout">
                  </div>
                  <span id="custom-pd_dob-parsley-error"></span>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Gender <span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Gender" tabindex="-1" aria-hidden="true" name="pd_gender" id="pd_gender" title="Choose Gender" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_GENDER_MSG;?>" data-parsley-errors-container="#custom-pd_gender-parsley-error" data-parsley-trigger="change">
                      <option value="">Choose Gender</option>
                  </select>
                  <span id="custom-pd_gender-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group">
                  <label class="form-control-label">Alternate Email ID</label>
                  <input class="form-control" type="email" name="pd_alt_email" id="pd_alt_email" placeholder="Alternate Email" data-parsley-required="false" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_ALT_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_alt_email-parsley-error" data-parsley-trigger="change" value="<?php echo $sec_e_mail; ?>" maxlength="<?php echo APLCT_ALT_EMAIL_MAXLENGTH; ?>">
                  <span id="custom-pd_alt_email-parsley-error"></span>
                  <span id="suggestion_alt_email"></span>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Blood Group <span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Blood Group" tabindex="-1" aria-hidden="true" name="pd_blood_group" id="pd_blood_group" title="Choose Blood Group" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BLOOD_GRP_MSG;?>" data-parsley-errors-container="#custom-pd_blood_group-parsley-error" data-parsley-trigger="change">
                      <option value="">Choose Blood Group</option>
                  </select>
                  <span id="custom-pd_blood_group-parsley-error"></span>
              </div>
          </div>
        <!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Religion</label>
                  <select class="form-control select2" data-placeholder="Choose Religion" tabindex="-1" aria-hidden="true" name="pd_religion" id="pd_religion" title="Choose Religion" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_RELIGION_MSG;?>" data-parsley-errors-container="#custom-pd_religion-parsley-error" data-parsley-trigger="change">
                      <option value="">Choose Religion</option>
                  </select>
                  <span id="custom-pd_religion-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Mother Tongue</label>
                  <select class="form-control select2" data-placeholder="Choose Mother Tongue" tabindex="-1" aria-hidden="true" name="pd_mother_tongue" id="pd_mother_tongue" title="Choose Mother Tongue" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_TONGUE_MSG;?>" data-parsley-errors-container="#custom-pd_mother_tongue-parsley-error" data-parsley-trigger="change">
                      <option value="">Choose Mother Tongue</option>
                  </select>
                  <span id="custom-pd_mother_tongue-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Medium of Instruction</label>
                  <select class="form-control select2" data-placeholder="Choose Medium of Instruction" tabindex="-1" aria-hidden="true" name="pd_medium_of_instruction" id="pd_medium_of_instruction" title="Choose Medium of Instruction" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MEDIUM_INSTR_MSG;?>" data-parsley-errors-container="#custom-pd_medium_of_instruction-parsley-error" data-parsley-trigger="change">
                      <option value="">Choose Medium of Instruction</option>
                  </select>
                  <span id="custom-pd_medium_of_instruction-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Hostel Accommodation</label>
                  <select class="form-control select2" data-placeholder="Choose Hostel Accommodation" tabindex="-1" aria-hidden="true" name="pd_hostel_accommodation" id="pd_hostel_accommodation" title="Choose Hostel Accommodation" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_HOSTEL_ACCOM_MSG;?>" data-parsley-errors-container="#custom-pd_hostel_accommodation-parsley-error" data-parsley-trigger="change">
                      <option value="">Choose Hostel Accommodation</option>
                  </select>
                  <span id="custom-pd_hostel_accommodation-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Are you a differently Abled? <span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Differently Abled" tabindex="-1" aria-hidden="true" name="pd_diffrently_abled" id="pd_diffrently_abled" title="Choose Differently Abled" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DIFF_ABLED_MSG;?>" data-parsley-errors-container="#custom-pd_diffrently_abled-parsley-error" data-parsley-trigger="change">
                  <option value="">Choose Differently Abled</option>
                  <option value="yes">Yes</option>
                  <option value="No">No</option>
                  </select>
                  <span id="custom-pd_diffrently_abled-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Where do you see admission advertisement?</label>
                  <select class="form-control select2" data-placeholder="Choose Advertisement Source" tabindex="-1" aria-hidden="true" name="pd_advertisement_source" id="pd_advertisement_source" title="Choose Advertisement Source " data-parsley-required="false" data-parsley-required-message="<?php echo REQD_ADVERTISE_MSG;?>" data-parsley-errors-container="#custom-pd_advertisement_source-parsley-error" data-parsley-trigger="change">
                      <option value="">Choose Advertisement Source</option>
                  </select>
                  <span id="custom-pd_advertisement_source-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Nationality <span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Nationality" tabindex="-1" aria-hidden="true" name="pd_nationality" id="pd_nationality" title="Choose Nationality" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_NATION_MSG;?>" data-parsley-errors-container="#custom-pd_nationality-parsley-error" data-parsley-trigger="change">
                      <option value="">Choose Nationality</option>
                  </select>
                  <span id="custom-pd_nationality-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4" id="main_div_community" style="display:none">
              <div class="form-group mg-b-10-force" id="Community">
                  <label class="form-control-label">Community <span class="tx-danger">*</span></label>
                  <select class="form-control select2" data-placeholder="Choose Community" tabindex="-1" aria-hidden="true" name="pd_social_status" id="pd_social_status" title="Choose Community" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_COMMUNITY_MSG;?>" data-parsley-errors-container="#custom-pd_social_status-parsley-error" data-parsley-trigger="change">
                      <option value="">Choose Community</option>
                  </select>
                  <span id="custom-pd_social_status-parsley-error"></span>
              </div>
          </div><!-- col-4 -->

      </div><!-- row -->

    </fieldset>
    <h3 class="wizard_head_tag">Parent's & Address</h3>
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
                    <div class="card-body" style="font-size: 13px;"><?php echo $applicant_parent_address_wizard_instructions;?></div>
                </div>
            </div>

            <!-- card -->
        </div>
       
            <h5 class="text-primary mb-3">Father's Details</h5>
          
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Title<span class="tx-danger">*</span></label>
                            <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_father_title" id="pd_father_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG;?>" data-parsley-errors-container="#custom-pd_father_title-parsley-error" data-parsley-trigger="change">
                              <option value="">Choose Title</option>
                            </select>
                            <span id="custom-pd_father_title-parsley-error"></span>
                            <input type="hidden" name="pd_father_id" id="pd_father_id" value="<?php echo $app_parent_det_id[$parent_type_id_father]; ?>" />
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Father's Name <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="pd_father_name" id="pd_father_name" placeholder="Enter Your Father Name" maxlength="<?php echo APLCT_FATHER_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_FATHER_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_FATHER_NAME_MINLENGTH; ?>, <?php echo APLCT_FATHER_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_father]; ?>" />
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4" id="father_mbleno_div" style="display:none;">
                        <label class="form-control-label">Father's Mobile Number</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="pd_father_phone_no_code" name="pd_father_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                            <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                          </select>
                        </span>
                        <input type="text" class="form-control" name="pd_father_phone" id="pd_father_phone" maxlength="<?php echo APLCT_FATHER_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_FATHER_MOBILE_MSG;?>" data-parsley-maxlength-message="<?php echo VALID_FATHER_MOBILE_MSG;?>" data-parsley-errors-container="#custom-pd_father_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no[$parent_type_id_father]; ?>" data-parsley-notequalto="#pd_mother_phone" data-parsley-notequalto-message="<?php echo PHONE_MATCH_FATHER; ?>" data-parsley-mobileonly="true">
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
                        <input type="text" class="form-control" name="pd_father_alt_phone" id="pd_father_alt_phone" maxlength="<?php echo APLCT_FATHER_ALT_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Alternate Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_ALT_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_FATHER_MOBILE_MSG;?>" data-parsley-maxlength-message="<?php echo VALID_FATHER_MOBILE_MSG;?>" data-parsley-errors-container="#custom-pd_father_alt_phone-parsley-error" value="<?php echo $applicant_parent_alt_mobile_no[$parent_type_id_father]; ?>">
                      </div>
                      <span id="custom-pd_father_alt_phone-parsley-error"></span>
                    </div>
                    <div class="col-lg-4" id="father_email_div" style="display:none;">
                      <div class="form-group">
                        <label class="form-control-label">Father's Email ID </label>
                        <input class="form-control" type="email" name="pd_father_email" id="pd_father_email"  placeholder="Enter Your Father's Email ID" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_EMAIL_MSG;?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_FATHER_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_father_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_father]; ?>" maxlength="<?php echo APLCT_FATHER_EMAIL_MAXLENGTH; ?>" data-parsley-notequalto="#pd_mother_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_FATHER; ?>">
                        <span id="custom-pd_father_email-parsley-error"></span>
                        <span id="suggestion_father_email"></span>
                      </div>
                    </div>
                    <div class="col-lg-4"  id="father_occupation_div" style="display:none;">
                      <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Father's Occupation</label>
                        <select class="form-control select2" data-placeholder="Choose Occupation" tabindex="-1" aria-hidden="true" name="pd_father_occupation" id="pd_father_occupation">
                          <option value="">Select Father's Occupation</option>
                        </select>
                      </div>
                      <div id="other_occupation_father_div" style="display:none;">
                        <input class="form-control" type="text" name="other_occupation_father" id="other_occupation_father"  placeholder="If Other, pls enter here"data-parsley-required="false" data-parsley-errors-container="#custom-other_occupation_father-parsley-error" value="<?php echo $applicant_parent_other_occupation_name[$parent_type_id_father]; ?>" maxlength="<?php echo APLCT_FATHER_OCCP_MAXLENGTH; ?>" >
                        <span id="custom-other_occupation_father-parsley-error"></span>
                      </div>
                    </div><!-- col-4 -->
                    
                </div><!-- row -->
           
        
            <h5 class="text-primary mt-4 mb-3">Mother's Details</h5>
           
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Title <span class="tx-danger">*</span></label>
                          <select class="form-control select2" name="pd_mother_title" id="pd_mother_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG;?>" data-parsley-errors-container="#custom-pd_mother_title-parsley-error" data-parsley-trigger="change">
                            <option value="">Choose Title</option>
                          </select>
                          <span id="custom-pd_mother_title-parsley-error"></span>
                          <input type="hidden" name="pd_mother_id" id="pd_mother_id"  value="<?php echo $app_parent_det_id[$parent_type_id_mother]; ?>" />
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Mother's Name <span class="tx-danger">*</span></label>
                          <input type="text" class="form-control" name="pd_mother_name" id="pd_mother_name" placeholder="Enter Your Mother's Name" maxlength="<?php echo APLCT_MOTHER_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MOTHER_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_MOTHER_NAME_MINLENGTH; ?>, <?php echo APLCT_MOTHER_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_mother]; ?>">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4" id="mother_mbleno_div" style="display:none;">
                        <label class="form-control-label">Mother's Mobile Number</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="pd_mother_phone_no_code" name="pd_mother_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                            <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                          </select>
                        </span>
                        <input type="text" class="form-control" name="pd_mother_phone" id="pd_mother_phone" maxlength="<?php echo APLCT_MOTHER_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOTHER_MOBILE_MSG;?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="<?php echo VALID_MOTHER_MOBILE_MSG;?>" data-parsley-errors-container="#custom-pd_mother_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no[$parent_type_id_mother]; ?>" data-parsley-notequalto="#pd_father_phone" data-parsley-notequalto-message="<?php echo PHONE_MATCH_MOTHER; ?>">
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
                        <input type="text" class="form-control" name="pd_mother_alt_phone" id="pd_mother_alt_phone" maxlength="<?php echo APLCT_MOTHER_ALT_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOTHER_MOBILE_MSG;?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="<?php echo VALID_MOTHER_MOBILE_MSG;?>" data-parsley-errors-container="#custom-pd_mother_alt_phone-parsley-error" value="<?php echo $applicant_parent_alt_mobile_no[$parent_type_id_mother]; ?>">
                        <span id="custom-pd_mother_alt_phone-parsley-error"></span>
                        </div>
                    </div>
                    <div class="col-lg-4" id="mother_email_div" style="display:none;">
                        <div class="form-group">
                            <label class="form-control-label">Mother's Email ID </label>
                            <input class="form-control" type="email" name="pd_mother_email" id="pd_mother_email"  placeholder="Enter Your Mother's Email ID"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_EMAIL_MSG;?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_MOTHER_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_mother_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_mother]; ?>" maxlength="<?php echo APLCT_MOTHER_EMAIL_MAXLENGTH; ?>" data-parsley-notequalto="#pd_father_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_MOTHER; ?>">
                            <span id="custom-pd_mother_email-parsley-error"></span>
                            <span id="suggestion_mother_email"></span>
                        </div>
                    </div>
                    <div class="col-lg-4" id="mother_occupation_div" style="display:none;">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Mother's Occupation</label>
                            <select class="form-control select2" data-placeholder="Choose Occupation" tabindex="-1" aria-hidden="true" name="pd_mother_occupation" id="pd_mother_occupation">
                              <option value="">Select Mother's Occupation</option>
                            </select>
                        </div>
                        <div id="other_occupation_mother_div" style="display:none;">
                          <input class="form-control" type="text" name="other_occupation_mother" id="other_occupation_mother"  placeholder="If Other, pls enter here"data-parsley-required="false" data-parsley-errors-container="#custom-other_occupation_mother-parsley-error" value="<?php echo $applicant_parent_other_occupation_name[$parent_type_id_mother]; ?>" maxlength="<?php echo APLCT_MOTHER_OCCP_MAXLENGTH; ?>">
                          <span id="custom-other_occupation_mother-parsley-error"></span>
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
                          <input class="form-control" type="text" name="pd_guardian_name" id="pd_guardian_name" placeholder="Enter Your Guardian Name" maxlength="<?php echo APLCT_GUARDIAN_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_GUARDIAN_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_GUARDIAN_NAME_MINLENGTH; ?>, <?php echo APLCT_GUARDIAN_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_guardian]; ?>">
                          <input type="hidden" name="pd_guardian_id" id="pd_guardian_id" value="<?php echo $app_parent_det_id[$parent_type_id_guardian]; ?>" />
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <label class="form-control-label">Guardian's Mobile No <span class="tx-danger">*</span></label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                        <select class="form-control form_control custom-select Mobile_number" id="pd_guardian_phone_no_code" name="pd_guardian_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                          <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                        </select>
                        </span>
                        <input type="text" class="form-control" name="pd_guardian_phone" id="pd_guardian_phone" maxlength="<?php echo APLCT_GUARDIAN_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Guardian's Mobile No" class="form-control" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_GUARDIAN_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_GUARDIAN_MOBILE_MSG;?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="<?php echo VALID_GUARDIAN_MOBILE_MSG;?>" data-parsley-errors-container="#custom-pd_guardian_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no[$parent_type_id_guardian]; ?>">
                      </div>
                      <span id="custom-pd_guardian_phone-parsley-error"></span>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Guardian's Email ID</label>
                            <input class="form-control" type="email" name="pd_guardian_email" id="pd_guardian_email"  placeholder="Enter Your Guardian's Email ID"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_EMAIL_MSG;?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_GUARDIAN_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_guardian_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_guardian]; ?>" maxlength="<?php echo APLCT_GUARDIAN_EMAIL_MAXLENGTH; ?>">
                            <span id="custom-pd_guardian_email-parsley-error"></span>
                            <span id="suggestion_guardian_email"></span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Guardian's Occupation</label>
                            <select class="form-control select2" data-placeholder="Choose Guardian Occupation" tabindex="-1" aria-hidden="true" name="pd_guardian_occupation" id="pd_guardian_occupation">
                              <option value="">Select Guardian's Occupation</option>
                            </select>
                        </div>
                        <div id="other_occupation_guardian_div" style="display:none;">
                          <input class="form-control" type="text" name="other_occupation_guardian" id="other_occupation_guardian"  placeholder="If Other, pls enter here"data-parsley-required="false" data-parsley-errors-container="#custom-other_occupation_guardian-parsley-error" value="<?php echo $applicant_parent_other_occupation_name[$parent_type_id_guardian]; ?>" maxlength="<?php echo APLCT_GUARDIAN_OCCP_MAXLENGTH; ?>">
                          <span id="custom-other_occupation_guardian-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                </div><!-- row -->
              </div>
        
            <h5 class="text-primary mt-4 mb-3">Address for Communication</h5>
            
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Country<span class="tx-danger"> *</span></label>
                            <select class="form-control select2" data-placeholder="Choose country" tabindex="-1" aria-hidden="true" name="country" id="country" title="Choose Country" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_COUNTRY_MSG;?>" data-parsley-errors-container="#custom-country-parsley-error" data-parsley-trigger="change">
                              <option value="">Select Country</option>
                            </select>
                            <span id="custom-country-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-3" id="main_div_state">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">State<span class="tx-danger"> *</span></label>
                            <select class="form-control select2" data-placeholder="Choose State" tabindex="-1" aria-hidden="true" name="state" id="state" title="Choose State" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_STATE_MSG;?>" data-parsley-errors-container="#custom-state-parsley-error" data-parsley-trigger="change">
                              <option value="">Select State</option>
                            </select>
                            <span id="custom-state-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-3" id="main_div_district">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">District<span class="tx-danger"> *</span></label>
                            <select class="form-control select2" data-placeholder="Choose District" tabindex="-1" aria-hidden="true" name="district" id="district" title="Choose District" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DISTRICT_MSG;?>" data-parsley-errors-container="#custom-district-parsley-error" data-parsley-trigger="change">
                              <option value="">Select District</option>
                            </select>
                            <span id="custom-district-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-3" id="main_div_city">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">City<span class="tx-danger"> *</span></label>
                            <select class="form-control select2" data-placeholder="Choose City" tabindex="-1" aria-hidden="false" name="city" id="city" title="Choose City" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CITY_MSG;?>" data-parsley-errors-container="#custom-city-parsley-error" data-parsley-trigger="change">
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
                            <input class="form-control" type="text" name="address_line1" id="address_line1" placeholder="Enter Address Line 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_ADDRESS_MSG;?>" value="<?php if($add_line_1[0]) {echo $add_line_1[0];} ?>" data-parsley-maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH; ?>" maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH; ?>">
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
                            <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Pincode" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PINCODE_MSG;?>" value="<?php if($pin_code[0]) {echo $pin_code[0];} ?>" data-parsley-maxlength="<?php echo APLCT_PINCODE_MAXLENGTH; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_PINCODE_MSG; ?>" maxlength="<?php echo APLCT_PINCODE_MAXLENGTH; ?>">
                        </div>
                    </div><!-- col-4 -->

                </div><!-- row -->
    </fieldset>

    <h3 class="wizard_head_tag">Academic Detail</h3>
    <fieldset>
        <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
            <div class="card ">
                <div class="card-header p-0 " role="tab" id="headingOne">
                    <h6 class="p-2 ml-3">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed instruction_accordion">

                            <i class="fas fa-info-circle"></i>
                            Instructions</a>
                    </h6>
                </div><!-- card-header -->

                <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                    <div class="card-body" style="font-size: 13px;">
                      <?php echo $applicant_academic_wizard_instructions;?></div>
                </div>
            </div>

            <!-- card -->
        </div>
        <h6 class="card-body-title mt-4">Academic Details</h6>
        <div action="form-validation.html" id="selectForm" class="w-100">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group mr-5">
                        <label class="form-control-label">Current Education Qualification Status <span class="tx-danger">*</span></label>
                        <div class="row">
                          <div class="col-lg-5 pr-0">
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="appering" name="current_education_qual_status" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="<?php echo REQD_EDU_QUAL_MSG;?>" data-parsley-errors-container="#custom-current_education_qual_status-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($cur_qual_completed == 'f')?'checked':''; ?>>
                              <label class="custom-control-label" for="appering">Graduation Appearing</label>
                            </div>
                          </div>
                          <div class="col-lg-5 pl-0">
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="completed" name="current_education_qual_status" class="custom-control-input" value="2" <?php echo ($cur_qual_completed == 't')?'checked':''; ?>>
                              <label class="custom-control-label" for="completed">Graduation Completed</label>
                            </div>
                          </div>
                          <span id="custom-current_education_qual_status-parsley-error"></span>
                        </div>

                    </div><!-- form-group -->
                </div>
                <div class="col-lg-6 ">
                    <div class="form-group wd-xs-300 mr-5 w-100">
                        <label class="form-control-label">Candidate's Name as per qualifying examination marksheet <span class="tx-danger">*</span></label>
                        <div class="form-group mg-b-10-force">
                            <input class="form-control" type="text" name="canditate_name" id="canditate_name" placeholder="Enter Name" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_CANDIDATE_NAME_MSG;?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_CAND_NAME_MINLENGTH; ?>, <?php echo APLCT_CAND_NAME_MAXLENGTH; ?>]" value="<?php echo $canditate_name; ?>" maxlength="<?php echo APLCT_CAND_NAME_MAXLENGTH; ?>" data-parsley-trigger="change">
                            <small id="emailHelp"
                                class="form-text text-muted">Kindly type NA in
                                case Certificate is not available with you.</small>
                        </div>
                    </div><!-- form-group -->
                </div>
            </div>
        </div>
        <div id="exp_year" class="row w-100" style="display:none">
            <div class="col-lg-6">
                <div class="wd-200 w-100">
                    <label class="form-control-label">Expected month and Year of result to be declared <span class="tx-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                        <input id="result_declare_date" name="result_declare_date" type="text" class="form-control hasDatepicker" placeholder="MM/YYYY" readonly data-parsley-required="false" data-parsley-required-message="<?php echo REQD_DECLARE_MONTH_MSG; ?>" value="<?php echo $result_declare_date; ?>" data-parsley-errors-container="#custom-result_declare_date-parsley-error" data-parsley-trigger="change" >
                    </div>
                    <span id="custom-result_declare_date-parsley-error"></span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered mt-0">
            <thead class="thead-light">
                <tr>
                    <th>Course</th>
                    <th>Institute Name</th>
                    <th>University</th>
                    <th>Roll No. / Registration No.</th>
                    <th>Mode of Study</th>
                    <th>Year of Passing</th>
                    <th>Marking Scheme</th>
                    <th>Obtained Percentage/CGPA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><p>UG</p></td>
                    <td>
                      <input class="form-control" type="hidden" placeholder="" id="grad_id" name="grad_id" value="<?php echo $applicant_grad_det_id; ?>">
                      <input class="form-control" type="text" name="institute_name" id="institute_name" placeholder="Enter Institute Name" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_INSTITUTE_NAME_MSG;?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_INSTITUTE_NAME_MINLENGTH; ?>, <?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_grad_det_insti_name; ?>" maxlength="<?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>" data-parsley-trigger="change">
                      <span class="tx-danger required_asterisk">*</span>
                    </td>
                    <td>
                      <div class="form-group mg-b-10-force">
                        <select class="form-control custom-select" id="institute_university" name="institute_university" data-placeholder="Choose University" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_UNIVERSITY_MSG;?>" data-parsley-errors-container="#custom-institute_university-parsley-error">
                          <option value="">Select</option>
                        </select>
                        <span class="tx-danger required_asterisk">*</span>
                        <span id="custom-institute_university-parsley-error"></span>
                      </div>
                      <div id="ob_univ" style="display:none;">
                        <input class="form-control" type="text" name="other_univ_grad" id="other_univ_grad" maxlength="<?php echo APLCT_OTHER_GRAD_MAXLENGTH; ?>" value="<?php echo $applicant_grad_det_insti_other_name; ?>">         
                      </div>
                    </td>
                    <td>
                      <input class="form-control" type="text" name="registration_no" id="registration_no" placeholder="Roll No. / Registration No" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_REG_NO_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_grad_det_reg_no; ?>">
                      <span class="tx-danger required_asterisk">*</span>
                    </td>
                    <td>
                      <div class="form-group mg-b-10-force">
                        <select class="form-control custom-select" name="mode_of_study" id="mode_of_study" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MODE_STUDY_MSG;?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-mode_of_study-parsley-error">
                          <option value="">Select</option>
                        </select>
                        <span class="tx-danger required_asterisk">*</span>
                        <span id="custom-mode_of_study-parsley-error"></span>
                      </div>
                    </td>
                    <td>
                      <input class="form-control" type="text" name="year_of_passing" id="year_of_passing" placeholder="YYYY" maxlength="<?php echo APLCT_YEAR_OF_PASSING_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_YEAR_OF_PASSING_MSG;?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-year_of_passing-parsley-error" value="<?php echo $applicant_grad_det_completion_year; ?>" readonly>
                      <span class="tx-danger required_asterisk">*</span>
                      <span id="custom-year_of_passing-parsley-error"></span>
                    </td>
                    <td>
                        <div class="form-group mg-b-10-force" id="appering_info_1">
                          <select class="form-control custom-select" name="marking_scheme" id="marking_scheme" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MARK_SCHEME_MSG;?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-marking_scheme-parsley-error">
                            <option value="">Select</option>
                          </select>
                          <span class="tx-danger required_asterisk">*</span>
                          <span id="custom-marking_scheme-parsley-error"></span>
                        </div>
                    </td>
                    <td>
                      <div class="form-group mg-b-10-force" id="appering_info_2">
                        <input class="form-control" type="text" name="obtained_percentage_cgpa" placeholder="Obtained Percentage/CGPA" id="obtained_percentage_cgpa" maxlength="<?php echo APLCT_PERCENT_CGPA_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG;?>" min="<?php echo APLCT_MARK_MINLENGTH; ?>" max="<?php echo APLCT_MARK_MAXLENGTH; ?>" data-parsley-trigger="keyup" data-parsley-trigger="change" data-parsley-errors-container="#custom-obtained_percentage_cgpa-parsley-error" value="<?php echo $applicant_grad_det_mark_percent; ?>"> 
                        <span class="tx-danger required_asterisk">*</span>
                        <span id="custom-obtained_percentage_cgpa-parsley-error"></span>
                      </div>
                    </td>
                </tr>
            </tbody>
        </table>
      </div>
        <div class="mt-3 w-100">
            <div class="row">

                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label">NAD ID / Digilocker ID</label>
                        <input class="form-control" type="text" name="nad_id_digilocker_id" id="nad_id_digilocker_id" placeholder="Enter NAD ID / Digilocker ID " value="<?php echo $nad_id_digilocker_id; ?>" maxlength="<?php echo APLCT_NADID_MAXLENGTH; ?>">
                        <small id="emailHelp" class="form-text text-muted">National
                            Academic Depository (NAD)" is a National System set-up
                            by Ministry of Human Resources Development and
                            University Grants Commission by appointing NSDL Database
                            Management Limited(NDML) to facilitate Academic
                            Institutions to Digitally, Securely and Quickly issue
                            Online Academic Awards to the Students directly in their
                            online NAD Account. The student can access certificate
                            at any time andauthorise employers, banks to view and
                            verify the certificates.</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3 w-100">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <h6 class="card-body-title mb-4">Competitive Examination Details</h6>
                        <label class="form-control-label">Have you taken any competitive exam? <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select study" id="taken_any_competitive_exam" name="taken_any_competitive_exam" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_COMP_STATUS_MSG;?>" data-parsley-errors-container="#custom-taken_any_competitive_exam-parsley-error" data-parsley-trigger="change">
                            <option value="">Select Status - Yes or No</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        <span id="custom-taken_any_competitive_exam-parsley-error"></span>
                    </div>
                </div>
            </div>
            <div class="row" id="competitive_exam_dtl" style="display: none;">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label" for="radios">Important Instruction:</label>
                  <p>Applicants are directed to update the below table immediately after the any Competitive Exam results are announced. The merit list will be finalised based on the scores submitted by applicant.</p>
                  <label class="control-label" for="radios">Competitive Exam</label>
                  <div class="table-responsive pretbl">
                    <table class="table table-bordered mt-0">
                      <thead class="thead-light">
                        <tr>
                          <th class="align-middle">Name of the Exam</th>
                          <th class="align-middle">Registration No.</th>
                          <th class="align-middle">Score Obtained</th>
                          <th class="align-middle">Max Score</th>
                          <th class="align-middle">Year Appeared</th>
                          <th class="align-middle">AIR/ Overall Rank</th>
                          <th class="align-middle">Qualified/ Not Qualified</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <input class="form-control" type="hidden" placeholder="" id="comp_exam_pk_id_1" name="comp_exam_pk_id_1" value="<?php echo $applicant_comp_exam_pk_id[0]; ?>">
                            <select class="form-control custom-select study" id="competitive_exam_1" name="competitive_exam_1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_COMP_EXAM_MSG;?>" data-parsley-errors-container="#custom-competitive_exam_1-parsley-error" data-parsley-trigger="change"></select>
                            <span id="custom-competitive_exam_1-parsley-error"></span>
                            <span class="tx-danger required_asterisk">*</span>
                          </td>
                          <td>
                            <input class="form-control" type="text" name="registration_no_1" id="registration_no_1" placeholder="Registration No" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_COMP_REGNO_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_comp_exam_registration_no[0]; ?>">
                            <span class="tx-danger required_asterisk">*</span>
                          </td>
                          <td>
                            <input class="form-control" type="text" name="score_obtained_1" id="score_obtained_1" placeholder="Score Obtained" maxlength="<?php echo APLCT_SCORE_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SCORE_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_comp_exam_score_obtained[0]; ?>">
                            <span class="tx-danger required_asterisk">*</span>
                          </td>
                          <td>
                            <input class="form-control" type="text" name="max_score_1" id="max_score_1" placeholder="Max Score" maxlength="<?php echo APLCT_MAX_SCORE_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MAX_SCORE_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_comp_exam_max_score[0]; ?>">
                            <span class="tx-danger required_asterisk">*</span>
                          </td>
                          <td>
                              <input class="form-control" type="text" name="year_appeared_1" id="year_appeared_1" placeholder="YYYY" maxlength="<?php echo APLCT_YEAR_APPEAR_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_YEAR_APPEAR_MSG;?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-year_appeared_1-parsley-error" value="<?php echo $applicant_comp_exam_exam_year[0]; ?>">
                              <span class="tx-danger required_asterisk">*</span>
                              <span id="custom-year_appeared_1-parsley-error"></span>
                          </td>
                          <td>
                              <input class="form-control" type="text" name="air_overall_rank_1" id="air_overall_rank_1" placeholder="AIR / Overall Rank" maxlength="<?php echo APLCT_OVERALL_RANK_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_AIR_RANK_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_comp_exam_all_india_rank[0]; ?>">
                              <span class="tx-danger required_asterisk">*</span>
                          </td>
                          <td>
                            <select class="form-control custom-select study" id="qualified_not_qualified_1" name="qualified_not_qualified_1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_QUALIFY_STATUS_MSG;?>" data-parsley-errors-container="#custom-qualified_not_qualified_1-parsley-error" data-parsley-trigger="change">
                                <option value="">Select Qualified / Not Qualified</option>
                                <option value="qualified">Qualified</option>
                                <option value="not_qualified">Not Qualified</option>
                            </select>
                            <span class="tx-danger required_asterisk">*</span>
                            <span id="custom-qualified_not_qualified_1-parsley-error"></span>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <input class="form-control" type="hidden" placeholder="" id="comp_exam_pk_id_2" name="comp_exam_pk_id_2" value="<?php echo $applicant_comp_exam_pk_id[1]; ?>">
                            <select class="form-control custom-select study" id="competitive_exam_2" name="competitive_exam_2" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_COMP_EXAM_MSG;?>" data-parsley-errors-container="#custom-competitive_exam_2-parsley-error" data-parsley-trigger="change"></select>
                            <span id="custom-competitive_exam_2-parsley-error"></span>
                          </td>
                          <td>
                            <input class="form-control" type="text" name="registration_no_2" id="registration_no_2" placeholder="Registration No" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_COMP_REGNO_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_comp_exam_registration_no[1]; ?>">
                          </td>
                          <td>
                            <input class="form-control" type="text" name="score_obtained_2" id="score_obtained_2" placeholder="Score Obtained" maxlength="<?php echo APLCT_SCORE_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SCORE_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_comp_exam_score_obtained[1]; ?>">
                          </td>
                          <td>
                            <input class="form-control" type="text" name="max_score_2" id="max_score_2" placeholder="Max Score" maxlength="<?php echo APLCT_MAX_SCORE_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MAX_SCORE_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_comp_exam_max_score[1]; ?>">
                          </td>
                          <td>
                              <input class="form-control" type="text" name="year_appeared_2" id="year_appeared_2" placeholder="YYYY" maxlength="<?php echo APLCT_YEAR_APPEAR_MAXLENGTH; ?>" value="<?php echo $applicant_comp_exam_exam_year[1]; ?>" readonly>
                          </td>
                          <td>
                              <input class="form-control" type="text" name="air_overall_rank_2" id="air_overall_rank_2" placeholder="AIR / Overall Rank" maxlength="<?php echo APLCT_OVERALL_RANK_MAXLENGTH; ?>" value="<?php echo $applicant_comp_exam_all_india_rank[1]; ?>">
                          </td>
                          <td>
                            <select class="form-control custom-select study" id="qualified_not_qualified_2" name="qualified_not_qualified_2" data-parsley-errors-container="#custom-qualified_not_qualified_2-parsley-error" data-parsley-trigger="change">
                                <option value="">Select Qualified / Not Qualified</option>
                                <option value="qualified">Qualified</option>
                                <option value="not_qualified">Not Qualified</option>
                            </select>
                            <span id="custom-qualified_not_qualified_2-parsley-error"></span>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <input class="form-control" type="hidden" placeholder="" id="comp_exam_pk_id_3" name="comp_exam_pk_id_3" value="<?php echo $applicant_comp_exam_pk_id[2]; ?>">
                            <select class="form-control custom-select study" id="competitive_exam_3" name="competitive_exam_3" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_COMP_EXAM_MSG;?>" data-parsley-errors-container="#custom-competitive_exam_3-parsley-error" data-parsley-trigger="change"></select>
                            <span id="custom-competitive_exam_3-parsley-error"></span>
                          </td>
                          <td>
                            <input class="form-control" type="text" name="registration_no_3" id="registration_no_3" placeholder="Registration No" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" value="<?php echo $applicant_comp_exam_registration_no[2]; ?>">
                          </td>
                          <td>
                            <input class="form-control" type="text" name="score_obtained_3" id="score_obtained_3" placeholder="Score Obtained" maxlength="<?php echo APLCT_SCORE_MAXLENGTH; ?>" value="<?php echo $applicant_comp_exam_score_obtained[2]; ?>">
                          </td>
                          <td>
                            <input class="form-control" type="text" name="max_score_3" id="max_score_3" placeholder="Max Score" maxlength="<?php echo APLCT_MAX_SCORE_MAXLENGTH; ?>" value="<?php echo $applicant_comp_exam_max_score[2]; ?>">
                          </td>
                          <td>
                              <input class="form-control" type="text" name="year_appeared_3" id="year_appeared_3" placeholder="YYYY" maxlength="<?php echo APLCT_YEAR_APPEAR_MAXLENGTH; ?>" value="<?php echo $applicant_comp_exam_exam_year[2]; ?>" readonly>
                          </td>
                          <td>
                              <input class="form-control" type="text" name="air_overall_rank_3" id="air_overall_rank_3" placeholder="AIR / Overall Rank" maxlength="<?php echo APLCT_OVERALL_RANK_MAXLENGTH; ?>" value="<?php echo $applicant_comp_exam_all_india_rank[2]; ?>">
                          </td>
                          <td>
                            <select class="form-control custom-select study" id="qualified_not_qualified_3" name="qualified_not_qualified_3" data-parsley-trigger="change" data-parsley-errors-container="#custom-qualified_not_qualified_3-parsley-error">
                                <option value="">Select Qualified / Not Qualified</option>
                                <option value="qualified">Qualified</option>
                                <option value="not_qualified">Not Qualified</option>
                            </select>
                            <span id="custom-qualified_not_qualified_3-parsley-error"></span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="mt-3 w-100">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <h6 class="card-body-title mb-4">Work Experience Details</h6>
                        <label class="form-control-label">Do you have any Work Experience ? <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select study" id="is_work_experience" name="is_work_experience" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_WORK_EXP_MSG;?>" data-parsley-errors-container="#custom-is_work_experience-parsley-error" data-parsley-trigger="change">
                            <option value="">Select Status - Yes or No</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        <span id="custom-is_work_experience-parsley-error"></span>
                    </div>
                </div>
            </div>
            <div class="row" id="emp_exp" style="display: none;">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label" for="radios">Work Experience Details</label>
                  <div class="table-responsive pretbl">
                    <table class="table table-bordered mt-0" id="table5">
                      <thead class="thead-light">
                         <tr>
                             <th>
                             </th>
                             <th>Organisation's Name</th>
                             <th>Designation</th>
                             <th>Nature of job</th>
                             <th>Total Salary /Month</th>
                             <th>From Year</th>
                             <th>To Year</th>
                             <th>Work Experience(In Months)</th>
                         </tr>
                      </thead>
                      <tbody>
                         <tr>
                            <td nowrap="">1.</td>
                            <td>
                               <input class="form-control" type="hidden" placeholder="" id="prof_exp_id_0" name="prof_exp_id_0" value="<?php echo $applicant_prof_exp_id[0]; ?>">
                               <div class="form-group"><input type="text" name="organisation_name_0" id="organisation_name_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_ORGANISATION_NAME_MAXLENGTH; ?>"data-parsley-required="true" data-parsley-required-message="<?php echo REQD_ORG_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_org_name[0]; ?>"></div>
                               <span class="tx-danger required_asterisk">*</span>
                            </td>
                            <td>
                               <div class="form-group"><input type="text" name="designation_0" id="designation_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_DESIGNATION_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DESIGNATION_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_designation[0]; ?>"></div>
                               <span class="tx-danger required_asterisk">*</span>
                            </td>
                            <td>
                               <div class="form-group"><input type="text" name="nature_of_job_0" id="nature_of_job_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_JOB_NATURE_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_NATURE_JOB_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_job_nature[0]; ?>"></div>
                               <span class="tx-danger required_asterisk">*</span>
                            </td>
                            <td>
                               <div class="form-group"><input type="text" name="total_salary_month_0" id="total_salary_month_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_SALARY_PER_MONTH_MAXLENGTH; ?>"data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TOTAL_SALARY_MONTH_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_salary[0]; ?>"></div>
                               <span class="tx-danger required_asterisk">*</span>
                            </td>
                            <td>
                               <div class="form-group"><input readonly="" type="text" name="from_year_0" id="from_year_0" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_FROM_YEAR_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_FROM_YEAR_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_from_date[0]; ?>" data-parsley-errors-container="#custom-from_year_0-parsley-error"></div>
                               <span id="custom-from_year_0-parsley-error"></span>
                               <span class="tx-danger required_asterisk">*</span>
                            </td>
                            <td>
                               <div class="form-group"><input readonly="" type="text" name="to_year_0" id="to_year_0" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_TO_YEAR_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TO_YEAR_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_to_date[0]; ?>" data-parsley-errors-container="#custom-to_year_0-parsley-error"></div>
                               <span id="custom-to_year_0-parsley-error"></span>
                               <span class="tx-danger required_asterisk">*</span>
                            </td>
                            <td>
                               <div class="form-group"><input type="text" name="work_experience_0" id="work_experience_0" class="form-control" placeholder="" readonly="readonly" maxlength="<?php echo APLCT_TOT_WORK_EXP_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_WORK_EXP_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_work_exp_in_months[0]; ?>" data-parsley-errors-container="#custom-work_experience_0-parsley-error"></div>
                               <span id="custom-work_experience_0-parsley-error"></span>
                               <span class="tx-danger required_asterisk">*</span>
                            </td>
                         </tr>
                         <tr>
                            <td nowrap="">2.</td>
                            <td>
                               <input class="form-control" type="hidden" placeholder="" id="prof_exp_id_1" name="prof_exp_id_1" value="<?php echo $applicant_prof_exp_id[1]; ?>">
                               <div class="form-group"><input type="text" name="organisation_name_1" id="organisation_name_1" class="form-control" placeholder="" maxlength="<?php echo APLCT_ORGANISATION_NAME_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_org_name[1]; ?>"></div>
                            </td>
                            <td>
                               <div class="form-group"><input type="text" name="designation_1" id="designation_1" class="form-control" placeholder="" maxlength="<?php echo APLCT_DESIGNATION_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_designation[1]; ?>"></div>
                            </td>
                            <td>
                               <div class="form-group"><input type="text" name="nature_of_job_1" id="nature_of_job_1" class="form-control" placeholder="" maxlength="<?php echo APLCT_JOB_NATURE_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_job_nature[1]; ?>"></div>
                            </td>
                            <td>
                               <div class="form-group"><input type="text" name="total_salary_month_1" id="total_salary_month_1" class="form-control" placeholder="" maxlength="<?php echo APLCT_SALARY_PER_MONTH_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_salary[1]; ?>"></div>
                            </td>
                            <td>
                               <div class="form-group">
                                <input readonly="" type="text" name="from_year_1" id="from_year_1" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_FROM_YEAR_MAXLENGTH; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_from_date[1]; ?>" data-parsley-errors-container="#custom-from_year_1-parsley-error">
                                <span id="custom-from_year_1-parsley-error"></span>
                               </div>
                            </td>
                            <td>
                               <div class="form-group"><input readonly="" type="text" name="to_year_1" id="to_year_1" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_TO_YEAR_MAXLENGTH; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_to_date[1]; ?>" data-parsley-errors-container="#custom-to_year_1-parsley-error">
                                <span id="custom-to_year_1-parsley-error"></span>
                               </div>
                            </td>
                            <td>
                               <div class="form-group"><input type="text" name="work_experience_1" id="work_experience_1" class="form-control" placeholder="" readonly="readonly" maxlength="<?php echo APLCT_TOT_WORK_EXP_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_work_exp_in_months[1]; ?>"></div>
                            </td>
                         </tr>
                         <tr>
                            <td nowrap="">3.</td>
                            <td>
                               <input class="form-control" type="hidden" placeholder="" id="prof_exp_id_2" name="prof_exp_id_2" value="<?php echo $applicant_prof_exp_id[2]; ?>">
                               <div class="form-group"><input type="text" name="organisation_name_2" id="organisation_name_2" class="form-control" placeholder="" maxlength="<?php echo APLCT_ORGANISATION_NAME_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_org_name[2]; ?>"></div>
                            </td>
                            <td>
                               <div class="form-group"><input type="text" name="designation_2" id="designation_2" class="form-control" placeholder="" maxlength="<?php echo APLCT_DESIGNATION_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_designation[2]; ?>"></div>
                            </td>
                            <td>
                               <div class="form-group"><input type="text" name="nature_of_job_2" id="nature_of_job_2" class="form-control" placeholder="" maxlength="<?php echo APLCT_JOB_NATURE_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_job_nature[2]; ?>"></div>
                            </td>
                            <td>
                               <div class="form-group"><input type="text" name="total_salary_month_2" id="total_salary_month_2" class="form-control" placeholder="" maxlength="<?php echo APLCT_SALARY_PER_MONTH_MAXLENGTH; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_salary[2]; ?>" data-parsley-errors-container="#custom-total_salary_month_2-parsley-error">
                                <span id="custom-total_salary_month_2-parsley-error"></span>
                               </div>
                            </td>
                            <td>
                               <div class="form-group"><input readonly="" type="text" name="from_year_2" id="from_year_2" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_FROM_YEAR_MAXLENGTH; ?>" data-parsley-trigger="change"  value="<?php echo $applicant_prof_exp_from_date[2]; ?>" data-parsley-errors-container="#custom-from_year_2-parsley-error">
                                <span id="custom-from_year_2-parsley-error"></span>
                               </div>
                            </td>
                            <td>
                               <div class="form-group"><input readonly="" type="text" name="to_year_2" id="to_year_2" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_TO_YEAR_MAXLENGTH; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_to_date[2]; ?>" data-parsley-errors-container="#custom-to_year_2-parsley-error">
                                <span id="custom-to_year_2-parsley-error"></span>
                               </div>
                            </td>
                            <td>
                               <div class="form-group"><input type="text" name="work_experience_2" id="work_experience_2" class="form-control" placeholder="" readonly="readonly" maxlength="<?php echo APLCT_TOT_WORK_EXP_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_work_exp_in_months[2]; ?>"></div>
                            </td>
                         </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" id="emp_total_exp" style="display: none;">
              <div class="col-md-3 blank_space">
                 <div class="form-group"></div>
              </div>
              <div class="col-md-3 blank_space">
                 <div class="form-group"></div>
              </div>
              <div class="col-md-3 blank_space">
                 <div class="form-group"></div>
              </div>
              <div class="col-md-3" style="display: block;">
                 <div class="form-group">
                    <label class=" control-label" for="radios">Total Work Experience in Months</label>
                    <input type="text" name="total_work_experience" id="total_work_experience" class="form-control" placeholder="Total Work Experience" readonly="readonly" maxlength="<?php echo APLCT_TOT_WORK_EXP_MAXLENGTH; ?>" value="<?php echo $total_work_exp; ?>">
                 </div>
              </div>
            </div>
        </div>
    </fieldset>
    <h3 class="wizard_head_tag">Payment Details</h3>
    <fieldset>
      <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
        <div class="card ">
          <div class="card-header p-0 " role="tab" id="headingOne">
            <h6 class="p-2 ml-3">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed instruction_accordion">

                <i class="fas fa-info-circle"></i>
                Instructions</a>
            </h6>
          </div><!-- card-header -->

          <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
            <div class="card-body" style="font-size: 13px;"><?php echo $applicant_payment_wizard_instructions;?></div>
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
              <p class="card-subtitle">Phone Number : <?php echo $applicant_mob_country_code_name."-".$mobile_no; ?></p>
            </div>
          </div><!-- card -->
          <div class="card base_details_card">
            <div class="card-body">
              <h5 class="card-title card_title">Order Details</h5>
              <p class="card-subtitle">Application Fee <span style="float: right;"><?php echo $appln_form_fee; ?></span>
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
                                            <input type="radio" id="online" name="payment_mode" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PAYMENT_MODE_MSG;?>" data-parsley-errors-container="#custom-payment_mode-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($payment_mode_id == PAYMENT_MODE_ONLINE_ID)?'checked':''; ?>>
                                            <label class="custom-control-label" for="online">Online</label>
                                          </div>
                	</div>
                	<div class="col-lg-2">
                		<!-- <label class="rdiobox">
                			<input name="rdio" type="radio" id="dd">
                			<span>DD</span>
                		</label> -->
                    <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="dd" name="payment_mode" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PAYMENT_MODE_MSG;?>" data-parsley-errors-container="#custom-payment_mode-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($payment_mode_id == PAYMENT_MODE_DEMAND_DRAFT_ID)?'checked':''; ?>>
                            <label class="custom-control-label" for="dd">DD</label>
                          </div>
                	</div>
            </div>
            <p><span id="custom-payment_mode-parsley-error"></span></p>
              <p class="card-subtitle mb-3">Sub Total <span style="float: right;"><?php echo $appln_form_fee; ?></span>
              </p>
              <p class="card-subtitle">Total<span style="float: right;"><?php echo $appln_form_fee; ?></span>
              </p>
              <div id="payment_details" style="display: none;">
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-control select2" name="BankName" id="BankName" title="Choose Bank Name" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHOOSE_BANK_MSG;?>" data-parsley-errors-container="#custom-BankName-parsley-error">
                                  <option value=""  selected="selected">Select Bank Name</option>
                                </select>
                                <span id="custom-BankName-parsley-error"></span>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="BranchName" placeholder="Branch Name" id="BranchName" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BANK_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo VALID_BANK_NAME_MSG;?>" maxlength="<?php echo APLCT_BRANCH_NAME_MAXLENGTH; ?>" value="<?php echo $branch_name; ?>">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="DDNumber" id="DDNumber" placeholder="DD Number" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DD_NO_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_DD_NO_MSG;?>"  maxlength="<?php echo APLCT_DD_NO_MAXLENGTH; ?>" value="<?php echo $dd_cheque_no; ?>">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="DDDate" id="DDDate" placeholder="DD Date" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DD_DATE_MSG;?>" value="<?php echo $dd_cheque_date; ?>" autocomplete="off">
                            </div>

                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12 customIcon">
                            <div class="flexbox flex-start"><?php echo DD_INFAVOUR; ?></div>
                        </div>
                    </div>
              </div>
              <!-- <a href="#" class="btn btn-primary active w-100 mt-3" role="button"
                aria-pressed="true">MAKE PAYMENT</a> -->
            </div>
          </div><!-- card -->
        </div>
      </div>
      <div class="row  w-100">
      </div>
    </fieldset>
    
   
    <h3 class="wizard_head_tag">Upload</h3>
     <fieldset>
        <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
            <div class="card ">
                <div class="card-header p-0 " role="tab" id="headingOne">
                    <h6 class="p-2 ml-3">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed instruction_accordion">

                            <i class="fas fa-info-circle"></i>
                            Instructions</a>
                    </h6>
                </div><!-- card-header -->

                <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                    <div class="card-body" style="font-size: 13px;"><?php echo $applicant_upload_wizard_instructions;?></div>
                </div>
            </div>

            <!-- card -->
        </div>
        <div class="col-md-12">

       
            <div class="form-layout">
                <div class="row mg-b-25 mt-3">
                    <div class="row w-100">
                       
                       <?php
                       $file_allowed_type = FILE_ALLOWED_TYPE;
                       ?>
                       <!-- col-4 -->
                        <div class="form-group col-md-6 ">
                             <label for="exampleFormControlTextarea1">Upload Your Recent Passport Size Photograph <span class="tx-danger">*</span></label>
                             <input type="file" class="filestyle" name="photograph" id="photograph" data-parsley-required="<?php echo ((isset($docs[$document_id_photograph]))?'false':'true'); ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_PHOTO_MSG;?>" data-parsley-errors-container="#custom-photograph-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
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
                            <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Signature <span class="tx-danger">*</span></label>

                             <input type="file" class="filestyle" name="signature" id="signature" data-parsley-required="<?php echo ((isset($docs[$document_id_signature]))?'false':'true'); ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_SIGN_MSG;?>" data-parsley-errors-container="#custom-signature-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>"  accept="<?php  echo allow_extension($file_allowed_type); ?>">
                             <?php if(isset($docs[$document_id_signature])){ ?>
                                <!-- <span class='file_name  mt-3' ><a class="image-popup-vertical-fit" href="<?php echo base_url().$docs[$document_id_signature]['file_path'];?>" target="_blank" title="<?php echo $docs[$document_id_signature]['file_name_user']; ?>"><?php echo $docs[$document_id_signature]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                <a href="javascript:void(0)" data-del-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>" data-doc-id="<?php echo $document_id_signature; ?>" data-toggle="modal" data-target="#contentDeletePop" data-field="signature" data-required="true" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                                <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_signature; ?>">
                                   <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_signature; ?>')">&times;</a>
                                   <strong id="deleteMessageStatus_<?php echo $document_id_signature; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_signature; ?>"></span>
                               </div>
                             <?php } ?>
                             <span id="custom-signature-parsley-error"></span>
                        </div>
                    </div>
                    <?php
                    /*
                    ?>
                    <div class="row w-100">
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlTextarea1">Upload Your 10th Marksheet </label>

                            <input type="file" class="filestyle" name="tenth_marksheet" id="tenth_marksheet" data-parsley-required="true" data-parsley-required-message="Please upload 10th marksheet" data-parsley-errors-container="#custom-tenth_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_tenth_marksheet])){ echo $docs[$document_id_tenth_marksheet]['id']; } ?>">
                             <?php if(isset($docs[$document_id_tenth_marksheet])){ ?>
                                <span class='file_name  mt-3' ><a href="<?php echo base_url().$docs[$document_id_tenth_marksheet]['file_path'].$docs[$document_id_tenth_marksheet]['file_name'];?>" target="_blank" title="<?php echo $docs[$document_id_tenth_marksheet]['file_name_user']; ?>"><?php echo $docs[$document_id_tenth_marksheet]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                             <?php } ?>
                             <span id="custom-tenth_marksheet-parsley-error"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlTextarea1">Upload Your 12th Marksheet </label>

                            <input type="file" class="filestyle" name="twelvfth_marksheet" id="twelvfth_marksheet" data-parsley-required="true" data-parsley-required-message="Please upload 12th marksheet" data-parsley-errors-container="#custom-twelvfth_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_twelvfth_marksheet])){ echo $docs[$document_id_twelvfth_marksheet]['id']; } ?>">
                             <?php if(isset($docs[$document_id_twelvfth_marksheet])){ ?>
                                <span class='file_name  mt-3' ><a href="<?php echo base_url().$docs[$document_id_twelvfth_marksheet]['file_path'].$docs[$document_id_twelvfth_marksheet]['file_name'];?>" target="_blank" title="<?php echo $docs[$document_id_twelvfth_marksheet]['file_name_user']; ?>"><?php echo $docs[$document_id_twelvfth_marksheet]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                             <?php } ?>
                             <span id="custom-twelvfth_marksheet-parsley-error"></span>
                        </div>
                    </div>
                    <?php
                    */
                    ?>
                    <div class="row w-100">
                        <?php
                        /*
                        ?>
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Aadhar card</label>

                             <input type="file" class="filestyle" name="aadhar_card" id="aadhar_card" data-parsley-required="false" data-parsley-validate-if-empty="true"data-parsley-required-message="Please upload your aadhar card" data-parsley-errors-container="#custom-aadhar_card-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_500_KB; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_aadhar_card])){ echo $docs[$document_id_aadhar_card]['id']; } ?>">
                             <?php if(isset($docs[$document_id_aadhar_card])){ ?>
                                <span class='file_name  mt-3' ><a href="<?php echo base_url().$docs[$document_id_aadhar_card]['file_path'];?>" target="_blank" title="<?php echo $docs[$document_id_aadhar_card]['file_name_user']; ?>"><?php echo $docs[$document_id_aadhar_card]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                <a href="javascript:void(0)" data-del-file-id="<?php if(isset($docs[$document_id_aadhar_card])){ echo $docs[$document_id_aadhar_card]['id']; } ?>" data-doc-id="<?php echo $document_id_aadhar_card; ?>" data-toggle="modal" data-target="#contentDeletePop" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                   <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_aadhar_card; ?>">
                                      <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_aadhar_card; ?>')">&times;</a>
                                      <strong id="deleteMessageStatus_<?php echo $document_id_aadhar_card; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_aadhar_card; ?>"></span>
                                  </div>
                             <?php } ?>
                             <span id="custom-aadhar_card-parsley-error"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlTextarea1">Additional Qualification, if any</label>

                             <input type="file" class="filestyle" name="additional_qualification" id="additional_qualification" data-parsley-required="false" data-parsley-validate-if-empty="true" data-parsley-required-message="Please upload additional qualification" data-parsley-errors-container="#custom-additional_qualification-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_500_KB; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_additional_qualification])){ echo $docs[$document_id_additional_qualification]['id']; } ?>">
                             <?php if(isset($docs[$document_id_additional_qualification])){ ?>
                                <span class='file_name  mt-3' ><a href="<?php echo base_url().$docs[$document_id_additional_qualification]['file_path'];?>" target="_blank" title="<?php echo $docs[$document_id_additional_qualification]['file_name_user']; ?>"><?php echo $docs[$document_id_additional_qualification]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                <a href="javascript:void(0)" data-del-file-id="<?php if(isset($docs[$document_id_additional_qualification])){ echo $docs[$document_id_additional_qualification]['id']; } ?>" data-doc-id="<?php echo $document_id_additional_qualification; ?>" data-toggle="modal" data-target="#contentDeletePop" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                   <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_additional_qualification; ?>">
                                      <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_additional_qualification; ?>')">&times;</a>
                                      <strong id="deleteMessageStatus_<?php echo $document_id_additional_qualification; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_additional_qualification; ?>"></span>
                                  </div>
                             <?php } ?>
                             <span id="custom-additional_qualification-parsley-error"></span>
                        </div>
                        <?php
                        */
                        ?>
                        <div class="form-group col-md-6" id="graduation_exam_marksheet_div" style="display:none">
                            <label for="exampleFormControlTextarea1">Upload Your Graduation Marksheet</label>

                             <input type="file" class="filestyle" name="graduation_marksheet" id="graduation_marksheet" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_UPLOAD_GRAD_MARK_MSG;?>" data-parsley-errors-container="#custom-graduation_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_500_KB; ?>"data-max-file-size-js="<?php echo MAX_FILE_SIZE_500_KB_JS; ?>"  data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_graduation_marksheet])){ echo $docs[$document_id_graduation_marksheet]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                             <?php if(isset($docs[$document_id_graduation_marksheet])){ ?>
                                <!-- <span class='file_name  mt-3' ><a class="image-popup-vertical-fit" href="<?php echo base_url().$docs[$document_id_graduation_marksheet]['file_path'];?>" target="_blank" title="<?php echo $docs[$document_id_graduation_marksheet]['file_name_user']; ?>"><?php echo $docs[$document_id_graduation_marksheet]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                <a href="javascript:void(0)" data-del-file-id="<?php if(isset($docs[$document_id_graduation_marksheet])){ echo $docs[$document_id_graduation_marksheet]['id']; } ?>" data-doc-id="<?php echo $document_id_graduation_marksheet; ?>" data-toggle="modal" data-target="#contentDeletePop" data-field="graduation_marksheet" data-required="false" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                                   <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_graduation_marksheet; ?>">
                                      <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_graduation_marksheet; ?>')">&times;</a>
                                      <strong id="deleteMessageStatus_<?php echo $document_id_graduation_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_graduation_marksheet; ?>"></span>
                                  </div>
                             <?php } ?>
                             <span id="custom-graduation_marksheet-parsley-error"></span>
                        </div>
                        <div class="form-group col-md-6" id="competitive_exam_marksheet_div" style="display:none">
                            <label for="exampleFormControlTextarea1">Upload Your Competitive Exam marksheet</label>
                             <input type="file" class="filestyle" name="competitive_exam_marksheet" id="competitive_exam_marksheet" data-parsley-required="false"  data-parsley-required-message="<?php echo REQD_UPLOAD_COMP_EXAM_MSG; ?>" data-parsley-errors-container="#custom-competitive_exam_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_500_KB; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_500_KB_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_competitive_exam_marksheet])){ echo $docs[$document_id_competitive_exam_marksheet]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                             <?php if(isset($docs[$document_id_competitive_exam_marksheet])){ ?>
                                <!-- <span class='file_name  mt-3' ><a class="image-popup-vertical-fit" href="<?php echo base_url().$docs[$document_id_competitive_exam_marksheet]['file_path'];?>" target="_blank" title="<?php echo $docs[$document_id_competitive_exam_marksheet]['file_name_user']; ?>"><?php echo $docs[$document_id_competitive_exam_marksheet]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                <a href="javascript:void(0)" data-del-file-id="<?php if(isset($docs[$document_id_competitive_exam_marksheet])){ echo $docs[$document_id_competitive_exam_marksheet]['id']; } ?>" data-doc-id="<?php echo $document_id_competitive_exam_marksheet; ?>" data-toggle="modal" data-target="#contentDeletePop" data-field="competitive_exam_marksheet" data-required="false" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                                   <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_competitive_exam_marksheet; ?>">
                                      <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_competitive_exam_marksheet; ?>')">&times;</a>
                                      <strong id="deleteMessageStatus_<?php echo $document_id_competitive_exam_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_competitive_exam_marksheet; ?>"></span>
                                  </div>
                             <?php } ?>
                             <span id="custom-competitive_exam_marksheet-parsley-error"></span>
                        </div>
                        
                    </div>
                </div><!-- row -->
            </div>
        </div>

     </fieldset>
   <h3 class="wizard_head_tag">Declaration</h3>
   <fieldset>
      <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
          <div class="card ">
              <div class="card-header p-0 " role="tab" id="headingOne">
                  <h6 class="p-2 ml-3">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed instruction_accordion">

                          <i class="fas fa-info-circle"></i>
                          Instructions</a>
                  </h6>
              </div><!-- card-header -->

              <div id="collapseOne7" class="collapse bg-light show" role="tabpanel" aria-labelledby="headingOne" style="">
                  <div class="card-body" style="font-size: 13px;"><?php echo $applicant_declaration_wizard_instructions;?></div>
              </div>
          </div>

          <!-- card -->
      </div>
      <div class="col-md-12">
          <div class="form-layout">
              <div class="row mg-b-25 mt-3">
                <p>This is to certify that the particulars given above are true, correct and complete to best of my knowledge and belief.</p>       
                <div class="row w-100">
                  <div class="col-md-6">
                    <label class="form-control-label">Applicant Name <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="applicant_name" id="applicant_name" placeholder="Applicant Name" maxlength="<?php echo APLCT_DECLR_NAME_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_APPLT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_DECLR_NAME_MINLENGTH; ?>, <?php echo APLCT_DECLR_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_name; ?>" data-parsley-trigger="change">
                  </div>
                  <div class="col-md-6">
                    <label class="form-control-label">Parent Name <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="parent_name" id="parent_name" placeholder="Parent Name" maxlength="100" data-parsley-required="false" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_PARENT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_DECLR_FATHER_NAME_MINLENGTH; ?>, <?php echo APLCT_DECLR_FATHER_NAME_MAXLENGTH; ?>]" value="<?php echo $parent_name; ?>" data-parsley-trigger="change">
                  </div>  
                </div>
                <div class="row w-100 mt-3">
                  <div class="col-md-6">
                    <label class="form-control-label">Date <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="declaration_date" id="declaration_date" value="<?php echo $declaration_date; ?>" readonly>
                  </div>
                </div>
                <!-- <div class="row w-100 mt-3">
                  <div class="col-md-6">
                    <a href="<?php echo base_url();?>mtech-preview">
                    <input type="button"  id="form_preview_btn" class="btn btn-primary" value="Form Preview"> </a>
                  </div>
                </div> -->
              </div><!-- row -->
          </div>
      </div>

   </fieldset>
    <?php form_close(); ?><!-- form -->