 <!--[ container ] -->
  <div class="container">
  	<div class="page-header">
        <h1>Add</h1>
      </div>
			<?php
				$attributes = array('class' => 'admissionForm', 'id' => 'admissionForm');
				echo form_open('admission/', $attributes);
			?>
			<div class="row">
				<div class="form-group col-md-4">
					<label for="inputState">Applicant Name</label>
					<select id="applicant_id" name="applicant_id" class="form-control">
					</select>
				</div>				
				<div class="form-group col-md-4">
					<label for="inputState">Stream</label>
					<select id="stream_id" name="stream_id" class="form-control">
					</select>
				</div>
				<div class="form-group col-md-4">
					<label for="inputState">Program / Degree</label>
					<select id="program" name="program" class="form-control">
					<option selected>Choose...</option>
					<option>...</option>
					</select>
				</div>
			</div>
			<div class="input-group-btn">
							<input class="btn btn-sm btn-default" type="hidden" name="applicant_name" 
							id="applicant_name" value="">
							<input class="btn btn-sm btn-default" type="hidden" name="stream_name" 
							id="stream_name" value="">
						</div>

			<div class="row">
				<div class="col-sm-12">
				<input type="submit" class="btn btn-primary" value="Save">
				</div>
			</div>
		 <?php form_close();?>
  </div>

  <script type="text/javascript">
  	var applicant_id = $("#applicant_id").val();
  	var applicant_name = $("#applicant_name").val(); /*hidden value in JS*/

  	var stream_id = $("#stream_id").val();
  	var stream_id = $("#stream_name").val();

  	/*Page Load Set data*/
  	document.addEventListener("DOMContentLoaded", function(event) {
  		getSelect2('applicant_id','<?php echo base_url("admission/applicant_name"); ?>','Select Applicant', formatRepoAplicant, formatRepoAplicantSelection ,'static');
				setTimeout(function() { 
				select2Set('applicant_id',applicant_id, applicant_name);
				}, 1);

		getSelect2('stream_id','<?php echo base_url("admission/stream_list"); ?>','Select Stream', formatRepoStream, formatRepoStreamSelection);
				setTimeout(function() { 
				select2Set('stream_id',stream_id, stream_name);
				}, 1);
			
  	});

  	/*Onchange Set data*/
  	$('#applicant_id').on('change',function(){ 
		var data = $('#applicant_id').select2('data');
		$('#applicant_name').val(data[0].name);
	});

	$('#stream_id').on('change',function(){ 
		var data = $('#stream_id').select2('data');
		$('#stream_name').val(data[0].appln_form_name);
	});
  </script>