//function getSelect2(id,url,placeholder, formatRepo, noresultmsg, allowEmpty, formatRepoSelection,method,data) {
function getSelect2(id,url,placeholder, formatRepo, noresultmsg, allowEmpty, formatRepoSelection) {

  allowEmpty = allowEmpty || false;
  //method = method || "GET";
  //data = allowEmpty || false;
    $('#'+id).select2({
      theme: "bootstrap",
      width: 'resolve',
      dropdownAutoWidth:true,
      // language: lang,
      //allowClear: allowEmpty,
	  allowClear: true,
      placeholder: function(){
        $(this).data('placeholder');
      },
      ajax: {
        url: url,
		//method:method,
        dataType: 'json',
        // delay: 250,
        data: function (params) {
          var query = {
            keywords: params.term,
            page: params.page || 1,
            limit: params.limit || pageSize,
            pageSize: pageSize,
			// data:data
            // type: 'public'
          }

          // Query parameters will be ?search=[term]&type=public
          return query;
        },
        processResults: function (response, params) {
          params.page = response.page;
          
          response = JSON.stringify(response);
          response = JSON.parse(response);
          // console.log(response);
          if(typeof response.data != 'undefined') {
            data = response.data;
            // console.log('data => '+data);
            return {
                results: data,
                pagination: {
                    more: (response.page * response.limit) < response.total
                }
            };
          } else if(response.status === false) {
            // console.log('data => '+data);
            // $('#'+id).prepend('<option selected>'+$('#'+id).data('placeholder')+'</option>');
            return {
                results: []
            };
          }
        },
        cache: false,
      },
      placeholder: placeholder,
      escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
      // minimumInputLength: 1,
      templateResult: formatRepo,
      templateSelection: formatRepoSelection,
      language: {
        noResults: function(){
          // return "No Results Found <a href='#' class='btn btn-danger'>Use it anyway</a>";
          return noresultmsg;
        },  
      }
      // minimumResultsForSearch: Infinity
    });
}

function formatRepo (repo) {
  if (repo.loading) {
    return repo.text;
  }

  var markup = "<div class='select2-result-repository clearfix'>" +
    "<div class='select2-result-repository__meta'>" +
      "<div class='select2-result-repository__title'>" + repo.name + "</div>";

  if (repo.description) {
    //markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
  }

  markup += "</div></div>";

  return markup;
}

function formatRepoSelection (repo) {
  return repo.name || repo.text;
}
function formatRepoCommon (repo) {
  if (repo.loading) {
    return repo.text;
  }

  var markup = "<div class='select2-result-repository clearfix'>" +
    "<div class='select2-result-repository__meta'>" +
      "<div class='select2-result-repository__title'>" + repo.name + "</div>";

  if (repo.description) {
    //markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
  }

  markup += "</div></div>";

  return markup;
}

function formatRepoMobileCode (repo) {
  if (repo.loading) {
    return repo.text;
  }

  var markup = "<div class='select2-result-repository clearfix'>" +
    "<div class='select2-result-repository__meta'>" +
      "<div class='select2-result-repository__title'> +" + repo.name + "</div>";
  markup += "</div></div>";

  return markup;
}

function formatRepoMobileCodeSelection (repo) {
  return repo.code || repo.text;
}

/*jquery form validation error replacement*/
function errorPlacement_old(error, element) {
  // console.log(element.attr('id'));
  var ele_id = element.attr('id');
  var elem = $(element);
  // console.log('ele_id  length => '+ele_id+' , '+element.closest('.input-group').length);
  if (elem.hasClass("select2-hidden-accessible")) {
    element = $("#select2-" + elem.attr("id") + "-container").parent(); 
    error.insertAfter(element);
  } else if((element.hasClass('select2') && element.next('.select2-container').length) || element.prop('type') === 'select-one') {
    // console.log('ele_id => '+ele_id);
    if($('#'+ele_id).hasClass('error_next')) {
      error.insertAfter(element.parent().next());
    } else {
      // error.insertAfter(element.next('.select2-container'));
      error.insertAfter(element.parent());
    }
    // element.parent('.form-group').css({'margin-bottom':'0px'});
  }
  else if (element.parent('.form-group').length) {
    // console.log('ele_id 1 => '+ele_id);
      error.insertAfter(element.parent());
      // element.parent('.form-group').css({'margin-bottom':'0px'});
  }
  else if (element.closest('.input-group').length) {
    // console.log('ele_id 3 => '+ele_id);
    if(element.hasClass('select2')) {
      error.insertAfter(element.closest('.input-group').parent());
    } else {
      error.insertAfter(element.parent());
    }
  }
  // else if (element.parent('.input-group').length) {
  //   console.log('ele_id 2 => '+ele_id);
  //   if(element.hasClass('select2')) {
  //     error.insertAfter(element.parent().parent());
  //   } else {
  //     error.insertAfter(element.parent());
  //   }
  // }
  else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
    // console.log('ele_id 4 => '+ele_id);
      error.insertAfter(element.parent().parent());
  }
  else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
    // console.log('ele_id 5 => '+ele_id);
      error.appendTo(element.parent().parent());
  }
  else {
    // console.log('ele_id 6 => '+ele_id);
    // console.log('type  => '+element.prop('type'));
    if($('#'+ele_id).hasClass('error_next')) {
      error.appendTo(element.parent());
    } else {
      error.insertAfter(element);
    }
  }
}

function errorPlacement(error, element) {
  // console.log(element.attr('id'));
  var ele_id = element.attr('id');
  var elem = $(element);
  // console.log('ele_id  length => '+ele_id+' , '+element.closest('.input-group').length);
  /*if (elem.hasClass("select2-hidden-accessible")) {
    console.log('ele_id 0 => '+ele_id);
    element = $("#select2-" + elem.attr("id") + "-container").parent(); 
    error.insertAfter(element);
  } else*/
  if (element.closest('.input-group').length) {
    // console.log('ele_id 3 => '+ele_id);
    if(element.hasClass('select2')) {
      // console.log('ele_id 3 1 => '+ele_id);
      error.insertAfter(element.closest('.input-group').parent());
    } else if(ele_id == 'phone_no_code') {
      error.insertAfter(element.parent().parent());
    } else {
      error.insertAfter(element.parent());
    }
  } else if((element.hasClass('select2') && element.next('.select2-container').length) || element.prop('type') === 'select-one') {
    // console.log('ele_id => '+ele_id);
    if($('#'+ele_id).hasClass('error_next')) {
      error.insertAfter(element.parent().next());
    } else {
      // error.insertAfter(element.next('.select2-container'));
      error.insertAfter(element.parent());
    }
    // element.parent('.form-group').css({'margin-bottom':'0px'});
  }
  else if (element.parent('.form-group').length) {
    // console.log('ele_id 1 => '+ele_id);
      error.insertAfter(element.parent());
      // element.parent('.form-group').css({'margin-bottom':'0px'});
  }
   
  // else if (element.parent('.input-group').length) {
  //   console.log('ele_id 2 => '+ele_id);
  //   if(element.hasClass('select2')) {
  //     error.insertAfter(element.parent().parent());
  //   } else {
  //     error.insertAfter(element.parent());
  //   }
  // }
  else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
    // console.log('ele_id 4 => '+ele_id);
      error.insertAfter(element.parent().parent());
  }
  else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
    // console.log('ele_id 5 => '+ele_id);
      error.appendTo(element.parent().parent());
  }
  else {
    // console.log('ele_id 6 => '+ele_id);
    // console.log('type  => '+element.prop('type'));
    if($('#'+ele_id).hasClass('error_next')) {
      error.appendTo(element.parent());
    } else {
      error.insertAfter(element);
    }
  }
}

function setEmptyOnChangeSelect2(id) {
  /*$('span[aria-labelledby="select2-'+id+'-container"]').css({'height':'41px!important'});
  $('span[aria-labelledby="select2-'+id+'-container"] .select2-selection__arrow b').css({'margin-top':'10px'});*/
  $('#'+id).prepend('<option selected>'+$('#'+id).data('placeholder')+'</option>');
}

// on change jquery validation checking
// $("select").on("select2:close", function (e) {  
//     $(this).valid(); 
// });
setTimeout(function() { 
  $("select").on("select2:close select2:change select2:select", function (e) { 
    var id = $(this).attr('id');
    // window.Parsley.on('form:validated', function(){
        // $(this).isValid(); 
        $(this).parsley().validate();
        if($(this).parsley().isValid()) {
          return true;
        } else {
          return false;
        }
      // });
  });
}, 100);
// validate email
// $.validator.addMethod("checkEmail",function(value,element){return this.optional(element)||/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);});
// $.validator.addMethod("pwcheck", function(value) {
//    return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
//        && /[a-z]/.test(value) // has a lowercase letter
//        && /\d/.test(value) // has a digit
// });


function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

// $.validator.addMethod("nameonly", function(value, element) {
//     return this.optional(element) || /^[a-z0-9\s]+$/i.test(value);
// }, "name must contain only letters and numbers.");
window.Parsley
.addValidator('nameonly', {
  requirementType: 'boolean',
  validateString: function(value, requirement) {
    return /^[a-z\s]+$/i.test(value);
  },
  messages: {
    en: 'name must contain only letters and numbers.',
    // fr: 'Cette valeur doit être un multiple de %s'
  }
});

window.Parsley
.addValidator('mobileonly', {
  requirementType: 'integer',
  validateString: function(value, requirement) {
	  if(value.length<10){
		return false;
	  }
  },
  messages: {
    en: 'Mobile no is too short. It should have 10 characters as its validated to 10 characters.',
    // fr: 'Cette valeur doit être un multiple de %s'
  }
});

window.Parsley
.addValidator('pincodeonly', {
  requirementType: 'integer',
  validateString: function(value, requirement) {
	  if(value.length!=6){
		return false;
	  }
  },
  messages: {
    en: 'Pincode is too short. It should have 6 characters as its validated to 6 characters.',
    // fr: 'Cette valeur doit être un multiple de %s'
  }
});

// On Change Select2 Hide/Show Dynamically
function onchangeLoad(p_id,s_id){
	$('#'+p_id).on('change', function() {
		var data = $(this).val();
		// console.log("onchangeLoad"+work_exp_yes);
		if(data=="yes"){
			$("#"+s_id).show();
		}else{
			$("#"+s_id).hide();
		}
	});	
}

// On Change Label Hide/Show Dynamically
function onchangeLableHide(p_id,type){
  type = type || false;
  if(type == 'read-only') {
    $('#'+p_id).removeClass('parsley-error');
    $('#custom-'+p_id+'-parsley-error').hide();
    return true;
  } else if(type === 'date') {
    $('#'+p_id).on('changeDate', function() {
      // $('span').removeClass('has-error');
      // $('#'+p_id+'-error').hide();
      // console.log('return date => '+p_id);
      $('#'+p_id).removeClass('parsley-error');
      $('#custom-'+p_id+'-parsley-error').hide();
      return true;
    });
  } else {
    $('#'+p_id).on('change', function() {
      // $('span').removeClass('has-error');
      // $('#'+p_id+'-error').hide();
      console.log('return => '+p_id);
	  if($('#'+p_id).val()){
		$('#'+p_id).removeClass('parsley-error');
		$('#custom-'+p_id+'-parsley-error').hide();
	  }else{
		$('#'+p_id).addClass('parsley-error');
		$('#custom-'+p_id+'-parsley-error').show();		  
	  }
      //return true;
    });  
  }
  return false;
}

// On Uplaod Image Show Preview Dynamically
function uploadImage(p_id,img_id,show_remove_image,pdf_upload_string){
  pdf_upload_string = pdf_upload_string || false;
	// Upload ReadURL Dynamically
	function readURL(input,img_id) {
	  if (input.files && input.files[0]) {
		var filename = $("#"+p_id).val();
	    var filenameParts = filename.split('.'); 
	    var extension = filenameParts[1];   

		console.log("filename"+filename);
		if(extension=='pdf'){
			var fileName = input.files[0].name;
			$('#'+img_id).hide();
			$('#'+show_remove_image).hide();
			$("#"+pdf_upload_string).show();
			$("#"+pdf_upload_string).html('PDF Uploaded '+fileName);
			return false;
		}
		var reader = new FileReader();

		
		reader.onload = function(e) {
		  $('#'+img_id).attr('src', e.target.result);
		  $('#'+pdf_upload_string).hide();
		}
		reader.readAsDataURL(input.files[0]); // convert to base64 string
	  }
	}	
	
	$('#'+p_id).on('change', function() {
			$('#'+img_id).show();
			$('#'+p_id).show();
			$('#'+show_remove_image).show();
			readURL(this,img_id,show_remove_image);
	});	
}

// On Uplaod Image Remove Dynamically
function uploadImageRemove(p_id,img_id){
	$('#'+p_id).on('click', function() {
		$("#"+img_id).hide();
		$('#'+p_id).hide();
	});	
}

// Common DatePicker

function datePicker(dp_id){
	$("#"+dp_id).datepicker({format: "dd/mm/yyyy",autoclose: true,todayHighlight: true,});
}

/* Function for register page country code default india selection */
function select2Set(id,dbId,dbVal) {
    // $('#'+id).append('<option value='+dbId+'>'+dbVal+'</option>');
    // $("#"+id).select2("trigger", "select", {
    //     data: { id: dbId }
    // });
    $('#'+id)
    .empty() //empty select
    .append($("<option/>") //add option tag in select
        .val(dbId) //set value for option to post it
        .text(dbVal)) //set a text for show in select
    .val(dbId) //select option of select2
    .trigger("change"); //apply to select2
}
/* End of function for register page country code default india selection */

$(":file").filestyle({
  icon: true, 
  input: true, 
  htmlIcon: '<i class="fa fa-folder-open" aria-hidden="true"></i>&nbsp;',
  'onChange': function (files) {

    console.log(files);
    console.log($(this).attr('id'));
  }
});


window.Parsley.addValidator('maxFileSize', {
  validateString: function(value, maxSize, parsleyInstance) {
    if (!window.FormData) {
      alert('You are making all developpers in the world cringe. Upgrade your browser!');
      return true;
    }
    var files = parsleyInstance.$element[0].files;
    return files.length != 1  || files[0].size <= maxSize * 1024;
  },
  requirementType: 'integer',
  messages: {
    en: 'This file should not be larger than %s Kb'
  }
});

window.Parsley.addValidator('fileExtension', {
  validateString: function (value, requirement) {
    if(value) {
      var fileExtension = value.replace(/\s/g, "").split('.').pop();
      var allowedMimeTypes = requirement.replace(/\s/g, "").split('|');
      return allowedMimeTypes.indexOf(fileExtension) !== -1;  
    }
  },
  requirementType: 'string',
  messages: {
    en: 'The extension doesn\'t match the required ( %s )'
  }
});

window.Parsley.addValidator('noOfFiles', {
  validateString: function (value, requirement,parsleyInstance) {
    var files_count = parsleyInstance.$element[0].files.length;
    var db_file_count = 0;
    // console.log(' filecount => ');
    var this_id = parsleyInstance.$element[0].id;
    if(typeof $('#'+this_id).attr('data-file-count') != 'undefined') {
      db_file_count = $('#'+this_id).attr('data-file-count');
    }
    files_count = parseInt(files_count)+parseInt(db_file_count);
    // var max_file_count = requirement.replace(/\s/g, "");
    
    var max_file_count = requirement;
    // console.log(' max_file_count => '+max_file_count);
    // console.log(' files_count => '+files_count);
    return parseInt(files_count) <= parseInt(max_file_count);
  },
  requirementType: 'integer',
  messages: {
    en: 'Max allowed files only: %s'
  }
});

/* from npf */
function getFormattedDateDiff(date1, date2) {
    var b = moment(date1),
        a = moment(date2),
        intervals = ['months','days'],
        out = [],
        dayLabel = { one: 'day', other: 'days' };

        
    for(var i=0; i<intervals.length; i++){
        var diff = a.diff(b, intervals[i]);
        b.add(diff, intervals[i]);
        out.push(diff);
    }
    var yearsAndMonth="";
    if(out[0]>0){
        //call because of calculation issue with moment library in case of leap day year only
        yearsAndMonth += getMonthsInYearsAndMonths(out[0]);              
    }
    var addComma=(yearsAndMonth!='')?' , ':'';
    if(out[1]>0){
        yearsAndMonth += addComma+out[1]+" "+getPlural(out[1],dayLabel);
    }
    return yearsAndMonth;
}

function getMonthsInYearsAndMonths(monthCount) {
    var months = { one: 'month', other: 'months' },
        years = { one: 'year', other: 'years' },
        m = monthCount % 12,
        y = Math.floor(monthCount / 12),
        result = [];

    y && result.push(y + ' ' + getPlural(y, years));
    m && result.push(m + ' ' + getPlural(m, months));
    return result.join(' , ');
}

function convertDateToHyphenFormat(date){
    if(typeof date=="undefined" || date==""){
        return 0;
    }
    var dateArray=[];
    dateArray=date.split("/");
    if(dateArray.length==3){
        return dateArray[2]+"-"+dateArray[1]+"-"+dateArray[0];
    }else if(dateArray.length==2){
        return dateArray[1]+"-"+dateArray[0]+"-01";
    }else if(dateArray.length==1){
        return dateArray[0]+"-01-01";
    }else{
        return 0;
    }
}

function date_to_ymd_leap_year(dateFieldIds){
    
    if(dateFieldIds.length!=2){
        return false;
    }
    var cd1=convertDateToHyphenFormat(($("#"+dateFieldIds[0]).val()));
    var cd2=convertDateToHyphenFormat(($("#"+dateFieldIds[1]).val()));
    var d1=new Date(cd1);
    var d2=new Date(cd2);
    return getFormattedDateDiff(d2, d1);
}

function seconds_to_ymd(seconds, detail) {
  // Return a string containing the number of years, days, hours,
  // minutes, and seconds in the given numeric seconds argument.
  // The optional detail argument can limit the about of detail.
  // Note: 1 year is treated as 365.25 days to approximate "leap
  // years" TAGS: secToYMDHMS, secToDHMS
  //
  // Some Examples:
  // 
  // fmt_duration(35000000)
  // returns "1 year, 39 days, 20 hours, 13 minutes, 20 seconds"
  //
  // fmt_duration(24825601)
  // returns "287 days, 8 hours, 1 second"
  //
  // fmt_duration(24825601, 3)
  // returns "287 days, 8 hours"
  //
  // fmt_duration(24825601, 1)
  // returns "less than one year"
  // 
  "use strict";
  var labels = ['years','months','days', 'hours', 'minutes', 'seconds'],
    increments = [31557600,2629800, 86400, 3600, 60, 1],
    result = "",
    i,
    increment,
    label,
    quantity;
  detail = detail === undefined ? increments.length : detail;
  detail = Math.min(detail, increments.length);

  for (i = 0; i < detail; i += 1) {
    increment = increments[i];
    label = labels[i];

    if (seconds >= increment) {
      quantity = Math.floor(seconds / increment);
      if (quantity === 1) {
        // if singular, strip the 's' off the end of the label
        label = label.slice(0, -1);
      }
      seconds -= quantity * increment;
      result = result + " " + quantity + " " + label + ",";
    }
  }

  result = result.slice(1, -1);
  if (result === "") {
    result = "less than one " + labels[detail - 1].slice(0, -1);
  }

  return result;
}

function parseDateIntoSecs(val,format){
    return_date_secs=0;
    if(val!=""){
        var split_date=val.split("/");
        if(format=="DD/MM/YYYY"){
            return_date_secs=(new Date(split_date[1]+"/"+split_date[0]+"/"+split_date[2]+" 00:00:00"))/1000;
        }
        else if(format=="MM/YYYY"){
             return_date_secs=(new Date(split_date[0]+"/01/"+split_date[1]+" 00:00:00"))/1000;
        }
    }
    
    //console.log(return_date_secs);
    return return_date_secs;
}

function getDateIntoSeconds(date){
    if(typeof date=="undefined" || date==''){
        return 0;
    }
    date = convertDateToHyphenFormat(date);
    date = new Date(date);
    return date.getTime();
}

function calculate_months(id,from,to,output_format) {
  $("#"+from+", #"+to).change(function() { 
    $('#'+id).val("");
    if(( $('#'+from).length >0 && $('#'+from).val() !='')  &&  ( $('#'+to).length >0 && $('#'+to).val() !='') ){
       try {
            var results=eval("(($('#'+to).val()!='')?parseDateIntoSecs($('#'+to).val(),'MM/YYYY'):0)-(($('#'+from).val()!='')?parseDateIntoSecs($('#'+from).val(),'MM/YYYY'):0)");
           
            var date_field_exists='1';
           
            // var output_format='months';
            var dateFieldIds=[];
            var results_str ='';
           
           if(date_field_exists=="true" || date_field_exists=="1") {
               if(output_format=="years_months" && !isNaN(results)){
                    results_str = date_to_ymd_leap_year(dateFieldIds);
               }else{
                    results=Math.round((results/(30.41*24*60*60)));
                    if(!isNaN(results) && output_format=="months" && results>=0 ) results=results;//+1;
                }
                
           }else{
                if(results % 1 === 0){} // it is integer
                else { // it is float
                     results=Math.round(results * 100) / 100;
                }
            }
          
             //console.log(results);
            //alert(results);
            if(isNaN(results)){
              //if(results=="-Infinity" || results=="Infinity" || results.toLowerCase()=="nan")results="Invalid Input";
              results="Invalid Input";
            }else if(results<0){
               results="Invalid Input";
            }
            
            if(output_format=="years_months" && results!="Invalid Input"){
                if(results_str!='')
                    $('#'+id).val(results_str);
                else{
                    n=results/12;
                    var years = Math.floor(n);            // whole years
                    var months = Math.round(results)%12; // treat remainder as fraction of a year
                    $('#'+id).val( years+ " Years and "+months + " Months");
                }
                onchangeLableHide(id,'read-only');
            }
            else{
                $('#'+id).val(results);
                onchangeLableHide(id,'read-only');
            }
      }catch ( e ) {
          console.log(e);
      }
       
    }
  });
}

function getPlural(number, word) {
    return number === 1 && word.one || word.other;
}

function calculate_total_exp(output_format) {
  $("#from_year_0, #to_year_0, #from_year_1, #to_year_1, #from_year_2, #to_year_2").change(function() { 
     $('#total_work_experience').val("");
     if(( $('#from_year_0').length >0 && $('#from_year_0').val() !='')  ||  ( $('#to_year_0').length >0 && $('#to_year_0').val() !='')  ||  ( $('#from_year_1').length >0 && $('#from_year_1').val() !='')  ||  ( $('#to_year_1').length >0 && $('#to_year_1').val() !='')  ||  ( $('#from_year_2').length >0 && $('#from_year_2').val() !='')  ||  ( $('#to_year_2').length >0 && $('#to_year_2').val() !='') ){
         try {
              var results=eval("(($('#work_experience_0').val()!='')?parseFloat($('#work_experience_0').val()):0)+(($('#work_experience_1').val()!='')?parseFloat($('#work_experience_1').val()):0)+(($('#work_experience_2').val()!='')?parseFloat($('#work_experience_2').val()):0)");
             
              var date_field_exists='';
             
              // var output_format='months';
              var dateFieldIds=[];
              var results_str ='';
             
             if(date_field_exists=="true" || date_field_exists=="1") {
                 if(output_format=="years_months" && !isNaN(results)){
                      results_str = date_to_ymd_leap_year(dateFieldIds);
                 }else{
                      results=Math.round((results/(30.41*24*60*60)));
                      if(!isNaN(results) && output_format=="months" && results>=0 ) results=results;//+1;
                  }
                  
             }else{
                  if(results % 1 === 0){} // it is integer
                  else { // it is float
                       results=Math.round(results * 100) / 100;
                  }
              }
            
               //console.log(results);
              //alert(results);
              if(isNaN(results)){
                //if(results=="-Infinity" || results=="Infinity" || results.toLowerCase()=="nan")results="Invalid Input";
                results="Invalid Input";
              }else if(results<0){
                 results="Invalid Input";
              }
              
              if(output_format=="years_months" && results!="Invalid Input"){
                  if(results_str!='')
                      $('#total_work_experience').val(results_str);
                  else{
                      n=results/12;
                      var years = Math.floor(n);            // whole years
                      var months = Math.round(results)%12; // treat remainder as fraction of a year
                      $('#total_work_experience').val( years+ " Years and "+months + " Months");
                  }
                  onchangeLableHide('total_work_experience','read-only');
              }
              else{
                  $('#total_work_experience').val(results);
                  onchangeLableHide('total_work_experience','read-only');
              }
        }catch ( e ) {
            console.log(e);
        }
         
     }
  });
} 
/* to npf */
function hideAlert(htmlId) {
    $('#' + htmlId).fadeOut("slow");
}

function select2Set(id,dbId,dbVal) {
    // $('#'+id).append('<option value='+dbId+'>'+dbVal+'</option>');
    // $("#"+id).select2("trigger", "select", {
    //     data: { id: dbId }
    // });
    $('#'+id)
    .empty() //empty select
    .append($("<option/>") //add option tag in select
        .val(dbId) //set value for option to post it
        .text(dbVal)) //set a text for show in select
    .val(dbId) //select option of select2
    .trigger("change"); //apply to select2
}

window.Parsley.addValidator("requiredIf", {
   validateString : function(value, requirement) {
      if (jQuery(requirement).val()){
         return !!value;
      } 

      return true;
   },
   priority: 33
});

window.Parsley.addValidator("btechBasicCheck", {
  validateString : function(value, requirement) {
    var arr_requirement = requirement.split(',');
    var related_id_val = $('#'+arr_requirement[0]).val();
    var current_const = arr_requirement[1];
    var related_const = arr_requirement[2];
    var related_type = arr_requirement[3];
    if(value) {
      if(related_type == 1 && value != current_const && related_id_val == related_const) {
        // nationality change
        return false;
      } else if(related_type == 2 && value == current_const && related_id_val != related_const) {
        // studied india change
        return false;
      } 
    }
    return true;
  },
  requirementType: 'string',
  messages: {
    en: 'Not Applicable'
  }
})
function show_parents_detail(title_id,mobile_no_id,email_id,occupation_id,alt_mobile_no_id,ocupationid=null,otheroccupationid=null) {
  alt_mobile_no_id = alt_mobile_no_id || false;  
  //get phone id
  var phoneid=$('#'+mobile_no_id).find('input[type=text]').attr('id');
  $('#'+title_id).on('change',function() {
		var title = $(this).val();		
		if(title === lookup_value_title_late_id || title === ''){ 
			$("#"+mobile_no_id).hide();
			$("#"+email_id).hide(); 
			$("#"+occupation_id).hide();
		    if(alt_mobile_no_id) {
		        $("#"+alt_mobile_no_id).hide();
		        var alt_phoneid=$('#'+alt_mobile_no_id).find('input[type=text]').attr('id');
		      
		       if(alt_phoneid){
				     //var phoneidval=$("#"+phoneid).val();
				     $("#"+alt_phoneid).removeAttr('data-parsley-mobileonly');
				     $("#"+alt_phoneid).val('');
				     $("#"+alt_phoneid).parsley().validate();
				    }
		    }	
		    if(otheroccupationid){		    
		     $("#"+otheroccupationid).removeAttr('data-parsley-nameonly');
		     $("#"+otheroccupationid).val('');
		    }
		    if(phoneid){
		     //var phoneidval=$("#"+phoneid).val();
		     $("#"+phoneid).removeAttr('data-parsley-mobileonly');
		     $("#"+phoneid).val('');
		     $("#"+phoneid).parsley().validate();
		    }
		}
		else {
			$("#"+mobile_no_id).show();
			$("#"+email_id).show(); 
			$("#"+occupation_id).show();
		      if(alt_mobile_no_id) {
		        $("#"+alt_mobile_no_id).show();
		        var alt_phoneid=$('#'+alt_mobile_no_id).find('input[type=text]').attr('id');
		        if(alt_phoneid){				  
				     $("#"+alt_phoneid).attr('data-parsley-mobileonly','true');			    
				}
		      }
		      if(otheroccupationid){	
			      if($("#"+ocupationid).val()==otheroccupation){
			       $("#"+otheroccupationid).attr('data-parsley-nameonly',"true");
			      }
		      }
		      if(phoneid){
			    // var phoneidval=$("#"+phoneid).val();
			     $("#"+phoneid).attr('data-parsley-mobileonly','true');			    
			    }
		}
	});	
}
function show_other_element(srcid,destid,other,other_box=null) {	
	$('#'+srcid).on('change',function() {		
		var srcid_val = $(this).val();
		/*var selectedText=$("#select2-"+srcid+"-container").text();
		alert(selectedText);
		if(selectedText !== '' && selectedText !== "0" && (selectedText.toLowerCase() === 'others') ){ 
			$("#"+destid).show();
		}*/
		if(srcid_val==other){
			$("#"+destid).show();
			if(other_box){
				$("#"+other_box).attr('data-parsley-nameonly',"true");
			}
			
		}
		else {			
			$("#"+destid).hide();
			if(other_box){
			 $("#"+other_box).removeAttr('data-parsley-nameonly');
			}
			//$("#"+otheroccupationid).val('');
		}
	});	
}
function validate_cgpa(mark_scheme,cgpa) {
	var data =     {
		"57":[  {"min":"33", "max":"100"}], //temp
		"35":[  {"min":"3.3", "max":"10"}],
		"36":[  {"min":"3", "max":"9"}],
		"37":[  {"min":"2", "max":"7"}],
		"38":[  {"min":"1", "max":"4"}],
		"34":[  {"min":"33", "max":"100"}],
	}  
	$('#'+mark_scheme).on('change',function() {
		$('#'+cgpa).removeAttr("min");
		$('#'+cgpa).removeAttr("max");
		var cgpaval=$("#"+cgpa).val();
		if(cgpaval){		
		 $("#"+cgpa).parsley().validate();
		}
		var mark_scheme_val = $(this).val();
		var min=data[mark_scheme_val][0]['min'];
		var max=data[mark_scheme_val][0]['max'];
		if(mark_scheme_val!='' && mark_scheme_val!='null'){
			$('#'+cgpa).attr('min',min);
			$('#'+cgpa).attr('max',max);
		}
	});	
}

function validate_yop(sslcYr,hscYr,ugYr,pgYr) {
  ugYr = ugYr || null;
  pgYr = pgYr || null;
	$('#'+sslcYr).on('change',function() {
		 var startYr=$('#'+sslcYr).val();
		 var addYr=2;		 
		 var setYr=parseInt(startYr)+addYr;			
		// $('#'+hscYr).attr('min',setYr);
		 if(ugYr!=null){
			// $('#'+ugYr).attr('min',setYr);
		 }
		 if(ugYr!=null){
		   //$('#'+pgYr).attr('min',setYr);
		 }
	});	
	
	   
	    
}

function check_visible_input_validation(visible_id,input_id,required_message,nameonly_set,required_message_name_only) {
	if($('#'+visible_id).is(':visible')){
		$('#'+input_id).attr('data-parsley-required', 'true');
		$('#'+input_id).attr('data-parsley-required-message', required_message);
		if(nameonly_set==true){
			$('#'+input_id).attr('data-parsley-nameonly', 'true');
			$('#'+input_id).attr('data-parsley-nameonly-message', required_message_name_only);			
		}
	}else{
		$('#'+input_id).attr('data-parsley-required', 'false');
	}
}

function check_visible_input_nameonly_validation(visible_id,input_id,required_message_name_only) {
	if($('#'+visible_id).is(':visible')){
		$('#'+input_id).attr('data-parsley-nameonly', 'true');
		$('#'+input_id).attr('data-parsley-nameonly-message', required_message_name_only);			
	}else{
		$('#'+input_id).attr('data-parsley-required', 'false');
	}
}

function check_visible_input_digit_validation(visible_id,input_id,required_message,required_message_name_only) {
	if($('#'+visible_id).is(':visible')){
		$('#'+input_id).attr('data-parsley-required', 'true');
		$('#'+input_id).attr('data-parsley-required-message', required_message);		
		$('#'+input_id).attr('data-parsley-type', 'digits');
		$('#'+input_id).attr('data-parsley-type-message', required_message_name_only);			
	}else{
		$('#'+input_id).attr('data-parsley-required', 'false');
	}
}

function parent_other_occupation_enable(dp_id,div_id,other_id,on_hide_clear,on_hide_id) {
  on_hide_clear = on_hide_clear || false;
	$('#'+dp_id).on('change',function(){
		var data = $(this).val();
		if(data==other_id) {
			$('#'+div_id).show();
		} else {
			$('#'+div_id).hide();
			$('#'+on_hide_id).val('');
		}
	});		
}

function select2load(p_id,p_id2,p_val) {
	if(p_id2){
		setTimeout(function(){ select2Set(p_id,p_id2,p_val);}, 3);
	}		
}

function select2loadbyMatch(p_id,p_id2,class_or_id) {
		class_or_id = class_or_id || false;
	if(p_id2=='no'){
		var p_val = 'No';
		$(class_or_id).hide();
	}else{
		var p_val = 'Yes';
		$(class_or_id).show();
	}	
	if(p_id2){
		setTimeout(function(){ select2Set(p_id,p_id2,p_val);}, 1);
	}		
}

function select2loadDeformityPercentage(p_id,p_id2) {
	
		if(p_id2=='1'){
			var dbpercent_deformityVal = '10%';
		}
		if(p_id2=='2'){
			var dbpercent_deformityVal = '20%';
		}
		if(p_id2=='3'){
			var dbpercent_deformityVal = '30%';
		}
		if(p_id2=='4'){
			var dbpercent_deformityVal = '40%';
		}
		if(p_id2=='5'){
			var dbpercent_deformityVal = '50%';
		}
		if(p_id2=='6'){
			var dbpercent_deformityVal = '60%';
		}
		if(p_id2=='7'){
			var dbpercent_deformityVal = '70%';
		}
		if(p_id2=='8'){
			var dbpercent_deformityVal = '80%';
		}
		if(p_id2=='9'){
			var dbpercent_deformityVal = '90%';
		}
		if(p_id2=='10'){
			var dbpercent_deformityVal = '100%';
		}			
	if(p_id2){
		setTimeout(function(){ select2Set(p_id,p_id2,dbpercent_deformityVal);}, 1);
	}		
}


function select2loadParentOccupation(p_id,p_id2) {
		
	if(p_id2=='4'){
		var dbgoccupVal = 'Business';
	}
	if(p_id2=='3'){
		var dbgoccupVal = 'Defence';
	}
	if(p_id2=='2'){
		var dbgoccupVal = 'Government Sector';
	}
	if(p_id2=='6'){
		var dbgoccupVal = 'Homemaker';
	}
	if(p_id2=='1'){
		var dbgoccupVal = 'Private Sector';
	}
	if(p_id2=='5'){
		var dbgoccupVal = 'Retired';
	}
	if(p_id2=='7'){
		var dbgoccupVal = 'Other';
	}	
	if(p_id2){
		setTimeout(function(){ select2Set(p_id,p_id2,dbgoccupVal);}, 1);
	}		
}

function light_box_init() {
  $(".image-popup-vertical-fit").each(function() {
    var this_href = $(this).attr('href');
    var extension = this_href.substr( (this_href.lastIndexOf('.') +1) );
    switch(extension) {
        case 'jpg':
        case 'png':
        case 'jpeg':
          $(this).magnificPopup({type:"image",closeOnContentClick:!0,mainClass:"mfp-img-mobile",image:{verticalFit:!0}});
    }
  })
  
}

function upload_file_loading(file_doc_type) {
  $('#'+file_doc_type).prop('disabled',true);
  $('label[for='+file_doc_type+']').find('i').removeClass('fa fa-folder-open');
  $('label[for='+file_doc_type+']').find('i').addClass('spinner-grow spinner-grow-sm');
  $('label[for='+file_doc_type+']').find('span.buttonText').text('Loading...');
}
function upload_file_remove_loading(file_doc_type) {
  $('#'+file_doc_type).prop('disabled',false);
  $('label[for='+file_doc_type+']').find('i').addClass('fa fa-folder-open');
  $('label[for='+file_doc_type+']').find('i').removeClass('spinner-grow spinner-grow-sm');
  $('label[for='+file_doc_type+']').find('span.buttonText').text('Choose file');  
}
function upload_file_set_download_delete_options(file_doc_type, file_name, file_path, doc_id, id, parsley_required,mode_edit_val) {

  var bootstrap_filestyle = $('#'+file_doc_type).next('.bootstrap-filestyle');
  //console.log('bootstrap_filestyle => ');
  console.log(bootstrap_filestyle);
  if(mode_edit_val){
	  var file_path = "../../../"+file_path;
  }
  if(typeof bootstrap_filestyle != 'undefined') {

    upload_file_unset_download_delete_options(file_doc_type);

    $(bootstrap_filestyle).find('input').val(file_name);
    var downlod_html = '<a id="'+file_doc_type+'_download_link" class="image-popup-vertical-fit download_link" href="'+file_path+'" target="_blank" title="'+file_name+'"><label id="'+file_doc_type+'_download" for="'+file_doc_type+'_download_link" style="margin-bottom: 0;" class="btn btn-secondary"><i class="fa fa-eye" aria-hidden="true"></i></label></a>';
    var delete_html = '<a id="'+file_doc_type+'_delete_link" href="javascript:void(0)" data-del-file-id="'+id+'" data-doc-id="'+doc_id+'" data-toggle="modal" data-target="#contentDeletePop" data-field="'+file_doc_type+'" data-required="'+parsley_required+'" onclick="removeClick(this)"><label id="'+file_doc_type+'_delete" for="'+file_doc_type+'_delete_link" style="margin-bottom: 0;" class="btn btn-secondary"><i class="fa fa-trash" aria-hidden="true"></i></label></a>';
    $(bootstrap_filestyle).append(downlod_html);
    $(bootstrap_filestyle).append(delete_html);
    light_box_init();
  }
}

function upload_file_unset_download_delete_options(file_doc_type) {
  var bootstrap_filestyle = $('#'+file_doc_type).next('.bootstrap-filestyle');
  $('#'+file_doc_type).val('');
  if(typeof bootstrap_filestyle != 'undefined') {
    $(bootstrap_filestyle).find('input').val('');
    $(bootstrap_filestyle).find('#'+file_doc_type+'_download_link').remove();
    $(bootstrap_filestyle).find('#'+file_doc_type+'_delete_link').remove();
  }
}

function disableFields(){
    
    setTimeout(function(){ 
      // $("#declaration_compl").trigger('click');
      $("input").each(function()
        {
          $(this).prop('disabled',true);
        }
      )   
    }, 100);

    
    
    $('select').prop('disabled', true);
    // $('.finish').prop('disabled', true);
    // $('.finish').hide();
    
    // // # To disable
    // setTimeout(function(){ 
    //   var finishButton = $('#wizard2').find('a[href="#finish"]');
    //   finishButton.addClass("disabled");
    //   finishButton.hide();
    // }, 100);
    
    // # To enable
    // finishButton.removeClass();
    
  }
window.Parsley.addValidator("bmtechparttimeBasicCheck", {
  validateString : function(value, requirement) {
    if(value) {
      if(value == requirement) {
        return false;
      } 
    }
    return true;
  },
  requirementType: 'string',
  messages: {
    en: "Can't Proceed. Please read instruction below"
  }
})

/***** Tab Wise Percentage Show *****/
function tab_wise_percentage_show(url,percentage_bar_id){
	$.ajax({
		type: 'POST',
		url: url,
		dataType: 'json',
		cache: false,
		async: false,
		success: function(returndata) {
			if(typeof returndata['data'] != 'undefined') {
				var completion_percent = returndata['data'][0].completion_percent;
				$('#'+percentage_bar_id).html(completion_percent+'%');
				$('#'+percentage_bar_id).css('width', completion_percent+'%');
			}
		},
	});	
}
/* score validation*/
function validate_score(min,max) {
	$( "#"+max ).blur(function() {
		var score=$( "#"+max ).val();		
		if($.isNumeric(score)) { 
			$('#'+min).attr('max',score);
		} else{
			$('#'+min).removeAttr( "max" );
		}
	});
	$( "#"+min ).blur(function() {
		var score=$( "#"+max ).val();		
		if($.isNumeric(score)) { 
			$('#'+min).attr('max',score);
		} else{
			$('#'+min).removeAttr( "max" );
		}
	});
	
}
function set_application_payment_info() {
  var pd_firstname_val = $('#pd_firstname').val();
  var pd_middlename_val = $('#pd_middlename').val();
  var pd_lastname_val = $('#pd_lastname').val();
  var pd_mobile_no_code_val = $('#phone_no_code option:selected').text();
  var pd_mobile_no_val = $('#pd_mobile_no').val();
  var pd_email_val = $('#pd_email').val();
  $('#payment_applicant_name').text(pd_firstname_val+' '+pd_middlename_val+' '+pd_lastname_val);
  $('#payment_applicant_email_id').text(pd_email_val);
  $('#payment_applicant_phone').text(pd_mobile_no_code_val+'-'+pd_mobile_no_val);  
}
function enable_preview_btn(currentIndex,preview) {	
	$("#previewbtn").remove();
	var preview_button = $("<a id='previewbtn' style='float:left;background:unset;'><input type='button' id='form_preview_btn' class='btn btn-primary' value='Form Preview'></a>").attr("href",preview+"?startIndex="+currentIndex);
	$(document).find(".actions").prepend(preview_button);
}
function enable_saveExit_btn(currentIndex,paymentIndex) {	
	$("#save_exit").remove();
	if(currentIndex!=paymentIndex){
		var save_button = $("<div id='save_exit' style='float:left;background:unset;' href='javascript:void(0);'><input type='button' id='save_btn' class='btn btn-primary' value='SAVE & EXIT'></div>");
		$(document).find(".actions").prepend(save_button);
	}
}
window.Parsley.addValidator("notequalto", {
    requirementType: "string",
    validateString: function(value, element) {
        return value !== $(element).val();
    }
});


function onkeyValidation(degree_diploma,major_discipline,institute_university,user_marking_scheme,year_of_passing,obtained_percentage_cgpa){
	$('#'+degree_diploma).on('change',function() {
		if($('#'+degree_diploma).val()){
			$('#'+degree_diploma).attr('data-parsley-required','true');
			$('#'+major_discipline).attr('data-parsley-required','true');
			$('#'+institute_university).attr('data-parsley-required','true');
			$('#'+user_marking_scheme).attr('data-parsley-required','true');
			$('#'+year_of_passing).attr('data-parsley-required','true');
			$('#'+obtained_percentage_cgpa).attr('data-parsley-required','true');
/* 
			$('#'+degree_diploma).attr('data-parsley-required-message','Required');
			$('#'+major_discipline).attr('data-parsley-required-message','Required');
			$('#'+institute_university).attr('data-parsley-required-message','Required');
			$('#'+user_marking_scheme).attr('data-parsley-required-message','Required');
			$('#'+year_of_passing).attr('data-parsley-required-message','Required'); */
			//$('#'+obtained_percentage_cgpa).attr('data-parsley-required-message','Please Enter Percentage/CGPA');			
		}else{
			/* $('#'+degree_diploma).attr('data-parsley-required','false');
			$('#'+major_discipline).attr('data-parsley-required','false');
			$('#'+institute_university).attr('data-parsley-required','false');
			$('#'+user_marking_scheme).attr('data-parsley-required','false');
			$('#'+year_of_passing).attr('data-parsley-required','false');
			$('#'+obtained_percentage_cgpa).attr('data-parsley-required','false'); */
		}
	});	
}

function onkeyValidationp(degree_diploma,major_discipline,institute_university,user_marking_scheme,year_of_passing,obtained_percentage_cgpa){
	$('#'+degree_diploma).on('change',function() {
		if($('#'+degree_diploma).val()){
			$('#'+degree_diploma).attr('data-parsley-required','true');
			$('#'+major_discipline).attr('data-parsley-required','true');
			$('#'+institute_university).attr('data-parsley-required','true');
			$('#'+user_marking_scheme).attr('data-parsley-required','true');
			$('#'+year_of_passing).attr('data-parsley-required','true');
			$('#'+obtained_percentage_cgpa).attr('data-parsley-required','true');
/* 
			$('#'+degree_diploma).attr('data-parsley-required-message','Required');
			$('#'+major_discipline).attr('data-parsley-required-message','Required');
			$('#'+institute_university).attr('data-parsley-required-message','Required');
			$('#'+user_marking_scheme).attr('data-parsley-required-message','Required');
			$('#'+year_of_passing).attr('data-parsley-required-message','Required'); */
			//$('#'+obtained_percentage_cgpa).attr('data-parsley-required-message','Please Enter Percentage/CGPA');			
		}else{
			$('#'+degree_diploma).attr('data-parsley-required','false');
			$('#'+major_discipline).attr('data-parsley-required','false');
			$('#'+institute_university).attr('data-parsley-required','false');
			$('#'+user_marking_scheme).attr('data-parsley-required','false');
			$('#'+year_of_passing).attr('data-parsley-required','false');
			$('#'+obtained_percentage_cgpa).attr('data-parsley-required','false');
		}
	});	
}

function onkeyValidationPexp(org_name,designation,nature_of_job,salary,from,to,work_exper=false,sector=false){
	$('#'+org_name).on('change',function() {
		if($('#'+org_name).val()){
			$('#'+org_name).attr('data-parsley-required','true');
			$('#'+designation).attr('data-parsley-required','true');
			$('#'+nature_of_job).attr('data-parsley-required','true');
			$('#'+salary).attr('data-parsley-required','true');
			$('#'+from).attr('data-parsley-required','true');
			$('#'+to).attr('data-parsley-required','true');
			if(work_exper){
				$('#'+work_exper).attr('data-parsley-required','true');
				$('#'+work_exper).attr('data-parsley-required-message','Required');
			}
			if(sector){
				$('#'+sector).attr('data-parsley-required','true');
				$('#'+sector).attr('data-parsley-required-message','Required');
			}			

			$('#'+org_name).attr('data-parsley-required-message','Required');
			$('#'+designation).attr('data-parsley-required-message','Required');
			$('#'+nature_of_job).attr('data-parsley-required-message','Required');
			$('#'+salary).attr('data-parsley-required-message','Required');
			$('#'+from).attr('data-parsley-required-message','Required');
			$('#'+to).attr('data-parsley-required-message','Required');			
		}else{
			$('#'+org_name).attr('data-parsley-required','false');
			$('#'+designation).attr('data-parsley-required','false');
			$('#'+nature_of_job).attr('data-parsley-required','false');
			$('#'+salary).attr('data-parsley-required','false');
			$('#'+from).attr('data-parsley-required','false');
			$('#'+to).attr('data-parsley-required','false');
			if(work_exper){
				$('#'+work_exper).attr('data-parsley-required','false');
			}
			if(sector){
				$('#'+sector).attr('data-parsley-required','false');
				$('#'+sector).attr('data-parsley-required-message','false');
			}			
		}
	});	
}

function onkeyValidationPub(publications_title,publications_name_of_the_journal,publications_year){
	$('#'+publications_title).on('change',function() {
		if($('#'+publications_title).val()){
			$('#'+publications_title).attr('data-parsley-required','true');
			$('#'+publications_name_of_the_journal).attr('data-parsley-required','true');
			$('#'+publications_year).attr('data-parsley-required','true');

			$('#'+publications_title).attr('data-parsley-required-message','Required');
			$('#'+publications_name_of_the_journal).attr('data-parsley-required-message','Required');
			$('#'+publications_year).attr('data-parsley-required-message','Required');		
		}else{
			$('#'+publications_title).attr('data-parsley-required','false');
			$('#'+publications_name_of_the_journal).attr('data-parsley-required','false');
			$('#'+publications_year).attr('data-parsley-required','false');
		}
	});	
}

function onkeyValidationPexpOnMRESEARCH(org_name,designation,from,to){
	$('#'+org_name).on('change',function() {
		if($('#'+org_name).val()){
			$('#'+org_name).attr('data-parsley-required','true');
			$('#'+designation).attr('data-parsley-required','true');
			$('#'+from).attr('data-parsley-required','true');
			$('#'+to).attr('data-parsley-required','true');		

			$('#'+org_name).attr('data-parsley-required-message','Required');
			$('#'+designation).attr('data-parsley-required-message','Required');
			$('#'+from).attr('data-parsley-required-message','Required');
			$('#'+to).attr('data-parsley-required-message','Required');			
		}else{
			$('#'+org_name).attr('data-parsley-required','false');
			$('#'+designation).attr('data-parsley-required','false');
			$('#'+from).attr('data-parsley-required','false');
			$('#'+to).attr('data-parsley-required','false');			
		}
	});	
}


function onkeyValidationCEXAM(exam,roll_no,score,mscore,year,rank,qualifier){
	$('#'+exam).on('change',function() {
		if($('#'+exam).val()){
			$('#'+exam).attr('data-parsley-required','true');
			$('#'+roll_no).attr('data-parsley-required','true');
			$('#'+score).attr('data-parsley-required','true');
			$('#'+mscore).attr('data-parsley-required','true');
			$('#'+year).attr('data-parsley-required','true');
			$('#'+rank).attr('data-parsley-required','true');	
			$('#'+qualifier).attr('data-parsley-required','true');

			$('#'+exam).attr('data-parsley-required-message','Please Select Competitive Examination');
			$('#'+roll_no).attr('data-parsley-required-message','Please Enter Registration No');
			$('#'+score).attr('data-parsley-required-message','Please Enter Score Obtained');
			$('#'+mscore).attr('data-parsley-required-message','Please Enter Max Score');
			$('#'+year).attr('data-parsley-required-message','Please Enter Year Appeared');
			$('#'+rank).attr('data-parsley-required-message','Please Enter AIR / Overall Rank');
			$('#'+qualifier).attr('data-parsley-required-message','Please Select Qualified / Not Qualified');
		}else{
			$('#'+exam).attr('data-parsley-required','false');
			$('#'+roll_no).attr('data-parsley-required','false');
			$('#'+score).attr('data-parsley-required','false');
			$('#'+mscore).attr('data-parsley-required','false');
			$('#'+year).attr('data-parsley-required','false');
			$('#'+rank).attr('data-parsley-required','false');	
			$('#'+qualifier).attr('data-parsley-required','false');		
		}
	});	
}

function unique_msg(addClass,color,msg){
	$('#'+addClass).addClass('parsley-error');
	$('#custom-'+addClass+'-parsley-error').show();
	$('#custom-'+addClass+'-parsley-error').css('color',color);
	$('#custom-'+addClass+'-parsley-error').html(msg);		
	setTimeout(function(){
		$('#'+addClass).toggleClass('parsley-error');
		$('#custom-'+addClass+'-parsley-error').hide();
	}, 3000);	
}

//Seems you entered wrong email address. Did you mean Gmail?

function email_suggestion(email_id,suggestion_id){
	var $hint = $('#'+suggestion_id);
	$('#'+email_id).on('blur', function(event) {
		var email_id = $(this).val();
		
		if(email_id){
			$(this).mailcheck({
				suggested: function(element, suggestion) {
					$hint.css('display', 'block');	  
					$hint.css('color','#ff0000')
					// callback code
					console.log("suggestion ", suggestion.full);
					$('#'+suggestion_id).html("Seems you entered wrong email address. Did you mean ?<b><a href='#' class='domain'>" + suggestion.full + "</a></b>");
				},
				empty: function(element) {
				  // callback code
				}
			});
		}else{
			$hint.css('display', 'none').empty();
		}
	});
	
	var $email = $('#'+email_id);

    $hint.on('click', '.domain', function() {
      // On click, fill in the field with the suggestion and remove the hint
      $email.val($(".domain").text());
      $hint.fadeOut(200, function() {
        $(this).empty();
      });
      return false;
    });
	
}

//////// Function Country Based State , District , City Chain ////////

function onchange_country(main_div_state,main_div_district,main_div_city,state_id,city_id,district_id,url,no_state_msg,country_value_default,country_val){
	if(country_value_default==country_val){					
		$('#'+main_div_state).show();
		getSelect2(state_id,url,'Select State', formatRepoCommon,no_state_msg, false, formatRepoSelection);
		$('#'+state_id).attr('data-parsley-required',"true");
		$('#'+city_id).attr('data-parsley-required',"true");
		$('#'+district_id).attr('data-parsley-required',"true");
	} else{					
		$('#'+main_div_state).hide();
		$('#'+main_div_district).hide();
		$('#'+main_div_city).hide();	
		$('#'+state_id).attr('data-parsley-required',"false");
		$('#'+city_id).attr('data-parsley-required',"false");
		$('#'+district_id).attr('data-parsley-required',"false"); 						
	}
}

// Common DatePicker By Year

function datepicker_yop(program_cy,format,minViewMode,startDate,endDate){
	$("#"+program_cy).datepicker( {
		format:format , autoclose: !0, minViewMode:minViewMode, endDate: moment().format('dd-mm-yyyy'),startDate: startDate,endDate: endDate 
	}).on('changeDate', function(e) {
		$("#"+program_cy).parsley().validate();
	});		
}

function onkeyValidationadditionalQualification(program_id,yop){
	$('#'+program_id).on('change',function() {
		if($('#'+program_id).val()){
			$('#'+program_id).attr('data-parsley-required','true');
			$('#'+yop).attr('data-parsley-required','true');
			$('#'+program_id).attr('data-parsley-required-message','Required');
			$('#'+yop).attr('data-parsley-required-message','Required');	
		}
	});	
}

/*********** Preview Print Function ***********/

function print_appl_form(print_id,html_open,html_close,get_print_yes,innerHTML) {
	var divToPrint = document.getElementById(print_id);
	var newWin = window.open('Print-Window');
	newWin.document.open();
	newWin.document.write(html_open + innerHTML + html_close);
	newWin.document.close();
	//setTimeout(function () { newWin.close(); }, 10);
	if(get_print_yes=="yes"){setTimeout(function() {window.onload = print_appl_form;}, 100);}	
}

/////// Function International Country Based State , District , City Chain ////////

function onchange_intl_country(main_div_state,state_id,url,no_state_msg,country_val){
	if(country_val){					
		$('#'+main_div_state).show();
		getSelect2(state_id,url,'Select State', formatRepoCommon,no_state_msg, false, formatRepoSelection);
	} else{					
		$('#'+main_div_state).hide();	
		$('#'+state_id).attr('data-parsley-required',"false"); 						
	}
}
//auto complete off based on form ids
$('#hcma_form').attr('autocomplete', 'off');
$('#bm_ed_mphil_form').attr('autocomplete', 'off');
$('#shug_form').attr('autocomplete', 'off');
$('#bba_form').attr('autocomplete', 'off');
$('#mba_form').attr('autocomplete', 'off');
$('#part-time-ug-pg-courses_form').attr('autocomplete', 'off');
$('#hspg_diploma_form').attr('autocomplete', 'off');
$('#hspg_ee_form').attr('autocomplete', 'off');
$('#afih_form').attr('autocomplete', 'off');
$('#tamil_form').attr('autocomplete', 'off');