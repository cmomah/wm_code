<?php
require ('mysqli_connect.php'); // Connect to the db.

// Code included near the top of the main landing page, index.php, for displaying the top navigation bar for the home page


// Retrieve current page
function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

$curPageName = curPageName();

include ('includesnew/topmenu.php');
?>