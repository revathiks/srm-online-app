<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package SRM - Online Application
 * @category Mtech research API
 
 *
 * @SWG\Resource(
 *  apiVersion="0.1",
 *  swaggerVersion="1.2",
 *  resourcePath="/api",
 *  produces="['application/json']"
 * )
 *
 */
class Mtech_research_jan extends API_Controller {

	public function __construct()
	{		
		parent::__construct();
		$this->load->library('form_validation');
	}


	 /*Mtech Research Start*/


    /**
     * create applicant_appln_det list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the applicant_appln_det list
     * @param string $id applicant_appln_det id
     * @return json response of applicant_appln_det list by page & limit
     * @author
     */

    public function mtechreearchbasicdet_post()
    {
    	$table = APPLICANT_APPLN;
    	$table_schema = SCHEMA_ADMISSION;
    	$function_name = $this->get_function_name(__FUNCTION__);
    	$table_prefix = '';
    	$columns ='applicant_appln_id,appln_form_id,form_name,active,appln_form_id,qualifyingexamfromindia
    				,applicant_personal_det_id,is_agree,grad_id';
    	$form_id = $this->input->post('appln_form_id');
    	$is_agree = $this->post('qualifyingexamfromindia',true);
    	$qualifyingexamfromindia = $this->post('graduation_india',true);
    	$appln_status = $this->post('appln_status',true);
    	$applicant_personal_det_id = $this->input->post('applicant_personal_det_id');
    	$application_inprogress_id     = APPLICATION_IN_PROGRESS;
		//$check_user = $this->check_exist_user($table, $table_schema, $columns,  $applicant_personal_det_id, $form_id);
		$check_user = $this->check_exist_user($table , $table_schema , $columns ,  $applicant_personal_det_id, false, false,  false, $form_id );

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
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		$_POST['qualifyingexamfromindia'] = $qualifyingexamfromindia;
		$_POST['is_agree'] = $is_agree;
		$_POST['application_status_id'] = $application_inprogress_id;
		$_POST['grad_id']=MTECH_RESEARCH_GRADUATION_ID;
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('appln_form_id', 'Form id','trim|required');
		$this->form_validation->set_rules('qualifyingexamfromindia', 'Qualifyingexamfromindia','trim|required');
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}

		if(!empty($check_user['data']))
		{
			if($appln_status != APPLICATION_IN_COMPLETED){
        	$columns .= ',application_status_id';
        	}
			$put_array = $_POST;
			$applicant_appln_id = $check_user['data'][0]['applicant_appln_id'];			
			$put_array[$table_prefix.'id'] = $applicant_appln_id;
			$update = $this->_common_update ( $table , $table_prefix , $function_name , $columns , $put_array ,  'applicant_appln_id',$table_schema);
			if($update)
			{
				// common_application_status_update for Application inprogress status update purpose
				
				
				/*$application_inprogress_update = $this->common_application_status_update($applicant_personal_det_id, $applicant_appln_id,$application_inprogress_id);*/
				
				// End of common_application_status_update for Application inprogress status update purpose
				
				$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $form_id , FORM_WIZARD_BASIC_ID);
				$this->response (
                    [
                        'status' => 'true' ,
                        'message' => RECORD_UPDATE_SUCCESSFULLY,
                    ] , API_Controller::HTTP_OK
                );
			}
			else {
                $this->response (
                    [
                        'status' => 'error' ,
                        'message' => ERROR_MSG,
                    ] , API_Controller::HTTP_OK
                );
            }
		}
		else
		{			
			$insert = $this->_common_insert ( $table , $table_prefix , $function_name , $columns , $table_schema );

			if ( $insert ) {
				
				// common_application_status_update for Application inprogress status update purpose
				/*$application_inprogress_id     = APPLICATION_IN_PROGRESS;
				$application_inprogress_update = $this->common_application_status_update($applicant_personal_det_id, $applicant_appln_id,$application_inprogress_id)*/;

				
				$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $form_id , FORM_WIZARD_BASIC_ID);
                $this->response (
                    [
                        'status' => 'true' ,
                        'message' => RECORD_ADDED_SUCCESSFULLY,
                    ] , API_Controller::HTTP_OK
                );
            }
            else {
                $this->response (
                    [
                        'status' => 'error' ,
                        'message' => ERROR_MSG,
                    ] , API_Controller::HTTP_OK
                );
            }
		}
    }


    /**
     * create Personal details list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the applicant_appln_det list
     * @param string $id applicant_appln_det id
     * @return json response of applicant_personal_det list by page & limit
     * @author
     */

    public function mtechresearch_personal_detail_post() 
    { 

    	$app_form_id_mtech_research = APP_FORM_ID_MTECH_RESEARCH_JAN;
    	$mtech_research_course_id = MTECH_RESEARCH_COURSE_ID;
    	$applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
    	$applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
    	$applicant_course_prefer_table = APPLICANT_COURSE_PREFER_TABLE;
    	$applicant_campus_prefer_table = APPLICANT_CAMPUS_PREFER_TABLE;
    	$applicant_city_prefer_table = APPLICANT_CITY_PREFER_TABLE;
    	$country_value_default = COUNTRY_VALUE_DEFAULT;
    	$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';

		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$mobile_no_code = $this->post('mobile_no_code',true);
		$nationality_id = $this->post('nationality_id',true);
		$applicant_specialization_pref_id = $this->post('specialization_pref_id',true);
		$applicant_specialization_pref_id = json_decode($applicant_specialization_pref_id,true);
		$applicant_campus_prefer_id = $this->post('campus_prefer_id',true);
		$applicant_campus_prefer_id = json_decode($applicant_campus_prefer_id,true);
		
		$specialization_choice_no = $this->post('specialization_choice_no',true);
		$specialization_choice_no = json_decode($specialization_choice_no,true);
		$campus_choice_no = $this->post('campus_choice_no',true);
		$campus_choice_no = json_decode($campus_choice_no,true);

		$campus_pref = $this->post('campus_pref',true);
		$campus_pref = json_decode($campus_pref,true);
		$specialization_pref = $this->post('specialization_pref',true);
		$specialization_pref = json_decode($specialization_pref,true);
		
		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_mtech_research);
		$applicant_appln_id = $applicant_appln_det_res['id'];
		
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		$_POST['applicant_mob_country_code_id'] = $mobile_no_code;
		$_POST['applicant_appln_id'] = $applicant_appln_id;

		$blood_grp_id_post = $this->input->post('blood_grp_id');
		$mothertongue_post = $this->input->post('mothertongue_id');
		$advsource_post = $this->input->post('advertisement_source_id');
		$social_status_post = $this->input->post('social_status_id');
		$phone_no_code = $this->input->post('mobile_no_code');
		$_POST['applicant_mob_country_code_id'] = $phone_no_code;
		
		$applicant_personal_det_columns = 'applicant_personal_det_id,title_id,first_name,middle_name,last_name,applicant_mob_country_code_id,mobile_no,email_id,dob,gender_id,second_email_id,,religion_id,active,nationality_id,prefer_hostel,diff_abled,blood_grp_id,social_status_id,mothertongue_id,advertisement_source_id';

		$blood_grp_id_post1=($blood_grp_id_post!='' && $blood_grp_id_post!='null')?$blood_grp_id_post : NULL;
		$social_status_post1=($social_status_post!='' && $social_status_post!='null')?$social_status_post : NULL;
		$mothertongue_post1=($mothertongue_post!='' && $mothertongue_post!='null')?$mothertongue_post : NULL;
		$advsource_post1=($advsource_post!='' && $advsource_post!='null')?$advsource_post : NULL;

		$_POST['blood_grp_id']=$blood_grp_id_post1;
		$_POST['social_status_id']=$social_status_post1;
		$_POST['mothertongue_id']=$mothertongue_post1;
		$_POST['advertisement_source_id']=$advsource_post1;
		

		$applicant_other_details_columns = 'applicant_personal_det_id,applicant_appln_id,medofinst,active';

		$applicant_course_prefer_columns = 'applicant_personal_det_id,applicant_appln_id,course_id,course_name,choice_no,splpref_id,active';
		if($applicant_specialization_pref_id) {
			$applicant_course_prefer_columns .= ',applicant_course_prefer_id';	
		}
		
		$applicant_campus_prefer_columns = 'applicant_personal_det_id,applicant_appln_id,campus_id,campus_name,choice_no,active';
		if($applicant_campus_prefer_id) {
			$applicant_campus_prefer_columns .= ',applicant_campus_prefer_id';	
		}


		
		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		//$this->form_validation->set_rules('course_pref[0]', 'Course Preference 1','trim|required');
		
		$this->form_validation->set_rules('specialization_pref[0]', 'Specialization Preference 1','trim|required');
		$this->form_validation->set_rules('campus_pref[0]', 'Campus Preference 1','trim|required');		
		
		$this->form_validation->set_rules('first_name', 'First Name','trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name','trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile No','trim|required');
		$this->form_validation->set_rules('email_id', 'Email Id','trim|required');
		$this->form_validation->set_rules('dob', 'Date Of Birth','trim|required');
		$this->form_validation->set_rules('gender_id', 'Gender','trim|required');
		if($nationality_id == $country_value_default) {
			$this->form_validation->set_rules('social_status_id', 'Community','trim|required');	
		}		
		$this->form_validation->set_rules('title_id', 'Title','trim|required');
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
		// $other_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_other_details_table, $applicant_other_details_columns);
		//  applicant_other_details insert / update
		$other_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_other_details_table, $applicant_other_details_columns, false, 'applicant_other_det_id');

		// course_pref
		$specialization_res = array();

		/*$this->response (
                                [
                                    'status' => TRUE ,
                                    'data' => $_POST ,
                                ] , API_Controller::HTTP_OK
                            );*/
		
		if($specialization_pref) {
			foreach($specialization_pref as $k=>$v) {
				$n_course_pref = $v;
				$n_specialization_pref = $specialization_pref[$k];
				$n_specialization_pref_id = $applicant_specialization_pref_id[$k];
				$n_specialization_choice_no = $specialization_choice_no[$k];
				
				$_SERVER["REQUEST_METHOD"] = "POST";
				$_POST = array();
				if($n_specialization_pref_id) {
					$_POST['applicant_course_prefer_id'] = $n_specialization_pref_id;	
				}

				$n_specialization_pref=($n_specialization_pref!='' && $n_specialization_pref!='null')?$n_specialization_pref : NULL;

				$_POST['choice_no'] = $n_specialization_choice_no;
				$_POST['splpref_id'] = $n_specialization_pref;
				$_POST['applicant_appln_id'] = $applicant_appln_id;
				$_POST['course_id'] = $mtech_research_course_id;
				$_POST['active'] = TRUE;

				if($n_specialization_pref_id) {
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
					}
				}
			}
		}



		// campus_pref
		$campus_pref_res = array();
		if($campus_pref) {
			$table_schema = SCHEMA_ADMISSION;
			foreach($campus_pref as $k=>$v) {
				$n_campus_pref = $v;
				$n_campus_prefer_id = $applicant_campus_prefer_id[$k];
				$n_campus_choice_no = $campus_choice_no[$k];

				$n_course_pref = $course_pref[$k];
				$n_specialization_pref = $specialization_pref[$k];
				
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



		$this->_get_error_status($specialization_res);
		$this->_get_error_status($campus_pref_res);

		$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_MTECH_RESEARCH_JAN , FORM_WIZARD_PERSONAL_ID);

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
		
		if($applicant_personal_det_res){
		    $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_mtech_research , FORM_WIZARD_PERSONAL_ID);
		}
		$this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);

    }

    /**
     * create Parents details list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the applicant_appln_det list
     * @param string $id applicant_parent_det id
     * @return json response of applicant_parent_det list by page & limit
     * @author
     */

    public function mtechresearch_parent_detail_post() {
    	$app_form_id_mtech = APP_FORM_ID_MTECH_RESEARCH_JAN;
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
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_mtech);
		$applicant_appln_id = $applicant_appln_det_res['id'];


		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		$_POST['add_gardian'] = $add_gardian;
		$_POST['applicant_appln_id'] = $applicant_appln_id;


		$applicant_other_details_columns = 'applicant_personal_det_id,add_gardian,applicant_appln_id,active';


		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		//$this->form_validation->set_rules('parent_father_name', 'Father Name','trim|required');
		//$this->form_validation->set_rules('father_title', 'Father Title','trim|required');
		//$this->form_validation->set_rules('parent_mother_name', 'Mother Name','trim|required');
		//$this->form_validation->set_rules('mother_title', 'Mother Title','trim|required');
		if($add_gardian=='t'){
            //$this->form_validation->set_rules('parent_guardian_name', 'Gardian Name','trim|required');
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
		
		// Guardian Detail
		
		$parent_type_guardian_id = $user_data['parent_type_guardian_id'];
		$parent_guardian_name = $user_data['parent_guardian_name'];
		$guardian_mobile_no = $user_data['guardian_mobile_no'];
		$guardian_alt_mobile_no = $user_data['guardian_alt_mobile_no'];
		$guardian_email_id = $user_data['guardian_email_id'];
		$guardian_occupation = $user_data['guardian_occupation'];
		$guardian_mob_country_code_id = $user_data['guardian_mob_country_code_id'];
		$guardian_alt_mob_country_code_id = $user_data['guardian_alt_mob_country_code_id'];
		$mother_other_occupation = $user_data['mother_other_occupation'];
		$other_occupation_guardian = $user_data['other_occupation_guardian'];

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
		$other_occupation_name[] = $other_occupation_father;

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
		$other_occupation_name[] = $other_occupation_mother;


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
		$other_occupation_name[] = $other_occupation_guardian;
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

				$applicant_parent_det_columns = 'applicant_personal_det_id,applicant_appln_id,parent_type_id,parent_name,mobile_no,email_id,occupation_id,active,updated_by,mob_country_code_id,title_id,alt_mob_countrycode_id,alt_mobile_no';
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

                $n_occupation=($n_occupation!='' && $n_occupation!='null')?$n_occupation : NULL;
                $n_mob_country_code_id=($n_mob_country_code_id!='' && $n_mob_country_code_id!='null')?$n_mob_country_code_id : NULL;
                $n_alt_mob_country_code_id=($n_alt_mob_country_code_id!='' && $n_alt_mob_country_code_id!='null')?$n_alt_mob_country_code_id : NULL;
                $n_title=($n_title!='' && $n_title!='null')?$n_title : NULL;

				$_POST['parent_type_id'] = $n_parent_type_id;
				$_POST['parent_name'] = $n_parent_name;
				$_POST['mobile_no'] = $n_mobile_no;
				$_POST['email_id'] = $n_email_id;
				$_POST['occupation_id'] = $n_occupation;
				$_POST['mob_country_code_id'] = $n_mob_country_code_id;
				// echo 'alt_mob_countrycode_id => '.$n_alt_mob_country_code_id."\n";
				// echo 'alt_mobile_no => '.$n_alt_mobile_no."\n";
				$_POST['alt_mob_countrycode_id'] = $n_alt_mob_country_code_id;
				$_POST['alt_mobile_no'] = $n_alt_mobile_no;
				$_POST['title_id'] = $n_title;
				$_POST['applicant_appln_id'] = $applicant_appln_id;
				$_POST['active'] = TRUE;
				
				if($n_applicant_parent_det_id) {					
					$parent_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_parent_det_table, $applicant_parent_det_columns, 1, 'applicant_parent_det_id', $n_applicant_parent_det_id);
				} else {
					$chk_flag = false;
					if(!$n_parent_type_id) {
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
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_MTECH_RESEARCH_JAN , FORM_WIZARD_PARENT_ADDRESS_ID);
			$applicant_personal_det_res['parent_res'] = $parent_res;
		}

		$this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
    }

    /**
     * create Academic details list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the applicant_appln_det list
     * @param string $id applicant_academic_det id
     * @return json response of applicant_academic_det list by page & limit
     * @author
     */

    public function mtechresearch_acdemic_dtl_post()
	{
		$app_form_id_mtech = APP_FORM_ID_MTECH_RESEARCH_JAN;
		$applicant_graduation_table = APPLICANT_GRADUATION_TABLE;
		$applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
		$applicant_professional_exp_table = APPLICANT_PROFESSIONAL_EXP_TABLE;
		$applicant_publication_det_table = APPLICANT_PUBLICATION_DET_TABLE;
		$applicant_competitive_exam_det_table = APPLICANT_COMPETITIVE_EXAM_DET_TABLE;
		$applicant_schooling_dt_table = APPLICANT_SCHOOLING_TABLE;
		$personal_det_table = APPLICANT_PERSONAL_DET_TABLE;  
		$coordinator_det_table = APPLICANT_COORDINATOR_DET_TABLE;  
		$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);

		$is_work_experience = $this->post('is_work_experience',true);
		$prof_exp_ids = $this->post('prof_exp_ids',true);
		$prof_exp_ids = json_decode($prof_exp_ids,true);
		$org_name = $this->post('org_name',true);
		$org_name = json_decode($org_name,true);
		$designation = $this->post('designation',true);
	    $designation = json_decode($designation,true);
		//$job_nature = $this->post('job_nature',true);
		//$job_nature = json_decode($job_nature,true);
		//$work_experience = $this->post('is_work_experience',true);
		//$salary = json_decode($salary,true);
		$from_date = $this->post('from_date',true);
		$from_date = json_decode($from_date,true);
		$to_date = $this->post('to_date',true);
		$to_date = json_decode($to_date,true);
		$work_experience = $this->post('work_experience',true);
		$work_experience = json_decode($work_experience,true);



		
		
		//$grad_det_ids = $this->post('grad_det_ids',true);
		//$grad_det_ids = json_decode($grad_det_ids,true);
		//$other_degree_name = $this->post('other_degree_names',true);
		//$other_degree_name = json_decode($other_degree_name,true);
		//$major_discipline = $this->post('major_discipline',true);
		//$major_discipline = json_decode($major_discipline,true);
		//$major_discipline_1 = (isset($major_discipline[0]))?$major_discipline[0]:false;
		//$major_discipline_2 = (isset($major_discipline[1]))?$major_discipline[1]:false;
		//$major_discipline_3 = (isset($major_discipline[2]))?$major_discipline[2]:false;
		$univ_id = $this->post('univ_id',true);
		//$univ_id = json_decode($univ_id,true);
		$mark_scheme_id = $this->post('mark_scheme_id',true);
		//$mark_scheme_id = json_decode($mark_scheme_id,true);
		$mark_percent = $this->post('mark_percent',true);
		//$mark_percent = json_decode($mark_percent,true);
		$completion_year = $this->post('completion_year',true);
		//$completion_year = json_decode($completion_year,true);

		//$publn_det_ids = $this->post('publn_det_ids',true);
		//$publn_det_ids = json_decode($publn_det_ids,true);
		//$title = $this->post('titles',true);
		//$title = json_decode($title,true);
		//$journal_conf_name = $this->post('journal_conf_names',true);
		//$journal_conf_name = json_decode($journal_conf_name,true);
		//$year = $this->post('years',true);
		//$year = json_decode($year,true);

		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_mtech);
		$applicant_appln_id = $applicant_appln_det_res['id'];
		$applicant_grad_det_id=$this->input->post('applicant_grad_det_id');
		$applicant_coord_det_id=$this->input->post('applicant_coord_det_id');



		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		if($is_work_experience == 'yes') {
			$_POST['is_work_experience'] = 't';
		} else {
			$_POST['is_work_experience'] = 'f';
			$wheredel = array();
			$wheredel['applicant_personal_det_id'] = $applicant_personal_det_id;
			$wheredel['applicant_appln_id'] = $applicant_appln_id;
			$wheredel['table_schema'] = SCHEMA_ADMISSION;
			$this->common->common_delete_new ( $applicant_professional_exp_table , $wheredel );
		}
		$_POST['applicant_appln_id'] = $applicant_appln_id;

		//$applicant_personal_det_id = $this->input->post('applicant_personal_det_id');
		// $applicant_graduation_columns = 'applicant_personal_det_id,other_degree_name,major_discipline,univ_id,mark_scheme_id,mark_percent,completion_year,active';

		$applicant_personal_det_columns = 'applicant_personal_det_id,digilocker_id,name_in_marksheet';

		$applicant_graduation_columns = 'applicant_grad_det_id,applicant_personal_det_id,insti_name,univ_id,mark_scheme_id,mark_percent,completion_year,active,registration_no,applicant_appln_id,mode_of_study_id';
		$applicant_other_details_columns = 'applicant_personal_det_id,total_work_exp,is_work_experience,active';

		$applicant_professional_exp_columns = 'applicant_prof_exp_id,applicant_personal_det_id,org_name,designation,from_date,to_date,work_exp_in_months,active,applicant_appln_id,work_experience';

		$applicant_coordinator_det_colums = 'applicant_personal_det_id,research_area,applicant_coord_det_id,coord_name,applicant_appln_id';



		/*$applicant_publication_det_columns = 'applicant_publn_det_id,applicant_personal_det_id,title,journal_conf_name,year,active';
		$applicant_competitive_exam_det_columns = 'applicant_personal_det_id,comp_exam_id,active';*/
		
		// is_work_experience, taken_any_competitive_exam, competitive_exam, phd_major
		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('research_area', 'Board area research','trim|required');
		$this->form_validation->set_rules('insti_name', 'Institute Name','trim|required');
		$this->form_validation->set_rules('univ_id', 'University','trim|required');
		$this->form_validation->set_rules('mode_of_study_id', 'Mode of study','trim|required');
		$this->form_validation->set_rules('mark_scheme_id', 'Schema Mark','trim|required');
		$this->form_validation->set_rules('completion_year', 'Year of pass','trim|required');
		$this->form_validation->set_rules('mark_percent', 'Obtained Percentage','trim|required');
		$this->form_validation->set_rules('registration_no', 'Register','trim|required');
		$this->form_validation->set_rules('name_in_marksheet', 'Name Marksheet','trim|required');
		
		if($is_work_experience == 'yes') {
			if($org_name) {
				/*foreach($org_name as $k=>$v) {
					if($k == 0) {
						$this->form_validation->set_rules('org_name['.$k.']', 'Organization name','trim|required');
						$this->form_validation->set_rules('designation['.$k.']', 'Designation','trim|required');
						$this->form_validation->set_rules('job_nature['.$k.']', 'Job Nature','trim|required');
						$this->form_validation->set_rules('salary['.$k.']', 'Salary','trim|required');
						$this->form_validation->set_rules('from_date['.$k.']', 'From Date','trim|required');
						$this->form_validation->set_rules('to_date['.$k.']', 'To Date','trim|required');
						$this->form_validation->set_rules('work_exp_in_months['.$k.']', 'Work Exp in months','trim|required');	
					}
				}*/
				$this->form_validation->set_rules('org_name[0]', 'Organization name','trim|required');
				$this->form_validation->set_rules('designation[0]', 'Designation','trim|required');
				$this->form_validation->set_rules('from_date[0]', 'From Date','trim|required');
				$this->form_validation->set_rules('to_date[0]', 'To Date','trim|required');
				$this->form_validation->set_rules('work_experience[0]', 'Work Experience','trim|required');
				$this->form_validation->set_rules('work_exp_in_months', 'Work Experience in months','trim|required');
			}
		}
		
		
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}


		$function_name = $this->get_function_name(__FUNCTION__);
		//  applicant_other_details insert / update


		/*$graduation_details_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_graduation_table, $applicant_graduation_columns);*/

		// applicant_graduation_table
		$graduation_details_res = array();

		if($applicant_grad_det_id) {
			$graduation_details_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'applicant_grad_det_id'=>$applicant_grad_det_id), $table_schema, $applicant_graduation_table, $applicant_graduation_columns, 2, 'applicant_grad_det_id', $applicant_grad_det_id);
		} else {
			$graduation_details_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_graduation_table, $applicant_graduation_columns, 1, 'applicant_grad_det_id');
		}
		

		$app_personal_details_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $personal_det_table, $applicant_personal_det_columns);

		/*$other_details_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_other_details_table, $applicant_other_details_columns);*/

		$other_details_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_other_details_table, $applicant_other_details_columns, false, 'applicant_other_det_id');
		

		/*$app_coordinator_details_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $coordinator_det_table, $applicant_coordinator_det_colums);*/

		$app_coordinator_details_res = array();
		if($applicant_coord_det_id)
		{
			$app_coordinator_details_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'applicant_coord_det_id'=>$applicant_coord_det_id), $table_schema, $coordinator_det_table, $applicant_coordinator_det_colums, 2, 'applicant_coord_det_id', $applicant_coord_det_id);
		}
		else
		{
			$app_coordinator_details_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $coordinator_det_table, $applicant_coordinator_det_colums, 1, 'applicant_coord_det_id');
		}
		
		// applicant_professional_exp_table
		$professional_exp_res = array();

		


		if($is_work_experience == 'yes') {



			// if($org_name) {	

				

				foreach($org_name as $k=>$v) {
					
					$n_org_name = $v;
					$n_prof_exp_id = $prof_exp_ids[$k];
					$n_designation = $designation[$k];
					//$n_job_nature = $job_nature[$k];
					//$n_salary = $salary[$k];
					$n_from_date = $from_date[$k];
					$n_to_date = $to_date[$k];
					$n_work_experience = $work_experience[$k];
					$_SERVER["REQUEST_METHOD"] = "POST";
					$_POST = array();
					if($n_prof_exp_id) {
						$_POST['applicant_prof_exp_id'] = $n_prof_exp_id;	
					}
					$_POST['org_name'] = $n_org_name;
					$_POST['designation'] = $n_designation;
					//$_POST['job_nature'] = $n_job_nature;
					//$_POST['salary'] = $n_salary;
					$_POST['from_date'] = $n_from_date;
					$_POST['to_date'] = $n_to_date;
					$_POST['work_experience'] = $n_work_experience;
					$_POST['active'] = TRUE;
					$_POST['applicant_appln_id'] = $applicant_appln_id;
					/*echo '<pre>';
					print_r($_POST);
					print_r($this->input->post());
					echo '</pre>';
					die;*/
					if($n_prof_exp_id) {
						$professional_exp_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'applicant_prof_exp_id'=>$n_prof_exp_id), $table_schema, $applicant_professional_exp_table, $applicant_professional_exp_columns, 2, 'applicant_prof_exp_id', $n_prof_exp_id);
					} else {						
						$chk_flag = false;
						if(!$n_org_name && !$n_designation &&  !$n_from_date && !$n_to_date && !$n_work_exp_in_months) {
							$chk_flag = true;
						}
						if(!$chk_flag) {
							$professional_exp_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_professional_exp_table, $applicant_professional_exp_columns, 1, 'applicant_prof_exp_id');
						}
					}
				}
			// }
		}
		

		$this->_get_error_status($professional_exp_res);
		
		if($graduation_details_res) {
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_MTECH_RESEARCH_JAN , FORM_WIZARD_ACADEMIC_ID);
			$other_res['graduation_details_res'] = $graduation_details_res;
		}

		if($app_personal_details_res){
			$other_res['personal_details_res'] = $app_personal_details_res;
		}

		if($other_details_res){
			$other_res['other_details_res'] = $other_details_res;
		}

		if($app_coordinator_details_res){
			$other_res['coordinator_details_res'] = $app_coordinator_details_res;
		}

		if($professional_exp_res){
			$other_res['professional_exp_res'] = $professional_exp_res;
		}
		$this->response ($other_res , API_Controller::HTTP_OK);
	}


	/**
     * create Declaration list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the applicant_appln_det list
     * @param string $id applicant_declaration_det id
     * @return json response of applicant_academic_det list by page & limit
     * @author
     */

	public function mtechresearch_declaration_dtl_post()
	{
		$app_form_id_mtech = APP_FORM_ID_MTECH_RESEARCH_JAN;
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
		$_POST['updated_by'] = $applicant_personal_det_id;
		$_POST['applicant_declaration_date'] = $applicant_declaration_date;
		$_POST['application_status_id'] = $application_completed;
		$function_name = $this->get_function_name(__FUNCTION__);

		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_mtech);
		$applicant_appln_id = $applicant_appln_det_res['id'];

		$_POST['applicant_appln_id'] = $applicant_appln_id;
		// $applicant_personal_det_columns = 'applicant_personal_det_id,applicant_name,parent_name,declared_date,updated_by,active';
		$applicant_appln_det_columns = 'applicant_appln_id,applicant_personal_det_id,applicant_name_declaration,applicant_parentname_declaration,applicant_declaration_date,updated_by,active,application_status_id';
		//  applicant_personal_det insert / update
		$applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, array('applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns);
		$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_MTECH_RESEARCH_JAN , FORM_WIZARD_DECLARATION_ID);
		/*$application_completed_update = $this->common_application_status_update($applicant_personal_det_id, $applicant_appln_id);*/
		$this->response ($applicant_appln_det_res , API_Controller::HTTP_OK);	
			
	}


    /*Mtech Research End*/

}
