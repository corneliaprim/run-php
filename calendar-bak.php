<?php
$pageTitle = "Calendar";
$subTitle = "Practicing Date and Time Manipulation";

$pageContent = $currDate = $filetype = $dateAmPm = $dateTime = $dateMonthDay = $holidayGreeting = $date = $time = $holidayDate = NULL;
$valid = $loggedin = FALSE;
date_default_timezone_set('America/Chicago'); //setting the default timezone my server is set to random locations

if (filter_has_var(INPUT_POST, 'showSelected')) {
    $valid = TRUE;
    $currDate = date("m/d/Y h:i:sa", strtotime($_POST["date"])); //getting the current date
    $date = date("Y-m-j", strtotime($_POST["date"]));
    $dateAmPm = date('a', strtotime($_POST["time"])); //YOU NEED POST UP HERE TO PASS THE FORM DATA
    $dateTime = date("h:i", strtotime($_POST["date"]));
    $weekDay = date("l", strtotime($_POST["date"])); //getting the weekday
}
else {
    $valid = TRUE;
    //Getting the current Date and Time
    $currDate = date("m/d/Y h:i:sa"); //getting the current date
    $date = date("Y-m-j");
    $dateAmPm = date('a', strtotime($currDate)); //getting am or pm only to determine if morning or evening
    $dateTime = date("h:i");
    $weekDay = date("l", strtotime($currDate)); //getting the weekday
} 
//Determine the proper greeting
switch (true) {
    case ($dateAmPm == 'am'):
        $greeting = "Good morning";
        break;
    case $dateAmPm == 'pm' && substr($dateTime, 0, 2) >= 12 && substr($dateTime, 0, 1) < 5:
        $greeting = "Good afternoon";
        break;
    default:
        $greeting = "Good evening";
        break;
}
//Determine the current season
$dateMonthDay = date('m-d', strtotime($currDate));
switch (true) {
    case $dateMonthDay >= '09-20':
        $season = "fall";
        $fileLocation =   "$season" . ".jpg";
        $pageContent .= "$filetype <br>";
        break;
    case $dateMonthDay >= '12-21':
        $season = "winter";
        $fileLocation =   "$season" . ".jpg";
        $pageContent .= "$filetype <br>";
        break;
    case $dateMonthDay >= '06-20':
        $season = "summer";
        $fileLocation =   "$season" . ".jpg";
        $pageContent .= "$filetype <br>";
        break;
    default:
        $season = "spring";
        $fileLocation =   "$season" . ".jpg";
        $pageContent .= "$filetype <br>";
}

$holidayDate .= date('z', strtotime("December 25"));
$date2 = $currDate;
$date2 = date('z');
if ($holidayDate == $date2) { // holiday is today
    $holidayGreeting .= "Happy holiday!";
} elseif ($holidayDate > $date2) { // holiday is after today
    $diff = $holidayDate - $date2;
    $holidayGreeting .=  "There are " . $diff . " days until Christmas.";
} else { // holiday is before today
    $endOfYear .= date('z', strtotime("December 31"));
    $nextYear .= date('z', strtotime("December 25 +1 year"));
    $diff .= ($endOfYear - $date2) + $nextYear;
}


$pageContent .= "The current date selected is: $currDate <br>The day is: $weekDay  
<br>The time is: $dateTime $dateAmPm
<br> $greeting <br>The season is: $season
<br>$holidayGreeting<br>";
$pageContent .= "<a href= \"$fileLocation\" ><img src= \"$fileLocation\" width=400 height=300></a><br>";

    //Populating the form
    $pageContent .= <<<HERE
<section>
         <form action="calendar1.php" enctype="multipart/form-data" method="post">
         <fieldset>
           <legend> Enter your information in the form below </legend>
           <!--Choose Date --> 
           <p>
           <label for="date">Choose the date: <input type="date" value="$date" name="date"> </label>          
           <label for="time">Choose the time: <input type="time" value="$dateTime"  name="time"> </label>
           <input type="submit" name="showSelected" value="Show Selected">
           <input type="submit" name="reset" value="Show Now"> <!-- name ="reset" resets the form to default values-->
           </p><br>
           </fieldset>
           </form>
           </section>
HERE;

//print content that posts to the submit button
$pageContent .= "<pre>";
$pageContent .= print_r($_POST, true);
$pageContent .= "</pre>";
//print file content
$pageContent .= "<pre>";
$pageContent .= print_r($_FILES, true);
$pageContent .= "</pre>";
include_once 'template2.php';
