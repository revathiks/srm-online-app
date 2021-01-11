<style>
.align-card {
background:#f8f8fa;	
}
.align-card > .card-body {
padding:0;	
}

#display_name, #email, #phone_no, #alt_phone_no, #user_state {
  color:  #424242;	
}

</style>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
 <!-- Begin page content -->
<body>
	<div class="row">
		<div class="col-xl">
			<div class="card ">
				<div class="card-body">
					<div>
						<div id="msgs"></div>
							<?php  	
							$attributes = array('class' => 'editProfileForm', 'id' => 'editProfileForm');
							echo form_open('user/edit_profile', $attributes);?>
						<div class="form-row">
							<div class="form-group col-md-4">
							<label for="inputDisplayname">Display Name:</label>
							<input type="text" class="form-control" id="display_name" name="display_name" required="" placeholder="DisplayName" readonly="readonly" value="<?php echo $userdet['data']['first_name']."".$userdet['data']['last_name'];?>">
							</div>	
							<div class="form-group col-md-4">
							<label for="inputEmail4">Email Address:</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Email" readonly="readonly" readonly="readonly" value="<?php echo $userdet['data']['email_id'];?>">
							</div>
							<div class="form-group col-md-4">
							<label for="inputAddress">Mobile No:</label>
							<input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Phone No" readonly="readonly" value="<?php echo $userdet['data']['mobile_no'];?>">
							</div>																	
						</div>

						<div class="form-row">
						<div class="form-group col-md-4">
							<label for="inputAddress">Alternate Mobile No:</label>
							<input type="text" class="form-control" id="alt_phone_no" name="alt_phone_no" placeholder="Alternate Phone No" readonly="readonly" value="<?php echo $userdet['data']['second_mobile_no'];?>">
							</div>
							<!--<div class="form-group col-md-3">
							<label for="inputAddress2">Username:</label>
							<input type="text" class="form-control" id="user_name" name="user_name" placeholder="Username" readonly="readonly" value="<?php echo $userdet['data']['user_name'];?>">
							</div>-->
							<div class="form-group col-md-4">
								<label for="inputState">State:</label>
								<input type="text" class="form-control" id="user_state" name="user_state" placeholder="State" readonly="readonly" value="<?php echo $userdet['data']['state_name'];?>">
							</div>	
							<div class="form-group col-md-4">
								<label for="inputState">City:</label>
								<input type="text" class="form-control" id="user_state" name="user_state" placeholder="State" readonly="readonly" value="<?php echo $userdet['data']['city_name'];?>">
							</div>							
						</div>								
						<div class="form-row">
							<div class="form-group col-md-6">
								<!--<button type="submit" name="submit" value="submit" class="btn btn-primary" id="editProfileButton"><?php echo $save_button_name; ?></button>-->
							</div>							
						</div>
						<?php form_close();?>
					<!-- form -->
					</div>
				</div>
			</div>
		</div>
	</div>