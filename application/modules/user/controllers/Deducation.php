<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter-HMVC-AdminLTE
 *
 * @package    CodeIgniter-HMVC-AdminLTE
 * @author     N3Cr0N (N3Cr0N@list.ru)
 * @copyright  2019 N3Cr0N
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @link       <URI> (description)
 * @version    GIT: $Id$
 * @since      Version 0.0.1
 * @todo       (description)
 *
 */

class Deducation extends FrontendController
{
	//
    public $CI;

    /**
     * An array of variables to be passed through to the
     * view, layouts, ....
     */
    protected $data = array();

    /**
     * [__construct description]
     *
     * @method __construct
     */
    public function __construct()
    {
		/*CRM ADMIN Edit form start*/
        $mode = $this->uri->segment(2); 
        $applicant_login_id =  $this->uri->segment(3);
        $applicant_personal_det_id = $this->uri->segment(4);
        $mode=($mode)?$mode:'';
        if($mode == ADMIN_MODE_EDIT)
        {
            $this->user_details_data = $this->session->userdata('crmadmin_details_data');
        }else
        {
			$this->user_details_data = $this->session->userdata('user_details_data');
			$this->ses_applicant_login_id = $this->user_details_data['user_details']['data'][0]['applicant_login_id'];
			$this->ses_applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];
        }
        /*CRM ADMIN Edit form end*/	
        parent::__construct();
        $CI =& get_instance();
        $this->load->helper('cookie');
		$this->application_year = date("Y");
    }

    /**
     * [index description]
     *
     * @method index
     *
     * @return [type] [description]
     */
    public function index($stream = false)
    {
        $this->is_exists_user_logged();
        $this->data['stream'] = $stream;
        $this->data['site_title'] = $this->data['page_title'] = '';
        // Display page with the template function from REST_Controller
        $this->template('applications/index', $this->data, true);
    }
	
    public function dist_edu_form($mode = false , $applicant_login_id = false , $applicant_personal_det_id = false) {
        $this->is_exists_user_logged();
		/*CRM ADMIN Edit form start*/
		$this->data['get_admin_session'] = $get_crmadmin_session = $this->_get_crmadmin_session();
		$this->data['mode_edit'] = $mode;
		$this->data['crm_applicant_login_id'] = $applicant_login_id;
		$this->data['crm_applicant_personal_det_id'] = $applicant_personal_det_id;
		if($this->_get_crmadmin_session() == true) {        
			$applicant_id = ($applicant_personal_det_id)?$applicant_personal_det_id:$this->ses_applicant_id;
			$applicant_login_id=($applicant_login_id)?$applicant_login_id:$this->ses_applicant_login_id;
		}else{
			$applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];
			$applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];  
		}
        /*CRM ADMIN Edit form end*/
		// Check for admin role id on edit mode
        $created_updated_by=($mode)?CRM_ADMIN_USER_ROLE_ID:$applicant_id;		
		
		// Get Form ID
		$get_form_id = APP_FORM_ID_DE;
		// Get Applicant ID
		$applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);
		// Get Applicant APPLN ID		
		$applicant_appln_det_id = $applicant_appln_det['id'];
		
		if ( $this->input->post () ){	
			$user_data = $this->input->post();
			// Track the application created , updated by
			$user_data['created_by']=$created_updated_by;
            $user_data['updated_by']=$created_updated_by;			
			$api_urls = $this->config->item ( 'api_urls' );
			// Method Type
			$method = 'POST';			
			// Basic Details Start
			if($user_data['currentIndex']==0){
				// Basic Details API & Method
				$url = $api_urls[ 'wizard_api_dist_edu' ];
				$userdata = $this->user_details_data;
				$user_data['userdata'] = $userdata;			
				// Get Personal Applicant ID
				$user_data['applicant_id'] = $applicant_id;
				$user_data['applicant_appln_det_id'] = $applicant_appln_det_id;
				$user_data['appln_status'] = $user_data['appln_status'];
				$user_data['user_details_data'] = $this->user_details_data['user_details']['data'][0];
				list($result_token,$data) = $this->_check_token($user_data);  
                if($result_token['valid']=='true')
                {
					// Call API
					$data = $this->call_api($url,$method,$user_data);
					$return = $this->json_return($data);
					return $return;				
				}				
			}
			
			// Personal Details Start 
			if($user_data['currentIndex']==1){
				// Personal Details API & Method
				$url = $api_urls[ 'wizard_api_dist_edu' ];
				$userdata = $this->user_details_data;
				$user_data['userdata'] = $userdata;			
				// Get Personal Applicant ID
				$user_data['applicant_id'] = $applicant_id;
				$user_data['applicant_appln_det_id'] = $applicant_appln_det_id;
				// Course Preferences Data Post
				$user_data['prog_id'] = $user_data['pd_program'];
				$user_data['course_id'] = $user_data['pd_course'];
				
				$user_data['campus_id'] = ($user_data['pd_campus']=='')?DEFAULT_VALUE_CHECK:$user_data['pd_campus'];
				// Personal Details Data Post
				$user_data['gender_title_id'] = $user_data['pd_title'];
				$user_data['first_name'] = $user_data['pd_firstname'];
				$user_data['middle_name'] = $user_data['pd_middlename'];
				$user_data['last_name'] = $user_data['pd_lastname'];
				$user_data['phone_no_code'] = $user_data['phone_no_code'];
				// $mobile_no_concate_code = $user_data['phone_no_code'].''.$user_data['pd_mobile_no'];
				$mobile_no_concate_code = $user_data['pd_mobile_no'];
				$user_data['mobile_no'] = $mobile_no_concate_code;
				$user_data['email_id'] = $user_data['pd_email'];
				$user_data['dob'] = date("Y-m-d",strtotime($user_data['pd_dob']));			
				$user_data['gender'] = $user_data['pd_gender'];
				$user_data['alt_email'] = $user_data['pd_alt_email'];
				$user_data['blood_group'] = $user_data['pd_blood_group'];
				$user_data['nationality'] = $user_data['pd_nationality'];
				$user_data['social_status'] = ($user_data['pd_social_status']=='')?null:$user_data['pd_social_status'];
				$user_data['aadhar_no'] = $user_data['pd_aadhaar_no'];
				$user_data['diffrently_abled'] = $user_data['pd_diffrently_abled'];
				$user_data['eco_weaker_val'] = $user_data['pd_eco_weaker_val'];
	
				$user_data['nature_of_deformity'] = ($user_data['pd_nature_deformity']=='')?null:$user_data['pd_nature_deformity'];
				$user_data['percent_of_deformity'] = ($user_data['pd_percent_of_deformity']=='')?null:$user_data['pd_percent_of_deformity'];
				
				$user_data['user_details_data'] = $this->user_details_data['user_details']['data'][0];
				list($result_token,$data) = $this->_check_token($user_data);  
                if($result_token['valid']=='true')
                {
					// Call API
					$data = $this->call_api($url,$method,$user_data);
					$return = $this->json_return($data);
					return $return;	
				}
			}
			
			if($user_data['currentIndex']==2){
				// Parent Details API & Method
				$url = $api_urls[ 'wizard_api_parent' ];
				$userdata = $this->user_details_data;
				$user_data['userdata'] = $userdata;			
				// Get Personal Applicant ID
				$user_data['applicant_id'] = $applicant_id;
				$user_data['applicant_appln_det_id'] = $applicant_appln_det_id;
				// Father Detail
				$user_data['parent_type_father_id'] = PARENT_TYPE_ID_FATHER;
				$user_data['parent_father_name'] = $user_data['pd_father_name'];
				$user_data['father_mobile_no'] = $user_data['pd_father_phone'];
				$user_data['father_email_id'] = $user_data['pd_father_email'];
				$user_data['father_occupation'] = $user_data['pd_father_occupation'];
				$user_data['father_mob_country_code_id'] = $user_data['pd_father_phone_no_code'];
				$user_data['father_title'] = $user_data['pd_father_title'];
				$user_dat['other_occupation_father'] = $user_data['other_occupation_father'];
				
				// Mother Detail
				$user_data['parent_type_mother_id'] = PARENT_TYPE_ID_MOTHER;
				$user_data['parent_mother_name'] = $user_data['pd_mother_name'];
				$user_data['mother_mobile_no'] = $user_data['pd_mother_phone'];
				$user_data['mother_email_id'] = $user_data['pd_mother_email'];
				$user_data['mother_occupation'] = $user_data['pd_mother_occupation'];
				$user_data['mother_mob_country_code_id'] = $user_data['pd_mother_phone_no_code'];
				$user_data['mother_title'] = $user_data['pd_mother_title'];
				$user_dat['other_occupation_mother'] = $user_data['other_occupation_mother'];
				
				// Guardian Detail
				$user_data['parent_type_guardian_id'] = PARENT_TYPE_ID_GUARDIAN;
				$user_data['add_guardian_details'] = $user_data['add_guardian_checkbox'];
				$user_data['parent_guardian_name'] = $user_data['pd_guardian_name'];
				$user_data['guardian_mob_country_code_id'] = $user_data['pd_guardian_phone_no_code'];
				$user_data['guardian_mobile_no'] = $user_data['pd_guardian_phone'];
				$user_data['guardian_email_id'] = $user_data['pd_guardian_email'];
				$user_data['guardian_occupation'] = $user_data['pd_guardian_occupation'];
				$user_dat['other_occupation_guardian'] = $user_data['other_occupation_guardian'];
				
				
				$user_data['user_details_data'] = $this->user_details_data['user_details']['data'][0];
				list($result_token,$data) = $this->_check_token($user_data);  
                if($result_token['valid']=='true')
                {
					// Call API
					$data = $this->call_api($url,$method,$user_data);
					$return = $this->json_return($data);
					return $return;	
				}
			}
			
			// Address Details
			if($user_data['currentIndex']==3)
            {
                $api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls[ 'addressdet' ];
                $method = 'POST';
				$userdata = $this->user_details_data;
				$user_data['userdata'] = $userdata;
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['applicant_login_id'] = $applicant_login_id;
				$user_data['app_form_id'] = $get_form_id;
                list($result_token,$data) = $this->_check_token($user_data);  
                if($result_token['valid']=='true')
                {
					$result = $this->call_api ( $url , $method , $user_data );
					$response = array("status"=>$result['status'],"message"=> $result['message']);
					$return = $this->json_return($response);
					return $return;
					//return $response;
					//print_r($result);
					//die;
                }
            }

			// Academic Details
			if($user_data['currentIndex']==4){
				$api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls[ 'dis_edu_academic_api' ];
                $method = 'POST';
				$userdata = $this->user_details_data;
				$user_data['userdata'] = $userdata;
				$user_data['applicant_id'] = $applicant_id;
				$user_data['applicant_appln_det_id'] = $applicant_appln_det_id;
				$user_data['current_qualification_status'] = $user_data['current_qualification_status'];
				$user_data['candidate_name'] = $user_data['candidate_name'];
				
				// Tenth Academic
				$user_data['institute_name_tenth'] = $user_data['academic_tenth_inst'];
				$user_data['board_tenth'] = $user_data['academic_tenth_board'];
				$user_data['mode_study_tenth'] = $user_data['academic_tenth_mos'];
				$user_data['marking_scheme_tenth'] = $user_data['academic_tenth_msv'];
				$user_data['cgpa_tenth'] = $user_data['academic_tenth_cgpa'];
				$user_data['yr_of_passing_tenth'] = $user_data['academic_tenth_yrp'];
				$user_data['roll_no_tenth'] = $user_data['academic_tenth_regno'];
				$user_data['scholling_id_tenth'] = SCHOOLING_ID_TENTH;
				$user_data['academic_board_other'] = $user_data['academic_board_other'];
				
				// Twelfth Academic
				$user_data['institute_name_twelfth'] = $user_data['academic_twelfth_inst'];
				$user_data['board_twelfth'] = $user_data['academic_twelfth_board'];
				$user_data['mode_study_twelfth'] = $user_data['academic_twelfth_mos'];
				$user_data['marking_scheme_twelfth'] = $user_data['academic_twelfth_msv'];
				$user_data['cgpa_twelfth'] = $user_data['academic_twelfth_cgpa'];
				$user_data['yr_of_passing_twelfth'] = $user_data['academic_twelfth_yrp'];
				$user_data['roll_no_twelfth'] = $user_data['academic_twelfth_regno'];
				$user_data['stream_twelfth'] = $user_data['academic_twelfth_stream'];
				$user_data['scholling_id_twelfth'] = SCHOOLING_ID_TWELFTH;
				$user_data['academic_twelfth_board_other'] = $user_data['academic_twelfth_board_other'];
				$user_data['other_stream_name'] = $user_data['other_stream_name'];
				
				// Graduation Academic
				$user_data['institute_name_graduation'] = $user_data['academic_graduation_inst'];
				$user_data['university_graduation'] = $user_data['academic_graduation_university'];
				$user_data['marking_scheme_graduation'] = $user_data['academic_marking_scheme_graduation'];
				$user_data['cgpa_graduation'] = $user_data['academic_obtain_cgpa_graduation'];
				$user_data['yr_of_passing_graduation'] = $user_data['academic_yr_passing_graduation'];
				$user_data['roll_no_graduation'] = $user_data['academic_reg_no_graduation'];
				$user_data['graduation_degree'] = $user_data['graduation_degree'];
				$user_data['scholling_id_graduation'] = SCHOOLING_ID_GRADUATION;	
				$user_data['academic_univ_other'] = $user_data['academic_univ_other'];
				
				// Learning Center & Language
				$user_data['second_lang'] = $user_data['second_lang'];
				$user_data['learning_center'] = $user_data['learning_center'];
				
				// Work Experience
				$user_data['is_work_experience'] = $user_data['is_work_experience'];
				$user_data['prof_exp_ids'][] = $user_data['prof_exp_id_0'];
                $user_data['org_name'][] = $user_data['organisation_name_0'];
                $user_data['designation'][] = $user_data['designation_0'];
                $user_data['job_nature'][] = $user_data['nature_of_job_0'];
                $user_data['salary'][] = $user_data['total_salary_month_0'];
                $user_data['from_date'][] = $user_data['from_year_0'];
                $user_data['to_date'][] = $user_data['to_year_0'];
                $user_data['work_exp_in_month'][] = $user_data['work_experience_0'];
                $user_data['prof_exp_ids'][] = $user_data['prof_exp_id_1'];
                $user_data['org_name'][] = $user_data['organisation_name_1'];
                $user_data['designation'][] = $user_data['designation_1'];
                $user_data['job_nature'][] = $user_data['nature_of_job_1'];
                $user_data['salary'][] = $user_data['total_salary_month_1'];
                $user_data['from_date'][] = $user_data['from_year_1'];
                $user_data['to_date'][] = $user_data['to_year_1'];
                $user_data['work_exp_in_month'][] = $user_data['work_experience_1'];
                $user_data['prof_exp_ids'][] = $user_data['prof_exp_id_2'];
                $user_data['org_name'][] = $user_data['organisation_name_2'];
                $user_data['designation'][] = $user_data['designation_2'];
                $user_data['job_nature'][] = $user_data['nature_of_job_2'];
                $user_data['salary'][] = $user_data['total_salary_month_2'];
                $user_data['from_date'][] = $user_data['from_year_2'];
                $user_data['to_date'][] = $user_data['to_year_2'];
                $user_data['work_exp_in_month'][] = $user_data['work_experience_2'];

                $user_data['prof_exp_ids_json'] = json_encode($user_data['prof_exp_ids']);
                $user_data['org_name_json'] = json_encode($user_data['org_name']);
                $user_data['designation_json'] = json_encode($user_data['designation']);
                $user_data['job_nature_json'] = json_encode($user_data['job_nature']);
                $user_data['salary_json'] = json_encode($user_data['salary']);
                $user_data['from_date_json'] = json_encode($user_data['from_date']);
                $user_data['to_date_json'] = json_encode($user_data['to_date']);
                $user_data['work_exp_in_month_json'] = json_encode($user_data['work_exp_in_month']);

                $user_data['total_work_exp'] = $user_data['total_work_experience'];				

                list($result_token,$data) = $this->_check_token($user_data);  
                if($result_token['valid']=='true')
                {
					$result = $this->call_api ( $url , $method , $user_data );
					//$response = array("status"=>$result['status']);
					$return = $this->json_return($result);
					return $return;
					//return $response;
					//print_r($result);
					//die;
                }				
			}
			
			if($user_data['currentIndex']==6){
				$api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls[ 'declaration_dde' ];
                $method = 'POST';
				$userdata = $this->user_details_data;
				$user_data['userdata'] = $userdata;
				$user_data['applicant_id'] = $applicant_id;
				$user_data['applicant_appln_det_id'] = $applicant_appln_det_id;
				$user_data['applicant_name'] = $user_data['applicant_name'];
				$user_data['parent_name'] = $user_data['parent_name'];
                if(!empty($user_data['ddate'])){
                    $ddate=$this->convertDate($ddate['ddate']);
                    $user_data['ddate'] = $ddate;
                }else{
                    $user_data['ddate'] = date("Y-m-d",strtotime($user_data['ddate']));
                }
				list($result_token,$data) = $this->_check_token($user_data);  
                if($result_token['valid']=='true')
                {
					$result = $this->call_api ( $url , $method , $user_data );
					$response = array("status"=>true);
					$return = $this->json_return($response);
					return $return;
                }	
			}
		}else{
			$api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'upload_filelist' ];
			// Added form id to get doc data applicant_appln_id wise
            $url .= '/?fk_id='.$applicant_id.'&fk1_id='.$get_form_id;
            $method = 'GET';
			$userdata = $this->user_details_data;
			$user_data['userdata'] = $userdata;
            list($result_token,$data) = $this->_check_token($user_data);
            if($result_token['valid']=='true')
            {
                $result = $this->call_api ( $url , $method , $user_data );
            }
            $upload_filelist = $result['data'];
            $this->data['upload_filelist'] = $upload_filelist;			
			$this->data['form_wizard'] = true;
			$this->data['sidebar'] = 'icon';	
			$this->data['logged_applicant_id']=$applicant_id;
			$this->data['logged_applicant_login_id']=$applicant_login_id;			
            /*Applicant View Status*/			
			$applicant_basic_details_list = $this->_get_applicant_tables($applicant_id, 'db_func_basic_detail');
            $this->data['applicant_basic_details_list'] = $applicant_basic_details_list[0];
			
			$applicant_course_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_course_detail');
            $this->data['applicant_course_details_list'] = $applicant_course_details_list[0];
			
			$applicant_campus_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_campus_detail');
            $this->data['applicant_campus_details_list'] = $applicant_campus_details_list[0];
			
			$applicant_parent_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_parent_detail');
            $this->data['applicant_parent_details_list'] = $applicant_parent_details_list;
			
			$applicant_address_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id),'db_func_address_detail');
			$this->data['applicant_address_details_list'] = $applicant_address_details_list;
			
			$applicant_schooling_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_schooling_detail');
            $this->data['applicant_schooling_list'] = $applicant_schooling_list;
			
			$applicant_prof_exps_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_exp_detail');
            $this->data['applicant_prof_exps_list'] = $applicant_prof_exps_list;

            $applicant_graduations_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_grad_detail');
            $this->data['applicant_graduations_list'] = $applicant_graduations_list;
			
			$applicant_other_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_other_detail');
            $this->data['applicant_other_details_list'] = $applicant_other_details_list[0];
			
			$applicant_doc_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_doc_detail');
            $this->data['applicant_doc_details_list'] = $applicant_doc_details_list;
			
			$applicant_appln_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_form_id'=>$get_form_id), 'db_func_appln_detail');
            $this->data['applicant_appln_details_list'] = $applicant_appln_details_list[0];

			//redirect to dashboard after appln completion
			if($applicant_appln_details_list){
				$application_status_id=$applicant_appln_details_list[0]['application_status_id'];
				if(!empty($application_status_id) && $application_status_id!=APPLICATION_IN_PROGRESS && $mode == ''){
					redirect(base_url());
				}
			}
			//End: redirect to dashboard after appln completion			
			
			$payment_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_payment_detail');
            $this->data['payment_details_list'] = $payment_details_list[0];
			
			$this->data['get_second_lang'] = $this->_get_second_lang('learn_second_lang',$applicant_id)[0];
			
			$this->data['get_grad_inst_name'] = $this->_get_second_lang('grad_univ',$applicant_id,$applicant_appln_det_id)[0];
			
			// Get Instruction Wizard
            $arr_wizard_id = array(FORM_WIZARD_BASIC_ID,FORM_WIZARD_PERSONAL_ID,FORM_WIZARD_PARENT_ID,FORM_WIZARD_ADDRESS_ID,FORM_WIZARD_ACADEMIC_ID,FORM_WIZARD_PAYMENT_ID,FORM_WIZARD_UPLOAD_DECLARATION_ID);
            foreach($arr_wizard_id as $k=>$v) {
                $applicant_instructions_list = $this->_get_applicant_tables(array('appln_form_id'=>$get_form_id,'wizard_id'=>$v), 'db_func_instruction');
                $this->data['applicant_instructions_list'][$v] = $applicant_instructions_list;      
            }			

            /*Form Index Restriction Start*/
            $wizard_dt = $this->_get_wizard_details($get_form_id);
            $applnform_wizard_id = $applicant_appln_details_list[0]['form_w_wizard_id'];
            $get_appln_wizard_dtl = $this->_get_appln_wizard_details($applnform_wizard_id);
            $this->data['wizard_dt']=$wizard_dt;
            $this->data['appln_wizard_dt']=$get_appln_wizard_dtl;
            /*Form Index Restriction End*/			
			
			$this->data['user_data'] = $this->user_details_data['user_details']['data'][0];
			$this->data['personal_detail_list'] = $this->personal_detail_list($applicant_id);
			// $mobile_code = substr($this->data['result_appicant']['mobile_no'],0,3);
			// $this->data['personal_phone_code'] = $this->phone_code_list($mobile_code);	
			$this->data['site_title'] = $this->data['page_title'] = 'Distance Education Application Form ( Academic Session )';
			$this->template('applications/dis_edu_form', $this->data, true);
		}
    }		

    /**
     * get active nationality list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_nationalities() {
        parent::_get_nationalities(false, $this->is_admin);
    }

    /**
     * get active course list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_courses() {
        parent::_get_courses(false, $this->is_admin);
    }

    /**
     * get active specialization list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_specializations() {
        parent::_get_specializations(false, $this->is_admin);
    }

    /**
     * get active campus list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_campuses() {
        parent::_get_campuses(false, $this->is_admin);
    }
	
    /**
     * get active blood groups list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_bloodgroups() {
        parent::_get_bloodgroups(false, $this->is_admin);
    }

    public function form_hs_ug_srmjeeh() {
        $this->is_exists_user_logged();
        $this->data['stream'] = $stream;
        $this->data['site_title'] = $this->data['page_title'] = 'Health Sciences Undergraduate Application Form (SRMJEEH) '.$this->application_year;
        
        $this->template('applications/hs_ug_srmjeeh_form', $this->data, true);
    }

    public function get_appcourses()
    {
        parent::_get_appcourses(false, $this->is_admin);
    }

    /*Btech Application Form*/
    public function form_btech() {
        $this->is_exists_user_logged();
        $this->data['stream'] = $stream;
        $this->data['site_title'] = $this->data['page_title'] = 'B.Tech Application Form 2020';
        $this->template('applications/btech_form', $this->data, true);
    }


    /*Mtech Research Application Form*/
    public function form_mtechresearch() {
        $this->is_exists_user_logged();
        $this->data['site_title'] = $this->data['page_title'] = 'M.Tech (Research)';
        $this->template('applications/mtechresearch_form', $this->data, true);
    }
    
    // Distance Education Application Form
    public function form_dis_edu() {
        $this->is_exists_user_logged();
        $this->data['stream'] = $stream;
        $this->data['site_title'] = $this->data['page_title'] = 'Distance Education Application Form '.$this->application_year;
        $this->template('applications/dis_edu_form', $this->data, true);
    }

    public function get_graduations()
    {
        parent::_get_graduations(false, $this->is_admin);
    }

    public function get_gender_title()
    {
        parent::_get_gender_title(false, $this->is_admin);
    }

    public function get_gender()
    {
        parent::_get_gender(false, $this->is_admin);
    }

    public function get_social_status()
    {
        parent::_get_social_status(false, $this->is_admin);
    }

    public function get_nature_of_deformity()
    {
        parent::_get_nature_of_deformity(false, $this->is_admin);
    }

    public function get_percentage_of_deformity()
    {
        parent::_get_percentage_of_deformity(false, $this->is_admin);
    }
	
    /**
     * get active qualifying degree list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_qualifying_degree() {
        parent::_get_qualifying_degree(false, $this->is_admin);
    }
	
    /**
     * get active specialization qualifying degree list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_spec_qualifying_degree() {
        parent::_get_spec_qualifying_degree(false, $this->is_admin);
    }

    /**
     * get active working department school college list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_working_dsc() {
        parent::_get_working_dsc(false, $this->is_admin);
    }

    /**
     * get active faculty list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_faculty() {
        parent::_get_faculty(false, $this->is_admin);
    }	
	
    /**
     * get active faculty work category list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_work_category() {
        parent::_get_work_category(false, $this->is_admin);
    }		
	
    /**
     * get active faculty are you employeed list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_are_you_employed() {
        parent::_get_are_you_employed(false, $this->is_admin);
    }	

    /**
     * get active faculty working place list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_working_place() {
        parent::_get_working_place(false, $this->is_admin);
    }

    /**
     * get active faculty are you diffrently abled place list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_are_you_differently_abled() {
        parent::_get_are_you_differently_abled(false, $this->is_admin);
    }

    /**
     * get active institute/university list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_institute_university() {
        parent::_get_institute_university(false, $this->is_admin);
    }

    /**
     * get active user_marking_scheme list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_user_marking_scheme() {
        parent::_get_user_marking_scheme(false, $this->is_admin);
    }

    /**
     * get active competitive_exams list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_competitive_exams() {
        parent::_get_competitive_exams(false, $this->is_admin);
    }
	
    /**
     * get active nationality list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_current_resident() {
        parent::_get_current_resident(false, $this->is_admin);
    }	
	

    public function upload_file() {
        $file_doc_type = $this->input->post('file_doc_type');
        $id = $this->input->post('id');
        $applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];   
        $applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];

        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'user' ];
        $url .= '/'.$applicant_login_id;
        $method = 'GET';
        $userdata = $this->session_userdata();
        $data['userdata'] = $userdata;
        list($result_token,$data) = $this->_check_token($data);
        if($result_token['valid']=='true')
        {
            $result = $this->call_api ( $url , $method , $data );
        }
        $get_users = $result['data'];        
        $this->data['get_users'] = $get_users;
        $foldername = $this->data['get_users']['first_name']."_".$this->data['get_users']['user_id'];

        $is_edit = ($id)?true:false;
        // $upload_post_file_name = 'photograph';
        // $upload_type = 'photograph';
        $upload_post_file_name = $file_doc_type;
        $upload_type = $file_doc_type;
        if($upload_type == 'tentative_topic_files') {
            $this->_upload_files_multiple ($foldername, $upload_post_file_name, $upload_type, $applicant_id, $applicant_login_id,$is_edit);
        } else {
            $this->_upload_files ($foldername, $upload_post_file_name, $upload_type, $applicant_id, $applicant_login_id,$is_edit);    
        }
    }

    public function del_uploaded_file() {
        $result = array();
        $doc_id = $this->input->post('doc_id');
        $data_del_file_id = $this->input->post('data_del_file_id');
        $applicant_login_id = $this->input->post('logged_applicant_login_id');
        $applicant_id = $this->input->post('logged_applicant_id');
        $data = array();
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'del_upload_file' ];
        $method = 'POST';
        $userdata = $this->session_userdata();
        $user_data['userdata'] = $userdata;
        
        list($result_token,$data) = $this->_check_token($user_data);  
        if($result_token['valid']=='true')
        {
            $data['doc_id'] = $doc_id;
            $data['applicant_personal_det_id'] = $applicant_id;
            $data['applicant_login_id'] = $applicant_login_id;
            $data['data_del_file_id'] = $data_del_file_id;
            $result = $this->call_api ( $url , $method , $data );
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
        $return_response = $this->output->get_output();
        return $return_response;
    }

    	
    /**
     * get have you taken any competitive exam list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_have_you_taken_any_competitive_exam() {
        parent::_get_have_you_taken_any_competitive_exam(false, $this->is_admin);
    }

    /* protected function _get_applicant_tables($api_config_path) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ $api_config_path ];
        $url .= '/?applicant_id='.$applicant_id;
        $method = 'GET';
        $userdata = $this->session_userdata();
        $user_data['userdata'] = $userdata;
        list($result_token,$data) = $this->_check_token($user_data);  
        if($result_token['valid']=='true')
        {
            $result = $this->call_api ( $url , $method , $data );
        }
        $result = $result['data'];
        return $result;
    } */
	
	protected function _get_second_lang($api_config_path,$applicant_id=false,$applicant_appln_id=false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ $api_config_path ];
		
		if($applicant_appln_id){
			$url .= '/?applicant_personal_det_id='.$applicant_id.'&applicant_appln_id='.$applicant_appln_id;
		}else{
			$url .= '/?applicant_personal_det_id='.$applicant_id;
		}		
        $method = 'GET';
        $userdata = $this->session_userdata();
        $user_data['userdata'] = $userdata;
        list($result_token,$data) = $this->_check_token($user_data);  
        if($result_token['valid']=='true')
        {
            $result = $this->call_api ( $url , $method , $user_data );
        }
        $result = $result['data'];
        return $result;
    }	
	
    public function get_parent_title()
    {
        parent::_get_parent_title(false, $this->is_admin);
    }
		
	public function get_mother_title()
    {
        parent::_get_mother_title(false, $this->is_admin);
    }

    public function get_parent_occupation()
    {
        parent::_get_parent_occupation(false, $this->is_admin);
    }

	public function get_eco_weaker_section()
    {
        parent::_get_eco_weaker_section(false, $this->is_admin);
    }

	public function get_board()
    {
        parent::_get_board(false, $this->is_admin);
    }

	public function get_mode_of_study()
    {
        parent::_get_mode_of_study(false, $this->is_admin);
    }

	public function get_current_qualification_status()
    {
        parent::_get_current_qualification_status(false, $this->is_admin);
    }

	public function get_yr_of_passing_schooling()
    {
        parent::_get_yr_of_passing_schooling(false, $this->is_admin);
    }

	public function get_streams()
    {
        parent::_get_streams(false, $this->is_admin);
    }

	public function get_course_prefer()
    {
        parent::_get_course_prefer(false, $this->is_admin);
    }

	public function get_course_preference()
    {
		$prog_id = $this->input->get('prog_id');
		$keywords=$this->input->get('keywords');
		$query_data = array();
        if(!empty($prog_id)){
            $query_data['prog_id'] = $prog_id;
        }	
        if(!empty($keywords)){
            $query_data['keywords'] = $keywords;
        }		
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls['db_func_call_dde'];
        $query = http_build_query($query_data);
        $url = $url .'?'.$query;
        $method = 'GET';
        $userdata = $this->session_userdata();
        $user_data['userdata'] = $userdata;
        list($result_token,$data) = $this->_check_token($user_data);  
        if($result_token['valid']=='true')
        {
            $result = $this->call_api ( $url , $method , $user_data );
        }
        echo json_encode($result);
    }

	public function get_campus_preference()
    {
		$prog_id = $this->input->get('prog_id');
		$keywords=$this->input->get('keywords');
		$query_data = array();
        if(!empty($prog_id)){
            $query_data['prog_id'] = $prog_id;
        }	
        if(!empty($keywords)){
            $query_data['keywords'] = $keywords;
        }
		//$branch_id = $this->input->get('branch_id');
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls['db_func_call_dde_campus'];
        $query = http_build_query($query_data);
        $url = $url .'?'.$query;
        $method = 'GET';
        $userdata = $this->session_userdata();
        $user_data['userdata'] = $userdata;
        list($result_token,$data) = $this->_check_token($user_data);  
        if($result_token['valid']=='true')
        {
            $result = $this->call_api ( $url , $method , $user_data );
        }
        echo json_encode($result);
    }


	public function get_percentage_w_tab()
    {
        $this->is_exists_user_logged();
        
		$ses_applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];
        $ses_applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];
        $applicant_personal_det_id = $this->input->get('applicant_personal_det_id');

        $applicant_id = ($applicant_personal_det_id)?$applicant_personal_det_id:$ses_applicant_id;
        //$applicant_login_id=($applicant_login_id)?$applicant_login_id:$ses_applicant_login_id;

		// Get Form ID
		$get_form_id = $this->input->get('app_form_id',true);
		$get_form_id = ($get_form_id)?$get_form_id:APP_FORM_ID_DE;

		// Get Applicant ID
		$applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);
		$applicant_appln_det_id = $applicant_appln_det['id'];


        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls['tab_w_percentage'];
        $method = 'POST';
        $userdata = $this->session_userdata();
        $user_data['userdata'] = $userdata;
		$user_data['applicant_appln_id'] = $applicant_appln_det_id;
		$user_data['applicant_personal_det_id'] = $applicant_id;
        list($result_token,$data) = $this->_check_token($user_data);  
        if($result_token['valid']=='true')
        {
            $result = $this->call_api ( $url , $method , $user_data );
        }
        echo json_encode($result);
    }	
	
	public function dde_form_preview($mode = false , $applicant_login_id = false , $applicant_personal_det_id = false) {
		$this->is_exists_user_logged();
		/*CRM ADMIN Edit form start*/
		$this->data['get_admin_session'] = $get_crmadmin_session = $this->_get_crmadmin_session();
		$this->data['mode_edit'] = $mode;
		$this->data['crm_applicant_login_id'] = $applicant_login_id;
		$this->data['crm_applicant_personal_det_id'] = $applicant_personal_det_id;
		if($this->_get_crmadmin_session() == true) {            
			$applicant_id = ($applicant_personal_det_id)?$applicant_personal_det_id:$this->ses_applicant_id;
			$applicant_login_id=($applicant_login_id)?$applicant_login_id:$this->ses_applicant_login_id;
		}else{
			$applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];
			$applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];  
		}
        /*CRM ADMIN Edit form end*/
		
		// Get Form ID
		$get_form_id = APP_FORM_ID_DE;
		// Get Applicant ID
		$applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);
				
		$applicant_appln_det_id = $applicant_appln_det['id'];		
	

		$applicant_basic_details_list = $this->_get_applicant_tables($applicant_id, 'db_func_basic_detail');
		$this->data['applicant_basic_details_list'] = $applicant_basic_details_list[0];
		
		$applicant_course_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_course_detail');
        $this->data['applicant_course_details_list'] = $applicant_course_details_list;

		$applicant_campus_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_campus_detail');
        $this->data['applicant_campus_details_list'] = $applicant_campus_details_list;
		
		$applicant_appln_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_form_id'=>$get_form_id), 'db_func_appln_detail');
        $this->data['applicant_appln_details_list'] = $applicant_appln_details_list[0];	
		
		//redirect to dashboard before appln completion
        if($applicant_appln_details_list){
            $is_allow_preview=$this->config->item('is_allow_preview');
            $application_status_id=$applicant_appln_details_list[0]['application_status_id'];
            $completedWizard=$applicant_appln_details_list[0]['wizard_id'];
            if(empty($application_status_id) || $application_status_id!=APPLICATION_IN_PROGRESS || $completedWizard < FORM_WIZARD_PAYMENT_ID && (isset($is_allow_preview) && $is_allow_preview==0)){
                // redirect(base_url());
            }
        }
        //End: redirect to dashboard before appln completion		
		
		
		$applicant_parent_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_parent_detail');
		$this->data['applicant_parent_details_list'] = $applicant_parent_details_list;
		
		$applicant_address_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id),'db_func_address_detail');
		$this->data['applicant_address_details_list'] = $applicant_address_details_list[0];
		
		$applicant_schooling_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_schooling_detail');
        $this->data['applicant_schooling_list'] = $applicant_schooling_list;
		
		$applicant_graduations_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_grad_detail');
        $this->data['applicant_graduations_list'] = $applicant_graduations_list[0];
		
		$applicant_prof_exps_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_exp_detail');
        $this->data['applicant_prof_exps_list'] = $applicant_prof_exps_list;
		
		$applicant_other_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_other_detail');
        $this->data['applicant_other_details_list'] = $applicant_other_details_list[0];
		
		$payment_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_payment_detail');
		$this->data['payment_details_list'] = $payment_details_list[0];
		
		$this->data['get_second_lang'] = $this->_get_second_lang('learn_second_lang',$applicant_id)[0];
			
		$this->data['get_grad_inst_name'] = $this->_get_second_lang('grad_univ',$applicant_id,$applicant_appln_det_id)[0];

		$api_urls = $this->config->item ( 'api_urls' );
		$url = $api_urls[ 'upload_filelist' ];
		$url .= '/?fk_id='.$applicant_id.'&fk1_id='.$get_form_id;
		$method = 'GET';
		$userdata = $this->user_details_data;
		$data['userdata'] = $userdata;
		list($result_token,$data) = $this->_check_token($data);
		if($result_token['valid']=='true')
		{
			$result = $this->call_api ( $url , $method , $data );
		}
		
		$upload_filelist = $result['data'];
		$this->data['upload_filelist'] = $upload_filelist;	

		$this->data['form_wizard'] = true;
		$this->data['sidebar'] = 'icon';
		$this->data['logged_applicant_id']=$applicant_id;
		$this->data['logged_applicant_login_id']=$applicant_login_id;
		$this->data['user_data'] = $this->user_details_data['user_details']['data'][0];
		$this->data['personal_detail_list'] = $this->personal_detail_list($applicant_id);
		$this->data['site_title'] = $this->data['page_title'] = 'Distance Education Form Preview';

        // Display page with the template function from REST_Controller
        $this->template('applications/dis_edu_form_preview', $this->data, true);
    }	
	
	public function payment_process(){
		$this->is_exists_user_logged();
		$applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];   
		$applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];
		// Get Form ID
		$get_form_id = APP_FORM_ID_DE;
		$MERCHANT_KEY = "gtKFFx"; 
		// Get Applicant ID
		$applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);
		$applicant_appln_det_id = $applicant_appln_det['id'];		
		$applicant_basic_details_list = $this->_get_applicant_tables($applicant_id, 'db_func_basic_detail');
		$this->data['applicant_basic_details_list'] = $applicant_basic_details_list[0];
		$this->data['amount'] = 1;
		
		if($this->input->post('pay_submit')){
			$hash_string = '';
			
			$SALT = "eCwWELxi";

			// End point - change to https://secure.payu.in for LIVE mode
			$PAYU_BASE_URL = "https://test.payu.in";

			$action = '';
			
			$data = $this->input->post();
			$posted = array();
			if(!empty($data)) {
				foreach($data as $key => $value) {    
					$posted[$key] = $value; 
				}
			}

			$formError = 0;

			if(empty($posted['txnid'])) {
			   // Generate random transaction id
			  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
			} else {
			  $txnid = $posted['txnid'];
			}
			

			$hash = '';
			// Hash Sequence
			$hashSequence = "key|txnid|amount|productinfo|firstname|email";
			if(empty($posted['hash']) && sizeof($posted) > 0) {
			  if(empty($posted['key']) || empty($posted['txnid']) || empty($posted['amount']) || empty($posted['productinfo']) || empty($posted['firstname']) || empty($posted['email'])) {
				$formError = 1;
			  } else {
				$hashVarsSeq = explode('|', $hashSequence);
					foreach($hashVarsSeq as $hash_var) {
					  $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
					  $hash_string .= '|';
					}

					$hash_string .= $SALT;
					$hash = strtolower(hash('sha512', $hash_string))." =";
					$action = $PAYU_BASE_URL . '/_payment';
				}
			} elseif(!empty($posted['hash'])) {
			  $hash = $posted['hash'];
			  $action = $PAYU_BASE_URL . '/_payment';
			}
	
			$this->data['action'] = $action;
			$this->data['hash'] = $hash;
			$this->data['product_info'] = "Online Application Form 2020";
			$this->data['MERCHANT_KEY'] = $MERCHANT_KEY;
			$this->template('payment/payuform', $this->data, true);
		}else{
			$this->data['product_info'] = "Online Application Form 2020";
			$this->data['MERCHANT_KEY'] = $MERCHANT_KEY;
			// Display page with the template function from REST_Controller
			$this->template('payment/payuform', $this->data, true);
		}
	}
}
