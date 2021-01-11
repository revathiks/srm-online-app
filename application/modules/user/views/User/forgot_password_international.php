                            
<h4 class="font-size-18 text-center">Reset Password International</h4>
    <div class="forgot_pwddiv" id="forgot_pwddiv">
        <div id="msgs"></div>
        <form name="forgotPwdForm" id="forgotPwdForm">   
                <!-- <div class="alert alert-success mt-4" role="alert" id="msgs">
                    Enter your Email and instructions will be sent to you!
                </div> -->                
                <div class="form-group">
                    <label for="useremail">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email" data-parsley-required="true" data-parsley-type="email" data-parsley-required-message="Email required" data-parsley-type-message="Enter valid Email" data-parsley-maxlength="<?php echo EMAIL_MAXLENGTH; ?>"  data-parsley-maxlength-message="Your OTP must be <?php echo EMAIL_MAXLENGTH; ?> characters long" maxlength="<?php echo EMAIL_MAXLENGTH; ?>">
                </div>
                <div class="form-group row ">
                    <div class="col-md-12 text-right">
                    <button class="btn btn-primary w-md waves-effect waves-light w-100" type="submit" id="submit_pwd">Reset</button>
                    </div>
                </div>
                <input type="hidden" name="is_international" id="is_international" value="1">
        </form>
                <div class="mt-4 pt-2 text-center">
                <p>Don't have an account ? <a href="<?php echo base_url('international-form/register');?>" class="font-weight-medium text-primary"> Signup now </a> <br/>Already have an account ?  <a href="<?php echo base_url('international-form/login');?>" class="font-weight-medium text-primary"> Login</a></p>
                <?php //echo $this->load->view('templates/copy_right', true); ?>
                </div>    
       
    </div>
    <!-- Forgot Password Div -->

    <!-- OTP Password Div -->    
    <div class="otp_forgotpwd" id="otp_forgotpwd" style="display: none;">
        <div id="msgs_otp"></div>        
        <div class="alert alert-success mt-4" role="alert">
        For your security, we need to verify your identity. we have sent an OTP on registered email id. Please enter the OTP below and proceed for password change.
        </div>
        <form name="PwdotpForm" id="PwdotpForm">                
        <div class="form-group">
                    <label for="useremail">OTP</label>
                    <input type="text" class="form-control" id="otp" name="otp" aria-describedby="emailHelp" placeholder="Your OTP" data-parsley-required="true" data-parsley-required-message="OTP required" data-parsley-maxlength="<?php echo OTP_MAXLENGTH; ?>"  data-parsley-maxlength-message="Your OTP must be <?php echo OTP_MAXLENGTH; ?> characters long" maxlength="<?php echo OTP_MAXLENGTH; ?>">
       </div>
        <div class="form-group row ">
            <div class="col-12 text-right">
            <button class="btn btn-primary w-md waves-effect waves-light" type="submit" id="submit_otp" 
            name="submit_otp">Submit</button>
            </div>
        </div>
        <input type="hidden" name="is_international" id="is_international" value="1">
        </form> 
        <div class="mt-4 pt-2 text-center">
            <p>Don't have an account ? <a href="<?php echo base_url('register');?>" class="font-weight-medium text-primary"> Signup now </a> <br/>Already have an account ?  <a href="<?php echo base_url('login');?>" class="font-weight-medium text-primary"> Login</a></p>
            <?php echo $this->load->view('templates/copy_right', true); ?>
        </div>                    
    </div>    
    <!-- OTP Password Div -->


<!-- Password verify-->
    <div class="updatepwd" id="updatepwd" style="display: none;">
        <div id="msgs_updateotp"></div>
    		<form name="updatepwdForm" id="updatepwdForm">
                <div class="form-group">
                    <label for="useremail">OTP</label>
                    <input type="text" class="form-control" id="otp_data" name="otp_data" placeholder="Your OTP" data-parsley-required="true" data-parsley-required-message="OTP required" data-parsley-maxlength="<?php echo OTP_MAXLENGTH; ?>"  data-parsley-maxlength-message="Your OTP must be <?php echo OTP_MAXLENGTH; ?> characters long" readonly="readonly" maxlength="<?php echo OTP_MAXLENGTH; ?>">
                </div>
                <div class="form-group">
                    <label for="useremail">New Password</label>
                    <input type="password" class="form-control" id="new_pwd" name="new_pwd" aria-describedby="emailHelp" placeholder="New Password" data-parsley-required="true" data-parsley-required-message="Password required" 
                    data-parsley-minlength="<?php echo LOGIN_PASSWORD_LENGTH; ?>"  data-parsley-minlength-message="Your password must be at least <?php echo LOGIN_PASSWORD_LENGTH; ?> characters long"  data-parsley-maxlength="<?php echo PWD_MAXLENGTH; ?>">
                </div>
                <div class="form-group">
                    <label for="useremail">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd" aria-describedby="emailHelp" placeholder="Re-Enter Password" data-parsley-required="true" data-parsley-required-message="Confirm Password required" 
                    data-parsley-minlength="<?php echo LOGIN_PASSWORD_LENGTH; ?>"  data-parsley-minlength-message="Your password must be at least <?php echo LOGIN_PASSWORD_LENGTH; ?> characters long" data-parsley-maxlength="<?php echo PWD_MAXLENGTH; ?>">
                </div>
                <div class="form-group row ">
                    <div class="col-12 text-right">
                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit" 
                    id="submitupdate_otp" name="submitupdate_otp">Submit</button>
                    </div>
                </div>
                <input type="hidden" name="is_international" id="is_international" value="1">
            </form>
            <div class="mt-4 pt-2 text-center">
                <p>Don't have an account ? <a href="<?php echo base_url('register');?>" class="font-weight-medium text-primary"> Signup now </a> <br/>Already have an account ?  <a href="<?php echo base_url('login');?>" class="font-weight-medium text-primary"> Login</a></p>
                <?php echo $this->load->view('templates/copy_right', true); ?>
            </div>
    </div>
<!-- Password verify-->



            
       

 