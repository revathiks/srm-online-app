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
class Bba extends API_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    //BBA API Start
    public function basic_detail_post() {
        $app_form_id_hcma = APP_FORM_ID_BBA;
        $applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
        $applicant_appln_det_table = APPLICANT_APPLN;
        $table_schema = SCHEMA_ADMISSION;
        $app_status=APPLICATION_IN_PROGRESS;
        $table_prefix = '';
        $applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
        $qualifyingexamfromindia = $this->post('qualifyingexamfromindia',true);
        $applicant_appln_id = $this->post('applicant_appln_id',true);
        // get applicant form pk id
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_hcma);
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
        $_POST['appln_form_id'] = $app_form_id_hcma;
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
            $applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns,false,'applicant_appln_id',false,$app_form_id_hcma);
        } else {
            $applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns, 1, 'applicant_appln_id', $applicant_appln_id,$app_form_id_hcma);
        }
        
        if($applicant_appln_det_res) {
            if($applicant_appln_det_res['status'] == 'error') {
                $this->response ($applicant_appln_det_res , API_Controller::HTTP_OK);
            } else {
                $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_hcma , FORM_WIZARD_BASIC_ID);
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
        $app_form_id=APP_FORM_ID_BBA;
        $table_schema = SCHEMA_ADMISSION;
        $table_prefix = '';
        $applicant_appln_id = '';
        $applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
        $campus_pref = $this->post('campus_pref',true);
        $campus_pref = json_decode($campus_pref,true);
        
        $campus_choice_no = $this->post('campus_choice_no',true);
        $campus_choice_no = json_decode($campus_choice_no,true);
        $applicant_campus_prefer_id = $this->post('campus_prefer_id',true);
        $applicant_campus_prefer_id = json_decode($applicant_campus_prefer_id,true);
        
        
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
        
        $applicant_campus_prefer_columns = 'applicant_personal_det_id,applicant_appln_id,campus_id,campus_name,choice_no,active';
        if($applicant_campus_prefer_id) {
            $applicant_campus_prefer_columns .= ',applicant_campus_prefer_id';
        }
        
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
        //$this->form_validation->set_rules('campus_pref[0]', 'Campus','trim|required');
        $this->form_validation->set_rules('title_id', 'Title','trim|required');
        $this->form_validation->set_rules('first_name', 'First Name','trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name','trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No','trim|required');
        $this->form_validation->set_rules('email_id', 'Email Id','trim|required');
        $this->form_validation->set_rules('dob', 'Date Of Birth','trim|required');
        $this->form_validation->set_rules('gender_id', 'Gender','trim|required');
        $this->form_validation->set_rules('blood_grp_id', 'Blood Group','trim|required');
        $this->form_validation->set_rules('diff_abled', 'Are You Differently Abled','trim|required');
        $this->form_validation->set_rules('nationality_id', 'Nationality','trim|required');
        if($nationality_id == COUNTRY_VALUE_DEFAULT) {
            $this->form_validation->set_rules('social_status_id', 'Social Status','trim|required');
        }
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
         $_POST['grad_id']=UG_GRAD;
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
        $this->_get_common_error_status($course_res);
        $this->_get_common_error_status($campus_pref_res);
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
        if($applicant_personal_det_res)
        {
            $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id , FORM_WIZARD_PERSONAL_ID);
         }
        $this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
    }
    
    public function parent_detail_post()
    {
        $app_form_id_hcma = APP_FORM_ID_BBA;
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
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_hcma);
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
            $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_hcma , FORM_WIZARD_PARENT_ID);
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
        $user_data = $this->post();
        $table_schema = SCHEMA_ADMISSION;
        $applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
        $applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
        $applicant_schooling_table = APPLICANT_SCHOOLING_TABLE;
        $applicant_graduation_table = APPLICANT_GRADUATION_TABLE;
        
        $current_qualification_status = $user_data['current_qualification_status'];
        $candidate_name = $user_data['candidate_name'];
        $applicant_id = $user_data['applicant_id'];
        $applicant_personal_det_id=$applicant_id;
        
        $app_form_id = $this->input->post('app_form_id');
        $cur_qual_completed_twelfth = $this->input->post('cur_qual_completed_twelfth');
        // get applicant form pk id
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
        $applicant_appln_id = $applicant_appln_det_res['id'];
        
        
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['active'] = TRUE;
       // $_POST['created_by'] = $applicant_personal_det_id;
       //$_POST['updated_by'] = $applicant_personal_det_id;
        $_POST['applicant_appln_id'] = $applicant_appln_id;
        
        //validation new
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('applicant_id', 'Personal det id','trim|required');
        $this->form_validation->set_rules('current_qualification_status', 'Current Education Qualification Status','trim|required');
        $this->form_validation->set_rules('candidate_name', 'Candidate Name as in 10th Certificate','trim|required');
        $this->form_validation->set_rules('institute_name_tenth', 'Tenth Institute Name','trim|required');
        $this->form_validation->set_rules('board_tenth', 'Tenth Board','trim|required');
        $this->form_validation->set_rules('marking_scheme_tenth', 'Tenth Marking Scheme','trim|required');
        $this->form_validation->set_rules('cgpa_tenth', 'Tenth Obtai ned Percentage/CGPA','trim|required');
        $this->form_validation->set_rules('yr_of_passing_tenth', 'Tenth Year of Passing','trim|required');
        $this->form_validation->set_rules('roll_no_tenth', 'Tenth Roll number','trim|required');
        
        //12th
        $this->form_validation->set_rules('institute_name_twelfth', 'Twelfth Institute Name','trim|required');
        $this->form_validation->set_rules('board_twelfth', 'Twelfth Board','trim|required');
        if($cur_qual_completed_twelfth == 't') {
            $this->form_validation->set_rules('marking_scheme_twelfth', ' Twelfth Marking Scheme','trim|required');
            $this->form_validation->set_rules('cgpa_twelfth', 'Twelfth Obtained Percentage/CGPA','trim|required');
            $this->form_validation->set_rules('yr_of_passing_twelfth', ' Twelfth Year of Passing','trim|required');
            $this->form_validation->set_rules('roll_no_twelfth', 'Twelfth Roll number','trim|required');
        }
        //Run Validations
        if ($this->form_validation->run() == FALSE) {
            return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
        }
        //end validation
        
        $function_name = $this->get_function_name ( __FUNCTION__ );
        //new
        $applicant_other_details_columns = 'applicant_personal_det_id,applicant_appln_id,cur_qual_completed,active';
        
        $applicant_personal_det_columns = 'applicant_personal_det_id,digilocker_id,active';
        
        $applicant_schooling_det_columns = 'applicant_personal_det_id,applicant_appln_id,result_declared,is_curr_qualify,institute_name,board_id,other_board_name,completion_year,registration_no,name_as_in_marksheet,schooling_id,attemptsetstenth,active';
        //  applicant_other_details insert / update
        $other_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_other_details_table, $applicant_other_details_columns, false, 'applicant_other_det_id');
        //  applicant_personal_det insert / update
        $applicant_personal_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns);
        
        
        //for scooling 10th
        $schooling_id_tenth = $this->post('schooling_id_tenth');
        $institute_name_tenth = $user_data['institute_name_tenth'];
        $board_tenth = $user_data['board_tenth'];
        $marking_scheme_tenth = ($user_data['marking_scheme_tenth']!='' && $user_data['marking_scheme_tenth']!='' && $user_data['marking_scheme_tenth']!='null') ? $user_data['marking_scheme_tenth'] :NULL;
        $cgpa_tenth = ($user_data['cgpa_tenth']!='' && $user_data['cgpa_tenth']!='null') ?$user_data['cgpa_tenth'] :NULL;
        $yr_of_passing_tenth = $user_data['yr_of_passing_tenth'];
        $roll_no_tenth = $user_data['roll_no_tenth'];
        $scholling_id_tenth = $user_data['scholling_id_tenth'];
        $other_tenth_board = $user_data['other_tenth_board'];
        $cur_qual_completed_tenth = $user_data['cur_qual_completed_tenth'];
        //if (is_numeric($marking_scheme_tenth)) {
            $applicant_schooling_det_columns.=',marking_scheme_id';
        //}
        //if (is_numeric($cgpa_tenth)) {
            $applicant_schooling_det_columns.=',mark_percentage';
        //}
        
        if(empty($schooling_id_tenth)) {
            $_POST['schooling_id'] = SCHOOLING_ID_TENTH;
        }
        $other_tenth_board=isset($other_tenth_board) ? $other_tenth_board:'';
        if($board_tenth!=OTHER_BOARD){
            $other_tenth_board=Null;
        }
        $tenth_attempt= $this->input->post('tenth_attempt');
        $tenth_attempt=!empty($tenth_attempt) ? $tenth_attempt :NULL;
        $_POST['institute_name']= $institute_name_tenth;
        $_POST['board_id'] = $board_tenth;
        $_POST['curr_edu_quali_status'] = $this->input->post('current_qualification_status');
        $_POST['other_board_name'] = $other_tenth_board;
        $_POST['marking_scheme_id'] = $marking_scheme_tenth;
        $_POST['mark_percentage'] = $cgpa_tenth;
        $_POST['completion_year'] = $yr_of_passing_tenth;
        $_POST['registration_no'] = $roll_no_tenth;
        $_POST['result_declared'] = $cur_qual_completed_tenth;
        $_POST['is_curr_qualify'] = $cur_qual_completed_tenth;
        $_POST['attemptsetstenth'] =$tenth_attempt;
        if($schooling_id_tenth) {
           // $applicant_schooling_det_columns .= ',updated_by';
        } else {
            //$applicant_schooling_det_columns .= ',created_by';
        }
        $schooling_res = array();
        if($schooling_id_tenth) {          ;
        $schooling_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_scl_det_id'=>$schooling_id_tenth,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_schooling_table, $applicant_schooling_det_columns, 2);
        } else {
            $schooling_res[] = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_schooling_table, $applicant_schooling_det_columns, 1, 'applicant_scl_det_id');
        }
        
        //for 12th
        $applicant_schooling_det_columns = 'applicant_personal_det_id,applicant_appln_id,result_declared,is_curr_qualify,institute_name,board_id,other_board_name,completion_year,registration_no,name_as_in_marksheet,schooling_id,other_stream_name,attemptstwelth,active';
        $cur_qual_completed_twelfth = $user_data['cur_qual_completed_twelfth'];
        $schooling_id_twelfth = $this->post('schooling_id_twelfth');
        $institute_name_twelfth = $user_data['institute_name_twelfth'];
        $board_twelfth = $user_data['board_twelfth'];
        $marking_scheme_twelfth = ($user_data['marking_scheme_twelfth']!='' && $user_data['marking_scheme_twelfth']!='null') ? $user_data['marking_scheme_twelfth']:NULL;
        $cgpa_twelfth = ($user_data['cgpa_twelfth']!='' && $user_data['cgpa_twelfth']!='null') ?$user_data['cgpa_twelfth'] :NULL;
        $yr_of_passing_twelfth = $user_data['yr_of_passing_twelfth'];
        $roll_no_twelfth = $user_data['roll_no_twelfth'];
        $scholling_id_twelfth = $user_data['scholling_id_twelfth'];
        $other_twelfth_board = $user_data['other_twelfth_board'];
        
        //if (is_numeric($marking_scheme_twelfth)) {
            $applicant_schooling_det_columns.=',marking_scheme_id';
        //}
        //if (is_numeric($cgpa_twelfth)) {
            $applicant_schooling_det_columns.=',mark_percentage';
        //}
        /* if (is_numeric($stream_name)) {
            $applicant_schooling_det_columns.=',stream_id';
        } */
        
        if(empty($schooling_id_twelfth)) {
            $_POST['schooling_id'] = SCHOOLING_ID_TWELFTH;;
        }
        $other_twelfth_board=isset($other_twelfth_board) ? $other_twelfth_board:'';
        if(isset($current_qualification_status) && $current_qualification_status!=""){
            $twelfth_declared= ($current_qualification_status==2) ? 't' :'f';
        }
        if($current_qualification_status==1){
            $cgpa_twelfth=NULL;
            $yr_of_passing_twelfth=NULL;
            $roll_no_twelfth=NULL;           
            $marking_scheme_twelfth=NULL;
        }
        $twelfth_qualify='t';
       
        $twelfth_attempt= $this->input->post('twelfth_attempt');       
        $twelfth_attempt=!empty($twelfth_attempt) ? $twelfth_attempt :NULL;
        
        $_POST['institute_name']= $institute_name_twelfth;
        $_POST['board_id'] = $board_twelfth;
        $_POST['curr_edu_quali_status'] = $this->input->post('current_qualification_status');
        $_POST['other_board_name'] = $other_twelfth_board;
        $_POST['marking_scheme_id'] = $marking_scheme_twelfth;
        $_POST['mark_percentage'] = $cgpa_twelfth;
        $_POST['completion_year'] = $yr_of_passing_twelfth;
        $_POST['registration_no'] = $roll_no_twelfth;
        $_POST['result_declared'] = $twelfth_declared;
        $_POST['is_curr_qualify'] = $twelfth_qualify;      
        $_POST['attemptstwelth'] = $twelfth_attempt;
        
        
        if($schooling_id_twelfth) {
           // $applicant_schooling_det_columns .= ',updated_by';
        } else {
           // $applicant_schooling_det_columns .= ',created_by';
        }
        //$schooling_res = array();
        if($schooling_id_twelfth) {          ;
        $schooling_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_scl_det_id'=>$schooling_id_twelfth,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_schooling_table, $applicant_schooling_det_columns, 2);
        } else {
            $schooling_res[] = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_schooling_table, $applicant_schooling_det_columns, 1, 'applicant_scl_det_id');
        }
        //end 12th
        
        if($graduation_res) {
            if($graduation_res['status'] == 'error') {
                $this->response ($graduation_res , API_Controller::HTTP_OK);
            } else {
                $applicant_personal_det_res['graduation_res'] = $graduation_res;
            }
        }
        //end new
        $this->_get_common_error_status($schooling_res);
        
        if($schooling_res) {
            $applicant_personal_det_res['schooling_res'] = $schooling_res;
        }
        //end new
        if($applicant_personal_det_res){
            $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id , FORM_WIZARD_ACADEMIC_ID);
        }
        $this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
    }
    public function declaration_post() {
        $app_form_id_hcma = APP_FORM_ID_BBA;
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
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_hcma);
        $applicant_appln_id = $applicant_appln_det_res['id'];
        $submitted_on=date("Y-m-d h:i:s");
        
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['active'] = TRUE;
        $_POST['appln_form_id'] = $app_form_id_hcma;
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
            $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_hcma , FORM_WIZARD_UPLOAD_DECLARATION_ID);
        }
        $this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
    }
    
    
    //BBA API end
}