<style>
    label.form-control-label {
        width: 100%;
    }
    span.select2.select2-container.select2-container--bootstrap {
        width: 100% !important;
    }
</style>
<h3>Basic Details</h3>
<section class="row">
    <div id="accordion" class="accordion w-100" role="tablist"
                                                aria-multiselectable="true" style="">
        <div class="card ">
            <div class="card-header p-0" role="tab" id="headingOne">
                <h6 class="mg-b-0">
                    <a id="collapseOne_parent" data-toggle="collapse" data-parent="#accordion"
                        href="#collapseOne" aria-expanded="false"
                        aria-controls="collapseOne"
                        class="tx-gray-800 transition collapsed">

                        <i class="fas fa-info-circle"></i>
                        Instructions</a>
                </h6>
            </div><!-- card-header -->

            <div id="collapseOne" class="collapse" role="tabpanel"
                aria-labelledby="headingOne" style="">
                <div class="card-body" style="font-size: 13px;">SRMJEEE is
                    common for all campuses. At the time of counselling,student
                    can select branch and campus as per
                    availability. Course preference is collected for statistical
                    purpose only, final decision on course selection would be
                    made on the day of counselling only.</div>
            </div>
        </div>

        <!-- card -->
    </div>
    <div class="card w-100 pd-20 pd-sm-40">
        <h6 class="card-body-title"></h6>
        <div class="form-layout">
            <div class="row mg-b-25 mt-3">
                <div class="col-lg-6">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Have you studied 10+2
                            from India? <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select study"
                            id="exampleFormControlSelect1">
                            <option value="">Select Status - Yes or No</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        <div id="info_study" style="display: none;">
                            <p><span class="tx-danger">*</span>Please note that
                                you have selected yes’ for the above which
                                implies you are eligible to seek admission under
                                domestic category. It is the sole responsibility
                                of the candidate to ensure that he/she is
                                applying under the right category.</p>
                            <label class="rdiobox">
                                <input name="rdio" type="radio">
                                <span>I Confirm</span>
                            </label>
                        </div>

                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force" id="Resident"
                        style="display:none">
                        <label class="form-control-label">Resident Status
                            <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option>Select Category - NRI or Foreign</option>
                            <option>Non Resident Indian</option>
                            <option>Foreign</option>

                        </select>
                    </div>
                </div>
            </div><!-- row -->
        </div><!-- form-layout -->
    </div>
</section>
<h3>Preferences and Personal Details</h3>
<section class="row">
    <div id="accordion" class="accordion w-100" role="tablist"
        aria-multiselectable="true" style="">
        <div class="card ">
            <div class="card-header p-0" role="tab" id="headingOne">
                <h6 class="mg-b-0">
                    <a data-toggle="collapse" data-parent="#accordion"
                        href="#collapseOne" aria-expanded="false"
                        aria-controls="collapseOne"
                        class="tx-gray-800 transition collapsed">

                        <i class="fas fa-info-circle"></i>
                        Instructions</a>
                </h6>
            </div><!-- card-header -->

            <div id="collapseOne" class="collapse" role="tabpanel"
                aria-labelledby="headingOne" style="">
                <div class="card-body" style="font-size: 13px;">SRMJEEE is
                    common for all campuses. At the time of counselling,student
                    can select branch and campus as per
                    availability. Course preference is collected for statistical
                    purpose only, final decision on course selection would be
                    made on the day of counselling only.</div>
            </div>
        </div>

        <!-- card -->
    </div>
    <div class="card w-100 pd-20 pd-sm-40">
        <h6 class="card-body-title">Select Course and Test City Preferences</h6>
        <div class="form-layout">
            <div class="row mg-b-25 mt-3">
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Campus Preference 1
                            <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option>Select</option>
                            <option>SRM IST, Main Campus (Kattankulathur,
                                Chennai)</option>
                            <option>SRM IST, NCR Campus, Delhi</option>
                            <option>SRM IST, Ramapuram Campus, Chennai</option>
                        </select>
                    </div>
                </div><!-- col-4 -->

            </div><!-- row -->

            <div class="row mg-b-25 mt-3">
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Course Preference 1
                            <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option>Select</option>
                            <option>SRM IST, Main Campus (Kattankulathur,
                                Chennai)</option>
                            <option>SRM IST, NCR Campus, Delhi</option>
                            <option>SRM IST, Ramapuram Campus, Chennai</option>
                        </select>
                    </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Course Preference 2
                        </label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option>Select</option>
                            <option>SRM IST, Main Campus (Kattankulathur,
                                Chennai)</option>
                            <option>SRM IST, NCR Campus, Delhi</option>
                            <option>SRM IST, Ramapuram Campus, Chennai</option>
                        </select>
                    </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Course Preference 3
                        </label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option>Select</option>
                            <option>SRM IST, Main Campus (Kattankulathur,
                                Chennai)</option>
                            <option>SRM IST, NCR Campus, Delhi</option>
                            <option>SRM IST, Ramapuram Campus, Chennai</option>
                        </select>
                    </div>
                </div><!-- col-4 -->


            </div><!-- row -->


            <div class="row mg-b-25 mt-3">
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Test State Preference
                            1
                            <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option>Select</option>
                            <option>SRM IST, Main Campus (Kattankulathur,
                                Chennai)</option>
                            <option>SRM IST, NCR Campus, Delhi</option>
                            <option>SRM IST, Ramapuram Campus, Chennai</option>
                        </select>
                    </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Test City Preference 1
                        </label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option>Select</option>
                            <option>SRM IST, Main Campus (Kattankulathur,
                                Chennai)</option>
                            <option>SRM IST, NCR Campus, Delhi</option>
                            <option>SRM IST, Ramapuram Campus, Chennai</option>
                        </select>
                    </div>
                </div><!-- col-4 -->

            </div><!-- row -->


            <div class="row mg-b-25 mt-3">
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Test State Preference
                            2
                        </label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option>Select</option>
                            <option>SRM IST, Main Campus (Kattankulathur,
                                Chennai)</option>
                            <option>SRM IST, NCR Campus, Delhi</option>
                            <option>SRM IST, Ramapuram Campus, Chennai</option>
                        </select>
                    </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Test City Preference 2
                        </label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option>Select</option>
                            <option>SRM IST, Main Campus (Kattankulathur,
                                Chennai)</option>
                            <option>SRM IST, NCR Campus, Delhi</option>
                            <option>SRM IST, Ramapuram Campus, Chennai</option>
                        </select>
                    </div>
                </div><!-- col-4 -->

            </div><!-- row -->


            <div class="row mg-b-25 mt-3">
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Test State Preference
                            3
                        </label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option>Select</option>
                            <option>SRM IST, Main Campus (Kattankulathur,
                                Chennai)</option>
                            <option>SRM IST, NCR Campus, Delhi</option>
                            <option>SRM IST, Ramapuram Campus, Chennai</option>
                        </select>
                    </div>
                </div><!-- col-4 -->

                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Test City Preference 3
                        </label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option>Select</option>
                            <option>SRM IST, Main Campus (Kattankulathur,
                                Chennai)</option>
                            <option>SRM IST, NCR Campus, Delhi</option>
                            <option>SRM IST, Ramapuram Campus, Chennai</option>
                        </select>
                    </div>
                </div><!-- col-4 -->

            </div><!-- row -->


        </div><!-- form-layout -->
    </div>

    <div class="card w-100 pd-20 pd-sm-40">
        <h6 class="card-body-title">Personal Details</h6>
        <div class="form-layout">
            <div class="row mg-b-25">
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Title<span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose country"></option>
                            <option value="MR">MR</option>
                            <option value="MRS">MRS</option>
                            <option value="MISS">MISS</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">FirstName <span
                                class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="Firstname"
                            placeholder="Enter lastname">
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Middle Name </label>
                        <input class="form-control" type="text"
                            name="MiddleName" placeholder="Middle Name">
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">LastName <span
                                class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="LastName"
                            placeholder="LastName">
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <label class="form-control-label">Mobile NO <span
                            class="tx-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon">+91</span>
                        <input type="text" class="form-control"
                            placeholder="Username">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Email ID <span
                                class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="email"
                            value="johnpaul@yourdomain.com"
                            placeholder="Enter email address">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="wd-200 w-100">
                        <label class="form-control-label">Date of Birth<span
                                class="tx-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i
                                    class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                            <input id="datepickerNoOfMonths" type="text"
                                class="form-control hasDatepicker"
                                placeholder="MM/DD/YYYY">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Gender <span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose Gender"></option>

                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Transgender">Transgender</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Alternate Email ID
                        </label>
                        <input class="form-control" type="text" name="email"
                            value="johnpaul@yourdomain.com"
                            placeholder="Enter email address">
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Blood Group <span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
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
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Religion</label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose Religion"></option>

                            <option value="christian">CHRISTIANITY</option>
                            <option value="hinduism">HINDUISM</option>
                            <option value="islam">ISLAM</option>
                            <option value="other">OTHERS/RELIGION NOT SPECIFIED
                            </option>
                        </select>
                    </div>
                </div><!-- col-4 -->

                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Mother Tongue</label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
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
                </div><!-- col-4 -->

                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Medium of
                            Instruction</label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose Medium of Instruction">
                            </option>

                            <option value>Select</option>
                            <option value="English">English</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div><!-- col-4 -->

                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Hostel
                            Accommodation</label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose Hostel Accommodation">
                            </option>

                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Transgender">Transgender</option>
                        </select>
                    </div>
                </div><!-- col-4 -->

                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Are you a differently
                            Abled?<span class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose differently Abled"></option>

                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Transgender">Transgender</option>
                        </select>
                    </div>
                </div><!-- col-4 -->

                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Where do you see
                            admission
                            advertisment?</label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose advertisment"></option>

                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Transgender">Transgender</option>
                        </select>
                    </div>
                </div><!-- col-4 -->

                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Nationality <span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose Community" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose Gender"></option>

                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Transgender">Transgender</option>
                        </select>
                    </div>
                </div><!-- col-4 -->

                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Community <span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose Community" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose Gender"></option>

                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Transgender">Transgender</option>
                        </select>
                    </div>
                </div><!-- col-4 -->

            </div><!-- row -->
        </div><!-- form-layout -->
    </div>

</section>
<h3>Parent's Details</h3>
<section class="row">
    <div id="accordion" class="accordion w-100" role="tablist"
    aria-multiselectable="true" style="">
        <div class="card ">
            <div class="card-header p-0" role="tab" id="headingOne">
                <h6 class="mg-b-0">
                    <a data-toggle="collapse" data-parent="#accordion"
                        href="#collapseOne" aria-expanded="false"
                        aria-controls="collapseOne"
                        class="tx-gray-800 transition collapsed">

                        <i class="fas fa-info-circle"></i>
                        Instructions</a>
                </h6>
            </div><!-- card-header -->

            <div id="collapseOne" class="collapse" role="tabpanel"
                aria-labelledby="headingOne" style="">
                <div class="card-body" style="font-size: 13px;">SRMJEEE is
                    common for all campuses. At the time of counselling,student
                    can select branch and campus as per
                    availability. Course preference is collected for statistical
                    purpose only, final decision on course selection would be
                    made on the day of counselling only.</div>
            </div>
        </div>

        <!-- card -->
    </div>
    <div class="card w-100 pd-20 pd-sm-40">
        <h6 class="card-body-title">Father's Details</h6>
        <div class="form-layout">
            <div class="row mg-b-25 mt-3">
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Title<span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose country"></option>
                            <option value="MR">MR</option>
                            <option value="MRS">MRS</option>
                            <option value="MISS">MISS</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Father's Name <span
                                class="tx-danger">*</span></label>
                        <input class="form-control" type="text"
                            name="Father's Name"
                            placeholder="Enter Father name">
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <label class="form-control-label">Father's Mobile Number
                    </label>
                    <div class="input-group">
                        <span class="input-group-addon">+91</span>
                        <input type="text" class="form-control"
                            placeholder="Username">
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="form-control-label">Father's Alternate Mobile
                        Number </label>
                    <div class="input-group">
                        <span class="input-group-addon">+91</span>
                        <input type="text" class="form-control"
                            placeholder="Username">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Father's Email ID
                        </label>
                        <input class="form-control" type="text" name="email"
                            value="johnpaul@yourdomain.com"
                            placeholder="Enter email address">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Father's
                            Occupation</label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose country"></option>
                            <option value="MR">MR</option>
                            <option value="MRS">MRS</option>
                            <option value="MISS">MISS</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->
        </div><!-- form-layout -->
    </div>
    <div class="card w-100 pd-20 pd-sm-40">
        <h6 class="card-body-title">Mother's Details</h6>
        <div class="form-layout">
            <div class="row mg-b-25 mt-3">
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Title<span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose country"></option>
                            <option value="MR">MR</option>
                            <option value="MRS">MRS</option>
                            <option value="MISS">MISS</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Mother's Name <span
                                class="tx-danger">*</span></label>
                        <input class="form-control" type="text"
                            name="Mother's Name"
                            placeholder="Enter Mother name">
                    </div>
                </div><!-- col-4 -->

            </div><!-- row -->
        </div><!-- form-layout -->
    </div>
    <div class="card w-100 pd-20 pd-sm-40">
        <h6 class="card-body-title">Guardian's Details</h6>
        <div class="form-layout">
            <div class="row mg-b-25 mt-3">

                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Guardian's Name <span
                                class="tx-danger">*</span></label>
                        <input class="form-control" type="text"
                            name="Guardian's Name"
                            placeholder="Enter Guardian name">
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <label class="form-control-label">Guardian's Mobile Number
                        <span class="tx-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon">+91</span>
                        <input type="text" class="form-control"
                            placeholder="Username">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Guardian's Email ID
                            <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="email"
                            value="johnpaul@yourdomain.com"
                            placeholder="Enter email address">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Guardian's
                            Occupation<span class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose country"></option>
                            <option value="MR">MR</option>
                            <option value="MRS">MRS</option>
                            <option value="MISS">MISS</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->
        </div><!-- form-layout -->
    </div>
    <div class="card w-100 pd-20 pd-sm-40">
        <h6 class="card-body-title">Address for Communication</h6>
        <div class="form-layout">
            <div class="row mg-b-25">
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Country<span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose country"></option>
                            <option value="MR">MR</option>
                            <option value="MRS">MRS</option>
                            <option value="MISS">MISS</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">State<span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose country"></option>
                            <option value="MR">MR</option>
                            <option value="MRS">MRS</option>
                            <option value="MISS">MISS</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">District<span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose country"></option>
                            <option value="MR">MR</option>
                            <option value="MRS">MRS</option>
                            <option value="MISS">MISS</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">city</label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option label="Choose country"></option>
                            <option value="MR">MR</option>
                            <option value="MRS">MRS</option>
                            <option value="MISS">MISS</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Address Line 1 <span
                                class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name=">Line"
                            placeholder="Enter Address Line 1">
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Address Line 2
                        </label>
                        <input class="form-control" type="text"
                            name="Address_Line_1"
                            placeholder="Enter Address Line 2">
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Pincode <span
                                class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="Pincode"
                            placeholder="Enter Pincode">
                    </div>
                </div><!-- col-4 -->

            </div><!-- row -->
        </div><!-- form-layout -->
    </div>

</section>
<h3>Academic Details</h3>
<section class="row">
    <div id="accordion" class="accordion w-100" role="tablist"
    aria-multiselectable="true" style="">
        <div class="card ">
            <div class="card-header p-0" role="tab" id="headingOne">
                <h6 class="mg-b-0">
                    <a data-toggle="collapse" data-parent="#accordion"
                        href="#collapseOne" aria-expanded="false"
                        aria-controls="collapseOne"
                        class="tx-gray-800 transition collapsed">

                        <i class="fas fa-info-circle"></i>
                        Instructions</a>
                </h6>
            </div><!-- card-header -->

            <div id="collapseOne" class="collapse" role="tabpanel"
                aria-labelledby="headingOne" style="">
                <div class="card-body" style="font-size: 13px;">SRMJEEE is
                    common for all campuses. At the time of counselling,student
                    can select branch and campus as per
                    availability. Course preference is collected for statistical
                    purpose only, final decision on course selection would be
                    made on the day of counselling only.</div>
            </div>
        </div>

        <!-- card -->
    </div>
    <h6 class="card-body-title mt-4 w-100">Academic Details</h6><br>
    <span class="card-subtitle mt-2 mb-2" style="color: red;">Only one attempt
        after first appearance is allowed</span>
    <div action="form-validation.html" id="selectForm" class="w-100">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group mr-5">
                    <label class="form-control-label">Current Education
                        Qualification Status
                        <span class="tx-danger">*</span></label>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="rdiobox">
                                <input name="rdio" type="radio" id="appearing">
                                <span>12th Appearing</span>
                            </label>
                        </div>
                        <div class="col-lg-5">
                            <label class="rdiobox">
                                <input name="rdio" type="radio" id="completed">
                                <span>12th Completed</span>
                            </label>
                        </div>
                    </div>

                </div><!-- form-group -->
            </div>
            <div class="col-lg-6 ">
                <div class="form-group wd-xs-300 mr-5 w-100">
                    <label class="form-control-label">Candidate's Name as in
                        10th Certificate
                        <span class="tx-danger">*</span></label>
                    <div class="form-group mg-b-10-force">
                        <input class="form-control" type="text" name="Name"
                            placeholder="Enter Name">
                    </div>
                    <small id="emailHelp" class="form-text text-muted">Kindly
                        type “NA” in case 10th Certificate is not available with
                        you.</small>
                </div><!-- form-group -->
            </div>
        </div>
    </div>
    <table class="table table-striped table-bordered mt-5">
        <p class="w-100">Academic Details</p>
        <thead class="thead-dark">
            <tr>
                <th>
                </th>
                <th> Institute Name </th>
                <th> Board </th>
                <th> Year of Passing </th>
                <th> Marking Scheme
                        </th>
                <th> Obtained Percentage/CGPA
                        </th>
                <th> Registration No./Roll No.
                        </th>
                <th> Mode of Study
                        </th>


            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p>12th</p>
                </td>
                <td>
                    <input class="form-control" type="text" name="InstuName"
                        placeholder="">
                </td>
                <td>
                    <div class="form-group mg-b-10-force">
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </td>

                <td>
                    <div class="form-group mg-b-10-force">
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </td>
                <td>
                    <div class="form-group mg-b-10-force">
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </td>
                <td>
                    <input class="form-control" type="text" name="cgpa"
                        placeholder="">
                </td>
                <td>
                    <input class="form-control" type="text" name="Regno"
                        placeholder="">
                </td>

                <td>
                    <div class="form-group mg-b-10-force">
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </td>

            </tr>

            
        </tbody>
    </table>
    <div class="mt-5 w-100">
        <div class="row">

            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label">Address of school/college<span class="tx-danger">*</span>
                    </label>
                    <input class="form-control" type="text" name=""
                        placeholder="">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label">NAD ID/Digilocker ID<span class="tx-danger">*</span>
                    </label>
                    <input class="form-control" type="text" name=""
                        placeholder="Enter NAD ID / Digilocker ID ">
                </div>
            </div>

            

        </div>
    </div>
    <div class="w-100 mt-5">
        <div class="Payment_align">

            <a href="#" class="btn btn-primary active float-right" role="button"
                aria-pressed="true">MAKE PAYMENT</a>
        </div>
    </div>

</section>
<h3>Payment Details</h3>
<section class="row">
    <div class="col-lg-7 mb-3">
        <div class="card mb-3 base_details_card">
            <div class="card-body">
                <h5 class="card-title card_title">Personal Details</h5>
                <p class="card-subtitle mb-3">Name : Gowtham.S </p>
                <p class="card-subtitle mb-3">E-Mail : g@gmail.com</p>
                <p class="card-subtitle">Phone Number : +91-8903887256</p>
            </div>
        </div><!-- card -->
        <div class="card base_details_card">
            <div class="card-body">
                <h5 class="card-title card_title">Order Details</h5>
                <p class="card-subtitle">Application Fee <span
                        style="float: right;">1100.00</span>
                </p>
            </div>
        </div><!-- card -->

    </div>
    <div class="col-lg-5">
        <div class="card mb-3 base_details_card">
            <div class="card-body">
                <h5 class="card-title card_title">Payment Details</h5>
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <label class="rdiobox">
                            <input name="rdio" type="radio">
                            <span>Online</span>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class="rdiobox">
                            <input name="rdio" type="radio">
                            <span>DD</span>
                        </label>
                    </div>
                </div>
                <p class="card-subtitle mb-3">Sub Total <span
                        style="float: right;">1100.00</span>
                </p>
                <p class="card-subtitle">Total<span
                        style="float: right;">1100.00</span>
                </p>
                <a href="payment_success.html" class="btn btn-primary active w-100 mt-3"
                    role="button" aria-pressed="true">MAKE PAYMENT</a>

            </div>
        </div><!-- card -->
    </div>
</section>
<h3>Upload & Declaration</h3>
<section class="row">
    <div class="card w-100 pd-20 pd-sm-40">
        <div class="form-layout">
            <div class="row mg-b-25 mt-3">
                <div class="form-group col-md-6 mt-4 mb-5">
                    <label for="exampleFormControlTextarea1">Upload Your Recent Passport Size Photograph</label>

                    <div class="custom-file">
                        <label class="custom-file-label" for="customFile">Choose Passport</label>
                        <input type="file" class="custom-file-input form-control" id="customFile">
                        <small id="emailHelp" class="form-text text-muted mt-3">Max Upload Limit 200 KB</small>

                        
                    </div>
                </div>
                <div class="form-group col-md-6 mt-4 mb-5">
                    <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Signature</label>

                    <div class="custom-file">
                        <label class="custom-file-label" for="customFile">Choose Signature</label>
                        <input type="file" class="custom-file-input form-control" id="customFile">
                        <small id="emailHelp" class="form-text text-muted mt-3">Max Upload Limit 200 KB</small>

                        
                    </div>
                </div>
                <div class="form-group col-md-6 mt-4 mb-5">
                    <label for="exampleFormControlTextarea1">Upload Your 10th Marksheet </label>

                    <div class="custom-file">
                        <label class="custom-file-label" for="customFile">Choose Marksheet</label>
                        <input type="file" class="custom-file-input form-control" id="customFile">
                        <small id="emailHelp" class="form-text text-muted mt-3">Max Upload Limit 200 KB</small>

                        
                    </div>
                </div>
                <div class="form-group col-md-6 mt-4 mb-5">
                    <label for="exampleFormControlTextarea1">Upload Your 12th Marksheet </label>

                    <div class="custom-file">
                        <label class="custom-file-label" for="customFile">Choose Marksheet</label>
                        <input type="file" class="custom-file-input form-control" id="customFile">
                        <small id="emailHelp" class="form-text text-muted mt-3">Max Upload Limit 200 KB</small>

                        
                    </div>
                </div>
               
                <div class="form-group col-md-6 mt-4 mb-5">
                    <label for="exampleFormControlTextarea1">Upload Scanned Copy of Your Aadhar card</label>

                    <div class="custom-file">
                        <label class="custom-file-label" for="customFile">Choose  Aadhar card</label>
                        <input type="file" class="custom-file-input form-control" id="customFile">
                        <small id="emailHelp" class="form-text text-muted mt-3">Max Upload Limit 200 KB</small>

                        
                    </div>
                </div>
                
            </div><!-- row -->
        </div><!-- form-layout -->
        <h6 class="card-body-title">Declaration</h6>
        <span>I certify that the information submitted by me in support of this application, 
            is true to the best of my knowledge and belief. 
            I understand that in the event of any information being found false or incorrect,
             my admission is liable to be rejected / cancelled at any stage of the program. 
             I undertake to abide by the disciplinary rules and regulations of the institute.
        </span>
        <div class="form-layout">
            <div class="row mg-b-25 mt-3">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label">Applicant Name<span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="Applicant Name" placeholder="Applicant Name">
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label">Parent Name <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="Parent Name" placeholder="Parent Name">
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-6">
                    <label class="form-control-label">Date<span class="tx-danger">*</span></label>
                    <div class="input-group">
                        
                        <input type="text" class="form-control" placeholder="Date">
                    </div>
                </div>
            </div><!-- row -->
        </div>
    </div>
</section>