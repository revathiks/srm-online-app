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
class Afih extends API_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    //hspg dip  API  start
    public function basic_detail_post() {
        $app_form_id_afih = APP_FORM_ID_AFIH;
        $applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
        $applicant_appln_det_table = APPLICANT_APPLN;
        $table_schema = SCHEMA_ADMISSION;
        $app_status=APPLICATION_IN_PROGRESS;
        $table_prefix = '';
        $applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
        $qualifyingexamfromindia = $this->post('qualifyingexamfromindia',true);
        $applicant_appln_id = $this->post('applicant_appln_id',true);
        // get applicant form pk id
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_afih);
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
        $_POST['appln_form_id'] = $app_form_id_afih;
        $_POST['qualifyingexamfromindia'] = $qualifyingexamfromindia;
        $_POST['is_agree'] = $is_agree;
        $_POST['application_status_id'] = APPLICATION_IN_PROGRESS;
        $_POST['applicant_appln_id'] = $applicant_appln_id;
        
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
        //  applicant_personal_det insert / update
        // $applicant_personal_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns);
        //  applicant_appln_det insert / update
        if($applicant_appln_id == false) {
            $applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns,false,'applicant_appln_id',false,$app_form_id_afih);
        } else {
            $applicant_appln_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns, 1, 'applicant_appln_id', $applicant_appln_id,$app_form_id_afih);
        }
        
        if($applicant_appln_det_res) {
            if($applicant_appln_det_res['status'] == 'error') {
                $this->response ($applicant_appln_det_res , API_Controller::HTTP_OK);
            } else {
                $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_afih , FORM_WIZARD_BASIC_ID);
                $applicant_personal_det_res['appln_status'] = $applicant_appln_det_res;
            }
        }
        $this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
    }
    
    public function personal_detail_post() {
        $applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
        $applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
        
        $applicant_appln_det_table = APPLICANT_APPLN;
        $app_form_id_afih=APP_FORM_ID_AFIH;
        $table_schema = SCHEMA_ADMISSION;
        $table_prefix = '';
        $applicant_appln_id = '';
        $applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
        
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
        
        // get applicant form pk id
        
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_afih);
        $applicant_appln_id = $applicant_appln_det_res['id'];
        
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
        $_POST['second_email_id'] = $this->post('second_email_id',true);
        $_POST['applicant_mob_country_code_id'] = $phone_no_code;
        
         
        $applicant_appln_det_columns = 'applicant_personal_det_id,appln_form_id,grad_id,active';
        $applicant_personal_det_columns = 'applicant_personal_det_id,title_id,first_name,middle_name,last_name,mobile_no,applicant_mob_country_code_id,email_id,dob,gender_id,second_email_id,blood_grp_id,nationality_id,social_status_id,diff_abled,religion_id,prefer_hostel,mothertongue_id,advertisement_source_id,active';
        $applicant_other_details_columns = 'applicant_personal_det_id,applicant_appln_id,medofinst,active';
      
        
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('applicant_personal_det_id', 'Personal det id','trim|required');
        $this->form_validation->set_rules('title_id', 'Title','trim|required');
        $this->form_validation->set_rules('first_name', 'First Name','trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name','trim|required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No','trim|required');
        $this->form_validation->set_rules('email_id', 'Email Id','trim|required|valid_email');
        $this->form_validation->set_rules('dob', 'Date Of Birth','trim|required');
        $this->form_validation->set_rules('gender_id', 'Gender','trim|required');
        $this->form_validation->set_rules('second_email_id', 'Email ID','trim|valid_email');
        $this->form_validation->set_rules('blood_grp_id', 'Blood Group','trim|required');
        $this->form_validation->set_rules('diff_abled', 'Are You Differently Abled','trim|required');
        $this->form_validation->set_rules('nationality_id', 'nationality_id','trim|required');
        if($nationality_id==COUNTRY_VALUE_DEFAULT){
            $this->form_validation->set_rules('social_status_id', 'Community','trim|required');
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
        
           // update program id at applicant tbl 
            $_POST = array();
            $_POST['grad_id']=UG_GRAD;
            $_POST['applicant_appln_id'] = $applicant_appln_id;        
            $program_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns, false, 'applicant_appln_id');
           //end program id
        
        if($other_res) {
            if($other_res['status'] == 'error') {
                $this->response ($other_res , API_Controller::HTTP_OK);
            }else {
                $applicant_personal_det_res['other_res'] = $other_res;
            }
        }
        if($program_res) {
            if($other_res['status'] == 'error') {
                $this->response ($other_res , API_Controller::HTTP_OK);
            }else {
                $applicant_personal_det_res['program_res'] = $program_res;
            }
        }
       
        if($applicant_personal_det_res){
            $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_afih , FORM_WIZARD_PERSONAL_ID);
        }
        $this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
    }
    public function parent_detail_post()
    {
        $app_form_id_afih = APP_FORM_ID_AFIH;
        $applicant_parent_det_table = APPLICANT_PARENT_DET_TABLE;
        $applicant_other_details_table = APPLICANT_OTHER_DETAILS_TABLE;
        $table_schema = SCHEMA_ADMISSION;
        $table_prefix = '';
        $applicant_personal_det_id = $this->post('applicant_id',true);
        $father_parent_det_id = $this->post('father_parent_det_id',true);
        $mother_parent_det_id = $this->post('mother_parent_det_id',true);
        $guardian_parent_det_id = $this->post('guardian_parent_det_id',true);
        $guardian_parent_det_id2 = $this->post('guardian2_parent_det_id',true);
        $user_data = $this->post();
        $add_guardian_details = $user_data['add_guardian_details'];
        //if($add_guardian_details!="on" && ($add_guardian_details==1 || $add_guardian_details=="true" || $add_guardian_details==true)){
        if($add_guardian_details==1 || $add_guardian_details==="true" || $add_guardian_details===true){
            $add_gardian = 't';
        }else{
            $add_gardian = 'f';
        }
        
        // get applicant form pk id
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_afih);
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
            $this->form_validation->set_rules('parent_guardian_name2', 'Secondary Gardian Name','trim|required');
            $this->form_validation->set_rules('guardian_mobile_no2', 'Secondary Gardian Mobile','trim|required');
            $this->form_validation->set_rules('guardian_email_id2', 'Secondary Gardian Email','trim|required');
            $this->form_validation->set_rules('guardian_occupation2', 'Secondary Gardian Occupation','trim|required');
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
        
        
        
        $applicant_parent_det_id[$parent_type_father_id] = $father_parent_det_id;
        $parent_type_id[$parent_type_father_id] = $parent_type_father_id;
        $parent_name[$parent_type_father_id] = $parent_father_name;
        $mobile_no[$parent_type_father_id] = $father_mobile_no;
        $alt_mobile_no[$parent_type_father_id] = $father_alt_mobile_no;
        $email_id[$parent_type_father_id] = $father_email_id;
        $occupation[$parent_type_father_id] = $father_occupation;
        $other_occupation[$parent_type_father_id] = $father_other_occupation;
        $mob_country_code_id[$parent_type_father_id] = $father_mob_country_code_id;
        $alt_mob_country_code_id[$parent_type_father_id] = $father_alt_mob_country_code_id;
        $title[$parent_type_father_id] = $father_title;
        
        $applicant_parent_det_id[$parent_type_mother_id] = $mother_parent_det_id;
        $parent_type_id[$parent_type_mother_id] = $parent_type_mother_id;
        $parent_name[$parent_type_mother_id] = $parent_mother_name;
        $mobile_no[$parent_type_mother_id] = $mother_mobile_no;
        $alt_mobile_no[$parent_type_mother_id] = $mother_alt_mobile_no;
        $email_id[$parent_type_mother_id] = $mother_email_id;
        $occupation[$parent_type_mother_id] = $mother_occupation;
        $other_occupation[$parent_type_mother_id] = $mother_other_occupation;
        $mob_country_code_id[$parent_type_mother_id] = $mother_mob_country_code_id;
        $alt_mob_country_code_id[$parent_type_mother_id] = $mother_alt_mob_country_code_id;
        $title[] = $mother_title;
        
        //primary GuardianDetail
        // Guardian Detail
            $realtionship=array();       
            $parent_type_guardian_id = $user_data['parent_type_guardian_id'];
            $parent_guardian_name = $user_data['parent_guardian_name'];
            $guardian_mobile_no = $user_data['guardian_mobile_no'];
            $guardian_alt_mobile_no = $user_data['guardian_alt_mobile_no'];
            $guardian_email_id = $user_data['guardian_email_id'];
            $guardian_occupation = $user_data['guardian_occupation'];
            $guardian_other_occupation = $user_data['guardian_other_occupation'];
            $guardian_mob_country_code_id = $user_data['guardian_mob_country_code_id'];
            $guardian_alt_mob_country_code_id = $user_data['guardian_alt_mob_country_code_id'];
            $guardian_relation1=$user_data['guardian_relation1'];
            
            $applicant_parent_det_id[$parent_type_guardian_id][1] = $guardian_parent_det_id;
            $parent_type_id[$parent_type_guardian_id][1] = $parent_type_guardian_id;
            $parent_name[$parent_type_guardian_id][1] = $parent_guardian_name;
            $mobile_no[$parent_type_guardian_id][1] = $guardian_mobile_no;
            $alt_mobile_no[$parent_type_guardian_id][1] = $guardian_alt_mobile_no;
            $email_id[$parent_type_guardian_id][1] = $guardian_email_id;
            $occupation[$parent_type_guardian_id][1] = $guardian_occupation;
            $other_occupation[$parent_type_guardian_id][1] = $guardian_other_occupation;
            $mob_country_code_id[$parent_type_guardian_id][1] = $guardian_mob_country_code_id;
            $title[$parent_type_guardian_id][1] = $guardian_title;
            $realtionship[$parent_type_guardian_id][1] = $guardian_relation1;
        //end primary guardian
        
        // Secondary Guardian Detail
        if($add_gardian=='t'){
            $parent_type_guardian_id = $user_data['parent_type_guardian2_id'];
            $parent_guardian_name = $user_data['parent_guardian_name2'];
            $guardian_mobile_no = $user_data['guardian_mobile_no2'];
            $guardian_email_id = $user_data['guardian_email_id2'];
            $guardian_occupation = $user_data['guardian_occupation2'];
            $guardian_other_occupation = $user_data['guardian_other_occupation2'];
            $guardian_mob_country_code_id = $user_data['guardian_mob_country_code_id2'];
            $guardian_relation2=$user_data['guardian_relation2'];
            
            $applicant_parent_det_id[$parent_type_guardian_id][2] = $guardian_parent_det_id2;
            $parent_type_id[$parent_type_guardian_id][2] = $parent_type_guardian_id;
            $parent_name[$parent_type_guardian_id][2] = $parent_guardian_name;
            $mobile_no[$parent_type_guardian_id][2] = $guardian_mobile_no;
            $alt_mobile_no[$parent_type_guardian_id][2] = $guardian_alt_mobile_no;
            $email_id[$parent_type_guardian_id][2] = $guardian_email_id;
            $occupation[$parent_type_guardian_id][2] = $guardian_occupation;
            $other_occupation[$parent_type_guardian_id][2] = $guardian_other_occupation;
            $mob_country_code_id[$parent_type_guardian_id][2] = $guardian_mob_country_code_id;
            $title[$parent_type_guardian_id][2] = $guardian_title;
            $realtionship[$parent_type_guardian_id][2] = $guardian_relation2;
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
        
        /* print_r($parent_type_id);
        print_r($applicant_parent_det_id);
        die; */
   
        if($parent_type_id) {
            foreach($parent_type_id as $k=>$v) {
                if($k==PARENT_TYPE_ID_GUARDIAN){
                   
                    if(is_array($v)){
                        foreach ($v as $k2 => $val){
                          $n_parent_type_id =  $val;
                          $n_applicant_parent_det_id = $applicant_parent_det_id[$k][$k2];
                          $n_parent_name = $parent_name[$k][$k2];
                          $n_mobile_no = $mobile_no[$k][$k2];
                          $n_alt_mobile_no = $alt_mobile_no[$k][$k2];
                          $n_email_id = $email_id[$k][$k2];
                          $n_occupation = $occupation[$k][$k2];
                          $n_mob_country_code_id = $mob_country_code_id[$k][$k2];
                          $n_alt_mob_country_code_id = $alt_mob_country_code_id[$k][$k2];
                          $n_title = $title[$k][$k2];
                          $n_relationship = $realtionship[$k][$k2];
                            
                            $_SERVER["REQUEST_METHOD"] = "POST";
                            $_POST = array();
                            $_POST['active'] = TRUE;
                           // $_POST['updated_by'] = $applicant_personal_det_id;
                            $applicant_parent_det_columns = 'applicant_personal_det_id,applicant_appln_id,parent_type_id,parent_name,mobile_no,email_id,occupation_id,active,mob_country_code_id,title_id,alt_mob_countrycode_id,alt_mobile_no,parent_type_level_id,relationship_id';
                            if($n_applicant_parent_det_id) {
                                $_POST['applicant_parent_det_id'] = $n_applicant_parent_det_id;
                                $applicant_parent_det_columns .= ',applicant_parent_det_id';
                            }
                            if($n_occupation==OTHER_OCCUPATION)
                            {
                                $applicant_parent_det_columns .= ',other_occupation_name';
                                $_POST['other_occupation_name'] = $other_occupation[$k][$k2];
                            }else{
                                $applicant_parent_det_columns .= ',other_occupation_name';
                                $_POST['other_occupation_name'] = NULL;
                                
                            }
                            
                            $n_occupation=($n_occupation!='' && $n_occupation!='null')?$n_occupation : NULL;
                            $n_mob_country_code_id=($n_mob_country_code_id!='' && $n_mob_country_code_id!='null')?$n_mob_country_code_id : NULL;
                            $n_alt_mob_country_code_id=($n_alt_mob_country_code_id!='' && $n_alt_mob_country_code_id!='null')?$n_alt_mob_country_code_id : NULL;
                            $n_relationship=($n_relationship!='' && $n_relationship!='null' )?$n_relationship:NULL;
                            
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
                            $_POST['parent_type_level_id'] = $k2;
                            $_POST['relationship_id'] = $n_relationship;
                            if($n_applicant_parent_det_id) {
                                $parent_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_parent_det_table, $applicant_parent_det_columns, 1, 'applicant_parent_det_id', $n_applicant_parent_det_id);
                                
                            } else {
                               
                                if($n_parent_name || $n_mobile_no || $n_email_id || $n_occupation || $n_mob_country_code_id || $n_title) {
                                    $parent_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_parent_det_table, $applicant_parent_det_columns, 1, 'applicant_parent_det_id');
                                    
                                }
                            }
                        }
                    }
                }
                
               else {
                $n_parent_type_id =  $v;               
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
                
            }//end else
                
            } //end foreach
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
            $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_afih , FORM_WIZARD_PARENT_ID);
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
        $applicant_appln_det_table = APPLICANT_APPLN;
        
        $program = $user_data['program'];
        $candidate_name = $user_data['candidate_name'];
        $applicant_id = $user_data['applicant_id'];
        $applicant_personal_det_id=$applicant_id;
        $cur_qual_completed = $this->post('education_qual_status',true);
        
        $app_form_id = $this->input->post('app_form_id');
        $tenth_highest_edu_val=$this->input->post('tenth_highest_edu_val');
        // get applicant form pk id
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id);
        $applicant_appln_id = $applicant_appln_det_res['id'];
        
        
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['active'] = TRUE;
       // $_POST['created_by'] = $applicant_personal_det_id;
       // $_POST['updated_by'] = $applicant_personal_det_id;
        $_POST['applicant_appln_id'] = $applicant_appln_id;
        $twelth_declared='t';
        //validation new
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('applicant_id', 'Personal det id','trim|required');
        $this->form_validation->set_rules('education_qual_status', 'Current Education Qualification Status','trim|required');
        $this->form_validation->set_rules('candidate_name', 'Candidate Name as in 10th Certificate','trim|required');
        $this->form_validation->set_rules('institute_name_tenth', 'Tenth Institute Name','trim|required');
        $this->form_validation->set_rules('board_tenth', 'Tenth Board','trim|required');
        $this->form_validation->set_rules('marking_scheme_tenth', 'Tenth Marking Scheme','trim|required');
        $this->form_validation->set_rules('cgpa_tenth', 'Tenth Obtai ned Percentage/CGPA','trim|required');
        $this->form_validation->set_rules('yr_of_passing_tenth', 'Tenth Year of Passing','trim|required');
        $this->form_validation->set_rules('roll_no_tenth', 'Tenth Roll number','trim|required');
        $this->form_validation->set_rules('is_work_experience', 'Work Experience Details','trim|required');
        
        $is_work_experience = $this->post('is_work_experience',true);
        $is_employed = $this->post('is_employed',true);
        
        if($is_work_experience == 't') {
            $this->form_validation->set_rules('org_name[0]', 'Organization name','trim|required');
            $this->form_validation->set_rules('designation[0]', 'Designation','trim|required');
            $this->form_validation->set_rules('job_nature[0]', 'job_nature Of Job','trim|required');
            $this->form_validation->set_rules('month_salary[0]', 'Total Salary Month','trim|required');
            $this->form_validation->set_rules('from_date[0]', 'From Date','trim|required');
            $this->form_validation->set_rules('to_date[0]', 'To Date','trim|required');
            $this->form_validation->set_rules('work_exp_in_month[0]', 'Work Experience','trim|required');
            $this->form_validation->set_rules('total_work_exp', 'Work Experience in months','trim|required');
            
        }
        /*  //12th
         $this->form_validation->set_rules('institute_name_twelfth', 'Twelfth Institute Name','trim|required');
         $this->form_validation->set_rules('board_twelfth', 'Twelfth Board','trim|required');
         $this->form_validation->set_rules('marking_scheme_twelfth', ' Twelfth Marking Scheme','trim|required');
         $this->form_validation->set_rules('cgpa_twelfth', 'Twelfth Obtained Percentage/CGPA','trim|required');
         $this->form_validation->set_rules('marking_scheme_twelfth', ' Twelfth Marking Scheme','trim|required');
         $this->form_validation->set_rules('cgpa_twelfth', 'Twelfth Obtained Percentage/CGPA','trim|required');
         $this->form_validation->set_rules('roll_no_twelfth', 'Twelfth Roll number','trim|required');
         $this->form_validation->set_rules('yr_of_passing_twelfth', ' Twelfth Year of Passing','trim|required');
         */
        //ug
        $this->form_validation->set_rules('institute_name_ug', 'Graduation Institute Name','trim|required');
        $this->form_validation->set_rules('university_ug', 'Graduation University','trim|required');
        $this->form_validation->set_rules('yr_passing_ug', ' Graduation Year of Passing','trim|required');
        $this->form_validation->set_rules('register_no_ug', 'Graduation Roll number','trim|required');
        $this->form_validation->set_rules('crri_comp_date', ' CRRI completion date','trim|required');
        $this->form_validation->set_rules('reg_date', 'Registration date','trim|required');
         
        
        //Run Validations
        if ($this->form_validation->run() == FALSE) {
            return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('status'=>'error','message'=>validation_errors())));
        }
        //end validation
        
        $function_name = $this->get_function_name ( __FUNCTION__ );
        //new
        $applicant_other_details_columns = 'applicant_personal_det_id,applicant_appln_id,cur_qual_completed,active,is_work_experience';
        
        $applicant_personal_det_columns = 'applicant_personal_det_id,active';
        
        $applicant_schooling_det_columns = 'applicant_personal_det_id,applicant_appln_id,institute_name,board_id,other_board_name,completion_year,registration_no,name_as_in_marksheet,schooling_id,marking_scheme_id,mark_percentage,result_declared,active';
        
        //  applicant_other_details insert / update
        if($is_work_experience == 't') {
            $applicant_other_details_columns.=",total_work_exp";
        }
        if($is_employed) {
            $applicant_other_details_columns.=",afihcurrentlyemployed";
            $_POST['afihcurrentlyemployed']=$is_employed;
        }
        
        $other_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_other_details_table, $applicant_other_details_columns, false, 'applicant_other_det_id');
        //applicant_personal_det insert / update
        
        //  applicant_personal_det insert / update
        $applicant_personal_det_res = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_personal_det_table, $applicant_personal_det_columns);
        
        
        //for scooling 10th
        $schooling_id_tenth = $this->post('schooling_id_tenth');
        $institute_name_tenth = $user_data['institute_name_tenth'];
        $board_tenth = $user_data['board_tenth'];
        $marking_scheme_tenth = ($user_data['marking_scheme_tenth']!='' && $user_data['marking_scheme_tenth']!='null') ? $user_data['marking_scheme_tenth'] :NULL;
        $cgpa_tenth = ($user_data['cgpa_tenth']!='' && $user_data['cgpa_tenth']!='null') ?$user_data['cgpa_tenth'] :NULL;
        $yr_of_passing_tenth = $user_data['yr_of_passing_tenth'];
        $roll_no_tenth = $user_data['roll_no_tenth'];
        $scholling_id_tenth = $user_data['scholling_id_tenth'];
        $other_tenth_board = $user_data['other_tenth_board'];
        $cur_qual_completed_tenth = $user_data['cur_qual_completed_tenth'];
       
        $other_tenth_board=isset($other_tenth_board) ? $other_tenth_board:'';
        if($board_tenth!=OTHER_BOARD){
            $other_tenth_board=Null;
        }  
        $_POST['schooling_id']=$tenth_highest_edu_val;
        $_POST['institute_name']= $institute_name_tenth;
        $_POST['board_id'] = $board_tenth;
        $_POST['curr_edu_quali_status'] = $this->input->post('current_qualification_status');
        $_POST['other_board_name'] = $other_tenth_board;
        $_POST['marking_scheme_id'] = $marking_scheme_tenth;
        $_POST['mark_percentage'] = $cgpa_tenth;
        $_POST['completion_year'] = $yr_of_passing_tenth;
        $_POST['registration_no'] = $roll_no_tenth;
        $_POST['result_declared'] = 't';
        $_POST['schooling_id'] = SCHOOLING_ID_TENTH;
    
         if($schooling_id_tenth) {
            //$applicant_schooling_det_columns .= ',updated_by';
        } else {
           // $applicant_schooling_det_columns .= ',created_by';
        }
        $schooling_res = array();
        if($schooling_id_tenth) {          ;
        $schooling_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_scl_det_id'=>$schooling_id_tenth,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_schooling_table, $applicant_schooling_det_columns, 2);
        } else {
            $schooling_res[] = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_schooling_table, $applicant_schooling_det_columns, 1, 'applicant_scl_det_id');
        }
        
         //for 12th            
        $applicant_schooling_det_columns = 'applicant_personal_det_id,applicant_appln_id,institute_name,board_id,other_board_name,completion_year,registration_no,name_as_in_marksheet,schooling_id,marking_scheme_id,mark_percentage,result_declared,active';
        $cur_qual_completed_twelfth = $user_data['cur_qual_completed_twelfth'];
        $schooling_id_twelfth = $this->post('schooling_id_twelfth');
        $institute_name_twelfth = $user_data['institute_name_twelfth'];
        $board_twelfth = ($user_data['board_twelfth']!='' && $user_data['board_twelfth']!='null') ?$user_data['board_twelfth'] : NULL;
        $marking_scheme_twelfth = ($user_data['marking_scheme_twelfth']!='' && $user_data['marking_scheme_twelfth']!='null') ? $user_data['marking_scheme_twelfth']:NULL;
        $cgpa_twelfth = ($user_data['cgpa_twelfth']!='' && $user_data['cgpa_twelfth']!='null') ?$user_data['cgpa_twelfth'] :NULL;
        $yr_of_passing_twelfth = $user_data['yr_of_passing_twelfth'];
        $roll_no_twelfth = $user_data['roll_no_twelfth'];
        $scholling_id_twelfth = $user_data['scholling_id_twelfth'];
        $other_twelfth_board = $user_data['other_twelfth_board'];
            
           
            $other_twelfth_board=isset($other_twelfth_board) ? $other_twelfth_board:'';
            if($board_twelfth!=OTHER_BOARD){
                $other_twelfth_board=Null;
            }
            $_POST['institute_name']= $institute_name_twelfth;
            $_POST['board_id'] = $board_twelfth;
            $_POST['curr_edu_quali_status'] = $this->input->post('current_qualification_status');
            $_POST['other_board_name'] = $other_twelfth_board;
            $_POST['marking_scheme_id'] = $marking_scheme_twelfth;
            $_POST['mark_percentage'] = $cgpa_twelfth;
            $_POST['completion_year'] = $yr_of_passing_twelfth;
            $_POST['registration_no'] = $roll_no_twelfth;
            $_POST['result_declared'] = 't';
            $_POST['schooling_id'] = SCHOOLING_ID_TWELFTH;
            if($schooling_id_twelfth) {
                //$applicant_schooling_det_columns .= ',updated_by';
            } else {
               // $applicant_schooling_det_columns .= ',created_by';
            }
            
            if($schooling_id_twelfth) { 
            $schooling_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_scl_det_id'=>$schooling_id_twelfth,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_schooling_table, $applicant_schooling_det_columns, 2);
            } else {
                if($institute_name_twelfth || $board_twelfth || $marking_scheme_twelfth || $cgpa_twelfth || $yr_of_passing_twelfth || $roll_no_twelfth)
                {
                 $schooling_res[] = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_schooling_table, $applicant_schooling_det_columns, 1, 'applicant_scl_det_id');
                }
            }     
          //end 12th
        
           //ug
            $applicant_graduation_columns = 'applicant_grad_det_id,applicant_personal_det_id,insti_name,completion_year,active,registration_no,applicant_appln_id,graduation_type_id,other_degree_name,other_university_name,crri_completion_date,registration_date,result_declared';
            $ug_completed = $user_data['ug_completed'];
            $graduation_id_ug = $this->post('graduation_id_ug');
            $institute_name_ug = $user_data['institute_name_ug'];
            $university_ug= ($user_data['university_ug']!='' && $user_data['university_ug']!='null') ?$user_data['university_ug'] :NULL;
            $university_other_ug= $user_data['university_other_ug'];
            $yr_passing_ug = $user_data['yr_passing_ug'];            
            $register_no_ug = $user_data['register_no_ug'];            
            $crri_comp_date = $user_data['crri_comp_date'];
            $reg_date = $user_data['reg_date'];
            
            $degree_ug = $user_data['degree_ug'];
            $university_other_ug=isset($university_other_ug) ? $university_other_ug :'';
            if($university_ug!=OTHER_UNIVERSITY){
                $university_other_ug=Null;
            }
            if (is_numeric($university_ug)) {
                $applicant_graduation_columns.=',univ_id';
            }
            
            if(isset($cur_qual_completed) && ($cur_qual_completed!='t')){
                $marking_scheme_ug=NULL;
                $obtained_percentage_cgpa_ug=NULL;
            }
            $_POST['insti_name']= $institute_name_ug;
            $_POST['univ_id'] = $university_ug;
            $_POST['other_university_name'] = $university_other_ug;
            $_POST['registration_date'] = $reg_date;
            $_POST['crri_completion_date'] = $crri_comp_date;
            $_POST['completion_year'] = $yr_passing_ug;
            $_POST['registration_no'] = $register_no_ug;
            $_POST['result_declared'] = $ug_completed;
            $_POST['graduation_type_id'] = GRADUATION_UG_ID;
            
           
            if($graduation_id_ug) {
                //$applicant_graduation_columns .= ',updated_by';
            } else {
               // $applicant_graduation_columns .= ',created_by';
            }
            $graduation_res = array();
            if($graduation_id_ug) {          ;
            $graduation_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_grad_det_id'=>$graduation_id_ug,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_graduation_table, $applicant_graduation_columns, 2);
            } else {
                $graduation_res[] = $this->_insert_update_applicant_tables($function_name, $applicant_personal_det_id, $table_schema, $applicant_graduation_table, $applicant_graduation_columns, 1, 'applicant_grad_det_id');
            }
            //end ug
        //update qualification status
        $applicant_appln_det_columns = 'applicant_personal_det_id,applicant_appln_id,after_tenth_quali_id,active';
        $after_tenth_quali_id=isset($cur_qual_completed)?$cur_qual_completed:NULL;
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['active'] = TRUE;
        $_POST['appln_form_id'] = $app_form_id;
        $_POST['after_tenth_quali_id'] = $after_tenth_quali_id;
        $_POST['applicant_appln_id'] = $applicant_appln_id;
        $other_det_res = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id), $table_schema, $applicant_appln_det_table, $applicant_appln_det_columns,1,'applicant_appln_id',$applicant_appln_id);
        
        if($graduation_res) {
            if($graduation_res['status'] == 'error') {
                $this->response ($graduation_res , API_Controller::HTTP_OK);
            } else {
                $applicant_personal_det_res['graduation_res'] = $graduation_res;
            }
        } 
        //end new
        
        // applicant_professional_exp_table
        
        $prof_exp_ids = $this->post('prof_exp_ids',true);
        $prof_exp_ids = json_decode($prof_exp_ids,true);
        $org_name = $this->post('org_name',true);
        $org_name = json_decode($org_name,true);
        $designation = $this->post('designation',true);
        $designation = json_decode($designation,true);
        $job_nature = $this->post('job_nature',true);
        $job_nature = json_decode($job_nature,true);
       
        $salary = $this->post('month_salary',true);
        $salary = json_decode($salary,true);
        $from_date = $this->post('from_date',true);
        $from_date = json_decode($from_date,true);
        $to_date = $this->post('to_date',true);
        $to_date = json_decode($to_date,true);
        $work_exp_in_months = $this->post('work_exp_in_month',true);
        $work_exp_in_months = json_decode($work_exp_in_months,true);
        
        $applicant_professional_exp_columns = 'applicant_prof_exp_id,applicant_personal_det_id,org_name,designation,job_nature,salary,from_date,to_date,work_exp_in_months,active,applicant_appln_id';
        $applicant_professional_exp_table = APPLICANT_PROFESSIONAL_EXP_TABLE;
        $professional_exp_res = array();
        if($is_work_experience == 't') {
            foreach($org_name as $k=>$v) {
                $n_org_name = $v;
                $n_prof_exp_id = $prof_exp_ids[$k];
                $n_designation = $designation[$k];
                $n_job_nature = $job_nature[$k];
                $n_salary = is_numeric($salary[$k]) ? $salary[$k] : NULL;
                $n_from_date = $from_date[$k];
                $n_to_date = $to_date[$k];
                $n_work_exp_in_months = $work_exp_in_months[$k];
                $_SERVER["REQUEST_METHOD"] = "POST";
                $_POST = array();
                $_POST['active'] = TRUE;
                $n_job_nature = ($n_job_nature!='' && $n_job_nature != 'null')?$n_job_nature:NULL;
                
                if($n_prof_exp_id) {
                    $_POST['applicant_prof_exp_id'] = $n_prof_exp_id;
                }
                
                $n_org_name=!empty($n_org_name)? $n_org_name: '';
                $n_designation=!empty($n_designation)? $n_designation: '';
                $n_job_nature=!empty($n_job_nature)? $n_job_nature: NULL;
                $n_salary=($n_salary!='')? $n_salary: NULL;
                $n_from_date=!empty($n_from_date)? $n_from_date: '';
                $n_to_date=!empty($n_org_name)? $n_to_date: '';
                
                $_POST['org_name'] = $n_org_name;
                $_POST['designation'] = $n_designation;
                $_POST['job_nature'] = $n_job_nature;
                $_POST['salary'] = $n_salary;
                $_POST['from_date'] = $n_from_date;
                $_POST['to_date'] = $n_to_date;
                $_POST['work_exp_in_months'] = ($n_work_exp_in_months!='')?$n_work_exp_in_months:NULL;
                $_POST['applicant_appln_id'] = $applicant_appln_id;
                $_POST['active'] = TRUE;
                
                if($n_prof_exp_id) {
                    $professional_exp_res[] = $this->_insert_update_applicant_tables($function_name, array('applicant_personal_det_id'=>$applicant_personal_det_id,'applicant_appln_id'=>$applicant_appln_id,'applicant_prof_exp_id'=>$n_prof_exp_id), $table_schema, $applicant_professional_exp_table, $applicant_professional_exp_columns, 2, 'applicant_prof_exp_id', $n_prof_exp_id);
                } else {
                    $chk_flag = false;
                    if(!$n_org_name && !$n_designation && !$n_job_nature && !$n_salary &&  !$n_from_date && !$n_to_date && !$n_work_exp_in_months) {
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
        $this->_get_common_error_status($other_det_res);
        $this->_get_common_error_status($schooling_res);
        //$this->_get_common_error_status($graduation_res);
        
        if($schooling_res) {
            $applicant_personal_det_res['schooling_res'] = $schooling_res;
        }
        if($graduation_res)
        {
            $applicant_personal_det_res['graduation_res'] = $graduation_res;
        }
        if($other_det_res)
        {
            $applicant_personal_det_res['others'] = $other_det_res;
        }
        //end new
        if($applicant_personal_det_res){
            $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id , FORM_WIZARD_ACADEMIC_ID);
        }
        $this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
    }
    
    public function declaration_post() {
        $app_form_id_afih = APP_FORM_ID_AFIH;
        $applicant_personal_det_table = APPLICANT_PERSONAL_DET_TABLE;
        $applicant_appln_det_table = APPLICANT_APPLN;
        $table_schema = SCHEMA_ADMISSION;
        $table_prefix = '';
        $applicant_appln_id = '';
        $applicant_personal_det_id = $this->post('applicant_personal_det_id',true);
        $applicant_name = $this->post('applicant_name',true);
        $parent_name = $this->post('parent_name',true);
        $declaration_date = $this->post('declaration_date',true);
        $applicant_appln_id = $this->post('applicant_appln_id',true);
        // get applicant form pk id
        $applicant_appln_det_res = $this->_get_appln_form_id($applicant_personal_det_id,$app_form_id_afih);
        $applicant_appln_id = $applicant_appln_det_res['id'];
        $submitted_on=date("Y-m-d h:i:s");
        
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST['active'] = TRUE;
        $_POST['appln_form_id'] = $app_form_id_afih;
        $_POST['applicant_name_declaration'] = $applicant_name;
        $_POST['applicant_parentname_declaration'] = $parent_name;
        $_POST['applicant_declaration_date'] = $declaration_date;
        $_POST['applicant_appln_id'] = $applicant_appln_id;
        $_POST['application_status_id'] = APPLICATION_IN_COMPLETED;
        $_POST['application_submission_date'] = $submitted_on;
        //$applicant_personal_det_columns = 'applicant_personal_det_id,applicant_appln_id,applicant_name,parent_name,declared_date,active';
        $applicant_appln_det_columns = 'applicant_personal_det_id,applicant_appln_id,applicant_name_declaration,applicant_parentname_declaration,applicant_declaration_date,active,application_status_id,application_submission_date';
        
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
            $wizard_update = $this->common_wizardupdate($applicant_personal_det_id , $app_form_id_afih , FORM_WIZARD_UPLOAD_DECLARATION_ID);
        }
        $this->response ($applicant_personal_det_res , API_Controller::HTTP_OK);
    }
    
    
    //hspg dip form API end
    
    
    
}