<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends FrontendController {
	
	// Declare CI Variable
	public $CI;

    /**
     * An array of variables to be passed through to the
     * view, layouts
     */	
	protected $data = array();
	
	public function __construct()
	{		
        // Parent Constructor start
        parent::__construct();
        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $this->CI =& get_instance();	
	}

	public function access()
	{
		$this->is_already_exists_admin_logged();
		// $this->data['login_title'] = LOGIN_TITLE;
		$this->data['site_title'] = 'Login';
		// $this->data['login_head'] = LOGIN_HEAD;
		// $this->data['login_button'] = LOGIN_BUTTON;
		// $this->data['login_username'] = LOGIN_USERNAME;
		// $this->data['login_password'] = LOGIN_PASSWORD;
		// $var = $this->input->post();
		if($this->input->post('submit') == 'true'){
			$loginFormData = $this->input->post();			
			// Login API Method
			$api_urls = $this->config->item ( 'api_urls' );
			$url = $api_urls[ 'login' ];
			// Method Type
			$method = 'POST';
			// Call API
			$data = $this->call_api($url,$method,$loginFormData);
			
			if ($data['login_ok'] == 'true'){
				$this->session->set_userdata(array('admin_details_data'=>$data));
				$this->session->set_userdata('is_logged_in_admin', 'true');				
			}
			echo json_encode($data);
			die;
		}

		 $this->template('login', $this->data, false);
	}
	
	public function dashboard()
    {
    	$this->is_exists_admin_logged();
    	$this->data['title'] = 'Dashboard';
    	$this->template('dashboard/index',$this->data, true);
    	// $this->template('dashboard/dashboard',$this->data, true);
    }
	
	public function logout()
	{
		$this->session->unset_userdata('is_logged_in_admin');
		$this->session->unset_userdata('admin_details_data');
		redirect('crm-admin/login', 'refresh');
	}	
}
