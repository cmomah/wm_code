<?php
$title='Review & Submit';
include ('includesnew/topcontainer_shopping.php');

error_reporting(E_ERROR);
//ini_set('display_errors', 'On');


// Retrieve the $fromcart value 	
	if(isset($_POST['fromcart'])) {
		$fromcart = $_POST["fromcart"];
	}
	
// Retrieve shipping option selected. 
	if(isset($_POST['shpoption'])) {
		$shpoption = $_POST['shpoption'];
	}

// Retrieve shipping fee. 
	if(isset($_POST['shipfee'])) {
		$shipfee = $_POST['shipfee'];
	}		

// Retrieve checkbox value for the question "Use as my billing address"
	if(isset($_POST['sameasshipping'])) {
		$sameasshipping = $_POST["sameasshipping"];
	}
	
// Retrieve shopper's id if signed in 	
	if(isset($_SESSION['shopperid'])) {
		$shopperid = $_SESSION['shopperid'];
	}	

// Retrieve indicator on whether or not billing address was edited in Submit.php 
	if(isset($_POST['editbilladdr_clicked'])) {
		$editbilladdr_clicked = $_POST["editbilladdr_clicked"];
	}	
	
// Retrieve the shipping address that gets displayed to shopper:
			
				if($shopperid != '') {
				$q = "select shopperfname, shopperlname, shopperaddr, shoppercity, shopperstate, shopperzip, shoppercountry from shoppers
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
					}
						
					mysqli_free_result ($r); // Free up the resources.	
								
					} else { // If it did not run OK.

					// Public message:
					echo '<p class="redtext">Your address could not be retrieved. We apologize for any inconvenience.</p>';
								
					} // End of if ($r) IF.


if (($_SERVER['REQUEST_METHOD'] == 'POST')&&(empty($editbilladdr_clicked))) { // if editbilladdr_clicked is empty, we are not coming from billedit.php which included this file

		// Code to update user's billing address

		// Check for form submission 
				
			$errors = array(); // Initialize an error array.
			
			
			// Check for a first name:
			if (empty($_POST['billingfname'])) {
				$errors[] = 'You forgot to enter the billing first name.';
			} else {
				$fn = mysqli_real_escape_string($dbc, trim($_POST['billingfname']));
			}
				
			// Check for a last name:
			if (empty($_POST['billinglname'])) {
				$errors[] = 'You forgot to enter the billing last name.';
			} else {
				$ln = mysqli_real_escape_string($dbc, trim($_POST['billinglname']));
			}	
			
			// Check for billingaddr:
			if (empty($_POST['billingaddr'])) {
				$errors[] = 'You forgot to enter the billing address.';
			} else {
				$sa = mysqli_real_escape_string($dbc, trim($_POST['billingaddr']));
			}
			
			// Check for billingcity:
			if (empty($_POST['billingcity'])) {
				$errors[] = 'You forgot to enter the city.';
			} else {
				$sc = mysqli_real_escape_string($dbc, trim($_POST['billingcity']));
			}
			
			//echo '<br>Country = ' . $_POST['billingcountry'] . '<br>';
			
			// Check for billingcountry:
			if ($_POST['billingcountry'] == '-1') {
				$errors[] = 'You forgot to enter the billing country.';
			} else {
				$sco = mysqli_real_escape_string($dbc, trim($_POST['billingcountry']));
			}
			
			// Check for billingphone:
			if (empty($_POST['billingphone'])) {
				$errors[] = 'You forgot to enter your phone number.';
			} else {
				$sp = mysqli_real_escape_string($dbc, trim($_POST['billingphone']));
			}
			
			
			// Assign the non-required values to variables	
			$ss = mysqli_real_escape_string($dbc, trim($_POST['billingstate']));	
			$sz = mysqli_real_escape_string($dbc, trim($_POST['billingzip']));		
			
			if (empty($errors)) { // If everything's OK.
			
			
			
			// Check if shopper's billing address exists
			$q = "SELECT * from shopperbilladdr WHERE shopperid = '$shopperid'";
									
			$r = @mysqli_query ($dbc, $q); // Run the query.
									
			if (mysqli_num_rows($r) == 0) { 
									
				// Proceed with the insert as no billing address record for the Shopper exists
											
				$q = "INSERT INTO shopperbilladdr (
				shopperid, billingfname, billinglname, 
				billingaddr, billingcity, billingstate, 
				billingzip, billingcountry, billingphone) 
				VALUES
				('" . $shopperid . "', '" . $fn . "', '" . $ln . "', 
				'" . $sa . "', '" . $sc . "', '" . $ss . "', 
				'" . $sz . "', '" . $sco . "', '" . $sp . "')";
				
												
				$r = @mysqli_query ($dbc, $q); // Run the query.
				if ($r) {									
				mysqli_free_result ($r); // Free up the resources.									
				}
				
				
			} else {			
			
			
				// Record exists, so update the shopper's billing address in the database (an earlier empty shell 
				// was created for some users in the shipmtd.php page 
				// for those that entered shipping address for the first time at the beginning of checkout)
				
				// Make the query:
				$q = "UPDATE shopperbilladdr SET  
				billingfname = '$fn',
				billinglname = '$ln',
				billingaddr = '$sa',
				billingcity = '$sc',
				billingstate = '$ss',
				billingzip = '$sz',
				billingcountry = '$sco',
				billingphone = '$sp'
				WHERE shopperid = '$shopperid'";		
				
				$r = @mysqli_query ($dbc, $q); // Run the query.
				if ($r) { 
				
				// It ran OK.
							
							} else { // If it did not run OK.
								
								// Public message:
								echo '<div style="width:500px;margin:30px auto 0 auto;color:red;"><h5>System Error</h5>
								<p>Your billing address could not be added due to a system error. We apologize for any inconvenience.</p>'; 
								
								// Debugging message:
								echo '<p>' . mysqli_error($dbc) . '</p> </div>';
											
							} // End of if ($r) IF.
							
							
				}	// End of "Check if shopper's billing address exists"
							
							
		} else { // Report the errors.
						
							echo '<div style="width:500px;margin:30px auto 0 auto;color:red;"><h5>System Error</h5>
								<p>The following error(s) occurred:<br />';
							foreach ($errors as $msg) { // Print each error.
								echo " - $msg<br />\n";
							}
							echo '</p><p>Please try again.</p> </div>';
							
							
							
							// Display payment page forms again and exit code
							include ('includesnew/paymtincl.php');
							
							exit();
							
							
							
							
		} // End of if (empty($errors)) IF.

}   // End of the main Submit conditional.



						// Retrieve the billing address that gets displayed to shopper:
					
						if($shopperid != '') {
						$q = "select billingfname, billinglname, billingaddr, billingcity, billingstate, billingzip, billingcountry, billingphone from shopperbilladdr
						WHERE shopperid='$shopperid'";
						}
						
						//echo '<br>' . $q . '<br>';
						
						$r = @mysqli_query ($dbc, $q); // Run the query.

						if ($r) { // If it ran OK, display the records.	
						
						//get results for display
						while ($row = mysqli_fetch_array($r)) {
							$billingfname = $row["billingfname"];
							$billinglname = $row["billinglname"];
							$billingaddr = $row["billingaddr"];
							$billingcity = $row["billingcity"];
							$billingstate = $row["billingstate"];
							$billingzip = $row["billingzip"];
							$billingcountry = $row["billingcountry"];
							$billingphone = $row["billingphone"];			
							}
							
							//echo '<br>$billingaddr #1' . $billingaddr . '<br>';
							
							mysqli_free_result ($r); // Free up the resources.	
										
							} else { // If it did not run OK.

							// Public message:
							echo '<p class="redtext">Your billing address could not be retrieved. We apologize for any inconvenience.</p>';
										
							} // End of if ($r) IF.

					
?>

<div id="bottomcontainer"> 
  
    <div id="bottom">
			
		<div id="fix_expand">

		
			<div><h1 class="chkhdr">WAXMODE CHECK OUT</h1></div>   <!-- Div previously chkhdrdiv -->
			
			<div id="chkbrcrumbs">
				<div class="chkbrcrumbs_step"><h4 class="chksteplabel">Shipping Address</h4></div>
				<div class="chkbrcrumbs_step"><h4 class="chksteplabel">Shipping Method</h4></div>
				<div class="chkbrcrumbs_step"><h4 class="chksteplabel">Billing Address</h4></div>
				<div class="chkbrcrumbs_lstep" id="currentstep"><h4 class="currentsteplabel">Payment / Submit</h4></div>
			</div>
			
			<div style="margin-top:50px;"><h3>Please review your transaction details and click the "Pay with Card" button</h3></div>
			
			
			
			<!-- LEFT -->
			<div id="chktrv_lhs">
			
				<div>
			
					<div style="width:100%; height:30px; background-color:#EAE9E8; text-align:center;margin:30px 0;">Shipping Address/Options
					</div>
					<div>
					
					<?php				
					if (!empty($shopperaddr)) {
					
					echo '<div style="width:90%; padding:0 0 20px 0;">';
					
						echo '<div><h3 style="padding-bottom:10px;">Your are shipping to</h3></div>
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
					
						echo '<div style="margin-top:10px;">
						<a class="colorlink-ul" href="shipedit.php?fromcart=true&fromshp=true">Edit Shipping Address</a>
						</div>
					
					</div>';
					}
					?>
					
					<div><h3 style="padding-bottom:0;padding-top:30px;">Your shipping option</h3></div>
					
					<div><?php echo $shpoption; ?> </div>
					
					</div>
			
				</div>
				
				<div>
			
					<div style="width:100%; height:30px; background-color:#EAE9E8; text-align:center;margin:30px 0;">Order Details
					</div>
					<div>
					<?php				
				
					$carttitle = 'Order Summary';
					$shipfee = $shipfee; 
					$showeditcartlink = 'true';
					$showreduceandremove = 'false';
					$showcheckoutbutton = 'false';
				
					include ('cartnew.php');
					?>
					</div>
			
				</div>
			
			</div>
			
			<!-- RIGHT -->
			<div id="chktrv_rhs">
			
				<div>
			
					<div style="width:100%; height:30px; background-color:#EAE9E8; text-align:center;margin:30px 0;">Payment Information
					</div>
					<div>
					
							<?php
						
						
						if (!empty($billingaddr)) {
						
						echo '<div style="width:90%; padding:0 0 20px 0;">';
						
						// Chuka: just closed the below div
							echo '<div><h3 style="padding-bottom:10px;">Your billing address</h3></div> 
							<div>';
							?>
								<?php echo $billingfname . ' ' . $billinglname; ?>
								<?php echo '<br>' . $billingaddr; ?>
								<?php echo '<br>' . $billingcity; 					
								if($billingstate != '') {
								  echo ', ' . $billingstate; 
								}
								if($billingzip != '') {
								  echo ', ' . $billingzip; 
								}
								?>
								<?php echo '<br>' . $billingcountry; 
								
							echo '</div>	
						
							<div style="margin-top:10px;">'; ?>
							
							<form action="billedit.php" method="post"> 
							
								<input type="hidden" name="sameasshipping" value="<?php echo $sameasshipping; ?>">
								<input type="hidden" name="shpoption" value="<?php echo $shpoption; ?>">
								<input type="hidden" name="shipfee" value="<?php echo $shipfee; ?>">
								<input type="hidden" name="editbilladdr_clicked" value="true">
								
								<input type="image" src="imagesnew/editbilladdr_linkbutton.png" border="0" width="146" height="25"> 							
							</form>
							
							<?php 
							echo '</div>
						
						</div>';
						}
						?>
					
					</div>
					
					<div style="width:90%; height:100%; min-height:100px; background-color:#F9F9F9; padding:20px; 0 0 10px; margin-top:30px; border-style:solid; border-color:#EEEEEE; border-width:1px 0 0 0;">
					
					
					
					<?php
					
					// Convert from dollars to cents as the card payment button only works with cents
					function getCents($dollars)
					{
					return $dollars * 100;
					}

					$Price = $totalCost;

					$PriceInCents = getCents($Price);
					
					?>
					
					<p style="margin-bottom:10px;">Click the following button to be taken to the credit card payment form to pay for the purchase   </p>										
					
					<form action="charge.php" method="POST">
					  <script
						src="https://checkout.stripe.com/checkout.js" class="stripe-button"
						data-key="pk_test_XHgvAQfDg3YvCynJyDp0vrXk"
						data-image="http://www.waxmode.com/responsive2/imagesnew/logogoldblack_stripe.jpg"
						data-name="WAXMODE"
						data-description="Fashion Marketplace"
						data-amount="<?php echo $PriceInCents; ?>">
					  </script>
					  <input type="hidden" name="PriceInCents" value="<?php echo $PriceInCents; ?>">
					  <input type="hidden" name="sameasshipping" value="<?php echo $sameasshipping; ?>">
					  <input type="hidden" name="shpoption" value="<?php echo $shpoption; ?>">
					  <input type="hidden" name="shipfee" value="<?php echo $shipfee; ?>">
					  <input type="hidden" name="totalCost" value="<?php echo $totalCost; ?>"> <!-- from the included cartnew.php -->
					  <input type="hidden" name="cookieId" value="<?php echo GetCartId(); ?>"> <!-- from the included cartnew.php -->

					</form>
					
					</div>
			
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
