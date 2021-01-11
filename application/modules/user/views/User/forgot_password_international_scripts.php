<script type="text/javascript">
 	$(function() {
    $("form[name='forgotPwdForm']").parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
      })
      .on('form:submit', function() {
      // Serialize Form Data
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
              $('#msgs').html("<div class='alert alert-"+status+"' id='alert'>"+returndata.message+"<button type='button' class='close'  data-dismiss='alert'>&times;</button></div>");    
              setTimeout(function() { $('#alert').hide('slow'); }, 4000); 
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
    
      return false; // Don't submit form for this demo
    });

$("form[name='PwdotpForm']").parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
      })
      .on('form:submit', function() {
      // Serialize Form Data
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
              $('#msgs_otp').html("<div class='alert alert-"+status+"' id='alert'>"+returndata.message+"<button type='button' class='close'  data-dismiss='alert'>&times;</button></div>");    
              setTimeout(function() { $('#alert').hide('slow'); }, 4000); 
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
    
      return false; // Don't submit form for this demo
    });

$("form[name='updatepwdForm']").parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
      })
      .on('form:submit', function() {
      // Serialize Form Data
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
            $('#msgs_updateotp').html("<div class='alert alert-"+status+"' id='alert'>"+returndata.message+"<button type='button' class='close'  data-dismiss='alert'>&times;</button></div>");    
            setTimeout(function() { $('#alert').hide('slow'); }, 4000); 
            $("#submitupdate_otp").html('Submit');
            }, 1000);
          }
           else
           {
            $("#updatepwdForm :input").prop('readonly', true);
            setTimeout(function(){
              $('#msgs_updateotp').html("<div class='alert alert-"+status+"'>"+returndata.message+"<button type='button' class='close'  data-dismiss='alert'>&times;</button></div>");    
              setTimeout(function() { $('.alert').hide('slow'); 
                window.location = '<?php echo base_url(); ?>international-form/login';}, 5000); 
              $("#submitupdate_otp").html('Success');
              $("#submitupdate_otp").attr('disabled','true');
              }, 1000);
           }
                }
            });
    
      return false; // Don't submit form for this demo
    });
  



  


 

});
 </script>