<?php
$pageTitle = "Album Emporium";
$subTitle = "Order Form"; //figure out why this is not showing up later.
$heading = "Cost by Quantity";
$shipping = 2.99;
$downloadPrice = 9.99;
$cdPrice = 12.99;
$prices = array("Shipping = 2.99\n", "Download = 9.99\n", "CD = 12.99\n");
$leftSidebar = NULL;
for ($k = 0; $k < count($prices); $k++) {
	$leftSidebar.= "$prices[$k] <br>";
}

// define variables and set to empty values
$name  = $nameErr = $media = $quantity = $pageContent = NULL;
$bands = array(
  "The Beatles" => array("A Hard Day's Night" => "1964", "Help!" => "1965", "Rubber Soul" => "1965", "Abbey Road" => "1969"),
  "LedZepplin" => array("Led Zepplin IV" => "1971"),
  "Rolling Stones" => array("Let It Bleed" => "1969", "Sticky Fingers" => "1971"),
  "The Who" => array("Tommy" => "1969", "Quadrophenia" => "1973", "The Who by Numbers" => "1975")
);
$bandList = NULL; // initialize the variable
$bandList .= '<label for="album">Choose an Album:</label>' . "\n"; //concatenate strings
$bandList .= '<select id="album" name="album">' . "\n"; // single quotes wrapping double quotes
$bandList .= '<option value="">← Select Band →</option>' . "\n";
foreach ($bands as $albums => $band) {
  $bandList .= '<optgroup label="' . $albums . '">' . "\n"; // use optgroup tag for group label
  foreach ($band as $bandName => $type) {
    $bandList .= '<option value="' . $bandName . '">' . $bandName . "," . $type . '</option>' . "\n";
  }
}
$albums = $albumKeySort = $albumsKeySortList = $albumsList = $albumsValueSortList = $albumValueSort = NULL;
$albums = array("The White Album" => "The Beatles", "Led Zepplin IV" => "LedZepplin","Tommy" =>"The Who","Help!" => "The Beatles","Abbey Road" =>"The Beatles"
,"Let It Bleed" =>"Rolling Stones","Sticky Fingers" =>"Rolling Stones","Quadrophenia" =>"The Who","The Who by Numbers"=> "The Who","Rubber Soul" =>"The Beatles");
ksort($albums);
foreach ($albums as $albumKeySort =>$artistKeySort){
  $albumsKeySortList .= "<li><b>Album:</b> $albumKeySort     <b>Artist:</b> $artistKeySort</li>\n";}
$albumsKeySortList .= "</ul>";

asort($albums);
$albumsValueSortList = "<ul>";
foreach ($albums as $albumsValueSort => $artistValueSort){
  $albumsValueSortList .= "<li><b>Artist:</b> $artistValueSort <b>Album: </b>$albumsValueSort </li>\n";
}
$albumsValueSortList .= "<ul>";

$pageContent = <<<HERE
<section>
          <fieldset>
            <legend>Enter your information in the form below:</legend>
            <form method="post" action="handle-invoice.php">
            <p><label>Name: <input type="text" name="name" size="20" maxlength="40"></label></p>
            <p><label for="media">media: </label><input type="radio" name="media" value="CD"> CD <input type="radio" name="media" value="Download"> Download </p>
            <p><label>Quantity: <input type="number" name="quantity" rows="1" cols="2" required value="1"></label></p>
            <p>
            </p>
            $bandList;
          </fieldset>
          <p align="center"><input type="submit" name="submit" value="Submit"></p>
        </form>
        <h2> Sort by Albums </h2>
        $albumsKeySortList
        <h2>Sorted by Artist</h2>
        $albumsValueSortList
</section>
HERE;
include_once 'template.php';
