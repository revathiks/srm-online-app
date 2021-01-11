<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
 <!-- Begin page content -->
	<div class="container">
		<div class="page-header">
			<div id="draftSaved"></div>
			<div class="row">
				<div class="col-md-6">
					<h3><?php echo $page_heading_name;?></h3> 	
				</div>
				<div class="col-md-6">
					<button type='button' class='btn btn-primary' id="composeButton" data-toggle="modal" data-target="#myModal"><?php echo $mail_compose_button;?></button>
				</div>			
			</div>	
		</div> 
		<?php if($this->session->userdata('msg')) { ?>
			<div class='alert alert-success col-md-12'>
			<?=$this->session->userdata('msg');?>
			<button type='button' class='close'	data-dismiss='alert'>&times;</button>
			</div>
		<?php } ?>
		<div class="tab">
			<button class="tablinks" onclick="openCity(event, '<?php echo MAILBOX_INBOX_TEXT;?>')" id="defaultOpen">Inbox</button>
			<button class="tablinks" onclick="openCity(event, '<?php echo MAILBOX_SENT_TEXT;?>')">Sent</button>
			<button class="tablinks" onclick="openCity(event, '<?php echo MAILBOX_TRASH_TEXT;?>')">Trash</button>
			<button class="tablinks" onclick="openDraft(event, 'Draft', <?php echo MAIL_BOX_DRAFT;?>)" id="draftDisabled">Draft<span id="draftCount" style="color:#ff0000;"> <?php echo "(" .$total.")" ;?></span></button>
		</div>

		<div id="London" class="tabcontent">
			<div class="loadings" style="display:none;">
			<img src="https://www.cs.toronto.edu/~amlan/demo/loader.gif" style="width:10%;margin:0 45% auto;">
			</div>
			<h3 class="tab_title">Inbox</h3>
			<table id="records_table" class="table table-hover"></table>
			<table id="records_table2" class="table table-hover"></table>
		</div>

		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
			  <!-- Modal Compose Email -->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title"><?php echo $mail_compose_button;?></h4>
				</div>
				<form action="<?php echo base_url('mail_box/compose'); ?>" method='post' id="composeForm">
					<div class="modal-body">	
						<div class="form-group">
						  <label for="usr"><?php echo $mail_compose_to;?></label>
						  <?php echo $mail_compose_email; ?>
						</div>
						<div class="form-group">
						  <label for="usr"><?php echo $mail_compose_subject;?></label>
						  <input type="text" name="subject" class="form-control" id="ComposeSubject" required>
						</div>	
						<div class="form-group">
						  <label for="usr"><?php echo $mail_compose_body;?></label>
						  <textarea name="message" class="form-control" id="ComposeBody" rows="10" cols="50" required></textarea>
						</div>
					</div>
					<input type="hidden" name="from_id" value="<?php echo $from_id; ?>">
					<input type="hidden" name="to_id" value="<?php echo $user_id; ?>">
					<div class="modal-footer">
					  <button type="submit" name="compose_send" id="compose_send" class="btn btn-success"><?php echo $mail_compose_send;?></button>
					  <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $mail_compose_close;?></button>
					</div>
				</form>
			  </div>
			</div>
		</div>
	</div>
	<script>
	function openDraft(evt, id , status = false) {
		$(".tab_title").html('Draft');
		$("#records_table2").show();
		$("#records_table").hide();
		$.ajax({
			type: 'GET',
			url: '<?php echo base_url(); ?>mail_box/discard_count',
			dataType: 'json',
			cache: false,
			beforeSend: function () {
				$('.loadings').show();
				$("#records_table2").hide();
				$(".tab_title").hide();
			},
			success: function (json) 
			{
				$("#records_table2").empty();
				$("#records_table2").show();
				$(".tab_title").show();
				$('.loadings').hide();
				$("#tblBody").remove();
				$("#tblehead").remove();                    
				var response = json.data;
				$('<thead id="tblehead"><tr>').html("<th>S.No</th><th>Subject</th><th>Message</th>").appendTo('#records_table2');
				$.each(response, function(i, item) {
				//alert(response[i].status);
				$('<tbody id="tblBody"><tr>').html("<td>" + response[i].serial_number + "</td><td>" + response[i].subject + "</td><td>" + response[i].message + "</td>").appendTo('#records_table2');
				});
			}
		});
	}
	function openCity(evt, id , status = false) {
		$(".tab_title").html('Inbox');
		$("#records_table").show();
		$("#records_table2").hide();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>mail_box/inbox',
			data:'id='+id+'&trash_status='+status,
			dataType: 'json',
			cache: false,
			beforeSend: function () {
				$('.loadings').show();
				$(".tab_title").hide();
				$("#records_table").hide();
			},
			success: function (json) 
			{
				$("#records_table").empty();
				$("#records_table").show();
				$(".tab_title").show();
				$('.loadings').hide();
				//$("#defaultOpen").attr( "disabled", "disabled" );
				$("#tblBody").remove();
				$("#tblehead").remove();                    
				var response = json.data;
				$('<thead id="tblehead"><tr>').html("<th>S.No</th><th>Subject</th><th>Message</th>").appendTo('#records_table');
				$.each(response, function(i, item) {
				//alert(response[i].status);
				$('<tbody id="tblBody"><tr>').html("<td>" + response[i].serial_number + "</td><td>" + response[i].subject + "</td><td>" + response[i].message + "</td>").appendTo('#records_table');
				});
			}
		});
	 } 
	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();

	$(function(){
		$("#composeForm").submit(function(event){
			event.preventDefault();
			$.ajax({
				url:'<?php echo base_url(); ?>mail_box/compose',
				type:'POST',
				data:$(this).serialize(),	
				success:function(result){
					var json = JSON.parse(result);
					if(json.status=="true"){
						var redirect = '<?php echo base_url(); ?>'+json.redirect;
						window.location.href = redirect;
					}else{
						$("failed").html("Something Went Wrong");
					}
				}
			});
		});
		
		// Checking For Draft Email
		$("#myModal").on("hidden.bs.modal", function () {
			var subject = $("#ComposeSubject").val();
			var message = $("#ComposeBody").val();
			if( subject.length != 0 || message.length != 0){
				// Check Via Console
				console.log("Model Popup Closed "+$("#composeForm").serialize());
				$.ajax({
					url:'<?php echo base_url(); ?>mail_box/compose_discard',
					type:'POST',
					data:$("#composeForm").serialize(),	
					success:function(result){
						var json = JSON.parse(result);
						console.log("json "+json);
						if(json.status=="true"){
							$("#draftSaved").html("Draft Email Saved");
							$("#draftSaved").addClass("alert alert-warning");
							$.ajax({
								url:'<?php echo base_url(); ?>mail_box/discard_count',
								type:'GET',
								success:function(result){
									var json = JSON.parse(result);
									var count = json.total;
									console.log("result"+json.total);
									$("#draftCount").html(" ("+count+")");
								}
							});
						}
						/* if(json.status=="true"){
							var redirect = '<?php echo base_url(); ?>'+json.redirect;
							window.location.href = redirect;
						}else{
							$("failed").html("Something Went Wrong");
						} */
					}
				});			
				
			}else{
				// $("#draftSaved").html("Draft Email Not Saved");
				// Check Via Console
				console.log("Model Popup Closed No Data Returned");			
			}
		});	
	});
	</script>
