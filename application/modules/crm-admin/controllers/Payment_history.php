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

class Payment_history extends BackendController
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

    public function payment_history()
    {
        $this->is_exists_user_logged();
        $this->data['site_title'] = $this->data['page_title'] = 'Payment History';
        $this->template('grid\payment_history', $this->data, true);
    }

    public function grid_payment_history()
    {
        $this->is_exists_user_logged();
        $searchColumnName = $this->input->get('filters[0][field]'); 
        $searchValue = $this->input->get('filters[0][value]');
        $searchType = $this->input->get('filters[0][type]');
        $query_data = array();
        if(!empty($searchColumnName)){
            $query_data['searchColumnName'] = $searchColumnName;
        }
        if(!empty($searchValue)){
            $searchValue = strtolower($searchValue);
            $query_data['searchValue'] = $searchValue;
        }
        if(!empty($searchType)){
            $query_data['searchType'] = $searchType;
        }
        $query = http_build_query($query_data);
        $url = base_url('api_crmadmin/payment_history') .'?'.$query;
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
}