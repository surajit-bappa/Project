<?php $this->load->view('header'); ?>
 <script src="http://localhost/Project/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="http://localhost/Project/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

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
<script type="text/javascript">
    $(function() {
        
        $("#frmForAdd").submit(function(){
            if ($('#scheme_type').commonCheck()  & $('#first_name').commonCheck() & $('#last_name').commonCheck() & $('#datepicker').commonCheck() & $('#mobile_no').commonCheck() & $('#email').validateEmail()) {
                return true;
            }
            return false;
        }); 
    });
    
    
    
</script>

<section id="main-content" class="">
<section class="wrapper">
	<div class="row">
            <div class="col-lg-12">
                <section class="panel">		  
                        <header class="panel-heading">
                                <span>Edit User</span>
                        </header>
                        <div class="panel-body">				
                            <form class="form-horizontal no-margin" id="frmForAdd" name="frm" action="<?php echo base_url();?>users/do_edit" method="POST" >
								<input type="hidden" id="user_id" name="id" value="<?php echo $users->id; ?>">
                                
                                <div class="form-group">
                            <label class="col-sm-3 control-label"> Scheme Type:</label>  
                   
                          <div class="col-sm-6">
                                 <select class="form-control" id="scheme_type" name="scheme_type">
                                    <option value="">Select Scheme Type</option>
                                    <?php 
                                              if(!empty($schemes)){
                                                 foreach ($schemes as $key => $value) { 
                                             
                                                $selected = '';
                                                if($value->id == $users->scheme_type)
                                                {
                                                    $selected = 'selected';
                                                }
                                                echo '<option value="'.$value->id.'" '.$selected.'>'.ucfirst($value->name).'</option>';   
                                                                                            
                                                }
                                               }
                                          ?>
                                   <?php echo form_error('scheme_type'); ?>
                                </select>          
                            </div>
                         </div>
                          
                            <div class="form-group">
                                    <label class="col-sm-3 control-label">First Name*:</label>
                                    <div class="col-sm-6">
                                            <input type="text" class="form-control custom-required" id="first_name" name="first_name" value="<?php echo $users->first_name;?>">
                                     <?php echo form_error('first_name'); ?>
                                    </div>
                            </div>
                            <div class="form-group">
                                        <label class="col-sm-3 control-label">Last Name*:</label>
                                        <div class="col-sm-6">
                                                <input type="text" class="form-control custom-required" id="last_name" name="last_name" value="<?php echo $users->last_name;?>">
                                           <?php echo form_error('last_name'); ?>
                                          </div>
                            </div>
                              <div class="form-group">
                                        <label class="col-sm-3 control-label">Email*:</label>
                                        <div class="col-sm-6">
                                                <input type="text" class="form-control custom-required" id="email" name="email" value="<?php echo $users->email;?>" onkeyup="emailCheck(this)">
                                                 <div class="emailError"></div>
                                                  <?php echo form_error('email'); ?>   
                                        </div>        
                            </div>

                            <div class="form-group">
                                        <label class="col-sm-3 control-label">Mobile Number*:</label>
                                        <div class="col-sm-6">
                                                <input type="test" class="form-control custom-required" id="mobile_no" name="phone" value="<?php echo $users->phone;?>" maxlength="10"  onkeyup="phoneCheck(this)">
                                                <div class="phoneError"></div>
                                                <?php echo form_error('phone'); ?>   
                                        </div>
                                         
                            </div>
                            <div class="form-group">
                                        <label class="col-sm-3 control-label">Gender*</label>
                                         <div class="col-lg-6">
                                            
                                            <label class="checkbox-inline">
                                                <input type="radio" id="" name="gender" value="Male" <?php if($users->gender=='Male') {?>checked="checked" <?php } ?> ><label>Male</label>

                                            </label>
                                            <label class="checkbox-inline">
                                                <input type="radio" id="" name="gender" value="Female"  <?php if($users->gender=='Female') {?>checked="checked" <?php } ?>><label>Female</label>
                                            </label>
                                        </div>
                                </div>
                          
                            <div class="form-group">
                                  <label class="col-sm-3 control-label">Date of Birth*:</label>   
                                  <div class="col-sm-6">
                                    <input type="text" class="form-control custom-required" id="datepicker" name="date_of_birth" readonly="true" value="<?php echo $users->date_of_birth;?>">
                                    <?php echo form_error('date_of_birth'); ?>
                             </div>
                            </div>
			                	<div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-3">
                                                <input type="submit" name="submit" value="Update" class="btn btn-info updatebutton">
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
</section>
<script type="text/javascript">
    function emailCheck(selectObject){

      var email = selectObject.value;
      var user_id = $('#user_id').val();

      $.ajax({
          url: "<?php echo base_url(); ?>users/checkEmail",
          type: 'post',
          data: {
            'email' : email,
            'user_id' : user_id,
             },
           success: function(response){
            if (response == 'taken' ) {

              $('.emailError').html("<b style='color: red;'>Sorry...This email already exists</b>");
               $('.updatebutton').attr("disabled", true);
            }else if (response == 'not_taken') {
                 $('.emailError').html('');
                 $('.updatebutton').attr("disabled", false);
                
            }
          }
      });
     }

    function phoneCheck(selectObject){

      var phone = selectObject.value;
      var user_id = $('#user_id').val();
     
      $.ajax({
          url: "<?php echo base_url(); ?>users/checkPhoneNo",
          type: 'post',
          data: {
            'phone' : phone,
            'user_id' : user_id,
          },
          success: function(response){
            if (response == 'taken' ) {

              $('.phoneError').html("<b style='color: red;'>Sorry...This phone number already exists</b>");
               $('.updatebutton').attr("disabled", true);
                
            }else if (response == 'not_taken') {
                 $('.phoneError').html('');
                 $('.updatebutton').attr("disabled", false);
            }
          }
      });
     }

  </script>
<?php $this->load->view('footer'); ?>