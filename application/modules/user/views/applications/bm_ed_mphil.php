<?php 
 /* echo "<pre>";
 print_r($applicant_schooling_list);
echo "</pre>" ;  */
$ssclMaxYop=date("Y", strtotime(date("Y") . " - 24 months"));
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
$applicant_name=isset($applicant_application_details_list[0]['applicant_name_declaration'])?$applicant_application_details_list[0]['applicant_name_declaration']:'';
$parent_name=isset($applicant_application_details_list[0]['applicant_parentname_declaration'])?$applicant_application_details_list[0]['applicant_parentname_declaration']:'';
$declared_date=isset($applicant_application_details_list[0]['applicant_declaration_date'])?date('d/m/Y',strtotime($applicant_application_details_list[0]['applicant_declaration_date'])):$today;
$digilocker_id='';
$digilocker_id = $personal_detail_list['data']['digilocker_id'];

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
    $guardian_alt_mobile=isset($guardian_alt_mobile) ? $guardian_alt_mobile:'';
    $guardian_other_occupation=isset($guardian_other_occupation) ? $guardian_other_occupation:'';
    
}

$name_as_in_marksheet = isset($applicant_schooling_list[0]['name_as_in_marksheet']) ? $applicant_schooling_list[0]['name_as_in_marksheet'] : '';
// Schooling Detail Get Tenth
if(isset($applicant_schooling_list)){
foreach($applicant_schooling_list as $school){
    $schooltype="";
    if($school['schooling_id']==SCHOOLING_ID_TENTH){
        $schooltype="tenth";
    }
    if($school['schooling_id']==SCHOOLING_ID_TWELFTH){
        $schooltype="twelfth";
    }    
    $schooltypename=strtolower($schooltype);        
    ${ "inst_name_".$schooltypename}=$school['inst_name'];
    ${ "mark_percentage_".$schooltypename}=$school['mark_percentage'];
    ${ "registration_no_".$schooltypename}=$school['registration_no'];
    ${ "other_board_name_".$schooltypename}=$school['other_board_name'];
    ${ "schooling_id_".$schooltypename}=$school['applicant_scl_det_id'];
    ${ "other_stream_name_".$schooltypename}=$school['other_stream_name'];
    ${ "completion_year_" . $schooltypename} = $school['completion_year'];
 }
}
$schooling_id_tenth = isset($schooling_id_tenth) ? $schooling_id_tenth:'';  
$inst_name_tenth = isset($inst_name_tenth) ? $inst_name_tenth:'';
$mark_percentage_tenth = isset($mark_percentage_tenth)? $mark_percentage_tenth : '';
$registration_no_tenth = isset($registration_no_tenth) ? $registration_no_tenth : '';
$other_board_name_tenth = isset($other_board_name_tenth) ? $other_board_name_tenth : '';
$completion_year_tenth = isset($completion_year_tenth) ? $completion_year_tenth : '';
// Schooling Detail Get Twelfth

$schooling_id_twelfth = isset($schooling_id_twelfth) ? $schooling_id_twelfth:'';
$inst_name_twelfth = isset($inst_name_twelfth) ? $inst_name_twelfth:'';
$mark_percentage_twelfth = isset($mark_percentage_twelfth)? $mark_percentage_twelfth : '';
$registration_no_twelfth = isset($registration_no_twelfth) ? $registration_no_twelfth : '';
$other_board_name_twelfth = isset($other_board_name_twelfth) ? $other_board_name_twelfth : '';
$other_stream_name = isset($other_stream_name_twelfth) ? $other_stream_name_twelfth : '';
$completion_year_twelfth = isset($completion_year_twelfth) ? $completion_year_twelfth : '';

//get ug pg value
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
            ${ "completion_year_" . $graduatioName} = $v['yr_of_pass'];
            ${ "university_other_".$graduatioName}=$v['other_univ_name'];
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
$applicant_grad_det_id_ug==isset($applicant_grad_det_id_ug) ? $applicant_grad_det_id_ug : '';
$applicant_grad_det_id_pg==isset($applicant_grad_det_id_pg) ? $applicant_grad_det_id_pg : '';
$completion_year_ug = isset($completion_year_ug) ? $completion_year_ug : '';
$completion_year_pg = isset($completion_year_pg) ? $completion_year_pg : '';

//set name for decalaration
$applicant_name=!empty($applicant_name) ?$applicant_name : $first_name;
$parent_name=!empty($parent_name) ?$parent_name : $father_name;
$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_graduation_marksheet = DOCUMENT_ID_GRADUATION_MARKSHEET;
$course_pref_id=isset($applicant_course_details_list['applicant_course_id']) ? $applicant_course_details_list['applicant_course_id'] :'';
$course_choice_no=isset($applicant_course_details_list['choice_no']) ? $applicant_course_details_list['choice_no'] :1;

/* fetch campus data*/
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

$campus_choice_no_1=isset($campus_choice_no_1)?$campus_choice_no_1:1;
$campus_choice_no_2=isset($campus_choice_no_2)?$campus_choice_no_2:2;
$campus_choice_no_3=isset($campus_choice_no_3)?$campus_choice_no_3:3;

$campus_prefer_id_1=isset($campus_prefer_id_1)?$campus_prefer_id_1:'';
$campus_prefer_id_2=isset($campus_prefer_id_2)?$campus_prefer_id_2:'';
$campus_prefer_id_3=isset($campus_prefer_id_3)?$campus_prefer_id_3:'';


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
/* Payment Details Start */
$appln_form_fee = $applicant_application_details_list[0]['appln_form_fee'];
$branch_name = $applicant_payment_details_list['branch_name'];
$dd_cheque_no = $applicant_payment_details_list['dd_cheque_no'];
$dd_cheque_date = $applicant_payment_details_list['dd_cheque_date'];
if($dd_cheque_date) {
    $dd_cheque_date = date('d/m/Y',strtotime($dd_cheque_date));
}
$payment_mode_id = $applicant_payment_details_list['payment_mode_id'];

/* Payment Details End */
$application_status_id =$applicant_application_details_list[0]['application_status_id'];
/* Basic Detail Instructions End */
$attributes = array('class' => 'form-horizontal form-wizard-wrapper .custom-validation', 'id' => 'bm_ed_mphil_form', 'name' => 'bm_ed_mphil_form', 'enctype' => 'multipart/form-data', 'data-parsley-validate data-toggle'=>"validator");
echo form_open('', $attributes);
?>
<div class="loader" style="display:none;">
</div>
<div>
<div id="formerr" style="display:none;color:red">Something went to wrong.Please try again later. </div>
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
                        <label class="form-control-label">Have you studied 10 / 10+2 from India? <span
                                class="tx-danger">*</span></label>
                        <select class="form-control custom-select" name="studied_from_india" id="studied_from_india" title="Select Status - Yes or No" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SELECT_STUDIED_RESIDENT_MSG; ?>" data-parsley-errors-container="#custom-studied_from_india-parsley-error">
							<option value="">Select</option>
						</select>
						<span id="custom-studied_from_india-parsley-error"></span>	
				 </div>
                </div><!-- col-4 -->
                <div class="col-lg-6">
                    <div class="form-group mg-b-10-force" id="resident_status" style="display:none;">
                        <label class="form-control-label">Resident Status 
                            <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select" name="non_indian_resident" id="non_indian_resident" title="Select Resident Status" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SELECT_RESIDENT_STATUS_MSG;?>" data-parsley-errors-container="#custom-non_indian_resident-parsley-error">
                            <option value="">Select</option>
                        </select>
                        <span id="custom-non_indian_resident-parsley-error"></span>
                        <span id="halterror" style="display:none;"><?php echo NO_OPTION_PROCEED_MSG;?></span>
                    </div>
                </div><!-- col-4 -->
                
            </div><!-- row -->
             <div class="row mg-b-25">
                <div class="col-lg-12">
                <div class="form-group mt-1" id="indian" style="display:none;" >
                    <p> <span class="tx-danger">*</span> <?php echo IS_AGREE_INFO; ?></p>
                    <span id="custom-confirm_study_residency_checkbox-parsley-error"></span>
                    <div class="custom-control custom-checkbox">
                    <?php                     
                    $checked="0";
                    if($i_confirmChecked && $i_confirmChecked==='t'){
                        $checked="1";
                    }                    
                    ?>
                      <input class="custom-control-input" value="<?php echo $checked;?>" type="checkbox" name="i_confirm" id="i_confirm" value="0"  data-parsley-required="false" data-parsley-required-message="Please check confirm" ><label class="custom-control-label" for="i_confirm">I Confirm </label>
                    </div>
                    <span id="custom-i_confirm-parsley-error"></span>
                </div>
                <div class="form-group formAreaCols"  id="non-indian" style="display:none;">
                   <p><?php echo NRI_FOREIGN;?></p>
                   <a target="_blank"
                   href="<?php echo NRI_FOREIGN_URL;?>"><b><?php echo NRI_FOREIGN_URL;?></b></a>
                </div>
                </div>
             </div>
             <input type="hidden" name="appln_status" id="appln_status" value="<?php echo $application_status_id; ?>">
            
        </div><!-- form-layout -->
	</div>
</fieldset>
<h3 class="wizard_head_tag">Preferences and Personal Details</h3>
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
				<?php echo $applicant_pref_per_wizard_instructions;?>
				</div>
			</div>
		</div>

		<!-- card -->
	</div>
	<div class="w-100 pd-20 pd-sm-40">    
    <div class="form-layout">
    <div class="row mg-b-25 mt-3">
    <div class="col-lg-12">
    <h5><?php echo BMED_CAMPUS_MSG;?></h5>
    </div>
    </div>
    <div class="row mt-3">
			<div class="col-lg-4">
				<div class="form-group mg-b-10-force">
					<label class="form-control-label">Program Level <span class="tx-danger">*</span></label>
						<select class="form-control select2" data-placeholder="Select Program" tabindex="-1" aria-hidden="true" name="pd_program" id="pd_program" title="Select Program" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHOOSE_PROGRAM_MSG;?>" data-parsley-errors-container="#custom-pd_program-parsley-error">
						 <option value="">Select Level of Program</option>
						</select>
					<span id="custom-pd_program-parsley-error"></span>
				</div>
			</div><!-- col-4 -->
	</div>
        <div class="row mg-b-25 mt-3" id="course_div" style="display:none;">
            <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                    <label class="form-control-label">Course Applied For <span
                     class="tx-danger">*</span></label>                   
                     <select class="form-control select2" data-placeholder="Select Course" tabindex="-1" aria-hidden="true" name="course_pref_1" id="course_pref_1" title="Select Course" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHOOSE_COURSE_MSG;?>" data-parsley-errors-container="#custom-course_pref_1-parsley-error">
                        <option value="">Select Course</option>
                    </select>
                     <span id="custom-course_pref_1-parsley-error"></span>
                        <input type="hidden" name="course_choice_no_1" id="course_choice_no_1" value="<?php echo $course_choice_no;?>" />
                        <input type="hidden" name="course_prefer_id_1" id="course_prefer_id_1" value="<?php echo $course_pref_id;?>" />
                   </div>
            </div><!-- col-4 -->
        </div><!-- row -->
    </div><!-- form-layout -->
</div>

	<hr/>
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
                                <input class="form-control" type="text" name="pd_firstname" id="pd_firstname" placeholder="Enter First Name" placeholder="Your First Name" maxlength="<?php echo APLCT_FIRST_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_FIRST_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_FIRST_NAME_MINLENGTH; ?>, <?php echo APLCT_FIRST_NAME_MAXLENGTH; ?>]" value="<?php echo $first_name; ?>">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Middle Name </label>
                                <input class="form-control" type="text" name="pd_middlename" id="pd_middlename" placeholder="Your Middle Name" placeholder="Your Last Name" maxlength="<?php echo APLCT_MIDDLE_NAME_MAXLENGTH; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_MIDDLE_NAME_MINLENGTH; ?>, <?php echo APLCT_MIDDLE_NAME_MAXLENGTH; ?>]"" value="<?php echo $middle_name; ?>">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Last Name <span class="tx-danger"> *</span></label>
                                <input class="form-control" type="text" name="pd_lastname"  id="pd_lastname" placeholder="Your Last Name" maxlength="<?php echo APLCT_LAST_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_LAST_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_LAST_NAME_MINLENGTH; ?>, <?php echo APLCT_LAST_NAME_MAXLENGTH; ?>]" data-parsley-pattern="/^[a-zA-Z.]*$/" value="<?php echo $last_name; ?>">
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
                                <input type="text" name="pd_mobile_no" id="pd_mobile_no" maxlength="<?php echo APLCT_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Mobile No" class="form-control" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOBILE_MSG; ?>" data-parsley-mobileonly="true" data-parsley-errors-container="#custom-pd_mobile_no-parsley-error" value="<?php echo $mobile_no; ?>">
                            </div>
                            <span id="custom-pd_mobile_no-parsley-error"></span>	
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Email ID <span class="tx-danger"> *</span></label>
                                <input readonly  class="form-control" type="email" name="pd_email" id="pd_email" placeholder="Your email id." data-parsley-required="true" data-parsley-required-message="<?php echo REQD_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_email-parsley-error" value="<?php echo $email_id; ?>" maxlength="<?php echo APLCT_EMAIL_MAXLENGTH; ?>">
                                <span id="custom-pd_email-parsley-error"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="wd-200 w-100">
                                <label class="form-control-label">Date of Birth <span class="tx-danger"> *</span></label>
                                <div class="input-group"><span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                    <input class="form-control hasDatepicker" name="pd_dob" id="pd_dob" placeholder="MM/DD/YYYY" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DOB_MSG;?>" data-parsley-errors-container="#custom-pd_dob-parsley-error" value="<?php echo $dob; ?>">
                                </div>
                            </div>
                            <span id="custom-pd_dob-parsley-error"></span>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Gender <span class="tx-danger"> *</span></label>
                                <select class="form-control select2" data-placeholder="Select Gender" tabindex="-1" aria-hidden="true" name="pd_gender" id="pd_gender" title="Select Gender" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_GENDER_MSG;?>" data-parsley-errors-container="#custom-pd_gender-parsley-error">
                                    <option value="">Select</option>
                                </select>
                                <span id="custom-pd_gender-parsley-error"></span>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Alternate Email ID </label>
                                <input class="form-control" type="email" name="pd_alt_email" id="pd_alt_email" placeholder="Alternate Email" data-parsley-required="false" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_ALT_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_alt_email-parsley-error" value="<?php echo $alt_email_id; ?>" maxlength="<?php echo APLCT_ALT_EMAIL_MAXLENGTH; ?>" data-parsley-notequalto="#pd_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH; ?>">
                                <span id="custom-pd_alt_email-parsley-error"></span>
                                <p id="suggestion_alt_email"></p>
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
                                <select class="form-control select2" data-placeholder="Select Religion" tabindex="-1" aria-hidden="true" name="pd_religion" id="pd_religion" title="Select Religion" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_RELIGION_MSG;?>" data-parsley-errors-container="#custom-pd_religion-parsley-error">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Mother Tongue</label>
                                <select class="form-control select2" data-placeholder="Select Mother Tongue" tabindex="-1" aria-hidden="true" name="pd_mother_tongue" id="pd_mother_tongue" title="Select Mother Tongue" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_TONGUE_MSG;?>" data-parsley-errors-container="#custom-pd_mother_tongue-parsley-error">
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
<h3 class="wizard_head_tag">Parents's Details</h3>
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
						<input class="form-control" type="text" name="pd_father_name" id="pd_father_name" placeholder="Enter Your Father Name" maxlength="<?php echo APLCT_FATHER_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_FATHER_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>" data-parsley-length="[<?php echo APLCT_FATHER_NAME_MINLENGTH; ?>, <?php echo APLCT_FATHER_NAME_MAXLENGTH; ?>]" value="<?php echo $father_name; ?>">
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
				   <input type="text" value="<?php echo $father_mobile; ?>" class="form-control" name="pd_father_phone" id="pd_father_phone" maxlength="<?php echo APLCT_FATHER_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOBILE_MSG; ?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_father_phone-parsley-error" value="<?php //echo $phone_no;  ?>" data-parsley-notequalto="#pd_mother_phone" data-parsley-notequalto-message="<?php echo PHONE_MATCH_FATHER; ?>">
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
				  <input type="text" class="form-control" name="pd_father_alt_phone" id="pd_father_alt_phone" maxlength="<?php echo APLCT_FATHER_ALT_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's alernative Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_ALT_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOBILE_MSG;?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_father_alt_phone-parsley-error" value="<?php echo $father_alt_mobile; ?>">
				</div>
				<span id="custom-pd_father_alt_phone-parsley-error"></span>
				</div>

				<div class="col-lg-4" id="father_email_div" style="display:none;">
					<div class="form-group">
						<label class="form-control-label">Father's Email ID </label>						
						<input class="form-control" type="email" name="pd_father_email" id="pd_father_email"  placeholder="Enter Your Father's Email ID"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_father_email-parsley-error" value="<?php echo $father_email; ?>" maxlength="<?php echo APLCT_FATHER_EMAIL_MAXLENGTH; ?>" data-parsley-notequalto="#pd_mother_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_FATHER; ?>">
						<span id="custom-pd_father_email-parsley-error"></span>
						<p id="suggestion_father_email"></p>
					</div>
				</div>
				<div class="col-lg-4"  id="father_occupation_div" style="display:none;">
					<div class="form-group mg-b-10-force">
						<label class="form-control-label">Father's Occupation</label>
						<select class="form-control select2" data-placeholder="Select Occupation" tabindex="-1" aria-hidden="true" name="pd_father_occupation" id="pd_father_occupation">
							<option value="">Select Father's Occupation</option>
						</select>
					</div>
					<div id="father_other_occupation_div" style="display:none;" class="form-group">
						<input class="form-control" type="text" name="pd_father_other_occupation" id="pd_father_other_occupation"  placeholder="If Other, please enter here..."data-parsley-required="false"   data-parsley-errors-container="#custom-pd_father_other_occupation-parsley-error" value="<?php echo $father_other_occupation;?>" maxlength="50" >
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
                        <input type="text" class="form-control" name="pd_mother_name" id="pd_mother_name" placeholder="Enter Your Mother Name" maxlength="<?php echo APLCT_MOTHER_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MOTHER_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>" data-parsley-length="[<?php echo APLCT_MOTHER_NAME_MINLENGTH; ?>, <?php echo APLCT_MOTHER_NAME_MAXLENGTH; ?>]" value="<?php echo $mother_name; ?>">
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4" id="mother_mbleno_div" style="display:none;">
                    <label class="form-control-label">Mother's Mobile Number</label>
                    <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                            <select class="form-control form_control custom-select Mobile_number" id="pd_mother_phone_no_code" name="pd_mother_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>
                            </select>
                        </span>
                        <input type="text" class="form-control" name="pd_mother_phone" id="pd_mother_phone" maxlength="<?php echo APLCT_MOTHER_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOBILE_MSG; ?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_mother_phone-parsley-error" value="<?php echo $mother_mobile; ?>">
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
                        <input type="text" class="form-control" name="pd_mother_alt_phone" id="pd_mother_alt_phone" maxlength="<?php echo APLCT_MOTHER_ALT_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOBILE_MSG; ?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_mother_alt_phone-parsley-error" value="<?php echo $mother_alt_mobile ?>">
                        <span id="custom-pd_mother_alt_phone-parsley-error"></span>
                    </div>
                </div>

                <div class="col-lg-4" id="mother_email_div" style="display:none;">
                    <div class="form-group">
                        <label class="form-control-label">Mother's Email ID </label>
                        <input class="form-control" type="email" name="pd_mother_email" id="pd_mother_email"  placeholder="Enter Your Mother's Email ID" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_mother_email-parsley-error" value="<?php echo $mother_email; ?>" maxlength="<?php echo APLCT_MOTHER_EMAIL_MAXLENGTH; ?>" data-parsley-notequalto="#pd_father_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_MOTHER; ?>">
                       <span id="custom-pd_mother_email-parsley-error"></span>
                        <p id="suggestion_mother_email"></p>
                    </div>
                </div>
                <div class="col-lg-4" id="mother_occupation_div" style="display:none;">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Mother's Occupation</label>
                        <select class="form-control select2" data-placeholder="Select Occupation" tabindex="-1" aria-hidden="true" name="pd_mother_occupation" id="pd_mother_occupation">
                            <option value="">Select Mother's Occupation</option>
                        </select>
                    </div>
                    <div id="mother_other_occupation_div" style="display:none;" class="form-group">
                        <input class="form-control" type="text" name="pd_mother_other_occupation" id="pd_mother_other_occupation"  placeholder="If Other, please enter here..." data-parsley-required="false"   data-parsley-errors-container="#custom-pd_mother_other_occupation-parsley-error" value="<?php echo $mother_other_occupation; ?>" maxlength="<?php echo APLCT_MOTHER_OCCP_MAXLENGTH; ?>" >
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
		<h5 class="text-primary mb-3">Guardian's Details</h5>
		<div class="form-layout">
			<div class="row mg-b-25 mt-3">				
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">Guardian's Name: <span class="tx-danger">*</span></label>
						<input class="form-control" type="text" name="pd_guardian_name" id="pd_guardian_name" placeholder="Enter Your Guardian Name" maxlength="<?php echo APLCT_GUARDIAN_NAME_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>" data-parsley-length="[<?php echo APLCT_GUARDIAN_NAME_MINLENGTH; ?>, <?php echo APLCT_GUARDIAN_NAME_MAXLENGTH; ?>]" value="<?php echo $guardian_name; ?>">
					</div>
				</div><!-- col-4 -->
				<div class="col-lg-4">
					<label class="form-control-label">Guardian's Mobile NO <span
							class="tx-danger">*</span></label>
							<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
							<select class="form-control form_control custom-select Mobile_number" id="pd_guardian_phone_no_code" name="pd_guardian_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
								<option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>
							</select>
							</span>
						    <input type="text" class="form-control" name="pd_guardian_phone" id="pd_guardian_phone" maxlength="<?php echo APLCT_GUARDIAN_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Guardian's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOBILE_MSG; ?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_guardian_phone-parsley-error" value="<?php echo $guardian_mobile; ?>"/>
						    </div>
						    <div>	<span id="custom-pd_guardian_phone-parsley-error"></span>
						</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">Guardian's Email ID: <span class="tx-danger">*</span></label>
						<input class="form-control" type="email" name="pd_guardian_email" id="pd_guardian_email"  placeholder="Enter Your Guardian's Email ID" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_EMAIL_MSG;?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_guardian_email-parsley-error" value="<?php echo $guardian_email; ?>" maxlength="<?php echo APLCT_GUARDIAN_EMAIL_MAXLENGTH; ?>">
                        <span id="custom-pd_guardian_email-parsley-error"></span>
						<p id="suggestion_guardian_email"></p>
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
						<input class="form-control" type="text" name="guardian_other_occupation" id="guardian_other_occupation"  placeholder="If Other, please enter here..."data-parsley-required="false"   data-parsley-errors-container="#custom-guardian_other_occupation-parsley-error" value="<?php echo $guardian_other_occupation; ?>" maxlength="<?php echo APLCT_GUARDIAN_OCCP_MAXLENGTH; ?>" >
						<span id="custom-guardian_other_occupation-parsley-error"></span>
					</div>
				</div><!-- col-4 -->
			</div><!-- row -->
		</div><!-- form-layout -->
	</div>
</fieldset>
<h3 class="wizard_head_tag">Address Detail</h3>
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
				<?php echo $applicant_address_wizard_instructions;?>
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
                        <select class="form-control select2" data-placeholder="Select District" tabindex="-1" aria-hidden="true" name="district_addr" id="district_addr" title="Select District" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DISTRICT_MSG; ?>" data-parsley-errors-container="#custom-district_addr-parsley-error">
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
                        <select class="form-control select2" data-placeholder="Select City" tabindex="-1" aria-hidden="true" name="city_addr" id="city_addr" title="Select City" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CITY_MSG; ?>" data-parsley-errors-container="#custom-city_addr-parsley-error">
                            <option value="">Select City</option>

                        </select>
                        <span id="custom-city_addr-parsley-error"></span>
                    </div>
                </div><!-- col-4 -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Correspondence Address Line 1 <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="address_line1" id="address_line1" placeholder="Enter Address Line 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_ADDRESS_MSG; ?>" value="<?php echo $add_line_1; ?>" data-parsley-maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH; ?>" maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH; ?>">
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
                         <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Pincode" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PINCODE_MSG;?>" value="<?php echo $pin_code; ?>" data-parsley-maxlength="<?php echo APLCT_PINCODE_MAXLENGTH; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_PINCODE_MSG;?>" data-parsley-minlength="6" data-parsley-maxlength="<?php echo APLCT_PINCODE_MAXLENGTH; ?>" maxlength="<?php echo APLCT_PINCODE_MAXLENGTH; ?>" onkeypress="return isNumber(event);"
                    </div>
                </div><!-- col-4 -->		  
            </div>
      <div class="row">	</div><!-- row -->
      
   </fieldset>
<h3 class="wizard_head_tag">Academic Detail</h3>
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
				<?php echo $applicant_academic_wizard_instructions;?>
				</div>
			</div>
		</div>

		<!-- card -->
	</div>
	<h5 class="text-primary mb-3 mt-4">Academic Details</h5>
	<div action="form-validation.html" id="selectForm" class="w-100">
		<div class="row">
            <div class="col-lg-4">
                <div class="form-group mr-5">                    
                    <div class="row">
                      <div class="col-lg-10">
                        
                        <div class="form-group">
        					<label class="form-control-label">Current Education Qualification Status <span class="tx-danger">*</span></label>
        					<select class="form-control select2" data-placeholder="Select Current Qualification Status" tabindex="-1" aria-hidden="true" name="current_qualification_status" id="current_qualification_status" title="Select Current Qualification Status" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_EDU_QUAL_MSG; ?>" data-parsley-errors-container="#custom-current_qualification_status-parsley-error">
        						<option value="">Select Your Current Qualification Status
        						</option>
        					</select>
        					<span id="custom-current_qualification_status-parsley-error"></span>
        				</div>      
                        </div>
                        
                    </div>
                    
                   

                </div><!-- form-group -->
            </div>
            <div class="col-lg-4 ">
                <div class="form-group wd-xs-300 mr-5 w-100">
                    <label class="form-control-label">Candidate Name as in 10th Certificate
                        <span class="tx-danger">*</span></label>
                    <div class="form-group mg-b-10-force"> 
                        <input class="form-control" type="text" name="candidate_name" id="candidate_name" placeholder="Candidate's Name" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_CANDIDATE_NAME_MSG;?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>" data-parsley-length="[<?php echo APLCT_CAND_NAME_MINLENGTH; ?>, <?php echo APLCT_CAND_NAME_MAXLENGTH; ?>]" value="<?php echo $name_as_in_marksheet; ?>" maxlength="<?php echo APLCT_CAND_NAME_MAXLENGTH; ?>" data-parsley-trigger="change">
                        <small id="emailHelp" class="form-text text-muted"><?php echo TYPE_NA;?></small>
                    </div>
                </div><!-- form-group -->
            </div>
            
             <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">NAD ID / Digilocker ID </label>
                     <input class="form-control" type="text" name="digilocker_id" id="digilocker_id" placeholder="Enter Your NAD ID / Digilocker ID " data-parsley-required="false"  value="<?php echo $digilocker_id;?>" maxlength="<?php echo APLCT_NADID_MAXLENGTH;?>"  data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_NADID_MSG;?>">
				  </div>
            </div>
        </div> <!-- end row -->
	</div>
	<div><h5 class="text-primary mb-3 mt-4">10th Details</h5></div>
     <div class="table-responsive">
	  <table class="table table-bordered mt-0">
		
		<thead class="thead-light">
			<tr>
				<th></th>
                <th> Institute Name</th>
                <th> Board</th>               
                <th> Marking Scheme</th>
                <th> Obtained Percentage/CGPA</th>
                <th> Year of Passing</th>
                <th> Roll No. / Registration No.
                </th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<p>10th</p>
				</td>
				<td>
				<input type="hidden" name="schooling_id_tenth" id="schooling_id_tenth" value="<?php echo $schooling_id_tenth; ?>" >
				<input class="form-control" type="text" name="academic_tenth_inst" id="academic_tenth_inst" maxlength="<?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_INSTITUTE_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>" data-parsley-length="[1, <?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>]" value="<?php echo $inst_name_tenth; ?>">
			    </td>
				<td>
					<div class="form-group mg-b-10-force">						
						<select class="form-control select2" name="academic_board" id="academic_board" title="Select Board" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BOARD_MSG; ?>" data-parsley-errors-container="#custom-academic_board-parsley-error">
							<option value="">Select</option>
						</select>
						<span id="custom-academic_board-parsley-error"></span>
					
					</div>
					<div class="form-group" id="other_board1" style="display:none;">
					 <input type="text" class="form-control" name="other_tenth_board" id="other_tenth_board" placeholder="If Other, please enter here.." maxlength="<?php echo APLCT_OTHER_BOARD_MAXLENGTH; ?>"  value="<?php echo $other_board_name_tenth; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>" >
				   </div>
				</td>				
				<td>
					<div class="form-group mg-b-10-force " id="Appering_info_1">						
						<select class="form-control select2" name="academic_marking_scheme" id="academic_marking_scheme" title="Select Academic Marking Scheme" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MARK_SCHEME_MSG; ?>" data-parsley-errors-container="#custom-academic_marking_scheme-parsley-error">
						<option value="">Select</option>
						</select>
						<span id="custom-academic_marking_scheme-parsley-error"></span>
					
					</div>
				</td>
				<td>
				<div class="">
				  <input class="form-control" type="text" name="academic_obtain_cgpa" id="academic_obtain_cgpa" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG; ?>"  data-parsley-type-message="<?php echo REQD_PERCENT_CGPA_VALID_MSG; ?>"  data-parsley-trigger="keyup" data-parsley-type="number" value="<?php echo $mark_percentage_tenth; ?>" maxlength="<?php echo APLCT_PERCENT_CGPA_MAXLENGTH; ?>">
				</div>
				</td>
				<td>
					<div class="form-group ">
					 <div>                     
				      <input class="form-control" type="text" name="academic_yr_passing" id="academic_yr_passing" class="form-control datepicker" placeholder="YYYY" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_YEAR_OF_PASSING_MSG; ?>" data-parsley-trigger="change" value="<?php echo $completion_year_tenth; ?>" max="<?php echo $ssclMaxYop; ?>" maxlength="<?php echo APLCT_YEAR_OF_PASSING_MAXLENGTH; ?>" onkeypress="return isNumber(event);">
				     </div>
				     <span id="custom-academic_yr_passing-parsley-error"></span>
                     </div>
				</td>
				<td class="reg_width">
				<div class="">	
				  <input class="form-control" type="text" name="academic_reg_no"id="academic_reg_no" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_REG_NO_MSG; ?>" data-parsley-length="[1, 100]" value="<?php echo $registration_no_tenth; ?>" data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_REG_NO_MSG; ?>">			
				</div>
				</td>
			</tr>
		</tbody>
	</table>
	</div>
	
	<div><h5 class="text-primary mb-3 mt-4">12th / Diploma Details</h5></div>
	<div class="table-responsive">
	<table class="table table-bordered mt-0 ">
		
		<thead class="thead-light">
			<tr>
				<th>
				</th>
				<th> Institute Name</th>
				<th> Board</th>				
				<th> Marking Scheme</th>
				<th> Obtained Percentage/CGPA	</th>
				<th> Year of Passing</th>
				<th> Roll No. / Registration No.</th>
				<th> Stream</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<p>12th</p>
				</td>
				<td>
				<input type="hidden" name="schooling_id_twelfth" id="schooling_id_twelfth" value="<?php echo $schooling_id_twelfth; ?>" >
				<input class="form-control" type="text" name="academic_twelfth_inst" id="academic_twelfth_inst" maxlength="200" data-parsley-required="true" data-parsley-required-message="Please Enter Institute Name" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[1, 200]" value="<?php echo $inst_name_twelfth; ?>">
				</td>
				<td>
					<div class="form-group mg-b-10-force">
						<select class="form-control select2" name="academic_twelfth_board" id="academic_twelfth_board" title="Select Board" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BOARD_MSG; ?>" data-parsley-errors-container="#custom-academic_twelfth_board-parsley-error">
							<option value="">Select</option>
						</select>
						<span id="custom-academic_twelfth_board-parsley-error"></span>
					</div>
					<div class="form-group" id="other_board2" style="display: none;">
					<input type="text" class="form-control" name="other_twelfth_board" id="other_twelfth_board" placeholder="If Other, please enter here.." maxlength="<?php echo APLCT_OTHER_BOARD_MAXLENGTH; ?>" value="<?php echo $other_board_name_twelfth; ?>">
				   </div>
				</td>
				
				<td>
					<div class="form-group mg-b-10-force" > 
						<select class="form-control select2" name="academic_marking_scheme_twelfth" id="academic_marking_scheme_twelfth" title="Select Academic Marking Scheme" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MARK_SCHEME_MSG; ?>" data-parsley-errors-container="#custom-academic_marking_scheme_twelfth-parsley-error">
						<option value="">Select</option>
						</select>
						<span id="custom-academic_marking_scheme_twelfth-parsley-error"></span>
					</div>
				</td>
				<td>
				<div class="">
					<input class="form-control" type="text" name="academic_obtain_cgpa_twelfth" id="academic_obtain_cgpa_twelfth" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG; ?>"  data-parsley-type-message="<?php echo REQD_PERCENT_CGPA_VALID_MSG; ?>" data-parsley-trigger="keyup" data-parsley-type="number" value="<?php echo $mark_percentage_twelfth; ?>" maxlength="<?php echo APLCT_PERCENT_CGPA_MAXLENGTH; ?>">
				</div>
				</td>
				<td>
					<div class="form-group mg-b-10-force">
					  <div>
					  <input class="form-control" type="text" name="academic_yr_passing_twelfth" id="academic_yr_passing_twelfth" class="form-control datepicker" placeholder="YYYY" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_YEAR_OF_PASSING_MSG; ?>" data-parsley-trigger="change" value="<?php echo $completion_year_twelfth; ?>" maxlength="<?php echo APLCT_YEAR_OF_PASSING_MAXLENGTH; ?>" onkeypress="return isNumber(event);">
                      </div>
                      <span id="custom-academic_yr_passing_twelfth-parsley-error"></span>
                      </div>
				</td>
				<td>
				<div class="reg_width">
					<input class="form-control" type="text" name="academic_reg_no_twelfth" id="academic_reg_no_twelfth" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_REG_NO_MSG; ?>" data-parsley-length="[1, <?php echo APLCT_REG_NO_MAXLENGTH; ?>]" value="<?php echo $registration_no_twelfth; ?>" data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_REG_NO_MSG; ?>">
				</div>
				</td>				
				<td>
					<div class="" >
					<div class="form-group mg-b-10-force">
						<select class="form-control select2" name="academic_stream" id="academic_stream" title="Select Stream" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_STREAM_MSG;?>" data-parsley-errors-container="#custom-academic_stream-parsley-error">
							<option value="">Select</option>
						</select>
						<span id="custom-academic_stream-parsley-error"></span>
					</div>
					<div class="form-group" id="other_stream" style="display:none;">
					<input type="text" class="form-control" name="academic_stream_other" id="academic_stream_other" placeholder="If Other, please enter here.." maxlength="<?php echo APLCT_100_MAXLENGTH;?>" value="<?php echo $other_stream_name; ?>">
				   </div>
				   </div>
				</td>
			</tr>
		</tbody>
	</table>
	</div>
	<div class="help_text"><?php echo DIPLOMA_HOLDER_MSG;?></div>
	<div><h5 class="text-primary mb-3 mt-4 ugtable" style="display:none;">Under Graduation Details</h5></div>
	<div class="table-responsive">
	<table class="table table-bordered  mt-0 ugtable" id="ugtable" style="display:none;">
            <thead class="thead-light">
                <tr>
                    <th></th>
                    <th> Institute</th>
                    <th> University </th>                    
                    <th> Marking Scheme </th>
                    <th> Obtained Percentage/CGPA </th>
                    <th> Year of Passing </th>
                    <th> Roll No / Registration No</th>
                    <th> Degree </th> 
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p>UG</p>
                    </td>
                    <td>
                        <input class="form-control" type="hidden" placeholder="" id="grad_id_ug" name="grad_id_ug" value="<?php echo $applicant_grad_det_id_ug; ?>">
                        <input class="form-control" type="text" name="institute_name_ug" id="institute_name_ug" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_INSTITUTE_NAME_MSG;?>" data-parsley-maxlength="<?php echo APLCT_INSTITUTE_NAME_MAXLENGTH;?>" maxlength="<?php echo APLCT_INSTITUTE_NAME_MAXLENGTH;?>" data-parsley-errors-container="#custom-institute_name_ug-parsley-error" value="<?php echo $institute_name_ug;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>">
                        <span id="custom-institute_name_ug-parsley-error"></span>
                    </td>
                    <td>
                        <div class="form-group mg-b-10-force">
                          <select class="form-control custom-select" id="university_ug" name="university_ug" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_UNIVERSITY_MSG; ?>" data-parsley-errors-container="#custom-university_ug-parsley-error" data-parsley-trigger="change">
                          <option value="">Select</option>
                          </select>
                        </div>
                        <div class="form-group" id="other_univ_ug" style="display: none;">
    					<input type="text" class="form-control" name="university_other_ug" id="university_other_ug" placeholder="If Other, please enter here.." maxlength="<?php echo APLCT_OTHER_BOARD_MAXLENGTH; ?>" value="<?php echo $university_other_ug; ?>">
    				   </div>
                        <span id="custom-university_ug-parsley-error"></span>
                    </td>
                    
                    <td>
                        <div class="form-group mg-b-10-force markug" style="display:none;" id="Appering_info_1">
                            <select class="form-control custom-select" id="user_marking_scheme_ug" name="user_marking_scheme_ug" data-parsley-required="true"  data-parsley-required-message="<?php echo REQD_MARK_SCHEME_MSG; ?>" data-parsley-errors-container="#custom-user_marking_scheme_ug-error" data-parsley-trigger="change">
                            <option value="">Select</option>
                            </select>
                        
                        </div>
                        <span id="custom-user_marking_scheme_ug-error"></span>
                    </td>
                    <td>
                     <div class="form-group mg-b-10-force markug" style="display:none;">
                        <input class="form-control" type="text" placeholder="" id="obtained_percentage_cgpa_ug" name="obtained_percentage_cgpa_ug" maxlength="<?php echo APLCT_PERCENT_CGPA_MAXLENGTH; ?>" value="<?php echo $obtained_percentage_cgpa_ug; ?>" data-parsley-required="true"  data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG; ?>" data-parsley-errors-container="#custom-obtained_percentage_cgpa_ug-error" data-parsley-type-message="<?php echo REQD_PERCENT_CGPA_VALID_MSG; ?>" data-parsley-trigger="keyup" data-parsley-type="number">
                        <span id="custom-obtained_percentage_cgpa_ug-error"></span>
                      </div>
                    </td>
                    <td>
                    <div class="form-group mg-b-10-force">						
					 <div>
					  <input class="form-control" type="text" name="yr_passing_ug" id="yr_passing_ug" class="form-control datepicker" placeholder="YYYY" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_YEAR_OF_PASSING_MSG; ?>" data-parsley-trigger="change" value="<?php echo $completion_year_ug; ?>" maxlength="<?php echo APLCT_YEAR_OF_PASSING_MAXLENGTH; ?>" onkeypress="return isNumber(event);">
                      </div>
						<span id="custom-yr_passing_ug-parsley-error"></span>
					</div>
                    </td>
                    <td class="reg_width">
                        <input class="form-control" id="register_no_ug"  maxlength="20" type="text" name="register_no_ug" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_REG_NO_MSG; ?>" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" data-parsley-errors-container="#custom-register_no_ug-error" value="<?php echo $register_no_ug; ?>" data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_REG_NO_MSG; ?>">
                        <span id="custom-register_no_ug-error"></span>
                    </td>
                    
                    <td>
                        <input class="form-control" id="degree_ug" type="text" name="degree_ug" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DEGREE_NAME_MSG;?>" maxlength="<?php echo APLCT_DEGREE_MAXLENGTH;?>" data-parsley-errors-container="#custom-degree_ug-error" value="<?php echo $degree_ug;?>">
                        <span id="custom-degree_ug-error"></span>
                    </td>
                    
                </tr>
            </tbody>
        </table>
        </div>
        <div><h5 class="text-primary mb-3 mt-4 pgtable" style="display:none;">Post Graduation Details</h5></div>
	    <div class="table-responsive">
	    <table class="table table-bordered  mt-0 pgtable" id="pgtable" style="display:none;">
            <thead class="thead-light">
                <tr>
                    <th></th>
                    <th> Institute</th>
                    <th> University </th>                    
                    <th> Marking Scheme </th>
                    <th> Obtained Percentage/CGPA </th>
                    <th> Year of Passing </th>
                    <th> Roll No / Registration No</th>
                    <th> Degree </th> 
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p>PG</p>
                    </td>
                    <td>
                        <input class="form-control" type="hidden" placeholder="" id="grad_id_pg" name="grad_id_pg" value="<?php echo $applicant_grad_det_id_pg; ?>">
                        <input class="form-control" type="text" name="institute_name_pg" id="institute_name_pg" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_INSTITUTE_NAME_MSG; ?>" data-parsley-maxlength="<?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>" maxlength="100" data-parsley-errors-container="#custom-institute_name_pg-parsley-error" value="<?php echo $institute_name_pg;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>">
                        <span id="custom-institute_name_pg-parsley-error"></span>
                    </td>
                    <td>
                        <div class="form-group mg-b-10-force">
                            <select class="form-control custom-select" id="university_pg" name="university_pg" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_UNIVERSITY_MSG; ?>" title="Select university" data-parsley-errors-container="#custom-university_pg-parsley-error" data-parsley-trigger="change">
                            <option value="">Select</option>
                            </select>
                        </div>
                        <span id="custom-university_pg-parsley-error"></span>
                    <div class="form-group" id="other_univ_pg" style="display: none;">
    					<input type="text" class="form-control" name="university_other_pg" id="university_other_pg" placeholder="If Other, please enter here.." maxlength="<?php echo APLCT_OTHER_BOARD_MAXLENGTH; ?>" value="<?php echo $university_other_pg; ?>">
    				   </div>
                    </td>
                    
                    <td>
                        <div class="form-group mg-b-10-force markpg" style="display:none" id="Appering_info_1">
                            <select class="form-control custom-select" id="user_marking_scheme_pg" name="user_marking_scheme_pg" data-parsley-required="true"  data-parsley-required-message="<?php echo REQD_MARK_SCHEME_MSG; ?>" data-parsley-errors-container="#custom-user_marking_scheme_pg-error" data-parsley-trigger="change">
                            <option value="">Select</option>
                            </select>
                        </div>
                        <span id="custom-user_marking_scheme_pg-error"></span>
                    </td>
                    <td>
                    <div class="form-group mg-b-10-force markpg" style="display:none" id="Appering_info_2">
                        <input class="form-control" type="text" placeholder="" id="obtained_percentage_cgpa_pg" name="obtained_percentage_cgpa_pg" maxlength="<?php echo APLCT_PERCENT_CGPA_MAXLENGTH; ?>" value="<?php echo $obtained_percentage_cgpa_pg; ?>" data-parsley-required="true"  data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG; ?>" data-parsley-errors-container="#custom-obtained_percentage_cgpa_pg-error" data-parsley-type-message="<?php echo REQD_PERCENT_CGPA_VALID_MSG; ?>" data-parsley-trigger="keyup" data-parsley-type="number">
                        <span id="custom-obtained_percentage_cgpa_pg-error"></span>
                    </td>
                    </div>
                    <td>
                    <div class="form-group mg-b-10-force">						
					  <div>
					  <input class="form-control" type="text" name="yr_passing_pg" id="yr_passing_pg" class="form-control datepicker" placeholder="YYYY" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_YEAR_OF_PASSING_MSG; ?>" data-parsley-trigger="change" value="<?php echo $completion_year_pg; ?>" maxlength="<?php echo APLCT_YEAR_OF_PASSING_MAXLENGTH; ?>" onkeypress="return isNumber(event);">
                      </div>
						<span id="custom-yr_passing_pg-parsley-error"></span>
					</div>
                    </td>
                    <td class="reg_width">
                        <input class="form-control" id="register_no_pg" type="text" name="register_no_pg" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_REG_NO_MSG; ?>" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" data-parsley-errors-container="#custom-register_no_pg-error" value="<?php echo $register_no_pg; ?>" data-parsley-type='alphanum'  data-parsley-type-message="<?php echo VALID_REG_NO_MSG; ?>">
                        <span id="custom-register_no_pg-error"></span>
                    </td>
                    <td>
                        <input class="form-control" id="degree_pg" type="text" name="degree_pg" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DEGREE_NAME_MSG; ?>" maxlength="<?php echo APLCT_DEGREE_MAXLENGTH;?>" data-parsley-errors-container="#custom-degree_pg-error" value="<?php echo $degree_pg;?>">
                        <span id="custom-degree_pg-error"></span>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>
	<div class="w-100 mt-5">
		<div class="Payment_align">
			<!-- <a href="#" class="btn btn-primary active float-right" role="button"
				aria-pressed="true">MAKE PAYMENT</a> -->
		</div>
	</div>

   
</fieldset>
<h3 class="wizard_head_tag">Payment Details</h3>
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
                  <div class="card-body" style="font-size: 13px;"><?php echo $applicant_payment_wizard_instructions; ?></div>
              </div>
          </div>

          <!-- card -->
      </div>
      <div class="row">
          <div class="col-lg-6">
              <div class="card mb-3 base_details_card">
                  <div class="card-body">
                      <h5 class="card-title card_title">Personal Details</h5>
                      <p class="card-subtitle mb-3">Name : <span id="payment_applicant_name"></span></p>
                      <p class="card-subtitle mb-3">E-Mail : <span id="payment_applicant_email_id"></span></p>
                      <p class="card-subtitle">Phone Number : <span id="payment_applicant_phone"></span></p>
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
                      <p class="card-subtitle mb-3 mt-3">Sub Total <span class="float-right"><?php echo $appln_form_fee; ?></span>
                      </p>
                      <p class="card-subtitle">Total<span class="float-right"><?php echo $appln_form_fee; ?></span>
                      </p>
                      <div id="payment_details" style="display: none;">

                                <div class="col-md-12 mt-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select class="form-control select2" name="BankName" id="BankName" title="Select Bank Name" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHOOSE_BANK_MSG; ?>" data-parsley-errors-container="#custom-BankName-parsley-error">
                                                <option value=""  selected="selected">Select Bank Name</option>
                                            </select>
                                            <span id="custom-BankName-parsley-error"></span>
                                        </div>
                                        <div class="col-md-6">
                                         	<input class="form-control" type="text" name="BranchName" placeholder="Branch Name" id="BranchName" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BANK_NAME_MSG; ?>" maxlength="<?php echo APLCT_BRANCH_NAME_MAXLENGTH; ?>" value="<?php echo $branch_name; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo VALID_BANK_NAME_MSG; ?>">
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
                      <!-- <a href="payment_success.html" class="btn btn-primary active w-100 mt-3" role="button"
                          aria-pressed="true">MAKE PAYMENT</a> -->

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

			<div id="collapseOne7" class="collapse bg-light show" role="tabpanel" aria-labelledby="headingOne" style="">
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
                              
                              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_photograph; ?>">
                                 <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_photograph; ?>')">&times;</a>
                                 <strong id="deleteMessageStatus_<?php echo $document_id_photograph; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_photograph; ?>"></span>
                             </div>
                           <?php } ?>
                           <span id="custom-photograph-parsley-error"></span>
                        </div>
                        <div class="form-group col-md-6">
						<label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Signature <span class="tx-danger">*</span> </label>
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
					 <div class="form-group col-md-6 ">
                           <label for="exampleFormControlTextarea1">Upload Your Graduation Marksheet <span class="tx-danger" id="graduationsheet">*</span></label>
                           <input type="file" class="filestyle" name="graduation_marksheet" id="graduation_marksheet" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_UPLOAD_GRAD_MARK_MSG; ?>" data-parsley-errors-container="#custom-graduation_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_graduation_marksheet])){ echo $docs[$document_id_graduation_marksheet]['id']; } ?>"accept="<?php  echo allow_extension($file_allowed_type); ?>">
                           <?php if(isset($docs[$document_id_graduation_marksheet])){ ?>
                            
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
						<h5 class="text-primary mb-3">Declaration</h5>
						<p><?php echo DECLARATION;?></p>
					</div>	
				</div>
				<div class="row w-100">
                            <div class="col-md-6">
                                <label class="form-control-label">Applicant Name <span class="tx-danger">*</span></label>						 
                                <input class="form-control" type="text" name="applicant_name" id="applicant_name" placeholder="Enter Applicant Name" placeholder="Enter Applicant Name" maxlength="<?php echo APLCT_100_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_APPLT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>" data-parsley-length="[1, <?php echo APLCT_100_MAXLENGTH; ?>]" value="<?php echo $applicant_name; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-control-label">Parent Name <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="parent_name" id="parent_name" placeholder="Parent Name" maxlength="<?php echo APLCT_100_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_PARENT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>" data-parsley-length="[1,  <?php echo APLCT_100_MAXLENGTH; ?>]" value="<?php echo $parent_name; ?>" >
                            </div>	
                 </div>
				<div class="row w-100 mt-3">
					<div class="col-md-6">
						<label class="form-control-label">Date <span class="tx-danger">*</span></label>
						<input class="form-control" type="text" name="date_dec" id="date_dec" placeholder="Declartion Date" value="<?php echo $declared_date; ?>" readonly>
					</div>
				</div>	
				<div class="row w-100 mt-3">				
                </div>			
			</div><!-- row -->
		</div>
	</div>
</fieldset>
<?php form_close(); ?><!-- form -->