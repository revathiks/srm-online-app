<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package SRM - Online Application
 * @category Users API
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
class Settings extends API_Controller {

	public function __construct()
	{		
		parent::__construct();
		$this->load->library('form_validation');
	}


	 /**
     * Change Password API
     * --------------------
     * @param: old_pwd 
     * @param: new_pwd
     * @param: confirm_pwd
     * --------------------------
     * @method : POST
     * @link: api/change_password
     * @author
     */

	public function changepassword_post()
	{
		 $user_data = $this->_RESTConfig([
            'methods' => ['POST'],
            'requireAuthorization' => true,
        ]);
		$id = $this->input->post('applicant_personal_det_id');
		$table_personal = APPLICANT_PERSONAL_DET_TABLE;
        $table = APPLICANT_LOGIN_TABLE;
		$table_schema = SCHEMA_ADMISSION;
        $table_prefix = '';
        $function_name = $this->get_function_name(__FUNCTION__);
        $columns = 'applicant_personal_det_id,applicant_login_id,first_name,last_name,email_id';
        $params['table'] = $table_personal;
        $params['table_schema'] = $table_schema;
        $params['function_name'] = $function_name;
        $params['table_prefix'] = $table_prefix;
        $params['columns'] = $columns;
        $params['id'] = $id;
        $params['pk'] = 'applicant_personal_det_id';
        $params['id_col'] = 'applicant_personal_det_id';
        $params['returnresponse']=TRUE;
        $result_user = $this->_select_table($params);
        $app_login_id = $result_user['data']['applicant_login_id'];
        //echo $app_login_id;die;
        $username = $result_user['data']['first_name'];
        $email = $result_user['data']['email_id'];
        

        
        $old_pwd        =   trim(strip_tags($this->input->post('old_pwd')));
        $new_pwd        =   trim(strip_tags($this->input->post('new_pwd')));
        $confirm_pwd    =   trim(strip_tags($this->input->post('confirm_pwd')));
        # Form Validation
        $this->form_validation->set_rules('old_pwd', 'Old Password', 'trim|required|max_length['.PASSWORD_MAX_LENGTH.']');
        $this->form_validation->set_rules('new_pwd', 'New Password', 'trim|required|max_length['.PASSWORD_MAX_LENGTH.']');
        $this->form_validation->set_rules('confirm_pwd', 'Confirm Password' , 'trim|required|matches[new_pwd]');
        if ($this->form_validation->run() === FALSE)
        {
            // Form Validation Errors
            $message = array(
                'status' => 'error',
                'error' => $this->form_validation->error_array(),
                'message' => validation_errors()
            );
            return $this->response_successdata($message);
        }

        else /* Form Validation Start else */
        {
            $columns = 'applicant_login_id,applicant_pwd';
            $encrypt_pwd    =   password_hash($new_pwd, PASSWORD_DEFAULT);
            $check_password =   $this->check_old_pass($app_login_id,$table,$table_schema,$table_prefix,$function_name,$columns,$old_pwd,$new_pwd);
            if($check_password === true)
            {
                $encrypt_newpwd     =   $encrypt_pwd;
                $where = array();
                $where['applicant_login_id'] = $app_login_id;
                $data['applicant_pwd'] = $encrypt_newpwd;
                $update = $this->common->common_update($table,'' , $data , $where);
                if ($update)
                {
                	$subject = CHANGE_PWD_NOTIFY_SUBJECT;
                	//$message = CHANGE_PWD_NOTIFY_MSG;
                    $this->data['user_name'] = $username;
                    $this->data['email'] = $email;
                    $this->data['pwd'] = $new_pwd;
                    $message = $this->load->view('email_templates/passwordupdatesuccess_notify',$this->data,true);
                	$from = FORGOT_PWD_FROM; 
                	$to =$email;
                	$this->common_send_mail($subject,$message,$from,$to);
                    // Success 200 Code Send
                    return $this->response_message('success',PWD_UPDATE);
                } else
                {
                    return $this->response_message('error',ERROR_MSG);
                }
            } else {
                return $this->response_message('error',ERROR_MSG);
            }
            
            
        }  /* Form Validation Start End */

	}


	/*Check Old Password start*/

    protected function check_old_pass($id,$table,$table_schema,$table_prefix,$function_name,$columns,$old_password,$new_pwd)
    {

        $cond = array ('applicant_login_id' => $id );

        $params = array();
        $params['table'] = $table;
        $params['table_schema'] = $table_schema;
        $params['table_prefix'] = $table_prefix;
        $params['function_name'] = $function_name;
        $params['columns'] = $columns;
        $params['pk'] = 'applicant_login_id';
        $params['cond'] = $cond;
        $params['return_type']='single';
        $params['returnresponse']= true;
        $params['message']= PASSWORD_EXIST;
        $user = $this->_select_table($params);

        if(!empty($user['data']))
        {
        	if(password_verify($new_pwd, $user['data']['applicant_pwd']) === true) {
                return $this->response_message('error',PASSWORD_EXIST);
            }
            else if(password_verify($old_password, $user['data']['applicant_pwd']) !== false) {
                return true;
            } else {
                return $this->response_message('error',OLD_PWD_NOTEXIST);
            }
        }
        else
        {
            return $this->response_message('error',$params['message']);
        }
    }
    /*Check Old Password end*/

}