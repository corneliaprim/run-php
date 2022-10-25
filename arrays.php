<?php
//initializing the page content
$pageContent = NULL;
//associative arrays
$albums = array("A Hard Day's Night" => 10, "Help!" => 5, "Rubber Soul" => 11, "Abbey Road" => 7);
//for each loop with associative array
foreach ($albums as $album => $rating) {
    $pageContent .= "<p>$album rating is $rating.</p>"; //do not use a br use a list or p or 
}

//https://www.w3schools.com/tags/tryit.asp?filename=tryhtml_select //explains what selecting an option is
//asort - sort associative arrays in descending order, according to the value
asort($albums);
$albumValueSortList = "<h3>Album Value Sort List</h3>\n"; //header for the array
$albumsValueSortList .= "<ul id = 'sortList'>";
foreach ($albums as $album => $rating) {
    $albumsList .= "<li> $album has a rating of $rating</li>\n"; 
}
$albumsList .= "</ul>\n";

$pageContent .= $albumsList;

// creating the multi-dimensional array
$bands = array(
    "The Beatles" => array("A Hard Day's Night" => "1964", "Help!" => "1965", "Rubber Soul" => "1965", "Abbey Road" => "1969"),
    "LedZepplin" => array("Led Zepplin IV" => "1971"),
    "Rolling Stones" => array("Let It Bleed" => "1969", "Sticky Fingers" => "1971"),
    "The Who" => array("Tommy" => "1969", "Quadrophenia" => "1973", "The Who by Numbers" => "1975")
);
// . is concat
// Access the release date for Tommy by The Who and assign it to a variable called $pageContent.
$pageContent .= "<h4>Tommy was released</h4>\n"; //header
$pageContent .= $bands["The Who"]["Tommy"];

// Loop through the array, create a list of each artist and album title and concatenate it to the $pageContent variable.
$pageContent .= "<h3>Multi-dimensional Array of Bands and Albums</h3>"; //header for the array
$pageContent .= "<ul>\n"; // list with br
foreach ($bands as $subArray => $band) {
    $pageContent .= '<label="' . $subArray . '">' . "\n"; // group label
    foreach ($band as $name => $type) {
        $pageContent .="<li>$name</li>\n";
    }
}
$pageContent .= '</ul>';
 

// Loop through the array, create a new list of each album and release date for The Who and concatenate it to the $pageContent variable.
// this needs to be moved to page content
foreach ($bands as $band => $albums) {
    $pageContent .= "<h3>$band</h3>\n";
    foreach ($albums as $album => $releaseDate) {
        $pageContent .= "<p>$album was release on $releaseDate.</p> \n"; 
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Learning Arrays</title>
    <h2>Learning Arrays</h2>

            <?php
                echo $pageContent; // displays all php content
            ?>
</head>

<body>