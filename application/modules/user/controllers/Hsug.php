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

class Hsug extends FrontendController
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
        parent::__construct();
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
        $CI =& get_instance();
        $this->load->helper('cookie');
		$this->application_year = date("Y");
    }
    public function hsug_form($mode = false , $applicant_login_id = false , $applicant_personal_det_id = false) {
        
		// Check the condition & User logged or not
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
        $get_form_id = APP_FORM_ID_HSUG;
        
		// Get Applicant ID
        $applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);
        $applicant_appln_id  = $applicant_appln_det['id'];
        
        if ( $this->input->post () ){
            
			$user_data = $this->input->post();
			// Track the application created , updated by
			$user_data['created_by']=$created_updated_by;
            $user_data['updated_by']=$created_updated_by;			
            $api_urls  = $this->config->item ( 'api_urls' );
           
		    // Method Type
            $method = 'POST';
            
			//set form id app_form_id
            $user_data['app_form_id'] = APP_FORM_ID_HSUG;
            $app_form_id              = APP_FORM_ID_HSUG;
            $userdata				  = $this->user_details_data;
            $user_data['userdata'] 	  = $userdata;
			
            // Basic Details Start
            if($user_data['currentIndex']==0){
                
				// Basic Details API & Method
                $url = $api_urls[ 'hsug_basic_detail' ];
				
                // Get Personal Applicant ID
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['qualifyingexamfromindia']   = $user_data['studied_from_india'];
                $user_data['is_agree']                  = $user_data['i_confirm'];
				$user_data['appln_status']			    = $user_data['appln_status'];
                $user_data['applicant_appln_id']        = !empty($applicant_appln_id) ? $applicant_appln_id :$user_data['applicant_appln_id'];
				
                $user_data['user_details_data'] = $this->user_details_data['user_details']['data'][0];
				list($result_token,$data)       = $this->_check_token($user_data);
                //echo "===>".$result_token['valid']; exit;
				if($result_token['valid']=='true')
                {
                    // Call API
                    $data = $this->call_api($url,$method,$user_data);
                    $return = $this->json_return($data);
                    return $return;
                }
            }
            //basic detail end
            
            //course and personal detail
            
            if($user_data['currentIndex']==1){
                
				// Personal Details API & Method
                $url = $api_urls[ 'hsug_personal_detail' ];
				
                // Get Personal ApplicaNT ID
                $user_data['applicant_personal_det_id'] = $applicant_id;
                // $user_data['course_prefer_id'] = 1;
                $user_data['course_pref'][0] = is_numeric($user_data['course_pref_1'])?$user_data['course_pref_1'] : NULL;
                $user_data['course_choice_no'][0] = $user_data['course_choice_no_1'];
                $user_data['course_prefer_id'][0] = $user_data['course_prefer_id_1'];
                
                $user_data['course_pref'][1] = is_numeric($user_data['course_pref_2']) ? $user_data['course_pref_2'] : NULL;
                $user_data['course_choice_no'][1] = $user_data['course_choice_no_2'];
                $user_data['course_prefer_id'][1] = $user_data['course_prefer_id_2'];
                
                $user_data['course_pref'][2] = is_numeric($user_data['course_pref_3']) ? $user_data['course_pref_3'] : NULL;
                $user_data['course_choice_no'][2] = $user_data['course_choice_no_3'];
                $user_data['course_prefer_id'][2] = $user_data['course_prefer_id_3'];
                
                $user_data['course_pref'] = json_encode($user_data['course_pref']);
                $user_data['course_choice_no'] = json_encode($user_data['course_choice_no']);
                $user_data['course_prefer_id'] = json_encode($user_data['course_prefer_id']);
                
                
                $user_data['campus_pref'][] = is_numeric($user_data['campus_pref_1']) ? $user_data['campus_pref_1'] : NULL;
                $user_data['campus_choice_no'][] = $user_data['campus_choice_no_1'];
                $user_data['campus_prefer_id'][] = $user_data['campus_prefer_id_1'];
                
                /*
				$user_data['campus_pref'][] = is_numeric($user_data['campus_pref_2'])?$user_data['campus_pref_2']:NULL;
                $user_data['campus_choice_no'][] = $user_data['campus_choice_no_2'];
                $user_data['campus_prefer_id'][] = $user_data['campus_prefer_id_2'];
                
                $user_data['campus_pref'][] = is_numeric($user_data['campus_pref_3']) ? $user_data['campus_pref_3'] : NULL;
                $user_data['campus_choice_no'][] = $user_data['campus_choice_no_3'];
                $user_data['campus_prefer_id'][] = $user_data['campus_prefer_id_3'];
				*/
                
                $user_data['campus_pref'] = json_encode($user_data['campus_pref']);
                $user_data['campus_choice_no'] = json_encode($user_data['campus_choice_no']);
                $user_data['campus_prefer_id'] = json_encode($user_data['campus_prefer_id']);
                
                $user_data['state_pref'][0] = is_numeric($user_data['state_pref_1']) ? $user_data['state_pref_1'] : NULL;
                $user_data['city_pref'][0] = is_numeric($user_data['city_pref_1']) ? $user_data['city_pref_1'] : NULL;
                $user_data['city_choice_no'][0] = $user_data['city_choice_no_1'];
                $user_data['city_prefer_id'][0] = $user_data['city_prefer_id_1'];
                
                $user_data['state_pref'][1] = is_numeric($user_data['state_pref_2']) ? $user_data['state_pref_2'] : NULL;
                $user_data['city_pref'][1] = is_numeric($user_data['city_pref_2']) ? $user_data['city_pref_2'] : NULL;
                $user_data['city_choice_no'][1] = $user_data['city_choice_no_2'];
                $user_data['city_prefer_id'][1] = $user_data['city_prefer_id_2'];
				
				$user_data['state_pref'][2] = is_numeric($user_data['state_pref_3']) ? $user_data['state_pref_3'] : NULL;
                $user_data['city_pref'][2] = is_numeric($user_data['city_pref_3']) ? $user_data['city_pref_3'] : NULL;
                $user_data['city_choice_no'][2] = $user_data['city_choice_no_3'];
                $user_data['city_prefer_id'][2] = $user_data['city_prefer_id_3'];
                
                
                $user_data['state_pref'] = json_encode($user_data['state_pref']);
                $user_data['city_pref'] = json_encode($user_data['city_pref']);
                $user_data['city_choice_no'] = json_encode($user_data['city_choice_no']);
                $user_data['city_prefer_id'] = json_encode($user_data['city_prefer_id']);
                
                
                $user_data['title_id'] = ($user_data['pd_title']=='') ? null :$user_data['pd_title'];
                $user_data['first_name'] = $user_data['pd_firstname'];
                $user_data['middle_name'] = $user_data['pd_middlename'];
                $user_data['last_name'] = $user_data['pd_lastname'];
                $mobile_no_concate_code = $user_data['pd_mobile_no'];
                $user_data['mobile_no'] = $mobile_no_concate_code;
                $user_data['phone_no_code'] = $user_data['phone_no_code'];
                $user_data['email_id'] = $user_data['pd_email'];
                if(!empty($user_data['pd_dob'])){
                    $dob=$this->convertDate($user_data['pd_dob']);
                    $user_data['dob'] = $dob;
                }else{
                    $user_data['pd_dob'] = date("Y-m-d",strtotime($user_data['pd_dob']));
                }
                $user_data['gender_id'] = ($user_data['pd_gender']=='') ? null :$user_data['pd_gender'];
                $user_data['second_email_id'] = $user_data['pd_alt_email'];
                $user_data['blood_grp_id'] = $user_data['pd_blood_group'];
                $user_data['social_status_id'] = ($user_data['pd_social_status']=='') ? null : $user_data['pd_social_status'];
                $user_data['nationality_id'] = ($user_data['pd_nationality']=='')? null : $user_data['pd_nationality'];
                $user_data['diff_abled'] = ($user_data['pd_diffrently_abled']=='')? null : $user_data['pd_diffrently_abled'];
                $user_data['religion_id'] = ($user_data['pd_religion']=='')? null : $user_data['pd_religion'];
                $user_data['medofinst'] = ($user_data['pd_medium_of_instruction']=='') ? null : $user_data['pd_medium_of_instruction'];
                $user_data['prefer_hostel'] = ($user_data['pd_hostel_accommodation']=='') ? null : $user_data['pd_hostel_accommodation'];
                $user_data['mother_tongue_id'] = ($user_data['pd_mother_tongue']=='') ? null : $user_data['pd_mother_tongue'];
                $user_data['advertisement_source_id'] = ($user_data['pd_advertisment_source']=='') ? null : $user_data['pd_advertisment_source'];
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
            //course and personal detail end
            
            //parent start
            if($user_data['currentIndex']==2){
                $url = $api_urls[ 'hsug_parent_detail' ];
                
                // Get Personal ApplicaNT ID
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['applicant_id'] = $applicant_id;
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
                
                // Mother Detail
                $user_data['parent_type_mother_id'] = PARENT_TYPE_ID_MOTHER;
                $user_data['mother_parent_det_id'] = $user_data['pd_mother_id'];
                $user_data['parent_mother_name'] = $user_data['pd_mother_name'];
                $user_data['mother_mobile_no'] = $user_data['pd_mother_phone'];
                $user_data['mother_alt_mobile_no'] = $user_data['pd_mother_alt_phone'];
                $user_data['mother_email_id'] = $user_data['pd_mother_email'];
                $user_data['mother_occupation'] = $user_data['pd_mother_occupation'];
                $user_data['mother_mob_country_code_id'] = $user_data['pd_mother_phone_no_code'];
                $user_data['mother_alt_mob_country_code_id'] = $user_data['pd_mother_alt_phone_no_code'];
                $user_data['mother_title'] = $user_data['pd_mother_title'];
                
                // Guardian Detail
                $user_data['parent_type_guardian_id'] = PARENT_TYPE_ID_GUARDIAN;
                $user_data['add_guardian_details'] = $user_data['add_guardian_checkbox'];
                $user_data['guardian_parent_det_id'] = $user_data['pd_guardian_id'];
                $user_data['parent_guardian_name'] = $user_data['pd_guardian_name'];
                $user_data['guardian_mob_country_code_id'] = $user_data['pd_guardian_phone_no_code'];
                $user_data['guardian_mobile_no'] = $user_data['pd_guardian_phone'];
                $user_data['guardian_alt_mob_country_code_id'] = $user_data['pd_guardian_alt_phone_no_code'];
                $user_data['guardian_email_id'] = $user_data['pd_guardian_email'];
                $user_data['guardian_occupation'] = $user_data['pd_guardian_occupation'];
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
            //parent end
            
            //address start
            if($user_data['currentIndex']==3)
            {
                $api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls[ 'hsug_addressdet' ];
                $method = 'POST';
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['applicant_login_id'] = $applicant_login_id;
                $user_data['app_form_id'] = $app_form_id;
                list($result_token,$data) = $this->_check_token($user_data);
                if($result_token['valid']=='true')
                {
                    // Call API
                    $data = $this->call_api($url,$method,$user_data);
                    $return = $this->json_return($data);
                    return $return;
                }
            }
            //address end
            
            // Academic Details
            if($user_data['currentIndex']==4){     
				/*Schooling Details*/
                $academic_data['applicant_personal_det_id'] = $applicant_id;
                $current_education_qual_status 				= $user_data['current_education_qual_status'];
                $academic_data['cur_qual_completed'] 		= ($current_education_qual_status==1)?'f':'t';               
                $academic_data['is_curr_qualify'] 			= ($current_education_qual_status==1)?'f':'t';               
                $academic_data['name_in_marksheet'] 		= $user_data['canditate_name'];               
                $academic_data['institute_name'] 			= $user_data['institute_name'];
                $academic_data['academic_board'] 			= $user_data['academic_board'];
                $academic_data['other_board_name'] 			= $user_data['other_board_name'];
                $academic_data['registration_no'] 			= $user_data['registration_no'];
                $academic_data['mode_of_study_id'] 			= $user_data['mode_of_study'];
				$academic_data['completion_year'] 			= $user_data['completion_year'];
				$academic_data['other_board_name'] 			= $user_data['other_board_name'];
				$academic_data['address_school_college']    = $user_data['address_school_college'];
				
                if($current_education_qual_status == 2) {
                    $academic_data['mark_scheme_id'] = $user_data['marking_scheme'];
                    $academic_data['mark_percentage'] 	 = $user_data['obtained_percentage_cgpa'];
                }
				
				$academic_data['mark_scheme_id']  = $user_data['marking_scheme'];
                $academic_data['mark_percentage'] 	  = $user_data['obtained_percentage_cgpa'];				
                $academic_data['completion_year'] = $user_data['year_of_passing'];              
                $academic_data['digilocker_id']   = $user_data['nad_id_digilocker_id'];
				$academic_data['created_by']	  = $created_updated_by;
				$academic_data['updated_by']	  = $created_updated_by;	                
				
                
                $api_urls = $this->config->item ( 'api_urls' );
                $url 	  = $api_urls['hsug_academicdet'];
                $method   = 'POST';
                $userdata = $this->user_details_data;
                $academic_data['userdata'] = $userdata;
                list($result_token,$data)  = $this->_check_token($academic_data);
                if($result_token['valid']=='true')
                {
                    $result = $this->call_api ( $url , $method , $data );
                    $return = $this->json_return($result);
                    return $return;
                }
            }
            //end academics
			
            // On upload only tab update start			
			if($user_data['currentIndex']==6){
                $url = $api_urls[ 'upload_final' ];
                $method = "POST";
                // Get
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['app_form_id'] = $app_form_id;
                $user_data['upload_id'] = FORM_WIZARD_UPLOAD_ID;
                $user_data['is_notfinal'] = 1;
                $user_data['user_details_data'] = $this->user_details_data['user_details']['data'][0];
                // Call API
                $data = $this->call_api($url,$method,$user_data);                
                $return = $this->json_return($data);
                return $return;
            }
			// On upload only tab update end
            
            //declaration
            if($user_data['currentIndex']==7){
                
				$url = $api_urls[ 'hsug_declaration' ];
                
				// Get Personal Applicant ID
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['applicant_name'] = $user_data['applicant_name'];
                $user_data['parent_name'] = $user_data['parent_name'];
                
				if(!empty($user_data['declaration_date'])){
                    $declaration_date=$this->convertDate($user_data['declaration_date']);
                    $user_data['declaration_date'] = $declaration_date;
                }else{
                    $user_data['declaration_date'] = date("Y-m-d",strtotime($user_data['declaration_date']));
                }
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
            
            
        }else{
            $api_urls = $this->config->item ( 'api_urls' );
			$userdata = $this->user_details_data;
            $user_data['userdata'] = $userdata;
            /*view upload list*/
            $url = $api_urls[ 'upload_filelist' ];
            $url .= '/?fk_id='.$applicant_id.'&fk1_id='.$get_form_id;
            $method = 'GET';
            
            $data['userdata'] = $userdata;
            list($result_token,$data) = $this->_check_token($data);
            if($result_token['valid']=='true')
            {
                $result = $this->call_api ( $url , $method , $data );
            }
            $upload_filelist = $result['data'];
            $this->data['upload_filelist'] = $upload_filelist;
            //end uploads
            
            $applicantDetailArr=array(
                'applicant_personal_det_id'=>$applicant_id,
                'applicant_form_id'=>$get_form_id
            );
            //application detail
            $applicant_application_details_list = $this->_get_applicant_tables($applicantDetailArr, 'db_func_appln_detail');
            $this->data['applicant_application_details_list'] = $applicant_application_details_list;
            //redirect to dashboard after appln completion
            if($applicant_application_details_list){
                $application_status_id=$applicant_application_details_list[0]['application_status_id'];
                if(!empty($application_status_id) && $application_status_id!=APPLICATION_IN_PROGRESS && $mode == ''){
                   // redirect(base_url());
                }
            }
            //End: redirect to dashboard after appln completion
            
            /*Form Index Restriction Start*/
            $wizard_dt = $this->_get_wizard_details(APP_FORM_ID_HSUG);
            $applnform_wizard_id = $applicant_application_details_list[0]['form_w_wizard_id'];
            $get_appln_wizard_dtl = $this->_get_appln_wizard_details($applnform_wizard_id);
            $this->data['wizard_dt']=$wizard_dt;
            $this->data['appln_wizard_dt']=$get_appln_wizard_dtl;
            /*Form Index Restriction End*/
            
            //$applicant_appln_id=$applicant_application_details_list[0]['applicant_appln_id'];
            $user_applicant_app_id= isset($applicant_appln_id) ? $applicant_appln_id : '';
            if(!empty($user_applicant_app_id))
            {
                $condArr=array(
                    'applicant_personal_det_id'=>$applicant_id,
                    'applicant_appln_id'=>$user_applicant_app_id
                );
                //fetch basic  detail
                $applicant_basic_details_list = $this->_get_applicant_tables($applicant_id, 'db_func_basic_detail');
                $this->data['applicant_basic_details_list'] = $applicant_basic_details_list[0];
                
                /* applicant_other_details_list start */
                $applicant_other_details_list = $this->_get_applicant_tables($condArr, 'db_func_other_detail');
                $this->data['applicant_other_details_list'] = $applicant_other_details_list[0];
                /* applicant_other_details_list end */
                
                //course
                $applicant_course_details_list = $this->_get_applicant_tables($condArr, 'db_func_course_detail');
                $this->data['applicant_course_details_list'] = $applicant_course_details_list;
                //end course
                
                //campus
                $applicant_campus_details_list = $this->_get_applicant_tables($condArr, 'db_func_campus_detail');
                $this->data['applicant_campus_details_list'] = $applicant_campus_details_list;
                
                //end campus
                
                /* applicant_city_prefer_details_list start */
                $applicant_city_prefer_details_list = $this->_get_applicant_tables($condArr, 'db_func_city_prefer_detail');
                $this->data['applicant_city_prefer_details_list'] = $applicant_city_prefer_details_list;
                /* applicant_city_prefer_details_list end */
                
                
                //parent detal
                $applicant_parent_details_list = $this->_get_applicant_tables($condArr, 'db_func_parent_detail');
                $this->data['applicant_parent_details_list'] = $applicant_parent_details_list;
                
                /* applicant_address_details_list start */
                $applicant_address_details_list = $this->_get_applicant_tables($condArr,'db_func_address_detail');
                $this->data['applicant_address_details_list'] = $applicant_address_details_list[0];
                /* applicant_address_details_list end */
                
                /* Schooling Details Start */				
				$applicant_schooling_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_id), 'db_func_schooling_detail');
				$this->data['applicant_schooling_list'] = $applicant_schooling_list[0];		
				//echo "<pre>";print_r($this->data['applicant_schooling_list']);				
				/* Schooling Details End  */	
                
                /*
				// $applicant_graduations_list = $this->_get_applicant_tables($applicant_id, 'applicant_graduations');
                $applicant_graduations_list = $this->_get_applicant_tables($condArr, 'db_func_grad_detail');
                $this->data['applicant_graduations_list'] = $applicant_graduations_list[0];                
				
                
                // $applicant_prof_exps_list = $this->_get_applicant_tables($applicant_id, 'applicant_prof_exps');
                $applicant_prof_exps = $this->_get_applicant_tables($condArr, 'db_func_exp_detail');
                $this->data['applicant_prof_exps_list'] = $applicant_prof_exps;
               
                
                /* applicant_competitive_details_list start 
                $applicant_competitive_details = $this->_get_applicant_tables($condArr, 'db_func_competitive_detail');
                $this->data['applicant_competitive_details_list'] = $applicant_competitive_details;
                */
                
            }
            // Get Instruction Wizard
            $arr_wizard_id = array(FORM_WIZARD_BASIC_ID,FORM_WIZARD_PERSONAL_ID,FORM_WIZARD_PARENT_ID,FORM_WIZARD_ADDRESS_ID,FORM_WIZARD_ACADEMIC_ID,FORM_WIZARD_PAYMENT_ID,FORM_WIZARD_UPLOAD_ID,FORM_WIZARD_DECLARATION_ID);
            foreach($arr_wizard_id as $k=>$v) {
                $applicant_instructions_list = $this->_get_applicant_tables(array('appln_form_id'=>$get_form_id,'wizard_id'=>$v), 'db_func_instruction');
                $this->data['applicant_instructions_list'][$v] = $applicant_instructions_list;
            }
            
			$payment_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_id), 'db_func_payment_detail');
            $this->data['payment_details_list'] = $payment_details_list[0];
			
            $this->data['form_wizard'] = true;
            $this->data['sidebar'] = 'icon';
            $this->data['logged_applicant_id']=$applicant_id;
            $this->data['logged_applicant_login_id']=$applicant_login_id;
            $this->data['user_data'] = $this->user_details_data['user_details']['data'][0];
            $this->data['personal_detail_list'] = $this->personal_detail_list($applicant_id);
            $this->data['site_title'] = $this->data['page_title'] = 'Health Sciences Undergraduate Application Form';
            $this->template('applications/form_hsug', $this->data, true);
        }
        
    }
    
    public function hsug_preview($mode = false , $applicant_login_id = false , $applicant_personal_det_id = false) {
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
        $get_form_id = APP_FORM_ID_HSUG;
        // Get Applicant ID
        $applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);
        $applicant_appln_id = $applicant_appln_det['id'];
        
        $applicantDetailArr=array(
            'applicant_personal_det_id'=>$applicant_id,
            'applicant_form_id'=>$get_form_id
        );
        //application detail
        $applicant_application_details_list = $this->_get_applicant_tables($applicantDetailArr, 'db_func_appln_detail');
        $this->data['applicant_application_details_list'] = $applicant_application_details_list;
        
        //redirect to dashboard before appln completion
        if($applicant_application_details_list){
            $is_allow_preview=$this->config->item('is_allow_preview');
            $application_status_id=$applicant_application_details_list[0]['application_status_id'];
            $completedWizard=$applicant_application_details_list[0]['wizard_id'];
            if(empty($application_status_id) || $application_status_id!=APPLICATION_IN_PROGRESS || $completedWizard < FORM_WIZARD_PAYMENT_ID && (isset($is_allow_preview) && $is_allow_preview==0)){
                //redirect(base_url());
            }
        }
        //End: redirect to dashboard before appln completion
        $user_applicant_app_id= isset($applicant_appln_id) ? $applicant_appln_id : '';
        if(!empty($user_applicant_app_id))
        {
            $condArr=array(
                'applicant_personal_det_id'=>$applicant_id,
                'applicant_appln_id'=>$user_applicant_app_id
            );
            //fetch basic  detail
            $applicant_basic_details_list = $this->_get_applicant_tables($applicant_id, 'db_func_basic_detail');
            $this->data['applicant_basic_details_list'] = $applicant_basic_details_list[0];
            
            /* applicant_other_details_list start */
            $applicant_other_details_list = $this->_get_applicant_tables($condArr, 'db_func_other_detail');
            $this->data['applicant_other_details_list'] = $applicant_other_details_list[0];
            /* applicant_other_details_list end */
            
            //course
            $applicant_course_details_list = $this->_get_applicant_tables($condArr, 'db_func_course_detail');
            $this->data['applicant_course_details_list'] = $applicant_course_details_list;
            //end course
            
            //campus
            $applicant_campus_details_list = $this->_get_applicant_tables($condArr, 'db_func_campus_detail');
            $this->data['applicant_campus_details_list'] = $applicant_campus_details_list;
            
            //end campus
            
            //parent detal
            $applicant_parent_details_list = $this->_get_applicant_tables($condArr, 'db_func_parent_detail');
            $this->data['applicant_parent_details_list'] = $applicant_parent_details_list;
            
            /* applicant_address_details_list start */
            $applicant_address_details_list = $this->_get_applicant_tables($condArr,'db_func_address_detail');
            $this->data['applicant_address_details_list'] = $applicant_address_details_list[0];
            /* applicant_address_details_list end */
            
            //schooling-academic
            $applicant_schooling_list = $this->_get_applicant_tables($condArr, 'db_func_schooling_detail');
            $this->data['applicant_schooling_list'] = $applicant_schooling_list[0];
            //end schooling
           
		   /*
		    // $applicant_graduations_list = $this->_get_applicant_tables($applicant_id, 'applicant_graduations');
            $applicant_graduations_list = $this->_get_applicant_tables($condArr, 'db_func_grad_detail');
            $this->data['applicant_graduations_list'] = $applicant_graduations_list[0];
             // applicant_graduations_list end 
            
            // $applicant_prof_exps_list = $this->_get_applicant_tables($applicant_id, 'applicant_prof_exps');
            $applicant_prof_exps = $this->_get_applicant_tables($condArr, 'db_func_exp_detail');
            $this->data['applicant_prof_exps_list'] = $applicant_prof_exps;
            //applicant_prof_exps_list end		
			
            
            // applicant_competitive_details_list start
            $applicant_competitive_details = $this->_get_applicant_tables($condArr, 'db_func_competitive_detail');
            $this->data['applicant_competitive_details_list'] = $applicant_competitive_details;
            // applicant_competitive_details_list end 
			*/
            
			/* applicant_city_prefer_details_list start */
            $applicant_city_prefer_details_list = $this->_get_applicant_tables($condArr, 'db_func_city_prefer_detail');
            $this->data['applicant_city_prefer_details_list'] = $applicant_city_prefer_details_list;
            /* applicant_city_prefer_details_list end */
			
			$payment_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_id), 'db_func_payment_detail');
			$this->data['applicant_payment_details_list'] = $payment_details_list[0];
        }
        
        
        
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
        
        $this->data['stream'] = $stream;
        $this->data['form_wizard'] = true;
        $this->data['sidebar'] = 'icon';
        $this->data['logged_applicant_id']=$applicant_id;
        $this->data['logged_applicant_login_id']=$applicant_login_id;
        $this->data['user_data'] = $this->user_details_data['user_details']['data'][0];
        $this->data['personal_detail_list'] = $this->personal_detail_list($applicant_id);
        $this->data['site_title'] = $this->data['page_title'] = 'Health Sciences Undergraduate Application Form';
        /* applicant_address_details_list end */
        
        // Display page with the template function from REST_Controller
        $this->template('applications/form_hsug_preview', $this->data, true);
    }

}