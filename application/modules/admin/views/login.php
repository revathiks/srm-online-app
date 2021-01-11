<?php
$title = $sitename.' - '.$site_title;

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/common/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/common/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/css/login.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
    <div class="container">
      <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-12">
                Login
              </div>
            </div>
            <hr>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <?php
                    $attributes = array('class' => 'loginForm', 'id' => 'loginForm');
                    echo form_open('admin/login', $attributes);
                ?>
                  <div class="form-group">
                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>

                 <!--  <div class="form-group">
                      <select class="form-control" name="role_id">
                      <option value="<?php echo LOGIN_ROLE_NAME_VALUE_OF_ONE; ?>"><?php echo LOGIN_ROLE_NAME_ONE; ?></option>
                      <option value="<?php echo LOGIN_ROLE_NAME_VALUE_OF_TWO; ?>"><?php echo LOGIN_ROLE_NAME_TWO; ?></option>
                      </select>
                  </div> -->

                  <input type="hidden" name="role_id" id="role_id"  value="<?php echo LOGIN_ROLE_NAME_VALUE_OF_ONE;?>">

                  <div class="form-group text-center">
                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                    <label for="remember"> Remember Me</label>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <!-- <input type="submit" name="submit" class="form-control btn btn-login" value="Log In"> -->
                        <button type="submit" name="submit" class="form-control btn btn-login" value="true">Sign In</button>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="text-center">
                          <a href="https://phpoll.com/recover" tabindex="5" class="forgot-password">Forgot Password?</a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php form_close();?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/common/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/common/js/bootstrap.min.js"></script>
<script src=<?php echo base_url ("assets/common/js/jquery.validate.min.js"); ?>></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#loginForm").validate({
			errorPlacement: function (error, element) {
				error.insertAfter(element);	
		    },
			rules: {
				username: "required",
				password: "required",
			},
			// Specify validation error messages
			messages: {
				username: "Username required",
				password: "Password required",
			},
			submitHandler: function(form) {
				var userData = $("#loginForm").serialize();
				
				$.ajax({
					url: '<?php echo base_url(); ?>admin/login',
					method: "POST",
					data: userData,
					dataType: 'json',
					cache: false,
					success: function(returndata) {
						console.log(returndata);

						if (returndata.login_ok == 'true') {
							window.location = '<?php echo base_url(); ?>admin/dashboard';
						}else{
							$('#msgs').html("<div class='alert alert-danger'>"+returndata.message+"</div>");
							$('#msgs div').css({"text-align": "left", "margin": "2% 0% auto", "width": "100%"});
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

</script>
</body>
</html>
