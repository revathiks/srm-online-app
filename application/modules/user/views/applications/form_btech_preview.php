<?php 
$first_name = $personal_detail_list['data']['first_name'];
$last_name = $personal_detail_list['data']['last_name'];
$email_id = $personal_detail_list['data']['email_id'];
$user_id = $personal_detail_list['data']['user_id'];
$mobile_no = $personal_detail_list['data']['mobile_no'];


$appln_form_fee = $applicant_appln_details_list['appln_form_fee'];
// echo '<pre>';
// print_r($applicant_payment_details_list);
// echo '</pre>';

/* Payment Details Start */
$startIndex = $this->input->get('startIndex', true);
$branch_name = $applicant_payment_details_list['branch_name'];

$dd_cheque_no = $applicant_payment_details_list['dd_cheque_no'];
$dd_cheque_date = $applicant_payment_details_list['dd_cheque_date'];
if($dd_cheque_date) {
  $dd_cheque_date = date('d/m/Y',strtotime($dd_cheque_date));
}
$payment_mode_id = $applicant_payment_details_list['payment_mode_id'];
$bank_name=$applicant_payment_details_list['bank_name'];
$bank_name=isset($bank_name)? $bank_name:'Select Bank Name';
 //print_r($applicant_payment_details_list);
            //die;
/* Payment Details End */

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
$title_name = !empty($applicant_basic_details_list['tittle_name']) ? $applicant_basic_details_list['tittle_name'] : 'Select';
$mob_country_code_name = !empty($applicant_basic_details_list['applicant_mob_country_code_name']) ? $applicant_basic_details_list['applicant_mob_country_code_name'] : 'Select';
$first_name = $applicant_basic_details_list['f_name'];
$m_name = $applicant_basic_details_list['m_name'];
$last_name = $applicant_basic_details_list['l_name'];
$dob = $applicant_basic_details_list['dob'];
$dob=isset($dob)? date('d/m/Y',strtotime($dob)):'';
$blood_id = $applicant_basic_details_list['blood_id'];

$mob_no = $applicant_basic_details_list['mob_no'];
$applicant_mob_country_code_id = $applicant_basic_details_list['applicant_mob_country_code_id'];
$reg_mob_country_code_id = $applicant_basic_details_list['reg_mob_country_code_id'];
$email_id = $applicant_basic_details_list['e_mail'];
$sec_mob_no = $applicant_basic_details_list['sec_mob_no'];
$sec_e_mail = $applicant_basic_details_list['sec_e_mail'];
$gender_id = $applicant_basic_details_list['gender_id'];
$gender = $applicant_basic_details_list['gender'];
$gender_name = !empty($applicant_basic_details_list['gender']) ? $applicant_basic_details_list['gender'] : 'Select';
$social_status_id = $applicant_basic_details_list['social_status_id'];
$social_status = !empty($applicant_basic_details_list['social_status']) ? $applicant_basic_details_list['social_status'] : 'Select';
$blood_group = !empty($applicant_basic_details_list['blood_group']) ? $applicant_basic_details_list['blood_group'] : 'Select';
$religion_name = !empty($applicant_basic_details_list['religion_name']) ? $applicant_basic_details_list['religion_name'] : 'Select';
$medium_of_instruction = !empty($applicant_basic_details_list['medium_of_study_name']) ? $applicant_basic_details_list['medium_of_study_name'] : 'Select';
$dif_abled = $applicant_basic_details_list['dif_abled'];
if($dif_abled){
  $diff_abled_select_name = 'Yes';
}else if($dif_abled == 'f') {
    $diff_abled_select_name = 'No';
  }else{
    $diff_abled_select_name = 'Select';
  }

$religion_id = $applicant_basic_details_list['religion_id'];
$medium_of_instruction_id = $applicant_other_details_list['medofinst'];
$add_gardian = $applicant_other_details_list['add_gardian'];
$hostel_accommodation_id = $applicant_basic_details_list['hostel_accommodation_id'];
$prefer_hostel = $applicant_basic_details_list['prefer_hostel'];
  if($prefer_hostel == 't') {
          $hostel_accommodation_select_name = 'Yes';
  } else if($prefer_hostel == 'f') {
    $hostel_accommodation_select_name = 'No';
  }else{
    $hostel_accommodation_select_name = 'Select';
  }

$mother_tongue_id = $applicant_basic_details_list['mothertongue_id'];
$mothertongue_name = !empty($applicant_basic_details_list['mothertongue_name']) ? $applicant_basic_details_list['mothertongue_name'] : 'Select';
$advertisement_source_id = $applicant_basic_details_list['advertisement_source_id'];
$source_name = !empty($applicant_basic_details_list['source_name']) ? $applicant_basic_details_list['source_name'] : 'Select';

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
      $applicant_course_course_id[] = $v['course_id'];
      $applicant_course_course_name[] = $v['course_name'];
      $applicant_course_choice_no[] = $v['choice_no'];
      $applicant_course_is_active[] = $v['is_active'];
      $applicant_course_spec_id[] = $v['splpref_id'];
      $applicant_course_spec_name[] = $v['spec_name'];
   }
}

$course_1 = isset($applicant_course_course_name[0]) ? $applicant_course_course_name[0] : 'Select Course Preference 1';
$course_2 = isset($applicant_course_course_name[1]) ? $applicant_course_course_name[1] : 'Select Course Preference 2';
$course_3 = isset($applicant_course_course_name[2]) ? $applicant_course_course_name[2] : 'Select Course Preference 3';

$spec_1 = isset($applicant_course_spec_name[0]) ? $applicant_course_spec_name[0] : 'Select Specialization Preference 1';
$spec_2 = isset($applicant_course_spec_name[1]) ? $applicant_course_spec_name[1] : 'Select Specialization Preference 2';
$spec_3 = isset($applicant_course_spec_name[2]) ? $applicant_course_spec_name[2] : 'Select Specialization Preference 3';


if($applicant_campus_prefer_details_list) {
   foreach($applicant_campus_prefer_details_list as $k=>$v) {
      $applicant_campus_prefer_id[] = $v['applicant_campus_prefer_id'];
      $applicant_campus_campus_id[] = $v['campus_id'];
      $applicant_campus_campus_name[] = $v['campus_name'];
      $applicant_campus_choice_no[] = $v['choice_no'];
      $applicant_campus_is_active[] = $v['is_active'];
   }
}

$campus_1 = isset($applicant_campus_campus_name[0]) ? $applicant_campus_campus_name[0] : 'Select Campus Preference 1';
$campus_2 = isset($applicant_campus_campus_name[1]) ? $applicant_campus_campus_name[1] : 'Select Campus Preference 2';
$campus_3 = isset($applicant_campus_campus_name[2]) ? $applicant_campus_campus_name[2] : 'Select Campus Preference 3';

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

$city_1 = isset($applicant_city_city_name[0]) ? $applicant_city_city_name[0] : 'Choose Test City Perferences 1';
$city_2 = isset($applicant_city_city_name[1]) ? $applicant_city_city_name[1] : 'Choose Test City Perferences 2';
$city_3 = isset($applicant_city_city_name[2]) ? $applicant_city_city_name[2] : 'Choose Test City Perferences 3';

$state_1 = isset($applicant_city_state_name[0]) ? $applicant_city_state_name[0] : 'Choose Test State Perferences 1';
$state_2 = isset($applicant_city_state_name[1]) ? $applicant_city_state_name[1] : 'Choose Test State Perferences 2';
$state_3 = isset($applicant_city_state_name[2]) ? $applicant_city_state_name[2] : 'Choose Test State Perferences 3';

//Parent Details Start

$add_gardian = isset($applicant_other_details_list['add_gardian']) ? $applicant_other_details_list['add_gardian'] : '';
if ($applicant_parent_details_list) {
    foreach ($applicant_parent_details_list as $parent_det) {
        if ($parent_det['parent_type_id'] == PARENT_TYPE_ID_FATHER) {
            $vartype = "father";
        }
        if ($parent_det['parent_type_id'] == PARENT_TYPE_ID_MOTHER) {
            $vartype = "mother";
        }
        if ($parent_det['parent_type_id'] == PARENT_TYPE_ID_GUARDIAN) {
            $vartype = "guardian";
        }

        $parenttype = strtolower($vartype);        
        ${ $parenttype . "_title_id"} = $parent_det['title_id'];
        ${ $parenttype . "_title_name"} = $parent_det['title_name'];
        ${ $parenttype . "_name"} = $parent_det['parent_name'];
        ${ $parenttype . "_mobile"} = $parent_det['mobile_no'];
        ${ $parenttype . "_email"} = $parent_det['email_id'];
        ${ $parenttype . "_occupation"} = $parent_det['occupation_name'];
        ${ $parenttype . "_occupation_id"} = $parent_det['occupation_id'];
        ${ $parenttype."_other_occupation"}=$parent_det['other_occupation_name'];
        ${ $parenttype . "_alt_mobile"} = $parent_det['alt_mobile_no'];
        ${ $parenttype . "_name"} = $parent_det['parent_name'];
        ${ $parenttype . "_country_mob_code"} = $parent_det['country_mob_code'];
        ${ $parenttype . "_alt_mob_country_code"} = $parent_det['alt_mob_country_code'];
    }

    //set empty val
    $father_title_id = isset($father_title_id) ? $father_title_id : 'Select';
    $father_title_name = isset($father_title_name) ? $father_title_name : 'Select';
    $father_name = isset($father_name) ? $father_name : '';
    $father_mobile = isset($father_mobile) ? $father_mobile : '';
    $father_email = isset($father_email) ? $father_email : '';
    $father_occupation = isset($father_occupation) ? $father_occupation : 'Select Father\'s Occupation';
    $father_alt_mobile = isset($father_alt_mobile) ? $father_alt_mobile : '';
    $father_other_occupation=isset($father_other_occupation) ? $father_other_occupation:'';
    $father_occupation_id=isset($father_occupation_id) ? $father_occupation_id:'';
    $father_country_mob_code=isset($father_country_mob_code)?$father_country_mob_code :'+91';
    $father_alt_mob_country_code=isset($father_alt_mob_country_code)?$father_alt_mob_country_code :'+91';
    
    $mother_title_id = isset($mother_title_id) ? $mother_title_id : 'Select';
    $mother_title_name = isset($mother_title_name) ? $mother_title_name : 'Select';
    $mother_name = isset($mother_name) ? $mother_name : '';
    $mother_mobile = isset($mother_mobile) ? $mother_mobile : '';
    $mother_email = isset($mother_email) ? $mother_email : '';
    $mother_occupation = isset($mother_occupation) ? $mother_occupation : 'Select Mother\'s Occupation';
    $mother_alt_mobile = isset($mother_alt_mobile) ? $mother_alt_mobile : '';
    $mother_other_occupation=isset($mother_other_occupation) ? $mother_other_occupation:'';
    $mother_occupation_id=isset($mother_occupation_id) ? $mother_occupation_id:'';
    $mother_country_mob_code=isset($mother_country_mob_code)?$mother_country_mob_code :'91';
    $mother_alt_mob_country_code=isset($mother_alt_mob_country_code)?$mother_alt_mob_country_code :'91';
    
    $guardian_title_name = isset($guardian_title_name) ? $guardian_title_name : 'Select';
    $guardian_name = isset($guardian_name) ? $guardian_name : '';
    $guardian_mobile = isset($guardian_mobile) ? $guardian_mobile : '';
    $guardian_email = isset($guardian_email) ? $guardian_email : '';
    $guardian_occupation = isset($guardian_occupation) ? $guardian_occupation : 'Select Guardian\'s Occupation';
    $guardian_alt_mobile = isset($guardian_alt_mobile) ? $guardian_alt_mobile : '';
    $guardian_other_occupation=isset($guardian_other_occupation) ? $guardian_other_occupation:'';
    $guardian_occupation_id=isset($guardian_occupation_id) ? $guardian_occupation_id:'';
    $guardian_country_mob_code=isset($guardian_country_mob_code)?$guardian_country_mob_code :'91';
    $guardian_alt_mob_country_code=isset($guardian_alt_mob_country_code)?$guardian_alt_mob_country_code :'91';
}

/*Parent Details End*/


//Start address
//print_r($applicant_address_details_list);die;
if($applicant_address_details_list) {
    $country_id = $applicant_address_details_list[0]['country_id'];
    $country_name = $applicant_address_details_list[0]['country_name'];
    $state_id = $applicant_address_details_list[0]['state_id'];
    $state_name = $applicant_address_details_list[0]['state_name'];
    $district_id = $applicant_address_details_list[0]['district_id'];
    $district_name = $applicant_address_details_list[0]['district_name'];
    $city_id = $applicant_address_details_list[0]['city_id'];
    $city_name = $applicant_address_details_list[0]['city_name'];
    $add_line_1=$applicant_address_details_list[0]['add_line_1'];
    $add_line_2=$applicant_address_details_list[0]['add_line_2'];
    
$country_id=isset($country_id) ?$country_id:'';
$country_name=isset($country_name) ?$country_name : 'Select Country';
$state_name=isset($state_name) ?$state_name : 'Select State';
$district_name=isset($district_name) ?$district_name : 'Select District';
$city_name=isset($city_name) ?$city_name : 'Select City';
$pin_code=$applicant_address_details_list[0]['pin_code'];
}
//End address

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
$other_board_name = $applicant_schooling_details_list['other_board_name'];

$applicant_name = $applicant_appln_details_list['applicant_name_declaration'];
$applicant_name = ($applicant_name)?$applicant_name:$first_name;

$parent_name = $applicant_appln_details_list['applicant_parentname_declaration'];
$parent_name = (($parent_name)?$parent_name:(($father_name)?$father_name:(($mother_name)?$mother_name:(($guardian_name)?$guardian_name:''))));

$declaration_date = $applicant_appln_details_list['applicant_declaration_date'];
$declaration_date = ($declaration_date)?date('d/m/Y',strtotime($declaration_date)):date('d/m/Y');

$applicant_appln_id = $applicant_appln_details_list['applicant_appln_id'];
$is_qualify = $applicant_appln_details_list['qualifyingexamfromindia'];

$studied_from_india_id = '';
$studied_from_india_name = 'Select';
if($is_qualify == 't') {
    $studied_from_india_id = 'yes';
    $studied_from_india_name = 'Yes';
} else if($is_qualify == 'f') {
    $studied_from_india_id = 'no';
    $studied_from_india_name = 'No';
}
$nation_yes = 'no';

if($nationality_id == COUNTRY_VALUE_DEFAULT)
{
  $nation_yes = 'yes';
}
//echo $nation_yes;echo $studied_from_india_id;die;

// echo '<pre>';
// print_r($applicant_schooling_details_list); 
// print_r($applicant_other_details_list); 
// echo '</pre>';
/*CRM ADMIN Edit form start*/
$url = base_url().'btech?startIndex='.$startIndex;
if($mode_edit == ADMIN_MODE_EDIT)
{
  $url = base_url().'btech/'.$mode_edit.'/'.$crm_applicant_login_id.'/'.$crm_applicant_personal_det_id.'?startIndex='.$startIndex;;
}
/*CRM ADMIN Edit form start*/

?>

     
	  <div class="row">
	<div class="col-md-6">
		 <a href="<?php echo $url;?>" class="btn btn-primary active mt-3" role="button" aria-pressed="true">Back</a>
	</div>
	
</div>
      <div class="row disable-div">
        <div class="col-sm-12" id="BtechPreviewToPrint">
           <div class="card-body" id="btech_form">
              <div class="accordion" id="accordionExample">
                 <div class="card card_print">
                    <div class="card-header" id="headingOne">
                       <h2 class="mb-0">
                          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Basic Details <span class="float-right icon_right"></span>
                          </button>
                       </h2>
                    </div>
                    <div id="collapseOne" class="collapse show bg-light" aria-labelledby="headingOne" data-parent="#accordionExample">
                       <div class="card-body">
                          <section class="row">
                             <div class="row w-100">
                                <div class="col-lg-6">
                                   <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Nationality</label>
                                      <select class="form-control select2" data-placeholder="Choose Nationality" tabindex="-1" aria-hidden="true" name="pd_nationality" id="pd_nationality" title="Choose Nationality">
                                          <option value=""><?php echo $nationality_name;?></option>
                                      </select>
                                   </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Have you studied from India? </label>
                                    <select class="form-control custom-select" id="studied_from_india" name="studied_from_india">
                                        <option value=""><?php echo $studied_from_india_name; ?></option>
                                    </select>
                                  </div>
                                </div>
                             </div>
                            <div class="row w-100 ml-2">

                              <?php if (($studied_from_india_id == 'no' && $nation_yes == 'yes') || 
                              ($studied_from_india_id == 'yes' && $nation_yes == 'no')) { ?>
                              <div class="form-group mt-5" id="indian">
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
                                  follows:&nbsp;<a
                                      src="https://intlapplications.srmist.edu.in/international-application-form-2020">https://intlapplications.srmist.edu.in/international-application-form-2020</a>
                                <div class="form-group formAreaCols ">
                                  <label class="control-label" for="radios">Though I fall under NRI category I am permitted to give SRMJEEE 2020 and go through the counseling process.    <p class="requiredStar">*</p></label>
                                  <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="i_agree" id="i_agree" value="<?php echo ($is_agree == 't')?1:0; ?>"  data-parsley-required="false" data-parsley-required-message="Please check agree" <?php echo ($is_agree == 't')?'checked':0; ?>><label class="custom-control-label" for="i_agree"> I agree </label>
                                  </div>
                                  <span id="custom-i_agree-parsley-error"></span>
                                </div>
                              </div>
                            <?php } else { ?>
                              <div class="form-group formAreaCols" id="indian2">
                                  SRMJEEE is not applicable for international
                                  students. Go to the below link to
                                  proceed further.<br><br><a
                                      href="https://intlapplications.srmist.edu.in/international-application-form-2020"><b>https://intlapplications.srmist.edu.in/international-application-form-2020</b></a>
                              </div>
                            <?php } ?>
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
                                <h5 class="text-primary mb-3">Course and Campus Preference </h5>
                              </div>
                              <div class="row w-100">
                                <div class="col-lg-4">
                                   <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Course Preference 1 <span class="tx-danger">*</span></label>
                                      <select class="form-control custom-select study" data-placeholder="Choose Course Preference 1" tabindex="-1" aria-hidden="true" name="course_pref_1" id="course_pref_1" title="Choose Course Preference 1">
                                          <option value=""><?php echo $course_1;?></option>
                                      </select>
                                   </div>
                                </div>
                                <!-- col-4 -->
                                <div class="col-lg-4" id="main_div_spec_pref_1">
                                   <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Specialization Preference 1 <span class="tx-danger">*</span></label>
                                      <select class="form-control custom-select study" data-placeholder="Choose Specialization Preference 1" tabindex="-1" aria-hidden="true" name="specialization_pref_1" id="specialization_pref_1" title="Choose Specialization Preference 1">
                                          <option value=""><?php echo $spec_1; ?></option>
                                      </select>
                                   </div>
                                </div>
                                <!-- col-4 -->
                                <div class="col-lg-4" id="main_div_camp_pref_1">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Campus Preference 1 <span class="tx-danger">*</span></label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Campus Preference 1" tabindex="-1" aria-hidden="true" name="campus_pref_1" id="campus_pref_1" title="Choose Campus Preference 1">
                                        <option value=""><?php echo $campus_1; ?></option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row w-100">
                                <div class="col-lg-4">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Course Preference 2</label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Course Preference 2" tabindex="-1" aria-hidden="true" name="course_pref_2" id="course_pref_2" title="Choose Course Preference 2">
                                        <option value=""><?php echo $course_2;?></option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-lg-4" id="main_div_spec_pref_2">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Specialization Preference 2</label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Specialization Preference 2" tabindex="-1" aria-hidden="true" name="specialization_pref_2" id="specialization_pref_2" title="Choose Specialization Preference 2" >
                                        <option value=""><?php echo $spec_2; ?></option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-lg-4" id="main_div_camp_pref_2">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Campus Preference 2</label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Campus Preference 2" tabindex="-1" aria-hidden="true" name="campus_pref_2" id="campus_pref_2" title="Choose Campus Preference 2">
                                        <option value=""><?php echo $campus_2; ?></option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row w-100">
                                <div class="col-lg-4">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Course Preference 3</label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Course Preference 3" tabindex="-1" aria-hidden="true" name="course_pref_3" id="course_pref_3" title="Choose Course Preference 3">
                                        <option value=""><?php echo $course_3;?></option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-lg-4" id="main_div_spec_pref_3">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Specialization Preference 3</label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Specialization Preference 3" tabindex="-1" aria-hidden="true" name="specialization_pref_3" id="specialization_pref_3" title="Choose Specialization Preference 3">
                                        <option value=""><?php echo $spec_3; ?></option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-lg-4" id="main_div_camp_pref_3">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Campus Preference 3</label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Campus Preference 3" tabindex="-1" aria-hidden="true" name="campus_pref_3" id="campus_pref_3" title="Choose Campus Preference 3">
                                        <option value=""><?php echo $campus_3; ?></option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row w-100">
                                <h5 class="text-primary mt-4 mb-3">Test City Perferences</h5>
                              </div>
                              <div class="row w-100">
                                <div class="col-lg-6">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Test State Perferences 1 <span class="tx-danger">*</span></label>
                                    <select class="form-control select2 test_state" data-placeholder="Choose Test State Perferences 1" tabindex="-1" aria-hidden="false" name="state_pref_1" id="state_pref_1" title="Choose Test State Perferences 1">
                                      <option value=""><?php echo $state_1;?></option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-lg-6" id="main_div_city_pref_1">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Test City Perferences 1<span class="tx-danger">*</span></label>
                                    <select class="form-control select2 test_city" data-placeholder="Choose Test City Perferences 1" tabindex="-1" aria-hidden="true" name="city_pref_1" id="city_pref_1" title="Choose Test City Perferences 1" onchange="test_city_pref_change('state_pref_1','city_pref_1')">
                                      <option value=""><?php echo $city_1;?></option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row w-100">
                                <div class="col-lg-6">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Test State Perferences 2</label>
                                    <select class="form-control select2 test_state" data-placeholder="Choose Test State Perferences 2" tabindex="-1" aria-hidden="true" name="state_pref_2" id="state_pref_2" title="Choose Test State Perferences 2">
                                      <option value=""><?php echo $state_2;?></option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-lg-6" id="main_div_city_pref_2">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Test City Perferences 2</label>
                                    <select class="form-control select2 test_city" data-placeholder="Choose Test City Perferences 2" tabindex="-1" aria-hidden="true" name="city_pref_2" id="city_pref_2" title="Choose Test City Perferences 2" onchange="test_city_pref_change('state_pref_2','city_pref_2')">
                                      <option value=""><?php echo $city_2;?></option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row w-100">
                                <div class="col-lg-6">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Test State Perferences 3</label>
                                    <select class="form-control select2 test_state" data-placeholder="Choose Test State Perferences 3" tabindex="-1" aria-hidden="true" name="state_pref_3" id="state_pref_3" title="Choose Test State Perferences 3">
                                      <option value=""><?php echo $state_3;?></option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-lg-6" id="main_div_city_pref_3">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Test City Perferences 3</label>
                                    <select class="form-control select2 test_city" data-placeholder="Choose Test City Perferences 3" tabindex="-1" aria-hidden="true" name="city_pref_3" id="city_pref_3" title="Choose Test City Perferences 3" onchange="test_city_pref_change('state_pref_3','city_pref_3')">
                                      <option value=""><?php echo $city_3;?></option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row w-100">
                                <h5 class="text-primary mt-4 mb-3">Personal Details</h5>
                              </div>
                             <div class="row w-100">
                                <div class="col-md-4">
                                   <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Title</label>
                                      <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_title" id="pd_title" title="Choose Title">
                                          <option value=""><?php echo $title_name ;?></option>
                                      </select>
                                   </div>
                                </div>
                                <!-- col-4 -->
                                <div class="col-md-4">
                                   <div class="form-group">
                                      <label class="form-control-label">First Name <span class="tx-danger"> *</span></label>
                                      <input class="form-control" type="text" name="pd_firstname" id="pd_firstname" placeholder="Your First Name" maxlength="100" value="<?php echo $first_name; ?>">
                                   </div>
                                </div>
                                <!-- col-4 -->
                                <div class="col-md-4">
                                   <div class="form-group">
                                      <label class="form-control-label">Middle Name </label>
                                      <input class="form-control" type="text" name="pd_middlename" id="pd_middlename" placeholder="Your Middle Name" value="<?php echo $m_name; ?>"  maxlength="50">
                                   </div>
                                </div>
                                <!-- col-4 -->
                             </div>
                             <div class="row w-100">
                                <div class="col-md-4">
                                   <div class="form-group">
                                      <label class="form-control-label">Last Name <span class="tx-danger"> *</span></label>
                                      <input class="form-control" type="text" name="pd_lastname" id="pd_lastname" placeholder="Your Last Name" maxlength="50" value="<?php echo $last_name; ?>">
                                   </div>
                                </div>
                                <!-- col-4 -->
                                <div class="col-md-4">
                                  <label class="form-control-label">Mobile No <span class="tx-danger"> *</span></label>
                                  <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                        <select class="form-control form_control custom-select Mobile_number" id="phone_no_code" name="phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                            <option value="<?php echo $country_value_default; ?>" selected><?php echo $mob_country_code_name;?> </option>
                                        </select>
                                    </span>
                                    <input type="text" name="pd_mobile_no" id="pd_mobile_no" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Mobile No" class="form-control" value="<?php echo $mob_no; ?>">
                                  </div>
                                </div>
                                <div class="col-md-4">
                                   <div class="form-group">
                                      <label class="form-control-label">Email ID <span class="tx-danger"> *</span></label>
                                      <input class="form-control" type="email" name="pd_email" id="pd_email" placeholder="Your email id." value="<?php echo $email_id; ?>">
                                   </div>
                                </div>
                             </div>
                             <div class="row w-100">
                                <div class="col-md-4">
                                   <div class="wd-200 w-100">
                                      <label class="form-control-label">Date of Birth<span class="tx-danger"> *</span></label>
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                          <input type="text" class="form-control hasDatepicker" name="pd_dob" id="pd_dob" placeholder="DD/MM/YYYY" value="<?php echo  $dob; ?>" readonly>
                                      </div>
                                   </div>
                                </div>
                                <div class="col-md-4">
                                   <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Gender <span class="tx-danger"> *</span></label>
                                      <select class="form-control select2" data-placeholder="Choose Gender" tabindex="-1" aria-hidden="true" name="pd_gender" id="pd_gender" title="Choose Gender">
                                          <option value=""><?php echo $gender_name;?></option>
                                      </select>
                                   </div>
                                </div>
                                <!-- col-4 -->
                                <div class="col-md-4">
                                   <div class="form-group">
                                      <label class="form-control-label">Alternate Email ID</label>
                                      <input class="form-control" type="email" name="pd_alt_email" id="pd_alt_email" placeholder="Alternate Email" value="<?php echo $sec_e_mail; ?>">
                                   </div>
                                </div>
                             </div>
                             <div class="row w-100">
                                <div class="col-md-4">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Community <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Community" tabindex="-1" aria-hidden="true" name="pd_social_status" id="pd_social_status" title="Choose Community">
                                        <option value=""><?php echo $social_status;?></option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                   <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Blood Group</label>
                                      <select class="form-control select2" data-placeholder="Choose Blood Group" tabindex="-1" aria-hidden="true" name="pd_blood_group" id="pd_blood_group" title="Choose Blood Group">
                                          <option value=""><?php echo $blood_group; ?></option>
                                      </select>
                                   </div>
                                </div>
                                <div class="col-md-4">
                                   <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Religion <span class="tx-danger">*</span></label>
                                      <select class="form-control select2" data-placeholder="Choose Religion" tabindex="-1" aria-hidden="true" name="pd_religion" id="pd_religion" title="Choose Religion">
                                          <option value=""><?php echo $religion_name;?></option>
                                      </select>
                                   </div>
                                </div>               
                                <!-- col-4 -->
                             </div>
                             <div class="row w-100">
                                <div class="col-lg-4">
                                   <div class="form-group">
                                      <label class="form-control-label">Medium of Instruction <span class="tx-danger">*</span></label>
                                      <select class="form-control select2" data-placeholder="Choose Medium of Instruction" tabindex="-1" aria-hidden="true" name="pd_medium_of_instruction" id="pd_medium_of_instruction" title="Choose Medium of Instruction">
                                          <option value=""><?php echo $medium_of_instruction;?></option>
                                      </select>
                                   </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Hostel Accommodation</label>
                                    <select class="form-control select2" data-placeholder="Choose Hostel Accommodation" tabindex="-1" aria-hidden="true" name="pd_hostel_accommodation" id="pd_hostel_accommodation" title="Choose Hostel Accommodation">
                                        <option value=""><?php echo $hostel_accommodation_select_name; ?></option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Mother Tongue</label>
                                    <select class="form-control select2" data-placeholder="Choose Mother Tongue" tabindex="-1" aria-hidden="true" name="pd_mother_tongue" id="pd_mother_tongue" title="Choose Mother Tongue">
                                        <option value=""><?php echo $mothertongue_name; ?></option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row w-100 print_margin">
                                <div class="col-md-4">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Where do you see admission advertisement?</label>
                                    <select class="form-control select2" data-placeholder="Choose Advertisement Source" tabindex="-1" aria-hidden="true" name="pd_advertisement_source" id="pd_advertisement_source" title="Choose Advertisement Source ">
                                        <option value=""><?php echo $source_name ; ?></option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                   <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Are you a differently Abled?</label>
                                      <select class="form-control select2" data-placeholder="Choose Differently Abled" tabindex="-1" aria-hidden="true" name="pd_diffrently_abled" id="pd_diffrently_abled" title="Choose Differently Abled">
                                          <option value=""><?php echo $diff_abled_select_name;  ?></option>
                                      </select>
                                   </div>
                                </div>
                                <!-- col-4 -->
                             </div>
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
                                <h5 class="text-primary mb-3">Father's Details</h5>
                             </div>
                             <div class="row w-100">
                                <div class="col-lg-4">
                                   <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Title<span class="tx-danger">*</span></label>
                                      <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_father_title" id="pd_father_title" title="Choose Title">
                                        <option value=""><?php echo $father_title_name;?></option>
                                      </select>                                      
                                   </div>
                                </div>
                                <!-- col-4 -->
                                <div class="col-lg-4">
                                   <div class="form-group">
                                      <label class="form-control-label">Father's Name <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="pd_father_name" id="pd_father_name" placeholder="Enter Your Father Name" maxlength="50" value="<?php echo $father_name; ?>" />
                                   </div>
                                </div>
                                <!-- col-4 -->
                                <?php if($father_title_id!=LOOKUP_VALUE_TITLE_LATE_ID) { ?>
                                <div class="col-lg-4" id="father_mbleno_div">
                                  <label class="form-control-label">Father's Mobile Number</label>
                                  <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                    <select class="form-control form_control custom-select Mobile_number" id="pd_father_phone_no_code" name="pd_father_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                      <option value="<?php echo $country_value_default; ?>" selected><?php echo $father_country_mob_code;?></option>
                                    </select>
                                  </span>
                                  <input type="text" class="form-control" name="pd_father_phone" id="pd_father_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Mobile No" class="form-control" value="<?php echo $father_mobile; ?>">
                                   </div>
                                </div>
                                <div class="col-lg-4" id="father_alt_mbleno_div">
                                  <label class="form-control-label">Father's Alternate Mobile Number</label>
                                  <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                      <select class="form-control form_control custom-select Mobile_number" id="pd_father_alt_phone_no_code" name="pd_father_alt_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                        <option value="<?php echo $country_value_default; ?>" selected><?php echo $father_alt_mob_country_code;?></option>
                                      </select>
                                    </span>
                                    <input type="text" class="form-control" name="pd_father_alt_phone" id="pd_father_alt_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Alternate Mobile No" class="form-control" value="<?php echo $father_alt_mobile; ?>">
                                  </div>
                                </div>
                                <div class="col-lg-4" id="father_email_div">
                                  <div class="form-group">
                                    <label class="form-control-label">Father's Email ID </label>
                                    <input class="form-control" type="email" name="pd_father_email" id="pd_father_email"  placeholder="Enter Your Father's Email ID" value="<?php echo $father_email; ?>" maxlength="100">
                                  </div>
                                </div>
                                <div class="col-lg-4"  id="father_occupation_div">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Father's Occupation</label>
                                    <select class="form-control select2" data-placeholder="Choose Occupation" tabindex="-1" aria-hidden="true" name="pd_father_occupation" id="pd_father_occupation">
                                      <option value=""><?php echo $father_occupation;?></option>
                                    </select>
                                  </div>
                                  <?php  if($father_occupation_id == OTHER_OCCUPATION) { ?>
                                  <div id="father_other_occupation_div" class="form-group">
                      						<input class="form-control" type="text" name="pd_father_other_occupation" id="pd_father_other_occupation"  placeholder="If Other, please enter here..."data-parsley-required="false"   data-parsley-errors-container="#custom-pd_father_other_occupation-parsley-error" value="<?php echo $applicant_parent_occupation_other_name[$parent_type_id_father];?>">
                      						<span id="custom-pd_father_other_occupation-parsley-error"></span>
                      		   </div>
                              <?php } ?>
                                </div>
                                <?php } ?>
                                <!-- col-4 -->
                             </div>
                             <!-- row -->                             
                              <div class="row w-100">
                                <h5 class="text-primary mt-4 mb-3">Mother's Details</h5>
                              </div>
                              <div class="row w-100">
                                <div class="col-lg-4">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Title <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" name="pd_mother_title" id="pd_mother_title" title="Choose Title">
                                      <option value=""><?php echo $mother_title_name;?></option>
                                    </select>                                   
                                  </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                      <label class="form-control-label">Mother's Name <span class="tx-danger">*</span></label>
                                      <input type="text" class="form-control" name="pd_mother_name" id="pd_mother_name" placeholder="Enter Your Mother's Name" maxlength="50" value="<?php echo $mother_name; ?>">
                                    </div>
                                </div><!-- col-4 -->
                                <?php if($mother_title_id!=LOOKUP_VALUE_TITLE_LATE_ID) { ?>
                                <div class="col-lg-4" id="mother_mbleno_div">
                                    <label class="form-control-label">Mother's Mobile Number</label>
                                    <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                      <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                        <select class="form-control form_control custom-select Mobile_number" id="pd_mother_phone_no_code" name="pd_mother_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                          <option value="<?php echo $country_value_default; ?>" selected><?php echo $mother_country_mob_code;?></option>
                                        </select>
                                      </span>
                                      <input type="text" class="form-control" name="pd_mother_phone" id="pd_mother_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" value="<?php echo $mother_mobile; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4" id="mother_alt_mbleno_div">
                                    <label class="form-control-label">Mother's Alternative Mobile Number</label>
                                    <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                      <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                        <select class="form-control form_control custom-select Mobile_number" id="pd_mother_alt_phone_no_code" name="pd_mother_alt_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                          <option value="<?php echo $country_value_default; ?>" selected><?php echo $mother_alt_mob_country_code;?></option>
                                        </select>
                                      </span>
                                      <input type="text" class="form-control" name="pd_mother_alt_phone" id="pd_mother_alt_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" value="<?php echo $mother_alt_mobile;?>">
                                    </div>
                                </div>
                                <div class="col-lg-4" id="mother_email_div">
                                    <div class="form-group">
                                        <label class="form-control-label">Mother's Email ID </label>
                                        <input class="form-control" type="email" name="pd_mother_email" id="pd_mother_email"  placeholder="Enter Your Mother's Email ID" value="<?php echo $mother_email; ?>" maxlength="100">
                                    </div>
                                </div>
                                <div class="col-lg-4" id="mother_occupation_div">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Mother's Occupation</label>
                                        <select class="form-control select2" data-placeholder="Choose Occupation" tabindex="-1" aria-hidden="true" name="pd_mother_occupation" id="pd_mother_occupation">
                                          <option value=""><?php echo $mother_occupation;?></option>
                                        </select>
                                    </div>
                                    <?php if ($mother_occupation_id==OTHER_OCCUPATION) { ?>
                                    <div id="mother_other_occupation_div" class="form-group">
                                                  <input class="form-control" type="text" name="pd_mother_other_occupation" id="pd_mother_other_occupation"  placeholder="If Other, please enter here..."data-parsley-required="false"   data-parsley-errors-container="#custom-pd_mother_other_occupation-parsley-error" value="<?php echo $mother_other_occupation;?>">
                                                  <span id="custom-pd_mother_other_occupation-parsley-error"></span>
                                    </div>
                                  <?php } ?>
                                </div>
                                <?php } ?>
                                <!-- col-4 -->                            
                             </div>
                             <?php if (!empty($add_gardian) && $add_gardian=='t') { ?>
                             <div class="row w-100">
                                <label class="ckbox add_guardian_checkbox">
                                <div class="custom-control custom-checkbox">
                                  <input class="custom-control-input" type="checkbox" name="add_guardian_checkbox" id="add_guardian_checkbox" value="<?php echo ($add_gardian == 't')?'true':'false'; ?>" <?php echo ($add_gardian == 't')?'checked':''; ?>><label class="custom-control-label" for="add_guardian_checkbox"> Add Guardian Detail </label>
                                </div>
                                </label>
                             </div>
                          <div class="row w-100" id="guardian_details">
                            <div class="col-sm-12">
                            <h5 class="text-primary mt-4 mb-3 ml-0">Guardian's Details</h5>
                            </div>
                            
                            <div class="col-sm-12">
                             <div class="row w-100">
                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label class="form-control-label">Guardian's Name</label>
                                    <input class="form-control" type="text" name="pd_guardian_name" id="pd_guardian_name" placeholder="Enter Your Guardian Name" maxlength="50" value="<?php echo $guardian_name; ?>">
                                  </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <label class="form-control-label">Guardian's Mobile NO</label>
                                    <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                      <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                        <select class="form-control form_control custom-select Mobile_number" id="pd_guardian_phone_no_code" name="pd_guardian_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                          <option value="<?php echo $country_value_default; ?>" selected><?php echo $guardian_country_mob_code;?></option>
                                        </select>
                                      </span>
                                      <input type="text" class="form-control" name="pd_guardian_phone" id="pd_guardian_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Guardian's Mobile No" class="form-control" value="<?php echo $guardian_mobile; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Guardian's Email ID</label>
                                        <input class="form-control" type="email" name="pd_guardian_email" id="pd_guardian_email"  placeholder="Enter Your Guardian's Email ID" value="<?php echo $guardian_email; ?>" maxlength="100">
                                        <span id="custom-pd_guardian_email-parsley-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Guardian's Occupation <span class="tx-danger">*</span></label>
                                        <select class="form-control select2" data-placeholder="Choose Guardian Occupation" tabindex="-1" aria-hidden="true" name="pd_guardian_occupation" id="pd_guardian_occupation">
                                          <option value=""><?php echo $guardian_occupation;?></option>
                                        </select>
                                    </div>
                                    <?php if($guardian_occupation_id==OTHER_OCCUPATION) { ?>
                                    <div id="guardian_other_occupation_div" class="form-group">
                          						<input class="form-control" type="text" name="guardian_other_occupation" id="guardian_other_occupation"  placeholder="If Other, please enter here..."data-parsley-required="false"   data-parsley-errors-container="#custom-guardian_other_occupation-parsley-error" value="<?php echo $applicant_parent_occupation_other_name[$parent_type_id_guardian];?>">
                          						<span id="custom-guardian_other_occupation-parsley-error"></span>
                          		 </div>
                               <?php } ?>
                                </div>
                                <!-- col-4 -->
                             </div>
                             </div>
                            </div><!-- end gard -->
                             <!-- row -->
                             <?php } ?>
                             <!-- address -->
                            <div class="row w-100">
                             <div class="col-sm-12">
                            <h5 class="text-primary mt-4 mb-3 ml-0">Address for communication</h5>
                            </div>
                           
                                <div class="col-md-4">
                                   <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Country<span class="tx-danger"> *</span></label>
                                      <select class="form-control select2" data-placeholder="Choose country" tabindex="-1" aria-hidden="true" name="country" id="country" title="Choose Country">
                                        <option value=""><?php echo $country_name;?></option>
                                      </select>
                                   </div>
                                </div>
                                <!-- col-4 -->
                                <?php if($country_id==COUNTRY_VALUE_DEFAULT) { ?>
                                <div class="col-md-4" id="main_div_state">
                                   <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">State<span class="tx-danger"> *</span></label>
                                      <select class="form-control select2" data-placeholder="Choose State" tabindex="-1" aria-hidden="true" name="state" id="state" title="Choose State">
                                        <option value=""><?php echo $state_name;?></option>
                                      </select>
                                   </div>
                                </div>
                                <!-- col-4 -->
                                <div class="col-md-4" id="main_div_district">
                                   <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">District<span class="tx-danger"> *</span></label>
                                      <select class="form-control select2" data-placeholder="Choose District" tabindex="-1" aria-hidden="true" name="district" id="district" title="Choose District">
                                        <option value=""><?php echo $district_name;?></option>
                                      </select>
                                   </div>
                                </div>
                                <!-- col-4 -->
                                
                                <div class="col-md-4" id="main_div_city">
                                   <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">City<span class="tx-danger"> *</span></label>
                                      <select class="form-control select2" data-placeholder="Choose City" tabindex="-1" aria-hidden="false" name="city" id="city" title="Choose City">
                                        <option value=""><?php echo $city_name;?></option>
                                      </select>
                                   </div>
                                </div>
                                <?php } ?>
                                <!-- col-4 -->
                                <div class="col-md-4">
                                   <div class="form-group">
                                      <label class="form-control-label">Address Line 1 <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="address_line1" id="address_line1" placeholder="Enter Address Line 1" value="<?php if($add_line_1) {echo $add_line_1;} ?>" maxlength="100">
                                   </div>
                                </div>
                                <!-- col-4 -->
                                <div class="col-md-4">
                                   <div class="form-group">
                                      <label class="form-control-label">Address Line 2 <!--<span class="tx-danger">*</span>--></label>
                                      <input class="form-control" type="text" name="address_line2" id="address_line2" placeholder="Enter Address Line 2" value="<?php if($add_line_2) {echo $add_line_2;} ?>" maxlength="100">
                                   </div>
                                </div>
                                <!-- col-4 --> 
                                
                                <div class="col-md-4">
                                   <div class="form-group">
                                      <label class="form-control-label">Pincode <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Pincode"  value="<?php if($pin_code) {echo $pin_code;} ?>" maxlength="10">
                                   </div>
                                </div> 
                             
                             
                             </div>
                            <!-- end addess -->
                             
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
                             <div class="col-lg-6">
                                <div class="form-group">
                                  <label class="form-control-label">Current Education Qualification Status <span class="tx-danger">*</span></label>
                                  <div class="row">
                                    <div class="col-lg-4 pr-0">
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="appering" name="current_education_qual_status" class="custom-control-input" value="1" <?php echo ($cur_qual_completed == 'f')?'checked':''; ?>>
                                        <label class="custom-control-label" for="appering">12th Appearing</label>
                                      </div>
                                    </div>
                                    <div class="col-lg-4 pl-0">
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="completed" name="current_education_qual_status" class="custom-control-input" value="2" <?php echo ($cur_qual_completed == 't')?'checked':''; ?>>
                                        <label class="custom-control-label" for="completed">12th Completed</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                             </div>
                             <div class="col-lg-6 ">
                                <div class="form-group wd-xs-300 mr-5 w-100">
                                  <label class="form-control-label">Candidate Name as in 10th Certificate <span class="tx-danger">*</span></label>
                                  <div class="form-group mg-b-10-force">
                                    <input class="form-control" type="text" name="tenth_name" id="tenth_name" placeholder="Enter Name" value="<?php echo $tenth_name; ?>" maxlength="100">
                                    <small id="emailHelp" class="form-text text-muted">Kindly type "NA" in case 10th Certificate is not available with you.</small>
                                  </div>
                                </div>
                                <!-- form-group -->
                             </div>
                          </div>
                          <section class="row">
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
                                    <th class="align-middle reg_width"> Roll No. / Registration No</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><p>XII</p><input type="hidden" name="schooling_id" id="schooling_id" value="<?php echo $schooling_id; ?>" ></td>
                                    <td><input class="form-control" type="text" name="institute_name" id="institute_name" placeholder="Enter School Institute Name" value="<?php echo $institute_name; ?>" maxlength="100"></td>
                                    <td>
                                      <div class="form-group mg-b-10-force">
                                        <select class="form-control custom-select" name="board" id="board">
                                          <option value=""><?php echo $board_name;?></option>
                                        </select>
                                      </div>
                                      <?php if($other_board_name != '') { ?>
                                      <div class="form-group" id="other_board1">
                      					<input type="text" class="form-control" name="other_board" id="other_board" placeholder="If Other, please enter here.." maxlength="100"  value="<?php echo $other_board_name; ?>">
                      				</div>
                            <?php }?>
                                    </td>
                                    <td>
                                      <div class="form-group mg-b-10-force">
                                        <select class="form-control custom-select" name="mode_of_study" id="mode_of_study">
                                          <option value=""><?php echo $mode_of_study_name; ?></option>
                                        </select>
                                      </div>
                                    </td>                                    
                                    <td>
                                      <?php if($cur_qual_completed == 't') { ?>
                                      <div class="form-group mg-b-10-force" id="appering_info_1">
                                        <select class="form-control custom-select" name="marking_scheme" id="marking_scheme">
                                          <option value=""><?php echo $marking_scheme_name; ?></option>
                                        </select>
                                      </div>
                                    <?php } ?>
                                    </td>
                                    <td>
                                      <?php if($cur_qual_completed == 't') { ?>
                                        <input class="form-control" type="text" name="obtained_percentage_cgpa" placeholder="Obtained Percentage/CGPA" id="obtained_percentage_cgpa" maxlength="5" value="<?php echo $obtained_percentage_cgpa; ?>">
                                      <?php } ?>
                                    </td>
                                    <td>
                                      <?php if($cur_qual_completed == 't') { ?>
                                        <input class="form-control" type="text" name="year_of_passing" id="year_of_passing" placeholder="YYYY" maxlength="4" value="<?php echo $year_of_passing; ?>">
                                        <?php } ?>
                                    </td>
                                    <td class="reg_width">
                                      <?php if($cur_qual_completed == 't') { ?>
                                        <input class="form-control" type="text" name="registration_no" id="registration_no" placeholder="Roll No. / Registration No" maxlength="10" value="<?php echo $registration_no; ?>">
                                        <?php } ?>
                                    </td>
                                  </tr>
                                </tbody>
                             </table>
                           </div>
                             <div class="w-100 mt-3">
                                <div class="row">
                                   <div class="col-md-6">
                                      <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Address of School / College <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="address_of_school_college" id="address_of_school_college" placeholder="Enter School / College"  value="<?php echo $address_of_school_college; ?>" maxlength="100">
                                      </div>
                                   </div>
                                   <div class="col-md-6">
                                      <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">NAD ID / Digilocker ID</label>
                                        <input class="form-control" type="text" name="nad_id_digilocker_id" id="nad_id_digilocker_id" placeholder="Enter NAD ID / Digilocker ID " value="<?php echo $nad_id_digilocker_id; ?>" maxlength="12">
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </section>
                       </div>
                    </div>
                 </div>
                 <!-- Geetha -->
                 <div class="card card_print" id="preview_payment">
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
                                         <p class="card-subtitle mb-3">Name : <?php echo $first_name .' ' . $last_name ?> </p>
                                         <p class="card-subtitle mb-3">E-Mail : <?php echo $email_id; ?></p>
                                         <p class="card-subtitle">Phone Number : <?php echo $applicant_mob_country_code_name."-".$mobile_no; ?></p>
                                      </div>
                                   </div>
                                   <!-- card -->
                                   <div class="card base_details_card">
                                      <div class="card-body">
                                         <h5 class="card-title card_title">Order Details</h5>
                                         <p class="card-subtitle">Application Fee <span style="float: right;"><?php echo $appln_form_fee; ?></span>
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
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                     <input type="radio" id="online" name="payment_mode" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="Please Choose Payment Mode" data-parsley-errors-container="#custom-payment_mode-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($payment_mode_id == PAYMENT_MODE_ONLINE_ID)?'checked':''; ?>>
                                                    <label class="custom-control-label" for="online">Online</label>
                                                    </div>
                                          </div>
                                           <div class="col-lg-2">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="dd" name="payment_mode" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="Please Choose Payment Mode" data-parsley-errors-container="#custom-payment_mode-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($payment_mode_id == PAYMENT_MODE_DEMAND_DRAFT_ID)?'checked':''; ?>>
                                            <label class="custom-control-label" for="dd">DD</label>
                                        </div>
                        </div>
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
                                          <option value=""  selected="selected"><?php echo $bank_name;?></option>
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
                                    <div class="flexbox flex-start">You must send your
                                        DD&nbsp;in favor of "SRMIST" Payable at Chennai.
                                        along with
                                        your Application Form with complete details
                                        (Full Name, Application Number, Mobile) to
                                        &nbsp;the
                                        below-mentioned address:<br><br>The Director
                                        (Admissions)<br>SRM Institute of Science and
                                        technology<br>SRM
                                        Nagar,<br>Kattankulathur-603 203<br>Chengalpattu
                                        District<br>Tamil Nadu, India </div>
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
                 <div class="card card_print">
                    <div class="card-header" id="headingSix">
                       <h2 class="mb-0"> 
                          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix"> Upload & Declaration</button>
                       </h2>
                    </div>
                    <div id="collapseSix" class="collapse show bg-light" aria-labelledby="headingSix" data-parent="#accordionExample">
                       <div class="card-body">
                          <section class="row">
                             <div class="col-md-12">
                                <div class="form-layout">
                                   <div class="row mg-b-25 mt-3">
                                      <div class="row w-100">
                                         <div class="form-group col-md-6 ">
                                            <label for="exampleFormControlTextarea1">Upload Your Recent Passport Size Photograph <span class="tx-danger">*</span></label>
                                            <input type="file" class="filestyle" name="photograph" id="photograph" data-parsley-required="<?php echo ((isset($docs[$document_id_photograph]))?'false':'true'); ?>" data-parsley-required-message="Please upload photograph" data-parsley-errors-container="#custom-photograph-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>">
                                            <?php if(isset($docs[$document_id_photograph])){ ?>
                                            <!-- <span class='file_name  mt-3' ><a class="image-popup-vertical-fit" href="<?php echo base_url().$docs[$document_id_photograph]['file_path'];?>" target="_blank" title="<?php echo $docs[$document_id_photograph]['file_name_user']; ?>"><?php echo $docs[$document_id_photograph]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                            <a href="javascript:void(0)" data-del-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>" data-doc-id="<?php echo $document_id_photograph; ?>" data-toggle="modal" data-target="#contentDeletePop" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                                            <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_photograph; ?>">
                                               <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_photograph; ?>')">&times;</a>
                                               <strong id="deleteMessageStatus_<?php echo $document_id_photograph; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_photograph; ?>"></span>
                                            </div>
                                            <?php } ?>
                                            <span id="custom-photograph-parsley-error"></span>
                                         </div>
                                         <div class="form-group col-md-6">
                                            <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Signature</label>
                                            <input type="file" class="filestyle" name="signature" id="signature" data-parsley-required="<?php echo ((isset($docs[$document_id_signature]))?'false':'true'); ?>" data-parsley-required-message="Please upload signature" data-parsley-errors-container="#custom-signature-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>">
                                            <?php if(isset($docs[$document_id_signature])){ ?>
                                            <!-- <span class='file_name  mt-3' ><a class="image-popup-vertical-fit" href="<?php echo base_url().$docs[$document_id_signature]['file_path'];?>" target="_blank" title="<?php echo $docs[$document_id_signature]['file_name_user']; ?>"><?php echo $docs[$document_id_signature]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                            <a href="javascript:void(0)" data-del-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>" data-doc-id="<?php echo $document_id_signature; ?>" data-toggle="modal" data-target="#contentDeletePop" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
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
                                            <p>I certify that the information submitted by me in support of this application, is true to the best of my knowledge and belief. I understand that in the event of any information being found false or incorrect, my admission is liable to be rejected / cancelled at any stage of the program. I undertake to abide by the disciplinary rules and regulations of the institute</p>
                                         </div>
                                      </div>
                                      <div class="row w-100">
                                         <div class="col-md-6">
                                            <label class="form-control-label">Applicant Name <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" name="applicant_name" id="applicant_name" placeholder="Applicant Name" maxlength="100"  value="<?php echo $applicant_name; ?>">
                                         </div>
                                         <div class="col-md-6">
                                            <label class="form-control-label">Parent Name <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" name="parent_name" id="parent_name" placeholder="Parent Name" maxlength="100" value="<?php echo $parent_name; ?>">
                                         </div>
                                      </div>
                                      <div class="row w-100 mt-3">
                                         <div class="col-md-6">
                                            <label class="form-control-label">Date <span class="tx-danger">*</span></label>
                                            <input class="form-control" type="text" name="declaration_date" id="declaration_date" value="<?php echo $declaration_date; ?>" readonly>
                                         </div>
                                      </div>
                                   </div>
                                   <!-- row -->
                                </div>
                             </div>
                          </section>
                       </div>
                    </div>
                 </div>
                 <!-- Geetha -->
              </div>
         </div>
      </div>
   </div>
