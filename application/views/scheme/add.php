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
                    required: "Please select approved by"
                   
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
                                <span>Add Scheme</span>
                        </header>
                        <div class="panel-body">				
                            <form class="form-horizontal no-margin" id="frmForAdd" name="frm" action="<?php echo base_url();?>schemes/do_add" method="POST" >
                                <div class="form-group">
                                        <label class="col-sm-3 control-label">Scheme Name <font color="red">*</font>:</label>
                                        <div class="col-sm-6">
                                                <input type="text" class="form-control custom-required" id="schemeName" name="schemeName">
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-sm-3 control-label">Approved By <font color="red">*</font>:</label>
                                        <div class="col-sm-6">
                                        <select class="form-control" id="authorized_by" name="authorized_by">
                                        <option value=''>Select Approved By</option>
                                         <?php 
                                      if(!empty($user_level_list)){
                                         foreach ($user_level_list as $key => $value) { 
                                     ?>
                                       <option value='<?php echo $value->id;?>'><?php echo $value->user_type;?></option> 
                                      <?php
                                      }
                                     }
                                       ?>
                                        </select>
                                        </div>
                                </div>
                                         <div class="form-group">
                                        <label class="col-sm-3 control-label">Status <font color="red">*</font>:</label>
                                         <div class="col-lg-6">
                                            <label class="checkbox-inline">
                                                <input type="radio" id="status" name="status" value="1" checked="true">  <label>Yes</label>
                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="radio" id="status" name="status" value="0" >  <label>No</label>
                                            </label>
                                        </div>
                                </div>
				<div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-3">
                                                <input type="submit" name="submit" value="Add" class="btn btn-info">
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
<?php $this->load->view('footer'); ?>
