
<html>
<head>
  <?php
    include'header.php';
    admin();
  ?>
</head>
<body>
  <div class="container-fluid text-center">    
    <div class="row content">
      <?php
        include'left_sidebar.php';
      ?>
        <div class="col-sm-7 text-left"> 
          <h1>Admin</h1>
          <br>
          <button data-toggle="collapse" data-target="#nieuws" class="btn btn-primary">Nieuws toevoegen</button>
          <button data-toggle="collapse" data-target="#verwijder" class="btn btn-primary">Verwijder bedrijf</button>
          <div class="collapse" id="nieuws">
            <h3>Schrijf nieuws berichten voor de site</h3>
            <form method="POST" action="#" enctype="multipart/form-data">
              <input class="form-control" type="text" name="title" placeholder="title">
              <br>
              <input class="form-control" type="text" name="beschrijving" placeholder="korte beschrijving">
              <br>
              <input class="form-control" type="file" accept="image/*" name="plaatje">
              <br>
              <h4>Nieuws bericht</h4>
              <textarea class="form-control" rows="5" name="bericht"></textarea>
              <br>
              <input class="btn btn-default" type="submit" name="verstuur" value="Verstuur">
              <?php
                nieuwsbericht();
              ?>
            </form>
          </div>
          <div class="collapse" id="verwijder">
            <div class="text-center">
              <h3>Verwijder een bedrijf</h3>
              <form method="POST" action="#">
                <select name="select" size="5" class="form-control">
                  <?php
                    admin_bedrijf();
                  ?>
                </select>
                <input type="submit" value="verwijder" name="verwijder" class="form-control">
                <?php
                  del_bedrijf();            
                ?>
              </form>
            </div>
          </div>
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