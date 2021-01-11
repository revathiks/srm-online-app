<?php
/*
* @Author         : Geetha SJ
* @Created Date   : 16/07/2020
* @Version        : 0.1
* @Description    : March Form
* Controller Name : March_design.php
*/


defined('BASEPATH') or exit('No direct script access allowed');

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

class March_design extends FrontendController
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
		$this->application_year = date("Y");

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
    }


    /**
     * get march form details & insert details by API call
     *
     * @return Raw march form data
     */

    public function marchdesign_form($mode = false , $applicant_login_id = false , $applicant_personal_det_id = false)
    {

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
            $created_updated_by=($mode)?CRM_ADMIN_USER_ROLE_ID:$applicant_id;
          

			// Get Form ID
			$get_form_id = APP_FORM_ID_MARCH;
			// Get Applicant ID
			$applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);
					
			$applicant_appln_det_id = $applicant_appln_det['id'];	
			
            if ( $this->input->post () )
            {   
                //echo $applicant_id;die;
            $user_data = $this->input->post();

            $user_data['created_by']=$created_updated_by;
            $user_data['updated_by']=$created_updated_by;
            $api_urls = $this->config->item ( 'api_urls' ); 

            // Basic Details Start
             if($user_data['currentIndex']==0)
             {
                    // Basic Details API & Method
                    $method = 'POST';   
                    $url = $api_urls[ 'march_basic_detail' ];
                    // Get 
                    $user_data['applicant_personal_det_id'] = $applicant_id;
                    $user_data['qualifyingexamfromindia'] = $user_data['qualifyingexamfromindia'];
                    $user_data['user_details_data'] = $this->user_details_data['user_details']['data'][0];
                    $data = $this->call_api($url,$method,$user_data);
                    //echo json_encode($data,true);
                    $return = $this->json_return($data);
                    return $return;
             }
            // Basic Details End
             //Personal Details Start
            if($user_data['currentIndex']==1)
            {
                $url = $api_urls[ 'march_personal_detail' ];
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['mobile_no_code'] = $user_data['phone_no_code'];
                //$user_data['dob'] = date("Y-m-d",strtotime($user_data['pd_dob']));
                if(!empty($user_data['pd_dob'])){
                    $dob=$this->convertDate($user_data['pd_dob']);
                    $user_data['dob'] = $dob;
                }else{
                    $user_data['dob'] = date("Y-m-d",strtotime($user_data['pd_dob']));
                }                
                if($user_data['prefer_hostel'] == 'yes'){
                        $user_data['prefer_hostel'] ='t';
                }else if($user_data['prefer_hostel'] == 'no'){
                         $user_data['prefer_hostel'] ='f';
                }
                if($user_data['diff_abled'] == 'yes'){
                        $user_data['diff_abled'] ='t';
                }else if($user_data['diff_abled'] == 'no'){
                         $user_data['diff_abled'] ='f';
                }
                
                $user_data['campus_pref'] = $user_data['campus_pref_1'];
                $user_data['campus_choice_no'] = $user_data['campus_choice_no_1'];
                $user_data['campus_prefer_id'] = $user_data['campus_prefer_id_1'];

                $user_data['user_details_data'] = $this->user_details_data['user_details']['data'][0];
                $method = 'POST'; 
                /*echo '<pre>';
                print_r($url);
                print_r($method);
                print_r($user_data);

                echo '</pre>';
                die;*/
                //Call API
                $data = $this->call_api($url,$method,$user_data);
            
                //echo json_encode($data,true);
                $return = $this->json_return($data);
                return $return;
            }
            // Personal Details End

            // Parents Details Start
            if($user_data['currentIndex']==2)
            { 
                $api_urls = $this->config->item ( 'api_urls' );
                // Father Detail
                $parent_data['parent_type_father_id'] = PARENT_TYPE_ID_FATHER;
                $parent_data['father_parent_det_id'] = $user_data['pd_father_id'];
                $parent_data['parent_father_name'] = $user_data['pd_father_name'];
                $parent_data['father_mobile_no'] = $user_data['pd_father_phone'];
                $parent_data['father_email_id'] = $user_data['pd_father_email'];
                $parent_data['father_occupation'] = $user_data['pd_father_occupation'];
                $parent_data['father_mob_country_code_id'] = $user_data['pd_father_phone_no_code'];
                $parent_data['father_title'] = $user_data['pd_father_title'];
                $parent_data['father_other_occupation'] = $user_data['father_other_occupation'];
                $parent_data['father_alt_mobile_no'] = $user_data['father_alt_mobile_no'];
                $parent_data['father_alt_mob_country_code_id'] = $user_data['father_alt_phone_no_code'];
                // Mother Detail
                $parent_data['parent_type_mother_id'] = PARENT_TYPE_ID_MOTHER;
                $parent_data['mother_parent_det_id'] = $user_data['pd_mother_id'];
                $parent_data['parent_mother_name'] = $user_data['pd_mother_name'];
                $parent_data['mother_mobile_no'] = $user_data['pd_mother_phone'];
                $parent_data['mother_email_id'] = $user_data['pd_mother_email'];
                $parent_data['mother_occupation'] = $user_data['pd_mother_occupation'];
                $parent_data['mother_mob_country_code_id'] = $user_data['pd_mother_phone_no_code'];
                $parent_data['mother_title'] = $user_data['pd_mother_title'];
                $parent_data['mother_other_occupation'] = $user_data['mother_other_occupation'];
                $parent_data['mother_alt_mobile_no'] = $user_data['mother_alt_phone'];
                $parent_data['mother_alt_mob_country_code_id'] = $user_data['mother_alt_phone_no_code'];
                // Guardian Detail
                $parent_data['parent_type_guardian_id'] = PARENT_TYPE_ID_GUARDIAN;
                $parent_data['add_guardian_details'] = $user_data['add_guardian_checkbox'];
                $parent_data['guardian_parent_det_id'] = $user_data['pd_guardian_id'];
                $parent_data['parent_guardian_name'] = $user_data['pd_guardian_name'];
                $parent_data['guardian_mob_country_code_id'] = $user_data['pd_guardian_phone_no_code'];
                $parent_data['guardian_mobile_no'] = $user_data['pd_guardian_phone'];
                $parent_data['guardian_email_id'] = $user_data['pd_guardian_email'];
                $parent_data['guardian_occupation'] = $user_data['pd_guardian_occupation'];
                $parent_data['user_details_data'] = $this->user_details_data['user_details']['data'][0];
                $parent_data['guardian_other_occupation'] = $user_data['guardian_other_occupation'];
                $parent_data['created_by']=$created_updated_by;
                $parent_data['updated_by']=$created_updated_by;
                $url = $api_urls['march_parent_detail'];
                //$userdata = $this->session_userdata();
                $userdata = $this->user_details_data;
                $parent_data['userdata'] = $userdata;
                $parent_data['applicant_personal_det_id'] = $applicant_id;  
                $parent_data['applicant_login_id'] = $applicant_login_id;  
                list($result_token,$data) = $this->_check_token($parent_data); 
                $parent_dt_response =false;
                $method = 'POST';                     
                if($result_token['valid']=='true')
                {
                    // Call API
                    $result = $this->call_api($url,$method,$data);
                    $parent_dt_response = array("status"=>$result['status'],"message"=> $result['message']);
                }
                $response = array();
                $response['parent_response'] = $parent_dt_response;
                $return = $this->json_return($response);
                return $return;
            }

            // Parents Details End

            // Address Details Start
            if($user_data['currentIndex']==3)
            {
                $api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls[ 'addressdet' ];
                $method = 'POST';
                //$userdata = $this->session_userdata();
                $userdata = $this->user_details_data;
                $user_data['userdata'] = $userdata;
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['applicant_login_id'] = $applicant_login_id;
                $form_id = APP_FORM_ID_MARCH;
                $user_data['app_form_id']=  $form_id;    
                list($result_token,$data) = $this->_check_token($user_data);  
                $addr_dt_response =false;      
                if($result_token['valid']=='true')
                {
                $result = $this->call_api ( $url , $method , $data );
                $addr_dt_response = array("status"=>$result['status'],"message"=> $result['message']);
                }
                $response['address_response'] = $addr_dt_response;
                $return = $this->json_return($response);
                return $return;
            }

            // Address Details End

            //Academic Details Start
            if($user_data['currentIndex'] == 4)
            {

                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['current_education_qual_status']=$user_data['current_education_qual_status'];
                $user_data['name_as_in_marksheet']=$user_data['tenth_name'];
                $user_data['digilocker_id']=$user_data['digilocker_id'];

                $user_data['scl_det_id']=$user_data['scl_det_id_0'];                
                $user_data['school_institute_name'] = $user_data['institute_name_0'];
                $user_data['school_board'] = $user_data['board_0'];
                $user_data['school_obtained_percentage_cgpa'] = $user_data['obtained_percentage_cgpa_0'];
                $user_data['school_year_pass'] = $user_data['year_of_passing_0'];
                $user_data['school_reg_roll'] = $user_data['registration_no_0'];
                $user_data['school_marking_schema'] = $user_data['marking_scheme_0'];

                $user_data['grad_id_1']=$user_data['grad_id_1'];          
                $user_data['insti_name'] = $user_data['institute_name_1'];
                $user_data['univ_id'] = $user_data['board_1'];
                $user_data['mark_percent'] = $user_data['obtained_percentage_cgpa_1'];
                $user_data['completion_year'] = $user_data['year_of_passing_1'];
                $user_data['registration_no'] = $user_data['registration_no_1'];
                $user_data['mark_scheme_id'] = $user_data['marking_scheme_1'];

                //print_r($user_data);die;

                
                $api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls[ 'march_acdemic_dtl' ];
                $method = 'POST';
                //$userdata = $this->session_userdata();
                $userdata = $this->user_details_data;
                $user_data['userdata'] = $userdata;
                $user_data['applicant_login_id'] = $applicant_login_id;
                list($result_token,$data) = $this->_check_token($user_data);  
                $addr_dt_response =false;      
                if($result_token['valid']=='true')
                {
                $result = $this->call_api ( $url , $method , $data );
                $return = $this->json_return($result);
                return $return; 
                }

            }
            //Academic Details End

            // Declaration Start
            if($user_data['currentIndex']==6){
                // Declaration Details API & Method
                $url = $api_urls[ 'march_declaration_detail' ];
                $method ="POST";
                // Get Declaration Applicant ID
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['applicant_name_declaration'] = $user_data['applicant_name'];
                $user_data['applicant_parentname_declaration'] = $user_data['parent_name'];
                $user_data['applicant_declaration_date'] = $user_data['declaration_date'];
                if(!empty($user_data['declaration_date'])){
                    $declaration_date=$this->convertDate($user_data['declaration_date']);
                    $user_data['applicant_declaration_date'] = $declaration_date;
                }else{
                    $user_data['applicant_declaration_date'] = date("Y-m-d",strtotime($user_data['declaration_date']));
                }
                $data = $this->call_api($url,$method,$user_data);
                $return = $this->json_return($data);
                return $return;             
            }
            // Declartion End
            //Upload start
            if($user_data['currentIndex']==7){
                // Academic Details API & Method
                $url = $api_urls[ 'upload_final_step' ];
                $method = "POST";
                // Get 
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['app_form_id'] = APP_FORM_ID_MARCH;
                $user_data['user_details_data'] = $this->user_details_data['user_details']['data'][0];
                // Call API
                $data = $this->call_api($url,$method,$user_data);

                $return = $this->json_return($data);
                return $return; 
            }
            }
            else
            { 
            $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'upload_filelist' ];
            //$url .= '/?fk_id='.$applicant_id;
            $url .= '/?fk_id='.$applicant_id.'&fk1_id='.APP_FORM_ID_MARCH;
            $method = 'GET';
            //$userdata = $this->session_userdata();
            $userdata = $this->user_details_data;
            $data['userdata'] = $userdata;
            list($result_token,$data) = $this->_check_token($data);
            if($result_token['valid']=='true')
            {
                $result = $this->call_api ( $url , $method , $data );
            }
            // echo '<pre>';
            // print_r($url);
            // print_r($method);
            // print_r($data);
            // print_r($result);
            // echo '</pre>';
            $upload_filelist = $result['data'];
            $this->data['upload_filelist'] = $upload_filelist;

            $applicantformdtl_id = array('applicant_personal_det_id' => $applicant_id , 
                'applicant_form_id' => APP_FORM_ID_MARCH );

             /* applicant_appln_details_list start */ 



            $applicant_appln_details_list = $this->_get_applicant_tables($applicantformdtl_id, 'db_func_appln_detail');
            $this->data['applicant_appln_details_list'] = $applicant_appln_details_list;
            /* applicant_appln_details_list end */

            //redirect to dashboard after appln completion
            if($applicant_appln_details_list){
                     $application_status_id=$applicant_appln_details_list[0]['application_status_id'];
                     if(!empty($application_status_id) && $application_status_id!=APPLICATION_IN_PROGRESS && $mode == ''){
                         redirect(base_url());
                     }
            }
            //End: redirect to dashboard after appln completion
            
            /*Form Index Restriction Start*/
            $wizard_dt = $this->_get_wizard_details(APP_FORM_ID_MARCH);
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

             
            /*applicant_Campus_details_list start */   
            $applicant_campus_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_campus_detail');
            $this->data['applicant_campus_details_list'] = $applicant_campus_details_list;
            /* applicant_Campus_details_list start */

            /*applicant_Course_details_list start */ 
            $applicant_course_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_course_detail');
            $this->data['applicant_course_details_list'] = $applicant_course_details_list;
            /*applicant_Course_details_list start */ 
            //print_r($applicant_course_details_list);
            /* applicant_parent_details_list start */
            $applicant_parent_details = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_parent_detail');
            $this->data['applicant_parent_details_list'] = $applicant_parent_details;
            /* applicant_parent_details_list end */

            /* applicant_address_details_list start */
            $applicant_address_details = $this->_get_applicant_tables($applicantapplndtl_id,'db_func_address_detail');
            $this->data['applicant_address_details_list'] = $applicant_address_details;             
             /* applicant_address_details_list end */

             /* applicant_other_details_list start */
            $applicant_other_details = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_other_detail');
            $this->data['applicant_other_details_list'] = $applicant_other_details[0];
            /* applicant_other_details_list end */

            /* applicant_schooling_details_list start */
            $applicant_schooling_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_schooling_detail');
            $this->data['applicant_schooling_details_list'] = $applicant_schooling_details_list[0];
            /* applicant_schooling_details_list end */

            /* applicant_graduations_list start */
            $applicant_graduations = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_grad_detail');
            $this->data['applicant_graduations_list'] = $applicant_graduations[0];
            /* applicant_graduations_list end */ 

            /* applicant_competitive_details_list start */
            $applicant_competitive_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_competitive_detail');
            $this->data['applicant_competitive_details_list'] = $applicant_competitive_details_list;
            /* applicant_schooling_details_list end */
           //print_r($applicant_competitive_details_list);
            //die;

            $payment_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_payment_detail');
            $this->data['payment_details_list'] = $payment_details_list[0]; 


            /*Get Instruction Start*/
            $arr_wizard_id = array(FORM_WIZARD_BASIC_ID,FORM_WIZARD_PERSONAL_ID,FORM_WIZARD_PARENT_ADDRESS_ID,FORM_WIZARD_ACADEMIC_ID,FORM_WIZARD_PAYMENT_ID,FORM_WIZARD_UPLOAD_DECLARATION_ID);
            foreach($arr_wizard_id as $k=>$v) {
                $applicant_instructions_list = $this->_get_applicant_tables(array('appln_form_id'=>$get_form_id,'wizard_id'=>$v), 'db_func_instruction');
                $this->data['applicant_instructions_list'][$v] = $applicant_instructions_list;      
            }
            /*Get Instruction End*/

                $this->data['form_wizard'] = true;
                $this->data['sidebar'] = 'icon';
                $this->data['logged_applicant_id']=$applicant_id;
                $this->data['logged_applicant_login_id']=$applicant_login_id;
                $this->data['user_data'] = $this->user_details_data['user_details']['data'][0];
                $this->data['personal_detail_list'] = $this->personal_detail_list($applicant_id);
                $this->data['site_title'] = $this->data['page_title'] = 'M.Arch/M.Design Application Form';
                $this->template('applications/form_marchdesign', $this->data, true);
            }
            
    }

    /**
     * get active campus list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_compexam_qualifiedstatus() {
        parent::_get_comp_exam_qualified_status(false, $this->is_admin);
    }

    public function march_form_preview($mode = false , $applicant_login_id = false , $applicant_personal_det_id = false)
    {
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

            $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'upload_filelist' ];
            $url .= '/?fk_id='.$applicant_id.'&fk1_id='.APP_FORM_ID_MARCH;
            $method = 'GET';
            //$userdata = $this->session_userdata();
            $userdata = $this->user_details_data;
            $data['userdata'] = $userdata;
            list($result_token,$data) = $this->_check_token($data);
            if($result_token['valid']=='true')
            {
                $result = $this->call_api ( $url , $method , $data );
            }
            // echo '<pre>';
            // print_r($url);
            // print_r($method);
            // print_r($data);
            // print_r($result);
            // echo '</pre>';
            $upload_filelist = $result['data'];
            $this->data['upload_filelist'] = $upload_filelist;

            $applicantformdtl_id = array('applicant_personal_det_id' => $applicant_id , 
                'applicant_form_id' => APP_FORM_ID_MARCH );

             /* applicant_appln_details_list start */ 



            $applicant_appln_details_list = $this->_get_applicant_tables($applicantformdtl_id, 'db_func_appln_detail');
            //print_r($applicant_appln_details_list);die;
            $this->data['applicant_appln_details_list'] = $applicant_appln_details_list;
            /* applicant_appln_details_list end */
            
            $applicant_applnid = $applicant_appln_details_list[0]['applicant_appln_id'];


            //Redirect After completed dashboard start
            if($applicant_appln_details_list)
            {
                $is_allow_previous = $this->config->item('is_allow_previous');
                $application_status_id=$applicant_appln_details_list[0]['application_status_id'];
                $completedWizard =$applicant_appln_details_list[0]['wizard_id'];
                if(empty($application_status_id) || $application_status_id !=APPLICATION_IN_PROGRESS || $completedWizard < FORM_WIZARD_PAYMENT_ID && (isset($is_allow_preview) && $is_allow_preview ==0))
                {
                    //redirect(base_url());
                }
            }
            //Redirect After completed dashboard End
            


            $applicantapplndtl_id = array('applicant_personal_det_id' => $applicant_id , 'applicant_appln_id' => $applicant_applnid );


                /* applicant_basic_details_list start */
            $applicant_basic_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_basic_detail');
            $this->data['applicant_basic_details_list'] = $applicant_basic_details_list[0];
            /* applicant_basic_details_list end */

             
            /*applicant_Campus_details_list start */   
            $applicant_campus_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_campus_detail');
            $this->data['applicant_campus_details_list'] = $applicant_campus_details_list;
            /* applicant_Campus_details_list start */

            /*applicant_Course_details_list start */ 
            $applicant_course_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_course_detail');
            $this->data['applicant_course_details_list'] = $applicant_course_details_list;
            /*applicant_Course_details_list start */ 


            /* applicant_graduations_list start */
            $applicant_graduations = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_grad_detail');
            $this->data['applicant_graduations_list'] = $applicant_graduations[0];
            /* applicant_graduations_list end */ 
            
            /* applicant_parent_details_list start */
            $applicant_parent_details = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_parent_detail');
            $this->data['applicant_parent_details_list'] = $applicant_parent_details;
            /* applicant_parent_details_list end */

            /* applicant_address_details_list start */
            $applicant_address_details = $this->_get_applicant_tables($applicantapplndtl_id,'db_func_address_detail');
            $this->data['applicant_address_details_list'] = $applicant_address_details;             
             /* applicant_address_details_list end */

             /* applicant_other_details_list start */
            $applicant_other_details = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_other_detail');
            $this->data['applicant_other_details_list'] = $applicant_other_details[0];
            /* applicant_other_details_list end */

            /* applicant_schooling_details_list start */
            $applicant_schooling_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_schooling_detail');
            $this->data['applicant_schooling_details_list'] = $applicant_schooling_details_list[0];
            /* applicant_schooling_details_list end */

            $payment_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_payment_detail');
            $this->data['payment_details_list'] = $payment_details_list[0]; 
            
           //print_r($applicant_competitive_details_list);
            //die;

                $this->data['form_wizard'] = true;
                $this->data['sidebar'] = 'icon';
                $this->data['logged_applicant_id']=$applicant_id;
                $this->data['logged_applicant_login_id']=$applicant_login_id;
                $this->data['user_data'] = $this->user_details_data['user_details']['data'][0];
                $this->data['personal_detail_list'] = $this->personal_detail_list($applicant_id);
                $this->data['site_title'] = $this->data['page_title'] = 'M.Arch/M.Design Application Form Preview';
        $this->template('applications/form_march_preview', $this->data, true);
    }

   }