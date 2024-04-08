<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>Login</title>

    <!--Core CSS -->
    <link href="<?php echo $this->config->item('css_images_js_base_url'); ?>bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->config->item('css_images_js_base_url'); ?>css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo $this->config->item('css_images_js_base_url'); ?>font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?php echo $this->config->item('css_images_js_base_url'); ?>css/style.css" rel="stylesheet">
    <link href="<?php echo $this->config->item('css_images_js_base_url'); ?>css/style-responsive.css" rel="stylesheet" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->

	<script src="<?php echo $this->config->item('css_images_js_base_url'); ?>js/jquery.js"></script>
	<script src="<?php echo $this->config->item('css_images_js_base_url'); ?>bs3/js/bootstrap.min.js"></script>

    <script src="<?php echo $this->config->item('css_images_js_base_url'); ?>js/ie8-responsive-file-warning.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<script>
	setTimeout(function()
	{
		$('.alert-success').slideToggle('slow');
	}, 6000);

	setTimeout(function()
	{
		$('.alert-danger').slideToggle('slow');
	}, 6000);
</script>
<?php 
if(isset($success_msg))
{
if($success_msg!= '')
{
?>
<div class="alert alert-success fade in"  style="width: 70%; margin-left: 16%;">
	<button data-dismiss="alert" class="close close-sm" type="button">
		<i class="fa fa-times"></i>
	</button>
	<strong>Well Done!&nbsp;</strong> <?php echo $success_msg; ?> 
</div>
<?php 
}
}
if(isset($error_msg))
{
if($error_msg!= '')
{
?>
<div class="alert alert-block alert-danger fade in"  style="width: 70%; margin-left: 16%;">
	<button data-dismiss="alert" class="close close-sm" type="button">
		<i class="fa fa-times"></i>
	</button>
	<strong>Oh Sorry!&nbsp;</strong>  <?php echo $error_msg; ?>
</div>
<?php
}
}
?>
	