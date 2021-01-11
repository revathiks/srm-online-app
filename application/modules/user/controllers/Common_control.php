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

class Common_control extends FrontendController
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
		$this->user_details_data = $this->session->userdata('user_details_data');
    }
	
   
    public function course_preference() {
        $api_urls = $this->config->item ( 'api_urls' );
        $url= $api_urls['course_preference'];
        $is_course=$_GET['is_course'];
        $is_degree=$_GET['is_degree'];
        $is_campus=$_GET['is_campus'];
        $grade_id=$_GET['grade_id'];
        $campus_id=$_GET['campus_id'];
        $course_id=$_GET['course_id'];
        $degree_id=$_GET['degree_id'];
        $form_id=$_GET['form_id'];
        $keywords=$_GET['keywords'];
        $is_program=$_GET['is_program'];
        $is_course_spec=$_GET['is_course_spec'];
        $type=$_GET['type'];
        $ecamp=$_GET['ecamp'];
        $ecourse=$_GET['ecourse'];
        $query_data = array();
        if(!empty($is_course)){
            $query_data['is_course'] = $is_course;
        }
        if(!empty($is_campus)){
            $query_data['is_campus'] = $is_campus;
        }
        if(!empty($is_program)){
            $query_data['is_program'] = $is_program;
        }
        if(!empty($is_degree)){
            $query_data['is_degree'] = $is_degree;
        }
        if(!empty($type)){
            $query_data['type'] = $type;
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
            $query_data['dgree_id'] = $degree_id;
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
        if(!empty($ecourse)){
            $query_data['ecourse'] = $ecourse;
        }
        if(!empty($is_course_spec)){
            $query_data['is_course_spec'] = $is_course_spec;
        }
        $query = http_build_query($query_data);
        $url = $url .'?'.$query;
        $method = 'GET';
        
        $userdata = $this->session_userdata();
        $user_data['userdata'] = $userdata;
        /* $user_data['form_id']=APP_FORM_ID_HCMA;
        $user_data['grade']=1; */
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
    
    public function qualification_status() {
        $api_urls = $this->config->item ( 'api_urls' );
        $url= $api_urls['qualification_status'];        
        $grade_id=$_GET['grad_id'];        
        $form_id=$_GET['form_id'];
        $keywords=$_GET['keywords'];
        $query_data = array();        
        if(!empty($grade_id)){
            $query_data['grad_id'] = $grade_id;
        }
        if(!empty($form_id)){
            $query_data['form_id'] = $form_id;
        }
        if(!empty($keywords)){
            $query_data['keywords'] = $keywords;
        }        
        $query = http_build_query($query_data);
        $url = $url .'?'.$query;
        $method = 'GET';
        
        $userdata = $this->session_userdata();
        $user_data['userdata'] = $userdata;
        //$user_data['form_id']=APP_FORM_ID_HCMA;
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
    public function competitive_exam_list() {
        $api_urls = $this->config->item ( 'api_urls' );
        $url= $api_urls['competitive_exam_list'];
        $form_id=$_GET['form_id'];
        $keywords=$_GET['keywords'];
        $ecamp=$_GET['e_exam'];
        $query_data = array();        
        if(!empty($form_id)){
            $query_data['form_id'] = $form_id;
        }
        if(!empty($keywords)){
            $query_data['keywords'] = $keywords;
        }
        if(!empty($ecamp)){
            $query_data['e_exam'] = $ecamp;
        }
        $query = http_build_query($query_data);
        $url = $url .'?'.$query;
        $method = 'GET';
        
        $userdata = $this->session_userdata();
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
    
    public function job_sectors() {
        $api_urls = $this->config->item ( 'api_urls' );
        $url= $api_urls['job_sectors'];        
        $form_id=$_GET['form_id'];
        $keywords=$_GET['keywords'];
        $query_data = array();        
        if(!empty($form_id)){
            $query_data['form_id'] = $form_id;
        }
        if(!empty($keywords)){
            $query_data['keywords'] = $keywords;
        }
        $query = http_build_query($query_data);
        $url = $url .'?'.$query;
        $method = 'GET';
        
        $userdata = $this->session_userdata();
        $user_data['userdata'] = $userdata;
        //$user_data['form_id']=APP_FORM_ID_HCMA;
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
    
    public function get_studied_from_india() {
        parent::_get_studied_from_india(false, $this->is_admin);
    }
	
    public function get_resident_status() {
        parent::_get_resident_status(false, $this->is_admin);
    }
	
	
    public function get_banks() {
        parent::_get_banks(false, $this->is_admin);
    }	
	
	public function payment_thank_you() {
		//$this->is_exists_user_logged();
        $is_international = $this->input->get('is_international',true);
        $is_international=($is_international)?$is_international:'';
        if($is_international){
            $this->is_exists_international_user_logged();
            $this->user_details_data = $this->session->userdata('international_user_details_data');
        }else { $this->is_exists_user_logged(); }
        $ses_applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];
        //$applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];
        $applicant_personal_det_id = $this->input->get('applicant_personal_det_id');
        $applicant_id = ($applicant_personal_det_id)?$applicant_personal_det_id:$ses_applicant_id;
		
		// Get Form ID
		$get_form_id = $this->input->get('app_form_id',true);
		$get_form_id = ($get_form_id)?$get_form_id:APP_FORM_ID_DE;
        $wizard_id = $this->input->get('wizard_id',true);
        $wizard_id = ($wizard_id)?$wizard_id:8;
        $url = $this->input->get('url',true);
        if($url) {
            $url = urldecode($url);
        } else {
            $url = base_url().'dis-education';
        }
        $payment_transaction_id = $this->input->get('payment_transaction_id',true);
        $payment_mode = $this->input->get('payment_mode',true);
        $payment_mode = ($payment_mode)?$payment_mode:'dd';
        $currentIndex = $this->input->get('currentIndex',true);
        $currentIndex = ($currentIndex)?$currentIndex:5;
        $mode = $this->input->get('mode',true);
        $this->data['payment_mode'] = $payment_mode;
        $this->data['form_url'] = $url.'?startIndex='.($currentIndex+1);
        $this->data['payment_transaction_id'] = $payment_transaction_id;
        $this->data['currentIndex'] = $currentIndex;
        if($applicant_personal_det_id && $mode == ADMIN_MODE_EDIT)
        $goback_url = base_url().'crm-admin/dashboard';
        else if($is_international)
        $goback_url = base_url().'international_form/dashboard';
        else
        $goback_url = base_url().'dashboard';
		// Get Applicant ID
		$applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);
		$applicant_appln_det_id = $applicant_appln_det['id'];
		$applicant_instructions_list = $this->_get_applicant_tables(array('appln_form_id'=>$get_form_id,'wizard_id'=>$wizard_id), 'db_func_instruction');
		$this->data['applicant_instructions_list'] = $applicant_instructions_list;  					
		$payment_details_list = $this->_get_applicant_tables(array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_det_id), 'db_func_payment_detail');
		$this->data['payment_details_list'] = $payment_details_list[0];
        $this->data['goback_url'] = $goback_url;
		$this->template('applications/payment_thank_you', $this->data, true);
	}
	public function get_high_education() {
	    $type=$_GET['type'];
	    if(isset($type)){
	     parent::_get_high_education(false, $this->is_admin,$type);
	    }
	}
	
	public function form_list() {
	    $api_urls = $this->config->item ( 'api_urls' );
	    $url= $api_urls['form_list'];
	    $method = 'GET';
	    
	    $userdata = $this->session_userdata();
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
   
}