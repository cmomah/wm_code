<?php 
session_start();

$title='Edit Billing Address';
include ('includesnew/topcontainer_shopping.php');

// Coming from my account page
	if(isset($_GET['frommyct'])) {
		$frommyct = $_GET['frommyct'];
	}
	
// Coming from editing of address
	if(isset($_POST['frommyct'])) {
		$frommyct = $_POST['frommyct'];
	}	

// Retrieve shopper's id if signed in 	
	if(isset($_SESSION['shopperid'])) {
		$shopperid = $_SESSION['shopperid'];
	}	
	
	if($shopperid != '') {
	$q = "select billingfname, billinglname, billingaddr, billingcity, billingstate, billingzip, billingcountry, billingphone from shopperbilladdr
	WHERE shopperid='$shopperid'";
	}
	
	// echo '<br>' . $q . '<br>';
	
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
			if (empty($_POST['billingfname'])) {
				$errors[] = 'You forgot to enter your first name.';
			} else {
				$fn = mysqli_real_escape_string($dbc, trim($_POST['billingfname']));
			}
				
			// Check for a last name:
			if (empty($_POST['billinglname'])) {
				$errors[] = 'You forgot to enter your last name.';
			} else {
				$ln = mysqli_real_escape_string($dbc, trim($_POST['billinglname']));
			}	
			
			// Check for billingaddr:
			if (empty($_POST['billingaddr'])) {
				$errors[] = 'You forgot to enter your billing address.';
			} else {
				$sa = mysqli_real_escape_string($dbc, trim($_POST['billingaddr']));
			}
			
			// Check for billingcity:
			if (empty($_POST['billingcity'])) {
				$errors[] = 'You forgot to enter the city.';
			} else {
				$sc = mysqli_real_escape_string($dbc, trim($_POST['billingcity']));
			}
			
			// Check for billingcountry:
			if (empty($_POST['billingcountry'])) {
				$errors[] = 'You forgot to enter your country.';
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
			
				// Update the billing's address in the database
				
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
				if ($r) { // If it ran OK.
				
						//Link back to source page and exit out of page:
						
						echo '<div id="bottomcontainer"> 
  
						 <div id="bottom" style="height:600px;">
			
							<div id="itemdetailssection" style="height:600px;">
							
								<div id="msgdiv" style="width:90%;margin:40px auto 5px auto;">
							
							
													<div id="msgdiv_inner" style="width:260px;">
											
													<p style="margin:20px 0;">Your billing address has been updated.</p>';
													
													if(isset($frommyct)) {
														echo '<div id="msglink_lhs" style="width:100%;"><a class="colorlink-ul" href="myaccount.php">Back to My Account Page</a></div>';
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
								<p>Your billing address could not be added due to a system error. We apologize for any inconvenience.</p>'; 
								
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

		
			<div style="width:420px;margin-left:auto;margin-right:auto;"><h1 class="chkhdr">EDIT BILLING ADDRESS</h1></div>   
			
			<div style="width:100%;">
			
				
				
				<div id="wrap" style="width:420px;margin-left:auto;margin-right:auto;margin-top:0;padding-top:0;"> 
				
					<form class="column" name="form1" action="billeditacct.php" method="post">			
			
						<div><h1 style="padding-bottom:20px;">Please update your billing address</h1></div>		
							
						<div class="shipform"> <!-- Adding this div class so that we can style the dimensions here different from the other forms -->	
							
							<div class="input">
								First Name:<br> <input id="i1" name="billingfname" type="text" value="<?php echo $billingfname; ?>" class="required" size="50" />
							</div>
							<div class="input">
								Last Name:<br> <input id="i2" name="billinglname" type="text" value="<?php echo $billinglname; ?>" class="required" size="50" />
							</div>
							<div class="input">
								Street Address:<br> <input id="i3" name="billingaddr" type="text" value="<?php echo $billingaddr; ?>" class="required" size="50" />
							</div>
							
							<div class="input">
								<div class="csz">
									City:<br> <input id="i4" name="billingcity" type="text" value="<?php echo $billingcity; ?>" class="required" size="10" />
								</div>
								<div class="csz">
									Zip/Postal Code:<br> <input id="i6" name="billingzip" type="text" value="<?php echo $billingzip; ?>" size="10" />
								</div>
							</div>
							
							<div class="input">
								<div class="csz">
									Country:<br> <input id="i4" name="billingcountry" type="text" value="<?php echo $billingcountry; ?>" class="required" size="10" />
								</div>
								<div class="csz">
									State:<br> <input id="i6" name="billingstate" type="text" value="<?php echo $billingstate; ?>" size="10" />
								</div>
							</div>
							
							<div class="input">
								Phone Number:<br> <input id="i5" name="billingphone" type="text" value="<?php echo $billingphone; ?>" class="required" size="50" />
							</div>
							
							<div class="shpsubmit"> 
															
								<input type="hidden" name="frommyct" value="<?php if (isset($frommyct)) { echo $frommyct; } ?>">
								
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