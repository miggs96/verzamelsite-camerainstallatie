
<html>
<head>
  <?php
    header("refresh:5;url=home");
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
          <h1>Uw bericht is succesvol verstuurd</h1>
          <hr>
          <a href="home">Om door te gaan klik hier!</a>
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

