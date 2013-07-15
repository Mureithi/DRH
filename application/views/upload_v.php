<?php $facility=$this -> session -> userdata('news');
$access_level = $this -> session -> userdata('user_indicator');
?>
<style>
	
	
</style>

<div id="main_content">
	
	<html>
	<head>
		<script type="text/javascript">


</script>
		
	</head>
	<body>
		<div id="view_content">
	<div class="container-fluid">
	  <div class="row-fluid row">
	  		<!-- Side bar menus -->
		    
		    <!-- SIde bar menus end -->
		    
		    <div class="span9 span-fixed-sidebar">
	      		<div class="hero-unit">
		<div class="passmessage"></div>
		<div class="errormessage"></div>
		
		<?php echo form_open_multipart('Upload_Management/upload_csv');?>
		<div class="upload_form">
			
			<input type="file" name="file" class="awesome red"  />
			<input name="btn_save" class="awesome blue" type="submit"  value="Upload" />	
		</div>
		</form>
		</div>
			</div>	
		</div>
	</div>
</div>
	</body>
</html>
	
</div>
