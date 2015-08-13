<?php 
session_start();

$title='Password Reset';
include ('includesnew/topcontainer_shopping.php');

// Coming from email
	if(isset($_GET['sid'])) {  // sid is the shopperid passed from the email
		$_SESSION['shopperid'] = $_GET['sid'];
	}
	
	$shopperid = $_SESSION['shopperid'];
	
	if($shopperid != '') {
	$q = "select shopperpass from shoppers
	WHERE shopperid='$shopperid'";
	}
	
	// echo '<br>' . $q . '<br>';
	
	$r = @mysqli_query ($dbc, $q); // Run the query.

	if ($r) { // If it ran OK, display the records.	
	
	//get results for display
	while ($row = mysqli_fetch_array($r)) {
		$shopperpass = $row["shopperpass"];			
		}
			
		mysqli_free_result ($r); // Free up the resources.	
					
		} 
		
		
//Update..
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		// Check for form submission		 
				
			$errors = array(); // Initialize an error array.
			
			// Check for email:
			if (empty($_POST['shopperpass'])) {
				$errors[] = 'You forgot to enter your new password.';
			} else {
				$p = mysqli_real_escape_string($dbc, trim($_POST['shopperpass']));
			}
			
			
					
			
			if (empty($errors)) { // If everything's OK.
			
				// Update the billing's address in the database
				
				// Make the query:
				$q = "UPDATE shoppers SET  
				shopperpass = '$p'
				WHERE shopperid = '$shopperid'";		
				
				$r = @mysqli_query ($dbc, $q); // Run the query.
				if ($r) { // If it ran OK.
				
						//Link back to source page and exit out of page:
						
						echo '<div id="bottomcontainer"> 
  
						 <div id="bottom" style="height:600px;">
			
							<div id="itemdetailssection" style="height:600px;">
							
								<div id="msgdiv" style="width:90%;margin:40px auto 5px auto;">
							
							
													<div id="msgdiv_inner" style="width:210px;">
											
														<p style="margin:20px 0;">Your password has been reset.</p>
														
														<div id="msglink_lhs" style="width:100%;"><a class="colorlink-ul" href="myaccount.php">Back to My Account Page</a></div>
														
														<div id="msglink_rhs"> </div>
								
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
								<p>Your password could not be reset due to a system error. We apologize for any inconvenience.</p>'; 
								
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

		
			<div style="width:420px;margin-left:auto;margin-right:auto;"><h1 class="chkhdr">PASSWORD RESET</h1></div>   
			
			<div style="width:100%;">
			
				
				
				<div id="wrap" style="width:420px;margin-left:auto;margin-right:auto;margin-top:0;padding-top:0;"> 
				
					<form class="column" name="form1" action="pswr3.php" method="post">			
			
						<div><h1 style="padding-bottom:20px;">Please reset your password as follows</h1></div>		
							
						<div class="shipform"> <!-- Adding this div class so that we can style the dimensions here different from the other forms -->	
							
							
							<div class="input">
								Enter the New Password:<br> <input id="i5" name="shopperpass" type="password" value="" class="required" size="50" />
							</div>
							
							<div class="shpsubmit"> 
								
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