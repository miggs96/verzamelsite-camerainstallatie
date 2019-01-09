
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
          <h1>Aanmelden</h1>
          <br>
          <h4>Maak een account aan voor uw bedrijf.</h4>
          <p style="font-weight:bold;"><i class="fa fa-asterisk fa-fw" style="color:red;"></i>verplichte velden!</p>
          <form method="POST" action="#" enctype="multipart/form-data">
            <div class="col-sm-4">
              <input class="form-control" type="text" name="naam" placeholder="bedrijfsnaam">
                <i class="fa fa-asterisk fa-fw input-icon"></i>
              <br>
            </div>
            <div class="col-sm-4">
              <input class="form-control" type="text" name="adres" placeholder="adres">
                <i class="fa fa-asterisk fa-fw input-icon"></i>
              <br>
            </div>
            <div class="col-sm-4">
              <input class="form-control" type="text" name="plaats" placeholder="plaats">
                <i class="fa fa-asterisk fa-fw input-icon"></i>
              <br>
            </div>
            <div class="col-sm-4">
              <input class="form-control" type="text" name="postcode" placeholder="postcode">
                <i class="fa fa-asterisk fa-fw input-icon"></i>
              <br>
            </div>
            <div class="col-sm-4">
              <input class="form-control" type="text" name="land" placeholder="land">
                <i class="fa fa-asterisk fa-fw input-icon"></i>
              <br>
            </div>
            <div class="col-sm-4">
              <input class="form-control" type="text" name="telefoon" placeholder="telefoon">
                <i class="fa fa-asterisk fa-fw input-icon"></i>
              <br>
            </div>
            <div class="col-sm-4">
              <input class="form-control" type="text" name="email" placeholder="email">
                <i class="fa fa-asterisk fa-fw input-icon"></i>
              <br>
            </div>
            <div class="col-sm-4">
              <input class="form-control" type="text" name="website" placeholder="website">
              <br>
            </div>
            <div class="col-sm-4">
              <input class="form-control" type="password" name="wachtwoord" placeholder="wachtwoord">
                <i class="fa fa-asterisk fa-fw input-icon"></i>
              <br>
            </div>
            <div class="col-sm-4">
              <input class="form-control" type="file" name="logo" accept="image/*" id="uploadFile">
              <img class="img-responsive" id="imagePreview"/>
              <a data-placement="bottom" data-toggle="popover" data-content="Als u het verkeerde logo heeft geselecteerd, klikt dan nog een keer op 'Bestand Kiezen' en selecteer uw logo. (klik nog een keer op Tip!)">Tip!</a>
              <script type="text/javascript">
                $(document).ready(function(){
                $('[data-toggle="popover"]').popover();   
                });

                $(function() {
                  $("#uploadFile").on("change", function()
                {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader           support

                  if (/^image/.test( files[0].type)){ // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                      reader.onloadend = function(){ // set image data as background of div
                      $("#imagePreview").css({"display": "block", "background-image": "url("+this.result+")"});
                    }
                  }
                });
              });
              </script>
              <br>
            </div>
            <div class="col-sm-4">
              <textarea class="form-control" rows="5" placeholder="wat doet uw bedrijf?" name="beschrijving"></textarea>
                <i class="fa fa-asterisk fa-fw input-icon"></i>
              <br>
            </div>
            <div class="checkbox col-sm-4">
              <label>Ik ga akkoord met de 
                <a href="voorwaarden" style="color:red!important; font-weight:bold;">voorwaarden</a><input type="checkbox" name="voorwaarden" style="margin-left:10px!important;" required></label>
              <br>
            </div>
            <div class="col-sm-4">
              <input class="btn btn-default" type="submit" name="aanmelden" value="aanmelden">
            </div>
            <?php
              aanmelden();
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

