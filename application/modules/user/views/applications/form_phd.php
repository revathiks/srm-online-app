<?php 
$first_name = $applicant_basic_details_list['f_name'];
$middle_name = $applicant_basic_details_list['m_name'];
$last_name = $applicant_basic_details_list['l_name'];
$mobile_no = $applicant_basic_details_list['mob_no'];
$email_id = $applicant_basic_details_list['e_mail'];
$dob = $applicant_basic_details_list['dob'];

if($dob){
	$dob=isset($dob)? date('d/m/Y',strtotime($dob)):'';
}

$alt_email_id = $applicant_basic_details_list['sec_e_mail'];
$employee = $applicant_basic_details_list['employee'];
$user_id = $personal_detail_list['data']['user_id'];

$other_working_place = $applicant_graduations_list[0]['other_work_place'];
$other_deg_name = $applicant_graduations_list[0]['other_deg_name'];
$other_spec_name = $applicant_graduations_list[0]['other_spec_name'];
$other_dpt_name = $applicant_graduations_list[0]['other_dpt_name'];
$other_fac_name = $applicant_graduations_list[0]['other_work_place'];

$dif_abled = $applicant_basic_details_list['dif_abled'];

?>

<?php
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

$form_wizard_basic_id = FORM_WIZARD_BASIC_ID;
$form_wizard_preference_personal_id = FORM_WIZARD_PREFERENCE_PERSONAL_ID;
$form_wizard_parent_address_id = FORM_WIZARD_PARENT_ADDRESS_ID; 
$form_wizard_academic_id = FORM_WIZARD_ACADEMIC_ID;
$form_wizard_payment_id = FORM_WIZARD_PAYMENT_ID;
$form_wizard_declaration_id = FORM_WIZARD_DECLARATION_ID;
$form_wizard_upload_id = FORM_WIZARD_UPLOAD_ID;

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

$is_work_experience = $applicant_other_details_list['is_work_experience'];
$nameofemployee = $applicant_other_details_list['nameofemployee'];
$addressofemployee = $applicant_other_details_list['addressofemployee'];
$salaryreceived = $applicant_other_details_list['salaryreceived'];
$total_work_exp = $applicant_other_details_list['total_work_exp'];
$tentativetopicdocument = $applicant_other_details_list['tentativetopicdocument'];
$choiceofprefofsupervisor = $applicant_other_details_list['choiceofprefofsupervisor'];
$research_area = $applicant_other_details_list['research_area'];
$tentative_topic = $applicant_other_details_list['tentative_topic'];
$is_competitive_exam = $applicant_other_details_list['is_competitive_exam'];
$comp_exam_id = $applicant_other_details_list['comp_exam_id'];
$comp_exam_name = $applicant_other_details_list['comp_exam_name'];

$major_discipline_1 = $applicant_other_details_list['major_discipline_1'];
$major_discipline_2 = $applicant_other_details_list['major_discipline_2'];
$major_discipline_3 = $applicant_other_details_list['major_discipline_3'];

$applicant_publn_det_id = $applicant_publn_det_title = $applicant_publn_det_journal_conf_name = $applicant_publn_det_year = $applicant_prof_exp_id = $applicant_prof_exp_org_name = $applicant_prof_exp_designation = $applicant_prof_exp_job_nature = $applicant_prof_exp_salary = $applicant_prof_exp_from_date = $applicant_prof_exp_to_date = $applicant_prof_exp_work_exp_in_months = $applicant_grad_det_id = $applicant_grad_det_other_degree_name = $applicant_grad_det_univ_id = $applicant_grad_det_univ_name = $applicant_grad_det_mark_scheme_id = $applicant_grad_det_mark_percent = $applicant_grad_det_completion_year = array();
if($applicant_publication_dets_list) {
   foreach($applicant_publication_dets_list as $k=>$v) {
      $applicant_publn_det_id[] = $v['applicant_publn_det_id'];
      $applicant_publn_det_title[] = $v['tittle'];
      $applicant_publn_det_journal_conf_name[] = $v['journal_name'];
      $applicant_publn_det_year[] = $v['journal_year'];
   }
}
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
if($applicant_graduations_list) {
   foreach($applicant_graduations_list as $k=>$v) {
      $is_curr_qualify = $v['is_curr_qualify'];
      if($is_curr_qualify != 't') {
         $applicant_grad_det_id[] = $v['applicant_grad_det_id'];
         $applicant_grad_det_other_degree_name[] = $v['other_deg_name'];
         $applicant_grad_det_univ_id[] = $v['univ_id'];                             
         $applicant_grad_det_univ_name[] = $v['univ_name'];
         $applicant_grad_det_mark_scheme_id[] = $v['mark_scheme_id'];
         $applicant_grad_det_mark_scheme[] = $v['mark_scheme_name'];
         $applicant_grad_det_mark_percent[] = $v['mark_percentage'];
         $applicant_grad_det_completion_year[] = $v['yr_of_pass'];   
      }
   }
}

if(is_array($applicant_prof_exp_work_exp_in_months)){
$total_applicant_prof_exp_work_exp_in_months = array_sum($applicant_prof_exp_work_exp_in_months);
}

// Declaration Show
$applicant_name_declaration = $applicant_appln_details_list['applicant_name_declaration'];
$applicant_name_declaration = ($applicant_name_declaration)?$applicant_name_declaration:$first_name;

$ddate = $applicant_appln_details_list['applicant_declaration_date'];
$ddate = ($ddate)?date('d/m/Y',strtotime($ddate)):date('d/m/Y');

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

$applicant_parent_address_wizard_id = $applicant_instructions_list[$form_wizard_parent_address_id][0]['form_w_wizard_id'];
$applicant_parent_address_wizard_instructions = $applicant_instructions_list[$form_wizard_parent_address_id][0]['instruction'];
if($applicant_parent_address_wizard_instructions) {
  $applicant_parent_address_wizard_instructions = nl2br($applicant_parent_address_wizard_instructions);
} else {
  $applicant_parent_address_wizard_instructions = ' - ';
}
$applicant_parent_address_wizard_percent = $applicant_instructions_list[$form_wizard_parent_address_id][0]['completion_percent'];
$applicant_parent_address_wizard_message = $applicant_instructions_list[$form_wizard_parent_address_id][0]['message'];

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

$applicant_declaration_wizard_id = $applicant_instructions_list[$form_wizard_declaration_id][0]['form_w_wizard_id'];
$applicant_declaration_wizard_instructions = $applicant_instructions_list[$form_wizard_declaration_id][0]['instruction'];
if($applicant_declaration_wizard_instructions) {
  $applicant_declaration_wizard_instructions = nl2br($applicant_declaration_wizard_instructions);
} else {
  $applicant_declaration_wizard_instructions = ' - ';
}
$applicant_declaration_wizard_percent = $applicant_instructions_list[$form_wizard_declaration_id][0]['completion_percent'];
$applicant_declaration_wizard_message = $applicant_instructions_list[$form_wizard_declaration_id][0]['message'];

$applicant_upload_wizard_id = $applicant_instructions_list[$form_wizard_upload_id][0]['form_w_wizard_id'];
$applicant_upload_wizard_instructions = $applicant_instructions_list[$form_wizard_upload_id][0]['instruction'];
if($applicant_upload_wizard_instructions) {
  $applicant_upload_wizard_instructions = nl2br($applicant_upload_wizard_instructions);
} else {
  $applicant_upload_wizard_instructions = ' - ';
}
$applicant_upload_wizard_percent = $applicant_instructions_list[$form_wizard_upload_id][0]['completion_percent'];
$applicant_upload_wizard_message = $applicant_instructions_list[$form_wizard_upload_id][0]['message'];
/* form wizard instruction detail end */

$appln_form_fee = $applicant_appln_detail_list['appln_form_fee'];
$application_status_id =$applicant_appln_detail_list['application_status_id'];

/* Payment Details Start */
$branch_name = $applicant_payment_details_list['branch_name'];
$dd_cheque_no = $applicant_payment_details_list['dd_cheque_no'];
$dd_cheque_date = $applicant_payment_details_list['dd_cheque_date'];
if($dd_cheque_date) {
  $dd_cheque_date = date('m/d/Y',strtotime($dd_cheque_date));
}
$payment_mode_id = $applicant_payment_details_list['payment_mode_id'];

/* Payment Details End */

$attributes = array('class' => 'form-horizontal form-wizard-wrapper .custom-validation', 'id' => 'phd_form', 'name' => 'phd_form', 'enctype' => 'multipart/form-data', 'data-parsley-validate data-toggle'=>"validator");

echo form_open('', $attributes);
?>
<div class="loader" style="display:none;">

</div>
<div>
	<div id="formerr" style="display:none;color:red"><?php echo SOMETHING_WENT_WRONG;?></div>
</div>
<div class="mb-3">
<div class="progress">
<div class="progress-bar" id="percentage_bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo PROGRESS_INITIAL; ?></div>
</div>
</div>
   <h3 class="wizard_head_tag">Basic Details</h3>
    <div class="text-right w-100">
      <button class="btn btn-primary">Step <span id='show_currentindex'>1</span></button>
    </div>
   <fieldset>
      <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
          <div class="card ">
              <div class="card-header p-0 " role="tab" id="headingOne">
                  <h6 class="p-2 ml-3">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed"><i class="fas fa-info-circle"></i> Instructions</a>
                  </h6>
              </div><!-- card-header -->

              <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                  <div class="card-body" style="font-size: 13px;"><?php echo $applicant_basic_wizard_instructions; ?></div>
              </div>
          </div>

          <!-- card -->
      </div>
	  <input type="hidden" name="logged_applicant_id" id="logged_applicant_id" value="<?php echo $logged_applicant_id; ?>">
	  <input type="hidden" name="appln_status" id="appln_status" value="<?php echo $application_status_id; ?>">	  
      <div class="row" id="basic_details">
          <div class="col-md-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Qualifying Degree<span class="tx-danger"> *</span></label>
                  <select class="form-control custom-select study" data-placeholder="Choose Qualifying Degree" tabindex="-1" aria-hidden="true" name="qualifying_degree" id="qualifying_degree" title="Choose Qualifying Degree" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_QUALIFY_DEGREE_MSG;?>" data-parsley-errors-container="#custom-qualifying_degree-parsley-error">
                      <option value="">Select</option>
                  </select>
				  <span id="custom-qualifying_degree-parsley-error"></span>					  
              </div>				  
			   <div class="form-group" id="other_qd" style="display:none;">
					<input type="text" class="form-control" name="qualifying_degree_other" id="qualifying_degree_other" placeholder="If Other, pls enter here.." maxlength="<?php echo APLCT_100_MAXLENGTH; ?>" value="<?php //echo $other_deg_name; ?>">
				</div> 			  
          </div><!-- col-4 -->
          <div class="col-md-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Specialization In Qualifying Degree<span class="tx-danger"> *</span></label>
                  <select class="form-control custom-select study" data-placeholder="Choose Specialization In Qualifying Degree" tabindex="-1" aria-hidden="true" name="specialization_qualifying_degree" id="specialization_qualifying_degree" title="Choose Specialization In Qualifying Degree" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SPL_QUALIFY_DEGREE_MSG;?>" data-parsley-errors-container="#custom-spec_qualifying_degree-parsley-error">
                      <option value="">Choose Specialization In Qualifying Degree</option>
                  </select>
				  <span id="custom-spec_qualifying_degree-parsley-error"></span>
              </div>	
			   <div class="form-group" id="other_sqd" style="display:none;">
					<input type="text" class="form-control" name="spec_qualifying_degree_other" id="spec_qualifying_degree_other" placeholder="If Other, pls enter here.." maxlength="<?php echo APLCT_100_MAXLENGTH; ?>" value="<?php //echo $other_spec_name; ?>">
					<span id="custom-spec_qualifying_degree_other-parsley-error"></span>					
			   </div>		
          </div><!-- col-4 -->
          <div class="col-md-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Department / School / College<span class="tx-danger"> *</span></label>
                  <select class="form-control custom-select study" data-placeholder="Choose Department / School / College" tabindex="-1" aria-hidden="true" name="working_dsc" id="working_dsc" title="Choose Department / School / College" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DEP_SCH_COL_MSG;?>" data-parsley-errors-container="#custom-working_dsc-parsley-error">
                      <option value="">Select</option>
                  </select>
				  <span id="custom-working_dsc-parsley-error"></span>
              </div>
				<div class="form-group" id="other_dept" style="display:none;">
					<input type="text" class="form-control" name="dept_other" id="dept_other" placeholder="If Other, pls enter here.." maxlength="<?php echo APLCT_100_MAXLENGTH; ?>" value="<?php //echo $other_dpt_name; ?>">			   
			   </div>			  
          </div><!-- col-4 -->
      </div>
      <div class="row">
          <div class="col-md-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Faculty<span class="tx-danger"> *</span></label>
                  <select class="form-control custom-select study" data-placeholder="Choose Faculty" tabindex="-1" aria-hidden="true" name="faculty" id="faculty" title="Choose Faculty" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_FACULTY_MSG;?>" data-parsley-errors-container="#custom-faculty-parsley-error">
                      <option value="">Select</option>
                  </select>
				  <span id="custom-faculty-parsley-error"></span>
              </div>
				<div class="form-group" id="other_faculty" style="display:none;">
					<input type="text" class="form-control" name="faculty_other" id="faculty_other" placeholder="If Other, pls enter here.." maxlength="<?php echo APLCT_100_MAXLENGTH; ?>" value="<?php //echo $other_fac_name; ?>">			   
			   </div>			  
          </div><!-- col-4 -->
          <div class="col-md-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Category<span class="tx-danger"> *</span></label>
                  <select class="form-control custom-select study" data-placeholder="Choose Category" tabindex="-1" aria-hidden="true"  name="category" id="category" title="Choose Category" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CATEGORY_MSG;?>" data-parsley-errors-container="#custom-category-parsley-error">
                      <option value="">Select</option>
                  </select>
				  <span id="custom-category-parsley-error"></span>
              </div>
			  <input type="hidden" name="category_check" id="category_check">
          </div><!-- col-4 -->
          <div class="col-md-4" id="main_div_is_employed" style="display:none;">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Are you Employed?<span class="tx-danger"> *</span></label>
                  <select class="form-control custom-select study" data-placeholder="Choose Working Type" tabindex="-1" aria-hidden="true"  name="is_employed" id="is_employed" data-parsley-errors-container="#custom-is_employed-parsley-error">
                  </select>
				  <span id="custom-is_employed-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
      </div>
      <div class="row">
          <div class="col-md-4" id="main_div_working_place" style="display:none;">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Please Select Your Working Place<span class="tx-danger"> *</span></label>
                  <select class="form-control custom-select study" data-placeholder="Choose Working Place" tabindex="-1" aria-hidden="true" name="working_place" id="working_place" title="Choose Working Place" data-parsley-errors-container="#custom-working_place-parsley-error">
                      <option value="">Select</option>
                  </select>
				  <span id="custom-working_place-parsley-error"></span>
              </div>
				<div class="form-group" id="other_working_place" style="display:none;">
					<input type="text" class="form-control" name="work_place_other" id="work_place_other" placeholder="If Other, pls enter here.." maxlength="<?php echo APLCT_100_MAXLENGTH; ?>" value="<?php echo $other_working_place; ?>">			   
			   </div>			  
          </div><!-- col-4 -->
      </div>
   </fieldset>
   <h3 class="wizard_head_tag">Personal Details</h3>
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
                  <div class="card-body" style="font-size: 13px;"><?php echo $applicant_pref_per_wizard_instructions; ?></div>
              </div>
          </div>

          <!-- card -->
      </div>
      <div class="row">
          <div class="col-md-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Title<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Title" tabindex="-1" aria-hidden="true" name="pd_title" id="pd_title" title="Choose Title" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PHD_TITLE_MSG;?>" data-parsley-errors-container="#custom-pd_title-parsley-error">
                      <option value="">Choose Title</option>
                  </select>
				  <span id="custom-pd_title-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-md-4">
              <div class="form-group">
                  <label class="form-control-label">First Name <span class="tx-danger"> *</span></label>
                  <input class="form-control" type="text" name="pd_firstname" id="pd_firstname" placeholder="Your First Name" maxlength="<?php echo APLCT_FIRST_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_FIRST_NAME_MSG;?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_FIRST_NAME_MINLENGTH; ?>, <?php echo APLCT_FIRST_NAME_MAXLENGTH; ?>]" value="<?php echo $first_name; ?>">
              </div>
          </div><!-- col-4 -->
          <div class="col-md-4">
              <div class="form-group">
                  <label class="form-control-label">Middle Name </label>
                  <input class="form-control" type="text" name="pd_middlename" id="pd_middlename" placeholder="Your Middle Name" value="<?php echo $middle_name; ?>" maxlength="<?php echo APLCT_MIDDLE_NAME_MAXLENGTH; ?>" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_MIDDLE_NAME_MSG;?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>">
              </div>
          </div><!-- col-4 -->
      </div>
      <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                  <label class="form-control-label">Last Name <span class="tx-danger"> *</span></label>
                  <input class="form-control" type="text" name="pd_lastname" id="pd_lastname" placeholder="Your Last Name" maxlength="<?php echo APLCT_LAST_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_LAST_NAME_MSG;?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_LAST_NAME_MINLENGTH; ?>, <?php echo APLCT_LAST_NAME_MAXLENGTH; ?>]" value="<?php echo $last_name; ?>">
              </div>
          </div><!-- col-4 -->
          <div class="col-md-4">
              <label class="form-control-label">Mobile No <span class="tx-danger"> *</span></label>
              <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                      <select class="form-control form_control custom-select Mobile_number" id="phone_no_code" name="phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                          <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected>+91</option>
                          <option value="Law">Law</option>
                          <option value="Other">Other</option>
                      </select>
                  </span>
				  <input type="text" name="pd_mobile_no" id="pd_mobile_no" maxlength="<?php echo APLCT_MOBILE_MAXLENGTH; ?>" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Mobile No" class="form-control" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_MOBILE_MSG;?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_MOBILE_MSG;?>" data-parsley-mobileonly="true"  data-parsley-errors-container="#custom-pd_mobile_no-parsley-error" value="<?php echo $mobile_no; ?>">
              </div>
			  <span id="custom-pd_mobile_no-parsley-error"></span>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                  <label class="form-control-label">Email ID <span class="tx-danger"> *</span></label>
                  <input class="form-control" type="email" name="pd_email" id="pd_email" placeholder="Your email id." data-parsley-required="true" data-parsley-required-message="<?php echo REQD_EMAIL_MSG;?>" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_email-parsley-error" value="<?php echo $email_id; ?>" maxlength="<?php echo APLCT_EMAIL_MAXLENGTH; ?>" readonly>
				  <span id="custom-pd_email-parsley-error"></span>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-4">
              <div class="wd-200 w-100">
                  <label class="form-control-label">Date of Birth<span class="tx-danger"> *</span></label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                      <input type="text" class="form-control hasDatepicker" name="pd_dob" id="pd_dob" placeholder="MM/DD/YYYY" value="<?php echo  $dob; ?>" readonly data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DOB_MSG;?>" data-parsley-errors-container="#custom-pd_dob-parsley-error" data-parsley-trigger="change focusout">
                  </div>
                  <span id="custom-pd_dob-parsley-error"></span>
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Gender <span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Gender" tabindex="-1" aria-hidden="true" name="pd_gender" id="pd_gender" title="Choose Gender" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_GENDER_MSG;?>" data-parsley-errors-container="#custom-pd_gender-parsley-error">
                      <option value="">Choose Gender</option>
                  </select>
				  <span id="custom-pd_gender-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-md-4">
              <div class="form-group">
                  <label class="form-control-label">Alternate Email ID</label>
                  <input class="form-control" type="email" name="pd_alt_email" id="pd_alt_email" placeholder="Alternate Email" data-parsley-required="false" data-parsley-type="email" data-parsley-type-message="<?php echo VALID_ALT_EMAIL_MSG;?>" data-parsley-errors-container="#custom-pd_alt_email-parsley-error" value="<?php echo $alt_email_id; ?>" maxlength="<?php echo APLCT_ALT_EMAIL_MAXLENGTH; ?>" data-parsley-notequalto="#pd_email" data-parsley-notequalto-message="<?php echo EMAIL_MATCH; ?>">
				  <span id="custom-pd_alt_email-parsley-error"></span>
				  <p id="suggestion_alt_email"></p>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Blood Group <span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Blood Group" tabindex="-1" aria-hidden="true" name="pd_blood_group" id="pd_blood_group" title="Choose Blood Group" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BLOOD_GRP_MSG;?>" data-parsley-errors-container="#custom-pd_blood_group-parsley-error">
                      <option value="">Choose Blood Group</option>
                  </select>
				  <span id="custom-pd_blood_group-parsley-error"></span>
              </div>
          </div>
          <!-- col-4 -->
          <div class="col-md-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Nationality<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Nationality" tabindex="-1" aria-hidden="true" name="pd_nationality" id="pd_nationality" title="Choose Nationality" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_NATION_MSG;?>" data-parsley-errors-container="#custom-pd_nationality-parsley-error">
                      <option value="">Choose Nationality</option>
                  </select>
				  <span id="custom-pd_nationality-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-md-4" id="main_div_social_status" style="display:none;">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Social Status<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Social Status" tabindex="-1" aria-hidden="true" name="pd_social_status" id="pd_social_status" title="Choose Social Status" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_SOCIAL_STATUS_MSG; ?>" data-parsley-errors-container="#custom-pd_social_status-parsley-error">
                      <option value="">Choose Social Status</option>
                  </select>
				  <span id="custom-pd_social_status-parsley-error"></span>
              </div>
          </div>	  
      </div>
      <div class="row">
		  <!-- col-4 -->
          <div class="col-md-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Are you a differently Abled?<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Differently Abled" tabindex="-1" aria-hidden="true" name="pd_diffrently_abled" id="pd_diffrently_abled" title="Choose Differently Abled" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DIFF_ABLED_MSG; ?>" data-parsley-errors-container="#custom-pd_diffrently_abled-parsley-error">
                      <option value="">Choose Differently Abled</option>
                  </select>
				  <span id="custom-pd_diffrently_abled-parsley-error"></span>
              </div>
          </div><!-- col-4 -->		  
          <div class="col-md-4 main_div_deformity" style="display:none;" id="mnd">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Nature of Deformity<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Nature of Deformity" tabindex="-1" aria-hidden="true" name="pd_nature_deformity" id="pd_nature_deformity" title="Choose Nature of Deformity" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_NATURE_DEFORMITY_MSG; ?>" data-parsley-errors-container="#custom-pd_nature_deformity-parsley-error">
					  <option value="">Choose Nature of Deformity</option>
                  </select>
				  <span id="custom-pd_nature_deformity-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-md-4 main_div_deformity" style="display:none;" id="mpd">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Percentage of Deformity <span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose Percentage of Deformity" tabindex="-1" aria-hidden="true" name="pd_percent_of_deformity" id="pd_percent_of_deformity" title="Choose Percentage of Deformity" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_PERCENT_NATURE_DEFORMITY_MSG; ?>" data-parsley-errors-container="#custom-pd_percent_of_deformity-parsley-error">
                      <option value="">Choose Percentage of Deformity</option>
                  </select>
				  <span id="custom-pd_percent_of_deformity-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
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
                  <div class="card-body" style="font-size: 13px;"><?php echo $applicant_parent_address_wizard_instructions; ?></div>
              </div>
          </div>

          <!-- card -->
      </div>
      <div class="row">
          <div class="col-md-4">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Country<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose country" tabindex="-1" aria-hidden="true" name="country_phd" id="country_phd" title="Choose Country" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_COUNTRY_MSG; ?>" data-parsley-errors-container="#custom-country_phd-parsley-error">
					  <option value="">Select Country</option>
                  </select>
				  <span id="custom-country_phd-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-md-4" id="main_div_state" style="display:none;">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">State<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose State" tabindex="-1" aria-hidden="true" name="state_phd" id="state_phd" title="Choose State" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_STATE_MSG; ?>" data-parsley-errors-container="#custom-state_phd-parsley-error">
				      <option value="">Select State</option>
                       </select>
				  <span id="custom-state_phd-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-md-4" id="main_div_district" style="display:none;">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">District<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose District" tabindex="-1" aria-hidden="true" name="district_phd" id="district_phd" title="Choose District" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DISTRICT_MSG; ?>" data-parsley-errors-container="#custom-district_phd-parsley-error">
					  <option value="">Select District</option>
                  </select>
				  <span id="custom-district_phd-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
      </div>
      <div class="row">
          <div class="col-md-4" id="main_div_city" style="display:none;">
              <div class="form-group mg-b-10-force">
                  <label class="form-control-label">City<span class="tx-danger"> *</span></label>
                  <select class="form-control select2" data-placeholder="Choose City" tabindex="-1" aria-hidden="true" name="city_phd" id="city_phd" title="Choose City" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CITY_MSG; ?>" data-parsley-errors-container="#custom-city_phd-parsley-error">
                      <option value="">Select City</option>
                  </select>
				  <span id="custom-city_phd-parsley-error"></span>
              </div>
          </div><!-- col-4 -->
          <div class="col-md-4">
              <div class="form-group">
                  <label class="form-control-label">Address Line 1 <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="address_line1" id="address_line1" placeholder="Enter Address Line 1" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_ADDRESS_MSG; ?>" value="<?php if($applicant_address_details_list['add_line_1']) { echo $applicant_address_details_list['add_line_1'];} ?>" data-parsley-maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH; ?>" maxlength="<?php echo APLCT_ADDRESS1_MAXLENGTH; ?>">
              </div>
          </div><!-- col-4 -->
          <div class="col-md-4">
              <div class="form-group">
                  <label class="form-control-label">Address Line 2 <!--<span class="tx-danger">*</span>--></label>
                  <input class="form-control" type="text" name="address_line2" id="address_line2" placeholder="Enter Address Line 2" value="<?php if($applicant_address_details_list['add_line_2']) {echo $applicant_address_details_list['add_line_2'];} ?>" data-parsley-maxlength="<?php echo APLCT_ADDRESS2_MAXLENGTH; ?>" maxlength="<?php echo APLCT_ADDRESS2_MAXLENGTH; ?>">
              </div>
          </div><!-- col-4 -->		
          <div class="col-md-4">
              <div class="form-group">
                  <label class="form-control-label">Pincode <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Pincode" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PINCODE_MSG; ?>" value="<?php if($applicant_address_details_list['pin_code']) {echo $applicant_address_details_list['pin_code'];} ?>" data-parsley-maxlength="<?php echo APLCT_PINCODE_MAXLENGTH; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_PINCODE_MSG; ?>" data-parsley-pincodeonly="true" maxlength="<?php echo APLCT_PINCODE_MAXLENGTH; ?>">
              </div>
          </div><!-- col-4 -->		  
      </div>
      <div class="row">	  


      </div><!-- row -->
      
   </fieldset>
   <h3 class="wizard_head_tag">Academic Detail</h3>
   <fieldset id="academic_detail">
      <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
          <div class="card ">
              <div class="card-header p-0 " role="tab" id="headingOne">
                  <h6 class="p-2 ml-3">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed" id="academic_accordion">

                          <i class="fas fa-info-circle"></i>
                          Instructions</a>
                  </h6>
              </div><!-- card-header -->
              <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                  <!-- <div class="card-body" style="font-size: 13px;">Important: 2 years of PG/Diploma is mandatory.</div> -->
                  <div class="card-body" style="font-size: 13px;"><?php echo $applicant_academic_wizard_instructions; ?></div>
              </div>
          </div>

          <!-- card -->
      </div>
          <h5><?php echo PHD_ABG; ?></h5>
		<div class="table-responsive">  
          <table class="table table-striped table-bordered ghhfdgd" id="table4">
              <thead class="thead-light">
                  <tr>
                      <th>
                      </th>
                      <th> Degree/ Diploma</th>
                      <th> Institute/University</th>
                      <th> Major Discipline </th>
                      <th> Marking Scheme </th>
                      <th> Obtained Percentage/CGPA</th>
                      <th> Year of Passing </th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>
                          <p>1</p>
                      </td>
                      <td>
                          <input class="form-control" type="hidden" placeholder="" id="grad_id_1" name="grad_id_1" value="<?php echo $applicant_grad_det_id[0]; ?>">
                          <input class="form-control" type="text" placeholder="" id="degree_diploma_1" name="degree_diploma_1" maxlength="<?php echo APLCT_DEGREE_MAXLENGTH; ?>" value="<?php echo $applicant_grad_det_other_degree_name[0]; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_DEGREE_NAME_MSG;?>">
                      </td>
                      <td>
                          <div class="form-group mg-b-10-force">
                              <select class="form-control custom-select" id="institute_university_1" name="institute_university_1" data-placeholder="Choose Institute/University" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_INSTITUTE_UNIV_MSG;?>" data-parsley-errors-container="#custom-institute_university_1-parsley-error"></select>
							  <span id="custom-institute_university_1-parsley-error"></span>
						 </div>
                      </td>
                      <td>
                          <input class="form-control" type="text" placeholder="" id="major_discipline_1" name="major_discipline_1" maxlength="<?php echo APLCT_MAJOR_DISPLICINE_MAXLENGTH; ?>" value="<?php echo $major_discipline_1; ?>" data-parsley-required="true"  data-parsley-required-message="<?php echo REQD_MAJOR_DISCIPLINE_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo ALPHA_MAJOR_DISCIPLINE_MSG; ?>">
                      </td>
                      <td>
                          <div class="form-group mg-b-10-force">
                              <select class="form-control custom-select" id="user_marking_scheme_1" name="user_marking_scheme_1" data-parsley-errors-container="#custom-user_marking_scheme_1-parsley-error" data-parsley-required="true"  data-parsley-required-message="<?php echo REQD_MARK_SCHEME_MSG; ?>"></select>
							  <span id="custom-user_marking_scheme_1-parsley-error"></span>
                          </div>
                      </td>

                      <td>
                          <input class="form-control" type="text" name="obtained_percentage_cgpa_1" id="obtained_percentage_cgpa_1"  data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG; ?>"  data-parsley-type-message="<?php echo VALID_PERCENT_CGPA_MSG; ?>" min="<?php echo APLCT_MARK_MINLENGTH; ?>" max="<?php echo APLCT_MARK_MAXLENGTH; ?>" data-parsley-trigger="keyup" data-parsley-type="number" value="<?php echo $applicant_grad_det_mark_percent[0]; ?>" maxlength="<?php echo CGPA_MAXLENGTH; ?>">
                      </td>
                      <td>
                          <input class="form-control" type="text" placeholder="YYYY" id="year_of_passing_1" name="year_of_passing_1" maxlength="<?php echo APLCT_YEAR_OF_PASSING_MAXLENGTH; ?>" value="<?php echo $applicant_grad_det_completion_year[0]; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_YEAR_APPEAR_MSG; ?>">
                      </td>

                  </tr>
                  <tr>
                      <td>
                          <p>2</p>
                      </td>
                      <td>
                           <input class="form-control" type="hidden" placeholder="" id="grad_id_2" name="grad_id_2" value="<?php echo $applicant_grad_det_id[1]; ?>">
                           <input class="form-control" type="text" placeholder="" id="degree_diploma_2" name="degree_diploma_2" maxlength="<?php echo APLCT_DEGREE_MAXLENGTH; ?>" value="<?php echo $applicant_grad_det_other_degree_name[1]; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_DEGREE_NAME_MSG; ?>">
                      </td>
                      <td>
                          <div class="form-group mg-b-10-force">
                              <select class="form-control custom-select" id="institute_university_2" name="institute_university_2" data-placeholder="Choose Institute/University" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_INSTITUTE_UNIV_MSG; ?>" data-parsley-errors-container="#custom-institute_university_2-parsley-error"></select>
							  <span id="custom-institute_university_2-parsley-error"></span>
                          </div>
                      </td>
                      <td>
                          <input class="form-control" type="text" placeholder="" id="major_discipline_2" name="major_discipline_2" maxlength="<?php echo APLCT_MAJOR_DISPLICINE_MAXLENGTH; ?>" value="<?php echo $major_discipline_2; ?>" data-parsley-required-message="<?php echo REQD_MAJOR_DISCIPLINE_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo ALPHA_MAJOR_DISCIPLINE_MSG; ?>">
                      </td>
                      <td>
                          <div class="form-group mg-b-10-force">
                              <select class="form-control custom-select" id="user_marking_scheme_2" name="user_marking_scheme_2" data-parsley-errors-container="#custom-user_marking_scheme_2-parsley-error" data-parsley-required="false"  data-parsley-required-message="<?php echo REQD_MARK_SCHEME_MSG; ?>"></select>
							  <span id="custom-user_marking_scheme_2-parsley-error"></span>
                          </div>
                      </td>

                      <td>
                          <input class="form-control" type="text" placeholder="" id="obtained_percentage_cgpa_2" name="obtained_percentage_cgpa_2" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG; ?>"  data-parsley-type-message="<?php echo VALID_PERCENT_CGPA_MSG; ?>" min="<?php echo APLCT_MARK_MINLENGTH; ?>" max="<?php echo APLCT_MARK_MAXLENGTH; ?>" data-parsley-trigger="keyup" data-parsley-type="number" value="<?php echo $applicant_grad_det_mark_percent[1]; ?>" maxlength="<?php echo CGPA_MAXLENGTH; ?>">
                      </td>
                      <td>
                          <input class="form-control" type="text" placeholder="YYYY" id="year_of_passing_2" name="year_of_passing_2" maxlength="<?php echo APLCT_YEAR_OF_PASSING_MAXLENGTH; ?>" value="<?php echo $applicant_grad_det_completion_year[1]; ?>" data-parsley-required-message="<?php echo REQD_YEAR_OF_PASSING_MSG; ?>">
                      </td>

                  </tr>
                  <tr>
                      <td>
                          <p>3</p>
                      </td>
                      <td>
                           <input class="form-control keyup" type="hidden" placeholder="" id="grad_id_3" name="grad_id_3" value="<?php echo $applicant_grad_det_id[2]; ?>">
                           <input class="form-control" type="text" placeholder="" id="degree_diploma_3" name="degree_diploma_3" maxlength="<?php echo APLCT_DEGREE_MAXLENGTH; ?>" value="<?php echo $applicant_grad_det_other_degree_name[2]; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_DEGREE_NAME_MSG; ?>">
                      </td>
                      <td>
                          <div class="form-group mg-b-10-force">
                              <select class="form-control custom-select keyup" id="institute_university_3" name="institute_university_3" data-placeholder="Choose Institute/University" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_INSTITUTE_UNIV_MSG; ?>" data-parsley-errors-container="#custom-institute_university_3-parsley-error"></select>
							  <span id="custom-institute_university_3-parsley-error"></span>
                          </div>
						  
                      </td>
                      <td>
                          <input class="form-control keyup" type="text" placeholder="" id="major_discipline_3" name="major_discipline_3" maxlength="<?php echo APLCT_MAJOR_DISPLICINE_MAXLENGTH; ?>" value="<?php echo $major_discipline_3; ?>" data-parsley-required-message="<?php echo REQD_MAJOR_DISCIPLINE_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo ALPHA_MAJOR_DISCIPLINE_MSG; ?>">
                      </td>
                      <td>
                          <div class="form-group mg-b-10-force">
                              <select class="form-control custom-select keyup" id="user_marking_scheme_3" name="user_marking_scheme_3" data-parsley-required="false" data-parsley-errors-container="#custom-user_marking_scheme_3-parsley-error" data-parsley-required="false"  data-parsley-required-message="<?php echo REQD_MARK_SCHEME_MSG; ?>"></select>
							  <span id="custom-user_marking_scheme_3-parsley-error"></span>
                          </div>
						  
                      </td>

                      <td>
                          <input class="form-control keyup" type="text" placeholder="" id="obtained_percentage_cgpa_3" name="obtained_percentage_cgpa_3" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_PERCENT_CGPA_MSG; ?>"  data-parsley-type-message="<?php echo VALID_PERCENT_CGPA_MSG; ?>" min="<?php echo APLCT_MARK_MINLENGTH; ?>" max="<?php echo APLCT_MARK_MAXLENGTH; ?>" data-parsley-trigger="keyup" data-parsley-type="number" value="<?php echo $applicant_grad_det_mark_percent[2]; ?>" maxlength="<?php echo CGPA_MAXLENGTH; ?>">
                      </td>
                      <td>
                          <input class="form-control keyup" type="text" placeholder="YYYY" id="year_of_passing_3" name="year_of_passing_3" maxlength="<?php echo APLCT_YEAR_OF_PASSING_MAXLENGTH; ?>" value="<?php echo $applicant_grad_det_completion_year[2]; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_YEAR_OF_PASSING_MSG; ?>">
                      </td>

                  </tr>
              </tbody>
          </table>
		  </div>
          <div class="w-100">
              <div class="row">

                  <div class="col-md-6">
                      <div class="form-group">
                           <label class="control-label" for="radios" >Upload
                              Your Post-Graduation Marksheet<span class="tx-danger">*</span> </label>
                           <input type="file" class="filestyle" name="post_graduation_marksheet" id="post_graduation_marksheet" data-parsley-required="<?php echo(isset($docs[$document_id_post_graduation_marksheet]))?'false':'true'; ?>" data-parsley-required-message="<?php echo REQD_PG_MARK_MSG; ?>" data-parsley-errors-container="#custom-post_graduation_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_post_graduation_marksheet])){ echo $docs[$document_id_post_graduation_marksheet]['id']; } ?>" data-parsley-trigger="change">
                           <?php if(isset($docs[$document_id_post_graduation_marksheet])){ ?>
                              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_post_graduation_marksheet; ?>">
                                 <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_post_graduation_marksheet; ?>')">&times;</a>
                                 <strong id="deleteMessageStatus_<?php echo $document_id_post_graduation_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_post_graduation_marksheet; ?>"></span>
                             </div>
                           <?php } ?>
                           <span id="custom-post_graduation_marksheet-parsley-error"></span>
                      </div>
                      
                  </div>
              </div>
          </div>          
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="control-label" for="radios" >Have you
                          taken any competitive exam? <span class="tx-danger">*</span></label>
                      <select class="form-control custom-select study" id="taken_any_competitive_exam" name="taken_any_competitive_exam" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_COMP_EXAM_MSG; ?>" onchange="check_competitive_exam(this.value, 'select_div_competitive_exam', 'upload_div_competitive_exam','taken_any_competitive_exam_info','<?php echo ((isset($docs[$document_id_score_card]))?'false':'true'); ?>')" data-parsley-errors-container="#custom-taken_any_competitive_exam-parsley-error" data-parsley-trigger="change">
                          <option value="">Select Status - Yes or No</option>
                          <option value="yes">Yes</option>
                          <option value="no">No</option>
                      </select>
                      <span id="custom-taken_any_competitive_exam-parsley-error"></span>
                      <div class="form-group" style="display: none;" id="taken_any_competitive_exam_info"><small><?php echo NO_CE_NEED_ENTRANCE; ?></small></div>
                  </div>
              </div>
              <div class="col-md-6" id="select_div_competitive_exam">
                  <div class="form-group">
                      <label class="control-label" for="radios" >Please
                          Select Competitive Examination <span class="tx-danger">*</span></label>
                      <select class="form-control custom-select study" id="competitive_exam" name="competitive_exam" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_COMP_EXAM_MSG; ?>" data-parsley-errors-container="#custom-competitive_exam-parsley-error" data-parsley-trigger="change"></select>
                      <span id="custom-competitive_exam-parsley-error"></span>
                  </div>
              </div>
          </div>
          <div class="row" id="upload_div_competitive_exam">
              <div class="col-md-6">
                  <div class="form-group">
                     <label class="control-label" for="radios" >Upload GATE/UGC/SLET/NET Score Card <span class="tx-danger">*</span> </label>
                     <?php 
                     ?>
                     <input type="file" class="filestyle" name="score_card" id="score_card" data-parsley-required="<?php echo ((isset($docs[$document_id_score_card]))?'false':'true'); ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_SCORE_CARD_MSG; ?>" data-parsley-errors-container="#custom-score_card-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_SCORE_CARD_KB; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_SCORE_CARD_KB_JS; ?>" data-parsley-max-file-size-message="This file should not be larger than <?php echo MAX_FILE_SIZE_SCORE_CARD_MB; ?> MB" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_score_card])){ echo $docs[$document_id_score_card]['id']; } ?>"  data-parsley-trigger="change">
                     <?php if(isset($docs[$document_id_score_card])){ ?>
                              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_score_card; ?>">
                                 <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_score_card; ?>')">&times;</a>
                                 <strong id="deleteMessageStatus_<?php echo $document_id_score_card; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_score_card; ?>"></span>
                             </div>
                     <?php } ?>
                       
                     <span id="custom-score_card-parsley-error"></span>
                  </div>
              </div>
          </div>
          <div class="w-100">
              <div class="row">
              
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="d-block mb-3 w-100 text-left">Do you have any Work Experience? :</label>
                      <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="is_work_experience_yes" name="is_work_experience" class="custom-control-input" <?php echo ($is_work_experience == 't')?'checked':''; ?> value="yes" onchange="is_work_experience_func(this.value)" checked>
                          <label class="custom-control-label" for="is_work_experience_yes">Yes</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="is_work_experience_no" name="is_work_experience" class="custom-control-input" <?php echo ($is_work_experience == 'f')?'checked':''; ?> value="no"  onchange="is_work_experience_func(this.value)">
                          <label class="custom-control-label" for="is_work_experience_no">No</label>
                      </div>
                  </div>
              </div>
                  
              
              </div>
          </div>
         <div class="row" id="emp_dtl" style="display: none;">
            <div class="col-md-4">
               <div class="form-group">
                  <label class="control-label" for="radios">Name of Employee <span class="tx-danger">*</span></label>
                  <input type="text" name="name_of_employee" id="name_of_employee" class="form-control" placeholder="Enter Name" maxlength="<?php echo APLCT_EMPLOYEE_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_EMP_NAME_MSG; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-trigger="change" value="<?php echo $nameofemployee; ?>">
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label class="control-label" for="radios">Address Of Employee <span class="tx-danger">*</span></label>
                  <input type="text" name="address_of_employee" id="address_of_employee" class="form-control" placeholder="Enter Address" maxlength="<?php echo APLCT_EMPLOYEE_ADDRESS_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_EMP_ADDRESS_MSG; ?>" data-parsley-trigger="change" value="<?php echo $addressofemployee; ?>">
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label class="control-label" for="radios">Salary received /Month <span class="tx-danger">*</span></label>
                  <input type="text" name="salary_per_month" id="salary_per_month" class="form-control" placeholder="Enter salary per month" maxlength="<?php echo APLCT_SALARY_PER_MONTH_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_SALARY_PER_MONTH_MSG; ?>" data-parsley-trigger="change" value="<?php echo $salaryreceived; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_DIGITS_ONLY_MSG;?>" >
               </div>
            </div>
         </div>
         <div class="row" id="emp_exp" style="display: none;">
            <div class="col-md-12">
               <div class="form-group">
                  <label class="control-label" for="radios">Professional Experience (Start from the present employer)</label>
                  <div class="table-responsive pretbl">
                     <table class="table table-striped table-bordered" id="table5">
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
                                 <div class="form-group"><input type="text" name="organisation_name_0" id="organisation_name_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_ORGANISATION_NAME_MAXLENGTH; ?>"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_ORG_NAME_MSG;?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_org_name[0]; ?>"></div>
                                 <span class="tx-danger required_asterisk">*</span>
                              </td>
                              <td>
                                 <div class="form-group"><input type="text" name="designation_0" id="designation_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_DESIGNATION_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_DESIGNATION_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_designation[0]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>"></div>
                                 <span class="tx-danger required_asterisk">*</span>
                              </td>
                              <td>
                                 <div class="form-group"><input type="text" name="nature_of_job_0" id="nature_of_job_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_JOB_NATURE_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_NATURE_JOB_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_job_nature[0]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>"></div>
                                 <span class="tx-danger required_asterisk">*</span>
                              </td>
                              <td>
                                 <div class="form-group"><input type="text" name="total_salary_month_0" id="total_salary_month_0" class="form-control" placeholder="" maxlength="<?php echo APLCT_SALARY_PER_MONTH_MAXLENGTH; ?>"data-parsley-required="false" data-parsley-required-message="<?php echo REQD_TOTAL_SALARY_MONTH_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_salary[0]; ?>" data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_DIGITS_ONLY_MSG;?>"></div>
                                 <span class="tx-danger required_asterisk">*</span>
                              </td>
                              <td>
                                 <div class="form-group"><input readonly="" type="text" name="from_year_0" id="from_year_0" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_FROM_YEAR_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_FROM_YEAR_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_from_date[0]; ?>"></div>
                                 <span class="tx-danger required_asterisk">*</span>
                              </td>
                              <td>
                                 <div class="form-group"><input readonly="" type="text" name="to_year_0" id="to_year_0" class="form-control datepicker" placeholder="MM/YYYY" maxlength="<?php echo APLCT_TO_YEAR_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_TO_YEAR_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_to_date[0]; ?>"></div>
                                 <span class="tx-danger required_asterisk">*</span>
                              </td>
                              <td>
                                 <div class="form-group"><input type="text" name="work_experience_0" id="work_experience_0" class="form-control" placeholder="" readonly="readonly" maxlength="<?php echo APLCT_TOT_WORK_EXP_MAXLENGTH; ?>" data-parsley-required="false" data-parsley-required-message="<?php echo REQD_WORK_EXP_MSG; ?>" data-parsley-trigger="change" value="<?php echo $applicant_prof_exp_work_exp_in_months[0]; ?>"></div>
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
                                 <div class="form-group"><input type="text" name="total_salary_month_1" id="total_salary_month_1" class="form-control" placeholder="" maxlength="<?php echo APLCT_SALARY_PER_MONTH_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_salary[1]; ?>"data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_DIGITS_ONLY_MSG;?>" ></div>
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
                                 <div class="form-group"><input type="text" name="organisation_name_2" id="organisation_name_2" class="form-control" placeholder="" maxlength="<?php echo APLCT_ORGANISATION_NAME_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_org_name[2]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>"></div>
                              </td>
                              <td>
                                 <div class="form-group"><input type="text" name="designation_2" id="designation_2" class="form-control" placeholder="" maxlength="<?php echo APLCT_DESIGNATION_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_designation[2]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_DESIGN_ALPHA_MSG; ?>"></div>
                              </td>
                              <td>
                                 <div class="form-group"><input type="text" name="nature_of_job_2" id="nature_of_job_2" class="form-control" placeholder="" maxlength="<?php echo APLCT_JOB_NATURE_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_job_nature[2]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_NATURE_ALPHA_MSG; ?>"></div>
                              </td>
                              <td>
                                 <div class="form-group"><input type="text" name="total_salary_month_2" id="total_salary_month_2" class="form-control" placeholder="" maxlength="<?php echo APLCT_SALARY_PER_MONTH_MAXLENGTH; ?>" value="<?php echo $applicant_prof_exp_salary[2]; ?>"data-parsley-type="digits" data-parsley-type-message="<?php echo VALID_DIGITS_ONLY_MSG;?>"></div>
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
                  </div>
               </div>
            </div>
         </div>
         <div class="row" id="emp_total_exp" style="display: none;">
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
                  <input type="text" name="total_work_experience" id="total_work_experience" class="form-control" placeholder="Total Work Experience" readonly="readonly" maxlength="<?php echo APLCT_TOT_WORK_EXP_MAXLENGTH; ?>" value="<?php echo $total_applicant_prof_exp_work_exp_in_months; ?>">
               </div>
            </div>
         </div>
          <h5>Publications, if any (Books I ResearchPapers) :</h5>
		<div class="table-responsive">  		  
          <table class="table table-striped table-bordered mt-5" id="table4">
              <thead class="thead-light">
                  <tr>
                      <th></th>
                      <th>Title</th>
                      <th>Name of the Journal / Conference I Published in the case books</th>
                      <th>Year</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>
                          <p>1</p>
                      </td>
                      <td>
                           <input class="form-control" type="hidden" placeholder="" id="publn_det_id_0" name="publn_det_id_0" value="<?php echo $applicant_publn_det_id[0]; ?>">
                          <input class="form-control" type="text" name="publications_title_0" id="publications_title_0" placeholder="" maxlength="<?php echo APLCT_PUBLICATION_TITLE_MAXLENGTH; ?>" value="<?php echo $applicant_publn_det_title[0]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_PUBLICATION_ALPHA_MSG;?>">
                      </td>
                      <td>
                          <input class="form-control" type="text" name="publications_name_of_the_journal_0" id="publications_name_of_the_journal_0" placeholder="" maxlength="<?php echo APLCT_PUBLICATION_JOURNAL_MAXLENGTH; ?>" value="<?php echo $applicant_publn_det_journal_conf_name[0]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_JOURNAL_ALPHA_MSG; ?>">
                      </td>
                      <td>
                          <input class="form-control" type="text" name="publications_year_0" id="publications_year_0" placeholder="YYYY" maxlength="<?php echo APLCT_PUBLICATION_YEAR_MAXLENGTH; ?>" value="<?php echo $applicant_publn_det_year[0]; ?>">
                      </td>
                  </tr>
                  <tr>
                      <td>
                          <p>2</p>
                      </td>
                      <td>
                           <input class="form-control" type="hidden" placeholder="" id="publn_det_id_1" name="publn_det_id_1" value="<?php echo $applicant_publn_det_id[1]; ?>">
                          <input class="form-control" type="text" name="publications_title_1" id="publications_title_1" placeholder="" maxlength="<?php echo APLCT_PUBLICATION_TITLE_MAXLENGTH; ?>" value="<?php echo $applicant_publn_det_title[1]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_PUBLICATION_ALPHA_MSG; ?>">
                      </td>
                      <td>
                          <input class="form-control" type="text" name="publications_name_of_the_journal_1" id="publications_name_of_the_journal_1" placeholder="" maxlength="<?php echo APLCT_PUBLICATION_JOURNAL_MAXLENGTH; ?>" value="<?php echo $applicant_publn_det_journal_conf_name[1]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_JOURNAL_ALPHA_MSG; ?>">
                      </td>
                      <td>
                          <input class="form-control" type="text" name="publications_year_1" id="publications_year_1" placeholder="YYYY" maxlength="<?php echo APLCT_PUBLICATION_YEAR_MAXLENGTH; ?>" value="<?php echo $applicant_publn_det_year[1]; ?>">
                      </td>
                  </tr>
                  <tr>
                      <td>
                          <p>3</p>
                      </td>
                      <td>
                           <input class="form-control" type="hidden" placeholder="" id="publn_det_id_2" name="publn_det_id_2" value="<?php echo $applicant_publn_det_id[2]; ?>">
                          <input class="form-control" type="text" name="publications_title_2" id="publications_title_2" placeholder="" maxlength="<?php echo APLCT_PUBLICATION_TITLE_MAXLENGTH; ?>" value="<?php echo $applicant_publn_det_title[2]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_PUBLICATION_ALPHA_MSG;?>">
                      </td>
                      <td>
                          <input class="form-control" type="text" name="publications_name_of_the_journal_2" id="publications_name_of_the_journal_2" placeholder="" maxlength="<?php echo APLCT_PUBLICATION_JOURNAL_MAXLENGTH; ?>" value="<?php echo $applicant_publn_det_journal_conf_name[2]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_JOURNAL_ALPHA_MSG; ?>">
                      </td>
                      <td>
                          <input class="form-control" type="text" name="publications_year_2" id="publications_year_2" placeholder="YYYY" maxlength="<?php echo APLCT_PUBLICATION_YEAR_MAXLENGTH; ?>" value="<?php echo $applicant_publn_det_year[2]; ?>">
                      </td>
                  </tr>
                  <tr>
                      <td>
                          <p>4</p>
                      </td>
                      <td>
                           <input class="form-control" type="hidden" placeholder="" id="publn_det_id_3" name="publn_det_id_3" value="<?php echo $applicant_publn_det_id[3]; ?>">
                          <input class="form-control" type="text" name="publications_title_3" id="publications_title_3" placeholder="" maxlength="<?php echo APLCT_PUBLICATION_TITLE_MAXLENGTH; ?>" value="<?php echo $applicant_publn_det_title[3]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_PUBLICATION_ALPHA_MSG; ?>">
                      </td>
                      <td>
                          <input class="form-control" type="text" name="publications_name_of_the_journal_3" id="publications_name_of_the_journal_3" placeholder="" maxlength="<?php echo APLCT_PUBLICATION_JOURNAL_MAXLENGTH; ?>" value="<?php echo $applicant_publn_det_journal_conf_name[3]; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo REQD_JOURNAL_ALPHA_MSG; ?>">
                      </td>
                      <td>
                          <input class="form-control" type="text" name="publications_year_3" id="publications_year_3" placeholder="YYYY" maxlength="<?php echo APLCT_PUBLICATION_YEAR_MAXLENGTH; ?>" value="<?php echo $applicant_publn_det_year[3]; ?>">
                      </td>
                  </tr>

              </tbody>
          </table>
		</div>
          <div class="w-100">
              <div class="row">
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label class="form-control-label">Major Area of Ph.D. Research</label>
                          <input class="form-control" type="text" name="phd_major" id="phd_major" placeholder="Enter Your Detail" maxlength="<?php echo APLCT_MAJOR_AREA_MAXLENGTH; ?>" value="<?php echo $research_area; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo VALID_ALPHA_ONLY_MSG;?>.">
                      </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-6">
                      <div class="form-group">
                          <label class="form-control-label">Tentative Topic </label>
                          <input class="form-control" type="text" name="tentative_topic_name" id="tentative_topic_name" placeholder="Enter Topic Name" maxlength="<?php echo APLCT_TENTATIVE_TOPIC_MAXLENGTH; ?>" value="<?php echo $tentative_topic; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo VALID_ALPHA_ONLY_MSG;?>.">
                      </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-6">
                      <div class="form-group">
                        <label class="control-label text-left" >Tentative topic, if identified for research (Attach one-page write up on the topic identified) </label>
                        <input type="file" class="filestyle" name="tentative_topic_files[]" id="tentative_topic_files" multiple  data-parsley-validate-if-empty="true" data-parsley-required-message="<?php echo REQD_TENTATIVE_TOPIC_MSG; ?>" data-parsley-errors-container="#custom-tentative_topic_files-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_500_KB; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_500_KB_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-no-of-files="<?php echo MAX_FILE_FOR_TENTATIVE_TOPIC; ?>" data-parsley-no-of-files-message="Max allowed files only: <?php echo MAX_FILE_FOR_TENTATIVE_TOPIC; ?>" onchange="upload_file(this.id, 2)" data-file-id="<?php if(isset($docs[$document_id_tentative_topic])){ echo implode(',',array_column($docs[$document_id_tentative_topic], 'id')); } ?>"  data-parsley-trigger="change" data-file-count="<?php echo ($docs['file_count'])?$docs['file_count']:0; ?>">
                        
                        <?php if(isset($docs[$document_id_tentative_topic])){ ?>
                           <?php foreach($docs[$document_id_tentative_topic] as $k=>$v) { ?>
                              <span class='file_name  mt-3' ><a href="<?php echo base_url().$v['file_path'];?>" target="_blank" title="<?php echo $v['file_name_user']; ?>"><?php echo $v['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                              <a href="javascript:void(0)" data-del-file-id="<?php if(isset($v)){ echo $v['id']; } ?>" data-doc-id="<?php echo $document_id_tentative_topic; ?>" data-toggle="modal" data-target="#contentDeletePop" data-field="tentative_topic_files" data-required="false" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              <div style="display:none" class="alert col-sm-12 alert-success appendh" id="deleteMessage_<?php echo $document_id_tentative_topic.$v['id']; ?>">
                                 <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_tentative_topic.$v['id']; ?>')">&times;</a>
                                 <strong id="deleteMessageStatus_<?php echo $document_id_tentative_topic.$v['id']; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_tentative_topic.$v['id']; ?>"></span>
                             </div>
                           <?php } ?>
                        <?php } ?>
                        <span id="custom-tentative_topic_files-parsley-error"></span>
                      </div>
                  </div>

              </div>
          </div>

          <div class="w-100">
              <div class="row">

                  <div class="col-lg-12">
                      <div class="form-group">
                          <label class="form-control-label text-left"><?php echo RESEARCH_SV_AVAILABLE; ?> <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="choice_supervisor" id="choice_supervisor" placeholder="Enter Detail" maxlength="<?php echo APLCT_SUPERVISOR_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHOICE_SUPERVISOR_MSG;?>" data-parsley-trigger="change" value="<?php echo $choiceofprefofsupervisor; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo VALID_ALPHA_ONLY_MSG;?>.">
                      </div>
                  </div><!-- col-4 -->

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
                      <p class="card-subtitle">Application Fee <span class="float-right"><?php echo $appln_form_fee; ?></span>
                      </p>
                  </div>
              </div><!-- card -->

          </div>
			<div class="col-lg-6">
              <div class="card mb-3 base_details_card">
                  <div class="card-body">
                      <h5 class="card-title card_title">Payment Details</h5>
                      <div class="row">
                      	<div class="col-lg-2">
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="online" name="payment_mode" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PAYMENT_MODE_MSG; ?>" data-parsley-errors-container="#custom-payment_mode-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($payment_mode_id == PAYMENT_MODE_ONLINE_ID)?'checked':''; ?>>
                            <label class="custom-control-label" for="online">Online</label>
                          </div>
                      	</div>
                      	<div class="col-lg-2">
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="dd" name="payment_mode" class="custom-control-input"  data-parsley-required="true" data-parsley-required-message="<?php echo REQD_PAYMENT_MODE_MSG; ?>" data-parsley-errors-container="#custom-payment_mode-parsley-error" data-parsley-trigger="change" value="1" <?php echo ($payment_mode_id == PAYMENT_MODE_DEMAND_DRAFT_ID)?'checked':''; ?>>
                            <label class="custom-control-label" for="dd">DD</label>
                          </div>
                      	</div>
                      </div>
					  <span id="custom-payment_mode-parsley-error"></span>
                      <p class="card-subtitle mb-3 mt-3">Sub Total <span class="float-right"><?php echo $appln_form_fee; ?></span>
                      </p>
                      <p class="card-subtitle">Total<span class="float-right"><?php echo $appln_form_fee; ?></span>
                      </p>
                      <div id="payment_details" style="display: none;">

                          <div class="mt-3">
                              <div class="row">
                                  <div class="col-md-6">
                                      <select class="form-control select2" name="BankName" id="BankName" title="Choose Bank Name" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_CHOOSE_BANK_MSG; ?>" data-parsley-errors-container="#custom-BankName-parsley-error">
                                        <option value=""  selected="selected">Select Bank Name</option>
                                      </select>
                                      <span id="custom-BankName-parsley-error"></span>
                                  </div>
                                  <div class="col-md-6">
                                      <input class="form-control" type="text" name="BranchName" placeholder="Branch Name" id="BranchName" data-parsley-required="true" data-parsley-required-message="<?php echo REQD_BANK_NAME_MSG; ?>" maxlength="<?php echo APLCT_BRANCH_NAME_MAXLENGTH; ?>" value="<?php echo $branch_name; ?>" data-parsley-nameonly="true" data-parsley-nameonly-message="<?php echo VALID_BANK_NAME_MSG; ?>">
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

              <div id="collapseOne7" class="collapse bg-light show" role="tabpanel" aria-labelledby="headingOne" style="">
                  <div class="card-body" style="font-size: 13px;"><?php echo $applicant_declaration_wizard_instructions; ?></div>
              </div>
          </div>

          <!-- card -->
      </div>
      <div class="col-md-12">
          <div class="form-layout">
              <div class="row mg-b-25 mt-3">
				  <p><?php echo DECLARATION_PHD; ?></p>			  
                  <div class="row w-100">
                     <?php
                    
                     ?>
                     <div class="col-lg-6">
                       <label class="form-control-label">Applicant Name<span class="tx-danger"> *</span></label>
                        <div class="form-group">
                           <input class="form-control" type="text" name="applicant_name" id="applicant_name" placeholder="Applicant Name" value="<?php echo $applicant_name_declaration; ?>"  maxlength="<?php echo APLCT_DECLR_NAME_MAXLENGTH; ?>" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="<?php echo REQD_APPLT_NAME_MSG; ?>" data-parsley-nameonly-message="<?php echo REQD_ALPHA_NAME_ONLY_MSG;?>" data-parsley-length="[<?php echo APLCT_DECLR_NAME_MINLENGTH; ?>, <?php echo APLCT_DECLR_NAME_MAXLENGTH; ?>]">
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-6">
                      <label class="form-control-label">Date <span class="tx-danger">*</span></label>
                        <div class="form-group">

                           <input class="form-control" type="text" name="date_dec" id="date_dec" placeholder="Parent Name" value="<?php if(isset($ddate)){echo $ddate;}else{echo date('d-m-Y');} ?>" readonly>
                        </div>
                     </div>
                     <!-- col-4 -->
                  </div>
              </div><!-- row -->
          </div>
      </div>

   </fieldset>
   
 <h3 class="wizard_head_tag">Upload</h3>
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
                     <?php
                     
                     ?>
                     <!-- col-4 -->
                      <div class="form-group col-md-6 ">
                           <label for="exampleFormControlTextarea1">Upload Your Recent Passport Size Photograph <span class="tx-danger">*</span></label>
                           <input type="file" class="filestyle" name="photograph" id="photograph" data-parsley-required="<?php echo ((isset($docs[$document_id_photograph]))?'false':'true'); ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_PHOTO_MSG;?>" data-parsley-errors-container="#custom-photograph-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>"accept="<?php  echo allow_extension($file_allowed_type); ?>">
                           <?php if(isset($docs[$document_id_photograph])){ ?>
                              <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_photograph; ?>">
                                 <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_photograph; ?>')">&times;</a>
                                 <strong id="deleteMessageStatus_<?php echo $document_id_photograph; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_photograph; ?>"></span>
                             </div>
                           <?php } ?>
                           <span id="custom-photograph-parsley-error"></span>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Signature <span class="tx-danger">*</span></label>

                           <input type="file" class="filestyle" name="signature" id="signature" data-parsley-required="<?php echo ((isset($docs[$document_id_signature]))?'false':'true'); ?>" data-parsley-required-message="<?php echo REQD_UPLOAD_SIGN_MSG; ?>" data-parsley-errors-container="#custom-signature-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
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
                          <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Aadhar card</label>

                           <input type="file" class="filestyle" name="aadhar_card" id="aadhar_card" data-parsley-required="false" data-required="false"  data-parsley-required-message="<?php echo REQD_UPLOAD_AADHAR_CARD_MSG; ?>" data-parsley-errors-container="#custom-aadhar_card-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_500_KB; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_500_KB_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>"  onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_aadhar_card])){ echo $docs[$document_id_aadhar_card]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                           <?php if(isset($docs[$document_id_aadhar_card])){ ?>
                                 <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_aadhar_card; ?>">
                                    <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_aadhar_card; ?>')">&times;</a>
                                    <strong id="deleteMessageStatus_<?php echo $document_id_aadhar_card; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_aadhar_card; ?>"></span>
                                </div>
                           <?php } ?>
                           <span id="custom-aadhar_card-parsley-error"></span>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="exampleFormControlTextarea1">Additional Qualification, if any</label>

                           <input type="file" class="filestyle" name="additional_qualification" id="additional_qualification" data-parsley-required="false" data-required="false" data-parsley-required-message="<?php echo REQD_UPLOAD_ADD_QUALIFY_MSG; ?>" data-parsley-errors-container="#custom-additional_qualification-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_500_KB; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_500_KB_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_additional_qualification])){ echo $docs[$document_id_additional_qualification]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                           <?php if(isset($docs[$document_id_additional_qualification])){ ?>
                                 <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_additional_qualification; ?>">
                                    <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_additional_qualification; ?>')">&times;</a>
                                    <strong id="deleteMessageStatus_<?php echo $document_id_additional_qualification; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_additional_qualification; ?>"></span>
                                </div>
                           <?php } ?>
                           <span id="custom-additional_qualification-parsley-error"></span>
                      </div>
                  </div>
              </div><!-- row -->
          </div>
      </div>

   </fieldset>   
<?php form_close(); ?><!-- form -->