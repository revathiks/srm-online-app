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
*     url="http://172.16.5.221/SRM-Online-Application-New/"
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
        $columns = 'stream_id,stream_name';

        $functionName = $this->get_function_name(__FUNCTION__);
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

        $functionName = $this->get_function_name(__FUNCTION__);
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
        $columns = "country_id as id,CONCAT(country_name,' [+',country_mob_code,']') as name,CONCAT('+',country_mob_code) as code";

        $functionName = $this->get_function_name(__FUNCTION__);
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
            $columns = 'state_id,state_name,country_id';    
        }
        

        $functionName = $this->get_function_name(__FUNCTION__);
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
            $columns = 'city_id,city_name,state_id';
        }

        $functionName = $this->get_function_name(__FUNCTION__);
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
            $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
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
            $columns = $table.'.deg_id as id, '.$table.'.deg_name as name,'.$stream_table.'.stream_id';
        } else {
            // Set Columns
            $columns = $table.'.deg_id,'.$table.'.deg_name,'.$stream_table.'.stream_id';
        }

        $functionName = $this->get_function_name(__FUNCTION__);
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
            $cond['stream_id'] = $stream_id; 
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
        $params['joins'] = $joins;
        if($for_register) {
            $params['distinct'] = $columns;    
        }

        /* $params['cond'] = $cond;*/
        // Call Select Method
        $this->_select_table($params);
    }	
	
	// Dummy Grid Data Show API
	
	public function get_user_get($page = false , $limit = false , $id = false){
		// Set Schema
        $table_schema = SCHEMA_MASTER;
		// Set Table
        $table = $table_schema.'.'.FACULTY;

		// Set Columns
        $columns = '*';

        $functionName = $this->get_function_name(__FUNCTION__);
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
		$params['pk'] = $table.'.faculty_id';
        $params['id_col'] = $table.'.faculty_id';			
		/* $params['cond'] = $cond;*/
		// Call Select Method
        $this->_select_table($params);		
	}
}