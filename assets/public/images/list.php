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
				
				$('.changeStatus').click(function(){
						id = $(this).data('id');
						$('#changeStatus'+id).html('<img src="<?php echo $this->config->item('css_images_js_base_url'); ?>img/ajax-loader-admin.gif" style="width: 11px;">');
						$.ajax({
								type: "POST",
								url: "<?php echo base_url(); ?>banner/update_status/"+id,
								success: function(data)
								{
										$('#changeStatus'+id).html('');
										if (data =='id_not_found') {
												alert('id not found');
										}
										else{
												$('#changeStatus'+id).html(data);
										}
								}
					   });
						
				})
		});
</script>

<section id="main-content">
        <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Banner List
                        <span class="tools pull-right">
                            <div class="btn-group" style="margin-top:-6px;">
                                <a style="color:#fff;" href="<?php echo base_url();?>banner/add" id="editable-sample_new" class="btn btn-primary" >
                                      Add New <i class="fa fa-plus"></i>
                                </a>
                            </div>
                         </span>
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <div class="clearfix">
                    </div>

                        <div class="space15 searchArea">
                           <form class="form-inline " action="<?php echo base_url(); ?>banner" method="POST" style="padding-top: 18px;" id="searchFormId">
								<div class="form-group">
								   <input type="hidden" id="do_search" name="do_search" value="do_search">
								   <label class="sr-only" for="exampleInputEmail3">Search</label>
								   <input type="text" class="form-control" name="name" placeholder="Search by Title" value="<?php echo str_replace("%20"," ",$this->my_functions->get_search_values($searchKeyVal,'name')); ?>">
								</div>
								
							    <input type="hidden" id="orderby" name="orderby" value="<?php echo $this->my_functions->get_search_values($searchKeyVal,'orderby') ?>">
								<input type="hidden" id="sortval" name="sortval" value="<?php echo $this->my_functions->get_search_values($searchKeyVal,'sortval') ?>">
                             <input type="submit" class="btn btn-info" value="Search" name="search">
							 <button onclick="window.location = '<?php echo base_url().'banner'; ?>'" type="button" class="btn btn-success">Clear Search</button>
                           </form>
                        </div>
                    
                        <table class="AdminListTable table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th class="sortingList <?php echo $this->my_functions->active_sort($searchKeyVal,'title'); ?>" data-orderby="title" data-sortval="<?php echo $this->my_functions->get_search_values($searchKeyVal,'sortval'); ?>">Title</th>
                                <th style="width: 40%;">Image</th>
				<th style="width: 20%;">Action</th>
                              </tr>
                            </thead>
                            <tbody>
			   <?php
				if(!empty($banners)){
				foreach($banners AS $banner){
						
			    ?>
                                <tr>
				    <td> <?php echo $banner->title; ?> </td>
                                     <td><img src="<?php echo base_url(); ?> banner/thumb/ <?php echo $banner->image; ?>" > </td>
				   
				     
                                      
				      
							
										  <td>
												<a href="<?php echo base_url(); ?>banner/edit/<?php echo $banner->id; ?>" title="Edit" data-placement="top" class="tooltips">
														<i class="fa fa-edit"></i>
										        </a> 
					
										       <a href="<?php echo base_url(); ?>banner/remove/<?php echo $banner->id; ?>" onclick="javascript:return confirm('Are you  sure you want to delete?')" title="Delete" class="tooltips">
														<i class="fa fa-trash-o"  style="padding-right:3px;"></i>
										       </a>
										       <a href="javascript:void(0);" data-id="<?php echo $banner->id; ?>" id="changeStatus<?php echo $banner->id; ?>" title="Update Status" class="tooltips changeStatus"><?php echo ($banner->status=='1') ? '<i class="fa fa-unlock"></i>' : '<i class="fa fa-lock"></i>'; ?></a>
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
						
						<!--for pagination start-->
						<div class="paginationArea">
						<?php
								//<-- to remove any key like $this->my_functions->our_assoc_to_uri($searchKeyVal,'page,name') -->
								$newUrl = $this->my_functions->our_assoc_to_uri($searchKeyVal,'page');
								echo $this->my_functions->myPagination($total_count,PER_PAGE,(array_key_exists('page',$searchKeyVal))? $searchKeyVal['page'] : '1',base_url().'banner'.$newUrl);
						?>
						</div>
						<!--for pagination end-->
						
                        </div>
                     </div>
                    </section>
                 </div>
			

        </div>
	    </section>
</section>


<?php $this->load->view('footer'); ?>