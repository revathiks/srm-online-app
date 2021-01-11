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
class Payment_history extends API_Controller {

	public function __construct()
	{		
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function payment_history_get()
	{
		$table_schema = SCHEMA_ADMISSION;
		$table_dev_schema = SCHEMA_PHP_DEV;
		$table  = PAYMENT_TBL_HISTORY;
		$applicant_table  = APPLICANT_APPLN;
		$applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
		$applicant_payment_det_table = APPLICANT_PAYMENT_DET_TABLE;
		$application_form_det_table=APPLICATION_FORM_TABLE;
		$table_master_schema = SCHEMA_MASTER;
		$columns = $applicant_table.".appln_no,".$applicant_table.".applicant_name_declaration,".$table.".trans_no,".$applicant_table.".application_status_id,".$application_form_det_table.".appln_form_name,".$application_form_det_table.".appln_form_id,".$table.".applicant_appln_id,".$table.".applicant_personal_det_id ,".$applicant_personal_det_table. ".applicant_login_id,".$table.".payment_history_id,".$applicant_personal_det_table.".first_name";
		$searchColumnName = $this->input->get('searchColumnName');
		$searchValue = $this->input->get('searchValue');
		$searchType = $this->input->get('searchType');
		if($searchValue != ''){
			if($searchColumnName=='applicant_appln_id'){
				$cond[$applicant_table.'.'.$searchColumnName] = $searchValue;
			}
			else if($searchColumnName=='applicant_personal_det_id'){
				$cond[$table.'.'.$searchColumnName] = $searchValue;
			}
			else if($searchColumnName=='trans_no' && $searchType == 'like'){
				$cond[] ="$table.$searchColumnName LIKE '%$searchValue%'";
			}
			else if($searchColumnName=='trans_no' && $searchType != 'like'){
				$cond[$table.'.'.$searchColumnName] = $searchValue;
			}

		}
		// Parameter By Array
        $params = array();
        $params['table'] = $table;
        $params['table_schema'] = $table_dev_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        $params['pk'] = 'payment_history_id';
        $params['id_col'] = 'payment_history_id';
        $joins = array(
        	array(
				'table' => $table_schema.".".$applicant_table,
				'condition' => $applicant_table.'.applicant_appln_id = '.$table.'.applicant_appln_id',
				'jointype' => 'INNER'
			),  
			array(
				'table' => $table_master_schema.".".$application_form_det_table,
				'condition' => $application_form_det_table.'.appln_form_id = '.$applicant_table.'.appln_form_id',
				'jointype' => 'INNER'
			),  
			array(
				'table' => $table_schema.".".$applicant_personal_det_table,
				'condition' => $applicant_personal_det_table.'.applicant_personal_det_id = '.$table.'.applicant_personal_det_id',
				'jointype' => 'INNER'
			)		
        );		
		$params['joins'] = $joins;
		$params['cond'] = $cond;
		$this->_select_table($params);
	}
}