<?php
   $parent_type_id_father = PARENT_TYPE_ID_FATHER;
   $parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
   $parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
   $country_value_default = COUNTRY_VALUE_DEFAULT;
   
   $appln_form_fee = $applicant_appln_details_list['appln_form_fee'];
   
   $first_name = $applicant_basic_details_list['f_name'];
   $applicant_mob_country_code_name = isset($applicant_basic_details_list['applicant_mob_country_code_name']) ? $applicant_basic_details_list['applicant_mob_country_code_name'] : '';
   $middle_name = $applicant_basic_details_list['m_name'];
   $last_name = $applicant_basic_details_list['l_name'];
   $mobile_no = $applicant_basic_details_list['mob_no'];
   $email_id = $applicant_basic_details_list['e_mail'];
   if($applicant_basic_details_list['dob']){
   	$dob=isset($applicant_basic_details_list['dob'])? date('d/m/Y',strtotime($applicant_basic_details_list['dob'])):'';
   }
   $alt_email_id = $applicant_basic_details_list['sec_e_mail'];
   $other_working_place = $applicant_graduations_list[0]['other_work_place'];
   $employee = $applicant_basic_details_list['employee'];
   $user_id = $personal_detail_list['data']['user_id'];
   $aadhar_no = $applicant_basic_details_list['aadhar_no'];
   $gender = !empty($applicant_basic_details_list['gender']) ? $applicant_basic_details_list['gender']: 'Select';
   $tittle_name = !empty($applicant_basic_details_list['tittle_name']) ? $applicant_basic_details_list['tittle_name'] : 'Select';
   $blood_group = !empty($applicant_basic_details_list['blood_group']) ? $applicant_basic_details_list['blood_group'] : 'Select';
   $nationality = !empty($applicant_basic_details_list['nationality']) ? $applicant_basic_details_list['nationality']: 'Select Nationality';
   $social_status = !empty($applicant_basic_details_list['social_status']) ? $applicant_basic_details_list['social_status']: 'Select Your Social Status';
   $nation_id = isset($applicant_basic_details_list['nation_id']) ? $applicant_basic_details_list['nation_id']: '';
   $dif_abled = !empty($applicant_basic_details_list['dif_abled']) ? ucfirst($applicant_basic_details_list['dif_abled']) : 'Select - Yes/No';
   $deformity_type = !empty($applicant_basic_details_list['deformity_type']) ? ucfirst($applicant_basic_details_list['deformity_type']) : 'Select - Deformity';
   $deformity_percentage = !empty($applicant_basic_details_list['deformity_percentage']."0%") ? $applicant_basic_details_list['deformity_percentage']."0%" : 'Select - Deformity Percentage';
   $econo_weaker_sec = !empty($applicant_basic_details_list['econo_weaker_sec']) ? ucfirst($applicant_basic_details_list['econo_weaker_sec']) : 'Select - Deformity Percentage';
   if($prefer_hostel=='T'){
   $prefer_hostel="Yes";
   }elseif($prefer_hostel=='F'){
   $prefer_hostel="No";
   }
   if($dif_abled=='T'){
   $dif_abled="Yes";
   }elseif($dif_abled=='F'){
   $dif_abled="No";
   }
   
   if($applicant_graduations_list['is_curr_qualify']=='t' && !empty($applicant_graduations_list)){
   	$styleGrad="display:inherit;";
   }else{
   	$styleGrad="display:none;";
   }
   
   
   $document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
   $document_id_signature = DOCUMENT_ID_SIGNATURE;
   $document_id_tenth_marksheet = DOCUMENT_ID_TENTH_MARKSHEET;
   $document_id_twelvfth_marksheet = DOCUMENT_ID_TWELVFTH_MARKSHEET;
   
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
      $father_name_dde = isset($father_name) ? $father_name : '';
      $father_mobile = isset($father_mobile) ? $father_mobile : '';
      $father_email = isset($father_email) ? $father_email : '';
      $father_occupation = isset($father_occupation) ? $father_occupation : 'Select Father\'s Occupation';
      $father_other_occupation=isset($father_other_occupation) ? $father_other_occupation:'';
      $father_occupation_id=isset($father_occupation_id) ? $father_occupation_id:'';
      $father_country_mob_code=isset($father_country_mob_code)?$father_country_mob_code :'+91';
      $father_alt_mob_country_code=isset($father_alt_mob_country_code)?$father_alt_mob_country_code :'+91';
      
      $mother_title_id = isset($mother_title_id) ? $mother_title_id : 'Select';
      $mother_title_name = isset($mother_title_name) ? $mother_title_name : 'Select';
      $mother_name_dde = isset($mother_name) ? $mother_name : '';
      $mother_mobile = isset($mother_mobile) ? $mother_mobile : '';
      $mother_email = isset($mother_email) ? $mother_email : '';
      $mother_occupation = isset($mother_occupation) ? $mother_occupation : 'Select Mother\'s Occupation';
      $mother_other_occupation=isset($mother_other_occupation) ? $mother_other_occupation:'';
      $mother_occupation_id=isset($mother_occupation_id) ? $mother_occupation_id:'';
      $mother_country_mob_code=isset($mother_country_mob_code)?$mother_country_mob_code :'91';
      $mother_alt_mob_country_code=isset($mother_alt_mob_country_code)?$mother_alt_mob_country_code :'91';
      
      $guardian_title_name = isset($guardian_title_name) ? $guardian_title_name : 'Select';
      $guardian_name_dde = isset($guardian_name) ? $guardian_name : '';
      $guardian_mobile = isset($guardian_mobile) ? $guardian_mobile : '';
      $guardian_email = isset($guardian_email) ? $guardian_email : '';
      $guardian_occupation = isset($guardian_occupation) ? $guardian_occupation : 'Select Guardian\'s Occupation';
      $guardian_other_occupation=isset($guardian_other_occupation) ? $guardian_other_occupation:'';
      $guardian_occupation_id=isset($guardian_occupation_id) ? $guardian_occupation_id:'';
      $guardian_country_mob_code=isset($guardian_country_mob_code)?$guardian_country_mob_code :'91';
      $guardian_alt_mob_country_code=isset($guardian_alt_mob_country_code)?$guardian_alt_mob_country_code :'91';
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
   	  $board_name[$applicant_scl_det_id] = $v['board_name'];
   	  $board_id[$applicant_scl_det_id] = $v['board_id'];
   	  $stream_id[$applicant_scl_det_id] = $v['stream_id'];
   	  $other_stream_name[$applicant_scl_det_id] = $v['other_stream_name'];
   	  $mode_of_study_name[$applicant_scl_det_id] = $v['mode_of_study_name'];
   	  $stream_name[$applicant_scl_det_id] = $v['stream_name'];
   	  $marking_scheme_name[$applicant_scl_det_id] = $v['marking_scheme_name'];
      }
   }
   
   $name_as_in_marksheet = $name_as_in_marksheet[$applicant_schooling_list_tenth_id];
   
   // Schooling Detail Get Tenth
   $inst_name_tenth = $inst_name[$applicant_schooling_list_tenth_id];
   $mark_percentage_tenth = $mark_percentage[$applicant_schooling_list_tenth_id];
   $registration_no_tenth = $registration_no[$applicant_schooling_list_tenth_id];
   $other_board_name_tenth = $other_board_name[$applicant_schooling_list_tenth_id];
   $board_id_tenth = $board_id[$applicant_schooling_list_tenth_id];
   $mode_of_study_name_tenth = $mode_of_study_name[$applicant_schooling_list_tenth_id];
   $marking_scheme_name_tenth = $marking_scheme_name[$applicant_schooling_list_tenth_id];
   $board_tenth = isset($board_name[$applicant_schooling_list_tenth_id]) ? $board_name[$applicant_schooling_list_tenth_id] : 'Select';
   $completion_year_tenth =  isset($completion_year[$applicant_schooling_list_tenth_id]) ? $completion_year[$applicant_schooling_list_tenth_id] : 'Select';
   // Schooling Detail Get Twelfth
   $inst_name_twelfth = $inst_name[$applicant_schooling_list_twelfth_id];
   $mark_percentage_twelfth = $mark_percentage[$applicant_schooling_list_twelfth_id];
   $registration_no_twelfth = $registration_no[$applicant_schooling_list_twelfth_id];
   $other_board_name_twelfth = $other_board_name[$applicant_schooling_list_twelfth_id];
   $other_stream_name = $other_stream_name[$applicant_schooling_list_twelfth_id];
   $board_twelfth = isset($board_name[$applicant_schooling_list_twelfth_id]) ? $board_name[$applicant_schooling_list_twelfth_id] : 'Select';
   $completion_year_twelfth =  isset($completion_year[$applicant_schooling_list_twelfth_id]) ? $completion_year[$applicant_schooling_list_twelfth_id] : 'Select';
   $board_id_twelfth = $board_id[$applicant_schooling_list_twelfth_id];
   $mode_of_study_name_twelfth = $mode_of_study_name[$applicant_schooling_list_twelfth_id];
   $marking_scheme_name_twelfth = $marking_scheme_name[$applicant_schooling_list_twelfth_id];
   $stream_name = $stream_name[$applicant_schooling_list_twelfth_id];
   $stream_id = $stream_id[$applicant_schooling_list_twelfth_id];
   
   $mark_percentage_graduation = $applicant_graduations_list['mark_percentage'];
   $reg_no_graduation = $applicant_graduations_list['reg_no'];
   $grad_university_name = $applicant_graduations_list['univ_name'];
   $grad_university_id = $applicant_graduations_list['univ_id'];
   $grad_mark_scheme_name = $applicant_graduations_list['mark_scheme_name'];
   $grad_yr_of_passing = $applicant_graduations_list['yr_of_pass'];
   $grad_deg_name = $applicant_graduations_list['deg_name'];
   $grad_inst_name = $get_grad_inst_name['insti_name'];
   $grad_university_other_name = $get_grad_inst_name['other_university_name'];
   
   $getlang_semester = $get_second_lang['mothertongue_name'];
   $learning_support_center = $get_second_lang['campus_name'];
   
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
   
   /* Payment Details Start */
   $branch_name = $payment_details_list['branch_name'];
   $dd_cheque_no = $payment_details_list['dd_cheque_no'];
   $dd_cheque_date = $payment_details_list['dd_cheque_date'];
   $payment_mode_id = $payment_details_list['payment_mode_id'];
   $bank_name=$payment_details_list['bank_name'];
   $appln_form_fee=isset($appln_form_fee) ? $appln_form_fee : '1100';
   $branch_name=isset($branch_name)? $branch_name:'';
   $dd_cheque_no=isset($dd_cheque_no)? $dd_cheque_no:'';
   $dd_cheque_date=isset($dd_cheque_date)? date('d/m/Y',strtotime($dd_cheque_date)):'';
   $payment_mode_id=isset($payment_mode_id)? $payment_mode_id:'';
   $bank_name=isset($bank_name)? $bank_name:'Select Bank Name';
   /* Payment Details End */
   
   $startIndex = $this->input->get('startIndex');
   
   $resid_tamilnadu = isset($applicant_basic_details_list['resid_tamilnadu']) ? $applicant_basic_details_list['resid_tamilnadu'] : '';
   
   if($resid_tamilnadu=='t'){
      $resid_tamilnadu = 'Yes';
   }else{
      $resid_tamilnadu = 'No';
   }
   
   // Program Level & Course & Campus Preferences Fetch
   $program_name = $applicant_appln_details_list['grad_name'];
   $course_name = $applicant_course_details_list[0]['course_name'];
   $campus_name = $applicant_campus_details_list[0]['campus_name'];
   
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
   
   	$current_qualification_status_twelfth = $applicant_schooling_list[1]['is_curr_qualify'];
   
   	if($current_qualification_status_twelfth=="t"){
   		$current_qualification_status ="Twelfth / 3 year Diploma Passed";
		$current_qualification_status_style ="display:none;";
   	}else{
   		$current_qualification_status ="Graduation Passed";
		$current_qualification_status_style ="display:block;";
   	}
   
	/*CRM ADMIN Edit form start*/
	$url = base_url().'dis-education?startIndex='.$startIndex;
	if($mode_edit == ADMIN_MODE_EDIT)
	{
	  $url = base_url().'dis-education/'.$mode_edit.'/'.$crm_applicant_login_id.'/'.$crm_applicant_personal_det_id.'?startIndex='.$startIndex;;
	}
	/*CRM ADMIN Edit form start*/   
   ?>
<div id="container-fluid">
   <div class="col-md-1 ml-2">
      <a href="<?php echo $url; ?>" class="btn btn-primary active w-100 mt-3" role="button" aria-pressed="true">Back</a>
   </div>
</div>
<div id="form_preview_de" class="disable-div">
   <div class="row">
      <div class="col-sm-12" id="DistancePreviewToPrint">
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
                                    <label class="form-control-label">Are you currently a resident of Tamil Nadu? <span class="tx-danger">*</span></label>
                                    <select class="form-control custom-select" name="current_resident_tn" id="current_resident_tn" title="Choose Resident">
                                       <option value=""><?php echo $resid_tamilnadu; ?></option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group formAreaCols" id="guidelines" style="<?php echo ($applicant_basic_details_list['resid_tamilnadu']=='f')?'display:block;':'display:none;'; ?>"><b>Please understand that as per UGC guidelines , the PCP (Person Contact Programs) and semester exams for SRMIST DDE will be conducted only within Tamil Nadu</b></div>
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
                              <div class="col-lg-6">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Program Level <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Program" tabindex="-1" aria-hidden="true" name="pd_program" id="pd_program">
                                       <option value=""><?php echo $program_name; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-lg-6">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Course Preference <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Course" tabindex="-1" aria-hidden="true" name="pd_course" id="pd_course">
                                       <option value=""><?php echo $course_name; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-lg-6">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Campus</label>
                                    <select class="form-control select2" data-placeholder="Choose Campus" tabindex="-1" aria-hidden="true" name="pd_campus" id="pd_campus" title="Choose Campus" data-parsley-required="true">
                                       <option value=""><?php echo $campus_name; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <!-- col-4 -->						   
                           </div>
                           <div class="row w-100">
                              <div class="col-md-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Title<span class="tx-danger"> *</span></label>
                                    <select class="form-control custom-select study" id="pd_title" name="pd_title" tabindex="-1" aria-hidden="true" title="Choose Title" data-placeholder="Choose Title" tabindex="-1"  >
                                       <option value=""><?php echo $tittle_name; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label">First Name <span class="tx-danger"> *</span></label>
                                    <input class="form-control" type="text" name="Firstname" placeholder="Enter lastname" value="<?php echo $first_name;?>">
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label">Middle Name </label>
                                    <input class="form-control" type="text" name="MiddleName" placeholder="Middle Name"
                                       value="<?php echo $middle_name; ?>"
                                       >
                                 </div>
                              </div>
                              <!-- col-4 -->
                           </div>
                           <div class="row w-100">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label">Last Name <span class="tx-danger"> *</span></label>
                                    <input class="form-control" type="text" name="LastName" placeholder="LastName" value="<?php echo $last_name; ?>">
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4">
                                 <label class="form-control-label">Mobile No <span class="tx-danger"> *</span></label>
                                 <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <span
                                       class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                       <select class="form-control form_control custom-select Mobile_number" id="phone_no_code" name="phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                          <option value=""><?php echo $applicant_mob_country_code_name; ?></option>
                                       </select>
                                    </span>
                                    <input type="text" name="pd_mobile_no" id="pd_mobile_no" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Mobile No" class="form-control" value="<?php echo $mobile_no; ?>">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="form-control-label">Email ID <span class="tx-danger"> *</span></label>
                                    <input class="form-control" type="text" name="email" value="<?php echo $email_id; ?>" placeholder="Enter email address">
                                 </div>
                              </div>
                           </div>
                           <div class="row w-100">
                              <div class="col-md-4">
                                 <div class="wd-200 w-100">
                                    <label class="form-control-label">Date of Birth<span class="tx-danger"> *</span></label>
                                    <div class="input-group">
                                       <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                       <input type="text" class="form-control hasDatepicker" name="pd_dob" id="pd_dob" placeholder="MM/DD/YYYY" value="<?php echo  $dob; ?>">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Gender <span class="tx-danger"> *</span></label>
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
                                    <label class="form-control-label">Blood Group <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Blood Group" tabindex="-1" aria-hidden="true" name="pd_blood_group" id="pd_blood_group" title="Choose Blood Group">
                                       <option value=""><?php echo $blood_group; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Nationality <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Nationality" tabindex="-1" aria-hidden="true" name="pd_nationality" id="pd_nationality" title="Choose Nationality" data-parsley-required="true" data-parsley-required-message="Please Choose Nationality" data-parsley-errors-container="#custom-pd_nationality-parsley-error">
                                       <option value=""><?php echo $nationality; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <?php if($nation_id==COUNTRY_VALUE_DEFAULT) 
                                 {
                                 ?>
                              <div class="col-md-4" id="main_div_social_status">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Community <span
                                       class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Select Community" tabindex="-1" aria-hidden="true" name="pd_social_status" id="pd_social_status" title="Select Community" data-parsley-required="true" data-parsley-required-message="Please Select Community" data-parsley-errors-container="#custom-pd_social_status-parsley-error" data-parsley-trigger="change">
                                       <option value=""><?php echo $social_status;?></option>
                                    </select>
                                    <span id="custom-pd_social_status-parsley-error"></span>
                                 </div>
                              </div>
                              <!-- col-4 -->  
                              <?php } ?> 				
                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label class="form-control-label">Aadhar Number <span class="tx-danger" id="aadhar_no_mandatory"> *</span></label>
                                    <input class="form-control" type="text" name="pd_aadhaar_no" id="pd_aadhaar_no" value="<?php echo $aadhar_no; ?>">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Are you a differently Abled?<span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Differently Abled" tabindex="-1" aria-hidden="true" name="pd_diffrently_abled" id="pd_diffrently_abled" title="Choose Differently Abled">
                                       <option value=""><?php echo $dif_abled; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <?php if($dif_abled=='Yes') 
                                 {
                                 ?>				  
                              <div class="col-md-4 main_div_deformity"id="mnd">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Nature of
                                    Deformity<span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Nature of Deformity" tabindex="-1" aria-hidden="true" name="pd_nature_deformity" id="pd_nature_deformity" title="Choose Nature of Deformity">
                                       <option value=""><?php echo $deformity_type; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-md-4 main_div_deformity" id="mpd">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Percentage of Deformity <span class="tx-danger"> *</span></label>
                                    <select class="form-control select2" data-placeholder="Choose Percentage of Deformity" tabindex="-1" aria-hidden="true" name="pd_percent_of_deformity" id="pd_percent_of_deformity" title="Choose Percentage of Deformity">
                                       <option value=""><?php echo $deformity_percentage; ?></option>
                                    </select>
                                 </div>
                              </div>
                              <?php } ?>
                              <!-- col-4 -->				  
                              <div class="col-lg-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Economically Weaker Section</label>
                                    <select class="form-control select2" data-placeholder="Choose Economically Weaker Section" tabindex="-1" aria-hidden="true" name="pd_economically_weaker" id="pd_economically_weaker" title="Economically Weaker Section">
                                       <option value=""><?php echo $econo_weaker_sec; ?></option>
                                    </select>
                                 </div>
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
                        Parent Details
                        </button>
                     </h2>
                  </div>
                  <div id="collapseThree" class="collapse show bg-light" aria-labelledby="headingThree" data-parent="#accordionExample">
                     <div class="card-body">
                        <section class="row">
                           <h5 class="text-primary mb-3">Father's Details</h5>
                           <div class="row w-100 print_margin_6">
                              <div class="col-lg-4">
                                 <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Title<span class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Select Title" tabindex="-1" aria-hidden="true" name="pd_father_title" id="pd_father_title" title="Select Title" data-parsley-required="true" data-parsley-required-message="Please Select Title" data-parsley-errors-container="#custom-pd_father_title-parsley-error" >
                                       <option value=""><?php echo $father_title_name;?></option>
                                    </select>
                                    <span id="custom-pd_father_title-parsley-error"></span>
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label class="form-control-label">Father's Name <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="pd_father_name" id="pd_father_name" placeholder="Enter Your Father Name" maxlength="50" data-parsley-required="true" data-parsley-required-message="Please Enter Your Father Name" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" value="<?php echo $father_name_dde; ?>">
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <?php if($father_title_id!=LOOKUP_VALUE_TITLE_LATE_ID) { ?>
                              <div class="col-lg-4" id="father_mbleno_div" >
                                 <label class="form-control-label">Father's Mobile Number
                                 </label>
                                 <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                       <select class="form-control form_control  Mobile_number" id="pd_father_phone_no_code" name="pd_father_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                          <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected><?php echo $father_country_mob_code;?></option>
                                       </select>
                                    </span>
                                    <input type="text" class="form-control" name="pd_father_phone" id="pd_father_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Father's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_father_phone-parsley-error" value="<?php echo $father_mobile;  ?>">
                                 </div>
                                 <span id="custom-pd_father_phone-parsley-error"></span>
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
                              </div>
                              <!-- col-4 -->
                              <?php } ?>
                           </div>
                           <!-- row -->
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
                              </div>
                              <!-- col-4 -->
                              <div class="col-lg-4">
                                 <div class="form-group">
                                    <label class="form-control-label">Mother's Name <span class="tx-danger">*</span></label>
                                    <input type="text" class="form-control" name="pd_mother_name" id="pd_mother_name" placeholder="Enter Your Father Name" maxlength="50" data-parsley-required="true" data-parsley-required-message="Please Enter Your Mother Name" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" value="<?php echo $mother_name_dde; ?>">
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <?php if($mother_title_id!=LOOKUP_VALUE_TITLE_LATE_ID) { ?>
                              <div class="col-lg-4" id="mother_mbleno_div" >
                                 <label class="form-control-label">Mother's Mobile Number</label>
                                 <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                                       <select class="form-control form_control  Mobile_number" id="pd_mother_phone_no_code" name="pd_mother_phone_no_code" data-placeholder="+91" tabindex="-1" aria-hidden="true">
                                          <option value="<?php echo COUNTRY_VALUE_DEFAULT; ?>" selected><?php echo $mother_country_mob_code;?></option>
                                       </select>
                                    </span>
                                    <input type="text" class="form-control" name="pd_mother_phone" id="pd_mother_phone" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" placeholder="Enter Your Mother's Mobile No" class="form-control" data-parsley-required="false" data-parsley-required-message="Please Enter Mobile Number" data-parsley-type="digits" data-parsley-type-message="Please Enter Valid Mobile Number" data-parsley-minlength="10" data-parsley-maxlength="10" data-parsley-maxlength-message="Please Enter Valid Mobile Number" data-parsley-errors-container="#custom-pd_mother_phone-parsley-error" value="<?php echo $mother_mobile; ?>">
                                    <span id="custom-pd_mother_phone-parsley-error"></span>
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
                           </div>
                           <!-- row -->
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
                                    <input class="form-control" type="text" name="pd_guardian_name" id="pd_guardian_name" placeholder="Enter Your Guardian Name" maxlength="50" data-parsley-required="false" data-parsley-required-message="Please Enter Your Guardian Name" data-parsley-nameonly="true" data-parsley-nameonly-message="Name must be alphabetic only." data-parsley-length="[1, 50]" value="<?php echo $guardian_name_dde; ?>">
                                 </div>
                              </div>
                              <!-- col-4 -->
                              <div class="col-lg-4">
                                 <label class="form-control-label">Guardian's Mobile NO <span
                                    class="tx-danger">*</span></label>
                                 <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
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
                              </div>
                              <!-- col-4 -->
                           </div>
                           <!-- row -->
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
                              <div class="col-md-4">
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
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label class="form-control-label">Twelfth passed / 3 year Diploma details<span class="tx-danger"> *</span></label>
                                 <select class="form-control select2" data-placeholder="Choose Current Qualification Status" tabindex="-1" aria-hidden="true" name="current_qualification_status" id="current_qualification_status">
                                    <option value=""><?php echo $current_qualification_status; ?> </option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-6 ">
                              <div class="form-group wd-xs-300 mr-5 w-100">
                                 <label class="form-control-label">Candidate's Name as in 10th Certificate<span class="tx-danger"> *</span></label>
                                 <div class="form-group mg-b-10-force">
                                    <input class="form-control" type="text" name="candidate_name" id="candidate_name" placeholder="Candidate's Name" value="<?php echo $name_as_in_marksheet; ?>">
                                 </div>
                              </div>
                              <!-- form-group -->
                           </div>
                        </div>
                        <section class="row">
                           <div class="table-responsive">
                              <table class="table table-bordered mt-3">
                                 <label class="text-primary mb-3">Tenth Details
                                 </label>
                                 <thead class="thead-light">
                                    <tr>
                                       <th>
                                       </th>
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
                                          <p>.</p>
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" name="academic_tenth_inst" id="academic_tenth_inst" value="<?php echo $inst_name_tenth; ?>">
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control select2 academic_board" name="academic_board" id="academic_board">
                                                <option value=""><?php echo $board_tenth; ?></option>
                                             </select>
                                          </div>
                                          <?php if($board_id_tenth==OTHER_BOARD) { ?>
                                          <div class="form-group" id="other_board1">
                                             <input type="text" class="form-control" name="other_tenth_board" id="other_tenth_board" placeholder="If Other, please enter here.." maxlength="100"  value="<?php echo $other_board_name_tenth; ?>">
                                          </div>
                                          <?php } ?>
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control select2" name="academic_mode_of_study" id="academic_mode_of_study">
                                                <option value=""><?php echo $mode_of_study_name_tenth; ?></option>
                                             </select>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control select2" name="academic_marking_scheme" id="academic_marking_scheme">
                                                <option value=""><?php echo $marking_scheme_name_tenth; ?></option>
                                             </select>
                                          </div>
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" name="academic_obtain_cgpa" id="academic_obtain_cgpa" value="<?php echo $mark_percentage_tenth; ?>">
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <input class="form-control" value="<?php echo $completion_year_tenth; ?>">
                                          </div>
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" name="academic_reg_no" id="academic_reg_no" value="<?php echo $registration_no_tenth; ?>">
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                           <div class="table-responsive">
                              <table class="table table-bordered mt-3">
                                 <label class="text-primary mb-3">Twelfth / 3 Year Diploma Details
                                 </label>
                                 <thead class="thead-light">
                                    <tr>
                                       <th>
                                       </th>
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
                                          <p>.</p>
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" name="academic_twelfth_inst" id="academic_twelfth_inst" value="<?php echo $inst_name_twelfth; ?>">
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control select2 academic_twelfth_board" name="academic_twelfth_board" id="academic_twelfth_board">
                                                <option value=""><?php echo $board_twelfth; ?></option>
                                             </select>
                                          </div>
                                          <?php if($board_id_twelfth==OTHER_BOARD) { ?>
                                          <div class="form-group" id="other_board1">
                                             <input type="text" class="form-control" name="other_tenth_board" id="other_tenth_board" placeholder="If Other, please enter here.." maxlength="100"  value="<?php echo $other_board_name_twelfth; ?>">
                                          </div>
                                          <?php } ?>
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control select2" name="academic_mode_of_study_twelfth" id="academic_mode_of_study_twelfth">
                                                <option value=""><?php echo $mode_of_study_name_twelfth; ?></option>
                                             </select>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control select2" name="academic_marking_scheme_twelfth" id="academic_marking_scheme_twelfth">
                                                <option value=""><?php echo $marking_scheme_name_twelfth; ?></option>
                                             </select>
                                          </div>
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" name="academic_obtain_cgpa_twelfth" id="academic_obtain_cgpa_twelfth" value="<?php echo $mark_percentage_twelfth; ?>">
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <input class="form-control" value="<?php echo $completion_year_twelfth; ?>">
                                          </div>
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" name="academic_reg_no_twelfth" id="academic_reg_no_twelfth" value="<?php echo $registration_no_twelfth; ?>">
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control select2" name="academic_stream" id="academic_stream">
                                                <option value=""><?php echo $stream_name; ?></option>
                                             </select>
                                          </div>
                                          <?php if($stream_id==OTHER_STREAM) { ?>
                                          <div class="form-group" id="other_board2" >
                                             <input type="text" class="form-control" name="other_twelfth_board" id="other_twelfth_board" placeholder="If Other, please enter here.." maxlength="100" value="<?php echo $other_stream_name; ?>">
                                          </div>
                                          <?php  } ?>						   
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                           <p class="w-100">For Diploma holders,please choose Other option in Board and Stream column
                              and fill with your respective board and type of diploma in others field
                           </p>
                           <label class="text-primary mb-3" style="<?php echo $styleGrad; ?>">Graduation Details</label>
                           <div class="table-responsive" id="dde_graduation_details" style="<?php echo $styleGrad; ?>">
                              <table class="table table-bordered mt-3">
                                 <thead class="thead-light">
                                    <tr>
                                       <th></th>
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
                                          <input class="form-control" type="text" name="academic_graduation_inst" id="academic_graduation_inst" value="<?php echo $grad_inst_name; ?>">
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control select2" name="academic_graduation_university" id="academic_graduation_university">
                                                <option value=""><?php echo $grad_university_name; ?></option>
                                             </select>
                                          </div>
                                          <?php if($grad_university_id==OTHER_UNIVERSITY) { ?>
                                          <div class="form-group" id="other_board1">
                                             <input type="text" class="form-control" name="other_tenth_board" id="other_tenth_board" placeholder="If Other, please enter here.." maxlength="100"  value="<?php echo $grad_university_other_name; ?>">
                                          </div>
                                          <?php } ?>							  
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control select2" name="academic_marking_scheme_graduation" id="academic_marking_scheme_graduation">
                                                <option value=""><?php echo $grad_mark_scheme_name; ?></option>
                                             </select>
                                          </div>
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" name="academic_obtain_cgpa_graduation" id="academic_obtain_cgpa_graduation" value="<?php echo $mark_percentage_graduation; ?>">
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control select2" name="academic_yr_passing_graduation" id="academic_yr_passing_graduation">
                                                <option value=""  selected="selected"><?php echo $grad_yr_of_passing; ?></option>
                                             </select>
                                          </div>
                                       </td>
                                       <td>
                                          <input class="form-control" type="text" name="academic_reg_no_graduation" id="academic_reg_no_graduation" value="<?php echo $reg_no_graduation; ?>">
                                       </td>
                                       <td>
                                          <div class="form-group mg-b-10-force">
                                             <select class="form-control select2" name="graduation_degree" id="graduation_degree">
                                                <option value=""><?php echo $grad_deg_name;?></option>
                                             </select>
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
                                       <select class="form-control select2" name="part_lang_prefer" id="part_lang_prefer">
                                          <option value=""  selected="selected"><?php echo $getlang_semester; ?></option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group mg-b-10-force">
                                       <label>Choose one of the following "Learner Support Centers" </label>
                                       <select class="form-control select2" name="learning_support_center" id="learning_support_center">
                                          <option value=""  selected="selected"><?php echo $learning_support_center; ?></option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="w-100 mt-3">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="d-block mb-3 w-100 text-left">Do you have any Work Experience? :</label>
                                       <div class="custom-control custom-radio custom-control-inline">
                                          <input type="radio" id="is_work_experience_yes" name="is_work_experience" class="custom-control-input is_exp" <?php echo ($is_work_experience == 't')?'checked':''; ?> value="yes" data-parsley-mincheck="1">
                                          <label class="custom-control-label" for="is_work_experience_yes">Yes</label>
                                       </div>
                                       <div class="custom-control custom-radio custom-control-inline">
                                          <input type="radio" id="is_work_experience_no" name="is_work_experience" class="custom-control-input" <?php echo ($is_work_experience == 'f')?'checked':''; ?> value="no" data-parsley-mincheck="1">
                                          <label class="custom-control-label" for="is_work_experience_no">No</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="table-responsive">
                              <table class="table table-bordered mt-3" id="pro_exp" style="<?php if($is_work_experience=='f'){echo "display:none";}else{echo "display:block";}?>">
                                 <label class="text-primary mb-3 w-100 hide_present" style="<?php if($is_work_experience=='f'){echo "display:none";}else{echo "display:block";}?>">Professional Experience (Start From The Present Employer)
                                 </label>
                                 <thead class="thead-light">
                                    <tr>
                                       <th>
                                       </th>
                                       <th>Organisation's Name  </th>
                                       <th>Designation  </th>
                                       <th>Nature of Job </th>
                                       <th>Total Salary /Month  </th>
                                       <th>From Year</th>
                                       <th> To Year </th>
                                       <th>Work Experience(In Months)  </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td nowrap="">1.</td>
                                       <td>
                                          <input class="form-control" type="hidden" placeholder="" id="prof_exp_id_0" name="prof_exp_id_0" value="<?php echo $applicant_prof_exp_id[0]; ?>">
                                          <div class="form-group"><input type="text" name="organisation_name_0" id="organisation_name_0" class="form-control" placeholder="" value="<?php echo $applicant_prof_exp_org_name[0]; ?>"></div>
                                          <span class="tx-danger required_asterisk">*</span>
                                       </td>
                                       <td>
                                          <div class="form-group"><input type="text" name="designation_0" id="designation_0" class="form-control" placeholder="" value="<?php echo $applicant_prof_exp_designation[0]; ?>"></div>
                                          <span class="tx-danger required_asterisk">*</span>
                                       </td>
                                       <td>
                                          <div class="form-group"><input type="text" name="nature_of_job_0" id="nature_of_job_0" class="form-control" placeholder="" value="<?php echo $applicant_prof_exp_job_nature[0]; ?>"></div>
                                          <span class="tx-danger required_asterisk">*</span>
                                       </td>
                                       <td>
                                          <div class="form-group"><input type="text" name="total_salary_month_0" id="total_salary_month_0" class="form-control" placeholder="" value="<?php echo $applicant_prof_exp_salary[0]; ?>"></div>
                                          <span class="tx-danger required_asterisk">*</span>
                                       </td>
                                       <td>
                                          <div class="form-group"><input readonly="" type="text" name="from_year_0" id="from_year_0" class="form-control datepicker" placeholder="MM/YYYY" value="<?php echo $applicant_prof_exp_from_date[0]; ?>"></div>
                                          <span class="tx-danger required_asterisk">*</span>
                                       </td>
                                       <td>
                                          <div class="form-group"><input readonly="" type="text" name="to_year_0" id="to_year_0" class="form-control datepicker" placeholder="MM/YYYY" value="<?php echo $applicant_prof_exp_to_date[0]; ?>"></div>
                                          <span class="tx-danger required_asterisk">*</span>
                                       </td>
                                       <td>
                                          <div class="form-group"><input type="text" name="work_experience_0" id="work_experience_0" class="form-control" placeholder="" readonly="readonly" value="<?php echo $applicant_prof_exp_work_exp_in_months[0]; ?>"></div>
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
                        </section>
                        <div class="row" id="emp_total_exp" style="<?php if($is_work_experience=='f'){echo "display:none";}else{echo "display:block";}?>">
                           <div class="col-md-3 blank_space">
                              <div class="form-group"></div>
                           </div>
                           <div class="col-md-3 blank_space">
                              <div class="form-group"></div>
                           </div>
                           <div class="col-md-3 blank_space">
                              <div class="form-group"></div>
                           </div>
                           <div class="col-md-3" style="display: block;float:right;">
                              <div class="form-group">
                                 <label class=" control-label" for="radios">Total Work Experience in Months</label>
                                 <input type="text" name="total_work_experience" id="total_work_experience" class="form-control" placeholder="Total Work Experience" readonly="readonly" maxlength="5" value="<?php echo $total_applicant_prof_exp_work_exp_in_months; ?>">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Geetha -->

               <div class="card">

               <div class="card card_print" id="preview_payment">

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
                                                   District<br>Tamil Nadu, India 
                                                </div>
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
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix"> Upload & Declaration</button>
                     </h2>
                  </div>
                  <div id="collapseSix" class="collapse show bg-light" aria-labelledby="headingSix" data-parent="#accordionExample">
                     <div class="card-body">
                        <section class="row">
                           <div class="col-md-12">
                              <div class="form-layout">
                                 <div class="row mg-b-25 mt-3">
                                    <div class="row w-100">
                                       <div class="form-group col-md-6 ">
                                          <label for="exampleFormControlTextarea1">Upload Your Recent Passport Size Photograph <span class="tx-danger">*</span></label>
                                          <input type="file" class="filestyle" name="photograph" id="photograph" data-parsley-required="<?php echo ((isset($docs[$document_id_photograph]))?'false':'true'); ?>" data-parsley-required-message="Please upload photograph" data-parsley-errors-container="#custom-photograph-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_photograph])){ echo $docs[$document_id_photograph]['id']; } ?>">
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
                                          <input type="file" class="filestyle" name="signature" id="signature" data-parsley-required="<?php echo ((isset($docs[$document_id_signature]))?'false':'true'); ?>" data-parsley-required-message="Please upload signature" data-parsley-errors-container="#custom-signature-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_signature])){ echo $docs[$document_id_signature]['id']; } ?>">
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
                                          <input type="file" class="filestyle" name="tenth_marksheet" id="tenth_marksheet" data-parsley-required="<?php echo ((isset($docs[$document_id_tenth_marksheet]))?'false':'true'); ?>" data-parsley-required-message="Please upload 10th marksheet" data-parsley-errors-container="#custom-tenth_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_tenth_marksheet])){ echo $docs[$document_id_tenth_marksheet]['id']; } ?>">
                                          <?php if(isset($docs[$document_id_tenth_marksheet])){ ?>
                                          <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_tenth_marksheet; ?>">
                                             <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_tenth_marksheet; ?>')">&times;</a>
                                             <strong id="deleteMessageStatus_<?php echo $document_id_tenth_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_tenth_marksheet; ?>"></span>
                                          </div>
                                          <?php } ?>
                                          <span id="custom-tenth_marksheet-parsley-error"></span>
                                       </div>
                                       <div class="form-group col-md-6">
                                          <label for="exampleFormControlTextarea1">Upload Your 12th Marksheet <span class="tx-danger">*</span></label>
                                          <input type="file" class="filestyle" name="twelvfth_marksheet" id="twelvfth_marksheet" data-parsley-required="<?php echo ((isset($docs[$document_id_twelvfth_marksheet]))?'false':'true'); ?>" data-parsley-required-message="Please upload 12th marksheet" data-parsley-errors-container="#custom-twelvfth_marksheet-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_twelvfth_marksheet])){ echo $docs[$document_id_twelvfth_marksheet]['id']; } ?>">
                                          <?php if(isset($docs[$document_id_twelvfth_marksheet])){ ?>
                                          <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_twelvfth_marksheet; ?>">
                                             <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_twelvfth_marksheet; ?>')">&times;</a>
                                             <strong id="deleteMessageStatus_<?php echo $document_id_twelvfth_marksheet; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_twelvfth_marksheet; ?>"></span>
                                          </div>
                                          <?php } ?>
                                          <span id="custom-twelvfth_marksheet-parsley-error"></span>
                                       </div>
                                    </div>
                                    <div class="row w-100" id="graduation_certificate" style="<?php echo $current_qualification_status_style; ?>">
                                       <div class="form-group col-md-6">
                                          <label for="exampleFormControlTextarea1">Upload Your Provisional Certificate <span class="tx-danger">*</span></label>
                                          <input type="file" class="filestyle" name="provisional_certificate" id="provisional_certificate" data-parsley-required="<?php echo ((isset($docs[$document_id_provsional_certicate]))?'false':'true'); ?>" data-parsley-required-message="Please upload provisional certificate" data-parsley-errors-container="#custom-provisional_certificate-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo FILE_ALLOWED_TYPE; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_provsional_certicate])){ echo $docs[$document_id_provsional_certicate]['id']; } ?>" accept="<?php  echo allow_extension($file_allowed_type); ?>">
                                          <?php if(isset($docs[$document_id_provsional_certicate])){ ?>
                                          <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_<?php echo $document_id_provsional_certicate; ?>">
                                             <a href="#" class="close" onclick="hideAlert('deleteMessage_<?php echo $document_id_provsional_certicate; ?>')">&times;</a>
                                             <strong id="deleteMessageStatus_<?php echo $document_id_provsional_certicate; ?>"></strong> <span id="deleteMessageSpan_<?php echo $document_id_provsional_certicate; ?>"></span>
                                          </div>
                                          <?php } ?>
                                          <span id="custom-provisional_certificate-parsley-error"></span>
                                       </div>
                                       <div class="form-group col-md-6 ">
                                          <label for="exampleFormControlTextarea1">Upload Your Graduation Marksheet <span class="tx-danger"></span></label>
                                          <input type="file" class="filestyle" name="graduation_marksheet" id="graduation_marksheet" data-parsley-required="<?php echo ((isset($docs[$document_id_graduation_marksheet]))?'false':'true'); ?>" data-parsley-required-message="Please upload graduation_marksheet" data-parsley-errors-container="#custom-graduation_marksheet-parsley-error"data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>" onchange="upload_file(this.id)" data-file-id="<?php if(isset($docs[$document_id_graduation_marksheet])){ echo $docs[$document_id_graduation_marksheet]['id']; } ?>"accept="<?php  echo allow_extension($file_allowed_type); ?>">
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
                                          <input class="form-control" type="text" name="ddate" id="ddate" value="<?php echo $ddate; ?>" readonly>
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