<?php
$pageTitle = "Album Emporium";
$subTitle = "Validation Form"; 

$leftSidebar = NULL;
$instrumentErr = "";
$valid = $instrumentName= $instrumentArray = "";

//Creating the instrumentArray$instrumentArray array
$instrumentArray = array('violin', 'piano', 'guitar', 'saxophone');

// INSTRUMENT ERROR
// check to see if the form has been submitted if so process the data.
if (isset($_POST['submit'])) {
    $valid = true;
    if (empty($_POST['instrument'])) { // set error and re-display the form
        $instrumentErr = '<span class="text-danger">* You must select an instrument.</span>';
        $valid = false;
    }
    else { // field not empty
        $instrument = $_POST['instrument']; // grab the value of the selected instrument
        if (in_array($instrument, $instrumentArray)) { // check to see which instrument was selected
            $instrumentChecked[$instrument] = 'checked'; // set for sticky form
        }
    }
}

if ($valid){ // display the form results on the page
	// if you wanted to redirect to a new page, you would do that here
	$pageContent = <<<HERE
	<h2>Welcome!</h2>
	<p>Your favorite musical instrument is $instrument.</p>
HERE;

}
else { // build the form for display - include warnings and sticky fields

    foreach ($instrumentArray as $instrumentName) { // build the radio button list
        $instrumentList .= <<<HERE
		<input type="radio" name="instrument" id="$instrumentName" value="$instrumentName">
		<label for="$instrumentName">$instrumentName</label> \n
HERE;
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$pageContent = <<<HERE
<section>
         <form action="instrument-validation.php" method="post">
          <fieldset>
            <legend> Enter your information in the form below </legend>
            <form method="post" action="instrument-validation.php">
           
            <!INSTRUMENT SECTION-->
            <label for ="instrument">
            <p>Pick your favorite instrument Select 1: <span class="error">$instrumentErr</span> </p> </label>
            $instrumentList

            </select>
            </fieldset>
            <input type="submit" name="submit" value="Submit"></p>
            </form>
            </section>

HERE;
//supress the warning from php for the value being blank. 
error_reporting(E_ALL ^ E_WARNING); 
//must check all data was submitted or you'll get an error message regarding an empty variable on the page
// assemble the html output
if(isset($_POST['submit'])){
	$pageContent .= "<pre>";
    $pageContent .= "The instrument you selected is: $instrument.";
	$pageContent .= "</pre>";
}
include_once 'template2.php';

