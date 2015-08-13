<?php 
session_start();

$title='Edit Shipping Address';
include ('includesnew/topcontainer_shopping.php');

// Coming from my account page
	if(isset($_GET['frommyct'])) {
		$frommyct = $_GET['frommyct'];
	}
	
// Coming from editing of address
	if(isset($_POST['frommyct'])) {
		$frommyct = $_POST['frommyct'];
	}	
	
// Coming from shipping page
	if(isset($_GET['fromshp'])) {
		$fromshp = $_GET['fromshp'];
	}
	
// Coming from editing of address
	if(isset($_POST['fromshp'])) {
		$fromshp = $_POST['fromshp'];
	}	

// Retrieve shopper's id if signed in 	
	if(isset($_SESSION['shopperid'])) {
		$shopperid = $_SESSION['shopperid'];
	}	
	
	if($shopperid != '') {
	$q = "select shopperfname, shopperlname, shopperaddr, shoppercity, shopperstate, shopperzip, shoppercountry, shopperphone from shoppers
	WHERE shopperid='$shopperid'";
	}
	
	// echo '<br>' . $q . '<br>';
	
	$r = @mysqli_query ($dbc, $q); // Run the query.

	if ($r) { // If it ran OK, display the records.	
	
	//get results for display
	while ($row = mysqli_fetch_array($r)) {
		$shopperfname = $row["shopperfname"];
		$shopperlname = $row["shopperlname"];
		$shopperaddr = $row["shopperaddr"];
		$shoppercity = $row["shoppercity"];
		$shopperstate = $row["shopperstate"];
		$shopperzip = $row["shopperzip"];
		$shoppercountry = $row["shoppercountry"];
		$shopperphone = $row["shopperphone"];			
		}
			
		mysqli_free_result ($r); // Free up the resources.	
					
		} else { // If it did not run OK.

		// Public message:
		echo '<p class="redtext">Your address could not be retrieved. We apologize for any inconvenience.</p>';
					
		} // End of if ($r) IF.
		
		
//Update..
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		// Check for form submission		 
				
			$errors = array(); // Initialize an error array.
			
			// Check for a first name:
			if (empty($_POST['shopperfname'])) {
				$errors[] = 'You forgot to enter your first name.';
			} else {
				$fn = mysqli_real_escape_string($dbc, trim($_POST['shopperfname']));
			}
				
			// Check for a last name:
			if (empty($_POST['shopperlname'])) {
				$errors[] = 'You forgot to enter your last name.';
			} else {
				$ln = mysqli_real_escape_string($dbc, trim($_POST['shopperlname']));
			}	
			
			// Check for shopperaddr:
			if (empty($_POST['shopperaddr'])) {
				$errors[] = 'You forgot to enter your shipping address.';
			} else {
				$sa = mysqli_real_escape_string($dbc, trim($_POST['shopperaddr']));
			}
			
			// Check for shoppercity:
			if (empty($_POST['shoppercity'])) {
				$errors[] = 'You forgot to enter the city.';
			} else {
				$sc = mysqli_real_escape_string($dbc, trim($_POST['shoppercity']));
			}
			
			// Check for shoppercountry:
			if (empty($_POST['shoppercountry'])) {
				$errors[] = 'You forgot to enter your country.';
			} else {
				$sco = mysqli_real_escape_string($dbc, trim($_POST['shoppercountry']));
			}
			
			// Check for shopperphone:
			if (empty($_POST['shopperphone'])) {
				$errors[] = 'You forgot to enter your phone number.';
			} else {
				$sp = mysqli_real_escape_string($dbc, trim($_POST['shopperphone']));
			}
			
			
			// Assign the non-required values to variables	
			$ss = mysqli_real_escape_string($dbc, trim($_POST['shopperstate']));	
			$sz = mysqli_real_escape_string($dbc, trim($_POST['shopperzip']));		
			
			if (empty($errors)) { // If everything's OK.
			
				// Update the shopper's address in the database
				
				// Make the query:
				$q = "UPDATE shoppers SET  
				shopperfname = '$fn',
				shopperlname = '$ln',
				shopperaddr = '$sa',
				shoppercity = '$sc',
				shopperstate = '$ss',
				shopperzip = '$sz',
				shoppercountry = '$sco',
				shopperphone = '$sp'
				WHERE shopperid = '$shopperid'";		
				
				$r = @mysqli_query ($dbc, $q); // Run the query.
				if ($r) { // If it ran OK.
				
										//Link back to source page and exit out of page:
										
										echo '<div id="bottomcontainer"> 
				  
										 <div id="bottom" style="height:600px;">
							
											<div id="itemdetailssection" style="height:600px;">
											
												<div id="msgdiv" style="width:90%;margin:40px auto 5px auto;">
							
							
													<div id="msgdiv_inner" style="width:260px;">
											
													<p style="margin:20px 0;">Your shipping address has been updated.</p>';
													
													if((isset($frommyct))&&($fromshp=='')) {
														echo '<div id="msglink_lhs" style="width:100%;"><a class="colorlink-ul" href="myaccount.php">Back to My Account Page</a></div>';
													} else if ($fromshp!='') {
														echo '<div id="msglink_lhs" style="width:100%;"><a class="colorlink-ul" href="shipping.php?fromcart=true">Continue Checking Out</a></div>';
													}
													
														echo '<div id="msglink_rhs"> </div>
								
													</div>
								
												</div>
								
												<div id="msgdivb" style="width:90%;margin:0 auto 100px auto;">
												
												</div>																																																	
									
											</div>
		
										</div>
								
									</div>';  
							
							
							
							
							
							
							
						
						include ('includesnew/footertall.php');
						
						  
							
						echo'</div>

						</body>

						</html>';
						
						exit();
							
							
							
						} else { // If it did not run OK.
								
								// Public message:
								echo '<div style="width:500px;margin:30px auto 0 auto;color:red;"><h5>System Error</h5>
								<p>Your shipping address could not be added due to a system error. We apologize for any inconvenience.</p>'; 
								
								// Debugging message:
								echo '<p>' . mysqli_error($dbc) . '</p> </div>';
											
							} // End of if ($r) IF.
							
						} else { // Report the errors.
						
							echo '<div style="width:500px;margin:30px auto 0 auto;color:red;"><h5>System Error</h5>
								<p>The following error(s) occurred:<br />';
							foreach ($errors as $msg) { // Print each error.
								echo " - $msg<br />\n";
							}
							echo '</p><p>Please try again.</p> </div>';
							
						} // End of if (empty($errors)) IF.


}   // End of the Submit conditional.
		
?>

<div id="bottomcontainer"> 
  
    <div id="bottom" style="height:1000px;">
			
		<div id="itemdetailssection" style="height:1000px;">

		
			<div style="width:420px;margin-left:auto;margin-right:auto;"><h1 class="chkhdr">EDIT SHIPPING ADDRESS</h1></div>   
			
			<div style="width:100%;">
			
				
				
				<div id="wrap" style="width:420px;margin-left:auto;margin-right:auto;margin-top:0;padding-top:0;"> 
				
					<form class="column" name="form1" action="shipedit.php" method="post">			
			
						<div><h1 style="padding-bottom:20px;">Please update your shipping address</h1></div>		
							
						<div class="shipform"> <!-- Adding this div class so that we can style the dimensions here different from the other forms -->	
							
							<div class="input">
								First Name:<br> <input id="i1" name="shopperfname" type="text" value="<?php echo $shopperfname; ?>" class="required" size="50" />
							</div>
							<div class="input">
								Last Name:<br> <input id="i2" name="shopperlname" type="text" value="<?php echo $shopperlname; ?>" class="required" size="50" />
							</div>
							<div class="input">
								Street Address:<br> <input id="i3" name="shopperaddr" type="text" value="<?php echo $shopperaddr; ?>" class="required" size="50" />
							</div>
							
							<div class="input">
								<div class="csz">
									City:<br> <input id="i4" name="shoppercity" type="text" value="<?php echo $shoppercity; ?>" class="required" size="10" />
								</div>
								<div class="csz">
									Zip/Postal Code:<br> <input id="i6" name="shopperzip" type="text" value="<?php echo $shopperzip; ?>" size="10" />
								</div>
							</div>
							
							<div class="input">
								<div class="csz">
									Country:<br> <input id="i4" name="shoppercountry" type="text" value="<?php echo $shoppercountry; ?>" class="required" size="10" />
								</div>
								<div class="csz">
									State:<br> <input id="i6" name="shopperstate" type="text" value="<?php echo $shopperstate; ?>" size="10" />
								</div>
							</div>
							
							<div class="input">
								Phone Number:<br> <input id="i5" name="shopperphone" type="text" value="<?php echo $shopperphone; ?>" class="required" size="50" />
							</div>
							
							<div class="shpsubmit"> 
							
								<input type="hidden" name="fromcart" value="true"> <!-- tracks shopper that just came from the checkout page and had to sign in -->
								<input type="hidden" name="useaddr" value="existing">								
								<input type="hidden" name="frommyct" value="<?php if (isset($frommyct)) { echo $frommyct; } ?>">								
								<input type="hidden" name="fromshp" value="<?php if (isset($fromshp)) { echo $fromshp; } ?>">
								
								<input style="margin-top:15px;" type="image" border=0 src="imagesnew/buttonsubmit_black.png" height=27 width=85 />
							</div>
							
						</div>
					
					</form>
			
				</div>
				
				
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