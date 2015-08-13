<?php
session_start(); // Access the existing session.

// Cancel the session:

	$_SESSION = array(); // Clear the variables.
	session_destroy(); // Destroy the session itself.

include ('includesnew/topcontainer_shopping.php');	



		// Print a customized message:
		echo '<div id="msgdiv" style="width:90%;margin:40px auto 5px auto;">
			
			
					<div style="width:160px; height:100%; padding:20px 3%; margin-left:auto;margin-right:auto;">
			
						<h1>Logged Out!</h1>
					
						<p style="margin:20px 0;">You have logged out.</p>
							
						<a class="colorlink" href="categresults.php?producttarget=women">Continue Shopping</a>
						
					</div>
				
				
			</div>
			
			<div id="msgdivb" style="width:90%;margin:0 auto 100px auto;">
			
			</div>';


include ('includesnew/footertall.php');
?>
	
</div>

</body>

</html>
