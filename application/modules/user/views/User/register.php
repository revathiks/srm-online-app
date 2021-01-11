<style>
  /*.bs-tooltip-auto[x-placement^=left] .arrow::before, .bs-tooltip-left .arrow::before {
    border-left-color: #f00;
  }
  .bs-tooltip-auto[x-placement^=bottom] .arrow::before, .bs-tooltip-bottom .arrow::before {
    border-bottom-color: #f00;
  }

  .tooltip-inner {
    color: #f00;
    background-color: #fff;
    border: 1px solid #f9a9a9;
  }*/
  .error {
    display: none !important;
    font-size: 10px !important;
  }
  .has-error, .has-error a, .select2-selection.has-error .select2-selection__rendered {
    color: #ec5e69 !important;
  }
  span.error{
    outline: none;
    border: 1px solid #ec5e69;
    box-shadow: 0 0 5px 1px #ec5e69;
  }
  .form-control.has-error, .select2 .has-error {
    border-color: #ec5e69 !important;
  }

  .has-error::placeholder {
    color: #ec5e69;
    opacity: 1; /* Firefox */
  }

  .has-error:-ms-input-placeholder { /* Internet Explorer 10-11 */
    color: #ec5e69;
  }

  .has-error::-ms-input-placeholder { /* Microsoft Edge */
    color: #ec5e69;
  }
  span.select2-selection.select2-selection--single[aria-labelledby="select2-phone_no_code-container"] {
    border-top-right-radius: unset !important;
    border-bottom-right-radius: unset !important;
  }
  .input-group>.custom-select:not(:last-child), .input-group>.form-control:not(:last-child) {
    border-top-right-radius: 6px !important;
    border-bottom-right-radius: 6px !important;
  }
  .accountbgCC{
	  height:750px !important;
  }
  @media only screen and (max-width: 767px){
     .accountbgCC{
    height:159px !important;
  }
  }

  @media only screen and (max-width: 1023px) and (min-width: 768px){
    .account-page {
    width: 51%;
    top: 2% !important;
}
  }


  #phone_no_code {
	width:82px;  
  }
  .select2-selection--single {
	height:35px !important;  
  }
  
  .card-box{
	  padding: 0 1.5rem !important;
  }  
  .account-page {
    top: 3.5% ;    
  }
  
</style>

<h4 class="font-size-18 text-center">Free Register</h4>
<p class="text-muted text-center">Get your free SRM Admission account now.</p>

<?php  $attributes = array('class' => 'userRegisterForm mt-4 custom-validation', 'id' => 'userRegisterForm');
  echo form_open('user/', $attributes);
  ?>
  <div id="msgs"></div>
                              <!-- <div class="login-header m-0 p-0 text-center Login_header">
                                  <h4 class="srmjee">SRMJEEE <?php echo date("Y");?></h4>
                                    <h5 class="b_tech_Admission">B.Tech Admission Open</h5> 
                              </div> -->
                                  
                              <!-- <div class="row">
                                  <div class="col-md-12 "> -->
                                      <div class="form-group">
                                          <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Name" autocomplete="off" maxlength="50" data-parsley-required="true" data-parsley-nameonly="true" data-parsley-required-message="Name required" data-parsley-nameonly-message="Name must be alphabetic only.">
                                      </div>
                                  <!-- </div> -->
                                  <!-- <div class="col-md-6">
                                      <div class="form-group">
                                          <input type="text" class="form-control form_control" id="last_name" name="last_name" placeholder="Lastname">
                                      </div>
                                  </div> -->
                              <!-- </div> -->
                             <div class="form-group">
                                   <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" autocomplete="off" placeholder="Email ID" maxlength="100" data-parsley-required="true"data-parsley-type="email" data-parsley-required-message="Email required" data-parsley-type-message="Enter valid Email" data-parsley-remote="" data-parsley-remote-validator="check_user_exists_email" data-parsley-remote-message="Your Email id is already registered with us. <a href='<?php echo base_url('login'); ?>'>click here</a> to login to proceed further with your application">
                              </div>
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <!-- <select class="form-control form_control custom-select Mobile_number" >
                                          <option value="">(+91)</option>
                                          <option value="">(+93)</option>
                                      </select> -->
                                      <select class="form-control form_control custom-select Mobile_number" name="phone_no_code" id="phone_no_code" data-placeholder="Choose Mobile Number Code" title="Choose Mobile Number Code" data-parsley-required="true" data-parsley-required-message="Please enter the mobile number code" data-parsley-errors-container="#custom-phone_no_code-parsley-error"></select>


                                  </div>
                                 <!--  <input type="text" class="form-control form_control" id="exampleInputPassword1" placeholder="Mobile Number"> -->
                                  <input type="text" class="form-control error_next phone_no" id="phone_no" name="phone_no" autocomplete="off" placeholder="Mobile Number" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*" data-parsley-required="true"data-parsley-required-message="Please enter the mobile number" data-parsley-type="digits" data-parsley-type-message="Please enter the valid mobile number" data-parsley-remote="" data-parsley-remote-validator="check_user_exists_phone_no"data-parsley-remote-message="Mobile number already exists" data-parsley-errors-container="#custom-phone_no-parsley-error">
                                  <span id="custom-phone_no_code-parsley-error"></span>
                                  <span id="custom-phone_no-parsley-error"></span>
                              </div>
                                      <div class="form-group">
                                          <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" maxlength="<?php echo FORGOT_PWD_MAXLENGTH; ?>" data-parsley-required="true"data-parsley-length="[<?php echo FORGOT_PWD_MINLENGTH; ?>, <?php echo FORGOT_PWD_MAXLENGTH; ?>]" data-parsley-required-message="Password required" data-parsley-length-message="Your password must be at least <?php echo FORGOT_PWD_MINLENGTH; ?> to <?php echo FORGOT_PWD_MAXLENGTH; ?> characters long">
                                      </div>
                            
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                <select class="form-control select2" name="state" id="state" data-placeholder="Choose State" data-parsley-required="true"data-parsley-required-message="Please choose the state" data-parsley-errors-container="#custom-state-parsley-error">
                                      <option value="">Choose State</option>
                                  </select>

                                  <span id="custom-state-parsley-error"></span>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <select class="form-control select2" name="city" id="city" data-placeholder="Choose City" data-parsley-required="true" data-parsley-required-message="Please choose the city" data-parsley-errors-container="#custom-city-parsley-error">
                                      <option value="">Choose City</option>
                                  </select>

                                  <span id="custom-city-parsley-error"></span>
                                </div>
                            </div>
                          </div>
                              <div class="input-group mb-3">                                  
                                  <select class="form-control select2" name="course" id="course" data-placeholder="Choose Course" data-parsley-required="true" data-parsley-required-message="Please choose the course" data-parsley-errors-container="#custom-course-parsley-error">
                                      <option value="">Choose Course</option>
                                  </select>

                                  <span id="custom-course-parsley-error"></span>
                              </div>
                              <div class="row mb-2">
                                  <div class="col-sm-6 ">
                                    <span id="captcha_image"><?php //echo $captcha_image; ?></span>  
                                  <a id="captcha_reload" href="javascript:void(0)" onclick="getCaptcha('captcha_image')" class="float-left">Reload</a>
                                  </div>
                                  <div class="col-sm-6 captcha">
								  <input type="text" class="form-control" required="" id="captcha" name="captcha" placeholder="Enter captcha" autocomplete="off"  maxlength="<?php echo CAPTCHA_WORD_LENGTH; ?>" data-parsley-required="true" data-parsley-required-message="Please enter the captcha" data-parsley-remote="" data-parsley-remote-validator="check_captcha" data-parsley-remote-message="Please enter valid captcha">
                                  </div>
                              </div>
                              <div class="footer_align">
                                  <div class="custom-control custom-checkbox form-group">
                                      <input type="checkbox" class="custom-control-input" id="agree_terms" name="agree_terms" data-parsley-required="true" data-parsley-required-message="Please check the terms and conditions">
                                      <label class="custom-control-label" for="agree_terms">
                                          I agree to Terms &amp; Conditions
                                      </label>
                                  </div>
                                  <input type="hidden" name="role_id" id="role_id"  value="<?php echo LOGIN_ROLE_NAME_VALUE_OF_TWO;?>">
                                  <button type="submit" class="btn btn-primary primary_loader_btn w-100" value="submit"  name="submit">Register</button>
                                  <button class="btn btn-primary loader_btn" type="button" disabled style="display:none">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
                              </div>
                              <input type="hidden" name="pgm_name" id="pgm_name" value="<?php echo $pgm_name;?>">
                             
<?php form_close();?><!-- form -->
<div class="mt-2 text-center">
<p>Already have an account ? <?php if($pgm_name == ''){ ?><a href="<?php echo base_url('/login');?>" class="font-weight-medium text-primary"> Login </a> <?php } else { ?>
 <a href="<?php echo base_url('/login/'.$pgm_name);?>" class="font-weight-medium text-primary"> Login </a> <?php } ?> </p>
  
</div>