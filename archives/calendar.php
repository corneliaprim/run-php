<?php
$pageTitle = "Calendar";
$subTitle = "Practicing Date and Time Manipulation";

$pageContent = $currDate = $dateAmPm = $dateTime = $dateMonthDay = $holiday = $day = NULL;
$holidayName = $holidayIndex = NULL;
$hour = $minutes = $date = $fileLocation = $seconds = $dateAmPm2 = $time = $month = $day2 = $year = $semester = NULL;

date_default_timezone_set('America/Chicago'); //setting the default timezone my server is set to random locations

if (filter_has_var(INPUT_POST, 'showSelected')) { //this the preferred method that file-upload method for checking post array
    $currDate = date("m/d/Y h:i:sa", $day); //getting the current date
    $dateAmPm = date('a', strtotime($_POST["date"])); //YOU NEED POST UP HERE TO PASS THE FORM DATA
    $dateTime = date("h:i", $time);
    $weekDay = date("l", strtotime($_POST["date"])); //getting the weekday
    // //Determine the proper greeting
    // switch (true) {
    //     case ($dateAmPm == 'am'):
    //         $greeting = "Good morning";
    //         break;
    //     case $dateAmPm == 'pm' && substr($dateTime, 0, 2) >= 12 && substr($dateTime, 0, 1) < 5:
    //         $greeting = "Good afternoon";
    //         break;
    //     default:
    //         $greeting = "Good evening";
    //         break;
    // }
    // //Determine the current season
    // //$dateMonthDay = date('m-d', strtotime($currDate));
    // $dateMonthDay = date('m-d', strtotime($date));
    // switch (true) {
    //     case $dateMonthDay >= '09-20':
    //         $season = "fall";
    //         $fileLocation =   "$season" . ".jpg";
    //         $pageContent .= "$filetype <br>";
    //         break;
    //     case $dateMonthDay >= '12-21':
    //         $season = "winter";
    //         $fileLocation =   "$season" . ".jpg";
    //         $pageContent .= "$filetype <br>";
    //         break;
    //     case $dateMonthDay >= '06-20':
    //         $season = "summer";
    //         $fileLocation =   "$season" . ".jpg";
    //         $pageContent .= "$filetype <br>";
    //         break;
    //     default:
    //         $season = "spring";
    //         $fileLocation =   "$season" . ".jpg";
    //         $pageContent .= "$filetype <br>";
    // }
} else {
    //Getting the currente Date and Time
    $currDate = date("m/d/Y h:i:sa", $day); //getting the current date
    $dateAmPm = date('a', strtotime($currDate)); //getting am or pm only to determine if morning or evening
    $dateTime = date("h:i", $day);
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

//Array of holidays
// $holidays = array(
//     "12-25" => 'Christmas', "07-04" => 'Fourth of July', "05-05" => 'Cinco de Mayo', "10-31" => 'Halloween', "11-24" => 'Thanksgiving',
// );
// $holidayList = null;
// //Creating holiday dropdown
// $holidayList .= '<select id="holiday" name="holiday">'; //creates the box
// $holidayList .= '<option value="">← Holidays →</option>'; //creates the first option in the box
// //puts each element from the array into the dropdown box
// foreach ($holidays as $holidayName) {
//     $holidayList .= "<option value = $holidayName>$holidayName</option>";
// }
// find the number of days between dates
//Edit this work off of the key in the Holiday List Array & $currDate
$holidayDate .= date('z', strtotime("December 25"));
$currDate = date('z');
if ($holidayDate == $currDate) { // holiday is today
    echo "Happy holiday!";
} elseif ($holidayDate > $currDate) { // holiday is after today
    $diff = $holidayDate - $currDate;
    echo "There are " . $diff . " days until holiday.";
} else { // holiday is before today
    $endOfYear .= date('z', strtotime("December 31"));
    $nextYear .= date('z', strtotime("December 25 +1 year"));
    $diff .= ($endOfYear - $currDate) + $nextYear;
    echo "There are " . $diff . " days until next year's holiday.";
}
//Populating the form
$pageContent .= <<<HERE
<section>
         <p class ="error"> * is required</p>
         <form action="calendar.php" enctype="multipart/form-data" method="post">
         <fieldset>
           <legend> Enter your information in the form below </legend>
           <!--Choose Date --> 
           <p>
           <label for="date">Choose the date: <input type="date" value="date">$date</label>          
           <input type="submit" name="showSelected" value="Show Selected">
           <input type="submit" name="showNow" value="Show Now">
           <br>
           <label for="time">Choose the time: <input type="time" value="time">$time</label>
           <input type="submit" name="showSelected" value="Show Selected">
           <input type="submit" name="showNow" value="Show Now">
           </p><br>
           <!--Holiday Section-->
           <label for="holiday">Pick your favorite holiday:<value="holiday">$holidayList</label> <br>
           </fieldset>
           </form>
           </section>
HERE;

$pageContent .= "The current date is: $currDate <br>The date is: $dateMonthDay $weekDay  
<br>The time is: $dateTime $dateAmPm
<br> $greeting <br>The season is: $season
<br>Your favorite holiday is:$holiday<br>
Date you chose is:$date<br>
The season for the date you chose is:<br>";
$pageContent .= "<a href= \"$fileLocation\" ><img src= \"$fileLocation\" width=400 height=300></a><br>";
//print content that posts to the submit button
$pageContent .= "<pre>";
$pageContent .= print_r($_POST, true);
$pageContent .= "</pre>";
//print file content
$pageContent .= "<pre>";
$pageContent .= print_r($_FILES, true);
$pageContent .= "</pre>";
include_once 'template2.php';
