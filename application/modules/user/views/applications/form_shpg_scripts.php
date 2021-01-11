<?php
$app_form_id_shpg= APP_FORM_ID_SHPG;
$parent_type_id_father = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
$document_id_tenth_marksheet = DOCUMENT_ID_TENTH_MARKSHEET;
$document_id_twelvfth_marksheet = DOCUMENT_ID_TWELVFTH_MARKSHEET;
$document_id_graduation_marksheet =DOCUMENT_ID_GRADUATION_MARKSHEET;

if($applicant_application_details_list) {
    foreach($applicant_application_details_list as $k=>$v) {
        $appln_form_id = $v['appln_form_id'];
        if($app_form_id_shpg == $appln_form_id) {
            $applicant_appln_id = $v['applicant_appln_id'];
            $qualifyingexamfromindia = $v['qualifyingexamfromindia'];
            $i_confirmChecked=$v['is_agree'];
        }
    }
}
$qualifyingexamfromindia=isset($qualifyingexamfromindia)?$qualifyingexamfromindia:'';
$i_confirmChecked=isset($i_confirmChecked) ? $i_confirmChecked:'';


$add_gardian=isset($applicant_other_details_list['add_gardian'])?$applicant_other_details_list['add_gardian']:'';
$qualificationList=$this->config->item('hcma_current_qualification_status');
$tenthList=$this->config->item('tenth_status');

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

$course_id=isset($applicant_course_details_list['course_id']) ? $applicant_course_details_list['course_id'] :'';
$course_name=isset($applicant_course_details_list['course_name']) ? $applicant_course_details_list['course_name'] :'';
$ugCourse=HCMA_UG_COURSE;
if(!empty($applicant_application_details_list))
{
    $applicant_appln_id=$applicant_application_details_list[0]['applicant_appln_id'];
    $grad_id=$applicant_application_details_list[0]['grad_id'];
    $grad_name=$applicant_application_details_list[0]['grade_name'];
    $qual_status_id=$applicant_application_details_list[0]['qual_status_id'];
    $qual_status_name=$applicant_application_details_list[0]['qual_status_name'];
    
}
$applicant_appln_id=!empty($applicant_appln_id) ? $applicant_appln_id :false;
$grad_id=!empty($grad_id) ? $grad_id :'';
$qual_status_id=!empty($qual_status_id) ? $qual_status_id :'';
$qual_status_name=!empty($qual_status_name) ? $qual_status_name :'Select';
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
        $file_doc_type = (($document_id_photograph == $document_id)?'photograph':(($document_id_signature == $document_id)?'signature':(($document_id_tenth_marksheet == $document_id)?'tenth_marksheet':(($document_id_twelvfth_marksheet == $document_id)?'twelvfth_marksheet':(($document_id_graduation_marksheet == $document_id)?'graduation_marksheet' :'')))));
        $parsley_required = (($document_id_photograph == $document_id)?'true':(($document_id_signature == $document_id)?'true':(($document_id_tenth_marksheet == $document_id)?'true':(($document_id_twelvfth_marksheet == $document_id)?'true':(($document_id_graduation_marksheet == $document_id)?'true':'')))));
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
$applicant_name=isset($applicant_application_details_list[0]['applicant_name_declaration'])?$applicant_application_details_list[0]['applicant_name_declaration']:'';
$parent_name=isset($applicant_application_details_list[0]['applicant_parentname_declaration'])?$applicant_application_details_list[0]['applicant_parentname_declaration']:'';

?>
<script>
var url = "<?php echo base_url(); ?>/shpg";
var country_value_default = '<?php echo COUNTRY_VALUE_DEFAULT; ?>';
var otherboard='<?php echo OTHER_BOARD;?>';
var logged_applicant_id = '<?php echo $logged_applicant_id; ?>';
var logged_applicant_login_id = '<?php echo $logged_applicant_login_id; ?>';
var redirect = '<?php echo base_url()."thank_you"; ?>';
var app_form_id = '<?php echo $app_form_id_shpg; ?>';
var applicant_appln_id = '<?php echo $applicant_appln_id;?>';
var otheroccupation='<?php echo OTHER_OCCUPATION;?>';
var otherstream='<?php echo OTHER_STREAM;?>';
var grad_id='<?php echo $grad_id;?>';
var otheruniversity='<?php echo OTHER_UNIVERSITY;?>';
var pg_diploma='<?php echo PG_DIPLOMA_GRAD;?>';
$(document).ready(function () {
    'use strict';  
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
        startIndex:0,

        /* Transition Effects */
        transitionEffect: 'slide', //$.fn.steps.transitionEffect.none,
        transitionEffectSpeed: 200,
		/* Events */
        onStepChanging: function (event, currentIndex, newIndex) { 
            // if(currentIndex > newIndex)
            // {
				 // return true;
            // }	
			if(currentIndex < newIndex) {
				// Step 1 form validation
				 if(currentIndex === 0) {	                 
					  var non_indian_resident = $('#non_indian_resident').parsley();
					  var i_confirm = $('#i_confirm').parsley();
					  var studied_from_india = $('#studied_from_india').parsley();
					  var i_confirm_val = $('#i_confirm').val();
    				  var studied_from_india_val = $('#studied_from_india').val();
    				  var non_indian_resident_val = $('#non_indian_resident').val();
					 
					  if(studied_from_india.isValid() && i_confirm.isValid() && non_indian_resident.isValid() && (studied_from_india_val=="yes" ||studied_from_india_val=="t")) 
					  {	
						 var user_data ='i_confirm='+i_confirm_val+
						'&studied_from_india='+studied_from_india_val+
						'&applicant_appln_id='+applicant_appln_id;						
                         console.log(user_data);
                         var moveNxt=0;
							$.ajax({
							type: 'POST',
							url: url,
							data: user_data+'&currentIndex='+currentIndex,
							dataType: 'json',
							cache: false,
							async: false,
							success: function(returndata) {
								if(returndata) {									
									console.log(returndata);																	
									if(returndata.appln_status.status == 'true') {
										$("#formerr").hide();
										moveNxt=1;
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
							
						if(moveNxt){
							return true;
						}						
					  } else {
						non_indian_resident.validate();
					  	i_confirm.validate();
					  	studied_from_india.validate();
					  	if(non_indian_resident.isValid() && non_indian_resident_val!=""){
					  	 $("#halterror").show();
					  	}
						return false;
					  }
					}

					//preference  and personal details
					// Step 2 form validation
					if(currentIndex === 1) {
						var pd_program = $('#pd_program').parsley();
						var pd_campus_pref_1 = $('#campus_pref_1').parsley();
						var pd_course_pref_1 = $('#course_pref_1').parsley();
						var pd_campus_pref_2 = $('#campus_pref_2').parsley();
						var pd_course_pref_2 = $('#course_pref_2').parsley();
					 	  
	                  var pd_title = $('#pd_title').parsley();
					  var pd_firstname = $('#pd_firstname').parsley();
					  var pd_lastname = $('#pd_lastname').parsley();
					  //var pd_middlename = $('#pd_middlename').parsley();
					  var pd_mobile_no = $('#pd_mobile_no').parsley();
					  var pd_email = $('#pd_email').parsley();
					  var pd_dob = $('#pd_dob').parsley();
					  var pd_gender = $('#pd_gender').parsley();
					  //var pd_alt_email = $('#pd_alt_email').parsley();
                      var pd_blood_group = $('#pd_blood_group').parsley();
					 // var pd_religion = $('#pd_religion').parsley();					  
					 // var pd_mother_tongue = $('#pd_mother_tongue').parsley();
					  //var pd_medium_of_instruction = $('#pd_medium_of_instruction').parsley();
					  //var pd_hostel_accomodation = $('#pd_hostel_accomodation').parsley();
					  var pd_diffrently_abled = $('#pd_diffrently_abled').parsley();
					  //var pd_advertisement_source = $('#pd_advertisement_source').parsley();
					  var pd_nationality = $('#pd_nationality').parsley();
					  var pd_social_status = $('#pd_social_status').parsley();
                      if($('#main_div_social_status').is(':visible')){
							$('#pd_social_status').attr('data-parsley-required', 'true');
							$('#pd_social_status').attr('data-parsley-required-message', 'Please Select Social Status');
					  }else{
							$('#pd_social_status').attr('data-parsley-required', 'false');
					  }	
					         if(pd_program.isValid()
							  && pd_campus_pref_1.isValid() 
							  && pd_campus_pref_2.isValid()
							  && pd_course_pref_1.isValid()
							  && pd_course_pref_2.isValid()
							  && pd_title.isValid()
							  && pd_firstname.isValid() && pd_lastname.isValid() 
							  && pd_mobile_no.isValid() && pd_email.isValid()
							  && pd_dob.isValid() && pd_gender.isValid() 
							  && pd_blood_group.isValid() 
							  && pd_diffrently_abled.isValid()
							  && pd_nationality.isValid() 
							  && pd_social_status.isValid()) {

							var program_val = $('#pd_program').val();							

							var course_pref_1_val = $('#course_pref_1').val();							
							var course_choice_no_1_val = $('#course_choice_no_1').val();
							var course_prefer_id_1_val = $('#course_prefer_id_1').val();

							var course_pref_2_val = $('#course_pref_2').val();							
							var course_choice_no_2_val = $('#course_choice_no_2').val();
							var course_prefer_id_2_val = $('#course_prefer_id_2').val();

							var course_pref_3_val = $('#course_pref_3').val();							
							var course_choice_no_3_val = $('#course_choice_no_3').val();
							var course_prefer_id_3_val = $('#course_prefer_id_3').val();
							
							var campus_pref_1_val = $('#campus_pref_1').val();
							var campus_choice_no_1_val = $('#campus_choice_no_1').val();
							var campus_prefer_id_1_val = $('#campus_prefer_id_1').val();

							var campus_pref_2_val = $('#campus_pref_2').val();
							var campus_choice_no_2_val = $('#campus_choice_no_2').val();
							var campus_prefer_id_2_val = $('#campus_prefer_id_2').val();

							var campus_pref_3_val = $('#campus_pref_3').val();
							var campus_choice_no_3_val = $('#campus_choice_no_3').val();
							var campus_prefer_id_3_val = $('#campus_prefer_id_3').val();

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
							var pd_advertisment_source_val = $('#pd_advertisement_source').val();
							var pd_nationality_val = $('#pd_nationality').val();
                            // parent name at declaration 
                            <?php if(empty($applicant_name) || $applicant_name=="")  { ?>
                            $("#applicant_name").val(pd_firstname_val);
                            <?php } ?>
							var user_data = 'pd_program='+program_val+'&course_pref_1='+course_pref_1_val+'&course_prefer_id_1='+course_prefer_id_1_val+'&course_choice_no_1='+course_choice_no_1_val+'&course_pref_2='+course_pref_2_val+'&course_prefer_id_2='+course_prefer_id_2_val+'&course_choice_no_2='+course_choice_no_2_val+'&course_pref_3='+course_pref_3_val+'&course_prefer_id_3='+course_prefer_id_3_val+'&course_choice_no_3='+course_choice_no_3_val+'&campus_pref_1='+campus_pref_1_val+'&campus_choice_no_1='+campus_choice_no_1_val+'&campus_prefer_id_1='+campus_prefer_id_1_val+'&campus_pref_2='+campus_pref_2_val+'&campus_choice_no_2='+campus_choice_no_2_val+'&campus_prefer_id_2='+campus_prefer_id_2_val+'&campus_pref_3='+campus_pref_3_val+'&campus_choice_no_3='+campus_choice_no_3_val+'&campus_prefer_id_3='+campus_prefer_id_3_val+'&pd_title='+pd_title_val+'&pd_firstname='+pd_firstname_val+'&pd_middlename='+pd_middlename_val+'&pd_lastname='+pd_lastname_val+'&phone_no_code='+pd_mobile_no_code_val+'&pd_mobile_no='+pd_mobile_no_val+'&pd_email='+pd_email_val+'&pd_dob='+pd_dob_val+'&pd_gender='+pd_gender_val+'&pd_alt_email='+pd_alt_email_val+'&pd_blood_group='+pd_blood_group_val+'&pd_social_status='+pd_social_status_val+'&pd_diffrently_abled='+pd_diffrently_abled_val+'&pd_religion='+pd_religion_val+'&pd_medium_of_instruction='+pd_medium_of_instruction_val+'&pd_hostel_accommodation='+pd_hostel_accommodation_val+'&pd_mother_tongue='+pd_mother_tongue_val+'&pd_advertisment_source='+pd_advertisment_source_val+'&pd_nationality='+pd_nationality_val;
                            console.log(user_data);
                            var moveNxt=0;
							$.ajax({
								type: 'POST',
								url: url,
								data: user_data+'&currentIndex='+currentIndex,
								dataType: 'json',
								cache: false,
								async: false,
								success: function(returndata) {
									if(returndata) {																																				
										if(returndata.status == 'true') {
											$("#formerr").hide();
											moveNxt=1;											
										}									
									}
								},
								error: function(returndata) {								
								  console.log(returndata); 
								  moveNxt=0;							
								  $("#formerr").show(); 							  
								  return false;
								},
							});						  
							if(moveNxt){
								return true;
							}
					  	} else { 
					  		if(pd_program.isValid()){						
					  		pd_campus_pref_1.validate();
					  		pd_campus_pref_2.validate();	
					  		pd_course_pref_1.validate();
					  		pd_course_pref_2.validate();
					  		}
							pd_program.validate();						
							pd_title.validate();
							pd_firstname.validate();
							pd_lastname.validate();
							pd_mobile_no.validate();
							pd_email.validate();
							pd_dob.validate();
							pd_gender.validate();							
							pd_blood_group.validate();
							pd_social_status.validate();
							pd_diffrently_abled.validate();
							pd_nationality.validate();													
							return false;
					  	}
					}
					//end step2
                   //parent detail step3
					if(currentIndex === 2) {											
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
					
                    if(pd_father_title.isValid() && pd_father_name.isValid() && pd_mother_title.isValid() && pd_mother_name.isValid() && pd_father_email.isValid() && pd_mother_email.isValid() && pd_guardian_name.isValid() && pd_guardian_phone.isValid() && pd_guardian_email.isValid() && pd_father_phone.isValid() && pd_mother_phone.isValid() && pd_guardian_occupation.isValid()){
                    var pd_father_id = $('#pd_father_id').val();
                    var pd_mother_id = $('#pd_mother_id').val();
                    var pd_guardian_id = $('#pd_guardian_id').val();
    				var pd_father_title = $('#pd_father_title').val();
					var pd_father_name = $('#pd_father_name').val();
					var pd_father_phone_no_code = $('#pd_father_phone_no_code').val();
					var pd_father_phone = $('#pd_father_phone').val();
					var pd_father_alt_phone_no_code = $('#pd_father_alt_phone_no_code').val();
					var pd_father_alt_phone = $('#pd_father_alt_phone').val();
					var pd_father_email = $('#pd_father_email').val();
					var pd_father_occupation = $('#pd_father_occupation').val();
					var pd_mother_title = $('#pd_mother_title').val();
					var pd_mother_name = $('#pd_mother_name').val();
					var pd_mother_phone_no_code = $('#pd_mother_phone_no_code').val();
					var pd_mother_phone = $('#pd_mother_phone').val();
					var pd_mother_alt_phone_no_code = $('#pd_mother_alt_phone_no_code').val();
					var pd_mother_alt_phone = $('#pd_mother_alt_phone').val();
					var pd_mother_email = $('#pd_mother_email').val();
					var pd_mother_occupation = $('#pd_mother_occupation').val();
					var add_guardian_checkbox = $('#add_guardian_checkbox').val();
					var pd_guardian_name = $('#pd_guardian_name').val();
					var pd_guardian_phone_no_code = $('#pd_guardian_phone_no_code').val();
					var pd_guardian_phone = $('#pd_guardian_phone').val();
					var pd_guardian_email = $('#pd_guardian_email').val();
					var pd_guardian_occupation = $('#pd_guardian_occupation').val();
                   
					var father_other_occupation_val='';
					var mother_other_occupation_val='';
					var guardian_other_occupation_val='';
					father_other_occupation_val=$('#pd_father_other_occupation').val();
					mother_other_occupation_val=$('#pd_mother_other_occupation').val();
					guardian_other_occupation_val=$('#guardian_other_occupation').val();
                    //set father name at declaration
                    <?php if(empty($parent_name) || $parent_name=="")  { ?>
                    $("#parent_name").val(pd_father_name);
                    <?php } ?>
                    var user_data = 'pd_father_id='+pd_father_id+'&pd_mother_id='+pd_mother_id+'&pd_guardian_id='+pd_guardian_id+'&pd_father_title='+pd_father_title+'&pd_father_name='+pd_father_name+'&pd_father_phone_no_code='+pd_father_phone_no_code+'&pd_father_phone='+pd_father_phone+'&pd_father_alt_phone_no_code='+pd_father_alt_phone_no_code+'&pd_father_alt_phone='+pd_father_alt_phone+'&pd_father_email='+pd_father_email+'&pd_father_occupation='+pd_father_occupation+'&father_other_occupation='+father_other_occupation_val+'&pd_mother_title='+pd_mother_title+'&pd_mother_name='+pd_mother_name+'&pd_mother_phone_no_code='+pd_mother_phone_no_code+'&pd_mother_alt_phone_no_code='+pd_mother_alt_phone_no_code+'&pd_mother_email='+pd_mother_email+'&pd_mother_occupation='+pd_mother_occupation+'&mother_other_occupation='+mother_other_occupation_val+'&add_guardian_checkbox='+add_guardian_checkbox+'&pd_guardian_name='+pd_guardian_name+'&pd_guardian_phone_no_code='+pd_guardian_phone_no_code+'&pd_guardian_phone='+pd_guardian_phone+'&pd_guardian_email='+pd_guardian_email+'&pd_guardian_occupation='+pd_guardian_occupation+'&guardian_other_occupation='+guardian_other_occupation_val+'&pd_mother_phone='+pd_mother_phone+'&pd_mother_alt_phone='+pd_mother_alt_phone;
                    console.log(user_data);
                    var moveNxt=0;
                    $.ajax({
							type: 'POST',
							url: url,
							data: user_data+'&currentIndex='+currentIndex,
							dataType: 'json',
							cache: false,
							async: false,
							success: function(returndata) {
								if(returndata) {
									$("#formerr").hide();
									console.log(returndata);																	
									if(returndata[0].status == 'true') {
										moveNxt=1;										
									}									
								}	
							},
							error: function(returndata) {
							  console.log(returndata);
							  moveNxt=0;							
							  $("#formerr").show(); 							  
							  return false; 
							},
						});							
                    if(moveNxt){
						return true;
					}
					}else{
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
						return false;						
					}
				}
				//end step3

					// Step 4 address form validation
					if(currentIndex === 3) {
					  //return true;
					  var country_addr = $('#country_addr').parsley();
					  var state_addr = $('#state_addr').parsley();
					  var district_addr = $('#district_addr').parsley();
					  var city_addr = $('#city_addr').parsley();
					  var address1 = $('#address_line1').parsley();
					  var pincode = $('#pincode').parsley();
					  if(country_addr.isValid() && state_addr.isValid() && district_addr.isValid() 
					  	&& city_addr.isValid() && address1.isValid() && pincode.isValid()) {
					  	var country_id 	= 	$('#country_addr').val();
					  	var state_id 	= 	$('#state_addr').val();
					  	var district_id = 	$('#district_addr').val();
					  	var city_id     = 	$('#city_addr').val();
					  	var address1    =  	$('#address_line1').val();
					  	var address2    =  	$('#address_line2').val();
					  	var pincode 	=	$('#pincode').val();
					 
					  	var userData = 'country_id='+country_id+'&state_id='+state_id+'&district_id='+district_id+'&city_id='+city_id+'&address_line_1='+address1+'&address_line_2='+address2+'&pincode='+pincode;
					    var moveNxt=0;
						$.ajax({
							type: 'POST',
							url: url,
							data: userData+'&currentIndex='+currentIndex,
							dataType: 'json',
							cache: false,
							async: false,
							success: function(returndata) {
								if(returndata){									
    								if(returndata.status == 'true') {
    									$("#formerr").hide();
    									moveNxt=1;										
    								}
								}
							},
							error: function(returndata) {
							  console.log(returndata); 
							  moveNxt=0;							
							  $("#formerr").show(); 							  
							  return false;
							},
						});							
						if(moveNxt){
							return true;
						}
					  } else { 
						country_addr.validate();
						state_addr.validate();
						district_addr.validate();
						city_addr.validate();
						address1.validate();
						pincode.validate();
						return false;
					  }
					}
					//end step 4

				//step 5- academics
				if(currentIndex === 4) {
					var candidate_name = $('#candidate_name').parsley();
					var current_qualification_status = $('#current_qualification_status').parsley();

					  var academic_tenth_inst = $('#academic_tenth_inst').parsley();
					  var academic_board = $('#academic_board').parsley();
					  var academic_marking_scheme = $('#academic_marking_scheme').parsley();
					  var academic_obtain_cgpa = $('#academic_obtain_cgpa').parsley();
					  var academic_yr_passing = $('#academic_yr_passing').parsley();
					  var academic_reg_no = $('#academic_reg_no').parsley();
					  
					  var academic_twelfth_inst = $('#academic_twelfth_inst').parsley();
					  var academic_twelfth_board = $('#academic_twelfth_board').parsley();
					  var academic_marking_scheme_twelfth = $('#academic_marking_scheme_twelfth').parsley();
					  var academic_obtain_cgpa_twelfth = $('#academic_obtain_cgpa_twelfth').parsley();
					  var academic_yr_passing_twelfth = $('#academic_yr_passing_twelfth').parsley();
					  var academic_reg_no_twelfth = $('#academic_reg_no_twelfth').parsley();
					  var academic_stream = $('#academic_stream').parsley();

					  var academic_eleven_inst = $('#academic_eleven_inst').parsley();
					  var academic_eleven_board = $('#academic_eleven_board').parsley();
					  var academic_marking_scheme_eleven = $('#academic_marking_scheme_eleven').parsley();
					  var academic_obtain_cgpa_eleven = $('#academic_obtain_cgpa_eleven').parsley();
					  var academic_yr_passing_eleven = $('#academic_yr_passing_eleven').parsley();
					  var academic_reg_no_eleven = $('#academic_reg_no_eleven').parsley();

					  var institute_name_ug = $('#institute_name_ug').parsley();
					  var university_ug = $('#university_ug').parsley();
					  var user_marking_scheme_ug = $('#user_marking_scheme_ug').parsley();
					  var obtained_percentage_cgpa_ug = $('#obtained_percentage_cgpa_ug').parsley();
					  var yr_passing_ug = $('#yr_passing_ug').parsley();
					  var register_no_ug = $('#register_no_ug').parsley();
					  var degree_ug = $('#degree_ug').parsley();

					  /*var institute_name_pg = $('#institute_name_pg').parsley();
					  var university_pg = $('#university_pg').parsley();
					  var user_marking_scheme_pg = $('#user_marking_scheme_pg').parsley();
					  var obtained_percentage_cgpa_pg = $('#obtained_percentage_cgpa_pg').parsley();
					  var yr_passing_pg = $('#yr_passing_pg').parsley();
					  var register_no_pg = $('#register_no_pg').parsley();
					  var degree_pg = $('#degree_pg').parsley();*/
					  
					  if(current_qualification_status.isValid() && candidate_name.isValid() && academic_tenth_inst.isValid() && academic_board.isValid()  && academic_marking_scheme.isValid() && academic_obtain_cgpa.isValid() && academic_yr_passing.isValid() && academic_reg_no.isValid() && academic_twelfth_inst.isValid() && academic_twelfth_board.isValid() && academic_marking_scheme_twelfth.isValid() && academic_obtain_cgpa_twelfth.isValid() && academic_yr_passing_twelfth.isValid() && academic_reg_no_twelfth.isValid() && academic_stream.isValid() &&   institute_name_ug.isValid() && university_ug.isValid() && user_marking_scheme_ug.isValid() && obtained_percentage_cgpa_ug.isValid() && yr_passing_ug.isValid() && register_no_ug.isValid() && degree_ug.isValid() ) {

						    var current_qualification_status_val	= 	$('#current_qualification_status').val();
							var candidate_name_val 	= 	$('#candidate_name').val();
							var academic_tenth_inst_val 	= 	$('#academic_tenth_inst').val();
							var academic_board_val 	= 	$('#academic_board').val();
							var other_tenth_board_val="";
							var other_tenth_board_val=$('#other_tenth_board').val();
							var academic_marking_scheme_val = $('#academic_marking_scheme').val();
							var academic_obtain_cgpa_val = $('#academic_obtain_cgpa').val();
							var academic_yr_passing_val = $('#academic_yr_passing').val();
							var academic_reg_no_val = $('#academic_reg_no').val();
							
							var academic_twelfth_inst_val 	= 	$('#academic_twelfth_inst').val();
							var academic_twelfth_board_val 	= 	$('#academic_twelfth_board').val();
							var other_twelfth_board_val="";
							var other_twelfth_board_val=$('#other_twelfth_board').val();
							
							var academic_twelfth_marking_scheme_val = $('#academic_marking_scheme_twelfth').val();
							var academic_twelfth_obtain_cgpa_val = $('#academic_obtain_cgpa_twelfth').val();
							var academic_twelfth_yr_passing_val = $('#academic_yr_passing_twelfth').val();
							var academic_twelfth_reg_no_val = $('#academic_reg_no_twelfth').val();
							var digilocker_id_val= $('#digilocker_id').val();
	                        var academic_twelfth_stream_val="";
							academic_twelfth_stream_val = $('#academic_stream').val();
							var academic_twelfth_stream_o_val="";
							academic_twelfth_stream_o_val = $('#academic_stream_other').val();
                            //11th
                            
                            var academic_eleven_inst_val 	= 	$('#academic_eleven_inst').val();
							var academic_eleven_board_val 	= 	$('#academic_eleven_board').val();
							var other_eleven_board_val="";
							var other_eleven_board_val=$('#other_eleven_board').val();
							var academic_eleven_marking_scheme_val = $('#academic_marking_scheme_eleven').val();
							var academic_eleven_obtain_cgpa_val = $('#academic_obtain_cgpa_eleven').val();
							var academic_eleven_yr_passing_val = $('#academic_yr_passing_eleven').val();
							var academic_eleven_reg_no_val = $('#academic_reg_no_eleven').val();
							
	                        var schooling_id_tenth_val="";
	                        schooling_id_tenth_val = $('#schooling_id_tenth').val();
	                        var schooling_id_eleven_val="";
	                        schooling_id_eleven_val = $('#schooling_id_eleven').val();
							

							var schooling_id_twelfth_val="";
							schooling_id_twelfth_val = $('#schooling_id_twelfth').val();

							var institute_name_ug_val 	= 	$('#institute_name_ug').val();
							var university_ug_val 	= 	$('#university_ug').val();
							var university_other_ug_val="";
							var university_other_ug_val=$('#university_other_ug').val();
							var user_marking_scheme_ug_val = $('#user_marking_scheme_ug').val();
							var obtained_percentage_cgpa_ug_val = $('#obtained_percentage_cgpa_ug').val();
							var yr_passing_ug_val = $('#yr_passing_ug').val();
							var register_no_ug_val = $('#register_no_ug').val();
							var degree_ug_val = $('#degree_ug').val();
							var grad_id_ug=	$('#grad_id_ug').val();
							
							/*var institute_name_pg_val 	= 	$('#institute_name_pg').val();
							var university_pg_val 	= 	$('#university_pg').val();
							var university_other_pg_val="";
							var university_other_pg_val=$('#university_other_pg').val();
							var user_marking_scheme_pg_val = $('#user_marking_scheme_pg').val();
							var obtained_percentage_cgpa_pg_val = $('#obtained_percentage_cgpa_pg').val();
							var yr_passing_pg_val = $('#yr_passing_pg').val();
							var register_no_pg_val = $('#register_no_pg').val();
							var degree_pg_val = $('#degree_pg').val();
							var grad_id_pg=	$('#grad_id_pg').val();*/
							
							var user_data = 'current_qualification_status='+current_qualification_status_val+'&candidate_name='+candidate_name_val+'&academic_tenth_inst='+academic_tenth_inst_val+'&academic_tenth_board='+academic_board_val+'&other_tenth_board='+other_tenth_board_val+'&academic_tenth_msv='+academic_marking_scheme_val+'&academic_tenth_cgpa='+academic_obtain_cgpa_val+'&academic_tenth_yrp='+academic_yr_passing_val+'&academic_tenth_regno='+academic_reg_no_val+'&academic_twelfth_inst='+academic_twelfth_inst_val+'&academic_twelfth_board='+academic_twelfth_board_val+'&other_twelfth_board='+other_twelfth_board_val+'&academic_twelfth_msv='+academic_twelfth_marking_scheme_val+'&academic_twelfth_cgpa='+academic_twelfth_obtain_cgpa_val+'&academic_twelfth_yrp='+academic_twelfth_yr_passing_val+'&academic_twelfth_regno='+academic_twelfth_reg_no_val+'&academic_eleven_inst='+academic_eleven_inst_val+'&academic_eleven_board='+academic_eleven_board_val+'&other_eleven_board='+other_eleven_board_val+'&academic_eleven_msv='+academic_eleven_marking_scheme_val+'&academic_eleven_cgpa='+academic_eleven_obtain_cgpa_val+'&academic_eleven_yrp='+academic_eleven_yr_passing_val+'&academic_eleven_regno='+academic_eleven_reg_no_val+'&digilocker_id='+digilocker_id_val+'&stream_name='+academic_twelfth_stream_val+'&other_stream_name='+academic_twelfth_stream_o_val+'&schooling_id_tenth='+schooling_id_tenth_val+'&schooling_id_twelfth='+schooling_id_twelfth_val+'&schooling_id_eleven='+schooling_id_eleven_val+'&grad_id_ug='+grad_id_ug+'&institute_name_ug='+institute_name_ug_val+'&university_ug='+university_ug_val+'&university_other_ug='+university_other_ug_val+'&marking_scheme_ug='+user_marking_scheme_ug_val+'&obtained_percentage_cgpa_ug='+obtained_percentage_cgpa_ug_val+'&yr_passing_ug='+yr_passing_ug_val+'&register_no_ug='+register_no_ug_val+'&degree_ug='+degree_ug_val;
	                        console.log(user_data);
	                        var moveNxt=0;
	                        $.ajax({
								type: 'POST',
								url: url,
								data: user_data+'&currentIndex='+currentIndex,
								dataType: 'json',
								cache: false,
								async: false,
								success: function(returndata) {
									if(returndata){									
	    								if(returndata.status == 'true') {
	    									$("#formerr").hide();
	    									moveNxt=1;										
	    								}
									}
								},
								error: function(returndata) {
									console.log(returndata);
									  moveNxt=0;							
									  $("#formerr").show(); 							  
									  return false; 
								},
							});	
	                       					
	                        if(moveNxt){
								return true;
							}
						}else{					
							candidate_name.validate();
							current_qualification_status.validate();
							academic_tenth_inst.validate();
							academic_board.validate();						
							academic_marking_scheme.validate();
							academic_obtain_cgpa.validate();
							academic_yr_passing.validate();

							academic_reg_no.validate();
							academic_eleven_inst.validate();
							academic_eleven_board.validate();						
							academic_marking_scheme_eleven.validate();
							academic_obtain_cgpa_eleven.validate();
							academic_yr_passing_eleven.validate();
							academic_reg_no_eleven.validate();
							
							academic_twelfth_inst.validate();
							academic_twelfth_board.validate();						
							academic_marking_scheme_twelfth.validate();
							academic_obtain_cgpa_twelfth.validate();
							academic_yr_passing_twelfth.validate();
							academic_reg_no_twelfth.validate();
							academic_stream.validate();

							institute_name_ug.validate();
							university_ug.validate();						
							user_marking_scheme_ug.validate();
							obtained_percentage_cgpa_ug.validate();
							yr_passing_ug.validate();
							register_no_ug.validate();
							degree_ug.validate();

							/*institute_name_pg.validate();
							university_pg.validate();						
							user_marking_scheme_pg.validate();
							obtained_percentage_cgpa_pg.validate();
							yr_passing_pg.validate();
							register_no_pg.validate();
							degree_pg.validate();*/
							return false;
						}
				}
					//end step5 academics
                //step 6 -payment
				if(currentIndex === 5) {
	                    return true;
	            }
				//step 6 -payment end

				if(currentIndex == 6) {
						var applicant_name = $('#applicant_name').val();
						var applicant_name = $('#parent_name').val();
						var declaration_date = $('#date_dec').val();
						
						var user_data = 'applicant_name='+applicant_name+'&parent_name='+parent_name+'&declaration_date='+declaration_date;
						var moveNxt=0;
						$.ajax({
							type: 'POST',
							url: url,
							data: user_data+'&currentIndex='+currentIndex,
							dataType: 'json',
							cache: false,
							async: false,
							success: function(returndata) {
								if(returndata.status == 'true') {
									$("#formerr").hide();
									moveNxt=1;										
								}
							},
							error: function(returndata) {
							  console.log(returndata); 
							},
						});
						
						 if(moveNxt){
							return true;
						}
					}
				
			}
			else { 
				return true; 
			}				
		},
		saveState: true,
        onStepChanged: function (event, currentIndex, priorIndex)
        { 
        	if(currentIndex==4){
				$(".actions ul > li:nth-child(2) a").text('<?php echo MAKE_PAYMENT; ?>');
			}else{
				$(".actions ul > li:nth-child(2) a").text('<?php echo NEXT_STEP; ?>');
			}

    	}, 
        onCanceled: function (event) { },
        onFinishing: function (event, currentIndex) { return true; }, 
        onFinished: function (event, currentIndex) {            
             var photograph=$('#photograph').parsley();
        	 var signature=$('#signature').parsley();
        	 var tenth_marksheet=$('#tenth_marksheet').parsley();
        	 var twelvfth_marksheet=$('#twelvfth_marksheet').parsley();
        	 var graduation_marksheet=$('#graduation_marksheet').parsley();
	        	
        	 var applicant_name=$('#applicant_name').parsley();
        	 var parent_name=$('#parent_name').parsley();
             
        	var applicant_name_val = $('#applicant_name').val();
            var parent_name_val = $('#parent_name').val();
           
            var declaration_date = $('#date_dec').val();
            var user_data = 'applicant_name='+applicant_name_val+'&parent_name='+parent_name_val+'&declaration_date='+declaration_date;
            if(photograph.isValid() && signature.isValid() && tenth_marksheet.isValid() && twelvfth_marksheet.isValid() && graduation_marksheet.isValid() && applicant_name.isValid() && parent_name.isValid())
            {
			$.ajax({
				type: 'POST',
				url: url,
				data: user_data+'&currentIndex='+currentIndex,
				dataType: 'json',
				cache: false,
				async: false,
				success: function(returndata) {
					if(returndata){					
					if(returndata.status == 'true') {
					$("#formerr").hide();
					 setTimeout(function() { window.location.href = redirect; }, 100);
					}
				  }
				},
				error: function(returndata) {
				  console.log(returndata);
				  moveNxt=0;							
				  $("#formerr").show();
				 // setTimeout(function() { window.location.href = redirect; }, 100);
					 
				},
			});
            }else{
            	photograph.validate();
            	signature.validate();						
            	tenth_marksheet.validate();
            	twelvfth_marksheet.validate();
            	graduation_marksheet.validate();
            	applicant_name.validate();
            	parent_name.validate();
            }
				
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
	
	$("#shpg_form").steps(settings);
    light_box_init();
		
	 $(document).ready(function () {
		 $('#academic_accordion').click();
		var no_study_resident_in_msg = "Sorry, Studied Resident not available.";
		var no_resident_status_msg = "Sorry,  Resident status/category not available.";
		var no_program_msg = "Sorry, Program not available.";
		var no_nationality_msg = "Sorry, Nationality not available.";
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
		var no_title_msg = "Sorry, Title not available.";
		var no_occupation_msg = "Sorry, Occupation not available.";
		var no_mobile_code_msg = "Sorry, Mobile code not available.";
		var no_result_status_msg = "Sorry, Status not available.";
		var no_current_qualification_status = 'Sorry, Qualification Status not available.';
		var no_board_msg = "Sorry, Board not available";
		var no_user_marking_scheme_msg = "Sorry, Marking Scheme not available.";
		var no_yop_status = 'Sorry, Year of passing not available.';
		var no_stream_msg = 'Sorry, Stream not available.';
		var no_institute_university_msg = "Sorry, Institute/University not available.";
		
		getSelect2('studied_from_india','<?php echo base_url("get_hcma_studied_from_india"); ?>?sort_by=name&sort_order=asc','Select Status - Yes or No', formatRepoCommon,no_study_resident_in_msg, false, formatRepoSelection);
		getSelect2('non_indian_resident','<?php echo base_url("get_resident_status"); ?>?sort_by=name&sort_order=asc','Select Resident Status', formatRepoCommon,no_resident_status_msg, false, formatRepoSelection);

		//preference &basic detail
		getSelect2('pd_program','<?php echo base_url("get_graduations"); ?>?sort_by=name&sort_order=asc','Choose Program', formatRepoCommon,no_program_msg, false, formatRepoSelection);

		var program_id = "pd_program";
		var dbprogram_id = '<?php echo $grad_id; ?>';
		var dbprogram_val = '<?php echo $grad_name; ?>';
		if(dbprogram_id){
			setTimeout(function(){ select2Set(program_id,dbprogram_id,dbprogram_val);
			}, 1);
		}
		
		getSelect2('campus_pref_1','<?php echo base_url("get_shug_preference"); ?>?is_lookup_master=1&is_campus=1&grade_id='+grad_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Select Campus Perferences 1', formatRepoCommon,no_campus_msg, false, formatRepoSelection);
        enable_course_by_campus('campus_pref_1','course_pref_1','main_div_course_prefer_1','Select Course Perferences 1',grad_id);
		
	    getSelect2('campus_pref_2','<?php echo base_url("get_shug_preference"); ?>?is_lookup_master=1&is_campus=1&grade_id='+grad_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Select Campus Perferences 2', formatRepoCommon,no_campus_msg, false, formatRepoSelection);
	    enable_course_by_campus('campus_pref_2','course_pref_2','main_div_course_prefer_2','Select Course Perferences 2',grad_id);
		
		getSelect2('campus_pref_3','<?php echo base_url("get_shug_preference"); ?>?is_lookup_master=1&is_campus=1&grade_id='+grad_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Select Campus Perferences 3', formatRepoCommon,no_campus_msg, false, formatRepoSelection);
		enable_course_by_campus('campus_pref_3','course_pref_3','main_div_course_prefer_3','Select Course Perferences 3',grad_id);
		
        //course
        //getSelect2('course_pref_1','<?php echo base_url("get_shug_preference"); ?>?is_lookup_master=1&is_course=1&grade_id='+grad_id+'&campus_id=1&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Select Course Perferences 1', formatRepoCommon,no_course_msg, false, formatRepoSelection);
		//getSelect2('course_pref_2','<?php echo base_url("get_shug_preference"); ?>?is_lookup_master=1&is_course=1&grade_id='+grad_id+'&campus_id=1&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Choose Course Perferences 2', formatRepoCommon,no_course_msg, false, formatRepoSelection);
        //getSelect2('course_pref_3','<?php echo base_url("get_shug_preference"); ?>?is_lookup_master=1&is_course=1&grade_id='+grad_id+'&campus_id=1&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Choose Course Perferences 3', formatRepoCommon,no_course_msg, false, formatRepoSelection);
       
		getSelect2('pd_nationality','<?php echo base_url("get_nationalities"); ?>?sort_by=name&sort_order=asc','Select Nationality', formatRepoCommon,no_nationality_msg, false, formatRepoSelection);
        getSelect2('bloodgroups','<?php echo base_url("get_bloodgroups"); ?>?sort_by=blood_grp_id&sort_order=asc','Select Blood Groups', formatRepoCommon,no_blood_grp_msg, false, formatRepoSelection);
   		getSelect2('phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc','Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);

   		getSelect2('pd_title','<?php echo base_url("get_gender_title"); ?>?is_lookup_master=1','Select Gender Title', formatRepoCommon,no_gender_title_msg, false, formatRepoSelection);
		
		getSelect2('pd_gender','<?php echo base_url("get_gender"); ?>?is_lookup_master=1','Select Gender', formatRepoCommon,no_gender_msg, false, formatRepoSelection);
		
		getSelect2('pd_blood_group','<?php echo base_url("get_bloodgroups"); ?>?sort_by=blood_grp_id&sort_order=asc','Select Blood Groups', formatRepoCommon,no_blood_group_msg, false, formatRepoSelection);

		getSelect2('pd_religion','<?php echo base_url("get_religions"); ?>?sort_by=name&sort_order=asc','Select Religions', formatRepoCommon,no_religions_msg, false, formatRepoSelection);
		
		getSelect2('pd_medium_of_instruction','<?php echo base_url("get_mother_tongues"); ?>?sort_by=name&sort_order=asc','Select Medium Of Instruction', formatRepoCommon,no_medium_of_instruction_msg, false, formatRepoSelection);

		getSelect2('pd_hostel_accommodation','<?php echo base_url("get_hostel_accommodation"); ?>?sort_by=name&sort_order=asc','Select Hostel Accommodation', formatRepoCommon,no_hostel_accommodation_msg, false, formatRepoSelection);

		getSelect2('pd_mother_tongue','<?php echo base_url("get_mother_tongues"); ?>?sort_by=name&sort_order=asc','Select Mother Tongues', formatRepoCommon,no_mother_tongues_msg, false, formatRepoSelection);
		
		getSelect2('pd_advertisement_source','<?php echo base_url("get_advertisement_source"); ?>?sort_by=name&sort_order=asc','Select Advertisement Source', formatRepoCommon,no_advertisement_source_msg, false, formatRepoSelection);

		getSelect2('pd_social_status','<?php echo base_url("get_social_status"); ?>?is_lookup_master=1','Select Social Status', formatRepoCommon,no_social_status_msg, false, formatRepoSelection);

		getSelect2('pd_diffrently_abled','<?php echo base_url("get_are_you_differently_abled"); ?>?sort_by=name&sort_order=asc','Select Differently Abled', formatRepoCommon,no_differently_abled_msg, false, formatRepoSelection);

        getSelect2('pd_father_title','<?php echo base_url("get_parent_title"); ?>?is_lookup_master=1&is_father=1','Select Title', formatRepoCommon,no_title_msg, false, formatRepoSelection);
		
		getSelect2('pd_father_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc','Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);		
		
		getSelect2('pd_father_occupation','<?php echo base_url("parent_occupation"); ?>?sort_by=name&sort_order=asc','Select Father Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);

		getSelect2('pd_mother_title','<?php echo base_url("get_mother_title"); ?>?is_lookup_master=1&is_mother=1','Select Title', formatRepoCommon,no_title_msg, false, formatRepoSelection);
		
		getSelect2('pd_mother_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc','Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);

		getSelect2('pd_mother_alt_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc','Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
		getSelect2('pd_father_alt_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc','Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);	
		
		getSelect2('pd_mother_occupation','<?php echo base_url("parent_occupation"); ?>?sort_by=name&sort_order=asc','Select Mother Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);
		
		getSelect2('pd_guardian_phone_no_code','<?php echo base_url("get_mobile_codes"); ?>	?user_login=1&sort_by=name&sort_order=asc','Select Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
		
		getSelect2('pd_guardian_occupation','<?php echo base_url("parent_occupation"); ?>?sort_by=name&sort_order=asc','Select Guardian Occupation', formatRepoCommon,no_occupation_msg, false, formatRepoSelection);
		
		getSelect2('country_addr','<?php echo base_url("get_nationalities"); ?>?sort_by=country_id&sort_order=asc','Select Country', formatRepoCommon,no_country_msg, false, formatRepoSelection);	

		getSelect2('current_qualification_status','<?php echo base_url("qualification_status"); ?>?grad_id='+grad_id+'&sort_by=name&sort_order=asc','Select Current Qualification Status', formatRepoCommon,no_current_qualification_status, false, formatRepoSelection);		
			
		getSelect2('academic_board','<?php echo base_url("get_board"); ?>?sort_by=name&sort_order=asc','Select Board', formatRepoCommon,no_board_msg, false, formatRepoSelection);
	    getSelect2('academic_marking_scheme','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1','Select Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
	    getSelect2('academic_yr_passing','<?php echo base_url("get_yr_of_passing_schooling"); ?>?sort_by=name&sort_order=asc','Select Year', formatRepoCommon,no_yop_status, false, formatRepoSelection);
		

		getSelect2('academic_twelfth_board','<?php echo base_url("get_board"); ?>?sort_by=name&sort_order=asc','Select Board', formatRepoCommon,no_board_msg, false, formatRepoSelection);
		getSelect2('academic_marking_scheme_twelfth','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1','Select Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
	    getSelect2('academic_yr_passing_twelfth','<?php echo base_url("get_yr_of_passing_schooling"); ?>?sort_by=name&sort_order=asc','Select Year', formatRepoCommon,no_yop_status, false, formatRepoSelection);
	    getSelect2('academic_stream','<?php echo base_url("get_streams"); ?>?sort_by=name&sort_order=asc','Select', formatRepoCommon,no_stream_msg, false, formatRepoSelection);		


	    getSelect2('academic_eleven_board','<?php echo base_url("get_board"); ?>?sort_by=name&sort_order=asc','Select Board', formatRepoCommon,no_board_msg, false, formatRepoSelection);
		getSelect2('academic_marking_scheme_eleven','<?php echo base_url("get_user_marking_scheme"); ?>?is_lookup_master=1','Select Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
	    getSelect2('academic_yr_passing_eleven','<?php echo base_url("get_yr_of_passing_schooling"); ?>?sort_by=name&sort_order=asc','Select Year', formatRepoCommon,no_yop_status, false, formatRepoSelection);

		//ug
       	getSelect2('user_marking_scheme_ug','<?php echo base_url("get_user_marking_scheme");?>?is_lookup_master=1','Select Marking Scheme', formatRepoCommon,no_user_marking_scheme_msg, false, formatRepoSelection);
	    getSelect2('yr_passing_ug','<?php echo base_url("get_yr_of_passing_schooling"); ?>?sort_by=name&sort_order=asc','Select Year', formatRepoCommon,no_yop_status, false, formatRepoSelection);
	    getSelect2('university_ug','<?php echo base_url("get_institute_university"); ?>?sort_by=name&sort_order=asc','Select University', formatRepoCommon,no_institute_university_msg, false, formatRepoSelection);            
	    
	    
		  //fetch education from india
		var edu_from_india = "studied_from_india";
   		var db_edu_from_india = '<?php echo $qualifyingexamfromindia;?>';

   		if(db_edu_from_india=='f'){
   			var db_edu_from_indiaVal = 'Select Status Yes or No';
   			$("#studied_from_india").prepend("<option value=''>"+db_edu_from_indiaVal+"</option>");
   		}else{
   			if(db_edu_from_india=='t'){
   				var db_edu_from_indiaVal = 'Yes';
   			}else{
   				var db_edu_from_indiaVal = 'No';
   			}			
   		}
   		if(db_edu_from_india){
   	   		setTimeout(function(){ 
   	   			select2Set(edu_from_india,db_edu_from_india,db_edu_from_indiaVal);
   	   		}, 1);
   	   	}	

   		<?php
        if($i_confirmChecked == 't') {
        ?>
        $('#i_confirm').prop('checked', true);            
        <?php
    	}
        ?>

        
            
	    //fetch campus dropdown
	    <?php if($applicant_campus_details_list) {
           foreach($applicant_campus_details_list as $k=>$v) {
              $applicant_campus_prefer_id[] = $v['applicant_campus_prefer_id'];
              $applicant_campus_campus_id[] = $v['campus_id'];
              $applicant_campus_campus_name[] = $v['campus_name'];
              $applicant_campus_choice_no[] = $v['choice_no'];
              $applicant_campus_is_active[] = $v['is_active'];
           }
        }
      
        if($applicant_campus_campus_id) {
            foreach($applicant_campus_campus_id as $k=>$v) {
                $campus_prefer_k = $k+1;
        ?>
                var campus_pref_<?php echo $campus_prefer_k; ?> = "campus_pref_<?php echo $campus_prefer_k; ?>";
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
	    //end fetch campus dropdown
	    
	    //fetch course
        <?php
        if($applicant_course_details_list) {
            foreach($applicant_course_details_list as $k=>$v) {
                $applicant_course_id[] = $v['applicant_course_id'];
                $applicant_course_course_id[] = $v['course_id'];
                $applicant_course_course_name[] = $v['course_name'];
                $applicant_course_choice_no[] = $v['choice_no'];
                $applicant_course_is_active[] = $v['is_active'];
               
            }
        }
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
          //end fetch course
          
        //fetch dropdown-personal detail
        <?php
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
        $dif_abled=strtolower($dif_abled);
        if($dif_abled == 't' || $dif_abled=="yes") {
            $dif_abled_select = 'yes';
            $dif_abled_select_name = 'Yes';
        } else {
            if($dif_abled=="no" || $dif_abled=="f")
            {
            $dif_abled_select = 'no';
            $dif_abled_select_name = 'No';
            }
        }
        $religion_id = $applicant_basic_details_list['religion_id'];
        $religion = $applicant_basic_details_list['religion_name'];
        $medium_of_instruction_id = $applicant_basic_details_list['medium_of_instruction_id'];
        $medium_of_instruction = $applicant_basic_details_list['medium_of_instruction'];
        // $hostel_accommodation_id = $applicant_basic_details_list['hostel_accommodation_id'];
        // $hostel_accommodation = $applicant_basic_details_list['hostel_accommodation'];
        $hostel_accommodation = $applicant_basic_details_list['prefer_hostel'];
        $hostel_accommodation=strtolower($hostel_accommodation);
        if($hostel_accommodation == 't' || $hostel_accommodation=="yes") {
            $hostel_accommodation_select = 'yes';
            $hostel_accommodation_select_name = 'Yes';
        } else {
            if($hostel_accommodation == 'f' || $hostel_accommodation=="no") 
            {
            $hostel_accommodation_select = 'no';
            $hostel_accommodation_select_name = 'No';
            }
        }
        
        $mother_tongue_id = $applicant_basic_details_list['mothertongue_id'];
        $mother_tongue = $applicant_basic_details_list['mothertongue_name'];
        
        $advertisement_source_id = $applicant_basic_details_list['advertisement_source_id'];
        $advertisement_source = $applicant_basic_details_list['source_name'];
        $medium_of_instruction_id = $applicant_other_details_list['medofinst'];
        $medium_of_instruction_name = $applicant_other_details_list['medium_of_study_name'];
        ?>
        var pd_nationality = "pd_nationality";
		var dbnationality_id = '<?php echo $nationality_id; ?>';
		var dbnationality_name_val = '<?php echo $nationality_name; ?>';
		if(dbnationality_id){
			setTimeout(function(){ 
				select2Set(pd_nationality,dbnationality_id,dbnationality_name_val);
				$('#'+pd_nationality).trigger('change');
			}, 1);
		}

		var pd_title = "pd_title";
		var dbtitle_id = '<?php echo $tittle_id; ?>';
		var dbtitle_name_val = '<?php echo $tittle_name; ?>';
		if(dbtitle_id){
			setTimeout(function(){ 
				select2Set(pd_title,dbtitle_id,dbtitle_name_val);
				$('#'+pd_title).trigger('change');
			}, 1);
		}

		var pd_blood_group = "pd_blood_group";
		var dbblood_group_id = '<?php echo $blood_id; ?>';
		var dbblood_group_name_val = '<?php echo $blood_group; ?>';
		if(dbblood_group_id){
			setTimeout(function(){ 
				select2Set(pd_blood_group,dbblood_group_id,dbblood_group_name_val);
				$('#'+pd_blood_group).trigger('change');
			}, 1);
		}

		var pd_gender = "pd_gender";
		var dbgender_id = '<?php echo $gender_id; ?>';
		var dbgender_name_val = '<?php echo $gender; ?>';
		if(dbgender_id){
			setTimeout(function(){ 
				select2Set(pd_gender,dbgender_id,dbgender_name_val);
				$('#'+pd_gender).trigger('change');
			}, 1);
		}

		var pd_social_status = "pd_social_status";
		var dbsocial_status_id = '<?php echo $social_status_id; ?>';
		var dbsocial_status_name_val = '<?php echo $social_status; ?>';
		if(dbsocial_status_id){
			setTimeout(function(){ 
				select2Set(pd_social_status,dbsocial_status_id,dbsocial_status_name_val);
				$('#'+pd_social_status).trigger('change');
			}, 1);
		}

		var pd_religion = "pd_religion";
		var dbreligion_id = '<?php echo $religion_id; ?>';
		var dbreligion_name_val = '<?php echo $religion; ?>';
		if(dbreligion_id){
			setTimeout(function(){ 
				select2Set(pd_religion,dbreligion_id,dbreligion_name_val);
				$('#'+pd_religion).trigger('change');
			}, 1);
		}

		var pd_medium_of_instruction = "pd_medium_of_instruction";
		var dbmedium_of_instruction_id = '<?php echo $medium_of_instruction_id; ?>';
		var dbmedium_of_instruction_name_val = '<?php echo $medium_of_instruction_name; ?>';
		if(dbmedium_of_instruction_id){
			setTimeout(function(){ 
				select2Set(pd_medium_of_instruction,dbmedium_of_instruction_id,dbmedium_of_instruction_name_val);
				$('#'+pd_medium_of_instruction).trigger('change');
			}, 1);
		}

		var pd_hostel_accommodation = "pd_hostel_accommodation";
		var dbhostel_accommodation_id = '<?php echo $hostel_accommodation_select; ?>';
		var dbhostel_accommodation_name_val = '<?php echo $hostel_accommodation_select_name; ?>';
		if(dbhostel_accommodation_id){
			setTimeout(function(){ 
				select2Set(pd_hostel_accommodation,dbhostel_accommodation_id,dbhostel_accommodation_name_val);
				$('#'+pd_hostel_accommodation).trigger('change');
			}, 1);
		}

		var pd_mother_tongue = "pd_mother_tongue";
		var dbmother_tongue_id = '<?php echo $mother_tongue_id; ?>';
		var dbmother_tongue_name_val = '<?php echo $mother_tongue; ?>';
		if(dbmother_tongue_id){
			setTimeout(function(){ 
				select2Set(pd_mother_tongue,dbmother_tongue_id,dbmother_tongue_name_val);
				$('#'+pd_mother_tongue).trigger('change');
			}, 1);
		}

		var pd_advertisement_source = "pd_advertisement_source";
		var dbadvertisement_source_id = '<?php echo $advertisement_source_id; ?>';
		var dbadvertisement_source_name_val = '<?php echo $advertisement_source; ?>';
		if(dbadvertisement_source_id){
			setTimeout(function(){ 
				select2Set(pd_advertisement_source,dbadvertisement_source_id,dbadvertisement_source_name_val);
				$('#'+pd_advertisement_source).trigger('change');
			}, 1);
		}

		var pd_diffrently_abled = "pd_diffrently_abled";
		var dif_abled_select = '<?php echo $dif_abled_select; ?>';
		var dif_abled_select_name = '<?php echo $dif_abled_select_name; ?>';
		if(dif_abled_select){
			setTimeout(function(){ 
				select2Set(pd_diffrently_abled,dif_abled_select,dif_abled_select_name);
				$('#'+pd_diffrently_abled).trigger('change');
			}, 1);
		}
        //personal data fetch end
       // alert('<?php echo $add_gardian;?>');
		//fetch parent detail
		<?php
		
            
		if($applicant_parent_details_list) {
               foreach($applicant_parent_details_list as $k=>$v) {
                  $parent_type_id = $v['parent_type_id'];
                  $app_parent_det_id[$parent_type_id] = $v['app_parent_det_id'];
                  $applicant_parent_parent_type_name[$parent_type_id] = $v['parent_type_name'];
                  $applicant_parent_parent_name[$parent_type_id] = $v['parent_name'];
                  $applicant_parent_mobile_no[$parent_type_id] = $v['mobile_no'];
                  $applicant_parent_email_id[$parent_type_id] = $v['email_id'];
                  $applicant_parent_occupation[$parent_type_id] = $v['occupation_id'];
                  $applicant_parent_occupation_name[$parent_type_id] = $v['occupation_name'];
                  $applicant_parent_mob_country_code_id[$parent_type_id] = $v['mob_country_code_id'];
                  $applicant_parent_country_mob_code[$parent_type_id] = $v['country_mob_code'];
                  $applicant_parent_alt_mob_countrycode_id[$parent_type_id] = $v['alt_mob_countrycode_id'];
                  $applicant_parent_alt_mob_country_code[$parent_type_id] = $v['alt_mob_country_code'];
                  $applicant_parent_alt_mobile_no[$parent_type_id] = $v['alt_mobile_no'];
                  $applicant_parent_title[$parent_type_id] = $v['title'];
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
            if($applicant_parent_occupation) {
                foreach($applicant_parent_occupation as $k=>$v) {
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
            $chk_guardian = ($add_gardian == 't')?true:false;
            if($add_gardian == 't') {
            ?>
            $('#add_guardian_checkbox').prop('checked', true);
            chk_guardian(<?php echo $chk_guardian; ?>);
            <?php
        	}
            ?>
		//end parent detail fetch
		
		//fetch address
            var country_id = "country_addr";
			var dbcountry_id = '<?php echo $applicant_address_details_list['country_id']; ?>';
			var dbcountry_val = '<?php echo $applicant_address_details_list['country_name']; ?>';
			if(dbcountry_id){
				setTimeout(function(){ select2Set(country_id,dbcountry_id,dbcountry_val);
				}, 1);
			}
			if(country_value_default==dbcountry_id)
			{
    			var state_id = "state_addr";
    			var dbstate_id = '<?php echo $applicant_address_details_list['state_id']; ?>';
    			//alert(dbcountry_id);
    			var dbstate_val = '<?php echo $applicant_address_details_list['state_name']; ?>';
    			//alert(dbcountry_val);
    			 if(dbstate_id){
    				setTimeout(function(){ select2Set(state_id,dbstate_id,dbstate_val);
    				}, 1);
    			}
    
    			var district_id = "district_addr";
    			var dbdistrict_id = '<?php echo $applicant_address_details_list['district_id']; ?>';
    			//alert(dbcountry_id);
    			var dbdistrict_val = '<?php echo $applicant_address_details_list['district_name']; ?>';
    			//alert(dbcountry_val);
    			 if(dbdistrict_id){
    				setTimeout(function(){ select2Set(district_id,dbdistrict_id,dbdistrict_val);
    				}, 1);
    			}
    
    			var city_id = "city_addr";
    			var dbcity_id = '<?php echo $applicant_address_details_list['city_id']; ?>';
    			//alert(dbcountry_id);
    			var dbcity_val = '<?php echo $applicant_address_details_list['city_name']; ?>';
    			//alert(dbcountry_val);
    			 if(dbcity_id){
    				setTimeout(function(){ select2Set(city_id,dbcity_id,dbcity_val);
    				}, 1);
    			}
			}
		//end fetch address
		
		//fetch academic detail
		<?php	
		if(!empty($applicant_schooling_list)){
		     $dbcqs_val=$qual_status_id ;
		     $dbcqs_label=$qual_status_name;		     
		     ?>
    		var cqs_id = "current_qualification_status";
    		var dbcqs_val = '<?php echo  $dbcqs_val;?>';
    		var dbcgsVal='<?php echo $dbcqs_label;?>';
           
    		if(dbcqs_val){
    				setTimeout(function(){ select2Set(cqs_id,dbcqs_val,dbcgsVal);
    				}, 1);
    		}
		   
		     <?php
		}
		
		//fetch school detail
		if(isset($applicant_schooling_list)){
		    foreach($applicant_schooling_list as $school){
		        if($school['schooling_id']==SCHOOLING_ID_TENTH){
		            $schooltype="tenth";
		        }
		        if($school['schooling_id']==SCHOOLING_ID_ELEVENTH){
		            $schooltype="eleven";
		        }
		        if($school['schooling_id']==SCHOOLING_ID_TWELFTH){
		            $schooltype="twelfth";
		        }
		        
		        $schooltypename=strtolower($schooltype);
		        ${ "board_id_".$schooltypename}=$school['board_id'];
		        ${ "board_name_".$schooltypename}=$school['board_name'];
		        ${ "marking_scheme_id_".$schooltypename}=$school['marking_scheme_id'];
		        ${ "marking_scheme_name_".$schooltypename}=$school['marking_scheme_name'];
		        ${ "completion_year_".$schooltypename}=$school['completion_year'];
		        ${ "stream_id_".$schooltypename}=$school['stream_id'];
		        ${ "stream_name_".$schooltypename}=$school['stream_name'];
		        
		    }
		}
		$board_id_tenth = isset($board_id_tenth) ? $board_id_tenth:'';
		$board_name_tenth = isset($board_name_tenth) ? $board_name_tenth:'Select';
		$marking_scheme_id_tenth = isset($marking_scheme_id_tenth)? $marking_scheme_id_tenth : '';
		$marking_scheme_name_tenth = isset($marking_scheme_name_tenth) ? $marking_scheme_name_tenth : 'Select';
		$completion_year_tenth = isset($completion_year_tenth) ? $completion_year_tenth : '';
		
		// Schooling Detail Get Twelfth
		$board_id_twelfth = isset($board_id_twelfth) ? $board_id_twelfth:'';
		$board_name_twelfth = isset($board_name_twelfth) ? $board_name_twelfth:'Select';
		$marking_scheme_id_twelfth = isset($marking_scheme_id_twelfth)? $marking_scheme_id_twelfth : '';
		$marking_scheme_name_twelfth = isset($marking_scheme_name_twelfth) ? $marking_scheme_name_twelfth : 'Select';
		$completion_year_twelfth = isset($completion_year_twelfth) ? $completion_year_twelfth : '';
		$stream_id_twelfth = isset($stream_id_twelfth) ? $stream_id_twelfth:'';
		$stream_name_twelfth = isset($stream_name_twelfth) ? $stream_name_twelfth:'Select';
		
		// Schooling Detail Get eleven
		$board_id_eleven = isset($board_id_eleven) ? $board_id_eleven:'';
		$board_name_eleven = isset($board_name_eleven) ? $board_name_eleven:'Select';
		$marking_scheme_id_eleven = isset($marking_scheme_id_eleven)? $marking_scheme_id_eleven : '';
		$marking_scheme_name_eleven = isset($marking_scheme_name_eleven) ? $marking_scheme_name_eleven : 'Select';
		$completion_year_eleven = isset($completion_year_eleven) ? $completion_year_eleven : '';
		
       ?>

		var board_id = "academic_board";
		var dbboard_id = '<?php echo $board_id_tenth ?>';
		//alert(dbcountry_id);
		var dbboard_val = '<?php echo $board_name_tenth ?>';
		//alert(dbcountry_val);
		 if(dbboard_id){
			setTimeout(function(){ select2Set(board_id,dbboard_id,dbboard_val);
			}, 1);
		}

		var boardtth_id = "academic_twelfth_board";
		var dbboardtth_id = '<?php echo $board_id_twelfth; ?>';
		//alert(dbcountry_id);
		var dbboardtth_val = '<?php echo $board_name_twelfth; ?>';
		//alert(dbcountry_val);
		 if(dbboardtth_id){
			setTimeout(function(){ select2Set(boardtth_id,dbboardtth_id,dbboardtth_val);
			}, 1);
		}

		var board_eleven_id = "academic_eleven_board";
		var dbboard_eleven_id = '<?php echo $board_id_eleven; ?>';
		//alert(dbcountry_id);
		var dbboard_eleven_val = '<?php echo $board_name_eleven; ?>';
		//alert(dbcountry_val);
		 if(dbboard_eleven_id){
			setTimeout(function(){ select2Set(board_eleven_id,dbboard_eleven_id,dbboard_eleven_val);
			}, 1);
		}

		var mscheme_id = "academic_marking_scheme";
		var dbmscheme_id = '<?php echo $marking_scheme_id_tenth; ?>';
		var dbmscheme_val = '<?php echo $marking_scheme_name_tenth; ?>';
		if(dbmscheme_id){
			setTimeout(function(){ select2Set(mscheme_id,dbmscheme_id,dbmscheme_val);
			}, 1);
		}
		
		var mschemetwfth_id = "academic_marking_scheme_twelfth";
		var dbmschemetwfth_id = '<?php echo $marking_scheme_id_twelfth ?>';
		//alert(dbcountry_id);
		var dbmschemetwfth_val = '<?php echo $marking_scheme_name_twelfth; ?>';
		//alert(dbcountry_val);
		 if(dbmschemetwfth_id){
			setTimeout(function(){ select2Set(mschemetwfth_id,dbmschemetwfth_id,dbmschemetwfth_val);
			}, 1);
		}

		var mscheme_eleven_id = "academic_marking_scheme_eleven";
		var dbmscheme_eleven_id = '<?php echo $marking_scheme_id_eleven ?>';
		//alert(dbcountry_id);
		var dbmscheme_eleven_val = '<?php echo $marking_scheme_name_eleven; ?>';
		//alert(dbcountry_val);
		 if(dbmscheme_eleven_id){
			setTimeout(function(){ select2Set(mscheme_eleven_id,dbmscheme_eleven_id,dbmscheme_eleven_val);
			}, 1);
		}		

		var cyear_id = "academic_yr_passing";
		var dbcyear_id = '<?php echo $completion_year_tenth ?>';
		//alert(dbcountry_id);
		var dbcyear_val = '<?php echo $completion_year_tenth; ?>';
		//alert(dbcountry_val);
		 if(dbcyear_id){
			setTimeout(function(){ select2Set(cyear_id,dbcyear_id,dbcyear_val);
			}, 1);
		}

		var cyeartwfth_id = "academic_yr_passing_twelfth";
		var dbcyeartwfth_id = '<?php echo $completion_year_twelfth ?>';
		//alert(dbcountry_id);
		var dbcyeartwfth_val = '<?php echo $completion_year_twelfth; ?>';
		//alert(dbcountry_val);
		 if(dbcyeartwfth_id){
			setTimeout(function(){ select2Set(cyeartwfth_id,dbcyeartwfth_id,dbcyeartwfth_val);
			}, 1);
		}

		var cyearelevenid = "academic_yr_passing_eleven";
		var dbcyeareleven_id = '<?php echo $completion_year_eleven ?>';
		//alert(dbcountry_id);
		var dbcyeareleven_val = '<?php echo $completion_year_eleven; ?>';
		//alert(dbcountry_val);
		 if(dbcyeareleven_id){
			setTimeout(function(){ select2Set(cyearelevenid,dbcyeareleven_id,dbcyeareleven_val);
			}, 1);
		}	

    	var streamtwfth_id = "academic_stream";
    	var dbstreamtwfth_id = '<?php echo $stream_id_twelfth; ?>';
    	//alert(dbcountry_id);
    	var dbcstreamtwfth_val = '<?php echo $stream_name_twelfth; ?>';
    	//alert(dbcountry_val);
    	 if(dbstreamtwfth_id){
    		setTimeout(function(){ select2Set(streamtwfth_id,dbstreamtwfth_id,dbcstreamtwfth_val);
    		}, 1);
    	}
     	
    	//ug mark scheme
 		var ugmarkscheme_id = "user_marking_scheme_ug";
 		var db_markscheme_ug_id = '<?php echo $applicant_graduations_list[0]['mark_scheme_id']; ?>';
 		//alert(dbcountry_id);
 		var db_markscheme_ug_val = '<?php echo $applicant_graduations_list[0]['mark_scheme_name']; ?>';
 		//alert(dbcountry_val);
 		 if(db_markscheme_ug_id){
 			setTimeout(function(){ select2Set(ugmarkscheme_id,db_markscheme_ug_id,db_markscheme_ug_val);
 			}, 1);
 		}	
       //ug univ
 		 var univ_ug_id = "university_ug";
 			var dbuniv_ug_id  = '<?php echo $applicant_graduations_list[0]['univ_id']; ?>';
 			var dbuniv_ug_val = '<?php echo $applicant_graduations_list[0]['univ_name']; ?>';
 			//alert(dbuniv_ug_id);
 			 if(dbuniv_ug_id){
 				setTimeout(function(){ select2Set(univ_ug_id,dbuniv_ug_id,dbuniv_ug_val);
 				}, 1);
 		}

       //ug yop
 		var yop_ug = "yr_passing_ug";
 		var db_year_ug_id = '<?php echo $applicant_graduations_list[0]['yr_of_pass']; ?>';
 		var db_year_ug_val = '<?php echo $applicant_graduations_list[0]['yr_of_pass']; ?>';
 		//alert(dbcountry_val);
 		 if(db_year_ug_id){
 			setTimeout(function(){ select2Set(yop_ug,db_year_ug_id,db_year_ug_val);
 			}, 1);
 		}		
		//end fetch academic detail
		$("#studied_from_india").change(function () {			
	        basic_change();
	    });
		$('#i_confirm').change(function() {
	    	if($(this).is(':checked')) {
	    		$(this).val(1);
	    	} else {
	    		$(this).val(0);
	    	}
	    });	
	    //general functions
	  function basic_change() {
		  
    	var study_india_id = $("#studied_from_india").val();
        var resident_status_val = $("#resident_status").val(); 
        //if(study_india_id=='t'){  study_india_id='yes';}    
        if (study_india_id == 'yes' || study_india_id=='t') {
            $("#indian").show();
            $("#non-indian").hide();
            $("#resident_status").hide();
            $('#non_indian_resident').attr('data-parsley-required',"false");
            if(study_india_id) {
            	$('#i_confirm').attr('data-parsley-required',"true");
            }
        }
        else if (study_india_id == 'no' || study_india_id == 'f') {
            $("#indian").hide();
            $("#non-indian").show();
            $("#resident_status").show();
            $('#i_confirm').attr('data-parsley-required',"false");
          	$('#non_indian_resident').attr('data-parsley-required',"true");
            
        } else {        	
        	$("#indian").hide();
            $("#indian-none").hide();
            $('#i_confirm').attr('data-parsley-required',"false");
            $('#non_indian_resident').attr('data-parsley-required',"false");
        }
    }   

	  $('#pd_nationality').on('change',function() {
			var pd_nationality = $("#pd_nationality").val();
			if(pd_nationality==country_value_default){
				$("#main_div_social_status").show();
			}else{
				$("#main_div_social_status").hide();
			}
		});	

	  $('#current_qualification_status').on('change',function() {
			var id = $(this).val();			
			
			if(id==1){ // 10th passed
                $(".table_twelfth").hide();
                $(".mark").hide();
                $('.table_twelfth input').attr('data-parsley-required', 'false');
                $('.table_twelfth select').attr('data-parsley-required', 'false');
              
                $(".table_eleven").hide();
                $(".ugtable").hide(); 
                $(".markug").hide();              
                $('.ugtable input').attr('data-parsley-required', 'false');
                $('.ugtable select').attr('data-parsley-required', 'false');
                
               }
			if(id==2){ //12th pursuing
                $(".table_twelfth").show();
                $(".mark").hide();
                $('.table_twelfth input').attr('data-parsley-required', 'true');
                $('.table_twelfth select').attr('data-parsley-required', 'true');
                $('#academic_marking_scheme_twelfth').attr('data-parsley-required',"false");
                $('#academic_obtain_cgpa_twelfth').attr('data-parsley-required',"false");
                $('#academic_reg_no_twelfth').attr('data-parsley-required',"false");
                
                
                $(".table_eleven").show();
                $(".ugtable").hide();
                $(".markug").hide();                
                $('.ugtable input').attr('data-parsley-required', 'false');
                $('.ugtable select').attr('data-parsley-required', 'false');
                
               }

			if(id==3){ //12th passed
                $(".table_twelfth").show();
                $(".mark").show();
                $('.table_twelfth input').attr('data-parsley-required', 'true');
                $('.table_twelfth select').attr('data-parsley-required', 'true');

                $(".table_eleven").show();
                $(".ugtable").hide(); 
                $(".markug").hide();               
                $('.ugtable input').attr('data-parsley-required', 'false');
                $('.ugtable select').attr('data-parsley-required', 'false');
                
               }

			if(id==4){ //ug pursuing
				
                $(".table_twelfth").show();
                $(".mark").show();
                $('.table_twelfth input').attr('data-parsley-required', 'true');
                $('.table_twelfth select').attr('data-parsley-required', 'true');

                $(".table_eleven").show();
                $(".ugtable").show();  
                $(".markug").hide();             
                $('.ugtable input').attr('data-parsley-required', 'true');
                $('.ugtable select').attr('data-parsley-required', 'true');
                $('#user_marking_scheme_ug').attr('data-parsley-required',"false");
                $('#obtained_percentage_cgpa_ug').attr('data-parsley-required',"false");
               }
			  if(id==5){ //enable only 10th and 12th
                $(".table_twelfth").show();
                $(".mark").show();
                $('.table_twelfth input').attr('data-parsley-required', 'true');
                $('.table_twelfth select').attr('data-parsley-required', 'true');

                $(".table_eleven").show();
                $(".ugtable").show();
                $(".markug").show();               
                $('.ugtable input').attr('data-parsley-required', 'true');
                $('.ugtable select').attr('data-parsley-required', 'true');
               }
		});

	  $('#pd_program').on('change',function() {
		    var program=$(this).val();
		    if(program==pg_diploma){
		    
		    	 $('#campus_pref_2').attr('data-parsley-required', 'false');
		    	 $('#course_pref_2').attr('data-parsley-required', 'false');
			}else{
				$('#campus_pref_2').attr('data-parsley-required', 'true');
		    	$('#course_pref_2').attr('data-parsley-required', 'true');
			
			}
			$('.campus_course_div').show();
			setEmptyOnChangeSelect2('campus_pref_1'); // when no values return in json, add empty option value 
			if ($('#campus_pref_1').data('select2')) {
				$('#campus_pref_1').select2('destroy');
			}
			$('#campus_pref_1').html('');

			setEmptyOnChangeSelect2('campus_pref_2'); // when no values return in json, add empty option value 
			if ($('#campus_pref_2').data('select2')) {
				$('#campus_pref_2').select2('destroy');
			}
			$('#campus_pref_2').html('');

			setEmptyOnChangeSelect2('campus_pref_3'); // when no values return in json, add empty option value 
			if ($('#campus_pref_3').data('select2')) {
				$('#campus_pref_3').select2('destroy');
			}
			$('#campus_pref_3').html('');


			setEmptyOnChangeSelect2('course_pref_1'); // when no values return in json, add empty option value 
			if ($('#course_pref_1').data('select2')) {
				$('#course_pref_1').select2('destroy');
			}
			$('#course_pref_1').html('');


			setEmptyOnChangeSelect2('course_pref_2'); // when no values return in json, add empty option value 
			if ($('#course_pref_2').data('select2')) {
				$('#course_pref_2').select2('destroy');
			}
			$('#course_pref_2').html('');


			setEmptyOnChangeSelect2('course_pref_3'); // when no values return in json, add empty option value 
			if ($('#course_pref_3').data('select2')) {
				$('#course_pref_3').select2('destroy');
			}
			$('#course_pref_3').html('');
			
			var grad_id = $(this).val();
			getSelect2('campus_pref_1','<?php echo base_url("get_shug_preference"); ?>?is_lookup_master=1&is_campus=1&grade_id='+grad_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Select Campus Perferences 1', formatRepoCommon,no_campus_msg, false, formatRepoSelection);
	        getSelect2('campus_pref_2','<?php echo base_url("get_shug_preference"); ?>?is_lookup_master=1&is_campus=1&grade_id='+grad_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Select Campus Perferences 2', formatRepoCommon,no_campus_msg, false, formatRepoSelection);
		    getSelect2('campus_pref_3','<?php echo base_url("get_shug_preference"); ?>?is_lookup_master=1&is_campus=1&grade_id='+grad_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Select Campus Perferences 3', formatRepoCommon,no_campus_msg, false, formatRepoSelection);
		    getSelect2('current_qualification_status','<?php echo base_url("qualification_status"); ?>?grad_id='+grad_id+'&sort_by=name&sort_order=asc','Select Current Qualification Status', formatRepoCommon,no_current_qualification_status, false, formatRepoSelection);		
			
	});

	$('#pd_course').on('change',function() {
			$('.main_div_campus').show();
			/*setEmptyOnChangeSelect2('pd_campus'); // when no values return in json, add empty option value 
			if ($('#pd_campus').data('select2')) {
				$('#pd_campus').select2('destroy');
			}

			$('#pd_campus').html(''); // reset select values for, if user selected the value then change the country code, then select same value, and value will be null, that so we reset the select values	
			*/
			var pd_course_val = $(this).val();
			var pd_program_val = $('#pd_program').val();
			getSelect2('pd_campus','<?php echo base_url("get_campus_preference"); ?>?is_lookup_master=1&prog_id='+pd_program_val+'&branch_id='+pd_course_val+'&sort_by=id&sort_order=asc','Select Course Preference', formatRepoCommon,no_campus_msg, false, formatRepoSelection);
	});

	    // Show Father & Mother Input
		show_parents_detail('pd_father_title','father_mbleno_div','father_alt_mbleno_div','father_email_div','father_occupation_div');
		show_parents_detail('pd_mother_title','mother_mbleno_div','mother_alt_mbleno_div','mother_email_div','mother_occupation_div');
		show_other_element('pd_father_occupation','father_other_occupation_div',otheroccupation);
		show_other_element('pd_mother_occupation','mother_other_occupation_div',otheroccupation);
		show_other_element('pd_guardian_occupation','guardian_other_occupation_div',otheroccupation);
		$('#add_guardian_checkbox').on('change',function(){
			chk_guardian($(this).is(':checked'));
		});
		
		//new
		validate_cgpa('academic_marking_scheme','academic_obtain_cgpa');
		validate_cgpa('academic_marking_scheme_eleven','academic_obtain_cgpa_eleven');
		validate_cgpa('academic_marking_scheme_twelfth','academic_obtain_cgpa_twelfth');
		validate_cgpa('user_marking_scheme_ug','obtained_percentage_cgpa_ug');
		validate_yop('academic_yr_passing','academic_yr_passing_twelfth','yr_passing_ug');
		//end new

		  
		/*$('#add_guardian_checkbox').on('change',function(){
			if($(this).is(':checked')) {
				$('#add_guardian_checkbox').val(1);
				$('#guardian_details').show();
			} else {
				$('#add_guardian_checkbox').val(0);
				$('#guardian_details').hide();
			}
		});*/

		$('#country_addr').on('change',function() {
			setEmptyOnChangeSelect2('state_addr'); // when no values return in json, add empty option value 
			if ($('#state_addr').data('select2')) {
				$('#state_addr').select2('destroy');
			}
			$('#state_addr').html(''); // reset select values for, if user selected the value then change the country code, then select same value, and value will be null, that so we reset the select values
	
			var country_addr_val = $(this).val();
			
			if(country_value_default==country_addr_val){
				$('#main_div_state').show();
				getSelect2('state_addr','<?php echo base_url("get_states"); ?>?country_id='+country_addr_val+	'&sort_by=id&sort_order=asc','Select State', formatRepoCommon,no_state_msg, false, formatRepoSelection);

				$('#state_addr').attr('data-parsley-required',"true");
				$('#city_addr').attr('data-parsley-required',"true");
				$('#district_addr').attr('data-parsley-required',"true");
				 
				}else{
				$('#main_div_state').hide();
				$('#main_div_district').hide();
				$('#main_div_city').hide();
				$('#state_addr').attr('data-parsley-required',"false");
				$('#city_addr').attr('data-parsley-required',"false");
				$('#district_addr').attr('data-parsley-required',"false"); 	

								
			}
		});
		$('#state_addr').on('change',function() {
			setEmptyOnChangeSelect2('city_addr');
			if ($('#city_addr').data('select2')) {
				$('#city_addr').select2('destroy');
			}				
			$('#city_addr').html(''); // reset select values for, if user selected the value then change the country code, then select same value, and value will be null, that so we reset the select values				
			var state_addr_val = $(this).val();
			//  console.log("country_addr_val "+country_addr_val);
			$('#main_div_district').show();
			$('#main_div_city').show();
			getSelect2('city_addr','<?php echo base_url("get_cities"); ?>?state_id='+state_addr_val+'&sort_by=id&sort_order=asc','Select City', formatRepoCommon,no_city_msg, false, formatRepoSelection);
			
			getSelect2('district_addr','<?php echo base_url("get_district"); ?>?state_id='+state_addr_val+'&sort_by=id&sort_order=asc','Select City', formatRepoCommon,no_city_msg, false, formatRepoSelection);
		});	

     
		$('#academic_board').on('change',function() {
			var academic_boardid = $("#academic_board").val();			
			if(academic_boardid==otherboard){
				$("#other_board1").show();
			}else{
				$("#other_board1").hide();
			}
		});
		$('#academic_twelfth_board').on('change',function() {
			var academic_twelfth_boardid = $("#academic_twelfth_board").val();
			if(academic_twelfth_boardid==otherboard){
				$("#other_board2").show();
			}else{
				$("#other_board2").hide();
			}
		});
		$('#university_ug').on('change',function() {
			var university_ugid = $("#university_ug").val();
			
			 if(university_ugid==otheruniversity){
				$("#other_univ_ug").show();
			}else{
				$("#other_univ_ug").hide();
			} 
		});

		$('#university_pg').on('change',function() {
			var university_pgid = $("#university_pg").val();
			
			 if(university_pgid==otheruniversity){
				$("#other_univ_pg").show();
			}else{
				$("#other_univ_pg").hide();
			} 
		});
		
		$('#academic_stream').on('change',function() {
			var streamid = $("#academic_stream").val();
			if(streamid==otherstream){
				$("#other_stream").show();
			}else{
				$("#other_stream").hide();
			}
		});

		 $('#campus_pref_1').on('change',function() {
			 campus_pref_change('campus_pref_1','campus_pref_2','campus_pref_3','Select Campus Perferences');
         });

		 $('#campus_pref_2').on('change',function() {
			 campus_pref_change('campus_pref_2','campus_pref_3','campus_pref_1','Select Campus Perferences');
         });

		 $('#campus_pref_3').on('change',function() {
			// campus_pref_change('campus_pref_3','campus_pref_1','campus_pref_2','Select Campus Perferences');
         });

		 
         
	     //end functions
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
		
		$(function () {
			$("#datepicker").datepicker();
		});
		// DOB Datepicker
		$("#pd_dob").datepicker( {
			format:"mm/dd/yyyy" ,autoclose: true,todayHighlight: true
		});

		<?php
			      if($upload_scripts) {
			        foreach($upload_scripts as $k=>$v) {
			          echo $v."\n";
			        }
			      }
      ?>
			
			
	});
});

function campus_pref_change(currentcampus,reset1,reset2,campus_placeholder) {
    var e1_val=$("#"+currentcampus).val();		
    var e2_val=$("#"+reset1).val();
    var e3_val=$("#"+reset2).val();
    //for reset1 
	var notcampus2 = [];
	if(e1_val !== null  && e1_val !== ""){
     notcampus2.push(e1_val);
    }
	if(e3_val !== null && e3_val !== ""){
         notcampus2.push(e3_val);
    }
    if(notcampus2.length>0);
    {
		/*var arrStr = JSON.stringify(notcampus1);
		console.log($.param(arrStr)); */
		var notcampusval2=notcampus2.join(",");
		setEmptyOnChangeSelect2(reset1);
		if ($('#'+reset1).data('select2')) {
			$('#'+reset1).select2('destroy');
		}				
		$('#'+reset1).html(''); 
		//$('#'+spec_div).show();
		var no_campus_msg = "Sorry, Campus not available.";
		getSelect2(reset1,'<?php echo base_url("get_hcma_preference"); ?>?is_lookup_master=1&ecamp='+notcampusval2+'&is_campus=1&grade_id=1&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Select Campus Perferences 2', formatRepoCommon,no_campus_msg, false, formatRepoSelection);   }
	
	 
}

function enable_course_by_campus(campus,course,course_div,course_placeholder,grad_id) {
	$('#'+campus).on('change',function() {
		var programid=$("#pd_program").val();
		if(programid!="")
		{
		  grad_id=programid;
		}
		setEmptyOnChangeSelect2(course);
		if ($('#'+course).data('select2')) {
			$('#'+course).select2('destroy');
		}				
		$('#'+course).html(''); 			
		var campus_val = $(this).val();		
		$('#'+course_div).show();
		var no_course_msg = "Sorry, Course not available.";
		getSelect2(course,'<?php echo base_url("get_shug_preference"); ?>?is_lookup_master=1&is_course=1&grade_id='+grad_id+'&campus_id='+campus_val+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc',course_placeholder, formatRepoCommon,no_course_msg, false, formatRepoSelection);
		});
}
function chk_guardian(val) {	
	   if($("#add_guardian_checkbox").is(':checked')){
		$('#add_guardian_checkbox').val('true');
		$('#guardian_details').show();
		$('#pd_guardian_name').attr('data-parsley-required',"true");
		$('#pd_guardian_phone').attr('data-parsley-required',"true");
		$('#pd_guardian_phone_no_code').attr('data-parsley-required',"true");
		$('#pd_guardian_email').attr('data-parsley-required',"true");
		$('#pd_guardian_occupation').attr('data-parsley-required',"true");
	} else {
		$('#add_guardian_checkbox').val('false');
		$('#guardian_details').hide();
		$('#pd_guardian_name').attr('data-parsley-required',"false");
		$('#pd_guardian_phone').attr('data-parsley-required',"false");
		$('#pd_guardian_phone_no_code').attr('data-parsley-required',"false");
		$('#pd_guardian_email').attr('data-parsley-required',"false");
		$('#pd_guardian_occupation').attr('data-parsley-required',"false");
	
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
	console.log('data_del_file_id => '+data_del_file_id);
	var url = "<?php echo base_url(); ?>del-uploaded-file";
	var AjaxRequest = $.ajax({
		type: 'POST',
		url: url,
		data: 'data_del_file_id='+data_del_file_id+'&doc_id='+doc_id+'&logged_applicant_id='+logged_applicant_id+'&logged_applicant_login_id='+logged_applicant_login_id+'&app_form_id='+app_form_id,
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

//end upload
</script>