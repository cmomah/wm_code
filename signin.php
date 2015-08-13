<?php
session_start();

$title='Sign In';
	
// This page processes the signin form submission.
// The script uses sessions.
		
		
// User redirected from my account page	
	if(isset($_GET['frommyct'])) {
		$frommyct = $_GET["frommyct"];
	}	
	
// Check if the form has been submitted:
				
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


			// Coming from the cart page
				if(isset($_POST['fromcart'])) {
					$fromcart = $_POST["fromcart"];
				}

				if(isset($_POST['frommyct'])) {
					$frommyct = $_POST["frommyct"];
				}

			/* This function validates the form data (the email address and password).
			 * If both are present, the database is queried.
			 * The function requires a database connection.
			 * The function returns an array of information, including:
			 * - a TRUE/FALSE variable indicating success
			 * - an array of either errors or the database result
			 */
			function check_login($dbc, $email = '', $password = '') {

				$errors = array(); // Initialize error array.
				
				$e = mysqli_real_escape_string($dbc, trim($email));
				$p = mysqli_real_escape_string($dbc, trim($password)); 
				
				/*
				echo 'email=' . $e . '<br>';
				echo 'pass=' . $p;
				*/
				
					// Retrieve the shopperid and name for that email/password combination:
					$q = "SELECT shopperid, shopperfname, shopperlname, shopperemail FROM shoppers WHERE shopperemail='$e' AND shopperpass='$p'";		
					$r = @mysqli_query ($dbc, $q); // Run the query.
					
					// Check the result:
					if (mysqli_num_rows($r) == 1) {

						// Fetch the record:
						$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
				
						// Return true and the record:
						return array(true, $row);
						
					} else { // Not a match!
						$errors[] = 'The email address and password entered do not match those on file.';
					}
				
				// Return false and the errors:
				return array(false, $errors);

			} // End of check_login() function.
	
	///////////////////////////////////

	require ('includesnew/mysqli_connect.php');
		
	// Check the login:
	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['password']);
	
	if ($check) { // OK!
		
		// Set the session data:
		$_SESSION['shopperid'] = $data['shopperid'];
		$_SESSION['shopperfname'] = $data['shopperfname'];
		$_SESSION['shopperlname'] = $data['shopperlname'];
		$_SESSION['shopperemail'] = $data['shopperemail'];
		
		// Redirect: frommyct
		
		if ((isset($fromcart))&&(($fromcart)!= '')) { // Back to shipping page if user was in process of checking out
			header("Location: http://www.waxmode.com/responsive2/shipping.php?fromcart=true");
		} else if ((isset($frommyct))&&(($frommyct)!= '')) { // Back to my account page
			header("Location: http://www.waxmode.com/responsive2/myaccount.php?si=true");
		} else { // Else, redirect to shopping pages		
			header("Location: http://www.waxmode.com/responsive2/categresults.php?producttarget=women");
		}
			
	} else { // Unsuccessful!

		// Assign $data to $errors for login_page.inc.php:
		$errors = $data;

	}

} // End of the main submit conditional.

// Create the page:
/////////////////////////////////////////

// signin.php starts


		// This page prints any errors associated with logging in and it creates the entire login page including the form

		// Include the header:		
		
		include ('includesnew/topcontainer_shoppingforsignin.php');
		
		
		

		// Print any error messages if they exist:
		if (isset($errors) && !empty($errors))  {
			echo '<div style="width:500px;margin:30px auto 0 auto;color:red;"><h5>Error!</h5>
			<p>The following error(s) occurred:<br />';
			foreach ($errors as $msg) {
				echo " - $msg<br />\n";
			}
			echo '</p><p>Please try again.</p> </div>';
		}	

		
?>



  <div id="bottomcontainer"> 
  
    <div id="bottom">
			
		<div id="itemdetailssection">
			
			<div id="mywrap">  
		
					<form name="form1" action="signin.php" method="post">
					
							<div style="width:230px; margin:20px auto 5px auto;">
								<img src="imagesnew/signincaption.png" height=30 width=230 border=0 />
							</div>
							
							<div style="width:244px; margin:0 auto 20px auto;">
								<a href="dessignin.php"><img src="imagesnew/designersigninprompt.png" height=24 width=244 border=0 /></a>
							</div>
							
							<div style="width:176px; margin:10px auto;">
								<a href="createprofile.php"><img src="imagesnew/signupprompt.png" height=25 width=176 border=0 /></a>
							</div>
							
							<div class="input" style="width:325px;height:28px;margin-bottom:0;">
								<div style="float:left;">Email:</div>   <div style="float:right;"><input id="i1" name="email" type="text" value="" class="required" size="20" /></div>
							</div>
					
							<div class="input" style="width:325px;height:28px;margin-bottom:0;">
								<div style="float:left;">Password:</div>   <div style="float:right;"><input id="i2" name="password" type="password" value="" class="required" size="20" /></div>
							</div>
								
							<div style="width:85px; margin:20px auto 0 auto;">  

								<input type="hidden" name="fromcart" value="<?php if (isset($fromcart)) { echo $fromcart; } ?>">  <!-- tracks shopper that just came from the checkout page and had to sign in -->
								
								<input type="hidden" name="frommyct" value="<?php if (isset($frommyct)) { echo $frommyct; } ?>">  <!-- user redirected from my accounts page -->
								
								<input type="image" border=0 src="imagesnew/signinnew.png" height=27 width=85 border=0 />
							</div>
							
							<div style="width:20px;margin:10px auto;">  OR  </div>
							
							<div style="width:195px; margin:0 auto 20px auto;">
								<a href="#"><img src="imagesnew/loginwithfacebook.png" height=32 width=195 border=0 /> </a>
								
								<?php
								//echo '<br>';
								//include ('includesnew/fbcode.php'); // If Facebook signin selected, connect to FB for authentication.
								?>
								
							</div>
							
							<div style="width:155px; margin:10px auto;">
								<a href="signinhelp.php"><img src="imagesnew/forgotpasswdprompt.png" height=20 width=155 border=0 /></a>
							</div>
							
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
