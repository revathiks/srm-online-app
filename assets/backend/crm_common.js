
/***** Common Tabulator Function *****/
function common_tabultor(table_id,layout,printHeader,printFooter,checkTrue,pagination,ajaxURL,pageNo,placeholder,columns){
	var table = new Tabulator("#"+table_id, {
		layout: layout,
		printHeader: printHeader,
		printFooter: printFooter,
		printAsHtml: checkTrue,
		printStyled: checkTrue,
		ajaxFiltering: checkTrue,
		pagination: pagination,
		ajaxURL: ajaxURL,
		paginationDataSent: {
			page: pageNo, 
		},
		placeholder:placeholder,
		columns: columns,
	});	
	return table;
}

/***** Common Bar Line *****/

function common_bar_line_chart(ctx3,labelResultname_ss,leadDataResultcount_ss,barThickness,label){
	var purple_orange_gradient = ctx3.createLinearGradient(0, 0, 250, 0);
	purple_orange_gradient.addColorStop(0.0, 'rgb(237, 28, 36)');
	purple_orange_gradient.addColorStop(0.25, 'rgb(228, 81, 173)');
	purple_orange_gradient.addColorStop(0.5, 'rgb(194, 112, 215)');
	purple_orange_gradient.addColorStop(0.75, 'rgb(158, 143, 239)');
	purple_orange_gradient.addColorStop(1.0, 'rgb(106, 159, 247)');		
	var data_ass = {
		labels: labelResultname_ss,
		datasets: [{
			label: label,
			backgroundColor: purple_orange_gradient,
			borderColor: purple_orange_gradient,
			borderWidth: 1,				
			data:leadDataResultcount_ss
		}]

	};	
	
	var myBarChart = new Chart(ctx3, {
		type: 'horizontalBar',
		data: data_ass,
		options:{
			scales: {
				yAxes: [{
				 barThickness: barThickness
				}]
			}
		}
	});	
}