<?php $this->load->view('header'); ?>
<link href="<?php echo $this->config->item('css_images_js_base_url'); ?>js/css3clock/css/style.css" rel="stylesheet">
<script type="text/javascript">
    $(document).ready(function () {
        if ($.fn.plot) {
            var dataPie = [{
                label: "High",
                data: <?php echo $high_pri;?>
            },{
                label: "Medium",
                data: <?php echo $medium_pri;?>
            }, {
                label: "Low",
                data: <?php echo $low_pri;?>
            }];

            $.plot($(".sm-pie"), dataPie, {
                series: {
                    pie: {
                        innerRadius: 0.7,
                        show: true,
                        stroke: {
                            width: 0.1,
                            color: '#ffffff'
                        }
                    }

                },

                legend: {
                    show: true
                },
                grid: {
                    hoverable: true,
                    clickable: true
                },

                colors: ["#AEC785", "#FDD752", "#FF8AA3"]
            });
	}

        $('.progress-stat-bar li').each(function () {
            $(this).find('.progress-stat-percent').animate({
                height: $(this).attr('data-percent')
            }, 1000);
        });

	});
function status_change(priority,pId,className)
{
	var param="priority="+priority+"&pId="+pId;
	$.ajax({
		type: "POST",
		url: "<?php echo base_url();?>project/changestatus",
		data: param,
		success: function(rslt){
			if(rslt == 1) {
				$("#H"+"-"+pId).removeClass("high_class");
				$("#M"+"-"+pId).removeClass("medium_class");
				$("#L"+"-"+pId).removeClass("low_class");

				$("#"+priority+"-"+pId).addClass(className,1000, "easeOutBounce" );
			}
		}
	});
}
</script>
<style>
.high_class {
	background-color:#128314;
	color:#FFF;
	font-weight:bold;
}
.medium_class {
	background-color:#E0BA10;
	color:#FFF;
	font-weight:bold;
}
.low_class {
	background-color:#C41D20;
	color:#FFF;
	font-weight:bold;
}
</style>
<?php
function timeDiff($endTime, $beginTime)
{
	$beginTime	 = strtotime($beginTime);
	$endTime	 = strtotime($endTime);
	$diff 		 = $endTime - $beginTime;
	$diff 		 = date('H:i:s', $diff);
	$timestamp	 = strtotime($diff) - 60*60;
	$time 		 = date('H:i:s', $timestamp);
	return $time;
}
function secs_to_h($secs)
{
        $units = array(
                "day"    =>  7*24*3600,
                "hour"   =>      3600,
                "minute" =>        60,
                "second" =>         1,
        );
// specifically handle zero
        if ( $secs == 0 ) return "0 seconds";
          $s = "";
          foreach ( $units as $name => $divisor ) {
                if ( $quot = intval($secs / $divisor) ) {
                        $s .= "$quot $name";
                        $s .= (abs($quot) > 1 ? "s" : "") . ", ";
                        $secs -= $quot * $divisor;
                }
        }
   return substr($s, 0, -2);
}
function dateDiff($dformat, $endDate, $beginDate)
{
    $date_parts1=explode($dformat, $beginDate);
    $date_parts_exp=explode(" ", $date_parts1[2]);
    $date_parts2=explode($dformat, $endDate);
    $date_parts_exp2=explode(" ", $date_parts2[2]);

    $start_date=gregoriantojd($date_parts1[1], $date_parts_exp[0],  $date_parts1[0]);
    $end_date=gregoriantojd($date_parts2[1], $date_parts_exp2[0], $date_parts2[0]);
    return $end_date - $start_date;
}
?>
<section id="main-content">
    <section class="wrapper">
	<div class="row">
		
		<!-- <div class="col-md-4">
			<div class="mini-stat clearfix">
				<span class="mini-stat-icon tar"><i class="fa fa-gear"></i></i></span>
				<div class="mini-stat-info">
					<a href="<?php //echo base_url()."setting" ?>">Setting</a>
				</div>
			</div>
	    </div> -->
        	<div class="col-md-4">
			<div class="mini-stat clearfix">
                
				<span class="mini-stat-icon tar"><i class="fa fa-users"></i></i></span>
				<div class="mini-stat-info">
					<a href="<?php echo base_url()."users" ?>">Total Users</a>
				</div>
                 <div class="inner">
              <h3><?php echo count($totalUsers);?></h3>

              
            </div>
			</div>
	    </div>
  

       
        
       
           
        </div> 
	 </div>     
    </section>
</section>
<script src="<?php echo $this->config->item('css_images_js_base_url'); ?>js/css3clock/js/css3clock.js"></script>
<?php $this->load->view('footer'); ?>