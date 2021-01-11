<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
 <!-- Begin page content -->
 <body>
    <div class="container">
	<div class="page-header">
		<h3><?php echo $page_heading_name;?></h3>
	</div>

	<div id="msgs"></div>
  <?php  $attributes = array('class' => 'editProfileForm', 'id' => 'editProfileForm');
                    echo form_open('user/edit_profile', $attributes);
                ?>
	<div class="form-row">
		<div class="form-group col-md-6">
		<label for="inputEmail4">Email:</label>
		<input type="email" class="form-control" id="email" name="email" placeholder="Email" readonly="readonly"
		value="<?php echo $userdet['data']['email'];?>">
		</div>
		<div class="form-group col-md-6">
		<label for="inputDisplayname">Display Name:</label>
		<input type="text" class="form-control" id="display_name" name="display_name" required="" placeholder="DisplayName" value="<?php echo $userdet['data']['display_name'];?>">
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-6">
		<label for="inputAddress">Phone No:</label>
		<input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Phone No" 
		value="<?php echo $userdet['data']['phone_no'];?>">
		</div>
		<div class="form-group col-md-6">
		<label for="inputAddress2">Username </label>
		<input type="text" class="form-control" id="user_name" name="user_name" placeholder="Username" readonly="readonly" value="<?php echo $userdet['data']['user_name'];?>">
		</div>
	</div>
  <button type="submit" name="submit" value="submit"><?php echo $save_button_name; ?></button>
<?php form_close();?><!-- form -->
</div>
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
					url: '<?php echo base_url(); ?>user/edit_profile',
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
</body>


