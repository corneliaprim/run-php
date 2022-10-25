<!doctype html>
<html lang="en">
  <head>
    <title>PHP Home Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Assignment 1</title>
</head>

<body>

<?php # Assignment1

$street = '3939 Valley View Ln';
$zipcode ='75244';
$city = 'Farmers Branch';
$state = 'Texas';
$address = $street . ' ' . $city . ', ' . $state . ' ' . $zipcode;
$schoolName = 'Dallas Community College';
$quote = 'If you think you will need a cat then, you will need a cat.';
const NAME = 'Christina Camacho'; //name constant
$file = $_SERVER['PHP_SELF'];
// Set the variables:
$x = 4; // Credits
$y = 135; //Costs per credit
$taxrate = .05; // 5% sales tax.

// Calculate the total.
$total = (($x * $y) * $taxrate) + ($x * $y);// Calculate and add the tax.

$perCredit = $total/$x;
$modulus = 315/2%$x;
$sub = $y - $x;
$user = get_current_user();
// Print the results:
echo "<h1> Welcome to my page, $user.</h1> ";
echo '<p> Hello, my name is ' . NAME . '.</p>';
echo "<p> I go to $schoolName. $schoolName is located at: $address.</p>";
echo "<p> I'm taking this PHP course to learn how to gather data from users on the front-end and
connect it the backend. I tend to procrastinate and need deadlines to get stuff done--hence, why I'm taking a class and not learning via YouTube. Being a procrastinator has it's
drawbacks because now I have to pay for classes. Classes at DCCCD costs: </p>

<p><strong>Total Costs:</strong> ($x * $y) + (($x * $y)*$taxrate) = \$$total
<br><strong> The costs per credit is: </strong> $total \ $x = \$$perCredit
<br><strong> The remainder of 315 \ 2 * $x is: </strong> $modulus
<br><strong> Demonstrating subtraction : </strong> $y - $x = $sub</p>

<p> One of my favorite quotes is from a mentor of mine. He once said to me,
<br><center>\"$quote\"</center> </p>

<p>I keep this quote on my desk so, I am reminded daily to have gratitude. Much of what we truly need is provided for in our society. Many of the other wants are peripheral
and unnecessary.</p>
<p>This is all located at: $file</p>
";
?>

</body>
</html>