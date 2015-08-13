<?php
session_start();
?>

<!-- 
Code for the main landing page
-->

<!DOCTYPE HTML>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" x-undefined="" />

<title>welcome</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="css/styles.css" rel="stylesheet" type="text/css">  <!-- main stylesheet -->
<link href="css/jquery-ui.css" rel="stylesheet">
<link href="css/skdslider.css" rel="stylesheet">  <!-- Stylesheet for rotation of the large banner images on the main landing page -->

<script src="jsnew/jquery.js"></script>	 <!-- JQuery Library -->
<script src="jsnew/skdslider.min.js"></script>  <!-- JQuery plugin for rotation of the large banner images on the main landing page -->


<!-- for regular screens. JavaScript script for rotation of the large banner images on the main landing page -->
<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#demo1').skdslider({delay:5000, animationSpeed: 2000,showNextPrev:true,showPlayButton:true,autoSlide:true,animationType:'fading'});
			
			jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			  $(window).trigger('resize');
			});
			
		});
</script>



<!-- Note: rest of the JavaScripts are at the bottom, just above the </body> tag -->



</head>

<body>

<div id="wrapper">

<?php
include ('includesnew/topcontainer_home.php');
?>


  <div id="landingpagelayout">

	<table width="100%" cellspacing="0" cellpadding="0">
		<tr> <!--height="501"-->
			<td class="hmbannerimg" style = "position:relative;">
			
			
			<a href="categresults.php?producttarget=women"><p id="homepgshopnowbutton">SHOP NOW</p></a> 
			
			<a class="regularbanner" href="categresults.php?producttarget=women">
			<img alt="banner image 1"  width="100%" height="auto" src="imagesnew/rotating/banner1-1262.gif" style="position: relative; z-index: -2; top:0; left:0;" /> 
			
				
				
				<div class="skdslider">
					<ul id="demo1" class="slides">
					<li>
					<img src="imagesnew/rotating/banner1-1262.jpg" alt="banner image 1" width="100%" height="auto"/>
					</li>			
					
					<li>
					<img src="imagesnew/rotating/banner2-1262.jpg" alt="banner image 2" width="100%" height="auto"/>
					</li>
					
					<li>
					<img src="imagesnew/rotating/banner3-1262.jpg" alt="banner image 3" width="100%" height="auto"/>
					</li>
					
					</ul>
				</div>
				
				
				
				
				
				<!-- END: Rotating images images -->
			
			
			</a>
			
			<!--
			<a class="mobilebanner" href="categresults.php?producttarget=women">
			<img alt="banner image 1"  width="100%" height="auto" src="imagesnew/banner500px.png" /> 
			-->
			
			<!--
				<div class="skdslider_mb">
					<ul id="demo2" class="slides">
					<li>
					<img src="imagesnew/rotating/banner1-500.jpg" alt="banner image 1" width="100%" height="auto"/>
					</li>
					<li>
					<img src="imagesnew/rotating/banner2-500.jpg" alt="banner image 2" width="100%" height="auto"/>
					</li>
					<li>
					<img src="imagesnew/rotating/banner3-500.jpg" alt="banner image 3" width="100%" height="auto"/>
					</li>
					</ul>
				</div>			
			-->
			
			</a>
			
			
			
			</td>
		</tr>
	</table>
	<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" class="hmimgtoprodregular"> 	 
		<tr>
			<td class="hmimgtoprod">
			<a href="categresults.php?producttarget=women"><p id="hmimgtoprod1">WOMEN</p></a>
			<a href="categresults.php?producttarget=women"><img height="auto" src="imagesnew/imagesmall_women.png" width="100%" /></a>
			</td>
			<td class="hmimgtoprod">
			<a href="categresults.php?producttarget=men"><p id="hmimgtoprod2">MEN</p></a>
			<a href="categresults.php?producttarget=men"><img height="auto" src="imagesnew/imagesmall_men.png" width="100%" /></a>
			</td>
			<td class="hmimgtoprod">
			<a href="categresults.php?producttarget=kids"><p id="hmimgtoprod3">KIDS</p></a>
			<a href="categresults.php?producttarget=kids"><img height="auto" src="imagesnew/imagesmall_kids.png" width="100%" /></a>
			</td>
			<td class="hmimgtoprodacc">
			<a href="categresults.php?producttype=accessories"><p id="hmimgtoprod4">ACCESSORIES</p></a>
			<a href="categresults.php?producttype=accessories"><img height="auto" src="imagesnew/imgblock.png" width="100%" /></a>
			</td>
		</tr>
	</table>
	
	<!--Show for mobile only -->
	<div class="hmimgtoprodmobile">	 
		<!--
		<div id="topr1">
			<a href="categresults.php?producttarget=women"><img height="auto" src="imagesnew/introimagemobile.png" width="100%" /></a>
				
		</div> 
		-->
		
		<div id="topr1">
			<a href="categresults.php?producttarget=women"><img height="auto" src="imagesnew/women-new500px.png" width="100%" /></a>
				<div class="mb-img-desc">
					<h2>Women</h2>
					<p>Demo description here. <a class="more" href="categresults.php?producttarget=women">Shop now</a></p>
				</div>
		</div>
		<div id="topr3">
			<a href="categresults.php?producttarget=men"><img height="auto" src="imagesnew/men500px.png" width="100%" /></a>
				<div class="mb-img-desc">
					<h2>Men</h2>
					<p>Demo description here. <a class="more" href="categresults.php?producttarget=men">Shop now</a></p>
				</div>
		</div>
		<div id="topr4">
			<a href="categresults.php?producttarget=kids"><img height="auto" src="imagesnew/kids500px.png" width="100%" /></a>
				<div class="mb-img-desc">
					<h2>Kids</h2>
					<p>Demo description here. <a class="more" href="categresults.php?producttarget=kids">Shop now</a></p>
				</div>
		</div>
		
		<!--
		<div>
			<a href="categresults.php?producttype=accessories"><img height="auto" src="imagesnew/imgblock.png" width="100%" /></a>
		</div>
		-->
	</div>
	
  </div>
	

  <?php
	include ('includesnew/footertall.php');
  ?>
 

</div> 

<script src="jsnew/search.js"></script>   <!-- Search box (at the top nav bar) for wider screens -->
<script src="jsnew/search2.js"></script>   <!-- Search box (at the top nav bar) for smaller screens -->

<!-- for mobile screens -->

<!--
<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#demo2').skdslider({delay:5000, animationSpeed: 2000,showNextPrev:true,showPlayButton:true,autoSlide:true,animationType:'fading'});
			
			jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			  $(window).trigger('resize');
			});
			
		});
</script>
-->




</body>

</html>
