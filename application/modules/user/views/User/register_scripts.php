
<?php
$const_grad_id = MTECH_GRADUATION_ID;
$const_deg_id = MTECH_DEGREE_ID;
$const_grad_id = ((isset($pgm_gradid))?$pgm_gradid:'');
$const_deg_id = ((isset($pgm_degid))?$pgm_degid:'');
$const_form_id = ((isset($pgm_formid))?$pgm_formid:'');
?>

	<script type="text/javascript">
		var email_valid = true;
		var phone_valid = true;
		$(document).ready(function() {

			var const_grad_id = '<?php echo $const_grad_id; ?>';
    		var const_deg_id = '<?php echo $const_deg_id; ?>';
    		var app_form_id = '<?php echo $const_form_id; ?>';
    		var no_degree_msg = "Sorry, Course not available.";
    		var stream_val = '<?php echo DEFAULT_STREAM_ID; ?>';
    		var pgm_name = '<?php echo $pgm_name;?>';

			// $("#userRegisterForm").validate({
			// 	highlight: function (element, errorClass, validClass) {
			// 		var elem = $(element);
			// 		var ele_id = elem.attr('id');
			// 		if (elem.hasClass("select2-hidden-accessible")) {
			// 			$("#select2-" + ele_id + "-container").parent().addClass('has-error'); 
			// 		} else if($(element).parents('.form-group') != 'undefined') {
			// 			// console.log('ele_id => '+ele_id);
			// 			//$(element).parent('.form-group').css({'margin-bottom':'0px'});
			// 			$(element).parents('.form-group').addClass('has-error');
			// 		} else if($(element).parents('.input-group') != 'undefined') {
			// 			// console.log('ele_id => '+ele_id);
			// 			//$(element).parent('.input-group').css({'margin-bottom':'0px'});
			// 			$(element).parents('.input-group').addClass('has-error');
			// 		}
			// 		$(element).addClass('has-error');
			// 		setTimeout(function() {
			// 			if(ele_id == 'email') {
			// 				if(email_valid === false) {
			// 					$('#email-error').prev('.form-group').addClass('mb-1').removeClass('mb-3');
			// 				} else {
			// 					$('#'+ele_id+'-error').css('cssText', 'display:none !important');
			// 					// $('#'+ele_id+'-error').hide();		
			// 				}
			// 			} else if(ele_id == 'phone_no') {
			// 				if(phone_valid === false) {
			// 					$('#phone_no-error').parent().addClass('mb-1').removeClass('mb-3');
			// 				} else {
			// 					// $('#'+ele_id+'-error').hide();	
			// 					$('#'+ele_id+'-error').css('cssText', 'display:none !important');
			// 				}
			// 			} else {
			// 				// $('#'+ele_id+'-error').hide();	
			// 				$('#'+ele_id+'-error').css('cssText', 'display:none !important');
			// 			}
			// 		}, 1);
			// 	},
			// 	unhighlight: function (element, errorClass, validClass) {
			// 		var elem = $(element);
			// 		var ele_id = elem.attr('id');
			// 		if (elem.hasClass("select2-hidden-accessible")) {
			// 			$("#select2-" + ele_id + "-container").parent().removeClass('has-error');
			// 		} else if($(element).parents('.form-group') != 'undefined') {
			// 			// console.log('ele_id => '+ele_id);
			// 			$(element).parents('.form-group').removeClass('has-error');
			// 		} else if($(element).parents('.input-group') != 'undefined') {
			// 			// console.log('ele_id => '+ele_id);
			// 			$(element).parents('.input-group').removeClass('has-error');
			// 		}
			// 		$(element).removeClass('has-error');
			// 		setTimeout(function() { 
			// 			$('#'+ele_id+'-error').css('cssText', 'display:none !important');
			// 			// console.log('ele_id unhighlight -error => '+ele_id);
			// 			// if($('#'+ele_id+'-error').is(':visible')) {
			// 				if(ele_id == 'phone_no') {
			// 					$('#phone_no-error').parent().removeClass('mb-1').addClass('mb-3');
			// 				} else if(ele_id == 'email') {
			// 					$('#email-error').prev('.form-group').removeClass('mb-1').addClass('mb-3');
			// 				}
			// 			// }
						
			// 			// $('#'+ele_id+'-error').hide();
			// 		}, 1);
			// 	},
			// 	errorPlacement: function (error, element) {
			// 		errorPlacement(error, element);
			// 	},
			// 	rules: {
			// 		// username: "required",
			// 		display_name: {
			// 			required:true,
			// 			// alphanumeric:true
			// 			nameonly:true
			// 		},					
			// 		email: 
			// 		{
			// 			required: true,
			// 			email: true,
			// 			checkEmail: true,
			// 			remote: {
			// 				url: "<?php echo base_url('check_user_exists'); ?>",
			// 				type: "post",
			// 				data: {
			// 					email: function() {
			// 						setTimeout(function() { 
			// 							// console.log('email_exists'); 
			// 							if(!($( "#email" ).valid())) {
			// 								$('#email-error').css('cssText', 'display:inline-block !important');	
			// 								email_valid = false;
			// 							}
			// 						}, 100);
			// 						return $( "#email" ).val();
			// 					},
			// 					user_login:1,
			// 					for_register:1
			// 				}
			// 			}
			// 		}, 
			// 		password: {
			// 			required:true,
			// 			minlength:8,
			// 			pwcheck:true
			// 		},
			// 		/*confirm_password: {
			// 			required: true,
			// 			minlength:8,
	  //                   equalTo: "#password"
	  //               },*/
			// 		phone_no_code: "required",
			// 		phone_no: 
			// 		{
			// 			required: true,
			// 			digits: true,
			// 			minlength: 10,
			// 			maxlength: 10,
			// 			remote: {
			// 				url: "<?php echo base_url('check_user_exists'); ?>",
			// 				type: "post",
			// 				data: {
			// 					phone_no: function() {
			// 						setTimeout(function() { 
			// 							// console.log('phone_no_exists'); 
			// 							// $('#phone_no-error').show(); 
			// 							if(!($( "#phone_no" ).valid())) {
			// 								$('#phone_no-error').css('cssText', 'display:inline-block !important');
			// 								$('#phone_no-error').addClass('col-sm-12'); 
			// 								phone_valid = false;
			// 							}
			// 						}, 100);
			// 						return $( "#phone_no" ).val();
			// 					},
			// 					user_login:1,
			// 					for_register:1
			// 				}
			// 			}
			// 		},
			// 		state: "required",
			// 		city: "required",
			// 		course: "required",
			// 		captcha:  {
			// 			required:true,
			// 			remote: {
			// 				url: "<?php echo base_url('check_captcha'); ?>",
			// 				type: "post",
			// 				data: {
			// 					captcha: function() {
			// 						return $( "#captcha" ).val();
			// 					},
			// 					captcha_from_path:"<?php echo $captcha_from_path; ?>"
			// 				}
			// 			}
			// 		},
			// 		agree_terms: "required",
			// 	},
			// 	// Specify validation error messages
			// 	messages: {
			// 		// username: "Username required",
			// 		display_name: {
			// 			required: "Please enter the name",
			// 			nameonly: "Name must be alphanumeric."
			// 		},
			// 		email: {
			// 			required: "Please enter the email address",
			// 			email: "Please enter the valid email address.",
			// 			checkEmail: "Please enter the valid email address.",
			// 			// remote: "email address already exists",
			// 			remote: "Your Email id is already registered with us. <a href='<?php echo base_url('login'); ?>'>click here</a> to login to proceed further with your application"
			// 			// remote: "Your Email id is already registered with us. <a href='#'>click here</a> to get credentials email to proceed further with your application."
			// 		},
			// 		password: {
			// 			required: "Please enter the password",
			// 			minlength:"Please enter the password minimum 8 character",
			// 			pwcheck:"Password should be minimum one lowercase letter, (=, !, -, @, ., _) one symbol and one digit "
			// 		},
			// 		confirm_password:  {
			// 			required: "Please enter the confirm password",
			// 			minlength:"Please enter the confirm password minimum 8 character",
			// 			equalTo: "Confirm Password does not match with above password"
			// 		},
			// 		phone_no_code: "Please enter the mobile number code",
			// 		phone_no: {
			// 			required: "Please enter the mobile number",
			// 			digits: "Please enter the valid mobile number",
			// 			minlength: "Mobile number field accept only 10 digits",
			// 			maxlength: "Mobile number field accept only 10 digits",
			// 			remote: "Mobile number already exists"
			// 		},
			// 		state: "Please choose the state",
			// 		city: "Please choose the city",
			// 		course: "Please choose the course",
			// 		captcha: {
			// 			required: "Please enter the captcha",
			// 			remote: "Please enter valid captcha"
			// 		},
			// 		agree_terms: "Please check the terms and conditions",
			// 	},
			// 	/*tooltip_options: {
			// 		display_name: {placement:'left',html:true, trigger:'focus'},
			// 		email: {placement:'right',html:true, trigger:'focus'},
			// 		password: {placement:'right',html:true, trigger:'focus'},
			// 		phone_no_code: {placement:'left',html:true, trigger:'focus'},
			// 		phone_no: {placement:'bottom',html:true, trigger:'focus'},
			// 		state: {placement:'left',html:true, trigger:'focus'},
			// 		city: {placement:'bottom',html:true, trigger:'focus'},
			// 		course: {placement:'left',html:true, trigger:'focus'},
			// 		captcha: {placement:'bottom',html:true, trigger:'focus'},
			// 		agree_terms: {placement:'left',html:true, trigger:'focus'}
			// 	},*/				
			// 	submitHandler: function(form) {
					

			// 		var userData = $("#userRegisterForm").serialize();
					
			// 		$.ajax({
			// 			url: '<?php echo base_url(); ?>user/register',
			// 			method: "POST",
			// 			data: userData,
			// 			dataType: 'json',
			// 			cache: false,
			// 			beforeSend: function() {
			// 				$('.loader_btn').show();
			// 				$('.primary_loader_btn').hide();
			// 			},
			// 			success: function(returndata) {
			// 				$('.loader_btn').hide();
			// 				$('.primary_loader_btn').show();
			// 				console.log(returndata.status);
			// 				if (returndata.status == 'true') {
			// 					$('#msgs').html("<div class='alert alert-success'>"+returndata.message+"<button type='button' class='close'	data-dismiss='alert'>&times;</button></div>");
			// 					// $("#userRegisterForm")[0].reset();
			// 					setTimeout(function() { $('.alert').hide('slow'); window.location = '<?php echo base_url(); ?>'; }, 5000);
			// 				}else{
			// 					console.log(returndata.message);
			// 					returndata.message = returndata.message.replace(".", "<br/>");
			// 					$('#msgs').html("<div class='alert alert-danger'>"+returndata.message+"<button type='button' class='close'	data-dismiss='alert'>&times;</button></div>");
			// 					setTimeout(function() { $('.alert').hide('slow'); }, 4000);							
			// 				}
			// 			}
			// 		});
			// 	},
			// 	// highlight: function(element) {
			// 	// 	$("#username-error,#password-error").css('color','red');
			// 	// },			
			// });

			window.Parsley.addAsyncValidator(
		        'check_user_exists_email',
		        function (xhr) {
		        	var response = xhr.responseText;
		        	if(response == 'false') {
		        		return false;
		        	}
		            return xhr.status == 200;
		        },
		        '<?php echo base_url('check_user_exists'); ?>',
		        {
		        	type: 'post',
		            data:{
	                    email: function() {
							return $( "#email" ).val();
						},
	                    user_login: 1,
	                    for_register: 1
	                }
		        }
		    );
		    window.Parsley.addAsyncValidator(
		        'check_user_exists_phone_no',
		        function (xhr) {
		        	var response = xhr.responseText;
		        	if(response == 'false') {
		        		return false;
		        	}
		            return xhr.status == 200;
		        },
		        '<?php echo base_url('check_user_exists'); ?>',
		        {
		        	type: 'post',
		            data:{
	                    phone_no: function() {
							return $( "#phone_no" ).val();
						},
	                    user_login: 1,
	                    for_register: 1
	                }
		        }
		    );
		    window.Parsley.addAsyncValidator(
		        'check_captcha',
		        function (xhr) {
		        	var response = xhr.responseText;
		        	if(response == 'false') {
		        		return false;
		        	}
		            return xhr.status == 200;
		        },
		        '<?php echo base_url('check_captcha'); ?>',
		        {
		        	type: 'post',
		            data:{
	                    captcha: function() {
							return $( "#captcha" ).val();
						},
	                    captcha_from_path:"<?php echo $captcha_from_path; ?>"
	                }
		        }
		    );
			getCaptcha('captcha_image');
			// $(".custom-validation").parsley()
			$(".custom-validation").parsley().on('field:validated', function() {
				console.log('userRegisterForm validated');
				var ok = $('.parsley-error').length === 0;
				$('.bs-callout-info').toggleClass('hidden', !ok);
				$('.bs-callout-warning').toggleClass('hidden', ok);
			})
			.on('form:submit', function() {
				var userData = $("#userRegisterForm").serialize();
					
				$.ajax({
					url: '<?php echo base_url(); ?>user/register',
					method: "POST",
					data: userData,
					dataType: 'json',
					cache: false,
					beforeSend: function() {
						$('.loader_btn').show();
						$('.primary_loader_btn').hide();
					},
					success: function(returndata) {
						$('.loader_btn').hide();
						$('.primary_loader_btn').show();
						console.log(returndata.status);
						if (returndata.status == 'true') {
							$('#msgs').html("<div class='alert alert-success' style='text-align: left;'><button type='button' class='close'	data-dismiss='alert'>&times;</button>"+returndata.message+"</div>");
							// $("#userRegisterForm")[0].reset();
							setTimeout(function() { $('.alert').hide('slow'); 
								if(pgm_name != ''){
									window.location = '<?php echo base_url(); ?>login/'+pgm_name;}
									else { window.location = '<?php echo base_url(); ?>'; } 
								 }, 8000);
						}else{
							console.log(returndata.message);
							returndata.message = returndata.message.replace(".", "<br/>");
							$('#msgs').html("<div class='alert alert-danger' style='text-align: left;'><button type='button' class='close'	data-dismiss='alert'>&times;</button>"+returndata.message+"</div>");
							setTimeout(function() { $('.alert').hide('slow'); }, 6000);							
						}
					}
				});
				return false; // Don't submit form for this demo
			});

			if(app_form_id !='')
			{
				getSelect2('course','<?php echo base_url("regcourse_dropdown"); ?>?user_login=1&is_lookup_master=1&is_regcourse=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Choose Course', formatRepoCommon,no_degree_msg, false, formatRepoSelection);
			}
			else
			{
				getSelect2('course','<?php echo base_url("get_degrees"); ?>?user_login=1&for_register=1&sort_by=name&sort_order=asc&stream_id='+stream_val,'Choose Course', formatRepoCommon,no_degree_msg, false, formatRepoSelection);
			}
			
		});
	</script>
	<script>
	  $(function() {

	    $('#login-form-link').click(function(e) {
	    $("#login-form").delay(100).fadeIn(100);
	    $("#register-form").fadeOut(100);
	    $('#register-form-link').removeClass('active');
	    $(this).addClass('active');
	    e.preventDefault();
	  });
	  $('#register-form-link').click(function(e) {
	    $("#register-form").delay(100).fadeIn(100);
	    $("#login-form").fadeOut(100);
	    $('#login-form-link').removeClass('active');
	    $(this).addClass('active');
	    e.preventDefault();
	  });

	});

	function getCaptcha(captcha_image_id) {
		
		//During the time click the reload of captcha
		$('#captcha').val("");
		
		$.ajax({
			url: '<?php echo base_url(); ?>create_captcha',
			method: "POST",
			data: {'from_path':'<?php echo $captcha_from_path; ?>'},
			dataType: 'json',
			cache: false,
			success: function(returndata) {
				console.log(returndata.status);
				if(typeof returndata != 'undefined') {
					if (returndata.status == 'true') {
						$('#'+captcha_image_id).html(returndata.image);
					}else{
						returndata.message = '<?php echo FAIL_REGISTER_CAPTCHA_FAIL; ?>';
						$('#msgs').html("<div class='alert alert-danger'>"+returndata.message+"<button type='button' class='close'	data-dismiss='alert'>&times;</button></div>");
						setTimeout(function() { $('.alert').hide('slow'); }, 4000);							
					}	
				}
			}
		});
		
	}

	function getCaptcha_bk(captcha_image_id) {
		$.ajax({
			url: '<?php echo base_url(); ?>create_captcha',
			method: "POST",
			data: {'from_path':'<?php echo $captcha_from_path; ?>'},
			dataType: 'json',
			cache: false,
			success: function(returndata) {
				$('#'+captcha_image_id).html(returndata);
			}
		});
	}

	var no_mobile_code_msg = "Sorry, Mobile code not available.";
	var no_state_msg = "Sorry, State not available.";
	var no_city_msg = "Sorry, City not available.";	
	
	
	getSelect2('phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc','Choose Mobile Number Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);
	// var countrySelectionCount = 1;
	// var stateSelectionCount = 1;
	// var citySelectionCount = 1;
	$('#phone_no_code').on('change', function() {
		var phone_no_code_val = $(this).val();
		setEmptyOnChangeSelect2('state'); // when no values return in json, add empty option value 
		if ($('#state').data('select2')) {
			$('#state').select2('destroy');
		}
		if ($('#city').data('select2')) {
			$('#city').select2('destroy');
		}
		$('#state').html(''); // reset select values for, if user selected the value then change the country code, then select same value, and value will be null, that so we reset the select values

		$('#city').html(''); // reset select values for, if user selected the value then change the country code, then select same value, and value will be null, that so we reset the select values
		setEmptyOnChangeSelect2('city'); // when no values return in json, add empty option value 

		getSelect2('state','<?php echo base_url("get_states"); ?>?user_login=1&for_register=1&sort_by=name&sort_order=asc&country_id='+phone_no_code_val,'Choose State', formatRepoCommon,no_state_msg, false, formatRepoSelection);
		// if(countrySelectionCount > 1) {
				
		// }
		// countrySelectionCount++;
	});
	$('#state').on('change', function() {
		var state_val = $(this).val();
		setEmptyOnChangeSelect2('city'); // when no values return in json, add empty option value 
		if ($('#city').data('select2')) {
			$('#city').select2('destroy');
		}
		$('#city').html(''); // reset select values for, if user selected the value then change the country code, then select same value, and value will be null, that so we reset the select values
		getSelect2('city','<?php echo base_url("get_cities"); ?>?user_login=1&for_register=1&sort_by=name&sort_order=asc&state_id='+state_val,'Choose City', formatRepoCommon,no_city_msg, false, formatRepoSelection);
		// if(stateSelectionCount > 1) {
			
		// }
		// stateSelectionCount++;
		
	});
	
	
	/* fuction for select default country code on registration page */
	var id = "phone_no_code";
	var dbId = '<?php echo DEFAULT_MOBILE_CODE_ID; ?>';
	var dbVal = '<?php echo DEFAULT_MOBILE_CODE; ?>';
	select2Set(id,dbId,dbVal);
	$('#'+id).trigger('change');
	/* End of Code */
	
	
	// $('#city').on('change',function() {
	// 	citySelectionCount++;
	// });

	/*getSelect2('course_pref_1','<?php echo base_url("get_choice_dropdown"); ?>?is_lookup_master=1&is_course=1&is_distinct=1&grad_id='+const_grad_id+'&deg_id='+const_deg_id+'&form_id='+app_form_id+'&sort_by=name&sort_order=asc','Choose Course Perferences 1', formatRepoCommon,no_course_msg, false, formatRepoSelection);

	getSelect2('course','<?php echo base_url("get_degrees"); ?>?user_login=1&for_register=1&sort_by=name&sort_order=asc&stream_id='+stream_val,'Choose Course', formatRepoCommon,no_degree_msg, false, formatRepoSelection);*/

	

	</script>