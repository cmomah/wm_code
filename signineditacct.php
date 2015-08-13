<?php 
session_start();

$title='Edit Sign In';
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
	$q = "select shopperemail from shoppers
	WHERE shopperid='$shopperid'";
	}
	
	// echo '<br>' . $q . '<br>';
	
	$r = @mysqli_query ($dbc, $q); // Run the query.

	if ($r) { // If it ran OK, display the records.	
	
	//get results for display
	while ($row = mysqli_fetch_array($r)) {
		$shopperemail = $row["shopperemail"];			
		}
			
		mysqli_free_result ($r); // Free up the resources.	
					
		} else { // If it did not run OK.

		// Public message:
		echo '<p class="redtext">Your email address could not be retrieved. We apologize for any inconvenience.</p>';
					
		} // End of if ($r) IF.
		
		
//Update..
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		// Check for form submission		 
				
			$errors = array(); // Initialize an error array.
			
			// Check for email:
			if (empty($_POST['shopperemail'])) {
				$errors[] = 'You forgot to enter your email address.';
			} else {
				$e = mysqli_real_escape_string($dbc, trim($_POST['shopperemail']));
			}
			
			
			// Prevent duplicate emails in the system	
			$q = "SELECT shopperemail FROM shoppers WHERE shopperemail='$e'";		
			$r = @mysqli_query ($dbc, $q); // Run the query.
								
			// Check the result:
			if (mysqli_num_rows($r) == 1) {
				$errors[] = 'The email address you entered already exists as it has been used to register here before.';
			}
					
			
			if (empty($errors)) { // If everything's OK.
			
				// Update the billing's address in the database
				
				// Make the query:
				$q = "UPDATE shoppers SET  
				shopperemail = '$e'
				WHERE shopperid = '$shopperid'";		
				
				$r = @mysqli_query ($dbc, $q); // Run the query.
				if ($r) { // If it ran OK.
				
						//Link back to source page and exit out of page:
						
						echo '<div id="bottomcontainer"> 
  
						 <div id="bottom" style="height:600px;">
			
							<div id="itemdetailssection" style="height:600px;">
							
								<div id="msgdiv" style="width:90%;margin:40px auto 5px auto;">
							
							
													<div id="msgdiv_inner" style="width:260px;">
											
													<p style="margin:20px 0;">Your email address has been updated.</p>';
													
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
								<p>Your email address could not be added due to a system error. We apologize for any inconvenience.</p>'; 
								
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

		
			<div style="width:420px;margin-left:auto;margin-right:auto;"><h1 class="chkhdr">EDIT SIGN-IN INFORMATION</h1></div>   
			
			<div style="width:100%;">
			
				
				
				<div id="wrap" style="width:420px;margin-left:auto;margin-right:auto;margin-top:0;padding-top:0;"> 
				
					<form class="column" name="form1" action="signineditacct.php" method="post">			
			
						<div><h1 style="padding-bottom:20px;">Please update your email address</h1></div>		
							
						<div class="shipform"> <!-- Adding this div class so that we can style the dimensions here different from the other forms -->	
							
							
							<div class="input">
								Email Address:<br> <input id="i5" name="shopperemail" type="text" value="<?php echo $shopperemail; ?>" class="required" size="50" />
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