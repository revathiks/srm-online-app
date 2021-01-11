<div class="row">
    <div class="col-8"></div>
    <div class="col-4 float-right" >
    <?php if($sidebar == 'is_international'){ ?>
    <a href="<?php echo base_url('queries').'?is_international=1'; ?>">
    <button class="btn btn-primary dropdown-toggle waves-effect waves-light" type="button">
      My Queries
    </button>
    </a>
    <?php } else { ?>
    <a href="<?php echo base_url('queries'); ?>">
    <button class="btn btn-primary dropdown-toggle waves-effect waves-light" type="button">
      My Queries
    </button>
    </a>
    <?php } ?> 
    </div>
    </div>
   <div class="row">
     <div class="col-12">
   
        <?php
       /*  echo "<pre>";
        print_r($personal_detail_list);
        echo "</pre>"; */
        $options=array();
        if(!empty($category_list)){            
            foreach($category_list as $category){
                $options[$category['category_name']][$category['cat_w_sub_cat_id']]=$category['sub_category_name'];
            }
        }
         
        $file_allowed_type = FILE_ALLOWED_TYPE;
        //name
        $fname=$personal_detail_list['data']['first_name'];
        $lname=$personal_detail_list['data']['last_name'];
        $firstname=isset($fname)?$fname:'';
        $lastname=isset($lname)?$lname:'';
        $name=$firstname." ".$lastname;
        
        $attributes = array('class' => 'form-horizontal form-wizard-wrapper .custom-validation', 'id' => 'bba_form', 'name' => 'bba_form', 'enctype' => 'multipart/form-data', 'data-parsley-validate data-toggle' => "validator");
        echo form_open('', $attributes);
        ?>
        <div id="formarea">        
        <fieldset>
            <div class="w-100 pd-20 pd-sm-40">                
                <div class="form-layout">
                    <div class="row mg-b-25">
                         <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Name <span class="tx-danger"> *</span></label>
                                <input class="form-control" type="text" name="name" id="name" placeholder="Enter Your Name" placeholder="Your Your Name" maxlength="100" data-parsley-required="true"  data-parsley-required-message="Please Enter Name" data-parsley-length="[1, 100]" value="<?php echo $name;?>" readonly>
                            </div>
                        </div><!-- col-12 -->
                    </div>
                    <div class="row mg-b-25">
                         <div class="col-lg-12">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Query Category <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="Query Category" tabindex="-1" aria-hidden="true" name="category" id="category" title="Query Category" data-parsley-required="true" data-parsley-required-message="Please Select Category" data-parsley-errors-container="#custom-category-parsley-error" data-parsley-trigger="change">
                                   <option value="">Select</option>
                                    <?php if(!empty($options)) {
                                        foreach($options as $k => $option){
                                            $optgroup=$k;
                                            ?>
                                           <optgroup label='<?php echo $optgroup;?>'><?php echo $optgroup;?>
                                           </optgroup>
                                            <?php 
                                            foreach($option as $ind=> $opt){
                                                ?>
                                                <option value='<?php echo $ind;?>'><?php echo $opt;?></option>
                                                <?php 
                                            }
                                            
                                        }
                                    }?>
                                </select>
                                <span id="custom-category-parsley-error"></span>

                            </div>
                        </div><!-- col-4 -->
                    </div>
                    
                     <div class="row mg-b-25">
                         <div class="col-lg-12">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Select Form <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="Select Form" tabindex="-1" aria-hidden="true" name="form_id" id="form_id" title="Select Form" data-parsley-required="true" data-parsley-required-message="Please Select Form" data-parsley-errors-container="#custom-form_id-parsley-error" data-parsley-trigger="change">
                                    <option value="">Select Form</option>
                                    
                                    
                                </select>
                                <span id="custom-form_id-parsley-error"></span>
                            </div>
                        </div><!-- col-12 -->
                    </div>
                    
                    <div class="row mg-b-25">
                         <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Query's Description <span class="tx-danger"> *</span></label>
                                <textarea  class="form-control" type="text" name="description" id="description" placeholder="Ask your Query"  maxlength="500" data-parsley-required="true" data-parsley-required-message="Please enter description"></textarea>
                           <div id="textarea_desc"></div>
                            </div>
                        </div><!-- col-12 -->
                    </div>
                    
                    <div>
                        <div class="row w-100">
                            <div class="form-group col-md-6 ">
                                <label for="exampleFormControlTextarea1"></label>
                                <input type="file" class="filestyle" name="photograph" id="photograph" data-parsley-required="false" data-parsley-required-message="Please upload document" data-parsley-errors-container="#custom-document-parsley-error" data-parsley-max-file-size="<?php echo MAX_FILE_SIZE; ?>" data-max-file-size-js="<?php echo MAX_FILE_SIZE_JS; ?>" data-parsley-file-extension="<?php echo $file_allowed_type; ?>"  data-file-id="<?php if (isset($docs[$document_id_photograph])) {
                                    echo $docs[$document_id_photograph]['id'];
                                } ?>"accept="<?php echo allow_extension($file_allowed_type); ?>">
                               
                                <span id="custom-photograph-parsley-error"></span>
                            <div>Maximum size: 2MB. Formats allowed: PDF, DOC, JPG, PNG, JPEG</div>
                            </div>
                            
                        </div>
                    </div>
                        
                </div><!-- form-layout -->
                <div id="formerr"  class="tx-danger" style="display:none;"></div>
                <div class="row w-100 mt-3">
                    <div class="col-md-6">
                       <input type="button"  id="submit_query" class="btn btn-primary" value="Submit"> 
                    </div>
                </div>
            </div>
        </fieldset> 
        </div>
        <?php form_close(); ?><!-- form -->
</div>                           
</div>
<!-- end row -->
<div class="row" id="thankyou_div" style="display: none">
    <div class="col-12">
        <div>Dear <?php echo $name; ?> , <div>
           <p> We are in receipt of your query. Your query will be answered shortly. You may check the status of your query at My Queries.</p>
            
            <div>Best wishes,</div>
            <div>SRM Group Of Institutions</div>
        </div>
        </div>
        <div class="row w-100 mt-3">
            <div class="col-md-6">
              <a href="<?php echo base_url()?>queries"><input type="button"  id="submit_query" class="btn btn-primary" value="OK"></a>
            </div>
       </div>
    </div>
</div>