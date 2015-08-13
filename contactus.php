<?php
include ('includesnew/topcontainer_shopping.php');

$title='Contact Us';

// Check for email form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Minimal form validation:
	if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
	
		// Create the body:
		$body = "The following individual contacted you:\n\nName: {$_POST['name']}\n\nEmail: {$_POST['email']}\n\nPhone: {$_POST['phone']}\n\nMessage: {$_POST['message']}";

		// Make it no longer than 70 characters long:
		$body = wordwrap($body, 70);
	
		// Send the email:
		mail('cmomah@hotmail.com', 'Contact Us Form Submission', $body, "From: {$_POST['email']}");

		// Print a message:
		echo '<div style="width:35%; min-width:300px; margin:0 auto; padding-top:20px;">
		<p style="color: red;"><em>Thank you for contacting WAXMODE. We will respond within the next 24 hours.</em></p>
		</div>';
		
		// Clear $_POST (so that the form's not sticky):
		$_POST = array();
	
	} else {
		echo '<div style="width:35%; min-width:300px; margin:0 auto; padding-top:20px;">
		<p style="color: red;">
		Name, email address, and message are required. Please fill out the form completely.
		</p>
		</div>';
	}
	
} // End of main isset() IF.					
?>

<div id="bottomcontainer"> 
  
    <div id="bottom" style="height:1100px;">
			
		<div id="itemdetailssection" style="height:1100px;">

		
			<div style="width:100%;">
		
				<div><h1 class="chkhdr">CONTACT US</h1></div>
			
			</div>
			
			<div id="contactusdiv">
			
				<!-- LEFT -->
				<div id="contactus_lhs">
				
					<div>
						
						<div style="height:330px; margin:0 0 30px 0;">	

							
							<div style="padding:20px 2.8%;">
						
							<h3>Address</h3>					
							
							<p style="font-weight:normal;">
							WAXMODE Fashion</p>
							<p>12321 Somewhere Avenue, Ste. 101 
							<br>Bellevue, WA 98006 
							
							<br><br>
							<h3>Email</h3>
							support@waxmode.com 
							
							<br><br>
							<h3>Phone</h3>
							1-800-555-2222
							
							</p>
						
							</div>

						
						</div>
				
					</div>
				
				</div>
				
				<!-- RIGHT -->
				<div id="contactus_rhs">
				
						
						<div id="contactus_rhs_inner">								
						
							<div style="padding:20px 2.8%;">
						
								<h3>Use the below form to contact us or you may call us at 1-888-555-2222</h3>
								<p>* Required</p>

								<form action="contactus.php" method="post">							
								
								<div class="contactus-rows">
									<div style="float:left;">Name:*</div>   <div style="float:right;"><input class="contactus_input" id="i1" name="name" type="text" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" maxlength="50" /></div>
								</div>
								
								<div class="contactus-rows">
									<div style="float:left;">Email:*</div>   <div style="float:right;"><input class="contactus_input" id="i1" name="email" type="text" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" maxlength="50" /></div>
								</div>
								
								<div class="contactus-rows">
									<div style="float:left;">Phone:</div>   <div style="float:right;"><input class="contactus_input" id="i1" name="phone" type="text" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>" maxlength="50" /></div>
								</div>
								
								<div class="contactus-rows">
									<div style="float:left;">Message:*</div>   <div style="float:right;">
										<textarea class="contactus_tarea" name="message" rows=5><?php if (isset($_POST['message'])) echo $_POST['message']; ?></textarea>
									</div>
								</div>
								
								<br>
								<div style="width:85px; clear:both;">
									<input type="image" border=0 src="imagesnew/buttonsubmit.png" height=27 width=85 border=0 />
								</div>
								
								</form>	
								
							</div>
						  
						</div>
				
				</div>
				
				<!--
				
				<div style="width:100%; clear:both;">
				
					<div>
						
						<div style="height:330px;">		

							
						
						</div>
				
					</div>
				
				</div>
				
				-->
				
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
