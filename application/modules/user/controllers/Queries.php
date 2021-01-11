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

class Queries extends FrontendController
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
        $this->user_details_data = $this->session->userdata('user_details_data');
        
    }
    public function index()
    {
        $is_international = $this->input->get('is_international');
        if($is_international)
        {
          $this->is_exists_international_user_logged();  
          $this->user_details_data = $this->session->userdata('international_user_details_data');
          $this->data['sidebar']='is_international';
      }else{
        $this->is_exists_user_logged();
      }
        $applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];
        $applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];
        
        $ticket_list = $this->_get_tickets($applicant_id);
        $this->data['ticket_list'] = $ticket_list;
        
        
        $this->data['site_title'] = $this->data['page_title'] = 'My Tickets';
        // Display page with the template function from REST_Controller
        $this->template('queries/index', $this->data, true);
    }
    public function create_query() {        
        $is_international = $this->input->get('is_international');
        if($is_international)
        {
          $this->is_exists_international_user_logged();  
          $this->user_details_data = $this->session->userdata('international_user_details_data');
          $this->data['sidebar']='is_international';
        }else{
        $this->is_exists_user_logged();
       }
        $applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];
        $applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];
        /* print_r($_POST);
        print_r($_FILES); */
        if ( $this->input->post () ){
            $user_data = $this->input->post();
            
            $api_urls = $this->config->item ( 'api_urls' );
            // Method Type
            $method = 'POST';
            $url = $api_urls['save_query'];
            if($is_international)
            {
             $userdata = $this->session_internationaluserdata();
            }else{
               $userdata = $this->session_userdata(); 
            }
            
            $user_data['userdata'] = $userdata;
            
            $user_data['name'] = $user_data['name'];
            $user_data['category'] = $user_data['category'];
            $user_data['form_id'] = $user_data['form_id'];
            $user_data['description'] = $user_data['description'];            
            // Get Personal Applicant ID            
            $user_data['applicant_personal_det_id'] = $applicant_id;
            
            //for upload
            $fieldname=$user_data['field'];
            $upload_folder_name = 'uploads/my_queries/';
            $upload_path = FCPATH . $upload_folder_name;
            $upload_url = base_url($upload_folder_name);
            
            
            if ( !is_dir ( $upload_path ) ) {
                mkdir ( $upload_path , 0777 );
            }
            $foldername=$applicant_id;
            if($foldername) {
                $upload_path .= $foldername;
                $upload_url .= $foldername;
                if ( !is_dir ( $upload_path ) ) {
                    mkdir ( $upload_path , 0777 );
                }
            }
            //$config['upload_path'] = './uploads/my_queries/';
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'gif|jpg|png|pdf|doc';
            $config['max_size'] = 2048;
            $config['max_width'] = 1500;
            $config['max_height'] = 1500;
            $new_name = time()."_".$_FILES[$fieldname]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config); 
                  
            if (!$this->upload->do_upload($fieldname) && !empty($_FILES[$fieldname]['name'])) {               
                $error = array('error' => $this->upload->display_errors());
                $user_data['file_name']='';
                $error['token'] = $this->security->get_csrf_hash();
                $return = $this->json_return($error);                
                return $return;
            }else{
                $file_info = $this->upload->data();
                $uploaded_filename = $file_info['file_name'];
                $user_data['file_name']=$uploaded_filename;    
            }
            
            //end upload
            
            list($result_token,$data) = $this->_check_token($user_data);
            if($result_token['valid']=='true')
            {
                // Call API
                $data = $this->call_api($url,$method,$user_data);               
                $return = $this->json_return($data);
                return $return;
            }
        }
        else{
            $category_list = $this->_get_category();
            $this->data['category_list'] = $category_list;
            /* $form_list = $this->_get_form_list();
            $this->data['form_list'] = $form_list; */
            $this->data['logged_applicant_id']=$applicant_id;
            $this->data['logged_applicant_login_id']=$applicant_login_id;
            $this->data['user_data'] = $this->user_details_data['user_details']['data'][0];
            $this->data['personal_detail_list'] = $this->personal_detail_list($applicant_id);
            
            $this->data['site_title'] = $this->data['page_title'] = 'Ask your Query';
            $this->template('queries/create', $this->data, true);
        }
    }
    
    public  function show_ticket(){
        $ticket_id= $this->uri->segment('2');
        $this->is_exists_user_logged();
        $applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];
        $applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];
       
        
        if ($this->input->post () ){
            $user_data = $this->input->post();            
            $api_urls = $this->config->item ( 'api_urls' );
            // Method Type
            $method = 'POST';
            $url = $api_urls['save_conversation'];
            $userdata = $this->session_userdata();
            $user_data['userdata'] = $userdata;
            $user_data['description'] = $user_data['description'];
            $user_data['ticket_id'] = $user_data['ticket_id'];
            
            // Get Personal Applicant ID
            $user_data['applicant_personal_det_id'] = $applicant_id;
            
            //for upload
            $fieldname=$user_data['field'];
            $upload_folder_name = 'uploads/my_queries/';
            $upload_path = FCPATH . $upload_folder_name;
            $upload_url = base_url($upload_folder_name);
            
            
            if ( !is_dir ( $upload_path ) ) {
                mkdir ( $upload_path , 0777 );
            }
            $foldername=$applicant_id;
            if($foldername) {
                $upload_path .= $foldername;
                $upload_url .= $foldername;
                if ( !is_dir ( $upload_path ) ) {
                    mkdir ( $upload_path , 0777 );
                }
            }
            //$config['upload_path'] = './uploads/my_queries/';
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'gif|jpg|png|pdf|doc';
            $config['max_size'] = 2048;
            $config['max_width'] = 1500;
            $config['max_height'] = 1500;
            $new_name = time()."_".$_FILES[$fieldname]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            //$user_data['file_name']=$new_name;
            if (!$this->upload->do_upload($fieldname) && !empty($_FILES[$fieldname]['name'])) {
                $error = array('error' => $this->upload->display_errors());
                $error['token'] = $this->security->get_csrf_hash();
                $user_data['file_name']='';
                $return = $this->json_return($error);
                return $return;               
            } else{
                $file_info = $this->upload->data();
                $uploaded_filename = $file_info['file_name'];
                $user_data['file_name']=$uploaded_filename;
            }
            //end upload
            
            list($result_token,$data) = $this->_check_token($user_data);
            if($result_token['valid']=='true')
            {
                // Call API
                $data = $this->call_api($url,$method,$user_data);
                $return = $this->json_return($data);
                return $return;
            }
        }else{
            $ticketinfo = $this->_get_ticket_detail($ticket_id);
            $this->data['ticketinfo'] = $ticketinfo;            
            $ticket_conversations= $this->_get_ticket_conversations($ticket_id);
         
            $this->data['ticket_conversations'] = $ticket_conversations;
            
            $this->data['logged_applicant_id']=$applicant_id;
            $this->data['site_title'] = $this->data['page_title'] = 'Ticket details';
            // Display page with the template function from REST_Controller
            $this->template('queries/show_ticket', $this->data, true);
        }
    }
        
}
