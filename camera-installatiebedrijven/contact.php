
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
          <h1>Contact</h1>
          <h3>Heeft u vragen? Stuur ons een berichtje.</h3>
          <form method="POST" action="#">
            <input class="form-control" type="text" name="naam" placeholder="Naam">
            <br>
            <input class="form-control" type="text" name="email" placeholder="Email">
            <br>
            <input class="form-control" type="text" name="onderwerp" placeholder="Onderwerp">
            <br>
            <h4>Bericht</h4>
            <textarea class="form-control" rows="5" name="bericht"></textarea>
            <br>
            <div class="g-recaptcha" data-sitekey="6LceaRgTAAAAANTStnLRad_MKpjaQUfRXYnMAyet"></div>
            <br>
            <input class="btn btn-default" type="submit" name="verstuur" value="Verstuur">
            <?php
              contact();
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

