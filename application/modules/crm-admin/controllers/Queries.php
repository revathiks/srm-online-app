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

class Queries extends BackendController
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
		// Load model
		$this->load->model('User_model');		
    }

    public function queries()
    {		
        $this->is_exists_user_logged();
		$category_list = $this->_get_category();
		$this->data['category_list'] = $category_list;
		$form_list = $this->_get_form_lists();
		$this->data['form_list'] = $form_list;
		$ticket_count = $this->_get_ticket_count();
		//segrigate counts here
		$total=$closed=$open=$inprogress=0;
		if(!empty($ticket_count)){		    
		    $total=count($ticket_count);
		    foreach ($ticket_count as $ticket){
		        if($ticket['status_id']==TICKETS_OPEN_STATUS){
		            $open++;
		        }
		        if($ticket['status_id']==TICKETS_CLOSED_STATUS){
		            $closed++;
		        }
		        if($ticket['status_id']==TICKETS_INPROGRESS_STATUS){
		            $inprogress++;
		        }
		    }
		}
		$this->data['total_ticket'] = $total;
		$this->data['open_ticket'] = $open;
		$this->data['closed_ticket'] = $closed;
		$this->data['inprogress_ticket'] = $inprogress;
        $this->data['site_title'] = $this->data['page_title'] = 'Manage Student Queries';	
        $this->template('queries\view', $this->data, true);
       
    }
	
	public function tickets() {
	    $filters=$this->input->get('filters[]');
	   // print_r($filters);
		$pageNo = $this->input->get('pageNo');
		$size = $this->input->get('size');		
		$is_download = $this->input->get('is_download');

		$query_data = array();
        if(!empty($pageNo)){
            $query_data['pageNo'] = $pageNo;
        }	
        if(!empty($size)){
            $query_data['size'] = $size;
        }
        
        if(!empty($filters)){
            foreach($filters as $filter){
                $filterfield=$filter['field'];
                $filterValue=$filter['value'];
                if(is_array($filterValue)){
                    $filterValue=implode(",",$filterValue);
                }
                $query_data[$filterfield] = $filterValue;
                
            }
        }
       
        if(!empty($is_download)){
            $query_data['is_download'] = $is_download;
        }
		$query = http_build_query($query_data);
		$api_urls = $this->config->item ( 'api_urls' );
		$url = $api_urls[ 'alltickets' ];
		$url = $url .'?'.$query;
		$data = array();
		$method = 'GET';
		$result = $this->call_api ( $url , $method , $data );
		
		if($result['data']){
			foreach($result['data'] as $v => $results){
			    $created_at=$results['created_at'];
			    $created_at=date("j M Y  H:i A", strtotime($created_at));
			    $result['data'][$v]['created_at'] = $created_at;
			    
			    $updated_at=$results['updated_at'];
			    $updated_at=date("j M Y  H:i A", strtotime($updated_at));
			    $result['data'][$v]['updated_at'] = $updated_at;
			}	
		}else{
			$result['last_page']  = array();
			$result['data']  = array();
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result,true));
	}
	public  function show_ticket(){
	    $ticket_id= $this->uri->segment(3);
	    $this->is_exists_user_logged();
	    $applicant_id = $this->uri->segment(4);
	    $applicant_login_id=$this->uri->segment(5);
	    
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
	        
	        /* list($result_token,$data) = $this->_check_token($user_data);
	        if($result_token['valid']=='true')
	        { */
	            // Call API
	            $data = $this->call_api($url,$method,$user_data);
	            $return = $this->json_return($data);
	            return $return;
	        //}
	    }else{
	        $ticketinfo = $this->_get_ticket_detail($ticket_id);
	        $this->data['ticketinfo'] = $ticketinfo;
	        $ticket_conversations= $this->_get_ticket_conversations($ticket_id);
	        
	        $this->data['ticket_conversations'] = $ticket_conversations;
	        
	        $this->data['logged_applicant_id']=$applicant_id;
	        $this->data['logged_applicant_login_id']=$applicant_login_id;
	        $this->data['site_title'] = $this->data['page_title'] = 'Ticket details';
	        // Display page with the template function from REST_Controller
	        $this->template('queries/ticket_detail', $this->data, true);
	    }
	}
	
	public function table_demo()
	{
	    $this->is_exists_user_logged();
	    $this->data['site_title'] = $this->data['page_title'] = 'Applicant Details';
	    $this->template('grid\data', $this->data, true);
	}
}