<?php
$pageTitle = "Album Emporium";
$subTitle = "Home"; //figure out why this is not showing up later.
$number = 2;
include_once 'header.php';

$pageContent = <<<HERE
<section>
      <p>Welcome to the Album Emporium. It is our desire to provide original, rare content to our exclusive customer base. You will find that each album was carefully curated and perserved with the original signatures of the artists'. You will not find a collection quite like this. Every CD comes with a certificate of authenticity verifying the artists signature and it's originality. We invite you to peruse our site and see what wonderful items you may find for your special collection.</p>
      <p> Do keep in mind that song downloads do not include original signatures or certificates of authenticity, but we know you already knew that!</p>
    
      <p><b>UPDATES:</b> As this website has progressed more projects have been added. To make it easier for me to navigate and find everything I am needing, I am updating this section to include a list of the projects above with a short description.</p>
     <ul>
     <li><a href ="invoice.php">Order Form</a></li>
     <ul><li>In the order form, I practiced sorting a list of values placed in an associative array, creating an order form and then outputting an invoice to the user. The invoice uses a function to calculate total value of the purchase order utilizing a for loop. The invoice also populates the user name and order information. There is also some error checking, radio buttons and a dropdown list.</li></ul>
     <li><a href="form-validation.php">Form Validation</a></li>
     <ul><li>This activity expands on the previous form.  This time a user may select more than one value and the program is to check that the user selects the correct number of values. There is still error checking. The previous assignment had a separate file to process the error checking and posting the user information. This assignment processes it all in one file. I'm thinking this may lead to security issues and I can see why someone may want to separate form creation and form handling into two assignments. </li></ul>
     <li><a href="file-uploads.php">File-Uploads</a></li>
     <ul><li>This assignment includes another form. This time the user is asked to create a password and upload a file to the server. The data is then processed with error checking. The user's name, email, password and user name (create via parameters set by the professor) are stored in a txt file. The program outputs the image that was uploaded, details about the image, details about the user information stored in the text file and prints out data from another txt file.</li></ul>
     <ul><li>I have <b>more than one version</b> of this in the archives. Some pieces of the old code are more complicated and may be useful later for error checking.</li></ul>
     <li><a href="calendar.php">Calendar</a></li>
     <ul><li>This program asks the user to either select a date and time or process the current date and time. When a user selects this information, the output changes according to the time of day (morning, noon and night), or the semester season (fall, summer and spring). This program also calculates the number of days until Christmas for the user based on user choices.</li></ul>
     <li><a href="register.php">User Registration</a></li>
     <ul><li>This program asks the user to create an account, validates the user input and then adds user data to a database. Finally, the program outputs the last record added to the database.</li></ul>
    
      </section>

HERE;
    echo $pageContent;
    include_once 'rightcontainer.php';
    include_once 'footer.php';
