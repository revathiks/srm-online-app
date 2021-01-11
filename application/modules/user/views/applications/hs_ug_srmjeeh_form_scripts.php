<script>
var nationality_indian = '<?php echo NATIONALITY_INDIAN; ?>';
$(document).ready(function () {
    'use strict';
    $('#collapseOne_parent').trigger('click');

    $('#wizard2').steps({
        // alert('4');
        headerTag: 'h3',
        bodyTag: 'section',
        autoFocus: true,
        titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>'
        /* onStepChanging: function (event, currentIndex, newIndex) {
             if (currentIndex < newIndex) {
                 // Step 1 form validation
                 if (currentIndex === 0) {
                     var fname = $('#firstname').parsley();
                     var lname = $('#lastname').parsley();
                     if (fname.isValid() && lname.isValid()) {
                         return true;
                     } else {
                         fname.validate();
                         lname.validate();
                     }
                 }

                 // Step 2 form validation
                 if (currentIndex === 6) {
                     var email = $('#email').parsley();
                     if (email.isValid()) {
                         return true;
                     } else { email.validate(); }
                 }
                 // Always allow step back to the previous step even if the current step is not valid.
             } else { return true; }
         }*/
    });
    /* select2 has added */
    var no_nationality_msg = "Sorry, Nationality not available.";
    var no_course_msg = "Sorry, Course not available.";
    var no_specialization_msg = "Sorry, Specialization not available.";
    var no_campus_msg = "Sorry, Campus not available.";

    getSelect2('nationality','<?php echo base_url("get_nationalities"); ?>?sort_by=name&sort_order=asc','Choose Nationality', formatRepoCommon,no_nationality_msg, false, formatRepoSelection);
    getSelect2('course','<?php echo base_url("get_courses"); ?>?sort_by=name&sort_order=asc','Select Course Preference 1', formatRepoCommon,no_course_msg, false, formatRepoSelection);
    $('#course').on('change',function() {
        var course_val = $(this).val();
        getSelect2('specialization','<?php echo base_url("get_specializations"); ?>?course_id='+course_val+'&sort_by=name&sort_order=asc','Select Specialization Preference 1', formatRepoCommon,no_specialization_msg, false, formatRepoSelection);
    });
    $('#specialization').on('change',function() {
        var specialization_val = $(this).val();
        getSelect2('campus','<?php echo base_url("get_campuses"); ?>?specialization_id='+specialization_val+'&sort_by=name&sort_order=asc','Select Campus Preference 1', formatRepoCommon,no_campus_msg, false, formatRepoSelection);
    });
    /* select2 end */

    $(".next").click(function () {
        var percent = $('.prog').val();
        progress.value(percent);

        $(".progress-bar").css("width", percent + "%").attr("aria-valuenow", percent);
        $(".progress-completed").text(percent + "%");

        $("li").each(function () {
            if ($(this).hasClass("activestep")) {
                $(this).removeClass("activestep");
            }
        });

        if (event.target.className == "col-md-2") {
            $(event.target).addClass("activestep");
        }
        else {
            $(event.target.parentNode).addClass("activestep");
        }

        /*hideSteps();
        showCurrentStepInfo(step); */
    });
    $(function () {
        $("#datepicker").datepicker();
    });
    //Nationality Validation
    $("#info_study").hide();
    $( ".study" ).change(function() {
        if(  $(".study").val() == "yes" ){           
            $("#info_study").show();
            $("#Resident").hide();
        }
        else if($(".study").val() == "no"){
            $("#Resident").show();
            $("#info_study").hide();
        }
        else{
            $("#Resident").hide();
            $("#info_study").hide();
        }
    });
    $("#appering").click(function () {
        $("#appering_info_1").hide();
        $("#appering_info_2").hide();
        $("#appering_info_3").hide();
        $("#appering_info_4").hide();
    })
    $("#completed").click(function () {
        $("#appering_info_1").show();
        $("#appering_info_2").show();
        $("#appering_info_3").show();
        $("#appering_info_4").show();
    })
    $("#payment_details").hide();
    $("#online").click(function () {
        $("#payment_details").hide();
    })
    $("#dd").click(function () {
        $("#payment_details").show();
    })
    $('.finish').click(function(){
        window.location.replace("thank_you.html")
    })
});



//initialization options for the progress bar
var progress = $("#progress").shieldProgressBar({
    min: 0,
    max: 100,
    value: 20,
    layout: "circular",
    layoutOptions: {
        circular: {
            borderColor: "#eee",
            width: 10,
            borderWidth: 1,
            color: "#5CB85C",

        }
    },
    text: {
        enabled: true,
        //  template: '<span style="font-size:20px; color: #5CB85C;">{0:n0}%</span>'
        template: '<span style="font-size:20px; color: #5CB85C;">20%</span>'
    },
}).swidget();

</script>