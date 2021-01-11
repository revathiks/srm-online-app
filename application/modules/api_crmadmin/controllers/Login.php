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
		$this->load->library('auth_ldap');
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
     *           name="username",
     *           description="username",
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
	 *     path="/api_crmadmin/login",
	 *     tags={"login"},
	 *     summary="user login",
     *     operationId="stream",
	 *     @OA\RequestBody(
	 *         @OA\MediaType(
	 *             mediaType="application/x-www-form-urlencoded",
	 *             @OA\Schema(
	 *                 @OA\Property(
	 *                     property="username",
	 *                     type="string"
	 *                 ),
	 *                 @OA\Property(
	 *                     property="password",
	 *                     type="string"
	 *                 ),
	 *                 example={"username": "geethasj", "password": "*******"}
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
		// Set validations
		$this->form_validation->set_data($user_data);		
		$this->form_validation->set_rules('username', 'username','trim|required');
		$this->form_validation->set_rules('password', 'password','trim|required');
		//$this->form_validation->set_rules('role_id', 'role_id','trim');

		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>200,'message'=>LOGIN_API_REQ_MSG)));
		}

		$role_id = $user_data['role_id'];
		if($role_id == CRM_ADMIN_USER_ROLE_ID) // Check Admin Or NOT Start
		{
			/*Check Ldap Authentication Start*/
			$auth_login = $this->auth_ldap->login($user_data['username'],$user_data['password']);
			$auth_logged = json_decode($auth_login,true);
			$table_schema = SCHEMA_PHP_DEV;
			if( (isset($auth_logged['logged_in'])) && ($auth_logged['logged_in'] === TRUE ) )
			{
				$auth_logged['role_id'] = CRM_ADMIN_USER_ROLE_ID;
				$get_atd = $this->get_accesstoken_details($auth_logged);				
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
		
			/*Check Ldap Authentication End*/
		} // Check Admin Or NOT End
		else
		{			
			if(($user_data['username'] == COUNSELLOR_LOGIN_USERNAME) && ($user_data['password'] == COUNSELLOR_LOGIN_PWD))
			{
				$get_atd = $this->get_accesstoken_details($user_data);
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
				$return_get_atd['message'] = ADMIN_LOGIN_API_FAILED_MSG;
				$this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
			}
		}
		
		
		
	}

}
