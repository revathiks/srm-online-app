<div class="row">
    <div class="col-xl">
        <div class="card ">
            <div class="card-body">
                <div>
                    <div id="msgs"></div>
                    <?php  $attributes = array('class' => 'editProfileForm', 'id' => 'editProfileForm');
                    echo form_open('profile', $attributes);
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Display Name </label>
                            <input type="text" class="form-control" id="display_name" name="display_name" required="" placeholder="Display Name" value="<?php echo $userdet['data']['display_name'];?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" readonly="readonly" value="<?php echo $userdet['data']['email'];?>">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputAddress">Mobile Number &nbsp; &nbsp; &nbsp; <i class='fas fa-info-circle' style='font-size:16px' data-toggle="tooltip" data-placement="right" title="All communication related to Application will sent on this number."></i></label>
                            <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Phone No" value="<?php echo $userdet['data']['phone_no'];?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAddress2">Username</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Username" readonly="readonly" value="<?php echo $userdet['data']['user_name'];?>">
                        </div>
                    </div>
                    <!-- <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" id="inputCity">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState">State</label>
                            <select id="inputState" class="form-control custom-select">
                                <option selected="">Choose...</option>
                                <option>Tamil Nadu</option>
                                <option>Kerala</option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputZip">Course</label>
                            <input type="text" class="form-control" id="inputZip">
                        </div>
                    </div> -->

                    <button type="submit" name="submit" value="submit" class="btn btn-primary"><a><?php echo $save_button_name; ?></a></button>
                    <?php form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>

