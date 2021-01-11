<body>

      
            <!-- Page Container -->

            <div class="page-container">
                <div class="login">

                    <div class="login-bg"></div>

                    <div class="login-content">

                    	<!-- Forgot Password Div -->
                        <div class="login-box" id="forgot_pwddiv">
                            <div class="login-header">
                                <!-- <img src="img/srm-logo-blue.png" alt=""> -->
                                <div id="msgs"></div>
                                <h3>Forgot Password</h3>
                                
                            </div>
                            <div class="login-body">
								<?php
								/*$attributes = array('class' => 'forgotPwdForm', 'id' => 'forgotPwdForm' , 'name' => 'forgotPwdForm');
								echo form_open('login', $attributes);*/
								?>
								<form name="forgotPwdForm" id="forgotPwdForm">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder=" Your Email">
                                    </div>
                                    
                                    <button type="submit" id="submit_pwd" class="btn btn-primary">Submit</button>
                                <?php //form_close();?>
                            </form>
                                <p class="m-t-sm"><a href="<?php echo base_url();?>login">Login Now</a><br><a href="<?php echo base_url();?>register">New Registration</a></p>
                            </div>
                        </div>
                        <!-- Forgot Password Div -->

                        <!-- OTP Password Div -->
                        <div class="login-box" id="otp_forgotpwd" style="display: none;">
                            <div class="login-header">
                                <!-- <img src="img/srm-logo-blue.png" alt=""> -->
                                <div id="msgs_otp"></div>
                                <p>For your security, we need to verify your identity. we have sent an OTP on registered email id and mobile number. Please enter the OTP below and proceed for password change.</p>
                                
                            </div>
                            <div class="login-body">
								<form name="PwdotpForm" id="PwdotpForm">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="otp" name="otp" aria-describedby="emailHelp" placeholder=" Your OTP">
                                    </div>
                                    <button type="submit" id="submit_otp" name="submit_otp" class="btn btn-primary" value="true">Submit</button>
                                </form>
                                <p class="m-t-sm"><a href="<?php echo base_url();?>login">Login Now</a><br><a href="<?php echo base_url();?>register">New Registration</a></p>
                                
                            </div>
                        </div>
                        <!-- OTP Password Div -->


                        <!-- Password verify-->
                        <div class="login-box" id="updatepwd" style="display: none;">
                            <div class="login-header">
                                <!-- <img src="img/srm-logo-blue.png" alt=""> -->
                                <div id="msgs_updateotp"></div>
                            </div>
                            <div class="login-body">
								<form name="updatepwdForm" id="updatepwdForm">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="otp_data" name="otp_data" aria-describedby="emailHelp" placeholder=" Your OTP" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="new_pwd" name="new_pwd" aria-describedby="emailHelp" placeholder="New Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd" aria-describedby="emailHelp" placeholder="Re-Enter Password">
                                    </div>
                                    
                                    <button type="submit" id="submitupdate_otp" name="submitupdate_otp" value="true"  class="btn btn-primary">Submit</button>
                                </form>
                                <p class="m-t-sm"><a href="<?php echo base_url();?>login">Login Now</a><br><a href="<?php echo base_url();?>register">New Registration</a></p>
                                
                            </div>
                        </div>
                        <!-- Password verify-->



                    </div>

                </div>
            </div><!-- /Page Container -->
            
       

 