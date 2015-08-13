<!-- Included in shipping.php and shipmtd.php for posted data validation retry -->
<div id="bottomcontainer"> 
  
    <div id="bottom">
			
		<div id="itemdetailssection">

		
			<div><h1 class="chkhdr">WAXMODE CHECK OUT</h1></div>   <!-- Div previously chkhdrdiv -->
			
			<div id="chkbrcrumbs">
				<div class="chkbrcrumbs_step" id="currentstep"><h4 class="currentsteplabel">Shipping Address</h4></div>
				<div class="chkbrcrumbs_step"><h4 class="chksteplabel">Shipping Method</h4></div>
				<div class="chkbrcrumbs_step"><h4 class="chksteplabel">Billing Address</h4></div>
				<div class="chkbrcrumbs_lstep"><h4 class="chksteplabel">Payment / Submit</h4></div>
			</div>
			
			<div id="chktsh_lhs">
			
				<?php				
				if (!empty($shopperaddr)) {
				
				echo '<div><h1 style="padding-bottom:20px;">Your saved shipping address</h1></div>
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
					<?php echo '<br>' . $shoppercountry; ?> 
				<?php echo '</div>
				
				
				<form class="column" name="form1" action="shipmtd.php" method="post">
					<div class="shpsubmit"> 
						
						<div style="float:left;">
						<input type="hidden" name="fromcart" value="true"> 
						<input type="hidden" name="useaddr" value="existing">								
									
						<input style="margin-top:15px;" type="image" border=0 src="imagesnew/shiptothisaddr.png" height=27 width=140 />
						</div>
						
						<div style="float:left;margin-left:20px;margin-top:15px;">
						<a class="colorlink-ul" href="shipedit.php?fromcart=true&fromshp=true">Edit Shipping Address</a>
						</div>
						
					</div>
				
					<div style="margin-top:10px;clear:both;">	
					<input type="checkbox" name="sameasshipping" value="Same as my shipping address" checked>Use as my billing address.
					</div>
				</form>
				
				<div style="margin:25px 0;">
					<h2 style="color:#fb5100;">OR</h2>
				</div>';
				
				}
				?>
				
				<div id="wrap" style="width:420px;margin-left:0;margin-top:0;padding-left:0;padding-top:0;"> 
				
					<form class="column" name="form1" action="shipmtd.php" method="post">			
			
						<div><h1 style="padding-bottom:20px;">Ship to a new shipping address</h1></div>		
							
						<div class="shipform"> <!-- Adding this div class so that we can style the dimensions here different from the other forms -->	
							
							<div class="input">
								First Name:<br> <input id="i1" name="shopperfname" type="text" value="<?php if(isset($_SESSION['shopperfname'])) { echo $_SESSION['shopperfname']; } ?>" class="required" size="50" />
							</div>
							<div class="input">
								Last Name:<br> <input id="i2" name="shopperlname" type="text" value="<?php if(isset($_SESSION['shopperlname'])) { echo $_SESSION['shopperlname']; } ?>" class="required" size="50" />
							</div>
							<div class="input">
								Street Address:<br> <input id="i3" name="shopperaddr" type="text" value="" class="required" size="50" />
							</div>
							
							<div class="input">
								<div class="csz">
									City:<br> <input id="i4" name="shoppercity" type="text" value="" class="required" size="10" />
								</div>
								<div class="csz">
									Zip/Postal Code:<br> <input id="i6" name="shopperzip" type="text" value="" size="10" />
								</div>
							</div>
							
							<script src="jsnew/countrystatedd.js"></script>
							
							<div class="input">
								<div class="countrystate">
									Country:<br> <select id="country" name="shoppercountry"></select>
								</div>
								<div class="countrystate">
									State:<br> <select id="state" name="shopperstate"></select>
								</div><br />
								
								<script language="javascript">
									populateCountries("country", "state");
								</script>
								
							</div>
							
							<div class="input">
								Phone Number:<br> <input id="i5" name="shopperphone" type="text" value="" class="required" size="50" />
							</div>
							
							<div class="shpsubmit"> 
							
								<input type="hidden" name="fromcart" value="true"> <!-- tracks shopper that just came from the checkout page and had to sign in -->
								<input type="hidden" name="useaddr" value="new">								
								
								<input style="margin-top:15px;" type="image" border=0 src="imagesnew/shiptothisaddr.png" height=27 width=140 />
							</div>
							
							<div style="margin-top:5px;">	
							<input type="checkbox" name="sameasshipping" value="Same as my shipping address" checked>Use as my billing address.
							</div>
							
						</div>
					
					</form>
			
				</div>
				
				
			</div>
			
			<div id="chktsh_rhs">
				<?php
				
				$carttitle = 'Order Summary';
				$shipfee = '';
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