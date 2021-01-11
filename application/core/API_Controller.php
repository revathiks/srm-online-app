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
 * @filesource
 * @todo       (description)
 *
 */
use chriskacerguis\RestServer\RestController;

use \Firebase\JWT\JWT;

class API_Controller extends RestController
{
    //
    public $CI;

    /**
     * An array of variables to be passed through to the
     * view, layout, ....
     */
    protected $data = array();

    /**
     * [__construct description]
     *
     * @method __construct
     */
    public function __construct()
    {
        // To inherit directly the attributes of the parent class.
        parent::__construct();

        // CI profiler
        $this->output->enable_profiler(false);

        // This function returns the main CodeIgniter object.
        // Normally, to call any of the available CodeIgniter object or pre defined library classes then you need to declare.
        $CI =& get_instance();

        //Example data
        // Site name
        $this->data['sitename'] = 'SRM';

        //Example data
        // Browser tab
        $this->data['site_title'] = ucfirst('Admin Dashboard');
        header('Content-Type: text/html; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        $this->page_limit = PAGE_LIMIT;
        $this->page_offset = PAGE_OFFSET;
        // Load the common model
        $this->load->model('common');

        // $this->load->add_package_path(RABBITMQ_CLIENT_PATH);
        // $this->load->library('Rabbitmq_client');
        // $this->load->remove_package_path(RABBITMQ_CLIENT_PATH);
    }

    /**
     * Template loading function for AdminLTE
     *
     * @method template
     *
     * @param  string   $template_name The template name
     * @param  array    $data          All extra datas you want to display
     * @param  boolean  $return        Load the complete template structure
     *                                 with the menues, sidebar, ... or only the page template
     *
     * @return [type]                  Display the template
     */
    protected function template($template_name, $data, $return)
    {
        if ($return === true) {
            $content  = $this->load->view('templates/header', $this->data);
            $content .= $this->load->view('templates/main_header', $this->data);
            $content .= $this->load->view('templates/main_sidebar', $this->data);
            $content .= $this->load->view($template_name, $this->data);
            $content .= $this->load->view('templates/footer', $this->data);
            $content .= $this->load->view('templates/control_sidebar', $this->data);

            return $content;
        } else {
            $this->load->view($template_name, $this->data);
        }
    }


    // For new set_response
    public function response_without_numeric_check($data = NULL, $http_code = NULL, $continue = FALSE)
    {
        // If the HTTP status is not NULL, then cast as an integer
        if ($http_code !== NULL)
        {
            // So as to be safe later on in the process
            $http_code = (int) $http_code;
        }

        // Set the output as NULL by default
        $output = NULL;

        // If data is NULL and no HTTP status code provided, then display, error and exit
        if ($data === NULL && $http_code === NULL)
        {
            $http_code = self::HTTP_NOT_FOUND;
        }

        // If data is not NULL and a HTTP status code provided, then continue
        elseif ($data !== NULL)
        {
            // Set the format header
            $this->output->set_content_type($this->_supported_formats[$this->response->format], strtolower($this->config->item('charset')));
            // If the format method exists, call and return the output in that format
            if (method_exists($this->format, 'to_' . $this->response->format))
            {
                if($this->response->format === 'json'){
                    $output = json_encode($data);
                }

                // An array must be parsed as a string, so as not to cause an array to string error
                // Json is the most appropriate form for such a datatype
                /*if ($this->response->format === 'array')
                {
                    $output = $this->format->factory($output)->{'to_json'}();
                }*/
            }
            else
            {
                // If an array or object, then parse as a json, so as to be a 'string'
                if (is_array($data) || is_object($data))
                {
                    $data = json_encode($data);
                }

                // Format is not supported, so output the raw data as a string
                $output = $data;
            }
        }

        // If not greater than zero, then set the HTTP status code as 200 by default
        // Though perhaps 500 should be set instead, for the developer not passing a
        // correct HTTP status code
        $http_code > 0 || $http_code = self::HTTP_OK;

        $this->output->set_status_header($http_code);

        // JC: Log response code only if rest logging enabled
        if ($this->config->item('rest_enable_logging') === TRUE)
        {
            $this->_log_response_code($http_code);
        }

        // Output the data
        $this->output->set_output($output);

        if ($continue === FALSE)
        {
            // Display the data and exit execution
            $this->output->_display();
            exit;
        }

        // Otherwise dump the output automatically
    }
    
    /** Overwrite the set_response
    * As it's default converting all string to number if string contains only numbers
    * @param NULL $data Data to be sent in api response
    * @param NULL $message Message to be sent for api
    * @param NULL $http_code Status code of api
    * @param FALSE $continueExe If want to continuwe execution 
    **/
    public function set_response($data = NULL,$message=NULL, $http_code = NULL,$continueExe = FALSE)
    {
        $response = array("status_code"=>$http_code,"message"=>$message,"data"=>$data);
        $this->response_without_numeric_check($response, $http_code, $continueExe);
    }

    /** 
    * Default Rest Controller response function is used to send response
    * @param NULL $data Data to be sent in api response
    * @param NULL $message Message to be sent for api
    * @param NULL $http_code Status code of api
    **/
    public function set_response_simple($data = NULL,$message="", $http_code = NULL)
    {
        $response = array("status_code"=>$http_code,"message"=>$message,"data"=>$data);
        $this->response($response, $http_code, TRUE);
    }

    /** 
    * Validate access token sent in headers
    * Modify this function according to your requirements
    * @param NULL $data Data to be sent in api response
    * @param NULL $message Message to be sent for api
    * @param NULL $http_code Status code of api
    **/
    public function validate_token($access_token)
    {        
        if(empty($access_token))
        {
            return $this->set_response(new stdclass(),"Access token missing",API_Controller::HTTP_BAD_REQUEST);
        }
        
        try
        {
            $token = JWT::decode($access_token, $this->config->item('jwt_key'), array('HS256'));

            $hoursDiff = (time() - $token->iat)/3600; 

            if($hoursDiff > $this->config->item('expire_time'))
            {
                return $this->set_response(new stdclass(),"Access token expired.",API_Controller::HTTP_UNAUTHORIZED);    
            }
            return $token;
        }catch(Exception $e){
            return $this->set_response(new stdclass(),"Invalid access token",API_Controller::HTTP_UNAUTHORIZED);
        }
    }
	
	public function get_accesstoken_details($response)
	{
		$decode_accesstoken = $this->call_authorization_token($response);		
		$decode_accesstoken['user_details'] = $response;	
		if($decode_accesstoken['user_details']['data']===false){
			//NOT_FOUND (404) being the HTTP response code
			$this->response(['status' => 'error','message' => $this->lang->line('error_data'),], RESTController::HTTP_NOT_FOUND);					
		}
		else
		{
			return json_encode($decode_accesstoken);
		}				
	}
	
	public function call_authorization_token($token_data){
		$this->load->library ( 'Authorization_Token' );
		//Generate Token
		$usertoken = $this->authorization_token->generateToken ( $token_data );
		$return_data['access_token'] = $usertoken;	
		return $return_data;
	}


    /**
     * common function for get master table detail/list
     *
     * @param string $table_schema current schema name
     * @param string $table current table name
     * @param string $table_prefix current table prefix
     * @param string $function_name current function name
     * @param integer $page page number
     * @param integer $limit limit to show the list
     * @param string $id id
     * @param array $columns column name of the table
     * @param string $pk primary key column name of the table
     * @param array $joins array of the joins
     * @param string $id_col id column name
     * @param string $action 
     * @param array $cond conditions
     * @param string $return_type single/something
     * @return json response of list/detail by page & limit or id
     * @author
     */
    protected function _select_table($data = array()) {


        $page = false;
        $limit = false;
        $id = false;
        $columns = false;
        $pk = false;
        $joins =false;
        $id_col = false;
        $action = false;
        $cond = false;
        $return_type = false;
        $returnresponse = false;
        $table_schema = false;
        $table_prefix = false;
        $links = true;
        $distinct = false;
        $group = false;
        $sort_by = false;
        $sort_order = false;
        $except_ids = false;
        $or_not_like = false;
        $not_like = false;
        $current_filtered = false;
        $sort_condition = 0;
        $sort_condition_text = false;
        $in_cond =false;
        $message =$this->lang->line('no_data_found');

        /*if data empty, it should be return false */
        if(empty($data)) {
            return false;   
        }

        /* extract the array data */
        extract($data);
        
        /*if table name not pass, it should be return false */
        if(!$table) {
            return false;
        }
        /*if table schema not pass, it should be set here, and it is for postgresql */
        
        if($table_schema) {
            $this->set_schema($table_schema);   
        } 
        // $this->set_schema($table_schema);   
        /* if columns not set, here has set as default columns */   
        if (!$columns) {
            $columns = $table_prefix . 'id as id, ' . $table_prefix . 'name  as name, ' . $table_prefix . 'created_at as created,' . $table_prefix . 'modified_at as modified, ' . $table_prefix . 'status as status';
        }

        /* page set for pagination count */
        $i_page = ($page) ? $page : 0;
        /* limit set for pagination count */
        $limit = $ilimit = $limit ? $limit : $this->page_limit;

        $count_con = array();
        $response = array();
        $con = array();

        /*if id has set, it should be pass the condition based on the id and id_col */
        if($id) {
            $cond[$id_col] = $id;
        }

        /* if cond has set, it should be pass the conditions parameter */
        $con['conditions'] = $cond;
        
        /* if id has set, return_type should be single, otherwise as it is */
        $con['return_type'] = $id ? 'single' : $return_type;

        /* keywords has pass by url means, we can get it here */
        $keywords = $this->get('keywords',true);
        $keywords = trim($keywords);
        /* if keywords has pass by post means, we can get it here */
        if(!$keywords) {
            $keywords = $this->post('keywords',true);
            $keywords = trim($keywords);
        }
        /* if id has empty, we should check the count here */
        if ($id == '') {
            $count_con['return_type'] = 'count';
            /* keywords url decode */
            $keywords = urldecode($keywords);
            if ($keywords) {
                /*if columns has the concat mysql keyword, it should be parsed and set in columns variable */
                $newcolumns = '';
                if(strpos($columns, 'CONCAT') !== false) {
                    $newcolumns = str_replace('CONCAT', '', $columns);
                    $newcolumns = str_replace('(', '', $newcolumns);
                    $newcolumns = str_replace(')', '', $newcolumns);
                    $newcolumns = str_replace('," ",', ',', $newcolumns);
                } else {
                    $newcolumns = $columns;
                }
                /* columns convert to array */
                $colum = explode(',', $newcolumns);

                /* remove 'AS' in columns  */
                $searchcol = preg_replace('/ as.*/', '', $colum);

                /* search keywords set in parameters */
                if (!empty($searchcol)) {
                    foreach ($searchcol as $value) {
                        $value = trim($value);

                        if($keywords === $this->lang->line('active') || $keywords === $this->lang->line('inactive')) 
                        {
                            if($keywords === $this->lang->line('active')) 
                            {
                                $count_con['search']['keywords'][$table_prefix . 'status'] = $con['search']['keywords'][$table_prefix . 'status'] = 1;
                            } 
                            else 
                            {
                                $count_con['search']['keywords'][$table_prefix . 'status'] = $con['search']['keywords'][$table_prefix . 'status'] = 0;
                            }
                        } 
                        else if (strpos($value, 'description') === false) 
                        {
                            $count_con['search']['keywords'][$value] = $con['search']['keywords'][$value] = $keywords;
                        }
                    }
                }
            }

            /* sort by & sort order has set here */
            $sort_by = ($sort_by)?$sort_by:$this->get('sort_by',true);
            $sort_by = ($sort_by)?$sort_by:$this->post('sort_by',true);
            $sort_by = preg_replace('/ as.*/', '', $sort_by);
            $sort_order = ($sort_order)?$sort_order:$this->get('sort_order',true);
            $sort_order = ($sort_order)?$sort_order:$this->post('sort_order',true);
            if (!empty($sort_by)) {
                // $count_con['search']['sort_by'] = $con['search']['sort_by'] = $table_prefix . $sort_by;
                $count_con['search']['sort_by'] = $con['search']['sort_by'] = $sort_by;
            }

            if (!empty($sort_order)) {
                $count_con['search']['sort_order'] = $con['search']['sort_order'] = $sort_order;
            }
            $count_con['search']['sort_condition'] = $con['search']['sort_condition'] = $sort_condition;
            
            /* primary key has set here */
            //$count_con['pk'] = $table.'.'.$pk;
            $count_con['pk'] = $pk;

            $count_con[ 'conditions' ] = $cond;

            $count_con[ 'joins' ] = $joins;
            $count_con[ 'distinct' ] = $distinct;
            $count_con[ 'group' ] = $group;
            $count_con[ 'or_not_like' ] = $or_not_like;
            $count_con[ 'not_like' ] = $not_like;
            $count_con[ 'in_cond' ] = $in_cond;
            $count = $this->common->get_rows($table, $table_prefix, $columns, $count_con);
            $num_pages = ceil($count / $limit);
            /*when page is not numreic, it should be zero */
            if (!is_numeric($page)) {
                $page = 0;
            }
            /*when page not set is there, page should be one */
            if (!$page) {
                $page = 1;
            }
            /*if user used filter grid in last page, we have set last page manually - start */
            if($except_ids) {
                if($page > 1) {
                    $except_ids_count = $page*$limit;
                    if($except_ids_count > $count) {
                        if($page > $num_pages) {
                            $page = $num_pages;
                        }
                    }
                }   
            }
            // echo '$page => '.$page."\n";
            /*if user used filter grid in last page, we have set last page manually - end */
            $curr_offset = ($page - 1) * $limit;

            if (($curr_offset + $limit) < ($count - 1)) {
                $cur_count = $curr_offset + $limit;
            } else {
                $cur_count = $count;
            }
            if ($id == '' && $return_type === false && $links === true) {
                $response['prev'] = '';
                if ($num_pages > 1 && ($i_page - 1) != 0) {
                    $response['prev'] = base_url() . 'api/' . $function_name . '/' . ($i_page - 1) . '/' . $ilimit;
                }
            }
            $start = $curr_offset ? $curr_offset : $this->page_offset;

            $con['start'] = $start;

            $con['limit'] = $limit;
            //unset limit variable incase of download
            if($data['is_download'] && $data['is_download']===TRUE){
                unset($con['start']);
                unset($con['limit']);
            }            
        }
        //$con['pk'] = $table.'.'.$pk;
        $con['pk'] = $pk;
        $con[ 'joins' ] = $joins;
        $con[ 'distinct' ] = $distinct;
        $con[ 'group' ] = $group;
        $con[ 'or_not_like' ] = $or_not_like;
        $con[ 'not_like' ] = $not_like;
        $con[ 'in_cond' ] = $in_cond;
        $data = $this->common->get_rows($table, $table_prefix, $columns, $con);
        // echo $this->db->last_query();
        if ($id == '' && $return_type === false) {
            if($links === true) {
                $response['next'] = '';
                if ($num_pages >= ($i_page + 1) && $i_page) {
                    $response['next'] = base_url() . 'api/' . $function_name . '/' . ($i_page + 1) . '/' . $ilimit;
                }   
            }
            $response['total'] = $count;
            $response['page'] = $page;
			// added on 29-08-2020
			$response['last_page'] = ceil($count/10);
            $response['limit'] = $limit;
            if($links === true) {
                $response['base_url'] = base_url() . 'api/' . $function_name . '/';
            }
            $response['sort_by'] = (($sort_by && $sort_condition == 0) ? $sort_condition_text : ($sort_by ? $sort_by : $con['pk']));
            $response['sort_order'] = $sort_order ? $sort_order : 'desc';
            $response['sort_condition'] = $sort_condition ? $sort_condition : 0;
            $response['keywords'] = $keywords;
            $response['except_ids'] = $except_ids;
            $response['current_filtered'] = $current_filtered;
        }
        if($return_type != 'single' && $con['return_type'] != 'single') {
            if($data) {
                $i = 0;
                if(is_array($data)) {
                    foreach($data as $k=>$v) {
                        $i++;
                        $data[$k]['serial_number'] = $i;
                    }   
                }
            }
        }

        $response['data'] = $data;
            // Check if the data exists
		if (!empty($data)) {
			// Set the response and exit
			//OK (200) being the HTTP response code
			//$this->response($response, REST_Controller::HTTP_OK);
			return $this->response_successdata($response,$returnresponse);
		} else {
			if($returnresponse)
			{
				return $this->response_successdata($response,$returnresponse);
			}
			// Set the response and exit
			//NOT_FOUND (404) being the HTTP response code
			else
			{
				return $this->response_message(FALSE,$message);
			}
			
		}
        

    }

    /**
     * get current function name
     *
     * @param string $function_name current function name
     * @return string $function_name remove get/post and then return the function name
     * @author
     */
    protected function get_function_name_bk($function_name) {
        if ($function_name) {
            if (strpos($function_name, '_') !== false) {
                $arr_function_name = explode('_', $function_name);
                return $arr_function_name[0];
            } else {
                return $function_name;
            }
        }
    }

    /**
     * get current function name
     *
     * @param string $function_name current function name
     * @return string $function_name remove get/post and then return the function name
     * @author
     */
    protected function get_function_name($function_name) {
        if ($function_name) {
            if (strrpos($function_name, '_') !== false) {
                $function_name = substr($function_name, 0, strrpos($function_name, '_'));
                return $function_name;
            } else {
                return $function_name;
            }
        }
    }	

    protected function set_schema($table_schema) {
        if(!$table_schema) {
            return false;
        }
        if($this->db->dbdriver == 'postgre' && $table_schema) {
            $this->db->simple_query('SET search_path TO ' . $table_schema . ',public');
        }    
    }

    public function response_successdata($response,$returnresponse = false)
    {
        if($returnresponse)
        {
            return $response;
        }
        else
        {
            $this->response($response, API_Controller::HTTP_OK);
        }
    }


    public function response_message($status,$message)
    {
        if($status)
        {
        $this->response(
                [
                    'status' => $status,
                    'message' => $message,
                ], API_Controller::HTTP_OK
            );
        }
        else
        {
            $this->response(
                [
                    'status' => $status,
                    'message' => $message,
                ], API_Controller::HTTP_OK
            );
        }
    }


    /**
     * common function of master table insert
     *
     * @param string $table  table name
     * @param string $table_prefix table prefix
     * @param string $function_name
     * @param array $columns array of the columns values of master tables
     * @return bool
     */
    protected function _common_insert ($table , $table_prefix , $function_name = false , $columns = false , 
        $table_schema = false)
    {
        if ( !$columns ) {
            $columns = 'name, description, id, created_at,modified_at,status';
        }
        $data = array ();

        $colum = explode ( ',' , $columns );

        /*Hide these Zero not allowed  below code Start*/
        /*foreach ($colum as $key => $value) {
            $value = trim ( $value );
            if ( !empty( $this->input->post ( $value ) ) ) {
                $data[ $table_prefix . $value ] = $this->input->post ( $value );
            } else if ( !empty( $this->post ( $value ) ) ) {
                $data[ $table_prefix . $value ] = $this->post ( $value );
            }

        }*/
        /*Hide these Zero not allowed Start*/

       /*For allow Zero Changed Like below start*/
         foreach ($colum as $key => $value) {
            $value = trim ( $value );
            $user_data = $this->input->post ( $value );
            if ( !empty( $this->input->post ( $value ) ) ) {
                $data[ $table_prefix . $value ] = $this->input->post ( $value );
            } else if ( (isset( $user_data )) && ($user_data != '') ) {
                $data[ $table_prefix . $value ] = $this->input->post ( $value );
            } else if ( !empty( $this->post ( $value ) ) ) {
                $data[ $table_prefix . $value ] = $this->post ( $value );
            }
        }
       /*For allow Zero Changed end*/

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_POST);
        // print_r($this->input->post());
        // echo '</pre>';

        if ( !$table_schema ) {
            $this->set_schema($table_schema); 
        }

        $insert = $this->common->common_insert ( $table , $table_prefix , $data );
        if ( $insert ) {
            return $insert;
        }
        else {
            return false;
        }
    }

    /**
     * common function of master table update
     *
     * @param string $table  table name
     * @param string $table_prefix table prefix
     * @param string $function_name
     * @param array $columns array of the columns values of master tables
     * @return bool
     */
    protected function _common_update ($table , $table_prefix , $function_name = false , $columns = false, $put_array = false , $id_col = false , $table_schema = false)
    {
        if ( !$columns ) {
            $columns = 'name, description, id, created_at,modified_at,status';
        }
        $data = array ();
        $id = '';
        $put_id = $this->put ( 'id' );
        $put_id = ($put_id)?$put_id:$put_array['id'];
        if(!$put_id) {
            $put_id = $this->put ( $id_col );
            $put_id = ($put_id)?$put_id:$put_array[$id_col];    
        }
        
        //$where[ $table_prefix . 'id' ] = $put_id;
        $where[$id_col ] =  $put_id;
      
        $colum = explode ( ',' , $columns );
        /* echo '<pre>';
        print_r($put_array);
        print_r($colum);
        echo '</pre>'; */

        

        $allow_empty = false;
        if(is_array($put_array))
        {
            if(array_key_exists('allow_empty', $put_array)){
                $allow_empty = $put_array['allow_empty'];
                unset($put_array['allow_empty']);                
            }
        }
    
        // echo 'value 1 => '.array_key_exists('allow_empty', $put_array)."\n";
        // if(($this->put ('set_foreignkey') === null) || !isset($put_array['set_foreignkey']))
        $set_foreignkey = false;
        if(is_array($put_array))
        {
            if(array_key_exists('set_foreignkey', $put_array)){
                $set_foreignkey = $put_array['set_foreignkey'];
                unset($put_array['set_foreignkey']);                 
            }
        }   

        foreach ($colum as $key => $value) {
            
            $value = trim ( $value );
            
            //$paramshere = $put_array['allow_empty'];
            
            //$foreign_key = $put_array['set_foreignkey'];
            // echo ' isset check => '.(isset($put_array['allow_empty']))."\n";
            // if(($this->put ('allow_empty') === null) || !isset($put_array['allow_empty']))
            
            if(!$allow_empty) {
                $ifnotempty = (!empty( $this->put ( $value ) ) || !empty( $put_array[$value] ));
            } else {
                $ifnotempty = 1;
            }
            // echo 'value 1 => '.$value."\n";
            // echo 'ifnotempty 1 => '.$ifnotempty."\n";
            if ( $ifnotempty && $value != 'status' ) {
            // if ( $value != 'status' ) {

                if($value != 'id'){

                    $put_value = $this->put ( $value, true );
                    // echo 'allow_empty => '.$allow_empty."\n";
                    //echo 'put_value => '.$value.' => '.$put_value."\n";
                    if(!isset($put_array[$value])) {
                        $put_array[$value] = null;
                    }
                    $put_value = ($put_value)?$put_value:$put_array[$value];
                    
                    $data[ $table_prefix . $value ] = $put_value;
                    
                }

            }
            elseif ( $value == 'status' ) {
                $put_status = $this->put ( 'status', true  );           

                
                $put_status = ($put_status)?$put_status:$put_array['status'];
                
                if(!$put_status) {
                    $put_status = 0;
                }
                $put_status = (string) $put_status;
                $data[ $table_prefix . 'status' ] = $put_status;
            }

        }
        //SET foreign_key_checks = 0;
        
        $var = 'SET foreign_key_checks=0';
        $var2 = 'SET foreign_key_checks=1';
        if($set_foreignkey) {
            $this->db->query($var); 
        }

        if ( !$table_schema ) {
            $this->set_schema($table_schema); 
        }
       
        $update = $this->common->common_update ( $table , $table_prefix , $data , $where );
        // echo $this->db->last_query();
        if($set_foreignkey) {
            $this->db->query($var2);
        }
        //SET foreign_key_checks = 1;
        if ( $update ) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function send_mail($subject,$message,$from,$to)
    {
        // Get full html:
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
            <title>' . html_escape($subject) . '</title>
            <style type="text/css">
                body {
                    font-family: Arial, Verdana, Helvetica, sans-serif;
                    font-size: 16px;
                }
            </style>
        </head>
        <body>
        ' . $message . '
        </body>
        </html>';
         $result = $this->email
            ->from(FORGOT_PWD_FROM)
            ->reply_to(FORGOT_PWD_FROM)    // Optional, an account where a human being reads.
            ->to(FORGOT_PWD_TO)
            ->subject($subject)
            ->message($body)
            ->send();
       return $result;       
    }

    /*Random Password Generate*/

    function rand_string( $length ) {
    $chars = "0123456789";
    return substr(str_shuffle($chars),0,$length);
    }

    protected function _set_log_params($params) {
      $table_schema = SCHEMA_LOGINFO;
      $get_type = $params['get_type'];
      $get_staff_student = $params['staff_student'];
      $columns = '';
      if($get_type == 'sms') {
        $table_name = LOGINFO_SMS_LOG;
        $columns = $table_name.'.title,'.$table_name.'.sms_cont,'.$table_name.'.mobile_no,'.$table_name.'.immediate_send,'.$table_name.'.publish_date,'.$table_name.'.processed,'.$table_name.'.sent,'.$table_name.'.active,'.$table_name.'.created_at,'.$table_name.'.updated_at,'.$table_name.'.sms_log_id,'.$table_name.'.student_id,'.$table_name.'.emp_id,';
        $pk_col_name = 'sms_log_id';
      } else if($get_type == 'mail') {
        $table_name = LOGINFO_MAIL_LOG;
        $columns = $table_name.'.subject,'.$table_name.'.mail_cont,'.$table_name.'.to_mail,'.$table_name.'.from_mail,'.$table_name.'.immediate_send,'.$table_name.'.publish_date,'.$table_name.'.processed,'.$table_name.'.sent,'.$table_name.'.active,'.$table_name.'.created_at,'.$table_name.'.updated_at,'.$table_name.'.mail_log_id,'.$table_name.'.student_id,'.$table_name.'.emp_id,';
        $pk_col_name = 'mail_log_id';
      } else if($get_type == 'notification') {
        $table_name = LOGINFO_NOTIFICATION_LOG;
        $columns = $table_name.'.title,'.$table_name.'.notifi_cont,'.$table_name.'.device_id,'.$table_name.'.device_token,'.$table_name.'.device_type_id,'.$table_name.'.immediate_send,'.$table_name.'.publish_date,'.$table_name.'.processed,'.$table_name.'.read,'.$table_name.'.active,'.$table_name.'.created_at,'.$table_name.'.updated_at,'
        .$table_name.'.notifi_log_id,'.$table_name.'.student_id,'.$table_name.'.emp_id,';
        $pk_col_name = 'notifi_log_id';
      }
      $table = $table_schema.'.'.$table_name;
      $joins = array(
          array(
              'table' => SCHEMA_LOGINFO.'.'.LOGINFO_TEMPLATE,
              'condition' => SCHEMA_LOGINFO.'.'.LOGINFO_TEMPLATE.'.temp_id = '.SCHEMA_LOGINFO.'.'.$table_name.'.temp_id AND '.SCHEMA_LOGINFO.'.'.LOGINFO_TEMPLATE.".active='true'",
              'jointype' => 'INNER'
          ),
          array(
              'table' => SCHEMA_LOGINFO.'.'.LOGINFO_TEMPLATE_TYPE,
              'condition' => SCHEMA_LOGINFO.'.'.LOGINFO_TEMPLATE_TYPE.'.temp_type_id = '.SCHEMA_LOGINFO.'.'.LOGINFO_TEMPLATE.'.temp_type_id AND '.SCHEMA_LOGINFO.'.'.LOGINFO_TEMPLATE_TYPE.".active='true'",
              'jointype' => 'INNER'
          ),
          array(
              'table' => SCHEMA_USER_MANAGEMENT.'.'.USER_MANAGEMENT_MODULE,
              'condition' => SCHEMA_USER_MANAGEMENT.'.'.USER_MANAGEMENT_MODULE.'.module_id = '.SCHEMA_LOGINFO.'.'.LOGINFO_TEMPLATE.'.module_id AND '.SCHEMA_USER_MANAGEMENT.'.'.USER_MANAGEMENT_MODULE.".active='true'",
              'jointype' => 'INNER'
          ),
        
          array(
              'table' => SCHEMA_HRD.'.'.HRD_EMPLOYEE,
              'condition' => SCHEMA_HRD.'.'.HRD_EMPLOYEE.'.employee_id = '.SCHEMA_LOGINFO.'.'.$table_name.'.emp_id AND ' .SCHEMA_HRD.'.'.HRD_EMPLOYEE.'.active='."'true'",
              'jointype' => 'LEFT'
          ),

            array(
              'table' => SCHEMA_HRD.'.'.HRD_EMP_CONTACT,
              'condition' => SCHEMA_HRD.'.'.HRD_EMP_CONTACT.'.emp_id = '.SCHEMA_HRD.'.'.HRD_EMPLOYEE .'.employee_id AND ' .SCHEMA_HRD.'.'.HRD_EMP_CONTACT.'.active='."'true'",
              'jointype' => 'LEFT'
          ),
          array(
              'table' => SCHEMA_ACADEMICS.'.'.ACADEMICS_STUDENT_MASTER,
              'condition' => SCHEMA_ACADEMICS.'.'.ACADEMICS_STUDENT_MASTER.'.student_id = '.SCHEMA_LOGINFO.'.'.$table_name.'.student_id AND '.SCHEMA_ACADEMICS.'.'.ACADEMICS_STUDENT_MASTER.".active='true'",
              'jointype' => 'LEFT'
          ),
          array(
              'table' => SCHEMA_ACADEMICS.'.'.ACADEMICS_STUD_CONTACT,
              'condition' => SCHEMA_ACADEMICS.'.'.ACADEMICS_STUD_CONTACT.'.student_id = '.SCHEMA_ACADEMICS.'.'.ACADEMICS_STUDENT_MASTER.'.student_id AND '.SCHEMA_ACADEMICS.'.'.ACADEMICS_STUD_CONTACT.".active='true'",
              'jointype' => 'LEFT'
          )
          /*array(
              'table' => SCHEMA_HRD.'.'.HRD_EMPLOYEE .' AS send_by_emp',
              'condition' => 'send_by_emp.employee_id = '.SCHEMA_LOGINFO.'.'.$table_name.'.send_by AND send_by_emp.active='."'true'",
              'jointype' => 'INNER'
          )*/
      );
      
      
      $tablePrefix = '';
      // $columns = LOGINFO_SMS_LOG.'.title,'.LOGINFO_SMS_LOG.'.sms_cont,'.LOGINFO_SMS_LOG.'.mobile_no,'.LOGINFO_SMS_LOG.'.immediate_send,'.LOGINFO_SMS_LOG.'.publish_date,'.LOGINFO_SMS_LOG.'.processed,'.LOGINFO_SMS_LOG.'.sent,'.LOGINFO_SMS_LOG.'.active,'.LOGINFO_SMS_LOG.'.created_at,'.LOGINFO_SMS_LOG.'.updated_at,'.USER_MANAGEMENT_MODULE.'.module_name,'.USER_MANAGEMENT_MODULE.'.module_short_name,'.LOGINFO_TEMPLATE_TYPE.'.temp_type_name,'.LOGINFO_TEMPLATE_TYPE.'.temp_type_short_name,'.ACADEMICS_STUDENT_MASTER.'.first_name,'.ACADEMICS_STUDENT_MASTER.'.middle_name,'.ACADEMICS_STUDENT_MASTER.'.last_name,emp.first_name,emp.middle_name,emp.last_name,send_by_emp.first_name,send_by_emp.middle_name,send_by_emp.last_name';
     /* $columns .= USER_MANAGEMENT_MODULE.'.module_name,'.USER_MANAGEMENT_MODULE.'.module_short_name,'.LOGINFO_TEMPLATE_TYPE.'.temp_type_name,'.LOGINFO_TEMPLATE_TYPE.'.temp_type_short_name,'.HRD_EMPLOYEE.'.first_name,'.HRD_EMPLOYEE.'.middle_name,'.HRD_EMPLOYEE.'.last_name,'.HRD_EMP_CONTACT.'.email as email_id,'.HRD_EMP_CONTACT.'.alter_email as per_email_id';*/

     $columns .= USER_MANAGEMENT_MODULE.'.module_name,'.USER_MANAGEMENT_MODULE.'.module_short_name,'.LOGINFO_TEMPLATE_TYPE.'.temp_type_name,'.LOGINFO_TEMPLATE_TYPE.'.temp_type_short_name,';

     
      $columns .= '(CASE 
            WHEN '.$table.'.student_id IS NULL THEN ('.HRD_EMP_CONTACT.'.email) 
            WHEN '.$table.'.emp_id IS NULL THEN  ('.ACADEMICS_STUD_CONTACT.'.email) 
        END) as email_id,';

      $columns .= '(CASE 
            WHEN '.$table.'.student_id IS NULL THEN ('.HRD_EMPLOYEE.'.first_name) 
            WHEN '.$table.'.emp_id IS NULL THEN  ('.ACADEMICS_STUDENT_MASTER.'.first_name) 
        END) as first_name,';

       $columns .= '(CASE 
            WHEN '.$table.'.student_id IS NULL THEN ('.HRD_EMPLOYEE.'.last_name) 
            WHEN '.$table.'.emp_id IS NULL THEN  ('.ACADEMICS_STUDENT_MASTER.'.last_name) 
        END) as last_name,';

      $columns .= '(CASE 
            WHEN '.$table.'.student_id IS NULL THEN ('.HRD_EMPLOYEE.'.middle_name) 
            WHEN '.$table.'.emp_id IS NULL THEN  ('.ACADEMICS_STUDENT_MASTER.'.middle_name) 
        END) as middle_name,';

       $columns .= '(CASE 
            WHEN '.$table.'.student_id IS NULL THEN ('.HRD_EMP_CONTACT.'.alter_email) 
            WHEN '.$table.'.emp_id IS NULL THEN  ('.ACADEMICS_STUD_CONTACT.'.alter_email) 
        END) as per_email_id,';

      $params['table'] = $table;
      $params['table_schema']=$table_schema;
      $params['columns'] = $columns;
      $params['pk'] = $pk_col_name;
      $params['table_prefix'] = $table_prefix;
      $params['joins'] = $joins;
      return $params;
    }

    /*Otp Verify TIme*/
    function Otptimeverify( $dbtime ) {
            $dbtimestamp = strtotime($dbtime);
            if (time() - $dbtimestamp > 15 * 60) {
                return $this->response_message('error',OTP_EXPIRY);
               }
               
    }

    function verify_link_time( $dbtime ) {
        $dbtimestamp = strtotime($dbtime);
        if (time() - $dbtimestamp > 15 * 60) {
            return $this->response_message('error',VERIFY_LINK_TIME_EXPIRY);
        }      
    }

    public function common_send_mail($subject,$message,$from,$to)
    {
        // Get full html:
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
            <title>' . html_escape($subject) . '</title>
            <style type="text/css">
                body {
                    font-family: Arial, Verdana, Helvetica, sans-serif;
                    font-size: 16px;
                }
            </style>
        </head>
        <body>
        ' . $message . '
        </body>
        </html>';
         $result = $this->email
            ->from($from)
            ->reply_to($from)    // Optional, an account where a human being reads.
            ->to($to)
            ->subject($subject)
            ->message($body)
            ->send();
       return $result;       
    }

    public function db_func_call($table_schema, $db_func_name, $applicant_personal_det_id, $columns = false, $sort_by = false, $sort_order = false, $returnresponse = false, $where = array()) {
        $message =$this->lang->line('no_data_found');
        $data = $this->common->db_func_call($table_schema, $db_func_name, $applicant_personal_det_id, $columns, $sort_by, $sort_order,$where);
        // $data = array_unique($data);
        $response['data'] = $data;
        // Check if the data exists
        if (!empty($data)) {
            // Set the response and exit
            //OK (200) being the HTTP response code
            //$this->response($response, REST_Controller::HTTP_OK);
            return $this->response_successdata($response,$returnresponse);
        } else {
            if($returnresponse)
            {
                return $this->response_successdata($response,$returnresponse);
            }
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            else
            {
                return $this->response_message(FALSE,$message);
            }
            
        }
    }
	
	public function db_func_call_dde($table_schema, $db_func_name, $applicant_personal_det_id,$col1,$col2, $returnresponse = false) {
        $message =$this->lang->line('no_data_found');
        $data = $this->common->db_func_call_dde($table_schema, $db_func_name, $applicant_personal_det_id,$col1,$col2);
        $response['data'] = $data;
        // Check if the data exists
        if (!empty($data)) {
            // Set the response and exit
            //OK (200) being the HTTP response code
            //$this->response($response, REST_Controller::HTTP_OK);
            return $this->response_successdata($response,$returnresponse);
        } else {
            if($returnresponse)
            {
                return $this->response_successdata($response,$returnresponse);
            }
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            else
            {
                return $this->response_message(FALSE,$message);
            }
        }
    }	

    protected function _get_appln_form_id($applicant_personal_det_id,$appln_form_id, $is_need_all_data = false) {
        // $app_form_id_btech = APP_FORM_ID_BTECH;
        $applicant_appln_det_table = APPLICANT_APPLN;
        $table_schema = SCHEMA_ADMISSION;
        $table_prefix = '';

        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['active'] = TRUE;
        $_POST['appln_form_id'] = $appln_form_id;
        $_POST['applicant_personal_det_id'] = $applicant_personal_det_id;

        $applicant_appln_det_columns = 'applicant_personal_det_id,appln_form_id,active';
        $applicant_appln_det_columns .= $applicant_appln_id_col = ',applicant_appln_id';

        $check_user = $this->check_exist_user($applicant_appln_det_table, $table_schema, $applicant_appln_det_columns, array('applicant_personal_det_id'=>$applicant_personal_det_id,'appln_form_id'=>$appln_form_id));
        
        if(empty($check_user['data'])) {
            $applicant_appln_det_columns .= $applicant_appln_id_col .= ',created_by';
            $applicant_appln_det_columns = str_replace($applicant_appln_id_col, '', $applicant_appln_det_columns);
            $applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'appln_form_id'=>$appln_form_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns,false,'applicant_appln_id',false);
        } else {
            $applicant_appln_det_res['id'] = $check_user['data'][0]['applicant_appln_id'];
        }
        if($is_need_all_data != false) {
            $applicant_appln_det_columns = 'applicant_appln_id,applicant_personal_det_id,appln_form_id,form_name,form_start_date,appln_mode,appln_no,qualifyingexamfromindia,degree_id,degree_name,applicant_name_declaration,applicant_parentname_declaration,applicant_declaration_date,active,created_by,created_at,updated_by,updated_at,grad_id,is_agree';
            $applicant_appln_det_res = $this->check_exist_user($applicant_appln_det_table, $table_schema, $applicant_appln_det_columns, array('applicant_appln_id'=>$applicant_appln_det_res['id']));
        }
        return $applicant_appln_det_res;
    }

    protected function _get_form_wizard_id($appln_form_id,$wizard_id, $is_need_all_data = false) {
        // $app_form_id_btech = APP_FORM_ID_BTECH;
        $table = FORM_W_WIZARD_TABLE;
        $table_schema = SCHEMA_ADMISSION;
        $table_prefix = '';
        $function_name = $this->get_function_name(__FUNCTION__);
        $columns='form_w_wizard_id,appln_form_id,wizard_id,completion_percent';
        $params = array();
        $params['table'] = $table_schema.'.'.$table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['columns'] = $columns;
        $params['returnresponse']=TRUE;        
        $params['cond'] = array($table.'.appln_form_id' => $appln_form_id,$table.'.wizard_id' => $wizard_id); 
        $result = $this->_select_table($params);
        return $result;
    }

    public function check_exist_user ($table , $table_schema , $columns ,  $applicant_personal_det_id, $type = false, $pk_id_col = false, $pk_id_val = false, $form_id = false)
    {
        $function_name = $this->get_function_name(__FUNCTION__);
        $params = array();
        $params['table'] = $table_schema.'.'.$table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['columns'] = $columns;
        $params['returnresponse']=TRUE;
        if(is_array($applicant_personal_det_id)) {
            $cond = array();
            foreach($applicant_personal_det_id as $k=>$v) {
                $cond[$k] = $v;
            }
            $params['cond'] = $cond;
        } else {
            $params['cond'] = array($table.'.applicant_personal_det_id' => $applicant_personal_det_id); 
        }
            
        if($type == 1 && $pk_id_val) {
            $params['cond'][$pk_id_col] = $pk_id_val;
        }
        if($form_id) {
            $params['cond']['appln_form_id'] = $form_id;    
        }
        //$params['cond'] = array('user_name' => $user_data['username'] , $urtable.'.role_id' => $user_data['role_id']);    
        $result = $this->_select_table($params);
        //echo $this->db->last_query();
        return $result;
    }

    protected function _insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $table, $columns, $type = false, $pk_id_col = false, $pk_id_val = false, $form_id = false) 
    {
        $res = false;
        $table_prefix = '';
        $check_user = $this->check_exist_user($table, $table_schema, $columns,  $applicant_personal_det_id,$type,$pk_id_col,$pk_id_val,$form_id);
        // echo $this->db->last_query();
        // echo '<pre>';
        // print_r($check_user);                    
        // print_r($check_user['data']);
        // echo '</pre>';
        // die;
        // echo 'pk_id_col => '.$pk_id_col."\n";
        // echo 'pk_id_val => '.$pk_id_val."\n";
        if($type == 1 && $pk_id_val) {
            $update = true;
        } else if($type == 1 && !$pk_id_val) {
            $update = false;
        } else {
            $update = true;
        }
        // echo 'update => '.$update."\n";
        if(isset($check_user['data']) && !empty($check_user['data']) && $update)
        {
            $columns .=',updated_by';
            $put_array = $this->post();
            $put_array['allow_empty']=TRUE;
            $put_array = array_merge($put_array,$this->input->post());
            // $put_array[$table_prefix.'id'] = $applicant_personal_det_id;
            if($type == 1) {                
                $update = $this->_common_update ( $table , $table_prefix , $function_name , $columns , $put_array ,  $pk_id_col,$table_schema);
            } else if($type == 2) {
                $where = array();
                if(is_array($applicant_personal_det_id)) {
                    foreach($applicant_personal_det_id as $k=>$v) {
                        $where[$k] = $v;
                    }
                } else {
                    $where['applicant_personal_det_id'] = $applicant_personal_det_id;
                }
                $arr_columns = explode(',', $columns);
                $new_put_array = array();
                if($put_array) {
                    foreach($put_array as $k=>$v) {
                        // columns search in key
                        if(strpos($columns, $k) !== false) {
                            // exact match with columns
                            if($arr_columns) {
                                foreach($arr_columns as $k1=>$v1) {
                                    if(preg_match("/\b".preg_quote($k)."\b/i", $v1)) {
                                        $new_put_array[$k] = $v;        
                                    }       
                                }
                            }
                        }
                    }
                }

                $update = $this->common->common_update ( $table ,$table_prefix , $new_put_array, $where);
            } else {
                $where = array();
                if(is_array($applicant_personal_det_id)) {
                    foreach($applicant_personal_det_id as $k=>$v) {
                        $where[$k] = $v;
                    }
                } else {
                    $where['applicant_personal_det_id'] = $applicant_personal_det_id;
                }
                $arr_columns = explode(',', $columns);
                $new_put_array = array();
                if($put_array) {
                    foreach($put_array as $k=>$v) {
                        // columns search in key
                        if(strpos($columns, $k) !== false) {
                            // exact match with columns
                            if($arr_columns) {
                                foreach($arr_columns as $k1=>$v1) {
                                    if(preg_match("/\b".preg_quote($k)."\b/i", $v1)) {
                                        $new_put_array[$k] = $v;        
                                    }       
                                }
                            }
                        }
                    }
                }

                $update = $this->common->common_update ( $table ,$table_prefix , $new_put_array, $where);
                // $update = $this->_common_update ( $table , $table_prefix , $function_name , $columns , $put_array ,  'applicant_personal_det_id',$table_schema);
            }
            if($update){
                $res = [
                    'status' => 'true' ,
                    'type' => $table ,
                    'id' => $pk_id_val ,
                    'message' => RECORD_UPDATE_SUCCESSFULLY,
                ];
            } else {
                $res = [
                    'status' => 'error' ,
                    'type' => $table ,
                    'message' => ERROR_MSG,
                ];
            }
        }
        else
        {
            $columns .=',created_by';
            // echo 'insert => '."\n";
            $insert = $this->_common_insert ( $table , $table_prefix , $function_name , $columns , $table_schema );
            
            $insert_id = $this->common->_get_last_insert_id($table_schema, $table, $pk_id_col);
            if($insert) {
                $res = [
                    'status' => 'true' ,
                    'type'  => $table ,
                    'id'    => $insert_id ,
                    'message' => RECORD_ADDED_SUCCESSFULLY,
                ];
            } else {
                $res = [
                    'status' => 'error' ,
                    'type' => $table ,
                    'message' => ERROR_MSG,
                ];
            }
        }
        return $res;
    }
    
    public function db_distinct_func_call($table_schema, $db_func_name, $arguments,$column,$returnresponse = false) {
        $message =$this->lang->line('no_data_found');
        $data = $this->common->db_distinct_func_call($table_schema, $db_func_name, $arguments,$column);
        $response['data'] = $data;
        // Check if the data exists
        if (!empty($data)) {
            // Set the response and exit
            //OK (200) being the HTTP response code
            //$this->response($response, REST_Controller::HTTP_OK);
            return $this->response_successdata($response,$returnresponse);
        } else {
            if($returnresponse)
            {
                return $this->response_successdata($response,$returnresponse);
            }
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            else
            {
                return $this->response_message(FALSE,$message);
            }
            
        }
    }
    
    public function _get_common_error_status($res) {
        if($res) {
            $arr_res = array_column($res, 'status');
            $arr_res = array_unique($arr_res);
            if(in_array('error', $arr_res)) {
                $arr_res_key = array_search('error', $arr_res);
                $this->response ($res[$arr_res_key] , API_Controller::HTTP_OK);
            }
        }
    }
	
	protected function _get_applicant_appln_detail($function_name,$tableapplicant_appln ,$pk_id,$id, $return = false, $cond = array()) {
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
        //$table = 'applicant_graduation_det';

		$table  = $tableapplicant_appln;
        // $stable = TABLE_LOOKUP_VALUE;
        // Set Columns
        $columns = "applicant_personal_det_id as applicant_personal_det_id,applicant_appln_id,form_w_wizard_id,appln_no";

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
        $params['pk'] = $pk_id;
        $params['id_col'] = $pk_id;
        $cond = ($cond)?$cond:array();
        // $cond['active'] = 't';        
        $cond['applicant_personal_det_id'] = $id;        
        $params['cond'] = $cond;
		$params['returnresponse'] = $return;
        // Call Select Method
        return $result_user = $this->_select_table($params);
		
    }	
	
	function tab_w_percentage($applicant_personal_det_id,$applicant_appln_id,$return) {
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
		$table  = APPLICANT_APPLN;
		$table2  = 'form_w_wizard';
        // Set Columns
        $columns = "completion_percent,applicant_appln_id,applicant_personal_det_id";

        // Parameter By Array
        $params = array();
        $params['table'] = $table2;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        $params['pk'] = $pk_id;
        $params['id_col'] = $pk_id;
        $cond = ($cond)?$cond:array();    
        $cond['applicant_personal_det_id'] = $applicant_personal_det_id;
		$cond['applicant_appln_id'] = $applicant_appln_id;		
		$joins = array(
			array(
				'table' => $table,
				'condition' => $table.'.form_w_wizard_id = '.$table2.'.form_w_wizard_id',
				'jointype' => 'LEFT'
			),           
        );		
		$params['joins'] = $joins;
        $params['cond'] = $cond;
		$params['returnresponse'] = $return;
        // Call Select Method
		return $result_user = $this->_select_table($params);
    }	
	
	//Common Wizard Update Start
	function common_wizardupdate($applicant_personal_det_id , $app_form_id , $wizard_id)
	{		
		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);

		$applicant_appln_id = $applicant_appln_det_res['id'];

		$formwizard_res = $this->_get_form_wizard_id($app_form_id,$wizard_id);
		$form_wizardid = $formwizard_res['data'][0]['form_w_wizard_id'];
		$completion_percent = $formwizard_res['data'][0]['completion_percent'];
		$function_name = $this->get_function_name ( __FUNCTION__ );
		
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['form_w_wizard_id'] = $form_wizardid;
		$_POST['applicant_personal_det_id'] = $applicant_personal_det_id;
		$applicant_appln_det_table = APPLICANT_APPLN;
		$applicant_appln_det_column='form_w_wizard_id';
		$table_schema =SCHEMA_ADMISSION;
		$pk_id = 'applicant_appln_id';
		
		// $cond = array('applicant_appln_id'=>$applicant_appln_id);
		// $check_form_w_wizard_id = $this->_get_applicant_appln_detail($function_name,$applicant_appln_det_table ,$pk_id,$applicant_personal_det_id, true, $cond);
		
		$check_form_w_wizard_id = $this->tab_w_percentage($applicant_personal_det_id,$applicant_appln_id,true);
		
		if($wizard_id!=FORM_WIZARD_PAYMENT_ID){
			if($check_form_w_wizard_id['data'][0]['completion_percent'] < $completion_percent)
			{
				$function_name = $this->get_function_name ( __FUNCTION__ );
				$applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_column,false,'applicant_appln_id');
				return $applicant_appln_det_res;
			} 
		}else{
			$function_name = $this->get_function_name ( __FUNCTION__ );
			$applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_column,false,'applicant_appln_id');
			return $applicant_appln_det_res;			
		}
	}
	//Common Wizard Update End	
	
	//Common Wizard Update Start
	/* function common_wizardupdate($applicant_personal_det_id , $app_form_id , $wizard_id)
	{		
		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);

		$applicant_appln_id = $applicant_appln_det_res['id'];

		$formwizard_res = $this->_get_form_wizard_id($app_form_id,$wizard_id);
		$form_wizardid = $formwizard_res['data'][0]['form_w_wizard_id'];

		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['form_w_wizard_id'] = $form_wizardid;
		$_POST['applicant_personal_det_id'] = $applicant_personal_det_id;
		$applicant_appln_det_table = APPLICANT_APPLN;
		$applicant_appln_det_column='form_w_wizard_id';
		$table_schema =SCHEMA_ADMISSION;


		if($wizard_id != FORM_WIZARD_PAYMENT_ID)
		{
			$function_name = $this->get_function_name ( __FUNCTION__ );
			$applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_column,false,'applicant_appln_id');
			return $applicant_appln_det_res;
		}
	} */
	//Common Wizard Update End

    public function common_application_status_update($applicant_id, $applicant_appln_det_id, $app_status = false) {
        
		if ($app_status){
            $app_status = APPLICATION_IN_PROGRESS;
		} 
		else 
		{
			$app_status = APPLICATION_IN_COMPLETED;
		}
		
        $table_schema = SCHEMA_ADMISSION;
        $table_appln = $table_schema.'.'.APPLICANT_APPLN;
        $whereaad['applicant_personal_det_id'] = $applicant_id;
        $whereaad['applicant_appln_id'] = $applicant_appln_det_id;
        $put_arrayaad['table_schema'] = SCHEMA_ADMISSION;
        $put_arrayaad['application_status_id'] = $app_status;
        $update = $this->common->common_update ( $table_appln ,'' , $put_arrayaad, $whereaad);
        return $res;    
    }	
    //application no update
    function appln_no_update($applicant_appln_id,$applicant_personal_det_id , $app_form_id)
    {
        $function_name = $this->get_function_name ( __FUNCTION__ );
        $table = APPLICANT_APPLN;      
        $table_schema =SCHEMA_ADMISSION;
        $seq="";
        $result=array();
        //check appln no exists
        $pk_id = 'applicant_appln_id';
        $cond = array('applicant_appln_id'=>$applicant_appln_id);
        $check_appln_no = $this->_get_applicant_appln_detail($function_name,$table ,$pk_id,$applicant_personal_det_id, true, $cond);
        $exist_appln_no=$check_appln_no['data'][0]['appln_no'];
        $app_sequences=$this->config->item('app_sequences');        
        $seq=$app_sequences[$app_form_id];
        if($seq!="" && !empty($seq) && empty($exist_appln_no)){
         $result = $this->common->update_appln_no ( $table_schema,$table,$seq,$applicant_appln_id,$applicant_personal_det_id);
        }
		// This part for Mtech research Part & Tamil Perayam Right now there is no Sequence no 
        else if ($seq=='' && $app_form_id=='18' || $app_form_id=='28' ||  $app_form_id=='21' ||  $app_form_id=='30' ||  $app_form_id=='29')
		{
		$seq=rand(10,20000000);
		
		$result = $this->common->update_appln_no ( $table_schema,$table,$seq,$applicant_appln_id,$applicant_personal_det_id);	
		}
        return $result;        
    }
    //application no update End
	
	protected function _get_error_status($res) {
		if($res) {
			$arr_res = array_column($res, 'status');
			$arr_res = array_unique($arr_res);
			if(in_array('error', $arr_res)) {
				$arr_res_key = array_search('error', $arr_res);
				$this->response ($res[$arr_res_key] , API_Controller::HTTP_OK);
			}
		}
	}

    protected function _get_prog_id_by_preference_dtl($grad_id, $deg_id = false, $form_id, $course_pref, $specialization_pref = false, $campus_pref = false, $grad_mode_id = false) {
        $table_schema = SCHEMA_ADMISSION;
        $fn_get_choice_dropdown = FN_GET_CHOICE_DROPDOWN;

        $column = $arr_prog_id = array();
        $column['id'] = 'prog_id';
        $column['name'] = 'prog_name';

        if($course_pref) {
            foreach($course_pref as $k=>$v) {
                $branch_id = $v;
                if($specialization_pref) {
                    $spec_id = $specialization_pref[$k];    
                }
                $campus_id = false;
                if($campus_pref) {
                    $campus_id = $campus_pref[$k];  
                }
                $params = array();
                $params['grad_id'] = $grad_id;
                $params['campus_id'] = $campus_id;  
                $params['branch_id'] = $branch_id;
                $params['deg_id'] = $deg_id;
                $params['form_id'] = $form_id;

                
                
                if($grad_mode_id) {
                    $params['grad_mode_id'] = $grad_mode_id;
                }
                $where = array();
                if($spec_id) {
                    $where['spec_id'] = ' = '.$spec_id;
                } else {
                    $where['spec_id'] = ' IS NULL ';
                }
                
                $arr_prog_id[$k] = false;
                if($branch_id) {
                    $res = $this->db_func_call($table_schema, $fn_get_choice_dropdown, $params, $column, false, false,true, $where);
                    $arr_prog_id[$k] = $res['data'][0]['id'];
                }
            }
        }
        return $arr_prog_id;
    }	
	
	// International Permanent / Communication Address 
	
	protected function international_cp_address($table , $table_schema , $columns , $applicant_personal_det_id,$applicant_appln_id,$addr_type_id){
		
		$function_name = $this->get_function_name(__FUNCTION__);
		$check_user = $this->check_exist_user($table , $table_schema , $columns ,  array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'addr_type_id'=>$addr_type_id));
		
		if($check_user['data'][0]['addr_type_id']==$addr_type_id && !empty($check_user['data']))
		{
			//$put_array = $this->post();
			$put_array=$_POST;
			$put_array['allow_empty']=TRUE;
			$where = array();
			$where['applicant_personal_det_id'] = $applicant_personal_det_id;
			$where['applicant_appln_id'] = $applicant_appln_id;
			$where['addr_type_id'] = $addr_type_id;
			$arr_columns = explode(',', $columns);
			$new_put_array = array();
			if($put_array) {
				foreach($put_array as $k=>$v) {
					// columns search in key
					if(strpos($columns, $k) !== false) {
						// exact match with columns
						if($arr_columns) {
							foreach($arr_columns as $k1=>$v1) {
								if(preg_match("/\b".preg_quote($k)."\b/i", $v1)) {
									$new_put_array[$k] = $v;		
								}		
							}
						}
					}
				}
			}

			$update = $this->common->common_update ( $table ,$table_prefix , $new_put_array, $where);
			
			if($update){
				return true;
			}
		}
		else
		{
			$insert = $this->_common_insert ( $table , $table_prefix , $function_name , $columns , $table_schema );
			if($insert){
				return true;
			}
		}	
	}
	
	protected function _get_prog_id_by_branch($grade_id,$course_id,$degree_id, $form_id,$type,$campus_id=false,$spec_id=false) {
	    $table_schema = SCHEMA_ADMISSION;
	    $fn_get_app_course_detail = FN_GET_CHOICE_DROPDOWN;	    
	    $column = $arr_prog_id = array();
	    $column['id'] = 'prog_id';
	    $column['name'] = 'prog_name';
	    $resultData=array();
	    $campus_id=!empty($campus_id) ? $campus_id : 'null';
	    $course_id=!empty($course_id) ? $course_id : 'null';
	    $degree_id=!empty($degree_id) ? $degree_id : 'null';
	    $form_id=!empty($form_id) ? $form_id : 'null';
	    $spec_id=!empty($spec_id) ? $spec_id : 'null';
	    
	    $arguments=array($grade_id,$campus_id,$course_id,$degree_id,$form_id);
	    if(isset($type)){
	        $arguments=array($grade_id,$campus_id,$course_id,$degree_id,$form_id,PART_TIME_FORM_TYPE);
	    }
	    $result = $this->db_distinct_func_call($table_schema, $fn_get_app_course_detail, $arguments,$column,true);
	    if($result['data'][0]['id']){
	        $resultData=$result['data'][0]['id'];
	    }
	    return $resultData;
	}	
}

