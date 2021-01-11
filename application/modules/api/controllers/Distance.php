<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package SRM - Online Application
 * @category APPlications API
 * @subpackage Distance
 *
 * @SWG\Resource(
 *  apiVersion="0.1",
 *  swaggerVersion="1.2",
 *  resourcePath="/api",
 *  produces="['application/json']"
 * )
 *
 */
class Distance extends API_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
	
	protected function _get_applicant_personal_detail_id($function_name,$tabledy ,$pk_id,$id, $return = false, $cond = array()) {
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
        //$table = 'applicant_graduation_det';

		$table  = $tabledy;
        // $stable = TABLE_LOOKUP_VALUE;
        // Set Columns
        $columns = "applicant_personal_det_id as applicant_personal_det_id,applicant_appln_id";

        // Parameter By Array
        $params = array();
        $params['table'] = $table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        // if(isset($id) && $id != '')
        // {
        //     $params['id'] = $id;
        // }
        $params['pk'] = $pk_id;
        $params['id_col'] = $pk_id;
        $cond = ($cond)?$cond:array();
        // $cond['active'] = 't';        
        $cond['applicant_personal_det_id'] = $id;        
        $params['cond'] = $cond;
		$params['returnresponse'] = $return;
	
        // Call Select Method
        return $result_user = $this->_select_table($params);
		
    }

	protected function _get_applicant_personal_detail_id_o($function_name,$tabledy ,$pk_id,$id, $return = false, $cond = array(),$check_column=false) {
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
        //$table = 'applicant_graduation_det';

		$table  = $tabledy;
        // $stable = TABLE_LOOKUP_VALUE;
        // Set Columns
		

		$columns = "applicant_personal_det_id as applicant_personal_det_id";
        // Parameter By Array
        $params = array();
        $params['table'] = $table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        // if(isset($id) && $id != '')
        // {
        //     $params['id'] = $id;
        // }
        $params['pk'] = $pk_id;
        $params['id_col'] = $pk_id;
        $cond = ($cond)?$cond:array();
        // $cond['active'] = 't';        
        $cond['applicant_personal_det_id'] = $id;        
        $params['cond'] = $cond;
		$params['returnresponse'] = $return;
	
        // Call Select Method
        return $result_user = $this->_select_table($params);
		
    }		
	
	public function wizard_api_dist_edu_post(){
		$user_data = $this->post ();
		$app_status = $this->post('appln_status');
		$created_by = $this->post('created_by');
		$updated_by = $this->post('updated_by');
		if($app_status==APPLICATION_IN_PROGRESS || $app_status==''){
			$app_status=APPLICATION_IN_PROGRESS;
		}else{
			$app_status=APPLICATION_IN_COMPLETED;
		}

		$applicant_id = $user_data['applicant_id'];
		$applicant_appln_det_id = $user_data['applicant_appln_det_id'];
		// Course Preferences
		$prog_id = $user_data['prog_id'];
		$course_id = $user_data['course_id'];
		$campus_id = $user_data['campus_id'];		
		// PersonaL Details
		$gender_title = $user_data['gender_title_id'];
		$first_name = $user_data['first_name'];
		$middle_name = $user_data['middle_name'];
		$last_name = $user_data['last_name'];
		$phone_no_code = $user_data['phone_no_code'];
		$mobile_no = $user_data['mobile_no'];
		$email_id = $user_data['email_id'];
		$dob = $user_data['dob'];
		$gender = $user_data['gender'];
		$alt_email = $user_data['alt_email'];
		$blood_group = $user_data['blood_group'];
		$social_status = $user_data['social_status'];
		$aadhar_no = $user_data['aadhar_no'];
		$diffrently_abled = $user_data['diffrently_abled'];
		$eco_weaker_val = $user_data['eco_weaker_val'];
		$nature_of_deformity = $user_data['nature_of_deformity'];
		$percent_of_deformity = $user_data['percent_of_deformity']; 
		$nationality = $user_data['nationality']; 
		$tablepd = TABLE_APPLICANT_PERSONAL_DET;
		$schema = SCHEMA_ADMISSION;
		$this->set_schema($schema);
		// Server Side Validation
		$this->form_validation->set_data($user_data);
		$this->form_validation->set_rules('applicant_id', 'Personal det id','trim|required');
		if($user_data['currentIndex']==0){
			$this->form_validation->set_rules('current_resident_tn', 'Current Resident TN','trim|required');			
		}elseif($user_data['currentIndex']==1){
			$this->form_validation->set_rules('prog_id', 'Program Level','trim|required');
			$this->form_validation->set_rules('course_id', 'Course','trim|required');
			//$this->form_validation->set_rules('campus_id', 'Campus','trim|required');
			$this->form_validation->set_rules('gender_title_id', 'Gender Title','trim|required');
			$this->form_validation->set_rules('first_name', 'First Name','trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name','trim|required');
			$this->form_validation->set_rules('mobile_no', 'Mobile No','trim|required|xss_clean'); 
			$this->form_validation->set_rules('email_id', 'Email ID','trim|required|valid_email');
			$this->form_validation->set_rules('alt_email', 'Alternate Email','trim|valid_email');
			$this->form_validation->set_rules('dob', 'DOB','trim|required');
			$this->form_validation->set_rules('gender', 'Gender','trim|required');
			$this->form_validation->set_rules('blood_group', 'Blood Group','trim|required');
			$this->form_validation->set_rules('nationality', 'Nationality','trim|required');
			if($nationality==COUNTRY_VALUE_DEFAULT){
				$this->form_validation->set_rules('aadhar_no', 'Aadhaar No','trim|required|max_length[12]');
			}
			if($diffrently_abled=="yes"){
				$this->form_validation->set_rules('percent_of_deformity', 'Percentage Of Deformity','trim|required');
				$this->form_validation->set_rules('nature_of_deformity', 'Nature Of Deformity','trim|required');				
			}
			if($nationality==COUNTRY_VALUE_DEFAULT){
				$this->form_validation->set_rules('social_status', 'Social Status','trim|required');
			}
		}		

		
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}		
		
		if($user_data['currentIndex']==0){
			$are_you_in_tn = $user_data['current_resident_tn'];
			($are_you_in_tn=='yes')?true:false;
			/*
				if($are_you_in_tn=="yes"){
					$are_you_in_tn = true;
				}	 
			*/
			if($are_you_in_tn){
				$table_appln = APPLICANT_APPLN;
				$whereaad['applicant_personal_det_id'] = $applicant_id;
				$whereaad['applicant_appln_id'] = $applicant_appln_det_id;
				$put_arrayaad['table_schema'] = SCHEMA_ADMISSION;
				$put_arrayaad['updated_by'] = $updated_by;
				$put_arrayaad['application_status_id'] = $app_status;
				$update = $this->common->common_update ( $table_appln ,'' , $put_arrayaad, $whereaad);
			}
			$tablepd = TABLE_APPLICANT_PERSONAL_DET;
			// exit;
			$table_prefixu='';
			// $where = array();
			$wherepd['applicant_personal_det_id'] = $applicant_id;
			$put_arraypd['table_schema'] = SCHEMA_ADMISSION;
			$put_arraypd['resid_tamilnadu'] = $are_you_in_tn;
			$put_arraypd['updated_by'] = $updated_by;
			$update = $this->common->common_update ( $tablepd ,'' , $put_arraypd, $wherepd);$wizard_update = $this->common_wizardupdate($applicant_id , APP_FORM_ID_DE , FORM_WIZARD_BASIC_ID);			
			$this->response (['status' => 'true' ,'message' => RECORD_UPDATE_SUCCESSFULLY,] , API_Controller::HTTP_OK);
		}
		
		if($user_data['currentIndex']==1){
			// Course Preferences Table Insert & Update Start
			$table_schema = SCHEMA_ADMISSION;
			$table_appln = APPLICANT_APPLN;
			
			$pk_id = 'applicant_appln_id';
			$cond = array('applicant_appln_id'=>$applicant_appln_det_id);
			$check_applicant_pid_in_appln = $this->_get_applicant_personal_detail_id($function_name,$table_appln,$pk_id,$applicant_id,true,$cond);
			
			// check applicant id exist in applicant_appln table
			if($check_applicant_pid_in_appln['data'][0]['applicant_appln_id']==$applicant_appln_det_id){
				$wheres['applicant_personal_det_id'] = $applicant_id;
				$wheres['applicant_appln_id'] = $applicant_appln_det_id;
				$put_arrays['table_schema'] = SCHEMA_ADMISSION;
				$put_arrays['appln_form_id'] = APP_FORM_ID_DE;
				$put_arrays['grad_id'] = $prog_id;
				$put_arrays['updated_by']= $updated_by;
				$this->common->common_update ( $table_appln ,'' , $put_arrays, $wheres); 
			}else{
				$_POST['applicant_personal_det_id']= $applicant_id;
				$_POST['appln_form_id']= APP_FORM_ID_DE;
				$_POST['grad_id']= $prog_id;	
				$_POST['active']= true;
				$_POST['created_by']= $created_by;
				$columns = 'applicant_personal_det_id,appln_form_id,grad_id,active,created_by';
				$table_prefix='';
				$function_name = $this->get_function_name ( __FUNCTION__ );      
				$this->_common_insert ( $table_appln , $table_prefix , $function_name , $columns , $table_schema);					
			}
			
			$table_appln_course_prefer = APPLICANT_COURSE_PREFER;
			$pkcf_id = 'applicant_course_prefer_id';
			$cond = array('applicant_appln_id'=>$applicant_appln_det_id);
			$check_applicant_pid_in_appln_cf = $this->_get_applicant_personal_detail_id($function_name,$table_appln_course_prefer,$pkcf_id,$applicant_id,true,$cond);
			
			if($check_applicant_pid_in_appln_cf['data'][0]['applicant_appln_id']==$applicant_appln_det_id){
				$wherecf['applicant_personal_det_id'] = $applicant_id;
				$wherecf['applicant_appln_id'] = $applicant_appln_det_id;
				$put_arraycf['table_schema'] = SCHEMA_ADMISSION;
				$put_arraycf['course_id'] = $course_id;
				$put_arraycf['choice_no']= 1;
				$put_arraycf['updated_by']= $updated_by;
				$this->common->common_update ( $table_appln_course_prefer ,'' , $put_arraycf, $wherecf);
			}else{
				$_POST['applicant_personal_det_id']= $applicant_id;
				$_POST['applicant_appln_id']= $applicant_appln_det_id;
				$_POST['course_id']= $course_id;
				$_POST['choice_no']= 1;	
				$_POST['active']= true;
				$_POST['created_by']= $created_by;
				$columns = 'applicant_personal_det_id,course_id,choice_no,active,created_by,applicant_appln_id';
				$table_prefix='';
				$function_name = $this->get_function_name ( __FUNCTION__ );      
				$this->_common_insert ( $table_appln_course_prefer , $table_prefix , $function_name , $columns , $table_schema);
			}
			
			if($campus_id!=DEFAULT_VALUE_CHECK){
				$table_appln_campus_prefer = APPLICANT_CAMPUS_PREFER;
				$pkcamp_id = 'applicant_campus_prefer_id';
				$cond = array('applicant_appln_id'=>$applicant_appln_det_id);
				$check_applicant_pid_in_appln_camp = $this->_get_applicant_personal_detail_id($function_name,$table_appln_campus_prefer,$pkcamp_id,$applicant_id,true,$cond);
				if($check_applicant_pid_in_appln_camp['data'][0]['applicant_appln_id']==$applicant_appln_det_id){
					$wherecampus['applicant_personal_det_id'] = $applicant_id;
					$wherecampus['applicant_appln_id'] = $applicant_appln_det_id;
					$put_arraycamp['table_schema'] = SCHEMA_ADMISSION;
					$put_arraycamp['campus_id'] = ($campus_id!='' && $campus_id!='null')?$campus_id : NULL;
					$put_arraycamp['choice_no']= 1;
					$put_arraycamp['updated_by']= $updated_by;
					$this->common->common_update ( $table_appln_campus_prefer ,'' , $put_arraycamp, $wherecampus);
				}else{
					$_POST['applicant_personal_det_id']= $applicant_id;
					$_POST['applicant_appln_id']= $applicant_appln_det_id;
					$_POST['campus_id']= ($campus_id!='' && $campus_id!='null')?$campus_id : NULL;
					$_POST['choice_no']= 1;	
					$_POST['active']= true;
					$_POST['created_by']= $created_by;
					$columns = 'applicant_personal_det_id,campus_id,choice_no,active,created_by,applicant_appln_id';
					$table_prefix='';
					$function_name = $this->get_function_name ( __FUNCTION__ );      
					$this->_common_insert ( $table_appln_campus_prefer , $table_prefix , $function_name , $columns , $table_schema);
				}
			}
			
			$tablepd = TABLE_APPLICANT_PERSONAL_DET;
			// exit;
			$table_prefixu='';
			// $where = array();
			$wherepd['applicant_personal_det_id'] = $applicant_id;
			$put_arraypd['table_schema'] = SCHEMA_ADMISSION;
			$put_arraypd['title_id'] = $gender_title;
			$put_arraypd['first_name'] = $first_name;
			
			$put_arraypd['middle_name'] = $middle_name;
			$put_arraypd['last_name'] = $last_name;
			$put_arraypd['applicant_mob_country_code_id'] = $phone_no_code;
			$put_arraypd['mobile_no'] = $mobile_no;
			$put_arraypd['email_id'] = $email_id;
			$put_arraypd['dob'] = $dob;
			$put_arraypd['gender_id'] = $gender;
			$put_arraypd['second_email_id'] = $alt_email;
			$put_arraypd['blood_grp_id'] = $blood_group;
			$put_arraypd['social_status_id'] = $social_status;
			$put_arraypd['aadhar_no'] = $aadhar_no;
			$put_arraypd['diff_abled'] = $diffrently_abled;
			$put_arraypd['econo_weaker_sec'] = ($eco_weaker_val!='' && $eco_weaker_val!='null')?$eco_weaker_val : NULL;
			$put_arraypd['deformity_type_id'] = $nature_of_deformity;
			$put_arraypd['deformity_percent'] = $percent_of_deformity; 
			$put_arraypd['nationality_id'] = $nationality;
			// $this->output->set_output(json_encode(['status' => $where]));
			$update = $this->common->common_update ( $tablepd ,'' , $put_arraypd, $wherepd);
			// Update Wizard ID
			$wizard_update = $this->common_wizardupdate($applicant_id , APP_FORM_ID_DE , FORM_WIZARD_PERSONAL_ID);			
			$this->response (['status' => 'true' ,'message' => RECORD_UPDATE_SUCCESSFULLY,] , API_Controller::HTTP_OK);
		}	
	}
	
	public function wizard_api_parent_post(){
		$user_data = $this->post();
		$created_by = $this->post('created_by');
		$updated_by = $this->post('updated_by');
		$applicant_id = $user_data['applicant_id'];
		$applicant_appln_id = $user_data['applicant_appln_det_id'];
		// Father Detail
		$parent_type_father_id = $user_data['parent_type_father_id'];
		$parent_father_name = $user_data['parent_father_name'];
		
		$father_mobile_no = ($user_data['father_mobile_no']=='')?0:$user_data['father_mobile_no'];
		$father_email_id = $user_data['father_email_id'];
		$father_occupation = ($user_data['father_occupation']!='' && $user_data['father_occupation']!='null')?$user_data['father_occupation'] : NULL;
		$father_mob_country_code_id = ($user_data['father_mob_country_code_id']!='' && $user_data['father_mob_country_code_id']!='null')?$user_data['father_mob_country_code_id'] : NULL;
		$father_title = $user_data['father_title'];
		$other_occupation_father = $user_data['other_occupation_father'];
		
		// Mother Detail
		$parent_type_mother_id = $user_data['parent_type_mother_id'];
		$parent_mother_name = $user_data['parent_mother_name'];
		$mother_mobile_no = ($user_data['mother_mobile_no']=='')?0:$user_data['mother_mobile_no'];;
		$mother_email_id = $user_data['mother_email_id'];
		$mother_occupation = ($user_data['mother_occupation']!='' && $user_data['mother_occupation']!='null')?$user_data['mother_occupation'] : NULL;		
		$mother_mob_country_code_id = ($user_data['mother_mob_country_code_id']!='' && $user_data['mother_mob_country_code_id']!='null')?$user_data['mother_mob_country_code_id'] : NULL;
		$mother_title = $user_data['mother_title'];	
		$other_occupation_mother = $user_data['other_occupation_mother'];
		
		// Guardian Detail
		$add_guardian_details = $user_data['add_guardian_details'];
			
		if($add_guardian_details=="true"){
			$add_guardian_details_check = 'yes';
			$add_gardian = 't';
		}else{
			$add_guardian_details_check = 'no';
			$add_gardian = 'f';
		}
	
		
		$applicant_other_details_columns = 'applicant_personal_det_id,applicant_appln_id,add_gardian,active,created_by';
		
		$parent_type_guardian_id = $user_data['parent_type_guardian_id'];
		$parent_guardian_name = $user_data['parent_guardian_name'];
		$guardian_mobile_no = ($user_data['guardian_mobile_no']=='')?0:$user_data['guardian_mobile_no'];
		$guardian_email_id = $user_data['guardian_email_id'];
		$guardian_occupation = ($user_data['guardian_occupation']!='' && $user_data['guardian_occupation']!='null')?$user_data['guardian_occupation'] : NULL;
		$guardian_mob_country_code_id = ($user_data['guardian_mob_country_code_id']!='' && $user_data['guardian_mob_country_code_id']!='null')?$user_data['guardian_mob_country_code_id'] : NULL;		
		$other_occupation_guardian = $user_data['other_occupation_guardian'];
		
		$function_name = $this->get_function_name ( __FUNCTION__ );
		$table_schema = SCHEMA_ADMISSION;
		// Server Side Validation
		$this->form_validation->set_data($user_data);
		$this->form_validation->set_rules('applicant_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('father_title', 'Father Title','trim|required');
		$this->form_validation->set_rules('parent_father_name', 'Father Name','trim|required');
		$this->form_validation->set_rules('mother_title', 'Mother Title','trim|required');
		$this->form_validation->set_rules('parent_mother_name', 'Mother Name','trim|required');
		$this->form_validation->set_rules('father_mobile_no', 'Father Mobile No','max_length[10]'); 
		$this->form_validation->set_rules('father_email_id', 'Father Email ID','trim|valid_email');
		$this->form_validation->set_rules('mother_mobile_no', 'Mother Mobile No','max_length[10]'); 
		$this->form_validation->set_rules('mother_email_id', 'Mother Email ID','trim|valid_email');
		$this->form_validation->set_rules('guardian_mobile_no', 'Guardian Mobile No','max_length[10]'); 
		$this->form_validation->set_rules('guardian_email_id', 'Guardian Email ID','trim|valid_email');		
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}			
		$applicant_other_details_table = $table_schema.'.'.APPLICANT_OTHER_DETAILS_TABLE;
		$table_parent_details = $table_schema.'.applicant_parent_det';	
		
		$pkother_id = 'applicant_other_det_id';
		$cond = array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_id);
		$check_applicant_pid_in_other = $this->_get_applicant_personal_detail_id($function_name,$applicant_other_details_table,$pkother_id,$applicant_id,true,$cond);	
		
		if($check_applicant_pid_in_other['data'][0]['applicant_appln_id']==$applicant_appln_id){
			$whereother['applicant_personal_det_id'] = $applicant_id;
			$whereother['applicant_appln_id'] = $applicant_appln_id;
			$put_arrayother['active'] = TRUE;
			$put_arrayother['add_gardian'] = ($add_guardian_details=='true')?true:$add_guardian_details;
			$put_arrayother['applicant_appln_id'] = $applicant_appln_id;
			$put_arrayother['updated_by'] = $updated_by;
			$this->common->common_update ( $applicant_other_details_table ,'' , $put_arrayother, $whereother);
		}else{
			$_POST['active'] = TRUE;
			$_POST['add_gardian'] = ($add_guardian_details=='true')?true:$add_guardian_details;
			$_POST['applicant_appln_id'] = $applicant_appln_id;
			$_POST['applicant_personal_det_id'] = $applicant_id;	
			$_POST['created_by'] = $created_by;
			$table_prefix='';
			$function_name = $this->get_function_name ( __FUNCTION__ );      
			$this->_common_insert ( $applicant_other_details_table , $table_prefix , $function_name , $applicant_other_details_columns , $table_schema);				
		}

		
		if($parent_type_father_id==PARENT_TYPE_ID_FATHER){
			$pkpar_id = 'applicant_parent_det_id';
			$cond = array('parent_type_id'=>$parent_type_father_id,'applicant_appln_id'=>$applicant_appln_id);
			$check_applicant_pid_in_parent = $this->_get_applicant_personal_detail_id($function_name,$table_parent_details,$pkpar_id,$applicant_id,true,$cond);			
			if($check_applicant_pid_in_parent['data'][0]['applicant_appln_id']==$applicant_appln_id){
				$whereparent['applicant_personal_det_id'] = $applicant_id;
				$whereparent['parent_type_id'] = $parent_type_father_id;
				$whereparent['applicant_appln_id'] = $applicant_appln_id;
				$put_arraypar['parent_name'] = $parent_father_name;
				$put_arraypar['mobile_no'] = $father_mobile_no;
				$put_arraypar['email_id'] = $father_email_id;
				$put_arraypar['occupation_id'] = $father_occupation;
				$put_arraypar['active']= true;
				$put_arraypar['updated_by']= $updated_by;
				$put_arraypar['mob_country_code_id'] = $father_mob_country_code_id;
				$put_arraypar['title_id'] = $father_title;
				$put_arraypar['other_occupation_name'] = $other_occupation_father;
				$this->common->common_update ( $table_parent_details ,'' , $put_arraypar, $whereparent);
			}else{
				$_POST['applicant_personal_det_id']= $applicant_id;
				$_POST['applicant_appln_id']= $applicant_appln_id;
				$_POST['parent_type_id']= $parent_type_father_id;
				$_POST['parent_name'] = $parent_father_name;
				$_POST['mobile_no'] = $father_mobile_no;
				$_POST['email_id'] = $father_email_id;
				$_POST['occupation_id'] = $father_occupation;
				$_POST['active']= true;
				$_POST['created_by']= $created_by;
				$_POST['mob_country_code_id'] = $father_mob_country_code_id;
				$_POST['title_id'] = $father_title;
				$_POST['other_occupation_name'] = $other_occupation_father;
				$columns = 'applicant_personal_det_id,parent_type_id,parent_name,mobile_no,email_id,occupation_id,active,created_by,mob_country_code_id,title_id,applicant_appln_id,other_occupation_name';
				$table_prefix='';
				$function_name = $this->get_function_name ( __FUNCTION__ );      
				$this->_common_insert ( $table_parent_details , $table_prefix , $function_name , $columns , $table_schema);				
			}
		}
		
		if($parent_type_mother_id==PARENT_TYPE_ID_MOTHER){
			$pkpar_id = 'applicant_parent_det_id';
			$cond = array('parent_type_id'=>$parent_type_mother_id,'applicant_appln_id'=>$applicant_appln_id);
			$check_applicant_pid_in_parent = $this->_get_applicant_personal_detail_id($function_name,$table_parent_details,$pkpar_id,$applicant_id,true,$cond);			
			if($check_applicant_pid_in_parent['data'][0]['applicant_appln_id']==$applicant_appln_id){
				$whereparentm['applicant_personal_det_id'] = $applicant_id;
				$whereparentm['parent_type_id'] = $parent_type_mother_id;
				$whereparentm['applicant_appln_id'] = $applicant_appln_id;
				$put_arrayparm['parent_name'] = $parent_mother_name;
				$put_arrayparm['mobile_no'] = $mother_mobile_no;
				$put_arrayparm['email_id'] = $mother_email_id;
				$put_arrayparm['occupation_id'] = $mother_occupation;
				$put_arrayparm['active']= true;
				$put_arrayparm['updated_by']= $updated_by;
				$put_arrayparm['mob_country_code_id'] = $mother_mob_country_code_id;
				$put_arrayparm['title_id'] = $mother_title;
				$put_arrayparm['other_occupation_name'] = $other_occupation_mother;
				$this->common->common_update ( $table_parent_details ,'' , $put_arrayparm, $whereparentm);
			}else{
				$_POST['applicant_personal_det_id']= $applicant_id;
				$_POST['applicant_appln_id']= $applicant_appln_id;
				$_POST['parent_type_id']= $parent_type_mother_id;
				$_POST['parent_name'] = $parent_mother_name;
				$_POST['mobile_no'] = $mother_mobile_no;
				$_POST['email_id'] = $mother_email_id;
				$_POST['occupation_id'] = $mother_occupation;
				$_POST['active']= true;
				$_POST['created_by']= $created_by;
				$_POST['mob_country_code_id'] = $mother_mob_country_code_id;
				$_POST['title_id'] = $mother_title;		
				$_POST['other_occupation_name'] = $other_occupation_mother;
				$columns = 'applicant_personal_det_id,parent_type_id,parent_name,mobile_no,email_id,occupation_id,active,created_by,mob_country_code_id,title_id,applicant_appln_id,other_occupation_name';
				$table_prefix='';
				$function_name = $this->get_function_name ( __FUNCTION__ );      
				$this->_common_insert ( $table_parent_details , $table_prefix , $function_name , $columns , $table_schema);				
			}
		}

		if($add_guardian_details_check=='yes'){
			$pkpar_id = 'applicant_parent_det_id';
			$cond = array('parent_type_id'=>$parent_type_guardian_id,'applicant_appln_id'=>$applicant_appln_id);
			$check_applicant_pid_in_parent = $this->_get_applicant_personal_detail_id($function_name,$table_parent_details,$pkpar_id,$applicant_id,true,$cond);			
			if($check_applicant_pid_in_parent['data'][0]['applicant_appln_id']==$applicant_appln_id){
				$whereparentg['applicant_personal_det_id'] = $applicant_id;
				$whereparentg['parent_type_id'] = $parent_type_guardian_id;
				$whereparentg['applicant_appln_id'] = $applicant_appln_id;
				$put_arrayparg['parent_name'] = $parent_guardian_name;
				$put_arrayparg['mobile_no'] = $guardian_mobile_no;
				$put_arrayparg['email_id'] = $guardian_email_id;
				$put_arrayparg['occupation_id'] = $guardian_occupation;
				$put_arrayparg['active']= true;
				$put_arrayparg['updated_by']= $updated_by;
				$put_arrayparg['mob_country_code_id'] = $guardian_mob_country_code_id;
				$put_arrayparg['add_guardian_details'] = $add_guardian_details_check;
				$put_arrayparg['applicant_appln_id'] = $applicant_appln_id;
				$put_arrayparg['other_occupation_name'] = $other_occupation_guardian;
				//$put_arrayparm['title'] = $mother_title;
				$this->common->common_update ( $table_parent_details ,'' , $put_arrayparg, $whereparentg);
			}else{
				$_POST['applicant_personal_det_id']= $applicant_id;
				$_POST['parent_type_id']= $parent_type_guardian_id;
				$_POST['parent_name'] = $parent_guardian_name;
				$_POST['mobile_no'] = $guardian_mobile_no;
				$_POST['email_id'] = $guardian_email_id;
				$_POST['occupation_id'] = $guardian_occupation;
				$_POST['active']= true;
				$_POST['created_by']= $created_by;
				$_POST['mob_country_code_id'] = $guardian_mob_country_code_id;
				$_POST['add_guardian_details'] = $add_guardian_details_check;
				$_POST['applicant_appln_id'] = $applicant_appln_id;	
				$_POST['other_occupation_name'] = $other_occupation_guardian;
				$columns = 'applicant_personal_det_id,parent_type_id,parent_name,mobile_no,email_id,occupation_id,active,created_by,mob_country_code_id,add_guardian_details,applicant_appln_id,other_occupation_name';
				$table_prefix='';
				$function_name = $this->get_function_name ( __FUNCTION__ );      
				$this->_common_insert ( $table_parent_details , $table_prefix , $function_name , $columns , $table_schema);				
			}
		}else{
			if($add_guardian_details_check!="yes"){
				$whereparentgno = array();
				$whereparentgno['applicant_personal_det_id'] = $applicant_id;
				$whereparentgno['parent_type_id'] = $parent_type_guardian_id;
				$whereparentgno['applicant_appln_id'] = $applicant_appln_id;
				$whereparentgno['table_schema'] = SCHEMA_ADMISSION;
				$this->common->common_delete_new ( $table_parent_details , $whereparentgno );
			}			
		}
		// Update Wizard ID
		$wizard_update = $this->common_wizardupdate($applicant_id , APP_FORM_ID_DE , FORM_WIZARD_PARENT_ID);		
		$this->output->set_output(json_encode(['status' => '3', 'user_data' => $user_data]));  
	}
	
	public function dis_edu_academic_api_post(){
		$user_data = $this->post();
		$created_by = $this->post('created_by');
		$updated_by = $this->post('updated_by');
		$table_schema = SCHEMA_ADMISSION;
		$applicant_professional_exp_table = APPLICANT_PROFESSIONAL_EXP_TABLE;
		$applicant_persoanl_table = APPLICANT_PERSONAL_DET_TABLE;
		$applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
		$tableacadd = $table_schema.'.'.APPLICANT_SCHOOLING_TABLE;
		$function_name = $this->get_function_name ( __FUNCTION__ );    
		$current_qualification_status = $user_data['current_qualification_status'];
		if($current_qualification_status=='graduation' && $current_qualification_status!='twelfth'){
			$result_declared_graduation = true;
		}
		
		($result_declared_graduation==true)?true:false;
		
		if($current_qualification_status=='twelfth' && $current_qualification_status!='graduation'){
			$result_declared = true;
		}	
		
		($result_declared==true)?true:false;
		
		
		$candidate_name = $user_data['candidate_name'];
		$applicant_id = $user_data['applicant_id'];
		$applicant_appln_id = $user_data['applicant_appln_det_id'];	
		
		// Academic Tenth Details 
		$institute_name_tenth = $user_data['institute_name_tenth'];
		$board_tenth = $user_data['board_tenth'];
		$mode_study_tenth = $user_data['mode_study_tenth'];
		$marking_scheme_tenth = $user_data['marking_scheme_tenth'];
		$cgpa_tenth = $user_data['cgpa_tenth'];
		$yr_of_passing_tenth = $user_data['yr_of_passing_tenth'];
		$roll_no_tenth = $user_data['roll_no_tenth'];
		$scholling_id_tenth = $user_data['scholling_id_tenth'];
		$academic_board_other = $user_data['academic_board_other'];
		
		// Academic Twelfth Details
		$institute_name_twelfth = $user_data['institute_name_twelfth'];
		$board_twelfth = $user_data['board_twelfth'];
		$mode_study_twelfth = $user_data['mode_study_twelfth'];
		$marking_scheme_twelfth = $user_data['marking_scheme_twelfth'];
		$cgpa_twelfth = $user_data['cgpa_twelfth'];
		$yr_of_passing_twelfth = $user_data['yr_of_passing_twelfth'];
		$roll_no_twelfth = $user_data['roll_no_twelfth'];
		$stream_twelfth = $user_data['stream_twelfth'];
		$scholling_id_twelfth = $user_data['scholling_id_twelfth'];
		$academic_twelfth_board_other = $user_data['academic_twelfth_board_other'];
		$other_stream_name = $user_data['other_stream_name'];
		
		// Graduation Details
		$institute_name_graduation = $user_data['institute_name_graduation'];
		$university_graduation = $user_data['university_graduation'];
		$marking_scheme_graduation = $user_data['marking_scheme_graduation'];
		$cgpa_graduation = $user_data['cgpa_graduation'];
		$yr_of_passing_graduation = $user_data['yr_of_passing_graduation'];
		$roll_no_graduation = $user_data['roll_no_graduation'];
		$graduation_degree = $user_data['graduation_degree'];
		$scholling_id_graduation = $user_data['scholling_id_graduation'];	
		$academic_univ_other = $user_data['academic_univ_other'];
		
		$second_lang = ($user_data['second_lang']!='' && $user_data['second_lang']!='null')?$user_data['second_lang'] : NULL;		
		$learning_center = ($user_data['learning_center']!='' && $user_data['learning_center']!='null')?$user_data['learning_center'] : NULL;;
		
		$table_schema = SCHEMA_ADMISSION;
		// Server Side Validation
		/*$this->form_validation->set_data($user_data);
		$this->form_validation->set_rules('applicant_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('current_qualification_status', 'Current Qualification Status','trim|required');
		$this->form_validation->set_rules('candidate_name', 'Candidate Name','trim|required');
		 if($current_qualification_status=='graduation' && $current_qualification_status!='twelfth'){
			$this->form_validation->set_rules('institute_name_graduation', 'Institute Graduation Name','trim|required');
			$this->form_validation->set_rules('university_graduation', 'University Graduation Name','trim|required');
			$this->form_validation->set_rules('marking_scheme_graduation', 'Marking Scheme','trim|required');
			$this->form_validation->set_rules('cgpa_graduation', 'CGPA','trim|required');
			$this->form_validation->set_rules('roll_no_graduation', 'Roll No','trim|required|max_length[100]');
			$this->form_validation->set_rules('graduation_degree', 'Degree','trim|required');
		}else{
			$this->form_validation->set_rules('institute_name_tenth', 'Institute Name Tenth','trim|required');
			$this->form_validation->set_rules('board_tenth', 'Board','trim|required');
			$this->form_validation->set_rules('mode_study_tenth', 'Mode Of Study Tenth','trim|required');
			$this->form_validation->set_rules('marking_scheme_tenth', 'Marking Scheme Tenth','trim|required');
			$this->form_validation->set_rules('roll_no_tenth', 'Roll No Tenth','trim|required|max_length[100]');
			$this->form_validation->set_rules('yr_of_passing_tenth', 'Yr Of Passing Tenth','trim|required');
			$this->form_validation->set_rules('institute_name_twelfth', 'Institute Name Twelfth','trim|required');
			$this->form_validation->set_rules('board_twelfth', 'Board Twelfth','trim|required');
			$this->form_validation->set_rules('mode_study_twelfth', 'Mode Of Study Twelfth','trim|required');
			$this->form_validation->set_rules('marking_scheme_twelfth', 'Marking Scheme Twelfth','trim|required');	
			$this->form_validation->set_rules('roll_no_twelfth', 'Roll No Twelfth','trim|required|max_length[100]');
			$this->form_validation->set_rules('yr_of_passing_twelfth', 'Year Of Passing Twelfth','trim|required');
		}	
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		} */
		
		$pkapdt_id = 'applicant_personal_det_id';

		$check_applicant_pid_in_personal = $this->_get_applicant_personal_detail_id_o($function_name,$applicant_persoanl_table,$pkapdt_id,$applicant_id,true,false);

		if($check_applicant_pid_in_personal['data'][0]['applicant_personal_det_id']==$applicant_id){
			$where['applicant_personal_det_id'] = $applicant_id;
			$put_arrayparg['second_lang_id'] = $second_lang;
			$put_arrayparg['support_center_id'] = $learning_center;
			$put_arrayparm['updated_by'] = $updated_by;
			$this->common->common_update ( $applicant_persoanl_table ,'' , $put_arrayparg, $where);
		}
		
		$is_work_experience = $user_data['is_work_experience'];
		$prof_exp_ids = $this->post('prof_exp_ids_json',true);
		$prof_exp_ids = json_decode($prof_exp_ids,true);
		$org_name = $this->post('org_name_json',true);
		$org_name = json_decode($org_name,true);
		$designation = $this->post('designation_json',true);
		$designation = json_decode($designation,true);
		$job_nature = $this->post('job_nature_json',true);
		$job_nature = json_decode($job_nature,true);
		$salary = $this->post('salary_json',true);
		$salary = json_decode($salary,true);
		$from_date = $this->post('from_date_json',true);
		$from_date = json_decode($from_date,true);
		$to_date = $this->post('to_date_json',true);
		$to_date = json_decode($to_date,true);
		$work_exp_in_months = $this->post('work_exp_in_month_json',true);
		$work_exp_in_months = json_decode($work_exp_in_months,true);
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['active'] = TRUE; 
		if($is_work_experience == 'yes') {
			$is_work_experience_t = TRUE;
		} else {
			$is_work_experience_t = FALSE;
		}		
		
		$pkodid_id = 'applicant_other_det_id';
		$cond = array('applicant_appln_id'=>$applicant_appln_id);
		$check_applicant_pid_in_other = $this->_get_applicant_personal_detail_id($function_name,$applicant_other_details_table,$pkodid_id,$applicant_id,true,$cond);

		if($check_applicant_pid_in_other['data'][0]['applicant_appln_id']==$applicant_appln_id){
			$whereo['applicant_personal_det_id'] = $applicant_id;
			$whereo['applicant_appln_id'] = $applicant_appln_id;
			$put_arrayo['table_schema'] = SCHEMA_ADMISSION;
			$put_arrayo['is_work_experience'] = $is_work_experience_t;
			$put_arrayo['updated_by'] = $updated_by;
			$this->common->common_update ($applicant_other_details_table ,'' , $put_arrayo, $whereo);
		}else{
			$_POST['created_by']= $created_by;
			$_POST['applicant_personal_det_id']= $applicant_id;
			$_POST['applicant_appln_id']= $applicant_appln_id;
			$_POST['is_work_experience'] = $is_work_experience_t;
			$_POST['active'] = TRUE; 
			$columns = 'applicant_personal_det_id,is_work_experience,active,created_by,applicant_appln_id';
			$table_prefix='';
			$function_name = $this->get_function_name ( __FUNCTION__ );      
			$this->_common_insert ( $applicant_other_details_table , $table_prefix , $function_name , $columns , $table_schema);				
		}		
		
		$table_schema = SCHEMA_ADMISSION;
		$tablewpx = $table_schema.".".APPLICANT_PROFESSIONAL_EXP_TABLE;		
		
		if($scholling_id_tenth){
			$pksch_id = 'applicant_scl_det_id';
			$cond = array('schooling_id'=>$scholling_id_tenth,'applicant_appln_id'=>$applicant_appln_id);
			$check_applicant_pid_in_school_tenth = $this->_get_applicant_personal_detail_id($function_name,$tableacadd,$pksch_id,$applicant_id,true,$cond);	
			
			if($check_applicant_pid_in_school_tenth['data'][0]['applicant_appln_id']==$applicant_appln_id){
				$whereschooling['applicant_personal_det_id'] = $applicant_id;
				$whereschooling['schooling_id'] = $scholling_id_tenth;
				$whereschooling['applicant_appln_id'] = $applicant_appln_id;				
				$put_arrayschool['applicant_personal_det_id']= $applicant_id;
				$put_arrayschool['result_declared'] = true;
				$put_arrayschool['is_curr_qualify'] = false;
				$put_arrayschool['name_as_in_marksheet'] = $candidate_name;
				$put_arrayschool['institute_name']= $institute_name_tenth;
				$put_arrayschool['board_id'] = $board_tenth;
				$put_arrayschool['mode_of_study_id'] = $mode_study_tenth;
				$put_arrayschool['marking_scheme_id'] = $marking_scheme_tenth;
				$put_arrayschool['mark_percentage'] = $cgpa_tenth;
				$put_arrayschool['completion_year'] = $yr_of_passing_tenth;
				$put_arrayschool['registration_no'] = $roll_no_tenth;
				$put_arrayschool['other_board_name'] = $academic_board_other;
				$put_arrayschool['schooling_id'] = $scholling_id_tenth;
				$put_arrayschool['active']= true;
				$put_arrayschool['updated_by']= $updated_by;
				$this->common->common_update ( $tableacadd ,'' , $put_arrayschool, $whereschooling);
			}else{
				$_POST['applicant_personal_det_id']= $applicant_id;
				$_POST['applicant_appln_id']= $applicant_appln_id;
				$_POST['result_declared'] = true;
				$_POST['is_curr_qualify'] = false;
				$_POST['name_as_in_marksheet'] = $candidate_name;
				$_POST['institute_name']= $institute_name_tenth;
				$_POST['board_id'] = $board_tenth;
				$_POST['mode_of_study_id'] = $mode_study_tenth;
				$_POST['marking_scheme_id'] = $marking_scheme_tenth;
				$_POST['mark_percentage'] = $cgpa_tenth;
				$_POST['completion_year'] = $yr_of_passing_tenth;
				$_POST['registration_no'] = $roll_no_tenth;
				$_POST['other_board_name'] = $academic_board_other;
				$_POST['schooling_id'] = $scholling_id_tenth;
				$_POST['active']= true;
				$_POST['created_by']= $created_by;		
				$columns = 'applicant_personal_det_id,institute_name,board_id,mode_of_study_id,marking_scheme_id,mark_percentage,completion_year,registration_no,other_board_name,schooling_id,active,created_by,result_declared,name_as_in_marksheet,applicant_appln_id,is_curr_qualify';
				$table_prefix='';
				$function_name = $this->get_function_name ( __FUNCTION__ );      
				$this->_common_insert ( $tableacadd , $table_prefix , $function_name , $columns , $table_schema);
			}
		}
		
		if($scholling_id_twelfth){
			$pkschtw_id = 'applicant_scl_det_id';
			$cond = array('schooling_id'=>$scholling_id_twelfth,'applicant_appln_id'=>$applicant_appln_id);
			$check_applicant_pid_in_school_twelfth = $this->_get_applicant_personal_detail_id($function_name,$tableacadd,$pkschtw_id,$applicant_id,true,$cond);	
			
			if($check_applicant_pid_in_school_twelfth['data'][0]['applicant_appln_id']==$applicant_appln_id){
				$whereschooling['applicant_personal_det_id'] = $applicant_id;
				$whereschooling['schooling_id'] = $scholling_id_twelfth;
				$whereschooling['applicant_appln_id'] = $applicant_appln_id;	
				$put_arrayschool['applicant_personal_det_id']= $applicant_id;
				$put_arrayschool['result_declared'] = true;
				$put_arrayschool['is_curr_qualify'] = $result_declared;
				$put_arrayschool['name_as_in_marksheet'] = $candidate_name;
				$put_arrayschool['institute_name']= $institute_name_twelfth;
				$put_arrayschool['board_id'] = $board_twelfth;
				$put_arrayschool['mode_of_study_id'] = $mode_study_twelfth;
				$put_arrayschool['marking_scheme_id'] = $marking_scheme_twelfth;
				$put_arrayschool['mark_percentage'] = $cgpa_twelfth;
				$put_arrayschool['completion_year'] = $yr_of_passing_twelfth;
				$put_arrayschool['registration_no'] = $roll_no_twelfth;
				$put_arrayschool['other_board_name'] = $academic_twelfth_board_other;
				$put_arrayschool['stream_id'] = $stream_twelfth;
				$put_arrayschool['schooling_id'] = $scholling_id_twelfth;
				$put_arrayschool['active']= true;
				$put_arrayschool['updated_by']= $updated_by;
				$put_arrayschool['other_stream_name']=$other_stream_name;
				$this->common->common_update ( $tableacadd ,'' , $put_arrayschool, $whereschooling);
			}else{
				$_POST['applicant_personal_det_id']= $applicant_id;
				$_POST['applicant_appln_id']= $applicant_appln_id;
				$_POST['other_stream_name']=$other_stream_name;
				$_POST['result_declared'] = true;
				$_POST['name_as_in_marksheet'] = $candidate_name;
				$_POST['institute_name']= $institute_name_twelfth;
				$_POST['board_id'] = $board_twelfth;
				$_POST['mode_of_study_id'] = $mode_study_twelfth;
				$_POST['marking_scheme_id'] = $marking_scheme_twelfth;
				$_POST['mark_percentage'] = $cgpa_twelfth;
				$_POST['completion_year'] = $yr_of_passing_twelfth;
				$_POST['registration_no'] = $roll_no_twelfth;
				$_POST['other_board_name'] = $academic_twelfth_board_other;
				$_POST['stream_id'] = $stream_twelfth;
				$_POST['schooling_id'] = $scholling_id_twelfth;
				$_POST['active']= true;
				$_POST['created_by']= $created_by;	
				$_POST['is_curr_qualify'] = $result_declared;
				$columns = 'applicant_personal_det_id,institute_name,board_id,mode_of_study_id,marking_scheme_id,mark_percentage,completion_year,registration_no,other_board_name,stream_id,schooling_id,active,created_by,result_declared,name_as_in_marksheet,applicant_appln_id,is_curr_qualify,other_stream_name';
				$table_prefix='';
				$function_name = $this->get_function_name ( __FUNCTION__ );      
				$this->_common_insert ( $tableacadd , $table_prefix , $function_name , $columns , $table_schema);
			}
		} 
		
		if($scholling_id_graduation && $current_qualification_status=="graduation"){
			$tableacagt = $table_schema.'.'.APPLICANT_GRADUATION_TABLE;
			$pkschgt_id = 'applicant_grad_det_id';
			$cond = array('applicant_appln_id'=>$applicant_appln_id);
			$check_applicant_pid_in_graduation = $this->_get_applicant_personal_detail_id($function_name,$tableacagt,$pkschgt_id,$applicant_id,true,$cond);		
			//$tableacagtt = $table_schema.'.'.APPLICANT_GRADUATION_TABLE;
			if($check_applicant_pid_in_graduation['data'][0]['applicant_appln_id']==$applicant_appln_id){
				$wheregraduation['applicant_personal_det_id'] = $applicant_id;
				$wheregraduation['applicant_appln_id'] = $applicant_appln_id;				
				$put_arraygraduation['applicant_personal_det_id']= $applicant_id;
				$put_arraygraduation['insti_name'] = $institute_name_graduation;
				$put_arraygraduation['univ_id'] = $university_graduation;
				$put_arraygraduation['mark_scheme_id']= ($marking_scheme_graduation=='null')?'':$marking_scheme_graduation;
				$put_arraygraduation['mark_percent'] = $cgpa_graduation;
				$put_arraygraduation['completion_year'] = $yr_of_passing_graduation;
				$put_arraygraduation['registration_no'] = $roll_no_graduation;
				$put_arraygraduation['deg_id'] = $graduation_degree;
				$put_arraygraduation['graduation_type_id'] = $scholling_id_graduation;
				$put_arraygraduation['other_university_name'] = $academic_univ_other;
				$put_arraygraduation['result_declared'] = true;
				$put_arraygraduation['is_curr_qualify'] = $result_declared_graduation;
				$put_arraygraduation['active']= true;
				$put_arraygraduation['updated_by']= $updated_by;
				$this->common->common_update ( $tableacagt ,'' , $put_arraygraduation, $wheregraduation);
			}else{
				$_POST['applicant_personal_det_id']= $applicant_id;
				$_POST['applicant_appln_id']= $applicant_appln_id;
				$_POST['insti_name'] = $institute_name_graduation;
				$_POST['univ_id'] = $university_graduation;
				$_POST['mark_scheme_id']= ($marking_scheme_graduation=='null')?'':$marking_scheme_graduation;
				$_POST['mark_percent'] = $cgpa_graduation;
				$_POST['completion_year'] = $yr_of_passing_graduation;
				$_POST['registration_no'] = $roll_no_graduation;
				$_POST['deg_id'] = $graduation_degree;
				$_POST['graduation_type_id'] = $scholling_id_graduation;
				$_POST['other_university_name'] = $academic_univ_other;
				$_POST['result_declared'] = true;
				$_POST['is_curr_qualify'] = $result_declared_graduation;
				$_POST['active']= true;
				$_POST['created_by']= $created_by;		
				$columns = 'applicant_personal_det_id,insti_name,univ_id,mark_scheme_id,mark_percent,completion_year,registration_no,deg_id,graduation_type_id,other_university_name,is_curr_qualify,active,created_by,applicant_appln_id,result_declared';
				$table_prefix='';
				$function_name = $this->get_function_name ( __FUNCTION__ );      
				$this->_common_insert ( $tableacagt , $table_prefix , $function_name , $columns , $table_schema);				
			}
		}else{
			if($current_qualification_status!="graduation"){
				$tbl_schema_both = $table_schema.'.'.APPLICANT_GRADUATION_TABLE;
				$whereparentgno = array();
				$whereparentgno['applicant_personal_det_id'] = $applicant_id;
				$whereparentgno['applicant_appln_id'] = $applicant_appln_id;
				$whereparentgno['table_schema'] = SCHEMA_ADMISSION;
				$this->common->common_delete_new ( $tbl_schema_both , $whereparentgno );
			}			
		} 
		
		$professional_exp_res = array();
		if($is_work_experience == 'yes') {	
			if($org_name) {
				$applicant_professional_exp_columns = 'applicant_prof_exp_id,applicant_personal_det_id,org_name,designation,job_nature,salary,from_date,to_date,work_exp_in_months,active,applicant_appln_id,created_by,updated_by';
				foreach($org_name as $k=>$v) {
					$n_org_name = $v;
					$n_prof_exp_id = $prof_exp_ids[$k];
					$n_designation = $designation[$k];
					$n_job_nature = $job_nature[$k];
					$n_salary = $salary[$k];
					$n_from_date = $from_date[$k];
					$n_to_date = $to_date[$k];
					$n_work_exp_in_months = $work_exp_in_months[$k];
					$_SERVER["REQUEST_METHOD"] = "POST";
					$_POST = array();
					if($n_prof_exp_id) {
						$_POST['applicant_prof_exp_id'] = $n_prof_exp_id;	
					}
					$_POST['org_name'] = $n_org_name;
					$_POST['designation'] = $n_designation;
					$_POST['job_nature'] = $n_job_nature;
					$_POST['salary'] = $n_salary;
					$_POST['from_date'] = $n_from_date;
					$_POST['to_date'] = $n_to_date;
					$_POST['work_exp_in_months'] = $n_work_exp_in_months;
					$_POST['active'] = TRUE;
					$_POST['applicant_personal_det_id'] = $applicant_id;
					$_POST['applicant_appln_id'] = $applicant_appln_id;
					$_POST['created_by'] = $created_by;
					$_POST['updated_by'] = $updated_by;					
					// echo '<pre>';
					// print_r($_POST);
					// print_r($this->input->post());
					// echo '</pre>';
				
					if($n_prof_exp_id) {
						$professional_exp_res[] = $this->_insert_update_applicant_tables($function_name,array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_professional_exp_table, $applicant_professional_exp_columns, 1, 'applicant_prof_exp_id', $n_prof_exp_id);
					} else {
						$chk_flag = false;
						if(!$n_designation && !$n_job_nature && !$n_salary && !$n_from_date && !$n_to_date && !$n_work_exp_in_months) {
							$chk_flag = true;
						}
						if(!$chk_flag) {
							$professional_exp_res[] = $this->_insert_update_applicant_tables($function_name,array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_professional_exp_table, $applicant_professional_exp_columns, 1, 'applicant_prof_exp_id');
						}
					} 
				}
			}
		} 		
		$wizard_update = $this->common_wizardupdate($applicant_id , APP_FORM_ID_DE , FORM_WIZARD_ACADEMIC_ID);
		$this->output->set_output(json_encode(['status' => '5'])); 
	}
	
	public function declaration_dde_post(){
		$app_status = APPLICATION_IN_COMPLETED;
		$table_schema = SCHEMA_ADMISSION;
		$table = $table_schema.'.'.APPLICANT_APPLN;
		$user_data = $this->post();
		$updated_by = $this->post('updated_by');
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
		$put_arraydec['updated_by']= $updated_by;
		$this->common->common_update ( $table ,'' , $put_arraydec, $wheredec);

		$table_appln = APPLICANT_APPLN;
		$whereaad['applicant_personal_det_id'] = $applicant_id;
		$whereaad['applicant_appln_id'] = $applicant_appln_det_id;
		$put_arrayaad['table_schema'] = SCHEMA_ADMISSION;
		$put_arrayaad['application_status_id'] = $app_status;
		$put_arrayaad['updated_by']= $updated_by;
		$wizard_update = $this->common_wizardupdate($applicant_id , APP_FORM_ID_DE , FORM_WIZARD_UPLOAD_DECLARATION_ID);
		$update = $this->common->common_update ( $table_appln ,'' , $put_arrayaad, $whereaad);
	
		$this->output->set_output(json_encode(['status' => '6'])); 
	}
	
	
	public function check_exist_user ($table , $table_schema , $columns ,  $applicant_personal_det_id, $type = false, $pk_id_col = false, $pk_id_val = false, $form_id = false)
	{
		$function_name = $this->get_function_name(__FUNCTION__);
		$params = array();
		$params['table'] = $table;
		$params['table_schema'] = $table_schema;
		$params['function_name'] = $function_name;
		$params['columns'] = $columns;
		$params['returnresponse']=TRUE;
		if(is_array($applicant_personal_det_id)) {
            $cond = array();
            foreach($applicant_personal_det_id as $k=>$v) {
                $cond[$k] = $v;
            }
            $params['cond'] = $cond;
        } else {
            $params['cond'] = array($table.'.applicant_personal_det_id' => $applicant_personal_det_id); 
        }
		
		if($type == 1 && $pk_id_val) {
			$params['cond'][$pk_id_col] = $pk_id_val;
		}
		if($form_id) {
			$params['cond']['appln_form_id'] = $form_id;	
		}
		//$params['cond'] = array('user_name' => $user_data['username'] , $urtable.'.role_id' => $user_data['role_id']);	
		$result = $this->_select_table($params);
		// echo $this->db->last_query();
		return $result;
	}	
	
	protected function _insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $table, $columns, $type = false, $pk_id_col = false, $pk_id_val = false, $form_id = false) 
	{
		$res = false;
		$table_prefix = '';
		$check_user = $this->check_exist_user($table, $table_schema, $columns,  $applicant_personal_det_id,$type,$pk_id_col,$pk_id_val,$form_id);

		// die;
		// echo 'pk_id_col => '.$pk_id_col."\n";
		// echo 'pk_id_val => '.$pk_id_val."\n";
		if($type == 1 && $pk_id_val) {
			$update = true;
		} else if($type == 1 && !$pk_id_val) {
			$update = false;
		} else {
			$update = true;
		}
		// echo 'update => '.$update."\n";
		if(isset($check_user['data']) && !empty($check_user['data']) && $update)
		{
			$put_array = $this->post();
			$put_array = array_merge($put_array,$this->input->post());
			// $put_array[$table_prefix.'id'] = $applicant_personal_det_id;
			if($type == 1) {
				$update = $this->_common_update ( $table , $table_prefix , $function_name , $columns , $put_array ,  $pk_id_col,$table_schema);
			} 
			else if($type == 2) {
                $where = array();
                if(is_array($applicant_personal_det_id)) {
                    foreach($applicant_personal_det_id as $k=>$v) {
                        $where[$k] = $v;
                    }
                } else {
                    $where['applicant_personal_det_id'] = $applicant_personal_det_id;
                }
                $arr_columns = explode(',', $columns);
                $new_put_array = array();
                if($put_array) {
                    foreach($put_array as $k=>$v) {
                        // columns search in key
                        if(strpos($columns, $k) !== false) {
                            // exact match with columns
                            if($arr_columns) {
                                foreach($arr_columns as $k1=>$v1) {
                                    if(preg_match("/\b".preg_quote($k)."\b/i", $v1)) {
                                        $new_put_array[$k] = $v;        
                                    }       
                                }
                            }
                        }
                    }
                }

                $update = $this->common->common_update ( $table ,$table_prefix , $new_put_array, $where);
            }
			else {
				$update = $this->_common_update ( $table , $table_prefix , $function_name , $columns , $put_array ,  'applicant_personal_det_id',$table_schema);
			}
			if($update){
				$res = [
	                'status' => 'true' ,
	                'type' => $table ,
	                'id' => $pk_id_val ,
	                'message' => RECORD_UPDATE_SUCCESSFULLY,
	            ];
	        } else {
	        	$res = [
                    'status' => 'error' ,
                    'type' => $table ,
                    'message' => ERROR_MSG,
                ];
	        }
		}
		else
		{
			// echo 'insert => '."\n";
			$insert = $this->_common_insert ( $table , $table_prefix , $function_name , $columns , $table_schema );
			
			$insert_id = $this->common->_get_last_insert_id($table_schema, $table, $pk_id_col);
			if($insert) {
				$res = [
                    'status' => 'true' ,
                    'type' 	=> $table ,
                    'id' 	=> $insert_id ,
                    'message' => RECORD_ADDED_SUCCESSFULLY,
                ];
			} else {
				$res = [
                    'status' => 'error' ,
                    'type' => $table ,
                    'message' => ERROR_MSG,
                ];
			}
		}
		return $res;
	}	
	
	public function db_func_call_dde_get() {
		$get_prog_id = $this->input->get('prog_id');
		$is_course =  $this->get('is_course',true);
		$form_id = APP_FORM_ID_DE;
		$fn_get_app_course_detail = FN_GET_CHOICE_DROPDOWN;
		$table_schema = SCHEMA_ADMISSION;
		//$id = array(0=>$get_prog_id,1=>null,2=>null,3=>null,4=>null,5=>$form_id);
		
		$column['id'] = 'prog_id';
		$column['name'] = 'branch_name';
		
		$get_prog_id=!empty($get_prog_id) ? $get_prog_id : 'null';
		$array1=!empty($array1) ? $array1 : 'null';
		$array2=!empty($array2) ? $array2 : 'null';
		$array3=!empty($array3) ? $array3 : 'null';
		//$array4=!empty($array4) ? $array4 : 'null';
		$form_id=!empty($form_id) ? $form_id : 'null';
		
		$arguments=array($get_prog_id,$array1,$array2,$array3,$form_id);		
		$result = $this->db_distinct_func_call($table_schema, $fn_get_app_course_detail, $arguments,$column);
	}
	
	public function db_func_call_dde_campus_get() {
		$get_prog_id = $this->input->get('prog_id');
		$form_id = APP_FORM_ID_DE;
		$fn_get_app_course_detail = FN_GET_CHOICE_DROPDOWN;
		$table_schema = SCHEMA_ADMISSION;
		
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