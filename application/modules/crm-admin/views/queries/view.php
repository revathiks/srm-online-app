<?php 
//echo $open_ticket;
?>
<div class="container queries">
    <div class="row mb-2">       
        <div class="col-sm-4">
            <span><input type="text" class="form-control" id="filter-ticketid" type="text" placeholder="Search by Ticket ID" /></span>
        </div>
    </div>
    
    <div class="row mb-4">
		<div class="col-sm-3">
			<button class="btn btn-primary" id="ad-filters"><i class="fas fa-filter"></i> Advanced Filters</button>
		</div>		
	</div>
	<div id="adv-filters-multiple" style="display:none;">
	<div class="row mb-4" >
        <div class="col-sm-3">
        <label ><h5><span class="badge badge-primary">College: </span></h5></label>
                <select class="form-control" id="college" multiple="multiple"  style="display:none;">
                    <option selected> SRM Group of Institutions </option>
                </select>
        </div>
        <div class="col-sm-3">
        <label ><h5><span class="badge badge-primary">Form Name : </span></h5></label>
                <select class="form-control" id="formid" multiple="multiple"  style="display:none;">
               
					<?php foreach($form_list as $key => $form){ ?>
						<option value="<?php echo $form['id']; ?>">
							<?php echo  $form['name'];?>
						</option> 
					<?php } ?>
                </select>
        </div>
        <div class="col-sm-3">
        <label ><h5><span class="badge badge-primary">Assigned To : </span></h5></label>
                <select class="form-control" id="assignto" multiple="multiple"  style="display:none;">
                    <option> Test Counseller </option>
                </select>
        </div>	        
        <div class="col-sm-3">
        <label ><h5><span class="badge badge-primary">Category: </span></h5></label>
                <select class="form-control" id="catid" multiple="multiple"  style="display:none;">
                 
				<?php foreach($category_list as $key => $category){ ?>
					<option value="<?php echo $category['cat_w_sub_cat_id']; ?>">
						<?php echo  $category['sub_category_name'];?>
					</option> 
				<?php } ?>
                </select>
        </div>
        <div class="col-sm-3 mt-4" id="form_select" >
        <label ><h5><span class="badge badge-primary">Status : </span></h5></label>
                <select id="status" multiple="multiple"  style="display:none;">
				<option value="<?php echo TICKETS_OPEN_STATUS; ?>">Open</option> 
				<option value="<?php echo TICKETS_INPROGRESS_STATUS; ?>">In Progress</option>
				<option value="<?php echo TICKETS_CLOSED_STATUS; ?>">Closed</option>
                </select>
        </div>
        
        <div class="col-sm-3 mt-4" id="search_date">
			<label ><h5><span class="badge badge-primary">Search By Date : </span></h5></label>
			<input id="created_at" type="text" name="created_at" value="" class="form-control" />
		</div>
		
		
		 <div class="col-sm-3 mt-4" id="email">
			<input id="email_id" type="text" name="email_id" value="" class="form-control" placeholder="Email"/>
		 </div>
		 
		 <div class="col-sm-3 mt-4" id="mobile">
			<input id="mobile_no" type="text" name="mobile_no" value="" class="form-control" placeholder="Mobile Number"/>
		 </div>
	 </div>	<!-- row -->
	 <div class="row mb-2">
    	 <!-- <div class=" col-sm-2 mb-2">
            <button class="btn btn-primary" id="filter_search">SEARCH</button>
         </div> -->
    	 <div class=" col-sm-2 mb-2">
            <button class="btn btn-primary" id="filter_clear">RESET</button>
         </div>
	 </div><!-- end row -->
	 </div>
	 
	 
    <div class="row mb-2">    
    	<div class="col-sm-12">
            <div class="table-controls">
                  <button id="download-csv" class="btn btn-primary">Download CSV</button>
                  <button id="download-xlsx" class="btn btn-primary">Download XLSX</button>
                  <button id="download-pdf" class="btn btn-primary">Download PDF</button>
                </div>
            </div>
     </div>
    <div id="example-table" style="width: 100%;" class="tabulator-print-table"></div>
   
</div>
<div class="row ticketcounts">
                            <div class="col-md-4 mt-4 ">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="info-card">
                                            <h4 class="info-title">Total: <span class="info-stats"><?php echo $total_ticket;?></span></h4>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="card  ">
                                    <div class="card-body">
                                        <div class="info-card">
                                            <h4 class="info-title">Open: <span class="info-stats"><?php echo $open_ticket?></span></h4>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="info-card">
                                            <h4 class="info-title">In Progress: <span class="info-stats"><?php echo $inprogress_ticket?></span></h4>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="info-card">
                                            <h4 class="info-title">Closed: <span class="info-stats"><?php echo $closed_ticket ?></span></h4>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="info-card">
                                            <h4 class="info-title">Feedback Not Given: <span class="info-stats">NA</span></h4>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="info-card">
                                            <h4 class="info-title">Feedback Satisfied: <span class="info-stats">NA</span></h4>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="info-card">
                                            <h4 class="info-title">Feedback Unsatisfied: <span class="info-stats">NA</span></h4>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>