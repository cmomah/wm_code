<?php
$title='Sign In Help';
//ini_set('display_errors', 'On');

include ('includesnew/topcontainer_shopping.php');


if(isset($_SESSION['testquestion']))
$testquestion = $_SESSION['testquestion'];
else
$testquestion      = "";
 
if(isset($_SESSION['testquestionanswer']))
$testquestionanswer = $_SESSION['testquestionanswer'];
else
$testquestionanswer      = "";

if(isset($_POST['testquestionanswer']))
$tqa = $_POST['testquestionanswer'];
else
$tqa      = "";

if(isset($_SESSION['shopperpass']))
$shopperpass = $_SESSION['shopperpass'];
else
$shopperpass      = "";

if(isset($_SESSION['shopperemail']))
$shopperemail = $_SESSION['shopperemail'];
else
$shopperemail      = "";

/*
echo $testquestion;
echo $testquestionanswer;
echo $shopperpass;
echo $shopperemail;
*/


 


// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

function check_login($dbc, $testquestionanswer = '') {

				$errors = array(); // Initialize error array.

				// Validate the test question answer:
				if (empty($testquestionanswer)) {
					$errors[] = 'You forgot to enter your test question answer.';
				} else {
					$tqa = mysqli_real_escape_string($dbc, trim($testquestionanswer));
				}

			
				
				if (empty($errors)) { // If everything's OK.

				
					
					// Compare the values
					
					$testquestionanswer = strtolower($_SESSION['testquestionanswer']);
					$tqa = strtolower($tqa);
										
					if ($testquestionanswer == $tqa) {  // if testquestionanswer retrieved from database matches that entered by shopper
					
							echo '<div style="width:35%; min-width:300px;margin:30px auto 0 auto;color:red;">
							<b>You have successfully verified your identity. Your password has been sent to the email we have on file for you</b></div>';
							
						if(isset($_SESSION['shopperemail']))
						$shopperemail = $_SESSION['shopperemail'];	
						

						// Connect database

						$conn = mysql_connect("localhost","wwwwaxmo_wmfdb","WMfashiondb2!"); 
						if(!$conn) { 
						die('Failed to connect to server: ' . mysql_error()); 
						}

						mysql_select_db("wwwwaxmo_wmfdb");
						
						$rs=mysql_query("SELECT shopperemail, shopperpass FROM shoppers WHERE shopperemail = '$shopperemail'");

						while ($row = mysql_fetch_array($rs)) {
							$shopperemail = $row['shopperemail'];
							$shopperpass = $row['shopperpass'];
						} 
						
							$to=$shopperemail;
							$subject = "Information from Waxmode.com";
							$headers = "From: noreply@waxmode";
							$body = "Your password to your Waxmode.com account is: ".$shopperpass." \n ";
						
						// send email 
						
						$send = mail($to, $subject, $body, $headers);

						mysql_close($conn);


							
							
					} else {
							$errors[] = 'The answer to your test question did not match what is on file.';
					}
					
					
	

					
					
				} // End of empty($errors) IF.
				
				// Return false and the errors:
				return array(false, $errors);

			} // End of check_login() function.


	
		
	// Check the login:
	list ($check, $data) = check_login($dbc, $_POST['testquestionanswer']);
	
	if ($check) { // OK!
		
		// Set the session data:
		
		$_SESSION['testquestionanswer'] = $data['testquestionanswer'];
		
		
		
	} else { // Unsuccessful!

		// Assign $data to $errors for signinhelp2.php:
		$errors = $data;

	}
		

} // End of the main submit conditional.

// Create the page:
/////////////////////////////////////////

// signinhelp2.php starts


		// This page prints any errors associated with logging in and it creates the entire login page including the form

	
		
		

		// Print any error messages if they exist:
		if (isset($errors) && !empty($errors))  {
			echo '<div style="width:35%; min-width:300px;margin:30px auto 0 auto;color:red;"><h5>Error!</h5>
			<p>The following error(s) occurred:<br />';
			foreach ($errors as $msg) {
				echo " - $msg<br />\n";
			}
			echo '</p><p>Please try again.</p> </div>';
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
					
					<!-- <h5>Password Recovery</h5> -->
					
					<span id="orangetext">Answer the test question displayed </span> <br><br>
						
						<table border="0" cellspacing="0" cellpadding="0" width="100%">
							<tbody>
							<tr>
								<td>
								<form action="signinhelp2.php" method="post">
								</td>
							</tr>
							<tr height="40">
								<td><?php echo $testquestion; ?> <br><br>
								<input id="element3" maxlength="100" name="testquestionanswer" size="40" type="text" value="<?php if (isset($_POST['testquestionanswer'])) echo $_POST['testquestionanswer']; ?>" />
								</td>
							</tr>
							<tr>
								<td>
								<br><input type="image" border=0 src="imagesnew/buttonsubmit.png" height=27 width=85 />
								</td>
							</tr>
							<tr>
								<td></form></td>
							</tr>
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
