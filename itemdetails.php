<?php
session_start(); // Start session: first thing in script

error_reporting(E_ERROR);


// ini_set('display_errors', 'On');

$title='Item Details';
include ('includesnew/topcontainer_shopping.php');




// Check if the URL and form values were passed:

	
	if(isset($_GET['productid'])) {
		$_SESSION['productid'] = $_GET["productid"];  /* Store in session because page loses it upon refresh after the Add to Cart button is pressed */
	}
	
	if(isset($_GET['pcartid'])) {
		$pcartid = $_GET["pcartid"];
	}
	
	if(isset($_POST['pcartid'])) {
		$pcartid = $_POST["pcartid"];
	}
	
	// Assign productid from the session to a variable. This persists even upon page refresh
	$productid = $_SESSION['productid'];	
	
	if(isset($_GET['productimageid'])) {
		$productimageid = $_GET["productimageid"];
	} 
	
	if(isset($_GET['tab'])) { /* to identify whether the OPTIONS or the DESCRIPTION tab was clicked */
		$tab = $_GET["tab"];
	}
		
	// Retrieve most of the info about the selected product...
	
	// If we are coming from the shopping cart, use the pcartid instead of productid 
	// (because pcartid reflects the combined productid, size and color, necessary to track items in the shopping cart)
	if($pcartid != '') {
		$q = "select distinct prodcarttable.pcartid, prodcarttable.productid, designers.tradeName, prodcarttable.productname, prodcarttable.productprice, prodcarttable.productdescription from prodcarttable
		inner join designers
		on prodcarttable.designerid = designers.designerid
		inner join productsize
		on prodcarttable.sizeid = productsize.sizeid
		inner join productcolor
		on prodcarttable.productcolorid = productcolor.productcolorid
		WHERE prodcarttable.pcartid='$pcartid'";
	} else {	
		$q = "select distinct products.productid, designers.tradeName, products.productname, products.productprice, products.productdescription from products
		inner join designers
		on products.designerid = designers.designerid
		inner join productsize
		on products.productid = productsize.productid
		inner join productcolor
		on products.productid = productcolor.productid
		WHERE products.productid='$productid'";
	}

	// echo '<br>' . $q . '<br>';
	
	$r = @mysqli_query ($dbc, $q); // Run the query.

	if ($r) { // If it ran OK, display the records.	
	
		//get results for display
			while ($row = mysqli_fetch_array($r)) {
			$productid = $row["productid"];
			$tradeName = $row["tradeName"];
			$productname = $row["productname"];
			$productprice = $row["productprice"];
			$productdescription = $row["productdescription"];			
			}
			

			
			mysqli_free_result ($r); // Free up the resources.	
					
			} else { // If it did not run OK.

			// Public message:
			echo '<p class="redtext">The product details could not be retrieved. We apologize for any inconvenience.</p>';
					
			} // End of if ($r) IF.



			
// FROM THIS POINT ON, WE ARE DISPLAYING PRODUCT IMAGES (AND THEIR THUMBNAILS), PRODUCT NAME/DESCRIPTION, 
// ADD TO CART BUTTON, AND THE OPTIONS/DESCRIPTION TABS. 
// SECTION BY SECTION EXPLANATION OF HOW EVERYTHING IS LAID OUT IN CODE & HTML ARE AS FOLLOWS.....	




/////////////////////////////////////////////////////////////////////////////////////		
// SQL QUERRY TO RETRIEVE THE LARGE PRODUCT IMAGE THAT IS DISPLAYED UPON PAGE LOAD //
/////////////////////////////////////////////////////////////////////////////////////	

	// Retrieve first photo for this product based on the passed pcartid or productid  
	// (But if we're coming to this page from a click of one of the thumbnails, retrieve the large photo 
	// based on the productimageid passed by clicking of the thumbnail)
	
	if($pcartid != '') {
		$q = "SELECT productimage FROM productimages inner join prodcarttable
		on productimages.productid = prodcarttable.productid 		
		WHERE prodcarttable.pcartid = '$pcartid' order by productimages.productimageid limit 1";
	} else if ($productimageid == '') {
		$q = "SELECT productimage FROM productimages WHERE productid = '$productid' order by productimageid limit 1";		
	} else {	
		$q = "SELECT productimage FROM productimages WHERE productimageid = '$productimageid'";
	}
/* echo '<br>' . $q . '<br>';	 */
	$r = @mysqli_query ($dbc, $q); // Run the query.

	if ($r) { // If it ran OK, display the records.	
	
		//get results for display
			while ($row = mysqli_fetch_array($r)) {
			$productimage = $row["productimage"];
			}
					
			mysqli_free_result ($r); // Free up the resources.	
					
			} else { // If it did not run OK.

			// Public message:
			echo '<p class="redtext">The product image could not be retrieved. We apologize for any inconvenience.</p>';
					
			} // End of if ($r) IF.

//////////////////////////////////////////////////		
//                    END                       //
//////////////////////////////////////////////////
	
?>



  
<div id="bottomcontainer"> 
  
    <div id="bottom">
			
		<div id="itemdetailssection-idp">
		
		
		
<!-- /////////////////////////////////////////////////////////////////////////////////////		
// SMALL SCREEN SIZES ONLY: THE DESIGNER NAME, PRODUCT NAME, PRICE, AND ITEM NUMBER     //
// THAT IS DISPLAYED ABOVE THE PRODUCT IMAGE 											//	
///////////////////////////////////////////////////////////////////////////////////// -->

			<div id="prodtitlearea_ss">  
				
							<h1 id="idtx6"><?php echo "$tradeName"; ?></h1>
							
							<h1 id="idtx1"><?php echo "$productname"; ?></h1>
													
							
							<h1 id="idtx2">$
							<?php 
								if (isset($productprice)) {
								echo $productprice; 
								} else {
								echo 'XYZ'; 
								}
							?>
							</h1>
							
							<span id="idnum1">Item #							
							<?php 
							if($pcartid != '') {
								echo "$pcartid";
							} else {
								echo "$productid";
							}
							?>
							</span>
				
			</div>
<!--//////////////////////////////////////////////////		
//                        END                       //
///////////////////////////////////////////////////-->




<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////		
// CODE THAT POPULATES THUMBNAILS ON THE LEFT AND UPON CLICKING EACH ONE, DISPLAYS LARGE IMAGE ON THE RIGHT 											//	
/////////////////////////////////////////////////////////////////////////////////////////////////////// -->
		
			<div id="prodviews">	
				
			
				<div id="thumbnails">
					
						<?php
						
						if($pcartid != '') {
							$q = "SELECT productimageid, productimgthumbnail FROM productimages inner join prodcarttable
								on productimages.productid = prodcarttable.productid 		
								WHERE prodcarttable.pcartid = '$pcartid' limit 6";
						} else {	
							$q = "SELECT productimageid, productimgthumbnail FROM productimages WHERE productid = '$productid' limit 6";	
						}
						// echo '<br>' . $q . '<br>';  
							$r = @mysqli_query ($dbc, $q); // Run the query.
												
							if ($r) { // If it ran OK, display the records.
												
								// Fetch and print all the records:
								while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
													
									echo '<a id="producttmba" href=itemdetails.php?productid=' . $productid . '&pcartid=' . $pcartid . '&productimageid=' . $row['productimageid'] . '><img id="producttmb" border=0 src="' . $row['productimgthumbnail'] . '"></a><br>';
													
									}	

									$num = mysqli_num_rows($r);					
									if ($num == 0) {
										echo 'No image thumbnails were found for this product.';
									}
													
									mysqli_free_result ($r); // Free up the resources.
													
									} else { // If it did not run OK.

									// Public message:
									echo 'The thumbnails could not be retrieved. We apologize for any inconvenience.</p>';										
													
									}
						?>
					
				</div>
				
				<div id="imgshown">
				
					<table border=0 cellspacing=0 cellpadding=0 width="100%">
							
							<tr>
								<td id="flexidttd1" class="topleft-aligned">
								
								
								
								<img border=0 src="<?php echo "$productimage"; ?>" width="100%" height="auto"> <!-- large image URL of selected apparel goes here -->
								</td>
								<td id="flexidttd2">
								&nbsp;
								</td>
							</tr>
						
					</table>
				
				</div>
			</div>
			
<!--//////////////////////////////////////////////////		
//                        END                       //
///////////////////////////////////////////////////-->
			
			<div id="prodinfocontainer">
			
			  <form action="itemdetails.php" id="options-form" method="post">
			  
			  
			  
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
// CODE THAT DISPLAYS INFORMATION ABOUT THE ADDED ITEM, AND SHOWS THE "ADD TO CART" BUTTON, AND THE "ITEM ADDED TO CART" MESSAGE 											//	
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
			  
			
				<div id="prodtitlearea">   <!-- WIDER SCREENS ONLY: HERE, THE DESIGNER NAME, PRODUCT, PRICE, AND ITEM NUMBER ARE DISPLAYED -->
				
							<h1 id="idtx6"><?php echo "$tradeName"; ?></h1>
							
							<h1 id="idtx1"><?php echo "$productname"; ?></h1>
													
							
							<h1 id="idtx2">$
							<?php 
								if (isset($productprice)) {
								echo $productprice; 
								} else {
								echo 'XYZ'; 
								}
							?>
							</h1>
							
							<span id="idnum1">Item #							
							<?php 
							if($pcartid != '') {
								echo "$pcartid";
							} else {
								echo "$productid";
							}
							?>
							</span>
				
				</div>
				<div id="prodbuttonarea">   <!-- HERE, THE ADD TO CART BUTTON DISPLAYED -->
				
							<div id="idt6">
							
								<div style="margin-right:12px; display:inline;float:left;">
									<input type="image" border=0 src="imagesnew/addtocart_orange_big.png" height="auto" width="100%" />
								</div>
								<!--<div style="width:46%;padding:10px 0 7px 0;background-color:#F0F2ED;text-align:center;display:inline;float:left;border-style:solid; border-color:#D0CECE; border-width:1px;"><h1><?php //echo '<a style="color:#202020;font-size:20px;" href=add_wishlist.php?productid=' . $productid . '&pcartid=' . $pcartid . '>ADD TO WISH LIST</a>'; ?></h1></div>-->
								<!-- Previous wish list button width: 220px. Now 220/477 * 100% -->
								<br>
								
								<input type="hidden" name="productid" value="<?php echo $productid; ?>"><br>
								<input type="hidden" name="pcartid" value="<?php echo $pcartid; ?>"><br>
								<input type="hidden" name="a2ctclicked" value="true"><br>
								<input type="hidden" name="action" value="add"><br>
								<input type="hidden" name="qty" value="1">  
							
							</div>
				
				</div>	
				
				<?php // Run the cart code only after the Add to Cart button is clicked (i.e. "a2ctclicked" is set)
				if (isset($_POST['a2ctclicked'])) {  
				?>
				
				
				<!-- HERE, THE CARTNEW.PHP CODE IS EXECUTED, AND IT DISPLAYS THE "ITEM HAS BEEN ADDED TO THE CART" MESSAGE
				Within the cartnew.php code also, there is a function that validates that Size and Color were selected 
				and if not selected, would show this message "Size and Color must both be selected. Please try again" 
				
				The CARTNEW.PHP code also has an an include file, showcart.php, which is for displaying the cart whenever 
				the user clicks on the "view cart" link or icon (view_cart.php) -->
				
				<div id="prodadded">  				
					<?php
					include ('cartnew.php');     
					?>
				</div>	
				
				<?php 
				}  
				?>
				
<!--//////////////////////////////////////////////////		
//                        END                       //
///////////////////////////////////////////////////-->
				
				


<!-- //////////////////////////////////////////////////////////////////		
// CODE THAT DISPLAYS THE DESCRIPTION AND OPTIONS (COLOR, SIZE) TABS //	
////////////////////////////////////////////////////////////////////-->
				
				<div id="prodinfoarea">
				
				
						<div id="navbar">
								<div id="holder">
								
								<ul>
								
								<?php
								
								// if the "description" tab was clicked, the id of the DESCRIPTION tab will have a value.
								// if instead, the "options" tab was clicked, the id of the OPTIONS tab will have a value.
								// the id value will then be used by the stylesheet (styles.css) to set the properties of the 
								// active tab to reflect that it is the active tab
								
								if ($tab == 'description') {
									$iddesc = 'onlink';
								} else {
									$idsel = 'onlink'; /* This insures that the OPTIONS tab is the default tab */
								}	
								
								echo '<li><a class="asel" id="' . $idsel . '" href=itemdetails.php?productid=' . $productid . '&pcartid=' . $pcartid . '&productimageid=' . $row['productimageid'] . '&tab=selector>OPTIONS</a></li>';
								echo '<li><a class="adesc" id="' . $iddesc . '" href=itemdetails.php?productid=' . $productid . '&pcartid=' . $pcartid . '&productimageid=' . $row['productimageid'] . '&tab=description>DESCRIPTION</a></li>'; 
								
								?>

								
								
								</ul>
								
								</div> <!-- end holder div -->
						</div> <!-- end navbar div -->
							
						<div id="idtcontent">
							
								<?php

								// Inside the tabs' detail part, the description and options data retrieved from the database will be shown
								// If the active tab is DESCRIPTION, the description data is retrieved and shown
								// But if the active tab is OPTIONS, the options (color, size) data is retrieved, styled by 
								// the stylesheet (style.css), and shown		
								
								if ($tab == 'description') {
								 
								echo '<h1 id="idtx3">Product Description</h1>' . $productdescription;	
									
								} else { // if $tab == '' or == selector. In other words, we are making OPTIONS the default tab...										

													if($pcartid != '') {
													
													// First extract the productid
													$str = $pcartid;
													$productidpart = explode("-", $str);
													$productid = $productidpart[0];
													
														$q1 = "SELECT productcolor.color,productcolor.styleid from products
														inner join productcolor
														on products.productid = productcolor.productid
														WHERE products.productid='$productid'";	
														
														$q2 = "SELECT productsize.size,productsize.styleid from products
														inner join productsize
														on products.productid = productsize.productid
														WHERE products.productid='$productid'";
													} else {
								
														$q1 = "SELECT productcolor.color,productcolor.styleid from products
														inner join productcolor
														on products.productid = productcolor.productid
														WHERE products.productid='$productid'";	
														
														$q2 = "SELECT productsize.size,productsize.styleid from products
														inner join productsize
														on products.productid = productsize.productid
														WHERE products.productid='$productid'";
													}
													/* echo '<br>' . $q1 . '<br>';
													echo '<br>' . $q2 . '<br>';  */
													
														$r1 = @mysqli_query ($dbc, $q1); 
														$r2 = @mysqli_query ($dbc, $q2); 
																			
														

														if ($r2) { // If it ran OK, display the records.
														
															echo '<h2 style="margin-bottom:5px;margin-top:30px;">SIZE</h2>
															<table width="210" cellspacing=0 cellpadding=0 border=0>
															<tr>';
																			
															// Fetch and print all the records:
															while ($row = mysqli_fetch_array($r2, MYSQLI_ASSOC)) {																

																echo '<td><input name="size" id="' . $row['styleid'] . '" type="radio" value="' . $row['size'] . '">
																	<label for="' . $row['styleid'] . '">' . $row['size'] . '</label></td>';	
																}

																$num = mysqli_num_rows($r2);					
																if ($num == 0) {
																	echo 'No size data were found for this product.';
																}
																				
																mysqli_free_result ($r2); // Free up the resources.
																
															echo '</tr>
															</table>';		
																				
																} else { // If it did not run OK.

																// Public message:
																echo 'The size data could not be retrieved. We apologize for any inconvenience.</p>';										
																				
																}
																
														echo '<p style="margin-top:10px;"><a class="colorlink" href="#">Click here</a> to use the size chart </p>';		
																
														if ($r1) { // If it ran OK, display the records.
														
															echo '<h2 style="margin-bottom:5px;margin-top:30px;">COLOR</h2>
															<table width="210" cellspacing=0 cellpadding=0 border=0>
															<tr>';
																			
															// Fetch and print all the records:
															while ($row = mysqli_fetch_array($r1, MYSQLI_ASSOC)) {
																
																echo '<td><input name="color" id="' . $row['styleid'] . '" type="radio" value="' . $row['color'] . '">
																	<label for="' . $row['styleid'] . '">' . $row['color'] . '</label></td>';	
																}

																$num = mysqli_num_rows($r1);					
																if ($num == 0) {
																	echo 'No color data were found for this product.';
																}
																				
																mysqli_free_result ($r1); // Free up the resources.
																
															echo '</tr>
															</table>';		
																				
																} else { // If it did not run OK.

																// Public message:
																echo 'The color data could not be retrieved. We apologize for any inconvenience.</p>';										
																				
																}
																
															echo '<p style="margin-top:10px;">Need help in selecting? Call 1.888.555.1212 </p>';	
		
								}
								?>
								
						</div>
				
				</div>
				
<!--//////////////////////////////////////////////////		
//                        END                       //
///////////////////////////////////////////////////-->

					
			  </form>
			  
			</div>
    
		</div>
    
	</div>
    
  </div>  
	

<?php
include ('includesnew/footertall.php');
?>
  
	
</div>

 
</body>

</html>
