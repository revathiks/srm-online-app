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

class Fellowship extends FrontendController
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
        if($mode)
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
	
    public function fellowship_form($mode = false , $applicant_login_id = false , $applicant_personal_det_id = false) {
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
		$get_form_id = APP_FORM_ID_FELLOWSHIP;
		// Get Applicant ID
		$applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id,$mode);
		// Get ID
		$applicant_appln_det_id = $applicant_appln_det['id'];
		
		if ( $this->input->post () ){	
			// Get API URI from config
			$api_urls = $this->config->item ( 'api_urls' );			
			$user_data = $this->input->post();			
			// Track the application created , updated by
			$user_data['created_by']=$created_updated_by;
            $user_data['updated_by']=$created_updated_by;			
			// Basic details
			if($user_data['currentIndex']==0){
				$url = $api_urls['basic_details_fellowship'];
				// Method Type
				$method = 'POST';
				$userdata = $this->user_details_data;
				$user_data['userdata'] = $userdata;
				$user_data['applicant_personal_det_id'] = $applicant_id;
				$user_data['qualifyingexamfromindia'] = $user_data['studied_in_india'];
				$user_data['is_agree'] = $user_data['i_confirm'];
				$user_data['appln_status'] = $user_data['appln_status'];
				list($result_token,$data) = $this->_check_token($user_data); 
				if($result_token['valid']=='true')
                {
                    $result = $this->call_api ( $url , $method , $data );
                }	
                $response = array();
                $response['basic_details_fellowship'] = $result;
                $return = $this->json_return($response);
                return $return;				
			}
			
			// Preferences & Personal Detail
			if($user_data['currentIndex']==1){
				$url = $api_urls['personal_detail_fellowship'];
				// Method Type
				$method = 'POST';
				$userdata = $this->user_details_data;
				$user_data['userdata'] = $userdata;
				$user_data['choice_no'] = 1;
				$user_data['applicant_personal_det_id'] = $applicant_id;
				$user_data['campus_id'] = $user_data['pd_campus'];
				$user_data['course_id'] = $user_data['pd_course_preference'];
				$user_data['choice_no'] = $user_data['choice_no'];
				
				// Personal Details Data Post
				$user_data['gender_title_id'] = $user_data['pd_title'];
				$user_data['first_name'] = $user_data['pd_firstname'];
				$user_data['middle_name'] = $user_data['pd_middlename'];
				$user_data['last_name'] = $user_data['pd_lastname'];
				$user_data['phone_no_code'] = $user_data['phone_no_code'];
				$mobile_no_concate_code = $user_data['pd_mobile_no'];
				$user_data['mobile_no'] = $mobile_no_concate_code;
				$user_data['email_id'] = $user_data['pd_email'];
				$user_data['dob'] = date("Y-m-d",strtotime($user_data['pd_dob']));
				$user_data['gender_id'] = $user_data['pd_gender'];
				$user_data['alt_email'] = $user_data['pd_alt_email'];
				$user_data['blood_group_id'] = $user_data['pd_blood_group'];
				$user_data['religion_id'] = ($user_data['pd_religion']=='')?null:$user_data['pd_religion'];
				
				$user_data['mother_tongue_id'] = ($user_data['pd_mother_tongue']=='')?null:$user_data['pd_mother_tongue'];
				$user_data['medofinst_id'] = ($user_data['pd_medium_of_instruction']=='')?null:$user_data['pd_medium_of_instruction'];
				$user_data['hostel_accomadation_id'] = ($user_data['pd_hostel_accommodation']=='')?null:$user_data['pd_hostel_accommodation'];
				$user_data['diffrently_abled_id'] = $user_data['pd_diffrently_abled'];
				$user_data['admission_adv_id'] = ($user_data['pd_advertisement_source']=='')?null:$user_data['pd_advertisement_source'];;
				$user_data['nationality_id'] = $user_data['pd_nationality'];
				$user_data['social_status_id'] = $user_data['pd_social_status'];
				
				
				list($result_token,$data) = $this->_check_token($user_data); 
				if($result_token['valid']=='true')
                {
                    $result = $this->call_api ( $url , $method , $data );
                }	
                $response = array();
                $response['personal_detail_bsc'] = $result;
                $return = $this->json_return($response);
                return $return;				
			}
			
			if($user_data['currentIndex']==2)
            {
                $user_data['applicant_personal_det_id'] = $applicant_id;
                // Father Detail
                $user_data['parent_type_father_id'] = PARENT_TYPE_ID_FATHER;
                $user_data['father_parent_det_id'] = $user_data['pd_father_id'];
                $user_data['parent_father_name'] = $user_data['pd_father_name'];
                $user_data['father_mobile_no'] = $user_data['pd_father_phone'];
                $user_data['father_alt_mobile_no'] = $user_data['pd_father_alt_phone'];
                $user_data['father_email_id'] = $user_data['pd_father_email'];
                $user_data['father_occupation'] = $user_data['pd_father_occupation'];
                $user_data['father_mob_country_code_id'] = $user_data['pd_father_phone_no_code'];
                $user_data['father_alt_mob_country_code_id'] = $user_data['pd_father_alt_phone_no_code'];
                $user_data['father_title'] = $user_data['pd_father_title'];
				$user_dat['other_occupation_father'] = $user_data['other_occupation_father'];
                
                // Mother Detail
                $user_data['parent_type_mother_id'] = PARENT_TYPE_ID_MOTHER;
                $user_data['mother_parent_det_id'] = $user_data['pd_mother_id'];
                $user_data['parent_mother_name'] = $user_data['pd_mother_name'];
                $user_data['mother_mobile_no'] = $user_data['pd_mother_phone'];
				$user_data['mother_alt_mobile_no'] = ($user_data['pd_father_alt_phone']=='undefined')?'':$user_data['pd_mother_alt_phone'];
                $user_data['mother_email_id'] = $user_data['pd_mother_email'];
                $user_data['mother_occupation'] = $user_data['pd_mother_occupation'];
                $user_data['mother_mob_country_code_id'] = $user_data['pd_mother_phone_no_code'];
                $user_data['mother_alt_mob_country_code_id'] = $user_data['pd_mother_alt_phone_no_code'];
                $user_data['mother_title'] = $user_data['pd_mother_title'];
				$user_dat['other_occupation_mother'] = $user_data['other_occupation_mother'];
                
                // Guardian Detail
                $user_data['parent_type_guardian_id'] = PARENT_TYPE_ID_GUARDIAN;
                $user_data['add_guardian_details'] = $user_data['add_guardian_checkbox'];
                $user_data['guardian_parent_det_id'] = $user_data['pd_guardian_id'];
                $user_data['parent_guardian_name'] = $user_data['pd_guardian_name'];
                $user_data['guardian_mob_country_code_id'] = $user_data['pd_guardian_phone_no_code'];
                $user_data['guardian_alt_mob_country_code_id'] = $user_data['pd_guardian_alt_phone_no_code'];
                $user_data['guardian_mobile_no'] = $user_data['pd_guardian_phone'];
                $user_data['guardian_alt_mobile_no'] = $user_data['pd_guardian_alt_phone'];
                $user_data['guardian_email_id'] = $user_data['pd_guardian_email'];
                $user_data['guardian_occupation'] = $user_data['pd_guardian_occupation'];
				$user_dat['other_occupation_guardian'] = $user_data['other_occupation_guardian'];

                // Parent detail
                $api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls[ 'fellowship_parent_detail' ];
                $method = 'POST';
				$userdata = $this->user_details_data;
				$user_data['userdata'] = $userdata;
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['applicant_login_id'] = $applicant_login_id;
                list($result_token,$data) = $this->_check_token($user_data);  
                $parent_response = false;
                if($result_token['valid']=='true')
                {
                    $result = $this->call_api ( $url , $method , $data );
                    $parent_response = $result;
                }
                $response['parent_response'] = $parent_response;
                $return = $this->json_return($response);
                return $return;
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
					$address_response = $this->call_api ( $url , $method , $user_data );
					$response['address_response'] = $address_response;
					$return = $this->json_return($response);
					return $return;
					//return $response;
					//print_r($result);
					//die;
                }
            }			

			if($user_data['currentIndex']==4){
				$api_urls = $this->config->item ( 'api_urls' );
				$url = $api_urls[ 'fellowship_academic_detail' ];
				$method = 'POST';
				$userdata = $this->user_details_data;
				$user_data['userdata'] = $userdata;
				$user_data['applicant_personal_det_id'] = $applicant_id;
				$user_data['applicant_appln_det_id'] = $applicant_appln_det_id;
				$user_data['curr_edu_quali_status'] = $user_data['current_qualification_status'];
				$user_data['name_as_in_marksheet'] = $user_data['candidate_name'];
				
				// Tenth Academic
				$user_data['tenth_institute_name'] = $user_data['academic_tenth_inst'];
				$user_data['tenth_board_id'] = $user_data['academic_tenth_board'];
				$user_data['tenth_msc_id'] = $user_data['academic_tenth_msv'];
				$user_data['tenth_cgpa'] = $user_data['academic_tenth_cgpa'];
				$user_data['tenth_yop'] = $user_data['academic_tenth_yrp'];
				$user_data['tenth_rollno'] = $user_data['academic_tenth_regno'];
				//$user_data['scholling_id_tenth'] = SCHOOLING_ID_TENTH;
				$user_data['academic_board_other'] = $user_data['academic_board_other'];;
				
				// Twelfth Academic
				$user_data['twelfth_institute_name'] = $user_data['academic_twelfth_inst'];
				$user_data['twelfth_board_id'] = $user_data['academic_twelfth_board'];
				$user_data['twelfth_msc_id'] = ($user_data['academic_twelfth_msv']=='null')?'':$user_data['academic_twelfth_msv'];
				$user_data['twelfth_cgpa'] = $user_data['academic_twelfth_cgpa'];
				$user_data['twelfth_yop'] = $user_data['academic_twelfth_yrp'];
				$user_data['twelfth_rollno'] = $user_data['academic_twelfth_regno'];
				
				// Graduation
				$user_data['academic_graduation_inst'] = $user_data['academic_graduation_inst'];
				$user_data['academic_graduation_board'] = $user_data['academic_graduation_board'];
				$user_data['academic_marking_scheme_graduation'] = ($user_data['academic_marking_scheme_graduation']=='null')?'':$user_data['academic_marking_scheme_graduation'];
				$user_data['academic_obtain_cgpa_graduation'] = $user_data['academic_obtain_cgpa_graduation'];
				$user_data['academic_yr_passing_graduation'] = $user_data['academic_yr_passing_graduation'];
				$user_data['academic_reg_no_graduation'] = $user_data['academic_reg_no_graduation'];
				$user_data['is_graduation'] = $user_data['is_graduation'];
				$user_data['other_board_graduation'] = $user_data['other_board_graduation'];

				$user_data['academic_pg_graduation_inst'] = $user_data['academic_pg_graduation_inst'];
				$user_data['academic_pg_graduation_board'] = $user_data['academic_pg_graduation_board'];
				$user_data['academic_marking_scheme_pg_graduation'] = ($user_data['academic_marking_scheme_pg_graduation']=='null')?'':$user_data['academic_marking_scheme_pg_graduation'];
				$user_data['academic_obtain_cgpa_pg_graduation'] = $user_data['academic_obtain_cgpa_pg_graduation'];
				$user_data['academic_yr_passing_pg_graduation'] = $user_data['academic_yr_passing_pg_graduation'];
				$user_data['academic_reg_no_pg_graduation'] = $user_data['academic_reg_no_pg_graduation'];
				$user_data['is_pg_graduation'] = $user_data['is_pg_graduation'];
				
				$user_data['publn_det_ids'][] = $user_data['publn_det_id_0'];
                $user_data['journal_conf_names'][] = $user_data['name_of_the_program_0'];
                $user_data['years'][] = $user_data['program_cy_0'];
                $user_data['publn_det_ids'][] = $user_data['publn_det_id_1'];
                $user_data['journal_conf_names'][] = $user_data['name_of_the_program_1'];
                $user_data['years'][] = $user_data['program_cy_1'];
                $user_data['publn_det_ids'][] = $user_data['publn_det_id_2'];
                $user_data['journal_conf_names'][] = $user_data['name_of_the_program_2'];
                $user_data['years'][] = $user_data['program_cy_2'];

                $user_data['publn_det_ids'] = json_encode($user_data['publn_det_ids']);
                $user_data['journal_conf_names'] = json_encode($user_data['journal_conf_names']);
                $user_data['years'] = json_encode($user_data['years']);
				
				$user_data['other_board_pg_graduation'] = $user_data['other_board_pg_graduation'];
				
				$user_data['digilocker_id'] = $user_data['digilocker_id'];
				//$user_data['scholling_id_twelfth'] = SCHOOLING_ID_TWELFTH;
				$user_data['academic_twelfth_board_other'] = $user_data['academic_twelfth_board_other'];
				
				list($result_token,$data) = $this->_check_token($user_data);  
				if($result_token['valid']=='true')
				{
					$result = $this->call_api ( $url , $method , $user_data );
					$return = $this->json_return($result);
					return $return;
				}
			}
			
			if($user_data['currentIndex']==6){
				$api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls[ 'declaration_fellowship' ];
                $method = 'POST';
				$userdata = $this->user_details_data;
				$user_data['userdata'] = $userdata;
				$user_data['applicant_id'] = $applicant_id;
				$user_data['applicant_appln_det_id'] = $applicant_appln_det_id;
				$user_data['applicant_name'] = $user_data['applicant_name'];
				$user_data['parent_name'] = $user_data['parent_name'];
				$user_data['ddate'] = date("Y-m-d",strtotime($user_data['ddate']));
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
			$this->data['applicant_course_details_list'] = $applicant_course_details_list;
		
			$applicant_campus_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_campus_detail');
			$this->data['applicant_campus_details_list'] = $applicant_campus_details_list;			
			
			$applicant_other_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_other_detail');
            $this->data['applicant_other_details_list'] = $applicant_other_details_list;
			
            $applicant_parent_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_parent_detail');
            $this->data['applicant_parent_details_list'] = $applicant_parent_details_list;
			
			$applicant_address_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id),'db_func_address_detail');
			$this->data['applicant_address_details_list'] = $applicant_address_details_list;
			
			$applicant_schooling_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_schooling_detail');
			$this->data['applicant_schooling_list'] = $applicant_schooling_list;
			
			$applicant_appln_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_form_id'=>$get_form_id), 'db_func_appln_detail');
			$this->data['applicant_appln_details_list'] = $applicant_appln_details_list;
			//redirect to dashboard after appln completion
			if($applicant_appln_details_list){
				$application_status_id=$applicant_appln_details_list[0]['application_status_id'];
				if(!empty($application_status_id) && $application_status_id!=APPLICATION_IN_PROGRESS && $mode == ''){
					redirect(base_url());
				}
			}
			//End: redirect to dashboard after appln completion			
			
			/*Form Index Restriction Start*/
			$wizard_dt = $this->_get_wizard_details(APP_FORM_ID_FELLOWSHIP);
			$applnform_wizard_id = $applicant_appln_details_list[0]['form_w_wizard_id'];
			$get_appln_wizard_dtl = $this->_get_appln_wizard_details($applnform_wizard_id);
			$this->data['wizard_dt']=$wizard_dt;
			$this->data['appln_wizard_dt']=$get_appln_wizard_dtl;
			/*Form Index Restriction End*/
			
			$applicant_graduations_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_grad_detail');
            $this->data['applicant_graduations_list'] = $applicant_graduations_list;
			
			$payment_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_payment_detail');
			$this->data['payment_details_list'] = $payment_details_list[0];			
			
			//Get Instruction Wizard
            $arr_wizard_id = array(FORM_WIZARD_BASIC_ID,FORM_WIZARD_PERSONAL_ID,FORM_WIZARD_PARENT_ID,FORM_WIZARD_ADDRESS_ID,FORM_WIZARD_ACADEMIC_ID,FORM_WIZARD_PAYMENT_ID,FORM_WIZARD_UPLOAD_DECLARATION_ID);
            foreach($arr_wizard_id as $k=>$v) {
                $applicant_instructions_list = $this->_get_applicant_tables(array('appln_form_id'=>$get_form_id,'wizard_id'=>$v), 'db_func_instruction');
                $this->data['applicant_instructions_list'][$v] = $applicant_instructions_list;      
            }	
			
			$form_title = SRM_FELLOWSHIP;
			$this->data['user_data'] = $this->user_details_data['user_details']['data'][0];
			$this->data['personal_detail_list'] = $this->personal_detail_list($applicant_id);	
			$this->data['site_title'] = $this->data['page_title'] = $form_title." ".date('Y');
			$this->template('applications/form_fellowship', $this->data, true);  
		}        
    }
	
	// Get Campus Preferences Of Fellowship
	public function get_fellowship_campus_preference()
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
        $url = $api_urls['db_func_call_fellowship_campus'];
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
	
	// Get Course Preferences Of Fellowship
	public function get_fellowship_course_preference()
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
        $url = $api_urls['db_func_call_fellowship_course'];
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
	
	// Fellowship Form Preview
	public function fellowship_form_preview($mode = false , $applicant_login_id = false , $applicant_personal_det_id = false) {
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
		$get_form_id = APP_FORM_ID_FELLOWSHIP;
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
        $this->data['applicant_appln_details_list'] = $applicant_appln_details_list;	
		
		//redirect to dashboard before appln completion
        if($applicant_appln_details_list){
            $is_allow_preview=$this->config->item('is_allow_preview');
            $application_status_id=$applicant_appln_details_list[0]['application_status_id'];
            $completedWizard=$applicant_appln_details_list[0]['wizard_id'];
            if(empty($application_status_id) || $application_status_id!=APPLICATION_IN_PROGRESS || $completedWizard < FORM_WIZARD_PAYMENT_ID && (isset($is_allow_preview) && $is_allow_preview==0)){
                //redirect(base_url());
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
        $this->data['applicant_graduations_list'] = $applicant_graduations_list;
		
		$applicant_prof_exps_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_exp_detail');
        $this->data['applicant_prof_exps_list'] = $applicant_prof_exps_list;
		
		$applicant_other_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_other_detail');
        $this->data['applicant_other_details_list'] = $applicant_other_details_list[0];
		
		$payment_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_payment_detail');
		$this->data['applicant_payment_details_list'] = $payment_details_list[0];

		$api_urls = $this->config->item ( 'api_urls' );
		$url = $api_urls[ 'upload_filelist' ];
		$url .= '/?fk_id='.$applicant_id.'&fk1_id='.$get_form_id;
		$method = 'GET';
		$userdata = $this->session_userdata();
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
		$this->data['site_title'] = $this->data['page_title'] = 'SRM Fellowship Program Preview';

        // Display page with the template function from REST_Controller
        $this->template('applications/form_fellowship_preview', $this->data, true);
    }	
}