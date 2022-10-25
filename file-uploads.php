<?php
$pageTitle = "File Uploads";
$subTitle = "Validation Form";

//so warnings do not show up when variables are blank. Errors will still show up...remove deprecated warning on hashing the password. 
//error_reporting(E_ALL ^ E_WARNING ^ E_DEPRECATED);

//check if page was refreshed so if email is not populate on refresh then another message is printed
$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

//Default values for variables
$fnameErr = $lnameErr = $emailErr = $passwordErr = $passwordErr2 = $imageErr = NULL;
$username = $fname = $lname = $email = $password = $poem = $password2 = $profilePic = $test = $fileLocation = $text = $passwordErr3 = $pageContent = NULL;
$valid = $loggedin = FALSE;
//logged in triggers if we're getting the form or not
//valid proccesses form fields for error checking
// Function to test the input of the name and email submitted
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Error Checking
if (filter_has_var(INPUT_POST, 'submit')) {
    $valid = TRUE;
    if (empty($_POST["fname"])) {
        $fnameErr = "* Field is required";
        $valid = FALSE;
    } else {
        $fname = test_input($_POST["fname"]);
    }
    if (empty($_POST["lname"])) {
        $lnameErr = "* Field is required";
        $valid = FALSE;
    } else {
        $lname = test_input($_POST["lname"]);
        $username = ucfirst($_POST["fname"]) . ucfirst($_POST["lname"]);
    }
    if (empty($_POST["email"])) {
        $emailErr = "*Email is required";
        $valid = FALSE;
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if ((!filter_var($email, FILTER_VALIDATE_EMAIL)) && (!preg_match("/^[a-zA-Z-' ]*$/", $email))) { //using escape function
            $emailErr = '<span class="error">*Invalid email format.</span>';
            $valid = FALSE;
        }
    }
    if (empty($_POST["password"])) {
        $passwordErr = "* Field is required";
        $valid = FALSE;
    } else {
        $password = ($_POST["password"]);
        echo "Your password is $password";
    }
    if ($_POST["password"] != $_POST["password2"]) {
        $passwordErr3 = "Passwords do not match";
        $valid = FALSE;
    }
    if ($valid) {
        //Handling the profile picture
        $img_size = $_FILES['profilePic']['size']; // getimagesize($_FILES['profilePic']['name']); //get image size

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
                    $pageContent .= $_FILES["profilePic"]["name"] . " already exists. ";
                } else {
                    // move the file to a permanent location
                    move_uploaded_file($_FILES["profilePic"]["tmp_name"], $fileLocation);
                    $pageContent .= "Stored in: $fileLocation<br>";
                    //Saving data to membership.txt
                    $text = "$fname $lname, $email, $password, $username\n";

                    $fp = fopen('membership.txt', 'a'); //opens a file in read write mode
                    if (fwrite($fp, $text)) {
                        echo 'saved';
                    }
                    fclose($fp);
                    $loggedin = True;
                    $poem = file_get_contents("poem.txt");
                }
            }
        } else {
            $pageContent .= " ";
        }
    }
}
if ($loggedin) { //do not have to put == TRUE
//Populating the page content
    $text = "$fname $lname, $email, $password, $username\n";
    $pageContent .= "<h4>Form information</h4> \n Welcome $fname $lname! <br>";
    $pageContent .= "Your email is: $email <br>";
    $pageContent .= "The data saved to the membership.txt file is: $text <br>";
    $pageContent .= "The hashcode for your password is : $password <br>";
    $pageContent .= $profilePic . "<br>";
    $pageContent .= "The file is located: $fileLocation<br>$fileLocation<br>";
    $pageContent .= "<a href= \"$fileLocation\" ><img src= $fileLocation></a><br>"; //need to use the escape function for the picture to show
    $pageContent .= "<u>POEM</u><br>";
    $pageContent .= "$poem<br>";
} else {
    $pageContent .= <<<HERE
<section>
         <form action="file-uploads.php" enctype="multipart/form-data" method="post">
          <fieldset>
            <legend> Enter your information in the form below </legend>
            
            <!--NAME SECTION TEXT FORM-->
            <p><label for="fname">First Name: <input type="text" name="fname" value="$fname" size="20" maxlength="40"></label><span class="error"> $fnameErr</span> </p> 
            <p><label for="lname">Last Name: <input type="text" name="lname" value="$lname" size="20" maxlength="40"></label><span class="error"> $lnameErr</span> </p> 
            
            <!--EMAIL SECTION TEXT FORM-->
            <p><label for="email">Email: <input type="text" name ="email" value="$email"  size="25" maxlength="40"></label> <span class="error">$emailErr</span></p> 

            <!-- PASSWORD SECTION -->
            <p><label for="password">Password:
            <input type="password" name ="password" value="$password" size="21" maxlength="40" > </label>  <!-- pattern checks for password requirement-->
            <span class="error">$passwordErr</span></p> 
            <p><label for = "password2">Reenter your password:
                <input type="password" name ="password2" value="$password2" size="21" maxlength="40" > </label>  
                <span class="error">$passwordErr2</span>  <span class="error">$passwordErr3</span></p>
                
                <p> * Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character. </p>
                
                <!-- Image Selection -->
                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                <label for="profilePic">File to Upload:</label> <span class ="error"> $imageErr </span>
                <input type="file" name="profilePic" id="profilePic" class="form-control">
                </fieldset>
            <input type="submit" name="submit" value="Submit"></p>
            </form>
            </section>
HERE;
}
//print content that posts to the submit button
$pageContent .= "<pre>";
$pageContent .= print_r($_POST, true);
$pageContent .= "</pre>";
//print file content
$pageContent .= "<pre>";
$pageContent .= print_r($_FILES, true);
$pageContent .= "</pre>";
include_once 'template2.php';
