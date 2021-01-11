			<footer class="footer">
			    <div class="container-fluid">
			        <div class="row">
			            <div class="col-12">
			                <?php echo $this->load->view('templates/copy_right'); ?>
			            </div>
			        </div>
			    </div>
			</footer>
		</div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <div class="modal fade" id="contentDeletePop" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
	  <!-- .modal-dialog -->
	  <div class="modal-dialog w-100">
	    <!-- .modal-content -->
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title custom_align" id="Heading">Delete confirmation</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
	      </div>
	      <div class="modal-body">
	        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure to delete?</div>
	      </div>
	      <div class="modal-footer ">
	        <button type="button" class="btn btn-success" id="yesbulk_btn"  onclick="removeAttachedFile(this)"><span class="fa fa-check"></span> Yes</button>
	        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
	      </div>
	    </div>
	    <!-- /.modal-content -->
	  </div>
	  <!-- /.modal-dialog -->
	</div>