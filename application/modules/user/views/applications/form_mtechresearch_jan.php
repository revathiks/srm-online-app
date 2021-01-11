<?php 
//print_r($payment_details_list);
//print_r($applicant_parent_details_list);
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
$dob=$applicant_basic_details_list['dob'];
//$dob = date('m/d/Y',strtotime($dob));
$dob=isset($dob)? date('d/m/Y',strtotime($dob)):'';
$mobile_no=$applicant_basic_details_list['mob_no'];
$sec_mob_no=$applicant_basic_details_list['sec_mob_no'];
$sec_e_mail=$applicant_basic_details_list['sec_e_mail'];
$add_line_1=$applicant_address_details_list['add_line_1'];
$add_line_2=$applicant_address_details_list['add_line_2'];
$pin_code=$applicant_address_details_list['pin_code'];
$email_id = $applicant_basic_details_list['e_mail'];
$is_work_experience = $applicant_other_details_list['is_work_experience'];
$name_in_marksheet = $applicant_basic_details_list['name_in_marksheet'];
$digilocker_id = $applicant_basic_details_list['digilocker_id'];


$add_gardian = $applicant_other_details_list['add_gardian'];

//$total_work_exp = $applicant_other_details_list['total_work_exp'];
//print_r($applicant_coordinator_list);
$research_area = $applicant_coordinator_list['research_area'];
$coord_name = $applicant_coordinator_list['coord_name'];
$applicant_coord_det_id=$applicant_coordinator_list['applicant_coord_det_id'];

$applicant_publn_det_id = $applicant_publn_det_title = $applicant_publn_det_journal_conf_name = $applicant_publn_det_year = $applicant_prof_exp_id = $applicant_prof_exp_org_name = $applicant_prof_exp_designation = $applicant_prof_exp_job_nature = $applicant_prof_exp_salary = $applicant_prof_exp_from_date = $applicant_prof_exp_to_date = $applicant_prof_exp_work_exp_in_months = $applicant_grad_det_id = $applicant_grad_det_other_degree_name = $applicant_grad_det_univ_id = $applicant_grad_det_univ_name = $applicant_grad_det_mark_scheme_id = $applicant_grad_det_mark_percent = $applicant_grad_det_completion_year = $applicant_grad_det_reg_no = $applicant_grad_det_insti_name = array();

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
      $applicant_prof_exp_work_exp_in_months[] = $v['work_exp_month'];
      $applicant_prof_exp_work_exp[] = $v['wor_exp'];
   }
}


//print_r($applicant_graduations_list);


if($applicant_graduations_list) {
   foreach($applicant_graduations_list as $k=>$v) {
      $is_curr_qualify = $v['is_curr_qualify'];
      if($is_curr_qualify != 't') {
         $applicant_grad_det_id[] = $v['applicant_grad_det_id'];
         // $applicant_grad_det_other_degree_name[] = $v['other_degree_name'];
         $applicant_grad_det_other_degree_name[] = $v['other_deg_name'];
         $applicant_grad_det_univ_id[] = $v['univ_id'];                             
         $applicant_grad_det_univ_name[] = $v['univ_name'];
         $applicant_grad_det_mark_scheme_id[] = $v['mark_scheme_id'];
         $applicant_grad_det_mark_scheme[] = $v['mark_scheme_name'];
         //$applicant_grad_det_mark_percent[] = $v['mark_percent'];
         $applicant_grad_det_mark_percent[] = $v['mark_percentage'];
         //$applicant_grad_det_completion_year[] = $v['completion_year'];
         $applicant_grad_det_completion_year[] = $v['yr_of_pass']; 
         //$applicant_grad_det_insti_name[] = $v['insti_name'];
         $applicant_grad_det_insti_name[] = $v['insti_name'];
         $applicant_grad_det_reg_no[] = $v['reg_no']; 
         
           
      }
   }
}


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
      $applicant_course_course_id[] = $v['course_id'];
      $applicant_course_course_name[] = $v['course_name'];
      $applicant_course_choice_no[] = $v['choice_no'];
      $applicant_course_is_active[] = $v['is_active'];
      $applicant_course_spec_id[] = $v['splpref_id'];
      $applicant_course_spec_name[] = $v['spec_name'];
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
      $applicant_parent_occupation_other_name[$parent_type_id] = $v['other_occupation_name'];
   }
}

$parent_type_id_father = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
$father_name = $applicant_parent_parent_name[$parent_type_id_father];
$mother_name = $applicant_parent_parent_name[$parent_type_id_mother];
$guardian_name = $applicant_parent_parent_name[$parent_type_id_guardian];
//$parent_name = $applicant_basic_details_list['parent_name'];
$qualifyexamfromindia = $applicant_appln_details_list[0]['qualifyingexamfromindia'];
$is_agree = $applicant_appln_details_list[0]['is_agree'];

if($applicant_appln_details_list)
{
  foreach($applicant_appln_details_list as $k=>$v) {
      $appln_form_id = $v['appln_form_id'];
      if($app_form_id_mtech == $appln_form_id) {
        $applicant_appln_id = $v['applicant_appln_id'];
        $qualifyexamfromindia = $v['qualifyingexamfromindia'];
        // $is_qualify = $v['is_qualify'];
      }
   }
}


if($qualifyexamfromindia == 't') {
    $studied_from_india_id = 'yes';
    $studied_from_india_name = 'Yes';
} else {
    $studied_from_india_id = 'no';
    $studied_from_india_name = 'No';
}

$application_status_id =$applicant_appln_details_list[0]['application_status_id'];

$applicant_name = $applicant_appln_details_list[0]['applicant_name_declaration'];
$applicant_name = ($applicant_name)?$applicant_name:$first_name;

$parents_name = $applicant_appln_details_list[0]['applicant_parentname_declaration'];
$parent_name = (($parents_name)?$parents_name:(($father_name)?$father_name:(($mother_name)?$mother_name:(($guardian_name)?$guardian_name:''))));


$declaration_date = $applicant_appln_details_list[0]['applicant_declaration_date'];
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

$attributes = array('class' => 'form-horizontal form-wizard-wrapper .custom-validation', 'id' => 'mtechresearch_jan_form', 'name' => 'mtechresearch_jan_form', 'enctype' => 'multipart/form-data', 'data-parsley-validate data-toggle'=>"validator");

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
		<button class="btn btn-primary" type="button">Step <span id='show_currentindex'></span></button>
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
                        id="graduation_india" name="graduation_india" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_GRAD_STATUS_MSG; ?>" data-placeholder="Please Select Status Yes/No" data-parsley-errors-container="#custom-graduation_india-parsley-error" data-parsley-trigger="change">
                            <option value="">Select Status - Yes or No</option>
                        </select>
                  <span id="custom-graduation_india-parsley-error"></span>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group" id="confirm_indian" style="display: none;">
                <p>
                    Please note that you have selected 'YES' for the
                    above which implies you are eligible to seek
                    admission under domestic category. It is the
                    sole responsibility of the candidate to ensure
                    that he/she is applying under the right
                    category.</p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="qualifyingexamfromindia" id="qualifyingexamfromindia" value="<?php echo ($is_agree == 't')?1:0; ?>"  data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHECK_CONFIRM_MSG; ?>" <?php echo ($is_agree == 't')?'checked':0; ?>><label class="custom-control-label" for="qualifyingexamfromindia"> I Confirm </label>
                </div>
                <span id="custom-qualifyingexamfromindia-parsley-error"></span>
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
            <div class="card-body" style="font-size: 13px;"><?php echo $applicant_pref_per_wizard_instructions; ?></div>
            </div>
        </div>
      <!-- card -->
      </div>
      <div class="w-100">
        <h5 class="text-primary mb-3">Campus and Course Preference </h5>
          <div class="form-layout">
              <div class="row mg-b-25 mt-3">
                  <div class="col-lg-6">
                      <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Campus Preference 1
                              <span class="tx-danger">*</span></label>
                          <select class="form-control custom-select Course test_campus_pref"
                              id="campus_preference1" name="campus_preference1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_CAMPUS_PREFERENCE1_MSG; ?>" data-parsley-errors-container="#custom-campus_preference1-error" data-parsley-trigger="change" onchange="test_campus_pref_change('campus_preference1','specialization_preference1','speciali_prefer1_div','Choose Specialization Perferences 1')">
                              <option value="">Select Campus Preference 1</option>
                          </select>
                          <span id="custom-campus_preference1-error"></span>
                      </div>
                      <input type="hidden" name="campus_choice_no_1" id="campus_choice_no_1" value="<?php echo (isset($applicant_campus_choice_no[0]))?$applicant_campus_choice_no[0]:'1'; ?>" />
                      <input type="hidden" name="campus_prefer_id_1" id="campus_prefer_id_1" value="<?php echo (isset($applicant_campus_prefer_id[0]))?$applicant_campus_prefer_id[0]:''; ?>" />
                  </div><!-- col-4 -->
                  <div class="col-lg-6">
                      <div class="form-group mg-b-10-force" id="speciali_prefer1_div" style="display: none;">
                          <label class="form-control-label">Specialization Preference 1
                              <span class="tx-danger">*</span></label>
                          <select class="form-control custom-select Campus test_specialization_pref"
                              id="specialization_preference1" name="specialization_preference1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_SPL_PREFERENCE1_MSG; ?>" data-parsley-errors-container="#custom-specialization_preference1-error" data-parsley-trigger="change" onchange="test_specialization_pref_change('campus_preference1','specialization_preference1')">
                              <option value="">Select Specialization Preference 1</option>
                          </select>
                          <span id="custom-specialization_preference1-error"></span>
                      </div>
                      <input type="hidden" name="specialization_choice_no_1" id="specialization_choice_no_1" value="<?php echo (isset($applicant_course_choice_no[0]))?$applicant_course_choice_no[0]:'1'; ?>" />
                      <input type="hidden" name="specialization_prefer_id_1" id="specialization_prefer_id_1" value="<?php echo (isset($applicant_course_id[0]))?$applicant_course_id[0]:''; ?>" />
                  </div><!-- col-4 -->
                  <div class="col-lg-6">
                      <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Campus Preference 2</label>
                          <select class="form-control custom-select test_campus_pref"
                              id="campus_preference2" name="campus_preference2" onchange="test_campus_pref_change('campus_preference2','specialization_preference2','speciali_prefer2_div','Choose Specialization Perferences 2')">
                              <option value="">Select Campus Preference 2</option>                  
                          </select>
                          <span id="custom-campus_preference2-error"></span>
                      </div>
                      <input type="hidden" name="campus_choice_no_2" id="campus_choice_no_2" value="<?php echo (isset($applicant_campus_choice_no[1]))?$applicant_campus_choice_no[1]:'2'; ?>" />
                      <input type="hidden" name="campus_prefer_id_2" id="campus_prefer_id_2" value="<?php echo (isset($applicant_campus_prefer_id[1]))?$applicant_campus_prefer_id[1]:''; ?>" />
                  </div><!-- col-4 -->
                  <div class="col-lg-6">
                      <div class="form-group mg-b-10-force" id="speciali_prefer2_div" style="display: none;">
                          <label class="form-control-label">Specialization Preference 2</label>
                          <select class="form-control custom-select test_specialization_pref"
                              id="specialization_preference2" name="specialization_preference2"onchange="test_specialization_pref_change('campus_preference2','specialization_preference2')">
                              <option value="">Select Specialization Preference 2</option> 
                          </select>
                      </div>
                      <input type="hidden" name="specialization_choice_no_2" id="specialization_choice_no_2" value="<?php echo (isset($applicant_course_choice_no[1]))?$applicant_course_choice_no[1]:'2'; ?>" />
                      <input type="hidden" name="specialization_prefer_id_2" id="specialization_prefer_id_2" value="<?php echo (isset($applicant_course_id[1]))?$applicant_course_id[1]:''; ?>" />
                  </div><!-- col-4 -->
                  <div class="col-lg-6">
                      <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Campus Preference 3</label>
                          <select class="form-control custom-select test_campus_pref"
                              id="campus_preference3" name="campus_preference3" oncahnge="test_campus_pref_change('campus_preference3','specialization_preference3','speciali_prefer3_div','Choose Specialization Perferences 3')">
                              <option value="">Select Campus Preference 3</option>                  
                          </select>
                      </div>
                      <input type="hidden" name="campus_choice_no_3" id="campus_choice_no_3" value="<?php echo (isset($applicant_campus_choice_no[2]))?$applicant_campus_choice_no[2]:'3'; ?>" />
                      <input type="hidden" name="campus_prefer_id_3" id="campus_prefer_id_3" value="<?php echo (isset($applicant_campus_prefer_id[2]))?$applicant_campus_prefer_id[2]:''; ?>" />
                  </div><!-- col-4 -->
                  <div class="col-lg-6">
                      <div class="form-group mg-b-10-force" id="speciali_prefer3_div" style="display: none;">
                          <label class="form-control-label">Specialization Preference 3</label>
                          <select class="form-control custom-select test_specialization_pref"
                              id="specialization_preference3" name="specialization_preference3" onchange="test_specialization_pref_change('campus_preference3','specialization_preference3')">
                              <option value="">Select Specialization Preference 1</option>
                          </select>
                      </div>
                      <input type="hidden" name="specialization_choice_no_3" id="specialization_choice_no_3" value="<?php echo (isset($applicant_course_choice_no[2]))?$applicant_course_choice_no[2]:'3'; ?>" />
                      <input type="hidden" name="specialization_prefer_id_3" id="specialization_prefer_id_3" value="<?php echo (isset($applicant_course_id[2]))?$applicant_course_id[2]:''; ?>" />
                  </div><!-- col-4 -->
              </div><!-- row -->
          </div><!-- form-layout -->
      </div>

    
        <!-- <h5 class="text-primary mt-4 mb-3">Test City Perferences</h5>
         <div class="row mg-b-25">
              <div class="col-lg-6">
                  <div class="form-group mg-b-10-force">
                      <label class="form-control-label">Test State Perferences
                          1<span class="tx-danger">*</span></label>
                      <select class="form-control custom-select"
                          id="exampleFormControlSelect1">
                          <option value="">Select</option>
                          
                      </select>
                  </div>
              </div>
             <div class="col-lg-6">
                  <div class="form-group mg-b-10-force">
                      <label class="form-control-label">Test City Perferences
                          1<span class="tx-danger">*</span></label>
                      <select class="form-control custom-select"
                          id="exampleFormControlSelect1">
                          <option value="">Select</option>
                      </select>
                  </div>
              </div> 
              <div class="col-lg-6">
                  <div class="form-group mg-b-10-force">
                      <label class="form-control-label">Test State Perferences
                          2</label>
                      <select class="form-control custom-select"
                          id="exampleFormControlSelect1">
                          <option value="">Select</option>
                      </select>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group mg-b-10-force">
                      <label class="form-control-label">Test City Perferences
                          2</label>
                      <select class="form-control custom-select"
                          id="exampleFormControlSelect1">
                          <option value="">Select</option>
                      </select>
                  </div>
              </div>
        </div> --><!-- row -->

    <h5 class="text-primary mt-4 mb-3">Personal Details</h5>
      <div class="row mg-b-25">
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Title<span class="tx-danger">*</span></label>
                  <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="title_id" id="title_id" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG; ?>" data-parsley-errors-container="#custom-title-id-parsley-error">
                      <option label="Choose Title" value="">Choose Title</option>
                  </select>
                  <span id="custom-title-id-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group">
                  <label class="form-control-label">FirstName <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Enter FirstName" maxlength="<?php echo APLCT_FIRST_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_FIRST_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_FIRST_NAME_MINLENGTH; ?>, <?php echo APLCT_FIRST_NAME_MAXLENGTH; ?>]" value="<?php echo $first_name;?>">
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group">
                  <label class="form-control-label">Middle Name </label>
                  <input class="form-control" type="text" name="middle_name" id="middle_name" placeholder="Enter MiddleName" value="<?php echo $middle_name;?>" data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_MIDDLE_NAME_MSG; ?>" data-parsley-errors-container="#custom-middle_name-parsley-error">
                  <span id="custom-middle_name-parsley-error"></span>
              </div>

          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group">
                  <label class="form-control-label">LastName <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Enter LastName" maxlength="<?php echo APLCT_LAST_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_LAST_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_LAST_NAME_MINLENGTH; ?>, <?php echo APLCT_LAST_NAME_MAXLENGTH; ?>]" value="<?php echo $last_name;?>">
              </div>
          </div><!-- col-4 -->
          <div class="col-md-4">
              <label class="form-control-label">Mobile No <span class="tx-danger">*</span></label>
              <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                  <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                      <select class="form-control form_control custom-select Mobile_number" id="phone_no_code" name="phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                          <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>
                      </select>
                  </span>
                  <input id="mtech_mobile_no" type="text"  data-placeholder="Enter Mobile No" name="mtech_mobile_no"
                      class="form-control" maxlength="<?php echo APLCT_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" 
                      pattern="[0-9]*" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOBILE_MSG; ?>" data-parsley-mobileonly="true"data-parsley-errors-container="#custom-mtech_mobile_no-parsley-error" value="<?php echo $mobile_no;?>">                      
              </div>
              <span id="custom-mtech_mobile_no-parsley-error"></span>
          </div>
          <div class="col-lg-4">
              <div class="form-group">
                  <label class="form-control-label">Email ID <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="email_id" id="email_id" value="<?php echo $email_id;?>" placeholder="Enter email address" maxlength="<?php echo APLCT_EMAIL_MAXLENGTH; ?>" readonly="readonly">
              </div>
          </div>
          <div class="col-lg-4">
              <div class="wd-200 w-100">
                  <label class="form-control-label">Date of Birth <span class="tx-danger">*</span></label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                      <input  type="text" class="form-control hasDatepicker" placeholder="DD/MM/YYYY" name="dob" id="dob" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DOB_MSG; ?>" data-parsley-errors-container="#custom-dob-parsley-error" value="<?php echo $dob;?>">                      
                  </div>
                  <span id="custom-dob-parsley-error"></span>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Gender <span class="tx-danger">*</span></label>
                  <select class="form-control select2" data-placeholder="Choose Gender" tabindex="-1" aria-hidden="true" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_GENDER_MSG; ?>" data-parsley-errors-container="#custom-gender_id-parsley-error" name="gender_id" id="gender_id">
                      <option label="Choose Gender"></option>                     
                  </select>
                   <span id="custom-gender_id-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group">
                  <label class="form-control-label">Alternate Email ID</label>
                  <input class="form-control" type="text" name="second_email_id" id="second_email_id" placeholder="Enter email address" value="<?php echo $sec_e_mail;?>"  data-parsley-type="email" data-parsley-type-message="<?php echo VALID_ALT_EMAIL_MSG; ?>" data-parsley-notequalto="#email_id" data-parsley-notequalto-message="<?php echo EMAIL_MATCH; ?>" maxlength="<?php echo APLCT_ALT_EMAIL_MAXLENGTH; ?>">
                  <span id="suggestion_alt_email"></span>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Blood Group</label>
                  <select class="form-control select2" data-placeholder="Choose Blood Group" tabindex="-1" aria-hidden="true"  name="blood_grp_id" id="blood_grp_id">
                      <option label="Choose Blood Group"></option>
                  </select>
              </div>
          </div>
        <!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Religion <span class="tx-danger">*</span></label>
                  <select class="form-control select2" data-placeholder="Choose Religion" tabindex="-1" aria-hidden="true" name="religion_id" id="religion_id" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_RELIGION_MSG; ?>" data-parsley-errors-container="#custom-religion_id-parsley-error">
                      <option label="Choose Religion"></option>                      
                  </select>
                  <span id="custom-religion_id-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Mother Tongue</label>
                  <select class="form-control select2" data-placeholder="Choose Mother Tongue" tabindex="-1" aria-hidden="true" name="mothertongue_id" id="mothertongue_id">
                      <option label="Choose Mother Tongue"></option>
                  </select>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Medium of Instruction <span class="tx-danger">*</span></label>
                  <select class="form-control select2" data-placeholder="Choose Medium of Instruction" tabindex="-1" aria-hidden="true" name="medofinst" id="medofinst" title="Choose Medium of Instruction" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MEDIUM_INSTR_MSG; ?>" data-parsley-errors-container="#custom-medium_of_instruction-parsley-error" data-parsley-trigger="change">
                      <option value="">Choose Medium of Instruction</option>
                  </select>
                 <span id="custom-medium_of_instruction-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Hostel Accommodation</label>
                  <select class="form-control select2" data-placeholder="Choose Hostel Accommodation" tabindex="-1" aria-hidden="true" name="prefer_hostel" id="prefer_hostel" title="Choose Hostel Accommodation">
                      <option value="">Choose Hostel Accommodation</option>
                  </select>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Are you a differently Abled? <span class="tx-danger">*</span></label>
                  <select class="form-control select2" data-placeholder="Choose Differently Abled" tabindex="-1" aria-hidden="true" name="diff_abled" id="diff_abled" title="Choose Differently Abled" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DIFF_ABLED_MSG; ?>" data-parsley-errors-container="#custom-diff_abled-parsley-error" data-parsley-trigger="change">
                      <option value="">Choose Differently Abled</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                  </select>
                  <span id="custom-diff_abled-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Where do you see admission advertisment?</label>
                  <select class="form-control select2" data-placeholder="Choose Advertisement Source" tabindex="-1" aria-hidden="true" name="advertisement_source_id" id="advertisement_source_id" title="Choose Advertisement Source">
                      <option value="">Choose Advertisement Source</option>
                  </select>
              </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Nationality <span class="tx-danger">*</span></label>
                  <select class="form-control custom-select nationality" name="nationality_id" id="nationality_id" title="Choose Nationality"data-parsley-validate-if-empty="true" data-parsley-errors-container="#custom-nationality_id-parsley-error" data-parsley-btech-basic-check="studied_from_india,<?php echo COUNTRY_VALUE_DEFAULT; ?>,no,1" data-parsley-trigger="change" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_NATION_MSG; ?>">
                      <option value="">Choose Nationality</option>
                      <option value="Indian">Indian</option>
                      <option value="Afghan">Afghan</option>
                      <option value="Albanian">Albanian</option>
                      <option value="Argentinean">Argentinean</option>
                  </select>
              </div>
              <span id="custom-nationality_id-parsley-error"></span>
          </div><!-- col-4 -->
          <div class="col-lg-4" id="main_div_community" style="display:none">
              <div class="form-group mg-b-10-force" id="Community">
                  <label class="form-control-label">Community <span class="tx-danger">*</span></label>
                  <select class="form-control select2" data-placeholder="Choose Community" tabindex="-1" aria-hidden="true" name="pd_social_status" id="pd_social_status" title="Choose Community" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_COMMUNITY_MSG; ?>" data-parsley-errors-container="#custom-pd_social_status-parsley-error" data-parsley-trigger="change">
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
                    <div class="card-body" style="font-size: 13px;"><?php echo $applicant_parent_address_wizard_instructions; ?></div>
                </div>
            </div>

            <!-- card -->
        </div>
       
            <h5 class="text-primary mb-3">Father's Details</h5>
          
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Title
                              <span class="tx-danger">*</span>
                            </label>
                            <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_father_title" id="pd_father_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG; ?>" data-parsley-errors-container="#custom-pd_father_title-parsley-error" data-parsley-trigger="change">
                              <option value="">Choose Title</option>
                            </select>
                            <span id="custom-pd_father_title-parsley-error"></span>
                            <input type="hidden" name="pd_father_id" id="pd_father_id" value="<?php echo $app_parent_det_id[$parent_type_id_father]; ?>" />
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Father's Name 
                              <span class="tx-danger">*</span>
                            </label>
                            <input class="form-control" type="text" name="pd_father_name" id="pd_father_name" placeholder="Enter Your Father Name" maxlength="<?php echo APLCT_FATHER_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_FATHER_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_FATHER_NAME_MINLENGTH; ?>, <?php echo APLCT_FATHER_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_father]; ?>">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4" id="father_mbleno_div" style="display:none;">
                        <label class="form-control-label">Father's Mobile Number</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="pd_father_phone_no_code" name="pd_father_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                            <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>
                          </select>
                        </span>
                        <input type="text" class="form-control" name="pd_father_phone" id="pd_father_phone" maxlength="<?php echo APLCT_FATHER_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_FATHER_MOBILE_MSG; ?>" data-parsley-maxlength-message="<?php echo VALID_FATHER_MOBILE_MSG; ?>" data-parsley-errors-container="#custom-pd_father_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no[$parent_type_id_father]; ?>" data-parsley-notequalto="#pd_mother_phone" data-parsley-notequalto-message="<?php echo PHONE_MATCH_FATHER; ?>" data-parsley-mobileonly="true">
                      </div>
                      <span id="custom-pd_father_phone-parsley-error"></span>
                    </div>
                    <!-- <div class="col-lg-4" id="father_alt_mbleno_div" style="display:none;">
                      <label class="form-control-label">Father's Alternate Mobile Number</label>
                      <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="pd_father_alt_phone_no_code" name="pd_father_alt_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                            <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>
                          </select>
                        </span>
                        <input type="text" class="form-control" name="pd_father_alt_phone" id="pd_father_alt_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Alternate Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_father_alt_phone-parsley-error" value="<?php //echo $alt_phone_no; ?>">
                      </div>
                      <span id="custom-pd_father_alt_phone-parsley-error"></span>
                    </div> -->
                    <div class="col-lg-4" id="father_email_div" style="display:none;">
                      <div class="form-group">
                        <label class="form-control-label">Father's Email ID </label>
                        <input class="form-control" type="email" name="pd_father_email" id="pd_father_email"  placeholder="Enter Your Father's Email ID" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_FATHER_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_father_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_father]; ?>" maxlength="<?php echo APLCT_FATHER_EMAIL_MAXLENGTH; ?>" data-parsley-notequalto="#pd_mother_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_FATHER; ?>">
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
                          <label class="form-control-label">Title 
                            <span class="tx-danger">*</span>
                          </label>
                          <select class="form-control select2" name="pd_mother_title" id="pd_mother_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG; ?>" data-parsley-errors-container="#custom-pd_mother_title-parsley-error" data-parsley-trigger="change">
                            <option value="">Choose Title</option>
                          </select>
                          <span id="custom-pd_mother_title-parsley-error"></span>
                          <input type="hidden" name="pd_mother_id" id="pd_mother_id"  value="<?php echo $app_parent_det_id[$parent_type_id_mother]; ?>" />
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Mother's Name 
                            <span class="tx-danger">*</span>
                          </label>
                          <input type="text" class="form-control" name="pd_mother_name" id="pd_mother_name" placeholder="Enter Your Mother's Name" maxlength="<?php echo APLCT_MOTHER_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MOTHER_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_MOTHER_NAME_MINLENGTH; ?>, <?php echo APLCT_MOTHER_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_mother]; ?>">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4" id="mother_mbleno_div" style="display:none;">
                        <label class="form-control-label">Mother's Mobile Number</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="pd_mother_phone_no_code" name="pd_mother_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                            <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>
                          </select>
                        </span>
                        <input type="text" class="form-control" name="pd_mother_phone" id="pd_mother_phone" maxlength="<?php echo APLCT_MOTHER_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOTHER_MOBILE_MSG; ?>" data-parsley-maxlength-message="<?php echo VALID_MOTHER_MOBILE_MSG; ?>" data-parsley-errors-container="#custom-pd_mother_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no[$parent_type_id_mother]; ?>" data-parsley-notequalto="#pd_father_phone" data-parsley-notequalto-message="<?php echo PHONE_MATCH_MOTHER; ?>" data-parsley-mobileonly="true">
                        <span id="custom-pd_mother_phone-parsley-error"></span>
                        </div>
                    </div>
                    <!-- <div class="col-lg-4" id="mother_alt_mbleno_div" style="display:none;">
                        <label class="form-control-label">Mother's Alternative Mobile Number</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="pd_mother_alt_phone_no_code" name="pd_mother_alt_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                            <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>
                          </select>
                        </span>
                        <input type="text" class="form-control" name="pd_mother_alt_phone" id="pd_mother_alt_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_mother_alt_phone-parsley-error" value="<?php //echo $alt_phone_no; ?>">
                        <span id="custom-pd_mother_alt_phone-parsley-error"></span>
                        </div>
                    </div> -->
                    <div class="col-lg-4" id="mother_email_div" style="display:none;">
                        <div class="form-group">
                            <label class="form-control-label">Mother's Email ID </label>
                            <input class="form-control" type="email" name="pd_mother_email" id="pd_mother_email"  placeholder="Enter Your Mother's Email ID" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_MOTHER_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_mother_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_mother]; ?>" maxlength="<?php echo APLCT_MOTHER_EMAIL_MAXLENGTH; ?>" data-parsley-notequalto="#pd_father_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_MOTHER; ?>">
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
                          <label class="form-control-label">Guardian's Name <span class="tx-danger"> *</span></label>
                          <input class="form-control" type="text" name="pd_guardian_name" id="pd_guardian_name" placeholder="Enter Your Guardian Name" maxlength="<?php echo APLCT_GUARDIAN_NAME_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_GUARDIAN_NAME_MINLENGTH; ?>, <?php echo APLCT_GUARDIAN_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_guardian]; ?>">
                          <input type="hidden" name="pd_guardian_id" id="pd_guardian_id" value="<?php echo $app_parent_det_id[$parent_type_id_guardian]; ?>" />
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <label class="form-control-label">Guardian's Mobile No <span class="tx-danger"> *</span></label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                        <select class="form-control form_control custom-select Mobile_number" id="pd_guardian_phone_no_code" name="pd_guardian_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                          <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>
                        </select>
                        </span>
                        <input type="text" class="form-control" name="pd_guardian_phone" id="pd_guardian_phone" maxlength="<?php echo APLCT_GUARDIAN_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Guardian's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_GUARDIAN_MOBILE_MSG; ?>" data-parsley-maxlength-message="<?php echo VALID_GUARDIAN_MOBILE_MSG; ?>" data-parsley-errors-container="#custom-pd_guardian_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no[$parent_type_id_guardian]; ?>" data-parsley-mobileonly="true">                        
                      </div>
                      <span id="custom-pd_guardian_phone-parsley-error"></span>
                    </div>
                    <!-- <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Guardian's Email ID</label>
                            <input class="form-control" type="email" name="pd_guardian_email" id="pd_guardian_email"  placeholder="Enter Your Guardian's Email ID"data-parsley-required="false" data-parsley-required-message="Please Enter Email ID" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Email ID" data-parsley-errors-container="#custom-pd_guardian_email-parsley-error" value="<?php //echo $email_id; ?>" maxlength="100">
                            <span id="custom-pd_guardian_email-parsley-error"></span>
                        </div>
                    </div> -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Guardian's Occupation <span class="tx-danger"> *</span></label>
                            <select class="form-control select2" data-placeholder="Choose Guardian Occupation" tabindex="-1" aria-hidden="true" name="pd_guardian_occupation" id="pd_guardian_occupation" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_OCCUPATION_MSG; ?>" data-parsley-errors-container="#custom-pd_guardian_occupation-parsley-error">
                              <option value="">Select Guardian's Occupation</option>
                            </select>
                            <span id="custom-pd_guardian_occupation-parsley-error"></span>
                        </div>
                         <div id="guardian_other_occupation_div" style="display:none;" class="form-group">
                            <input class="form-control" type="text" name="guardian_other_occupation" id="guardian_other_occupation"  placeholder="If Other, please enter here..."data-parsley-required="false"   data-parsley-errors-container="#custom-guardian_other_occupation-parsley-error" value="<?php echo $applicant_parent_occupation_other_name[$parent_type_id_guardian];?>">
                            <span id="custom-guardian_other_occupation-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                </div><!-- row -->
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
                    <div class="col-lg-3" id="main_div_state" style="display: none;">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">State<span class="tx-danger"> *</span></label>
                            <select class="form-control select2" data-placeholder="Choose State" tabindex="-1" aria-hidden="true" name="state" id="state" title="Choose State" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_STATE_MSG; ?>" data-parsley-errors-container="#custom-state-parsley-error" data-parsley-trigger="change">
                              <option value="">Select State</option>
                            </select>
                            <span id="custom-state-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-3" id="main_div_district" style="display: none;">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">District<span class="tx-danger"> *</span></label>
                            <select class="form-control select2" data-placeholder="Choose District" tabindex="-1" aria-hidden="true" name="district" id="district" title="Choose District" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DISTRICT_MSG; ?>" data-parsley-errors-container="#custom-district-parsley-error" data-parsley-trigger="change">
                              <option value="">Select District</option>
                            </select>
                            <span id="custom-district-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-3" id="main_div_city" style="display: none;">
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
                            <input class="form-control" type="text" name="address_line1" id="address_line1" placeholder="Enter Address Line 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_ADDRESS_MSG; ?>"  data-parsley-maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH; ?>" maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH; ?>" value="<?php echo $add_line_1;?>">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Address Line 2 <!--<span class="tx-danger">*</span>--></label>
                            <input class="form-control" type="text" name="address_line2" id="address_line2" placeholder="Enter Address Line 2" data-parsley-maxlength="<?php echo APLCT_ADDRESS2_MAXLENGTH; ?>" maxlength="<?php echo APLCT_ADDRESS2_MAXLENGTH; ?>" value="<?php echo $add_line_2;?>">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Pincode <span class="tx-danger">*</span></label>
                            <!-- <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Pincode" data-parsley-required="true" data-parsley-required-message="Please Enter Pincode"  data-parsley-maxlength="10" maxlength="10" 
                            value="<?php echo $pin_code;?>"> -->
                            <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Pincode" data-parsley-required="true" data-parsley-required-message="<?php echo APLCT_PINCODE_MAXLENGTH; ?>" value="<?php if($pin_code) {echo $pin_code;} ?>" data-parsley-maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_PINCODE_MSG; ?>" maxlength="<?php echo APLCT_PINCODE_MAXLENGTH; ?>">
                        </div>
                    </div><!-- col-4 -->

                </div><!-- row -->
           

    </fieldset>

    <h3 class="wizard_head_tag">Academic Detail</h3>
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
                    <div class="card-body" style="font-size: 13px;"><?php echo $applicant_academic_wizard_instructions; ?></div>
                </div>
            </div>

            <!-- card -->
        </div>
        <h5 class="text-primary">Academic Details</h5>
        <div action="form-validation.html" id="selectForm" class="w-100">
            <div class="row"> 
                <div class="col-lg-6 ">
                  <p>Only the applicants who have completed Graduation are eligible to apply</p>  
                    <div class="form-group wd-xs-300 mr-5 w-100">
                        <label class="form-control-label">Candidate Name as in 10th
                            Certificate
                            <span class="tx-danger">*</span></label>
                        <div class="form-group mg-b-10-force">
                            <input class="form-control" type="text" name="name_as_in_marksheet"
                                placeholder="Enter Name" id="name_as_in_marksheet" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CANDIDATE_NAME_MSG; ?>" data-parsley-maxlength="<?php echo APLCT_CAND_NAME_MAXLENGTH; ?>" maxlength="<?php echo APLCT_CAND_NAME_MAXLENGTH; ?>" value="<?php echo $name_in_marksheet; ?>">
                            <small id="emailHelp"
                                class="form-text text-muted">Kindly type "NA" in
                                case 10th Certificate is not available with
                                you.</small>
                        </div>
                    </div><!-- form-group -->
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered mt-0" id="table4">
              <thead class="thead-light">
                  <tr>
                      <th></th>
                      <th> Institute <span class="tx-danger">*</span></th>
                      <th> University <span class="tx-danger">*</span></th>
                      <th> Mode of Study <span class="tx-danger">*</span></th>
                      <th> Marking Scheme <span class="tx-danger">*</span></th>
                      <th> Obtained Percentage/CGPA <span class="tx-danger">*</span></th>
                      <th> Year of Passing <span class="tx-danger">*</span></th>
                      <th> Roll No / Registration No <span class="tx-danger">*</span></th>

                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>
                          <p>UG</p>
                      </td>
                      <td>
                            <input class="form-control" type="hidden" placeholder="" id="grad_id_1" name="grad_id_1" value="<?php echo $applicant_grad_det_id[0]; ?>">
                            <div class="form-group">
                          <input class="form-control" type="text" name="institute_name" id="institute_name" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_INSTITUTE_NAME_MSG; ?>" data-parsley-maxlength="<?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>" maxlength="<?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>" data-parsley-errors-container="#custom-institute-name-parsley-error" value="<?php echo $applicant_grad_det_insti_name[0];?>">
                        </div>
                          <span id="custom-institute-name-parsley-error"></span>
                      </td>
                      <td>
                          <div class="form-group mg-b-10-force">
                              <select class="form-control custom-select" id="university_id" name="university_id" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_UNIVERSITY_MSG; ?>" data-parsley-errors-container="#custom-university-id-parsley-error" data-parsley-trigger="change">
                              </select>
                          </div>
                          <span id="custom-university-id-parsley-error"></span>
                      </td>
                      <td>
                          <div class="form-group mg-b-10-force">
                              <select class="form-control custom-select"
                                  id="mode_of_study" name="mode_of_study" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MODE_STUDY_MSG; ?>" data-parsley-errors-container="#custom-mode-study-parsley-error" data-parsley-trigger="change">
                                  <option value="">Select</option>
                              </select>
                          </div>
                          <span id="custom-mode-study-parsley-error"></span>
                      </td>
                      <td>
                          <div class="form-group mg-b-10-force" id="Appering_info_1">
                              <select class="form-control custom-select" id="user_marking_scheme_1" name="user_marking_scheme_1" data-parsley-required="true"  data-parsley-required-message="<?php echo REQD_MARK_SCHEME_MSG; ?>" data-parsley-errors-container="#custom-marking-schema-error" data-parsley-trigger="change"></select>
                          </div>
                          <span id="custom-marking-schema-error"></span>
                      </td>
                      <td>
                          <input class="form-control" type="text" placeholder="" id="obtained_percentage_cgpa_1" name="obtained_percentage_cgpa_1" maxlength="<?php echo APLCT_PERCENT_CGPA_MAXLENGTH; ?>" min="<?php echo APLCT_MARK_MINLENGTH; ?>" max="<?php echo APLCT_MARK_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-trigger="keyup" data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG; ?>" data-parsley-errors-container="#custom-obtained_percentage_cgpa_1-parsley-error" value="<?php echo $applicant_grad_det_mark_percent[0]; ?>" maxlength="<?php echo CGPA_MAXLENGTH; ?>">
                          <span id="custom-obtained_percentage_cgpa_1-parsley-error"></span>
                      </td>
                      <td>
                          <input class="form-control" type="text" placeholder="YYYY" id="year_of_passing_1" name="year_of_passing_1" maxlength="<?php echo APLCT_YEAR_OF_PASSING_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_YEAR_OF_PASSING_MSG; ?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-year_of_passing_1-parsley-error" value="<?php echo $applicant_grad_det_completion_year[0]; ?>"  readonly>
                          <span id="custom-year_of_passing_1-parsley-error"></span>
                      </td>
                      <td>
                          <input class="form-control" id="register_no" type="text" name="register_no" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_REG_NO_MSG; ?>" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" data-parsley-errors-container="#custom-register-no-error" data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_REG_NO_MSG; ?>" value="<?php echo $applicant_grad_det_reg_no[0]; ?>">
                          <span id="custom-register-no-error"></span>
                      </td>
                  </tr>
              </tbody>
            </table>
        </div>
        <div class="mt-3 w-100">
            <div class="row">

              <div class="col-md-6">
                  <div class="form-group">
                      <!-- <label class="control-label" for="radios" >Do you have any Work Experience? <span class="tx-danger">*</span></label>
                      <select class="form-control custom-select study" id="is_work_experience_yes" name="is_work_experience_yes" data-parsley-required="true" data-parsley-required-message="Please select the work experience" onchange="is_work_experience_func(this.value)" data-parsley-errors-container="#custom-taken_any_competitive_exam-parsley-error" data-parsley-trigger="change">
                          <option value="">Select Status - Yes or No</option>
                          <option value="yes" <?php if($is_work_experience == 't') { echo 'selected'; }?>>Yes</option>
                          <option value="no" <?php if($is_work_experience != 't') { echo 'selected'; }?>>No</option>
                      </select>
                      <span id="custom-taken_any_competitive_exam-parsley-error"></span> -->
                      <label class="form-control-label">Do you have any Work Experience ? <span class="tx-danger">*</span></label>
                      <select class="form-control custom-select study" id="is_work_experience" name="is_work_experience" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_WORK_EXP_MSG; ?>" data-parsley-errors-container="#custom-is_work_experience-parsley-error" data-parsley-trigger="change">
                          <option value="">Select Status - Yes or No</option>
                          <option value="yes">Yes</option>
                          <option value="no">No</option>
                      </select>
                      <span id="custom-is_work_experience-parsley-error"></span>
                      <div class="form-group" style="display: none;" id="taken_any_competitive_exam_info"><small>You have to write
                              SRM ENTRANCE to qualify.</small></div>

                  </div>
              </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label">NAD ID / Digilocker ID
                            <!-- <span class="tx-danger">*</span> --></label>
                        <!-- <input class="form-control" type="text" name="digilocker_id"
                            placeholder="Enter NAD ID / Digilocker ID " id="digilocker_id" value="<?php echo $digilocker_id; ?>"> -->
                          <input class="form-control" id="digilocker_id" type="text" name="digilocker_id" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_NADID_MSG; ?>" maxlength="<?php echo APLCT_NADID_MAXLENGTH; ?>" data-parsley-errors-container="#custom-digilocker_id-error" data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_NADID_MSG; ?>" value="<?php echo $applicant_grad_det_reg_no[0]; ?>">
                          <span id="custom-digilocker_id-error"></span>
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
            <div class="row" id="emp_exp" style="display: none;">
            <div class="col-md-12">
               <div class="form-group">
                  <label class="control-label" for="radios">Professional Experience (Start from the present employer)</label>
                  <div class="table-responsive pretbl">
                     <table class="table table-bordered mt-0" id="table5" style="display: table !important; ">
                        <thead class="thead-light">
                           <tr>
                               <th>&nbsp;</th>
                               <th>Organisation's Name <span class="tx-danger">*</span></th>
                               <th>Position Held <span class="tx-danger">*</span></th> 
                               <th>From Year <span class="tx-danger">*</span></th>
                               <th>To Year <span class="tx-danger">*</span></th>
                               <th>Total Experience <span class="tx-danger">*</span></th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td nowrap="">1.</td>
                              <td>
                                 <input class="form-control" type="hidden" placeholder="" id="prof_exp_id_0" name="prof_exp_id_0" value="<?php echo $applicant_prof_exp_id[0]; ?>">
                                 <div class="form-group"><input type="text" name="organisation_name_0" id="organisation_name_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_ORGANISATION_NAME_MAXLENGTH; ?>"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_ORG_NAME_MSG; ?>"  data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_org_name[0]; ?>" data-parsley-errors-container="#custom-organisation_name_0-parsley-error"></div>
                                 <span class="tx-danger required_asterisk">*</span>
                                 <span id="custom-organisation_name_0-parsley-error"></span>
                              </td>
                              <td>
                                 <div class="form-group"><input type="text" name="designation_0" id="designation_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_DESIGNATION_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_DESIGNATION_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_designation[0]; ?>" data-parsley-errors-container="#custom-designation_0-parsley-error"></div>
                                 <span class="tx-danger required_asterisk">*</span>
                                 <span id="custom-designation_0-parsley-error"></span>
                              </td>
                              <td>
                                 <div class="form-group"><input readonly="" type="text" name="from_year_0" id="from_year_0" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_FROM_YEAR_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FROM_YEAR_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_from_date[0]; ?>" data-parsley-errors-container="#custom-from_year_0-parsley-error"></div>
                                 <span class="tx-danger required_asterisk">*</span>
                                 <span id="custom-from_year_0-parsley-error"></span>
                              </td>
                              <td>
                                 <div class="form-group"><input readonly="" type="text" name="to_year_0" id="to_year_0" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_TO_YEAR_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_TO_YEAR_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_to_date[0]; ?>" data-parsley-errors-container="#custom-to_year_0-parsley-error"></div>
                                 <span class="tx-danger required_asterisk">*</span>
                                 <span id="custom-to_year_0-parsley-error"></span>
                              </td>
                              <td>
                                 <div class="form-group"><input type="text" name="work_experience_0" id="work_experience_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_TOT_WORK_EXP_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_WORK_EXP_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_work_exp[0]; ?>" data-parsley-errors-container="#custom-work_experience_0-parsley-error" readonly></div>
                                 <span class="tx-danger required_asterisk">*</span>
                                 <span id="custom-work_experience_0-parsley-error"></span>
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
                                 <div class="form-group"><input readonly="" type="text" name="from_year_1" id="from_year_1" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_FROM_YEAR_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_from_date[1]; ?>"></div>
                              </td>
                              <td>
                                 <div class="form-group"><input readonly="" type="text" name="to_year_1" id="to_year_1" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_TO_YEAR_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_to_date[1]; ?>"></div>
                              </td>
                              <td>
                                 <div class="form-group"><input type="text" name="work_experience_1" id="work_experience_1" class="form-control" placeholder="" readonly="readonly" maxlength="<?php echo APLCT_TOT_WORK_EXP_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_work_exp[1]; ?>"></div>
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
                                 <div class="form-group"><input readonly="" type="text" name="from_year_2" id="from_year_2" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_FROM_YEAR_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_from_date[2]; ?>"></div>
                              </td>
                              <td>
                                 <div class="form-group"><input readonly="" type="text" name="to_year_2" id="to_year_2" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_TO_YEAR_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_to_date[2]; ?>"></div>
                              </td>
                              <td>
                                 <div class="form-group"><input type="text" name="work_experience_2" id="work_experience_2" class="form-control" placeholder="" readonly="readonly" maxlength="<?php echo APLCT_TOT_WORK_EXP_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_work_exp[2]; ?>"></div>
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
                  <input type="text" name="total_work_experience" id="total_work_experience" class="form-control" placeholder="Total Work Experience"  maxlength="<?php echo APLCT_TOT_WORK_EXP_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_work_exp_in_months[0]; ?>" readonly>
               </div>
            </div>
         </div>
        </div>
        <div class="mt-3 w-100">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <h5 class="text-primary mb-4"></h5>
                        <label class="form-control-label">Broad area of research
                          <span class="tx-danger">*</span></label>
                        <input type="text" name="board_research" id="board_research" class="form-control" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BOARD_AREA_MSG; ?>" maxlength="<?php echo APLCT_BOARD_AREA_MAXLENGTH; ?>" data-parsley-errors-container="#custom-board-area-error" value="<?php echo $research_area;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo VALID_ALPHA_ONLY_MSG; ?>">
                        <input type="hidden" name="coord_det_id" id="coord_det_id" value="<?php echo $applicant_coord_det_id; ?>">
						<span id="custom-board-area-error"></span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <h5 class="text-primary mb-4"></h5>
                        <label class="form-control-label">Name of proposed Supervisor (if identified)
                          <!-- <span class="tx-danger">*</span> --></label>
                        <input type="text" name="name_proposed" id="name_proposed" class="form-control" value="<?php echo $coord_name;?>" maxlength="<?php echo APLCT_PROPOSED_SUPERVISOR_MAXLENGTH; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo VALID_ALPHA_ONLY_MSG; ?>">
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
              <p class="card-subtitle mb-3">E-Mail : <?php echo $email_id;?> </p>
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
								<input class="form-control" type="text" name="BranchName" placeholder="Branch Name" id="BranchName" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BANK_NAME_MSG; ?>" maxlength="<?php echo APLCT_BRANCH_NAME_MAXLENGTH; ?>" value="<?php echo $branch_name; ?>" data-parsley-type-message="<?php echo VALID_BANK_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo VALID_BANK_NAME_MSG; ?>">
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
              <!--<a href="#" class="btn btn-primary active w-100 mt-3" role="button"
                aria-pressed="true">MAKE PAYMENT</a>-->
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
                             <input type="file" class="filestyle" name="photograph" id="photograph" data-parsley-required="<?php echo ((isset($docs[$document_id_photograph]))?'false':'true'); ?>" data-required="true" data-parsley-required-message="<?php echo REQD_UPLOAD_PHOTO_MSG; ?>" data-parsley-errors-container="#custom-photograph-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                             <?php if(isset($docs[$document_id_photograph])){ ?>
                                <!-- <span class='file_name  mt-3' ><a class="image-popup-vertical-fit" href="<?php echo base_url().$docs[$document_id_photograph]['file_path'];?>" target="_blank" title="<?php echo $docs[$document_id_photograph]['file_name_user']; ?>"><?php echo $docs[$document_id_photograph]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                <a href="javascript:void(0)" data-del-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>" data-doc-id="<?php echo $document_id_photograph; ?>" data-toggle="modal" data-target="#contentDeletePop" data-field="photograph" data-required="true" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>-->
                                <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_photograph; ?>">
                                   <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_photograph; ?>')">&times;</a>
                                   <strong id="deleteMessageStatus_<?php echo $document_id_photograph; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_photograph; ?>"></span>
                               </div>
                             <?php } ?>
                             <span id="custom-photograph-parsley-error"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Signature <span class="tx-danger">*</span></label>

                             <input type="file" class="filestyle" name="signature" id="signature" data-parsley-required="<?php echo ((isset($docs[$document_id_signature]))?'false':'true'); ?>" data-required="true" data-parsley-required-message="<?php echo REQD_UPLOAD_SIGN_MSG; ?>" data-parsley-errors-container="#custom-signature-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>"  data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>"   accept="<?php  echo allow_extension($file_allowed_type); ?>">
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
                    
                    <div class="row w-100">
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlTextarea1">Upload Your Graduation Marksheet</label>

                             <input type="file" class="filestyle" name="graduation_marksheet" id="graduation_marksheet" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_UPLOAD_GRAD_MARK_MSG; ?>" data-parsley-errors-container="#custom-graduation_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_500_KB; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_500_KB_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_graduation_marksheet])){ echo $docs[$document_id_graduation_marksheet]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                             <?php if(isset($docs[$document_id_graduation_marksheet])){ ?>
                                <!-- <span class='file_name  mt-3' ><a class="image-popup-vertical-fit" href="<?php echo base_url().$docs[$document_id_graduation_marksheet]['file_path'];?>" target="_blank" title="<?php echo $docs[$document_id_graduation_marksheet]['file_name_user']; ?>"><?php echo $docs[$document_id_graduation_marksheet]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                <a href="javascript:void(0)" data-del-file-id="<?php if(isset($docs[$document_id_graduation_marksheet])){ echo $docs[$document_id_graduation_marksheet]['id']; } ?>" data-doc-id="<?php echo $document_id_graduation_marksheet; ?>" data-toggle="modal" data-target="#contentDeletePop" data-field="graduation_marksheet" data-required="false" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>-->
                                   <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_graduation_marksheet; ?>">
                                      <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_graduation_marksheet; ?>')">&times;</a>
                                      <strong id="deleteMessageStatus_<?php echo $document_id_graduation_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_graduation_marksheet; ?>"></span>
                                  </div>
                             <?php } ?>
                             <span id="custom-graduation_marksheet-parsley-error"></span>
                        </div>
                        <?php
                        /*
                        ?>
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
                  <div class="card-body" style="font-size: 13px;">
                    <?php echo $applicant_declaration_wizard_instructions; ?></div>
              </div>
          </div>

          <!-- card -->
      </div>
      <div class="col-md-12">
          <div class="form-layout">
              <div class="row mg-b-25 mt-3">
                <p>This is to certify that the particulars given above are true, correct and complete to best of my knowledge and belief.</p>       
                  <div class="row w-100">                    
                     <div class="col-lg-6">
                       <label class="form-control-label">Applicant Name <span class="tx-danger">*</span></label>
                        <div class="form-group">
                           <input class="form-control" type="text" name="applicant_name" id="applicant_name" placeholder="Applicant Name" maxlength="<?php echo APLCT_DECLR_NAME_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_APPLT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_DECLR_NAME_MINLENGTH; ?>, <?php echo APLCT_DECLR_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_name; ?>" data-parsley-trigger="change">
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-md-6">
                        <label class="form-control-label">Parent Name <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="parent_name" id="parent_name" placeholder="Parent Name" maxlength="<?php echo APLCT_DECLR_FATHER_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_PARENT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_DECLR_FATHER_NAME_MINLENGTH; ?>, <?php echo APLCT_DECLR_FATHER_NAME_MAXLENGTH; ?>]" value="<?php echo $parent_name; ?>" data-parsley-trigger="change">
                      </div>  
                     <!-- col-4 -->
                  </div>
                  <div class="row w-100 mt-3">
                      <div class="col-md-6">
                        <label class="form-control-label">Date <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="date_dec" id="date_dec" value="<?php echo $declaration_date; ?>" readonly>
                      </div>
                    </div>
                  <div class="row w-100 mt-3">
                    <div class="col-md-12">
                      <!-- <a href="<?php echo base_url();?>mtechresearch-preview"><input type="button"  id="form_preview_btn" style="background-color: #626ed4;  border-radius: 4px;  padding: 6px 15px;  color: #fff;" value="Form Preview"></a> -->
                    </div>
                  </div>
              </div><!-- row -->
          </div>
      </div>
   </fieldset>
    <?php form_close(); ?><!-- form -->