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

			<div id="chktrg_lhs">
				
				
				<div id="wrap" style="width:330px;margin-left:0;margin-top:0;padding-left:0;padding-top:0;"> 
				
					<form class="column" name="form1" action="createprofile.php" method="post">			
			
						<div style="width:180px;margin:0 auto 20px auto;"><h1 style="display:inline;">SHOPPER REGISTRATION</h1></div>
							
							<div style="width:180px;margin:10px auto;">Already a member? <a href="checkout.php?fromcart=true">SIGN IN</a></div>		
							
							
							<div class="input">
								<input id="i1" name="shopperfname" type="text" value="" placeholder="Your first name" class="required" size="24" />
							</div>
							<div class="input">
								<input id="i1" name="shopperlname" type="text" value="" placeholder="Your last name" class="required" size="24" />
							</div>
							<div class="input">
								<input id="i1" name="email" type="text" value="" placeholder="Your email" class="required email" size="24" />
							</div>
							<div class="input">
								<input id="i2" name="password" type="password" value="" placeholder="Your password" class="required" size="24" />
							</div>
							<div class="input">
								<select id="i1" class="required" name="testquestion" size="1">
									<option value="">Select a test question</option>
									<option value="What is your mothers maiden name?">What is your mothers maiden name?</option>
									<option value="In which city were you born?">In which city were you born?</option>
									<option value="What is your oldest siblings first name?">What is your oldest siblings first name?</option>
									<option value="What is your oldest childs first name?">What is your oldest childs first name?</option>
									<option value="In which city did you attend high school?">In which city did you attend high school?</option>
									<option value="What is the color of the first car your owned?">What is the color of the first car your owned?</option>
								</select>
							</div>
							<div class="input">
								<input id="i3" name="testquestionanswer" type="text" value="" placeholder="Test question answer" class="required" size="24" />
							</div>
							
							<div id="signin"> 
							
								<input type="hidden" name="fromcart" value="true"> <!-- tracks shopper that just came from the checkout page and had to sign in -->
								             
								<input type="image" border=0 src="imagesnew/shopnow_submit.png" height=27 width=85 />
							</div>
								
							<div>
								<div style="width:20px;margin:20px auto;">  OR  </div>
							</div>
								
							<div id="loginwithfacebook">
								<a href="#"><img src="imagesnew/joinwithfacebook.png" height=32 width=195 /> </a>
							</div>
							
							
							<div>
								<p class="formlegal">By signing up to join WaxMode through email or Facebook, you are agreeing to the <a href="#">Terms and Conditions</a> for the WaxMode.com shopping site.</p>
							</div>
							
						</form>
			
				</div>
				
				
			</div>
			
			<div id="chktrg_rhs">
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
