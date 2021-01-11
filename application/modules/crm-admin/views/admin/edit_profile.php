<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
 <!-- Begin page content -->
<body>
	<div class="row">
		<div class="col-xl">
			<div class="card ">
				<div class="card-body">
					<div>
						<div id="msgs"></div>
						  <?php  $attributes = array('class' => 'editProfileForm', 'id' => 'editProfileForm');
						  echo form_open('user/edit_profile', $attributes); ?>
							<div class="form-row">
								<div class="form-group col-md-6">
								<label for="inputEmail4">Comman Name:</label>
								<input type="email" class="form-control" id="cname" name="cname" placeholder="Comman Name"
								value="<?php echo $userdet['userdata']['user_details']['cn'];?>" readonly>
								</div>
								<div class="form-group col-md-6">
								<label for="inputDisplayname">Username:</label>
								<input type="text" class="form-control" id="username" name="username" required="" placeholder="DisplayName" value="<?php echo $userdet['userdata']['user_details']['username']; ?>" readonly>
								</div>
							</div>							
					</div>
				</div>
			</div>
		</div>
	</div>