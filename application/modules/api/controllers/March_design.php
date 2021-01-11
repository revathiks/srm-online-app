<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package SRM - Online Application
 * @category March API
 
 *
 * @SWG\Resource(
 *  apiVersion="0.1",
 *  swaggerVersion="1.2",
 *  resourcePath="/api",
 *  produces="['application/json']"
 * )
 *
 */
class March_design extends API_Controller {

	public function __construct()
	{		
		parent::__construct();
		$this->load->library('form_validation');
	}

	/*MArch_design Save Basic Details*/

	public function march_basic_detail_post()
	{
		$app_form_id = APP_FORM_ID_MARCH;
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
		$_POST['appln_form_id'] = $app_form_id;		
		$_POST['is_agree']=$is_agree;		
		$_POST['qualifyingexamfromindia'] = $qualifyingexamfromindia;
		$_POST['application_status_id'] = 	$application_inprogress_id;
		$_POST['grad_id'] = MARCH_GRADUATION_ID;
		$applicant_appln_det_res =$this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
        $applicant_appln_id = $applicant_appln_det_res['id'];
        if($applicant_appln_id != ''){
        	$_POST['applicant_appln_id']=$applicant_appln_id;
        	$applicant_appln_det_columns .= ',applicant_appln_id';
        }
        if($applicant_appln_id != '' && $appln_status != APPLICATION_IN_COMPLETED){
        	$applicant_appln_det_columns .= ',application_status_id';
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
			$applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns,false,'applicant_appln_id',false,$app_form_id);
		} else {
			$applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns, 1, 'applicant_appln_id', $applicant_appln_id,$app_form_id);
		}
		if($applicant_appln_det_res)
		{
			// Update wizard ID
			
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_MARCH , FORM_WIZARD_BASIC_ID);
		}
		$this->response ($applicant_appln_det_res , API_Controller::HTTP_OK);
	}

	public function march_personal_detail_post() 
	{ 

		$applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
		$applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
		$applicant_course_prefer_table = APPLICANT_COURSE_PREFER_TABLE;
		$applicant_campus_prefer_table = APPLICANT_CAMPUS_PREFER_TABLE;
		$applicant_city_prefer_table = APPLICANT_CITY_PREFER_TABLE;
		$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';

		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$applicant_campus_prefer_id = $this->post('campus_prefer_id',true);
		$campus_choice_no = $this->post('campus_choice_no',true);
		$campus_pref = $this->post('campus_pref',true);

		
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
		
		$applicant_personal_det_columns = 'applicant_personal_det_id,title_id,first_name,middle_name,last_name,mobile_no,email_id,dob,gender_id,second_email_id,active,nationality_id,diff_abled,blood_grp_id,religion_id,prefer_hostel,advertisement_source_id,mothertongue_id,social_status_id,
		applicant_mob_country_code_id';

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
		
		$applicant_campus_prefer_columns = 'applicant_personal_det_id,campus_id,campus_name,choice_no,active,applicant_appln_id';
		if($applicant_campus_prefer_id) {
			$applicant_campus_prefer_columns .= ',applicant_campus_prefer_id';	
		}
		
		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
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


		$app_form_id = APP_FORM_ID_MARCH;

		$deg_id = 	MARCH_DEGREE_ID;
		$grad_id = 	MARCH_GRADUATION_ID;

		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
		$applicant_appln_id = $applicant_appln_det_res['id'];
		$_POST['applicant_appln_id'] = $applicant_appln_id;

		$function_name = $this->get_function_name(__FUNCTION__);
		//  applicant_personal_det insert / update
		$applicant_personal_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns);

		//  applicant_other_details insert / update
		$other_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_other_details_table, $applicant_other_details_columns,false,'applicant_other_det_id');


		$campus_pref_res = array();

		if($campus_pref){
			$n_campus_pref = $campus_pref;
			$n_campus_prefer_id = $applicant_campus_prefer_id;
			$n_campus_choice_no = $campus_choice_no;

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
			
			$function_name = $this->get_function_name(__FUNCTION__);
			if($n_campus_prefer_id){
				$campus_pref_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'applicant_campus_prefer_id'=>$n_campus_prefer_id), $table_schema, $applicant_campus_prefer_table, $applicant_campus_prefer_columns, 2, 'applicant_campus_prefer_id', $n_campus_prefer_id);	
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

		$this->_get_error_status($campus_pref_res);

		if($other_res) {
			if($other_res['status'] == 'error') {
				$this->response ($other_res , API_Controller::HTTP_OK);
			} else {
				$applicant_personal_det_res['other_res'] = $other_res;
			}
		}
		
		if($campus_pref_res) {
			$applicant_personal_det_res['campus_pref_res'] = $campus_pref_res;
		}

		if($applicant_personal_det_res)
		{
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_MARCH , FORM_WIZARD_PREFERENCE_PERSONAL_ID);
		}

		$this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
	}


	public function march_parent_detail_post() {
    	$app_form_id = APP_FORM_ID_MARCH;
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
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_MARCH , FORM_WIZARD_PARENT_ID);
			$applicant_personal_det_res['parent_res'] = $parent_res;

		}

		$this->response (
                                [
                                    'status' => TRUE ,
                                    'message' => $applicant_personal_det_res
                                ] , API_Controller::HTTP_OK
                            );
		
    }

    public function march_acdemic_dtl_post() {
    	$app_form_id = APP_FORM_ID_MARCH;
					
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
		$current_education_qual_status = $this->post('current_education_qual_status',true);
		
		$scl_det_id = $this->post('scl_det_id',true);
		$applicant_grad_det_id=$this->post('grad_id_1',true);

		$scl_det_id = $this->post('scl_det_id',true);
		$school_institute_name = $this->post('school_institute_name',true);
		$school_board = $this->post('school_board',true);
		$school_marking_schema = $this->post('school_marking_schema',true);
		$school_obtained_percentage_cgpa = $this->post('school_obtained_percentage_cgpa',true);
		$school_year_pass = $this->post('school_year_pass',true);
		$school_reg_roll = $this->post('school_reg_roll',true);
		


		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
		$applicant_appln_id = $applicant_appln_det_res['id'];

		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		//$_POST['created_by'] = $applicant_personal_det_id;
		//$_POST['updated_by'] = $applicant_personal_det_id;
		$_POST['applicant_appln_id'] = $applicant_appln_id;
		$_POST['applicant_scl_det_id'] = $scl_det_id;
		$_POST['applicant_grad_det_id'] = $applicant_grad_det_id;
		$_POST['applicant_personal_det_id'] = $applicant_personal_det_id;
		

		

		$_POST['result_declared'] = 'f';
		$_POST['is_curr_qualify'] = 'f';						
		if($current_education_qual_status == 2)
		{
			$_POST['result_declared'] = 't';
			$_POST['is_curr_qualify'] = 't';
		}
		else
		{
			$_POST['mark_scheme_id'] = NULL;
			$_POST['mark_percent'] = NULL;
		}
		

		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('current_education_qual_status', 'Current Education Qualification Status','trim|required');
		$this->form_validation->set_rules('name_as_in_marksheet', 'Candidate Name as in 10th Certificate','trim|required');
		$this->form_validation->set_rules('school_institute_name', 'Institute name','trim|required');
		$this->form_validation->set_rules('school_board', '10th Board','trim|required');
		//$this->form_validation->set_rules('school_mode_of_study', '10th Mode of Study','trim|required');
		$this->form_validation->set_rules('school_marking_schema', '10th Marking Schema','trim|required');
		$this->form_validation->set_rules('school_obtained_percentage_cgpa', '10th Obtained Percantage','trim|required');
		$this->form_validation->set_rules('school_year_pass', '10th Year Pass','trim|required');
		$this->form_validation->set_rules('school_reg_roll', '10th Roll No','trim|required');
		
		if($current_education_qual_status == 2) {
			$this->form_validation->set_rules('mark_scheme_id', 'Graduation Marking Scheme','trim|required');
			$this->form_validation->set_rules('mark_percent', 'Graduation Obtained Percentage/CGPA','trim|required');
		}
		$this->form_validation->set_rules('insti_name', 'Graduation Institute name','trim|required');
		$this->form_validation->set_rules('univ_id', 'Graduation Board','trim|required');
		$this->form_validation->set_rules('completion_year', 'Graduation Year of Pass','trim|required');
		$this->form_validation->set_rules('registration_no', 'Graduation Reg no','trim|required');


		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}

		$function_name = $this->get_function_name(__FUNCTION__);
		$applicant_schooling_det_columns = 'applicant_scl_det_id,applicant_personal_det_id,applicant_appln_id,institute_name,board_id,marking_scheme_id,mark_percentage,completion_year,registration_no,name_as_in_marksheet,schooling_id,active,result_declared,is_curr_qualify';
		if($scl_det_id) {
			//$applicant_schooling_det_columns .= ',updated_by';
		} else {
			//$applicant_schooling_det_columns .= ',created_by';
		}

		$applicant_graduation_columns = 'applicant_grad_det_id,applicant_personal_det_id,insti_name,univ_id,mark_scheme_id,mark_percent,completion_year,active,registration_no,applicant_appln_id,mode_of_study_id,is_curr_qualify';

		$applicant_personal_det_columns = 'applicant_personal_det_id,digilocker_id';


		
	    $app_personal_details_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns);


	    $graduation_details_res = array();
	    

		if($applicant_grad_det_id) {

			$graduation_details_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'applicant_grad_det_id'=>$applicant_grad_det_id), $table_schema, $applicant_graduation_table, $applicant_graduation_columns, 2, 'applicant_grad_det_id', $applicant_grad_det_id);
			

		} else {
			$graduation_details_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_graduation_table, $applicant_graduation_columns, 1, 'applicant_grad_det_id');
		}

		
		$school_dtl_res = array();

		if($school_institute_name) {
					$n_school_institue_name = $school_institute_name;
					$n_board = $school_board;
					$n_marking_schema = $school_marking_schema;
					$n_mark_percentage = $school_obtained_percentage_cgpa;
					$n_completion_year = $school_year_pass;
					$n_registration_no = $school_reg_roll;
					$n_name_as_in_marksheet = $this->input->post('name_as_in_marksheet');
					$n_applicant_scl_det_id = $scl_det_id;	
					$_SERVER["REQUEST_METHOD"] = "POST";
					$_POST = array();
					$_POST['result_declared'] = 'f';
					$_POST['is_curr_qualify'] = 'f';						
					if($current_education_qual_status == 2)
					{
						$_POST['result_declared'] = 't';
						$_POST['is_curr_qualify'] = 't';
					}
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
						$_POST['marking_scheme_id'] = $n_marking_schema; 
						$_POST['mark_percentage'] = $n_mark_percentage; 
						$_POST['completion_year'] = $n_completion_year; 
						$_POST['registration_no'] = $n_registration_no;
						$_POST['name_as_in_marksheet'] = $n_name_as_in_marksheet; 
						$_POST['applicant_appln_id'] = $applicant_appln_id; 
						$_POST['active'] = TRUE;
						//$_POST['created_by'] = $applicant_personal_det_id;
						//$_POST['updated_by'] = $applicant_personal_det_id;
						$_POST['applicant_personal_det_id']=$applicant_personal_det_id;  
						$n_marking_schema_post=($n_marking_schema !='' && $n_marking_schema !='null')? $n_marking_schema : NULL;
						$_POST['marking_scheme_id'] = $n_marking_schema_post; 
						   
					
					if($n_applicant_scl_det_id) {									
								$school_dtl_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, 
									$applicant_schooling_dt_table, 
									$applicant_schooling_det_columns, 1, 'applicant_scl_det_id', $n_applicant_scl_det_id);
						}
						else {
						$chk_flag = false;
						/*echo $n_school_institue_name;
						echo $n_marking_schema;
						echo $n_mark_percentage;
						echo $n_completion_year;
						echo $n_registration_no;
						die;*/									
					
						if(!$n_school_institue_name && !$n_marking_schema && !$n_mark_percentage && !$n_completion_year && !$n_registration_no && $current_education_qual_status=2  && !$n_board) {
								$chk_flag = true;
						}
						else if(!$n_school_institue_name && !$n_board && $current_education_qual_status=1) {
								$chk_flag = true;
						}
						if(!$chk_flag) {
								// echo 'n_grad_det_id 2'."\n";
								$school_dtl_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_schooling_dt_table, $applicant_schooling_det_columns, 1, 'applicant_scl_det_id');
						}
						

							}
				
		}




		if($school_dtl_res) {
					$app_personal_details_res['school_dtl_res'] = $school_dtl_res;
			}

		if($graduation_details_res) {
			$app_personal_details_res['graduation_details_res'] = $graduation_details_res;
		}
		

		if($app_personal_details_res)
		{
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_MARCH , FORM_WIZARD_ACADEMIC_ID);
		}

		$this->response ($app_personal_details_res , API_Controller::HTTP_OK);
		
			
    }

    public function march_declaration_detail_post(){

    	$app_form_id = APP_FORM_ID_MARCH;
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
		$applicant_appln_det_columns = 'applicant_appln_id,applicant_personal_det_id,applicant_name_declaration,applicant_parentname_declaration,applicant_declaration_date,active';
		//  applicant_personal_det insert / update
		$applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, array('applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns);
		if($applicant_appln_det_res)
		{
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_MARCH , FORM_WIZARD_DECLARATION_ID);
			/*$wizard_update = $this->common_application_status_update($applicant_personal_det_id , $applicant_appln_id);*/
		}
		$this->response ($applicant_appln_det_res , API_Controller::HTTP_OK);

    }

	/*MArch_design API End*/

	protected function _get_error_status($res) {
		if($res) {
			$arr_res = array_column($res, 'status');
			$arr_res = array_unique($arr_res);
			if(in_array('error', $arr_res)) {
				$arr_res_key = array_search('error', $arr_res);
				$this->response ($res[$arr_res_key] , API_Controller::HTTP_OK);
			}
		}
	}


	public function upload_final_step_post() {
		$app_form_id = $this->input->post('app_form_id');
		$is_notfinal 	 = $this->input->post('is_notfinal');
		$is_notfinal=($is_notfinal)?$is_notfinal:'';
		$form_wizard_upload_id = FORM_WIZARD_UPLOAD_ID;

    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		// _get_appln_form_id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
		$applicant_appln_id = $applicant_appln_det_res['id'];
		// common_wizardupdate
		$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id , $form_wizard_upload_id);
		if($is_notfinal !='')
		{
			$this->response (
                                [
                                    'status' => TRUE ,
                                    'message' => UPDATED_SUCCESS_UPLOAD_WIZARD ,
                                ] , API_Controller::HTTP_OK
                            );
		}


		$application_completed = APPLICATION_IN_COMPLETED;
		$applicant_appln_det_table = APPLICANT_APPLN; 
		$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		$_POST['updated_by'] = $applicant_personal_det_id;
		$_POST['application_status_id'] = $application_completed;
		$_POST['applicant_appln_id'] = $applicant_appln_id;
		$_POST['applicant_personal_det_id'] = $applicant_personal_det_id;
		$function_name = $this->get_function_name(__FUNCTION__);

		$applicant_appln_det_columns = 'applicant_appln_id,applicant_personal_det_id,updated_by,active,updated_at';
		if($is_notfinal == '')
		{
			$applicant_appln_det_columns .= ',application_status_id';
		}
		//  applicant_personal_det insert / update
		// common_application_status_update
		$applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, array('applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns);
		
		$this->response ($applicant_appln_det_res , API_Controller::HTTP_OK);
    }

}

	