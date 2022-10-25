<?php
$pageTitle = "Calendar";
$subTitle = "Practicing Date and Time Manipulation";

$pageContent =$dateFormat = $currDate = $filetype = $dateAmPm = $dateTime = $dateMonthDay = $holidayGreeting = $date = $time = $holidayDate = NULL;
$valid = $loggedin = FALSE;
date_default_timezone_set('America/Chicago'); //setting the default timezone my server is set to random locations
$nextYear = $diff = 0;
if (filter_has_var(INPUT_POST, 'showSelected')) {
    $valid = TRUE;
    $currDate = date("m/d/Y h:i:sa", strtotime($_POST["date"])); //getting the current date
    $dateAmPm = date('a', strtotime($_POST["date"])); //YOU NEED POST UP HERE TO PASS THE FORM DATA
    $dateTime = date("h:i", $time);
    $weekDay = date("l", strtotime($_POST["date"])); //getting the weekday
}
else {
    $valid = TRUE;
    //Getting the current Date and Time
    $currDate = date("m/d/Y h:i:sa"); //getting the current date
    $dateAmPm = date('a', strtotime($currDate)); //getting am or pm only to determine if morning or evening
    $dateTime = date("h:i");
    $weekDay = date("l", strtotime($currDate)); //getting the weekday
} 
//Determine the proper greeting
switch (true) {
    case ($dateAmPm == 'am'):
        $greeting = "Good morning";
        $fileLocation3 =   "morning.jpg";
        $pageContent .= "<a href= \"$fileLocation3\" ><img src= \"$fileLocation3\"></a>";
        break;
    case ($dateAmPm = 'pm' && substr($dateTime, 0, 2) >= 12 && substr($dateTime, 0, 1) < 5):
        $greeting = "Good afternoon";
        $fileLocation3 =   "afternoon.jpg";
        $pageContent .= "<a href= \"$fileLocation3\" ><img src= \"$fileLocation3\"></a>";
        break;
    default:
        $greeting = "Good evening";
        $fileLocation3 =   "night.jpg";
        $pageContent .= "<a href= \"$fileLocation3\" ><img src= \"$fileLocation3\"></a>";
        break;
}
//Determine the current season
$dateMonthDay = date('m', strtotime($currDate));
switch (true) {
    case $dateMonthDay > 8:
        $season = "fall";
        $fileLocation =   "$season" . ".jpg";
        $pageContent .= "$filetype <br>";
        break;
    case $dateMonthDay > 5:
        $season = "summer";
        $fileLocation =   "$season" . ".jpg";
        $pageContent .= "$filetype <br>";
        break;
    default:
        $season = "spring";
        $fileLocation =   "$season" . ".jpg";
        $pageContent .= "$filetype <br>";
        break;
}

$holidayDate .= date('z', strtotime("December 25"));
$date2 = date('z',strtotime($currDate));
if ($holidayDate == $date2) { // holiday is today
    $holidayGreeting .= "Happy holiday!";
    $fileLocation2 =   "santa.jpg";
    $pageContent .= "<a href= \"$fileLocation2\" ><img src= \"$fileLocation2\"></a>";
} elseif ($holidayDate > $date2) { // holiday is after today
    $diff = $holidayDate - $date2;
    $holidayGreeting .=  "There are " . $diff . " days until Christmas.";
} else { // holiday is before today
    $endOfYear .= date('z', strtotime("December 31"));
    $nextYear .= date('z', strtotime("December 25 +1 year"));
    $diff .= ($endOfYear - $date2) + $nextYear;
}

//else evening picture
$dateFormat .= date("F j, Y", strtotime($currDate));
$pageContent .= "The current date selected is: $dateFormat <br>The day is: $weekDay  
<br>The time is: $dateTime $dateAmPm
<br> $greeting <br>The semester is: $season
<br>$holidayGreeting<br>";
$pageContent .= "<a href= \"$fileLocation\" ><img src= \"$fileLocation\" width=400 height=300></a><br>";

    //Populating the form
    $pageContent .= <<<HERE
<section>
         <form action="calendar.php" enctype="multipart/form-data" method="post">
         <fieldset>
           <legend> Enter your information in the form below </legend>
           <!--Choose Date --> 
           <p>
           <label for="date">Choose the date: <input type="date" value="$date" name="date"></label>          
           <label for="time">Choose the time: <input type="time" value="$time"  name="time"></label>
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
