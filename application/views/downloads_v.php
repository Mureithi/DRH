<style>

.downloads{
	width:80%;
	margin:auto;
	
}
.accordion-heading a{
		background: #29527b; /* Old browsers */
		color: #fff;
		text-decoration:none;
		font-size:15px;
		
	}
	ul a {
		font-size:14px;
	}
</style>
<script>

$(document).ready(function() {
	$(function() {
	$(".collapse").collapse()
	$('#myTab a').click(function (e) {
 		 e.preventDefault();
 			 $(this).tab('show');
})
$( ".dateclass" ).datepicker({
			showAnim:'drop',
			dateFormat: 'd M yy', 
			
		});	
		
	});
	});
	
</script>

<div class="downloads">
<div class="accordion" id="accordion2">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
        Service Statistics
      </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse in">
      <div class="accordion-inner">
        all about Service stats
      </div>
    </div>
  </div>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
        Commodities
      </a>
    </div>
    <div id="collapseTwo" class="accordion-body collapse">
      <div class="accordion-inner">
        <ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#home">2 Pager</a></li>
  <li><a href="#profile">Supply Plan</a></li>
  
		</ul>
 
<div class="tab-content">
  <div class="tab-pane active" id="home">
  	<?php 
    $att=array("name"=>'','id'=>'',"class"=>'form-horizontal');
	 echo form_open('reports/getstock_summary',$att); ?>
  	<div id="" class=" " style="max-height:50em;">
		
        <div class="form-horizontal">
    	
  <div class="control-group">
    <label class="control-label" for="monthdownload">Date as Of</label>
    <div class="controls">
      <input class="span2 dateclass" type="text" placeholder="Date as of" id="dateas_of" name="dateas_of">
    </div>
  </div>
  
  
  <div class="control-group">
    <div class="controls">
      
      <button type="submit" class="btn download">Download</button>
    </div>
  </div>
</div>
      
      </div>
      <?php 
echo form_close();
?>
  </div>
  <div class="tab-pane" id="profile">asdasd</div>
  
</div>
      </div>
    </div>
  </div>
</div>
</div>