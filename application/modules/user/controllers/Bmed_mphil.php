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

class Bmed_mphil extends FrontendController
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
        //
        parent::__construct();
        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $CI =& get_instance();
        $this->load->helper('cookie');
        $this->application_year = date("Y");
       // $this->user_details_data = $this->session->userdata('user_details_data');
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
    
    public function Bmed_mphil_form($mode = false , $applicant_login_id = false , $applicant_personal_det_id = false) {   
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
        $get_form_id = APP_FORM_ID_BMED_MPHIL;
        // Get Applicant ID
        $applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);
        $applicant_appln_id = $applicant_appln_det['id'];        
        
        if ( $this->input->post () ){
            $user_data = $this->input->post();
            $user_data['created_by']=$created_updated_by;
            $user_data['updated_by']=$created_updated_by;
            $api_urls = $this->config->item ( 'api_urls' );
            // Method Type
            $method = 'POST';
            //set form id app_form_id
            $user_data['app_form_id']=APP_FORM_ID_BMED_MPHIL;
            $app_form_id=APP_FORM_ID_BMED_MPHIL;
            //$userdata = $this->session_userdata();
            $userdata = $this->user_details_data;
            $user_data['userdata'] = $userdata;
            // Basic Details Start
            if($user_data['currentIndex']==0){ 
                // Basic Details API & Method
                $url = $api_urls[ 'bmed_basic_detail' ];
                // Get Personal Applicant ID
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['qualifyingexamfromindia'] = $user_data['studied_from_india'];
                $user_data['is_agree'] = $user_data['i_confirm'];
                $user_data['appln_status'] = $user_data['appln_status'];
                $user_data['applicant_appln_id'] = !empty($applicant_appln_id) ? $applicant_appln_id :$user_data['applicant_appln_id'];
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
            //basic detail end
            
            //course and personal detail
            
            if($user_data['currentIndex']==1){
                // Personal Details API & Method
                $url = $api_urls[ 'bmed_personal_detail' ];
                // Get Personal ApplicaNT ID
                $user_data['applicant_personal_det_id'] = $applicant_id;
                // $user_data['course_prefer_id'] = 1;
                $user_data['grad_id'] = is_numeric($user_data['pd_program'])?$user_data['pd_program'] : NULL;
                $user_data['course_pref'] = $user_data['course_pref_1'];
                $user_data['course_choice_no'] = $user_data['course_choice_no_1'];
                $user_data['course_prefer_id_1'] = $user_data['course_prefer_id_1'];
               
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
                $url = $api_urls[ 'bmed_parent_detail' ];
                
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
                $url = $api_urls[ 'bmed_addressdet' ];
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
                $api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls[ 'bmed_academicdet' ];
                $method = 'POST';                
                $user_data['applicant_id'] = $applicant_id;
                $user_data['current_qualification_status'] = $user_data['current_qualification_status'];
                $cur_qual_completed = $user_data['current_qualification_status'];
                $curr_qualify_ug='t';
                $curr_qualify_pg='t';
                if($cur_qual_completed=="pg_pur" || $cur_qual_completed=="pg_pass"){
                 $curr_qualify_ug='f';
                }
                if($cur_qual_completed=="ug_pur" || $cur_qual_completed=="ug_pass"){
                    $curr_qualify_pg='f';
                }
                $user_data['curr_qualify_ug'] = $curr_qualify_ug;
                $user_data['curr_qualify_pg'] = $curr_qualify_pg;
                
                $user_data['cur_qual_completed'] = ($cur_qual_completed=="ug_pass" || $cur_qual_completed=="pg_pass" )?'t':'f';
                $user_data['name_as_in_marksheet'] = $user_data['candidate_name'];
                
                // Tenth Academic                
                $user_data['cur_qual_completed_tenth'] = 't';
                $user_data['schooling_id_tenth'] = $user_data['schooling_id_tenth'];
                $user_data['institute_name_tenth'] = $user_data['academic_tenth_inst'];
                $user_data['board_tenth'] = $user_data['academic_tenth_board'];
                $user_data['marking_scheme_tenth'] = ($user_data['academic_tenth_msv']!='null') ? $user_data['academic_tenth_msv'] :'';
                $user_data['cgpa_tenth'] = ($user_data['academic_tenth_cgpa']!='null') ? $user_data['academic_tenth_cgpa']:'';
                $user_data['yr_of_passing_tenth'] = $user_data['academic_tenth_yrp'];
                $user_data['roll_no_tenth'] = $user_data['academic_tenth_regno'];
                
                
                if($user_data['academic_tenth_board']==OTHER_BOARD){
                    $user_data['other_tenth_board'] = $user_data['other_tenth_board'];
                }
                
                // Twelfth Academic
                //$user_data['cur_qual_completed_twelfth'] = ($current_education_qual_status==1)?'t':'f';
                $user_data['cur_qual_completed_twelfth'] ='t';
                $user_data['schooling_id_twelfth'] = $user_data['schooling_id_twelfth'];
                $user_data['institute_name_twelfth'] = $user_data['academic_twelfth_inst'];
                $user_data['board_twelfth'] = $user_data['academic_twelfth_board'];
                $user_data['marking_scheme_twelfth'] = ($user_data['academic_twelfth_msv']!='null')? $user_data['academic_twelfth_msv'] :'';
                $user_data['cgpa_twelfth'] = ($user_data['academic_twelfth_cgpa']!='null') ? $user_data['academic_twelfth_cgpa'] :'';
                $user_data['yr_of_passing_twelfth'] = $user_data['academic_twelfth_yrp'];
                $user_data['roll_no_twelfth'] = $user_data['academic_twelfth_regno'];
                
                
                if($user_data['other_twelfth_board']==OTHER_BOARD){
                    $user_data['other_twelfth_board'] = $user_data['other_twelfth_board'];
                }
                $user_data['stream_name'] = $user_data['stream_name'];
                $user_data['other_stream_name'] = $user_data['other_stream_name'];
                
                //ug
                $user_data['ug_completed'] =($cur_qual_completed=="ug_pass")?'t':'f';
                $user_data['graduation_id_ug'] = $user_data['grad_id_ug'];
                $user_data['institute_name_ug'] = $user_data['institute_name_ug'];
                $user_data['university_ug'] = $user_data['university_ug'];
                $user_data['university_other_ug'] = $user_data['university_other_ug'];
                $user_data['marking_scheme_ug'] = ($user_data['marking_scheme_ug']!='null')? $user_data['marking_scheme_ug'] :'';
                $user_data['obtained_percentage_cgpa_ug'] = ($user_data['obtained_percentage_cgpa_ug']!='null') ? $user_data['obtained_percentage_cgpa_ug'] :'';
                $user_data['yr_passing_ug'] = $user_data['yr_passing_ug'];
                $user_data['register_no_ug'] = $user_data['register_no_ug'];
                $user_data['degree_ug'] = $user_data['degree_ug'];
                //pg
                //ug
                $user_data['pg_completed'] =($cur_qual_completed=="pg_pass")?'t':'f';
                $user_data['graduation_id_pg'] = $user_data['grad_id_pg'];
                $user_data['institute_name_pg'] = $user_data['institute_name_pg'];
                $user_data['university_pg'] = $user_data['university_pg'];
                $user_data['university_other_pg'] = $user_data['university_other_pg'];
                $user_data['marking_scheme_pg'] = ($user_data['marking_scheme_pg']!='null')? $user_data['marking_scheme_pg'] :'';
                $user_data['obtained_percentage_cgpa_pg'] = ($user_data['obtained_percentage_cgpa_pg']!='null') ? $user_data['obtained_percentage_cgpa_pg'] :'';
                $user_data['yr_passing_pg'] = $user_data['yr_passing_pg'];
                $user_data['register_no_pg'] = $user_data['register_no_pg'];
                $user_data['degree_pg'] = $user_data['degree_pg'];                
                
                $user_data['digilocker_id']=$user_data['digilocker_id'];
                list($result_token,$data) = $this->_check_token($user_data);
                if($result_token['valid']=='true')
                {
                    // Call API
                    $data = $this->call_api($url,$method,$user_data);
                    $return = $this->json_return($data);
                    return $return;
                }
            }
            //end academics
            
            //Upload start
            if($user_data['currentIndex']==6){
                // Academic Details API & Method
                $url = $api_urls[ 'upload_final' ];
                $method = "POST";
                // Get
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['app_form_id'] = APP_FORM_ID_BMED_MPHIL;
                $user_data['upload_id'] = FORM_WIZARD_UPLOAD_ID;
                $user_data['is_notfinal'] = 1;
                
                $user_data['user_details_data'] = $this->user_details_data['user_details']['data'][0];
                // Call API
                $data = $this->call_api($url,$method,$user_data);
                $return = $this->json_return($data);
                return $return;
            }
            
            //declaration
            if($user_data['currentIndex']==7){
                $url = $api_urls[ 'bmed_declaration' ];                
                // Get Personal Applicant ID
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['applicant_name'] = $user_data['applicant_name'];
                $user_data['parent_name'] = $user_data['parent_name'];                
               // $user_data['declaration_date'] = date("Y-m-d",strtotime($user_data['declaration_date']));
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
            //$userdata = $this->session_userdata();
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
            //check form open close date temporaryly
            $isValidDate=$this->checkValidDate(FORM_OPEN_DATE,FORM_CLOSE_DATE);
            if((empty($isValidDate) || $isValidDate=='') && $this->mode != ADMIN_MODE_EDIT){
                redirect(base_url());
            }
            //redirect to dashboard after appln completion
            if($applicant_application_details_list){
                $application_status_id=$applicant_application_details_list[0]['application_status_id'];
                if(!empty($application_status_id) && $application_status_id!=APPLICATION_IN_PROGRESS && $mode == ''){
                    redirect(base_url());
                }
            }
            //End: redirect to dashboard after appln completion
            
            /*Form Index Restriction Start*/
            $wizard_dt = $this->_get_wizard_details(APP_FORM_ID_BMED_MPHIL);
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
                $this->data['applicant_course_details_list'] = $applicant_course_details_list[0];
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
                $this->data['applicant_schooling_list'] = $applicant_schooling_list;
                //end schooling
                
                // $applicant_graduations_list = $this->_get_applicant_tables($applicant_id, 'applicant_graduations');
                $applicant_graduations_list = $this->_get_applicant_tables($condArr, 'db_func_grad_detail');
                $this->data['applicant_graduations_list'] = $applicant_graduations_list;
                /* applicant_graduations_list end */
                $payment_details_list = $this->_get_applicant_tables($condArr, 'db_func_payment_detail');
                $this->data['applicant_payment_details_list'] = $payment_details_list[0];
                
            }
            // Get Instruction Wizard
            $arr_wizard_id = array(FORM_WIZARD_BASIC_ID,FORM_WIZARD_PERSONAL_ID,FORM_WIZARD_PARENT_ID,FORM_WIZARD_ADDRESS_ID,FORM_WIZARD_ACADEMIC_ID,FORM_WIZARD_PAYMENT_ID,FORM_WIZARD_UPLOAD_ID,FORM_WIZARD_DECLARATION_ID);
            foreach($arr_wizard_id as $k=>$v) {
                $applicant_instructions_list = $this->_get_applicant_tables(array('appln_form_id'=>$get_form_id,'wizard_id'=>$v), 'db_func_instruction');
                $this->data['applicant_instructions_list'][$v] = $applicant_instructions_list;
            }
            
            $this->data['form_wizard'] = true;
            $this->data['sidebar'] = 'icon';
            $this->data['logged_applicant_id']=$applicant_id;
            $this->data['logged_applicant_login_id']=$applicant_login_id;
            $this->data['user_data'] = $this->user_details_data['user_details']['data'][0];
            $this->data['personal_detail_list'] = $this->personal_detail_list($applicant_id);
            $this->data['site_title'] = $this->data['page_title'] = 'B.Ed/M.Ed/M.Phil Application Form';
            $this->template('applications/bm_ed_mphil', $this->data, true);
        }
    }
    
    public function bmed_form_preview($mode = false , $applicant_login_id = false , $applicant_personal_det_id = false) {
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
        $get_form_id = APP_FORM_ID_BMED_MPHIL;
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
              //  redirect(base_url());
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
            $this->data['applicant_course_details_list'] = $applicant_course_details_list[0];
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
            $this->data['applicant_schooling_list'] = $applicant_schooling_list;
            //end schooling
            // $applicant_graduations_list = $this->_get_applicant_tables($applicant_id, 'applicant_graduations');
            $applicant_graduations_list = $this->_get_applicant_tables($condArr, 'db_func_grad_detail');
            $this->data['applicant_graduations_list'] = $applicant_graduations_list;
            /* applicant_graduations_list end */
            $payment_details_list = $this->_get_applicant_tables($condArr, 'db_func_payment_detail');
            $this->data['applicant_payment_details_list'] = $payment_details_list[0];
            
        }
        
        
        
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'upload_filelist' ];
        $url .= '/?fk_id='.$applicant_id.'&fk1_id='.$get_form_id;        
        $method = 'GET';
        //$userdata = $this->session_userdata();
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
        $this->data['site_title'] = $this->data['page_title'] = 'B.Ed/M.Ed/M.Phil Application Form Preview';
        /* applicant_address_details_list end */
        
        // Display page with the template function from REST_Controller
        $this->template('applications/bm_ed_mphil_preview', $this->data, true);
    }
  
    public function bmed_mphil_courses() { 
        $api_urls = $this->config->item ( 'api_urls' );
        $url= $api_urls['bmed_mphil_courses'];
        $is_course=$_GET['is_course'];
        $is_campus=$_GET['is_campus'];
        $grade_id=$_GET['grade_id'];
        $campus_id=$_GET['campus_id'];
        $course_id=$_GET['course_id'];
        $degree_id=$_GET['degree_id'];
        $form_id=$_GET['form_id'];
        $keywords=$_GET['keywords'];
        $ecamp=$_GET['ecamp'];
        $query_data = array();       
        if(!empty($is_course)){
            $query_data['is_course'] = $is_course;
        }
        if(!empty($is_campus)){
            $query_data['is_campus'] = $is_campus;
        }
        if(!empty($grade_id)){
            $query_data['grade_id'] = $grade_id;
        }
        if(!empty($campus_id)){
            $query_data['campus_id'] = $campus_id;
        }
        if(!empty($course_id)){
            $query_data['course_id'] = $course_id;
        }
        
        if(!empty($degree_id)){
            $query_data['degree_id'] = $degree_id;
        }
        if(!empty($form_id)){
            $query_data['form_id'] = $form_id;
        }  
        if(!empty($keywords)){
            $query_data['keywords'] = $keywords;
        } 
        if(!empty($ecamp)){
            $query_data['ecamp'] = $ecamp;
        }
        $query = http_build_query($query_data);
        $url = $url .'?'.$query;
        $method = 'GET';
        
        //$userdata = $this->session_userdata();
        $userdata = $this->user_details_data;
        $user_data['userdata'] = $userdata;
        $user_data['form_id']=APP_FORM_ID_HCMA;
        $user_data['grade']=1;
        list($result_token,$data) = $this->_check_token($user_data);
        if($result_token['valid']=='true')
        {
            // Call API
            $data = $this->call_api($url,$method,$user_data);
            //echo "<pre>";print_r($data);echo "</pre>";
            //echo json_encode($data,true);
            if($data){               
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
                $returnResponse = $this->output->get_output();
                return $returnResponse;
            }
        }
    }
    //new
    public function get_studied_from_india() {
        parent::_get_studied_from_india(false, $this->is_admin);
    }
    
    
    public function get_resident_status() {
        parent::_get_resident_status(false, $this->is_admin);
    }
    public function get_sslc_result_status() {
        parent::_get_sslc_result_status(false, $this->is_admin);
    }
    public function bmed_edu_status() {
        parent::_bmed_edu_status(false, $this->is_admin);
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
        //$userdata = $this->session_userdata();
        $userdata = $this->user_details_data;
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
        //$userdata = $this->session_userdata();
        $userdata = $this->user_details_data;
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
}
