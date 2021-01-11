<style>
   label. {
   width: 100%;
   }
   span.select2.select2-container.select2-container--bootstrap {
   width: 100% !important;
   }
</style>
<div class="row">
   <div class="col-sm-12">
        <?php
        $attributes = array('class' => 'form-horizontal form-wizard-wrapper .custom-validation', 'id' => 'bmtechparttime_form', 'name' => 'bmtechparttime_form', 'enctype' => 'multipart/form-data', 'data-parsley-validate data-toggle'=>"validator");

        echo form_open('', $attributes);
        ?>
         <div class="text-right w-100"><button class="btn btn-primary">Step 1 of 7</button></div>
         <h3>Basic Details</h3>
         <fieldset>
            <div id="accordion" class="accordion w-100" role="tablist"
               aria-multiselectable="true">
               <div class="card ">
                  <div class="card-header p-0 " role="tab" id="headingOne">
                     <h6 class="p-2 ml-3">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#collapseOne" aria-expanded="false"
                           aria-controls="collapseOne"
                           class="tx-gray-800 transition collapsed instruction_accordion">
                        <i class="fas fa-info-circle"></i>
                        Instructions</a>
                     </h6>
                  </div>
                  <!-- card-header -->
                  <div id="collapseOne" class="collapse bg-light" role="tabpanel"
                     aria-labelledby="headingOne" style="">
                     <div class="card-body" style="font-size: 13px;">SRMJEEE is
                        common for all campuses. At the time of counselling,student
                        can select branch and campus as per
                        availability. Course preference is collected for statistical
                        purpose only, final decision on course selection would be
                        made on the day of counselling only.
                     </div>
                  </div>
               </div>
               <!-- card -->
            </div>
            <div class="row mg-b-25 mt-3">
               <div class="col-lg-4">
                  <div class="form-group">
                     <label class="form-control-label">Have you studied 10+2 from India? <span class="tx-danger">*</span></label>
                    <select class="form-control custom-select" name="studied_from_india" id="studied_from_india" title="Select Status - Yes or No" data-parsley-required="true" data-parsley-required-message="Please Select Studied Resident" data-parsley-errors-container="#custom-studied_from_india-parsley-error" data-parsley-bmtechparttime-basic-check="no">
                        <option value="">Select Status - Yes or No</option>
                    </select>
                    <span id="custom-studied_from_india-parsley-error"></span>
                  </div>
               </div>
               <!-- col-4 -->
               <div class="col-lg-4">
                    <div class="form-group mg-b-10-force" id="resident_status">
                        <label class="form-control-label">Resident Status <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select" name="non_indian_resident" id="non_indian_resident" title="Select Resident Status" data-parsley-required="false" data-parsley-required-message="Please Select Resident Status" data-parsley-errors-container="#custom-non_indian_resident-parsley-error">
                            <option value="">Select Category</option>
                            <option value="nonresident">Non Resident Indian </option>
                            <option value="foreign">Foreign </option>
                        </select>
                        <span id="custom-non_indian_resident-parsley-error"></span>
                    </div>
               </div>
               <!-- col-4 -->
               
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div id="info_study" style="display: none;" class="p-3">
                        <p>Please note that you have selected yes’ for the above which implies you are eligible to seek admission under domestic category. It is the sole responsibility of the candidate to ensure that he/she is applying under the right category.</p>
                        <div class="">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="qualifyingexamfromindia" id="qualifyingexamfromindia" data-parsley-mincheck="1" value="<?php echo ($qualifyexamfromindia == 't')?1:0; ?>" data-parsley-required="true" data-parsley-required-message="Please check and confirm" <?php echo ($qualifyexamfromindia == 't')?'checked':''; ?>  data-parsley-trigger="change">
                                <label class="custom-control-label" for="customCheck1">I Confirm</label>
                            </div>
                        </div>
                    </div>
                    <div id="nri_info_study" style="display: none;" class="form-group formAreaCols ">Foreign/ NRI /OCI/PIO Students please go to the below link to proceed further.<br><br><a target="_blank" href="https://intlapplications.srmist.edu.in/"><b>https://intlapplications.srmist.edu.in/</b></a></div>
                </div>
            </div>
            <!-- row -->
         </fieldset>
         <h3>Personal Details</h3>
         <fieldset>
            <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
               <div class="card ">
                  <div class="card-header p-0 " role="tab" id="headingOne">
                     <h6 class="p-2 ml-3">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed instruction_accordion">
                        <i class="fas fa-info-circle"></i>
                        Instructions</a>
                     </h6>
                  </div>
                  <!-- card-header -->
                  <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                     <div class="card-body" style="font-size: 13px;">SRMJEEE is common for all campuses. At the time of counselling,student can select branch and campus as per
                        availability. Course preference is collected for statistical
                        purpose only, final decision on course selection would be
                        made on the day of counselling only.
                     </div>
                  </div>
               </div>
               <!-- card -->
            </div>
            <div class="w-100 pd-20 pd-sm-40 mb-3">
               <h5 class="text-primary mb-3">Select Course and Campus Preference </h5>
               <div class="form-layout">
                  <div class="row mg-b-25 mt-3">
                     <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                           <label class="">Select Programme level
                           <span class="tx-danger">*</span></label>
                           <select class="form-control custom-select"
                              id="exampleFormControlSelect1">
                              <option>Select</option>
                              <option>SRM IST, Main Campus (Kattankulathur,
                                 Chennai)
                              </option>
                              <option>SRM IST, NCR Campus, Delhi</option>
                              <option>SRM IST, Ramapuram Campus, Chennai</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                           <label class="">Select Course
                           </label>
                           <select class="form-control custom-select"
                              id="exampleFormControlSelect1">
                              <option>Select</option>
                              <option>SRM IST, Main Campus (Kattankulathur,
                                 Chennai)
                              </option>
                              <option>SRM IST, NCR Campus, Delhi</option>
                              <option>SRM IST, Ramapuram Campus, Chennai</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                           <label class="">Select Specialisation
                           <span class="tx-danger">*</span></label>
                           <select class="form-control custom-select"
                              id="exampleFormControlSelect1">
                              <option>Select</option>
                              <option>SRM IST, Main Campus (Kattankulathur,
                                 Chennai)
                              </option>
                              <option>SRM IST, NCR Campus, Delhi</option>
                              <option>SRM IST, Ramapuram Campus, Chennai</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                           <label class="">Select Campus
                           </label>
                           <select class="form-control custom-select"
                              id="exampleFormControlSelect1">
                              <option>Select</option>
                              <option>SRM IST, Main Campus (Kattankulathur,
                                 Chennai)
                              </option>
                              <option>SRM IST, NCR Campus, Delhi</option>
                              <option>SRM IST, Ramapuram Campus, Chennai</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                  </div>
                  <!-- row -->
               </div>
               <!-- form-layout -->
            </div>
            <div class=" w-100 pd-20 pd-sm-40 mb-3">
               <h5 class="text-primary mb-3">Personal Details</h5>
               <div class="form-layout">
                  <div class="row mg-b-25">
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Title<span
                              class="tx-danger">*</span></label>
                           <select class="form-control custom-select "
                              data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                              <option label="Choose country"></option>
                              <option value="MR">MR</option>
                              <option value="MRS">MRS</option>
                              <option value="MISS">MISS</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group">
                           <label class="">FirstName <span
                              class="tx-danger">*</span></label>
                           <input class="form-control" type="text" name="Firstname"
                              placeholder="Enter lastname">
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group">
                           <label class="">Middle Name </label>
                           <input class="form-control" type="text" name="MiddleName"
                              placeholder="Middle Name">
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group">
                           <label class="">LastName <span
                              class="tx-danger">*</span></label>
                           <input class="form-control" type="text" name="LastName"
                              placeholder="LastName">
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <label class="">Mobile NO <span
                           class="tx-danger">*</span></label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                           <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                              <select class="form-control input-group-text" id="exampleFormControlSelect1">
                                 <option value="">+91</option>
                                 <option value="Law">Law</option>
                                 <option value="Other">Other</option>
                              </select>
                           </span>
                           <input id="demo2" type="text" placeholder="Mobile No" name="demo2" class="form-control">
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                           <label class="">Email ID <span
                              class="tx-danger">*</span></label>
                           <input class="form-control" type="text" name="email"
                              value="johnpaul@yourdomain.com" placeholder="Enter email address">
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="wd-200 w-100">
                           <label class="">Date of Birth<span
                              class="tx-danger">*</span></label>
                           <div class="input-group">
                              <span class="input-group-addon"><i
                                 class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                              <input id="datepickerNoOfMonths" type="text"
                                 class="form-control hasDatepicker" placeholder="MM/DD/YYYY">
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Gender <span
                              class="tx-danger">*</span></label>
                           <select class="form-control custom-select "
                              data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                              <option label="Choose Gender"></option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                              <option value="Transgender">Transgender</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group">
                           <label class="">Alternate Email ID </label>
                           <input class="form-control" type="text" name="email"
                              value="johnpaul@yourdomain.com" placeholder="Enter email address">
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Blood Group <span
                              class="tx-danger">*</span></label>
                           <select class="form-control custom-select "
                              data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                              <option label="Choose Blood Group"></option>
                              <option value="a+">A+</option>
                              <option value="a-">A-</option>
                              <option value="ab+">AB+</option>
                              <option value="ab-">AB-</option>
                              <option value="b+">B+</option>
                              <option value="b-">B-</option>
                              <option value="o+">O+</option>
                              <option value="o-">O-</option>
                              <option value="Unknown">Unknown</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Religion</label>
                           <select class="form-control custom-select "
                              data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                              <option label="Choose Religion"></option>
                              <option value="christian">CHRISTIANITY</option>
                              <option value="hinduism">HINDUISM</option>
                              <option value="islam">ISLAM</option>
                              <option value="other">OTHERS/RELIGION NOT SPECIFIED</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Mother Tongue</label>
                           <select class="form-control custom-select "
                              data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                              <option label="Choose Mother Tongue"></option>
                              <option value="Assamese">Assamese</option>
                              <option value="Bengali">Bengali</option>
                              <option value="English">English</option>
                              <option value="Gujarati">Gujarati</option>
                              <option value="Hindi">Hindi</option>
                              <option value="Kannada">Kannada</option>
                              <option value="Kashmiri">Kashmiri</option>
                              <option value="Malayalam">Malayalam</option>
                              <option value="Marathi">Marathi</option>
                              <option value="Marwari">Marwari</option>
                              <option value="Odiya">Odiya</option>
                              <option value="Punjabi">Punjabi</option>
                              <option value="Sindhi">Sindhi</option>
                              <option value="Tamil">Tamil</option>
                              <option value="Telugu">Telugu</option>
                              <option value="Urdu">Urdu</option>
                              <option value="Other">Other</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Medium of Instruction</label>
                           <select class="form-control custom-select "
                              data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                              <option label="Choose Medium of Instruction"></option>
                              <option value>Select</option>
                              <option value="English">English</option>
                              <option value="Other">Other</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Hostel Accommodation</label>
                           <select class="form-control custom-select "
                              data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                              <option label="Select Hostel Accommodation"></option>
                              <option value="yes">Yes</option>
                              <option value="No">No</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Are you a differently
                           Abled?<span class="tx-danger">*</span></label>
                           <select class="form-control custom-select "
                              data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                              <option label="Select ifferently
                                 Abled">Select differently
                                 Abled
                              </option>
                              <option value="yes">Yes</option>
                              <option value="No">No</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Where do you see admission
                           advertisment?</label>
                           <select class="form-control custom-select "
                              data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                              <option value="">Select</option>
                              <option value="Newspaper">Newspaper </option>
                              <option value="Google Search">Google Search </option>
                              <option value="Social Media">Social Media </option>
                              <option value="Whatsapp Messages">Whatsapp Messages </option>
                              <option value="Online Advertisment">Online Advertisment </option>
                              <option value="Coaching centre/Counsellors">Coaching centre/Counsellors </option>
                              <option value="Newspaper Events">Newspaper Events </option>
                              <option value="Friends/Relatives">Friends/Relatives </option>
                              <option value="Magazine">Magazine </option>
                              <option selected="selected" value="SRM Website">SRM Website </option>
                              <option value="Teacher/School">Teacher/School </option>
                              <option value="Word of mouth">Word of mouth </option>
                              <option value="SRM Helpline">SRM Helpline </option>
                              <option value="Other">Other</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Nationality <span
                              class="tx-danger">*</span></label>
                           <select class="form-control custom-select nationality" id="nationality_indian">
                              <option value="">Select Nationality</option>
                              <option value="Indian">Indian</option>
                              <option value="Afghan">Afghan</option>
                              <option value="Albanian">Albanian</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force" id="Community">
                           <label class="">Community <span
                              class="tx-danger">*</span></label>
                           <select class="form-control custom-select "
                              data-placeholder="Choose Community" tabindex="-1" aria-hidden="true">
                              <option value="">Select Community</option>
                              <option value="General /OC">General /OC </option>
                              <option value="General / EWS">General / EWS </option>
                              <option selected="selected" value="OBC/BC/MBC">OBC/BC/MBC </option>
                              <option value="SC">SC </option>
                              <option value="ST">ST </option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                  </div>
                  <!-- row -->
               </div>
               <!-- form-layout -->
            </div>
         </fieldset>
         <h3>Parent's Details</h3>
         <fieldset>
            <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
               <div class="card ">
                  <div class="card-header p-0 " role="tab" id="headingOne">
                     <h6 class="p-2 ml-3">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed instruction_accordion">
                        <i class="fas fa-info-circle"></i>
                        Instructions</a>
                     </h6>
                  </div>
                  <!-- card-header -->
                  <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                     <div class="card-body" style="font-size: 13px;">SRMJEEE is common for all campuses. At the time of counselling,student can select branch and campus as per
                        availability. Course preference is collected for statistical
                        purpose only, final decision on course selection would be
                        made on the day of counselling only.
                     </div>
                  </div>
               </div>
               <!-- card -->
            </div>
            <div class="w-100 pd-20 pd-sm-40">
               <h5 class="text-primary mt-4">Father's Details</h5>
               <div class="form-layout">
                  <div class="row mg-b-25 mt-3">
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Title<span
                              class="tx-danger">*</span></label>
                           <select class="form-control custom-select "
                              data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                              <option label="Choose country"></option>
                              <option value="MR">MR</option>
                              <option value="MRS">MRS</option>
                              <option value="MISS">MISS</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group">
                           <label class="">Father's Name <span
                              class="tx-danger">*</span></label>
                           <input class="form-control" type="text" name="Father's Name"
                              placeholder="Enter Father name">
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <label class="">Father's Mobile Number </label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                           <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                              <select class="form-control input-group-text" id="exampleFormControlSelect1">
                                 <option value="">+91</option>
                                 <option value="Law">Law</option>
                                 <option value="Other">Other</option>
                              </select>
                           </span>
                           <input id="demo2" type="text" placeholder="Mobile No" name="demo2" class="form-control">
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <label class="">Father's Alternate Mobile Number </label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                           <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                              <select class="form-control input-group-text" id="exampleFormControlSelect1">
                                 <option value="">+91</option>
                                 <option value="Law">Law</option>
                                 <option value="Other">Other</option>
                              </select>
                           </span>
                           <input id="demo2" type="text" placeholder="Mobile No" name="demo2" class="form-control">
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                           <label class="">Father's Email ID </label>
                           <input class="form-control" type="text" name="email"
                              value="johnpaul@yourdomain.com" placeholder="Enter email address">
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Father's Occupation</label>
                           <select class="form-control custom-select " data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                              <option value="">Select Father's Occupation</option>
                              <option value="Business">Business</option>
                              <option value="Defence">Defence</option>
                              <option value="Government Sector">Government Sector</option>
                              <option value="Homemaker">Homemaker</option>
                              <option value="Private Sector">Private Sector</option>
                              <option value="Retired">Retired</option>
                              <option value="Other">Other</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                  </div>
                  <!-- row -->
               </div>
               <!-- form-layout -->
            </div>
            <div class="w-100 pd-20 pd-sm-40">
               <h5 class="text-primary mt-4">Mother's Details</h5>
               <div class="form-layout">
                  <div class="row mg-b-25 mt-3">
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Title<span
                              class="tx-danger">*</span></label>
                           <select class="form-control custom-select "
                              data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                              <option label="Choose country"></option>
                              <option value="MR">MR</option>
                              <option value="MRS">MRS</option>
                              <option value="MISS">MISS</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group">
                           <label class="">Mother's Name <span
                              class="tx-danger">*</span></label>
                           <input class="form-control" type="text" name="Mother's Name"
                              placeholder="Enter Mother name">
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <label class="">Mother's Mobile Number </label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                           <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                              <select class="form-control input-group-text" id="exampleFormControlSelect1">
                                 <option value="">+91</option>
                                 <option value="Law">Law</option>
                                 <option value="Other">Other</option>
                              </select>
                           </span>
                           <input id="demo2" type="text" placeholder="Mobile No" name="demo2" class="form-control">
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <label class="">Mother's Alternate Mobile Number </label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                           <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                              <select class="form-control input-group-text" id="exampleFormControlSelect1">
                                 <option value="">+91</option>
                                 <option value="Law">Law</option>
                                 <option value="Other">Other</option>
                              </select>
                           </span>
                           <input id="demo2" type="text" placeholder="Mobile No" name="demo2" class="form-control">
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                           <label class="">Mother's Email ID </label>
                           <input class="form-control" type="text" name="email"
                              value="johnpaul@yourdomain.com" placeholder="Enter email address">
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Mother's Occupation</label>
                           <select class="form-control custom-select " data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                              <option value="">Select Father's Occupation</option>
                              <option value="Business">Business</option>
                              <option value="Defence">Defence</option>
                              <option value="Government Sector">Government Sector</option>
                              <option value="Homemaker">Homemaker</option>
                              <option value="Private Sector">Private Sector</option>
                              <option value="Retired">Retired</option>
                              <option value="Other">Other</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                  </div>
                  <!-- row -->
               </div>
               <!-- form-layout -->
            </div>
            <div class="">
               <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Add Guardian Details</label>
               </div>
            </div>
            <div class="w-100 pd-20 pd-sm-40">
               <h5 class="text-primary mt-4">Guardian's Details</h5>
               <div class="form-layout">
                  <div class="row mg-b-25 mt-3">
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Title<span
                              class="tx-danger">*</span></label>
                           <select class="form-control custom-select "
                              data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                              <option label="Choose country"></option>
                              <option value="MR">MR</option>
                              <option value="MRS">MRS</option>
                              <option value="MISS">MISS</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group">
                           <label class="">Guardian's Name: <span
                              class="tx-danger">*</span></label>
                           <input class="form-control" type="text" name="Guardian's Name"
                              placeholder="Enter Guardian name">
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <label class="">Guardian's Mobile NO <span
                           class="tx-danger">*</span></label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                           <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend">
                              <select class="form-control input-group-text" id="exampleFormControlSelect1">
                                 <option value="">+91</option>
                                 <option value="Law">Law</option>
                                 <option value="Other">Other</option>
                              </select>
                           </span>
                           <input id="demo2" type="text" placeholder="Mobile No" name="demo2" class="form-control">
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group">
                           <label class="">Guardian's Email ID: <span
                              class="tx-danger">*</span></label>
                           <input class="form-control" type="text" name="email"
                              value="johnpaul@yourdomain.com" placeholder="Enter email address">
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Guardian's Occupation<span
                              class="tx-danger">*</span></label>
                           <select class="form-control custom-select "
                              data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                              <option value="">Select Mother's Occupation</option>
                              <option value="Business">Business</option>
                              <option value="Defence">Defence</option>
                              <option value="Government Sector">Government Sector</option>
                              <option value="Homemaker">Homemaker</option>
                              <option value="Private Sector">Private Sector</option>
                              <option value="Retired">Retired</option>
                              <option value="Other">Other</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                  </div>
                  <!-- row -->
               </div>
               <!-- form-layout -->
            </div>
         </fieldset>
         <h3>Address Details</h3>
         <fieldset>
            <div class=" w-100 pd-20 pd-sm-40">
               <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
                  <div class="card ">
                     <div class="card-header p-0 " role="tab" id="headingOne">
                        <h6 class="p-2 ml-3">
                           <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed instruction_accordion">
                           <i class="fas fa-info-circle"></i>
                           Instructions</a>
                        </h6>
                     </div>
                     <!-- card-header -->
                     <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                        <div class="card-body" style="font-size: 13px;">SRMJEEE is common for all campuses. At the time of counselling,student can select branch and campus as per
                           availability. Course preference is collected for statistical
                           purpose only, final decision on course selection would be
                           made on the day of counselling only.
                        </div>
                     </div>
                  </div>
                  <!-- card -->
               </div>
               <h5 class="text-primary mt-4">Address for Communication</h5>
               <div class="form-layout">
                  <div class="row mg-b-25">
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">Country<span
                              class="tx-danger">*</span></label>
                           <select class="form-control custom-select " data-placeholder="Choose country" tabindex="-1"
                              aria-hidden="true">
                              <option>Selcet country</option>
                              <option value="Afganistan">Afghanistan</option>
                              <option value="Albania">Albania</option>
                              <option value="Algeria">Algeria</option>
                              <option value="American Samoa">American Samoa</option>
                              <option value="Andorra">Andorra</option>
                              <option value="Angola">Angola</option>
                              <option value="Anguilla">Anguilla</option>
                              <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                              <option value="Argentina">Argentina</option>
                              <option value="Armenia">Armenia</option>
                              <option value="Aruba">Aruba</option>
                              <option value="Australia">Australia</option>
                              <option value="Austria">Austria</option>
                              <option value="Azerbaijan">Azerbaijan</option>
                              <option value="Bahamas">Bahamas</option>
                              <option value="Bahrain">Bahrain</option>
                              <option value="Bangladesh">Bangladesh</option>
                              <option value="Barbados">Barbados</option>
                              <option value="Belarus">Belarus</option>
                              <option value="Belgium">Belgium</option>
                              <option value="Belize">Belize</option>
                              <option value="Benin">Benin</option>
                              <option value="Bermuda">Bermuda</option>
                              <option value="Bhutan">Bhutan</option>
                              <option value="Bolivia">Bolivia</option>
                              <option value="Bonaire">Bonaire</option>
                              <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                              <option value="Botswana">Botswana</option>
                              <option value="Brazil">Brazil</option>
                              <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                              <option value="Brunei">Brunei</option>
                              <option value="Bulgaria">Bulgaria</option>
                              <option value="Burkina Faso">Burkina Faso</option>
                              <option value="Burundi">Burundi</option>
                              <option value="Cambodia">Cambodia</option>
                              <option value="Cameroon">Cameroon</option>
                              <option value="Canada">Canada</option>
                              <option value="Canary Islands">Canary Islands</option>
                              <option value="Cape Verde">Cape Verde</option>
                              <option value="Cayman Islands">Cayman Islands</option>
                              <option value="Central African Republic">Central African Republic</option>
                              <option value="Chad">Chad</option>
                              <option value="Channel Islands">Channel Islands</option>
                              <option value="Chile">Chile</option>
                              <option value="China">China</option>
                              <option value="Christmas Island">Christmas Island</option>
                              <option value="Cocos Island">Cocos Island</option>
                              <option value="Colombia">Colombia</option>
                              <option value="Comoros">Comoros</option>
                              <option value="Congo">Congo</option>
                              <option value="Cook Islands">Cook Islands</option>
                              <option value="Costa Rica">Costa Rica</option>
                              <option value="Cote DIvoire">Cote DIvoire</option>
                              <option value="Croatia">Croatia</option>
                              <option value="Cuba">Cuba</option>
                              <option value="Curaco">Curacao</option>
                              <option value="Cyprus">Cyprus</option>
                              <option value="Czech Republic">Czech Republic</option>
                              <option value="Denmark">Denmark</option>
                              <option value="Djibouti">Djibouti</option>
                              <option value="Dominica">Dominica</option>
                              <option value="Dominican Republic">Dominican Republic</option>
                              <option value="East Timor">East Timor</option>
                              <option value="Ecuador">Ecuador</option>
                              <option value="Egypt">Egypt</option>
                              <option value="El Salvador">El Salvador</option>
                              <option value="Equatorial Guinea">Equatorial Guinea</option>
                              <option value="Eritrea">Eritrea</option>
                              <option value="Estonia">Estonia</option>
                              <option value="Ethiopia">Ethiopia</option>
                              <option value="Falkland Islands">Falkland Islands</option>
                              <option value="Faroe Islands">Faroe Islands</option>
                              <option value="Fiji">Fiji</option>
                              <option value="Finland">Finland</option>
                              <option value="France">France</option>
                              <option value="French Guiana">French Guiana</option>
                              <option value="French Polynesia">French Polynesia</option>
                              <option value="French Southern Ter">French Southern Ter</option>
                              <option value="Gabon">Gabon</option>
                              <option value="Gambia">Gambia</option>
                              <option value="Georgia">Georgia</option>
                              <option value="Germany">Germany</option>
                              <option value="Ghana">Ghana</option>
                              <option value="Gibraltar">Gibraltar</option>
                              <option value="Great Britain">Great Britain</option>
                              <option value="Greece">Greece</option>
                              <option value="Greenland">Greenland</option>
                              <option value="Grenada">Grenada</option>
                              <option value="Guadeloupe">Guadeloupe</option>
                              <option value="Guam">Guam</option>
                              <option value="Guatemala">Guatemala</option>
                              <option value="Guinea">Guinea</option>
                              <option value="Guyana">Guyana</option>
                              <option value="Haiti">Haiti</option>
                              <option value="Hawaii">Hawaii</option>
                              <option value="Honduras">Honduras</option>
                              <option value="Hong Kong">Hong Kong</option>
                              <option value="Hungary">Hungary</option>
                              <option value="Iceland">Iceland</option>
                              <option value="Indonesia">Indonesia</option>
                              <option value="India">India</option>
                              <option value="Iran">Iran</option>
                              <option value="Iraq">Iraq</option>
                              <option value="Ireland">Ireland</option>
                              <option value="Isle of Man">Isle of Man</option>
                              <option value="Israel">Israel</option>
                              <option value="Italy">Italy</option>
                              <option value="Jamaica">Jamaica</option>
                              <option value="Japan">Japan</option>
                              <option value="Jordan">Jordan</option>
                              <option value="Kazakhstan">Kazakhstan</option>
                              <option value="Kenya">Kenya</option>
                              <option value="Kiribati">Kiribati</option>
                              <option value="Korea North">Korea North</option>
                              <option value="Korea Sout">Korea South</option>
                              <option value="Kuwait">Kuwait</option>
                              <option value="Kyrgyzstan">Kyrgyzstan</option>
                              <option value="Laos">Laos</option>
                              <option value="Latvia">Latvia</option>
                              <option value="Lebanon">Lebanon</option>
                              <option value="Lesotho">Lesotho</option>
                              <option value="Liberia">Liberia</option>
                              <option value="Libya">Libya</option>
                              <option value="Liechtenstein">Liechtenstein</option>
                              <option value="Lithuania">Lithuania</option>
                              <option value="Luxembourg">Luxembourg</option>
                              <option value="Macau">Macau</option>
                              <option value="Macedonia">Macedonia</option>
                              <option value="Madagascar">Madagascar</option>
                              <option value="Malaysia">Malaysia</option>
                              <option value="Malawi">Malawi</option>
                              <option value="Maldives">Maldives</option>
                              <option value="Mali">Mali</option>
                              <option value="Malta">Malta</option>
                              <option value="Marshall Islands">Marshall Islands</option>
                              <option value="Martinique">Martinique</option>
                              <option value="Mauritania">Mauritania</option>
                              <option value="Mauritius">Mauritius</option>
                              <option value="Mayotte">Mayotte</option>
                              <option value="Mexico">Mexico</option>
                              <option value="Midway Islands">Midway Islands</option>
                              <option value="Moldova">Moldova</option>
                              <option value="Monaco">Monaco</option>
                              <option value="Mongolia">Mongolia</option>
                              <option value="Montserrat">Montserrat</option>
                              <option value="Morocco">Morocco</option>
                              <option value="Mozambique">Mozambique</option>
                              <option value="Myanmar">Myanmar</option>
                              <option value="Nambia">Nambia</option>
                              <option value="Nauru">Nauru</option>
                              <option value="Nepal">Nepal</option>
                              <option value="Netherland Antilles">Netherland Antilles</option>
                              <option value="Netherlands">Netherlands (Holland, Europe)</option>
                              <option value="Nevis">Nevis</option>
                              <option value="New Caledonia">New Caledonia</option>
                              <option value="New Zealand">New Zealand</option>
                              <option value="Nicaragua">Nicaragua</option>
                              <option value="Niger">Niger</option>
                              <option value="Nigeria">Nigeria</option>
                              <option value="Niue">Niue</option>
                              <option value="Norfolk Island">Norfolk Island</option>
                              <option value="Norway">Norway</option>
                              <option value="Oman">Oman</option>
                              <option value="Pakistan">Pakistan</option>
                              <option value="Palau Island">Palau Island</option>
                              <option value="Palestine">Palestine</option>
                              <option value="Panama">Panama</option>
                              <option value="Papua New Guinea">Papua New Guinea</option>
                              <option value="Paraguay">Paraguay</option>
                              <option value="Peru">Peru</option>
                              <option value="Phillipines">Philippines</option>
                              <option value="Pitcairn Island">Pitcairn Island</option>
                              <option value="Poland">Poland</option>
                              <option value="Portugal">Portugal</option>
                              <option value="Puerto Rico">Puerto Rico</option>
                              <option value="Qatar">Qatar</option>
                              <option value="Republic of Montenegro">Republic of Montenegro</option>
                              <option value="Republic of Serbia">Republic of Serbia</option>
                              <option value="Reunion">Reunion</option>
                              <option value="Romania">Romania</option>
                              <option value="Russia">Russia</option>
                              <option value="Rwanda">Rwanda</option>
                              <option value="St Barthelemy">St Barthelemy</option>
                              <option value="St Eustatius">St Eustatius</option>
                              <option value="St Helena">St Helena</option>
                              <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                              <option value="St Lucia">St Lucia</option>
                              <option value="St Maarten">St Maarten</option>
                              <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                              <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                              <option value="Saipan">Saipan</option>
                              <option value="Samoa">Samoa</option>
                              <option value="Samoa American">Samoa American</option>
                              <option value="San Marino">San Marino</option>
                              <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                              <option value="Saudi Arabia">Saudi Arabia</option>
                              <option value="Senegal">Senegal</option>
                              <option value="Seychelles">Seychelles</option>
                              <option value="Sierra Leone">Sierra Leone</option>
                              <option value="Singapore">Singapore</option>
                              <option value="Slovakia">Slovakia</option>
                              <option value="Slovenia">Slovenia</option>
                              <option value="Solomon Islands">Solomon Islands</option>
                              <option value="Somalia">Somalia</option>
                              <option value="South Africa">South Africa</option>
                              <option value="Spain">Spain</option>
                              <option value="Sri Lanka">Sri Lanka</option>
                              <option value="Sudan">Sudan</option>
                              <option value="Suriname">Suriname</option>
                              <option value="Swaziland">Swaziland</option>
                              <option value="Sweden">Sweden</option>
                              <option value="Switzerland">Switzerland</option>
                              <option value="Syria">Syria</option>
                              <option value="Tahiti">Tahiti</option>
                              <option value="Taiwan">Taiwan</option>
                              <option value="Tajikistan">Tajikistan</option>
                              <option value="Tanzania">Tanzania</option>
                              <option value="Thailand">Thailand</option>
                              <option value="Togo">Togo</option>
                              <option value="Tokelau">Tokelau</option>
                              <option value="Tonga">Tonga</option>
                              <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                              <option value="Tunisia">Tunisia</option>
                              <option value="Turkey">Turkey</option>
                              <option value="Turkmenistan">Turkmenistan</option>
                              <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                              <option value="Tuvalu">Tuvalu</option>
                              <option value="Uganda">Uganda</option>
                              <option value="United Kingdom">United Kingdom</option>
                              <option value="Ukraine">Ukraine</option>
                              <option value="United Arab Erimates">United Arab Emirates</option>
                              <option value="United States of America">United States of America</option>
                              <option value="Uraguay">Uruguay</option>
                              <option value="Uzbekistan">Uzbekistan</option>
                              <option value="Vanuatu">Vanuatu</option>
                              <option value="Vatican City State">Vatican City State</option>
                              <option value="Venezuela">Venezuela</option>
                              <option value="Vietnam">Vietnam</option>
                              <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                              <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                              <option value="Wake Island">Wake Island</option>
                              <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                              <option value="Yemen">Yemen</option>
                              <option value="Zaire">Zaire</option>
                              <option value="Zambia">Zambia</option>
                              <option value="Zimbabwe">Zimbabwe</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">State<span
                              class="tx-danger">*</span></label>
                           <select class="form-control custom-select " data-placeholder="Choose country" tabindex="-1"
                              aria-hidden="true">
                              <option>Select State</option>
                              <option value="Andhra Pradesh">Andhra Pradesh</option>
                              <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                              <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                              <option value="Assam">Assam</option>
                              <option value="Bihar">Bihar</option>
                              <option value="Chandigarh">Chandigarh</option>
                              <option value="Chhattisgarh">Chhattisgarh</option>
                              <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                              <option value="Daman and Diu">Daman and Diu</option>
                              <option value="Delhi">Delhi</option>
                              <option value="Lakshadweep">Lakshadweep</option>
                              <option value="Puducherry">Puducherry</option>
                              <option value="Goa">Goa</option>
                              <option value="Gujarat">Gujarat</option>
                              <option value="Haryana">Haryana</option>
                              <option value="Himachal Pradesh">Himachal Pradesh</option>
                              <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                              <option value="Jharkhand">Jharkhand</option>
                              <option value="Karnataka">Karnataka</option>
                              <option value="Kerala">Kerala</option>
                              <option value="Madhya Pradesh">Madhya Pradesh</option>
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
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">District<span
                              class="tx-danger">*</span></label>
                           <select class="form-control custom-select "
                              data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                              <option label="Choose country"></option>
                              <option value="MR">MR</option>
                              <option value="MRS">MRS</option>
                              <option value="MISS">MISS</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                           <label class="">City<span
                              class="tx-danger">*</span></label>
                           <select class="form-control custom-select " data-placeholder="Choose country" tabindex="-1"
                              aria-hidden="true">
                              <option value="">Select City</option>
                              <option value="Chengalpattu">Chengalpattu</option>
                              <option value="Cheyur">Cheyur</option>
                              <option value="Kanchipuram">Kanchipuram</option>
                              <option value="Madurantakam">Madurantakam</option>
                              <option value="Padapai">Padapai</option>
                              <option value="Palayanur">Palayanur</option>
                              <option value="Sriperumbudur">Sriperumbudur</option>
                              <option value="Tirukazhukundram">Tirukazhukundram</option>
                              <option value="Uttiramerur">Uttiramerur</option>
                              <option value="Vandalur R.F.">Vandalur R.F.</option>
                              <option value="Vennangupattu">Vennangupattu</option>
                           </select>
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group">
                           <label class="">Address Line 1 <span
                              class="tx-danger">*</span></label>
                           <input class="form-control" type="text" name=">Line"
                              placeholder="Enter Address Line 1">
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group">
                           <label class="">Address Line 2 <span
                              class="tx-danger">*</span></label>
                           <input class="form-control" type="text" name="Address_Line_1"
                              placeholder="Enter Address Line 2">
                        </div>
                     </div>
                     <!-- col-4 -->
                     <div class="col-lg-4">
                        <div class="form-group">
                           <label class="">Pincode <span
                              class="tx-danger">*</span></label>
                           <input class="form-control" type="text" name="Pincode"
                              placeholder="Enter Pincode">
                        </div>
                     </div>
                     <!-- col-4 -->
                  </div>
                  <!-- row -->
               </div>
               <!-- form-layout -->
            </div>
         </fieldset>
         <h3>Academic Detail</h3>
         <fieldset>
            <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
               <div class="card ">
                  <div class="card-header p-0 " role="tab" id="headingOne">
                     <h6 class="p-2 ml-3">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed instruction_accordion">
                        <i class="fas fa-info-circle"></i>
                        Instructions</a>
                     </h6>
                  </div>
                  <!-- card-header -->
                  <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                     <div class="card-body" style="font-size: 13px;">SRMJEEE is common for all campuses. At the time of counselling,student can select branch and campus as per
                        availability. Course preference is collected for statistical
                        purpose only, final decision on course selection would be
                        made on the day of counselling only.
                     </div>
                  </div>
               </div>
               <!-- card -->
            </div>
            <div action="form-validation.html" id="selectForm" class="w-100">
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group mr-5">
                        <label class="">Current Education
                        Qualification Status
                        <span class="tx-danger">*</span></label>
                        <div class="row">
                           <div class="col-lg-6">
                              <label class="rdiobox">
                              <input name="rdio" type="radio" id="appearing">
                              <span>Diploma/Degree Appearing</span>
                              </label>
                           </div>
                           <div class="col-lg-6">
                              <label class="rdiobox">
                              <input name="rdio" type="radio" id="completed">
                              <span>Diploma/Degree Completed</span>
                              </label>
                           </div>
                        </div>
                     </div>
                     <!-- form-group -->
                  </div>
                  <div class="col-lg-6 ">
                     <div class="form-group wd-xs-300 mr-5 w-100">
                        <label class="">Candidate's Name as per
                        qualifying examination marksheet
                        <span class="tx-danger">*</span></label>
                        <div class="form-group mg-b-10-force">
                           <input class="form-control" type="text" name="Name"
                              placeholder="Enter Name">
                        </div>
                        <small id="emailHelp" class="form-text text-muted">Kindly type “NA” in case 10th Certificate is not available with you.</small>
                     </div>
                     <!-- form-group -->
                  </div>
               </div>
            </div>
            <table class="table table-bordered table-responsive mt-5">
               <thead class="thead-light">
                  <tr>
                     <th class="align-middle">Course</th>
                     <th class="align-middle"> Institute Name </th>
                     <th class="align-middle"> Board </th>
                     <th class="align-middle"> Mode of Study </th>
                     <th class="align-middle"> Marking Scheme </th>
                     <th class="align-middle"> Obtained Percentage/CGPA</th>
                     <th class="align-middle"> Year of Passing </th>
                     <th class="align-middle"> Roll No. / Registration
                        No
                     </th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>
                        <p>10th</p>
                     </td>
                     <td>
                        <input class="form-control" type="text" name="SchoolName" placeholder="Enter SchoolName">
                     </td>
                     <td>
                        <div class="form-group mg-b-10-force">
                           <select class="form-control custom-select" id="exampleFormControlSelect1">
                              <option value="">Select</option>
                              <option value="Central Board Of Secondary Education (CBSE)">
                                 Central Board Of Secondary Education (CBSE)
                              </option>
                              <option value="Council Of Indian School Certificate Examination (CISCE/ISC)">
                                 Council Of Indian School
                                 Certificate Examination (CISCE/ISC)
                              </option>
                              <option value="National Institute Of Open Schooling">
                                 National Institute Of Open Schooling
                              </option>
                              <option value="Andhra Pradesh Board Of Intermediate Education">
                                 Andhra Pradesh Board Of Intermediate Education
                              </option>
                              <option value="Telangana Board Of Intermediate Education">
                                 Telangana Board Of Intermediate Education
                              </option>
                              <option value="Bihar School Examination Board">Bihar
                                 School Examination Board
                              </option>
                              <option value="West Bengal Council Of Higher Secondary Education">
                                 West Bengal Council Of Higher Secondary
                                 Education
                              </option>
                              <option value="Maharastra State Board Of Secondary And Higher Secondary Education">
                                 Maharastra State Board Of
                                 Secondary And Higher Secondary Education
                              </option>
                              <option value="Goa Board Of Secondary And Higher Secondary Education">
                                 Goa Board Of Secondary And Higher
                                 Secondary Education
                              </option>
                              <option value="Aligarh Muslim University">Aligarh
                                 Muslim University
                              </option>
                              <option value="Assam Higher Secondary Education Council">
                                 Assam Higher Secondary Education Council
                              </option>
                              <option value="1Banasthali Vidyapith">Banasthali
                                 Vidyapith
                              </option>
                              <option value="Bihar Intermediate Education Council">
                                 Bihar Intermediate Education Council
                              </option>
                              <option value="2Board of Vocational Higher Secondary Education">
                                 Board of Vocational Higher Secondary Education
                              </option>
                              <option value="Cambridge University">Cambridge
                                 University
                              </option>
                              <option value="Chhatisgarh Board Of Secondary Education">
                                 Chhatisgarh Board Of Secondary Education
                              </option>
                              <option value="Gujarat Secondary And Higher Secondary Education Board">
                                 Gujarat Secondary And Higher Secondary
                                 Education Board
                              </option>
                              <option value="Haryana Board Of Education">Haryana
                                 Board Of Education
                              </option>
                              <option value="Himachal Pradesh Board Of School Education">
                                 Himachal Pradesh Board Of School Education
                              </option>
                              <option value="International Baccalaureate">
                                 International Baccalaureate
                              </option>
                              <option value="J And K State Board Of School Education">
                                 J And K State Board Of School Education
                              </option>
                              <option value="Jharkhand Academic Council">Jharkhand
                                 Academic Council
                              </option>
                              <option value="Karnataka Board Of The Pre-University Education">
                                 Karnataka Board Of The Pre-University Education
                              </option>
                              <option value="Kerala Board Of Higher Secondary Education">
                                 Kerala Board Of Higher Secondary Education
                              </option>
                              <option value="1Kerala Board of Public Examination">
                                 Kerala Board of Public Examination
                              </option>
                              <option value="Madhya Pradesh Board Of Secondary Education">
                                 Madhya Pradesh Board Of Secondary Education
                              </option>
                              <option value="Manipur Council Of Higher Secondary Education">
                                 Manipur Council Of Higher Secondary Education
                              </option>
                              <option value="Meghalaya Board Of School Education">
                                 Meghalaya Board Of School Education
                              </option>
                              <option value="Mizoram Board Of School Education">
                                 Mizoram Board Of School Education
                              </option>
                              <option value="Nagaland Board Of School Education">
                                 Nagaland Board Of School Education
                              </option>
                              <option value="Orissa Council Of Higher Secondary Education Bhubaneswar">
                                 Orissa Council Of Higher Secondary
                                 Education Bhubaneswar
                              </option>
                              <option value="Punjab School Education Board">Punjab
                                 School Education Board
                              </option>
                              <option value="Rajasthan Board Of Secondary Education">
                                 Rajasthan Board Of Secondary Education
                              </option>
                              <option value="Tamil Nadu Board Of Higher Secondary Education">
                                 Tamil Nadu Board Of Higher Secondary Education
                              </option>
                              <option value="Tripura Board Of Secondary Education">
                                 Tripura Board Of Secondary Education
                              </option>
                              <option value="U.P. Board Of High School And Intermediate Education">
                                 U.P. Board Of High School And Intermediate
                                 Education
                              </option>
                              <option value="Uttaranchal Shiksha Evam Pariksha Parishad">
                                 Uttaranchal Shiksha Evam Pariksha Parishad
                              </option>
                              <option value="West Bengal Board Of Madarsa Education">
                                 West Bengal Board Of Madarsa Education
                              </option>
                              <option value="Not specified/Any Other">Not
                                 specified/Any Other
                              </option>
                              <option value="1Other">Other</option>
                           </select>
                        </div>
                     </td>
                     <td>
                        <div class="form-group mg-b-10-force">
                           <select class="form-control custom-select" id="exampleFormControlSelect1">
                              <option value="">Select</option>
                              <option value="Regular/Formal" selected="selected">
                                 Regular/Formal
                              </option>
                              <option value="NIOS">NIOS</option>
                              <option value="Others">Others</option>
                           </select>
                        </div>
                     </td>
                     <td>
                        <div class="form-group mg-b-10-force" id="appering_info_1">
                           <select class="form-control custom-select" id="exampleFormControlSelect1">
                              <option value="">Select</option>
                              <option value="Percentage">Percentage</option>
                              <option value="CGPA out of 10">CGPA out of 10
                              </option>
                              <option value="CGPA out of 9">CGPA out of 9</option>
                              <option value="CGPA out of 7" selected="selected">
                                 CGPA out of 7
                              </option>
                              <option value="CGPA out of 4">CGPA out of 4</option>
                           </select>
                        </div>
                     </td>
                     <td>
                        <input class="form-control" type="text" name="SchoolName" placeholder="Enter SchoolName" id="appering_info_2">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="SchoolName" placeholder="Enter SchoolName" id="appering_info_3">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="SchoolName" placeholder="Enter SchoolName" id="appering_info_4">
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <p>XII</p>
                     </td>
                     <td>
                        <input class="form-control" type="text" name="SchoolName" placeholder="Enter SchoolName">
                     </td>
                     <td>
                        <div class="form-group mg-b-10-force">
                           <select class="form-control custom-select" id="exampleFormControlSelect1">
                              <option value="">Select</option>
                              <option value="Central Board Of Secondary Education (CBSE)">
                                 Central Board Of Secondary Education (CBSE)
                              </option>
                              <option value="Council Of Indian School Certificate Examination (CISCE/ISC)">
                                 Council Of Indian School
                                 Certificate Examination (CISCE/ISC)
                              </option>
                              <option value="National Institute Of Open Schooling">
                                 National Institute Of Open Schooling
                              </option>
                              <option value="Andhra Pradesh Board Of Intermediate Education">
                                 Andhra Pradesh Board Of Intermediate Education
                              </option>
                              <option value="Telangana Board Of Intermediate Education">
                                 Telangana Board Of Intermediate Education
                              </option>
                              <option value="Bihar School Examination Board">Bihar
                                 School Examination Board
                              </option>
                              <option value="West Bengal Council Of Higher Secondary Education">
                                 West Bengal Council Of Higher Secondary
                                 Education
                              </option>
                              <option value="Maharastra State Board Of Secondary And Higher Secondary Education">
                                 Maharastra State Board Of
                                 Secondary And Higher Secondary Education
                              </option>
                              <option value="Goa Board Of Secondary And Higher Secondary Education">
                                 Goa Board Of Secondary And Higher
                                 Secondary Education
                              </option>
                              <option value="Aligarh Muslim University">Aligarh
                                 Muslim University
                              </option>
                              <option value="Assam Higher Secondary Education Council">
                                 Assam Higher Secondary Education Council
                              </option>
                              <option value="1Banasthali Vidyapith">Banasthali
                                 Vidyapith
                              </option>
                              <option value="Bihar Intermediate Education Council">
                                 Bihar Intermediate Education Council
                              </option>
                              <option value="2Board of Vocational Higher Secondary Education">
                                 Board of Vocational Higher Secondary Education
                              </option>
                              <option value="Cambridge University">Cambridge
                                 University
                              </option>
                              <option value="Chhatisgarh Board Of Secondary Education">
                                 Chhatisgarh Board Of Secondary Education
                              </option>
                              <option value="Gujarat Secondary And Higher Secondary Education Board">
                                 Gujarat Secondary And Higher Secondary
                                 Education Board
                              </option>
                              <option value="Haryana Board Of Education">Haryana
                                 Board Of Education
                              </option>
                              <option value="Himachal Pradesh Board Of School Education">
                                 Himachal Pradesh Board Of School Education
                              </option>
                              <option value="International Baccalaureate">
                                 International Baccalaureate
                              </option>
                              <option value="J And K State Board Of School Education">
                                 J And K State Board Of School Education
                              </option>
                              <option value="Jharkhand Academic Council">Jharkhand
                                 Academic Council
                              </option>
                              <option value="Karnataka Board Of The Pre-University Education">
                                 Karnataka Board Of The Pre-University Education
                              </option>
                              <option value="Kerala Board Of Higher Secondary Education">
                                 Kerala Board Of Higher Secondary Education
                              </option>
                              <option value="1Kerala Board of Public Examination">
                                 Kerala Board of Public Examination
                              </option>
                              <option value="Madhya Pradesh Board Of Secondary Education">
                                 Madhya Pradesh Board Of Secondary Education
                              </option>
                              <option value="Manipur Council Of Higher Secondary Education">
                                 Manipur Council Of Higher Secondary Education
                              </option>
                              <option value="Meghalaya Board Of School Education">
                                 Meghalaya Board Of School Education
                              </option>
                              <option value="Mizoram Board Of School Education">
                                 Mizoram Board Of School Education
                              </option>
                              <option value="Nagaland Board Of School Education">
                                 Nagaland Board Of School Education
                              </option>
                              <option value="Orissa Council Of Higher Secondary Education Bhubaneswar">
                                 Orissa Council Of Higher Secondary
                                 Education Bhubaneswar
                              </option>
                              <option value="Punjab School Education Board">Punjab
                                 School Education Board
                              </option>
                              <option value="Rajasthan Board Of Secondary Education">
                                 Rajasthan Board Of Secondary Education
                              </option>
                              <option value="Tamil Nadu Board Of Higher Secondary Education">
                                 Tamil Nadu Board Of Higher Secondary Education
                              </option>
                              <option value="Tripura Board Of Secondary Education">
                                 Tripura Board Of Secondary Education
                              </option>
                              <option value="U.P. Board Of High School And Intermediate Education">
                                 U.P. Board Of High School And Intermediate
                                 Education
                              </option>
                              <option value="Uttaranchal Shiksha Evam Pariksha Parishad">
                                 Uttaranchal Shiksha Evam Pariksha Parishad
                              </option>
                              <option value="West Bengal Board Of Madarsa Education">
                                 West Bengal Board Of Madarsa Education
                              </option>
                              <option value="Not specified/Any Other">Not
                                 specified/Any Other
                              </option>
                              <option value="1Other">Other</option>
                           </select>
                        </div>
                     </td>
                     <td>
                        <div class="form-group mg-b-10-force">
                           <select class="form-control custom-select" id="exampleFormControlSelect1">
                              <option value="">Select</option>
                              <option value="Regular/Formal" selected="selected">
                                 Regular/Formal
                              </option>
                              <option value="NIOS">NIOS</option>
                              <option value="Others">Others</option>
                           </select>
                        </div>
                     </td>
                     <td>
                        <div class="form-group mg-b-10-force" id="appering_info_1">
                           <select class="form-control custom-select" id="exampleFormControlSelect1">
                              <option value="">Select</option>
                              <option value="Percentage">Percentage</option>
                              <option value="CGPA out of 10">CGPA out of 10
                              </option>
                              <option value="CGPA out of 9">CGPA out of 9</option>
                              <option value="CGPA out of 7" selected="selected">
                                 CGPA out of 7
                              </option>
                              <option value="CGPA out of 4">CGPA out of 4</option>
                           </select>
                        </div>
                     </td>
                     <td>
                        <input class="form-control" type="text" name="SchoolName" placeholder="Enter SchoolName" id="appering_info_2">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="SchoolName" placeholder="Enter SchoolName" id="appering_info_3">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="SchoolName" placeholder="Enter SchoolName" id="appering_info_4">
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <p>Diploma/Graduation</p>
                     </td>
                     <td>
                        <input class="form-control" type="text" name="SchoolName" placeholder="Enter SchoolName">
                     </td>
                     <td>
                        <div class="form-group mg-b-10-force">
                           <select class="form-control custom-select" id="exampleFormControlSelect1">
                              <option value="">Select</option>
                              <option value="Central Board Of Secondary Education (CBSE)">
                                 Central Board Of Secondary Education (CBSE)
                              </option>
                              <option value="Council Of Indian School Certificate Examination (CISCE/ISC)">
                                 Council Of Indian School
                                 Certificate Examination (CISCE/ISC)
                              </option>
                              <option value="National Institute Of Open Schooling">
                                 National Institute Of Open Schooling
                              </option>
                              <option value="Andhra Pradesh Board Of Intermediate Education">
                                 Andhra Pradesh Board Of Intermediate Education
                              </option>
                              <option value="Telangana Board Of Intermediate Education">
                                 Telangana Board Of Intermediate Education
                              </option>
                              <option value="Bihar School Examination Board">Bihar
                                 School Examination Board
                              </option>
                              <option value="West Bengal Council Of Higher Secondary Education">
                                 West Bengal Council Of Higher Secondary
                                 Education
                              </option>
                              <option value="Maharastra State Board Of Secondary And Higher Secondary Education">
                                 Maharastra State Board Of
                                 Secondary And Higher Secondary Education
                              </option>
                              <option value="Goa Board Of Secondary And Higher Secondary Education">
                                 Goa Board Of Secondary And Higher
                                 Secondary Education
                              </option>
                              <option value="Aligarh Muslim University">Aligarh
                                 Muslim University
                              </option>
                              <option value="Assam Higher Secondary Education Council">
                                 Assam Higher Secondary Education Council
                              </option>
                              <option value="1Banasthali Vidyapith">Banasthali
                                 Vidyapith
                              </option>
                              <option value="Bihar Intermediate Education Council">
                                 Bihar Intermediate Education Council
                              </option>
                              <option value="2Board of Vocational Higher Secondary Education">
                                 Board of Vocational Higher Secondary Education
                              </option>
                              <option value="Cambridge University">Cambridge
                                 University
                              </option>
                              <option value="Chhatisgarh Board Of Secondary Education">
                                 Chhatisgarh Board Of Secondary Education
                              </option>
                              <option value="Gujarat Secondary And Higher Secondary Education Board">
                                 Gujarat Secondary And Higher Secondary
                                 Education Board
                              </option>
                              <option value="Haryana Board Of Education">Haryana
                                 Board Of Education
                              </option>
                              <option value="Himachal Pradesh Board Of School Education">
                                 Himachal Pradesh Board Of School Education
                              </option>
                              <option value="International Baccalaureate">
                                 International Baccalaureate
                              </option>
                              <option value="J And K State Board Of School Education">
                                 J And K State Board Of School Education
                              </option>
                              <option value="Jharkhand Academic Council">Jharkhand
                                 Academic Council
                              </option>
                              <option value="Karnataka Board Of The Pre-University Education">
                                 Karnataka Board Of The Pre-University Education
                              </option>
                              <option value="Kerala Board Of Higher Secondary Education">
                                 Kerala Board Of Higher Secondary Education
                              </option>
                              <option value="1Kerala Board of Public Examination">
                                 Kerala Board of Public Examination
                              </option>
                              <option value="Madhya Pradesh Board Of Secondary Education">
                                 Madhya Pradesh Board Of Secondary Education
                              </option>
                              <option value="Manipur Council Of Higher Secondary Education">
                                 Manipur Council Of Higher Secondary Education
                              </option>
                              <option value="Meghalaya Board Of School Education">
                                 Meghalaya Board Of School Education
                              </option>
                              <option value="Mizoram Board Of School Education">
                                 Mizoram Board Of School Education
                              </option>
                              <option value="Nagaland Board Of School Education">
                                 Nagaland Board Of School Education
                              </option>
                              <option value="Orissa Council Of Higher Secondary Education Bhubaneswar">
                                 Orissa Council Of Higher Secondary
                                 Education Bhubaneswar
                              </option>
                              <option value="Punjab School Education Board">Punjab
                                 School Education Board
                              </option>
                              <option value="Rajasthan Board Of Secondary Education">
                                 Rajasthan Board Of Secondary Education
                              </option>
                              <option value="Tamil Nadu Board Of Higher Secondary Education">
                                 Tamil Nadu Board Of Higher Secondary Education
                              </option>
                              <option value="Tripura Board Of Secondary Education">
                                 Tripura Board Of Secondary Education
                              </option>
                              <option value="U.P. Board Of High School And Intermediate Education">
                                 U.P. Board Of High School And Intermediate
                                 Education
                              </option>
                              <option value="Uttaranchal Shiksha Evam Pariksha Parishad">
                                 Uttaranchal Shiksha Evam Pariksha Parishad
                              </option>
                              <option value="West Bengal Board Of Madarsa Education">
                                 West Bengal Board Of Madarsa Education
                              </option>
                              <option value="Not specified/Any Other">Not
                                 specified/Any Other
                              </option>
                              <option value="1Other">Other</option>
                           </select>
                        </div>
                     </td>
                     <td>
                        <div class="form-group mg-b-10-force">
                           <select class="form-control custom-select" id="exampleFormControlSelect1">
                              <option value="">Select</option>
                              <option value="Regular/Formal" selected="selected">
                                 Regular/Formal
                              </option>
                              <option value="NIOS">NIOS</option>
                              <option value="Others">Others</option>
                           </select>
                        </div>
                     </td>
                     <td>
                        <div class="form-group mg-b-10-force" id="appering_info_1">
                           <select class="form-control custom-select" id="exampleFormControlSelect1">
                              <option value="">Select</option>
                              <option value="Percentage">Percentage</option>
                              <option value="CGPA out of 10">CGPA out of 10
                              </option>
                              <option value="CGPA out of 9">CGPA out of 9</option>
                              <option value="CGPA out of 7" selected="selected">
                                 CGPA out of 7
                              </option>
                              <option value="CGPA out of 4">CGPA out of 4</option>
                           </select>
                        </div>
                     </td>
                     <td>
                        <input class="form-control" type="text" name="SchoolName" placeholder="Enter SchoolName" id="appering_info_2">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="SchoolName" placeholder="Enter SchoolName" id="appering_info_3">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="SchoolName" placeholder="Enter SchoolName" id="appering_info_4">
                     </td>
                  </tr>
               </tbody>
            </table>
            <div class="mt-3 w-100">
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <h5 class="text-primary mb-4">Work Experience Details
                        </h5>
                        <label class="">Do you have any Work
                        Experience ?<span class="tx-danger">*</span></label>
                        <select class="form-control custom-select " data-placeholder="Choose Competitive Examination Details" tabindex="-1" aria-hidden="true">
                           <option>Select Work Experience</option>
                           <option value="Yes">Yes</option>
                           <option value="No">No</option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <table class="table table-bordered table-resposnive mt-5">
               <thead class="thead-light">
                  <tr>
                     <th></th>
                     <th>Organisation's Name</th>
                     <th>Designation</th>
                     <th>Sector</th>
                     <th>Annual Salary Package(In Lacs)</th>
                     <th>From Year</th>
                     <th>To Year</th>
                     <th>Work Experience (In Month)</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>1 </td>
                     <td>
                        <input class="form-control" type="text" name="Organisation" placeholder="Enter Organisation">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="Organisation" placeholder="Enter Organisation">
                     </td>
                     <td>
                        <div class="form-group mg-b-10-force">
                           <select class="form-control custom-select" id="exampleFormControlSelect1">
                              <option value="Select">Select</option>
                              <option value="IT">IT</option>
                           </select>
                        </div>
                     </td>
                     <td>
                        <input class="form-control" type="text" name="Salary" placeholder="Enter Salary">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="From Year" placeholder="Enter From Year">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="To Year" placeholder="Enter To Year">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="Experience" placeholder="Enter Experience">
                     </td>
                  </tr>
                  <tr>
                     <td>2 </td>
                     <td>
                        <input class="form-control" type="text" name="Organisation" placeholder="Enter Organisation">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="Organisation" placeholder="Enter Organisation">
                     </td>
                     <td>
                        <div class="form-group mg-b-10-force">
                           <select class="form-control custom-select" id="exampleFormControlSelect1">
                              <option value="Select">Select</option>
                              <option value="IT">IT</option>
                           </select>
                        </div>
                     </td>
                     <td>
                        <input class="form-control" type="text" name="Salary" placeholder="Enter Salary">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="From Year" placeholder="Enter From Year">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="To Year" placeholder="Enter To Year">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="Experience" placeholder="Enter Experience">
                     </td>
                  </tr>
                  <tr>
                     <td>3 </td>
                     <td>
                        <input class="form-control" type="text" name="Organisation" placeholder="Enter Organisation">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="Organisation" placeholder="Enter Organisation">
                     </td>
                     <td>
                        <div class="form-group mg-b-10-force">
                           <select class="form-control custom-select" id="exampleFormControlSelect1">
                              <option value="Select">Select</option>
                              <option value="IT">IT</option>
                           </select>
                        </div>
                     </td>
                     <td>
                        <input class="form-control" type="text" name="Salary" placeholder="Enter Salary">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="From Year" placeholder="Enter From Year">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="To Year" placeholder="Enter To Year">
                     </td>
                     <td>
                        <input class="form-control" type="text" name="Experience" placeholder="Enter Experience">
                     </td>
                  </tr>
               </tbody>
            </table>
            <div class="col-lg-5 ">
               <div class="form-group wd-xs-300 mr-5 w-100">
                  <label class="">Total Work Experience(In months)                                                            <span class="tx-danger">*</span></label>
                  <div class="form-group mg-b-10-force">
                     <input class="form-control" type="text" name="Name" placeholder="MM/YYYY">
                  </div>
               </div>
               <!-- form-group -->
            </div>
            <div class="w-100 mt-5">
               <div class="Payment_align">
                  <a href="#" class="btn btn-primary active float-right" role="button"
                     aria-pressed="true">MAKE PAYMENT</a>
               </div>
            </div>
         </fieldset>
         <h3>Payment Details</h3>
         <fieldset>
            <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
               <div class="card ">
                  <div class="card-header p-0 " role="tab" id="headingOne">
                     <h6 class="p-2 ml-3">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed instruction_accordion instruction_accordion">
                        <i class="fas fa-info-circle"></i>
                        Instructions</a>
                     </h6>
                  </div>
                  <!-- card-header -->
                  <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                     <div class="card-body" style="font-size: 13px;">SRMJEEE is common for all campuses. At the time of counselling,student can select branch and campus as per
                        availability. Course preference is collected for statistical
                        purpose only, final decision on course selection would be
                        made on the day of counselling only.
                     </div>
                  </div>
               </div>
               <!-- card -->
            </div>
            <div class="row w-100">
               <div class="col-lg-6">
                  <div class="card mb-3 base_details_card">
                     <div class="card-body">
                        <h5 class="card-title card_title">Personal Details</h5>
                        <p class="card-subtitle mb-3">Name : Gowtham.S </p>
                        <p class="card-subtitle mb-3">E-Mail : g@gmail.com</p>
                        <p class="card-subtitle">Phone Number : +91-8903887256</p>
                     </div>
                  </div>
                  <!-- card -->
                  <div class="card base_details_card">
                     <div class="card-body">
                        <h5 class="card-title card_title">Order Details</h5>
                        <p class="card-subtitle">Application Fee <span style="float: right;">1100.00</span>
                        </p>
                     </div>
                  </div>
                  <!-- card -->
               </div>
               <div class="col-lg-6">
                  <div class="card mb-3 base_details_card">
                     <div class="card-body">
                        <h5 class="card-title card_title">Payment Details</h5>
                        <div class="row mb-3">
                           <div class="col-lg-2">
                              <label class="rdiobox">
                              <input name="rdio" type="radio" id="online">
                              <span>Online</span>
                              </label>
                           </div>
                           <div class="col-lg-2">
                              <label class="rdiobox">
                              <input name="rdio" type="radio" id="dd">
                              <span>DD</span>
                              </label>
                           </div>
                        </div>
                        <p class="card-subtitle mb-3">Sub Total <span style="float: right;">1100.00</span>
                        </p>
                        <p class="card-subtitle">Total<span style="float: right;">1100.00</span>
                        </p>
                        <div id="payment_details" style="display: none;">
                           <div class="col-md-12 mt-3">
                              <div class="row">
                                 <div class="col-md-6">
                                    <input class="form-control" type="text" name="BankName" placeholder="Bank Name"
                                       id="">
                                 </div>
                                 <div class="col-md-6">
                                    <input class="form-control" type="text" name="BranchName" placeholder="Branch Name"
                                       id="">
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12 mt-3">
                              <div class="row">
                                 <div class="col-md-6">
                                    <input class="form-control" type="text" name="DDNumber" placeholder="DD Number"
                                       id="">
                                 </div>
                                 <div class="col-md-6">
                                    <input class="form-control" type="text" name="DDDate" placeholder="DD Date" id="">
                                 </div>
                              </div>
                           </div>
                           <div class="row mt-3">
                              <div class="col-sm-12 customIcon">
                                 <div class="flexbox flex-start">You must send your
                                    DD&nbsp;in favor of "SRMIST" Payable at Chennai.
                                    along with
                                    your Application Form with complete details
                                    (Full Name, Application Number, Mobile) to
                                    &nbsp;the
                                    below-mentioned address:<br><br>The Director
                                    (Admissions)<br>SRM Institute of Science and
                                    technology<br>SRM
                                    Nagar,<br>Kattankulathur-603 203<br>Chengalpattu
                                    District<br>Tamil Nadu, India 
                                 </div>
                              </div>
                           </div>
                        </div>
                        <a href="payment_success.html" class="btn btn-primary active w-100 mt-3" role="button"
                           aria-pressed="true">MAKE PAYMENT</a>
                     </div>
                  </div>
                  <!-- card -->
               </div>
            </div>
            <div class="row  w-100">
            </div>
         </fieldset>
         <h3>Upload & Declaration</h3>
         <fieldset>
            <div id="accordion" class="accordion w-100" role="tablist" aria-multiselectable="true" >
               <div class="card ">
                  <div class="card-header p-0 " role="tab" id="headingOne">
                     <h6 class="p-2 ml-3">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="tx-gray-800 transition collapsed instruction_accordion">
                        <i class="fas fa-info-circle"></i>
                        Instructions</a>
                     </h6>
                  </div>
                  <!-- card-header -->
                  <div id="collapseOne" class="collapse bg-light" role="tabpanel" aria-labelledby="headingOne" style="">
                     <div class="card-body" style="font-size: 13px;">SRMJEEE is common for all campuses. At the time of counselling,student can select branch and campus as per
                        availability. Course preference is collected for statistical
                        purpose only, final decision on course selection would be
                        made on the day of counselling only.
                     </div>
                  </div>
               </div>
               <!-- card -->
            </div>
            <div class="col-md-12">
               <div class="form-layout">
                  <div class="row mg-b-25 mt-3">
                     <div class="row w-100">
                        <div class="form-group col-md-6 ">
                           <label for="exampleFormControlTextarea1">Upload Your Recent Passport Size Photograph</label>
                           <div class="bootstrap-filestyle input-group">
                              <div name="filedrag" style="position: absolute; width: 100%; height: 35px; z-index: -1;"></div>
                              <input type="text" class="form-control " placeholder="" disabled="" style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem;"> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="filestyle-0" style="margin-bottom: 0;" class="btn btn-secondary "><span class="buttonText">Choose file</span></label></span>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Signature</label>
                           <div class="bootstrap-filestyle input-group">
                              <div name="filedrag" style="position: absolute; width: 100%; height: 35px; z-index: -1;"></div>
                              <input type="text" class="form-control " placeholder="" disabled="" style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem;"> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="filestyle-0" style="margin-bottom: 0;" class="btn btn-secondary "><span class="buttonText">Choose file</span></label></span>
                           </div>
                        </div>
                     </div>
                     <div class="row w-100">
                        <div class="form-group col-md-6">
                           <label for="exampleFormControlTextarea1">Upload Your 10th Marksheet </label>
                           <div class="bootstrap-filestyle input-group">
                              <div name="filedrag" style="position: absolute; width: 100%; height: 35px; z-index: -1;"></div>
                              <input type="text" class="form-control " placeholder="" disabled="" style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem;"> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="filestyle-0" style="margin-bottom: 0;" class="btn btn-secondary "><span class="buttonText">Choose file</span></label></span>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="exampleFormControlTextarea1">Upload Your 12th Marksheet </label>
                           <div class="bootstrap-filestyle input-group">
                              <div name="filedrag" style="position: absolute; width: 100%; height: 35px; z-index: -1;"></div>
                              <input type="text" class="form-control " placeholder="" disabled="" style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem;"> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="filestyle-0" style="margin-bottom: 0;" class="btn btn-secondary "><span class="buttonText">Choose file</span></label></span>
                           </div>
                        </div>
                     </div>
                     <div class="row w-100">
                        <div class="form-group col-md-6">
                           <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Aadhar card</label>
                           <div class="bootstrap-filestyle input-group">
                              <div name="filedrag" style="position: absolute; width: 100%; height: 35px; z-index: -1;"></div>
                              <input type="text" class="form-control " placeholder="" disabled="" style="border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem;"> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="filestyle-0" style="margin-bottom: 0;" class="btn btn-secondary "><span class="buttonText">Choose file</span></label></span>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class=" w-100 pd-20 pd-sm-40">
                           <h5 class="text-primary">Declaration</h5>
                           <span class="mt-4" style="line-height: 20px;">
                           I certify that the information submitted by me in support of this application, is true to the best of my knowledge and belief. I understand that in the event of any information being found false or incorrect, my admission is liable to be rejected / cancelled at any stage of the program. I undertake to abide by the disciplinary rules and regulations of the institute.
                           </span>
                           <div class="row mt-4">
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label class="">Applicant Name <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="Applicant Name" placeholder="Applicant Name">
                                 </div>
                              </div>
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label class="">Parent Name <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="Parent Name" placeholder="Parent Name">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-lg-6">
                                 <div class="form-group">
                                    <label class="">Date  <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="Date " placeholder="Date">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
               </div>
            </div>
         </fieldset>
      <?php form_close(); ?>
   </div>
</div>