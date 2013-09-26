<?php
$current_year = date('Y');
$earliest_year = $current_year - 5;
$facility_Code=$this -> session -> userdata('news');	
?>
<style>

.nav-list{
	display:block;
	font-size:13px;
	font-weight:600;
	width:17%;
	height:auto;
	padding-right: 0px;
	padding-left: 0px;
	margin-bottom: 0;
	float:left;
	-webkit-border-radius: 6px;
     -moz-border-radius: 6px;
          border-radius: 6px;
  -webkit-box-shadow: 0 1px 4px rgba(0,0,0,.065);
     -moz-box-shadow: 0 1px 4px rgba(0,0,0,.065);
          box-shadow: 0 1px 4px rgba(0,0,0,.065);
	
	
}
.nav-list ul li {
    
  padding: 10px 15px;
  cursor: pointer;
  -webkit-transition: all 0.2s;
  -moz-transition: all 0.2s;
  -ms-transition: all 0.2s;
  -o-transition: all 0.2s;
  transition: all 0.2s;
  -webkit-border-radius: 0.4em;
  list-style-type: none;
}
.nav-list ul li:hover {
   background: #29527b ; /* Old browsers */
  color: #fff;
}
.reportsdisplay{
	width:81.5%;
	float:left;
	height:auto;
	min-height:500px;
	margin-bottom:2em;
	margin-left:0.3%;
	background: whitesmoke; /* Old browsers */
	-webkit-border-radius: 6px;
     -moz-border-radius: 6px;
          border-radius: 6px;
  -webkit-box-shadow: 0 1px 4px rgba(0,0,0,.065);
     -moz-box-shadow: 0 1px 4px rgba(0,0,0,.065);
          box-shadow: 0 1px 4px rgba(0,0,0,.065);
	
}

.altBackground {
        background-color:#29527b;
     /* color: your color ; 
        foo: bar */
}
li a{
	font:color;
}
.active{
	background:#29527b url('<?php echo base_url()?>Images/sidebar-menu-arrow.png') right no-repeat;
	
	color: #fff;
}

</style>
<script>
	$(document).ready(function() {
		
		$("li").click(function(){
  // If this isn't already active
  if (!$(this).hasClass("active")) {
    // Remove the class from anything that is active
    $("li.active").removeClass("active");
    // And make this active
    $(this).addClass("active");
  }
});
		var url = "<?php echo base_url().'Settings/supply_plan_s'?>";      
       	var div=".reportsdisplay";
       	ajax_request (url,div);
		
		$("#plan_settings").click(function(){
      var url = "<?php echo base_url().'Settings/'?>";      
        var div=".reportsdisplay";  
		ajax_request (url,div);
    });
    
    $("#fp_settings").click(function(){
      var url = "<?php echo base_url().'Settings/fpcommodity_s'?>";      
          var div=".reportsdisplay";  
		ajax_request (url,div);
    });
    
    $("#soh_settings").click(function(){
      var url = "<?php echo base_url().'Settings/soh_s'?>";      
          var div=".reportsdisplay";  
		ajax_request (url,div);
    });
    
    function ajax_request (url,div){
	var url =url;
	var loading_icon="<?php echo base_url().'Images/loadfill.gif' ?>";
	 $.ajax({
          type: "POST",
          url: url,
          beforeSend: function() {
            $(div).html("");
            
             $(div).html("<img style='margin-left:50%;margin-top:20%;' src="+loading_icon+">");
            
          },
          success: function(msg) {
          $(div).html("");
           $(div).html(msg);        
          }
        }); 
}
});
</script>

      <div class="nav-list">
      	  <ul>
      	<li id="plan_settings" class="active">Supply Plan</li>
      	<li id="fp_settings">Fp Commodities</li>
      	<li id="soh_settings">Stock On Hand</li>
      	
     	 </ul>
      </div>
      
      
      
      <div class="reportsdisplay"></div>
		
		
