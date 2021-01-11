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

class Profile extends FrontendController
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
        $this->user_details_data = $this->session->userdata('user_details_data');
        $this->load->helper('cookie');
    }
	
	public function do_upload_view()
    {	
		$this->data['session_userdata'] = $this->session_userdata();
		// Display page with the template function from REST_Controller
		$this->template('profile/upload', $this->data, true);	
	}

    /**
     * [index description]
     *
     * @method index
     *
     * @return [type] [description]
     */
    public function do_upload()
    {
        $this->is_exists_main_cookie();
		$upload = array();
		$config = array(
			UPLOAD_PATH => UPLOAD_PATH_VALUE,
			ALLOWED_TYPES => ALLOWED_TYPES_VALUE,
			OVERWRITE => OVERWRITE_VALUE,
			MAX_SIZE => MAX_SIZE_VALUE, // Can be set to particular file size , here it is 2 MB(2048 Kb)
			MAX_HEIGHT => MAX_HEIGHT_VALUE,
			MAX_WIDTH => MAX_WIDTH_VALUE,
		);

		$this->load->library('upload', $config);
		if($this->upload->do_upload('userfile'))
		{
			$data = array('upload_data' => $this->upload->data());
			$upload['upload_success_data'] = 'File Uploaded';
			$upload['upload_data'] = $data;
			echo json_encode($upload);
		}else{
			$this->data = array();
			$upload['upload_error_data'] ='Invalid Format Or File Not Uploaded';
			echo json_encode($upload);
		}
    }

    /**
     * [index description]
     *
     * @method index
     *
     * @return [type] [description]
     */
    public function index()
    {
        $this->is_exists_user_logged();
        $this->data['site_title'] = 'Profile';

        $userdata = $this->session->userdata('user_details_data');
        $edit_user['userdata'] = $userdata;
        $data = $this->sess_token_user_exipry($edit_user);
        $user_id = $userdata['user_details']['data'][0]['user_id'];       
        $this->data['page_title'] = EDIT_PROFILE_PAGE_TITLE;
        $this->data['save_button_name'] = REGISTER_BUTTON;
        $this->data['page_heading_name'] = EDIT_PROFILE_PAGE_TITLE;
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'user' ] . "/" . $user_id;
        // Method Type
        $method = 'GET';
        $this->data['userdet']=  $this->call_api ( $url , $method, $data); 
        if ( $this->input->post ( 'submit', true ) ) 
        {
            $edit_user = array (
                    'user_name' => trim ($this->input->post('user_name', true)),
                    'display_name' => trim ($this->input->post('display_name', true)),
                    'phone_no' => trim ($this->input->post('phone_no', true)),
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
             // echo json_encode($data);
            // die;
        }
        // Display page with the template function from REST_Controller
        $this->template('profile/index', $this->data, true);
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
        $this->is_exists_user_logged();
        $applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];   
        $applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];
        $this->data['site_title'] = $this->data['page_title'] = 'Change Password';
        $userdata = $this->session->userdata('user_details_data');
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
