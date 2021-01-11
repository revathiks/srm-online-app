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
class Crm extends API_Controller {

	public function __construct()
	{		
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function applicant_details_crm_get(){
		$searchValue = $this->input->get('searchValue');
		$payment = $this->input->get('payment');
		$status = $this->input->get('status');
		$searchColumnName = $this->input->get('searchColumnName');
		$searchColumnNamepid = $this->input->get('searchColumnNamepid');
		if($searchColumnName=='created_at'){
			$searchValue = explode(' - ',$searchValue);
		}

		$page = $this->input->get('pageNo');
		$limit = $this->input->get('size');
		$is_download = $this->input->get('is_download');		
        // Set Schema
        $table_schema = SCHEMA_ADMISSION;
		$table_master_schema = SCHEMA_MASTER;
		$table_form_w_wizard = 'form_w_wizard';
        // Set Table
		$table  = APPLICANT_APPLN;
		$applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
		$applicant_payment_det_table = 'applicant_payment_det';
		$application_form_det_table = 'application_form';
		$columns = $table.".appln_no,applicant_name_declaration,payment_mode_id,".$applicant_payment_det_table.".created_at,application_fee,".$table.".application_status_id,".$application_form_det_table.".appln_form_name,".$application_form_det_table.".appln_form_id,".$table.".applicant_appln_id,".$table.".applicant_personal_det_id ,".$applicant_personal_det_table. ".applicant_login_id,".$table_form_w_wizard. ".completion_percent";

        // Parameter By Array
        $params = array();
        $params['table'] = $table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['columns'] = $columns;
        $params['pk'] = 'applicant_appln_id';
        $params['id_col'] = 'applicant_appln_id';
        // $cond = ($cond)?$cond:array();   
		// $cond['appln_no !='] = 'null';
		// $cond['applicant_name_declaration !='] = 'null';
		// $progress = APPLICATION_IN_PROGRESS;
		// $completed = APPLICATION_IN_COMPLETED;
		// $concat_progress_completed = $progress.",".$completed;
		// $cond[] ="$table.application_status_id IN ($concat_progress_completed)";
		
		if(isset($is_download) && !empty($is_download)){
		    $params['is_download'] = TRUE;
		}
		
		if($searchValue != ''){
			if($searchColumnName=='applicant_appln_id'){
				$cond[$table.'.'.$searchColumnName] = $searchValue;
			}
			else if($searchColumnName=='appln_form_id' && $searchColumnNamepid!='payment_mode_id'){
				$cond[] ="$table.$searchColumnName IN ($searchValue)";
			}	
			else if($searchColumnName=='payment_mode_id'){
				$cond[] ="$applicant_payment_det_table.$searchColumnName IN ($searchValue)";
			}				
			else if($searchColumnName=='applicant_personal_det_id'){
				$cond[$table.'.'.$searchColumnName] = $searchValue;
			}
			else if($searchColumnName=='applicant_name_declaration'){
				$cond[] = "$searchColumnName LIKE '%$searchValue%'";
			}
			else if($searchColumnName=='appln_form_id' || $searchColumnNamepid=='payment_mode_id'){
				$cond[] = "$table.$searchColumnName IN ($searchValue) AND $applicant_payment_det_table.$searchColumnNamepid IN ($payment)";
				if($status){
					$cond[] .= "$table.application_status_id IN ($status)";
				}
			}			
			else if($searchColumnName=='created_at'){
				$end_date = strtotime("1 day", strtotime($searchValue[1]));
				$end_date = date("Y-m-d", $end_date);
				$cond[] = "$applicant_payment_det_table.$searchColumnName BETWEEN '$searchValue[0]' AND '$end_date'";
			}else if($searchColumnName=='application_status_id'){
				$cond[] ="$table.application_status_id IN ($searchValue)";
			}	
			else if($status){
				$cond[] = "$table.application_status_id IN ($status)";
			}
		}
		
		$joins = array(
			array(
				'table' => $applicant_payment_det_table,
				'condition' => $applicant_payment_det_table.'.applicant_appln_id = '.$table.'.applicant_appln_id',
				'jointype' => 'LEFT'
			),  
			array(
				'table' => $table_master_schema.".".$application_form_det_table,
				'condition' => $application_form_det_table.'.appln_form_id = '.$table.'.appln_form_id',
				'jointype' => 'LEFT'
			),  
			array(
				'table' => $table_schema.".".$applicant_personal_det_table,
				'condition' => $applicant_personal_det_table.'.applicant_personal_det_id = '.$table.'.applicant_personal_det_id',
				'jointype' => 'INNER'
			), 			
			array(
				'table' => $table_schema.".".$table_form_w_wizard,
				'condition' => $table_form_w_wizard.'.form_w_wizard_id = '.$table.'.form_w_wizard_id',
				'jointype' => 'LEFT'
			),  			
        );		
		$params['joins'] = $joins;	
        $params['cond'] = $cond;
		// $params['pk'] = 'applicant_appln_id';
        // Call Select Method
		$this->_select_table($params);
	}	
}