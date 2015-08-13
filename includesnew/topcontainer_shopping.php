<?php
session_start();

require ('mysqli_connect.php'); // Connect to the db.
?>

<!-- 
Code included near the top in almost all pages, for displaying the top navigation bar
-->

<!DOCTYPE HTML>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" x-undefined="" />

<title><?echo $title; ?></title>

<meta name="viewport" content="width=device-width">

<link href="css/styles.css" rel="stylesheet" type="text/css">  <!-- main stylesheet -->
<link href="css/menustyles.css" rel="stylesheet" type="text/css" >  <!-- styles for side menus in the categresults.php page -->
<link href="css/jqueryvalidval.css" rel="stylesheet">  <!-- styles for shopper sign in, registration and shipping forms -->

<script src="jsnew/jquery.js"></script>	 <!-- JQuery Library --> 


</head>

<body>

<!-- JavaScript for the temporary Facebook "like" buttons - the "like" button code is in categresults.php page -->

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1672066486355845',
      xfbml      : true,
      version    : 'v2.4'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<div id="wrapper">


<?php
/* Retrieve current page
function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

$curPageName = curPageName();

*/

include ('includesnew/topmenu.php');
?>