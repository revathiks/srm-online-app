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

class Phd_jan extends FrontendController
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

    /**
     * [all description]
     *
     * @method index
     *
     * @return [type] [description]
     */
    public function all()
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
    }	
	
    public function phd_jan_form($mode = false , $applicant_login_id = false , $applicant_personal_det_id = false) {
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
		$get_form_id = APP_FORM_ID_PHD_JAN;
		// Get Applicant ID
		$applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);		
		// Get Applicant APPLN ID
		$applicant_appln_det_id = $applicant_appln_det['id'];
		
        if ( $this->input->post () ){	
            $user_data = $this->input->post();	
			$user_data['created_by']=$created_updated_by;
            $user_data['updated_by']=$created_updated_by;			
            if($user_data['currentIndex']==2)
            {
                $api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls[ 'addressdet' ];
                $method = 'POST';
                $userdata = $this->session_userdata();
                $user_data['userdata'] = $userdata;
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['applicant_login_id'] = $applicant_login_id;
				$user_data['app_form_id'] = $get_form_id;
				$user_data['appln_status'] = $user_data['appln_status'];
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
            $schema = SCHEMA_ADMISSION;
            $table = APPLICANT_PERSONAL_DET_TABLE;

            $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'user' ];
            $url .= '/'.$applicant_login_id;
            $method = 'GET';
			$userdata = $this->user_details_data;
			$user_data['userdata'] = $userdata;
            list($result_token,$data) = $this->_check_token($user_data);     

            if($result_token['valid']=='true')
            {
                $result = $this->call_api ( $url , $method , $data );
            }
            
            $get_users = $result['data'];
            
            $this->data['get_users'] = $get_users;
            // $applicant_id = 1;
            $foldername = $this->data['get_users']['first_name']."_".$this->data['get_users']['user_id'];
            

            $upload_post_file_name = 'photograph';
            $upload_type = 'photograph';
            $purchase_order_response = $this->_upload_files ($foldername, $upload_post_file_name, $upload_type, $applicant_id, $applicant_login_id);
            // die;
            // exit;

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
				$url = $api_urls[ 'wizard_api_phd_jan'];
				// Get Personal ApplicaNT ID
				$user_data['applicant_id'] = $applicant_id;
				$user_data['applicant_appln_det_id'] = $applicant_appln_det_id;
				$user_data['is_curr_qualify'] = true;
				$user_data['appln_status'] = $user_data['appln_status'];
				
				if($user_data['category']!=PART_TIME_EXTERNAL){
					$user_data['is_employed'] = null;
					$user_data['working_place'] = null;
				} 
				
				if($user_data['is_employed']=='t'){
					$user_data['working_place'] = $user_data['working_place'];
				}else{
					$user_data['working_place'] = $user_data['working_place'];
				}				
				
				$userdata = $this->user_details_data;
				$user_data['userdata'] = $userdata;
				list($result_token,$data) = $this->_check_token($user_data);     

				if($result_token['valid']=='true'){
					// Call API
					$data = $this->call_api($url,$method,$user_data);
					if($data['status']==1){
						$this->output->set_output(json_encode(['status' => $data['status'], 'data' => $data['user_data'],'wizard_name'=>'basic details']));
					}
					
					if($data['status']==2){
						$this->output->set_output(json_encode(['status' => $data['status'],'wizard_name'=>'basic details']));
					}
				}
			}
			// Basic Details End
			
			// Personal Details Start 
			if($user_data['currentIndex']==1){
				// Personal Details API & Method
				$url = $api_urls[ 'wizard_api_phd_jan' ];
				// Get Personal ApplicaNT ID
				$user_data['applicant_id'] = $applicant_id;
				$user_data['gender_title_id'] = $user_data['pd_title'];
				$user_data['first_name'] = $user_data['pd_firstname'];
				$user_data['middle_name'] = $user_data['pd_middlename'];
				$user_data['last_name'] = $user_data['pd_lastname'];
				$mobile_no_concate_code = $user_data['pd_mobile_no'];
				$user_data['mobile_no'] = $mobile_no_concate_code;
				$user_data['email_id'] = $user_data['pd_email'];
				$user_data['dob'] = date("Y-m-d",strtotime($user_data['pd_dob']));
				$user_data['gender'] = $user_data['pd_gender'];
				$user_data['alt_email'] = $user_data['pd_alt_email'];
				$user_data['blood_group'] = $user_data['pd_blood_group'];
				$user_data['nationality'] = $user_data['pd_nationality'];
				$user_data['social_status'] = $user_data['pd_social_status'];
				$user_data['diffrently_abled'] = $user_data['pd_diffrently_abled'];
				
				if($user_data['pd_diffrently_abled']=='yes'){
					$user_data['nature_of_deformity'] = $user_data['pd_nature_deformity'];
					$user_data['percent_of_deformity'] = $user_data['pd_percent_of_deformity'];
				}else{
					$user_data['nature_of_deformity'] = null;
					$user_data['percent_of_deformity'] = null;
				}
				$userdata = $this->user_details_data;
				$user_data['userdata'] = $userdata;
				list($result_token,$data) = $this->_check_token($user_data);     

				if($result_token['valid']=='true'){
					// Call API
					$data = $this->call_api($url,$method,$user_data);

					//echo json_encode($data,true);
					if($data['status']==3){
						$this->output->set_output(json_encode(['status' => $data['status'], 'data' => $data['user_data'],'wizard_name'=>'personal details']));
					}
				}
			}
            // Academic Details Start 
            if($user_data['currentIndex']==3){
                // Academic Details API & Method
                $url = $api_urls[ 'phd_jan_acdemic_dtl' ];
                // Get 
                $user_data['applicant_personal_det_id'] = $applicant_id;
                $user_data['grad_det_ids'][] = $user_data['grad_id_1'];
                $user_data['other_degree_names'][] = $user_data['degree_diploma_1'];
                $user_data['major_discipline'][] = $user_data['major_discipline_1'];
                $user_data['univ_id'][] = $user_data['institute_university_1'];
                $user_data['mark_scheme_id'][] = $user_data['user_marking_scheme_1'];
                $user_data['mark_percents'][] = $user_data['obtained_percentage_cgpa_1'];
                $user_data['completion_years'][] = $user_data['year_of_passing_1'];
                $user_data['grad_det_ids'][] = $user_data['grad_id_2'];
                $user_data['other_degree_names'][] = $user_data['degree_diploma_2'];
                $user_data['major_discipline'][] = $user_data['major_discipline_2'];
                $user_data['univ_id'][] = $user_data['institute_university_2'];
                $user_data['mark_scheme_id'][] = $user_data['user_marking_scheme_2'];
                $user_data['mark_percents'][] = $user_data['obtained_percentage_cgpa_2'];
                $user_data['completion_years'][] = $user_data['year_of_passing_2'];
                $user_data['grad_det_ids'][] = $user_data['grad_id_3'];
                $user_data['other_degree_names'][] = $user_data['degree_diploma_3'];
                $user_data['major_discipline'][] = $user_data['major_discipline_3'];
                $user_data['univ_id'][] = $user_data['institute_university_3'];
                $user_data['mark_scheme_id'][] = $user_data['user_marking_scheme_3'];
                $user_data['mark_percents'][] = $user_data['obtained_percentage_cgpa_3'];
                $user_data['completion_years'][] = $user_data['year_of_passing_3'];
                
                $user_data['grad_det_idss'] = json_encode($user_data['grad_det_ids']);
                $user_data['other_degree_namess'] = json_encode($user_data['other_degree_names']);
                $user_data['major_discipliness'] = json_encode($user_data['major_discipline']);
                $user_data['univ_ids'] = json_encode($user_data['univ_id']);
                $user_data['mark_scheme_ids'] = json_encode($user_data['mark_scheme_id']);
                $user_data['mark_percentss'] = json_encode($user_data['mark_percents']);
                $user_data['completion_yearss'] = json_encode($user_data['completion_years']);
                $user_data['is_work_experience'] = $user_data['is_work_experience'];
                $user_data['nameofemployee'] = $user_data['name_of_employee'];
                $user_data['addressofemployee'] = $user_data['address_of_employee'];
                $user_data['salaryreceived'] = $user_data['salary_per_month'];

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

                $user_data['prof_exp_ids'] = json_encode($user_data['prof_exp_ids']);
                $user_data['org_name'] = json_encode($user_data['org_name']);
                $user_data['designation'] = json_encode($user_data['designation']);
                $user_data['job_nature'] = json_encode($user_data['job_nature']);
                $user_data['salary'] = json_encode($user_data['salary']);
                $user_data['from_date'] = json_encode($user_data['from_date']);
                $user_data['to_date'] = json_encode($user_data['to_date']);
                $user_data['work_exp_in_month'] = json_encode($user_data['work_exp_in_month']);

                $user_data['total_work_exp'] = $user_data['total_work_experience'];
                
                $user_data['is_competitive_exam'] = $user_data['taken_any_competitive_exam']; // doubt--clear
                $user_data['comp_exam_id'] = $user_data['competitive_exam']; // doubt-- clear
                
                $user_data['publn_det_ids'][] = $user_data['publn_det_id_0'];
                $user_data['titles'][] = $user_data['publications_title_0'];
                $user_data['journal_conf_names'][] = $user_data['publications_name_of_the_journal_0'];
                $user_data['years'][] = $user_data['publications_year_0'];
                $user_data['publn_det_ids'][] = $user_data['publn_det_id_1'];
                $user_data['titles'][] = $user_data['publications_title_1'];
                $user_data['journal_conf_names'][] = $user_data['publications_name_of_the_journal_1'];
                $user_data['years'][] = $user_data['publications_year_1'];
                $user_data['publn_det_ids'][] = $user_data['publn_det_id_2'];
                $user_data['titles'][] = $user_data['publications_title_2'];
                $user_data['journal_conf_names'][] = $user_data['publications_name_of_the_journal_2'];
                $user_data['years'][] = $user_data['publications_year_2'];
                $user_data['publn_det_ids'][] = $user_data['publn_det_id_3'];
                $user_data['titles'][] = $user_data['publications_title_3'];
                $user_data['journal_conf_names'][] = $user_data['publications_name_of_the_journal_3'];
                $user_data['years'][] = $user_data['publications_year_3'];

                $user_data['publn_det_ids'] = json_encode($user_data['publn_det_ids']);
                $user_data['titles'] = json_encode($user_data['titles']);
                $user_data['journal_conf_names'] = json_encode($user_data['journal_conf_names']);
                $user_data['years'] = json_encode($user_data['years']);

                $user_data['research_area'] = $user_data['phd_major'];//doubt -
                $user_data['tentative_topic'] = $user_data['tentative_topic_name'];
                // $user_data['tentativetopicdocument'] = $user_data['tentative_topic_name'];
                $user_data['choiceofprefofsupervisor'] = $user_data['choice_supervisor'];

				$userdata = $this->user_details_data;
				$user_data['userdata'] = $userdata;
                // Call API
                $data = $this->call_api($url,$method,$user_data);

                //echo json_encode($data,true);
                // if($data['status']==3){
                    $return = $this->json_return($data);
                    return $return; 
                // }
            }
            // Academic Details End 
			
			if($user_data['currentIndex']==5){
				// Personal Details API & Method
				$url = $api_urls[ 'wizard_api_phd_jan' ];
				// Get Personal Applicant ID
				$user_data['applicant_id'] = $applicant_id;
				$user_data['applicant_appln_det_id'] = $applicant_appln_det_id;
				$user_data['applicant_name'] = $user_data['applicant_name'];
				$user_data['declaration_date'] = $user_data['declaration_date'];
                if(!empty($user_data['declaration_date'])){
                    $ddate=$this->convertDate($ddate['declaration_date']);
                    $user_data['declaration_date'] = $ddate;
                }else{
                    $user_data['declaration_date'] = date("Y-m-d",strtotime($user_data['declaration_date']));
                }				
				$userdata = $this->user_details_data;
				$user_data['userdata'] = $userdata;				
				$data = $this->call_api($url,$method,$user_data);

				if($data['status']==4){
					$this->output->set_output(json_encode(['status' => $data['status'], 'data' => $data['user_data'],'wizard_name'=>'dclaration details']));
				}				
			}

            if($user_data['currentIndex']==6){
                // Academic Details API & Method
                $url = $api_urls[ 'phd_jan_final_step' ];
                // Get 
				$userdata = $this->user_details_data;
				$user_data['userdata'] = $userdata;
				$user_data['applicant_personal_det_id'] = $applicant_id;
				$user_data['updated_by']=$created_updated_by; 
                // Call API
                $data = $this->call_api($url,$method,$user_data);
                $return = $this->json_return($data);
                return $return; 
            }
        } else {
            $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'upload_filelist' ];
            //$url .= '/?fk_id='.$applicant_id;
			// Added form id to get doc data applicant_appln_id wise
            $url .= '/?fk_id='.$applicant_id.'&fk1_id='.$get_form_id;			
            $method = 'GET';
			$userdata = $this->session_userdata();
			$user_data['userdata'] = $userdata;
            list($result_token,$data) = $this->_check_token($user_data);
            if($result_token['valid']=='true')
            {
                $result = $this->call_api ( $url , $method , $user_data );
            }
            $upload_filelist = $result['data'];
            $this->data['upload_filelist'] = $upload_filelist;
			
			$applicant_basic_details_list = $this->_get_applicant_tables($applicant_id, 'db_func_basic_detail');
            $this->data['applicant_basic_details_list'] = $applicant_basic_details_list[0];

            $arr_wizard_id = array(FORM_WIZARD_BASIC_ID,FORM_WIZARD_PREFERENCE_PERSONAL_ID,FORM_WIZARD_PARENT_ADDRESS_ID,FORM_WIZARD_ACADEMIC_ID,FORM_WIZARD_PAYMENT_ID,FORM_WIZARD_DECLARATION_ID,FORM_WIZARD_UPLOAD_ID);
            foreach($arr_wizard_id as $k=>$v) {
                $applicant_instructions_list = $this->_get_applicant_tables(array('appln_form_id'=>$get_form_id,'wizard_id'=>$v), 'db_func_instruction');
                $this->data['applicant_instructions_list'][$v] = $applicant_instructions_list;      
            }
             /* applicant_address_details_list start */
             $applicant_address_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id),'db_func_address_detail');
             $this->data['applicant_address_details_list'] = $applicant_address_details_list[0];
             /* applicant_address_details_list end */
            
            /* applicant_appln_detail_list start */
             $applicant_appln_detail_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_form_id'=>$get_form_id),'db_func_appln_detail');
             $this->data['applicant_appln_detail_list'] = $applicant_appln_detail_list[0];

             /* applicant_appln_detail_list end */
			//redirect to dashboard after appln completion
			if($applicant_appln_detail_list){
				$application_status_id=$applicant_appln_detail_list[0]['application_status_id'];
				if(!empty($application_status_id) && $application_status_id!=APPLICATION_IN_PROGRESS && $mode==''){
					//redirect(base_url());
				}
			}
			//End: redirect to dashboard after appln completion				 

            /* applicant_doc_details_list start */
            $applicant_doc_details_list = $this->_get_applicant_tables($applicant_id, 'db_func_doc_detail');
            $this->data['applicant_doc_details_list'] = $applicant_doc_details_list;
            /* applicant_doc_details_list end */

            /* applicant_other_details_list start */
            $applicant_other_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_other_detail');
            $this->data['applicant_other_details_list'] = $applicant_other_details_list[0];
            /* applicant_other_details_list end */

            /* applicant_publication_dets_list start */
            $applicant_publication_dets_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_pub_detail');
            $this->data['applicant_publication_dets_list'] = $applicant_publication_dets_list;
            /* applicant_publication_dets_list end */

            /* applicant_prof_exps_list start */
            $applicant_prof_exps_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_exp_detail');
            $this->data['applicant_prof_exps_list'] = $applicant_prof_exps_list;
            /* applicant_prof_exps_list end */

            /* applicant_graduations_list start */
            $applicant_graduations_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_grad_detail');
            $this->data['applicant_graduations_list'] = $applicant_graduations_list;
            /* applicant_graduations_list end */

			$applicant_appln_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_form_id'=>$get_form_id), 'db_func_appln_detail');
            $this->data['applicant_appln_details_list'] = $applicant_appln_details_list[0];
			
            /*Form Index Restriction Start*/
            $wizard_dt = $this->_get_wizard_details(APP_FORM_ID_PHD_JAN);
            $applnform_wizard_id = $applicant_appln_details_list[0]['form_w_wizard_id'];
            $get_appln_wizard_dtl = $this->_get_appln_wizard_details($applnform_wizard_id);
            $this->data['wizard_dt']=$wizard_dt;
            $this->data['appln_wizard_dt']=$get_appln_wizard_dtl;
            /*Form Index Restriction End*/
            
            /* applicant_payment_details_list start */
            $applicant_payment_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_payment_detail');
            $this->data['applicant_payment_details_list'] = $applicant_payment_details_list[0];
            /* applicant_payment_details_list end */
        
            $this->data['stream'] = $stream;
            $this->data['form_wizard'] = true;
            $this->data['sidebar'] = 'icon';
            $this->data['logged_applicant_id']=$applicant_id;
            $this->data['logged_applicant_login_id']=$applicant_login_id;
            $this->data['user_data'] = $this->user_details_data['user_details']['data'][0];
			$this->data['personal_detail_list'] = $this->personal_detail_list($applicant_id);
            $this->data['site_title'] = $this->data['page_title'] = 'Ph.D Application Form';
            $this->template('applications/form_phd_jan', $this->data, true);
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

    public function upload_file() {
        $file_doc_type = $this->input->post('file_doc_type',true);
        $app_form_id = $this->input->post('app_form_id',true);
        $id = $this->input->post('id',true);
        
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
            $this->_upload_files_multiple ($foldername, $upload_post_file_name, $upload_type, $applicant_id, $applicant_login_id,$is_edit,$app_form_id);
        } else {
            $this->_upload_files ($foldername, $upload_post_file_name, $upload_type, $applicant_id, $applicant_login_id,$is_edit,$app_form_id);    
        }
    }

    public function del_uploaded_file() {
        $result = array();
        $doc_id = $this->input->post('doc_id');
        $data_del_file_id = $this->input->post('data_del_file_id');
        $applicant_login_id = $this->input->post('logged_applicant_login_id');
        $applicant_id = $this->input->post('logged_applicant_id');
        $app_form_id = $this->input->post('app_form_id');
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
            $data['app_form_id'] = $app_form_id;
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
	
    public function phd_jan_form_preview($mode = false , $applicant_login_id = false , $applicant_personal_det_id = false) {
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
        $get_form_id = APP_FORM_ID_PHD_JAN;
        // Get Applicant ID
        $applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);
                
        $applicant_appln_det_id = $applicant_appln_det['id'];           

    
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'upload_filelist' ];
        //$url .= '/?fk_id='.$applicant_id;
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
        
        $applicant_basic_details_list = $this->_get_applicant_tables($applicant_id, 'db_func_basic_detail');
        $this->data['applicant_basic_details_list'] = $applicant_basic_details_list[0];

        $arr_wizard_id = array(FORM_WIZARD_BASIC_ID,FORM_WIZARD_PREFERENCE_PERSONAL_ID,FORM_WIZARD_PARENT_ADDRESS_ID,FORM_WIZARD_ACADEMIC_ID,FORM_WIZARD_PAYMENT_ID,FORM_WIZARD_DECLARATION_ID,FORM_WIZARD_UPLOAD_ID);
        foreach($arr_wizard_id as $k=>$v) {
            $applicant_instructions_list = $this->_get_applicant_tables(array('appln_form_id'=>$get_form_id,'wizard_id'=>$v), 'db_func_instruction');
            $this->data['applicant_instructions_list'][$v] = $applicant_instructions_list;      
        }
         /* applicant_address_details_list start */
         $applicant_address_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id),'db_func_address_detail');
         $this->data['applicant_address_details_list'] = $applicant_address_details_list[0];
         /* applicant_address_details_list end */
        
        /* applicant_appln_detail_list start */
         $applicant_appln_detail_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'appln_form_id'=>$get_form_id),'db_func_applicant_appln_detail');
         $this->data['applicant_appln_detail_list'] = $applicant_appln_detail_list[0];
         /* applicant_appln_detail_list end */
		//redirect to dashboard before appln completion
        if($applicant_appln_detail_list){
            $is_allow_preview=$this->config->item('is_allow_preview');
            $application_status_id=$applicant_appln_detail_list[0]['application_status_id'];
            $completedWizard=$applicant_appln_detail_list[0]['wizard_id'];
            if(empty($application_status_id) || $application_status_id!=APPLICATION_IN_PROGRESS || $completedWizard < FORM_WIZARD_PAYMENT_ID && (isset($is_allow_preview) && $is_allow_preview==0)){
                // redirect(base_url());
            }
        }
        //End: redirect to dashboard before appln completion		 

        /* applicant_doc_details_list start */
        $applicant_doc_details_list = $this->_get_applicant_tables($applicant_id, 'db_func_doc_detail');
        $this->data['applicant_doc_details_list'] = $applicant_doc_details_list;
        /* applicant_doc_details_list end */

        /* applicant_other_details_list start */
        $applicant_other_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_other_detail');
        $this->data['applicant_other_details_list'] = $applicant_other_details_list[0];
        /* applicant_other_details_list end */

        /* applicant_publication_dets_list start */
        $applicant_publication_dets_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_pub_detail');
        $this->data['applicant_publication_dets_list'] = $applicant_publication_dets_list;
        /* applicant_publication_dets_list end */

        /* applicant_prof_exps_list start */
        $applicant_prof_exps_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_exp_detail');
        $this->data['applicant_prof_exps_list'] = $applicant_prof_exps_list;
        /* applicant_prof_exps_list end */

        /* applicant_graduations_list start */
        $applicant_graduations_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_grad_detail');
        $this->data['applicant_graduations_list'] = $applicant_graduations_list;
        /* applicant_graduations_list end */

        $applicant_appln_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_form_id'=>$get_form_id), 'db_func_appln_detail');
        $this->data['applicant_appln_details_list'] = $applicant_appln_details_list[0];

        /* applicant_payment_details_list start */
        $applicant_payment_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_payment_detail');
        $this->data['applicant_payment_details_list'] = $applicant_payment_details_list[0];
        /* applicant_payment_details_list end */
        
        //$this->data['stream'] = $stream;
        $this->data['form_wizard'] = true;
        $this->data['sidebar'] = 'icon';
        $this->data['logged_applicant_id']=$applicant_id;
        $this->data['logged_applicant_login_id']=$applicant_login_id;
        $this->data['user_data'] = $this->user_details_data['user_details']['data'][0];
        $this->data['personal_detail_list'] = $this->personal_detail_list($applicant_id);
        $this->data['site_title'] = $this->data['page_title'] = 'Ph.D Form Preview';

        // Display page with the template function from REST_Controller
        $this->template('applications/phd_jan_preview', $this->data, true);
    }
    
	public function thank_you() {
		$this->is_exists_user_logged();
		$get_form_id = $this->input->get('app_form_id',true);
		$get_form_id = ($get_form_id)?$get_form_id:APP_FORM_ID_DE;		
        $applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];   
        $applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);     
        $applicant_appln_det_id = $applicant_appln_det['id'];  	
        $applicant_payment_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_payment_detail');
		$get_thank_you_data = $this->get_thank_you_data($applicant_appln_det_id,$get_form_id);
        $this->data['trans_no'] = $applicant_payment_details_list[0]['trans_no'];
		$this->data['appln_no'] = $get_thank_you_data['data'][0]['appln_no'];
		$this->data['form_message'] = $get_thank_you_data['data'][0]['form_message'];
		$this->data['wizard_id'] = $get_thank_you_data['data'][0]['wizard_id'];
		$this->data['form_path_preview'] = $this->config->item('form_path_preview')[$get_form_id];
        $this->template('applications/thank-you', $this->data, true);
	}	
}
