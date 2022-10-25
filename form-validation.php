<?php
$pageTitle = "Form Exercises";
$subTitle = "Validation Form";

//so warnings do not show up when variables are blank. Errors will still show up
error_reporting(E_ALL ^ E_WARNING);
//check if page was refreshed so if email is not populate on refresh then another message is printed
$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

//Default values for variables
$nameErr = $emailErr = $instrumentErr = $animalErr = $activityErr = "*";
$name = $email = $activity = $animalArray = $animalName = $valid = $instrumentName = $instrumentArray = "";

// Creating the arrays
$instrumentArray = array('violin', 'piano', 'guitar', 'saxophone');
$animalArray = array('panda', 'unicorn', 'fox', 'zebra');
$activityArray = array('hiking', 'baseball', 'reading', 'gardening');

// NAME ERROR
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($pageWasRefreshed && empty($_POST["name"])) {
        $nameErr = "*Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }
}

// EMAIL ERROR -- look up later why put in the request and not just post
if (empty($_POST["email"])) {
    $emailErr = "*";
} if($pageWasRefreshed && empty($_POST["email"])){
    $emailErr = "*Email is required";
} else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if ((!filter_var($email, FILTER_VALIDATE_EMAIL)) && (!preg_match("/^[a-zA-Z-' ]*$/", $email))) {
            $emailErr = '<span class="error">*Invalid email format.</span>';
    }
} 
// INSTRUMENT ERROR
if (isset($_POST['submit'])) {
    $valid = true;
    if (empty($_POST['instrument'])) { // set error and re-display the form
        $instrumentErr = '<span class="error">* You must select an instrument.</span>';
        $valid = false;
    } else { // field not empty
        $instrument = $_POST['instrument']; // grab the value of the selected instrument
        if (in_array($instrument, $instrumentArray)) { // check to see which instrument was selected
        }
    }
}
// ANIMAL ERROR
if (isset($_POST['animal'])) {
    $countAnimal = COUNT($_POST['animal']); //count number of items selected
    foreach ($_POST['animal'] as $animalIndex => $animal) {
        $selectedAnimals[] = $animal;
    }
    if ($countAnimal == 2) {
        $animal1 = $selectedAnimals[0];
        $animal2 = $selectedAnimals[1];
    } else { 
        $animalErr = '<span class="error">* You must select ONLY 2 items.</span>';
    }
}
// ACTIVITY ERROR
if (isset($_POST['activity'])) {
    $activity = $_POST['activity'];
} if ($pageWasRefreshed && empty($_POST['activity'])) {
    $activityErr .= '<p class="error">You forgot to select an activity!</p>';
}

// Function to test the input of the name and email submitted
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//Creating the radio buttons

foreach ($instrumentArray as $instrumentName) { // build the radio button list
    $instrumentList .= "<input type= 'radio' name= 'instrument' id= $instrumentName value= $instrumentName>";
    $instrumentList .= "<label for=$instrumentName>$instrumentName</label> \n";
}
//Creating checkboxes
foreach ($animalArray as $animalIndex => $animalName) {
    $animalList .= "<input type='checkbox' name= 'animal[$animalIndex]' id=$animalIndex value= $animalName>";
    $animalList .= "<label for= $animalIndex>$animalName</label> \n";
}
//Creating activity dropdown
$activityList .= '<select id="activity" name="activity">'; //creates the box
$activityList .= '<option value="">← Select an Activity →</option>'; //creates the first option in the box
//puts each element from the array into the dropdown box
foreach ($activityArray as $activityIndex => $activityName){
    $activityList .= "<option value = $activityName> $activityName </option>";
}

//Populating the page content
$pageContent = <<<HERE
<section>
         <p class ="error"> * is required</p>
         <form action="form-validation.php" method="post">
          <fieldset>
            <legend> Enter your information in the form below </legend>
            <form method="post" action="form-validation.php">
            
            <!--NAME SECTION TEXT FORM-->
            <p><label>Name: <input type="text" name="name" value="$name" size="20" maxlength="40"></label><span class="error"> $nameErr</span> </p> <!-- nameErr in this place is sticky and returns the error message -->
            
            <!--EMAIL SECTION TEXT FORM-->
            <p><label>Email: <input type="email" name ="email" value="$email"></label> <span class="error">$emailErr</span></p> 
           
            <!--INSTRUMENT SECTION RADIO BUTTONS-->
            <label for ="instrument">
            <p>Pick your favorite instrument. Select 1: <span class="error">$instrumentErr</span> </p> </label>
            $instrumentList

            <!--ANIMAL SECTION-->
            <label for ="animal">
            <p>Pick your favorite animals. Select 2: <span class="error">$animalErr</span> </p> </label>
            $animalList

            <!--ACTIVITY SECTION-->
            <p><label for ="activity">Pick your favorite activity:<span class="error">$activityErr</span></p></label>
            $activityList

            </fieldset>
            <input type="submit" name="submit" value="Submit"></p>
            </form>
            </section>

HERE;

//supress the warning from php for the value being blank, but displays error messages.
error_reporting(E_ALL ^ E_WARNING);

//Display user input
if (isset($_POST['submit'])) {
    $pageContent .= "<h3>Welcome $name!</h3> Your email address is: $email<br>";
    $pageContent .= "The instrument you selected is a: $instrument<br>";
    $pageContent .= "Your favorite animals are: $animal1 and $animal2<br>";
    $pageContent .= "Your favorite activity is: $activity";
}
include_once 'template2.php';
