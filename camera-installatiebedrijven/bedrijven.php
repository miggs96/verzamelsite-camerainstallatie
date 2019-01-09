
<html>
<head>
<script>
    function showHint(str) {
        if (str.length==0) { 
          document.getElementById("search").innerHTML="";
          return;
        }
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("search").innerHTML=xmlhttp.responseText;
          } 
      }
        xmlhttp.open("GET","http://www.camera-installatiebedrijven.nl/php/zoek.php?q="+str,true);
        xmlhttp.send();
    }
  </script>

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
          <h1>Geregistreerde bedrijven</h1>
          <!--<a style="float:right;"data-toggle="collapse" data-target="#zoek"><i class="fa fa-search"></i></a>-->
          <hr>
          <div class="container-fluid bg-3 text-center">  
            <div class="row">
              <div id="zoek" class="collapse">
                <form method="GET" action="php/zoek.php">
                  <input type="text" name="zoek" class="form-control" onkeyup="showHint(this.value)" placeholder="zoek een bedrijf op naam!">
                  <select name="bedrijf" id="search" class ="form-control" size="5" style="width: 100%;"></select>
                </form>
              </div>
            <?php
              bedrijf();
            ?>
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

