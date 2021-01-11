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
</style>
<?php  $attributes = array('class' => 'userRegisterForm', 'id' => 'userRegisterForm');
  echo form_open('user/', $attributes);
  ?>
  <div id="msgs"></div>
                              <div class="login-header m-0 p-0 text-center Login_header">
                                  <h4 class="srmjee">SRMJEEE <?php echo date("Y");?></h4>
                                    <h5 class="b_tech_Admission">B.Tech Admission Open</h5> 
                              </div>
                                  
                              <div class="row">
                                  <div class="col-md-12 ">
                                      <div class="form-group">
                                          <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Name" maxlength="100">
                                      </div>
                                  </div>
                                  <!-- <div class="col-md-6">
                                      <div class="form-group">
                                          <input type="text" class="form-control form_control" id="last_name" name="last_name" placeholder="Lastname">
                                      </div>
                                  </div> -->
                              </div>
                             <div class="form-group">
                                   <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Email ID" maxlength="100">
                              </div>
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <!-- <select class="form-control form_control custom-select Mobile_number" >
                                          <option value="">(+91)</option>
                                          <option value="">(+93)</option>
                                      </select> -->
                                      <select class="form-control form_control custom-select Mobile_number" name="phone_no_code" id="phone_no_code" data-placeholder="Choose Mobile Number Code" title="Choose Mobile Number Code"></select>
                                  </div>
                                 <!--  <input type="text" class="form-control form_control" id="exampleInputPassword1" placeholder="Mobile Number"> -->
                                  <input type="text" class="form-control error_next phone_no" id="phone_no" name="phone_no" placeholder="Mobile Number" maxlength="10" onkeypress="return isNumber(event);" pattern="[0-9]*">
                                  
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="10">
                                      </div>
                                  </div>
                                 
                              </div>
                            <!--  <div class="row">
                                  <div class="col-md-6 ">
                                      <div class="form-group">
                                          <select class="form-control form_control select2 select2-hidden-accessible" data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                                              <option>Select State</option>
                                              <option value="Andhra Pradesh">Andhra Pradesh
                                              </option>
                                              <option value="Andaman and Nicobar Islands">Andaman
                                                  and Nicobar Islands</option>
                                              <option value="Arunachal Pradesh">Arunachal Pradesh
                                              </option>
                                              <option value="Assam">Assam</option>
                                              <option value="Bihar">Bihar</option>
                                              <option value="Chandigarh">Chandigarh</option>
                                              <option value="Chhattisgarh">Chhattisgarh</option>
                                              <option value="Dadar and Nagar Haveli">Dadar and
                                                  Nagar Haveli</option>
                                              <option value="Daman and Diu">Daman and Diu</option>
                                              <option value="Delhi">Delhi</option>
                                              <option value="Lakshadweep">Lakshadweep</option>
                                              <option value="Puducherry">Puducherry</option>
                                              <option value="Goa">Goa</option>
                                              <option value="Gujarat">Gujarat</option>
                                              <option value="Haryana">Haryana</option>
                                              <option value="Himachal Pradesh">Himachal Pradesh
                                              </option>
                                              <option value="Jammu and Kashmir">Jammu and Kashmir
                                              </option>
                                              <option value="Jharkhand">Jharkhand</option>
                                              <option value="Karnataka">Karnataka</option>
                                              <option value="Kerala">Kerala</option>
                                              <option value="Madhya Pradesh">Madhya Pradesh
                                              </option>
                                              <option value="Maharashtra">Maharashtra</option>
                                              <option value="Manipur">Manipur</option>
                                              <option value="Meghalaya">Meghalaya</option>
                                              <option value="Mizoram">Mizoram</option>
                                              <option value="Nagaland">Nagaland</option>
                                              <option value="Odisha">Odisha</option>
                                              <option value="Punjab">Punjab</option>
                                              <option value="Rajasthan">Rajasthan</option>
                                              <option value="Sikkim">Sikkim</option>
                                              <option value="Tamil Nadu">Tamil Nadu</option>
                                              <option value="Telangana">Telangana</option>
                                              <option value="Tripura">Tripura</option>
                                              <option value="Uttar Pradesh">Uttar Pradesh</option>
                                              <option value="Uttarakhand">Uttarakhand</option>
                                              <option value="West Bengal">West Bengal</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <select class="form-control form_control select2 select2-hidden-accessible" data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                                              <option value="">Select City</option>
                                              <option value="Chengalpattu">Chengalpattu</option>
                                              <option value="Cheyur">Cheyur</option>
                                              <option value="Kanchipuram">Kanchipuram</option>
                                              <option value="Madurantakam">Madurantakam</option>
                                              <option value="Padapai">Padapai</option>
                                              <option value="Palayanur">Palayanur</option>
                                              <option value="Sriperumbudur">Sriperumbudur</option>
                                              <option value="Tirukazhukundram">Tirukazhukundram
                                              </option>
                                              <option value="Uttiramerur">Uttiramerur</option>
                                              <option value="Vandalur R.F.">Vandalur R.F.</option>
                                              <option value="Vennangupattu">Vennangupattu</option>
                                          </select>
                                      </div>
                                  </div>
                              </div> -->
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
                              <div class="input-group mb-3">
                                  <!-- <select class="form-control form_control custom-select Mobile_number" >
                                      <option value="">Select Course</option>
                                      <option value="B-Tech">B-Tech</option>
                                  </select> -->
                                  <select class="form-control select2" name="course" id="course" data-placeholder="Choose Course">
                                      <option value="">Choose Course</option>
                                  </select>
                              </div>
                              <div class="row mb-2">
                                  <div class="col-sm-6 ">
                                    <span id="captcha_image"><?php //echo $captcha_image; ?></span>
                                      <!-- <img src="https://img.favpng.com/1/12/17/captcha-user-computer-program-computer-security-computer-software-png-favpng-cYLbb8LN7KQbB3ptGYY4swkYA.jpg"
                                          id="captcha_image" style=" width:75%; float: left;">
                                       <br>
                                      <i class="fas fa-sync-alt float-right" style="font-size: 20px;margin-top: -11px;"></i> -->

                                      <br>
                                  <a id="captcha_reload" href="javascript:void(0)" onclick="getCaptcha('captcha_image')" class="float-left">reload</a>
                                  </div>
                                  <div class="col-sm-6 captcha">                                      
                                      <!-- <input type="text" class="form-control form_control" required="" id="captcha" name="captcha" placeholder="Enter captcha"> -->
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
                                  <button type="submit" class="btn btn-primary primary_loader_btn" value="submit"  name="submit">Register</button>
                                  <button class="btn btn-primary loader_btn" type="button" disabled style="display:none">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </button>
                                  <p class="mt-2 mb-0">Already have an account? <a href="<?php echo base_url('login'); ?>">Login</a></p>
                              </div>
                             
<?php form_close();?><!-- form -->
