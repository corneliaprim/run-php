
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