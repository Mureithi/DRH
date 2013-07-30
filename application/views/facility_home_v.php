<?php 
$selectedItem = '';

$current_year = date('Y');
$earliest_year = $current_year - 5;
$facility_Code=$this -> session -> userdata('news');	

?>
<script src="<?php echo base_url().'Scripts/accordion.js'?>" type="text/javascript"></script> 
<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>

<script type="text/javascript">
$(document).ready(function(){
	
      $(function() {
$("body").on({
    ajaxStart: function() { 
        $(this).addClass("loading"); 
    },
    ajaxStop: function() { 
        $(this).removeClass("loading"); 
    }    
});
});
       
      var url = "<?php echo base_url().'statistics_controller/nationalpie'?>";
      //alert ($('#getcommodity').val());
        $.ajax({
          type: "POST",
          data: { 'getcommodity': $('#getcommodity').val()},
          url: url,
          beforeSend: function() {
            $(".my_chart").html("");
          },
          success: function(msg) {
            $(".my_chart").html(msg);
            
             }
         });
         
         $("#generatepie").click(function(){
      var url = "<?php echo base_url().'statistics_controller/nationalpie'?>";
      //alert ($('#getcommodity').val());
        $.ajax({
          type: "POST",
          data: { 'getcommodity': $('#getcommodity').val()},
          url: url,
          beforeSend: function() {
            $(".my_chart").html("");
          },
          success: function(msg) {
            $(".my_chart").html(msg);
            
             }
         });
    });
  
    
   $("#generategraph").click(function(){
      var url = "<?php echo base_url().'statistics_controller/get_commodity_analyse'?>";
      //alert ($('#getcommodity').val());
        $.ajax({
          type: "POST",
          data: { 'getcommodity': $('#getcommodity').val()},
          url: url,
          beforeSend: function() {
            $(".my_chart").html("");
          },
          success: function(msg) {
            $(".my_chart").html(msg);
            
             }
         });
    });
  $("#generatecompare").click(function(){
      var url = "<?php echo base_url().'statistics_controller/get_commodity_perdistrict'?>";
      //alert ($('#getcommodity').val());
        $.ajax({
          type: "POST",
          data: { 'county': $('#county').val()},
          url: url,
          beforeSend: function() {
            $(".my_chart").html("");
          },
          success: function(msg) {
            $(".my_chart").html(msg);
            
             }
         });
    });
    
 $("#countyforecast").change(function() {
    
      var url = "<?php echo base_url().'statistics_controller/forecastedit_county_v'?>";
      //alert ($('#getcommodity').val());
        $.ajax({
          type: "POST",
          data: { 'countyforecast': $('#countyforecast').val()},
          url: url,
          beforeSend: function() {
            $(".my_chart").html("");
          },
          success: function(msg) {
            $(".my_chart").html(msg);
            
             }
         });
    });
    $("#gettrend").click(function() {
    
      var url = "<?php echo base_url().'statistics_controller/trend_analysis'?>";
      //alert ($('#getcommodity').val());
        $.ajax({
          type: "POST",
          data: { 'countytrend': $('#countytrend').val(),'getcommoditytrend': $('#getcommoditytrend').val(),'year_from': $('#year_from').val()},
          url: url,
          beforeSend: function() {
            $(".my_chart").html("");
          },
          success: function(msg) {
            $(".my_chart").html(msg);
            
             }
         });
    });


});
</script>
<style>
.leftpanel{
    	width: 19%;
    	height:auto;
    	float: left;
    }

   
    .dash_menu{
    width: 100%;
    float: left;
    height:auto; 
    -webkit-box-shadow: 2px 3px 5px#888;
	box-shadow: 2px 3px 5px #888; 
	margin-bottom:3.2em; 
    }
    
    .dash_main{
    width: 78%;
    height:auto;
    float: left;
    -webkit-box-shadow: 2px 2px 6px #888;
	box-shadow: 2px 2px 6px #888; 
    margin-left:1.5em;
    
    }
    .my_chart{
   	width: 90%;
   	resize:both;
   	min-height:50em;
   height: auto;
   margin:auto;
   overflow: auto;
   
   }
   
    
#accordion {
    width: 300px;
    margin: 50px auto;
    float:left;
    margin-left:0.45em;
}
.collapsible,
.page_collapsible,
.accordion {
    margin: 0;
    padding:5%;
    height:15px;
    border-top:#f0f0f0 1px solid;
    background: #cccccc;
    font:normal 1.3em 'Trebuchet MS',Arial,Sans-Serif;
    text-decoration:none;
    text-transform:uppercase;
	background: #29527b; /* Old browsers */
     border-radius: 0.5em;
     color: #fff; }
.accordion-open,
.collapse-open {
	background: #289909; /* Old browsers */    
    color: #fff; }
.accordion-open span,
.collapse-open span {
    display:block;
    float:right;
    padding:10px; }
.accordion-open span,
.collapse-open span {
    background:url('<?php echo base_url()?>Images/minus.jpg') center center no-repeat; }
.accordion-close span,
.collapse-close span {
    display:block;
    float:right;
    background:url('<?php echo base_url()?>Images/plus.jpg') center center no-repeat;
    padding:10px; }
div.container {
    width:auto;
    height:auto;
    padding:0;
    margin:0; }
div.content {
    background:#f0f0f0;
    margin: 0;
    padding:10px;
    font-size:.9em;
    line-height:1.5em;
    font-family:"Helvetica Neue", Arial, Helvetica, Geneva, sans-serif; }
div.content ul, div.content p {
    padding:0;
    margin:0;
    padding:3px; }
div.content ul li {
    list-style-position:inside;
    line-height:25px; }
div.content ul li a {
    color:#555555; }
code {
    overflow:auto; }
.accordion h3.collapse-open {}
.accordion h3.collapse-close {}
.accordion h3.collapse-open span {}
.accordion h3.collapse-close span {}




    
</style>
<script>
json_obj = {
				"url" : "<?php echo base_url().'Images/calendar.gif';?>",
				};
	var baseUrl=json_obj.url;
    $(function() {
     $(document).ready(function() {
        //$('.accordion').accordion({defaultOpen: ''});
         //custom animation for open/close
    $.fn.slideFadeToggle = function(speed, easing, callback) {
        return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
    };

    $('.accordion').accordion({
        defaultOpen: 'section1',
        cookieName: 'nav',
        speed: 'medium',
        animateOpen: function (elem, opts) { //replace the standard slideUp with custom function
            elem.next().slideFadeToggle(opts.speed);
        },
        animateClose: function (elem, opts) { //replace the standard slideDown with custom function
            elem.next().slideFadeToggle(opts.speed);
        }
    });
    $( "#datepicker" ).datepicker({
			showOn: "button",
			dateFormat: 'd M, yy', 
			buttonImage: baseUrl,
			buttonImageOnly: true
		});
    });
    
    
});

</script>
<div class="leftpanel">

<div class="dash_menu">
    
    
    <h3 class="accordion" id="section1">National Data<span></span><h3>
<div class="container">
    <div class="content">
    	<button class="awesome blue" id="generatepie" style="margin-left:0.5%">Generate Pie</button>
    </div>
</div>
<h3 class="accordion" id="leadtime">Compare By County<span></span><h3>
<div class="container">
    <div class="content">
    	<h2 style="margin-left:2% ">Click below to select County</h2>
      <select class="dropdownsize" id="county" name="county" style="width: 60%; margin-left:2% ">
    <option>Select County</option>
		<?php 
		foreach ($county as $county1) {
			$id=$county1->id;
			$drug=$county1->county;
			?>
			<option value="<?php echo $id;?>"><?php echo $drug;?></option>
		<?php }
		?>
	</select>        
	<button class="awesome blue" id="generatecompare" style="margin-left:0.5%">Generate</button>
    
    </div>
</div>
<h3 class="accordion" id="section3">Consumption by county<span></span><h3>
<div class="container">
    <div class="content">
      <h2 style="margin-left:2% ">Click below to select FP Commodity</h2>
    	 <select class="dropdownsize" id="getcommodity" name="getcommodity" style="width: 60%; margin-left:2% ">
    <option>Select FP Commodity</option>
		<?php 
		foreach ($commodity as $commodity1) {
			$id=$commodity1->identifier;
			$drug=$commodity1->fpcommodity_name;
			?>
			<option value="<?php echo $id;?>"><?php echo $drug;?></option>
		<?php }
		?>
	</select>        
	<button class="awesome blue" id="generategraph" style="margin-left:0.5%">Generate</button>
    
    </div>
</div>
<h3 class="accordion" id="section4">Forecast<span></span><h3>
<div class="container">
    <div class="content">
       <h2 style="margin-left:2% ">Click below to select County</h2>
      <select class="dropdownsize" id="countyforecast" name="countyforecast" style="width: 60%; margin-left:2% ">
    <option>Select County</option>
		<?php 
		foreach ($county as $county2) {
			$id=$county2->id;
			$drug=$county2->county;
			?>
			<option value="<?php echo $id;?>"><?php echo $drug;?></option>
		<?php }
		?>
	</select>  
    </div>
</div>
<h3 class="accordion" id="section4">Consumption Trends<span></span><h3>
<div class="container">
    <div class="content">
       <h2 style="margin-left:2% ">Click below to select County</h2>
      <select class="dropdownsize" id="countytrend" name="countytrend" style="width: 60%; margin-left:2% ">
    <option>Select County</option>
		<?php 
		foreach ($county as $county3) {
			$id=$county3->id;
			$drug=$county3->county;
			?>
			<option value="<?php echo $id;?>"><?php echo $drug;?></option>
		<?php }
		?>
		
	</select>
	<select class="dropdownsize" id="getcommoditytrend" name="getcommoditytrend" style="width: 60%; margin-left:2% ; margin-top: 2%;">
    <option>Select FP Commodity</option>
		<?php 
		foreach ($commodity as $commodity2) {
			$id=$commodity2->identifier;
			$drug=$commodity2->fpcommodity_name;
			?>
			<option value="<?php echo $id;?>"><?php echo $drug;?></option>
		<?php }
		?>
	</select>
	<select name="year_from" id="year_from" style="padding: 0.55em 0.8em; margin-top: 1em; margin-left: 2em;>
			<?php
for($x=$current_year;$x>=$earliest_year;$x--){
			?>
			<option value="<?php echo $x+1;?>"
			<?php
			if ($x == $current_year) {echo "selected";
			}
			?>><?php echo $x+1;?></option>
			<?php }?>
		</select>
		<button class="awesome blue" id="gettrend" style="margin-left:8%; margin-top: 2%">Get trend</button>  
    </div>
</div>

</div><!--End div for the dashboard side menu!-->
<div class="sidebar">
	
		<h2>Quick Access</h2>
<nav class="sidenav">
	<ul>
		<li class="orders_minibar"><a href="<?php echo site_url('Upload_Management/');?>">Upload CSV</a></li>
		
	<ul>
</nav>
				
		</fieldset>
	
</div><!--End div for the (Quick access)side navigation!-->

</div>


<div class="dash_main" id = "dash_main">
<div class="my_chart">
		
		
	</div>	
</div>
<div class="modal">Loading data...Please wait.</div>
