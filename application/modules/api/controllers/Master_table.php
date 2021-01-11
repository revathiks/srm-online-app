<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Swagger\Annotations as SWG;

/**
 * @package SRM - Online Application
 * @category Master table API
 * @subpackage Master table
 *
 * @SWG\Resource(
 *  apiVersion="0.1",
 *  swaggerVersion="1.2",
 *  resourcePath="/api",
 *  produces="['application/json']"
 * )
 *
 */
/**
* @OA\Info(
*     title="SRM - Online Application", 
*     description="SRM - Online Application",
*     version="1.0.0",
*     termsOfService="http://srmtech.com/terms/",
*     @OA\Contact(
*         email="apiteam@srmtech.com"
*     ),
*     @OA\License(
*         name="Apache 2.0",
*         url="http://srmtech.com"
*     )
* )
* @OA\Server(
*     description="SRM - Online Application host",
*     url="http://localhost/SRM-Online-Application-New/"
* )
*/

/**
 *    @OA\SecurityScheme(
 *      securityScheme="ApiKeyAuth",
 *      type="apiKey",
 *      in="header",
 *      name="X-API-KEY"
 *    )
 *    @OA\SecurityScheme(
 *      securityScheme="AuthHeader",
 *      type="apiKey",
 *      in="header",
 *      name="Authorization"
 *    )
 */
/**
 * @OA\OpenApi(
 *   security={{"ApiKeyAuth":{},"AuthHeader":{}}}
 * )
 */
class Master_table extends API_Controller {

	public function __construct()
	{		
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->helper('common');
	}

    /**
     *
     * @SWG\Api(
     *   path="stream",
     *   description="get",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="get stream",
     *       notes="Returns a json",
     *       nickname="stream",
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
     *            message="Please pass the stream id to get stream detail."
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
     *     path="/api/stream/{id}",
     *     tags={"stream"},
     *     summary="get stream",
     *     description="get stream",
     *     operationId="stream",
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
     * get stream by id
     *
     * @param stream $id employee id
     * @return json response of stream detail by id
     * @author
     */
    public function stream_get ($id = false)
    {
        if ( $id ) {
            $this->streams_get ( false , false , $id );
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
     *   path="streams/{page}/{limit}",
     *   description="get",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="get streams list",
     *       notes="Returns a json",
     *       nickname="streams",
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
     *   path="/api/streams/{page}/{limit}",
     *   tags={"stream"},
     *   operationId="get streams list",
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
     * get stream list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the stream list
     * @param string $id stream id
     * @return json response of stream list by page & limit
     * @author
     */
    public function streams_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
		// Set Schema
        $table_schema = SCHEMA_MASTER;
		// Set Table
        $table = STREAM;
		// Set Columns
        $columns = 'stream_id as id,stream_name as name';

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
		$params['pk'] = 'stream_id';
        $params['id_col'] = 'stream_id';		
       /* $params['cond'] = $cond;*/
		// Call Select Method
        $this->_select_table($params);
    }

    /**
     *
     * @SWG\Api(
     *   path="application_form",
     *   description="get",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="get application form",
     *       notes="Returns a json",
     *       nickname="application form",
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
     *            message="Please pass the application form id to get application form detail."
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
     *     path="/api/application_form/{id}",
     *     tags={"application form"},
     *     summary="get application form",
     *     description="get application form",
     *     operationId="application form",
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
     * get program application form by id
     *
     * @param application form $id employee id
     * @return json response of application form detail by id
     * @author
     */
    public function application_form_get ($id = false)
    {
        if ( $id ) {
            $this->applications_forms_get ( false , false , $id );
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
     *   path="application_forms/{page}/{limit}",
     *   description="get",
     *   @SWG\Operations(
     *     @SWG\Operation(
     *       method="GET",
     *       summary="get application forms list",
     *       notes="Returns a json",
     *       nickname="application forms",
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
     ** @OA\Get(path="/api/application_forms/{page}/{limit}",
     *     tags={"application form"},
     *   operationId="get application forms list",
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
     * get application form list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the application form list
     * @param string $id application form id
     * @return json response of application form list by page & limit
     * @author
     */
    public function applications_forms_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = APPLICATION_FORM;
        // Set Columns
        $columns = 'appln_form_id,appln_form_name';

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
        $params['pk'] = 'appln_form_id';
        $params['id_col'] = 'appln_form_name';        
		/* $params['cond'] = $cond;*/
        // Call Select Method
        $this->_select_table($params);
    }
	
	/**
     * @OA\Get(
     *     path="/api/state/{id}",
     *     tags={"states"},
     *     summary="get state",
     *     description="get state",
     *     operationId="state",
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
     * get state by id
     *
     * @param state $id employee id
     * @return json response of state by id
     * @author
    */
    public function state_get ($id = false)
    {
        if ( $id ) {
            $this->states_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }	

    /**
     * @OA\Get(
     *     path="/api/mobile_code/{id}",
     *     tags={"mobile code"},
     *     summary="get mobile code",
     *     description="get mobile code",
     *     operationId="mobile_code",
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
     * get mobile code by id
     *
     * @param mobile code $id mobile code id
     * @return json response of mobile code detail by id
     * @author
     */
    public function mobile_code_get ($id = false)
    {
        if ( $id ) {
            $this->mobile_codes_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/mobile_codes/{page}/{limit}",
     *   tags={"mobile code"},
     *   operationId="get mobile_codes list",
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
     * get mobile codes list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the mobile codes list
     * @param string $id mobile code id
     * @return json response of mobile codes list by page & limit
     * @author
     */
    public function mobile_codes_get ($page = false , $limit = false , $id = false)
    {
        $user_login = $this->input->get('user_login');

        if(!$user_login) {
            // Check Authorization Token
            $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        }
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = COUNTRY;
        // Set Columns
        $columns = "country_id as id,CONCAT(country_name,' [',country_mob_code,']') as name,country_mob_code as code";

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
        $params['pk'] = 'country_id';
        $params['id_col'] = 'country_id';
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        if($user_login) {
            $params['action'] = 'login';    
        }
        // Call Select Method
        $this->_select_table($params);
    }

    /**
     ** @OA\Get(path="/api/states/{page}/{limit}",
     *     tags={"states"},
     *   operationId="get states list",
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
     * get states list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the states list
     * @param string $id states id
     * @return json response of states list by page & limit
     * @author
    */	
	public function states_get ($page = false , $limit = false , $id = false)
    {
        $user_login = $this->input->get('user_login');
        $for_register = $this->input->get('for_register');
        $country_id = $this->input->get('country_id');

        if(!$user_login) {
            // Check Authorization Token
            $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        }
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = MASTER_STATE;

        if($for_register) {
            // Set Columns
            $columns = 'state_id as id,state_name as name,country_id';
        } else {
            // Set Columns
            $columns = 'state_id as id,state_name as name,country_id';    
        }
        

        $function_name = $this->get_function_name(__FUNCTION__);
        // Parameter By Array
        $params = array();
        $params['table'] = $table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        $cond = array();
        if(isset($id) && $id != '')
        {
            $cond['state_id'] = $id;	
        }
        if(isset($country_id) && $country_id != '')
        {
            $cond['country_id'] = $country_id; 
        }
        $params['cond'] = $cond;
        $params['pk'] = 'state_id';
        $params['id_col'] = 'state_name';        
		/* $params['cond'] = $cond;*/
        // Call Select Method
        $this->_select_table($params);
    }
	
	/**
     * @OA\Get(
     *     path="/api/city/{id}",
     *     tags={"city"},
     *     summary="get city",
     *     description="get city",
     *     operationId="city",
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
     * get state by id
     *
     * @param state $id employee id
     * @return json response of state by id
     * @author
    */
    public function city_get ($id = false)
    {
        if ( $id ) {
            $this->cities_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }		

	/**
     ** @OA\Get(path="/api/cities/{page}/{limit}",
     *     tags={"city"},
     *   operationId="get cities list",
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
     * get cities list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the cities list
     * @param string $id cities id
     * @return json response of cities list by page & limit
     * @author
    */	
	public function cities_get ($page = false , $limit = false , $id = false)
    {
        $user_login = $this->input->get('user_login');
        $for_register = $this->input->get('for_register');
        $state_id = $this->input->get('state_id');
        $exclude_city_ids = $this->input->get('exclude_city_ids');

        if(!$user_login) {
            // Check Authorization Token
            $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        }
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = MASTER_CITY;

        if($for_register) {
            // Set Columns
            $columns = 'city_id as id,city_name as name,state_id';
        } else {
            // Set Columns
            $columns = 'city_id as id,city_name as name,state_id';
        }

        $function_name = $this->get_function_name(__FUNCTION__);
        // Parameter By Array
        $params = array();
        $params['table'] = $table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        $cond = array();
        if(isset($id) && $id != '')
        {
            $cond['city_id'] = $id;    
        }
        if(isset($state_id) && $state_id != '')
        {
            $cond['state_id'] = $state_id; 
        }
        // echo 'exclude_city_ids => '.$exclude_city_ids."\n";
        if($exclude_city_ids != '') {
            $arr_exclude_city_ids = explode(',', $exclude_city_ids);
            $arr_exclude_city_ids = array_filter($arr_exclude_city_ids);
            $cond['where_not_in'][$table.'.city_id'] = $arr_exclude_city_ids;
        }
        $params['cond'] = $cond;
        $params['pk'] = 'city_id';
        $params['id_col'] = 'city_name';        
		/* $params['cond'] = $cond;*/
        // Call Select Method
        $this->_select_table($params);
    }

    /**
     * @OA\Get(
     *     path="/api/degree/{id}",
     *     tags={"degree"},
     *     summary="get degree",
     *     description="get degree",
     *     operationId="degree",
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
     * get degree by id
     *
     * @param degree $id degree id
     * @return json response of degree by id
     * @author
    */
    public function degree_get ($id = false)
    {
        if ( $id ) {
            $this->degrees_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }       

    /**
     ** @OA\Get(path="/api/degrees/{page}/{limit}",
     *     tags={"degree"},
     *   operationId="get degrees list",
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
     * get degree list based on the stream selection
     *
     * @param integer $page page number
     * @param integer $limit limit to show the degree list
     * @param string $id cities id
     * @return json response of degree list by page & limit
     * @author
    */  
    public function degrees_get ($page = false , $limit = false , $id = false)
    {
        $user_login = $this->input->get('user_login');
        $for_register = $this->input->get('for_register');
        $stream_id = $this->input->get('stream_id');

        if(!$user_login) {
            // Check Authorization Token
            //$user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        }
        // Set Schema
        $table_schema_master = SCHEMA_MASTER;
        // Set Table
        $appln_form_w_program_table = APPLN_FORM_W_PROGRAM_TABLE;
        $application_form_table = APPLICATION_FORM;
        $stream_table = STREAM;

        // Set Schema
        $table_schema = SCHEMA_ACADEMICS;
        // Set Table
        $table = DEGREE_TABLE;
        $program_table = PROGRAM_TABLE;
        

        if($for_register) {
            // Set Columns
            //$columns = $table.'.deg_id as id, '.$table.'.deg_name as name,'.$stream_table.'.stream_id';
            $columns = $table.'.deg_id as id, '.$table.'.deg_name as name';
        } else {
            // Set Columns
            //$columns = $table.'.deg_id,'.$table.'.deg_name,'.$stream_table.'.stream_id';
            $columns = $table.'.deg_id as id, '.$table.'.deg_name as name';
        }

        $function_name = $this->get_function_name(__FUNCTION__);
        // Parameter By Array
        $params = array();
        $params['table'] = $table_schema.'.'.$table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        $cond = array();
        if(isset($id) && $id != '')
        {
            $cond['deg_id'] = $id;    
        }
        if(isset($stream_id) && $stream_id != '')
        {
            //$cond['stream_id'] = $stream_id; 
        }
        $params['cond'] = $cond;
        $params['pk'] = 'deg_id';
        $params['id_col'] = 'deg_name';
        $joins = array(
            array(
                'table' => $table_schema.'.'.$program_table,
                'condition' => $table_schema.'.'.$program_table.'.deg_id = '.$table_schema.'.'.$table.'.deg_id AND '.$table_schema.'.'.$program_table.".active = 't'",
                'jointype' => 'INNER'
            ),
            array(
                'table' => $table_schema_master.'.'.$appln_form_w_program_table,
                'condition' => $table_schema_master.'.'.$appln_form_w_program_table.'.prog_id = '.$table_schema.'.'.$program_table.'.prog_id AND '.$table_schema_master.'.'.$appln_form_w_program_table.".active = 't'",
                'jointype' => 'INNER'
            ),
            array(
                'table' => $table_schema_master.'.'.$application_form_table,
                'condition' => $table_schema_master.'.'.$application_form_table.'.appln_form_id = '.$table_schema_master.'.'.$appln_form_w_program_table.'.appln_form_id AND '.$table_schema_master.'.'.$application_form_table.".active = 't'",
                'jointype' => 'INNER'
            ),
            array(
                'table' => $table_schema_master.'.'.$stream_table,
                'condition' => $table_schema_master.'.'.$stream_table.'.stream_id = '.$table_schema_master.'.'.$appln_form_w_program_table.'.stream_id AND '.$table_schema_master.'.'.$stream_table.".active = 't'",
                'jointype' => 'INNER'
            ),
        );
        //$params['joins'] = $joins; For Geetha Load all Degree
        if($for_register) {
            $params['distinct'] = $columns;    
        }

        /* $params['cond'] = $cond;*/
        // Call Select Method
        $this->_select_table($params);
    }

    /**
     * @OA\Get(
     *     path="/api/nationality/{id}",
     *     tags={"nationality"},
     *     summary="get nationality",
     *     description="get nationality",
     *     operationId="nationality",
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
     * get nationality by id
     *
     * @param nationality $id nationality id
     * @return json response of nationality detail by id
     * @author
     */
    public function nationality_get ($id = false)
    {
        if ( $id ) {
            $this->nationalities_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/nationalities/{page}/{limit}",
     *   tags={"nationality"},
     *   operationId="get nationalities list",
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
     * get nationalities list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the nationalities list
     * @param string $id nationality id
     * @return json response of nationalities list by page & limit
     * @author
     */
    public function nationalities_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = COUNTRY;
        // Set Columns
        $columns = "country_id as id,nationality as name";

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
        $params['pk'] = 'country_id';
        $params['id_col'] = 'country_id';
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }

    /**
     * @OA\Get(
     *     path="/api/course/{id}",
     *     tags={"course"},
     *     summary="get course",
     *     description="get course",
     *     operationId="course",
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
     * get course by id
     *
     * @param course $id course id
     * @return json response of course detail by id
     * @author
     */
    public function course_get ($id = false)
    {
        if ( $id ) {
            $this->courses_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/courses/{page}/{limit}",
     *   tags={"course"},
     *   operationId="get courses list",
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
     * get courses list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the courses list
     * @param string $id course id
     * @return json response of courses list by page & limit
     * @author
     */
    public function courses_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_ACADEMICS;
        // Set Table
        // $table = COURSE_TABLE;
        $table = SPECIALIZATION_TABLE;
        // Set Columns
        // $columns = "course_id as id,course_name as name";
        $columns = "spec_id as id,spec_name as name";

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
        // $params['pk'] = 'course_id';
        // $params['id_col'] = 'course_id';
        $params['pk'] = 'spec_id';
        $params['id_col'] = 'spec_id';
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }

    /**
     * @OA\Get(
     *     path="/api/specialization/{id}",
     *     tags={"specialization"},
     *     summary="get specialization",
     *     description="get specialization",
     *     operationId="specialization",
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
     * get specialization by id
     *
     * @param specialization $id specialization id
     * @return json response of specialization detail by id
     * @author
     */
    public function specialization_get ($id = false)
    {
        if ( $id ) {
            $this->specializations_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/specializations/{page}/{limit}",
     *   tags={"specialization"},
     *   operationId="get specializations list",
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
     * get specializations list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the specializations list
     * @param string $id course id
     * @return json response of specializations list by page & limit
     * @author
     */
    public function specializations_get ($page = false , $limit = false , $id = false)
    {
        $course_id = $this->get('course_id',true);
        // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_ACADEMICS;
        // Set Table
        $table = SPECIALIZATION_TABLE;
        // Set Columns
        $columns = "spec_id as id,spec_name as name";

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
        $params['pk'] = 'spec_id';
        $params['id_col'] = 'spec_id';
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }

    /**
     * @OA\Get(
     *     path="/api/campus/{id}",
     *     tags={"campus"},
     *     summary="get campus",
     *     description="get campus",
     *     operationId="campus",
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
     * get campus by id
     *
     * @param campus $id campus id
     * @return json response of campus detail by id
     * @author
     */
    public function campus_get ($id = false)
    {
        if ( $id ) {
            $this->campuses_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/campuses/{page}/{limit}",
     *   tags={"campus"},
     *   operationId="get campuses list",
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
     * get campuses list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the campuses list
     * @param string $id campuses id
     * @return json response of campuses list by page & limit
     * @author
     */
    public function campuses_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        // $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = CAMPUS_TABLE;
        // Set Columns
        $columns = "campus_id as id,campus_name as name";

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
        $params['pk'] = 'campus_id';
        $params['id_col'] = 'campus_id';
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }

    /**
     * get Course list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the campuses list
     * @param string $id application form id
     * @return json response of course list by page & limit
     * @author
     */

     public function appcourse_get($id = false)
     {
        if ( $id ) {
            $this->appcourses_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
     }


     /**
     ** @OA\Get(
     *   path="/api/app_courses/{page}/{limit}",
     *   tags={"applicationcourses"},
     *   operationId="get applicationcourses list",
     *     @OA\Parameter(
     *         name="app_id",
     *         in="path",
     *         description="app_id",
     *         required=false
     *   ),
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
     * get Courses list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the campuses list
     * @param string $id application form id
     * @return json response of course list by page & limit
     * @author
     */
     public function appcourses_get($page = false , $limit = false , $id = false)
     {
         // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);

        $app_id = $this->input->get('appform_id');

        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = APPLICATION_FORM;
        // Set Columns
        //$columns = $table.".appln_form_id as id,".$table.".appln_form_name as name";

        $function_name = $this->get_function_name(__FUNCTION__);

        $app_form_pgm_table = APPLN_FORM_W_PROGRAM_TABLE;
        $program_table      = PROGRAM_TABLE;
        $academic_yr_table = ACADEMIC_YEAR_TABLE;
        $academic_schema = SCHEMA_ACADEMICS;
        $columns = $program_table.".prog_id as id,".$program_table.".prog_name as name";
        $joins = array(
                array(
                    'table' => $app_form_pgm_table,
                    'condition' => $app_form_pgm_table.'.appln_form_id = '.$table.'.appln_form_id',
                    'jointype' => 'INNER'
                ),

                array(
                    'table' => $academic_schema.'.'.$program_table,
                    'condition' => $academic_schema.'.'.$program_table.'.prog_id = '.$app_form_pgm_table.'.prog_id',
                    'jointype' => 'INNER'
                ),
                array(
                    'table' => $academic_yr_table,
                    'condition' => $academic_yr_table.'.acad_yr_id = '.$table.'.acad_yr_id' . ' AND '.$academic_yr_table.".curr_yr='true'",
                    'jointype' => 'INNER'
                ),
            );

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
        $params['pk'] = $table.'.appln_form_id';
        $params['id_col'] = $table.'.appln_form_id';
        $cond = array();
        $cond[$table.'.active'] = 't';
        $cond[$table.'.appln_form_id'] = $app_id;
        $params['cond'] = $cond;
        $params['joins'] = $joins;
        
        // Call Select Method
        $this->_select_table($params);
     }
	 
	/**
     * @OA\Get(
     *     path="/api/bloodgroup/{id}",
     *     tags={"bloodgroups"},
     *     summary="get bloodgroup",
     *     description="get bloodgroup",
     *     operationId="bloodgroup",
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
     * get bloodgroup by id
     *
     * @param bloodgroup $id bloodgroup id
     * @return json response of bloodgroups by id
     * @author
     */
    public function bloodgroup_get ($id = false)
    {
        if ( $id ) {
            $this->bloodgroups_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }	
	
     /**
     ** @OA\Get(
     *   path="/api/bloodgroups/{page}/{limit}",
     *   tags={"bloodgroups"},
     *   operationId="get bloodgroups list",
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
     * get bloodgroups list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the bloodgroup list
     * @param string $id bloodgroup id
     * @return json response of bloodgroup list by page & limit
     * @author
     */
    public function bloodgroups_get ($page = false , $limit = false , $id = false)
    {
        if(!$user_login) {
            // Check Authorization Token
            $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        }

		// Set Table
		$schema_master = SCHEMA_MASTER;
		$table = $schema_master.'.'.MASTER_BLO0D;	
		// Set Columns
		$columns = 'blood_grp_id as id,blood_grp as name';

        $function_name = $this->get_function_name(__FUNCTION__);
          // Parameter By Array
          $params = array();
          $table_prefix = '';
		
		
          $params['table'] = $table;
          $params['table_schema'] = $schema_master;
          $params['function_name'] = $function_name;
          $params['table_prefix'] = $table_prefix;
          $params['page'] = $page;
          $params['limit'] = $limit;
          $params['columns'] = $columns;
          if(isset($id) && $id != '')
          {
               $params['id'] = $id;
          }
          $params['pk'] = 'blood_grp_id';
          $params['id_col'] = 'blood_grp_id';
          // Call Select Method
          $this->_select_table($params);
    }		 
	
	/**
     * @OA\Get(
     *     path="/api/district/{id}",
     *     tags={"districts"},
     *     summary="get district",
     *     description="get district",
     *     operationId="district",
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
     * get district by id
     *
     * @param district $id employee id
     * @return json response of district by id
     * @author
    */
    public function district_get ($id = false)
    {
        if ( $id ) {
            $this->districts_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }	
	
	/**
     ** @OA\Get(
     *   path="/api/district/{page}/{limit}",
     *   tags={"districts"},
     *   operationId="get district lists",
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
     * get districts list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the districts list
     * @param string $id districts id
     * @return json response of districts list by page & limit
     * @author
     */
    public function districts_get ($page = false , $limit = false , $id = false)
    {
		$state_id = $this->input->get('state_id');
        if(!$user_login) {
            // Check Authorization Token
            //$user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        }

		// Set Table
		$schema_master = SCHEMA_MASTER;
		$table = DISTRICTS;	
		// Set Columns
		$columns = 'district_id as id,district_name as name';

        $function_name = $this->get_function_name(__FUNCTION__);
          // Parameter By Array
          $params = array();
          $table_prefix = '';
		
		
          $params['table'] = $table;
          $params['table_schema'] = $schema_master;
          $params['function_name'] = $function_name;
          $params['table_prefix'] = $table_prefix;
          $params['page'] = $page;
          $params['limit'] = $limit;
          $params['columns'] = $columns;
          if(isset($id) && $id != '')
          {
               $params['id'] = $id;
          }
		  
		  $cond = array('state_id'=>$state_id);
		  $params['cond'] = $cond;
          $params['pk'] = 'district_id';
          $params['id_col'] = 'district_id';
          // Call Select Method
          $this->_select_table($params);
    }

    /**
     * @OA\Get(
     *     path="/api/graduation/{id}",
     *     tags={"graduation"},
     *     summary="get graduation",
     *     description="get graduation",
     *     operationId="graduation",
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
     * get graduation by id
     *
     * @param graduation $id graduation id
     * @return json response of graduation by id
     * @author
    */
    public function graduation_get ($id = false)
    {
        if ( $id ) {
            $this->graduations_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }   
    
    /**
     ** @OA\Get(
     *   path="/api/graduation/{page}/{limit}",
     *   tags={"graduation"},
     *   operationId="get graduation lists",
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
     * get graduations list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the graduations list
     * @param string $id graduations id
     * @return json response of graduations list by page & limit
     * @author
     */
    public function graduations_get ($page = false , $limit = false , $id = false)
    {
        if(!$user_login) {
            // Check Authorization Token
            $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        }

        // Set Table
        $schema_master = SCHEMA_MASTER;
        $table = $schema_master.'.'.MASTER_GRADUATION;   
        // Set Columns
        $columns = 'grad_id as id,grad_name as name';

        $function_name = $this->get_function_name(__FUNCTION__);
          // Parameter By Array
          $params = array();
          $table_prefix = '';
        
        
          $params['table'] = $table;
          $params['table_schema'] = $schema_master;
          $params['function_name'] = $function_name;
          $params['table_prefix'] = $table_prefix;
          $params['page'] = $page;
          $params['limit'] = $limit;
          $params['columns'] = $columns;
          if(isset($id) && $id != '')
          {
               $params['id'] = $id;
          }
          $params['pk'] = 'grad_id';
          $params['id_col'] = 'grad_id';
          // Call Select Method
          $this->_select_table($params);
    }
	
	protected function _get_lookup_master($function_name, $id, $return = false, $cond = array()) {
        // select lv.lookup_value_ref_id ,lv.value_name from master.lookup_master lm 
        // inner join master.lookup_value lv on lm.lookup_master_ref_id = lv.lookup_master_ref_id 
        // where lm.lookup_master_id = 26;

        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = TABLE_LOOKUP_MASTER;
        $stable = TABLE_LOOKUP_VALUE;
        // Set Columns
        $columns = $stable.".lookup_value_ref_id as id,".$stable.".value_name as name";

        
        // Parameter By Array
        $params = array();
        $params['table'] = $table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        // if(isset($id) && $id != '')
        // {
        //     $params['id'] = $id;
        // }
        $params['pk'] = 'lookup_value_ref_id';
        $params['id_col'] = 'lookup_value_ref_id';
        $cond = ($cond)?$cond:array();
        // $cond['active'] = 't';        
        $cond['lookup_master_id'] = $id;        
        $params['cond'] = $cond;
        $joins = array(
                    array(
                        'table' => $table_schema.'.'.$stable,
                        'condition' => $table_schema.'.'.$table.'.lookup_master_ref_id = '.$table_schema.'.'.$stable.'.lookup_master_ref_id',
                        'jointype' => 'INNER'
                    ),
                );
        $params['joins'] = $joins;
        $params['returnresponse'] = $return;
        // Call Select Method
        $this->_select_table($params);
    }	
	
	
	/**
     * @OA\Get(
     *     path="/api/user_work_category/",
     *     tags={"user work category"},
     *     summary="user work category",
     *     description="user work category",
     *     operationId="user work category",
     *     deprecated=false,
     *     
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
     * get user work category
     *
     * @return json response of user work category
     * @author
     */
	 
    public function user_work_category_get() {
        $id = LOOKUP_MASTER_WORK_CATEGORY;
        $function_name = $this->get_function_name(__FUNCTION__);
        $this->_get_lookup_master($function_name, $id);
    }

    public function upload_files_put ()
    {
        $form_wizard_upload_id = FORM_WIZARD_UPLOAD_ID;

        if ( $this->put ( 'file_name',true ) ) {
            $upload_type = $this->put ( 'upload_type',true );
            $fk_id = $this->put ( 'fk_id',true );
            $app_form_id = $this->put ( 'app_form_id',true );
            $max_file_size = $this->put ( 'max_file_size',true );
            $max_file_size = ($max_file_size)?$max_file_size:MAX_FILE_SIZE;
            $file_extension = $this->put ( 'file_extension',true );
            $file_extension = ($file_extension)?$file_extension:FILE_ALLOWED_TYPE;
			$created_updated_by = $this->put ( 'created_updated_by',true );
            // get applicant form pk id
            $applicant_appln_det_res = $this->_get_appln_form_id($fk_id,$app_form_id);
            $applicant_appln_id = $applicant_appln_det_res['id'];

            $fk1_id = $applicant_appln_id;
            $is_edit = $this->put ( 'is_edit',true );
            $file_data = $this->put ( 'file_data',true );
            $file_name = $this->put ( 'file_name',true );
            $foldername = $this->put ( 'foldername',true );
            $applicant_login_id = $this->put ( 'applicant_login_id',true );
            $is_wizard_with_declare = $this->put ( 'is_wizard_with_declare',true );
            $is_wizard_with_declare = ($is_wizard_with_declare)?$is_wizard_with_declare:false;
            $upload_data = $this->put ( 'upload_data',true );
            $upload_data = json_decode($upload_data,true);
            $file_size = $upload_data[ 'file_size' ]; // in KB
            $file_ext = $upload_data[ 'file_ext' ];
            $file_ext = str_replace('.', '', $file_ext);
            // to set file type id
            $file_type_id=22;
            if($file_ext == 'jpg' || $file_ext == 'jpeg'){
                $file_type_id = "22";
            }elseif($file_ext == 'png'){
                $file_type_id = "220";
            }elseif($file_ext == 'pdf'){
                $file_type_id = "20";
            }elseif($file_ext == 'doc' || $file_ext == 'docx'){
                $file_type_id = "21";
            }
            $upload_path = FCPATH . 'uploads/';

            if ( !is_dir ( $upload_path ) ) {
                mkdir ( $upload_path , 0777 );
            }
            $upload_path .= 'api/';
            if ( !is_dir ( $upload_path ) ) {
                mkdir ( $upload_path , 0777 );
            }

            if($foldername) {
                $upload_path .= str_replace(' ','_',$foldername);
                if ( !is_dir ( $upload_path ) ) {
                    mkdir ( $upload_path , 0777 );
                }    
            }
            $upload_path .= date ( 'Y-m-d' ) . '/';
            // $upload_path .= date ( 'Y' ) . '/';
            if ( !is_dir ( $upload_path ) ) {
                mkdir ( $upload_path , 0777 );
            }
            

            if ( $file_size < $max_file_size ) {
                $file_allowed_types = $file_extension;
                $arr_file_allowed_types = explode ( '|' , $file_allowed_types );
                if ( in_array ( $file_ext , $arr_file_allowed_types ) ) {
                    log_message ( 'info' , $this->lang->line ( 'file_uploaded' ) );
                    $source = $upload_path . time().'_'.$file_name;
                    if ( $file_data ) {
                        $arrContextOptions=array(
                            "ssl"=>array(
                                "verify_peer"=>false,
                                "verify_peer_name"=>false,
                            ),
                        );  
                        // $file_data = base64_decode ( $file_data );
                        $file_data = file_get_contents ( $file_data, false, stream_context_create($arrContextOptions));
                        file_put_contents ( $source , $file_data );
                    }
                    if ( file_exists ( $source ) ) {
                        // get document detail
                        $doc_id = $this->_get_upload_document_id($upload_type);
                        $function_name = $this->get_function_name ( __FUNCTION__ );
                        
                        if($is_edit) {
                            if($doc_id != DOCUMENT_ID_TENTATIVE_TOPIC) {
                                // if edit, old vehicle document has deleted
                                $del_data = array();
                                $del_data['doc_id'] = $doc_id;
                                $del_data['fk_id'] = $fk_id;
                                $del_data['fk1_id'] = $fk1_id;
                                // $ins_data['type'] = $file_type_id;
                                $this->_delete_document($del_data);    
                            }
                        }
                        // insert vehicle document
                        $ins_data = array();
                        $ins_data['doc_id'] = $doc_id;
                        $ins_data['fk_id'] = $fk_id; // applicant_personal_det_id
                        $ins_data['fk1_id'] = $fk1_id;
                        $ins_data['name'] = $file_name;
                        $ins_data['size_kb'] = $file_size;
                        $ins_data['type'] = $file_type_id;
                        $source = str_replace(FCPATH, '', $source);
                        $ins_data['path'] = $source;
						$ins_data['created_updated_by'] = $created_updated_by;
                        $insert = $this->_create_document($ins_data);
                        if($insert) {
                            if(!$is_wizard_with_declare) {
                                // common_wizardupdate
                                // $wizard_update = $this->common_wizardupdate($fk_id , $app_form_id , $form_wizard_upload_id);    
                            }                            
            
                            $data = $this->_get_uploaded_file($fk_id, $fk1_id, $doc_id);
            
                            log_message ( 'info' , $this->lang->line ( 'file_exists' ) );
                            $this->response (
                                [
                                    'status' => TRUE ,
                                    'data' => $data ,
                                    'message' => $this->lang->line ( 'file_upload_success' )
                                ] , API_Controller::HTTP_OK
                            );
                        } else {
                            log_message ( 'error' , $this->lang->line ( 'create_error' ) );
                            $this->response (
                                [
                                    'status' => false ,
                                    'message' => $this->lang->line ( 'create_error' )
                                ] , API_Controller::HTTP_OK
                            );
                        }
                    }
                    else {
                        log_message ( 'error' , $this->lang->line ( 'file_not_exists' ) );
                        $this->response (
                            [
                                'status' => false ,
                                'message' => $this->lang->line ( 'file_not_exists' )
                            ] , API_Controller::HTTP_OK
                        );
                    }
                }
                else {
                    log_message ( 'error' , $this->lang->line ( 'check_file_types', array(FILE_ALLOWED_TYPE) ) );
                    $this->response (
                        [
                            'status' => false ,
                            'message' => $this->lang->line ( 'check_file_types', array(FILE_ALLOWED_TYPE) )
                        ] , API_Controller::HTTP_OK
                    );
                }
            }
            else {
                log_message ( 'error' , $this->lang->line ( 'check_file_sizes', array(MAX_FILE_SIZE) ) );
                $this->response (
                    [
                        'status' => false ,
                        'message' => $this->lang->line ( 'check_file_sizes', array(MAX_FILE_SIZE) )
                    ] , API_Controller::HTTP_OK
                );
            }
        }
        else {
            log_message ( 'error' , $this->lang->line ( 'file_not_upload' ) );
            $this->response (
                [
                    'status' => false ,
                    'message' => $this->lang->line ( 'file_not_upload' )
                ] , API_Controller::HTTP_OK
            );
        }
    }


    protected function _get_upload_document_id($upload_type) {
        switch ($upload_type) {
            case 'photograph':
                return DOCUMENT_ID_PHOTOGRAPH;
                break;
            case 'signature':
                return DOCUMENT_ID_SIGNATURE;
                break;
            case 'tenth_marksheet':
                return DOCUMENT_ID_TENTH_MARKSHEET;
                break;
            case 'twelvfth_marksheet':
                return DOCUMENT_ID_TWELVFTH_MARKSHEET;
                break;
            case 'aadhar_card':
                return DOCUMENT_ID_AADHAR_CARD;
                break;
            case 'post_graduation_marksheet':
                return DOCUMENT_ID_POST_GRADUATION_MARKSHEET;
                break;
            case 'gate_score_card':
                return DOCUMENT_ID_GATE_SCORE_CARD;
                break;
            case 'ugc_score_card':
                return DOCUMENT_ID_UGC_SCORE_CARD;
                break;
            case 'slet_score_card':
                return DOCUMENT_ID_SLET_SCORE_CARD;
                break;
            case 'net_score_card':
                return DOCUMENT_ID_NET_SCORE_CARD;
                break;
            case 'score_card':
                return DOCUMENT_ID_SCORE_CARD;
                break;
            case 'tentative_topic_files':
                return DOCUMENT_ID_TENTATIVE_TOPIC;
                break;
            case 'additional_qualification':
                return DOCUMENT_ID_ADDITIONAL_QUALIFICATION;
                break;
            case 'graduation_marksheet':
                return DOCUMENT_ID_GRADUATION_MARKSHEET;
                break;
            case 'competitive_exam_marksheet':
                return DOCUMENT_ID_COMPETITIVE_EXAM_MARKSHEET;
                break;
			case 'provisional_certificate':
                return DOCUMENT_ID_PROVISIONAL_CERTICATE;
                break;
			case 'other_document1':
			    return DOCUMENT_ID_ADDITIONAL_QUALIFICATION;
			    break;
			case 'other_document2':
			    return DOCUMENT_ID_OTHER_DOCUMENTS;
			    break;
			case 'mbbs_marksheet':
			    return DOCUMENT_ID_MBBS_MARKSHEET;
			    break;
			case 'mci_reg_certificate':
			    return DOCUMENT_ID_MCI_REG_CERTIFICATE;
			    break;
			case 'work_exp_certificate':
			    return DOCUMENT_ID_WORK_EXP_CERTIFICATE;
			    break;
			case 'crri_certificate':
			    return DOCUMENT_ID_CRRI_CERTIFICATE;
			    break;
			case 'tenth_grade':
			    return DOCUMENT_ID_TENTH_GRADE;
			    break;		
			case 'twelvfth_grade';
		    return DOCUMENT_ID_TWELVFTH_GRADE;
			    break;		
			case 'bachelors_marksheet';
		    return DOCUMENT_ID_BACHELORS_MARKSHEET;
			    break;
			case 'masters_marks_card';
		    return DOCUMENT_ID_MASTERS_MARKS_CARD;
			    break;	
			case 'transcripts';
		    return DOCUMENT_ID_TRANSCRIPTS;
			    break;					
        }
    }

    // protected function _get_document_params($params) {
    //     $table = MASTER_DOCUMENTS;
    //     $table_prefix = MASTER_DOCUMENTS_PREFIX;
    //     $params['table'] = $table;
    //     $params['table_prefix'] = $table_prefix;
    //     $params['pk'] = $table_prefix.'id';
    //     $params['id_col'] = 'id';
    //     $cond = array();
    //     if(isset($params['unique'])) {
    //         if($params['unique']) {
    //             $cond[$table_prefix.'unique_id'] = $params['unique'];
    //         }
    //     }
    //     $params['cond'] = $cond;
    //     $columns = $table_prefix . 'id as id, ' . $table_prefix . 'name  as name, '.$table_prefix . 'unique_id  as unique_id, ' . $table_prefix . 'description as description, ' . $table_prefix . 'created_at as created,' . $table_prefix . 'modified_at as modified, ' . $table_prefix . 'status as status';
    //     $params['columns'] = $columns;
    //     return $params;
    // }

    protected function _create_document($data = array()) {
        $table = APPLICANT_DOCUMENT_DET_TABLE;
        // $data['doc_id'] = $data['doc_id'];
        $data['applicant_personal_det_id'] = $data['fk_id'];
        $data['applicant_appln_id'] = $data['fk1_id'];
        $data['file_type_id'] = $data['type'];
        $data['file_name'] = $data['name'];
        $data['file_size_kb'] = $data['size_kb'];
        $data['file_path'] = $data['path'];
		$data['created_by'] = $data['created_updated_by'];
        $data['table_schema'] = SCHEMA_ADMISSION;
        unset($data['fk_id']);
        unset($data['fk1_id']);
        unset($data['type']);
        unset($data['name']);
        unset($data['path']);
        unset($data['size_kb']);
		unset($data['created_updated_by']);
        $insert = $this->common->common_insert ( $table , '' , $data );
        return $insert;
    }

    protected function _delete_document($data = array()) {
        $table = APPLICANT_DOCUMENT_DET_TABLE;
        
        // $data['doc_id'] = $data['doc_id'];
        if(isset($data['fk_id'])) {
            $data['applicant_personal_det_id'] = $data['fk_id'];
            unset($data['fk_id']);    
        }
        if(isset($data['fk1_id'])) {
            $data['applicant_appln_id'] = $data['fk1_id'];
            unset($data['fk1_id']);    
        }
        if(isset($data['id'])) {
            $data['applicant_doc_det_id'] = $data['id'];
            unset($data['id']);    
        }
        
        $data['table_schema'] = SCHEMA_ADMISSION;
        // $data['file_type_id'] = $data['type'];
        // unset($data['document_id']);
        
        // unset($data['type']);
        $delete = $this->common->common_delete_new ( $table , $data );
        // echo $this->db->last_query();
        return $delete;
    }

    /**
     * get upload files list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the upload files list
     * @param string $id upload files id
     * @return json response of upload files list by page & limit
     * @author
     */
    public function upload_filelist_get($page = false , $limit = false , $id = false) 
    {
		$fk_id = $this->get('fk_id',true);
		$fk1_id = $this->get('fk1_id',true);
        $params = array();
        $function_name = $this->get_function_name ( __FUNCTION__ );
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['id'] = $id;
        $params['id_col'] = 'applicant_doc_det_id';
        $params = $this->_get_upload_file($params);
        $this->_select_table($params);
    }
	
	/**
     * @OA\Get(
     *     path="/api/user_working_place/",
     *     tags={"user working place"},
     *     summary="user working place",
     *     description="user working place",
     *     operationId="user working place",
     *     deprecated=false,
     *     
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
     * get user working place
     *
     * @return json response of user working place
     * @author
     */
	 
    public function user_working_place_get() {
        $id = LOOKUP_MASTER_WORKING_PLACE;
        $function_name = $this->get_function_name(__FUNCTION__);
        $this->_get_lookup_master($function_name, $id);
    }
	
	/**
     * @OA\Get(
     *     path="/api/user_gender_title/",
     *     tags={"user gender title"},
     *     summary="user gender title",
     *     description="user gender title",
     *     operationId="user gender title",
     *     deprecated=false,
     *     
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
     * get user gender title
     *
     * @return json response of user gender title
     * @author
     */
	 
    public function user_gender_title_get() {
        $id = LOOKUP_MASTER_TITLE;
        $function_name = $this->get_function_name(__FUNCTION__);
        $cond = array();
        $cond['where_not_in']['lookup_value_ref_id'] = array(LOOKUP_VALUE_TITLE_LATE_ID);
        $this->_get_lookup_master($function_name, $id, false, $cond);
    }
	
	/**
     * @OA\Get(
     *     path="/api/user_gender/",
     *     tags={"user gender"},
     *     summary="user gender",
     *     description="user gender",
     *     operationId="user gender",
     *     deprecated=false,
     *     
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
     * get user gender
     *
     * @return json response of user gender
     * @author
     */
	 
    public function user_gender_get() {
        $id = LOOKUP_MASTER_GENDER;
        $function_name = $this->get_function_name(__FUNCTION__);
        $this->_get_lookup_master($function_name, $id);
    }
	
	/**
     * @OA\Get(
     *     path="/api/user_social_status/",
     *     tags={"user social status"},
     *     summary="user social status",
     *     description="user social status",
     *     operationId="user social status",
     *     deprecated=false,
     *     
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
     * get user marking scheme
     *
     * @return json response of user marking scheme
     * @author
     */
	 
    public function user_social_status_get() {
        $id = LOOKUP_MASTER_SOCIAL_STATUS;
        $function_name = $this->get_function_name(__FUNCTION__);
        $this->_get_lookup_master($function_name, $id);
    }

    /**
     * @OA\Get(
     *     path="/api/other_university/{id}",
     *     tags={"university"},
     *     summary="get other university",
     *     description="get other university",
     *     operationId="other university",
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
     * get other university by id
     *
     * @param other university $id other university id
     * @return json response of other university detail by id
     * @author
     */
    public function other_university_get ($id = false)
    {
        if ( $id ) {
    
            $this->other_universities_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/other_universities/{page}/{limit}",
     *   tags={"university"},
     *   operationId="get other universities list",
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
     * get other universities list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the other universities list
     * @param string $id other universities id
     * @return json response of other universities list by page & limit
     * @author
     */
    public function other_universities_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = TABLE_OTHER_UNIVERSITY;
        // Set Columns
        $columns = "univ_id as id,univ_name as name";

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
        $params['pk'] = 'univ_id';
        $params['id_col'] = 'univ_id';
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }

    /**
     * @OA\Get(
     *     path="/api/user_marking_scheme/",
     *     tags={"user marking scheme"},
     *     summary="user marking scheme",
     *     description="user marking scheme",
     *     operationId="user marking scheme",
     *     deprecated=false,
     *     
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
     * get user marking scheme
     *
     * @return json response of user marking scheme
     * @author
     */
     
    public function user_marking_scheme_get() {
        $id = LOOKUP_MASTER_MARKING_SCHEME;
        $function_name = $this->get_function_name(__FUNCTION__);
        $cond = array();
        $cond['where_not_in']['lookup_value_ref_id'] = array(LOOKUP_MASTER_MARKING_SCHEME_GRADE);
        $this->_get_lookup_master($function_name, $id,false, $cond);
    }	
	
	/**
     * @OA\Get(
     *     path="/api/qualifying_degree/{id}",
     *     tags={"qualifying_degree"},
     *     summary="get qualifying_degree",
     *     description="get qualifying_degree",
     *     operationId="qualifying_degree",
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
     * get qualifying_degree by id
     *
     * @param qualifying_degree $id qualifying_degree id
     * @return json response of qualifying_degree detail by id
     * @author
     */
    public function qualifying_degree_get ($id = false)
    {
        if ( $id ) {
            $this->qualifying_degrees_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/qualifying_degrees/{page}/{limit}",
     *   tags={"qualifying_degree"},
     *   operationId="get qualifying_degrees_ list",
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
     * get qualifying_degree list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the qualifying_degree list
     * @param string $id qualifying_degrees id
     * @return json response of qualifying_degree list by page & limit
     * @author
     */
    public function qualifying_degrees_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        // $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_ACADEMICS;
        // Set Table
        $table = DEGREE_TABLE;
        // Set Columns
        // $columns = "country_id as id,country_name as name";
		$columns = $table.'.deg_id as id,'.$table.'.deg_name as name';

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
        $params['pk'] = 'deg_id';
        $params['id_col'] = 'deg_id';		
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }	
	
	/**
     * @OA\Get(
     *     path="/api/spec_qualifying_degree/{id}",
     *     tags={"spec_qualifying_degree"},
     *     summary="get spec_qualifying_degree",
     *     description="get spec_qualifying_degree",
     *     operationId="spec_qualifying_degree",
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
     * get spec_qualifying_degree by id
     *
     * @param spec_qualifying_degree $id spec_qualifying_degree id
     * @return json response of spec_qualifying_degree detail by id
     * @author
     */
    public function spec_qualifying_degree_get ($id = false)
    {
        if ( $id ) {
            $this->spec_qualifying_degrees_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/spec_qualifying_degrees/{page}/{limit}",
     *   tags={"spec_qualifying_degree"},
     *   operationId="get spec_qualifying_degrees list",
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
     * get spec_qualifying_degrees list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the spec_qualifying_degrees list
     * @param string $id spec_qualifying_degrees id
     * @return json response of spec_qualifying_degrees list by page & limit
     * @author
     */
    public function spec_qualifying_degrees_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        // $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_ACADEMICS;
        // Set Table
        $table = SPECIALIZATION_TABLE;
        // Set Columns
        // $columns = "country_id as id,country_name as name";
		$columns = $table.'.spec_id as id,'.$table.'.spec_name as name';

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
        $params['pk'] = 'spec_id';
        $params['id_col'] = 'spec_id';		
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }	
	
	
	/**
     * @OA\Get(
     *     path="/api/department/{id}",
     *     tags={"department"},
     *     summary="get department",
     *     description="get department",
     *     operationId="department",
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
     * get department by id
     *
     * @param department $id department id
     * @return json response of department detail by id
     * @author
     */
    public function department_get ($id = false)
    {
        if ( $id ) {
            $this->departments_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/departments_get/{page}/{limit}",
     *   tags={"department"},
     *   operationId="get departments_get list",
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
     * get departments_get list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the departments_get list
     * @param string $id departments_get id
     * @return json response of departments_get list by page & limit
     * @author
     */
    public function departments_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        // $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = DEPARTMENT;
        // Set Columns
        // $columns = "country_id as id,country_name as name";
		$columns = $table.'.dept_id as id,'.$table.'.dept_name as name';

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
        $params['pk'] = 'dept_id';
        $params['id_col'] = 'dept_id';		
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }	

	/**
     * @OA\Get(
     *     path="/api/faculty/{id}",
     *     tags={"faculty"},
     *     summary="get faculty",
     *     description="get faculty",
     *     operationId="faculty",
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
     * get faculty by id
     *
     * @param faculty $id faculty id
     * @return json response of faculty detail by id
     * @author
     */
    public function faculty_get ($id = false)
    {
        if ( $id ) {
            $this->faculties_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/faculties/{page}/{limit}",
     *   tags={"faculty"},
     *   operationId="get faculties list",
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
     * get faculties_get list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the faculties_get list
     * @param string $id faculties_get id
     * @return json response of faculties_get list by page & limit
     * @author
     */
    public function faculties_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        // $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = FACULTY;
        // Set Columns
        // $columns = "country_id as id,country_name as name";
		$columns = $table.'.faculty_id as id,'.$table.'.faculty_name as name';

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
        $params['pk'] = 'faculty_id';
        $params['id_col'] = 'faculty_id';		
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }	

	/**
     * @OA\Get(
     *     path="/api/personal_details/{id}",
     *     tags={"personal_details"},
     *     summary="get personal_details",
     *     description="get personal_details",
     *     operationId="personal_details",
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
     * get personal_detail by id
     *
     * @param personal_detail $id personal_detail id
     * @return json response of personal_detail by id
     * @author
     */
    public function personal_detail_get ($id = false)
    {
        if ( $id ) {
            $this->personal_details_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/personal_details/{page}/{limit}",
     *   tags={"faculty"},
     *   operationId="get personal_details list",
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
     * get personal_details list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the personal_details list
     * @param string $id personal_details id
     * @return json response of personal_details list by page & limit
     * @author
     */
    public function personal_details_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        // $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
        $table = TABLE_APPLICANT_PERSONAL_DET;
        // Set Columns
        // $columns = "country_id as id,country_name as name";
		$columns = '*';

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
        $params['pk'] = 'applicant_personal_det_id';
        $params['id_col'] = 'applicant_personal_det_id';		
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }		

    /**
     * @OA\Get(
     *     path="/api/competitive_exam/{id}",
     *     tags={"competitive exam"},
     *     summary="get competitive exam",
     *     description="get competitive exam",
     *     operationId="competitive exam",
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
     * get competitive exam by id
     *
     * @param competitive exam $id competitive exam id
     * @return json response of competitive exam detail by id
     * @author
     */
    public function competitive_exam_get ($id = false)
    {
        if ( $id ) {
    
            $this->competitive_exams_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/competitive_exams/{page}/{limit}",
     *   tags={"competitive exam"},
     *   operationId="get competitive exams list",
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
     * get competitive exams list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the competitive exams list
     * @param string $id competitive exams id
     * @return json response of competitive exams list by page & limit
     * @author
     */
    public function competitive_exams_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = TABLE_COMPETITIVE_EXAM;
        // Set Columns
        $columns = "comp_exam_id as id,comp_exam_name as name";

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
        $params['pk'] = 'comp_exam_id';
        $params['id_col'] = 'comp_exam_id';
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }

    protected function _get_uploaded_file($applicant_id, $applicant_appln_id, $file_doc_id = false) {
        $params = array();
        if($file_doc_id != DOCUMENT_ID_TENTATIVE_TOPIC) {
            $params['return_type'] = 'single';
        }
        $params['returnresponse'] = true;
        $params=$this->_get_upload_file($params,$file_doc_id,$applicant_id,$applicant_appln_id);
        $applicant_doc = $this->_select_table($params);
        $data = $new_applicant_doc = array();
        $file_count = 0;
        if(count($applicant_doc)>0){
            if($file_doc_id == DOCUMENT_ID_TENTATIVE_TOPIC) {
                $arr_file_count = array_column($applicant_doc['data'], 'name');
                $file_count = count($arr_file_count);
            }
            if($file_count > 0){
                foreach($applicant_doc['data'] as $k=>$v) {
                    $applicant_doc['data'][$k]['file_name'] = $file_name = $applicant_doc['data'][$k]['name'];
                    $applicant_doc['data'][$k]['filename_user'] = remove_file_separator($file_name);
                    $applicant_doc['data'][$k]['filename_truncate'] = remove_file_separator($file_name,true);
                }
            } else {
                $applicant_doc['data']['file_name'] = $file_name = $applicant_doc['data']['name'];
                $applicant_doc['data']['filename_user'] = remove_file_separator($file_name);
                $applicant_doc['data']['filename_truncate'] = remove_file_separator($file_name,true);    
            }
            $applicant_doc['file_count'] = $file_count;
            $data['applicant_doc'] =$applicant_doc;
        }else{
            $data['applicant_doc']=array();
        }
        return $applicant_doc;
    }

    protected function _get_upload_file($params = array(), $document_id = false, $fk_id = false, $fk1_id = false){
        $schema_admission = SCHEMA_ADMISSION;
        $table = $schema_admission.'.'.APPLICANT_DOCUMENT_DET_TABLE;

        $schema_master = SCHEMA_MASTER;
        $stable = $schema_master.'.'.DOCUMENT_TABLE;
        $columns = $table.'.applicant_doc_det_id as id, '.$table.'.doc_id as document_id, '.$stable.'.doc_name as document_name, '.$table.'.applicant_personal_det_id as fk_id, '.$table.'.file_type_id as type, '.$table.'.file_name as name, '.$table.'.file_path as path, '.$table.'.created_at as created, '.$table.'.updated_at as modified, '.$table.'.active as active, '.$table.'.applicant_appln_id as applicant_appln_id';
        
        // $params = array();
        $params['table'] = $table;
        $params['table_prefix'] = '';
        
        
        $params['columns'] = $columns;
        
        $params['pk'] = 'applicant_doc_det_id';
        
        $cond = array();
        if($this->get('document_id',true)) {
            $cond[$table.'.doc_id'] = $this->get('document_id',true);
        }
        if($document_id) {
            $cond[$table.'.doc_id'] = $document_id;
        }
        if($this->get('type',true)) {
            $cond[$table.'.file_type_id'] = $this->get('type',true);
        }
        if($this->get('types',true)) {
            $types = $this->get('types',true);
            $arr_types = explode(',',$types);
            $cond['where_in'][$table.'.file_type_id'] = $arr_types;
        }
        if($this->get('fk_id',true)) {
            $cond[$table.'.applicant_personal_det_id'] = $this->get('fk_id',true);
        }
        if($fk_id) {
            $cond[$table.'.applicant_personal_det_id'] = $fk_id;
        }
        if($this->get('fk1_id',true)) {
            $app_form_id = $this->get('fk1_id',true);
            $applicant_personal_det_id = $this->get('fk_id',true);
            // get applicant form pk id
            $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
            $applicant_appln_id = $applicant_appln_det_res['id'];

            $cond[$table.'.applicant_appln_id'] = $applicant_appln_id;
        }
        if($fk1_id) {
            $cond[$table.'.applicant_appln_id'] = $fk1_id;
        }
        $params['cond'] = $cond;

        $joins = array(
            array(
                'table' => $stable,
                'condition' => $stable.'.doc_id = '.$table.'.doc_id',
                'jointype' => 'INNER'
            )         
        );
        $params['joins'] = $joins;
        return $params;
    }

    public function del_upload_file_post() {
        // $app_form_id_btech = APP_FORM_ID_BTECH;
        $doc_id = $this->post('doc_id',true);
        $data_del_file_id = $this->post('data_del_file_id',true);
        $applicant_login_id = $this->post('applicant_login_id',true);
        $applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
        $app_form_id = $this->post('app_form_id',true);

        // get applicant form pk id
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
        $applicant_appln_id = $applicant_appln_det_res['id'];

        // if edit, old vehicle document has deleted
        $del_data = array();
        $del_data['doc_id'] = $doc_id;
        $del_data['fk_id'] = $applicant_personal_det_id;
        $del_data['fk1_id'] = $applicant_appln_id;
        $del_data['id'] = $data_del_file_id;

        $data = $this->_get_uploaded_file($applicant_personal_det_id, $applicant_appln_id, $doc_id);
        if($data) {
            $delete = $this->_delete_document($del_data);
            if ( $delete ) {
                $this->response (
                    [
                        'status' => 'true' ,
                        'message' => 'Record(s) deleted successfully'
                    ] , API_Controller::HTTP_OK
                );
            }
            else {
                $this->response (
                    [
                        'status' => 'error' ,
                        'message' => 'Sorry, We could not delete this time, Please try again once.'
                    ] , API_Controller::HTTP_OK
                );
            }
        } else {
            $this->response (
                [
                    'status' => FALSE ,
                    'message' => 'Please pass parameter correctly.'
                ] , API_Controller::HTTP_OK
            );
        }
    }
	
	/**
     * @OA\Get(
     *     path="/api/user_nature_deformity/",
     *     tags={"user nature deformity"},
     *     summary="user nature deformity",
     *     description="user nature deformity",
     *     operationId="user nature deformity",
     *     deprecated=false,
     *     
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
     * get user nature deformity
     *
     * @return json response of user nature deformity
     * @author
     */
     
    public function user_nature_deformity_get() {
        $id = LOOKUP_MASTER_NATURE_DEFORMITY;
        $function_name = $this->get_function_name(__FUNCTION__);
        $this->_get_lookup_master($function_name, $id);
    }	
	
	
	/**
     * @OA\Get(
     *     path="/api/get_nationality_single/{id}",
     *     tags={"get_nationality_single"},
     *     summary="get_nationality_single",
     *     description="get_nationality_single",
     *     operationId="nationality single",
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
     * get nationality single by id
     *
     * @param nationality single $id nationality single id
     * @return json response of nationality single detail by id
     * @author
     */
    public function get_nationality_single_get ($id = false)
    {
        if ( $id ) {
    
            $this->get_nationality_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }	
	
	/**
     ** @OA\Get(
     *   path="/api/get_nationality/{page}/{limit}",
     *   tags={"nationalities_get"},
     *   operationId="get nationalities list",
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
     * get nationalities list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the nationalities list
     * @param string $id nationalities id
     * @return json response of nationalities list by page & limit
     * @author
     */
    public function get_nationality_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        // $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = COUNTRY;
        // Set Columns
        $columns = "country_id as id , nationality as name,(country_id='".COUNTRY_VALUE_DEFAULT."') AS india";

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
	
        $params['pk'] = 'india';
        $params['id_col'] = 'country_id';
        $cond = array();
        $cond['nationality'] != '';
        //$cond['nationality'] = 'is not null';
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    	
	}


    /*Mtech Research Start*/



    /**
     * @OA\Get(
     *     path="/api/coordinator/{id}",
     *     tags={"coordinator"},
     *     summary="get coordinator",
     *     description="get coordinator",
     *     operationId="coordinator",
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
     * get coordinator by id
     *
     * @param coordinator $id degree id
     * @return json response of coordinator by id
     * @author
    */
    public function singlecoordinator_get ($id = false)
    {
        if ( $id ) {
            $this->coordinatordetails_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }       

    /**
     ** @OA\Get(path="/api/coordinatordetails/{page}/{limit}",
     *     tags={"degree"},
     *   operationId="get coordinatordetails list",
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
     * get coordinatordetails list based on the stream selection
     *
     * @param integer $page page number
     * @param integer $limit limit to show the coordinatordetails list
     * @param string $id coordinatordetails id
     * @return json response of coordinatordetails list by page & limit
     * @author
    */  
    public function coordinatordetails_get ($page = false , $limit = false , $id = false)
    {
        
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
        $table = APPLICANT_COORDINATOR_DET_TABLE;   

        $columns ='research_area,coord_name,applicant_personal_det_id,applicant_coord_det_id,applicant_appln_id';

        //$applicant_personal_det_id = $this->input->get('applicant_personal_det_id'); 

        
        $function_name = $this->get_function_name(__FUNCTION__);
        // Parameter By Array
        $params = array();
        $params['table'] = $table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        $cond = array();
        if(isset($id) && $id != '')
        {
            $cond['applicant_appln_id'] = $id;    
        }
        
        $params['cond'] = $cond;
        $params['pk'] = 'applicant_coord_det_id';
        $params['id_col'] = 'applicant_coord_det_id';
        $this->_select_table($params);
    }
    
    /**
     * @OA\Get(
     *     path="/api/get_mtechrecampusprefer_single/{id}",
     *     tags={"get_mtechrecampusprefer_single"},
     *     summary="get_mtechrecampusprefer_single",
     *     description="get_mtechrecampusprefer_single",
     *     operationId="campusprefer single",
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
     * get mtechrecampusprefer single by id
     *
     * @param nationality single $id nationality single id
     * @return json response of mtechrecampusprefer single detail by id
     * @author
     */
    public function get_mtechrecampusprefer_single_get ($id = false)
    {
        if ( $id ) {
    
            $this->get_mtechrecampusprefer_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }   
    
    /**
     ** @OA\Get(
     *   path="/api/get_mtechrecampusprefer/{page}/{limit}",
     *   tags={"mtechresearch_get"},
     *   operationId="get get_mtechrecampusprefer list",
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
     * get get_mtechrecampusprefer list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the nationalities list
     * @param string $id nationalities id
     * @return json response of nationalities list by page & limit
     * @author
     */
    public function get_mtechrecampusprefer_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        // $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = CAMPUS_TABLE;
        // Set Columns
        $columns = "campus_id as id , campus_name as name";

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
    
        $params['pk'] = 'campus_id';
        $params['id_col'] = 'campus_id';
        //$cond = array();
        //$cond['nationality'] != '';
        //$cond['nationality'] = 'is not null';
        //$params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
        
    }

    
    /**
     * @OA\Get(
     *     path="/api/get_mtechrespecializationprefer_single/{id}",
     *     tags={"get_mtechrespecializationprefer_single"},
     *     summary="get_mtechrespecializationprefer_single",
     *     description="get_mtechrespecializationprefer_single",
     *     operationId="specializationprefer single",
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
     * get mtechrespecializationprefer_single single by id
     *
     * @param specializationprefer single $id specializationprefer single id
     * @return json response of mtechrespecializationprefer single detail by id
     * @author
     */
    public function get_mtechrespecializationprefer_single_get ($id = false)
    {
        if ( $id ) {
    
            $this->get_mtechrespecializationprefer_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }   
    
    /**
     ** @OA\Get(
     *   path="/api/get_mtechrespecializationprefer_get/{page}/{limit}",
     *   tags={"mtechresearch_get"},
     *   operationId="get get_mtechrespecializationprefer_get list",
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
     * get get_mtechrespecializationprefer_get list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the nationalities list
     * @param string $id nationalities id
     * @return json response of nationalities list by page & limit
     * @author
     */
    public function get_mtechrespecializationprefer_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        // $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_ACADEMICS;
        // Set Table
        $table = SPECIALIZATION_TABLE;
        // Set Columns
        $columns = "spec_id as id , spec_name as name";

        $function_name = $this->get_function_name(__FUNCTION__);
        //get specialization ids
        $exclude_specialization_ids=$this->input->get('exclude_specialization_ids');
        // Parameter By Array
        $params = array();
        $cond=array();
        // echo 'exclude_city_ids => '.$exclude_city_ids."\n";
        if($exclude_specialization_ids != '') {
            $arr_exclude_spec_ids = explode(',', $exclude_specialization_ids);
            $arr_exclude_spec_ids = array_filter($arr_exclude_spec_ids);
            $cond['where_not_in'][$table.'.spec_id'] = $arr_exclude_spec_ids;
        }
        $params['cond'] = $cond;
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
    
        $params['pk'] = 'spec_id';
        $params['id_col'] = 'spec_id';
        //$cond = array();
        //$cond['nationality'] != '';
        //$cond['nationality'] = 'is not null';
        //$params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
        
    }
   


    /**
     * @OA\Get(
     *     path="/api/get_mtechrereligion_single/{id}",
     *     tags={"get_mtechrereligion_single"},
     *     summary="get_mtechrereligion_single",
     *     description="get_mtechrereligion_single",
     *     operationId="religion single",
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
     * get get_mtechrereligion_single single by id
     *
     * @param religion $id specializationprefer single id
     * @return json response of get_mtechrereligion_single single detail by id
     * @author
     */
    public function get_mtechrereligion_single_get ($id = false)
    {
        if ( $id ) {
    
            $this->get_mtechrereligion_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }   
    
    /**
     ** @OA\Get(
     *   path="/api/get_mtechrereligion_get/{page}/{limit}",
     *   tags={"mtechresearch_get"},
     *   operationId="get get_mtechrereligion_get list",
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
     * get get_mtechrereligion_get list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the nationalities list
     * @param string $id nationalities id
     * @return json response of nationalities list by page & limit
     * @author
     */
    public function get_mtechrereligion_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        // $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = RELIGION_TABLE;
        // Set Columns
        $columns = "religion_id as id , religion_name as name";

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
    
        $params['pk'] = 'religion_id';
        $params['id_col'] = 'religion_id';
        //$cond = array();
        //$cond['nationality'] != '';
        //$cond['nationality'] = 'is not null';
        //$params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
        
    }

    

    /**
     * @OA\Get(
     *     path="/api/get_mtechremothertong_single/{id}",
     *     tags={"get_mtechremothertong_single"},
     *     summary="get_mtechremothertong_single",
     *     description="get_mtechremothertong_single",
     *     operationId="mothertongue single",
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
     * get get_mtechremothertong_single single by id
     *
     * @param mothertongue $id specializationprefer single id
     * @return json response of get_mtechremothertong_single single detail by id
     * @author
     */
    public function get_mtechremothertong_single_get ($id = false)
    {
        if ( $id ) {
    
            $this->get_mtechremothertong_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }   
    
    /**
     ** @OA\Get(
     *   path="/api/get_mtechremothertong_get/{page}/{limit}",
     *   tags={"mtechresearch_get"},
     *   operationId="get get_mtechremothertong_get list",
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
     * get get_mtechremothertong_get list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the nationalities list
     * @param string $id mother tongu id
     * @return json response of mother tongue list by page & limit
     * @author
     */
    public function get_mtechremothertong_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        // $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = MOTHER_TONGUE_TABLE;
        // Set Columns
        $columns = "mothertongue_id as id , mothertongue_name as name";

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
    
        $params['pk'] = 'mothertongue_id';
        $params['id_col'] = 'mothertongue_id';
        //$cond = array();
        //$cond['nationality'] != '';
        //$cond['nationality'] = 'is not null';
        //$params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
        
    }

    /*Mtech Research End*/
    
    /**
     * @OA\Get(
     *     path="/api/religion/{id}",
     *     tags={"religion"},
     *     summary="get religion",
     *     description="get religion",
     *     operationId="religion",
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
     * get religion by id
     *
     * @param religion $id religion id
     * @return json response of religion detail by id
     * @author
     */
    public function religion_get ($id = false)
    {
        if ( $id ) {
    
            $this->religions_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/religions/{page}/{limit}",
     *   tags={"religions"},
     *   operationId="get religions list",
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
     * get religions list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the religions list
     * @param string $id religions id
     * @return json response of religions list by page & limit
     * @author
     */
    public function religions_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = RELIGION_TABLE;
        // Set Columns
        $columns = "religion_id as id,religion_name as name";

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
        $params['pk'] = 'religion_id';
        $params['id_col'] = 'religion_id';
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }

    /**
     * @OA\Get(
     *     path="/api/mother_tongue/{id}",
     *     tags={"mother_tongue"},
     *     summary="get mother_tongue",
     *     description="get mother_tongue",
     *     operationId="mother_tongue",
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
     * get mother_tongue by id
     *
     * @param mother_tongue $id mother_tongue id
     * @return json response of mother_tongue detail by id
     * @author
     */
    public function mother_tongue_get ($id = false)
    {
        if ( $id ) {
    
            $this->mother_tongues_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/mother_tongues/{page}/{limit}",
     *   tags={"mother_tongues"},
     *   operationId="get mother_tongues list",
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
     * get mother_tongues list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the mother_tongues list
     * @param string $id mother_tongues id
     * @return json response of mother_tongues list by page & limit
     * @author
     */
    public function mother_tongues_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = MOTHER_TONGUE_TABLE;
        // Set Columns
        $columns = "mothertongue_id as id,mothertongue_name as name";

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
        $params['pk'] = 'mothertongue_id';
        $params['id_col'] = 'mothertongue_id';
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }

    /**
     * @OA\Get(
     *     path="/api/advertisement_source/{id}",
     *     tags={"advertisement_source"},
     *     summary="get advertisement_source",
     *     description="get advertisement_source",
     *     operationId="advertisement_source",
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
     * get advertisement_source by id
     *
     * @param advertisement_source $id advertisement_source id
     * @return json response of advertisement_source detail by id
     * @author
     */
    public function advertisement_source_get ($id = false)
    {
        if ( $id ) {
    
            $this->advertisement_sources_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/advertisement_sources/{page}/{limit}",
     *   tags={"advertisement_source"},
     *   operationId="get advertisement_sources list",
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
     * get advertisement_sources list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the advertisement_sources list
     * @param string $id advertisement_sources id
     * @return json response of advertisement_sources list by page & limit
     * @author
     */
    public function advertisement_sources_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = ADVERTISEMENT_SOURCE_TABLE;
        // Set Columns
        $columns = "advertisement_source_id as id,source_name as name";

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
        $params['pk'] = 'advertisement_source_id';
        $params['id_col'] = 'advertisement_source_id';
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }

    /**
     * @OA\Get(
     *     path="/api/branch/{id}",
     *     tags={"branch"},
     *     summary="get branch",
     *     description="get branch",
     *     operationId="branch",
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
     * get branch by id
     *
     * @param degree $id branch id
     * @return json response of branch by id
     * @author
    */
    public function branch_get ($id = false)
    {
        if ( $id ) {
            $this->branchs_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }       

    /**
     ** @OA\Get(path="/api/branchs/{page}/{limit}",
     *     tags={"branch"},
     *   operationId="get branchs list",
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
     * get branch list based on the branch selection
     *
     * @param integer $page page number
     * @param integer $limit limit to show the branch list
     * @param string $id cities id
     * @return json response of branch list by page & limit
     * @author
    */  
    public function branchs_get ($page = false , $limit = false , $id = false)
    {
        if(!$user_login) {
            // Check Authorization Token
            $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        }
        // Set Schema
        $table_schema = SCHEMA_ACADEMICS;
        // Set Table
        $table = BRANCH_TABLE;
        // Set Columns
        $columns = "branch_id as id,branch_name as name";
        $function_name = $this->get_function_name(__FUNCTION__);
        // Parameter By Array
        $params = array();
        $params['table'] = $table_schema.'.'.$table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        $cond = array();
        if(isset($id) && $id != '')
        {
            $cond['branch_id'] = $id;    
        }
        
        $params['cond'] = $cond;
        $params['pk'] = 'branch_id';
        $params['id_col'] = 'branch_id';
        
        // $params['joins'] = $joins;
        if($for_register) {
            $params['distinct'] = $columns;    
        }

        /* $params['cond'] = $cond;*/
        // Call Select Method
        $this->_select_table($params);
    }
	
	/**
     * @OA\Get(
     *     path="/api/user_board/{id}",
     *     tags={"board"},
     *     summary="get board",
     *     description="get board",
     *     operationId="board",
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
     * get board by id
     *
     * @param degree $id board id
     * @return json response of board by id
     * @author
    */
    public function user_board_get ($id = false)
    {
        if ( $id ) {
            $this->user_boards_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    } 	
	
	/**
     * @OA\Get(
     *     path="/api/user_boards/",
     *     tags={"board"},
     *     summary="board",
     *     description="board",
     *     operationId="board",
     *     deprecated=false,
     *     
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
     * get board
     *
     * @return json response of user board
     * @author
     */
     
    public function user_boards_get($page = false , $limit = false , $id = false) {
		$user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_COUNSELLING;
        // Set Table
        $table = SCHOOL_BOARD;
        // Set Columns
        $columns = "school_board_id as id,school_board_name as name";
        $function_name = $this->get_function_name(__FUNCTION__);
        // Parameter By Array
        $params = array();
        $params['table'] = $table_schema.'.'.$table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        $cond = array();
        if(isset($id) && $id != '')
        {
            $cond['school_board_id'] = $id;    
        }
        
        $params['cond'] = $cond;
        $params['pk'] = 'school_board_id';
        $params['id_col'] = 'school_board_id';

        /* $params['cond'] = $cond;*/
        // Call Select Method
        $this->_select_table($params);
    }
	
	/**
     * @OA\Get(
     *     path="/api/mode_of_study/",
     *     tags={"mode_of_study"},
     *     summary="mode of study",
     *     description="mode of study",
     *     operationId="mode of study",
     *     deprecated=false,
     *     
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
     * get user mode of study
     *
     * @return json response of user mode of study
     * @author
     */
     
    public function user_mode_of_study_get() {
        $id = LOOKUP_MASTER_MODE_OF_STUDY;
        $function_name = $this->get_function_name(__FUNCTION__);
        $this->_get_lookup_master($function_name, $id);
    }	
    /*
     * hcma course/branch
     */
    public function hcma_branchs_get ($page = false , $limit = false , $id = false)
    {
        if(!$user_login) {
            // Check Authorization Token
            $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        }
        // Set Schema
        $table_schema = SCHEMA_ACADEMICS;
        // Set Table
        $table = BRANCH_TABLE;
        // Set Columns
        $columns = "branch_id as id,branch_name as name";
        $function_name = $this->get_function_name(__FUNCTION__);
        // Parameter By Array
        $params = array();
        $params['table'] = $table_schema.'.'.$table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        $cond = array();
        if(isset($id) && $id != '')
        {
            $cond['branch_id'] = $id;
        }
        
        $params['cond'] = $cond;
        $params['pk'] = 'branch_id';
        $params['id_col'] = 'branch_id';
        
        // $params['joins'] = $joins;
        if($for_register) {
            $params['distinct'] = $columns;
        }
        
        /* $params['cond'] = $cond;*/
        // Call Select Method
        $this->_select_table($params);
    }

    /**
     * @OA\Get(
     *     path="/api/country/{id}",
     *     tags={"country"},
     *     summary="get country",
     *     description="get country",
     *     operationId="country",
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
     * get country by id
     *
     * @param country $id country id
     * @return json response of country detail by id
     * @author
     */
    public function country_get ($id = false)
    {
        if ( $id ) {
            $this->countries_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/countries/{page}/{limit}",
     *   tags={"country"},
     *   operationId="get countries list",
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
     * get countries list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the countries list
     * @param string $id country id
     * @return json response of countries list by page & limit
     * @author
     */
    public function countries_get ($page = false , $limit = false , $id = false)
    {
        // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_MASTER;
        // Set Table
        $table = COUNTRY;
        // Set Columns
        $columns = "country_id as id,country_name as name";

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
        $params['pk'] = 'country_id';
        $params['id_col'] = 'country_id';
        $cond = array();
        $cond['active'] = 't';        
        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }
		
	
	public function learn_second_lang_get ($page = false , $limit = false , $id = false)
    {
		$applicant_id = $this->get('applicant_personal_det_id');

		$table_schema = SCHEMA_ADMISSION;
        $table = $table_schema.'.'.APPLICANT_PERSONAL_DET_TABLE;
		
        $table_schema_master = SCHEMA_MASTER;
        $mtable = $table_schema_master.'.'.MOTHER_TONGUE_TABLE;
		
        $ctable = $table_schema_master.'.'.CAMPUS_TABLE;
        

        $function_name = $this->get_function_name ( __FUNCTION__ );
        $columns = 'second_lang_id  as second_lang_id,mothertongue_name as mothertongue_name,support_center_id,campus_name';
        $params = array();
        $params['table'] = $table;

		$params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['columns'] = $columns;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['id'] = $id;
        $params['pk'] = 'applicant_personal_det_id';
        $params['id_col'] = 'applicant_personal_det_id';
        $cond = array();
        $cond['applicant_personal_det_id'] = $applicant_id;        
        $params['cond'] = $cond;
        $joins = array(
            array(
                'table' => $mtable,
                'condition' => $mtable.'.mothertongue_id = '.$table.'.second_lang_id',
                'jointype' => 'LEFT'
            ),
            array(
                'table' => $ctable,
                'condition' => $ctable.'.campus_id = '.$table.'.support_center_id',
                'jointype' => 'LEFT'
            )			
        );
        $params['joins'] = $joins;
        $this->_select_table($params);
    }

	public function grad_univ_get ($page = false , $limit = false , $id = false)
    {
		$applicant_id = $this->get('applicant_personal_det_id');
		
		$applicant_appln_id = $this->get('applicant_appln_id');

		$table_schema = SCHEMA_ADMISSION;
        $table = $table_schema.'.'.APPLICANT_GRADUATION_TABLE;

        $function_name = $this->get_function_name ( __FUNCTION__ );
        $columns = '*';
        $params = array();
        $params['table'] = $table;

		$params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['columns'] = $columns;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['id'] = $id;
        $params['pk'] = 'applicant_personal_det_id';
        $params['id_col'] = 'applicant_personal_det_id';
        $cond = array();
        $cond['applicant_personal_det_id'] = $applicant_id;
		
		if($applicant_appln_id){
			$cond['applicant_appln_id'] = $applicant_appln_id;
		}
		$cond['is_curr_qualify'] = true;
        $params['cond'] = $cond;
        $this->_select_table($params);
    }
	


    /**
     * @OA\Get(
     *     path="/api/parent_titles/",
     *     tags={"user gender title"},
     *     summary="parent_titles",
     *     description="parent_titles",
     *     operationId="parent_titles",
     *     deprecated=false,
     *     
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
     * get parent_titles
     *
     * @return json response of parent_titles
     * @author
     */
     
    public function parent_titles_get() {
        $id = LOOKUP_MASTER_TITLE;
        $function_name = $this->get_function_name(__FUNCTION__);
        $cond = array();
        $is_father = $this->get('is_father',true);
        $is_mother = $this->get('is_mother',true);
        if($is_father) {
            $cond['where_not_in']['lookup_value_ref_id'] = array(LOOKUP_VALUE_TITLE_MRS_ID,LOOKUP_VALUE_TITLE_MS_ID);
        }
        if($is_mother) {
            $cond['where_not_in']['lookup_value_ref_id'] = array(LOOKUP_VALUE_TITLE_MR_ID);
        }
        $this->_get_lookup_master($function_name, $id, false, $cond);
    }

    /**
     * get application ID
     *
     * @return json response of application ID
     * @author
     */

    public function get_applicantid_post() {
        $applicant_appln_det_table = APPLICANT_APPLN;
        $table_schema = SCHEMA_ADMISSION;
        $columns = 'applicant_personal_det_id,appln_form_id,applicant_appln_id,created_by,active';
        $appln_form_id = $this->input->post('appln_form_id');
        $applicant_personal_det_id = $this->input->post('applicant_personal_det_id');
        $function_name = $this->get_function_name(__FUNCTION__);
        $params['table'] = $applicant_appln_det_table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['columns'] = $columns;
        $cond = array();
        $params['cond'] = array('appln_form_id' => $appln_form_id , 'applicant_personal_det_id' => $applicant_personal_det_id); 
        $result = $this->_select_table($params);
        return $result;
    }
    
    public function course_preference_get() {
        $table_schema = SCHEMA_ADMISSION;
        $fn_get_app_course_detail = FN_GET_CHOICE_DROPDOWN;
        $grade_id=$this->get('grade_id');
        $campus_id=$this->get('campus_id');
        $course_id=$this->get('course_id');
        $degree_id=$this->get('dgree_id');
        $spec_id=$this->get('spec_id');
        $form_id=$this->get('form_id');
        
        
        $is_course = $this->get('is_course',true);
        $is_campus = $this->get('is_campus',true);
        $is_program = $this->get('is_program',true);
        $is_degree = $this->get('is_degree',true);
        $type = $this->get('type',true);
        $is_course_spec = $this->get('is_course_spec',true);
        $column=array();
        if($is_course) {
            $column['id'] = 'prog_id';
            $column['name'] = 'branch_name';            
        }
        if($is_campus) {
            //$column='campus_id as id,campus_name as name';
            
            $column['id'] = 'campus_id';
            $column['name'] = 'campus_name';
        }
        $grade_id=!empty($grade_id) ? $grade_id : 'null';
        if($is_program) {
            //$column='campus_id as id,campus_name as name';
            
            $column['id'] = 'grad_id';
            $column['name'] = 'grad_short_name';
            $grade_id="null";
        }
        if($is_degree) {
            $column['id'] = 'deg_id';
            $column['name'] = 'deg_short_name';
            
        }
        if($is_course_spec) {
            $column['id'] = 'branch_id';
            $column['name'] = 'branch_name';
        }
        $campus_id=!empty($campus_id) ? $campus_id : 'null';
        $course_id=!empty($course_id) ? $course_id : 'null';
        $degree_id=!empty($degree_id) ? $degree_id : 'null';
        $form_id=!empty($form_id) ? $form_id : 'null';
        $spec_id=!empty($spec_id) ? $spec_id : 'null';
        $arguments=array($grade_id,$campus_id,$course_id,$degree_id,$form_id);
        if(isset($type)){
            $arguments=array($grade_id,$campus_id,$course_id,$degree_id,$form_id,PART_TIME_FORM_TYPE);
        }
        $result = $this->db_distinct_func_call($table_schema, $fn_get_app_course_detail, $arguments,$column);
       }
       
       public function qualification_status_get() {
           $table_schema = SCHEMA_ADMISSION;
           $grade_id=$this->get('grad_id');
           $form_id=$this->get('form_id');
           
           $table_schema = SCHEMA_ADMISSION;
           $table = QUALIFICATION_STATUS_TABLE;
           $mtable = GRAD_QUALIFICATION_STATUS_TABLE;
          
           $function_name = $this->get_function_name ( __FUNCTION__ );
           $columns = QUALIFICATION_STATUS_TABLE.'.qual_status_id  as id,'.QUALIFICATION_STATUS_TABLE.'.qual_status_name as name';
           $params = array();
           $params['table'] = $table;
           
           $params['table_schema'] = $table_schema;
           $params['function_name'] = $function_name;
           $params['columns'] = $columns;
           $params['page'] = $page;
           $params['limit'] = 100;
           $params['id'] = $id;
           $params[$mtable.'.pk'] = 'qual_status_id';
           $params['id_col'] = 'qual_status_id';
           $cond = array();
           $cond[$mtable.'.grad_id'] = $grade_id;
           if(!empty($form_id)){
            $cond[$mtable.'.appln_form_id'] = $form_id;
           }
           //$cond[$table.'.active'] = true;
           $params['cond'] = $cond;
           $joins = array(
               array(
                   'table' => $mtable,
                   'condition' => $mtable.'.qual_status_id = '.$table.'.qual_status_id',
                   'jointype' => 'LEFT'
               )
           );
           $params['joins'] = $joins;
           $this->_select_table($params);
           
           }
           
           public function competitive_exam_list_get() {
               
               $form_id=$_GET['form_id'];
               $form_id=!empty($form_id)?$form_id :1;
               $table_schema = SCHEMA_ADMISSION;
               $fn_get_app_exam_detail = FN_GET_APP_COMPETITIVE_EXAM_LIST;            
               $column=array();
               $column['id'] = 'comp_exam_id';
               $column['name'] = 'comp_exam_name';
               $params = array();
               $params['form_id'] = $form_id;               
               $result = $this->db_func_call($table_schema, $fn_get_app_exam_detail, $params, $column, $sort_by, $sort_order);
           }
           
           public function job_sectors_get() {
               $table_schema = SCHEMA_MASTER;               
               $form_id=$this->get('form_id');
               
               $table = JOB_SECTOR_TABLE;
               
               $function_name = $this->get_function_name ( __FUNCTION__ );
               $columns = JOB_SECTOR_TABLE.'.sector_id  as id,'.JOB_SECTOR_TABLE.'.sector_name as name';
               $params = array();
               $params['table'] = $table;
               
               $params['table_schema'] = $table_schema;
               $params['function_name'] = $function_name;
               $params['columns'] = $columns;
               $params['page'] = $page;
               $params['limit'] = $limit;
               $params['id'] = $id;
               $params[$table.'.pk'] = 'sector_id';
               $params['id_col'] = 'sector_id';
               $cond = array();
               $this->_select_table($params);
               
           }
           public function db_func_qualification_status_post() {
               $table_schema = SCHEMA_ADMISSION;
               $fn_get_app_address_detail = FN_GET_QUALIFICATION_STATUS;
               $grad_id = $this->post('grad',true);
               $form_id = $this->post('form_id',true);
               $user_data = array();
               $user_data['grad_id'] = $grad_id; 
               $user_data['form_id'] = $form_id;
               $result = $this->db_func_call($table_schema, $fn_get_app_address_detail, $user_data);
          }
		  
          public function query_categories_get() {
              $table_schema = SCHEMA_CRM;
              
              $table = TICKET_SUB_CATEGORY_TABLE;
              $mtable = TICKET_CATEGORY_TABLE;
              
              $function_name = $this->get_function_name ( __FUNCTION__ );
              $columns = TICKET_CATEGORY_TABLE.'.*,'.TICKET_SUB_CATEGORY_TABLE.'.*';
              $params = array();
              $params['table'] = $table;
              
              $params['table_schema'] = $table_schema;
              $params['function_name'] = $function_name;
              $params['columns'] = $columns;
              //$params['page'] = $page;
              $params['limit'] = 100;
              $params['id'] = $id;
              $params[$mtable.'.pk'] = 'query_cat_id';
              $params['id_col'] = 'query_cat_id';
              $cond = array();
              $cond[$mtable.'.active'] = true;
              $params['cond'] = $cond;
              $joins = array(
                  array(
                      'table' => $mtable,
                      'condition' => $mtable.'.query_cat_id = '.$table.'.query_cat_id',
                      'jointype' => 'LEFT'
                  )
              );
              $params['joins'] = $joins;
              $this->_select_table($params);
          }
          
          public function form_list_get() {
              $table_schema = SCHEMA_MASTER;              
              $table = APPLICATION_FORM;              
              $function_name = $this->get_function_name ( __FUNCTION__ );
              $columns = APPLICATION_FORM.'.appln_form_id  as id,'.APPLICATION_FORM.'.appln_form_name as name';
              
              $params = array();
              $params['table'] = $table;
              
              $params['table_schema'] = $table_schema;
              $params['function_name'] = $function_name;
              $params['columns'] = $columns;
              $params['page'] = $page;
             
              $params['id'] = $id;
              $params[$table.'.pk'] = 'appln_form_id';
              $params['id_col'] = 'appln_form_id';
              $cond = array();
              $cond[$table.'.active'] = true;
              $params['cond'] = $cond;
              $params['is_download'] = TRUE;
              $this->_select_table($params);
          }

          public function upload_final_post() {
              $app_form_id = $this->input->post('app_form_id');
              $form_wizard_upload_id = $this->input->post('upload_id');
              $is_notfinal = $this->input->post('is_notfinal');              
              $applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
              // _get_appln_form_id
              $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
              $applicant_appln_id = $applicant_appln_det_res['id'];
                            
              $application_completed = APPLICATION_IN_COMPLETED;
              $applicant_appln_det_table = APPLICANT_APPLN;
              $table_schema = SCHEMA_ADMISSION;
              $table_prefix = '';
              $submitted_on=date("Y-m-d h:i:s");
              $_SERVER["REQUEST_METHOD"] = "POST";
              $_POST['active'] = TRUE;
              $_POST['updated_by'] = $applicant_personal_det_id;
              $_POST['application_status_id'] = $application_completed;
              $_POST['applicant_appln_id'] = $applicant_appln_id;
              $_POST['applicant_personal_det_id'] = $applicant_personal_det_id;
              $function_name = $this->get_function_name(__FUNCTION__);
              
              $applicant_appln_det_columns = 'applicant_appln_id,applicant_personal_det_id,updated_by,active';
              if(empty($is_notfinal) && $is_notfinal!=1){
                  $_POST['application_submission_date'] = $submitted_on;
                  $applicant_appln_det_columns.=",application_status_id,application_submission_date";
              }
              //  applicant_personal_det insert / update		  
              // common_application_status_update
              $applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, array('applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns);
			  if($applicant_appln_det_res){
				// common_wizardupdate
				$this->common_wizardupdate($applicant_personal_det_id , $app_form_id , $form_wizard_upload_id);	
			  }			  
              
              $this->response ($applicant_appln_det_res , API_Controller::HTTP_OK);
          }
          public function mytickets_get() { 
              $applicant_id=$this->get('id');
              $table_schema = SCHEMA_CRM;
              
              $ticket_table = TICKETS_TABLE;
              $cat_table = TICKET_SUB_CATEGORY_TABLE;
              $status_table = STATUS_TABLE;
              $function_name = $this->get_function_name ( __FUNCTION__ );
              $columns = TICKETS_TABLE.'.*,'.TICKET_SUB_CATEGORY_TABLE.'.sub_category_name,'.STATUS_TABLE.'.status_name';
              $params = array();
              $params['table'] = $ticket_table;
              
              $params['table_schema'] = $table_schema;
              $params['function_name'] = $function_name;
              $params['columns'] = $columns;
              $params['limit'] = 100;
              $params['id'] = $id;
              $params['pk'] = 'ticket_id';
              $params['id_col'] = 'ticket_id';            
             // $params['sort_by'] = $this->get('sort_by');
              $params['sort_order'] = $this->get('sort_order'); 
             
              $cond = array();
              $cond[$ticket_table.'.active'] = true;
              if(!empty($applicant_id)){
                  $cond[$ticket_table.'.applicant_personal_det_id'] = $applicant_id;
              }
              $params['cond'] = $cond;
              $joins = array(
                  array(
                      'table' => $cat_table,
                      'condition' => $cat_table.'.cat_w_sub_cat_id = '.$ticket_table.'.cat_w_sub_cat_id',
                      'jointype' => 'LEFT'
                  ),
                  array(
                      'table' => $status_table,
                      'condition' => $status_table.'.status_id = '.$ticket_table.'.status_id',
                      'jointype' => 'LEFT'
                  )
              );
              $params['joins'] = $joins;
              $this->_select_table($params);
          }
          
          public function ticket_detail_get() {
              $ticket_id=$this->get('id');
              $table_schema = SCHEMA_CRM;
              
              $ticket_table = TICKETS_TABLE;
              $cat_table = TICKET_SUB_CATEGORY_TABLE;
              $status_table = STATUS_TABLE;
              $function_name = $this->get_function_name ( __FUNCTION__ );
              $columns = TICKETS_TABLE.'.*,'.TICKET_SUB_CATEGORY_TABLE.'.sub_category_name,'.STATUS_TABLE.'.status_name';
              $params = array();
              $params['table'] = $ticket_table;
              
              $params['table_schema'] = $table_schema;
              $params['function_name'] = $function_name;
              $params['columns'] = $columns;
              $params['page'] = $page;
              $params['id'] = $id;
              $params[$mtable.'.pk'] = 'ticket_id';
              $params['id_col'] = 'ticket_id';
              $cond = array();
              $cond[$ticket_table.'.active'] = true;
              if(!empty($ticket_id)){
                  $cond[$ticket_table.'.ticket_id'] = $ticket_id;
              }
              $params['cond'] = $cond;
              $joins = array(
                  array(
                      'table' => $cat_table,
                      'condition' => $cat_table.'.cat_w_sub_cat_id = '.$ticket_table.'.cat_w_sub_cat_id',
                      'jointype' => 'LEFT'
                  ),
                  array(
                      'table' => $status_table,
                      'condition' => $status_table.'.status_id = '.$ticket_table.'.status_id',
                      'jointype' => 'LEFT'
                  )
              );
              $params['joins'] = $joins;
              $this->_select_table($params);
          }
          
          public function fn_get_app_qualifications_get() {
              $table_schema = SCHEMA_ADMISSION;
              $fn_get_app_address_detail = FN_GET_QUALIFICATIONS;              
              $user_data = array();
              $result = $this->db_func_call($table_schema, $fn_get_app_address_detail, $user_data);
          }

    /**
     * get formwizard list by id
     *
     * @param degree $id form_wizard_id id
     * @return json response of form_wizard_id by id
     * @author
    */
    public function form_wizard_list_get ($id = false)
    {
        if ( $id ) {
            $this->form_wizards_list_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     * @OA\Get(
     *     path="/api/form_wizards_list/",
     *     tags={"formwizard"},
     *     summary="formwizard",
     *     description="formwizard",
     *     operationId="formwizard",
     *     deprecated=false,
     *     
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
     * get form wizard
     *
     * @return json response of user formwizard
     * @author
     */
     
    public function form_wizards_list_get($page = false , $limit = false , $id = false) {
        //$user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);

        $appln_form_id = $this->input->get('appln_form_id');
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
        $table = FORM_W_WIZARD_TABLE;
        // Set Columns
        $columns='form_w_wizard_id,appln_form_id,wizard_id,completion_percent';
        $function_name = $this->get_function_name(__FUNCTION__);
        // Parameter By Array
        $params = array();
        $params['table'] = $table_schema.'.'.$table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        $cond = array();
        if(isset($id) && $id != '')
        {
            $cond['form_w_wizard_id'] = $id;    
        }

        $cond['appln_form_id'] = $appln_form_id;   
        
        
        $params['cond'] = $cond;
        $params['pk'] = 'form_w_wizard_id';
        $params['id_col'] = 'form_w_wizard_id';


        /* $params['cond'] = $cond;*/
        // Call Select Method
        $this->_select_table($params);
    }

    public function appln_wizard_dtl_get($page = false , $limit = false )
    {
        $form_wizard_id = $this->input->get('form_wizard_id');
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
        $table = FORM_W_WIZARD_TABLE;
        $table_appln = APPLICANT_APPLN;
        // Set Columns
        $columns=$table.'.form_w_wizard_id,'.$table.'.appln_form_id,wizard_id,completion_percent';
        $function_name = $this->get_function_name(__FUNCTION__);
        // Parameter By Array
        $params = array();
        $params['table'] = $table_schema.'.'.$table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        $cond = array();
        $cond[$table.'.form_w_wizard_id'] = $form_wizard_id;
        $joins = array(
                  array(
                      'table' => $table_appln,
                      'condition' => $table_appln.'.form_w_wizard_id = '.$table.'.form_w_wizard_id',
                      'jointype' => 'INNER'
                  )
              );
        $params['joins'] = $joins;
        
        $params['cond'] = $cond;
        $params['pk'] = 'form_w_wizard_id';
        $params['id_col'] = 'form_w_wizard_id';


        /* $params['cond'] = $cond;*/
        // Call Select Method
        $this->_select_table($params);
    } 

    /**
     * get user 
     *
     * @return json response of user resident category
     * @author
     */
     
    public function user_resident_category_get() {
        $id = LOOKUP_MASTER_RESIDENT_CATEGORY;
        $function_name = $this->get_function_name(__FUNCTION__);
        //$cond = array();
        //$cond['where_not_in']['lookup_value_ref_id'] = array(LOOKUP_VALUE_TITLE_LATE_ID);
        $this->_get_lookup_master($function_name, $id, false);
    }

    /**
     * get user 
     *
     * @return json response of user relation applicant
     * @author
     */

    public function user_relation_sponsor_get() {
        $id = LOOKUP_MASTER_RELATION_TYPE;
        $function_name = $this->get_function_name(__FUNCTION__);
        $cond = array();
        $cond['where_not_in']['lookup_value_ref_id'] = array(LOOKUP_VALUE_RELATION_TYPE_GENDER_ID , LOOKUP_VALUE_RELATION_TYPE_SPOUCE_ID);
        $this->_get_lookup_master($function_name, $id, false,$cond);
    }

    /*Examination*/

    /**
     * get Examination list by id
     *
     * @param exam $id exam id
     * @return json response of exam by id
     * @author
    */
    public function examination_get ($id = false)
    {
        if ( $id ) {
            $this->examination_list_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     * @OA\Get(
     *     path="/api/form_exam_list/",
     *     tags={"formexam"},
     *     summary="formexam",
     *     description="formexam",
     *     operationId="formexam",
     *     deprecated=false,
     *     
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
     * get form wizard
     *
     * @return json response of user Examnation
     * @author
     */
     
    public function examination_list_get($page = false , $limit = false , $id = false) {
        
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
        $table = EXAMINATION_TABLE;
        // Set Columns
        $columns='examination_id as id ,examination_name as name';
        $function_name = $this->get_function_name(__FUNCTION__);
        // Parameter By Array
        $params = array();
        $params['table'] = $table_schema.'.'.$table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        $cond = array();
        if(isset($id) && $id != '')
        {
            $cond['examination_id'] = $id;    
        }
        $params['pk'] = 'examination_id';
        $params['id_col'] = 'examination_id';

        /* $params['cond'] = $cond;*/
        // Call Select Method
        $this->_select_table($params);
    }



    /*Subject*/

    /**
     * get Subject list by id
     *
     * @param Subject $id exam id
     * @return json response of Subject by id
     * @author
    */
    public function subject_get ($id = false)
    {
        if ( $id ) {
            $this->subject_list_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     * @OA\Get(
     *     path="/api/form_exam_list/",
     *     tags={"formexam"},
     *     summary="formexam",
     *     description="formexam",
     *     operationId="formexam",
     *     deprecated=false,
     *     
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
     * get form wizard
     *
     * @return json response of user Examnation
     * @author
     */
     
    public function subject_list_get($page = false , $limit = false , $id = false) {
        
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
        $table = SUBJECT_MASTER_TABLE;
        // Set Columns
        $columns='subject_id as id ,subject_name as name';
        $function_name = $this->get_function_name(__FUNCTION__);
        // Parameter By Array
        $params = array();
        $params['table'] = $table_schema.'.'.$table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        $cond = array();
        if(isset($id) && $id != '')
        {
            $cond['subject_id'] = $id;    
        }
        $params['pk'] = 'subject_id';
        $params['id_col'] = 'subject_id';

        /* $params['cond'] = $cond;*/
        // Call Select Method
        $this->_select_table($params);
    }
    public function guardian_relationships_get() {
        $id = LOOKUP_MASTER_RELATION_TYPE;
        $function_name = $this->get_function_name(__FUNCTION__);
        $cond = array();
        $cond['where_not_in']['lookup_value_ref_id'] = array(LOOKUP_VALUE_RELATION_GUARDIAN_ID , LOOKUP_VALUE_RELATION_MOTHER_ID,LOOKUP_VALUE_RELATION_FATHER_ID);
        $this->_get_lookup_master($function_name, $id, false,$cond);
    }
    
}