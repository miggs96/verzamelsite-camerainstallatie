
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
          <h1>Inloggen</h1>
          <form method="POST" action="#">
            <p>Email:</p><input class="form-control" type="text" name="email">
            <br>
            <p>Wachtwoord:</p><input class="form-control" type="password" name="ww">
            <br>
            <input class="btn btn-default" type="submit" name="inloggen" value="Log in">
            <?php
              login();
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

