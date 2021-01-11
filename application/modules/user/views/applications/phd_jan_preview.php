<?php
   $tittle_name = !empty($applicant_basic_details_list['tittle_name']) ? $applicant_basic_details_list['tittle_name'] : 'Select';
   $applicant_mob_country_code_name = isset($applicant_basic_details_list['applicant_mob_country_code_name']) ? $applicant_basic_details_list['applicant_mob_country_code_name'] : '';
   $blood_group = !empty($applicant_basic_details_list['blood_group']) ? $applicant_basic_details_list['blood_group'] : 'Select';
   $gender = !empty($applicant_basic_details_list['gender']) ? $applicant_basic_details_list['gender']: 'Select';
   $nationality = !empty($applicant_basic_details_list['nationality']) ? $applicant_basic_details_list['nationality']: 'Select Nationality';
   $social_status = !empty($applicant_basic_details_list['social_status']) ? $applicant_basic_details_list['social_status']: 'Select Your Social Status';
   $nation_id = isset($applicant_basic_details_list['nation_id']) ? $applicant_basic_details_list['nation_id']: '';
   $dif_abled = !empty($applicant_basic_details_list['dif_abled']) ? ucfirst($applicant_basic_details_list['dif_abled']) : 'Select - Yes/No';
   if($dif_abled=='T' || $dif_abled=='t'){
   $dif_abled="Yes";
   }elseif($dif_abled=='F' || $dif_abled=='f'){
   $dif_abled="No";
   }
   $deformity_type = !empty($applicant_basic_details_list['deformity_type']) ? ucfirst($applicant_basic_details_list['deformity_type']) : 'Select - Deformity';
   $deformity_percentage = !empty($applicant_basic_details_list['deformity_percentage']."0%") ? $applicant_basic_details_list['deformity_percentage']."0%" : 'Select - Deformity Percentage';
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
   
   $deg_name = $applicant_graduations_list[0]['deg_name'];
   $spec_name = $applicant_graduations_list[0]['spec_name'];
   $dpt_name = $applicant_graduations_list[0]['dpt_name'];
   $fac_name = $applicant_graduations_list[0]['fac_name'];
   $emp_cat_name  = $applicant_graduations_list[0]['emp_cat_name'];
   $is_emp = $applicant_graduations_list[0]['is_emp'];
   $work_place = $applicant_graduations_list[0]['work_place'];
   if($work_place=='257'){
   	$work_place_name='Industry';
   }
   if($work_place=='260'){
   	$work_place_name='Others';
   }	
   if($work_place=='259'){
   	$work_place_name='Organization';
   }	
   if($work_place=='258'){
   	$work_place_name='College';
   } 
   if($is_emp=="t"){
   	$is_emp_name = "Yes";
   }else{
   	$is_emp_name = "No";
   }
   
   $other_working_place = $applicant_graduations_list[0]['other_work_place'];
   $other_deg_name = $applicant_graduations_list[0]['other_deg_name'];
   $other_spec_name = $applicant_graduations_list[0]['other_spec_name'];
   $other_dpt_name = $applicant_graduations_list[0]['other_dpt_name'];
   $other_fac_name = $applicant_graduations_list[0]['other_work_place'];
   
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
   if($is_competitive_exam=='t'){
   	$is_competitive_exam_name="Yes";
   }else{
   	$is_competitive_exam_name="No";
   }
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
   
   $univ_name_1  = $applicant_grad_det_univ_name[0];
   $univ_name2 = $applicant_grad_det_univ_name[1];
   $univ_name3 = $applicant_grad_det_univ_name[2];
   
   $mark_scheme_name  = $applicant_grad_det_mark_scheme[0];
   $mark_scheme_name2 = $applicant_grad_det_mark_scheme[1];
   $mark_scheme_name3 = $applicant_grad_det_mark_scheme[2];
   
   // Declaration Show
   $applicant_name_declaration = $applicant_appln_details_list['applicant_name_declaration'];
   $applicant_name_declaration = ($applicant_name_declaration)?$applicant_name_declaration:$first_name;
   
   $ddate = $applicant_appln_details_list['applicant_declaration_date'];
   $ddate = ($ddate)?date('d/m/Y',strtotime($ddate)):date('d/m/Y');
   $appln_form_fee = $applicant_appln_details_list['appln_form_fee'];

  /* Payment Details Start */
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
   
   // Address
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
   $add_line_1 = isset($applicant_address_details_list['add_line_1']) ? $applicant_address_details_list['add_line_1'] : '';
   $add_line_2 = isset($applicant_address_details_list['add_line_2']) ? $applicant_address_details_list['add_line_2'] : '';
   $pin_code = isset($applicant_address_details_list['pin_code']) ? $applicant_address_details_list['pin_code'] : '';
   
	/* Payment Details End */
	$startIndex = $this->input->get('startIndex', true);
	/*CRM ADMIN Edit form start*/
	$url = base_url().'phd-jan?startIndex='.$startIndex;
	if($mode_edit == ADMIN_MODE_EDIT)
	{
	  $url = base_url().'phd-jan/'.$mode_edit.'/'.$crm_applicant_login_id.'/'.$crm_applicant_personal_det_id.'?startIndex='.$startIndex;;
	}
	/*CRM ADMIN Edit form start*/ 	   
   ?>
<div class="col-md-1 ml-2">
   <a href="<?php echo $url; ?>" class="btn btn-primary active w-100 mt-3" role="button" aria-pressed="true">Back</a>
</div>
<div class="row disable-div">
   <div class="col-sm-12">
      <div class="card" id="PHDPreviewToPrint">
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
                              <div class="col-md-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Qualifying Degree <span class="tx-danger">*</span></label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Qualifying Degree" tabindex="-1" aria-hidden="true" name="qualifying_degree" id="qualifying_degree" title="Choose Qualifying Degree">
                                       <option value=""><?php echo $deg_name; ?></option>
                                    </select>
                                    <span id="custom-spec_qualifying_degree-parsley-error"></span>
                                 </div>
                                 <div class="form-group" id="other_qd" style="display:none;">
                                    <input type="text" class="form-control" name="qualifying_degree_other" id="qualifying_degree_other" placeholder="If Other, pls enter here.." maxlength="100" value="<?php echo $other_deg_name; ?>">
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Specialization In
                                    Qualifying Degree <span class="tx-danger">*</span></label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Specialization In Qualifying Degree" tabindex="-1" aria-hidden="true" name="specialization_qualifying_degree" id="specialization_qualifying_degree" title="Choose Specialization In Qualifying Degree">
                                       <option value=""><?php echo $spec_name; ?></option>
                                    </select>
                                    <span id="custom-spec_qualifying_degree-parsley-error"></span>
                                 </div>
                                 <div class="form-group" id="other_sqd" style="display:none;">
                                    <input type="text" class="form-control" name="spec_qualifying_degree_other" id="spec_qualifying_degree_other" placeholder="If Other, pls enter here.." maxlength="100" value="<?php echo $other_spec_name; ?>">
                                    <span id="custom-spec_qualifying_degree_other-parsley-error"></span>					
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Department/School/College <span class="tx-danger">*</span></label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Department / School / College" tabindex="-1" aria-hidden="true" name="working_dsc" id="working_dsc" title="Choose Department / School / College">
                                       <option value=""><?php echo $dpt_name; ?></option>
                                    </select>
                                 </div>
                                 <div class="form-group" id="other_dept" style="display:none;">
                                    <input type="text" class="form-control" name="dept_other" id="dept_other" placeholder="If Other, pls enter here.." maxlength="100" value="<?php echo $other_dpt_name; ?>">			   
                                 </div>
                              </div>
                              <!-- col-4 -->
                           </div>
                           <div class="row w-100">
                              <div class="col-md-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Faculty <span class="tx-danger">*</span></label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Faculty" tabindex="-1" aria-hidden="true" name="faculty" id="faculty" title="Choose Faculty" >
                                       <option value=""><?php echo $fac_name; ?></option>
                                    </select>
                                 </div>
                                 <div class="form-group" id="other_faculty" style="display:none;">
                                    <input type="text" class="form-control" name="faculty_other" id="faculty_other" placeholder="If Other, pls enter here.." maxlength="100" value="<?php echo $other_fac_name; ?>">			   
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Category <span class="tx-danger">*</span></label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Category" tabindex="-1" aria-hidden="true"  name="category" id="category" title="Choose Category">
                                       <option value=""><?php echo $emp_cat_name; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <?php if($is_emp=='t' || $is_emp=='f') { ?>
                              <div class="col-md-4" id="main_div_is_employed">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Are you Employed? <span class="tx-danger">*</span></label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Working Type" tabindex="-1" aria-hidden="true"  name="is_employed" id="is_employed">
                                       <option value=""><?php echo $is_emp_name; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <?php } ?>
                              <!-- col-4 -->
                           </div>
                           <?php if($is_emp=='t') { ?>
                           <div class="row w-100">
                              <div class="col-md-4" id="main_div_working_place">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Please Select Your
                                    Working Place <span class="tx-danger">*</span></label>
                                    <select class="form-control custom-select study" data-placeholder="Choose Working Place" tabindex="-1" aria-hidden="true" name="working_place" id="working_place" title="Choose Working Place">
                                       <option value=""><?php echo $work_place_name; ?></option>
                                    </select>
                                 </div>
                                 <?php if($work_place==WORKING_PLACE_OTHER){?>
                                 <div class="form-group" id="other_working_place">
                                    <input type="text" class="form-control" name="work_place_other" id="work_place_other" placeholder="If Other, pls enter here.." maxlength="100" value="<?php echo $other_working_place; ?>">
                                    <?php } ?>
                                 </div>
                              </div>
                              <!-- col-4 -->
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
                           <div class="row w-100">
                              <div class="col-md-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Title <span class="tx-danger">*</span></label>
                                    <select class="form-control custom-select study" id="pd_title" name="pd_title" tabindex="-1" aria-hidden="true" title="Choose Title" data-placeholder="Choose Title" tabindex="-1"  >
                                       <option value=""><?php echo $tittle_name; ?></option>
                                    </select>
                                    <span id="custom-spec_qualifying_degree-parsley-error"></span>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label">First Name  <span class="tx-danger"> *</span></label>
                                    <input class="form-control" type="text" name="pd_firstname" id="pd_firstname" placeholder="Enter lastname" value="<?php echo $first_name;?>">
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label">Middle Name </label>
                                    <input class="form-control" type="text" name="pd_middlename" id="pd_middlename" placeholder="Middle Name"
                                       value="<?php echo $middle_name; ?>"
                                       >
                                 </div>
                              </div>
                              <!-- col-4 -->
                           </div>
                           <div class="row w-100">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label">Last Name  <span class="tx-danger"> *</span></label>
                                    <input class="form-control" type="text" name="pd_lastname" id="pd_lastname" placeholder="LastName" value="<?php echo $last_name; ?>">
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4">
                                 <label class="form-control-label">Mobile No  <span class="tx-danger"> *</span></label>
                                 <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <span
                                       class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                       <select class="form-control form_control custom-select Mobile_number" id="phone_no_code" name="phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                          <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected><?php echo $applicant_mob_country_code_name; ?></option>
                                       </select>
                                    </span>
                                    <input type="text" name="pd_mobile_no" id="pd_mobile_no" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Mobile No" class="form-control" value="<?php echo $mobile_no; ?>">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label">Email ID  <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="pd_email" id="pd_email" value="<?php echo $email_id; ?>" placeholder="Enter email address">
                                 </div>
                              </div>
                           </div>
                           <div class="row w-100">
                              <div class="col-md-4">
                                 <div class="wd-200 w-100">
                                    <label class="form-control-label">Date of Birth <span class="tx-danger"> *</span></label>
                                    <div class="input-group">
                                       <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                       <input type="text" class="form-control hasDatepicker" name="pd_dob" id="pd_dob" placeholder="MM/DD/YYYY" value="<?php echo  $dob; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Gender  <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Gender" tabindex="-1" aria-hidden="true" name="pd_gender" id="pd_gender" title="Choose Gender" >
                                       <option value=""><?php echo $gender; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label">Alternate Email ID
                                    </label>
                                    <input class="form-control" type="email" name="pd_alt_email" id="pd_alt_email" placeholder="Alternate Email" value="<?php echo $alt_email_id; ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="row w-100">
                              <div class="col-md-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Blood Group  <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Blood Group" tabindex="-1" aria-hidden="true" name="pd_blood_group" id="pd_blood_group" title="Choose Blood Group">
                                       <option value=""><?php echo $blood_group; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Nationality <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Nationality" tabindex="-1" aria-hidden="true" name="pd_nationality" id="pd_nationality" title="Choose Nationality">
                                       <option value=""><?php echo $nationality; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <?php if($nation_id==COUNTRY_VALUE_DEFAULT){ ?>
                              <div class="col-md-4" id="main_div_social_status">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Social Status <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Social Status" tabindex="-1" aria-hidden="true" name="pd_social_status" id="pd_social_status" title="Choose Social Status" >
                                       <option value=""><?php echo $social_status; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <?php } ?>
                              <!-- col-4 -->
                           </div>
                           <div class="row w-100">
                              <div class="col-md-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Are you a differently
                                    Abled? <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Differently Abled" tabindex="-1" aria-hidden="true" name="pd_diffrently_abled" id="pd_diffrently_abled" title="Choose Differently Abled">
                                       <option value=""><?php echo $dif_abled; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <?php if($dif_abled=='Yes'){ ?>
                              <div class="col-md-4 main_div_deformity" id="mnd">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Nature of
                                    Deformity <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Nature of Deformity" tabindex="-1" aria-hidden="true" name="pd_nature_deformity" id="pd_nature_deformity" title="Choose Nature of Deformity">
                                       <option value=""><?php echo $deformity_type; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4 main_div_deformity" id="mpd">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Percentage of Deformity  <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Percentage of Deformity" tabindex="-1" aria-hidden="true" name="pd_percent_of_deformity" id="pd_percent_of_deformity" title="Choose Percentage of Deformity">
                                       <option value=""><?php echo $deformity_percentage; ?></option>
                                    </select>
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
                              </div>
                              <!-- col-4 -->
                              <?php if($country_id==COUNTRY_VALUE_DEFAULT) { ?>
                              <div class="col-md-4" id="main_div_state">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">State<span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Select State" tabindex="-1" aria-hidden="true" name="state_addr" id="state_addr" title="Select State" data-parsley-required="true" data-parsley-required-message="Please Select State" data-parsley-errors-container="#custom-state_addr-parsley-error">
                                       <option value=""><?php echo $state_name;?></option>
                                    </select>
                                    <span id="custom-state_addr-parsley-error"></span>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4" id="main_div_district">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">District<span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Select District" tabindex="-1" aria-hidden="true" name="district_addr" id="district_addr" title="Select District" data-parsley-required="true" data-parsley-required-message="Please Select District" data-parsley-errors-container="#custom-district_addr-parsley-error">
                                       <option  value=""><?php echo $district_name;?></option>
                                    </select>
                                    <span id="custom-district_addr-parsley-error"></span>
                                 </div>
                              </div>
                              <!-- col-4 -->
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
                              </div>
                              <!-- col-4 -->
                              <?php } ?>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label">Address Line 1 <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="address_line1" id="address_line1" placeholder="Enter Address Line 1" data-parsley-required="true" data-parsley-required-message="Please Enter Address" value="<?php echo $add_line_1; ?>" data-parsley-maxlength="100">
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label">
                                    Address Line 2 
                                    </label>
                                    <input class="form-control" type="text" name="address_line2" id="address_line2" placeholder="Enter Address Line 2" value="<?php echo $add_line_2; ?>" data-parsley-maxlength="100">
                                 </div>
                              </div>
                              <!-- col-4 -->		
                              <div class="col-md-4 print_margin">
                                 <div class="form-group">
                                    <label class="form-control-label">Pincode <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Enter Pincode" data-parsley-required="true" data-parsley-required-message="Please Enter Pincode" value="<?php echo $pin_code; ?>" data-parsley-maxlength="6" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Pincode" maxlength=6>
                                 </div>
                              </div>
                              <!-- col-4 -->		  
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
                        <section class="row">
                           <h5><?php echo PHD_ABG; ?></h5>
                           <div class="table-responsive">
                              <table class="table table-striped table-bordered" id="table4">
                                 <thead class="thead-light">
                                    <tr>
                                       <th></th>
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
                                          <input class="form-control" type="text" placeholder="" id="degree_diploma_1" name="degree_diploma_1" maxlength="50" value="<?php echo $applicant_grad_det_other_degree_name[0]; ?>">
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control custom-select" id="institute_university_1" name="institute_university_1" data-placeholder="Choose Institute/University">
                                                <option value=""><?php echo $univ_name_1; ?></option>
                                             </select>
                                          </div>
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" placeholder="" id="major_discipline_1" name="major_discipline_1" maxlength="50" value="<?php echo $major_discipline_1; ?>">
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control custom-select" id="user_marking_scheme_1" name="user_marking_scheme_1">
                                                <option value=""><?php echo $mark_scheme_name; ?></option>
                                             </select>
                                          </div>
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" placeholder="" id="obtained_percentage_cgpa_1" name="obtained_percentage_cgpa_1" maxlength="5" value="<?php echo $applicant_grad_det_mark_percent[0]; ?>">
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" placeholder="YYYY" id="year_of_passing_1" name="year_of_passing_1" maxlength="4" value="<?php echo $applicant_grad_det_completion_year[0]; ?>" >
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <p>2</p>
                                       </td>
                                       <td>
                                          <input class="form-control" type="hidden" placeholder="" id="grad_id_2" name="grad_id_2" value="<?php echo $applicant_grad_det_id[1]; ?>">
                                          <input class="form-control" type="text" placeholder="" id="degree_diploma_2" name="degree_diploma_2" maxlength="50" value="<?php echo $applicant_grad_det_other_degree_name[1]; ?>">
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control custom-select" id="institute_university_2" name="institute_university_2" data-placeholder="Choose Institute/University">
                                                <option value=""><?php echo $univ_name2; ?></option>
                                             </select>
                                          </div>
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" placeholder="" id="major_discipline_2" name="major_discipline_2" maxlength="50" value="<?php echo $major_discipline_2; ?>">
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control custom-select" id="user_marking_scheme_2" name="user_marking_scheme_2">
                                                <option value=""><?php echo $mark_scheme_name2; ?></option>
                                             </select>
                                          </div>
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" placeholder="" id="obtained_percentage_cgpa_2" name="obtained_percentage_cgpa_2" maxlength="5" value="<?php echo $applicant_grad_det_mark_percent[1]; ?>">
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" placeholder="YYYY" id="year_of_passing_2" name="year_of_passing_2" maxlength="4" value="<?php echo $applicant_grad_det_completion_year[1]; ?>">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <p>3</p>
                                       </td>
                                       <td>
                                          <input class="form-control" type="hidden" placeholder="" id="grad_id_3" name="grad_id_3" value="<?php echo $applicant_grad_det_id[2]; ?>">
                                          <input class="form-control" type="text" placeholder="" id="degree_diploma_3" name="degree_diploma_3" maxlength="50" value="<?php echo $applicant_grad_det_other_degree_name[2]; ?>">
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control custom-select" id="institute_university_3" name="institute_university_3" data-placeholder="Choose Institute/University">
                                                <option value=""><?php echo $univ_name3; ?></option>
                                             </select>
                                          </div>
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" placeholder="" id="major_discipline_3" name="major_discipline_3" maxlength="50" value="<?php echo $major_discipline_3; ?>">
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control custom-select" id="user_marking_scheme_3" name="user_marking_scheme_3">
                                                <option value=""><?php echo $mark_scheme_name3; ?></option>
                                             </select>
                                          </div>
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" placeholder="" id="obtained_percentage_cgpa_3" name="obtained_percentage_cgpa_3" maxlength="5" value="<?php echo $applicant_grad_det_mark_percent[2]; ?>">
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" placeholder="YYYY" id="year_of_passing_3" name="year_of_passing_3" maxlength="4" value="<?php echo $applicant_grad_det_completion_year[2]; ?>">
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                           <div class="w-100">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="control-label" for="radios" >
                                       Upload Your Post-Graduation Marksheet
                                       <span class="tx-danger">*</span> </label>
                                       <input type="file" class="filestyle" name="post_graduation_marksheet" id="post_graduation_marksheet">
                                       <?php if(isset($docs[$document_id_post_graduation_marksheet])){ ?>   
                                       <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_post_graduation_marksheet; ?>"><a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_post_graduation_marksheet; ?>')">&times;</a>
                                          <strong id="deleteMessageStatus_<?php echo $document_id_post_graduation_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_post_graduation_marksheet; ?>"></span>
                                       </div>
                                       <?php } ?>
                                       <span id="custom-post_graduation_marksheet-parsley-error"></span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="w-100">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="control-label" for="radios" >Have you
                                       taken any competitive exam?  <span class="tx-danger">*</span></label>
                                       <select class="form-control custom-select study" id="taken_any_competitive_exam" name="taken_any_competitive_exam" data-parsley-required="true" data-parsley-required-message="Please select the status" onchange="check_competitive_exam(this.value, 'select_div_competitive_exam', 'upload_div_competitive_exam','taken_any_competitive_exam_info','<?php echo ((isset($docs[$document_id_score_card]))?'false':'true'); ?>')" data-parsley-errors-container="#custom-taken_any_competitive_exam-parsley-error" data-parsley-trigger="change">
                                          <option value=""><?php echo $is_competitive_exam_name; ?></option>
                                       </select>
                                       <span id="custom-taken_any_competitive_exam-parsley-error"></span>
                                       <div class="form-group" style="display: none;" id="taken_any_competitive_exam_info"><small><?php echo NO_CE_NEED_ENTRANCE; ?></small>
                                       </div>
                                    </div>
                                 </div>
                                 <?php if($is_competitive_exam=='t'){ ?>
                                 <div class="col-md-6" id="select_div_competitive_exam">
                                    <div class="form-group">
                                       <label class="control-label" for="radios" >Please
                                       Select competitive Examination  <span class="tx-danger">*</span></label>
                                       <select class="form-control custom-select study" id="competitive_exam" name="competitive_exam" data-parsley-required="true" data-parsley-required-message="Please select the competitive examination" data-parsley-errors-container="#custom-competitive_exam-parsley-error" data-parsley-trigger="change"><option value=""><?php echo $comp_exam_name; ?></select>
                                       <span id="custom-competitive_exam-parsley-error"></span>
                                    </div>
                                 </div>
                                 <?php } ?>
                              </div>
                           </div>
                           <?php if($is_competitive_exam=='t'){ ?>
                           <div class="row w-100" id="upload_div_competitive_exam">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="control-label" for="radios" >Upload GATE/UGC/SLET/NET Score Card  <span class="tx-danger">*</span> </label>      
                                    <input type="file" class="filestyle" name="score_card" id="score_card" data-parsley-required="<?php echo ((isset($docs[$document_id_score_card]))?'false':'true'); ?>" data-parsley-required-message="Please upload score card" data-parsley-errors-container="#custom-score_card-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_SCORE_CARD_KB; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_SCORE_CARD_KB_JS; ?>" data-parsley-max-file-size-message="This file should not be larger than <?php echo MAX_FILE_SIZE_SCORE_CARD_MB; ?> MB" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE_SCORE_CARD; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_score_card])){ echo $docs[$document_id_score_card]['id']; } ?>"  data-parsley-trigger="change">
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
                           <?php } ?>
                           <div class="w-100">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="d-block mb-3 w-100 text-left">Do you have any Work Experience? :</label>
                                       <div class="custom-control custom-radio custom-control-inline">
                                          <input type="radio" id="is_work_experience_yes" name="is_work_experience" class="custom-control-input" <?php echo ($is_work_experience == 't')?'checked':''; ?> value="yes" onchange="is_work_experience_func(this.value)">
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
                           <?php if($is_work_experience == 't'){ ?>
                           <div class="row w-100" id="emp_dtl">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="control-label" for="radios">Name of Employee  <span class="tx-danger">*</span></label>
                                    <input type="text" name="name_of_employee" id="name_of_employee" class="form-control" placeholder="Enter Name" maxlength="150" value="<?php echo $nameofemployee; ?>">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="control-label" for="radios">Address Of Employee  <span class="tx-danger">*</span></label>
                                    <input type="text" name="address_of_employee" id="address_of_employee" class="form-control" placeholder="Enter Address" maxlength="500" value="<?php echo $addressofemployee; ?>">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="control-label" for="radios">Salary received /Month  <span class="tx-danger">*</span></label>
                                    <input type="text" name="salary_per_month" id="salary_per_month" class="form-control" placeholder="Enter salary per month" maxlength="10" value="<?php echo $salaryreceived; ?>">
                                 </div>
                              </div>
                           </div>
                           <?php } ?>
                           <?php if($is_work_experience == 't'){ ?>
                           <div class="row w-100" id="emp_exp">
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
                                                   <div class="form-group"><input type="text" name="organisation_name_0" id="organisation_name_0" class="form-control" placeholder="" maxlength="100"  value="<?php echo $applicant_prof_exp_org_name[0]; ?>"></div>
                                                   <span class="tx-danger required_asterisk">*</span>
                                                </td>
                                                <td>
                                                   <div class="form-group"><input type="text" name="designation_0" id="designation_0" class="form-control" placeholder="" maxlength="100" data-parsley-required="false" value="<?php echo $applicant_prof_exp_designation[0]; ?>"></div>
                                                </td>
                                                <td>
                                                   <div class="form-group"><input type="text" name="nature_of_job_0" id="nature_of_job_0" class="form-control" placeholder="" maxlength="100"  value="<?php echo $applicant_prof_exp_job_nature[0]; ?>"></div>
                                                </td>
                                                <td>
                                                   <div class="form-group"><input type="text" name="total_salary_month_0" id="total_salary_month_0" class="form-control" placeholder="" maxlength="10"data-parsley-required="false" value="<?php echo $applicant_prof_exp_salary[0]; ?>"></div>
                                                </td>
                                                <td>
                                                   <div class="form-group"><input readonly="" type="text" name="from_year_0" id="from_year_0" class="form-control datepicker" placeholder="MM/YYYY" maxlength="7" data-parsley-required="false"  value="<?php echo $applicant_prof_exp_from_date[0]; ?>"></div>
                                                </td>
                                                <td>
                                                   <div class="form-group"><input readonly="" type="text" name="to_year_0" id="to_year_0" class="form-control datepicker" placeholder="MM/YYYY" maxlength="7" data-parsley-required="false" value="<?php echo $applicant_prof_exp_to_date[0]; ?>"></div>
                                                </td>
                                                <td>
                                                   <div class="form-group"><input type="text" name="work_experience_0" id="work_experience_0" class="form-control" placeholder="" readonly="readonly" maxlength="5"  value="<?php echo $applicant_prof_exp_work_exp_in_months[0]; ?>"></div>
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
                           <div class="row w-100" id="emp_total_exp">
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
                                    <input type="text" name="total_work_experience" id="total_work_experience" class="form-control" placeholder="Total Work Experience" readonly="readonly" maxlength="5" value="<?php echo $total_work_exp; ?>">
                                 </div>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="col-md-12">
                              <h5>Publications, if any (Books I ResearchPapers) :</h5>
                           </div>
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
                                          <input class="form-control" type="text" name="publications_title_0" id="publications_title_0" placeholder="" maxlength="100" value="<?php echo $applicant_publn_det_title[0]; ?>">
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" name="publications_name_of_the_journal_0" id="publications_name_of_the_journal_0" placeholder="" maxlength="100" value="<?php echo $applicant_publn_det_journal_conf_name[0]; ?>">
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" name="publications_year_0" id="publications_year_0" placeholder="YYYY" maxlength="4" value="<?php echo $applicant_publn_det_year[0]; ?>">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <p>2</p>
                                       </td>
                                       <td>
                                          <input class="form-control" type="hidden" placeholder="" id="publn_det_id_1" name="publn_det_id_1" value="<?php echo $applicant_publn_det_id[1]; ?>">
                                          <input class="form-control" type="text" name="publications_title_1" id="publications_title_1" placeholder="" maxlength="100" value="<?php echo $applicant_publn_det_title[1]; ?>">
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" name="publications_name_of_the_journal_1" id="publications_name_of_the_journal_1" placeholder="" maxlength="100" value="<?php echo $applicant_publn_det_journal_conf_name[1]; ?>">
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" name="publications_year_1" id="publications_year_1" placeholder="YYYY" maxlength="4" value="<?php echo $applicant_publn_det_year[1]; ?>">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <p>3</p>
                                       </td>
                                       <td>
                                          <input class="form-control" type="hidden" placeholder="" id="publn_det_id_2" name="publn_det_id_2" value="<?php echo $applicant_publn_det_id[2]; ?>">
                                          <input class="form-control" type="text" name="publications_title_2" id="publications_title_2" placeholder="" maxlength="100" value="<?php echo $applicant_publn_det_title[2]; ?>">
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" name="publications_name_of_the_journal_2" id="publications_name_of_the_journal_2" placeholder="" maxlength="100" value="<?php echo $applicant_publn_det_journal_conf_name[2]; ?>">
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" name="publications_year_2" id="publications_year_2" placeholder="YYYY" maxlength="4" value="<?php echo $applicant_publn_det_year[2]; ?>">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <p>4</p>
                                       </td>
                                       <td>
                                          <input class="form-control" type="hidden" placeholder="" id="publn_det_id_3" name="publn_det_id_3" value="<?php echo $applicant_publn_det_id[3]; ?>">
                                          <input class="form-control" type="text" name="publications_title_3" id="publications_title_3" placeholder="" maxlength="100" value="<?php echo $applicant_publn_det_title[3]; ?>">
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" name="publications_name_of_the_journal_3" id="publications_name_of_the_journal_3" placeholder="" maxlength="100" value="<?php echo $applicant_publn_det_journal_conf_name[3]; ?>">
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" name="publications_year_3" id="publications_year_3" placeholder="YYYY" maxlength="4" value="<?php echo $applicant_publn_det_year[3]; ?>">
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
                                       <input class="form-control" type="text" name="phd_major" id="phd_major" placeholder="Enter Your Detail" maxlength="100" value="<?php echo $research_area; ?>">
                                    </div>
                                 </div>
                                 <!-- col-4 -->
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label class="form-control-label">Tentative Topic </label>
                                       <input class="form-control" type="text" name="tentative_topic_name" id="tentative_topic_name" placeholder="Enter Topic Name" maxlength="100" value="<?php echo $tentative_topic; ?>">
                                    </div>
                                 </div>
                                 <!-- col-4 -->
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label class="control-label text-left" >Tentative topic, if identified for research (Attach one-page write up on the topic identified) </label>
                                       <input type="file" class="filestyle" name="tentative_topic_files[]" id="tentative_topic_files" multiple  data-parsley-validate-if-empty="true" data-parsley-required-message="Please upload tentative topic" data-parsley-errors-container="#custom-tentative_topic_files-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_500_KB; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-no-of-files="<?php echo MAX_FILE_FOR_TENTATIVE_TOPIC; ?>" data-parsley-no-of-files-message="Max allowed files only: <?php echo MAX_FILE_FOR_TENTATIVE_TOPIC; ?>" onchange="upload_file(this.id, 2)" data-file-id="<?php if(isset($docs[$document_id_tentative_topic])){ echo implode(',',array_column($docs[$document_id_tentative_topic], 'id')); } ?>"  data-parsley-trigger="change" data-file-count="<?php echo ($docs['file_count'])?$docs['file_count']:0; ?>">
                                       <?php if(isset($docs[$document_id_tentative_topic])){ ?>
                                       <?php foreach($docs[$document_id_tentative_topic] as $k=>$v) { ?>
                                       <span class='file_name  mt-3' ><a href="<?php echo base_url().$v['file_path'];?>" target="_blank" title="<?php echo $v['file_name_user']; ?>"><?php echo $v['file_name_truncate'];?> <i class="fa fa-eye" aria-hidden="true"></i></a></span>
                                       <a href="javascript:void(0)" data-del-file-id="<?php if(isset($v)){ echo $v['id']; } ?>" data-doc-id="<?php echo $document_id_tentative_topic; ?>" data-toggle="modal" data-target="#contentDeletePop" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                       <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_tentative_topic.$v['id']; ?>">
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
                                       <label class="form-control-label text-left"><?php echo RESEARCH_SV_AVAILABLE; ?>  <span class="tx-danger">*</span></label>
                                       <input class="form-control" type="text" name="choice_supervisor" id="choice_supervisor" placeholder="Enter Detail" maxlength="1000" data-parsley-required="true" data-parsley-required-message="Please enter the choice of supervisor" data-parsley-trigger="change" value="<?php echo $choiceofprefofsupervisor; ?>">
                                    </div>
                                 </div>
                                 <!-- col-4 -->
                              </div>
                           </div>
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
               <div class="card">
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
                                    <p><?php echo DECLARATION_PHD; ?></p>
                                    <div class="row w-100">
                                       <?php
                                          ?>
                                       <div class="col-lg-6">
                                          <label class="form-control-label">Applicant Name <span class="tx-danger">*</span></label>
                                          <div class="form-group">
                                             <input class="form-control" type="text" name="applicant_name" id="applicant_name" placeholder="Applicant Name" value="<?php echo $applicant_name_declaration; ?>">
                                          </div>
                                       </div>
                                       <!-- col-4 -->
                                       <div class="col-lg-6">
                                          <label class="form-control-label">Date  <span class="tx-danger">*</span></label>
                                          <div class="form-group">
                                             <input class="form-control" type="text" name="date_dec" id="date_dec"placeholder="Parent Name" value="<?php echo $ddate; ?>">
                                          </div>
                                       </div>
                                       <!-- col-4 -->
                                    </div>
                                 </div>
                                 <!-- row -->
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-layout">
                                 <div class="row mg-b-25 mt-3">
                                    <div class="row w-100">
                                       <?php
                                          ?>
                                       <!-- col-4 -->
                                       <div class="form-group col-md-6 ">
                                          <label for="exampleFormControlTextarea1">Upload Your Recent Passport Size Photograph  <span class="tx-danger">*</span></label>
                                          <input type="file" class="filestyle" name="photograph" id="photograph" data-parsley-required="<?php echo ((isset($docs[$document_id_photograph]))?'false':'true'); ?>" data-parsley-required-message="Please upload photograph" data-parsley-errors-container="#custom-photograph-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>"  data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>">
                                          <?php if(isset($docs[$document_id_photograph])){ ?>
                                          <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_photograph; ?>">
                                             <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_photograph; ?>')">&times;</a>
                                             <strong id="deleteMessageStatus_<?php echo $document_id_photograph; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_photograph; ?>"></span>
                                          </div>
                                          <?php } ?>
                                          <span id="custom-photograph-parsley-error"></span>
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Signature  <span class="tx-danger">*</span></label>
                                          <input type="file" class="filestyle" name="signature" id="signature" data-parsley-required="<?php echo ((isset($docs[$document_id_signature]))?'false':'true'); ?>" data-parsley-required-message="Please upload signature" data-parsley-errors-container="#custom-signature-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>">
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
                                          <input type="file" class="filestyle" name="aadhar_card" id="aadhar_card" data-parsley-required="false" data-parsley-validate-if-empty="true"data-parsley-required-message="Please upload your aadhar card" data-parsley-errors-container="#custom-aadhar_card-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_500_KB; ?>"  data-max-file-size-js="<?php echo MAX_FILE_SIZE_500_KB_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_aadhar_card])){ echo $docs[$document_id_aadhar_card]['id']; } ?>">
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
                                          <input type="file" class="filestyle" name="additional_qualification" id="additional_qualification" data-parsley-required="false" data-parsley-validate-if-empty="true" data-parsley-required-message="Please upload additional qualification" data-parsley-errors-container="#custom-additional_qualification-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE_500_KB; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_500_KB_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_additional_qualification])){ echo $docs[$document_id_additional_qualification]['id']; } ?>">
                                          <?php if(isset($docs[$document_id_additional_qualification])){ ?>                  <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_additional_qualification; ?>">
                                             <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_additional_qualification; ?>')">&times;</a>
                                             <strong id="deleteMessageStatus_<?php echo $document_id_additional_qualification; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_additional_qualification; ?>"></span>
                                          </div>
                                          <?php } ?>
                                          <span id="custom-additional_qualification-parsley-error"></span>
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