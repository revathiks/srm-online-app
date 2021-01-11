<body>
	<?php  $attributes = array('class' => 'userRegisterForm', 'id' => 'userRegisterForm');
	echo form_open('user/', $attributes);
	?>
	<!-- Page Container -->
	<div class="page-container">
		<div class="login">
			<div class="login-bg"></div>
			<div class="login-content">
				<div class="login-box login_box">
					<div class="login-body login_align login_body">
						<form>
							<div class="login-header m-0 p-0 Login_header">
								<h3>New Registration</h3>
								<!-- <p>Complete this simple form to register.</p> -->
							</div>
							<div id="msgs"></div>
							<!-- <div class="row"> -->
                                <!-- <div class="col-md-6">
                                    <div class="form-group mr-3">
									    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Username " maxlength="20">
	                        		</div>
	                        	</div> -->
	                        	<!-- <div class="col-md-6"> -->
	                        		<div class="form-group">
	                            		<input type="text" class="form-control" id="display_name" name="display_name" placeholder="Name" maxlength="100">
	                            	</div>
	                            <!-- </div> -->
	                        <!-- </div> -->
	                        <div class="form-group">
	                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Email ID" maxlength="100">
	                        </div>
	                        <div class="row">
								<div class="col-md-6">
			                        <div class="form-group">
			                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="10">
			                        </div>
			                    </div>
			                    <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" maxlength="10">
                                    </div>
                                </div>
                            </div>
	                        <div class="input-group mb-3">
	                            <div class="input-group-prepend">
	                                <select class="form-control error_next" name="phone_no_code" id="phone_no_code" data-placeholder="Choose Mobile Number Code" title="Choose Mobile Number Code"></select>
	                            </div>
	                            <input type="text" class="form-control error_next phone_no" id="phone_no" name="phone_no" placeholder="Mobile Number" maxlength="10">
	                        </div>
                        	<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
	                        			<select class="form-control select2" name="state" id="state" data-placeholder="Choose State">
			                                <option value="">Choose State</option>
			                            </select>
			                        </div>
                        		</div>
                        		<div class="col-sm-6">
                        			<div class="form-group">
                        				<select class="form-control select2" name="city" id="city" data-placeholder="Choose City">
		                                	<option value="">Choose City</option>
		                            	</select>
		                            </div>
                        		</div>
                        	</div>
	                        <div class="row ">
                        		<div class="form-group col-sm-12 ">
                        			<div class="input-group">
		                            	<select class="form-control select2" name="course" id="course" data-placeholder="Choose Course">
		                                	<option value="">Choose Course</option>
		                            	</select>
                            		</div>
                            	</div>
	                        </div>
	                        <div class="row mb-2">
								<div class="col-sm-6">
	                            	<span id="captcha_image"><?php //echo $captcha_image; ?></span>
	                                <!-- <img src="https://img.favpng.com/1/12/17/captcha-user-computer-program-computer-security-computer-software-png-favpng-cYLbb8LN7KQbB3ptGYY4swkYA.jpg" id="captcha_image" style=" width: 100%;"> -->
	                                <br>
	                                <a id="captcha_reload" href="javascript:void(0)" onclick="getCaptcha('captcha_image')" class="float-left">reload</a>
	                            </div>
	                            <div class="col-sm-6">
	                                <input type="text" class="form-control" required="" id="captcha" name="captcha" placeholder="Enter captcha"  maxlength="<?php echo CAPTCHA_WORD_LENGTH; ?>">
	                            </div>
	                        </div>
	                        <div class="footer_align">
		                        <div class="custom-control custom-checkbox form-group">
		                            <input type="checkbox" class="custom-control-input" id="agree_terms" name="agree_terms">
		                            <label class="custom-control-label" for="agree_terms">
		                                I agree to <a href="#" data-toggle="modal" data-target="#exampleModalCenter">Terms &amp; Conditions</a>
		                            </label>
		                        </div>
		                        <input type="hidden" name="role_id" id="role_id"  value="<?php echo LOGIN_ROLE_NAME_VALUE_OF_TWO;?>">
		                        <div class="form-group">
		                        	<button type="submit" class="btn btn-primary primary_loader_btn" value="submit"  name="submit">Register</button>
		                        	<button class="btn btn-primary loader_btn" type="button" disabled style="display:none">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
		                        	<p class="m-t-sm">Already have an account? <a href="<?php echo base_url('login'); ?>">Login</a></p>
		                    	</div>
		                    </div>
	                    </form>
                    </div>
                </div>
			</div>
		</div>
	</div><!-- /Page Container -->
	<?php form_close();?><!-- form -->
	
