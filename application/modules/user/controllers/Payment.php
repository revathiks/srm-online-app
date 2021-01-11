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

class Payment extends FrontendController
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
		$this->application_year = date("Y");
		$this->user_details_data = $this->session->userdata('user_details_data');
    }
	
	/* Function for DD Payment Process */	
    public function payment_details() {   
		$is_international = $this->input->post('is_international',true);
		$is_international=($is_international)?$is_international:'';
        if($is_international){
        	$this->is_exists_international_user_logged();
            $this->user_details_data = $this->session->userdata('international_user_details_data');
        }else { $this->is_exists_user_logged(); }
        $ses_applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];
        //$applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];
        $applicant_personal_det_id = $this->input->get('applicant_personal_det_id');
        $applicant_id = ($applicant_personal_det_id)?$applicant_personal_det_id:$ses_applicant_id;
		$mode = $this->input->get('mode');
		
		// Get Form ID
		$get_form_id = $this->input->post('app_form_id',true);
		$get_form_id = ($get_form_id)?$get_form_id:APP_FORM_ID_DE;
		
		// Get Applicant ID
		$applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);
		$applicant_appln_det_id = $applicant_appln_det['id'];	
		//get form fee from db
		$applicantDetailArr=array(
		    'applicant_personal_det_id'=>$applicant_id,
		    'applicant_form_id'=>$get_form_id
		);
		$applicant_application_details_list = $this->_get_applicant_tables($applicantDetailArr, 'db_func_appln_detail');
		$appln_form_fee=isset($applicant_application_details_list[0]['appln_form_fee']) ? $applicant_application_details_list[0]['appln_form_fee'] :'1100.00';
		//random transaction number
		$transaction_no=mt_rand();
		
		$user_data = $this->input->post();
		$api_urls = $this->config->item ( 'api_urls' );
		$url = $api_urls[ 'payment_details' ];
		$method = 'POST';
		if($is_international){
			$userdata = $this->session_internationaluserdata();
		}else{
			$userdata = $this->session_userdata();
		}
		
		$user_data['userdata'] = $userdata;
		$user_data['applicant_personal_det_id'] = $applicant_id;
		$user_data['applicant_appln_id'] = $applicant_appln_det_id;
		$user_data['bank_id'] = $user_data['bank_name'];
		$user_data['branch_name'] = $user_data['branch_name'];
		$user_data['dd_cheque_no'] = $user_data['dd_cheque_no'];
		$user_data['application_fee'] = round($appln_form_fee);
		$user_data['trans_no'] = $transaction_no;
		//$user_data['dd_cheque_date'] = date("Y-m-d",strtotime($user_data['dd_cheque_date']));
		if(!empty($user_data['dd_cheque_date'])){
		    $dd_cheque_date=$this->convertDate($user_data['dd_cheque_date']);
		    $user_data['dd_cheque_date'] = $dd_cheque_date;
		}else{
		    $user_data['dd_cheque_date'] = date("Y-m-d",strtotime($user_data['dd_cheque_date']));
		}
		$user_data['payment_by_online'] = $user_data['payment_mode'];
		$user_data['payment_by_dd'] = $user_data['payment_mode'];
		
		list($result_token,$data) = $this->_check_token($user_data);  
		if($result_token['valid']=='true')
		{
			$result = $this->call_api ( $url , $method , $user_data );
			$return = $this->json_return($result);
			return $return;
		}	
    }
	
	
	/* Function for Online Payment Process */
	public function payment_process(){
		
		// Check the user registered user or not
		//$this->is_exists_user_logged();
		$is_international = $this->input->post('is_international',true);
		$is_international=($is_international)?$is_international:'';
        if($is_international){
        	$this->is_exists_international_user_logged();
            $this->user_details_data = $this->session->userdata('international_user_details_data');
        }else { $this->is_exists_user_logged(); }
        $ses_applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];
       // $applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];
        $applicant_personal_det_id = $this->input->get('applicant_personal_det_id');
        $applicant_id = ($applicant_personal_det_id)?$applicant_personal_det_id:$ses_applicant_id;
        $mode_url = $this->input->get('mode');
        $mode = ($mode_url)?$mode_url:'';
				
		// Get Form ID
        $get_form_id = $this->input->get('app_form_id',true);
        $index = $this->input->get('index',true);
        $get_form_id = isset($get_form_id)?$get_form_id:0;
        $index= isset($index)?$index:0;
		// Get Applicant ID
		$applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);
		$applicant_appln_det_id = $applicant_appln_det['id'];		
		$applicant_basic_details_list = $this->_get_applicant_tables($applicant_id, 'db_func_basic_detail');
		$this->data['applicant_basic_details_list'] = $applicant_basic_details_list[0];
		//$this->data['amount'] = 1;
		
		
		$customer_fname = $this->data['applicant_basic_details_list']['f_name'];
		$customer_lname = $this->data['applicant_basic_details_list']['l_name']; 
		$cust_full_name = $customer_fname." ".$customer_lname;
		
		$cust_mail      = $this->data['applicant_basic_details_list']['e_mail'];
		$cust_mobile    = $this->data['applicant_basic_details_list']['mob_no'];
		
		//get form fee from db
		$applicantDetailArr=array(
		    'applicant_personal_det_id'=>$applicant_id,
		    'applicant_form_id'=>$get_form_id
		);
		$applicant_application_details_list = $this->_get_applicant_tables($applicantDetailArr, 'db_func_appln_detail');
		$appln_form_fee=isset($applicant_application_details_list[0]['appln_form_fee']) ? $applicant_application_details_list[0]['appln_form_fee'] :'1100.00';
		
		$amount           = $appln_form_fee;		
		$product_info     = PAYMENT_PROD_INFO."@@@".$get_form_id."@@@".$index;
	   
	    $customer_name    = $cust_full_name;
	    $customer_email   = $cust_mail;
	    $customer_mobile  = $cust_mobile;
	    $customer_address = $customer_name;
	    
		// payumoney Key details	    
	
		$MERCHANT_KEY = MERCHANT_KEY;
		$SALT         = MERCHANT_SALT;  

		$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		//optional udf values 
		$udf1 = '';
		$udf2 = '';
		$udf3 = '';
		$udf4 = '';
		$udf5 = '';
		
		$hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_email . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
		$hash = strtolower(hash('sha512', $hashstring));
		if($mode)
		{		
			// Assign the return path URL
			$success = base_url() . 'user/payment_details_online?mode=edit&applicant_personal_det_id='.$applicant_personal_det_id;
			$fail    = base_url() . 'user/payment_details_online?mode=edit&applicant_personal_det_id='.$applicant_personal_det_id;
			$cancel  = base_url() . 'user/payment_details_online?mode=edit&applicant_personal_det_id='.$applicant_personal_det_id;
		}
		else
		{		
		// Assign the return path URL
		$success = base_url() . 'user/payment_details_online';
		$fail    = base_url() . 'user/payment_details_online';
		$cancel  = base_url() . 'user/payment_details_online';
		}
		
		// Assign passing form values
		$this->data['mkey']    = $MERCHANT_KEY;
		$this->data['tid']     = $txnid;
		$this->data['hash']    = $hash;
		$this->data['amount']  = $amount;
		$this->data['name']    = $customer_name;
		$this->data['productinfo'] = $product_info;
		$this->data['mailid']  = $customer_email;
		$this->data['phoneno'] = $customer_mobile;
		$this->data['address'] = $customer_address;
		$this->data['phoneno'] = $customer_mobile;
		$this->data['action']  = PAYMENT_ONLINE_URL;
		$this->data['sucess']  = $success;
		$this->data['failure'] = $fail;
		$this->data['cancel']  = $cancel;	
		$this->data['form_id'] = 9;
		
		$this->template('payment/payuform', $this->data, false);
		//$this->load->view('confirmation', $data); 		
	}
	
	
	public function payment_details_online() {
		$mode = ($this->input->get('mode'))?$this->input->get('mode'):'';
		//$this->is_exists_user_logged();
		$is_international = $this->input->post('is_international',true);
		$is_international=($is_international)?$is_international:'';
        if($is_international){
        	$this->is_exists_international_user_logged();
            $this->user_details_data = $this->session->userdata('international_user_details_data');
        }else { $this->is_exists_user_logged(); }
        $ses_applicant_id = $this->user_details_data['user_details']['data'][0]['applicant_personal_det_id'];
        //$applicant_login_id=$this->user_details_data['user_details']['data'][0]['applicant_login_id'];
        $applicant_personal_det_id = $this->input->get('applicant_personal_det_id');
        $applicant_id = ($applicant_personal_det_id)?$applicant_personal_det_id:$ses_applicant_id;

        if(isset($_REQUEST)){
            $productinfo=$_REQUEST['productinfo'];
            $productinfosep=explode("@@@",$productinfo);
            if(is_array($productinfosep)){
                $get_form_id=$productinfosep[1];
                $index=$productinfosep[2];
            }
        }
		// Get Form ID
        $get_form_id = isset($get_form_id)?$get_form_id:0;
        $index= isset($index)?$index:0;
		// Get Applicant ID
		$applicant_appln_det = $this->check_applicant_appln_id_api($applicant_id,$get_form_id);
	    $applicant_appln_det_id = $applicant_appln_det['id'];	    
	    if($mode)
	    {
	    	$applicantDetailArr=array(
	        'applicant_personal_det_id'=>$applicant_id,
	        'applicant_form_id'=>$get_form_id,
	        'mode'=>'edit'
	    );
	    }
	    else
	    {
	    	$applicantDetailArr=array(
	        'applicant_personal_det_id'=>$applicant_id,
	        'applicant_form_id'=>$get_form_id
	    );
	    }	    
	    $applicant_application_details_list = $this->_get_applicant_tables($applicantDetailArr, 'db_func_appln_detail');
	    $appln_form_fee=isset($applicant_application_details_list[0]['appln_form_fee']) ? $applicant_application_details_list[0]['appln_form_fee'] :'1100.00';
	   
	    $paymentResult=$_REQUEST;
		//print_r($paymentResult);
		//exit;
	    $paymentStatus=$paymentTxnid=$paidAmount=0;
	    $paymentStatusId=$transactionStatusId=PAYMENT_FAILED;
	    $name_on_card="";
	    if(isset($paymentResult)){	    
	    $paymentStatus=$_REQUEST['status'];
	    $paymentTxnid=$_REQUEST['txnid'];
	    $paidAmount=$_REQUEST['amount'];
	    $name_on_card=$_REQUEST['name_on_card'];
		$error=$_REQUEST['error'];
		$error_Message=$_REQUEST['error_Message'];
	    }
	    if($mode != '' && strtolower($paymentStatus)!="success")
	    {
	    	/*echo base_url().'user/payment_thank_you?app_form_id='.$get_form_id.'&payment_mode=online&currentIndex='.$index.'&status='.PAYMENT_FAILED.'&mode='.$mode.'&applicant_personal_det_id='.$applicant_id;
	    	*/
	    	redirect( base_url().'user/payment_thank_you?app_form_id='.$get_form_id.'&payment_mode=online&currentIndex='.$index.'&status='.PAYMENT_FAILED.'&mode='.$mode.'&applicant_personal_det_id='.$applicant_id);
	    die;
	    }	
	    if(strtolower($paymentStatus)!="success"){
			$applicant_appln_det_id = $applicant_appln_det_id;
			$payment_mode_id = PAYMENT_MODE_ONLINE_ID;
			$trans_no = $paymentTxnid;
			$applicant_personal_det_id = $applicant_id;
			$payment_status_id = PAYMENT_FAILED;
			$application_form_cost = APPLICATION_FORM_COST;
			$payment_details_failure = $this->payment_details_failure($applicant_appln_det_id,$payment_mode_id,$trans_no,$applicant_personal_det_id,$payment_status_id,$application_form_cost,$error,$error_Message);
			redirect( base_url().'user/payment_thank_you?app_form_id='.$get_form_id.'&payment_mode=online&currentIndex='.$index.'&status='.PAYMENT_FAILED);
			die;
	    }
	    //need to remove round () in feature
	    if(strtolower($paymentStatus)=="success" && round($appln_form_fee)==round($paidAmount)){
	        $paymentStatusId=PAYMENT_SUCCESS;
	        $transactionStatusId=PAYMENT_SUCCESS;
	    }	    
	    $paymentMode=PAYMENT_MODE_ONLINE_ID;
		
		$user_data = $this->input->post();
		$api_urls  = $this->config->item ( 'api_urls' );
		$url 	   = $api_urls[ 'payment_details' ];
		$method    = 'POST';
		if($is_international){
			$userdata  = $this->session_internationaluserdata();
		}else{
			$userdata  = $this->session_userdata();
		}
		
		$user_data['userdata'] = $userdata;
		$user_data['applicant_personal_det_id'] = $applicant_id;
		$user_data['applicant_appln_id'] = $applicant_appln_det_id;
		$user_data['trans_no'] = $paymentTxnid;
		$user_data['trans_status_id'] = $transactionStatusId;
		$user_data['payment_status_id'] = $paymentStatusId;
		$user_data['application_fee'] = round($paidAmount);
		$user_data['acc_holder_name'] = $name_on_card;
		$user_data['app_form_id'] 	  = $get_form_id;
		if($mode)
		{
			$user_data['mode'] 	  = ADMIN_MODE_EDIT;
		}
		
		$user_data['payment_mode_id'] = $paymentMode;		
		
		list($result_token,$data) = $this->_check_token($user_data);  
		
		if($result_token['valid']=='true')
		{
			$result = $this->call_api ( $url , $method , $user_data );
			$return = $this->json_return($result);
			if($return){
			    redirect( base_url().'user/payment_thank_you?app_form_id='.$get_form_id.'&payment_mode=online&currentIndex='.$index);
			}
		}	
    }
}