<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<?php
	$end_date = strtotime("1 day", strtotime(date('Y/m/d')));
	$end_date = date("Y/m/d", $end_date);
?>			
<script>
	$(document).ready(function () {
		var customFilter={};
		/** Update filters on value change by form id , name , applicant personal id , applicant id **/
		$("#filter-field, #filter-type").change(updateFilter);
		$("#filter-value").keyup(updateFilter);
		
		/** Update filters on value change by form & payment-mode **/
		$("#filter-column,#filter-form,#filter-payment-mode,#filter-dates").change(filterByFormPayment);
		
		/** Column as JSON **/
		var columns = [{ title: "Form Name", field: "appln_form_name" },{ title: "Applicant Name", field: "applicant_name_declaration" },{ title: "Payment Mode", field: "form_payment_mode" },{ title: "Applicant Status", field: "application_status_id" },{ title: "Payment Start Date", field: "created_at" }];
		
		//var table = common_tabultor("example-table","fitColumns","<h1>Applicant Detail<h1>","<span>All Rights Reserved SRM University &copy; <?php echo date('Y'); ?></span>",true,'remote',"<?php echo base_url(); ?>/crm-admin/user_applicant",'pageNo',"No Data Found",columns);
		//Build Tabulator
		var table = new Tabulator("#example-table", {
			downloadDataFormatter: function (data) {				
			    if(typeof allData !== 'undefined'){
				  if (allData!=null) {
				        data = allData;
				        allData = null;
				    }
				   data.data.forEach(function(row){
					    row.payment_mode_id = row.payment_mode_id == 52 ? "DD" : "Online";
					});
				    
			    }
			  return data;
			},
			layout: "fitColumns",
			printHeader: "<h1>Aactive pplicant Detail<h1>",
			printFooter: "<span>All Rights Reserved SRM University &copy; <?php echo date('Y'); ?></span>",
			printAsHtml: true,
			printStyled: true,
			ajaxFiltering: true,
			paginationSize: 10,
			pagination: "remote",
			ajaxURL: "<?php echo base_url(); ?>/crm-admin/user_applicant", //set url for ajax request
			paginationDataSent: {
				page: "pageNo", //change page request parameter to "pageNo"
			},
			placeholder: "No Data Set",
			columns: columns,
			rowFormatter: function (row) {
				// console.log(row.getData()["payment_mode_id"]);
				if (row.getData()["payment_mode_id"] == "<?php echo PAYMENT_MODE_DEMAND_DRAFT_ID; ?>") {
					$(".tabulator-cell:nth-child(3)").text("DD");
				}
				if (row.getData()["application_status_id"] == "<?php echo APPLICATION_IN_COMPLETED; ?>") {
					$(".tabulator-cell:nth-child(4)").text("Completed");
				}
			},
		});
		var view_form = function (row) {							
			var applicant_personal_det_id = row.getData()["applicant_personal_det_id"];
			var applicant_login_id = row.getData()["applicant_login_id"];
			var form_url = row.getData()["form_url"];
			var total = row.getData()["total_data"];
			//alert(total);
			$('#example-table-info').text("Total Count : "+total);
			
			return (
				"<a href='<?php echo base_url(); ?>" +form_url +"/edit/"+applicant_login_id+"/"+applicant_personal_det_id+"' class='btn btn-primary' target='_blank'><i class='fa fa-eye'></i> View </a>"
			);
		};
		table.addColumn({ title: "Check", field: "form_view", formatter: view_form }, false, "form_view");

		document.getElementById("print-table").addEventListener("click", function () {
			table.print(false, true);
		});
		
		/** Multiselect **/
		$('#filter-form').multiselect({placeholder: 'Select Form',search: true,placeholder: 'Select Forms',includeSelectAllOption:true});		
		$("#filter-payment-mode").multiselect();
		
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
			customFilter={};			
			var filter = $("#filter-column").val() == "function" ? customFilter : $("#filter-column").val();
			if(filter=="payment_mode_id"){
				var filter_payment_mode = $("#filter-payment-mode").val();					
				$("#form_select").hide();
				$("#search_date").hide();
				$("#payment_mode_select").show();
				table.setFilter(filter, '=', filter_payment_mode);
				customFilter['filters']=[
					{field:"payment_mode_id", type:"=", value: $("#filter-payment-mode").val()}
				];
			}else if(filter=="created_at"){
				$("#form_select").hide();
				$("#payment_mode_select").hide();
				$("#search_date").show();				
				table.setFilter('created_at', '=', $("#filter-dates").val());
				customFilter['filters']=[
					{field:"created_at", type:"=", value: $("#filter-dates").val()}
				];
				}
			else if(filter=="all"){
				$("#form_select").show();
				$("#payment_mode_select").show();
				$("#search_date").hide();		
				table.setFilter([
					{field:"appln_form_id", type:"=", value: $("#filter-form").val()}, 
					{field:"payment_mode_id", type:"=", value: $("#filter-payment-mode").val()},
				]);	
				customFilter['filters']=[
					{field:"appln_form_id", type:"=", value: $("#filter-form").val()}, 
					{field:"payment_mode_id", type:"=", value: $("#filter-payment-mode").val()},
				];		
			}			
			else{
				$("#form_select").show();
				$("#search_date").hide();	
				$("#payment_mode_select").hide();	
				table.setFilter(filter, '=', $("#filter-form").val());		
				customFilter['filters']=[
					{field:"appln_form_id", type:"=", value: $("#filter-form").val()}
				];
				}
		}	

		$("#filter-clear").click(function(){
			$("span.select2-selection__clear").trigger("click");
			$("#filter-value").val("");
			//table.clearFilter();
		});				
		
		$('input[name="dates"]').val('<?php echo date('Y/01/01'); ?> - <?php echo $end_date; ?>')
		$('input[name="dates"]').daterangepicker({locale: {format: 'YYYY/MM/DD'}});
		
		// Fade In Advanced Filters
		$("#ad-filters").click(function(){
			$("#ad-filters-multiple").toggle('slow');
			$("#ad-filters-multiple").toggleClass("ad-filters-multiple");
		});	

		//trigger download of data.csv file
		$("#download-csv").click(function(e){
			e.stopPropagation();
	        e.preventDefault();
	        var field=($("#filter-field").val());
	        var type = $("#filter-type").val();
			var searchval=$("#filter-value").val();			
			//var filterData='is_download=1&filters[0][field]='+field+'&filters[0][type]='+type+'&filters[0][value]='+searchval;
	       
			var filterUrl= decodeURIComponent( $.param( customFilter ) );		
            var filterData='is_download=1&'+filterUrl;
	        $.ajax({
	        	type: 'GET',
	            url: '<?php echo base_url(); ?>/crm-admin/user_applicant',
	            data:filterData,
		        dataType: 'json',
				cache: false,
				async: false,
	        }).done(function (data) {
	            // store the whole data into a global variable
	              allData = data;
	              table.download("csv", "data.csv");
		        });		
		   // table.download("csv", "data.csv",{}, "active");
		});
		//trigger download of data.xlsx file
		$("#download-xlsx").click(function(e){	
			e.stopPropagation();
			e.preventDefault();		
	        var field=($("#filter-field").val());
	        var type = $("#filter-type").val();
			var searchval=$("#filter-value").val();
			//advanced filter
			
			var columnval=$("#filter-column").val();
			var formval=$("#filter-form").val();			
			var paymentval=$("#filter-payment-mode").val();
			var datesval=$("#filter-dates").val();

			/* console.log('coloumn'+columnval);
			console.log('formval'+formval);
			console.log('paymentval'+paymentval);
			console.log('datesval'+datesval);
			console.log(customFilter);*/

			//var recursiveEncoded = $.param( customFilter );
			var filterUrl= decodeURIComponent( $.param( customFilter ) );
			
			//console.log( recursiveEncoded );
			 console.log( filterUrl );
			//var filterData='is_download=1&filters[0][field]='+field+'&filters[0][type]='+type+'&filters[0][value]='+searchval;
            var filterData='is_download=1&'+filterUrl;
	        $.ajax({
	        	type: 'GET',
	            url: '<?php echo base_url(); ?>/crm-admin/user_applicant',
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
	        var field=($("#filter-field").val());
	        var type = $("#filter-type").val();
			var searchval=$("#filter-value").val();
			//var filterData='is_download=1&filters[0][field]='+field+'&filters[0][type]='+type+'&filters[0][value]='+searchval;
	        var filterUrl= decodeURIComponent( $.param( customFilter ) );		
            var filterData='is_download=1&'+filterUrl;
	        $.ajax({
	        	type: 'GET',
	            url: '<?php echo base_url(); ?>/crm-admin/user_applicant',
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
	              table.download("pdf", "data.pdf", {
	  		        orientation:"portrait", //set page orientation to portrait
	  		        title:"Example Report", //add title to report
	  		    });
		        });		
		    
		});
	});
</script>