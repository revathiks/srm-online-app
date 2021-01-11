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

class Admin extends BackendController
{
	public $CI;

	public function __construct()
    {
        //
        parent::__construct();
        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $CI =& get_instance();
		$this->load->helper('security');
    }

     /**
     * Index page
     *
     * @param username , password
     * @return json response of user details have or not
     * @author
     */

    public function login()
    {
        $this->is_already_exists_admin_logged();
        $this->data['site_title'] = USER_LOGIN_PAGE_TITLE;
        $this->data['site_head']  = CRM_ADMIN_LOGIN;
		    $this->data['site_head_below']  = USER_LOGIN_PAGE_TITLE_BELOW;
        $this->data['sidebar']='login';
        $this->data['submit_button_name'] = LOGIN_CRM_BUTTON;
        $this->data['page_heading_name'] = CRM_ADMIN_LOGIN;

        if( ($this->input->post('username')) && ($this->input->post('password')))
        { 

            $loginFormData = $this->input->post();
            // Login API Method
            $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'crm_login' ];
            // Method Type
            $method = 'POST';
            // Call API
            $data = $this->call_api($url,$method,$loginFormData);

            if ($data['login_ok'] == 'true')
            {
                //$this->session->set_flashdata('success', $data['message']);
                $this->session->set_userdata(array('crmadmin_details_data'=>$data));
                $this->session->set_userdata($this->current_session_name.'_is_logged_in_crmadmin', 'true');
				        $response = array("status"=>SUCCESS_LOGIN_STATUS,"data"=>$data,"redirect"=>SUCCESS_LOGIN_ADMIN_REDIRECT,"msg"=>$data['message']);
				        $return = $this->json_return($response);
				        return $return;		
            }
            else
            {
              //$this->session->set_flashdata('error_admin', $data['message']);
				      $response = array("status"=> FAILED_LOGIN_STATUS ,"redirect"=>FAILED_LOGIN_ADMIN_REDIRECT,"msg"=>$data['message']);
				      $return = $this->json_return($response);
				      return $return;
            }
        }
		
        $this->template('admin\login', $this->data, true);
    }


    /**
     * Dashboard page
     *
     * @param 
     * @return 
     * @author
     */

    public function dashboard()
    {
        $this->is_exists_admin_logged();
        $user_data = $this->session->userdata('crmadmin_details_data');
        $user_role_id=$user_data['user_details']['role_id'];
        if($user_role_id == CRM_ADMIN_USER_ROLE_ID)
        {
          $this->data['site_title'] = $this->data['page_title'] = 'Dashboard';
          $this->template('dashboard\dashboard', $this->data, true);
        }        
        else if($user_role_id == COUNSELLOR_ROLE_ID)
        {
          $this->data['site_title'] = $this->data['page_title'] = 'Counsellor Dashboard';
          $this->template('dashboard\counsellor_dashboard', $this->data, true);
        }
        
    }

     /**
     * Register page
     *
     * @param send user details
     * @return json response insert or not
     * @author
     */

    public function register()
    {

        $this->is_already_exists_user_logged();
        $this->data['page_title'] = USER_REGISTER_PAGE_TITLE;
        $this->data['save_button_name'] = REGISTER_BUTTON;
        $this->data['page_heading_name'] = REGISTER_HEADING;
        // $cap = $this->create_captcha(true);
        $this->data['captcha_image'] = $cap['image'];
        $captcha_from_path = 'register';
        $this->data['captcha_from_path'] = $captcha_from_path;
        if($this->input->post('submit'))
        {
            $userFormData = $this->input->post();
            // $expected_captcha_word = $cap['word'];
            $actual_captcha_word = $this->input->post('captcha');
            $expected_captcha_word = $this->get_captcha_expected($captcha_from_path);
            if($expected_captcha_word == $actual_captcha_word) {
                // Login API Method
                $api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls[ 'register' ];
                // Method Type
                $method = 'POST';
                /*echo '<pre>';
                print_r($url);
                print_r($method);
                print_r($userFormData);
                die;
                echo '</pre>';*/
                // Call API
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
        $this->template('user\register', $this->data, false);
    }

    /**
     * Reset Password page
     *
     * @param send Email
     * @return json response Password response in mail send or not
     * @author
     */

    public function forgot_password()
    {
        $this->is_already_exists_user_logged();
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
        $this->template('user\forgot_password', $this->data, false);
    }

      /**
     * Reset Password page
     *
     * @param send OTP
     * @return json response Password response in mail send or not
     * @author
     */

      public function otp_forgotpassword()
      {
        $this->is_already_exists_user_logged();
        if($this->input->post('otp'))
        {
            $userFormData = $this->input->post();
            $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'otpverifyforgotpwd' ];
            // Method Type
            $method = 'POST';
            // Call API
            $data = $this->call_api($url,$method,$userFormData);
            echo json_encode($data);
            die;
        }
      }



       /**
     * Update Password page
     *
     * @param send OTP
     * @return json response Password response in mail send or not
     * @author
     */

      public function otp_updateforgotpassword()
      {
        $this->is_already_exists_user_logged();
            if($this->input->post('submitupdate_otp'))
            {
                $userFormData = array (
                        'otp' => trim ($this->input->post('otp_data', true)),
                        'new_pwd' => trim ($this->input->post('new_pwd', true)),
                        'confirm_pwd' => trim ($this->input->post('confirm_pwd', true)),
                    );
                $api_urls = $this->config->item ( 'api_urls' );
                $url = $api_urls[ 'updatepwdotp' ];
                // Method Type
                $method = 'POST';
                // Call API
                $data = $this->call_api($url,$method,$userFormData);
                $status = $data['status'];
                echo json_encode($data);
                die;
            }
       }


       






     /**
     * Logout
     *   
     * @return Clear all user session details
     * @author
     */

    public function logout()
    {
        $this->session->unset_userdata('crmadmin_details_data');
        //$this->session->unset_userdata('_is_logged_in_crmadmin');
        $this->_unset_crmadmin_session();
        redirect('crm-admin\login', 'refresh');
    }

     /**
     * Edit profile page
     *
     * @param send user details
     * @return json response update or not
     * @author
     */

    public function edit_profile()
    {
        $this->is_exists_user_logged();
        $userdata = $this->session->userdata('user_details_data');
        $edit_user['userdata'] = $userdata;
        $data = $this->sess_token_user_exipry($edit_user);

        $user_id = $userdata['user_details']['data'][0]['user_id'];       
        $this->data['page_title'] = EDIT_PROFILE_PAGE_TITLE;
        $this->data['save_button_name'] = REGISTER_BUTTON;
        $this->data['page_heading_name'] = EDIT_PROFILE_PAGE_TITLE;
        $this->data['userdet']= $data; 
        $this->template('admin\edit_profile', $this->data, true);
     }

    public function create_captcha_bk($return = false) {
        $this->load->helper('captcha');

        $vals = array(
            // 'word'          => 'Random word',
            'img_path'      => FCPATH.'assets\common\uploads\captcha\/',
            'img_url'       => base_url('assets/common/uploads/captcha/'),
            'font_path'     => FCPATH.'assets\common\uploads\captcha\fonts\verdana.ttf',
            'img_width'     => 222,
            'img_height'    => 67,
            'expiration'    => 7200,
            'word_length'   => CAPTCHA_WORD_LENGTH,
            'font_size'     => 81,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

            // White background and border, black text and red grid
            'colors'        => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    // 'text' => array(0, 0, 0),
                    'text' => array(70, 128, 116),
                    'grid' => array(70, 128, 116)
            )
        );

        $cap = create_captcha($vals);
        if($this->input->post('from_path')) {
            $from_path = $this->input->post('from_path');
            $this->set_captcha_expected($from_path, $cap['word']);
        }
        if($return) {
            return $cap;   
        } else {
            echo json_encode($cap);
            die;
        }
    }

    public function create_captcha($return = false) {
        $this->load->helper('common');
        $cap = array();
        $cap['status'] = 'false';
        if($this->input->post('from_path')) {
            $from_path = $this->input->post('from_path');
            $url = get_captcha($from_path);
            
            $cap['image'] = '<img src="'.$url.'" />';
            $cap['status'] = 'true';
            // $cap['word'] = $this->get_captcha_expected($from_path);
            $this->output->set_content_type('application/json')->set_output(json_encode($cap));
        }
        $returnResponse = $this->output->get_output();
        return $returnResponse;
    }

    protected function set_captcha_expected($from_path = false, $word = false) {
        return $this->session->set_userdata($from_path.'_captcha_expected',$word);
    }

    protected function get_captcha_expected($from_path = false) {
        return $this->session->userdata($from_path.'_captcha_expected');
    }

    /**
     * get active mobile code list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_mobile_codes() {
        parent::_get_mobile_codes(false, $this->is_admin);
    }

    /**
     * get active states list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_states() {
        parent::_get_states(false, $this->is_admin);
    }

    /**
     * get active cities list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_cities() {
        parent::_get_cities(false, $this->is_admin);
    }

    /**
     * get active degree list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_degrees() {
        parent::_get_degrees(false, $this->is_admin);
    }

    public function check_captcha() {
        $captcha = $this->input->post('captcha');
        $captcha_from_path = $this->input->post('captcha_from_path');
        $this->output->set_content_type('text/html')->set_output('false');
        if($captcha && $captcha_from_path) {
            $get_captcha_expected = $this->get_captcha_expected($captcha_from_path);
            if($get_captcha_expected == $captcha) {
                $this->output->set_content_type('text/html')->set_output('true');
            }
        }
        $returnResponse = $this->output->get_output();
        return $returnResponse;
    }

    public function check_user_exists() {
        $arr_res = parent::_get_users(true, $this->is_admin);
        $this->output->set_content_type('text/html')->set_output('true');
        if($arr_res) {
            if(isset($arr_res['data'])) {
                if(count($arr_res['data']) > 0) {
                    $this->output->set_content_type('text/html')->set_output('false');            
                }    
            }
        }
        $returnResponse = $this->output->get_output();
        return $returnResponse;
    }

    public function check_verifylink($verify_text = false, $user_id = false) {
        $this->data['verify_text'] = $verify_text;
        $this->data['user_id'] = $user_id;
        if($this->input->post('verify_text')) {
            $post_data = $this->input->post();
            $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'check_verifylink' ];
            // Method Type
            $method = 'POST';
            // Call API
            $data = $this->call_api($url,$method,$post_data);
            if ($data['status'] == 'success')
            {
                // $this->session->set_flashdata('success', $data['message']);
                $response = array("status"=>'1',"redirect"=>'login','message'=>$data['message']);
                $return = $this->json_return($response);
                return $return;
            }
            else
            {
                // $this->session->set_flashdata('error', $data['message']);
                $response = array("status"=> '0' ,"redirect"=>'login','message'=>$data['message']);
                $return = $this->json_return($response);
                return $return;
            }
        }
        $this->template('user\check_verify_link', $this->data, false);       
    }

    public function check_email_templates() {
        $this->load->helper('string');
        $rand_str = random_string('md5').time();
        $this->data['verify_end_time']  = date('Y-m-d H:i:s');
        $this->data['display_name']   = 'Prabaharan.S';
        $this->data['verify_text']   = $rand_str;
        $this->load->view('email_templates/user_verify_notify',$this->data,false);
    }
}