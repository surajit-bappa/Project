<?php $this->load->view('header');  ?>


<section id="main-content">
        <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        MIS
                  
                        
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <div class="clearfix">
                    </div>


                        <table class="AdminListTable table table-striped table-bordered" id="example5">
                            <thead>
                              <tr>
                              	<th>Total no of user count</th>
                                <th>Forwarded to the senior level count</th>
                                <th>Forwarded to the admin level count</th>
				                <th>Approved user count</th>
				                <th>Rejected user count</th>
                              </tr>
                            </thead>
		                <tbody>
						<tr>
						   <td><?php echo count($total_user_count); ?></td>
						   <td><?php echo count($total_forwardedto_senior_level_count);?></td>
						   <td><?php echo count($total_forwardedto_admin_level_count);?></td>
						   <td><?php echo count($total_approved_count);?></td>
						   <td><?php echo count($total_rejected_count);?></td>
						</tr>
                        </tbody>
                        </table>
                        </div>
                     </div>
                    </section>
                 </div>
		
		</div>
	    </section>
</section>
<?php $this->load->view('footer'); ?>