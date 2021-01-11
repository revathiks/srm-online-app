<?php 
$first_name=$applicant_basic_details_list['f_name'];
$middle_name=$applicant_basic_details_list['m_name'];
$last_name=$applicant_basic_details_list['l_name'];
$dob=$applicant_basic_details_list['dob'];
//$dob = date('d/m/Y',strtotime($dob));
$dob=isset($dob)? date('d/m/Y',strtotime($dob)):'';
$mobile_no=$applicant_basic_details_list['mob_no'];
$sec_mob_no=$applicant_basic_details_list['sec_mob_no'];
$sec_e_mail=$applicant_basic_details_list['sec_e_mail'];
$add_line_1=$applicant_address_details_list['add_line_1'];
$add_line_2=$applicant_address_details_list['add_line_2'];
$pin_code=$applicant_address_details_list['pin_code'];
$email_id = $applicant_basic_details_list['e_mail'];
$is_work_experience = $applicant_other_details_list['is_work_experience'];
$is_work_experience_label=($is_work_experience =='t' ) ? 'Yes' :( $is_work_experience=='f' ? 'No ' : 'Select Status - Yes or No');
$workExpStyle="display:none";
if($is_work_experience=='t'){
    $workExpStyle="";
}

$name_in_marksheet = $applicant_basic_details_list['name_in_marksheet'];
$digilocker_id = $applicant_basic_details_list['digilocker_id'];
$title_name = !empty($applicant_basic_details_list['tittle_name']) ? $applicant_basic_details_list['tittle_name'] : 'Select';
$mob_country_code_name = !empty($applicant_basic_details_list['applicant_mob_country_code_name']) ? $applicant_basic_details_list['applicant_mob_country_code_name'] : 'Select';
$gender_name = !empty($applicant_basic_details_list['gender']) ? $applicant_basic_details_list['gender'] : 'Select';
$blood_grp_name = !empty($applicant_basic_details_list['blood_group']) ? $applicant_basic_details_list['blood_group'] : 'Select';
$religion_name = !empty($applicant_basic_details_list['religion_name']) ? $applicant_basic_details_list['religion_name'] : 'Select';
$mothertongue_name = !empty($applicant_basic_details_list['mothertongue_name']) ? $applicant_basic_details_list['mothertongue_name'] : 'Select';
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
   
    $country_id = $applicant_address_details_list['country_id'];
    $country_name = $applicant_address_details_list['country_name'];
    $state_id = $applicant_address_details_list['state_id'];
    $state_name = $applicant_address_details_list['state_name'];
    $district_id = $applicant_address_details_list['district_id'];
    $district_name = $applicant_address_details_list['district_name'];
    $city_id = $applicant_address_details_list['city_id'];
    $city_name = $applicant_address_details_list['city_name'];
}
$country_id=isset($country_id) ?$country_id:'';
$country_name=isset($country_name) ?$country_name : 'Select Country';
$state_name=isset($state_name) ?$state_name : 'Select State';
$district_name=isset($district_name) ?$district_name : 'Select District';
$city_name=isset($city_name) ?$city_name : 'Select City';
//End address


//$total_work_exp = $applicant_other_details_list['total_work_exp'];

$research_area = $applicant_coordinator_list['research_area'];
$coord_name = $applicant_coordinator_list['coord_name'];

$applicant_publn_det_id = $applicant_publn_det_title = $applicant_publn_det_journal_conf_name = $applicant_publn_det_year = $applicant_prof_exp_id = $applicant_prof_exp_org_name = $applicant_prof_exp_designation = $applicant_prof_exp_job_nature = $applicant_prof_exp_salary = $applicant_prof_exp_from_date = $applicant_prof_exp_to_date = $applicant_prof_exp_work_exp_in_months = $applicant_grad_det_id = $applicant_grad_det_other_degree_name = $applicant_grad_det_univ_id = $applicant_grad_det_univ_name = $applicant_grad_det_mark_scheme_id = $applicant_grad_det_mark_percent = $applicant_grad_det_completion_year = $applicant_grad_det_reg_no = $applicant_grad_det_insti_name = $applicant_campus_campus_name = $applicant_grad_det_mode_of_study_name = $applicant_grad_det_mode_of_study_id = array();

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
         $applicant_grad_det_mode_of_study_id[] = $v['mode_of_study_id'];
         $applicant_grad_det_mode_of_study_name[] = $v['mode_of_study'];
         
           
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
$app_form_id_mtech = APP_FORM_ID_MTECH_RESEARCH;
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

$campus_1 = isset($applicant_campus_campus_name[0]) ? $applicant_campus_campus_name[0] : 'Select Campus Preference 1';
$campus_2 = isset($applicant_campus_campus_name[1]) ? $applicant_campus_campus_name[1] : 'Select Campus Preference 2';
$campus_3 = isset($applicant_campus_campus_name[2]) ? $applicant_campus_campus_name[2] : 'Select Campus Preference 3';

$course_1 = isset($applicant_course_spec_name[0]) ? $applicant_course_spec_name[0] : 'Select Course Preference 1';
$course_2 = isset($applicant_course_spec_name[1]) ? $applicant_course_spec_name[1] : 'Select Course Preference 2';
$course_3 = isset($applicant_course_spec_name[2]) ? $applicant_course_spec_name[2] : 'Select Course Preference 3';


$parent_name = $applicant_basic_details_list['parent_name'];


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


$applicant_name = $applicant_appln_details_list[0]['applicant_name_declaration'];
$applicant_name = ($applicant_name)?$applicant_name:$first_name;

//print_r($applicant_appln_details_list);die;
$parents_name = $applicant_appln_details_list[0]['applicant_parentname_declaration'];
$parent_name = (($parents_name)?$parents_name:(($father_name)?$father_name:(($mother_name)?$mother_name:(($guardian_name)?$guardian_name:''))));

$declaration_date = $applicant_appln_details_list['applicant_declaration_date'];
$declaration_date = ($declaration_date)?date('d/m/Y',strtotime($declaration_date)):date('d/m/Y');

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
$url = base_url().'mtechresearch-jan?startIndex='.$startIndex;
if($mode_edit == ADMIN_MODE_EDIT)
{
  $url = base_url().'mtechresearch-jan/'.$mode_edit.'/'.$crm_applicant_login_id.'/'.$crm_applicant_personal_det_id.'?startIndex='.$startIndex;;
}
/*CRM ADMIN Edit form start*/

?>
<div class="col-md-1 ml-2">
<a href="<?php echo $url;?>" class="btn btn-primary active w-100 mt-3" role="button" aria-pressed="true">Back</a>
</div>
<div class="disable_div_preview" id="mtechresearch_jan_form">
<div class="row">
   <div class="col-sm-12">
      <div class="" id="MtechsearchjanPreviewToPrint">
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
                              <div class="col-md-6">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Graduation from India?<span class="tx-danger">*</span></label>
                                    <select class="form-control custom-select nationality" 
                                    id="graduation_india" name="graduation_india" data-parsley-required="true" data-parsley-required-message="Please Choose Graduation" >
                                        <option value=""><?php echo $studied_from_india_name;?></option>                            
                                    </select>
                                    <span id="custom-spec_qualifying_degree-parsley-error"></span>
                                 </div>
                              </div>                              
                           </div>
                           
                            <div class="row w-100">
                              <div class="col-sm-12">
                                <?php if($qualifyexamfromindia == 't') { ?>
                                <div class="form-group" id="confirm_indian">
                                    <p>
                                        Please note that you have selected "YES" for the
                                        above which implies you are eligible to seek
                                        admission under domestic category. It is the
                                        sole responsibility of the candidate to ensure
                                        that he/she is applying under the right
                                        category.</p>
                                    <div class="custom-control custom-checkbox">
                                      <input class="custom-control-input" type="checkbox" name="qualifyingexamfromindia" id="qualifyingexamfromindia" value="<?php echo ($qualifyexamfromindia == 't')?1:0; ?>"  data-parsley-required="true" data-parsley-required-message="Required" <?php echo ($qualifyexamfromindia == 't')?'checked':0; ?>><label class="custom-control-label" for="qualifyingexamfromindia"> I Confirm </label>
                                    </div>
                                    <span id="custom-qualifyingexamfromindia-parsley-error"></span>
                                </div>
                              <?php } if($qualifyexamfromindia == 'f') { ?>       
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
                            <h5 class="text-primary mb-3 ml-2">Campus and Specialization Preference</h5>
                          </div>
                          <div class="row w-100">
                            <div class="col-lg-6">
                              <div class="form-group mg-b-10-force">
                                  <label class="form-control-label">Campus Preference 1
                                      <span class="tx-danger">*</span></label>
                                  <select class="form-control"
                                      id="campus_preference1" name="campus_preference1" data-parsley-required="true" data-parsley-required-message="Please Select Campus Preference1" data-parsley-errors-container="#custom-campus_preference1-error" data-parsley-trigger="change">
                                      <option value=""><?php echo $campus_1 ;?></option>
                                  </select>
                                  <span id="custom-campus_preference1-error"></span>
                              </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group mg-b-10-force" id="speciali_prefer1_div">
                                    <label class="form-control-label">Specialization Preference 1
                                        <span class="tx-danger">*</span></label>
                                    <select class="form-control"
                                        id="specialization_preference1" name="specialization_preference1" data-parsley-required="true" data-parsley-required-message="Please Select Specialization Preference1" data-parsley-errors-container="#custom-specialization_preference1-error" data-parsley-trigger="change">
                                        <option value=""><?php echo $course_1;?></option>
                                    </select>
                                    <span id="custom-specialization_preference1-error"></span>
                                </div>
                            </div>
                          </div>
                          <div class="row w-100">
                            <div class="col-lg-6">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Campus Preference 2</label>
                                    <select class="form-control"
                                        id="campus_preference2" name="campus_preference2">
                                        <option value=""><?php echo $campus_2 ;?></option>                  
                                    </select>
                                    <span id="custom-campus_preference2-error"></span>
                                </div>                                
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group mg-b-10-force" id="speciali_prefer2_div">
                                    <label class="form-control-label">Specialization Preference 2</label>
                                    <select class="form-control"
                                        id="specialization_preference2" name="specialization_preference2">
                                        <option value=""><?php echo $course_2;?></option> 
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                          </div>
                          <div class="row w-100">
                            <div class="col-lg-6">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Campus Preference 3</label>
                                    <select class="form-control"
                                        id="campus_preference3" name="campus_preference3">
                                        <option value=""><?php echo $campus_3 ;?></option>                  
                                    </select>
                                </div>                               
                            </div><!-- col-4 -->
                            <div class="col-lg-6">
                                <div class="form-group mg-b-10-force" id="speciali_prefer3_div">
                                    <label class="form-control-label">Specialization Preference 3</label>
                                    <select class="form-control select2"
                                        id="specialization_preference3" name="specialization_preference3">
                                        <option value=""><?php echo $course_3;?></option>
                                    </select>
                                </div>                                
                            </div><!-- col-4 -->
                          </div><!-- row -->
                           <div class="row w-100">
                              <div class="col-md-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Title<span class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="title_id" id="title_id" data-parsley-required="true" data-parsley-required-message="Please Choose Title" data-parsley-errors-container="#custom-title-id-parsley-error">
                                        <option label="Choose Title" value=""><?php echo $title_name;?></option>
                                    </select>
                                    <span id="custom-title-id-parsley-error"></span>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label">FirstName <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Enter FirstName" maxlength="100" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter First Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 100]" value="<?php echo $first_name;?>">
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label">Middle Name </label>
                                    <input class="form-control" type="text" name="middle_name" id="middle_name" placeholder="Enter MiddleName" value="<?php echo $middle_name;?>">
                                 </div>
                              </div>
                              <!-- col-4 -->
                           </div>
                           <div class="row w-100">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label">LastName <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Enter LastName" maxlength="50" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Last Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" value="<?php echo $last_name;?>">
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4">
                                  <label class="form-control-label">Mobile NO <span class="tx-danger">*</span></label>
                                  <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                      <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                          <select class="form-control form_control Mobile_number" id="phone_no_code" name="phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                              <option value=""><?php echo $mob_country_code_name; ?></option>
                                          </select>
                                      </span>
                                      <input id="mtech_mobile_no" type="text"  data-placeholder="Enter Mobile No" name="mtech_mobile_no"
                                          class="form-control" maxlength="10" onkeypress="return isNumber(event);" 
                                          pattern="[0-9]*" data-parsley-required="true" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-errors-container="#custom-mtech_mobile_no-parsley-error" value="<?php echo $mobile_no;?>">                      
                                  </div>
                                  <span id="custom-mtech_mobile_no-parsley-error"></span>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label">Email ID <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="email_id" id="email_id" value="<?php echo $email_id;?>" placeholder="Enter email address" readonly="readonly">
                                 </div>
                              </div>
                           </div>
                           <div class="row w-100">
                              <div class="col-md-4">
                                 <div class="wd-200 w-100">
                                    <label class="form-control-label">Date of Birth <span class="tx-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                        <input  type="text" class="form-control hasDatepicker" placeholder="DD/MM/YYYY" name="dob" id="dob" data-parsley-required="true" data-parsley-required-message="Date Of Birth" data-parsley-errors-container="#custom-dob-parsley-error" value="<?php echo $dob;?>">                      
                                    </div>
                                    <span id="custom-dob-parsley-error"></span>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Gender <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Gender" tabindex="-1" aria-hidden="true" data-parsley-required="true" data-parsley-required-message="Please Choose Gender" data-parsley-errors-container="#custom-gender_id-parsley-error" name="gender_id" id="gender_id">
                                        <option label="Choose Gender"><?php echo $gender_name;?></option>                     
                                    </select>
                                    <span id="custom-gender_id-parsley-error"></span>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label">Alternate Email ID</label>
                                    <input class="form-control" type="text" name="second_email_id" id="second_email_id" placeholder="Enter email address" value="<?php echo $sec_e_mail;?>">
                                 </div>
                              </div>
                           </div>
                           <div class="row w-100">
                              <div class="col-md-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Blood Group</label>
                                    <select class="form-control select2" data-placeholder="Choose Blood Group" tabindex="-1" aria-hidden="true"  name="blood_grp_id" id="blood_grp_id">
                                        <option label="Choose Blood Group"><?php echo $blood_grp_name;?></option>
                                    </select>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-lg-4">
                                  <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Religion <span class="tx-danger">*</span></label>
                                      <select class="form-control select2" data-placeholder="Choose Religion" tabindex="-1" aria-hidden="true" name="religion_id" id="religion_id" data-parsley-required="true" data-parsley-required-message="Please Choose Religion" data-parsley-errors-container="#custom-religion_id-parsley-error">
                                          <option label="Choose Religion"><?php echo $religion_name;?></option>                      
                                      </select>
                                      <span id="custom-religion_id-parsley-error"></span>
                                  </div>
                              </div><!-- col-4 -->
                              <div class="col-lg-4">
                                  <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Mother Tongue</label>
                                      <select class="form-control select2" data-placeholder="Choose Mother Tongue" tabindex="-1" aria-hidden="true" name="mothertongue_id" id="mothertongue_id">
                                          <option label="Choose Mother Tongue"><?php echo $mothertongue_name;?></option>
                                      </select>
                                  </div>
                              </div><!-- col-4 -->
                            </div>
                            <div class="row w-100">
                              <div class="col-lg-4">
                                  <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Medium of Instruction <span class="tx-danger">*</span></label>
                                      <select class="form-control select2" data-placeholder="Choose Medium of Instruction" tabindex="-1" aria-hidden="true" name="medofinst" id="medofinst" title="Choose Medium of Instruction" data-parsley-required="true" data-parsley-required-message="Please Choose Medium of Instruction" data-parsley-errors-container="#custom-medium_of_instruction-parsley-error" data-parsley-trigger="change">
                                          <option value=""><?php echo $medium_of_study_name;?></option>
                                      </select>
                                     <span id="custom-medium_of_instruction-parsley-error"></span>
                                  </div>
                              </div><!-- col-4 -->
                              <div class="col-lg-4">
                                  <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Hostel Accommodation</label>
                                      <select class="form-control select2" data-placeholder="Choose Hostel Accommodation" tabindex="-1" aria-hidden="true" name="prefer_hostel" id="prefer_hostel" title="Choose Hostel Accommodation">
                                          <option value=""><?php echo $hostel_accommodation_select_name;?></option>
                                      </select>
                                  </div>
                              </div><!-- col-4 -->
                              <div class="col-lg-4">
                                  <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Are you a differently Abled? <span class="tx-danger">*</span></label>
                                      <select class="form-control select2" data-placeholder="Choose Differently Abled" tabindex="-1" aria-hidden="true" name="diff_abled" id="diff_abled" title="Choose Differently Abled" data-parsley-required="true" data-parsley-required-message="Please Choose Differently Abled" data-parsley-errors-container="#custom-diff_abled-parsley-error" data-parsley-trigger="change">
                                          <option value=""><?php echo $diff_abled_select_name;?></option>
                                      </select>
                                      <span id="custom-diff_abled-parsley-error"></span>
                                  </div>
                              </div><!-- col-4 -->
                            </div>
                            <div class="row w-100">
                              <div class="col-lg-4">
                                  <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Where do you see admission advertisment?</label>
                                      <select class="form-control select2" data-placeholder="Choose Advertisement Source" tabindex="-1" aria-hidden="true" name="advertisement_source_id" id="advertisement_source_id" title="Choose Advertisement Source">
                                          <option value=""><?php echo $source_name;?></option>
                                      </select>
                                  </div>
                              </div><!-- col-4 -->
                              <div class="col-lg-4">
                                  <div class="form-group mg-b-10-force">
                                      <label class="form-control-label">Nationality <span class="tx-danger">*</span></label>
                                      <select class="form-control nationality" name="nationality_id" id="nationality_id" title="Choose Nationality"data-parsley-validate-if-empty="true" data-parsley-errors-container="#custom-nationality_id-parsley-error" data-parsley-btech-basic-check="studied_from_india,<?php echo COUNTRY_VALUE_DEFAULT; ?>,no,1" da
                                        ta-parsley-trigger="change" data-parsley-required="true" data-parsley-required-message="Please Choose Nationality">
                                          <option value=""><?php echo $nationality;?></option>
                                      </select>
                                  </div>
                                  <span id="custom-nationality_id-parsley-error"></span>
                              </div><!-- col-4 -->
                              <?php if($nation_id==COUNTRY_VALUE_DEFAULT) 
                                        {
                                        ?>
                              <div class="col-lg-4" id="main_div_community">
                                  <div class="form-group mg-b-10-force" id="Community">
                                      <label class="form-control-label">Community <span class="tx-danger">*</span></label>
                                      <select class="form-control select2" data-placeholder="Choose Community" tabindex="-1" aria-hidden="true" name="pd_social_status" id="pd_social_status" title="Choose Community" data-parsley-required="false" data-parsley-required-message="Please Choose Community" data-parsley-errors-container="#custom-pd_social_status-parsley-error" data-parsley-trigger="change">
                                          <option value=""><?php echo $social_status;?></option>
                                      </select>
                                      <span id="custom-pd_social_status-parsley-error"></span>
                                  </div>
                              </div><!-- col-4 -->
                            <?php } ?>
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
                              <h5 class="text-primary mb-3 ml-2">Father's Details</h5>
                          </div>
                          <div class="row w-100">
                            <div class="col-lg-4">
                              <div class="form-group mg-b-10-force">
                                  <label class="form-control-label">Title
                                   <span class="tx-danger">*</span></label>
                                  <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_father_title" id="pd_father_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="Please Choose Title" data-parsley-errors-container="#custom-pd_father_title-parsley-error" data-parsley-trigger="change">
                                    <option value=""><?php echo $father_title_name;?></option>
                                  </select>
                                  <span id="custom-pd_father_title-parsley-error"></span>
                              </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                              <div class="form-group">
                                  <label class="form-control-label">Father's Name
                                   <span class="tx-danger">*</span></label>
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
                            <!-- <div class="col-lg-4" id="father_alt_mbleno_div" style="display:none;">
                              <label class="form-control-label">Father's Alternate Mobile Number</label>
                              <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                  <select class="form-control form_control custom-select Mobile_number" id="pd_father_alt_phone_no_code" name="pd_father_alt_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                    <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                                  </select>
                                </span>
                                <input type="text" class="form-control" name="pd_father_alt_phone" id="pd_father_alt_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Alternate Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_father_alt_phone-parsley-error" value="<?php echo $applicant_parent_alt_mobile_no[$parent_type_id_father]; ?>">
                              </div>
                              <span id="custom-pd_father_alt_phone-parsley-error"></span>
                            </div> -->
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
                                  <div id="father_other_occupation_div" class="form-group">
                                    <input class="form-control" type="text" name="pd_father_other_occupation" id="pd_father_other_occupation"  placeholder="If Other, please enter here..."data-parsley-required="false"   data-parsley-errors-container="#custom-pd_father_other_occupation-parsley-error" value="<?php echo $father_other_occupation;?>">
                                    <span id="custom-pd_father_other_occupation-parsley-error">
                                    </span>
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
                                  <label class="form-control-label">Title 
                                    <span class="tx-danger">*</span></label>
                                  <select class="form-control select2" name="pd_mother_title" id="pd_mother_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="Please Choose Title" data-parsley-errors-container="#custom-pd_mother_title-parsley-error" data-parsley-trigger="change">
                                    <option value=""><?php echo $mother_title_name;?></option>
                                  </select>
                                  <span id="custom-pd_mother_title-parsley-error"></span>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                  <label class="form-control-label">Mother's Name 
                                    <span class="tx-danger">*</span></label>
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
                            <!-- <div class="col-lg-4" id="mother_alt_mbleno_div" style="display:none;">
                                <label class="form-control-label">Mother's Alternative Mobile Number</label>
                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                  <select class="form-control form_control custom-select Mobile_number" id="pd_mother_alt_phone_no_code" name="pd_mother_alt_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                    <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                                  </select>
                                </span>
                                <input type="text" class="form-control" name="pd_mother_alt_phone" id="pd_mother_alt_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_mother_alt_phone-parsley-error" value="<?php echo $applicant_parent_alt_mobile_no[$parent_type_id_mother]; ?>">
                                <span id="custom-pd_mother_alt_phone-parsley-error"></span>
                                </div>
                            </div> -->
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
                                <?php if ($mother_occupation_id==OTHER_OCCUPATION) { ?>
                                <div id="mother_other_occupation_div"  class="form-group">
                                  <input class="form-control" type="text" name="pd_mother_other_occupation" id="pd_mother_other_occupation"  placeholder="If Other, please enter here..." data-parsley-required="false"   data-parsley-errors-container="#custom-pd_mother_other_occupation-parsley-error" value="<?php echo $mother_other_occupation;?>">
                                  <span id="custom-pd_mother_other_occupation-parsley-error"></span>
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
                                        <label class="form-control-label">Guardian's Name</label>
                                        <input class="form-control" type="text" name="pd_guardian_name" id="pd_guardian_name" placeholder="Enter Your Guardian Name" maxlength="50" data-parsley-required="true" data-parsley-required-message="Please Enter Your Guardian Name" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" value="<?php echo $guardian_name; ?>">
                                        <input type="hidden" name="pd_guardian_id" id="pd_guardian_id" value="<?php echo $app_parent_det_id[$parent_type_id_guardian]; ?>" />
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
                                      <div class="form-group mg-b-10-force">
                                          <label class="form-control-label">Guardian's Occupation</label>
                                          <select class="form-control select2" data-placeholder="Choose Guardian Occupation" tabindex="-1" aria-hidden="true" name="pd_guardian_occupation" id="pd_guardian_occupation">
                                            <option value=""><?php echo $guardian_occupation;?></option>
                                          </select>
                                      </div>
                                      <?php if($guardian_occupation_id==OTHER_OCCUPATION) { ?>
                                      <div id="guardian_other_occupation_div" class="form-group">
                                        <input class="form-control" type="text" name="guardian_other_occupation" id="guardian_other_occupation"  placeholder="If Other, please enter here..."data-parsley-required="false"   data-parsley-errors-container="#custom-guardian_other_occupation-parsley-error" value="<?php echo $guardian_other_occupation;?>">
                                        <span id="custom-guardian_other_occupation-parsley-error"></span>
                                    </div>
                                    <?php } ?>
                                  </div><!-- col-4 -->
                              </div><!-- row -->
                              <?php } ?>
                            </div>
                          </div>
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
                        <section class="row">
                          <div class="row w-100"> 
                              <div class="col-lg-6 ">
                                <p>Only the applicants who have completed Graduation are eligible to apply</p>  
                                  <div class="form-group wd-xs-300 mr-5 w-100">
                                      <label class="form-control-label">Candidate Name as in 10th
                                          Certificate
                                          <span class="tx-danger">*</span></label>
                                      <div class="form-group mg-b-10-force">
                                          <input class="form-control" type="text" name="name_as_in_marksheet"
                                              placeholder="Enter Name" id="name_as_in_marksheet" data-parsley-required="true" data-parsley-required-message="Please enter name" data-parsley-maxlength="50" maxlength="50" value="<?php echo $name_in_marksheet; ?>">
                                          <small id="emailHelp"
                                              class="form-text text-muted">Kindly type "NA" in
                                              case 10th Certificate is not available with
                                              you.</small>
                                      </div>
                                  </div><!-- form-group -->
                              </div>
                          </div>
                          <div class="row w-100 ml-2">
                            <h5>Academic Background (Start with latest Degree Obtained)</h5>
                          </div>
                          <div class="table-responsive">
                            <table class="table table-bordered mt-3" id="table4">
                              <thead class="thead-light">
                                  <tr>
                                      <th></th>
                                      <th> Institute</th>
                                      <th> University </th>
                                      <th> Mode of Study </th>
                                      <th> Marking Scheme </th>
                                      <th> Obtained Percentage/CGPA </th>
                                      <th style="width:100px;"> Year of Passing </th>
                                      <th class="reg_width"> Roll No / Registration No</th>

                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>
                                          <p>UG</p>
                                      </td>
                                      <td>
                                            <input class="form-control" type="hidden" placeholder="" id="grad_id_1" name="grad_id_1" value="<?php echo $applicant_grad_det_id[0]; ?>">
                                          <input class="form-control" type="text" name="institute_name" id="institute_name" data-parsley-required="true" data-parsley-required-message="Please enter institute name" data-parsley-maxlength="100" maxlength="100" data-parsley-errors-container="#custom-institute-name-parsley-error" value="<?php echo $applicant_grad_det_insti_name[0];?>">
                                          <span id="custom-institute-name-parsley-error"></span>
                                      </td>
                                      <td>
                                          <div class="form-group mg-b-10-force">
                                              <select class="form-control custom-select" id="university_id" name="university_id" data-parsley-required="true" data-parsley-required-message="Please select university" data-parsley-errors-container="#custom-university-id-parsley-error" data-parsley-trigger="change">
                                                <option value=""><?php echo $applicant_grad_det_univ_name[0];?></option>
                                          </div>
                                          <span id="custom-university-id-parsley-error"></span>
                                      </td>
                                      <td>
                                          <div class="form-group mg-b-10-force">
                                              <select class="form-control custom-select"
                                                  id="mode_of_study" name="mode_of_study" data-parsley-required="true" data-parsley-required-message="Please select mode of study" data-parsley-errors-container="#custom-mode-study-parsley-error" data-parsley-trigger="change">
                                                  <option value=""><?php echo $applicant_grad_det_mode_of_study_name[0];?></option>
                                              </select>
                                          </div>
                                          <span id="custom-mode-study-parsley-error"></span>
                                      </td>
                                      <td>
                                          <div class="form-group mg-b-10-force" id="Appering_info_1">
                                              <select class="form-control custom-select" id="user_marking_scheme_1" name="user_marking_scheme_1" data-parsley-required="true"  data-parsley-required-message="Please select marking schema" data-parsley-errors-container="#custom-marking-schema-error" data-parsley-trigger="change">
                                                <option value=""><?php echo $applicant_grad_det_mark_scheme[0];?></option>
                                              </select>                                              
                                          </div>
                                          <span id="custom-marking-schema-error"></span>
                                      </td>
                                      <td>
                                          <input class="form-control" type="text" placeholder="" id="obtained_percentage_cgpa_1" name="obtained_percentage_cgpa_1" maxlength="10" value="<?php echo $applicant_grad_det_mark_percent[0]; ?>" data-parsley-required="true"  data-parsley-required-message="Please enter percentage" data-parsley-errors-container="#custom-obtained-percen-error">
                                          <span id="custom-obtained-percen-error"></span>
                                      </td>
                                      <td style="width:100px;">
                                          <input class="form-control" type="text" placeholder="YYYY" id="year_of_passing_1" name="year_of_passing_1" maxlength="4" value="<?php echo $applicant_grad_det_completion_year[0]; ?>" data-parsley-required="true" data-parsley-required-message="Please select year" data-parsley-errors-container="#custom-year-passing-error">
                                          <span id="custom-year-passing-error"></span>
                                      </td>
                                      <td class="reg_width">
                                          <input class="form-control" id="register_no" type="text" name="register_no" data-parsley-required="true" data-parsley-required-message="Please enter register no" maxlength="80" data-parsley-errors-container="#custom-register-no-error" value="<?php echo $applicant_grad_det_reg_no[0]; ?>">
                                          <span id="custom-register-no-error"></span>
                                      </td>
                                  </tr>
                              </tbody>
                            </table>
                          </div>
                           
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
                                      <select class="form-control custom-select study" id="is_work_experience" name="is_work_experience" data-parsley-required="true" data-parsley-required-message="Please select the Work Experience" data-parsley-errors-container="#custom-is_work_experience-parsley-error" data-parsley-trigger="change">
                                          <option value=""><?php echo $is_work_experience_label;?></option>
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
                                        <input class="form-control" type="text" name="digilocker_id"
                                            placeholder="Enter NAD ID / Digilocker ID " id="digilocker_id" value="<?php echo $digilocker_id; ?>">
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
                           <div class="row" id="emp_exp" style="<?php echo $workExpStyle;?>">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label class="control-label" for="radios">Professional Experience (Start from the present employer)</label>
                                    <div class="table-responsive pretbl">
                                       <table class="table table-bordered mt-0" id="table5" style="display: table !important; ">
                                          <thead class="thead-light">
                                             <tr>
                                                 <th>&nbsp;</th>
                                                 <th>Organisation's Name</th>
                                                 <th>Position Held</th> 
                                                 <th>From Year</th>
                                                 <th>To Year</th>
                                                 <th>Total Experience</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td nowrap="">1.</td>
                                                <td>
                                                   <input class="form-control" type="hidden" placeholder="" id="prof_exp_id_0" name="prof_exp_id_0" value="<?php echo $applicant_prof_exp_id[0]; ?>">
                                                   <div class="form-group"><input type="text" name="organisation_name_0" id="organisation_name_0" class="form-control" placeholder="" maxlength="100"data-parsley-required="false" data-parsley-required-message="Please enter the organisation name" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_org_name[0]; ?>"></div>
                                                   <span class="tx-danger required_asterisk">*</span>
                                                </td>
                                                <td>
                                                   <div class="form-group"><input type="text" name="designation_0" id="designation_0" class="form-control" placeholder="" maxlength="100" data-parsley-required="false" data-parsley-required-message="Please enter the designation" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_designation[0]; ?>"></div>
                                                   <span class="tx-danger required_asterisk">*</span>
                                                </td>
                                                <td>
                                                   <div class="form-group"><input readonly="" type="text" name="from_year_0" id="from_year_0" class="form-control datepicker" placeholder="MM/YYYY" maxlength="7" data-parsley-required="false" data-parsley-required-message="Please enter the from year" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_from_date[0]; ?>"></div>
                                                   <span class="tx-danger required_asterisk">*</span>
                                                </td>
                                                <td>
                                                   <div class="form-group"><input readonly="" type="text" name="to_year_0" id="to_year_0" class="form-control datepicker" placeholder="MM/YYYY" maxlength="7" data-parsley-required="false" data-parsley-required-message="Please enter the to year" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_to_date[0]; ?>"></div>
                                                   <span class="tx-danger required_asterisk">*</span>
                                                </td>
                                                <td>
                                                   <div class="form-group"><input type="text" name="work_experience_0" id="work_experience_0" class="form-control" placeholder="" maxlength="5" data-parsley-required="false" data-parsley-required-message="Please enter the work experience" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_work_exp[0]; ?>"></div>
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
                                                   <div class="form-group"><input readonly="" type="text" name="from_year_1" id="from_year_1" class="form-control datepicker" placeholder="MM/YYYY" maxlength="7" value="<?php echo $applicant_prof_exp_from_date[1]; ?>"></div>
                                                </td>
                                                <td>
                                                   <div class="form-group"><input readonly="" type="text" name="to_year_1" id="to_year_1" class="form-control datepicker" placeholder="MM/YYYY" maxlength="7" value="<?php echo $applicant_prof_exp_to_date[1]; ?>"></div>
                                                </td>
                                                <td>
                                                   <div class="form-group"><input type="text" name="work_experience_1" id="work_experience_1" class="form-control" placeholder="" readonly="readonly" maxlength="5" value="<?php echo $applicant_prof_exp_work_exp[1]; ?>"></div>
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
                                                   <div class="form-group"><input readonly="" type="text" name="from_year_2" id="from_year_2" class="form-control datepicker" placeholder="MM/YYYY" maxlength="7" value="<?php echo $applicant_prof_exp_from_date[2]; ?>"></div>
                                                </td>
                                                <td>
                                                   <div class="form-group"><input readonly="" type="text" name="to_year_2" id="to_year_2" class="form-control datepicker" placeholder="MM/YYYY" maxlength="7" value="<?php echo $applicant_prof_exp_to_date[2]; ?>"></div>
                                                </td>
                                                <td>
                                                   <div class="form-group"><input type="text" name="work_experience_2" id="work_experience_2" class="form-control" placeholder="" readonly="readonly" maxlength="5" value="<?php echo $applicant_prof_exp_work_exp[2]; ?>"></div>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row w-100" id="emp_total_exp" style="<?php echo $workExpStyle;?>">
                              <div class="col-md-3 blank_space">
                                 <div class="form-group">&nbsp;</div>
                              </div>
                              <div class="col-md-3 blank_space">
                                 <div class="form-group">&nbsp;</div>
                              </div>
                              <div class="col-md-3 blank_space">
                                 <div class="form-group">&nbsp;</div>
                              </div>
                              <div class="col-md-3" style="display: block;">
                                 <div class="form-group">
                                    <label class=" control-label" for="radios">Total Work Experience in Months</label>
                                    <input type="text" name="total_work_experience" id="total_work_experience" class="form-control" placeholder="Total Work Experience"  maxlength="5" value="<?php echo $applicant_prof_exp_work_exp_in_months[0]; ?>">
                                 </div>
                              </div>
                           </div>
                          </div>
                           
                          <div class="row w-100 ml-1">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <h5 class="text-primary mb-4"></h5>
                                    <label class="form-control-label">Broad area of research
                                      <span class="tx-danger">*</span></label>
                                    <input type="text" name="board_research" id="board_research" class="form-control" data-parsley-required="true" data-parsley-required-message="Please enter board area" maxlength="80" data-parsley-errors-container="#custom-board-area-error" value="<?php echo $research_area;?>">
                                </div>
                                <span id="custom-board-area-error"></span>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <h5 class="text-primary mb-4"></h5>
                                    <label class="form-control-label">Name of proposed Supervisor (if identified)
                                      <!-- <span class="tx-danger">*</span> --></label>
                                    <input type="text" name="name_proposed" id="name_proposed" class="form-control" value="<?php echo $coord_name;?>">
                                </div>
                            </div>
                          </div>
                           
                           <!-- <div class="w-100 mt-5">
                              <div class="Payment_align">
                                 <a href="#" class="btn btn-primary active float-right" role="button" aria-pressed="true">MAKE PAYMENT</a>
                              </div>
                           </div> -->
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
                        <section class="row">
                           <div class="row w-100">
                              <div class="col-lg-6 mb-3">
                                 <div class="card mb-3 base_details_card">
                                    <div class="card-body">
                                      <?php $applicant_mob_country_code_name = $applicant_basic_details_list['applicant_mob_country_code_name']; ?>
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
                  <input class="form-control" type="text" name="DDDate" id="DDDate" placeholder="DD Date" data-parsley-required="true" data-parsley-required-message="Choose DD Date" value="<?php echo $dd_cheque_date; ?>" autocomplete="off">
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
                                             <input type="file" class="filestyle" name="photograph" id="photograph" data-parsley-required="<?php echo ((isset($docs[$document_id_photograph]))?'false':'true'); ?>" data-required="true" data-parsley-required-message="Please upload photograph" data-parsley-errors-container="#custom-photograph-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
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

                                             <input type="file" class="filestyle" name="signature" id="signature" data-parsley-required="<?php echo ((isset($docs[$document_id_signature]))?'false':'true'); ?>" data-required="true" data-parsley-required-message="Please upload signature" data-parsley-errors-container="#custom-signature-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>"  data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>"   accept="<?php  echo allow_extension($file_allowed_type); ?>">
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

                                           <input type="file" class="filestyle" name="graduation_marksheet" id="graduation_marksheet" data-parsley-required="false" data-parsley-required-message="Please upload your graduation marksheet" data-parsley-errors-container="#custom-graduation_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_500_KB; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_500_KB_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_graduation_marksheet])){ echo $docs[$document_id_graduation_marksheet]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
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
                                  </div>
                                 </div>
                                 <!-- row -->
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
                                        <label class="form-control-label">Applicant Name <span class="tx-danger">*</span></label>
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
               <!-- Geetha -->
            </div>
         </div>
      </div>
   </div>
</div>
</div>