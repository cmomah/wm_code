<?php
$title='Check Out';
include ('includesnew/topcontainer_shopping.php');

error_reporting(E_ERROR);

// Retrieve the $fromcart value that flags that we just came from the cart page
	if(isset($_GET['fromcart'])) {
		$fromcart = $_GET["fromcart"];
	}


?>

<div id="bottomcontainer"> 
  
    <div id="bottom">
			
		<div id="itemdetailssection">
		
			<!--
			if (isset($_SESSION['shopperid'])) {
			$lhs_style = 'style="display:none;"';
			} -->
			

			<div id="chkt_lhs">
				
				
				<div id="wrap" style="width:300px;margin-left:0;margin-top:0;padding-left:0;padding-top:0;">  
		
					<form name="form1" action="signin.php" method="post">
					
							<div style="width:140px;margin:0 auto 20px auto;"><h1 style="display:inline;">PLEASE SIGN IN</h1></div>
							
							<div style="width:170px;margin:10px auto;">Not a member? <a href="checkout_reg.php?fromcart=true">SIGN UP</a></div>
					
							<div class="input">
								<input id="i1" name="email" type="text" value="" placeholder="Your email" class="required email" size="24" />
							</div>
							<div class="input">
								<input id="i2" name="password" type="password" value="" placeholder="Your password" class="required" size="24" />
							</div>
								
							<div id="signin"> 

								<input type="hidden" name="fromcart" value="true"> <!-- tracks shopper that just came from the checkout page and had to sign in -->
								
								<input type="image" border=0 src="imagesnew/signinnew.png" height=27 width=85 />
							</div>
							
							<div style="width:20px;margin:20px auto;">  OR  </div>
							
							<div id="loginwithfacebook">
								<a href="#"><img src="imagesnew/loginwithfacebook.png" height=32 width=195 /> </a>
							</div>
							
							<div style="width:170px;margin:10px auto;"><a class="colorlink" href="signinhelp.php">Forgot your password?</a></div>
							
					</form>	
			
				</div>
				
				
			</div>
			
			<div id="chkt_rhs">
				<?php
			
				$carttitle = 'Order Summary';
				$shipfee = '';
				$showeditcartlink = 'true';
				$showreduceandremove = 'false';
				$showcheckoutbutton = 'false';
			
				include ('cartnew.php');
				?>
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
