 <script type="text/javascript">
    // Wait for the DOM to be ready
	$(function() {
	  // Initialize form validation on the registration form.
	  // It has the name attribute "registration"
	  $("form[name='loginForm']").validate({
		// Specify validation rules
		rules: {
		  // The key name on the left side is the name attribute
		  // of an input field. Validation rules are defined
		  // on the right side
		  email: "required",
		  password: "required",
		  email: {
			required: true
		  },
		  password: {
			required: true,
			minlength: '<?php echo LOGIN_PASSWORD_LENGTH; ?>'
		  }
		},
		// Specify validation error messages
		messages: {
		  password: {
			required: "Password required",
			minlength: "Your password must be at least 5 characters long"
		  },
		   email: {
			required: "Email required"
		  }
		},
		// Make sure the form is submitted to the destination defined
		// in the "action" attribute of the form when valid
		submitHandler: function(form) {
			// Serialize Form Data
			var userData = $("#loginForm").serialize();
			$.ajax({
				url: '<?php echo base_url(); ?>login/',
				method: "POST",
				data: userData,
				dataType: 'json',
				cache: false,
				success: function(returndata) {
					var stringifyJSONLogin = JSON.stringify(returndata);
					var stringifyJSONLoginParse = JSON.parse(stringifyJSONLogin);
					var stringifyJSONLoginParseStatus = stringifyJSONLoginParse.status;
					if(stringifyJSONLoginParseStatus=='<?php echo SUCCESS_LOGIN_STATUS; ?>'){
						$("#loginSubmit").html('<span id="loginLoading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo SUCCESS_LOGIN_LOADING; ?>');
						$("#loginSubmit").attr('disabled','true');
						setTimeout(function(){
							$('#loginSubmit').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo SUCCESS_LOGIN_LOADING_AJAX_SUCCESS; ?>');window.location = '<?php echo base_url(); ?>'+stringifyJSONLoginParse.redirect;
						}, 2000);						
					}else{
						$("#loginSubmit").html('<span id="loginLoading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo SUCCESS_LOGIN_LOADING; ?>');
						$("#loginSubmit").attr('disabled','true');
						setTimeout(function(){
							$('#loginSubmit').html('<span id="loginLoading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo FAILED_LOGIN_LOADING; ?>');	window.location = '<?php echo base_url(); ?>'+stringifyJSONLoginParse.redirect;
						}, 4000);								
					}
				}
			});
		  return false;
		  //form.submit();
		}
	  });
	});
    </script>