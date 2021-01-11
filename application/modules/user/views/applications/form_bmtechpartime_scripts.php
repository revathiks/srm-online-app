<?php
$app_form_id_bmtech_part_time = APP_FORM_ID_BMTECH_PARTTIME;
$parent_type_id_father = PARENT_TYPE_ID_FATHER;
$parent_type_id_mother = PARENT_TYPE_ID_MOTHER;
$parent_type_id_guardian = PARENT_TYPE_ID_GUARDIAN;
$const_grad_id = BMTECH_PART_TIME_GRADUATION_ID;
$const_deg_id = BMTECH_PART_TIME_DEGREE_ID;
$document_id_photograph = DOCUMENT_ID_PHOTOGRAPH;
$document_id_signature = DOCUMENT_ID_SIGNATURE;
?>
<script>
	var no_studied_from_india_msg = "Sorry, Studied from India not available.";
	var no_resident_status_msg = "Sorry,  Resident status/category not available.";

	var url = "<?php echo base_url(); ?>bmtechpartime";
	var redirect = '<?php echo base_url()."thank_you"; ?>';

$(document).ready(function() {

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
        startIndex: 0,

        /* Transition Effects */
        transitionEffect: 'slide', //$.fn.steps.transitionEffect.none,
        transitionEffectSpeed: 200,

        /* Events */
        onStepChanging: function (event, currentIndex, newIndex) { 
            if(currentIndex < newIndex) {
				// Step 1 form validation
				if(currentIndex === 0) {
                  // return true;
				  var non_indian_resident = $('#non_indian_resident').parsley();
				  var qualifyingexamfromindia = $('#qualifyingexamfromindia').parsley();
				  var studied_from_india = $('#studied_from_india').parsley();
				  
				  if(non_indian_resident.isValid() && qualifyingexamfromindia.isValid() && studied_from_india.isValid()) {
					var non_indian_resident = $('#non_indian_resident').val();
					var qualifyingexamfromindia = $('#qualifyingexamfromindia').val();
					var studied_from_india = $('#studied_from_india').val();
					
					var user_data = 'non_indian_resident='+non_indian_resident+'&qualifyingexamfromindia='+qualifyingexamfromindia+'&studied_from_india='+studied_from_india+'&applicant_appln_id='+applicant_appln_id;
					$.ajax({
						type: 'POST',
						url: url,
						data: user_data+'&currentIndex='+currentIndex,
						dataType: 'json',
						cache: false,
						success: function(returndata) {
							if(returndata) {
								if(returndata.status == 'true') {
									if(returndata.appln_status.status == 'true') {
										applicant_appln_id = returndata.appln_status.id;
									}
								}
								
							}
						  	// console.log(returndata);
						},
						error: function(returndata) {
						  	console.log(returndata); 
						},
					});						
					return true;
				  } else {
				  	non_indian_resident.validate();
				  	qualifyingexamfromindia.validate();
				  	studied_from_india.validate();
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
				  
					if(course_pref_1.isValid() && specialization_pref_1.isValid() && campus_pref_1.isValid() && state_pref_1.isValid() && city_pref_1.isValid() && pd_title.isValid() && pd_firstname.isValid() && pd_lastname.isValid() && pd_mobile_no.isValid() && phone_no_code.isValid() && pd_email.isValid() && pd_dob.isValid() && pd_gender.isValid() && pd_alt_email.isValid() && pd_blood_group.isValid() && pd_diffrently_abled.isValid() && pd_religion.isValid() && pd_medium_of_instruction.isValid()) {
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
						
						var user_data = 'course_pref_1='+course_pref_1_val+'&course_prefer_id_1='+course_prefer_id_1_val+'&course_choice_no_1='+course_choice_no_1_val+'&specialization_pref_1='+specialization_pref_1_val+'&campus_pref_1='+campus_pref_1_val+'&campus_choice_no_1='+campus_choice_no_1_val+'&campus_prefer_id_1='+campus_prefer_id_1_val+'&course_pref_2='+course_pref_2_val+'&course_prefer_id_2='+course_prefer_id_2_val+'&course_choice_no_2='+course_choice_no_2_val+'&specialization_pref_2='+specialization_pref_2_val+'&campus_pref_2='+campus_pref_2_val+'&campus_choice_no_2='+campus_choice_no_2_val+'&campus_prefer_id_2='+campus_prefer_id_2_val+'&course_pref_3='+course_pref_3_val+'&course_prefer_id_3='+course_prefer_id_3_val+'&course_choice_no_3='+course_choice_no_3_val+'&specialization_pref_3='+specialization_pref_3_val+'&campus_pref_3='+campus_pref_3_val+'&campus_choice_no_3='+campus_choice_no_3_val+'&campus_prefer_id_3='+campus_prefer_id_3_val+'&state_pref_1='+state_pref_1_val+'&city_pref_1='+city_pref_1_val+'&city_prefer_id_1='+city_prefer_id_1_val+'&city_choice_no_1='+city_choice_no_1_val+'&state_pref_2='+state_pref_2_val+'&city_pref_2='+city_pref_2_val+'&city_prefer_id_2='+city_prefer_id_2_val+'&city_choice_no_2='+city_choice_no_2_val+'&state_pref_3='+state_pref_3_val+'&city_pref_3='+city_pref_3_val+'&city_prefer_id_3='+city_prefer_id_3_val+'&city_choice_no_3='+city_choice_no_3_val+'&pd_title='+pd_title_val+'&pd_firstname='+pd_firstname_val+'&pd_middlename='+pd_middlename_val+'&pd_lastname='+pd_lastname_val+'&phone_no_code='+pd_mobile_no_code_val+'&pd_mobile_no='+pd_mobile_no_val+'&pd_email='+pd_email_val+'&pd_dob='+pd_dob_val+'&pd_gender='+pd_gender_val+'&pd_alt_email='+pd_alt_email_val+'&pd_blood_group='+pd_blood_group_val+'&pd_social_status='+pd_social_status_val+'&pd_diffrently_abled='+pd_diffrently_abled_val+'&pd_religion='+pd_religion_val+'&pd_medium_of_instruction='+pd_medium_of_instruction_val+'&pd_hostel_accommodation='+pd_hostel_accommodation_val+'&pd_mother_tongue='+pd_mother_tongue_val+'&pd_advertisement_source='+pd_advertisement_source_val;
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
						return true;
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

					var country = $('#country').parsley();
					var state = $('#state').parsley();
					var district = $('#district').parsley();
					var city = $('#city').parsley();
					var address1 = $('#address_line1').parsley();
					var pincode = $('#pincode').parsley();
				  
				  	if(pd_father_title.isValid() && pd_father_name.isValid() && pd_mother_title.isValid() && pd_mother_name.isValid() && pd_father_email.isValid() && pd_mother_email.isValid() && pd_guardian_name.isValid() && pd_guardian_phone.isValid() && pd_guardian_email.isValid() && pd_father_phone.isValid() && pd_mother_phone.isValid() && pd_father_alt_phone.isValid() && pd_mother_alt_phone.isValid() && country.isValid() && state.isValid() && district.isValid() && city.isValid() && address1.isValid() && pincode.isValid()) {

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
					  	var country_id 	= 	$('#country').val();
					  	var state_id 	= 	$('#state').val();
					  	var district_id = 	$('#district').val();
					  	var city_id     = 	$('#city').val();
					  	var address1    =  	$('#address_line1').val();
					  	var address2    =  	$('#address_line2').val();
					  	var pincode 	=	$('#pincode').val();
					  	var userData = 'pd_father_id='+pd_father_id+'&pd_father_title='+pd_father_title+'&pd_father_name='+pd_father_name+'&pd_father_phone_no_code='+pd_father_phone_no_code+'&pd_father_phone='+pd_father_phone+'&pd_father_alt_phone_no_code='+pd_father_alt_phone_no_code+'&pd_father_alt_phone='+pd_father_alt_phone+'&pd_father_email='+pd_father_email+'&pd_father_occupation='+pd_father_occupation+'&pd_mother_id='+pd_mother_id+'&pd_mother_title='+pd_mother_title+'&pd_mother_name='+pd_mother_name+'&pd_mother_phone_no_code='+pd_mother_phone_no_code+'&pd_mother_alt_phone_no_code='+pd_mother_alt_phone_no_code+'&pd_mother_email='+pd_mother_email+'&pd_mother_occupation='+pd_mother_occupation+'&add_guardian_checkbox='+add_guardian_checkbox+'&pd_guardian_id='+pd_guardian_id+'&pd_guardian_name='+pd_guardian_name+'&pd_guardian_phone_no_code='+pd_guardian_phone_no_code+'&pd_guardian_phone='+pd_guardian_phone+'&pd_guardian_email='+pd_guardian_email+'&pd_guardian_occupation='+pd_guardian_occupation+'&pd_mother_phone='+pd_mother_phone+'&pd_mother_alt_phone='+pd_mother_alt_phone+'&country_id='+country_id+'&state_id='+state_id+'&district_id='+district_id+'&city_id='+city_id+'&address_line_1='+address1+'&address_line_2='+address2+'&pincode='+pincode;
					  	$.ajax({
							type: 'POST',
							url: url,
							data: userData+'&currentIndex='+currentIndex,
							dataType: 'json',
							cache: false,
							success: function(returndata) {
							  console.log(returndata);
							},
							error: function(returndata) {
							  console.log(returndata); 
							},
						});							
						return true;
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
					country.validate();
					state.validate();
					district.validate();
					city.validate();
					address1.validate();
					pincode.validate();
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
                    	var institute_name 	=	$('#institute_name').val();
                    	var mode_of_study 	=	$('#mode_of_study').val();
                    	var marking_scheme 	=	$('#marking_scheme').val();
                    	var obtained_percentage_cgpa 	=	$('#obtained_percentage_cgpa').val();
                    	var year_of_passing 	=	$('#year_of_passing').val();
                    	var registration_no 	=	$('#registration_no').val();
                    	var address_of_school_college 	=	$('#address_of_school_college').val();
                    	var nad_id_digilocker_id 	=	$('#nad_id_digilocker_id').val();
                    	var userData = 'current_education_qual_status='+current_education_qual_status+'&tenth_name='+tenth_name+'&schooling_id='+schooling_id+'&board='+board+'&institute_name='+institute_name+'&mode_of_study='+mode_of_study+'&marking_scheme='+marking_scheme+'&obtained_percentage_cgpa='+obtained_percentage_cgpa+'&year_of_passing='+year_of_passing+'&registration_no='+registration_no+'&address_of_school_college='+address_of_school_college+'&nad_id_digilocker_id='+nad_id_digilocker_id;
					  	$.ajax({
							type: 'POST',
							url: url,
							data: userData+'&currentIndex='+currentIndex,
							dataType: 'json',
							cache: false,
							success: function(returndata) {
							  console.log(returndata);
							},
							error: function(returndata) {
							  console.log(returndata); 
							},
						});	
                        return true;       
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
                    return true;
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
        	if(currentIndex==3){
				$(".actions ul > li:nth-child(2) a").text('<?php echo MAKE_PAYMENT; ?>');
			}else{
				$(".actions ul > li:nth-child(2) a").text('<?php echo NEXT_STEP; ?>');
			}
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

	$("#bmtechparttime_form").steps(settings);
	$('.instruction_accordion').click();
	basic_change();
	light_box_init();

	getSelect2('studied_from_india','<?php echo base_url("get_studied_from_india"); ?>?sort_by=name&sort_order=asc','Choose Status', formatRepoCommon,no_studied_from_india_msg, false, formatRepoSelection);
	getSelect2('non_indian_resident','<?php echo base_url("get_bmtechpartime_resident_status"); ?>?sort_by=name&sort_order=asc','Select Resident Status', formatRepoCommon,no_resident_status_msg, false, formatRepoSelection);

	$("#studied_from_india").change(function() {
      	basic_change();       
    });


	// This Function for Payment option selection
	$("#online").click(function(){
		$("#payment_details").hide();
		});
		$("#dd").click(function(){

		 $("#payment_details").show();
	});
               
})

function basic_change() {
  	$("li a").css("pointer-events", "unset"); 
  	var study_india_id = $("#studied_from_india").val();        

    if (study_india_id == 'yes') {
        $("#info_study").show(); 
        $("#nri_info_study").hide(); 
    } else if (study_india_id == 'no') {
      	$("li a").css("pointer-events", "none");
        $("#info_study").hide();
        $("#nri_info_study").show(); 
    } else {
      	$("#info_study").hide();  
      	$("#nri_info_study").hide();
    }
}

function chk_guardian(val) {
	// if($(this).is(':checked')) {
	if(val) {
		$('#add_guardian_checkbox').val('true');
		$('#guardian_details').show();
	} else {
		$('#add_guardian_checkbox').val('false');
		$('#guardian_details').hide();
	}
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
                    $('#'+file_doc_type).parent().find('span.file_name').remove();
                    $('#'+file_doc_type).parent().find('[data-del-file-id]').remove();
                    $('#'+file_doc_type).parent().find('.alert').remove();
                    $('#'+file_doc_type).parent().append('<!-- <span class="file_name  mt-3"><a class="image-popup-vertical-fit" href="<?php echo base_url(); ?>'+file_path+'" target="_blank" title="'+file_name_user+'">'+file_name_truncate+' <i class="fa fa-eye" aria-hidden="true"></i></a></span><a href="javascript:void(0)" data-del-file-id="'+id+'" data-doc-id="'+doc_id+'" data-toggle="modal" data-target="#contentDeletePop" data-field="'+file_doc_type+'" data-required="'+parsley_required+'" onclick="removeClick(this)"><i class="fa fa-trash" aria-hidden="true"></i></a> --><div style="display:none" class="alert col-sm-12 alert-success" id="deleteMessage_'+doc_id+'"><a href="#" class="close" onclick="hideAlert(\'deleteMessage_'+doc_id+'\')">&times;</a><strong id="deleteMessageStatus_'+doc_id+'"></strong> <span id="deleteMessageSpan_'+doc_id+'"></span></div>');
                    setTimeout(function() { 
                    	upload_file_set_download_delete_options(file_doc_type, file_name, file_path, doc_id, id, parsley_required);
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
    // console.log('data_del_file_id => '+data_del_file_id);
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
    	var userData = 'applicant_name='+applicant_name+'&parent_name='+parent_name+'&declaration_date='+declaration_date;
    	var AjaxRequest = $.ajax({
			type: 'POST',
			url: url,
			// data: userData+'&currentIndex='+currentIndex+'&<?php //echo $this->security->get_csrf_token_name(); ?>=<?php //echo $this->security->get_csrf_hash(); ?>',
			data: userData+'&currentIndex='+currentIndex,
			dataType: 'json',
			cache: false,
			success: function(returndata) {
			  console.log(returndata);

			  setTimeout(function() { window.location.href = redirect; }, 100);
			},
			error: function(returndata) {
			  console.log(returndata); 
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