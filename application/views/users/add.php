<?php $this->load->view('header'); ?>
<script type="text/javascript">

$(function() {  
        $("#frmForAdd").submit(function(){
            if ($('#scheme_type').commonCheck() & $('#first_name').commonCheck() & $('#last_name').commonCheck() & $('#datepicker').commonCheck()  & $('#phone').commonCheck() & $('#email').validateEmail()) {
                return true;
            }
            return false;
        }); 
    }); 
</script>
 <script>
        $(function()
          {
                $('#datepicker').datepicker({
                 autoclose: true,
                 dateFormat: 'yy-mm-dd',
                 endDate: "currentDate",
                 maxDate: new Date()
       })
        
      });
</script>

<section id="main-content" class="">
<section class="wrapper">
	<div class="row">
            <div class="col-lg-12">
                <section class="panel">		  
                        <header class="panel-heading">
                                <span>Add User</span>
                        </header>
                        <div class="panel-body">				
                            <form class="form-horizontal no-margin" id="frmForAdd" name="frm" action="<?php echo base_url();?>users/do_add" method="POST">
                            
                          <div class="form-group">
                                        <label class="col-sm-3 control-label">Scheme Type</label>
                                        <div class="col-sm-6">
                                        <select class="form-control" id="scheme_type" name="scheme_type">
					<option value="">Select Scheme</option>
					<?php
					if((!empty($schemes)) && ($schemes != ''))
					{
						foreach($schemes AS $schemes)
						{
							echo '<option value="'.$schemes->id.'">'.ucfirst($schemes->name).'</option>';
						}
					}
					?>
					</select>
                                        <?php echo form_error('scheme_type'); ?>
                                        </div>
                                </div>
                                
                                <div class="form-group">
                                        <label class="col-sm-3 control-label">First Name*</label>
                                        <div class="col-sm-6">
                                                <input type="text" class="form-control custom-required" id="first_name" name="first_name">
                                                 <?php echo form_error('first_name'); ?>
                                        </div>
                                         
                                </div>
                               
                                <div class="form-group">
                                        <label class="col-sm-3 control-label">Last Name*</label>
                                        <div class="col-sm-6">
                                                <input type="text" class="form-control custom-required" id="last_name" name="last_name">
                                                 <?php echo form_error('last_name'); ?>
                                        </div>
                                        
                                </div>
                                
                                <div class="form-group">
                                        <label class="col-sm-3 control-label">Email*</label>
                                        <div class="col-sm-6">
                                                <input type="text" class="form-control custom-required" id="email" name="email">
                                                 <?php echo form_error('email'); ?>   
                                        </div>
                                     
                                </div>
				
				<div class="form-group">
                                        <label class="col-sm-3 control-label">Mobile Number*</label>
                                        <div class="col-sm-6">
                                                <input type="text" maxlength="10" class="form-control custom-required" id="phone" name="phone">
                                                 <?php echo form_error('phone'); ?>   
                                        </div>
                                </div>
				<div class="form-group">
                                        <label class="col-sm-3 control-label">Gender*</label>
                                         <div class="col-lg-6">
                                            
                                            <label class="checkbox-inline">
                                                <input type="radio" id="" name="gender" value="Male" checked="true"><label>Male</label>

                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="radio" id="" name="gender" value="Female"><label>Female</label>
                                            </label>
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-sm-3 control-label"> Date of Birth*</label>
                                         <div class="col-lg-6">
                                           <input type="text" class="form-control date_of_birth" id="datepicker" name="date_of_birth" placeholder="Date of Birth" autofocus required readonly="true">
                                       <?php echo form_error('date_of_birth'); ?>
                                        </div>
                                </div> 
				<div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-3">
                                                <input type="submit" name="submit" value="Add" class="btn btn-info">
                                                <button class="btn" type="button" onClick="javascript:window.location='<?php echo base_url();?>users';" >
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