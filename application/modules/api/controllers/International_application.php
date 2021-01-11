<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package SRM - Online Application
 * @category APPlications API
 * @subpackage Users
 *
 * @SWG\Resource(
 *  apiVersion="0.1",
 *  swaggerVersion="1.2",
 *  resourcePath="/api",
 *  produces="['application/json']"
 * )
 *
 */
class International_application extends API_Controller {

	public function __construct()
	{		
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('Auth_Ldap');
	}


	/**
     * create applicant_appln_det list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the applicant_appln_det list
     * @param string $id applicant_appln_det id
     * @return json response of applicant_appln_det list by page & limit
     * @author
     */

    public function international_basic_detail_post()
	{
		$table = APPLICANT_APPLN;
		$table_schema = SCHEMA_ADMISSION;
		$applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
		$function_name = $this->get_function_name(__FUNCTION__);
		$table_prefix = '';		
		$form_id = $this->input->post('appln_form_id');
		$applicant_personal_det_id = $this->input->post('applicant_personal_det_id');
		$application_inprogress_id = APPLICATION_IN_PROGRESS;
		$qualifyingexamfromindia = 't';
		$sponsor_relationship = $this->post('sponsor_relationship',true);
		$sponsor_relationship=($sponsor_relationship!='' && $sponsor_relationship!='null')?$sponsor_relationship : NULL;
		$resident_category_id = $this->post('resident_category_id',true);
		$appln_status = $this->post('appln_status',true);
		$is_agree = $this->post('is_agree',true);
		if($is_agree == 1) {
			$is_agree = 't';
		} else {
			$is_agree = 'f';
		}

		$columns ='applicant_appln_id,appln_form_id,form_name,active,appln_form_id,qualifyingexamfromindia
					,applicant_personal_det_id,is_agree';
		$applicant_personal_det_columns = 'applicant_personal_det_id,resident_category_id,sponsor_name,sponsor_relationship_id,active';	

		$check_user = $this->check_exist_user($table , $table_schema , $columns ,  $applicant_personal_det_id, false, false,  false, $form_id );

		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		$_POST['qualifyingexamfromindia'] = $qualifyingexamfromindia;
		$_POST['application_status_id'] = $application_inprogress_id;
		$_POST['sponsor_relationship_id'] = $sponsor_relationship;
		$_POST['is_agree'] = $is_agree;

		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('appln_form_id', 'Form id','trim|required');
		$this->form_validation->set_rules('resident_category_id', 'Resident Category ID','trim|required');
		if($resident_category_id == NRI_SPONSERED_VAL)
		{			
			$this->form_validation->set_rules('sponsor_relationship', 'Sponsor Relationship','trim|required');
			$this->form_validation->set_rules('sponsor_name', 'Sponsor Name','trim|required');
		}else {
			$_POST['sponsor_relationship_id'] = NULL;
			$_POST['sponsor_name'] = NULL;
		}
		
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}



		if(!empty($check_user['data']))
		{
			if($appln_status != APPLICATION_IN_COMPLETED) {  	
        	$columns .= ',application_status_id';
        	}
			$put_array = $_POST;
			$applicant_appln_id = $check_user['data'][0]['applicant_appln_id'];			
			$put_array[$table_prefix.'id'] = $applicant_appln_id;
			$put_array[$table_prefix.'qualifyingexamfromindia'] = $qualifyingexamfromindia;
			$update = $this->_common_update ( $table , $table_prefix , $function_name , $columns , $put_array ,  'applicant_appln_id',$table_schema);
			if($update)
			{

			$function_name = $this->get_function_name(__FUNCTION__);
			$applicant_personal_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns);
			
			// common_application_status_update for Application inprogress status update purpose
			
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
				$function_name = $this->get_function_name(__FUNCTION__);
				$applicant_personal_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns);

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

	public function international_personal_detail_post()
	{
		$applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
		$applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
		$applicant_course_prefer_table = APPLICANT_COURSE_PREFER_TABLE;
		$applicant_campus_prefer_table = APPLICANT_CAMPUS_PREFER_TABLE;
		$applicant_appln_det_table = APPLICANT_APPLN;
		$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';

		$app_form_id = APP_FORM_ID_INTERNATIONAL;

		$course_prefer_id = $this->post('course_prefer_id',true);
		$course_prefer_id = json_decode($course_prefer_id,true);

		$course_choice_no = $this->post('course_choice_no',true);
		$course_choice_no = json_decode($course_choice_no,true);

		$stream_pref = $this->post('stream_pref',true);
		$stream_pref = json_decode($stream_pref,true);

		$deg_pref = $this->post('deg_pref',true);
		$deg_pref = json_decode($deg_pref,true);

		$course_pref = $this->post('course_pref',true);
		$course_pref = json_decode($course_pref,true);

		$spec_pref = $this->post('spec_pref',true);
		$spec_pref = json_decode($spec_pref,true);

		$grad_id_val = $this->post('program_level',true);

		//$grad_id = 	LAW_GRADUATION_ID;
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);

		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
		$applicant_appln_id = $applicant_appln_det_res['id'];

		// get course prefer id - prog id
		$applicant_course_prefer_res = $this->_get_prog_id_by_preference_dtl($grad_id, false, $app_form_id, $course_pref);
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		$_POST['grad_id'] = $grad_id_val;
		$phone_no_code = $this->input->post('mobile_no_code');
		$_POST['applicant_mob_country_code_id'] = $phone_no_code;
		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('first_name', 'First Name','trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name','trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile No','trim|required');
		$this->form_validation->set_rules('email_id', 'Email Id','trim|required');
		$this->form_validation->set_rules('dob', 'Date Of Birth','trim|required');
		$this->form_validation->set_rules('gender_id', 'Gender','trim|required');
		$this->form_validation->set_rules('title_id', 'Title','trim|required');
		$this->form_validation->set_rules('nationality_id', 'Nationality','trim|required');
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}

		$applicant_personal_det_columns = 'applicant_personal_det_id,title_id,first_name,middle_name,last_name,mobile_no,email_id,dob,gender_id,active,nationality_id,residing_country_id';

		$applicant_course_prefer_columns = 'applicant_personal_det_id,course_id,course_name,choice_no,active,applicant_appln_id,stream_id,splpref_id,deg_id';
		if($course_prefer_id) {
			$applicant_course_prefer_columns .= ',applicant_course_prefer_id';	
		}

		$applicant_appln_det_columns = 'applicant_appln_id,applicant_personal_det_id,updated_by,active,grad_id';


		$function_name = $this->get_function_name(__FUNCTION__);
		/*$this->response (
	                [
	                    'status' => 'error' ,
	                    'message' => $applicant_personal_det_table.$applicant_personal_det_id,
	                ] , API_Controller::HTTP_OK
	            );*/
		//  applicant_personal_det insert / update
		$applicant_personal_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns);



		$applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, array('applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns);



		$course_res = array();

		if($course_pref) {
			foreach($course_pref as $k=>$v) {
				$n_course_pref = $v;
				$n_campus_pref = $campus_pref[$k];
				$n_applicant_course_prefer_res = $applicant_course_prefer_res[$k];
				$n_course_prefer_id = $course_prefer_id[$k];
				$n_course_choice_no = $course_choice_no[$k];
				$n_stream_id = $stream_pref[$k];
				$n_deg_id = $deg_pref[$k];
				$n_spec_id = $spec_pref[$k];
				
				$_SERVER["REQUEST_METHOD"] = "POST";
				$_POST = array();
				if($n_course_prefer_id) {
					$_POST['applicant_course_prefer_id'] = $n_course_prefer_id;	
				}
				$n_spec_id=($n_spec_id!='' && $n_spec_id!='null')?$n_spec_id : NULL;
				$n_deg_id=($n_deg_id!='' && $n_deg_id!='null')?$n_deg_id : NULL;
				$n_stream_id=($n_stream_id!='' && $n_stream_id!='null')?$n_stream_id : NULL;
				// $_POST['course_id'] = $n_course_pref;
				$_POST['course_id'] = $n_applicant_course_prefer_res;
				$_POST['splpref_id'] = $n_spec_id;
				$_POST['deg_id'] = $n_deg_id;
				$_POST['stream_id'] = $n_stream_id;
				$_POST['choice_no'] = $n_course_choice_no;
				$_POST['applicant_appln_id'] = $applicant_appln_id;
				$_POST['active'] = TRUE;

				$n_course_pref=($n_course_pref!='' && $n_course_pref!='null')?$n_course_pref : NULL;
				
				// echo 'n_course_prefer_id => '.$n_course_prefer_id."\n";die;
				if($n_course_prefer_id) {
					if(!$n_course_pref)
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
					if(!$n_course_pref) {
						$chk_flag = true;
					}
					if(!$chk_flag) {
						$course_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_course_prefer_table, $applicant_course_prefer_columns, 1, 'applicant_course_prefer_id');
					}
				}
			}
		}

		if($applicant_personal_det_res)
		{
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id , FORM_WIZARD_PREFERENCE_PERSONAL_ID);
		}


		$this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);

	}


	public function international_parent_detail_post() {
    	$app_form_id = APP_FORM_ID_INTERNATIONAL;
    	$applicant_parent_det_table = APPLICANT_PARENT_DET_TABLE;
    	$applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
    	$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$father_parent_det_id = $this->post('father_parent_det_id',true);
		$mother_parent_det_id = $this->post('mother_parent_det_id',true);
		$guardian_parent_det_id = $this->post('guardian_parent_det_id',true);
		$relationship_id = $this->post('relationship_id',true);
		$user_data = $this->post();
		$add_parent_checkbox = $user_data['add_parent_checkbox'];
		if($add_parent_checkbox=='true'){
			$add_parents = 't';
		}else{
			$add_parents = 'f';
		}



		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
		$applicant_appln_id = $applicant_appln_det_res['id'];

		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		$_POST['add_gardian'] = $add_parents;
		$_POST['applicant_appln_id'] = $applicant_appln_id;

		$applicant_other_details_columns = 'applicant_personal_det_id,applicant_appln_id,add_gardian,active';

		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('parent_guardian_name', 'Guardian Name','trim|required');
			$this->form_validation->set_rules('guardian_mobile_no', 'Guardian Mobile No','trim|required');
		/*$this->form_validation->set_rules('parent_father_name', 'Father Name','trim|required');
		$this->form_validation->set_rules('father_title', 'Father Title','trim|required');
		$this->form_validation->set_rules('parent_mother_name', 'Mother Name','trim|required');
		$this->form_validation->set_rules('mother_title', 'Mother Title','trim|required');
		if($add_gardian == 't') {
			
		}*/
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}

		$function_name = $this->get_function_name(__FUNCTION__);
		
		//  applicant_other_details insert / update
		$other_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_other_details_table, $applicant_other_details_columns,false,'applicant_other_det_id');

		if($add_parents=='t'){
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
		$other_occupation_father = $user_data['other_occupation_father'];
		
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
		$other_occupation_mother = $user_data['other_occupation_mother'];	

		$applicant_parent_det_id[] = $father_parent_det_id;
		$parent_type_id[] = $parent_type_father_id;
		$parent_name[] = $parent_father_name;
		$mobile_no[] = $father_mobile_no;
		$alt_mobile_no[] = $father_alt_mobile_no;
		$email_id[] = $father_email_id;
		$occupation[] = $father_occupation;
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
		$mob_country_code_id[] = $mother_mob_country_code_id;
		$alt_mob_country_code_id[] = $mother_alt_mob_country_code_id;
		$title[] = $mother_title;
		$other_occupation_name[] = $other_occupation_mother;
		}
		// Guardian Detail
		
		$parent_type_guardian_id = $user_data['parent_type_guardian_id'];
		$parent_guardian_name = $user_data['parent_guardian_name'];
		$guardian_mobile_no = $user_data['guardian_mobile_no'];
		$guardian_alt_mobile_no = $user_data['guardian_alt_mobile_no'];
		$guardian_email_id = $user_data['guardian_email_id'];
		$guardian_occupation = $user_data['guardian_occupation'];
		$guardian_mob_country_code_id = $user_data['guardian_mob_country_code_id'];
		$guardian_alt_mob_country_code_id = $user_data['guardian_alt_mob_country_code_id'];
		$other_occupation_guardian = $user_data['other_occupation_guardian'];

		$applicant_parent_det_id[] = $guardian_parent_det_id;
		$parent_type_id[] = $parent_type_guardian_id;
		$parent_name[] = $parent_guardian_name;
		$mobile_no[] = $guardian_mobile_no;
		$alt_mobile_no[] = $guardian_alt_mobile_no;
		$email_id[] = $guardian_email_id;
		$occupation[] = $guardian_occupation;
		$mob_country_code_id[] = $guardian_mob_country_code_id;
		$alt_mob_country_code_id[] = $guardian_alt_mob_country_code_id;
		$title[] = $guardian_title;
		$other_occupation_name[] = $other_occupation_guardian;

		// parent detail


		if($add_parents=='f'){
                $whereparentgno = array();
                $whereparentgno['applicant_personal_det_id'] = $applicant_personal_det_id;
                $whereparentgno['parent_type_id'] = PARENT_TYPE_ID_FATHER;
                $whereparentgno['applicant_appln_id'] = $applicant_appln_id;
                $whereparentgno['table_schema'] = SCHEMA_ADMISSION;
                $this->common->common_delete_new ( $applicant_parent_det_table , $whereparentgno );
                
            }

        if($add_parents=='f'){
                $whereparentgno = array();
                $whereparentgno['applicant_personal_det_id'] = $applicant_personal_det_id;
                $whereparentgno['parent_type_id'] = PARENT_TYPE_ID_MOTHER;
                $whereparentgno['applicant_appln_id'] = $applicant_appln_id;
                $whereparentgno['table_schema'] = SCHEMA_ADMISSION;
                $this->common->common_delete_new ( $applicant_parent_det_table , $whereparentgno );
                
            }

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
				$n_other_occupation_name = $other_occupation_name[$k];
				//print_r($n_applicant_parent_det_id);die;
				$_SERVER["REQUEST_METHOD"] = "POST";
				$_POST = array();

				//$applicant_parent_det_columns = 'applicant_personal_det_id,applicant_appln_id,parent_type_id,parent_name,active,updated_by';
				$applicant_parent_det_columns = 'applicant_personal_det_id,applicant_appln_id,parent_type_id,parent_name,active,updated_by,alt_mob_countrycode_id,mobile_no,mob_country_code_id,occupation_id,email_id,alt_mobile_no,title_id';
				if($n_parent_type_id == PARENT_TYPE_ID_GUARDIAN)
				{
					$applicant_parent_det_columns .=',relationship_id';
					$_POST['relationship_id']=$relationship_id;
				}
				

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

				
				if($n_occupation==OTHER_OCCUPATION)
				{
				    $applicant_parent_det_columns .= ',other_occupation_name';
				    $_POST['other_occupation_name'] = $n_other_occupation_name;
				}else{
				    $applicant_parent_det_columns .= ',other_occupation_name';
				    $_POST['other_occupation_name'] = NULL;
				}
				
				
				if($n_applicant_parent_det_id) {
					$_POST['applicant_parent_det_id'] = $n_applicant_parent_det_id;	
					$applicant_parent_det_columns .= ',applicant_parent_det_id';
				}



				$_POST['parent_type_id'] = $n_parent_type_id;
				$_POST['parent_name'] = $n_parent_name;
				
				
				$_POST['applicant_appln_id'] = $applicant_appln_id;
				
				if($n_applicant_parent_det_id) {
					$parent_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'applicant_parent_det_id'=>$n_applicant_parent_det_id), $table_schema, $applicant_parent_det_table, $applicant_parent_det_columns, 2, 'applicant_parent_det_id', $n_applicant_parent_det_id);
				} else {
					$chk_flag = false;
					if(!$n_parent_name && !$n_title) {
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
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id , FORM_WIZARD_PARENT_ID);
		}

		$this->response ($parent_res , API_Controller::HTTP_OK);
    }


    public function international_academic_detail_post() {
    	$app_form_id = APP_FORM_ID_INTERNATIONAL;
					
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
		
		
		$scl_det_id = $this->post('scl_det_id',true);
		$scl_det_id = json_decode($scl_det_id,true);

		$school_subject_id = $this->post('school_subject',true);
		$school_subject_id = json_decode($school_subject_id,true);

		$school_marking_schema = $this->post('school_marking_scheme',true);
		$school_marking_schema = json_decode($school_marking_schema,true);

		$school_obtained_percentage_cgpa = $this->post('school_obtained_percentage_cgpa',true);
		$school_obtained_percentage_cgpa = json_decode($school_obtained_percentage_cgpa,true);

		$school_name_as_in_marksheet = $this->post('name_as_in_marksheet',true);

		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
		$applicant_appln_id = $applicant_appln_det_res['id'];

		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		$_POST['created_by'] = $applicant_personal_det_id;
		$_POST['updated_by'] = $applicant_personal_det_id;
		$_POST['applicant_appln_id'] = $applicant_appln_id;


		

		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('name_as_in_marksheet', 'Candidate Name as in 10th Certificate','trim|required');

		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}



		$function_name = $this->get_function_name(__FUNCTION__);
		$applicant_schooling_det_columns = 'applicant_scl_det_id,applicant_personal_det_id,applicant_appln_id,institute_name,country_id,examination_id,completion_year,marking_scheme_id,name_as_in_marksheet,subject_id,mark_percentage,schooling_id,active';
		if($scl_det_id) {
			$applicant_schooling_det_columns .= ',updated_by';
		} else {
			$applicant_schooling_det_columns .= ',created_by';
		}


		$school_dtl_res = array();

		//print_r($school_subject_id);die;

		
		if($school_subject_id) {
				foreach($school_subject_id as $k=>$v) {
					$n_completion_year = $this->input->post('completion_year');
					$n_country_id = $this->input->post('country_id');
					$n_school_institue_name = $this->input->post('institute_name');
					$n_name_as_in_marksheet = $this->input->post('name_as_in_marksheet');
					$n_exam_id =$this->input->post('examination_id');



					$n_marking_schema = $school_marking_schema[$k];
					$n_mark_percentage = $school_obtained_percentage_cgpa[$k];
					$n_subject = $school_subject_id[$k];

					$n_applicant_scl_det_id = $scl_det_id[$k];	




					
					$_SERVER["REQUEST_METHOD"] = "POST";
					$_POST = array();
					

												
					if($n_applicant_scl_det_id) {
						$_POST['applicant_scl_det_id'] = $n_applicant_scl_det_id;

					}
						$_POST['institute_name'] = $n_school_institue_name; 
						
						$_POST['completion_year'] = $n_completion_year; 
						$_POST['name_as_in_marksheet'] = $n_name_as_in_marksheet; 
						
						//$_POST['board_id'] = $n_board; 
						//$_POST['marking_scheme_id'] = $n_marking_schema; 
						
						
						
						$_POST['applicant_appln_id'] = $applicant_appln_id; 
						$_POST['active'] = TRUE;
						$_POST['created_by'] = $applicant_personal_det_id;
						$_POST['updated_by'] = $applicant_personal_det_id;
						//$_POST['mode_of_study_id']=$n_mode_of_study_id; 
						$_POST['applicant_personal_det_id']=$applicant_personal_det_id;  
						$n_marking_schema_post=($n_marking_schema !='' && $n_marking_schema !='null')? $n_marking_schema : NULL;
						$n_subject_post=($n_subject !='' && $n_subject !='null')? $n_subject : NULL;
						$n_mark_percentage_post=($n_mark_percentage !='' && $n_mark_percentage !='null')? $n_mark_percentage : NULL;
						$n_country_id_post=($n_country_id !='' && $n_country_id !='null')? $n_country_id : NULL;
						$n_exam_id_post=($n_exam_id !='' && $n_exam_id !='null')? $n_exam_id : NULL;
						$_POST['subject_id'] = $n_subject_post; 
						$_POST['marking_scheme_id'] = $n_marking_schema_post; 
						$_POST['mark_percentage'] = $n_mark_percentage_post; 
						$_POST['country_id'] = $n_country_id_post; 
						$_POST['examination_id'] = $n_exam_id_post; 
					
					if($n_applicant_scl_det_id) {
						$school_dtl_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'applicant_scl_det_id'=>$n_applicant_scl_det_id), $table_schema, $applicant_schooling_dt_table, $applicant_schooling_det_columns, 2, 'applicant_scl_det_id', $n_applicant_scl_det_id);
						}
						else {
						$chk_flag = false;

						if(!$chk_flag) {
								// echo 'n_grad_det_id 2'."\n";
								$school_dtl_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_schooling_dt_table, $applicant_schooling_det_columns, 1, 'applicant_scl_det_id');
						}
						

							}
				
				}
		}

		
		


			

		if($school_dtl_res)
		{
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_INTERNATIONAL , FORM_WIZARD_ACADEMIC_ID);
		}

		$this->response ($school_dtl_res , API_Controller::HTTP_OK);
		
			
    }


	public function db_func_choice_dropdown_international_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_choice_dropdown = FN_GET_CHOICE_DROPDOWN_INTERNATIONAL_FORM;
    	$grad_id = $this->post('grad_id',true);
    	$grad_id = ($grad_id)?$grad_id:false;
    	$campus_id = $this->post('campus_id',true);
    	$campus_id = ($campus_id)?$campus_id:false;
    	$branch_id = $this->post('branch_id',true);
    	$branch_id = ($branch_id)?$branch_id:false;
    	$deg_id = $this->post('deg_id',true);
    	$deg_id = ($deg_id)?$deg_id:false;
    	$spec_id = $this->post('spec_id',true);
    	$spec_id = ($spec_id)?$spec_id:false;
    	$form_id = $this->post('form_id',true);
    	$form_id = ($form_id)?$form_id:false;
    	$stream_id = $this->post('stream_id',true);
    	$stream_id = ($stream_id)?$stream_id:false;
    	$grad_mode_id = $this->post('grad_mode_id',true);
    	$grad_mode_id = ($grad_mode_id)?$grad_mode_id:false;


		$is_course = $this->post('is_course',true);
		$is_spec = $this->post('is_spec',true);
		$is_campus = $this->post('is_campus',true);
		$is_program=$this->post('is_program',true);
		$is_regcourse = $this->post('is_regcourse',true);
		$is_stream = $this->post('is_stream',true);
		$sort_by = $this->post('sort_by',true);
		$sort_order = $this->post('sort_order',true);
		$column=array();
		if($is_course) {
			$column['id'] = 'branch_id';
			//$column['id'] = 'prog_id';
			$column['name'] = 'branch_name';
		}
		if($is_program)
		{
			$column['id'] = 'grad_id';
			$column['name'] = 'grad_short_name';
		}
		if($is_spec) {
			$column['id'] = 'spec_id';
			$column['name'] = 'spec_name';
		}
		if($is_campus) {
			$column['id'] = 'campus_id';
			$column['name'] = 'campus_name';
		}
		if($is_regcourse)
		{
			$column['id'] = 'deg_id';
			$column['name'] = 'deg_short_name';
		}
		if($is_stream)
		{
			$column['id'] = 'stream_id';
			$column['name'] = 'stream_name';
		}
		$params = array();
		$cond=array();
		$params['grad_id'] = $grad_id;
		$params['campus_id'] = $campus_id;
		$params['branch_id'] = $branch_id;
		$params['deg_id'] = $deg_id;
		$params['form_id'] = $form_id;
		$params['stream_id'] = $stream_id;

		//get exclude campus ids
		$exclude_campuspref_ids=$this->input->post('exclude_campuspref_ids');
		$exclude_coursepref_ids = $this->input->post('exclude_coursepref_ids');

        $where = array();
    	if($exclude_campuspref_ids) {
    		$where['campus_id'] = 'NOT IN ('.$exclude_campuspref_ids.')';
    	} 

    	if($exclude_coursepref_ids) {
    		$where['branch_id'] = 'NOT IN ('.$exclude_coursepref_ids.')';
    	} 
		
    	if($grad_mode_id) {
    		$params['grad_mode_id'] = $grad_mode_id;
    	}
    	
    	
    	$result = $this->db_func_call($table_schema, $fn_get_choice_dropdown, $params, $column, $sort_by, $sort_order,false,$where);
    	// select * from admission.fn_get_choice_dropdown(grad_id,campus_id,branch_id,deg_id)
    }
	
	// International address / permanent communication
	public function international_address_detail_post()
	{
		$table = TABLE_APPLICANT_ADDR_DET;
		$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';
		$applicant_personal_det_id = $this->input->post('applicant_personal_det_id');
		$is_permanent_same_as_cc = $this->input->post('is_permanent_same_as_cc');
		$app_form_id = $this->input->post('app_form_id');				
		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
		$applicant_appln_id = $applicant_appln_det_res['id'];
		
		$country_id = $this->input->post('country_id');
		$country_india = COUNTRY_VALUE_DEFAULT;
		
		$_SERVER["REQUEST_METHOD"] = "POST";
		
		$_POST['active'] = TRUE;
		$_POST['applicant_appln_id'] = $applicant_appln_id;
		$_POST['addr_type_id'] = LOOKUP_VALUE_ADDRESS_COMMUNICATION;
		
		$columns = 'applicant_personal_det_id,applicant_appln_id,country_id,state_id,city_id,address_line_1,address_line_2,addr_type_id,pincode,active';
			
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('country_id', 'Country Id','trim|required');
		$this->form_validation->set_rules('state_id', 'State Id','trim|required');
		$this->form_validation->set_rules('city_id', 'City Id','trim|required');
		$this->form_validation->set_rules('address_line_1', 'Address 1','trim|required|xss_clean|max_length[100]');
		$this->form_validation->set_rules('address_line_2', 'Address 2','trim|xss_clean|max_length[100]');
		$this->form_validation->set_rules('pincode', 'Pincode','trim|required|xss_clean|max_length[6]');
		
		if($is_permanent_same_as_cc=='no'){
			$this->form_validation->set_rules('country_id_pa', 'Country Id PA','trim|required');
			$this->form_validation->set_rules('state_id_pa', 'State Id PA','trim|required');
			$this->form_validation->set_rules('city_id_pa', 'City Id PA','trim|required');
			$this->form_validation->set_rules('address_line_1_pa', 'Address 1 PA','trim|required|xss_clean|max_length[100]');
			$this->form_validation->set_rules('address_line_2_pa', 'Address 2 PA','trim|xss_clean|max_length[100]');
			$this->form_validation->set_rules('pincode_pa', 'Pincode PA','trim|required|xss_clean|max_length[6]');
		}
		
		$state_id_post = $this->input->post('state_id');
		$city_id_post = $this->input->post('city_id');
		$country_id_post = $this->input->post('country_id');

		$_POST['state_id'] = $state_id_post;
		$_POST['city_id'] = $city_id_post;
		$_POST['country_id'] = $country_id_post;
		
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}	
		
		$international_address = array(); 
		
		// Address communication
		$international_address['communication_address'] = $this->international_cp_address($table , $table_schema , $columns , $applicant_personal_det_id,$applicant_appln_id,LOOKUP_VALUE_ADDRESS_COMMUNICATION);	
		
		// Permanent not same as communication address
		if($is_permanent_same_as_cc=='no'){
			$state_id_pa = $this->input->post('state_id_pa');
			$city_id_pa = $this->input->post('city_id_pa');
			$country_id_pa = $this->input->post('country_id_pa');
			$address_line_1_pa = $this->input->post('address_line_1_pa');
			$address_line_2_pa = $this->input->post('address_line_2_pa');
			$pincode_pa = $this->input->post('pincode_pa');			
			$_POST['addr_type_id'] = LOOKUP_VALUE_PERMANENT_ADDRESS_COMMUNICATION;
			$_POST['state_id'] = $state_id_pa;
			$_POST['city_id'] = $city_id_pa;
			$_POST['country_id'] = $country_id_pa;
			$_POST['address_line_1'] = $address_line_1_pa;
			$_POST['address_line_2'] = $address_line_2_pa;
			$_POST['pincode'] = $pincode_pa;			
			$international_address['premanent_address'] = $this->international_cp_address($table , $table_schema , $columns , $applicant_personal_det_id,$applicant_appln_id,LOOKUP_VALUE_PERMANENT_ADDRESS_COMMUNICATION);			
		}else{
			if($is_permanent_same_as_cc=="yes"){
				$wherec_cp_address = array();
				$wherec_cp_address['applicant_personal_det_id'] = $applicant_personal_det_id;
				$wherec_cp_address['addr_type_id'] = LOOKUP_VALUE_PERMANENT_ADDRESS_COMMUNICATION;
				$wherec_cp_address['applicant_appln_id'] = $applicant_appln_id;
				$wherec_cp_address['table_schema'] = SCHEMA_ADMISSION;
				$this->common->common_delete_new ( $table , $wherec_cp_address );
			}				
		}
		
		if($international_address){
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_INTERNATIONAL , FORM_WIZARD_ADDRESS_ID);
			$this->response (['status' => 'true' ,'type' => $international_address ], API_Controller::HTTP_OK);
		}
	}	
	
	// International Declaration API
	public function declaration_intl_post(){
		$app_status = APPLICATION_IN_COMPLETED;
		$table_schema = SCHEMA_ADMISSION;
		$table = $table_schema.'.'.APPLICANT_APPLN;
		$user_data = $this->post();
		$applicant_name = $user_data['applicant_name'];
		$parent_name = $user_data['parent_name'];
		$declared_date = $user_data['ddate'];
		$applicant_id = $user_data['applicant_id'];
		$applicant_appln_det_id = $user_data['applicant_appln_det_id'];

		$wheredec['applicant_personal_det_id'] = $applicant_id;		
		$wheredec['applicant_appln_id'] = $applicant_appln_det_id;		
		$put_arraydec['applicant_name_declaration']= $applicant_name;
		$put_arraydec['applicant_parentname_declaration'] = $parent_name;
		$put_arraydec['applicant_declaration_date'] = $declared_date;
		$put_arraydec['active']= true;
		$put_arraydec['updated_by']= $applicant_id;
		$update = $this->common->common_update ( $table ,'' , $put_arraydec, $wheredec);
		
		if($update){
			$wizard_update = $this->common_wizardupdate($applicant_id , APP_FORM_ID_INTERNATIONAL , FORM_WIZARD_UPLOAD_DECLARATION_ID);
			$this->output->set_output(json_encode(['status' => true])); 
		}
	}

	/*Register For International*/	

	public function register_post()
     {
          $user_data = $this->post ();
          $table_schema = SCHEMA_ADMISSION;
          $table = TABLE_APPLICANT_LOGIN;
          $personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
          $applicant_log = APPLICANT_LOG_TABLE;
          $this->set_schema($table_schema); 
          // Set validations
          $this->form_validation->set_data($user_data); 
          $this->form_validation->set_rules('display_name', 'Display Name','trim|required');
          $this->form_validation->set_rules('email', 'Email','trim|required|xss_clean|valid_email');
          $this->form_validation->set_rules('phone_no_code', 'Phone No Code','trim|required'); 
          $this->form_validation->set_rules('phone_no', 'Phone No','trim|required|xss_clean'); 
          $this->form_validation->set_rules('password', 'Password','trim|required'); 
          $this->form_validation->set_rules('stream_id', 'Stream','trim|required'); 
          $this->form_validation->set_rules('deg_id', 'Degree','trim|required');

          //Run Validations
          if ($this->form_validation->run() == FALSE) {
                $this->output->set_output(json_encode(['status' => 'error', 'message' => validation_errors()]));
            return false;
          }         

          $_POST['active']=TRUE;
          // $_POST['passwd']=USER_PASSWORD;          
          $display_name=$this->post('display_name',true);
          $email=$this->post('email',true);
          $passwd = $old_pass =$this->post('password',true);
          $passwd=password_hash($passwd, PASSWORD_DEFAULT);
          $_POST['applicant_pwd']=$passwd;
          $_POST['created_by']=CREATED_BY;
          $_POST['stream_id']= (int) $this->post('stream_id',true);
          $_POST['city_id']=(int) $this->post('city',true);
          $_POST['mob_country_code_id']=(int) $this->post('phone_no_code',true);
          $_POST['mobile_no']= $this->post('phone_no',true);
          $_POST['name']= $display_name;
          $_POST['email_id']= $email;
          $_POST['first_name']= $display_name;
          $_POST['is_international']= TRUE;
          $_POST['degree_id']= (int) $this->post('deg_id',true);
          $_POST['applicant_mob_country_code_id']=(int) $this->post('phone_no_code',true);
          
          $columns = 'applicant_pwd,email_id,mobile_no,created_by,mob_country_code_id';
          $table_prefix='';
          $function_name = $this->get_function_name ( __FUNCTION__ ); 

          $insert = $this->_common_insert ( $table , $table_prefix , $function_name , $columns , $table_schema);
          //$_POST['declaration_compl']=TRUE;
          if($insert)
          {
            $columns = 'applicant_login_id,applicant_pwd,email_id,mobile_no,created_by,mob_country_code_id';
               $params = array();
             $params['table'] = $table;
             $params['table_schema'] = $table_schema;
             $params['function_name'] = $function_name;
             $params['limit'] = 1;
             $params['columns'] = $columns;
             $params['returnresponse'] = TRUE;
             $params['pk'] = 'applicant_login_id';
             $userdata_id = $this->_select_table($params);
             $insert_id = $userdata_id['data'][0]['applicant_login_id'];
             
               //$insert_id = $this->db->insert_id();
               $_POST['applicant_login_id'] = $insert_id;
               $_POST['no_of_attempts']      = 1;
               $_POST['last_visited_at']      =date("Y-m-d H:i:s");
               if($insert_id)
               {
                    $columns = 'first_name,email_id,mobile_no,created_by,applicant_login_id,state_id,city_id,is_international,degree_id,stream_id,applicant_mob_country_code_id';
                                        
                    $personal_det_insert = $this->_common_insert ( $personal_det_table , $table_prefix , $function_name , $columns , $table_schema);
                    $this->load->helper('string');
                    $rand_str = random_string('md5').time();
                    $hash_rand_str = password_hash($rand_str,PASSWORD_DEFAULT);
                    $_POST['verification_link'] = $rand_str;
					$log_tble_col = 'applicant_login_id,last_visited_at,no_of_attempts,verification_link,created_by';
                    $insert_log_tble = $this->_common_insert ( $applicant_log , $table_prefix , $function_name , $log_tble_col , $table_schema);
                    if($admin_register) {                         
                         $this->data['display_name']   = $display_name;
                         $this->data['email']   = $email;
                         $this->data['password']   = $old_pass;
                         $this->data['verify_text']   = $rand_str;
                         $this->data['user_id']   = $insert_id;
                         $this->data['pgm_name']   = $pgm_name;
                         $this->data['is_international']   = TRUE;
                         $message = $this->load->view('email_templates/user_reg_notify_by_admin',$this->data,true);
                         $to = $email;
                         $from = USER_REGISTER_FROM;
                         $send_mail = $this->common_send_mail($subject,$message,$from,$to);
                    } else {
                         $subject = USER_REGISTER_SUBJECT;
                         $selectedTime  = date("Y-m-d H:i:s");
                         $endTime       = strtotime("+". USER_REGISTER_VERIFY_RESET_TIME. "minutes", strtotime($selectedTime)); 
                         $verify_end_time  = date('h:i A', $endTime);
                         $this->data['verify_end_time']  = $verify_end_time;
                         $this->data['display_name']   = $display_name;
                         $this->data['verify_text']   = $rand_str;
                         $this->data['user_id']   = $insert_id;
                         $this->data['pgm_name']   = $pgm_name;  
                         $this->data['is_international']   = TRUE;                       
                         $message = $this->load->view('email_templates/user_verify_notify',$this->data,true);
                         $to = $email;
                         $from = USER_REGISTER_FROM;
                         $send_mail = $this->common_send_mail($subject,$message,$from,$to);
                    }
                    if($send_mail)
                    {
                         if($admin_register) {
                              $this->output->set_output(json_encode(['status' => 'true', 'message' => REGISTER_SUCCESSFULLY,'applicant_login_id'=>$insert_id,'applicant_personal_det_id'=>$personal_det_insert]));
                         } else {
                              $this->output->set_output(json_encode(['status' => 'true', 'message' => REGISTER_SUCCESSFULLY]));    
                         }
                          
                         
                    } else {
                         $this->output->set_output(json_encode(['status' => 'error', 'message' => MAIL_COULD_NOT_SEND]));         
                    }
               }
               else
               {
                    $this->output->set_output(json_encode(['status' => 'error', 'message' => ERROR_MSG]));                   
               }
          }
     }

    /* International Login*/

    public function login_post()
	{
		$user_data = $this->post ();
		$verify_link = $this->input->post('verify_link');
		// Set validations
		$this->form_validation->set_data($user_data);		
		$this->form_validation->set_rules('email', 'email','trim|required');
		$this->form_validation->set_rules('role_id', 'role_id','trim');

		if(!empty($this->input->post('verify_link'))) {
   				$this->form_validation->set_rules('password', 'password','trim');
			} else {
	   		$this->form_validation->set_rules('password', 'password','trim|required');
			}

		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>200,'message'=>LOGIN_API_REQ_MSG)));
		}

		$admin_logged = FALSE;

		//LDAP Login
		
		/*$ldap_logged_check  = $this->checkldap_login($user_data['email'],$user_data['password']);
		if(isset($ldap_logged_check['logged_in']) && ($ldap_logged_check['logged_in'] !='' ) )
		{
			$ldap_username = $ldap_logged_check['username'];
			if($ldap_username === LDAP_ADMIN1 || $ldap_username === LDAP_ADMIN2 || 
				$ldap_username === LDAP_ADMIN3 || $ldap_username === LDAP_ADMIN4)
			{
				$admin_logged = TRUE;
				$get_atd = $this->get_accesstoken_details($user_data);	
				$return_get_atd = json_decode($get_atd,true);
				$return_get_atd['status'] = 200;
				$return_get_atd['login_ok'] = 'true';
				$return_get_atd['message'] = SUCCESS_LOGIN;
				$return_get_atd['access_level'] = ACCESS_ADMIN;
				$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
			}			
		}*/


		

		//Check ADMIN		
		/*if(($user_data['email'] == ADMAIL) && ($user_data['password'] == ADPASSWORD))
		{
				$admin_logged = TRUE;
				$get_atd = $this->get_accesstoken_details($user_data);	
				$return_get_atd = json_decode($get_atd,true);
				$return_get_atd['status'] = 200;
				$return_get_atd['login_ok'] = 'true';
				$return_get_atd['message'] = SUCCESS_LOGIN;
				$return_get_atd['access_level'] = ACCESS_ADMIN;
				$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));

		}*/
		//Check ADMIN End
		
		$table_schema = SCHEMA_ADMISSION;
		// Table List & Prefix
		$table = APPLICANT_LOGIN_TABLE;
		$personaldet_table = APPLICANT_PERSONAL_DET_TABLE;
		$table_prefix = '';

		$joins = array(
			array(
				'table' => $personaldet_table,
				'condition' => $personaldet_table.'.applicant_login_id = '.$table.'.applicant_login_id AND '.$table.".active='true'" . ' AND '.$personaldet_table.".active='true'",
				'jointype' => 'INNER'
			)
		);
		// Check Condition
				
		// Table Columns
		//$columns = $urtable.'.user_id,'.$rtable.'.role_name,user_name as username,passwd as password';
		//$columns = 'user_id,user_name as username,passwd as password,email,display_name,phone_no';
		// GET & Match Row
		$columns = 'appln_no,applicant_pwd,'.$personaldet_table.'.first_name,'.$personaldet_table.'.applicant_personal_det_id,'.$personaldet_table.'.email_id,'.$personaldet_table.'.mobile_no,'.$table.'.applicant_login_id';
		//$result = $this->User->getRows('users',$stable_prefix,$columns,$user_data);	
		$function_name = $this->get_function_name(__FUNCTION__);
		$params = array();
		$params['table'] = $table;
		$params['table_schema'] = $table_schema;
		$params['function_name'] = $function_name;
		$params['page'] = $page;
		$params['limit'] = $limit;
		$params['columns'] = $columns;
		$params['returnresponse']=TRUE;
		$params['cond'] = array($table.'.email_id' => $user_data['email'] , $personaldet_table.'.is_international' => TRUE);
		//$params['cond'] = array('user_name' => $user_data['username'] , $urtable.'.role_id' => $user_data['role_id']);	
		$params['joins'] = $joins;		

		$result = $this->_select_table($params);
		$verify_pwd = $result['data'][0]['applicant_pwd'];
		$user_id = $result['data'][0]['applicant_login_id'];		
		$check_verify = $this->check_verificationlink($user_id);
		if(!$admin_logged) //admin logged check
		{
			if($check_verify === 1) //check verification
			{
					if((isset($result['data'])) && !empty($result['data'])) 
					{				
						if(password_verify($user_data['password'],$verify_pwd)){
							$get_atd = $this->get_accesstoken_details($result);	
							$return_get_atd = json_decode($get_atd,true);
							$return_get_atd['status'] = 200;
							$return_get_atd['login_ok'] = 'true';
							$return_get_atd['message'] = SUCCESS_LOGIN;
							$return_get_atd['access_level'] = STUDENT_ACCESS;
							$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
						}
						else
						{
							$return_get_atd['status'] = 200;
							$return_get_atd['login_ok'] = 'false';
							$return_get_atd['message'] = LOGIN_API_FAILED_MSG;
							$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
						}
					}
					else
					{
						$return_get_atd['status'] = 200;
						$return_get_atd['login_ok'] = 'false';
						$return_get_atd['message'] = LOGIN_API_FAILED_MSG;
						$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
					}
				

			}
			else
			{
				$return_get_atd['status'] = 200;
				$return_get_atd['login_ok'] = 'false';
				$return_get_atd['message'] = VERIFY_ERR;
				$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
			}
		}
		//}
	}

	public function checkldap_login($username,$password)
    {
    	$auth_login = $this->auth_ldap->login($username,$password);
    	$auth_logged = json_decode($auth_login,true);
    	return $auth_logged;
    }

    public function check_verificationlink($user_id)
     {   
          $user_data = $this->post ();
          // Table List & Prefix
          $table = APPLICANT_LOG_TABLE;
          $table_schema = SCHEMA_ADMISSION;
         // $verify_text = $this->input->post('verify_text');
          //$user_id = $user_id;
          $table_prefix = 'user';
          $columns = 'applicant_login_id,last_visited_at,no_of_attempts,verification_link';
          $function_name = $this->get_function_name(__FUNCTION__);
          $cond = array('verification_link IS NOT NULL');
          $cond['applicant_login_id'] = $user_id;
          $params = array();
          $params['table'] = $table;
          $params['table_schema'] = $table_schema;
          $params['function_name'] = $function_name;
          $params['page'] = $page;
          $params['limit'] = $limit;
          $params['columns'] = $columns;
          $params['returnresponse']=TRUE;
          $params['return_type']='single';
          $params['cond'] = $cond;  
          $result = $this->_select_table($params);
          if($result['data'])
          {
          	return 0;
          }
          else
          {
          	return 1;
          }
    }



}