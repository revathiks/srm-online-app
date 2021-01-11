<style>
.align-card {
background:#f8f8fa;	
}
.align-card > .card-body {
padding:0;	
}
</style>
<div class="row">


    <div class="col-12">
        <div class="">
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                    <?php //print_r($ticket_list);?>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    <div class="d-block">
                                        <div class="d-inline-block">
                                            <i class="fas fa-ticket-alt query_ticket_icon"></i>
                                        </div>
                                        
                                        <div class="d-inline-block">
                                            <h5>Query</h5>                                           
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="d-block">
                                        <div class="d-inline-block">
                                            <i class="fas fa-network-wired query_ticket_icon"></i>
                                        </div>                                        
                                        <div class="d-inline-block">
                                            <h5>Category</h5>                                            
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="d-block">
                                        <div class="d-inline-block">
                                            <i class="fas fa-calendar-alt query_ticket_icon"></i>
                                        </div>                                        
                                        <div class="d-inline-block">
                                            <h5>Date</h5>                                           
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="d-block">
                                        <div class="d-inline-block">
                                            <i class="fas fa-retweet query_ticket_icon"></i>
                                        </div>                                        
                                        <div class="d-inline-block">
                                            <h5>Status</h5>                                           
                                        </div>
                                    </div>
                                </th>
                                <th>
                                    <div class="d-block">
                                        <div class="d-inline-block">
                                            <i class="fab fa-rocketchat query_ticket_icon"></i>
                                        </div>                                        
                                        <div class="d-inline-block">
                                            <h5>Feedback</h5>                                           
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                            <tbody>
                            <?php if(!empty($ticket_list)) { 
                                foreach($ticket_list as $ticket) {
                                    $ticket_id=$ticket['ticket_id'];
                                    $desc=$ticket['description'];
                                    $desclen=strlen($desc);
                                    if($desclen > 50){
                                    $desc = substr($desc,0,50) . "...";
                                    }
                                    $status_name=$ticket['status_name'];
                                    $created_at=$ticket['created_at'];
                                    $category=$ticket['sub_category_name'];
                                    
                                    $small = substr($big, 0, 100);
                                    $status_id=$ticket['status_id'];
                                    $statusClass="primary";
                                    if($status_id==TICKETS_CLOSED_STATUS){
                                        $statusClass="success";
                                    }
                                    if(!empty($created_at)){
                                        $created_at= date("d/m/Y h:i:s", strtotime($created_at));
                                    }
                                    ?>
                                <tr>
                                    <td><a href="<?php echo base_url();?>ticket_details/<?php echo $ticket_id;?>"><?php echo $desc;?></a></td>
                                    <td><?php echo $category;?></td>
                                    <td><?php echo $created_at;?></td>
                                    <td><span class="badge badge-<?php echo $statusClass;?>"><?php echo $status_name;?></span></td>
                                    <td></td>
                                </tr>
                                 <?php 
                                }
                                }
                                else {
                                ?>
                                <tr><td colspan='5'>No Ticket(s) Found</td></tr>
                                <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>