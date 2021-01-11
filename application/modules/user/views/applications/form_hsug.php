<style>
span.select2.select2-container.select2-container--bootstrap{
	width:100%!important;
}
.select2-selection.select2-selection--single[aria-labelledby="select2-board-container"] {
  width: 230px!important;
}
span.select2-selection.select2-selection--single[aria-labelledby="select2-phone_no_code-container"] {
    width: 74px!important;
	height: 35px!important;
	border-top-right-radius: unset !important;
	border-bottom-right-radius: unset !important;
}
.required_asterisk {
    position: relative;
    color: #f00;
    margin-right: 10px;
    float: right;
    margin-top: -42px;
}
.select2-container .select2-selection--single {
    height: 35px;
}
.wizard > .steps > ul > li {
    width: 150px;
}
.select2-selection.select2-selection--single[aria-labelledby="select2-institute_university-container"],
.select2-selection.select2-selection--single[aria-labelledby="select2-sector_0-container"],
.select2-selection.select2-selection--single[aria-labelledby="select2-sector_1-container"],
.select2-selection.select2-selection--single[aria-labelledby="select2-sector_2-container"]
{
  width: 140px!important
}
</style>
<div class="row">
<div class="col-sm-12"> 
<?php 
/* echo "<pre>";
print_r($applicant_campus_details_list);
echo "</pre>"; */       
$parent_type_id_father = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
$file_allowed_type = FILE_ALLOWED_TYPE;
//set personal detail
$first_name=isset($applicant_basic_details_list['f_name'])?$applicant_basic_details_list['f_name']:'';

$middle_name=isset($applicant_basic_details_list['m_name'])?$applicant_basic_details_list['m_name']:'';

$last_name=isset($applicant_basic_details_list['l_name'])?$applicant_basic_details_list['l_name']:'';

$mobile_no=isset($applicant_basic_details_list['mob_no'])?$applicant_basic_details_list['mob_no']:'';

$email_id=isset($applicant_basic_details_list['e_mail'])?$applicant_basic_details_list['e_mail']:'';

$dob=isset($applicant_basic_details_list['dob'])? date('d/m/Y',strtotime($applicant_basic_details_list['dob'])):'';
$alt_email_id=isset($applicant_basic_details_list['sec_e_mail'])?$applicant_basic_details_list['sec_e_mail']:'';

$user_id=isset($applicant_basic_details_list['user_id'])?$applicant_basic_details_list['user_id']:'';
$today=date('d/m/Y');
$digilocker_id=$parent_name="";
if($personal_detail_list){
    $digilocker_id = $personal_detail_list['data']['digilocker_id'];
}
$nad_id_digilocker_id=isset($digilocker_id)?$digilocker_id:'';

//set address
$add_line_1=isset($applicant_address_details_list['add_line_1'])?$applicant_address_details_list['add_line_1']:'';
$add_line_2=isset($applicant_address_details_list['add_line_2'])?$applicant_address_details_list['add_line_2']:'';
$pin_code=isset($applicant_address_details_list['pin_code'])?$applicant_address_details_list['pin_code']:'';

//parent detail -from other detail
$add_gardian=isset($applicant_other_details_list['add_gardian'])?$applicant_other_details_list['add_gardian']:'';
if($applicant_parent_details_list){
    foreach ($applicant_parent_details_list as $k => $parent_det){
        if($parent_det['parent_type_id']==PARENT_TYPE_ID_FATHER){
            $vartype="father";
        }
        if($parent_det['parent_type_id']==PARENT_TYPE_ID_MOTHER){
            $vartype="mother";
        }
        if($parent_det['parent_type_id']==PARENT_TYPE_ID_GUARDIAN){
            $vartype="guardian";
        }
        $parent_type_id = $parent_det['parent_type_id'];
        $app_parent_det_id[$parent_type_id] = $parent_det['app_parent_det_id'];
        
        
        $parenttype=strtolower($vartype);
        /*  $parent_name=$parent_det['parent_name'];
         $parent_mobile=$parent_det['mobile_no'];
         $parent_email_id=$parent_det['email_id'];
         $parent_occupation=$parent_det['occupation'];
         $alt_mobile_no=$parent_det['alt_mobile_no']; */
        ${ $parenttype."_name"}=$parent_det['parent_name'];
        ${ $parenttype."_mobile"}=$parent_det['mobile_no'];
        ${ $parenttype."_email"}=$parent_det['email_id'];
        ${ $parenttype."_occupation"}=$parent_det['occupation'];
        ${ $parenttype."_other_occupation"}=$parent_det['other_occupation_name'];
        ${ $parenttype."_alt_mobile"}=$parent_det['alt_mobile_no'];
        
    }
    
    //set empty val
    $father_name=isset($father_name) ? $father_name:'';
    $father_mobile=isset($father_mobile) ? $father_mobile:'';
    $father_email=isset($father_email) ? $father_email:'';
    $father_occupation=isset($father_occupation) ? $father_occupation:'';
    $father_alt_mobile=isset($father_alt_mobile) ? $father_alt_mobile:'';
    $father_other_occupation=isset($father_other_occupation) ? $father_other_occupation:'';
    
    $mother_name=isset($mother_name) ? $mother_name:'';
    $mother_mobile=isset($mother_mobile) ? $mother_mobile:'';
    $mother_email=isset($mother_email) ? $mother_email:'';
    $mother_occupation=isset($mother_occupation) ? $mother_occupation:'';
    $mother_alt_mobile=isset($mother_alt_mobile) ? $mother_alt_mobile:'';
    $mother_other_occupation=isset($mother_other_occupation) ? $mother_other_occupation:'';
    
    $guardian_name=isset($guardian_name) ? $guardian_name:'';
    $guardian_mobile=isset($guardian_mobile) ? $guardian_mobile:'';
    $guardian_email=isset($guardian_email) ? $guardian_email:'';
    $guardian_occupation=isset($guardian_occupation) ? $guardian_occupation:'';
    $guardian_other_occupation=isset($guardian_other_occupation) ? $guardian_other_occupation:'';
    $guardian_alt_mobile=isset($guardian_alt_mobile) ? $guardian_alt_mobile:'';
}

$name_as_in_marksheet = isset($applicant_schooling_list[0]['name_as_in_marksheet']) ? $applicant_schooling_list[0]['name_as_in_marksheet'] : '';

//get ug pg value
$is_work_experience = $applicant_other_details_list['is_work_experience'];
$canditate_name = $applicant_basic_details_list['name_in_marksheet'];
$result_declare_date = date('m/Y', strtotime($applicant_other_details_list['expectedmonthyearresult']));
$total_work_exp = $applicant_other_details_list['total_work_exp'];
if($applicant_prof_exps_list) {
    foreach($applicant_prof_exps_list as $k=>$v) {
        // $applicant_prof_exp_id[] = $v['applicant_prof_exp_id'];
        $applicant_prof_exp_id[] = $v['exp_id'];
        $applicant_prof_exp_org_name[] = $v['org_name'];
        $applicant_prof_exp_designation[] = $v['designation'];
        $applicant_prof_exp_sector_id[] = $v['sector_id'];
        $other_sector[] = $v['other_sector_name'];
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

/*
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
$cur_qual_completed = $applicant_graduations_list['result_declared'];
*/
$applicant_schooling_det_board_id          = $applicant_schooling_list['board_id'];
$applicant_schooling_det_insti_name        = $applicant_schooling_list['inst_name'];
$applicant_schooling_det_registration_no   = $applicant_schooling_list['registration_no'];
$applicant_schooling_det_mark_scheme_id    = $applicant_schooling_list['mark_scheme_id'];
$applicant_schooling_det_mark_scheme_name  = $applicant_schooling_list['mark_scheme_name'];
$applicant_schooling_det_mark_percent      = $applicant_schooling_list['mark_percentage'];
$applicant_schooling_det_completion_year   = $applicant_schooling_list['completion_year'];
$applicant_schooling_det_other_board_name  = $applicant_schooling_list['other_board_name'];
$applicant_schooling_det_result_declared   = $applicant_schooling_list['result_declared'];
$applicant_schooling_det_address   = $applicant_schooling_list['address'];



//set name for decalaration
$applicant_name=isset($applicant_name) ?$applicant_name : $first_name;
$parent_name=isset($parent_name) ?$parent_name : $father_name;

$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_tenth_marksheet = DOCUMENT_ID_TENTH_MARKSHEET;
$document_id_twelvfth_marksheet = DOCUMENT_ID_TWELVFTH_MARKSHEET;
$document_id_additional_qualification = DOCUMENT_ID_ADDITIONAL_QUALIFICATION;
$document_id_graduation_marksheet = DOCUMENT_ID_GRADUATION_MARKSHEET;

if($applicant_campus_details_list) {
    foreach($applicant_campus_details_list as $k=>$v) {
        if($v['choice_no']==1){
            $campus_choice_no_1=$v['choice_no'];
            $campus_prefer_id_1=$v['applicant_campus_prefer_id'];
        }
        if($v['choice_no']==2){
            $campus_choice_no_2=$v['choice_no'];
            $campus_prefer_id_2=$v['applicant_campus_prefer_id'];
        }
        if($v['choice_no']==3){
            $campus_choice_no_3=$v['choice_no'];
            $campus_prefer_id_3=$v['applicant_campus_prefer_id'];
        }
        
    }
}

if($applicant_course_details_list) {
    foreach($applicant_course_details_list as $k=>$v) {
        if($v['choice_no']==1){
            $course_choice_no_1=$v['choice_no'];
            $course_prefer_id_1=$v['applicant_course_id'];
        }
        if($v['choice_no']==2){
            $course_choice_no_2=$v['choice_no'];
            $course_prefer_id_2=$v['applicant_course_id'];
        }
        if($v['choice_no']==3){
            $course_choice_no_3=$v['choice_no'];
            $course_prefer_id_3=$v['applicant_course_id'];
        }
        
    }
}

$campus_choice_no_1=isset($campus_choice_no_1)?$campus_choice_no_1:1;
$campus_choice_no_2=isset($campus_choice_no_2)?$campus_choice_no_2:2;
$campus_choice_no_3=isset($campus_choice_no_3)?$campus_choice_no_3:3;

$campus_prefer_id_1=isset($campus_prefer_id_1)?$campus_prefer_id_1:'';
$campus_prefer_id_2=isset($campus_prefer_id_2)?$campus_prefer_id_2:'';
$campus_prefer_id_3=isset($campus_prefer_id_3)?$campus_prefer_id_3:'';

$course_choice_no_1=isset($course_choice_no_1)?$course_choice_no_1:1;
$course_choice_no_2=isset($course_choice_no_2)?$course_choice_no_2:2;
$course_choice_no_3=isset($course_choice_no_3)?$course_choice_no_3:3;

$course_prefer_id_1=isset($course_prefer_id_1)?$course_prefer_id_1:'';
$course_prefer_id_2=isset($course_prefer_id_2)?$course_prefer_id_2:'';
$course_prefer_id_3=isset($course_prefer_id_3)?$course_prefer_id_3:'';

//fetch upload list
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
//end fetch list

if($applicant_application_details_list){
    $i_confirmChecked=$applicant_application_details_list[0]['is_agree'];
    $studied_from_india=$applicant_application_details_list[0]['qualifyingexamfromindia'];
}
$form_wizard_basic_id = FORM_WIZARD_BASIC_ID;
$form_wizard_preference_personal_id = FORM_WIZARD_PERSONAL_ID;
$form_wizard_parent_address_id = FORM_WIZARD_PARENT_ID;
$form_wizard_address_id = FORM_WIZARD_ADDRESS_ID;
$form_wizard_academic_id = FORM_WIZARD_ACADEMIC_ID;
$form_wizard_payment_id = FORM_WIZARD_PAYMENT_ID;
$form_wizard_upload_id = FORM_WIZARD_UPLOAD_ID;
$form_wizard_declaration_id = FORM_WIZARD_DECLARATION_ID;

/* Basic Detail Instructions Start */
$applicant_basic_wizard_id = $applicant_instructions_list[$form_wizard_basic_id][0]['form_w_wizard_id'];
$applicant_basic_wizard_instructions = $applicant_instructions_list[$form_wizard_basic_id][0]['instruction'];
$applicant_basic_wizard_instructions = !empty($applicant_basic_wizard_instructions) ? nl2br($applicant_basic_wizard_instructions) : '-';

$applicant_pref_per_wizard_id = $applicant_instructions_list[$form_wizard_preference_personal_id][0]['form_w_wizard_id'];
$applicant_pref_per_wizard_instructions = $applicant_instructions_list[$form_wizard_preference_personal_id][0]['instruction'];
$applicant_pref_per_wizard_instructions = !empty($applicant_pref_per_wizard_instructions) ? nl2br($applicant_pref_per_wizard_instructions) : '-';

/* Parent Instructions Start */
$applicant_parent_address_wizard_id = $applicant_instructions_list[$form_wizard_parent_address_id][0]['form_w_wizard_id'];
$applicant_parent_address_wizard_instructions = $applicant_instructions_list[$form_wizard_parent_address_id][0]['instruction'];
$applicant_parent_address_wizard_instructions = !empty($applicant_parent_address_wizard_instructions) ? nl2br($applicant_parent_address_wizard_instructions) : '-';
/* Parent Instructions End */

/* Address Instructions Start */
$applicant_address_wizard_id = $applicant_instructions_list[$form_wizard_address_id][0]['form_w_wizard_id'];
$applicant_address_wizard_instructions = $applicant_instructions_list[$form_wizard_address_id][0]['instruction'];
$applicant_address_wizard_instructions = !empty($applicant_address_wizard_instructions) ? nl2br($applicant_address_wizard_instructions) : '-';
/* Address Instructions End */

/* Academic Instructions Start */
$applicant_academic_wizard_id = $applicant_instructions_list[$form_wizard_academic_id][0]['form_w_wizard_id'];
$applicant_academic_wizard_instructions = $applicant_instructions_list[$form_wizard_academic_id][0]['instruction'];
$applicant_academic_wizard_instructions = !empty($applicant_academic_wizard_instructions) ? nl2br($applicant_academic_wizard_instructions) : '-';
/* Academic Instructions End */
/* Payment Instructions Start */
$applicant_payment_wizard_id = $applicant_instructions_list[$form_wizard_payment_id][0]['form_w_wizard_id'];
$applicant_payment_wizard_instructions = $applicant_instructions_list[$form_wizard_payment_id][0]['instruction'];
$applicant_payment_wizard_instructions = !empty($applicant_payment_wizard_instructions) ? nl2br($applicant_payment_wizard_instructions) : '-';
/* Payment Instructions End */

/* Upload Instructions Start */
$applicant_upload_wizard_id = $applicant_instructions_list[$form_wizard_upload_id][0]['form_w_wizard_id'];
$applicant_upload_wizard_instructions = $applicant_instructions_list[$form_wizard_upload_id][0]['instruction'];
$applicant_upload_wizard_instructions = !empty($applicant_upload_wizard_instructions) ? nl2br($applicant_upload_wizard_instructions) : '-';
/* Upload Instructions End */

/* Declaration Instructions Start */
$applicant_declaration_wizard_id = $applicant_instructions_list[$form_wizard_declaration_id][0]['form_w_wizard_id'];
$applicant_declaration_wizard_instructions = $applicant_instructions_list[$form_wizard_declaration_id][0]['instruction'];
$applicant_declaration_wizard_instructions = !empty($applicant_declaration_wizard_instructions) ? nl2br($applicant_declaration_wizard_instructions) : '-';
/* Declaration Instructions End */

$applicant_basic_wizard_percent = $applicant_instructions_list[$form_wizard_basic_id][0]['completion_percent'];
$applicant_pref_per_wizard_percent = $applicant_instructions_list[$form_wizard_preference_personal_id][0]['completion_percent'];
$applicant_parent_address_wizard_percent = $applicant_instructions_list[$form_wizard_parent_address_id][0]['completion_percent'];
$applicant_parent_address_wizard_percent = $applicant_instructions_list[$form_wizard_address_id][0]['completion_percent'];
$applicant_academic_wizard_percent = $applicant_instructions_list[$form_wizard_academic_id][0]['completion_percent'];
$applicant_payment_wizard_percent = $applicant_instructions_list[$form_wizard_payment_id][0]['completion_percent'];
$applicant_upload_wizard_percent = $applicant_instructions_list[$applicant_upload_wizard_id][0]['completion_percent'];
$applicant_declaration_wizard_percent = $applicant_instructions_list[$form_wizard_declaration_id][0]['completion_percent'];


/* Basic Detail Instructions End */

/* Payment Details Start */
$branch_name = $payment_details_list['branch_name'];
$dd_cheque_no = $payment_details_list['dd_cheque_no'];
$dd_cheque_date = $payment_details_list['dd_cheque_date'];
if($dd_cheque_date) {
    $dd_cheque_date = date('m/d/Y',strtotime($dd_cheque_date));
}
$payment_mode_id = $payment_details_list['payment_mode_id'];
/* Payment Details End */

$appln_form_fee = $applicant_application_details_list[0]['appln_form_fee'];
$applicant_name=!empty($applicant_application_details_list[0]['applicant_name_declaration'])?$applicant_application_details_list[0]['applicant_name_declaration']:$first_name;
$parent_name=!empty($applicant_application_details_list[0]['applicant_parentname_declaration'])?$applicant_application_details_list[0]['applicant_parentname_declaration']:$father_name;
$declared_date=!empty($applicant_application_details_list[0]['applicant_declaration_date'])?date('d/m/Y',strtotime($applicant_application_details_list[0]['applicant_declaration_date'])):date("d/m/Y");
$application_status_id = $applicant_application_details_list[0]['application_status_id'];

$attributes = array('class' => 'form-horizontal form-wizard-wrapper .custom-validation', 'id' => 'hsug_form', 'name' => 'hsug_form', 'enctype' => 'multipart/form-data', 'data-parsley-validate data-toggle'=>"validator");
?>
<div class="row">
 <div class="col-sm-12">
 <?php echo form_open('', $attributes);?>                                        
<!-- <div class="float-right"><button class="btn btn-primary">Step 1 of 7</button></div> -->
<div class="loader" style="display:none;">
</div>
<div id="formerr" style="display:none;color:red">
 Something went to wrong.Please try again later.
 </div>
<div class="mb-3">
    <div class="progress">
     <div class="progress-bar" id="percentage_bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
    </div>
</div>

<h3 class="wizard_head_tag">Basic Details</h3>
<div class="text-right w-100">
		<button class="btn btn-primary">Step <span id='show_currentindex'></span></button>
</div>
<fieldset>
            <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
                <div class="card ">
                    <div class="card-header p-0 " role="tab" id="headingOne">
                        <h6 class="p-2 ml-3">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed">
                                <i class="fas fa-info-circle"></i> Instructions</a>
                        </h6>
                    </div><!-- card-header -->

                    <div id="collapseOne" class="collapse bg-light show" role="tabpanel" aria-labelledby="headingOne" style="">
                        <div class="card-body" style="font-size: 13px;">
                            <?php echo $applicant_basic_wizard_instructions;?>
                        </div>
                    </div>
                </div>

                <!-- card -->
            </div>
            <div class="w-100 pd-20 pd-sm-40">		
                <div class="form-layout">
                     <div class="row mg-b-25 mt-3">
                        <div class="col-lg-6">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Have you studied 10+2 from India? <span
                                        class="tx-danger">*</span></label>
                                <select class="form-control custom-select" name="studied_from_india" id="studied_from_india" title="Select Status - Yes or No" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_GRAD_STATUS_MSG; ?>" data-parsley-errors-container="#custom-studied_from_india-parsley-error">
                                    <option value="">Select Status - Yes or No</option>
                                </select>
                                <span id="custom-studied_from_india-parsley-error"></span>	
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group mg-b-10-force" id="resident_status" style="display:none;">
                                <label class="form-control-label">Resident Status 
                                    <span class="tx-danger">*</span></label>
                                <select class="form-control custom-select" name="non_indian_resident" id="non_indian_resident" title="Select Resident Status" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_RESIDENT_STATUS_MSG; ?>" data-parsley-errors-container="#custom-non_indian_resident-parsley-error">
                                    <option value="">Select Category</option>
                                    <option value="nonresident">Non Resident Indian </option>
                                    <option value="foreign">Foreign </option>
                                </select>
                                <span id="custom-non_indian_resident-parsley-error"></span>
                                <span id="halterror" style="display:none;">Can't Proceed. Please read instruction below</span>
                            </div>
                        </div><!-- col-4 -->
						<input type="hidden" name="appln_status" id="appln_status" value="<?php echo $application_status_id; ?>">
                    </div>
                    <div class="row mg-b-25 mt-3">
                        <div class="col-lg-12">
                            <div class="form-group mt-1" id="indian" style="display:none;" >
                                <p> <span class="tx-danger">*</span> 
                                    Please note that you have selected "YES" for the above which implies you are eligible to seek admission under domestic category. It is the sole responsibility of the candidate to ensure that he/she is applying under the right category.</p>
                                <span id="custom-confirm_study_residency_checkbox-parsley-error"></span>
                                <div class="custom-control custom-checkbox">
                                <?php
                                $checkedval = "0";
                                if ($i_confirmChecked && $i_confirmChecked === 't') {
                                    $checkedval = "1";
                                }
                                ?>
                                    <input class="custom-control-input" value="<?php echo $checkedval; ?>" type="checkbox" name="i_confirm" id="i_confirm" value="0"  data-parsley-required="false" data-parsley-required-message="<?php echo REQD_CHECK_CONFIRM_MSG; ?>" ><label class="custom-control-label" for="i_confirm">I Confirm </label>
                                </div>
                                <span id="custom-i_confirm-parsley-error"></span>
                            </div>
                            <div class="form-group formAreaCols"  id="non-indian" style="display:none;">
                                <p>Foreign and NRI students please go to the below link to proceed further.</p>
                                <a target="_blank"
                                   href="https://intlapplications.srmist.edu.in/international-application-form-2020"><b>https://intlapplications.srmist.edu.in/international-application-form-2020</b></a>
                            </div>
                        </div>
                    </div>


                </div><!-- form-layout -->
            </div>
</fieldset>
<h3 class="wizard_head_tag">Preferences and <br/>Personal Details</h3>
<fieldset>
<div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
	<div class="card ">
		<div class="card-header p-0 " role="tab" id="headingOne">
			<h6 class="p-2 ml-3">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed">
					<i class="fas fa-info-circle"></i>Instructions</a>
			</h6>
		</div><!-- card-header -->

		<div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
			<div class="card-body" style="font-size: 13px;">
			<div class="accordion-inner">
					<?php echo $applicant_pref_per_wizard_instructions; ?>
           </div>
		</div>
	</div>

	<!-- card -->
</div>
<div class="w-100 pd-20 pd-sm-40">
	<h5 class="text-primary mb-3">Select Campus and Course Preference</h5><hr/>
	<div class="form-layout">		
		<div class="row mg-b-25 mt-12 campus_course_div">			
			<div class="col-lg-6">
                <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Campus Preference 1 <span
                            class="tx-danger">*</span></label>
                   <select class="form-control custom-select study" data-placeholder="Select Campus Preference 1" tabindex="-1" aria-hidden="true" name="campus_pref_1" id="campus_pref_1" title="Select Campus Preference 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_CAMPUS_PREFERENCE1_MSG; ?>" data-parsley-errors-container="#custom-campus_pref_1-parsley-error" data-parsley-trigger="change">
                        <option value="">Select Campus Preference  </option>
                    </select>
                     <span id="custom-campus_pref_1-parsley-error"></span>
                     <input type="hidden" name="campus_choice_no_1" id="campus_choice_no_1" value="<?php echo $campus_choice_no_1;?>" />
                     <input type="hidden" name="campus_prefer_id_1" id="campus_prefer_id_1" value="<?php echo $campus_prefer_id_1;?>" />
                </div>
            </div>
		</div>		
		<div class="row mg-b-25 mt-12 campus_course_div">	
		<div class="col-lg-4" id="main_div_course_prefer_1" style="display:none;">
				<div class="form-group mg-b-10-force">
                            <label class="form-control-label">Course Preference 1 <span class="tx-danger">*</span>
                                </label>
                            <select class="form-control custom-select study course_sel" data-placeholder="Select Course Preference 1" tabindex="-1" aria-hidden="true" name="course_pref_1" id="course_pref_1" title="Select Course Preference 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_COURSE_PREFERENCE1_MSG; ?>" data-parsley-errors-container="#custom-course_pref_1-parsley-error" data-parsley-trigger="change" onchange="course_pref_change('course_pref_1','Select Course Preference 1')">
                                <option value="">Select Course Preference 1</option>
                            </select>
                            <span id="custom-course_pref_1-parsley-error"></span>
                   <input type="hidden" name="course_choice_no_1" id="course_choice_no_1" value="<?php echo $course_choice_no_1; ?>" />
                   <input type="hidden" name="course_prefer_id_1" id="course_prefer_id_1" value="<?php echo $course_prefer_id_1 ?>" />
                  </div>
                       
			</div><!-- col-4 -->
			<div class="col-lg-4" id="main_div_course_prefer_2" style="display:none;">
				 <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Course Preference 2  </label>
                            <select class="form-control custom-select study course_sel" data-placeholder="Select Course Preference 2" tabindex="-1" aria-hidden="true" name="course_pref_2" id="course_pref_2" title="Select Course Preference 2" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_COURSE_PREFERENCE2_MSG; ?>" data-parsley-errors-container="#custom-course_pref_2-parsley-error" data-parsley-trigger="change" onchange="course_pref_change('course_pref_2','Select Course Preference 2')">
                                <option value="">Select Course Preference 2</option>
                            </select>
                            <span id="custom-course_pref_2-parsley-error"></span>
                    <input type="hidden" name="course_choice_no_2" id="course_choice_no_2" value="<?php echo $course_choice_no_2; ?>" />
                    <input type="hidden" name="course_prefer_id_2" id="course_prefer_id_2" value="<?php echo $course_prefer_id_2; ?>" />
                    
		          </div>
             </div>
			 <div class="col-lg-4" id="main_div_course_prefer_3" style="display:none;">
				   <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Course Preference 3</label>
                            <select class="form-control custom-select study course_sel" data-placeholder="Select Course Preference 3" tabindex="-1" aria-hidden="true" name="course_pref_3" id="course_pref_3" title="Select Course Preference 3" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_COURSE_PREFERENCE3_MSG; ?>" data-parsley-errors-container="#custom-course_pref_3-parsley-error" data-parsley-trigger="change" onchange="course_pref_change('course_pref_3','Select Course Preference 3')">
                                <option value="">Select Course Preference 3</option>
                            </select>
                            <span id="custom-course_pref_3-parsley-error"></span>
                            <span class="custom-field-error" id="custom-field-course-error" ></span>
                     <input type="hidden" name="course_choice_no_3" id="course_choice_no_3" value="<?php echo $course_choice_no_3; ?>" />
                     <input type="hidden" name="course_prefer_id_3" id="course_prefer_id_3" value="<?php echo $course_prefer_id_3; ?>" />
                  </div>                              
			</div>
		</div>
		
		<hr/>
		 <h5 class="text-primary mt-4 mb-3">Test City Perferences</h5>
           
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Test State Perferences 1 <span class="tx-danger">*</span></label>
                            <select class="form-control select2 test_state" data-placeholder="Select Test State Perferences 1" tabindex="-1" aria-hidden="false" name="state_pref_1" id="state_pref_1" title="Select Test State Perferences 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_STATE_PREFERENCE1_MSG; ?>" data-parsley-errors-container="#custom-state_pref_1-parsley-error" data-parsley-trigger="change">
                              <option value="">Select Test State Perferences 1</option>
                            </select>
                            <span id="custom-state_pref_1-parsley-error"></span>
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6" id="main_div_city_pref_1" style="display:none">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Test City Perferences 1<span class="tx-danger">*</span></label>
                            <select class="form-control select2 test_city" data-placeholder="Select Test City Perferences 1" tabindex="-1" aria-hidden="true" name="city_pref_1" id="city_pref_1" title="Select Test City Perferences 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_CITY_PREFERENCE1_MSG; ?>" data-parsley-errors-container="#custom-city_pref_1-parsley-error" onchange="test_city_pref_change('state_pref_1','city_pref_1')">
                              <option value="">Select Test City Perferences 1</option>
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
                            <select class="form-control select2 test_state" data-placeholder="Select Test State Perferences 2" tabindex="-1" aria-hidden="true" name="state_pref_2" id="state_pref_2" title="Select Test State Perferences 2" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_STATE_PREFERENCE2_MSG; ?>" data-parsley-errors-container="#custom-state_pref_2-parsley-error" data-parsley-trigger="change">
                              <option value="">Select Test State Perferences 2</option>
                            </select>
                            <span id="custom-state_pref_2-parsley-error"></span>
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6" id="main_div_city_pref_2" style="display:none">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Test City Perferences 2</label>
                            <select class="form-control select2 test_city" data-placeholder="Select Test City Perferences 2" tabindex="-1" aria-hidden="true" name="city_pref_2" id="city_pref_2" title="Select Test City Perferences 2" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_CITY_PREFERENCE2_MSG; ?>" data-parsley-errors-container="#custom-city_pref_2-parsley-error" data-parsley-trigger="change" onchange="test_city_pref_change('state_pref_2','city_pref_2')">
                              <option value="">Select Test City Perferences 2</option>
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
                            <select class="form-control select2 test_state" data-placeholder="Select Test State Perferences 3" tabindex="-1" aria-hidden="true" name="state_pref_3" id="state_pref_3" title="Select Test State Perferences 3" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_STATE_PREFERENCE3_MSG; ?>" data-parsley-errors-container="#custom-state_pref_2-parsley-error" data-parsley-trigger="change">
                              <option value="">Select Test State Perferences 3</option>
                            </select>
                            <span id="custom-state_pref_3-parsley-error"></span>
                        </div>
                    </div><!-- col-6 -->
                    <div class="col-lg-6" id="main_div_city_pref_3" style="display:none">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Test City Perferences 3</label>
                            <select class="form-control select2 test_city" data-placeholder="Select Test City Perferences 3" tabindex="-1" aria-hidden="true" name="city_pref_3" id="city_pref_3" title="Select Test City Perferences 3" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_CITY_PREFERENCE3_MSG; ?>" data-parsley-errors-container="#custom-city_pref_3-parsley-error" data-parsley-trigger="change" onchange="test_city_pref_change('state_pref_3','city_pref_3')">
                              <option value="">Select Test City Perferences 3</option>
                            </select>
                            <span id="custom-city_pref_3-parsley-error"></span>
                        </div>
                        <input type="hidden" name="city_choice_no_3" id="city_choice_no_3" value="<?php echo (isset($applicant_city_choice_no[1]))?$applicant_city_choice_no[1]:'2'; ?>" />
                        <input type="hidden" name="city_prefer_id_3" id="city_prefer_id_3" value="<?php echo (isset($applicant_city_id[1]))?$applicant_city_id[1]:''; ?>" />
                    </div><!-- col-6 -->
                </div>
	</div><!-- form-layout -->
</div>

<div class="w-100 pd-20 pd-sm-40">
		<h5 class="text-primary mb-3">Personal Details</h5>
		<div class="form-layout">
			<div class="row mg-b-25">
				<div class="col-lg-4">
					<div class="form-group mg-b-10-force">
					  <label class="form-control-label">Title<span class="tx-danger"> *</span></label>
					  <select class="form-control select2" data-placeholder="Select Title" tabindex="-1" aria-hidden="true" name="pd_title" id="pd_title" title="Select Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG; ?>" data-parsley-errors-container="#custom-pd_title-parsley-error" data-parsley-trigger="change">
						  <option value="">Select</option>
					  </select>
					  <span id="custom-pd_title-parsley-error"></span>
					</div>
				</div><!-- col-4 -->
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">First Name <span class="tx-danger"> *</span></label>
						<input class="form-control" type="text" name="pd_firstname" id="pd_firstname" placeholder="Enter First Name" placeholder="Your First Name" maxlength="<?php echo APLCT_FIRST_NAME_MAXLENGTH;?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_FIRST_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_FIRST_NAME_MINLENGTH;?>, <?php echo APLCT_FIRST_NAME_MAXLENGTH;?>]" value="<?php echo $first_name; ?>">
					</div>
				</div><!-- col-4 -->
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">Middle Name </label>
						<input class="form-control" type="text" name="pd_middlename" id="pd_middlename" placeholder="Your Middle Name" placeholder="Your Last Name" maxlength="<?php echo APLCT_MIDDLE_NAME_MAXLENGTH;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_MIDDLE_NAME_MINLENGTH;?>, <?php echo APLCT_MIDDLE_NAME_MAXLENGTH;?>]" value="<?php echo $middle_name; ?>">
					</div>
				</div><!-- col-4 -->
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">Last Name <span class="tx-danger"> *</span></label>
						<input class="form-control" type="text" name="pd_lastname"  id="pd_lastname" placeholder="Your Last Name" maxlength="<?php echo APLCT_LAST_NAME_MAXLENGTH;?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_LAST_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_LAST_NAME_MINLENGTH;?>, <?php echo APLCT_LAST_NAME_MAXLENGTH;?>]" data-parsley-pattern="/^[a-zA-Z.]*$/" value="<?php echo $last_name; ?>">
						<span>Use . (dot), if you have no last name.</span>
					</div>
					
				</div><!-- col-4 -->
				<div class="col-lg-4">
					<label class="form-control-label">Mobile Number <span class="tx-danger"> *</span></label>
						<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
						  <select class="form-control form_control custom-select Mobile_number" id="phone_no_code" name="phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
							  <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>
							  <option value="Law">Law</option>
							  <option value="Other">Other</option>
						  </select>
							</span>
							<input type="number" name="pd_mobile_no" id="pd_mobile_no" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Mobile No" class="form-control" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOBILE_MSG; ?>" data-parsley-mobileonly="true" data-parsley-errors-container="#custom-pd_mobile_no-parsley-error" value="<?php echo $mobile_no; ?>">
						</div>
					<span id="custom-pd_mobile_no-parsley-error"></span>	
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">Email ID <span class="tx-danger"> *</span></label>
						<input readonly  class="form-control" type="email" name="pd_email" id="pd_email" placeholder="Your email id." data-parsley-required="true" data-parsley-required-message="<?php echo REQD_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_email-parsley-error" value="<?php echo $email_id; ?>" maxlength="<?php echo APLCT_EMAIL_MAXLENGTH;?>">
						<span id="custom-pd_email-parsley-error"></span>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="wd-200 w-100">
						<label class="form-control-label">Date of Birth <span class="tx-danger"> *</span></label>
						<div class="input-group"><span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
						<input class="form-control hasDatepicker" name="pd_dob" id="pd_dob" placeholder="MM/DD/YYYY" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DOB_MSG; ?>" data-parsley-errors-container="#custom-pd_dob-parsley-error" value="<?php echo  $dob; ?>">
						</div>
					</div>
					<span id="custom-pd_dob-parsley-error"></span>
				</div>
				<div class="col-lg-4">
					<div class="form-group mg-b-10-force">
						<label class="form-control-label">Gender <span class="tx-danger"> *</span></label>
						<select class="form-control select2" data-placeholder="Select Gender" tabindex="-1" aria-hidden="true" name="pd_gender" id="pd_gender" title="Select Gender" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_GENDER_MSG; ?>" data-parsley-errors-container="#custom-pd_gender-parsley-error">
						<option value="">Select</option>
						</select>
						<span id="custom-pd_gender-parsley-error"></span>
					</div>
				</div><!-- col-4 -->
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">Alternate Email ID </label>
						<input class="form-control" type="email" name="pd_alt_email" id="pd_alt_email" placeholder="Alternate Email" data-parsley-required="false" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Alternate Email ID" data-parsley-errors-container="#custom-pd_alt_email-parsley-error" value="<?php echo $alt_email_id; ?>" data-parsley-notequalto="#pd_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH; ?>" maxlength="<?php echo APLCT_ALT_EMAIL_MAXLENGTH;?>">
						<span id="custom-pd_alt_email-parsley-error"></span>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="form-group mg-b-10-force">
						<label class="form-control-label">Blood Group <span class="tx-danger"> *</span></label>
						<select class="form-control select2" data-placeholder="Select Blood Group" tabindex="-1" aria-hidden="true" name="pd_blood_group" id="pd_blood_group" title="Select Blood Group" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BLOOD_GRP_MSG; ?>" data-parsley-errors-container="#custom-pd_blood_group-parsley-error">
						<option value="">Select</option>
						</select>
						<span id="custom-pd_blood_group-parsley-error"></span>
					</div>
				</div>	

				<div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Religion</label>
                        <select class="form-control select2" data-placeholder="Select Religion" tabindex="-1" aria-hidden="true" name="pd_religion" id="pd_religion" title="Select Religion" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_RELIGION_MSG; ?>" data-parsley-errors-container="#custom-pd_religion-parsley-error">
                         <option value="">Select</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Mother Tongue</label>
                        <select class="form-control select2" data-placeholder="Select Mother Tongue" tabindex="-1" aria-hidden="true" name="pd_mother_tongue" id="pd_mother_tongue" title="Select Mother Tongue" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_TONGUE_MSG; ?>" data-parsley-errors-container="#custom-pd_mother_tongue-parsley-error">
                         <option value="">Select Mother Tongue</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Medium of Instruction</label>
                        <select class="form-control select2" data-placeholder="Select Medium of Instruction" tabindex="-1" aria-hidden="true" name="pd_medium_of_instruction" id="pd_medium_of_instruction" title="Select Medium of Instruction" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MEDIUM_INSTR_MSG; ?>" data-parsley-errors-container="#custom-pd_medium_of_instruction-parsley-error" data-parsley-trigger="change">
                                <option value="">Select Medium of Instruction</option>
                            </select>
                        <span id="custom-pd_medium_of_instruction-parsley-error"></span>
                       
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Hostel Accommodation</label>
                       <select class="form-control select2" data-placeholder="Select Hostel Accommodation" tabindex="-1" aria-hidden="true" name="pd_hostel_accommodation" id="pd_hostel_accommodation" title="Select Hostel Accommodation" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_HOSTEL_ACCOM_MSG; ?>" data-parsley-errors-container="#custom-pd_hostel_accommodation-parsley-error" data-parsley-trigger="change">
                          <option value="">Select Hostel Accommodation</option>
                        </select>
                        <span id="custom-pd_hostel_accommodation-parsley-error"></span>
                    </div>
                </div><!-- col-4 -->
                 <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Are You Differently Abled ? <span class="tx-danger">*</span></label>
                         <select class="form-control select2" data-placeholder="Select differently abled status" tabindex="-1" aria-hidden="true" name="pd_diffrently_abled" id="pd_diffrently_abled" title="Select Differently abled status" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DIFF_ABLED_MSG; ?>" data-parsley-errors-container="#custom-pd_diffrently_abled-parsley-error">
                           <option value="">Select - Yes/No</option>
                         </select>
                         <span id="custom-pd_diffrently_abled-parsley-error"></span>
                    </div>
                </div><!-- col-4 -->                    
    
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Where Did You See Admission Advertisement ? </label>
                         <select class="form-control select2" data-placeholder="Select where seen advertisement" tabindex="-1" aria-hidden="true" name="pd_advertisement_source" id="pd_advertisement_source" title="Select where seen advertisement" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_ADVERTISE_MSG; ?>" data-parsley-errors-container="#custom-pd_advertisement_source-parsley-error">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <span id="custom-pd_advertisement_source-parsley-error"></span>
                </div><!-- col-4 --> 
                
                 <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Nationality <span class="tx-danger">*</span></label>
                       <select class="form-control select2" data-placeholder="Select Nationality" tabindex="-1" aria-hidden="true" name="pd_nationality" id="pd_nationality" title="Select Nationality" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_NATION_MSG; ?>" data-parsley-errors-container="#custom-pd_nationality-parsley-error">
                            <option value="">Select Nationality</option>
                        </select>
                        <span id="custom-pd_nationality-parsley-error"></span>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4" id="main_div_social_status">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Community <span
                                class="tx-danger">*</span></label>
                        <select class="form-control select2" data-placeholder="Select Community" tabindex="-1" aria-hidden="true" name="pd_social_status" id="pd_social_status" title="Select Community" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_COMMUNITY_MSG; ?>" data-parsley-errors-container="#custom-pd_social_status-parsley-error" data-parsley-trigger="change"> 
                          <option value="">Select Your Social Status</option>
                        </select>
                        <span id="custom-pd_social_status-parsley-error"></span>
                    </div>
                     
                </div><!-- col-4 -->     

			</div><!-- row -->
		</div><!-- form-layout -->
	</div>
</fieldset>
<h3 class="wizard_head_tag">Parent's Details</h3>
<fieldset>
            <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
                <div class="card ">
                    <div class="card-header p-0 " role="tab" id="headingOne">
                        <h6 class="p-2 ml-3">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed">
                                <i class="fas fa-info-circle"></i> Instructions</a>
                        </h6>
                    </div><!-- card-header -->

                    <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                        <div class="card-body" style="font-size: 13px;">
                            <?php echo $applicant_parent_address_wizard_instructions;?>
                        </div>
                    </div>
                </div>

                <!-- card -->
            </div>
            <div class="w-100 pd-20 pd-sm-40">
                <h5 class="text-primary mb-3 mt-4">Father's Details</h5>
                <div class="form-layout">
                    <div class="row mg-b-25 mt-3">
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Title<span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="Select Title" tabindex="-1" aria-hidden="true" name="pd_father_title" id="pd_father_title" title="Select Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG; ?>" data-parsley-errors-container="#custom-pd_father_title-parsley-error" >
                                    <option value="">Select</option>
                                </select>
                                <span id="custom-pd_father_title-parsley-error"></span>
                                <input type="hidden" name="pd_father_id" id="pd_father_id" value="<?php echo $app_parent_det_id[$parent_type_id_father]; ?>" />
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Father's Name <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="pd_father_name" id="pd_father_name" placeholder="Enter Your Father Name" maxlength="<?php echo APLCT_FATHER_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_FATHER_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_FATHER_NAME_MINLENGTH; ?>, <?php echo APLCT_FATHER_NAME_MAXLENGTH; ?>]" value="<?php echo $father_name; ?>">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4" id="father_mbleno_div" style="display:none;">
                            <label class="form-control-label">Father's Mobile Number
                            </label>
                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                    <select class="form-control form_control custom-select Mobile_number" id="pd_father_phone_no_code" name="pd_father_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                        <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>

                                    </select>
                                </span>
                                <input type="text" value="<?php echo $father_mobile; ?>" class="form-control" name="pd_father_phone" id="pd_father_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_FATHER_MOBILE_MSG; ?>" data-parsley-mobileonly="true" data-parsley-errors-container="#custom-pd_father_phone-parsley-error" value="<?php //echo $phone_no;  ?>" data-parsley-notequalto="#pd_mother_phone" data-parsley-notequalto-message="<?php echo PHONE_MATCH_FATHER; ?>">
                            </div>
                            <span id="custom-pd_father_phone-parsley-error"></span>
                        </div>

                        <div class="col-lg-4" id="father_alt_mbleno_div" style="display:none;">
                            <label class="form-control-label">Father's Alternate Mobile Number</label>
                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                    <select class="form-control form_control custom-select Mobile_number" id="pd_father_alt_phone_no_code" name="pd_father_alt_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                        <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>

                                    </select>
                                </span>
                                <input type="text" class="form-control" name="pd_father_alt_phone" id="pd_father_alt_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's alernative Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_ALT_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_FATHER_MOBILE_MSG; ?>" data-parsley-errors-container="#custom-pd_father_alt_phone-parsley-error" value="<?php echo $father_alt_mobile; ?>" data-parsley-mobileonly="true">
                            </div>
                            <span id="custom-pd_father_alt_phone-parsley-error"></span>
                        </div>

                        <div class="col-lg-4" id="father_email_div" style="display:none;">
                            <div class="form-group">
                                <label class="form-control-label">Father's Email ID </label>
                                <input class="form-control" type="email" name="pd_father_email" id="pd_father_email"  placeholder="Enter Your Father's Email ID"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_FATHER_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_father_email-parsley-error" value="<?php echo $father_email; ?>" maxlength="<?php echo APLCT_FATHER_NAME_MAXLENGTH;?>" data-parsley-notequalto="#pd_mother_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_FATHER; ?>">
                                <span id="custom-pd_father_email-parsley-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4"  id="father_occupation_div" style="display:none;">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Father's Occupation</label>
                                <select class="form-control select2" data-placeholder="Select Occupation" tabindex="-1" aria-hidden="true" name="pd_father_occupation" id="pd_father_occupation">
                                    <option value="">Select Father's Occupation</option>
                                </select>
                            </div>
                            <div id="father_other_occupation_div" style="display:none;">
                                <input class="form-control" type="text" name="pd_father_other_occupation" id="pd_father_other_occupation"  placeholder="If Other, please enter here..." data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_OTHER_OCCUPATION_MSG; ?>" data-parsley-errors-container="#custom-pd_father_other_occupation-parsley-error" value="<?php echo trim($father_other_occupation,' '); ?>" maxlength="<?php echo APLCT_FATHER_OCCP_MAXLENGTH;?>" >
                                <span id="custom-pd_father_other_occupation-parsley-error"></span>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- row -->
                </div><!-- form-layout -->
            </div>
            <div class="w-100 pd-20 pd-sm-40">
                <h5 class="text-primary mb-3 mt-4">Mother's Details</h5>
                <div class="form-layout">
                    <div class="row mg-b-25 mt-3">
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Title<span
                                        class="tx-danger">*</span></label>
                                <select class="form-control select2" name="pd_mother_title" id="pd_mother_title" title="Select Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG; ?>" data-parsley-errors-container="#custom-pd_mother_title-parsley-error">
                                    <option value="">Select</option>
                                </select>
                                <span id="custom-pd_mother_title-parsley-error"></span>
                                <input type="hidden" name="pd_mother_id" id="pd_mother_id"  value="<?php echo $app_parent_det_id[$parent_type_id_mother]; ?>" />
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Mother's Name <span class="tx-danger">*</span></label>
                                <input type="text" class="form-control" name="pd_mother_name" id="pd_mother_name" placeholder="Enter Your Mother Name" maxlength="<?php echo APLCT_MOTHER_NAME_MAXLENGTH;?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MOTHER_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_MOTHER_NAME_MINLENGTH;?>, <?php echo APLCT_MOTHER_NAME_MAXLENGTH;?>]" value="<?php echo $mother_name; ?>">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4" id="mother_mbleno_div" style="display:none;">
                            <label class="form-control-label">Mother's Mobile Number</label>
                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                    <select class="form-control form_control custom-select Mobile_number" id="pd_mother_phone_no_code" name="pd_mother_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                        <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>
                                    </select>
                                </span>
                                <input type="text" class="form-control" name="pd_mother_phone" id="pd_mother_phone" maxlength="<?php echo APLCT_MOTHER_MOBILE_MAXLENGTH;?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOTHER_MOBILE_MSG; ?>" data-parsley-maxlength-message="<?php echo VALID_MOTHER_MOBILE_MSG; ?>" data-parsley-errors-container="#custom-pd_mother_phone-parsley-error" value="<?php echo $mother_mobile; ?>" data-parsley-mobileonly="true">
                                <span id="custom-pd_mother_phone-parsley-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4" id="mother_alt_mbleno_div" style="display:none;">
                            <label class="form-control-label">Mother's Alternate Mobile Number</label>
                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                    <select class="form-control form_control custom-select Mobile_number" id="pd_mother_alt_phone_no_code" name="pd_mother_alt_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                        <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>

                                    </select>
                                </span>
                                <input type="text" class="form-control" name="pd_mother_alt_phone" id="pd_mother_alt_phone" maxlength="<?php echo APLCT_MOTHER_ALT_MOBILE_MAXLENGTH;?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOTHER_MOBILE_MSG; ?>" data-parsley-maxlength-message="<?php echo VALID_MOTHER_MOBILE_MSG; ?>" data-parsley-errors-container="#custom-pd_mother_alt_phone-parsley-error" value="<?php echo $mother_alt_mobile ?>" data-parsley-mobileonly="true">
                                <span id="custom-pd_mother_alt_phone-parsley-error"></span>
                            </div>
                        </div>

                        <div class="col-lg-4" id="mother_email_div" style="display:none;">
                            <div class="form-group">
                                <label class="form-control-label">Mother's Email ID </label>
                                <input class="form-control" type="email" name="pd_mother_email" id="pd_mother_email"  placeholder="Enter Your Mother's Email ID"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo APLCT_MOTHER_EMAIL_MAXLENGTH; ?>" data-parsley-errors-container="#custom-pd_mother_email-parsley-error" value="<?php echo $mother_email; ?>" maxlength="<?php echo APLCT_MOTHER_ALT_MOBILE_MAXLENGTH;?>" data-parsley-notequalto="#pd_father_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_MOTHER; ?>">
                                <span id="custom-pd_mother_email-parsley-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4" id="mother_occupation_div" style="display:none;">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Mother's Occupation</label>
                                <select class="form-control select2" data-placeholder="Select Occupation" tabindex="-1" aria-hidden="true" name="pd_mother_occupation" id="pd_mother_occupation">
                                    <option value="">Select Occupation</option>
                                </select>
                            </div>
                            <div id="mother_other_occupation_div" style="display:none;" class="form-group">
                                <input class="form-control" type="text" name="pd_mother_other_occupation" id="pd_mother_other_occupation"  placeholder="If Other, please enter here..." data-parsley-required="false"   data-parsley-errors-container="#custom-pd_mother_other_occupation-parsley-error" value="<?php echo trim($mother_other_occupation,' '); ?>" maxlength="<?php echo APLCT_MOTHER_OCCP_MAXLENGTH; ?>" >
                                <span id="custom-pd_mother_other_occupation-parsley-error"></span>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- row -->
                </div><!-- form-layout -->
            </div>
            <div>
                <label class="ckbox add_guardian_checkbox">
                    <input name="add_guardian_checkbox" id="add_guardian_checkbox" type="checkbox">
                    <span>Add Guardian Detail</span>
                </label>
            </div>	
            <div class="w-100 pd-20 pd-sm-40" id="guardian_details" style="display:none">
                <input type="hidden" name="pd_guardian_id" id="pd_guardian_id" value="<?php echo $app_parent_det_id[$parent_type_id_guardian]; ?>" />
                <h5 class="text-primary mb-3 mt-4">Guardian's Details</h5>
                <div class="form-layout">
                    <div class="row mg-b-25 mt-3">

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Guardian's Name: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="pd_guardian_name" id="pd_guardian_name" placeholder="Enter Your Guardian Name" maxlength="<?php echo APLCT_GUARDIAN_NAME_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_GUARDIAN_NAME_MINLENGTH; ?>, <?php echo APLCT_GUARDIAN_NAME_MAXLENGTH; ?>]" value="<?php echo $guardian_name; ?>">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <label class="form-control-label">Guardian's Mobile NO <span
                                    class="tx-danger">*</span></label>
                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                    <select class="form-control form_control custom-select Mobile_number" id="pd_guardian_phone_no_code" name="pd_guardian_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                        <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>
                                        <option value="Law">Law</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </span>
                                <input type="text" class="form-control" name="pd_guardian_phone" id="pd_guardian_phone" maxlength="<?php echo APLCT_GUARDIAN_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Guardian's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_GUARDIAN_MOBILE_MSG; ?><?php echo VALID_GUARDIAN_MOBILE_MSG; ?><?php echo VALID_GUARDIAN_MOBILE_MSG; ?>" data-parsley-errors-container="#custom-pd_guardian_phone-parsley-error" value="<?php echo $guardian_mobile; ?>" data-parsley-mobileonly="true">
                            </div>
                            <div>	<span id="custom-pd_guardian_phone-parsley-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Guardian's Email ID: <span class="tx-danger">*</span></label>
                                <input  class="form-control" type="email" name="pd_guardian_email" id="pd_guardian_email"  placeholder="Enter Your Guardian's Email ID"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_GUARDIAN_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_guardian_email-parsley-error" value="<?php echo $guardian_email; ?>" maxlength="<?php echo APLCT_GUARDIAN_EMAIL_MAXLENGTH; ?>">
                                <span id="custom-pd_guardian_email-parsley-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Guardian's Occupation<span class="tx-danger">*</span></label>
                                <select class="form-control select2" name="pd_guardian_occupation" id="pd_guardian_occupation" title="Select Guardian Occupation" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_OCCUPATION_MSG;?>" data-parsley-errors-container="#custom-pd_guardian_occupation-parsley-error">
                                    <option value="">Select Guardian's Occupation</option>
                                </select>
                                <span id="custom-pd_guardian_occupation-parsley-error"></span>

                            </div>
                            <div id="guardian_other_occupation_div" style="display:none;" class="form-group">
                                <input class="form-control" type="text" name="guardian_other_occupation" id="guardian_other_occupation"  placeholder="If Other, please enter here..."data-parsley-required="false"   data-parsley-errors-container="#custom-guardian_other_occupation-parsley-error" value="<?php echo trim($guardian_other_occupation,' '); ?>" maxlength="<?php echo APLCT_GUARDIAN_OCCP_MAXLENGTH; ?>" >
                                <span id="custom-guardian_other_occupation-parsley-error"></span>
                            </div>

                        </div><!-- col-4 -->
                    </div><!-- row -->
                </div><!-- form-layout -->
            </div>
</fieldset>
<h3 class="wizard_head_tag">Address Details</h3>
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
                        <div class="card-body" style="font-size: 13px;">
                            <?php echo $applicant_address_wizard_id;?>
                        </div>
                    </div>
                </div>

                <!-- card -->
            </div>
            <h5 class="text-primary mb-3">Address for Communication</h5>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Country<span class="tx-danger"> *</span></label>
                        <select class="form-control select2" data-placeholder="Select country" tabindex="-1" aria-hidden="true" name="country_addr" id="country_addr" title="Select Country" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_COUNTRY_MSG;?>" data-parsley-errors-container="#custom-country_addr-parsley-error">
                            <option value="">Select Country</option>
                        </select>
                        <span id="custom-country_addr-parsley-error"></span>
                    </div>
                </div><!-- col-4 -->
                <div class="col-md-4" id="main_div_state">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">State<span class="tx-danger"> *</span></label>
                        <select class="form-control select2" data-placeholder="Select State" tabindex="-1" aria-hidden="true" name="state_addr" id="state_addr" title="Select State" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_STATE_MSG;?>" data-parsley-errors-container="#custom-state_addr-parsley-error">
                            <option value="">Select State</option>
                        </select>
                        <span id="custom-state_addr-parsley-error"></span>
                    </div>
                </div><!-- col-4 -->
                <div class="col-md-4" id="main_div_district">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">District<span class="tx-danger"> *</span></label>
                        <select class="form-control select2" data-placeholder="Select District" tabindex="-1" aria-hidden="true" name="district_addr" id="district_addr" title="Select District" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DISTRICT_MSG;?>" data-parsley-errors-container="#custom-district_addr-parsley-error">
                            <option  value="">Select District</option>

                        </select>
                        <span id="custom-district_addr-parsley-error"></span>
                    </div>
                </div><!-- col-4 -->
            </div>
            <div class="row">
                <div class="col-md-4" id="main_div_city">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">City<span class="tx-danger"> *</span></label>
                        <select class="form-control select2" data-placeholder="Select City" tabindex="-1" aria-hidden="true" name="city_addr" id="city_addr" title="Select City" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CITY_MSG;?>" data-parsley-errors-container="#custom-city_addr-parsley-error">
                            <option value="">Select City</option>

                        </select>
                        <span id="custom-city_addr-parsley-error"></span>
                    </div>
                </div><!-- col-4 -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Correspondence Address Line 1 <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="address_line1" id="address_line1" placeholder="Enter Address Line 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_ADDRESS_MSG;?>" value="<?php echo $add_line_1; ?>" data-parsley-maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH; ?>" maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH; ?>">
                    </div>
                </div><!-- col-4 -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Correspondence Address Line 2 <!--<span class="tx-danger">*</span>--></label>
                        <input class="form-control" type="text" name="address_line2" id="address_line2" placeholder="Enter Address Line 2" value="<?php echo $add_line_2; ?>" data-parsley-maxlength="<?php echo APLCT_ADDRESS2_MAXLENGTH; ?>" maxlength="<?php echo APLCT_ADDRESS2_MAXLENGTH; ?>">
                    </div>
                </div><!-- col-4 -->		
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Pincode <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Pincode" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PINCODE_MSG;?>" value="<?php echo $pin_code; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_PINCODE_MSG;?>" data-parsley-minlength="<?php echo APLCT_PINCODE_MINLENGTH; ?>" data-parsley-maxlength="<?php echo APLCT_PINCODE_MAXLENGTH; ?>" maxlength="<?php echo APLCT_PINCODE_MAXLENGTH; ?>" onkeypress="return isNumber(event);"
                    </div>
                </div><!-- col-4 -->		  
            </div>
            <div class="row">	  


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
                   <?php echo $applicant_academic_wizard_instructions;?>
                   </div>
                </div>
            </div>

            <!-- card -->
        </div>
         <h5 class="text-primary mb-3">Academic Details</h5> 
        <div action="form-validation.html" id="selectForm" class="w-100">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group mr-5">
                        <label class="form-control-label">Current Education Qualification Status <span class="tx-danger">*</span></label>
                        <div class="row">
                          <div class="col-lg-5 pr-0">
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="appering" name="current_education_qual_status" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="<?php echo REQD_EDU_QUAL_MSG;?>" data-parsley-errors-container="#custom-current_education_qual_status-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($applicant_schooling_det_result_declared == 'f')?'checked':''; ?>>
                              <label class="custom-control-label" for="appering">12th Appearing</label>
                            </div>
                          </div>
                          <div class="col-lg-5 pl-0">
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="completed" name="current_education_qual_status" class="custom-control-input" value="2" <?php echo ($applicant_schooling_det_result_declared == 't')?'checked':''; ?>>
                              <label class="custom-control-label" for="completed">12th Completed</label>
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
                                class="form-text text-muted">Kindly type "NA" in
                                case Certificate is not available with you.</small>
                        </div>
                    </div><!-- form-group -->
                </div>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered mt-0">
            <thead class="thead-light">
                <tr>
                    <th></th>
                    <th>Institute Name</th>
                    <th>Board</th>
					<th>Year of Passing</th>
					<th>Marking Scheme</th>
					<th>Obtained Percentage/CGPA</th>
                    <th>Registration No. / Roll No.</th>
                    <th>Mode of Study</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><p>12th</p></td>
                    <td>
                       <input class="form-control" type="text" name="institute_name" id="institute_name" maxlength="<?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>" placeholder="Institute Name" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_INSTITUTE_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_INSTITUTE_NAME_MINLENGTH; ?>, <?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_schooling_det_insti_name; ?>">

                    </td>
                    <td>
                      <div class="form-group mg-b-10-force">
						<select class="form-control custom-select" id="academic_board" name="academic_board" data-placeholder="Select Board" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BOARD_MSG;?>" data-parsley-errors-container="#custom-academic_board-parsley-error">
                          <option value="">Select</option>
                        </select>
                        <span class="tx-danger required_asterisk">*</span>
                        <span id="custom-institute_university-parsley-error"></span>
                      </div>
                      <div id="ob_board" style="display:none;">
                        <input class="form-control" type="text" name="other_board_name" id="other_board_name" maxlength="<?php echo APLCT_OTHER_GRAD_MAXLENGTH; ?>" value="<?php echo $applicant_schooling_det_other_board_name; ?>">         
                      </div>
                    </td>
					<td>
                      <input class="form-control" type="text" name="year_of_passing" id="year_of_passing" placeholder="YYYY" maxlength="<?php echo APLCT_YEAR_OF_PASSING_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_YEAR_OF_PASSING_MSG;?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-year_of_passing-parsley-error" value="<?php echo $applicant_schooling_det_completion_year; ?>">
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
                        <input class="form-control" type="text" name="obtained_percentage_cgpa" placeholder="Obtained Percentage/CGPA" id="obtained_percentage_cgpa" maxlength="<?php echo APLCT_PERCENT_CGPA_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG;?>" min="<?php echo APLCT_MARK_MINLENGTH; ?>" max="<?php echo APLCT_MARK_MAXLENGTH; ?>" data-parsley-trigger="keyup" data-parsley-trigger="change" data-parsley-errors-container="#custom-obtained_percentage_cgpa-parsley-error" value="<?php echo $applicant_schooling_det_mark_percent; ?>"> 
                        <span class="tx-danger required_asterisk">*</span>
                        <span id="custom-obtained_percentage_cgpa-parsley-error"></span>
                      </div>
                    </td>					
                    <td class="reg_width">
					  <div class="form-group mg-b-10-force" id="appering_info_3">
                      <input class="form-control" type="text" name="registration_no" id="registration_no" placeholder="Roll No. / Registration No" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_REG_NO_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_schooling_det_registration_no; ?>" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_REG_NO_MSG;?>">
                      <span class="tx-danger required_asterisk">*</span>
					  </div> 
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
                </tr>
            </tbody>
        </table>
        </div>
        <div class="mt-3 w-100">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label">Address of school/college <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="address_school_college" id="address_school_college" placeholder="Enter address of school/college " value="<?php echo $applicant_schooling_det_address; ?>" maxlength="<?php echo APLCT_SCHOOL_ADDRESS_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SCHOOL_ADDRESS_MSG;?>">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label">NAD ID / Digilocker ID</label>
                        <input class="form-control" type="text" name="nad_id_digilocker_id" id="nad_id_digilocker_id" placeholder="Enter NAD ID / Digilocker ID " value="<?php echo $nad_id_digilocker_id; ?>" maxlength="<?php echo APLCT_NADID_MAXLENGTH; ?>" data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_NADID_MSG;?>">
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
    </fieldset>
<h3 class="wizard_head_tag">Payment Details</h3>
<fieldset>
	<div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
		<div class="card ">
			<div class="card-header p-0 " role="tab" id="headingOne">
				<h6 class="p-2 ml-3">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed"><i class="fas fa-info-circle"></i> Instructions</a>
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
					<p class="card-subtitle mb-3">E-Mail :  <?php echo $email_id; ?></p>
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
							<label class="rdiobox">
								<input name="rdio" type="radio" id="online" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PAYMENT_MODE_MSG;?>" data-parsley-errors-container="#custom-online-parsley-error" data-parsley-trigger="change">
								<span>Online</span>
							</label>
						</div>
						<div class="col-lg-2">
							<label class="rdiobox">
								<input name="rdio" type="radio" id="dd" value="on" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PAYMENT_MODE_MSG;?>" data-parsley-errors-container="#custom-dd-parsley-error" data-parsley-trigger="change">
								<span>DD</span>
							</label>
						</div>
					</div>
					<span id="custom-online-parsley-error"></span>  
                    <p class="card-subtitle mb-3" style="margin-top:.125em;">Sub Total <span style="float: right;"><?php echo $appln_form_fee; ?></span>
                    </p>
					<p class="card-subtitle">Total<span style="float: right;"><?php echo $appln_form_fee; ?></span>
					</p>
					<div id="payment_details" style="<?php echo ($payment_mode_id==PAYMENT_MODE_DEMAND_DRAFT_ID)?'display:block;':'display:none;'; ?>">
						<div class="mt-3">
							<div class="row">
								<div class="col-md-6">
									<!--<input class="form-control" type="text" name="BankName" id="BankName" placeholder="Bank Name" data-parsley-required="true" data-parsley-required-message="Required">-->
									<select class="form-control select2" name="BankName" id="BankName" title="Choose Bank Name" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHOOSE_BANK_MSG;?>" data-parsley-errors-container="#custom-BankName-parsley-error">
										<option value=""  selected="selected">Select Bank Name</option>
									</select>
									<span id="custom-BankName-parsley-error"></span>									
								</div>
								<div class="col-md-6">
									<input class="form-control" type="text" name="BranchName" placeholder="Branch Name" id="BranchName" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BANK_NAME_MSG;?>" maxlength="<?php echo APLCT_BRANCH_NAME_MAXLENGTH; ?>" value="<?php echo $branch_name; ?>" data-parsley-nameonly='true'  data-parsley-nameonly-message="<?php echo VALID_BANK_NAME_MSG; ?>">
								</div>
							</div>

						</div>

						<div class="mt-3">
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
					<!--<a href="payment_success.html" class="btn btn-primary active w-100 mt-3" role="button" aria-pressed="true">MAKE PAYMENT</a>-->
				</div>
			</div><!-- card -->
		</div>
	</div>
	<div class="row  w-100">
	</div>
</fieldset>
<h3 class="wizard_head_tag">Upload Documents</h3>
<fieldset>
	<div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
		<div class="card ">
			<div class="card-header p-0 " role="tab" id="headingOne">
				<h6 class="p-2 ml-3">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed">
					<i class="fas fa-info-circle"></i> Instructions</a>
				</h6>
			</div><!-- card-header -->

			<div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
				<div class="card-body" style="font-size: 13px;">
				<?php echo $applicant_upload_wizard_instructions;?>
				</div>
			</div>
		</div>
		<!-- card -->
	</div>
	<div class="col-md-12">
	<div class="row w-100">
	<h5 class="text-primary mb-3 mt-4">Upload Your Academic and Other Documents</h5>
	
	</div>
		<div class="form-layout">
			<div class="row mg-b-25 mt-3">
				 <div class="row w-100">
                        <div class="form-group col-md-6 ">
                           <label for="exampleFormControlTextarea1">Upload Your Recent Passport Size Photograph <span class="tx-danger">*</span></label>
                           <input type="file" class="filestyle" name="photograph" id="photograph" data-parsley-required="<?php echo ((isset($docs[$document_id_photograph]))?'false':'true'); ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_PHOTO_MSG; ?>" data-parsley-errors-container="#custom-photograph-parsley-error"data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>"accept="<?php  echo allow_extension($file_allowed_type); ?>">
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
							<input type="file" class="filestyle" name="signature" id="signature" data-parsley-required="<?php echo ((isset($docs[$document_id_signature]))?'false':'true'); ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_SIGN_MSG; ?>" data-parsley-errors-container="#custom-signature-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
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
					 <div class="form-group col-md-6 ">
                           <label for="exampleFormControlTextarea1">Upload Your Graduation Marksheet <span class="tx-danger">*</span></label>
                           <input type="file" class="filestyle" name="graduation_marksheet" id="graduation_marksheet" data-parsley-required="<?php echo ((isset($docs[$document_id_graduation_marksheet]))?'false':'true'); ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_GRAD_MARK_MSG; ?>" data-parsley-errors-container="#custom-graduation_marksheet-parsley-error"data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_graduation_marksheet])){ echo $docs[$document_id_graduation_marksheet]['id']; } ?>"accept="<?php  echo allow_extension($file_allowed_type); ?>">
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
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed">

                          <i class="fas fa-info-circle"></i>
                          Instructions</a>
                  </h6>
              </div><!-- card-header -->

              <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                 <div class="card-body" style="font-size: 13px;">
				<?php echo $applicant_declaration_wizard_instructions;?>
				</div>
              </div>
          </div>

          <!-- card -->
      </div>
	<div class="col-md-12">
		<div class="form-layout">
			<div class="row mg-b-25 mt-3">
				<div class="row w-100">
					<div class="col-md-12">
						<h5 class="text-primary mb-3">Declaration </h5>
						<p><?php echo DECLARATION; ?></p>
					</div>	
				</div>
				<div class="row w-100">
					<div class="col-md-6">
						<label class="form-control-label">Applicant Name <span class="tx-danger">*</span></label>						 
						 <input class="form-control" type="text" name="applicant_name" id="applicant_name" placeholder="Enter Applicant Name" placeholder="Enter Applicant Name" maxlength="<?php echo APLCT_DECLR_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_APPLT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_DECLR_NAME_MINLENGTH; ?>, <?php echo APLCT_DECLR_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_name; ?>">
					</div>
					<div class="col-md-6">
						<label class="form-control-label">Parent Name <span class="tx-danger">*</span></label>
						<input class="form-control" type="text" name="parent_name" id="parent_name" placeholder="Parent Name" maxlength="<?php echo APLCT_DECLR_FATHER_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_PARENT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_DECLR_FATHER_NAME_MINLENGTH; ?>, <?php echo APLCT_DECLR_FATHER_NAME_MAXLENGTH; ?>]" value="<?php echo $parent_name; ?>" >
					</div>	
				</div>
				<div class="row w-100 mt-3">
					<div class="col-md-6">
						<label class="form-control-label">Date <span class="tx-danger">*</span></label>
						 <input class="form-control" type="text" name="date_dec" id="date_dec" placeholder="Declartion Date" value="<?php echo $today; ?>" readonly>
					</div>
				</div>	
							
			</div><!-- row -->
		</div>
	</div>
</fieldset>
<?php form_close(); ?><!-- form -->      
    </div>                               
</div>		