<?php
$app_form_id_march = APP_FORM_ID_MARCH;
$const_grad_id = MARCH_GRADUATION_ID;
$const_deg_id = MARCH_DEGREE_ID;
$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_tentative_topic = DOCUMENT_ID_TENTATIVE_TOPIC;
$document_id_tenth_marksheet = DOCUMENT_ID_TENTH_MARKSHEET;
$document_id_twelvfth_marksheet = DOCUMENT_ID_TWELVFTH_MARKSHEET;
$document_id_additional_qualification = DOCUMENT_ID_ADDITIONAL_QUALIFICATION;
$form_wizard_payment_id = FORM_WIZARD_PAYMENT_ID;

$document_id_graduation_marksheet = DOCUMENT_ID_GRADUATION_MARKSHEET;
$document_id_competitive_exam_marksheet=DOCUMENT_ID_COMPETITIVE_EXAM_MARKSHEET;
$is_work_experience = $applicant_other_details_list['is_work_experience'];
if($is_work_experience == 't') {
    $is_work_experience_select = 'yes';
} else {
    $is_work_experience_select = 'no';
}


$is_competitive_exam = $applicant_other_details_list['is_competitive_exam'];
if($is_competitive_exam == 't') {
    $is_competitive_exam_select = 'yes';
    $is_competitive_exam_select_name = 'Yes';
} else {
    $is_competitive_exam_select = 'no';
    $is_competitive_exam_select_name = 'No';
}


$add_gardian = $applicant_other_details_list['add_gardian'];

/*Graduation Details Start*/
if($applicant_graduations_list) {
         $applicant_grad_det_id = $applicant_graduations_list['applicant_grad_det_id'];
         $applicant_grad_det_other_degree_name = $applicant_graduations_list['other_deg_name'];
         $applicant_grad_det_univ_id = $applicant_graduations_list['univ_id'];
         $applicant_grad_det_univ_name = $applicant_graduations_list['univ_name'];
         $applicant_grad_det_mark_scheme_id = $applicant_graduations_list['mark_scheme_id'];
         $applicant_grad_det_mark_scheme = $applicant_graduations_list['mark_scheme_name'];
         $applicant_grad_det_mark_percent = $applicant_graduations_list['mark_percentage'];
         $applicant_grad_det_completion_year = $applicant_graduations_list['yr_of_pass'];
         $applicant_grad_det_insti_name = $applicant_graduations_list['insti_name'];
         $applicant_grad_det_reg_no = $applicant_graduations_list['reg_no']; 
}
/*Graduation Details End*/

/*Schooling Details Start*/
if($applicant_schooling_details_list)
{
  $applicant_scl_det_id=$applicant_schooling_details_list['applicant_scl_det_id'];
  $applicant_result_declared=$applicant_schooling_details_list['result_declared'];
  $applicant_schooling_id = $applicant_schooling_details_list['schooling_id'];
  $applicant_schooling_name = $applicant_schooling_details_list['schooling_name'];
  $applicant_institute_name = $applicant_schooling_details_list['inst_name'];
  $applicant_board_id = $applicant_schooling_details_list['board_id'];
  $applicant_board_name = $applicant_schooling_details_list['board_name'];
  $applicant_marking_scheme_id = $applicant_schooling_details_list['marking_scheme_id'];
  $applicant_marking_scheme_name = $applicant_schooling_details_list['marking_scheme_name'];
  $applicant_obtained_percentage_cgpa = $applicant_schooling_details_list['mark_percentage'];
  $applicant_year_of_passing = $applicant_schooling_details_list['completion_year'];
  $applicant_registration_no = $applicant_schooling_details_list['registration_no'];
  $applicant_tenth_name = $applicant_schooling_details_list['name_as_in_marksheet'];
  $applicant_mode_of_study_id = $applicant_schooling_details_list['mode_of_study_id'];
  $applicant_mode_of_study_name = $applicant_schooling_details_list['mode_of_study_name'];
  $applicant_address_of_school_college = $applicant_schooling_details_list['address'];
}
/*Schooling Details End*/

//Campus Prefer
if($applicant_campus_details_list) {
  foreach($applicant_campus_details_list as $k=>$v) {
      $applicant_campus_prefer_id[] = $v['applicant_campus_prefer_id'];
      $campus_prefer_id[] = $v['campus_id'];
      $campus_prefer_name[]=$v['campus_name'];
   }
}

//Course Prefer
if($applicant_course_details_list) {
  foreach($applicant_course_details_list as $k=>$v) {
      $applicant_course_prefer_id = $v['applicant_course_id'];
      //$course_prefer_id = $v['course_id'];
      $course_prefer_id = $v['branch_id'];
      $course_prefer_name=$v['course_name'];
   }
}

if($applicant_parent_details_list) {
   foreach($applicant_parent_details_list as $k=>$v) {
      $parent_type_id = $v['parent_type_id'];
      $app_parent_det_id[$parent_type_id] = $v['app_parent_det_id'];
      $applicant_parent_parent_type_name[$parent_type_id] = $v['parent_type_name'];
      $applicant_parent_parent_name[$parent_type_id] = $v['parent_name'];
      $applicant_parent_mobile_no[$parent_type_id] = $v['mobile_no'];
      $applicant_parent_email_id[$parent_type_id] = $v['email_id'];
      $applicant_parent_occupation_id[$parent_type_id] = $v['occupation_id'];
      $applicant_parent_occupation_name[$parent_type_id] = $v['occupation_name'];
      $applicant_parent_mob_country_code_id[$parent_type_id] = $v['mob_country_code_id'];
      $applicant_parent_country_mob_code[$parent_type_id] = $v['country_mob_code'];
      $applicant_parent_alt_mob_countrycode_id[$parent_type_id] = $v['alt_mob_countrycode_id'];
      $applicant_parent_alt_mob_country_code[$parent_type_id] = $v['alt_mob_country_code'];
      $applicant_parent_alt_mobile_no[$parent_type_id] = $v['alt_mobile_no'];
      $applicant_parent_title[$parent_type_id] = $v['title_id'];
      $applicant_parent_title_name[$parent_type_id] = $v['title_name'];
      
   }
}

$parent_type_id_father = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
$father_name = $applicant_parent_parent_name[$parent_type_id_father];
$mother_name = $applicant_parent_parent_name[$parent_type_id_mother];
$guardian_name = $applicant_parent_parent_name[$parent_type_id_guardian];


if($applicant_appln_details_list)
{
	foreach($applicant_appln_details_list as $k=>$v) {
      $appln_form_id = $v['appln_form_id'];
      if($app_form_id_march == $appln_form_id) {
        $applicant_appln_id = $v['applicant_appln_id'];
        $qualifyexamfromindia = $v['qualifyingexamfromindia'];
        $current_wizard=$v['wizard_id'];
        // $is_qualify = $v['is_qualify'];
      }
   }  
}

 if($qualifyexamfromindia == 't') {
    $studied_from_india_id = 'yes';
    $studied_from_india_name = 'Yes';
} elseif($qualifyexamfromindia == 'f') {
    $studied_from_india_id = 'no';
    $studied_from_india_name = 'No';
}

$docs = $upload_scripts = array();
$file_count = 0;
//print_r($upload_filelist);
if($upload_filelist) {
  foreach($upload_filelist as $doc){
      $document_id = $doc['document_id'];
      $id = $doc['id'];
      $file_name = $doc['name'];
      $file_path = $doc['path'];
      $file_name_user = remove_file_separator($file_name);
      //echo $document_id_photograph."photograph";
      //echo $document_id."document_d";
      $file_name_truncate = remove_file_separator($file_name, true);
      /*$file_doc_type = (($document_id_photograph == $document_id)?'photograph':($document_id_signature == $document_id)?'signature':(($document_id_tenth_marksheet == $document_id)?'tenth_marksheet':''));*/
      //$file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':''));
      /*$file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_tenth_marksheet == $document_id)?'tenth_marksheet':(($document_id_twelvfth_marksheet == $document_id)?'twelvfth_marksheet':''))));*/

      $file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_graduation_marksheet == $document_id)?'graduation_marksheet':(($document_id_twelvfth_marksheet == $document_id)?'twelvfth_marksheet':(($document_id_additional_qualification == $document_id)?'additional_qualification':'')))));

      //echo $file_doc_type;
      //echo $file_path;
      $parsley_required = (($document_id_photograph == $document_id)?'true':(($document_id_signature == $document_id)?'true':(($document_id_graduation_marksheet == $document_id)?'true':(($document_id_twelvfth_marksheet == $document_id)?'false':''))));

     if($document_id == $document_id_tentative_topic) {
        $docs[$document_id][]=array(
          'id'=>$id,
          'file_name'=>$file_name,
          'file_name_user'=>$file_name_user,
          'file_name_truncate'=>$file_name_truncate,
          'file_path'=>$file_path,
        );
        $file_count++;
     } else {
        $docs[$document_id]=array(
          'id'=>$id,
          'file_name'=>$file_name,
          'file_name_user'=>$file_name_user,
          'file_name_truncate'=>$file_name_truncate,
          'file_path'=>$file_path,
        );
        $upload_scripts[] = 'upload_file_set_download_delete_options("'.$file_doc_type.'", "'.$file_name.'", "'.$file_path.'", "'.$document_id.'", "'.$id.'", "'.$parsley_required.'")';
     }
  }
}
$docs['file_count'] = $file_count;

$payment_mode_id = $payment_details_list['payment_mode_id'];
$startIndex = $this->input->get('startIndex',true);
//restrict previous section
$is_allow_previous=$this->config->item('is_allow_previous');
/*Form Index Restriction Start*/
$start_wizard = 0;
$start_wizard_next = -1;
$next_step_allowed = '';
$start_wizard_next_allow='';
$appln_form_w_wizard_id = $applicant_appln_details_list[0]['form_w_wizard_id'];
if($appln_form_w_wizard_id !='')
{
    $wizard_dt_complete_percentage = $appln_wizard_dt[0]['completion_percent'];
    foreach ($wizard_dt as $key => $value) {
        $w_wizard_id = $value['form_w_wizard_id'];
        $completion_percent = $value['completion_percent'];
        if(!empty($appln_form_w_wizard_id) && $completion_percent != 100 && $w_wizard_id == $appln_form_w_wizard_id && $startIndex == '')
        {
            $next_step_allowed = $start_wizard +1;
        }
        else if(!empty($appln_form_w_wizard_id) && $startIndex != '' && $completion_percent <= $wizard_dt_complete_percentage)
        {
            $start_wizard_next++;
        }
        $start_wizard++;
    }
}


if($mode_edit == '') //Admin Means No restriction start
{
if($start_wizard_next >=0){ //Once Next allow greater than Zero we add to allow next steps
    $start_wizard_next_allow = $start_wizard_next + 1;
}
if($next_step_allowed !="" && $current_wizard<FORM_WIZARD_PAYMENT_ID){ //Without StartIndex
    $startIndex = $next_step_allowed;
}
else if($startIndex <= $start_wizard_next && $start_wizard_next >=0 && $current_wizard<FORM_WIZARD_PAYMENT_ID){ // StartIndex Lesser than Submit Form allow
    $startIndex = $startIndex;
}
else if($startIndex == $start_wizard_next_allow && $start_wizard_next >=0 && $current_wizard<FORM_WIZARD_PAYMENT_ID){ // StartIndex next step once complete Current Tab
    $startIndex = $startIndex;
}
else if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) && ($startIndex== 6 || $startIndex == 7)) {
    $startIndex=$startIndex; //declaration
}
else if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0)) {
    $startIndex=6; //declaration
}
else if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==1) && $startIndex <= $start_wizard_next_allow) {
    $startIndex = $startIndex;
}
else{
    $startIndex = 0;
}
} //Admin Means No restriction end
/*Form Index Restriction End*/
?>

<script>
	var app_form_id = '<?php echo $app_form_id_march; ?>';
	var const_grad_id = '<?php echo $const_grad_id; ?>';
    var const_deg_id = '<?php echo $const_deg_id; ?>';	
	var part_time_external = '<?php echo PART_TIME_EXTERNAL; ?>';
	var country_value_default = '<?php echo COUNTRY_VALUE_DEFAULT; ?>';
	var logged_applicant_id = '<?php echo $logged_applicant_id; ?>';
  var otheroccupation='<?php echo OTHER_OCCUPATION;?>';
    var logged_applicant_login_id = '<?php echo $logged_applicant_login_id; ?>';
    var comp_exam_ugc_net = '<?php echo COMP_EXAM_UGC_NET; ?>';
    var comp_exam_ugc_csir_net = '<?php echo COMP_EXAM_UGC_CSIR_NET; ?>';
    var comp_exam_slet = '<?php echo COMP_EXAM_SLET; ?>';
    var comp_exam_gate = '<?php echo COMP_EXAM_GATE; ?>';
    var comp_exam_teacher_fellowship_holder = '<?php echo COMP_EXAM_TEACHER_FELLOWSHIP_HOLDER; ?>';
    var document_id_tentative_topic = '<?php echo DOCUMENT_ID_TENTATIVE_TOPIC; ?>';
    var db_title_id = '<?php echo $applicant_basic_details_list['tittle_id'];?>';
    var db_title_name = '<?php echo $applicant_basic_details_list['tittle_name'];?>';
    var db_gender_id = '<?php echo $applicant_basic_details_list['gender_id'];?>';
    var db_gender_name = '<?php echo $applicant_basic_details_list['gender'];?>';
    var db_religion_id = '<?php echo $applicant_basic_details_list['religion_id'];?>';
    var db_religion_name = '<?php echo $applicant_basic_details_list['religion_name'];?>';
    var db_blood_grp_id = '<?php echo $applicant_basic_details_list['blood_id'];?>';
    var db_blood_grp_name = '<?php echo $applicant_basic_details_list['blood_group'];?>';
    var db_mothertongue_id = '<?php echo $applicant_basic_details_list['mothertongue_id'];?>';
    var db_mothertongue_name = '<?php echo $applicant_basic_details_list['mothertongue_name'];?>';   
    var db_med_of_inst_id= '<?php echo $applicant_other_details_list['medofinst'];?>';
    var db_med_of_inst_name= '<?php echo $applicant_other_details_list['medium_of_study_name'];?>';
    var db_prefer_hostel_id= '<?php echo $applicant_basic_details_list['prefer_hostel'];?>';
    var db_dif_abled_id= '<?php echo $applicant_basic_details_list['dif_abled'];?>';
    var db_adv_source_id ='<?php echo $applicant_basic_details_list['advertisement_source_id'];?>';
    var db_adv_source_name ='<?php echo $applicant_basic_details_list['source_name'];?>';
    var db_nationality_id ='<?php echo $applicant_basic_details_list['nation_id'];?>';    
    var db_nationality_name ='<?php echo $applicant_basic_details_list['nationality'];?>';
    var db_country_id='<?php echo $applicant_address_details_list[0]['country_id'];?>';
    var db_country_name='<?php echo $applicant_address_details_list[0]['country_name'];?>';
    var db_state_id='<?php echo $applicant_address_details_list[0]['state_id'];?>';
    var db_state_name='<?php echo $applicant_address_details_list[0]['state_name'];?>';
    var db_district_id='<?php echo $applicant_address_details_list[0]['district_id'];?>';
    var db_district_name='<?php echo $applicant_address_details_list[0]['district_name'];?>';
    var db_city_id ='<?php echo $applicant_address_details_list[0]['city_id'];?>';
    var db_city_name='<?php echo $applicant_address_details_list[0]['city_name'];?>';
    //var db_mode_study_id='<?php echo $applicant_address_details_list['city_name'];?>';
    //var db_mode_study_name='<?php echo $applicant_address_details_list['city_name'];?>';
    var db_social_status_id='<?php echo $applicant_basic_details_list['social_status_id'];?>';
    var db_social_status_name='<?php echo $applicant_basic_details_list['social_status'];?>';
    var payment_wizard_id = '<?php echo $form_wizard_payment_id; ?>';
	
   /*CRM ADMIN Edit form start*/
    var crm_applicant_personal_det_id = '<?php echo $crm_applicant_personal_det_id ; ?>';
    var crm_applicant_login_id = '<?php echo $crm_applicant_login_id ; ?>';
    var mode_edit_val = '<?php echo ADMIN_MODE_EDIT ; ?>';
    var mode_edit_url = '<?php echo $mode_edit; ?>';
    <?php if($mode_edit) { ?>
      var url_edit = '&mode=edit'+'&applicant_personal_det_id='+crm_applicant_personal_det_id+'&applicant_login_id='+crm_applicant_login_id;
      var url = "<?php echo base_url(); ?>march/"+mode_edit_val+"/"+crm_applicant_login_id+"/"+crm_applicant_personal_det_id;
      var payment_url = '<?php echo base_url(); ?>user/payment_details?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;
      var save_exit_redirect_url = '<?php echo base_url(); ?>crm-admin/dashboard';
      //var upload_url = '<?php echo base_url(); ?>upload-file?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;     
    <?php } else { ?>
      var url_edit =  '';
      var url = "<?php echo base_url(); ?>march";
      var payment_url = '<?php echo base_url(); ?>user/payment_details';
       var save_exit_redirect_url = '<?php echo base_url(); ?>';
       //var upload_url = "<?php echo base_url(); ?>upload-file";
    <?php } ?>
    /*CRM ADMIN Edit form end*/
	
	var get_percentage_url = '<?php echo base_url(); ?>user/get_percentage_w_tab?app_form_id='+app_form_id+url_edit;
	var redirect_payment_thank_you = '<?php echo base_url(); ?>user/payment_thank_you?app_form_id='+app_form_id+'&wizard_id='+payment_wizard_id+'&url='+encodeURIComponent(url);
	var redirect_thank = '<?php echo base_url()."thank_you"; ?>?app_form_id='+app_form_id;
	var curIndex='<?php echo $startIndex;?>';
  var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
    csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
	
        $(document).ready(function () {
            'use strict';
		
		// This Function for Payment option selection
		$("#online").click(function(){
		$("#payment_details").hide();
		});
		$("#dd").click(function(){
		 $("#payment_details").show();
		}); 
		// End of  Function for Payment option selection






    <?php if($payment_mode_id == PAYMENT_MODE_DEMAND_DRAFT_ID) {
        ?>
        $("#dd").trigger('click');
        setTimeout(function() {
        	 $("#dd").trigger('click');
        	<?php if(!empty($payment_details_list)){ ?> 
			 $("#dd").attr("disabled","disabled");
			 $("#online").attr("disabled","disabled");
			 $("#BankName").attr("disabled","disabled");
			 $("#DDNumber").attr("disabled","disabled");					
			 $("#DDDate").attr("disabled","disabled");
			 $("#BranchName").attr("disabled","disabled");
			<?php } ?>
        },0);
        <?php
      }
      if($payment_mode_id == PAYMENT_MODE_ONLINE_ID) {
          ?>
        		setTimeout(function() {
        			$("#online").trigger('click');
        			
        			<?php if(!empty($payment_details_list)){ ?> 
        			 $("#dd").attr("disabled","disabled");
					 $("#online").attr("disabled","disabled");
        			<?php } ?>
        		},1);
        		<?php
        	}
    ?>

    // Dynamically Get Total Wizard Steps
    var total_wizard_Step = $('.wizard_head_tag').length;
    $("#show_currentindex").html('<?php echo ($startIndex)?($startIndex+1):1; ?> of '+total_wizard_Step);
    setTimeout(function() {
		enable_saveExit_btn('<?php echo $startIndex;?>',5);
	 },1);
    <?php
       // on load preview button
      if($startIndex) {
      ?>
      setTimeout(function() { 
        if(parseInt(total_wizard_Step-1) == <?php echo $startIndex; ?>) {
        	$("#save_exit").remove();
        	//enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>march_form_preview');
          if(mode_edit_url != '')
          {
            enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>march_form_preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
          }else{
            enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>march_form_preview');
          }
        }
		if(curIndex==4){
			$(".actions ul > li:nth-child(2) a").text('<?php echo MAKE_PAYMENT; ?>');
		}else{
			$(".actions ul > li:nth-child(2) a").text('<?php echo NEXT_STEP; ?>');
		} 		
      },1);
      <?php
      }
      ?>


    // Percentage Show Tab Wise
      tab_wise_percentage_show(get_percentage_url,'percentage_bar');
		
		var is_employed_category_hidden = $('#category_check').val();
		var settings = {
        /* Appearance */
        headerTag: "h3",
        bodyTag: "fieldset",
        contentContainerTag: "div",
        actionContainerTag: "div",
        stepsContainerTag: "div",
        cssClass: "wizard",
        // stepsOrientation: $.fn.steps.stepsOrientation.horizontal,
        /* Templates */
        titleTemplate: '<span class="number"></span> <br> <span class="title-head">#title#</span>   ',
        loadingTemplate: '<span class="spinner"></span> #text#',

        /* Behaviour */
        autoFocus: true,
        enableAllSteps: false,
        enableKeyNavigation: true,
        enablePagination: true,
        suppressPaginationOnFocus: true,
        enableContentCache: true,
        enableCancelButton: false,
        enableFinishButton: true,
        preloadContent: true,
        showFinishButtonAlways: false,
        forceMoveForward: false,
        saveState: true,
        //startIndex: 0,
        startIndex: <?php echo ($startIndex)?$startIndex:0; ?>,

        /* Transition Effects */
        transitionEffect: 'slide', //$.fn.steps.transitionEffect.none,
        transitionEffectSpeed: 200,

        /* Events */
        onStepChanging: function (event, currentIndex, newIndex) { 
            // if(currentIndex > newIndex)
            // {
				// return true;
            // }
			
			// return $(this).parsley().validate();
			if(currentIndex < newIndex) {
				// Step 1 form validation
				if(currentIndex === 0) {
                  // return true;
				  var graduation_india = $('#graduation_india').parsley();
				  var qualifyingexamfromindia = $('#qualifyingexamfromindia').parsley();
          var resident_info = $('#resident_info').parsley();
          var graduation_india_val = $('#graduation_india').val();
				  // var is_employed = $('#is_employed').parsley();
				  // var working_place = $('#working_place').parsley();				 
				  if(graduation_india.isValid() && qualifyingexamfromindia.isValid() && resident_info.isValid() && (graduation_india_val=="yes" || graduation_india_val=="t")) {
					var qualifyingexamfromindia_val = $('#qualifyingexamfromindia').val();
          var appln_status = $('#appln_status').val();
					var user_data = 'qualifyingexamfromindia='+qualifyingexamfromindia_val+'&'+csrfName+'='+csrfHash+'&appln_status='+appln_status;
          var isexit = ($(this).attr('isexit'));
          var moveNxt=0;
					$.ajax({
						type: 'POST',
						url: url,
						data: user_data+'&currentIndex='+currentIndex,
						dataType: 'json',
						cache: false,
            beforeSend: function() { $('.loader').show(); },
						success: function(returndata) {
              if(returndata) {
                if(returndata.status == 'true') {
                  if(isexit==1){
                     window.location.href = save_exit_redirect_url;
                     return false;
                            }
                  else
                  {
                    var startIndex = currentIndex+1
                    window.location.href = url+'?startIndex='+startIndex; 
                    $("#formerr").hide();
                    moveNxt=1;
                  }
                  
                  //}, 100);                    
                }                 
              }               
            },
						error: function(returndata) {
						  $('.loader').hide();
              moveNxt=0;
              console.log(returndata);
              $("#formerr").show();                 
              return false;
						},
					});						
					if(moveNxt){
              return true;
            }
				  } else {
					graduation_india.validate();
					qualifyingexamfromindia.validate();
          resident_info.validate();
          $(this).attr('isexit','');
					return false;
				  }
				}
				
				
				
				// Step 2 form validation
				if(currentIndex === 1) {
                  //return true;
          var campus_pref_1= $('#campus_pref_1').parsley();                  
				  var title_id = $('#pd_title').parsley();
				  var first_name = $('#pd_firstname').parsley();
				  var last_name = $('#pd_lastname').parsley();	
          var middle_name = $('#pd_middlename').parsley();	  
				  var mtech_mobile_no = $('#pd_mobile_no').parsley();
				  var dob =$('#pd_dob').parsley();
				  var gender_id=$('#pd_gender').parsley();
				  var blood_group_id = $('#pd_blood_group').parsley();
				  var email_id=$('#pd_email').parsley();
				  var nationality_id=$('#pd_nationality').parsley();
				  var social_status =$("#pd_social_status").parsley();
          var pd_diffrently_abled=$("#pd_diffrently_abled").parsley();
          var pd_alt_email = $("#pd_alt_email").parsley();
				  
				  if(title_id.isValid() && first_name.isValid() && last_name.isValid() && mtech_mobile_no.isValid() && dob.isValid() && gender_id.isValid() && blood_group_id.isValid() && email_id.isValid() && campus_pref_1.isValid() && nationality_id.isValid() && middle_name.isValid() && pd_alt_email.isValid() && pd_diffrently_abled.isValid() && social_status.isValid()) {
				  	var campus_pref_1=$('#campus_pref_1').val();
				  	var campus_choice_no_1 = $('#campus_choice_no_1').val();
				  	var campus_prefer_id_1 = $('#campus_prefer_id_1').val();
					var title_id_val = $('#pd_title').val();
					var first_name_val = $('#pd_firstname').val();
					var middle_name_val=$('#pd_middlename').val();
					var last_name_val = $('#pd_lastname').val();
					var mtech_mobile_no_val = $('#pd_mobile_no').val();
					var email_id_val = $('#pd_email').val();
					var dob_val = $('#pd_dob').val();
					var gender_id_val = $('#pd_gender').val();
					var second_email_id_val = $('#pd_alt_email').val();
					var blood_grp_id_val =$('#pd_blood_group').val();
					var religion_id_val =$('#pd_religion').val();
					var mothertongue_id_val =$('#pd_mother_tongue').val();
					var medofinst_val =$('#pd_medium_of_instruction').val();
					var prefer_hostel_val = $('#pd_hostel_accommodation').val();
					var diff_abled_val= $('#pd_diffrently_abled').val();
					var advertisement_source_id_val = $('#pd_advertisement_source').val();
					var nationality_id_val = $('#pd_nationality').val();
					var phone_no_code_val=$('#phone_no_code').val();
					var pd_social_status_val = $('#pd_social_status').val();
          var isexit = ($(this).attr('isexit'));
					
					var user_data = 'campus_pref_1='+campus_pref_1+'&title_id='+title_id_val+'&first_name='+first_name_val+'&last_name='+last_name_val+'&middle_name='+middle_name_val+'&email_id='+email_id_val+'&pd_dob='+dob_val+'&gender_id='+gender_id_val+'&second_email_id='+second_email_id_val+'&blood_grp_id='+blood_grp_id_val+'&religion_id='+religion_id_val+'&mothertongue_id='+mothertongue_id_val+'&medofinst='+medofinst_val+'&prefer_hostel='+prefer_hostel_val+'&diff_abled='+diff_abled_val+'&advertisement_source_id='+advertisement_source_id_val+'&nationality_id='+nationality_id_val+'&mobile_no='+mtech_mobile_no_val+'&phone_no_code='+phone_no_code_val+'&campus_choice_no_1='+campus_choice_no_1+'&campus_prefer_id_1='+campus_prefer_id_1+'&social_status_id='+pd_social_status_val+'&'+csrfName+'='+csrfHash;
          var moveNxt=0;
					$.ajax({
						type: 'POST',
						url: url,
						data: user_data+'&currentIndex='+currentIndex,
						dataType: 'json',
						cache: false,
            beforeSend: function() { $('.loader').show(); },
						success: function(returndata) {
		              if(returndata) {
                    console.log(returndata);
		                if(returndata.status == 'true' || returndata.status == true) { 
                      if(isexit==1){
                        window.location.href = save_exit_redirect_url;
                        return false; } else {
                          var startIndex = currentIndex+1
                      window.location.href =  url+'?startIndex='+startIndex; 
                      $("#formerr").hide();
                      moveNxt=1;  
                        }
		                }                 
		              }               
            },
						error: function(returndata) {
						      $('.loader').hide();
                  moveNxt=0;
                  console.log(returndata);
                  $("#formerr").show();                 
                  return false;
						},
					});						  
					if(moveNxt){
              return true;
            }
				  } else {
				  	campus_pref_1.validate();
					title_id.validate();
					first_name.validate();
					last_name.validate();
          			middle_name.validate();
					mtech_mobile_no.validate();
					dob.validate();
					gender_id.validate();
					blood_group_id.validate();
					email_id.validate();
					nationality_id.validate();
					social_status.validate();
          pd_diffrently_abled.validate();
          pd_alt_email.validate();
					return false;
				  }
				}

				// Step 3 form validation
				if(currentIndex === 2) {
					  //return true;

					  	var pd_father_title = $('#pd_father_title').parsley();
						var pd_father_name = $('#pd_father_name').parsley();
						var pd_father_email = $('#pd_father_email').parsley();
						var pd_father_phone = $('#pd_father_phone').parsley();						
						var pd_mother_title = $('#pd_mother_title').parsley();
						var pd_mother_name = $('#pd_mother_name').parsley();
						var pd_mother_phone = $('#pd_mother_phone').parsley();						
						var pd_mother_email = $('#pd_mother_email').parsley();
						var pd_guardian_name = $('#pd_guardian_name').parsley();
						var pd_guardian_phone = $('#pd_guardian_phone').parsley();
						var pd_guardian_email = $('#pd_guardian_email').parsley();
						var pd_guardian_occupation = $('#pd_guardian_occupation').parsley();
						var pd_father_alt_phone = $('#pd_father_alt_phone').parsley();
						var pd_mother_alt_phone = $('#pd_mother_alt_phone').parsley();
            var pd_father_other_occupation = $('#pd_father_other_occupation').parsley();
            var pd_mother_other_occupation = $('#pd_mother_other_occupation').parsley();
            var guardian_other_occupation = $('#guardian_other_occupation').parsley();
            var pd_mother_occupation = $('#pd_mother_occupation').parsley();
            var pd_father_occupation = $('#pd_father_occupation').parsley();

            check_visible_input_validation('guardian_other_occupation_div','guardian_other_occupation','<?php echo REQD_GUARDIAN_OTHER_OCCUPATION_MSG; ?>',true,'<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');

            check_visible_input_validation('mother_other_occupation_div','pd_mother_other_occupation','<?php echo REQD_MOTHER_OTHER_OCCUPATION_MSG; ?>',true,'<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');

            check_visible_input_validation('father_other_occupation_div','pd_father_other_occupation','<?php echo REQD_FATHER_OTHER_OCCUPATION_MSG; ?>',true,'<?php echo REQD_ALPHA_NAME_ONLY_MSG; ?>');

					  
					  	if(pd_father_title.isValid() && pd_father_name.isValid() && pd_mother_title.isValid() && pd_mother_name.isValid() && pd_father_email.isValid() && pd_mother_email.isValid() && pd_guardian_name.isValid() && pd_guardian_phone.isValid() && pd_father_phone.isValid() && pd_mother_phone.isValid() && pd_guardian_email.isValid() && pd_guardian_occupation.isValid() && pd_father_alt_phone.isValid() && pd_mother_alt_phone.isValid() && pd_father_other_occupation.isValid() && pd_mother_other_occupation.isValid() && guardian_other_occupation.isValid() && pd_mother_occupation.isValid() && pd_father_occupation.isValid()) {

					  		var pd_father_title = $('#pd_father_title').val();
							var pd_father_name = $('#pd_father_name').val();
							var pd_father_phone_no_code = $('#pd_father_phone_no_code').val();
							var pd_father_phone = $('#pd_father_phone').val();							
							var pd_father_email = $('#pd_father_email').val();
							var pd_father_occupation = $('#pd_father_occupation').val();
							var pd_mother_title = $('#pd_mother_title').val();
							var pd_mother_name = $('#pd_mother_name').val();
							var pd_mother_phone_no_code = $('#pd_mother_phone_no_code').val();
							var pd_mother_phone = $('#pd_mother_phone').val();
							var pd_mother_email = $('#pd_mother_email').val();
							var pd_mother_occupation = $('#pd_mother_occupation').val();
							var add_guardian_checkbox = $('#add_guardian_checkbox').val();
							var pd_guardian_name = $('#pd_guardian_name').val();
							var pd_guardian_phone_no_code = $('#pd_guardian_phone_no_code').val();
							var pd_guardian_phone = $('#pd_guardian_phone').val();
							var pd_guardian_occupation = $('#pd_guardian_occupation').val();
					  		var pd_father_id = $('#pd_father_id').val();
					  		var pd_mother_id = $('#pd_mother_id').val();
					  		var pd_guardian_id = $('#pd_guardian_id').val();
	              var pd_guardian_email_val = $('#pd_guardian_email').val();
	             	var father_other_occupation_val='';
	              var mother_other_occupation_val='';
	              var guardian_other_occupation_val='';
	              var father_alt_mobile_no = $('#pd_father_alt_phone').val();
	              var father_alt_phone_no_code = $('#pd_father_alt_phone_no_code').val();
	              var father_alt_mobile_no = $('#pd_father_alt_phone').val();
	              var mother_alt_phone_no_code = $('#pd_mother_alt_phone_no_code').val();
	              var mother_alt_phone = $('#pd_mother_alt_phone').val();
	              father_other_occupation_val=$('#pd_father_other_occupation').val();
	              mother_other_occupation_val=$('#pd_mother_other_occupation').val();
	              guardian_other_occupation_val=$('#guardian_other_occupation').val();
                var isexit = ($(this).attr('isexit'));

              // Guardian Mobile / Email ID Unique Validation
	            if(pd_guardian_phone!=''){
	              if(pd_mother_phone==pd_guardian_phone || pd_father_phone==pd_guardian_phone){
	                $('#pd_guardian_phone').addClass('parsley-error');
	                $('#custom-pd_guardian_phone-parsley-error').show();
	                $('#custom-pd_guardian_phone-parsley-error').css('color','#ec4561');
	                $('#custom-pd_guardian_phone-parsley-error').html('<?php echo PHONE_MATCH_GUARDIAN; ?>');
	                setTimeout(function(){
	                  $('#pd_guardian_phone').toggleClass('parsley-error');
	                  $('#custom-pd_guardian_phone-parsley-error').hide();
	                }, 5000);
	                return false;
	              } 
	          } 

          if(pd_guardian_email_val!=''){
            if(pd_mother_email==pd_guardian_email_val || pd_father_email==pd_guardian_email_val){
              $('#pd_guardian_email').addClass('parsley-error');
              $('#custom-pd_guardian_email-parsley-error').show();
              $('#custom-pd_guardian_email-parsley-error').css('color','#ec4561');
              $('#custom-pd_guardian_email-parsley-error').html('<?php echo EMAIL_MATCH_GUARDIAN; ?>');               
              return false;
            } 
          }

				var userData = 'pd_father_title='+pd_father_title+'&pd_father_name='+pd_father_name+'&pd_father_phone_no_code='+pd_father_phone_no_code+'&pd_father_phone='+pd_father_phone+'&pd_father_email='+pd_father_email+'&pd_father_occupation='+pd_father_occupation+'&pd_mother_title='+pd_mother_title+'&pd_mother_name='+pd_mother_name+'&pd_mother_phone_no_code='+pd_mother_phone_no_code+'&pd_mother_email='+pd_mother_email+'&pd_mother_occupation='+pd_mother_occupation+'&add_guardian_checkbox='+add_guardian_checkbox+'&pd_guardian_name='+pd_guardian_name+'&pd_guardian_phone_no_code='+pd_guardian_phone_no_code+'&pd_guardian_phone='+pd_guardian_phone+'&pd_guardian_occupation='+pd_guardian_occupation+'&pd_mother_phone='+pd_mother_phone+'&pd_father_id='+pd_father_id+'&pd_mother_id='+pd_mother_id+'&pd_guardian_id='+pd_guardian_id+'&father_other_occupation='+father_other_occupation_val+'&mother_other_occupation='+mother_other_occupation_val+'&guardian_other_occupation='+guardian_other_occupation_val+'&pd_guardian_email='+pd_guardian_email_val+'&father_alt_mobile_no='+father_alt_mobile_no+'&father_alt_phone_no_code='+father_alt_phone_no_code+'&mother_alt_phone_no_code='+mother_alt_phone_no_code+'&mother_alt_phone='+mother_alt_phone+'&'+csrfName+'='+csrfHash;
        var moveNxt=0;
					$.ajax({
								type: 'POST',
								url: url,
								data: userData+'&currentIndex='+currentIndex,
								dataType: 'json',
								cache: false,
                				beforeSend: function() { $('.loader').show(); },
								success: function(returndata) {
                  var status_parents = returndata.parent_response.status;
									if(returndata){
                    console.log(status_parents+"status_parents");
             						 if(status_parents == 'true' || status_parents == true) { 
                          if(isexit==1) {
                                  window.location.href = save_exit_redirect_url;
                                  return false;
                            }
                            else
                            {
                              var startIndex = currentIndex+1
                           window.location.href =  url+'?startIndex='+startIndex; 
                           $("#formerr").hide();
                            moveNxt=1;
                            }
	                				}
	                			 }
            					},
								error: function(returndata) {
								  $('.loader').hide();
                  moveNxt=0;
                  console.log(returndata);
                  $("#formerr").show();                 
                  return false;
								},
							});							
							if(moveNxt){
              return true;
              }
					  } else { 
					  	pd_father_title.validate();
						pd_father_name.validate();
						pd_father_phone.validate();
						pd_mother_title.validate();
						pd_mother_name.validate();
						pd_father_email.validate();
						pd_mother_email.validate();
						pd_mother_phone.validate();
						pd_guardian_name.validate();
						pd_guardian_phone.validate();
						pd_guardian_email.validate();
						pd_guardian_occupation.validate();
						pd_father_alt_phone.validate();
						pd_mother_alt_phone.validate();
            pd_father_other_occupation.validate();
            pd_mother_other_occupation.validate();
            guardian_other_occupation.validate();
            pd_mother_occupation.validate();
            pd_father_occupation.validate();
            $(this).attr('isexit','');
						return false;
					  }
					}

				if(currentIndex === 3) {
					var country = $('#country').parsley();
					var state = $('#state').parsley();
					var district = $('#district').parsley();
					var city = $('#city').parsley();
					var address1 = $('#address_line1').parsley();
					var pincode = $('#pincode').parsley();
					if(country.isValid() && state.isValid() && district.isValid() && city.isValid() && address1.isValid() && pincode.isValid()) {
						  	var country_id 	= 	$('#country').val();
						  	var state_id 	= 	$('#state').val();
						  	var district_id = 	$('#district').val();
						  	var city_id     = 	$('#city').val();
						  	var address1    =  	$('#address_line1').val();
						  	var address2    =  	$('#address_line2').val();
						  	var pincode 	=	$('#pincode').val();
                var isexit = ($(this).attr('isexit'));
						  	var userData = 'country_id='+country_id+'&state_id='+state_id+'&district_id='+district_id+'&city_id='+city_id+'&address_line_1='+address1+'&address_line_2='+address2+'&pincode='+pincode+'&'+csrfName+'='+csrfHash;
                var moveNxt=0;
						  	$.ajax({
								type: 'POST',
								url: url,
								data: userData+'&currentIndex='+currentIndex,
								dataType: 'json',
								cache: false,
                beforeSend: function() { $('.loader').show(); },
								success: function(returndata) {
                  var status_address = returndata.address_response.status;
							if(returndata){
                console.log(status_address+"status_address");
	                		if(status_address == 'true' || status_address == true) { 
                        if(isexit==1){
                                  window.location.href = save_exit_redirect_url;
                                  return false;
                            }else{
                              var startIndex = currentIndex+1
                             window.location.href = url+'?startIndex='+startIndex;
                              $("#formerr").hide();
                              moveNxt=1;  
                            }
	              			}
	              		}
            		},
								error: function(returndata) {
								  $('.loader').hide();
                  moveNxt=0;
                  console.log(returndata);
                  $("#formerr").show();                 
                  return false;
								},
							});							
							if(moveNxt){
              return true;
                }
					  } else { 
						country.validate();
						state.validate();
						district.validate();
						city.validate();
						address1.validate();
						pincode.validate();
            $(this).attr('isexit','');
						return false;
					  }
				}

                if(currentIndex === 4) {
                    var appering 	= $('#appering').parsley();
					var completed 	= $('#completed').parsley();
	                var tenth_name 	= $('#tenth_name').parsley();
	                var institute_name_0= $('#institute_name_0').parsley();
	                var board_0= $('#board_0').parsley();
	                var marking_scheme_0=$('#marking_scheme_0').parsley();
	                var obtained_percentage_cgpa_0 =$('#obtained_percentage_cgpa_0').parsley();
	                var year_of_passing_0=$('#year_of_passing_0').parsley();
	                var registration_no_0=$("#registration_no_0").parsley();

	                var institute_name_1= $('#institute_name_1').parsley();
	                var board_1= $('#board_1').parsley();
	                var marking_scheme_1=$('#marking_scheme_1').parsley();
	                var obtained_percentage_cgpa_1 =$('#obtained_percentage_cgpa_1').parsley();
	                var year_of_passing_1=$('#year_of_passing_1').parsley();
	                var registration_no_1=$("#registration_no_1").parsley();
	                var digilocker_id = $('#digilocker_id').parsley();

	               
	                if(appering.isValid() && completed.isValid() && tenth_name.isValid() && institute_name_0.isValid() && board_0.isValid() && marking_scheme_0.isValid() && obtained_percentage_cgpa_0.isValid() && year_of_passing_0.isValid() && registration_no_0.isValid() && institute_name_1.isValid() && board_1.isValid() && marking_scheme_1.isValid() && obtained_percentage_cgpa_1.isValid() && year_of_passing_1.isValid() && digilocker_id.isValid() )
	                {
	                	var current_education_qual_status 	=	$('input[name=current_education_qual_status]:checked').val();	
						var tenth_name 	= $('#tenth_name').val();
						var institute_name_0_val= $('#institute_name_0').val();
						var board_0_val= $('#board_0').val();
						//var mode_of_study_0_val= $('#mode_of_study_0').val();
						var marking_scheme_0_val=$('#marking_scheme_0').val();
						var obtained_percentage_cgpa_0_val =$('#obtained_percentage_cgpa_0').val();
						var year_of_passing_0_val=$('#year_of_passing_0').val();
						var registration_no_0_val=$("#registration_no_0").val();
						var schooling_id_0_val=$("#schooling_id_0").val();

						var institute_name_1_val= $('#institute_name_1').val();
						var board_1_val= $('#board_1').val();
						//var mode_of_study_1_val= $('#mode_of_study_1').val();
						var marking_scheme_1_val=$('#marking_scheme_1').val();
						var obtained_percentage_cgpa_1_val =$('#obtained_percentage_cgpa_1').val();
						var year_of_passing_1_val=$('#year_of_passing_1').val();
						var registration_no_1_val=$("#registration_no_1").val();
						var grad_id_1=$("#grad_id_1").val();
						var digilocker_id = $('#digilocker_id').val();
            var isexit = ($(this).attr('isexit'));
						            	
	                	var userData = 'current_education_qual_status='+current_education_qual_status+'&tenth_name='+tenth_name+'&institute_name_0='+institute_name_0_val+'&board_0='+board_0_val+'&marking_scheme_0='+marking_scheme_0_val+'&obtained_percentage_cgpa_0='+obtained_percentage_cgpa_0_val+'&year_of_passing_0='+year_of_passing_0_val+'&registration_no_0='+registration_no_0_val+'&institute_name_1='+institute_name_1_val+'&board_1='+board_1_val+'&marking_scheme_1='+marking_scheme_1_val+'&obtained_percentage_cgpa_1='+obtained_percentage_cgpa_1_val+'&year_of_passing_1='+year_of_passing_1_val+'&registration_no_1='+registration_no_1_val+'&digilocker_id='+digilocker_id+'&scl_det_id_0='+schooling_id_0_val+'&grad_id_1='+grad_id_1+'&'+csrfName+'='+csrfHash;
	                	$.ajax({
								type: 'POST',
								url: url,
								data: userData+'&currentIndex='+currentIndex,
								dataType: 'json',
								cache: false,
                beforeSend: function() { $('.loader').show(); },
								success: function(returndata) {
                  console.log(returndata);
									if(returndata){
              				if(returndata.status == 'true' || returndata.status == true) {
                				console.log(returndata);
                        if(isexit==1){
                                  window.location.href = save_exit_redirect_url;
                                  return false;
                            }
                            else
                            {
                             var startIndex = currentIndex+1
                         window.location.href = url+'?startIndex='+startIndex; 
                         $("#formerr").hide();
                            moveNxt=1;  
                       }
                			
              		}
          }
            },
								error: function(returndata) {
								  moveNxt=0;
                  console.log(returndata);
                  $("#formerr").show();  
                  $(".loader").hide();               
                  return false;
								},
							});	
	            if(moveNxt){
              return true;
                } 
	                } else {
	                    	appering.validate();
	                    	completed.validate();
	                    	tenth_name.validate();
	                    	institute_name_0.validate();
	                    	board_0.validate();
	                    	marking_scheme_0.validate();
	                    	obtained_percentage_cgpa_0.validate();
	                    	year_of_passing_0.validate();
	                    	registration_no_0.validate();
	                    	institute_name_1.validate();
	                    	board_1.validate();
	                    	marking_scheme_1.validate();
	                    	obtained_percentage_cgpa_1.validate();
	                    	year_of_passing_1.validate();
	                    	registration_no_1.validate();
                        digilocker_id.validate();
                        $(this).attr('isexit','');
	                        return false;
	                    }
                }				
				 

                if(currentIndex === 5) {
                    check_visible_input_validation('payment_details','BankName','<?php echo REQD_CHOOSE_BANK_MSG; ?>',false);
                    check_visible_input_validation('payment_details','BranchName','<?php echo REQD_BANK_NAME_MSG; ?>',false);
                    check_visible_input_validation('payment_details','DDNumber','<?php echo REQD_DD_NO_MSG; ?>',false);
                    check_visible_input_validation('payment_details','DDDate','<?php echo REQD_DD_DATE_MSG; ?>',false);
                    var bank_name = $('#BankName').parsley();
                    var branch_name = $('#BranchName').parsley();
                    var ddnumber = $('#DDNumber').parsley();
                    var ddate = $('#DDDate').parsley();
                    var online = $('#online').parsley();
                    var dd = $('#dd').parsley();
          
                      if(bank_name.isValid() && branch_name.isValid() && ddnumber.isValid() && ddate.isValid() && online.isValid() && dd.isValid()){
                        if($('#online').is(':checked')){
                          var payment_mode = 'online';
                        }else if($('#dd').is(':checked')){
                          var payment_mode = 'dd';
                        }   
                        if(payment_mode=="dd"){	        
                        var bank_name = $('#BankName').val();
                        var branch_name = $('#BranchName').val();
                        var dd_cheque_no = $('#DDNumber').val();
                        var dd_cheque_date = $('#DDDate').val();
                        var form_id = app_form_id;
                        var user_data = 'bank_name='+bank_name+'&branch_name='+branch_name+'&dd_cheque_no='+dd_cheque_no+'&dd_cheque_date='+dd_cheque_date+'&payment_mode='+payment_mode+'&app_form_id='+form_id;  
						var moveNxt=0;		
                        <?php if(empty($payment_details_list)) { ?> 
                        $.ajax({
                          type: 'POST',
                          url: payment_url,
                          data: user_data,
                          dataType: 'json',
                          cache: false,
                          async: false,
                          beforeSend: function() { $('.loader').show(); },
                          success: function(returndata) {
								if(returndata) {	
									if(returndata.status == 'true') {
										setTimeout(function() { window.location.href = redirect_payment_thank_you+'&payment_mode='+payment_mode+'&currentIndex='+currentIndex+url_edit; }, 200);
										$("#formerr").hide();
  									  moveNxt=1;										
  								}								
								}
							},
							error: function(returndata) {
          				      console.log(returndata);
								  moveNxt=0;							
								  $("#formerr").show();
								  $('.loader').hide(); 							  
								  return false; 
          				},
                        }); 
                       
                        <?php }else{ ?>
							setTimeout(function() { 
								$('.loader').hide();
							},100);			
							$("#formerr").hide();
							moveNxt=1;						
							return true;
                        <?php } ?>
                      }
						if (payment_mode=='online')	
						{		<?php if(empty($payment_details_list)) { ?>
								  window.location.href = '<?php echo base_url(); ?>user/payment_process?app_form_id='+app_form_id+'&index='+currentIndex+url_edit;
			                     <?php } else { ?>
			                     return true;
			                     <?php }?>
						}
                      }else{
                        bank_name.validate();
                        branch_name.validate();
                        ddnumber.validate();
                        ddate.validate();
                        dd.validate();
                        online.validate();
                        return false;
                      }
                }



                if(currentIndex == 6) {
                	var applicant_name = $('#applicant_name').parsley();
					       var parent_name = $('#parent_name').parsley();
        			   var declaration_date = $('#ddate').parsley();
        			   if(applicant_name.isValid() && parent_name.isValid() && declaration_date.isValid()) {
          				var applicant_name  = $('#applicant_name').val();
	          			var parent_name   = $('#parent_name').val();
	          			var declaration_date  = $('#ddate').val();
						      var userData = 'applicant_name='+applicant_name+'&parent_name='+parent_name+'&declaration_date='+declaration_date+'&'+csrfName+'='+csrfHash;
                  var isexit = ($(this).attr('isexit'));
                  var moveNxt=0;
	  				      var AjaxRequest = $.ajax({
  					           type: 'POST',
  					           url: url,
  					           data: userData+'&currentIndex='+currentIndex,
  					           dataType: 'json',
  					           cache: false,
  					           beforeSend: function() { $('.loader').show(); },
  					           success: function(returndata) {
					           if(returndata)
                     {
  		      				     if(returndata.status == 'true' || returndata.status == true) {
                          if(isexit==1){
                                  window.location.href = save_exit_redirect_url;
                                  return false;
                            }
                            else{
                             var startIndex = currentIndex+1
                           window.location.href = url+'?startIndex='+startIndex;
                           $("#formerr").hide();
                            moveNxt=1; 
                            }
  		      		        }
		  		           }
                   },
  			           error: function(returndata) {
  	  		               moveNxt=0;
                          console.log(returndata);
                          $("#formerr").show();   
                          $(".loader").hide();              
                          return false;
                       },
			           });
                  if(moveNxt){
			           return AjaxRequest;
               }
	            } else {
	             applicant_name.validate();
	             parent_name.validate();
	             declaration_date.validate();
               $(this).attr('isexit','');
	               return false;
	           }
                		
					}
                
			}
			else { 
				return true; 
			}	
        },
        saveState: true,
        onStepChanged: function (event, currentIndex, priorIndex) { 
        	var isexit=($(this).attr('isexit'));        	
        	if(isexit!='undefined' &&  isexit==1)
        	{
        	  setTimeout(function() {   
             window.location.href = save_exit_redirect_url;
             },1);
        	}
        	if(currentIndex==4){
				$(".actions ul > li:nth-child(2) a").text('<?php echo MAKE_PAYMENT; ?>');
			}else{
				$(".actions ul > li:nth-child(2) a").text('<?php echo NEXT_STEP; ?>');
			}
        	enable_saveExit_btn(currentIndex,5);
      /*// form preview button displayed
        if(currentIndex == 6){
          var preview_button = $("<li id='preview_li' style='list-style:none;'><a href='<?php echo base_url();?>barch_form_preview' style='float:left;background:unset;'><input type='button' id='form_preview_btn' class='btn btn-primary' value='Form Preview'></a></li>");
          $(document).find(".actions").prepend(preview_button);
        }else{
        $('#preview_li').remove();
      }*/

      // form preview button displayed
      if(currentIndex == parseInt(total_wizard_Step - 1)){
    	  $("#save_exit").remove();
    	  //enable_preview_btn(currentIndex,'<?php echo base_url();?>march_form_preview');
        if(mode_edit_url !='')
        {
          enable_preview_btn(currentIndex,'<?php echo base_url();?>march_form_preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
        }else{
          enable_preview_btn(currentIndex,'<?php echo base_url();?>march_form_preview');
        }
      }else{
        $("#previewbtn").remove();
      }

      // This code for step count display in view part like STEPS 1 OF 7
        $("#show_currentindex").text(currentIndex+1+' Of '+total_wizard_Step);

      // Percentage Show Tab Wise
        tab_wise_percentage_show(get_percentage_url,'percentage_bar');    
		}, 
        onCanceled: function (event) { },
        onFinishing: function (event, currentIndex) { return true; }, 
        onFinished: function (event, currentIndex) { 
          wizard_final_step(url,currentIndex,redirect_thank);
          //setTimeout(function() { window.location.href = redirect_thank; }, 100);     
            //setTimeout(function() { window.location.href = redirect_thank; }, 100);
        },

        /* Labels */
        labels: {
            cancel: "Cancel",
            current: "current step:",
            pagination: "Pagination",
			finish: "<?php echo FORM_SUBMIT_VALUE; ?>",
            next: "<?php echo WIZARD_NEXT; ?>",
            previous: "<?php echo WIZARD_PREVIOUS; ?>",
            loading: "Loading ..."
        }
    }

    $("#marchdesign_form").steps(settings);
  //setsave exit attr	
  	    $(document).on("click", "#save_btn" , function() {
  	    	 $("#marchdesign_form").attr('isexit',1);
  	         $("#marchdesign_form").steps('next');
          });
          
          $('.actions a').click(function(){        	 
            $("#marchdesign_form").attr('isexit','');
          }); 
  //end set attr
  //to remove links from previous tabs a
    <?php if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) && ($mode_edit == '')) { ?>
     $( ".steps li" ).each(function( index ) { 
      if(index<6){       	 
   	  $("#marchdesign_form-t-"+index).removeAttr("href");
     }			   
   	});
    <?php } ?>
        $(document).ready(function () {
            'use strict';

            $('#academic_accordion').click();
            $('.instruction_accordion').click();

            light_box_init();

			var no_qualify_degree_msg = "Sorry, Qualifying Degree not available.";
			var no_spec_qualify_degree_msg = "Sorry, Specialization In Qualifying Degree not available.";
			var no_nationality_msg = "<?php echo NO_NATIONALITY_MSG; ?>";
			var no_resident_status_msg = "<?php echo NO_RESIDENT_STATUS_MSG; ?>";
			var no_studied_from_india_msg = "<?php echo NO_STUDY_RESIDENT_IN_MSG; ?>";
			var no_blood_grp_msg = "<?php echo NO_BLOOD_GROUP_MSG; ?>";
			var no_country_msg = "<?php echo NO_COUNTRY_MSG; ?>";
			var no_state_msg = "<?php echo NO_STATE_MSG; ?>";
			var no_city_msg = "<?php echo NO_CITY_MSG; ?>";
			var no_district_msg = "<?php echo NO_DISTRICT_MSG; ?>";
			var no_mobile_code_msg = "<?php echo NO_MOBILE_CODE_MSG; ?>";
			var no_qualifying_degree_msg = "<?php echo NO_QUALIFYING_DEGREE_MSG; ?>";
			var no_spec_qualifying_degree_msg = "<?php echo NO_QUALIFYING_SPL_DEGREE_MSG; ?>";
			var no_working_dsc_msg = "Sorry, Department / College / School not available.";
			var no_faculty_msg = "Sorry, Faculty not available.";
			var no_category_msg = "Sorry, Category not available.";
			var no_work_experience_msg = "Sorry, Work Experience not available.";
			var no_working_place_msg = "Sorry, Working Place not available.";
			var no_gender_title_msg = "<?php echo NO_GENDER_TITLE_MSG; ?>";
			var no_gender_msg = "<?php echo NO_GENDER_MSG; ?>";
			var no_blood_group_msg = "<?php echo NO_BLOOD_GROUP_MSG; ?>";
			var no_social_status_msg = "<?php echo NO_SOCIAL_STATUS_MSG; ?>";
			var no_differently_abled_msg = "<?php echo NO_DIFFRENTLY_ABLED_MSG; ?>";
			var no_nature_deformity_msg = "Sorry, Nature Of Deformity not available.";
			var no_percent_deformity_msg = "Sorry, Percentage Of Deformity not available.";
      		var no_institute_university_msg = "Sorry, Institute/University not available.";
      		var no_user_marking_scheme_msg = "Sorry, Marking Scheme not available.";
      		var no_competitive_exam_msg = "Sorry, Competitive Exams not available.";
      		var no_campus_prefer_msg = "Sorry, Campus Preference not available.";
      		var no_specialization_prefer_msg = "Sorry, Specialization Preference not available.";
			var no_religion_grp_msg = "<?php echo NO_RELIGIONS_MSG; ?>";
			var no_medium_inst_msg = "<?php echo NO_MEDIUM_OF_INSTRUCTION_MSG; ?>";
      		var no_mother_tongue_msg = "<?php echo NO_MOTHER_TONGUES_MSG; ?>";			
      		var no_taken_any_competitive_exam_msg = "Sorry, Competitive Exam Taken Status not available.";
			var no_hostel_accommodation_msg = "<?php echo NO_HOSTEL_ACCOMMODATION_MSG; ?>";
			var no_advertisement_source_msg = "<?php echo NO_ADVERTISEMENT_SOURCE_MSG; ?>";
			var no_mobile_code_msg = "<?php echo NO_MOBILE_CODE_MSG; ?>";
			var no_title_msg = "<?php echo NO_TITLE_MSG; ?>";
			var no_occupation_msg = "<?php echo NO_OCCUPATION_MSG; ?>";
			var no_mode_of_study ="Sorry, Mode of Study not available.";
			var no_course_msg = "Sorry, Course not available.";
			var no_board_msg = "<?php echo NO_BOARD_MSG; ?>";
      		var no_banks_msg = "<?php echo NO_BANKS_MSG; ?>";
			

			basic_change();	


      getSelect2('BankName','<?php echo base_url("get_banks"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Bank', formatRepoCommon,no_banks_msg, false, formatRepoSelection);
			
	  getSelect2('campus_pref_1','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_campus=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&sort_by=id&sort_order=asc'+url_edit,'Choose Campus Preference', formatRepoCommon,no_campus_prefer_msg, false, formatRepoSelection);

	   getSelect2('pd_nationality','<?php echo base_url("get_nationalities"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Nationality', formatRepoCommon,no_nationality_msg, false, formatRepoSelection);

	    getSelect2('resident_info','<?php echo base_url("get_resident_status"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Resident Status', formatRepoCommon,no_resident_status_msg, false, formatRepoSelection);

        getSelect2('graduation_india','<?php echo base_url("get_studied_from_india"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Status', formatRepoCommon,no_studied_from_india_msg, false, formatRepoSelection);

		getSelect2('mode_of_study','<?php echo base_url("get_mode_of_study"); ?>?is_lookup_master=1'+url_edit,'', formatRepoCommon,no_mode_of_study, false, formatRepoSelection);

			

			// Check if the user is non resident 
			// Basic Details Tab 1
			$('#resident_info').on('change',function(){
				var resident_status = $(this).val();
				if(resident_status) {
					//$('.actions ul li:nth-child(2) a').css('pointer-events','none');
					//$('.actions ul li:nth-child(2)').addClass('disabled');
					$('#custom-resident_status-parsley-error').css('color','#ff0000');
					$('#custom-resident_status-parsley-error').text('Cannot Proceed. Please read instruction below.');
				}
			});

			getSelect2('country','<?php echo base_url("get_countries"); ?>?sort_by=country_id&sort_order=asc'+url_edit,'Choose Country', formatRepoCommon,no_country_msg, false, formatRepoSelection);	

			getSelect2('phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);

			getSelect2('qualifying_degree','<?php echo base_url("get_qualifying_degree"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Qualifying Degree', formatRepoCommon,no_qualifying_degree_msg, false, formatRepoSelection);
			
			getSelect2('specialization_qualifying_degree','<?php echo base_url("get_spec_qualifying_degree"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Specialization Qualifying Degree', formatRepoCommon,no_spec_qualifying_degree_msg, false, formatRepoSelection);

			getSelect2('working_dsc','<?php echo base_url("get_working_dsc"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Department / College / School', formatRepoCommon,no_working_dsc_msg, false, formatRepoSelection);
			
			getSelect2('faculty','<?php echo base_url("get_faculty"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Faculty', formatRepoCommon,no_faculty_msg, false, formatRepoSelection);

			getSelect2('category','<?php echo base_url("get_work_category"); ?>?is_lookup_master=1'+url_edit,'Choose Category', formatRepoCommon,no_category_msg, false, formatRepoSelection);
			
			getSelect2('is_employed','<?php echo base_url("get_are_you_employed"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Working Type', formatRepoCommon,no_work_experience_msg, false, formatRepoSelection);			

			getSelect2('working_place','<?php echo base_url("get_working_place"); ?>?is_lookup_master=1'+url_edit,'Choose Working Place', formatRepoCommon,no_working_place_msg, false, formatRepoSelection);

			getSelect2('pd_title','<?php echo base_url("get_gender_title"); ?>?is_lookup_master=1'+url_edit,'Choose  Title', formatRepoCommon,no_gender_title_msg, false, formatRepoSelection);
			
			getSelect2('pd_gender','<?php echo base_url("get_gender"); ?>?is_lookup_master=1'+url_edit,'Choose Gender', formatRepoCommon,no_gender_msg, false, formatRepoSelection);
			
			getSelect2('pd_blood_group','<?php echo base_url("get_bloodgroups"); ?>?sort_by=blood_grp_id&sort_order=asc'+url_edit,'Choose Blood Groups', formatRepoCommon,no_blood_group_msg, false, formatRepoSelection);

			getSelect2('pd_religion','<?php echo base_url("get_mtechrereligion"); ?>?sort_by=religion_id&sort_order=asc'+url_edit,'Choose Religion', formatRepoCommon,no_religion_grp_msg, false, formatRepoSelection);

			getSelect2('pd_mother_tongue','<?php echo base_url("get_mtechremothertong"); ?>?sort_by=mothertongue_id&sort_order=asc'+url_edit,'Choose Mother Tongue', formatRepoCommon,no_mother_tongue_msg, false, formatRepoSelection);

			getSelect2('pd_social_status','<?php echo base_url("get_social_status"); ?>?is_lookup_master=1'+url_edit,'Choose Social Status', formatRepoCommon,no_social_status_msg, false, formatRepoSelection);

			getSelect2('pd_medium_of_instruction','<?php echo base_url("get_mtechremothertong"); ?>?sort_by=mothertongue_id&sort_order=asc'+url_edit,'Choose Mother Tongue', formatRepoCommon,no_medium_inst_msg, false, formatRepoSelection);

			getSelect2('pd_hostel_accommodation','<?php echo base_url("get_hostel_accommodation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Hostel Accommodation', formatRepoCommon,no_hostel_accommodation_msg, false, formatRepoSelection);

			getSelect2('pd_diffrently_abled','<?php echo base_url("get_are_you_differently_abled"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Differently Abled', formatRepoCommon,no_differently_abled_msg, false, formatRepoSelection);

			getSelect2('pd_advertisement_source','<?php echo base_url("get_advertisement_source"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Advertisement Source', formatRepoCommon,no_advertisement_source_msg, false, formatRepoSelection);
			
			
			getSelect2('pd_nature_deformity','<?php echo base_url("get_nature_of_deformity"); ?>?is_lookup_master=1'+url_edit,'Choose Nature Of Deformity', formatRepoCommon,no_nature_deformity_msg, false, formatRepoSelection);
			
			getSelect2('pd_percent_of_deformity','<?php echo base_url("get_percentage_of_deformity"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Percentage Of Deformity', formatRepoCommon,no_percent_deformity_msg, false, formatRepoSelection);


			getSelect2('pd_father_title','<?php echo base_url("get_parent_title"); ?>?is_lookup_master=1&is_father=1'+url_edit,'Choose Title', formatRepoCommon,no_title_msg, false, formatRepoSelection);

			getSelect2('pd_father_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);		
			getSelect2('pd_father_alt_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);		
			
			getSelect2('pd_father_occupation','<?php echo base_url("get_parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Father Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);

			getSelect2('pd_mother_title','<?php echo base_url("get_mother_title"); ?>?is_lookup_master=1&is_mother=1'+url_edit,'Choose Title', formatRepoCommon,no_title_msg, false, formatRepoSelection);

			getSelect2('pd_mother_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
			getSelect2('pd_mother_alt_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
			
			getSelect2('pd_mother_occupation','<?php echo base_url("get_parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Mother Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);


			// Show Father & Mother Input
			show_parents_detail('pd_father_title','father_mbleno_div','father_email_div','father_occupation_div','father_alt_mbleno_div',);
			show_parents_detail('pd_mother_title','mother_mbleno_div','mother_email_div','mother_occupation_div','mother_alt_mbleno_div');

			

			$('#add_guardian_checkbox').on('change',function(){
				chk_guardian($(this).is(':checked'));
			});
			
			getSelect2('pd_guardian_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
			
			getSelect2('pd_guardian_occupation','<?php echo base_url("get_parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Mother Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);

			getSelect2('board_0','<?php echo base_url("get_board"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select', formatRepoCommon,no_board_msg, false, formatRepoSelection); 

			getSelect2('marking_scheme_0','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Select', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

			getSelect2('mode_of_study_1','<?php echo base_url("get_mode_of_study"); ?>?is_lookup_master=1'+url_edit,'Select', formatRepoCommon,no_mode_of_study, false, formatRepoSelection);

			getSelect2('mode_of_study_0','<?php echo base_url("get_mode_of_study"); ?>?is_lookup_master=1'+url_edit,'Select', formatRepoCommon,no_mode_of_study, false, formatRepoSelection);

			/*getSelect2('board_1','<?php echo base_url("get_board"); ?>?sort_by=name&sort_order=asc','Select', formatRepoCommon,no_board_msg, false, formatRepoSelection); */

      getSelect2('board_1','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc'+url_edit,'Select Board', formatRepoCommon,no_board_msg, false, formatRepoSelection);  

			getSelect2('marking_scheme_1','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Select', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

            getSelect2('institute_university_1','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Institute/University', formatRepoCommon,no_institute_university_msg, false, formatRepoSelection);
            getSelect2('institute_university_2','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Institute/University', formatRepoCommon,no_institute_university_msg, false, formatRepoSelection);
            getSelect2('university_id','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc'+url_edit,'', formatRepoCommon,no_institute_university_msg, false, formatRepoSelection);            

            getSelect2('user_marking_scheme_1','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
            getSelect2('user_marking_scheme_2','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
            getSelect2('user_marking_scheme_3','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

            getSelect2('competitive_exam_0','<?php echo base_url("get_competitive_exams"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Competitive Exam', formatRepoCommon,no_competitive_exam_msg, false, formatRepoSelection);

            getSelect2('competitive_exam_1','<?php echo base_url("get_competitive_exams"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Competitive Exam', formatRepoCommon,no_competitive_exam_msg, false, formatRepoSelection);

            getSelect2('competitive_exam_2','<?php echo base_url("get_competitive_exams"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Competitive Exam', formatRepoCommon,no_competitive_exam_msg, false, formatRepoSelection);

            getSelect2('qualify_0','<?php echo base_url("get_compexam_qualifiedstatus"); ?>?sort_by=name&sort_order=asc'+url_edit,'', formatRepoCommon,no_competitive_exam_msg, false, formatRepoSelection);

            getSelect2('qualify_1','<?php echo base_url("get_compexam_qualifiedstatus"); ?>?sort_by=name&sort_order=asc'+url_edit,'', formatRepoCommon,no_competitive_exam_msg, false, formatRepoSelection);

            getSelect2('qualify_2','<?php echo base_url("get_compexam_qualifiedstatus"); ?>?sort_by=name&sort_order=asc'+url_edit,'', formatRepoCommon,no_competitive_exam_msg, false, formatRepoSelection);

            getSelect2('taken_any_competitive_exam','<?php echo base_url("get_have_you_taken_any_competitive_exam"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Status', formatRepoCommon,no_taken_any_competitive_exam_msg, false, formatRepoSelection);


			$("#graduation_india").change(function()
			{
				basic_change();				
			});

			$('#qualifyexamfromindia').change(function() {
		    	if($(this).is(':checked')) {
		    		$(this).val(1);
		    	} else {
		    		$(this).val(0);
		    	}
		    });	
			
			// Onchange COuntry
    $('#country').on('change',function() {
      setEmptyOnChangeSelect2('state'); 
      // when no values return in json, add empty option value 
      if ($('#state').data('select2')) {$('#state').select2('destroy');}
      // make empty
      $('#state').html('');
      var country_val = $(this).val();
      var url = '<?php echo base_url("get_states"); ?>?country_id='+country_val+  '&sort_by=id&sort_order=asc'+url_edit;
      onchange_country('main_div_state','main_div_district','main_div_city','state','city','district',url,no_state_msg,country_value_default,country_val)
    }); 
    
    // Onchange State
    $('#state').on('change',function() {
      setEmptyOnChangeSelect2('district');
      // when no values return in json, add empty option value 
      if ($('#district').data('select2')) {
        $('#district').select2('destroy');
        // make empty
        $('#district,#city').html('');  
      }         
      var state_val = $(this).val();
      var country_val = $('#country').val();
      var url = '<?php echo base_url("get_district"); ?>?state_id='+state_val+'&sort_by=id&sort_order=asc'+url_edit;
      if(country_value_default==country_val){ 
        $('#main_div_district').show();
        getSelect2('district',url,'Select District', formatRepoCommon,no_district_msg, false, formatRepoSelection);
      }
    });     
  
    // Onchange District
    $('#district').on('change',function() {
      setEmptyOnChangeSelect2('city');
      // when no values return in json, add empty option value 
      if ($('#city').data('select2')) {$('#city').select2('destroy');}      
      // make empty
      $('#city').html('');      
      var state_val = $('#state').val();
      var country_val = $('#country').val();
      if(country_value_default==country_val){ 
        $('#main_div_city').show();
        getSelect2('city','<?php echo base_url("get_cities"); ?>?state_id='+state_val+'&sort_by=id&sort_order=asc'+url_edit,'Select City', formatRepoCommon,no_city_msg, false, formatRepoSelection);
      }
    }); 	

			// Basic Details On Change Start
			$('#category').on('change',function() {
				var category = $("#category").val();
				setEmptyOnChangeSelect2('is_employed');
				if ($('#is_employed').data('select2')) {
					$('#is_employed').select2('destroy');
				}				
				
				$('#is_employed').html(''); // reset select values for, if user selected the value then change the country code, then select same value, and value will be null, that so we reset the select values
				
				getSelect2('is_employed','<?php echo base_url("get_are_you_employed"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Working Type', formatRepoCommon,no_work_experience_msg, false, formatRepoSelection);	
				
				if(part_time_external==category){
					$("#main_div_is_employed").show();
					$('#category_check').val('1')
				}else{
					$("#main_div_is_employed").hide();
					$("#main_div_working_place").hide();
				}
			});
			
			$('#is_employed').on('change',function() {
				var is_employed = $("#is_employed").val();
				console.log("is_employed "+is_employed);
				
				if(is_employed=='yes'){
					$("#main_div_working_place").show();
				}else{
					$("#main_div_working_place").hide();
				}
			});	
			
			// Other Input Enable
			$('#qualifying_degree').on('change',function() {
				var qualifying_degree = $("#qualifying_degree").val();
				console.log("qualifying_degree "+qualifying_degree);
				if(qualifying_degree==country_value_default){
					$("#other_qd").show();
				}else{
					$("#other_qd").hide();
				}
			});				
			
			
			// Basic Details On Change End
			
			// Personal Details On Change Start
			
			$('#pd_nationality').on('change',function() {
				var pd_nationality = $("#pd_nationality").val();
				//console.log("pd_nationality "+pd_nationality);
	
				if(pd_nationality==country_value_default){
					$("#main_div_social_status").show();
          $('#pd_social_status').attr('data-parsley-required', 'true');
          $('#pd_social_status').attr('data-parsley-required-message', 'Please Select Social Status');
				}else{
					$("#main_div_social_status").hide();
          $('#pd_social_status').attr('data-parsley-required', 'false');
				}
			});			

			$('#pd_diffrently_abled').on('change',function() {
				var pd_diffrently_abled = $("#pd_diffrently_abled").val();
				//console.log("pd_diffrently_abled "+pd_diffrently_abled);
				
				if(pd_diffrently_abled=='yes'){
					$(".main_div_deformity").show();
				}else{
					$(".main_div_deformity").hide();
				}
			});
			
			$('#phone_no_code').on('change',function() {
				var phone_no_code = $("#phone_no_code").val();
				console.log("phone_no_code "+phone_no_code);
			});				
			
			// Personal Details On Change End
			
			// DOB Datepicker
			$("#pd_dob").datepicker( {
				format:"dd/mm/yyyy" ,autoclose: true,todayHighlight: true,endDate: endDob
			}).on('changeDate', function(e) {
          $("#pd_dob").parsley().validate();
      }); 


      // DOB Datepicker

      $("#DDDate").datepicker( {
        format:"dd/mm/yyyy" ,autoclose: true,todayHighlight: true,todaybtn:true,endDate: todaydate 
      }).on('changeDate', function(e) {
          $("#DDDate").parsley().validate();
      }); 

      var Yrs=$("#year_of_passing_0").val();
            if(Yrs!="" && Yrs!="YYYY"){     
              var addYrs=3;
              var setYrs=parseInt(Yrs)+addYrs;
            $("#year_of_passing_1").attr("min",setYrs);
            }

      $("#year_of_passing_0").datepicker( {
      format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy'),startDate: '-40y',endDate: '+0d' 
        }).on('changeDate', function(e) {           
      $("#year_of_passing_0").parsley().validate();
      //var status=$("#current_qualification_status").val();
      var Yr=$("#year_of_passing_0").val();
            if(Yr!="" && Yr!="YYYY"){                
          var addYr=3;
          var setYr=parseInt(Yr)+addYr;
          $("#year_of_passing_1").attr("min",setYr);
        }
    });


        $("#year_of_passing_1").datepicker( {
      format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy'),startDate: '-40y',endDate: '+0d' 
        }).on('changeDate', function(e) {
      $("#year_of_passing_1").parsley().validate();
    });

            $("#year_of_passing_2, #year_of_passing_3 , #year_appered_0 , #year_appered_1 , #year_appered_2").datepicker( {
                format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy')
            }).on('changeDate', function(e) {            
            var id=($(this).attr('id'));
      $("#"+id).parsley().validate();
    });

            $("#from_year_0, #from_year_1, #from_year_2, #to_year_0, #to_year_1, #to_year_2").datepicker( {
                format:"mm/yyyy" , autoclose: !0, minViewMode: 'months', endDate: moment().format('dd-mm-yyyy')
            });

            calculate_months('work_experience_0','from_year_0','to_year_0','months');
            calculate_months('work_experience_1','from_year_1','to_year_1','months');
            calculate_months('work_experience_2','from_year_2','to_year_2','months');
			calculate_total_exp('months');

            $("#publications_year_0, #publications_year_1, #publications_year_2, #publications_year_3").datepicker( {
                format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy')
            });

			// $("#pd_title").select2();
			
            $(".next").click(function () {
                var percent = $('.prog').val();
                progress.value(percent);

                $(".progress-bar").css("width", percent + "%").attr("aria-valuenow", percent);
                $(".progress-completed").text(percent + "%");

                $("li").each(function () {
                    if ($(this).hasClass("activestep")) {
                        $(this).removeClass("activestep");
                    }
                });

                if (event.target.className == "col-md-2") {
                    $(event.target).addClass("activestep");
                }
                else {
                    $(event.target.parentNode).addClass("activestep");
                }

                /*hideSteps();
                showCurrentStepInfo(step); */
            });
            
            $(".nationality").change(function () {
                if ($(".nationality").val() == "") {
                    $("#indian").hide();
                    $("#indian2").hide();
                }

            });
            var result_dec = '<?php echo $applicant_result_declared[0];?>';
            if(result_dec =='')
            {
            	$('#appering').prop('checked', true);
            	
            	setTimeout(function(){ $('#appering').trigger('click');
				}, 1);
            }
            
            if(result_dec == 'f')
            {
              $("#obtained_percentage_cgpa_1").hide();
              $("#appering_info_1").hide();
              $('#marking_scheme_1').attr('data-parsley-required','false');
              $('#obtained_percentage_cgpa_1').attr('data-parsley-required','false');
              $("#custom-obtained_percentage_cgpa1-parsley-error").hide();
              $("#custom-marking_scheme1-parsley-error").hide();
              $("#graduation_marksheet_div").hide();
              $('#graduation_marksheet').attr('data-parsley-required','false');
            }
            $("#appering").click(function () {
              $("#appering_info_1").hide();
              $("#obtained_percentage_cgpa_1").hide();
              $('#marking_scheme_1').attr('data-parsley-required','false');
              $('#obtained_percentage_cgpa_1').attr('data-parsley-required','false');
              $("#custom-obtained_percentage_cgpa1-parsley-error").hide();
              $("#custom-marking_scheme1-parsley-error").hide();
              setTimeout(function(){ select2Set("marking_scheme_1",'','');
              }, 1);
              $("#obtained_percentage_cgpa_1").val('');
              $("#graduation_marksheet_div").hide();
              $('#graduation_marksheet').attr('data-parsley-required','false');
            });
            $("#completed").click(function () {
              $("#obtained_percentage_cgpa_1").show();
              $("#appering_info_1").show();
              $('#marking_scheme_1').attr('data-parsley-required','true');
              $('#obtained_percentage_cgpa_1').attr('data-parsley-required','true');
              $("#custom-obtained_percentage_cgpa1-parsley-error").show();
              $("#custom-marking_scheme1-parsley-error").show();
              $("#graduation_marksheet_div").show();
              $('#graduation_marksheet').attr('data-parsley-required','true');
            });
            //$("#payment_details").hide();
            $("#online").click(function () {
                $("#payment_details").hide();
            })
            $("#dd").click(function () {
                $("#payment_details").show();
            })
            $("#Community").hide();
            $("#pd_nationality").change(function () {
                if ($("#pd_nationality").val() == country_value_default) {
                    $("#Community").show();
                }
                else {
                    $("#Community").hide();

                }
            });

            $("#Qualification").change(function () {
                if ($("#Qualification").val() == "GraduationPursuing") {
                    $("#table4").hide();
                    $("#appering_info_1").hide();
                    $("#appering_info_2").hide();
                    $("#appering_info_3").hide();
                    $("#appering_info_4").hide();
                }
                else if ($("#Qualification").val() == "GraduationPassed") {
                    $("#table4").hide();
                    $("#appering_info_1").show();
                    $("#appering_info_2").show();
                    $("#appering_info_3").show();
                    $("#appering_info_4").show();
                } else if ($("#Qualification").val() == "Post-GraduationPursuing") {
                    $("#table4").show();
                    $("#appering_infopg_1").hide();
                    $("#appering_infopg_2").hide();
                    $("#appering_infopg_3").hide();
                    $("#appering_infopg_4").hide();
                } else if ($("#Qualification").val() == "Post-GraduationPassed") {
                    $("#table4").show();
                    $("#appering_infopg_1").show();
                    $("#appering_infopg_2").show();
                    $("#appering_infopg_3").show();
                    $("#appering_infopg_4").show();
                }
            });

        });


			var title_id = "pd_title";
			var dbtitle_id = db_title_id;			
			var dbtitle_val = db_title_name;
			//alert(dbcountry_val);
			 if(dbtitle_id){
				setTimeout(function(){ select2Set(title_id,dbtitle_id,dbtitle_val);
				}, 1);
			}

			var gender_id = "pd_gender";
			var dbgender_id = db_gender_id;			
			var dbgender_val = db_gender_name;
			//alert(dbcountry_val);
			 if(dbgender_id){
				setTimeout(function(){ select2Set(gender_id,dbgender_id,dbgender_val);
				}, 1);
			}

			var religion_id = "pd_religion";
			var dbreligion_id = db_religion_id;			
			var dbreligion_val = db_religion_name;
			//alert(dbcountry_val);
			 if(dbreligion_id){
				setTimeout(function(){ select2Set(religion_id,dbreligion_id,dbreligion_val);
				}, 1);
			}

			var pd_social_status = "pd_social_status";
			var dbsocial_status_id = db_social_status_id;
			var dbsocial_status_name_val = db_social_status_name;
			if(dbsocial_status_id){
				setTimeout(function(){ 
					select2Set(pd_social_status,dbsocial_status_id,dbsocial_status_name_val);
					$('#'+pd_social_status).trigger('change');
				}, 1);
			}

			var blood_grp_id = "pd_blood_group";			
			//alert(dbcountry_val);
			 if(db_blood_grp_id){
				setTimeout(function(){ select2Set(blood_grp_id,db_blood_grp_id,db_blood_grp_name);
				}, 1);
			}


			var mothertongue_id = "pd_mother_tongue";
			//alert(dbcountry_val);
			 if(db_mothertongue_id){
				setTimeout(function(){ select2Set(mothertongue_id,db_mothertongue_id,db_mothertongue_name);
				}, 1);
			}

			var medofinst_id = "pd_medium_of_instruction";
			//alert(db_med_of_inst_id);
			 if(db_med_of_inst_id){
				setTimeout(function(){ select2Set(medofinst_id,db_med_of_inst_id,db_med_of_inst_name);
				}, 1);
			}

			var prefer_hostel_id = "pd_hostel_accommodation";
      var hostel_accommodation_select = '';
      var hostel_accommodation_select_name = '';
          if(db_prefer_hostel_id == 't') {
          hostel_accommodation_select = 'yes';
          hostel_accommodation_select_name = 'Yes';
          } else if(db_prefer_hostel_id == 'f') {
          hostel_accommodation_select = 'no';
          hostel_accommodation_select_name = 'No';
          }
			//alert(dbcountry_val);
			 if(db_prefer_hostel_id){
				setTimeout(function(){ select2Set(prefer_hostel_id,hostel_accommodation_select,hostel_accommodation_select_name);
				}, 1);
			}

			var diff_abled_id = "pd_diffrently_abled";
      var diff_abled_select = '';
      var diff_abled_select_name = '';
          if(db_dif_abled_id == 't') {
          diff_abled_select = 'yes';
          diff_abled_select_name = 'Yes';
          } else if(db_dif_abled_id == 'f') {
          diff_abled_select = 'no';
          diff_abled_select_name = 'No';
          }
			//alert(dbcountry_val);
			 if(db_dif_abled_id){
				setTimeout(function(){ select2Set(diff_abled_id,diff_abled_select,diff_abled_select_name);
				}, 1);
			}

			var advertisement_source_id = "pd_advertisement_source";
			//alert(dbcountry_val);
			 if(db_adv_source_id){
				setTimeout(function(){ select2Set(advertisement_source_id,db_adv_source_id,db_adv_source_name);
				}, 1);
			}

			var nationality_id = "pd_nationality";
			//alert(dbcountry_val);
			 if(db_nationality_id){
				setTimeout(function(){ select2Set(nationality_id,db_nationality_id,db_nationality_name);
				}, 1);
			}

			var graduation_india = "graduation_india";
			var studied_from_india_id = '<?php echo $studied_from_india_id; ?>';
			var studied_from_india_name = '<?php echo $studied_from_india_name; ?>';

			if(studied_from_india_id){
				setTimeout(function(){ 
					select2Set(graduation_india,studied_from_india_id,studied_from_india_name);
					$('#'+graduation_india).trigger('change');
				}, 1);
			}



			var competitive_exam_0 = "competitive_exam_0";
			var competitive_exam_0_id = '<?php echo $app_comp_exam_id[0]; ?>';
			var competitive_exam_0_name = '<?php echo $app_comp_exam_name[0]; ?>';
			if(competitive_exam_0_id){
				setTimeout(function(){ 
					select2Set(competitive_exam_0,competitive_exam_0_id,competitive_exam_0_name);
					$('#'+competitive_exam_0).trigger('change');
				}, 1);
			}

			var competitive_exam_1 = "competitive_exam_1";
			var competitive_exam_1_id = '<?php echo $app_comp_exam_id[1]; ?>';
			var competitive_exam_1_name = '<?php echo $app_comp_exam_name[1]; ?>';
			if(competitive_exam_1_id){
				setTimeout(function(){ 
					select2Set(competitive_exam_1,competitive_exam_1_id,competitive_exam_1_name);
					$('#'+competitive_exam_1).trigger('change');
				}, 1);
			}

			var competitive_exam_2 = "competitive_exam_2";
			var competitive_exam_2_id = '<?php echo $app_comp_exam_id[2]; ?>';
			var competitive_exam_2_name = '<?php echo $app_comp_exam_name[2]; ?>';
			if(competitive_exam_2_id){
				setTimeout(function(){ 
					select2Set(competitive_exam_2,competitive_exam_2_id,competitive_exam_2_name);
					$('#'+competitive_exam_2).trigger('change');
				}, 1);
			}

			var qualify_0 = "qualify_0";
			var qualify_0_name = "Not Qualified";
			var qualify_0_id = '<?php echo $app_comp_qualified[0]; ?>';
			if(qualify_0_id == 't')
			{
				qualify_0_name = "Qualified";
			}
			if(qualify_0_id){
				setTimeout(function(){ 
					select2Set(qualify_0,qualify_0_id,qualify_0_name);
					$('#'+qualify_0).trigger('change');
				}, 1);
			}


			var qualify_1 = "qualify_1";
			var qualify_1_name = "Not Qualified";
			var qualify_1_id = '<?php echo $app_comp_qualified[1]; ?>';
			if(qualify_1_id == 't')
			{
				qualify_1_name = "Qualified";
			}
			if(qualify_1_id){
				setTimeout(function(){ 
					select2Set(qualify_1,qualify_1_id,qualify_1_name);
					$('#'+qualify_0).trigger('change');
				}, 1);
			}


			var qualify_2 = "qualify_2";
			var qualify_2_name = "Not Qualified";
			var qualify_2_id = '<?php echo $app_comp_qualified[2]; ?>';
			if(qualify_2_id == 't')
			{
				qualify_2_name = "Qualified";
			}
			if(qualify_2_id){
				setTimeout(function(){ 
					select2Set(qualify_2,qualify_2_id,qualify_2_name);
					$('#'+qualify_0).trigger('change');
				}, 1);
			}

			

			var campus_pref_1 = "campus_pref_1";
			var campus_pref_1_id = '<?php echo $campus_prefer_id[0]; ?>';
			var campus_pref_1_name = '<?php echo $campus_prefer_name[0]; ?>';

			if(campus_pref_1){
				setTimeout(function(){ 
					select2Set(campus_pref_1,campus_pref_1_id,campus_pref_1_name);
					$('#'+campus_pref_1).trigger('change');
				}, 1);
			}

			var taken_any_competitive_exam = "taken_any_competitive_exam";
            var is_competitive_exam_select = '<?php echo $is_competitive_exam_select; ?>';
            //alert(dbcountry_id);
            var is_competitive_exam_select_name = '<?php echo $is_competitive_exam_select_name; ?>';
            //alert(dbcountry_val);
             if(is_competitive_exam_select){
                setTimeout(function(){ select2Set(taken_any_competitive_exam,is_competitive_exam_select,is_competitive_exam_select_name);
                }, 1);
            }



			var board_0 = "board_0";
			var board_0_id = '<?php echo $applicant_board_id; ?>';
			var board_0_name = '<?php echo $applicant_board_name; ?>';
			//alert(mode_of_study_id);
			 if(board_0_id){
				setTimeout(function(){ select2Set(board_0,board_0_id,board_0_name);
				}, 1);
			}

			var board_1 = "board_1";
			var board_1_id = '<?php echo $applicant_grad_det_univ_id; ?>';
			var board_1_name = '<?php echo $applicant_grad_det_univ_name; ?>';
			//alert(mode_of_study_id);
			 if(board_1_id){
				setTimeout(function(){ select2Set(board_1,board_1_id,board_1_name);
				}, 1);
			}

			

			var marking_scheme_0 = "marking_scheme_0";
			var marking_scheme_0_id = '<?php echo $applicant_marking_scheme_id; ?>';
			var marking_scheme_0_name = '<?php echo $applicant_marking_scheme_name; ?>';
			//alert(mode_of_study_id);
			 if(marking_scheme_0_id){
				setTimeout(function(){ select2Set(marking_scheme_0,marking_scheme_0_id,marking_scheme_0_name);
				}, 1);
			}

			var marking_scheme_1 = "marking_scheme_1";
			var marking_scheme_1_id = '<?php echo $applicant_grad_det_mark_scheme_id; ?>';
			var marking_scheme_1_name = '<?php echo $applicant_grad_det_mark_scheme; ?>';
			//alert(mode_of_study_id);
			 if(marking_scheme_1_id){
				setTimeout(function(){ select2Set(marking_scheme_1,marking_scheme_1_id,marking_scheme_1_name);
				}, 1);
			}

			var country = "country";
			//alert(dbcountry_val);
			 if(db_country_id){
				setTimeout(function(){ select2Set(country,db_country_id,db_country_name);
				}, 1);
			}

      		if(country_value_default==db_country_id){
			var state = "state";
			//alert(dbcountry_val);
			 if(db_state_id){
				setTimeout(function(){ select2Set(state,db_state_id,db_state_name);
				}, 1);
			}
    		}


			var district = "district";
			//alert(dbcountry_val);
			 if(db_district_id){
				setTimeout(function(){ select2Set(district,db_district_id,db_district_name);
				}, 1);
			}

			var city = "city";
			//alert(dbcountry_val);
			 if(db_city_id){
				setTimeout(function(){ select2Set(city,db_city_id,db_city_name);
				}, 1);
			}

      <?php
      if($upload_scripts) {
        foreach($upload_scripts as $k=>$v) {
          echo $v."\n";
        }
      }
      ?>

      select2load('BankName','<?php echo $payment_details_list['bank_id']; ?>','<?php echo $payment_details_list['bank_name']; ?>');

      //Show Phoneno Code
      
      select2load('phone_no_code','<?php echo $applicant_basic_details_list['applicant_mob_country_code_id']; ?>','<?php echo $applicant_basic_details_list['applicant_mob_country_code_name']; ?>');

      select2load('pd_father_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_father]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_father]; ?>');

     select2load('pd_mother_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_mother]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_mother]; ?>');
    
     select2load('pd_guardian_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_guardian]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_guardian]; ?>');
			
        onchangeLableHide('board');
        onchangeLableHide('mode_of_study');
        onchangeLableHide('marking_scheme');
        onchangeLableHide('year_of_passing_1','date');
        onchangeLableHide('year_of_passing_0','date');
        onchangeLableHide('year_appered_0','date');

     email_suggestion("pd_alt_email","suggestion_alt_email");
      email_suggestion("pd_father_email","suggestion_father_email");
      email_suggestion("pd_mother_email","suggestion_mother_email");
      email_suggestion("pd_guardian_email","suggestion_guardian_email");


onkeyValidationCEXAM('competitive_exam_1','rollno_1','score_obtained_1','max_score_1','year_appered_1','overall_rank_1','qualify_1');
  onkeyValidationCEXAM('rollno_1','competitive_exam_1','score_obtained_1','max_score_1','year_appered_1','overall_rank_1','qualify_1');
  onkeyValidationCEXAM('score_obtained_1','competitive_exam_1','rollno_1','max_score_1','year_appered_1','overall_rank_1','qualify_1');
  onkeyValidationCEXAM('max_score_1','rollno_1','competitive_exam_1','score_obtained_1','year_appered_1','overall_rank_1','qualify_1');
  onkeyValidationCEXAM('year_appered_1','rollno_1','score_obtained_1','max_score_1','competitive_exam_1','overall_rank_1','qualify_1');
  onkeyValidationCEXAM('overall_rank_1','rollno_1','score_obtained_1','max_score_1','year_appered_1','competitive_exam_1','qualify_1');
  onkeyValidationCEXAM('qualify_1','rollno_1','score_obtained_1','max_score_1','year_appered_1','overall_rank_1','competitive_exam_1');

 onkeyValidationCEXAM('competitive_exam_2','rollno_2','score_obtained_2','max_score_2','year_appered_2','overall_rank_2','qualify_2');
  onkeyValidationCEXAM('rollno_2','competitive_exam_2','score_obtained_2','max_score_2','year_appered_2','overall_rank_2','qualify_2');
  onkeyValidationCEXAM('score_obtained_2','competitive_exam_2','rollno_2','max_score_2','year_appered_2','overall_rank_2','qualify_2');
  onkeyValidationCEXAM('max_score_2','rollno_2','competitive_exam_2','score_obtained_2','year_appered_2','overall_rank_2','qualify_2');
  onkeyValidationCEXAM('year_appered_2','rollno_2','score_obtained_2','max_score_2','competitive_exam_2','overall_rank_2','qualify_2');
  onkeyValidationCEXAM('overall_rank_2','rollno_2','score_obtained_2','max_score_2','year_appered_2','competitive_exam_2','qualify_2');
  onkeyValidationCEXAM('qualify_2','rollno_2','score_obtained_2','max_score_2','year_appered_2','overall_rank_2','competitive_exam_2');
			

        	/*Parents Details*/


        	<?php
            if($applicant_parent_title) {
                foreach($applicant_parent_title as $k=>$v) {
                	if($k == $parent_type_id_father) {
                		$input_name = 'pd_father_title';
                	} else if ($k == $parent_type_id_mother) {
                		$input_name = 'pd_mother_title';
                	}
            ?>

            		var applicant_parent_title_name<?php echo $k; ?> = '<?php echo $input_name; ?>';
                    var parent_title<?php echo $k; ?> = '<?php echo $input_name; ?>';
                    var parent_id<?php echo $k; ?> = '<?php echo $v; ?>';
                   	var parent_name<?php echo $k; ?> = '<?php echo $applicant_parent_title_name[$k]; ?>';
                    var keysss = '<?php echo $k; ?>';
                    
                    var valuuu = '<?php echo $v; ?>';
                    var input_name = '<?php echo $input_name; ?>';
                     if(parent_id<?php echo $k; ?>){
                        setTimeout(function(){ select2Set(parent_title<?php echo $k; ?>,parent_id<?php echo $k; ?>,parent_name<?php echo $k; ?>);
                        	$('#'+parent_title<?php echo $k; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
            ?>

            <?php
            if($applicant_parent_mob_country_code_id) {
                foreach($applicant_parent_mob_country_code_id as $k=>$v) {
                	if($k == $parent_type_id_father) {
                		$input_name = 'pd_father_phone_no_code';
                	} else if ($k == $parent_type_id_mother) {
                		$input_name = 'pd_mother_phone_no_code';
                	} else {
                		$input_name = 'pd_guardian_phone_no_code';
                	}
            ?>
                    var phone_no_code<?php echo $k; ?> = '<?php echo $input_name; ?>';
                    var phone_no_code_id<?php echo $k; ?> = '<?php echo $v; ?>';
                    var phone_no_code_name<?php echo $k; ?> = '<?php echo $applicant_parent_country_mob_code[$k]; ?>';
                     if(phone_no_code_id<?php echo $k; ?>){
                        setTimeout(function(){ select2Set(phone_no_code<?php echo $k; ?>,phone_no_code_id<?php echo $k; ?>,phone_no_code_name<?php echo $k; ?>);
                        	$('#'+phone_no_code<?php echo $k; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
            ?>

            <?php
            if($applicant_parent_alt_mob_countrycode_id) {
                foreach($applicant_parent_alt_mob_countrycode_id as $k=>$v) {
                	if($k == $parent_type_id_father) {
                		$input_name = 'pd_father_alt_phone_no_code';
                	} else if ($k == $parent_type_id_mother) {
                		$input_name = 'pd_mother_alt_phone_no_code';
                	} else {
                		$input_name = 'pd_guardian_alt_phone_no_code';
                	}
            ?>
                    var phone_no_code<?php echo $k; ?> = '<?php echo $input_name; ?>';
                    var phone_no_code_id<?php echo $k; ?> = '<?php echo $v; ?>';
                    var phone_no_code_name<?php echo $k; ?> = '<?php echo $applicant_parent_alt_mob_country_code[$k]; ?>';
                     if(phone_no_code_id<?php echo $k; ?>){
                        setTimeout(function(){ select2Set(phone_no_code<?php echo $k; ?>,phone_no_code_id<?php echo $k; ?>,phone_no_code_name<?php echo $k; ?>);
                        	$('#'+phone_no_code<?php echo $k; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            } else {
            	?>
            	/* fuction for select default country code on registration page */
				var id = "pd_father_alt_phone_no_code";
				var dbId = '<?php echo DEFAULT_MOBILE_CODE_ID; ?>';
				var dbVal = '<?php echo DEFAULT_MOBILE_CODE; ?>';
				select2Set(id,dbId,dbVal);
				$('#'+id).trigger('change');

				var id = "pd_mother_alt_phone_no_code";
				var dbId = '<?php echo DEFAULT_MOBILE_CODE_ID; ?>';
				var dbVal = '<?php echo DEFAULT_MOBILE_CODE; ?>';
				select2Set(id,dbId,dbVal);
				$('#'+id).trigger('change');
				/* End of Code */
            	<?php
            }
            ?>


            <?php
            if($applicant_parent_occupation_id) {
                foreach($applicant_parent_occupation_id as $k=>$v) {
                	if($k == $parent_type_id_father) {
                		$input_name = 'pd_father_occupation';
                	} else if ($k == $parent_type_id_mother) {
                		$input_name = 'pd_mother_occupation';
                	} else {
                		$input_name = 'pd_guardian_occupation';
                	}
            ?>
                    var occupation<?php echo $k; ?> = '<?php echo $input_name; ?>';
                    var occupation_id<?php echo $k; ?> = '<?php echo $v; ?>';
                    var occupation_name<?php echo $k; ?> = '<?php echo $applicant_parent_occupation_name[$k]; ?>';
                     if(occupation_id<?php echo $k; ?>){
                        setTimeout(function(){ select2Set(occupation<?php echo $k; ?>,occupation_id<?php echo $k; ?>,occupation_name<?php echo $k; ?>);
                        	$('#'+occupation<?php echo $k; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
            ?>

		<?php
			$chk_guardian = ($add_gardian == 't')?1:0;
			if($chk_guardian) {
			?>
			chk_guardian(<?php echo $chk_guardian; ?>);
			<?php
			}
		?>

    show_other_element('pd_father_occupation','father_other_occupation_div',otheroccupation);
    show_other_element('pd_mother_occupation','mother_other_occupation_div',otheroccupation);
    show_other_element('pd_guardian_occupation','guardian_other_occupation_div',otheroccupation);

		validate_cgpa('marking_scheme_0','obtained_percentage_cgpa_0');
		validate_cgpa('marking_scheme_1','obtained_percentage_cgpa_1');	
    //validate_yop('academic_yr_passing','academic_yr_passing_twelfth');

	});
		
	//initialization options for the progress bar
	// var progress = $("#progress").shieldProgressBar({
	// 	min: 0,
	// 	max: 100,
	// 	value: 20,
	// 	layout: "circular",
	// 	layoutOptions: {
	// 		circular: {
	// 			borderColor: "#eee",
	// 			width: 10,
	// 			borderWidth: 1,
	// 			color: "#5CB85C",

	// 		}
	// 	},
	// 	text: {
	// 		enabled: true,
	// 		//  template: '<span style="font-size:20px; color: #5CB85C;">{0:n0}%</span>'
	// 		template: '<span style="font-size:20px; color: #5CB85C;">20%</span>'
	// 	},
	// }).swidget();

    function is_competitive_exam_func(val) {
        if(val == 'yes') {
            $('#competitive_dtl').show();           
            enable_validate_for_emp('competitive_dtl');
            
        } else {
            $('#competitive_dtl').hide();
            disable_validate_for_emp('competitive_dtl');
        }
    }

    function enable_validate_for_emp(id) {
        $('#'+id).find('[data-parsley-required=false]').each(function() {
            $(this).attr('data-parsley-required','true');
        });
    }

    function disable_validate_for_emp(id) {
        $('#'+id).find('[data-parsley-required=true]').each(function() {
            $(this).attr('data-parsley-required','false');
        });   
    }

    
    


$("#resident").hide();
$("#study_info").hide();


           
    

    function basic_change() {
    	var study_india_id = $("#graduation_india").val(); 
        if (study_india_id == 'yes') {
            $("#study_info").show(); 
            $("#resident").hide();
            $("#resident_info_message").hide(); 
            $("#custom-qualifyingexamfromindia-parsley-error").show();       
            $('#qualifyingexamfromindia').attr('data-parsley-required',"true");
            $('#resident_info').attr('data-parsley-required',"false");
            $("#custom-resident_status-parsley-error").hide(); 
        }
        else if (study_india_id == 'no') {
            $("#study_info").hide();
            $("#resident").show(); 
            $("#resident_info_message").show(); 
            $("#custom-qualifyingexamfromindia-parsley-error").hide();
            $("#custom-resident_status-parsley-error").show();     
            $('#qualifyingexamfromindia').attr('data-parsley-required',"false");
            $('#resident_info').attr('data-parsley-required',"true");
            $("input[name=qualifyingexamfromindia]").parsley().reset();
        } else {
        	$("#study_info").hide();  
        	$("#resident_info_message").hide();
        	$("#resident").hide();  
          $("#custom-qualifyingexamfromindia-parsley-error").hide();  
          $("#custom-resident_status-parsley-error").hide();    
          $('#qualifyingexamfromindia').attr('data-parsley-required',"false");
        }
    }


  function upload_file(file_doc_type, upload_type) {
  upload_type = upload_type || false;
  
  var parsley_required = $('#'+file_doc_type).attr('data-parsley-required');
  var max_file_size = $('#'+file_doc_type).attr('data-parsley-max-file-size');
  var max_file_size_js = $('#'+file_doc_type).attr('data-max-file-size-js');
  var file_extension = $('#'+file_doc_type).attr('data-parsley-file-extension');
  var id = $('#'+file_doc_type).attr('data-file-id');
  var file_count = 'false';
  if(typeof $('#'+file_doc_type).attr('data-file-count') != 'undefined') {
    file_count = $('#'+file_doc_type).attr('data-file-count');    
  }
  // Get Regenerated CSRF Dynamically
  var csrfHashRegenerate = $("input[name='"+csrfName+"']").val();
  
  // console.log(file_count);
  // console.log($('#'+file_doc_type)[0].files[0]);
  // return false;

  var formData = new FormData();
  formData.append('applicant_login_id', logged_applicant_login_id);
  formData.append('applicant_id', logged_applicant_id);
  formData.append('file_doc_type', file_doc_type);
  formData.append('app_form_id', app_form_id);
  formData.append('chk_max_file_size', max_file_size);
  formData.append('max_file_size_js', max_file_size_js);
  formData.append('file_extension', file_extension);  
  formData.append('id', id);
  formData.append(csrfName,csrfHashRegenerate);
  if(typeof $('#'+file_doc_type).attr('data-file-count') != 'undefined') {
    $($('#'+file_doc_type)[0].files).each(function(k,v) {
      formData.append(file_doc_type+'[]', v);     
    });
  } else {
    formData.append(file_doc_type, $('#'+file_doc_type)[0].files[0]); 
  }
  if(mode_edit_url !='')
  {
    formData.append('mode',mode_edit_val);
    formData.append('applicant_personal_det_id',crm_applicant_personal_det_id);
  }
  // validation check
  var valid = false;
  valid = $('#'+file_doc_type).parsley().isValid();
  if(valid) {
    var parsley_required = $('#'+file_doc_type).attr('data-parsley-required','false');
    var url = "<?php echo base_url(); ?>upload-file";
    $.ajax({
      type: 'POST',
      url: url,
      data: formData,
      dataType: 'json',
      cache: false,     
      contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
      processData: false, // NEEDED, DON'T OMIT THIS
      beforeSend: function(xhr,settings) {
                upload_file_loading(file_doc_type);
            },      
      success: function(returndata) {
        console.log(returndata);
        console.log(returndata.data.data);
                upload_file_remove_loading(file_doc_type);
        
        if(file_count != 'false') {
          var db_file_count = returndata.data.file_count;
          var filename_html = '';
          var filename_ids = [];
          $.each(returndata.data.data, function(k, v) {
            var id = v.id;
            var doc_id = v.document_id;
            var file_name_user = v.filename_user;
            var file_name_truncate = v.filename_truncate;
            var file_path = v.path;
            var file_name = v.file_name;
            filename_html += '<span class="file_name  mt-3"><a class="image-popup-vertical-fit" href="<?php echo base_url(); ?>'+file_path+'" target="_blank" title="'+file_name_user+'">'+file_name_truncate+' <i class="fa fa-eye" aria-hidden="true"></i></a></span><a href="javascript:void(0)" data-del-file-id="'+id+'" data-doc-id="'+doc_id+'" data-toggle="modal" data-target="#contentDeletePop" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a><div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_'+doc_id+'"><a href="#" class="close" onclick="hideAlert(\'deleteMessage_'+doc_id+'\')">&times;</a><strong id="deleteMessageStatus_'+doc_id+'"></strong> <span id="deleteMessageSpan_'+doc_id+'"></span></div>';
            filename_ids.push(id);
          });
          $('#'+file_doc_type).parent().find('span.file_name').remove();
          $('#'+file_doc_type).parent().find('[data-del-file-id]').remove();
          $('#'+file_doc_type).parent().find('.alert').remove();
          $('#'+file_doc_type).parent().append(filename_html);
          $('#'+file_doc_type).attr('data-file-count',db_file_count);
          $('#'+file_doc_type).attr('data-file-id',filename_ids.join(','));
        } else {
          v = returndata.data.data;
          var id = v.id;
          var doc_id = v.document_id;
          var file_name_user = v.filename_user;
          var file_name_truncate = v.filename_truncate;
          var file_path = v.path;
          var file_name = v.file_name;
          // Set Regenerated CSRF Dynamically
          var csrfHash = $("input[name='"+csrfName+"']").val(returndata.token);
          $('#'+file_doc_type).parent().find('span.file_name').remove();
          $('#'+file_doc_type).parent().find('[data-del-file-id]').remove();
          $('#'+file_doc_type).parent().find('.alert').remove();
          $('#'+file_doc_type).parent().append('<!-- <span class="file_name  mt-3"><a class="image-popup-vertical-fit" href="<?php echo base_url(); ?>'+file_path+'" target="_blank" title="'+file_name_user+'">'+file_name_truncate+' <i class="fa fa-eye" aria-hidden="true"></i></a></span><a href="javascript:void(0)" data-del-file-id="'+id+'" data-doc-id="'+doc_id+'" data-toggle="modal" data-target="#contentDeletePop" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a>--><div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_'+doc_id+'"><a href="#" class="close" onclick="hideAlert(\'deleteMessage_'+doc_id+'\')">&times;</a><strong id="deleteMessageStatus_'+doc_id+'"></strong> <span id="deleteMessageSpan_'+doc_id+'"></span></div>');
          setTimeout(function() { 
                          upload_file_set_download_delete_options(file_doc_type, file_name, file_path, doc_id, id, parsley_required);
                        }, 100);

          $('#'+file_doc_type).attr('data-file-id',id);
          light_box_init();
        }
      },
      error: function(returndata) {
        console.log(returndata);
      },
    });
  }else {
          $('#'+file_doc_type).parsley().validate();
  }
}
 


    function chk_guardian(val) {      
    	// if($(this).is(':checked')) {
    	if(val) {
			$('#add_guardian_checkbox').val('true');
			$('#guardian_details').show();
      $('#pd_guardian_name').attr('data-parsley-required',"true"); 
      $('#pd_guardian_phone').attr('data-parsley-required',"true");
      $('#pd_guardian_email').attr('data-parsley-required',"true"); 
      $('#pd_guardian_occupation').attr('data-parsley-required',"true"); 
      $("#custom-pd_guardian_occupation-parsley-error").show();
      $("#custom-pd_guardian_phone-parsley-error").show();
      $("#custom-pd_guardian_email-parsley-error").show();
       $("#pd_guardian_phone").attr('data-parsley-mobileonly','true');	
        
		} else {
			$('#add_guardian_checkbox').val('false');
			$('#guardian_details').hide();
      $("#pd_guardian_phone").val('');
      $("#pd_guardian_name").val('');
      $("#pd_guardian_email").val('');
      setTimeout(function(){ select2Set("pd_guardian_occupation",'','');
        }, 1);
      $('#pd_guardian_name').attr('data-parsley-required',"false"); 
      $('#pd_guardian_phone').attr('data-parsley-required',"false");
      $('#pd_guardian_email').attr('data-parsley-required',"false"); 
      $('#pd_guardian_occupation').attr('data-parsley-required',"false"); 
      $("#custom-pd_guardian_occupation-parsley-error").hide();
      $("#custom-pd_guardian_phone-parsley-error").hide();
      $("#custom-pd_guardian_email-parsley-error").hide();

      $("input[name=pd_guardian_email]").parsley().reset();
      $("input[name=pd_guardian_name]").parsley().reset();
      $("select[name=pd_guardian_occupation]").parsley().reset();
      $("input[name=pd_guardian_phone]").parsley().reset();
	   $("#pd_guardian_phone").attr('data-parsley-mobileonly','false');	
		}
    }

    function changeFileName(val) {
        var filename = '';
        switch(val) {
            case comp_exam_ugc_net:
                filename = 'ugc_score_card';
            break;
            case comp_exam_ugc_csir_net:
                filename = 'ugc_score_card';
            break;
            case comp_exam_slet:
                filename = 'slet_score_card';
            break;
            case comp_exam_gate:
                filename = 'gate_score_card';
            break;
            case comp_exam_teacher_fellowship_holder:
                filename = 'net_score_card';
            break;
        }
        $('#score_card').attr('name',filename);
        $('#score_card').attr('id',filename);
        return filename;
    }

    function removeClick(dataThis) {
      var id = $(dataThis).attr('data-del-file-id');
      var doc_id = $(dataThis).attr('data-doc-id');
      var required = $(dataThis).attr('data-required');
      var field = $(dataThis).attr('data-field'); 
      console.log('id => '+id);
          $('#contentDeletePop').on('shown.bs.modal', function (e) {
        $(this).find('#yesbulk_btn').attr('data-del-file-id',id);
        $(this).find('#yesbulk_btn').attr('data-doc-id',doc_id);
        $(this).find('#yesbulk_btn').attr('data-required',required);
       $(this).find('#yesbulk_btn').attr('data-field',field);
  });
}
    function removeAttachedFile(dataThis) {
  var data_del_file_id = $(dataThis).attr('data-del-file-id');
  var doc_id = $(dataThis).attr('data-doc-id');
  var required = $(dataThis).attr('data-required');
  var field = $(dataThis).attr('data-field');
  // Get Regenerated CSRF Dynamically
  var csrfHashRegenerate = $("input[name='"+csrfName+"']").val();
  var url = "<?php echo base_url(); ?>del-uploaded-file";
  var AjaxRequest = $.ajax({
    type: 'POST',
    url: url,
    data: 'data_del_file_id='+data_del_file_id+'&doc_id='+doc_id+'&logged_applicant_id='+logged_applicant_id+'&logged_applicant_login_id='+logged_applicant_login_id+'&app_form_id='+app_form_id+'&'+csrfName+'='+csrfHashRegenerate+url_edit,
    dataType: 'json',
    cache: false,   
    success: function(returndata) {
      var json = returndata;
      $('#contentDeletePop').find('.close').trigger('click');
      //if(doc_id == document_id_tentative_topic) {
        var divId = 'deleteMessage_'+doc_id+data_del_file_id;
        var strongId = 'deleteMessageStatus_'+doc_id+data_del_file_id;
        var spanId = 'deleteMessageSpan_'+doc_id+data_del_file_id;
      //} else {
        var divId = 'deleteMessage_'+doc_id;
        var strongId = 'deleteMessageStatus_'+doc_id;
        var spanId = 'deleteMessageSpan_'+doc_id;   
      //}
      $('#' + divId).parent().find('[data-del-file-id="'+data_del_file_id+'"]').prev('span.file_name').remove();
      $('#' + divId).parent().find('[data-del-file-id="'+data_del_file_id+'"]').remove();
      
      
      $('#' + divId).show('slow');
      if (json) {
        // var arrJson = JSON.parse(json);
        var msg = json.message;
        // Set Regenerated CSRF Dynamically
        var csrfHash = $("input[name='"+csrfName+"']").val(json.token);
        if (json.status == true || json.status == 'true') {
          $('#' + divId).addClass('alert-success');
          $('#' + divId).removeClass('alert-danger');
          // $('#' + strongId).text('<?php echo $this->lang->line ( 'success' );?>');
        } else {
          $('#' + divId).addClass('alert-danger');
          $('#' + divId).removeClass('alert-success');
          // $('#' + strongId).text('<?php echo $this->lang->line ( 'error' );?>');
        }
                $('#'+field).attr('data-parsley-required',required);
        $('#'+field).parsley().validate();
        $('#'+field).removeClass('parsley-success');        
        $('#' + spanId).text(msg);
        upload_file_unset_download_delete_options(field);
        setTimeout(function () {
          $('#' + divId).hide('slow');
        //     window.location.reload();
        }, 2000);
        // $('.loading').fadeOut("slow");
      }
    },
    error: function(returndata) {
      console.log(returndata); 
    },
  });                 

  return AjaxRequest; 
}


function remove_guardainvaidationmsg(id,error_id)
{
  setTimeout(function(){
                  $('#'+id).toggleClass('parsley-error');
                  $('#'+error_id).hide();
                }, 5000);
}

function wizard_final_step(url,currentIndex, redirect) {
        var photograph = $('#photograph').parsley();
        var signature = $('#signature').parsley();
        var graduation_marksheet = $('#graduation_marksheet').parsley();
        if(photograph.isValid() && signature.isValid() && graduation_marksheet.isValid()) {
          // Get Regenerated CSRF Dynamically
        var csrfHashRegenerateonDec = $("input[name='"+csrfName+"']").val();
          var moveNxt=0;
          $.ajax({
                type: 'POST',
                url: url,
                data: 'currentIndex='+currentIndex+'&'+csrfName+'='+csrfHashRegenerateonDec,
                dataType: 'json',
                cache: false,
                beforeSend: function() { $('.loader').show(); },
                success: function(returndata) {
                  console.log(returndata);
          if(returndata) {                  
            console.log(returndata);
            $("#formerr").hide();
             moveNxt=1;  
            setTimeout(function() { window.location.href = redirect_thank+url_edit; }, 100);
          }
                },
                error: function(returndata) {
                  console.log(returndata); 
                  moveNxt=0;
                  console.log(returndata);
                  $("#formerr").show();                 
                  return false;
                },
            }); 
            if(moveNxt){
              return true;
            }      
        } else {
          photograph.validate();
          signature.validate();
          graduation_marksheet.validate();
          //additional_qualification.validate();
            return false;
        }
    }

</script>