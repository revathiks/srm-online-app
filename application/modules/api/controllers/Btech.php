<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package SRM - Online Application
 * @category btech API
 
 *
 * @SWG\Resource(
 *  apiVersion="0.1",
 *  swaggerVersion="1.2",
 *  resourcePath="/api",
 *  produces="['application/json']"
 * )
 *
 */
class Btech extends API_Controller 
{
	
	public function __construct()
	{		
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function btech_basic_detail_post() {
		
    	$app_form_id_btech = APP_FORM_ID_BTECH;
    	$applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
    	$applicant_appln_det_table = APPLICANT_APPLN;
    	$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$nationality_id = $this->post('nationality_id',true);
		$qualifyingexamfromindia = $this->post('qualifyingexamfromindia',true);
		$applicant_appln_id = $this->post('applicant_appln_id',true);
		$is_agree = $this->post('is_agree',true);
		$appln_status = $this->post('appln_status',true);
		$application_inprogress_id     = APPLICATION_IN_PROGRESS;

		// check i_agree required
		$i_agree_req = false;
		$indian = $nationality_id == COUNTRY_VALUE_DEFAULT;
		if (($qualifyingexamfromindia == 'no' && $indian) || ($qualifyingexamfromindia == 'yes' && !$indian)) {
            if($nationality_id && $qualifyingexamfromindia) {
            	$i_agree_req = true;
            }
        }
        // set val for qualifying exam from india 
		if($qualifyingexamfromindia == 'yes') {
			$qualifyingexamfromindia = 't';
		} else {
			$qualifyingexamfromindia = 'f';
		}
		if($is_agree) {
			$is_agree = 't';
		} else {
			$is_agree = 'f';
		}
		if($applicant_appln_id == 'false') {
			$applicant_appln_id = false;
		}
		// $i_agree = $this->post('i_agree',true);
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		$_POST['appln_form_id'] = $app_form_id_btech;
		$_POST['qualifyingexamfromindia'] = $qualifyingexamfromindia;
		$_POST['application_status_id'] = $application_inprogress_id;
		$_POST['grad_id']=BTECH_GRADUATION_ID;


		
		if($nationality_id) {
			$applicant_personal_det_columns = 'applicant_personal_det_id,nationality_id,active';	
		}
		
		if($qualifyingexamfromindia) {
			$applicant_appln_det_columns = 'applicant_personal_det_id,appln_form_id,qualifyingexamfromindia,is_agree,active,grad_id';	
			if($applicant_appln_id != false) {
				$applicant_appln_det_columns .= ',applicant_appln_id';
			}if($applicant_appln_id != false && $appln_status != APPLICATION_IN_COMPLETED) {
				$applicant_appln_det_columns .= ',application_status_id';
			}
		}
		
		// echo '<pre>';
		// print_r($this->post());
		// echo '</pre>';
		// die;
		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('nationality_id', 'Nationality','trim');
		if($i_agree_req) {
			$this->form_validation->set_rules('is_agree', 'is_agree','trim|required');
		}
		$this->form_validation->set_rules('qualifyingexamfromindia', 'Have you studied from India?','trim');
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}

		$function_name = $this->get_function_name(__FUNCTION__);
		if($nationality_id) {
			//  applicant_personal_det insert / update
			$applicant_personal_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns);
		}
		if($qualifyingexamfromindia) {
			//  applicant_appln_det insert / update
			if($applicant_appln_id == false) {			
				$applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns,false,'applicant_appln_id',false,$app_form_id_btech);
			} else {	
				$applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns, 1, 'applicant_appln_id', $applicant_appln_id,$app_form_id_btech);	
			}
		}
		
		
		if($applicant_appln_det_res) {			
			if($applicant_appln_det_res['status'] == 'error') {
				$this->response ($applicant_appln_det_res , API_Controller::HTTP_OK);
			} else {
				$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_btech , FORM_WIZARD_BASIC_ID);
				$applicant_personal_det_res['appln_status'] = $applicant_appln_det_res;
				
				// common_application_status_update for Application inprogress status update purpose
				
				
				/*$application_inprogress_update = $this->common_application_status_update($applicant_personal_det_id, $applicant_appln_id,$application_inprogress_id);*/
				
				// End of common_application_status_update for Application inprogress status update purpose
				
			}
		}
		$this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
    }

    public function btech_personal_detail_post() {
    	$app_form_id_btech = APP_FORM_ID_BTECH;
    	$grad_id = BTECH_GRADUATION_ID;
    	$deg_id = BTECH_DEGREE_ID;
    	$applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
    	$applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
    	$applicant_course_prefer_table = APPLICANT_COURSE_PREFER_TABLE;
    	$applicant_campus_prefer_table = APPLICANT_CAMPUS_PREFER_TABLE;
    	$applicant_city_prefer_table = APPLICANT_CITY_PREFER_TABLE;
    	$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';
		$applicant_appln_id = '';
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$mobile_no_code = $this->post('mobile_no_code',true);
		$title_id = $this->post('title_id',true);
		$blood_grp_id = $this->post('blood_grp_id',true);
		$mothertongue_id = $this->post('mothertongue_id',true);
		$advertisement_source_id = $this->post('advertisement_source_id',true);
		$second_email_id = $this->post('second_email_id',true);
		$diff_abled = $this->post('diff_abled',true);
		$prefer_hostel = $this->post('prefer_hostel',true);
		$course_prefer_id = $this->post('course_prefer_id',true);
		$course_prefer_id = json_decode($course_prefer_id,true);
		$campus_prefer_id = $this->post('campus_prefer_id',true);
		$campus_prefer_id = json_decode($campus_prefer_id,true);
		$city_prefer_id = $this->post('city_prefer_id',true);
		$city_prefer_id = json_decode($city_prefer_id,true);
		$course_pref = $this->post('course_pref',true);
		$course_pref = json_decode($course_pref,true);
		$specialization_pref = $this->post('specialization_pref',true);
		$specialization_pref = json_decode($specialization_pref,true);
		$course_choice_no = $this->post('course_choice_no',true);
		$course_choice_no = json_decode($course_choice_no,true);
		$campus_pref = $this->post('campus_pref',true);
		$campus_pref = json_decode($campus_pref,true);
		$campus_choice_no = $this->post('campus_choice_no',true);
		$campus_choice_no = json_decode($campus_choice_no,true);
		$state_pref = $this->post('state_pref',true);
		$state_pref = json_decode($state_pref,true);
		$city_pref = $this->post('city_pref',true);
		$city_pref = json_decode($city_pref,true);
		$city_choice_no = $this->post('city_choice_no',true);
		$city_choice_no = json_decode($city_choice_no,true);
		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_btech);
		$applicant_appln_id = $applicant_appln_det_res['id'];

		// get course prefer id - prog id
		$applicant_course_prefer_res = $this->_get_prog_id_by_preference_dtl($grad_id, $deg_id, $app_form_id_btech, $course_pref, $specialization_pref);
		
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		$_POST['applicant_mob_country_code_id'] = $mobile_no_code;
		$_POST['applicant_appln_id'] = $applicant_appln_id;
		
		$applicant_personal_det_columns = 'applicant_personal_det_id,first_name,middle_name,last_name,mobile_no,applicant_mob_country_code_id,email_id,dob,gender_id,social_status_id,religion_id,mothertongue_id,active,title_id,blood_grp_id,advertisement_source_id,second_email_id,diff_abled,prefer_hostel';

		$title_id=($title_id!='' && $title_id!='null')?$title_id : NULL;
		$blood_grp_id=($blood_grp_id!='' && $blood_grp_id!='null')?$blood_grp_id : NULL;
		$mothertongue_id=($mothertongue_id!='' && $mothertongue_id!='null')?$mothertongue_id : NULL;
		$advertisement_source_id=($advertisement_source_id!='' && $advertisement_source_id!='null')?$advertisement_source_id : NULL;
		$second_email_id=($second_email_id!='' && $second_email_id!='null')?$second_email_id : NULL;
		$diff_abled=($diff_abled!='' && $diff_abled!='null')?$diff_abled : NULL;
		$prefer_hostel=($prefer_hostel!='' && $prefer_hostel!='null')?$prefer_hostel : NULL;

		$_POST['title_id']=$title_id;
		$_POST['blood_grp_id']=$blood_grp_id;
		$_POST['advertisement_source_id']=$advertisement_source_id;
		$_POST['second_email_id']=$second_email_id;
		$_POST['diff_abled']=$diff_abled;
		$_POST['prefer_hostel']=$prefer_hostel;
		$_POST['mothertongue_id']=$mothertongue_id;
		

		$applicant_other_details_columns = 'applicant_personal_det_id,applicant_appln_id,medofinst,active';

		$applicant_course_prefer_columns = 'applicant_personal_det_id,applicant_appln_id,course_id,course_name,choice_no,splpref_id,active';
		if($applicant_course_prefer_id) {
			$applicant_course_prefer_columns .= ',applicant_course_prefer_id';	
		}
		
		$applicant_campus_prefer_columns = 'applicant_personal_det_id,applicant_appln_id,campus_id,campus_name,choice_no,active';
		if($applicant_campus_prefer_id) {
			$applicant_campus_prefer_columns .= ',applicant_campus_prefer_id';	
		}

		$applicant_city_prefer_columns = 'applicant_personal_det_id,applicant_appln_id,city_id,city_name,choice_no,state_id,active';
		if($applicant_city_prefer_id) {
			$applicant_city_prefer_columns .= ',applicant_city_prefer_id';	
		}
		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('course_pref[0]', 'Course Preference 1','trim|required');
		$this->form_validation->set_rules('specialization_pref[0]', 'Specialization Preference 1','trim|required');
		$this->form_validation->set_rules('campus_pref[0]', 'Campus Preference 1','trim|required');
		$this->form_validation->set_rules('state_pref[0]', 'State Preference 1','trim|required');
		$this->form_validation->set_rules('city_pref[0]', 'City Preference 1','trim|required');
		$this->form_validation->set_rules('first_name', 'First Name','trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name','trim|required');
		$this->form_validation->set_rules('mobile_no_code', 'Mobile Code No','trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile No','trim|required');
		$this->form_validation->set_rules('email_id', 'Email Id','trim|required');
		$this->form_validation->set_rules('dob', 'Date Of Birth','trim|required');
		$this->form_validation->set_rules('gender_id', 'Gender','trim|required');
		$this->form_validation->set_rules('social_status_id', 'Community','trim|required');
		$this->form_validation->set_rules('religion_id', 'Religion','trim|required');
		$this->form_validation->set_rules('medofinst', 'Medium of Instruction','trim|required');
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}

		$function_name = $this->get_function_name(__FUNCTION__);
		//  applicant_personal_det insert / update
		$applicant_personal_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns);

		
		
		//  applicant_other_details insert / update
		$other_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_other_details_table, $applicant_other_details_columns, false, 'applicant_other_det_id');

		
		
		// course_pref
		$course_res = array();
		
		if($course_pref) {
			foreach($course_pref as $k=>$v) {
				$n_course_pref = $v;
				$n_specialization_pref = $specialization_pref[$k];
				$n_course_prefer_id = $course_prefer_id[$k];
				$n_course_choice_no = $course_choice_no[$k];
				$n_applicant_course_prefer_res = $applicant_course_prefer_res[$k];
				
				$_SERVER["REQUEST_METHOD"] = "POST";
				$_POST = array();
				if($n_course_prefer_id) {
					$_POST['applicant_course_prefer_id'] = $n_course_prefer_id;	
				}
				$n_course_pref=($n_course_pref!='' && $n_course_pref!='null')?$n_course_pref : NULL;
				$n_specialization_pref=($n_specialization_pref!='' && $n_specialization_pref!='null')?$n_specialization_pref : NULL;

				// $_POST['course_id'] = $n_course_pref;
				$_POST['course_id'] = $n_applicant_course_prefer_res;
				$_POST['choice_no'] = $n_course_choice_no;
				$_POST['splpref_id'] = $n_specialization_pref;
				$_POST['applicant_appln_id'] = $applicant_appln_id;
				$_POST['active']=TRUE;
				

				
				
				// echo 'n_course_prefer_id => '.$n_course_prefer_id."\n";die;
				if($n_course_prefer_id) {
					if(!$n_course_pref || !$n_specialization_pref)
					{
						$wheredel = array();
            			$wheredel['applicant_personal_det_id'] = $applicant_personal_det_id;
            			$wheredel['applicant_appln_id'] = $applicant_appln_id;
            			$wheredel['applicant_course_prefer_id'] = $n_course_prefer_id;
            			$wheredel['table_schema'] = SCHEMA_ADMISSION;
            			$this->common->common_delete_new ( $applicant_course_prefer_table , $wheredel );
					}
					else
					{
						$course_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'applicant_course_prefer_id'=>$n_course_prefer_id), $table_schema, $applicant_course_prefer_table, $applicant_course_prefer_columns, 2, 'applicant_course_prefer_id', $n_course_prefer_id);
					}
					
				} else {
					$chk_flag = false;
					if(!$n_course_pref || !$n_specialization_pref) {
						$chk_flag = true;
					}
					if(!$chk_flag) {
						$course_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_course_prefer_table, $applicant_course_prefer_columns, 1, 'applicant_course_prefer_id');
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
				$n_specialization_pref = $specialization_pref[$k];
				
				$_SERVER["REQUEST_METHOD"] = "POST";
				$_POST = array();
				if($n_campus_prefer_id) {
					$_POST['applicant_campus_prefer_id'] = $n_campus_prefer_id;	
				}

				
				$_POST['choice_no'] = $n_campus_choice_no;
				$_POST['applicant_appln_id'] = $applicant_appln_id;
				$_POST['active']=TRUE;

				$n_campus_pref=($n_campus_pref!='' && $n_campus_pref!='null')?$n_campus_pref : NULL;
				$_POST['campus_id'] = $n_campus_pref;

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
						$campus_pref_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_campus_prefer_table, $applicant_campus_prefer_columns, 1, 'applicant_campus_prefer_id');
					}
				}
			}
		}

		// campus_pref
		$city_pref_res = array();
		if($city_pref) {
			foreach($city_pref as $k=>$v) {
				$n_city_pref = $v;
				$n_city_prefer_id = $city_prefer_id[$k];
				$n_city_choice_no = $city_choice_no[$k];
				$n_state_id = $state_pref[$k];

				$n_city_pref=($n_city_pref!='' && $n_city_pref!='null')?$n_city_pref : NULL;
				$n_state_id=($n_state_id!='' && $n_state_id!='null')?$n_state_id : NULL;
				
				$_SERVER["REQUEST_METHOD"] = "POST";
				$_POST = array();
				if($n_city_prefer_id) {
					$_POST['applicant_city_prefer_id'] = $n_city_prefer_id;	
				}
				$_POST['city_id'] = $n_city_pref;
				$_POST['choice_no'] = $n_city_choice_no;
				$_POST['state_id'] = $n_state_id;
				$_POST['applicant_appln_id'] = $applicant_appln_id;
				if($n_city_prefer_id) {
					if(!$n_city_pref) {
						$wheredel = array();
            			$wheredel['applicant_personal_det_id'] = $applicant_personal_det_id;
            			$wheredel['applicant_appln_id'] = $applicant_appln_id;
            			$wheredel['applicant_city_prefer_id'] = $n_city_prefer_id;
            			$wheredel['table_schema'] = SCHEMA_ADMISSION;
            			$this->common->common_delete_new ( $applicant_city_prefer_table , $wheredel );
					}
					else
					{
						$city_pref_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'applicant_city_prefer_id'=>$n_city_prefer_id), $table_schema, $applicant_city_prefer_table, $applicant_city_prefer_columns, 2, 'applicant_city_prefer_id', $n_city_prefer_id);

					}
				} else {
					$chk_flag = false;
					if(!$n_city_pref) {
						$chk_flag = true;
					}
					if(!$chk_flag) {
						$city_pref_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_city_prefer_table, $applicant_city_prefer_columns, 1, 'applicant_city_prefer_id');
					}
				}
			}
		}

		$this->_get_error_status($course_res);
		$this->_get_error_status($campus_pref_res);
		$this->_get_error_status($city_pref_res);

		if($other_res) {
			if($other_res['status'] == 'error') {
				$this->response ($other_res , API_Controller::HTTP_OK);
			} else {
				$applicant_personal_det_res['other_res'] = $other_res;
			}
		}
		if($course_res) {
			$applicant_personal_det_res['course_res'] = $course_res;
		}
		if($campus_pref_res) {
			$applicant_personal_det_res['campus_pref_res'] = $campus_pref_res;
		}
		if($city_pref_res) {
			$applicant_personal_det_res['city_pref_res'] = $city_pref_res;
		}
		if($applicant_personal_det_res)
		{
		$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_btech , FORM_WIZARD_PERSONAL_ID);
		}

		$this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
    }

    public function btech_parent_detail_post() {
    	$app_form_id_btech = APP_FORM_ID_BTECH;
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
		if($add_guardian_details=='true'){
			$add_gardian = 't';
		}else{
			$add_gardian = 'f';
		}

		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_btech);
		$applicant_appln_id = $applicant_appln_det_res['id'];

		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		$_POST['add_gardian'] = $add_gardian;
		$_POST['applicant_appln_id'] = $applicant_appln_id;

		$applicant_other_details_columns = 'applicant_personal_det_id,applicant_appln_id,add_gardian,active';

		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('parent_father_name', 'Father Name','trim|required');
		$this->form_validation->set_rules('father_title', 'Father Title','trim|required');
		$this->form_validation->set_rules('parent_mother_name', 'Mother Name','trim|required');
		$this->form_validation->set_rules('mother_title', 'Mother Title','trim|required');
		
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
		$alt_mob_country_code_id[] = $guardian_alt_mob_country_code_id;
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

				//$applicant_parent_det_columns = 'applicant_personal_det_id,applicant_appln_id,parent_type_id,parent_name,active,updated_by';

				$applicant_parent_det_columns = 'applicant_personal_det_id,applicant_appln_id,parent_type_id,parent_name,active,alt_mob_countrycode_id,mobile_no,mob_country_code_id,occupation_id,email_id,alt_mobile_no,title_id';

				$n_alt_mob_country_code_id=($n_alt_mob_country_code_id!='' && $n_alt_mob_country_code_id!='null')?$n_alt_mob_country_code_id : NULL;
				$n_mob_country_code_id=($n_mob_country_code_id!='' && $n_mob_country_code_id!='null')?$n_mob_country_code_id : NULL;
				$n_mobile_no=($n_mobile_no!='' && $n_mobile_no!='null')?$n_mobile_no : NULL;
				$n_mob_country_code_id=($n_mob_country_code_id!='' && $n_mob_country_code_id!='null')?$n_mob_country_code_id : NULL;
				$n_occupation=($n_occupation!='' && $n_occupation!='null')?$n_occupation : NULL;
				$n_email_id=($n_email_id!='' && $n_email_id!='null')?$n_email_id : NULL;
				$n_alt_mobile_no=($n_alt_mobile_no!='' && $n_alt_mobile_no!='null')?$n_alt_mobile_no : NULL;
				$n_title=($n_title!='' && $n_title!='null')?$n_title : NULL;


				$_POST['alt_mob_countrycode_id']=$n_alt_mob_country_code_id;
				$_POST['mob_country_code_id']=$n_mob_country_code_id;
				$_POST['mobile_no']=$n_mobile_no;
				$_POST['occupation_id']=$n_occupation;
				$_POST['email_id']=$n_email_id;
				$_POST['alt_mobile_no']=$n_alt_mobile_no;
				$_POST['title_id']=$n_title;
				
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
				    

				$_POST['parent_type_id'] = $n_parent_type_id;
				$_POST['parent_name'] = $n_parent_name;
				$_POST['applicant_appln_id'] = $applicant_appln_id;
				
				if($n_applicant_parent_det_id) {
					$parent_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'applicant_parent_det_id'=>$n_applicant_parent_det_id), $table_schema, $applicant_parent_det_table, $applicant_parent_det_columns, 2, 'applicant_parent_det_id', $n_applicant_parent_det_id);
				} else {
					$chk_flag = false;
					if($n_parent_type_id==PARENT_TYPE_ID_GUARDIAN){
					   if(!$n_parent_name || !$n_mobile_no || !$n_email_id || !$n_occupation || !$n_mob_country_code_id) {
					        $chk_flag = true;
					    }
					    if(!$chk_flag) {
					        $parent_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_parent_det_table, $applicant_parent_det_columns, 1, 'applicant_parent_det_id');
					    }
					}else{
    					if(!$n_parent_name && !$n_mobile_no && !$n_email_id && !$n_occupation && !$n_mob_country_code_id && !$n_title) {
    						$chk_flag = true;
    					}
    					if(!$chk_flag) {
    						$parent_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_parent_det_table, $applicant_parent_det_columns, 1, 'applicant_parent_det_id');
    					}
					}
				}
			}
		}

		$this->_get_error_status($parent_res);

		if($parent_res)
		{
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_btech , FORM_WIZARD_PARENT_ADDRESS_ID);
		}
		
		if($other_res) {
			if($other_res['status'] == 'error') {
				$this->response ($other_res , API_Controller::HTTP_OK);
			} else {
				$applicant_personal_det_res['other_res'] = $other_res;
			}
		}

		$this->response ($parent_res , API_Controller::HTTP_OK);
    }

    public function btech_academic_detail_post() {
    	$app_form_id_btech = APP_FORM_ID_BTECH;
    	$schooling_id_twelfth = SCHOOLING_ID_TWELFTH;
    	$applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
    	$applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
    	$applicant_schooling_table = APPLICANT_SCHOOLING_TABLE;
    	$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$cur_qual_completed = $this->post('cur_qual_completed',true);
		$schooling_id = $this->post('schooling_id',true);
		$board_id = $this->post('board_id',true);
	    $other_board = $this->post('other_board',true);

		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_btech);
		$applicant_appln_id = $applicant_appln_det_res['id'];
		$other_board=isset($other_board) ? $other_board:'';
		
		if($board_id!=OTHER_BOARD){
		    $other_board=Null;
		}
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		//$_POST['created_by'] = $applicant_personal_det_id;
		//$_POST['updated_by'] = $applicant_personal_det_id;
		$_POST['applicant_appln_id'] = $applicant_appln_id;
		$_POST['other_board_name'] = $other_board;
		if(!$schooling_id) {
			$_POST['schooling_id'] = $schooling_id_twelfth;	
		}
		
		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('cur_qual_completed', 'Current Education Qualification Status','trim|required');
		$this->form_validation->set_rules('name_as_in_marksheet', 'Candidate Name as in 10th Certificate','trim|required');
		$this->form_validation->set_rules('institute_name', 'Institute Name','trim|required');
		$this->form_validation->set_rules('board_id', 'Board','trim|required');
		$this->form_validation->set_rules('mode_of_study_id', 'Mode of Study','trim|required');
		if($cur_qual_completed == 't') {
			$this->form_validation->set_rules('marking_scheme_id', 'Marking Scheme','trim|required');
			$this->form_validation->set_rules('mark_percentage', 'Obtained Percentage/CGPA','trim|required');
			$this->form_validation->set_rules('completion_year', 'Year of Passing','trim|required');
			// $this->form_validation->set_rules('registration_no', 'Current Education Qualification Status','trim|required');
			// $this->form_validation->set_rules('digilocker_id', 'Current Education Qualification Status','trim|required');
		}
		
		$this->form_validation->set_rules('address', 'Address of School / College','trim|required');
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}

		$function_name = $this->get_function_name(__FUNCTION__);
		
		$applicant_other_details_columns = 'applicant_personal_det_id,applicant_appln_id,cur_qual_completed,active';

		$applicant_personal_det_columns = 'applicant_personal_det_id,digilocker_id,active';

		$applicant_schooling_det_columns = 'applicant_personal_det_id,applicant_appln_id,institute_name,board_id,other_board_name,marking_scheme_id,mark_percentage,completion_year,registration_no,name_as_in_marksheet,mode_of_study_id,address,schooling_id,active,result_declared,is_curr_qualify';
		$marking_scheme_id_post=$this->input->post('marking_scheme_id');
		$mark_percentage_post=$this->input->post('mark_percentage');
		$completion_year_post=$this->input->post('completion_year');
		$registration_no_post=$this->input->post('registration_no');
		$marking_scheme_id_post=($marking_scheme_id_post!='' && $marking_scheme_id_post!='null')?$marking_scheme_id_post : NULL;
		$mark_percentage_post=($mark_percentage_post!='' && $mark_percentage_post!='null')?$mark_percentage_post : NULL;
		$completion_year_post=($completion_year_post!='' && $completion_year_post!='null')?$completion_year_post : NULL;
		$registration_no_post=($registration_no_post!='' && $registration_no_post!='null')?$registration_no_post : NULL;
		if($cur_qual_completed == 'f') {
			$marking_scheme_id_post = NULL;
			$mark_percentage_post = NULL;
			$completion_year_post = NULL;
			$registration_no_post = NULL;
		}
		$_POST['marking_scheme_id'] = $marking_scheme_id_post;
		$_POST['mark_percentage'] = $mark_percentage_post;
		$_POST['completion_year'] = $completion_year_post;
		$_POST['registration_no'] = $registration_no_post;
		if($schooling_id) {
			//$applicant_schooling_det_columns .= ',updated_by';
		} else {
			//$applicant_schooling_det_columns .= ',created_by';
		}

		//  applicant_other_details insert / update
		$other_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_other_details_table, $applicant_other_details_columns, false, 'applicant_other_det_id');
		//  applicant_personal_det insert / update
		$applicant_personal_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns);

		$schooling_res = array();
		if($schooling_id) {
			$schooling_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'schooling_id'=>$schooling_id_twelfth), $table_schema, $applicant_schooling_table, $applicant_schooling_det_columns, 2);
		} else {
			$schooling_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_schooling_table, $applicant_schooling_det_columns, 1, 'applicant_scl_det_id');
		}
		if($schooling_res) {
			if($schooling_res['status'] == 'error') {
				$this->response ($schooling_res , API_Controller::HTTP_OK);
			} else {
				$applicant_personal_det_res['schooling_res'] = $schooling_res;
			}
		}
		if($other_res) {
			if($other_res['status'] == 'error') {
				$this->response ($other_res , API_Controller::HTTP_OK);
			} else {
				$applicant_personal_det_res['other_res'] = $other_res;
			}
		}

		if($applicant_personal_det_res)
		{
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_btech , FORM_WIZARD_ACADEMIC_ID);
		}
		

		$this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
    }

    public function btech_declaration_detail_post() {
    	$app_form_id_btech = APP_FORM_ID_BTECH;
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
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_btech);
		$applicant_appln_id = $applicant_appln_det_res['id'];

		$_POST['applicant_appln_id'] = $applicant_appln_id;
		// $applicant_personal_det_columns = 'applicant_personal_det_id,applicant_name,parent_name,declared_date,updated_by,active';
		$applicant_appln_det_columns = 'applicant_appln_id,applicant_personal_det_id,applicant_name_declaration,applicant_parentname_declaration,applicant_declaration_date,active,application_status_id';
		//  applicant_personal_det insert / update
		$applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, array('applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns);
		if($applicant_appln_det_res)
		{
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_btech , FORM_WIZARD_UPLOAD_DECLARATION_ID);
			/*$application_complete_update = $this->common_application_status_update($applicant_personal_det_id, $applicant_appln_id);*/
		}
		$this->response ($applicant_appln_det_res , API_Controller::HTTP_OK);
    }
}