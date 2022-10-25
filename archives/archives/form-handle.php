<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dynamically Generate Select Dropdowns</title>
</head>
<body>

<?php
// define variables and set to empty values
$nameErr = $emailErr = $mediaErr = $websiteErr = "";
$name = $email = $media = $quantity = $website = "";
$bands = array(
	"The Beatles" => array("A Hard Day's Night" => "1964", "Help!" => "1965", "Rubber Soul" => "1965", "Abbey Road"=> "1969"),
	"LedZepplin" => array("Led Zepplin IV" => "1971"),
	"Rolling Stones" => array("Let It Bleed" => "1969", "Sticky Fingers" => "1971"),
    "The Who" => array("Tommy" => "1969", "Quadrophenia" => "1973", "The Who by Numbers" => "1975")
);
$bandList = NULL; // initialize the variable


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) { 
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
    }
  }

  if (empty($_POST["quantity"])) {
    $quantity = "";
  } else {
    $quantity = test_input($_POST["quantity"]);
  }

  if (empty($_POST["media"])) {
    $mediaErr = "Media is required";
  } else {
    $media = test_input($_POST["media"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Sample Form</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="form.php">  
  Name:   <br>
  <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Quantity: 
    <br>
  <textarea name="quantity" rows="1" cols="10"><?php echo $quantity;?></textarea>
  <br><br>
  Media:
    <br>
  <input type="radio" name="media" <?php if (isset($media) && $media=="cd") echo "checked";?> value="cd">CD
  <input type="radio" name="media" <?php if (isset($media) && $media=="download") echo "checked";?> value="download">Download 
  <span class="error">* <?php echo $mediaErr;?></span>
  <br><br>
<?php
/* Building a Drop down list from a multidimensional array*/

$bandList .= '<label for="$bands">Choose a band:</label>' . "\n"; //concatenate strings
$bandList .= '<select id="$bands" name="$bands">' . "\n"; // single quotes wrapping double quotes
$bandList .= '<option value="">← Select Band →</option>' . "\n";
foreach ($bands as $subArray => $band) {
	$bandList .= '<optgroup label="' . $subArray . '">' . "\n"; // use optgroup tag for group label
	foreach ($band as $name => $type) {
		$bandList .= '<option value="' . $name . '">' . $name . "," . $type . '</option>' . "\n";
	}
}
$bandList .= '</section>';
echo $bandList;// displays the dropdown list
?>
<p>
  <input type="submit" name="submit" value="Submit"> </p> 
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $quantity;
echo "<br>";
echo "<br>";
echo $media;
?>
<?php
	$albums = array("A Hard Day's Night", "Help!", "Rubber Soul", "Abbey Road");
	echo sort($albums);
    echo sort($bands);
?>

</body>
</html>