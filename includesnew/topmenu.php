<!-- 
This is the code included in topcontainer_shopping.php, which in turn is included in almost all pages, 
for displaying the navigation sections at the top 
-->

<div id="topcontainer">

	  <div id="toptop">
	  
		<div id="companylogo">
			<a href="index.php"><img src="imagesnew/logogoldblack.png" width="158" height="116" border=0/></a>
		</div>
	
		<a href="index.php">
			<!-- Displayed only for screens about 870px and less 	-->	
			<div id="companylogo_flattened">
			</div>	
			
			<!-- screens 550px and less -->		
			<div id="searchinmobile">  
			<a href="#"><img src="imagesnew/search_mobile_white.png" width="87" height="28" border="0"></a>
			</div>
		</a>
		
		
		<!-- Search form for screens about 1050px and less -->
		<div id="tfheader2">
			<form id="tfnewsearch" method="post" action="srchresults.php"> 
					<input type="text" id="tfq2" class="tftextinput42" name="keyword" value=""><input type="submit" value=" " class="tfbutton42" style="background: url('imagesnew/tf-search-icon22.png');">
			</form>
			<div class="tfclear2"></div>
		</div>
		<!--  -->
	  
	  
		<!-- This is the drop-down menu that is at the top right corner of the pages -->
		<div id="moredropdown" style="position: relative; z-index: 600;">
		
		<?php
		// If a designer is signed in, show hello <<tradeName>> but if it's a shopper, show hello <<shopperfname>>
		if (isset($_SESSION['tradeName'])) {
			echo '<a href="#"><span class="promoline" style="text-transform: uppercase;">HELLO ' . $_SESSION['tradeName'] . ' &nbsp;&nbsp;|</span></a><a href="logout.php"><span class="promoline">LOG OUT  &nbsp;&nbsp;|</span></a>';
		} else if (isset($_SESSION['shopperfname'])) {
			echo '<a href="#"><span class="promoline" style="text-transform: uppercase;">HELLO ' . $_SESSION['shopperfname'] . ' &nbsp;&nbsp;|</span></a><a href="logout.php"><span class="promoline">LOG OUT  &nbsp;&nbsp;|</span></a>';
		}
		?>
		
		
		
		<a href="#"><span class="promoline">FREE SHIPPING ON ORDERS OVER $75  &nbsp;&nbsp;&nbsp;|</span></a>
		
				<a href="index.php"><span class="toptoplinksother">HOME</span></a>
		
				<a href="myaccount.php"><span class="toptoplinksother">MY ACCOUNT</span></a>

				<a href="signin.php"><span class="toptoplinks">SIGN IN</span></a>

				<a href="view_cart.php?fromviewcart=true"><span class="toptoplinks">VIEW CART  <!--&nbsp;&nbsp;&nbsp;|--> </span></a>
			
			<ul class="nav">				
				<li style="float:right;position:relative; bottom:-8px;">
				   <span id="more">MORE</span> <img id="arrow" src="imagesnew/arrow.png" width="17" height="9" border="0" style="position:relative;bottom:4px;">
				   <div class="nav-columnmore">
						 
						 <?php
							include ('includesnew/footerfortop.php');
						  ?>
						
					</div>
				</li>
				
			</ul> 
		
		</div>
		
	  </div>
	
	  <div id="top">
	  
			<!-- THIS IS FOR THE TOP NAV MENU - FOR SMALLER SCREEN SIZES -->
			
			<!-- nav-menu (switch to this when screen becomes small - tablet sized) -->
			
			<?php 
			//Display the mobile main banner image (or not) and menus according to what page is on display
			//Other pages may be bringing their own banners, for example the designer and product pages
			
			// ($curPageName was retrieved in topcontainer_shopping.php)
			
			if (($curPageName == 'index.php')||($curPageName == 'designernav.php')) { 
			
			echo '<a class="mobilebanner" href="categresults.php?producttarget=women">
				<img alt="banner image 1"  width="100%" height="auto" src="imagesnew/banner-new500px.png" /> </a>';
			
			}			
			
			if ($curPageName == 'index.php') {
			
			//Display the stacked menu style for the home page for mobile screen sizes.
			
			echo '<div class="nav-menu-container">
				
					<div class="nav-menu">
						<ul class="clearfix">
							<li><a href="designernav.php"><h2>DESIGNERS</h2></a></li>
							<li><a href="categresults.php?producttarget=women"><h2>WOMEN</h2></a></li>
							<li><a href="categresults.php?producttarget=men"><h2>MEN</h2></a></li>
							<li><a href="categresults.php?producttarget=kids"><h2>KIDS</h2></a></li>
							<li><a href="categresults.php?producttype=accessories"><h2>ACCESSORIES</h2></a></li>
							<li><a href="signin.php"><h2>SIGN IN</h2></a></li>
							<li><a href="view_cart.php?fromviewcart=true"><h2>VIEW CART</h2></a></li>						
						</ul>
					</div>
					
				</div>';	
			}
			
			//Display the other menu style for other pages except home page. 
			
			if ($curPageName != 'index.php') { 
			
			echo '<div class="nav-menu-container">
					<div class="nav-menu-il">
					  <ul class="clearfix">
						<li><a href="designernav.php"><h2>DESIGNERS</h2></a></li>
						<li><a href="categresults.php?producttarget=women"><h2>WOMEN</h2></a></li>
						<li><a href="categresults.php?producttarget=men"><h2>MEN</h2></a></li>
						<li><a href="categresults.php?producttarget=kids"><h2>KIDS</h2></a></li>
						<li><a href="categresults.php?producttype=accessories"><h2>ACCESSORIES</h2></a></li>
						<li><a href="view_cart.php?fromviewcart=true"><h2>VIEW CART</h2></a></li>
						<li><a href="signin.php"><h2>SIGN IN</h2></a></li>
						<li><a href="myaccount.php"><h2 id="myacnt_link">MY ACCOUNT</h2></a></li>
						<li><a href="index.php"><h2>HOME</h2></a></li>
					  </ul>
				    </div>
				  </div>';
			}
			?>
			
			<div id="megamenucontainer_shopping">
					 
			<ul class="nav">
				<li>
					<a href="#"><h2>DESIGNERS</h2></a>
					<div class="nav-column1s">
						<div class="navcoldiv">
						
						<?php
						// Check if an alphabet letter was clicked
								if(isset($_GET['alph'])) {
									$alph = $_GET["alph"];
									echo '<h2>"' . $alph . '" Designers</h2>';
								} else {
									echo '<h2>"All" Designers</h2>';
								}
							
								
								
								
								
								// if an alphabet was clicked, replace the initial disigners list with only those 
								// whose names begin with the clicked alphabet
								
								if ($alph == '') { 						
									$q = "SELECT designerid, tradeName FROM `designers` WHERE tradeName REGEXP '^[abcdefghijklmnopqrstuvwxyz]' and status = 'active' ORDER BY tradeName LIMIT 50";		
								} else {	
									$q = "SELECT designerid, tradeName FROM `designers` WHERE tradeName LIKE '$alph%' and status = 'active' ORDER BY tradeName LIMIT 50";		
								}	
									$r = @mysqli_query ($dbc, $q); // Run the query.
										
									if ($r) { // If it ran OK, display the records.
																
									// Fetch and display all the records:
									while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
									// echo '<a href="designersd.php?designerid=' . $row['designerid'] . '">' . $row['tradeName'] . '</a><br>';
									echo '<a href="categresults.php?designerid=' . $row['designerid'] . '">' . $row['tradeName'] . '</a><br>';
									}
								
									mysqli_free_result ($r); // Free up the resources.	
								
									} else { // If it did not run OK.

									// Public message:
									echo '<p class="error">No designers could be retrieved. We apologize for any inconvenience.</p>';	
									
								} // End of if ($r) IF.
							?>
						
						
						</div>
						
						<div class="navcoldiv" style="display:none;"> <!-- we are hiding display for the m - z half and adding the designers to the a - l part until we have several designers -->
						
						 <h2>&nbsp;</h2>
							
							
							<?php	
							
								// if an alphabet was clicked, hide this column
								if ($alph == '') {
						
									$q = "SELECT designerid, tradeName FROM `designers` WHERE tradeName REGEXP '^[mnopqrstuvwxyz]' and status = 'active' ORDER BY tradeName LIMIT 50";				
									$r = @mysqli_query ($dbc, $q); // Run the query.
										
									if ($r) { // If it ran OK, display the records.
																
									// Fetch and display all the records:
									while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
									//echo '<a href="designerdetails.php?designerid=' . $row['designerid'] . '">' . $row['tradeName'] . '</a><br>';
									echo '<a href="categresults.php?designerid=' . $row['designerid'] . '">' . $row['tradeName'] . '</a><br>';
									}
								
									mysqli_free_result ($r); // Free up the resources.	
								
									} else { // If it did not run OK.

									// Public message:
									echo '<p class="error">No designers could be retrieved. We apologize for any inconvenience.</p>';	
									
									} // End of if ($r) IF.
								} else {
								
									echo '&nbsp;';
								
								}

							?>
						
						
						</div>
					 
						<div class="navcoldiv">
					 
						
						<h2>Alphabetical</h2>
						
						
							<table border=0 cellspacing=0 cellpadding=0>
							<tr>				
								<td width=35 class="topleft-aligned">			
								<a href="<?php echo $curPageName ?>" class="colorlink">All</a>	<!-- If user presses "All" pass nothing via the URL so that the entire list will display -->			
								<br><a href="<?php echo $curPageName ?>?alph=A" class="colorlink">A</a>
								<br><a href="<?php echo $curPageName ?>?alph=B" class="colorlink">B</a>
								<br><a href="<?php echo $curPageName ?>?alph=C" class="colorlink">C</a>
								<br><a href="<?php echo $curPageName ?>?alph=D" class="colorlink">D</a>
								<br><a href="<?php echo $curPageName ?>?alph=E" class="colorlink">E</a>
								<br><a href="<?php echo $curPageName ?>?alph=F" class="colorlink">F</a>
								</td>
								
								<td width=35 class="topleft-aligned">	
								<a href="<?php echo $curPageName ?>?alph=G" class="colorlink">G</a>
								<br><a href="<?php echo $curPageName ?>?alph=H" class="colorlink">H</a>
								<br><a href="<?php echo $curPageName ?>?alph=I" class="colorlink">I</a>
								<br><a href="<?php echo $curPageName ?>?alph=J" class="colorlink">J</a>
								<br><a href="<?php echo $curPageName ?>?alph=K" class="colorlink">K</a>
								<br><a href="<?php echo $curPageName ?>?alph=L" class="colorlink">L</a>
								<br><a href="<?php echo $curPageName ?>?alph=M" class="colorlink">M</a>
								</td>
								
								<td width=35 class="topleft-aligned">	
								<a href="<?php echo $curPageName ?>?alph=N" class="colorlink">N</a>	
								<br><a href="<?php echo $curPageName ?>?alph=O" class="colorlink">O</a>
								<br><a href="<?php echo $curPageName ?>?alph=P" class="colorlink">P</a>			
								<br><a href="<?php echo $curPageName ?>?alph=Q" class="colorlink">Q</a>
								<br><a href="<?php echo $curPageName ?>?alph=R" class="colorlink">R</a>
								<br><a href="<?php echo $curPageName ?>?alph=S" class="colorlink">S</a>
								<br><a href="<?php echo $curPageName ?>?alph=T" class="colorlink">T</a>
								</td>
								
								<td width=35 class="topleft-aligned">
								<a href="<?php echo $curPageName ?>?alph=U" class="colorlink">U</a>
								<br><a href="<?php echo $curPageName ?>?alph=V" class="colorlink">V</a>
								<br><a href="<?php echo $curPageName ?>?alph=W" class="colorlink">W</a>
								<br><a href="<?php echo $curPageName ?>?alph=X" class="colorlink">X</a>
								<br><a href="<?php echo $curPageName ?>?alph=Y" class="colorlink">Y</a>
								<br><a href="<?php echo $curPageName ?>?alph=Z" class="colorlink">Z</a>
								</td>
							</tr>
							</table>
						
						
						</div>
					</div>
				</li>
				<li>
					<a href="categresults.php?producttarget=women"><h2>WOMEN</h2></a>
					<div class="nav-column2s">
						<div class="navcoldiv">
						
						 <h3>&nbsp;</h3>
						
							<a href="categresults.php?producttarget=women">All</a><br>
							
							
							<?php	
						
									$q = "SELECT distinct productcategory FROM `products` where producttarget = 'women' and producttype in ('apparel','shoes') and status = 'active'";		
									$r = @mysqli_query ($dbc, $q); // Run the query.
										
									if ($r) { // If it ran OK, display the records.
																
									// Fetch and display all the records:
									while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
									echo '<a href="categresults.php?productcategory=' . $row['productcategory'] . '&producttarget=women">' . $row['productcategory'] . '</a><br>';
									}
								
									mysqli_free_result ($r); // Free up the resources.	
								
									} else { // If it did not run OK.

									// Public message:
									echo '<p class="error">No categories could be retrieved. We apologize for any inconvenience.</p>';	
									
									} // End of if ($r) IF.

							?>	
							<!-- hiding until more category data is in database then it will be retrievable onto the web page
							<a href="categresults.php" class="colorlink">Evening</a>
							<br><a href="categresults.php" class="colorlink">Tops</a>
							<br><a href="categresults.php" class="colorlink">Sweaters</a>
							<br><a href="categresults.php" class="colorlink">Cashmere</a>
							<br><a href="categresults.php" class="colorlink">Coats</a>
							<br><a href="categresults.php" class="colorlink">Jackets & Vests</a>
							<br><a href="categresults.php" class="colorlink">Denim</a>
							<br><a href="categresults.php" class="colorlink">Pants & Shorts</a>
							<br><a href="categresults.php" class="colorlink">Skirts</a>
							<br><a href="categresults.php" class="colorlink">Jumpsuits</a>
							<br><a href="categresults.php" class="colorlink">Suiting</a>
							<br><a href="categresults.php" class="colorlink">Swim</a>
							<br><a href="categresults.php" class="colorlink">Lingerie</a>
							<br><a href="categresults.php" class="colorlink">Lounge & Sleepwear</a>
							-->
							Evening<br>
							Shorts
						
						
						</div>
					 
						<div class="navcoldiv">
					 
						<div class="navcoldiv">
						</div>
					 
						<img src="imagesnew/menu_sal.png" width="29" height="13" border="0" style="margin-top:29px;">
						<!--
						<ul>
							<li><a href="#">Driving shoes</a></li>
							<li><a href="#">Espadrilles</a></li>
						</ul>
						-->
						
						</div>
					</div>
				</li>
				<li>
					<a href="categresults.php?producttarget=men"><h2>MEN</h2></a>
					<div class="nav-column3s">
						<div class="navcoldiv">
						
						 <h3>&nbsp;</h3>
						
							<a href="categresults.php?producttarget=men">All</a><br>
							
							
							<?php	
						
									$q = "SELECT distinct productcategory FROM `products` where producttarget = 'men' and producttype in ('apparel','shoes') and status = 'active'";		
									$r = @mysqli_query ($dbc, $q); // Run the query.
										
									if ($r) { // If it ran OK, display the records.
																
									// Fetch and display all the records:
									while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
									echo '<a href="categresults.php?productcategory=' . $row['productcategory'] . '&producttarget=men">' . $row['productcategory'] . '</a><br>';
									}
								
									mysqli_free_result ($r); // Free up the resources.	
								
									} else { // If it did not run OK.

									// Public message:
									echo '<p class="error">No categories could be retrieved. We apologize for any inconvenience.</p>';	
									
									} // End of if ($r) IF.

							?>	
							<!-- hiding until more category data is in database then it will be retrievable onto the web page
							<a href=# class="colorlink">Suits & Blazers</a>
							<br><a href=# class="colorlink">Coats & Jackets</a>
							<br><a href=# class="colorlink">Sweaters & Sweatshirts</a>
							<br><a href=# class="colorlink">Cashmere</a>
							<br><a href=# class="colorlink">Sport Shirts</a>
							<br><a href=# class="colorlink">Dress Shirts</a>
							<br><a href=# class="colorlink">Polos & Tees</a>
							<br><a href=# class="colorlink">Denim</a>
							<br><a href=# class="colorlink">Pants</a>
							<br><a href=# class="colorlink">Shorts & Swim</a>
							<br><a href=# class="colorlink">Formalwear</a>
							<br><a href=# class="colorlink">Sleepwear & Robes</a>
							<br><a href=# class="colorlink">Underwear & Socks</a>
							-->
							Suits & Blazers<br>
							Pants<br>
							Shorts & Swim<br>
							Formalwear
						
						
						</div>
					 
						<div class="navcoldiv">					 
						
						<div class="navcoldiv">
						</div>
						
						<img src="imagesnew/menu_sal.png" width="29" height="13" border="0" style="margin-top:29px;">
						<!--
						<ul>
							<li><a href="#">Driving shoes</a></li>
							<li><a href="#">Espadrilles</a></li>
						</ul>
						-->
						
						</div>
					</div>
				</li>
				<li>
					<a href="categresults.php?producttarget=kids"><h2>KIDS</h2></a>
				   <div class="nav-column4s">
						<div class="navcoldiv">
						
						 <h3>&nbsp;</h3>
						
							<a href="categresults.php?producttarget=kids">All</a><br>
							
							
							<?php	
						
									$q = "SELECT distinct productcategory FROM `products` where producttarget = 'kids' and producttype in ('apparel','shoes') and status = 'active'";		
									$r = @mysqli_query ($dbc, $q); // Run the query.
										
									if ($r) { // If it ran OK, display the records.
																
									// Fetch and display all the records:
									while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
									//echo '<a href="kidsresults.php?productcategory=' . $row['productcategory'] . '">' . $row['productcategory'] . '</a><br>';
									echo '<a href="categresults.php?productcategory=' . $row['productcategory'] . '&producttarget=kids">' . $row['productcategory'] . '</a><br>';
									}
								
									mysqli_free_result ($r); // Free up the resources.	
								
									} else { // If it did not run OK.

									// Public message:
									echo '<p class="error">No categories could be retrieved. We apologize for any inconvenience.</p>';	
									
									} // End of if ($r) IF.

							?>	
							Blanket & Baths<br>
							Diaper Bags<br>
							Toys & Gifts<br>
							Strollers & Gear<br>
							Newborns
						
						
						</div>
					 
						<div class="navcoldiv">
						
						<div class="navcoldiv">
						</div>
						
						<img src="imagesnew/menu_sal.png" width="29" height="13" border="0" style="margin-top:29px;">
						<!--
						<ul>
							<li><a href="#">Driving shoes</a></li>
							<li><a href="#">Espadrilles</a></li>
						</ul>
						-->
						
						</div>
					</div>
				</li>
				<li>
					<a href="categresults.php?producttype=accessories"><h2>ACCESSORIES</h2></a>
				   <div class="nav-column5s">
						<div class="navcoldiv">
						
						 <h3>&nbsp;</h3>
						
							<a href="categresults.php?producttype=accessories">All</a><br>
							
							
							<?php	
						
									$q = "SELECT distinct productcategory FROM `products` where producttype = 'accessories' and status = 'active'";		
									$r = @mysqli_query ($dbc, $q); // Run the query.
										
									if ($r) { // If it ran OK, display the records.
																
									// Fetch and display all the records:
									while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
									//echo '<a href="womenresults.php?productcategory=' . $row['productcategory'] . '">' . $row['productcategory'] . '</a><br>';
									echo '<a href="categresults.php?productcategory=' . $row['productcategory'] . '&producttarget=women&producttype=accessories">' . $row['productcategory'] . '</a><br>';
									}
								
									mysqli_free_result ($r); // Free up the resources.	
								
									} else { // If it did not run OK.

									// Public message:
									echo '<p class="error">No categories could be retrieved. We apologize for any inconvenience.</p>';	
									
									} // End of if ($r) IF.

							?>	
							<!-- hiding until more category data is in database then it will be retrievable onto the web page
							<a href="womenresults.php" class="colorlink">Evening</a>
							<br><a href="womenresults.php" class="colorlink">Tops</a>
							<br><a href="womenresults.php" class="colorlink">Sweaters</a>
							<br><a href="womenresults.php" class="colorlink">Cashmere</a>
							<br><a href="womenresults.php" class="colorlink">Coats</a>
							<br><a href="womenresults.php" class="colorlink">Jackets & Vests</a>
							<br><a href="womenresults.php" class="colorlink">Denim</a>
							<br><a href="womenresults.php" class="colorlink">Pants & Shorts</a>
							<br><a href="womenresults.php" class="colorlink">Skirts</a>
							<br><a href="womenresults.php" class="colorlink">Jumpsuits</a>
							<br><a href="womenresults.php" class="colorlink">Suiting</a>
							<br><a href="womenresults.php" class="colorlink">Swim</a>
							<br><a href="womenresults.php" class="colorlink">Lingerie</a>
							<br><a href="womenresults.php" class="colorlink">Lounge & Sleepwear</a>
							-->
							Scarves<br>
							Wraps & Stoles<br>
							Capes, Ponchos & Vests<br>
							Fur<br>
							Hats & Gloves<br>
							Belts
						
						
						</div>
					 
						<div class="navcoldiv">
					 
						<div class="navcoldiv">
						</div>
					 
						<img src="imagesnew/menu_sal.png" width="29" height="13" border="0" style="margin-top:29px;">
						<!--
						<ul>
							<li><a href="#">Driving shoes</a></li>
							<li><a href="#">Espadrilles</a></li>
						</ul>
						-->
						
						</div>
					</div>
				</li>
				
				<!--
				
				<li>
					<a href="#"><h2>EVENTS</h2></a>				   
				</li>
				
				<li>
					<a href="#"><h2>BOUTIQUES</h2></a>				   
				</li>
				
				-->
				
			</ul>
												   
		  </div>  

		<!-- Search form for wider screens -->
		<div id="tfheader">
			<form id="tfnewsearch" method="post" action="srchresults.php">
					<input type="text" id="tfq" class="tftextinput4" name="keyword" value=""><input type="submit" value=" " class="tfbutton4" style="background: url('imagesnew/tf-search-icon22.png');">
			</form>
			<div class="tfclear"></div>
		</div>
		
		<div id="carticon">
			<a href="view_cart.php?fromviewcart=true&productid="' . <?php echo $productid; ?> . '"><img id="ci" src="imagesnew/carticon.png" height="26" width="26" border="0" alt="View Cart" title="View Cart"></a>
		</div>
		
		<div id="signinicon">  
			<a href="signin.php"><img id="si" src="imagesnew/headicon.png" height="27" width="27" border="0" alt="Sign In" title="Sign In"></a>
			
		</div>

	  </div>
	  
	  
	  
  
  </div>
  
