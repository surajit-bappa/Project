<?php $this->load->view('reset_password_header'); ?>
<script type="text/javascript">
//var Script = function () {
    $(document).ready(function() {
	//chck_mail();
	//$("#forgetForm").blur(function() { chck_mail(); });
	
        $("#resetpasswordForm").validate({
            rules: {
                old_password: {
                    required: true,
                    minlength: 5
                },
                new_password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo : "#new_password"
                }
            },
            messages: {
                old_password: {
                    required: "Please provide old password",
                    minlength: "Your password must be at least 5 characters long"
                },
                new_password: {
                    required: "Please provide new password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password: {
                    required: "Please provide confirm password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo : 'New password and confirm password does not match',
                }
            }
        });
	
	 
	 });

</script>

<body class="login-body">
<div class="container">
	<form class="cmxform form-signin" id="resetpasswordForm" action="<?php echo base_url(); ?>login/do_reset_password" method="POST">
		<h2 class="form-signin-heading">Reset Password</h2>
		<div class="login-wrap">
			<input type="hidden" class="form-control" name="email" value="<?php echo $email;?>">
			<div class="user-login-info">
			 Old Password* : <input type="password" class="form-control" name="old_password" placeholder="Old Password" class="validate[required,minSize[5]]">
				<br>
				New Password* :<input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" class="validate[required,minSize[5]]">
				<br>
				Confirm New Password* :<input type="password" class="form-control" name="confirm_password" placeholder="Confirm New Password" class="validate[required,minSize[5],equals[new_password]]">
			</div>
			
			<button class="btn btn-lg btn-login btn-block" type="submit">Update</button>
			<button class="btn btn-lg btn-block" type="button" onClick="javascript:window.location='<?php echo base_url();?>login';" >
							Cancel
						</button>
		</div>
	</form>

	
	<!-- modal -->
</div>
<?php $this->load->view('login_footer'); ?>