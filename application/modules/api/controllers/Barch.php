<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package SRM - Online Application
 * @category Barch API
 
 *
 * @SWG\Resource(
 *  apiVersion="0.1",
 *  swaggerVersion="1.2",
 *  resourcePath="/api",
 *  produces="['application/json']"
 * )
 *
 */
class Barch extends API_Controller {

	public function __construct()
	{		
		parent::__construct();
		$this->load->library('form_validation');
	}


	 /*BArch_design API Start*/
	/*BArch_design API Start*/
	public function barch_basic_detail_post()
	{
		$app_form_id_barch = APP_FORM_ID_BARCH;
    	$applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
    	$applicant_appln_det_table = APPLICANT_APPLN;
    	$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$qualifyingexamfromindia = $this->post('qualifyingexamfromindia',true);
		$appln_status = $this->post('appln_status',true);
		$applicant_appln_det_columns = 'applicant_personal_det_id,appln_form_id,qualifyingexamfromindia,is_agree,active,grad_id';		
		if($qualifyingexamfromindia) {
			$is_agree = 't';
		} else {
			$is_agree = 'f';
		}
		$application_inprogress_id = APPLICATION_IN_PROGRESS;
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		$_POST['appln_form_id'] = $app_form_id_barch;		
		$_POST['is_agree']=$is_agree;		
		$_POST['qualifyingexamfromindia'] = $qualifyingexamfromindia;
		$_POST['application_status_id'] = 	$application_inprogress_id;
		$_POST['grad_id'] = BARCH_GRADUATION_ID;
		$applicant_appln_det_res =$this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_barch);
        $applicant_appln_id = $applicant_appln_det_res['id'];
        if($applicant_appln_id != '' && $appln_status != APPLICATION_IN_COMPLETED){
        	$_POST['applicant_appln_id']=$applicant_appln_id;
        	$applicant_appln_det_columns .= ',applicant_appln_id,application_status_id';
        }
       	$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('qualifyingexamfromindia', 'Have you studied from India?','trim');
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}
		$function_name = $this->get_function_name(__FUNCTION__);
		if($applicant_appln_id == '') {			
			$applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns,false,'applicant_appln_id',false,$app_form_id_barch);
		} else {
			$applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns, 1, 'applicant_appln_id', $applicant_appln_id,$app_form_id_barch);
		}
		if($applicant_appln_det_res)
		{
			// common_application_status_update for Application inprogress status update purpose
			
			/*$application_inprogress_id = APPLICATION_IN_PROGRESS;
			$wizard_update = $this->common_application_status_update($applicant_personal_det_id, $applicant_appln_id,$application_inprogress_id);*/
			
			// End of common_application_status_update for Application inprogress status update purpose
			
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_BARCH , FORM_WIZARD_BASIC_ID);
			
			
		}
		$this->response ($applicant_appln_det_res , API_Controller::HTTP_OK);
	}

	public function barch_personal_detail_post() 
	{ 

		$applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
		$applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
		$applicant_course_prefer_table = APPLICANT_COURSE_PREFER_TABLE;
		$applicant_campus_prefer_table = APPLICANT_CAMPUS_PREFER_TABLE;
		$applicant_city_prefer_table = APPLICANT_CITY_PREFER_TABLE;
		$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';

		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);				

		$applicant_course_pref_id = $this->post('course_prefer_id',true);
		$course_pref_id = json_decode($applicant_course_pref_id,true);
		

		$course_pref = $this->post('course_pref',true);
		$course_pref = json_decode($course_pref,true);

		$course_choice_no = $this->post('course_choice_no',true);
		$course_choice_no = json_decode($course_choice_no,true);

		$applicant_campus_prefer_id = $this->post('campus_prefer_id',true);
		$campus_prefer_id = json_decode($applicant_campus_prefer_id,true);
		
		$campus_choice_no = $this->post('campus_choice_no',true);
		$campus_choice_no = json_decode($campus_choice_no,true);

		$campus_pref = $this->post('campus_pref',true);
		$campus_pref = json_decode($campus_pref,true);
		
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;

		$blood_grp_id_post	= $this->input->post('blood_grp_id');
		$religion_id_post	= $this->input->post('religion_id');
		$sourceid_post	= $this->input->post('advertisement_source_id');
		$prefer_hostel_post	= $this->input->post('prefer_hostel');
		$mother_tongue_post=$this->input->post('mothertongue_id');
		$medofinst_post=$this->input->post('medofinst');
		$social_status_post = $this->input->post('social_status_id');
		$phone_no_code = $this->input->post('mobile_no_code');
		$_POST['applicant_mob_country_code_id'] = $phone_no_code;
		
		$applicant_personal_det_columns = 'applicant_personal_det_id,title_id,first_name,middle_name,last_name,mobile_no,email_id,dob,gender_id,second_email_id,active,nationality_id,diff_abled,blood_grp_id,religion_id,prefer_hostel,advertisement_source_id,mothertongue_id,social_status_id,applicant_mob_country_code_id';

		$religion_id_post=($religion_id_post!='' && $religion_id_post!='null')?$religion_id_post : NULL;
		$prefer_hostel_post=($prefer_hostel_post!='' && $prefer_hostel_post!='null')?$prefer_hostel_post : NULL;
		$sourceid_post=($sourceid_post!='' && $sourceid_post!='null')?$sourceid_post : NULL;
		$mother_tongue_post=($mother_tongue_post!='' && $mother_tongue_post!='null')?$mother_tongue_post : NULL;
		$social_status_post=($social_status_post!='' && $social_status_post!='null')?$social_status_post : NULL;
		
		$_POST['religion_id'] = $religion_id_post;
		$_POST['prefer_hostel'] = $prefer_hostel_post;
		$_POST['advertisement_source_id'] = $sourceid_post;
		$_POST['mothertongue_id'] = $mother_tongue_post;
		$_POST['social_status_id'] = $social_status_post;

		$medofinst_post=($medofinst_post!='' && $medofinst_post!='null')?$medofinst_post : NULL;
		$_POST['medofinst'] = $medofinst_post;

		$applicant_other_details_columns = 'applicant_personal_det_id,active,applicant_appln_id,medofinst';
		

		$applicant_course_prefer_columns = 'applicant_personal_det_id,course_id,course_name,choice_no,active,applicant_appln_id';
		if($applicant_specialization_pref_id) {
			$applicant_course_prefer_columns .= ',applicant_course_prefer_id';	
		}
		
		$applicant_campus_prefer_columns = 'applicant_personal_det_id,campus_id,campus_name,choice_no,active,applicant_appln_id';
		if($applicant_campus_prefer_id) {
			$applicant_campus_prefer_columns .= ',applicant_campus_prefer_id';	
		}
		
		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('course_pref[0]', 'Course Preference 1','trim|required');
		//$this->form_validation->set_rules('specialization_pref[0]', 'Specialization Preference 1','trim|required');
		$this->form_validation->set_rules('campus_pref[0]', 'Campus Preference 1','trim|required');		
		$this->form_validation->set_rules('first_name', 'First Name','trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name','trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile No','trim|required');
		$this->form_validation->set_rules('email_id', 'Email Id','trim|required');
		$this->form_validation->set_rules('dob', 'Date Of Birth','trim|required');
		$this->form_validation->set_rules('gender_id', 'Gender','trim|required');
		//$this->form_validation->set_rules('social_status_id', 'Community','trim|required');
		$this->form_validation->set_rules('title_id', 'Title','trim|required');
		$this->form_validation->set_rules('blood_grp_id', 'Blood Group','trim|required');
		$this->form_validation->set_rules('diff_abled', 'Differently Abled','trim|required');
		$this->form_validation->set_rules('nationality_id', 'Nationality','trim|required');
		//$this->form_validation->set_rules('medofinst', 'Medium of Instruction','trim|required');
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}
		$app_form_id = APP_FORM_ID_BARCH;

		$deg_id = 	BARCH_DEGREE_ID;
		$grad_id = 	BARCH_GRADUATION_ID;


		// get course prefer id - prog id
		$applicant_course_prefer_res = $this->_get_prog_id_by_preference_dtl($grad_id, false, $app_form_id, $course_pref);
		

		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
		$applicant_appln_id = $applicant_appln_det_res['id'];
		$_POST['applicant_appln_id'] = $applicant_appln_id;

		$function_name = $this->get_function_name(__FUNCTION__);
		//  applicant_personal_det insert / update
		$applicant_personal_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns);
		
		//$med_inst_val = $this->post('medofinst',true);
		//$med_inst_val = ($med_inst_val!='null') ? $med_inst_val:'';
		//$_POST['medofinst'] = $med_inst_val;

		//  applicant_other_details insert / update
		$other_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_other_details_table, $applicant_other_details_columns,false,'applicant_other_det_id');

	
		// course_pref
		$specialization_res = array();
		
		
		if($course_pref) {
			foreach($course_pref as $k=>$v) {
				$n_course_pref = $v;
				//$n_specialization_pref = $course_pref[$k];
				//$n_specialization_pref = 36;
				$n_specialization_pref = $applicant_course_prefer_res[$k];
				$n_specialization_pref_id = $course_pref_id[$k];
				$n_specialization_choice_no = $course_choice_no[$k];

				$n_course_pref=($n_course_pref!='' && $n_course_pref!='null')?$n_course_pref : NULL;
				$n_specialization_pref=($n_specialization_pref!='' && $n_specialization_pref!='null')?$n_specialization_pref : NULL;
				
				$_SERVER["REQUEST_METHOD"] = "POST";
				$_POST = array();
				if($n_specialization_pref_id) {
					$_POST['applicant_course_prefer_id'] = $n_specialization_pref_id;	
				}
				
				$_POST['choice_no'] = $n_specialization_choice_no;
				$_POST['course_id'] = $n_specialization_pref;
				$_POST['applicant_appln_id'] = $applicant_appln_id;
				$_POST['active'] = TRUE;
				
				
				if($n_specialization_pref_id) {
					/*$specialization_res[] = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_course_prefer_table, $applicant_course_prefer_columns, 1, 'applicant_course_prefer_id', $n_course_prefer_id);*/
					if(!$n_specialization_pref)
					{
						$wheredel = array();
            			$wheredel['applicant_personal_det_id'] = $applicant_personal_det_id;
            			$wheredel['applicant_appln_id'] = $applicant_appln_id;
            			$wheredel['applicant_course_prefer_id'] = $n_specialization_pref_id;
            			$wheredel['table_schema'] = SCHEMA_ADMISSION;
            			$this->common->common_delete_new ( $applicant_course_prefer_table , $wheredel );
					}
					else
					{
						$specialization_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'applicant_course_prefer_id'=>$n_specialization_pref_id), $table_schema, $applicant_course_prefer_table, $applicant_course_prefer_columns, 2, 'applicant_course_prefer_id', $n_specialization_pref_id);
					}
				} else {
					$chk_flag = false;
					if(!$n_specialization_pref) {
						$chk_flag = true;
					}
					if(!$chk_flag) {
						$specialization_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_course_prefer_table, $applicant_course_prefer_columns, 1, 'applicant_course_prefer_id');
						/*$specialization_res[] = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_course_prefer_table, $applicant_course_prefer_columns, false, 'applicant_course_prefer_id');*/
					}
				}
			}
		}





		// campus_pref
		$campus_pref_res = array();
		if($campus_pref) {
			foreach($campus_pref as $k=>$v) {
				$n_campus_pref = $v;
				$n_campus_prefer_id = $campus_prefer_id[$k];
				$n_campus_choice_no = $campus_choice_no[$k];

				$n_course_pref = $course_pref[$k];
				//$n_specialization_pref = $specialization_pref[$k];
				
				$_SERVER["REQUEST_METHOD"] = "POST";
				$_POST = array();
				if($n_campus_prefer_id) {
					$_POST['applicant_campus_prefer_id'] = $n_campus_prefer_id;	
				}

				$n_campus_pref=($n_campus_pref!='' && $n_campus_pref!='null')?$n_campus_pref : NULL;

				$_POST['campus_id'] = $n_campus_pref;
				$_POST['choice_no'] = $n_campus_choice_no;
				$_POST['applicant_appln_id'] = $applicant_appln_id;
				$_POST['active'] = TRUE;
				$_POST['applicant_personal_det_id']=$applicant_personal_det_id;


				if($n_campus_prefer_id) {
					if(!$n_campus_pref)
					{
						$wheredel = array();
            			$wheredel['applicant_personal_det_id'] = $applicant_personal_det_id;
            			$wheredel['applicant_appln_id'] = $applicant_appln_id;
            			$wheredel['applicant_campus_prefer_id'] = $n_campus_prefer_id;
            			$wheredel['table_schema'] = SCHEMA_ADMISSION;
            			$this->common->common_delete_new ( $applicant_campus_prefer_table , $wheredel );
					}
					else
					{
						$campus_pref_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'applicant_campus_prefer_id'=>$n_campus_prefer_id), $table_schema, $applicant_campus_prefer_table, $applicant_campus_prefer_columns, 2, 'applicant_campus_prefer_id', $n_campus_prefer_id);	
					}
					
				} else {					
					$chk_flag = false;
					if(!$n_campus_pref) {
						$chk_flag = true;
					}
					if(!$chk_flag) {
						/*$campus_pref_res[] = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_campus_prefer_table, $applicant_campus_prefer_columns, false, 'applicant_campus_prefer_id');*/
						$campus_pref_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_campus_prefer_table, $applicant_campus_prefer_columns, 1, 'applicant_campus_prefer_id');
					}
				}
			}
		}







		$this->_get_error_status($specialization_res);
		$this->_get_error_status($campus_pref_res);

		if($other_res) {
			if($other_res['status'] == 'error') {
				$this->response ($other_res , API_Controller::HTTP_OK);
			} else {
				$applicant_personal_det_res['other_res'] = $other_res;
			}
		}
		if($specialization_res) {
			$applicant_personal_det_res['specialization_res'] = $specialization_res;
		}
		if($campus_pref_res) {
			$applicant_personal_det_res['campus_pref_res'] = $campus_pref_res;
		}

		if($applicant_personal_det_res)
		{
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_BARCH , FORM_WIZARD_PERSONAL_ID);
		}

		$this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);

	}


	public function barch_parent_detail_post() {
    	$app_form_id = APP_FORM_ID_BARCH;
    	$applicant_parent_det_table = APPLICANT_PARENT_DET_TABLE;
    	$applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
    	$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$father_parent_det_id = $this->post('father_parent_det_id',true);
		$mother_parent_det_id = $this->post('mother_parent_det_id',true);
		$guardian_parent_det_id = $this->post('guardian_parent_det_id',true);
		$user_data = $this->post();		
		$add_guardian_details = $user_data['add_guardian_details'];
		if($add_guardian_details=="true"){
			$add_gardian = 't';
		}else{
			$add_gardian = 'f';
		}

		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
		$applicant_appln_id = $applicant_appln_det_res['id'];

		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		$_POST['add_gardian'] = $add_gardian;
		$_POST['applicant_appln_id'] = $applicant_appln_id;



		$applicant_other_details_columns = 'applicant_personal_det_id,add_gardian,applicant_appln_id,active';


		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('parent_father_name', 'Father Name','trim|required');
		$this->form_validation->set_rules('father_title', 'Father Title','trim|required');
		$this->form_validation->set_rules('parent_mother_name', 'Mother Name','trim|required');
		$this->form_validation->set_rules('mother_title', 'Mother Title','trim|required');

		if($add_gardian=='t'){
            $this->form_validation->set_rules('parent_guardian_name', 'Gardian Name','trim|required');
            /*$this->form_validation->set_rules('guardian_mobile_no', 'Gardian Mobile','trim|required');
            $this->form_validation->set_rules('guardian_email_id', 'Gardian Email','trim|required');
            $this->form_validation->set_rules('guardian_occupation', 'Gardian Occupation','trim|required');*/
        }
		
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}

		$function_name = $this->get_function_name(__FUNCTION__);
		
		//  applicant_other_details insert / update
		$other_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_other_details_table, $applicant_other_details_columns,false,'applicant_other_det_id');

		
		// Father Detail
		$parent_type_father_id = $user_data['parent_type_father_id'];
		$parent_father_name = $user_data['parent_father_name'];
		$father_mobile_no = $user_data['father_mobile_no'];
		$father_alt_mobile_no = $user_data['father_alt_mobile_no'];
		$father_email_id = $user_data['father_email_id'];
		$father_occupation = $user_data['father_occupation'];
		$father_mob_country_code_id = $user_data['father_mob_country_code_id'];
		$father_alt_mob_country_code_id = $user_data['father_alt_mob_country_code_id'];
		$father_title = $user_data['father_title'];
		$father_other_occupation = $user_data['father_other_occupation'];
		
		// Mother Detail
		$parent_type_mother_id = $user_data['parent_type_mother_id'];
		$parent_mother_name = $user_data['parent_mother_name'];
		$mother_mobile_no = $user_data['mother_mobile_no'];
		$mother_alt_mobile_no = $user_data['mother_alt_mobile_no'];
		$mother_email_id = $user_data['mother_email_id'];
		$mother_occupation = $user_data['mother_occupation'];
		$mother_mob_country_code_id = $user_data['mother_mob_country_code_id'];
		$mother_alt_mob_country_code_id = $user_data['mother_alt_mob_country_code_id'];
		$mother_title = $user_data['mother_title'];	
		$mother_other_occupation = $user_data['mother_other_occupation'];		
		

		$applicant_parent_det_id[] = $father_parent_det_id;
		$parent_type_id[] = $parent_type_father_id;
		$parent_name[] = $parent_father_name;
		$mobile_no[] = $father_mobile_no;
		$alt_mobile_no[] = $father_alt_mobile_no;
		$email_id[] = $father_email_id;
		$occupation[] = $father_occupation;
		$other_occupation[] = $father_other_occupation;
		$mob_country_code_id[] = $father_mob_country_code_id;
		$alt_mob_country_code_id[] = $father_alt_mob_country_code_id;
		$title[] = $father_title;

		$applicant_parent_det_id[] = $mother_parent_det_id;
		$parent_type_id[] = $parent_type_mother_id;
		$parent_name[] = $parent_mother_name;
		$mobile_no[] = $mother_mobile_no;
		$alt_mobile_no[] = $mother_alt_mobile_no;
		$email_id[] = $mother_email_id;
		$occupation[] = $mother_occupation;
		$other_occupation[] = $mother_other_occupation;
		$mob_country_code_id[] = $mother_mob_country_code_id;
		$alt_mob_country_code_id[] = $mother_alt_mob_country_code_id;
		$title[] = $mother_title;
		

		// Guardian Detail
        if($add_gardian=='t'){
            $parent_type_guardian_id = $user_data['parent_type_guardian_id'];
            $parent_guardian_name = $user_data['parent_guardian_name'];
            $guardian_mobile_no = $user_data['guardian_mobile_no'];
            $guardian_alt_mobile_no = $user_data['guardian_alt_mobile_no'];
            $guardian_email_id = $user_data['guardian_email_id'];
            $guardian_occupation = $user_data['guardian_occupation'];
            $guardian_mob_country_code_id = $user_data['guardian_mob_country_code_id'];
            $guardian_alt_mob_country_code_id = $user_data['guardian_alt_mob_country_code_id'];
            $guardian_other_occupation = $user_data['guardian_other_occupation'];
            
            $applicant_parent_det_id[] = $guardian_parent_det_id;
            $parent_type_id[] = $parent_type_guardian_id;
            $parent_name[] = $parent_guardian_name;
            $mobile_no[] = $guardian_mobile_no;
            $alt_mobile_no[] = $guardian_alt_mobile_no;
            $email_id[] = $guardian_email_id;
            $occupation[] = $guardian_occupation;
            $other_occupation[] = $guardian_other_occupation;
            $mob_country_code_id[] = $guardian_mob_country_code_id;
            $title[] = $guardian_title;
        }


        if($add_gardian=='f'){  
            $whereparentgno = array();            
            $whereparentgno['applicant_personal_det_id'] = $applicant_personal_det_id;
            $whereparentgno['parent_type_id'] = $user_data['parent_type_guardian_id'];
            $whereparentgno['applicant_appln_id'] = $applicant_appln_id;
            $whereparentgno['table_schema'] = SCHEMA_ADMISSION;
            $this->common->common_delete_new ( $applicant_parent_det_table , $whereparentgno );
        }
		// parent detail
		$parent_res = array();
		
		if($parent_type_id) {
			foreach($parent_type_id as $k=>$v) {
				$n_parent_type_id = $v;
				$n_applicant_parent_det_id = $applicant_parent_det_id[$k];				
				$n_parent_name = $parent_name[$k];
				$n_mobile_no = $mobile_no[$k];
				$n_alt_mobile_no = $alt_mobile_no[$k];
				$n_email_id = $email_id[$k];
				$n_occupation = $occupation[$k];
				$n_mob_country_code_id = $mob_country_code_id[$k];
				$n_alt_mob_country_code_id = $alt_mob_country_code_id[$k];
				$n_title = $title[$k];
				
				$_SERVER["REQUEST_METHOD"] = "POST";
				$_POST = array();

				$applicant_parent_det_columns = 'applicant_personal_det_id,applicant_appln_id,parent_type_id,parent_name,mobile_no,email_id,occupation_id,active,mob_country_code_id,title_id,alt_mob_countrycode_id,alt_mobile_no';
				if($n_applicant_parent_det_id) {
					$_POST['applicant_parent_det_id'] = $n_applicant_parent_det_id;	
					$applicant_parent_det_columns .= ',applicant_parent_det_id';
				}

				if($n_occupation==OTHER_OCCUPATION)
                {
                    $applicant_parent_det_columns .= ',other_occupation_name';
                    $_POST['other_occupation_name'] = $other_occupation[$k];
                }else{
                    $applicant_parent_det_columns .= ',other_occupation_name';
                    $_POST['other_occupation_name'] = NULL;
                    
                }

                $n_occupation_post=($n_occupation!='' && $n_occupation!='null')?$n_occupation : NULL;
                $n_alt_mob_country_code_id_post=($n_alt_mob_country_code_id!='' && $n_alt_mob_country_code_id!='null')?$n_alt_mob_country_code_id : NULL;
                $n_mob_country_code_id_post=($n_mob_country_code_id!='' && $n_mob_country_code_id!='null')?$n_mob_country_code_id : NULL;

				$_POST['parent_type_id'] = $n_parent_type_id;
				$_POST['parent_name'] = $n_parent_name;
				$_POST['mobile_no'] = $n_mobile_no;
				$_POST['email_id'] = $n_email_id;
				//$_POST['occupation_id'] = $n_occupation;
				//$_POST['mob_country_code_id'] = $n_mob_country_code_id;
				// echo 'alt_mob_countrycode_id => '.$n_alt_mob_country_code_id."\n";
				// echo 'alt_mobile_no => '.$n_alt_mobile_no."\n";
				$_POST['mob_country_code_id'] = $n_mob_country_code_id_post;
				$_POST['alt_mob_countrycode_id'] = $n_alt_mob_country_code_id;
				$_POST['alt_mobile_no'] = $n_alt_mobile_no;
				$_POST['title_id'] = $n_title;
				$_POST['applicant_appln_id'] = $applicant_appln_id;
				$_POST['occupation_id'] = $n_occupation_post;
				$_POST['alt_mob_countrycode_id'] = $n_alt_mob_country_code_id_post;
				$_POST['active'] = TRUE;
				
				
				if($n_applicant_parent_det_id) {					
					$parent_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_parent_det_table, $applicant_parent_det_columns, 1, 'applicant_parent_det_id', $n_applicant_parent_det_id);
				} else {
					$chk_flag = false;
					if(!$n_parent_name) {
						$chk_flag = true;
					}
					if(!$chk_flag) {
						$parent_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_parent_det_table, $applicant_parent_det_columns, 1, 'applicant_parent_det_id');
					}
				}
			}
		}





		$this->_get_error_status($parent_res);

		
		if($other_res) {
			if($other_res['status'] == 'error') {
				$this->response ($other_res , API_Controller::HTTP_OK);
			} else {
				$applicant_personal_det_res['other_res'] = $other_res;
			}
		}

		if($parent_res)
		{
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_BARCH , FORM_WIZARD_PARENT_ID);
			$applicant_personal_det_res['parent_res'] = $parent_res;

		}

		$this->response (
                                [
                                    'status' => TRUE ,
                                    'message' => $applicant_personal_det_res
                                ] , API_Controller::HTTP_OK
                            );
		
    }

    public function barch_acdemic_dtl_post() {
    	$app_form_id_barch = APP_FORM_ID_BARCH;
					
		$applicant_graduation_table = APPLICANT_GRADUATION_TABLE;
		$applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
		$applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
		$applicant_professional_exp_table = APPLICANT_PROFESSIONAL_EXP_TABLE;
		$applicant_publication_det_table = APPLICANT_PUBLICATION_DET_TABLE;
		$applicant_competitive_exam_det_table = APPLICANT_COMPETITIVE_EXAM_DET_TABLE;
		$applicant_schooling_dt_table = APPLICANT_SCHOOLING_TABLE;
		$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$is_competitive_exam = $this->post('is_competitive_exam',true);
		$current_education_qual_status = $this->post('current_education_qual_status',true);
			
		
		$scl_det_id = $this->post('scl_det_id',true);
		$scl_det_id = json_decode($scl_det_id,true);

		$school_institute_name = $this->post('school_institute_name',true);
		$school_institute_name = json_decode($school_institute_name,true);

		$school_board = $this->post('school_board',true);
		$school_board = json_decode($school_board,true);

		$school_mode_of_study = $this->post('school_mode_of_study',true);
		$school_mode_of_study = json_decode($school_mode_of_study,true);

		$school_marking_schema = $this->post('school_marking_schema',true);
		$school_marking_schema = json_decode($school_marking_schema,true);

		$school_obtained_percentage_cgpa = $this->post('school_obtained_percentage_cgpa',true);
		$school_obtained_percentage_cgpa = json_decode($school_obtained_percentage_cgpa,true);

		$school_year_pass = $this->post('school_year_pass',true);
		$school_year_pass = json_decode($school_year_pass,true);

		$school_reg_roll = $this->post('school_reg_roll',true);
		$school_reg_roll = json_decode($school_reg_roll,true);

		$entr_exam_det_id = $this->post('entr_exam_det_id',true);
		$entr_exam_det_id = json_decode($entr_exam_det_id,true);

		$comp_exam_id = $this->post('comp_exam_id',true);
		$comp_exam_id = json_decode($comp_exam_id,true);

		$comp_registration_no = $this->post('comp_registration_no',true);
		$comp_registration_no = json_decode($comp_registration_no,true);

		$comp_score_obtained = $this->post('comp_score_obtained',true);
		$comp_score_obtained = json_decode($comp_score_obtained,true);

		$comp_max_score = $this->post('comp_max_score',true);
		$comp_max_score = json_decode($comp_max_score,true);

		$comp_exam_year = $this->post('comp_exam_year',true);
		$comp_exam_year = json_decode($comp_exam_year,true);

		$comp_all_india_rank = $this->post('comp_all_india_rank',true);
		$comp_all_india_rank = json_decode($comp_all_india_rank,true);

		$comp_qualified = $this->post('comp_qualified',true);
		$comp_qualified = json_decode($comp_qualified,true);

		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_barch);
		$applicant_appln_id = $applicant_appln_det_res['id'];

		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		//$_POST['created_by'] = $applicant_personal_det_id;
		//$_POST['updated_by'] = $applicant_personal_det_id;
		$_POST['applicant_appln_id'] = $applicant_appln_id;
		

		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('current_education_qual_status', 'Current Education Qualification Status','trim|required');
		$this->form_validation->set_rules('name_as_in_marksheet', 'Candidate Name as in 10th Certificate','trim|required');
		$this->form_validation->set_rules('school_institute_name[0]', 'Institute name','trim|required');
		$this->form_validation->set_rules('school_board[0]', '10th Board','trim|required');
		$this->form_validation->set_rules('school_mode_of_study[0]', '10th Mode of Study','trim|required');
		$this->form_validation->set_rules('school_marking_schema[0]', '10th Marking Schema','trim|required');
		$this->form_validation->set_rules('school_obtained_percentage_cgpa[0]', '10th Obtained Percantage','trim|required');
		$this->form_validation->set_rules('school_year_pass[0]', '10th Year Pass','trim|required');
		$this->form_validation->set_rules('school_reg_roll[0]', '10th Roll No','trim|required');
		
		if($current_education_qual_status == 2) {
			$this->form_validation->set_rules('school_marking_schema[1]', '12th Marking Scheme','trim|required');
			$this->form_validation->set_rules('school_obtained_percentage_cgpa[1]', '12th Obtained Percentage/CGPA','trim|required');
			$this->form_validation->set_rules('school_year_pass[1]', '12th Year of Passing','trim|required');
			$this->form_validation->set_rules('school_reg_roll[1]', '12th Register no','trim|required');
		}
		

		if($is_competitive_exam == 'yes')
		{
			$this->form_validation->set_rules('comp_exam_id[0]', 'Competitive Exam Name','trim|required');
			$this->form_validation->set_rules('comp_registration_no[0]', 'Competitive Register no','trim|required');
			$this->form_validation->set_rules('comp_score_obtained[0]', 'Competitive Score Obtained','trim|required');
			$this->form_validation->set_rules('comp_max_score[0]', 'Competitive Max Score','trim|required');
			$this->form_validation->set_rules('comp_exam_year[0]', 'Competitive Year','trim|required');
			$this->form_validation->set_rules('comp_all_india_rank[0]', 'Competitive AIR','trim|required');
			$this->form_validation->set_rules('comp_qualified[0]', 'Competitive Qualified','trim|required');
		}
		

		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}

		$function_name = $this->get_function_name(__FUNCTION__);
		$applicant_schooling_det_columns = 'applicant_scl_det_id,applicant_personal_det_id,applicant_appln_id,institute_name,board_id,marking_scheme_id,mark_percentage,completion_year,registration_no,name_as_in_marksheet,mode_of_study_id,address,schooling_id,active,result_declared,is_curr_qualify';
		if($scl_det_id) {
			//$applicant_schooling_det_columns .= ',updated_by';
		} else {
			//$applicant_schooling_det_columns .= ',created_by';
		}

		$applicant_competitive_exam_det_columns = 'applicant_personal_det_id,comp_exam_id,registration_no,score_obtained,max_score,exam_year,all_india_rank,qualified,active,applicant_appln_id,applicant_entr_exam_det_id';
		if($entr_exam_det_id) {
			//$applicant_competitive_exam_det_columns .= ',updated_by';
		} else {
			//$applicant_competitive_exam_det_columns .= ',created_by';
		}

		$applicant_other_details_columns = 'applicant_personal_det_id,is_competitive_exam,active,applicant_appln_id';

		$applicant_personal_det_columns = 'applicant_personal_det_id,digilocker_id';
		

		if($is_competitive_exam == 'yes') {
			$_POST['is_competitive_exam'] = TRUE;
		} else {
			$_POST['is_competitive_exam'] = FALSE;
			$wheredel = array();
			$wheredel['applicant_personal_det_id'] = $applicant_personal_det_id;
			$wheredel['applicant_appln_id'] = $applicant_appln_id;
			$wheredel['table_schema'] = SCHEMA_ADMISSION;
			$this->common->common_delete_new ( $applicant_competitive_exam_det_table , $wheredel );
		}

		$other_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_other_details_table, $applicant_other_details_columns, false, 'applicant_other_det_id');
	    $app_personal_details_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns);

		
		if($school_institute_name) {
				foreach($school_institute_name as $k=>$v) {
					$n_school_institue_name = $v;
					$n_board = $school_board[$k];
					$n_marking_schema = $school_marking_schema[$k];
					$n_mark_percentage = $school_obtained_percentage_cgpa[$k];
					$n_completion_year = $school_year_pass[$k];
					$n_registration_no = $school_reg_roll[$k];
					$n_name_as_in_marksheet = $this->input->post('name_as_in_marksheet');
					$n_applicant_scl_det_id = $scl_det_id[$k];	
					$n_mode_of_study_id = $school_mode_of_study[$k];
					$_SERVER["REQUEST_METHOD"] = "POST";
					$_POST = array();
					$_POST['result_declared'] = 'f';
					$_POST['is_curr_qualify'] = 'f';						
					if($current_education_qual_status == 2)
					{
						$_POST['result_declared'] = 't';
						$_POST['is_curr_qualify'] = 't';
					}

					/*$this->response (
                                [
                                    'status' => TRUE ,
                                    'data' => $current_education_qual_status ,
                                ] , API_Controller::HTTP_OK
                            );		*/	
					/*print_r($n_name_as_in_marksheet);
					print_r($n_registration_no);
					print_r($n_completion_year);
					print_r($n_mark_percentage);
					print_r($n_marking_schema);
					print_r($n_board);
					print_r($n_school_institue_name);*/								
					if($n_applicant_scl_det_id) {
						$_POST['applicant_scl_det_id'] = $n_applicant_scl_det_id;

					}
						$_POST['institute_name'] = $n_school_institue_name; 
						$_POST['board_id'] = $n_board; 
						//$_POST['marking_scheme_id'] = $n_marking_schema;						
						$_POST['name_as_in_marksheet'] = $n_name_as_in_marksheet; 
						$_POST['applicant_appln_id'] = $applicant_appln_id; 
						$_POST['active'] = TRUE;
						//$_POST['created_by'] = $applicant_personal_det_id;
						//$_POST['updated_by'] = $applicant_personal_det_id;
						$_POST['mode_of_study_id']=$n_mode_of_study_id; 
						$_POST['applicant_personal_det_id']=$applicant_personal_det_id;  
						$n_marking_schema_post=($n_marking_schema !='' && $n_marking_schema !='null')? $n_marking_schema : NULL;
						$n_mark_percentage=($n_mark_percentage !='' && $n_mark_percentage !='null')? $n_mark_percentage : NULL;
						$n_completion_year=($n_completion_year !='' && $n_completion_year !='null')? $n_completion_year : NULL;
						$n_registration_no=($n_registration_no !='' && $n_registration_no !='null')? $n_registration_no : NULL;
						$_POST['marking_scheme_id'] = $n_marking_schema_post; 
						$_POST['mark_percentage'] = $n_mark_percentage; 
						$_POST['completion_year'] = $n_completion_year; 
						$_POST['registration_no'] = $n_registration_no;

						   
					
					if($n_applicant_scl_det_id) {									
								$school_dtl_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, 
									$applicant_schooling_dt_table, 
									$applicant_schooling_det_columns, 1, 'applicant_scl_det_id', $n_applicant_scl_det_id);
								/*$this->response (
                                [
                                    'status' => TRUE ,
                                    'data' => $_POST ,
                                ] , API_Controller::HTTP_OK
                            );  */
								
						}
						else {
						$chk_flag = false;
						/*echo $n_school_institue_name;
						echo $n_marking_schema;
						echo $n_mark_percentage;
						echo $n_completion_year;
						echo $n_registration_no;
						die;*/									
					
						if(!$n_school_institue_name && !$n_marking_schema && !$n_mark_percentage && !$n_completion_year && !$n_registration_no && $current_education_qual_status=2 && !$n_mode_of_study_id && !$n_board) {
								$chk_flag = true;
						}
						else if(!$n_school_institue_name && !$n_mode_of_study_id && !$n_board && $current_education_qual_status=1) {
								$chk_flag = true;
						}
						if(!$chk_flag) {
								// echo 'n_grad_det_id 2'."\n";
								$school_dtl_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_schooling_dt_table, $applicant_schooling_det_columns, 1, 'applicant_scl_det_id');
						}
						

							}
				
				}
		}


		if($is_competitive_exam == 'yes') {
			foreach($comp_exam_id as $k=>$v) {
			$n_comp_exam_id = $v;
			$n_registration_no = $comp_registration_no[$k];
			$n_score_obtained = $comp_score_obtained[$k];
			$n_max_score = $comp_max_score[$k];
			$n_exam_year = $comp_exam_year[$k];
			$n_all_india_rank = $comp_all_india_rank[$k];
			$n_qualified = $comp_qualified[$k];
			$n_applicant_entr_exam_det_id = $entr_exam_det_id[$k];

			   
							
			/*print_r($n_name_as_in_marksheet);
			print_r($n_registration_no);
			print_r($n_completion_year);
			print_r($n_mark_percentage);
			print_r($n_marking_schema);
			print_r($n_board);
			print_r($n_school_institue_name);*/
			if(isset($n_qualified) &&  ($n_qualified== 0))
			{
				$n_qualified ='f';
			}

			/*$this->response (
                                [
                                    'status' => TRUE ,
                                    'data' => $n_qualified ,
                                ] , API_Controller::HTTP_OK

						   ); */
			
			$_SERVER["REQUEST_METHOD"] = "POST";
			$_POST = array();
			if($n_applicant_entr_exam_det_id) {
			$_POST['applicant_entr_exam_det_id'] = $n_applicant_entr_exam_det_id;

			}
			$_POST['registration_no'] = $n_registration_no; 
			$_POST['comp_exam_id'] = $n_comp_exam_id; 
			$_POST['score_obtained'] = $n_score_obtained; 
			$_POST['max_score'] = $n_max_score; 
			$_POST['exam_year'] = $n_exam_year; 
			$_POST['all_india_rank'] = $n_all_india_rank;
			$_POST['qualified'] = $n_qualified; 
			$_POST['applicant_appln_id'] = $applicant_appln_id; 
			$_POST['active'] = TRUE;
			//$_POST['created_by'] = $applicant_personal_det_id;
			//$_POST['updated_by'] = $applicant_personal_det_id;  
			$_POST['applicant_personal_det_id']=$applicant_personal_det_id;  

			/*$this->response (
                                [
                                    'status' => TRUE ,
                                    'data' => $_POST ,
                                ] , API_Controller::HTTP_OK

						   );   */

			if($n_applicant_entr_exam_det_id) {									
			$comp_dtl_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, 
			$applicant_competitive_exam_det_table, 
			$applicant_competitive_exam_det_columns, 1, 'applicant_entr_exam_det_id', $n_applicant_entr_exam_det_id);
			}
			else {
			$chk_flag = false;
			/*echo $n_school_institue_name;
			echo $n_marking_schema;
			echo $n_mark_percentage;
			echo $n_completion_year;
			echo $n_registration_no;
			die;*/
			

			if(!$n_registration_no && !$n_score_obtained && !$n_max_score && !$n_exam_year && !$n_all_india_rank && $n_comp_exam_id == 'null') {
			$chk_flag = true;
			}

			if(!$chk_flag) {				
			// echo 'n_grad_det_id 2'."\n";
			$comp_dtl_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_competitive_exam_det_table, $applicant_competitive_exam_det_columns, 1, 'applicant_entr_exam_det_id');
			}
			}
			}
		}




			

		if($school_dtl_res) {
					$other_res['school_dtl_res'] = $school_dtl_res;
			}
		if($comp_dtl_res) {
					$other_res['comp_dtl_res'] = $comp_dtl_res;
			}

		if($other_res)
		{
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_BARCH , FORM_WIZARD_ACADEMIC_ID);
		}

					$this->response ($other_res , API_Controller::HTTP_OK);
		
			
    }

    public function barch_declaration_detail_post(){

    	$app_form_id = APP_FORM_ID_BARCH;
    	// $applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
    	$applicant_appln_det_table = APPLICANT_APPLN;    	
    	$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$applicant_declaration_date = $this->post('applicant_declaration_date',true);
		$applicant_declaration_date = date('Y-m-d',strtotime($applicant_declaration_date));
		$application_completed = APPLICATION_IN_COMPLETED;
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		//$_POST['updated_by'] = $applicant_personal_det_id;
		$_POST['applicant_declaration_date'] = $applicant_declaration_date;
		$_POST['application_status_id'] = $application_completed;
		$function_name = $this->get_function_name(__FUNCTION__);

		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
		$applicant_appln_id = $applicant_appln_det_res['id'];
		

		$_POST['applicant_appln_id'] = $applicant_appln_id;
		// $applicant_personal_det_columns = 'applicant_personal_det_id,applicant_name,parent_name,declared_date,updated_by,active';
		$applicant_appln_det_columns = 'applicant_appln_id,applicant_personal_det_id,applicant_name_declaration,applicant_parentname_declaration,applicant_declaration_date,active,application_status_id';
		//  applicant_personal_det insert / update
		$applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, array('applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns);
		if($applicant_appln_det_res)
		{
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_BARCH , FORM_WIZARD_UPLOAD_DECLARATION_ID);
			/*$wizard_update = $this->common_application_status_update($applicant_personal_det_id , $applicant_appln_id);*/
		}
		$this->response ($applicant_appln_det_res , API_Controller::HTTP_OK);

    }

	/*BArch_design API End*/

	/*BArch_design API End*/
}