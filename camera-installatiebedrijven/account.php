
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
          <h1>Uw account</h1>
          <p>Hier kunt u uw gegevens wijzigen als u dat wilt.</p>
          <hr>
          <div class="container-fluid bg-3 text-center">    
            <h2 class="text-left">Uw gegevens</h2><br>
            <div class="row">
            <?php
              account();
              update();
            ?>
            <a href="wachtwoordwijzigen">wachtwoord wijzigen?</a>
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
