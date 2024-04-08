<?php $this->load->view('header'); ?>

<script type="text/javascript">

$(document).ready(function() {        
   $("#frmForAdd").validate({
            rules: {
                schemeName: {
                    required: true,
                },
                authorized_by: {
                    required: true,
                    
                }
            },
            messages: {
                schemeName: {
                    required: "Please enter scheme name",
                },
                authorized_by: {
                    required: "Please select authorized by"
                   
                }
            }
        });
});
</script>

<section id="main-content" class="">
<section class="wrapper">
	<div class="row">
            <div class="col-lg-12">
                <section class="panel">		  
                        <header class="panel-heading">
                                <span>Edit Scheme</span>
                        </header>
                        <div class="panel-body">				
                            <form class="form-horizontal no-margin" id="frmForAdd" name="frm" action="<?php echo base_url();?>schemes/do_edit" method="POST" enctype="multipart/form-data">
								<input type="hidden" id="user_id" name="id" value="<?php echo $schemes->id; ?>">

                                <div class="form-group">
                                        <label class="col-sm-3 control-label">Scheme Name*:</label>
                                        <div class="col-sm-6">
                                                <input type="text" class="form-control custom-required" id="schemeName" name="schemeName" value="<?php echo $schemes->name;?>">
                                        </div>
                                </div>
                                 <div class="form-group">
                                        <label class="col-sm-3 control-label">Authorized By </label>
                                        <div class="col-sm-6">
                                        <select class="form-control" id="authorized_by" name="authorized_by">
                                        <option value=''>Select Authorized By</option>
                                         <?php 
                                              if(!empty($authorization_list)){
                                                 foreach ($authorization_list as $key => $value) { 
                                             
                                                $selected = '';
                                                if($value->id == $schemes->authorized_by)
                                                {
                                                    $selected = 'selected';
                                                }
                                                echo '<option value="'.$value->id.'" '.$selected.'>'.ucfirst($value->user_type).'</option>';   
                                                                                            
                                                }
                                               }
                                          ?>
                                        </select>
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-sm-3 control-label">Status</label>
                                         <div class="col-lg-6">
                                              <label class="checkbox-inline">
                                                   
                                            <label class="checkbox-inline">
                                                <input type="radio" id="status" name="status" value="1" <?php if($schemes->status=='1') {?>checked="checked" <?php } ?>>  <label>Yes</label>
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="radio" id="status" name="status" value="0"<?php if($schemes->status=='0') {?>checked="checked" <?php } ?>><label>No</label>
                                            </label>
                                        </div>
                                    </div>
				                 <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-3">
                                                <input type="submit" name="submit" value="Update" class="btn btn-info updatebutton">
                                                <button class="btn" type="button" onClick="javascript:window.location='<?php echo base_url();?>schemes';" >
                                                        Cancel
                                                </button>
                                        </div>
                                </div>
				
                                <div class="clearfix"></div>
                            </form>
                        </div>			
                </section>
            </div>
	</div>
</section>
</section>
  
<?php $this->load->view('footer'); ?>