<?php  
session_start();
	
$title='Submit Order';
include ('includesnew/topcontainer_shopping.php');

error_reporting(E_ERROR);
//ini_set('display_errors', 'On');

// Retrieve Price in Cents value 	
	if(isset($_POST['PriceInCents'])) {
		$PriceInCents = $_POST["PriceInCents"];
	}

// Retrieve shipping option selected. 
	if(isset($_POST['shpoption'])) {
		$shpoption = $_POST['shpoption'];
	}

// Retrieve checkbox value for the question "Use as my billing address"
	if(isset($_POST['sameasshipping'])) {
		$sameasshipping = $_POST["sameasshipping"];
	}
	
// Retrieve shopper's id if signed in 	
	if(isset($_SESSION['shopperid'])) {
		$shopperid = $_SESSION['shopperid'];
	}	

// Retrieve needed data for other procession actions 
	if(isset($_POST['totalCost'])) {
		$totalCost = $_POST['totalCost'];
	} 
	if(isset($_POST['shipfee'])) {
		$shipfee = $_POST['shipfee'];
	}
	if(isset($_POST['cookieId'])) {
		$cookieId = $_POST['cookieId'];
	}

	

try {

	require_once('Stripe/lib/Stripe.php');
	Stripe::setApiKey("sk_test_gGTxTw8s2UeG6L6dHZumvVsf");  // Replace API key. Test secret key goes here

	$charge = Stripe_Charge::create(array(
  "amount" => $PriceInCents,
  "currency" => "usd",
  "card" => $_POST['stripeToken'],
  "description" => "Charge for Facebook Login code."
));
	//send the file, this line will be reached if no error was thrown above
	//echo "<h1>Your payment has been completed. We will send you the Facebook Login code in a minute.</h1>";

	// include the file that contains the rest of transaction processing, like DB storage and sending of confirmation email
	include ('includesnew/submitprocessing.php');

  //you can send the file to this email:
  //echo $_POST['stripeEmail'];
}

catch(Stripe_CardError $e) {
	
}

//catch the errors in any way you like

 catch (Stripe_InvalidRequestError $e) {
  // Invalid parameters were supplied to Stripe's API

} catch (Stripe_AuthenticationError $e) {
  // Authentication with Stripe's API failed
  // (maybe you changed API keys recently)

} catch (Stripe_ApiConnectionError $e) {
  // Network communication with Stripe failed
} catch (Stripe_Error $e) {

  // Display a very generic error to the user, and maybe send
  // yourself an email
} catch (Exception $e) {

  // Something else happened, completely unrelated to Stripe
}
?>