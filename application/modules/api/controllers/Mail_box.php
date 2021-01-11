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
/**
 * @package SRM - Online Application
 * @category Login API
 * @subpackage Login
 *
 * @SWG\Resource(
 *  apiVersion="0.1",
 *  swaggerVersion="1.2",
 *  resourcePath="/api",
 *  produces="['application/json']"
 * )
 *
 */

class Mail_box extends API_Controller
{

	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
	

    /**
     *
     * @SWG\Api(
     *   path="insert_mailbox",
     *   description="post",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="insert_mailbox",
     *       notes="Returns a json",
     *       nickname="insert_mailbox",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="subject",
     *           description="subject",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="message",
     *           description="message",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="from_id",
     *           description="from_id",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="to_id",
     *           description="to_id",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="active",
     *           description="active",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *       ),
     *       @SWG\ResponseMessages(
     *          @SWG\ResponseMessage(
     *            code=400,
     *            message="No data was found"
     *          ),
     *          @SWG\ResponseMessage(
     *            code=404,
     *            message="Not found"
     *          )
     *       )
     *     )
     *   )
     * )
     */

    /**
     * @OA\Post(
     *     path="/api/insert_mailbox",
     *     tags={"mailbox"},
     *     summary="insert mailbox",
     *     operationId="insert_mailbox",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="subject",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="from_id",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="to_id",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="active",
     *                     type="string"
     *                 ),
     *                 example={"subject": "prabaharans", "message": "*******", "from_id": "1", "to_id": "1", "active": "1"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function insertmail_post()
    {
		$_POST['active']=TRUE;
		$_POST['created_by']=CREATED_BY;
    	$user_data = $this->post();
    	// Set validations
    	$this->form_validation->set_data($user_data);
		$this->form_validation->set_rules('subject', 'Subject','trim|required');
		$this->form_validation->set_rules('message', 'Message','trim|required');		
		$this->form_validation->set_rules('from_id', 'FromID','trim|required');
		$this->form_validation->set_rules('to_id', 'ToID','trim|required');
		//$this->form_validation->set_rules('active', 'Active','trim|required');
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			$this->output->set_output(json_encode(['status' => 'error', 'message' => validation_errors()]));
            return false;
		}

		$table = MAIL_BOX;
		$columns = 'subject,message,from_status,to_status,from_id,to_id,active';

		$table_prefix='';
		// Set Schema
        $table_schema = SCHEMA_PHP_DEV;
		$function_name = $this->get_function_name ( __FUNCTION__ );
		$insert = $this->_common_insert ( $table , $table_prefix , $function_name , $columns , $table_schema);
		if($insert)
		{
            $params = array();
            $params['table'] = $table;
            $params['table_prefix'] = $table_prefix;
            $params['pk'] = $table_prefix.'mail_id';
            $params['returnresponse']=TRUE;
            //$params['cond'] = $cond;
            $params['columns'] = 'mail_id';
            $params['limit'] = 1;
            $mail_id = $this->_select_table($params);
            $mail_id = $mail_id['data'][0]['mail_id'];            
            $this->update_mailstatus(MAIL_BOX , SCHEMA_PHP_DEV ,'mail_id', 'from_status' , $mail_id, '3');
			$this->output->set_output(json_encode(['status' => 'true', 'message' => INSERT_MESSAGE]));
		}
		else
		{
			$this->output->set_output(json_encode(['status' => 'error', 'message' => ERROR_MSG]));
		}
    }

    /**
     *
     * @SWG\Api(
     *   path="mailbox",
     *   description="get",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="get mailbox",
     *       notes="Returns a json",
     *       nickname="mailbox",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="id",
     *           description="id",
     *           paramType="path",
     *           required=false,
     *           type="string"
     *         ),
     *       ),
     *       @SWG\ResponseMessages(
     *          @SWG\ResponseMessage(
     *            code=400,
     *            message="Please pass the mailbox id to get mailbox detail."
     *          ),
     *          @SWG\ResponseMessage(
     *            code=404,
     *            message="Not found"
     *          )
     *       )
     *     )
     *   )
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/mailbox/{id}",
     *     tags={"mailbox"},
     *     summary="get mailbox",
     *     description="get mailbox",
     *     operationId="mailbox",
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
    public function mailbox_get($id = false)
    {
    	if ( $id ) {
            $this->mailboxes_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     *
     * @SWG\Api(
     *   path="mailboxes/{page}/{limit}",
     *   description="get",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="get mailboxes list",
     *       notes="Returns a json",
     *       nickname="mailboxes list",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="page",
     *           description="page",
     *           paramType="path",
     *           required=false,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="limit",
     *           description="limit",
     *           paramType="path",
     *           required=false,
     *           type="string"
     *         ),
     *       ),
     *       @SWG\ResponseMessages(
     *          @SWG\ResponseMessage(
     *            code=400,
     *            message="No data was found"
     *          ),
     *          @SWG\ResponseMessage(
     *            code=404,
     *            message="Not found"
     *          )
     *       )
     *     )
     *   )
     * )
     */

    /**
     ** @OA\Get(
     *   path="/api/mailboxes/{page}/{limit}",
     *   tags={"mailbox"},
     *   operationId="get mailboxes list",
     *   @OA\Parameter(name="page",
     *     in="path",
     *     required=false,
     *   ),
     *   @OA\Parameter(name="limit",
     *     in="path",
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
    public function mailboxes_get ($page = false , $limit = false , $id = false)
    {
        //$status = $this->input->get('status');
    	 // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
		// Set Schema
        $table_schema = SCHEMA_PHP_DEV;
		// Set Table
        $table = MAIL_BOX;
		// Set Columns
        $columns = 'mail_id,subject,message,from_id,to_id,from_status,to_status';

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
        $list_id = $this->get('list_id',true) ? $this->get('list_id',true) : 'inbox'; 
        //$status = $this->get('status',true) ? $this->get('status',true) : '0,1';
        //$status = explode(',', $status);
        //$in_cond[$table.'.'.$table_prefix.'status'] = $status; 
        $arr_not_like = [];
        if($list_id == MAILBOX_TRASH_TEXT) 
        {
            $or_conditions='(from_id ='.$this->get('to_id',true).' OR to_id = '.$this->get('to_id',true).')';
            $arr_not_like['or'] = $or_conditions;
            $cond[$table.'.'.$table_prefix.'from_status']   = MAIL_BOX_TRASH; 
        }
        elseif ($list_id == MAILBOX_INBOX_TEXT) {
            $cond[$table.'.'.$table_prefix.'to_id']       = $this->get('to_id',true); 
            $status= MAIL_BOX_UNREAD.','.MAIL_BOX_READ;
            $status = explode(',', $status);
            $in_cond[$table.'.'.$table_prefix.'to_status'] = $status; 
        }

        elseif ($list_id == MAILBOX_SENT_TEXT) {
            $cond[$table.'.'.$table_prefix.'from_id']       = $this->get('from_id',true); 
            $cond[$table.'.'.$table_prefix.'from_status']   = MAIL_BOX_SENT; 
        }
       
        if((isset($in_cond)) && !empty($in_cond))
        {
            $params['in_cond'] = $in_cond;
        }        
		$params['pk'] = 'mail_id';
        $params['id_col'] = 'mail_id';	
        if(isset($cond))
        {
            $params['cond'] = $cond;
        }
		// Call Select Method
        $this->_select_table($params);
    }

    public function update_mailstatus($table , $table_schema = false ,$where_columns, $put_column , $mail_id, $status)
    {       
       $table_prefix = '';
       $this->set_schema($table_schema); 
       $where[$where_columns] = $mail_id;
       $put_array[$put_column] = $status; 
       $update = $this->common->common_update ( $table , $table_prefix , $put_array, $where);
    }

    
}