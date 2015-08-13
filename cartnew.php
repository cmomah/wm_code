<?php
/*
The cartnew.php code displays in the itemdetails.php page, the "Item has been added to the cart" message 
Within this code also, there is a function that validates that Size and Color were selected 
and if not selected, would show this message "Size and Color must both be selected. Please try again" 

This code has various functions for updating, removing items, emptying cart, and displaying the cart
				
It has an an include file, showcart.php, which is for displaying the cart whenever 
the user clicks on the "view cart" link or icon (view_cart.php)
*/


	if(isset($_POST['size'])) {
		$size = $_POST["size"];
	} else {
		$size = '';
	}
	
	if(isset($_POST['color'])) {
		$color = $_POST["color"];
	} else {
		$color = '';
	}	
		
	if (isset($_POST['productid'])) {
		$productid = $_POST['productid'];	
	}	

	if (isset($_POST['a2ctclicked'])) {   // If the ADD TO CART button in the ItemDetails.php was clicked	
	$arr = array($productid,$size,$color);
	$pcartid = join("-",$arr);	 
	}

// echo '<br>$action = ' . $action . '<br>';
// echo '<br>$size = ' . $size . '<br>';
// echo '<br>$color = ' . $color . '<br>';
	
// This contains the connection routine for the 
// database as well as getting the ID of the cart, etc 

$dbServer = "localhost"; 
$dbUser = "wwwwaxmo_wmfdb"; 
$dbPass = "WMfashiondb2!"; 
$dbName = "wwwwaxmo_wmfdb"; 

function ConnectToDb($server, $user, $pass, $database) 
{ 
// Connect to the database and return 
// true/false depending on whether or 
// not a connection could be made. 

$s = @mysql_connect($server, $user, $pass); 
$d = @mysql_select_db($database, $s); 

if(!$s || !$d) 
return false; 
else 
return true; 
} 

function GetCartId() 
{ 
// This function will generate an encrypted string and 
// will set it as a cookie using set_cookie. This will 
// also be used as the cookieId field in the cart table 

if(isset($_COOKIE["cartId"])) 
{ 
return $_COOKIE["cartId"]; 
} 
else 
{ 
// There is no cookie set. We will set the cookie 
// and return the value of the users session ID 
 
setcookie("cartId", session_id(), time() + ((3600 * 24) * 30)); 
return session_id(); 
} 
}
///////////

// Get a connection to the database  
$cxn = @ConnectToDb($dbServer, $dbUser, $dbPass, $dbName);


// Here, we add, update or remove depending on what is passed by the action variable

if(isset($_POST['action'])) {
	$action = $_POST['action'];
} else if (isset($_GET['action'])) {
	$action = $_GET['action'];
}

if ($action == 'add')
{ 	
	if (($size == '')||($color == '')) {
		optionsrequiredmsg();
	} else {	
		AddItem($pcartid, $_POST["qty"]);  
		echo '<br><span id="redtext" style="margin:0 0 15px 0;">Item has been added to the cart</span>';
	}	
}
 

// echo '<br>$action1 = ' . $action . '<br>';

if ($action <> 'add') {    // If we are not coming from the itemdetails page where Add to Cart was clicked...

	$pcartid = $_GET['pcartid'];

	switch($action)  
	{ 
	
	case "update_item": 
	{ 
	
	// echo '<br>$action2 = ' . $action . '<br>';
	// echo '<br>$pcartid = ' . $pcartid . '<br>';
	// echo '<br>$qty = ' . $_GET["qty"] . '<br>';
	
	UpdateItem($pcartid, $_GET["qty"]); 
	include("showcart.php"); 
	break; 
	} 
	
	case "remove_item": 
	{ 
	
	// echo '<br>$action3 = ' . $action . '<br>';
	// echo '<br>$pcartid = ' . $pcartid . '<br>';
	
	RemoveItem($pcartid); 
	include("showcart.php"); 
	break; 
	}  
	
	case "empty": 
	{ 	
	// We call the emptycart() function
	
	emptycart();  	
	include("showcart.php");
	break; 
	}  
	
	default: 
	{ 
	include("showcart.php"); //If the cartnew.php page is called up with no query string parameters, just display the cart.
	}  
	} 
}

 
//Let's start by looking at the AddItem function.

//AddItem accepts two parameters: The ID of the item to add to the cart, and the number of that item 
//to add:

function AddItem($pcartid, $qty)
{
	//The main part of the AddItem function checks whether or not this item already exists in the 
	//users cart. If it does, then its quantity field is updated and it isn't added again: 

	$q = "select count(*) from cart where cookieId = '" . GetCartId() . "' and pcartid = '" . $pcartid . "'";
	
	$result = mysql_query ($q); // Run the query.
	
	// echo '<br>' . $q . '<br>';

	$row = mysql_fetch_row($result);
	$numRows = $row[0];

	if($numRows == 0)
	{
	// echo '<br>item does not exist yet<br>';
	// This item doesn't exist in the users cart, 
	// we will add it with an insert query 

	$q = "insert into cart(cookieId, pcartid, qty) values('" . GetCartId() . "', '" . $pcartid . "', $qty)";
	
	// echo '<br>' . $q . '<br>';
	
	@mysql_query($q);
	}
	else
	{
	// echo '<br>test1<br>';	
	
	// This item already exists in the users cart, 
	// we will increase it's cart quantity instead 

	IncrementItem($pcartid);
	}
}
//Looking at the code above, we can see that if $numRows equals zero (i.e. the item isn’t already in the users cart) 
//then the item is added to the cart table. If not, the items quantity field is updated by calling the UpdateItem 
//function, which is described below. 

//UpdateItem accepts two parameters, in the same way that the AddItem function does:

function UpdateItem($pcartid, $qty)

//It executes a simple UPDATE SQL query against the cart table, updating the quantity of one specific item. The cookieId 
//field is used to match the users session ID to that particular product, making sure that the quantity is only updated 
//for that item and the current user:
{
mysql_query("update cart set qty = $qty where cookieId = '" . GetCartId() . "' and pcartid = '" . $pcartid . "'");
}

function IncrementItem($pcartid)
{
// First determine the quantity of the item
$q = "select qty from cart where cookieId = '" . GetCartId() . "' and pcartid = '" . $pcartid . "'";
	$result = mysql_query ($q);
	if ($result) { // If it ran OK, display the records.
		while ($row = mysql_fetch_array($result)) {	
		$qty = $row["qty"];	
		}
	}
    mysql_free_result ($result); // Free up the resources.			

// Then increment the quantity of the item by 1
$q = "update cart set qty = $qty + 1 where cookieId = '" . GetCartId() . "' and pcartid = '" . $pcartid . "'";

mysql_query ($q);

// echo '<br>' . $q . '<br>';

}

//Removing an item is a simple matter of the RemoveItem function being called. It accepts just one 
//parameter, which is the ID of the item to delete:

function RemoveItem($pcartid)

//Once connected to the database, a simple SQL DELETE query removes the item from the current users cart:
{
mysql_query("delete from cart where cookieId = '" . GetCartId() . "' and pcartid = '" . $pcartid . "'");
}

function emptycart()
// Delete everything from the current user's cart
{
mysql_query("delete from cart where cookieId = '" . GetCartId() . "'");
}

function optionsrequiredmsg()
{
echo '<br><span id="redtext" style="margin:0 0 15px 0;">Size and Color must both be selected. Please try again</span>';
}