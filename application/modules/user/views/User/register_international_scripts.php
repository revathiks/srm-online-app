<script type="text/javascript">
	var email_valid = true;
	var phone_valid = true;
	$(document).ready(function() {

		//Validation Constant





		var no_stream_msg = "Sorry, Stream not available.";
		var no_degree_msg = "Sorry, Degree not available.";
		var no_mobile_code_msg = "Sorry, Mobile Code not available.";

		// Check User Email Exists

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
	                    for_register: 1,
	                    is_international :1
	                }
		        }
		    );

		// Check User Phone Exists

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
	                    for_register: 1,
	                    is_international :1
	                }
		        }
		    );

		// Check User Captcha Exists

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
			$(".custom-validation").parsley().on('field:validated', function() {
				console.log('userRegisterForm validated');
				var ok = $('.parsley-error').length === 0;
				$('.bs-callout-info').toggleClass('hidden', !ok);
				$('.bs-callout-warning').toggleClass('hidden', ok);
			})
			.on('form:submit', function() {
				var userData = $("#internationaluserRegisterForm").serialize();
				$.ajax({
					url: '<?php echo base_url(); ?>international-form/register',
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
								window.location = '<?php echo base_url(); ?>international-form/login';
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
		
		getSelect2('stream_id','<?php echo base_url("get_reg_choice_dropdown_international"); ?>?is_lookup_master=1&is_regcourse=1&is_stream=1&is_distinct=1&sort_by=name&sort_order=asc&user_login=1','Select Stream Preference 1', formatRepoCommon,no_stream_msg, false, formatRepoSelection);

		getSelect2('phone_no_code','<?php echo base_url("get_mobile_codes"); ?>?user_login=1&sort_by=name&sort_order=asc','Select Dial Code', formatRepoCommon,no_mobile_code_msg, false, formatRepoMobileCodeSelection);

		$('#stream_id').on('change', function() {
		var stream_val = $(this).val();
		setEmptyOnChangeSelect2('state'); // when no values return in json, add empty option value 
		if ($('#deg_id').data('select2')) {
			$('#deg_id').select2('destroy');
		}
		$('#deg_id').html('');
		getSelect2('deg_id','<?php echo base_url("get_reg_choice_dropdown_international"); ?>?is_lookup_master=1&is_regcourse=1&is_distinct=1&stream_id='+stream_val+'&sort_by=name&sort_order=asc&user_login=1','Select Degree', formatRepoCommon,no_degree_msg, false, formatRepoSelection);
		});

		

	});

</script>