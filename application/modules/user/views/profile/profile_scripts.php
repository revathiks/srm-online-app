<script type="text/javascript">
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
				minlength: 10,
				maxlength: 10,
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
				email: {
				required: "Please enter email address",
				email: "Please enter a valid email address.",
				},
			},
			submitHandler: function(form) {
				var userData = $("#editProfileForm").serialize();
				
				$.ajax({
					url: '<?php echo base_url(); ?>profile',
					method: "POST",
					data: userData,
					dataType: 'json',
					cache: false,
					success: function(returndata) {
						if (returndata.status == 'true') {
							$('#msgs').html("<div class='alert alert-success'>"+returndata.message+"<button type='button' class='close'	data-dismiss='alert'>&times;</button></div>");
							setTimeout(function() { $('.alert').hide('slow'); }, 4000);		
						}else{
							
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