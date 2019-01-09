
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
          <h1>Nieuws</h1>
          <p>Nieuws op het gebied van camera installatie. Met de nieuwste snufjes op de markt.</p>
          <hr>
          <div class="container-fluid bg-7 text-center">
            <div class="row">
              <?php
                allnieuws();
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

