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
    <div id="accordion" class="accordion w-100" role="tablist"aria-multiselectable="true" style="">
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

            <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" style="">
                <div class="card-body" style="font-size: 13px;">SRMJEEE is common for all campuses. At the time of counselling,student can select branch and campus as per
                    availability. Course preference is collected for statistical
                    purpose only, final decision on course selection would be
                    made on the day of counselling only.</div>
            </div>
        </div>

        <!-- card -->
    </div>
    <div class="card w-100 pd-20 pd-sm-40">
        <h6 class="card-body-title">Basic Details</h6>
        <div class="form-layout">
            <div class="row mg-b-25 mt-3">
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Nationality <span class="tx-danger">*</span></label>
                        <select class="form-control select2 nationality" id="nationality" name="nationality">
                            <option value="">Select Nationality</option>
                            <!-- <option value="Indian">Indian</option>
                            <option value="Afghan">Afghan</option>
                            <option value="Albanian">Albanian</option> -->
                        </select>
                        <div class="form-group mt-5" id="indian"
                            style="display: none;">
                            Please be advised that being an NRI you have two
                            options for admission:
                            <br><br>
                            Option 1 :
                            <b>Admission through SRMJEEE 2020</b>
                            <br><br>
                            1) Write SRMJEEE 2020<br>
                            2) Satisfy all eligibility criteria that
                            applies to domestic applicants<br>
                            3) Choose the program and campus during the
                            counselling subject to availability of
                            seats<br>
                            4) Pay as per the domestic tuition fee structure of
                            SRMIST
                            <br><br>Option 2 :&nbsp;
                            <b>Direct Admissions</b>
                            <br><br>
                            1) SRMJEEE 2020 is not mandatory<br>
                            2) Satisfy all eligibility criteria that applies to
                            international applicants<br>
                            3) Choose the program and campus through
                            International admission process<br>
                            4) Pay as per the international fee structure of
                            SRMIST
                            <br><br>
                            International Application Form link is as
                            follows:&nbsp;<a
                                src="https://intlapplications.srmist.edu.in/international-application-form-2020">https://intlapplications.srmist.edu.in/international-application-form-2020</a>
                        </div>
                        <div class="form-group formAreaCols" id="indian2">
                            SRMJEEE is not applicable for international
                            students. Go to the below link to
                            proceed further.<br><br><a
                                href="https://intlapplications.srmist.edu.in/international-application-form-2020"><b>https://intlapplications.srmist.edu.in/international-application-form-2020</b></a>
                        </div>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Have you studied from
                            India?
                            <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select" id="study">
                            <option value="">Select Status - Yes or No</option>
                            <option value="Yes">Yes </option>
                            <option value="No">No </option>
                        </select>
                    </div>
                </div><!-- col-4 -->

            </div><!-- row -->

        </div><!-- form-layout -->
        <!-- <div class="actions clearfix">
            <a href="#" class="btn btn-secondary active" role="button" aria-pressed="true">BACK</a>
            <a href="#next" class="btn btn-primary active next"  role="menuitem">SAVE & EXIT</a>
        </div> -->
        <!-- <div class="actions clearfix">
            <ul role="menu" aria-label="Pagination">
                <li class="disabled" aria-disabled="true"><a href="#previous" role="menuitem" class="previous">Previous</a></li>
                <li aria-hidden="false" aria-disabled="false"><a href="#next" role="menuitem" class="next">SAVE & EXIT</a></li>
            </ul>
        </div> -->
    </div>
</section>
<h3>Personal Details</h3>
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
                <div class="card-body" style="font-size: 13px;">SRMJEEE is common for all campuses. At the time of counselling,student can select branch and campus as per
                    availability. Course preference is collected for statistical
                    purpose only, final decision on course selection would be
                    made on the day of counselling only.</div>
            </div>
        </div>

        <!-- card -->
    </div>
    <div class="card w-100 pd-20 pd-sm-40">
        <h6 class="card-body-title">Course and Campus Preference </h6>
        <div class="form-layout">
            <div class="row mg-b-25 mt-3">
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Course Preference 1 <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select select2 Course" id="course" name="course">
                            <option value="">Select Course Preference 1</option>
                            <!-- <option value="Aerospace">Aerospace Engineering
                            </option>
                            <option value="Artificial">Artificial Intelligence
                            </option>
                            <option value="Automobile">Automobile Engineering
                            </option>
                            <option value="Bioelectronics">Bioelectronics
                                Engineering</option> -->
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Specialization
                            Preference 1
                            <span class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 Specialization"
                            id="specialization" name="specialization">
                            <option value="">Select Specialization Preference 1</option>
                            <!-- <option value="Aerospace">Aerospace Engineering
                            </option>
                            <option value="Artificial">Artificial Intelligence
                            </option>
                            <option value="Automobile">Automobile Engineering
                            </option>
                            <option value="Bioelectronics">Bioelectronics
                                Engineering</option> -->
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Campus Preference 1
                            <span class="tx-danger">*</span></label>
                        <select class="form-control select2 Campus"
                            id="campus" name="campus">
                            <option value="">Select Campus Preference 1</option>
                            <!-- <option value="Amaravati">SRM University, AP,
                                Amaravati</option>
                            <option value="Haryana">SRM University, Sonepat,
                                Haryana</option>
                            <option value="MainCampus">SRMIST, Main Campus
                                (Kattankulathur, Chennai)</option>
                            <option value="Delhi">SRMIST, NCR Campus, Delhi
                            </option>
                            <option value="Ramapuram">SRMIST, Ramapuram Campus
                            </option>
                            <option value="Vadapalani">SRMIST, Vadapalani Campus
                            </option> -->

                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Course Preference 2
                            <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option value="">Select Course Preference 2</option>
                            <option value="Aerospace">Aerospace Engineering
                            </option>
                            <option value="Artificial">Artificial Intelligence
                            </option>
                            <option value="Automobile">Automobile Engineering
                            </option>
                            <option value="Bioelectronics">Bioelectronics
                                Engineering</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Specialization
                            Preference 2
                            <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option value="">Select Course Preference 2</option>
                            <option value="Aerospace">Aerospace Engineering
                            </option>
                            <option value="Artificial">Artificial Intelligence
                            </option>
                            <option value="Automobile">Automobile Engineering
                            </option>
                            <option value="Bioelectronics">Bioelectronics
                                Engineering</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Campus Preference 2
                            <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option value="">Select Campus Preference 2</option>
                            <option value="Amaravati">SRM University, AP,
                                Amaravati</option>
                            <option value="Haryana">SRM University, Sonepat,
                                Haryana</option>
                            <option value="MainCampus">SRMIST, Main Campus
                                (Kattankulathur, Chennai)</option>
                            <option value="Delhi">SRMIST, NCR Campus, Delhi
                            </option>
                            <option value="Ramapuram">SRMIST, Ramapuram Campus
                            </option>
                            <option value="Vadapalani">SRMIST, Vadapalani Campus
                            </option>

                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Course Preference 3
                            <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option value="">Select Course Preference 1</option>
                            <option value="Aerospace">Aerospace Engineering
                            </option>
                            <option value="Artificial">Artificial Intelligence
                            </option>
                            <option value="Automobile">Automobile Engineering
                            </option>
                            <option value="Bioelectronics">Bioelectronics
                                Engineering</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Specialization
                            Preference 3
                            <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option value="">Select Course Preference 1</option>
                            <option value="Aerospace">Aerospace Engineering
                            </option>
                            <option value="Artificial">Artificial Intelligence
                            </option>
                            <option value="Automobile">Automobile Engineering
                            </option>
                            <option value="Bioelectronics">Bioelectronics
                                Engineering</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Campus Preference 3
                            <span class="tx-danger">*</span></label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option value="">Select Campus Preference 1</option>
                            <option value="Amaravati">SRM University, AP,
                                Amaravati</option>
                            <option value="Haryana">SRM University, Sonepat,
                                Haryana</option>
                            <option value="MainCampus">SRMIST, Main Campus
                                (Kattankulathur, Chennai)</option>
                            <option value="Delhi">SRMIST, NCR Campus, Delhi
                            </option>
                            <option value="Ramapuram">SRMIST, Ramapuram Campus
                            </option>
                            <option value="Vadapalani">SRMIST, Vadapalani Campus
                            </option>

                        </select>
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->
        </div><!-- form-layout -->
    </div>
    <div class="card w-100 pd-20 pd-sm-40">
        <h6 class="card-body-title">Test City Perferences</h6>
        <div class="form-layout">
            <div class="row mg-b-25">
                <div class="col-lg-6">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Test State Perferences
                            1<span class="tx-danger">*</span></label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option value="">Select</option>
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
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Test City Perferences
                            1<span class="tx-danger">*</span></label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option value="">Select</option>
                            <option value="Chidambaram">Chidambaram</option>
                            <option value="Coimbatore">Coimbatore</option>
                            <option value="Erode">Erode</option>
                            <option value="Krishnagiri">Krishnagiri</option>
                            <option value="Madurai">Madurai</option>
                            <option value="Nagercoil">Nagercoil</option>
                            <option value="Namakkal">Namakkal</option>
                            <option value="Salem">Salem</option>
                            <option
                                value="SRM IST, Main Campus (Kattankulathur, Chennai)">
                                SRM IST, Main Campus (Kattankulathur, Chennai)
                            </option>
                            <option value="SRM IST, Ramapuram Campus, Chennai"
                                style="display: block;">SRM IST, Ramapuram
                                Campus, Chennai
                            </option>
                            <option value="SRM IST, Vadapalani Campus, Chennai">
                                SRM IST, Vadapalani Campus, Chennai</option>
                            <option value="Thanjavur">Thanjavur</option>
                            <option value="Tiruchirappalli">Tiruchirappalli
                            </option>
                            <option value="Tirunelveli">Tirunelveli</option>
                            <option value="Tiruppur">Tiruppur</option>
                            <option value="Vellore">Vellore</option>
                        </select>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Test State Perferences
                            2<span class="tx-danger">*</span></label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option value="">Select</option>
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
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Test City Perferences
                            2<span class="tx-danger">*</span></label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option value="">Select</option>
                            <option value="Chidambaram">Chidambaram</option>
                            <option value="Coimbatore">Coimbatore</option>
                            <option value="Erode">Erode</option>
                            <option value="Krishnagiri">Krishnagiri</option>
                            <option value="Madurai">Madurai</option>
                            <option value="Nagercoil">Nagercoil</option>
                            <option value="Namakkal">Namakkal</option>
                            <option value="Salem">Salem</option>
                            <option
                                value="SRM IST, Main Campus (Kattankulathur, Chennai)">
                                SRM IST, Main Campus (Kattankulathur, Chennai)
                            </option>
                            <option value="SRM IST, Ramapuram Campus, Chennai"
                                style="display: block;">SRM IST, Ramapuram
                                Campus, Chennai
                            </option>
                            <option value="SRM IST, Vadapalani Campus, Chennai">
                                SRM IST, Vadapalani Campus, Chennai</option>
                            <option value="Thanjavur">Thanjavur</option>
                            <option value="Tiruchirappalli">Tiruchirappalli
                            </option>
                            <option value="Tirunelveli">Tirunelveli</option>
                            <option value="Tiruppur">Tiruppur</option>
                            <option value="Vellore">Vellore</option>
                        </select>
                    </div>
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Test State Perferences
                            3<span class="tx-danger">*</span></label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option value="">Select</option>
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
                </div><!-- col-6 -->
                <div class="col-lg-6">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Test City Perferences
                            3<span class="tx-danger">*</span></label>
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option value="">Select</option>
                            <option value="Chidambaram">Chidambaram</option>
                            <option value="Coimbatore">Coimbatore</option>
                            <option value="Erode">Erode</option>
                            <option value="Krishnagiri">Krishnagiri</option>
                            <option value="Madurai">Madurai</option>
                            <option value="Nagercoil">Nagercoil</option>
                            <option value="Namakkal">Namakkal</option>
                            <option value="Salem">Salem</option>
                            <option
                                value="SRM IST, Main Campus (Kattankulathur, Chennai)">
                                SRM IST, Main Campus (Kattankulathur, Chennai)
                            </option>
                            <option value="SRM IST, Ramapuram Campus, Chennai"
                                style="display: block;">SRM IST, Ramapuram
                                Campus, Chennai
                            </option>
                            <option value="SRM IST, Vadapalani Campus, Chennai">
                                SRM IST, Vadapalani Campus, Chennai</option>
                            <option value="Thanjavur">Thanjavur</option>
                            <option value="Tiruchirappalli">Tiruchirappalli
                            </option>
                            <option value="Tirunelveli">Tirunelveli</option>
                            <option value="Tiruppur">Tiruppur</option>
                            <option value="Vellore">Vellore</option>
                        </select>
                    </div>
                </div><!-- col-6 -->
            </div><!-- row -->
        </div><!-- form-layout -->
    </div>
    <div class="card w-100 pd-20 pd-sm-40">
        <h6 class="card-body-title">personal Details</h6>
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
                        <label class="form-control-label">FirstName: <span
                                class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="Firstname"
                            placeholder="Enter lastname">
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Middle Name <span
                                class="tx-danger">*</span></label>
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
                        <label class="form-control-label">Email address: <span
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
                            <input id="datepicker" type="text"
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
                        <label class="form-control-label">Alternate Email
                            address: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="email"
                            value="johnpaul@yourdomain.com"
                            placeholder="Enter email address">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Community <span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            id="Community" data-placeholder="Choose Community"
                            tabindex="-1" aria-hidden="true">
                            <option value="">Select Community</option>
                            <option value="General /OC">General /OC </option>
                            <option value="General / EWS">General / EWS
                            </option>
                            <option selected="selected" value="OBC/BC/MBC">
                                OBC/BC/MBC </option>
                            <option value="SC">SC </option>
                            <option value="ST">ST </option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Blood Group <span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option value="">Select Blood Group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="Unknown">Unknown</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Religion<span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option value="">Select</option>
                            <option value="CHRISTIANITY">CHRISTIANITY</option>
                            <option value="HINDUISM">HINDUISM</option>
                            <option value="ISLAM">ISLAM</option>
                            <option value="OTHERS/RELIGION NOT SPECIFIED">
                                OTHERS/RELIGION NOT SPECIFIED</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Medium of
                            Instruction<span class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option label="Select Medium of Instruction">
                            </option>
                            <option value="English">English</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Hostel
                            Accommodation<span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option>Select Hostel Accommodation</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-3">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Mother Tongue<span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option value="">Select Mother Tongue</option>
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
                        <label class="form-control-label">Where do you see
                            admission
                            advertisment?<span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option value="">Select</option>
                            <option value="Newspaper">Newspaper </option>
                            <option value="Google Search">Google Search
                            </option>
                            <option value="Social Media">Social Media </option>
                            <option value="Whatsapp Messages">Whatsapp Messages
                            </option>
                            <option value="Online Advertisment">Online
                                Advertisment </option>
                            <option value="Coaching centre/Counsellors">Coaching
                                centre/Counsellors </option>
                            <option value="Newspaper Events">Newspaper Events
                            </option>
                            <option value="Friends/Relatives">Friends/Relatives
                            </option>
                            <option value="Magazine">Magazine </option>
                            <option selected="selected" value="SRM Website">SRM
                                Website </option>
                            <option value="Teacher/School">Teacher/School
                            </option>
                            <option value="Word of mouth">Word of mouth
                            </option>
                            <option value="SRM Helpline">SRM Helpline </option>
                            <option value="Other">Other</option>
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
                            <option value="">Select - Yes/No</option>
                            <option value="Yes">Yes </option>
                            <option value="No">No </option>
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
                <div class="card-body" style="font-size: 13px;">SRMJEEE is common for all campuses. At the time of counselling,student can select branch and campus as per
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
                        <label class="form-control-label">Father's Name: <span
                                class="tx-danger">*</span></label>
                        <input class="form-control" type="text"
                            name="Father's Name"
                            placeholder="Enter Father name">
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <label class="form-control-label">Father's Mobile NO <span
                            class="tx-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon">+91</span>
                        <input type="text" class="form-control"
                            placeholder="Username">
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="form-control-label">Father's Alternate Mobile
                        NO <span class="tx-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon">+91</span>
                        <input type="text" class="form-control"
                            placeholder="Username">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Father's Email ID:
                            <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="email"
                            value="johnpaul@yourdomain.com"
                            placeholder="Enter email address">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Father's
                            Occupation<span class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option value="">Select Father's Occupation</option>
                            <option value="Business">Business</option>
                            <option value="Defence">Defence</option>
                            <option value="Government Sector">Government Sector
                            </option>
                            <option value="Homemaker">Homemaker</option>
                            <option value="Private Sector">Private Sector
                            </option>
                            <option value="Retired">Retired</option>
                            <option value="Other">Other</option>
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
                        <label class="form-control-label">Mother's Name: <span
                                class="tx-danger">*</span></label>
                        <input class="form-control" type="text"
                            name="Mother's Name"
                            placeholder="Enter Mother name">
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <label class="form-control-label">Mother's Mobile NO <span
                            class="tx-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon">+91</span>
                        <input type="text" class="form-control"
                            placeholder="Username">
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="form-control-label">Mother's Alternate Mobile
                        NO <span class="tx-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon">+91</span>
                        <input type="text" class="form-control"
                            placeholder="Username">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Mother's Email ID:
                            <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="email"
                            value="johnpaul@yourdomain.com"
                            placeholder="Enter email address">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Mother's
                            Occupation<span class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
                            <option value="">Select Mother's Occupation</option>
                            <option value="Business">Business</option>
                            <option value="Defence">Defence</option>
                            <option value="Government Sector">Government Sector
                            </option>
                            <option value="Homemaker">Homemaker</option>
                            <option value="Private Sector">Private Sector
                            </option>
                            <option value="Retired">Retired</option>
                            <option value="Other">Other</option>
                        </select>
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
                        <label class="form-control-label">Guardian's Name: <span
                                class="tx-danger">*</span></label>
                        <input class="form-control" type="text"
                            name="Guardian's Name"
                            placeholder="Enter Guardian name">
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-4">
                    <label class="form-control-label">Guardian's Mobile NO <span
                            class="tx-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon">+91</span>
                        <input type="text" class="form-control"
                            placeholder="Username">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Guardian's Email ID:
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
                            <option value="">Select Mother's Occupation</option>
                            <option value="Business">Business</option>
                            <option value="Defence">Defence</option>
                            <option value="Government Sector">Government Sector
                            </option>
                            <option value="Homemaker">Homemaker</option>
                            <option value="Private Sector">Private Sector
                            </option>
                            <option value="Retired">Retired</option>
                            <option value="Other">Other</option>
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
                            <option>Selcet country</option>
                            <option value="Afganistan">Afghanistan</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa
                            </option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antigua & Barbuda">Antigua & Barbuda
                            </option>
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
                            <option value="Bosnia & Herzegovina">Bosnia &
                                Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Brazil">Brazil</option>
                            <option value="British Indian Ocean Ter">British
                                Indian Ocean Ter</option>
                            <option value="Brunei">Brunei</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Canary Islands">Canary Islands
                            </option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands
                            </option>
                            <option value="Central African Republic">Central
                                African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Channel Islands">Channel Islands
                            </option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Christmas Island">Christmas Island
                            </option>
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
                            <option value="Czech Republic">Czech Republic
                            </option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican
                                Republic</option>
                            <option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea
                            </option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Falkland Islands">Falkland Islands
                            </option>
                            <option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="French Guiana">French Guiana</option>
                            <option value="French Polynesia">French Polynesia
                            </option>
                            <option value="French Southern Ter">French Southern
                                Ter</option>
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
                            <option value="Marshall Islands">Marshall Islands
                            </option>
                            <option value="Martinique">Martinique</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Midway Islands">Midway Islands
                            </option>
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
                            <option value="Netherland Antilles">Netherland
                                Antilles</option>
                            <option value="Netherlands">Netherlands (Holland,
                                Europe)</option>
                            <option value="Nevis">Nevis</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island
                            </option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau Island">Palau Island</option>
                            <option value="Palestine">Palestine</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea
                            </option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Phillipines">Philippines</option>
                            <option value="Pitcairn Island">Pitcairn Island
                            </option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Republic of Montenegro">Republic of
                                Montenegro</option>
                            <option value="Republic of Serbia">Republic of
                                Serbia</option>
                            <option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option>
                            <option value="Russia">Russia</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="St Barthelemy">St Barthelemy</option>
                            <option value="St Eustatius">St Eustatius</option>
                            <option value="St Helena">St Helena</option>
                            <option value="St Kitts-Nevis">St Kitts-Nevis
                            </option>
                            <option value="St Lucia">St Lucia</option>
                            <option value="St Maarten">St Maarten</option>
                            <option value="St Pierre & Miquelon">St Pierre &
                                Miquelon</option>
                            <option value="St Vincent & Grenadines">St Vincent &
                                Grenadines</option>
                            <option value="Saipan">Saipan</option>
                            <option value="Samoa">Samoa</option>
                            <option value="Samoa American">Samoa American
                            </option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome & Principe">Sao Tome &
                                Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands
                            </option>
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
                            <option value="Trinidad & Tobago">Trinidad & Tobago
                            </option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Turks & Caicos Is">Turks & Caicos Is
                            </option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="United Kingdom">United Kingdom
                            </option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Erimates">United Arab
                                Emirates</option>
                            <option value="United States of America">United
                                States of America</option>
                            <option value="Uraguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Vatican City State">Vatican City
                                State</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="Virgin Islands (Brit)">Virgin Islands
                                (Brit)</option>
                            <option value="Virgin Islands (USA)">Virgin Islands
                                (USA)</option>
                            <option value="Wake Island">Wake Island</option>
                            <option value="Wallis & Futana Is">Wallis & Futana
                                Is</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zaire">Zaire</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
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
                        <label class="form-control-label">City<span
                                class="tx-danger">*</span></label>
                        <select
                            class="form-control select2 select2-hidden-accessible"
                            data-placeholder="Choose country" tabindex="-1"
                            aria-hidden="true">
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
                        <label class="form-control-label">Address Line 2 <span
                                class="tx-danger">*</span></label>
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
                <div class="card-body" style="font-size: 13px;">SRMJEEE is common for all campuses. At the time of counselling,student can select branch and campus as per
                    availability. Course preference is collected for statistical
                    purpose only, final decision on course selection would be
                    made on the day of counselling only.</div>
            </div>
        </div>

        <!-- card -->
    </div>
    <h6 class="card-body-title mt-4">Academic Details</h6>
    <div action="form-validation.html" id="selectForm" class="w-100">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group mr-5">
                    <label class="form-control-label">Current Equcation
                        Qualification Status
                        <span class="tx-danger">*</span></label>
                    <div class="row">
                        <div class="col-lg-5">
                            <label class="rdiobox">
                                <input name="rdio" type="radio" id="appering">
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
                    <label class="form-control-label">Candidate Name as in 10th
                        Certificate
                        <span class="tx-danger">*</span></label>
                    <div class="form-group mg-b-10-force">
                        <input class="form-control" type="text" name="Name"
                            placeholder="Enter Name">
                        <small id="emailHelp"
                            class="form-text text-muted">Kindly type “NA” in
                            case 10th Certificate is not available with
                            you.</small>
                    </div>
                </div><!-- form-group -->
            </div>
        </div>
    </div>
    <table class="table mt-5">
        <thead>
            <tr>
                <td><label class="form-control-label">Course<span
                            class="tx-danger">*</span></label>
                </td>
                <td> <label class="form-control-label">Institute Name <span
                            class="tx-danger">*</span></label> </td>
                <td> <label class="form-control-label">Board <span
                            class="tx-danger">*</span></label> </td>
                <td> <label class="form-control-label">Mode of Study <span
                            class="tx-danger">*</span></label> </td>
                <td> <label class="form-control-label">Marking Scheme <span
                            class="tx-danger">*</span></label> </td>
                <td> <label class="form-control-label">Obtained Percentage/CGPA
                        <span class="tx-danger">*</span></label> </td>
                <td> <label class="form-control-label">Year of Passing <span
                            class="tx-danger">*</span></label> </td>
                <td> <label class="form-control-label"> Roll No. / Registration
                        No.
                        <span class="tx-danger">*</span></label> </td>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p>XII</p>
                </td>
                <td>
                    <input class="form-control" type="text" name="SchoolName"
                        placeholder="Enter SchoolName">
                </td>
                <td>
                    <div class="form-group mg-b-10-force">
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option value="">Select</option>
                            <option
                                value="Central Board Of Secondary Education (CBSE)">
                                Central Board Of Secondary Education (CBSE)
                            </option>
                            <option
                                value="Council Of Indian School Certificate Examination (CISCE/ISC)">
                                Council Of Indian School
                                Certificate Examination (CISCE/ISC)</option>
                            <option
                                value="National Institute Of Open Schooling">
                                National Institute Of Open Schooling</option>
                            <option
                                value="Andhra Pradesh Board Of Intermediate Education">
                                Andhra Pradesh Board Of Intermediate Education
                            </option>
                            <option
                                value="Telangana Board Of Intermediate Education">
                                Telangana Board Of Intermediate Education
                            </option>
                            <option value="Bihar School Examination Board">Bihar
                                School Examination Board</option>
                            <option
                                value="West Bengal Council Of Higher Secondary Education">
                                West Bengal Council Of Higher Secondary
                                Education</option>
                            <option
                                value="Maharastra State Board Of Secondary And Higher Secondary Education">
                                Maharastra State Board Of
                                Secondary And Higher Secondary Education
                            </option>
                            <option
                                value="Goa Board Of Secondary And Higher Secondary Education">
                                Goa Board Of Secondary And Higher
                                Secondary Education</option>
                            <option value="Aligarh Muslim University">Aligarh
                                Muslim University</option>
                            <option
                                value="Assam Higher Secondary Education Council">
                                Assam Higher Secondary Education Council
                            </option>
                            <option value="1Banasthali Vidyapith">Banasthali
                                Vidyapith</option>
                            <option
                                value="Bihar Intermediate Education Council">
                                Bihar Intermediate Education Council</option>
                            <option
                                value="2Board of Vocational Higher Secondary Education">
                                Board of Vocational Higher Secondary Education
                            </option>
                            <option value="Cambridge University">Cambridge
                                University</option>
                            <option
                                value="Chhatisgarh Board Of Secondary Education">
                                Chhatisgarh Board Of Secondary Education
                            </option>
                            <option
                                value="Gujarat Secondary And Higher Secondary Education Board">
                                Gujarat Secondary And Higher Secondary
                                Education Board</option>
                            <option value="Haryana Board Of Education">Haryana
                                Board Of Education</option>
                            <option
                                value="Himachal Pradesh Board Of School Education">
                                Himachal Pradesh Board Of School Education
                            </option>
                            <option value="International Baccalaureate">
                                International Baccalaureate</option>
                            <option
                                value="J And K State Board Of School Education">
                                J And K State Board Of School Education</option>
                            <option value="Jharkhand Academic Council">Jharkhand
                                Academic Council</option>
                            <option
                                value="Karnataka Board Of The Pre-University Education">
                                Karnataka Board Of The Pre-University Education
                            </option>
                            <option
                                value="Kerala Board Of Higher Secondary Education">
                                Kerala Board Of Higher Secondary Education
                            </option>
                            <option value="1Kerala Board of Public Examination">
                                Kerala Board of Public Examination</option>
                            <option
                                value="Madhya Pradesh Board Of Secondary Education">
                                Madhya Pradesh Board Of Secondary Education
                            </option>
                            <option
                                value="Manipur Council Of Higher Secondary Education">
                                Manipur Council Of Higher Secondary Education
                            </option>
                            <option value="Meghalaya Board Of School Education">
                                Meghalaya Board Of School Education</option>
                            <option value="Mizoram Board Of School Education">
                                Mizoram Board Of School Education</option>
                            <option value="Nagaland Board Of School Education">
                                Nagaland Board Of School Education</option>
                            <option
                                value="Orissa Council Of Higher Secondary Education Bhubaneswar">
                                Orissa Council Of Higher Secondary
                                Education Bhubaneswar</option>
                            <option value="Punjab School Education Board">Punjab
                                School Education Board</option>
                            <option
                                value="Rajasthan Board Of Secondary Education">
                                Rajasthan Board Of Secondary Education</option>
                            <option
                                value="Tamil Nadu Board Of Higher Secondary Education">
                                Tamil Nadu Board Of Higher Secondary Education
                            </option>
                            <option
                                value="Tripura Board Of Secondary Education">
                                Tripura Board Of Secondary Education</option>
                            <option
                                value="U.P. Board Of High School And Intermediate Education">
                                U.P. Board Of High School And Intermediate
                                Education</option>
                            <option
                                value="Uttaranchal Shiksha Evam Pariksha Parishad">
                                Uttaranchal Shiksha Evam Pariksha Parishad
                            </option>
                            <option
                                value="West Bengal Board Of Madarsa Education">
                                West Bengal Board Of Madarsa Education</option>
                            <option value="Not specified/Any Other">Not
                                specified/Any Other</option>
                            <option value="1Other">Other</option>
                        </select>
                    </div>
                </td>
                <td>
                    <div class="form-group mg-b-10-force">
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option value="">Select</option>
                            <option value="Regular/Formal" selected="selected">
                                Regular/Formal</option>
                            <option value="NIOS">NIOS</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                </td>
                <td>
                    <div class="form-group mg-b-10-force" id="appering_info_1">
                        <select class="form-control custom-select"
                            id="exampleFormControlSelect1">
                            <option value="">Select</option>
                            <option value="Percentage">Percentage</option>
                            <option value="CGPA out of 10">CGPA out of 10
                            </option>
                            <option value="CGPA out of 9">CGPA out of 9</option>
                            <option value="CGPA out of 7" selected="selected">
                                CGPA out of 7</option>
                            <option value="CGPA out of 4">CGPA out of 4</option>
                        </select>
                    </div>
                </td>
                <td>
                    <input class="form-control" type="text" name="SchoolName"
                        placeholder="Enter SchoolName" id="appering_info_2">
                </td>
                <td>
                    <input class="form-control" type="text" name="SchoolName"
                        placeholder="Enter SchoolName" id="appering_info_3">
                </td>
                <td>
                    <input class="form-control" type="text" name="SchoolName"
                        placeholder="Enter SchoolName" id="appering_info_4">
                </td>
            </tr>
        </tbody>
    </table>
    <div class="mt-5 w-100">
        <div class="row">
            <div class="col-lg-6 ">
                <div class="form-group">
                    <label class="form-control-label">Address of School /
                        College <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="lastname"
                        placeholder="Enter School / College">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label">NAD ID / Digilocker ID
                        <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="lastname"
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
                            <input name="rdio" type="radio" id="online">
                            <span>Online</span>
                        </label>
                    </div>
                    <div class="col-lg-3">
                        <label class="rdiobox">
                            <input name="rdio" type="radio" id="dd">
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
                <div id="payment_details">

                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" type="text"
                                    name="BankName" placeholder="Bank Name"
                                    id="">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="text"
                                    name="BranchName" placeholder="Branch Name"
                                    id="">
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <input class="form-control" type="text"
                                    name="DDNumber" placeholder="DD Number"
                                    id="">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" type="text"
                                    name="DDDate" placeholder="DD Date" id="">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12 customIcon">
                            <div class="flexbox flex-start"><i
                                    style="margin:4px 5px 0 0"
                                    class="icon-info npf-icon"
                                    aria-hidden="true"></i>You must send your
                                DD&nbsp;in favor of "SRMIST" Payable at Chennai.
                                along with
                                your Application Form with complete details
                                (Full Name, Application Number, Mobile) to
                                &nbsp;the
                                below-mentioned address:<br><br>The Director
                                (Admissions)<br>SRM Institute of Science and
                                technology<br>SRM
                                Nagar,<br>Kattankulathur-603 203<br>Chengalpattu
                                District<br>Tamil Nadu, India </div>
                        </div>
                    </div>
                </div>
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