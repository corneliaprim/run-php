<?php
include_once 'functions.php'; //move functions to the top always
$pageTitle = "Album Emporium";
$subTitle = "Invoice"; 
$heading = "Cost by Quantity";
$shipping = 2.99;
$downloadPrice = 9.99;
$cdPrice = 12.99;
$prices = array("Shipping = 2.99\n", "Download = 9.99\n", "CD = 12.99\n");
$leftSidebar = NULL;
for ($k = 0; $k < count($prices); $k++) {
	$leftSidebar.= "$prices[$k] <br>";
}


if (!empty($_REQUEST['name'])) {
	$name = $_REQUEST['name'];
} else {
	$name = NULL;
	$pageContent .= '<p class="error">You forgot to enter your name!</p>';
}
$bands = $_REQUEST['album'];
// Validate the quantity:
if (!empty($_REQUEST['quantity'])) {
	$quantity = $_REQUEST['quantity'];
} else {
	$quantity = NULL;
	$pageContent .= '<p class="error">You forgot to enter your quantity!</p>';
}
//cast quantity as int
(int)$quantity;
// Validate the media:
if (isset($_REQUEST['media'])) {

	$media = $_REQUEST['media'];

	if ($media == 'CD') {
		$greeting = "<p><strong>Who uses CDs?</strong></p>";
	} elseif ($media == 'Download') {
		$greeting = "<p><strong>Thank you for not buying a CD. CDs are destructive to the environment.</strong></p>";
	} else { // Unacceptable value.
		$media = NULL;
		$pageContent .= '<p class="error">Media should be either "CD" or "Download"!</p>';
	}
} else { // $_REQUEST['media'] is not set.
	$media = NULL;
	$pageContent .= '<p class="error">You forgot to select your media!</p>';
}


//calculations
$i = 1;
if ($media == "Download") {

	$pageContent .= "<h3> While loop for Download Price</h3>";
	while ($i <= (int)$quantity) {
		$total = priceCalc($downloadPrice,$i);
		$pageContent .= "The price for $i is $total<br>";
		$i += 1;
	}
} else {
	$pageContent .= "<h3> For loop for CD Price</h3>";
	for ($i = 1; $i <= $quantity; $i++) {
		$total = priceCalc($cdPrice,$i) + $shipping;
		$pageContent .= "The quantity of $i = $total. <br>";
	}
	$pageContent .= "Total + Shipping = $total";
}


// If everything is OK, print the message:
if ($name && $media && $quantity) {

	$pageContent .= "<p> Hello, <strong>$name</strong>. Here is your order summary: <strong><u>$quantity $media(s)</u></strong> for <strong>$bands</strong>.\n
The cost of your order is $total and your order will ship in 7-10 business days.";
} else { // Missing form value.
	$pageContent .= '<p class="error">Please go back and fill out the form again.</p>';
}


include_once 'template.php';
