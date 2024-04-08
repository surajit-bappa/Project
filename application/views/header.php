<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="shortcut icon" href="<?php echo $this->config->item('css_images_js_base_url'); ?>images/favicon.ico">   
    <title> Project </title>

	<!-- Core js -->
	<!--<script src="<?php// echo $this->config->item('css_images_js_base_url'); ?>js/jquery.js"></script>-->
	<script src="<?php echo $this->config->item('css_images_js_base_url'); ?>js/jquery-1.8.3.min.js"></script>
	<script src="<?php echo $this->config->item('css_images_js_base_url'); ?>js/esolzFormValidation.js"></script>

	<!--Core CSS -->
	<link href="<?php echo $this->config->item('css_images_js_base_url'); ?>bs3/css/bootstrap.min.css" rel="stylesheet">
	     <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $this->config->item('css_images_js_base_url'); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<link href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('css_images_js_base_url'); ?>css/bootstrap-reset.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('css_images_js_base_url'); ?>font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('css_images_js_base_url'); ?>css/clndr.css" rel="stylesheet">
	
	<!--dynamic table-->
	<link href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
	<link href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/data-tables/DT_bootstrap.css" />

	<!--clock css-->
	<!--     <link href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/css3clock/css/style.css" rel="stylesheet"> -->
	
	<!--Morris Chart CSS -->
	<link rel="stylesheet" href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/morris-chart/morris.css">
	
	<!--  <link rel="stylesheet" href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/data-tables/DT_bootstrap.css" /> -->
	
	<!-- Custom styles for this template -->
	<link href="<?php echo $this->config->item('css_images_js_base_url'); ?>css/style.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('css_images_js_base_url'); ?>css/style-responsive.css" rel="stylesheet"/>
	
	<!-- date and time picker -->
	<link rel="stylesheet" href="<?php echo $this->config->item('css_images_js_base_url'); ?>css/bootstrap-switch.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/bootstrap-fileupload/bootstrap-fileupload.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/bootstrap-datepicker/css/datepicker.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/bootstrap-timepicker/css/timepicker.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/bootstrap-colorpicker/css/colorpicker.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/bootstrap-datetimepicker/css/datetimepicker.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/jquery-multi-select/css/multi-select.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/jquery-tags-input/jquery.tagsinput.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/select2/select2.css" />

	
	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<script src="<?php echo $this->config->item('css_images_js_base_url'); ?>js/ie8-responsive-file-warning.js"></script>
<!--	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>-->

</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand" style="height: 89px;">

    <a href="<?php echo base_url(); ?>" class="logo" style="  margin: 0 0 0 39px;">
    	
    <!--<br> AMC Training </br>-->
	<img src="<?php echo IMAGE_URL;?><?php echo $this->session->userdata('profile_image');?>" style="width: 120px;height: 90px;margin-left: 14px;">
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>

<script>
	$(document).ready(function(){
// 		$('#alert-success').hide();
	});

	setTimeout(function()
	{
		$('.alert-success').slideToggle('slow');
		$('.alert-danger').slideToggle('slow');
	}, 6000);
	
</script>
<?php 
if(isset($success_msg))
{
if($success_msg!= '')
{
?>
<div class="alert alert-success fade in" >
	<button data-dismiss="alert" class="close close-sm" type="button">
		<i class="fa fa-times"></i>
	</button>
	<strong>Well Done!</strong> <?php echo $success_msg; ?> 
</div>
<?php 
}
}
if(isset($error_msg))
{
if($error_msg!= '')
{
?>
<div class="alert alert-block alert-danger fade in" >
	<button data-dismiss="alert" class="close close-sm" type="button">
		<i class="fa fa-times"></i>
	</button>
	<strong>Oh Sorry!</strong>  <?php echo $error_msg; ?>
</div>
<?php
}
}
?>
<div class="alert alert-success fade"  id="alert-success" style="display:none;">
	<button data-dismiss="alert" class="close close-sm" type="button">
		<i class="fa fa-times"></i>
	</button>
	<p id="message_action">&nbsp;</p>
</div>


<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
<!--        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>-->
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="<?php echo IMAGE_URL;?><?php echo $this->session->userdata('profile_image')?>">
                <span class="username"><?php echo ucfirst($this->session->userdata('username')); ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                 <!--<li><a href="<?php echo base_url(); ?>profile"><i class=" fa fa-suitcase"></i>Profile</a></li> -->
                <?php
				 if($this->session->userdata('user_type')==0){
				  ?>
				<!-- <li><a href="<?php //echo base_url(); ?>profile"><i class="fa fa-cog"></i> Edit Profile</a></li>  -->
				  <?php
				 }else{
				  ?>
				 <li><a href="<?php echo base_url(); ?>profile"><i class="fa fa-cog"></i> Edit Profile</a></li> 
				  <?php
				 }
				?>
				
                
				
				<li><a href="<?php echo base_url(); ?>logout"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
<!--        <li>
            <div class="toggle-right-box">
                <div class="fa fa-bars"></div>
            </div>
        </li>-->
    </ul>
    <!--search & user info end-->
</div>


</header>
<!--header end-->
<!--sidebar start-->
<?php $first = $this->uri->segment('1'); ?>
<aside>
	<div id="sidebar" class="nav-collapse">
	<!-- sidebar menu start-->
	<div class="leftside-navigation">
		<ul class="sidebar-menu" id="nav-accordion">
			
			 <li>
				<a href="<?php echo base_url(); ?>login" <?php if($first == 'login') { ?> class="active" <?php } ?>>
				<i class="fa fa-dashboard"></i>
				<span>Dashboard</span>
				</a>
			</li>
			
		 	<li class="sub-menu">
				<a href="<?php echo base_url(); ?>users" <?php if($first == 'users') { ?> class="active" <?php } ?>>
				<i class="fa fa-users"></i>
				<span>Users</span>
				</a>
			</li> 
			<?php if($this->session->userdata('user_type') == 'Admin Level'){
				?>

			
			<li class="sub-menu">
				<a href="<?php echo base_url(); ?>schemes" <?php if($first == 'schemes') { ?> class="active" <?php } ?>>
				<i class="fa fa-tasks"></i>
				<span>Schemes</span>
				</a>
			</li> 

			<li class="sub-menu">
				<a href="<?php echo base_url(); ?>mis" <?php if($first == 'mis') { ?> class="active" <?php } ?>>
				<i class="fa fa-circle"></i>
				<span>MIS</span>
				</a>
			</li> 

			<?php
		      }
			?>
	
		</ul>
		</div>
	<!-- sidebar menu end-->
	</div>
</aside>
 <?php
   if($this->session->userdata('admin_success') != ''){
 ?>
 <div role="alert" class="alert alert-success alert-dismissible fade in" style="z-index:9999">
	   <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
	   <?php
	   echo $this->session->userdata('admin_success');
	   ?>
 </div>
 <?php
   $this->session->set_userdata('admin_success','');
   }
 ?>
 <?php
   if($this->session->userdata('admin_error') != ''){
 ?>
<div role="alert" class="alert alert-danger alert-dismissible fade in" style="z-index:9999">
      <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
       <?php
		echo $this->session->userdata('admin_error');
	   ?>
</div>
 <?php
   $this->session->set_userdata('admin_error','');
   }
 ?>



