<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package SRM - Online Application
 * @category APPlications API
 * @subpackage Users
 *
 * @SWG\Resource(
 *  apiVersion="0.1",
 *  swaggerVersion="1.2",
 *  resourcePath="/api",
 *  produces="['application/json']"
 * )
 *
 */
class Payment extends API_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
	
    /**
     * @OA\Get(
     *     path="/api/bank_list/{id}",
     *     tags={"bank"},
     *     summary="get bank",
     *     description="get bank",
     *     operationId="bank",
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id",
     *         required=false
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid id value"
     *     )
     * )
     */


     /**
     * get bank by id
     *
     * @param bank $id bank id
     * @return json response of bank detail by id
     * @author
     */
    public function bank_list_get ($id = false)
    {
        if ( $id ) {
    
            $this->bank_lists_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/bank_lists/{page}/{limit}",
     *   tags={"banks"},
     *   operationId="get banks list",
     *   @OA\Parameter(name="page",
     *     in="path",
     *     required=false,
     *   ),
     *   @OA\Parameter(name="limit",
     *     in="path",
     *     required=false,
     *   ),
     *   @OA\Parameter(name="keywords",
     *     in="query",
     *     required=false,
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation"
     *   ),
     *   @OA\Response(
     *     response=400,
     *     description="Invalid data"
     *   )

     * )
     */
    /**
     * get banks list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the banks list
     * @param string $id banks id
     * @return json response of banks list by page & limit
     * @author
     */
    public function bank_lists_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        // $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = BANK;
        // Set Columns
        $columns = "bank_id as id,bank_name as name";

        $function_name = $this->get_function_name(__FUNCTION__);
        // Parameter By Array
        $params = array();
        $params['table'] = $table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        if(isset($id) && $id != '')
        {
            $params['id'] = $id;
        }
        $params['pk'] = 'bank_id';
        $params['id_col'] = 'bank_id';
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }	
	
	public function payment_details_post(){
        $form_wizard_payment_id = FORM_WIZARD_PAYMENT_ID;
		$user_data = $this->post();
		$payment_by_online = $user_data['payment_by_online'];
		$payment_by_dd = $user_data['payment_by_dd'];
		$bank_id = $user_data['bank_id'];
		$dd_cheque_no = $user_data['dd_cheque_no'];
		$dd_cheque_date = $user_data['dd_cheque_date'];
		$branch_name = $user_data['branch_name'];
		$applicant_id = $user_data['applicant_personal_det_id'];
		$applicant_appln_id = $user_data['applicant_appln_id'];
		
		$payment_mode_id = $user_data['payment_mode_id'];
        // Get Form ID
        $get_form_id = $this->input->post('app_form_id',true);
        $get_form_id = ($get_form_id)?$get_form_id:APP_FORM_ID_DE;

        if($get_form_id == APP_FORM_ID_INTERNATIONAL)
        {
            $update_progress = $this->appln_progress_completed($applicant_appln_id,$applicant_id);
        }
		
		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');

		if($payment_by_dd=='dd' || $payment_by_dd==true){
			$this->form_validation->set_rules('bank_id', 'Bank Name','trim|required');
			$this->form_validation->set_rules('dd_cheque_no', 'DD Number','trim|required');
			$this->form_validation->set_rules('dd_cheque_date', 'Mother Name','trim|required');
			$this->form_validation->set_rules('branch_name', 'Branch Name','trim|required');
        }
        //for online only
        if($payment_mode_id==PAYMENT_MODE_ONLINE_ID){
            $this->form_validation->set_rules('trans_no', 'Transaction','trim|required');
            $this->form_validation->set_rules('application_fee', 'Application Fees','trim|required');
            $this->form_validation->set_rules('payment_status_id', 'Payment status','trim|required');
         }
		
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}
		
		$table_schema = SCHEMA_ADMISSION;
		$applicant_payment_details_table = 'applicant_payment_det';		
		
		if($payment_by_dd=='dd'){
		    $applicant_payment_details_columns ='payment_mode_id,bank_id,applicant_personal_det_id,dd_cheque_no,dd_cheque_date,created_by,updated_by,active,applicant_appln_id,file_type_id,branch_name,application_fee,trans_no';
		    $_POST['payment_mode_id'] = DD;
			$_POST['dd_cheque_no'] = $dd_cheque_no;
			$_POST['dd_cheque_date'] = $dd_cheque_date;
			$_POST['file_type_id'] = 1;
			$_POST['branch_name'] = $branch_name;
			$_POST['bank_id'] = $bank_id;
			$_POST['application_fee']= $user_data['application_fee'];
			$_POST['trans_no']= $user_data['trans_no'];
		}
		if($payment_mode_id==PAYMENT_MODE_ONLINE_ID){
		    $applicant_payment_details_columns ='payment_mode_id,applicant_personal_det_id,trans_no,trans_status_id,payment_status_id,application_fee,created_by,updated_by,active,applicant_appln_id,acc_holder_name';
		    $_POST['trans_no']= $user_data['trans_no'];
		    $_POST['trans_status_id']= $user_data['trans_status_id'];
		    $_POST['payment_status_id']= $user_data['payment_status_id'];
		    $_POST['application_fee']= $user_data['application_fee'];
		    $_POST['payment_mode_id']= $user_data['payment_mode_id'];
		    $_POST['acc_holder_name']= $user_data['acc_holder_name'];
		}
		$_POST['created_by'] = $applicant_id;
		$_POST['updated_by'] = $applicant_id;
		$_POST['active'] = true;
		$_POST['applicant_appln_id'] = $applicant_appln_id;
		$_POST['applicant_personal_det_id'] = $applicant_id;
		
		// Payment Insert / Update
		$payment_details = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_payment_details_table, $applicant_payment_details_columns,false,'applicant_payment_det_id');
       
        // common_wizardupdate
        $wizard_update = $this->common_wizardupdate($applicant_id , $get_form_id , $form_wizard_payment_id);
        
        //applin no update
        $appln_no_update = $this->appln_no_update($applicant_appln_id,$applicant_id , $get_form_id);
        
		$this->response ($payment_details , API_Controller::HTTP_OK);
	}

    /*International FOrm Payment Completed Progress Last tab payment*/

    public function appln_progress_completed($applicant_appln_id , $applicant_personal_det_id)
    {
        $applicant_appln_det_table = APPLICANT_APPLN;       
        $table_schema = SCHEMA_ADMISSION;
        $table_prefix = '';
        $applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
        $application_completed = APPLICATION_IN_COMPLETED;
        $function_name = $this->get_function_name(__FUNCTION__);
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['active'] = TRUE;
        $_POST['updated_by'] = $applicant_personal_det_id;
        $_POST['application_status_id'] = $application_completed;
        $applicant_appln_det_columns = 'applicant_appln_id,applicant_personal_det_id,,application_status_id,updated_by,active';
        //  applicant_personal_det insert / update
        $applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, array('applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns);
    }
	
	public function payment_details_failure_post(){
		$table_schema = SCHEMA_PHP_DEV;
		$table = PAYMENT_TBL_HISTORY;
		$applicant_payment_details_table = $table_schema.'.'.$table;				
       
        $table_prefix = '';
        $payment_mode_id = $this->post('payment_mode_id',true);
		$trans_no = $this->post('trans_no',true);
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
        $applicant_appln_id = $this->post('applicant_appln_id',true);
		$payment_status_id = $this->post('payment_status_id',true);
		$application_fee = $this->post('application_fee',true);
		$error_code = $this->post('error_code',true);
		$error_text = $this->post('error_text',true);
        $function_name = $this->get_function_name(__FUNCTION__);
		
        $applicant_payment_details_columns = 'payment_mode_id,trans_no,active,applicant_personal_det_id, applicant_appln_id,payment_status_id,application_fee,created_by,error_text,error_code';
		$_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['active'] = TRUE;
        $_POST['created_by'] = $applicant_personal_det_id;
		$_POST['applicant_personal_det_id'] = $applicant_personal_det_id;
        $_POST['payment_mode_id'] = $payment_mode_id;
		$_POST['trans_no'] = $trans_no;
		$_POST['applicant_appln_id'] = $applicant_appln_id;
		$_POST['payment_status_id'] = $payment_status_id;
		$_POST['application_fee'] = $application_fee;
		$_POST['error_text'] = $error_text;
		$_POST['error_code'] = $error_code;		
		$table_prefix='';
		$function_name = $this->get_function_name ( __FUNCTION__ );      
		$applicant_appln_det_res = $this->_common_insert ( $applicant_payment_details_table , $table_prefix , $function_name , $applicant_payment_details_columns , $table_schema);	
			
		if($applicant_appln_det_res){
			$applicant_appln_det_res = array("status"=>true);
			$this->response ($applicant_appln_det_res , API_Controller::HTTP_OK);
		}
	}
}