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

class Mail_box extends MY_Controller
{
	public $CI;

	public function __construct()
    {
        //
        parent::__construct();
        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $CI =& get_instance();
    }
	
	public function compose(){
        $this->is_exists_user_logged();
		$userdata = $this->session->userdata('user_details_data');	
		$compose = $this->input->post();
		$compose['userdata'] = $userdata;
        $user_details = $this->sess_token_user_exipry($compose);
		$api_urls = $this->config->item ( 'api_urls' );
		$url = $api_urls[ 'insert_mailbox' ];
		// Method Type
		$method = 'POST';	
		// Call API
		$dataDF = $this->call_api($url,$method,$user_details);

		if($dataDF['status']){
			$to = $user_details['userdata']['user_details']['data'][0]['email'];
			$from = MAIL_COMPOSE_EMAIL;
         	$sendEmail = $this->send_mail($compose['subject'],$compose['message'],$from,$to);
			if($sendEmail){
				$redirect = 'mail_box/list';
				echo json_encode(array('status' => 'true', 'message' => MAIL_SENT_MESSAGE,'redirect'=>$redirect));
				die;    
			}else{
				echo json_encode(array('status' => 'error', 'message' => ERROR_MSG));
				die;    
			}
		}
	}

    public function list()
    {
    	$this->is_exists_user_logged();
    	$this->data['page_title'] = MAIL_BOX_TITLE;
        $this->data['save_button_name'] = MAIL_BOX_BUTTON;
        $this->data['page_heading_name'] = MAIL_BOX_HEADING;
		$this->data['mail_compose_button'] = MAIL_COMPOSE_BUTTON;
		$this->data['mail_compose_to'] = MAIL_COMPOSE_TO;
		$this->data['mail_compose_subject'] = MAIL_COMPOSE_SUBJECT;
		$this->data['mail_compose_body'] = MAIL_COMPOSE_BODY;
		$this->data['mail_compose_send'] = MAIL_COMPOSE_SEND;
		$this->data['mail_compose_close'] = MAIL_COMPOSE_CLOSE;
		$this->data['mail_compose_email'] = MAIL_COMPOSE_EMAIL;
		$api_urls = $this->config->item ( 'api_urls' );
		$url = $api_urls[ 'mailboxes' ];
		// Method Type
		$method = 'GET';
		$maildata = $this->session->userdata('user_details_data');
        $mail_list['userdata'] = $maildata;
        $mail_data = $this->sess_token_user_exipry($mail_list);
		$this->data['user_id'] = ADMIN_USER_ID;
		$this->data['from_id'] = $maildata['user_details']['data'][0]['user_id'];
		// Call API
		$data = $this->call_api($url,$method,$mail_data);
		$this->data['result']=$data['data'];
        $this->template('mail_box\list', $this->data, true);
    }

    public function list_inbox()
    {
        $user_id = '';
        $this->is_exists_user_logged();   
        $maildata = $this->session->userdata('user_details_data');
        if(isset($maildata['user_details']['data']))
        {
            $user_id = $maildata['user_details']['data'][0]['user_id'];
        }
        $from_to_colname =  (!empty($this->input->post('id')) && $this->input->post('id') == 'sent') ? 'from_id' : 'to_id';
        
        $mail_list = array(
                'list_id' => trim($this->input->post('id')),
                $from_to_colname => $user_id,
            );
        $api_urls = $this->config->item ( 'api_urls' );
        $query = http_build_query($mail_list);
        $url = $api_urls['mailboxes'];
        $url = $url . '?' . $query;
        // Method Type
        $method = 'GET';
        $maildata = $this->session->userdata('user_details_data');
        $mail_list['userdata'] = $maildata;
        $mail_data = $this->sess_token_user_exipry($mail_list);
        $data = $this->call_api($url,$method,$mail_data);
        echo json_encode($data);
        die;       
    }

    
}