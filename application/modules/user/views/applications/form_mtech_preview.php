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
//print_r($applicant_basic_details_list);
$first_name=$applicant_basic_details_list['f_name'];
$middle_name=$applicant_basic_details_list['m_name'];
$last_name=$applicant_basic_details_list['l_name'];
$dob=$applicant_basic_details_list['dob'];
//$dob = date('m/d/Y',strtotime($dob));
$dob=isset($dob)? date('d/m/Y',strtotime($dob)):'';

$mobile_no=$applicant_basic_details_list['mob_no'];
$sec_mob_no=$applicant_basic_details_list['sec_mob_no'];
$sec_e_mail=$applicant_basic_details_list['sec_e_mail'];
$email_id = $applicant_basic_details_list['e_mail'];
$cur_qual_completed = $applicant_other_details_list['cur_qual_completed'];
$is_work_experience = $applicant_other_details_list['is_work_experience'];
$canditate_name = $applicant_basic_details_list['name_in_marksheet'];
$nad_id_digilocker_id = $applicant_basic_details_list['digilocker_id'];

$title_name = !empty($applicant_basic_details_list['tittle_name']) ? $applicant_basic_details_list['tittle_name'] : 'Select';
$mob_country_code_name = !empty($applicant_basic_details_list['applicant_mob_country_code_name']) ? $applicant_basic_details_list['applicant_mob_country_code_name'] : 'Select';
$gender_name = !empty($applicant_basic_details_list['gender']) ? $applicant_basic_details_list['gender'] : 'Select';
$blood_grp_name = !empty($applicant_basic_details_list['blood_group']) ? $applicant_basic_details_list['blood_group'] : 'Select';
$religion_name = !empty($applicant_basic_details_list['religion_name']) ? $applicant_basic_details_list['religion_name'] : 'Select';
$mothertongue_name = !empty($applicant_basic_details_list['mothertongue_name']) ? $applicant_basic_details_list['mothertongue_name'] : 'Select';
$source_name = !empty($applicant_basic_details_list['source_name']) ? $applicant_basic_details_list['source_name'] : 'Select';
$medium_of_study_name = !empty($applicant_other_details_list['medium_of_study_name']) ? $applicant_other_details_list['medium_of_study_name'] : 'Select';

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

$nationality = !empty($applicant_basic_details_list['nationality']) ? $applicant_basic_details_list['nationality'] : 'Select';
$nation_id = !empty($applicant_basic_details_list['nation_id']) ? $applicant_basic_details_list['nation_id'] : 'Select';
$social_status = !empty($applicant_basic_details_list['social_status']) ? $applicant_basic_details_list['social_status'] : 'Select';

//$result_declare_date = date('m/Y', strtotime($applicant_other_details_list['expectedmonthyearresult']));
$result_declare_date = $applicant_other_details_list['expectedmonthyearresult'];
$result_declare_date=isset($result_declare_date)? date('m/Y',strtotime($result_declare_date)):'';
$total_work_exp = $applicant_other_details_list['total_work_exp'];
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

if($applicant_comp_exam_qualified[0]=='t'){
  $applicant_comp_exam_qualified_name1 = 'Qualified';
}else if($applicant_comp_exam_qualified[0]=='f'){
  $applicant_comp_exam_qualified_name1 = 'Not Qualified';
}else {
  $applicant_comp_exam_qualified_name1 = 'Select';
}

if($applicant_comp_exam_qualified[1]=='t'){
  $applicant_comp_exam_qualified_name2 = 'Qualified';
}else if($applicant_comp_exam_qualified[1]=='f'){
  $applicant_comp_exam_qualified_name2 = 'Not Qualified';
}else {
  $applicant_comp_exam_qualified_name2 = 'Select';
}

if($applicant_comp_exam_qualified[1]=='t'){
  $applicant_comp_exam_qualified_name3 = 'Qualified';
}else if($applicant_comp_exam_qualified[1]=='f'){
  $applicant_comp_exam_qualified_name3 = 'Not Qualified';
}else {
  $applicant_comp_exam_qualified_name3 = 'Select';
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
$applicant_grad_det_reg_no = $applicant_graduations_list['reg_no']; 
$applicant_grad_det_mode_study_name = $applicant_graduations_list['mode_of_study']; 
         
          


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
   }
}

$course_1 = isset($applicant_course_course_name[0]) ? $applicant_course_course_name[0] : 'Select Course Preference 1';
$course_2 = isset($applicant_course_course_name[1]) ? $applicant_course_course_name[1] : 'Select Course Preference 2';
$course_3 = isset($applicant_course_course_name[2]) ? $applicant_course_course_name[2] : 'Select Course Preference 3';

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

$test_state_1 = isset($applicant_city_state_name[0]) ? $applicant_city_state_name[0] : 'Select Test State Perferences 1';
$test_state_2 = isset($applicant_city_state_name[1]) ? $applicant_city_state_name[1] : 'Select Test State Perferences 2';
$test_state_3 = isset($applicant_city_state_name[2]) ? $applicant_city_state_name[2] : 'Select Test State Perferences 3';

$test_city_1 = isset($applicant_city_city_name[0]) ? $applicant_city_city_name[0] : 'Select Test City Perferences 1';
$test_city_2 = isset($applicant_city_city_name[1]) ? $applicant_city_city_name[1] : 'Select Test City Perferences 2';

$is_competitive_exam = $applicant_other_details_list['is_competitive_exam'];
$is_competitive_exam_select = '';
$is_competitive_exam_select_name = 'Select';
if($is_competitive_exam == 't') {
    $is_competitive_exam_select = 'yes';
    $is_competitive_exam_select_name = 'Yes';
} else if($is_competitive_exam == 'f') {
    $is_competitive_exam_select = 'no';
    $is_competitive_exam_select_name = 'No';
}


$is_work_experience = $applicant_other_details_list['is_work_experience'];
$is_work_experience_select = '';
$is_work_experience_select_name = 'Select';
if($is_work_experience == 't') {
    $is_work_experience_select = 'yes';
    $is_work_experience_select_name = 'Yes';
} else if($is_work_experience == 'f') {
    $is_work_experience_select = 'no';
    $is_work_experience_select_name = 'No';
}


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
if($applicant_address_details_list) {
   
    $country_id = $applicant_address_details_list[0]['country_id'];
    $country_name = $applicant_address_details_list[0]['country_name'];
    $state_id = $applicant_address_details_list[0]['state_id'];
    $state_name = $applicant_address_details_list[0]['state_name'];
    $district_id = $applicant_address_details_list[0]['district_id'];
    $district_name = $applicant_address_details_list[0]['district_name'];
    $city_id = $applicant_address_details_list[0]['city_id'];
    $city_name = $applicant_address_details_list[0]['city_name'];
    $add_line_1 = $applicant_address_details_list[0]['add_line_1'];
    $add_line_2 = $applicant_address_details_list[0]['add_line_2'];
    $pin_code = $applicant_address_details_list[0]['pin_code'];
}
$country_id=isset($country_id) ?$country_id:'';
$country_name=isset($country_name) ?$country_name : 'Select Country';
$state_name=isset($state_name) ?$state_name : 'Select State';
$district_name=isset($district_name) ?$district_name : 'Select District';
$city_name=isset($city_name) ?$city_name : 'Select City';
//End address





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
} else if($qualifyexamfromindia == 'f') {
    $studied_from_india_id = 'no';
    $studied_from_india_name = 'No';
} else
{
  $studied_from_india_name = 'Please Choose Graduation';
}


$applicant_name = $applicant_appln_details_list['applicant_name_declaration'];
$applicant_name = ($applicant_name)?$applicant_name:$first_name;

$parent_name = $applicant_appln_details_list['applicant_parentname_declaration'];
$parent_name = (($parent_name)?$parent_name:(($father_name)?$father_name:(($mother_name)?$mother_name:(($guardian_name)?$guardian_name:''))));

$declaration_date = $applicant_appln_details_list['applicant_declaration_date'];
$declaration_date = ($declaration_date)?date('d-m-Y',strtotime($declaration_date)):date('d/m/Y');

$appln_form_fee = $applicant_appln_details_list['appln_form_fee'];
/* Payment Details Start */
$branch_name = $applicant_payment_details_list['branch_name'];
$dd_cheque_no = $applicant_payment_details_list['dd_cheque_no'];
$dd_cheque_date = $applicant_payment_details_list['dd_cheque_date'];
$bank_name=$applicant_payment_details_list['bank_name'];
$bank_name=isset($bank_name)? $bank_name:'Select Bank Name';
if($dd_cheque_date) {
  $dd_cheque_date = date('d/m/Y',strtotime($dd_cheque_date));
}
$payment_mode_id = $applicant_payment_details_list['payment_mode_id'];

/* Payment Details End */
$startIndex = $this->input->get('startIndex', true);

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
/*CRM ADMIN Edit form start*/
$url = base_url().'mtech?startIndex='.$startIndex;
if($mode_edit == ADMIN_MODE_EDIT)
{
  $url = base_url().'mtech/'.$mode_edit.'/'.$crm_applicant_login_id.'/'.$crm_applicant_personal_det_id.'?startIndex='.$startIndex;;
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
          <div class="col-sm-12" id="MtechPreviewToPrint">
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
                                <div class="col-lg-6">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Graduation from India?
                                        <span class="tx-danger">*</span></label>
                                          <select class="form-control custom-select nationality" 
                                          id="graduation_india" name="graduation_india" data-parsley-required="true" data-parsley-required-message="Please Choose Graduation" data-parsley-errors-container="#custom-graduation_india-parsley-error">
                                              <option value=""><?php echo $studied_from_india_name;?></option>
                                          </select>
                                          <span id="custom-graduation_india-parsley-error"></span>
                                    
                                  </div>
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
                            <h5 class="text-primary mb-3 ml-2">Course and Campus Preference </h5>
                          </div>
                          <div class="row w-100">
                            <div class="col-lg-6">
                              <div class="form-group mg-b-10-force">
                                  <label class="form-control-label">Course Preference 1
                                      <span class="tx-danger">*</span></label>
                                  <select class="form-control custom-select study" data-placeholder="Choose Course Preference 1" tabindex="-1" aria-hidden="true" name="course_pref_1" id="course_pref_1" title="Choose Course Preference 1" data-parsley-required="true" data-parsley-required-message="Please Choose Course Preference 1" data-parsley-errors-container="#custom-course_pref_1-parsley-error" data-parsley-trigger="change">
                                      <option value=""><?php echo $course_1; ?></option>
                                  </select>
                                  <span id="custom-course_pref_1-parsley-error"></span>
                              </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6" id="main_div_camp_pref_1">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Campus Preference 1 <span class="tx-danger">*</span></label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Campus Preference 1" tabindex="-1" aria-hidden="true" name="campus_pref_1" id="campus_pref_1" title="Choose Campus Preference 1" data-parsley-required="true" data-parsley-required-message="Please Choose Campus Preference 1" data-parsley-errors-container="#custom-campus_pref_1-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $campus_1; ?></option>
                                    </select>
                                    <span id="custom-campus_pref_1-parsley-error"></span>
                                </div>                                
                            </div>
                          </div>
                          <div class="row w-100">
                            <div class="col-lg-6">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Course Preference 2</label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Course Preference 2" tabindex="-1" aria-hidden="true" name="course_pref_2" id="course_pref_2" title="Choose Course Preference 2" data-parsley-required="false" data-parsley-required-message="Please Choose Course Preference 2" data-parsley-errors-container="#custom-course_pref_2-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $course_2; ?></option>
                                    </select>
                                    <span id="custom-course_pref_2-parsley-error"></span>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6" id="main_div_camp_pref_2">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Campus Preference 2</label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Campus Preference 2" tabindex="-1" aria-hidden="true" name="campus_pref_2" id="campus_pref_2" title="Choose Campus Preference 2" data-parsley-required="false" data-parsley-required-message="Please Choose Campus Preference 2" data-parsley-errors-container="#custom-campus_pref_2-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $campus_2; ?></option>
                                    </select>
                                    <span id="custom-campus_pref_2-parsley-error"></span>
                                </div>                                
                            </div><!-- col-4 -->
                          </div>
                          <div class="row w-100">
                            <div class="col-lg-6">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Course Preference 3</label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Course Preference 3" tabindex="-1" aria-hidden="true" name="course_pref_3" id="course_pref_3" title="Choose Course Preference 3" data-parsley-required="false" data-parsley-required-message="Please Choose Course Preference 3" data-parsley-errors-container="#custom-course_pref_3-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $course_3; ?></option>
                                    </select>
                                    <span id="custom-course_pref_3-parsley-error"></span>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6" id="main_div_camp_pref_3">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Campus Preference 3</label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Campus Preference 3" tabindex="-1" aria-hidden="true" name="campus_pref_3" id="campus_pref_3" title="Choose Campus Preference 3" data-parsley-required="false" data-parsley-required-message="Please Choose Campus Preference 3" data-parsley-errors-container="#custom-campus_pref_3-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $campus_3; ?></option>
                                    </select>
                                    <span id="custom-campus_pref_3-parsley-error"></span>
                                </div>
                            </div><!-- col-4 -->
                          </div><!-- row -->
                          <div class="row w-100">
                            <h5 class="text-primary mb-3 ml-2">Test City Perferences</h5>
                          </div>
                          <div class="row w-100">
                            <div class="col-lg-6">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Test State Perferences 1 <span class="tx-danger">*</span></label>
                                    <select class="form-control select2 test_state" data-placeholder="Choose Test State Perferences 1" tabindex="-1" aria-hidden="false" name="state_pref_1" id="state_pref_1" title="Choose Test State Perferences 1" data-parsley-required="true" data-parsley-required-message="Please Choose Test State Perferences 1" data-parsley-errors-container="#custom-state_pref_1-parsley-error" data-parsley-trigger="change">
                                      <option value=""><?php echo $test_state_1;?></option>
                                    </select>
                                    <span id="custom-state_pref_1-parsley-error"></span>
                                </div>
                            </div><!-- col-6 -->
                            <div class="col-lg-6" id="main_div_city_pref_1">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Test City Perferences 1<span class="tx-danger">*</span></label>
                                    <select class="form-control select2 test_city" data-placeholder="Choose Test City Perferences 1" tabindex="-1" aria-hidden="true" name="city_pref_1" id="city_pref_1" title="Choose Test City Perferences 1" data-parsley-required="true" data-parsley-required-message="Please Choose Test City Perferences 1" data-parsley-errors-container="#custom-city_pref_1-parsley-error" onchange="test_city_pref_change('state_pref_1','city_pref_1')">
                                      <option value=""><?php echo $test_city_1; ?></option>
                                    </select>
                                    <span id="custom-city_pref_1-parsley-error"></span>
                                </div>                                
                            </div><!-- col-6 -->
                          </div>
                          <div class="row w-100">
                              <div class="col-lg-6">
                                  <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Test State Perferences 2</label>
                                      <select class="form-control select2 test_state" data-placeholder="Choose Test State Perferences 2" tabindex="-1" aria-hidden="true" name="state_pref_2" id="state_pref_2" title="Choose Test State Perferences 2" data-parsley-required="false" data-parsley-required-message="Please Choose Test State Perferences 2" data-parsley-errors-container="#custom-state_pref_2-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $test_state_2;?></option>
                                      </select>
                                      <span id="custom-state_pref_2-parsley-error"></span>
                                  </div>
                              </div><!-- col-6 -->
                              <div class="col-lg-6" id="main_div_city_pref_2">
                                  <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Test City Perferences 2</label>
                                      <select class="form-control select2 test_city" data-placeholder="Choose Test City Perferences 2" tabindex="-1" aria-hidden="true" name="city_pref_2" id="city_pref_2" title="Choose Test City Perferences 2" data-parsley-required="false" data-parsley-required-message="Please Choose Test City Perferences 2" data-parsley-errors-container="#custom-city_pref_2-parsley-error" data-parsley-trigger="change" onchange="test_city_pref_change('state_pref_2','city_pref_2')">
                                        <option value=""><?php echo $test_city_2; ?></option>
                                      </select>
                                      <span id="custom-city_pref_2-parsley-error"></span>
                                  </div>
                                  <input type="hidden" name="city_choice_no_2" id="city_choice_no_2" value="<?php echo (isset($applicant_city_choice_no[1]))?$applicant_city_choice_no[1]:'2'; ?>" />
                                  <input type="hidden" name="city_prefer_id_2" id="city_prefer_id_2" value="<?php echo (isset($applicant_city_id[1]))?$applicant_city_id[1]:''; ?>" />
                              </div><!-- col-6 -->
                          </div>
                          <div class="row w-100">
                            <h5 class="text-primary mt-4 mb-3 ml-2">Personal Details</h5>
                          </div>
                          <div class="row w-100 print_margin_4">
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Title <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_title" id="pd_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="Please Choose Title" data-parsley-errors-container="#custom-pd_title-parsley-error" data-parsley-trigger="change">
                                    <option value=""><?php echo $title_name ;?> </option>
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
                                          <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected><?php echo $mob_country_code_name ;?></option>
                                      </select>
                                  </span>
                                  <input type="text" name="pd_mobile_no" id="pd_mobile_no" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Mobile No" class="form-control" data-parsley-required="true" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-errors-container="#custom-pd_mobile_no-parsley-error" value="<?php echo $mobile_no; ?>" data-parsley-trigger="change">
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
                                        <option value=""><?php echo $gender_name ;?></option>
                                    </select>
                                    <span id="custom-pd_gender-parsley-error"></span>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Alternate Email ID</label>
                                    <input class="form-control" type="email" name="pd_alt_email" id="pd_alt_email" placeholder="Alternate Email" data-parsley-required="false" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Alternate Email ID" data-parsley-errors-container="#custom-pd_alt_email-parsley-error" data-parsley-trigger="change" value="<?php echo $sec_e_mail; ?>">
                                    <span id="custom-pd_alt_email-parsley-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Blood Group <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Blood Group" tabindex="-1" aria-hidden="true" name="pd_blood_group" id="pd_blood_group" title="Choose Blood Group" data-parsley-required="true" data-parsley-required-message="Please Choose Blood Group" data-parsley-errors-container="#custom-pd_blood_group-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $blood_grp_name ;?> </option>
                                    </select>
                                    <span id="custom-pd_blood_group-parsley-error"></span>
                                </div>
                            </div>
                            <!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Religion</label>
                                    <select class="form-control select2" data-placeholder="Choose Religion" tabindex="-1" aria-hidden="true" name="pd_religion" id="pd_religion" title="Choose Religion" data-parsley-required="false" data-parsley-required-message="Please Choose Religion" data-parsley-errors-container="#custom-pd_religion-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $religion_name; ?></option>
                                    </select>
                                    <span id="custom-pd_religion-parsley-error"></span>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Mother Tongue</label>
                                    <select class="form-control select2" data-placeholder="Choose Mother Tongue" tabindex="-1" aria-hidden="true" name="pd_mother_tongue" id="pd_mother_tongue" title="Choose Mother Tongue" data-parsley-required="false" data-parsley-required-message="Please Choose Mother Tongue" data-parsley-errors-container="#custom-pd_mother_tongue-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $mothertongue_name;?></option>
                                    </select>
                                    <span id="custom-pd_mother_tongue-parsley-error"></span>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Medium of Instruction</label>
                                    <select class="form-control select2" data-placeholder="Choose Medium of Instruction" tabindex="-1" aria-hidden="true" name="pd_medium_of_instruction" id="pd_medium_of_instruction" title="Choose Medium of Instruction" data-parsley-required="false" data-parsley-required-message="Please Choose Medium of Instruction" data-parsley-errors-container="#custom-pd_medium_of_instruction-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $medium_of_study_name ;?></option>
                                    </select>
                                    <span id="custom-pd_medium_of_instruction-parsley-error"></span>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Hostel Accommodation</label>
                                    <select class="form-control select2" data-placeholder="Choose Hostel Accommodation" tabindex="-1" aria-hidden="true" name="pd_hostel_accommodation" id="pd_hostel_accommodation" title="Choose Hostel Accommodation" data-parsley-required="false" data-parsley-required-message="Please Choose Hostel Accommodation" data-parsley-errors-container="#custom-pd_hostel_accommodation-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $hostel_accommodation_select_name ; ?></option>
                                    </select>
                                    <span id="custom-pd_hostel_accommodation-parsley-error"></span>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Are you a differently Abled? <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Differently Abled" tabindex="-1" aria-hidden="true" name="pd_diffrently_abled" id="pd_diffrently_abled" title="Choose Differently Abled" data-parsley-required="true" data-parsley-required-message="Please Choose Differently Abled" data-parsley-errors-container="#custom-pd_diffrently_abled-parsley-error" data-parsley-trigger="change">
                                    <option value=""><?php echo $diff_abled_select_name;?></option>
                                    </select>
                                    <span id="custom-pd_diffrently_abled-parsley-error"></span>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Where do you see admission advertisement?</label>
                                    <select class="form-control select2" data-placeholder="Choose Advertisement Source" tabindex="-1" aria-hidden="true" name="pd_advertisement_source" id="pd_advertisement_source" title="Choose Advertisement Source " data-parsley-required="false" data-parsley-required-message="Please Choose Advertisement Source" data-parsley-errors-container="#custom-pd_advertisement_source-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $source_name ;?></option>
                                    </select>
                                    <span id="custom-pd_advertisement_source-parsley-error"></span>
                                </div>
                            </div><!-- col-4 -->
                            
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Nationality <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Nationality" tabindex="-1" aria-hidden="true" name="pd_nationality" id="pd_nationality" title="Choose Nationality" data-parsley-required="true" data-parsley-required-message="Please Choose Nationality" data-parsley-errors-container="#custom-pd_nationality-parsley-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $nationality;?></option>
                                    </select>
                                    <span id="custom-pd_nationality-parsley-error"></span>
                                </div>
                            </div><!-- col-4 -->
                          <?php if($nation_id==COUNTRY_VALUE_DEFAULT) { ?>
                            <div class="col-lg-4" id="main_div_community">
                                <div class="form-group mg-b-10-force" id="Community">
                                    <label class="form-control-label">Community <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Community" tabindex="-1" aria-hidden="true" name="pd_social_status" id="pd_social_status" title="Choose Community" data-parsley-required="false" data-parsley-required-message="Please Choose Community" data-parsley-errors-container="#custom-pd_social_status-parsley-error" data-parsley-trigger="change">
                                        <option value="">Choose Community</option>
                                    </select>
                                    <span id="custom-pd_social_status-parsley-error"></span>
                                </div>
                            </div><!-- col-4 -->
                          <?php } ?>
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
                                <h5 class="text-primary mb-3 ml-2">Father's Details</h5>
                            </div>
                            <div class="row w-100 ">
                              <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Title <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_father_title" id="pd_father_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="Please Choose Title" data-parsley-errors-container="#custom-pd_father_title-parsley-error" data-parsley-trigger="change">
                                      <option value=""><?php echo $father_title_name;?></option>
                                    </select>
                                    <span id="custom-pd_father_title-parsley-error"></span>
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
                                      <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected><?php echo $father_alt_mob_country_code ;?></option>
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
                                      <option value=""><?php echo $father_occupation;?></option>
                                    </select>
                                  </div>
                                  <?php  if($father_occupation_id == OTHER_OCCUPATION) { ?>
                                  <div id="other_occupation_father_div">
                                    <input class="form-control" type="text" name="other_occupation_father" id="other_occupation_father"  placeholder="If Other, pls enter here"data-parsley-required="false" data-parsley-errors-container="#custom-other_occupation_father-parsley-error" 
                                    value="<?php echo $father_other_occupation; ?>">
                                    <span id="custom-other_occupation_father-parsley-error"></span>
                                  </div>
                                   <?php } ?>
                              </div><!-- col-4 -->
                               <?php } ?>

                            </div><!-- row -->  
                            <div class="row w-100">
                                <h5 class="text-primary mb-3 ml-2">Mother's Details</h5>
                            </div>
                            <div class="row w-100">
                              <div class="col-lg-4">
                                  <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Title <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" name="pd_mother_title" id="pd_mother_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="Please Choose Title" data-parsley-errors-container="#custom-pd_mother_title-parsley-error" data-parsley-trigger="change">
                                      <option value=""><?php echo $mother_title_name;?></option>
                                    </select>
                                    <span id="custom-pd_mother_title-parsley-error"></span>
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
                                      <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected><?php echo $mother_alt_mob_country_code; ?></option>
                                    </select>
                                  </span>
                                  <input type="text" class="form-control" name="pd_mother_alt_phone" id="pd_mother_alt_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_mother_alt_phone-parsley-error" value="<?php echo $mother_alt_mobile ; ?>">
                                  <span id="custom-pd_mother_alt_phone-parsley-error"></span>
                                  </div>
                              </div>
                              <div class="col-lg-4" id="mother_email_div">
                                  <div class="form-group">
                                      <label class="form-control-label">Mother's Email ID </label>
                                      <input class="form-control" type="email" name="pd_mother_email" id="pd_mother_email"  placeholder="Enter Your Mother's Email ID"data-parsley-required="false" data-parsley-required-message="Please Enter Email ID" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Email ID" data-parsley-errors-container="#custom-pd_mother_email-parsley-error" 
                                      value="<?php echo $mother_email; ?>" maxlength="100">
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
                                  <?php if ($mother_occupation_id==OTHER_OCCUPATION) { ?>
                                    <div id="other_occupation_mother_div">
                                      <input class="form-control" type="text" name="other_occupation_mother" id="other_occupation_mother"  placeholder="If Other, pls enter here"data-parsley-required="false" data-parsley-errors-container="#custom-other_occupation_mother-parsley-error" value="<?php echo $mother_other_occupation; ?>">
                                      <span id="custom-other_occupation_mother-parsley-error"></span>
                                    </div>
                                  <?php } ?>
                              </div><!-- col-4 -->
                               <?php } ?>
                            </div><!-- row -->
                            <?php if (!empty($add_gardian) && $add_gardian=='t') { ?>
                            <div class="row w-100 ml-2">
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
                                          <label class="form-control-label">Guardian's Name <span class="tx-danger">*</span></label>
                                          <input class="form-control" type="text" name="pd_guardian_name" id="pd_guardian_name" placeholder="Enter Your Guardian Name" maxlength="50" data-parsley-required="true" data-parsley-required-message="Please Enter Your Guardian Name" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" value="<?php echo $guardian_name; ?>">
                                        </div>
                                    </div><!-- col-4 -->
                                    <div class="col-lg-4">
                                        <label class="form-control-label">Guardian's Mobile NO <span class="tx-danger">*</span></label>
                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                        <select class="form-control form_control custom-select Mobile_number" id="pd_guardian_phone_no_code" name="pd_guardian_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                          <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected><?php echo $guardian_country_mob_code;?></option>
                                        </select>
                                        </span>
                                        <input type="text" class="form-control" name="pd_guardian_phone" id="pd_guardian_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Guardian's Mobile No" class="form-control" data-parsley-required="true" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_guardian_phone-parsley-error" value="<?php echo $guardian_mobile; ?>">
                                        <span id="custom-pd_guardian_phone-parsley-error"></span>
                                      </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Guardian's Email ID</label>
                                            <input class="form-control" type="email" name="pd_guardian_email" id="pd_guardian_email"  placeholder="Enter Your Guardian's Email ID"data-parsley-required="false" data-parsley-required-message="Please Enter Email ID" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Email ID" data-parsley-errors-container="#custom-pd_guardian_email-parsley-error" 
                                            value="<?php echo $guardian_email; ?>" maxlength="100">
                                            <span id="custom-pd_guardian_email-parsley-error"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Guardian's Occupation</label>
                                            <select class="form-control select2" data-placeholder="Choose Guardian Occupation" tabindex="-1" aria-hidden="true" name="pd_guardian_occupation" id="pd_guardian_occupation">
                                              <option value=""><?php echo $guardian_occupation;?></option>
                                            </select>
                                        </div>
                                        <?php if($guardian_occupation_id==OTHER_OCCUPATION) { ?>
                                        <div id="other_occupation_guardian_div">
                                          <input class="form-control" type="text" 
                                          name="other_occupation_guardian" id="other_occupation_guardian"  placeholder="If Other, pls enter here"data-parsley-required="false" data-parsley-errors-container="#custom-other_occupation_guardian-parsley-error" value="<?php echo $guardian_other_occupation; ?>">
                                          <span id="custom-other_occupation_guardian-parsley-error"></span>
                                      </div>
                                    <?php } ?>
                                    </div><!-- col-4 -->
                                </div><!-- row -->
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
                                        <option value=""><?php echo $country_name ;?></option>
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
                            <div class="col-lg-6">
                                <div class="form-group mr-5">
                                    <label class="form-control-label">Current Education Qualification Status <span class="tx-danger">*</span></label>
                                    <div class="row">
                                      <div class="col-lg-5 pr-0">
                                        <div class="custom-control custom-radio custom-control-inline">
                                          <input type="radio" id="appering" name="current_education_qual_status" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="Please Choose Current Education Qualification Status" data-parsley-errors-container="#custom-current_education_qual_status-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($cur_qual_completed == 'f')?'checked':''; ?>>
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
                                        <input class="form-control" type="text" name="canditate_name" id="canditate_name" placeholder="Enter Name" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 100]" value="<?php echo $canditate_name; ?>" maxlength="100" data-parsley-trigger="change">
                                        <small id="emailHelp"
                                            class="form-text text-muted">Kindly type "NA" in
                                            case Certificate is not available with you.</small>
                                    </div>
                                </div><!-- form-group -->
                            </div>
                          </div>
                          <?php if($cur_qual_completed == 'f') { ?>
                          <div id="exp_year" class="row w-100">
                            <div class="col-lg-6">
                                <div class="wd-200 w-100">
                                    <label class="form-control-label">Expected month and Year of result to be declared <span class="tx-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                        <input id="result_declare_date" name="result_declare_date" type="text" class="form-control hasDatepicker" placeholder="MM/YYYY" readonly data-parsley-required="false" data-parsley-required-message="Please Choose declare Month and Year" value="<?php echo $result_declare_date; ?>" data-parsley-errors-container="#custom-result_declare_date-parsley-error" data-parsley-trigger="change" >
                                    </div>
                                    <span id="custom-result_declare_date-parsley-error"></span>
                                </div>
                            </div>
                          </div>
                          <?php } ?>
                          <section class="row">
                            <div class="table-responsive pretbl print_margin_4">
                            <table class="table table-bordered mt-0">
                              <thead class="thead-light">
                                  <tr>
                                      <th>Course</th>
                                      <th>Institute Name</th>
                                      <th>University</th>
                                      <th class="reg_width">Roll No. / Registration No.</th>
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
                                        <input class="form-control" type="text" name="institute_name" id="institute_name" placeholder="Enter Institute Name" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Institute Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 100]" value="<?php echo $applicant_grad_det_insti_name; ?>" maxlength="100" data-parsley-trigger="change">
                                        <span class="tx-danger required_asterisk">*</span>
                                      </td>
                                      <td>
                                        <div class="form-group mg-b-10-force">
                                          <select class="form-control custom-select" id="institute_university" name="institute_university" data-placeholder="Choose University" data-parsley-required="true" data-parsley-required-message="Please Choose University" data-parsley-errors-container="#custom-institute_university-parsley-error">
                                            <option value=""><?php echo $applicant_grad_det_univ_name; ?></option>
                                          </select>
                                          <span class="tx-danger required_asterisk">*</span>
                                          <span id="custom-institute_university-parsley-error"></span>
                                        </div>
                                      </td>
                                      <td class="reg_width">
                                        <input class="form-control" type="text" name="registration_no" id="registration_no" placeholder="Roll No. / Registration No" maxlength="10" data-parsley-required="true" data-parsley-required-message="Please Enter Roll No. / Registration No" data-parsley-trigger="change" value="<?php echo $applicant_grad_det_reg_no; ?>">
                                        <span class="tx-danger required_asterisk">*</span>
                                      </td>
                                      <td>
                                        <div class="form-group mg-b-10-force">
                                          <select class="form-control custom-select" name="mode_of_study" id="mode_of_study" data-parsley-required="true" data-parsley-required-message="Please Choose Mode of Study" data-parsley-trigger="change" data-parsley-errors-container="#custom-mode_of_study-parsley-error">
                                            <option value=""><?php echo $applicant_grad_det_mode_study_name;?></option>
                                          </select>
                                          <span class="tx-danger required_asterisk">*</span>
                                          <span id="custom-mode_of_study-parsley-error"></span>
                                        </div>
                                      </td>
                                      <td>
                                        <input class="form-control" type="text" name="year_of_passing" id="year_of_passing" placeholder="YYYY" maxlength="4" data-parsley-required="true" data-parsley-required-message="Please Enter Year of Passing" data-parsley-trigger="change" data-parsley-errors-container="#custom-year_of_passing-parsley-error" value="<?php echo $applicant_grad_det_completion_year; ?>">
                                        <span class="tx-danger required_asterisk">*</span>
                                        <span id="custom-year_of_passing-parsley-error"></span>
                                      </td>
                                      <td>
                                          <div class="form-group mg-b-10-force" id="appering_info_1">
                                            <select class="form-control custom-select" name="marking_scheme" id="marking_scheme" data-parsley-required="true" data-parsley-required-message="Please Choose Marking Scheme" data-parsley-trigger="change" data-parsley-errors-container="#custom-marking_scheme-parsley-error">
                                              <option value=""><?php echo $applicant_grad_det_mark_scheme ;?></option>
                                            </select>
                                            <span class="tx-danger required_asterisk">*</span>
                                            <span id="custom-marking_scheme-parsley-error"></span>
                                          </div>
                                      </td>
                                      <td>
                                        <div class="form-group mg-b-10-force" id="appering_info_2">
                                          <input class="form-control" type="text" name="obtained_percentage_cgpa" placeholder="Obtained Percentage/CGPA" id="obtained_percentage_cgpa" maxlength="5" data-parsley-required="true" data-parsley-required-message="Please Enter Obtained Percentage/CGPA" data-parsley-trigger="change" data-parsley-errors-container="#custom-obtained_percentage_cgpa-parsley-error" value="<?php echo $applicant_grad_det_mark_percent; ?>"> 
                                          <span class="tx-danger required_asterisk">*</span>
                                          <span id="custom-obtained_percentage_cgpa-parsley-error"></span>
                                        </div>
                                      </td>
                                  </tr>
                              </tbody>
                            </table>
                          </div>
                            <div class="mt-3 w-100 ">
                              <div class="row">

                                  <div class="col-lg-6">
                                      <div class="form-group">
                                          <label class="form-control-label">NAD ID / Digilocker ID</label>
                                          <input class="form-control" type="text" name="nad_id_digilocker_id" id="nad_id_digilocker_id" placeholder="Enter NAD ID / Digilocker ID " value="<?php echo $nad_id_digilocker_id; ?>" maxlength="12">
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
                                          <select class="form-control custom-select study" id="taken_any_competitive_exam" name="taken_any_competitive_exam" data-parsley-required="true" data-parsley-required-message="Please select the status" data-parsley-errors-container="#custom-taken_any_competitive_exam-parsley-error" data-parsley-trigger="change">
                                              <option value="">
                                                <?php echo $is_competitive_exam_select_name ;?>
                                                </option>
                                          </select>
                                          <span id="custom-taken_any_competitive_exam-parsley-error"></span>
                                      </div>
                                  </div>
                              </div>
                              <?php if($is_competitive_exam == 't') { ?>
                              <div class="row" id="competitive_exam_dtl">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="control-label" for="radios" style="display: none ;">Important Instruction:</label>
                                    <p style="display: none ;">Applicants are directed to update the below table immediately after the any Competitive Exam results are announced. The merit list will be finalised based on the scores submitted by applicant.</p>
                                    <label class="control-label" for="radios" style="display: none ;">Competitive Exam</label>
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
                                              <select class="form-control custom-select study" id="competitive_exam_1" name="competitive_exam_1" data-parsley-required="true" data-parsley-required-message="Please select the competitive examination" data-parsley-errors-container="#custom-competitive_exam_1-parsley-error" data-parsley-trigger="change">
                                                <option value=""><?php echo $applicant_comp_exam_name[0];?></option>
                                              </select>
                                              <span id="custom-competitive_exam_1-parsley-error"></span>
                                              <span class="tx-danger required_asterisk">*</span>
                                            </td>
                                            <td>
                                              <input class="form-control" type="text" name="registration_no_1" id="registration_no_1" placeholder="Registration No" maxlength="10" data-parsley-required="true" data-parsley-required-message="Please Enter Registration No" data-parsley-trigger="change" value="<?php echo $applicant_comp_exam_registration_no[0]; ?>">
                                              <span class="tx-danger required_asterisk">*</span>
                                            </td>
                                            <td>
                                              <input class="form-control" type="text" name="score_obtained_1" id="score_obtained_1" placeholder="Score Obtained" maxlength="7" data-parsley-required="true" data-parsley-required-message="Please Enter Score Obtained" data-parsley-trigger="change" value="<?php echo $applicant_comp_exam_score_obtained[0]; ?>">
                                              <span class="tx-danger required_asterisk">*</span>
                                            </td>
                                            <td>
                                              <input class="form-control" type="text" name="max_score_1" id="max_score_1" placeholder="Max Score" maxlength="9" data-parsley-required="true" data-parsley-required-message="Please Enter Max Score" data-parsley-trigger="change" value="<?php echo $applicant_comp_exam_max_score[0]; ?>">
                                              <span class="tx-danger required_asterisk">*</span>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="year_appeared_1" id="year_appeared_1" placeholder="YYYY" maxlength="4" data-parsley-required="true" data-parsley-required-message="Please Enter Year Appeared" data-parsley-trigger="change" data-parsley-errors-container="#custom-year_appeared_1-parsley-error" value="<?php echo $applicant_comp_exam_exam_year[0]; ?>">
                                                <span class="tx-danger required_asterisk">*</span>
                                                <span id="custom-year_appeared_1-parsley-error"></span>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="air_overall_rank_1" id="air_overall_rank_1" placeholder="AIR / Overall Rank" maxlength="9" data-parsley-required="true" data-parsley-required-message="Please Enter AIR / Overall Rank" data-parsley-trigger="change" value="<?php echo $applicant_comp_exam_all_india_rank[0]; ?>">
                                                <span class="tx-danger required_asterisk">*</span>
                                            </td>
                                            <td>
                                              <select class="form-control custom-select study" id="qualified_not_qualified_1" name="qualified_not_qualified_1" data-parsley-required="true" data-parsley-required-message="Please select the Qualified / Not Qualified" data-parsley-errors-container="#custom-qualified_not_qualified_1-parsley-error" data-parsley-trigger="change">
                                                  <option value="">
                                                    <?php echo $applicant_comp_exam_qualified_name1;?></option>
                                              </select>
                                              <span class="tx-danger required_asterisk">*</span>
                                              <span id="custom-qualified_not_qualified_1-parsley-error"></span>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>                                              
                                              <select class="form-control custom-select study" id="competitive_exam_2" name="competitive_exam_2" data-parsley-required="false" data-parsley-required-message="Please select the competitive examination" data-parsley-errors-container="#custom-competitive_exam_2-parsley-error" data-parsley-trigger="change">
                                                <option value=""><?php echo $applicant_comp_exam_name[1];?></option>
                                              </select>
                                              <span id="custom-competitive_exam_2-parsley-error"></span>
                                            </td>
                                            <td>
                                              <input class="form-control" type="text" name="registration_no_2" id="registration_no_2" placeholder="Registration No" maxlength="10" data-parsley-required="false" data-parsley-required-message="Please Enter Registration No" data-parsley-trigger="change" value="<?php echo $applicant_comp_exam_registration_no[1]; ?>">
                                            </td>
                                            <td>
                                              <input class="form-control" type="text" name="score_obtained_2" id="score_obtained_2" placeholder="Score Obtained" maxlength="7" data-parsley-required="false" data-parsley-required-message="Please Enter Score Obtained" data-parsley-trigger="change" value="<?php echo $applicant_comp_exam_score_obtained[1]; ?>">
                                            </td>
                                            <td>
                                              <input class="form-control" type="text" name="max_score_2" id="max_score_2" placeholder="Max Score" maxlength="9" data-parsley-required="false" data-parsley-required-message="Please Enter Max Score" data-parsley-trigger="change" value="<?php echo $applicant_comp_exam_max_score[1]; ?>">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="year_appeared_2" id="year_appeared_2" placeholder="YYYY" maxlength="4" value="<?php echo $applicant_comp_exam_exam_year[1]; ?>" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="air_overall_rank_2" id="air_overall_rank_2" placeholder="AIR / Overall Rank" maxlength="9" value="<?php echo $applicant_comp_exam_all_india_rank[1]; ?>">
                                            </td>
                                            <td>
                                              <select class="form-control custom-select study" id="qualified_not_qualified_2" name="qualified_not_qualified_2">
                                                    <option value="">
                                                    <?php echo $applicant_comp_exam_qualified_name2;?>
                                                    </option>
                                              </select>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <input class="form-control" type="hidden" placeholder="" id="comp_exam_pk_id_3" name="comp_exam_pk_id_3" value="<?php echo $applicant_comp_exam_pk_id[2]; ?>">
                                              <select class="form-control custom-select study" id="competitive_exam_3" name="competitive_exam_3" data-parsley-required="false" data-parsley-required-message="Please select the competitive examination" data-parsley-errors-container="#custom-competitive_exam_3-parsley-error" data-parsley-trigger="change">
                                                <option value=""><?php echo $applicant_comp_exam_name[2];?></option>
                                              </select>
                                              <span id="custom-competitive_exam_3-parsley-error"></span>
                                            </td>
                                            <td>
                                              <input class="form-control" type="text" name="registration_no_3" id="registration_no_3" placeholder="Registration No" maxlength="10" value="<?php echo $applicant_comp_exam_registration_no[2]; ?>">
                                            </td>
                                            <td>
                                              <input class="form-control" type="text" name="score_obtained_3" id="score_obtained_3" placeholder="Score Obtained" maxlength="7"value="<?php echo $applicant_comp_exam_score_obtained[2]; ?>">
                                            </td>
                                            <td>
                                              <input class="form-control" type="text" name="max_score_3" id="max_score_3" placeholder="Max Score" maxlength="9" value="<?php echo $applicant_comp_exam_max_score[2]; ?>">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="year_appeared_3" id="year_appeared_3" placeholder="YYYY" maxlength="4" value="<?php echo $applicant_comp_exam_exam_year[2]; ?>" readonly>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" name="air_overall_rank_3" id="air_overall_rank_3" placeholder="AIR / Overall Rank" maxlength="9" value="<?php echo $applicant_comp_exam_all_india_rank[2]; ?>">
                                            </td>
                                            <td>
                                              <select class="form-control custom-select study" id="qualified_not_qualified_3" name="qualified_not_qualified_3">
                                                  <option value="">
                                                    <?php echo $applicant_comp_exam_qualified_name3;?>
                                                    </option>
                                              </select>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                             <?php } ?>
                            </div>
                            <div class="mt-3 w-100">
                              <div class="row">
                                  <div class="col-lg-6">
                                      <div class="form-group">
                                          <h6 class="card-body-title mb-4">Work Experience Details</h6>
                                          <label class="form-control-label">Do you have any Work Experience ? <span class="tx-danger">*</span></label>
                                          <select class="form-control custom-select study" id="is_work_experience" name="is_work_experience" data-parsley-required="true" data-parsley-required-message="Please select the Work Experience" data-parsley-errors-container="#custom-is_work_experience-parsley-error" data-parsley-trigger="change">
                                              <option value=""><?php echo $is_work_experience_select_name ;?></option>
                                          </select>
                                          <span id="custom-is_work_experience-parsley-error"></span>
                                      </div>
                                  </div>
                              </div>
                              <?php if($is_work_experience == 't') { ?>
                              <div class="row" id="emp_exp">
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
                                                 <div class="form-group"><input type="text" name="organisation_name_0" id="organisation_name_0" class="form-control" placeholder="" maxlength="100"data-parsley-required="true" data-parsley-required-message="Please enter the organisation name" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_org_name[0]; ?>"></div>
                                                 <span class="tx-danger required_asterisk">*</span>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input type="text" name="designation_0" id="designation_0" class="form-control" placeholder="" maxlength="100" data-parsley-required="true" data-parsley-required-message="Please enter the designation" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_designation[0]; ?>"></div>
                                                 <span class="tx-danger required_asterisk">*</span>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input type="text" name="nature_of_job_0" id="nature_of_job_0" class="form-control" placeholder="" maxlength="100" data-parsley-required="true" data-parsley-required-message="Please enter the nature of job" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_job_nature[0]; ?>"></div>
                                                 <span class="tx-danger required_asterisk">*</span>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input type="text" name="total_salary_month_0" id="total_salary_month_0" class="form-control" placeholder="" maxlength="10"data-parsley-required="true" data-parsley-required-message="Please enter the total salary month" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_salary[0]; ?>"></div>
                                                 <span class="tx-danger required_asterisk">*</span>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input readonly="" type="text" name="from_year_0" id="from_year_0" class="form-control datepicker" placeholder="MM/YYYY" maxlength="7" data-parsley-required="true" data-parsley-required-message="Please enter the from year" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_from_date[0]; ?>"></div>
                                                 <span class="tx-danger required_asterisk">*</span>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input readonly="" type="text" name="to_year_0" id="to_year_0" class="form-control datepicker" placeholder="MM/YYYY" maxlength="7" data-parsley-required="true" data-parsley-required-message="Please enter the to year" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_to_date[0]; ?>"></div>
                                                 <span class="tx-danger required_asterisk">*</span>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input type="text" name="work_experience_0" id="work_experience_0" class="form-control" placeholder="" readonly="readonly" maxlength="5" data-parsley-required="true" data-parsley-required-message="Please enter the work experience" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_work_exp_in_months[0]; ?>"></div>
                                                 <span class="tx-danger required_asterisk">*</span>
                                              </td>
                                           </tr>
                                           <tr>
                                              <td nowrap="">2.</td>
                                              <td>
                                                 <input class="form-control" type="hidden" placeholder="" id="prof_exp_id_1" name="prof_exp_id_1" value="<?php echo $applicant_prof_exp_id[1]; ?>">
                                                 <div class="form-group"><input type="text" name="organisation_name_1" id="organisation_name_1" class="form-control" placeholder="" maxlength="100" value="<?php echo $applicant_prof_exp_org_name[1]; ?>"></div>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input type="text" name="designation_1" id="designation_1" class="form-control" placeholder="" maxlength="100" value="<?php echo $applicant_prof_exp_designation[1]; ?>"></div>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input type="text" name="nature_of_job_1" id="nature_of_job_1" class="form-control" placeholder="" maxlength="100" value="<?php echo $applicant_prof_exp_job_nature[1]; ?>"></div>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input type="text" name="total_salary_month_1" id="total_salary_month_1" class="form-control" placeholder="" maxlength="10" value="<?php echo $applicant_prof_exp_salary[1]; ?>"></div>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input readonly="" type="text" name="from_year_1" id="from_year_1" class="form-control datepicker" placeholder="MM/YYYY" maxlength="7" value="<?php echo $applicant_prof_exp_from_date[1]; ?>"></div>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input readonly="" type="text" name="to_year_1" id="to_year_1" class="form-control datepicker" placeholder="MM/YYYY" maxlength="7" value="<?php echo $applicant_prof_exp_to_date[1]; ?>"></div>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input type="text" name="work_experience_1" id="work_experience_1" class="form-control" placeholder="" readonly="readonly" maxlength="5" value="<?php echo $applicant_prof_exp_work_exp_in_months[1]; ?>"></div>
                                              </td>
                                           </tr>
                                           <tr>
                                              <td nowrap="">3.</td>
                                              <td>
                                                 <input class="form-control" type="hidden" placeholder="" id="prof_exp_id_2" name="prof_exp_id_2" value="<?php echo $applicant_prof_exp_id[2]; ?>">
                                                 <div class="form-group"><input type="text" name="organisation_name_2" id="organisation_name_2" class="form-control" placeholder="" maxlength="100" value="<?php echo $applicant_prof_exp_org_name[2]; ?>"></div>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input type="text" name="designation_2" id="designation_2" class="form-control" placeholder="" maxlength="100" value="<?php echo $applicant_prof_exp_designation[2]; ?>"></div>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input type="text" name="nature_of_job_2" id="nature_of_job_2" class="form-control" placeholder="" maxlength="100" value="<?php echo $applicant_prof_exp_job_nature[2]; ?>"></div>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input type="text" name="total_salary_month_2" id="total_salary_month_2" class="form-control" placeholder="" maxlength="10" value="<?php echo $applicant_prof_exp_salary[2]; ?>"></div>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input readonly="" type="text" name="from_year_2" id="from_year_2" class="form-control datepicker" placeholder="MM/YYYY" maxlength="7" value="<?php echo $applicant_prof_exp_from_date[2]; ?>"></div>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input readonly="" type="text" name="to_year_2" id="to_year_2" class="form-control datepicker" placeholder="MM/YYYY" maxlength="7" value="<?php echo $applicant_prof_exp_to_date[2]; ?>"></div>
                                              </td>
                                              <td>
                                                 <div class="form-group"><input type="text" name="work_experience_2" id="work_experience_2" class="form-control" placeholder="" readonly="readonly" maxlength="5" value="<?php echo $applicant_prof_exp_work_exp_in_months[2]; ?>"></div>
                                              </td>
                                           </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row" id="emp_total_exp">
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
                                      <input type="text" name="total_work_experience" id="total_work_experience" class="form-control" placeholder="Total Work Experience" readonly="readonly" maxlength="5" value="<?php echo $total_work_exp; ?>">
                                   </div>
                                </div>
                              </div>
                            <?php } ?>
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
                                       <p class="card-subtitle mb-3">Name : <?php echo $first_name." ".$last_name; ?> </p>
                                       <p class="card-subtitle mb-3">E-Mail : <?php echo $email_id;?></p>
                                       <p class="card-subtitle">Phone Number : <?php echo $applicant_mob_country_code_name."-".$mobile_no; ?></p>
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
               <div class="card card_print">
                  <div class="card-header" id="headingSix">
                     <h2 class="mb-0"> 
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix"> Upload</button>
                     </h2>
                  </div>
                  <div id="collapseSix" class="collapse show bg-light" aria-labelledby="headingSix" data-parent="#accordionExample">
                     <div class="card-body">
                        <section class="row">
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
                                           <input type="file" class="filestyle" name="photograph" id="photograph" data-parsley-required="<?php echo ((isset($docs[$document_id_photograph]))?'false':'true'); ?>" data-parsley-required-message="Please upload photograph" data-parsley-errors-container="#custom-photograph-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
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

                                           <input type="file" class="filestyle" name="signature" id="signature" data-parsley-required="<?php echo ((isset($docs[$document_id_signature]))?'false':'true'); ?>" data-parsley-required-message="Please upload signature" data-parsley-errors-container="#custom-signature-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>"  accept="<?php  echo allow_extension($file_allowed_type); ?>">
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

                                             <input type="file" class="filestyle" name="graduation_marksheet" id="graduation_marksheet" data-parsley-required="false" data-parsley-required-message="Please upload your graduation marksheet" data-parsley-errors-container="#custom-graduation_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_500_KB; ?>"data-max-file-size-js="<?php echo MAX_FILE_SIZE_500_KB_JS; ?>"  data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_graduation_marksheet])){ echo $docs[$document_id_graduation_marksheet]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
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
                                        <?php if($is_competitive_exam == 't') { ?>
                                        <div class="form-group col-md-6" id="competitive_exam_marksheet_div" >
                                            <label for="exampleFormControlTextarea1">Upload Your Competitive Exam marksheet</label>
                                             <input type="file" class="filestyle" name="competitive_exam_marksheet" id="competitive_exam_marksheet" data-parsley-required="false"  data-parsley-required-message="Please upload your competitive exam marksheet" data-parsley-errors-container="#custom-competitive_exam_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_500_KB; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_500_KB_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_competitive_exam_marksheet])){ echo $docs[$document_id_competitive_exam_marksheet]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
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
                                      <?php } ?>
                                        
                                    </div>
                                  </div>
                              </div>
                          </div>
                        </section>
                    </div>
                  </div>
                </div>
                <div class="card card_print">
                  <div class="card-header" id="headingSix">
                     <h2 class="mb-0"> 
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven"> Declaration</button>
                     </h2>
                  </div>
                  <div id="collapseSeven" class="collapse show bg-light" aria-labelledby="headingSix" data-parent="#accordionExample">
                     <div class="card-body">
                        <section class="row">
                           <div class="col-md-12">
                              <div class="form-layout">
                                 <div class="row mg-b-25 mt-3">
                                    <p>This is to certify that the particulars given above are true, correct and complete to best of my knowledge and belief.</p>       
                                    <div class="row w-100">
                                      <div class="col-md-6">
                                        <label class="form-control-label">Applicant Name <span class="tx-danger">*</span> </label>
                                        <input class="form-control" type="text" name="applicant_name" id="applicant_name" placeholder="Applicant Name" maxlength="100" data-parsley-required="false" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Applicant Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 100]" value="<?php echo $applicant_name; ?>" data-parsley-trigger="change">
                                      </div>
                                      <div class="col-md-6">
                                        <label class="form-control-label">Parent Name <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="parent_name" id="parent_name" placeholder="Parent Name" maxlength="100" data-parsley-required="false" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Parent Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 100]" value="<?php echo $parent_name; ?>" data-parsley-trigger="change">
                                      </div>  
                                    </div>
                                    <div class="row w-100 mt-3">
                                      <div class="col-md-6">
                                        <label class="form-control-label">Date <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="declaration_date" id="declaration_date" value="<?php echo $declaration_date; ?>" readonly>
                                      </div>
                                    </div>
                                  </div>
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
