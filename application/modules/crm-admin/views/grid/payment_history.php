<div class="container" style="padding-top: 10px;">
    <div class="row mb-4">
        <div class="col-sm-3">
            <span>
                <select class="form-control" id="filter-field">
                    <option selected disabled> Select Name</option>
                    <option value="applicant_name_declaration">Applicant Name</option>
                    <option value="applicant_appln_id">Applicant ID</option>
                    <option value="applicant_personal_det_id">Applicant Personal Detail ID</option>
                    <option value="trans_no">Transcation No</option>
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

	<hr/>

	<div class="col-sm-3 alert alert-primary float-right text-center font-weight-bold" id="example-table-info"></div> 
    <div id="example-table" style="width: 100%;" class="tabulator-print-table"></div>
</div>
