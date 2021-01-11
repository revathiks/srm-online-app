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
class Queries extends API_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function save_query_post() {
        $table_prefix = '';
        $table_schema = SCHEMA_CRM;
        $table = $table_schema.".".TICKETS_TABLE;
        $table_tmp=TICKETS_TABLE;
        $function_name = $this->get_function_name(__FUNCTION__);
        $columns = 'applicant_personal_det_id,appln_form_id,status_id,description,applicant_name,active,created_by,created_at,cat_w_sub_cat_id';
        $form_id = $this->post('form_id',true);
        $name = $this->post('name',true);
        $category = $this->post('category',true);
        $description = $this->post('description',true);
        $file_name = $this->post('file_name',true);
        $applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
        
        $this->form_validation->set_rules('name', 'Name','trim|required');
        $this->form_validation->set_rules('form_id', 'Form Id','trim|required');
        $this->form_validation->set_rules('category', 'Category','trim|required');
        $this->form_validation->set_rules('description', 'Description','trim|required');
        if ($this->form_validation->run() == FALSE) {
            return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
        }
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['active'] = TRUE;
        $_POST['appln_form_id'] = $form_id;
        $_POST['applicant_name']=$name;
        $_POST['applicant_personal_det_id'] = $applicant_personal_det_id;
        $_POST['status_id'] = TICKETS_OPEN_STATUS;
        $_POST['cat_w_sub_cat_id'] = $category;
        
         $insert = $this->_common_insert ( $table , $table_prefix , $function_name , $columns ,$table_schema );
         $lastinsert_id = $this->common->_get_last_insert_id($table_schema, $table_tmp, 'ticket_id');
          if ( $insert ) {
              
             //insert into second tbl             
                 $table_prefix = '';
                 $table_schema = SCHEMA_CRM;
                 $table = $table_schema.".".TICKETS_APPLICANT_TABLE;            
                 $function_name = $this->get_function_name(__FUNCTION__);
                 $columns = 'ticket_id,applicant_query,status_id,doc_path,active,created_by,created_at';
                 
                 $_SERVER["REQUEST_METHOD"] = "POST";
                 $_POST['active'] = TRUE;
                 $_POST['ticket_id'] = $lastinsert_id;
                 $_POST['applicant_query'] = $description;
                 $_POST['doc_path'] = $file_name;
                 $_POST['status_id'] = TICKETS_OPEN_STATUS;                      
                 $insert = $this->_common_insert ( $table , $table_prefix , $function_name , $columns ,$table_schema );
            //end second insert
            
             $this->response (
                 [
                     'status' => 'true' ,
                     'message' => RECORD_ADDED_SUCCESSFULLY,
                 ] , API_Controller::HTTP_OK
                 );
        }
    }
    public function ticket_conversations_get() {
        $ticket_id=$this->get('id');
        $table_schema = SCHEMA_CRM;
        $conversation_table = TICKETS_APPLICANT_TABLE;       
        $function_name = $this->get_function_name ( __FUNCTION__ );
        $columns = TICKETS_APPLICANT_TABLE.'.*';
        $params = array();
        $params['table'] = $conversation_table;
        
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['columns'] = $columns;
        $params['page'] = $page;
        $params['id'] = $id;
        $params['pk'] = 'applicant_query_id';
        $params['id_col'] = 'applicant_query_id';
        //$params['sort_by'] = $this->get('sort_by');
        $params['sort_order'] = $this->get('sort_order'); 
        $cond = array();
        $cond[$conversation_table.'.active'] = true;
        if(!empty($ticket_id)){
            $cond[$conversation_table.'.ticket_id'] = $ticket_id;
        }
        $params['cond'] = $cond;       
        $this->_select_table($params);
    }
    public function save_conversation_post() {       
        $description = $this->post('description',true);
        $file_name = $this->post('file_name',true);
        $ticket_id = $this->post('ticket_id',true);
        $status_id = $this->post('status_id',true);
        $is_admin = $this->post('is_admin',true);
        $created_by== $this->post('applicant_id',true);
        $status=TICKETS_OPEN_STATUS;
        
        if(isset($is_admin)&& $is_admin==1){
            $status=$status_id;
            $created_by=CRM_ADMIN_USER_ROLE_ID;
        }
        $applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
        $this->form_validation->set_rules('description', 'Description','trim|required');
        if ($this->form_validation->run() == FALSE) {
            return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
        }
            $table_prefix = '';
            $table_schema = SCHEMA_CRM;
            $table = $table_schema.".".TICKETS_APPLICANT_TABLE;
            $function_name = $this->get_function_name(__FUNCTION__);
            $columns = 'ticket_id,applicant_query,status_id,doc_path,active,created_by,created_at';
            
            $_SERVER["REQUEST_METHOD"] = "POST";
            $_POST['active'] = TRUE;
            $_POST['ticket_id'] = $ticket_id;
            $_POST['applicant_query'] = $description;
            $_POST['doc_path'] = $file_name;
            $_POST['status_id'] = $status;
            $_POST['created_by'] = $created_by;
            $insert = $this->_common_insert ( $table , $table_prefix , $function_name , $columns ,$table_schema );
            if($insert){
                if(isset($is_admin)&& $is_admin==1){
                //update status id in ticket table
                $updatetable = SCHEMA_CRM.'.'.TICKETS_TABLE;
                $update_schema = SCHEMA_CRM;
                $table_prefix = '';
                $columns='status_id,updated_at,updated_by';
                $put_array=array();
                $put_array['status_id']=$status_id;
                $put_array['updated_at']=date("y-m-d h:i:s");
                $put_array['updated_by']=$created_by;
                
                $where = array();
                $where['ticket_id'] = $ticket_id;
                $update = $this->common->common_update($updatetable ,$table_prefix , $put_array, $where);
                //end update
                }
                $this->response (
                    [
                        'status' => 'true' ,
                        'message' => RECORD_ADDED_SUCCESSFULLY,
                    ] , API_Controller::HTTP_OK
                    );
            }
    }
}