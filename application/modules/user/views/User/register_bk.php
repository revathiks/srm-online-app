<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title><?php echo $page_title; ?></title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/common/css/bootstrap.min.css">
<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/common/css/font-awesome.min.css">
<link rel="stylesheet"  type="text/css"  href="<?php echo base_url(); ?>assets/frontend/css/login.css">
</head>
<body>
<div class="container">
	<div id="msgs"></div>

	<section id="content">
		 <?php  $attributes = array('class' => 'userRegisterForm', 'id' => 'userRegisterForm');
                    echo form_open('user/', $attributes);
                ?>
			<h1><?php echo $page_heading_name;?></h1>
			<div>
				<input type="text" placeholder="Username" required="" id="user_name" name="user_name" />
			</div>
			<div>
				<input type="text" placeholder="Display Name" required="" id="display_name" name="display_name" />
			</div>
			<div>
				<input type="text" placeholder="Email" required="" id="email" name="email" />
			</div>
			<div>
				<input type="text" placeholder="Mobile No" required="" id="phone_no" name="phone_no" />
			</div>
			<div>
				<input type="hidden" id="password" name="password" value="<?php echo USER_PASSWORD;?>" />
			</div>
			<input type="hidden" name="role_id" id="role_id"  value="<?php echo LOGIN_ROLE_NAME_VALUE_OF_TWO;?>">
			<div>
				<button type="submit" class="user_login_btn" value="submit"  name="submit"><?php echo $save_button_name;?></button>
				<a href="<?php echo base_url(); ?>">Already Register</a>
			</div>
		<?php form_close();?><!-- form -->
		
	</section><!-- content -->
</div><!-- container -->

<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/common/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/common/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/common/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#userRegisterForm").validate({
			errorPlacement: function (error, element) {
				error.insertAfter(element);	
		    },
			rules: {
				username: "required",
				password: "required",
				display_name: "required",
				email: 
				{
				required: true,
				email: true
				},      
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
				username: "Username required",
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
				var userData = $("#userRegisterForm").serialize();
				
				$.ajax({
					url: '<?php echo base_url(); ?>user/register',
					method: "POST",
					data: userData,
					dataType: 'json',
					cache: false,
					success: function(returndata) {
						console.log(returndata.status);
						if (returndata.status == 'true') {
							/*$('#msgs').html("<div class='alert alert-success'>Logged in as "+returndata.user_details['data'][0]['role_name']+"</div>");
							$('#msgs div').css({"text-align": "center", "margin": "2% 0% auto", "width": "100%"});
							setTimeout(function() { $('.alert').hide('slow'); }, 5000);	*/						
							window.location = '<?php echo base_url(); ?>';
						}else{
							console.log(returndata.message);
							returndata.message = returndata.message.replace(".", "<br/>");
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