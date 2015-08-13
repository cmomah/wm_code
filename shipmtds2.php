<?php
$title='Shipping Method';
include ('includesnew/topcontainer_shopping.php');

error_reporting(E_ERROR);
//ini_set('display_errors', 'On');

// Retrieve the $fromcart value 	
	if(isset($_POST['fromcart'])) {
		$fromcart = $_POST["fromcart"];
	}	


// Retrieve shipping option selected. 
	if(isset($_POST['shpoption'])) {
		$shpoption = $_POST["shpoption"];
	}		

// Assign rates to the $shipfee variable
	if((isset($shpoption))&&($shpoption == 'Standard Shipping - $5')) {
		$shipfee = '5.00';
	} else if ((isset($shpoption))&&($shpoption == 'Two Day Shipping - $15')) {
		$shipfee = '15.00';
	} else if ((isset($shpoption))&&($shpoption == 'Next Day Shipping - $25')) {
		$shipfee = '25.00';
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
	
	
?>

<div id="bottomcontainer"> 
  
    <div id="bottom">
			
		<div id="itemdetailssection">

		
			<div><h1 class="chkhdr">WAXMODE CHECK OUT</h1></div>   <!-- Div previously chkhdrdiv -->
			
			<div id="chkbrcrumbs">
				<div class="chkbrcrumbs_step"><h4 class="chksteplabel">Shipping Address</h4></div>
				<div class="chkbrcrumbs_step" id="currentstep"><h4 class="currentsteplabel">Shipping Method</h4></div>
				<div class="chkbrcrumbs_step"><h4 class="chksteplabel">Billing Address</h4></div>
				<div class="chkbrcrumbs_lstep"><h4 class="chksteplabel">Payment / Submit</h4></div>
			</div>
			
			<div id="chktsh_lhs">				
				
				<?php				
				if (!empty($shopperaddr)) {
				
				echo '<div style="width:90%; padding:0 0 20px 0; border-style:solid; border-color:#E7E7E7; border-width:0 0 1px 0;">';
				
					echo '<div><h1 style="padding:0 0 20px 0;">1. Shipping Address</h1></div>
					<div>';
					?>
						<?php echo $shopperfname . ' ' . $shopperlname; ?>
						<?php echo '<br>' . $shopperaddr; ?>
						<?php echo '<br>' . $shoppercity; 					
						if($shopperstate != '') {
						  echo ', ' . $shopperstate; 
						}
						if($shopperzip != '') {
						  echo ', ' . $shopperzip; 
						}
						?>
						<?php echo '<br>' . $shoppercountry; 
						
					echo '</div>';	
					
					if (!empty($sameasshipping)) {
						echo '<div>(Billing Address is: ' . $sameasshipping . ')</div>';
					} else {
						echo '<div>(Billing Address is not same as shipping. I will enter it later.)</div>';
					}
				
					echo '<div style="margin-top:10px;">
					<a class="colorlink-ul" href="shipedit.php?fromcart=true&fromshp=true">Edit Shipping Address</a>
					</div>
				
				</div>';
				}
				?>
				
				<div style="width:90%; padding:0 0 20px 0; border-style:solid; border-color:#E7E7E7; border-width:0 0 1px 0;">
				
					<div><h1 style="padding:20px 0;">2. Shipping Options</h1></div>
				
					<div><?php echo $shpoption; ?> </div> 
				
				</div>
				
				<div>
				
					<form name="form1" action="paymt.php" method="post">  
				
						<input type="hidden" name="fromcart" value="true"> 
						<input type="hidden" name="sameasshipping" value="<?php echo $sameasshipping; ?>">
						<input type="hidden" name="shpoption" value="<?php echo $shpoption; ?>">
						<input type="hidden" name="shipfee" value="<?php echo $shipfee; ?>">
										
						<input style="margin-top:15px;" type="image" border=0 src="imagesnew/saveandcontinue.png" height=27 width=113 />				
					
					</form> 
					
				</div>	
				
			</div>

			
			<div id="chktsh_rhs">
				<?php				
				
				$carttitle = 'Order Summary';
				$shipfee = $shipfee; // Ship fee determined near page top, depending on ship method passed to this page. To be plugged into the $shipfee variable in the cart
				$showeditcartlink = 'true';
				$showreduceandremove = 'false';
				$showcheckoutbutton = 'false';
			
				include ('cartnew.php');
				?>
			</div>
			
			
			<div style="clear:both;">
			
			
			

				
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
