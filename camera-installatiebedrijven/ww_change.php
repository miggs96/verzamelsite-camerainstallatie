
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
          <h1>Wachtwoord wijzigen</h1>
          <form method="POST" action="#">
            <p>Huidig wachtwoord:</p><input class="form-control" type="password" name="h-ww">
            <br>
            <p>Nieuw wachtwoord:</p><input class="form-control" type="password" name="ww">
            <br>
            <p>Herhaal nieuw wachtwoord:</p><input class="form-control" type="password" name="2ww">
            <br>
            <input class="btn btn-default" type="submit" name="wachtwoord" value="wijzig">
            <?php
              wachtwoord();
            ?>
          </form>
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

