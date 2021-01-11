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

class International_user extends FrontendController
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
		$this->user_details_data = $this->session->userdata('international_user_details_data');
    }

    public function register()
    {
        $this->is_already_exists_international_user_logged();
        $this->data['page_title'] = INTERNATIONAL_USER_REGISTER_PAGE_TITLE;
        $this->data['save_button_name'] = INTERNATIONAL_REGISTER_BUTTON;
        $this->data['page_heading_name'] = INTERNATIONAL_REGISTER_HEADING;
        // $cap = $this->create_captcha(true);
        $this->data['captcha_image'] = $cap['image'];
        $captcha_from_path = 'register';
        $this->data['captcha_from_path'] = $captcha_from_path;
        $this->data['sidebar'] = 'is_international_login';
        // $this->data['jquery_validation_bootstrap_tooltip'] = true;
        if($this->input->post('email'))
        {

            $userFormData = $this->input->post();
            $actual_captcha_word = $this->input->post('captcha');
            $expected_captcha_word = $this->get_captcha_expected($captcha_from_path);
            if($expected_captcha_word == $actual_captcha_word) {
                // Login API Method
                $api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls[ 'international_register' ];
                // Method Type
                $method = 'POST';
                $data = $this->call_api($url,$method,$userFormData);
                if ($data['status'] == 'true')
                {
                    $this->session->set_flashdata("success", SUCCESS_REGISTER);
                }
            } else {
                $data['status'] == 'false';
                $this->session->set_flashdata("failure", FAIL_REGISTER_CAPTCHA_FAIL);
            }
            echo json_encode($data);
            die;
        }
        $this->template('User/register_international', $this->data, true);
    }

    public function login($pgm_name = false)
    {

        $this->is_already_exists_international_user_logged();
        $this->data['site_title'] = INTERNATIONAL_USER_LOGIN_PAGE_TITLE;
        $this->data['site_head']  = INTERNATIONAL_USER_LOGIN_PAGE_TITLE;
        $this->data['site_head_below']  = INTERNATIONAL_USER_LOGIN_PAGE_TITLE_BELOW;
        $this->data['submit_button_name'] = INTERNATIONAL_LOGIN_BUTTON;
        $this->data['page_heading_name'] = INTERNATIONAL_LOGIN_HEADING;
        $this->data['check_remember'] = INTERNATIONAL_LOGIN_CHECK_REMEMBER;
        $this->data['pgm_name'] = $pgm_name;
        $this->data['sidebar'] = 'is_international_login';
        if( ($this->input->post('email')) && ($this->input->post('password')))
        { 
            $loginFormData = $this->input->post();
            // Login API Method
            $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'international_login' ];

            // Method Type
            $method = 'POST';
            // Call API
            $data = $this->call_api($url,$method,$loginFormData);
            if ($data['login_ok'] == 'true')
            {   
                $this->session->set_flashdata('success', $data['message']);
                $this->session->set_userdata(array('international_user_details_data'=>$data));
                $this->session->set_userdata($this->current_session_name.'_is_logged_in_international_user', 'true');
                $response = array("status"=>SUCCESS_LOGIN_STATUS,"data"=>$data,"redirect"=>SUCCESS_INTERNATIONAL_LOGIN_REDIRECT);
                $return = $this->json_return($response);
                return $return;         
                //redirect('dashboard');
            }
            else
            {
                $this->session->set_flashdata('error', $data['message']);
                $response = array("status"=> FAILED_LOGIN_STATUS ,"redirect"=>FAILED_LOGIN_REDIRECT);
                $return = $this->json_return($response);
                return $return;
                //redirect('login');
            }
        }
        $this->template('User/login_international', $this->data, true);
    }

    /**
     * Reset Password page
     *
     * @param send Email
     * @return json response Password response in mail send or not
     * @author
     */

    public function forgot_pwd_international()
    {
      $this->is_already_exists_international_user_logged();
        $this->data['site_title'] = RESET_PWD_TITLE;
        if($this->input->post('email'))
        {
            $userFormData = $this->input->post();
            // Login API Method
            $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'forgotpwd' ];
            // Method Type
            $method = 'POST';
            // Call API
            $data = $this->call_api($url,$method,$userFormData);
            echo json_encode($data);
            die;
        }
        $this->data['sidebar'] = 'is_international_login';
        $this->template('User/forgot_password_international', $this->data, true);      
    }

    /*captcha Expected get*/
     protected function get_captcha_expected($from_path = false) {
        return $this->session->userdata($from_path.'_captcha_expected');
    }

    public function get_reg_choice_dropdown_international() {
        $new_arr = $new_arr1 = array();
        $is_course = $this->input->get('is_course');
        $is_spec = $this->input->get('is_spec');
        $is_campus = $this->input->get('is_campus');
        $is_regcourse = $this->input->get('is_regcourse');
        $is_stream = $this->input->get('is_stream');
        $res = parent::_get_reg_choice_dropdown_international(true, $this->is_admin);
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
        $returnResponse = $this->output->get_output();
        return $returnResponse;
    }

     /*Dahshboard For International Login*/   

    public function international_dashboard()
    {
        $this->is_exists_international_user_logged();
        $this->user_details_data = $this->session->userdata('international_user_details_data');
        $applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];
        $applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];
        $this->data['site_title'] = $this->data['page_title'] = 'Dashboard';
        $this->data['sidebar'] = 'is_international';
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'applicantstatus' ];
        $method = 'POST';
        $userdata = $this->session_internationaluserdata();
        $user_data['userdata'] = $userdata;
        $user_data['applicant_personal_det_id'] = $applicant_id;
        $user_data['applicant_login_id'] = $applicant_login_id;
        $user_data['is_international'] = 1;
        list($result_token,$data) = $this->_check_token($user_data);
        if($result_token['valid']=='true'){
          $result = $this->call_api ( $url , $method , $data );
          $this->data['applicantstatus_list'] = $result['data'];
         }
            $this->template('dashboard/dashboard', $this->data, true);
    }

    /*International User logout*/
    public function international_logout()
    {
        $this->session->unset_userdata('international_user_details_data');
        $this->session->unset_userdata($this->current_session_name.'_is_logged_in_international_user');
        redirect('/international-form/login', 'refresh');
    }

    public function edit_profile()
    {
        $this->is_exists_international_user_logged();
        $userdata = $this->session->userdata('international_user_details_data');
        
        $edit_user['userdata'] = $userdata;
        $data = $this->sess_token_user_exipry($edit_user);
        
        //$user_id = $userdata['user_details']['data'][0]['user_id'];
        $user_id = $userdata['user_details']['data'][0]['applicant_login_id'];
        $this->data['page_title'] = VIEW_PROFILE_PAGE_TITLE;
        $this->data['save_button_name'] = REGISTER_BUTTON;
        $this->data['page_heading_name'] = VIEW_PROFILE_PAGE_TITLE;
        $this->data['sidebar'] = 'is_international';
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'user' ] . "/" . $user_id . '?is_international=1';
        // Method Type
        $method = 'GET';
        $this->data['userdet'] =  $this->call_api ( $url , $method, $data); 
        
        if ( $this->input->post ( 'submit', true ) ) 
        {
            $edit_user = array (
                'user_name' => trim ($this->input->post('user_name', true)),
                'display_name' => trim ($this->input->post('display_name', true)),
                'phone_no' => trim ($this->input->post('phone_no', true)),
                'alt_phone_no' => trim ($this->input->post('alt_phone_no', true)),
                'user_id' => $user_id,
            );
            $edit_user['userdata'] = $userdata;
            $sess_det = $this->sess_token_user_exipry($edit_user);
            $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'edit_user' ];
            $method='PUT';
            $data= $this->call_api ( $url , $method , $sess_det );  
            if ($data['status'] == 'true')
            {
                $this->session->set_flashdata("success", SUCCESS_REGISTER);
            }
            else
            {
                $this->session->set_flashdata("error", ERROR_MSG);
            }
            echo json_encode($data);
            die;
        }       
        $this->template('profile/edit_profile', $this->data, true);
     }


     /**
     * [change_password description]
     *
     * @method change_password
     *
     * @return [type] [description]
     */
    public function change_password()
    {

        $this->is_exists_international_user_logged();
        $applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];   
        $applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];
        $this->data['site_title'] = $this->data['page_title'] = 'Change Password';
        $this->data['is_international']=1;
        $this->data['sidebar'] = 'is_international';
        $userdata = $this->session->userdata('international_user_details_data');
        $edit_user['userdata'] = $userdata;
        if( ($this->input->post('old_pwd')) && ($this->input->post('new_pwd')))
        {
            $FormData = $this->input->post();
            $edit_user = array (
                    'old_pwd' => trim ($this->input->post('old_pwd', true)),
                    'new_pwd' => trim ($this->input->post('new_pwd', true)),
                    'confirm_pwd' => trim ($this->input->post('confirm_pwd', true)),
                    'applicant_personal_det_id' => $applicant_id
                );

            
            $edit_user['userdata'] = $userdata;
            $sess_det = $this->sess_token_user_exipry($edit_user);
            // Login API Method
            $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'change_password' ];
            // Method Type
            $method = 'POST';
            // Call API
            $data = $this->call_api($url,$method,$sess_det);
            echo json_encode($data);
            die;
        }
        // Display page with the template function from REST_Controller
        $this->template('profile/change_password', $this->data, true);
    }


}
