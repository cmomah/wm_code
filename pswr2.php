<?php
$title='Password Reset';
//ini_set('display_errors', 'On');

include ('includesnew/topcontainer_shopping.php');

if(isset($_SESSION['shopperid'])) {
	$shopperid = $_SESSION['shopperid'];
}


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

// echo 'shopperid = ' . $shopperid;

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
					
							echo '<div style="width:66%;margin:30px auto 0 auto;color:red;">
							<b>You have successfully verified your identity. A link to reset your password has been sent to the email we have on file for you</b></div>';
							
						if(isset($_SESSION['shopperemail']))
						$shopperemail = $_SESSION['shopperemail'];	
						

						if(isset($_SESSION['shopperid']))
						$shopperid = $_SESSION['shopperid'];

						
 
						$to=$shopperemail;
						$subject = "Information from Waxmode.com";
						$headers  = "From:info@waxmode.com\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						$body = 'Thank you for verifying your sign-in information<br><br>Please click on <a href="http://www.waxmode.com/responsive2/pswr3.php?sid=' . $shopperid . '" target="_blank">this link</a> to reset your password';
						
						
						// send email 
						
						$send = mail($to, $subject, $body, $headers);


							
							
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

		// Assign $data to $errors.php:
		$errors = $data;

	}
		

} // End of the main submit conditional.

// Create the page:
/////////////////////////////////////////

// pswr2.php starts


		// This page prints any errors associated with logging in and it creates the entire login page including the form

	
		
		

		// Print any error messages if they exist:
		if (isset($errors) && !empty($errors))  {
			echo '<div style="width:500px;margin:30px auto 0 auto;color:red;"><h5>Error!</h5>
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
			
		



			<div>
			<!-- main content starts -->
			
			
			
			<table border=0 cellspacing=0 cellpadding=0 width=400 style="margin-left:383px;">
				
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
						
						<table border="0" cellspacing="0" cellpadding="0" width=400>
							<tbody>
							<tr>
								<td>
								<form action="pswr2.php" method="post">
								</td>
							</tr>
							<tr height="40">
								<td><?php echo $testquestion; ?> <br><br>
								<input id="element3" maxlength="100" name="testquestionanswer" size="60" type="text" value="<?php if (isset($_POST['testquestionanswer'])) echo $_POST['testquestionanswer']; ?>" />
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
