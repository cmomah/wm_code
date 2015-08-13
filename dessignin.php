<?php
session_start();

$title='Designer Sign In';
	
// This page processes the signin form submission.
// The script uses sessions.

// Check if the form has been submitted:


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			/* This function validates the form data (the email address and password).
			 * If both are present, the database is queried.
			 * The function requires a database connection.
			 * The function returns an array of information, including:
			 * - a TRUE/FALSE variable indicating success
			 * - an array of either errors or the database result
			 */
			function check_login($dbc, $designeremail = '', $designerpass = '') {

				$errors = array(); // Initialize error array.

				// Validate the email address:
				if (empty($designeremail)) {
					$errors[] = 'You forgot to enter your email address.';
				} else {
					$e = mysqli_real_escape_string($dbc, trim($designeremail));
				}

				// Validate the password:
				if (empty($designerpass)) {
					$errors[] = 'You forgot to enter your password.';
				} else {
					$p = mysqli_real_escape_string($dbc, trim($designerpass));
				}

				if (empty($errors)) { // If everything's OK.

					// Retrieve the designerid and name for that email/password combination:
					$q = "SELECT designerid, tradeName, desfirstname, deslastname, designeremail FROM designers WHERE designeremail='$e' AND designerpass='$p'";		
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
					
				} // End of empty($errors) IF.
				
				// Return false and the errors:
				return array(false, $errors);

			} // End of check_login() function.
	
	///////////////////////////////////

	require ('includesnew/mysqli_connect.php');
		
	// Check the login:
	list ($check, $data) = check_login($dbc, $_POST['designeremail'], $_POST['designerpass']);
	
	if ($check) { // OK!
		
		// Set the session data:
		session_start();
		$_SESSION['designerid'] = $data['designerid'];
		$_SESSION['tradeName'] = $data['tradeName'];
		$_SESSION['desfirstname'] = $data['desfirstname'];
		$_SESSION['deslastname'] = $data['deslastname'];
		$_SESSION['designeremail'] = $data['designeremail'];
		
		// Redirect:
		
		header("Location: http://www.waxmode.com/responsive2/index.php");
			
	} else { // Unsuccessful!

		// Assign $data to $errors for login_page.inc.php:
		$errors = $data;

	}
		
	mysqli_close($dbc); // Close the database connection.

} // End of the main submit conditional.

// Create the page:
/////////////////////////////////////////

// dessignin.php starts


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

		// Display the form:
?>


  <div id="bottomcontainer"> 
  
    <div id="bottom">
			
		<div id="itemdetailssection">

			<div style="width:74.5%;height:40px;border-style:solid;border-width:thin 0px thin 0px;border-color:#CDCBCB; margin-left:12.95%;">
				<h1 style="padding:10px 0 10px 0;">Designer Sign In</h1>
			</div>
			
			<div style="margin-left:12.95%; width:74.5%">
			
				<table cellspacing=0 cellpadding=0 width="100%" style="border-style:solid;border-width:0px 0px thin 0px;border-color:#CDCBCB;height:100%;">
				
				<tr>
					<!--
					<td width=363 class="topleft-aligned">
					<img border=0 src="images/temp.jpg" width=362> 
					</td>
					<td width=32 rowspan="4">
					&nbsp;
					</td>
					-->
					
					<td width="100%">
					
						<div id="desform-lhs">
						
						<h3 style="font-weight:normal;padding:30px 0 30px 0;">Do you have a Waxmode designer profile?</h3>
							
							If you have already created a waxmode.com designer profile, please sign in here <br><br>
							
							<table width="100%" border="1" cellspacing="0" cellpadding="0">
							<tbody>
							<tr>
								<td colspan="2">
								<form action="dessignin.php" method="post">
								</td>
							</tr>
							<tr height="40">
								<td width="21.1%">Email</td>
								<td><input id="element1" maxlength="50" name="designeremail" size="30" type="text" value="" /></td>
							</tr>
							<tr height="40">
								<td width="21.1%">Password</td>
								<td><input id="element2" maxlength="50" name="designerpass" size="30" type="password" value="" /></td>
							</tr>
							<tr>
								<td></td>
								<td>
								<span id="smallgray">Note: password is case-sensitive </span>
								<br><br>
								
								<a class="colorlink" href="dessigninhelp.php">Forgot your password?</a>
								
								<br><br><input type="image" border=0 src="imagesnew/signinnew.png" height=27 width=85 />
								</td>
							</tr>
							<tr height="20">
								<td colspan="2"></td>
							</tr>
							<tr>
								<td colspan="2"></form></td>
							</tr>
							</tbody>
							</table>
						
						
						
						
						</div>
						<div id="desform-btw"><img border=0 src="images/vertline_270px.png" height=375 width=8></div>
						<div id="desform-rhs">
						
						<h3 style="font-weight:normal;padding:30px 0 30px 0;">If you don't have a Waxmode designer profile...</h3>
						
						Create a profile now so you can begin the process of selling your fashion products and accessories through our site.
					It takes only a minute or two!  
						
						<br><br><a class="colorlink" href="#">Our privacy policy</a>
						
						<br><br><a href="desreg.php"><img src="imagesnew/createnew.png" height=27 width=85></a>
						
						<!-- <br><br><img src = "images/horizline_444px.png" border=0 height="10px" width="444px"> -->
						
						</div>
						
					</td>	
						
				</tr>
			</table>		
				
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
