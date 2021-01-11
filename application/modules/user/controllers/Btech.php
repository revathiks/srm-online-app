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

class Btech extends FrontendController
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
    }
	
    public function btech_form($view_type = false , $mode = false , $applicant_login_id = false , $applicant_personal_det_id = false) {
        $this->is_exists_user_logged();
        $app_form_id = APP_FORM_ID_BTECH;
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
            //echo $mode;die;

            $created_updated_by=($mode)?CRM_ADMIN_USER_ROLE_ID:$applicant_id;

            
        if ( $this->input->post () ){	
            $user_data = $this->input->post();
            $api_urls = $this->config->item ( 'api_urls' );
            // Method Type
            $method = 'POST';   
            $user_data['created_by']=$created_updated_by;
            $user_data['updated_by']=$created_updated_by;
            if($user_data['currentIndex']==2)
            {
                $user_data['applicant_personal_det_id'] = $applicant_id;
                // Father Detail
                $user_data['parent_type_father_id'] = PARENT_TYPE_ID_FATHER;
                $user_data['father_parent_det_id'] = $user_data['pd_father_id'];
                $user_data['parent_father_name'] = $user_data['pd_father_name'];
                $pd_father_phone = $user_data['pd_father_phone'];
                if($pd_father_phone != '') {
                    $user_data['father_mobile_no'] = $pd_father_phone;    
                }
                $pd_father_alt_phone = $user_data['pd_father_alt_phone'];
                if($pd_father_alt_phone 
                    != '') {
                    $user_data['father_alt_mobile_no'] = $pd_father_alt_phone;    
                }
                $pd_father_email = $user_data['pd_father_email'];
                if($pd_father_email != '') {
                    $user_data['father_email_id'] = $pd_father_email;    
                }
                $pd_father_occupation = $user_data['pd_father_occupation'];
                if($pd_father_occupation != '') {
                    $user_data['father_occupation'] = $pd_father_occupation;    
                }
                
                $user_data['father_mob_country_code_id'] = $user_data['pd_father_phone_no_code'];
                $user_data['father_alt_mob_country_code_id'] = $user_data['pd_father_alt_phone_no_code'];
                $user_data['father_title'] = $user_data['pd_father_title'];
                
                // Mother Detail
                $user_data['parent_type_mother_id'] = PARENT_TYPE_ID_MOTHER;
                $user_data['mother_parent_det_id'] = $user_data['pd_mother_id'];
                $user_data['parent_mother_name'] = $user_data['pd_mother_name'];
                $pd_mother_phone = $user_data['pd_mother_phone'];
                if($pd_mother_phone != '') {
                    $user_data['mother_mobile_no'] = $pd_mother_phone;    
                }
                $pd_mother_alt_phone = $user_data['pd_mother_alt_phone'];
                if($pd_mother_alt_phone != '') {
                    $user_data['mother_alt_mobile_no'] = $pd_mother_alt_phone;    
                }
                $pd_mother_email = $user_data['pd_mother_email'];
                if($pd_mother_email != '') {
                    $user_data['mother_email_id'] = $pd_mother_email;    
                }
                $pd_mother_occupation = $user_data['pd_mother_occupation'];
                if($pd_mother_occupation != '') {
                    $user_data['mother_occupation'] = $pd_mother_occupation;    
                }
                $user_data['mother_mob_country_code_id'] = $user_data['pd_mother_phone_no_code'];
                $user_data['mother_alt_mob_country_code_id'] = $user_data['pd_mother_alt_phone_no_code'];
                $user_data['mother_title'] = $user_data['pd_mother_title'];
                
                // Guardian Detail
                $user_data['parent_type_guardian_id'] = PARENT_TYPE_ID_GUARDIAN;
                $user_data['add_guardian_details'] = $user_data['add_guardian_checkbox'];
                $add_guardian_checkbox=$user_data['add_guardian_checkbox'];
                if($add_guardian_checkbox==1 || $add_guardian_checkbox==="true" || $add_guardian_checkbox===true)
                {                
                    $user_data['guardian_parent_det_id'] = $user_data['pd_guardian_id'];                
                    $pd_guardian_name = $user_data['pd_guardian_name'];
                    if($pd_guardian_name != '') {
                        $user_data['parent_guardian_name'] = $pd_guardian_name;    
                    }
                    $user_data['guardian_mob_country_code_id'] = $user_data['pd_guardian_phone_no_code'];
                    $user_data['guardian_alt_mob_country_code_id'] = $user_data['pd_guardian_alt_phone_no_code'];
                    $pd_guardian_phone = $user_data['pd_guardian_phone'];
                    if($pd_guardian_phone != '') {
                        $user_data['guardian_mobile_no'] = $pd_guardian_phone;    
                    }
                    $pd_guardian_alt_phone = $user_data['pd_guardian_alt_phone'];
                    if($pd_guardian_alt_phone != '') {
                        $user_data['guardian_alt_mobile_no'] = $pd_guardian_alt_phone;    
                    }
                    $pd_guardian_email = $user_data['pd_guardian_email'];
                    if($pd_guardian_email != '') {
                        $user_data['guardian_email_id'] = $pd_guardian_email;    
                    }
                    $pd_guardian_occupation = $user_data['pd_guardian_occupation'];
                    if($pd_guardian_occupation != '') {
                        $user_data['guardian_occupation'] = $pd_guardian_occupation;    
                    }
                }
                $user_data['father_other_occupation'] = $user_data['father_other_occupation'];
                $user_data['mother_other_occupation'] = $user_data['mother_other_occupation'];
                $user_data['guardian_other_occupation'] = $user_data['guardian_other_occupation'];

                // parent detail
                $api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls[ 'btech_parent_detail' ];
                $method = 'POST';
                //$userdata = $this->session_userdata();
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

                // address detail
                $api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls[ 'addressdet' ];
                $method = 'POST';
                //$userdata = $this->session_userdata();
                 $userdata = $this->user_details_data;
                $user_data['userdata'] = $userdata;
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['applicant_login_id'] = $applicant_login_id;
                $user_data['app_form_id'] = $app_form_id;
                list($result_token,$data) = $this->_check_token($user_data);  
                $addr_response = false;
                if($result_token['valid']=='true')
                {
                    $result = $this->call_api ( $url , $method , $data );
                    $addr_response = array("status"=>$result['status'],"message"=> $result['message']);
                }
                $response = array();
                $response['parent_response'] = $parent_response;
                $response['address_response'] = $addr_response;
                $return = $this->json_return($response);
                return $return;
            }            
					
			// Basic Details Start
			if($user_data['currentIndex']==0){
				// Basic Details API & Method
				$url = $api_urls[ 'btech_basic_detail' ];
                // Get 
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $pd_nationality = $user_data['pd_nationality'];
                if($pd_nationality) {
                    $user_data['nationality_id'] = $pd_nationality;    
                }
                
                // $user_data['applicant_appln_id'] = $user_data['applicant_appln_id'];
                $user_data['is_agree'] = $user_data['i_agree'];
                $studied_from_india = $user_data['studied_from_india'];
                if($studied_from_india) {
                    $user_data['qualifyingexamfromindia'] = $studied_from_india;    
                }
				$user_data['user_details_data'] = $this->user_details_data['user_details']['data'][0];                
				// Call API
                //$userdata = $this->session_userdata();
                 $userdata = $this->user_details_data;
                $user_data['userdata'] = $userdata;
                //print_r($user_data);die;
                list($result_token,$data) = $this->_check_token($user_data);
                if($result_token['valid']=='true')
                {
    				$data = $this->call_api($url,$method,$user_data);
    			
    				//echo json_encode($data,true);
    				$return = $this->json_return($data);
                    return $return;
                }
			}
			// Basic Details End
			
			// Personal Details Start 
			if($user_data['currentIndex']==1){
				// Personal Details API & Method
				$url = $api_urls[ 'btech_personal_detail' ];
				// Get Personal ApplicaNT ID
				$user_data['applicant_personal_det_id'] = $applicant_id;
				$pd_title = $user_data['pd_title'];
                if($pd_title != '') {
                    $user_data['title_id'] = $pd_title;    
                }
				$user_data['first_name'] = $user_data['pd_firstname'];
				$user_data['middle_name'] = $user_data['pd_middlename'];
				$user_data['last_name'] = $user_data['pd_lastname'];
				// $mobile_no_concate_code = $user_data['phone_no_code'].''.$user_data['pd_mobile_no'];
                $user_data['mobile_no_code'] = $user_data['phone_no_code'];
				$user_data['mobile_no'] = $user_data['pd_mobile_no'];
				$user_data['email_id'] = $user_data['pd_email'];
				//$user_data['dob'] = date("Y-m-d",strtotime($user_data['pd_dob']));
                if(!empty($user_data['pd_dob'])){
                    $dob=$this->convertDate($user_data['pd_dob']);
                    $user_data['dob'] = $dob;
                }else{
                    $user_data['dob'] = date("Y-m-d",strtotime($user_data['pd_dob']));
                }
				$user_data['gender_id'] = $user_data['pd_gender'];
				$pd_alt_email = $user_data['pd_alt_email'];
                if($pd_alt_email != '') {
                    $user_data['second_email_id'] = $pd_alt_email;    
                }
                $pd_blood_group = $user_data['pd_blood_group'];
                if($pd_blood_group != '') {
                    $user_data['blood_grp_id'] = $pd_blood_group;    
                }
                $pd_diffrently_abled = $user_data['pd_diffrently_abled'];
                if($pd_diffrently_abled != '') {
                    $pd_diffrently_abled = ($pd_diffrently_abled == 'yes')?'t':'f';
                    $user_data['diff_abled'] = $pd_diffrently_abled;    
                }
                $pd_mother_tongue = $user_data['pd_mother_tongue'];
                if($pd_mother_tongue != '') {
                    $user_data['mothertongue_id'] = $pd_mother_tongue;    
                }
                $pd_advertisement_source = $user_data['pd_advertisement_source'];
                if($pd_advertisement_source != '') {
                    $user_data['advertisement_source_id'] = $pd_advertisement_source;    
                }
                
				$user_data['social_status_id'] = $user_data['pd_social_status'];
                $user_data['religion_id'] = $user_data['pd_religion'];
                $user_data['medofinst'] = $user_data['pd_medium_of_instruction'];
                $pd_hostel_accommodation = $user_data['pd_hostel_accommodation'];
                $user_data['prefer_hostel'] = ($pd_hostel_accommodation == 'yes')?'t':'f';
                
                
                $user_data['course_pref'][0] = $user_data['course_pref_1'];
                $user_data['specialization_pref'][0] = $user_data['specialization_pref_1'];  
                $user_data['course_choice_no'][0] = $user_data['course_choice_no_1'];
                $user_data['course_prefer_id'][0] = $user_data['course_prefer_id_1'];
                $user_data['campus_pref'][0] = $user_data['campus_pref_1'];
                $user_data['campus_choice_no'][0] = $user_data['campus_choice_no_1'];
                $user_data['campus_prefer_id'][0] = $user_data['campus_prefer_id_1'];

                $user_data['course_pref'][1] = $user_data['course_pref_2'];
                $user_data['specialization_pref'][1] = $user_data['specialization_pref_2'];
                $user_data['course_choice_no'][1] = $user_data['course_choice_no_2'];
                $user_data['course_prefer_id'][1] = $user_data['course_prefer_id_2'];
                $user_data['campus_pref'][1] = $user_data['campus_pref_2'];
                $user_data['campus_choice_no'][1] = $user_data['campus_choice_no_2'];
                $user_data['campus_prefer_id'][1] = $user_data['campus_prefer_id_2'];

                $user_data['course_pref'][2] = $user_data['course_pref_3'];
                $user_data['specialization_pref'][2] = $user_data['specialization_pref_3'];
                $user_data['course_choice_no'][2] = $user_data['course_choice_no_3'];
                $user_data['course_prefer_id'][2] = $user_data['course_prefer_id_3'];
                $user_data['campus_pref'][2] = $user_data['campus_pref_3'];
                $user_data['campus_choice_no'][2] = $user_data['campus_choice_no_3'];
                $user_data['campus_prefer_id'][2] = $user_data['campus_prefer_id_3'];

                $user_data['course_pref'] = json_encode($user_data['course_pref']);
                $user_data['course_choice_no'] = json_encode($user_data['course_choice_no']);
                $user_data['course_prefer_id'] = json_encode($user_data['course_prefer_id']);
                $user_data['specialization_pref'] = json_encode($user_data['specialization_pref']);
                $user_data['campus_pref'] = json_encode($user_data['campus_pref']);
                $user_data['campus_choice_no'] = json_encode($user_data['campus_choice_no']);
                $user_data['campus_prefer_id'] = json_encode($user_data['campus_prefer_id']);

                $user_data['state_pref'][0] = $user_data['state_pref_1'];
                $user_data['city_pref'][0] = $user_data['city_pref_1'];
                $user_data['city_choice_no'][0] = $user_data['city_choice_no_1'];
                $user_data['city_prefer_id'][0] = $user_data['city_prefer_id_1'];

                $user_data['state_pref'][1] = $user_data['state_pref_2'];
                $user_data['city_pref'][1] = $user_data['city_pref_2'];
                $user_data['city_choice_no'][1] = $user_data['city_choice_no_2'];
                $user_data['city_prefer_id'][1] = $user_data['city_prefer_id_2'];

                $user_data['state_pref'][2] = $user_data['state_pref_3'];
                $user_data['city_pref'][2] = $user_data['city_pref_3'];
                $user_data['city_choice_no'][2] = $user_data['city_choice_no_3'];
                $user_data['city_prefer_id'][2] = $user_data['city_prefer_id_3'];

                $user_data['state_pref'] = json_encode($user_data['state_pref']);
                $user_data['city_pref'] = json_encode($user_data['city_pref']);
                $user_data['city_choice_no'] = json_encode($user_data['city_choice_no']);
                $user_data['city_prefer_id'] = json_encode($user_data['city_prefer_id']);

				$user_data['user_details_data'] = $this->user_details_data['user_details']['data'][0];

                // echo '<pre>';
                // print_r($url);
                // print_r($method);
                // print_r($user_data);

                // echo '</pre>';
                // die;
                //$userdata = $this->session_userdata();
                 $userdata = $this->user_details_data;
                $user_data['userdata'] = $userdata;
                list($result_token,$data) = $this->_check_token($user_data);
                if($result_token['valid']=='true')
                {
    				// Call API
    				$data = $this->call_api($url,$method,$user_data);
    			
    				//echo json_encode($data,true);
    				$return = $this->json_return($data);
                    return $return;
                }
			}
			
            // Academic Detail
            if($user_data['currentIndex']==3) {
                // Academic Details API & Method
                $url = $api_urls[ 'btech_academic_detail' ];
                // Get Personal ApplicaNT ID
                $user_data['applicant_personal_det_id'] = $applicant_id;

                $current_education_qual_status = $user_data['current_education_qual_status'];
                $user_data['cur_qual_completed'] = ($current_education_qual_status==1)?'f':'t';
                $user_data['result_declared'] = ($current_education_qual_status==1)?'f':'t';
                $user_data['is_curr_qualify'] = ($current_education_qual_status==1)?'f':'t';
                $user_data['name_as_in_marksheet'] = $user_data['tenth_name'];
                $user_data['schooling_id'] = $user_data['schooling_id'];
                $user_data['institute_name'] = $user_data['institute_name'];
                $user_data['board_id'] = $user_data['board'];
                $user_data['mode_of_study_id'] = $user_data['mode_of_study'];
                $user_data['marking_scheme_id'] = $user_data['marking_scheme'];
                $user_data['mark_percentage'] = $user_data['obtained_percentage_cgpa'];
                $user_data['completion_year'] = $user_data['year_of_passing'];
                $user_data['registration_no'] = $user_data['registration_no'];
                $user_data['address'] = $user_data['address_of_school_college'];
                $user_data['digilocker_id'] = $user_data['nad_id_digilocker_id'];
                $user_data['other_board'] = $user_data['other_board'];
                
                //$userdata = $this->session_userdata();
                $userdata = $this->user_details_data;
                $user_data['userdata'] = $userdata;
                list($result_token,$data) = $this->_check_token($user_data);
                if($result_token['valid']=='true')
                {
                    $data = $this->call_api($url,$method,$user_data);
                    $return = $this->json_return($data);
                    return $return;
                }
            }
			if($user_data['currentIndex']==5){
				// Declaration Details API & Method
                $api_urls = $this->config->item ( 'api_urls' );
				$url = $api_urls[ 'btech_declaration_detail' ];
                $method = 'POST';
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
                }
			}
        } else {
            $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'upload_filelist' ];
            $url .= '/?fk_id='.$applicant_id.'&fk1_id='.$app_form_id;
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


            /* choice_dropdown_details_list start */
            // $choice_dropdown_details_list = $this->_get_applicant_tables(array('grad_id'=>1,'deg_id'=>2), 'db_func_choice_dropdown');
            // $this->data['choice_dropdown_details_list'] = $choice_dropdown_details_list;
            /* choice_dropdown_details_list end */

            /* applicant_appln_details_list start */
            $applicant_appln_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_form_id'=>$app_form_id), 'db_func_appln_detail');
            $this->data['applicant_appln_details_list'] = $applicant_appln_details_list[0];
             
            
             /*Form Index Restriction Start*/
            $wizard_dt = $this->_get_wizard_details(APP_FORM_ID_BTECH);
            $applnform_wizard_id = $applicant_appln_details_list[0]['form_w_wizard_id'];
            $get_appln_wizard_dtl = $this->_get_appln_wizard_details($applnform_wizard_id);
            $this->data['wizard_dt']=$wizard_dt;
            $this->data['appln_wizard_dt']=$get_appln_wizard_dtl;
            /*Form Index Restriction End*/

            $applicant_appln_id = $applicant_appln_details_list[0]['applicant_appln_id'];
            /* applicant_appln_details_list end */

            /* applicant_doc_details_list start */
            $applicant_doc_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_id), 'db_func_doc_detail');
            $this->data['applicant_doc_details_list'] = $applicant_doc_details_list;
            /* applicant_doc_details_list end */

            /* applicant_other_details_list start */
            $applicant_other_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_id), 'db_func_other_detail');
            // echo '<pre>applicant_other_details_list ';
            // print_r($applicant_other_details_list);
            // print_r($applicant_appln_details_list);
            // print_r($applicant_appln_id);
            // print_r($applicant_id);
            // echo '</pre>';
            $this->data['applicant_other_details_list'] = $applicant_other_details_list[0];
            /* applicant_other_details_list end */

            /* applicant_basic_details_list start */
            $applicant_basic_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id), 'db_func_basic_detail');
            $this->data['applicant_basic_details_list'] = $applicant_basic_details_list[0];
            /* applicant_basic_details_list end */

            $arr_wizard_id = array(FORM_WIZARD_BASIC_ID,FORM_WIZARD_PREFERENCE_PERSONAL_ID,FORM_WIZARD_PARENT_ADDRESS_ID,FORM_WIZARD_ACADEMIC_ID,FORM_WIZARD_PAYMENT_ID,FORM_WIZARD_DECLARATION_ID,FORM_WIZARD_UPLOAD_ID,FORM_WIZARD_UPLOAD_DECLARATION_ID);
            foreach($arr_wizard_id as $k=>$v) {
                $applicant_instructions_list = $this->_get_applicant_tables(array('appln_form_id'=>$app_form_id,'wizard_id'=>$v), 'db_func_instruction');
                $this->data['applicant_instructions_list'][$v] = $applicant_instructions_list;      
            }
            

            /* applicant_campus_prefer_details_list start */
            $applicant_campus_prefer_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_id), 'db_func_campus_prefer_detail');
            $this->data['applicant_campus_prefer_details_list'] = $applicant_campus_prefer_details_list;
            /* applicant_campus_prefer_details_list end */

            /* applicant_city_prefer_details_list start */
            $applicant_city_prefer_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_id), 'db_func_city_prefer_detail');
            $this->data['applicant_city_prefer_details_list'] = $applicant_city_prefer_details_list;
            /* applicant_city_prefer_details_list end */

            /* applicant_course_prefer_details_list start */
            $applicant_course_prefer_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_id), 'db_func_course_prefer_detail');
            $this->data['applicant_course_prefer_details_list'] = $applicant_course_prefer_details_list;
            /* applicant_course_prefer_details_list end */

            $applicant_appln_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_form_id'=>$app_form_id), 'db_func_appln_detail');
            $this->data['applicant_appln_details_list'] = $applicant_appln_details_list[0];

            /* applicant_parent_details_list start */
            $applicant_parent_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_id), 'db_func_parent_detail');
            // echo '<pre>applicant_parent_details_list ';
            // print_r($applicant_parent_details_list);
            // print_r($applicant_appln_id);
            // print_r($applicant_id);
            // echo '</pre>';
            $this->data['applicant_parent_details_list'] = $applicant_parent_details_list;
            /* applicant_parent_details_list end */



            /* applicant_address_details_list start */
            $applicant_address_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_id), 'db_func_address_detail');
            // echo '<pre>applicant_id';
            // print_r($applicant_id);
            // echo "\n";
            // print_r($applicant_appln_id);
            // print_r($applicant_address_details_list);
            // echo '</pre>';
            $this->data['applicant_address_details_list'] = $applicant_address_details_list;
            /* applicant_address_details_list end */

            /* applicant_schooling_details_list start */
            $applicant_schooling_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_id), 'db_func_schooling_detail');
            $this->data['applicant_schooling_details_list'] = $applicant_schooling_details_list[0];
            /* applicant_schooling_details_list end */

            /* applicant_payment_details_list start */
            $applicant_payment_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_id), 'db_func_payment_detail');
            $this->data['applicant_payment_details_list'] = $applicant_payment_details_list[0];
            /* applicant_payment_details_list end */

            $this->data['stream'] = $stream;
            $this->data['form_wizard'] = true;
            $this->data['sidebar'] = 'icon';
            $this->data['logged_applicant_id']=$applicant_id;
            $this->data['logged_applicant_login_id']=$applicant_login_id;
            $this->data['user_data'] = $this->user_details_data['user_details']['data'][0];
			$this->data['personal_detail_list'] = $this->personal_detail_list($applicant_id);
            $this->data['site_title'] = $this->data['page_title'] = 'B.Tech Application Form';
            if($view_type == 'preview') {
                $this->data['site_title'] = $this->data['page_title'] = 'B.Tech Application Form Preview';
                $this->template('applications/form_btech_preview', $this->data, true);
            } else {

            //redirect to dashboard after appln completion
            if($applicant_appln_details_list){
                     $application_status_id=$applicant_appln_details_list[0]['application_status_id'];
                     if(!empty($application_status_id) && $application_status_id!=APPLICATION_IN_PROGRESS && $mode == ''){
                         redirect(base_url());
                     }
            }
            //End: redirect to dashboard after appln completion
                $this->template('applications/form_btech', $this->data, true);    
            }
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
     * get active nationality list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_studied_from_india() {
        parent::_get_studied_from_india(false, $this->is_admin);
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
     * get active religions list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_religions() {
        parent::_get_religions(false, $this->is_admin);
    }

    /**
     * get active mother_tongues list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_mother_tongues() {
        parent::_get_mother_tongues(false, $this->is_admin);
    }

    /**
     * get active hostel_accommodation list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_hostel_accommodation() {
        parent::_get_hostel_accommodation(false, $this->is_admin);
    }

    /**
     * get active hostel_accommodation list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_advertisement_source() {
        parent::_get_advertisement_source(false, $this->is_admin);
    }

    /**
     * get active branchs list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_branchs() {
        parent::_get_branchs(false, $this->is_admin);
    }

    /**
     * get active countries list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_countries() {
        parent::_get_countries(false, $this->is_admin);
    }

    /**
     * get active countries list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_choice_dropdown() {
        $new_arr = $new_arr1 = array();
        $is_course = $this->input->get('is_course');
        $is_spec = $this->input->get('is_spec');
        $is_campus = $this->input->get('is_campus');
        $is_regcourse = $this->input->get('is_regcourse');
        $res = parent::_get_choice_dropdown(true, $this->is_admin);
        /*if($res) {
            foreach($res['data'] as $k1=>$v1) {
                foreach($v1 as $k=>$v) {
                    // echo '$k => '.$k."\n";
                    // echo '$v => '.$v."\n";
                    // if($is_course == 1 && ($k == 'branch_id' || $k == 'branch_name')) {
                    if($is_course == 1 && ($k == 'branch_id' || $k == 'branch_name')) {
                        if($k == 'branch_id') {
                            $k = 'id';
                        } else if($k == 'branch_name') {
                            $k = 'name';
                        }
                        $new_arr[$k1][$k] = $v;
                        // if(!in_array($v, array_column($new_arr, 'name')) && !in_array($v, array_column($new_arr, 'id'))) {
                            // $new_arr[$k1][$k] = $v;   
                        // }
                    } else if($is_course == 1 && ($k == 'prog_id' || $k == 'prog_name')) {
                        if($k == 'prog_id') {
                            $k = 'id';
                        } else if($k == 'prog_name') {
                            $k = 'name';
                        }
                        $new_arr[$k1][$k] = $v;
                        // if(!in_array($v, array_column($new_arr, 'name')) && !in_array($v, array_column($new_arr, 'id'))) {
                            // $new_arr[$k1][$k] = $v;   
                        // }
                    } else if($is_spec == 1 && ($k == 'spec_id' || $k == 'spec_name')) {
                        if($k == 'spec_id') {
                            $k = 'id';
                        } else if($k == 'spec_name') {
                            $k = 'name';
                        }
                        $new_arr[$k1][$k] = $v;          
                        // if(!in_array($v, array_column($new_arr, 'name')) && !in_array($v, array_column($new_arr, 'id'))) {
                            // $new_arr[$k1][$k] = $v;   
                        // }   
                    } else if($is_campus == 1 && ($k == 'campus_id' || $k == 'campus_name')) {
                        if($k == 'campus_id') {
                            $k = 'id';
                        } else if($k == 'campus_name') {
                            $k = 'name';
                        }
                        if(!in_array($v, array_column($new_arr, 'name')) && !in_array($v, array_column($new_arr, 'id'))) {
                            $new_arr[$k1][$k] = $v;   
                        }
                    }

                }
                
            }
        }*/
        // $new_arr = array_values($res);
        // $new_arr = array_filter($res);
        // $new_arr1['data'] = $res;
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
        $returnResponse = $this->output->get_output();
        return $returnResponse;
    }	
}
