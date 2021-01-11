<div class="container" style="padding-top: 10px;">
    <div class="row mb-4">
        <div class="col-sm-3">
            <span>
                <select class="form-control" id="filter-field">
                    <option selected disabled> Select Name</option>
					<option value="appln_form_id">Form ID</option>
                    <option value="applicant_name_declaration">Applicant Name</option>
                    <option value="applicant_appln_id">Applicant ID</option>
                    <option value="applicant_personal_det_id">Applicant Personal Detail ID</option>
                </select>
            </span>
        </div>
        <div class="col-sm-3">
            <span>
                <select class="form-control" id="filter-type">
                    <option selected disabled> Select Type</option>
                    <option value="like">like</option>
					<option value="=">=</option>
                </select>
            </span>
        </div>
        <div class="col-sm-3">
            <span><input type="text" class="form-control" id="filter-value" type="text" placeholder="Search Value" /></span>
        </div>		
        <div class="col-sm-3">
            <button class="btn btn-primary" id="print-table"><i class="fas fa-print"></i> Print Table</button>
			<button class="btn btn-primary" id="filter-clear"><i class="fas fa-times-circle"></i> Clear Filter</button>
        </div>		
    </div>
	<div class="row mb-4">
		<div class="col-sm-3">
			<button class="btn btn-primary" id="ad-filters"><i class="fas fa-filter"></i> Advanced Filters</button>
		</div>		
	</div>
	<div class="row mb-4" id="ad-filters-multiple" style="display:none;">
        <div class="col-sm-3">
			<label><h5><span class="badge badge-primary">Search By : </span></h5></label><br>
            <span>
                <select class="form-control" id="filter-column">
                    <option selected disabled> Select </option>
                    <option value="appln_form_id" selected>Form Name</option>
					<option value="payment_mode_id">Payment Mode</option>
					<option value="created_at">Date</option>
					<option value="application_status_id">Application Status</option>
					<option value="all">Form / Payment / Status</option>
                </select>
            </span>
        </div>
        <div class="col-sm-3" id="form_select" style="display:none;">
			<label><h5><span class="badge badge-primary">Form Name : </span></h5></label>
            <span>
                <select id="filter-form" multiple="multiple" style="display:none;">
					<?php foreach($form_list as $key => $form_lists){ ?>
						<option value="<?php echo $key; ?>">
							<?php echo strtoupper($form_lists); ?>
						</option> 
					<?php } ?>
                </select>
            </span>
        </div>	
        <div class="col-sm-3" id="payment_mode_select" style="display:none;">
			<label><h5><span class="badge badge-primary">Payment Mode : </span></h5></label>
            <span>
                <select id="filter-payment-mode" multiple="multiple" style="display:none;">
					<option value="<?php echo DD; ?>">DD</option>
					<option value="<?php echo ONLINE; ?>">ONLINE</option>	
					<option value="<?php echo CHEQUE; ?>">CHEQUE</option>
					<option value="<?php echo CASH; ?>">CASH</option>
                </select>
            </span>
        </div>
        <div class="col-sm-3" id="filter_applicant_status" style="display:none;">
			<label><h5><span class="badge badge-primary">Applicant Status : </span></h5></label>
            <span>
                <select id="filter-applicant-status" multiple="multiple" style="display:none;">
					<option value="<?php echo APPLICATION_IN_PROGRESS; ?>">Inprogress</option>
					<option value="<?php echo APPLICATION_IN_COMPLETED; ?>">Completed</option>	
                </select>
            </span>
        </div>		
		<div class="col-sm-4" id="search_date" style="display:none;">
			<label ><h5><span class="badge badge-primary">Search By Date : </span></h5></label>
			<input id="filter-dates" type="text" name="dates" value="" class="form-control" />
		</div>		
	 </div>	<hr/>

	<div class="col-sm-3 alert alert-primary float-right text-center font-weight-bold" id="example-table-info"></div> 
    <div id="example-table" style="width: 100%;" class="tabulator-print-table"></div>
</div>
