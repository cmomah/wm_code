<?php
mysqli_close($dbc); // Close the database connection.
?>

<!-- The footer navigation div (bottomnavcontainercolor) is hidden until screensize 
is about 720px then it gets displayed via the media query code (see styles.css) -->	

<div class="bottomnavcontainercolor">
	
	  <div class="bottomnavcontainer">
	
		<div class="bottommenus">
		
			<table cellspacing=0 cellpadding=0 width="100%" border=0> <!-- Previous: 900px -->
				<tr>
					<td width="40%" style="vertical-align: top;">
					<p style="line-height: 120%;">
					
					<h4 class="footerheader">Our Information</h4>
					<a class="bottommenu" href="index.php">Home</a><br>
					<a class="bottommenu" href="aboutus.php">About Us</a><br>
					<a class="bottommenu" href="contactus.php">Contact Us</a><br>
					<a class="bottommenu" href=#>Customer Services</a> 
					

					</p>
					</td>
					
					<td width="40%" style="vertical-align: top;">
					<p style="line-height: 120%;">

					<h4 class="footerheader">Our Services</h4>	
					<a class="bottommenu" href=#>Shipping & Returns</a><br>
					<a class="bottommenu" href=#>Secure Shopping</a><br>
					<a class="bottommenu" href=#>International Shipping</a><br>
					<a class="bottommenu" href=#>Gift Cards</a>

					</p>
					</td>
					
					<td width="20%" style="vertical-align: top;">
					
					<p style="line-height: 120%;">

					<h4 class="footerheader">My Account</h4>	
					<a class="bottommenu" href="signin.php">Shopper Sign in </a><br>
					<a class="bottommenu" href="dessignin.php">Designer Sign in </a><br>
					<a class="bottommenu" href="myaccount.php">My Account</a><br>
					<a class="bottommenu" href="view_cart.php?fromviewcart=true&productid="' . <?php echo $productid; ?> . '">View Cart</a><br>
					<a class="bottommenu" href="myaccountdes.php">Designer Account</a>
					</p>
					</td>
				</tr>
			</table>
		
		</div>
		
		<div id="social2">
				  <ul>
					<li><a href="#"><img class="footersocial" border=0 src="imagesnew/facebook2.png"></a></li> 
					<li><a href="#"><img class="footersocial" border=0 src="imagesnew/twitter2.png"></a></li> 
					<li><a href="#"><img class="footersocial" border=0 src="imagesnew/youtube2.png"></a></li>
				  </ul>
		</div>
		
	  </div>
	  		
	</div>
	
	
	<div class="privacycontainercolor">
	
		<div class="privacycontainer">
		
			<div class="privacy">
				<table cellspacing=0 cellpadding=0 width="100%" height=50 border=0>						
					<tr height=50>
					    <td style="vertical-align:bottom;">
						<a class="copyright" href="index.php">Waxmode Fashion &copy; 2014.</a> &nbsp;&nbsp;<a class="copyright" href=#>Privacy Policy</a> 
						</td>
					</tr>
				</table>
			</div>	
			
		</div>
		
	</div>	

<script src="jsnew/search.js"></script>
<script src="jsnew/search2.js"></script>
<script src="jsnew/menuscript.js"></script>
	
	