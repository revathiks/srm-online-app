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
 * @filesource
 * @todo       (description)
 *
 */

class MY_Controller extends MX_Controller
{
    //
    public $CI;

    /**
     * An array of variables to be passed through to the
     * view, layout
     */
    protected $data = array();

    public $mode;

    /**
     * [__construct description]
     *
     * @method __construct
     */
    public function __construct()
    {
        // To inherit directly the attributes of the parent class.
        parent::__construct();
		/* check is private ip*/
        $this->is_private_ip=$this->isValidIp();
        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $CI =& get_instance();
        $applicant_login_id =  $this->uri->segment(3);
        $applicant_personal_det_id = $this->uri->segment(4);
        $link_mode = $this->uri->segment(2);
        $this->mode = ($link_mode)? $link_mode:'';
        

        // Copyright year calculation for the footer
        $begin = $this->config->item('copyright_initial_year');
        $end =  date('Y');
        if($begin < $end) {
            $date = "$begin - $end";    
        } else {
            $date = "$begin";
        }
        
        $this->data['sitename'] = SITE_NAME;
        // Copyright
        $this->data['copyright'] = $date;
        $this->load->helper('common');
        $this->current_session_name = get_current_session_name();
    }

    public function is_exists_main_cookie() {
        // if($this->input->cookie('lockscreen',true) && $this->session->tempdata('lockscreen')) {
        if($this->session->userdata('is_logged_in')) {
            return true;
        } else {
            redirect('backend/access', 'refresh');
        }
    }

    //Check Session set when logged page
    public function is_not_exists_main_cookie() {
        if($this->session->tempdata('lockscreen')) {
            redirect('backend', 'refresh');
        }
    }

    /**
     * @param $url
     * @param $method
     * @param bool $userData
     * @return mixed
     */
    public function call_api($url, $method, $user_data = false ) {  
        $rest_valid_logins = $this->config->item('rest_valid_logins');        
        $rest_valid_login_key = array_keys($rest_valid_logins);
        $rest_valid_login_value = array_values($rest_valid_logins);
        // Auth credentials
        $username = $rest_valid_login_key[0];
        $password = $rest_valid_login_value[0];
        if($method === 'GET') {
            if(strripos($url, '/') !== false) {
                $str = substr($url, (strripos($url, '/') + 1));
                if(stripos($str, '?') !== false) {
                    $str = substr($str, 0, (strripos($str, '?')));
                }
                $newStr = urlencode($str);
                $url = str_replace($str, $newStr, $url);
            } 
        }
            $this->load->library('Curl');
            $this->curl->create($url);
            $this->curl->option(CURLOPT_TIMEOUT, 30);
            $this->curl->option(CURLOPT_RETURNTRANSFER, 1);
            $this->curl->option(CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            $this->curl->http_login($username, $password);

            //$this->curl->http_header('X-API-KEY', $apiKey);
            if (isset($user_data['headers'])) {
                foreach ($user_data['headers'] as $name => $value) { 
                    $this->curl->http_header($name, $value);
                }
            }else{
                $this->curl->http_header('X-API-KEY', $this->get_apikey());
            }
            
            if($method === 'GET') { $this->curl->get();}
            elseif ($method === 'POST') {  $this->curl->post($user_data); }       
            elseif ($method === 'PUT') {  $this->curl->put($user_data); }
            $result = $this->curl->execute();
        //     echo $result."result"."<br/>";
         // echo '<pre>';
         //print_r($url);
        // print_r($method);
        // print_r($user_data);
        // print_r($result);
        // echo '</pre>';
        // die; 
        if($this->curl->error_string) {
            log_message('error','error_code => '.$this->curl->error_code);
            log_message('error','error_string => '.$this->curl->error_string);
             echo 'error_code => '.$this->curl->error_code;
            echo 'error_string => '.$this->curl->error_string;
            die;
        } else {
            $data = json_decode($result, TRUE);  
            return $data;
        }
    }

    public function get_apikey()
    {
        $api_keys = $this->config->item('rest_keys_table');
        $key = $this->config->item('rest_key_column');
        $table_schema = SCHEMA_PHP_DEV;
        $this->set_schema($table_schema);
        $this->db->select($key);
        $this->db->from($table_schema.'.'.$api_keys);
        $this->db->where(array('status'=>1));
        $query = $this->db->get();
        $result = $query->result_array();
        $results = array();
        if($result) {
            foreach($result as $k=>$v) {
                $results[] = $v[$key];
            } 
        }
        // API key
        $apiKey = $results[0];

        return $apiKey;
    } 

    protected function _check_token($data = array()) 
    {
        // $user_data = $this->session_userdata();
		$this->load->library ( 'Authorization_Token' );
        $user_data = (isset($data['userdata']))?$data['userdata']:'';
        $data['headers']['x-api-key'] = $this->get_apikey();
        if(isset($data['user_login']))
        {
            $result_token = FALSE;  
        }
        else
        {
            $data['headers']['authorization'] = $user_data['access_token'] ;
             // Check Token Is Valid
            $result_token = $this->authorization_token->web_validate_token($data['headers']);
        }
        return array($result_token, $data);             
    }

    /**
     *
     */
    /*For Hide Sep 02 No Need */
    /*function is_already_admin_logged()
    {
        if ($this->session->userdata('is_logged_in_admin'))
        {
            redirect('dashboard/index');
        }
    }*/	
    /*For Hide Sep 02 No Need */
	
    // public function session_userdata()
    // {
        // $user_data = $this->session->userdata('crmadmin_details_data');
        // if(empty($user_data)) {
            // $user_data = $this->session->userdata('user_details_data');    
        // }
        // return $user_data;
    // }	
	
	public function session_userdata()
    {
        $user_data = $this->session->userdata('user_data');
        $admin_session=$this->session->userdata('crmadmin_details_data');
        $url_mode  = ($this->input->get('mode'))?$this->input->get('mode'):$this->input->post('mode');
        $reg_login_page = ($this->input->get('user_login'))?$this->input->get('user_login'):$this->input->post('user_login');
        //echo $url_mode."url_mode";die;
        if($this->mode == ADMIN_MODE_EDIT || $url_mode == ADMIN_MODE_EDIT)
        { 
           $user_data = $this->session->userdata('crmadmin_details_data'); 
           if(empty($user_data) && !$reg_login_page)
            {
                redirect('crm-admin/login', 'refresh');
            }
        }
        else if(empty($user_data)) {
            $user_data = $this->session->userdata('user_details_data'); 
            if(empty($user_data) && !$reg_login_page && empty($admin_session))
            {
                redirect('login', 'refresh');
            }
        }
        return $user_data;
    }	

    /*International Session*/

    public function session_internationaluserdata()
    {
        $user_data = $this->session->userdata('user_data');
        $url_mode  = ($this->input->get('mode'))?$this->input->get('mode'):$this->input->post('mode');
        $reg_login_page = ($this->input->get('user_login'))?$this->input->get('user_login'):$this->input->post('user_login');
        //echo $url_mode."url_mode";die;
        if($this->mode == ADMIN_MODE_EDIT || $url_mode == ADMIN_MODE_EDIT)
        { 
           $user_data = $this->session->userdata('crmadmin_details_data'); 
           /*if(empty($user_data) && !$reg_login_page)
            {
                redirect('crm-admin/login', 'refresh');
            }*/
        }
        else if(empty($user_data)) {
            $user_data = $this->session->userdata('international_user_details_data'); 
            /*if(empty($user_data) && !$reg_login_page)
            {
                redirect('international-form/login', 'refresh');
            }  */ 
        }
        return $user_data;
    }   	

    public function admin_session_userdata()
    {
        //$user_data = $this->session->userdata('userdata');
        $user_data = $this->session->userdata('crmadmin_details_data');
        return $user_data;
    }
	
    protected function template($template_name, $data, $return)
    {
        if ($return === true) {
            $content  = $this->load->view('templates/header', $this->data);
            $content .= $this->load->view('templates/main_header', $this->data);
            $content .= $this->load->view('templates/main_sidebar', $this->data);
            $content .= $this->load->view('templates/page_header', $this->data);
            $content .= $this->load->view('templates/page_inner_header', $this->data);
            $content .= $this->load->view('templates/page_inner_content_header', $this->data);
            $content .= $this->load->view($template_name, $this->data);
            $content .= $this->load->view('templates/page_inner_footer', $this->data);
            $current_module = $this->router->fetch_module();
            $script_file_path = APPPATH.$current_module.'/views/'.$template_name.'_scripts.'.EXT;
            if(file_exists($script_file_path))
            {
                $content .= $this->load->view($template_name.'_scripts', $this->data);
            }
            $content .= $this->load->view('templates/footer', $this->data);//$content .= $this->load->view('templates/control_sidebar', $this->data);

            return $content;
        } else {
            $this->load->view($template_name, $this->data);
        }
    }	

	public function json_return($data)
    {
        // Set Output Response As JSON
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
        // Get Output Response As JSON
        $returnResponse = $this->output->get_output();
        // Return Response AJAX
        return $returnResponse;
    }

    public function stream_list()
    {

        $session_id         = $this->session->userdata('user_data');      
        $header['headers']['Authorization'] = $session_id['access_token'];
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'streams' ];
        $url = $url;
        $page = 1;
        if ( !empty( $this->input->get ( 'page', true ) ) ) {
            $page = $this->input->get ( 'page', true );
        }
        $limit = PAGE_LIMIT;
        if ( !empty( $this->input->get ( 'limit', true ) ) ) {
            $limit = $this->input->get ( 'limit', true );
        }
        
        $method = 'GET';
        $query_data = array();
        if ( !empty( $this->input->get ( 'keywords', true ) ) ) {
            $keywords = $this->input->get ( 'keywords', true );
            $keywords = trim($keywords);
            $keywords = urlencode($keywords);
            $query_data['keywords'] = $keywords;
        }
        if ( !empty( $this->input->get ( 'sort_order', true ) ) && !empty( $this->input->get ( 'sort_by', true ) ) ) {
            $query_data['sort_order'] = $sort_order;
            $query_data['sort_by'] = $sort_by;
        }
        $query = http_build_query($query_data);

        $url = $url .'/'.$page.'/'.$limit;
        $url = $url .'?'.$query;      
        $result = $this->call_api ( $url , $method,false,$header );        
        if($result) {
            foreach($result['data'] as $k=>$v) {
                $result['data'][$k]['id'] = $v['stream_id'];
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
        $returnResponse = $this->output->get_output();
        return $returnResponse;
    }

    public function is_exists_user_logged() {
        // if($this->input->cookie('lockscreen',true) && $this->session->tempdata('lockscreen')) {
        if($this->session->userdata($this->current_session_name.'_is_logged_in_user')) {
            return true;
        } else if($this->session->userdata($this->current_session_name.'_is_logged_in_crmadmin')) {
            return true;
        } else {
            redirect('login', 'refresh');
        }
    }


    public function is_already_exists_user_logged()
    {
        if ($this->session->userdata($this->current_session_name.'_is_logged_in_user'))
        {
            redirect('dashboard');
        }

    }

    public function is_already_exists_admin_logged()
    {       
        if ($this->session->userdata($this->current_session_name.'_is_logged_in_crmadmin'))
        {
            redirect('crm-admin/dashboard');
        }

    }

    public function is_exists_admin_logged() {
        // if($this->input->cookie('lockscreen',true) && $this->session->tempdata('lockscreen')) {
        if ($this->session->userdata($this->current_session_name.'_is_logged_in_crmadmin')) {
            return true;
        } else {
            redirect('crm-admin/login', 'refresh');
        }
    }

    protected function _get_crmadmin_session() {
        return $this->session->userdata($this->current_session_name.'_is_logged_in_crmadmin');
    }

    protected function _unset_crmadmin_session() {
        return $this->session->unset_userdata($this->current_session_name.'_is_logged_in_crmadmin');
    }

    /*For Hide Sep 02 2020 No Need */
    /*public function is_exists_admin_cookie() {
        // if($this->input->cookie('lockscreen',true) && $this->session->tempdata('lockscreen')) {
        if($this->session->userdata('is_logged_in_admin')) {
            return true;
        } else {
            redirect('user/', 'refresh');
        }
    }*/
    /*For Hide Sep 02 2020 No Need */

    /*International User Start*/

    public function is_exists_international_user_logged() {
        // if($this->input->cookie('lockscreen',true) && $this->session->tempdata('lockscreen')) {
        if($this->session->userdata($this->current_session_name.'_is_logged_in_international_user')) {
            return true;
        } else if($this->session->userdata($this->current_session_name.'_is_logged_in_crmadmin')) {
            return RETURN_ADMIN;
        } else {
            redirect('international-form/login', 'refresh');
        }
    }

    public function is_already_exists_international_user_logged()
    {
        if ($this->session->userdata($this->current_session_name.'_is_logged_in_international_user'))
        {
            redirect('international_dashboard');
        }

    }

    /*International USer End*/

    public function sess_token_user_exipry($datas = false)
    {
        
        list($result_token,$data) = $this->_check_token($datas);
        if($result_token['valid']=='true'){
            return $data;
        }
        else {
            redirect('user/', 'refresh');
        }        
    }
	
	public function send_mail($subject,$message,$from,$to)
    {
        // Get full html:
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
            <title>' . html_escape($subject) . '</title>
            <style type="text/css">
                body {
                    font-family: Arial, Verdana, Helvetica, sans-serif;
                    font-size: 16px;
                }
            </style>
        </head>
        <body>
        ' . $message . '
        </body>
        </html>';
         $result = $this->email
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->message($body)
            ->send();
       return $result;       
    }

    protected function _get_mobile_codes($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['mobile_codes'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_select($url_config,$return = false,$is_admin = false,$method = false ,
        $reg_page = false, $is_international = false) {
		if ( !empty( $this->input->get ( 'is_lookup_master', true ) ) ) {
            $is_look_up_master = $this->input->get ( 'is_lookup_master', true );
            $is_look_up_master = trim($is_look_up_master);
        } else if ( !empty( $this->input->post ( 'is_lookup_master', true ) ) ) {
            $is_look_up_master = $this->input->post ( 'is_lookup_master', true );
            $is_look_up_master = trim($is_look_up_master);
        }
        if(!isset($is_look_up_master)) {
            $page = 1;
            if ( !empty( $this->input->get ( 'page', true ) ) ) {
                $page = $this->input->get ( 'page', true );
            } else if ( !empty( $this->input->post ( 'page', true ) ) ) {
                $page = $this->input->post ( 'page', true );
            }
            $limit = PAGE_LIMIT;
            if ( !empty( $this->input->get ( 'limit', true ) ) ) {
                $limit = $this->input->get ( 'limit', true );
            } else if ( !empty( $this->input->post ( 'limit', true ) ) ) {
                $limit = $this->input->post ( 'limit', true );
            }
            $url = $url_config.'/'.$page.'/'.$limit;   
        } else {
            $url = $url_config;
        }
        // $lang = $this->config->item ( 'language' );
        // $url = $url . '?lang=' . $lang;
        $method = ($method)?$method:'GET';

        $query_data = array();
        if ( !empty( $this->input->get ( 'is_unique', true ) ) && !empty( $this->input->get ( 'unique_field', true ) )) {
            if ( !empty( $this->input->get ( 'is_unique', true ) ) ) {
                $is_unique = $this->input->get ( 'is_unique', true );
                $is_unique = trim($is_unique);
                $query_data['is_unique'] = $is_unique;
            }
            if ( !empty( $this->input->get ( 'unique_field', true ) ) ) {
                $unique_field = $this->input->get ( 'unique_field', true );
                $unique_field = trim($unique_field);
                $query_data['unique_field'] = $unique_field;
            }
        } elseif ( !empty( $this->input->post ( 'is_unique', true ) ) && !empty( $this->input->post ( 'unique_field', true ) )) {
            if ( !empty( $this->input->post ( 'is_unique', true ) ) ) {
                $is_unique = $this->input->post ( 'is_unique', true );
                $is_unique = trim($is_unique);
                $query_data['is_unique'] = $is_unique;
            }
            if ( !empty( $this->input->post ( 'unique_field', true ) ) ) {
                $unique_field = $this->input->post ( 'unique_field', true );
                $unique_field = trim($unique_field);
                $query_data['unique_field'] = $unique_field;
            }
        } else {
            $is_check_status = false;
            if ( !empty( $this->input->get ( 'is_check_status', true ) ) ) {
                $is_check_status = $this->input->get ( 'is_check_status', true );
                $is_check_status = trim($is_check_status);
            } else if ( !empty( $this->input->post ( 'is_check_status', true ) ) ) {
                $is_check_status = $this->input->post ( 'is_check_status', true );
                $is_check_status = trim($is_check_status);
            }
            if(!$is_check_status) {
                $query_data['status'] = 1;
            }
        }
        if ( !empty( $this->input->get ( 'except_ids', true ) ) ) {
            $except_ids = $this->input->get ( 'except_ids', true );
            $except_ids = trim($except_ids);
            $query_data['except_ids'] = $except_ids;
        } else if ( !empty( $this->input->post ( 'except_ids', true ) ) ) {
            $except_ids = $this->input->post ( 'except_ids', true );
            // $except_ids = trim($except_ids);
            $query_data['except_ids'] = json_encode($except_ids);
        }
        if ( !empty( $this->input->get ( 'is_except_ids_exists', true ) ) ) {
            $is_except_ids_exists = $this->input->get ( 'is_except_ids_exists', true );
            $is_except_ids_exists = trim($is_except_ids_exists);
            $query_data['is_except_ids_exists'] = $is_except_ids_exists;
        } else if ( !empty( $this->input->post ( 'is_except_ids_exists', true ) ) ) {
            $is_except_ids_exists = $this->input->post ( 'is_except_ids_exists', true );
            // $is_except_ids_exists = trim($is_except_ids_exists);
            $query_data['is_except_ids_exists'] = json_encode($is_except_ids_exists);
        }
        if ( !empty( $this->input->get ( 'keywords', true ) ) ) {
            $keywords = $this->input->get ( 'keywords', true );
            $keywords = trim($keywords);
            $keywords = urlencode($keywords);
            $query_data['keywords'] = $keywords;
        } else if ( !empty( $this->input->post ( 'keywords', true ) ) ) {
            $keywords = $this->input->post ( 'keywords', true );
            $keywords = trim($keywords);
            $keywords = urlencode($keywords);
            $query_data['keywords'] = $keywords;
        }
        if ( !empty( $this->input->get ( 'user_login', true ) ) ) {
            $user_login = $this->input->get ( 'user_login', true );
            $user_login = trim($user_login);
            $query_data['user_login'] = $user_login;
        } else if ( !empty( $this->input->post ( 'user_login', true ) ) ) {
            $user_login = $this->input->post ( 'user_login', true );
            $user_login = trim($user_login);
            $query_data['user_login'] = $user_login;
        }
        if ( !empty( $this->input->get ( 'for_register', true ) ) ) {
            $for_register = $this->input->get ( 'for_register', true );
            $for_register = trim($for_register);
            $query_data['for_register'] = $for_register;
        } else if ( !empty( $this->input->post ( 'for_register', true ) ) ) {
            $for_register = $this->input->post ( 'for_register', true );
            $for_register = trim($for_register);
            $query_data['for_register'] = $for_register;
        }
        if ( !empty( $this->input->get ( 'is_international', true ) ) ) {
            $for_international = $this->input->get ( 'is_international', true );
            $for_international = trim($for_international);
            $query_data['is_international'] = $for_international;
        } else if ( !empty( $this->input->post ( 'is_international', true ) ) ) {
            $for_international = $this->input->post ( 'is_international', true );
            $for_international = trim($for_international);
            $query_data['is_international'] = $for_international;
        }

        
        if ( !empty( $this->input->get ( 'country_id', true ) ) ) {
            $country_id = $this->input->get ( 'country_id', true );
            $country_id = trim($country_id);
            $query_data['country_id'] = $country_id;
        } else if ( !empty( $this->input->post ( 'country_id', true ) ) ) {
            $country_id = $this->input->post ( 'country_id', true );
            $country_id = trim($country_id);
            $query_data['country_id'] = $country_id;
        }
        if ( !empty( $this->input->get ( 'state_id', true ) ) ) {
            $state_id = $this->input->get ( 'state_id', true );
            $state_id = trim($state_id);
            $query_data['state_id'] = $state_id;
        } else if ( !empty( $this->input->post ( 'state_id', true ) ) ) {
            $state_id = $this->input->post ( 'state_id', true );
            $state_id = trim($state_id);
            $query_data['state_id'] = $state_id;
        }
        if ( !empty( $this->input->get ( 'exclude_city_ids', true ) ) ) {
            $exclude_city_ids = $this->input->get ( 'exclude_city_ids', true );
            $exclude_city_ids = trim($exclude_city_ids);
            $query_data['exclude_city_ids'] = $exclude_city_ids;
        } else if ( !empty( $this->input->post ( 'exclude_city_ids', true ) ) ) {
            $exclude_city_ids = $this->input->post ( 'exclude_city_ids', true );
            $exclude_city_ids = trim($exclude_city_ids);
            $query_data['exclude_city_ids'] = $exclude_city_ids;
        }
        if ( !empty( $this->input->get ( 'exclude_specialization_ids', true ) ) ) {
            $exclude_specialization_ids = $this->input->get ( 'exclude_specialization_ids', true );
            $exclude_specialization_ids = trim($exclude_specialization_ids);
            $query_data['exclude_specialization_ids'] = $exclude_specialization_ids;
        } else if ( !empty( $this->input->post ( 'exclude_specialization_ids', true ) ) ) {
            $exclude_specialization_ids = $this->input->post ( 'exclude_specialization_ids', true );
            $exclude_specialization_ids = trim($exclude_specialization_ids);
            $query_data['exclude_specialization_ids'] = $exclude_specialization_ids;
        }

        if ( !empty( $this->input->get ( 'exclude_campuspref_ids', true ) ) ) {
            $exclude_campuspref_ids = $this->input->get ( 'exclude_campuspref_ids', true );
            $exclude_campuspref_ids = trim($exclude_campuspref_ids);
            $query_data['exclude_campuspref_ids'] = $exclude_campuspref_ids;
        } else if ( !empty( $this->input->post ( 'exclude_campuspref_ids', true ) ) ) {
            $exclude_campuspref_ids = $this->input->post ( 'exclude_campuspref_ids', true );
            $exclude_campuspref_ids = trim($exclude_campuspref_ids);
            $query_data['exclude_campuspref_ids'] = $exclude_campuspref_ids;
        }

        if ( !empty( $this->input->get ( 'exclude_coursepref_ids', true ) ) ) {
            $exclude_coursepref_ids = $this->input->get ( 'exclude_coursepref_ids', true );
            $exclude_coursepref_ids = trim($exclude_coursepref_ids);
            $query_data['exclude_coursepref_ids'] = $exclude_coursepref_ids;
        } else if ( !empty( $this->input->post ( 'exclude_coursepref_ids', true ) ) ) {
            $exclude_coursepref_ids = $this->input->post ( 'exclude_coursepref_ids', true );
            $exclude_coursepref_ids = trim($exclude_coursepref_ids);
            $query_data['exclude_coursepref_ids'] = $exclude_coursepref_ids;
        }


        

        $query_data = $this->_set_url_query($query_data,'email');
        $query_data = $this->_set_url_query($query_data,'phone_no');
        $query_data = $this->_set_url_query($query_data,'grad_id');
        $query_data = $this->_set_url_query($query_data,'deg_id');
        $query_data = $this->_set_url_query($query_data,'campus_id');
        $query_data = $this->_set_url_query($query_data,'branch_id');
        $query_data = $this->_set_url_query($query_data,'is_father');
        $query_data = $this->_set_url_query($query_data,'is_mother');
        $query_data = $this->_set_url_query($query_data,'is_course');
        $query_data = $this->_set_url_query($query_data,'is_spec');
        $query_data = $this->_set_url_query($query_data,'is_campus');
        $query_data = $this->_set_url_query($query_data,'is_distinct');
        $query_data = $this->_set_url_query($query_data,'form_id');
        $query_data = $this->_set_url_query($query_data,'is_regcourse');
        $query_data = $this->_set_url_query($query_data,'is_program');
        $query_data = $this->_set_url_query($query_data,'grad_mode_id');
        $query_data = $this->_set_url_query($query_data,'is_stream');
        $query_data = $this->_set_url_query($query_data,'stream_id');
        
        if ( !empty( $this->input->get ( 'sort_by', true ) ) && !empty( $this->input->get ( 'sort_order', true ) ) ) {
            $sort_order = $this->input->get ( 'sort_order', true );
            $sort_by = $this->input->get ( 'sort_by', true );
            $query_data['sort_order'] = $sort_order;
            $query_data['sort_by'] = $sort_by;
        } else if ( !empty( $this->input->post ( 'sort_by', true ) ) && !empty( $this->input->post ( 'sort_order', true ) ) ) {
            $sort_order = $this->input->post ( 'sort_order', true );
            $sort_by = $this->input->post ( 'sort_by', true );
            $query_data['sort_order'] = $sort_order;
            $query_data['sort_by'] = $sort_by;
        } else {
            $query_data['sort_order'] = 'asc'; 
        }

        if($is_admin) {
            $userdata = $this->admin_session_userdata();
        }elseif($is_international) {
            $userdata = $this->session_internationaluserdata();
        }else {
            $userdata = $this->session_userdata();    
        }


        if ( !empty( $this->input->get ( 'appform_id', true ) ) ) {
            $appform_id = $this->input->get ( 'appform_id', true );
            $appform_id = trim($appform_id);
            $query_data['appform_id'] = $appform_id;
        } 
        
        $user_data = array();
        $user_data['userdata'] = $userdata;
        if(isset($user_login)) {
            $user_data['user_login'] = $user_login;    
            $user_data['action'] = 'login';    
        }
        if(!$reg_page){
        list($result_token,$user_data) = $this->_check_token($user_data);
        }     
        
        $flag = false;
        if(!$result_token && $user_login)
        {
            $flag = true;
        } else if($result_token['valid']=='true') {
            $flag = true;
        }

        if($reg_page)
        {
            $flag = true;
        }

        if($flag == true){
            if($method == 'GET') {
                $query = http_build_query($query_data);
                $url = $url .'?'.$query;
            } else {
                $user_data = $query_data;
            }
            

            $data = $this->call_api ( $url , $method, $user_data );
            if($data) {
                if(isset($data['data'])) {
                    if($data['data']) {
                        foreach($data['data'] as $k=>$v) {
                            if(isset($v['first_name']) && isset($v['last_name'])) {
                                if($v['first_name'] && $v['last_name']) {
                                    $data['data'][$k]['name'] = $v['first_name'] .' '. $v['last_name'];
                                }
                            }
                            if(isset($v['model_name'])) {
                                if($v['model_name']) {
                                    $data['data'][$k]['name'] = $v['model_name'];
                                }
                            }
                        }    
                    }
                }
            }
        } else {
            $data[ 'status' ] = false;
            $data[ 'message' ] = $this->lang->line ( 'invalid_token' );
        }
        if($return === true) {
            return $data;
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
            $returnResponse = $this->output->get_output();
            return $returnResponse;
        }		
        /* $page = 1;
        if ( !empty( $this->input->get ( 'page', true ) ) ) {
            $page = $this->input->get ( 'page', true );
        } else if ( !empty( $this->input->post ( 'page', true ) ) ) {
            $page = $this->input->post ( 'page', true );
        }
        $limit = PAGE_LIMIT;
        if ( !empty( $this->input->get ( 'limit', true ) ) ) {
            $limit = $this->input->get ( 'limit', true );
        } else if ( !empty( $this->input->post ( 'limit', true ) ) ) {
            $limit = $this->input->post ( 'limit', true );
        }
        $url = $url_config.'/'.$page.'/'.$limit;
        // $lang = $this->config->item ( 'language' );
        // $url = $url . '?lang=' . $lang;
        $method = ($method)?$method:'GET';

        $query_data = array();
        if ( !empty( $this->input->get ( 'is_unique', true ) ) && !empty( $this->input->get ( 'unique_field', true ) )) {
            if ( !empty( $this->input->get ( 'is_unique', true ) ) ) {
                $is_unique = $this->input->get ( 'is_unique', true );
                $is_unique = trim($is_unique);
                $query_data['is_unique'] = $is_unique;
            }
            if ( !empty( $this->input->get ( 'unique_field', true ) ) ) {
                $unique_field = $this->input->get ( 'unique_field', true );
                $unique_field = trim($unique_field);
                $query_data['unique_field'] = $unique_field;
            }
        } elseif ( !empty( $this->input->post ( 'is_unique', true ) ) && !empty( $this->input->post ( 'unique_field', true ) )) {
            if ( !empty( $this->input->post ( 'is_unique', true ) ) ) {
                $is_unique = $this->input->post ( 'is_unique', true );
                $is_unique = trim($is_unique);
                $query_data['is_unique'] = $is_unique;
            }
            if ( !empty( $this->input->post ( 'unique_field', true ) ) ) {
                $unique_field = $this->input->post ( 'unique_field', true );
                $unique_field = trim($unique_field);
                $query_data['unique_field'] = $unique_field;
            }
        } else {
            $is_check_status = false;
            if ( !empty( $this->input->get ( 'is_check_status', true ) ) ) {
                $is_check_status = $this->input->get ( 'is_check_status', true );
                $is_check_status = trim($is_check_status);
            } else if ( !empty( $this->input->post ( 'is_check_status', true ) ) ) {
                $is_check_status = $this->input->post ( 'is_check_status', true );
                $is_check_status = trim($is_check_status);
            }
            if(!$is_check_status) {
                $query_data['status'] = 1;
            }
        }
        if ( !empty( $this->input->get ( 'except_ids', true ) ) ) {
            $except_ids = $this->input->get ( 'except_ids', true );
            $except_ids = trim($except_ids);
            $query_data['except_ids'] = $except_ids;
        } else if ( !empty( $this->input->post ( 'except_ids', true ) ) ) {
            $except_ids = $this->input->post ( 'except_ids', true );
            // $except_ids = trim($except_ids);
            $query_data['except_ids'] = json_encode($except_ids);
        }
        if ( !empty( $this->input->get ( 'is_except_ids_exists', true ) ) ) {
            $is_except_ids_exists = $this->input->get ( 'is_except_ids_exists', true );
            $is_except_ids_exists = trim($is_except_ids_exists);
            $query_data['is_except_ids_exists'] = $is_except_ids_exists;
        } else if ( !empty( $this->input->post ( 'is_except_ids_exists', true ) ) ) {
            $is_except_ids_exists = $this->input->post ( 'is_except_ids_exists', true );
            // $is_except_ids_exists = trim($is_except_ids_exists);
            $query_data['is_except_ids_exists'] = json_encode($is_except_ids_exists);
        }
        if ( !empty( $this->input->get ( 'keywords', true ) ) ) {
            $keywords = $this->input->get ( 'keywords', true );
            $keywords = trim($keywords);
            $keywords = urlencode($keywords);
            $query_data['keywords'] = $keywords;
        } else if ( !empty( $this->input->post ( 'keywords', true ) ) ) {
            $keywords = $this->input->post ( 'keywords', true );
            $keywords = trim($keywords);
            $keywords = urlencode($keywords);
            $query_data['keywords'] = $keywords;
        }
        if ( !empty( $this->input->get ( 'user_login', true ) ) ) {
            $user_login = $this->input->get ( 'user_login', true );
            $user_login = trim($user_login);
            $query_data['user_login'] = $user_login;
        } else if ( !empty( $this->input->post ( 'user_login', true ) ) ) {
            $user_login = $this->input->post ( 'user_login', true );
            $user_login = trim($user_login);
            $query_data['user_login'] = $user_login;
        }
        if ( !empty( $this->input->get ( 'for_register', true ) ) ) {
            $for_register = $this->input->get ( 'for_register', true );
            $for_register = trim($for_register);
            $query_data['for_register'] = $for_register;
        } else if ( !empty( $this->input->post ( 'for_register', true ) ) ) {
            $for_register = $this->input->post ( 'for_register', true );
            $for_register = trim($for_register);
            $query_data['for_register'] = $for_register;
        }
        if ( !empty( $this->input->get ( 'country_id', true ) ) ) {
            $country_id = $this->input->get ( 'country_id', true );
            $country_id = trim($country_id);
            $query_data['country_id'] = $country_id;
        } else if ( !empty( $this->input->post ( 'country_id', true ) ) ) {
            $country_id = $this->input->post ( 'country_id', true );
            $country_id = trim($country_id);
            $query_data['country_id'] = $country_id;
        }
        if ( !empty( $this->input->get ( 'state_id', true ) ) ) {
            $state_id = $this->input->get ( 'state_id', true );
            $state_id = trim($state_id);
            $query_data['state_id'] = $state_id;
        } else if ( !empty( $this->input->post ( 'state_id', true ) ) ) {
            $state_id = $this->input->post ( 'state_id', true );
            $state_id = trim($state_id);
            $query_data['state_id'] = $state_id;
        }
        $query_data = $this->_set_url_query($query_data,'email');
        $query_data = $this->_set_url_query($query_data,'phone_no');
        if ( !empty( $this->input->get ( 'sort_by', true ) ) && !empty( $this->input->get ( 'sort_order', true ) ) ) {
            $sort_order = $this->input->get ( 'sort_order', true );
            $sort_by = $this->input->get ( 'sort_by', true );
            $query_data['sort_order'] = $sort_order;
            $query_data['sort_by'] = $sort_by;
        } else if ( !empty( $this->input->post ( 'sort_by', true ) ) && !empty( $this->input->post ( 'sort_order', true ) ) ) {
            $sort_order = $this->input->post ( 'sort_order', true );
            $sort_by = $this->input->post ( 'sort_by', true );
            $query_data['sort_order'] = $sort_order;
            $query_data['sort_by'] = $sort_by;
        } else {
            $query_data['sort_order'] = 'asc'; 
        }
        if($is_admin) {
            $userdata = $this->admin_session_userdata();
        } else {
            $userdata = $this->session_userdata();    
        }

        if ( !empty( $this->input->get ( 'appform_id', true ) ) ) {
            $appform_id = $this->input->get ( 'appform_id', true );
            $appform_id = trim($appform_id);
            $query_data['appform_id'] = $appform_id;
        } 
        
        $user_data = array();
        $user_data['userdata'] = $userdata;
        if(isset($user_login)) {
            $user_data['user_login'] = $user_login;    
            $user_data['action'] = 'login';    
        }
        list($result_token,$user_data) = $this->_check_token($user_data);     
        
        $flag = false;
        if(!$result_token && $user_login)
        {
            $flag = true;
        } else if($result_token['valid']=='true') {
            $flag = true;
        }

        if($flag == true){
            if($method == 'GET') {
                $query = http_build_query($query_data);
                $url = $url .'?'.$query;
            } else {
                $user_data = $query_data;
            }


            $data = $this->call_api ( $url , $method, $user_data );
            if($data) {
                if(isset($data['data'])) {
                    if($data['data']) {
                        foreach($data['data'] as $k=>$v) {
                            if(isset($v['first_name']) && isset($v['last_name'])) {
                                if($v['first_name'] && $v['last_name']) {
                                    $data['data'][$k]['name'] = $v['first_name'] .' '. $v['last_name'];
                                }
                            }
                            if(isset($v['model_name'])) {
                                if($v['model_name']) {
                                    $data['data'][$k]['name'] = $v['model_name'];
                                }
                            }
                        }    
                    }
                }
            }
        } else {
            $data[ 'status' ] = false;
            $data[ 'message' ] = $this->lang->line ( 'invalid_token' );
        }
        if($return === true) {
            return $data;
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
            $returnResponse = $this->output->get_output();
            return $returnResponse;
        }*/
    }

    protected function set_schema($table_schema) {
        if(!$table_schema) {
            return false;
        }
        if($this->db->dbdriver == 'postgre' && $table_schema) {
            $this->db->simple_query('SET search_path TO ' . $table_schema . ',public');
        }    
    }

    protected function _get_states($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['states'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_cities($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['cities'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_district($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['districts'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_degrees($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['degrees'];	
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_users($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['users'];
        return $this->_get_select($url_config,$return,$is_admin);
    }
	
    protected function _get_bloodgroups($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['bloodgroups'];
        return $this->_get_select($url_config,$return,$is_admin);
    }	

    protected function _set_url_query($query_data,$param_name) {
        if ( !empty( $this->input->get ( $param_name, true ) ) ) {
            $val = $this->input->get ( $param_name, true );
            $val = trim($val);
            $query_data[$param_name] = $val;
        } else if ( !empty( $this->input->post ( $param_name, true ) ) ) {
            $val = $this->input->post ( $param_name, true );
            $val = trim($val);
            $query_data[$param_name] = $val;
        }
        return $query_data;
    }

    protected function _get_nationalities($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['nationalities'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_mtechrecampus_preference($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['mtechrecampusprefer'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_mtechrespecialization_preference($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['mtechrespecializationprefer'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_mtechrereligion($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['get_mtechrereligion'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_mtechremothertong($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['get_mtechremothertong'];
        return $this->_get_select($url_config,$return,$is_admin);
    }
    

    protected function _get_courses($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['courses'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_specializations($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['specializations'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_campuses($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['campuses'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_appcourses($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['app_courses'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_graduations($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['graduations'];
        return $this->_get_select($url_config,$return,$is_admin);
    }	

    protected function _get_gender_title($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['user_gender_title'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_resident_category($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['resident_category'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_relation_sponsor($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['relation_sponsor'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    	
    protected function _get_qualifying_degree($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['qualifying_degrees'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_spec_qualifying_degree($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['spec_qualifying_degrees'];
        return $this->_get_select($url_config,$return,$is_admin);
    }	

    /*International Select2data Start*/

    protected function _get_examination_list($return = false, $is_admin = false)
    {
        $api_urls = $this->config->item ( 'api_urls' );        
        $url_config = $api_urls['examination_list'];
        $is_inter_form =TRUE;
        return $this->_get_select($url_config,$return,$is_admin,false,false,$is_inter_form);
    }

    protected function _get_subject_list($return = false, $is_admin = false)
    {
        $api_urls = $this->config->item ( 'api_urls' );        
        $url_config = $api_urls['subject_list'];
        $is_inter_form =TRUE;
        return $this->_get_select($url_config,$return,$is_admin,false,false,$is_inter_form);
    }

    protected function _get_resident_international_category($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['resident_category'];
        $is_inter_form =TRUE;
        return $this->_get_select($url_config,$return,$is_admin,false,false,$is_inter_form);
     }

     protected function _get_relation_international_sponsor($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['relation_sponsor'];
        $is_inter_form =TRUE;
        return $this->_get_select($url_config,$return,$is_admin,false,false,$is_inter_form);
    }

    protected function _get_international_title($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['user_gender_title'];
        $is_inter_form =TRUE;
        return $this->_get_select($url_config,$return,$is_admin,false,false,$is_inter_form);
    }

    protected function _get_international_mobile_codes($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['mobile_codes'];
        $is_inter_form =TRUE;
        return $this->_get_select($url_config,$return,$is_admin,false,false,$is_inter_form);
    }

    protected function _get_international_gender($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['user_gender'];
        $is_inter_form =TRUE;
        return $this->_get_select($url_config,$return,$is_admin,false,false,$is_inter_form);
    }

    protected function _get_international_nationality($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['nationalities'];
        $is_inter_form =TRUE;
        return $this->_get_select($url_config,$return,$is_admin,false,false,$is_inter_form);
    }

    protected function _get_international_countries($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['countries'];
        $is_inter_form =TRUE;
        return $this->_get_select($url_config,$return,$is_admin,false,false,$is_inter_form);
    }

     protected function _get_international_states($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['states'];
        $is_inter_form =TRUE;
        return $this->_get_select($url_config,$return,$is_admin,false,false,$is_inter_form);
    }

    protected function _get_international_cities($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['cities'];
        $is_inter_form =TRUE;
        return $this->_get_select($url_config,$return,$is_admin,false,false,$is_inter_form);
    }

    protected function _get_international_marking_scheme($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['user_marking_scheme'];
        $is_inter_form =TRUE;
        return $this->_get_select($url_config,$return,$is_admin,false,false,$is_inter_form);
    }
    
    protected function _get_international_banks($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['bank_lists'];
        $is_inter_form =TRUE;
        return $this->_get_select($url_config,$return,$is_admin,false,false,$is_inter_form);
    }



    

    protected function _get_international_parent_occupation($return = false, $is_admin = false) {
        /*$api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['parent_occupation'];
        $is_inter_form =TRUE;
        $result = $this->_get_select($url_config,$return,$is_admin,false,false,$is_inter_form);
        print_r($result)
        return $this->_get_select($url_config,$return,$is_admin,false,false,$is_inter_form);*/
        $session_id = $this->session->userdata('international_user_details_data');
        $header['headers']['Authorization'] = $session_id['access_token'];
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'parent_occupation' ];
        
        $query_data = array();
        $keywords = $_GET['keywords'];
        $method = 'GET';
        if(!empty($keywords)){            
            $query_data['keywords'] = $keywords;
        }
        
        $query = http_build_query($query_data);
        $url = $url .'?'.$query;
        $result = $this->call_api ($url,$method,false,$header);
        if($result){
            $data['data']=$result['data'];
            if($data['data']==null || $data['data']=='null'){
                $no_data = array("status"=>false,"message"=>false);
                $this->output->set_content_type('application/json')->set_output(json_encode($no_data));
                $returnResponse = $this->output->get_output();
                return $returnResponse;
            }else{
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
                $returnResponse = $this->output->get_output();
                return $returnResponse;             
            }
        }
    }

    


    
	

    /*International Select2data End*/

    protected function _get_working_dsc($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['departments'];
        return $this->_get_select($url_config,$return,$is_admin);
    }	

    protected function _get_faculty($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['faculties'];
        return $this->_get_select($url_config,$return,$is_admin);
    }		
	
    protected function _get_work_category($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['user_work_category'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_are_you_employed($return = false, $is_admin = false) {
        $arr_work_experience = $this->config->item ( 'are_you_employed' );
        return $this->_get_select_data($arr_work_experience,$return);
    }

    protected function _get_working_place($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['user_working_place'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_banks($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['bank_lists'];
        return $this->_get_select($url_config,$return,$is_admin);
    }	

    protected function _get_select_data($arr_data, $return = false) {
		/* $keywords = $this->input->get('keywords');
		$keywords = substr($keywords, 0, 1);
		if($keywords=="y" || $keywords=="Y"){
			$arr_data = array('yes' => 'Yes');
		}elseif($keywords=="n" || $keywords=="N"){
			$arr_data = array('no' => 'No');
		} */
		$keywords = $this->input->get('keywords');
        $data = [];
        $new_data = [];
        if($arr_data) {
            if ( !empty( $this->input->get ( 'keywords', true ) ) ) {
                $i = 0;
                foreach($arr_data as $k=>$v) {
                    if(stripos($v, $keywords) !== false)
                    {
                    $new_data[$i]['id'] = $k;
                    $new_data[$i]['name'] = $v;
                    $i++; 
                    }
                    
                }  
            }
            else
            {
                $i = 0;
                foreach($arr_data as $k=>$v) {
                    $new_data[$i]['id'] = $k;
                    $new_data[$i]['name'] = $v;
                    $i++;
                }        
            }
       }
        $data['data'] = $new_data;
        if($return === true) {
            return $data;
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
            $returnResponse = $this->output->get_output();
            return $returnResponse;
        }
    }

    protected function _get_gender($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['user_gender'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_social_status($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['user_social_status'];
        return $this->_get_select($url_config,$return,$is_admin);
    }
	
    protected function _get_are_you_differently_abled($return = false, $is_admin = false) {
        $arr_nature_of_deformity = $this->config->item ( 'are_you_differenlty_abled' );
        return $this->_get_select_data($arr_nature_of_deformity,$return);
    }	

    protected function _get_nature_of_deformity($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['user_nature_deformity'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_percentage_of_deformity($return = false, $is_admin = false) {
		$arr_percent_of_deformity = $this->config->item ( 'percentage_of_deformity' );
        return $this->_get_select_data($arr_percent_of_deformity,$return);
    }

    protected function _upload_files ($foldername = false, $upload_post_file_name, $upload_type, $fk_id, $applicant_login_id = false, $is_edit = false, $app_form_id = false)
    {
        $upload_folder_name = 'uploads/';
        $upload_path = FCPATH . $upload_folder_name;
        $upload_url = base_url($upload_folder_name);


        if ( !is_dir ( $upload_path ) ) {
            mkdir ( $upload_path , 0777 );
        }
        if($foldername) {
            $foldername = str_replace(' ', '_', $foldername);
            $upload_path .= $foldername;
            $upload_url .= $foldername;
            if ( !is_dir ( $upload_path ) ) {
                mkdir ( $upload_path , 0777 );
            }    
        }
        
        $upload_date_folder_name = date ( 'Y-m-d' ) . '/';
        $upload_path .= $upload_date_folder_name;
        $upload_url .= $upload_date_folder_name;
        if ( !is_dir ( $upload_path ) ) {
            mkdir ( $upload_path , 0777 );
        }

        $max_file_size = $this->input->post( 'chk_max_file_size',true );
        $max_file_size = ($max_file_size)?$max_file_size:MAX_FILE_SIZE;
        $max_file_size_js = $this->input->post( 'max_file_size_js',true );
        $max_file_size_js = ($max_file_size_js)?$max_file_size_js:MAX_FILE_SIZE_JS;
        $file_extension = $this->input->post( 'file_extension',true );
        $file_extension = ($file_extension)?$file_extension:FILE_ALLOWED_TYPE;
        $is_international = $this->input->post( 'is_international',true );
        $is_international=($is_international)?$is_international:'';
		$mode = $this->input->post( 'mode',true );
		$mode=($mode)?$mode:'';
		$applicant_personal_det_id = $this->input->post( 'applicant_id',true );
		$applicant_personal_det_id=($applicant_personal_det_id)?$applicant_personal_det_id:'';
		$created_updated_by=($mode)?CRM_ADMIN_USER_ROLE_ID:$applicant_personal_det_id;
		
        //Upload to the local server
        $config[ 'upload_path' ] = $upload_path;
        $config[ 'allowed_types' ] = $file_extension;
        $config[ 'max_size' ] = $max_file_size;
        $this->load->library ( 'upload' , $config );
        
        $file_size = (isset($_FILES[$upload_post_file_name]['name']))?$_FILES[$upload_post_file_name]['size']:''; // in bytes
        $file_name = (isset($_FILES[$upload_post_file_name]['name']))?$_FILES[$upload_post_file_name]['name']:'';
        $pathinfo = pathinfo($file_name);
        $file_ext = (isset($pathinfo['extension']))?$pathinfo['extension']:'';
        if(isset($_FILES[$upload_post_file_name]['name'])) {
            if($_FILES[$upload_post_file_name]['name'] != '') {
                if ( $file_size < $max_file_size_js ) { // check size in bytes
                    $file_allowed_types = $file_extension;
                    $arr_file_allowed_types = explode ( '|' , $file_allowed_types );
                    if ( in_array ( $file_ext , $arr_file_allowed_types ) ) {
                        if ( $this->upload->do_upload ( $upload_post_file_name ) ) {
                            //Get uploaded file information
                            $upload_data = $this->upload->data ();
                            
                            if($upload_data) {
                                $file_name = $upload_data[ 'file_name' ];
                                if ( $file_name ) {
                                    $upload_file = $upload_path .$file_name;
                                    $upload_file_url = $upload_url .$file_name;
                                    $data = array (
                                        'file_name' => $file_name ,
                                        'foldername' => $foldername ,
                                        // 'file_data' => base64_encode ( file_get_contents ( $upload_file_url ) ),
                                        'file_data' => $upload_file_url,
                                        'upload_data' => json_encode($upload_data),
                                        'upload_type' => $upload_type,
                                        'fk_id' => $fk_id,
                                        'app_form_id' => $app_form_id,
                                        'is_edit' => $is_edit,
                                        'applicant_login_id' => $applicant_login_id,
                                        'max_file_size' => $max_file_size,
                                        'file_extension' => $file_extension,
										'created_updated_by' => $created_updated_by,
                                    );
                                    /* call file upload API */
                                    $api_urls = $this->config->item ( 'api_urls' );
                                    $url = $api_urls[ 'upload_files' ];
                                    $method = 'PUT';
                                    if($is_international)
                                    {
                                    $userdata = $this->session_internationaluserdata();
                                    } else {
                                        $userdata = $this->session_userdata();
                                    }
                                    $data['userdata'] = $userdata;
                                    list($result_token,$data) = $this->_check_token($data);     

                                    if($result_token['valid']=='true')
                                    {
                                        $result = $this->call_api ( $url , $method , $data );
                                        $arr = array ();
                                        if ( $result ) {
                                            $arr = $result;
                                            if ( file_exists ( $upload_file ) && $arr[ 'status' ] === true ) {
                                                //Delete file from local server
                                                // @unlink ( $upload_file );
                                                $arr[ 'status' ] = true;
                                                $arr[ 'message' ] = 'File Upload Successfully.';
												// Inject new csrf token and assing in $arr['token']
												$arr['token'] = $this->security->get_csrf_hash();
                                            }
                                        }
                                        else {
                                            $arr[ 'status' ] = false;
                                            $arr[ 'message' ] = 'Please try again some time.';
                                        }
                                    } else {
                                        $arr[ 'status' ] = false;
                                        $arr[ 'message' ] = 'Invalid Token';
                                    }
                                }
                                else {
                                    $arr[ 'status' ] = false;
                                    $arr[ 'message' ] = 'Filename has empty';
                                }
                            } else {
                                $arr[ 'status' ] = true;
                                $arr[ 'message' ] = '';
                            }
                        }
                        else {
                            if($_FILES[$upload_post_file_name]['name'] != '') {
                                log_message('debug',$this->upload->display_errors ( '' , '' ));
                                $arr[ 'status' ] = false;
                                $arr[ 'message' ] = 'Sorry, File does not upload this time, Please try again some time.';    
                            } else {
                                $arr[ 'status' ] = true;
                                $arr[ 'message' ] = '';
                            }
                        }
                    } else {
                        $arr[ 'status' ] = false;
                        $arr[ 'message' ] = 'Please check the file types, Please upload following file format only ('.FILE_ALLOWED_TYPE.')';
                    }
                } else {
                    $arr[ 'status' ] = false;
                    $arr[ 'message' ] = 'File size should be less than '.MAX_FILE_SIZE.' KB, please try again once.';
                }
            } else {
                $arr[ 'status' ] = true;
                $arr[ 'message' ] = '';
            }
        } else {
            $arr[ 'status' ] = true;
            $arr[ 'message' ] = '';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($arr));
        $return_response = $this->output->get_output();
        return $return_response;
    }
	
	public function personal_detail_list($personal_detail_id)
    {
        $session_id = $this->session->userdata('user_data');      
        $header['headers']['Authorization'] = $session_id['access_token'];
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'personal_detail' ].'/'.$personal_detail_id;
        $method = 'GET';     
        $result = $this->call_api ($url,$method,false,$header);        
        return $result;
    }
	
	/* public function phone_code_list($phone_code_id)
    {
		$session_id = $this->session_userdata();           
        $header['headers']['Authorization'] = $session_id['access_token'];
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'mobile_code' ].'/'.$phone_code_id;
        $method = 'GET';     
        $result = $this->call_api ($url,$method,false,$header);        
        return $result;
    } */	

    protected function _get_institute_university($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['other_universities'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_user_marking_scheme($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['user_marking_scheme'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_competitive_exams($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['competitive_exams'];
        return $this->_get_select($url_config,$return,$is_admin);
    }
	
    protected function _get_parent_title($return = false, $is_admin = false) {
        // $arr_parent_title = $this->config->item ( 'parent_title' );
        // return $this->_get_select_data($arr_parent_title,$return);
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['parent_titles'];
        return $this->_get_select($url_config,$return,$is_admin);
    }	
	
    protected function _get_mother_title($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['parent_titles'];
        return $this->_get_select($url_config,$return,$is_admin);
    }		
	
    protected function _get_parent_occupation($return = false, $is_admin = false) {
        $arr_parent_occupation = $this->config->item ( 'parent_occupation' );
        return $this->_get_select_data($arr_parent_occupation,$return);
    }

	protected function _get_eco_weaker_section($return = false, $is_admin = false) {
        $arr_eco_weaker_section = $this->config->item ( 'eco_weaker_section' );
        return $this->_get_select_data($arr_eco_weaker_section,$return);
    }	
	
	protected function _get_board($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['user_boards'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

	protected function _get_mode_of_study($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['user_mode_of_study'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

	protected function _get_current_qualification_status($return = false, $is_admin = false) {
		$arr_current_qualification_status = $this->config->item ( 'current_qualification_status' );
        return $this->_get_select_data($arr_current_qualification_status,$return);
    }

	protected function _get_yr_of_passing_schooling($return = false, $is_admin = false) {
		$arr_current_yr_pass_school = $this->config->item ( 'yr_of_passing_schooling' );
        return $this->_get_select_data($arr_current_yr_pass_school,$return);
    }
	
	protected function _get_streams($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['streams'];
        return $this->_get_select($url_config,$return,$is_admin);
    }	

    protected function _upload_files_multiple ($foldername = false, $upload_post_file_name, $upload_type, $fk_id, $applicant_login_id = false, $is_edit = false, $app_form_id = false)
    {
        $upload_folder_name = 'uploads/';
        $upload_path = FCPATH . $upload_folder_name;
        $upload_url = base_url($upload_folder_name);


        if ( !is_dir ( $upload_path ) ) {
            mkdir ( $upload_path , 0777 );
        }
        if($foldername) {
            $foldername = str_replace(' ', '_', $foldername);
            $upload_path .= $foldername;
            $upload_url .= $foldername;
            if ( !is_dir ( $upload_path ) ) {
                mkdir ( $upload_path , 0777 );
            }    
        }
        
        $upload_date_folder_name = date ( 'Y-m-d' ) . '/';
        $upload_path .= $upload_date_folder_name;
        $upload_url .= $upload_date_folder_name;
        if ( !is_dir ( $upload_path ) ) {
            mkdir ( $upload_path , 0777 );
        }

        $max_file_size = $this->input->post( 'max_file_size',true );
        $max_file_size = ($max_file_size)?$max_file_size:MAX_FILE_SIZE;
        $max_file_size_js = $this->input->post( 'max_file_size_js',true );
        $max_file_size_js = ($max_file_size_js)?$max_file_size_js:MAX_FILE_SIZE_JS;
        $file_extension = $this->input->post( 'file_extension',true );
        $file_extension = ($file_extension)?$file_extension:FILE_ALLOWED_TYPE;
		$mode = $this->input->post( 'mode',true );
		$mode=($mode)?$mode:'';
		$applicant_personal_det_id = $this->input->post( 'applicant_id',true );
		$applicant_personal_det_id=($applicant_personal_det_id)?$applicant_personal_det_id:'';
		$created_updated_by=($mode)?CRM_ADMIN_USER_ROLE_ID:$applicant_personal_det_id;		

        //Upload to the local server
        $config[ 'upload_path' ] = $upload_path;
        $config[ 'allowed_types' ] = $file_extension;
        $config[ 'max_size' ] = $max_file_size;
        $this->load->library ( 'upload' , $config );
        $files = $_FILES;
        unset($_FILES);
        if(isset($files[$upload_post_file_name])) {
            foreach($files[$upload_post_file_name]['name'] as $k=>$v) {
                $_FILES = array();
                $_FILES[$upload_post_file_name]['size'] = $file_size = (isset($files[$upload_post_file_name]['size'][$k]))?$files[$upload_post_file_name]['size'][$k]:''; // in bytes
                $_FILES[$upload_post_file_name]['name'] = $file_name = (isset($v))?$v:'';
                $_FILES[$upload_post_file_name]['type'] = $file_type = (isset($files[$upload_post_file_name]['type'][$k]))?$files[$upload_post_file_name]['type'][$k]:''; // in bytes
                $_FILES[$upload_post_file_name]['tmp_name'] = $file_tmp_name = (isset($files[$upload_post_file_name]['tmp_name'][$k]))?$files[$upload_post_file_name]['tmp_name'][$k]:''; // in bytes
                $_FILES[$upload_post_file_name]['error'] = $file_error = (isset($files[$upload_post_file_name]['error'][$k]))?$files[$upload_post_file_name]['error'][$k]:''; // in bytes

                $pathinfo = pathinfo($file_name);
                $file_ext = (isset($pathinfo['extension']))?$pathinfo['extension']:'';
                
                if ( $file_size < $max_file_size_js ) { // check size in bytes
                    $file_allowed_types = $file_extension;
                    $arr_file_allowed_types = explode ( '|' , $file_allowed_types );
                    if ( in_array ( $file_ext , $arr_file_allowed_types ) ) {
                        if ( $this->upload->do_upload ( $upload_post_file_name ) ) {
                            //Get uploaded file information
                            $upload_data = $this->upload->data ();
                            
                            if($upload_data) {
                                $file_name = $upload_data[ 'file_name' ];
                                if ( $file_name ) {
                                    $upload_file = $upload_path .$file_name;
                                    $upload_file_url = $upload_url .$file_name;
                                    $data = array (
                                        'file_name' => $file_name ,
                                        'foldername' => $foldername ,
                                        // 'file_data' => base64_encode ( file_get_contents ( $upload_file_url ) ),
                                        'file_data' => $upload_file_url,
                                        'upload_data' => json_encode($upload_data),
                                        'upload_type' => $upload_type,
                                        'fk_id' => $fk_id,
                                        'app_form_id' => $app_form_id,
                                        'is_edit' => $is_edit,
                                        'applicant_login_id' => $applicant_login_id,
                                        'max_file_size' => $max_file_size,
                                        'file_extension' => $file_extension,
										'created_updated_by' => $created_updated_by,
                                    );
                                    /* call file upload API */
                                    $api_urls = $this->config->item ( 'api_urls' );
                                    $url = $api_urls[ 'upload_files' ];
                                    $method = 'PUT';
                                    $userdata = $this->session_userdata();
                                    $data['userdata'] = $userdata;
                                    list($result_token,$data) = $this->_check_token($data);  						
                                    if($result_token['valid']=='true')
                                    {
                                        $result = $this->call_api ( $url , $method , $data );$arr = array ();
                                        if ( $result ) {
                                            $arr = $result;
                                            if ( file_exists ( $upload_file ) && $arr[ 'status' ] === true ) {
                                                //Delete file from local server
                                                // @unlink ( $upload_file );
												// Inject new csrf token and assing in $arr['token']
												$arr['token'] = $this->security->get_csrf_hash();
                                                $arr[ 'status' ] = true;
                                                $arr[ 'message' ] = 'File Upload Successfully.';
                                            }
                                        }
                                        else {
                                            $arr[ 'status' ] = false;
                                            $arr[ 'message' ] = 'Please try again some time.';
                                        }
                                    } else {
                                        $arr[ 'status' ] = false;
                                        $arr[ 'message' ] = 'Invalid Token';
                                    }
                                }
                                else {
                                    $arr[ 'status' ] = false;
                                    $arr[ 'message' ] = 'Filename has empty';
                                }
                            } else {
                                $arr[ 'status' ] = true;
                                $arr[ 'message' ] = '';
                            }
                        }
                        else {
                            if($v != '') {
                                log_message('debug',$this->upload->display_errors ( '' , '' ));
                                $arr[ 'status' ] = false;
                                $arr[ 'message' ] = 'Sorry, File does not upload this time, Please try again some time.';    
                            } else {
                                $arr[ 'status' ] = true;
                                $arr[ 'message' ] = '';
                            }
                        }
                    } else {
                        $arr[ 'status' ] = false;
                        $arr[ 'message' ] = 'Please check the file types, Please upload following file format only ('.FILE_ALLOWED_TYPE.')';
                    }
                } else {
                    $arr[ 'status' ] = false;
                    $arr[ 'message' ] = 'File size should be less than '.MAX_FILE_SIZE.' KB, please try again once.';
                }
            }
        } else {
            $arr[ 'status' ] = true;
            $arr[ 'message' ] = '';
        }
        
        $this->output->set_content_type('application/json')->set_output(json_encode($arr));
        $return_response = $this->output->get_output();
        return $return_response;
    }

    protected function _get_have_you_taken_any_competitive_exam($return = false, $is_admin = false) {
        $arr_have_you_taken_any_competitive_exam = $this->config->item ( 'have_you_taken_any_competitive_exam' );
        return $this->_get_select_data($arr_have_you_taken_any_competitive_exam,$return);
    }

    protected function _get_studied_from_india($return = false, $is_admin = false) {
        $arr_get_studied_from_india = $this->config->item ( 'studied_from_india' );
        return $this->_get_select_data($arr_get_studied_from_india,$return);
    }
	
    protected function _get_current_resident($return = false, $is_admin = false) {
        $arr_nature_of_deformity = $this->config->item ( 'current_resident_tn' );
        return $this->_get_select_data($arr_nature_of_deformity,$return);
    }

    protected function _get_religions($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['religions'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_mother_tongues($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['mother_tongues'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_hostel_accommodation($return = false, $is_admin = false) {
        $arr = $this->config->item ( 'hostel_accommodation' );
        return $this->_get_select_data($arr,$return);
    }

    protected function _get_advertisement_source($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['advertisement_sources'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_branchs($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['branchs'];
        return $this->_get_select($url_config,$return,$is_admin);
    }

    protected function _get_applicant_tables_old($applicant_id, $api_config_path) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ $api_config_path ];
        // $url .= '/?applicant_id='.$applicant_id;
        // $method = 'GET';
        $method = 'POST';
        $userdata = $this->session_userdata();
        $user_data['userdata'] = $userdata;
        if(is_array($applicant_id)){
            foreach($applicant_id as $k=>$v) {
                $user_data[$k] = $v;
            }
        } else {
            $user_data['applicant_personal_det_id'] = $applicant_id;   
        }
        list($result_token,$data) = $this->_check_token($user_data);  
        if($result_token['valid']=='true')
        {
            $result = $this->call_api ( $url , $method , $data );
        }
        $result = $result['data'];
        return $result;
    }

    protected function _get_applicant_tables($applicant_id, $api_config_path, $is_international = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ $api_config_path ];
        // $url .= '/?applicant_id='.$applicant_id;
        // $method = 'GET';
        $method = 'POST';
        $userdata = $this->session_internationaluserdata(); 
        if(empty($userdata))
        {
            $userdata = $this->session_userdata();
        }
        
        //$user_data['userdata'] = $userdata;
        if(is_array($applicant_id)){
            foreach($applicant_id as $k=>$v) {
                $user_data[$k] = $v;
            }
        } else {
            $user_data['applicant_personal_det_id'] = $applicant_id;   
        }
        $result = $this->call_api ( $url , $method , $user_data );
        $result = $result['data'];
        return $result;
    }

    protected function _get_resident_status($return = false, $is_admin = false) {
        $arr_get_resident_status = $this->config->item ( 'resident_category' );
        return $this->_get_select_data($arr_get_resident_status,$return);
    }
    protected function _get_sslc_result_status($return = false, $is_admin = false) {
        $arr_get_result_status = $this->config->item ( 'tenth_status' );
        return $this->_get_select_data($arr_get_result_status,$return);
    }
    protected function _get_cur_edu_status($return = false, $is_admin = false) {
        $arr_get_edu_status = $this->config->item ( 'hcma_current_qualification_status' );
        return $this->_get_select_data($arr_get_edu_status,$return);
    }
    protected function _get_high_education($return = false, $is_admin = false,$type=null) {
        $arr_get_high_education = $this->config->item ('high_edu' );
        $arr_get_high_education=$arr_get_high_education[$type];       
        return $this->_get_select_data($arr_get_high_education,$return);
    }

    protected function _get_hcma_branchs($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['hcma_branchs'];
        return $this->_get_select($url_config,$return,$is_admin);
    }
    
    protected function _get_countries($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['countries'];
        return $this->_get_select($url_config,$return,$is_admin);
    }
    
    protected function _get_choice_dropdown($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['db_func_choice_dropdown_international'];
        return $this->_get_select($url_config,$return,$is_admin,'POST');
    }

    protected function _get_choice_dropdown_international($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['db_func_choice_dropdown_international'];
        $is_inter = TRUE;
        return $this->_get_select($url_config,$return,$is_admin,'POST',false,$is_inter);
    }

    protected function _get_reg_choice_dropdown_international($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['db_func_choice_dropdown_international'];
        $reg_page = TRUE;
        return $this->_get_select($url_config,$return,$is_admin,'POST',$reg_page);
    }

    protected function _get_regcourse_dropdown($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        //$url_config = $api_urls['db_func_regcourse_dropdown'];
        $url_config=$api_urls['db_func_choice_dropdown'];
        $reg_page = TRUE;
        return $this->_get_select($url_config,$return,$is_admin,'POST',$reg_page);
    }
	
	protected function _get_course_preference($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['db_func_call_dde'];
        return $this->_get_select($url_config,$return,$is_admin);
    }
	
	protected function _get_agrisci_cur_edu_status($return = false, $is_admin = false) {
        $arr_get_edu_status = $this->config->item ( 'agrisci_current_qualification_status' );
        return $this->_get_select_data($arr_get_edu_status,$return);
    }	
	
	protected function search($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, search($subarray, $key, $value));
        }
    }

    return $results;
	}


	public function get_schooling_id($applicant_personal_det_id,$applicant_appln_id) {
        $api_urls = $this->config->item ( 'api_urls' );
		$url = $api_urls['db_func_schooling_detail'];
        $method = 'POST';
        $userdata = $this->session_userdata();
        $user_data['userdata'] = $userdata;
		$user_data['applicant_personal_det_id'] = $applicant_personal_det_id;
		$user_data['applicant_appln_id'] = $applicant_appln_id;
        list($result_token,$data) = $this->_check_token($user_data);  
        if($result_token['valid']=='true')
        {
            $result = $this->call_api ( $url , $method , $data );
        }
        return $result;		
	}
	
	
	public function check_applicant_appln_id_api($applicant_personal_det_id,$form_id,$mode = false) {
        //echo $applicant_personal_det_id."applicant_personal_det_id";
        //echo $form_id."form_id";die;
        $api_urls = $this->config->item ( 'api_urls' );
        //$url = $api_urls['db_func_appln_detail'];
		$url = $api_urls['get_appln_form_id'];
        $method = 'POST';
        if($form_id == APP_FORM_ID_INTERNATIONAL)
        {
           $userdata = $this->session_internationaluserdata(); 
        }else{ 
           $userdata = $this->session_userdata(); 
		}        
        $user_data['userdata'] = $userdata;
		$user_data['applicant_personal_det_id'] = $applicant_personal_det_id;
		$user_data['appln_form_id'] = $form_id;
        if($this->mode == ADMIN_MODE_EDIT ) {
          $user_data['created_by'] =  CRM_ADMIN_USER_ROLE_ID;
        }else{
          $user_data['created_by'] =  $applicant_personal_det_id;
        }
        //print_r($user_data);die;
        list($result_token,$data) = $this->_check_token($user_data); 
        if($result_token['valid']=='true')
        {
            //echo $url;
            $result = $this->call_api ( $url , $method , $data );
            //print_r($result);echo "Check_applicant";die;
        }
        return $result;		
	}
	
	public function get_thank_you_data($applicant_appln_id,$form_id) {
        $api_urls = $this->config->item ( 'api_urls' );
		$url = $api_urls['thankyou_data'];
        $method = 'POST';
        $userdata = $this->session_userdata();
        $user_data['userdata'] = $userdata;
		$user_data['applicant_appln_id'] = $applicant_appln_id;
		$user_data['appln_form_id'] = $form_id;
        list($result_token,$data) = $this->_check_token($user_data);  
        if($result_token['valid']=='true')
        {
            $result = $this->call_api ( $url , $method , $data );
        }
        return $result;		
	}	
	
	public function get_form_id(){
		$form_id_phd = $this->config->item('form_id');
		$controller = $this->router->fetch_class();
		$method = $this->router->fetch_method();
		return $form_id_phd[$method];
	}
	
	protected function _get_course_prefer($return = false, $is_admin = false) {
		$cf = array(1=>"M.A Journalism and Mass Communication",2=>"M.A Journalism and Mass Communication",3=>"M.Sc Yoga for Human Excellence",4=>"MA (English)",5=>"MBA",);
        return $this->_get_select_data($cf,$return);
    }

    protected function _get_comp_exam_qualified_status($return = false, $is_admin = false) {
        $arr_comp_exam_qualified_status = $this->config->item ( 'comp_exam_qualified_status' );
        return $this->_get_select_data($arr_comp_exam_qualified_status,$return);
    }

    protected function _get_is_work_experience_status($return = false, $is_admin = false) {
        $arr_is_work_experience_status = $this->config->item ( 'is_work_experience_status' );
        return $this->_get_select_data($arr_is_work_experience_status,$return);
    }	
    protected function _bmed_edu_status($return = false, $is_admin = false) {
        $arr_get_edu_status = $this->config->item ( 'bmed_mphil_qualifications' );
        return $this->_get_select_data($arr_get_edu_status,$return);
    }
    protected function _law_edu_status($return = false, $is_admin = false) {
        $arr_get_edu_status = $this->config->item ( 'law_qualifications' );
        return $this->_get_select_data($arr_get_edu_status,$return);
    }
    
    protected function _bba_edu_status($return = false, $is_admin = false) {
        $arr_get_edu_status = $this->config->item ( 'bba_qualifications' );
        return $this->_get_select_data($arr_get_edu_status,$return);
    }
    
    public function _parent_occupation()
    {
        $session_id = $this->session->userdata('user_data');
        $header['headers']['Authorization'] = $session_id['access_token'];
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'parent_occupation' ];
        
        $query_data = array();
        $keywords = $_GET['keywords'];
        $method = 'GET';
        if(!empty($keywords)){            
            $query_data['keywords'] = $keywords;
        }
        
        $query = http_build_query($query_data);
        $url = $url .'?'.$query;
        $result = $this->call_api ($url,$method,false,$header);
        if($result){
            $data['data']=$result['data'];
			if($data['data']==null || $data['data']=='null'){
				$no_data = array("status"=>false,"message"=>false);
				$this->output->set_content_type('application/json')->set_output(json_encode($no_data));
				$returnResponse = $this->output->get_output();
				return $returnResponse;
			}else{
				$this->output->set_content_type('application/json')->set_output(json_encode($data));
				$returnResponse = $this->output->get_output();
				return $returnResponse;				
			}
        }
    }
    
    public function convertDate($date){
        $result=date("Y-m-d");
        if(!empty($date)){           
            $datesep=explode("/",$date);
            if(is_array($datesep)){
                $datejoin=$datesep[2]."-".$datesep[1]."-".$datesep[0];
                $result = date("Y-m-d",strtotime($datejoin));
            }
        }
        return $result;
    }
    protected function _get_qualification($grad, $api_config_path) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ $api_config_path ];        
        $method = 'POST';
        $userdata = $this->session_userdata();       
        $user_data[] = $grad;        
        $result = $this->call_api ( $url , $method , $grad );
        $result = $result['data'];
        return $result;
    }
    
    protected function _get_category() {
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'query_categories' ];
        $method = 'GET';
        $userdata = $this->session_userdata();        
        $result = $this->call_api ( $url , $method );
        $result = $result['data'];
        return $result;
    }
    protected function _get_tickets($id) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'mytickets' ];
        $query_data=array();
        if (!empty( $id ) ) {
            $query_data['id'] = $id;
        }        
        $query_data['sort_order'] = 'desc';
        //$query_data['sort_by'] = 'ticket_id'; 
        $query = http_build_query($query_data);
        $url = $url .'?'.$query;
        $method = 'GET';
        $userdata = $this->session_userdata();
        $result = $this->call_api ( $url , $method );
        $result = $result['data'];
        return $result;
    }
    
    protected function _get_ticket_detail($ticket_id) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'ticket_detail' ];
        $query_data=array();
        if (!empty( $ticket_id ) ) {
            $query_data['id'] = $ticket_id;
        }         
        $query = http_build_query($query_data);
        $url = $url .'?'.$query;
        $method = 'GET';
        $userdata = $this->session_userdata();
        $result = $this->call_api ( $url , $method );
        $result = $result['data'];
        return $result;
    }
    protected function _get_ticket_conversations($ticket_id) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'ticket_conversations' ];
        $query_data=array();
        if (!empty( $ticket_id ) ) {
            $query_data['id'] = $ticket_id;
        }
        $query_data['sort_order'] = 'desc';
        //$query_data['sort_by'] = 'applicant_query_id';
        $query = http_build_query($query_data);
        $url = $url .'?'.$query;
        $method = 'GET';
        //$userdata = $this->session_userdata();
        $result = $this->call_api ( $url , $method );
        $result = $result['data'];
        return $result;
    }
    protected function _get_qualifications($api_config_path) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ $api_config_path ];
        $method = 'GET';
        $result = $this->call_api ( $url , $method  );       
        $result = $result['data'];
        return $result;
    }

    protected function _get_wizard_details($app_form_id , $id= false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'form_wizards_list' ];
        $query_data=array();
        if (!empty( $id ) ) {
            $query_data['id'] = $id;
        }
        $query_data['appln_form_id'] = $app_form_id;
        $query_data['sort_order'] = 'asc';
        $query_data['sort_by'] = 'completion_percent';
        $query = http_build_query($query_data);
        $url = $url .'?'.$query;
        $method = 'GET';
        $session_id = $this->session->userdata('user_details_data');
        $header['headers']['Authorization'] = $session_id['access_token'];
        $result = $this->call_api ($url,$method,false,$header);
        $result = $result['data'];
        return $result;
    }

    protected function _get_appln_wizard_details($app_form_wizard_id) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url = $api_urls[ 'appln_wizard_dtl' ];
        $query_data=array();
        $query_data['form_wizard_id'] = $app_form_wizard_id;
        $query = http_build_query($query_data);
        $url = $url .'?'.$query;
        $method = 'GET';
        $session_id = $this->session->userdata('user_details_data');
        $header['headers']['Authorization'] = $session_id['access_token'];
        $result = $this->call_api ($url,$method,false,$header);
        $result = $result['data'];
        return $result;
    }
	
	// function to get the tamil perrayam degree list
	protected function _get_tamilperayam_degree_list($return = false, $is_admin = false) {
        $arr_get_tamilperayam_degree = $this->config->item ('tamilperayam_degree');
        return $this->_get_select_data($arr_get_tamilperayam_degree,$return);
    }
    
    protected function _get_relationship_types($return = false, $is_admin = false) {
        $api_urls = $this->config->item ( 'api_urls' );
        $url_config = $api_urls['guardian_relationships'];
        return $this->_get_select($url_config,$return,$is_admin);
    }
    
	//check form open close date
    public function checkValidDate($start,$end) {
        $result='';
        if(!empty($start) && !empty($end))
        {
            $today = date('Y-m-d');
            $today=date('Y-m-d', strtotime($today));
            
            //convert date to mm/dd/y format       
            if(!empty($start)){
                $startsep=explode("-",$start);
                if(is_array($startsep)){
                    $startjoin=$startsep[1]."/".$startsep[2]."/".$startsep[0];
                     $stratDate = date("Y-m-d",strtotime($startjoin));
                }
            }
            
            if(!empty($end)){
                $endsep=explode("-",$end);
                if(is_array($endsep)){
                    $endjoin=$endsep[1]."/".$endsep[2]."/".$endsep[0];
                    $endDate = date("Y-m-d",strtotime($endjoin));
                }
            }
            //echo $startjoin ."<br>".$endjoin;
            if (($today >= $stratDate) && ($today <= $endDate)){
                $result= 1;
            }else{
                $result= 0;
            }
        }
        return $result;
    }
    //end check form open close date     

	/*
	* check IP address within configured ARRY
	*/
    public function isValidIp()
    {
        $allowlist=$this->config->item('allowed_ip_list');
		//echo $_SERVER['REMOTE_ADDR'];
		//EXIT;
        if(!in_array($_SERVER['REMOTE_ADDR'],$allowlist)){
            //die('This website cannot be accessed from your location.');
            return 0;
        }else{
            return 1;
        }
    }
    
	/*
	 * insert the failure payment status
	 */	
	 
	public function payment_details_failure($applicant_appln_id,$payment_mode_id,$trans_no,$applicant_personal_det_id,$payment_status_id,$application_fee,$error,$error_Message) {
		$api_urls = $this->config->item ( 'api_urls' );
		$url = $api_urls['payment_details_failure'];
		$method = 'POST';
		$userdata = $this->session_userdata();
		$user_data['userdata'] = $userdata;
		$user_data['applicant_appln_id'] = $applicant_appln_id;
		$user_data['payment_mode_id'] = $payment_mode_id;
		$user_data['trans_no'] = $trans_no;
		$user_data['applicant_personal_det_id'] = $applicant_personal_det_id;
		$user_data['payment_status_id'] = $payment_status_id;
		$user_data['application_fee'] = $application_fee;
		$user_data['error_code'] = $error;
		$user_data['error_text'] = $error_Message;

		list($result_token,$data) = $this->_check_token($user_data);  
		if($result_token['valid']=='true')
		{
			$result = $this->call_api ( $url , $method , $data );
		}
	}	
	
	public function _get_form_lists() {
	    $api_urls = $this->config->item ( 'api_urls' );
	    $url= $api_urls['form_list'];
	    $method = 'GET';
	    $userdata = $this->session_userdata();
        // Call API
	    $result = $this->call_api($url,$method);
        $result = $result['data'];
        return $result;
	}
	public function _get_ticket_count() {
	    $api_urls = $this->config->item ( 'api_urls' );
	    $url= $api_urls['ticket_count'];
	    $method = 'GET';
	    // Call API
	    $result = $this->call_api($url,$method);
	    $result = $result['data'];
	    return $result;
	}
}

// API controller
require_once(APPPATH.'core/API_Controller.php');

// Backend controller
require_once(APPPATH.'core/Backend_Controller.php');

// Frontend controller
require_once(APPPATH.'core/Frontend_Controller.php');


