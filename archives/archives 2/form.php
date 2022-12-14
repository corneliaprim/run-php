<?php

// define variables and set to empty values
$prices = array("Shipping = 2.99\n","Download = 9.99\n","CD = 12.99\n");
$name  = $nameErr= $media = $quantity = $pageContent = NULL;
$bands = array(
  "The Beatles" => array("A Hard Day's Night" => "1964", "Help!" => "1965", "Rubber Soul" => "1965", "Abbey Road" => "1969"),
  "LedZepplin" => array("Led Zepplin IV" => "1971"),
  "Rolling Stones" => array("Let It Bleed" => "1969", "Sticky Fingers" => "1971"),
  "The Who" => array("Tommy" => "1969", "Quadrophenia" => "1973", "The Who by Numbers" => "1975")
);
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Add the Bootstrap framework to to the page to help style it's contents. -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    html, body, h1, h2, h3, h4, h5, h6 {
      font-family: "Roboto", sans-serif;
    }

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
      <a href="form.php" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Home</a>
      <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Purchases</a>
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
    <form action="handle_form.php" method="post">

        <fieldset>
            <legend>Enter your information in the form below:</legend>

            <p><label>Name: <input type="text" name="name" size="20" maxlength="40"></label></p>

            <p><label for="media">media: </label><input type="radio" name="media" value="CD"> CD <input type="radio" name="media" value="Download"> Download </p>
            <!-- 1. Use a foreach loop to write out every album from the associative array to a HTML select list of albums. -->
            <p><label>Quantity: <textarea name="quantity" rows="1" cols="2"></textarea></label></p>
            <p>
                <?php
                $bandList = NULL; // initialize the variable
                $bandList .= '<label for="$bands">Choose an Album:</label>' . "\n"; //concatenate strings
                $bandList .= '<select id="$bands" name="$bands">' . "\n"; // single quotes wrapping double quotes
                $bandList .= '<option value="">??? Select Band ???</option>' . "\n";
                foreach ($bands as $albums => $band) {
                    $bandList .= '<optgroup label="' . $albums . '">' . "\n"; // use optgroup tag for group label
                    foreach ($band as $bandName => $type) {
                        $bandList .= '<option value="' . $bandName . '">' . $bandName . "," . $type . '</option>' . "\n";
                    }
                }
                $pageContent .= $bandList;
                //($_SERVER["REQUEST_METHOD"] == "POST")
                ?>
                <?php echo $pageContent; ?>
            </p>
        </fieldset>

        <p align="center"><input type="submit" name="submit" value="Submit My Information"></p>

    </form>
    </div>
    </div>

</body>

</html>