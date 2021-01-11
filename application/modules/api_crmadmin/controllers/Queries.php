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
class Queries extends API_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function tickets_get() {        
        $ticket_id=$this->get('ticket_id');
        $appln_form_id=$this->get('appln_form_id');
        $cat_w_sub_cat_id=$this->get('cat_w_sub_cat_id');
        $status_id=$this->get('status_id');
        $created_at=$this->get('created_at');
        $email_id=$this->get('email_id');
        $mobile_no=$this->get('mobile_no');
        
        $page = $this->input->get('pageNo');
        $limit = $this->input->get('size');
        $is_download = $this->input->get('is_download');
        $table_schema = SCHEMA_CRM;
        $admission_schema = SCHEMA_ADMISSION;
        
        $ticket_table = TICKETS_TABLE;
        $cat_table = TICKET_SUB_CATEGORY_TABLE;
        $status_table = STATUS_TABLE;
        $form_table=APPLICATION_FORM;
        $personal_table=TABLE_APPLICANT_PERSONAL_DET;
        $function_name = $this->get_function_name ( __FUNCTION__ );
        $columns = TICKETS_TABLE.'.*,'.TICKET_SUB_CATEGORY_TABLE.'.sub_category_name,'.STATUS_TABLE.'.status_name,'.APPLICATION_FORM.'.appln_form_name,'.TABLE_APPLICANT_PERSONAL_DET.'.email_id,'.TABLE_APPLICANT_PERSONAL_DET.'.mobile_no,'.TABLE_APPLICANT_PERSONAL_DET.'.applicant_login_id';
        $params = array();
        $params['table'] = $ticket_table;
        
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['columns'] = $columns;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['id'] = $id;
        $params['pk'] = 'ticket_id';
        $params['id_col'] = 'ticket_id';
        // $params['sort_by'] = $this->get('sort_by');
        $params['sort_order'] = $this->get('sort_order');
        
        $cond = array();
        $cond[$ticket_table.'.active'] = true;
        if(!empty($ticket_id)){
            $cond[$ticket_table.'.ticket_id'] = $ticket_id;
        }
        //check $appln_form_id
        if(!empty($appln_form_id)){
            $form_column='appln_form_id';
            $cond[] ="$form_table.$form_column IN ($appln_form_id)";
        }
        //check for category
        if(!empty($cat_w_sub_cat_id)){
            $form_column='cat_w_sub_cat_id';
            $cond[] ="$cat_table.$form_column IN ($cat_w_sub_cat_id)";
        }
        
        //check for category
        if(!empty($status_id)){
            $form_column='status_id';
            $cond[] ="$status_table.$form_column IN ($status_id)";
        }
        //check for email
        
        //check for category
        if(!empty($email_id)){
            $form_column='email_id';
            $cond[] ="$personal_table.$form_column LIKE '%$email_id%'";
        }
        //check for mobile
        if(!empty($mobile_no)){
            $cond[$personal_table.'.mobile_no'] = $mobile_no;
        }
        
        //check for created at
        if(!empty($created_at)){
            $createdsep=explode("/",$created_at);
            $created_at=$createdsep[2]."-".$createdsep[1]."-".$createdsep[0];
            $cond['date('.$ticket_table.'.created_at)'] = $created_at;
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
            ),
            array(
                'table' => 'master.'.$form_table,
                'condition' => $form_table.'.appln_form_id = '.$ticket_table.'.appln_form_id',
                'jointype' => 'LEFT'
            ),
            array(
                'table' => $admission_schema.'.'.$personal_table,
                'condition' => $personal_table.'.applicant_personal_det_id = '.$ticket_table.'.applicant_personal_det_id',
                'jointype' => 'LEFT'
            )
        );
        $params['joins'] = $joins;
        if(isset($is_download) && !empty($is_download)){
            $params['is_download'] = TRUE;
        }
        $this->_select_table($params);
    }
    public function ticketscount_get() {
        $is_download = $this->input->get('is_download');
        $table_schema = SCHEMA_CRM;
        $ticket_table = TICKETS_TABLE;        
        $function_name = $this->get_function_name ( __FUNCTION__ );
        $columns = TICKETS_TABLE.'.*';
        $params = array();
        $params['table'] = $ticket_table;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['columns'] = $columns;
        $params['page'] = $page;
        $params['id'] = $id;
        $params['pk'] = 'ticket_id';
        $params['id_col'] = 'ticket_id';
        $cond = array();
        $cond[$ticket_table.'.active'] = true;
        $params['cond'] = $cond;
        $params['is_download'] = TRUE;
        $this->_select_table($params);
    }
    
}