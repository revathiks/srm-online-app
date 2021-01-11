<?php 
   $ssclMaxYop=date("Y", strtotime(date("Y") . " - 24 months"));
   $ssclMaxYop=date("Y");
   
   if($applicant_graduations_list[0]['is_curr_qualify']=='t' && !empty($applicant_graduations_list)){
   	$style="display:inherit;";
	$required_asterisk ="*";
	$required ="true";
   }else{
   	$style="display:none;";
	$required_asterisk ="";
	$required ="false";
   }
   
   $parent_type_id_father = PARENT_TYPE_ID_FATHER;
   $parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
   $parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
   $country_value_default = COUNTRY_VALUE_DEFAULT;
   
   $form_wizard_basic_id = FORM_WIZARD_BASIC_ID;
   $form_wizard_preference_personal_id = FORM_WIZARD_PERSONAL_ID;
   $form_wizard_parent_address_id = FORM_WIZARD_PARENT_ID; 
   $form_wizard_address_id = FORM_WIZARD_ADDRESS_ID;
   $form_wizard_academic_id = FORM_WIZARD_ACADEMIC_ID;
   $form_wizard_payment_id = FORM_WIZARD_PAYMENT_ID;
   $form_wizard_declaration_id = FORM_WIZARD_UPLOAD_DECLARATION_ID;
   
   $first_name = $applicant_basic_details_list['f_name'];
   $last_name = $applicant_basic_details_list['l_name'];
   $middle_name=isset($applicant_basic_details_list['m_name'])?$applicant_basic_details_list['m_name']:'';
   $phone_no = $applicant_basic_details_list['mob_no'];
   $email_id = $applicant_basic_details_list['e_mail'];
   
   $second_mobile_no = $applicant_basic_details_list['sec_mob_no'];
   if($applicant_basic_details_list['dob']){
   	$dob=isset($applicant_basic_details_list['dob'])? date('m/d/Y',strtotime($applicant_basic_details_list['dob'])):'';
   }
   
   $second_email_id = $applicant_basic_details_list['sec_e_mail'];
   $aadhar_no = $applicant_basic_details_list['aadhar_no'];
   $parent_name = $applicant_basic_details_list['parent_name'];
   
   $document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
   $document_id_signature = DOCUMENT_ID_SIGNATURE;
   $document_id_tenth_marksheet = DOCUMENT_ID_TENTH_MARKSHEET;
   $document_id_twelvfth_marksheet = DOCUMENT_ID_TWELVFTH_MARKSHEET;
   $document_id_provsional_certicate = DOCUMENT_ID_PROVISIONAL_CERTICATE;
   $document_id_graduation_marksheet = DOCUMENT_ID_GRADUATION_MARKSHEET;
   
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
   
   if($applicant_prof_exps_list) {
      foreach($applicant_prof_exps_list as $k=>$v) {
         $applicant_prof_exp_id[] = $v['exp_id'];
         $applicant_prof_exp_org_name[] = $v['org_name'];
         $applicant_prof_exp_designation[] = $v['designation'];
         $applicant_prof_exp_job_nature[] = $v['job_nature'];
         $applicant_prof_exp_salary[] = $v['salary'];
         $applicant_prof_exp_from_date[] = $v['from_date'];
         $applicant_prof_exp_to_date[] = $v['to_date'];
         $applicant_prof_exp_work_exp_in_months[] = $v['work_exp_month'];
         $applicant_prof_exp_work_exp[] = $v['wor_exp'];
      }
   }
   
   if(is_array($applicant_prof_exp_work_exp_in_months)){
   $total_applicant_prof_exp_work_exp_in_months = array_sum($applicant_prof_exp_work_exp_in_months);
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
         $applicant_parent_title_id[$parent_type_id] = $v['title_id'];
         $applicant_parent_title_name[$parent_type_id] = $v['title_name'];
   	  $applicant_parent_other_occupation_name[$parent_type_id] = $v['other_occupation_name'];
      }
   }
   
   $applicant_schooling_list_tenth_id = $applicant_schooling_list[0]['applicant_scl_det_id'];
   $applicant_schooling_list_twelfth_id = $applicant_schooling_list[1]['applicant_scl_det_id'];
   
   
   if($applicant_schooling_list) {
      foreach($applicant_schooling_list as $k=>$v) {
         $applicant_scl_det_id = $v['applicant_scl_det_id'];
         $schooling_name[$applicant_scl_det_id] = $v['schooling_name'];
   	  $inst_name[$applicant_scl_det_id] = $v['inst_name'];
   	  $mark_percentage[$applicant_scl_det_id] = $v['mark_percentage'];
   	  $completion_year[$applicant_scl_det_id] = $v['completion_year'];
   	  $registration_no[$applicant_scl_det_id] = $v['registration_no'];
   	  $name_as_in_marksheet[$applicant_scl_det_id] = $v['name_as_in_marksheet'];
   	  $result_declared[$applicant_scl_det_id] = $v['result_declared'];
   	  $is_curr_qualify[$applicant_scl_det_id] = $v['is_curr_qualify'];
   	  $other_board_name[$applicant_scl_det_id] = $v['other_board_name'];
   	  $other_stream_name[$applicant_scl_det_id] = $v['other_stream_name'];
      }
   }
   
   $name_as_in_marksheet = $name_as_in_marksheet[$applicant_schooling_list_tenth_id];
   
   // Schooling Detail Get Tenth
   $inst_name_tenth = $inst_name[$applicant_schooling_list_tenth_id];
   $mark_percentage_tenth = $mark_percentage[$applicant_schooling_list_tenth_id];
   $registration_no_tenth = $registration_no[$applicant_schooling_list_tenth_id];
   $other_board_name_tenth = $other_board_name[$applicant_schooling_list_tenth_id];
   $completion_year_tenth = $completion_year[$applicant_schooling_list_tenth_id];
   // Schooling Detail Get Twelfth
   $inst_name_twelfth = $inst_name[$applicant_schooling_list_twelfth_id];
   $mark_percentage_twelfth = $mark_percentage[$applicant_schooling_list_twelfth_id];
   $registration_no_twelfth = $registration_no[$applicant_schooling_list_twelfth_id];
   $other_board_name_twelfth = $other_board_name[$applicant_schooling_list_twelfth_id];
   $completion_year_twelfth = $completion_year[$applicant_schooling_list_twelfth_id];
   $other_stream_name = $other_stream_name[$applicant_schooling_list_twelfth_id];
   
   $mark_percentage_graduation = $applicant_graduations_list[0]['mark_percentage'];
   $reg_no_graduation = $applicant_graduations_list[0]['reg_no'];
   $yop_passing_graduation = $applicant_graduations_list[0]['yr_of_pass'];
   $grad_inst_name = $get_grad_inst_name['insti_name'];
   $grad_university_other_name = $get_grad_inst_name['other_university_name'];
   
   $is_work_experience = $applicant_other_details_list['is_work_experience'];
   
   // Declaration Show
   $applicant_name_declaration = $applicant_appln_details_list['applicant_name_declaration'];
   $applicant_name_declaration = ($applicant_name_declaration)?$applicant_name_declaration:$first_name;
   
   $applicant_parentname_declaration = $applicant_appln_details_list['applicant_parentname_declaration'];
   $father_name = $applicant_parent_parent_name[$parent_type_id_father];
   $mother_name = $applicant_parent_parent_name[$parent_type_id_mother];
   $guardian_name = $applicant_parent_parent_name[$parent_type_id_guardian];
   $applicant_parentname_declaration = (($applicant_parentname_declaration)?$applicant_parentname_declaration:(($father_name)?$father_name:(($mother_name)?$mother_name:(($guardian_name)?$guardian_name:''))));
   
   $ddate = $applicant_appln_details_list['applicant_declaration_date'];
   $ddate = ($ddate)?date('d/m/Y',strtotime($ddate)):date('d/m/Y');
   $application_status_id = $applicant_appln_details_list['application_status_id'];
   
   /* form wizard instruction detail start */
   
   /* Basic Detail Instructions Start */
   $applicant_basic_wizard_id = $applicant_instructions_list[$form_wizard_basic_id][0]['form_w_wizard_id'];
   $applicant_basic_wizard_instructions = $applicant_instructions_list[$form_wizard_basic_id][0]['instruction'];
   if($applicant_basic_wizard_instructions) {
     $applicant_basic_wizard_instructions = nl2br($applicant_basic_wizard_instructions);
   } else {
     $applicant_basic_wizard_instructions = ' - ';
   }
   $applicant_basic_wizard_percent = $applicant_instructions_list[$form_wizard_basic_id][0]['completion_percent'];
   /* Basic Detail Instructions End */
   
   /* Preferences Instructions Start */
   $applicant_pref_per_wizard_id = $applicant_instructions_list[$form_wizard_preference_personal_id][0]['form_w_wizard_id'];
   $applicant_pref_per_wizard_instructions = $applicant_instructions_list[$form_wizard_preference_personal_id][0]['instruction'];
   if($applicant_pref_per_wizard_instructions) {
     $applicant_pref_per_wizard_instructions = nl2br($applicant_pref_per_wizard_instructions);
   } else {
     $applicant_pref_per_wizard_instructions = ' - ';
   }
   $applicant_pref_per_wizard_percent = $applicant_instructions_list[$form_wizard_preference_personal_id][0]['completion_percent'];
   /* Preferences Instructions End */
   
   /* Parent Instructions Start */
   $applicant_parent_address_wizard_id = $applicant_instructions_list[$form_wizard_parent_address_id][0]['form_w_wizard_id'];
   $applicant_parent_address_wizard_instructions = $applicant_instructions_list[$form_wizard_parent_address_id][0]['instruction'];
   if($applicant_parent_address_wizard_instructions) {
     $applicant_parent_address_wizard_instructions = nl2br($applicant_parent_address_wizard_instructions);
   } else {
     $applicant_parent_address_wizard_instructions = ' - ';
   }
   $applicant_parent_address_wizard_percent = $applicant_instructions_list[$form_wizard_parent_address_id][0]['completion_percent'];
   /* Parent Instructions End */
   
   /* Address Instructions Start */
   $applicant_address_wizard_id = $applicant_instructions_list[$form_wizard_address_id][0]['form_w_wizard_id'];
   $applicant_address_wizard_instructions = $applicant_instructions_list[$form_wizard_address_id][0]['instruction'];
   if($applicant_address_wizard_instructions) {
     $applicant_address_wizard_instructions = nl2br($applicant_address_wizard_instructions);
   } else {
     $applicant_address_wizard_instructions = ' - ';
   }
   $applicant_parent_address_wizard_percent = $applicant_instructions_list[$form_wizard_address_id][0]['completion_percent'];
   /* Address Instructions End */
   
   /* Academic Instructions Start */
   $applicant_academic_wizard_id = $applicant_instructions_list[$form_wizard_academic_id][0]['form_w_wizard_id'];
   $applicant_academic_wizard_instructions = $applicant_instructions_list[$form_wizard_academic_id][0]['instruction'];
   if($applicant_academic_wizard_instructions) {
     $applicant_academic_wizard_instructions = nl2br($applicant_academic_wizard_instructions);
   } else {
     $applicant_academic_wizard_instructions = ' - ';
   }
   $applicant_academic_wizard_percent = $applicant_instructions_list[$form_wizard_academic_id][0]['completion_percent'];
   /* Academic Instructions End */
   
   /* Payment Instructions Start */
   $applicant_payment_wizard_id = $applicant_instructions_list[$form_wizard_payment_id][0]['form_w_wizard_id'];
   $applicant_payment_wizard_instructions = $applicant_instructions_list[$form_wizard_payment_id][0]['instruction'];
   if($applicant_payment_wizard_instructions) {
     $applicant_payment_wizard_instructions = nl2br($applicant_payment_wizard_instructions);
   } else {
     $applicant_payment_wizard_instructions = ' - ';
   }
   $applicant_payment_wizard_percent = $applicant_instructions_list[$form_wizard_payment_id][0]['completion_percent'];
   /* Payment Instructions End */
   
   /* Upload Instructions Start */
   $applicant_upload_wizard_id = $applicant_instructions_list[$form_wizard_declaration_id][0]['form_w_wizard_id'];
   $applicant_upload_wizard_instructions = $applicant_instructions_list[$form_wizard_declaration_id][0]['instruction'];
   if($applicant_upload_wizard_instructions) {
     $applicant_upload_wizard_instructions = nl2br($applicant_upload_wizard_instructions);
   } else {
     $applicant_upload_wizard_instructions = ' - ';
   }
   $applicant_upload_wizard_percent = $applicant_instructions_list[$form_wizard_declaration_id][0]['completion_percent'];
   /* Upload Instructions End */
   
   /* form wizard instruction detail end */
   
   $appln_form_fee = $applicant_appln_details_list['appln_form_fee'];
   
   /* Payment Details Start */
   $branch_name = $payment_details_list['branch_name'];
   $dd_cheque_no = $payment_details_list['dd_cheque_no'];
   $dd_cheque_date = $payment_details_list['dd_cheque_date'];
   
   if($dd_cheque_date) {
       $dd_cheque_date = date('m/d/Y',strtotime($dd_cheque_date));
   }
   
   $payment_mode_id = $payment_details_list['payment_mode_id'];
   /* Payment Details End */
   
   $attributes = array('class' => 'form-horizontal form-wizard-wrapper .custom-validation', 'id' => 'dist_edu_form', 'name' => 'dist_edu_form', 'enctype' => 'multipart/form-data', 'data-parsley-validate data-toggle'=>"validator");
   echo form_open('', $attributes);
   ?>
<div class="loader" style="display:none;">
</div>
<div>
   <div id="formerr" style="display:none;color:red"><?php echo SOMETHING_WENT_WRONG; ?></div>
</div>
<div class="mb-3">
   <div class="progress">
      <div class="progress-bar" id="percentage_bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo PROGRESS_INITIAL;?></div>
   </div>
</div>
<h3 class="wizard_head_tag">Basic Details</h3>
<div class="text-right w-100">
   <button class="btn btn-primary" type="button">Step <span id='show_currentindex'></span></button>
</div>
<fieldset>
   <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
      <div class="card ">
         <div class="card-header p-0 " role="tab" id="headingOne">
            <h6 class="p-2 ml-3">
               <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed">
               <i class="fas fa-info-circle"></i> Instructions</a>
            </h6>
         </div>
         <!-- card-header -->
         <div id="collapseOne" class="collapse bg-light show" role="tabpanel" aria-labelledby="headingOne" style="">
            <div class="card-body" style="font-size: 13px;">
               <?php echo $applicant_basic_wizard_instructions; ?>
            </div>
         </div>
      </div>
      <!-- card -->
   </div>
   <div class="w-100 pd-20 pd-sm-40">
      <h6 class="card-body-title"></h6>
      <div class="form-layout">
         <div class="row mg-b-25 mt-3">
            <div class="col-lg-6">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Are you currently a resident of Tamil Nadu? <span class="tx-danger">*</span></label>
                  <select class="form-control custom-select" name="current_resident_tn" id="current_resident_tn" title="Choose Resident" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHOOSE_RESIDENT_MSG; ?>" data-parsley-errors-container="#custom-current_resident_tn-parsley-error">
                     <option value="">Select Status - Yes or No</option>
                     <option value="yes">Yes</option>
                     <option value="no">No</option>
                  </select>
                  <span id="custom-current_resident_tn-parsley-error"></span>	
               </div>
            </div>
			<input type="hidden" name="appln_status" id="appln_status" value="<?php echo $application_status_id; ?>">
         </div>
         <div class="form-group formAreaCols" id="guidelines"><b><?php echo GUIDELINES_DDE; ?></b></div>
      </div>
      <!-- form-layout -->
   </div>
</fieldset>
<h3 class="wizard_head_tag">Personal Details</h3>
<fieldset>
   <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
      <div class="card ">
         <div class="card-header p-0 " role="tab" id="headingOne">
            <h6 class="p-2 ml-3">
               <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed">
               <i class="fas fa-info-circle"></i> Instructions</a>
            </h6>
         </div>
         <!-- card-header -->
         <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
            <div class="card-body" style="font-size: 13px;">
               <?php echo $applicant_pref_per_wizard_instructions; ?>
            </div>
         </div>
      </div>
      <!-- card -->
   </div>
   <div class="w-100 pd-20 pd-sm-40">
      <h5 class="text-primary mb-3">Select Course Preferences</h5>
      <div class="form-layout">
         <div class="row mg-b-25 mt-3">
            <div class="col-lg-6">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Program Level <span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Program" tabindex="-1" aria-hidden="true" name="pd_program" id="pd_program" title="Choose Program" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHOOSE_PROGRAM_MSG; ?>" data-parsley-errors-container="#custom-pd_program-parsley-error" data-parsley-trigger="change">
                     <option value="">Select Level of Program</option>
                  </select>
                  <span id="custom-pd_program-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-lg-6" id="main_div_course" style="display:none;">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Course Preference <span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Course" tabindex="-1" aria-hidden="true" name="pd_course" id="pd_course" title="Choose Course" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHOOSE_COURSE_MSG; ?>" data-parsley-errors-container="#custom-pd_course-parsley-error">
                     <option value="">Select</option>
                  </select>
                  <span id="custom-pd_course-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-lg-6" id="main_div_campus" style="display:none;">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Campus <span class="tx-danger"></span></label>
                  <select class="form-control select2" data-placeholder="Choose Campus" tabindex="-1" aria-hidden="true" name="pd_campus" id="pd_campus" title="Choose Campus" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_CHOOSE_CAMPUS_MSG; ?>" data-parsley-errors-container="#custom-pd_campus-parsley-error">
                     <option value="">Select</option>
                  </select>
                  <span id="custom-pd_campus-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
         </div>
         <!-- row -->
      </div>
      <!-- form-layout -->
   </div>
   <hr/>
   <div class="w-100 pd-20 pd-sm-40">
      <h5 class="text-primary mb-3">Personal Details</h5>
      <div class="form-layout">
         <div class="row mg-b-25">
            <div class="col-lg-4">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Title<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_title" id="pd_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG; ?>" data-parsley-errors-container="#custom-pd_title-parsley-error">
                     <option value="">Choose Title</option>
                  </select>
                  <span id="custom-pd_title-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-lg-4">
               <div class="form-group">
                  <label class="form-control-label">First Name <span class="tx-danger"> *</span></label>
                  <input class="form-control" type="text" name="pd_firstname" id="pd_firstname" placeholder="Enter First Name" placeholder="Your First Name" maxlength="<?php echo APLCT_FIRST_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_FIRST_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_FIRST_NAME_MINLENGTH; ?>, <?php echo APLCT_FIRST_NAME_MAXLENGTH; ?>]" value="<?php echo $first_name; ?>">
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-lg-4">
               <div class="form-group">
                  <label class="form-control-label">Middle Name </label>
                  <input class="form-control" type="text" name="pd_middlename" id="pd_middlename" placeholder="Your Middle Name" placeholder="Your Middle Name" maxlength="<?php echo APLCT_MIDDLE_NAME_MAXLENGTH; ?>"data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_MIDDLE_NAME_MINLENGTH; ?>, <?php echo APLCT_MIDDLE_NAME_MAXLENGTH; ?>]" value="<?php echo $middle_name; ?>">
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-lg-4">
               <div class="form-group">
                  <label class="form-control-label">Last Name <span class="tx-danger"> *</span></label>
                  <input class="form-control" type="text" name="pd_lastname"  id="pd_lastname" placeholder="Your Last Name" maxlength="<?php echo APLCT_LAST_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_LAST_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_LAST_NAME_MINLENGTH; ?>, <?php echo APLCT_LAST_NAME_MAXLENGTH; ?>]" data-parsley-pattern="/^[a-zA-Z-.\s]+$/" value="<?php echo $last_name; ?>">
                  <span><?php echo LAST_NAME_ALLOW_DOT; ?></span>
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-lg-4">
               <label class="form-control-label">Mobile No. <span class="tx-danger"> *</span></label>
               <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                  <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                     <select class="form-control form_control custom-select Mobile_number" id="phone_no_code" name="phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                        <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>
                     </select>
                  </span>
                  <input type="text" name="pd_mobile_no" id="pd_mobile_no" maxlength="<?php echo APLCT_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Mobile No" class="form-control" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOBILE_MSG; ?>"  data-parsley-errors-container="#custom-pd_mobile_no-parsley-error" value="<?php echo $phone_no; ?>" data-parsley-mobileonly="true">
               </div>
               <span id="custom-pd_mobile_no-parsley-error"></span>	
            </div>
            <div class="col-lg-4">
               <div class="form-group">
                  <label class="form-control-label">Email ID <span class="tx-danger"> *</span></label>
                  <input class="form-control" type="email" name="pd_email" id="pd_email" placeholder="Your email id." data-parsley-required="true" data-parsley-required-message="<?php echo REQD_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_email-parsley-error" value="<?php echo $email_id; ?>" maxlength="<?php echo APLCT_EMAIL_MAXLENGTH; ?>" readonly>
                  <span id="custom-pd_email-parsley-error"></span>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="wd-200 w-100">
                  <label class="form-control-label">Date of Birth<span class="tx-danger"> *</span></label>
                  <div class="input-group"><span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                     <input class="form-control hasDatepicker" name="pd_dob" id="pd_dob" placeholder="MM/DD/YYYY" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DOB_MSG; ?>" data-parsley-errors-container="#custom-pd_dob-parsley-error" value="<?php echo $dob; ?>">
                  </div>
               </div>
               <span id="custom-pd_dob-parsley-error"></span>
            </div>
            <div class="col-lg-4">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Gender <span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Gender" tabindex="-1" aria-hidden="true" name="pd_gender" id="pd_gender" title="Choose Gender" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_GENDER_MSG; ?>" data-parsley-errors-container="#custom-pd_gender-parsley-error">
                     <option label="Choose Gender"></option>
                     <option value="Male">Male</option>
                     <option value="Female">Female</option>
                     <option value="Transgender">Transgender</option>
                  </select>
                  <span id="custom-pd_gender-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-lg-4">
               <div class="form-group">
                  <label class="form-control-label">Alternate Email ID </label>
                  <input class="form-control" type="email" name="pd_alt_email" id="pd_alt_email" placeholder="Alternate Email" data-parsley-required="false" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_ALT_EMAIL_MSG; ?>" data-parsley-required-message="Please Choose Gender"  data-parsley-errors-container="#custom-pd_alt_email-parsley-error" value="<?php echo $second_email_id; ?>" data-parsley-notequalto="#pd_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH; ?>" maxlength="<?php echo APLCT_ALT_EMAIL_MAXLENGTH; ?>">
                  <span id="custom-pd_alt_email-parsley-error"></span>
                  <p id="suggestion_alt_email"></p>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Blood Group <span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Blood Group" tabindex="-1" aria-hidden="true" name="pd_blood_group" id="pd_blood_group" title="Choose Blood Group" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BLOOD_GRP_MSG; ?>" data-parsley-errors-container="#custom-pd_blood_group-parsley-error">
                     <option label="Choose Blood Group"></option>
                     <option value="a+">A+</option>
                     <option value="a-">A-</option>
                     <option value="ab+">AB+</option>
                     <option value="ab-">AB-</option>
                     <option value="b+">B+</option>
                     <option value="b-">B-</option>
                     <option value="o+">O+</option>
                     <option value="o-">O-</option>
                     <option value="Unknown">Unknown</option>
                  </select>
                  <span id="custom-pd_blood_group-parsley-error"></span>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Nationality <span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Nationality" tabindex="-1" aria-hidden="true" name="pd_nationality" id="pd_nationality" title="Choose Nationality" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_NATION_MSG; ?>" data-parsley-errors-container="#custom-pd_nationality-parsley-error">
                     <option value="">Select Nationality</option>
                  </select>
                  <span id="custom-pd_nationality-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-lg-4" id="main_div_social_status">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Social Status<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Social Status" tabindex="-1" aria-hidden="true" name="pd_social_status" id="pd_social_status" title="Choose Social Status" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SOCIAL_STATUS_MSG; ?>" data-parsley-errors-container="#custom-pd_social_status-parsley-error">
                     <option value="">Select Your Social Status</option>
                     <option value="General">General</option>
                     <option value="General / EWS">General / EWS</option>
                     <option value="OBC">OBC</option>
                     <option value="ST">ST</option>
                     <option value="SC">SC</option>
                  </select>
                  <span id="custom-pd_social_status-parsley-error"></span>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="form-group">
                  <label class="form-control-label">Aadhar Number <span class="tx-danger" id="aadhar_no_mandatory"> *</span></label>
                  <input class="form-control" type="text" name="pd_aadhaar_no" id="pd_aadhaar_no" placeholder="Your Aadhar Number" data-placeholder="Enter Aadhar Number"  data-parsley-required="true" data-parsley-required-message="<?php echo REQD_AADHAR_NO_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_AADHAR_NO_MSG; ?>" data-parsley-minlength="<?php echo APLCT_AADHAR_MINLENGTH; ?>" data-parsley-maxlength="<?php echo APLCT_AADHAR_MAXLENGTH; ?>" data-parsley-errors-container="#custom-pd_aadhaar_no-parsley-error" value="<?php echo $aadhar_no; ?>" maxlength="<?php echo APLCT_AADHAR_MAXLENGTH; ?>">
                  <span id="custom-pd_aadhaar_no-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-lg-4">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Are you a differently Abled?<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Differently Abled" tabindex="-1" aria-hidden="true" name="pd_diffrently_abled" id="pd_diffrently_abled" title="Choose Differently Abled" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DIFF_ABLED_MSG; ?>" data-parsley-errors-container="#custom-pd_diffrently_abled-parsley-error">
                     <option value="">Select differently Abled</option>
                     <option value="yes">Yes</option>
                     <option value="No">No</option>
                  </select>
                  <span id="custom-pd_diffrently_abled-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-lg-4" id="main_div_ndeformity" style="display:none;">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Nature of Deformity<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Nature of Deformity" tabindex="-1" aria-hidden="true" name="pd_nature_deformity" id="pd_nature_deformity" title="Choose Nature of Deformity" data-parsley-errors-container="#custom-pd_nature_deformity-parsley-error">
                     <option value>Select </option>
                     <option value="Locomotor">Locomotor / Orthopaedic Disability</option>
                     <option value="Visual">Visual Impairment</option>
                     <option value="Multiple">Multiple Disabilities </option>
                     <option value="Mental">Mental Retardation</option>
                     <option value="Speech">Speech and Hearing Disability
                     </option>
                  </select>
                  <span id="custom-pd_nature_deformity-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-lg-4" id="main_div_pdeformity" style="display:none;">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Percentage of Deformity<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Percentage of Deformity" tabindex="-1" aria-hidden="true" name="pd_percent_of_deformity" id="pd_percent_of_deformity" title="Choose Percentage of Deformity" data-parsley-errors-container="#custom-pd_percent_of_deformity-parsley-error">
                     <option value>Select </option>
                     <option value="10 %">10 %</option>
                     <option value="20 %">20 %</option>
                     <option value="30 %">30 %</option>
                  </select>
                  <span id="custom-pd_percent_of_deformity-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-lg-4">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Economically Weaker Section</label>
                  <select class="form-control select2" data-placeholder="Choose Economically Weaker Section" tabindex="-1" aria-hidden="true" name="pd_economically_weaker" id="pd_economically_weaker" title="Economically Weaker Section">
                     <option value="">Select Economically Weaker Section</option>
                     <option value="yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </div>
            </div>
         </div>
         <!-- row -->
      </div>
      <!-- form-layout -->
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
         </div>
         <!-- card-header -->
         <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
            <div class="card-body" style="font-size: 13px;">
               <?php echo $applicant_parent_address_wizard_instructions; ?>
            </div>
         </div>
      </div>
      <!-- card -->
   </div>
   <div class="w-100 pd-20 pd-sm-40">
      <h5 class="text-primary mb-3">Father's Details</h5>
      <div class="form-layout">
         <div class="row mg-b-25 mt-3">
            <div class="col-lg-4">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Title<span class="tx-danger">*</span></label>
                  <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_father_title" id="pd_father_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG; ?>" data-parsley-errors-container="#custom-pd_father_title-parsley-error">
                     <option label="Choose country"></option>
                     <option value="MR">MR</option>
                     <option value="MRS">MRS</option>
                     <option value="MISS">MISS</option>
                  </select>
                  <span id="custom-pd_father_title-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-lg-4">
               <div class="form-group">
                  <label class="form-control-label">Father's Name <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pd_father_name" id="pd_father_name" placeholder="Enter Your Father Name" maxlength="<?php echo APLCT_FATHER_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_FATHER_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_FATHER_NAME_MINLENGTH; ?>, <?php echo APLCT_FATHER_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_father]; ?>">
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-lg-4" id="father_mbleno_div" style="display:none;">
               <label class="form-control-label">Father's Mobile Number
               </label>
               <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                  <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                     <select class="form-control form_control custom-select Mobile_number" id="pd_father_phone_no_code" name="pd_father_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                        <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                        <option value="Law">Law</option>
                        <option value="Other">Other</option>
                     </select>
                  </span>
                  <?php 
                     $applicant_parent_mobile_no_father = ($applicant_parent_mobile_no[$parent_type_id_father]==0)?'':$applicant_parent_mobile_no[$parent_type_id_father];	
                     ?>
                  <input type="text" class="form-control" name="pd_father_phone" id="pd_father_phone" maxlength="<?php echo APLCT_FATHER_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_FATHER_MOBILE_MSG; ?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="<?php echo VALID_FATHER_MOBILE_MSG; ?>" data-parsley-errors-container="#custom-pd_father_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no_father; ?>" data-parsley-notequalto="#pd_mother_phone" data-parsley-notequalto-message="<?php echo PHONE_MATCH_FATHER; ?>">
               </div>
               <span id="custom-pd_father_phone-parsley-error"></span>
            </div>
            <div class="col-lg-4" id="father_email_div" style="display:none;">
               <div class="form-group">
                  <label class="form-control-label">Father's Email ID </label>
                  <input class="form-control" type="email" name="pd_father_email" id="pd_father_email"  placeholder="Enter Your Father's Email ID"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_FATHER_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_father_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_father]; ?>" maxlength="<?php echo APLCT_FATHER_EMAIL_MAXLENGTH; ?>" data-parsley-notequalto="#pd_mother_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_FATHER; ?>">
                  <span id="custom-pd_father_email-parsley-error"></span>
                  <p id="suggestion_father_email"></p>
               </div>
            </div>
            <div class="col-lg-4"  id="father_occupation_div" style="display:none;">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Father's Occupation</label>
                  <select class="form-control select2" data-placeholder="Choose Occupation" tabindex="-1" aria-hidden="true" name="pd_father_occupation" id="pd_father_occupation">
                     <option value="">Select Father's Occupation</option>
                     <option value="Business">Business</option>
                     <option value="Defence">Defence</option>
                     <option value="Government Sector">Government Sector
                     </option>
                     <option value="Homemaker">Homemaker</option>
                     <option value="Private Sector">Private Sector
                     </option>
                     <option value="Retired">Retired</option>
                     <option value="Other">Other</option>
                  </select>
               </div>
               <div id="other_occupation_father_div" style="display:none;">
                  <input class="form-control" type="text" name="other_occupation_father" id="other_occupation_father"  placeholder="If Other, pls enter here"data-parsley-required="false" data-parsley-errors-container="#custom-other_occupation_father-parsley-error" value="<?php echo $applicant_parent_other_occupation_name[$parent_type_id_father]; ?>">
                  <span id="custom-other_occupation_father-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
         </div>
         <!-- row -->
      </div>
      <!-- form-layout -->
   </div>
   <div class="w-100 pd-20 pd-sm-40">
      <h5 class="text-primary mb-3">Mother's Details</h5>
      <div class="form-layout">
         <div class="row mg-b-25 mt-3">
            <div class="col-lg-4">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Title<span
                     class="tx-danger">*</span></label>
                  <select class="form-control select2" name="pd_mother_title" id="pd_mother_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG; ?>" data-parsley-errors-container="#custom-pd_mother_title-parsley-error">
                     <option label="Choose country"></option>
                     <option value="MR">MR</option>
                     <option value="MRS">MRS</option>
                     <option value="MISS">MISS</option>
                  </select>
                  <span id="custom-pd_mother_title-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-lg-4">
               <div class="form-group">
                  <label class="form-control-label">Mother's Name <span class="tx-danger">*</span></label>
                  <input type="text" class="form-control" name="pd_mother_name" id="pd_mother_name" placeholder="Enter Your Mother Name" maxlength="<?php echo APLCT_MOTHER_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MOTHER_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_MOTHER_NAME_MINLENGTH; ?>, <?php echo APLCT_MOTHER_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_mother]; ?>">
               </div>
            </div>
            <!-- col-4 -->
            <?php 
               $applicant_parent_mobile_no_mother = ($applicant_parent_mobile_no[$parent_type_id_mother]==0)?'':$applicant_parent_mobile_no[$parent_type_id_mother];	
               ?>				
            <div class="col-lg-4" id="mother_mbleno_div" style="display:none;">
               <label class="form-control-label">Mother's Mobile Number</label>
               <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                  <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                     <select class="form-control form_control custom-select Mobile_number" id="pd_mother_phone_no_code" name="pd_mother_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                        <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                        <option value="Law">Law</option>
                        <option value="Other">Other</option>
                     </select>
                  </span>
                  <input type="text" class="form-control" name="pd_mother_phone" id="pd_mother_phone" maxlength="<?php echo APLCT_MOTHER_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOTHER_MOBILE_MSG; ?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="<?php echo VALID_MOTHER_MOBILE_MSG; ?>" data-parsley-errors-container="#custom-pd_mother_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no_mother; ?>" data-parsley-notequalto="#pd_father_phone" data-parsley-notequalto-message="<?php echo PHONE_MATCH_MOTHER; ?>">
                  <span id="custom-pd_mother_phone-parsley-error"></span>
               </div>
            </div>
            <div class="col-lg-4" id="mother_email_div" style="display:none;">
               <div class="form-group">
                  <label class="form-control-label">Mother's Email ID </label>
                  <input class="form-control" type="email" name="pd_mother_email" id="pd_mother_email"  placeholder="Enter Your Mother's Email ID"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_MOTHER_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_mother_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_mother]; ?>" data-parsley-notequalto="#pd_father_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_MOTHER; ?>" maxlength="<?php echo APLCT_MOTHER_EMAIL_MAXLENGTH; ?>">
                  <span id="custom-pd_mother_email-parsley-error"></span>
                  <p id="suggestion_mother_email"></p>
               </div>
            </div>
            <div class="col-lg-4" id="mother_occupation_div" style="display:none;">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Mother's Occupation</label>
                  <select class="form-control select2" data-placeholder="Choose Occupation" tabindex="-1" aria-hidden="true" name="pd_mother_occupation" id="pd_mother_occupation">
                     <option value="">Select Father's Occupation</option>
                     <option value="Business">Business</option>
                     <option value="Defence">Defence</option>
                     <option value="Government Sector">Government Sector
                     </option>
                     <option value="Homemaker">Homemaker</option>
                     <option value="Private Sector">Private Sector
                     </option>
                     <option value="Retired">Retired</option>
                     <option value="Other">Other</option>
                  </select>
               </div>
               <div id="other_occupation_mother_div" style="display:none;">
                  <input class="form-control" type="text" name="other_occupation_mother" id="other_occupation_mother"  placeholder="If Other, pls enter here"data-parsley-required="false" data-parsley-errors-container="#custom-other_occupation_mother-parsley-error" value="<?php echo $applicant_parent_other_occupation_name[$parent_type_id_mother]; ?>">
                  <span id="custom-other_occupation_mother-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
         </div>
         <!-- row -->
      </div>
      <!-- form-layout -->
   </div>
   <div>
      <label class="ckbox add_guardian_checkbox">
      <input name="add_guardian_checkbox" id="add_guardian_checkbox" type="checkbox" value="<?php echo ($applicant_other_details_list['add_gardian'] == 't')?'true':'false'; ?>" <?php echo ($applicant_other_details_list['add_gardian'] == 't')?'checked':'';?>>		
      <span>Add Guardian Detail</span>
      </label>
   </div>
   <div class="w-100 pd-20 pd-sm-40" id="guardian_details" style="<?php if($applicant_other_details_list['add_gardian']=='f' || $applicant_other_details_list['add_gardian']==''){echo "display:none";}else{echo "display:block";}?>">
      <h5 class="text-primary mb-3">Guardian's Details</h5>
      <div class="form-layout">
         <div class="row mg-b-25 mt-3">
            <div class="col-lg-4">
               <div class="form-group">
                  <label class="form-control-label">Guardian's Name</label>
                  <input class="form-control" type="text" name="pd_guardian_name" id="pd_guardian_name" placeholder="Enter Your Guardian's Name" maxlength="<?php echo APLCT_GUARDIAN_NAME_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_GUARDIAN_NAME_MINLENGTH; ?>, <?php echo APLCT_GUARDIAN_NAME_MAXLENGTH; ?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_guardian]; ?>">
               </div>
            </div>
            <!-- col-4 -->
            <?php 
               $applicant_parent_mobile_no_guardian = ($applicant_parent_mobile_no[$parent_type_id_guardian]==0)?'':$applicant_parent_mobile_no[$parent_type_id_guardian];	
               ?>				
            <div class="col-lg-4">
               <label class="form-control-label">Guardian's Mobile No</label>
               <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                  <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                     <select class="form-control form_control custom-select Mobile_number" id="pd_guardian_phone_no_code" name="pd_guardian_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                        <option value="<?php echo $country_value_default; ?>" selected>+91</option>
                        <option value="Law">Law</option>
                        <option value="Other">Other</option>
                     </select>
                  </span>
                  <input type="text" class="form-control" name="pd_guardian_phone" id="pd_guardian_phone" maxlength="<?php echo APLCT_GUARDIAN_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Guardian's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_MOBILE_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_GUARDIAN_MOBILE_MSG; ?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="<?php echo VALID_GUARDIAN_MOBILE_MSG; ?>" data-parsley-errors-container="#custom-pd_guardian_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no_guardian; ?>">
                  <span id="custom-pd_guardian_phone-parsley-error"></span>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="form-group">
                  <label class="form-control-label">Guardian's Email ID</label>
                  <input class="form-control" type="email" name="pd_guardian_email" id="pd_guardian_email"  placeholder="Enter Your Guardian's Email ID"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_GUARDIAN_EMAIL_MSG; ?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_GUARDIAN_EMAIL_MSG; ?>" data-parsley-errors-container="#custom-pd_guardian_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_guardian]; ?>" maxlength="<?php echo APLCT_GUARDIAN_EMAIL_MAXLENGTH; ?>">
                  <span id="custom-pd_guardian_email-parsley-error"></span>
                  <p id="suggestion_guardian_email"></p>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Guardian's Occupation</label>
                  <select class="form-control select2" data-placeholder="Choose Guardian Occupation" tabindex="-1" aria-hidden="true" name="pd_guardian_occupation" id="pd_guardian_occupation">
                     <option value="">Select Mother's Occupation</option>
                     <option value="Business">Business</option>
                     <option value="Defence">Defence</option>
                     <option value="Government Sector">Government Sector
                     </option>
                     <option value="Homemaker">Homemaker</option>
                     <option value="Private Sector">Private Sector
                     </option>
                     <option value="Retired">Retired</option>
                     <option value="Other">Other</option>
                  </select>
               </div>
               <div id="other_occupation_guardian_div" style="display:none;">
                  <input class="form-control" type="text" name="other_occupation_guardian" id="other_occupation_guardian"  placeholder="If Other, pls enter here"data-parsley-required="false" data-parsley-errors-container="#custom-other_occupation_guardian-parsley-error" value="<?php echo $applicant_parent_other_occupation_name[$parent_type_id_guardian]; ?>">
                  <span id="custom-other_occupation_guardian-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
         </div>
         <!-- row -->
      </div>
      <!-- form-layout -->
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
         </div>
         <!-- card-header -->
         <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
            <div class="card-body" style="font-size: 13px;">
               <?php echo $applicant_address_wizard_instructions; ?>
            </div>
         </div>
      </div>
      <!-- card -->
   </div>
   <div class="w-100 pd-20 pd-sm-40">
      <h5 class="text-primary mb-3">Address for Communication</h5>
      <div class="form-layout">
         <div class="row mg-b-25 mt-3">
            <!--<div class="row">-->
            <div class="col-md-4">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Country<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose country" tabindex="-1" aria-hidden="true" name="country_phd" id="country_phd" title="Choose Country" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_COUNTRY_MSG; ?>" data-parsley-errors-container="#custom-country_phd-parsley-error">
                     <option value="">Select Country</option>
                  </select>
                  <span id="custom-country_phd-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-md-4" id="main_div_state">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">State<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose State" tabindex="-1" aria-hidden="true" name="state_phd" id="state_phd" title="Choose State" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_STATE_MSG; ?>" data-parsley-errors-container="#custom-state_phd-parsley-error">
                     <option value="">Select State</option>
                  </select>
                  <span id="custom-state_phd-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-md-4" id="main_div_district">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">District<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose District" tabindex="-1" aria-hidden="true" name="district_phd" id="district_phd" title="Choose District" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DISTRICT_MSG; ?>" data-parsley-errors-container="#custom-district_phd-parsley-error">
                     <option value="">Select District</option>
                  </select>
                  <span id="custom-district_phd-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
         </div>
      </div>
      <div class="form-layout">
         <div class="row mg-b-25">
            <div class="col-md-4" id="main_div_city">
               <div class="form-group mg-b-10-force">
                  <label class="form-control-label">City<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose City" tabindex="-1" aria-hidden="true" name="city_phd" id="city_phd" title="Choose City" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CITY_MSG; ?>" data-parsley-errors-container="#custom-city_phd-parsley-error">
                     <option value="">Select City</option>
                  </select>
                  <span id="custom-city_phd-parsley-error"></span>
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-md-4">
               <div class="form-group">
                  <label class="form-control-label">Correspondence Address Line 1 <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="address_line1" id="address_line1" placeholder="Enter Address Line 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_ADDRESS_MSG; ?>" value="<?php if($applicant_address_details_list[0]['add_line_1']) {echo $applicant_address_details_list[0]['add_line_1'];} ?>" data-parsley-maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH; ?>" maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH; ?>">
               </div>
            </div>
            <!-- col-4 -->
            <div class="col-md-4">
               <div class="form-group">
                  <label class="form-control-label">
                     Correspondence Address Line 2 <!--<span class="tx-danger">*</span>-->
                  </label>
                  <input class="form-control" type="text" name="address_line2" id="address_line2" placeholder="Enter Address Line 2" value="<?php if($applicant_address_details_list[0]['add_line_2']) {echo $applicant_address_details_list[0]['add_line_2'];} ?>" data-parsley-maxlength="<?php echo APLCT_ADDRESS2_MAXLENGTH; ?>" maxlength="<?php echo APLCT_ADDRESS2_MAXLENGTH; ?>">
               </div>
            </div>
            <!-- col-4 -->		
            <div class="col-md-4">
               <div class="form-group">
                  <label class="form-control-label">Pincode <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Pincode" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PINCODE_MSG; ?>" value="<?php if($applicant_address_details_list[0]['pin_code']) {echo $applicant_address_details_list[0]['pin_code'];} ?>" data-parsley-maxlength="<?php echo APLCT_PINCODE_MAXLENGTH; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_PINCODE_MSG; ?>" maxlength="<?php echo APLCT_PINCODE_MAXLENGTH; ?>" data-parsley-pincodeonly="true">
               </div>
            </div>
            <!-- col-4 -->		  
         </div>
      </div>
   </div>
</fieldset>
<h3 class="wizard_head_tag">Academic Detail</h3>
<fieldset>
   <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
      <div class="card">
         <div class="card-header p-0 " role="tab" id="headingOne">
            <h6 class="p-2 ml-3">
               <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed"><i class="fas fa-info-circle"></i> Instructions</a>
            </h6>
         </div>
         <!-- card-header -->
         <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
            <div class="card-body" style="font-size: 13px;">
               <?php echo $applicant_academic_wizard_instructions; ?>
            </div>
         </div>
      </div>
      <!-- card -->
   </div>
   <!--<h3 class="text-primary mb-3">Academic Details</h3>-->
   <div action="form-validation.html" id="selectForm" class="w-100">
      <div class="row">
         <div class="col-lg-6">
            <div class="form-group">
               <label class="form-control-label">Twelfth passed / 3 year Diploma details<span class="tx-danger">*</span></label>
               <select class="form-control select2" data-placeholder="Choose Current Qualification Status" tabindex="-1" aria-hidden="true" name="current_qualification_status" id="current_qualification_status" title="Choose Current Qualification Status" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_QUALIFY_DEGREE_MSG; ?>" data-parsley-errors-container="#custom-current_qualification_status-parsley-error">
                  <option value="">Select Your Current Qualification Status
                  </option>
                  <option value="Twelfth">Twelfth / 3 year Diploma Passed
                  </option>
                  <option value="Graduation">Graduation Passed</option>
               </select>
               <span id="custom-current_qualification_status-parsley-error"></span>
            </div>
         </div>
         <div class="col-lg-6 ">
            <div class="form-group wd-xs-300 mr-5 w-100">
               <label class="form-control-label">Candidate's Name as in 10th Certificate<span class="tx-danger"> *</span></label>
               <div class="form-group mg-b-10-force">
                  <input class="form-control" type="text" name="candidate_name" id="candidate_name" placeholder="Candidate's Name" maxlength="<?php echo APLCT_CAND_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CANDIDATE_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_CAND_NAME_MINLENGTH; ?>, <?php echo APLCT_CAND_NAME_MAXLENGTH; ?>]" value="<?php echo $name_as_in_marksheet; ?>">
                  <b id="emailHelp" class="form-text text-muted">Kindly type ”NA” in case Certificate is not available with you.</b>
               </div>
            </div>
            <!-- form-group -->
         </div>
      </div>
   </div>
   <div class="table-responsive">
      <table class="table table-bordered mt-0">
         <thead class="thead-light">
            <label class="text-primary mb-3">Tenth Details</label>
            <tr>
               <th>Institute <span class="tx-danger">*</span></th>
               <th>Board <span class="tx-danger">*</span></th>
               <th>Mode of Study <span class="tx-danger">*</span></th>
               <th>Marking Scheme <span class="tx-danger">*</span></th>
               <th>Obtained Percentage/CGPA <span class="tx-danger">*</span></th>
               <th>Year of Passing <span class="tx-danger">*</span></th>
               <th>Registration No. / Roll No <span class="tx-danger">*</span></th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>
                  <input class="form-control" type="text" name="academic_tenth_inst" id="academic_tenth_inst" maxlength="<?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_INSTITUTE_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_INSTITUTE_NAME_MINLENGTH; ?>, <?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>]" value="<?php echo $inst_name_tenth; ?>">
               </td>
               <td>
                  <div class="form-group mg-b-10-force">
                     <select class="form-control select2 academic_board" name="academic_board" id="academic_board" title="Choose Board" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BOARD_MSG; ?>" data-parsley-errors-container="#custom-academic_board-parsley-error">
                        <option value="">Select</option>
                     </select>
                     <span id="custom-academic_board-parsley-error"></span>
                  </div>
                  <div id="ob_tenth" style="display:none;">
                     <input class="form-control" type="text" name="other_board_tenth" id="other_board_tenth" maxlength="<?php echo APLCT_OTHER_GRAD_MAXLENGTH; ?>" value="<?php echo $other_board_name_tenth; ?>">					
                  </div>
               </td>
               <td>
                  <div class="form-group mg-b-10-force">
                     <select class="form-control select2" name="academic_mode_of_study" id="academic_mode_of_study" title="Choose Mode Of Study" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MODE_STUDY_MSG; ?>" data-parsley-errors-container="#custom-academic_mode_of_study-parsley-error">
                        <option value="">Select</option>
                     </select>
                     <span id="custom-academic_mode_of_study-parsley-error"></span>
                  </div>
               </td>
               <td>
                  <div class="form-group mg-b-10-force">
                     <select class="form-control select2" name="academic_marking_scheme" id="academic_marking_scheme" title="Choose Academic Marking Scheme" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MARK_SCHEME_MSG; ?>" data-parsley-errors-container="#custom-academic_marking_scheme-parsley-error">
                     </select>
                     <span id="custom-academic_marking_scheme-parsley-error"></span>
                  </div>
               </td>
               <td>
                  <input class="form-control" type="text" name="academic_obtain_cgpa" id="academic_obtain_cgpa" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG; ?>"  data-parsley-type-message="<?php echo VALID_PERCENT_CGPA_MSG; ?>" min="<?php echo APLCT_MARK_MINLENGTH; ?>" max="<?php echo APLCT_MARK_MAXLENGTH; ?>" data-parsley-trigger="keyup" data-parsley-type="number" value="<?php echo $mark_percentage_tenth; ?>" maxlength="<?php echo CGPA_MAXLENGTH; ?>">
               </td>
               <td>
                  <div class="form-group mg-b-10-force">
                     <div class="form-group"><input type="text" name="academic_yr_passing" id="academic_yr_passing" class="form-control datepicker" placeholder="YYYY" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_YEAR_OF_PASSING_MSG; ?>" data-parsley-trigger="change" value="<?php echo $completion_year_tenth; ?>" maxlength="<?php echo APLCT_YEAR_OF_PASSING_MAXLENGTH; ?>" onkeypress="return isNumber(event);" autocomplete="off" max="<?php echo $ssclMaxYop; ?>"></div>
                     <span id="custom-academic_yr_passing-parsley-error"></span>
                  </div>
               </td>
               <td>
                  <input class="form-control" type="text" name="academic_reg_no"id="academic_reg_no" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_REG_NO_MSG; ?>" data-parsley-length="[<?php echo APLCT_REG_NO_MINLENGTH; ?>, <?php echo APLCT_REG_NO_MAXLENGTH; ?>]" value="<?php echo $registration_no_tenth; ?>" data-parsley-type='alphanum' data-parsley-type-message="<?php echo VALID_REG_NO_MSG; ?>" autocomplete="off">
               </td>
            </tr>
         </tbody>
      </table>
   </div>
   <div class="table-responsive">
      <table class="table table-bordered mt-0">
         <thead class="thead-light">
            <label class="text-primary mb-3">Twelfth / 3 Year Diploma Details</label>
            <tr>
               <th> Institute <span class="tx-danger">*</span></th>
               <th> Board <span class="tx-danger">*</span></th>
               <th> Mode of Study <span class="tx-danger">*</span></th>
               <th> Marking Scheme <span class="tx-danger">*</span></th>
               <th> Obtained Percentage/CGPA <span class="tx-danger">*</span></th>
               <th> Year of Passing <span class="tx-danger">*</span></th>
               <th> Registration No. / Roll No <span class="tx-danger">*</span></th>
               <th> Stream <span class="tx-danger">*</span></th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>
                  <input class="form-control" type="text" name="academic_twelfth_inst" id="academic_twelfth_inst" maxlength="<?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_INSTITUTE_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_INSTITUTE_NAME_MINLENGTH; ?>, <?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>]" value="<?php echo $inst_name_twelfth; ?>">
               </td>
               <td>
                  <div class="form-group mg-b-10-force">
                     <select class="form-control select2 academic_twelfth_board" name="academic_twelfth_board" id="academic_twelfth_board" title="Choose Board" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BOARD_MSG; ?>" data-parsley-errors-container="#custom-academic_twelfth_board-parsley-error">
                        <option value="">Select</option>
                     </select>
                     <span id="custom-academic_twelfth_board-parsley-error"></span>
                  </div>
                  <div id="ob_twelfth" style="display:none;">
                     <input class="form-control" type="text" name="other_board_twelfth" id="other_board_twelfth" maxlength="<?php echo APLCT_OTHER_GRAD_MAXLENGTH; ?>" value="<?php echo $other_board_name_twelfth; ?>">					
                  </div>
               </td>
               <td>
                  <div class="form-group mg-b-10-force">
                     <select class="form-control select2" name="academic_mode_of_study_twelfth" id="academic_mode_of_study_twelfth" title="Choose Mode Of Study" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MODE_STUDY_MSG; ?>" data-parsley-errors-container="#custom-academic_mode_of_study_twelfth-parsley-error">
                        <option value="">Select</option>
                     </select>
                     <span id="custom-academic_mode_of_study_twelfth-parsley-error"></span>
                  </div>
               </td>
               <td>
                  <div class="form-group mg-b-10-force">
                     <select class="form-control select2" name="academic_marking_scheme_twelfth" id="academic_marking_scheme_twelfth" title="Choose Academic Marking Scheme" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MARK_SCHEME_MSG; ?>" data-parsley-errors-container="#custom-academic_marking_scheme_twelfth-parsley-error">
                     </select>
                     <span id="custom-academic_marking_scheme_twelfth-parsley-error"></span>
                  </div>
               </td>
               <td>
                  <input class="form-control" type="text" name="academic_obtain_cgpa_twelfth" id="academic_obtain_cgpa_twelfth"  data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG; ?>"  data-parsley-type-message="<?php echo VALID_PERCENT_CGPA_MSG; ?>" min="<?php echo APLCT_MARK_MINLENGTH; ?>" max="<?php echo APLCT_MARK_MAXLENGTH; ?>" data-parsley-trigger="keyup" data-parsley-type="number" value="<?php echo $mark_percentage_twelfth; ?>" maxlength="<?php echo CGPA_MAXLENGTH; ?>">
               </td>
               <td>
                  <div class="form-group mg-b-10-force">
                     <div class="form-group"><input type="text" name="academic_yr_passing_twelfth" id="academic_yr_passing_twelfth" class="form-control datepicker" placeholder="YYYY" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_YEAR_OF_PASSING_MSG; ?>" data-parsley-trigger="change" value="<?php echo $completion_year_twelfth; ?>" autocomplete="off"></div>
                     <span id="custom-academic_yr_passing_twelfth-parsley-error"></span>
                  </div>
               </td>
               <td>
                  <input class="form-control" type="text" name="academic_reg_no_twelfth" id="academic_reg_no_twelfth" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_REG_NO_MSG; ?>" data-parsley-length="[<?php echo APLCT_REG_NO_MINLENGTH; ?>, <?php echo APLCT_REG_NO_MAXLENGTH; ?>]" value="<?php echo $registration_no_twelfth; ?>" data-parsley-type='alphanum' data-parsley-type-message="<?php echo VALID_REG_NO_MSG; ?>" autocomplete="off">
               </td>
               <td>
                  <div class="form-group mg-b-10-force">
                     <select class="form-control select2" name="academic_stream" id="academic_stream" title="Choose Stream" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_STREAM_MSG; ?>" data-parsley-errors-container="#custom-academic_stream-parsley-error">
                        <option value="">Select</option>
                     </select>
                     <span id="custom-academic_stream-parsley-error"></span>
                  </div>
                  <div id="obstream" style="display:none;">
                     <input class="form-control" type="text" name="other_stream_name" id="other_stream_name" maxlength="<?php echo APLCT_OTHER_GRAD_MAXLENGTH; ?>" value="<?php echo $other_stream_name; ?>">					
                  </div>
               </td>
            </tr>
         </tbody>
      </table>
   </div>
   <p class="w-100">For Diploma holders,please choose Other option in Board and Stream column
      and fill with your respective board and type of diploma in others field
   </p>
   <div class="table-responsive" id="dde_graduation_details" style="display:none;">
      <table class="table table-bordered mt-0">
         <label class="text-primary mb-3">Graduation Details</label>
         <thead class="thead-light">
            <tr>
               <th>
               </th>
               <th>Institute <span class="tx-danger">*</span></th>
               <th>University <span class="tx-danger">*</span></th>
               <th>Marking Scheme <span class="tx-danger">*</span></th>
               <th>Obtained Percentage/CGPA <span class="tx-danger">*</span></th>
               <th>Year of Passing	<span class="tx-danger">*</span></th>
               <th>Registration No. / Roll No <span class="tx-danger">*</span></th>
               <th>Degree <span class="tx-danger">*</span></th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>
                  <p>.</p>
               </td>
               <td>
                  <input class="form-control" type="text" name="academic_graduation_inst" id="academic_graduation_inst" maxlength="<?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_INSTITUTE_NAME_MSG; ?>" data-parsley-nameonly="false" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_INSTITUTE_NAME_MINLENGTH; ?>, <?php echo APLCT_INSTITUTE_NAME_MAXLENGTH; ?>]" value="<?php echo $grad_inst_name; ?>">
               </td>
               <td>
                  <div class="form-group mg-b-10-force">
                     <select class="form-control select2" name="academic_graduation_university" id="academic_graduation_university" title="Choose Board" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_BOARD_MSG; ?>" data-parsley-errors-container="#custom-academic_graduation_university-parsley-error">
                        <option value="">Select</option>
                     </select>
                     <span id="custom-academic_graduation_university-parsley-error"></span>
                  </div>
                  <div id="ob_univ" style="display:none;">
                     <input class="form-control" type="text" name="other_univ_grad" id="other_univ_grad" maxlength="<?php echo APLCT_OTHER_GRAD_MAXLENGTH; ?>" value="<?php echo $grad_university_other_name; ?>">					
                  </div>
               </td>
               <td>
                  <div class="form-group mg-b-10-force">
                     <select class="form-control select2" name="academic_marking_scheme_graduation" id="academic_marking_scheme_graduation" title="Choose Academic Marking Scheme" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MARK_SCHEME_MSG; ?>" data-parsley-errors-container="#custom-academic_marking_scheme_graduation-parsley-error">
                     </select>
                     <span id="custom-academic_marking_scheme_graduation-parsley-error"></span>
                  </div>
               </td>
               <td>
                  <input class="form-control" type="text" name="academic_obtain_cgpa_graduation" id="academic_obtain_cgpa_graduation"  data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG; ?>"  data-parsley-type-message="<?php echo VALID_PERCENT_CGPA_MSG; ?>" min="<?php echo APLCT_MARK_MINLENGTH; ?>" max="<?php echo APLCT_MARK_MAXLENGTH; ?>" data-parsley-trigger="keyup" data-parsley-type="number" value="<?php echo $mark_percentage_graduation; ?>" maxlength="<?php echo CGPA_MAXLENGTH; ?>">
               </td>
               <td>
                  <div class="form-group"><input type="text" name="academic_yr_passing_graduation" id="academic_yr_passing_graduation" class="form-control datepicker" placeholder="YYYY" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_YEAR_OF_PASSING_MSG; ?>" data-parsley-trigger="change" value="<?php echo $yop_passing_graduation; ?>" autocomplete="off"></div>
                  <span id="custom-academic_yr_passing_graduation-parsley-error"></span>
               </td>
               <td>
                  <input class="form-control" type="text" name="academic_reg_no_graduation" id="academic_reg_no_graduation" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_REG_NO_MSG; ?>" data-parsley-length="[<?php echo APLCT_REG_NO_MINLENGTH; ?>, <?php echo APLCT_REG_NO_MAXLENGTH; ?>]" value="<?php echo $reg_no_graduation; ?>" data-parsley-type='alphanum' data-parsley-type-message="<?php echo VALID_REG_NO_MSG; ?>" autocomplete="off">
               </td>
               <td>
                  <div class="form-group mg-b-10-force">
                     <select class="form-control select2" name="graduation_degree" id="graduation_degree" title="Choose Degree" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_DEGREE_NAME_MSG; ?>" data-parsley-errors-container="#custom-graduation_degree-parsley-error">
                        <option value=""  selected="selected">Select Degree</option>
                     </select>
                     <span id="custom-graduation_degree-parsley-error"></span>
                  </div>
               </td>
            </tr>
         </tbody>
      </table>
   </div>
   <div class="w-100 mt-3">
      <div class="row">
         <div class="col-md-6">
            <div class="form-group mg-b-10-force">
               <label>Choose your Part-I Language" preference for Semester I & II ( Only for UG) </label>
               <select class="form-control select2" name="part_lang_prefer" id="part_lang_prefer" title="Choose Language preference" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_LANG_PREFERENCE_MSG; ?>" data-parsley-errors-container="#custom-part_lang_prefer-parsley-error">
                  <option value=""  selected="selected">Select Language preference</option>
               </select>
               <span id="custom-part_lang_prefer-parsley-error"></span>
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group mg-b-10-force">
               <label>Choose one of the following "Learner Support Centers" </label>
               <select class="form-control select2" name="learning_support_center" id="learning_support_center" title="Choose Learner Support Centers" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_LEARNER_CENTER_MSG; ?>" data-parsley-errors-container="#custom-part_lang_prefer-parsley-error">
                  <option value=""  selected="selected">Select Learner Support Centers</option>
               </select>
               <span id="custom-part_lang_prefer-parsley-error"></span>
            </div>
         </div>
      </div>
   </div>
   <div class="w-100 mt-3">
      <div class="row">
         <div class="col-md-6">
            <div class="form-group">
               <label class="d-block mb-3 w-100 text-left">Do you have any Work Experience ? :</label>
               <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="is_work_experience_yes" name="is_work_experience" class="custom-control-input is_exp" <?php echo ($is_work_experience == 't')?'checked':''; ?> value="yes" data-parsley-mincheck="<?php echo APLCT_WORK_EXP_MINLENGTH; ?>" checked>
                  <label class="custom-control-label" for="is_work_experience_yes">Yes</label>
               </div>
               <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="is_work_experience_no" name="is_work_experience" class="custom-control-input" <?php echo ($is_work_experience == 'f')?'checked':''; ?> value="no" data-parsley-mincheck="<?php echo APLCT_WORK_EXP_MINLENGTH; ?>">
                  <label class="custom-control-label" for="is_work_experience_no">No</label>
               </div>
            </div>
         </div>
      </div>
   </div>
   <table class="table table-bordered table-responsive mt-3" id="pro_exp" style="display:none;">
      <label class="text-primary mb-0 hide_present">Professional Experience (Start From The Present Employer)
      </label>
      <thead class="thead-light">
         <tr>
            <th>
            </th>
            <th>Organisation's Name  </th>
            <th>Designation  </th>
            <th>Nature of Job </th>
            <th>Total Salary / Month  </th>
            <th>From Year</th>
            <th>To Year </th>
            <th>Work Experience (In Months)  </th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td nowrap="">1.</td>
            <td>
               <input class="form-control" type="hidden" placeholder="" id="prof_exp_id_0" name="prof_exp_id_0" value="<?php echo $applicant_prof_exp_id[0]; ?>">
               <div class="form-group"><input type="text" name="organisation_name_0" id="organisation_name_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_ORGANISATION_NAME_MAXLENGTH; ?>"data-parsley-required="true" data-parsley-required-message="<?php echo REQD_ORG_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_org_name[0]; ?>"></div>
               <span class="tx-danger required_asterisk">*</span>
            </td>
            <td>
               <div class="form-group"><input type="text" name="designation_0" id="designation_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_DESIGNATION_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DESIGNATION_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_designation[0]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_DESIGN_ALPHA_MSG; ?>"></div>
               <span class="tx-danger required_asterisk">*</span>
            </td>
            <td>
               <div class="form-group"><input type="text" name="nature_of_job_0" id="nature_of_job_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_JOB_NATURE_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_NATURE_JOB_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_job_nature[0]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_NATURE_ALPHA_MSG; ?>"></div>
               <span class="tx-danger required_asterisk">*</span>
            </td>
            <td>
               <div class="form-group"><input type="text" name="total_salary_month_0" id="total_salary_month_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_SALARY_PER_MONTH_MAXLENGTH; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_DIGITS_ONLY_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_salary[0]; ?>"></div>
               <span class="tx-danger required_asterisk">*</span>
            </td>
            <td>
               <div class="form-group"><input readonly="" type="text" name="from_year_0" id="from_year_0" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_FROM_YEAR_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_FROM_YEAR_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_from_date[0]; ?>"></div>
               <span class="tx-danger required_asterisk">*</span>
            </td>
            <td>
               <div class="form-group"><input readonly="" type="text" name="to_year_0" id="to_year_0" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_TO_YEAR_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TO_YEAR_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_to_date[0]; ?>"></div>
               <span class="tx-danger required_asterisk">*</span>
            </td>
            <td>
               <div class="form-group"><input type="text" name="work_experience_0" id="work_experience_0" class="form-control" placeholder="" readonly="readonly" maxlength="<?php echo APLCT_TOT_WORK_EXP_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_WORK_EXP_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_work_exp_in_months[0]; ?>"></div>
               <span class="tx-danger required_asterisk">*</span>
            </td>
         </tr>
         <tr>
            <td nowrap="">2.</td>
            <td>
               <input class="form-control" type="hidden" placeholder="" id="prof_exp_id_1" name="prof_exp_id_1" value="<?php echo $applicant_prof_exp_id[1]; ?>">
               <div class="form-group"><input type="text" name="organisation_name_1" id="organisation_name_1" class="form-control" placeholder="" maxlength="<?php echo APLCT_ORGANISATION_NAME_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_org_name[1]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>"></div>
            </td>
            <td>
               <div class="form-group"><input type="text" name="designation_1" id="designation_1" class="form-control" placeholder="" maxlength="<?php echo APLCT_DESIGNATION_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_designation[1]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_DESIGN_ALPHA_MSG; ?>"></div>
            </td>
            <td>
               <div class="form-group"><input type="text" name="nature_of_job_1" id="nature_of_job_1" class="form-control" placeholder="" maxlength="<?php echo APLCT_JOB_NATURE_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_job_nature[1]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_NATURE_ALPHA_MSG; ?>"></div>
            </td>
            <td>
               <div class="form-group"><input type="text" name="total_salary_month_1" id="total_salary_month_1" class="form-control" placeholder="" maxlength="<?php echo APLCT_SALARY_PER_MONTH_MAXLENGTH; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_DIGITS_ONLY_MSG; ?>" value="<?php echo $applicant_prof_exp_salary[1]; ?>"></div>
            </td>
            <td>
               <div class="form-group"><input readonly="" type="text" name="from_year_1" id="from_year_1" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_FROM_YEAR_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_from_date[1]; ?>"></div>
            </td>
            <td>
               <div class="form-group"><input readonly="" type="text" name="to_year_1" id="to_year_1" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_TO_YEAR_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_to_date[1]; ?>"></div>
            </td>
            <td>
               <div class="form-group"><input type="text" name="work_experience_1" id="work_experience_1" class="form-control" placeholder="" readonly="readonly" maxlength="<?php echo APLCT_TOT_WORK_EXP_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_work_exp_in_months[1]; ?>"></div>
            </td>
         </tr>
         <tr>
            <td nowrap="">3.</td>
            <td>
               <input class="form-control" type="hidden" placeholder="" id="prof_exp_id_2" name="prof_exp_id_2" value="<?php echo $applicant_prof_exp_id[2]; ?>">
               <div class="form-group"><input type="text" name="organisation_name_2" id="organisation_name_2" class="form-control" placeholder="" maxlength="<?php echo APLCT_ORGANISATION_NAME_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_org_name[2]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>"></div>
            </td>
            <td>
               <div class="form-group"><input type="text" name="designation_2" id="designation_2" class="form-control" placeholder="" maxlength="<?php echo APLCT_DESIGNATION_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_designation[2]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_DESIGN_ALPHA_MSG; ?>"></div>
            </td>
            <td>
               <div class="form-group"><input type="text" name="nature_of_job_2" id="nature_of_job_2" class="form-control" placeholder="" maxlength="<?php echo APLCT_JOB_NATURE_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_job_nature[2]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_NATURE_ALPHA_MSG; ?>"></div>
            </td>
            <td>
               <div class="form-group"><input type="text" name="total_salary_month_2" id="total_salary_month_2" class="form-control" placeholder="" maxlength="<?php echo APLCT_SALARY_PER_MONTH_MAXLENGTH; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_DIGITS_ONLY_MSG; ?>" value="<?php echo $applicant_prof_exp_salary[2]; ?>"></div>
            </td>
            <td>
               <div class="form-group"><input readonly="" type="text" name="from_year_2" id="from_year_2" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_FROM_YEAR_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_from_date[2]; ?>"></div>
            </td>
            <td>
               <div class="form-group"><input readonly="" type="text" name="to_year_2" id="to_year_2" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_TO_YEAR_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_to_date[2]; ?>"></div>
            </td>
            <td>
               <div class="form-group"><input type="text" name="work_experience_2" id="work_experience_2" class="form-control" placeholder="" readonly="readonly" maxlength="<?php echo APLCT_TOT_WORK_EXP_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_work_exp_in_months[2]; ?>"></div>
            </td>
         </tr>
      </tbody>
   </table>
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
         <label class=" control-label" for="work_exp_in_months" style="float:right;">Total Work Experience in Months</label>
         <div class="form-group" style="width:150px;float:right;">
            <input type="text" name="total_work_experience" id="total_work_experience" class="form-control" placeholder="Total Work Experience" readonly="readonly" maxlength="<?php echo APLCT_TOT_WORK_EXP_MAXLENGTH; ?>" value="<?php echo $total_applicant_prof_exp_work_exp_in_months; ?>">
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
               <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed">
               <i class="fas fa-info-circle"></i>
               Instructions</a>
            </h6>
         </div>
         <!-- card-header -->
         <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
            <div class="card-body" style="font-size: 13px;">
               <?php echo $applicant_payment_wizard_instructions; ?>
            </div>
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
               <p class="card-subtitle">Phone Number : <?php echo $applicant_mob_country_code_name."-".$phone_no; ?></p>
            </div>
         </div>
         <!-- card -->
         <div class="card base_details_card">
            <div class="card-body">
               <h5 class="card-title card_title">Order Details</h5>
               <p class="card-subtitle">Application Fee <span class="float-right"><?php echo $appln_form_fee; ?></span>
               </p>
            </div>
         </div>
         <!-- card -->
      </div>
      <div class="col-lg-6">
         <div class="card mb-3 base_details_card">
            <div class="card-body">
               <h5 class="card-title card_title">Payment Details</h5>
               <div class="row mt-3">
                  <div class="col-lg-2">
                     <label class="rdiobox">
                     <input name="rdio" type="radio" id="online" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PAYMENT_MODE_MSG; ?>" data-parsley-errors-container="#custom-online-parsley-error" data-parsley-trigger="change">
                     <span>Online</span>
                     </label>
                  </div>
                  <div class="col-lg-2">
                     <label class="rdiobox">
                     <input name="rdio" type="radio" id="dd" value="on" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PAYMENT_MODE_MSG; ?>" data-parsley-errors-container="#custom-dd-parsley-error" data-parsley-trigger="change">
                     <span>DD</span>
                     </label>
                  </div>
               </div>
               <span id="custom-online-parsley-error"></span>
               <p class="card-subtitle mb-3 mt-3">Sub Total <span class="float-right"><?php echo $appln_form_fee; ?></span>
               </p>
               <p class="card-subtitle">Total<span class="float-right"><?php echo $appln_form_fee; ?></span>
               </p>
               <div id="payment_details" style="<?php echo ($payment_mode_id==PAYMENT_MODE_DEMAND_DRAFT_ID)?'display:block;':'display:none;'; ?>">
                  <div class="mt-3">
                     <div class="row">
                        <div class="col-md-6">
                           <select class="form-control select2" name="BankName" id="BankName" title="Choose Bank Name" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHOOSE_BANK_MSG; ?>" data-parsley-errors-container="#custom-BankName-parsley-error">
                              <option value=""  selected="selected">Select Bank Name</option>
                           </select>
                           <span id="custom-BankName-parsley-error"></span>									
                        </div>
                        <div class="col-md-6">
                           <input class="form-control" type="text" name="BranchName" placeholder="Branch Name" id="BranchName" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BANK_NAME_MSG; ?>" maxlength="<?php echo APLCT_BRANCH_NAME_MAXLENGTH; ?>" value="<?php echo $branch_name; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="Enter Valid Branch Name">
                        </div>
                     </div>
                  </div>
                  <div class="mt-3">
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
                        <div class="flexbox flex-start"><?php echo DD_INFAVOUR; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- card -->
      </div>
   </div>
   <div class="row  w-100">
   </div>
</fieldset>
<h3 class="wizard_head_tag">Upload & Declaration</h3>
<fieldset>
   <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
      <div class="card ">
         <div class="card-header p-0 " role="tab" id="headingOne">
            <h6 class="p-2 ml-3">
               <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed">
               <i class="fas fa-info-circle"></i> Instructions</a>
            </h6>
         </div>
         <!-- card-header -->
         <div id="collapseOne7" class="collapse bg-light show" role="tabpanel" aria-labelledby="headingOne" style="">
            <div class="card-body" style="font-size: 13px;">
               <?php echo $applicant_upload_wizard_instructions; ?>
            </div>
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
                  <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Signature<span class="tx-danger">*</span></label>
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
            <?php
               ?>
            <div class="row w-100">
               <div class="form-group col-md-6">
                  <label for="exampleFormControlTextarea1">Upload Your 10th Marksheet <span class="tx-danger">*</span></label>
                  <input type="file" class="filestyle" name="tenth_marksheet" id="tenth_marksheet" data-parsley-required="<?php echo ((isset($docs[$document_id_tenth_marksheet]))?'false':'true'); ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_10_MARKSHEET_MSG; ?>" data-parsley-errors-container="#custom-tenth_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_tenth_marksheet])){ echo $docs[$document_id_tenth_marksheet]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                  <?php if(isset($docs[$document_id_tenth_marksheet])){ ?>
                  <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_tenth_marksheet; ?>">
                     <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_tenth_marksheet; ?>')">&times;</a>
                     <strong id="deleteMessageStatus_<?php echo $document_id_tenth_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_tenth_marksheet; ?>"></span>
                  </div>
                  <?php } ?>
                  <span id="custom-tenth_marksheet-parsley-error"></span>
               </div>
               <div class="form-group col-md-6">
                  <label for="exampleFormControlTextarea1">Upload Your 12th/Diploma Marksheet <span class="tx-danger">*</span></label>
                  <input type="file" class="filestyle" name="twelvfth_marksheet" id="twelvfth_marksheet" data-parsley-required="<?php echo ((isset($docs[$document_id_twelvfth_marksheet]))?'false':'true'); ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_12_MARKSHEET_MSG; ?>" data-parsley-errors-container="#custom-twelvfth_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_twelvfth_marksheet])){ echo $docs[$document_id_twelvfth_marksheet]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                  <?php if(isset($docs[$document_id_twelvfth_marksheet])){ ?>
                  <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_twelvfth_marksheet; ?>">
                     <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_twelvfth_marksheet; ?>')">&times;</a>
                     <strong id="deleteMessageStatus_<?php echo $document_id_twelvfth_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_twelvfth_marksheet; ?>"></span>
                  </div>
                  <?php } ?>
                  <span id="custom-twelvfth_marksheet-parsley-error"></span>
               </div>
            </div>
			<?php
			$required_true_pc = ((isset($docs[$document_id_provsional_certicate]))?'false':$required);
			$required_true_ugm = ((isset($docs[$document_id_graduation_marksheet]))?'false':$required);
			?>
            <div class="row w-100" id="graduation_certificate" style="<?php echo $style; ?>">
               <div class="form-group col-md-6">
                  <label for="exampleFormControlTextarea1">Upload Your Provisional Certificate <span class="tx-danger">*</span></label>
                  <input type="file" class="filestyle" name="provisional_certificate" id="provisional_certificate" data-parsley-required="<?php echo $required_true_pc; ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_PROV_CERTIFY_MSG; ?>" data-parsley-errors-container="#custom-provisional_certificate-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_provsional_certicate])){ echo $docs[$document_id_provsional_certicate]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                  <?php if(isset($docs[$document_id_provsional_certicate])){ ?>
                  <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_provsional_certicate; ?>">
                     <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_provsional_certicate; ?>')">&times;</a>
                     <strong id="deleteMessageStatus_<?php echo $document_id_provsional_certicate; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_provsional_certicate; ?>"></span>
                  </div>
                  <?php } ?>
                  <span id="custom-provisional_certificate-parsley-error"></span>
               </div>
               <div class="form-group col-md-6 ">
                  <label for="exampleFormControlTextarea1">Upload Your Graduation Marksheet <span class="tx-danger"> *</span></label>
                  <input type="file" class="filestyle" name="graduation_marksheet" id="graduation_marksheet" data-parsley-required="<?php echo $required_true_ugm; ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_GRAD_MARK_MSG; ?>" data-parsley-errors-container="#custom-graduation_marksheet-parsley-error"data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_graduation_marksheet])){ echo $docs[$document_id_graduation_marksheet]['id']; } ?>"accept="<?php  echo allow_extension($file_allowed_type); ?>">
                  <?php if(isset($docs[$document_id_graduation_marksheet])){ ?>
                  <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_graduation_marksheet; ?>">
                     <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_graduation_marksheet; ?>')">&times;</a>
                     <strong id="deleteMessageStatus_<?php echo $document_id_graduation_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_graduation_marksheet; ?>"></span>
                  </div>
                  <?php } ?>
                  <span id="custom-graduation_marksheet-parsley-error"></span>
               </div>
            </div>
            <?php
               ?>				
            <div class="row w-100">
               <div class="col-md-12">
                  <h5 class="text-primary mb-3">Declaration</h5>
                  <p><?php echo DECLARATION; ?></p>
               </div>
            </div>
            <div class="row w-100">
               <div class="col-md-6">
                  <label class="form-control-label">Applicant Name <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="applicant_name" id="applicant_name" placeholder="Applicant Name" value="<?php echo $applicant_name_declaration ;?>"  maxlength="<?php echo APLCT_DECLR_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_APPLT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_DECLR_NAME_MINLENGTH; ?>, <?php echo APLCT_DECLR_NAME_MAXLENGTH; ?>]">
               </div>
               <div class="col-md-6">
                  <label class="form-control-label">Parent Name <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="parent_name" id="parent_name" placeholder="Parent Name" value="<?php echo $applicant_parentname_declaration;?>" maxlength="<?php echo APLCT_DECLR_FATHER_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_PARENT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_DECLR_FATHER_NAME_MINLENGTH; ?>, <?php echo APLCT_DECLR_FATHER_NAME_MAXLENGTH; ?>]">
               </div>
            </div>
            <div class="row w-100 mt-3">
               <div class="col-md-6">
                  <label class="form-control-label">Date <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="ddate" id="ddate" value="<?php if(isset($ddate)){echo $ddate;}else{echo date('d-m-Y');} ?>" readonly>
               </div>
            </div>
         </div>
         <!-- row -->
      </div>
   </div>
</fieldset>
<?php form_close(); ?><!-- form -->