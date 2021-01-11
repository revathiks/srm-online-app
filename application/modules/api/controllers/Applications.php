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
class Applications extends API_Controller {

	public function __construct()
	{		
		parent::__construct();
		$this->load->library('form_validation');
	}

	// public function check_exist_user ($table , $table_schema , $columns ,  $applicant_personal_det_id, $type = false, $pk_id_col = false, $pk_id_val = false, $form_id = false)
	// {
	// 	$function_name = $this->get_function_name(__FUNCTION__);
	// 	$params = array();
	// 	$params['table'] = $table_schema.'.'.$table;
	// 	$params['table_schema'] = $table_schema;
	// 	$params['function_name'] = $function_name;
	// 	$params['columns'] = $columns;
	// 	$params['returnresponse']=TRUE;
	// 	if(is_array($applicant_personal_det_id)) {
	// 		$cond = array();
	// 		foreach($applicant_personal_det_id as $k=>$v) {
	// 			$cond[$k] = $v;
	// 		}
	// 		$params['cond'] = $cond;
	// 	} else {
	// 		$params['cond'] = array($table.'.applicant_personal_det_id' => $applicant_personal_det_id);	
	// 	}
			
	// 	if($type == 1 && $pk_id_val) {
	// 		$params['cond'][$pk_id_col] = $pk_id_val;
	// 	}
	// 	if($form_id) {
	// 		$params['cond']['appln_form_id'] = $form_id;	
	// 	}
	// 	//$params['cond'] = array('user_name' => $user_data['username'] , $urtable.'.role_id' => $user_data['role_id']);	
	// 	$result = $this->_select_table($params);
	// 	// echo $this->db->last_query();
	// 	return $result;
	// }

	public function addressdet_post()
	{
		$table = TABLE_APPLICANT_ADDR_DET;
		$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';
		$applicant_personal_det_id = $this->input->post('applicant_personal_det_id');
		$app_form_id = $this->input->post('app_form_id');				
		$is_wizard_with_parent = $this->input->post('is_wizard_with_parent');				
		$is_wizard_with_parent = ($is_wizard_with_parent)?$is_wizard_with_parent:false;
		// get applicant form pk id
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);

		$applicant_appln_id = $applicant_appln_det_res['id'];
		
		$country_id = $this->input->post('country_id');
		$country_india=COUNTRY_VALUE_DEFAULT;
		
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST['addr_type_id'] = LOOKUP_VALUE_ADDRESS_COMMUNICATION;
		$_POST['active'] = TRUE;
		$_POST['applicant_appln_id'] = $applicant_appln_id;

		//$applicant_personal_det_id = $this->input->post('applicant_personal_det_id');
		if($country_india==$country_id){
		$columns = 'addr_type_id,applicant_personal_det_id,applicant_appln_id,country_id,
		address_line_1,pincode,active,address_line_2,active,state_id,city_id,district_id';
		}else{
		$columns = 'addr_type_id,applicant_personal_det_id,applicant_appln_id,country_id,
		address_line_1,pincode,active,address_line_2,active';			
		}
			
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('country_id', 'Country Id','trim|required');
		if($country_id==$country_india){
		    $this->form_validation->set_rules('state_id', 'State Id','trim|required');
		    $this->form_validation->set_rules('district_id', 'District Id','trim|required');
		    $this->form_validation->set_rules('city_id', 'City Id','trim|required');
		}

		$state_id_post = $this->input->post('state_id');
		$city_id_post = $this->input->post('city_id');
		$district_id_post = $this->input->post('district_id');
		$country_id_post = $this->input->post('country_id');

		if($country_id==$country_india){
		$state_id_post=($state_id_post != '' && $state_id_post !='null')?$state_id_post : NULL;
		$city_id_post=($city_id_post != '' && $city_id_post !='null')?$city_id_post : NULL;
		$district_id_post=($district_id_post != '' && $district_id_post !='null')?$district_id_post : NULL;
		}
		else {
			$state_id_post = NULL;
			$city_id_post = NULL;
			$district_id_post = NULL;
		}

		$_POST['state_id'] = $state_id_post;
		$_POST['city_id']=$city_id_post;
		$_POST['district_id']=$district_id_post;

		$this->form_validation->set_rules('address_line_1', 'Address 1','trim|required|xss_clean|max_length[100]');
		$this->form_validation->set_rules('address_line_2', 'Address 2','trim|xss_clean|max_length[100]');
		$this->form_validation->set_rules('pincode', 'Pincode','trim|required|xss_clean|max_length[6]');
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}
				
		$function_name = $this->get_function_name(__FUNCTION__);
		$check_user = $this->check_exist_user($table , $table_schema , $columns ,  array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id));
		
		if(isset($check_user['data']) && !empty($check_user['data']))
		{
			//$put_array = $this->post();
            $columns .=',updated_by';
			$put_array=$_POST;
			$put_array['allow_empty']=TRUE;
			// $put_array[$table_prefix.'id'] = $applicant_personal_det_id;
			// $update = $this->_common_update ( $table , $table_prefix , $function_name , $columns , $put_array ,  'applicant_personal_det_id',$table_schema);

			$where = array();
			$where['applicant_personal_det_id'] = $applicant_personal_det_id;
			$where['applicant_appln_id'] = $applicant_appln_id;
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

			if($update)
			{
				if(!$is_wizard_with_parent) {
					// Update Wizard ID
					$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id , FORM_WIZARD_ADDRESS_ID);	
				}
					
				$this->response (
                    [
                        'status' => 'true' ,
                        'message' => RECORD_UPDATE_SUCCESSFULLY,
                    ] , API_Controller::HTTP_OK
                );
			}
			else {
                $this->response (
                    [
                        'status' => 'error' ,
                        'message' => ERROR_MSG,
                    ] , API_Controller::HTTP_OK
                );
            }
		}
		else
		{
            $columns .=',created_by';
            
			$insert = $this->_common_insert ( $table , $table_prefix , $function_name , $columns , $table_schema );

			if ( $insert ) {
				if(!$is_wizard_with_parent) {
					// Insert Wizard ID
					$wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id , FORM_WIZARD_ADDRESS_ID);	
				}
				
                $this->response (
                    [
                        'status' => 'true' ,
                        'message' => RECORD_ADDED_SUCCESSFULLY,
                    ] , API_Controller::HTTP_OK
                );
            }
            else {
                $this->response (
                    [
                        'status' => 'error' ,
                        'message' => ERROR_MSG,
                    ] , API_Controller::HTTP_OK
                );
            }

		}
	}

	public function applicantdet_get($id = false)
	{
		if ( $id ) {
            $this->applicant_details_post ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
	}

	public function applicant_details_post($page = false, $limit = false, $id = false)
    {
        // Check Authorization Token
        // $user_data = $this->_RESTConfig(['methods' => ['GET','POST'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
        $table = TABLE_VIEW_APPLICATION_DETAILS;
        //.$table.'.gender as second_email_id'
        // Set Columns
        $columns = $table.'.user_id as user_id, '.$table.'.first_name as first_name, '.$table.'.middle_name as middle_name, '.$table.'.last_name as last_name, '.$table.'.mobile_no as mobile_no ,'.$table.'.email_id as email_id ,'.$table.'.second_mobile_no as second_mobile_no, '.$table.'.second_email_id as second_email_id ,'.$table.'.gender ,'.$table.'.nationality ,'.$table.'.aadhar_no , ' .$table.'.social_status_id,'.$table.'.diff_abled,'.$table.'.deformity_type,'.$table.'.deformity_percent,'.$table.'.country_name,'.$table.'.state_name,'.$table.'.district_name,'.$table.'.city_name,'.$table.'.address_line_1,'.$table.'.address_line_2,'.$table.'.pincode,'.$table.'.deg_full_name,'.$table.'.spec_full_name,'.$table.'.dept_full_name,'.$table.'.faculty_full_name,'.$table.'.employee,'.$table.'.employe_category,'.$table.'.work_place,'.$table.'.other_degree_name,'.$table.'.other_specialization_name,'.$table.'.other_department_name,'.$table.'.other_faculty_name,'.$table.'.univ_full_name,'.$table.'.mark_scheme,'.$table.'.mark_percent,'.$table.'.yr_of_passing,'.$table.'.org_name,'.$table.'.designation,'.$table.'.job_nature,'.$table.'.salary,'.$table.'.from_date,'.$table.'.to_date,'.$table.'.work_exp_in_months,'.$table.'.work_experience,'.$table.'.title,'.$table.'.journal_conf_name,'.$table.'.year,'.$table.'.bank_name,'.$table.'.branch_name,'.$table.'.dd_cheque_no,'.$table.'.dd_cheque_date,'.$table.'.nameofemployee,'.$table.'.addressofemployee,'.$table.'.salaryreceived,'.$table.'.tentativetopicdocument,'.$table.'.choiceofprefofsupervisor,'.$table.'.file_name,'.$table.'.country_id,'.$table.'.state_id,'.$table.'.district_id,'.$table.'.city_id,'.$table.'.deg_id,'.$table.'.spec_id,'.$table.'.dept_id,'.$table.'.faculty_id,'.$table.'.emp_category_id,'.$table.'.dob,'.$table.'.gender_id,'.$table.'.blood_grp_id,'.$table.'.blood_grp,'.$table.'.nationality_id,'.$table.'.social_status,'.$table.'.title_id,'.$table.'.tittle_name,'.$table.'.diff_abled,'.$table.'.deformity_type_id';
        $keywords = $this->post('keywords',true);
        if($keywords) {
        	$columns = $table.'.appln_no as appln_no, '.$table.'.applicant_personal_det_id as applicant_personal_det_id, '.$table.'.applicant_login_id as applicant_login_id, '.$table.'.first_name as first_name, '.$table.'.declaration_compl as declaration_compl, '.$table.'.declaration_at as declaration_at, '.$table.'.doc_uploaded as doc_uploaded, '.$table.'.doc_verified as doc_verified, '.$table.'.fee_verified as fee_verified, '.$table.'.status as status , '.$table.'.verification_link as verification_link';
        }

        $cond = [];
        $return_type = $this->post('return_type',true);
        $return_type_count = $this->post('return_type_count',true);
        // $travel_status = $this->get('travel_status',true);
        
        // if($travel_status) {
        //     $cond['student_travel_status'] = $travel_status;
        // }
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
            $cond['user_id'] = $id;
        }
        $params['pk'] = 'user_id';
        $params['id_col'] = 'user_id';    
        $params['cond'] = $cond;
        // $joins = array(
        //             array(
        //                 'table' => $schema_php_dev.'.'.$stable,
        //                 'condition' => $schema_php_dev.'.'.$stable.'.studentid = '.$table.'.studentid',
        //                 'jointype' => 'LEFT'
        //             ),
        //             array(
        //                 'table' => $schema_php_dev.'.'.$ttable,
        //                 'condition' => $schema_php_dev.'.'.$ttable.'.studentid = '.$table.'.studentid',
        //                 'jointype' => 'LEFT'
        //             ),
        // );
        // $params['joins'] = $joins;
        // $params['view_type'] = $view_type;
        $params['return_type'] = (!empty($return_type))?$return_type:false;
        $params['return_type_count'] = (!empty($return_type_count))?$return_type_count:false;
        
        // Call Select Method
        $this->_select_table($params);
    }

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

	/**
     * @OA\Get(
     *     path="/api/applicant_graduation/{id}",
     *     tags={"applicant_graduations"},
     *     summary="get applicant_graduation",
     *     description="get applicant_graduation",
     *     operationId="applicant_graduation",
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
    public function applicant_graduation_get ($id = false)
    {
        if ( $id ) {
            $this->applicant_graduations_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/applicant_graduations/{page}/{limit}",
     *   tags={"faculty"},
     *   operationId="get applicant_graduations list",
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
     * get applicant_graduations list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the applicant_graduations list
     * @param string $id applicant_graduations id
     * @return json response of applicant_graduations list by page & limit
     * @author
     */
    public function applicant_graduations_get ($page = false , $limit = false , $id = false)
    {
    	$applicant_id = $this->get('applicant_id',true);
        // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
        $table = APPLICANT_GRADUATION_TABLE;
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
        $params['pk'] = 'applicant_grad_det_id';
        $params['id_col'] = 'applicant_grad_det_id';		
        $cond = array();
        $cond['active'] = 't';
        if($applicant_id) {
        	$cond['applicant_personal_det_id'] = $applicant_id;	
        }

        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }

    /**
     * @OA\Get(
     *     path="/api/applicant_prof_exp/{id}",
     *     tags={"applicant_prof_exps"},
     *     summary="get applicant_prof_exp",
     *     description="get applicant_prof_exp",
     *     operationId="applicant_prof_exp",
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
     * get applicant_prof_exp by id
     *
     * @param applicant_prof_exp $id applicant_prof_exp id
     * @return json response of applicant_prof_exp by id
     * @author
     */
    public function applicant_prof_exp_get ($id = false)
    {
        if ( $id ) {
            $this->applicant_prof_exps_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/applicant_prof_exps/{page}/{limit}",
     *   tags={"faculty"},
     *   operationId="get applicant_prof_exps list",
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
     * get applicant_prof_exps list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the applicant_prof_exps list
     * @param string $id applicant_prof_exps id
     * @return json response of applicant_prof_exps list by page & limit
     * @author
     */
    public function applicant_prof_exps_get ($page = false , $limit = false , $id = false)
    {
    	$applicant_id = $this->get('applicant_id',true);
        // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
        $table = APPLICANT_PROFESSIONAL_EXP_TABLE;
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
        $params['pk'] = 'applicant_prof_exp_id';
        $params['id_col'] = 'applicant_prof_exp_id';		
        $cond = array();
        $cond['active'] = 't';
        if($applicant_id) {
        	$cond['applicant_personal_det_id'] = $applicant_id;	
        }

        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }

    /**
     * @OA\Get(
     *     path="/api/applicant_publication_det/{id}",
     *     tags={"applicant_publication_dets"},
     *     summary="get applicant_publication_det",
     *     description="get applicant_publication_det",
     *     operationId="applicant_publication_det",
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
     * get applicant_publication_det by id
     *
     * @param applicant_publication_det $id applicant_publication_det id
     * @return json response of applicant_publication_det by id
     * @author
     */
    public function applicant_publication_det_get ($id = false)
    {
        if ( $id ) {
            $this->applicant_publication_dets_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/applicant_publication_dets/{page}/{limit}",
     *   tags={"applicant_publication_dets"},
     *   operationId="get applicant_publication_dets list",
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
     * get applicant_publication_dets list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the applicant_publication_dets list
     * @param string $id applicant_publication_dets id
     * @return json response of applicant_publication_dets list by page & limit
     * @author
     */
    public function applicant_publication_dets_get ($page = false , $limit = false , $id = false)
    {
    	$applicant_id = $this->get('applicant_id',true);
        // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
        $table = APPLICANT_PUBLICATION_DET_TABLE;
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
        $params['pk'] = 'applicant_publn_det_id';
        $params['id_col'] = 'applicant_publn_det_id';		
        $cond = array();
        $cond['active'] = 't';
        if($applicant_id) {
        	$cond['applicant_personal_det_id'] = $applicant_id;	
        }

        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }

   
   

    /**
     * @OA\Get(
     *     path="/api/applicant_publication_det/{id}",
     *     tags={"applicant_publication_dets"},
     *     summary="get applicant_publication_det",
     *     description="get applicant_publication_det",
     *     operationId="applicant_publication_det",
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
     * get applicant_publication_det by id
     *
     * @param applicant_publication_det $id applicant_publication_det id
     * @return json response of applicant_publication_det by id
     * @author
     */
    public function applicant_other_detail_get ($id = false)
    {
        if ( $id ) {
            $this->applicant_other_details_get( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/applicant_publication_dets/{page}/{limit}",
     *   tags={"applicant_publication_dets"},
     *   operationId="get applicant_publication_dets list",
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
     * get applicant_publication_dets list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the applicant_publication_dets list
     * @param string $id applicant_publication_dets id
     * @return json response of applicant_publication_dets list by page & limit
     * @author
     */
    public function applicant_other_details_get ($page = false , $limit = false , $id = false)
    {
    	$applicant_id = $this->get('applicant_id',true);
        // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
        $table = APPLICANT_OTHER_DETAILS_TABLE;
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
        $params['pk'] = 'applicant_other_det_id';
        $params['id_col'] = 'applicant_other_det_id';		
        $cond = array();
        $cond['active'] = 't';
        if($applicant_id) {
        	$cond['applicant_personal_det_id'] = $applicant_id;	
        }

        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }

    /**
     * @OA\Get(
     *     path="/api/applicant_publication_det/{id}",
     *     tags={"applicant_publication_dets"},
     *     summary="get applicant_publication_det",
     *     description="get applicant_publication_det",
     *     operationId="applicant_publication_det",
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
     * get applicant_publication_det by id
     *
     * @param applicant_publication_det $id applicant_publication_det id
     * @return json response of applicant_publication_det by id
     * @author
     */
    public function applicant_comp_exam_get ($id = false)
    {
        if ( $id ) {
            $this->applicant_comp_exams_get ( false , false , $id );
        }
        else {
            $return_get_atd['status'] = FALSE;
            $return_get_atd['message'] = NO_RECORD_FOUND;
            $this->output->set_content_type('application/json')->set_output(json_encode($return_get_atd));
        }
    }

    /**
     ** @OA\Get(
     *   path="/api/applicant_publication_dets/{page}/{limit}",
     *   tags={"applicant_publication_dets"},
     *   operationId="get applicant_publication_dets list",
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
     * get applicant_publication_dets list
     *
     * @param integer $page page number
     * @param integer $limit limit to show the applicant_publication_dets list
     * @param string $id applicant_publication_dets id
     * @return json response of applicant_publication_dets list by page & limit
     * @author
     */
    public function applicant_comp_exams_get ($page = false , $limit = false , $id = false)
    {
    	$applicant_id = $this->get('applicant_id',true);
        // Check Authorization Token
        $user_data = $this->_RESTConfig(['methods' => ['GET'],'requireAuthorization' => true,]);
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
        $table = APPLICANT_COMPETITIVE_EXAM_DET_TABLE;
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
        $params['pk'] = 'applicant_entr_exam_det_id';
        $params['id_col'] = 'applicant_entr_exam_det_id';		
        $cond = array();
        $cond['active'] = 't';
        if($applicant_id) {
        	$cond['applicant_personal_det_id'] = $applicant_id;	
        }

        $params['cond'] = $cond;
        
        // Call Select Method
        $this->_select_table($params);
    }

    

    public function db_func_other_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_other_detail = FN_GET_APP_OTHER_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	$applicant_appln_id = $this->post('applicant_appln_id',true);
		
		$user_data = array();
		$user_data[] = $applicant_personal_det_id;
		$user_data[] = $applicant_appln_id;
    	$result = $this->db_func_call($table_schema, $fn_get_app_other_detail, $user_data);
    	// select * from admission.fn_get_app_other_detail(24)
    }

    public function db_func_competitive_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_other_detail = FN_GET_APP_COMPETITIVE_EXAM_DET;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	$applicant_appln_id = $this->post('applicant_appln_id',true);
		
		$user_data = array();
		$user_data[] = $applicant_personal_det_id;
		$user_data[] = $applicant_appln_id;
    	$result = $this->db_func_call($table_schema, $fn_get_app_other_detail, $user_data);
    	// select * from admission.fn_get_app_other_detail(24)
    }

    public function db_func_grad_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_grad_detail = FN_GET_APP_GRAD_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	$applicant_appln_id = $this->post('applicant_appln_id',true);
		
		$user_data = array();
		$user_data[] = $applicant_personal_det_id;
		$user_data[] = $applicant_appln_id;
    	$result = $this->db_func_call($table_schema, $fn_get_app_grad_detail, $user_data);
    	// select * from admission.fn_get_app_grad_detail(24)
    }

    public function db_func_exp_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_exp_detail = FN_GET_APP_EXP_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	$applicant_appln_id = $this->post('applicant_appln_id',true);
		
		$user_data = array();
		$user_data[] = $applicant_personal_det_id;
		$user_data[] = $applicant_appln_id;
    	$result = $this->db_func_call($table_schema, $fn_get_app_exp_detail, $user_data);
    	// select * from admission.fn_get_app_exp_detail(24)
    }

    public function db_func_pub_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_pub_detail = FN_GET_APP_PUB_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	$applicant_appln_id = $this->post('applicant_appln_id',true);
		
		$user_data = array();
		$user_data[] = $applicant_personal_det_id;
		$user_data[] = $applicant_appln_id;
    	$result = $this->db_func_call($table_schema, $fn_get_app_pub_detail, $user_data);
    	// select * from admission.fn_get_app_pub_detail(24)
    }

    public function db_func_doc_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_doc_detail = FN_GET_APP_DOC_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	$applicant_appln_id = $this->post('applicant_appln_id',true);
		
		$user_data = array();
		$user_data[] = $applicant_personal_det_id;
		$user_data[] = $applicant_appln_id;
    	$result = $this->db_func_call($table_schema, $fn_get_app_doc_detail, $user_data);
    	// select * from admission.fn_get_app_doc_detail(24)
    }
    
    
        
        //temporary function
        protected function _get_applicant_detail_by_tbl($function_name,$tabledy ,$pk_id,$id, $return = false, $cond = array()) {
            // Set Schema
            $table_schema = SCHEMA_ADMISSION;
            // Set Table
            //$table = 'applicant_graduation_det';
            
            $table  = $tabledy;
            // $stable = TABLE_LOOKUP_VALUE;
            // Set Columns
            $columns = "applicant_personal_det_id as applicant_personal_det_id";
            
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
        
    //end HCMA apis
    

    public function db_func_basic_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_basic_detail = FN_GET_APP_BASIC_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    			
		$result = $this->db_func_call($table_schema, $fn_get_app_basic_detail, $applicant_personal_det_id);
    	// select * from admission.fn_get_app_basic_detail(24)
    }

    public function db_func_address_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_address_detail = FN_GET_APP_ADDRESS_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$applicant_appln_id = $this->post('applicant_appln_id',true);
		$user_data = array();
		$user_data[] = $applicant_personal_det_id;
		$user_data[] = $applicant_appln_id;
    	$result = $this->db_func_call($table_schema, $fn_get_app_address_detail, $user_data);
    	// select * from admission.fn_get_app_address_detail(24)
    }

    public function db_func_payment_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_payment_detail = FN_GET_APP_PAYMENT_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	$applicant_appln_id = $this->post('applicant_appln_id',true);
		
		$user_data = array();
		$user_data[] = $applicant_personal_det_id;
		$user_data[] = $applicant_appln_id;
    	$result = $this->db_func_call($table_schema, $fn_get_app_payment_detail, $user_data);
    	// select * from admission.fn_get_app_payment_detail(24)
    }

    // DONT DELETE BELOW FUNCTION
    public function db_func_appln_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_appln_detail = FN_GET_APP_APPLN_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	$applicant_form_id = $this->post('applicant_form_id',true);
		
		$user_data = array();
		$user_data[] = $applicant_personal_det_id;
		$user_data[] = $applicant_form_id;

    	$result = $this->db_func_call($table_schema, $fn_get_app_appln_detail, $user_data);
    	// select * from admission.fn_get_app_appln_detail(24)
    }

    /*public function db_func_appln_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_appln_detail = FN_GET_APP_APPLN_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	$applicant_form_id = $this->post('applicant_form_id',true);
		
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$applicant_form_id,true);
		
		$this->response($applicant_appln_det_res, API_Controller::HTTP_OK);
    	// select * from admission.fn_get_app_appln_detail(24)
    }*/

    public function db_func_campus_prefer_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_campus_detail = FN_GET_APP_CAMPUS_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	$applicant_appln_id = $this->post('applicant_appln_id',true);
		
		$user_data = array();
		$user_data[] = $applicant_personal_det_id;
		$user_data[] = $applicant_appln_id;
    	$result = $this->db_func_call($table_schema, $fn_get_app_campus_detail, $user_data);
    	// select * from admission.fn_get_app_campus_detail(24)
    }

    public function db_func_city_prefer_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_city_detail = FN_GET_APP_CITY_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	$applicant_appln_id = $this->post('applicant_appln_id',true);
		
		$user_data = array();
		$user_data[] = $applicant_personal_det_id;
		$user_data[] = $applicant_appln_id;
    	$result = $this->db_func_call($table_schema, $fn_get_app_city_detail, $user_data);
    	// select * from admission.fn_get_app_city_detail(24)
    }

    public function db_func_course_prefer_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_course_detail = FN_GET_APP_COURSE_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	$applicant_appln_id = $this->post('applicant_appln_id',true);
		
		$user_data = array();
		$user_data[] = $applicant_personal_det_id;
		$user_data[] = $applicant_appln_id;
    	$result = $this->db_func_call($table_schema, $fn_get_app_course_detail, $user_data);
    	// select * from admission.fn_get_app_course_detail(24)
    }

    public function db_func_parent_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_parent_detail = FN_GET_APP_PARENT_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	$applicant_appln_id = $this->post('applicant_appln_id',true);
		
		$user_data = array();
		$user_data[] = $applicant_personal_det_id;
		$user_data[] = $applicant_appln_id;
    	$result = $this->db_func_call($table_schema, $fn_get_app_parent_detail, $user_data);
    	// select * from admission.fn_get_app_parent_detail(24)
    }
	
	public function db_func_course_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_course_detail = FN_GET_APP_COURSE_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	$applicant_appln_id = $this->post('applicant_appln_id',true);
		
		$user_data = array();
		$user_data[] = $applicant_personal_det_id;
		$user_data[] = $applicant_appln_id;
    	$result = $this->db_func_call($table_schema, $fn_get_app_course_detail, $user_data);
    	// select * from admission.fn_get_app_basic_detail(24)
    }
	
	public function db_func_campus_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_campus_detail = FN_GET_APP_CAMPUS_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	$applicant_appln_id = $this->post('applicant_appln_id',true);
		
		$user_data = array();
		$user_data[] = $applicant_personal_det_id;
		$user_data[] = $applicant_appln_id;
    	$result = $this->db_func_call($table_schema, $fn_get_app_campus_detail, $user_data);
    	// select * from admission.fn_get_app_basic_detail(24)
    }
	
	public function db_func_choice_dropdown_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_choice_dropdown = FN_GET_CHOICE_DROPDOWN;
    	$grad_id = $this->post('grad_id',true);
    	$grad_id = ($grad_id)?$grad_id:false;
    	$campus_id = $this->post('campus_id',true);
    	$campus_id = ($campus_id)?$campus_id:false;
    	$branch_id = $this->post('branch_id',true);
    	$branch_id = ($branch_id)?$branch_id:false;
    	$deg_id = $this->post('deg_id',true);
    	$deg_id = ($deg_id)?$deg_id:false;
    	$spec_id = $this->post('spec_id',true);
    	$spec_id = ($spec_id)?$spec_id:false;
    	$form_id = $this->post('form_id',true);
    	$form_id = ($form_id)?$form_id:false;
    	$grad_mode_id = $this->post('grad_mode_id',true);
    	$grad_mode_id = ($grad_mode_id)?$grad_mode_id:false;

		$is_course = $this->post('is_course',true);
		$is_spec = $this->post('is_spec',true);
		$is_campus = $this->post('is_campus',true);
		$is_program=$this->post('is_program',true);
		$is_regcourse = $this->post('is_regcourse',true);
		$sort_by = $this->post('sort_by',true);
		$sort_order = $this->post('sort_order',true);
		$column=array();
		if($is_course) {
			$column['id'] = 'branch_id';
			//$column['id'] = 'prog_id';
			$column['name'] = 'branch_name';
		}
		if($is_program)
		{
			$column['id'] = 'grad_id';
			$column['name'] = 'grad_short_name';
		}
		if($is_spec) {
			$column['id'] = 'spec_id';
			$column['name'] = 'spec_name';
		}
		if($is_campus) {
			$column['id'] = 'campus_id';
			$column['name'] = 'campus_name';
		}
		if($is_regcourse)
		{
			$column['id'] = 'deg_id';
			$column['name'] = 'deg_short_name';
		}
		$params = array();
		$cond=array();
		$params['grad_id'] = $grad_id;
		$params['campus_id'] = $campus_id;
		$params['branch_id'] = $branch_id;
		$params['deg_id'] = $deg_id;
		$params['form_id'] = $form_id;

		//get exclude campus ids
		$exclude_campuspref_ids=$this->input->post('exclude_campuspref_ids');
		$exclude_coursepref_ids = $this->input->post('exclude_coursepref_ids');

        $where = array();
    	if($exclude_campuspref_ids) {
    		$where['campus_id'] = 'NOT IN ('.$exclude_campuspref_ids.')';
    	} 

    	if($exclude_coursepref_ids) {
    		$where['branch_id'] = 'NOT IN ('.$exclude_coursepref_ids.')';
    	} 
		
    	if($grad_mode_id) {
    		$params['grad_mode_id'] = $grad_mode_id;
    	}
    	
    	
    	$result = $this->db_func_call($table_schema, $fn_get_choice_dropdown, $params, $column, $sort_by, $sort_order,false,$where);
    	// select * from admission.fn_get_choice_dropdown(grad_id,campus_id,branch_id,deg_id)
    }
	
	/* public function db_func_schooling_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_schooling_detail = FN_GET_APP_SCHOOLING_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	
    	$result = $this->db_func_call($table_schema, $fn_get_app_schooling_detail, $applicant_personal_det_id);
    	// select * from admission.fn_get_app_basic_detail(24)
    } */	

    

    public function db_func_schooling_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_schooling_detail = FN_GET_APP_SCHOOLING_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
    	$applicant_appln_id = $this->post('applicant_appln_id',true);
    	
    	$user_data = array();
    	$user_data[] = $applicant_personal_det_id;
    	$user_data[] = $applicant_appln_id;
    	$result = $this->db_func_call($table_schema, $fn_get_app_schooling_detail, $user_data);
    	// select * from admission.fn_get_app_schooling_detail(24)
    }

    

	/* public function check_applicant_appln_post(){
		
		$this->form_validation->set_data($this->post());
		$this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
		$this->form_validation->set_rules('form_id', 'Form ID','trim|required');		
		//Run Validations
		if ($this->form_validation->run() == FALSE) {
			return $this->output->set_content_type('application/json')
			->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
		}		
		$user_data = $this->post();
		$applicant_appln_det = APPLICANT_APPLN;    	
    	$table_schema = SCHEMA_ADMISSION;
		$table_prefix = '';
		
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$form_id = $this->post('form_id',true);
		$columns = "applicant_appln_id,applicant_personal_det_id,appln_form_id";
		
		$result = $this->check_exist_user ($applicant_appln_det , $table_schema , $columns ,  $applicant_personal_det_id, $type = false, $pk_id_col = false, $pk_id_val = false, $form_id);
		
		if($result['data']==false){
			$_SERVER["REQUEST_METHOD"] = "POST";
			$_POST['active'] = TRUE;
			$_POST['appln_form_id'] = $form_id;
			$_POST['applicant_personal_det_id'] = $applicant_personal_det_id;
			$_POST['created_by'] = $applicant_personal_det_id;
			$function_name = $this->get_function_name(__FUNCTION__);
			$applicant_appln_columns = 'applicant_personal_det_id,appln_form_id,created_by,active';     
			$applicant_appln_det_res = $this->_common_insert ( $applicant_appln_det , $table_prefix , $function_name , $applicant_appln_columns , $table_schema);
			$result = $this->check_exist_user ($applicant_appln_det , $table_schema , $columns ,  $applicant_personal_det_id, $type = false, $pk_id_col = false, $pk_id_val = false, $form_id);
			$result['data'][0]['type'] = 'inserted';
			$this->response ($result , API_Controller::HTTP_OK);
		}
		else
		{
			$result['data'][0]['type'] = 'fetched';
			$this->response ($result , API_Controller::HTTP_OK);
		}
	} */
	
    public function get_appln_form_id_post() {
    	
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$appln_form_id = $this->post('appln_form_id',true);
		// $applicant_appln_id = $this->post('applicant_appln_id',true);
		
		$applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$appln_form_id);

		$function_name = $this->get_function_name(__FUNCTION__);
		
		$this->response ($applicant_appln_det_res , API_Controller::HTTP_OK);
    }
    
    
    
    
    public function parent_occupation_get($page = false, $limit = false, $id = false){
        $table_schema = SCHEMA_MASTER;
        $table = OCCUPATION_TABLE;
        $columns = $table.'.occupation_id as id,'.$table.'.occupation_name as name';
        //$keywords = $this->post('keywords',true);
        
        $function_name = $this->get_function_name(__FUNCTION__);
        // Parameter By Array
        $params = array();
        $params['table'] = $table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;        
        $params['pk'] = 'occupation_id';
        $params['id_col'] = 'occupation_id';
        $params['id'] = '';
        $params['return_type'] = false;
        $this->_select_table($params);
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

    public function db_func_instruction_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_app_instruction = FN_GET_INSTRUCTION;
    	$appln_form_id = $this->post('appln_form_id',true);
    	$wizard_id = $this->post('wizard_id',true);
		
		$user_data = array();
		$user_data[] = $appln_form_id;
		$user_data[] = $wizard_id;
    	$result = $this->db_func_call($table_schema, $fn_get_app_instruction, $user_data);
    	// select * from admission.fn_get_instruction(appln_form_id,wizard_id)
    }

    public function db_func_applicant_appln_detail_post() {
    	$table_schema = SCHEMA_ADMISSION;
    	$fn_get_applicant_appln_detail = FN_GET_APPLICANT_APPLN_DETAIL;
    	$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		$appln_form_id = $this->post('appln_form_id',true);
    	
    	// $result = $this->db_func_call($table_schema, $fn_get_applicant_appln_detail, $applicant_personal_det_id);
    	$where = array();
    	$where['appln_form_id'] = ' = '.$appln_form_id;
    	$res = $this->db_func_call($table_schema, $fn_get_applicant_appln_detail, $applicant_personal_det_id, false, false, false,false, $where);
    	// select * from admission.fn_get_applicant_appln_detail(applicant_personal_det_id)
    }
	
	public function tab_w_percentage_post() {
		$applicant_personal_det_id = $this->input->post('applicant_personal_det_id');
		$applicant_appln_id = $this->input->post('applicant_appln_id');
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
		$table  = APPLICANT_APPLN;
		$table2  = 'form_w_wizard';
        // Set Columns
        $columns = $table2.".form_w_wizard_id,completion_percent,applicant_appln_id,applicant_personal_det_id";

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
		//$params['returnresponse'] = $return;
	
        // Call Select Method
      //  return $result_user = $this->_select_table($params);
		 $this->_select_table($params);
    }

	public function thankyou_data_post() {
		$applicant_appln_id = $this->input->post('applicant_appln_id');
		$form_id = $this->input->post('appln_form_id');
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
        // Set Table
		$table  = APPLICANT_APPLN;
		
		$table2  = 'form_w_wizard';
		$table3 = 'applicant_payment_det';
        // Set Columns
        //$columns = $table2.".form_w_wizard_id,completion_percent,applicant_appln_id,applicant_personal_det_id";
		$columns = $table.".appln_no,form_message,wizard_id";

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
		$cond['form_message !='] = 'null';
		$cond[$table.'.appln_form_id'] = $form_id;
		//$cond[$table.'.applicant_personal_det_id'] = $applicant_personal_det_id;
		$cond[$table.'.applicant_appln_id'] = $applicant_appln_id;		
		 $joins = array(
			array(
				'table' => $table,
				'condition' => $table.'.appln_form_id = '.$table2.'.appln_form_id',
				'jointype' => 'LEFT'
			),  			
        );		
		$params['joins'] = $joins;
        $params['cond'] = $cond;
		$params['returnresponse'] = $return;
	
        // Call Select Method
		return $result_user = $this->_select_table($params);
		 //$this->_select_table($params);
    }	
	
	public function check_demo_post(){
		$applicant_personal_det_id = $this->post('applicant_personal_det_id');
		$app_form_id = $this->post('app_form_id');
		$wizard_id = $this->post('wizard_id');
		
		$data = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id , $wizard_id);
	}
}