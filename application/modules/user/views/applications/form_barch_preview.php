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
/*Constants*/

/*File Upload Start*/
$docs = array();
$file_count = 0;
if ($upload_filelist) {
    foreach ($upload_filelist as $doc) {
        $docs[$doc['document_id']] = array(
            'id' => $doc['id'],
            'file_name' => $doc['name'],
            'file_name_user' => remove_file_separator($doc['name']),
            'file_name_truncate' => remove_file_separator($doc['name'], true),
            'file_path' => $doc['path'],
        );
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
$mob_country_code_name = !empty($applicant_basic_details_list['applicant_mob_country_code_name']) ? $applicant_basic_details_list['applicant_mob_country_code_name'] : 'Select';
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
$gender_name = !empty($applicant_basic_details_list['gender']) ? $applicant_basic_details_list['gender'] : 'Select';
$blood_grp_name = !empty($applicant_basic_details_list['blood_group']) ? $applicant_basic_details_list['blood_group'] : 'Select';
$social_status_id = $applicant_basic_details_list['social_status_id'];
$social_status = $applicant_basic_details_list['social_status'];
$dif_abled = $applicant_basic_details_list['dif_abled'];

$religion_id = $applicant_basic_details_list['religion_id'];
$religion_name = !empty($applicant_basic_details_list['religion_name']) ? $applicant_basic_details_list['religion_name'] : 'Select';
$medium_of_instruction_id = $applicant_other_details_list['medofinst'];
$medium_of_instruction = $applicant_other_details_list['medium_of_study_name'];
$add_gardian = $applicant_other_details_list['add_gardian'];
$hostel_accommodation_id = $applicant_basic_details_list['hostel_accommodation_id'];
$hostel_accommodation = $applicant_basic_details_list['hostel_accommodation'];

$mother_tongue_id = $applicant_basic_details_list['mothertongue_id'];
$mothertongue_name = !empty($applicant_basic_details_list['mothertongue_name']) ? $applicant_basic_details_list['mothertongue_name'] : 'Select';

$advertisement_source_id = $applicant_basic_details_list['advertisement_source_id'];
$source_name = !empty($applicant_basic_details_list['source_name']) ? $applicant_basic_details_list['source_name'] : 'Select';

$nationality = !empty($applicant_basic_details_list['nationality']) ? $applicant_basic_details_list['nationality'] : 'Select';
$nation_id = !empty($applicant_basic_details_list['nation_id']) ? $applicant_basic_details_list['nation_id'] : 'Select';
$social_status = !empty($applicant_basic_details_list['social_status']) ? $applicant_basic_details_list['social_status'] : 'Select';

$prefer_hostel = $applicant_basic_details_list['prefer_hostel'];
  if($prefer_hostel == 't') {
          $hostel_accommodation_select_name = 'Yes';
  } else if($prefer_hostel == 'f') {
    $hostel_accommodation_select_name = 'No';
  }else{
    $hostel_accommodation_select_name = 'Select';
  }
$dif_abled = $applicant_basic_details_list['dif_abled'];
if($dif_abled){
  $diff_abled_select_name = 'Yes';
}else if($dif_abled == 'f') {
    $diff_abled_select_name = 'No';
  }else{
    $diff_abled_select_name = 'Select';
  }

$medium_of_study_name = !empty($applicant_other_details_list['medium_of_study_name']) ? $applicant_other_details_list['medium_of_study_name'] : 'Select';

$nad_id_digilocker_id = $applicant_basic_details_list['digilocker_id'];
/*Basic Details End*/

/*Parent Details Start*/

//Parent Details Start
$is_competitive_exam = $applicant_other_details_list['is_competitive_exam'];
$is_competitive_exam_name = 'Select';
if($is_competitive_exam == 't')
{
  $is_competitive_exam_name ='Yes';
}else if($is_competitive_exam == 'f')
{
  $is_competitive_exam_name ='No';
}

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

$parent_name = $applicant_basic_details_list['parent_name'];
//$father_name = $applicant_parent_parent_name[$parent_type_id_father];
//$mothers_name = $applicant_parent_parent_name[$parent_type_id_mother];
//$guardian_name = $applicant_parent_parent_name[$parent_type_id_guardian];
$parent_name = (($parent_name)?$parent_name:(($father_name)?$father_name:(($mother_name)?$mother_name:(($guardian_name)?$guardian_name:''))));
/*Parent Details End*/


/*Address Details Start*/
//print_r($applicant_address_details_list);
//Start address
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
    $pin_code=$applicant_address_details_list[0]['pin_code'];
}
$country_id=isset($country_id) ?$country_id:'';
$country_name=isset($country_name) ?$country_name : 'Select Country';
$state_name=isset($state_name) ?$state_name : 'Select State';
$district_name=isset($district_name) ?$district_name : 'Select District';
$city_name=isset($city_name) ?$city_name : 'Select City';
//End address

/*Address Details End*/

/*Other Details Start*/
$cur_qual_completed = $applicant_other_details_list['cur_qual_completed'];
$is_competitive_exam = $applicant_other_details_list['is_competitive_exam'];
/*Other Details End*/

$applicant_schooling_id  = $applicant_schooling_name = $applicant_institute_name = $applicant_board_id = $applicant_board_name = $applicant_marking_scheme_id = $applicant_marking_scheme_name = $applicant_obtained_percentage_cgpa = $applicant_year_of_passing = $applicant_registration_no =  $applicant_tenth_name = $applicant_mode_of_study_id = $applicant_mode_of_study_name = $applicant_address_of_school_college = $applicant_scl_det_id = $applicant_result_declared = $app_comp_exam_id = $app_comp_exam_name = $app_comp_registration_no =  $app_comp_score_obtained = $app_comp_max_score = $app_comp_exam_year = $app_comp_all_india_rank = $app_comp_qualified = $applicant_entr_exam_det_id = $campus_prefer_name = array();

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
$qualify_0_name = "Not Qualified";
$qualify_1_name = "Not Qualified";
$qualify_2_name = "Not Qualified";
if($app_comp_qualified[0] == 't')
{
        $qualify_0_name = "Qualified";
}
if($app_comp_qualified[1] == 't')
{
        $qualify_1_name = "Qualified";
 }

if($app_comp_qualified[2] == 't')
{
        $qualify_2_name = "Qualified";
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
    if($is_qualify == 't') {
    $studied_from_india_id = 'yes';
    $studied_from_india_name = 'Yes';
    } else {
    $studied_from_india_id = 'no';
    $studied_from_india_name = 'No';
  }
}


//Course Prefer
if($applicant_course_details_list) {
  foreach($applicant_course_details_list as $k=>$v) {
      $applicant_course_prefer_id = $v['applicant_course_id'];
      $course_prefer_id = $v['course_id'];
      $course_prefer_name=$v['course_name'];
   }
}

//print_r($applicant_address_details_list);

//Campus Prefer
if($applicant_campus_details_list) {
  foreach($applicant_campus_details_list as $k=>$v) {
      $applicant_campus_prefer_id = $v['applicant_campus_prefer_id'];
      $campus_prefer_id[] = $v['campus_id'];
      $campus_prefer_name[]=$v['campus_name'];
   }
}


$course_1 = isset($course_prefer_name) ? $course_prefer_name : 'Select Course Preference';
$campus_1 = isset($campus_prefer_name[0]) ? $campus_prefer_name[0] : 'Select Campus Preference 1';
$campus_2 = isset($campus_prefer_name[1]) ? $campus_prefer_name[1] : 'Select Campus Preference 2';


$applicant_name = $applicant_appln_details_list[0]['applicant_name_declaration'];
$applicant_name_declaration = ($applicant_name)?$applicant_name:$first_name;
$applicant_parentname_declaration = ($applicant_appln_details_list[0]['applicant_parentname_declaration'])?$applicant_appln_details_list[0]['applicant_parentname_declaration']:$parent_name;
$declaration_date = $applicant_appln_details_list[0]['applicant_declaration_date'];
$applicant_declaration_date = ($declaration_date)?date('d/m/Y',strtotime($declaration_date)):date('d/m/Y');


$appln_form_fee = $applicant_appln_details_list[0]['appln_form_fee'];

/* Payment Details Start */
$branch_name = $payment_details_list['branch_name'];
$dd_cheque_no = $payment_details_list['dd_cheque_no'];
$dd_cheque_date = $payment_details_list['dd_cheque_date'];
if($dd_cheque_date) {
  $dd_cheque_date = date('d/m/Y',strtotime($dd_cheque_date));
}
$payment_mode_id = $payment_details_list['payment_mode_id'];
$bank_name=$payment_details_list['bank_name'];
$bank_name=isset($bank_name)? $bank_name:'Select Bank Name';
/* Payment Details End */

$startIndex = $this->input->get('startIndex', true);

/*CRM ADMIN Edit form start*/
$url = base_url().'barch?startIndex='.$startIndex;
if($mode_edit == ADMIN_MODE_EDIT)
{
  $url = base_url().'barch/'.$mode_edit.'/'.$crm_applicant_login_id.'/'.$crm_applicant_personal_det_id.'?startIndex='.$startIndex;;
}
/*CRM ADMIN Edit form start*/
 
?>
<div class="row">
<div class="col-md-1">
<!-- <a href="<?php echo base_url();?>barch" class="btn btn-primary active w-100 mt-3" role="button" aria-pressed="true">Back</a> -->
<a href="<?php echo $url ; ?>" class="btn btn-primary active w-100 mt-3" role="button" aria-pressed="true">Back</a>
</div>
</div>
<div class="row disable_div_preview" id="barchdesign_form">
<div class="col-sm-12">
<div class="card " id="BarchPreviewToPrint">
<div class="card-body">
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
          <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Have you studied 10+2 from India?
                          <span class="tx-danger">*</span></label>
                         <select class="form-control custom-select study" id="graduation_india" 
                         name="graduation_india" data-placeholder="Select Status - Yes or No" data-parsley-required="true" data-parsley-required-message="Please select study from India" data-parsley-errors-container="custom-studied_from_india-parsley-error" data-parsley-trigger="change">
                         <option value=""><?php echo $studied_from_india_name ;?></option>
                         </select>
                      </div>
                      <span id="custom-studied_from_india-parsley-error"></span>
                   </div>
                   <!-- col-4 -->
                   <!-- col-4 -->
                   <div class="col-lg-12" id="study_info">
                      <p class="checkbox_instructions">Please note that you have selected "YES" for the above which implies you are eligible
                         to seek admission under domestic category. It is the sole responsibility of the candidate to ensure that he/she is
                         applying under the right category.
                      </p>
                      <label class="rdiobox">
                      <input name="qualifyingexamfromindia" type="checkbox" id="qualifyingexamfromindia" data-parsley-required="false" data-parsley-required-message="Please check Confirm" <?php echo ($is_agree == 't')?'checked':0; ?>>
                      <span>I Confirm</span>
                      </label>
                   </div>
                   <div class="form-group formAreaCols col-lg-12" id="resident_info_message">NRI and Foreign Students please go to the below link to proceed further.<br><br><a
                      href="https://intlapplications.srmist.edu.in/international-application-form-2020"><b>https://intlapplications.srmist.edu.in/international-application-form-2020</b></a>
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
		<h5 class="text-primary mb-3">Select Course Preferences</h5>
        <div class="row w-100">
			<div class="col-lg-4">
			  <div class="form-group mg-b-10-force">
				 <label class="form-control-label">Course Perference 1 
					<span class="tx-danger">*</span></label>
				 <select class="form-control custom-select study" data-placeholder="Choose Course Preference 1" tabindex="-1" aria-hidden="true" name="course_pref_1" id="course_pref_1" title="Choose Course Preference 1" data-parsley-required="true" data-parsley-required-message="Please Choose Course Preference 1" data-parsley-errors-container="#custom-course_pref_1-parsley-error" data-parsley-trigger="change">
						<option value=""><?php echo $course_1; ?></option>
					</select>
					<span id="custom-course_pref_1-parsley-error"></span>
			  </div>
			</div>
			<!-- col-4 -->

			<div class="col-lg-4" id="main_div_camp_pref_1">
			  <div class="form-group mg-b-10-force">
				 <label class="form-control-label">Campus Perference 1
				 <span class="tx-danger">*</span></label>
				 <select class="form-control custom-select study" data-placeholder="Choose Campus Preference 1" tabindex="-1" aria-hidden="true" name="campus_pref_1" id="campus_pref_1" title="Choose Campus Preference 1" data-parsley-required="true" data-parsley-required-message="Please Choose Campus Preference 1" data-parsley-errors-container="#custom-campus_pref_1-parsley-error" data-parsley-trigger="change">
						<option value=""><?php echo $campus_1; ?></option>
				 </select>
					<span id="custom-campus_pref_1-parsley-error"></span>
			  </div>
			</div>
			<!-- col-4 -->
			<div class="col-lg-4" id="main_div_camp_pref_2">
			  <div class="form-group mg-b-10-force">
				 <label class="form-control-label">Campus Perference 2 
					<!-- <span class="tx-danger">*</span> --></label>
			 <select class="form-control custom-select" id="campus_pref_2" name="campus_pref_2"
			 data-placeholder="Choose Campus Preference 2" tabindex="-1" aria-hidden="true" name="campus_pref_2" id="campus_pref_2" title="Choose Campus Preference 2" data-parsley-required="false" data-parsley-required-message="Please Choose Campus Preference 2" data-parsley-errors-container="#custom-campus_pref_2-parsley-error" data-parsley-trigger="change">
          <option value=""><?php echo $campus_2; ?></option>
				 </select>
			  </div>
			</div>	
			<br>
					<div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Title</label>
                         <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_title" id="pd_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="Please Choose Title" data-parsley-errors-container="#custom-title_id-parsley-error" data-parsley-trigger="change">
                                <option value=""><?php echo $applicant_basic_details_list['tittle_name'];?></option>
                            </select>
                            <span id="custom-title_id-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group">
                         <label class="form-control-label">FirstName 
                          <span class="tx-danger">*</span></label>
                         <input class="form-control" type="text" name="pd_firstname" id="pd_firstname" placeholder="Your First Name" maxlength="100" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter First Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 100]" value="<?php echo $first_name; ?>" data-parsley-trigger="change">
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group">
                         <label class="form-control-label">Middle Name </label>
                         <input class="form-control" type="text" name="pd_middlename" id="pd_middlename" placeholder="Your Middle Name" value="<?php echo $m_name; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" maxlength="50" data-parsley-trigger="change">
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group">
                         <label class="form-control-label">LastName 
                          <span class="tx-danger">*</span></label>
                         <input class="form-control" type="text" name="pd_lastname" id="pd_lastname" placeholder="Your Last Name" maxlength="50" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Last Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" value="<?php echo $last_name; ?>" data-parsley-trigger="change">
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <label class="form-control-label">Mobile NO <span
                         class="tx-danger">*</span></label>
                      <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                         <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="phone_no_code" name="phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                  <option value="<?php echo $country_value_default; ?>" selected><?php echo $mob_country_code_name ;?></option>
                              </select>
                         </span>
                         <input type="text" name="pd_mobile_no" id="pd_mobile_no" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Mobile No" class="form-control" data-parsley-required="true" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-errors-container="#custom-pd_mobile_no-parsley-error" value="<?php echo $mob_no; ?>" data-parsley-trigger="change">
                      </div>
                      <span id="custom-pd_mobile_no-parsley-error"></span>
                   </div>
                   <div class="col-lg-4">
                      <div class="form-group">
                         <label class="form-control-label">Email ID 
                          <span class="tx-danger">*</span></label>
                         <input class="form-control" type="email" name="pd_email" id="pd_email" placeholder="Your email id." data-parsley-required="true" data-parsley-required-message="Please Enter Email ID" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Email ID" data-parsley-errors-container="#custom-pd_email-parsley-error" value="<?php echo $email_id; ?>" data-parsley-trigger="change">
                            <span id="custom-pd_email-parsley-error"></span>
                      </div>
                   </div>
                   <div class="col-lg-4">
                      <div class="wd-200 w-100">
                         <label class="form-control-label">Date of Birth<span class="tx-danger">*</span></label>
                         <div class="input-group">
                            <span class="input-group-addon"><i  class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                            <input type="text" class="form-control hasDatepicker" name="pd_dob" id="pd_dob" placeholder="DD/MM/YYYY" value="<?php echo  $dob; ?>" readonly data-parsley-required="true" data-parsley-required-message="Please Enter Date of Birth" data-parsley-errors-container="#custom-pd_dob-parsley-error" data-parsley-trigger="change focusout">
                            </div>
                            <span id="custom-pd_dob-parsley-error"></span>
                      </div>
                   </div>
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Gender <span class="tx-danger">*</span></label>
                         <select class="form-control select2" data-placeholder="Choose Gender" tabindex="-1" aria-hidden="true" name="pd_gender" id="pd_gender" title="Choose Gender" data-parsley-required="true" data-parsley-required-message="Please Choose Gender" data-parsley-errors-container="#custom-pd_gender-parsley-error" data-parsley-trigger="change">
                                <option value=""><?php echo $gender_name;?></option>
                            </select>
                            <span id="custom-pd_gender-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group">
                         <label class="form-control-label">Alternate Email ID </label>
                         <input class="form-control" type="email" name="pd_alt_email" id="pd_alt_email" placeholder="Alternate Email" data-parsley-required="false" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Alternate Email ID" data-parsley-errors-container="#custom-pd_alt_email-parsley-error" data-parsley-trigger="change" value="<?php echo $sec_e_mail; ?>">
                            <span id="custom-pd_alt_email-parsley-error"></span>
                      </div>
                   </div>
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Blood Group 
                          <!-- <span class="tx-danger">*</span> --></label>
                         <select class="form-control select2" data-placeholder="Choose Blood Group" tabindex="-1" aria-hidden="true" name="pd_blood_group" id="pd_blood_group" title="Choose Blood Group" data-parsley-required="false" data-parsley-required-message="Please Choose Blood Group" data-parsley-errors-container="#custom-pd_blood_group-parsley-error" data-parsley-trigger="change">
                                <option value=""><?php echo $blood_grp_name;?></option>
                            </select>
                            <span id="custom-pd_blood_group-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Religion</label>
                         <select class="form-control select2" data-placeholder="Choose Religion" tabindex="-1" aria-hidden="true" name="pd_religion" id="pd_religion" title="Choose Religion" data-parsley-required="false" data-parsley-required-message="Please Choose Religion" data-parsley-errors-container="#custom-pd_religion-parsley-error" data-parsley-trigger="change">
                          <option value=""><?php echo $religion_name;?></option>
                            </select>
                            <span id="custom-pd_religion-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Mother Tongue</label>
                         <select class="form-control select2" data-placeholder="Choose Mother Tongue" tabindex="-1" aria-hidden="true" name="pd_mother_tongue" id="pd_mother_tongue" title="Choose Mother Tongue" data-parsley-required="false" data-parsley-required-message="Please Choose Mother Tongue" data-parsley-errors-container="#custom-pd_mother_tongue-parsley-error" data-parsley-trigger="change">
                                <option value=""><?php echo $mothertongue_name;?></option>
                            </select>
                            <span id="custom-pd_mother_tongue-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Medium of Instruction</label>
                         <select class="form-control select2" data-placeholder="Choose Medium of Instruction" tabindex="-1" aria-hidden="true" name="pd_medium_of_instruction" id="pd_medium_of_instruction" title="Choose Medium of Instruction" data-parsley-required="true" data-parsley-required-message="Please Choose Medium of Instruction" data-parsley-errors-container="#custom-pd_medium_of_instruction-parsley-error" data-parsley-trigger="change">
                                <option value=""><?php echo $medium_of_study_name;?></option>
                            </select>
                            <span id="custom-pd_medium_of_instruction-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Hostel Accommodation</label>
                         <select class="form-control select2" data-placeholder="Choose Hostel Accommodation" tabindex="-1" aria-hidden="true" name="pd_hostel_accommodation" id="pd_hostel_accommodation" title="Choose Hostel Accommodation" data-parsley-required="false" data-parsley-required-message="Please Choose Hostel Accommodation" data-parsley-errors-container="#custom-pd_hostel_accommodation-parsley-error" data-parsley-trigger="change">
                                <option value=""><?php echo $hostel_accommodation_select_name;?></option>
                            </select>
                            <span id="custom-pd_hostel_accommodation-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Are you a differently
                         Abled?<span class="tx-danger">*</span></label>
                         <select class="form-control select2" data-placeholder="Choose Differently Abled" tabindex="-1" aria-hidden="true" name="pd_diffrently_abled" id="pd_diffrently_abled" title="Choose Differently Abled" data-parsley-required="false" data-parsley-required-message="Please Choose Differently Abled" data-parsley-errors-container="#custom-pd_diffrently_abled-parsley-error" data-parsley-trigger="change">
                                <option value=""><?php echo $diff_abled_select_name;?></option>
                            </select>
                            <span id="custom-pd_diffrently_abled-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Where do you see admission
                         advertisment?</label>
                         <select class="form-control select2" data-placeholder="Choose Advertisement Source" tabindex="-1" aria-hidden="true" name="pd_advertisement_source" id="pd_advertisement_source" title="Choose Advertisement Source " data-parsley-required="false" data-parsley-required-message="Please Choose Advertisement Source" data-parsley-errors-container="#custom-pd_advertisement_source-parsley-error" data-parsley-trigger="change">
                                <option value=""><?php echo $source_name;?></option>
                            </select>
                            <span id="custom-pd_advertisement_source-parsley-error"></span>
                      </div>
                   </div>
                   <!-- col-4 -->
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force">
                         <label class="form-control-label">Nationality <span class="tx-danger">*</span></label>
                        <select class="form-control select2" data-placeholder="Choose Nationality" tabindex="-1" aria-hidden="true" name="pd_nationality" id="pd_nationality" title="Choose Nationality" data-parsley-validate-if-empty="true" data-parsley-errors-container="#custom-pd_nationality-parsley-error" data-parsley-btech-basic-check="studied_from_india,<?php echo $country_value_default; ?>,no,1" data-parsley-trigger="change" data-parsley-required="true" data-parsley-required-message="Please Choose Nationality">
                      <option value=""><?php echo $nationality;?></option>
                      </select>
                      <span id="custom-pd_nationality-parsley-error"></span>  
                      </div>
                   </div>
                   <!-- col-4 -->
                   <?php if($nation_id==COUNTRY_VALUE_DEFAULT) {?>
                   <div class="col-lg-4">
                      <div class="form-group mg-b-10-force" id="Community">
                         <label class="form-control-label">Community <span class="tx-danger">*</span></label>
                         <select class="form-control select2" data-placeholder="Choose Community" tabindex="-1" aria-hidden="true" name="pd_social_status" id="pd_social_status" title="Choose Community" data-parsley-required="true" data-parsley-required-message="Please Choose Community" data-parsley-errors-container="#custom-pd_social_status-parsley-error" data-parsley-trigger="change">
                                <option value="">Choose Community</option>
                            </select>
                            <span id="custom-pd_social_status-parsley-error"></span>
                      </div>
                   </div>
                 <?php } ?>
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
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Title<span class="tx-danger">*</span></label>
                            <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_father_title" id="pd_father_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="Please Choose Title" data-parsley-errors-container="#custom-pd_father_title-parsley-error" data-parsley-trigger="change">
                              <option value=""><?php echo $father_title_name;?></option>
                            </select>
                            <span id="custom-pd_father_title-parsley-error"></span>
                            <input type="hidden" name="pd_father_id" id="pd_father_id" value="<?php echo $app_parent_det_id[$parent_type_id_father]; ?>" />
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Father's Name <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="pd_father_name" id="pd_father_name" placeholder="Enter Your Father Name" maxlength="50" data-parsley-required="true" data-parsley-required-message="Please Enter Your Father Name" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" value="<?php echo $father_name; ?>" />
                        </div>
                    </div><!-- col-4 -->
                    <?php if($father_title_id!=LOOKUP_VALUE_TITLE_LATE_ID) { ?>
                    <div class="col-lg-4" id="father_mbleno_div">
                        <label class="form-control-label">Father's Mobile Number</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="pd_father_phone_no_code" name="pd_father_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                           <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected><?php echo $father_country_mob_code;?></option>
                          </select>
                        </span>
                        <input type="text" class="form-control" name="pd_father_phone" id="pd_father_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_father_phone-parsley-error" value="<?php echo $father_mobile; ?>">
                      </div>
                      <span id="custom-pd_father_phone-parsley-error"></span>
                    </div>
                    <div class="col-lg-4" id="father_alt_mbleno_div">
                      <label class="form-control-label">Father's Alternate Mobile Number</label>
                      <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="pd_father_alt_phone_no_code" name="pd_father_alt_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                            <option value="<?php echo $country_value_default; ?>" selected><?php echo $father_alt_mob_country_code;?></option>
                          </select>
                        </span>
                        <input type="text" class="form-control" name="pd_father_alt_phone" id="pd_father_alt_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Alternate Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_father_alt_phone-parsley-error" value="<?php echo $father_alt_mobile; ?>">
                      </div>
                      <span id="custom-pd_father_alt_phone-parsley-error"></span>
                    </div>
                    <div class="col-lg-4" id="father_email_div">
                      <div class="form-group">
                        <label class="form-control-label">Father's Email ID </label>
                        <input class="form-control" type="email" name="pd_father_email" id="pd_father_email"  placeholder="Enter Your Father's Email ID" data-parsley-required="false" data-parsley-required-message="Please Enter Email ID" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Email ID" data-parsley-errors-container="#custom-pd_father_email-parsley-error" value="<?php echo $father_email; ?>" maxlength="100">
                        <span id="custom-pd_father_email-parsley-error"></span>
                      </div>
                    </div>
                    <div class="col-lg-4"  id="father_occupation_div">
                      <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Father's Occupation</label>
                        <select class="form-control select2" data-placeholder="Choose Occupation" tabindex="-1" aria-hidden="true" name="pd_father_occupation" id="pd_father_occupation">
                          <option value=""><?php echo $father_occupation; ?></option>
                        </select>
                      </div>
                      <?php  if($father_occupation_id == OTHER_OCCUPATION) { ?>
                        <div id="father_other_occupation_div"  class="form-group">
                              <input class="form-control" type="text" name="pd_father_other_occupation" id="pd_father_other_occupation"  placeholder="If Other, please enter here..."data-parsley-required="false"   data-parsley-errors-container="#custom-pd_father_other_occupation-parsley-error" value="<?php echo $father_other_occupation;?>">
                              <span id="custom-pd_father_other_occupation-parsley-error"></span>
                        </div>
                    <?php } ?>
                    </div><!-- col-4 -->
                  <?php } ?>
                </div><!-- row -->
         <!-- row -->                             
         <div class="row w-100">
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label">Title <span class="tx-danger">*</span></label>
                          <select class="form-control select2" name="pd_mother_title" id="pd_mother_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="Please Choose Title" data-parsley-errors-container="#custom-pd_mother_title-parsley-error" data-parsley-trigger="change">
                            <option value=""><?php echo $mother_title_name;?></option>
                          </select>
                          <span id="custom-pd_mother_title-parsley-error"></span>
                          <input type="hidden" name="pd_mother_id" id="pd_mother_id"  value="<?php echo $app_parent_det_id[$parent_type_id_mother]; ?>" />
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Mother's Name <span class="tx-danger">*</span></label>
                          <input type="text" class="form-control" name="pd_mother_name" id="pd_mother_name" placeholder="Enter Your Mother's Name" maxlength="50" data-parsley-required="true" data-parsley-required-message="Please Enter Your Mother Name" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" value="<?php echo $mother_name; ?>">
                        </div>
                    </div><!-- col-4 -->
                    <?php if($mother_title_id!=LOOKUP_VALUE_TITLE_LATE_ID) { ?>
                    <div class="col-lg-4" id="mother_mbleno_div">
                        <label class="form-control-label">Mother's Mobile Number</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="pd_mother_phone_no_code" name="pd_mother_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                            <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected><?php echo $mother_country_mob_code;?></option>
                          </select>
                        </span>
                        <input type="text" class="form-control" name="pd_mother_phone" id="pd_mother_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_mother_phone-parsley-error" value="<?php echo $mother_mobile; ?>">
                        <span id="custom-pd_mother_phone-parsley-error"></span>
                        </div>
                    </div>
                    <div class="col-lg-4" id="mother_alt_mbleno_div">
                        <label class="form-control-label">Mother's Alternative Mobile Number</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                          <select class="form-control form_control custom-select Mobile_number" id="pd_mother_alt_phone_no_code" name="pd_mother_alt_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                            <option value="<?php echo $country_value_default; ?>" selected><?php echo $mother_alt_mob_country_code;?></option>
                          </select>
                        </span>
                        <input type="text" class="form-control" name="pd_mother_alt_phone" id="pd_mother_alt_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_mother_alt_phone-parsley-error" value="<?php echo $mother_alt_mobile; ?>">
                        <span id="custom-pd_mother_alt_phone-parsley-error"></span>
                        </div>
                    </div>
                    <div class="col-lg-4" id="mother_email_div">
                        <div class="form-group">
                            <label class="form-control-label">Mother's Email ID </label>
                            <input class="form-control" type="email" name="pd_mother_email" id="pd_mother_email"  placeholder="Enter Your Mother's Email ID"data-parsley-required="false" data-parsley-required-message="Please Enter Email ID" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Email ID" data-parsley-errors-container="#custom-pd_mother_email-parsley-error" value="<?php echo $mother_email; ?>" maxlength="100">
                            <span id="custom-pd_mother_email-parsley-error"></span>
                        </div>
                    </div>
                    <div class="col-lg-4" id="mother_occupation_div">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Mother's Occupation</label>
                            <select class="form-control select2" data-placeholder="Choose Occupation" tabindex="-1" aria-hidden="true" name="pd_mother_occupation" id="pd_mother_occupation">
                              <option value=""><?php echo $mother_occupation;?></option>
                            </select>
                        </div>
                        <?php if($mother_other_occupation != ''){?>
                        <div id="mother_other_occupation_div" class="form-group">
                        <input class="form-control" type="text" name="pd_mother_other_occupation" id="pd_mother_other_occupation"  placeholder="If Other, please enter here..." data-parsley-required="false"   data-parsley-errors-container="#custom-pd_mother_other_occupation-parsley-error" value="<?php echo 
                        $mother_other_occupation;?>">
                        <span id="custom-pd_mother_other_occupation-parsley-error"></span>
                      </div>
                    <?php } ?>
                    </div><!-- col-4 -->
                  <?php }?>
                </div><!-- row -->
         <div>
                  <label class="ckbox add_guardian_checkbox">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input" type="checkbox" name="add_guardian_checkbox" id="add_guardian_checkbox" value="<?php echo ($add_gardian == 't')?'true':'false'; ?>" <?php echo ($add_gardian == 't')?'checked':''; ?>><label class="custom-control-label" for="add_guardian_checkbox"> Add Guardian Detail </label>
                    </div>
                  </label>
        </div>
        <?php if (!empty($add_gardian) && $add_gardian=='t') { ?>
         <div class="row w-100" id="guardian_details">
                    <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Guardian's Name</label>
                          <input class="form-control" type="text" name="pd_guardian_name" id="pd_guardian_name" placeholder="Enter Your Guardian Name" maxlength="50" data-parsley-required="false" data-parsley-required-message="Please Enter Your Guardian Name" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_guardian]; ?>">
                          <input type="hidden" name="pd_guardian_id" id="pd_guardian_id" value="<?php echo $app_parent_det_id[$parent_type_id_guardian]; ?>" />
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <label class="form-control-label">Guardian's Mobile NO</label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                        <select class="form-control form_control custom-select Mobile_number" id="pd_guardian_phone_no_code" name="pd_guardian_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                          <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected><?php echo $guardian_country_mob_code;?></option>
                        </select>
                        </span>
                        <input type="text" class="form-control" name="pd_guardian_phone" id="pd_guardian_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Guardian's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_guardian_phone-parsley-error" value="<?php echo $guardian_mobile; ?>">
                        <span id="custom-pd_guardian_phone-parsley-error"></span>
                      </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Guardian's Email ID</label>
                            <input class="form-control" type="email" name="pd_guardian_email" id="pd_guardian_email"  placeholder="Enter Your Guardian's Email ID"data-parsley-required="false" data-parsley-required-message="Please Enter Email ID" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Email ID" data-parsley-errors-container="#custom-pd_guardian_email-parsley-error" value="<?php echo $guardian_email; ?>" maxlength="100">
                            <span id="custom-pd_guardian_email-parsley-error"></span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Guardian's Occupation</label>
                            <select class="form-control select2" data-placeholder="Choose Guardian Occupation" tabindex="-1" aria-hidden="true" name="pd_guardian_occupation" id="pd_guardian_occupation">
                              <option value=""><?php echo $guardian_occupation?></option>
                            </select>
                        </div>
                         <?php if($guardian_occupation_id==OTHER_OCCUPATION) { ?>
                        <div id="guardian_other_occupation_div" class="form-group">
                            <input class="form-control" type="text" name="guardian_other_occupation" id="guardian_other_occupation"  placeholder="If Other, please enter here..."data-parsley-required="false"   data-parsley-errors-container="#custom-guardian_other_occupation-parsley-error" value="<?php echo $applicant_parent_occupation_other_name[$parent_type_id_guardian];?>">
                            <span id="custom-guardian_other_occupation-parsley-error"></span>
                        </div>
                      <?php } ?>
                    </div><!-- col-4 -->
                </div><!-- row -->
              <?php }?>
         <!-- row -->
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
                              <option value=""><?php echo $country_name;?></option>
                            </select>
                            <span id="custom-country-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <?php if($country_id==COUNTRY_VALUE_DEFAULT) { ?>
                    <div class="col-lg-3" id="main_div_state">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">State<span class="tx-danger"> *</span></label>
                            <select class="form-control select2" data-placeholder="Choose State" tabindex="-1" aria-hidden="true" name="state" id="state" title="Choose State" data-parsley-required="true" data-parsley-required-message="Please Choose State" data-parsley-errors-container="#custom-state-parsley-error" data-parsley-trigger="change">
                              <option value=""><?php echo $state_name;?></option>
                            </select>
                            <span id="custom-state-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-3" id="main_div_district">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">District<span class="tx-danger"> *</span></label>
                            <select class="form-control select2" data-placeholder="Choose District" tabindex="-1" aria-hidden="true" name="district" id="district" title="Choose District" data-parsley-required="true" data-parsley-required-message="Please Choose District" data-parsley-errors-container="#custom-district-parsley-error" data-parsley-trigger="change">
                              <option value=""><?php echo $district_name;?></option>
                            </select>
                            <span id="custom-district-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-3" id="main_div_city">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">City<span class="tx-danger"> *</span></label>
                            <select class="form-control select2" data-placeholder="Choose City" tabindex="-1" aria-hidden="false" name="city" id="city" title="Choose City" data-parsley-required="true" data-parsley-required-message="Please Choose City" data-parsley-errors-container="#custom-city-parsley-error" data-parsley-trigger="change">
                              <option value=""><?php echo $city_name;?></option>
                            </select>
                            <span id="custom-city-parsley-error"></span>
                        </div>
                    </div><!-- col-4 -->
                  <?php } ?>
                </div>
                <div class="row w-100">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Address Line 1 <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="address_line1" id="address_line1" placeholder="Enter Address Line 1" data-parsley-required="true" data-parsley-required-message="Please Enter Address" value="<?php if($add_line_1) {echo $add_line_1;} ?>" data-parsley-maxlength="100" maxlength="100">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Address Line 2 <!--<span class="tx-danger">*</span>--></label>
                            <input class="form-control" type="text" name="address_line2" id="address_line2" placeholder="Enter Address Line 2" value="<?php if($add_line_2) {echo $add_line_2;} ?>" data-parsley-maxlength="100" maxlength="100">
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Pincode <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Pincode" data-parsley-required="true" data-parsley-required-message="Please Enter Pincode" value="<?php if($pin_code) {echo $pin_code;} ?>" data-parsley-maxlength="10" maxlength="10">
                        </div>
                    </div><!-- col-4 -->

                </div><!-- row -->
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
                    <div class="col-lg-2">
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="appering" name="current_education_qual_status" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="Please Choose Current Education Qualification Status" data-parsley-errors-container="#custom-current_education_qual_status-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($applicant_result_declared[0] == 'f')?'checked':''; ?>>
                        <label class="custom-control-label" for="appering">12th Appearing</label>
                      </div>
                    </div>
                    <div class="col-lg-5">
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="completed" name="current_education_qual_status" class="custom-control-input" value="2" <?php echo ($applicant_result_declared[0] == 't')?'checked':''; ?>>
                        <label class="custom-control-label" for="completed">12th Completed</label>
                      </div>
                    </div>
                    <span id="custom-current_education_qual_status-parsley-error"></span>
                  <div class="col-lg-5">
                <div class="form-group wd-xs-300 mr-5 w-100">
                  <label class="form-control-label">Candidate Name as in 10th Certificate <span class="tx-danger">*</span></label>
                  <div class="form-group mg-b-10-force">
                    <input class="form-control" type="text" name="tenth_name" id="tenth_name" placeholder="Enter Name" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 100]" value="<?php echo $applicant_tenth_name[0]; ?>" maxlength="100" data-parsley-trigger="change">
                    <small id="emailHelp" class="form-text text-muted">Kindly type "NA" in case 10th Certificate is not available with you.</small>
                  </div>
                </div><!-- form-group -->
              </div>
       </div>
      <section class="row">
        <div>
          <div class="table-responsive">
           <table class="table table-bordered mt-3">
            <thead class="thead-light">
                  <tr>
                     <th>Course <span class="tx-danger">*</span></th>
                     <th width="200px;"> Institute Name <span class="tx-danger">*</span></th>
                     <th style="width:200px;"> Board <span class="tx-danger">*</span></th>
                     <th> Mode of Study <span class="tx-danger">*</span></th>
                     <th> Marking Scheme <span class="tx-danger">*</span></th>
                     <th> Obtained Percentage/CGPA <span class="tx-danger">*</span></th>
                     <th> Year of Passing <span class="tx-danger">*</span></th>
                     <th class="reg_width">  Roll No. / Registration No. <span class="tx-danger">*</span></th>
                  </tr>
               </thead>
            <tbody>
                <tr>
                  <td><p>X</p><input type="hidden" name="schooling_id_0" id="schooling_id_0" value="<?php echo $applicant_scl_det_id[0]; ?>" ></td>
                  <td width="200px;"><input class="form-control" type="text" name="institute_name_0" id="institute_name_0" placeholder="Enter Institute Name" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Institute Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 100]" value="<?php echo $applicant_institute_name[0]; ?>" maxlength="100" data-parsley-trigger="change"></td>
                  <td style="width:200px;">
                    <div class="form-group mg-b-10-force">
                      <select class="form-control custom-select" name="board_0" id="board_0" data-parsley-required="true" data-parsley-required-message="Please Choose Board" data-parsley-trigger="change" data-parsley-errors-container="#custom-board0-parsley-error">
                        <option value=""><?php echo $applicant_board_name[0]?></option>
                      </select>
                      <span id="custom-board0-parsley-error"></span>
                    </div>
                  </td>
                  <td>
                    <div class="form-group mg-b-10-force">
                      <select class="form-control custom-select" name="mode_of_study_0" id="mode_of_study_0" data-parsley-required="true" data-parsley-required-message="Please Choose Mode of Study" data-parsley-trigger="change" data-parsley-errors-container="#custom-mode_study0-parsley-error">
                        <option value=""><?php echo $applicant_mode_of_study_name[0]?></option>
                      </select>
                      <span id="custom-mode_study0-parsley-error"></span>
                    </div>
                  </td>
                  <td>
                    <div class="form-group mg-b-10-force" id="appering_info_0">
                      <select class="form-control custom-select" name="marking_scheme_0" id="marking_scheme_0" data-parsley-required="true" data-parsley-required-message="Please Choose Marking Scheme" data-parsley-trigger="change" data-parsley-errors-container="#custom-marking_scheme0-parsley-error">
                        <option value=""><?php echo $applicant_marking_scheme_name[0]?></option>
                      </select>
                      <span id="custom-marking_scheme0-parsley-error"></span>
                    </div>
                  </td>                
                  <td>
                      <input class="form-control" type="text" name="obtained_percentage_cgpa_0" placeholder="Obtained Percentage/CGPA" id="obtained_percentage_cgpa_0" maxlength="5" data-parsley-required="true" data-parsley-required-message="Please Enter Obtained Percentage/CGPA" data-parsley-trigger="change" data-parsley-errors-container="#custom-obtained_percentage_cgpa0-parsley-error" value="<?php echo $applicant_obtained_percentage_cgpa[0]; ?>"> 
                      <span id="custom-obtained_percentage_cgpa0-parsley-error"></span>
                  </td>
                  <td>
                      <input class="form-control" type="text" name="year_of_passing_0" id="year_of_passing_0" placeholder="YYYY" maxlength="4" data-parsley-required="true" data-parsley-required-message="Please Enter Year of Passing" data-parsley-trigger="change" data-parsley-errors-container="#custom-year_of_passing0-parsley-error" value="<?php echo $applicant_year_of_passing[0]; ?>">
                      <span id="custom-year_of_passing0-parsley-error"></span>
                  </td>
                  <td>
                      <input class="form-control" type="text" name="registration_no_0" id="registration_no_0" placeholder="Roll No" maxlength="10" data-parsley-required="true" data-parsley-required-message="Please Enter Roll No" data-parsley-trigger="change" value="<?php echo $applicant_registration_no[0]; ?>">
                  </td>
                </tr>
                <tr>
                  <td><p>XII</p><input type="hidden" name="schooling_id_1" id="schooling_id_1" value="<?php echo $applicant_scl_det_id[1]; ?>" ></td>
                  <td><input class="form-control" type="text" name="institute_name_1" id="institute_name_1" placeholder="Enter Institute Name" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Institute Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 100]" value="<?php echo $applicant_institute_name[1]; ?>" maxlength="100" data-parsley-trigger="change"></td>
                  <td>
                    <div class="form-group mg-b-10-force">
                      <select class="form-control custom-select" name="board_1" id="board_1" data-parsley-required="true" data-parsley-required-message="Please Choose Board" data-parsley-trigger="change" data-parsley-errors-container="#custom-board1-parsley-error">
                        <option value=""><?php echo $applicant_board_name[1];?></option>
                      </select>
                      <span id="custom-board1-parsley-error"></span>
                    </div>
                  </td>
                  <td>
                    <div class="form-group mg-b-10-force">
                      <select class="form-control custom-select" name="mode_of_study_1" id="mode_of_study_1" data-parsley-required="true" data-parsley-required-message="Please Choose Mode of study" data-parsley-trigger="change" data-parsley-errors-container="#custom-mode_study_1-parsley-error">
                        <option value=""><?php echo $applicant_mode_of_study_name[1];?></option>
                      </select>
                      <span id="custom-mode_study_1-parsley-error"></span>
                    </div>
                  </td>
                  <td>
                    <div class="form-group mg-b-10-force" id="appering_info_1">
                      <select class="form-control custom-select" name="marking_scheme_1" id="marking_scheme_1" data-parsley-required="true" data-parsley-required-message="Please Choose Marking Scheme" data-parsley-trigger="change" data-parsley-errors-container="#custom-marking_scheme1-parsley-error">
                        <option value=""><?php echo $applicant_marking_scheme_name[1];?></option>
                      </select>
                      <span id="custom-marking_scheme1-parsley-error"></span>
                    </div>
                  </td>
                  <td>
                      <input class="form-control" type="text" name="obtained_percentage_cgpa_1" placeholder="Obtained Percentage/CGPA" id="obtained_percentage_cgpa_1" maxlength="5" data-parsley-required="false" data-parsley-required-message="Please Enter Obtained Percentage/CGPA" data-parsley-trigger="change" data-parsley-errors-container="#custom-obtained_percentage_cgpa1-parsley-error" value="<?php echo $applicant_obtained_percentage_cgpa[1]; ?>"> 
                      <span id="custom-obtained_percentage_cgpa1-parsley-error"></span>
                  </td>
                  <td>
                      <input class="form-control" type="text" name="year_of_passing_1" id="year_of_passing_1" placeholder="YYYY" maxlength="4" data-parsley-required="false" data-parsley-required-message="Please Enter Year of Passing" data-parsley-trigger="change" data-parsley-errors-container="#custom-year_of_passing1-parsley-error" value="<?php echo $applicant_year_of_passing[1]; ?>">
                      <span id="custom-year_of_passing1-parsley-error"></span>
                  </td>
                  <td class="reg_width">
                      <input class="form-control" type="text" name="registration_no_1" id="registration_no_1" placeholder="Roll No" maxlength="10" data-parsley-required="false
                      " data-parsley-required-message="Please Enter Roll No" data-parsley-trigger="change" value="<?php echo $applicant_registration_no[1]; ?>" data-parsley-errors-container="#custom-registration_no_1-parsley-error">
                      <span id="custom-registration_no_1-parsley-error"></span>
                  </td>
                </tr>
            </tbody>
           </table>
       </div>
       </div>
       <div class="row w-100">
                <div class="col-lg-6">
                   <div class="form-group">
                      <label class="form-control-label">NAD ID / Digilocker ID <span
                         class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="digilocker_id"
                         id="digilocker_id" placeholder="Enter NAD ID / Digilocker ID " value="<?php echo $nad_id_digilocker_id;?>">
                   </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label class="control-label" for="radios" >Have you
                          taken any competitive exam? <span class="tx-danger">*</span></label>
                      <select class="form-control custom-select study" id="taken_any_competitive_exam" name="taken_any_competitive_exam" data-parsley-required="true" data-parsley-required-message="Please select the status" onchange="is_competitive_exam_func(this.value)" data-parsley-errors-container="#custom-taken_any_competitive_exam-parsley-error" data-parsley-trigger="change">
                          <option value=""><?php echo $is_competitive_exam_name;?></option>
                      </select>
                      <span id="custom-taken_any_competitive_exam-parsley-error"></span>
                      <div class="form-group" style="display: none;" id="taken_any_competitive_exam_info"><small>You have to write
                              SRM ENTRANCE to qualify.</small></div>

                  </div>
                </div>
             </div>
             <?php if($is_competitive_exam == 't') { ?>
        <div class="row" id="competitive_dtl">
                <div class="col-md-12">
                   <div class="form-group">                    
                      <label class="control-label" for="radios"><h5>Competitive Exam</h5></label>
                      <hr>
                      <div class="table-responsive pretbl">
                         <table class="table table-bordered mt-0" id="table5">
                            <thead class="thead-light">
                               <tr>
                                   <th>
                                   </th>
                                   <th>Name of the exam</th>
                                   <th class="reg_width">Registration No /Roll No</th>
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
                                      <select class="form-control custom-select study" id="competitive_exam_0" name="competitive_exam_0" data-parsley-required="true" data-parsley-required-message="Please select the competitive examination" data-parsley-errors-container="#custom-competitive_exam_0-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $app_comp_exam_name[0];?></option>
                                      </select>
                                    <span id="custom-competitive_exam_0-parsley-error"></span></div>
                                     <span class="tx-danger required_asterisk">*</span>
                                  </td>
                                  <td class="reg_width">
                                     <div class="form-group"><input type="text" name="rollno_0" id="rollno_0" class="form-control" maxlength="7" data-parsley-required="false" data-parsley-required-message="Please enter roll no" data-parsley-trigger="change" value="<?php echo $app_comp_registration_no[0]; ?>"></div>
                                     <span class="tx-danger required_asterisk">*</span>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="score_obtained_0" id="score_obtained_0" class="form-control" placeholder="" maxlength="100" data-parsley-required="false" data-parsley-required-message="Please enter the score obtained" data-parsley-trigger="change" value="<?php echo $app_comp_score_obtained[0]; ?>"></div>
                                     <span class="tx-danger required_asterisk">*</span>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="max_score_0" id="max_score_0" class="form-control" placeholder="" maxlength="100" data-parsley-required="false" data-parsley-required-message="Please enter the max score" data-parsley-trigger="change" value="<?php echo $app_comp_max_score[0]; ?>"></div>
                                     <span class="tx-danger required_asterisk">*</span>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="year_appered_0" id="year_appered_0" class="form-control datepicker" placeholder="YYYY" maxlength="4"data-parsley-required="false" data-parsley-required-message="Please Select Year" data-parsley-trigger="change" value="<?php echo $app_comp_exam_year[0]; ?>"></div>
                                     <span class="tx-danger required_asterisk">*</span>
                                  </td>
                                  <td>
                                     <div class="form-group"><input  type="text" name="overall_rank_0" id="overall_rank_0" class="form-control" placeholder="" maxlength="7" data-parsley-required="false" data-parsley-required-message="Please enter Overall Rank" data-parsley-trigger="change" value="<?php echo $app_comp_all_india_rank[0]; ?>"></div>
                                     <span class="tx-danger required_asterisk">*</span>
                                  </td>                                  
                                  <td>
                                     <div class="form-group"><select class="form-control custom-select study" id="qualify_0" name="qualify_0" data-parsley-required="true" data-parsley-required-message="Please select qualified" data-parsley-errors-container="#custom-qualify_0-parsley-error" data-parsley-trigger="change">
                                       <option value=""><?php echo $qualify_0_name;?></option>
                                     </select>
                                    <span id="custom-qualify_0-parsley-error"></span></div>
                                     <span class="tx-danger required_asterisk">*</span>
                                  </td>
                               </tr>
                               <tr>
                                  <td nowrap="">2.</td>
                                  <td>
                                     <input class="form-control" type="hidden" placeholder="" id="comp_exam_id_1" name="comp_exam_id_1" value="<?php echo $applicant_entr_exam_det_id[1]; ?>">
                                     <div class="form-group">
                                      <select class="form-control custom-select study" id="competitive_exam_1" name="competitive_exam_1">
                                        <option value=""><?php echo $app_comp_exam_name[1];?></option>
                                      </select>
                                    </div>
                                  </td>
                                  <td class="reg_width">
                                     <div class="form-group"><input type="text" name="rollno_1" id="rollno_1" class="form-control" placeholder="" maxlength="7" value="<?php echo $app_comp_registration_no[1]; ?>"></div>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="score_obtained_1" id="score_obtained_1" class="form-control" placeholder="" maxlength="10" value="<?php echo $app_comp_score_obtained[1]; ?>"></div>                                     
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="max_score_1" id="max_score_1" class="form-control" placeholder="" maxlength="10" value="<?php echo $app_comp_max_score[1]; ?>"></div>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="year_appered_1" id="year_appered_1" class="form-control" placeholder="YYYY" maxlength="5" value="<?php echo $app_comp_exam_year[1];?>"></div>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="overall_rank_1" id="overall_rank_1" class="form-control" placeholder="" maxlength="7" value="<?php echo $app_comp_all_india_rank[1];?>">
                                     </div>
                                  </td>                                  
                                  <td>
                                     <div class="form-group"><select class="form-control custom-select study" id="qualify_1" name="qualify_1">
                                       <option value=""><?php echo $qualify_0_name;?></option>
                                     </select>
                                      </div>
                                  </td>
                               </tr>
                               <tr>
                                  <td nowrap="">3.</td>
                                  <td>
                                     <input class="form-control" type="hidden" placeholder="" id="comp_exam_id_2" name="comp_exam_id_2" value="<?php echo $applicant_entr_exam_det_id[2]; ?>">
                                     <div class="form-group">
                                      <select class="form-control custom-select study" id="competitive_exam_2" name="competitive_exam_2">
                                        <option value=""><?php echo $app_comp_exam_name[2];?></option>
                                      </select>
                                    </div>
                                  </td>
                                  <td class="reg_width">
                                     <div class="form-group"><input type="text" name="rollno_2" id="rollno_2" class="form-control" placeholder="" maxlength="7" value="<?php echo $app_comp_registration_no[2];?>"></div>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="score_obtained_2" id="score_obtained_2" class="form-control" placeholder="" maxlength="10" value="<?php echo $app_comp_score_obtained[2]?>"></div>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="max_score_2" id="max_score_2" class="form-control" placeholder="" maxlength="10" value="<?php echo $app_comp_max_score[2]?>"></div>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="year_appered_2" id="year_appered_2" class="form-control" placeholder="YYYY" maxlength="5" value="<?php echo $app_comp_exam_year[2];?>"></div>
                                  </td>
                                  <td>
                                     <div class="form-group"><input type="text" name="overall_rank_2" id="overall_rank_2" class="form-control" placeholder="" maxlength="7" value="<?php echo $app_comp_all_india_rank[2];?>"></div>
                                  </td>                                  
                                  <td>
                                     <div class="form-group"><select class="form-control custom-select study" id="qualify_2" name="qualify_2">
                                       <option value=""><?php echo $qualify_2_name;?></option>
                                     </select>
                                     </div>
                                  </td>
                               </tr>
                            </tbody>
                         </table>
                      </div>
                   </div>
                </div>
            </div> 
          <?php }?>
         
      </section>
      
     </div>
    </div>
   </div>
   <!-- Geetha -->
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
                <div class="form-group">
                 <div class="custom-control custom-radio custom-control-inline">
                     <input type="radio" id="online" name="payment_mode" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="Please Choose Payment Mode" data-parsley-errors-container="#custom-payment_mode-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($payment_mode_id == PAYMENT_MODE_ONLINE_ID)?'checked':''; ?>>
                  <label class="custom-control-label" for="online">Online</label>
                 </div>
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
                                <!--<input class="form-control" type="text" name="BankName" id="BankName" placeholder="Bank Name" data-parsley-required="true" data-parsley-required-message="Required">-->
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
                                  <input class="form-control" type="text" name="DDNumber" id="DDNumber" placeholder="DD Number" data-parsley-required="true" data-parsley-required-message="Choose DDNumber" data-parsley-type="digits" data-parsley-type-message="Only Numbers Allowed"  maxlength="15" value="<?php echo $dd_cheque_no; ?>">
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
          <?php
            $file_allowed_type = FILE_ALLOWED_TYPE;
            ?>
          <div class="form-layout">
           <div class="row mg-b-25 mt-3">
            <div class="row w-100">
               <div class="form-group col-md-6 ">
                           <label for="exampleFormControlTextarea1">Upload Your Recent Passport Size Photograph <span class="tx-danger">*</span></label>
                           <input type="file" class="filestyle" name="photograph" id="photograph" data-parsley-required="<?php echo ((isset($docs[$document_id_photograph]))?'false':'true'); ?>" data-parsley-required-message="Please upload photograph" data-parsley-errors-container="#custom-photograph-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>"  data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>">
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
              <input type="file" class="filestyle" name="signature" id="signature" data-parsley-required="<?php echo ((isset($docs[$document_id_signature]))?'false':'true'); ?>" data-parsley-required-message="Please upload signature" data-parsley-errors-container="#custom-signature-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
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
            </div>
            <?php
               ?>
            <div class="row w-100">
                      <div class="form-group col-md-6">
                          <label for="exampleFormControlTextarea1">Upload Your 10th Marksheet </label>

                          <input type="file" class="filestyle" name="tenth_marksheet" id="tenth_marksheet" data-parsley-required="<?php echo ((isset($docs[$document_id_tenth_marksheet]))?'false':'true'); ?>" data-parsley-required-message="Please upload 10th marksheet" data-parsley-errors-container="#custom-tenth_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_tenth_marksheet])){ echo $docs[$document_id_tenth_marksheet]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
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

                          <input type="file" class="filestyle" name="twelvfth_marksheet" id="twelvfth_marksheet" data-parsley-required="<?php echo ((isset($docs[$document_id_twelvfth_marksheet]))?'false':'true'); ?>" data-parsley-required-message="Please upload 12th marksheet" data-parsley-errors-container="#custom-twelvfth_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>"  data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_twelvfth_marksheet])){ echo $docs[$document_id_twelvfth_marksheet]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
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
    <input type="file" class="filestyle" name="additional_qualification" id="additional_qualification" data-parsley-required="false" data-parsley-validate-if-empty="true" data-parsley-required-message="Please upload additional qualification" data-parsley-errors-container="#custom-additional_qualification-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_500_KB; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_additional_qualification])){ echo $docs[$document_id_additional_qualification]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
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
                <p>I certify that the information submitted by me in support of this application, is true to the best of my knowledge and belief. I understand that in the event of any information being found false or incorrect, my admission is liable to be rejected / cancelled at any stage of the program. I undertake to abide by the disciplinary rules and regulations of the institute</p>
               </div>
            </div>
            <div class="row w-100">
               <div class="col-md-6">
                <label class="form-control-label">Applicant Name <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="applicant_name" id="applicant_name" placeholder="Applicant Name" value="<?php echo $applicant_name_declaration ;?>" readonly>
               </div>
               <div class="col-md-6">
                <label class="form-control-label">Parent Name <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="parent_name" id="parent_name" placeholder="Parent Name" value="<?php echo $applicant_parentname_declaration;?>">
               </div>
            </div>
            <div class="row w-100 mt-3">
               <div class="col-md-6">
                <label class="form-control-label">Date <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="ddate" id="ddate" value="<?php if(isset($applicant_declaration_date)){echo $applicant_declaration_date;}else{echo date('d/m/Y');} ?>" readonly>
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
</div>