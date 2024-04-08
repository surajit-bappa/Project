<?php $this->load->view('header');  ?>

<script>
		
		$(function() {
				$(".sortingList").click(function(){
						orderby = $(this).data('orderby');
						sortval = $(this).data('sortval');
						if (sortval == 'ASC') {
								PutSortval = 'DESC';
						}
						else{
								PutSortval = 'ASC';
						}
						$('#searchFormId #orderby').val(orderby);
						$('#searchFormId #sortval').val(PutSortval);
						$('#searchFormId').submit();
				});
				
				
		});
</script>

<section id="main-content">
        <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Users List

                        <?php if($this->session->userdata('user_type') == 'Entry Level'){
				        ?>
                        <span class="tools pull-right">
                            <div class="btn-group" style="margin-top:-6px;">
                                <a style="color:#fff;" href="<?php echo base_url();?>users/add" id="editable-sample_new" class="btn btn-primary" >
                               Add New User
                                </a>
                            </div>
                         </span>
                         <?php
                           }

                         ?>
                        
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <div class="clearfix">
                    </div>

                        <div class="space15 searchArea">
                           <form class="form-inline " action="<?php echo base_url(); ?>users" method="POST" style="padding-top: 18px;" id="searchFormId">
				<div class="form-group">
				   <?php  //print_r($searchKeyVal); ?>
				   <input type="hidden" id="do_search" name="do_search" value="do_search">
				   <label class="sr-only" for="exampleInputEmail3">Search</label>
				   <input type="text" class="form-control" name="user_name" placeholder="Search by name or email" value="<?php echo str_replace("%20"," ",stripslashes(addslashes(rawurldecode($this->my_functions->get_search_values($searchKeyVal,'user_name'))))); ?>">
				</div>
				
				<input type="hidden" id="orderby" name="orderby" value="<?php echo $this->my_functions->get_search_values($searchKeyVal,'orderby') ?>">
				<input type="hidden" id="sortval" name="sortval" value="<?php echo $this->my_functions->get_search_values($searchKeyVal,'sortval') ?>">
                                <input type="submit" class="btn btn-info" value="Search" name="search">
				
				<button onclick="window.location = '<?php echo base_url().'users'; ?>'" type="button" class="btn btn-success">Clear Search</button>
				<?php if($this->session->userdata('user_type')=="Admin"){
					?>
				<button onclick="window.location = '<?php echo base_url().'users/user_pdf_download'; ?>'" type="button" class="btn btn-info"><i class="fa fa-download"></i>Pdf Download</button>
				<?php
			     }
			     ?>
                           </form>
                            
                        </div>

                    
                        <table class="AdminListTable table table-striped table-bordered" id="example5">
                            <thead>
                              <tr>
                                <th class="sortingList <?php echo $this->my_functions->active_sort($searchKeyVal,'name'); ?>" data-orderby="name" data-sortval="<?php echo $this->my_functions->get_search_values($searchKeyVal,'sortval'); ?>"> Name</th>
                                <th>Scheme</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Gender</th>
                                <th>Date of Birth</th>
				                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
						<?php
						if(!empty($users)){
								foreach($users AS $user){
									
						?>
						<tr>

						  <td><?php echo $user->full_name; ?></td>
						  <td><?php echo get_scheme_type($user->scheme_type);?></td>
						  <td><?php echo $user->email; ?></td>
						  <td><?php echo $user->phone; ?></td>
						  <td><?php echo $user->gender; ?></td>
						  <td><?php echo $user->date_of_birth; ?></td>
						  <td style="text-align:center">

						  	<?php
						  	$green = "<p style='color:green;text-align:center;font-weight:bold'>Approved By Admin<p>";
							$red = "<p style='color:red;text-align:center;font-weight:bold'>Rejected By Admin<p>";

                              if($this->session->userdata('user_type')=="Entry Level"){
						  	     if($user->forwarded_by==0){
						  		?>

                             <a href="<?php echo base_url();?>users/forward_to/<?php echo urlencode(base64_encode($user->id)); ?>" onclick="javascript:return confirm('Are you  sure you want to forward?')" title="Forward"><i class="fa fa-forward"></i> </a>
                             &nbsp;&nbsp;&nbsp
								<a href="<?php echo base_url(); ?>users/edit/<?php echo urlencode(base64_encode($user->id)); ?>" title="Edit" data-placement="top" class="tooltips">
										<i class="fa fa-edit"></i>
							</a> 
							&nbsp;&nbsp;&nbsp;
	
						       <a href="<?php echo base_url(); ?>users/delete/<?php echo urlencode(base64_encode($user->id)); ?>" onclick="javascript:return confirm('Are you  sure you want to delete?')" title="Delete" class="tooltips">
										<i class="fa fa-trash-o"  style="padding-right:3px;"></i>
						       </a>
						       <?php
						        }else{

						        	if($user->approved_by==1){

						    			echo $green;
						    			
						    		}elseif ($user->rejected_by==1) {
						    			echo $red;
						    		}else{
						        	$forwarded_by = $user->forwarded_by;
						        	$approved_to = $user->approved_to;
						        	if($approved_to==0){
                                       $forwarded_to = $user->forwarded_to;
						        	}else{
						        	   $forwarded_to = $user->approved_to;	
						        	}
						        	
						        	?>
                               
						        	<b>Forwarded From  <?php echo get_authorized_by($forwarded_by);?> To <?php echo get_authorized_by($forwarded_to);?> </b>

						       <?php 
						      }
						    }
						   }else if(($this->session->userdata('user_id') == $user->forwarded_to) && ($this->session->userdata('user_type') == 'Senior Level')){
						     	if($user->approved_to==0){
						   	?>
                               <a href="<?php echo base_url();?>users/forward_to/<?php echo urlencode(base64_encode($user->id)); ?>" onclick="javascript:return confirm('Are you  sure you want to forward?')" title="Forward"><i class="fa fa-forward"></i> </a>
						       
						   <?php
					    	}else{

                                   if($user->approved_by==1){

						    			echo $green;
						    			
						    		}elseif ($user->rejected_by==1) {
						    			echo $red;
						    		}else{

					    		    $forwarded_by = $user->forwarded_to;
						        	$forwarded_to = $user->approved_to;
						        	?>
                               
						        	<b>Forwarded From  <?php echo get_authorized_by($forwarded_by);?> To <?php echo get_authorized_by($forwarded_to);?> </b>

						       <?php 
						      }
					    	 }
					    	}else if(($this->session->userdata('user_id') == $user->forwarded_to) && ($this->session->userdata('user_type') == 'Admin Level') or ($this->session->userdata('user_id') == $user->approved_to)){

					    		

					    		if($user->approved_by==1){

					    			echo $green;
					    			
					    		}elseif ($user->rejected_by==1) {
					    			echo $red;
					    		}
					    		else{

					    		?>
					    		<a class="btn btn-primary" href="<?php echo base_url();?>users/approved_by/<?php echo urlencode(base64_encode($user->id)); ?>" onclick="javascript:return confirm('Are you  sure you want to approve?')" title="Approve">Approve</a>
					    		<a class="btn btn-danger" href="<?php echo base_url();?>users/rejected_by/<?php echo urlencode(base64_encode($user->id)); ?>" onclick="javascript:return confirm('Are you  sure you want to reject?')" title="Reject">Reject</a>

					       <?php
					         }
					       	}else{
					        $forwarded_by = $user->forwarded_by;
					       	$forwarded_to = $user->approved_to;
						        	?>
                               
						        	<b>Forwarded From  <?php echo get_authorized_by($forwarded_by);?> To <?php echo get_authorized_by($forwarded_to);?> </b>

					    <?php   }
						?>						     
						  </td>
						</tr>
				

					<?php
						
					}
				}
				else{
						echo '<tr><td colspan="4"><div style="color:#FF3333;text-align:center;">No result found</div></td></tr>';
				}
				?>
                            </tbody>
                        </table>
                        	<div class="paginationArea">
				<?php
				$newUrl = $this->my_functions->our_assoc_to_uri($searchKeyVal,'page');
				echo $this->my_functions->myPagination($total_count,10,(array_key_exists('page',$searchKeyVal))? $searchKeyVal['page'] : '1',base_url().'users'.$newUrl);
						?>
				</div>
						
                        </div>
                     </div>
                    </section>
                 </div>
		
		</div>
	    </section>
</section>
<!-- <script type="text/javascript">
$(function () {
    $('#example5').DataTable({
      'paging'      : true,
      'lengthChange': true,
      //'searching'   : true,
      //'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script> -->

<?php $this->load->view('footer'); ?>