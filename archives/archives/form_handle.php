
<?php
// define variables and set to empty values
$prices = array("Shipping = 2.99\n","Download = 9.99\n","CD = 12.99\n");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
.w3-sidebar {
  z-index: 3;
  width: 250px;
  top: 43px;
  bottom: 0;
  height: inherit;
  padding-left: 20px;
  padding-top: 20px;
}
</style>
</head>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-theme-l1">Logo</a>
      <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
      <a href="template.php" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Home</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Catalog</a>
     <a href="form.php" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Order Form</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Our Philsophy</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Work for Us</a>
  </div>
</div>

<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item"><b>Prices</b></h4>
  <?php 
  //Create a forloop to show prices
  for ($k = 0; $k < count($prices); $k++) {
    echo "$prices[$k] <br>";
  }?>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

  <div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
      <h1>Album Emporium</h1>
				<body>
					<u>
						<?php
						$heading = "Cost by Quantity";
						echo "$heading"; ?></u>
					<?php
					//Create numeric variables and heading variable
					$shipping = 2.99;
					$downloadPrice = 9.99;
					$cdPrice = 12.99;
					$total = 0.0;
					$gTotal = 0.0;
					$prices = array("Shipping = 2.99", "Download = 9.99", "CD = 12.99");
					// Validate the name:
					if (!empty($_REQUEST['name'])) {
						$name = $_REQUEST['name'];
					} else {
						$name = NULL;
						echo '<p class="error">You forgot to enter your name!</p>';
					}
					$bands = $_REQUEST['band'];

					// Validate the quantity:
					if (!empty($_REQUEST['quantity'])) {
						$quantity = $_REQUEST['quantity'];
					} else {
						$quantity = NULL;
						echo '<p class="error">You forgot to enter your quantity!</p>';
					}
					//cast quantity as int
					(int)$quantity;
					// Validate the media:
					if (isset($_REQUEST['media'])) {

						$media = $_REQUEST['media'];

						if ($media == 'CD') {
							$greeting = '<p><strong>Who uses CDs?</strong></p>';
						} elseif ($media == 'Download') {
							$greeting = '<p><strong>Thank you for not buying a CD.</strong></p>';
						} else { // Unacceptable value.
							$media = NULL;
							echo '<p class="error">Media should be either "CD" or "Download"!</p>';
						}
					} else { // $_REQUEST['media'] is not set.
						$media = NULL;
						echo '<p class="error">You forgot to select your media!</p>';
					}

					if ($media == "CD") {
						$total = $quantity * $cdPrice + $shipping;
					} else {
						$total = $quantity * $downloadPrice + $shipping;
					}
					// If everything is OK, print the message:
					if ($name && $media && $quantity) {

						echo "<p>Thank you, <strong>$name</strong>, for your order of <strong><u>$quantity $media(s)</u></strong> for <strong>$bands</strong>.\n
		The cost of your order is $total and your order will ship in 7-10 business days.";
					} else { // Missing form value.
						echo '<p class="error">Please go back and fill out the form again.</p>';
					}
		$i=1;
					if ($media == "Download") {
						echo "<h3> While loop for Download Price</h3>";
						while ($i <= (int)$quantity) {
							 $gTotal = ($downloadPrice * $i);
							echo "The price for $i is $gTotal<br>";
							$i += 1;
					} }
					else{
						echo "<h3> For loop for CD Price</h3>";
							for($i=1;$i<=$quantity;$i++)
							{
							 $gTotal=($i * $cdPrice); 
							 echo "The quantity of $i = $gTotal. <br>";
							}
						$gTotal = $gTotal + $shipping;
						echo "Total + Shipping = $gTotal";}

					?>
				</body>
			  </div>
  </div>

<!-- eventual use the pagination feature to scroll through albums -->
  <!-- Pagination -->
  <div class="w3-center w3-padding-32">
    <div class="w3-bar">
      <a class="w3-button w3-black" href="home.html">1</a>
      <a class="w3-button w3-hover-black" href="catalog.html">2</a>
      <a class="w3-button w3-hover-black" href="form.html">3</a>
      <a class="w3-button w3-hover-black" href="form_handle.html">4</a>
      <a class="w3-button w3-hover-black" href="philsophy.html">5</a>
      <a class="w3-button w3-hover-black" href="workForUs.html">»</a>
    </div>
  </div>

  <footer id="myFooter">
    <div class="w3-container w3-theme-l2 w3-padding-32">
      <h4>AE, inc.  &copy 2022</h4>
          <em> Christina Camacho, <a href = "https://www.dallascollege.edu/">Dallas College</a>, &copy 2022 </em>
    <p></p>
    | <a href="home.html">Home</a> | <a href="catalog.html">Catalog</a> |<a href="form.html">Order Form</a> | <a href="philsophy.html">Our philosophy</a> | <a
        href="workForUs.html">Work for Us</a>  | <a href = "mailto: camacho.christina@gmail.com">Email</a> |
    </div>

    <div class="w3-container w3-theme-l1">
      <p><a href="" target="_blank"></a></p>
    </div>
  </footer>

<!-- END MAIN -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>
</html>
