<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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


class Login extends API_Controller {

	public function __construct()
	{		
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('Auth_Ldap');
	}

	/**
     *
     * @SWG\Api(
     *   path="login",
     *   description="post",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="POST",
     *       summary="login",
     *       notes="Returns a json",
     *       nickname="login",
     *       @SWG\Parameters(
     *         @SWG\Parameter(
     *           name="email",
     *           description="email",
     *           paramType="form",
     *           required=true,
     *           type="string"
     *         ),
     *         @SWG\Parameter(
     *           name="password",
     *           description="password",
     *           paramType="form",
     *           required=true,
     *           type="password"
     *         ),
     *        
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
	 *     path="/api/login",
	 *     tags={"login"},
	 *     summary="user login",
     *     operationId="stream",
	 *     @OA\RequestBody(
	 *         @OA\MediaType(
	 *             mediaType="application/x-www-form-urlencoded",
	 *             @OA\Schema(
	 *                 @OA\Property(
	 *                     property="email",
	 *                     type="string"
	 *                 ),
	 *                 @OA\Property(
	 *                     property="password",
	 *                     type="string"
	 *                 ),
	 *                 example={"email": "geetha@gmail.com", "password": "*******", "role_id": "1"}
	 *             )
	 *         )
	 *     ),
	 *     @OA\Response(
	 *         response=200,
	 *         description="OK"
	 *     )
	 * )
	 */

	public function login_post()
	{
		$user_data = $this->post ();
		$verify_link = $this->input->post('verify_link');
		// Set validations
		$this->form_validation->set_data($user_data);		
		$this->form_validation->set_rules('email', 'email','trim|required');
		$this->form_validation->set_rules('role_id', 'role_id','trim');

		if(!empty($this->input->post('verify_link'))) {
   				$this->form_validation->set_rules('password', 'password','trim');
			} else {
	   		$this->form_validation->set_rules('password', 'password','trim|required');
			}

		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>200,'message'=>LOGIN_API_REQ_MSG)));
		}

		$admin_logged = FALSE;

		//LDAP Login
		
		/*$ldap_logged_check  = $this->checkldap_login($user_data['email'],$user_data['password']);
		if(isset($ldap_logged_check['logged_in']) && ($ldap_logged_check['logged_in'] !='' ) )
		{
			$ldap_username = $ldap_logged_check['username'];
			if($ldap_username === LDAP_ADMIN1 || $ldap_username === LDAP_ADMIN2 || 
				$ldap_username === LDAP_ADMIN3 || $ldap_username === LDAP_ADMIN4)
			{
				$admin_logged = TRUE;
				$get_atd = $this->get_accesstoken_details($user_data);	
				$return_get_atd = json_decode($get_atd,true);
				$return_get_atd['status'] = 200;
				$return_get_atd['login_ok'] = 'true';
				$return_get_atd['message'] = SUCCESS_LOGIN;
				$return_get_atd['access_level'] = ACCESS_ADMIN;
				$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
			}
		}*/

		//Check ADMIN		
		/*if(($user_data['email'] == ADMAIL) && ($user_data['password'] == ADPASSWORD))
		{
				$admin_logged = TRUE;
				$get_atd = $this->get_accesstoken_details($user_data);	
				$return_get_atd = json_decode($get_atd,true);
				$return_get_atd['status'] = 200;
				$return_get_atd['login_ok'] = 'true';
				$return_get_atd['message'] = SUCCESS_LOGIN;
				$return_get_atd['access_level'] = ACCESS_ADMIN;
				$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));

		}*/
		//Check ADMIN End
		
		$table_schema = SCHEMA_ADMISSION;
		// Table List & Prefix
		$table = APPLICANT_LOGIN_TABLE;
		$personaldet_table = APPLICANT_PERSONAL_DET_TABLE;
		$table_prefix = '';

		$joins = array(
			array(
				'table' => $personaldet_table,
				'condition' => $personaldet_table.'.applicant_login_id = '.$table.'.applicant_login_id AND '.$table.".active='true'" . ' AND '.$personaldet_table.".active='true'",
				'jointype' => 'INNER'
			)
		);
		// Check Condition
				
		// Table Columns
		//$columns = $urtable.'.user_id,'.$rtable.'.role_name,user_name as username,passwd as password';
		//$columns = 'user_id,user_name as username,passwd as password,email,display_name,phone_no';
		$columns = 'appln_no,applicant_pwd,'.$personaldet_table.'.first_name,'.$personaldet_table.'.applicant_personal_det_id,'.$personaldet_table.'.email_id,'.$personaldet_table.'.mobile_no,'.$table.'.applicant_login_id';
		//$result = $this->User->getRows('users',$stable_prefix,$columns,$user_data);	
		$function_name = $this->get_function_name(__FUNCTION__);
		$params = array();
		$params['table'] = $table;
		$params['table_schema'] = $table_schema;
		$params['function_name'] = $function_name;
		$params['page'] = $page;
		$params['limit'] = $limit;
		$params['columns'] = $columns;
		$params['returnresponse']=TRUE;
		$params['cond'] = array($table.'.email_id' => $user_data['email'] , $personaldet_table.'.is_international' => FALSE);
		//$params['cond'] = array('user_name' => $user_data['username'] , $urtable.'.role_id' => $user_data['role_id']);	
		$params['joins'] = $joins;		

		$result = $this->_select_table($params);
		$verify_pwd = $result['data'][0]['applicant_pwd'];
		$user_id = $result['data'][0]['applicant_login_id'];		
		$check_verify = $this->check_verificationlink($user_id);
		if(!$admin_logged) //admin logged check
		{
			if($check_verify === 1) //check verification
			{
					if((isset($result['data'])) && !empty($result['data'])) 
					{				
						if(password_verify($user_data['password'],$verify_pwd)){
							$get_atd = $this->get_accesstoken_details($result);	
							$return_get_atd = json_decode($get_atd,true);
							$return_get_atd['status'] = 200;
							$return_get_atd['login_ok'] = 'true';
							$return_get_atd['message'] = SUCCESS_LOGIN;
							$return_get_atd['access_level'] = STUDENT_ACCESS;
							$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
						}
						else
						{
							$return_get_atd['status'] = 200;
							$return_get_atd['login_ok'] = 'false';
							$return_get_atd['message'] = LOGIN_API_FAILED_MSG;
							$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
						}
					}
					else
					{
						$return_get_atd['status'] = 200;
						$return_get_atd['login_ok'] = 'false';
						$return_get_atd['message'] = LOGIN_API_FAILED_MSG;
						$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
					}
				

			}
			else
			{
				$return_get_atd['status'] = 200;
				$return_get_atd['login_ok'] = 'false';
				$return_get_atd['message'] = VERIFY_ERR;
				$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
			}
		}
		//}
	}

	public function check_verificationlink($user_id)
     {   
          $user_data = $this->post ();
          // Table List & Prefix
          $table = APPLICANT_LOG_TABLE;
          $table_schema = SCHEMA_ADMISSION;
         // $verify_text = $this->input->post('verify_text');
          //$user_id = $user_id;
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
          if($result['data'])
          {
          	return 0;
          }
          else
          {
          	return 1;
          }
    }

	public function checkldap_login($username,$password)
    {
    	$auth_login = $this->auth_ldap->login($username,$password);
    	$auth_logged = json_decode($auth_login,true);
    	return $auth_logged;
    }
	
	public function loginold_post()
	{
		$user_data = $this->post ();
		// Set validations
		$this->form_validation->set_data($user_data);		
		$this->form_validation->set_rules('email', 'email','trim|required');
		$this->form_validation->set_rules('password', 'password','trim|required');
		$this->form_validation->set_rules('role_id', 'role_id','trim');

		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>200,'message'=>LOGIN_API_REQ_MSG)));
		}
		
		/*Check Ldap Authentication Start*/
		$auth_login = $this->auth_ldap->login($user_data['email'],$user_data['password']);
		$auth_logged = json_decode($auth_login,true);
		$table_schema = SCHEMA_PHP_DEV;
		if( (isset($auth_logged['logged_in'])) && ($auth_logged['logged_in'] === TRUE ) )
		{
			// Table List & Prefix
			$table = USER;
			$urtable = USER_ROLE;
			$rtable = ROLES;
			$table_prefix = '';
			$joins = array(
				/*array(
					'table' => $urtable,
					'condition' => $urtable.'.user_id = '.$table.'.user_id AND ' . $urtable.'.role_id = ' . $user_data['role_id'] . ' AND ' .$table.".active='true'" . ' AND '.$urtable.".active='true'",
					'jointype' => 'INNER'
				),*/
				array(
					'table' => $urtable,
					'condition' => $urtable.'.user_id = '.$table.'.user_id AND ' .$table.".active='true'" . ' AND '.$urtable.".active='true'",
					'jointype' => 'INNER'
				),

				array(
					'table' => $rtable,
					'condition' => $rtable.'.role_id = '.$urtable.'.role_id AND '.$rtable.".active='true'",
					'jointype' => 'INNER'
				),
			);
			// Check Condition
				
			// Table Columns
			//$columns = $urtable.'.user_id,'.$rtable.'.role_name,user_name as username,email';
			$columns = 'user_id,user_name as username,passwd as password,email,display_name,phone_no';
			// GET & Match Row
			//$result = $this->User->getRows('users',$stable_prefix,$columns,$user_data);	
			$function_name = $this->get_function_name(__FUNCTION__);
			$params = array();
			$params['table'] = $table;
			$params['table_schema'] = $table_schema;
			$params['function_name'] = $function_name;
			$params['page'] = $page;
			$params['limit'] = $limit;
			$params['columns'] = $columns;
			$params['returnresponse']=TRUE;
			$params['cond'] = array('email' => $user_data['email']);	
			//$params['cond'] = array('user_name' => $user_data['username'] , $urtable.'.role_id' => $user_data['role_id']);	
			//$params['joins'] = $joins;		

			$result = $this->_select_table($params);

			if((isset($result['data'])) && !empty($result['data']))
			{
				$get_atd = $this->get_accesstoken_details($result);	
				$return_get_atd = json_decode($get_atd,true);
				$return_get_atd['status'] = 200;
				$return_get_atd['login_ok'] = 'true';
				$return_get_atd['message'] = SUCCESS_LOGIN;
				$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
			}
			else
			{
				$return_get_atd['status'] = 200;
				$return_get_atd['login_ok'] = 'false';
				$return_get_atd['message'] = LOGIN_API_FAILED_MSG;
				$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
			}
		} /*Check Ldap Authentication End*/
		else
		{
			// Table List & Prefix
			$table = USER;
			$urtable = USER_ROLE;
			$rtable = ROLES;
			$table_prefix = '';

			$joins = array(
				array(
					'table' => $urtable,
					'condition' => $urtable.'.user_id = '.$table.'.user_id AND '.$table.".active='true'" . ' AND '.$urtable.".active='true'",
					'jointype' => 'INNER'
				),
				array(
					'table' => $rtable,
					'condition' => $rtable.'.role_id = '.$urtable.'.role_id AND '.$rtable.".active='true'",
					'jointype' => 'INNER'
				),
			);
			// Check Condition
				
			// Table Columns
			//$columns = $urtable.'.user_id,'.$rtable.'.role_name,user_name as username,passwd as password';
			$columns = 'user_id,user_name as username,passwd as password,email,display_name,phone_no';
			// GET & Match Row
			//$result = $this->User->getRows('users',$stable_prefix,$columns,$user_data);	
			$function_name = $this->get_function_name(__FUNCTION__);
			$params = array();
			$params['table'] = $table;
			$params['table_schema'] = $table_schema;
			$params['function_name'] = $function_name;
			$params['page'] = $page;
			$params['limit'] = $limit;
			$params['columns'] = $columns;
			$params['returnresponse']=TRUE;
			$params['cond'] = array('email' => $user_data['email']);	
			//$params['cond'] = array('user_name' => $user_data['username'] , $urtable.'.role_id' => $user_data['role_id']);	
			//$params['joins'] = $joins;		

			$result = $this->_select_table($params);
			$verify_pwd = $result['data'][0]['password'];
			if((isset($result['data'])) && !empty($result['data'])) 
			{				
				if(password_verify($user_data['password'],$verify_pwd)){
					$get_atd = $this->get_accesstoken_details($result);	
					$return_get_atd = json_decode($get_atd,true);
					$return_get_atd['status'] = 200;
					$return_get_atd['login_ok'] = 'true';
					$return_get_atd['message'] = SUCCESS_LOGIN;
					$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
				}

				else
				{
					$return_get_atd['status'] = 200;
					$return_get_atd['login_ok'] = 'false';
					$return_get_atd['message'] = LOGIN_API_FAILED_MSG;
					$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
				}

			}
			else
			{
				$return_get_atd['status'] = 200;
				$return_get_atd['login_ok'] = 'false';
				$return_get_atd['message'] = LOGIN_API_FAILED_MSG;
				$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
			}
		}
	}

}
