<?php
$title='Payment';
include ('includesnew/topcontainer_shopping.php');

error_reporting(E_ERROR);
//ini_set('display_errors', 'On');

// Retrieve the $fromcart value 	
	if(isset($_POST['fromcart'])) {
		$fromcart = $_POST["fromcart"];
	}
	
	
// Retrieve shipping option selected. 
	if(isset($_POST['shpoption'])) {
		$shpoption = $_POST['shpoption'];
	}
				

// Retrieve shipping fee. 
	if(isset($_POST['shipfee'])) {
		$shipfee = $_POST['shipfee'];
	}		


// Retrieve checkbox value for the question "Use as my billing address"
	if(isset($_POST['sameasshipping'])) {
		$sameasshipping = $_POST["sameasshipping"];
	}
	
// Retrieve shopper's id if signed in 	
	if(isset($_SESSION['shopperid'])) {
		$shopperid = $_SESSION['shopperid'];
	}	


	// Retrieve the shipping address that gets displayed to shopper on the Payment page:
			
				if($shopperid != '') {
				$q = "select shopperfname, shopperlname, shopperaddr, shoppercity, shopperstate, shopperzip, shoppercountry from shoppers
				WHERE shopperid='$shopperid'";
				}
				
				// echo '<br>' . $q . '<br>';
				
				$r = @mysqli_query ($dbc, $q); // Run the query.

				if ($r) { // If it ran OK, display the records.	
				
				//get results for display
				while ($row = mysqli_fetch_array($r)) {
					$shopperfname = $row["shopperfname"];
					$shopperlname = $row["shopperlname"];
					$shopperaddr = $row["shopperaddr"];
					$shoppercity = $row["shoppercity"];
					$shopperstate = $row["shopperstate"];
					$shopperzip = $row["shopperzip"];
					$shoppercountry = $row["shoppercountry"];			
					}
						
					mysqli_free_result ($r); // Free up the resources.	
								
					} else { // If it did not run OK.

					// Public message:
					echo '<p class="redtext">Your address could not be retrieved. We apologize for any inconvenience.</p>';
								
					} // End of if ($r) IF.
	

include ('includesnew/paymtincl.php');	
?>