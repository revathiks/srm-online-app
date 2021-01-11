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

class Grid extends BackendController
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

     /**
     * Grid Applicant View
     */

    public function view_applicant()
    {		
		$this->is_exists_user_logged();
		$api_urls = $this->config->item ( 'api_urls' );
		$form_list = $this->config->item('form_path');
		$this->data['form_list'] = $form_list;		
        $this->data['site_title'] = $this->data['page_title'] = 'Applicant Details';	
        $this->template('grid\view', $this->data, true);
    }
	
	public function user_applicant() {
		$pageNo = $this->input->get('pageNo');
		$size = $this->input->get('size');
		$searchValue = $this->input->get('filters[0][value]');
		$payment = $this->input->get('filters[1][value]');
		$status = $this->input->get('filters[2][value]');
		if(is_array($payment) && $searchColumnName!='created_at'){
			$payment = implode(",",$payment);	
		}		
		$searchColumnName = $this->input->get('filters[0][field]');	
			
		$is_download = $this->input->get('is_download');
		if($searchColumnName=='created_at'){
			$searchValue = str_replace('/','-',$searchValue);
		}
		if(is_array($searchValue) && $searchColumnName!='created_at'){
			$searchValue = implode(",",$searchValue);	
		}
		if(is_array($status)){
			$status = implode(",",$status);	
		}			
		$query_data = array();
        if(!empty($pageNo)){
            $query_data['pageNo'] = $pageNo;
        }	
        if(!empty($size)){
            $query_data['size'] = $size;
        }
        if(!empty($searchValue)){
            $query_data['searchValue'] = $searchValue;
        }	
        if(!empty($status)){
            $query_data['status'] = $status;
        }		
		if(!empty($payment)){
			$query_data['payment'] = $payment;
			$query_data['searchColumnNamepid'] = 'payment_mode_id';
		}

        if(!empty($searchColumnName)){
            $query_data['searchColumnName'] = $searchColumnName;
        }
		
        if(!empty($is_download)){
            $query_data['is_download'] = $is_download;
        }
		$query = http_build_query($query_data);
		$url = base_url('api_crmadmin/applicant_details_crm') .'?'.$query;

		$data = array();
		$method = 'GET';
		$userdata = $this->admin_session_userdata();
		$data['userdata'] = $userdata;
		$result = $this->call_api ( $url , $method , $data );		
		if($result['data']){
			foreach($result['data'] as $v => $results){
				$result['data'][$v]['form_payment_mode'] = $this->config->item('form_payment_mode')[$results['payment_mode_id']];
				$result['data'][$v]['application_status_id'] = $this->config->item('application_status')[$results['application_status_id']];
				$result['data'][$v]['form_url'] = $this->config->item('form_path')[$results['appln_form_id']];
				$result['data'][$v]['total_data'] = $result['total'];
				$result['data'][$v]['status'] = $results['application_status_id'];
				$result['data'][$v]['payment_type'] = $results['payment_mode_id'];
				$result['data'][$v]['completion_percent'] = $results['completion_percent'];
			}	
		}else{
			$result['last_page']  = array();
			$result['data']  = array();
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($result,true));
	}
	
	public function table_demo()
	{
	    $this->is_exists_user_logged();
	    $form_list = $this->config->item('form_path');
	    $this->data['form_list'] = $form_list;
	    $this->data['site_title'] = $this->data['page_title'] = 'Applicant Details';
	    $this->template('grid\data', $this->data, true);
	}
}