<?php
$app_form_id_mtech = APP_FORM_ID_MTECH_RESEARCH_JAN;
$const_grad_id = MTECH_RESEARCH_GRADUATION_ID;
$const_deg_id = MTECH_RESEARCH_DEGREE_ID;

$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_graduation_marksheet = DOCUMENT_ID_GRADUATION_MARKSHEET;
$form_wizard_payment_id = FORM_WIZARD_PAYMENT_ID;

$is_work_experience = $applicant_other_details_list['is_work_experience'];
if($is_work_experience == 't') {
    $is_work_experience_select = 'yes';
    $is_work_experience_select_name = 'Yes';
} else {
    $is_work_experience_select = 'no';
    $is_work_experience_select_name = 'No';
}

$add_gardian = $applicant_other_details_list['add_gardian'];

$applicant_publn_det_id = $applicant_publn_det_title = $applicant_publn_det_journal_conf_name = $applicant_publn_det_year = $applicant_prof_exp_id = $applicant_prof_exp_org_name = $applicant_prof_exp_designation = $applicant_prof_exp_job_nature = $applicant_prof_exp_salary = $applicant_prof_exp_from_date = $applicant_prof_exp_to_date = $applicant_prof_exp_work_exp_in_months = $applicant_grad_det_id = $applicant_grad_det_other_degree_name = $applicant_grad_det_univ_id = $applicant_grad_det_univ_name = $applicant_grad_det_mark_scheme_id = $applicant_grad_det_mark_percent = $applicant_grad_det_completion_year = $applicant_grad_det_reg_no = $applicant_grad_det_mode_of_study_id = $applicant_grad_det_mode_of_study_name = array();

if($applicant_graduations_list) {
   foreach($applicant_graduations_list as $k=>$v) {
      $is_curr_qualify = $v['is_curr_qualify'];
      if($is_curr_qualify != 't') {
         $applicant_grad_det_id[] = $v['applicant_grad_det_id'];
         // $applicant_grad_det_other_degree_name[] = $v['other_degree_name'];
         $applicant_grad_det_other_degree_name[] = $v['other_deg_name'];
         $applicant_grad_det_univ_id[] = $v['univ_id'];                             
         $applicant_grad_det_univ_name[] = $v['univ_name'];
         $applicant_grad_det_mark_scheme_id[] = $v['mark_scheme_id'];
         $applicant_grad_det_mark_scheme_name[] = $v['mark_scheme_name'];
         //$applicant_grad_det_mark_percent[] = $v['mark_percent'];
         $applicant_grad_det_mark_percent[] = $v['mark_percentage'];
         //$applicant_grad_det_completion_year[] = $v['completion_year'];
         $applicant_grad_det_completion_year[] = $v['yr_of_pass']; 
         //$applicant_grad_det_insti_name[] = $v['insti_name'];
         $applicant_grad_det_reg_no[] = $v['reg_no']; 
         $applicant_grad_det_mode_of_study_id[] = $v['mode_of_study_id'];
         $applicant_grad_det_mode_of_study_name[] = $v['mode_of_study'];
         
         
           
      }
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
      if($app_form_id_mtech == $appln_form_id) {
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


if($applicant_course_prefer_details_list) {
   foreach($applicant_course_prefer_details_list as $k=>$v) {
      $applicant_course_id[] = $v['applicant_course_id'];
      $applicant_course_course_id[] = $v['course_id'];
      $applicant_course_course_name[] = $v['course_name'];
      $applicant_course_choice_no[] = $v['choice_no'];
      $applicant_course_is_active[] = $v['is_active'];
      $applicant_course_spec_id[] = $v['splpref_id'];
      $applicant_course_spec_name[] = $v['spec_name'];
   }
}

if($applicant_campus_prefer_details_list) {
   foreach($applicant_campus_prefer_details_list as $k=>$v) {
      $applicant_campus_prefer_id[] = $v['applicant_campus_prefer_id'];
      $applicant_campus_campus_id[] = $v['campus_id'];
      $applicant_campus_campus_name[] = $v['campus_name'];
      $applicant_campus_choice_no[] = $v['choice_no'];
      $applicant_campus_is_active[] = $v['is_active'];
   }
}


$docs = $upload_scripts = array();
$file_count = 0;
if($upload_filelist) {
  foreach($upload_filelist as $doc){
  		$document_id = $doc['document_id'];
  		$id = $doc['id'];
  		$file_name = $doc['name'];
  		$file_path = $doc['path'];
  		$file_name_user = remove_file_separator($file_name);
  		$file_name_truncate = remove_file_separator($file_name, true);
  		$file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_graduation_marksheet == $document_id)?'graduation_marksheet':'')));
  		$parsley_required = (($document_id_photograph == $document_id)?'true':(($document_id_signature == $document_id)?'true':''));;
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
        $upload_scripts[] = 'upload_file_set_download_delete_options("'.$file_doc_type.'", "'.$file_name.'", "'.$file_path.'", "'.$document_id.'", "'.$id.'", "'.$parsley_required.'", "'.$mode_edit.'")';
     }
  }
}
$docs['file_count'] = $file_count;

// echo '<pre>';
// print_r($upload_scripts);
// echo '</pre>';
$payment_mode_id = $payment_details_list['payment_mode_id'];
$startIndex = $this->input->get('startIndex',true);
//restrict previous section
$is_allow_previous=$this->config->item('is_allow_previous');

/*if($current_wizard){
    if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0)) {
       if(isset($startIndex) && $startIndex >= 5){
            $startIndex=$startIndex;
        }else{
            $startIndex=5;
        }
    }
}*/

/*Form Index Restriction Start*/
$start_wizard = 0;
$start_wizard_next = -1;
$next_step_allowed = '';
$start_wizard_next_allow='';
$appln_form_w_wizard_id = $applicant_appln_details_list[0]['form_w_wizard_id'];
$count_wizard_dt = count($wizard_dt) - 1;
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
else if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) && ($startIndex == 5 || $startIndex == 6)) {
        $startIndex=$startIndex; //upload
}
else if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0)) {
        $startIndex=$count_wizard_dt; //upload
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
	 var url = "<?php echo base_url(); ?>mtechresearch-jan";
	 var app_form_id = '<?php echo $app_form_id_mtech; ?>';
	 var tmp_app_form_id='<?php echo APP_FORM_ID_MTECH_RESEARCH; ?>';
	 var const_grad_id = '<?php echo $const_grad_id; ?>';
	 var const_deg_id = '<?php echo $const_deg_id; ?>';
	 var redirect_thank = '<?php echo base_url()."thank_you"; ?>?app_form_id='+app_form_id;	
	 var part_time_external = '<?php echo PART_TIME_EXTERNAL; ?>';
	 var country_value_default = '<?php echo COUNTRY_VALUE_DEFAULT; ?>';
	 var logged_applicant_id = '<?php echo $logged_applicant_id; ?>';
    var logged_applicant_login_id = '<?php echo $logged_applicant_login_id; ?>';
    var otheroccupation='<?php echo OTHER_OCCUPATION;?>';
    var comp_exam_ugc_net = '<?php echo COMP_EXAM_UGC_NET; ?>';
    var comp_exam_ugc_csir_net = '<?php echo COMP_EXAM_UGC_CSIR_NET; ?>';
    var comp_exam_slet = '<?php echo COMP_EXAM_SLET; ?>';
    var comp_exam_gate = '<?php echo COMP_EXAM_GATE; ?>';
    var comp_exam_teacher_fellowship_holder = '<?php echo COMP_EXAM_TEACHER_FELLOWSHIP_HOLDER; ?>';
    var document_id_tentative_topic = '<?php echo DOCUMENT_ID_TENTATIVE_TOPIC; ?>';
    var db_title_id = '<?php echo $applicant_basic_details_list['tittle_id'];?>';
    var db_title_name = '<?php echo $applicant_basic_details_list['tittle_name'];?>';
    var db_social_status_id ='<?php echo $applicant_basic_details_list['social_status_id'];?>';
    var db_social_status_name ='<?php echo $applicant_basic_details_list['social_status'];?>';
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
    //var db_country_id='<?php echo $applicant_address_details_list['country_id'];?>';
    //var db_country_name='<?php echo $applicant_address_details_list['country_name'];?>';
    //var db_state_id='<?php echo $applicant_address_details_list['state_id'];?>';
    //var db_state_name='<?php echo $applicant_address_details_list['state_name'];?>';
    //var db_district_id='<?php echo $applicant_address_details_list['district_id'];?>';
    //var db_district_name='<?php echo $applicant_address_details_list['district_name'];?>';
    //var db_city_id ='<?php echo $applicant_address_details_list['city_id'];?>';
    //var db_city_name='<?php echo $applicant_address_details_list['city_name'];?>';
    var db_mode_study_id='<?php echo $applicant_address_details_list['city_name'];?>';
    var db_mode_study_name='<?php echo $applicant_address_details_list['city_name'];?>';
    var payment_wizard_id = '<?php echo $form_wizard_payment_id; ?>';

    /*CRM ADMIN Edit form start*/
    var crm_applicant_personal_det_id = '<?php echo $crm_applicant_personal_det_id ; ?>';
    var crm_applicant_login_id = '<?php echo $crm_applicant_login_id ; ?>';
    var mode_edit_val = '<?php echo ADMIN_MODE_EDIT ; ?>';
    var mode_edit_url = '<?php echo $mode_edit; ?>';
    <?php if($mode_edit) { ?>
      var url_edit = '&mode=edit'+'&applicant_personal_det_id='+crm_applicant_personal_det_id+'&applicant_login_id='+crm_applicant_login_id;
      var url = "<?php echo base_url(); ?>mtechresearch-jan/"+mode_edit_val+"/"+crm_applicant_login_id+"/"+crm_applicant_personal_det_id;
      var payment_url = '<?php echo base_url(); ?>user/payment_details?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;
      var save_exit_redirect_url = '<?php echo base_url(); ?>crm-admin/dashboard';
      //var upload_url = '<?php echo base_url(); ?>upload-file?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;     
    <?php } else { ?>
      var url_edit =  '';
      var url = "<?php echo base_url(); ?>mtechresearch-jan";
      var payment_url = '<?php echo base_url(); ?>user/payment_details';
       var save_exit_redirect_url = '<?php echo base_url(); ?>';
       //var upload_url = "<?php echo base_url(); ?>upload-file";
    <?php } ?>
    /*CRM ADMIN Edit form end*/
    
  	var get_percentage_url = '<?php echo base_url(); ?>user/get_percentage_w_tab?app_form_id='+app_form_id+url_edit;
	var redirect_payment_thank_you = '<?php echo base_url(); ?>user/payment_thank_you?app_form_id='+app_form_id+'&wizard_id='+payment_wizard_id+'&url='+encodeURIComponent(url);
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
    		enable_saveExit_btn('<?php echo $startIndex;?>',4);
    	 },1);
         <?php
       // on load preview button
      if($startIndex) {
      ?>
      setTimeout(function() { 
        if(parseInt(total_wizard_Step-1) == <?php echo $startIndex; ?>) {
        	$("#save_exit").remove();
        	//enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>mtechresearch-jan-preview');
           if(mode_edit_url != '')
          {
            enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>mtechresearch-jan-preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
          }else{
            enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>mtechresearch-jan-preview');
          }
        }
		var curIndex='<?php echo $startIndex;?>';
		if(curIndex==3){
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
        enableContentCache: false,
        enableCancelButton: false,
        enableFinishButton: true,
        preloadContent: true,
        showFinishButtonAlways: false,
        forceMoveForward: false,
        saveState: true,
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
          var graduation_india_val = $('#graduation_india').val();
				  // var is_employed = $('#is_employed').parsley();
				  // var working_place = $('#working_place').parsley();				 
				  if(graduation_india.isValid() && qualifyingexamfromindia.isValid() && (graduation_india_val=="yes" || graduation_india_val=="t")) {
					var qualifyingexamfromindia_val = $('#qualifyingexamfromindia').val();
          var appln_status = $('#appln_status').val();
          var isexit = ($(this).attr('isexit'));
					var user_data = 'qualifyingexamfromindia='+qualifyingexamfromindia_val+'&graduation_india='+graduation_india_val+'&'+csrfName+'='+csrfHash+'&appln_status='+appln_status;
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
                                  return false;
                            }else{
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
						      moveNxt=0;
                  $("#formerr").show();  
                  $('.loader').hide();               
                  return false;
						},
					});						
					if(moveNxt){
              return true;
            }
				  } else {
					graduation_india.validate();
					qualifyingexamfromindia.validate();
          $(this).attr('isexit','');
					return false;
				  }
				}
				
				
				
				// Step 2 form validation
				if(currentIndex === 1) {
                  //return true;
                  var campus_preference1= $('#campus_preference1').parsley();
                  var specialization_preference1= $('#specialization_preference1').parsley();                  
				  var title_id = $('#title_id').parsley();
				  var first_name = $('#first_name').parsley();
				  var last_name = $('#last_name').parsley();				  
				  var mtech_mobile_no = $('#mtech_mobile_no').parsley();
				  var dob =$('#dob').parsley();
				  var gender_id=$('#gender_id').parsley();
				  var religion_id=$('#religion_id').parsley();
				  var medofinst=$('#medofinst').parsley();
				  var diff_abled=$('#diff_abled').parsley();
				  var nationality_id = $('#nationality_id').parsley();
				  var pd_social_status = $('#pd_social_status').parsley();
          var second_email_id = $("#second_email_id").parsley();
          var middle_name = $("#middle_name").parsley();
				  
				  
				  
				  if(campus_preference1.isValid() && specialization_preference1.isValid() && title_id.isValid() && first_name.isValid() && last_name.isValid() && mtech_mobile_no.isValid() && dob.isValid() && gender_id.isValid() && religion_id.isValid() && medofinst.isValid() && diff_abled.isValid() && nationality_id.isValid() && pd_social_status.isValid() &&second_email_id.isValid() && middle_name.isValid()) {
				  	var campus_preference1_val=$('#campus_preference1').val();
				  	var specialization_preference1_val = $('#specialization_preference1').val();
				  	var campus_preference2_val =$('#campus_preference2').val();
				  	var specialization_preference2_val = $('#specialization_preference2').val();
				  	var campus_preference3_val =$('#campus_preference3').val();
				  	var specialization_preference3_val = $('#specialization_preference3').val();
					var title_id_val = $('#title_id').val();
					var first_name_val = $('#first_name').val();
					var middle_name_val=$('#middle_name').val();
					var last_name_val = $('#last_name').val();
					var email_id_val = $('#email_id').val();
					var dob_val = $('#dob').val();
					var gender_id_val = $('#gender_id').val();
					var second_email_id_val = $('#second_email_id').val();
					var blood_grp_id_val =$('#blood_grp_id').val();
					var religion_id_val =$('#religion_id').val();
					var mothertongue_id_val =$('#mothertongue_id').val();
					var medofinst_val =$('#medofinst').val();
					var prefer_hostel_val = $('#prefer_hostel').val();
					var diff_abled_val= $('#diff_abled').val();
					var advertisement_source_id_val = $('#advertisement_source_id').val();
					var nationality_id_val = $('#nationality_id').val();
					var campus_choice_no_1_val = $('#campus_choice_no_1').val();
					var campus_prefer_id_1_val = $('#campus_prefer_id_1').val();
					var specialization_choice_no_1_val = $('#specialization_choice_no_1').val();
					var specialization_prefer_id_1_val = $('#specialization_prefer_id_1').val();
					var campus_choice_no_2_val = $('#campus_choice_no_2').val();
					var campus_prefer_id_2_val = $('#campus_prefer_id_2').val();
					var specialization_choice_no_2_val = $('#specialization_choice_no_2').val();
					var specialization_prefer_id_2_val = $('#specialization_prefer_id_2').val();
					var campus_choice_no_3_val = $('#campus_choice_no_3').val();
					var campus_prefer_id_3_val = $('#campus_prefer_id_3').val();
					var specialization_choice_no_3_val = $('#specialization_choice_no_3').val();
					var specialization_prefer_id_3_val = $('#specialization_prefer_id_3').val();
					var mtech_mobile_no_val = $('#mtech_mobile_no').val();
					var phone_no_code_val=$('#phone_no_code').val();
					var pd_social_status_val=$('#pd_social_status').val();
          var isexit = ($(this).attr('isexit'));

					
					var user_data = 'campus_preference1='+campus_preference1_val+'&specialization_preference1='+specialization_preference1_val+'&campus_preference2='+campus_preference2_val+'&specialization_preference2='+specialization_preference2_val+'&campus_preference3='+campus_preference3_val+'&specialization_preference3='+specialization_preference3_val+'&title_id='+title_id_val+'&first_name='+first_name_val+'&last_name='+last_name_val+'&middle_name='+middle_name_val+'&email_id='+email_id_val+'&dob_mtech='+dob_val+'&gender_id='+gender_id_val+'&second_email_id='+second_email_id_val+'&blood_grp_id='+blood_grp_id_val+'&religion_id='+religion_id_val+'&mothertongue_id='+mothertongue_id_val+'&medofinst='+medofinst_val+'&prefer_hostel='+prefer_hostel_val+'&diff_abled='+diff_abled_val+'&advertisement_source_id='+advertisement_source_id_val+'&nationality_id='+nationality_id_val+'&campus_choice_no_1='+campus_choice_no_1_val+'&campus_prefer_id_1='+campus_prefer_id_1_val+'&specialization_choice_no_1='+specialization_choice_no_1_val+'&specialization_prefer_id_1='+specialization_prefer_id_1_val+'&campus_choice_no_2='+campus_choice_no_2_val+'&campus_prefer_id_2='+campus_prefer_id_2_val+'&specialization_choice_no_2='+specialization_choice_no_2_val+'&specialization_prefer_id_2='+specialization_prefer_id_2_val+'&campus_choice_no_3='+campus_choice_no_3_val+'&campus_prefer_id_3='+campus_prefer_id_3_val+'&specialization_choice_no_3='+specialization_choice_no_3_val+'&specialization_prefer_id_3='+specialization_prefer_id_3_val+'&mtech_mobile_no='+mtech_mobile_no_val+'&phone_no_code='+phone_no_code_val+'&pd_social_status='+pd_social_status_val+'&'+csrfName+'='+csrfHash;
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
								if(returndata.status == 'true' || returndata.status == true ) { 
                  if(isexit==1){
                                  window.location.href = save_exit_redirect_url;
                                  return false;
                            }else{
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
						      moveNxt=0;
                  $("#formerr").show(); 
                  $('.loader').hide();                
                  return false;  
						},
					});						  
					if(moveNxt){
              return true;
            }
				  } else { 
				  	specialization_preference1.validate();
				  	campus_preference1.validate();
					title_id.validate();
					first_name.validate();
					last_name.validate();
					mtech_mobile_no.validate();
					dob.validate();
					gender_id.validate();
					religion_id.validate();
					gender_id.validate();
					medofinst.validate();
					diff_abled.validate();
					nationality_id.validate();
					pd_social_status.validate();
          second_email_id.validate();
          middle_name.validate();
          $(this).attr('isexit','');
					// pd_nature_deformity.validate();
					// pd_percent_of_deformity.validate();
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
            var pd_guardian_occupation = $('#pd_guardian_occupation').parsley();
            var pd_father_other_occupation = $('#pd_father_other_occupation').parsley();
            var pd_mother_other_occupation = $('#pd_mother_other_occupation').parsley();
            var guardian_other_occupation = $('#guardian_other_occupation').parsley();
						

						var country = $('#country').parsley();
						var state = $('#state').parsley();
						var district = $('#district').parsley();
						var city = $('#city').parsley();
						var address1 = $('#address_line1').parsley();
						var pincode = $('#pincode').parsley();

          check_visible_input_validation('guardian_details','pd_guardian_name','<?php echo REQD_GUARDIAN_NAME_MSG; ?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');
          
          check_visible_input_validation('guardian_details','pd_guardian_phone','<?php echo REQD_GUARDIAN_MOBILE_MSG; ?>',false);
          
          check_visible_input_validation('guardian_details','pd_guardian_email','<?php echo REQD_GUARDIAN_EMAIL_MSG; ?>',false);
          
          check_visible_input_validation('guardian_details','pd_guardian_occupation','<?php echo REQD_GUARDIAN_OCCUPATION_MSG; ?>',false);
          
          check_visible_input_validation('father_other_occupation_div','pd_father_other_occupation','<?php echo REQD_FATHER_OTHER_OCCUPATION_MSG; ?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');

            check_visible_input_validation('mother_other_occupation_div','pd_mother_other_occupation','<?php echo REQD_MOTHER_OTHER_OCCUPATION_MSG; ?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');

            check_visible_input_validation('guardian_other_occupation_div','guardian_other_occupation','<?php echo REQD_GUARDIAN_OTHER_OCCUPATION_MSG; ?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');

          check_visible_input_validation('main_div_state','state','<?php echo REQD_STATE_MSG; ?>',false);
          
          check_visible_input_validation('main_div_district','district','<?php echo REQD_DISTRICT_MSG; ?>',false);
          
          check_visible_input_validation('main_div_city','city','<?php echo REQD_CITY_MSG; ?>',false);
					  
					  	if(pd_father_title.isValid() && pd_father_name.isValid() && pd_mother_title.isValid() && pd_mother_name.isValid() && pd_father_email.isValid() && pd_mother_email.isValid() && pd_guardian_name.isValid() && pd_guardian_phone.isValid() && pd_father_phone.isValid() && pd_mother_phone.isValid() && country.isValid() && state.isValid() && district.isValid() && city.isValid() && address1.isValid() && pincode.isValid() && pd_guardian_occupation.isValid() && pd_father_other_occupation.isValid() && pd_mother_other_occupation.isValid() && guardian_other_occupation.isValid()) {

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
					  	var country_id 	= 	$('#country').val();
					  	var state_id 	= 	$('#state').val();
					  	var district_id = 	$('#district').val();
					  	var city_id     = 	$('#city').val();
					  	var address1    =  	$('#address_line1').val();
					  	var address2    =  	$('#address_line2').val();
					  	var pincode 	=	$('#pincode').val();
					  	var pd_father_id = $('#pd_father_id').val();
					  	var pd_mother_id = $('#pd_mother_id').val();
					  	var pd_guardian_id = $('#pd_guardian_id').val();
              var father_other_occupation_val='';
              var mother_other_occupation_val='';
              var guardian_other_occupation_val='';
              father_other_occupation_val=$('#pd_father_other_occupation').val();
              mother_other_occupation_val=$('#pd_mother_other_occupation').val();
              guardian_other_occupation_val=$('#guardian_other_occupation').val();
			  
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
							}, 3000);							
							return false;
						}	
					}		  
			     
                var isexit = ($(this).attr('isexit'));
						  	var userData = 'pd_father_title='+pd_father_title+'&pd_father_name='+pd_father_name+'&pd_father_phone_no_code='+pd_father_phone_no_code+'&pd_father_phone='+pd_father_phone+'&pd_father_email='+pd_father_email+'&pd_father_occupation='+pd_father_occupation+'&pd_mother_title='+pd_mother_title+'&pd_mother_name='+pd_mother_name+'&pd_mother_phone_no_code='+pd_mother_phone_no_code+'&pd_mother_email='+pd_mother_email+'&pd_mother_occupation='+pd_mother_occupation+'&add_guardian_checkbox='+add_guardian_checkbox+'&pd_guardian_name='+pd_guardian_name+'&pd_guardian_phone_no_code='+pd_guardian_phone_no_code+'&pd_guardian_phone='+pd_guardian_phone+'&pd_guardian_occupation='+pd_guardian_occupation+'&pd_mother_phone='+pd_mother_phone+'&country_id='+country_id+'&state_id='+state_id+'&district_id='+district_id+'&city_id='+city_id+'&address_line_1='+address1+'&address_line_2='+address2+'&pincode='+pincode+'&pd_father_id='+pd_father_id+'&pd_mother_id='+pd_mother_id+'&pd_guardian_id='+pd_guardian_id+'&father_other_occupation='+father_other_occupation_val+'&mother_other_occupation='+mother_other_occupation_val+'&guardian_other_occupation='+guardian_other_occupation_val+'&'+csrfName+'='+csrfHash;
                var moveNxt=0;
						  	$.ajax({
								type: 'POST',
								url: url,
								data: userData+'&currentIndex='+currentIndex,
								dataType: 'json',
								cache: false,
								beforeSend: function() { $('.loader').show(); },
								success: function(returndata) {
									if(returndata) {									
										console.log(returndata);
                    var status_address = returndata.address_response.status;
                  var status_parents = returndata.parent_response.other_res.status;
                  if(status_parents == 'true' || status_address == 'true') {
                      if(isexit==1){
                        window.location.href = save_exit_redirect_url;
                        return false; } else {
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
                  $("#formerr").show();
                  $('.loader').hide();                 
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
						country.validate();
						state.validate();
						district.validate();
						city.validate();
						address1.validate();
						pincode.validate();
            pd_guardian_occupation.validate();
            pd_father_other_occupation.validate();
            pd_mother_other_occupation.validate();
            guardian_other_occupation.validate();
             $(this).attr('isexit','');
						return false;
					  }
					}

                if(currentIndex === 3) {
                    // return true;
					//return true;
                    // var valid = $(this).parsley().validate();
                    var name_as_in_marksheet = $('#name_as_in_marksheet').parsley();
                    var institute_name = $('#institute_name').parsley();
                    var university_id = $('#university_id').parsley();
                    var mode_of_study = $('#mode_of_study').parsley();
                    // if($('#competitive_exam').val()) {
                    //     var score_card_filename = changeFileName($('#competitive_exam').val());
                    //     score_card = $('#'+score_card_filename).parsley();
                    // }
                    

                    var user_marking_scheme_1 = $('#user_marking_scheme_1').parsley();
                    var obtained_percentage_cgpa_1 = $('#obtained_percentage_cgpa_1').parsley();
                    var year_of_passing_1 = $('#year_of_passing_1').parsley();
                    var register_no = $('#register_no').parsley();
                    var board_research = $('#board_research').parsley();
                    var name_proposed = $('#name_proposed').parsley();

                    var is_work_experience = $('#is_work_experience').parsley();

                    var organisation_name_0 = $('#organisation_name_0').parsley();
                    var designation_0 = $('#designation_0').parsley();
                    var from_year_0 = $('#from_year_0').parsley();
                    var to_year_0 = $('#to_year_0').parsley();
                    var work_experience_0 = $('#work_experience_0').parsley();
					var work_experience_1 = $('#work_experience_1').parsley();
					var work_experience_2 = $('#work_experience_2').parsley();
                    var digilocker_id = $('#digilocker_id').parsley();
					
					var organisation_name_1 = $('#organisation_name_1').parsley();
					var designation_1 = $('#designation_1').parsley();
					var from_year_1 = $('#from_year_1').parsley();
					var to_year_1 = $('#to_year_1').parsley();

					var organisation_name_2 = $('#organisation_name_2').parsley();
					var designation_2 = $('#designation_2').parsley();
					var from_year_2 = $('#from_year_2').parsley();
					var to_year_2 = $('#to_year_2').parsley();		
					
                    var is_work_experience_checked = false;
	                if($('#is_work_experience').val() == 'yes') {
	                    if(organisation_name_0.isValid() && designation_0.isValid() && from_year_0.isValid() && to_year_0.isValid() && work_experience_0.isValid()) {
	                        is_work_experience_checked = true;    
	                    }
	                } else {
	                    is_work_experience_checked = true;
	                }
                    if(is_work_experience_checked == true && name_as_in_marksheet.isValid() && institute_name.isValid() && university_id.isValid() && mode_of_study.isValid() && user_marking_scheme_1.isValid() && obtained_percentage_cgpa_1.isValid() && year_of_passing_1.isValid() && board_research.isValid() 
                      && register_no.isValid() && digilocker_id.isValid() && name_proposed.isValid() && organisation_name_1.isValid() && designation_1.isValid() && from_year_1.isValid() && to_year_1.isValid() && work_experience_1.isValid() && organisation_name_2.isValid() && designation_2.isValid() && from_year_2.isValid() && to_year_2.isValid() && work_experience_2.isValid()) {
                    	var name_as_in_marksheet = $("#name_as_in_marksheet").val();
                    	var institute_name = $("#institute_name").val();
                    	var university_id = $("#university_id").val();
                    	var mode_of_study = $("#mode_of_study").val();
                    	var user_marking_scheme_1 = $("#user_marking_scheme_1").val();
                    	var obtained_percentage_cgpa_1 = $("#obtained_percentage_cgpa_1").val();
                    	var year_of_passing_1 = $("#year_of_passing_1").val();
                    	var is_work_experience_yes = $("#is_work_experience").val();
                    	var digilocker_id_val = $("#digilocker_id").val();
                    	var organisation_name_0 = $("#organisation_name_0").val();
                    	var designation_0 = $("#designation_0").val();
                    	var from_year_0 = $("#from_year_0").val();
                    	var to_year_0 = $("#to_year_0").val();
                    	var work_experience_0 = $("#work_experience_0").val();
                    	var organisation_name_1 = $("#organisation_name_1").val();
                    	var designation_1 = $("#designation_1").val();
                    	var from_year_1 = $("#from_year_1").val();                    	
                    	var to_year_1 = $("#to_year_1").val();
                    	var work_experience_1 = $("#work_experience_1").val();
                    	var organisation_name_2 = $("#organisation_name_2").val();
                    	var designation_2 = $("#designation_2").val();
                    	var from_year_2 = $("#from_year_2").val();

                    	var to_year_2 = $("#to_year_2").val();
                    	var work_experience_2 = $("#work_experience_2").val();                    	
                    	var name_proposed = $("#name_proposed").val();
                    	var board_research_val = $("#board_research").val();
                    	var total_work_experience = $("#total_work_experience").val();
                    	var prof_exp_id_0 = $("#prof_exp_id_0").val();
                    	var prof_exp_id_1 = $("#prof_exp_id_1").val();
                    	var prof_exp_id_2 = $("#prof_exp_id_2").val();
                    	var register_no = $("#register_no").val();
                      var grad_id_1 = $("#grad_id_1").val();
                      var coord_det_id= $("#coord_det_id").val();
                      var isexit = ($(this).attr('isexit'));
                        //return true;   
                        var user_data = 'name_as_in_marksheet='+name_as_in_marksheet+'&institute_name='+institute_name+'&university_id='+university_id+'&mode_of_study='+mode_of_study+'&user_marking_scheme_1='+user_marking_scheme_1+'&obtained_percentage_cgpa_1='+obtained_percentage_cgpa_1+'&year_of_passing_1='+year_of_passing_1+'&register_no='+register_no+'&is_work_experience_checked='+is_work_experience_yes+'&digilocker_id='+digilocker_id_val+'&organisation_name_0='+organisation_name_0+'&designation_0='+designation_0+'&from_year_0='+from_year_0+'&to_year_0='+to_year_0+'&work_experience_0='+work_experience_0+'&organisation_name_1='+organisation_name_1+'&designation_1='+designation_1+'&from_year_1='+from_year_1+'&to_year_1='+to_year_1+'&work_experience_1='+work_experience_1+'&organisation_name_2='+organisation_name_2+'&designation_2='+designation_2+'&from_year_2='+from_year_2+'&to_year_2='+to_year_2+'&work_experience_2='+work_experience_2+'&total_work_experience='+total_work_experience+'&board_research='+board_research_val+'&name_proposed='+name_proposed+'&prof_exp_id_0='+prof_exp_id_0+'&prof_exp_id_1='+prof_exp_id_1+'&prof_exp_id_2='+prof_exp_id_2+'&applicant_grad_det_id='+grad_id_1+'&applicant_coord_det_id='+coord_det_id+'&'+csrfName+'='+csrfHash;
                        var moveNxt=0;
						$.ajax({
							type: 'POST',
							url: url,
							data: user_data+'&currentIndex='+currentIndex,
							dataType: 'json',
							cache: false,
							beforeSend: function() { $('.loader').show(); },
							success: function(returndata) {
							  console.log(returndata);
								if(returndata) {									
									console.log(returndata);
                  if(isexit==1){
                                  window.location.href = save_exit_redirect_url;
                                  return false;
                            }
                  else {
									var startIndex = currentIndex+1
								window.location.href = url+'?startIndex='+startIndex;
                  $("#formerr").hide();
                  moveNxt=1;  
                }
								}
							},
							error: function(returndata) {
							  moveNxt=0;
                console.log(returndata);
                $("#formerr").show();  
                $('.loader').hide();               
                return false;
							},
						});
						if(moveNxt){
            return true;
          } 
                    } else {
                    	name_as_in_marksheet.validate();
	                  	institute_name.validate();
	                  	university_id.validate();
	                  	register_no.validate();
	                  	mode_of_study.validate();
	                  	year_of_passing_1.validate();
	                  	user_marking_scheme_1.validate();
	                  	obtained_percentage_cgpa_1.validate();
	                  	organisation_name_0.validate();
	                  	designation_0.validate();
	                    from_year_0.validate();
	                  	to_year_0.validate();
	                  	work_experience_0.validate();
						organisation_name_1.validate();
						designation_1.validate();
						from_year_1.validate();
						to_year_1.validate();
						work_experience_1.validate();
						organisation_name_2.validate();
						designation_2.validate();
						from_year_2.validate();
						to_year_2.validate();
						work_experience_2.validate();						
	                  	is_work_experience.validate();
	                  	board_research.validate();
	                  	name_proposed.validate();
                        digilocker_id.validate();
                        $(this).attr('isexit','');
                        return false;
                    }
                }				
				 

                if(currentIndex === 4) {

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
						var user_data = 'bank_name='+bank_name+'&branch_name='+branch_name+'&dd_cheque_no='+dd_cheque_no+'&dd_cheque_date='+dd_cheque_date+'&payment_mode='+payment_mode+'&app_form_id='+form_id+'&'+csrfName+'='+csrfHash;
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

                if(currentIndex === 5) {
                    var photograph = $('#photograph').parsley();
                    var signature = $('#signature').parsley();
                    var graduation_marksheet = $('#graduation_marksheet').parsley();
                    if(photograph.isValid() && signature.isValid() && graduation_marksheet.isValid()) {
						        var csrfHashRegenerateonDec = $("input[name='"+csrfName+"']").val();
                    var isexit = ($(this).attr('isexit'));
                    var moveNxt=0;   
                    $.ajax({
                type: 'POST',
                url: url,
                data: 'currentIndex='+currentIndex+'&'+csrfName+'='+csrfHashRegenerateonDec,
                dataType: 'json',
                cache: false,
                async: false,
                success: function(returndata) {
                  console.log(returndata);
                  if(returndata.status == 'true' || returndata.status == true) {
                    if(isexit==1){
                      window.location.href = save_exit_redirect_url;
                      return false; }
                    $("#formerr").hide();
                    moveNxt=1;  
                  }
                },
                error: function(returndata) {
                   $("#formerr").show();
                   $('.loader').hide();
                   moveNxt=0;
                },
            });
                            
						        if(moveNxt){
              var startIndex = currentIndex+1
              window.location.href = url+'?startIndex='+startIndex;
              //return true;
            }         
                    } else {
                    	photograph.validate();
                    	signature.validate();
                    	graduation_marksheet.validate();
                      $(this).attr('isexit','');
                        return false;
                    }
                }

                if(currentIndex == 6) {
					declaration_func(currentIndex);
				}

                

                /*var url = "<?php echo base_url(); ?>mtechresearch-jan";	
                var AjaxRequest = $.ajax({
						type: 'POST',
						url: url,
						// data: userData+'&currentIndex='+currentIndex+'&<?php //echo $this->security->get_csrf_token_name(); ?>=<?php //echo $this->security->get_csrf_hash(); ?>',
						data: userData+'&currentIndex='+currentIndex,
						dataType: 'json',
						cache: false,
						beforeSend: function() { $('.loader').show(); },
						success: function(returndata) {
							if(returndata) {									
								console.log(returndata);
								var startIndex = currentIndex+1
								window.location.href = '<?php echo base_url().'mtechresearch-jan';?>?startIndex='+startIndex;
							}
						},
						error: function(returndata) {
						  console.log(returndata); 
						},
					});					

					return AjaxRequest;*/	
			}
			else { 
				return true; 
			}	
        },
        onStepChanged: function (event, currentIndex, priorIndex) { 
        	var isexit=($(this).attr('isexit'));        	
        	if(isexit!='undefined' &&  isexit==1)
        	{
        	   setTimeout(function() {   
             window.location.href = save_exit_redirect_url;
             },1);
        	}
        	if(currentIndex==3){
				$(".actions ul > li:nth-child(2) a").text('<?php echo MAKE_PAYMENT; ?>');
			}else{
				$(".actions ul > li:nth-child(2) a").text('<?php echo NEXT_STEP; ?>');
			}
        	enable_saveExit_btn(currentIndex,4);
		// form preview button displayed	
		if(currentIndex == parseInt(total_wizard_Step - 1)){
			$("#save_exit").remove();
			//enable_preview_btn(currentIndex,'<?php echo base_url();?>mtechresearch-jan-preview');
      if(mode_edit_url !='')
        {
          enable_preview_btn(currentIndex,'<?php echo base_url();?>mtechresearch-jan-preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
        }else{
          enable_preview_btn(currentIndex,'<?php echo base_url();?>mtechresearch-jan-preview');
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
            declaration_func(currentIndex);
        },

        /* Labels */
        labels: {
            cancel: "Cancel",
            current: "current step:",
            pagination: "Pagination",
            finish: "Submit",
            next: "Next",
            previous: "Previous",
            loading: "Loading ..."
        }
    }

    $("#mtechresearch_jan_form").steps(settings);
  //setsave exit attr	
    $(document).on("click", "#save_btn" , function() {
    	 $("#mtechresearch_jan_form").attr('isexit',1);
         $("#mtechresearch_jan_form").steps('next');
    });
    
    $('.actions a').click(function(){        	 
      $("#mtechresearch_jan_form").attr('isexit','');
    }); 
//end set attr
  //to remove links from previous tabs a
    <?php if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) && ($mode_edit == '')) { ?>
     $( ".steps li" ).each(function( index ) { 
      if(index<5){       	 
   	  $("#mtechresearch_jan_form-t-"+index).removeAttr("href");
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
			var no_nationality_msg = "Sorry, Nationality not available.";
			var no_studied_from_india_msg = "Sorry, Studied from India not available.";
			var no_blood_grp_msg = "Sorry, Campus not available.";
			var no_country_msg = "Sorry, Country not available.";
			var no_state_msg = "Sorry, State not available.";
			var no_city_msg = "Sorry, City not available.";
			var no_district_msg="Sorry, District not available.";
			var no_mobile_code_msg = "Sorry, Mobile code not available.";
			var no_qualifying_degree_msg = "Sorry, Qualifying Degree not available.";
			var no_spec_qualifying_degree_msg = "Sorry, Qualifying Specialization Degree not available.";
			var no_working_dsc_msg = "Sorry, Department / College / School not available.";
			var no_faculty_msg = "Sorry, Faculty not available.";
			var no_category_msg = "Sorry, Category not available.";
			var no_work_experience_msg = "Sorry, Work Experience not available.";
			var no_working_place_msg = "Sorry, Working Place not available.";
			var no_gender_title_msg = "Sorry, Title not available.";	
			var no_gender_msg = "Sorry, Gender not available.";	
			var no_blood_group_msg = "Sorry, Blood Group not available.";
			var no_social_status_msg = "Sorry, Social Status not available.";
			var no_differently_abled_msg = "Sorry, Differently Abled not available.";
			var no_nature_deformity_msg = "Sorry, Nature Of Deformity not available.";
			var no_percent_deformity_msg = "Sorry, Percentage Of Deformity not available.";
            var no_institute_university_msg = "Sorry, Institute/University not available.";
            var no_user_marking_scheme_msg = "Sorry, Marking Scheme not available.";
            var no_competitive_exam_msg = "Sorry, Competitive Exams not available.";
            var no_campus_prefer_msg = "Sorry, Campus Preference not available.";
            var no_specialization_prefer_msg = "Sorry, Specialization Preference not available.";
            var no_religion_grp_msg="Sorry, Religion not available ";
            var no_medium_inst_msg="Sorry, Medium of Instruction not available ";
            var no_mother_tongue_msg="Sorry, Mother Tongue not available ";
			var no_hostel_accommodation_msg = "Sorry, Hostel Accommodation not available.";
			var no_advertisement_source_msg = "Sorry, Advertisement Source not available.";
			var no_differently_abled_msg = "Sorry, Differently Abled not available.";
			var no_mobile_code_msg = "Sorry, Mobile code not available.";
			var no_title_msg = "Sorry, Title not available.";
			var no_occupation_msg = "Sorry, Occupation not available.";
			var no_mode_of_study ="Sorry, Mode of Study not available.";
			var no_is_work_experience_msg = "Sorry, Work Experience Status not available.";
			var no_banks_msg = "Sorry, Banks not available.";			


			basic_change();	

			getSelect2('nationality_id','<?php echo base_url("get_nationalities"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Nationality', formatRepoCommon,no_nationality_msg, false, formatRepoSelection);

			getSelect2('graduation_india','<?php echo base_url("get_studied_from_india"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Status', formatRepoCommon,no_studied_from_india_msg, false, formatRepoSelection);


			getSelect2('mode_of_study','<?php echo base_url("get_mode_of_study"); ?>?is_lookup_master=1'+url_edit,'', formatRepoCommon,no_mode_of_study, false, formatRepoSelection);
			
			getSelect2('campus_preference1','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_campus=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+tmp_app_form_id+'&sort_by=name&sort_order=asc'+url_edit,'Choose Campus Perferences 1', formatRepoCommon,no_campus_prefer_msg, false, formatRepoSelection);

			// getSelect2('campus_preference1','<?php echo base_url("get_mtechrecampus_preference"); ?>?sort_by=name&sort_order=asc','Choose Campus Preference1', formatRepoCommon,no_campus_prefer_msg, false, formatRepoSelection);

			getSelect2('campus_preference2','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_campus=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+tmp_app_form_id+'&sort_by=name&sort_order=asc'+url_edit,'Choose Campus Perferences 2', formatRepoCommon,no_campus_prefer_msg, false, formatRepoSelection);

			// getSelect2('campus_preference2','<?php echo base_url("get_mtechrecampus_preference"); ?>?sort_by=name&sort_order=asc','Choose Campus Preference2', formatRepoCommon,no_campus_prefer_msg, false, formatRepoSelection);

			getSelect2('campus_preference3','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_campus=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+tmp_app_form_id+'&sort_by=name&sort_order=asc'+url_edit,'Choose Campus Perferences 3', formatRepoCommon,no_campus_prefer_msg, false, formatRepoSelection);

			// getSelect2('campus_preference3','<?php echo base_url("get_mtechrecampus_preference"); ?>?sort_by=name&sort_order=asc','Choose Campus Preference3', formatRepoCommon,no_campus_prefer_msg, false, formatRepoSelection);
			

			/*$('#campus_preference1').on('change',function() {
				setEmptyOnChangeSelect2('specialization_preference1'); // when no values return in json, add empty option value 
				if ($('#specialization_preference1').data('select2')) {
					$('#specialization_preference1').select2('destroy');
				}

				$('#specialization_preference1').html(''); // reset select values for, if user selected the value then change the country code, then select same value, and value will be null, that so we reset the select values
				// var specialization_preference1_val = $(this).val();
				var campus_preference_val = $(this).val();
				$('#speciali_prefer1_div').show();
				getSelect2('specialization_preference1','<?php echo base_url("get_mtechrespecialization_preference"); ?>?sort_by=name&sort_order=asc','Choose Specialization Preference1', formatRepoCommon,no_specialization_prefer_msg, false, formatRepoSelection);
				// getSelect2('specialization_preference1','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_spec=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&campus_id='+campus_preference_val+'&sort_by=name&sort_order=asc','Choose Specialization Perferences 1', formatRepoCommon,no_specialization_prefer_msg, false, formatRepoSelection);
				
			});	

			$('#campus_preference2').on('change',function() {
				setEmptyOnChangeSelect2('specialization_preference2'); // when no values return in json, add empty option value 
				if ($('#specialization_preference2').data('select2')) {
					$('#specialization_preference2').select2('destroy');
				}

				$('#specialization_preference2').html(''); // reset select values for, if user selected the value then change the country code, then select same value, and value will be null, that so we reset the select values
				// var specialization_preference2_val = $(this).val();
				var campus_preference_val = $(this).val();
				$('#speciali_prefer2_div').show();
				getSelect2('specialization_preference2','<?php echo base_url("get_mtechrespecialization_preference"); ?>?sort_by=name&sort_order=asc','Choose Specialization Preference2', formatRepoCommon,no_specialization_prefer_msg, false, formatRepoSelection);
				// getSelect2('specialization_preference2','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_spec=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&campus_id='+campus_preference_val+'&sort_by=name&sort_order=asc','Choose Specialization Perferences 2', formatRepoCommon,no_specialization_prefer_msg, false, formatRepoSelection);
				
			});	


			$('#campus_preference3').on('change',function() {
				setEmptyOnChangeSelect2('specialization_preference3'); // when no values return in json, add empty option value 
				if ($('#specialization_preference3').data('select2')) {
					$('#specialization_preference3').select2('destroy');
				}

				$('#specialization_preference3').html(''); // reset select values for, if user selected the value then change the country code, then select same value, and value will be null, that so we reset the select values
				// var specialization_preference3_val = $(this).val();
				var campus_preference_val = $(this).val();
				$('#speciali_prefer3_div').show();
				getSelect2('specialization_preference3','<?php echo base_url("get_mtechrespecialization_preference"); ?>?sort_by=name&sort_order=asc','Choose Specialization Preference3', formatRepoCommon,no_specialization_prefer_msg, false, formatRepoSelection);
				// getSelect2('specialization_preference3','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_spec=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&campus_id='+campus_preference_val+'&sort_by=name&sort_order=asc','Choose Specialization Perferences 3', formatRepoCommon,no_specialization_prefer_msg, false, formatRepoSelection);
				
			});	*/
			
			test_campus_pref('campus_preference1','Choose Campus Perferences 1');
			test_campus_pref('campus_preference2','Choose Campus Perferences 2');
			test_campus_pref('campus_preference3','Choose Campus Perferences 3');
			
			test_campus_pref_change('campus_preference1','specialization_preference1','speciali_prefer1_div','Choose Specialization Perferences 1');
			test_campus_pref_change('campus_preference2','specialization_preference2','speciali_prefer2_div','Choose Specialization Perferences 2');
			test_campus_pref_change('campus_preference3','specialization_preference3','speciali_prefer3_div','Choose Specialization Perferences 3');
			
			

			
		
			getSelect2('BankName','<?php echo base_url("get_banks"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Bank', formatRepoCommon,no_banks_msg, false, formatRepoSelection);			

			getSelect2('country','<?php echo base_url("get_countries"); ?>?sort_by=country_id&sort_order=asc'+url_edit,'Choose Country', formatRepoCommon,no_country_msg, false, formatRepoSelection);	

			getSelect2('phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);

			getSelect2('qualifying_degree','<?php echo base_url("get_qualifying_degree"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Qualifying Degree', formatRepoCommon,no_qualifying_degree_msg, false, formatRepoSelection);
			
			getSelect2('specialization_qualifying_degree','<?php echo base_url("get_spec_qualifying_degree"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Specialization Qualifying Degree', formatRepoCommon,no_spec_qualifying_degree_msg, false, formatRepoSelection);

			getSelect2('working_dsc','<?php echo base_url("get_working_dsc"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Department / College / School', formatRepoCommon,no_working_dsc_msg, false, formatRepoSelection);
			
			getSelect2('faculty','<?php echo base_url("get_faculty"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Faculty', formatRepoCommon,no_faculty_msg, false, formatRepoSelection);

			getSelect2('category','<?php echo base_url("get_work_category"); ?>?is_lookup_master=1'+url_edit,'Choose Category', formatRepoCommon,no_category_msg, false, formatRepoSelection);
			
			getSelect2('is_employed','<?php echo base_url("get_are_you_employed"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Working Type', formatRepoCommon,no_work_experience_msg, false, formatRepoSelection);			

			getSelect2('working_place','<?php echo base_url("get_working_place"); ?>?is_lookup_master=1'+url_edit,'Choose Working Place', formatRepoCommon,no_working_place_msg, false, formatRepoSelection);

			getSelect2('title_id','<?php echo base_url("get_gender_title"); ?>?is_lookup_master=1'+url_edit,'Choose  Title', formatRepoCommon,no_gender_title_msg, false, formatRepoSelection);
			
			getSelect2('gender_id','<?php echo base_url("get_gender"); ?>?is_lookup_master=1'+url_edit,'Choose Gender', formatRepoCommon,no_gender_msg, false, formatRepoSelection);
			
			getSelect2('blood_grp_id','<?php echo base_url("get_bloodgroups"); ?>?sort_by=blood_grp_id&sort_order=asc'+url_edit,'Choose Blood Groups', formatRepoCommon,no_blood_group_msg, false, formatRepoSelection);

			getSelect2('religion_id','<?php echo base_url("get_mtechrereligion"); ?>?sort_by=religion_id&sort_order=asc'+url_edit,'Choose Religion', formatRepoCommon,no_religion_grp_msg, false, formatRepoSelection);

			getSelect2('mothertongue_id','<?php echo base_url("get_mtechremothertong"); ?>?sort_by=mothertongue_id&sort_order=asc'+url_edit,'Choose Mother Tongue', formatRepoCommon,no_mother_tongue_msg, false, formatRepoSelection);

			getSelect2('medofinst','<?php echo base_url("get_mtechremothertong"); ?>?sort_by=mothertongue_id&sort_order=asc'+url_edit,'Choose Mother Tongue', formatRepoCommon,no_medium_inst_msg, false, formatRepoSelection);

			getSelect2('prefer_hostel','<?php echo base_url("get_hostel_accommodation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Hostel Accommodation', formatRepoCommon,no_hostel_accommodation_msg, false, formatRepoSelection);

			getSelect2('diff_abled','<?php echo base_url("get_are_you_differently_abled"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Differently Abled', formatRepoCommon,no_differently_abled_msg, false, formatRepoSelection);

			getSelect2('advertisement_source_id','<?php echo base_url("get_advertisement_source"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Advertisement Source', formatRepoCommon,no_advertisement_source_msg, false, formatRepoSelection);
			
			getSelect2('pd_social_status','<?php echo base_url("get_social_status"); ?>?is_lookup_master=1'+url_edit,'Choose Social Status', formatRepoCommon,no_social_status_msg, false, formatRepoSelection);
	
			getSelect2('pd_diffrently_abled','<?php echo base_url("get_are_you_differently_abled"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Differently Abled', formatRepoCommon,no_differently_abled_msg, false, formatRepoSelection);
			
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

		  show_other_element('pd_father_occupation','father_other_occupation_div',otheroccupation);
		  show_other_element('pd_mother_occupation','mother_other_occupation_div',otheroccupation);
		  show_other_element('pd_guardian_occupation','guardian_other_occupation_div',otheroccupation);


      //a2304 modified
      validate_cgpa('user_marking_scheme_1','obtained_percentage_cgpa_1');
      //a2304 modified end
			

			$('#add_guardian_checkbox').on('change',function(){
				chk_guardian($(this).is(':checked'));
			});
			
			getSelect2('pd_guardian_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
			
			getSelect2('pd_guardian_occupation','<?php echo base_url("get_parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Mother Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);

			getSelect2('is_work_experience','<?php echo base_url("get_is_work_experience_status"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Work Experience Status', formatRepoCommon,no_is_work_experience_msg, false, formatRepoSelection);

       getSelect2('institute_university_1','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Institute/University', formatRepoCommon,no_institute_university_msg, false, formatRepoSelection);

       getSelect2('institute_university_2','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Institute/University', formatRepoCommon,no_institute_university_msg, false, formatRepoSelection);

      getSelect2('university_id','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc'+url_edit,'', formatRepoCommon,no_institute_university_msg, false, formatRepoSelection);            

      getSelect2('user_marking_scheme_1','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

       getSelect2('user_marking_scheme_2','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
        getSelect2('user_marking_scheme_3','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

            getSelect2('competitive_exam','<?php echo base_url("get_competitive_exams"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Competitive Exam', formatRepoCommon,no_competitive_exam_msg, false, formatRepoSelection);


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

			$('#is_work_experience').on('change',function(){
				var is_work_experience = $('#is_work_experience').val();
				var val = (is_work_experience == 'yes')?true:false;
				chk_work_experience(val);
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
			
			$('#nationality_id').on('change',function(){
				var nationality_id = $('#nationality_id').val();
				var val = (country_value_default == nationality_id)?true:false;
				chk_social_status(val);
			});		

			$('#pd_diffrently_abled').on('change',function() {
				var pd_diffrently_abled = $("#pd_diffrently_abled").val();
				console.log("pd_diffrently_abled "+pd_diffrently_abled);
				
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
			$("#dob").datepicker( {
				format:"dd/mm/yyyy" ,autoclose: true,todayHighlight: true,endDate: endDob
			});

      $("#DDDate").datepicker( {
        format:"dd/mm/yyyy" ,autoclose: true,todayHighlight: true,todaybtn:true,endDate: todaydate
      }).on('changeDate', function(e) {
          $("#DDDate").parsley().validate();
      }); 

            $("#year_of_passing_1, #year_of_passing_2, #year_of_passing_3").datepicker( {
                format:"yyyy" , autoclose: !0, minViewMode: 'years', endDate: moment().format('dd-mm-yyyy')
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
            $("#resident").hide();
            $("#study_info").hide();
            $(".study").change(function () {
                if ($(".study").val() == "yes") {
                    $("#study_info").show();
                    $("#resident").hide();
                    $("#resident_info_message").hide();
                }
                else {
                    $("#study_info").hide();
                    $("#resident_info_message").hide();
                    $("#resident").show();
                }
            });
            $(".nationality").change(function () {
                if ($(".nationality").val() == "") {
                    $("#indian").hide();
                    $("#indian2").hide();
                }

            });
            $("#resident_info_message").hide();
            $("#resident_info").change(function () {
                if ($("#resident_info").val() == 'NonResident' || $("#resident_info").val() == 'Foreign') {
                    $("#resident_info_message").show();
                }
                else {
                    $("#resident_info_message").hide();
                }
            });
            $("#appering").click(function () {
                $("#appering_info_1").hide();
                $("#appering_info_2").hide();
                $("#appering_info_3").hide();
                $("#appering_info_4").hide();
            })
            $("#completed").click(function () {
                $("#appering_info_1").show();
                $("#appering_info_2").show();
                $("#appering_info_3").show();
                $("#appering_info_4").show();
            })
            //$("#payment_details").hide();
            $("#online").click(function () {
                $("#payment_details").hide();
            })
            $("#dd").click(function () {
                $("#payment_details").show();
            })
            // $("#Community").hide();
            // $("#nationality_indian").change(function () {
            //     if ($("#nationality_indian").val() == "Indian") {
            //         $("#Community").show();
            //     }
            //     else {
            //         $("#Community").hide();

            //     }
            // });

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
			
			onkeyValidationPexpOnMRESEARCH('organisation_name_1','designation_1','from_year_1','to_year_1');
			onkeyValidationPexpOnMRESEARCH('designation_1','organisation_name_1','from_year_1','to_year_1');
			onkeyValidationPexpOnMRESEARCH('from_year_1','organisation_name_1','designation_1','to_year_1');
			onkeyValidationPexpOnMRESEARCH('to_year_1','organisation_name_1','designation_1','from_year_1');

			onkeyValidationPexpOnMRESEARCH('organisation_name_2','designation_2','from_year_2','to_year_2');
			onkeyValidationPexpOnMRESEARCH('designation_2','organisation_name_2','from_year_2','to_year_2');
			onkeyValidationPexpOnMRESEARCH('from_year_2','organisation_name_2','designation_2','to_year_2');
			onkeyValidationPexpOnMRESEARCH('to_year_2','organisation_name_2','designation_2','from_year_2');			
			
        });


          $('#qualifyingexamfromindia').change(function() {
            if($(this).is(':checked')) {
                  $(this).val(1);
                } else {
                  $(this).val(0);
                }
         });

			
            <?php
            if($applicant_campus_campus_id) {
                foreach($applicant_campus_campus_id as $k=>$v) {
                    $campus_prefer_k = $k+1;
            ?>
                    var campus_pref_<?php echo $campus_prefer_k; ?> = "campus_preference<?php echo $campus_prefer_k; ?>";
                    var campus_pref_id<?php echo $campus_prefer_k; ?> = '<?php echo $v; ?>';
                    var campus_pref_name<?php echo $campus_prefer_k; ?> = '<?php echo $applicant_campus_campus_name[$k]; ?>';
                     if(campus_pref_id<?php echo $campus_prefer_k; ?>){
                        setTimeout(function(){ select2Set(campus_pref_<?php echo $campus_prefer_k; ?>,campus_pref_id<?php echo $campus_prefer_k; ?>,campus_pref_name<?php echo $campus_prefer_k; ?>);
                        	$('#'+campus_pref_<?php echo $campus_prefer_k; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
            ?>

            <?php
            if($applicant_course_spec_id) {
                foreach($applicant_course_spec_id as $k=>$v) {
                    $spec_prefer_k = $k+1;
            ?>
                    var specialization_pref_<?php echo $spec_prefer_k; ?> = "specialization_preference<?php echo $spec_prefer_k; ?>";
                    var specialization_pref_id<?php echo $spec_prefer_k; ?> = '<?php echo $v; ?>';
                    var specialization_pref_name<?php echo $spec_prefer_k; ?> = '<?php echo $applicant_course_spec_name[$k]; ?>';
                     if(specialization_pref_id<?php echo $spec_prefer_k; ?>){
                        setTimeout(function(){ select2Set(specialization_pref_<?php echo $spec_prefer_k; ?>,specialization_pref_id<?php echo $spec_prefer_k; ?>,specialization_pref_name<?php echo $spec_prefer_k; ?>);
                        	$('#'+specialization_pref_<?php echo $spec_prefer_k; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
            ?>

			var title_id = "title_id";
			var dbtitle_id = db_title_id;			
			var dbtitle_val = db_title_name;
			//alert(dbcountry_val);
			 if(dbtitle_id){
				setTimeout(function(){ select2Set(title_id,dbtitle_id,dbtitle_val);
				}, 1);
			}

			var gender_id = "gender_id";
			var dbgender_id = db_gender_id;			
			var dbgender_val = db_gender_name;
			//alert(dbcountry_val);
			 if(dbgender_id){
				setTimeout(function(){ select2Set(gender_id,dbgender_id,dbgender_val);
				}, 1);
			}

			var pd_social_status = "pd_social_status";
			var dbsocial_status_id = db_social_status_id;
			var dbsocial_status_name_val = db_social_status_name;
			if(dbsocial_status_id != ''){
			setTimeout(function(){ 
			  select2Set(pd_social_status,dbsocial_status_id,dbsocial_status_name_val);
			  $('#'+pd_social_status).trigger('change');
			}, 1);
			}

			var religion_id = "religion_id";
			var dbreligion_id = db_religion_id;			
			var dbreligion_val = db_religion_name;
			//alert(dbcountry_val);
			 if(dbreligion_id){
				setTimeout(function(){ select2Set(religion_id,dbreligion_id,dbreligion_val);
				}, 1);
			}

			var blood_grp_id = "blood_grp_id";			
			//alert(dbcountry_val);
			 if(db_blood_grp_id){
				setTimeout(function(){ select2Set(blood_grp_id,db_blood_grp_id,db_blood_grp_name);
				}, 1);
			}


			var mothertongue_id = "mothertongue_id";
			//alert(dbcountry_val);
			 if(db_mothertongue_id){
				setTimeout(function(){ select2Set(mothertongue_id,db_mothertongue_id,db_mothertongue_name);
				}, 1);
			}

			var medofinst_id = "medofinst";
			//alert(db_med_of_inst_id);
			 if(db_med_of_inst_id){
				setTimeout(function(){ 
					select2Set(medofinst_id,db_med_of_inst_id,db_med_of_inst_name);
				}, 1);
			}


      var prefer_hostel_id = "prefer_hostel";
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

			/*var prefer_hostel_id = "prefer_hostel";
			//alert(dbcountry_val);
			 if(db_prefer_hostel_id){
				setTimeout(function(){ select2Set(prefer_hostel_id,db_prefer_hostel_id,db_prefer_hostel_id);
				}, 1);
			}*/

			/*var diff_abled_id = "diff_abled";
			//alert(dbcountry_val);
			 if(db_dif_abled_id){
				setTimeout(function(){ select2Set(diff_abled_id,db_dif_abled_id,db_dif_abled_id);
				}, 1);
			}*/

      var diff_abled_id = "diff_abled";
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

			var advertisement_source_id = "advertisement_source_id";
			//alert(dbcountry_val);
			 if(db_adv_source_id){
				setTimeout(function(){ select2Set(advertisement_source_id,db_adv_source_id,db_adv_source_name);
				}, 1);
			}

			var nationality_id = "nationality_id";
			//alert(dbcountry_val);
			 if(db_nationality_id){
				setTimeout(function(){ select2Set(nationality_id,db_nationality_id,db_nationality_name);
					var val = (db_nationality_id == country_value_default)?1:0;
	            	chk_social_status(val);
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



			var mode_of_study = "mode_of_study";
			var mode_of_study_id = '<?php echo $applicant_grad_det_mode_of_study_id[0]; ?>';
			var mode_of_study_name = '<?php echo $applicant_grad_det_mode_of_study_name[0]; ?>';
			//alert(mode_of_study_id);
			 if(mode_of_study_id){
				setTimeout(function(){ select2Set(mode_of_study,mode_of_study_id,mode_of_study_name);
				}, 1);
			}


			var university_id = "university_id";
			var db_univ_id = '<?php echo $applicant_grad_det_univ_id[0]; ?>';
			var db_univ_name = '<?php echo $applicant_grad_det_univ_name[0]; ?>';
			//alert(dbcountry_val);
			 if(db_univ_id){
				setTimeout(function(){ select2Set(university_id,db_univ_id,db_univ_name);
				}, 1);
			}


			var user_marking_scheme_1 = "user_marking_scheme_1";
			var db_marking_schema_id = '<?php echo $applicant_grad_det_mark_scheme_id[0]; ?>';
			var db_marking_schema_name = '<?php echo $applicant_grad_det_mark_scheme_name[0]; ?>';
			//alert(dbcountry_val);
			 if(db_marking_schema_id){
				setTimeout(function(){ select2Set(user_marking_scheme_1,db_marking_schema_id,db_marking_schema_name);
				}, 1);
			}
	
			select2load('country','<?php echo $applicant_address_details_list['country_id']; ?>','<?php echo $applicant_address_details_list['country_name']; ?>');

      //Show Phoneno Code
      
      select2load('phone_no_code','<?php echo $applicant_basic_details_list['applicant_mob_country_code_id']; ?>','<?php echo $applicant_basic_details_list['applicant_mob_country_code_name']; ?>');

      select2load('pd_father_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_father]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_father]; ?>');

     select2load('pd_mother_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_mother]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_mother]; ?>');
    
     select2load('pd_guardian_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_guardian]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_guardian]; ?>');
			
			$('#country').on('change',function() {
				var country_phd_val=$(this).val();            
				if(country_value_default==country_phd_val){	
					select2load('state','<?php echo $applicant_address_details_list['state_id']; ?>','<?php echo $applicant_address_details_list['state_name']; ?>');
					select2load('district','<?php echo $applicant_address_details_list['district_id']; ?>','<?php echo $applicant_address_details_list['district_name']; ?>');
					select2load('city','<?php echo $applicant_address_details_list['city_id']; ?>','<?php echo $applicant_address_details_list['city_name']; ?>');
				}
			});	
			
			

			var is_work_experience = "is_work_experience";
			var is_work_experience_select = '<?php echo $is_work_experience_select; ?>';
			//alert(dbcountry_id);
			var is_work_experience_select_name = '<?php echo $is_work_experience_select_name; ?>';
			//alert(dbcountry_val);
			 if(is_work_experience_select != ''){
				setTimeout(function(){ select2Set(is_work_experience,is_work_experience_select,is_work_experience_select_name);
					$('#'+is_work_experience).trigger('change');
				}, 1);
			}
      
			<?php
            if($is_work_experience) {
            	$input_val = ($is_work_experience_select == 'yes')?1:0;
            ?>
        		chk_work_experience(<?php echo $input_val; ?>);
        	<?php

        	}
        	?>

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
            <?php
	      if($upload_scripts) {
	        foreach($upload_scripts as $k=>$v) {
	          echo $v."\n";
	        }
	      }
	      ?>
		  
		// Get Bank Name 
		select2load('BankName','<?php echo $payment_details_list['bank_id']; ?>','<?php echo $payment_details_list['bank_name']; ?>');

        onchangeLableHide('board');
        onchangeLableHide('mode_of_study');
        onchangeLableHide('marking_scheme');
        onchangeLableHide('year_of_passing_1','date');
        onchangeLableHide('from_year_0','date');
        onchangeLableHide('to_year_0','date');

      email_suggestion("second_email_id","suggestion_alt_email");
      email_suggestion("pd_father_email","suggestion_father_email");
      email_suggestion("pd_mother_email","suggestion_mother_email");
      email_suggestion("pd_guardian_email","suggestion_guardian_email");
		
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
	function test_campus_pref(campus,campus_placeholder) {
		var no_campus_prefer_msg="Sorry, Campus Preference not available.";
				getSelect2(campus,'<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_campus=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+tmp_app_form_id+'&sort_by=name&sort_order=asc'+url_edit,campus_placeholder, formatRepoCommon,no_campus_prefer_msg, false, formatRepoSelection);
			
		}
			function test_campus_pref_change(campus,specialization,specialization_div,specialization_placeholder) {
				 var no_specialization_prefer_msg = "Sorry, Specialization Preference not available.";
		          
		    	$('#'+campus).on('change',function() {			    	
					setEmptyOnChangeSelect2(specialization);
					if ($('#'+specialization).data('select2')) {
						$('#'+specialization).select2('destroy');
					}				
					$('#'+specialization).html(''); // reset select values for, if user selected the value then change the country code, then select same value, and value will be null, that so we reset the select values				
					var campus_val = $(this).val();
					
					$('#'+specialization_div).show();
					var exclude_special_ids = [];
					$('.test_specialization_pref').each(function() {
						var this_id = $(this).attr('id');
						
						if(this_id != specialization) {
							var val = $(this).val();							
							if(val) {
								exclude_special_ids.push(val);	
							}
						}
					})
					if($(exclude_special_ids).length > 0) {
						exclude_special_ids = exclude_special_ids.join(',');
					}
					//getSelect2(specialization,'<?php echo base_url("get_cities"); ?>?state_id='+state_val+'&sort_by=id&sort_order=asc&exclude_city_ids='+exclude_city_ids,city_placeholder, formatRepoCommon,no_city_msg, false, formatRepoSelection);
					getSelect2(specialization,'<?php echo base_url("get_mtechrespecialization_preference"); ?>?sort_by=name&sort_order=asc&exclude_specialization_ids='+exclude_special_ids+url_edit,specialization_placeholder, formatRepoCommon,no_specialization_prefer_msg, false, formatRepoSelection);
					
					});
		    }
          function test_specialization_pref_change(campus,specialization) {
		    	$('#'+specialization).on('change',function() {
		    		var cur_specialization_val = $(this).val();
		    		var test_campus_i = 0;
		    		$('.test_campus_pref').each(function() {
		    			var this_id = $(this).attr('id');
		    			if(this_id != campus) {
		    				var other_specialization_val = $('.test_specialization_pref').eq(test_campus_i).val();
		    				if(other_specialization_val == cur_specialization_val) {
		    					$(this).trigger('change');	
		    				}
		    			}
		    			test_campus_i++;
		    		});
		    	});
		    }
    function is_work_experience_func(val) {
        if(val == 'yes') {
            $('#emp_dtl').show();
            $('#emp_exp').show();
            $('#emp_total_exp').show();
            enable_validate_for_emp('emp_dtl');
            enable_validate_for_emp('emp_exp');
        } else {
            $('#emp_dtl').hide();
            $('#emp_exp').hide();
            $('#emp_total_exp').hide();
            disable_validate_for_emp('emp_dtl');
            disable_validate_for_emp('emp_exp');
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

    

    function basic_change() {
    	$("li a").css("pointer-events", "unset");	
    	var study_india_id = $("#graduation_india").val();        

        if (study_india_id == 'yes') {
            $("#confirm_indian").show(); 
            $("#confirm_notindian").hide();           
            $('#qualifyingexamfromindia').attr('data-parsley-required',"true");           
        }
        else if (study_india_id == 'no') {
        	$("li a").css("pointer-events", "none");
            $("#confirm_indian").hide();
            $("#confirm_notindian").show();        
            $('#qualifyingexamfromindia').attr('data-parsley-required',"false");
            $("input[name=qualifyingexamfromindia]").parsley().reset();
        } else {
        	$("#confirm_indian").hide();  
        	$("#confirm_notindian").hide();          
          $('#qualifyingexamfromindia').attr('data-parsley-required',"false");
          $("input[name=qualifyingexamfromindia]").parsley().reset();
        }
    }

    function upload_file(file_doc_type, upload_type) {
        upload_type = upload_type || false;

        var parsley_required = $('#'+file_doc_type).attr('data-required');
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

        var formData = new FormData();
        formData.append('applicant_login_id', logged_applicant_login_id);
        formData.append('applicant_id', logged_applicant_id);
        formData.append('file_doc_type', file_doc_type);
        formData.append('app_form_id', app_form_id);
        formData.append('chk_max_file_size', max_file_size);
        formData.append('file_extension', file_extension);
        formData.append('max_file_size_js', max_file_size_js);
        formData.append('id', id);
        formData.append(csrfName,csrfHashRegenerate);
        if(mode_edit_url !='')
        {
        formData.append('mode',mode_edit_val);
        formData.append('applicant_personal_det_id',crm_applicant_personal_det_id);
        }
        if(typeof $('#'+file_doc_type).attr('data-file-count') != 'undefined') {
            $($('#'+file_doc_type)[0].files).each(function(k,v) {
                formData.append(file_doc_type+'[]', v);     
            });
        } else {
            formData.append(file_doc_type, $('#'+file_doc_type)[0].files[0]); 
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
                    // console.log(returndata);
                    // console.log(returndata.data.data);
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
                            filename_html += '<span class="file_name  mt-3"><a class="image-popup-vertical-fit" href="<?php echo base_url(); ?>'+file_path+'" target="_blank" title="'+file_name_user+'">'+file_name_truncate+' <i class="fa fa-eye" aria-hidden="true"></i></a></span><a href="javascript:void(0)" data-del-file-id="'+id+'" data-doc-id="'+doc_id+'" data-toggle="modal" data-target="#contentDeletePop" data-field="'+file_doc_type+'" data-required="'+parsley_required+'" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a><div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_'+doc_id+'"><a href="#" class="close" onclick="hideAlert(\'deleteMessage_'+doc_id+'\')">&times;</a><strong id="deleteMessageStatus_'+doc_id+'"></strong> <span id="deleteMessageSpan_'+doc_id+'"></span></div>';
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
                        $('#'+file_doc_type).parent().append('<!-- <span class="file_name  mt-3"><a class="image-popup-vertical-fit" href="<?php echo base_url(); ?>'+file_path+'" target="_blank" title="'+file_name_user+'">'+file_name_truncate+' <i class="fa fa-eye" aria-hidden="true"></i></a></span><a href="javascript:void(0)" data-del-file-id="'+id+'" data-doc-id="'+doc_id+'" data-toggle="modal" data-target="#contentDeletePop" data-field="'+file_doc_type+'" data-required="'+parsley_required+'" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a> --> <div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_'+doc_id+'"><a href="#" class="close" onclick="hideAlert(\'deleteMessage_'+doc_id+'\')">&times;</a><strong id="deleteMessageStatus_'+doc_id+'"></strong> <span id="deleteMessageSpan_'+doc_id+'"></span></div>');

                        setTimeout(function() { 
                          upload_file_set_download_delete_options(file_doc_type, file_name, file_path, doc_id, id, parsley_required,mode_edit_url);
                        }, 100);
                        $('#'+file_doc_type).attr('data-file-id',id);
                    }
                    light_box_init();
                },
                error: function(returndata) {
                  console.log(returndata);
                },
            });
        } else {
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
      $("#pd_guardian_phone").attr('data-parsley-mobileonly','true');	
		} else {
			$('#add_guardian_checkbox').val('false');
			$('#guardian_details').hide();
      $("#pd_guardian_name").val('');
      $("#pd_guardian_phone").val('');
      setTimeout(function(){ select2Set("pd_guardian_occupation",'','');
        }, 1);
		 $("#pd_guardian_phone").attr('data-parsley-mobileonly','false');	
      $('#pd_guardian_name').attr('data-parsley-required',"false"); 
      $('#pd_guardian_phone').attr('data-parsley-required',"false");	
      $('#pd_guardian_occupation').attr('data-parsley-required',"false"); 
      $("#custom-pd_guardian_occupation-parsley-error").hide();
      $("#custom-pd_guardian_phone-parsley-error").hide();
      //$("#custom-pd_guardian_email-parsley-error").hide();

      //$("input[name=pd_guardian_email]").parsley().reset();
      $("input[name=pd_guardian_name]").parsley().reset();
      $("select[name=pd_guardian_occupation]").parsley().reset();
      $("input[name=pd_guardian_phone]").parsley().reset();
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
        console.log('data_del_file_id => '+data_del_file_id);
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
                if(doc_id == document_id_tentative_topic) {
                    var divId = 'deleteMessage_'+doc_id+data_del_file_id;
                    var strongId = 'deleteMessageStatus_'+doc_id+data_del_file_id;
                    var spanId = 'deleteMessageSpan_'+doc_id+data_del_file_id;
                } else {
                    var divId = 'deleteMessage_'+doc_id;
                    var strongId = 'deleteMessageStatus_'+doc_id;
                    var spanId = 'deleteMessageSpan_'+doc_id;   
                }
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
                    console.log('required =>'+$.type(required));
                    console.log('required =>'+required);
                    //if(required === 'true') {
                      $('#'+field).attr('data-parsley-required',required);
                      $('#'+field).parsley().validate();
                      $('#'+field).parsley().isValid();
                      $('#'+field).removeClass('parsley-success');
                    //}
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
    function chk_social_status(val) {
    	// if($(this).is(':checked')) {
    	if(val) {
			$('#pd_social_status').attr('data-parsley-required','true');
			$('#main_div_community').show();
		} else {
			$('#pd_social_status').attr('data-parsley-required','false');
			$('#main_div_community').hide();
		}
    }
    function chk_work_experience(val) {
    	// if($(this).is(':checked')) {
    	if(val) {
			$('#organisation_name_0').attr('data-parsley-required','true');
			$('#designation_0').attr('data-parsley-required','true');
			$('#nature_of_job_0').attr('data-parsley-required','true');
			$('#total_salary_month_0').attr('data-parsley-required','true');
			$('#from_year_0').attr('data-parsley-required','true');
			$('#to_year_0').attr('data-parsley-required','true');
			$('#work_experience_0').attr('data-parsley-required','true');
			$('#emp_exp').show();
			$('#emp_total_exp').show();
		} else {
			$('#organisation_name_0').attr('data-parsley-required','false');
			$('#designation_0').attr('data-parsley-required','false');
			$('#nature_of_job_0').attr('data-parsley-required','false');
			$('#total_salary_month_0').attr('data-parsley-required','false');
			$('#from_year_0').attr('data-parsley-required','false');
			$('#to_year_0').attr('data-parsley-required','false');
			$('#work_experience_0').attr('data-parsley-required','false');
			$('#emp_exp').hide();
			$('#emp_total_exp').hide();

      $("#organisation_name_0").val('');  
      $("#designation_0").val('');
      $("#nature_of_job_0").val('');
      $("#from_year_0").val('');
      $("#work_experience_0").val('');
      $("#to_year_0").val('');
      $("#total_work_experience").val('');

      $("#organisation_name_1").val('');  
      $("#designation_1").val('');
      $("#nature_of_job_1").val('');
      $("#from_year_1").val('');
      $("#work_experience_1").val('');
      $("#to_year_1").val('');

      $("#organisation_name_2").val('');  
      $("#designation_2").val('');
      $("#nature_of_job_2").val('');
      $("#from_year_2").val('');
      $("#work_experience_2").val('');
      $("#to_year_2").val('');
		}
    }
    function declaration_func(currentIndex) {
        var applicant_name = $('#applicant_name').parsley();
        var parent_name = $('#parent_name').parsley();
        var declaration_date = $('#date_dec').parsley();
        if(applicant_name.isValid() && parent_name.isValid() && declaration_date.isValid()) {
			var applicant_name  = $('#applicant_name').val();
			var parent_name   = $('#parent_name').val();
			var declaration_date  = $('#date_dec').val();
      // Get Regenerated CSRF Dynamically
        var csrfHashRegenerateonDec = $("input[name='"+csrfName+"']").val();
			var userData = 'applicant_name='+applicant_name+'&parent_name='+parent_name+'&declaration_date='+declaration_date+'&'+csrfName+'='+csrfHashRegenerateonDec;
			var AjaxRequest = $.ajax({
	        	type: 'POST',
		        url: url,		        
		        data: userData+'&currentIndex='+currentIndex,
		        dataType: 'json',
		        cache: false,
				beforeSend: function() { $('.loader').show(); },
		        success: function(returndata) {
					console.log(returndata);
					var base_url = "<?php echo base_url(); ?>mtechresearch-jan";	
					var startIndex = currentIndex+1
					setTimeout(function() { window.location.href = redirect_thank+url_edit; }, 100);
		        },
		        error: function(returndata) {
		          console.log(returndata); 
		        },
	      	});         

      		return AjaxRequest;
            // return true;       
        } else {
          applicant_name.validate();
          parent_name.validate();
          declaration_date.validate();
            return false;
        }
    }


</script>