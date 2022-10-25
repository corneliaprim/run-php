<?php
$pageTitle = "File Uploads";
$subTitle = "Validation Form";

//so warnings do not show up when variables are blank. Errors will still show up...remove deprecated warning on hashing the password. 
//error_reporting(E_ALL ^ E_WARNING ^ E_DEPRECATED);

//check if page was refreshed so if email is not populate on refresh then another message is printed
$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

//Default values for variables
$fnameErr = $lnameErr = $emailErr = $passwordErr = $passwordErr2= $imageErr = "*";
$username = $fname = $lname = $email =$password = $password2 = $profilePic = $test = "";

//Error Checking
// NAME ERROR
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($pageWasRefreshed && empty($_POST["fname"]) || empty($_POST["lname"]) ) {
        $fnameErr = "* Field is required";
    } else {
        $fname = test_input($_POST["fname"]);
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($pageWasRefreshed && empty($_POST["lname"])) {
        $lnameErr = "* Field is required";
    } else {
        $lname = test_input($_POST["lname"]);
        $username = ucfirst($_POST["fname"]) . ucfirst($_POST["lname"]);
    }
}

// EMAIL ERROR 
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

//PASSWORD CHECKING (FIGURE OUT HOW TO DO BOTH AT THE SAME TIME LATER)
// FIGURE OUT HOW TO USE AN ARRAY TO CHECK ALL REQUIRED VARIABLES FOR BEING EMPTY LATER.
if (empty($_POST["password"])) {
    $passwordErr = "*";
    if ($pageWasRefreshed && empty($_POST["password"])) {
        $passwordErr = "* Field is required";
     } else {
         $password = ($_POST["password"]);
         $hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
        }
}
if (empty($_POST["password2"])) {
    $passwordErr = "*";
    if ($pageWasRefreshed && empty($_POST["password2"])) {
         $passwordErr2 = "* Field is required";
        } else {
            $password2 = ($_POST["password2"]);
        }
}
if($_POST["password"] != $_POST["password2"]){
    $passwordErr3 = "Passwords do not match";
}
// Function to test the input of the name and email submitted
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Uploading a profile pic and checking that it is an image


// $hash is what you would store in your database 
$checked = password_verify($_POST['password'], $hash);
if ($checked) {
    echo 'password correct';
} else {
    echo 'wrong credentials';
}

//Creating information that gets stored in the membership.txt
//$text =  $username . "," . $hash . "," . $email . "\n";
$text = $username;



//Populating the page content
$pageContent = <<<HERE
<section>
         <p class ="error"> * is required</p>
         <form action="file-uploads.php" enctype="multipart/form-data" method="post">
          <fieldset>
            <legend> Enter your information in the form below </legend>
            
            <!--NAME SECTION TEXT FORM-->
            <p><label for="fname">First Name: <input type="text" name="fname" value="$fname" size="20" maxlength="40"></label><span class="error"> $fnameErr</span> </p> 
            <p><label for="lname">Last Name: <input type="text" name="lname" value="$lname" size="20" maxlength="40"></label><span class="error"> $lnameErr</span> </p> 
            
            <!--EMAIL SECTION TEXT FORM-->
            <p><label for="email">Email: <input type="email" name ="email" value="$email"  size="25" maxlength="40"></label> <span class="error">$emailErr</span></p> 

            <!-- PASSWORD SECTION -->
            <p><label for="password">Password:
            <input type="password" name ="password" value="$password" size="21" maxlength="40" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"> </label>  <!-- pattern checks for password requirement-->
            <span class="error">$passwordErr</span></p> 
            <p><label for = "password2">Reenter your password:
                <input type="password" name ="password2" value="$password2" size="21" maxlength="40" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"> </label>  
                <span class="error">$passwordErr2</span>  <span class="error">$passwordErr3</span></p>
                
                <p class="error"> * Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character. </p>
                
                <!-- Image Selection -->
                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                <label for="profilePic">File to Upload:</label> <span class ="error"> $imageErr </span>
                <input type="file" name="profilePic" id="profilePic" class="form-control">
                </fieldset>
            <input type="submit" name="submit" value="Submit"></p>
            </form>
            </section>
HERE;
if (isset($_POST['submit'])) {
//Handling the profile picture
$img_size = getimagesize($_FILES['profilePic']['name']); //get image size

$pageContent .= "<h4>Information about the profile picture:</h4>\n";

if ($img_size == true) { //check an image then 
	if ($_FILES["profilePic"]["error"] > 0) { //if not an image then print error
		$pageContent .=  "Return Code: " . $_FILES["profilePic"]["error"] . "<br>";
	} else { //otherwise print image information
        $filetype = pathinfo($_FILES['profilePic']['name'], PATHINFO_EXTENSION);
		$pageContent .=  "Upload: " . $_FILES["profilePic"]["name"] . "<br>";
		$pageContent .=  "Type: " . $_FILES["profilePic"]["type"] . "<br>";
		$pageContent .=  "Size: " . ($_FILES["profilePic"]["size"] / 1024) . " Kb<br>";
		$pageContent .=  "Temp file: " . $_FILES["profilePic"]["tmp_name"] . "<br>";
        $pageContent .= "$filetype <br>";
		
		// if the file already exists in the upload directory, give an error
		if (file_exists("uploads/" . $_FILES["profilePic"]["name"])) {
			$pageContent .=  $_FILES["profilePic"]["name"] . " already exists. ";
		} else {
			// move the file to a permanent location
			move_uploaded_file($_FILES["profilePic"]["tmp_name"],"uploads/" . $_FILES["profilePic"]["name"]);
			$fileLocation .=   "uploads/" . $_FILES["profilePic"]["name"];
            $pageContent .=  "Stored in: " . "uploads/" . $_FILES["profilePic"]["name"]."<br>";
		}
	} 
    if ($pageWasRefreshed){// if page was refreshed and there was an error display
        $pageContent .=  "Invalid file\n";
    }
} else {
    $pageContent .= " ";
}

    $pageContent .= "<h4>Form information</h4> \n Welcome $fname $lname! <br>";
    $pageContent .= "Your email is: $email <br>";
    $pageContent .= "The data saved to the membership.txt file is: $text <br>";
    $pageContent .= "The hashcode for your password is : $hash <br>";
    $pageContent .= $profilePic."<br>";
    $pageContent .= "The file is located: $fileLocation<br>$img_size<br>";
    $pageContent .= "<a href= $fileLocation ><img src= $fileLocation</a><br>";

//Saving data to membership.txt

$fp = fopen('membership.txt', 'a+'); //opens a file in read write mode

if(fwrite($fp, $text))  {
    echo 'saved';
}
fclose ($fp);    
}

include_once 'template2.php';
