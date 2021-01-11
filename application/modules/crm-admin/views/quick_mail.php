<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main row -->
  <div class="row">
    <section class="col-lg-7 connectedSortable">
    <!-- quick email widget -->
      <div class="box box-info">
        <div class="box-header">
          <i class="fa fa-envelope"></i>
          <h3 class="box-title">Quick Email</h3>
          <!-- tools box -->
          <!-- <div class="pull-right box-tools">
            <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
            title="Remove">
            <i class="fa fa-times"></i></button>
          </div> -->
          <!-- /. tools -->
        </div>
        <div class="box-body">
          <form action="#" method="post" id="quick_mail" name="quick_mail">
            <div class="form-group">
              <input type="email" class="form-control" name="emailto" id="emailto" placeholder="Email to:">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
            </div>
            <div>
              <textarea class="textarea" placeholder="Message" name="message" id="message"
              style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
          </form>
          <div class="progress progress-sm active" style="display:none">
            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
              <span class="sr-only"><span class="percentage">20</span>% Complete</span>
            </div>
          </div>
          <div class="alert-parent" id="quick_mail_response_content" style="display:none">
            <div class="alert">
              <button type="button" class="close" aria-hidden="true">×</button>
              <h4><i class="icon fa "></i> <span>Alert!</span></h4>
              <span id="message_content"></span>
            </div>
          </div>
        </div>
        <div class="box-footer clearfix">
          <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
          <i class="fa fa-arrow-circle-right"></i></button>
          
        </div>

      </div>
    </section>
  </div>
</div>
<script type="text/javascript">
  window.addEventListener('DOMContentLoaded', function(event) {
    var send_quick_mail_url = '<?php echo base_url(); ?>backend/send_quick_mail';
    $('#sendEmail').click(function () {
      $.ajax({
        url: send_quick_mail_url, 
        method:'post', 
        data: $('#quick_mail').serialize(), 
        beforeSend: function() { 
          
        },
        /*xhr: function() {
          var xhr = new window.XMLHttpRequest();
          $('.progress').show();
          xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
              var percentComplete = evt.loaded / evt.total;
              console.log('upload progress => '+percentComplete);
              //Do something with upload progress here
              $('.progress .progress-bar').css({'width':percentComplete+'%'});
              $('.progress .progress-bar .percentage').text(percentComplete);
            }
          }, false);
          xhr.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
              var percentComplete = evt.loaded / evt.total;
              console.log('progress => '+percentComplete);
              //Do something with download progress
              $('.progress .progress-bar').css({'width':percentComplete+'%'});
              $('.progress .progress-bar .percentage').text(percentComplete);
            }
          }, false);
          return xhr;
        },*/
        progress: function(e) {
        },
        uploadProgress: function(e) {
          // track uploading
          if (e.lengthComputable) {
            var completedPercentage = Math.round((e.loaded * 100) / e.total);
            console.log('completedPercentage => '+completedPercentage);
            $('.progress .progress-bar').css({'width':completedPercentage+'%'});
            $('.progress .progress-bar .percentage').text(completedPercentage);
          }
        },
        success: function (result) {
          $('.progress').hide();

          if(result) {
            var JSONRes = result;
            var arrRes = JSON.parse(JSONRes);
            console.log('arrRes.status => '+arrRes.status);
            // return false;
            if(arrRes.status == 1) {
              $('#quick_mail_response_content').find('div.alert').addClass('alert-success');
              $('#quick_mail_response_content').find('div.alert').removeClass('alert-warning');
              $('#quick_mail_response_content').find('div.alert').find('h4').find('i').addClass('fa-check');
              $('#quick_mail_response_content').find('div.alert').find('h4').find('i').removeClass('fa-warning');
            } else {
              $('#quick_mail_response_content').find('div.alert').removeClass('alert-success');
              $('#quick_mail_response_content').find('div.alert').addClass('alert-warning');
              $('#quick_mail_response_content').find('div.alert').find('h4').find('i').removeClass('fa-check');
              $('#quick_mail_response_content').find('div.alert').find('h4').find('i').addClass('fa-warning');
            }
            var res = arrRes.msg;
            $('#quick_mail_response_content').show('slow');
            $('#quick_mail_response_content').find('div.alert').find('span#message_content').html(res);
            if(arrRes.status == 1) {
              setTimeout(function() { $('#quick_mail_response_content').hide('slow'); $('#quick_mail')[0].reset(); }, 2000);
            }
          }
        }
      })
    });

    $('.close').on('click', function() {
      $('.alert-parent').hide('slow');
    });
  })
</script>