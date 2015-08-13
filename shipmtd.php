<?php
// SHIPPING AND BILLING ADDRESS DATA ARE ENTERED HERE FOR THE FIRST TIME. FOR BILLING ADDRESS,
// ONLY THE SHOPPERID, EMAIL ADDRESS, AND FIRST & LAST NAMES ARE ENTERED FOR NOW

$title='Shipping Method';
include ('includesnew/topcontainer_shopping.php');

error_reporting(E_ERROR);
//ini_set('display_errors', 'On');

// Retrieve the $fromcart value 
	if(isset($_POST['fromcart'])) {
		$fromcart = $_POST["fromcart"];
	}	
	

// Retrieve checkbox value for the question "Use as my billing address".
	if(isset($_POST['sameasshipping'])) {
		$sameasshipping = $_POST["sameasshipping"];
	}
	
// Retrieve $useaddr also - that tells whether user is shipping to existing or new address. Store in session
	if(isset($_POST['useaddr'])) {
		$_SESSION['useaddr'] = $_POST["useaddr"];
	}		

// Retrieve $useaddr if available in session 	
	if(isset($_SESSION['useaddr'])) {
		$useaddr = $_SESSION['useaddr'];
	}	

// Retrieve shopper's id and first name if signed in 	
	if(isset($_SESSION['shopperid'])) {
		$shopperid = $_SESSION['shopperid'];
	}	

// echo 'useaddr =' . $useaddr . '<br>';
// echo 'shopperid =' . $shopperid . '<br>';	
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		// User already has a shipping address	and opts to use it	
		if ($useaddr == 'existing') {   


			// Retrieve the shipping address that gets displayed to shopper on the Payment page:
					
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
							
							
							// echo 'shopperaddr =' . $shopperaddr . '<br>';



						 
							
							


		}
			
			

			


		// User is adding a new shipping address

		// Check for form submission (backup validation to the client-side JavaScript validation):
		if ($useaddr == 'new') {   
				
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
			if ($_POST['shoppercountry'] == '-1') {
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
			
				// Update the shopper's address in the database (you're updating the shoppers table that 
				// already has some sign-in data but may not yet have shipping address data)
				
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
				
				
					// Set useaddr session aobject to "existing" so that on page refresh, the page will know user now has shipping address data to use
					$_SESSION['useaddr'] = 'existing';
				
				
					// Retrieve the shipping address that gets displayed to shopper on the Payment page:
					
						if($shopperid != '') {
						$q = "select shopperemail, shopperfname, shopperlname, shopperaddr, shoppercity, shopperstate, shopperzip, shoppercountry, shopperphone from shoppers
						WHERE shopperid='$shopperid'";
						}
						
						// echo '<br>' . $q . '<br>';
						
						$r = @mysqli_query ($dbc, $q); // Run the query.

						if ($r) { // If it ran OK, display the records.	
						
						//get results for display
						while ($row = mysqli_fetch_array($r)) {
							$shopperemail = $row["shopperemail"];
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
							
							
									// Create a billing address profile with no values in them (this way, we can run 
									// an update query when user needs to enter billing address)
									$q = "SELECT * from shopperbilladdr WHERE shopperid = '$shopperid'";
									
									$r = @mysqli_query ($dbc, $q); // Run the query.
									
									if (mysqli_num_rows($r) == 0) { 
									
											// Proceed with the insert if no record for the Shopper exists
											
											$q = "INSERT INTO shopperbilladdr (
											shopperid, billingemail, billingfname, billinglname, 
											billingaddr, billingaddr2, billingcity, billingstate, 
											billingzip, billingcountry, billingphone) 
											VALUES
											('" . $shopperid . "', '" . $shopperemail . "', '" . $shopperfname . "', '" . $shopperlname . "', 
											'', '', '', '', 
											'', '', '')";
													
											$r = @mysqli_query ($dbc, $q); // Run the query.
											if ($r) {									
											mysqli_free_result ($r); // Free up the resources.									
											}
									}		
												
							} else { // If it did not run OK.

							// Public message:
							echo '<p class="redtext">Your address could not be retrieved. We apologize for any inconvenience.</p>';
							
										
							} // End of if ($r) IF.



							
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
							
							// Display shipping form again and exit code
							include ('includesnew/shipincl.php');
							
							exit();
							
						} // End of if (empty($errors)) IF.

					} 

}   // End of the main Submit conditional.
			
			
			
			
			
			
			
?>

<div id="bottomcontainer"> 
  
    <div id="bottom">
			
		<div id="itemdetailssection">

		
			<div><h1 class="chkhdr">WAXMODE CHECK OUT</h1></div>   <!-- Div previously chkhdrdiv -->
			
			<div id="chkbrcrumbs">
				<div class="chkbrcrumbs_step"><h4 class="chksteplabel">Shipping Address</h4></div>
				<div class="chkbrcrumbs_step" id="currentstep"><h4 class="currentsteplabel">Shipping Method</h4></div>
				<div class="chkbrcrumbs_step"><h4 class="chksteplabel">Billing Address</h4></div>
				<div class="chkbrcrumbs_lstep"><h4 class="chksteplabel">Payment / Submit</h4></div>
			</div>
			
			<div id="chktsh_lhs">				
				
				<?php				
				if (!empty($shopperaddr)) {
				
				echo '<div style="width:90%; padding:0 0 20px 0; border-style:solid; border-color:#E7E7E7; border-width:0 0 1px 0;">';
				
					echo '<div><h1 style="padding:0 0 20px 0;">1. Shipping Address</h1></div>
					<div>';
					?>
						<?php echo $shopperfname . ' ' . $shopperlname; ?>
						<?php echo '<br>' . $shopperaddr; ?>
						<?php echo '<br>' . $shoppercity; 					
						if($shopperstate != '') {
						  echo ', ' . $shopperstate; 
						}
						if($shopperzip != '') {
						  echo ', ' . $shopperzip; 
						}
						?>
						<?php echo '<br>' . $shoppercountry; 
						
					echo '</div>';	
					
					if (!empty($sameasshipping)) {
						echo '<div>(Billing Address is: ' . $sameasshipping . ')</div>';
					} else {
						echo '<div>(Billing Address is not same as shipping. I will enter it later.)</div>';
					}
				
					echo '<div style="margin-top:10px;">
					<a class="colorlink-ul" href="shipedit.php?fromcart=true&fromshp=true">Edit Shipping Address</a>
					</div>
				
				</div>';
				}
				?>
				
				<div><h1 style="padding:20px 0;">2. Shipping Options</h1></div>
				
				<form name="form1" action="shipmtds2.php" method="post">
				
				<input type="radio" name="shpoption" class="shpmtd" value="Standard Shipping - $5" checked>Standard Shipping - $5 
				<br>
				<input type="radio" name="shpoption" class="shpmtd" value="Two Day Shipping - $15">Two Day Shipping — $15
				<br>
				<input type="radio" name="shpoption" class="shpmtd" value="Next Day Shipping - $25">Next Day Shipping — $25
				<br>
				
				<input type="hidden" name="fromcart" value="true"> <!-- tracks shopper that just came from the checkout page and had to sign in -->
				<input type="hidden" name="useaddr" value="existing"> <!-- "existing" since user just entered their address and we need to navigate them to next step -->
				<input type="hidden" name="sameasshipping" value="<?php echo $sameasshipping; ?>">
								
				<input style="margin-top:15px;" type="image" border=0 src="imagesnew/saveandcontinue.png" height=27 width=113 />				
				
				</form> 
				
 
				
			</div>

			
			<div id="chktsh_rhs">
				<?php
				
				$carttitle = 'Order Summary';
				$shipfee = '';
				$showeditcartlink = 'true';
				$showreduceandremove = 'false';
				$showcheckoutbutton = 'false';
				
				include ('cartnew.php');
				?>
			</div>
			
			
			<div style="clear:both;">
			
			
			

				
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
