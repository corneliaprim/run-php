
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo $title; ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    html,
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: "Roboto", sans-serif;
    }

    .w3-sidebar {
      z-index: 3;
      width: 250px;
      top: 43px;
      bottom: 0;
      height: inherit;
      padding-left: 20px;
      padding-top: 20px;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <div class="w3-top">
    <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
      <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
      <a href="#" class="w3-bar-item w3-button w3-theme-l1">Logo</a>
      <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
      <a href="home.php" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Home</a>
      <a href="invoice.php" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Order Form</a>
      <a href="form-validation.php" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Form-Validation</a>
      <a href="file-uploads.php" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">File-Uploads</a>
      <a href="calendar.php" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Calendar</a>
      <a href="register.php" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">User Registration</a>
    </div>
  </div>

  <!-- Sidebar -->
  <nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
      <i class="fa fa-remove"></i>
    </a>
    <h4 class="w3-bar-item"><b>Prices</b></h4>
    <?php echo $leftSidebar;?>
  </nav>

  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

  <!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
  <div class="w3-main" style="margin-left:250px">

    <div class="w3-row w3-padding-64">
      <div class="w3-twothird w3-container">
        <h1><?php echo $pageTitle; ?></h1>
        <h3><?php echo $subTitle; ?></h3>
        <!-- Enter Content here -->
        <?php echo $pageContent; ?>

      </div>

      <div class="w3-third w3-container w3-center">
        <p>
          <figure class="w3-border w3-padding-large w3-padding-32 w3-center">
            <a href="https://2learnweb.brookhavencollege.edu/RobinWilliams/phpcourse/php/beatles.jpg" target="https://2learnweb.brookhavencollege.edu/RobinWilliams/phpcourse/php/beatles.jpg"><img src="https://2learnweb.brookhavencollege.edu/RobinWilliams/phpcourse/php/beatles.jpg" alt="The Beatles" height=100% width=100%></a>
   
              <figcaption>The Beatles</figcaption>
    
            </figure>
        </p>
        <p>
          <figure class="w3-border w3-padding-large w3-padding-32 w3-center">
            <a href="https://2learnweb.brookhavencollege.edu/RobinWilliams/phpcourse/php/thewho.jpg" target="https://2learnweb.brookhavencollege.edu/RobinWilliams/phpcourse/php/thewho.jpg"><img src="https://2learnweb.brookhavencollege.edu/RobinWilliams/phpcourse/php/thewho.jpg" alt="The Who" height=100% width=100%></a>
   
              <figcaption>The Who</figcaption>
       
            </figure>
        </p>
        </p>
      </div>
    </div>

    <!-- eventual use the pagination feature to scroll through albums -->
    <!-- Pagination -->
    <div class="w3-center w3-padding-32">
      <div class="w3-bar">
        <a class="w3-button w3-black" href="#">1</a>
        <a class="w3-button w3-hover-black" href="#">2</a>
        <a class="w3-button w3-hover-black" href="#">3</a>
        <a class="w3-button w3-hover-black" href="#">4</a>
        <a class="w3-button w3-hover-black" href="#">5</a>
        <a class="w3-button w3-hover-black" href="#">»</a>
      </div>
    </div>

    <footer id="myFooter">
      <div class="w3-container w3-theme-l2 w3-padding-32">
        <h4>AE, inc. &copy 2022</h4>
        <em> Christina Camacho, <a href="https://www.dallascollege.edu/">Dallas College</a>, &copy 2022 </em>
        <p></p>
        | <a href="home.html">Home</a> 
        | <a href="catalog.html">Catalog</a> 
        |<a href="form.html">Order Form</a> 
        | <a href="philsophy.html">Our philosophy</a> 
        | <a href="workForUs.html">Work for Us</a> 
        |<a href="form-validation.php">Form-Validation</a>
        |<a href="file-uploads.php">File-Uploads</a>
        |<a href="calendar.php">Calendar</a>
        | <a href="mailto: camacho.christina@gmail.com">Email</a> |
      </div>

      <div class="w3-container w3-theme-l1">
        <p><a href="" target="_blank"></a></p>
      </div>
    </footer>

    <!-- END MAIN -->
  </div>

  <script>
    // Get the Sidebar
    var mySidebar = document.getElementById("mySidebar");

    // Get the DIV with overlay effect
    var overlayBg = document.getElementById("myOverlay");

    // Toggle between showing and hiding the sidebar, and add overlay effect
    function w3_open() {
      if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
      } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
      }
    }

    // Close the sidebar with the close button
    function w3_close() {
      mySidebar.style.display = "none";
      overlayBg.style.display = "none";
    }
  </script>

</body>

</html>