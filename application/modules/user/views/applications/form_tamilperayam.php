<?php  

if($applicant_graduations_list) {
   foreach($applicant_graduations_list as $k=>$v) {
      $graduation_type_id = $v['graduation_type_id'];
      $mark_percentage[$graduation_type_id] = $v['mark_percentage'];
      $yr_of_pass[$graduation_type_id] = $v['yr_of_pass'];
	  $inst_name[$graduation_type_id] = $v['insti_name'];
	  $reg_no[$graduation_type_id] = $v['reg_no'];
	  $other_board_name[$graduation_type_id] = $v['other_univ_name'];
	  $result_declared[$graduation_type_id] = $v['result_declared'];
	  $is_curr_qualify[$graduation_type_id] = $v['is_curr_qualify'];
   }
}


$graduation_type_id_ug = UG_GRAD;
$graduation_type_id_pg = PG_GRAD;

$parent_type_id_father = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
$country_value_default = COUNTRY_VALUE_DEFAULT;

$first_name = $applicant_basic_details_list['f_name'];
$last_name = $applicant_basic_details_list['l_name'];
$middle_name = $applicant_basic_details_list['m_name'];
$phone_no = $applicant_basic_details_list['mob_no'];
$email_id = $applicant_basic_details_list['e_mail'];
$second_mobile_no = $applicant_basic_details_list['sec_mob_no'];
if($applicant_basic_details_list['dob']){
	$dob=isset($applicant_basic_details_list['dob'])? date('d/m/Y',strtotime($applicant_basic_details_list['dob'])):'';
}

$second_email_id = $applicant_basic_details_list['sec_e_mail'];
$nad_id_digilocker_id = $applicant_basic_details_list['digilocker_id'];

$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_tenth_marksheet = DOCUMENT_ID_TENTH_MARKSHEET;
/*$document_id_graduation_marksheet = DOCUMENT_ID_GRADUATION_MARKSHEET;
$document_id_post_graduation_marksheet = DOCUMENT_ID_POST_GRADUATION_MARKSHEET;
*/

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

$parent_type_id_father = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;

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
	  $applicant_parent_other_occupation_name[$parent_type_id] = $v['other_occupation_name'];
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

// Declaration Show
$applicant_name_declaration = $applicant_appln_details_list[0]['applicant_name_declaration'];
$applicant_name_declaration = ($applicant_name_declaration)?$applicant_name_declaration:$first_name;

$applicant_parentname_declaration = $applicant_appln_details_list[0]['applicant_parentname_declaration'];
$father_name = $applicant_parent_parent_name[$parent_type_id_father];
$mother_name = $applicant_parent_parent_name[$parent_type_id_mother];
$guardian_name = $applicant_parent_parent_name[$parent_type_id_guardian];
$applicant_parentname_declaration = (($applicant_parentname_declaration)?$applicant_parentname_declaration:(($father_name)?$father_name:(($mother_name)?$mother_name:(($guardian_name)?$guardian_name:''))));

$ddate = $applicant_appln_details_list[0]['applicant_declaration_date'];
$ddate = ($ddate)?date('d-m-Y',strtotime($ddate)):date('d-m-Y');

// Schooling Details
$tenth_schooling_id = SCHOOLING_ID_TENTH;
$twelfth_schooling_id = SCHOOLING_ID_TWELFTH;

if($applicant_schooling_list) {
   foreach($applicant_schooling_list as $k=>$v) {
      $schooling_id = $v['schooling_id'];
      $applicant_scl_det_id[$schooling_id] = $v['applicant_scl_det_id'];
      $schooling_name[$schooling_id] = $v['schooling_name'];
	  $inst_name[$schooling_id] = $v['inst_name'];
	  $mark_percentage[$schooling_id] = $v['mark_percentage'];
	  $completion_year[$schooling_id] = $v['completion_year'];
	  $registration_no[$schooling_id] = $v['registration_no'];
	  $name_as_in_marksheet[$schooling_id] = $v['name_as_in_marksheet'];
	  $other_board_name[$schooling_id] = $v['other_board_name'];
	  $result_declared[$schooling_id] = $v['result_declared'];
   }
}

if(!empty($applicant_appln_details_list[0]['qual_status_id'])){
	if($applicant_appln_details_list[0]['qual_status_id']==1){
		$current_education_qual_status = 'a';
	}else{
		$current_education_qual_status = 'c';
	}
}

$add_gardian = $applicant_other_details_list[0]['add_gardian'];

// Declare the Form Wizard Id
$form_wizard_basic_id               = FORM_WIZARD_BASIC_ID;
$form_wizard_preference_personal_id = FORM_WIZARD_PERSONAL_ID;
$form_wizard_parent_address_id 		= FORM_WIZARD_PARENT_ID; 
$form_wizard_address_id 			= FORM_WIZARD_ADDRESS_ID;
$form_wizard_academic_id 			= FORM_WIZARD_ACADEMIC_ID;
$form_wizard_payment_id 			= FORM_WIZARD_PAYMENT_ID;
$form_wizard_declaration_id 		= FORM_WIZARD_UPLOAD_DECLARATION_ID;

// Form Instruction Start 

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

/* Form Instruction End */

$appln_form_fee  = $applicant_appln_details_list[0]['appln_form_fee'];

/* Payment Details Start */
$branch_name     = $payment_details_list['branch_name'];
$dd_cheque_no    = $payment_details_list['dd_cheque_no'];
$dd_cheque_date  = $payment_details_list['dd_cheque_date'];

if($dd_cheque_date) {
 $dd_cheque_date = date('m/d/Y',strtotime($dd_cheque_date));
}
$payment_mode_id = $payment_details_list['payment_mode_id'];

/* Payment Details End */
//print_r($applicant_course_prefer_details_list);die;
if($applicant_course_prefer_details_list) {
   foreach($applicant_course_prefer_details_list as $k=>$v) {
      $applicant_course_id = $v['applicant_course_id'];
      $applicant_course_course_id = $v['branch_id'];
      $applicant_course_course_name = $v['course_name'];
      $applicant_course_choice_no = $v['choice_no'];
      $applicant_course_is_active = $v['is_active'];
      $applicant_deg_id = $v['deg_id'];
      $applicant_deg_short_name = $v['deg_short_name'];
   }
}
$application_status_id =$applicant_appln_details_list[0]['application_status_id'];
$attributes = array('class' => 'form-horizontal form-wizard-wrapper .custom-validation', 'id' => 'tamil_form', 'name' => 'tamil_form', 'enctype' => 'multipart/form-data', 'data-parsley-validate data-toggle'=>"validator");
echo form_open('', $attributes);
?>
<div class="loader" style="display:none;">
</div>
<div>
	<div id="formerr" style="display:none;color:red">Something went to wrong.Please try again later.</div>
</div>
<div class="mb-3">
<div class="progress">
<div class="progress-bar" id="percentage_bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
</div>
</div>
<h3 class="wizard_head_tag">Basic Preferences</h3>
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
			</div><!-- card-header -->

			<div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
				<div class="card-body" style="font-size: 13px;"><?php echo $applicant_basic_wizard_instructions; ?></div>
			</div>
		</div>

		<!-- card -->
	</div>
	<div class="w-100 pd-20 pd-sm-40">
		<h6 class="card-body-title"></h6>
		<div class="form-layout">
		<div class="w-100 pd-20 pd-sm-40">
		<div class="form-layout">
			<div class="row mg-b-25 mt-3">
				<div class="col-lg-6">
					<label class="form-control-label">Degree<span class="tx-danger"> *</span></label>
                <select class="form-control custom-select" id="tamilperayam_degree_list" name="tamilperayam_degree_list" data-placeholder="Select Degree" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHOOSE_DEGREE_MSG;?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-tamilperayam_degree_list-parsley-error">
                    <option value="">Select Degree</option>
                </select>
                <span id="custom-tamilperayam_degree_list-parsley-error"></span>
				</div><!-- col-4 apg_course pd_course_preference-->
				<div class="col-lg-6" id="tamil_course" style="display:none;">
					<div class="form-group mg-b-10-force">
						<label class="form-control-label">Course<span class="tx-danger"> *</span></label>
						<select class="form-control select2" data-placeholder="Choose Course" tabindex="-1" aria-hidden="true" name="tamil_course_preference" id="tamil_course_preference" title="Choose Course" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHOOSE_COURSE_MSG;?>" data-parsley-errors-container="#custom-tamil_course_preference-parsley-error">
							<option value="">Select Course</option>
						</select>
						<span id="custom-tamil_course_preference-parsley-error"></span>
						<input type="hidden" name="course_choice_no_1" id="course_choice_no_1" value="1" />
						<input type="hidden" name="course_prefer_id_1" id="course_prefer_id_1" 
						value="<?php echo $applicant_course_id;?>" />
					</div>
				</div><!-- col-4 -->				
			</div><!-- row -->
			<input type="hidden" name="appln_status" id="appln_status" value="<?php echo $application_status_id; ?>">
		</div><!-- form-layout -->
	</div>
			
		</div>
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
			</div><!-- card-header -->

			<div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
				<div class="card-body" style="font-size: 13px;"><?php echo $applicant_pref_per_wizard_instructions; ?></div>
			</div>
		</div>

		<!-- card -->
	</div>
	
	<div class="w-100 pd-20 pd-sm-40">
		<h5 class="card-body-title mt-4 text-primary">Personal Details</h5>
		<div class="form-layout">
			<div class="row mg-b-25">
				<div class="col-lg-4">
					<div class="form-group mg-b-10-force">
					  <label class="form-control-label">Title<span class="tx-danger"> *</span></label>
					  <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_title" id="pd_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG;?>" data-parsley-errors-container="#custom-pd_title-parsley-error">
						  <option label="Choose country"></option>
						  <option value="MR">MR</option>
						  <option value="MRS">MRS</option>
						  <option value="MISS">MISS</option>
					  </select>
					  <span id="custom-pd_title-parsley-error"></span>
					</div>
				</div><!-- col-4 -->
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">First Name <span class="tx-danger"> *</span></label>
						<input class="form-control" type="text" name="pd_firstname" id="pd_firstname" placeholder="Enter First Name" placeholder="Your First Name" maxlength="<?php echo APLCT_FIRST_NAME_MAXLENGTH;?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_FIRST_NAME_MSG;?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_FIRST_NAME_MINLENGTH;?>, <?php echo APLCT_FIRST_NAME_MAXLENGTH;?>]" value="<?php echo $first_name; ?>">
					</div>
				</div><!-- col-4 -->
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">Middle Name </label>
						<input class="form-control" type="text" name="pd_middlename" id="pd_middlename" placeholder="Your Middle Name" placeholder="Your Last Name" maxlength="<?php echo APLCT_MIDDLE_NAME_MAXLENGTH;?>"data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_MIDDLE_NAME_MINLENGTH;?>, <?php echo APLCT_MIDDLE_NAME_MAXLENGTH;?>]" value="<?php echo $middle_name; ?>">
					</div>
				</div><!-- col-4 -->
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">Last Name <span class="tx-danger"> *</span></label>
						<input class="form-control" type="text" name="pd_lastname"  id="pd_lastname" placeholder="Your Last Name" maxlength="<?php echo APLCT_LAST_NAME_MAXLENGTH;?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_LAST_NAME_MSG;?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_LAST_NAME_MINLENGTH;?>, <?php echo APLCT_LAST_NAME_MAXLENGTH;?>]" data-parsley-pattern="/^[a-zA-Z-.\s]+$/" value="<?php echo $last_name; ?>">
						<span>Use . (dot), if you have no last name.</span>
					</div>
					
				</div><!-- col-4 -->
				<div class="col-lg-4">
					<label class="form-control-label">Mobile No. <span class="tx-danger"> *</span></label>
						<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
						  <select class="form-control form_control custom-select Mobile_number" id="phone_no_code" name="phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
							  <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>
							  <option value="Law">Law</option>
							  <option value="Other">Other</option>
						  </select>
							</span>
							<input type="text" name="pd_mobile_no" id="pd_mobile_no" maxlength="<?php echo APLCT_MOBILE_MAXLENGTH;?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Mobile No" class="form-control" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOBILE_MSG;?>" data-parsley-errors-container="#custom-pd_mobile_no-parsley-error" value="<?php echo $phone_no; ?>" data-parsley-mobileonly="true">
						</div>
					<span id="custom-pd_mobile_no-parsley-error"></span>	
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">Email ID <span class="tx-danger"> *</span></label>
						<input class="form-control" type="email" name="pd_email" id="pd_email" placeholder="Your email id." data-parsley-required="true" data-parsley-required-message="<?php echo REQD_EMAIL_MSG;?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_email-parsley-error" value="<?php echo $email_id; ?>" maxlength="<?php echo APLCT_EMAIL_MAXLENGTH;?>" readonly>
						<span id="custom-pd_email-parsley-error"></span>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="wd-200 w-100">
						<label class="form-control-label">Date of Birth<span class="tx-danger"> *</span></label>
						<div class="input-group"><span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
						<input class="form-control hasDatepicker" name="pd_dob" id="pd_dob" placeholder="MM/DD/YYYY" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DOB_MSG;?>" data-parsley-errors-container="#custom-pd_dob-parsley-error" value="<?php echo  $dob; ?>" autocomplete="off">
						</div>
					</div>
					<span id="custom-pd_dob-parsley-error"></span>
				</div>
				<div class="col-lg-4">
					<div class="form-group mg-b-10-force">
						<label class="form-control-label">Gender <span class="tx-danger"> *</span></label>
						<select class="form-control select2" data-placeholder="Choose Gender" tabindex="-1" aria-hidden="true" name="pd_gender" id="pd_gender" title="Choose Gender" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_GENDER_MSG;?>" data-parsley-errors-container="#custom-pd_gender-parsley-error">
							<option label="Choose Gender"></option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
							<option value="Transgender">Transgender</option>
						</select>
						<span id="custom-pd_gender-parsley-error"></span>
					</div>
				</div><!-- col-4 -->
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">Alternate Email ID </label>
						<input class="form-control" type="email" name="pd_alt_email" id="pd_alt_email" placeholder="Alternate Email" data-parsley-required="false" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Alternate Email ID" data-parsley-errors-container="#custom-pd_alt_email-parsley-error" value="<?php echo $second_email_id; ?>" data-parsley-notequalto="#pd_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH; ?>" maxlength="<?php echo APLCT_ALT_EMAIL_MAXLENGTH;?>">
						<span id="custom-pd_alt_email-parsley-error"></span>
						<p id="suggestion_alt_email"></p>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="form-group mg-b-10-force">
						<label class="form-control-label">Blood Group <span class="tx-danger"> *</span></label>
						<select class="form-control select2" data-placeholder="Choose Blood Group" tabindex="-1" aria-hidden="true" name="pd_blood_group" id="pd_blood_group" title="Choose Blood Group" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BLOOD_GRP_MSG;?>" data-parsley-errors-container="#custom-pd_blood_group-parsley-error">
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
						<label class="form-control-label">Religion</label>
						<select class="form-control select2" data-placeholder="Choose Religion" tabindex="-1" aria-hidden="true" name="pd_religion" id="pd_religion" title="Choose Religion">
							<option value="">Select Religion</option>
						</select>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="form-group mg-b-10-force">
						<label class="form-control-label">Mother Tongue</label>
						<select class="form-control select2" data-placeholder="Choose Mother Tongue" tabindex="-1" aria-hidden="true" name="pd_mother_tongue" id="pd_mother_tongue" title="Choose Mother Tongue">
							<option value="">Select Mother Tongue</option>
						</select>
					</div>
				</div><!-- col-4 -->
				
				<div class="col-lg-4">
					<div class="form-group mg-b-10-force">
						<label class="form-control-label">Medium Of Instruction</label>
						<select class="form-control select2" data-placeholder="Choose Medium Of Instruction" tabindex="-1" aria-hidden="true" name="pd_medium_of_instruction" id="pd_medium_of_instruction" title="Choose Medium Of Instruction">
							<option value="">Select Medium Of Instruction</option>
						</select>
					</div>
				</div><!-- col-4 -->

				<div class="col-lg-4">
					<div class="form-group mg-b-10-force">
						<label class="form-control-label">Hostel Accommodation</label>
						<select class="form-control select2" data-placeholder="Choose Hostel Accommodation" tabindex="-1" aria-hidden="true" name="pd_hostel_accommodation" id="pd_hostel_accommodation" title="Choose Hostel Accommodation">
							<option value="">Select Hostel Accommodation</option>
						</select>
					</div>
				</div><!-- col-4 -->				

				<div class="col-lg-4">
					<div class="form-group mg-b-10-force">
						<label class="form-control-label">Are you a differently Abled?<span class="tx-danger"> *</span></label>
						<select class="form-control select2" data-placeholder="Choose Differently Abled" tabindex="-1" aria-hidden="true" name="pd_diffrently_abled" id="pd_diffrently_abled" title="Choose Differently Abled" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DIFF_ABLED_MSG;?>" data-parsley-errors-container="#custom-pd_diffrently_abled-parsley-error">
							<option value="">Select differently Abled</option>
							<option value="yes">Yes</option>
							<option value="No">No</option>
						</select>
						<span id="custom-pd_diffrently_abled-parsley-error"></span>
					</div>
				</div><!-- col-4 -->
				
				<div class="col-lg-4">
					<div class="form-group mg-b-10-force">
						<label class="form-control-label">Where Did You See Admission Advertisement? </label>
						<select class="form-control select2" data-placeholder="Choose Admission Advertisement" tabindex="-1" aria-hidden="true" name="pd_advertisement_source" id="pd_advertisement_source" title="Choose Admission Advertisement">
							<option value="">Select Admission Advertisement</option>
						</select>
					</div>
				</div><!-- col-4 -->

				<div class="col-lg-4">
					<div class="form-group mg-b-10-force">
						<label class="form-control-label">Nationality <span class="tx-danger"> *</span></label>
						<select class="form-control select2" data-placeholder="Choose Nationality" tabindex="-1" aria-hidden="true" name="pd_nationality" id="pd_nationality" title="Choose Nationality" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_NATION_MSG;?>" data-parsley-errors-container="#custom-pd_nationality-parsley-error">
							<option value="">Select Nationality</option>
						</select>
						<span id="custom-pd_nationality-parsley-error"></span>
					</div>
				</div><!-- col-4 -->

				<div class="col-lg-4" id="main_div_social_status" style="display:none;">
					<div class="form-group mg-b-10-force">
						<label class="form-control-label">Social Status <span class="tx-danger"> *</span></label>
						<select class="form-control select2" data-placeholder="Choose Social Status" tabindex="-1" aria-hidden="true" name="pd_social_status" id="pd_social_status" title="Choose Social Status" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SOCIAL_STATUS_MSG;?>" data-parsley-errors-container="#custom-pd_social_status-parsley-error">
							<option value="">Select Social Status</option>
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
				<div class="card-body" style="font-size: 13px;"><?php echo $applicant_parent_address_wizard_instructions; ?></div>
			</div>
		</div>

		<!-- card -->
	</div>
	<div class="w-100 pd-20 pd-sm-40">
		<h5 class="card-body-title mt-4 text-primary">Father's Details</h5>
		<div class="form-layout">
			<div class="row mg-b-25 mt-3">
				<div class="col-lg-4">
					<div class="form-group mg-b-10-force">
						<label class="form-control-label">Title <span class="tx-danger">*</span></label>
						<select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_father_title" id="pd_father_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG;?>" data-parsley-errors-container="#custom-pd_father_title-parsley-error" data-parsley-trigger="change">
							<option label="Choose country"></option>
							<option value="MR">MR</option>
							<option value="MRS">MRS</option>
							<option value="MISS">MISS</option>
						</select>
						<span id="custom-pd_father_title-parsley-error"></span>
						 <input type="hidden" name="pd_father_id" id="pd_father_id" value="<?php echo $app_parent_det_id[$parent_type_id_father]; ?>" />
					</div>
				</div><!-- col-4 -->
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">Father's Name <span class="tx-danger"> *</span></label>
						<input class="form-control" type="text" name="pd_father_name" id="pd_father_name" placeholder="Enter Your Father Name" maxlength="<?php echo APLCT_FATHER_NAME_MAXLENGTH;?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_FATHER_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_FATHER_NAME_MINLENGTH;?>, <?php echo APLCT_FATHER_NAME_MAXLENGTH;?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_father]; ?>">
					</div>
				</div><!-- col-4 -->
				<div class="col-lg-4" id="father_mbleno_div" style="display:none;">
					<label class="form-control-label">Father's Mobile Number
					</label>
					<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
						<select class="form-control form_control custom-select Mobile_number" id="pd_father_phone_no_code" name="pd_father_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
							<option value="<?php echo $country_value_default; ?>">+91</option>
							<option value="Law">Law</option>
							<option value="Other">Other</option>
						</select>
					</span>
					<input type="text" class="form-control" name="pd_father_phone" id="pd_father_phone" maxlength="<?php echo APLCT_FATHER_MOBILE_MAXLENGTH;?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_FATHER_MOBILE_MSG;?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="<?php echo VALID_FATHER_MOBILE_MSG;?>" data-parsley-errors-container="#custom-pd_father_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no[$parent_type_id_father]; ?>" data-parsley-notequalto="#pd_mother_phone" data-parsley-notequalto-message="<?php echo PHONE_MATCH_FATHER; ?>">
				</div>
				<span id="custom-pd_father_phone-parsley-error"></span>
				</div>
				<div class="col-lg-4" id="father_ambleno_div" style="display:none;">
					<label class="form-control-label">Father's Alternate Mobile Number 
					</label>
					<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
						<select class="form-control form_control custom-select Mobile_number" id="pd_father_alt_phone_no_code" name="pd_father_alt_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
							<option value="<?php echo $country_value_default; ?>" selected>+91</option>
							<option value="Law">Law</option>
							<option value="Other">Other</option>
						</select>
					</span>
					<input type="text" class="form-control" name="pd_alt_father_phone" id="pd_alt_father_phone" maxlength="<?php echo APLCT_FATHER_ALT_MOBILE_MAXLENGTH;?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Alternate Mobile Number" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FATHER_ALT_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_FATHER_MOBILE_MSG;?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="<?php echo VALID_FATHER_MOBILE_MSG;?>" data-parsley-errors-container="#custom-pd_alt_father_phone-parsley-error" value="<?php echo $applicant_parent_alt_mobile_no[$parent_type_id_father]; ?>" data-parsley-notequalto="#pd_alt_mother_phone" data-parsley-notequalto-message="<?php echo PHONE_MATCH_FATHER; ?>">
				</div>
				<span id="custom-pd_alt_father_phone-parsley-error"></span>
				</div>				
				<div class="col-lg-4" id="father_email_div" style="display:none;">
					<div class="form-group">
						<label class="form-control-label">Father's Email ID </label>
						<input class="form-control" type="email" name="pd_father_email" id="pd_father_email"  placeholder="Enter Your Father's Email ID"data-parsley-required="false" data-parsley-required-message="Please Enter Email ID" data-parsley-type="email" data-parsley-type-message="<?php echo REQD_FATHER_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_father_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_father]; ?>" data-parsley-notequalto="#pd_mother_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_FATHER; ?>">
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
				</div><!-- col-4 -->
			</div><!-- row -->
		</div><!-- form-layout -->
	</div>
	<div class="w-100 pd-20 pd-sm-40">
		<h5 class="card-body-title mt-4 text-primary">Mother's Details</h5>
		<div class="form-layout">
			<div class="row mg-b-25 mt-3">
				<div class="col-lg-4">
					<div class="form-group mg-b-10-force">
						<label class="form-control-label">Title <span class="tx-danger">*</span></label>
						<select class="form-control select2" name="pd_mother_title" id="pd_mother_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_TITLE_MSG;?>" data-parsley-errors-container="#custom-pd_mother_title-parsley-error" data-parsley-trigger="change">
							<option label="Choose country"></option>
							<option value="MR">MR</option>
							<option value="MRS">MRS</option>
							<option value="MISS">MISS</option>
						</select>
						<span id="custom-pd_mother_title-parsley-error"></span>
						<input type="hidden" name="pd_mother_id" id="pd_mother_id"  value="<?php echo $app_parent_det_id[$parent_type_id_mother]; ?>" />
					</div>
				</div><!-- col-4 -->
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">Mother's Name <span class="tx-danger">*</span></label>
						<input type="text" class="form-control" name="pd_mother_name" id="pd_mother_name" placeholder="Enter Your Father Name" maxlength="<?php echo APLCT_MOTHER_NAME_MAXLENGTH;?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MOTHER_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_MOTHER_NAME_MINLENGTH;?>, <?php echo APLCT_MOTHER_NAME_MAXLENGTH;?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_mother]; ?>">
					</div>					
				</div><!-- col-4 -->
				<div class="col-lg-4" id="mother_mbleno_div" style="display:none;">
					<label class="form-control-label">Mother's Mobile Number</label>
					<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
						<select class="form-control form_control custom-select Mobile_number" id="pd_mother_phone_no_code" name="pd_mother_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
							<option value="<?php echo $country_value_default; ?>" selected>+91</option>
							<option value="Law">Law</option>
							<option value="Other">Other</option>
						</select>
					</span>
					<input type="text" class="form-control" name="pd_mother_phone" id="pd_mother_phone" maxlength="<?php echo APLCT_MOTHER_MOBILE_MAXLENGTH;?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOTHER_MOBILE_MSG;?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="<?php echo VALID_MOTHER_MOBILE_MSG;?>" data-parsley-errors-container="#custom-pd_mother_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no[$parent_type_id_mother]; ?>" data-parsley-notequalto="#pd_father_phone" data-parsley-notequalto-message="<?php echo PHONE_MATCH_MOTHER; ?>">
					<span id="custom-pd_mother_phone-parsley-error"></span>
					</div>
				</div>
				
				<div class="col-lg-4" id="mother_ambleno_div" style="display:none;">
					<label class="form-control-label">Mother's Alternate Mobile Number 
					</label>
					<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
						<select class="form-control form_control custom-select Mobile_number" id="pd_mother_alt_phone_no_code" name="pd_mother_alt_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
							<option value="<?php echo $country_value_default; ?>" selected>+91</option>
							<option value="Law">Law</option>
							<option value="Other">Other</option>
						</select>
					</span>
					<input type="text" class="form-control" name="pd_alt_mother_phone" id="pd_alt_mother_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Alternate Mobile Number" class="form-control" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOTHER_MOBILE_MSG;?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="<?php echo VALID_MOTHER_MOBILE_MSG;?>" data-parsley-errors-container="#custom-pd_alt_mother_phone-parsley-error" value="<?php echo $applicant_parent_alt_mobile_no[$parent_type_id_mother]; ?>" data-parsley-notequalto="#pd_alt_father_phone" data-parsley-notequalto-message="<?php echo PHONE_MATCH_MOTHER; ?>">
				</div>
				<span id="custom-pd_alt_mother_phone-parsley-error"></span>
				</div>				
				<div class="col-lg-4" id="mother_email_div" style="display:none;">
					<div class="form-group">
						<label class="form-control-label">Mother's Email ID </label>
						<input class="form-control" type="email" name="pd_mother_email" id="pd_mother_email"  placeholder="Enter Your Mother's Email ID"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_MOTHER_EMAIL_MSG;?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_MOTHER_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_mother_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_mother]; ?>" data-parsley-notequalto="#pd_father_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH_MOTHER; ?>" maxlength="<?php echo APLCT_MOTHER_EMAIL_MAXLENGTH;?>">
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
				</div><!-- col-4 -->
			</div><!-- row -->
		</div><!-- form-layout -->
	</div>
	<div>
	  <label class="ckbox add_guardian_checkbox">
		<div class="custom-control custom-checkbox">
		  <input class="custom-control-input" type="checkbox" name="add_guardian_checkbox" id="add_guardian_checkbox" value="<?php echo ($add_gardian == 't')?'true':'false'; ?>" <?php echo ($add_gardian == 't')?'checked':''; ?>><label class="custom-control-label" for="add_guardian_checkbox"> Add Guardian Detail </label>
		</div>
	  </label>
	</div>
	<div class="w-100 pd-20 pd-sm-40" id="guardian_details" style="<?php echo ($add_gardian == 't')?'display:block':'display:none'; ?>">
		<h3 class="card-body-title mt-4 text-primary">Guardian's Details</h3>
		<div class="form-layout">
			<div class="row mg-b-25 mt-3">
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">Guardian's Name <span class="tx-danger">*</span></label>
						<input class="form-control" type="text" name="pd_guardian_name" id="pd_guardian_name" placeholder="Enter Your Guardian's Name" maxlength="<?php echo APLCT_GUARDIAN_NAME_MAXLENGTH;?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_GUARDIAN_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_GUARDIAN_NAME_MINLENGTH;?>, <?php echo APLCT_GUARDIAN_NAME_MAXLENGTH;?>]" value="<?php echo $applicant_parent_parent_name[$parent_type_id_guardian]; ?>">
						<input type="hidden" name="pd_guardian_id" id="pd_guardian_id" value="<?php echo $app_parent_det_id[$parent_type_id_guardian]; ?>" />
					</div>					
				</div><!-- col-4 -->
				<div class="col-lg-4">
					<label class="form-control-label">Guardian's Mobile No <span class="tx-danger">*</span></label>
						<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
						<select class="form-control form_control custom-select Mobile_number" id="pd_guardian_phone_no_code" name="pd_guardian_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
							<option value="<?php echo $country_value_default; ?>" selected>+91</option>
							<option value="Law">Law</option>
							<option value="Other">Other</option>
						</select>
						</span>
						<input type="text" class="form-control" name="pd_guardian_phone" id="pd_guardian_phone" maxlength="<?php echo APLCT_GUARDIAN_MOBILE_MAXLENGTH;?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Guardian's Mobile No" class="form-control" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_GUARDIAN_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_GUARDIAN_MOBILE_MSG;?>" data-parsley-mobileonly="true" data-parsley-maxlength-message="<?php echo VALID_GUARDIAN_MOBILE_MSG;?>" data-parsley-errors-container="#custom-pd_guardian_phone-parsley-error" value="<?php echo $applicant_parent_mobile_no[$parent_type_id_guardian]; ?>">
					</div>
					<span id="custom-pd_guardian_phone-parsley-error"></span>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">Guardian's Email ID <span class="tx-danger">*</span></label>
						<input class="form-control" type="email" name="pd_guardian_email" id="pd_guardian_email"  placeholder="Enter Your Guardian's Email ID"data-parsley-required="true" data-parsley-required-message="<?php echo REQD_GUARDIAN_EMAIL_MSG;?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_GUARDIAN_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_guardian_email-parsley-error" value="<?php echo $applicant_parent_email_id[$parent_type_id_guardian]; ?>" maxlength="<?php echo APLCT_GUARDIAN_EMAIL_MAXLENGTH;?>">
						<span id="custom-pd_guardian_email-parsley-error"></span>
						<p id="suggestion_guardian_email"></p>						
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group mg-b-10-force">
						<label class="form-control-label">Guardian's Occupation <span class="tx-danger">*</span></label>
						<select class="form-control select2" data-placeholder="Choose Guardian Occupation" tabindex="-1" aria-hidden="true" name="pd_guardian_occupation" id="pd_guardian_occupation" data-parsley-errors-container="#custom-pd_guardian_occupation-parsley-error">
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
						<span id="custom-pd_guardian_occupation-parsley-error"></span>
					</div>
					<div id="other_occupation_guardian_div" style="display:none;">
						<input class="form-control" type="text" name="other_occupation_guardian" id="other_occupation_guardian"  placeholder="If Other, pls enter here"data-parsley-required="false" data-parsley-errors-container="#custom-other_occupation_guardian-parsley-error" value="<?php echo $applicant_parent_other_occupation_name[$parent_type_id_guardian]; ?>">
						<span id="custom-other_occupation_guardian-parsley-error"></span>
					</div>					
				</div><!-- col-4 -->
			</div><!-- row -->
		</div><!-- form-layout -->
	</div>	
</fieldset>
<h3 class="wizard_head_tag">Address</h3>
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
				<div class="card-body" style="font-size: 13px;"><?php echo $applicant_address_wizard_instructions; ?></div>
			</div>
		</div>
		<!-- card -->
	</div>
	<div class="w-100 pd-20 pd-sm-40">
		<h5 class="card-body-title mt-4 text-primary">Address for Communication</h5>		
		<div class="form-layout">
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
						<input class="form-control" type="text" name="address_line1" id="address_line1" placeholder="Enter Address Line 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_ADDRESS_MSG;?>" value="<?php if($add_line_1[0]) {echo $add_line_1[0];} ?>" data-parsley-maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH;?>" maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH;?>">
					</div>
				</div><!-- col-4 -->
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">Address Line 2 <!--<span class="tx-danger">*</span>--></label>
						<input class="form-control" type="text" name="address_line2" id="address_line2" placeholder="Enter Address Line 2" value="<?php if($add_line_2[0]) {echo $add_line_2[0];} ?>" data-parsley-maxlength="<?php echo APLCT_ADDRESS2_MAXLENGTH;?>" maxlength="<?php echo APLCT_ADDRESS2_MAXLENGTH;?>">
					</div>
				</div><!-- col-4 -->
				<div class="col-lg-4">
					<div class="form-group">
						<label class="form-control-label">Pincode <span class="tx-danger">*</span></label>
						<input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Pincode" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PINCODE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_PINCODE_MSG;?>" value="<?php if($pin_code[0]) {echo $pin_code[0];} ?>" data-parsley-pincodeonly="true" data-parsley-errors-container="#custom-pincode-parsley-error" maxlength="<?php echo APLCT_PINCODE_MAXLENGTH;?>">
						<span id="custom-pincode-parsley-error"></span>
					</div>
					
				</div><!-- col-4 -->
			</div><!-- row -->	
		</div>  	
</fieldset>
<h3 class="wizard_head_tag">Academic Detail</h3>
<fieldset>
	<div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
		<div class="card ">
			<div class="card-header p-0 " role="tab" id="headingOne">
				<h6 class="p-2 ml-3">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed"><i class="fas fa-info-circle"></i>Instructions</a>
				</h6>
			</div><!-- card-header -->

			<div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
				<div class="card-body" style="font-size: 13px;"><?php echo $applicant_academic_wizard_instructions;?></div>
			</div>
		</div>

		<!-- card -->
	</div>
	<div action="form-validation.html" id="selectForm" class="w-100">
		<div class="row">
			<div class="col-lg-6 ">
				<div class="form-group wd-xs-300 mr-5 w-100">
					<label class="form-control-label">Candidate's Name as in 10th Certificate<span class="tx-danger"> *</span></label>
					<div class="form-group mg-b-10-force">
						<input class="form-control" type="text" name="candidate_name" id="candidate_name" placeholder="Candidate's Name" maxlength="<?php echo APLCT_CAND_NAME_MAXLENGTH;?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CANDIDATE_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_CAND_NAME_MINLENGTH;?>, <?php echo APLCT_CAND_NAME_MAXLENGTH;?>]" value="<?php echo $name_as_in_marksheet[$tenth_schooling_id]; ?>">
						<b id="emailHelp" class="form-text text-muted">Kindly type 'NA' in case Certificate is not available with you.</b>
					</div>
				</div><!-- form-group -->
			</div>
		</div>
	</div>
	<h5 >Academic Details <span class="tx-danger"> *</span></h5>
	<table class="table table-bordered table-responsive mt-3" id="academc_common">
		<thead class="thead-light">
			<tr>
				<th>
				</th>
				<th>Institute <span class="tx-danger">*</span></th>
				<th>Board <span class="tx-danger">*</span></th>
				<th>Marking Scheme <span class="tx-danger">*</span></th>
				<th>CGPA <span class="tx-danger">*</span></th>
				<th>Year of Passing <span class="tx-danger">*</span></th>
				<th>Roll No. <span class="tx-danger">*</span></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<p>X</p>
				</td>
				<td>
					<input class="form-control" type="text" name="academic_tenth_inst" id="academic_tenth_inst" maxlength="<?php echo APLCT_INSTITUTE_NAME_MAXLENGTH;?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_INSTITUTE_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_INSTITUTE_NAME_MINLENGTH;?>, <?php echo APLCT_INSTITUTE_NAME_MAXLENGTH;?>]" value="<?php echo $inst_name[$tenth_schooling_id]; ?>">
				</td>
				<td>
					<div class="form-group mg-b-10-force">
						<select class="form-control select2 academic_board" name="academic_board" id="academic_board" title="Choose Board" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BOARD_MSG;?>" data-parsley-errors-container="#custom-academic_board-parsley-error">
							<option value="">Select</option>
						</select>
						<span id="custom-academic_board-parsley-error"></span>
					</div>
					<div id="ob_tenth" style="display:none;">
						<input class="form-control" type="text" name="other_board_tenth" id="other_board_tenth" maxlength="<?php echo APLCT_OTHER_GRAD_MAXLENGTH;?>" value="<?php echo $other_board_name[$tenth_schooling_id]; ?>" placeholder="Enter any other board" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>">					
					</div>
				</td>
				<td>
					<div class="form-group mg-b-10-force">
						<select class="form-control select2" name="academic_marking_scheme" id="academic_marking_scheme" title="Choose Academic Marking Scheme" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MARK_SCHEME_MSG;?>" data-parsley-errors-container="#custom-academic_marking_scheme-parsley-error">
						</select>
						<span id="custom-academic_marking_scheme-parsley-error"></span>
					</div>
				</td>
				<td>
					<input class="form-control" type="text" name="academic_obtain_cgpa" id="academic_obtain_cgpa" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG;?>"  data-parsley-type-message="<?php echo REQD_PERCENT_CGPA_VALID_MSG;?>" min="<?php echo APLCT_MARK_MINLENGTH;?>" max="<?php echo APLCT_MARK_MAXLENGTH;?>" data-parsley-trigger="keyup" data-parsley-type="number" value="<?php echo $mark_percentage[$tenth_schooling_id]; ?>" maxlength="<?php echo CGPA_MAXLENGTH; ?>">
				</td>
				<td>
					<div class="form-group mg-b-10-force">
						<input class="form-control" type="text" name="academic_yr_passing" id="academic_yr_passing" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_YEAR_OF_PASSING_MSG;?>" data-parsley-trigger="change" data-parsley-errors-container="#custom-academic_yr_passing-parsley-error" value="<?php echo $completion_year[$tenth_schooling_id]; ?>" onkeypress="return isNumber(event);" autocomplete="off">
						<span id="custom-academic_yr_passing-parsley-error"></span>						
					</div>
				</td>
				<td>
					<input class="form-control" type="text" name="academic_reg_no"id="academic_reg_no" maxlength="<?php echo APLCT_REG_NO_MAXLENGTH;?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_REG_NO_MSG;?>" data-parsley-length="[<?php echo APLCT_REG_NO_MINLENGTH;?>, <?php echo APLCT_REG_NO_MAXLENGTH;?>]" value="<?php echo $registration_no[$tenth_schooling_id]; ?>" data-parsley-type='alphanum' data-parsley-type-message="<?php echo VALID_REG_NO_MSG;?>" autocomplete="off">
				</td>
			</tr>
			
			
		</tbody>
	</table>
	<div class="row">
		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">NAD ID / Digilocker ID</label>
				<input class="form-control" type="text" name="nad_id_digilocker_id" id="nad_id_digilocker_id" placeholder="Enter NAD ID / Digilocker ID " value="<?php echo $nad_id_digilocker_id; ?>" maxlength="12">
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
			</div><!-- card-header -->

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
			</div><!-- card -->
			<div class="card base_details_card">
				<div class="card-body">
					<h5 class="card-title card_title">Order Details</h5>
					<p class="card-subtitle">Application Fee <span class="float-right"><?php echo $appln_form_fee; ?></span>
					</p>
				</div>
			</div><!-- card -->
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
									<!--<input class="form-control" type="text" name="BankName" id="BankName" placeholder="Bank Name" data-parsley-required="true" data-parsley-required-message="Required">-->
									<select class="form-control select2" name="BankName" id="BankName" title="Choose Bank Name" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHOOSE_BANK_MSG; ?>" data-parsley-errors-container="#custom-BankName-parsley-error">
										<option value=""  selected="selected">Select Bank Name</option>
									</select>
									<span id="custom-BankName-parsley-error"></span>									
								</div>
								<div class="col-md-6">
									<input class="form-control" type="text" name="BranchName" placeholder="Branch Name" id="BranchName" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BANK_NAME_MSG; ?>" maxlength="<?php echo APLCT_BRANCH_NAME_MAXLENGTH;?>" value="<?php echo $branch_name; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="Enter Valid Branch Name">
								</div>
							</div>

						</div>

						<div class="mt-3">
							<div class="row">
								<div class="col-md-6">
									<input class="form-control" type="text" name="DDNumber" id="DDNumber" placeholder="DD Number" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DD_NO_MSG; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_DD_NO_MSG; ?>"  maxlength="<?php echo APLCT_DD_NO_MAXLENGTH;?>" value="<?php echo $dd_cheque_no; ?>">
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
				</div>
			</div><!-- card -->
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
			</div><!-- card-header -->

			<div id="collapseOne7" class="collapse bg-light show" role="tabpanel" aria-labelledby="headingOne" style="">
				<div class="card-body" style="font-size: 13px;"><?php echo $applicant_upload_wizard_instructions; ?></div>
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
						<label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Signature<span class="tx-danger"> *</span></label>
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
				$applicant_appln_details_list_qual = $applicant_appln_details_list[0]['qual_status_id'];
				if($applicant_appln_details_list_qual==1){
					$applicant_appln_details_list_qual = "";
				}else{
					$applicant_appln_details_list_qual = "*";
				}
				?>
				<div class="row w-100">
					<div class="form-group col-md-6 ">
					   <label for="exampleFormControlTextarea1">Upload Your 10th Marksheet <span class="tx-danger"> <?php echo $applicant_appln_details_list_qual; ?></span></label>
					   <input type="file" class="filestyle" name="tenth_marksheet" id="tenth_marksheet" data-parsley-required="<?php echo ((isset($docs[$document_id_tenth_marksheet]))?'false':'true'); ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_10_MARKSHEET_MSG; ?>" data-parsley-errors-container="#custom-tenth_marksheet-parsley-error"data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_GRADUATION; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_tenth_marksheet])){ echo $docs[$document_id_tenth_marksheet]['id']; } ?>"accept="<?php  echo allow_extension($file_allowed_type); ?>">
					   <?php if(isset($docs[$document_id_tenth_marksheet])){ ?>
						  <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_tenth_marksheet; ?>">
							 <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_tenth_marksheet; ?>')">&times;</a>
							 <strong id="deleteMessageStatus_<?php echo $document_id_tenth_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_tenth_marksheet; ?>"></span>
						 </div>
					   <?php } ?>
					   <span id="custom-tenth_marksheet-parsley-error"></span>
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
						<label class="form-control-label">Applicant Name </label>
						<input class="form-control" type="text" name="applicant_name" id="applicant_name" placeholder="Applicant Name" value="<?php echo $applicant_name_declaration ;?>" maxlength="<?php echo APLCT_DECLR_NAME_MAXLENGTH;?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_APPLT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_DECLR_NAME_MINLENGTH;?>, <?php echo APLCT_DECLR_NAME_MAXLENGTH;?>]">
					</div>
					<div class="col-md-6">
						<label class="form-control-label">Parent Name </label>
						<input class="form-control" type="text" name="parent_name" id="parent_name" placeholder="Parent Name" value="<?php echo $applicant_parentname_declaration;?>" maxlength="<?php echo APLCT_DECLR_FATHER_NAME_MAXLENGTH;?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_PARENT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_DECLR_FATHER_NAME_MINLENGTH;?>, <?php echo APLCT_DECLR_FATHER_NAME_MAXLENGTH;?>]">
					</div>	
				</div>
				<div class="row w-100 mt-3">
					<div class="col-md-6">
						<label class="form-control-label">Declaration Date </label>
						<input class="form-control" type="text" name="ddate" id="ddate" value="<?php if(isset($ddate)){echo $ddate;}else{echo date('d-m-Y');} ?>" readonly>
					</div>
				</div>	
			</div><!-- row -->
		</div>
	</div>
</fieldset>
<?php form_close(); ?><!-- form -->