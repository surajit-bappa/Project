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
                        Schemes List
                        <span class="tools pull-right">
                            <div class="btn-group" style="margin-top:-6px;">
                                <a style="color:#fff;" href="<?php echo base_url();?>schemes/add" id="editable-sample_new" class="btn btn-primary" >
                               Add New Scheme
                                </a>
                            </div>
                         </span>
                        
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <div class="clearfix">
                    </div>

                        <div class="space15 searchArea">
                           <form class="form-inline " action="<?php echo base_url(); ?>schemes" method="POST" style="padding-top: 18px;" id="searchFormId">
				<div class="form-group">
				   <?php  //print_r($searchKeyVal); ?>
				   <input type="hidden" id="do_search" name="do_search" value="do_search">
				   <label class="sr-only" for="exampleInputEmail3">Search</label>
				   <input type="text" class="form-control" name="scheme_name" placeholder="Search by scheme" value="<?php echo str_replace("%20"," ",$this->my_functions->get_search_values($searchKeyVal,'scheme_name')); ?>">
				</div>
			
				<input type="hidden" id="orderby" name="orderby" value="<?php echo $this->my_functions->get_search_values($searchKeyVal,'orderby') ?>">
				<input type="hidden" id="sortval" name="sortval" value="<?php echo $this->my_functions->get_search_values($searchKeyVal,'sortval') ?>">
                                <input type="submit" class="btn btn-info" value="Search" name="search">
				
				<button onclick="window.location = '<?php echo base_url().'schemes'; ?>'" type="button" class="btn btn-success">Clear Search</button>
			
                           </form>
                            
                        </div>

                    
                        <table class="AdminListTable table table-striped table-bordered" id="example5">
                            <thead>
                              <tr>
                              	<th class="sortingList <?php echo $this->my_functions->active_sort($searchKeyVal,'name'); ?>" data-orderby="name" data-sortval="<?php echo $this->my_functions->get_search_values($searchKeyVal,'sortval'); ?>"> Scheme Name</th>
                                <th>Authorized By</th>
                                <th>Status</th>
				                <th style="width: 10%;">Action</th>
                              </tr>
                            </thead>
		                            <tbody>
						<?php
						if(!empty($schemes)){
								foreach($schemes AS $scheme){
									
						?>
						<tr>
						  <td><?php echo $scheme->name; ?></td>
						  <td>
						  	<?php
						  	 echo get_authorized_by($scheme->authorized_by);
						  	?>
						  </td>
							<td><?php 
							$green = "<p style='color:green'>Active<p>";
							$red = "<p style='color:red'>Deactive<p>";
							if($scheme->status==1){

                                 echo $green;;
							}
							else{
								echo $red ;
							}
							?>
								
							</td>
						 
						  <td>
						  	<div class="box-tools">
                             
								<a href="<?php echo base_url(); ?>schemes/edit/<?php echo urlencode(base64_encode($scheme->id)); ?>" title="Edit" data-placement="top" class="tooltips">
										<i class="fa fa-edit"></i>
							</a> 
	
						       <a href="<?php echo base_url(); ?>schemes/delete/<?php echo urlencode(base64_encode($scheme->id)); ?>" onclick="javascript:return confirm('Are you  sure you want to delete?')" title="Delete" class="tooltips">
										<i class="fa fa-trash-o"  style="padding-right:3px;"></i>
						       </a>
						       
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
				echo $this->my_functions->myPagination($total_count,10,(array_key_exists('page',$searchKeyVal))? $searchKeyVal['page'] : '1',base_url().'schemes'.$newUrl);
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