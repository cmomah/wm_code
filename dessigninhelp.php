<?php
session_start();

$title='Designer Sign In Help';


// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

function check_login($dbc, $designeremail = '') {

				$errors = array(); // Initialize error array.

				// Validate the email address:
				if (empty($designeremail)) {
					$errors[] = 'You forgot to enter your email address.';
				} else {
					$e = mysqli_real_escape_string($dbc, trim($designeremail));
				}

				
				if (empty($errors)) { // If everything's OK.

					// Retrieve the test question and answer for that email address:
					$q = "SELECT designeremail, testquestion, testquestionanswer, designerpass FROM designers WHERE designeremail='$e'";		
					$r = @mysqli_query ($dbc, $q); // Run the query.
					
					// Check the result:
					if (mysqli_num_rows($r) == 1) {

						// Fetch the record:
						$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
						
						// Populate data and store in session:
							session_start();
							$_SESSION['testquestion'] = $row['testquestion'];
							$_SESSION['testquestionanswer'] = $row['testquestionanswer'];
							$_SESSION['designerpass'] = $row['designerpass'];
							$_SESSION['designeremail'] = $row['designeremail'];
							
						
				
						// Return true and the record:
						return array(true, $row);
						
					} else { // Not a match!
						$errors[] = 'The email address entered does not match that on file.';
					}
					
				} // End of empty($errors) IF.
				
				// Return false and the errors:
				return array(false, $errors);

			} // End of check_login() function.



	require ('includesnew/mysqli_connect.php');
		
	// Check the login:
	list ($check, $data) = check_login($dbc, $_POST['designeremail']);
	
	if ($check) { // OK!
		
		// Set the session data:
		session_start();
		$_SESSION['designeremail'] = $data['designeremail'];
		
		// Redirect:
		header("Location: http://www.waxmode.com/responsive2/dessigninhelp2.php");
			
	} else { // Unsuccessful!

		// Assign $data to $errors for dessigninhelp.php:
		$errors = $data;

	}
		
	mysqli_close($dbc); // Close the database connection.

} // End of the main submit conditional.

// Create the page:
/////////////////////////////////////////

// dessigninhelp.php starts


		// This page prints any errors associated with logging in and it creates the entire login page including the form

		// Include the header:
		
		include ('includesnew/topcontainer_shoppingforsignin.php');
		
		
		

		// Print any error messages if they exist:
		if (isset($errors) && !empty($errors))  {
			echo '<div style="width:35%; min-width:300px;margin:30px auto 0 auto;color:red;"><h5>Error!</h5>
			<p>The following error(s) occurred:<br />';
			foreach ($errors as $msg) {
				echo " - $msg<br />\n";
			}
			echo '</p><p>Please try again.</p></div>';
		}	

		// Display the form:);

?>



  <div id="bottomcontainer"> 
  
    <div id="bottom">
			
		<div id="itemdetailssection">
			
		



			<div style="width:35%; min-width:300px; margin-left:auto;margin-right:auto;">
				<!-- main content starts -->
				
				
				
				<table border=0 cellspacing=0 cellpadding=0 width="100%">
					
					<tr>
						<!--
						<td width=363 class="topleft-aligned">
						<img border=0 src="images/temp.jpg" width=362> 
						</td>
						<td width=32 rowspan="4">
						&nbsp;
						</td>
						-->
						<td class="topleft-aligned">
						
						<h1 style="padding:10px 0 30px 0;">Designer Password Recovery</h1>
						
						Enter below, the email address you registered with us as a designer  <br><br>
							
							<table border="0" cellspacing="0" cellpadding="0" width="100%">
								<tbody>
								<tr>
									<td colspan="2">
									<form action="dessigninhelp.php" method="post">
									</td>
								</tr>
								<tr height="40">
									<td width="110">Email <span id="redtext">*</span></td>
									<td><input id="element3" maxlength="60" name="designeremail" size="25S" type="text" value="<?php if (isset($_POST['designeremail'])) echo $_POST['designeremail']; ?>" /></td>
								</tr>
								<tr>
									<td></td>
									<td>
									<br><input type="image" border=0 src="imagesnew/buttonsubmit.png" height=27 width=85 />
									</td>
								</tr>
								<tr>
									<td colspan="2"></form></td>
								</tr>
								</tbody>
							</table>
						
						
						
						
						</td>
					</tr>
				</table>
				
				
				
				<!-- main content ends -->
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
