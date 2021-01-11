<script type="text/javascript">
 	$(function() {
  

  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='forgotPwdForm']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      email: "required",
      email: {
        required: true,
        email:true,
        minlength:'<?php echo FORGOT_PWD_MINLENGTH; ?>',
        maxlength: '<?php echo FORGOT_PWD_MAXLENGTH; ?>',
      }
    },
    // Specify validation error messages
    messages: {
      email: {
        required: "Please enter your email.",
        minlength: "Your password must be at least 5 characters long",
        minlength: "Your password not exceed 20 characters",
        email:'You have entered an invalid email.',
      },
     
    },
    highlight: function (element) {
             $(element).parent().addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).parent().removeClass('has-error');
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      //form.submit();
      var userData = $("#forgotPwdForm").serialize();
      var status = 'success';
      $.ajax({
                url: '<?php echo base_url(); ?>forgot_password/',
                method: "POST",
                data: userData,
                dataType: 'json',
                cache: false,
                beforeSend: function(){
                //$("#submit_profile").attr('disabled','true');
                $("#submit_pwd").html('<span id="loginLoading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo LOADING_AJAX; ?>');
                },
                success: function(returndata) {
                	console.log(returndata.status);
                  if(returndata.status === 'error') { status = 'danger' ; 
                  $("#otp_forgotpwd").hide();
                  $("#forgot_pwddiv").show();
                  $("#updatepwd").hide();
							setTimeout(function(){
							$('#msgs').html("<div class='alert alert-"+status+"'>"+returndata.message+"<button type='button' class='close'  data-dismiss='alert'>&times;</button></div>");    
							setTimeout(function() { $('.alert').hide('slow'); }, 4000); 
							$("#submit_pwd").html('Submit');
							}, 1000);
                        }
                    else
                    {
                    	$("#otp_forgotpwd").show();
                    	$("#forgot_pwddiv").hide(); 
                    	$("#updatepwd").hide(); 
                    	                   	
                    }
                }
            });

    }
  });



  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='PwdotpForm']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      otp: "required",
      otp: {
        required: true,
        minlength:'<?php echo OTP_MINLENGTH; ?>',
        maxlength: '<?php echo OTP_MAXLENGTH; ?>',
      }
    },
    // Specify validation error messages
    messages: {
      otp: {
        required: "Please enter OTP Code.",
        minlength: "Your password must be at least 6 characters long",
        minlength: "Your password not exceed 6 characters",
      },
     
    },
    highlight: function (element) {
             $(element).parent().addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).parent().removeClass('has-error');
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      //form.submit();
      var userData = $("#PwdotpForm").serialize();
      var status = 'success';
      $.ajax({
                url: '<?php echo base_url(); ?>otp_forgotpassword/',
                method: "POST",
                data: userData,
                dataType: 'json',
                cache: false,
                beforeSend: function(){
                //$("#submit_profile").attr('disabled','true');
                $("#submit_otp").html('<span id="loginLoading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo LOADING_AJAX; ?>');
                },
                success: function(returndata) {
                	console.log(returndata.status);
                  if(returndata.status === 'error') { status = 'danger' ; 
                  $("#otp_forgotpwd").show();
                  $("#forgot_pwddiv").hide();
                  $("#updatepwd").hide();
							setTimeout(function(){
							$('#msgs_otp').html("<div class='alert alert-"+status+"'>"+returndata.message+"<button type='button' class='close'  data-dismiss='alert'>&times;</button></div>");    
							setTimeout(function() { $('.alert').hide('slow'); }, 4000); 
							$("#submit_otp").html('Submit');
							}, 1000);
                        }
                    else
                    {
                    	$("#otp_forgotpwd").hide();
                    	$("#forgot_pwddiv").hide(); 
                    	$("#otp_data").val(returndata.message);
                    	$("#updatepwd").show();
                    	$("#submit_otp").html('Submit');
                    }
                }
            });

    }
  });


  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='updatepwdForm']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      otp_data: "required",
      new_pwd: "required",
      confirm_pwd : "required",
      otp_data: {
        required: true,
        minlength:'<?php echo OTP_MINLENGTH; ?>',
        maxlength: '<?php echo OTP_MAXLENGTH; ?>',
      },
      new_pwd: {
        required: true,
        minlength: '<?php echo CHANGE_PWD_MINLENGTH; ?>',
        maxlength: '<?php echo CHANGE_PWD_MAXLENGTH; ?>',
      },
      confirm_pwd:{
        required: true,
        equalTo: "#new_pwd"
      }
    },
    // Specify validation error messages
    messages: {
      otp_data: {
        required: "Please enter OTP Code.",
        minlength: "Your password must be at least 6 characters long",
        minlength: "Your password not exceed 6 characters",
      },
      new_pwd: {
        required: "Please enter new password.",
        minlength: "Your password must be at least 5 characters long",
        minlength: "Your password not exceed 20 characters",
      },
      confirm_pwd:{
        required: "Please enter confirm password.",
        equalTo: "Password doesn't match with new password",
      },
     
    },
    highlight: function (element) {
             $(element).parent().addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).parent().removeClass('has-error');
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      //form.submit();
      var userData = $("#updatepwdForm").serialize();
      var status = 'success';
      $.ajax({
                url: '<?php echo base_url(); ?>otp_updateforgotpassword/',
                method: "POST",
                data: userData,
                dataType: 'json',
                cache: false,
                beforeSend: function(){
                //$("#submit_profile").attr('disabled','true');
                $("#submitupdate_otp").html('<span id="loginLoading" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> <?php echo LOADING_AJAX; ?>');
                },
                success: function(returndata) {
                	console.log(returndata.status);
					if(returndata.status === 'error') { status = 'danger' ; 
						$("#otp_forgotpwd").hide();
						$("#forgot_pwddiv").hide();
						$("#updatepwd").show();
						setTimeout(function(){
						$('#msgs_updateotp').html("<div class='alert alert-"+status+"'>"+returndata.message+"<button type='button' class='close'  data-dismiss='alert'>&times;</button></div>");    
						setTimeout(function() { $('.alert').hide('slow'); }, 4000); 
						$("#submitupdate_otp").html('Submit');
						}, 1000);
					}
					 else
					 {
					 	$("#updatepwdForm :input").prop('readonly', true);
					 	setTimeout(function(){
							$('#msgs_updateotp').html("<div class='alert alert-"+status+"'>"+returndata.message+"<button type='button' class='close'  data-dismiss='alert'>&times;</button></div>");    
							setTimeout(function() { $('.alert').hide('slow'); window.location = 'login'}, 5000); 
							$("#submitupdate_otp").html('Success');
							$("#submitupdate_otp").attr('disabled','true');
							}, 1000);
					 }
                }
            });

    }
  });

});
 </script>