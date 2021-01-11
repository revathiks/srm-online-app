<?php 
//print_r($personal_detail_list);
$first_name = $personal_detail_list['data']['first_name'];
$last_name = $personal_detail_list['data']['last_name'];
$email_id = $personal_detail_list['data']['email_id'];
$user_id = $personal_detail_list['data']['user_id'];
$mobile_no = $personal_detail_list['data']['mobile_no'];
/*  echo "<pre>";
print_r($applicant_appln_details_list);
echo "</pre>";  */

$app_form_id_btech = APP_FORM_ID_BTECH;
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

$form_wizard_basic_id = FORM_WIZARD_BASIC_ID;
$form_wizard_preference_personal_id = FORM_WIZARD_PREFERENCE_PERSONAL_ID;
$form_wizard_parent_address_id = FORM_WIZARD_PARENT_ADDRESS_ID; 
$form_wizard_academic_id = FORM_WIZARD_ACADEMIC_ID;
$form_wizard_payment_id = FORM_WIZARD_PAYMENT_ID;
$form_wizard_declaration_id = FORM_WIZARD_DECLARATION_ID;
$form_wizard_upload_id = FORM_WIZARD_UPLOAD_ID;
$form_wizard_upload_declaration_id = FORM_WIZARD_UPLOAD_DECLARATION_ID;

$docs=array();
$file_count = 0;
if($upload_filelist) {
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

$nationality_id = $applicant_basic_details_list['nation_id'];
$nationality_name = $applicant_basic_details_list['nationality'];
$is_agree = $applicant_appln_details_list['is_agree'];
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
$cur_qual_completed = $applicant_other_details_list['cur_qual_completed'];

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
// if($applicant_appln_details_list) {
//    foreach($applicant_appln_details_list as $k=>$v) {
//       $appln_form_id = $v['appln_form_id'];
//       if($app_form_id_btech == $appln_form_id) {
//         $applicant_appln_id = $v['applicant_appln_id'];
//         $is_qualify = $v['qualifyingexamfromindia'];
//         // $is_qualify = $v['is_qualify'];
//       }
//    }
// }

if($applicant_course_prefer_details_list) {
   foreach($applicant_course_prefer_details_list as $k=>$v) {
      $applicant_course_id[] = $v['applicant_course_id'];
      //$applicant_course_course_id[] = $v['course_id'];
      $applicant_course_course_id[] = $v['branch_id'];
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
$schooling_id = $applicant_schooling_details_list['schooling_id'];
$schooling_name = $applicant_schooling_details_list['schooling_name'];
$institute_name = $applicant_schooling_details_list['inst_name'];
$board_id = $applicant_schooling_details_list['board_id'];
$board_name = $applicant_schooling_details_list['board_name'];
$marking_scheme_id = $applicant_schooling_details_list['marking_scheme_id'];
$marking_scheme_name = $applicant_schooling_details_list['marking_scheme_name'];
$obtained_percentage_cgpa = $applicant_schooling_details_list['mark_percentage'];
$year_of_passing = $applicant_schooling_details_list['completion_year'];
$registration_no = $applicant_schooling_details_list['registration_no'];
$tenth_name = $applicant_schooling_details_list['name_as_in_marksheet'];
$mode_of_study_id = $applicant_schooling_details_list['mode_of_study_id'];
$mode_of_study_name = $applicant_schooling_details_list['mode_of_study_name'];
$address_of_school_college = $applicant_schooling_details_list['address'];
$result_declared = $applicant_schooling_details_list['result_declared'];
$is_curr_qualify = $applicant_schooling_details_list['is_curr_qualify'];
$other_board_name = $applicant_schooling_details_list['other_board_name'];

$applicant_name = $applicant_appln_details_list['applicant_name_declaration'];
$applicant_name = ($applicant_name)?$applicant_name:$first_name;

$application_status_id =$applicant_appln_details_list['application_status_id'];

$parent_name = $applicant_appln_details_list['applicant_parentname_declaration'];
$father_name = $applicant_parent_parent_name[$parent_type_id_father];
$mother_name = $applicant_parent_parent_name[$parent_type_id_mother];
$guardian_name = $applicant_parent_parent_name[$parent_type_id_guardian];
$parent_name = isset($parent_name)?$parent_name : $father_name;

$declaration_date = $applicant_appln_details_list['applicant_declaration_date'];
$declaration_date = ($declaration_date)?date('d/m/Y',strtotime($declaration_date)):date('d/m/Y');

$applicant_appln_id = $applicant_appln_details_list['applicant_appln_id'];
$is_qualify = $applicant_appln_details_list['qualifyingexamfromindia'];


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

$applicant_upload_declaration_wizard_id = $applicant_instructions_list[$form_wizard_upload_declaration_id][0]['form_w_wizard_id'];
$applicant_upload_declaration_wizard_instructions = $applicant_instructions_list[$form_wizard_upload_declaration_id][0]['instruction'];
if($applicant_upload_declaration_wizard_instructions) {
  $applicant_upload_declaration_wizard_instructions = nl2br($applicant_upload_declaration_wizard_instructions);
} else {
  $applicant_upload_declaration_wizard_instructions = ' - ';
}
$applicant_upload_declaration_wizard_percent = $applicant_instructions_list[$form_wizard_upload_declaration_id][0]['completion_percent'];
$applicant_upload_declaration_wizard_message = $applicant_instructions_list[$form_wizard_upload_declaration_id][0]['message'];

/* form wizard instruction detail end */

$appln_form_fee = $applicant_appln_details_list['appln_form_fee'];
// echo '<pre>';
// print_r($applicant_payment_details_list);
// echo '</pre>';

/* Payment Details Start */
$branch_name = $applicant_payment_details_list['branch_name'];

$dd_cheque_no = $applicant_payment_details_list['dd_cheque_no'];
$dd_cheque_date = $applicant_payment_details_list['dd_cheque_date'];
if($dd_cheque_date) {
  $dd_cheque_date = date('d/m/Y',strtotime($dd_cheque_date));
}
$payment_mode_id = $applicant_payment_details_list['payment_mode_id'];
 //print_r($applicant_payment_details_list);
            //die;
/* Payment Details End */

// echo '<pre>';
// print_r($applicant_schooling_details_list); 
// print_r($applicant_other_details_list); 
// echo '</pre>';
$attributes = array('class' => 'form-horizontal form-wizard-wrapper .custom-validation', 'id' => 'btech_form', 'name' => 'btech_form', 'enctype' => 'multipart/form-data', 'data-parsley-validate data-toggle'=>"validator");

echo form_open('', $attributes);
?>
<div>
<div id="formerr" style="display:none;color:red">Something went to wrong.Please try again later. </div>
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
      <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
          <div class="card ">
              <div class="card-header p-0 " role="tab" id="headingOne">
                  <h6 class="p-2 ml-3">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed"><i class="fas fa-info-circle"></i> Instructions</a>
                  </h6>
              </div><!-- card-header -->

              <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                  <div class="card-body" style="font-size: 13px;">
                  <?php echo $applicant_basic_wizard_instructions;?>
                  </div>
              </div>
          </div>

          <!-- card -->
      </div>
      <div class="row" id="basic_details">
          <div class="col-md-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Nationality</label>
                  <select class="form-control select2" data-placeholder="Choose Nationality" tabindex="-1" aria-hidden="true" name="pd_nationality" id="pd_nationality" title="Choose Nationality" data-parsley-validate-if-empty="true" data-parsley-errors-container="#custom-pd_nationality-parsley-error" data-parsley-btech-basic-check="studied_from_india,<?php echo $country_value_default; ?>,no,1" data-parsley-trigger="change">
                      <option value="">Choose Nationality</option>
                      <option value="Indian">Indian</option>
                      <option value="Afghan">Afghan</option>
                      <option value="Albanian">Albanian</option>
                      <option value="Argentinean">Argentinean</option>
                  </select>
                  <span id="custom-pd_nationality-parsley-error"></span>					  
              </div>				  
    			   <!-- <div class="form-group" id="other_qd" style="display:none;">
    					<input type="text" class="form-control" name="qualifying_degree_other" id="qualifying_degree_other" placeholder="If Other, pls enter here.." maxlength=100>			   
    			   </div> --> 
            			  
          </div><!-- col-4 -->
          <div class="col-md-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">Have you studied from India? </label>
                <select class="form-control custom-select" id="studied_from_india" name="studied_from_india" data-placeholder="Select Status - Yes or No" data-parsley-validate-if-empty="true" data-parsley-errors-container="#custom-studied_from_india-parsley-error" data-parsley-btech-basic-check="pd_nationality,no,<?php echo $country_value_default; ?>,2" data-parsley-trigger="change">
                    <option value="">Select Status - Yes or No</option>
                    <option value="Yes">Yes </option>
                    <option value="No">No </option>
                </select>
                <span id="custom-studied_from_india-parsley-error"></span>
              </div>		  
          </div><!-- col-4 -->
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group" id="indian" style="display: none;">
              Please be advised that being an NRI you have two
              options for admission:
              <br><br>
              Option 1 :
              <b>Admission through SRMJEEE 2020</b>
              <br><br>
              1) Write SRMJEEE 2020<br>
              2) Satisfy all eligibility criteria that
              applies to domestic applicants<br>
              3) Choose the program and campus during the
              counselling subject to availability of
              seats<br>
              4) Pay as per the domestic tuition fee structure of
              SRMIST
              <br><br>Option 2 :&nbsp;
              <b>Direct Admissions</b>
              <br><br>
              1) SRMJEEE 2020 is not mandatory<br>
              2) Satisfy all eligibility criteria that applies to
              international applicants<br>
              3) Choose the program and campus through
              International admission process<br>
              4) Pay as per the international fee structure of
              SRMIST
              <br><br>
              International Application Form link is as
              follows:&nbsp;<a href="https://intlapplications.srmist.edu.in/international-application-form-2020" target="_blank">https://intlapplications.srmist.edu.in/international-application-form-2020</a>
            <div class="form-group formAreaCols ">
              <label class="control-label" for="radios">Though I fall under NRI category I am permitted to give SRMJEEE 2020 and go through the counseling process.    <p class="requiredStar">*</p></label>
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" name="i_agree" id="i_agree" value="<?php echo ($is_agree == 't')?1:0; ?>"  data-parsley-required="false" data-parsley-required-message="<?php echo REQD_CHECK_CONFIRM_MSG;?>" <?php echo ($is_agree == 't')?'checked':0; ?>><label class="custom-control-label" for="i_agree"> I agree </label>
              </div>
              <span id="custom-i_agree-parsley-error"></span>
            </div>
          </div>
          <div class="form-group formAreaCols" id="indian2">
              SRMJEEE is not applicable for international
              students. Go to the below link to
              proceed further.<br><br><a href="https://intlapplications.srmist.edu.in/international-application-form-2020"><b>https://intlapplications.srmist.edu.in/international-application-form-2020</b></a>
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
       
            <h5 class="text-primary mb-3">Course and Campus Preference </h5>
           
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Course Preference 1
                                <span class="tx-danger">*</span></label>
                            <select class="form-control custom-select study" data-placeholder="Choose Course Preference 1" tabindex="-1" aria-hidden="true" name="course_pref_1" id="course_pref_1" title="Choose Course Preference 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_COURSE_PREFERENCE1_MSG;?>" data-parsley-errors-container="#custom-course_pref_1-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Course Preference 1</option>
                            </select>
                            <span id="custom-course_pref_1-parsley-error"></span>
                        </div>
                        <input type="hidden" name="course_choice_no_1" id="course_choice_no_1" value="<?php echo (isset($applicant_course_choice_no[0]))?$applicant_course_choice_no[0]:'1'; ?>" />
                        <input type="hidden" name="course_prefer_id_1" id="course_prefer_id_1" value="<?php echo (isset($applicant_course_id[0]))?$applicant_course_id[0]:''; ?>" />
                    </div><!-- col-4 -->
                    <div class="col-lg-4" id="main_div_spec_pref_1" style="display:none">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Specialization Preference 1 <span class="tx-danger">*</span></label>
                            <select class="form-control custom-select study test_spec" data-placeholder="Choose Specialization Preference 1" tabindex="-1" aria-hidden="true" name="specialization_pref_1" id="specialization_pref_1" title="Choose Specialization Preference 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_SPL_PREFERENCE1_MSG;?>" data-parsley-errors-container="#custom-specialization_pref_1-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Specialization Preference 1</option>
                            </select>
                            <span id="custom-specialization_pref_1-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4" id="main_div_camp_pref_1" style="display:none">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Campus Preference 1 <span class="tx-danger">*</span></label>
                            <select class="form-control custom-select study test_campus" data-placeholder="Choose Campus Preference 1" tabindex="-1" aria-hidden="true" name="campus_pref_1" id="campus_pref_1" title="Choose Campus Preference 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_CAMPUS_PREFERENCE1_MSG;?>" data-parsley-errors-container="#custom-campus_pref_1-parsley-error" data-parsley-trigger="change" onchange="campus_pref_change('specialization_pref_1','campus_pref_1')">
                                <option value="">Choose Campus Preference 1</option>
                            </select>
                            <span id="custom-campus_pref_1-parsley-error"></span>
                        </div>
                        <input type="hidden" name="campus_choice_no_1" id="campus_choice_no_1" value="<?php echo (isset($applicant_campus_choice_no[0]))?$applicant_campus_choice_no[0]:'1'; ?>" />
                        <input type="hidden" name="campus_prefer_id_1" id="campus_prefer_id_1" value="<?php echo (isset($applicant_campus_prefer_id[0]))?$applicant_campus_prefer_id[0]:''; ?>" />
                    </div><!-- col-4 -->
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Course Preference 2</label>
                            <select class="form-control custom-select study" data-placeholder="Choose Course Preference 2" tabindex="-1" aria-hidden="true" name="course_pref_2" id="course_pref_2" title="Choose Course Preference 2" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_COURSE_PREFERENCE2_MSG;?>" data-parsley-errors-container="#custom-course_pref_2-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Course Preference 2</option>
                            </select>
                            <span id="custom-course_pref_2-parsley-error"></span>
                        </div>
                        <input type="hidden" name="course_choice_no_2" id="course_choice_no_2" value="<?php echo (isset($applicant_course_choice_no[1]))?$applicant_course_choice_no[1]:'2'; ?>" />
                        <input type="hidden" name="course_prefer_id_2" id="course_prefer_id_2" value="<?php echo (isset($applicant_course_id[1]))?$applicant_course_id[1]:''; ?>" />
                    </div><!-- col-4 -->
                    <div class="col-lg-4" id="main_div_spec_pref_2" style="display:none">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Specialization Preference 2</label>
                            <select class="form-control custom-select study test_spec" data-placeholder="Choose Specialization Preference 2" tabindex="-1" aria-hidden="true" name="specialization_pref_2" id="specialization_pref_2" title="Choose Specialization Preference 2" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_SPL_PREFERENCE2_MSG;?>" data-parsley-errors-container="#custom-specialization_pref_2-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Specialization Preference 2</option>
                            </select>
                            <span id="custom-specialization_pref_2-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4" id="main_div_camp_pref_2" style="display:none">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Campus Preference 2</label>
                            <select class="form-control custom-select study test_campus" data-placeholder="Choose Campus Preference 2" tabindex="-1" aria-hidden="true" name="campus_pref_2" id="campus_pref_2" title="Choose Campus Preference 2" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_CAMPUS_PREFERENCE2_MSG;?>" data-parsley-errors-container="#custom-campus_pref_2-parsley-error" data-parsley-trigger="change" onchange="campus_pref_change('specialization_pref_2','campus_pref_2')">
                                <option value="">Choose Campus Preference 2</option>
                            </select>
                            <span id="custom-campus_pref_2-parsley-error"></span>
                        </div>
                        <input type="hidden" name="campus_choice_no_2" id="campus_choice_no_2" value="<?php echo (isset($applicant_campus_choice_no[1]))?$applicant_campus_choice_no[1]:'2'; ?>" />
                        <input type="hidden" name="campus_prefer_id_2" id="campus_prefer_id_2" value="<?php echo (isset($applicant_campus_prefer_id[1]))?$applicant_campus_prefer_id[1]:''; ?>" />
                    </div><!-- col-4 -->
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Course Preference 3</label>
                            <select class="form-control custom-select study" data-placeholder="Choose Course Preference 3" tabindex="-1" aria-hidden="true" name="course_pref_3" id="course_pref_3" title="Choose Course Preference 3" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_COURSE_PREFERENCE3_MSG;?>" data-parsley-errors-container="#custom-course_pref_3-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Course Preference 3</option>
                            </select>
                            <span id="custom-course_pref_3-parsley-error"></span>
                        </div>
                        <input type="hidden" name="course_choice_no_3" id="course_choice_no_3" value="<?php echo (isset($applicant_course_choice_no[2]))?$applicant_course_choice_no[2]:'3'; ?>" />
                        <input type="hidden" name="course_prefer_id_3" id="course_prefer_id_3" value="<?php echo (isset($applicant_course_id[2]))?$applicant_course_id[2]:''; ?>" />
                    </div><!-- col-4 -->
                    <div class="col-lg-4" id="main_div_spec_pref_3" style="display:none">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Specialization Preference 3</label>
                            <select class="form-control custom-select study test_spec" data-placeholder="Choose Specialization Preference 3" tabindex="-1" aria-hidden="true" name="specialization_pref_3" id="specialization_pref_3" title="Choose Specialization Preference 3" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_SPL_PREFERENCE3_MSG;?>" data-parsley-errors-container="#custom-specialization_pref_3-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Specialization Preference 3</option>
                            </select>
                            <span id="custom-specialization_pref_3-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4" id="main_div_camp_pref_3" style="display:none">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Campus Preference 3</label>
                            <select class="form-control custom-select study test_campus" data-placeholder="Choose Campus Preference 3" tabindex="-1" aria-hidden="true" name="campus_pref_3" id="campus_pref_3" title="Choose Campus Preference 3" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_CAMPUS_PREFERENCE3_MSG;?>" data-parsley-errors-container="#custom-campus_pref_3-parsley-error" data-parsley-trigger="change" onchange="campus_pref_change('specialization_pref_3','campus_pref_3')">
                                <option value="">Choose Campus Preference 3</option>
                            </select>
                            <span id="custom-campus_pref_3-parsley-error"></span>
                        </div>
                        <input type="hidden" name="campus_choice_no_3" id="campus_choice_no_3" value="<?php echo (isset($applicant_campus_choice_no[2]))?$applicant_campus_choice_no[2]:'3'; ?>" />
                        <input type="hidden" name="campus_prefer_id_3" id="campus_prefer_id_3" value="<?php echo (isset($applicant_campus_prefer_id[2]))?$applicant_campus_prefer_id[2]:''; ?>" />
                    </div><!-- col-4 -->
                </div><!-- row -->
           
        
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
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Test State Perferences 3</label>
                            <select class="form-control select2 test_state" data-placeholder="Choose Test State Perferences 3" tabindex="-1" aria-hidden="true" name="state_pref_3" id="state_pref_3" title="Choose Test State Perferences 3" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_STATE_PREFERENCE3_MSG;?>" data-parsley-errors-container="#custom-state_pref_3-parsley-error" data-parsley-trigger="change">
                              <option value="">Choose Test State Perferences 3</option>
                            </select>
                            <span id="custom-state_pref_3-parsley-error"></span>
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6" id="main_div_city_pref_3" style="display:none">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Test City Perferences 3</label>
                            <select class="form-control select2 test_city" data-placeholder="Choose Test City Perferences 3" tabindex="-1" aria-hidden="true" name="city_pref_3" id="city_pref_3" title="Choose Test City Perferences 3" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_CITY_PREFERENCE3_MSG;?>" data-parsley-errors-container="#custom-city_pref_3-parsley-error" data-parsley-trigger="change" onchange="test_city_pref_change('state_pref_3','city_pref_3')">
                              <option value="">Choose Test City Perferences 3</option>
                            </select>
                            <span id="custom-city_pref_3-parsley-error"></span>
                        </div>
                        <input type="hidden" name="city_choice_no_3" id="city_choice_no_3" value="<?php echo (isset($applicant_city_choice_no[2]))?$applicant_city_choice_no[2]:'3'; ?>" />
                        <input type="hidden" name="city_prefer_id_3" id="city_prefer_id_3" value="<?php echo (isset($applicant_city_id[2]))?$applicant_city_id[2]:''; ?>" />
                    </div><!-- col-6 -->
                </div><!-- row -->
          
   
            <h5 class="text-primary mt-4 mb-3">Personal Details</h5>
           
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Title</label>
                            <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_title" id="pd_title" title="Choose Title" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_TITLE_MSG;?>" data-parsley-errors-container="#custom-pd_title-parsley-error" data-parsley-trigger="change">
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
                            <input class="form-control" type="text" name="pd_middlename" id="pd_middlename" placeholder="Your Middle Name" value="<?php echo $m_name; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="Middle <?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_MIDDLE_NAME_MINLENGTH; ?>, <?php echo APLCT_MIDDLE_NAME_MAXLENGTH; ?>]" maxlength="<?php echo APLCT_MIDDLE_NAME_MAXLENGTH; ?>" data-parsley-trigger="change">
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
                          <input type="text" name="pd_mobile_no" id="pd_mobile_no" maxlength="<?php echo APLCT_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Mobile No" class="form-control" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOBILE_MSG;?>" data-parsley-mobileonly="true" data-parsley-errors-container="#custom-pd_mobile_no-parsley-error" value="<?php echo $mob_no; ?>" data-parsley-trigger="change">
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
                            <label class="form-control-label">Date of Birth<span class="tx-danger"> *</span></label>
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
                            <input class="form-control" type="email" name="pd_alt_email" id="pd_alt_email" placeholder="Alternate Email" data-parsley-required="false" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Alternate Email ID" data-parsley-errors-container="#custom-pd_alt_email-parsley-error" data-parsley-trigger="change" value="<?php echo $sec_e_mail; ?>" data-parsley-notequalto="#pd_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH; ?>" maxlength="<?php echo APLCT_ALT_EMAIL_MAXLENGTH; ?>">
                            <span id="custom-pd_alt_email-parsley-error"></span>
                            <span id="suggestion_alt_email"></span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Community <span class="tx-danger">*</span></label>
                            <select class="form-control select2" data-placeholder="Choose Community" tabindex="-1" aria-hidden="true" name="pd_social_status" id="pd_social_status" title="Choose Community" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_COMMUNITY_MSG;?>" data-parsley-errors-container="#custom-pd_social_status-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Community</option>
                            </select>
                            <span id="custom-pd_social_status-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Blood Group</label>
                            <select class="form-control select2" data-placeholder="Choose Blood Group" tabindex="-1" aria-hidden="true" name="pd_blood_group" id="pd_blood_group" title="Choose Blood Group" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_BLOOD_GRP_MSG;?>" data-parsley-errors-container="#custom-pd_blood_group-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Blood Group</option>
                            </select>
                            <span id="custom-pd_blood_group-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Religion <span class="tx-danger">*</span></label>
                            <select class="form-control select2" data-placeholder="Choose Religion" tabindex="-1" aria-hidden="true" name="pd_religion" id="pd_religion" title="Choose Religion" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_RELIGION_MSG;?>" data-parsley-errors-container="#custom-pd_religion-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Religion</option>
                            </select>
                            <span id="custom-pd_religion-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Medium of Instruction <span class="tx-danger">*</span></label>
                            <select class="form-control select2" data-placeholder="Choose Medium of Instruction" tabindex="-1" aria-hidden="true" name="pd_medium_of_instruction" id="pd_medium_of_instruction" title="Choose Medium of Instruction" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MEDIUM_INSTR_MSG;?>" data-parsley-errors-container="#custom-pd_medium_of_instruction-parsley-error" data-parsley-trigger="change">
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
                            <label class="form-control-label">Mother Tongue</label>
                            <select class="form-control select2" data-placeholder="Choose Mother Tongue" tabindex="-1" aria-hidden="true" name="pd_mother_tongue" id="pd_mother_tongue" title="Choose Mother Tongue" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_TONGUE_MSG;?>" data-parsley-errors-container="#custom-pd_mother_tongue-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Mother Tongue</option>
                            </select>
                            <span id="custom-pd_mother_tongue-parsley-error"></span>
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
                            <label class="form-control-label">Are you a differently Abled?</label>
                            <select class="form-control select2" data-placeholder="Choose Differently Abled" tabindex="-1" aria-hidden="true" name="pd_diffrently_abled" id="pd_diffrently_abled" title="Choose Differently Abled" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_DIFF_ABLED_MSG;?>" data-parsley-errors-container="#custom-pd_diffrently_abled-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Differently Abled</option>
                                <option value="yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                            <span id="custom-pd_diffrently_abled-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                </div><!-- row -->
            

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
                        <input type="text" class="form-control" name="pd_father_alt_phone" id="pd_father_alt_phone" maxlength="<?php echo APLCT_FATHER_ALT_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Alternate Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_ALT_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_FATHER_MOBILE_MSG;?>" data-parsley-maxlength-message="<?php echo VALID_FATHER_MOBILE_MSG;?>" data-parsley-errors-container="#custom-pd_father_alt_phone-parsley-error" value="<?php echo $applicant_parent_alt_mobile_no[$parent_type_id_father]; ?>" data-parsley-mobileonly="true">
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
                      <div id="father_other_occupation_div" style="display:none;" class="form-group">
						<input class="form-control" type="text" name="pd_father_other_occupation" id="pd_father_other_occupation"  placeholder="If Other, please enter here..."data-parsley-required="false"   data-parsley-errors-container="#custom-pd_father_other_occupation-parsley-error" value="<?php echo $applicant_parent_occupation_other_name[$parent_type_id_father];?>" maxlength="<?php echo APLCT_FATHER_OCCP_MAXLENGTH; ?>">
						<span id="custom-pd_father_other_occupation-parsley-error"></span>
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
                        <input type="text" class="form-control" name="pd_mother_phone" id="pd_mother_phone" maxlength="<?php echo APLCT_MOTHER_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOTHER_MOBILE_MSG;?>" data-parsley-maxlength-message="<?php echo VALID_MOTHER_MOBILE_MSG;?>" data-parsley-errors-container="#custom-pd_mother_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no[$parent_type_id_mother]; ?>" data-parsley-notequalto="#pd_father_phone" data-parsley-notequalto-message="<?php echo PHONE_MATCH_MOTHER; ?>" data-parsley-mobileonly="true">
                        </div>
                        <span id="custom-pd_mother_phone-parsley-error"></span>
                    </div>
                    <div class="col-lg-4" id="mother_alt_mbleno_div" style="display:none;">
                        <label class="form-control-label">Mother's Alternative Mobile Number</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="pd_mother_alt_phone_no_code" name="pd_alt_email_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                            <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                          </select>
                        </span>
                        <input type="text" class="form-control" name="pd_mother_alt_phone" id="pd_mother_alt_phone" maxlength="<?php echo APLCT_MOTHER_ALT_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOTHER_MOBILE_MSG;?>" data-parsley-maxlength-message="<?php echo VALID_MOTHER_MOBILE_MSG;?>" data-parsley-errors-container="#custom-pd_mother_alt_phone-parsley-error" value="<?php echo $applicant_parent_alt_mobile_no[$parent_type_id_mother]; ?>" data-parsley-mobileonly="true">
                        <span id="custom-pd_mother_alt_phone-parsley-error"></span>
                        </div>
                    </div>
                    <div class="col-lg-4" id="mother_email_div" style="display:none;">
                        <div class="form-group">
                            <label class="form-control-label">Mother's Email ID </label>
                            <input class="form-control" type="email" name="pd_mother_email" id="pd_mother_email"  placeholder="Enter Your Mother's Email ID"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_EMAIL_MSG;?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_MOTHER_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_mother_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_mother]; ?>" maxlength="<?php echo APLCT_MOTHER_EMAIL_MAXLENGTH; ?>" data-parsley-notequalto="#pd_father_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_MOTHER; ?>">
                        </div>
                        <span id="custom-pd_mother_email-parsley-error"></span>
                        <span id="suggestion_mother_email"></span>
                    </div>
                    <div class="col-lg-4" id="mother_occupation_div" style="display:none;">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Mother's Occupation</label>
                            <select class="form-control select2" data-placeholder="Choose Occupation" tabindex="-1" aria-hidden="true" name="pd_mother_occupation" id="pd_mother_occupation">
                              <option value="">Select Mother's Occupation</option>
                            </select>
                        </div>
                        <div id="mother_other_occupation_div" style="display:none;" class="form-group">
						<input class="form-control" type="text" name="pd_mother_other_occupation" id="pd_mother_other_occupation"  placeholder="If Other, please enter here..." data-parsley-required="false"   data-parsley-errors-container="#custom-pd_mother_other_occupation-parsley-error" value="<?php echo $applicant_parent_occupation_other_name[$parent_type_id_mother];?>" maxlength="<?php echo APLCT_MOTHER_OCCP_MAXLENGTH; ?>">
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
              <div class="row" id="guardian_details" style="display:none">
                <div class="col-sm-12">
                  <h5 class="text-primary mt-4 mb-3">Guardian's Details</h5>
                </div>
           
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Guardian's Name <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="pd_guardian_name" id="pd_guardian_name" placeholder="Enter Your Guardian Name" maxlength="<?php echo APLCT_GUARDIAN_NAME_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" value="<?php echo $applicant_parent_parent_name[$parent_type_id_guardian]; ?>">
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
                        <input type="text" class="form-control" name="pd_guardian_phone" id="pd_guardian_phone" maxlength="<?php echo APLCT_GUARDIAN_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Guardian's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_GUARDIAN_MOBILE_MSG;?>"  data-parsley-maxlength-message="<?php echo VALID_GUARDIAN_MOBILE_MSG;?>" data-parsley-errors-container="#custom-pd_guardian_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no[$parent_type_id_guardian]; ?>" data-parsley-mobileonly="true">
                      </div>
                      <span id="custom-pd_guardian_phone-parsley-error"></span>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Guardian's Email ID <span class="tx-danger">*</span></label>
                            <input class="form-control" type="email" name="pd_guardian_email" id="pd_guardian_email"  placeholder="Enter Your Guardian's Email ID"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_EMAIL_MSG;?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_GUARDIAN_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_guardian_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_guardian]; ?>" maxlength="<?php echo APLCT_GUARDIAN_EMAIL_MAXLENGTH; ?>" >
                            <span id="custom-pd_guardian_email-parsley-error"></span>
                            <span id="suggestion_guardian_email"></span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Guardian's Occupation <span class="tx-danger">*</span></label>
                            <select class="form-control select2" data-placeholder="Choose Guardian Occupation" tabindex="-1" aria-hidden="true" name="pd_guardian_occupation" id="pd_guardian_occupation" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_OCCUPATION_MSG;?>" data-parsley-errors-container="#custom-pd_guardian_occupation-parsley-error" data-parsley-trigger="change"> 
                              <option value="">Select Guardian's Occupation</option>
                            </select>
                            <span id="custom-pd_guardian_occupation-parsley-error"></span>
                        </div>
                        <div id="guardian_other_occupation_div" style="display:none;" class="form-group">
						<input class="form-control" type="text" name="guardian_other_occupation" id="guardian_other_occupation"  placeholder="If Other, please enter here..."data-parsley-required="false" data-parsley-errors-container="#custom-guardian_other_occupation-parsley-error" value="<?php echo $applicant_parent_occupation_other_name[$parent_type_id_guardian];?>"  maxlength="<?php echo APLCT_GUARDIAN_OCCP_MAXLENGTH; ?>">
						<span id="custom-guardian_other_occupation-parsley-error"></span>
					   </div>
                    </div><!-- col-4 -->
                  </div><!-- row -->
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
                            <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Pincode" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PINCODE_MSG;?>" value="<?php if($pin_code[0]) {echo $pin_code[0];} ?>" data-parsley-maxlength="<?php echo APLCT_PINCODE_MAXLENGTH; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_PINCODE_MSG;?>" maxlength="<?php echo APLCT_PINCODE_MAXLENGTH; ?>">
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
                    <div class="card-body" style="font-size: 13px;"><?php echo $applicant_academic_wizard_instructions;?></div>
                </div>
            </div>

            <!-- card -->
        </div>
        <!-- <h6 class="text-primary mt-4">Academic Details</h6> -->
        <div action="form-validation.html" id="selectForm" class="w-100">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group mr-5">
                <label class="form-control-label">Current Education Qualification Status <span class="tx-danger">*</span></label>
                <div class="row">
                  <div class="col-lg-4 pr-0">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="appering" name="current_education_qual_status" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="<?php echo REQD_EDU_QUAL_MSG;?>" data-parsley-errors-container="#custom-current_education_qual_status-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($cur_qual_completed == 'f')?'checked':''; ?>>
                      <label class="custom-control-label" for="appering">12th Appearing</label>
                    </div>
                  </div>
                  <div class="col-lg-4 pl-0">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="completed" name="current_education_qual_status" class="custom-control-input" value="2" <?php echo ($cur_qual_completed == 't')?'checked':''; ?>>
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
                  <input class="form-control" type="text" name="tenth_name" id="tenth_name" placeholder="Enter Name" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Name" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_CAND_NAME_MINLENGTH; ?>, <?php echo APLCT_CAND_NAME_MAXLENGTH; ?>]" value="<?php echo $tenth_name; ?>" maxlength="<?php echo APLCT_CAND_NAME_MAXLENGTH; ?>" data-parsley-trigger="change">
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
              <th class="align-middle">Course</th>
              <th class="align-middle"> Institute Name <span class="tx-danger">*</span></th>
              <th class="align-middle"> Board <span class="tx-danger">*</span></th>
              <th class="align-middle"> Mode of Study <span class="tx-danger">*</span></th>
              <th class="align-middle"> Marking Scheme <span id="label_marking_scheme_id" class="tx-danger">*</span></th>
              <th class="align-middle"> Obtained Percentage/CGPA <span id="label_obtained_percentage_cgpa_id" class="tx-danger">*</span></th>
              <th class="align-middle"> Year of Passing <span id="label_year_of_passing_id" class="tx-danger">*</span></th>
              <th class="align-middle"> Roll No. / Registration No</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><p>XII</p><input type="hidden" name="schooling_id" id="schooling_id" value="<?php echo $schooling_id; ?>" ></td>
              <td><input class="form-control" type="text" name="institute_name" id="institute_name" placeholder="Enter School Institute Name" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_INSTITUTE_NAME_MSG;?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_INSTITUTE_NAME_MINLENGTH; ?>, <?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>]" value="<?php echo $institute_name; ?>" maxlength="<?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>" data-parsley-trigger="change"></td>
              <td>
                <div class="form-group mg-b-10-force">
                  <select class="form-control custom-select" name="board" id="board" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BOARD_MSG;?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-board-parsley-error">
                    <option value="">Select</option>
                  </select>
                  <span id="custom-board-parsley-error"></span>
                </div>
                <div class="form-group" id="other_board1" style="display:none;">
					<input type="text" class="form-control" name="other_board" id="other_board" placeholder="If Other, please enter here.." maxlength="<?php echo APLCT_OTHER_BOARD_MAXLENGTH;?>"  value="<?php echo $other_board_name; ?>">
				</div>
              </td>
              <td>
                <div class="form-group mg-b-10-force">
                  <select class="form-control custom-select" name="mode_of_study" id="mode_of_study" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MODE_STUDY_MSG;?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-mode_of_study-parsley-error">
                    <option value="">Select</option>
                  </select>
                  <span id="custom-mode_of_study-parsley-error"></span>
                </div>
              </td>
              <td>
                <div class="form-group mg-b-10-force" id="appering_info_1">
                  <select class="form-control custom-select" name="marking_scheme" id="marking_scheme" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MARK_SCHEME_MSG;?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-marking_scheme-parsley-error">
                    <option value="">Select</option>
                  </select>
                  <span id="custom-marking_scheme-parsley-error"></span>
                </div>
              </td>
              <td>
                  <input class="form-control" type="text" name="obtained_percentage_cgpa" placeholder="Obtained Percentage/CGPA" id="obtained_percentage_cgpa" maxlength="<?php echo APLCT_PERCENT_CGPA_MAXLENGTH;?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG;?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-obtained_percentage_cgpa-parsley-error" value="<?php echo $obtained_percentage_cgpa; ?>" min="<?php echo APLCT_MARK_MINLENGTH;?>" max="<?php echo APLCT_MARK_MAXLENGTH;?>" data-parsley-trigger="keyup" data-parsley-type="number"> 
                  <span id="custom-obtained_percentage_cgpa-parsley-error"></span>
              </td>
              <td>
                  <input class="form-control" type="text" name="year_of_passing" id="year_of_passing" placeholder="YYYY" maxlength="<?php echo APLCT_YEAR_OF_PASSING_MAXLENGTH;?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_YEAR_OF_PASSING_MSG;?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-year_of_passing-parsley-error" value="<?php echo $year_of_passing; ?>" readonly>
                  <span id="custom-year_of_passing-parsley-error"></span>
              </td>
              <td>
                  <input class="form-control" type="text" name="registration_no" id="registration_no" placeholder="Roll No. / Registration No" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH;?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_REG_NO_MSG;?>"  data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_REG_NO_MSG;?>" data-parsley-trigger="change" value="<?php echo $registration_no; ?>">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
        <div class="mt-5 w-100">
            <div class="row">
                <div class="col-lg-6 ">
                    <div class="form-group">
                        <label class="form-control-label">Address of School / College <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="address_of_school_college" id="address_of_school_college" placeholder="Enter School / College"  value="<?php echo $address_of_school_college; ?>" maxlength="<?php echo APLCT_SCHOOL_ADDRESS_MAXLENGTH;?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SCHOOL_ADDRESS_MSG;?>" data-parsley-trigger="change">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label">NAD ID / Digilocker ID</label>
                        <input class="form-control" type="text" name="nad_id_digilocker_id" id="nad_id_digilocker_id" placeholder="Enter NAD ID / Digilocker ID " value="<?php echo $nad_id_digilocker_id; ?>" maxlength="<?php echo APLCT_NADID_MAXLENGTH;?>" data-parsley-type='alphanum'  data-parsley-type-message="Enter Valid Digilocker ID">
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="w-100 mt-5">
            <div class="Payment_align">

                <a href="#" class="btn btn-primary active float-right" role="button"
                    aria-pressed="true">MAKE PAYMENT</a>
            </div>
        </div> -->

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
              <p class="card-subtitle mb-3">Name : <?php echo $first_name .' ' . $last_name ?> </p>
              <p class="card-subtitle mb-3">E-Mail : <?php echo $email_id; ?></p>
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
                                      <input class="form-control" type="text" name="BranchName" placeholder="Branch Name" id="BranchName" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BANK_NAME_MSG;?>" maxlength="<?php echo APLCT_BRANCH_NAME_MAXLENGTH;?>" value="<?php echo $branch_name; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo VALID_BANK_NAME_MSG;?>">
                                  </div>
                              </div>

                          </div>

                          <div class="col-md-12 mt-3">
                              <div class="row">
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="DDNumber" id="DDNumber" placeholder="DD Number" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DD_NO_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_DD_NO_MSG;?>"  maxlength="<?php echo APLCT_DD_NO_MAXLENGTH;?>" value="<?php echo $dd_cheque_no; ?>">
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

                <div id="collapseOne7" class="collapse bg-light show" role="tabpanel"
                    aria-labelledby="headingOne" style="">
                    <div class="card-body" style="font-size: 13px;">
                      <?php echo $applicant_upload_declaration_wizard_instructions;?></div>
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
                            <label for="exampleFormControlTextarea1">Upload Your
                                Recent Passport Size Photograph <span class="tx-danger">*</span></label>

                            <input type="file" class="filestyle" name="photograph" id="photograph" data-parsley-required="<?php echo ((isset($docs[$document_id_photograph]))?'false':'true'); ?>" data-required="true" data-parsley-required-message="<?php echo REQD_UPLOAD_PHOTO_MSG; ?>" data-parsley-errors-container="#custom-photograph-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                           <?php if(isset($docs[$document_id_photograph])){ ?>
                              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_photograph; ?>">
                                 <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_photograph; ?>')">&times;</a>
                                 <strong id="deleteMessageStatus_<?php echo $document_id_photograph; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_photograph; ?>"></span>
                             </div>
                           <?php } ?>
                           <span id="custom-photograph-parsley-error"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Signature <span class="tx-danger">*</span></label>

                            <input type="file" class="filestyle" name="signature" id="signature" data-parsley-required="<?php echo ((isset($docs[$document_id_signature]))?'false':'true'); ?>" data-required="true" data-parsley-required-message="<?php echo REQD_UPLOAD_SIGN_MSG; ?>" data-parsley-errors-container="#custom-signature-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                            <?php if(isset($docs[$document_id_signature])){ ?>
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
                                <label for="exampleFormControlTextarea1">Upload Your 10th Marksheet 
                                  <!-- <span class="tx-danger">*</span> --> </label>

                                <input type="file" class="filestyle" name="tenth_marksheet" id="tenth_marksheet" data-parsley-required="<?php echo ((isset($docs[$document_id_tenth_marksheet]))?'false':'true'); ?>" data-parsley-required-message="Please upload 10th marksheet" data-parsley-errors-container="#custom-tenth_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if (isset($docs[$document_id_tenth_marksheet])) {
                                    echo $docs[$document_id_tenth_marksheet]['id'];
                                } ?>" accept="<?php echo allow_extension($file_allowed_type); ?>">
                      <?php if (isset($docs[$document_id_tenth_marksheet])) { ?>
                                   <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_tenth_marksheet; ?>">
                                        <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_tenth_marksheet; ?>')">&times;</a>
                                        <strong id="deleteMessageStatus_<?php echo $document_id_tenth_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_tenth_marksheet; ?>"></span>
                                    </div>                
                      <?php } ?>
                                <span id="custom-tenth_marksheet-parsley-error"></span>
                            </div>
                            <?php if($cur_qual_completed=='t') { ?>
                            
                              <div class="form-group col-md-6 twelfthsheet" >
                              <label for="exampleFormControlTextarea1">Upload Your 12th Marksheet 
                              <!-- <span class="tx-danger twelfthsheet">*</span> --></label>
    
                              <input type="file" class="filestyle" name="twelvfth_marksheet" id="twelvfth_marksheet" data-parsley-required="false" data-parsley-required-message="Please upload 12th marksheet" data-parsley-errors-container="#custom-twelvfth_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_twelvfth_marksheet])){ echo $docs[$document_id_twelvfth_marksheet]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                               <?php if(isset($docs[$document_id_twelvfth_marksheet])){ ?>
                                   <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_twelvfth_marksheet; ?>">
                                     <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_twelvfth_marksheet; ?>')">&times;</a>
                                     <strong id="deleteMessageStatus_<?php echo $document_id_twelvfth_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_twelvfth_marksheet; ?>"></span>
                                 </div>                 
                               <?php } ?>
                               <span id="custom-twelvfth_marksheet-parsley-error"></span>
                             </div>
                             <?php } ?>
                              <div class="form-group col-md-6">
                                <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Aadhar card</label>
                             <input type="file" class="filestyle" name="aadhar_card" id="aadhar_card" data-parsley-required="false" data-parsley-validate-if-empty="true"data-parsley-required-message="Please upload your aadhar card" data-parsley-errors-container="#custom-aadhar_card-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>"  data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_aadhar_card])){ echo $docs[$document_id_aadhar_card]['id']; } ?>">
                             <?php if(isset($docs[$document_id_aadhar_card])){ ?>
                                   <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_aadhar_card; ?>">
                                      <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_aadhar_card; ?>')">&times;</a>
                                      <strong id="deleteMessageStatus_<?php echo $document_id_aadhar_card; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_aadhar_card; ?>"></span>
                                  </div>
                             <?php } ?>
                             <span id="custom-aadhar_card-parsley-error"></span>
                        </div>
                  </div>
                    <div class="row w-100">
                      <div class="col-md-12">
                        <h5 class="card-body-title">Declaration</h5>
                        <p><?php echo DECLARATION; ?></p>
                      </div>  
                    </div>
                    <div class="row w-100">
                      <div class="col-md-6">
                        <label class="form-control-label">Applicant Name <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="applicant_name" id="applicant_name" placeholder="Applicant Name" maxlength="<?php echo APLCT_DECLR_NAME_MAXLENGTH;?>" data-parsley-required=""true"" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_APPLT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_DECLR_NAME_MINLENGTH;?>, <?php echo APLCT_DECLR_NAME_MAXLENGTH;?>]" value="<?php echo $applicant_name; ?>" data-parsley-trigger="change">
                      </div>
                      <div class="col-md-6">
                        <label class="form-control-label">Parent Name <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="parent_name" id="parent_name" placeholder="Parent Name" maxlength="<?php echo APLCT_DECLR_FATHER_NAME_MAXLENGTH;?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_PARENT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_DECLR_FATHER_NAME_MINLENGTH;?>, <?php echo APLCT_DECLR_FATHER_NAME_MAXLENGTH;?>]" value="<?php echo $parent_name; ?>" data-parsley-trigger="change">
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
                        <a href="<?php echo base_url();?>btech-preview">
                        <input type="button"  id="form_preview_btn" class="btn btn-primary" value="Form Preview"> </a>
                      </div>
                    </div> -->
                </div><!-- row -->
            </div>
        </div>

    </fieldset>   
<?php form_close(); ?><!-- form -->