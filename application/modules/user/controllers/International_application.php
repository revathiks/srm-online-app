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

class International_application extends FrontendController
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
        //
        parent::__construct();
        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $CI =& get_instance();
        $this->load->helper('cookie');
		$this->applicatison_year = date("Y");
		//$this->user_details_data = $this->session->userdata('international_user_details_data');
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
        $this->user_details_data = $this->session->userdata('international_user_details_data');        

        $this->ses_applicant_login_id = $this->user_details_data['user_details']['data'][0]['applicant_login_id'];
        $this->ses_applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];

        }
        /*CRM ADMIN Edit form end*/
    }

    
    
    public function international_form($mode = false , $applicant_login_id = false , $applicant_personal_det_id = false)
    {
        $this->is_exists_international_user_logged();
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
        $created_updated_by=($mode)?CRM_ADMIN_USER_ROLE_ID:$applicant_id;
		
        $form_id = APP_FORM_ID_INTERNATIONAL;
		// Get Applicant ID
		$applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$form_id);

		// Get Applicant APPLN ID		
		$applicant_appln_det_id = $applicant_appln_det['id'];	
		
        if ( $this->input->post () )
        {
            $user_data = $this->input->post();
            $api_urls = $this->config->item ( 'api_urls' );  

            $user_data['created_by']=$created_updated_by;
            $user_data['updated_by']=$created_updated_by;

            /*Basic Details Start*/
            if($user_data['currentIndex']==0)
            {
                
                $url = $api_urls['international_basic_detail'];
                $method = 'POST';
                
                //$userdata = $this->session_internationaluserdata();
                $userdata = $this->user_details_data;                
                $user_data['userdata'] = $userdata;
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['applicant_login_id'] = $applicant_login_id;
                $user_data['appln_form_id'] = $form_id;
                list($result_token,$data) = $this->_check_token($user_data);  
                if($result_token['valid']=='true')
                {
                    $result = $this->call_api ( $url , $method , $data );
                    $response = array("status"=>$result['status'],"message"=> $result['message']);
                    $return = $this->json_return($response);
                    return $return; 
                    //print_r($result);
                    //die;
                }
            }  

            /*Personal Details Start*/
            if($user_data['currentIndex']==1)
            {
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['mobile_no_code'] = $user_data['phone_no_code'];
                $user_data['program_level'] = $user_data['program_level'];

               
                $user_data['course_pref_id'][0] = $user_data['course_prefer_id_1']; 
                $user_data['course_choice_no'][0] = $user_data['course_choice_no_1'];
                $user_data['stream_pref'][0] = $user_data['stream_id_pref1'];
                $user_data['deg_pref'][0] = $user_data['deg_id_pref1'];
                $user_data['course_pref'][0] = $user_data['course_id_pref1'];
                $user_data['spec_pref'][0] = $user_data['spec_id_pref1'];

                $user_data['course_pref_id'][1] = $user_data['course_prefer_id_2'];
                $user_data['course_choice_no'][1] = $user_data['course_choice_no_2'];
                $user_data['stream_pref'][1] = $user_data['stream_id_pref2'];
                $user_data['deg_pref'][1] = $user_data['deg_id_pref2'];
                $user_data['course_pref'][1] = $user_data['course_id_pref2'];
                $user_data['spec_pref'][1] = $user_data['spec_id_pref2'];

                $user_data['course_pref_id'][2] = $user_data['course_prefer_id_3'];
                $user_data['course_choice_no'][2] = $user_data['course_choice_no_3'];
                $user_data['stream_pref'][2] = $user_data['stream_id_pref3'];
                $user_data['deg_pref'][2] = $user_data['deg_id_pref3'];
                $user_data['course_pref'][2] = $user_data['course_id_pref3'];
                $user_data['spec_pref'][2] = $user_data['spec_id_pref3'];

                $user_data['course_pref'] = json_encode($user_data['course_pref']);
                $user_data['course_choice_no'] = json_encode($user_data['course_choice_no']);
                $user_data['course_prefer_id'] = json_encode($user_data['course_pref_id']);
                $user_data['stream_pref'] = json_encode($user_data['stream_pref']);
                $user_data['deg_pref'] = json_encode($user_data['deg_pref']);
                $user_data['spec_pref'] = json_encode($user_data['spec_pref']);
                

                if(!empty($user_data['pd_dob'])){
                    $dob=$this->convertDate($user_data['pd_dob']);
                    $user_data['dob'] = $dob;
                }else{
                    $user_data['dob'] = date("Y-m-d",strtotime($user_data['pd_dob']));
                }  
                $url = $api_urls[ 'international_personal_detail' ];
                $user_data['user_details_data'] = $this->user_details_data['user_details']['data'][0];
                $method = 'POST'; 
                //Call API
                $data = $this->call_api($url,$method,$user_data);
                //echo json_encode($data,true);
                $return = $this->json_return($data);
                return $return;
            }

            /*Parent  Start*/
            if($user_data['currentIndex'] == 2)
            {
                // Father Detail
                $add_parent_checkbox = $user_data['add_parent_checkbox'];
                $parent_data['add_parent_checkbox'] = $add_parent_checkbox;

                if($add_parent_checkbox == true || $add_parent_checkbox == 'true') {
                $parent_data['parent_type_father_id'] = PARENT_TYPE_ID_FATHER;
                $parent_data['parent_type_mother_id'] = PARENT_TYPE_ID_MOTHER;
                $parent_data['father_parent_det_id'] = $user_data['pd_father_id'];
                $parent_data['parent_father_name'] = $user_data['pd_father_name'];
                $pd_father_phone = $user_data['pd_father_phone'];
                if($pd_father_phone != '') {
                    $parent_data['father_mobile_no'] = $pd_father_phone;    
                }               
                $pd_father_email = $user_data['pd_father_email'];
                if($pd_father_email != '') {
                    $parent_data['father_email_id'] = $pd_father_email;    
                }
                $pd_father_occupation = $user_data['pd_father_occupation'];
                if($pd_father_occupation != '') {
                    $parent_data['father_occupation'] = $pd_father_occupation;
                    $parent_data['other_occupation_father'] = $user_data['other_occupation_father'];    
                }
                $parent_data['father_mob_country_code_id'] = $user_data['pd_father_phone_no_code'];

               
                
                // Mother Detail
                
                $parent_data['mother_parent_det_id'] = $user_data['pd_mother_id'];
                $parent_data['parent_mother_name'] = $user_data['pd_mother_name'];
                $pd_mother_phone = $user_data['pd_mother_phone'];
                if($pd_mother_phone != '') {
                    $parent_data['mother_mobile_no'] = $pd_mother_phone;    
                }
                $pd_mother_email = $user_data['pd_mother_email'];
                if($pd_mother_email != '') {
                    $parent_data['mother_email_id'] = $pd_mother_email;    
                }
                $pd_mother_occupation = $user_data['pd_mother_occupation'];
                if($pd_mother_occupation != '') {
                    $parent_data['mother_occupation'] = $pd_mother_occupation;  
                    $parent_data['other_occupation_mother'] = $user_data['other_occupation_mother'];  
                }
                $parent_data['mother_mob_country_code_id'] = $user_data['pd_mother_phone_no_code'];
              
                 }

                // Guardian Detail
                $parent_data['parent_type_guardian_id'] = PARENT_TYPE_ID_GUARDIAN;
                
                    $parent_data['guardian_parent_det_id'] = $user_data['pd_guardian_id'];
                    $parent_data['parent_guardian_name'] = $user_data['pd_guardian_name'];
                    $parent_data['guardian_mob_country_code_id'] = $user_data['pd_guardian_phone_no_code'];
                    $parent_data['guardian_mobile_no'] = $user_data['pd_guardian_phone'];
                    $parent_data['relationship_id'] = $user_data['relationship_id'];
                    $pd_guardian_alt_phone = $user_data['pd_guardian_alt_phone'];
                    $pd_guardian_email = $user_data['pd_guardian_email'];
                    if($pd_guardian_email != '') {
                        $parent_data['guardian_email_id'] = $pd_guardian_email;    
                    }
                    $pd_guardian_occupation = $user_data['pd_guardian_occupation'];
                    if($pd_guardian_occupation != '') {
                        $parent_data['guardian_occupation'] = $pd_guardian_occupation;  
                        $parent_data['other_occupation_guardian'] = $user_data['other_occupation_guardian'];  
                    }
                
                $parent_data['created_by']=$created_updated_by;
                $parent_data['updated_by']=$created_updated_by;
                $parent_data['user_details_data'] = $this->user_details_data['user_details']['data'][0];
                $url = $api_urls[ 'international_parent_detail' ];
                //$userdata = $this->session_internationaluserdata();
                $userdata = $this->user_details_data;
                $parent_data['userdata'] = $userdata;
                $parent_data['applicant_personal_det_id'] = $applicant_id;  
                $parent_data['applicant_login_id'] = $applicant_login_id;  
                $method = "POST";
                // echo '<pre>';
                // print_r($parent_data);
                // echo '</pre>';
                list($result_token,$data) = $this->_check_token($parent_data); 
                $parent_dt_response =false;                              
                if($result_token['valid']=='true')
                {
                    // Call API
                    $result = $this->call_api($url,$method,$data);
                    // $parent_dt_response = array("status"=>$result['status'],"message"=> $result['message']);                    
                    $parent_dt_response = $result;                    
                }
                $response = array();
                $response['parent_response'] = $parent_dt_response;
                $return = $this->json_return($response);
                return $return;
            }
               
			// International permanent address & commucnication address
			if($user_data['currentIndex']==3){
                $url = $api_urls[ 'international_address_detail' ];
                $method = 'POST';
                //$userdata = $this->session_internationaluserdata();
                $userdata = $this->user_details_data;
                $user_data['userdata'] = $userdata;
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['applicant_login_id'] = $applicant_login_id;
				$user_data['app_form_id'] = $form_id;
				$user_data['is_permanent_same_as_cc'] = $user_data['is_permanent_addr_same'];
                list($result_token,$data) = $this->_check_token($user_data);  
                if($result_token['valid']=='true')
                {
					$result = $this->call_api ( $url , $method , $user_data );
					$return = $this->json_return($result);
					return $return;
                }
			}

            if($user_data['currentIndex'] == 4)
            {  
                $academic_data['name_as_in_marksheet'] = $user_data['name_as_in_marksheet'];
                $academic_data['completion_year'] = $user_data['completion_year'];
                $academic_data['country_id'] = $user_data['country_id'];
                $academic_data['institute_name'] = $user_data['institute_name'];
                $academic_data['examination_id'] = $user_data['examination_id'];

                $academic_data['schooling_ids'][0]= $user_data['schooling_id_1'];
                $academic_data['academic_subject'][0]= $user_data['academic_subject1'];
                $academic_data['obtained_percentage_cgpa'][0]= $user_data['obtained_percentage_cgpa1'];
                $academic_data['marking_scheme'][0]= $user_data['marking_scheme1'];

                $academic_data['schooling_ids'][1]= $user_data['schooling_id_2'];
                $academic_data['academic_subject'][1]= $user_data['academic_subject2'];
                $academic_data['obtained_percentage_cgpa'][1]= $user_data['obtained_percentage_cgpa2'];
                $academic_data['marking_scheme'][1]= $user_data['marking_scheme2'];

                $academic_data['schooling_ids'][2]= $user_data['schooling_id_3'];
                $academic_data['academic_subject'][2]= $user_data['academic_subject3'];
                $academic_data['obtained_percentage_cgpa'][2]= $user_data['obtained_percentage_cgpa3'];
                $academic_data['marking_scheme'][2]= $user_data['marking_scheme3'];

                $academic_data['schooling_ids'][3]= $user_data['schooling_id_4'];
                $academic_data['academic_subject'][3]= $user_data['academic_subject4'];
                $academic_data['obtained_percentage_cgpa'][3]= $user_data['obtained_percentage_cgpa4'];
                $academic_data['marking_scheme'][3]= $user_data['marking_scheme4'];

                $academic_data['schooling_ids'][4]= $user_data['schooling_id_5'];
                $academic_data['academic_subject'][4]= $user_data['academic_subject5'];
                $academic_data['obtained_percentage_cgpa'][4]= $user_data['obtained_percentage_cgpa5'];
                $academic_data['marking_scheme'][4]= $user_data['marking_scheme5'];

                $academic_data['schooling_ids'][5]= $user_data['schooling_id_6'];
                $academic_data['academic_subject'][5]= $user_data['academic_subject6'];
                $academic_data['obtained_percentage_cgpa'][5]= $user_data['obtained_percentage_cgpa6'];
                $academic_data['marking_scheme'][5]= $user_data['marking_scheme6'];

                $academic_data['schooling_ids'][6]= $user_data['schooling_id_7'];
                $academic_data['academic_subject'][6]= $user_data['academic_subject7'];
                $academic_data['obtained_percentage_cgpa'][6]= $user_data['obtained_percentage_cgpa7'];
                $academic_data['marking_scheme'][6]= $user_data['marking_scheme7'];

                $academic_data['schooling_ids'][7]= $user_data['schooling_id_8'];
                $academic_data['academic_subject'][7]= $user_data['academic_subject8'];
                $academic_data['obtained_percentage_cgpa'][7]= $user_data['obtained_percentage_cgpa8'];
                $academic_data['marking_scheme'][7]= $user_data['marking_scheme8'];

                $academic_data['schooling_ids'][8]= $user_data['schooling_id_9'];
                $academic_data['academic_subject'][8]= $user_data['academic_subject9'];
                $academic_data['obtained_percentage_cgpa'][8]= $user_data['obtained_percentage_cgpa9'];
                $academic_data['marking_scheme'][8]= $user_data['marking_scheme9'];

                $academic_data['scl_det_id']= json_encode($academic_data['schooling_ids']);
                $academic_data['school_subject']= json_encode($academic_data['academic_subject']);
                $academic_data['school_obtained_percentage_cgpa']= json_encode($academic_data['obtained_percentage_cgpa']);
                $academic_data['school_marking_scheme'] = json_encode($academic_data['marking_scheme']);
                
                $academic_data['created_by']=$created_updated_by;
                $academic_data['updated_by']=$created_updated_by;

                $academic_data['user_details_data'] = $this->user_details_data['user_details']['data'][0];
                $url = $api_urls[ 'international_academic_detail' ];
                //$userdata = $this->session_internationaluserdata();
                $userdata = $this->user_details_data;
                $academic_data['userdata'] = $userdata;
                $academic_data['applicant_personal_det_id'] = $applicant_id;  
                $academic_data['applicant_login_id'] = $applicant_login_id;  
                $method = "POST";
               /* echo '<pre>';
                print_r($academic_data);
                echo '</pre>';
                die;*/
                list($result_token,$data) = $this->_check_token($academic_data); 
                /*echo '<pre>';
                print_r($data);
                echo '</pre>';
                die;*/

                if($result_token['valid']=='true')
                {
                    // Call API
                    $result = $this->call_api($url,$method,$data);
                    $return = $this->json_return($result);
                    return $return;                 
                }
                
            }
			
			// Declaration International
			if($user_data['currentIndex']==5){
                $url = $api_urls[ 'declaration_intl' ];
                $method = 'POST';
				//$userdata = $this->session_internationaluserdata();
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
        }
        else
        {   
			$api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'upload_filelist' ];
			// Added form id to get doc data applicant_appln_id wise
            $url .= '/?fk_id='.$applicant_id.'&fk1_id='.$form_id;
            $method = 'GET';
            //$userdata = $this->session_internationaluserdata();
            $userdata = $this->user_details_data;
            $data['userdata'] = $userdata;
            list($result_token,$data) = $this->_check_token($data);
            if($result_token['valid']=='true')
            {
                $result = $this->call_api ( $url , $method , $data );
            }
            $upload_filelist = $result['data'];
            $this->data['upload_filelist'] = $upload_filelist;		
			// Get Applicant ID

			$applicantformdtl_id = array('applicant_personal_det_id' => $applicant_id , 
					'applicant_form_id' => APP_FORM_ID_INTERNATIONAL ); 

			/* applicant_appln_details_list start */
			$applicant_appln_details_list = $this->_get_applicant_tables($applicantformdtl_id, 'db_func_appln_detail');
			$this->data['applicant_appln_details_list'] = $applicant_appln_details_list[0];
			/* applicant_appln_details_list end */

            //redirect to dashboard after appln completion
            if($applicant_appln_details_list){
                     $application_status_id=$applicant_appln_details_list[0]['application_status_id'];
                     if(!empty($application_status_id) && $application_status_id!=APPLICATION_IN_PROGRESS && $mode == ''){
                         redirect(base_url().'international_dashboard');
                     }
            }
            //End: redirect to dashboard after appln completion


            /*Form Index Restriction Start*/
            $wizard_dt = $this->_get_wizard_details(APP_FORM_ID_INTERNATIONAL);
            $applnform_wizard_id = $applicant_appln_details_list[0]['form_w_wizard_id'];
            $get_appln_wizard_dtl = $this->_get_appln_wizard_details($applnform_wizard_id);
            $this->data['wizard_dt']=$wizard_dt;
            $this->data['appln_wizard_dt']=$get_appln_wizard_dtl;
            /*Form Index Restriction End*/

			$applicant_applnid = $applicant_appln_details_list[0]['applicant_appln_id'];
			$applicantapplndtl_id = array('applicant_personal_det_id' => $applicant_id , 'applicant_appln_id' => $applicant_applnid );

			/* applicant_basic_details_list start */
			$applicant_basic_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_basic_detail');
			$this->data['applicant_basic_details_list'] = $applicant_basic_details_list[0];
			/* applicant_basic_details_list end */

			/* applicant_address_details_list start */
			$applicant_address_details_list = $this->_get_applicant_tables($applicantapplndtl_id,'db_func_address_detail');
			$this->data['applicant_address_details_list'] = $applicant_address_details_list;	
			/* applicant_address_details_list end */

            /* applicant_course_prefer_details_list start */
        $applicant_course_prefer_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_course_prefer_detail');
        $this->data['applicant_course_prefer_details_list'] = $applicant_course_prefer_details_list;
        /* applicant_course_prefer_details_list end */

        /* applicant_parent_details_list start */
        $applicant_parent_details = $this->_get_applicant_tables($applicantapplndtl_id, 
            'db_func_parent_detail');
        $this->data['applicant_parent_details_list'] = $applicant_parent_details;
            /* applicant_parent_details_list end */

        /* applicant_other_details_list start */
        $applicant_other_details = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_other_detail');
        $this->data['applicant_other_details_list'] = $applicant_other_details[0];
            /* applicant_other_details_list end */

         /* applicant_schooling_details_list start */
         $applicant_schooling_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_schooling_detail');
         $this->data['applicant_schooling_details_list'] = $applicant_schooling_details_list;
         //print_r($applicant_schooling_details_list);die;
            /* applicant_schooling_details_list end */

        $arr_wizard_id = array(FORM_WIZARD_BASIC_ID,FORM_WIZARD_PREFERENCE_PERSONAL_ID,FORM_WIZARD_PARENT_ADDRESS_ID,FORM_WIZARD_ACADEMIC_ID,FORM_WIZARD_PAYMENT_ID,FORM_WIZARD_DECLARATION_ID,FORM_WIZARD_UPLOAD_ID,FORM_WIZARD_UPLOAD_DECLARATION_ID,FORM_WIZARD_PARENT_ID,FORM_WIZARD_ADDRESS_ID);
            foreach($arr_wizard_id as $k=>$v) {
                $applicant_instructions_list = $this->_get_applicant_tables(array('appln_form_id'=>$form_id,'wizard_id'=>$v), 'db_func_instruction');
                $this->data['applicant_instructions_list'][$v] = $applicant_instructions_list;      
            }

        /* applicant_payment_details_list start */
            $applicant_payment_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_payment_detail');
            $this->data['applicant_payment_details_list'] = $applicant_payment_details_list[0];
				
			$this->data['form_wizard'] = true;
			$this->data['logged_applicant_id']=$applicant_id;
			$this->data['logged_applicant_login_id']=$applicant_login_id;
			$this->data['user_data'] = $this->user_details_data['user_details']['data'][0];
			$this->data['personal_detail_list'] = $this->personal_detail_list($applicant_id);
			//$this->data['sidebar'] = 'icon';
            $this->data['sidebar'] = 'is_international';
			$cur_year = date('Y');
			$this->data['site_title'] = $this->data['page_title'] = 'International Application Form' .' ' .  $cur_year;
			$this->template('applications/form_international', $this->data, true); 
        }
    }

    public function get_resident_category()
    {
            parent::_get_resident_category(false, $this->is_admin);
    }

    public function get_resident_international_category()
    {
        parent::_get_resident_international_category(false, $this->is_admin);
    }

    public function get_relation_international_sponsor()
    {
        parent::_get_relation_international_sponsor(false, $this->is_admin);
    }

    public function get_international_title()
    {
        parent::_get_international_title(false, $this->is_admin);
    }

    public function get_international_mobile_codes()
    {
        parent::_get_international_mobile_codes(false, $this->is_admin);
    }

    public function get_international_gender()
    {
        parent::_get_international_gender(false, $this->is_admin);
    }

    public function get_international_nationality()
    {
        parent::_get_international_nationality(false, $this->is_admin);
    }

    public function get_international_countries()
    {
        parent::_get_international_countries(false, $this->is_admin);
    }

    public function get_international_parent_occupation()
    {
        parent::_get_international_parent_occupation(false, $this->is_admin);
    }

    public function get_international_states()
    {
        parent::_get_international_states(false, $this->is_admin);
    }

    public function get_international_cities()
    {
        parent::_get_international_cities(false, $this->is_admin);
    }

    public function get_international_marking_scheme()
    {
        parent::_get_international_marking_scheme(false, $this->is_admin);
    }

    public function get_relation_sponsor()
    {
        parent::_get_relation_sponsor(false, $this->is_admin);
    }

    public function get_international_banks()
    {
        parent::_get_international_banks(false, $this->is_admin);
    }

    public function form_international_list()
    {
        $api_urls = $this->config->item ( 'api_urls' );
        $form_id = APP_FORM_ID_INTERNATIONAL;
        $url= $api_urls['form_list'];
        $method = 'GET';
        //$userdata = $this->session_internationaluserdata();
        $userdata = $this->user_details_data;
        $user_data['userdata'] = $userdata;
        list($result_token,$data) = $this->_check_token($user_data);
        if($result_token['valid']=='true')
        {
            // Call API
            $data = $this->call_api($url,$method,$user_data);
            if($data){
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
                $returnResponse = $this->output->get_output();
                return $returnResponse;
            }
        }
    }

    


    public function get_international_percentage_w_tab()
    {
        $this->is_exists_international_user_logged();
        
        // Newly implemented on 11-08-2020
        // if($this->input->get('logged_applicant_id')){
            // $applicant_id = $this->input->get('logged_applicant_id');
        // }
        
        // $applicant_id = ($applicant_id)?$applicant_id:$this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];

        $ses_applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];
        //$applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];
        $applicant_personal_det_id = $this->input->get('applicant_personal_det_id');
        $applicant_id = ($applicant_personal_det_id)?$applicant_personal_det_id:$ses_applicant_id;
        //echo $applicant_id;die;
        // Get Form ID
        $get_form_id = $this->input->get('app_form_id',true);
        $get_form_id = ($get_form_id)?$get_form_id:APP_FORM_ID_DE;
        // Get Applicant ID
        $applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);

        $applicant_appln_det_id = $applicant_appln_det['id'];

        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls['tab_w_percentage'];
        $method = 'POST';
        $userdata = $this->session_internationaluserdata();
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

    /**
     * get active countries list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_choice_dropdown_international() {
        $new_arr = $new_arr1 = array();
        $is_course = $this->input->get('is_course');
        $is_spec = $this->input->get('is_spec');
        $is_campus = $this->input->get('is_campus');
        $is_regcourse = $this->input->get('is_regcourse');
        $is_stream = $this->input->get('is_stream');
        $res = parent::_get_choice_dropdown_international(true, $this->is_admin);
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
        $returnResponse = $this->output->get_output();
        return $returnResponse;
    }    


    public function get_examination_list()
    {
        parent::_get_examination_list(false, $this->is_admin);
    }  

    public function get_subject_list()
    {
        parent::_get_subject_list(false, $this->is_admin);
    }  

    public function international_form_preview($mode = false , $applicant_login_id = false , $applicant_personal_det_id = false)
    {
        $this->is_exists_international_user_logged();
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
        
        $form_id = APP_FORM_ID_INTERNATIONAL;
        // Get Applicant ID
        $applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$form_id);
        // Get Applicant APPLN ID       
        $applicant_appln_det_id = $applicant_appln_det['id'];   
        $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'upload_filelist' ];
            // Added form id to get doc data applicant_appln_id wise
            $url .= '/?fk_id='.$applicant_id.'&fk1_id='.$form_id;
            $method = 'GET';
            //$userdata = $this->session_internationaluserdata();
            $userdata = $this->user_details_data;
            $data['userdata'] = $userdata;
            list($result_token,$data) = $this->_check_token($data);
            if($result_token['valid']=='true')
            {
                $result = $this->call_api ( $url , $method , $data );
            }
            $upload_filelist = $result['data'];
            $this->data['upload_filelist'] = $upload_filelist;      
            // Get Applicant ID

            $applicantformdtl_id = array('applicant_personal_det_id' => $applicant_id , 
                    'applicant_form_id' => APP_FORM_ID_INTERNATIONAL ); 

            /* applicant_appln_details_list start */
            $applicant_appln_details_list = $this->_get_applicant_tables($applicantformdtl_id, 'db_func_appln_detail');
            $this->data['applicant_appln_details_list'] = $applicant_appln_details_list[0];
            /* applicant_appln_details_list end */

            $applicant_applnid = $applicant_appln_details_list[0]['applicant_appln_id'];
            $applicantapplndtl_id = array('applicant_personal_det_id' => $applicant_id , 'applicant_appln_id' => $applicant_applnid );

            /* applicant_basic_details_list start */
            $applicant_basic_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_basic_detail');
            $this->data['applicant_basic_details_list'] = $applicant_basic_details_list[0];
            /* applicant_basic_details_list end */

            /* applicant_address_details_list start */
            $applicant_address_details_list = $this->_get_applicant_tables($applicantapplndtl_id,'db_func_address_detail');
            $this->data['applicant_address_details_list'] = $applicant_address_details_list;    
            /* applicant_address_details_list end */

            /* applicant_course_prefer_details_list start */
        $applicant_course_prefer_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_course_prefer_detail');
        $this->data['applicant_course_prefer_details_list'] = $applicant_course_prefer_details_list;
        /* applicant_course_prefer_details_list end */

        /* applicant_parent_details_list start */
        $applicant_parent_details = $this->_get_applicant_tables($applicantapplndtl_id, 
            'db_func_parent_detail');
        $this->data['applicant_parent_details_list'] = $applicant_parent_details;
            /* applicant_parent_details_list end */

        /* applicant_other_details_list start */
        $applicant_other_details = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_other_detail');
        $this->data['applicant_other_details_list'] = $applicant_other_details[0];
            /* applicant_other_details_list end */

         /* applicant_schooling_details_list start */
         $applicant_schooling_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_schooling_detail');
         $this->data['applicant_schooling_details_list'] = $applicant_schooling_details_list;
         //print_r($applicant_schooling_details_list);die;
            /* applicant_schooling_details_list end */

        $arr_wizard_id = array(FORM_WIZARD_BASIC_ID,FORM_WIZARD_PREFERENCE_PERSONAL_ID,FORM_WIZARD_PARENT_ADDRESS_ID,FORM_WIZARD_ACADEMIC_ID,FORM_WIZARD_PAYMENT_ID,FORM_WIZARD_DECLARATION_ID,FORM_WIZARD_UPLOAD_ID,FORM_WIZARD_UPLOAD_DECLARATION_ID,FORM_WIZARD_PARENT_ID,FORM_WIZARD_ADDRESS_ID);
            foreach($arr_wizard_id as $k=>$v) {
                $applicant_instructions_list = $this->_get_applicant_tables(array('appln_form_id'=>$form_id,'wizard_id'=>$v), 'db_func_instruction');
                $this->data['applicant_instructions_list'][$v] = $applicant_instructions_list;      
            }

        /* applicant_payment_details_list start */
            $applicant_payment_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_payment_detail');
            $this->data['applicant_payment_details_list'] = $applicant_payment_details_list[0];
                
            $this->data['form_wizard'] = true;
            $this->data['logged_applicant_id']=$applicant_id;
            $this->data['logged_applicant_login_id']=$applicant_login_id;
            $this->data['user_data'] = $this->user_details_data['user_details']['data'][0];
            $this->data['personal_detail_list'] = $this->personal_detail_list($applicant_id);
            //$this->data['sidebar'] = 'icon';
            $this->data['sidebar'] = 'is_international';
            $cur_year = date('Y');
            $this->data['site_title'] = $this->data['page_title'] = 'International Application Form Preview' .' ' .  $cur_year;
            $this->template('applications/form_international_preview', $this->data, true); 
    }


     

   

}
