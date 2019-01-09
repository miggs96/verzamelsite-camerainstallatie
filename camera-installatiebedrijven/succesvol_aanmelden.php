
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
          <h1>Uw account is succesvol aangemeld</h1>
          <hr>
          <p>U heeft een mail ontvangen met de activatie code van uw account. klik op de link in uw mail en activeer uw account.</p>
          <br/>
          <h3>Geen mail ontvangen?</h3>
          <p>Neem dan contact met ons op via het contact formulier.</p>
          <br/>
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

