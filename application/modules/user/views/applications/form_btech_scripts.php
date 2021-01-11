<?php
$app_form_id_btech = APP_FORM_ID_BTECH;
$parent_type_id_father = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
$const_grad_id = BTECH_GRADUATION_ID;
$const_deg_id = BTECH_DEGREE_ID;
$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_tenth_marksheet = DOCUMENT_ID_TENTH_MARKSHEET;
$document_id_twelvfth_marksheet = DOCUMENT_ID_TWELVFTH_MARKSHEET;
$document_id_aadhar_card = DOCUMENT_ID_AADHAR_CARD;
$form_wizard_payment_id = FORM_WIZARD_PAYMENT_ID;

$nationality_id = $applicant_basic_details_list['nation_id'];
$nationality_name = $applicant_basic_details_list['nationality'];

$tittle_id = $applicant_basic_details_list['tittle_id'];
$tittle_name = $applicant_basic_details_list['tittle_name'];
$blood_id = $applicant_basic_details_list['blood_id'];
$blood_group = $applicant_basic_details_list['blood_group'];
$gender_id = $applicant_basic_details_list['gender_id'];
$gender = $applicant_basic_details_list['gender'];
$social_status_id = $applicant_basic_details_list['social_status_id'];
$social_status = $applicant_basic_details_list['social_status'];
$dif_abled = $applicant_basic_details_list['dif_abled'];
$applicant_mob_country_code_id = $applicant_basic_details_list['applicant_mob_country_code_id'];
$applicant_mob_country_code_name = $applicant_basic_details_list['applicant_mob_country_code_name'];

$dif_abled_select = '';
$dif_abled_select_name = '';
if($dif_abled == 't') {
    $dif_abled_select = 'yes';
    $dif_abled_select_name = 'Yes';
} else if($dif_abled == 'f') {
    $dif_abled_select = 'no';
    $dif_abled_select_name = 'No';
}

$religion_id = $applicant_basic_details_list['religion_id'];
$religion = $applicant_basic_details_list['religion_name'];
$medium_of_instruction_id = $applicant_other_details_list['medofinst'];
$medium_of_instruction = $applicant_other_details_list['medium_of_study_name'];
// $hostel_accommodation_id = $applicant_basic_details_list['hostel_accommodation_id'];
// $hostel_accommodation = $applicant_basic_details_list['hostel_accommodation'];
$hostel_accommodation = $applicant_basic_details_list['prefer_hostel'];

$hostel_accommodation_select = '';
$hostel_accommodation_select_name = '';
if($hostel_accommodation == 't') {
    $hostel_accommodation_select = 'yes';
    $hostel_accommodation_select_name = 'Yes';
} else if($hostel_accommodation == 'f') {
    $hostel_accommodation_select = 'no';
    $hostel_accommodation_select_name = 'No';
}

$mother_tongue_id = $applicant_basic_details_list['mothertongue_id'];
$mother_tongue = $applicant_basic_details_list['mothertongue_name'];

$advertisement_source_id = $applicant_basic_details_list['advertisement_source_id'];
$advertisement_source = $applicant_basic_details_list['source_name'];
// if($applicant_appln_details_list) {
//    foreach($applicant_appln_details_list as $k=>$v) {
//       $appln_form_id = $v['appln_form_id'];
//       if($app_form_id_btech == $appln_form_id) {
//         $applicant_appln_id = $v['applicant_appln_id'];
//         $is_qualify = $v['qualifyingexamfromindia'];
//         // $is_qualify = $v['is_qualify'];
//       }
//    }
// }


$applicant_appln_id = $applicant_appln_details_list['applicant_appln_id'];
$is_qualify = $applicant_appln_details_list['qualifyingexamfromindia'];

$studied_from_india_id = '';
$studied_from_india_name = '';
if($is_qualify == 't') {
    $studied_from_india_id = 'yes';
    $studied_from_india_name = 'Yes';
} else if($is_qualify == 'f') {
    $studied_from_india_id = 'no';
    $studied_from_india_name = 'No';
}


if($applicant_course_prefer_details_list) {
   foreach($applicant_course_prefer_details_list as $k=>$v) {
      $applicant_course_id[] = $v['applicant_course_id'];
      //$applicant_course_course_id[] = $v['course_id'];
      $applicant_course_course_id[] = $v['branch_id'];
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

if($applicant_city_prefer_details_list) {
   foreach($applicant_city_prefer_details_list as $k=>$v) {
      $applicant_city_id[] = $v['applicant_city_id'];
      $applicant_city_city_id[] = $v['city_id'];
      $applicant_city_city_name[] = $v['city_name'];
      $applicant_city_choice_no[] = $v['choice_no'];
      $applicant_city_state_id[] = $v['state_id'];
      $applicant_city_state_name[] = $v['state_name'];
   }
}

$medium_of_instruction_id = $applicant_other_details_list['medofinst'];
$medium_of_instruction_name = $applicant_other_details_list['medium_of_study_name'];

$add_gardian = $applicant_other_details_list['add_gardian'];
// echo 'add_gardian => '.$add_gardian."\n";
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
      $applicant_parent_title_id[$parent_type_id] = $v['title_id'];
      $applicant_parent_title_name[$parent_type_id] = $v['title_name'];
        
   }
}

if($applicant_address_details_list) {
   foreach($applicant_address_details_list as $k=>$v) {
      $country_id[] = $v['country_id'];
      $country_name[] = $v['country_name'];
      $state_id[] = $v['state_id'];
      $state_name[] = $v['state_name'];
      $district_id[] = $v['district_id'];
      $district_name[] = $v['district_name'];
      $city_id[] = $v['city_id'];
      $city_name[] = $v['city_name'];
      $add_line_1[] = $v['add_line_1'];
      $add_line_2[] = $v['add_line_2'];
      $pin_code[] = $v['pin_code'];
   }
}

$schooling_id = $applicant_schooling_details_list['schooling_id'];
$board_id = $applicant_schooling_details_list['board_id'];
$board_name = $applicant_schooling_details_list['board_name'];
$marking_scheme_id = $applicant_schooling_details_list['marking_scheme_id'];
$marking_scheme_name = $applicant_schooling_details_list['marking_scheme_name'];
$mode_of_study_id = $applicant_schooling_details_list['mode_of_study_id'];
$mode_of_study_name = $applicant_schooling_details_list['mode_of_study_name'];
$cur_qual_completed = $applicant_other_details_list['cur_qual_completed'];


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
  		$file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_tenth_marksheet == $document_id)?'tenth_marksheet':(($document_id_twelvfth_marksheet == $document_id)?'twelvfth_marksheet':(($document_id_aadhar_card == $document_id)?'aadhar_card':'')))));
  		$parsley_required = (($document_id_photograph == $document_id)?'true':(($document_id_signature == $document_id)?'true':'false'));
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
$applicant_name=isset($applicant_appln_details_list['applicant_name_declaration'])?$applicant_appln_details_list['applicant_name_declaration']:'';
$parent_name=isset($applicant_appln_details_list['applicant_parentname_declaration'])?$applicant_appln_details_list['applicant_parentname_declaration']:'';
$current_wizard=$applicant_appln_details_list['wizard_id'];
$payment_mode_id = $applicant_payment_details_list['payment_mode_id'];

$startIndex = $this->input->get('startIndex',true);
//restrict previous section
$is_allow_previous=$this->config->item('is_allow_previous');
/*if($current_wizard){
    if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0)) {
        $startIndex=5; //upload and declaration
    }
}*/

/*Form Index Restriction Start*/
$start_wizard = 0;
$start_wizard_next = -1;
$next_step_allowed = '';
$start_wizard_next_allow='';
$appln_form_w_wizard_id = $applicant_appln_details_list['form_w_wizard_id'];
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
else if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0)) {
        $startIndex=5; //upload
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
	var part_time_external = '<?php echo PART_TIME_EXTERNAL; ?>';
	var nationality_indian = '<?php echo NATIONALITY_INDIAN; ?>';
	var country_value_default = '<?php echo COUNTRY_VALUE_DEFAULT; ?>';
	var logged_applicant_id = '<?php echo $logged_applicant_id; ?>';
    var logged_applicant_login_id = '<?php echo $logged_applicant_login_id; ?>';
    var comp_exam_ugc_net = '<?php echo COMP_EXAM_UGC_NET; ?>';
    var comp_exam_ugc_csir_net = '<?php echo COMP_EXAM_UGC_CSIR_NET; ?>';
    var comp_exam_slet = '<?php echo COMP_EXAM_SLET; ?>';
    var comp_exam_gate = '<?php echo COMP_EXAM_GATE; ?>';
    var comp_exam_teacher_fellowship_holder = '<?php echo COMP_EXAM_TEACHER_FELLOWSHIP_HOLDER; ?>';
    var document_id_tentative_topic = '<?php echo DOCUMENT_ID_TENTATIVE_TOPIC; ?>';
    var const_grad_id = '<?php echo $const_grad_id; ?>';
    var const_deg_id = '<?php echo $const_deg_id; ?>';
    var app_form_id = '<?php echo $app_form_id_btech; ?>';
    var applicant_appln_id = '<?php echo $applicant_appln_id; ?>';
    applicant_appln_id = (applicant_appln_id)?applicant_appln_id:false;

    var otheroccupation='<?php echo OTHER_OCCUPATION;?>';
    var otherstream='<?php echo OTHER_STREAM;?>';
    var otherboard='<?php echo OTHER_BOARD;?>';

    var startIndex_val = '<?php echo $startIndex;?>';

    

    
    var no_nationality_msg = "Sorry, Nationality not available.";
	var no_studied_from_india_msg = "Sorry, Studied from India not available.";
	var no_blood_grp_msg = "Sorry, Campus not available.";
	var no_country_msg = "Sorry, Country not available.";
	var no_state_msg = "Sorry, State not available.";
	var no_city_msg = "Sorry, City not available.";
	var no_district_msg = "Sorry, District not available.";
	var no_mobile_code_msg = "Sorry, Mobile code not available.";
	var no_course_msg = "Sorry, Course not available.";
	var no_branch_msg = "Sorry, Branch not available.";
	var no_specialization_msg = "Sorry, Specialization not available.";
	var no_campus_msg = "Sorry, Campus not available.";
	var no_gender_title_msg = "Sorry, Gender Title not available.";	
	var no_gender_msg = "Sorry, Gender not available.";	
	var no_blood_group_msg = "Sorry, Blood Group not available.";
	var no_religions_msg = "Sorry, Religion not available.";
	var no_medium_of_instruction_msg = "Sorry, Medium Of Instruction not available.";
	var no_hostel_accommodation_msg = "Sorry, Hostel Accommodation not available.";
	var no_mother_tongues_msg = "Sorry, Mother Tongue not available.";
	var no_advertisement_source_msg = "Sorry, Advertisement Source not available.";
	var no_social_status_msg = "Sorry, Social Status not available.";
	var no_differently_abled_msg = "Sorry, Differently Abled not available.";
	var no_mobile_code_msg = "Sorry, Mobile code not available.";
	var no_title_msg = "Sorry, Title not available.";
	var no_occupation_msg = "Sorry, Occupation not available.";
    var no_board_msg = "Sorry, Board not available";
    var no_mode_of_study = "Sorry, Mode of study not available";
    var no_user_marking_scheme_msg = "Sorry, Marking Scheme not available.";
    var no_banks_msg = "Sorry, Banks not available.";
    var payment_wizard_id = '<?php echo $form_wizard_payment_id; ?>';

    /*CRM ADMIN Edit form start*/
    var crm_applicant_personal_det_id = '<?php echo $crm_applicant_personal_det_id ; ?>';
    var crm_applicant_login_id = '<?php echo $crm_applicant_login_id ; ?>';
    var mode_edit_val = '<?php echo ADMIN_MODE_EDIT ; ?>';
    var mode_edit_url = '<?php echo $mode_edit; ?>';
    <?php if($mode_edit) { ?>
      var url_edit = '&mode=edit'+'&applicant_personal_det_id='+crm_applicant_personal_det_id+'&applicant_login_id='+crm_applicant_login_id;
      var url = "<?php echo base_url(); ?>btech/"+mode_edit_val+"/"+crm_applicant_login_id+"/"+crm_applicant_personal_det_id;
      var payment_url = '<?php echo base_url(); ?>user/payment_details?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;
      var save_exit_redirect_url = '<?php echo base_url(); ?>crm-admin/dashboard';
      //var upload_url = '<?php echo base_url(); ?>upload-file?mode='+mode_edit_val+'&applicant_personal_det_id='+crm_applicant_personal_det_id;     
    <?php } else { ?>
      var url_edit =  '';
      var url = "<?php echo base_url(); ?>btech";
      var payment_url = '<?php echo base_url(); ?>user/payment_details';
      var save_exit_redirect_url = '<?php echo base_url(); ?>';
       //var upload_url = "<?php echo base_url(); ?>upload-file";
    <?php } ?>
    /*CRM ADMIN Edit form end*/

  var get_percentage_url = '<?php echo base_url(); ?>/user/get_percentage_w_tab?app_form_id='+app_form_id+url_edit;
	var redirect_payment_thank_you = '<?php echo base_url(); ?>user/payment_thank_you?app_form_id='+app_form_id+'&wizard_id='+payment_wizard_id+'&url='+encodeURIComponent(url);
	var redirect = '<?php echo base_url()."thank_you"; ?>?app_form_id='+app_form_id;
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


    // form preview button displayed
        if(startIndex_val == 5){
          var preview_button = $("<li id='preview_li' style='list-style:none;'><a href='<?php echo base_url();?>btech-preview' style='float:left;background:unset;'><input type='button' id='form_preview_btn' class='btn btn-primary' value='Form Preview'></a></li>");
          $(document).find(".actions").prepend(preview_button);
        }else{
        $('#preview_li').remove();
      }

		<?php if($payment_mode_id == PAYMENT_MODE_DEMAND_DRAFT_ID) {
				?>
				setTimeout(function() {
					$("#dd").trigger('click');
					<?php if(!empty($applicant_payment_details_list)){ ?> 
       			 $("#dd").attr("disabled","disabled");
					 $("#online").attr("disabled","disabled");
					 $("#BankName").attr("disabled","disabled");
					 $("#DDNumber").attr("disabled","disabled");					
					 $("#DDDate").attr("disabled","disabled");
					 $("#BranchName").attr("disabled","disabled");
       			<?php } ?>
				},1);
				<?php
			}
			if($payment_mode_id == PAYMENT_MODE_ONLINE_ID) {
			    ?>
        		setTimeout(function() {
        			$("#online").trigger('click');
        			
        			<?php if(!empty($applicant_payment_details_list)){ ?> 
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
        	//enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>btech-preview');
          if(mode_edit_url != '')
          {
            enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>btech-preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
          }else{
            enable_preview_btn(<?php echo $startIndex; ?>,'<?php echo base_url();?>btech-preview');
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
	        //startIndex: 4,
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
					  var pd_nationality = $('#pd_nationality').parsley();
					  var i_agree = $('#i_agree').parsley();
					  var studied_from_india = $('#studied_from_india').parsley();
					  
					  if(pd_nationality.isValid() && i_agree.isValid() && studied_from_india.isValid()) {
						var pd_nationality_val = $('#pd_nationality').val();
						var i_agree_val = $('#i_agree').val();
						var studied_from_india_val = $('#studied_from_india').val();
            var isexit = ($(this).attr('isexit'));
            var appln_status= $("#appln_status").val();
						
						var user_data = 'pd_nationality='+pd_nationality_val+'&i_agree='+i_agree_val+'&studied_from_india='+studied_from_india_val+'&applicant_appln_id='+applicant_appln_id+'&'+csrfName+'='+csrfHash+'&appln_status='+appln_status;
						var moveNxt=0;
						$.ajax({
							type: 'POST',
							url: url,
							data: user_data+'&currentIndex='+currentIndex,
							dataType: 'json',
							cache: false,
							async: false,
              beforeSend: function() { $('.loader').show(); },
							success: function(returndata) {
               console.log(returndata.appln_status.status);
              if(returndata) {
                var status = returndata.appln_status.status;
                if(status == 'true' || status == true) {
                  if(isexit==1) 
                  {
                       window.location.href = save_exit_redirect_url;
                       return false;
                  }
                  else {
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
					  	pd_nationality.validate();
					  	i_agree.validate();
					  	studied_from_india.validate();
              $(this).attr('isexit','');
						return false;
					  }
					}
					
					
					
					// Step 2 form validation
					if(currentIndex === 1) {
	                  // return true;

	                  var course_pref_1 = $('#course_pref_1').parsley();
	                  var specialization_pref_1 = $('#specialization_pref_1').parsley();
	                  var campus_pref_1 = $('#campus_pref_1').parsley();

	                  var state_pref_1 = $('#state_pref_1').parsley();
	                  var city_pref_1 = $('#city_pref_1').parsley();

					  var pd_title = $('#pd_title').parsley();
					  var pd_firstname = $('#pd_firstname').parsley();
					  var pd_lastname = $('#pd_lastname').parsley();
					  var phone_no_code = $('#phone_no_code').parsley();
					  var pd_mobile_no = $('#pd_mobile_no').parsley();
					  var pd_email = $('#pd_email').parsley();
					  var pd_dob = $('#pd_dob').parsley();
					  var pd_gender = $('#pd_gender').parsley();
					  var pd_alt_email = $('#pd_alt_email').parsley();
					  var pd_blood_group = $('#pd_blood_group').parsley();
					  var pd_social_status = $('#pd_social_status').parsley();
					  var pd_diffrently_abled = $('#pd_diffrently_abled').parsley();
					  var pd_religion = $('#pd_religion').parsley();
					  var pd_medium_of_instruction = $('#pd_medium_of_instruction').parsley();
            var pd_middlename = $('#pd_middlename').parsley();
					  
						if(course_pref_1.isValid() && specialization_pref_1.isValid() && campus_pref_1.isValid() && state_pref_1.isValid() && city_pref_1.isValid() && pd_title.isValid() && pd_firstname.isValid() && pd_lastname.isValid() && pd_mobile_no.isValid() && phone_no_code.isValid() && pd_email.isValid() && pd_dob.isValid() && pd_gender.isValid() && pd_alt_email.isValid() && pd_blood_group.isValid() && pd_diffrently_abled.isValid() && pd_religion.isValid() && pd_medium_of_instruction.isValid() && pd_middlename.isValid() && pd_social_status.isValid()) {
							var course_pref_1_val = $('#course_pref_1').val();
							var course_choice_no_1_val = $('#course_choice_no_1').val();
							var course_prefer_id_1_val = $('#course_prefer_id_1').val();
							var specialization_pref_1_val = $('#specialization_pref_1').val();
							var campus_pref_1_val = $('#campus_pref_1').val();
							var campus_choice_no_1_val = $('#campus_choice_no_1').val();
							var campus_prefer_id_1_val = $('#campus_prefer_id_1').val();
							var course_pref_2_val = $('#course_pref_2').val();
							var course_choice_no_2_val = $('#course_choice_no_2').val();
							var course_prefer_id_2_val = $('#course_prefer_id_2').val();
							var specialization_pref_2_val = $('#specialization_pref_2').val();
							var campus_pref_2_val = $('#campus_pref_2').val();
							var campus_choice_no_2_val = $('#campus_choice_no_2').val();
							var campus_prefer_id_2_val = $('#campus_prefer_id_2').val();

							var course_pref_3_val = $('#course_pref_3').val();
							var course_choice_no_3_val = $('#course_choice_no_3').val();
							var course_prefer_id_3_val = $('#course_prefer_id_3').val();
							var specialization_pref_3_val = $('#specialization_pref_3').val();
							var campus_pref_3_val = $('#campus_pref_3').val();
							var campus_choice_no_3_val = $('#campus_choice_no_3').val();
							var campus_prefer_id_3_val = $('#campus_prefer_id_3').val();

							var state_pref_1_val = $('#state_pref_1').val();
							var city_pref_1_val = $('#city_pref_1').val();
							var city_prefer_id_1_val = $('#city_prefer_id_1').val();
							var city_choice_no_1_val = $('#city_choice_no_1').val();
							var state_pref_2_val = $('#state_pref_2').val();
							var city_pref_2_val = $('#city_pref_2').val();
							var city_prefer_id_2_val = $('#city_prefer_id_2').val();
							var city_choice_no_2_val = $('#city_choice_no_2').val();
							var state_pref_3_val = $('#state_pref_3').val();
							var city_pref_3_val = $('#city_pref_3').val();
							var city_prefer_id_3_val = $('#city_prefer_id_3').val();
							var city_choice_no_3_val = $('#city_choice_no_3').val();
							
							var pd_title_val = $('#pd_title').val();
							var pd_firstname_val = $('#pd_firstname').val();
							var pd_middlename_val = $('#pd_middlename').val();
							var pd_lastname_val = $('#pd_lastname').val();
							var pd_mobile_no_code_val = $('#phone_no_code').val();
							var pd_mobile_no_val = $('#pd_mobile_no').val();
							var pd_email_val = $('#pd_email').val();
							var pd_dob_val = $('#pd_dob').val();
							var pd_gender_val = $('#pd_gender').val();
							var pd_alt_email_val = $('#pd_alt_email').val();
							var pd_blood_group_val = $('#pd_blood_group').val();
							var pd_social_status_val = $('#pd_social_status').val();
							var pd_diffrently_abled_val = $('#pd_diffrently_abled').val();
							var pd_religion_val = $('#pd_religion').val();
							var pd_medium_of_instruction_val = $('#pd_medium_of_instruction').val();
							var pd_hostel_accommodation_val = $('#pd_hostel_accommodation').val();
							var pd_mother_tongue_val = $('#pd_mother_tongue').val();
							var pd_advertisement_source_val = $('#pd_advertisement_source').val();
              var isexit = ($(this).attr('isexit'));
							// applicant name at declaration 
                           <?php if(empty($applicant_name) || $applicant_name=="")  { ?>
                            $("#applicant_name").val(pd_firstname_val);
                            <?php } ?>
							var user_data = 'course_pref_1='+course_pref_1_val+'&course_prefer_id_1='+course_prefer_id_1_val+'&course_choice_no_1='+course_choice_no_1_val+'&specialization_pref_1='+specialization_pref_1_val+'&campus_pref_1='+campus_pref_1_val+'&campus_choice_no_1='+campus_choice_no_1_val+'&campus_prefer_id_1='+campus_prefer_id_1_val+'&course_pref_2='+course_pref_2_val+'&course_prefer_id_2='+course_prefer_id_2_val+'&course_choice_no_2='+course_choice_no_2_val+'&specialization_pref_2='+specialization_pref_2_val+'&campus_pref_2='+campus_pref_2_val+'&campus_choice_no_2='+campus_choice_no_2_val+'&campus_prefer_id_2='+campus_prefer_id_2_val+'&course_pref_3='+course_pref_3_val+'&course_prefer_id_3='+course_prefer_id_3_val+'&course_choice_no_3='+course_choice_no_3_val+'&specialization_pref_3='+specialization_pref_3_val+'&campus_pref_3='+campus_pref_3_val+'&campus_choice_no_3='+campus_choice_no_3_val+'&campus_prefer_id_3='+campus_prefer_id_3_val+'&state_pref_1='+state_pref_1_val+'&city_pref_1='+city_pref_1_val+'&city_prefer_id_1='+city_prefer_id_1_val+'&city_choice_no_1='+city_choice_no_1_val+'&state_pref_2='+state_pref_2_val+'&city_pref_2='+city_pref_2_val+'&city_prefer_id_2='+city_prefer_id_2_val+'&city_choice_no_2='+city_choice_no_2_val+'&state_pref_3='+state_pref_3_val+'&city_pref_3='+city_pref_3_val+'&city_prefer_id_3='+city_prefer_id_3_val+'&city_choice_no_3='+city_choice_no_3_val+'&pd_title='+pd_title_val+'&pd_firstname='+pd_firstname_val+'&pd_middlename='+pd_middlename_val+'&pd_lastname='+pd_lastname_val+'&phone_no_code='+pd_mobile_no_code_val+'&pd_mobile_no='+pd_mobile_no_val+'&pd_email='+pd_email_val+'&pd_dob='+pd_dob_val+'&pd_gender='+pd_gender_val+'&pd_alt_email='+pd_alt_email_val+'&pd_blood_group='+pd_blood_group_val+'&pd_social_status='+pd_social_status_val+'&pd_diffrently_abled='+pd_diffrently_abled_val+'&pd_religion='+pd_religion_val+'&pd_medium_of_instruction='+pd_medium_of_instruction_val+'&pd_hostel_accommodation='+pd_hostel_accommodation_val+'&pd_mother_tongue='+pd_mother_tongue_val+'&pd_advertisement_source='+pd_advertisement_source_val+'&'+csrfName+'='+csrfHash;
							var moveNxt=0;
							$.ajax({
								type: 'POST',
								url: url,
								data: user_data+'&currentIndex='+currentIndex,
								dataType: 'json',
								cache: false,
                beforeSend: function() { $('.loader').show(); },
								async: false,
								success: function(returndata) {
              if(returndata) {
                if(returndata.status == true || returndata.status == 'true') {
                  if(isexit==1){
                   window.location.href = save_exit_redirect_url;
                   return false; }
                   else{
                  var startIndex = currentIndex+1;
                  window.location.href = url+'?startIndex='+startIndex; 
                  $("#formerr").hide();
                   moveNxt=1; }
                 
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
							course_pref_1.validate();
							specialization_pref_1.validate();
							campus_pref_1.validate();
							state_pref_1.validate();
							city_pref_1.validate();
							pd_title.validate();
							pd_firstname.validate();
							pd_lastname.validate();
							phone_no_code.validate();
							pd_mobile_no.validate();
							pd_email.validate();
							pd_dob.validate();
							pd_gender.validate();
							pd_alt_email.validate();
							pd_blood_group.validate();
							pd_social_status.validate();
							pd_diffrently_abled.validate();
							pd_religion.validate();
							pd_medium_of_instruction.validate();
              pd_middlename.validate();
              $(this).attr('isexit','');
							return false;
					  	}
					}

					// Step 3 form validation
					if(currentIndex === 2) {
					  // return true;

					  	var pd_father_title = $('#pd_father_title').parsley();
						var pd_father_name = $('#pd_father_name').parsley();
						var pd_father_email = $('#pd_father_email').parsley();
						var pd_father_phone = $('#pd_father_phone').parsley();
						var pd_father_alt_phone = $('#pd_father_alt_phone').parsley();
						var pd_mother_title = $('#pd_mother_title').parsley();
						var pd_mother_name = $('#pd_mother_name').parsley();
						var pd_mother_phone = $('#pd_mother_phone').parsley();
						var pd_mother_alt_phone = $('#pd_mother_alt_phone').parsley();
						var pd_mother_email = $('#pd_mother_email').parsley();
						var pd_guardian_name = $('#pd_guardian_name').parsley();
						var pd_guardian_phone = $('#pd_guardian_phone').parsley();
						var pd_guardian_email = $('#pd_guardian_email').parsley();
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

            check_visible_input_validation('guardian_details','pd_guardian_name','<?php echo REQD_GUARDIAN_NAME_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');
          
            check_visible_input_validation('guardian_details','pd_guardian_phone','<?php echo REQD_GUARDIAN_MOBILE_MSG;?>',false);
          
            check_visible_input_validation('guardian_details','pd_guardian_email','<?php echo REQD_GUARDIAN_EMAIL_MSG;?>',false);
          
            check_visible_input_validation('guardian_details','pd_guardian_occupation','<?php echo REQD_GUARDIAN_OCCUPATION_MSG;?>',false);

            check_visible_input_validation('father_other_occupation_div','pd_father_other_occupation','<?php echo REQD_FATHER_OTHER_OCCUPATION_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');

            check_visible_input_validation('mother_other_occupation_div','pd_mother_other_occupation','<?php echo REQD_MOTHER_OTHER_OCCUPATION_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');

            check_visible_input_validation('guardian_other_occupation_div','guardian_other_occupation','<?php echo REQD_GUARDIAN_OTHER_OCCUPATION_MSG;?>',true,'<?php echo REQD_ALPHA_ONLY_MSG;?>');

          check_visible_input_validation('main_div_state','state','<?php echo REQD_STATE_MSG;?>',false);
          
          check_visible_input_validation('main_div_district','district','<?php echo REQD_DISTRICT_MSG;?>',false);
          
          check_visible_input_validation('main_div_city','city','<?php echo REQD_CITY_MSG;?>',false);			
						
						
					  	if(pd_father_title.isValid() && pd_father_name.isValid() && pd_mother_title.isValid() && pd_mother_name.isValid() && pd_father_email.isValid() && pd_mother_email.isValid() && pd_guardian_name.isValid() && pd_guardian_phone.isValid() && pd_guardian_email.isValid() && pd_father_phone.isValid() && pd_mother_phone.isValid() && pd_father_alt_phone.isValid() && pd_mother_alt_phone.isValid() && country.isValid() && state.isValid() && district.isValid() && city.isValid() && address1.isValid() && pincode.isValid() && pd_guardian_occupation.isValid() && guardian_other_occupation.isValid() && pd_mother_other_occupation.isValid() && pd_father_other_occupation.isValid()) {

					  		var pd_father_id = $('#pd_father_id').val();
					  		var pd_father_title = $('#pd_father_title').val();
							var pd_father_name = $('#pd_father_name').val();
							var pd_father_phone_no_code = $('#pd_father_phone_no_code').val();
							var pd_father_phone = $('#pd_father_phone').val();
							var pd_father_alt_phone_no_code = $('#pd_father_alt_phone_no_code').val();
							var pd_father_alt_phone = $('#pd_father_alt_phone').val();
							var pd_father_email = $('#pd_father_email').val();
							var pd_father_occupation = $('#pd_father_occupation').val();
							var pd_mother_id = $('#pd_mother_id').val();
							var pd_mother_title = $('#pd_mother_title').val();
							var pd_mother_name = $('#pd_mother_name').val();
							var pd_mother_phone_no_code = $('#pd_mother_phone_no_code').val();
							var pd_mother_phone = $('#pd_mother_phone').val();
							var pd_mother_alt_phone_no_code = $('#pd_mother_alt_phone_no_code').val();
							var pd_mother_alt_phone = $('#pd_mother_alt_phone').val();
							var pd_mother_email = $('#pd_mother_email').val();
							var pd_mother_occupation = $('#pd_mother_occupation').val();
							var add_guardian_checkbox = $('#add_guardian_checkbox').val();
							var pd_guardian_id = $('#pd_guardian_id').val();
							var pd_guardian_name = $('#pd_guardian_name').val();
							var pd_guardian_phone_no_code = $('#pd_guardian_phone_no_code').val();
							var pd_guardian_alt_phone_no_code = $('#pd_guardian_alt_phone_no_code').val();
							var pd_guardian_phone = $('#pd_guardian_phone').val();
							var pd_guardian_alt_phone = $('#pd_guardian_alt_phone').val();
							var pd_guardian_email = $('#pd_guardian_email').val();
							var pd_guardian_occupation = $('#pd_guardian_occupation').val();
							var father_other_occupation_val='';
							var mother_other_occupation_val='';
              var isexit = ($(this).attr('isexit'));


              if(pd_father_alt_phone!='' || pd_father_phone!=''){
                if(pd_father_phone==pd_father_alt_phone){
                  unique_msg('pd_father_phone','#ec4561','<?php echo PHONE_ALT_UNIQUE; ?>');
                  return false;
                }
              }

              if(pd_father_phone!='' || pd_mother_alt_phone!=''){
                if(pd_father_phone==pd_mother_alt_phone){
                  unique_msg('pd_alt_mother_phone','#ec4561','<?php echo PHONE_ALT_UNIQUE; ?>');
                  return false;
                }
              }

              if(pd_mother_phone!='' && pd_mother_alt_phone!=''){
                if(pd_mother_phone==pd_mother_alt_phone || pd_mother_phone==pd_father_alt_phone){
                  unique_msg('pd_alt_mother_phone','#ec4561','<?php echo PHONE_ALT_UNIQUE; ?>');
                  return false;
                }     
              }

              if(pd_mother_phone!='' && pd_father_alt_phone!=''){
                if(pd_mother_phone==pd_mother_alt_phone || pd_mother_phone==pd_father_alt_phone){
                  unique_msg('pd_alt_father_phone','#ec4561','<?php echo PHONE_ALT_UNIQUE; ?>');
                  return false;
                }     
              }

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

          
          if(pd_guardian_email!=''){
            if(pd_mother_email==pd_guardian_email || pd_father_email==pd_guardian_email){
              $('#pd_guardian_email').addClass('parsley-error');
              $('#custom-pd_guardian_email-parsley-error').show();
              $('#custom-pd_guardian_email-parsley-error').css('color','#ec4561');
              $('#custom-pd_guardian_email-parsley-error').html('<?php echo EMAIL_MATCH_GUARDIAN; ?>');
              setTimeout(function(){
                  $('#pd_guardian_email').toggleClass('parsley-error');
                  $('#custom-pd_guardian_email-parsley-error').hide();
                }, 5000);               
              return false;
            } 
          }

							var guardian_other_occupation_val='';
							father_other_occupation_val=$('#pd_father_other_occupation').val();
							mother_other_occupation_val=$('#pd_mother_other_occupation').val();
							guardian_other_occupation_val=$('#guardian_other_occupation').val();
							 //set father name at declaration
		                    <?php if(empty($parent_name) || $parent_name=="")  { ?>
		                    $("#parent_name").val(pd_father_name);
		                    <?php } ?>

						  	var country_id 	= 	$('#country').val();
						  	var state_id 	= 	$('#state').val();
						  	var district_id = 	$('#district').val();
						  	var city_id     = 	$('#city').val();
						  	var address1    =  	$('#address_line1').val();
						  	var address2    =  	$('#address_line2').val();
						  	var pincode 	=	$('#pincode').val();
						  	var userData = 'pd_father_id='+pd_father_id+'&pd_father_title='+pd_father_title+'&pd_father_name='+pd_father_name+'&pd_father_phone_no_code='+pd_father_phone_no_code+'&pd_father_phone='+pd_father_phone+'&pd_father_alt_phone_no_code='+pd_father_alt_phone_no_code+'&pd_father_alt_phone='+pd_father_alt_phone+'&pd_father_email='+pd_father_email+'&pd_father_occupation='+pd_father_occupation+'&father_other_occupation='+father_other_occupation_val+'&pd_mother_id='+pd_mother_id+'&pd_mother_title='+pd_mother_title+'&pd_mother_name='+pd_mother_name+'&pd_mother_phone_no_code='+pd_mother_phone_no_code+'&pd_mother_alt_phone_no_code='+pd_mother_alt_phone_no_code+'&pd_mother_email='+pd_mother_email+'&pd_mother_occupation='+pd_mother_occupation+'&mother_other_occupation='+mother_other_occupation_val+'&add_guardian_checkbox='+add_guardian_checkbox+'&pd_guardian_id='+pd_guardian_id+'&pd_guardian_name='+pd_guardian_name+'&pd_guardian_phone_no_code='+pd_guardian_phone_no_code+'&pd_guardian_phone='+pd_guardian_phone+'&pd_guardian_email='+pd_guardian_email+'&pd_guardian_occupation='+pd_guardian_occupation+'&guardian_other_occupation='+guardian_other_occupation_val+'&pd_mother_phone='+pd_mother_phone+'&pd_mother_alt_phone='+pd_mother_alt_phone+'&country_id='+country_id+'&state_id='+state_id+'&district_id='+district_id+'&city_id='+city_id+'&address_line_1='+address1+'&address_line_2='+address2+'&pincode='+pincode+'&'+csrfName+'='+csrfHash;
						  	var moveNxt=0;
						  	$.ajax({
								type: 'POST',
								url: url,
								data: userData+'&currentIndex='+currentIndex,
								dataType: 'json',
								cache: false,
                beforeSend: function() { $('.loader').show(); },
								async: false,
								success: function(returndata) {
              if(returndata.parent_response[0]) {
                var status = returndata.parent_response[0].status;
                if(status == 'true' || status == true) {
                  if(isexit==1){
                                  window.location.href = save_exit_redirect_url;
                                  return false;
                            }else{
                              var startIndex = currentIndex+1
                              window.location.href =  url+'?startIndex='+startIndex; 
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

	                if(currentIndex === 3) {
	                    // return true;
						var appering = $('#appering').parsley();
						var completed = $('#completed').parsley();
	                    var tenth_name = $('#tenth_name').parsley();
	                    var institute_name = $('#institute_name').parsley();
	                    var board = $('#board').parsley();
	                    var mode_of_study = $('#mode_of_study').parsley();
	                    var marking_scheme = $('#marking_scheme').parsley();
	                    var obtained_percentage_cgpa = $('#obtained_percentage_cgpa').parsley();
	                    var year_of_passing = $('#year_of_passing').parsley();
	                    var registration_no = $('#registration_no').parsley();
	                    var address_of_school_college = $('#address_of_school_college').parsley();
	                    var nad_id_digilocker_id = $('#nad_id_digilocker_id').parsley();
	                    if(appering.isValid() && completed.isValid() && tenth_name.isValid() && institute_name.isValid() && board.isValid() && mode_of_study.isValid() && marking_scheme.isValid() && obtained_percentage_cgpa.isValid() && year_of_passing.isValid() && registration_no.isValid() && address_of_school_college.isValid() && nad_id_digilocker_id.isValid()) {
	                    	var current_education_qual_status 	=	$('input[name=current_education_qual_status]:checked').val();
	                    	var tenth_name 	=	$('#tenth_name').val();
	                    	var schooling_id  	=	$('#schooling_id').val();
	                    	var board 	=	$('#board').val();
	                    	var other_board 	=	$('#other_board').val();
	                    	var institute_name 	=	$('#institute_name').val();
	                    	var mode_of_study 	=	$('#mode_of_study').val();
	                    	var marking_scheme 	=	$('#marking_scheme').val();
	                    	var obtained_percentage_cgpa 	=	$('#obtained_percentage_cgpa').val();
	                    	var year_of_passing 	=	$('#year_of_passing').val();
	                    	var registration_no 	=	$('#registration_no').val();
	                    	var address_of_school_college 	=	$('#address_of_school_college').val();
	                    	var nad_id_digilocker_id 	=	$('#nad_id_digilocker_id').val();
                        var isexit = ($(this).attr('isexit'));
	                    	var userData = 'current_education_qual_status='+current_education_qual_status+'&tenth_name='+tenth_name+'&schooling_id='+schooling_id+'&board='+board+'&other_board='+other_board+'&institute_name='+institute_name+'&mode_of_study='+mode_of_study+'&marking_scheme='+marking_scheme+'&obtained_percentage_cgpa='+obtained_percentage_cgpa+'&year_of_passing='+year_of_passing+'&registration_no='+registration_no+'&address_of_school_college='+address_of_school_college+'&nad_id_digilocker_id='+nad_id_digilocker_id+'&'+csrfName+'='+csrfHash;
                           console.log(userData);
                           var moveNxt=0;
                           $.ajax({
								type: 'POST',
								url: url,
								data: userData+'&currentIndex='+currentIndex,
								dataType: 'json',
								cache: false,
                beforeSend: function() { $('.loader').show(); },
								async: false,
								success: function(returndata) {
              if(returndata) {
                if(returndata.status == 'true') {
                  if(isexit==1){
                                  window.location.href = save_exit_redirect_url;
                                  return false;
                  }else{
                        var startIndex = currentIndex+1
                      window.location.href = url+'?startIndex='+startIndex; 
                      moveNxt=1;  
                      $("#formerr").hide();
                  }
                  //}, 100);                    
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
	                    	appering.validate();
	                    	completed.validate();
	                    	tenth_name.validate();
	                    	institute_name.validate();
	                    	board.validate();
	                    	mode_of_study.validate();
	                    	marking_scheme.validate();
	                    	obtained_percentage_cgpa.validate();
	                    	year_of_passing.validate();
	                    	registration_no.validate();
	                    	address_of_school_college.validate();
	                    	nad_id_digilocker_id.validate();
                        $(this).attr('isexit','');
	                      return false;
	                    }
	                }
					
					 /*if(currentIndex == 5) {
						var applicant_name = $('#applicant_name').val();
						var declaration_date = $('#date_dec').val();
						
						var user_data = 'applicant_name='+applicant_name+'&declaration_date='+declaration_date;
						$.ajax({
							type: 'POST',
							url: url,
							data: user_data+'&currentIndex='+currentIndex,
							dataType: 'json',
							cache: false,
							success: function(returndata) {
							  console.log(returndata);
							},
							error: function(returndata) {
							  console.log(returndata); 
							},
						});
						return true
					 }*/

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
							var user_data = 'bank_name='+bank_name+'&branch_name='+branch_name+'&dd_cheque_no='+dd_cheque_no+'&dd_cheque_date='+dd_cheque_date+'&payment_mode='+payment_mode+'&app_form_id='+app_form_id+'&'+csrfName+'='+csrfHash;		
							var moveNxt=0;
		                    <?php if(empty($applicant_payment_details_list)) { ?> 
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
							<?php
							}else{ ?>
								  return true;
							<?php } ?>
						}
						if (payment_mode=='online')	
						{		<?php if(empty($applicant_payment_details_list)) { ?>
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
	                    // return true;
	                    // var valid = $(this).parsley().validate();
	                    declaration_func(currentIndex);
	                } 	
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

				// form preview button displayed
	        

        // form preview button displayed
        /*if(currentIndex == 5){
          var preview_button = $("<li id='preview_li' style='list-style:none;'><a href='<?php echo base_url();?>btech-preview' style='float:left;background:unset;'><input type='button' id='form_preview_btn' class='btn btn-primary' value='Form Preview'></a></li>");
          $(document).find(".actions").prepend(preview_button);
        }else{
        $('#preview_li').remove();
      }*/
      enable_saveExit_btn(currentIndex,4);
      // form preview button displayed
      if(currentIndex == parseInt(total_wizard_Step - 1)){
    	  $("#save_exit").remove();
    	  //enable_preview_btn(currentIndex,'<?php echo base_url();?>btech-preview');
        if(mode_edit_url !='')
        {
          enable_preview_btn(currentIndex,'<?php echo base_url();?>btech-preview/'+mode_edit_url+'/'+crm_applicant_login_id+'/'+crm_applicant_personal_det_id);
        }else{
          enable_preview_btn(currentIndex,'<?php echo base_url();?>btech-preview');
        }
      }else{
        $("#previewbtn").remove();
      }

      
                
      

      

				// This code for step count display in view part like STEPS 1 OF 7
				$("#show_currentindex").text(currentIndex+1+' Of '+total_wizard_Step);

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

    	$("#btech_form").steps(settings);
    	//setsave exit attr	
	    $(document).on("click", "#save_btn" , function() {
	    	 $("#btech_form").attr('isexit',1);
	         $("#btech_form").steps('next');
        });
        
        $('.actions a').click(function(){        	 
          $("#btech_form").attr('isexit','');
        }); 
//end set attr
    	//to remove links from previous tabs a
        <?php if($current_wizard>=FORM_WIZARD_PAYMENT_ID && (isset($is_allow_previous) && $is_allow_previous==0) && ($mode_edit == '')) { ?>
         $( ".steps li" ).each(function( index ) {
          if(index<5){       	 
       	  $("#btech_form-t-"+index).removeAttr("href");
         }			   
       	});
        <?php } ?>

		light_box_init();
        // $(document).ready(function () {
            // 'use strict';

            $('.instruction_accordion').click();

            basic_change();

			getSelect2('pd_nationality','<?php echo base_url("get_nationalities"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Nationality', formatRepoCommon,no_nationality_msg, false, formatRepoSelection);

			getSelect2('studied_from_india','<?php echo base_url("get_studied_from_india"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Status', formatRepoCommon,no_studied_from_india_msg, false, formatRepoSelection);
			
			getSelect2('course_pref_1','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_course=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc'+url_edit,'Choose Course Perferences 1', formatRepoCommon,no_course_msg, false, formatRepoSelection);
			// getSelect2('course_pref_1','<?php echo base_url("get_courses"); ?>?sort_by=name&sort_order=asc','Choose Course Perferences 1', formatRepoCommon,no_course_msg, false, formatRepoSelection);
			course_pref_change('course_pref_1','specialization_pref_1','main_div_spec_pref_1','Choose Specialization Perferences 1');
			spec_pref_change('course_pref_1','specialization_pref_1','campus_pref_1','main_div_camp_pref_1','Choose Campus Perferences 1');
    

			getSelect2('course_pref_2','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_course=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc'+url_edit,'Choose Course Perferences 2', formatRepoCommon,no_course_msg, false, formatRepoSelection);
			course_pref_change('course_pref_2','specialization_pref_2','main_div_spec_pref_2','Choose Specialization Perferences 2');
			spec_pref_change('course_pref_2','specialization_pref_2','campus_pref_2','main_div_camp_pref_2','Choose Campus Perferences 2');

			getSelect2('course_pref_3','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_course=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc'+url_edit,'Choose Course Perferences 3', formatRepoCommon,no_course_msg, false, formatRepoSelection);
			course_pref_change('course_pref_3','specialization_pref_3','main_div_spec_pref_3','Choose Specialization Perferences 3');
			spec_pref_change('course_pref_3','specialization_pref_3','campus_pref_3','main_div_camp_pref_3','Choose Campus Perferences 3');

			test_state_pref('state_pref_1','Choose Test State Perferences 1');
			test_state_pref('state_pref_2','Choose Test State Perferences 2');
			test_state_pref('state_pref_3','Choose Test State Perferences 3');
			test_state_pref_change('state_pref_1','city_pref_1','main_div_city_pref_1','Choose Test City Perferences 1');
			test_state_pref_change('state_pref_2','city_pref_2','main_div_city_pref_2','Choose Test City Perferences 2');
			test_state_pref_change('state_pref_3','city_pref_3','main_div_city_pref_3','Choose Test City Perferences 3');

			getSelect2('bloodgroups','<?php echo base_url("get_bloodgroups"); ?>?sort_by=blood_grp_id&sort_order=asc'+url_edit,'Choose Blood Groups', formatRepoCommon,no_blood_grp_msg, false, formatRepoSelection);
			
			getSelect2('country','<?php echo base_url("get_countries"); ?>?sort_by=country_id&sort_order=asc'+url_edit,'Choose Country', formatRepoCommon,no_country_msg, false, formatRepoSelection);	

			getSelect2('phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);

			

			getSelect2('pd_title','<?php echo base_url("get_gender_title"); ?>?is_lookup_master=1'+url_edit,'Choose Gender Title', formatRepoCommon,no_gender_title_msg, false, formatRepoSelection);
			
			getSelect2('pd_gender','<?php echo base_url("get_gender"); ?>?is_lookup_master=1'+url_edit,'Choose Gender', formatRepoCommon,no_gender_msg, false, formatRepoSelection);
			
			getSelect2('pd_blood_group','<?php echo base_url("get_bloodgroups"); ?>?sort_by=blood_grp_id&sort_order=asc'+url_edit,'Choose Blood Groups', formatRepoCommon,no_blood_group_msg, false, formatRepoSelection);

			getSelect2('pd_religion','<?php echo base_url("get_religions"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Religions', formatRepoCommon,no_religions_msg, false, formatRepoSelection);
			
			getSelect2('pd_medium_of_instruction','<?php echo base_url("get_mother_tongues"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Medium Of Instruction', formatRepoCommon,no_medium_of_instruction_msg, false, formatRepoSelection);

			getSelect2('pd_hostel_accommodation','<?php echo base_url("get_hostel_accommodation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Hostel Accommodation', formatRepoCommon,no_hostel_accommodation_msg, false, formatRepoSelection);

			getSelect2('pd_mother_tongue','<?php echo base_url("get_mother_tongues"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Mother Tongues', formatRepoCommon,no_mother_tongues_msg, false, formatRepoSelection);
			
			getSelect2('pd_advertisement_source','<?php echo base_url("get_advertisement_source"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Advertisement Source', formatRepoCommon,no_advertisement_source_msg, false, formatRepoSelection);

			getSelect2('pd_social_status','<?php echo base_url("get_social_status"); ?>?is_lookup_master=1'+url_edit,'Choose Social Status', formatRepoCommon,no_social_status_msg, false, formatRepoSelection);
	
			getSelect2('pd_diffrently_abled','<?php echo base_url("get_are_you_differently_abled"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Differently Abled', formatRepoCommon,no_differently_abled_msg, false, formatRepoSelection);

			getSelect2('pd_father_title','<?php echo base_url("get_parent_title"); ?>?is_lookup_master=1&is_father=1'+url_edit,'Choose Title', formatRepoCommon,no_title_msg, false, formatRepoSelection);
		
			getSelect2('pd_father_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);		
			getSelect2('pd_father_alt_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);		
			
			getSelect2('pd_father_occupation','<?php echo base_url("parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Father Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);

			getSelect2('pd_mother_title','<?php echo base_url("get_parent_title"); ?>?is_lookup_master=1&is_mother=1'+url_edit,'Choose Title', formatRepoCommon,no_title_msg, false, formatRepoSelection);
			
			getSelect2('pd_mother_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
			getSelect2('pd_mother_alt_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
			
			getSelect2('pd_mother_occupation','<?php echo base_url("parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Mother Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);
			
			getSelect2('pd_guardian_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc'+url_edit,'Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
			
			getSelect2('pd_guardian_occupation','<?php echo base_url("parent_occupation"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Mother Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);
			
			getSelect2('board','<?php echo base_url("get_board"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Board', formatRepoCommon,no_board_msg, false, formatRepoSelection);           

			getSelect2('mode_of_study','<?php echo base_url("get_mode_of_study"); ?>?is_lookup_master=1'+url_edit,'Choose Mode Of Study', formatRepoCommon,no_mode_of_study, false, formatRepoSelection);

      getSelect2('marking_scheme','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1'+url_edit,'Choose Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);

      getSelect2('BankName','<?php echo base_url("get_banks"); ?>?sort_by=name&sort_order=asc'+url_edit,'Choose Bank', formatRepoCommon,no_banks_msg, false, formatRepoSelection);

       select2load('BankName','<?php echo $applicant_payment_details_list['bank_id']; ?>','<?php echo $applicant_payment_details_list['bank_name']; ?>');

            //Show Parent Code
            select2load('pd_father_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_father]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_father]; ?>');

            select2load('pd_father_alt_phone_no_code','<?php echo $applicant_parent_alt_mob_countrycode_id[$parent_type_id_father]; ?>','<?php echo $applicant_parent_alt_mob_country_code[$parent_type_id_father]; ?>');

            select2load('pd_mother_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_mother]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_mother]; ?>');

            select2load('pd_mother_alt_phone_no_code','<?php echo $applicant_parent_alt_mob_countrycode_id[$parent_type_id_mother]; ?>','<?php echo $applicant_parent_alt_mob_country_code[$parent_type_id_mother]; ?>');

            select2load('pd_guardian_phone_no_code','<?php echo $applicant_parent_mob_country_code_id[$parent_type_id_guardian]; ?>','<?php echo $applicant_parent_country_mob_code[$parent_type_id_guardian]; ?>');
    
            
			
			
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
			// Personal Details On Change Start
			
			// Show Father & Mother Input
			show_parents_detail('pd_father_title','father_mbleno_div','father_email_div','father_occupation_div','father_alt_mbleno_div');
			show_parents_detail('pd_mother_title','mother_mbleno_div','mother_email_div','mother_occupation_div','mother_alt_mbleno_div');
			show_other_element('pd_father_occupation','father_other_occupation_div',otheroccupation);
			show_other_element('pd_mother_occupation','mother_other_occupation_div',otheroccupation);
			show_other_element('pd_guardian_occupation','guardian_other_occupation_div',otheroccupation);
			
			$('#pd_father_title').on('change',function(){
				var late = $(this).val();
				if(late==276){
					$("#pd_father_phone").val('');
					$("#pd_father_alt_phone").val('');
				}
			});
			
			$('#pd_mother_title').on('change',function(){
				var late = $(this).val();
				if(late==276){
					$("#pd_mother_phone").val('');
					$("#pd_mother_alt_phone").val('');
				}
			});			
			
			$('#add_guardian_checkbox').on('change',function(){
				chk_guardian($(this).is(':checked'));
			});
			//a2304 modified
			validate_cgpa('marking_scheme','obtained_percentage_cgpa');
			//a2304 modified end

			var studied_from_india = "studied_from_india";
			var studied_from_india_id = '<?php echo $studied_from_india_id; ?>';
			var studied_from_india_name = '<?php echo $studied_from_india_name; ?>';

			if(studied_from_india_id){
				setTimeout(function(){ 
					select2Set(studied_from_india,studied_from_india_id,studied_from_india_name);
					$('#'+studied_from_india).trigger('change');
				}, 1);
			}




			//Nationality Validation
		    $("#indian").hide();
		    $("#indian2").hide();
		    $("#pd_nationality").change(function () {
		        basic_change();
		    });

		    $("#studied_from_india").change(function () {
		        basic_change();
		    });

		    $('#i_agree').change(function() {
		    	if($(this).is(':checked')) {
		    		$(this).val(1);
		    	} else {
		    		$(this).val(0);
		    	}
		    });		

			$('#pd_diffrently_abled').on('change',function() {
				var pd_diffrently_abled = $("#pd_diffrently_abled").val();
				// console.log("pd_diffrently_abled "+pd_diffrently_abled);
				
				if(pd_diffrently_abled=='yes'){
					$(".main_div_deformity").show();
				}else{
					$(".main_div_deformity").hide();
				}
			});
			
			$('#phone_no_code').on('change',function() {
				var phone_no_code = $("#phone_no_code").val();
				// console.log("phone_no_code "+phone_no_code);
			});				
			
			// Personal Details On Change End
			
			// DOB Datepicker
			$("#pd_dob").datepicker( {
				format:"dd/mm/yyyy" ,autoclose: true,todayHighlight: true, endDate: endDob
			}).on('changeDate', function(e) {
			        $("#pd_dob").parsley().validate();
			});;

			$("#DDDate").datepicker( {
				format:"dd/mm/yyyy" ,autoclose: true,todayHighlight: true,todaybtn:true,endDate: todaydate
			}).on('changeDate', function(e) {
					$("#DDDate").parsley().validate();
			});	

            $("#year_of_passing").datepicker( {
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
                $("#obtained_percentage_cgpa").hide();
                $("#year_of_passing").hide();
                $("#registration_no").hide();
                $("#label_marking_scheme_id").hide();
                $("#label_obtained_percentage_cgpa_id").hide();
                $("#label_year_of_passing_id").hide();
                $("#custom-year_of_passing-parsley-error").hide();
                $("#custom-obtained_percentage_cgpa-parsley-error").hide();
                $("#custom-marking_scheme-parsley-error").hide();
                $('#marking_scheme').attr('data-parsley-required','false');
                $('#obtained_percentage_cgpa').attr('data-parsley-required','false');
                $('#year_of_passing').attr('data-parsley-required','false');
                setTimeout(function(){ select2Set("marking_scheme",'','');
                }, 1);
                $("#obtained_percentage_cgpa").val('');
                $("#year_of_passing").val('');
                $("#registration_no").val('');
            })
            $("#completed").click(function () {
                $("#appering_info_1").show();
                $("#obtained_percentage_cgpa").show();
                $("#year_of_passing").show();
                $("#registration_no").show();
                $("#label_marking_scheme_id").show();
                $("#label_obtained_percentage_cgpa_id").show();
                $("#label_year_of_passing_id").show();
                $('#marking_scheme').attr('data-parsley-required','true');
                $('#obtained_percentage_cgpa').attr('data-parsley-required','true');
                $('#year_of_passing').attr('data-parsley-required','true');
                $("#custom-year_of_passing-parsley-error").show();
                $("#custom-obtained_percentage_cgpa-parsley-error").show();
                $("#custom-marking_scheme-parsley-error").show();
            });

            <?php
            // db val check and trigger click for 12 appering
            if($cur_qual_completed == 't') {
            	?>
            	$("#completed").trigger('click');
            	<?php
            } else if($cur_qual_completed == 'f') {
            	?>
            	$("#appering").trigger('click');
            	<?php
            }
            ?>
            //$("#payment_details").hide();
            $("#online").click(function () {
                $("#payment_details").hide();
            })
            $("#dd").click(function () {
                $("#payment_details").show();
            })
            $("#Community").hide();
            $("#nationality_indian").change(function () {
                if ($("#nationality_indian").val() == "Indian") {
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
                    $("#obtained_percentage_cgpa").hide();
                    $("#year_of_passing").hide();
                    $("#registration_no").hide();
                }
                else if ($("#Qualification").val() == "GraduationPassed") {
                    $("#table4").hide();
                    $("#appering_info_1").show();
                    $("#obtained_percentage_cgpa").show();
                    $("#year_of_passing").show();
                    $("#registration_no").show();
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
            $('#board').on('change',function() {
    			var academic_boardid = $("#board").val();
    			if(academic_boardid==otherboard){
    				$("#other_board1").show();
    			}else{
    				$("#other_board1").hide();
    			}
    		});
            $('.finish').click(function(){
                window.location.replace("thank_you.html")
            })
        // });

			var country_id = "country";
			var dbcountry_id = '<?php echo $country_id[0]; ?>';
			//alert(dbcountry_id);
			var dbcountry_val = '<?php echo $country_name[0]; ?>';
			//alert(dbcountry_val);
			 if(dbcountry_id != ''){
				setTimeout(function(){ 
					select2Set(country_id,dbcountry_id,dbcountry_val);
					$('#'+country_id).trigger('change');
				}, 1);
			}

			var state_id = "state";
			var dbstate_id = '<?php echo $state_id[0]; ?>';
			//alert(dbcountry_id);
			var dbstate_val = '<?php echo $state_name[0]; ?>';
			//alert(dbcountry_val);
			 if(dbstate_id != ''){
				setTimeout(function(){ 
					select2Set(state_id,dbstate_id,dbstate_val);
					$('#'+state_id).trigger('change');
				}, 1);
			}

			var district_id = "district";
			var dbdistrict_id = '<?php echo $district_id[0]; ?>';
			//alert(dbcountry_id);
			var dbdistrict_val = '<?php echo $district_name[0]; ?>';
			//alert(dbcountry_val);
			 if(dbdistrict_id != ''){
				setTimeout(function(){ select2Set(district_id,dbdistrict_id,dbdistrict_val);
					$('#'+district_id).trigger('change');
				}, 1);
			}

			var city_id = "city";
			var dbcity_id = '<?php echo $city_id[0]; ?>';
			//alert(dbcountry_id);
			var dbcity_val = '<?php echo $city_name[0]; ?>';
			//alert(dbcountry_val);
			 if(dbcity_id != ''){
				setTimeout(function(){ select2Set(city_id,dbcity_id,dbcity_val);
					$('#'+city_id).trigger('change');
				}, 1);
			}

			var pd_nationality = "pd_nationality";
			var dbnationality_id = '<?php echo $nationality_id; ?>';
			var dbnationality_name_val = '<?php echo $nationality_name; ?>';
			if(dbnationality_id != ''){
				setTimeout(function(){ 
					select2Set(pd_nationality,dbnationality_id,dbnationality_name_val);
					$('#'+pd_nationality).trigger('change');
				}, 1);
			}

			var pd_title = "pd_title";
			var dbtitle_id = '<?php echo $tittle_id; ?>';
			var dbtitle_name_val = '<?php echo $tittle_name; ?>';
			if(dbtitle_id != ''){
				setTimeout(function(){ 
					select2Set(pd_title,dbtitle_id,dbtitle_name_val);
					$('#'+pd_title).trigger('change');
				}, 1);
			}

			var pd_blood_group = "pd_blood_group";
			var dbblood_group_id = '<?php echo $blood_id; ?>';
			var dbblood_group_name_val = '<?php echo $blood_group; ?>';
			if(dbblood_group_id != ''){
				setTimeout(function(){ 
					select2Set(pd_blood_group,dbblood_group_id,dbblood_group_name_val);
					$('#'+pd_blood_group).trigger('change');
				}, 1);
			}

			var phone_no_code = "phone_no_code";
			var phone_no_code_id = '<?php echo $applicant_mob_country_code_id; ?>';
			var phone_no_code_name_val = '<?php echo $applicant_mob_country_code_name; ?>';
			if(phone_no_code_id != ''){
				setTimeout(function(){ 
					select2Set(phone_no_code,phone_no_code_id,phone_no_code_name_val);
					$('#'+phone_no_code).trigger('change');
				}, 1);
			}

			var pd_gender = "pd_gender";
			var dbgender_id = '<?php echo $gender_id; ?>';
			var dbgender_name_val = '<?php echo $gender; ?>';
			if(dbgender_id != ''){
				setTimeout(function(){ 
					select2Set(pd_gender,dbgender_id,dbgender_name_val);
					$('#'+pd_gender).trigger('change');
				}, 1);
			}

			var pd_social_status = "pd_social_status";
			var dbsocial_status_id = '<?php echo $social_status_id; ?>';
			var dbsocial_status_name_val = '<?php echo $social_status; ?>';
			if(dbsocial_status_id != ''){
				setTimeout(function(){ 
					select2Set(pd_social_status,dbsocial_status_id,dbsocial_status_name_val);
					$('#'+pd_social_status).trigger('change');
				}, 1);
			}

			var pd_religion = "pd_religion";
			var dbreligion_id = '<?php echo $religion_id; ?>';
			var dbreligion_name_val = '<?php echo $religion; ?>';
			if(dbreligion_id != ''){
				setTimeout(function(){ 
					select2Set(pd_religion,dbreligion_id,dbreligion_name_val);
					$('#'+pd_religion).trigger('change');
				}, 1);
			}

			var pd_medium_of_instruction = "pd_medium_of_instruction";
			var dbmedium_of_instruction_id = '<?php echo $medium_of_instruction_id; ?>';
			var dbmedium_of_instruction_name_val = '<?php echo $medium_of_instruction_name; ?>';
			if(dbmedium_of_instruction_id != ''){
				setTimeout(function(){ 
					select2Set(pd_medium_of_instruction,dbmedium_of_instruction_id,dbmedium_of_instruction_name_val);
					$('#'+pd_medium_of_instruction).trigger('change');
				}, 1);
			}

			var pd_hostel_accommodation = "pd_hostel_accommodation";
			var dbhostel_accommodation_id = '<?php echo $hostel_accommodation_select; ?>';
			var dbhostel_accommodation_name_val = '<?php echo $hostel_accommodation_select_name; ?>';
			if(dbhostel_accommodation_id != ''){
				setTimeout(function(){ 
					select2Set(pd_hostel_accommodation,dbhostel_accommodation_id,dbhostel_accommodation_name_val);
					$('#'+pd_hostel_accommodation).trigger('change');
				}, 1);
			}

			var pd_mother_tongue = "pd_mother_tongue";
			var dbmother_tongue_id = '<?php echo $mother_tongue_id; ?>';
			var dbmother_tongue_name_val = '<?php echo $mother_tongue; ?>';
			if(dbmother_tongue_id != ''){
				setTimeout(function(){ 
					select2Set(pd_mother_tongue,dbmother_tongue_id,dbmother_tongue_name_val);
					$('#'+pd_mother_tongue).trigger('change');
				}, 1);
			}

			var pd_advertisement_source = "pd_advertisement_source";
			var dbadvertisement_source_id = '<?php echo $advertisement_source_id; ?>';
			var dbadvertisement_source_name_val = '<?php echo $advertisement_source; ?>';
			if(dbadvertisement_source_id != ''){
				setTimeout(function(){ 
					select2Set(pd_advertisement_source,dbadvertisement_source_id,dbadvertisement_source_name_val);
					$('#'+pd_advertisement_source).trigger('change');
				}, 1);
			}

			var pd_diffrently_abled = "pd_diffrently_abled";
			var dif_abled_select = '<?php echo $dif_abled_select; ?>';
			var dif_abled_select_name = '<?php echo $dif_abled_select_name; ?>';
			if(dif_abled_select != ''){
				setTimeout(function(){ 
					select2Set(pd_diffrently_abled,dif_abled_select,dif_abled_select_name);
					$('#'+pd_diffrently_abled).trigger('change');
				}, 1);
			}

			<?php
            if($applicant_course_course_id) {
                foreach($applicant_course_course_id as $k=>$v) {
                    $course_prefer_k = $k+1;
            ?>
                    var course_pref_<?php echo $course_prefer_k; ?> = "course_pref_<?php echo $course_prefer_k; ?>";
                    var course_pref_id<?php echo $course_prefer_k; ?> = '<?php echo $v; ?>';
                    var course_pref_name<?php echo $course_prefer_k; ?> = '<?php echo $applicant_course_course_name[$k]; ?>';
                     if(course_pref_id<?php echo $course_prefer_k; ?> != ''){
                        setTimeout(function(){ select2Set(course_pref_<?php echo $course_prefer_k; ?>,course_pref_id<?php echo $course_prefer_k; ?>,course_pref_name<?php echo $course_prefer_k; ?>);
                        	$('#'+course_pref_<?php echo $course_prefer_k; ?>).trigger('change');
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
                    var specialization_pref_<?php echo $spec_prefer_k; ?> = "specialization_pref_<?php echo $spec_prefer_k; ?>";
                    var specialization_pref_id<?php echo $spec_prefer_k; ?> = '<?php echo $v; ?>';
                    var specialization_pref_name<?php echo $spec_prefer_k; ?> = '<?php echo $applicant_course_spec_name[$k]; ?>';
                     if(specialization_pref_id<?php echo $spec_prefer_k; ?> != ''){
                        setTimeout(function(){ select2Set(specialization_pref_<?php echo $spec_prefer_k; ?>,specialization_pref_id<?php echo $spec_prefer_k; ?>,specialization_pref_name<?php echo $spec_prefer_k; ?>);
                        	$('#'+specialization_pref_<?php echo $spec_prefer_k; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
            ?>
            <?php
            if($applicant_campus_campus_id) {
                foreach($applicant_campus_campus_id as $k=>$v) {
                    $campus_prefer_k = $k+1;
            ?>
                    var campus_pref_<?php echo $campus_prefer_k; ?> = "campus_pref_<?php echo $campus_prefer_k; ?>";
                    var campus_pref_id<?php echo $campus_prefer_k; ?> = '<?php echo $v; ?>';
                    var campus_pref_name<?php echo $campus_prefer_k; ?> = '<?php echo $applicant_campus_campus_name[$k]; ?>';
                     if(campus_pref_id<?php echo $campus_prefer_k; ?> != ''){
                        setTimeout(function(){ select2Set(campus_pref_<?php echo $campus_prefer_k; ?>,campus_pref_id<?php echo $campus_prefer_k; ?>,campus_pref_name<?php echo $campus_prefer_k; ?>);
                        	$('#'+campus_pref_<?php echo $campus_prefer_k; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
            ?>

            <?php
            if($applicant_city_state_id) {
                foreach($applicant_city_state_id as $k=>$v) {
                    $state_k = $k+1;
            ?>
                    var state_pref_<?php echo $state_k; ?> = "state_pref_<?php echo $state_k; ?>";
                    var state_pref_id<?php echo $state_k; ?> = '<?php echo $v; ?>';
                    var state_pref_name<?php echo $state_k; ?> = '<?php echo $applicant_city_state_name[$k]; ?>';
                     if(state_pref_id<?php echo $state_k; ?> != ''){
                        setTimeout(function(){ select2Set(state_pref_<?php echo $state_k; ?>,state_pref_id<?php echo $state_k; ?>,state_pref_name<?php echo $state_k; ?>);
                        	$('#'+state_pref_<?php echo $state_k; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
            ?>

            <?php
            if($applicant_city_city_id) {
                foreach($applicant_city_city_id as $k=>$v) {
                    $city_k = $k+1;
            ?>
                    var city_pref_<?php echo $city_k; ?> = "city_pref_<?php echo $city_k; ?>";
                    var city_pref_id<?php echo $city_k; ?> = '<?php echo $v; ?>';
                    var city_pref_name<?php echo $city_k; ?> = '<?php echo $applicant_city_city_name[$k]; ?>';
                     if(city_pref_id<?php echo $city_k; ?> != ''){
                        setTimeout(function(){ select2Set(city_pref_<?php echo $city_k; ?>,city_pref_id<?php echo $city_k; ?>,city_pref_name<?php echo $city_k; ?>);
                        	$('#'+city_pref_<?php echo $city_k; ?>).trigger('change');
                        }, 1);
                    }   
            <?php
                }
            }
            ?>

            <?php
            if($applicant_parent_title_id) {
                foreach($applicant_parent_title_id as $k=>$v) {
                	if($k == $parent_type_id_father) {
                		$input_name = 'pd_father_title';
                	} else if ($k == $parent_type_id_mother) {
                		$input_name = 'pd_mother_title';
                	}
            ?>
                    var parent_title<?php echo $k; ?> = '<?php echo $input_name; ?>';
                    var parent_id<?php echo $k; ?> = '<?php echo $v; ?>';
                    var parent_name<?php echo $k; ?> = '<?php echo $applicant_parent_title_name[$k]; ?>';
                     if(parent_id<?php echo $k; ?> != ''){
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
                     if(phone_no_code_id<?php echo $k; ?> != ''){
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
                     if(phone_no_code_id<?php echo $k; ?> != ''){
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
                     if(occupation_id<?php echo $k; ?> != ''){
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

      var board = "board";
			var board_id = '<?php echo $board_id; ?>';
			var board_name = '<?php echo $board_name; ?>';
			if(board_id != ''){
				setTimeout(function(){ 
					select2Set(board,board_id,board_name);
					$('#'+board).trigger('change');
				}, 1);
			}

			var mode_of_study = "mode_of_study";
			var mode_of_study_id = '<?php echo $mode_of_study_id; ?>';
			var mode_of_study_name = '<?php echo $mode_of_study_name; ?>';
			if(mode_of_study_id != ''){
				setTimeout(function(){ 
					select2Set(mode_of_study,mode_of_study_id,mode_of_study_name);
					$('#'+mode_of_study).trigger('change');
				}, 1);
			}

			var marking_scheme = "marking_scheme";
			var marking_scheme_id = '<?php echo $marking_scheme_id; ?>';
			var marking_scheme_name = '<?php echo $marking_scheme_name; ?>';
			if(marking_scheme_id != ''){
				setTimeout(function(){ 
					select2Set(marking_scheme,marking_scheme_id,marking_scheme_name);
					$('#'+marking_scheme).trigger('change');
				}, 1);
			}
			
			<?php
			if($upload_scripts) {
				foreach($upload_scripts as $k=>$v) {
					echo $v."\n";
				}
			}
			?>

			onchangeLableHide('board');
			onchangeLableHide('mode_of_study');
			onchangeLableHide('marking_scheme');
			onchangeLableHide('year_of_passing','date');

      email_suggestion("pd_alt_email","suggestion_alt_email");
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

    function campus_pref_change(spec,campus)
    {
      $('#'+campus).on('change',function() {
        var cur_campusval = $(this).val();
        var test_spec_i = 0;
        $('.test_spec').each(function() {
          
          var this_id = $(this).attr('id');
          var spec_val = $('#'+this_id).val();
          var spec_cur_val = $('#'+spec).val();
         
          if(this_id != spec) {
            // $('.test_city').eq(test_state_i).trigger('change');
            var other_campus_val = $('.test_campus').eq(test_spec_i).val();
            if(other_campus_val == cur_campusval && spec_cur_val == spec_val) {
              $(this).trigger('change');  
            }
          }
          test_spec_i++
        });
      });
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

    function upload_file(file_doc_type, upload_type) {
        upload_type = upload_type || false;

        var parsley_required = $('#'+file_doc_type).attr('data-parsley-required');
        // parsley_required = (parsley_required)?parsley_required:$('#'+file_doc_type).attr('data-required');
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
                	// $('#'+file_doc_type).filestyle({icon: true, input: true, htmlIcon: '<i class="spinner-grow spinner-grow-sm" aria-hidden="true"></i>&nbsp;',text:'Loading...'});
                },
                success: function(returndata) {
                    // console.log(returndata);
                    // console.log(returndata.data.data);
                    // $('#'+file_doc_type).filestyle({icon: true, input: true, htmlIcon: '<i class="fa fa-folder-open" aria-hidden="true"></i>&nbsp;'});
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
                            filename_html += '<!-- <span class="file_name  mt-3"><a class="image-popup-vertical-fit" href="<?php echo base_url(); ?>'+file_path+'" target="_blank" title="'+file_name_user+'">'+file_name_truncate+' <i class="fa fa-eye" aria-hidden="true"></i></a></span><a href="javascript:void(0)" data-del-file-id="'+id+'" data-doc-id="'+doc_id+'" data-toggle="modal" data-target="#contentDeletePop" data-field="'+file_doc_type+'" data-required="'+parsley_required+'" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a> --><div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_'+doc_id+'"><a href="#" class="close" onclick="hideAlert(\'deleteMessage_'+doc_id+'\')">&times;</a><strong id="deleteMessageStatus_'+doc_id+'"></strong> <span id="deleteMessageSpan_'+doc_id+'"></span></div>';
                            filename_ids.push(id);
                        });
                        $('#'+file_doc_type).parent().find('span.file_name').remove();
                        $('#'+file_doc_type).parent().find('[data-del-file-id]').remove();
                        $('#'+file_doc_type).parent().find('.alert').remove();
                        $('#'+file_doc_type).parent().append(filename_html);
                        $('#'+file_doc_type).attr('data-file-count',db_file_count);
                        $('#'+file_doc_type).attr('data-file-id',filename_ids.join(','));
                        $('#'+file_doc_type).attr('data-parsley-required','false');
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
                        $('#'+file_doc_type).parent().append('<!-- <span class="file_name  mt-3"><a class="image-popup-vertical-fit" href="<?php echo base_url(); ?>'+file_path+'" target="_blank" title="'+file_name_user+'">'+file_name_truncate+' <i class="fa fa-eye" aria-hidden="true"></i></a></span><a href="javascript:void(0)" data-del-file-id="'+id+'" data-doc-id="'+doc_id+'" data-toggle="modal" data-target="#contentDeletePop" data-field="'+file_doc_type+'" data-required="'+parsley_required+'" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a> --><div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_'+doc_id+'"><a href="#" class="close" onclick="hideAlert(\'deleteMessage_'+doc_id+'\')">&times;</a><strong id="deleteMessageStatus_'+doc_id+'"></strong> <span id="deleteMessageSpan_'+doc_id+'"></span></div>');
                        setTimeout(function() { 
                        	upload_file_set_download_delete_options(file_doc_type, file_name, file_path, doc_id, id, parsley_required,mode_edit_url);
                        }, 100);
                        

                        $('#'+file_doc_type).attr('data-file-id',id);
                        $('#'+file_doc_type).attr('data-parsley-required','false');
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
        // console.log('id => '+id);
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
        // console.log('data_del_file_id => '+data_del_file_id);
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
                    
                    upload_file_unset_download_delete_options(field);

                    $('#' + spanId).text(msg);
                    setTimeout(function () {
                        $('#' + divId).hide('slow');
                        // $('#'+field).parsley().isRequired = (required == 'true')?true:false;
                        $('#'+field).attr('data-parsley-required',required);
	                    $('#'+field).parsley().validate();
	                    $('#'+field).parsley().isValid();
	                    $('#'+field).removeClass('parsley-success');
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

    function basic_change() {
    	var study_india_id = $("#studied_from_india").val();
        var pd_nationality = $("#pd_nationality").val();
        // console.log(study_india_id);
        // console.log(pd_nationality);
        var indian = pd_nationality == country_value_default;

        if ((study_india_id == 'no' && indian) || (study_india_id == 'yes' && !indian)) {
            $("#indian").show();
            $("#indian2").hide();
            if(pd_nationality && study_india_id) {
            	$('#i_agree').attr('data-parsley-required',"true");
            }
        }
        else if (study_india_id == 'no' && !indian) {
            $("#indian").hide();
            $("#indian2").show();
            $('#i_agree').attr('data-parsley-required',"false");
        } else {
        	$("#indian").hide();
            $("#indian2").hide();
            $('#i_agree').attr('data-parsley-required',"false");
        }
    }

    function test_state_pref(state,state_placeholder) {
		getSelect2(state,'<?php echo base_url("get_states"); ?>?country_id='+country_value_default+	'&sort_by=id&sort_order=asc'+url_edit,state_placeholder, formatRepoCommon,no_state_msg, false, formatRepoSelection);
    }

    function test_state_pref_change(state,city,city_div,city_placeholder) {
    	$('#'+state).on('change',function() {
			setEmptyOnChangeSelect2(city);
			if ($('#'+city).data('select2')) {
				$('#'+city).select2('destroy');
			}				
			$('#'+city).html(''); // reset select values for, if user selected the value then change the country code, then select same value, and value will be null, that so we reset the select values				
			var state_val = $(this).val();
			//  console.log("state_val "+state_val);
			$('#'+city_div).show();
			var exclude_city_ids = [];
			$('.test_city').each(function() {
				var this_id = $(this).attr('id');
				// console.log('this_id => '+this_id);
				// console.log('city => '+city);
				
				if(this_id != city) {
					var val = $(this).val();
					// console.log('val => '+val);
					if(val) {
						exclude_city_ids.push(val);	
					}
				}
			})
			if($(exclude_city_ids).length > 0) {
				exclude_city_ids = exclude_city_ids.join(',');
			}
			getSelect2(city,'<?php echo base_url("get_cities"); ?>?state_id='+state_val+'&sort_by=id&sort_order=asc&exclude_city_ids='+exclude_city_ids+url_edit,city_placeholder, formatRepoCommon,no_city_msg, false, formatRepoSelection);
		});
    }

    function test_city_pref_change(state,city) {
    	$('#'+city).on('change',function() {
    		var cur_city_val = $(this).val();
    		var test_state_i = 0;
    		$('.test_state').each(function() {
    			var this_id = $(this).attr('id');
    			if(this_id != state) {
    				// $('.test_city').eq(test_state_i).trigger('change');
    				var other_city_val = $('.test_city').eq(test_state_i).val();
    				if(other_city_val == cur_city_val) {
    					$(this).trigger('change');	
    				}
    			}
    			test_state_i++
    		});
    	});
    }

    function course_pref_change(course,spec,spec_div,spec_placeholder) {
    	$('#'+course).on('change',function() {
			setEmptyOnChangeSelect2(spec);
			if ($('#'+spec).data('select2')) {
				$('#'+spec).select2('destroy');
			}				
			$('#'+spec).html(''); 			
			var course_val = $(this).val();
			//  console.log("course_val "+course_val);
			$('#'+spec_div).show();
			// getSelect2(spec,'<?php echo base_url("get_specializations"); ?>?course_id='+course_val+'&is_lookup_master=1&is_spec=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&sort_by=id&sort_order=asc',spec_placeholder, formatRepoCommon,no_specialization_msg, false, formatRepoSelection);
			getSelect2(spec,'<?php echo base_url("get_choice_dropdown"); ?>?branch_id='+course_val+'&is_lookup_master=1&is_spec=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc'+url_edit,spec_placeholder, formatRepoCommon,no_specialization_msg, false, formatRepoSelection);
		});
    }
    function spec_pref_change(course,spec,campus,campus_div,campus_placeholder) {
    	$('#'+spec).on('change',function() {
			setEmptyOnChangeSelect2(campus);
			if ($('#'+campus).data('select2')) {
				$('#'+campus).select2('destroy');
			}				
			$('#'+campus).html(''); 			
			var spec_val = $(this).val();
			var course_val = $('#'+course).val();
      
			$('#'+campus_div).show();
      var exclude_campuspref_ids = [];
      $('.test_campus').each(function() {
        var this_id = $(this).attr('id');
        if(this_id != campus) {
          var val = $(this).val();
          var lastchar = this_id.substr(-1);
          var spec_other_val = $("#specialization_pref_"+lastchar).val();
          if(spec_val == spec_other_val){
            if(val) { exclude_campuspref_ids.push(val); }
          }
      }
      });
      
			/*getSelect2(campus,'<?php echo base_url("get_choice_dropdown"); ?>?spec_id='+spec_val+'&branch_id='+course_val+'&is_lookup_master=1&is_campus=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc',campus_placeholder, formatRepoCommon,no_campus_msg, false, formatRepoSelection);*/
      getSelect2(campus,'<?php echo base_url("get_choice_dropdown"); ?>?spec_id='+spec_val+'&branch_id='+course_val+'&is_lookup_master=1&is_campus=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc&exclude_campuspref_ids='+exclude_campuspref_ids+url_edit,campus_placeholder, formatRepoCommon,no_campus_msg, false, formatRepoSelection);
		});
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
	  $("#pd_guardian_phone").attr('data-parsley-mobileonly','false');
      $("#custom-pd_guardian_occupation-parsley-error").hide();
      $("#custom-pd_guardian_phone-parsley-error").hide();
      $("#custom-pd_guardian_email-parsley-error").hide();

      $("input[name=pd_guardian_email]").parsley().reset();
      $("input[name=pd_guardian_name]").parsley().reset();
      $("select[name=pd_guardian_occupation]").parsley().reset();
      $("input[name=pd_guardian_phone]").parsley().reset();
		}
    }

    function declaration_func(currentIndex) {
    	var photograph = $('#photograph').parsley();
        var signature = $('#signature').parsley();
        var applicant_name = $('#applicant_name').parsley();
        var parent_name = $('#parent_name').parsley();
        var declaration_date = $('#declaration_date').parsley();
        if(photograph.isValid() && signature.isValid() && applicant_name.isValid() && parent_name.isValid() && declaration_date.isValid()) {
        	var applicant_name 	=	$('#applicant_name').val();
        	var parent_name 	=	$('#parent_name').val();
        	var declaration_date 	=	$('#declaration_date').val();
          var csrfHashRegenerateonDec = $("input[name='"+csrfName+"']").val();
        	var userData = 'applicant_name='+applicant_name+'&parent_name='+parent_name+'&declaration_date='+declaration_date+'&'+csrfName+'='+csrfHashRegenerateonDec;
        	var moveNxt=0;
        	var AjaxRequest = $.ajax({
				type: 'POST',
				url: url,
				// data: userData+'&currentIndex='+currentIndex+'&<?php //echo $this->security->get_csrf_token_name(); ?>=<?php //echo $this->security->get_csrf_hash(); ?>',
				data: userData+'&currentIndex='+currentIndex,
				dataType: 'json',
				cache: false,
				async: false,
				success: function(returndata) {
					if(returndata) {																																				
						if(returndata.status == 'true') {
							$("#formerr").hide();
							moveNxt=1;
							setTimeout(function() { window.location.href = redirect+url_edit; }, 100);
						}									
					}

				},
				error: function(returndata) {
					moveNxt=0;
					  console.log(returndata);
					  $("#formerr").show(); 							  
					  return false;
				},
			});					

			return AjaxRequest;
            // return true;       
        } else {
        	photograph.validate();
        	signature.validate();
        	applicant_name.validate();
        	parent_name.validate();
        	declaration_date.validate();
            return false;
        }
    }

    
</script>