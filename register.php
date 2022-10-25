<?php
$pageTitle = "MySql Registration";
$subTitle = "Connecting to a Database & Retrieving the Last Entry";
$fname = $lname = $email = $usrname = $password = $password2 = $profilePic = NULL;
$errors = []; 
$valid = $loggedin = FALSE;
/* Convert html entities, Check for missing data, Check email with regular expression, Compare password match, Create username form first and last names, Convert names to first letter uppercase, Concatenate first and last names, Validate the image file, Upload the image, Extract data from post array, Save record to membership table */
/* All form fields must be sticky, All form fields must have error messaging */
/* Pages includes config.php file, Display contents using template.php, Pages utilizes Bootstrap framework */


//Check form was submitted
if (filter_has_var(INPUT_POST,  'submit')) { //if data submitted then...
    $valid = TRUE;
    //Validate user data
    if (empty($_POST["fname"])) {  // If Firstname is empty then 
        $errors[] = "*First name Field is required"; //print error message
        $valid = FALSE; //valid is false and stop processing data
    } else {
        $fname = $_POST["fname"]; //else clean firstname and post it
    }
    if (empty($_POST["lname"])) { //Last Name error checking
        $errors[]  = "* Last name is required";
        $valid = FALSE;
    } else {
        $lname = $_POST["lname"];
        $username = ucfirst($_POST["fname"]) . ucfirst($_POST["lname"]); //Create the user name
    }
    if (empty($_POST["email"])) { //if Email empty
        $errors[] = "*Email is required"; // then error message
        $valid = FALSE;
    } else {
        $email = $_POST["email"]; //else post the email
    }
    if (empty($_POST["password"])) { //Password
        $errors[]  = "* Password is required";
        $valid = FALSE;
    } else {
        $password = $_POST["password"];
        $pageContent .=  "Your password is $password";
    }
    if ($_POST["password"] != $_POST["password2"]) { //Check passwords match
        $errors[]  = "Passwords do not match";
        $valid = FALSE;
    }
    //Print data entered
$text = "$fname $lname, $email, $password, $username\n";
$pageContent .= "$text<br>";
}

//Check database connection
if($valid){
require('config.php'); //connect to db & not following best practice for now wh/ is to put this file one level up
$insert = "INSERT INTO users(fname,lname,email,password,username, registration_date)
    VALUES ('$fname','$lname','$email','$password','$usrname', NOW())";
        $run = @mysqli_query($conn, $insert);
        if($run){
            $pageContent .= "<h2>Thank you!</h2><p> You are now registered.</p>\n";
            //Query the database and fetch the last record
            $fetchLast = "SELECT top 1 * from users ORDER BY registration_date desc";
            $pageContent .= "The last record entered was: <br>$fetchLast<br>";
        }else{
            $pageContent .= "Something went wrong.";
            //debugging message to determine the error
            $pageContent .= '<p>' . mysqli_error($conn) . '<br><br>Query: ' . $insert . '</p>';
        }
        //Close db
        mysqli_close($conn);
        exit();
} else {

}

/*
if ($valid) {//Handling the profile picture
    $img_size = $_FILES['profilePic']['size']; 
    //Print image information
    $pageContent .= "<h4>Information about the profile picture:</h4>\n";
    if ($img_size == true) { //check an image then 
        if ($_FILES["profilePic"]["error"] > 0) { //if not an image then print error
            $pageContent .= "Return Code: " . $_FILES["profilePic"]["error"] . "<br>";
        } else { //otherwise print image information
            $filetype = pathinfo($_FILES['profilePic']['name'], PATHINFO_EXTENSION);
            $pageContent .= "Upload: " . $_FILES["profilePic"]["name"] . "<br>";
            $pageContent .= "Type: " . $_FILES["profilePic"]["type"] . "<br>";
            $pageContent .= "Size: " . ($_FILES["profilePic"]["size"] / 1024) . " Kb<br>";
            $pageContent .= "Temp file: " . $_FILES["profilePic"]["tmp_name"] . "<br>";
            $pageContent .= "$filetype <br>";
            $fileLocation = "uploads/" . $_FILES["profilePic"]["name"];
            // if the file already exists in the upload directory, give an error
            if (file_exists($fileLocation)) {
                $errors[] = $_FILES["profilePic"]["name"] . " already exists. ";
            } else {
                // move the file to a permanent location
                move_uploaded_file($_FILES["profilePic"]["tmp_name"], $fileLocation);
                $pageContent .= "Stored in: $fileLocation<br>";
                $loggedin = True;
            }
        }
    } else {
        $valid = FALSE;
        $pageContent .= "The following errors occurred.\n";
        foreach ($error as $msg) {
            $pageContent .= " - $msg<br>\n";
        }
    }
}*/

if ($loggedin) { //do not have to put == TRUE
    //Populating the Output page content
    $text = "$fname $lname, $email, $password, $username\n";
    $pageContent .= "<h4>Form information</h4> \n Welcome $fname $lname! <br>";
    $pageContent .= "Your email is: $email <br>";
    $pageContent .= "The data saved to the membership.txt file is: $text <br>";
    $pageContent .= "The hashcode for your password is : $password <br>";
    $pageContent .= $profilePic . "<br>";
    $pageContent .= "The file is located: $fileLocation<br>$fileLocation<br>";
    $pageContent .= "<a href= \"$fileLocation\" ><img src= $fileLocation></a><br>"; //need to use the escape function for the picture to show
} else {
    $pageContent .= "The following errors occurred.\n";
    foreach ($errors as $msg) {
        $pageContent .= " - $msg<br>\n";
    }
}
//The Form
$pageContent .= <<<HERE
<section>
         <form action="register.php" enctype="multipart/form-data" method="post">
         <fieldset>
           <legend> Enter your information in the form below </legend>

           <!--NAME SECTION TEXT FORM-->
           <p><label for="fname">First Name: <input type="text" name="fname" value="$fname" size="20" maxlength="40"> </p> 
           <p><label for="lname">Last Name: <input type="text" name="lname" value="$lname" size="20" maxlength="40"></label> </p> 
           
           <!--EMAIL SECTION TEXT FORM-->
           <p><label for="email">Email: <input type="text" name ="email" value="$email"  size="25" maxlength="40"></label> </p> 

           <!-- PASSWORD SECTION -->
           <p><label for="password">Password:
           <input type="password" name ="password" value="$password" size="21" maxlength="40" > </label></p> 
           <p><label for = "password2">Reenter your password: 
            <input type="password" name ="password2" value="$password2" size="21" maxlength="40" > </label></p>
            
           <!-- Image Selection -->
           <!--<input type="hidden" name="MAX_FILE_SIZE" value="100000">
           <label for="profilePic">File to Upload:</label>
           <input type="file" name="profilePic" id="profilePic" class="form-control"> -->

           </fieldset>
           <input type="submit" name="submit" value="Submit"></p>
           </form>
           </section>
HERE;

//print content that posts to the submit button
$pageContent .= "<pre>";
$pageContent .= print_r($_POST,  true);
$pageContent .= "</pre>";
//print file contents
$pageContent .= "<pre>";
$pageContent .= print_r($_FILES,  true);
$pageContent .= "</pre>";
include_once 'template2.php';
include_once 'config.php';
include_once 'functions.php';
?>
