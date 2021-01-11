<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package SRM - Online Application
 * @category APPlications API
 * @subpackage Phd
 *
 * @SWG\Resource(
 *  apiVersion="0.1",
 *  swaggerVersion="1.2",
 *  resourcePath="/api",
 *  produces="['application/json']"
 * )
 *
 */
class Phd_jan extends API_Controller {
    
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
	
    public function wizard_api_phd_jan_post(){
		$app_form_id_phd = APP_FORM_ID_PHD_JAN;
		$form_wizard_basic_id = FORM_WIZARD_BASIC_ID;
		$form_wizard_personal_id = FORM_WIZARD_PERSONAL_ID;
		$form_wizard_parent_address_id = FORM_WIZARD_PARENT_ADDRESS_ID;
		$form_wizard_payment_id = FORM_WIZARD_PAYMENT_ID;
		$form_wizard_declaration_id = FORM_WIZARD_DECLARATION_ID;
		$form_wizard_upload_id = FORM_WIZARD_UPLOAD_ID;
		$app_status=APPLICATION_IN_PROGRESS;

		$user_data = $this->post ();
		$appln_status = $this->post ('appln_status');	
		$created_by = $this->post ('created_by');	
		$updated_by = $this->post ('updated_by');		
		$applicant_id = $user_data['applicant_id'];
		$applicant_appln_id = $user_data['applicant_appln_det_id'];
		$qualifying_degree = $user_data['qualifying_degree'];
		$specialization_qualifying_degree = $user_data['specialization_qualifying_degree'];
		$working_dsc = $user_data['working_dsc'];
		$faculty = $user_data['faculty'];
		$other_degree_name = $user_data['qualifying_degree_val_other'];
		$other_spec_degree_name = $user_data['specialization_qualifying_degree_val_other'];
		$other_dept = $user_data['dept_val_other'];
		$other_faculty = $user_data['faculty_val_other'];
		$work_place_other = $user_data['work_place_other'];
		$category = $user_data['category'];
		$is_employed = $user_data['is_employed'];
		$is_curr_qualify = $user_data['is_curr_qualify'];
		if($is_employed=="t"){
			$is_employed = true;
		}
		
		$working_place = $user_data['working_place'];
		
		// PersonaL Details
		$gender_title = $user_data['gender_title_id'];
		$first_name = $user_data['first_name'];
		$middle_name = $user_data['middle_name'];
		$last_name = $user_data['last_name'];
		$mobile_no = $user_data['mobile_no'];
		$email_id = $user_data['email_id'];
		$dob = $user_data['dob'];
		$gender = $user_data['gender'];
		$alt_email = $user_data['alt_email'];
		$blood_group = $user_data['blood_group'];
		$nationality = $user_data['nationality'];
		$social_status = $user_data['social_status'];
		$diffrently_abled = $user_data['diffrently_abled'];
		$nature_of_deformity = $user_data['nature_of_deformity'];
		$percent_of_deformity = $user_data['percent_of_deformity']; 
	
		// Declaration
		$applicant_name = $user_data['applicant_name'];
		$declaration_date = $user_data['declaration_date'];
          $declaration_date = date('Y-m-d',strtotime($declaration_date));
		
          $function_name = $this->get_function_name(__FUNCTION__);
			

		// API Wizard Basic Details 
		if($user_data['currentIndex']==0){

               $this->form_validation->set_data($this->post());
               $this->form_validation->set_rules('applicant_id', 'Personal det id','trim|required');
               $this->form_validation->set_rules('qualifying_degree', 'Qualifying Degree','trim|required');
               $this->form_validation->set_rules('specialization_qualifying_degree', 'Specialization In Qualifying Degree','trim|required');
               $this->form_validation->set_rules('working_dsc', 'Department / School / College','trim|required');
               $this->form_validation->set_rules('faculty', 'Faculty','trim|required');
               $this->form_validation->set_rules('category', 'Category','trim|required');
               if($category == PART_TIME_EXTERNAL) {
                    $this->form_validation->set_rules('is_employed', 'Working Type','trim|required');
                    if($is_employed=="t"){
                         $this->form_validation->set_rules('working_place', 'Working Place','trim|required');
                    }    
               }
               //Run Validations
               if ($this->form_validation->run() == FALSE) {
                    return $this->output->set_content_type('application/json')
                         ->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
               }
			
			
			$pk_id = 'applicant_grad_det_id';
			$tablevv = APPLICANT_GRADUATION_TABLE;
			$cond = array('applicant_appln_id'=>$applicant_appln_id);
			$check_applicant_pid = $this->_get_applicant_personal_detail_id($function_name,$tablevv,$pk_id,$applicant_id,true,$cond);
			$tablepdd = TABLE_APPLICANT_PERSONAL_DET;
			$table_prefixu='';
			
			// $where = array();
			$wherenew['applicant_personal_det_id'] = $applicant_id;	
			$put_arraynew['table_schema'] = SCHEMA_ADMISSION;
			$put_arraynew['employee'] = $is_employed;
			$put_arraynew['emp_category_id'] = $category;
			$put_arraynew['work_place'] = $working_place;	
			$put_arraynew['updated_by'] = $updated_by;
			$update = $this->common->common_update ( $tablepdd ,'' , $put_arraynew, $wherenew);	
            // common_wizardupdate
			$wizard_update = $this->common_wizardupdate($applicant_id , $app_form_id_phd , $form_wizard_basic_id);
			if($appln_status!=APPLICATION_IN_COMPLETED){
				$wizard_update = $this->common_application_status_update($applicant_id, $applicant_appln_id,APPLICATION_IN_PROGRESS);
			}

			if($check_applicant_pid['data'][0]['applicant_appln_id']==$applicant_appln_id){
				$tableu = APPLICANT_GRADUATION_TABLE;
				$table_prefixu='';
				$where = array();
				$where['applicant_personal_det_id'] = $applicant_id;
				$where['applicant_appln_id'] = $applicant_appln_id;
				$where['is_curr_qualify'] = true;
				$put_array['table_schema'] = SCHEMA_ADMISSION;
				$put_array['deg_id'] = $qualifying_degree;
				$put_array['spec_id'] = $specialization_qualifying_degree;
				$put_array['dept_id'] = $working_dsc;
				$put_array['faculty_id'] = $faculty;
				$put_array['other_degree_name'] = $other_degree_name;
				$put_array['other_specialization_name'] = $other_spec_degree_name;
				$put_array['other_department_name'] = $other_dept;
				$put_array['other_faculty_name'] = $other_faculty;
				$put_array['other_work_place'] = $work_place_other;
				$put_array['applicant_appln_id'] = $applicant_appln_id;
				$put_array['updated_by'] = $updated_by;
				$update = $this->common->common_update ( $tableu ,'' , $put_array, $where);
				$this->output->set_output(json_encode(['status' => '2'])); 
			}else{
				$table = APPLICANT_GRADUATION_TABLE;
				$table_schema = SCHEMA_ADMISSION;
				$_POST['applicant_personal_det_id']= $applicant_id;
				$_POST['deg_id']= $qualifying_degree;
				$_POST['spec_id']= $specialization_qualifying_degree;
				$_POST['dept_id']= $working_dsc;
				$_POST['faculty_id']= $faculty;
				$_POST['other_degree_name']= $other_degree_name;
				$_POST['other_specialization_name']= $other_spec_degree_name;
				$_POST['other_department_name']= $other_dept;
				$_POST['other_faculty_name'] = $other_faculty;
				$_POST['other_work_place'] = $work_place_other;
				$_POST['created_by']= $created_by;
				$_POST['active']= true;
				$_POST['is_curr_qualify']= $is_curr_qualify;
				$_POST['applicant_appln_id'] = $applicant_appln_id;
                    // $_POST['application_status_id'] = $app_status;
				$columns = 'applicant_personal_det_id,deg_id,spec_id,dept_id,faculty_id,is_curr_qualify,other_degree_name,other_specialization_name,other_department_name,other_faculty_name,other_work_place,active,created_by,applicant_appln_id';
				$table_prefix='';
				$function_name = $this->get_function_name ( __FUNCTION__ );      
				$insert = $this->_common_insert ( $table , $table_prefix , $function_name , $columns , $table_schema);
				
				if($insert){
					$this->output->set_output(json_encode(['status' => '1', 'user_data' => $user_data]));
				}
			}			
		}
		
		if($user_data['currentIndex']==1){

               $this->form_validation->set_data($this->post());
               $this->form_validation->set_rules('applicant_id', 'Personal det id','trim|required');
               $this->form_validation->set_rules('gender_title_id', 'Title','trim|required');
               $this->form_validation->set_rules('first_name', 'First Name','trim|required|xss_clean|max_length[100]');
               $this->form_validation->set_rules('middle_name', 'Middle Name','trim|xss_clean|max_length[50]');
               $this->form_validation->set_rules('last_name', 'Last Name','trim|required|xss_clean|max_length[50]');
               $this->form_validation->set_rules('mobile_no', 'Mobile No','trim|required|xss_clean|max_length[10]');
               $this->form_validation->set_rules('email_id', 'Email ID','trim|required|xss_clean|max_length[100]|valid_email');
               if($alt_email) {
                    $this->form_validation->set_rules('alt_email', 'Alternate Email','trim|max_length[100]|valid_email');
               }
               $this->form_validation->set_rules('dob', 'Date of Birth','trim|required|xss_clean');
               $this->form_validation->set_rules('gender', 'Gender','trim|required');
               $this->form_validation->set_rules('blood_group', 'Blood Group','trim|required');
               $this->form_validation->set_rules('nationality', 'Nationality','trim|required');
               if($nationality == COUNTRY_VALUE_DEFAULT) {
                    $this->form_validation->set_rules('social_status', 'Social Status','trim|required');
               }
               $this->form_validation->set_rules('diffrently_abled', 'Differently Abled','trim|required');
               if($diffrently_abled == 'yes') {
                    $this->form_validation->set_rules('nature_of_deformity', 'Nature of Deformity','trim|required');
                    $this->form_validation->set_rules('percent_of_deformity', 'Percentage of Deformity','trim|required');     
               }
               
               //Run Validations
               if ($this->form_validation->run() == FALSE) {
                    return $this->output->set_content_type('application/json')
                         ->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
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
			$put_arraypd['updated_by'] = $updated_by;
			$put_arraypd['mobile_no'] = $mobile_no;
			$put_arraypd['email_id'] = $email_id;
			$put_arraypd['dob'] = $dob;
			$put_arraypd['gender_id'] = $gender;
			$put_arraypd['second_email_id'] = $alt_email;
			$put_arraypd['blood_grp_id'] = $blood_group;
			$put_arraypd['nationality_id'] = $nationality;
			$put_arraypd['social_status_id'] = ($social_status=='')?null:$social_status;
			$put_arraypd['diff_abled'] = ($diffrently_abled=='yes')?'yes':'no';
			$put_arraypd['deformity_type_id'] = ($nature_of_deformity=='')?null:$nature_of_deformity;
			$put_arraypd['deformity_percent'] = ($percent_of_deformity=='')?null:$percent_of_deformity; 
			$update = $this->common->common_update ( $tablepd ,'' , $put_arraypd, $wherepd);	
               // common_wizardupdate
               $wizard_update = $this->common_wizardupdate($applicant_id , $app_form_id_phd , $form_wizard_personal_id);
			$this->output->set_output(json_encode(['status' => '3', 'user_data' => $user_data])); 
		}
		
		if($user_data['currentIndex']==5){

               $this->form_validation->set_data($this->post());
               $this->form_validation->set_rules('applicant_id', 'Personal det id','trim|required');
               $this->form_validation->set_rules('applicant_name', 'Applicant Name','trim|required|xss_clean|max_length[100]');
               $this->form_validation->set_rules('declaration_date', 'Date','trim|required|xss_clean');

               //Run Validations
               if ($this->form_validation->run() == FALSE) {
                    return $this->output->set_content_type('application/json')
                         ->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
               }

			$tableaad = APPLICANT_APPLN; 
			$table_schema = SCHEMA_ADMISSION;		
			$pk_id = 'applicant_appln_id';
			$cond = array('applicant_appln_id'=>$applicant_appln_id);
			$check_applicant_pid = $this->_get_applicant_personal_detail_id($function_name,$tableaad,$pk_id,$applicant_id,true,$cond);	

               // common_wizardupdate
               $wizard_update = $this->common_wizardupdate($applicant_id , $app_form_id_phd , $form_wizard_declaration_id);		
			
			if($check_applicant_pid['data'][0]['applicant_appln_id']==$applicant_appln_id){
				$wheres['applicant_personal_det_id'] = $applicant_id;
				$wheres['applicant_appln_id'] = $applicant_appln_id;
				$put_arrays['table_schema'] = SCHEMA_ADMISSION;
				$put_arrays['appln_form_id'] = APP_FORM_ID_PHD_JAN;
				$put_arrays['updated_by'] = $updated_by;
				$put_arrays['applicant_name_declaration'] = $applicant_name;
				$put_arrays['applicant_declaration_date'] = $declaration_date;
				// $this->output->set_output(json_encode(['status' => $where]));
				$update = $this->common->common_update ( $tableaad ,'' , $put_arrays, $wheres);
				$this->output->set_output(json_encode(['status' => '4', 'user_data' => $check_applicant_pid]));				
			}
		}
	}	
	
	public function acdemic_dtl_post()
	{
			$app_form_id_phd = APP_FORM_ID_PHD_JAN;
			$form_wizard_academic_id = FORM_WIZARD_ACADEMIC_ID;
					
			$applicant_graduation_table = APPLICANT_GRADUATION_TABLE;
			$applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
			$applicant_professional_exp_table = APPLICANT_PROFESSIONAL_EXP_TABLE;
			$applicant_publication_det_table = APPLICANT_PUBLICATION_DET_TABLE;
			$applicant_competitive_exam_det_table = APPLICANT_COMPETITIVE_EXAM_DET_TABLE;
			$table_schema = SCHEMA_ADMISSION;

			$table_prefix = '';
			$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
			$is_competitive_exam = $this->post('is_competitive_exam',true);
			$comp_exam_id = $this->post('comp_exam_id',true);	
			// _get_appln_form_id
			$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_phd);
			$applicant_appln_id = $applicant_appln_det_res['id'];
			// common_wizardupdate
			$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_phd , $form_wizard_academic_id);

			$is_work_experience = $this->post('is_work_experience',true);
			
			$prof_exp_ids = $this->post('prof_exp_ids',true);
			$prof_exp_ids = json_decode($prof_exp_ids,true);
			$org_name = $this->post('org_name',true);
			$org_name = json_decode($org_name,true);
			$designation = $this->post('designation',true);
			$designation = json_decode($designation,true);
			$job_nature = $this->post('job_nature',true);
			$job_nature = json_decode($job_nature,true);
			$salary = $this->post('salary',true);
			$salary = json_decode($salary,true);
			$from_date = $this->post('from_date',true);
			$from_date = json_decode($from_date,true);
			$to_date = $this->post('to_date',true);
			$to_date = json_decode($to_date,true);
			$work_exp_in_months = $this->post('work_exp_in_month',true);
			$work_exp_in_months = json_decode($work_exp_in_months,true);
			
			$grad_det_ids = $this->post('grad_det_idss',true);
			$grad_det_ids = json_decode($grad_det_ids,true);
			$other_degree_name = $this->post('other_degree_namess',true);
			$other_degree_name = json_decode($other_degree_name,true);
			$major_discipline = $this->post('major_discipliness',true);
			$major_discipline = json_decode($major_discipline,true);
			$major_discipline_1 = (isset($major_discipline[0]))?$major_discipline[0]:false;
			$major_discipline_2 = (isset($major_discipline[1]))?$major_discipline[1]:false;
			$major_discipline_3 = (isset($major_discipline[2]))?$major_discipline[2]:false;
			$univ_id = $this->post('univ_ids',true);
			$univ_id = json_decode($univ_id,true);
			$mark_scheme_id = $this->post('mark_scheme_ids',true);
			$mark_scheme_id = json_decode($mark_scheme_id,true);

			$mark_percent = $this->post('mark_percentss',true);
			$mark_percent = json_decode($mark_percent,true);
			$completion_year = $this->post('completion_yearss',true);
			$completion_year = json_decode($completion_year,true);

			$publn_det_ids = $this->post('publn_det_ids',true);
			$publn_det_ids = json_decode($publn_det_ids,true);
			$title = $this->post('titles',true);
			$title = json_decode($title,true);
			$journal_conf_name = $this->post('journal_conf_names',true);
			$journal_conf_name = json_decode($journal_conf_name,true);
			$year = $this->post('years',true);
			$year = json_decode($year,true);
			
			$nameofemployee = $this->post('nameofemployee');
			$addressofemployee = $this->post('addressofemployee');
			$salaryreceived = $this->post('salaryreceived');

			$_SERVER["REQUEST_METHOD"] = "POST";
			$_POST['active'] = true;
			// $_POST['major_discipline_1'] = $major_discipline_1;
			$_POST['major_discipline_1'] = $major_discipline_1;
			$_POST['major_discipline_2'] = $major_discipline_2;
			$_POST['major_discipline_3'] = $major_discipline_3;
			$_POST['applicant_appln_id'] = $applicant_appln_id;
			if($is_work_experience == 'yes') {
				$_POST['is_work_experience'] = true;
			} else {
				$_POST['is_work_experience'] = false;
			}
			if($is_competitive_exam == 'yes') {
				$_POST['is_competitive_exam'] = true;
			} else {
				$_POST['is_competitive_exam'] = false;
			}
			$research_area = $this->post('research_area',true);
			$tentative_topic = $this->post('tentative_topic',true);
			$choiceofprefofsupervisor = $this->post('choiceofprefofsupervisor',true);			
			$_POST['comp_exam_id'] = ($comp_exam_id=='null')?'':$comp_exam_id;
			
			$_POST['research_area'] = $research_area;
			$_POST['tentative_topic'] = $tentative_topic;
			$_POST['choiceofprefofsupervisor'] = $choiceofprefofsupervisor;
			
			$applicant_graduation_columns = 'applicant_grad_det_id,applicant_personal_det_id,other_degree_name,univ_id,mark_scheme_id,mark_percent,completion_year,active,applicant_appln_id';
			
			$applicant_other_details_columns = 'applicant_personal_det_id,is_competitive_exam,tentativetopicdocument,choiceofprefofsupervisor,major_discipline_1,active,applicant_appln_id';
			
			if($major_discipline_2){
				$applicant_other_details_columns .= ',major_discipline_2';
			}

			if($major_discipline_3){
				$applicant_other_details_columns .= ',major_discipline_3';
			}
			
			if($is_work_experience=="yes"){
				$applicant_other_details_columns .= ',nameofemployee,addressofemployee,salaryreceived,total_work_exp,is_work_experience';
			}else{
				$applicant_other_details_columns .= ',is_work_experience';
			}
			
			if($research_area){
				$applicant_other_details_columns .= ',research_area';
			}
			
			if($tentative_topic){
				$applicant_other_details_columns .= ',tentative_topic';
			}
			
			$applicant_professional_exp_columns = 'applicant_prof_exp_id,applicant_personal_det_id,org_name,designation,job_nature,salary,from_date,to_date,work_exp_in_months,active,applicant_appln_id';
			$applicant_publication_det_columns = 'applicant_publn_det_id,applicant_personal_det_id,title,journal_conf_name,year,active,applicant_appln_id';
			$applicant_competitive_exam_det_columns = 'applicant_personal_det_id,comp_exam_id,active,applicant_appln_id';
			
			// is_work_experience, taken_any_competitive_exam, competitive_exam, phd_major
			$this->form_validation->set_data($this->post());
			$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
			$this->form_validation->set_rules('is_competitive_exam', 'Taken any competitive exam','trim|required');
			if($other_degree_name) {
				foreach($other_degree_name as $k=>$v) {
					if($v) {
						$this->form_validation->set_rules('other_degree_names['.$k.']', 'Degree/ Diploma','trim|xss_clean|max_length[50]');	
					}
					if($major_discipline[$k]) {
						$this->form_validation->set_rules('major_discipline['.$k.']', 'Major Discipline','trim|xss_clean|max_length[50]');	
					}
					if($mark_percent[$k]) {
						$this->form_validation->set_rules('mark_percents['.$k.']', 'Mark Percents','trim|xss_clean');
					}
					if($completion_year[$k]) {
						$this->form_validation->set_rules('completion_years['.$k.']', 'Completion Years','trim|xss_clean');
					}
				}
			}
			if($is_work_experience == 'yes') {
				$this->form_validation->set_rules('nameofemployee', 'Name of Employee','trim|required|xss_clean|max_length[150]');
				$this->form_validation->set_rules('addressofemployee', 'Address Of Employee','trim|required|xss_clean|max_length[500]');
				$this->form_validation->set_rules('salaryreceived', 'Salary received /Month','trim|required|xss_clean|max_length[10]');
			
				if($org_name) {
					foreach($org_name as $k=>$v) {
						if($k == 0) {
							$org_name_valid = 'trim|required|xss_clean|max_length[100]';
							$designation_valid = 'trim|required|xss_clean|max_length[100]';
							$job_nature_valid = 'trim|required|xss_clean|max_length[100]';
							$salary_valid = 'trim|required|xss_clean';
							$from_date_valid = 'trim|required|xss_clean';
							$to_date_valid = 'trim|required|xss_clean';
							$work_exp_in_month_valid = 'trim|required|xss_clean';
						} else {
							$org_name_valid = 'trim|xss_clean|max_length[100]';
							$designation_valid = 'trim|xss_clean|max_length[100]';
							$job_nature_valid = 'trim|xss_clean|max_length[100]';
							$salary_valid = 'trim|xss_clean';
							$from_date_valid = 'trim|xss_clean';
							$to_date_valid = 'trim|xss_clean';
							$work_exp_in_month_valid = 'trim|xss_clean';
						}
						if($v) {
							$this->form_validation->set_rules('org_name['.$k.']', 'Organization name',$org_name_valid);	
						}
						if($designation[$k]) {
							$this->form_validation->set_rules('designation['.$k.']', 'Designation',$designation_valid);
						}
						if($job_nature[$k]) {
							$this->form_validation->set_rules('job_nature['.$k.']', 'Job Nature',$job_nature_valid);
						}
						if($salary[$k]) {
							$this->form_validation->set_rules('salary['.$k.']', 'Salary',$salary_valid);
						}
						if($from_date[$k]) {
							$this->form_validation->set_rules('from_date['.$k.']', 'From Date',$from_date_valid);
						}
						if($to_date[$k]) {
							$this->form_validation->set_rules('to_date['.$k.']', 'To Date',$to_date_valid);
						}
						if($work_exp_in_months[$k]) {
							$this->form_validation->set_rules('work_exp_in_month['.$k.']', 'Work Exp in months',$work_exp_in_month_valid);
						}        
					}
				}
			}

			if($is_competitive_exam == 'yes') {
				$this->form_validation->set_rules('comp_exam_id', 'Competitive exam','trim|required');        
			}

			if($title) {
				foreach($title as $k=>$v) {
					if($v) {
						$this->form_validation->set_rules('titles['.$k.']', 'Title','trim|xss_clean|max_length[100]');	
					}
					if($journal_conf_name[$k]) {
						$this->form_validation->set_rules('journal_conf_names['.$k.']', 'Name of the Journal / Conference I Published in the case books','trim|xss_clean|max_length[100]');	
					}
					if($year[$k]) {
						$this->form_validation->set_rules('years['.$k.']', 'Year','trim|xss_clean');
					}
				}
			}
			$this->form_validation->set_rules('research_area', 'Major Area of Ph.D. Research','trim|xss_clean|max_length[100]');
			$this->form_validation->set_rules('tentative_topic', 'Tentative Topic','trim|xss_clean|max_length[100]');
			$this->form_validation->set_rules('choiceofprefofsupervisor', 'choice of pref of supervisor','trim|required|xss_clean|max_length[1000]');
			
			//Run Validations
			if ($this->form_validation->run() == FALSE) {
					return $this->output->set_content_type('application/json')
					->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
			}

			$function_name = $this->get_function_name(__FUNCTION__);
			//  applicant_other_details insert / update
			$other_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_other_details_table, $applicant_other_details_columns, false, 'applicant_other_det_id');
			if($is_competitive_exam == 'yes') {
			$competitive_exam_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_competitive_exam_det_table, $applicant_competitive_exam_det_columns, false, 'applicant_entr_exam_det_id');
			}
			
			// applicant_professional_exp_table
			$professional_exp_res = array();

			if($is_work_experience == 'yes') {
					if($org_name) {
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
									$_POST['applicant_appln_id'] = $applicant_appln_id;			
									
									// echo '<pre>';
									// print_r($_POST);
									// print_r($this->input->post());
									// echo '</pre>';
									if($n_prof_exp_id) {
											$professional_exp_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_professional_exp_table, $applicant_professional_exp_columns, 1, 'applicant_prof_exp_id', $n_prof_exp_id);
									} else {
											$chk_flag = false;
											if(!$n_designation && !$n_job_nature && !$n_salary && !$n_from_date && !$n_to_date && !$n_work_exp_in_months) {
													$chk_flag = true;
											}
											if(!$chk_flag) {
													$professional_exp_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_professional_exp_table, $applicant_professional_exp_columns, 1, 'applicant_prof_exp_id');
											}
									}
							}
					}
			}
			// applicant_graduation_table
			$degree_res = array();
			if($other_degree_name) {
					foreach($other_degree_name as $k=>$v) {
							$n_other_degree_name = $v;
							// $n_major_discipline = $major_discipline[$k];
							$n_grad_det_id = $grad_det_ids[$k];
							$n_univ_id = $univ_id[$k];
							$n_univ_id = ($n_univ_id=='null')?'':$n_univ_id;
							$n_mark_scheme_id = $mark_scheme_id[$k];
							$n_mark_scheme_id = ($n_mark_scheme_id=='null')?'':$n_mark_scheme_id;
							$n_mark_percent = $mark_percent[$k];
							$n_completion_year = $completion_year[$k];
							
							$_SERVER["REQUEST_METHOD"] = "POST";
							$_POST = array();
							if($n_grad_det_id) {
									$_POST['applicant_grad_det_id'] = $n_grad_det_id;        
							}
							
							$_POST['other_degree_name'] = $n_other_degree_name;
							// $_POST['major_discipline'] = $n_major_discipline;
							$_POST['univ_id'] = $n_univ_id;
							$_POST['mark_scheme_id'] = $n_mark_scheme_id;
							$_POST['mark_percent'] = $n_mark_percent;
							$_POST['completion_year'] = $n_completion_year;
							$_POST['active'] = TRUE;
							$_POST['applicant_appln_id'] = $applicant_appln_id;
							// echo 'n_grad_det_id => '.$n_grad_det_id."\n";
							if($n_grad_det_id) {
									// echo 'n_grad_det_id 1'."\n";
									$degree_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_graduation_table, $applicant_graduation_columns, 1, 'applicant_grad_det_id', $n_grad_det_id);
							} else {
									$chk_flag = false;
									if(!$n_other_degree_name && !$n_univ_id && !$n_mark_scheme_id && !$n_mark_percent && !$n_completion_year) {
											$chk_flag = true;
									}
									if(!$chk_flag) {
											// echo 'n_grad_det_id 2'."\n";
											$degree_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_graduation_table, $applicant_graduation_columns, 1, 'applicant_grad_det_id');
									}
							}
					}
			}

			// applicant_publication_det_table
			$publication_res = array();
			if($title) {
					foreach($title as $k=>$v) {
							$n_title = $v;
							$n_publn_det_id = $publn_det_ids[$k];
							$n_journal_conf_name = $journal_conf_name[$k];
							$n_year = $year[$k];
							
							$_SERVER["REQUEST_METHOD"] = "POST";
							$_POST = array();
							if($n_publn_det_id) {
									$_POST['applicant_publn_det_id'] = $n_publn_det_id;        
							}
							$_POST['title'] = $n_title;
							$_POST['journal_conf_name'] = $n_journal_conf_name;
							$_POST['year'] = $n_year;
							$_POST['active'] = TRUE;
							$_POST['applicant_appln_id'] = $applicant_appln_id;
							if($n_publn_det_id) {
									$publication_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_publication_det_table, $applicant_publication_det_columns, 1, 'applicant_publn_det_id', $n_publn_det_id);
							} else {
									$chk_flag = false;
									if(!$n_title && !$n_journal_conf_name && !$n_year) {
											$chk_flag = true;
									}
									if(!$chk_flag) {
											$publication_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_publication_det_table, $applicant_publication_det_columns, 1, 'applicant_publn_det_id');
									}
							}
					}
			}

			$this->_get_error_status($professional_exp_res);
			$this->_get_error_status($degree_res);
			$this->_get_error_status($publication_res);
			if($competitive_exam_res) {
					if($competitive_exam_res['status'] == 'error') {
							$this->response ($competitive_exam_res , API_Controller::HTTP_OK);
					} else {
							$other_res['competitive_exam_res'] = $competitive_exam_res;
					}
			}
			if($professional_exp_res) {
					$other_res['professional_exp_res'] = $professional_exp_res;
			}
			if($degree_res) {
					$other_res['degree_res'] = $degree_res;
			}
			if($publication_res) {
					$other_res['publication_res'] = $publication_res;
			}
			$this->response ($other_res , API_Controller::HTTP_OK);
	}		
	
    public function final_step_post() {
		$tableaad = APPLICANT_APPLN;
		$app_form_id_phd = APP_FORM_ID_PHD_JAN;
		$form_wizard_upload_id = FORM_WIZARD_UPLOAD_ID;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$updated_by = $this->post('updated_by',true);
		// _get_appln_form_id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_phd);
		$applicant_appln_id = $applicant_appln_det_res['id'];
		$wizard_update = array();
		// common_wizardupdate
		$wizard_update[] = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_phd , $form_wizard_upload_id);
		// common_application_status_update
		$wizard_update[] = $this->common_application_status_update($applicant_personal_det_id , $applicant_appln_id,false);
		$wheres['applicant_personal_det_id'] = $applicant_personal_det_id;
		$wheres['applicant_appln_id'] = $applicant_appln_id;
		$put_arrays['table_schema'] = SCHEMA_ADMISSION;
		$put_arrays['updated_by'] = $updated_by;
		$update = $this->common->common_update ( $tableaad ,'' , $put_arrays, $wheres);		
		if($update) {
			$response = array("status"=>true);
			$this->response ($response , API_Controller::HTTP_OK);
		}		
		
    }	
}