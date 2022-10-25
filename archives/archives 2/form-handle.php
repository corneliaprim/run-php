<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Form Feedback</title>
  <style type="text/css>
  .error {
      font-weight:bold;
      color: #c00;    
  }
</style>
</head>
<body>
<?php
	// retrieve the values from the form
	$name = $_REQUEST['name'];
	$media = $_REQUEST['media'];
	$quantity = $_REQUEST['quantity'];
	// display them on the page
	echo "<p>You entered the following:</p>";
	echo "<p>Name: $name</p>";
	echo "<p>Quantity: $media</p>";
	echo "<p>Media Type: $quantity</p>";

?>
<!--
<?php
$greeting = "Hello!";
// Validate the name:
if (!empty($_REQUEST['name'])) {
	$name = $_REQUEST['name'];
} else {
	$name = NULL;
	echo '<p class="error">You forgot to enter your name!</p>';
}
// Validate the quantity:
if (!empty($_REQUEST['quantity'])) {
	$quantity = $_REQUEST['quantity'];
} else {
	$quantity = NULL;
	echo '<p class="error">You forgot to enter your quantity!</p>';
}

// If everything is OK, print the message:
if ($name && $quantity) {

	echo "<p>Thank you, <strong>$name</strong>, for your order of:</p>
	<pre>$quantity</pre> <em>$media</em>
	<p>We will ship your order in three days.</p>\n";

	echo $greeting;

} else { // Missing form value.
	echo '<p class="error">Please go back and fill out the form again.</p>';
}
?>
-->
</body>
</html>