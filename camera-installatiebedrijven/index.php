
<html>
<head>
  <?php
    include'header.php';
  ?>
</head>
<body>
  <div class="container-fluid text-center">
    <div class="row content">
      <?php
        include'left_sidebar.php';
      ?>
        <div class="col-sm-7 text-left"> 
          <h1>Over Camera-installatie bedrijven</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          <hr>
          <div class="container-fluid bg-3 text-center">    
            <h2 class="text-left">Bedrijven</h2><br>
            <div class="row">
            <div class="col-sm-2">
            </div>
              <?php
                index();
              ?>
            </div>
          </div><br>
        </div>
      <?php
        include'right_sidebar.php';
      ?>
    </div>
  </div>
</div>
<br>
<?php
  include'footer.php';
?>
</body>
</html>

