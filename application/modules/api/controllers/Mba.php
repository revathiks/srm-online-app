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
class Mba extends API_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    //MBA API Start
    public function basic_detail_post() {
        $app_form_id_mba = APP_FORM_ID_MBA;
        $applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
        $applicant_appln_det_table = APPLICANT_APPLN;
        $table_schema = SCHEMA_ADMISSION;
        $app_status=APPLICATION_IN_PROGRESS;
        $table_prefix = '';
        $applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
        $qualifyingexamfromindia = $this->post('qualifyingexamfromindia',true);
        $applicant_appln_id = $this->post('applicant_appln_id',true);
        // get applicant form pk id
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_mba);
        $applicant_appln_id = $applicant_appln_det_res['id'];
        
        $is_agree = $this->post('i_confirm',true);
        // check i_agree required
        $i_agree_req = false;
        
        if($qualifyingexamfromindia == 'yes' || $qualifyingexamfromindia == 't') {
            $qualifyingexamfromindia = 't';
            $i_agree_req = true;
        } else {
            $qualifyingexamfromindia = 'f';
        }
        if($applicant_appln_id == 'false') {
            $applicant_appln_id = false;
        }
        if($is_agree) {
            $is_agree = 't';
        } else {
            $is_agree = 'f';
        }
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['active'] = TRUE;
        $_POST['appln_form_id'] = $app_form_id_mba;
        $_POST['qualifyingexamfromindia'] = $qualifyingexamfromindia;
        $_POST['is_agree'] = $is_agree;
        $_POST['applicant_appln_id'] = $applicant_appln_id;        
        $_POST['application_status_id'] = $app_status;
        
        //$applicant_personal_det_columns = 'applicant_personal_det_id,is_agree,active';
        $applicant_appln_det_columns = 'applicant_personal_det_id,appln_form_id,qualifyingexamfromindia,is_agree,active';
        if($applicant_appln_id != false) {
            $applicant_appln_det_columns .= ',applicant_appln_id';
        }
        $appln_status = $this->post('appln_status',true);
        if($appln_status != APPLICATION_IN_COMPLETED){
            $_POST['application_status_id'] = $app_status;
            $applicant_appln_det_columns .= ',application_status_id';
        }
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
        $this->form_validation->set_rules('qualifyingexamfromindia', 'Have you studied from India?','trim|required');
        if($i_agree_req) {
            $this->form_validation->set_rules('i_confirm', 'Confirmation','trim|required');
        }
        //Run Validations
        if ($this->form_validation->run() == FALSE) {
            return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
        }
        if($qualifyingexamfromindia !== 't') {
            return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('status'=>'error','message'=>'You cant proceed further')));
        }
        $function_name = $this->get_function_name(__FUNCTION__);
        if($applicant_appln_id == false) {
            $applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns,false,'applicant_appln_id',false,$app_form_id_mba);
        } else {
            $applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns, 1, 'applicant_appln_id', $applicant_appln_id,$app_form_id_mba);
        }
        
        if($applicant_appln_det_res) {
            if($applicant_appln_det_res['status'] == 'error') {
                $this->response ($applicant_appln_det_res , API_Controller::HTTP_OK);
            } else {
                $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_mba , FORM_WIZARD_BASIC_ID);
                $applicant_personal_det_res['appln_status'] = $applicant_appln_det_res;
            }
        }
        $this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
    }
    public function personal_detail_post() {
        $applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
        $applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
        $applicant_course_prefer_table = APPLICANT_COURSE_PREFER_TABLE;
        $applicant_campus_prefer_table = APPLICANT_CAMPUS_PREFER_TABLE;
        $applicant_city_prefer_table = APPLICANT_CITY_PREFER_TABLE;
        
        $app_form_id=APP_FORM_ID_MBA;
        $table_schema = SCHEMA_ADMISSION;
        $table_prefix = '';
        $applicant_appln_id = '';
        $applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
        
        $course_prefer_id = $this->post('course_prefer_id',true);
        $course_prefer_id = json_decode($course_prefer_id,true);
        $course_pref = $this->post('course_pref',true);
        $course_pref = json_decode($course_pref,true);
        $course_choice_no = $this->post('course_choice_no',true);
        $course_choice_no = json_decode($course_choice_no,true);
        
        $campus_pref = $this->post('campus_pref',true);
        $campus_pref = json_decode($campus_pref,true);
        
        $campus_choice_no = $this->post('campus_choice_no',true);
        $campus_choice_no = json_decode($campus_choice_no,true);
        $applicant_campus_prefer_id = $this->post('campus_prefer_id',true);
        $applicant_campus_prefer_id = json_decode($applicant_campus_prefer_id,true);
       
        $state_pref = $this->post('state_pref',true);
        $state_pref = json_decode($state_pref,true);
        $city_pref = $this->post('city_pref',true);
        $city_pref = json_decode($city_pref,true);
        $city_choice_no = $this->post('city_choice_no',true);
        $city_choice_no = json_decode($city_choice_no,true);
        
        // get applicant form pk id
        
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
        $applicant_appln_id = $applicant_appln_det_res['id'];
        $title_id = $this->post('title_id',true);
        $gender_id = $this->post('gender_id',true);
        $blood_group_id = $this->post('blood_grp_id',true);
        $religion_id = $this->post('religion_id',true);
        $mother_tongue_id = $this->post('mother_tongue_id',true);
        $hostel_accomadation_id = $this->post('prefer_hostel',true);
        $diffrently_abled_id = $this->post('diff_abled',true);
        $admission_adv_id = $this->post('advertisement_source_id',true);
        $nationality_id = $this->post('nationality_id',true);
        $social_status_id = $this->post('social_status_id',true);
        $phone_no_code = $this->post('phone_no_code',true);
        
        $title_id=($title_id!='' && $title_id!='null')?$title_id : NULL;
        $gender_id=($gender_id!='' && $gender_id!='null')?$gender_id : NULL;
        $blood_group_id=($blood_group_id!='' && $blood_group_id!='null')?$blood_group_id : NULL;
        $religion_id=($religion_id!='' && $religion_id!='null')?$religion_id : NULL;
        $mother_tongue_id=($mother_tongue_id!='' && $mother_tongue_id!='null')?$mother_tongue_id : NULL;
        $hostel_accomadation_id=($hostel_accomadation_id!='' && $hostel_accomadation_id!='null')?$hostel_accomadation_id : NULL;
        $diffrently_abled_id=($diffrently_abled_id!='' && $diffrently_abled_id!='null')?$diffrently_abled_id : NULL;
        $nationality_id=($nationality_id!='' && $nationality_id!='null')?$nationality_id : NULL;
        $social_status_id=($social_status_id!='' && $social_status_id!='null')?$social_status_id : NULL;
        $admission_adv_id=($admission_adv_id!='' && $admission_adv_id!='null')?$admission_adv_id : NULL;
        $phone_no_code=($phone_no_code!='' && $phone_no_code!='null')?$phone_no_code : NULL;
        
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['active'] = TRUE;
        $_POST['applicant_mob_country_code_id'] = $mobile_no_code;
        $_POST['applicant_appln_id'] = $applicant_appln_id;
        //new
        $_POST['title_id'] = $title_id;
        $_POST['gender_id'] = $gender_id;
        $_POST['blood_grp_id'] = $blood_group_id;
        $_POST['religion_id'] = $religion_id;
        $_POST['mothertongue_id'] = $mother_tongue_id;
        $_POST['prefer_hostel'] = $hostel_accomadation_id;
        $_POST['diff_abled'] = $diffrently_abled_id;
        $_POST['advertisement_source_id'] = $admission_adv_id;
        $_POST['nationality_id']= $nationality_id;
        $_POST['social_status_id'] = $social_status_id;
        $_POST['applicant_mob_country_code_id'] = $phone_no_code;
        //end new
        $applicant_personal_det_columns = 'applicant_personal_det_id,title_id,first_name,middle_name,last_name,mobile_no,applicant_mob_country_code_id,email_id,dob,gender_id,second_email_id,blood_grp_id,nationality_id,social_status_id,diff_abled,religion_id,prefer_hostel,mothertongue_id,advertisement_source_id,active';
        $applicant_other_details_columns = 'applicant_personal_det_id,applicant_appln_id,medofinst,active';
        
        $applicant_course_prefer_columns = 'applicant_personal_det_id,applicant_appln_id,course_id,course_name,choice_no,active';
        if($course_prefer_id) {
            $applicant_course_prefer_columns .= ',applicant_course_prefer_id';
        }
        
        $applicant_campus_prefer_columns = 'applicant_personal_det_id,applicant_appln_id,campus_id,campus_name,choice_no,active';
        if($applicant_campus_prefer_id) {
            $applicant_campus_prefer_columns .= ',applicant_campus_prefer_id';
        }
        
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
        //$this->form_validation->set_rules('campus_pref[0]', 'Campus','trim|required');
        $this->form_validation->set_rules('first_name', 'First Name','trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name','trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No','trim|required');
        $this->form_validation->set_rules('email_id', 'Email Id','trim|required');
        $this->form_validation->set_rules('dob', 'Date Of Birth','trim|required');
        $this->form_validation->set_rules('gender_id', 'Gender','trim|required');
        $this->form_validation->set_rules('blood_grp_id', 'Blood Group','trim|required');
        $this->form_validation->set_rules('diff_abled', 'Are You Differently Abled','trim|required');
        //Run Validations
        if ($this->form_validation->run() == FALSE) {
            return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
        }
        
        $function_name = $this->get_function_name(__FUNCTION__);
        //  applicant_personal_det insert / update
        $applicant_personal_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns);
        
        //  applicant_other_details insert / update
        
        // update program id at applicant tbl
        $applicant_appln_det_table = APPLICANT_APPLN;
        $applicant_appln_det_columns = 'applicant_personal_det_id,appln_form_id,grad_id,active';
        $_POST = array();
        $_POST['grad_id']=PG_GRAD;
        $_POST['applicant_appln_id'] = $applicant_appln_id;
        $program_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns, false, 'applicant_appln_id');
        //end program id
        
        $medofinst=$this->post('medofinst',true);
        if(isset($medofinst) && is_numeric($medofinst)){
            $_POST = array();
            $_POST['active'] = TRUE;
            $_POST['medofinst']=$medofinst;
            $_POST['applicant_appln_id'] = $applicant_appln_id;
        }else{
            $_POST = array();
            $_POST['active'] = TRUE;
            $_POST['medofinst']=NULL;
            $_POST['applicant_appln_id'] = $applicant_appln_id;
        }
        $other_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_other_details_table, $applicant_other_details_columns, false, 'applicant_other_det_id');
        // course_pref
        $course_res = array();
        if($course_pref) {
            $wheredel = array();
            $wheredel['applicant_personal_det_id'] = $applicant_personal_det_id;
            $wheredel['applicant_appln_id'] = $applicant_appln_id;
            $wheredel['table_schema'] = SCHEMA_ADMISSION;
            $this->common->common_delete_new ( $applicant_course_prefer_table , $wheredel );
            
            foreach($course_pref as $k=>$v) {
                //if(is_numeric($v)){
                    $n_course_pref = $v;
                    $n_course_pref=($n_course_pref!='' && $n_course_pref!='null') ? $n_course_pref : NULL;
                    $n_course_prefer_id = $course_prefer_id[$k];
                    $n_course_choice_no = $course_choice_no[$k];
                    
                    $_SERVER["REQUEST_METHOD"] = "POST";
                    $_POST = array();
                    $_POST['active'] = TRUE;
                    $_POST['course_id'] = $n_course_pref;
                    $_POST['choice_no'] = $n_course_choice_no;
                    $_POST['applicant_appln_id'] = $applicant_appln_id;
                    $chk_flag = false;
                    if(!$n_course_pref) {
                        $chk_flag = true;
                    }
                    if(!$chk_flag) {
                        
                        $course_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_course_prefer_table, $applicant_course_prefer_columns, 1, 'applicant_course_prefer_id');
                    }
                    
               // }
            }//end foreach
            
        } //course preference end
        // campus_pref
        $campus_pref_res = array();
        if($campus_pref) {
            $wheredel = array();
            $wheredel['applicant_personal_det_id'] = $applicant_personal_det_id;
            $wheredel['applicant_appln_id'] = $applicant_appln_id;
            $wheredel['table_schema'] = SCHEMA_ADMISSION;
            $this->common->common_delete_new ( $applicant_campus_prefer_table , $wheredel );
            
            foreach($campus_pref as $k=>$v) {
                //if(is_numeric($v)){
                    $n_campus_pref = $v;
                    $n_campus_pref=($n_campus_pref!='' && $n_campus_pref!='null') ? $n_campus_pref : NULL;
                    $n_campus_prefer_id = $applicant_campus_prefer_id[$k];
                    $n_campus_choice_no = $campus_choice_no[$k];
                    
                    $_SERVER["REQUEST_METHOD"] = "POST";
                    $_POST = array();
                    $_POST['active'] = TRUE;
                    $_POST['campus_id'] = $n_campus_pref;
                    $_POST['choice_no'] = $n_campus_choice_no;
                    $_POST['applicant_appln_id'] = $applicant_appln_id;
                    $chk_flag = false;
                    if(!$n_campus_pref)
                    {
                        $chk_flag = true;
                    }
                    if(!$chk_flag) {
                        $campus_pref_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_campus_prefer_table, $applicant_campus_prefer_columns, 1, 'applicant_campus_prefer_id');
                    }
                //}
                
            }//end foreach
            
        }//end if
        
        // campus_pref end
        
        //city state preference
        $applicant_city_prefer_columns = 'applicant_personal_det_id,applicant_appln_id,city_id,city_name,choice_no,state_id,active';
        if($applicant_city_prefer_id) {
            $applicant_city_prefer_columns .= ',applicant_city_prefer_id';
        }
        $city_pref_res = array();
        if($city_pref) {
            $wheredel = array();
            $wheredel['applicant_personal_det_id'] = $applicant_personal_det_id;
            $wheredel['applicant_appln_id'] = $applicant_appln_id;
            $wheredel['table_schema'] = SCHEMA_ADMISSION;
            $this->common->common_delete_new ( $applicant_city_prefer_table, $wheredel );
            
            foreach($city_pref as $k=>$v) {
                //if(is_numeric($v)){
                $n_city_pref = $v;
                $n_city_pref=($n_city_pref!='' && $n_city_pref!='null') ? $n_city_pref : NULL;
               
                $n_city_prefer_id = $city_prefer_id[$k];
                $n_city_choice_no = $city_choice_no[$k];
                $n_state_id = $state_pref[$k];
                
                $_SERVER["REQUEST_METHOD"] = "POST";
                $_POST = array();
                $_POST['active'] = TRUE;
                
                $_POST['city_id'] = $n_city_pref;
                $_POST['choice_no'] = $n_city_choice_no;
                $_POST['state_id'] = $n_state_id;
                $_POST['applicant_appln_id'] = $applicant_appln_id;
                
                    $chk_flag = false;
                    if(!$n_city_pref && !$n_state_id) {
                        $chk_flag = true;
                    }
                    if(!$chk_flag) {
                        $city_pref_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_city_prefer_table, $applicant_city_prefer_columns, 1, 'applicant_city_prefer_id');
                    }
                
               //}
               
            }
        }
        //end city stte preferenc
        $this->_get_common_error_status($course_res);
        $this->_get_common_error_status($campus_pref_res);
        $this->_get_common_error_status($city_pref_res);
        if($other_res) {
            if($other_res['status'] == 'error') {
                $this->response ($other_res , API_Controller::HTTP_OK);
            }else{
                $applicant_personal_det_res['other_res'] = $other_res;
                
            }
        }
        
        if($campus_pref_res) {
            $applicant_personal_det_res['campus_pref_res'] = $campus_pref_res;
        }
       
            $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id , FORM_WIZARD_PERSONAL_ID);
        
        $this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
    }
    
    public function parent_detail_post()
    {
        $app_form_id_mba = APP_FORM_ID_MBA;
        $applicant_parent_det_table = APPLICANT_PARENT_DET_TABLE;
        $applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
        $table_schema = SCHEMA_ADMISSION;
        $table_prefix = '';
        $applicant_personal_det_id = $this->post('applicant_id',true);
        $father_parent_det_id = $this->post('father_parent_det_id',true);
        $mother_parent_det_id = $this->post('mother_parent_det_id',true);
        $guardian_parent_det_id = $this->post('guardian_parent_det_id',true);
        $user_data = $this->post();
        $add_guardian_details = $user_data['add_guardian_details'];
        //if($add_guardian_details!="on" && ($add_guardian_details==1 || $add_guardian_details=="true" || $add_guardian_details==true)){
        if($add_guardian_details==1 || $add_guardian_details==="true" || $add_guardian_details===true){
            $add_gardian = 't';
        }else{
            $add_gardian = 'f';
        }
        
        // get applicant form pk id
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_mba);
        $applicant_appln_id = $applicant_appln_det_res['id'];
        
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['active'] = TRUE;
        $_POST['add_gardian'] = $add_gardian;
        $_POST['applicant_appln_id'] = $applicant_appln_id;
        
        $applicant_other_details_columns = 'applicant_personal_det_id,applicant_appln_id,add_gardian,active';
        
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
        $this->form_validation->set_rules('parent_father_name', 'Father Name','trim|required');
        $this->form_validation->set_rules('father_title', 'Father Title','trim|required');
        $this->form_validation->set_rules('parent_mother_name', 'Mother Name','trim|required');
        $this->form_validation->set_rules('mother_title', 'Mother Title','trim|required');
        if($add_gardian=='t'){
            $this->form_validation->set_rules('parent_guardian_name', 'Gardian Name','trim|required');
            $this->form_validation->set_rules('guardian_mobile_no', 'Gardian Mobile','trim|required');
            $this->form_validation->set_rules('guardian_email_id', 'Gardian Email','trim|required');
            $this->form_validation->set_rules('guardian_occupation', 'Gardian Occupation','trim|required');
        }
        //Run Validations
        if ($this->form_validation->run() == FALSE) {
            return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
        }
        
        $function_name = $this->get_function_name(__FUNCTION__);
        
        //  applicant_other_details insert / update
        $other_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_other_details_table, $applicant_other_details_columns,false,'applicant_other_det_id');
        
        
        // Father Detail
        $parent_type_father_id = $user_data['parent_type_father_id'];
        $parent_father_name = $user_data['parent_father_name'];
        $father_mobile_no = $user_data['father_mobile_no'];
        $father_alt_mobile_no = $user_data['father_alt_mobile_no'];
        $father_email_id = $user_data['father_email_id'];
        $father_occupation = $user_data['father_occupation'];
        $father_mob_country_code_id = $user_data['father_mob_country_code_id'];
        $father_alt_mob_country_code_id = $user_data['father_alt_mob_country_code_id'];$father_alt_mob_country_code_id = $user_data['father_alt_mob_country_code_id'];
        $father_title = $user_data['father_title'];
        $father_other_occupation = $user_data['father_other_occupation'];
        
        
        // Mother Detail
        $parent_type_mother_id = $user_data['parent_type_mother_id'];
        $parent_mother_name = $user_data['parent_mother_name'];
        $mother_mobile_no = $user_data['mother_mobile_no'];
        $mother_alt_mobile_no = $user_data['mother_alt_mobile_no'];
        $mother_email_id = $user_data['mother_email_id'];
        $mother_occupation = $user_data['mother_occupation'];
        $mother_mob_country_code_id = $user_data['mother_mob_country_code_id'];
        $mother_alt_mob_country_code_id = $user_data['mother_alt_mob_country_code_id'];$mother_alt_mob_country_code_id = $user_data['mother_alt_mob_country_code_id'];
        $mother_title = $user_data['mother_title'];
        $mother_other_occupation = $user_data['mother_other_occupation'];
        
        
        
        $applicant_parent_det_id[] = $father_parent_det_id;
        $parent_type_id[] = $parent_type_father_id;
        $parent_name[] = $parent_father_name;
        $mobile_no[] = $father_mobile_no;
        $alt_mobile_no[] = $father_alt_mobile_no;
        $email_id[] = $father_email_id;
        $occupation[] = $father_occupation;
        $other_occupation[] = $father_other_occupation;
        $mob_country_code_id[] = $father_mob_country_code_id;
        $alt_mob_country_code_id[] = $father_alt_mob_country_code_id;
        $title[] = $father_title;
        
        $applicant_parent_det_id[] = $mother_parent_det_id;
        $parent_type_id[] = $parent_type_mother_id;
        $parent_name[] = $parent_mother_name;
        $mobile_no[] = $mother_mobile_no;
        $alt_mobile_no[] = $mother_alt_mobile_no;
        $email_id[] = $mother_email_id;
        $occupation[] = $mother_occupation;
        $other_occupation[] = $mother_other_occupation;
        $mob_country_code_id[] = $mother_mob_country_code_id;
        $alt_mob_country_code_id[] = $mother_alt_mob_country_code_id;
        $title[] = $mother_title;
        // Guardian Detail
        if($add_gardian=='t'){
            $parent_type_guardian_id = $user_data['parent_type_guardian_id'];
            $parent_guardian_name = $user_data['parent_guardian_name'];
            $guardian_mobile_no = $user_data['guardian_mobile_no'];
            $guardian_alt_mobile_no = $user_data['guardian_alt_mobile_no'];
            $guardian_email_id = $user_data['guardian_email_id'];
            $guardian_occupation = $user_data['guardian_occupation'];
            $guardian_other_occupation = $user_data['guardian_other_occupation'];
            $guardian_mob_country_code_id = $user_data['guardian_mob_country_code_id'];
            $guardian_alt_mob_country_code_id = $user_data['guardian_alt_mob_country_code_id'];
            
            $applicant_parent_det_id[] = $guardian_parent_det_id;
            $parent_type_id[] = $parent_type_guardian_id;
            $parent_name[] = $parent_guardian_name;
            $mobile_no[] = $guardian_mobile_no;
            $alt_mobile_no[] = $guardian_alt_mobile_no;
            $email_id[] = $guardian_email_id;
            $occupation[] = $guardian_occupation;
            $other_occupation[] = $guardian_other_occupation;
            $mob_country_code_id[] = $guardian_mob_country_code_id;
            $title[] = $guardian_title;
        }
        
        if($add_gardian=='f'){
            $whereparentgno = array();
            $whereparentgno['applicant_personal_det_id'] = $applicant_personal_det_id;
            $whereparentgno['parent_type_id'] = $user_data['parent_type_guardian_id'];
            $whereparentgno['applicant_appln_id'] = $applicant_appln_id;
            $whereparentgno['table_schema'] = SCHEMA_ADMISSION;
            $this->common->common_delete_new ( $applicant_parent_det_table , $whereparentgno );
            
        }
        // parent detail
        $parent_res = array();
        
        if($parent_type_id) {
            foreach($parent_type_id as $k=>$v) {
                $n_parent_type_id = $v;
                $n_applicant_parent_det_id = $applicant_parent_det_id[$k];
                $n_parent_name = $parent_name[$k];
                $n_mobile_no = $mobile_no[$k];
                $n_alt_mobile_no = $alt_mobile_no[$k];
                $n_email_id = $email_id[$k];
                $n_occupation = $occupation[$k];
                $n_mob_country_code_id = $mob_country_code_id[$k];
                $n_alt_mob_country_code_id = $alt_mob_country_code_id[$k];
                $n_title = $title[$k];
                
                $_SERVER["REQUEST_METHOD"] = "POST";
                $_POST = array();
                $_POST['active'] = TRUE;
               // $_POST['updated_by'] = $applicant_personal_det_id;
                
                
                $applicant_parent_det_columns = 'applicant_personal_det_id,applicant_appln_id,parent_type_id,parent_name,mobile_no,email_id,occupation_id,active,mob_country_code_id,title_id,alt_mob_countrycode_id,alt_mobile_no';
                if($n_applicant_parent_det_id) {
                    $_POST['applicant_parent_det_id'] = $n_applicant_parent_det_id;
                    $applicant_parent_det_columns .= ',applicant_parent_det_id';
                }
                if($n_occupation==OTHER_OCCUPATION)
                {
                    $applicant_parent_det_columns .= ',other_occupation_name';
                    $_POST['other_occupation_name'] = $other_occupation[$k];
                }else{
                    $applicant_parent_det_columns .= ',other_occupation_name';
                    $_POST['other_occupation_name'] = NULL;
                    
                }
                
                $n_occupation=($n_occupation!='' && $n_occupation!='null')?$n_occupation : NULL;
                $n_mob_country_code_id=($n_mob_country_code_id!='' && $n_mob_country_code_id!='null')?$n_mob_country_code_id : NULL;
                $n_alt_mob_country_code_id=($n_alt_mob_country_code_id!='' && $n_alt_mob_country_code_id!='null')?$n_alt_mob_country_code_id : NULL;
                
                $_POST['parent_type_id'] = $n_parent_type_id;
                $_POST['parent_name'] = $n_parent_name;
                $_POST['mobile_no'] = $n_mobile_no;
                $_POST['email_id'] = $n_email_id;
                $_POST['occupation_id'] = $n_occupation;
                $_POST['mob_country_code_id'] = $n_mob_country_code_id;
                $_POST['alt_mob_countrycode_id'] = $n_alt_mob_country_code_id;
                $_POST['alt_mobile_no'] = $n_alt_mobile_no;
                $_POST['title_id'] = $n_title;
                $_POST['applicant_appln_id'] = $applicant_appln_id;
                
                if($n_applicant_parent_det_id) {
                    $parent_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_parent_det_table, $applicant_parent_det_columns, 1, 'applicant_parent_det_id', $n_applicant_parent_det_id);
                    
                } else {
                    $chk_flag = false;
                    if(!$n_parent_name && !$n_mobile_no && !$n_email_id && !$n_occupation && !$n_mob_country_code_id && !$n_title) {
                        $chk_flag = true;
                    }
                    if(!$chk_flag) {
                        $parent_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_parent_det_table, $applicant_parent_det_columns, 1, 'applicant_parent_det_id');
                    }
                }
            }
        }
        
        $this->_get_common_error_status($parent_res);
        
        if($other_res) {
            if($other_res['status'] == 'error') {
                $this->response ($other_res , API_Controller::HTTP_OK);
            } else {
                $applicant_personal_det_res['other_res'] = $other_res;
            }
        }
        if($parent_res){
            $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_mba , FORM_WIZARD_PARENT_ID);
        } 
        $this->response ($parent_res , API_Controller::HTTP_OK);
        
    }
    
    public function addressdet_post()
    {
        $table = TABLE_APPLICANT_ADDR_DET;
        $table_schema = SCHEMA_ADMISSION;
        $table_prefix = '';
        $applicant_personal_det_id = $this->input->post('applicant_personal_det_id');
        $app_form_id = $this->input->post('app_form_id');
        // get applicant form pk id
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
        $applicant_appln_id = $applicant_appln_det_res['id'];
        
        $country_id = $this->input->post('country_id');
        $country_india=COUNTRY_VALUE_DEFAULT;
        
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['addr_type_id'] = LOOKUP_VALUE_ADDRESS_COMMUNICATION;
        $_POST['active'] = TRUE;
        $_POST['applicant_appln_id'] = $applicant_appln_id;
        $columns = 'addr_type_id,applicant_personal_det_id,applicant_appln_id,country_id,address_line_1,pincode,active,address_line_2,active';
        $this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
        $this->form_validation->set_rules('country_id', 'Country Id','trim|required');
        if($country_id==$country_india){
            $columns .= ',state_id,city_id,district_id';
            $this->form_validation->set_rules('state_id', 'State Id','trim|required');
            $this->form_validation->set_rules('district_id', 'District Id','trim|required');
            $this->form_validation->set_rules('city_id', 'City Id','trim|required');
        }
        $this->form_validation->set_rules('address_line_1', 'Address 1','trim|required');
        $this->form_validation->set_rules('pincode', 'Pincode','trim|required');
        if ($this->form_validation->run() == FALSE) {
            return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
        }
        $function_name = $this->get_function_name(__FUNCTION__);
        $check_user = $this->check_exist_user($table , $table_schema , $columns ,  array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id));
        if(isset($check_user['data']) && !empty($check_user['data']))
        {
            $columns.=',updated_by';
            $put_array = $this->post();
            //$put_array[$table_prefix.'id'] = $applicant_personal_det_id;
            //$update = $this->_common_update ( $table , $table_prefix , $function_name , $columns , $put_array ,  'applicant_personal_det_id',$table_schema);
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
                $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id , FORM_WIZARD_ADDRESS_ID);
                
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
            $columns.=',created_by';
            $insert = $this->_common_insert ( $table , $table_prefix , $function_name , $columns , $table_schema );
            
            if ( $insert ) {
                $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id , FORM_WIZARD_ADDRESS_ID);
                
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
    public function academicdet_post()
    {
        $app_form_id_mba = APP_FORM_ID_MBA;
        $applicant_graduation_table = APPLICANT_GRADUATION_TABLE;
        $applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
        $applicant_professional_exp_table = APPLICANT_PROFESSIONAL_EXP_TABLE;
        $applicant_competitive_exam_det_table = APPLICANT_COMPETITIVE_EXAM_DET_TABLE;
        $applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
        $table_schema = SCHEMA_ADMISSION;
        $table_prefix = '';
        $applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
        $applicant_grad_det_id = $this->post('applicant_grad_det_id',true);
        $cur_qual_completed = $this->post('cur_qual_completed',true);
        $is_competitive_exam = $this->post('is_competitive_exam',true);
        $expectedmonthyearresult = $this->post('expectedmonthyearresult',true);
        if($expectedmonthyearresult) {
            $expectedmonthyearresult = '01-'.str_replace('/', '-', $expectedmonthyearresult);
            $expectedmonthyearresult = date('Y-m-d',strtotime($expectedmonthyearresult));
        }
        $is_work_experience = $this->post('is_work_experience',true);
        
        $prof_exp_ids = $this->post('prof_exp_ids',true);
        $prof_exp_ids = json_decode($prof_exp_ids,true);
        $org_name = $this->post('org_name',true);
        $org_name = json_decode($org_name,true);
        $designation = $this->post('designation',true);
        $designation = json_decode($designation,true);
        $sector = $this->post('sector',true);
        $sector = json_decode($sector,true);
        $other_sector = $this->post('other_sector',true);
        $other_sector = json_decode($other_sector,true);
        $salary = $this->post('month_salary',true);
        $salary = json_decode($salary,true);
        $from_date = $this->post('from_date',true);
        $from_date = json_decode($from_date,true);
        $to_date = $this->post('to_date',true);
        $to_date = json_decode($to_date,true);
        $work_exp_in_months = $this->post('work_exp_in_month',true);
        $work_exp_in_months = json_decode($work_exp_in_months,true);
        
        $comp_exam_pk_id = $this->post('comp_exam_pk_id',true);
        $comp_exam_pk_id = json_decode($comp_exam_pk_id,true);
        $comp_exam_id = $this->post('comp_exam_id',true);
        $comp_exam_id = json_decode($comp_exam_id,true);
        $comp_exam_registration_no = $this->post('comp_exam_registration_no',true);
        $comp_exam_registration_no = json_decode($comp_exam_registration_no,true);
        $score_obtained = $this->post('exam_score_obtained',true);
        $score_obtained = json_decode($score_obtained,true);
        $max_score = $this->post('exam_max_score',true);
        $max_score = json_decode($max_score,true);
        $year_appeared = $this->post('year_appeared',true);
        $year_appeared = json_decode($year_appeared,true);
        $air_overall_rank = $this->post('air_overall_rank',true);
        $air_overall_rank = json_decode($air_overall_rank,true);
        $qualified_not_qualified = $this->post('qualified_not_qualified',true);
        $qualified_not_qualified = json_decode($qualified_not_qualified,true);
        
        $univ_id = $this->post('univ_id',true);
        $mark_scheme_id = $this->post('mark_scheme_id',true);
        $mark_percent = $this->post('mark_percent',true);
        $completion_year = $this->post('completion_year',true);
        
        // get applicant form pk id
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_mba);
        $applicant_appln_id = $applicant_appln_det_res['id'];
        
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['active'] = TRUE;
        //$_POST['created_by'] = $applicant_personal_det_id;
        //$_POST['updated_by'] = $applicant_personal_det_id;
        $_POST['applicant_appln_id'] = $applicant_appln_id;
        $_POST['expectedmonthyearresult'] = $expectedmonthyearresult;
        
        $applicant_personal_det_columns = 'applicant_personal_det_id,digilocker_id,name_in_marksheet,active';
        
        $applicant_graduation_columns = 'applicant_grad_det_id,applicant_personal_det_id,insti_name,univ_id,other_university_name,completion_year,active,registration_no,mode_of_study_id,applicant_appln_id,result_declared,is_curr_qualify';
        //if($cur_qual_completed == 't') {
            $applicant_graduation_columns .= ',mark_scheme_id,mark_percent';
        //}
        $applicant_other_details_columns = 'applicant_personal_det_id,cur_qual_completed,is_work_experience,is_competitive_exam,active,applicant_appln_id';
        if($cur_qual_completed == 'f') {
            $applicant_other_details_columns .= ',expectedmonthyearresult';
        }        
        $applicant_professional_exp_columns = 'applicant_prof_exp_id,applicant_personal_det_id,org_name,designation,sector_id,salary,from_date,to_date,work_exp_in_months,active,applicant_appln_id';
        // is_work_experience, taken_any_competitive_exam, competitive_exam, phd_major
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
        $this->form_validation->set_rules('cur_qual_completed', 'Current Education Qualification Status','trim|required');
        if($cur_qual_completed == 'f') {
            $this->form_validation->set_rules('expectedmonthyearresult', 'Expected month and Year of result to be declared','trim|required');
        }
        $this->form_validation->set_rules('insti_name', 'Institute Name','trim|required');
        $this->form_validation->set_rules('univ_id', 'University','trim|required');
        $this->form_validation->set_rules('mode_of_study_id', 'Mode of study','trim|required');
        if($cur_qual_completed == 't') {
            $this->form_validation->set_rules('mark_scheme_id', 'Schema Mark','trim|required');
            $this->form_validation->set_rules('mark_percent', 'Obtained Percentage','trim|required');
        }
        $this->form_validation->set_rules('completion_year', 'Year of pass','trim|required');
        $this->form_validation->set_rules('registration_no', 'Register','trim|required');
        $this->form_validation->set_rules('name_in_marksheet', 'Name Marksheet','trim|required');
        $this->form_validation->set_rules('is_work_experience', 'Work Experience Details','trim|required');
        
        if($is_work_experience == 't') {            
            $this->form_validation->set_rules('org_name[0]', 'Organization name','trim|required');
            $this->form_validation->set_rules('designation[0]', 'Designation','trim|required');
            $this->form_validation->set_rules('sector[0]', 'Sector Of Job','trim|required');
            $this->form_validation->set_rules('month_salary[0]', 'Total Salary Month','trim|required');
            $this->form_validation->set_rules('from_date[0]', 'From Date','trim|required');
            $this->form_validation->set_rules('to_date[0]', 'To Date','trim|required');
            $this->form_validation->set_rules('work_exp_in_month[0]', 'Work Experience','trim|required');
            $this->form_validation->set_rules('total_work_exp', 'Work Experience in months','trim|required');
           
        }
        
        if($is_competitive_exam == 't') {
            $this->form_validation->set_rules('comp_exam_id[0]', 'Competitive Examination','trim|required');
            $this->form_validation->set_rules('comp_exam_registration_no[0]', 'Registration No','trim|required');
            $this->form_validation->set_rules('exam_score_obtained[0]', 'Score Obtained','trim|required');
            $this->form_validation->set_rules('exam_max_score[0]', 'Max Score','trim|required');
            $this->form_validation->set_rules('year_appeared[0]', 'Year Appeared','trim|required');
            $this->form_validation->set_rules('air_overall_rank[0]', 'AIR / Overall Rank','trim|required');
            $this->form_validation->set_rules('qualified_not_qualified[0]', 'Qualified / Not Qualified','trim|required');
        }
        
        //Run Validations
        if ($this->form_validation->run() == FALSE) {
            return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
        }
        
        $function_name = $this->get_function_name(__FUNCTION__);
        //  applicant_other_details insert / update
        if($is_work_experience == 't') {
            $applicant_other_details_columns.=",total_work_exp";
        }
        $other_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_other_details_table, $applicant_other_details_columns, false, 'applicant_other_det_id');
        if(isset($cur_qual_completed) && ($cur_qual_completed=='f')){
            $mark_scheme_id=NULL;
            $mark_percent=NULL;
        }
        $univ_id=isset($univ_id) ? $univ_id :'';
        if($univ_id!=OTHER_UNIVERSITY){
            $university_other=Null;
        }
        $_POST['mark_scheme_id'] = $mark_scheme_id;
        $_POST['mark_percent'] = $mark_percent;        
        $_POST['other_university_name'] = $university_other;
        //  applicant_personal_det insert / update
        $applicant_personal_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns);
        
        // applicant_graduation_table
        $degree_res = array();
        if($applicant_grad_det_id) {
            $degree_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'applicant_grad_det_id'=>$applicant_grad_det_id), $table_schema, $applicant_graduation_table, $applicant_graduation_columns, 2, 'applicant_grad_det_id', $applicant_grad_det_id);
        } else {
            $degree_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_graduation_table, $applicant_graduation_columns, 1, 'applicant_grad_det_id');
        }
        
        // applicant_competitive_exam_table
        $competitive_exam_res = array();
        if($is_competitive_exam == 't') {
            foreach($comp_exam_id as $k=>$v) {
               // if(is_numeric($v)){
                $n_comp_exam_id = $v;
                $n_comp_exam_id = ($n_comp_exam_id!='' && $n_comp_exam_id != 'null')?$n_comp_exam_id:NULL;
                $n_comp_exam_pk_id = $comp_exam_pk_id[$k];
                $n_comp_exam_registration_no = $comp_exam_registration_no[$k];
                $n_score_obtained = is_numeric($score_obtained[$k]) ? $score_obtained[$k] : '';
                $n_max_score = is_numeric($max_score[$k]) ? $max_score[$k] : '';
                $n_year_appeared = $year_appeared[$k];
                $n_air_overall_rank = is_numeric($air_overall_rank[$k]) ? $air_overall_rank[$k] :'';
                $n_qualified_not_qualified = $qualified_not_qualified[$k];
                
                $applicant_competitive_exam_det_columns = 'applicant_personal_det_id,active,applicant_appln_id,comp_exam_id,registration_no,score_obtained,max_score,exam_year,all_india_rank,qualified';
                /* if($n_comp_exam_id != '') {
                    $applicant_competitive_exam_det_columns .= ',comp_exam_id';
                }
                if($n_comp_exam_registration_no != '') {
                    $applicant_competitive_exam_det_columns .= ',registration_no';
                }
                if($n_score_obtained != '') {
                    $applicant_competitive_exam_det_columns .= ',score_obtained';
                }
                if($n_max_score != '') {
                    $applicant_competitive_exam_det_columns .= ',max_score';
                }
                if($n_year_appeared != '') {
                    $applicant_competitive_exam_det_columns .= ',exam_year';
                }
                if($n_air_overall_rank != '') {
                    $applicant_competitive_exam_det_columns .= ',all_india_rank';
                }
                if($n_qualified_not_qualified != '') {
                    $applicant_competitive_exam_det_columns .= ',qualified';
                } */
                
                $n_comp_exam_id=!empty($n_comp_exam_id) ?$n_comp_exam_id : NULL;
                $n_comp_exam_registration_no=!empty($n_comp_exam_registration_no) ?$n_comp_exam_registration_no : NULL;
                $n_score_obtained=($n_score_obtained!='') ?$n_score_obtained : NULL;
                $n_max_score=($n_max_score!='') ?$n_max_score : NULL;
                $n_year_appeared=!empty($n_year_appeared) ?$n_year_appeared : NULL;
                $n_air_overall_rank=($n_air_overall_rank!='') ?$n_air_overall_rank : NULL;
                $n_qualified_not_qualified=!empty($n_qualified_not_qualified) ?$n_qualified_not_qualified : NULL;
                
                $_SERVER["REQUEST_METHOD"] = "POST";
                $_POST = array();   
                $_POST['active'] = TRUE;
                $_POST['applicant_entr_exam_det_id'] = $n_comp_exam_pk_id;
                $_POST['comp_exam_id'] = $n_comp_exam_id;
                $_POST['registration_no'] = $n_comp_exam_registration_no;
                $_POST['score_obtained'] = $n_score_obtained;
                $_POST['max_score'] = $n_max_score;
                $_POST['exam_year'] = $n_year_appeared;
                $_POST['all_india_rank'] = $n_air_overall_rank;
                $_POST['qualified'] = $n_qualified_not_qualified;                
                $_POST['applicant_appln_id'] = $applicant_appln_id;
                $_POST['active'] = TRUE;
                
                if($n_comp_exam_pk_id) {
                    $competitive_exam_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'applicant_entr_exam_det_id'=>$n_comp_exam_pk_id), $table_schema, $applicant_competitive_exam_det_table, $applicant_competitive_exam_det_columns, 2, 'applicant_entr_exam_det_id', $n_comp_exam_pk_id);
                } else {
                    $chk_flag = false;
                    if(!$n_comp_exam_id && !$n_comp_exam_registration_no && !$n_score_obtained && !$n_max_score &&  !$n_year_appeared && !$n_air_overall_rank && !$n_qualified_not_qualified) {
                        $chk_flag = true;
                    }
                    if(!$chk_flag) {
                        $competitive_exam_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_competitive_exam_det_table, $applicant_competitive_exam_det_columns, 1, 'applicant_entr_exam_det_id');
                    }
                }
           // }
            }
        }
        //delete work exp data if selected no
        if($is_competitive_exam == 'f') {
            $wheredel = array();
            $wheredel['applicant_personal_det_id'] = $applicant_personal_det_id;
            $wheredel['applicant_appln_id'] = $applicant_appln_id;
            $wheredel['table_schema'] = SCHEMA_ADMISSION;
            $this->common->common_delete_new ( $applicant_competitive_exam_det_table , $wheredel );
        }
        //end delete
        // applicant_professional_exp_table
        $professional_exp_res = array();
        if($is_work_experience == 't') {
            foreach($org_name as $k=>$v) {                
                $n_org_name = $v;
                $n_prof_exp_id = $prof_exp_ids[$k];
                $n_designation = $designation[$k];
                $n_sector = $sector[$k];
                $n_salary = is_numeric($salary[$k]) ? $salary[$k] : NULL;
                $n_from_date = $from_date[$k];
                $n_to_date = $to_date[$k];
                $n_work_exp_in_months = $work_exp_in_months[$k];
                $_SERVER["REQUEST_METHOD"] = "POST";
                $_POST = array();
                $_POST['active'] = TRUE;
                $n_sector = ($n_sector!='' && $n_sector != 'null')?$n_sector:NULL;
                
                if($n_sector==OTHER_SECTOR)
                {
                    $applicant_professional_exp_columns .= ',other_sector_name';
                    $_POST['other_sector_name'] = $other_sector[$k];
                }else{
                    $applicant_professional_exp_columns .= ',other_sector_name';
                    $_POST['other_sector_name'] = ' ';
                    
                }
                if($n_prof_exp_id) {
                    $_POST['applicant_prof_exp_id'] = $n_prof_exp_id;
                }
                
                $n_org_name=!empty($n_org_name)? $n_org_name: '';
                $n_designation=!empty($n_designation)? $n_designation: '';
                $n_sector=!empty($n_sector)? $n_sector: NULL;
                $n_salary=($n_salary!='')? $n_salary: NULL;
                $n_from_date=!empty($n_from_date)? $n_from_date: '';
                $n_to_date=!empty($n_org_name)? $n_to_date: '';
                
                $_POST['org_name'] = $n_org_name;
                $_POST['designation'] = $n_designation;
                $_POST['sector_id'] = $n_sector;
                $_POST['salary'] = $n_salary;
                $_POST['from_date'] = $n_from_date;
                $_POST['to_date'] = $n_to_date;
                $_POST['work_exp_in_months'] = ($n_work_exp_in_months!='') ? $n_work_exp_in_months : NULL;
                $_POST['applicant_appln_id'] = $applicant_appln_id;
                $_POST['active'] = TRUE;
                
                if($n_prof_exp_id) {                   
                    $professional_exp_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'applicant_prof_exp_id'=>$n_prof_exp_id), $table_schema, $applicant_professional_exp_table, $applicant_professional_exp_columns, 2, 'applicant_prof_exp_id', $n_prof_exp_id);
                } else {                    
                    $chk_flag = false;                   
                    if(!$n_org_name && !$n_designation && !$n_sector && !$n_salary &&  !$n_from_date && !$n_to_date && !$n_work_exp_in_months) {
                        $chk_flag = true;
                    }
                    if(!$chk_flag) {
                        $professional_exp_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_professional_exp_table, $applicant_professional_exp_columns, 1, 'applicant_prof_exp_id');
                    }
                }
            
            }
        }
        //delete work exp data if selected no
        if($is_work_experience == 'f') {
            $wheredel = array();
            $wheredel['applicant_personal_det_id'] = $applicant_personal_det_id;
            $wheredel['applicant_appln_id'] = $applicant_appln_id;
            $wheredel['table_schema'] = SCHEMA_ADMISSION;
            $this->common->common_delete_new ( $applicant_professional_exp_table , $wheredel );
        }
        //end delete
        
        $this->_get_common_error_status($competitive_exam_res);
        $this->_get_common_error_status($professional_exp_res);
        if($other_res) {
            if($other_res['status'] == 'error') {
                $this->response ($other_res , API_Controller::HTTP_OK);
            } else {
                $applicant_personal_det_res['other_res'] = $other_res;
            }
        }
        if($degree_res) {
            if($degree_res['status'] == 'error') {
                $this->response ($degree_res , API_Controller::HTTP_OK);
            } else {
                $applicant_personal_det_res['degree_res'] = $degree_res;
            }
        }
        
        if($competitive_exam_res){
            $applicant_personal_det_res['competitive_exam_res'] = $competitive_exam_res;
        }
        
        if($professional_exp_res){
            $applicant_personal_det_res['professional_exp_res'] = $professional_exp_res;
        }
        if($applicant_personal_det_res){
            $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_mba , FORM_WIZARD_ACADEMIC_ID);
        }
        $this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
   }
    public function declaration_post() {
        $app_form_id_mba = APP_FORM_ID_MBA;
        $applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
        $applicant_appln_det_table = APPLICANT_APPLN;
        $table_schema = SCHEMA_ADMISSION;
        $app_status=APPLICATION_IN_COMPLETED;
        
        $table_prefix = '';
        $applicant_appln_id = '';
        $applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
        $applicant_name = $this->post('applicant_name',true);
        $parent_name = $this->post('parent_name',true);
        $declaration_date = $this->post('declaration_date',true);
        $applicant_appln_id = $this->post('applicant_appln_id',true);
        // get applicant form pk id
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_mba);
        $applicant_appln_id = $applicant_appln_det_res['id'];
        $submitted_on=date("Y-m-d h:i:s");
        
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['active'] = TRUE;
        $_POST['appln_form_id'] = $app_form_id_mba;
        $_POST['applicant_name_declaration'] = $applicant_name;
        $_POST['applicant_parentname_declaration'] = $parent_name;
        $_POST['applicant_declaration_date'] = $declaration_date;
        $_POST['applicant_appln_id'] = $applicant_appln_id;
        $_POST['application_status_id'] = $app_status;
        $_POST['application_submission_date'] = $submitted_on;
        
        //$applicant_personal_det_columns = 'applicant_personal_det_id,applicant_appln_id,applicant_name,parent_name,declared_date,active';
        $applicant_appln_det_columns = 'applicant_personal_det_id,applicant_appln_id,applicant_name_declaration,applicant_parentname_declaration,applicant_declaration_date,application_status_id,active,application_submission_date';
        
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
        $this->form_validation->set_rules('applicant_name', 'Applicant name','trim|required');
        $this->form_validation->set_rules('parent_name', 'Parent name','trim|required');
        $this->form_validation->set_rules('declaration_date', 'Declaration date','trim|required');
        
        
        //Run Validations
        if ($this->form_validation->run() == FALSE) {
            return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
        }
        
        $function_name = $this->get_function_name(__FUNCTION__);
        //  applicant_personal_det insert / update
        $applicant_personal_det_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns,1,'applicant_appln_id',$applicant_appln_id);
        //$applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns);
        if($applicant_personal_det_res){
            $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_mba , FORM_WIZARD_DECLARATION_ID);
        }
        $this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
    }
    
    
    //MBA API end
}