<?php
if (!$this -> session -> userdata('user_id')) {
	redirect("user_management/login");
}
if (!isset($link)) {
	$link = null;
}
if (!isset($quick_link)) {
	$quick_link = null;
}
$access_level = $this -> session -> userdata('user_indicator');
$drawing_rights = $this -> session -> userdata('drawing_rights');

$user_is_facility = false;
$user_is_moh = false;
$user_is_district = false;
$user_is_moh_user = false;
$user_is_facility_user = false;
$user_is_kemsa = false;
$user_is_super_admin = false;
$user_is_rtk_manager = FALSE;
$user_is_county_facilitator = FALSE;
$user_is_allocation_committee = FALSE;
$user_is_dpp = FALSE;
if ($access_level == "facility" || $access_level == "fac_user") {
	$user_is_facility = true;
}
if ($access_level == "moh") {
	$user_is_moh = true;
}
if ($access_level == "district") {
	$user_is_district = true;
}
if ($access_level == "moh_user") {
	$user_is_moh_user = true;
}
if ($access_level == "kemsa") {
	$user_is_kemsa = true;
}
if ($access_level == "super_admin") {
	$user_is_super_admin = true;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>

<link rel="icon" href="<?php echo base_url().'Images/coat_of_arms.png'?>" type="image/x-icon" />
<link href="<?php echo base_url().'CSS/style.css'?>" type="text/css" rel="stylesheet"/> 
<link href="<?php echo base_url().'CSS/bootstrap.css'?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url().'CSS/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url().'CSS/jquery-ui.css'?>" type="text/css" rel="stylesheet"/> 
<script src="<?php echo base_url().'Scripts/jquery.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/highcharts.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/exporting.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/bootstrap.js'?>" type="text/javascript"></script> 
<script src="<?php echo base_url().'Scripts/jquery.form.js'?>" type="text/javascript"></script> 
<script src="<?php echo base_url().'Scripts/jquery-ui.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/validator.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/jquery.validate.js'?>" type="text/javascript"></script> 
<script src="<?php echo base_url().'Scripts/waypoints.js'?>" type="text/javascript"></script> 
<script src="<?php echo base_url().'Scripts/waypoints-sticky.min.js'?>" type="text/javascript"></script>
<script src="http://code.highcharts.com/highcharts-more.js"></script>



  <?php
if (isset($script_urls)) {
	foreach ($script_urls as $script_url) {
		echo "<script src=\"" . $script_url . "\" type=\"text/javascript\"></script>";
	}
}
?>
<?php
if (isset($scripts)) {
	foreach ($scripts as $script) {
		echo "<script src=\"" . base_url() . "Scripts/" . $script . "\" type=\"text/javascript\"></script>";
	}
}
?>
<?php
if (isset($styles)) {
	foreach ($styles as $style) {
		echo "<link href=\"" . base_url() . "CSS/" . $style . "\" type=\"text/css\" rel=\"stylesheet\"/>";
	}
}
?>  
<style>
	input.text {
		margin-bottom: 12px;
		width: 95%;
		padding: .4em;
	}
	fieldset {
		padding: 0;
		border: 0;
		
	}
	h1 {
		font-size: 1.2em;
		margin: .6em 0;
	}
	div#users-contain {
		width: 350px;
		margin: 20px 0;
	}
	div#users-contain table {
		margin: 1em 0;
		border-collapse: collapse;
		width: 100%;
	}
	div#users-contain table td, div#users-contain table th {
		border: 1px solid #eee;
		padding: .6em 10px;
		text-align: left;
	}
	.ui-dialog .ui-state-error {
		padding: .3em;
	}
	.validateTips {
		border: 1px solid transparent;
		padding: 0.3em;
	}

	#top_menu a {
		color: white;
		text-decoration: none;
	}
	.successtext{
		color:#003300;
	}
    </style>
<script type="text/javascript">

	function showTime()
{
var today=new Date();
var h=today.getHours();
var m=today.getMinutes();
var s=today.getSeconds();
// add a zero in front of numbers<10
h=checkTime(h);
m=checkTime(m);
s=checkTime(s);
$("#clock").text(h+":"+m);
t=setTimeout('showTime()',1000);
}
function checkTime(i)
{
if (i<10)
  {
  i="0" + i;
  }
return i;
}

		
</script>
</head>
 
<body onload="showTime()">

<div id="wrapper">
	<div id="top-panel" style="margin:0px;">

		<div class="logo_template">
			<a class="logo_template" href="<?php echo base_url(); ?>" ></a> 
</div>

				<div id="system_title">
					<span style="display: block; font-weight: bold; font-size: 14px; margin:2px;">Ministry of Health</span>
					<span style="display: block; font-size: 12px;">Health Commodities Management Platform</span>
					<span style="display: block; font-size: 12px;">Division Of Reproductive Health(DRH)</span>	

					
				</div>
			<?php if($banner_text=="New Order"):?>
				<div id="notification" style="display: block; margin-left: 40%;">
					
			<span ><b > Total Order Value </b><b id="t" >  0</b></span><br />
			<span> Drawing Rights Available Balance :<b id="drawing"><?php echo $drawing_rights; ?>   </b>
				
			</span>
		        
	</div>
	
	
	<?php endif; ?>
	<?php $facility = $this -> session -> userdata('news'); ?>
 <div id="top_menu"> 

 	<?php
	//Code to loop through all the menus available to this user!
	//Fet the current domain
	$menus = $this -> session -> userdata('menu_items');
	$current = $this -> router -> class;
	$counter = 0;
?>
<nav id="navigate">
<ul>
 	
<?php
if($user_is_facility){
?>
<li class=""><a  href="<?php echo base_url(); ?>home_controller">Service Statistics</a></li>
 	 
<!--<li><a  href="<?php echo base_url(); ?>fp_management/pipeline" class="">Stock Management</a></li>-->
<li><a  href="<?php echo base_url(); ?>fp_management/" class="">Commodities</a></li>
<li><a  href="<?php echo base_url(); ?>reports" class="">Downloads</a></li>
<li><a  href="<?php echo base_url(); ?>settings" class="">Settings</a></li>
<?php }  ?>



</ul>
</nav>
</div>
  	
	<div style="width :53em;height: 2em; margin: auto; ;" ></div>
	 <div >
<?php $flash_success_data = NULL;
	$flash_error_data = NULL;
	$flash_success_data = $this -> session -> flashdata('system_success_message');
	$flash_error_data = $this -> session -> flashdata('system_error_message');
	if ($flash_success_data != NULL) {
		echo '<p class="successreset" style="margin: auto;">' . $flash_success_data . '</p>';
	} elseif ($flash_error_data != NULL) {
		echo '<p class="errorlogin" style="margin: auto;">' . $flash_error_data . '</p>';
	}
 ?>
</div>
<div class="banner_content" style="font-size:20px; float:right; margin-top: 0.3em;padding-bottom: 0.35em;"><div style="float: left;"><?php echo  $banner_text; ?></div>

		<div style="float:right">
		
		
<div class="btn-group" >
  <a style="margin-right: 0.5em" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-user icon-white"></i> <?php echo $this -> session -> userdata('names'); ?> <?php echo $this -> session -> userdata('inames'); ?><span style="margin-left: 0.3em;" class="caret"></span></a>
  
  <ul class="dropdown-menu" style="font:#FFF;">
    <li><a href="#"><i class="icon-pencil"></i> Edit Settings</a></li>
    <li><a href="#myModal" data-toggle="modal" data-target="#myModal" id="changepswd" ><i class="icon-edit"></i> Change password</a></li>
    
    
    <li class="divider"></li>
    <li><a href="<?php echo base_url(); ?>user_management/logout"><i class=" icon-off"></i> Log Out</a></li>
  </ul>
</div>
			
		</div>
	
	</div>
	
	
</div>

<!-- MOH USR-->

<div id="inner_wrapper"> 
 		
<?php $this -> load -> view($content_view); ?>
<!-- end inner wrapper -->

  <!--End Wrapper div-->
    
    
    </div>
    <div class="footer">
	Government of Kenya &copy; <?php echo date('Y'); ?>. All Rights Reserved
	
	</div>

	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
		
			
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Change Password</h3>
    <div id="errsummary" style=""></div>
  </div>
  
  <form class="form-horizontal" action="<?php echo base_url().'User_Management/save_new_password'?>" method="post" id="change">
  <div class="control-group" style="margin-top: 1em;">
    <label class="control-label" for="inputPassword">Old Password</label>
    <div class="controls">
      <input type="password" id="old_password"  name="old_password" placeholder="Old Password" required="required"><span class="error" id="err" style="margin-left: 0.2em;font-size: 10px"></span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">New Password</label>
    <div class="controls">
      <input type="password" id="new_password" name="new_password" placeholder="New Password" required="required"><span class="error" id="result" style="margin-left: 0.2em;font-size: 10px"></span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Confirm Password</label>
    <div class="controls">
      <input type="password" id="new_password_confirm" name="new_password_confirm" placeholder="Confirm Password" required="required"><span class="error" id="confirmerror" style="margin-left: 0.2em;font-size: 10px"></span>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-primary" id="changepsaction" name="changepsaction">Change Password</button>
    <div class="error"></div>
  </div>


</div>
</form>
<?php
	echo form_close();
		?>
    
</body>
<script>
	$(document).ready(function() {
		
					$('.successreset').fadeOut(5000, function() {
    // Animation complete.
    //$(".successreset").remove();
  });
$('.errorlogin').fadeOut(5000, function() {
    // Animation complete.
    //$(".successreset").remove();
  });	
			
	
		//$('#myModal').modal('hide')
		
		$("#my_profile_link").click(function(){
			$("#logout_section").css("display","block");
		});
		$('#top-panel').waypoint('sticky');
		
		$('.dropdown-toggle').dropdown();

		$('#new_password').keyup(function() {
			$('#result').html(checkStrength($('#new_password').val()))
		})
		$('#new_password_confirm').keyup(function() {
			var newps = $('#new_password').val()
			var newpsconfirm = $('#new_password_confirm').val()
			
			if(newps!= newpsconfirm){
						
						 $('#confirmerror').html('Your passwords dont match');
						
							}else{
								
								$("#confirmerror").empty();
								$('#confirmerror').html('Your passwords match');
								$('#confirmerror').removeClass('error');
								$('#confirmerror').addClass('successtext')
								
								
							}
		})
		function checkStrength(password) {

			//initial strength
			var strength = 0

			//if the password length is less than 6, return message.
			if (password.length < 6) {
				$('#result').removeClass()
				$('#result').addClass('short')
				return 'Too short'
			}

			//length is ok, lets continue.

			//if length is 8 characters or more, increase strength value
			if (password.length > 7)
				strength += 1

			//if password contains both lower and uppercase characters, increase strength value
			if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))
				strength += 1

			//if it has numbers and characters, increase strength value
			if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))
				strength += 1

			//if it has one special character, increase strength value
			if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))
				strength += 1

			//if it has two special characters, increase strength value
			if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/))
				strength += 1

			//now we have calculated strength value, we can return messages

			//if value is less than 2
			if (strength < 2) {
				$('#result').removeClass()
				$('#result').addClass('weak')
				$("#result").css("color","#BE2E21")
				return 'Weak'
			} else if (strength == 2) {
				$('#result').removeClass()
				$('#result').addClass('good')
				$("#result").css("color","#006633")
				
				return 'Good'
			} else {
				$('#result').removeClass()
				$('#result').addClass('strong')
				$("#result").css("color","#003300")
				return 'Strong'
			}
		}


		$('#change').submit(function(){
			
			 $.ajax({
	            type: $('#change').attr('method'),

	            	url:$('#change').attr('action'),
					cache:"false",
					data:$('#change').serialize(),
					dataType:'json',
					beforeSend:function(){
						 $("#err").html("Processing...");
					},
					complete:function(){
						
					},
					success: function(data){
						//alert(data.response);
					if(data.response=='false'){
						
						 $('#err').html(data.msg);
						
							}else if(data.response=='true'){
								$("#err").empty();
								
								window.location="<?php echo base_url();?>";
								
							}

						}
	
							
	});

	return false;
	});
		});

</script>

</html>
