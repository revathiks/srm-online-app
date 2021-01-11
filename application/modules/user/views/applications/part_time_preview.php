<?php
/*  echo "<pre>";
print_r($applicant_schooling_list);
echo "</pre>";  */ 
$today=date('d/m/Y');
$qualifyingexamfromindia = isset($applicant_application_details_list[0]['qualifyingexamfromindia']) ? $applicant_application_details_list[0]['qualifyingexamfromindia'] : '';
if($qualifyingexamfromindia=='f'){
    $qualifyingexamfromindia_val= 'Select Status Yes or No';
}else{
    if($qualifyingexamfromindia=='t'){
        $qualifyingexamfromindia_val = 'Yes';
    }else{
        $qualifyingexamfromindia_val = 'No';
    }
}
//program level
if(!empty($applicant_application_details_list))
{
    $applicant_appln_id=$applicant_application_details_list[0]['applicant_appln_id'];
    $grad_id=$applicant_application_details_list[0]['grad_id'];
    $grad_name=$applicant_application_details_list[0]['grad_name'];
    $qual_status_id=$applicant_application_details_list[0]['qual_status_id'];
    $qual_status_name=$applicant_application_details_list[0]['qual_status_name'];
    
}
$grad_id=!empty($grad_id) ? $grad_id :'';
$grad_name=!empty($grad_name) ? $grad_name :'Select Program Level';
$qual_status_id=!empty($qual_status_id) ? $qual_status_id :'';
$qual_status_name=!empty($qual_status_name) ? $qual_status_name :'Select Your Current Qualification Status';

//fetch course
//fetch course dropdown

if($applicant_course_details_list) {
    foreach($applicant_course_details_list as $k=>$v) {
        if($v['choice_no']==1){
            $course_1=$v['deg_short_name'];
            $specialization_1=$v['course_name'];
        }
    }
}
$course_1 = isset($course_1) ? $course_1 : 'Select Course';
$specialization_1 = isset($specialization_1) ? $specialization_1 : 'Select Specialization';

//end fetch course dropdown

//campus fetch
if($applicant_campus_details_list) {
    foreach($applicant_campus_details_list as $k=>$v) {
        if($v['choice_no']==1){           
            $campus_1=$v['campus_name'];
        }
    }
}
$campus_1 = isset($campus_1) ? $campus_1 : 'Select Campus';
//end campus fetch

//set personal detail
$tittle_name = !empty($applicant_basic_details_list['tittle_name']) ? $applicant_basic_details_list['tittle_name'] : 'Select';
$blood_group = !empty($applicant_basic_details_list['blood_group']) ? $applicant_basic_details_list['blood_group'] : 'Select';
$religion_name = !empty($applicant_basic_details_list['religion_name']) ? $applicant_basic_details_list['religion_name'] : 'Select Religion';
$mothertongue_name= !empty($applicant_basic_details_list['mothertongue_name']) ? $applicant_basic_details_list['mothertongue_name'] : 'Select Mother Tongue';
//$prefer_hostel = !empty($applicant_basic_details_list['prefer_hostel']) ? ucfirst($applicant_basic_details_list['prefer_hostel']) : 'Select Hostel Accommodation';
$dif_abled = !empty($applicant_basic_details_list['dif_abled']) ? ucfirst($applicant_basic_details_list['dif_abled']) : 'Select - Yes/No';
$source_name = !empty($applicant_basic_details_list['source_name']) ? $applicant_basic_details_list['source_name']: 'Select where seen advertisment';
$nationality = !empty($applicant_basic_details_list['nationality']) ? $applicant_basic_details_list['nationality']: 'Select Nationality';
$social_status = !empty($applicant_basic_details_list['social_status']) ? $applicant_basic_details_list['social_status']: 'Select Your Social Status';
$nation_id = isset($applicant_basic_details_list['nation_id']) ? $applicant_basic_details_list['nation_id']: '';
$gender = !empty($applicant_basic_details_list['gender']) ? $applicant_basic_details_list['gender']: 'Select';

$first_name = isset($applicant_basic_details_list['f_name']) ? $applicant_basic_details_list['f_name'] : '';

$middle_name = isset($applicant_basic_details_list['m_name']) ? $applicant_basic_details_list['m_name'] : '';

$last_name = isset($applicant_basic_details_list['l_name']) ? $applicant_basic_details_list['l_name'] : '';

$mobile_no = isset($applicant_basic_details_list['mob_no']) ? $applicant_basic_details_list['mob_no'] : '';

$email_id = isset($applicant_basic_details_list['e_mail']) ? $applicant_basic_details_list['e_mail'] : '';

$dob=isset($applicant_basic_details_list['dob'])? date('d/m/Y',strtotime($applicant_basic_details_list['dob'])):'';
$alt_email_id = isset($applicant_basic_details_list['sec_e_mail']) ? $applicant_basic_details_list['sec_e_mail'] : '';

$user_id = isset($applicant_basic_details_list['user_id']) ? $applicant_basic_details_list['user_id'] : '';
$medium_of_instruction_name = isset($applicant_other_details_list['medium_of_study_name'])? $applicant_other_details_list['medium_of_study_name'] :'Select Medium of Instruction';



$digilocker_id=$parent_name="";
$digilocker_id = $personal_detail_list['data']['digilocker_id'];

//set address
$add_line_1 = isset($applicant_address_details_list['add_line_1']) ? $applicant_address_details_list['add_line_1'] : '';
$add_line_2 = isset($applicant_address_details_list['add_line_2']) ? $applicant_address_details_list['add_line_2'] : '';
$pin_code = isset($applicant_address_details_list['pin_code']) ? $applicant_address_details_list['pin_code'] : '';

//parent detail -from other detail
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
//address
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
//end address


$name_as_in_marksheet = isset($applicant_schooling_list[0]['name_as_in_marksheet']) ? $applicant_schooling_list[0]['name_as_in_marksheet'] : '';
if(isset($applicant_schooling_list)){
    foreach($applicant_schooling_list as $school){
        $schooltype="";
        if($school['schooling_id']==SCHOOLING_ID_TENTH){
            $schooltype="tenth";
        }
        if($school['schooling_id']==SCHOOLING_ID_ELEVENTH){
            $schooltype="eleven";
        }
        if($school['schooling_id']==SCHOOLING_ID_TWELFTH){
            $schooltype="twelfth";
        }
        
        $schooltypename=strtolower($schooltype);
        ${ "inst_name_".$schooltypename}=$school['inst_name'];
        ${ "marking_scheme_".$schooltypename}=$school['marking_scheme_name'];
        ${ "mark_percentage_".$schooltypename}=$school['mark_percentage'];
        ${ "registration_no_".$schooltypename}=$school['registration_no'];
        ${ "other_board_name_".$schooltypename}=$school['other_board_name'];
        ${ "schooling_id_".$schooltypename}=$school['applicant_scl_det_id'];
        ${ "other_stream_name_".$schooltypename}=$school['other_stream_name'];
        ${ "completion_year_".$schooltypename}=$school['completion_year'];
        ${ "board_".$schooltypename}=$school['board_name'];
        ${ "board_id_".$schooltypename}=$school['board_id'];
        ${ "stream_id_".$schooltypename}=$school['stream_id'];
        ${ "stream_name_".$schooltypename}=$school['stream_name'];
        ${ "result_declared_".$schooltypename}=$school['result_declared'];
        
    }
}

// Schooling Detail Get Tenth
$schooling_id_tenth = isset($schooling_id_tenth) ? $schooling_id_tenth:'';
$inst_name_tenth = isset($inst_name_tenth) ? $inst_name_tenth:'';
$mark_percentage_tenth = isset($mark_percentage_tenth)? $mark_percentage_tenth : '';
$registration_no_tenth = isset($registration_no_tenth) ? $registration_no_tenth : '';
$other_board_name_tenth = isset($other_board_name_tenth) ? $other_board_name_tenth : '';
$completion_year_tenth=isset($completion_year_tenth) ? $completion_year_tenth : 'YYYY';
$board_id_tenth = isset($board_id_tenth) ? $board_id_tenth:'';
$board_tenth = isset($board_tenth) ? $board_tenth:'Select';
$marking_scheme_tenth = isset($marking_scheme_tenth)? $marking_scheme_tenth : '';
// Schooling Detail Get Twelfth
$schooling_id_twelfth = isset($schooling_id_twelfth) ? $schooling_id_twelfth:'';
$inst_name_twelfth = isset($inst_name_twelfth) ? $inst_name_twelfth:'';
$mark_percentage_twelfth = isset($mark_percentage_twelfth)? $mark_percentage_twelfth : '';
$registration_no_twelfth = isset($registration_no_twelfth) ? $registration_no_twelfth : '';
$other_board_name_twelfth = isset($other_board_name_twelfth) ? $other_board_name_twelfth : '';
$other_stream_name = isset($other_stream_name_twelfth) ? $other_stream_name_twelfth : '';
$board_id_twelfth = isset($board_id_twelfth) ? $board_id_twelfth:'';
$board_twelfth = isset($board_twelfth) ? $board_twelfth:'Select';
$marking_scheme_twelfth = isset($marking_scheme_twelfth) ? $marking_scheme_twelfth : 'Select';
$completion_year_twelfth = isset($completion_year_twelfth) ? $completion_year_twelfth : 'YYYY';

//get ug pg value
$is_work_experience = $applicant_other_details_list['is_work_experience'];
$is_competitive_exam = $applicant_other_details_list['is_competitive_exam'];


$name_as_in_marksheet = isset($applicant_schooling_list[0]['name_as_in_marksheet']) ? $applicant_schooling_list[0]['name_as_in_marksheet'] : '';

$result_declare_date = date('m/Y', strtotime($applicant_other_details_list['expectedmonthyearresult']));
$total_work_exp = $applicant_other_details_list['total_work_exp'];
$applicant_prof_exp_id=array();
$applicant_prof_exp_org_name=array();
$applicant_prof_exp_designation=array();
$applicant_prof_exp_sector=array();
$applicant_prof_exp_salary=array();
$applicant_prof_exp_from_date=array();
$applicant_prof_exp_to_date=array();
$applicant_prof_exp_work_exp_in_months=array();
if($applicant_prof_exps_list) {
    foreach($applicant_prof_exps_list as $k=>$v) {
        // $applicant_prof_exp_id[] = $v['applicant_prof_exp_id'];
        $applicant_prof_exp_id[] = $v['exp_id'];
        $applicant_prof_exp_org_name[] = $v['org_name'];
        $applicant_prof_exp_designation[] = $v['designation'];
        $applicant_prof_exp_sector_id[] = $v['sector_id'];
        $applicant_prof_exp_sector_name[] = $v['sector_name'];       
        $other_sector[] = $v['other_sector_name'];
        $applicant_prof_exp_other_sector_name[] = $v['other_sector_name'];
        $applicant_prof_exp_salary[] = $v['salary'];
        $applicant_prof_exp_from_date[] = ($v['from_date']) ? $v['from_date'] :'MM/YYYY' ;
        $applicant_prof_exp_to_date[] = ($v['to_date']) ? $v['to_date'] :'MM/YYYY';        
        $applicant_prof_exp_work_exp_in_months[] = $v['work_exp_month'];
    }
}

$is_work_experience_label=($is_work_experience =='t' ) ? 'Yes' :( $is_work_experience=='f' ? 'No ' : 'Select Status - Yes or No');

if($applicant_graduations_list) {
    foreach($applicant_graduations_list as $k=>$v) {
        $graduation_type_id = $v['graduation_type_id'];
        if($graduation_type_id==GRADUATION_UG_ID){
            $graduationtype="ug";
        }
        if($graduation_type_id==GRADUATION_PG_ID){
            $graduationtype="pg";
        }
        
        $graduatioName=strtolower($graduationtype);
        ${ "institute_name_".$graduatioName}=$v['insti_name'];
        ${ "obtained_percentage_cgpa_".$graduatioName}=$v['mark_percentage'];
        ${ "register_no_".$graduatioName}=$v['reg_no'];
        ${ "university_other_".$graduatioName}=$v['other_university_name'];
        ${ "grad_type_".$graduatioName}=$v['grad_type'];
        ${ "degree_".$graduatioName}=$v['other_deg_name'];
        ${ "applicant_grad_det_id_".$graduatioName}=$v['applicant_grad_det_id'];
        ${ "univ_name_".$graduatioName}=$v['univ_name'];
        ${ "univ_id_".$graduatioName}=$v['univ_id'];
        ${ "mark_scheme_name_".$graduatioName}=$v['mark_scheme_name'];
        ${ "yr_of_pass_".$graduatioName}=$v['yr_of_pass'];
        ${ "university_other_".$graduatioName}=$v['other_univ_name'];
        ${ "result_declared_".$graduatioName}=$v['result_declared'];
     }
}
$institute_name_ug = isset($institute_name_ug) ? $institute_name_ug : '';
$institute_name_pg = isset($institute_name_pg) ? $institute_name_pg : '';
$obtained_percentage_cgpa_ug=isset($obtained_percentage_cgpa_ug) ? $obtained_percentage_cgpa_ug : '';
$obtained_percentage_cgpa_pg=isset($obtained_percentage_cgpa_pg) ? $obtained_percentage_cgpa_pg : '';
$register_no_ug=isset($register_no_ug) ? $register_no_ug : '';
$register_no_pg=isset($register_no_pg) ? $register_no_pg : '';
$university_other_ug=isset($university_other_ug) ? $university_other_ug : '';
$university_other_pg=isset($university_other_pg) ? $university_other_pg : '';
$degree_ug=isset($degree_ug) ? $degree_ug : '';

$univ_name_ug=isset($univ_name_ug) ? $univ_name_ug : 'Select';
$univ_id_ug=isset($univ_id_ug) ? $univ_id_ug : '';
$mark_scheme_name_ug=isset($mark_scheme_name_ug) ? $mark_scheme_name_ug : 'Select';
$yr_of_pass_ug=isset($yr_of_pass_ug) ? $yr_of_pass_ug : 'Select';

$applicant_grad_det_id_ug==isset($applicant_grad_det_id_ug) ? $applicant_grad_det_id_ug : '';
$applicant_grad_det_id_pg==isset($applicant_grad_det_id_pg) ? $applicant_grad_det_id_pg : '';

$result_declared_pg==isset($result_declared_pg) ? $result_declared_pg : '';
$cur_qual_completed = $result_declared_ug;
$applicant_grad_det_univ_name=isset($applicant_grad_det_univ_name)?$applicant_grad_det_univ_name :'Select';
$applicant_grad_det_mark_scheme=isset($applicant_grad_det_mark_scheme)? $applicant_grad_det_mark_scheme : 'Select';

$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_tenth_marksheet = DOCUMENT_ID_TENTH_MARKSHEET;
$document_id_twelvfth_marksheet = DOCUMENT_ID_TWELVFTH_MARKSHEET;
$document_id_graduation_marksheet = DOCUMENT_ID_GRADUATION_MARKSHEET;

//fetch upload list
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
//end fetch list

if($applicant_application_details_list){
    $i_confirmChecked=$applicant_application_details_list[0]['is_agree'];
    $studied_from_india=$applicant_application_details_list[0]['qualifyingexamfromindia'];
}
$resultDateStyle="";
$markSchemeStyle="display:none";
$markPercentStyle="display:none";
$workExpStyle="display:none";
$examStyle="display:none";
if($qual_status_id==2)
{
    $resultDateStyle="display:none";
    $markSchemeStyle="";
    $markPercentStyle="";    
}
if($is_work_experience=='t'){
    $workExpStyle="";
}

/* Payment Details Start */
$appln_form_fee = $applicant_appln_details_list[0]['appln_form_fee'];

$branch_name = $applicant_payment_details_list['branch_name'];
$dd_cheque_no = $applicant_payment_details_list['dd_cheque_no'];
$dd_cheque_date = $applicant_payment_details_list['dd_cheque_date'];
$payment_mode_id = $applicant_payment_details_list['payment_mode_id'];
$bank_name=$applicant_payment_details_list['bank_name'];
$appln_form_fee=isset($appln_form_fee) ? $appln_form_fee : '1100';
$branch_name=isset($branch_name)? $branch_name:'';
$dd_cheque_no=isset($dd_cheque_no)? $dd_cheque_no:'';
$dd_cheque_date=isset($dd_cheque_date)? date('d/m/Y',strtotime($dd_cheque_date)):'';
$payment_mode_id=isset($payment_mode_id)? $payment_mode_id:'';
$bank_name=isset($bank_name)? $bank_name:'Select Bank Name';
/* Payment Details End */
$startIndex = $this->input->get('startIndex', true);
/*CRM ADMIN Edit form start*/
$url = base_url().'part-time-ug-pg-courses?startIndex='.$startIndex;
if($mode_edit == ADMIN_MODE_EDIT)
{
    $url = base_url().'part-time-ug-pg-courses/'.$mode_edit.'/'.$crm_applicant_login_id.'/'.$crm_applicant_personal_det_id.'?startIndex='.$startIndex;;
}
$applicant_name=!empty($applicant_application_details_list[0]['applicant_name_declaration'])?$applicant_application_details_list[0]['applicant_name_declaration']:$first_name;
$parent_name=!empty($applicant_application_details_list[0]['applicant_parentname_declaration'])?$applicant_application_details_list[0]['applicant_parentname_declaration']:$father_name;
$declared_date=!empty($applicant_application_details_list[0]['applicant_declaration_date'])?date('d/m/Y',strtotime($applicant_application_details_list[0]['applicant_declaration_date'])):date("d/m/Y");
?>

<div class="row">
    <div class="col-md-6">
        <a href="<?php echo $url;?>" class="btn btn-primary active mt-3" role="button" aria-pressed="true">Back</a>
    </div>
</div>
<div class="row disable_div_preview" id="mba_parttime_form">
    <div class="col-sm-12">
        <div class="card " id="ParttimePreviewToPrint">
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
                                        <div class="col-lg-6">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Have You Studied 10+2  from India ? <span class="tx-danger">*</span></label>
                                                <select class="form-control" name="studied_from_india" id="studied_from_india" title="Select Status - Yes or No" data-parsley-required="true" data-parsley-required-message="Please Select Studied Resident" data-parsley-errors-container="#custom-studied_from_india-parsley-error">
                                                    <option value="<?php echo $qualifyingexamfromindia;?>"><?php echo $qualifyingexamfromindia_val;?></option>
                                                   
                                                </select>
                                                <span id="custom-current_resident_tn-parsley-error"></span>	
                                            </div>
                                        </div>
                                    </div>

                                <?php if ($qualifyingexamfromindia == 't') { ?>
                                        <div class="row mg-b-25 mt-3">
                                            <div class="col-lg-12">
                                                <div class="form-group mt-1" id="indian">
                                                    <p> <span class="tx-danger">*</span> <?php echo IS_AGREE_INFO;?></p>
                                                    <span id="custom-confirm_study_residency_checkbox-parsley-error"></span>
                                                    <div class="custom-control custom-checkbox">
                                                    <?php
                                                    $checked = "";
                                                    if ($i_confirmChecked && $i_confirmChecked === 't') {
                                                        $checked = "checked";
                                                    }
                                                    ?>
                                                        <input class="custom-control-input" <?php echo $checked; ?> type="checkbox" name="i_confirm" id="i_confirm" value="0"  data-parsley-required="false" data-parsley-required-message="Please check confirm" ><label class="custom-control-label" for="i_confirm">I Confirm </label>
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
                               <div class="w-100 pd-20 pd-sm-40">
                                <h5 class="text-primary mb-3">Select Campus and Course Preferences </h5><hr/>
                                <div class="form-layout">                                	
                                <div class="row mg-b-25 mt-3 campus_course_div">			
                                <div class="col-lg-3">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Select Program Level <span
                                                class="tx-danger">*</span></label>
                                       <select class="form-control" data-placeholder="Select Program Level">
                                            <option value=""><?php echo $grad_name;?>  </option>
                                        </select>
                                      </div>
                                </div>
                                <!-- col-3 -->
                                <div class="col-lg-3">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Select Course  <span
                                                class="tx-danger">*</span></label>
                                       <select class="form-control" data-placeholder="Select Program Level">
                                            <option value=""><?php echo $course_1;?>  </option>
                                        </select>
                                      </div>
                                </div>
                                
                                <div class="col-lg-3">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Select Specialization  <span
                                                class="tx-danger">*</span></label>
                                       <select class="form-control" data-placeholder="Select Program Level">
                                            <option value=""><?php echo $specialization_1;?>  </option>
                                        </select>
                                      </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Select Campus  <span
                                                class="tx-danger">*</span></label>
                                       <select class="form-control" data-placeholder="Select Program Level">
                                            <option value=""><?php echo $campus_1;?>  </option>
                                        </select>
                                      </div>
                                </div>
                                </div>
              
                                </div><!-- form-layout -->
                                </div>
                                    <h5 class="text-primary mb-3">Personal Details</h5>
                                    <div class="row w-100">
                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Title<span class="tx-danger"> *</span></label>
                                                <select class="form-control select2" data-placeholder="Select Title" tabindex="-1" aria-hidden="true" name="pd_title" id="pd_title" title="Select Title" data-parsley-required="true" data-parsley-required-message="Please Select Title" data-parsley-errors-container="#custom-pd_title-parsley-error" data-parsley-trigger="change">
                                                    <option><?php echo $tittle_name;?></option>						  
                                                </select>
                                                <span id="custom-pd_title-parsley-error"></span>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">First Name <span class="tx-danger"> *</span></label>
                                                <input class="form-control" type="text" name="pd_firstname" id="pd_firstname" placeholder="Enter First Name" placeholder="Your First Name" maxlength="100" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter First Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 100]" value="<?php echo $first_name; ?>">
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Middle Name </label>
                                                <input class="form-control" type="text" name="pd_middlename" id="pd_middlename" placeholder="Your Middle Name" placeholder="Your Last Name" maxlength="50"data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" value="<?php echo $middle_name; ?>">
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Last Name <span class="tx-danger"> *</span></label>
                                                <input class="form-control" type="text" name="pd_lastname"  id="pd_lastname" placeholder="Your Last Name" maxlength="50" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Last Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" data-parsley-pattern="/^[a-zA-Z.]*$/" value="<?php echo $last_name; ?>">
                                                <span>Use . (dot), if you have no last name.</span>
                                            </div>

                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <label class="form-control-label">Mobile Number <span class="tx-danger"> *</span></label>
                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                                    <select class="form-control form_control  Mobile_number" id="phone_no_code" name="phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                                        <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>
                                                        <option value="Law">Law</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </span>
                                                <input type="number" name="pd_mobile_no" id="pd_mobile_no" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Mobile No" class="form-control" data-parsley-required="true" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-errors-container="#custom-pd_mobile_no-parsley-error" value="<?php echo $mobile_no; ?>">
                                            </div>
                                            <span id="custom-pd_mobile_no-parsley-error"></span>	
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Email ID <span class="tx-danger"> *</span></label>
                                                <input class="form-control" type="email" name="pd_email" id="pd_email" placeholder="Your email id." data-parsley-required="true" data-parsley-required-message="Please Enter Email ID" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Email ID" data-parsley-errors-container="#custom-pd_email-parsley-error" value="<?php echo $email_id; ?>">
                                                <span id="custom-pd_email-parsley-error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="wd-200 w-100">
                                                <label class="form-control-label">Date of Birth <span class="tx-danger"> *</span></label>
                                                <div class="input-group"><span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                                    <input class="form-control hasDatepicker" name="pd_dob" id="pd_dob" placeholder="MM/DD/YYYY" data-parsley-required="true" data-parsley-required-message="Please Pick Date of Birth" data-parsley-errors-container="#custom-pd_dob-parsley-error" value="<?php echo $dob; ?>">
                                                </div>
                                            </div>
                                            <span id="custom-pd_dob-parsley-error"></span>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Gender <span class="tx-danger"> *</span></label>
                                                <select class="form-control select2" data-placeholder="Select Gender" tabindex="-1" aria-hidden="true" name="pd_gender" id="pd_gender" title="Select Gender" data-parsley-required="true" data-parsley-required-message="Please Select Gender" data-parsley-errors-container="#custom-pd_gender-parsley-error">
                                                    <option value=""><?php echo $gender;?></option>
                                                    
                                                </select>
                                                <span id="custom-pd_gender-parsley-error"></span>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Alternate Email ID </label>
                                                <input class="form-control" type="email" name="pd_alt_email" id="pd_alt_email" placeholder="Alternate Email" data-parsley-required="false" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Alternate Email ID" data-parsley-errors-container="#custom-pd_alt_email-parsley-error" value="<?php echo $alt_email_id; ?>">
                                                <span id="custom-pd_alt_email-parsley-error"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Blood Group <span class="tx-danger"> *</span></label>
                                                <select class="form-control select2" data-placeholder="Select Blood Group" tabindex="-1" aria-hidden="true" name="pd_blood_group" id="pd_blood_group" title="Select Blood Group" data-parsley-required="true" data-parsley-required-message="Please Select Blood Group" data-parsley-errors-container="#custom-pd_blood_group-parsley-error">
                                                    <option value=""><?php echo $blood_group?></option>
                                                    
                                                </select>
                                                <span id="custom-pd_blood_group-parsley-error"></span>
                                            </div>
                                        </div>	

                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Religion</label>
                                                <select class="form-control select2" data-placeholder="Select Religion" tabindex="-1" aria-hidden="true" name="pd_religion" id="pd_religion" title="Select Religion" data-parsley-required="true" data-parsley-required-message="Please Select Religion" data-parsley-errors-container="#custom-pd_religion-parsley-error">
                                                 <option value=""><?php echo $religion_name;?></option>
                                                </select>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Mother Tongue</label>
                                                <select class="form-control select2" data-placeholder="Select Mother Tongue" tabindex="-1" aria-hidden="true" name="pd_mother_tongue" id="pd_mother_tongue" title="Select Mother Tongue" data-parsley-required="true" data-parsley-required-message="Please Select Mother Tongue" data-parsley-errors-container="#custom-pd_mother_tongue-parsley-error">
                                                 <option value=""><?php echo $mothertongue_name;?></option>
                                                </select>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Medium of Instruction</label>
                                                <select class="form-control select2" data-placeholder="Select Medium of Instruction" tabindex="-1" aria-hidden="true" name="pd_medium_of_instruction" id="pd_medium_of_instruction" title="Select Medium of Instruction" data-parsley-required="true" data-parsley-required-message="Please Select Medium of Instruction" data-parsley-errors-container="#custom-pd_medium_of_instruction-parsley-error" data-parsley-trigger="change">
                                                    <option value=""><?php echo $medium_of_instruction_name;?></option>
                                                </select>
                                                <span id="custom-pd_medium_of_instruction-parsley-error"></span>

                                            </div>
                                        </div><!-- col-4 -->                                        
                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Are You Differently Abled ? <span class="tx-danger">*</span></label>
                                                <select class="form-control select2" data-placeholder="Select differently abled status" tabindex="-1" aria-hidden="true" name="pd_diffrently_abled" id="pd_diffrently_abled" title="Select Differently abled status" data-parsley-required="true" data-parsley-required-message="Please Select Differently abled status" data-parsley-errors-container="#custom-pd_diffrently_abled-parsley-error">
                                                 <option value=""><?php echo $dif_abled;?></option>
                                                </select>
                                                <span id="custom-pd_diffrently_abled-parsley-error"></span>
                                            </div>
                                        </div><!-- col-4 -->                    

                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Where do you see the admission advertisement?</label>
                                                <select class="form-control select2" data-placeholder="Select where seen advertisement" tabindex="-1" aria-hidden="true" name="pd_advertisement_source" id="pd_advertisement_source" title="Select where seen advertisement" data-parsley-required="true" data-parsley-required-message="Please Select where seen advertisement" data-parsley-errors-container="#custom-pd_advertisement_source-parsley-error">
                                                    <option value=""><?php echo $source_name;?></option>
                                               </select>
                                            </div>
                                            <span id="custom-pd_advertisement_source-parsley-error"></span>
                                        </div><!-- col-4 --> 

                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Nationality<span class="tx-danger">*</span></label>
                                                <select class="form-control select2" data-placeholder="Select Nationality" tabindex="-1" aria-hidden="true" name="pd_nationality" id="pd_nationality" title="Select Nationality" data-parsley-required="true" data-parsley-required-message="Please Select Nationality" data-parsley-errors-container="#custom-pd_nationality-parsley-error">
                                                    <option value=""><?php echo $nationality;?></option>
                                                    
                                                </select>
                                                <span id="custom-pd_nationality-parsley-error"></span>
                                            </div>
                                        </div><!-- col-4 -->
                                        <?php if($nation_id==COUNTRY_VALUE_DEFAULT) 
                                        {
                                        ?>
                                        <div class="col-lg-4" id="main_div_social_status">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Community <span
                                                        class="tx-danger">*</span></label>
                                                <select class="form-control select2" data-placeholder="Select Community" tabindex="-1" aria-hidden="true" name="pd_social_status" id="pd_social_status" title="Select Community" data-parsley-required="true" data-parsley-required-message="Please Select Community" data-parsley-errors-container="#custom-pd_social_status-parsley-error" data-parsley-trigger="change"> 
                                                    
                                                    <option value=""><?php echo $social_status;?></option>
                                                    
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
                                
                                    <h5 class="text-primary mb-3">Father's Details</h5>
                                    <div class="row w-100">
                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Title<span class="tx-danger">*</span></label>
                                                <select class="form-control select2" data-placeholder="Select Title" tabindex="-1" aria-hidden="true" name="pd_father_title" id="pd_father_title" title="Select Title" data-parsley-required="true" data-parsley-required-message="Please Select Title" data-parsley-errors-container="#custom-pd_father_title-parsley-error" >
                                                    <option value=""><?php echo $father_title_name;?></option>                                                    
                                                </select>
                                                <span id="custom-pd_father_title-parsley-error"></span>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Father's Name <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="text" name="pd_father_name" id="pd_father_name" placeholder="Enter Your Father Name" maxlength="50" data-parsley-required="true" data-parsley-required-message="Please Enter Your Father Name" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" value="<?php echo $father_name; ?>">
                                            </div>
                                        </div><!-- col-4 -->
                                        <?php if($father_title_id!=LOOKUP_VALUE_TITLE_LATE_ID) { ?>
                                        <div class="col-lg-4" id="father_mbleno_div" >
                                            <label class="form-control-label">Father's Mobile Number
                                            </label>
                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                                    <select class="form-control form_control  Mobile_number" id="pd_father_phone_no_code" name="pd_father_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                                        <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected><?php echo $father_country_mob_code;?></option>

                                                    </select>
                                                </span>
                                                <input type="text" value="<?php echo $father_mobile; ?>" class="form-control" name="pd_father_phone" id="pd_father_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_father_phone-parsley-error" value="<?php //echo $phone_no;  ?>">
                                            </div>
                                            <span id="custom-pd_father_phone-parsley-error"></span>
                                        </div>

                                        <div class="col-lg-4" id="father_alt_mbleno_div" >
                                            <label class="form-control-label">Father's Alternate Mobile Number</label>
                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                                    <select class="form-control form_control  Mobile_number" id="pd_father_alt_phone_no_code" name="pd_father_alt_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                                        <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected><?php echo $father_alt_mob_country_code;?></option>

                                                    </select>
                                                </span>
                                                <input type="text" class="form-control" name="pd_father_alt_phone" id="pd_father_alt_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's alernative Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter father's alternative Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_father_alt_phone-parsley-error" value="<?php echo $father_alt_mobile; ?>">
                                            </div>
                                            <span id="custom-pd_father_alt_phone-parsley-error"></span>
                                        </div>

                                        <div class="col-lg-4" id="father_email_div" >
                                            <div class="form-group">
                                                <label class="form-control-label">Father's Email ID </label>
                                                <input class="form-control" type="email" name="pd_father_email" id="pd_father_email"  placeholder="Enter Your Father's Email ID"data-parsley-required="false" data-parsley-required-message="Please Enter Email ID" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Email ID" data-parsley-errors-container="#custom-pd_father_email-parsley-error" value="<?php echo $father_email; ?>">
                                                <span id="custom-pd_father_email-parsley-error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4"  id="father_occupation_div" >
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Father's Occupation</label>
                                                <select class="form-control select2" data-placeholder="Select Occupation" tabindex="-1" aria-hidden="true" name="pd_father_occupation" id="pd_father_occupation">
                                                    <option value=""><?php echo $father_occupation;?></option>
                                                    
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

                                    <h5 class="text-primary mb-3">Mother's Details</h5>
                                    <!-- row -->                             
                                    <div class="row w-100">
                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Title<span
                                                        class="tx-danger">*</span></label>
                                                <select class="form-control select2" name="pd_mother_title" id="pd_mother_title" title="Select Title" data-parsley-required="true" data-parsley-required-message="Please Select Title" data-parsley-errors-container="#custom-pd_mother_title-parsley-error">
                                                   <option value=""><?php echo $mother_title_name;?></option>  
                                                   
                                                </select>
                                                <span id="custom-pd_mother_title-parsley-error"></span>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Mother's Name <span class="tx-danger">*</span></label>
                                                <input type="text" class="form-control" name="pd_mother_name" id="pd_mother_name" placeholder="Enter Your Father Name" maxlength="50" data-parsley-required="true" data-parsley-required-message="Please Enter Your Mother Name" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" value="<?php echo $mother_name; ?>">
                                            </div>
                                        </div><!-- col-4 -->
                                        <?php if($mother_title_id!=LOOKUP_VALUE_TITLE_LATE_ID) { ?>
                                        <div class="col-lg-4" id="mother_mbleno_div" >
                                            <label class="form-control-label">Mother's Mobile Number</label>
                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                                    <select class="form-control form_control  Mobile_number" id="pd_mother_phone_no_code" name="pd_mother_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                                        <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected><?php echo $mother_country_mob_code;?></option>
                                                       
                                                    </select>
                                                </span>
                                                <input type="text" class="form-control" name="pd_mother_phone" id="pd_mother_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_mother_phone-parsley-error" value="<?php echo $mother_mobile; ?>">
                                                <span id="custom-pd_mother_phone-parsley-error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4" id="mother_alt_mbleno_div" >
                                            <label class="form-control-label">Mother's Alternate Mobile Number</label>
                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                                    <select class="form-control form_control  Mobile_number" id="pd_mother_alt_phone_no_code" name="pd_mother_alt_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                                        <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected><?php echo $mother_alt_mob_country_code;?></option>

                                                    </select>
                                                </span>
                                                <input type="text" class="form-control" name="pd_mother_alt_phone" id="pd_mother_alt_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_mother_alt_phone-parsley-error" value="<?php echo $mother_alt_mobile ?>">
                                                <span id="custom-pd_mother_alt_phone-parsley-error"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-4" id="mother_email_div" >
                                            <div class="form-group">
                                                <label class="form-control-label">Mother's Email ID </label>
                                                <input class="form-control" type="email" name="pd_mother_email" id="pd_mother_email"  placeholder="Enter Your Mother's Email ID"data-parsley-required="false" data-parsley-required-message="Please Enter Email ID" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Email ID" data-parsley-errors-container="#custom-pd_mother_email-parsley-error" value="<?php echo $mother_email; ?>">
                                                <span id="custom-pd_mother_email-parsley-error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4" id="mother_occupation_div" >
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Mother's Occupation</label>
                                                <select class="form-control select2" data-placeholder="Select Occupation" tabindex="-1" aria-hidden="true" name="pd_mother_occupation" id="pd_mother_occupation">
                                                    <option value=""><?php echo $mother_occupation;?></option>
                                                   
                                                </select>
                                            </div> 
                                            <?php if ($mother_occupation_id==OTHER_OCCUPATION) { ?>
                                            <div id="mother_other_occupation_div"  class="form-group">
                    						<input class="form-control" type="text" name="pd_mother_other_occupation" id="pd_mother_other_occupation"  placeholder="If Other, please enter here..." data-parsley-required="false"   data-parsley-errors-container="#custom-pd_mother_other_occupation-parsley-error" value="<?php echo $mother_other_occupation;?>">
                    						<span id="custom-pd_mother_other_occupation-parsley-error"></span>
                    					    </div> 
                    					    <?php } ?>                                          
                                        </div>
                                        <?php } ?>
                                        
                                        <!-- col-4 -->
                                    </div><!-- row -->
                                    <?php if (!empty($add_gardian) && $add_gardian=='t') { ?>
                                    <div>
                                        <label class="ckbox add_guardian_checkbox">
                                            <input name="add_guardian_checkbox" id="add_guardian_checkbox" checked type="checkbox" value="false" 	

                                            <span> Add Guardian Detail</span>
                                        </label>
                                    </div>
                                    <div class="row w-100">

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Guardian's Name: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="text" name="pd_guardian_name" id="pd_guardian_name" placeholder="Enter Your Guardian Name" maxlength="50" data-parsley-required="false" data-parsley-required-message="Please Enter Your Guardian Name" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" value="<?php echo $guardian_name; ?>">
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <label class="form-control-label">Guardian's Mobile NO <span
                                                    class="tx-danger">*</span></label>
                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                                    <select class="form-control form_control  Mobile_number" id="pd_guardian_phone_no_code" name="pd_guardian_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                                        <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected><?php echo $guardian_country_mob_code;?></option>
                                                        
                                                    </select>
                                                </span>
                                                <input type="text" class="form-control" name="pd_guardian_phone" id="pd_guardian_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Guardian's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_guardian_phone-parsley-error" value="<?php echo $guardian_mobile; ?>">
                                                <span id="custom-pd_guardian_phone-parsley-error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Guardian's Email ID: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="email" name="pd_guardian_email" id="pd_guardian_email"  placeholder="Enter Your Guardian's Email ID"data-parsley-required="false" data-parsley-required-message="Please Enter Email ID" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Email ID" data-parsley-errors-container="#custom-pd_guardian_email-parsley-error" value="<?php echo $guardian_email; ?>">
                                                <span id="custom-pd_guardian_email-parsley-error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Guardian's Occupation<span class="tx-danger">*</span></label>
                                                <select class="form-control select2" data-placeholder="Select Guardian Occupation" tabindex="-1" aria-hidden="true" name="pd_guardian_occupation" id="pd_guardian_occupation">
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
                                <h5 class="text-primary mb-3">Address for Communication</h5>
                                    <div class="row w-100">
                                        <div class="col-md-4">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">Country<span class="tx-danger"> *</span></label>
                                                <select class="form-control select2" data-placeholder="Select country" tabindex="-1" aria-hidden="true" name="country_addr" id="country_addr" title="Select Country" data-parsley-required="true" data-parsley-required-message="Please Select Country" data-parsley-errors-container="#custom-country_addr-parsley-error">
                                                    <option value=""><?php echo $country_name;?></option>
                                                </select>
                                                <span id="custom-country_addr-parsley-error"></span>
                                            </div>
                                        </div><!-- col-4 -->
                                        <?php if($country_id==COUNTRY_VALUE_DEFAULT) { ?>
                                        <div class="col-md-4" id="main_div_state">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">State<span class="tx-danger"> *</span></label>
                                                <select class="form-control select2" data-placeholder="Select State" tabindex="-1" aria-hidden="true" name="state_addr" id="state_addr" title="Select State" data-parsley-required="true" data-parsley-required-message="Please Select State" data-parsley-errors-container="#custom-state_addr-parsley-error">
                                                    <option value=""><?php echo $state_name;?></option>
                                                </select>
                                                <span id="custom-state_addr-parsley-error"></span>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-md-4" id="main_div_district">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">District<span class="tx-danger"> *</span></label>
                                                <select class="form-control select2" data-placeholder="Select District" tabindex="-1" aria-hidden="true" name="district_addr" id="district_addr" title="Select District" data-parsley-required="true" data-parsley-required-message="Please Select District" data-parsley-errors-container="#custom-district_addr-parsley-error">
                                                    <option  value=""><?php echo $district_name;?></option>

                                                </select>
                                                <span id="custom-district_addr-parsley-error"></span>
                                            </div>
                                        </div><!-- col-4 -->
                                        <?php } ?>
                                    </div>
                                    <div class="row w-100">
                                    <?php if($country_id==COUNTRY_VALUE_DEFAULT) { ?>
                                       
                                        <div class="col-md-4" id="main_div_city">
                                            <div class="form-group mg-b-10-force">
                                                <label class="form-control-label">City<span class="tx-danger"> *</span></label>
                                                <select class="form-control select2" data-placeholder="Select City" tabindex="-1" aria-hidden="true" name="city_addr" id="city_addr" title="Select City" data-parsley-required="true" data-parsley-required-message="Please Select City" data-parsley-errors-container="#custom-city_addr-parsley-error">
                                                    <option value=""><?php echo $city_name;?></option>

                                                </select>
                                                <span id="custom-city_addr-parsley-error"></span>
                                            </div>
                                        </div><!-- col-4 -->
                                        <?php } ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Correspondence Address Line 1 <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="text" name="address_line1" id="address_line1" placeholder="Enter Address Line 1" data-parsley-required="true" data-parsley-required-message="Please Enter Address" value="<?php echo $add_line_1; ?>" data-parsley-maxlength="100">
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Correspondence Address Line 2 <!--<span class="tx-danger">*</span>--></label>
                                                <input class="form-control" type="text" name="address_line2" id="address_line2" placeholder="Enter Address Line 2" value="<?php echo $add_line_2; ?>" data-parsley-maxlength="100">
                                            </div>
                                        </div><!-- col-4 -->		
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-control-label">Pincode <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Pincode" data-parsley-required="true" data-parsley-required-message="Please Enter Pincode" value="<?php echo $pin_code; ?>" data-parsley-maxlength="6" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Pincode" maxlength=6>
                                            </div>
                                        </div><!-- col-4 -->		  
                                    </div>

                                    <!-- row -->
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
                            <div class="row w-100">
                             <div class="col-lg-12">
                             <h5 class="text-primary mb-3">Academic Details</h5>
                             </div>
                            </div>
                                <div class="row w-100 print_margin_6">
                                    <div class="col-lg-6">
                                    <div class="form-group mr-5">
                                        <label class="form-control-label">Current Education Qualification Status <span class="tx-danger">*</span></label>
                                        <div class="row">
                                          <div class="col-lg-6 pr-0">
                                            <div class="custom-control custom-radio custom-control-inline">
                                              <input type="radio" id="appering" name="current_education_qual_status" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="Please Select Current Education Qualification Status" data-parsley-errors-container="#custom-current_education_qual_status-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($cur_qual_completed == 'f')?'checked':''; ?>>
                                              <label class="custom-control-label" for="appering">Diploma/Degree Appearing</label>
                                            </div>
                                          </div>
                                          <div class="col-lg-6 pl-0">
                                            <div class="custom-control custom-radio custom-control-inline">
                                              <input type="radio" id="completed" name="current_education_qual_status" class="custom-control-input" value="2" <?php echo ($cur_qual_completed == 't')?'checked':''; ?>>
                                              <label class="custom-control-label" for="completed">Diploma/Degree Completed</label>
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
                                        <input class="form-control" type="text" name="canditate_name" id="canditate_name" placeholder="Enter Name" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 100]" value="<?php echo $name_as_in_marksheet; ?>" maxlength="100" data-parsley-trigger="change">
                                        <small id="emailHelp"
                                            class="form-text text-muted"><?php echo TYPE_NA;?></small>
                                    </div>
                                </div><!-- form-group -->
                                </div>
                                    
                                    
                                </div> <!-- end row -->
                                
                                <section class="row mt-2">
                                    <h5 class="mb-0">Academic Details </h5>
                                    
                                    <div class="table-responsive">
                                    <table class="table table-bordered mt-0">

                                        <thead class="thead-light">
                                            <tr>
                                                <th></th>
                                                <th> Institute Name</th>
                                                <th> Board </th>               
                                                <th> Marking Scheme</th>
                                                <th> Obtained Percentage/CGPA</th>
                                                <th> Year of Passing</th>
                                                <th>Registration No.
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <p>X <span class="tx-danger">*</span> </p>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="academic_tenth_inst" id="academic_tenth_inst" maxlength="200" data-parsley-required="true" data-parsley-required-message="Please Enter Institute Name" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 200]" value="<?php echo $inst_name_tenth; ?>">
                                                </td>
                                                <td>
                                                    <div class="form-group mg-b-10-force">
                                                        <select class="form-control select2" name="academic_board" id="academic_board" title="Choose Board" data-parsley-required="true" data-parsley-required-message="Please Choose Board" data-parsley-errors-container="#custom-academic_board-parsley-error">
                                                            <option value=""><?php echo $board_tenth; ?></option>
                                                        </select>
                                                        <span id="custom-academic_board-parsley-error"></span>

                                                    </div>
														<?php if ($board_id_tenth == OTHER_BOARD) { ?>
                                                        <div class="form-group" id="other_board1">
                                                            <input type="text" class="form-control" name="other_tenth_board" id="other_tenth_board" placeholder="If Other, please enter here.." maxlength="100"  value="<?php echo $other_board_name_tenth; ?>">
                                                        </div>
														<?php } ?>
                                                </td>				
                                                <td>
                                                    <div class="form-group mg-b-10-force" id="Appering_info_1">
                                                        <select class="form-control select2" name="academic_marking_scheme" id="academic_marking_scheme" title="Choose Academic Marking Scheme" data-parsley-required="true" data-parsley-required-message="Please Choose  Marking Scheme" data-parsley-errors-container="#custom-academic_marking_scheme-parsley-error">
                                                            <option value=""><?php echo $marking_scheme_tenth; ?></option>
                                                        </select>
                                                        <span id="custom-academic_marking_scheme-parsley-error"></span>

                                                    </div>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="academic_obtain_cgpa" id="academic_obtain_cgpa" data-parsley-required="true" data-parsley-required-message="Please Enter CGPA" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid CGPA" value="<?php echo $mark_percentage_tenth; ?>">
                                                </td>
                                                <td>
                                                    <div class="form-group mg-b-10-force">                                                        
                                                         <div class="form-group">
                                                          	<input class="form-control" type="text" name="academic_yr_passing" id="academic_yr_passing" class="form-control datepicker" placeholder="YYYY" data-parsley-required="true" data-parsley-required-message="Required" data-parsley-trigger="change" value="<?php echo $completion_year_tenth; ?>">
                                                          </div>
                                                        <span id="custom-academic_yr_passing-parsley-error"></span>

                                                    </div>
                                                </td>
                                                <td class="reg_width">
                                                    <input class="form-control" type="text" name="academic_reg_no"id="academic_reg_no" maxlength="100" data-parsley-required="true" data-parsley-required-message="Please Enter Registration No" data-parsley-length="[1, 100]" value="<?php echo $registration_no_tenth; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>XII</p>
                                                </td>
                                                <td>
                                                    <input class="form-control" type="text" name="academic_twelfth_inst" id="academic_twelfth_inst" maxlength="200" data-parsley-required="true" data-parsley-required-message="Please Enter Institute Name" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 200]" value="<?php echo $inst_name_twelfth; ?>">
                                                </td>
                                                <td>
                                                    <div class="form-group mg-b-10-force">
                                                        <select class="form-control select2" name="academic_twelfth_board" id="academic_twelfth_board" title="Choose Board" data-parsley-required="true" data-parsley-required-message="Please Choose Board" data-parsley-errors-container="#custom-academic_twelfth_board-parsley-error">
                                                            <option value=""><?php echo $board_twelfth; ?></option>
                                                        </select>
                                                        <span id="custom-academic_twelfth_board-parsley-error"></span>
                                                    </div>
													<?php if ($board_id_twelfth == OTHER_BOARD) { ?>
                                                        <div class="form-group" id="other_board2" >
                                                            <input type="text" class="form-control" name="other_twelfth_board" id="other_twelfth_board" placeholder="If Other, please enter here.." maxlength="100" value="<?php echo $other_board_name_twelfth; ?>">
                                                        </div>
														<?php } ?>
                                                </td>

                                                <td>													
                                                    <div class="form-group mg-b-10-force" > 
                                                        <select class="form-control select2" name="academic_marking_scheme_twelfth" id="academic_marking_scheme_twelfth" title="Choose Academic Marking Scheme" data-parsley-required="true" data-parsley-required-message="Please Choose  Marking Scheme" data-parsley-errors-container="#custom-academic_marking_scheme_twelfth-parsley-error">
                                                            <option value=""><?php echo $marking_scheme_twelfth; ?></option>
                                                        </select>
                                                        <span id="custom-academic_marking_scheme_twelfth-parsley-error"></span>
                                                    </div>
                                                </td>
                                                <td>                                                    
                                                <div class="">
                                                    <input class="form-control" type="text" name="academic_obtain_cgpa_twelfth" id="academic_obtain_cgpa_twelfth" data-parsley-required="true" data-parsley-required-message="Please Enter CGPA" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid CGPA" value="<?php echo $mark_percentage_twelfth; ?>">
                                                </div>
                                                </td>
                                                <td>
                                                 <div class="form-group">
                                                   <input class="form-control" type="text" value="<?php echo $completion_year_twelfth; ?>">
                                                   <span id="custom-academic_yr_passing_twelfth-parsley-error"></span>
                                                </div>
                                                </td>
                                                <td class="reg_width">
                                                        <div class="">
                                                            <input class="form-control" type="text" name="academic_reg_no_twelfth" id="academic_reg_no_twelfth" maxlength="100" data-parsley-required="true" data-parsley-required-message="Please Enter Registration No" data-parsley-length="[1, 100]" value="<?php echo $registration_no_twelfth; ?>">
                                                        </div>
                                                </td>				

                                            </tr>
                                            <tr>
                                            <td><p>Diploma/ Graduation</p></td>
                                            <td>
                                              <input class="form-control" type="hidden" placeholder="" id="grad_id" name="grad_id" value="<?php echo $applicant_grad_det_id_ug; ?>">
                                              <input class="form-control" type="text" name="institute_name" id="institute_name" placeholder="Enter Institute Name" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Institute Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 100]" value="<?php echo $institute_name_ug; ?>" maxlength="100" data-parsley-trigger="change">
                                              <span class="tx-danger required_asterisk">*</span>
                                            </td>
                                            <td>
                                              <div class="form-group mg-b-10-force">
                                                <select class="form-control " id="institute_university" name="institute_university" data-placeholder="Select University" data-parsley-required="true" data-parsley-required-message="Please Select University" data-parsley-errors-container="#custom-institute_university-parsley-error">
                                                  <option value=""><?php echo $univ_name_ug;?></option>
                                                </select>
                                                <span class="tx-danger required_asterisk">*</span>
                                                <span id="custom-institute_university-parsley-error"></span>
                                              </div>
                                              <div id="ob_univ" style="display:none;">
                                                <input class="form-control" type="text" name="other_univ_grad" id="other_univ_grad" maxlength="200" value="<?php echo $university_other_ug; ?>">         
                                              </div>
                                            </td>
                                            <td>
                                                <div class="form-group mg-b-10-force" id="appering_info_1" style="<?php echo $markSchemeStyle;?>">
                                                  <select class="form-control " name="marking_scheme" id="marking_scheme" data-parsley-required="true" data-parsley-required-message="Please Select Marking Scheme" data-parsley-trigger="change" data-parsley-errors-container="#custom-marking_scheme-parsley-error">
                                                    <option value=""><?php echo $mark_scheme_name_ug;?></option>
                                                  </select>
                                                  <span class="tx-danger required_asterisk">*</span>
                                                  <span id="custom-marking_scheme-parsley-error"></span>
                                                </div>
                                            </td>
                                            <td>
                                              <div class="form-group mg-b-10-force" id="appering_info_2" style="<?php echo $markPercentStyle;?>">
                                                <input class="form-control" type="text" name="obtained_percentage_cgpa" placeholder="Obtained Percentage/CGPA" id="obtained_percentage_cgpa" maxlength="5" data-parsley-required="true" data-parsley-required-message="Please Enter Obtained Percentage/CGPA" min="33" max="100" data-parsley-trigger="keyup" data-parsley-trigger="change" data-parsley-errors-container="#custom-obtained_percentage_cgpa-parsley-error" value="<?php echo $obtained_percentage_cgpa_ug; ?>"> 
                                                <span class="tx-danger required_asterisk">*</span>
                                                <span id="custom-obtained_percentage_cgpa-parsley-error"></span>
                                              </div>
                                            </td>
                                            <td>
                                              <input class="form-control" type="text" name="year_of_passing" id="year_of_passing" placeholder="YYYY" maxlength="4" data-parsley-required="true" data-parsley-required-message="Please Enter Year of Passing" data-parsley-trigger="change" data-parsley-errors-container="#custom-year_of_passing-parsley-error" value="<?php echo $yr_of_pass_ug; ?>">
                                              <span class="tx-danger required_asterisk">*</span>
                                              <span id="custom-year_of_passing-parsley-error"></span>
                                            </td>
                                            <td class="reg_width">
                                              <input class="form-control" type="text" name="registration_no" id="registration_no" placeholder="Roll No. / Registration No" maxlength="10" data-parsley-required="true" data-parsley-required-message="Please Enter Roll No. / Registration No" data-parsley-trigger="change" value="<?php echo $register_no_ug; ?>">
                                              <span class="tx-danger required_asterisk">*</span>
                                            </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
        
        <div class="mt-0 w-100">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <h6 class="card-body-title mb-4">Work Experience Details</h6>
                        <label class="form-control-label">Do you have any Work Experience ? <span class="tx-danger">*</span></label>
                        <select class="form-control  study" id="is_work_experience" name="is_work_experience" data-parsley-required="true" data-parsley-required-message="Please select the Work Experience" data-parsley-errors-container="#custom-is_work_experience-parsley-error" data-parsley-trigger="change">
                            <option value=""><?php echo $is_work_experience_label;?></option>
                            
                        </select>
                        <span id="custom-is_work_experience-parsley-error"></span>
                    </div>
                </div>
            </div>
            <div class="row" id="emp_exp" style="<?php echo $workExpStyle;?>">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label" for="radios">Work Experience Details</label>
                  <div class="table-responsive pretbl">
                    <table class="table table-striped table-bordered" id="table5">
                      <thead class="thead-light">
                         <tr>
                             <th>
                             </th>
                             <th>Organisation's Name</th>
                             <th>Designation</th>
                             <th>Sector</th>
                             <th>Annual Salary Package (In Lacs)</th>
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
                               <div class="form-group">
                               <select class="form-control  study" id="sector_0" name="sector_0" data-parsley-required="true" data-parsley-required-message="Please select sector" data-parsley-errors-container="#custom-sector_0-parsley-error" data-parsley-trigger="change">
                               <option value="">
                               <?php echo ($applicant_prof_exp_sector_name[0]) ? $applicant_prof_exp_sector_name[0] : 'Select' ;?>
                               </option>                               
                               </select>
                               <?php if($applicant_prof_exp_sector_id[0]==OTHER_SECTOR) { ?>
                               <div id="othersector_0" class="form-group mt-1">
                                <input class="form-control" type="text" name="other_sector_0" id="other_sector_0"  placeholder="If Other, please enter here..." data-parsley-required="false"   data-parsley-errors-container="#custom-other_sector_0-parsley-error" value="<?php echo $other_sector[0]; ?>">
                                <span id="custom-other_sector_0-parsley-error"></span>
                              </div>
                              <?php } ?>
                               </div>
                               <span class="tx-danger required_asterisk">*</span>
                            </td>
                            <td>
                               <div class="form-group"><input type="text" name="total_salary_month_0" id="total_salary_month_0" class="form-control" placeholder="" maxlength="10" data-parsley-required="true" data-parsley-required-message="Please enter the total salary month" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_salary[0]; ?>" data-parsley-type="number"></div>
                               <span class="tx-danger required_asterisk">*</span>
                            </td>
                            <td>
                               <div class="form-group"><input readonly="" type="text" name="from_year_0" id="from_year_0" class="form-control datepicker" placeholder="MM/YYYY" maxlength="7" data-parsley-required="true" data-parsley-required-message="Please enter the from year" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_from_date[0]; ?>" data-parsley-errors-container="#custom-from_year_0-parsley-error"></div>
                               <span id="custom-from_year_0-parsley-error"></span>
                               <span class="tx-danger required_asterisk">*</span>
                            </td>
                            <td>
                               <div class="form-group"><input readonly="" type="text" name="to_year_0" id="to_year_0" class="form-control datepicker" placeholder="MM/YYYY" maxlength="7" data-parsley-required="true" data-parsley-required-message="Please enter the to year" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_to_date[0]; ?>" data-parsley-errors-container="#custom-to_year_0-parsley-error"></div>
                               <span id="custom-to_year_0-parsley-error"></span>
                               <span class="tx-danger required_asterisk">*</span>
                            </td>
                            <td>
                               <div class="form-group"><input type="text" name="work_experience_0" id="work_experience_0" class="form-control" placeholder="" readonly="readonly" maxlength="5" data-parsley-required="true" data-parsley-required-message="Please enter the work experience" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_work_exp_in_months[0]; ?>" data-parsley-errors-container="#custom-work_experience_0-parsley-error"></div>
                               <span id="custom-work_experience_0-parsley-error"></span>
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
                               <div class="form-group">
                               <select class="form-control  study" id="sector_0" name="sector_0" data-parsley-required="true" data-parsley-required-message="Please select sector" data-parsley-errors-container="#custom-sector_0-parsley-error" data-parsley-trigger="change">
                               <option value="">
                               <?php echo ($applicant_prof_exp_sector_name[1]) ? $applicant_prof_exp_sector_name[1] : 'Select' ;?>
                                </option>                           
                               </select>
                                <?php if($applicant_prof_exp_sector_id[1]==OTHER_SECTOR) { ?>
                              
                               <div id="othersector_1"  class="form-group mt-1">
                                <input class="form-control" type="text" name="other_sector_1" id="other_sector_1"  placeholder="If Other, please enter here..." data-parsley-required="false"   data-parsley-errors-container="#custom-other_sector_1-parsley-error" value="<?php echo $other_sector[1]; ?>">
                                <span id="custom-other_sector_1-parsley-error"></span>
                              </div>
                              <?php } ?>
                                </div>
                            </td>
                            <td>
                               <div class="form-group"><input type="text" name="total_salary_month_1" id="total_salary_month_1" class="form-control" placeholder="" maxlength="10" value="<?php echo $applicant_prof_exp_salary[1]; ?>" data-parsley-type="number"></div>
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
                               <div class="form-group">
                              <select class="form-control  study" id="sector_0" name="sector_0" data-parsley-required="true" data-parsley-required-message="Please select sector" data-parsley-errors-container="#custom-sector_0-parsley-error" data-parsley-trigger="change">
                               <option value="">
                               <?php echo ($applicant_prof_exp_sector_name[2]) ? $applicant_prof_exp_sector_name[2] : 'Select' ;?>
                              
                               </option>                               
                               </select>
                                <?php if($applicant_prof_exp_sector_id[2]==OTHER_SECTOR) { ?>                              
                                <div id="othersector_2"  class="form-group mt-1">
                                <input class="form-control" type="text" name="other_sector_2" id="other_sector_2"  placeholder="If Other, please enter here..." data-parsley-required="false"   data-parsley-errors-container="#custom-other_sector_2-parsley-error" value="<?php echo $other_sector[2]; ?>">
                                <span id="custom-other_sector_2-parsley-error"></span>
                               </div>
                               <?php } ?>
                                </div>
                            </td>
                            <td>
                               <div class="form-group"><input type="text" name="total_salary_month_2" id="total_salary_month_2" class="form-control" placeholder="" maxlength="10" value="<?php echo $applicant_prof_exp_salary[2]; ?>" data-parsley-type="number"></div>
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
            <div class="row" id="emp_total_exp" style="<?php echo $workExpStyle;?>">
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
			<section class="row">
			   <div class="row w-100">
				  <div class="col-lg-6 mb-3">
					 <div class="card mb-3 base_details_card">
						<div class="card-body">
							<?php $applicant_mob_country_code_name = $applicant_basic_details_list['applicant_mob_country_code_name']; ?>
							<h5 class="card-title card_title">Personal Details</h5>
							<p class="card-subtitle mb-3">Name : <?php echo $first_name." ".$last_name; ?> </p>
							<p class="card-subtitle mb-3">E-Mail :  <?php echo $email_id; ?></p>
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
									<label class="rdiobox">
										<input name="rdio" type="radio" id="online" data-parsley-required="true" data-parsley-required-message="Please Check The Value" data-parsley-errors-container="#custom-online-parsley-error" data-parsley-trigger="change" <?php if($payment_mode_id == PAYMENT_MODE_ONLINE_ID) { echo "checked";}?>>
										<span>Online</span>
									</label>
								</div>
								<div class="col-lg-2">
									<label class="rdiobox">
										<input name="rdio" type="radio" id="dd" value="on" data-parsley-required="true" data-parsley-required-message="Please Check The Value" data-parsley-errors-container="#custom-dd-parsley-error" data-parsley-trigger="change" <?php if($payment_mode_id == PAYMENT_MODE_DEMAND_DRAFT_ID) { echo "checked";} ?>>
										<span>DD</span>
									</label>
								</div>
							</div>
						   <p class="card-subtitle mb-3">Sub Total <span style="float: right;"><?php echo $appln_form_fee; ?></span>
						   </p>
						   <p class="card-subtitle">Total<span style="float: right;"><?php echo $appln_form_fee; ?></span>
						   </p>
						<div id="payment_details" style="<?php echo ($payment_mode_id==PAYMENT_MODE_DEMAND_DRAFT_ID)?'display:block;':'display:none;'; ?>">
						<div class="mt-3">
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

						<div class="mt-3">
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
								<div class="flexbox flex-start"><?php echo DD_INFAVOUR; ?></div>
							</div>
						</div>
					</div>
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
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix"> Upload and Declaration</button>
                            </h2>
                        </div>
                        <div id="collapseSix" class="collapse show bg-light" aria-labelledby="headingSix" data-parent="#accordionExample">
                            <div class="card-body">
                                <section class="row">
                                <h5 class="text-primary mb-3">Upload Your Academic and Other Documents</h5>
                                    <div class="col-md-12">
                                        <div class="form-layout">
			<div class="row mg-b-25 mt-3">
				 <div class="row w-100">
						   <div class="form-group col-md-6 ">
							  <label for="exampleFormControlTextarea1">Upload Your Recent Passport Size Photograph <span class="tx-danger">*</span></label>
							  <input type="file" class="filestyle" name="photograph" id="photograph" data-parsley-required="<?php echo ((isset($docs[$document_id_photograph]))?'false':'true'); ?>" data-parsley-required-message="Please upload photograph" data-parsley-errors-container="#custom-photograph-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>">
							  <?php if(isset($docs[$document_id_photograph])){ ?>
							  <!-- <span class='file_name  mt-3' ><a href="<?php echo base_url().$docs[$document_id_photograph]['file_path'];?>" target="_blank" title="<?php echo $docs[$document_id_photograph]['file_name_user']; ?>"><?php echo $docs[$document_id_photograph]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
							  <a href="javascript:void(0)" data-del-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>" data-doc-id="<?php echo $document_id_photograph; ?>" data-toggle="modal" data-target="#contentDeletePop" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
							  <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_photograph; ?>">
								 <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_photograph; ?>')">&times;</a>
								 <strong id="deleteMessageStatus_<?php echo $document_id_photograph; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_photograph; ?>"></span>
							  </div>
							  <?php } ?>
							  <span id="custom-photograph-parsley-error"></span>
						   </div>
						   <div class="form-group col-md-6">
							  <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Signature <span class="tx-danger">*</span></label>
							  <input type="file" class="filestyle" name="signature" id="signature" data-parsley-required="<?php echo ((isset($docs[$document_id_signature]))?'false':'true'); ?>" data-parsley-required-message="Please upload signature" data-parsley-errors-container="#custom-signature-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>">
							  <?php if(isset($docs[$document_id_signature])){ ?>
							  <!-- <span class='file_name  mt-3' ><a href="<?php echo base_url().$docs[$document_id_signature]['file_path'];?>" target="_blank" title="<?php echo $docs[$document_id_signature]['file_name_user']; ?>"><?php echo $docs[$document_id_signature]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
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
                                <label for="exampleFormControlTextarea1">Upload Your 10th Marksheet <span class="tx-danger">*</span></label>

                                <input type="file" class="filestyle" name="tenth_marksheet" id="tenth_marksheet" data-parsley-required="<?php echo ((isset($docs[$document_id_tenth_marksheet]))?'false':'true'); ?>" data-parsley-required-message="Please upload 10th marksheet" data-parsley-errors-container="#custom-tenth_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if (isset($docs[$document_id_tenth_marksheet])) {
                                    echo $docs[$document_id_tenth_marksheet]['id'];
                                } ?>" accept="<?php echo allow_extension($file_allowed_type); ?>">
								<?php if (isset($docs[$document_id_tenth_marksheet])) { ?>
                                        <!-- <span class='file_name  mt-3'><a class="image-popup-vertical-fit" href="<?php echo base_url() . $docs[$document_id_tenth_marksheet]['file_path']; ?>" target="_blank" title="<?php echo $docs[$document_id_tenth_marksheet]['file_name_user']; ?>"><?php echo $docs[$document_id_tenth_marksheet]['file_name_truncate']; ?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                                                    <a href="javascript:void(0)" data-del-file-id="<?php if (isset($docs[$document_id_tenth_marksheet])) {
                                      echo $docs[$document_id_tenth_marksheet]['id'];
                                     } ?>" data-doc-id="<?php echo $document_id_tenth_marksheet; ?>" data-toggle="modal" data-target="#contentDeletePop" onclick="removeClick(this)"><i class="fa fa-trash" data-field="tenth_marksheet" data-required="true" aria-hidden="true"></i></a> -->
                                    <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_tenth_marksheet; ?>">
                                        <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_tenth_marksheet; ?>')">&times;</a>
                                        <strong id="deleteMessageStatus_<?php echo $document_id_tenth_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_tenth_marksheet; ?>"></span>
                                    </div>							  
								<?php } ?>
                                <span id="custom-tenth_marksheet-parsley-error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleFormControlTextarea1">Upload Your 12th Marksheet <span class="tx-danger" id="twelfthsheet" style="display:none;">*</span> </label>

                                <input type="file" class="filestyle" name="twelvfth_marksheet" id="twelvfth_marksheet" data-parsley-required="false" data-parsley-required-message="Please upload 12th marksheet" data-parsley-errors-container="#custom-twelvfth_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if (isset($docs[$document_id_twelvfth_marksheet])) {
                                    echo $docs[$document_id_twelvfth_marksheet]['id'];
                                } ?>" accept="<?php echo allow_extension($file_allowed_type); ?>">
                                 <?php if (isset($docs[$document_id_twelvfth_marksheet])) { ?>
                                        <!-- <span class='file_name  mt-3' ><a class="image-popup-vertical-fit" href="<?php echo base_url() . $docs[$document_id_twelvfth_marksheet]['file_path']; ?>" target="_blank" title="<?php echo $docs[$document_id_twelvfth_marksheet]['file_name_user']; ?>"><?php echo $docs[$document_id_twelvfth_marksheet]['file_name_truncate']; ?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                                                   <a href="javascript:void(0)" data-del-file-id="<?php if (isset($docs[$document_id_twelvfth_marksheet])) {
                                    echo $docs[$document_id_twelvfth_marksheet]['id'];
                                } ?>" data-doc-id="<?php echo $document_id_twelvfth_marksheet; ?>" data-toggle="modal" data-target="#contentDeletePop" data-field="twelvfth_marksheet" data-required="true" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                                    <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_twelvfth_marksheet; ?>">
                                        <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_twelvfth_marksheet; ?>')">&times;</a>
                                        <strong id="deleteMessageStatus_<?php echo $document_id_twelvfth_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_twelvfth_marksheet; ?>"></span>
                                    </div>								  
                                <?php } ?>
                                <span id="custom-twelvfth_marksheet-parsley-error"></span>
                            </div>
                        </div>
				<div class="row w-100">
					 <div class="form-group col-md-6 ">
                           <label for="exampleFormControlTextarea1">Upload Your Graduation Marksheet <span class="tx-danger" style="<?php echo $markSchemeStyle;?>">*</span></label>
                           <input type="file" class="filestyle" name="graduation_marksheet" id="graduation_marksheet" data-parsley-required="<?php echo ((isset($docs[$document_id_graduation_marksheet]))?'false':'true'); ?>" data-parsley-required-message="Please upload graduation_marksheet" data-parsley-errors-container="#custom-graduation_marksheet-parsley-error"data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_graduation_marksheet])){ echo $docs[$document_id_graduation_marksheet]['id']; } ?>"accept="<?php  echo allow_extension($file_allowed_type); ?>">
                           <?php if(isset($docs[$document_id_graduation_marksheet])){ ?>
                              <!-- <span class='file_name  mt-3' ><a class="image-popup-vertical-fit" href="<?php echo base_url().$docs[$document_id_graduation_marksheet]['file_path'];?>" target="_blank" title="<?php echo $docs[$document_id_graduation_marksheet]['file_name_user']; ?>"><?php echo $docs[$document_id_graduation_marksheet]['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                              <a href="javascript:void(0)" data-del-file-id="<?php if(isset($docs[$document_id_graduation_marksheet])){ echo $docs[$document_id_graduation_marksheet]['id']; } ?>" data-doc-id="<?php echo $document_id_graduation_marksheet; ?>" data-toggle="modal" data-target="#contentDeletePop" data-field="graduation_marksheet" data-required="true" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>-->
                              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_graduation_marksheet; ?>">
                                 <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_graduation_marksheet; ?>')">&times;</a>
                                 <strong id="deleteMessageStatus_<?php echo $document_id_graduation_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_graduation_marksheet; ?>"></span>
                             </div>
                           <?php } ?>
                           <span id="custom-graduation_marksheet-parsley-error"></span>
                        </div>		
				</div>	
				
				 <div class="row w-100">
					<div class="col-md-12">
						<h5 class="text-primary mb-3">Declaration</h5>
						<p><?php echo DECLARATION;?></p>
					</div>	
				</div>
				<div class="row w-100  mt-3">
					<div class="col-md-6">
						<label class="form-control-label">Applicant Name <span class="tx-danger">*</span></label>						 
						 <input class="form-control" type="text" name="applicant_name" id="applicant_name" placeholder="Enter Applicant Name" placeholder="Enter Applicant Name" maxlength="100" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Applicant Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 100]" value="<?php echo $applicant_name; ?>">
					</div>
					<div class="col-md-6">
						<label class="form-control-label">Parent Name <span class="tx-danger">*</span></label>
						<input class="form-control" type="text" name="parent_name" id="parent_name" placeholder="Parent Name" maxlength="100" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Please Enter Parent Name" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 100]" value="<?php echo $parent_name; ?>" >
					</div>	
				</div>
				<div class="row w-100 mt-3">
					<div class="col-md-6">
						<label class="form-control-label"> Date <span class="tx-danger">*</span></label>
						 <input class="form-control" type="text" name="date_dec" id="date_dec" placeholder="Declartion Date" value="<?php echo $declared_date; ?>" readonly>
					</div>
				</div>						
			</div><!-- row -->
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
</div>