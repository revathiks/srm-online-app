<?php
$is_international=isset($is_international)?$is_international : '';
if($is_international)
{
  $url = base_url('internationaluser_change_password');
}
else {
  $url = base_url('change-password/');

}
?>

<script type="text/javascript">
        // Wait for the DOM to be ready

 $(function () {

        $("form[name='changepwdForm']").parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
      })
      .on('form:submit', function() {
      // Serialize Form Data
    var userData = $("#changepwdForm").serialize();
    var status = 'success';
    $.ajax({
                url: '<?php echo $url ;?>',
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
                  if(returndata.status === 'error') { status = 'danger'  }; 
                  $("#otp_forgotpwd").hide();
                  $("#forgot_pwddiv").show();
                  $("#updatepwd").hide();
              setTimeout(function(){
              $('#msgs').html("<div class='alert alert-"+status+"' id='alert'>"+returndata.message+"<button type='button' class='close'  data-dismiss='alert'>&times;</button></div>");    
              setTimeout(function() { window.location.reload(); $('#alert').hide('slow'); }, 4000); 
              $("#submit_pwd").html('Submit');
              }, 1000);

                }
            });
    
      return false; // Don't submit form for this demo
    });

      });
</script>