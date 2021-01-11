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

class User extends FrontendController
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

    public function login($pgm_name = false)
    {
        $this->is_already_exists_user_logged();
        $this->data['site_title'] = USER_LOGIN_PAGE_TITLE;
        $this->data['site_head']  = USER_LOGIN_PAGE_TITLE;
		$this->data['site_head_below']  = USER_LOGIN_PAGE_TITLE_BELOW;
        $this->data['submit_button_name'] = LOGIN_BUTTON;
        $this->data['page_heading_name'] = LOGIN_HEADING;
		$this->data['check_remember'] = LOGIN_CHECK_REMEMBER;
        $this->data['pgm_name'] = $pgm_name;
        if( ($this->input->post('email')) && ($this->input->post('password')))
        { 
            $loginFormData = $this->input->post();
            // Login API Method
            $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'login' ];
            // Method Type
            $method = 'POST';
            // Call API
            $data = $this->call_api($url,$method,$loginFormData);
            if ($data['login_ok'] == 'true')
            {   
                $this->session->set_flashdata('success', $data['message']);
                $this->session->set_userdata(array('user_details_data'=>$data));
                $this->session->set_userdata($this->current_session_name.'_is_logged_in_user', 'true');
				$response = array("status"=>SUCCESS_LOGIN_STATUS,"data"=>$data,"redirect"=>SUCCESS_LOGIN_REDIRECT);
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
        $this->data['sidebar'] = 'login';
        $this->template('User/login', $this->data, true);
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
        $this->is_exists_user_logged();
        $this->user_details_data = $this->session->userdata('user_details_data');
        $applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];
        $applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];
        $this->data['site_title'] = $this->data['page_title'] = 'Dashboard';
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'applicantstatus' ];
        $method = 'POST';
        $userdata = $this->session_userdata();
        $user_data['userdata'] = $userdata;
        $user_data['applicant_personal_det_id'] = $applicant_id;
        $user_data['applicant_login_id'] = $applicant_login_id;
        list($result_token,$data) = $this->_check_token($user_data);
        if($result_token['valid']=='true'){
          $result = $this->call_api ( $url , $method , $data );
          $this->data['applicantstatus_list'] = $result['data'];
         }
            $this->template('dashboard/dashboard', $this->data, true);
    }

     /**
     * Register page
     *
     * @param send user details
     * @return json response insert or not
     * @author
     */

    public function register($pgm_name = false)
    {

        $this->is_already_exists_user_logged();
        $this->data['page_title'] = USER_REGISTER_PAGE_TITLE;
        $this->data['save_button_name'] = REGISTER_BUTTON;
        $this->data['page_heading_name'] = REGISTER_HEADING;
        // $cap = $this->create_captcha(true);
        $this->data['captcha_image'] = $cap['image'];
        $captcha_from_path = 'register';
        $this->data['captcha_from_path'] = $captcha_from_path;
        // $this->data['jquery_validation_bootstrap_tooltip'] = true;
        $this->data['pgm_name'] = $pgm_name;
        if($pgm_name) {
            $app_dtn = $this->get_formregister($pgm_name);
            $this->data['pgm_formid'] = $app_dtn['app_form_id'];
        }
        
        if($this->input->post('email'))
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
                // echo '<pre>';
                // print_r($url);
                // print_r($method);
                // print_r($userFormData);
                // echo '</pre>';
                // die;
                // $userFormData = [];
                // $userFormData['email_id'] = $this->input->post('email', true);
                // $userFormData['mobile_no'] = $this->input->post('phone_no', true);
                // $userFormData['mob_country_code_id'] = $this->input->post('phone_no_code', true);
                // $userFormData['first_name'] = $this->input->post('display_name', true);
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
        $this->data['sidebar'] = 'login';
        $this->template('User/register', $this->data, true);
    }



    /**
     * get active countries list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_regcourse_dropdown() {
        $new_arr = $new_arr1 = array();
        $is_course = $this->input->get('is_course');
        $is_spec = $this->input->get('is_spec');
        $is_campus = $this->input->get('is_campus');
        $is_regcourse = $this->input->get('is_regcourse');
        $res = parent::_get_regcourse_dropdown(true, $this->is_admin);
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
        $returnResponse = $this->output->get_output();
        return $returnResponse;
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
        $this->data['sidebar'] = 'login';
        $this->template('User/forgot_password', $this->data, true);
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
            if($this->input->post('otp_data'))
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
        $this->session->unset_userdata('user_details_data');
        $this->session->unset_userdata($this->current_session_name.'_is_logged_in_user');
        redirect('/login', 'refresh');
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
        //$user_id = $userdata['user_details']['data'][0]['user_id'];
		$user_id = $userdata['user_details']['data'][0]['applicant_login_id'];
        $this->data['page_title'] = VIEW_PROFILE_PAGE_TITLE;
        $this->data['save_button_name'] = REGISTER_BUTTON;
        $this->data['page_heading_name'] = VIEW_PROFILE_PAGE_TITLE;
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'user' ] . "/" . $user_id;
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
     * get active district list by API call
     *
     * @return show API json response
     * @author
     */
    public function get_district() {
        parent::_get_district(false, $this->is_admin);
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

    public function check_verifylink($verify_text = false, $user_id = false , $pgm_name = false) {

        $this->data['verify_text'] = $verify_text;
        $this->data['user_id'] = $user_id;
        $this->data['pgm_name'] = $pgm_name;
        $this->data['is_international'] = $this->input->get('is_inter');
        if($verify_text) {
            $post_data = array (
                    'verify_text' => trim ($verify_text),
                    'user_id' => trim ($user_id)                   
                );
            $api_urls = $this->config->item ( 'api_urls' );
            $url = $api_urls[ 'check_verifylink' ];
            // Method Type
            $method = 'POST';
            //print_r($post_data);
            //die;
            // Call API
            $data = $this->call_api($url,$method,$post_data);

            if ($data['status'] == 'success')
            {
              $this->session->set_flashdata('success_verify', $data['message']);
            }
            else
            {
              $this->session->set_flashdata('error', $data['message']);
            }
    }
            
        $this->template('User/check_verify_link', $this->data, false);       
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