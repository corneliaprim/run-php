<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $pageTitle; ?></title>
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
        
.error {color: #FF0000;}

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


    <!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
    <div class="w3-main" style="margin-left:250px">

        <div class="w3-row w3-padding-64">
            <div class="w3-twothird w3-container">
                <h1><?php echo $pageTitle; ?></h1>
                <h3><?php echo $subTitle; ?></h3>
                <!-- Enter Content here -->
                <?php echo $pageContent; ?>

            </div>
        </div>
    </div>

    <footer id="myFooter">
        <div class="w3-container w3-theme-l2 w3-padding-32">
            <h4>AE, inc. &copy 2022</h4>
            <em> Christina Camacho, <a href="https://www.dallascollege.edu/">Dallas College</a>, &copy 2022 </em>
            <p></p>
            <a href="home.php">Home</a>|
            <a href="invoice.php">Handle-Invoice</a>|
            <a href="form-validation.php">Form-Validation</a>|
            <a href="file-uploads.php">File-Uploads</a>|
            <a href="mailto: camacho.christina@gmail.com">Email</a> |
        </div>

        <div class="w3-container w3-theme-l1">
            <p><a href="" target="_blank"></a></p>
        </div>
    </footer>

    <!-- END MAIN -->
    </div>

</body>

</html>