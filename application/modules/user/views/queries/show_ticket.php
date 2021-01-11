<div class="row">
    <div class="col-12">   
        <?php
        $ticket_id = $this->uri->segment('2');
        if (!empty($ticketinfo)) {
            $applicant_personal_det_id = $ticketinfo[0]['applicant_personal_det_id'];
            $ticket_no = $ticketinfo[0]['ticket_id'];
            $catname = $ticketinfo[0]['sub_category_name'];
            $created_at = $ticketinfo[0]['created_at'];
            if (!empty($created_at)) {
                $created_at = date("d/m/Y h:i:s", strtotime($created_at));
            }
            $status_name = $ticketinfo[0]['status_name'];
            $catname = isset($catname) ? $catname : '';
            $status_name = isset($status_name) ? $status_name : '';
        }
        if (!empty($ticket_no) && $applicant_personal_det_id == $logged_applicant_id) {

            /*   echo "<pre>";
            print_r($ticket_conversations);
            echo "</pre>"; */
            $file_allowed_type = FILE_ALLOWED_TYPE;
            //name
            $fname = $personal_detail_list['data']['first_name'];
            $lname = $personal_detail_list['data']['last_name'];
            $firstname = isset($fname) ? $fname : '';
            $lastname = isset($lname) ? $lname : '';
            $name = $firstname . " " . $lastname;
            ?>
            <div class="card">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="d-block">
                                <div class="d-inline-block">
                                    <i class="fas fa-ticket-alt ticket_icon"></i>
                                </div>

                                <div class="d-inline-block">
                                    <h6>Ticket ID</h6>
                                    <p><?php echo $ticket_id; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 border-right">
                            <div class="d-block">
                                <div class="d-inline-block">
                                    <i class="fas fa-network-wired ticket_icon"></i>
                                </div>

                                <div class="d-inline-block">
                                    <h6>Category</h6>
                                    <p><?php echo $catname; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 border-right">
                            <div class="d-block">
                                <div class="d-inline-block">
                                    <i class="fas fa-calendar-alt ticket_icon"></i>
                                </div>

                                <div class="d-inline-block">
                                    <h6>Date</h6>
                                    <p><?php echo $created_at; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-block">
                                <div class="d-inline-block">
                                    <i class="fas fa-retweet ticket_icon"></i>
                                </div>

                                <div class="d-inline-block">
                                    <h6>Status</h6>
                                    <p><?php echo $status_name; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>                           
    </div>
    <!-- end row -->

    <div class="card">
        <div class="card-head p-2 header-ticket">
            <div class="row">
                <div class="col-md-12 d-block">
                    <i class="fab fa-rocketchat  rocketchat_icon pr-3"></i>
                    <h4 class="text-dark d-inline-block">Ticket Conversation</h4>
            </div>

            </div>
        </div>
        <div class="card-body">
    <?php
    if (!empty($ticket_conversations)) {
        foreach ($ticket_conversations as $conversation) {
            $message = $conversation['applicant_query'];
            $doc_path = $conversation['doc_path'];
            $conv_created_at = $conversation['created_at'];
            $conv_updated_at = $conversation['updated_at'];
            if (!empty($conv_created_at)) {
                $conv_created_at = date("d/m/Y h:i:s", strtotime($conv_created_at));
            }
            $colWidth = "col-md-12";
            if ($doc_path != "" || $doc_path != null) {
                $colWidth = "col-md-6";
            }
            ?>
                    <div class="col-md-12 bg-primary float-right w-75 border-left rounded mt-3">
                        <div class="row">
                            <div class="<?php echo $colWidth; ?>">
                                <p class="text-light align-middle mb-0 p-2">
                                <?php echo $message; ?>
                                </p>
                            </div>
                                    <?php
                                    if ($doc_path != "" || $doc_path != null) {
                                        ?>
                                <div class="<?php echo $colWidth; ?>">
                                    <p class="text-light align-middle mb-0 p-2">
                                        <a target="_blank" href="<?php echo base_url() ?>uploads/my_queries/<?php echo $applicant_personal_det_id . "/" . $doc_path; ?>" class="text-light ">Attachment</a>
                                    </p>
                                </div>
            <?php } ?>
                        </div>
                        <div class="w-100 row">
                            <div class="col-md-12">
                                <span class="text-light pl-2"><?php echo $name ?> &nbsp;&nbsp; <?php echo $conv_created_at; ?></span>
                            </div>

                        </div>
                    </div>  
            <?php
        }
    }
    ?> 
        </div>
    </div>
    <?php
    $attributes = array('class' => 'form-horizontal form-wizard-wrapper .custom-validation', 'id' => 'bba_form', 'name' => 'bba_form', 'enctype' => 'multipart/form-data', 'data-parsley-validate data-toggle' => "validator");
    echo form_open('', $attributes);
    ?>
    <div class="row">
        <div class="col-md-12">
        <div id="formerr"  class="tx-danger" style="display:none;"></div>
            <fieldset>
                <div class="w-100 pd-20 pd-sm-40">                
                    <div class="form-layout">

                        <div class="row mg-b-25">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Message <span class="tx-danger"> *</span></label>
                                    <textarea  class="form-control" type="text" name="description" id="description" placeholder="Write your message here"  maxlength="500" data-parsley-required="true" data-parsley-required-message="Please enter your message"></textarea>
                                    <div id="textarea_desc"></div>
                                </div>
                            </div><!-- col-12 -->
                        </div>

                        <div>
                            <div class="row w-100">
                                <div class="form-group col-md-6 ">
                                    <label for="exampleFormControlTextarea1"></label>
                                    <input type="file" class="filestyle" name="photograph" id="photograph" data-parsley-required="false" data-parsley-required-message="Please upload document" data-parsley-errors-container="#custom-document-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>"  data-file-id="<?php
                                    if (isset($docs[$document_id_photograph])) {
                                        echo $docs[$document_id_photograph]['id'];
                                    }
                                    ?>"accept="<?php echo allow_extension($file_allowed_type); ?>">

                                    <span id="custom-photograph-parsley-error"></span>
                                    <div>Maximum size: 2MB. Formats allowed: PDF, DOC, JPG, PNG, JPEG</div>
                                </div>

                            </div>
                        </div>

                    </div><!-- form-layout -->

                    <div class="row w-100 mt-3">
                        <div class="col-md-6">
                            <input type="hidden" name="ticket_id" id="ticket_id"  value="<?php echo $ticket_id; ?>"> 
                            <input type="button"  id="submit_query" class="btn btn-primary" value="Submit"> 
                        </div>
                    </div>
                </div>
            </fieldset> 

    <?php form_close(); ?>
        </div>
    </div>
    <?php
}
?>