<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package SRM - Online Application
 * @category APPlications API
 * @subpackage Bscam
 *
 * @SWG\Resource(
 *  apiVersion="0.1",
 *  swaggerVersion="1.2",
 *  resourcePath="/api",
 *  produces="['application/json']"
 * )
 *
 */
class Bscam extends API_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
	
	// B.sc aircraft API started
	public function basic_detail_bsc_am_post(){
		$app_form_id_bscam 	          = APP_FORM_ID_BSCAM;
		$table_schema                 = SCHEMA_ADMISSION;
		$applicant_appln_table        = APPLICANT_APPLN;
		$applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
		$table_prefix                 = '';
		$function_name                = $this->get_function_name(__FUNCTION__);
		
		// Columns
		$applicant_appln_columns = 'grad_id,qualifyingexamfromindia,active,is_agree,application_status_id';
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$qualifyingexamfromindia = $this->post('qualifyingexamfromindia',true);
		$is_agree = $this->post('is_agree',true);
		$appln_status = $this->post('appln_status',true);
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		$_POST['grad_id'] = UG_GRAD;
		if($appln_status == APPLICATION_IN_COMPLETED){
			$_POST['application_status_id'] = APPLICATION_IN_COMPLETED;
		}

		if($is_agree=='on'){
			$is_agree = true;
		}else{
			$is_agree = false;
		}
		
		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_bscam);
		$applicant_appln_id = $applicant_appln_det_res['id'];
        if($applicant_appln_id != false){
        	$_POST['applicant_appln_id']=$applicant_appln_id;
        	$applicant_appln_columns .= ',applicant_appln_id';
        }		
		
		$appln_status = $this->post('appln_status',true);
        if($appln_status != APPLICATION_IN_COMPLETED){
            $_POST['application_status_id'] = APPLICATION_IN_PROGRESS;
            $applicant_appln_columns .= ',application_status_id';
        }  			
		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('qualifyingexamfromindia', 'qualifying from india','trim|required');
		$this->form_validation->set_rules('is_agree', 'Is agree','trim|required');
		
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}
		
		$qualifying_exam_from_india = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_table, $applicant_appln_columns, 2);
		
		if($qualifying_exam_from_india) {
			if($qualifying_exam_from_india['status'] == 'error') {
				$this->response ($qualifying_exam_from_india , API_Controller::HTTP_OK);
			} else {
				// Update Wizard ID
				$response['forn_w_wizard_id'] = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_bscam , FORM_WIZARD_BASIC_ID);
				$response['qualifying_exam_from_india'] = $qualifying_exam_from_india;
			}
		}		
		$this->response ($response , API_Controller::HTTP_OK);
	}
	
	public function personal_detail_bsc_am_post(){
		$app_form_id_bscam = APP_FORM_ID_BSCAM;
		$table_schema = SCHEMA_ADMISSION;
		$applicant_course_prefer_table = APPLICANT_COURSE_PREFER_TABLE;
		$applicant_campus_prefer_table = APPLICANT_CAMPUS_PREFER_TABLE;
		$applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
		$applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
		$table_prefix = '';
		$function_name = $this->get_function_name(__FUNCTION__);
		
		// Columns
		$applicant_course_det_columns = 'course_id,choice_no,applicant_personal_det_id,active,applicant_appln_id';
		$applicant_campus_det_columns = 'choice_no,campus_id,applicant_personal_det_id,active,applicant_appln_id';

		$applicant_other_details_columns = 'applicant_personal_det_id,medofinst,active,applicant_appln_id';
		// Preference Detail
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$campus_id = $this->post('campus_id',true);
		$course_id = $this->post('course_id',true);
		$choice_no = $this->post('choice_no',true);
		
		// Personal Detail Data
		$gender_title_id = $this->post('gender_title_id',true);
		$first_name = $this->post('first_name',true);
		$middle_name = $this->post('middle_name',true);
		$last_name = $this->post('last_name',true);
		$phone_no_code = $this->post('phone_no_code',true);
		$mobile_no = $this->post('mobile_no',true);
		$email_id = $this->post('email_id',true);
		$dob = $this->post('dob',true);
		$gender_id = $this->post('gender_id',true);
		$alt_email = $this->post('alt_email',true);
		$blood_group_id = $this->post('blood_group_id',true);
		$religion_id = $this->post('religion_id',true);
		$mother_tongue_id = $this->post('mother_tongue_id',true);
		$medofinst_id = $this->post('medofinst_id',true);
		$hostel_accomadation_id = $this->post('hostel_accomadation_id',true);
		$diffrently_abled_id = $this->post('diffrently_abled_id',true);
		$admission_adv_id = $this->post('admission_adv_id',true);
		$nationality_id = $this->post('nationality_id',true);
		$social_status_id = $this->post('social_status_id',true);
		
		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('course_id', 'Special Preference','trim|required');
		$this->form_validation->set_rules('campus_id', 'Campus','trim|required');
		$this->form_validation->set_rules('gender_title_id', 'Gender Title','trim|required');
		$this->form_validation->set_rules('first_name', 'First Name','trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name','trim|required');
		$this->form_validation->set_rules('mobile_no', 'Mobile No','trim|required');
		$this->form_validation->set_rules('email_id', 'Email Id','trim|required');
		$this->form_validation->set_rules('dob', 'Date Of Birth','trim|required');
		$this->form_validation->set_rules('gender_id', 'Gender','trim|required');
		$this->form_validation->set_rules('blood_group_id', 'Blood Group','trim|required');
		$this->form_validation->set_rules('diffrently_abled_id', 'Diffrently Abled','trim|required');
		$this->form_validation->set_rules('nationality_id', 'Nationality','trim|required');
		$this->form_validation->set_rules('social_status_id', 'Community','trim|required');
		
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}
		
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		$_POST['course_id'] = $course_id;
		$_POST['choice_no'] = $choice_no;
		$_POST['title_id'] = $gender_title_id;
		$_POST['first_name'] = $first_name;
		$_POST['middle_name'] = $middle_name;
		$_POST['last_name'] = $last_name;	
		$_POST['applicant_mob_country_code_id'] = ($phone_no_code!='' && $phone_no_code!='null')?$phone_no_code : NULL;
		$_POST['mobile_no'] = $mobile_no;
		$_POST['email_id'] = $email_id;
		$_POST['dob'] = $dob;
		$_POST['gender_id'] = $gender_id;
		$_POST['second_email_id'] = $alt_email;
		$_POST['blood_grp_id'] = $blood_group_id;
		$_POST['religion_id'] = ($religion_id!='' && $religion_id!='null')?$religion_id : NULL;
		$_POST['mothertongue_id'] = ($mother_tongue_id!='' && $mother_tongue_id!='null')?$mother_tongue_id : NULL;
		$_POST['medofinst'] = ($medofinst_id!='' && $medofinst_id!='null')?$medofinst_id : NULL;
		$_POST['prefer_hostel'] = ($hostel_accomadation_id!='' && $hostel_accomadation_id!='null')?$hostel_accomadation_id : NULL;
		$_POST['diff_abled'] = $diffrently_abled_id;
		$_POST['advertisement_source_id'] = ($admission_adv_id!='' && $admission_adv_id!='null')?$admission_adv_id : NULL;
		$_POST['nationality_id']= $nationality_id;
		$_POST['social_status_id'] = ($social_status_id=='null')?'0':$social_status_id;
		
		$applicant_personal_det_columns = 'applicant_personal_det_id,title_id,first_name,middle_name,last_name,applicant_mob_country_code_id,mobile_no,email_id,dob,gender_id,second_email_id,blood_grp_id,social_status_id,religion_id,mothertongue_id,advertisement_source_id,active,nationality_id,prefer_hostel,diff_abled';
		
		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_bscam);
		$applicant_appln_id = $applicant_appln_det_res['id'];
		$_POST['applicant_appln_id'] = $applicant_appln_id;
		
		$check_applicant_pd_apid_cp = $this->check_exist_user($applicant_course_prefer_table, $table_schema,$applicant_course_det_columns,  array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id),1,'applicant_course_prefer_id');
		
		if($check_applicant_pd_apid_cp['data'][0]['applicant_appln_id']==$applicant_appln_id){
			$spec_pref_res['applicant_course'] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_course_prefer_table, $applicant_course_det_columns, 2);
		}else{
			$spec_pref_res['applicant_course'] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_course_prefer_table, $applicant_course_det_columns, 1, 'applicant_course_prefer_id');
		}
		
		$check_applicant_pd_apid_camp = $this->check_exist_user($applicant_campus_prefer_table, $table_schema,$applicant_campus_det_columns,  array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id),1,'applicant_course_prefer_id');
		
		if($check_applicant_pd_apid_camp['data'][0]['applicant_appln_id']==$applicant_appln_id){
			$spec_pref_res['applicant_campus'] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_campus_prefer_table, $applicant_campus_det_columns, 2);
		}else{
			$spec_pref_res['applicant_campus'] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_campus_prefer_table, $applicant_campus_det_columns, 1, 'applicant_campus_prefer_id');
		}

		$spec_pref_res['applicant_personal_det'] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id), $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns, 2);
		
		$spec_pref_res['applicant_other'] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_other_details_table, $applicant_other_details_columns, false, 'applicant_other_det_id');
		
		// Update Wizard ID
		$spec_pref_res['forn_w_wizard_id'] = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_bscam , FORM_WIZARD_PERSONAL_ID);
		
		$this->response ($spec_pref_res , API_Controller::HTTP_OK );
	}	
	
	
	public function bsc_parent_detail_post() {
    	$app_form_id = APP_FORM_ID_BSCAM;
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
        }elseif($add_guardian_details=='false'){
            $add_gardian = 'f';
        }

        // get applicant form pk id
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
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
        $father_occupation = ($user_data['father_occupation']!='' && $user_data['father_occupation']!='null')?$user_data['father_occupation'] : NULL;
        $father_mob_country_code_id = ($user_data['father_mob_country_code_id']!='' && $user_data['father_mob_country_code_id']!='null')?$user_data['father_mob_country_code_id'] : NULL;
        $father_alt_mob_country_code_id = ($user_data['father_alt_mob_country_code_id']!='' && $user_data['father_alt_mob_country_code_id']!='null')?$user_data['father_alt_mob_country_code_id'] : NULL;
        $father_title = $user_data['father_title'];
		$other_occupation_father = $user_data['other_occupation_father'];
        
        // Mother Detail
        $parent_type_mother_id = $user_data['parent_type_mother_id'];
        $parent_mother_name = $user_data['parent_mother_name'];
        $mother_mobile_no = $user_data['mother_mobile_no'];
        $mother_alt_mobile_no = $user_data['mother_alt_mobile_no'];
        $mother_email_id = $user_data['mother_email_id'];
        $mother_occupation = ($user_data['mother_occupation']!='' && $user_data['mother_occupation']!='null')?$user_data['mother_occupation'] : NULL;
        $mother_mob_country_code_id = ($user_data['mother_mob_country_code_id']!='' && $user_data['mother_mob_country_code_id']!='null')?$user_data['mother_mob_country_code_id'] : NULL;
        $mother_alt_mob_country_code_id = ($user_data['mother_alt_mob_country_code_id']!='' && $user_data['mother_alt_mob_country_code_id']!='null')?$user_data['mother_alt_mob_country_code_id'] : NULL;
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
		$other_occupation[] = $other_occupation_father;
        
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
		$other_occupation[] = $other_occupation_mother;
		
		$parent_type_guardian_id = $user_data['parent_type_guardian_id'];
        // Guardian Detail
        if($add_gardian=='t'){
            $parent_type_guardian_id = $user_data['parent_type_guardian_id'];
            $parent_guardian_name = $user_data['parent_guardian_name'];
            $guardian_mobile_no = $user_data['guardian_mobile_no'];
            $guardian_alt_mobile_no = $user_data['guardian_alt_mobile_no'];
            $guardian_email_id = $user_data['guardian_email_id'];
            $guardian_occupation = ($user_data['guardian_occupation']!='' && $user_data['guardian_occupation']!='null')?$user_data['guardian_occupation'] : NULL;
            $guardian_mob_country_code_id = ($user_data['guardian_mob_country_code_id']!='' && $user_data['guardian_mob_country_code_id']!='null')?$user_data['guardian_mob_country_code_id'] : NULL;			
            $guardian_alt_mob_country_code_id = $user_data['guardian_alt_mob_country_code_id'];
			$other_occupation_guardian = $user_data['other_occupation_guardian'];
			$other_occupation[] = $other_occupation_guardian;
            
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
				$n_other_occupation = $other_occupation[$k];
                
                $_SERVER["REQUEST_METHOD"] = "POST";
                $_POST = array();
                
                $applicant_parent_det_columns = 'applicant_personal_det_id,applicant_appln_id,parent_type_id,parent_name,mobile_no,email_id,occupation_id,active,mob_country_code_id,title_id,alt_mob_countrycode_id,alt_mobile_no,other_occupation_name';
                if($n_applicant_parent_det_id) {
                    $_POST['applicant_parent_det_id'] = $n_applicant_parent_det_id;
                    $applicant_parent_det_columns .= ',applicant_parent_det_id';
                }
                
                $_POST['parent_type_id'] = $n_parent_type_id;
				$_POST['active'] = TRUE;
                $_POST['parent_name'] = $n_parent_name;
                $_POST['mobile_no'] = $n_mobile_no;
                $_POST['email_id'] = $n_email_id;
                $_POST['occupation_id'] = $n_occupation;
                $_POST['mob_country_code_id'] = $n_mob_country_code_id;
                $_POST['alt_mob_countrycode_id'] = $n_alt_mob_country_code_id;
                $_POST['alt_mobile_no'] = $n_alt_mobile_no;
                $_POST['title_id'] = $n_title;
                $_POST['applicant_appln_id'] = $applicant_appln_id;
				$_POST['other_occupation_name'] = $n_other_occupation;
                
                if($n_applicant_parent_det_id) {
                    $parent_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_parent_det_table, $applicant_parent_det_columns, 1, 'applicant_parent_det_id', $n_applicant_parent_det_id);
                } else {
                    $chk_flag = false;
                    if(!$n_parent_name && !$n_mobile_no && !$n_email_id && !$n_occupation && !$n_mob_country_code_id && !$n_title) {
                        $chk_flag = true;
                    }
                    if(!$chk_flag) {
                        $parent_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_parent_det_table, $applicant_parent_det_columns, 1, 'applicant_parent_det_id');
                    }
                }
            }
        }
        
        $this->_get_error_status($parent_res);
		
		if($add_guardian_details!="true"){
			$whereparentgno = array();
			$whereparentgno['applicant_personal_det_id'] = $applicant_personal_det_id;
			$whereparentgno['parent_type_id'] = $parent_type_guardian_id;
			$whereparentgno['applicant_appln_id'] = $applicant_appln_id;
			$whereparentgno['table_schema'] = SCHEMA_ADMISSION;
			$this->common->common_delete_new ( $applicant_parent_det_table , $whereparentgno );
			$parent_res['guardian_data_deleted'] = 'true';
		}			
        
        if($other_res) {
            if($other_res['status'] == 'error') {
                $this->response ($other_res , API_Controller::HTTP_OK);
            } else {
                $applicant_personal_det_res['other_res'] = $other_res;
            }
        }
		
		// Wizard ID Update
		$parent_res['wizard_id_update'] = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_BSCAM , FORM_WIZARD_PARENT_ID);
        
		if($parent_res['wizard_id_update']==null){
			$parent_res['wizard_id_update'] = array("status"=>"Recorded Updated Successfully","type"=>"wizard_id_update");	
		}		
        $this->response ($parent_res , API_Controller::HTTP_OK);
    }

	public function bsc_academic_detail_post() {
    	$app_form_id_bscam = APP_FORM_ID_BSCAM;
    	$applicant_schooling_det_table = APPLICANT_SCHOOLING_TABLE;
    	$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$digilocker_id = $this->post('digilocker_id',true);
		$user_data = $this->post();
		
		$created_by = $this->post('created_by');
		$updated_by = $this->post('updated_by');
		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_bscam);
		$applicant_appln_id = $applicant_appln_det_res['id'];

		$function_name = $this->get_function_name(__FUNCTION__);
		
		// Current Education Qualification Status & Name
		
		$curr_edu_quali_status = $user_data['curr_edu_quali_status'];
		$name_as_in_marksheet = $user_data['name_as_in_marksheet'];
		
		// Tenth Detail
		$tenth_scholling_det_id = SCHOOLING_ID_TENTH;
		$tenth_institute_name = $user_data['tenth_institute_name'];
		$tenth_board_id = $user_data['tenth_board_id'];
		$tenth_msc_id = $user_data['tenth_msc_id'];
		$tenth_cgpa = $user_data['tenth_cgpa'];
		$tenth_yop = $user_data['tenth_yop'];
		$tenth_rollno = $user_data['tenth_rollno'];
		$academic_board_other = $user_data['academic_board_other'];
		
		// Twelfth Detail
		$twelfth_scholling_det_id = SCHOOLING_ID_TWELFTH;
		$twelfth_institute_name = $user_data['twelfth_institute_name'];
		$twelfth_board_id = $user_data['twelfth_board_id'];
		$academic_twelfth_board_other = $user_data['academic_twelfth_board_other'];
		
		if($curr_edu_quali_status=='a'){
			$curr_edu_quali_status = false;
			$is_current_qualify = false;
			$twelfth_msc_id = null;
			$twelfth_cgpa = null;
			$twelfth_yop = null;
			$twelfth_rollno = null;			
		}else{
			$curr_edu_quali_status = true;
			$is_current_qualify = true;
			$twelfth_msc_id = $user_data['twelfth_msc_id'];
			$twelfth_cgpa = $user_data['twelfth_cgpa'];
			$twelfth_yop = $user_data['twelfth_yop'];
			$twelfth_rollno = $user_data['twelfth_rollno'];
		}
		
		$columns = 'applicant_personal_det_id,institute_name,board_id,marking_scheme_id,mark_percentage,completion_year,registration_no,schooling_id,active,created_by,result_declared,name_as_in_marksheet,applicant_appln_id,other_board_name,is_curr_qualify';

		if($tenth_scholling_det_id){
			$check_applicant_id_sd = $this->check_exist_user($applicant_schooling_det_table, $table_schema,$columns,  array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'schooling_id'=>$tenth_scholling_det_id),1,'applicant_scl_det_id');
			
			if($check_applicant_id_sd['data'][0]['applicant_appln_id']==$applicant_appln_id){
				$whereschooling['applicant_personal_det_id'] = $applicant_personal_det_id;
				$whereschooling['schooling_id'] = $tenth_scholling_det_id;
				$whereschooling['applicant_appln_id'] = $applicant_appln_id;	
				$put_arrayschool['result_declared'] = true;
				$put_arrayschool['name_as_in_marksheet'] = $name_as_in_marksheet;
				$put_arrayschool['institute_name']= $tenth_institute_name;
				$put_arrayschool['board_id'] = $tenth_board_id;
				$put_arrayschool['marking_scheme_id'] = $tenth_msc_id;
				$put_arrayschool['mark_percentage'] = $tenth_cgpa;
				$put_arrayschool['completion_year'] = $tenth_yop;
				$put_arrayschool['registration_no'] = $tenth_rollno;
				$put_arrayschool['schooling_id'] = $tenth_scholling_det_id;
				$put_arrayschool['other_board_name'] = $academic_board_other;
				$put_arrayschool['is_curr_qualify'] = false;
				$put_arrayschool['active']= true;
				$put_arrayschool['updated_by']= $updated_by;
				$this->common->common_update ($table_schema.'.'.$applicant_schooling_det_table ,'' , $put_arrayschool, $whereschooling);
				$parent_res['tenth'] = array("status"=>"Record updated successfully","type"=>"schooling detail tenth");
			}else{
				$_POST['applicant_personal_det_id']= $applicant_personal_det_id;
				$_POST['applicant_appln_id']= $applicant_appln_id;
				$_POST['result_declared'] = true;
				$_POST['name_as_in_marksheet'] = $name_as_in_marksheet;
				$_POST['institute_name']= $tenth_institute_name;
				$_POST['board_id'] = $tenth_board_id;
				$_POST['marking_scheme_id'] = $tenth_msc_id;
				$_POST['mark_percentage'] = $tenth_cgpa;
				$_POST['completion_year'] = $tenth_yop;
				$_POST['registration_no'] = $tenth_rollno;
				$_POST['schooling_id'] = $tenth_scholling_det_id;
				$_POST['active']= true;
				$_POST['created_by']= $created_by;
				$_POST['other_board_name'] = $academic_board_other;
				$_POST['is_curr_qualify'] = false;
				$table_prefix='';
				$function_name = $this->get_function_name ( __FUNCTION__ );      
				$this->_common_insert ( $applicant_schooling_det_table , $table_prefix , $function_name , $columns , $table_schema);
				
				$parent_res['tenth'] = array("status"=>"Record added successfully","type"=>"schooling detail tenth");
			}
		}

		if($twelfth_scholling_det_id){
			$check_applicant_id_sd = $this->check_exist_user($applicant_schooling_det_table, $table_schema,$columns,  array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'schooling_id'=>$twelfth_scholling_det_id),1,'applicant_scl_det_id');
			
			if($check_applicant_id_sd['data'][0]['applicant_appln_id']==$applicant_appln_id){
				$whereschooling['applicant_personal_det_id'] = $applicant_personal_det_id;
				$whereschooling['schooling_id'] = $twelfth_scholling_det_id;
				$whereschooling['applicant_appln_id'] = $applicant_appln_id;	
				$put_arrayschool['result_declared'] = $curr_edu_quali_status;
				$put_arrayschool['name_as_in_marksheet'] = $name_as_in_marksheet;
				$put_arrayschool['institute_name']= $twelfth_institute_name;
				$put_arrayschool['board_id'] = $twelfth_board_id;
				$put_arrayschool['marking_scheme_id'] = $twelfth_msc_id;
				$put_arrayschool['mark_percentage'] = $twelfth_cgpa;
				$put_arrayschool['completion_year'] = $twelfth_yop;
				$put_arrayschool['registration_no'] = $twelfth_rollno;
				$put_arrayschool['schooling_id'] = $twelfth_scholling_det_id;
				$put_arrayschool['active']= true;
				$put_arrayschool['updated_by']= $updated_by;
				$put_arrayschool['is_curr_qualify'] = $is_current_qualify;
				$put_arrayschool['other_board_name'] = $academic_twelfth_board_other;
				$this->common->common_update ($table_schema.'.'.$applicant_schooling_det_table ,'' , $put_arrayschool, $whereschooling);
				$parent_res['twelfth'] = array("status"=>"Record updated successfully","type"=>"schooling detail twelfth");
			}else{
				$_POST['applicant_personal_det_id']= $applicant_personal_det_id;
				$_POST['applicant_appln_id']= $applicant_appln_id;
				$_POST['result_declared'] = $curr_edu_quali_status;
				$_POST['name_as_in_marksheet'] = $name_as_in_marksheet;
				$_POST['institute_name']= $twelfth_institute_name;
				$_POST['board_id'] = $twelfth_board_id;
				$_POST['marking_scheme_id'] = $twelfth_msc_id;
				$_POST['mark_percentage'] = $twelfth_cgpa;
				$_POST['completion_year'] = $twelfth_yop;
				$_POST['registration_no'] = $twelfth_rollno;
				$_POST['schooling_id'] = $twelfth_scholling_det_id;
				$_POST['active']= true;
				$_POST['created_by']= $created_by;
				$_POST['is_curr_qualify'] = $is_current_qualify;
				$_POST['other_board_name'] = $academic_twelfth_board_other;
				$table_prefix='';
				$function_name = $this->get_function_name ( __FUNCTION__ );      
				$this->_common_insert ( $applicant_schooling_det_table , $table_prefix , $function_name , $columns , $table_schema);
				$parent_res['twelfth'] = array("status"=>"Record added successfully","type"=>"schooling detail twelfth");
			}
		}
		
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE;
		$_POST['digilocker_id'] = $digilocker_id;		
		
		$applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
		$applicant_personal_det_columns = 'digilocker_id,active';
		$parent_res['applicant_personal_det'] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id), $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns, 2);
		// Wizard ID Update
		$parent_res['wizard_id_update'] = $this->common_wizardupdate($applicant_personal_det_id , APP_FORM_ID_BSCAM , FORM_WIZARD_ACADEMIC_ID);
		
		if($parent_res['wizard_id_update']==null){
			$parent_res[] = array("status"=>"Recorded Updated Successfully","type"=>"wizard_id_update");	
		}

		$this->response ($parent_res , API_Controller::HTTP_OK);
    }

	public function declaration_bscam_post(){
		$table_schema = SCHEMA_ADMISSION;
		$table = $table_schema.'.'.APPLICANT_APPLN;
		$user_data = $this->post();
		$updated_by = $user_data['updated_by'];
		$applicant_name = $user_data['applicant_name'];
		$parent_name = $user_data['parent_name'];
		$declared_date = $user_data['ddate'];
		$applicant_id = $user_data['applicant_id'];
		$applicant_appln_det_id = $user_data['applicant_appln_det_id'];
		$application_status_id = APPLICATION_IN_COMPLETED;
		
		if($user_data['currentIndex']==5){
			$wheredec['applicant_personal_det_id'] = $applicant_id;
			$wheredec['applicant_appln_id'] = $applicant_appln_det_id;		
			$put_arraydec['applicant_name_declaration']= $applicant_name;
			$put_arraydec['applicant_parentname_declaration'] = $parent_name;
			$put_arraydec['applicant_declaration_date'] = $declared_date;
			$put_arraydec['application_status_id'] = $application_status_id;
			$put_arraydec['active']= true;
			$put_arraydec['updated_by']= $updated_by;
			$this->common->common_update ( $table ,'' , $put_arraydec, $wheredec);
			$user_data['wizard_id_update'] = $this->common_wizardupdate($applicant_id , APP_FORM_ID_BSCAM ,FORM_WIZARD_UPLOAD_DECLARATION_ID);
		}		
		$this->output->set_output(json_encode(['status' => $user_data])); 
	}	
	
	
	public function db_func_call_bsc_get() {
		//$get_prog_id = $this->input->get('prog_id');
		$is_course =  $this->get('is_course',true);
		$form_id = APP_FORM_ID_BSCAM;
		$fn_get_app_course_detail = FN_GET_CHOICE_DROPDOWN;
		$table_schema = SCHEMA_ADMISSION;
		//$id = array(0=>$get_prog_id,1=>null,2=>null,3=>null,4=>null,5=>$form_id);
		//if($get_prog_id==null){
			$column['id'] = 'prog_id';
			$column['name'] = 'prog_name';
		//}
		$get_prog_id=!empty($get_prog_id) ? $get_prog_id : 'null';
		$array1=!empty($array1) ? $array1 : 'null';
		$array2=!empty($array2) ? $array2 : 'null';
		$array3=!empty($array3) ? $array3 : 'null';
		//$array4=!empty($array4) ? $array4 : 'null';
		$form_id=!empty($form_id) ? $form_id : 'null';
		
		$arguments=array($get_prog_id,$array1,$array2,$array3,$form_id);		
		$result = $this->db_distinct_func_call($table_schema, $fn_get_app_course_detail, $arguments,$column);
	}
	
	public function db_func_call_bsc_campus_get() {
		$get_prog_id = $this->input->get('prog_id');
		$is_course =  $this->get('is_course',true);
		$form_id = APP_FORM_ID_BSCAM;
		$fn_get_app_course_detail = FN_GET_CHOICE_DROPDOWN;
		$table_schema = SCHEMA_ADMISSION;
		//$id = array(0=>$get_prog_id,1=>null,2=>null,3=>null,4=>null,5=>$form_id);
		$column['id'] = 'campus_id';
		$column['name'] = 'campus_name';
		$get_prog_id=!empty($get_prog_id) ? $get_prog_id : 'null';
		$array1=!empty($array1) ? $array1 : 'null';
		$array2=!empty($array2) ? $array2 : 'null';
		$array3=!empty($array3) ? $array3 : 'null';
		//$array4=!empty($array4) ? $array4 : 'null';
		$form_id=!empty($form_id) ? $form_id : 'null';
		
		$arguments=array($get_prog_id,$array1,$array2,$array3,$form_id);		
		$result = $this->db_distinct_func_call($table_schema, $fn_get_app_course_detail, $arguments,$column);
	}	
		
}