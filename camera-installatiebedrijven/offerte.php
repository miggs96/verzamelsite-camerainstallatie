
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
          <h1>Offerte aanvragen</h1>
          <form method="POST" action="#">
            <p>Uw volledige naam:</p><input class="form-control" type="text" name="naam">
            <br>
            <p>Uw email:</p><input class="form-control" type="text" name="email">
            <br>
            <p>Beschrijf hier wat u precies wilt, waar u het wilt en graag ook vermelden waar u woont.</p>
            <textarea class="form-control" rows="5" name="bericht"></textarea>
            <br>
            <div class="g-recaptcha" data-sitekey="6LceaRgTAAAAANTStnLRad_MKpjaQUfRXYnMAyet"></div>
            <br>
            <input class="btn btn-default" type="submit" name="aanvraag" value="aanvraag">
            <?php
              offerte();
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

