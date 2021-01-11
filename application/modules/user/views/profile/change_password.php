<div class="row">
    <div class="col-xl">
        <div class="card ">
            <div class="card-body">

                <?php if($this->session->flashdata('error')) {?>
                            <!-- <div class='alert alert-danger' style="text-align: left;"><?php echo $this->session->flashdata('error');?><button type='button' class='close'   data-dismiss='alert'>&times;</button></div> -->
                        <?php } ?>
                <?php if($this->session->flashdata('success')) {?>
                           <!--  <div class='alert alert-success' style="text-align: left;"><?php echo $this->session->flashdata('success');?><button type='button' class='close'   data-dismiss='alert'>&times;</button></div> -->
                        <?php } ?>
                        <div id="msgs"></div>
                <div class="col-lg-6">
                    <?php
                      $attributes = array('class' => 'changepwdForm', 'id' => 'changepwdForm' , 'name' => 'changepwdForm');
                      echo form_open('change-password', $attributes);
                    ?>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Old Password</label>
                            <input type="password" class="form-control" id="old_pwd" name="old_pwd" 
                                placeholder="Enter your current password" data-parsley-required="true" data-parsley-required-message="Please Enter Old Password" data-parsley-minlength="<?php echo LOGIN_PASSWORD_LENGTH; ?>"  data-parsley-minlength-message="Your old password must be at least <?php echo LOGIN_PASSWORD_LENGTH; ?> characters long"  data-parsley-maxlength="<?php echo PWD_MAXLENGTH; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" class="form-control" id="new_pwd" name="new_pwd" 
                                placeholder="Enter your new password"  data-parsley-required="true" data-parsley-required-message="Please Enter New Password" data-parsley-minlength="<?php echo LOGIN_PASSWORD_LENGTH; ?>"  data-parsley-minlength-message="Your new password must be at least <?php echo LOGIN_PASSWORD_LENGTH; ?> characters long"  data-parsley-maxlength="<?php echo PWD_MAXLENGTH; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd"  placeholder="Confirm your password"  data-parsley-required="true" data-parsley-required-message="Please Enter Confirm Password" data-parsley-minlength="<?php echo LOGIN_PASSWORD_LENGTH; ?>"  data-parsley-minlength-message="Your confirm password must be at least <?php echo LOGIN_PASSWORD_LENGTH; ?> characters long"  data-parsley-maxlength="<?php echo PWD_MAXLENGTH; ?>">
                        </div>
                        <button type="submit" name="submit" id="submit_pwd" class="btn btn-primary" value="true">Save</button>
                   <?php form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>

