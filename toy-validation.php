<?php
$pageTitle = "Album Emporium";
$subTitle = "Validation Form"; 

$leftSidebar = NULL;
$instrument = NULL; // sticky form default value
$instrumentError = NULL; // supress error messages
$instrumentList = NULL; // for the radio button form list
$valid = false; // data validation flag

// create an array of instruments
$instrumentArray = array('violin', 'piano', 'guitar', 'saxophone');
foreach ($instrumentArray as $instrumentName){
	$instrumentChecked[$instrumentName] = NULL;
}

// check to see if the form has been submitted if so process the data.
if (isset($_POST['submit'])) {
	$valid = true;
	if (empty($_POST['instrument'])){ // set error and re-display the form
		$instrumentErr = '<span class="text-danger">You must select an instrument.</span>';
		$valid = false;
	} else { // field not empty
		$instrument = $_POST['instrument']; // grab the value of the selected instrument
		if (in_array($instrument, $instrumentArray)) { // check to see which instrument was selected
			$instrumentChecked[$instrument] = 'checked'; // set for sticky form
		}
	}
}


	foreach ($instrumentArray as $instrumentName) { // build the radio button list
		$instrumentList .= <<<HERE
		<input type="radio" name="instrument" id="$instrumentName" value="$instrumentName" $instrumentChecked[$instrumentName]>
		<label for="$instrumentName">$instrumentName</label> \n
HERE;


	$pageContent = <<<HERE
	<fieldset>
	<legend> Sample Form </legend>
	<form method="post" action="toy-validation.php">
		<div class="form-group"> 
			<label for="instrument">Favorite instrument ~ Pick 1 $instrumentError</label><br>
			$instrumentList
		</div>
		<div class="form-group">
			<button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
		</div>
	</form>
	</fieldset>
HERE;

}
// assemble the html output
if(isset($_POST['submit'])){
	$pageContent .= "<pre>";
    $pageContent .= "The instrument you selected is: ";
	$pageContent .= print_r($_POST['instrument'], TRUE);
	$pageContent .= "</pre>";
}
include_once 'template2.php';
