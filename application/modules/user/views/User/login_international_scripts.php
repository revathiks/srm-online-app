 <script type="text/javascript">
    // Wait for the DOM to be ready
	$(function() {
		setTimeout(function() { $('.alert').hide('slow'); }, 7000); 
		var pgm_name = '<?php echo $pgm_name;?>';

	  // Initialize form validation on the registration form.
	  // It has the name attribute "registration"
	 //  $("form[name='loginForm']").validate({
		// // Specify validation rules
		// rules: {
		//   // The key name on the left side is the name attribute
		//   // of an input field. Validation rules are defined
		//   // on the right side
		//   email: "required",
		//   password: "required",
		//   email: {
		// 	required: true
		//   },
		//   password: {
		// 	required: true,
		// 	minlength: '<?php echo LOGIN_PASSWORD_LENGTH; ?>'
		//   }
		// },
		// // Specify validation error messages
		// messages: {
		//   password: {
		// 	required: "Password required",
		// 	minlength: "Your password must be at least 5 characters long"
		//   },
		//    email: {
		// 	required: "Email required"
		//   }
		// },
		// // Make sure the form is submitted to the destination defined
		// // in the "action" attribute of the form when valid
		// submitHandler: function(form) {
		// 	// Serialize Form Data
		// 	var userData = $("#loginForm").serialize();
		// 	$.ajax({
		// 		url: '<?php echo base_url(); ?>login/',
		// 		method: "POST",
		// 		data: userData,
		// 		dataType: 'json',
		// 		cache: false,
		// 		success: function(returndata) {
		// 			var stringifyJSONLogin = JSON.stringify(returndata);
		// 			var stringifyJSONLoginParse = JSON.parse(stringifyJSONLogin);
		// 			var stringifyJSONLoginParseStatus = stringifyJSONLoginParse.status;
		// 			if(stringifyJSONLoginParseStatus=='<?php echo SUCCESS_LOGIN_STATUS; ?>'){
		// 				$("#loginSubmit").html('<span id="loginLoading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo SUCCESS_LOGIN_LOADING; ?>');
		// 				$("#loginSubmit").attr('disabled','true');
		// 				setTimeout(function(){
		// 					$('#loginSubmit').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo SUCCESS_LOGIN_LOADING_AJAX_SUCCESS; ?>');window.location = '<?php echo base_url(); ?>'+stringifyJSONLoginParse.redirect;
		// 				}, 2000);						
		// 			}else{
		// 				$("#loginSubmit").html('<span id="loginLoading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo SUCCESS_LOGIN_LOADING; ?>');
		// 				$("#loginSubmit").attr('disabled','true');
		// 				setTimeout(function(){
		// 					$('#loginSubmit').html('<span id="loginLoading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo FAILED_LOGIN_LOADING; ?>');	window.location = '<?php echo base_url(); ?>'+stringifyJSONLoginParse.redirect;
		// 				}, 4000);								
		// 			}
		// 		}
		// 	});
		//   return false;
		//   //form.submit();
		// }
	 //  });

	  $("form[name='internationalloginForm']").parsley().on('field:validated', function() {
	    var ok = $('.parsley-error').length === 0;
	    $('.bs-callout-info').toggleClass('hidden', !ok);
	    $('.bs-callout-warning').toggleClass('hidden', ok);
	  })
	  .on('form:submit', function() {
	  	// Serialize Form Data
		var userData = $("#internationalloginForm").serialize();
		$.ajax({
			url: '<?php echo base_url(); ?>international-form/login',
			method: "POST",
			data: userData,
			dataType: 'json',
			cache: false,
			beforeSend: function() { 
				$("#loginSubmit").html('<span id="loginLoading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo SUCCESS_LOGIN_LOADING; ?>');
				$("#loginSubmit").attr('disabled','true'); 
			},
			success: function(returndata) {
				var stringifyJSONLogin = JSON.stringify(returndata);
				var stringifyJSONLoginParse = JSON.parse(stringifyJSONLogin);
				var stringifyJSONLoginParseStatus = stringifyJSONLoginParse.status;
				if(stringifyJSONLoginParseStatus=='<?php echo SUCCESS_LOGIN_STATUS; ?>'){
					$("#loginSubmit").html('<span id="loginLoading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo SUCCESS_LOGIN_LOADING; ?>');
					$("#loginSubmit").attr('disabled','true');
					setTimeout(function(){
						$('#loginSubmit').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo SUCCESS_LOGIN_LOADING_AJAX_SUCCESS; ?>');
						if(pgm_name != ''){
							window.location = '<?php echo base_url(); ?>'+pgm_name; }else {
								window.location = '<?php echo base_url(); ?>'+stringifyJSONLoginParse.redirect;
						}
				
					}, 2000);						
				}else{
					$("#loginSubmit").html('<span id="loginLoading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo SUCCESS_LOGIN_LOADING; ?>');
					$("#loginSubmit").attr('disabled','true');
					setTimeout(function(){
						$('#loginSubmit').html('<span id="loginLoading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo FAILED_LOGIN_LOADING; ?>');	window.location = '<?php echo base_url(); ?>international-form/'+stringifyJSONLoginParse.redirect;
					}, 4000);								
				}
			}
		});
	    return false; // Don't submit form for this demo
	  });
	});
    </script>