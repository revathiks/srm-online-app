<?php
//Constant Value
$country_value_default = COUNTRY_VALUE_DEFAULT;
$parent_type_id_father = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
$form_wizard_payment_id = FORM_WIZARD_PAYMENT_ID;

$applicant_schooling_id  = $applicant_schooling_name = $applicant_institute_name = $applicant_board_id = $applicant_board_name = $applicant_marking_scheme_id = $applicant_marking_scheme_name = $applicant_obtained_percentage_cgpa = $applicant_year_of_passing = $applicant_registration_no =  $applicant_tenth_name = $applicant_mode_of_study_id = $applicant_mode_of_study_name = $applicant_address_of_school_college = $applicant_scl_det_id = $applicant_result_declared = $app_comp_exam_id = $app_comp_exam_name = $app_comp_registration_no =  $app_comp_score_obtained = $app_comp_max_score = $app_comp_exam_year = $app_comp_all_india_rank = $app_comp_qualified = $applicant_entr_exam_det_id = $applicant_scl_country_id = $applicant_scl_country_name =  $applicant_scl_exam_id = $applicant_scl_exam_name = array();

$startIndex = $this->input->get('startIndex', true);


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
      $add_line_1[$addr_type_id] = $v['add_line_1'];
      $add_line_2[$addr_type_id] = $v['add_line_2'];
      $pin_code[$addr_type_id] = $v['pin_code'];
   }
}

// Address Line 1 & 2 & Pincode

$communication_look_up_value = LOOKUP_VALUE_ADDRESS_COMMUNICATION;
$communication_look_up_value_permanent = LOOKUP_VALUE_PERMANENT_ADDRESS_COMMUNICATION;

$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_tenth_grade = DOCUMENT_ID_TENTH_GRADE;
$document_id_twelvfth_grade = DOCUMENT_ID_TWELVFTH_GRADE;
$document_id_bachelors_marksheet = DOCUMENT_ID_BACHELORS_MARKSHEET;
$document_id_masters_marks_card = DOCUMENT_ID_MASTERS_MARKS_CARD;
$document_id_transcripts = DOCUMENT_ID_TRANSCRIPTS;
$document_id_other_document1 = DOCUMENT_ID_ADDITIONAL_QUALIFICATION;
$document_id_other_document2 = DOCUMENT_ID_OTHER_DOCUMENTS;

$docs=array();
$file_count = 0;

if($upload_filelist){
foreach($upload_filelist as $doc){
   $docs[$doc['document_id']]=array(
        'id'=>$doc['id'],
        'file_name'=>$doc['name'],
        'file_name_user'=>remove_file_separator($doc['name']),
        'file_name_truncate'=>remove_file_separator($doc['name'], true),
        'file_path'=>$doc['path'],
    );
}
}

$docs['file_count'] = $file_count;


$communication_addr_line_1 = $add_line_1[$communication_look_up_value];
$communication_addr_line_2 = $add_line_2[$communication_look_up_value];
$communication_pincode = $pin_code[$communication_look_up_value];

$permanent_addr_line_1 = $add_line_1[$communication_look_up_value_permanent];
$permanent_addr_line_2 = $add_line_2[$communication_look_up_value_permanent];
$permanent_pincode = $pin_code[$communication_look_up_value_permanent];

$permanent_pincode = $pin_code[$communication_look_up_value_permanent];

if($applicant_address_details_list){
  if(count($applicant_address_details_list)>1){
    $is_permanent_addr_same = 'f';
  } 
}
else{
  $is_permanent_addr_same = 't';
  $show_permanent_address = 'display:none;';
}

/*Appln details Start*/
$is_agree = $applicant_appln_details_list['is_agree'];
$db_grade_id = $applicant_appln_details_list['grad_id'];
$db_grade_name = $applicant_appln_details_list['grad_name'];
/*Appln details End*/

/*Basic Details Start*/
$resident_category_id = $applicant_basic_details_list['resident_category_id'];
$resident_category_name = $applicant_basic_details_list['resident_category_name'];
$relation_sponser_id = $applicant_basic_details_list['sponsor_relationship_id'];
$relation_sponser_name = $applicant_basic_details_list['sponsor_relationship_name'];
$sponsor_name = $applicant_basic_details_list['sponsor_name'];

$db_residing_country_name = $applicant_basic_details_list['residing_country_name'];
$resident_category_id = $applicant_basic_details_list['resident_category_id'];

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

// Declaration Show
$applicant_name_declaration = $applicant_appln_details_list['applicant_name_declaration'];
$applicant_name_declaration = ($applicant_name_declaration)?$applicant_name_declaration:$first_name;




$ddate = $applicant_appln_details_list['applicant_declaration_date'];
$ddate = ($ddate)?date('d-m-Y',strtotime($ddate)):date('d-m-Y');

//print_r($applicant_course_prefer_details_list);die;
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
      $applicant_course_spec_id[] = $v['splpref_id'];
      $applicant_course_spec_name[] = $v['spec_name'];
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

//print_r($applicant_schooling_details_list);die;
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
//print_r($applicant_payment_details_list);die;
$branch_name = $applicant_payment_details_list['branch_name'];
$dd_cheque_no = $applicant_payment_details_list['dd_cheque_no'];
$dd_cheque_date = $applicant_payment_details_list['dd_cheque_date'];
if($dd_cheque_date) {
  $dd_cheque_date = date('d/m/Y',strtotime($dd_cheque_date));
}
$payment_mode_id = $applicant_payment_details_list['payment_mode_id'];
$bank_name=$applicant_payment_details_list['bank_name'];
$bank_name=isset($bank_name)? $bank_name:'Select Bank Name';
$appln_form_fee = $applicant_appln_details_list['appln_form_fee'];

/* Payment Details End */
$applicant_parentname_declarations = $applicant_appln_details_list['applicant_parentname_declaration'];
$father_namede = $applicant_parent_parent_name[$parent_type_id_father];
$mother_namede = $applicant_parent_parent_name[$parent_type_id_mother];
$guardian_namede = $applicant_parent_parent_name[$parent_type_id_guardian];
$applicant_parentname_declaration = (($applicant_parentname_declarations)?$applicant_parentname_declarations:(($father_namede)?$father_namede:(($mother_namede)?$mother_namede:(($guardian_namede)?$guardian_namede:''))));

$form_wizard_basic_id = FORM_WIZARD_BASIC_ID;
$form_wizard_preference_personal_id = FORM_WIZARD_PREFERENCE_PERSONAL_ID;
$form_wizard_address_id = FORM_WIZARD_ADDRESS_ID; 
$form_wizard_parent_id = FORM_WIZARD_PARENT_ID; 
$form_wizard_academic_id = FORM_WIZARD_ACADEMIC_ID;
$form_wizard_payment_id = FORM_WIZARD_PAYMENT_ID;
$form_wizard_upload_declaration_id = FORM_WIZARD_UPLOAD_DECLARATION_ID;

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

$applicant_address_wizard_id = $applicant_instructions_list[$form_wizard_address_id][0]['form_w_wizard_id'];
$applicant_address_wizard_instructions = $applicant_instructions_list[$applicant_address_wizard_id][0]['instruction'];
if($applicant_address_wizard_instructions) {
  $applicant_address_wizard_instructions = nl2br($applicant_address_wizard_instructions);
} else {
  $applicant_address_wizard_instructions = ' - ';
}
$applicant_address_wizard_percent = $applicant_instructions_list[$form_wizard_address_id][0]['completion_percent'];
$applicant_address_wizard_message = $applicant_instructions_list[$form_wizard_address_id][0]['message'];


$applicant_parent_wizard_id = $applicant_instructions_list[$form_wizard_parent_id][0]['form_w_wizard_id'];
$applicant_parent_wizard_instructions = $applicant_instructions_list[$form_wizard_parent_id][0]['instruction'];
if($applicant_parent_wizard_instructions) {
  $applicant_parent_wizard_instructions = nl2br($applicant_parent_wizard_instructions);
} else {
  $applicant_parent_wizard_instructions = ' - ';
}
$applicant_parent_wizard_percent = $applicant_instructions_list[$form_wizard_parent_id][0]['completion_percent'];
$applicant_parent_wizard_message = $applicant_instructions_list[$form_wizard_parent_id][0]['message'];


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
$applicant_upload_declaration_wizard_id = $applicant_instructions_list[$form_wizard_upload_declaration_id][0]['instruction'];
$applicant_upload_declaration_wizard_instructions = $applicant_instructions_list[$form_wizard_upload_declaration_id][0]['instruction'];
if($applicant_upload_declaration_wizard_instructions) {
  $applicant_upload_declaration_wizard_instructions = nl2br($applicant_upload_declaration_wizard_instructions);
} else {
  $applicant_upload_declaration_wizard_instructions = ' - ';
}
$applicant_upload_declaration_wizard_percent = $applicant_instructions_list[$form_wizard_upload_declaration_id][0]['completion_percent'];
$applicant_upload_declaration_wizard_message = $applicant_instructions_list[$form_wizard_upload_declaration_id][0]['message'];


/* form wizard instruction detail End */

/*CRM ADMIN Edit form start*/
$url = base_url().'international_form?startIndex='.$startIndex;
if($mode_edit == ADMIN_MODE_EDIT)
{
  $url = base_url().'international_form/'.$mode_edit.'/'.$crm_applicant_login_id.'/'.$crm_applicant_personal_det_id.'?startIndex='.$startIndex;;
}
/*CRM ADMIN Edit form start*/

?>
      <div class="row">
        <div class="col-md-1 ml-2">
          <!-- <a href="<?php echo base_url();?>mtech" class="btn btn-primary active w-100 mt-3" role="button" aria-pressed="true">Back</a> -->
          <a href="<?php echo $url;?>" class="btn btn-primary active w-100 mt-3" role="button" aria-pressed="true">Back</a>
        </div>
      </div>
      <div class="row disable-div" id="mtech_form" >
        <div class="col-sm-12" id="InternationalPreviewToPrint">
             <div class="card-body">
                <div class="accordion" id="accordionExample">
                   <div class="card card_print">
                      <div class="card-header" id="headingOne">
                         <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Basic Details <span class="float-right icon_right"></span>
                            </button>
                         </h2>
                      </div><div id="collapseOne" class="collapse show bg-light" aria-labelledby="headingOne" data-parent="#accordionExample">
                         <div class="card-body">
                            <section class="row">
     <div class="row w-100">
                       <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Resident Category
                              <span class="tx-danger">*</span></label>
                            <select class="form-control custom-select study" id="resident_category" name="resident_category" data-parsley-required="true" data-parsley-required-message="Please Choose Resident Category" data-parsley-errors-container="#custom-resident_category-parsley-error" data-parsley-trigger="change">
                                <option value=""><?php echo $resident_category_name; ?></option>
                            </select>
                            <span id="custom-resident_category-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <?php if($resident_category_id == NRI_SPONSERED_VAL) {?>
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force" id="nri_sponser_name">
                            <label class="form-control-label">Name of the Sponsor
                                <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="nrisponser_name" id="nrisponser_name" placeholder="Please Enter Sponsor Name" maxlength="100" data-parsley-required="false" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Sponsor Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 100]" data-parsley-trigger="change" value="<?php echo $sponsor_name;?>">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force" id="nri_relation_sponsor">
                            <label class="form-control-label">Relationship with Applicant
                                <span class="tx-danger">*</span></label>
                                <select class="form-control custom-select study" id="relation_sponser" name="relation_sponser" data-parsley-required="false" data-parsley-required-message="Please Choose Sponsor Relationship" data-parsley-errors-container="#custom-sponsor_relationship-parsley-error" data-parsley-trigger="change">
                                <option value=""><?php echo $relation_sponser_name;?></option>
                                </select>
                            <span id="custom-sponsor_relationship-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                  <?php }?>
          <div class="col-lg-12" id="study_info">
              <p>Declaration <span class="tx-danger">*</span></p>
                <p class="checkbox_instructions">I hereby declare that I belong to NRI / NRI sponsored / Foreign category and wish to process my application under the International admissions category.</p>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="is_agree" id="is_agree" value="<?php echo ($is_agree == 't')?1:0; ?>"  data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHECK_CONFIRM_MSG; ?>" <?php echo ($is_agree == 't')?'checked':0; ?>><label class="custom-control-label" for="is_agree"> I Confirm </label>
                </div>
                <span id="custom-qualifyingexamfromindia-parsley-error"></span>
            </div>
            <div class="form-group formAreaCols col-lg-12" id="resident_info_message"><br/><a
                href="https://intlapplications.srmist.edu.in/international-application-form-2020"><b>https://intlapplications.srmist.edu.in/international-application-form-2020</b></a>
            </div>
    </div>
                              <div class="row w-100">
                                <div class="col-md-12">
                                  <?php if($studied_from_india_id == 'yes') { ?>
                                  <div class="form-group formAreaCols" id="confirm_indian">
                                      <p>
                                          Please note that you have selected "YES" for the
                                          above which implies you are eligible to seek
                                          admission under domestic category. It is the
                                          sole responsibility of the candidate to ensure
                                          that he/she is applying under the right
                                          category.</p>
                                      <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="qualifyingexamfromindia" id="qualifyingexamfromindia" data-parsley-mincheck="1" value="<?php echo ($qualifyexamfromindia == 't')?1:0; ?>" data-parsley-required="true" data-parsley-required-message="Please check and confirm" <?php echo ($qualifyexamfromindia == 't')?'checked':''; ?>><label class="custom-control-label" for="qualifyingexamfromindia"> I Confirm </label>
                                      </div>
                                  </div>
                                <?php } if($studied_from_india_id == 'no') { ?>
                                  <div class="form-group formAreaCols" id="confirm_notindian">
                                      SRMJEEE is not applicable for international
                                      students. Go to the below link to
                                      proceed further.<br><br><a
                                          href="https://intlapplications.srmist.edu.in/international-application-form-2020"><b>https://intlapplications.srmist.edu.in/international-application-form-2020</b></a>
                                  </div>
                                <?php } ?>
                                </div>
                              </div>
                          </section>
                       </div>
                    </div>
                 </div>
                 <div class="card card_print">
                    <div class="card-header" id="headingTwo">
                       <h2 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                          Personal Details
                          </button>
                       </h2>
                    </div>
                    <div id="collapseTwo" class="collapse show bg-light" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">
                        <section class="row">
                          <div class="row w-100">
                            <h5 class="text-primary mb-3 ml-2">Course Preference </h5>
                          </div>
                          <div class="row w-100">
                               <div class="col-lg-4">
                                   <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Level of Program
                                  <span class="tx-danger">*</span></label>
                                <select class="form-control custom-select" id="program_level" name="program_level" data-parsley-required="true" data-parsley-required-message="Please Choose Program Level" data-parsley-errors-container="#custom-program_level-parsley-error" data-parsley-trigger="change">
                                  <option value=""><?php echo $db_grade_name;?></option>
                               </select>
                               <span id="custom-program_level-parsley-error"></span>
                            </div>
                        </div><!-- col-4 --> 
                          </div>
                          <h5 class="text-primary mb-3 ml-2">Perference 1</h5>
                          <div class="row w-100">
                            <div class="col-lg-3" id="main_stream_div1">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Stream
                                      <span class="tx-danger">*</span></label>
                                    <select class="form-control custom-select" id="stream_id_pref1" name="stream_id_pref1" data-parsley-required="true" data-parsley-required-message="Please Choose Stream Preference 1" data-parsley-errors-container="#custom-stream_id_pref1-parsley-error" data-parsley-trigger="change">
                                      <option value=""><?php echo $applicant_course_stream_name[0];?></option>
                                   </select>
                                   <span id="custom-stream_id_pref1-parsley-error"></span>                   
                                </div>
                            </div><!-- col-4 --> 
                          <div class="col-lg-3" id="main_degree_div1">
                              <div class="form-group mg-b-10-force">
                                  <label class="form-control-label">Degree
                                    <span class="tx-danger">*</span></label>
                                  <select class="form-control custom-select" id="deg_id_pref1" name="deg_id_pref1" data-parsley-required="true" data-parsley-required-message="Please Choose Degree Preference 1" data-parsley-errors-container="#custom-deg_id_pref1-parsley-error" data-parsley-trigger="change">
                                     <option value=""><?php echo $applicant_course_deg_name[0];?></option>
                                 </select>
                                 <span id="custom-deg_id_pref1-parsley-error"></span>
                              </div>
                          </div><!-- col-4 --> 
                        <div class="col-lg-3" id="main_course_div1">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Course
                                  <span class="tx-danger">*</span></label>
                                <select class="form-control custom-select" id="course_id_pref1" name="s" data-parsley-required="true" data-parsley-required-message="Please Choose Course Preference 1" data-parsley-errors-container="#custom-course_id_pref1-parsley-error" data-parsley-trigger="change">
                                  <option value=""><?php echo $applicant_course_course_name[0];?></option>
                               </select>
                               <span id="custom-course_id_pref1-parsley-error"></span>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="main_spec_div1">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Specialization</label>
                                <select class="form-control custom-select" id="spec_id_pref1" name="spec_id_pref1" data-parsley-required="false" data-parsley-required-message="Please Choose Specialization Preference 1" data-parsley-errors-container="#custom-spec_id-parsley-error" data-parsley-trigger="change">
                                  <option value=""><?php echo $applicant_course_spec_name[0];?></option>
                               </select>
                               <span id="custom-spec_id_pref1-parsley-error"></span>
                            </div>
                        </div><!-- col-4 -->
                          </div>
                          <h5 class="text-primary mb-3 ml-2">Perference 2</h5>
                          <div class="row w-100">
                            <div class="col-lg-3" id="main_stream_div1">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Stream
                                      <span class="tx-danger">*</span></label>
                                    <select class="form-control custom-select" id="stream_id_pref1" name="stream_id_pref1" data-parsley-required="true" data-parsley-required-message="Please Choose Stream Preference 1" data-parsley-errors-container="#custom-stream_id_pref1-parsley-error" data-parsley-trigger="change">
                                      <option value=""><?php echo $applicant_course_stream_name[1];?></option>
                                   </select>
                                   <span id="custom-stream_id_pref1-parsley-error"></span>                   
                                </div>
                            </div><!-- col-4 --> 
                          <div class="col-lg-3" id="main_degree_div1">
                              <div class="form-group mg-b-10-force">
                                  <label class="form-control-label">Degree
                                    <span class="tx-danger">*</span></label>
                                  <select class="form-control custom-select" id="deg_id_pref1" name="deg_id_pref1" data-parsley-required="true" data-parsley-required-message="Please Choose Degree Preference 1" data-parsley-errors-container="#custom-deg_id_pref1-parsley-error" data-parsley-trigger="change">
                                     <option value=""><?php echo $applicant_course_deg_name[1];?></option>
                                 </select>
                                 <span id="custom-deg_id_pref1-parsley-error"></span>
                              </div>
                          </div><!-- col-4 --> 
                        <div class="col-lg-3" id="main_course_div1">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Course
                                  <span class="tx-danger">*</span></label>
                                <select class="form-control custom-select" id="course_id_pref1" name="s" data-parsley-required="true" data-parsley-required-message="Please Choose Course Preference 1" data-parsley-errors-container="#custom-course_id_pref1-parsley-error" data-parsley-trigger="change">
                                  <option value=""><?php echo $applicant_course_course_name[1];?></option>
                               </select>
                               <span id="custom-course_id_pref1-parsley-error"></span>
                            </div>
                        </div><!-- col-4 -->
                         <div class="col-lg-3" id="main_spec_div1">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Specialization</label>
                                <select class="form-control custom-select" id="spec_id_pref1" name="spec_id_pref1" data-parsley-required="false" data-parsley-required-message="Please Choose Specialization Preference 1" data-parsley-errors-container="#custom-spec_id-parsley-error" data-parsley-trigger="change">
                                  <option value=""><?php echo $applicant_course_spec_name[1];?></option>
                               </select>
                               <span id="custom-spec_id_pref1-parsley-error"></span>
                            </div>
                        </div><!-- col-4 -->
                      </div>
                        <h5 class="text-primary mb-3 ml-2">Perference 3</h5>
                          <div class="row w-100">
                            <div class="col-lg-3" id="main_stream_div1">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Stream
                                      <span class="tx-danger">*</span></label>
                                    <select class="form-control custom-select" id="stream_id_pref1" name="stream_id_pref1" data-parsley-required="true" data-parsley-required-message="Please Choose Stream Preference 1" data-parsley-errors-container="#custom-stream_id_pref1-parsley-error" data-parsley-trigger="change">
                                      <option value=""><?php echo $applicant_course_stream_name[2];?></option>
                                   </select>
                                   <span id="custom-stream_id_pref1-parsley-error"></span>                   
                                </div>
                            </div><!-- col-4 --> 
                          <div class="col-lg-3" id="main_degree_div1">
                              <div class="form-group mg-b-10-force">
                                  <label class="form-control-label">Degree
                                    <span class="tx-danger">*</span></label>
                                  <select class="form-control custom-select" id="deg_id_pref1" name="deg_id_pref1" data-parsley-required="true" data-parsley-required-message="Please Choose Degree Preference 1" data-parsley-errors-container="#custom-deg_id_pref1-parsley-error" data-parsley-trigger="change">
                                     <option value=""><?php echo $applicant_course_deg_name[2];?></option>
                                 </select>
                                 <span id="custom-deg_id_pref1-parsley-error"></span>
                              </div>
                          </div><!-- col-4 --> 
                        <div class="col-lg-3" id="main_course_div1">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Course
                                  <span class="tx-danger">*</span></label>
                                <select class="form-control custom-select" id="course_id_pref1" name="s" data-parsley-required="true" data-parsley-required-message="Please Choose Course Preference 1" data-parsley-errors-container="#custom-course_id_pref1-parsley-error" data-parsley-trigger="change">
                                  <option value=""><?php echo $applicant_course_course_name[2];?></option>
                               </select>
                               <span id="custom-course_id_pref1-parsley-error"></span>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="main_spec_div1">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Specialization</label>
                                <select class="form-control custom-select" id="spec_id_pref1" name="spec_id_pref1" data-parsley-required="false" data-parsley-required-message="Please Choose Specialization Preference 1" data-parsley-errors-container="#custom-spec_id-parsley-error" data-parsley-trigger="change">
                                  <option value=""><?php echo $applicant_course_spec_name[2];?></option>
                               </select>
                               <span id="custom-spec_id_pref1-parsley-error"></span>
                            </div>
                        </div><!-- col-4 -->
                          
                       
                          </div>

                        
                          
                          
                          <div class="row w-100">
                            <h5 class="text-primary mt-4 mb-3 ml-2">Personal Details</h5>
                          </div>
                          <div class="row w-100">
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Title <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_title" id="pd_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="Please Choose Title" data-parsley-errors-container="#custom-pd_title-parsley-error" data-parsley-trigger="change">
                                    <option value=""><?php echo $tittle_name ;?> </option>
                                    </select>
                                    <span id="custom-pd_title-parsley-error"></span>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">First Name <span class="tx-danger"> *</span></label>
                                    <input class="form-control" type="text" name="pd_firstname" id="pd_firstname" placeholder="Your First Name" maxlength="100" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter First Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 100]" value="<?php echo $first_name; ?>" data-parsley-trigger="change">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Middle Name </label>
                                    <input class="form-control" type="text" name="pd_middlename" id="pd_middlename" placeholder="Your Middle Name" value="<?php echo $m_name; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" maxlength="50" data-parsley-trigger="change">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Last Name <span class="tx-danger"> *</span></label>
                                    <input class="form-control" type="text" name="pd_lastname" id="pd_lastname" placeholder="Your Last Name" maxlength="50" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Last Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" value="<?php echo $last_name; ?>" data-parsley-trigger="change">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-4">
                                <label class="form-control-label">Mobile No <span class="tx-danger"> *</span></label>
                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                  <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                      <select class="form-control form_control custom-select Mobile_number" id="phone_no_code" name="phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                          <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected><?php echo $applicant_mob_country_code_id ;?></option>
                                      </select>
                                  </span>
                                  <input type="text" name="pd_mobile_no" id="pd_mobile_no" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Mobile No" class="form-control" data-parsley-required="true" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-errors-container="#custom-pd_mobile_no-parsley-error" value="<?php echo $mob_no; ?>" data-parsley-trigger="change">
                                </div>
                                <span id="custom-pd_mobile_no-parsley-error"></span>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Email ID <span class="tx-danger"> *</span></label>
                                    <input class="form-control" type="email" name="pd_email" id="pd_email" placeholder="Your email id." data-parsley-required="true" data-parsley-required-message="Please Enter Email ID" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Email ID" data-parsley-errors-container="#custom-pd_email-parsley-error" value="<?php echo $email_id; ?>" data-parsley-trigger="change">
                                    <span id="custom-pd_email-parsley-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="wd-200 w-100">
                                    <label class="form-control-label">Date of Birth <span class="tx-danger"> *</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                        <input type="text" class="form-control hasDatepicker" name="pd_dob" id="pd_dob" placeholder="DD/MM/YYYY" value="<?php echo  $dob; ?>" readonly data-parsley-required="true" data-parsley-required-message="Please Enter Date of Birth" data-parsley-errors-container="#custom-pd_dob-parsley-error" data-parsley-trigger="change focusout">
                                    </div>
                                    <span id="custom-pd_dob-parsley-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Gender <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Gender" tabindex="-1" aria-hidden="true" name="pd_gender" id="pd_gender" title="Choose Gender" data-parsley-required="true" data-parsley-required-message="Please Choose Gender" data-parsley-errors-container="#custom-pd_gender-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $gender ;?></option>
                                    </select>
                                    <span id="custom-pd_gender-parsley-error"></span>
                                </div>
                            </div><!-- col-4 -->
                          </div>
                            
                            <div class="row w-100">
                            
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Nationality <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Nationality" tabindex="-1" aria-hidden="true" name="pd_nationality" id="pd_nationality" title="Choose Nationality" data-parsley-required="true" data-parsley-required-message="Please Choose Nationality" data-parsley-errors-container="#custom-pd_nationality-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $nationality_name;?></option>
                                    </select>
                                    <span id="custom-pd_nationality-parsley-error"></span>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                          <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Country of Residence of Applicant<span
                            class="tx-danger">*</span></label>
                            <select class="form-control select2"
                        data-placeholder="Choose Country" tabindex="-1" aria-hidden="true" id="residing_country_id" name="residing_country_id" data-parsley-required="true" data-parsley-required-message="Please Choose Country" data-parsley-errors-container="#custom-pd_country-parsley-error" data-parsley-trigger="change">
                        <option value=""><?php echo $db_residing_country_name;?></option>
                    </select>
                    <span id="custom-pd_country-parsley-error"></span>
                    </div>
            </div><!-- col-4 -->   
                            
                              
                        </div><!-- row -->
                        </section>
                      </div>
                    </div>
                </div>
                <div class="card card_print">
                    <div class="card-header" id="headingThree">
                       <h2 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                          Parent Details
                          </button>
                       </h2>
                    </div>
                    <div id="collapseThree" class="collapse show bg-light" aria-labelledby="headingThree" data-parent="#accordionExample">
                       <div class="card-body">
                          <section class="row">
                            <div class="row w-100">
                                <h5 class="text-primary mb-3 ml-2">Parent's / Guardian's Details</h5>
                            </div>
                            <div class="row mg-b-25 mt-3 w-100">
                         <div class="col-lg-4">
                          <div class="form-group">
                            <label class="form-control-label">Parent's / Guardian's Name <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="pd_guardian_name" id="pd_guardian_name" placeholder="Enter Your Guardian Name" maxlength="<?php echo APLCT_GUARDIAN_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_GUARDIAN_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_GUARDIAN_NAME_MINLENGTH; ?>, <?php echo APLCT_GUARDIAN_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_guardian]; ?>">
                            <input type="hidden" name="pd_guardian_id" id="pd_guardian_id" value="<?php echo $app_parent_det_id[$parent_type_id_guardian]; ?>" />
                          </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <label class="form-control-label">Parent's / Guardian's Contact No <span class="tx-danger">*</span></label>
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
                            <label class="form-control-label">Parent's / Guardian's Email ID <span class="tx-danger">*</span></label>
                            <input class="form-control" type="email" name="pd_guardian_email" id="pd_guardian_email"  placeholder="Enter Your Guardian's Email ID"data-parsley-required="true" data-parsley-required-message="<?php echo REQD_GUARDIAN_EMAIL_MSG;?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_GUARDIAN_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_guardian_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_guardian]; ?>" maxlength="<?php echo APLCT_GUARDIAN_EMAIL_MAXLENGTH; ?>">
                            <span id="custom-pd_guardian_email-parsley-error"></span>
                            <span id="suggestion_guardian_email"></span>
                        </div>
                    </div>
                  <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Parent's / Guardian's Occupation</label>
                            <select class="form-control select2" data-placeholder="Choose Guardian Occupation" tabindex="-1" aria-hidden="true" name="pd_guardian_occupation" id="pd_guardian_occupation">
                              <option value=""><?php echo $applicant_parent_occupation_name[$parent_type_id_guardian];?></option>
                            </select>
                        </div>
                        <?php if($applicant_parent_other_occupation_name[$parent_type_id_guardian]){?>
                        <div id="other_occupation_guardian_div">
                          <input class="form-control" type="text" name="other_occupation_guardian" id="other_occupation_guardian"  placeholder="If Other, pls enter here"data-parsley-required="false" data-parsley-errors-container="#custom-other_occupation_guardian-parsley-error" value="<?php echo $applicant_parent_other_occupation_name[$parent_type_id_guardian]; ?>">
                          <span id="custom-other_occupation_guardian-parsley-error"></span>
                        </div>
                      <?php } ?>
                 </div><!-- col-4 -->
                 <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Relationship with Applicant <span class="tx-danger">*</span></label>
                            <select class="form-control select2" data-placeholder="Choose Relationship Applicant" tabindex="-1" aria-hidden="true" name="parent_relation_applicant" id="parent_relation_applicant" data-parsley-required="true" data-parsley-required-message="Please Choose Relationship Applicant" data-parsley-errors-container="#custom-parent_relation_applicant-parsley-error">
                              <option value=""><?php echo $applicant_parent_relationship_name[$parent_type_id_guardian];?></option>
                            </select>
                            <span id="custom-parent_relation_applicant-parsley-error"></span>

                        </div>
                 </div><!-- col-4 -->
            </div><!-- row --> 
            <br/>
            <div>
            </div>
                           
                            
                            <?php if (!empty($add_gardian) && $add_gardian=='t') { ?>
                            <div class="row w-100 ml-2">
                              <label class="ckbox add_guardian_checkbox">
                                <div class="custom-control custom-checkbox">
                                  <input class="custom-control-input" type="checkbox" name="add_guardian_checkbox" id="add_guardian_checkbox" value="<?php echo ($add_gardian == 't')?'true':'false'; ?>" <?php echo ($add_gardian == 't')?'checked':''; ?>><label class="custom-control-label" for="add_guardian_checkbox"> Add Parent </label>
                                </div>
                              </label>
                            </div>
                            <div class="row w-100" id="guardian_details">
                              <div class="col-sm-12">
                                <div id="parent_details">
                                   <div class="row w-100">
                                    <h5 class="text-primary mb-3 ml-2">Parent's Details</h5>
                                   </div>
                                   <div class="row w-100">
                                      <div class="col-lg-3">
                                          <div class="form-group">
                                          <label class="form-control-label">Father's Name <!-- <span class="tx-danger">*</span> --></label>
                                          <input class="form-control" type="text" name="pd_father_name" id="pd_father_name" placeholder="Enter Your Father Name" maxlength="<?php echo APLCT_FATHER_NAME_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_FATHER_NAME_MINLENGTH; ?>, <?php echo APLCT_FATHER_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_father]; ?>" />
                                      <input type="hidden" name="pd_father_id" id="pd_father_id" value="<?php echo $app_parent_det_id[$parent_type_id_father]; ?>" />
                                    </div>
                                  </div><!-- col-4 -->
                    <div class="col-lg-3">
                        <label class="form-control-label">Father's Mobile No <!-- <span class="tx-danger">*</span> --></label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="pd_father_phone_no_code" name="pd_father_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                            <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                          </select>
                        </span>
                        <input type="text" class="form-control" name="pd_father_phone" id="pd_father_phone" maxlength="<?php echo APLCT_FATHER_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_FATHER_MOBILE_MSG;?>" data-parsley-maxlength-message="<?php echo VALID_FATHER_MOBILE_MSG;?>" data-parsley-errors-container="#custom-pd_father_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no[$parent_type_id_father]; ?>" data-parsley-notequalto="#pd_mother_phone" data-parsley-notequalto-message="<?php echo PHONE_MATCH_FATHER; ?>" data-parsley-mobileonly="true">
                      </div>
                      <span id="custom-pd_father_phone-parsley-error"></span>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Father's Email ID </label>
                          <input class="form-control" type="email" name="pd_father_email" id="pd_father_email"  placeholder="Enter Your Father's Email ID" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_EMAIL_MSG;?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_FATHER_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_father_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_father]; ?>" maxlength="<?php echo APLCT_FATHER_EMAIL_MAXLENGTH; ?>" data-parsley-notequalto="#pd_mother_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_FATHER; ?>">
                        <span id="custom-pd_father_email-parsley-error"></span>
                        <span id="suggestion_father_email"></span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Father's Occupation</label>
                        <select class="form-control select2" data-placeholder="Choose Occupation" tabindex="-1" aria-hidden="true" name="pd_father_occupation" id="pd_father_occupation">
                          <option value=""><?php echo $applicant_parent_occupation_name[$parent_type_id_father] ?></option>
                        </select>
                      </div>
                      <?php if( $applicant_parent_other_occupation_name[$parent_type_id_father]){?>
                      <div id="other_occupation_father_div">
                        <input class="form-control" type="text" name="other_occupation_father" id="other_occupation_father"  placeholder="If Other, pls enter here"data-parsley-required="false" data-parsley-errors-container="#custom-other_occupation_father-parsley-error" value="<?php echo $applicant_parent_other_occupation_name[$parent_type_id_father]; ?>">
                        <span id="custom-other_occupation_father-parsley-error"></span>
                      </div>
                    <?php }?>
                    </div><!-- col-4 -->
                </div><!-- row -->
                <div class="row w-100">
                  <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label">Mother's Name<!--  <span class="tx-danger">*</span> --></label>
                          <input type="text" class="form-control" name="pd_mother_name" id="pd_mother_name" placeholder="Enter Your Mother's Name" maxlength="<?php echo APLCT_MOTHER_NAME_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_MOTHER_NAME_MINLENGTH; ?>, <?php echo APLCT_MOTHER_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_mother]; ?>">
                        </div>
                        <input type="hidden" name="pd_mother_id" id="pd_mother_id"  value="<?php echo $app_parent_det_id[$parent_type_id_mother]; ?>" />
                    </div><!-- col-4 -->
                    <div class="col-lg-3" id="mother_mbleno_div">
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
                    <div class="col-lg-3" id="mother_email_div">
                        <div class="form-group">
                            <label class="form-control-label">Mother's Email ID </label>
                            <input class="form-control" type="email" name="pd_mother_email" id="pd_mother_email"  placeholder="Enter Your Mother's Email ID"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_EMAIL_MSG;?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_MOTHER_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_mother_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_mother]; ?>" maxlength="<?php echo APLCT_MOTHER_EMAIL_MAXLENGTH; ?>" data-parsley-notequalto="#pd_father_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_MOTHER; ?>">
                            <span id="custom-pd_mother_email-parsley-error"></span>
                            <span id="suggestion_mother_email"></span>
                        </div>
                    </div>
                    <div class="col-lg-3" id="mother_occupation_div">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Mother's Occupation</label>
                            <select class="form-control select2" data-placeholder="Choose Occupation" tabindex="-1" aria-hidden="true" name="pd_mother_occupation" id="pd_mother_occupation">
                              <option value=""><?php echo $applicant_parent_occupation_name[$parent_type_id_mother];?></option>
                            </select>
                        </div>
                        <?php if($applicant_parent_other_occupation_name[$parent_type_id_mother]){?>
                        <div id="other_occupation_mother_div">
                          <input class="form-control" type="text" name="other_occupation_mother" id="other_occupation_mother"  placeholder="If Other, pls enter here"data-parsley-required="false" data-parsley-errors-container="#custom-other_occupation_mother-parsley-error" value="<?php echo $applicant_parent_other_occupation_name[$parent_type_id_mother]; ?>">
                          <span id="custom-other_occupation_mother-parsley-error"></span>
                        </div>
                      <?php } ?>
                    </div><!-- col-4 -->
                </div>
                                </div>
                              </div>
                            </div>
                            <?php } ?>
                          </section>
                        </div>
                      </div>
                </div>
                  <div class="card card_print">
                    <div class="card-header" id="headingThree">
                       <h2 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                          Address Details
                          </button>
                       </h2>
                    </div>
                    <div id="collapseThree" class="collapse show bg-light" aria-labelledby="headingThree" data-parent="#accordionExample">
                       <div class="card-body">
                          <section class="row">
                            <div class="row w-100">
                              <div class="col-lg-3">
                                  <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Country<span class="tx-danger"> *</span></label>
                                      <select class="form-control select2" data-placeholder="Choose country" tabindex="-1" aria-hidden="true" name="country" id="country" title="Choose Country" data-parsley-required="true" data-parsley-required-message="Please Choose Country" data-parsley-errors-container="#custom-country-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $country_name[$communication_look_up_value]; ?></option>
                                      </select>
                                      <span id="custom-country-parsley-error"></span>
                                  </div>
                              </div><!-- col-4 -->                              
                              <div class="col-lg-3" id="main_div_state">
                                  <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">State<span class="tx-danger"> *</span></label>
                                      <select class="form-control select2" data-placeholder="Choose State" tabindex="-1" aria-hidden="true" name="state" id="state" title="Choose State" data-parsley-required="true" data-parsley-required-message="Please Choose State" data-parsley-errors-container="#custom-state-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $state_name[$communication_look_up_value]; ?></option>
                                      </select>
                                      <span id="custom-state-parsley-error"></span>
                                  </div>
                              </div><!-- col-4 -->                              
                              <div class="col-lg-3" id="main_div_city">
                                  <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">City<span class="tx-danger"> *</span></label>
                                      <select class="form-control select2" data-placeholder="Choose City" tabindex="-1" aria-hidden="false" name="city" id="city" title="Choose City" data-parsley-required="true" data-parsley-required-message="Please Choose City" data-parsley-errors-container="#custom-city-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $city_name[$communication_look_up_value]; ?></option>
                                      </select>
                                      <span id="custom-city-parsley-error"></span>
                                  </div>
                              </div><!-- col-4 -->                             
                            </div>
                            <div class="row w-100">
                              <div class="col-lg-4">
                                  <div class="form-group">
                                      <label class="form-control-label">Address Line 1 <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="address_line1" id="address_line1" placeholder="Enter Address Line 1" data-parsley-required="true" data-parsley-required-message="Please Enter Address" value="<?php echo $communication_addr_line_1; ?>" data-parsley-maxlength="100" maxlength="100">
                                  </div>
                              </div><!-- col-4 -->
                              <div class="col-lg-4">
                                  <div class="form-group">
                                      <label class="form-control-label">Address Line 2 <!--<span class="tx-danger">*</span>--></label>
                                      <input class="form-control" type="text" name="address_line2" id="address_line2" placeholder="Enter Address Line 2" value="<?php echo $communication_addr_line_2; ?>" data-parsley-maxlength="100" maxlength="100">
                                  </div>
                              </div><!-- col-4 -->
                              <div class="col-lg-4">
                                  <div class="form-group">
                                      <label class="form-control-label">Pincode <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Pincode" data-parsley-required="true" data-parsley-required-message="Please Enter Pincode" value="<?php echo $communication_pincode; ?>" data-parsley-maxlength="10" maxlength="10">
                                  </div>
                              </div><!-- col-4 -->

                            </div><!-- row -->
                            <div class="row w-100">  
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="d-block mb-3 w-100 text-left">Is Permanent Address same as Address for Communication? *</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="is_permanent_addr_same_yes" name="is_permanent_addr_same" class="custom-control-input" <?php echo ($is_permanent_addr_same == 't')?'checked':''; ?> value="yes" checked>
                            <label class="custom-control-label" for="is_permanent_addr_same_yes">Yes</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="is_permanent_addr_same_no" name="is_permanent_addr_same" class="custom-control-input" <?php echo ($is_permanent_addr_same == 'f')?'checked':''; ?> value="no">
                            <label class="custom-control-label" for="is_permanent_addr_same_no">No</label>
                        </div>
                    </div>
                </div>
      </div>    
      
      <?php if($is_permanent_addr_same == 't') { ?>
        <div class="row w-100">
                      <div class="col-lg-4">
                          <div class="form-group mg-b-10-force">
                              <label class="form-control-label">Country<span class="tx-danger"> *</span></label>
                              <select class="form-control select2" data-placeholder="Choose country" tabindex="-1" aria-hidden="true" name="country_pa" id="country_pa" title="Choose Country" data-parsley-required="true" data-parsley-required-message="Please Choose Country" data-parsley-errors-container="#custom-country_pa-parsley-error" data-parsley-trigger="change">
                                <option value=""><?php echo $country_name[$communication_look_up_value_permanent]; ?> </option>
                              </select>
                              <span id="custom-country_pa-parsley-error"></span>
                          </div>
                      </div><!-- col-4 -->
                      <div class="col-lg-4" id="main_div_state_pa">
                          <div class="form-group mg-b-10-force">
                              <label class="form-control-label">State<span class="tx-danger"> *</span></label>
                              <select class="form-control select2" data-placeholder="Choose State" tabindex="-1" aria-hidden="true" name="state_pa" id="state_pa" title="Choose State" data-parsley-required="true" data-parsley-required-message="Please Choose State" data-parsley-errors-container="#custom-state_pa-parsley-error" data-parsley-trigger="change">
                                <option value=""><?php echo $state_name[$communication_look_up_value_permanent]; ?></option>                  
                              </select>
                              <span id="custom-state_pa-parsley-error"></span>
                          </div>
                      </div><!-- col-4 -->
                      <div class="col-lg-4" id="main_div_city_pa">
                          <div class="form-group mg-b-10-force">
                              <label class="form-control-label">City<span class="tx-danger"> *</span></label>
                              <select class="form-control select2" data-placeholder="Choose City" tabindex="-1" aria-hidden="false" name="city_pa" id="city_pa" title="Choose City" data-parsley-required="true" data-parsley-required-message="Please Choose City" data-parsley-errors-container="#custom-city_pa-parsley-error" data-parsley-trigger="change">
                                <option value=""><?php echo $city_name[$communication_look_up_value_permanent]; ?></option>
                  <option value="39">Chennai</option>
                              </select>
                              <span id="custom-city_pa-parsley-error"></span>
                          </div>
                      </div><!-- col-4 -->
                  </div>
                  <div class="row w-100">
                      <div class="col-lg-4">
                          <div class="form-group">
                              <label class="form-control-label">Address Line 1 <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="address_line1_pa" id="address_line1_pa" placeholder="Enter Address Line 1" data-parsley-required="true" data-parsley-required-message="Please Enter Address"  data-parsley-maxlength="100" maxlength="100" value="<?php echo $permanent_addr_line_1; ?>">
                          </div>
                      </div><!-- col-4 -->
                      <div class="col-lg-4">
                          <div class="form-group">
                              <label class="form-control-label">Address Line 2 <!--<span class="tx-danger">*</span>--></label>
                              <input class="form-control" type="text" name="address_line2_pa" id="address_line2_pa" placeholder="Enter Address Line 2" data-parsley-maxlength="100" maxlength="100" value="<?php echo $permanent_addr_line_2; ?>">
                          </div>
                      </div><!-- col-4 -->
                      <div class="col-lg-4">
                          <div class="form-group">
                              <label class="form-control-label">Pincode <span class="tx-danger">*</span></label>
                              <input class="form-control" type="text" name="pincode_pa" id="pincode_pa" placeholder="Enter Pincode" data-parsley-required="true" data-parsley-required-message="Please Enter Pincode" data-parsley-maxlength="6" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Pincode" maxlength="6" value="<?php echo $permanent_pincode; ?>">
                          </div>
                      </div><!-- col-4 -->
                  </div><!-- row -->  
        <?php } ?>
      
                          </section>
                       </div>
                    </div>
                 </div>
                 <div class="card card_print">
                    <div class="card-header" id="headingFour">
                       <h2 class="mb-0">
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                          Academic Details
                          </button>
                       </h2>
                    </div>
                    <div id="collapseFour" class="collapse show bg-light" aria-labelledby="headingThree" data-parent="#accordionExample">
                       <div class="card-body">
                          <div class="row">
                            
                            <div class="col-lg-6 ">
                                   <div class="form-group wd-xs-300 mr-5 w-100">
                            <label class="form-control-label">Applicant Name as per Qualifying Exam
                            <span class="tx-danger">*</span></label>
                            <div class="form-group mg-b-10-force">
                            <input class="form-control" type="text" name="canditate_name" id="canditate_name" placeholder="Enter Name" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Qualifying Exam Name" data-parsley-nameonly-message="Please Enter Qualifying Exam Name" data-parsley-length="[<?php echo APLCT_CAND_NAME_MINLENGTH; ?>, <?php echo APLCT_CAND_NAME_MAXLENGTH; ?>]"  maxlength="<?php echo APLCT_CAND_NAME_MAXLENGTH; ?>" data-parsley-trigger="change" value="<?php echo $applicant_tenth_name[0];?>">
                        <!-- <small id="emailHelp" class="form-text text-muted">Kindly type “NA” in case 10th Certificate is not available with you.</small> -->
                            </div>
                        </div><!-- form-group -->
                        </div>
                            </div>
                  </div>
              <p class="mb-3 ml-2">Qualifying Examinations: E.G: CBSE, “A” LEVELS, IB Diploma, STPM, HIGH SCHOOL and COLLEGE GRADES etc.  </p>
                          <section class="row">
                            <div class="table-responsive">
  <table class="table table-bordered mt-0">
    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Country</th>
            <th>School</th>
            <th>Examination</th>
            <th>Month and Year of Passing</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p class="mb-3 ml-2">Exam</p>
            </td>
            <td>
               <select class="form-control custom-select" id="academic_country" name="academic_country" data-placeholder="Choose Country" data-parsley-required="false" data-parsley-required-message="Please Choose Country" data-parsley-errors-container="#custom-academic_country-parsley-error">
                <option value=""><?php echo $applicant_scl_country_name[0] ;?></option>
               </select>
               <span id="custom-academic_country-parsley-error"></span>
            </td>
            <td>
                <div class="form-group mg-b-10-force">
                    <input class="form-control" type="text" name="academic_school_name" id="academic_school_name" placeholder="Enter School Name" data-parsley-required="false" data-parsley-nameonly="true" data-parsley-required-message="Please Enter School Name" data-parsley-trigger="change" value="<?php echo $applicant_institute_name[0];?>">
                      <!-- <span class="tx-danger required_asterisk">*</span> -->
                </div>
            </td>
           
            <td>
                <div class="form-group mg-b-10-force" id="appering_info_1">
                    <select class="form-control custom-select" id="academic_exam" name="academic_exam" data-placeholder="Choose Examination" data-parsley-required="false" data-parsley-required-message="Please Choose Examination" data-parsley-errors-container="#custom-academic_country-parsley-error">
                    <option value=""><?php echo $applicant_scl_exam_name[0] ;?></option>
                    </select>
               <span id="custom-academic_country-parsley-error"></span>
                </div>
            </td>
            <td>
                <input class="form-control" type="text" name="academic_month_year_pass" id="academic_month_year_pass" placeholder="Enter Year Passing" data-parsley-required="false" data-parsley-trigger="change" autocomplete="off" value="<?php echo $applicant_year_of_passing[0];?>">
            </td>
           
        </tr>
    </tbody>
  </table>
  </div>

  <p class="mb-3 ml-2">Please enter the subjects that you have taken in the relevant Qualifying Exam with their corresponding Marks/Grade</p>
  <div class="table-responsive">
  <table class="table table-bordered mt-0">
    <thead class="thead-light">
        <tr>
            <th></th>
            <th>Subject</th>
            <th>Marking Scheme</th>
            <th>Obtained Percentage /CGPA /Grade</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <p>1 <input type="hidden" name="schooling_id_1" id="schooling_id_1" value="<?php echo $applicant_scl_det_id[0]; ?>" ></p>
            </td>
            <td>
                <select class="form-control custom-select" id="academic_subject1" name="academic_subject1" data-placeholder="Choose Subject" data-parsley-required="false" data-parsley-required-message="Please Choose Subject" data-parsley-errors-container="#custom-academic_subject-parsley-error">
                    <option value=""><?php echo $applicant_scl_subject_name[0]; ?></option>
                    </select>
               <span id="custom-academic_subject1-parsley-error"></span>
            </td>
            <td>
                <select class="form-control custom-select" id="marking_scheme1" name="marking_scheme1" data-placeholder="Choose Marking Scheme" data-parsley-required="false" data-parsley-required-message="Please Choose Subject" data-parsley-errors-container="#custom-marking_scheme-parsley-error">
                    <option value=""><?php echo $applicant_marking_scheme_name[0]; ?></option>
                    </select>
               <span id="custom-marking_scheme1-parsley-error"></span>
            </td>
            <td>
                <input class="form-control" id="obtained_percentage_cgpa1" type="text" name="obtained_percentage_cgpa1" placeholder="Enter Obtained Percentage/CGPA/Grade"  data-parsley-required="false" data-parsley-required-message="Please Enter Obtained Percentage/CGPA Grade" data-parsley-errors-container="#custom-obtained_percentage_cgpa1-parsley-error" value="<?php echo $applicant_obtained_percentage_cgpa[0];?>">
                <span id="custom-obtained_percentage_cgpa1-parsley-error"></span>
            </td>
        </tr>
        <tr>
            <td>
                <p>2 <input type="hidden" name="schooling_id_2" id="schooling_id_2" value="<?php echo $applicant_scl_det_id[1]; ?>" ></p>
            </td>
            <td>
                <select class="form-control custom-select" id="academic_subject2" name="academic_subject2" data-placeholder="Choose Subject" data-parsley-required="false" data-parsley-required-message="Please Choose Subject" data-parsley-errors-container="#custom-academic_subject2-parsley-error">
                    <option value=""><?php echo $applicant_scl_subject_name[1]; ?></option>
                    </select>
               <span id="custom-academic_subject2-parsley-error"></span>
            </td>
            <td>
                <select class="form-control custom-select" id="marking_scheme2" name="marking_scheme2" data-placeholder="Choose Marking Scheme" data-parsley-required="false" data-parsley-required-message="Please Choose Subject" data-parsley-errors-container="#custom-marking_scheme2-parsley-error">
                    <option value=""><?php echo $applicant_marking_scheme_name[1]; ?></option>
                    </select>
               <span id="custom-marking_scheme2-parsley-error"></span>
            </td>
            <td>
                <input class="form-control" id="obtained_percentage_cgpa2" type="text" name="obtained_percentage_cgpa2" placeholder="Enter Obtained Percentage/CGPA/Grade"  data-parsley-required="false" data-parsley-required-message="Please Enter Obtained Percentage/CGPA Grade" data-parsley-errors-container="#custom-obtained_percentage_cgpa2-parsley-error" value="<?php echo $applicant_obtained_percentage_cgpa[1]; ?>">
                <span id="custom-obtained_percentage_cgpa2-parsley-error"></span>
            </td>
        </tr>
        <tr>
            <td>
                <p>3 <input type="hidden" name="schooling_id_3" id="schooling_id_3" value="<?php echo $applicant_scl_det_id[2]; ?>" ></p>
            </td>
            <td>
                <select class="form-control custom-select" id="academic_subject3" name="academic_subject3" data-placeholder="Choose Subject" data-parsley-required="false" data-parsley-required-message="Please Choose Subject" data-parsley-errors-container="#custom-academic_subject3-parsley-error">
                    <option value=""><?php echo $applicant_scl_subject_name[2]; ?></option>
                    </select>
               <span id="custom-academic_subject3-parsley-error"></span>
            </td>
            <td>
                <select class="form-control custom-select" id="marking_scheme3" name="marking_scheme3" data-placeholder="Choose Marking Scheme" data-parsley-required="false" data-parsley-required-message="Please Choose Marking Scheme" data-parsley-errors-container="#custom-marking_scheme3-parsley-error">
                    <option value=""><?php echo $applicant_marking_scheme_name[2]; ?></option>
                    </select>
               <span id="custom-marking_scheme3-parsley-error"></span>
            </td>
            <td>
                <input class="form-control" id="obtained_percentage_cgpa3" type="text" name="obtained_percentage_cgpa3" placeholder="Enter Obtained Percentage/CGPA/Grade"  data-parsley-required="false" data-parsley-required-message="Please Enter Obtained Percentage/CGPA Grade" data-parsley-errors-container="#custom-obtained_percentage_cgpa3-parsley-error" value="<?php echo $applicant_obtained_percentage_cgpa[2]; ?>">
                <span id="custom-obtained_percentage_cgpa3-parsley-error"></span>
            </td>
        </tr>
        <tr>
            <td>
                <p>4<input type="hidden" name="schooling_id_4" id="schooling_id_4" value="<?php echo $applicant_scl_det_id[3]; ?>" ></p>
            </td>
            <td>
                <select class="form-control custom-select" id="academic_subject4" name="academic_subject4" data-placeholder="Choose Subject" data-parsley-required="false" data-parsley-required-message="Please Choose Subject" data-parsley-errors-container="#custom-academic_subject4-parsley-error">
                    <option value=""><?php echo $applicant_scl_subject_name[3]; ?></option>
                    </select>
               <span id="custom-academic_subject4-parsley-error"></span>
            </td>
            <td>
                <select class="form-control custom-select" id="marking_scheme4" name="marking_scheme4" data-placeholder="Choose Marking Scheme" data-parsley-required="false" data-parsley-required-message="Please Choose Marking Scheme" data-parsley-errors-container="#custom-marking_scheme4-parsley-error">
                    <option value=""><?php echo $applicant_marking_scheme_name[3]; ?></option>
                    </select>
               <span id="custom-marking_scheme4-parsley-error"></span>
            </td>
            <td>
                <input class="form-control" id="obtained_percentage_cgpa4" type="text" name="obtained_percentage_cgpa4" placeholder="Enter Obtained Percentage/CGPA/Grade"  data-parsley-required="false" data-parsley-required-message="Please Enter Obtained Percentage/CGPA Grade" data-parsley-errors-container="#custom-obtained_percentage_cgpa4-parsley-error" value="<?php echo $applicant_obtained_percentage_cgpa[3]; ?>">
                <span id="custom-obtained_percentage_cgpa4-parsley-error"></span>
            </td>
        </tr>
        <tr>
            <td>
                <p>5 <input type="hidden" name="schooling_id_5" id="schooling_id_5" value="<?php echo $applicant_scl_det_id[4]; ?>" ></p>
            </td>
            <td>
                <select class="form-control custom-select" id="academic_subject5" name="academic_subject5" data-placeholder="Choose Subject" data-parsley-required="false" data-parsley-required-message="Please Choose Subject" data-parsley-errors-container="#custom-academic_subject5-parsley-error">
                    <option value=""><?php echo $applicant_scl_subject_name[4]; ?></option>
                    </select>
               <span id="custom-academic_subject5-parsley-error"></span>
            </td>
            <td>
                <select class="form-control custom-select" id="marking_scheme5" name="marking_scheme5" data-placeholder="Choose Marking Scheme" data-parsley-required="false" data-parsley-required-message="Please Choose Marking Scheme" data-parsley-errors-container="#custom-marking_scheme5-parsley-error">
                    <option value=""><?php echo $applicant_marking_scheme_name[4]; ?></option>
                    </select>
               <span id="custom-marking_scheme5-parsley-error"></span>
            </td>
            <td>
                <input class="form-control" id="obtained_percentage_cgpa5" type="text" name="obtained_percentage_cgpa5" placeholder="Enter Obtained Percentage/CGPA/Grade" data-parsley-required="false" data-parsley-required-message="Please Enter Obtained Percentage/CGPA Grade" data-parsley-errors-container="#custom-obtained_percentage_cgpa5-parsley-error" value="<?php echo $applicant_obtained_percentage_cgpa[4]; ?>">
                <span id="custom-obtained_percentage_cgpa5-parsley-error"></span>
            </td>
        </tr>
        <tr>
            <td>
                <p>6 <input type="hidden" name="schooling_id_6" id="schooling_id_6" value="<?php echo $applicant_scl_det_id[5]; ?>" ></p>
            </td>
            <td>
                <select class="form-control custom-select" id="academic_subject6" name="academic_subject6" data-placeholder="Choose Subject" data-parsley-required="false" data-parsley-required-message="Please Choose Subject" data-parsley-errors-container="#custom-academic_subject6-parsley-error">
                    <option value=""><?php echo $applicant_scl_subject_name[5]; ?></option>
                    </select>
               <span id="custom-academic_subject6-parsley-error"></span>
            </td>
            <td>
                <select class="form-control custom-select" id="marking_scheme6" name="marking_scheme6" data-placeholder="Choose Marking Scheme" data-parsley-required="false" data-parsley-required-message="Please Choose Subject" data-parsley-errors-container="#custom-marking_scheme6-parsley-error">
                    <option value=""><?php echo $applicant_marking_scheme_name[5]; ?></option>
                    </select>
               <span id="custom-marking_scheme6-parsley-error"></span>
            </td>
            <td>
                <input class="form-control" id="obtained_percentage_cgpa6" type="text" name="obtained_percentage_cgpa6" placeholder="Enter Obtained Percentage/CGPA/Grade" data-parsley-required="false" data-parsley-required-message="Please Enter Obtained Percentage/CGPA Grade" data-parsley-errors-container="#custom-obtained_percentage_cgpa6-parsley-error" value="<?php echo $applicant_obtained_percentage_cgpa[5]; ?>">
                <span id="custom-obtained_percentage_cgpa6-parsley-error"></span>
            </td>
        </tr>
        <tr>
            <td>
                <p>7 <input type="hidden" name="schooling_id_7" id="schooling_id_7" value="<?php echo $applicant_scl_det_id[6]; ?>" ></p>
            </td>
            <td>
                <select class="form-control custom-select" id="academic_subject7" name="academic_subject7" data-placeholder="Choose Subject" data-parsley-required="false" data-parsley-required-message="Please Choose Subject" data-parsley-errors-container="#custom-academic_subject7-parsley-error">
                    <option value=""><?php echo $applicant_scl_subject_name[6]; ?></option>
                    </select>
               <span id="custom-academic_subject7-parsley-error"></span>
            </td>
            <td>
                <select class="form-control custom-select" id="marking_scheme7" name="marking_scheme7" data-placeholder="Choose Marking Scheme" data-parsley-required="false" data-parsley-required-message="Please Choose Subject" data-parsley-errors-container="#custom-marking_scheme7-parsley-error">
                    <option value=""><?php echo $applicant_marking_scheme_name[6]; ?></option>
                    </select>
               <span id="custom-marking_scheme7-parsley-error"></span>
            </td>
            <td>
                <input class="form-control" id="obtained_percentage_cgpa7" type="text" name="obtained_percentage_cgpa7" placeholder="Enter Obtained Percentage/CGPA/Grade" data-parsley-required="false" data-parsley-required-message="Please Enter Obtained Percentage/CGPA Grade" data-parsley-errors-container="#custom-obtained_percentage_cgpa7-parsley-error" value="<?php echo $applicant_obtained_percentage_cgpa[6]; ?>">
                <span id="custom-obtained_percentage_cgpa7-parsley-error"></span>
            </td>
        </tr>
        <tr>
            <td>
                <p>8 <input type="hidden" name="schooling_id_8" id="schooling_id_8" value="<?php echo $applicant_scl_det_id[7]; ?>" ></p>
            </td>
            <td>
                <select class="form-control custom-select" id="academic_subject8" name="academic_subject8" data-placeholder="Choose Subject" data-parsley-required="false" data-parsley-required-message="Please Choose Subject" data-parsley-errors-container="#custom-academic_subject8-parsley-error">
                    <option value=""><?php echo $applicant_scl_subject_name[7]; ?></option>
                    </select>
               <span id="custom-academic_subject8-parsley-error"></span>
            </td>
            <td>
                <select class="form-control custom-select" id="marking_scheme8" name="marking_scheme8" data-placeholder="Choose Marking Scheme" data-parsley-required="false" data-parsley-required-message="Please Choose Subject" data-parsley-errors-container="#custom-marking_scheme8-parsley-error">
                    <option value=""><?php echo $applicant_marking_scheme_name[7]; ?></option>
                    </select>
               <span id="custom-marking_scheme8-parsley-error"></span>
            </td>
            <td>
                <input class="form-control" id="obtained_percentage_cgpa8" type="text" name="obtained_percentage_cgpa8" placeholder="Enter Obtained Percentage/CGPA/Grade" data-parsley-required="false" data-parsley-required-message="Please Enter Obtained Percentage/CGPA Grade" data-parsley-errors-container="#custom-obtained_percentage_cgpa7-parsley-error" value="<?php echo $applicant_obtained_percentage_cgpa[7]; ?>">
                <span id="custom-obtained_percentage_cgpa8-parsley-error"></span>
            </td>
        </tr>
        <tr>
            <td>
                <p>9<input type="hidden" name="schooling_id_9" id="schooling_id_9" value="<?php echo $applicant_scl_det_id[8]; ?>" ></p>
            </td>
            <td>
                <select class="form-control custom-select" id="academic_subject9" name="academic_subject9" data-placeholder="Choose Subject" data-parsley-required="false" data-parsley-required-message="Please Choose Subject" data-parsley-errors-container="#custom-academic_subject9-parsley-error">
                    <option value=""><?php echo $applicant_scl_subject_id[8]; ?></option>
                    </select>
               <span id="custom-academic_subject9-parsley-error"></span>
            </td>
            <td>
                <select class="form-control custom-select" id="marking_scheme9" name="marking_scheme9" data-placeholder="Choose Marking Scheme" data-parsley-required="false" data-parsley-required-message="Please Choose Subject" data-parsley-errors-container="#custom-marking_scheme8-parsley-error">
                    <option value=""><?php echo $applicant_marking_scheme_name[0]; ?></option>
                    </select>
               <span id="custom-marking_scheme9-parsley-error"></span>
            </td>
            <td>
                <input class="form-control" id="obtained_percentage_cgpa9" type="text" name="obtained_percentage_cgpa9" placeholder="Enter Obtained Percentage/CGPA/Grade" data-parsley-required="false" data-parsley-required-message="Please Enter Obtained Percentage/CGPA Grade" data-parsley-errors-container="#custom-obtained_percentage_cgpa7-parsley-error" value="<?php echo $applicant_obtained_percentage_cgpa[8]; ?>">
                <span id="custom-obtained_percentage_cgpa9-parsley-error"></span>
            </td>
        </tr>
    </tbody>
  </table>
</div>
                            
                          </section>
                       </div>
                    </div>
                 </div>
                 <!-- Geetha -->
                 
               <div class="card card_print">
                  <div class="card-header" id="headingFive">
                     <h2 class="mb-0"> 
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive"> Upload & Declaration</button>
                     </h2>
                  </div>
                  <div id="collapseFive" class="collapse show bg-light" aria-labelledby="headingFive" data-parent="#accordionExample">
                     <div class="card-body">
                        <section class="row">
                           <div class="col-md-12">
                            <?php
    $file_allowed_type = FILE_ALLOWED_TYPE;
  ?>  
                              <div class="form-layout">
                                 <div class="row mg-b-25 mt-3">
                                    <div class="row w-100">
        <div class="form-group col-md-6 ">
             <label for="exampleFormControlTextarea1">Upload Your Recent Passport Size Photograph <span class="tx-danger"> *</span></label>
             <input type="file" class="filestyle" name="photograph" id="photograph" data-parsley-required="<?php echo ((isset($docs[$document_id_photograph]))?'false':'true'); ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_PHOTO_MSG; ?>" data-parsley-errors-container="#custom-photograph-parsley-error"data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>"accept="<?php  echo allow_extension($file_allowed_type); ?>">
             <?php if(isset($docs[$document_id_photograph])){ ?>
              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_photograph; ?>">
               <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_photograph; ?>')">&times;</a>
               <strong id="deleteMessageStatus_<?php echo $document_id_photograph; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_photograph; ?>"></span>
             </div>
             <?php } ?>
             <span id="custom-photograph-parsley-error"></span>
        </div>
        <div class="form-group col-md-6">
          <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Signature <span class="tx-danger"> *</span></label>
            <input type="file" class="filestyle" name="signature" id="signature" data-parsley-required="<?php echo ((isset($docs[$document_id_signature]))?'false':'true'); ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_SIGN_MSG; ?>" data-parsley-errors-container="#custom-signature-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
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
            <label for="exampleFormControlTextarea1">Upload Your 10th Grade (or) ‘O’ level Marksheet </label>
            <input type="file" class="filestyle" name="tenth_grade" id="tenth_grade" data-parsley-required="<?php echo ((isset($docs[$document_id_tenth_grade]))?'false':'true'); ?>" data-parsley-required-message="Please upload 10th grade marksheet" data-parsley-errors-container="#custom-tenth_grade-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_tenth_grade])){ echo $docs[$document_id_tenth_grade]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
             <?php if(isset($docs[$document_id_tenth_grade])){ ?>
              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_tenth_grade; ?>">
               <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_tenth_grade; ?>')">&times;</a>
               <strong id="deleteMessageStatus_<?php echo $document_id_tenth_grade; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_tenth_grade; ?>"></span>
             </div>               
             <?php } ?>
             <span id="custom-tenth_grade-parsley-error"></span>
          </div>
          <div class="form-group col-md-6">
            <label for="exampleFormControlTextarea1">Upload Your 12th Grade or ‘A’ level Marksheet </label>
            <input type="file" class="filestyle" name="twelvfth_grade" id="twelvfth_grade" data-parsley-required="<?php echo ((isset($docs[$document_id_twelvfth_grade]))?'false':'true'); ?>" data-parsley-required-message="Please upload 12th grade marksheet" data-parsley-errors-container="#custom-twelvfth_grade-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_twelvfth_grade])){ echo $docs[$document_id_twelvfth_grade]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
             <?php if(isset($docs[$document_id_twelvfth_grade])){ ?>
              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_twelvfth_grade; ?>">
               <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_twelvfth_grade; ?>')">&times;</a>
               <strong id="deleteMessageStatus_<?php echo $document_id_twelvfth_grade; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_twelvfth_grade; ?>"></span>
             </div>                 
             <?php } ?>
             <span id="custom-twelvfth_grade-parsley-error"></span>
          </div>
            </div> 

            <div class="row w-100">
        <div class="form-group col-md-6">
            <label for="exampleFormControlTextarea1">Bachelors Marksheet</label>
            <input type="file" class="filestyle" name="bachelors_marksheet" id="bachelors_marksheet" data-parsley-required="<?php echo ((isset($docs[$document_id_bachelors_marksheet]))?'false':'true'); ?>" data-parsley-required-message="Please upload bachelors marksheet" data-parsley-errors-container="#custom-bachelors_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_bachelors_marksheet])){ echo $docs[$document_id_bachelors_marksheet]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
             <?php if(isset($docs[$document_id_bachelors_marksheet])){ ?>
              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_bachelors_marksheet; ?>">
               <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_bachelors_marksheet; ?>')">&times;</a>
               <strong id="deleteMessageStatus_<?php echo $document_id_bachelors_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_bachelors_marksheet; ?>"></span>
             </div>                 
             <?php } ?>
          <span id="custom-bachelors_marksheet-parsley-error"></span>
        </div>
        <div class="form-group col-md-6">
            <label for="exampleFormControlTextarea1">Masters marks card </label>
            <input type="file" class="filestyle" name="masters_marks_card" id="masters_marks_card" data-parsley-required="<?php echo ((isset($docs[$document_id_masters_marks_card]))?'false':'true'); ?>" data-parsley-required-message="Please upload masters marks card" data-parsley-errors-container="#custom-masters_marks_card-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_masters_marks_card])){ echo $docs[$document_id_masters_marks_card]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
             <?php if(isset($docs[$document_id_masters_marks_card])){ ?>
              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_masters_marks_card; ?>">
               <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_masters_marks_card; ?>')">&times;</a>
               <strong id="deleteMessageStatus_<?php echo $document_id_masters_marks_card; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_masters_marks_card; ?>"></span>
             </div>                 
             <?php } ?>
          <span id="custom-masters_marks_card-parsley-error"></span>
        </div>        
      </div>

      <div class="row w-100">
        <div class="form-group col-md-6">
            <label for="exampleFormControlTextarea1">Transcripts (front and back) or the Predicted / Forecast / Term Scores</label>
            <input type="file" class="filestyle" name="transcripts" id="transcripts" data-parsley-required="<?php echo ((isset($docs[$document_id_transcripts]))?'false':'true'); ?>" data-parsley-required-message="Please upload transcripts" data-parsley-errors-container="#custom-transcripts-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_transcripts])){ echo $docs[$document_id_transcripts]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
             <?php if(isset($docs[$document_id_transcripts])){ ?>
              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_transcripts; ?>">
               <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_transcripts; ?>')">&times;</a>
               <strong id="deleteMessageStatus_<?php echo $document_id_transcripts; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_transcripts; ?>"></span>
             </div>                 
             <?php } ?>
          <span id="custom-transcripts-parsley-error"></span>
        </div>
          <div class="form-group col-md-6">
                          <label for="exampleFormControlTextarea1">Other documents 1 </label>

                          <input type="file" class="filestyle" name="other_document1" id="other_document1" data-parsley-required="false" data-parsley-required-message="Please Upload Any Other Document 1" data-parsley-errors-container="#custom-other_document1-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_other_document1])){ echo $docs[$document_id_other_document1]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                           <?php if(isset($docs[$document_id_other_document1])){ ?>
                              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_other_document1; ?>">
                                 <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_other_document1; ?>')">&times;</a>
                                 <strong id="deleteMessageStatus_<?php echo $document_id_other_document1; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_other_document1; ?>"></span>
                             </div>               
                           <?php } ?>
                           <span id="custom-other_document1-parsley-error"></span>
                      </div>        
      </div>

      <div class="row w-100">
        <div class="form-group col-md-6">
        <label for="exampleFormControlTextarea1">Other documents 2 </label>
          <input type="file" class="filestyle" name="other_document2" id="other_document2" data-parsley-required="false" data-parsley-required-message="Please Upload Any Other Document 1" data-parsley-errors-container="#custom-other_document2-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_other_document2])){ echo $docs[$document_id_other_document2]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
           <?php if(isset($docs[$document_id_other_document2])){ ?>
            <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_other_document2; ?>">
             <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_other_document2; ?>')">&times;</a>
             <strong id="deleteMessageStatus_<?php echo $document_id_other_document2; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_other_document2; ?>"></span>
           </div>               
           <?php } ?>
           <span id="custom-other_document2-parsley-error"></span>
        </div>
      </div>

      <div class="row w-100">
          <div class="col-md-12">
            <h5 class="card-body-title text-primary">Declaration</h5>
            <p><?php echo DECLARATION; ?></p>
          </div>  
        </div>
        <div class="row w-100">
          <div class="col-md-6">
            <label class="form-control-label">Applicant Name <span class="tx-danger">*</span></label>
            <input class="form-control" type="text" name="applicant_name" id="applicant_name" placeholder="Applicant Name" value="<?php echo $applicant_name_declaration ;?>" maxlength="<?php echo APLCT_100_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_APPLT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>" data-parsley-length="[<?php echo APLCT_1_MAXLENGTH; ?>, <?php echo APLCT_100_MAXLENGTH; ?>]">
          </div>
          <div class="col-md-6">
            <label class="form-control-label">Parent Name <span class="tx-danger">*</span></label>
            <input class="form-control" type="text" name="parent_name" id="parent_name" placeholder="Parent Name" value="<?php echo $applicant_parentname_declaration;?>" maxlength="<?php echo APLCT_100_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_PARENT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>" data-parsley-length="[<?php echo APLCT_1_MAXLENGTH; ?>,  <?php echo APLCT_100_MAXLENGTH; ?>]">
          </div>  
        </div>
        <div class="row w-100 mt-3">
          <div class="col-md-6">
            <label class="form-control-label">Declaration Date <span class="tx-danger">*</span></label>
            <input class="form-control" type="text" name="ddate" id="ddate" value="<?php if(isset($ddate)){echo $ddate;}else{echo date('d-m-Y');} ?>" readonly>
          </div>
        </div>  

                                  </div>
                              </div>
                          </div>
                        </section>
                    </div>
                  </div>
                </div>

                <div class="card" id="preview_payment">
                    <div class="card-header" id="headingFive">
                       <h2 class="mb-0"> 
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive"> Payment Details</button>
                       </h2>
                    </div>
                    <div id="collapseFive" class="collapse show bg-light" aria-labelledby="headingFive" data-parent="#accordionExample">
                       <div class="card-body">
                        <?php $applicant_mob_country_code_name = $applicant_basic_details_list['applicant_mob_country_code_name']; ?>
                          <section class="row">
                             <div class="row w-100">
                              <div class="col-lg-6 mb-3">
                                 <div class="card mb-3 base_details_card">
                                    <div class="card-body">
                                       <h5 class="card-title card_title">Personal Details</h5>
                                       <p class="card-subtitle mb-3">Name : <?php echo $first_name." ".$last_name; ?> </p>
                                       <p class="card-subtitle mb-3">E-Mail : <?php echo $email_id;?></p>
                                       <p class="card-subtitle">Phone Number : <?php echo $applicant_mob_country_code_name."-".$mob_no; ?></p>
                                    </div>
                                 </div>
                                 <!-- card -->
                                 <div class="card base_details_card">
                                    <div class="card-body">
                                       <h5 class="card-title card_title">Order Details</h5>
                                       <p class="card-subtitle">Application Fee <span style="float: right;"><?php echo $appln_form_fee;?></span>
                                       </p>
                                    </div>
                                 </div>
                                 <!-- card -->
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
                                                <input type="radio" id="online" name="payment_mode" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="Please Choose Payment Mode" data-parsley-errors-container="#custom-payment_mode-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($payment_mode_id == PAYMENT_MODE_ONLINE_ID)?'checked':''; ?>>
                                                <label class="custom-control-label" for="online">Online</label>
                                              </div>
                                            </div>
                                            <div class="col-lg-2">
                                              <!-- <label class="rdiobox">
                                                <input name="rdio" type="radio" <?php echo ($payment_mode_id == PAYMENT_MODE_DEMAND_DRAFT_ID)?'checked':''; ?> id="dd">
                                                <span>DD</span>
                                              </label> -->
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="dd" name="payment_mode" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="Please Choose Payment Mode" data-parsley-errors-container="#custom-payment_mode-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($payment_mode_id == PAYMENT_MODE_DEMAND_DRAFT_ID)?'checked':''; ?>>
                                                <label class="custom-control-label" for="dd">DD</label>
                                              </div>
                                            </div>
                                            <span id="custom-payment_mode-parsley-error"></span>
                                         </div>
                                       <p class="card-subtitle mb-3">Sub Total <span style="float: right;"><?php echo $appln_form_fee; ?></span>
                                       </p>
                                       <p class="card-subtitle">Total<span style="float: right;"><?php echo $appln_form_fee; ?></span>
                                       </p>
                                       <div id="payment_details" style="<?php echo ($payment_mode_id==PAYMENT_MODE_DEMAND_DRAFT_ID)?'display:block;':'display:none;'; ?>">
                                            <div class="col-md-12 mt-3">
                                               <div class="row">
                                                  <div class="col-md-6">
                                                      <select class="form-control select2" name="BankName" id="BankName" title="Choose Bank Name" data-parsley-required="true" data-parsley-required-message="Choose Bank Name" data-parsley-errors-container="#custom-BankName-parsley-error">
                                                        <option value=""  selected="selected"><?php echo $bank_name; ?></option>
                                                      </select>
                                                      <span id="custom-BankName-parsley-error"></span>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <input class="form-control" type="text" name="BranchName" placeholder="Branch Name" id="BranchName" data-parsley-required="true" data-parsley-required-message="Required" maxlength="30" value="<?php echo $branch_name; ?>">
                                                  </div>
                                               </div>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                               <div class="row">
                                                  <div class="col-md-6">
                                                      <input class="form-control" type="text" name="DDNumber" id="DDNumber" placeholder="DD Number" data-parsley-required="true" data-parsley-required-message="Choose DDNumber" data-parsley-type="digits" data-parsley-type-message="Only Numbers Allowed"  maxlength="10" value="<?php echo $dd_cheque_no; ?>">
                                                  </div>
                                                  <div class="col-md-6">
                                                      <input class="form-control" type="text" name="DDDate" id="DDDate" placeholder="DD Date" data-parsley-required="true" data-parsley-required-message="Choose DD Date" value="<?php echo $dd_cheque_date; ?>">
                                                  </div>
                                               </div>
                                            </div>
                                            <div class="row mt-3">
                                               <div class="col-sm-12 customIcon">
                                                  <div class="flexbox flex-start"><i style="margin:4px 5px 0 0" class="icon-info npf-icon"
                                                     aria-hidden="true"></i>You must send your
                                                     DD&nbsp;in favor of "SRMIST" Payable at Chennai.
                                                     along with
                                                     your Application Form with complete details
                                                     (Full Name, Application Number, Mobile) to
                                                     &nbsp;the
                                                     below-mentioned address:<br><br>The Director
                                                     (Admissions)<br>SRM Institute of Science and
                                                     technology<br>SRM
                                                     Nagar,<br>Kattankulathur-603 203<br>Chengalpattu
                                                     District<br>Tamil Nadu, India 
                                                  </div>
                                               </div>
                                            </div>
                                       </div>
                                       <!-- <a href="payment_success.html" class="btn btn-primary active w-100 mt-3" role="button"
                                          aria-pressed="true">MAKE PAYMENT</a> -->
                                    </div>
                                 </div>
                                 <!-- card -->
                              </div>
                           </div>
                        </section>
                     </div>
                  </div>
               </div>
            </div>
           </div>
      </div>
   </div>
