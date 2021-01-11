<script>
$(document).ready(function() {
	$("#editProfileForm").validate({
		errorPlacement: function (error, element) {
			error.insertAfter(element);	
		},
		rules: {
			user_name: "required",
			display_name: "required",
			phone_no: 
			{
				required: true,
				digits: true,
				minlength: '<?php echo MY_PROFILE_ALT_MOBILE_NO_MIN_LIMIT;?>',
				maxlength: '<?php echo MY_PROFILE_ALT_MOBILE_NO_MAX_LIMIT;?>',
			},
			alt_phone_no: 
			{
				required: true,
				digits: true,
				minlength: '<?php echo MY_PROFILE_ALT_MOBILE_NO_MIN_LIMIT;?>',
				maxlength: '<?php echo MY_PROFILE_ALT_MOBILE_NO_MAX_LIMIT;?>',
			},			
		},
		// Specify validation error messages
		messages: {
			user_name: "Username required",
			password: "Password required",
			phone_no: {
			required: "Please enter phone number",
			digits: "Please enter valid phone number",
			minlength: "Phone number field accept only 10 digits",
			maxlength: "Phone number field accept only 10 digits",
			}, 
			alt_phone_no: {
			required: "Please enter phone number",
			digits: "Please enter valid phone number",
			minlength: "Phone number field accept only 10 digits",
			maxlength: "Phone number field accept only 10 digits",
			}, 				
			email: {
			required: "Please enter email address",
			email: "Please enter a valid email address.",
			},
		},
		submitHandler: function(form) {
			var userData = $("#editProfileForm").serialize();
			$.ajax({
				url: '<?php echo base_url(); ?>user/edit_profile',
				method: "POST",
				data: userData,
				dataType: 'json',
				cache: false,
				success: function(returndata) {
					if (returndata.status == 'true') {
						$("#editProfileButton").html('<span id="loginLoading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo MY_PROFILE_LOADING_AJAX_SUCCESS; ?>');
						setTimeout(function() { 
							$('#msgs').html("<div class='alert alert-success'>"+returndata.message+"<button type='button' class='close'	data-dismiss='alert'>&times;</button></div>");		
							setTimeout(function() { $('.alert').hide('slow'); }, 4000);	
							$("#editProfileButton").html('Save'); 
						}, 4000);		
					}else{
						$("#editProfileButton").html('<span id="loginLoading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo MY_PROFILE_LOADING_AJAX_SUCCESS; ?>');						
						$('#msgs').html("<div class='alert alert-danger'>"+returndata.message+"<button type='button' class='close'	data-dismiss='alert'>&times;</button></div>");
						setTimeout(function() { $('.alert').hide('slow'); }, 4000);							
					}
				}
			});
		},
		highlight: function(element) {
			$("#username-error,#password-error").css('color','red');
		},			
	});
});
</script>