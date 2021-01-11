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

class Afih extends FrontendController
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
        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $CI =& get_instance();
        $this->load->helper('cookie');
		$this->application_year = date("Y");
		//$this->user_details_data = $this->session->userdata('user_details_data');
    }
	
    public function afih_form($mode = false , $applicant_login_id = false , $applicant_personal_det_id = false) { 
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
        $get_form_id = APP_FORM_ID_AFIH;
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
            $userdata = $this->user_details_data;
            $user_data['userdata'] = $userdata;
            //set form id app_form_id
            $user_data['app_form_id']=APP_FORM_ID_AFIH;
            $app_form_id=APP_FORM_ID_AFIH;
            
            // Basic Details Start
            if($user_data['currentIndex']==0){
                // Basic Details API & Method
                $url = $api_urls[ 'afih_basic_detail' ];
                $userdata = $this->user_details_data;
                $user_data['userdata'] = $userdata;
                
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
            //preference and personal detail
            
            if($user_data['currentIndex']==1){
                // Personal Details API & Method
                $url = $api_urls[ 'afih_personal_detail' ];
                $userdata = $this->user_details_data;
                $user_data['userdata'] = $userdata;
                // Get Personal ApplicaNT ID
                $user_data['applicant_personal_det_id'] = $applicant_id;
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
            //preference and personal detail end
            
            //parent start
            if($user_data['currentIndex']==2){
                $url = $api_urls[ 'afih_parent_detail' ];
                $userdata = $this->user_details_data;
                $user_data['userdata'] = $userdata;
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
                $user_data['father_other_occupation'] = $user_data['father_other_occupation'];
                
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
                $user_data['mother_other_occupation'] = $user_data['mother_other_occupation'];
                
                // Guardian Detail
                $user_data['parent_type_guardian_id'] = PARENT_TYPE_ID_GUARDIAN;
                $user_data['add_guardian_details'] = $user_data['add_guardian2_checkbox'];
                $user_data['guardian_parent_det_id'] = $user_data['pd_guardian_id'];
                $user_data['parent_guardian_name'] = $user_data['pd_guardian_name'];
                $user_data['guardian_mob_country_code_id'] = $user_data['pd_guardian_phone_no_code'];
                $user_data['guardian_mobile_no'] = $user_data['pd_guardian_phone'];
                $user_data['guardian_alt_mob_country_code_id'] = $user_data['pd_guardian_alt_phone_no_code'];
                $user_data['guardian_email_id'] = $user_data['pd_guardian_email'];
                $user_data['guardian_occupation'] = $user_data['pd_guardian_occupation'];
                $user_data['guardian_other_occupation'] = $user_data['guardian_other_occupation'];
                $user_data['guardian_relation1'] = $user_data['guardian_relation1'];
                
                //secondary guardian
                $user_data['parent_type_guardian2_id'] = PARENT_TYPE_ID_GUARDIAN;                
                $user_data['guardian2_parent_det_id'] = $user_data['pd_guardian2_id'];
                $user_data['parent_guardian_name2'] = $user_data['pd_guardian_name2'];
                $user_data['guardian_mob_country_code_id2'] = $user_data['pd_guardian_phone_no_code2'];
                $user_data['guardian_mobile_no2'] = $user_data['pd_guardian_phone2'];
                $user_data['guardian_email_id2'] = $user_data['pd_guardian_email2'];
                $user_data['guardian_occupation2'] = $user_data['pd_guardian_occupation2'];
                $user_data['guardian_other_occupation2'] = $user_data['guardian_other_occupation2'];
                $user_data['guardian_relation2'] = $user_data['guardian_relation2'];
                
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
                $url = $api_urls[ 'afih_addressdet' ];
                $method = 'POST';
                $userdata = $this->user_details_data;
                $user_data['userdata'] = $userdata;
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['applicant_login_id'] = $applicant_login_id;
                $user_data['app_form_id'] = $app_form_id;
                list($result_token,$data) = $this->_check_token($user_data);
                if($result_token['valid']=='true')
                {
                    $result = $this->call_api ( $url , $method , $data );
                    $response = array("status"=>$result['status'],"message"=> $result['message']);
                    $return = $this->json_return($response);
                    return $return;
                    
                }
            }
            //address end
            
            // Academic Details
            if($user_data['currentIndex']==4){
                $api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls[ 'afih_academicdet' ];
                $method = 'POST';
                
                $user_data['applicant_id'] = $applicant_id;
                $user_data['applicant_personal_det_id'] = $applicant_id;
                
                $user_data['qual_status_id'] = $user_data['education_qual_status'];
                $user_data['name_as_in_marksheet'] = $user_data['candidate_name'];
                $user_data['education_qual_status'] = $user_data['education_qual_status'];
               
                // Tenth Academic
                $user_data['schooling_id_tenth'] = $user_data['schooling_id_tenth'];
                $user_data['institute_name_tenth'] = $user_data['academic_tenth_inst'];
                $user_data['board_tenth'] = $user_data['academic_tenth_board'];
                $user_data['marking_scheme_tenth'] = ($user_data['academic_tenth_msv']!='null') ? $user_data['academic_tenth_msv'] :'';
                $user_data['cgpa_tenth'] = ($user_data['academic_tenth_cgpa']!='null') ? $user_data['academic_tenth_cgpa']:'';
                $user_data['yr_of_passing_tenth'] = $user_data['academic_tenth_yrp'];
                $user_data['roll_no_tenth'] = $user_data['academic_tenth_regno'];
                $user_data['digilocker_id']=$user_data['digilocker_id'];
                
                if($user_data['academic_tenth_board']==OTHER_BOARD){
                    $user_data['other_tenth_board'] = $user_data['other_tenth_board'];
                }
                
                // Twelfth Academic
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
                
                //ug
                $user_data['ug_completed'] = 't';
                $user_data['graduation_id_ug'] = $user_data['graduation_id_ug'];
                $user_data['institute_name_ug'] = $user_data['institute_name_ug'];
                $user_data['university_ug'] = $user_data['university_ug'];
                $user_data['university_other_ug'] = $user_data['university_other_ug'];
                $user_data['yr_passing_ug'] = $user_data['yr_passing_ug'];
                $user_data['register_no_ug'] = $user_data['register_no_ug'];
                $user_data['crri_comp_date'] = $user_data['crri_comp_date'];
                $user_data['reg_date'] =  $user_data['reg_date'];
                if(!empty($user_data['crri_comp_date'])){
                    $crri_comp_date=$this->convertDate($user_data['crri_comp_date']);
                    $user_data['crri_comp_date'] = $crri_comp_date;
                }
                if(!empty($user_data['reg_date'])){
                    $reg_date=$this->convertDate($user_data['reg_date']);
                    $user_data['reg_date'] = $reg_date;
                }
                /*Other Det*/
                $is_work_experience= $user_data['is_work_experience'];
                $user_data['is_work_experience']= ($is_work_experience=='no')?'f':'t';
                /*Other Det*/
                /*Professional Det*/
                
                $user_data['prof_exp_ids'][]= $user_data['prof_exp_id_0'];
                $user_data['org_name'][]= $user_data['organisation_name_0'];
                $user_data['designation'][]= $user_data['designation_0'];
                $user_data['job_nature'][] = $user_data['job_nature_0'];
                $user_data['month_salary'][] = $user_data['total_salary_month_0'];
                $user_data['from_date'][]= $user_data['from_year_0'];
                $user_data['to_date'][]= $user_data['to_year_0'];
                $user_data['work_exp_in_month'][]= $user_data['work_experience_0'];
                $user_data['total_work_exp']= $user_data['total_work_experience'];
                
                
                $user_data['prof_exp_ids'][]= $user_data['prof_exp_id_1'];
                $user_data['org_name'][]= $user_data['organisation_name_1'];
                $user_data['designation'][]= $user_data['designation_1'];
                $user_data['job_nature'][] = $user_data['job_nature_1'];
                $user_data['month_salary'][] = $user_data['total_salary_month_1'];
                $user_data['from_date'][]= $user_data['from_year_1'];
                $user_data['to_date'][]= $user_data['to_year_1'];
                $user_data['work_exp_in_month'][]= $user_data['work_experience_1'];
                
                $user_data['prof_exp_ids'][]= $user_data['prof_exp_id_2'];
                $user_data['org_name'][]= $user_data['organisation_name_2'];
                $user_data['designation'][]= $user_data['designation_2'];
                $user_data['job_nature'][] = $user_data['job_nature_2'];
                $user_data['month_salary'][] = $user_data['total_salary_month_2'];
                $user_data['from_date'][]= $user_data['from_year_2'];
                $user_data['to_date'][]= $user_data['to_year_2'];
                $user_data['work_exp_in_month'][]= $user_data['work_experience_2'];
                
                $user_data['prof_exp_ids']= json_encode($user_data['prof_exp_ids']);
                $user_data['org_name']= json_encode($user_data['org_name']);
                $user_data['designation']= json_encode($user_data['designation']);
                $user_data['job_nature'] = json_encode($user_data['job_nature']);
                
                $user_data['month_salary'] = json_encode($user_data['month_salary']);
                $user_data['from_date']= json_encode($user_data['from_date']);
                $user_data['to_date']= json_encode($user_data['to_date']);
                $user_data['work_exp_in_month']= json_encode($user_data['work_exp_in_month']);
                /*Professional Det end*/ 
                $user_data['is_employed']= $user_data['is_employed'];
                list($result_token,$data) = $this->_check_token($user_data);
                if($result_token['valid']=='true')
                {
                    // Call API
                    $data = $this->call_api($url,$method,$user_data);
                    $return = $this->json_return($data);
                    return $return;
                }
                //end academic
            }
            
            //declaration
            if($user_data['currentIndex']==6){
                $url = $api_urls[ 'afih_declaration' ];
                $userdata = $this->user_details_data;
                $user_data['userdata'] = $userdata;
                
                // Get Personal Applicant ID
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['applicant_name'] = $user_data['applicant_name'];
                $user_data['parent_name'] = $user_data['parent_name'];
                if(!empty($user_data['declaration_date'])){
                    $declaration_date=$this->convertDate($user_data['declaration_date']);
                    $user_data['declaration_date'] = $declaration_date;
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
            $wizard_dt = $this->_get_wizard_details(APP_FORM_ID_AFIH);
            $applnform_wizard_id = $applicant_application_details_list[0]['form_w_wizard_id'];
            $get_appln_wizard_dtl = $this->_get_appln_wizard_details($applnform_wizard_id);
            $this->data['wizard_dt']=$wizard_dt;
            $this->data['appln_wizard_dt']=$get_appln_wizard_dtl;
            /*Form Index Restriction End*/
            
            // $applicant_appln_id=$applicant_application_details_list[0]['applicant_appln_id'];
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
               
                $qualifications = $this->_get_qualifications('fn_get_app_qualifications');
                $this->data['qualifications'] = $qualifications;
                
                // $applicant_prof_exps_list = $this->_get_applicant_tables($applicant_id, 'applicant_prof_exps');
                $applicant_prof_exps = $this->_get_applicant_tables($condArr, 'db_func_exp_detail');
                $this->data['applicant_prof_exps_list'] = $applicant_prof_exps;
                /* applicant_prof_exps_list end */
                
              
            }
            
            // Get Instruction Wizard
            $arr_wizard_id = array(FORM_WIZARD_BASIC_ID,FORM_WIZARD_PERSONAL_ID,FORM_WIZARD_PARENT_ID,FORM_WIZARD_ADDRESS_ID,FORM_WIZARD_ACADEMIC_ID,FORM_WIZARD_PAYMENT_ID,FORM_WIZARD_UPLOAD_DECLARATION_ID);
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
            $this->data['site_title'] = $this->data['page_title'] = AFIH_TITLE;
            $this->template('applications/form_afih', $this->data, true);
        }
    }
    public function afih_preview($mode = false , $applicant_login_id = false , $applicant_personal_det_id = false) {
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
        $get_form_id = APP_FORM_ID_AFIH;
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
               // redirect(base_url());
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
            $grad_id=$applicant_application_details_list[0]['grad_id'];
            $grad_id=isset($grad_id)?$grad_id:'1';
            $qualification_list = $this->_get_qualification(array('grad'=>$grad_id,'form_id'=>$get_form_id),'db_func_qualification_status');
            $this->data['qualification_list'] = $qualification_list;
            
            // $applicant_prof_exps_list = $this->_get_applicant_tables($applicant_id, 'applicant_prof_exps');
            $applicant_prof_exps = $this->_get_applicant_tables($condArr, 'db_func_exp_detail');
            $this->data['applicant_prof_exps_list'] = $applicant_prof_exps;
            
            /* applicant_prof_exps_list end */
            $qualifications = $this->_get_qualifications('fn_get_app_qualifications');
            $this->data['qualifications'] = $qualifications;
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
        $this->data['site_title'] = $this->data['page_title'] = AFIH_TITLE.' Preview';
        /* applicant_address_details_list end */
        
        // Display page with the template function from REST_Controller
        $this->template('applications/afih_preview', $this->data, true);
    }
    public function get_studied_from_india() {
        parent::_get_studied_from_india(false, $this->is_admin);
    }


	public function get_schooling_details()
    {
		$this->is_exists_user_logged();
        $applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];
        $applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];
        // Get Form ID
        $get_form_id = APP_FORM_ID_AFIH;
        // Get Applicant ID
        $applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);
        $applicant_appln_id = $applicant_appln_det['id'];		
		$get_schooling_details = $this->get_schooling_id($applicant_id,$applicant_appln_id);
		
		if($get_schooling_details['data'][0]['schooling_id']){
			$applicant_scl_det_id = $get_schooling_details['data'][0]['applicant_scl_det_id'];
			$this->output->set_content_type('application/json')->set_output(json_encode($get_schooling_details));
			$returnResponse = $this->output->get_output();
			return $returnResponse;			
		}
    }
    
    public function get_relationship_types()
    {
        parent::_get_relationship_types(false, $this->is_admin);
    }
    	
}
