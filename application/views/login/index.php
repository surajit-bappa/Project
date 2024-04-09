<?php $this->load->view('login_header'); ?>
<script type="text/javascript">

    $(document).ready(function() {
	
        $("#signinForm").validate({
            rules: {
                login_type: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 5
                },
                captcha: {
                    required: true
                   
                }
            },
            messages: {
                login_type: {
                    required: "Please select login type",
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                 captcha: {
                    required: "Please enter the text"
                   
                }
            }
        });
			 });
</script>
   <script>
       $(document).ready(function(){
           $('.captcha-refresh').on('click', function(){
               $.get('<?php echo base_url().'login/refresh'; ?>', function(data){
                   $('#image_captcha').html(data);
               });
           });
       });
   </script>
<body class="login-body">
<div class="container">
	<form class="cmxform form-signin" id="signinForm" action="<?php echo base_url(); ?>login/do_login" method="POST">
		 <input type="hidden" name="security_code" value="<?php echo hash('sha256',strtoupper($cap['word']).$this->config->item('encryption_key')) ?>">
		<h2 class="form-signin-heading">sign in now</h2>
		<div class="login-wrap">
			<div class="user-login-info">
				Login Type <font color="red">*</font> : 
				<select class="form-control" id="login_type" name="login_type">
                	<option value="" selected="">Select Login Type</option>
                	<?php if(!empty($loginTypes)){
                     foreach ($loginTypes as $key => $value) {
                     	?>
                     	<option value="<?php echo $value->username;?>"><?php echo $value->user_type;?></option>
                  <?php   
                   }

                }
                ?>							
											
			</select>          
				
				<?php echo form_error('login_type'); ?>
				<br>
				Password <font color="red">*</font>:<input type="password" class="form-control" name="password" placeholder="Password">
				<br>
				<?php echo form_error('password'); ?>
				Enter the Text <font color="red">*</font>:
	
				 <div class="captcha-area clearfix">
                                    <div class="captcha-img">
                                      <p id="image_captcha">  <?php echo $cap['image']; ?></p>                                    
                                    <a href="javascript:void(0);" id="change_captcha2" class="captcha-refresh"><img src="<?php echo ASSETS_URL;?>images/refresh.png" /></a>
                                    <div class="cpatcha-code clearfix">
                                        <div class="imputOuter">
                                            <div class="inputWrap">
												<input type="text" class="form-control" name="captcha" placeholder="Captcha">
											</div>
											<?php echo form_error('captcha'); ?>
                                       </div>
                                    </div>
									</div>
                                </div> 
			</div>
			<button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
		</div>
	</form>
	<!-- Modal -->
	<form class="cmxform" id="forgetForm" action="<?php echo base_url(); ?>login/do_forgotpassword" method="POST">
		<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Forgot Password ?</h4>
				</div>
				<div class="modal-body">
					<p>Enter your e-mail address below to reset your password.</p>
					<input type="h" name="email" placeholder="Email" id="forget_email" autocomplete="off" class="form-control placeholder-no-fix">
		
				</div>
				<input type="hidden" id="mailexist" name="mailexist" value="">
				<div class="modal-footer">
					<button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
					<button class="btn btn-success" href="#myModal1" type="submit">Submit</button>
				</div>
				</div>
			</div>
		</div>
	</form>
	
	<!-- modal -->
</div>
<?php $this->load->view('login_footer'); ?>
