<?php
	$end_date = strtotime("1 day", strtotime(date('Y/m/d')));
	$end_date = date("Y/m/d", $end_date);
?>			
<script>
	$(document).ready(function () {
		var customFilter={};
		$("#filter-ticketid").keyup(updateFilter);
		var status_label = function (row) {	
			var status = row.getData()["status_id"];
			if(status==<?php echo TICKETS_OPEN_STATUS; ?>)return ("Open");
			if(status==<?php echo TICKETS_CLOSED_STATUS; ?>)return ("Closed");
			if(status==<?php echo TICKETS_INPROGRESS_STATUS; ; ?>)return ("In Progress");
		};
		/** Column as JSON **/
		var columns = [
					{ title: "Ticket ID", field: "ticket_id"},
				  	{ title: "Name", field: "applicant_name"},
					{ title: "Email ID", field: "email_id"},
					{ title: "Mobile", field: "mobile_no"},
					{ title: "Category", field: "sub_category_name" },
					{ title: "Query Date", field: "created_at" },
					{ title: "Last Updated Date", field: "updated_at" },
					{ title: "Status", field: "status_id",formatter:status_label},
					{ title: "Form Name", field: "appln_form_name"}
				];
		
			
		//Build Tabulator
		var table = new Tabulator("#example-table", {
			downloadDataFormatter: function (data) {
			    if(typeof allData !== 'undefined'){
				  if (allData!=null) {
				        data = allData;
				        allData = null;
				    }
				   data.data.forEach(function(row){
					   checkid=row.status_id;
					   var statuslabel;
					   switch(checkid){
					   case '<?php echo TICKETS_OPEN_STATUS; ?>':
						   statuslabel='Open';
					       break; 
					   case '<?php echo TICKETS_CLOSED_STATUS; ?>':
					      statuslabel='Closed';
				          break;
				       default:
				    	   statuslabel='In Progress';
					   }
					   row.status_id=statuslabel;
					   //set updated at label
					   if(row.updated_at==null || row.updated_at=='null'){
						   row.updated_at='';
						   }
					});

				    
			    }
			  return data;
			},
			layout: "fitColumns",
			printHeader: "<h1>Manage Students Query<h1>",
			printFooter: "<span>All Rights Reserved SRM University &copy; <?php echo date('Y'); ?></span>",
			printAsHtml: true,
			printStyled: true,
			ajaxFiltering: true,
			paginationSize: 10,
			pagination: "remote",
			ajaxURL: "<?php echo base_url(); ?>/crm-admin/tickets", //set url for ajax request
			paginationDataSent: {
				page: "pageNo", //change page request parameter to "pageNo"
			},
			placeholder: "No Data Set",
			columns: columns,
			rowFormatter: function (row) {
				
			},
		});

		var view_link = function (row) {
			var ticket_id = row.getData()["ticket_id"];							
			var applicant_personal_det_id = row.getData()["applicant_personal_det_id"];
			var applicant_login_id = row.getData()["applicant_login_id"];
			var link_url = '<?php echo base_url(); ?>crm-admin/ticket_details/'+ticket_id+'/'+applicant_personal_det_id+'/'+applicant_login_id;
			
			var application_status_id = row.getData()["status"];
			
			return (
				//"<a href='<?php echo base_url(); ?>"+link_url+" class='btn btn-danger waves-effect waves-light' target='_blank'><i class='fa fa-eye'></i> View</a>"
					"<a href='"+link_url+"' class='btn btn-success waves-effect waves-light'><i class='fa fa-eye'></i></a>"
			);
			
		};
		table.addColumn({ title: "View", field: "link_view", formatter: view_link }, false, "form_view");
		
		/* document.getElementById("print-table").addEventListener("click", function () {
			table.print(false, true);
		}); */
		
		/** Filter By Form ID & Name & Applicant ID & Personal Detail ID **/
		function updateFilter() {
			
			customFilter['filters']=[
				{field:"ticket_id", type:"=", value: $("#filter-ticketid").val()}
			];
			table.setFilter([
				{field:"type", type:"=", value: 'basic'},
				{field:'ticket_id', type:'=', value:$("#filter-ticketid").val()}
				]);
			
		}	

			

		//advanced filter script
		
		// Fade In Advanced Filters
		$("#ad-filters").click(function(){
			$("#adv-filters-multiple").toggle('slow');
			$("#adv-filters-multiple").toggleClass("adv-filters-multiple");
		});

		/** Multiselect **/
		$('#college').multiselect({placeholder: 'College',search: true,includeSelectAllOption:true});		
		$('#formid').multiselect({placeholder: 'Form Name',search: true,includeSelectAllOption:true});		
		$('#assignto').multiselect({placeholder: 'Assinged To',search: true,includeSelectAllOption:true});
		$('#catid').multiselect({placeholder: 'Category',search: true,includeSelectAllOption:true});
		$('#status').multiselect({placeholder: 'Status',search: true,includeSelectAllOption:true});		
		
		/** Update filters on value change by form & payment-mode **/
		$("#formid,#catid,#status,#created_at,#email_id,#mobile_no").change(filterByAdvanced);	

		function filterByAdvanced(){
			$("#filter-ticketid").val("");
			$('#filter-ticketid').keyup();

			customFilter['filters']=[
				{field:"type", type:"=", value: 'advanced'},
				{field:"appln_form_id", type:"=", value: $("#formid").val()},
				{field:"cat_w_sub_cat_id", type:"=", value: $("#catid").val()}, 
				{field:"status_id", type:"=", value: $("#status").val()},
				{field:"created_at", type:"=", value: $("#created_at").val()},
				{field:"email_id", type:"=", value: $("#email_id").val()},
				{field:"mobile_no", type:"=", value: $("#mobile_no").val()},
			];
			
			table.setFilter([
				{field:"type", type:"=", value: 'advanced'},
				{field:"appln_form_id", type:"=", value: $("#formid").val()},
				{field:"cat_w_sub_cat_id", type:"=", value: $("#catid").val()}, 
				{field:"status_id", type:"=", value: $("#status").val()},
				{field:"created_at", type:"=", value: $("#created_at").val()},
				{field:"email_id", type:"=", value: $("#email_id").val()},
				{field:"mobile_no", type:"=", value: $("#mobile_no").val()},
			]);
		}

		//set datepicker
		//$('input[name="dates"]').val('<?php echo date('Y/01/01'); ?> - <?php echo $end_date; ?>')
		$('input[name="created_at"]').daterangepicker({
					locale: {format: 'DD/MM/YYYY'},
					autoUpdateInput: false,
					singleDatePicker: true,
					showDropdowns: false,
					defaultDate: '',
					maxYear: parseInt(moment().format('YYYY'),10)
				});
		$('input[name="created_at"]').on('apply.daterangepicker', function(ev, picker) {
		      $(this).val(picker.startDate.format('DD/MM/YYYY') );
		      filterByAdvanced();
		  });

		  $('input[name="created_at"]').on('cancel.daterangepicker', function(ev, picker) {
		      //$(this).val('');
		      filterByAdvanced();
		  });
		//Clear filters on "Clear Filters" button click
		$("#filter_clear").click(function () {
			/* $('option', $('#formid')).each(function(element) {
			    $(this).removeAttr('selected').prop('selected', false);
			  });
			$("#formid").multiselect('refresh'); */
			$('#formid').val([]).multiselect('refresh');
			$('#catid').val([]).multiselect('refresh');
			$('#college').val([]).multiselect('refresh');
			$('#assignto').val([]).multiselect('refresh');
			$('#status').val([]).multiselect('refresh');			
			$("#email_id").val("");
			$("#mobile_no").val("");
			$("#created_at").val("");
			table.clearFilter();
		});
		
		/* $("#filter_clear").click(function(){
			$("span.select2-selection__clear").trigger("click");
			$("#filter-value").val("");
		}); */
		
		//end advanced filter script
		
					
		//script for download csv,pdf,xls
		// download of data.csv file
		$("#download-csv").click(function(e){
			e.stopPropagation();
	        e.preventDefault();
	        var type = '=';
			var searchval=$("#filter-ticketid").val();
			var filterUrl= decodeURIComponent( $.param( customFilter ) );		
            var filterData='is_download=1&'+filterUrl;
	        $.ajax({
	        	type: 'GET',
	            url: '<?php echo base_url(); ?>/crm-admin/tickets',
	            data:filterData,
		        dataType: 'json',
				cache: false,
				async: false,
	        }).done(function (data) {
	            // store the whole data into a global variable
	              allData = data;
	              table.download("csv", "queries.csv");
		        });		
		   // table.download("csv", "data.csv",{}, "active");
		});
		//trigger download of data.xlsx file
		$("#download-xlsx").click(function(e){	
			e.stopPropagation();
			e.preventDefault();		
			var type = '=';
			var searchval=$("#filter-ticketid").val();
			var filterUrl= decodeURIComponent( $.param( customFilter ) );		
            var filterData='is_download=1&'+filterUrl;
	        $.ajax({
	        	type: 'GET',
	            url: '<?php echo base_url(); ?>/crm-admin/tickets',
	            data:filterData,
		        dataType: 'json',
				cache: false,
				async: false,
	        }).done(function (data) {
	        	var calcs ={};
	        	calcs['calcs']={top:{},bottom:{}};	        	
	            // store the whole data into a global variable	             
	              allData=Object.assign(data,calcs);	             
	              table.download("xlsx", "data.xlsx",{allData});
		        });		
		  
		});
		//trigger download of data.pdf file
		$("#download-pdf").click(function(e){
			e.stopPropagation();
	        e.preventDefault();
	        var type = '=';
			var searchval=$("#filter-ticketid").val();
			var filterUrl= decodeURIComponent( $.param( customFilter ) );		
            var filterData='is_download=1&'+filterUrl;
	        $.ajax({
	        	type: 'GET',
	            url: '<?php echo base_url(); ?>/crm-admin/tickets',
	            data:filterData,
		        dataType: 'json',
				cache: false,
				async: false,
	        }).done(function (data) {
	            // store the whole data into a global variable
	             var calcs ={};
	        	calcs['calcs']={top:{},bottom:{}};	        	
	            // store the whole data into a global variable	             
	              allData=Object.assign(data,calcs);
	              table.download("pdf", "Queries.pdf", {
	  		        orientation:"portrait", //set page orientation to portrait
	  		        title:"Manage Student Queries", //add title to report
	  		    });
		        });		
		    
		});
		//end download file script
	});
</script>