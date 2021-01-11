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

class Mtech_research extends FrontendController
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
     * [index description]
     *
     * @method index
     *
     * @return [type] [description]
     */
    /*public function index($stream = false)
    {
        $this->is_exists_user_logged();
        $this->data['stream'] = $stream;
        $this->data['site_title'] = $this->data['page_title'] = '';
        // Display page with the template function from REST_Controller
        $this->template('applications/index', $this->data, true);
    }*/

    /**
     * [all description]
     *
     * @method index
     *
     * @return [type] [description]
     */
    /*public function all()
    {
        $this->is_exists_user_logged();
        $this->data['site_title'] = $this->data['page_title'] = 'All Applications';
        // Display page with the template function from REST_Controller
        $this->template('applications/all', $this->data, true);
    }

    public function form() {
        $this->is_exists_user_logged();
        $this->data['stream'] = $stream;		
        $this->data['site_title'] = $this->data['page_title'] = 'B.Tech Application Form '.$this->application_year;
        $this->template('applications/form', $this->data, true);
    }
	
    public function bba_form() {
        $this->is_exists_user_logged();
        $this->data['stream'] = $stream;
        $this->data['site_title'] = $this->data['page_title'] = 'BBA Application Form '.$this->application_year;
        $this->template('applications/form_bba', $this->data, true);
    }*/	
	
    public function mtechresearch_form($view_type = false , $mode = false , $applicant_login_id = false , $applicant_personal_det_id = false) {        
        $this->is_exists_user_logged();
        $app_form_id_mtech_research = APP_FORM_ID_MTECH_RESEARCH;
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
            
        if ( $this->input->post () ){	
            $user_data = $this->input->post();
            $api_urls = $this->config->item ( 'api_urls' );
            $user_data['created_by']=$created_updated_by;
            $user_data['updated_by']=$created_updated_by;

            /*Basic Details Start*/   
            if($user_data['currentIndex']==0)
            {                
                $url = $api_urls['mtechreearchbasicdet'];
                $method = 'POST';
                $form_id = APP_FORM_ID_MTECH_RESEARCH;
                //$userdata = $this->session_userdata();
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
            /*Basic Details End*/ 

            /*Personal Details Start*/ 
           if($user_data['currentIndex']==1)
            {
                $url = $api_urls['mtechresearch_personal_detail'];
                $method = 'POST';
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['applicant_login_id'] = $applicant_login_id; 
                // $mobile_no_concate_code = $user_data['phone_no_code'].''.$user_data['mtech_mobile_no'];
                $user_data['mobile_no_code'] = $user_data['phone_no_code'];
                $user_data['mobile_no'] = $user_data['mtech_mobile_no'];  
                $user_data['social_status_id'] = $user_data['pd_social_status'];  
                //$user_data['dob'] = date("Y-m-d",strtotime($user_data['dob_mtech']));

                if(!empty($user_data['dob_mtech'])){
                    $dob=$this->convertDate($user_data['dob_mtech']);
                    $user_data['dob'] = $dob;
                }else{
                    $user_data['dob'] = date("Y-m-d",strtotime($user_data['dob_mtech']));
                }

                if($user_data['diff_abled'] == 'yes'){
                        $user_data['diff_abled'] ='t';
                }else if($user_data['diff_abled'] == 'no'){
                         $user_data['diff_abled'] ='f';
                }

                if($user_data['prefer_hostel'] == 'yes'){
                        $user_data['prefer_hostel'] ='t';
                }else if($user_data['prefer_hostel'] == 'no'){
                         $user_data['prefer_hostel'] ='f';
                }

                $user_data['campus_prefer_id'][] = $user_data['campus_prefer_id_1'];
                $user_data['specialization_pref_id'][] = $user_data['specialization_prefer_id_1'];  
                $user_data['campus_choice_no'][] = $user_data['campus_choice_no_1'];
                $user_data['specialization_choice_no'][] = $user_data['specialization_choice_no_1'];
                $user_data['campus_pref'][] = $user_data['campus_preference1'];
                $user_data['specialization_pref'][] = $user_data['specialization_preference1'];


                $user_data['campus_prefer_id'][] = $user_data['campus_prefer_id_2'];
                $user_data['specialization_pref_id'][] = $user_data['specialization_prefer_id_2'];  
                $user_data['campus_choice_no'][] = $user_data['campus_choice_no_2'];
                $user_data['specialization_choice_no'][] = $user_data['specialization_choice_no_2'];
                $user_data['campus_pref'][] = $user_data['campus_preference2'];
                $user_data['specialization_pref'][] = $user_data['specialization_preference2'];

                $user_data['campus_prefer_id'][] = $user_data['campus_prefer_id_3'];
                $user_data['specialization_pref_id'][] = $user_data['specialization_prefer_id_3'];  
                $user_data['campus_choice_no'][] = $user_data['campus_choice_no_3'];
                $user_data['specialization_choice_no'][] = $user_data['specialization_choice_no_3'];
                $user_data['campus_pref'][] = $user_data['campus_preference3'];
                $user_data['specialization_pref'][] = $user_data['specialization_preference3'];

                $user_data['specialization_pref'] = json_encode($user_data['specialization_pref']);
                $user_data['campus_pref'] = json_encode($user_data['campus_pref']);
                $user_data['campus_choice_no'] = json_encode($user_data['campus_choice_no']);
                $user_data['campus_prefer_id'] = json_encode($user_data['campus_prefer_id']);
                $user_data['specialization_pref_id'] = json_encode($user_data['specialization_pref_id']);
                $user_data['specialization_choice_no'] = json_encode($user_data['specialization_choice_no']);
                $form_id = APP_FORM_ID_MTECH_RESEARCH;
                $user_data['appln_form_id'] = $form_id; 

               
                $result = $this->call_api ( $url , $method , $user_data );
                $return = $this->json_return($result);
                return $return;
                
            }
            /*Personal Details End*/ 

            /*Address Details*/
            if($user_data['currentIndex']==2)
            { 
                $url = $api_urls[ 'addressdet' ];
                $method = 'POST';
                //$userdata = $this->session_userdata();
                $userdata = $this->user_details_data;
                $user_data['userdata'] = $userdata;
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['applicant_login_id'] = $applicant_login_id;
                $form_id = APP_FORM_ID_MTECH_RESEARCH;  
                $user_data['app_form_id']=  $form_id;    
                list($result_token,$data) = $this->_check_token($user_data);  
                $addr_dt_response =false;      
                if($result_token['valid']=='true')
                {
                $result = $this->call_api ( $url , $method , $data );
                $addr_dt_response = array("status"=>$result['status'],"message"=> $result['message']);
                }
                
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
                
                $url = $api_urls[ 'mtechresearch_parent_detail' ];
                //$userdata = $this->session_userdata();
                $userdata = $this->user_details_data;
                $parent_data['userdata'] = $userdata;
                $parent_data['applicant_personal_det_id'] = $applicant_id;  
                $parent_data['applicant_login_id'] = $applicant_login_id;  
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
                $response['address_response'] = $addr_dt_response;
                $return = $this->json_return($response);
                return $return;
            }
            /*Address Details*/

            /*Academic Details*/
            if($user_data['currentIndex']==3)
            {

                /*Graduation Details*/
                $academic_data['applicant_personal_det_id'] = $applicant_id;
                $academic_data['name_in_marksheet'] = $user_data['name_as_in_marksheet'];
                $academic_data['insti_name'] = $user_data['institute_name'];
                $academic_data['univ_id'] = $user_data['university_id'];
                $academic_data['mode_of_study_id'] = $user_data['mode_of_study'];
                $academic_data['mark_scheme_id'] = $user_data['user_marking_scheme_1'];
                $academic_data['completion_year'] = $user_data['year_of_passing_1'];
                $academic_data['mark_percent'] = $user_data['obtained_percentage_cgpa_1'];
                $academic_data['registration_no'] = $user_data['register_no'];
                $academic_data['digilocker_id']= $user_data['digilocker_id'];
                $academic_data['applicant_grad_det_id']= $user_data['applicant_grad_det_id'];
                $academic_data['applicant_coord_det_id']= $user_data['applicant_coord_det_id'];
                /*Graduation Details*/
                /*Board*/
                $academic_data['research_area']= $user_data['board_research'];
                $academic_data['coord_name']= $user_data['name_proposed'];          
                /*Board*/
                /*Other Det*/
                $academic_data['is_work_experience']= $user_data['is_work_experience_checked'];
                /*Other Det*/
                /*Professional Det*/
                
                $academic_data['prof_exp_ids'][]= $user_data['prof_exp_id_0'];
                $academic_data['org_name'][]= $user_data['organisation_name_0'];
                $academic_data['designation'][]= $user_data['designation_0'];
                $academic_data['from_date'][]= $user_data['from_year_0'];
                $academic_data['to_date'][]= $user_data['to_year_0'];
                /*$academic_data['from_date'] = date("Y-m-d",strtotime($user_data['from_year_0']));
                $academic_data['to_date'] = date("Y-m-d",strtotime($user_data['to_year_0']));*/
                $academic_data['work_experience'][]= $user_data['work_experience_0'];
                $academic_data['work_exp_in_months']= $user_data['total_work_experience'];  

                
                $academic_data['prof_exp_ids'][]= $user_data['prof_exp_id_1'];
                $academic_data['org_name'][]= $user_data['organisation_name_1'];
                $academic_data['designation'][]= $user_data['designation_1'];
                $academic_data['from_date'][]= $user_data['from_year_1'];
                $academic_data['to_date'][]= $user_data['to_year_1'];
                $academic_data['work_experience'][]= $user_data['work_experience_1'];

                $academic_data['prof_exp_ids'][]= $user_data['prof_exp_id_2'];
                $academic_data['org_name'][]= $user_data['organisation_name_2'];
                $academic_data['designation'][]= $user_data['designation_2'];
                $academic_data['from_date'][]= $user_data['from_year_2'];
                $academic_data['to_date'][]= $user_data['to_year_2'];
                $academic_data['work_experience'][]= $user_data['work_experience_2'];

                $academic_data['prof_exp_ids']= json_encode($academic_data['prof_exp_ids']);
                $academic_data['org_name']= json_encode($academic_data['org_name']);
                $academic_data['designation']= json_encode($academic_data['designation']);
                $academic_data['from_date']= json_encode($academic_data['from_date']);
                $academic_data['to_date']= json_encode($academic_data['to_date']);
                $academic_data['work_experience']= json_encode($academic_data['work_experience']);

                $academic_data['created_by']=$created_updated_by;
                $academic_data['updated_by']=$created_updated_by;
                

                /*$academic_data['prof_exp_ids'][]= $user_data['prof_exp_id_2'];
                $academic_data['org_name'][]= $user_data['organisation_name_2'];
                $academic_data['designation'][]= $user_data['designation_2'];
                $academic_data['from_date'] = date("Y-m-d",strtotime($user_data['from_year_2']));
                $academic_data['to_date'] = date("Y-m-d",strtotime($user_data['to_year_2']));
                $academic_data['work_experience'][]= $user_data['work_experience_2'];*/

                /*$academic_data['org_name'][]= json_encode($user_data['organisation_name_2']);
                $academic_data['designation'][]= json_encode($user_data['designation_2']);
                $academic_data['from_date'][]= json_encode($user_data['from_year_2']);
                $academic_data['to_date'][]= json_encode($user_data['to_year_2']);
                $academic_data['work_experience'][]= json_encode($user_data['work_experience_2']);*/

                
                /*Professional Det*/
                $api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls['mtechresearch_acdemic_dtl'];
                $method = 'POST';    
                //$userdata = $this->session_userdata();
                $userdata = $this->user_details_data;
                $academic_data['userdata'] = $userdata;
                list($result_token,$data) = $this->_check_token($academic_data);
                /*print_r($data);
                echo $url;
                die;*/
                if($result_token['valid']=='true')
                {
                    $result = $this->call_api ( $url , $method , $data );
                    $return = $this->json_return($result);
                    return $return;
                }

            }
            /*Academic Details*/

            /*Upload Start*/
            if($user_data['currentIndex']==5)
            {
                $url = $api_urls[ 'upload_final_step' ];
                $method = "POST";
                // Get 
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['app_form_id'] = APP_FORM_ID_MTECH_RESEARCH;
                $user_data['is_notfinal']=1;
                $user_data['user_details_data'] = $this->user_details_data['user_details']['data'][0];
                // Call API
                $data = $this->call_api($url,$method,$user_data);

                $return = $this->json_return($data);
                return $return; 
            }
            /*Upload End*/

            /*Declaration*/
            if($user_data['currentIndex']==6){
                $url = $api_urls[ 'mtechresearch_declaration_dtl' ];
                $method ='POST';
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
                //$userdata = $this->session_userdata();
                $userdata = $this->user_details_data;
                $user_data['userdata'] = $userdata;
                list($result_token,$data) = $this->_check_token($user_data);

                if($result_token['valid']=='true')
                {   
                    $data = $this->call_api($url,$method,$data);
                    $return = $this->json_return($data);
                    return $return;
                };             
            }
            /*Declaration*/
        }
        else
        {
            /* result_appicant start */
            $applicant_list = $result_appicant['data'];
            $this->data['result_appicant'] = $applicant_list;
            /* result_appicant start */
            //echo $applicant_id;
            //echo APP_FORM_ID_MTECH_RESEARCH;
            $applicantformdtl_id = array('applicant_personal_det_id' => $applicant_id , 
                'applicant_form_id' => $app_form_id_mtech_research );

            /* applicant_appln_details_list start */
            $applicant_appln_details = $this->_get_applicant_tables($applicantformdtl_id, 'db_func_appln_detail');
            $this->data['applicant_appln_details_list'] = $applicant_appln_details;
            /* applicant_appln_details_list end */
            

            /*Form Index Restriction Start*/
            $wizard_dt = $this->_get_wizard_details(APP_FORM_ID_MTECH_RESEARCH);
            $applnform_wizard_id = $applicant_appln_details[0]['form_w_wizard_id'];
            $get_appln_wizard_dtl = $this->_get_appln_wizard_details($applnform_wizard_id);
            $this->data['wizard_dt']=$wizard_dt;
            $this->data['appln_wizard_dt']=$get_appln_wizard_dtl;
            /*Form Index Restriction End*/

            $applicant_applnid = $applicant_appln_details[0]['applicant_appln_id']; 

            

            $applicantapplndtl_id = array('applicant_personal_det_id' => $applicant_id , 'applicant_appln_id' => $applicant_applnid );
            
            /* applicant_other_details_list start */
            $applicant_other_details = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_other_detail');
            $this->data['applicant_other_details_list'] = $applicant_other_details[0];
            /* applicant_other_details_list end */


            /* applicant_basic_details_list start */
            $applicant_basic_details = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_basic_detail');
            $this->data['applicant_basic_details_list'] = $applicant_basic_details[0];
            /* applicant_basic_details_list end */

             /* applicant_address_details_list start */
             $applicant_address_details = $this->_get_applicant_tables($applicantapplndtl_id,'db_func_address_detail');
             $this->data['applicant_address_details_list'] = $applicant_address_details[0];
             /* applicant_address_details_list end */

             // $applicant_prof_exps_list = $this->_get_applicant_tables($applicant_id, 'applicant_prof_exps');
            $applicant_prof_exps = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_exp_detail');
            // echo '<pre>applicant_prof_exps_list => ';
            // print_r($applicantapplndtl_id);
            // print_r($applicant_prof_exps);
            // echo '</pre>';
            $this->data['applicant_prof_exps_list'] = $applicant_prof_exps;
            /* applicant_prof_exps_list end */           


            /* applicant_graduations_list start */
            // $applicant_graduations_list = $this->_get_applicant_tables($applicant_id, 'applicant_graduations');
            $applicant_graduations = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_grad_detail');
            $this->data['applicant_graduations_list'] = $applicant_graduations;
            /* applicant_graduations_list end */             


            /* applicant_doc_details_list start */
            // $applicant_doc_details_list = $this->_get_applicant_tables($applicant_id, 'applicant_doc_details');
            $applicant_doc_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_doc_detail');
            $this->data['applicant_doc_details_list'] = $applicant_doc_details_list;
            /* applicant_doc_details_list end */

            /* applicant_campus_prefer_details_list start */
            $applicant_campus_prefer_details = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_campus_prefer_detail');
            // echo '<pre>applicant_campus_prefer_details => ';
            // print_r($applicantapplndtl_id);
            // print_r($applicant_campus_prefer_details);
            // echo '</pre>';
            $this->data['applicant_campus_prefer_details_list'] = $applicant_campus_prefer_details;
            /* applicant_campus_prefer_details_list end */

            /* applicant_course_prefer_details_list start */
            $applicant_course_prefer_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_course_prefer_detail');
            // echo '<pre>applicant_campus_prefer_details => ';
            // print_r($applicantapplndtl_id);
            // print_r($applicant_course_prefer_details_list);
            // echo '</pre>';
            $this->data['applicant_course_prefer_details_list'] = $applicant_course_prefer_details_list;
            /* applicant_course_prefer_details_list end */
            
            /* applicant_parent_details_list start */
            $applicant_parent_details = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_parent_detail');
            $this->data['applicant_parent_details_list'] = $applicant_parent_details;
			
			$payment_details_list = $this->_get_applicant_tables($applicantapplndtl_id, 'db_func_payment_detail');
            $this->data['payment_details_list'] = $payment_details_list[0]; 
			
            /*Get Instruction Start*/
            $arr_wizard_id = array(FORM_WIZARD_BASIC_ID,FORM_WIZARD_PERSONAL_ID,FORM_WIZARD_PARENT_ADDRESS_ID,FORM_WIZARD_ACADEMIC_ID,FORM_WIZARD_PAYMENT_ID,FORM_WIZARD_UPLOAD_ID,FORM_WIZARD_DECLARATION_ID,
            );
            foreach($arr_wizard_id as $k=>$v) {
                $applicant_instructions_list = $this->_get_applicant_tables(array('appln_form_id'=>$app_form_id_mtech_research,'wizard_id'=>$v), 'db_func_instruction');
                $this->data['applicant_instructions_list'][$v] = $applicant_instructions_list;      
            }
            /*Get Instruction End*/


            /* applicant_coordinator_det start */
            $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'singlecoordinator' ];
            $url .= '/'.$applicant_applnid;
            $method = 'GET';
            //$userdata = $this->session_userdata();
            $userdata = $this->user_details_data;
            $data['userdata'] = $userdata;
            list($result_token,$data) = $this->_check_token($data);
            if($result_token['valid']=='true')
            {
                $result = $this->call_api ( $url , $method , $data );
            }
            $coordinator_list = $result['data'];
            //print_r($coordinator_list);
            //die;
            $this->data['applicant_coordinator_list'] = $coordinator_list[0];

             /* applicant_coordinator_det start */

            //print_r($applicant_basic_details);
            //die;



            $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'upload_filelist' ];
            $url .= '/?fk_id='.$applicant_id.'&fk1_id='.$app_form_id_mtech_research;
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
            

            $this->data['form_wizard'] = true;
            $this->data['sidebar'] = 'icon';
            $this->data['logged_applicant_id']=$applicant_id;
            $this->data['logged_applicant_login_id']=$applicant_login_id;
            $this->data['user_data'] = $this->user_details_data['user_details']['data'][0];
            $this->data['personal_detail_list'] = $this->personal_detail_list($applicant_id);
            $this->data['site_title'] = $this->data['page_title'] = 'M.Tech Research Application Form';
            if($view_type == 'preview') {
                $this->data['site_title'] = $this->data['page_title'] = 'M.Tech Research Application Form Preview';
                $this->template('applications/form_mtechresearch_preview', $this->data, true);
            } else {
                //redirect to dashboard after appln completion
            if($applicant_appln_details){
                     $application_status_id=$applicant_appln_details[0]['application_status_id'];
                     if(!empty($application_status_id) && $application_status_id!=APPLICATION_IN_PROGRESS && $mode == ''){
                         redirect(base_url());
                     }
            }
            //End: redirect to dashboard after appln completion
                $this->template('applications/form_mtechresearch', $this->data, true);
            }
        }
        
    }

    /**
     * get active Mtech Campus list by API call
     *
     * @return show API json response
     * @author
     */

    public function get_mtechrecampus_preference(){
        parent::_get_mtechrecampus_preference(false, $this->is_admin);
    }


    /**
     * get active Mtech Specialization list by API call
     *
     * @return show API json response
     * @author
     */

    public function get_mtechrespecialization_preference(){
        parent::_get_mtechrespecialization_preference(false, $this->is_admin);
    }


    /**
     * get active Mtech Religion list by API call
     *
     * @return show API json response
     * @author
     */

    public function get_mtechrereligion(){
        parent::_get_mtechrereligion(false, $this->is_admin);
    }

    /**
     * get active Mtech Mother tongue list by API call
     *
     * @return show API json response
     * @author
     */

    public function get_mtechremothertong(){
        parent::_get_mtechremothertong(false, $this->is_admin);
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

    public function get_appcourses()
    {
        parent::_get_appcourses(false, $this->is_admin);
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
}
