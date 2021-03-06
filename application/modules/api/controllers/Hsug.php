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
class Hsug extends API_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    //HSUG API Start
    public function basic_detail_post() { 
		
        $app_form_id_hsug 			  = APP_FORM_ID_HSUG;
        $applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
        $applicant_appln_det_table    = APPLICANT_APPLN;
        $table_schema 				  = SCHEMA_ADMISSION;
        $app_status					  = APPLICATION_IN_PROGRESS;
        $table_prefix = '';
        $applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
        $qualifyingexamfromindia = $this->post('qualifyingexamfromindia',true);
        $applicant_appln_id = $this->post('applicant_appln_id',true);
        // get applicant form pk id
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_hsug);
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
        $_POST['appln_form_id'] = $app_form_id_hsug;
        $_POST['qualifyingexamfromindia'] = $qualifyingexamfromindia;
        $_POST['is_agree'] = $is_agree;
        $_POST['applicant_appln_id'] = $applicant_appln_id;        
        $_POST['application_status_id'] = $app_status;
        
        //$applicant_personal_det_columns = 'applicant_personal_det_id,is_agree,active';
        $applicant_appln_det_columns = 'applicant_personal_det_id,appln_form_id,qualifyingexamfromindia,is_agree,application_status_id,active';
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
            $applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns,false,'applicant_appln_id',false,$app_form_id_hsug);
        } else {
            $applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns, 1, 'applicant_appln_id', $applicant_appln_id,$app_form_id_hsug);
        }
        
        if($applicant_appln_det_res) {
            if($applicant_appln_det_res['status'] == 'error') {
                $this->response ($applicant_appln_det_res , API_Controller::HTTP_OK);
            } else {
                $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_hsug , FORM_WIZARD_BASIC_ID);
                $applicant_personal_det_res['appln_status'] = $applicant_appln_det_res;
            }
        }
        $this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
    }
    public function personal_detail_post() {
		
        $applicant_personal_det_table  = APPLICANT_PERSONAL_DET_TABLE;
        $applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
        $applicant_course_prefer_table = APPLICANT_COURSE_PREFER_TABLE;
        $applicant_campus_prefer_table = APPLICANT_CAMPUS_PREFER_TABLE;
        $applicant_city_prefer_table   = APPLICANT_CITY_PREFER_TABLE;
        
        $app_form_id  			   = APP_FORM_ID_HSUG;
        $table_schema 			   = SCHEMA_ADMISSION;
        $table_prefix 			   = '';
        $applicant_appln_id 	   = '';
        $applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
        
        $course_prefer_id = $this->post('course_prefer_id',true);
        $course_prefer_id = json_decode($course_prefer_id,true);
        $course_pref      = $this->post('course_pref',true);
        $course_pref      = json_decode($course_pref,true);
        $course_choice_no = $this->post('course_choice_no',true);
        $course_choice_no = json_decode($course_choice_no,true);
        
        $campus_pref 	  = $this->post('campus_pref',true);
        $campus_pref      = json_decode($campus_pref,true);
        
        $campus_choice_no = $this->post('campus_choice_no',true);
        $campus_choice_no = json_decode($campus_choice_no,true);
        $applicant_campus_prefer_id = $this->post('campus_prefer_id',true);
        $applicant_campus_prefer_id = json_decode($applicant_campus_prefer_id,true);
       
        $state_pref 	= $this->post('state_pref',true);
        $state_pref     = json_decode($state_pref,true);
        $city_pref      = $this->post('city_pref',true);
        $city_pref      = json_decode($city_pref,true);
        $city_choice_no = $this->post('city_choice_no',true);
        $city_choice_no = json_decode($city_choice_no,true);
        
        // get applicant form pk id
        
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
        $applicant_appln_id      = $applicant_appln_det_res['id'];
        $title_id                = $this->post('title_id',true);
        $gender_id               = $this->post('gender_id',true);
        $blood_group_id          = $this->post('blood_grp_id',true);
        $religion_id             = $this->post('religion_id',true);
        $mother_tongue_id        = $this->post('mother_tongue_id',true);
        $hostel_accomadation_id  = $this->post('prefer_hostel',true);
        $diffrently_abled_id     = $this->post('diff_abled',true);
        $admission_adv_id        = $this->post('advertisement_source_id',true);
        $nationality_id          = $this->post('nationality_id',true);
        $social_status_id        = $this->post('social_status_id',true);
        $phone_no_code           = $this->post('phone_no_code',true);
        
        $title_id				 = ($title_id!='' && $title_id!='null')?$title_id : NULL;
        $gender_id				 = ($gender_id!='' && $gender_id!='null')?$gender_id : NULL;
        $blood_group_id			 = ($blood_group_id!='' && $blood_group_id!='null')?$blood_group_id : NULL;
        $religion_id			 = ($religion_id!='' && $religion_id!='null')?$religion_id : NULL;
        $mother_tongue_id		 = ($mother_tongue_id!='' && $mother_tongue_id!='null')?$mother_tongue_id : NULL;
        $hostel_accomadation_id  = ($hostel_accomadation_id!='' && $hostel_accomadation_id!='null')?$hostel_accomadation_id : NULL;
        $diffrently_abled_id	 = ($diffrently_abled_id!='' && $diffrently_abled_id!='null')?$diffrently_abled_id : NULL;
        $nationality_id			 = ($nationality_id!='' && $nationality_id!='null')?$nationality_id : NULL;
        $social_status_id		 = ($social_status_id!='' && $social_status_id!='null')?$social_status_id : NULL;
        $admission_adv_id		 = ($admission_adv_id!='' && $admission_adv_id!='null')?$admission_adv_id : NULL;
        $phone_no_code			 = ($phone_no_code!='' && $phone_no_code!='null')?$phone_no_code : NULL;
        
        $_SERVER["REQUEST_METHOD"]				= "POST";
        $_POST['active'] 		  				= TRUE;		
        $_POST['applicant_mob_country_code_id'] = $mobile_no_code;
        $_POST['applicant_appln_id'] 			= $applicant_appln_id;
        //new
        $_POST['title_id'] 						= $title_id;
        $_POST['gender_id'] 					= $gender_id;
        $_POST['blood_grp_id'] 					= $blood_group_id;
        $_POST['religion_id'] 					= $religion_id;
        $_POST['mothertongue_id'] 				= $mother_tongue_id;
        $_POST['prefer_hostel'] 				= $hostel_accomadation_id;
        $_POST['diff_abled'] 					= $diffrently_abled_id;
        $_POST['advertisement_source_id'] 		= $admission_adv_id;
        $_POST['nationality_id']		  		= $nationality_id;
        $_POST['social_status_id']  			= $social_status_id;
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
        //  applicant_other_details insert / update
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
            $wheredel 							   = array();
            $wheredel['applicant_personal_det_id'] = $applicant_personal_det_id;
            $wheredel['applicant_appln_id']        = $applicant_appln_id;
            $wheredel['table_schema'] 			   = SCHEMA_ADMISSION;
            $this->common->common_delete_new ( $applicant_course_prefer_table , $wheredel );
            
            foreach($course_pref as $k=>$v) {
                //if(is_numeric($v)){
                    $n_course_pref 		= $v;
                    $n_course_pref		= ($n_course_pref!='' && $n_course_pref!='null') ? $n_course_pref : NULL;
                    $n_course_prefer_id = $course_prefer_id[$k];
                    $n_course_choice_no = $course_choice_no[$k];
                    
                    $_SERVER["REQUEST_METHOD"]   = "POST";
                    $_POST 						 = array();
                    $_POST['active'] 			 = TRUE;
                    $_POST['course_id'] 		 = $n_course_pref;
                    $_POST['choice_no'] 		 = $n_course_choice_no;
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
            $wheredel 							  = array();
            $wheredel['applicant_personal_det_id'] = $applicant_personal_det_id;
            $wheredel['applicant_appln_id']        = $applicant_appln_id;
            $wheredel['table_schema'] 			   = SCHEMA_ADMISSION;
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
        $app_form_id_hsug = APP_FORM_ID_HSUG;
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
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_hsug);
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
                //$_POST['updated_by'] = $applicant_personal_det_id;
                
                
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
                    $_POST['other_occupation_name'] = ' ';
                    
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
            $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_hsug , FORM_WIZARD_PARENT_ID);
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
			$columns .=',updated_by';
			$put_array=$_POST;
			$put_array['allow_empty']=TRUE;
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
			$columns .=',created_by';	
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
	
	/* Function For Acdemic Part Start */
    public function academicdet_post()
    {
        $app_form_id_hsug 				      = APP_FORM_ID_HSUG;
        $applicant_other_details_table    	  = APPLICANT_OTHER_DETAILS_TABLE;
        $applicant_personal_det_table 		  = APPLICANT_PERSONAL_DET_TABLE;
		$applicant_schooling_det_table        = APPLICANT_SCHOOLING_TABLE;
			
        $table_schema 						  = SCHEMA_ADMISSION;
        $table_prefix 						  = '';
		
		// Constant Value
		$schooling_id = SCHOOLING_ID_TWELFTH;
		
		$applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
		
		// Form Data Posted 
		$current_education_status = $this->post('current_education_qual_status',true);
		$candidate_name     	  = $this->post('name_in_marksheet',true); 
		$institute_name           = $this->post('institute_name',true);
		$academic_board           = $this->post('academic_board',true);
		if ($academic_board==OTHER_BOARD)  
		{
			$other_board_name	  = $this->post('other_board_name',true);
		}
		else {
			$other_board_name	  = '';
		}
		$registration_no	      = $this->post('registration_no',true);
		$mode_of_study	      	  = $this->post('mode_of_study_id',true);
		$marking_scheme           = $this->post('mark_scheme_id',true);
		$obtained_percentage_cgpa = $this->post('mark_percentage',true);
		$year_of_passing          = $this->post('completion_year',true);
		$cur_qual_completed       = $this->post('cur_qual_completed',true);
		$is_curr_qualify          = $this->post('is_curr_qualify',true); 
		$digilocker_id            = $this->post('digilocker_id',true);
		$address_school_college	  = $this->post('address_school_college',true);
		$created_by	 			  = $this->post('created_by',true);
		$updated_by				  = $this->post('updated_by',true);
		
		
		if($cur_qual_completed=='f' && $is_curr_qualify=='f'){
			$curr_edu_quali_status = false;
			$is_current_qualify = false;
			$marking_scheme = null;
			$obtained_percentage_cgpa =null;
			$registration_no=null;
		}else{
			$curr_edu_quali_status = true;
			$is_current_qualify = true;
		}
		
		// 12 appearing condition
		if ($cur_qual_completed=='')
		{
			$marking_scheme = '';
			$obtained_percentage_cgpa ='';
		}
		
		
		
        // get applicant form pk id
        $applicant_appln_det_res  = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_hsug);
        $applicant_appln_id       = $applicant_appln_det_res['id']; 
		    
		// Form Method
        $_SERVER["REQUEST_METHOD"]   = "POST";
        
        $applicant_personal_det_columns = 'applicant_personal_det_id,digilocker_id,name_in_marksheet,updated_by,active';
        
		$applicant_schooling_columns = 'institute_name,other_board_name,board_id,marking_scheme_id,mark_percentage, completion_year,registration_no,schooling_id,name_as_in_marksheet,result_declared,is_curr_qualify,active,created_by,applicant_appln_id,applicant_personal_det_id,mode_of_study_id,address';	

		//applicant_personal_det_id,applicant_appln_id,other_board_name
		
        // Check the Validation Rule
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
        $this->form_validation->set_rules('cur_qual_completed','Current Education Qualification Status','trim|required');
        $this->form_validation->set_rules('institute_name', 'Institute Name','trim|required');
        $this->form_validation->set_rules('academic_board', 'Academic Board','trim|required');
        $this->form_validation->set_rules('mode_of_study_id', 'Mode of study','trim|required');
        
		if($cur_qual_completed == 't') {
            $this->form_validation->set_rules('mark_scheme_id', 'Schema Mark','trim|required');
            $this->form_validation->set_rules('mark_percentage', 'Obtained Percentage','trim|required');
			$this->form_validation->set_rules('registration_no', 'Register','trim|required');
        }
        
		$this->form_validation->set_rules('completion_year', 'Year of pass','trim|required');        
        $this->form_validation->set_rules('name_in_marksheet', 'Name Marksheet','trim|required');
        
        
        //Run Validations
        if ($this->form_validation->run() == FALSE) {
            return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
        }
        
        $function_name = $this->get_function_name(__FUNCTION__);
        	
		// Check the condition if the record already exist or not in 	
		$check_applicant_id_sd = $this->check_exist_user($applicant_schooling_det_table, $table_schema,$applicant_schooling_columns,  array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'schooling_id'=>$schooling_id),1,'applicant_scl_det_id');
			
		if($check_applicant_id_sd['data'][0]['applicant_appln_id']==$applicant_appln_id)
		{	
			
			$whereschooling['applicant_personal_det_id'] = $applicant_personal_det_id;
			$whereschooling['schooling_id'] 			 = $schooling_id;
			$whereschooling['applicant_appln_id']        = $applicant_appln_id;				
			$put_arrayschool['name_as_in_marksheet']     = $candidate_name;
			$put_arrayschool['institute_name']           = $institute_name;
			$put_arrayschool['board_id']                 = $academic_board;
			$put_arrayschool['marking_scheme_id']        = $marking_scheme;
			$put_arrayschool['mark_percentage']          = $obtained_percentage_cgpa;
			$put_arrayschool['completion_year']          = $year_of_passing;
			$put_arrayschool['registration_no']          = $registration_no;
			$put_arrayschool['schooling_id']             = $schooling_id;
			$put_arrayschool['mode_of_study_id']         = $mode_of_study;
			$put_arrayschool['active']                   = true;
			$put_arrayschool['updated_by']               = $updated_by;
			$put_arrayschool['result_declared']          = $curr_edu_quali_status;
			$put_arrayschool['is_curr_qualify']          = $is_current_qualify;
			$put_arrayschool['other_board_name']         = $other_board_name;
			$put_arrayschool['address'] 				 = $address_school_college;
			$this->common->common_update ($table_schema.'.'.$applicant_schooling_det_table ,'' , $put_arrayschool, $whereschooling);
			$parent_res['twelfth'] = array("status"=>"Record updated successfully","type"=>"schooling detail twelfth");
			
		}else {
				
				$_POST['active'] 		     = TRUE;
				$_POST['created_by'] 	     = $created_by;				
				$_POST['applicant_appln_id'] = $applicant_appln_id;
				$_POST['applicant_personal_det_id'] = $applicant_personal_det_id;
				$_POST['name_as_in_marksheet'] = $candidate_name;
				$_POST['institute_name'] 	   = $institute_name;
				$_POST['other_board_name'] 	   = $other_board_name;
				$_POST['board_id'] 		 	   = $academic_board;
				$_POST['marking_scheme_id']    = $marking_scheme;
				$_POST['mark_percentage']	   = $obtained_percentage_cgpa;
				$_POST['completion_year']      = $year_of_passing;
				$_POST['registration_no']      = $registration_no;
				$_POST['schooling_id']         = $schooling_id;
				$_POST['mode_of_study_id']     = $mode_of_study;
				$_POST['result_declared']      = $cur_qual_completed;
				$_POST['is_curr_qualify']      = $is_curr_qualify;
				$_POST['address']      		   = $address_school_college;
				$table_prefix='';
				$function_name = $this->get_function_name ( __FUNCTION__ );      
				$this->_common_insert ( $applicant_schooling_det_table , $table_prefix , $function_name , $applicant_schooling_columns , $table_schema);
				$parent_res['twelfth'] = array("status"=>"Record added successfully","type"=>"schooling detail twelfth");
		
		}
		
		// Update the Digilocker Information
		if ($applicant_personal_det_columns) 
		{
			$_POST['active'] 		     = TRUE;
			//$_POST['created_by'] 	     = $applicant_personal_det_id;
			$_POST['updated_by'] 	     = $updated_by;
			$_POST['applicant_appln_id'] = $applicant_appln_id;
			$_POST['applicant_appln_id'] = $applicant_appln_id;
			$_POST['digilocker_id'] 	 = $digilocker_id;			
			
			$applicant_personal_det_table          = APPLICANT_PERSONAL_DET_TABLE;
			$parent_res['applicant_personal_det']  = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id), $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns, 2);
		} 
        
        if($parent_res){
            $wizard_update = $this->common_wizardupdate($applicant_personal_det_id, $app_form_id_hsug, FORM_WIZARD_ACADEMIC_ID);
        }
        $this->response ($parent_res , API_Controller::HTTP_OK);
   }
   /* Function For Acdemic Part End */
   
    public function declaration_post() {
        $app_form_id_hsug = APP_FORM_ID_HSUG;
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
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_hsug);
        $applicant_appln_id = $applicant_appln_det_res['id'];
        
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['active'] = TRUE;
        $_POST['appln_form_id'] = $app_form_id_hsug;
        $_POST['applicant_name_declaration'] = $applicant_name;
        $_POST['applicant_parentname_declaration'] = $parent_name;
        $_POST['applicant_declaration_date'] = $declaration_date;
        $_POST['applicant_appln_id'] = $applicant_appln_id;
        $_POST['application_status_id'] = $app_status;
        
        //$applicant_personal_det_columns = 'applicant_personal_det_id,applicant_appln_id,applicant_name,parent_name,declared_date,active';
        $applicant_appln_det_columns = 'applicant_personal_det_id,applicant_appln_id,applicant_name_declaration,applicant_parentname_declaration,applicant_declaration_date,application_status_id,active';
        
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
            $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_hsug , FORM_WIZARD_DECLARATION_ID);
        }
        $this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
    }
    
    
    //MBA API end
}