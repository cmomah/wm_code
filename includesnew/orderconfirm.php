<?php
session_start();

$title='Order Confirmation';

// Retrieve cart data
				
$q1 = "select cart.*, prodcarttable.pcartid, designers.tradeName, prodcarttable.productname, prodcarttable.productprice, productsize.size, productcolor.color, productimages.productimgthumbnail 
from cart
inner join prodcarttable
on cart.pcartid = prodcarttable.pcartid
inner join designers
on prodcarttable.designerid = designers.designerid
inner join productsize
on prodcarttable.sizeid = productsize.sizeid
inner join productcolor
on prodcarttable.productcolorid = productcolor.productcolorid
inner join productimages
on prodcarttable.productid = productimages.productid
WHERE cart.cookieId = '$cookieId' 
and productimages.cartimage = 'yes'
order by prodcarttable.productname asc";

//echo '<br>q1: ' . $q1 . '<br>';

$r1 = @mysqli_query ($dbc, $q1);

$emailBody = 'Thank you for your order placed on www.waxmode.com on ' . date("Y/m/d") . ' (order reference number: ' . $orderid . '). Please find below your order details.
	
	<br><br>
	Your payment is currently being processed, and this would usually take a few minutes. 
	In special cases where it is necessary, we may contact you during this process for additional information regarding the payment.
	As soon as the payment for your order is approved, you will receive the payment receipt and shipping information in separate emails
	
	<br><br>
	For your convenience, you can also check your order status online anytime, at www.waxmode.com/myaccount.php
	<br><br>
	
	***********************************************************
	<br>
	ORDER DETAILS
	<br>
	***********************************************************
	<br>
	
	<br>Order reference no.: ' . $orderid . '
	<br>Date/time: ' . date("Y/m/d") . '
	<br>Subtotal: $' . $subtotal . '
	<br>Shipping fee: $' . $shipfee . '
	<br>Grand total: $' . $totalCost . '
	<br><br>-----------------------------------------------
	<br>Items you purchased:<br>-----------------------------------------------<br>';

//echo '<br>q1 #2: ' . $q1 . '<br>';	

//exit();
	
while ($row = mysqli_fetch_array($r1, MYSQLI_ASSOC))  {
    $pcartid = $row['pcartid'];
    $productname = $row['productname'];
    $color = $row['color'];
    $size = $row['size'];
    $qty = $row['qty'];
    $productprice = $row['productprice']; 

    $emailBody .= 'Product ID: ' . $pcartid . '<br>Product Name: ' . $productname . '
	<br>Size: ' . $size . '<br>Color: ' . $color . '<br>Quantity: ' . $qty . '
	<br>Unit Price: $' . $productprice . '<br><br>';
}

$emailBody .= '<br>
	-----------------------------------------------
	<br>Shipping address information:<br>-----------------------------------------------<br>	
	
	' . $shopperfname . ' ' . $shopperlname . '
	<br>' . $shopperaddr . '
	<br>' . $shoppercity . ', ' . $shopperstate . ' ' . $shopperzip . '
	<br>' . $shoppercountry . '
	<br><br>Email Address: ' . $shopperemail . '
	
	<br><br>
	***********************************************************
	<br><br>
	
	Thank you for shopping with us. Please visit again soon.
	
	<br><br>
	Sincerely,
	
	<br><br>
	WaxMode Fashion
	<br>
	http://www.waxmode.com';

$subject = "WaxMode Order Confirmation";
$emailBody = $emailBody;
$headers  = "From:info@waxmode.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$to = "$shopperemail";

$mail_result = mail($to, $subject, $emailBody, $headers);

// Delete the items from the cart since they have now been purchased
$q = "DELETE from cart where cart.cookieId = '$cookieId'";
				
$r = @mysqli_query ($dbc, $q); // Run the query.