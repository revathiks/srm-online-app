<?php
	$end_date = strtotime("1 day", strtotime(date('Y/m/d')));
	$end_date = date("Y/m/d", $end_date);
?>			
<script>
	$(document).ready(function () {
		
		/** Update filters on value change by form id , name , applicant personal id , applicant id **/
		$("#filter-field, #filter-type").change(updateFilter);
		$("#filter-value").keyup(updateFilter);
		
		/** Update filters on value change by form & payment-mode **/
		$("#filter-column,#filter-form,#filter-payment-mode,#filter-dates,#filter-applicant-status").change(filterByFormPayment);	
		
		var payment_mode = function (row) {							
			var payment_mode_id = row.getData()["payment_type"];
			if(payment_mode_id==<?php echo DD; ?>)return ("DD");
			if(payment_mode_id==<?php echo ONLINE; ?>)return ("ONLINE");
			if(payment_mode_id==<?php echo CASH; ?>)return ("CASH");
			if(payment_mode_id==null)return ("<i class='fas fa-times-circle' style='color:#e82244;' title='Yet to update'></i>");
			if(payment_mode_id==<?php echo CHEQUE; ?>)return ("CHEQUE");
		};	
		
		var payment_created_at = function (row) {
			var created_at = row.getData()["created_at"];
			if(created_at==null)return ("<i class='fas fa-times-circle' style='color:#e82244;' title='Yet to update'></i>");
			return ("<span>"+created_at+"</span>");
		}
		
		var name = function (row) {
			var name = row.getData()["applicant_name_declaration"];
			if(name==null)return ("<i class='fas fa-times-circle' style='color:#e82244;' title='Yet to update'></i>");
			return ("<span>"+name+"</span>");			
		}	
		
		var progressdiv = '<div class="progress"><div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div></div>'

		var progress = function (row) {
			var completion_percent = row.getData()["completion_percent"];
			if(completion_percent==null)return ("<i class='fas fa-times-circle' style='color:#e82244;' title='Yet to update'></i>");
			return ("<span><div class='progress'><div class='progress-bar progress-bar-striped' role='progressbar' style='width:"+completion_percent+"%'; title='"+completion_percent+"%'>"+completion_percent+"%<div></div></span>");			
		}			
		
		
		/** Column as JSON **/
		var columns = [{ title: "Form Name", field: "appln_form_name"},{ title: "Applicant Name", field: "first_name"},{ title: "Transcation No", field: "trans_no"}];
		
		var table = common_tabultor("example-table","fitColumns","<h1>Applicant Detail<h1>","<span>All Rights Reserved SRM University &copy; <?php echo date('Y'); ?></span>",true,'remote',"<?php echo base_url(); ?>/crm-admin/grid_payment_history",'pageNo',"No Data Found",columns);
		
		
		var view_form = function (row) {							
			var applicant_personal_det_id = row.getData()["applicant_personal_det_id"];
			var applicant_login_id = row.getData()["applicant_login_id"];
			var form_url = row.getData()["form_url"];
			var total = row.getData()["total_data"];
			var application_status_id = row.getData()["status"];
			$('#example-table-info').text("Total Count : "+total);
			if(application_status_id==<?php echo APPLICATION_IN_PROGRESS; ?>)	
			return (
				"<a href='<?php echo base_url(); ?>" +form_url +"/edit/"+applicant_login_id+"/"+applicant_personal_det_id+"' class='btn btn-danger waves-effect waves-light' target='_blank'><i class='fa fa-times-circle'></i> Inprogress</a>"
			);
			if(application_status_id==null)	
			return (
				"<a href='<?php echo base_url(); ?>" +form_url +"/edit/"+applicant_login_id+"/"+applicant_personal_det_id+"' class='btn btn-danger waves-effect waves-light' target='_blank'><i class='fa fa-times-circle'></i> Inprogress</a>"
			);			
			return (
				"<a href='<?php echo base_url(); ?>" +form_url +"/edit/"+applicant_login_id+"/"+applicant_personal_det_id+"' class='btn btn-success waves-effect waves-light' target='_blank'><i class='fa fa-check-circle'></i> Completed</a>"
			);	
		};
		table.addColumn({ title: "View Applicant", field: "form_view", formatter: view_form }, false, "form_view");

		document.getElementById("print-table").addEventListener("click", function () {
			table.print(false, true);
		});
		
		/** Multiselect **/
		$('#filter-form').multiselect({placeholder: 'Select Form',search: true,placeholder: 'Select Forms',includeSelectAllOption:true});		
		$("#filter-payment-mode").multiselect();
		$("#filter-applicant-status").multiselect();
		
		/** Select2 Embed **/
		$("#filter-column").select2({allowClear: true,placeholder :'Select'});
		$("#filter-field").select2({allowClear: true,placeholder :'Select'});		
		$("#filter-type").select2({allowClear: true,placeholder :'Select'});
		

		/** Filter By Form ID & Name & Applicant ID & Personal Detail ID **/
		function updateFilter() {
			var filter = $("#filter-field").val() == "function" ? customFilter : $("#filter-field").val();
			table.setFilter(filter, $("#filter-type").val(), $("#filter-value").val());
		}		
				
		/** Filter By Form & Payment Mode **/
		function filterByFormPayment(){
			var filter = $("#filter-column").val() == "function" ? customFilter : $("#filter-column").val();
			console.log('ffas'+filter);
			if(filter=="payment_mode_id"){
				var filter_payment_mode = $("#filter-payment-mode").val();					
				$("#form_select").hide();
				$("#search_date").hide();
				$("#payment_mode_select").show();
				$("#filter_applicant_status").hide();
				table.setFilter(filter, '=', filter_payment_mode);
			}else if(filter=="created_at"){
				$("#form_select").hide();
				$("#payment_mode_select").hide();
				$("#search_date").show();			
				$("#filter_applicant_status").hide();	
				table.setFilter('created_at', '=', $("#filter-dates").val());
			}
			else if(filter=="application_status_id"){
				$("#form_select,#payment_mode_select,#search_date").hide();
				$("#filter_applicant_status").show();
				table.setFilter('application_status_id', '=', $("#filter-applicant-status").val());
			}			
			else if(filter=="all"){
				$("#form_select").show();
				$("#payment_mode_select").show();
				$("#filter_applicant_status").show();
				$("#search_date").hide();		
				table.setFilter([
					{field:"appln_form_id", type:"=", value: $("#filter-form").val()}, 
					{field:"payment_mode_id", type:"=", value: $("#filter-payment-mode").val()},
					{field:"application_status_id", type:"=", value: $("#filter-applicant-status").val()},
				]);				
			}			
			else{
				$("#form_select").show();
				$("#search_date").hide();	
				$("#payment_mode_select").hide();	
				table.setFilter(filter, '=', $("#filter-form").val());		
			}
		}	

		$("#filter-clear").click(function(){
			$("span.select2-selection__clear").trigger("click");
			$("#filter-value").val("");
		});				
		
		$('input[name="dates"]').val('<?php echo date('Y/01/01'); ?> - <?php echo $end_date; ?>')
		$('input[name="dates"]').daterangepicker({locale: {format: 'YYYY/MM/DD'}});
		
		// Fade In Advanced Filters
		$("#ad-filters").click(function(){
			$("#ad-filters-multiple").toggle('slow');
			$("#ad-filters-multiple").toggleClass("ad-filters-multiple");
		});	
	});
</script>