<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package SRM - Online Application
 * @category Users API
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
class Users extends API_Controller {

	public function __construct()
	{		
		parent::__construct();
		$this->load->library('form_validation');
	}

	/**
     *
     * @SWG\Api(
     *   path="user_list/{page}/{limit}",
     *   description="get",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="get users list",
     *       notes="Returns a json",
     *       nickname="users list",
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
     *   path="/api/user_list/{page}/{limit}",
     *   tags={"user"},
     *   operationId="get_user_list",
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

	/**
     * User List
     *    
     * @return json response of all active user detail
     * @author
     */

	public function list_post($id)
	{
		// echo 'list';die;
		//Validate user
		$this->load->library ( 'Authorization_Token' );
		$this->authorization_token->validateToken ();
		// $this->validate_token($this->input->get_request_header('X_AUTH_TOKEN'));

		$this->load->model('User');

		// Finally save the user			
		$user_list = $this->User->getRows();
		/*echo '<pre>';
		print_r($user_list);
		echo '</pre>';
		die;*/
		$this->format = 'json';
		if(!$user_list){
			return $this->set_response(
				array(),
				$this->lang->line('text_server_error'),
				API_Controller::HTTP_INTERNAL_SERVER_ERROR
			);
		}
			
		return $this->set_response(
			$user_list,
			$this->lang->line('text_user_list_success'),
			API_Controller::HTTP_CREATED
		);
	}
	
	/**
     *
     * @SWG\Api(
     *   path="upload",
     *   description="post",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="upload user files",
     *       notes="Returns a json",
     *       nickname="upload user files",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="fileName",
     *           description="fileName",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="fileData",
     *           description="fileData",
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
     *     path="/api/upload",
     *     description="",
     *     tags={"user"},
     *     summary="upload user files",
     *     operationId="upload",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="Additional data to pass to server",
     *                     property="fileName",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     description="file to upload",
     *                     property="fileData",
     *                     type="string",
     *                     format="file",
     *                 ),
     *                 required={"file"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="successful operation",
     *     ),
     * )
     * */
	public function upload_post(){
		if (isset($_POST['fileName']) && $_POST['fileData'])
		{
			// Save uploaded file
			$uploadDir = UPLOAD_PATH_VALUE;
			file_put_contents(
				$uploadDir. $_POST['fileName'],
				base64_decode($_POST['fileData'])
			);

			// Done
			echo "Success";
		}		
		/* $config = array(
			UPLOAD_PATH => UPLOAD_PATH_VALUE,
			ALLOWED_TYPES => ALLOWED_TYPES_VALUE,
			OVERWRITE => OVERWRITE_VALUE,
			MAX_SIZE => MAX_SIZE_VALUE, // Can be set to particular file size , here it is 2 MB(2048 Kb)
			MAX_HEIGHT => MAX_HEIGHT_VALUE,
			MAX_WIDTH => MAX_WIDTH_VALUE,
		);

		$this->load->library('upload', $config);
		if($this->upload->do_upload('userfile'))
		{
			$data = array('upload_data' => $this->upload->data());
			$upload['upload_success_data'] = 'File Uploaded';
			$this->set_response_simple($data,$upload['upload_success_data'],200);
		}else{
			$this->data = array();
			$data = array('upload_data' => null);
			$upload['upload_error_data'] ='Invalid Format Or File Not Uploaded';
			$this->set_response_simple($data,$upload['upload_error_data'],200);
		} */
	}

	/**
     *
     * @SWG\Api(
     *   path="register",
     *   description="post",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="register",
     *       notes="Returns a json",
     *       nickname="register",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="user_name",
     *           description="user_name",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="display_name",
     *           description="display_name",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="role_id",
     *           description="role_id",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="email",
     *           description="email",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="phone_no",
     *           description="phone_no",
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
     *     path="/api/register",
     *     tags={"login"},
     *     summary="user register",
     *     operationId="register",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="user_name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="display_name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="role_id",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone_no",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */

	 /**
     * Register new user
     *
     * @param user detail  user_name,display_name,role_id,email,phone_no
     * @return json response of user details insert or not
     * @author
     */

	public function register_post()
     {
          $user_data = $this->post ();
          $table_schema = SCHEMA_ADMISSION;
          $table = TABLE_APPLICANT_LOGIN;
          $personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
          $applicant_log = APPLICANT_LOG_TABLE;
          $this->set_schema($table_schema); 
          // Set validations
          $this->form_validation->set_data($user_data);          
          // $this->form_validation->set_rules('user_name', 'Username', 'trim|required|xss_clean|is_unique[user.user_name]');
          $this->form_validation->set_rules('display_name', 'Display Name','trim|required');
          //$this->form_validation->set_rules('role_id', 'Role','trim|required');
          $this->form_validation->set_rules('email', 'Email','trim|required|xss_clean|is_unique['.$table.'.email_id]|valid_email');
          $this->form_validation->set_rules('phone_no_code', 'Phone No Code','trim|required'); 
          // $this->form_validation->set_rules('phone_no', 'Phone No','trim|required|xss_clean|is_unique[user.phone_no]'); 
          $this->form_validation->set_rules('phone_no', 'Phone No','trim|required|xss_clean|is_unique['.$table.'.mobile_no]'); 
          $this->form_validation->set_rules('password', 'Password','trim|required'); 
          $this->form_validation->set_rules('state', 'State','trim|required'); 
          $this->form_validation->set_rules('city', 'City','trim|required'); 
          //$this->form_validation->set_rules('course', 'Course','trim|required'); 
      
          //Run Validations
          if ($this->form_validation->run() == FALSE) {
                $this->output->set_output(json_encode(['status' => 'error', 'message' => validation_errors()]));
            return false;
          }         

          $_POST['active']=TRUE;
          // $_POST['passwd']=USER_PASSWORD;
          $admin_register=$this->post('admin_register',true);
          $admin_register = ($admin_register)?$admin_register:false;
          $display_name=$this->post('display_name',true);
          $email=$this->post('email',true);
          $passwd = $old_pass =$this->post('password',true);
          $passwd=password_hash($passwd, PASSWORD_DEFAULT);
          $_POST['applicant_pwd']=$passwd;
          //unset($_POST['password']);
          $_POST['created_by']=CREATED_BY;
          // $_POST['user_type_id']=USER_TYPE_ID;
          // $_POST['role_id']=USER_ROLE_ID;
          $_POST['state_id']= (int) $this->post('state',true);
          //unset($_POST['state']);
          $_POST['city_id']=(int) $this->post('city',true);
          //unset($_POST['city']);
          // $_POST['degree_id']=$_POST['course'];
          // $_POST['degree_id']=51;
          $_POST['mob_country_code_id']=(int) $this->post('phone_no_code',true);
          $_POST['mobile_no']= $this->post('phone_no',true);
          $_POST['name']= $display_name;
          // $_POST['appln_no']= 123;
          $_POST['email_id']= $email;
          // $_POST['last_name']= 'test'; //$this->post('display_name',true);
          $_POST['first_name']= $display_name;
          if($admin_register) {
               $_POST['declaration_compl']= 't';
               $_POST['created_by']=CREATED_BY_ADMIN;
          }
          
          $pgm_name = $this->post('pgm_name',true);
          /*$data['email_id'] = $this->post('email',true);
          $data['created_by'] = CREATED_BY;
          $data['applicant_pwd'] = $passwd;
          $data['mobile_no'] = $this->post('phone_no',true);
          $data['active'] = TRUE;
          $data['mob_country_code_id'] = (int) $this->post('phone_no_code',true);
          $data['appln_no'] = 123;
          $data['appln_no'] = 123;*/
          
          // $user_course_table = USER_COURSE_TABLE;
          // $columns = 'user_name,display_name,passwd,email,phone_no,active,created_by,user_type_id,user_id';
          //$columns = 'name,applicant_pwd,email_id,mobile_no,active,created_by,state_id,city_id,mob_country_code_id,degree_id';
          $columns = 'applicant_pwd,email_id,mobile_no,created_by,mob_country_code_id';
          $table_prefix='';
          $function_name = $this->get_function_name ( __FUNCTION__ ); 

          $insert = $this->_common_insert ( $table , $table_prefix , $function_name , $columns , $table_schema);
          //$_POST['declaration_compl']=TRUE;
          if($insert)
          {
            $columns = 'applicant_login_id,applicant_pwd,email_id,mobile_no,created_by,mob_country_code_id';
               $params = array();
             $params['table'] = $table;
             $params['table_schema'] = $table_schema;
             $params['function_name'] = $function_name;
             $params['limit'] = 1;
             $params['columns'] = $columns;
             $params['returnresponse'] = TRUE;
             $params['pk'] = 'applicant_login_id';
             $userdata_id = $this->_select_table($params);
             $insert_id = $userdata_id['data'][0]['applicant_login_id'];
             
               //$insert_id = $this->db->insert_id();
               $_POST['applicant_login_id'] = $insert_id;
               $_POST['no_of_attempts']      = 1;
               $_POST['last_visited_at']      =date("Y-m-d H:i:s");
               if($insert_id)
               {
                    $columns = 'first_name,email_id,mobile_no,created_by,applicant_login_id,state_id,city_id';
                                        
                    $personal_det_insert = $this->_common_insert ( $personal_det_table , $table_prefix , $function_name , $columns , $table_schema);
                    $this->load->helper('string');
                    $rand_str = random_string('md5').time();
                    $hash_rand_str = password_hash($rand_str,PASSWORD_DEFAULT);
                    $_POST['verification_link'] = $rand_str;
					$log_tble_col = 'applicant_login_id,last_visited_at,no_of_attempts,verification_link,created_by';
                    $insert_log_tble = $this->_common_insert ( $applicant_log , $table_prefix , $function_name , $log_tble_col , $table_schema);
                    if($admin_register) {
                         

                         // admin send mail to user for new user register
                         $subject = USER_REGISTER_SUBJECT;
                         // $selectedTime  = date("Y-m-d H:i:s");
                         // $endTime       = strtotime("+". USER_REGISTER_VERIFY_RESET_TIME. "minutes", strtotime($selectedTime)); 
                         // $verify_end_time  = date('h:i A', $endTime);
                         // $this->data['verify_end_time']  = $verify_end_time;
                         $this->data['display_name']   = $display_name;
                         $this->data['email']   = $email;
                         $this->data['password']   = $old_pass;
                         $this->data['verify_text']   = $rand_str;
                         $this->data['user_id']   = $insert_id;
                         $this->data['pgm_name']   = $pgm_name;
                        
                         $message = $this->load->view('email_templates/user_reg_notify_by_admin',$this->data,true);
                         $to = $email;
                         $from = USER_REGISTER_FROM;
                         $send_mail = $this->common_send_mail($subject,$message,$from,$to);
                    } else {

                         $subject = USER_REGISTER_SUBJECT;
                         $selectedTime  = date("Y-m-d H:i:s");
                         $endTime       = strtotime("+". USER_REGISTER_VERIFY_RESET_TIME. "minutes", strtotime($selectedTime)); 
                         $verify_end_time  = date('h:i A', $endTime);
                         $this->data['verify_end_time']  = $verify_end_time;
                         $this->data['display_name']   = $display_name;
                         $this->data['verify_text']   = $rand_str;
                         $this->data['user_id']   = $insert_id;
                         $this->data['pgm_name']   = $pgm_name;                         
                         $message = $this->load->view('email_templates/user_verify_notify',$this->data,true);
                         $to = $email;
                         $from = USER_REGISTER_FROM;
                         $send_mail = $this->common_send_mail($subject,$message,$from,$to);
                    }
                    if($send_mail)
                    {
                         if($admin_register) {
                              $this->output->set_output(json_encode(['status' => 'true', 'message' => REGISTER_SUCCESSFULLY,'applicant_login_id'=>$insert_id,'applicant_personal_det_id'=>$personal_det_insert]));
                         } else {
                              $this->output->set_output(json_encode(['status' => 'true', 'message' => REGISTER_SUCCESSFULLY]));    
                         }
                          
                         /*$put_array = $where = [];
                         $where['user_id'] = $insert_id;
                         $put_array['verify_link'] = $hash_rand_str;
                         $put_array['createdat_verify_link'] = $selectedTime;
                         $update = $this->common->common_update ( $table , $table_prefix , $put_array, $where);
                         if($update)
                         {
                              $this->output->set_output(json_encode(['status' => 'true', 'message' => REGISTER_SUCCESSFULLY]));
                         } else {
                              $this->output->set_output(json_encode(['status' => 'error', 'message' => ERROR_RECORD_ADD]));     
                         }*/
                    } else {
                         $this->output->set_output(json_encode(['status' => 'error', 'message' => MAIL_COULD_NOT_SEND]));         
                    }
               }
               else
               {
                    $this->output->set_output(json_encode(['status' => 'error', 'message' => ERROR_MSG]));                   
               }
          }
     }

	

	/**
     *
     * @SWG\Api(
     *   path="edit_user",
     *   description="update brand",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="PUT",
     *       summary="Update User detail",
     *       notes="Returns a json",
     *       nickname="Update User detail",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="display_name",
     *           description="display_name",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="user_id",
     *           description="user_id",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="phone_no",
     *           description="phone_no",
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
     * @OA\Put(
     *     path="/api/edit_user",
     *     tags={"user"},
     *     operationId="updateuser",
     *     summary="Update an existing user",
     *     description="",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *                 @OA\Property(
     *                     property="display_name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="user_id",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone_no",
     *                     type="string"
     *                 ),
     *            )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="user not found",
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception",
     *     ),
     * )
     */

	/**
     * update user id
     *
     * @param user_id , display_name , phone_no
     * @return json response of user details update or not
     * @author
     */

	public function edituser_put()
	{
		// Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['PUT'],'requireAuthorization' => true,]);
		$data = array('display_name'=> $this->put('display_name',true),'user_id'=> $this->put('user_id',true),'phone_no'=> $this->put('phone_no',true),'alt_phone_no'=> $this->put('alt_phone_no',true));
		$table_schema = SCHEMA_PHP_DEV;
		$this->set_schema($table_schema); 
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('display_name', 'Display Name','trim|required|xss_clean');
		$this->form_validation->set_rules('user_id', 'User ID','trim|required|xss_clean');
		$this->form_validation->set_rules('phone_no', 'Phone Number','trim|required|xss_clean');
		$this->form_validation->set_rules('alt_phone_no', 'Altenate Phone Number','trim|required|xss_clean');
		
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			$this->output->set_output(json_encode(['status' => 'error', 'message' => validation_errors()]));
            return false;
		}
		$table = USER;
		$table_prefix = '';
		$columns = 'user_id';
		$cond[$table_prefix.'user_id = '] = $data['user_id'];
		$cond[$table_prefix.'active = '] = true;
		$params = array();
		$params['table'] = $table;
		$params['table_prefix'] = $table_prefix;
		$params['pk'] = $table_prefix.'user_id';
		$params['returnresponse']=TRUE;
		$params['cond'] = $cond;
		$params['columns'] = $columns;
		$user_det = $this->_select_table($params);
		if((isset($user_det['data'])) && !empty($user_det['data']))
		{
			$user_id = $data['user_id'];
			$where[$table_prefix.'user_id'] = $user_id;
			$put_array[$table_prefix.'display_name'] = $data['display_name'];
			$put_array[$table_prefix.'phone_no'] = $data['phone_no'];
			$put_array[$table_prefix.'alt_phone_no'] = $data['alt_phone_no'];
			$update = $this->common->common_update ( $table , $table_prefix , $put_array, $where);
			if($update)
			{
				$this->output->set_output(json_encode(['status' => 'true', 'message' => UPDATE_SUCCESS_MSG_USER]));
			}
			else
			{
				$this->output->set_output(json_encode(['status' => 'error', 'message' => ERROR_MSG]));
			}
		}
		else
		{
			$this->output->set_output(json_encode(['status' => 'error', 'message' => INVALID_EDIT_USER_ID]));
		}		

	}

	/**
     *
     * @SWG\Api(
     *   path="user/{id}",
     *   description="get",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="get user",
     *       notes="Returns a json",
     *       nickname="user",
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
     *            message="Please pass the user id to get user detail."
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
     *     path="/api/user/{id}",
     *     tags={"user"},
     *     summary="get user detail",
     *     description="get user",
     *     operationId="user",
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
     * get user by id
     *
     * @param stream $id user id
     * @return json response of users detail by id
     * @author
     */
    public function user_get ($id = false)
    {
        if ( $id ) {
            $this->users_get ( false , false , $id );
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
     *   path="user/{page}/{limit}",
     *   description="get",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="get users list",
     *       notes="Returns a json",
     *       nickname="users list",
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
     *   path="/api/user/{page}/{limit}",
     *   tags={"user"},
     *   operationId="get_users",
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

     /**
     * get users list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the users list
     * @param string $id users id
     * @return json response of users list by page & limit
     * @author
     */
    public function users_get ($page = false , $limit = false , $id = false)
    {
          $email = $this->get('email',true);
          $candidate_email_id = $this->get('candidate_email_id',true);
          $phone_no = $this->get('phone_no',true);
          $candidate_mobile_no = $this->get('candidate_mobile_no',true);
          $user_login = $this->get('user_login', true);
          $for_register = $this->get('for_register', true);
          $mode = $this->get('mode', true);
          $applicant_login_id = $this->get('applicant_login_id', true);
          $is_international = $this->get('is_international',true);
          if(!$user_login) {
               // Check Authorization Token
               $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
          }
          // Set Schema
          $table_schema = SCHEMA_ADMISSION;
          // Set Table
          $table = TABLE_APPLICANT_LOGIN;
          $schema_master = SCHEMA_MASTER;
          $state_table = $schema_master.'.'.MASTER_STATE;
          $state_table_state = MASTER_STATE;
          $city_table = $schema_master.'.'.MASTER_CITY;
          $city_table_city = MASTER_CITY;
          $personal_det_table = APPLICANT_PERSONAL_DET_TABLE;         
          // Set Columns
          //$columns = 'user_id,display_name,email,phone_no,user_name,alt_phone_no,'.$state_table.'.state_name,'.$city_table.'.city_name';
          $columns = $table.'.applicant_login_id,'.$table.'.applicant_pwd,'.$table.'.email_id,'.$table.'.mobile_no,'.$table.'.active,'.$table.'.created_by,'.$table.'.mob_country_code_id,'.$table.'.appln_no, '.$personal_det_table.'.applicant_personal_det_id, '.$personal_det_table.'.user_id, '.$personal_det_table.'.first_name, '.$personal_det_table.'.middle_name, '.$personal_det_table.'.last_name, '.$personal_det_table.'.mobile_no, '.$personal_det_table.'.email_id, '.$personal_det_table.'.second_mobile_no, '.$personal_det_table.'.second_email_id, '.$personal_det_table.'.dob, '.$personal_det_table.'.gender_id, '.$personal_det_table.'.diff_abled, '.$personal_det_table.'.marital_status_id, '.$personal_det_table.'.nationality_id, '.$personal_det_table.'.aadhar_no, '.$personal_det_table.'.active, '.$personal_det_table.'.created_by, '.$personal_det_table.'.created_at, '.$personal_det_table.'.updated_by, '.$personal_det_table.'.updated_at, '.$personal_det_table.'.social_status_id, '.$personal_det_table.'.title_id, '.$personal_det_table.'.deformity_type_id, '.$personal_det_table.'.deformity_percent, '.$personal_det_table.'.employee, '.$personal_det_table.'.blood_grp_id, '.$personal_det_table.'.residing_country_id, '.$personal_det_table.'.caste_category_id, '.$personal_det_table.'.passport_no, '.$personal_det_table.'.passport_issue_date, '.$personal_det_table.'.passport_expiry_date, '.$personal_det_table.'.resident_category_id, '.$personal_det_table.'.sponsor_name, '.$personal_det_table.'.sponsor_relationship_id, '.$personal_det_table.'.prefer_hostel, '.$personal_det_table.'.passport_issue_place, '.$personal_det_table.'.eyes_color, '.$personal_det_table.'.medi_issues, '.$personal_det_table.'.resid_india, '.$personal_det_table.'.height_cm, '.$personal_det_table.'.weight_kg, '.$personal_det_table.'.identify_marks, '.$personal_det_table.'.digilocker_id, '.$personal_det_table.'.aadhar_consent, '.$personal_det_table.'.sponsored_candidate, '.$personal_det_table.'.religion_id, '.$personal_det_table.'.applicant_mob_country_code_id, '.$personal_det_table.'.reg_mob_country_code_id, '.$personal_det_table.'.domestic_cat_consent, '.$personal_det_table.'.nri_category, '.$personal_det_table.'.ocipionumber, '.$personal_det_table.'.nature_of_deformity, '.$personal_det_table.'.mothertongue_id, '.$personal_det_table.'.advertisement_source_id, '.$personal_det_table.'.state_id, '.$personal_det_table.'.city_id, '.$personal_det_table.'.degree_id, '.$personal_det_table.'.dghs_rollno, '.$personal_det_table.'.neet_rank, '.$personal_det_table.'.allotted_quota, '.$personal_det_table.'.terms_accepted, '.$personal_det_table.'.terms_accepted_at, '.$state_table.'.state_name,'.$city_table.'.city_name';

          $function_name = $this->get_function_name(__FUNCTION__);
          // Parameter By Array
          $params = array();
          $table_prefix = '';
          $joins = array(
               array(
                    'table' => $personal_det_table,
                    'condition' => $personal_det_table.'.applicant_login_id = '.$table.'.applicant_login_id AND '.$table.".active='true'" . ' AND '.$personal_det_table.".active='true'",
                    'jointype' => 'INNER'
               ),
               array(
                    'table' => $state_table,
                    'condition' => $state_table_state.'.state_id = '.$personal_det_table.'.state_id',
                    'jointype' => 'LEFT'
               ),
               array(
                    'table' => $city_table,
                    'condition' => $city_table_city.'.city_id = '.$personal_det_table.'.city_id',
                    'jointype' => 'LEFT'
               ),             
          );        
          
          $params['table'] = $table;
          $params['table_schema'] = $table_schema;
          $params['function_name'] = $function_name;
          $params['table_prefix'] = $table_prefix;
          $params['page'] = $page;
          $params['limit'] = $limit;
          $params['columns'] = $columns;
          if(isset($id) && $id != '')
          {
               $params['id'] = $id;
          }
          $params['pk'] = $table.'.applicant_login_id';
          $params['id_col'] = $table.'.applicant_login_id';
          $params['joins'] = $joins;
          $cond = array();
          if($email) {
               $cond[$table.'.email_id'] = $email;
          }
          if($candidate_email_id) {
               $cond[$table.'.email_id'] = $candidate_email_id;     
               if($mode == 'edit') {
                    $cond['applicant_login_id != '] = $applicant_login_id;
               }
          }
          if($phone_no) {
               $cond[$table.'.mobile_no'] = $phone_no;
          }
          if($candidate_mobile_no) {
               $cond[$table.'.mobile_no'] = $candidate_mobile_no;
               if($mode == 'edit') {
                    $cond['applicant_login_id != '] = $applicant_login_id;
               }
          }
          if($is_international)
          {
             $cond['is_international'] = true;       
          }else { $cond['is_international'] = false; }
          $params['cond'] = $cond;
          // Call Select Method
          $this->_select_table($params);
    }



    /**
     *
     * @SWG\Api(
     *   path="forgotpwd",
     *   description="post",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="forgot password",
     *       notes="Returns a json",
     *       nickname="forgot password",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="email",
     *           description="email",
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
     *     path="/api/forgotpwd",
     *     tags={"login"},
     *     summary="user forgotpwd",
     *     operationId="forgotpwd",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */

     /**
     * get email forgot password
     *
     * @param email
     * @return password in mail send or not in return json response
     * @author
     */

     public function forgotpwd_post()
     {   

          $data = array(
          'email' => $this->post('email',true),
          );
          $table_schema = SCHEMA_ADMISSION;
          $this->set_schema($table_schema); 
          $this->form_validation->set_data($data);
          $this->form_validation->set_rules('email', 'Email','trim|required|xss_clean|valid_email');
          //Run Validations
          if ($this->form_validation->run() == FALSE) {
                $this->output->set_output(json_encode(['status' => 'error', 'message' => validation_errors()]));
            return false;
          }
          $table = TABLE_APPLICANT_LOGIN;
          $personaldet_table = APPLICANT_PERSONAL_DET_TABLE;
          
          $table_prefix = '';
          //$columns = 'user_id,user_name,display_name,createdat_fwpwdotp,email';
          $columns = $table.'.applicant_login_id,applicant_pwd,'.$table.'.mobile_no,mob_country_code_id,appln_no,'.$personaldet_table.'.first_name,'.$personaldet_table.'.email_id,'.$personaldet_table.'.is_international';

          $joins = array(
               array(
                    'table' => $personaldet_table,
                    'condition' => $personaldet_table.'.applicant_login_id = '.$table.'.applicant_login_id AND '.$table.".active='true'" . ' AND '.$personaldet_table.".active='true'",
                    'jointype' => 'INNER'
               )
          );

          $is_international = $this->input->post('is_international',true);
          $is_international=($is_international)?$is_international:'';
          $cond[$table.'.email_id'] = $data['email'];
          $cond[$table.'.active'] = true;
          if($is_international)
          {
               $cond[$personaldet_table.'.is_international'] = true;
          }else { $cond[$personaldet_table.'.is_international'] = false; }
          $params = array();
          $params['table'] = $table;
          $params['table_prefix'] = $table_prefix;
          $params['table_schema'] = $table_schema;
          $params['pk'] = $table_prefix.'applicant_login_id';
          $params['returnresponse']=TRUE;
          $params['cond'] = $cond;
          $params['columns'] = $columns;
          $params['joins'] = $joins;    
          $user_count = $this->_select_table($params);
         
        
          
          if(!empty($user_count['data']))
          {
               $rand_pwd = $this->rand_string(6);
               $password = password_hash($rand_pwd,PASSWORD_DEFAULT);
               $subject = FORGOT_PWD_SUBJECT;
               //$message =FORGOT_PWD_MESSAGE . $rand_pwd;
               $selectedTime  = date("Y-m-d H:i:s");
               $endTime       = strtotime("+". OTP_RESET_TIME. "minutes", strtotime($selectedTime)); 
               $otpendTime  = date('h:i A', $endTime);
               $this->data['otpendTime']  = $otpendTime;
               $this->data['user_name']   = $user_count['data'][0]['first_name'];
               $this->data['otp']   = $rand_pwd;
               $message = $this->load->view('email_templates/forgotpwd_notify',$this->data,true);
               $to =$user_count['data'][0]['email_id'];
               //$to =     FORGOT_PWD_TO;
               $from=FORGOT_PWD_FROM;
               $send_mail = $this->common_send_mail($subject,$message,$from,$to);
               if($send_mail)
               {
                 
                    $passwd=password_hash($rand_pwd, PASSWORD_DEFAULT);
                    $applicant_log = APPLICANT_LOG_TABLE;
                    $user_id = $user_count['data'][0]['applicant_login_id'];
                    $where['applicant_login_id'] = $user_id;
                    $put_array['otp'] = $password;

                    //$put_array['otp_exp_sec'] = $selectedTime;
                    $update = $this->common->common_update ( $applicant_log , $table_prefix , $put_array, $where);
                    if($update)
                    {
                         $this->output->set_output(json_encode(['status' => 'true', 'message' => UPDATE_SUCCESS_MSG_FORGOT_PWD]));
                    }
                    else
                    {
                         $this->output->set_output(json_encode(['status' => 'true', 'message' => ERROR_MSG]));
                    }
               }
               else {
                         $this->output->set_output(json_encode(['status' => 'error', 'message' => MAIL_COULD_NOT_SEND]));         
                    }
          }
          else
          {
               $this->output->set_output(json_encode(['status' => 'error', 'message' => FORGOT_PWD_INVALID_EMAIL]));
            return false;
          }         
     }


    /**
     * get otp forgot password
     *
     * @param otp
     * @return otp in mail send or not in return json response
     * @author
     */

    public function otpverifyforgotpwd_post()
     {   
          $user_data = $this->post ();
          // Table List & Prefix
          $table = APPLICANT_LOG_TABLE;
          $table_schema = SCHEMA_ADMISSION;
          $this->form_validation->set_data($user_data);
          $this->form_validation->set_rules('otp', 'OTP','trim|required|xss_clean');
          //Run Validations
          if ($this->form_validation->run() == FALSE) {
                $this->output->set_output(json_encode(['status' => 'error', 'message' => validation_errors()]));
            return false;
          }
          $table_prefix = '';
          //$columns = 'user_id,user_name,createdat_fwpwdotp,otp_fwpwd';
          $columns = 'applicant_login_id,last_visited_at,no_of_attempts,verification_link,otp';
          $function_name = $this->get_function_name(__FUNCTION__);
          $cond = array('otp IS NOT NULL');
          $params = array();
          $params['table'] = $table;
          $params['table_schema'] = $table_schema;
          $params['function_name'] = $function_name;
          $params['page'] = $page;
          $params['limit'] = $limit;
          $params['columns'] = $columns;
          $params['returnresponse']=TRUE;
          $params['cond'] = $cond;  
          $result = $this->_select_table($params);
          $verify_status=false;          
          for($i=0; $i<count($result['data']);$i++)
          {
               $otp_verify = $result['data'][$i]['otp'];               
               if(password_verify($user_data['otp'],$otp_verify)){
                    //$otp_time_verify = $this->Otptimeverify($result['data'][$i]['createdat_fwpwdotp']);
                    $verify_status .= true;
                    $this->output->set_output(json_encode(['status' => 'success', 'message' => $user_data['otp']]));
               }
          }
          if($verify_status ==  false)
          {
               $this->output->set_output(json_encode(['status' => 'error', 'message' => INVALID_OTP]));
          }
     }


      /**
     * Update Password Regatd Otp
     *
     * @param otp
     * @return otp in mail send or not in return json response
     * @author
     */
public function updatepwdotp_post()
{
          $user_data = $this->post ();
          // Table List & Prefix
          $table = APPLICANT_LOG_TABLE;
          $personaldet_table = APPLICANT_PERSONAL_DET_TABLE;
          $table_schema = SCHEMA_ADMISSION;
          $this->form_validation->set_data($user_data);
          $this->form_validation->set_rules('otp', 'OTP','trim|required|xss_clean');
          $this->form_validation->set_rules('new_pwd', 'New Password', 'trim|required|max_length['.PASSWORD_MAX_LENGTH.']');
          $this->form_validation->set_rules('confirm_pwd', 'Confirm Password' , 'trim|required|matches[new_pwd]');
          //Run Validations
          if ($this->form_validation->run() == FALSE) {
                $this->output->set_output(json_encode(['status' => 'error', 'message' => validation_errors()]));
            return false;
          }
          $table_prefix = '';
          //$columns = 'user_id,user_name,createdat_fwpwdotp,otp_fwpwd,passwd,email';
          $columns = $table.'.applicant_login_id,last_visited_at,no_of_attempts,verification_link,otp,first_name,email_id';
          $function_name = $this->get_function_name(__FUNCTION__);

          $joins = array(
               array(
                    'table' => $personaldet_table,
                    'condition' => $personaldet_table.'.applicant_login_id = '.$table.'.applicant_login_id AND '.$table.".active='true'" . ' AND '.$personaldet_table.".active='true'",
                    'jointype' => 'INNER'
               )
          );

          $cond = array('otp IS NOT NULL');
          $params = array();
          $params['table'] = $table;
          $params['table_schema'] = $table_schema;
          $params['function_name'] = $function_name;
          $params['page'] = $page;
          $params['limit'] = $limit;
          $params['columns'] = $columns;
          $params['returnresponse']=TRUE;
          $params['cond'] = $cond; 
          $params['joins']=$joins; 
          $result = $this->_select_table($params);
          $verify_status=false;
          for($i=0; $i<count($result['data']);$i++)
          {
               $otp_verify = $result['data'][$i]['otp'];
               if(password_verify($user_data['otp'],$otp_verify)){ /*Verify Otp*/     
                    //$otp_time_verify = $this->Otptimeverify($result['data'][$i]['createdat_fwpwdotp']);
                    $verify_status = true;
                    $user_id            =    $result['data'][$i]['applicant_login_id'];
                    $new_pwd            =   trim(strip_tags($this->input->post('new_pwd')));
                    $encrypt_pwd        =   password_hash($new_pwd, PASSWORD_DEFAULT);
                    /*Check New Password Exist With Old Password*/
                    if(password_verify($new_pwd, $result['data'][$i]['applicant_pwd']) === true) {
                         return $this->response_message('error',PASSWORD_EXIST);
                     }/*Check New Password Exist With Old Password*/

                    $where = array();

                    
                    $where['applicant_login_id'] = $user_id;
                    $data['otp'] = NULL;
                    $data['table_schema']=$table_schema;
                    $update_otp = $this->common->common_update($table,'' , $data , $where);
                    $table_login = TABLE_APPLICANT_LOGIN;
                    $where['applicant_login_id'] = $user_id;
                    $datalogin['applicant_pwd'] = $encrypt_pwd;
                    $datalogin['table_schema']=$table_schema;
                    //$data['applicant_pwd'] =NULL;
                    //$data['createdat_fwpwdotp'] =NULL;
                    $update = $this->common->common_update($table_login,'' , $datalogin , $where);
                    if ($update)
                    {
                         $subject = CHANGE_PWD_NOTIFY_SUBJECT;
                         $this->data['user_name'] = $result['data'][$i]['first_name'];
                         $this->data['email'] = $result['data'][$i]['email_id'];
                         $this->data['pwd'] = $new_pwd;
                         $message = $this->load->view('email_templates/passwordupdatesuccess_notify',$this->data,true);
                         $from = FORGOT_PWD_FROM; 
                         //$to =FORGOT_PWD_TO;
                         $to =$result['data'][$i]['email_id'];
                         $this->common_send_mail($subject,$message,$from,$to);
                         // Success 200 Code Send
                         return $this->response_message('success',PWD_UPDATE_OTP);
                    } else
                    {
                         return $this->response_message('error',ERROR_MSG);
                    }
               } /*Verify Otp End*/
          }
          if($verify_status ==  false)
          {
               $this->output->set_output(json_encode(['status' => 'error', 'message' => INVALID_OTP]));
          }
 }


     /**
     * check verify link
     *
     * @param verify link
     * @return verify link in mail send or not in return json response
     * @author
     */

     public function check_verifylink_post()
     {   
          $user_data = $this->post ();
          // Table List & Prefix
          $table = APPLICANT_LOG_TABLE;
          $table_schema = SCHEMA_ADMISSION;
          $verify_text = $this->input->post('verify_text');
          $user_id = $this->input->post('user_id');
          $table_prefix = 'user';
          $columns = 'applicant_login_id,last_visited_at,no_of_attempts,verification_link';
          $function_name = $this->get_function_name(__FUNCTION__);
          $cond = array('verification_link IS NOT NULL');
          $cond['applicant_login_id'] = $user_id;
          $params = array();
          $params['table'] = $table;
          $params['table_schema'] = $table_schema;
          $params['function_name'] = $function_name;
          $params['page'] = $page;
          $params['limit'] = $limit;
          $params['columns'] = $columns;
          $params['returnresponse']=TRUE;
          $params['return_type']='single';
          $params['cond'] = $cond;  
          $result = $this->_select_table($params);          
          $verify_status=false;
          $hash_verify_link = $result['data']['verification_link'];
          if(($verify_text === $hash_verify_link)){               
               $this->update_verfication_link($table,$table_schema,$user_id);
               // $verify_link_time = $this->verify_link_time($result['data']['createdat_verify_link']);               
               $verify_status .= true;
               $this->output->set_output(json_encode(['status' => 'success', 'message' => VERIFY_SUCCESS]));
          }
          if($verify_status ==  false)
          {
               $this->output->set_output(json_encode(['status' => 'error', 'message' => INVALID_VERIFY_TEXT]));
          }
    }

    public function update_verfication_link($table,$table_schema,$user_id)
    {
     $where = array();
     $where['applicant_login_id'] = $user_id;
     $data['verification_link'] =NULL;
     $update = $this->common->common_update($table,'' , $data , $where);
    }

     public function applicant_status_list_post($page = false, $limit = false, $id = false)
    {
          $applicant_personal_id = $this->input->post('applicant_personal_det_id');
          $fn_get_app_status = FN_GET_APPLICANT_APPLICATION_STATUS;
          $table_schema = SCHEMA_ADMISSION;
          // Set Columns
          $columns = $table.'.appln_form_name as appln_form_name, '.$table.'.value_short_name as value_short_name, '.$table.'.completion_percent as completion_percent , '.$table.'.appln_form_fee as appln_form_fee ,'.$table.'.application_status ,' .$table.'.appln_form_id as appln_form_id';
          $where = array();
          $is_international = $this->input->post('is_international');
          if($is_international)
          {
               $where['appln_form_id'] = 'IN ('.APP_FORM_ID_INTERNATIONAL.')';
          }
          else
          {
               $where['appln_form_id'] = 'NOT IN ('.APP_FORM_ID_INTERNATIONAL.')';
          }
          $arguments=array($applicant_personal_id);      
          $result = $this->db_func_call($table_schema, $fn_get_app_status, $arguments,$columns,false,false,false,$where);
        
    }		
}